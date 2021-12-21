<?php
/**
 * WP Action Network Events
 *
 * @package WP_Action_Network_Events
 */
namespace WpActionNetworkEvents\App\Integration;

use WpActionNetworkEvents\Common\Abstracts\Base;
use WpActionNetworkEvents\App\General\PostTypes\PostTypes;
use WpActionNetworkEvents\App\General\PostTypes\Event;
use WpActionNetworkEvents\App\Integration\Sync;

/**
 * Class RestAPI
 *
 * @package WpActionNetworkEvents\App\Integration
 * @since   1.0.0
 */
class RestAPI extends Base {

	/**
	 * Rest endpoint namespace
	 *
	 * @var string
	 */
	const NAMESPACE = 'wp-action-network-events/v1';

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
		\add_filter( 'rest_query_vars', [ $this, 'rest_query_vars' ] );
		\add_filter( 'rest_' . Event::POST_TYPE['id'] . '_query', [ $this, 'rest_query_start_date' ], 10, 2 );
		\add_filter( 'rest_' . Event::POST_TYPE['id'] . '_collection_params', [ $this, 'rest_collection_params' ], 10, 2 );

		\add_action( 'rest_api_init', array( $this, 'register_routes' ) );

	}

	/**
	 * Add rest query variables
	 *
	 * @param  array $current_vars
	 * @return array
	 */
	public function rest_query_vars( $current_vars ) {
		$current_vars = array_merge( $current_vars, array( 'meta_key', 'scope' ) );
		return $current_vars;
	}

	/**
	 * Modify query
	 * Orderby `meta_value` if `orderby=start` is passed
	 *
	 * @see https://developer.wordpress.org/reference/hooks/rest_this-post_type_query/
	 *
	 * @param  array $params
	 * @param  obj   $request
	 * @return array $params
	 */
	public function rest_query_start_date( $params, $request ) {
		if ( isset( $request['orderby'] ) && 'start' === $request['orderby'] ) {
			$params['orderby']  = 'meta_value';
			$params['meta_key'] = 'start_date';
		}
		if ( isset( $request['scope'] ) && 'all' !== $request['scope'] ) {
			$compare = '>=';
			if ( 'past' === $request['scope'] ) {
				$compare = '<';
			}
			$params['meta_query'] = [
				[
					'key'     => 'start_date',
					'value'   => \date( 'c' ),
					'compare' => $compare,
					'type'    => 'DATETIME',
				],
			];
		}
		return $params;
	}

	/**
	 * Register collection parameters
	 * Add `start` as valid value for `orderby`
	 * Add `scope` parameter
	 *
	 * @see https://developer.wordpress.org/reference/hooks/rest_this-post_type_collection_params/
	 *
	 * @param  array  $params
	 * @param  string $post_type
	 * @return void
	 */
	public function rest_collection_params( $params, $post_type ) {
		array_push( $params['orderby']['enum'], 'start' );
		$params['scope'] = [
			'description' => __( 'Limit scope of events to future or past.', 'wp-action-network-events' ),
			'type'        => 'string',
			'default'     => 'future',
			'enum'        => [
				'future',
				'past',
				'all',
			],
		];
		return $params;
	}

		/**
	 * Register routes
	 * 
	 * @link https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/
	 * 
	 * @since 0.1.6
	 *
	 * @return void
	 */
	public function register_routes() {
		$sync = new Sync( $this->version, $this->plugin_name  );

		\register_rest_route( self::NAMESPACE, '/remote-events', array(
			'methods' 				=> 'POST',
			'callback' 				=> array( $sync, 'webhook' ),
			'permission_callback' 	=> function() {
				return \current_user_can( 'manage_options' );
			}
		) );
	}

}
