<?php

/**
 * Cron
 *
 * @link       https://debtcollective.org
 * @since      1.0.0
 *
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/admin
 */
namespace WpActionNetworkEvents\App\Cron;

use WpActionNetworkEvents\Common\Abstracts\Base;
use WpActionNetworkEvents\App\Admin\Options;
use WpActionNetworkEvents\App\Integration\Sync;

/**
 * Cron
 *
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/admin
 * @author     Debt Collective <pea@misfist.com>
 */
class Cron extends Base {

	/**
	 * Sync Frequency
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $sync_frequency
	 */
	protected $sync_frequency;

	/**
	 * Source
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $source = 'cron'
	 */
	protected $source = 'cron';

	/**
	 * Cron Schedule Name
	 *
	 * @var string
	 */
	const CRON_SCHEDULE = 'wp_action_network_events_interval';

	/**
	 * Cron Hook Name
	 *
	 * wp_action_network_events\cron_hook
	 *
	 * @var string
	 */
	const CRON_HOOK = 'wp_action_network_events_cron_hook';

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
		$this->sync_frequency = ( isset( $options['sync_frequency'] ) ) ? intval( $options['sync_frequency'] ) : 24;

		\add_action( self::CRON_HOOK, array( $this, 'exec' ) );
		\add_filter( 'cron_schedules', array( $this, 'add_cron_schedule' ) );
	}

	/**
	 * Execute Cron
	 *
	 * @return void
	 */
	public function exec() {
		$sync = new Sync( $this->version, $this->plugin_name );
		var_dump( 'I WAS CALLED' );
		$sync->startSync( $this->source );
	}

	/**
	 * Add Cron Schedule
	 *
	 * @param array $schedules
	 * @return void
	 */
	public function add_cron_schedule( $schedules ) {
		$schedules[ self::CRON_SCHEDULE ] = array(
			'interval' => $this->sync_frequency * HOUR_IN_SECONDS,
			'display'  => sprintf( esc_attr__( 'Every %s Hours', 'wp-action-network-events' ), $this->sync_frequency ),
		);

		return $schedules;
	}

}
