<?php

/**
 * Sync
 *
 * @link       https://debtcollective.org
 * @since      1.0.0
 *
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/admin
 */
namespace WpActionNetworkEvents\App\Integration;

use WpActionNetworkEvents\Common\Abstracts\Base;
use WpActionNetworkEvents\App\Admin\Options;
use WpActionNetworkEvents\App\Admin\Notices;
use WpActionNetworkEvents\App\General\PostTypes\Event;
use WpActionNetworkEvents\App\Integration\GetEvents;
use WpActionNetworkEvents\App\Integration\Parse;
use WpActionNetworkEvents\App\Integration\Process;

/**
 * Sync
 *
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/admin
 * @author     Debt Collective <pea@misfist.com>
 */
class Sync extends Base {

	/**
	 * API Data
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      object    $data
	 */
	protected $data;

	/**
	 * Parsed Data
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $parsed_data
	 */
	protected $parsed_data;

	/**
	 * Processed Data
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $processed
	 */
	protected $processed_data;

	protected $start;

	protected $finish;

	public $endpoint = 'events';

	/**
	 * Last Run DateTime
	 *
	 * @var string $last_run
	 */
	public $last_run;

	/**
	 * Date Format
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $date_format for storing date
	 */
	protected $date_format = 'Y-m-d H:i:s';

	/**
	 * Sync Frequency
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $sync_frequency
	 */
	protected $sync_frequency;

	/**
	 * Name of sync capability
	 *
	 * @var string
	 */
	public const SYNC_CAP_NAME = 'sync_events';

	/**
	 * Name of sync capability
	 *
	 * @var string
	 */
	public const SYNC_PAGE_NAME = 'sync';

	/**
	 * Name of sync action
	 *
	 * @var string
	 */
	public const SYNC_ACTION_NAME = 'wp_action_network_events_sync';

	/**
	 * AJAX data key
	 */
	const DATA_KEY = 'wpANEData';

	/**
	 * Last run key
	 *
	 * @var string
	 */
	public const LAST_RUN_KEY = 'wp_action_network_events_sync_datetime';

