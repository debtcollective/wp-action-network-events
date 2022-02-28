<?php
/**
 * WP Action Network Events
 *
 * @package   WP_Action_Network_Events
 */
namespace WpActionNetworkEvents\App\General;

use WpActionNetworkEvents\Common\Abstracts\Base;
use WpActionNetworkEvents\App\General\PostTypes\Event;

/**
 * Class ContentFilters
 *
 * @package WpActionNetworkEvents\App\General
 * @since 1.0.0
 */
class ContentFilters extends Base {


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
		if ( ! class_exists( '\CWS_PageLinksTo' ) ) {
			\add_filter( 'post_link', array( $this, 'modifyEventUrl' ), 10, 2 );
			\add_filter( 'post_type_link', array( $this, 'modifyEventUrl' ), 10, 2 );
		}
		\add_filter( 'post_row_actions', array( $this, 'hideViewLink' ), 10, 2 );

	}

	/**
	 * Change Event URL to Action Network URL
	 * Modify link to Action Network URL;
	 * Let Page Links To <https://wordpress.org/plugins/page-links-to/> handle this, if it is available
	 *
	 * @param string $url
	 * @param obj    $post
	 * @return string $url
	 */
	public function modifyEventUrl( $url, $post ) {
		if ( ( Event::POST_TYPE['id'] === \get_post_type( $post->ID ) ) &&
			( $external_url = \get_post_meta( $post->ID, 'browser_url', 'true' ) )
		) {
			$url = \esc_url( $external_url );
		}
		return $url;
	}

	/**
	 * Hide View Link
	 * If the event is hidden, don't display the View link in the post list
	 * 
	 * @link https://developer.wordpress.org/reference/hooks/post_row_actions/
	 *
	 * @param array   $actions
	 * @param WP_Post $post
	 * @return array $actions
	 */
	public function hideViewLink( $actions, $post ) : array {
		if ( Event::POST_TYPE['id'] === $post->post_type && true == \get_post_meta( $post->ID, 'hidden', true ) ) {
			unset( $actions['view'] );
		}
		return $actions;
	}

}
