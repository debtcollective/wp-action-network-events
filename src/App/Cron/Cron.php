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



// use WpActionNetworkEvents\App\General\PostTypes\Event;
// use WpActionNetworkEvents\App\Integration\GetEvents;
// use WpActionNetworkEvents\App\Integration\Parse;
// use WpActionNetworkEvents\App\Integration\Process;

/**
 * Cron
 *
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/admin
 * @author     Debt Collective <pea@misfist.com>
 */
class Cron extends Base {

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
	 * Source
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $source = 'cron'
	 */
	protected $source = 'cron';

	/**
	 * Cron Hook Name
	 * 
	 * wp_action_network_events\cron_hook
	 *
	 * @var string
	 */
	const CRON_HOOK = 'wp_action_network_events\cron_hook';

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

			
		\add_action( self::CRON_HOOK, array( $this, 'exec' ) );
	}

	/**
	 * Execute Cron
	 *
	 * @return void
	 */
	public function exec() {
		$sync = new Sync( $this->version, $this->plugin_name );
		$sync->startSync( $this->source );
	}

}
