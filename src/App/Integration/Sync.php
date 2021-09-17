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
	 * Raw data
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      object    $raw_data
	 */
	protected $raw_data;

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
	protected $processed = [];

	/**
	 * Status
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $status
	 */
	public $status;

	/**
	 * Date Format
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $date_format for storing date
	 */
	protected $date_format = 'Y-m-d H:i:s';

	/**
	 * Transient Name
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string 
	 */
	public const TRANSIENT = 'wp_action_network_events_sync_last_';

	/**
	 * Sync Frequency
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $sync_frequency
	 */
	protected $sync_frequency;

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
	 * @since 0.1.0
	 */
	public function init() {
		/**
		 * This general class is always being instantiated as requested in the Bootstrap class
		 *
		 * @see Bootstrap::__construct
		 *
		 */
		$options = Options::getOptions();
		$this->sync_frequency = intval( $options['sync_frequency'] ) * HOUR_IN_SECONDS;

		\add_action( 'admin_enqueue_scripts', 							[ $this, 'enqueueScripts' ] );

		\add_action( 'wp_ajax_' . Options::SYNC_ACTION_NAME, 			[ $this, 'ajaxAction' ] );
		\add_action( 'wp_ajax_nopriv_' . Options::SYNC_ACTION_NAME, 	[ $this, 'ajaxAction' ] );
	}

	/**
	 * Respond to Ajax sync request
	 *
	 * @return void
	 */
	public function ajaxAction() {
		$this->startSync( 'manual' );
		\wp_send_json( $this->processed );

		\wp_die();
	}

	/**
	 * Kick off sync
	 *
	 * @param string $origin
	 * @return void
	 */
	public function startSync( string $origin = 'cron' ) {
		$start = new \DateTime();
		$this->setStatus( 'origin', $origin );
		$this->status = 'processing';
		$this->setStatus( 'started', $start->format( $this->date_format ) );
		$this->setStatus( 'sync_frequency', $this->sync_frequency );
		\set_transient( self::TRANSIENT . 'started', $this->processed['started'], $this->sync_frequency );

		$this->setData();

		$parsed = new Parse( $version, $plugin_name, $this->data );
		$this->parsed_data = $parsed->getParsed();
		$this->setStatus( 'parseStatus', $parsed->getStatus() );

		$process = new Process( $version, $plugin_name, $this->parsed_data );
		$processed = $process->evaluatePosts();
		$this->setStatus( 'evaluatePosts', $process->getStatus() );

		$this->completeSync();
	}

	/**
	 * Complete sync
	 *
	 * @return void
	 */
	public function completeSync() {
		$completed = new \DateTime();
		$this->setStatus( 'completed', $completed->format( $this->date_format ) );
		\set_transient( self::TRANSIENT . 'completed', $this->processed['completed'], $this->sync_frequency );
		$this->setStatus( 'status', 'complete' );
		\set_transient( 'wp_action_network_events_sync_status_' . $this->processed['completed'], $this->processed, $this->sync_frequency );

		return $this->processed;
	}

	/**
	 * Get data
	 * 
	 * @return object $events->getResponseBody()
	 */
	function getData( $page = 1 ) {
		$events = new GetEvents( $this->version, $this->plugin_name );
		if( is_a( $events, '\WP_Error' ) ) {
			return $this->handleError( 'Failed at ' . __FUNCTION__ );
			// throw new \Exception( \__( 'Error encountered in ' . __FUNCTION__, 'wp-action-network-events' ) );
		}
		return $events->getCollection();
	}

	/**
	 * Set data
	 * 
	 * @return void
	 */
	function setData( $page = 1 ) {
		$this->data = $this->getData( $page );
	}

	/**
	 * Handle Errors
	 *
	 * @return void
	 */
	protected function handleError( $exception ) {
		$this->status = 'failed';
		$this->errors = $exception;
		$this->setStatus( 'errors', $this->errors );
		$this->completeSync();

		$this->errors = new \WP_Error( $exception );
		// throw new \Exception( $exception );


		// if ( is_a( $results, '\WP_Error' ) ) {
		// 	$this->errors = new \WP_Error(); 
		// 	throw new \Exception();
		// }
	}

	/**
	 * Set processing status
	 *
	 * @param string $prop
	 * @param mixed $value
	 * @return void
	 */
	function setStatus( $prop, $value ) {
		$this->processed[$prop] = $value;
	}

	/**
	 * Get duration in seconds
	 *
	 * @param string $started
	 * @param string $completed
	 * @return integer $seconds
	 */
	function getDuration( $started, $completed ) : integer {
		$start = new \DateTime( $started );
		$end = new \DateTime( $completed );
		$diff = $start->diff( $end );
		$daysInSecs = $diff->format( '%r%a' ) * 24 * 60 * 60;
		$hoursInSecs = $diff->h * 60 * 60;
		$minsInSecs = $diff->i * 60;

		$seconds = $daysInSecs + $hoursInSecs + $minsInSecs + $diff->s;

		return $seconds;
	}

	/**
	 * Enqueue Scripts
	 * 
	 * @see https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
	 *
	 * @return void
	 */
	public function enqueueScripts() {
		\wp_register_script( $this->plugin_name, esc_url( WPANE_PLUGIN_URL . 'assets/public/js/backend.js' ), [ 'jquery' ], $this->version, false );

		$localized = [
			'action'		=> Options::SYNC_ACTION_NAME,
			// 'endpoint'		=> $this->endpoint,
			'endpoint'		=> 'events',
			'ajax_url' 		=> \admin_url( 'admin-ajax.php' )
		];

		\wp_localize_script( $this->plugin_name, 'wpANEData', $localized );

		\wp_enqueue_script( $this->plugin_name );
	}
}
