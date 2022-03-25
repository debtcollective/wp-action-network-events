<?php
/**
 * WP Action Network Events
 *
 * @package   WP_Action_Network_Events
 */
namespace WpActionNetworkEvents\App\General;

use WpActionNetworkEvents\Common\Abstracts\Base;
use WpActionNetworkEvents\App\General\PostTypes\Event;
use WpActionNetworkEvents\App\Admin\Options;
use const WpActionNetworkEvents\PLUGIN_VERSION;
use const WpActionNetworkEvents\PLUGIN_NAME;

/**
 * Class Queries
 *
 * @package WpActionNetworkEvents\App\General
 * @since 1.0.0
 */
class Queries extends Base {

	/**
	 * Transient ID
	 *
	 * @since 1.0.1
	 */
	const QUERY_TRANSIENT = 'wp_an_events';

	/**
	 * Transitient Duration
	 *
	 * @since 1.0.1
	 *
	 * @var int
	 */
	public $query_transient_duration = 1;

	/**
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		/**
		 * This general class is always being instantiated as requested in the Bootstrap class
		 */
		$options                        = \get_option( Options::OPTIONS_NAME );
		$this->query_transient_duration = isset( $options['query_cache_duration'] ) ? (int) $options['query_cache_duration'] : (int) 1;

	}

	/**
	 * @param $posts_count
	 * @param string $orderby
	 * @return \WP_Query
	 */
	public function getPosts( $posts_count, $orderby = 'date' ): \WP_Query {
		return new \WP_Query(
			[
				'post_type'      => PostTypes::POST_TYPE['id'],
				'post_status'    => 'publish',
				'order'          => 'DESC',
				'posts_per_page' => $posts_count,
				'orderby'        => $orderby,
			]
		);
	}

	/**
	 * Example
	 *
	 * @return array
	 */
	public function getPostIds(): array {
		global $wpdb;
		return $wpdb->get_col( "select ID from {$wpdb->posts} LIMIT 3" );
	}
}
