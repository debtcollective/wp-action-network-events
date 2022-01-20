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
 * @since 1.0.0
 */
class GetEvents extends GetData {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $version, $plugin_name, $args = array() ) {
		$this->endpoint = 'events';
		parent::__construct( $version, $plugin_name, $this->endpoint, $args );
	}

}