	/**
	 * Transient Name
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string
	 */
	public const LOG_KEY = 'wp_action_network_events_sync_datetime_log';

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $version, $plugin_name ) {
		parent::__construct( $version, $plugin_name );
		$this->init();
	}

	/**
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		/**
		 * This general class is always being instantiated as requested in the Bootstrap class
		 *
		 * @see Bootstrap::__construct
		 */
		$options              = Options::getOptions();
		$this->sync_frequency = ( isset( $options['sync_frequency'] ) ) ? intval( $options['sync_frequency'] ) * HOUR_IN_SECONDS : 24 * HOUR_IN_SECONDS;
		$this->last_run       = \get_option( self::LAST_RUN_KEY );

		\add_action( 'admin_menu', array( $this, 'addAdminMenu' ) );
		\add_action( 'admin_init', array( $this, 'addCustomCapability' ) );
		\add_action( 'admin_enqueue_scripts', array( $this, 'enqueueScripts' ) );

		if ( ! function_exists( '\wp_get_current_user' ) ) {
			include ABSPATH . 'wp-includes/pluggable.php';
		}

		if ( \current_user_can( self::SYNC_CAP_NAME ) ) {
			\add_action( 'wp_ajax_' . Options::SYNC_ACTION_NAME, array( $this, 'ajaxSync' ) );
			\add_action( 'wp_ajax_' . Options::SYNC_ACTION_NAME . '_clean', array( $this, 'ajaxImport' ) );
		}
	}

	/**
	 * Respond to Ajax sync request
	 *
	 * @return void
	 */
	public function ajaxSync() {
		$this->startSync();
	}

	/**
	 * Respond to Ajax import request
	 *
	 * @return void
	 */
	public function ajaxImport() {
		$this->startSync( 'import', true );
	}

	/**
	 * Start Sync
	 *
	 * @param string $source
	 * @param bool   $ignore_filter
	 * @return void
	 */
	public function startSync( $source = 'manual', $ignore_filter = false ) {
		$this->start = date( $this->date_format );
		$this->setLog( 'start', $this->start );
		$this->setLog( 'source', $source );

		$args = array(
			'per_page' => 25,
		);
		if ( $this->last_run && ! $ignore_filter ) {
			$modified_since = date( 'Y-m-d', strtotime( $this->last_run ) );
			$this->setLog( 'filter', $modified_since );
			$args['filter'] = $modified_since;
		}
		$this->data = (array) $this->fetchData( $args );

		if ( $this->data ) {
			$this->parsed_data = $this->parseData();

			if ( $this->parsed_data ) {
				$this->processed_data = $this->processData();
			}
		}

		$this->finishSync( \wp_json_encode( $this->status ) );
	}

	/**
	 * Finish Sync processs
	 *
	 * @param string $status
	 * @return void
	 */
	public function finishSync( $status = '' ) {
		\check_ajax_referer( self::SYNC_ACTION_NAME, 'nonce' );
		$this->setLastRun();
		$this->setLog( 'finish', date( $this->date_format ) );
		$this->log();
		\wp_send_json( $this->log );
		\wp_die();
	}

	/**
	 * Send Status
	 *
	 * @param array $data
	 * @return void
	 */
	public function sendStatus( $data ) {
		$status  = array(
			'status'  => $data['status'],
			'message' => $data['message'],
		);
		$notices = new Notices( $this->version, $this->plugin_name, $status );
		$notices->sendStatus();
	}

	/**
	 * Fetch the data
	 *
	 * @param array $args
	 * @return mixed
	 */
	public function fetchData( $args = array() ) {
		$events     = new GetEvents( $this->version, $this->plugin_name, $args );
		$this->data = $events->getData();
		$this->setLog( 'get', $events->getLog() );
		$this->setStatus( 'got', $events->getStatus() );
		return $this->data;
	}

	/**
	 * Parse the data
	 *
	 * @return mixed
	 */
	public function parseData() {
		$parse = new Parse( $this->version, $this->plugin_name, $this->data );
		$this->setParsedData( $parse->getParsed() );
		$this->setLog( 'parse', $parse->getLog() );
		$this->setStatus( 'parsed', $parse->getStatus() );
		return $this->parsed_data;
	}

	/**
	 * Process the data
	 *
	 * @return mixed
	 */
	public function processData() {
		$process = new Process( $this->version, $this->plugin_name, $this->parsed_data );
		$this->setProcessedData( $process->getProcessed() );
		$this->setLog( 'processed', $process->getLog() );
		$this->setStatus( 'processed', $process->getStatus() );
		return $this->processed_data;
	}

	/**
	 * Get Last run datetime
	 *
	 * @return mixed null || datetime
	 */
	public function getLastRun() {
		return $this->last_run;
	}

	/**
	 * Get Stored Data
	 *
	 * @return array $this->data
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * Get parsed data
	 *
	 * @return array
	 */
	public function getParsedData() {
		return $this->parsed_data;
	}

	/**
	 * Get the processed data
	 *
	 * @return void
	 */
	public function getProcessedData() {
		return $this->processed_data;
	}

	/**
	 * Store Data
	 *
	 * @return void
	 */
	public function setData( $data ) {
		$this->data = (array) $data;
	}

	/**
	 * Set parsed data
	 *
	 * @return void
	 */
	public function setParsedData( $parsed_data ) {
		$this->parsed_data = (array) $parsed_data;
	}

	/**
	 * Set the processed data
	 *
	 * @return void
	 */
	public function setProcessedData( $processed_data ) {
		$this->processed_data = (array) $processed_data;
	}

	/**
	 * Set last run datetime
	 *
	 * @return void
	 */
	public function setLastRun() {
		$this->last_run = date( $this->date_format );
		\update_option( self::LAST_RUN_KEY, $this->last_run );

	}

	public function log() {
		$this->setLog( 'last_run', $this->last_run );
		\update_option( self::LOG_KEY, $this->log );
	}

	/**
	 * Add Custom Capability for Sync
	 *
	 * @link https://developer.wordpress.org/plugins/users/roles-and-capabilities/
	 * @link https://wordpress.org/support/article/roles-and-capabilities/
	 *
	 * @return void
	 */
	public function addCustomCapability() {
		$custom_cap = self::SYNC_CAP_NAME;
		$min_cap    = \apply_filters( 'WpActionNetworkEvents\Sync\MinCapArgs', 'edit_others_posts' );
		$grant      = true;

		foreach ( \wp_roles()->roles as $role => $value ) {
			if ( $role_object = \get_role( $role ) ) {
				if ( $role_object->has_cap( $min_cap ) && ! $role_object->has_cap( $custom_cap ) ) {
					$role_object->add_cap( $custom_cap, $grant );
				}
			}
		}
	}

	/**
	 * Add Admin Menu
	 *
	 * @return void
	 */
	public function addAdminMenu() {

		\add_submenu_page(
			'edit.php?post_type=' . Event::POST_TYPE['id'],
			\esc_html__( 'Action Network Sync Settings', 'wp-action-network-events' ),
			\esc_html__( 'Sync', 'wp-action-network-events' ),
			self::SYNC_CAP_NAME,
			self::SYNC_PAGE_NAME,
			array( $this, 'renderPage' )
		);

	}

	/**
	 * Render Sync Page
	 *
	 * @return void
	 */
	public function renderPage() {

		// Check required user capability
		if ( ! current_user_can( self::SYNC_CAP_NAME ) ) {
			\wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'wp-action-network-events' ) );
		}

		echo '<div class="wrap">' . "\n";
		echo '	<h1>' . \get_admin_page_title() . '</h1>' . "\n";

		$this->renderNotice();
		$this->renderSyncButton();

		echo '</div>' . "\n";

	}


	/**
	 * Render Sync Buttons
	 *
	 * @return void
	 */
	public function renderSyncButton() {
		wp_nonce_field( self::SYNC_ACTION_NAME, self::SYNC_ACTION_NAME . '_nonce' );
		?>

		<input type="hidden" id="<?php echo esc_attr( $this->plugin_name ); ?>-sync-action" name="action" value="<?php echo esc_attr( self::SYNC_ACTION_NAME ); ?>" />
		<input type="submit" id="<?php echo esc_attr( $this->plugin_name ); ?>-sync-submit" class="button button-primary" value="<?php _e( 'Manual Sync', 'wp-action-network-events' ); ?>"/>
		<input type="submit" id="<?php echo esc_attr( $this->plugin_name ); ?>-sync-submit-clean" class="button button-secondary" value="<?php _e( 'Clean Import', 'wp-action-network-events' ); ?>"/>
		<?php
	}

	/**
	 * Render Sync Notice
	 *
	 * @return void
	 */
	public function renderNotice() {
		printf( '<div id="%s"></div>', \esc_attr( Notices::NOTICE_ID ) );
	}

	/**
	 * Enqueue Scripts
	 *
	 * @see https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
	 *
	 * @return void
	 */
	public function enqueueScripts() {
		\wp_register_script( $this->plugin_name . '-admin', esc_url( WPANE_PLUGIN_URL . 'assets/public/js/admin.js' ), array(), $this->version, false );

		$localized = array(
			'action'   => self::SYNC_ACTION_NAME,
			'endpoint' => $this->endpoint,
			'ajax_url' => \admin_url( 'admin-ajax.php' ),
			'nonce'    => \wp_create_nonce( self::SYNC_ACTION_NAME ),
		);

		\wp_localize_script(
			$this->plugin_name . '-admin',
			self::DATA_KEY,
			$localized
		);

		\wp_enqueue_script( $this->plugin_name . '-admin' );
	}
}
