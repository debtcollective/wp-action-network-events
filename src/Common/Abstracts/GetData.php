<?php
/**
 * WP Action Network Events
 *
 * @package   WP_Action_Network_Events
 */
namespace WpActionNetworkEvents\Common\Abstracts;

use WpActionNetworkEvents\App\Admin\Options;

/**
 * The Data class which can be extended by other classes to load in default methods
 *
 * @package WpActionNetworkEvents\Common\Abstracts
 * @since 1.0.0
 */
abstract class GetData {

	/**
	 * Base URL
	 *
	 * @var string
	 */
	private $base_url;

	/**
	 * API Key.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string   $api_key
	 */
	protected $api_key;

	/**
	 * Endpoint.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string   $endpoint
	 */
	protected $endpoint;

	/**
	 * Array of args.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array   $args
	 */
	protected $args;

	/**
	 * Array of data.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array   $data
	 */
	protected $data;

	/**
	 * Array of errors
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array   $errors
	 */
	protected $errors;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Data constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( string $endpoint, array $args = [], string $version , string $plugin_name ) {
		$this->endpoint = $endpoint;
		$this->args = $args;
		$this->version = $version;
		$this->plugin_name = $plugin_name;
		$options = Options::getOptions();
		if( $options && $options['api_key'] && $options['base_url'] ) {
			$this->api_key = $options['api_key'];
			$this->base_url = $options['base_url'];
			$this->data = $this->getCollection();
		} else {
			$this->handleError( 'Options not set' );
		}

	}

	/**
	 * Kick it off
	 *
	 * @return void
	 */
	public function init() {
		$this->registerEventTypeOptions();
	}

	/**
	 * Get Data
	 *
	 * @see https://developer.wordpress.org/reference/functions/wp_remote_get/
	 *
	 * @return mixed (array|WP_Error) The response or WP_Error on failure.
	 */
	public function getRequest( $page = 1, $params = '' ) {
		$endpoint = \esc_url( $this->base_url . $this->endpoint . $params );

		$options = [
			'headers' => [
				'Content-Type' 			=> 'application/json',
				'OSDI-API-Token' 		=> $this->api_key,
			],
			'timeout'     				=> 100,
			'redirection' 				=> 5,
			'body'						=> [
				'page'					=> $page
			],
		];

		$response = \wp_remote_get( $endpoint, $options );

		return $response;
	}

	/**
	 * Get Entire Collection
	 * If multiple pages, get all
	 *
	 * @return void
	 */
	abstract public function getCollection() : array;

	/**
	 * Get the response body
	 *
	 * @see https://developer.wordpress.org/reference/functions/wp_remote_retrieve_body/
	 *
	 * @return mixed (array|WP_Error) The response or WP_Error on failure.
	 */
	public function getResponseBody( $page = 1, $params = '' ) {
		$response = $this->getRequest( $page, $params );
		if ( empty( $response ) || ! is_wp_error( $response ) ) {
			return $this->handleError( $response );
		}
		$body = wp_remote_retrieve_body( $response );
		return json_decode( $body );
	}

	/**
	 * Get the response code
	 *
	 * @see https://developer.wordpress.org/reference/functions/wp_remote_retrieve_response_code/
	 *
	 * @return mixed (array|WP_Error) The response or WP_Error on failure.
	 */
	public function getResponseCode( $response ) {
		return wp_remote_retrieve_response_code( $response );
	}

	/**
	 * Get the response pages
	 *
	 * @return mixed (array|WP_Error) The response or WP_Error on failure.
	 */
	public function getResponsePages() {
		$response = $this->getResponseBody();
		if( empty( $response ) || !is_wp_error( $response ) ) {
			return $this->handleError( $response );
		}
		return $response->total_pages;
	}

	/**
	 * Get the data at a given endpoint
	 *
	 * @param string $endpoint
	 * @return mixed (array|WP_Error) The response or WP_Error on failure.
	 */
	public static function getData() {
		return $this->data;
	}

	/**
	 * Handle Errors
	 *
	 * @return void
	 */
	function handleError( $exception ) {
		$this->errors[] = $exception;
		// throw new \Exception( $exception );
	}

	/**
	 * Register Resource Type
	 * Will be added to the list of types available on Options page
	 *
	 * @return void
	 */
	public function registerEventTypeOptions() {
		$new_types = $this->args['types'];
		$current_types = Options::getEventTypeOptions();
		if( !array_key_exists( $this->endpoint, $current_types ) ) {
			Options::registerEventTypeOptions( $this->types );
		}
	}

	/**
	 * Enqueue Scripts
	 * 
	 * @see https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
	 *
	 * @return void
	 */
	public function enqueueScripts() {
		\wp_register_script( $this->plugin_name, esc_url( WPANE_PLUGIN_URL . 'assets/public/js/backend.js' ), array( 'jquery' ), $this->version, false );

		$localized = [
			'action'		=> Options::SYNC_ACTION_NAME,
			'endpoint'		=> $this->endpoint,
			'ajax_url' 		=> \admin_url( 'admin-ajax.php' )
		];

		\wp_localize_script( $this->plugin_name, 'wpANEData', $localized );

		\wp_enqueue_script( $this->plugin_name );
	}
}
