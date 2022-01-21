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
		$args = array(
			'per_page' => 25
		);

		if( $this->last_run ) {
			$args['filter'] = date( 'Y-m-d', strtotime( $this->last_run ) );
		}

		$this->getData( $args );

		$message = 'Data: ' . json_encode( $this->data ) . ' | Count: ' . count( $this->data );
		error_log( $message );

		if( $this->data ) {
			$parse = new Parse( $this->version, $this->plugin_name, $this->data );
			$this->parsed_data = $parse->getParsed();
			$message = 'Parsed: ' . json_encode( $this->parsed_data ) . ' | Count: ' . count( $this->parsed_data );
			error_log( $message );

			$process = new Process( $this->version, $this->plugin_name, $this->parsed_data );

			if( $process->status ) {
				$message = 'Processed Status: ' . json_encode( $process->status );
				error_log( $message );
			}
		}

		\wp_send_json( $message );
		\wp_die();
	}

	public function lastRun() {}

	public function hasUpdates() {}

	/**
	 * Store Data
	 *
	 * @return void
	 */
	public function setData( $args = array() ) {
		$events = new GetEvents( $this->version, $this->plugin_name, $args );
		$this->data = $events->getData();
	}

	/**
	 * Get Stored Data
	 *
	 * @return array $this->data
	 */
	public function getData( $args = array() ) {
		$this->setData( $args );
		return $this->data;
	}

	public function processData() {}

	public function parseData() {}

	public function log() {}

	// /**
	// * Kick off sync
	// *
	// * @param string $origin
	// * @return void
	// */
	// public function startSync( string $origin = 'cron' ) {
	// $start = new \DateTime();
	// $this->setStatus( 'origin', $origin );
	// $this->status = 'processing';
	// $this->setStatus( 'started', $start->format( $this->date_format ) );
	// $this->setStatus( 'sync_frequency', $this->sync_frequency );
	// \set_transient( self::TRANSIENT . 'started', $this->processed['started'], $this->sync_frequency );

	// $this->setData();

	// $parsed = new Parse( $this->version, $this->plugin_name, $this->data );
	// $this->parsed_data = $parsed->getParsed();
	// $this->setStatus( 'parseStatus', $parsed->getStatus() );

	// $process = new Process( $this->version, $this->plugin_name, $this->parsed_data );
	// $processed = $process->evaluatePosts();
	// $this->setStatus( 'evaluatePosts', $process->getStatus() );

	// $this->completeSync();
	// }

	// /**
	// * Complete sync
	// *
	// * @return void
	// */
	// public function completeSync() {
	// $completed = new \DateTime();
	// $this->setStatus( 'completed', $completed->format( $this->date_format ) );
	// \set_transient( self::TRANSIENT . 'completed', $this->processed['completed'], $this->sync_frequency );
	// $this->setStatus( 'status', 'complete' );
	// \set_transient( 'wp_action_network_events_sync_status_' . $this->processed['completed'], $this->processed, $this->sync_frequency );

	// return $this->processed;
	// }

	// /**
	// * Get data
	// *
	// * @return object $events->getResponseBody()
	// */
	// function getData( $page = 1 ) {
	// $events = new GetEvents( $this->version, $this->plugin_name );
	// if( is_a( $events, '\WP_Error' ) ) {
	// return $this->handleError( 'Failed at ' . __FUNCTION__ );
	// throw new \Exception( \__( 'Error encountered in ' . __FUNCTION__, 'wp-action-network-events' ) );
	// }
	// return $events->getCollection();
	// }

	// /**
	// * Set data
	// *
	// * @return void
	// */
	// function setData( $page = 1 ) {
	// $this->data = $this->getData( $page );
	// }

	// /**
	// * Handle Errors
	// *
	// * @return void
	// */
	// protected function handleError( $exception ) {
	// $this->status = 'failed';
	// $this->errors = $exception;
	// $this->setStatus( 'errors', $this->errors );
	// $this->completeSync();

	// $this->errors = new \WP_Error( $exception );
	// throw new \Exception( $exception );


	// if ( is_a( $results, '\WP_Error' ) ) {
	// $this->errors = new \WP_Error();
	// throw new \Exception();
	// }
	// }

	// /**
	// * Set processing status
	// *
	// * @param string $prop
	// * @param mixed $value
	// * @return void
	// */
	// function setStatus( $prop, $value ) {
	// $this->processed[$prop] = $value;
	// }

	// /**
	// * Get duration in seconds
	// *
	// * @param string $started
	// * @param string $completed
	// * @return integer $seconds
	// */
	// function getDuration( $started, $completed ) : integer {
	// $start = new \DateTime( $started );
	// $end = new \DateTime( $completed );
	// $diff = $start->diff( $end );
	// $daysInSecs = $diff->format( '%r%a' ) * 24 * 60 * 60;
	// $hoursInSecs = $diff->h * 60 * 60;
	// $minsInSecs = $diff->i * 60;

	// $seconds = $daysInSecs + $hoursInSecs + $minsInSecs + $diff->s;

	// return $seconds;
	// }

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
