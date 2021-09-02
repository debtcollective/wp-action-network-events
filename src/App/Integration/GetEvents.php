<?php
/**
 * WP Action Network Events
 *
 * @package   WP_Action_Network_Events
 */
namespace WpActionNetworkEvents\App\Integration;

use WpActionNetworkEvents\Common\Abstracts\GetData;

/**
 * Class GetData
 *
 * @package WpActionNetworkEvents\App\General
 * @since 0.1.0
 */
class GetEvents extends GetData {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $version, $plugin_name ) {
		$this->endpoint = 'events';
		$this->args = [];
		parent::__construct( $this->endpoint, $this->args, $version, $plugin_name );
	}

	/**
	 * Initialize the class.
	 *
	 * @since 0.1.0
	 */
	// public function init() {
	// 	/**
	// 	 * This general class is always being instantiated as requested in the Bootstrap class
	// 	 *
	// 	 * @see Bootstrap::__construct
	// 	 *
	// 	 */

	// }

}
