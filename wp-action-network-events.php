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
 * @since             1.0.0
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

require_once( 'vendor/autoload.php' );

spl_autoload_register( __NAMESPACE__ . '\autoloader' );
function autoloader( $class_name ) {
  if ( false !== strpos( $class_name, 'WpActionNetworkEvents' ) ) {
    $classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;
    $class_file = $class_name . '.php';
    require_once $classes_dir . $class_file;
  }
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
const PLUGIN_NAME = 'wp-action-network-events';
const PLUGIN_VERSION = '1.0.0';
define( 'WPANE_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in src/activator.php
 */
function activate_wp_action_network_events() {
	require_once plugin_dir_path( __FILE__ ) . 'Activator.php';
	__NAMESPACE__ . \Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in src/deactivator.php
 */
function deactivate_wp_action_network_events() {
	require_once plugin_dir_path( __FILE__ ) . 'Deactivator.php';
	__NAMESPACE__ . \Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_action_network_events' );
register_deactivation_hook( __FILE__, 'deactivate_wp_action_network_events' );

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
	$plugin = new Common\Plugin( PLUGIN_VERSION, PLUGIN_NAME, plugin_basename( __FILE__ ) );
	return $plugin;
}
if( class_exists(  __NAMESPACE__ . '\Common\Plugin' ) ) {
	init();
}

var_dump( 
	"class_exists( 'Common\Plugin' )", class_exists( 'Common\Plugin' ), 
	"class_exists( 'WpActionNetworkEvents\Common\Plugin' )", class_exists( 'WpActionNetworkEvents\Common\Plugin' ),  
	"class_exists( __NAMESPACE__ . '\Common\Plugin' )", class_exists( __NAMESPACE__ . '\Common\Plugin' )  
);





