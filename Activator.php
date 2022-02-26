<?php
/**
 * Fired during plugin activation
 *
 * @link       https://debtcollective.org
 * @since      1.0.0
 *
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/src
 */
namespace WpActionNetworkEvents;

use WpActionNetworkEvents\App\Cron\Cron;
use WpActionNetworkEvents\App\Admin\Options;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/src
 * @author     Debt Collective <pea@misfist.com>
 */
class Activator {

	/**
	 * Activator
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		\flush_rewrite_rules();

		\update_option( 'wp_action_network_events_active', true );

		if ( ! \wp_next_scheduled( Cron::CRON_HOOK ) ) {
			\wp_schedule_event( time(), Cron::CRON_SCHEDULE, Cron::CRON_HOOK );
		}
	}

}
