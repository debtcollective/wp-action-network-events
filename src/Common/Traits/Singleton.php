<?php
/**
 * WP Action Network Events
 *
 * @package   WP_Action_Network_Events
 */
namespace WpActionNetworkEvents\Common\Traits;

/**
 * The singleton skeleton trait to instantiate the class only once
 *
 * @package WpActionNetworkEvents\Common\Traits
 * @since 1.0.0
 */
trait Singleton {
	private static $instance;

	/**
	 * @return self
	 * @since 1.0.0
	 */
	final public static function instantiate(): self {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}
