<?php

/**
 * The admin notices.
 *
 * @link       https://debtcollective.org
 * @since      1.0.0
 *
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/admin
 */
namespace WpActionNetworkEvents\App\Admin;

use WpActionNetworkEvents\Common\Abstracts\Base;
use WpActionNetworkEvents\App\Admin\Options;
use WpActionNetworkEvents\App\General\PostTypes\Event;
use WpActionNetworkEvents\App\Integration\Sync;

/**
 * Admin Notices
 *
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/admin
 * @author     Debt Collective <pea@misfist.com>
 */
class Notices extends Base {

	/**
	 * Data
	 *
	 * @var arrat
	 */
	protected $data;

	/**
	 * API Key
	 *
	 * @var string
	 */
	protected $api_key;

	/**
	 * Base URL
	 *
	 * @var string
	 */
	protected $base_url;

	/**
	 * Notices data key
	 */
	const DATA_KEY = 'wpANENoticesData';

	const ACTION_NAME = 'sendStatus';

	const NOTICE_ID = 'sync-notice-container';

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
		$this->status = \get_option( Sync::LOG_KEY );

		\add_action( 'admin_enqueue_scripts', array( $this, 'enqueueScript' ) );

		// \add_action( 'wp_ajax_' . self::ACTION_NAME, array( $this, 'sendStatus' ) );

		\add_action( 'admin_notices', array( $this, 'renderAdminNotice' ) );
		\add_action( 'admin_notices', array( $this, 'renderWarnings' ) );

		$options = Options::getOptions();
		$this->setBaseUrl( isset( $options['base_url'] ) ? $options['base_url'] : null );
		$this->setApiKey( isset( $options['api_key'] ) ? $options['api_key'] : null );

	}

	/**
	 * Render Notices on Options page
	 *
	 * @return void
	 */
	public function renderAdminNotice() {
		$screen = \get_current_screen();
		if ( ! $screen || ( 'settings_page_' . Options::OPTIONS_PAGE_NAME !== $screen->base && Event::POST_TYPE['id'] . '_page_' . Sync::SYNC_PAGE_NAME != $screen->base ) ) {
			return;
		}

		if( empty( $this->status ) ) {
			return;
		}

		$status   = isset( $this->status['get']['response'] ) && 200 === $this->status['get']['response'] ? 'success' : 'warning';
		$response = isset( $this->status['get']['response'] ) ? isset( $this->status['get']['response'] ) : \esc_html( 'Request Failed', 'wp-action-network-events' );
		$source = '';
		$last_run = isset( $this->status['last_run'] ) ? $this->status['last_run'] : '';

		if( isset( $this->status['source'] ) ) {
			switch ( $this->status['source'] ) {
				case 'manual':
					$source = esc_html__( 'Manually Synced', 'wp-action-network-events' );
					break;
				case 'import':
					$source = esc_html__( 'Manually Synced (Full Import)', 'wp-action-network-events' );
					break;
				default:
					$source = esc_html__( 'Auto-synced', 'wp-action-network-events' );
			}
		}



		?>
		<div class="notice notice-<?php echo $status; ?> is-dismissible">
			<p><?php printf( 'Last %s at %s - Status %s', $source, $last_run, $response ); ?></p>
			<p><?php print_r( $this->status ); ?></p>
		</div>
		<?php
	}

	/**
	 * Render Notices on Options page
	 *
	 * @return void
	 */
	public function renderWarnings() {
		$screen = \get_current_screen();
		if ( ! $screen || ( 'settings_page_' . Options::OPTIONS_PAGE_NAME !== $screen->base && Event::POST_TYPE['id'] . '_page_' . Sync::SYNC_PAGE_NAME != $screen->base ) ) {
			return;
		}

		if ( ! $this->api_key ) {
			printf( $this->warning( esc_html__( 'API Key is Required to Sync Events', 'wp-action-network-events' ) ) );
		}

		if ( ! $this->base_url ) {
			printf( $this->warning( esc_html__( 'Base URL is Required to Sync Events', 'wp-action-network-events' ) ) );
		}
	}

	/**
	 * Undocumented function
	 *
	 * @param array $status_array
	 * @return void
	 */
	public function sendStatus() {
		\check_ajax_referer( self::ACTION_NAME, 'nonce' );
		$status = array(
			'status'  => $this->data['status'],
			'message' => $this->data['message'],
		);

		\wp_send_json( $status );

		\wp_die();
	}

	/**
	 * Render Error Notice
	 *
	 * @param string $message
	 * @return void
	 */
	public function error( $message = '' ) {
		return sprintf(
			'<div class="notice notice-error"><p>%s</p></div>',
			esc_attr( $message )
		);
	}

	/**
	 * Render Info Notice
	 *
	 * @param string $message
	 * @return void
	 */
	public function info( $message = '' ) {
		return sprintf(
			'<div class="notice notice-info"><p>%s</p></div>',
			esc_attr( $message )
		);
	}

	/**
	 * Render Alert Notices
	 *
	 * @param string $message
	 * @return void
	 */
	public function warning( $message = '' ) {
		return sprintf(
			'<div class="notice notice-warning"><p>%s</p></div>',
			esc_attr( $message )
		);
	}

	/**
	 * Render Success Notice
	 *
	 * @param string $message
	 * @return void
	 */
	public function success( $message = '' ) {
		return sprintf(
			'<div class="notice notice-success"><p>%s</p></div>',
			esc_attr( $message )
		);
	}

	/**
	 * Set var
	 *
	 * @param string $value
	 * @return void
	 */
	public function setApiKey( $value ) {
		$this->api_key = $value;
	}

	/**
	 * Get var
	 *
	 * @return string $this->api_key
	 */
	public function getApiKey() {
		return $this->api_key;
	}

	/**
	 * Set var
	 *
	 * @param string $value
	 * @return void
	 */
	public function setBaseUrl( $value ) {
		$this->base_url = $value;
	}

	/**
	 * Get var
	 *
	 * @return string $this->base_url
	 */
	public function getBaseUrl() {
		return $this->base_url;
	}

	/**
	 * Register Script
	 *
	 * @return void
	 */
	function enqueueScript() {
		\wp_register_script( $this->plugin_name . '-notices', esc_url( WPANE_PLUGIN_URL . 'assets/public/js/notices.js' ), array(), $this->version, false );

		\wp_localize_script(
			$this->plugin_name . '-notices',
			self::DATA_KEY,
			array(
				'ajax_url'     => \admin_url( 'admin-ajax.php' ),
				'action'       => self::ACTION_NAME,
				'nonce'        => \wp_create_nonce( self::ACTION_NAME ),
				'container_id' => self::NOTICE_ID,
			)
		);

		\wp_enqueue_script( $this->plugin_name . '-notices' );
	}

}
