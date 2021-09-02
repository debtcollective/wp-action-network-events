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
		$this->api_key = $options['api_key'];
		$this->base_url = $options['base_url'];

		\add_action( 'admin_enqueue_scripts', 							[ $this, 'enqueueScripts' ] );

		\add_action( 'wp_ajax_' . Options::SYNC_ACTION_NAME, 			[ $this, 'fetchData' ] );
		\add_action( 'wp_ajax_nopriv_' . Options::SYNC_ACTION_NAME, 	[ $this, 'fetchData' ] );
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
	public function fetchData() {

		$endpoint = \esc_url( $this->base_url . $this->endpoint );

		$options = [
			'headers' => [
				'Content-Type' 			=> 'application/json',
				'OSDI-API-Token' 		=> $this->api_key,
			],
			'timeout'     => 100,
			'redirection' => 5,
		];

		$options = \wp_parse_args( $args, $options );

		$response = \wp_remote_get( $endpoint, $options );


		\wp_send_json( $response );
		\wp_die();
	}

	/**
	 * Get the data at a given endpoint
	 *
	 * @param string $endpoint
	 * @return mixed (array|WP_Error) The response or WP_Error on failure.
	 */
	public static function getData() {
		var_dump( $this->data );
		// return $this->data;
	}

	/**
	 * Error Message
	 * @temp
	 *
	 * @param string $error
	 * @return void
	 */
	public function errorMessage( $error ) {
		var_dump( $error );
	}

	public function setQuery() {}

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
			// '_wpnonce'			=> \wp_create_nonce( Options::SYNC_ACTION_NAME . '_nonce' ),
			'ajax_url' 		=> \admin_url( 'admin-ajax.php' )
		];

		\wp_localize_script( $this->plugin_name, 'wpANEData', $localized );

		\wp_enqueue_script( $this->plugin_name );
	}
}
