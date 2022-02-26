<?php
/**
 * Fired during plugin deactivation
 *
 * @link       https://debtcollective.org
 * @since      1.0.0
 *
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/src
 */
namespace WpActionNetworkEvents;

use WpActionNetworkEvents\App\Cron\Cron;

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/src
 * @author     Debt Collective <pea@misfist.com>
 */
class Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		\flush_rewrite_rules();

		\update_option( 'wp_action_network_events_active', false );

		\wp_clear_scheduled_hook( Cron::CRON_HOOK );
	}

}
