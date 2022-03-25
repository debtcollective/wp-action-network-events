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
	 * Plugin Options
	 *
	 * @since 1.0.1
	 * 
	 * @var array
	 */
	protected $options;

	/**
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		/**
		 * This general class is always being instantiated as requested in the Bootstrap class
		 */
		$this->options                        = \get_option( Options::OPTIONS_NAME );
	}

	/**
	 * Query Events
	 *
	 * @since 1.0.1
	 *
	 * @link https://developer.wordpress.org/apis/handbook/transients/
	 *
	 * @param string $scope
	 * @param array  $args
	 * @return array \WP_Post
	 */
	public function getEvents( $scope = 'all', $args = array() ): array {
		global $post;

		$transient_id = self::QUERY_TRANSIENT . '_objects_' . $scope;
		$query_transient_duration = isset( $this->options['query_cache_duration'] ) ? (int) $this->options['query_cache_duration'] : (int) 1;

		if ( false === ( $query = \get_transient( $transient_id ) ) ) {

			$date_time = new \DateTime();
			$sort      = ( $sort = \get_post_meta( get_the_ID(), 'event_sort', true ) ) ? strtoupper( \esc_attr( $sort ) ) : 'DESC';
			$scope     = ( $event_scope = \get_post_meta( \get_the_ID(), 'event_scope', true ) ) ? $event_scope : $scope;

			$defaults = array(
				'post_type'      => array( Event::POST_TYPE['id'] ),
				'posts_per_page' => 500,
				'orderby'        => 'meta_value',
				'order'          => $sort,
				'meta_key'       => 'start_date',
				'meta_type'      => 'DATETIME',
				'meta_query'     => array(
					array(
						'relation' => 'OR',
						array(
							'key'     => 'is_hidden',
							'compare' => 'NOT EXISTS',
						),
						array(
							'key'     => 'is_hidden',
							'value'   => array( '1', true ),
							'compare' => 'NOT IN',
						),
					),
					array(
						'relation' => 'OR',
						array(
							'key'     => 'hidden',
							'compare' => 'NOT EXISTS',
						),
						array(
							'key'     => 'hidden',
							'value'   => array( '1', true ),
							'compare' => 'NOT IN',
						),
					),
					array(
						'key'     => 'visibility',
						'value'   => 'private',
						'compare' => '!=',
					),
				),
			);

			$args = \wp_parse_args( $args, $defaults );

			if ( isset( $this->options['hide_canceled'] ) && 'checked' == $this->options['hide_canceled'] ) {
				$args['post_status'] = array( 'publish' );
			}

			if ( 'future' === $scope ) {
				$args['meta_query'][] = array(
					'key'     => 'start_date',
					'value'   => $date_time->format( 'c' ),
					'compare' => '>',
				);
			} elseif ( 'past' === $scope ) {
				$args['meta_query'][] = array(
					'key'     => 'start_date',
					'value'   => $date_time->format( 'c' ),
					'compare' => '<',
				);
			}

			$query = new \WP_Query( $args );

			\set_transient( $transient_id, $query->posts, (int) $query_transient_duration * HOUR_IN_SECONDS );

			return $query->posts;
		}

		return $query;
	}

	/**
	 * Query Event IDs
	 *
	 * @since 1.0.1
	 *
	 * @link https://developer.wordpress.org/apis/handbook/transients/
	 *
	 * @param string $scope
	 * @param array  $args
	 * @return array \WP_Post()->ID
	 */
	public function getEventIds( $scope = 'all', $args = array() ): array {
		global $post;

		$transient_id = self::QUERY_TRANSIENT . '_ids_' . $scope;
		$query_transient_duration = isset( $this->options['query_cache_duration'] ) ? (int) $this->options['query_cache_duration'] : (int) 1;

		if ( false === ( $query = \get_transient( $transient_id ) ) ) {

			$date_time = new \DateTime();
			$scope     = ( $event_scope = \get_post_meta( \get_the_ID(), 'event_scope', true ) ) ? $event_scope : $scope;

			$defaults = array(
				'post_type'      => array( Event::POST_TYPE['id'] ),
				'posts_per_page' => 500,
				'fields'         => 'ids',
				'meta_query'     => array(
					array(
						'relation' => 'OR',
						array(
							'key'     => 'is_hidden',
							'compare' => 'NOT EXISTS',
						),
						array(
							'key'     => 'is_hidden',
							'value'   => array( '1', true ),
							'compare' => 'NOT IN',
						),
					),
					array(
						'relation' => 'OR',
						array(
							'key'     => 'hidden',
							'compare' => 'NOT EXISTS',
						),
						array(
							'key'     => 'hidden',
							'value'   => array( '1', true ),
							'compare' => 'NOT IN',
						),
					),
					array(
						'key'     => 'visibility',
						'value'   => 'private',
						'compare' => '!=',
					),
				),
			);

			$args = \wp_parse_args( $args, $defaults );

			if ( isset( $this->options['hide_canceled'] ) && 'checked' == $this->options['hide_canceled'] ) {
				$args['post_status'] = array( 'publish' );
			}

			if ( 'future' === $scope ) {
				$args['meta_query'][] = array(
					'key'     => 'start_date',
					'value'   => $date_time->format( 'c' ),
					'compare' => '>',
				);
			} elseif ( 'past' === $scope ) {
				$args['meta_query'][] = array(
					'key'     => 'start_date',
					'value'   => $date_time->format( 'c' ),
					'compare' => '<',
				);
			}

			$query = new \WP_Query( $args );

			\set_transient( $transient_id, $query->posts, (int) $query_transient_duration * HOUR_IN_SECONDS );

			return $query->posts;
		}

		return $query;
	}

	/**
	 * Get Events
	 *
	 * @since 1.0.1
	 *
	 * @param string $scope
	 * @param array  $args
	 * @return void
	 */
	static function getAnEvents( $scope = 'all', $args = array() ) {
		$call = new Queries( PLUGIN_VERSION, PLUGIN_NAME );
		return $call->getEvents( $scope, $args );
	}

	/**
	 * Get Event IDs
	 *
	 * @since 1.0.1
	 *
	 * @param string $scope
	 * @param array  $args
	 * @return void
	 */
	static function getAnEventIds( $scope = 'all', $args = array() ) {
		$call = new Queries( PLUGIN_VERSION, PLUGIN_NAME );
		return $call->getEventIds( $scope, $args );
	}

}
