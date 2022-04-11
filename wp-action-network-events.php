<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also src all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://debtcollective.org
 * @since             1.0.3
 * @package           Wp_Action_Network_Events
 *
 * @wordpress-plugin
 * Plugin Name:       WP Action Network Events
 * Plugin URI:        https://github.com/misfist/wp-action-network-events
 * Description:       Sync and display events from Action Network.
 * Version:           1.0.0
 * Author:            Debt Collective
 * Author URI:        https://debtcollective.org
 * License:           GPL-3.0
 * License URI:       http://www.gnu.org/licenses/lgpl-3.0.txt
 * Text Domain:       wp-action-network-events
 * Domain Path:       /languages
 */
namespace WpActionNetworkEvents;

require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

use WpActionNetworkEvents\App\Admin\Options;
use WpActionNetworkEvents\Activator as Activator;
use WpActionNetworkEvents\Deactivator as Deactivator;

/**
 * Autoload Files
 * 
 * @see https://www.php.net/manual/en/function.spl-autoload-register.php
 *
 * @param string $class
 * @return void
 */
function autoloader( $class ) {	
	$base_namespace = 'WpActionNetworkEvents';

	if( !stripos( $class, $base_namespace ) ) {
		$src_dir = 'src';
		$ext = '.php';
		$class = \str_replace( '\\', DIRECTORY_SEPARATOR, $class );
		$path = $src_dir . \str_replace( $base_namespace, '', $class ). $ext;
		
		if ( \file_exists( $path ) ) {
			require_once "$path";

		}
	}
}
// spl_autoload_register( __NAMESPACE__ . '\autoloader' ); 

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
const PLUGIN_NAME = 'wp-action-network-events';
const PLUGIN_VERSION = '1.0.3';

define( 'WPANE_PLUGIN_DIR_PATH', \plugin_dir_path( __FILE__ ) );
define( 'WPANE_PLUGIN_URL', \plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in src/activator.php
 */
function activate_wp_action_network_events() {
	require_once \plugin_dir_path( __FILE__ ) . 'Activator.php';
	Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in src/deactivator.php
 */
function deactivate_wp_action_network_events() {
	require_once \plugin_dir_path( __FILE__ ) . 'Deactivator.php';
	Deactivator::deactivate();
}
\register_activation_hook( __FILE__, __NAMESPACE__ . '\activate_wp_action_network_events' );
\register_deactivation_hook( __FILE__, __NAMESPACE__ . '\deactivate_wp_action_network_events' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function init() {
	$plugin = new Common\Plugin( PLUGIN_VERSION, PLUGIN_NAME, \plugin_basename( __FILE__ ) );
	return $plugin;
}
if( class_exists(  __NAMESPACE__ . '\Common\Plugin' ) ) {
	init();
}