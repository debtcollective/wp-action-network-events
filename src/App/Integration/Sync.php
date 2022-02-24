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

	/**
	 * Status
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $status
	 */
	public $status;

	protected $start;

	protected $finish;

	protected $log;

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
	 * Transient Name
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string
	 */
	public const TRANSIENT_KEY = 'wp_action_network_events_sync_status';

	public const LAST_RUN_TRANSIENT_KEY = 'wp_action_network_events_sync_datetime';

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
		$this->sync_frequency = intval( $options['sync_frequency'] ) * HOUR_IN_SECONDS;

		$this->last_run = \get_option( self::LAST_RUN_TRANSIENT_KEY );

		\add_action( 'admin_enqueue_scripts', array( $this, 'enqueueScripts' ) );

		\add_action( 'wp_ajax_' . Options::SYNC_ACTION_NAME, array( $this, 'ajaxAction' ) );
		\add_action( 'wp_ajax_nopriv_' . Options::SYNC_ACTION_NAME, array( $this, 'ajaxAction' ) );
	}

	public function run() {}

	/**
	 * Respond to Ajax sync request
	 *
	 * @return void
	 */
	public function ajaxAction() {
		$this->startSync();
	}

	/**
	 * Start Sync
	 *
	 * @param string $source
	 * @return void
	 */
	public function startSync( $source = 'manual' ) {
		$this->start = date( $this->date_format );

		$args        = array(
			'per_page' => 25,
		);
		if ( $this->last_run ) {
			$args['filter'] = date( 'Y-m-d', strtotime( $this->last_run ) );
		}
		$this->data = $this->fetchData( $args );

		if ( $this->data ) {
			$this->parsed_data = $this->parseData();

			if( $this->parsed_data ) {
				$process = new Process( $this->version, $this->plugin_name, $this->parsed_data );
				$this->processed_data = $process->status;
			}
		}

		$this->finishSync( $message );
	}

	/**
	 * Finish Sync process
	 *
	 * @param string $status
	 * @return void
	 */
	public function finishSync( $status = '' ) {
		\wp_send_json( $status );
		\wp_die();
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
	 * Get status
	 *
	 * @return void
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * Fetch the data
	 *
	 * @param array $args
	 * @return mixed
	 */
	public function fetchData( $args = array() ) {
		$events = new GetEvents( $this->version, $this->plugin_name, $args );
		// $this->setData( $events );
		return $events;
	}

	/**
	 * Parse the data
	 *
	 * @return mixed
	 */
	public function parseData() {
		$parse             = new Parse( $this->version, $this->plugin_name, $this->data );
		$this->setParsedData( $parse );
		return $this->parsed_data;
	}

	/**
	 * Process the data
	 *
	 * @return mixed
	 */
	public function processData() {
		$process              = new Process( $this->version, $this->plugin_name, $this->parsed_data );
		$this->setProcessedData( $process );
		return $this->processed_data;
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
		$this->data = $data;
	}

	/**
	 * Set parsed data
	 *
	 * @return void
	 */
	public function setParsedData( $parsed_data ) {
		$this->parsed_data = $parsed_data;
	}

	/**
	 * Set the processed data
	 *
	 * @return void
	 */
	public function setProcessedData( $processed_data ) {
		$this->processed_data = $processed;
	}

	/**
	 * Set last run datetime
	 *
	 * @return void
	 */
	public function setLastRun() {
		$this->last_run = date( $this->date_format );
	}

	public function hasUpdates() {}

	public function log() {}

	/**
	 * Enqueue Scripts
	 *
	 * @see https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
	 *
	 * @return void
	 */
	public function enqueueScripts() {
		\wp_register_script( $this->plugin_name, esc_url( WPANE_PLUGIN_URL . 'assets/public/js/backend.js' ), array( 'jquery' ), $this->version, false );

		$localized = array(
			'action'   => Options::SYNC_ACTION_NAME,
			// 'endpoint'		=> $this->endpoint,
			'endpoint' => 'events',
			'ajax_url' => \admin_url( 'admin-ajax.php' ),
		);

		\wp_localize_script( $this->plugin_name, 'wpANEData', $localized );

		\wp_enqueue_script( $this->plugin_name );
	}
}
