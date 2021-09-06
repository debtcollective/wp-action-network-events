<?php
/**
 * WP Action Network Events
 *
 * @package   WP_Action_Network_Events
 */
namespace WpActionNetworkEvents\App\General;

use WpActionNetworkEvents\Common\Abstracts\Base;
use WpActionNetworkEvents\App\General\Taxonomies\Taxonomies;
use WpActionNetworkEvents\App\General\PostTypes\Event;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Helper\Helper;

/**
 * Class CustomFields
 *
 * @package WpActionNetworkEvents\App\General
 * @since 0.1.0
 */
class CustomFields extends Base {

	/**
	 * Metabox Container ID
	 * 
	 * @since 1.0.0
	 */
	public const CONTAINER_ID = 'wp_action_network_fields';

	/**
	 * Custom fields
	 */
	public const FIELDS = [
		'browser_url',
		'an_id',
		'instructions',
		'start_date',
		'end_date',
		'timezone',
		'featured_image',
		'location_venue',
		'location_latitude',
		'location_longitude',
		'status',
		'visibility',
		'an_campaign_id'
	];

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
	 * @since 0.1.0
	 */
	public function init() {
		/**
		 * This general class is always being instantiated as requested in the Bootstrap class
		 *
		 * @see Bootstrap::__construct
		 *
		 */
		\add_action( 'init',							[ $this, 'registerPostMeta' ] );

		/**
		 * Don't hide custom fields meta box
		 * @see https://www.advancedcustomfields.com/resources/acf-settings/
		 */
		\add_filter( 'acf/settings/remove_wp_meta_box', '__return_false' );

		// \add_action( 'plugins_loaded', 					[ $this, 'load' ] );
		// \add_action( 'carbon_fields_register_fields', 	[ $this, 'addFields' ] );

		/**
		 * API Fields
		 * identifiers[0],
		 * title (core - title),
		 * name,
		 * browser_url,
		 * featured_image_url (core - featured image),
		 * instructions,
		 * description (core - content ),
		 * start_date,
		 * end_date,
		 * created_date,
		 * modified_date,
		 * location.venue,
		 * location.location.latitude,
		 * location.location.longitude,
		 * status ["confirmed" "tentative" "cancelled"] 
		 * visibility ["public" "private"]
		 * action_network:event_campaign_id 
		 */
	}

	/**
	 * Load Fields Library
	 *
	 * @return void
	 */
	public function load() {
		\Carbon_Fields\Carbon_Fields::boot();
	}

	/**
	 * Add Custom Fields
	 *
	 * @since 0.1.0
	 */
	public function addFields() {

		$is_read_only = false;

		$default_timezone = get_option( 'timezone_string' );

		$fields = [
			Field::make( 'text', 'name', __( 'Name', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only ),
			Field::make( 'rich_text', 'instructions', __( 'Instructions', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only ),
			Field::make( 'text', 'browser_url', __( 'URL', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only )
				->set_attribute( 'type', 'url' ),
			Field::make( 'text', 'start_date', __( 'Start', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only ),
			Field::make( 'text', 'end_date', __( 'End', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only ),
			Field::make( 'select', 'time_zone', __( 'Time Zone', 'wp-action-network-events' ) )
				->add_options( [ $this, 'getTimezones' ] )
				->set_default_value( $default_timezone )
				->set_visible_in_rest_api( $visible = true ),

			Field::make( 'separator', 'separator_location', __( 'Location Detail', 'wp-action-network-events' ) ),
			Field::make( 'text', 'location_venue', __( 'Venue', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only ),
			Field::make( 'text', 'location_locality', __( 'Locality', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only ),
			Field::make( 'text', 'location_address', __( 'Address', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only ),
			Field::make( 'text', 'location_postal_code', __( 'Postal Code', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only ),
			Field::make( 'text', 'location_region', __( 'Region', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only ),
			Field::make( 'text', 'location_country', __( 'Country', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only ),
			Field::make( 'text', 'location_longitude', __( 'Longitude', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only ),
			Field::make( 'text', 'location_latitude', __( 'Latitude', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only ),
			Field::make( 'text', 'location_accuracy', __( 'Accuracy', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only ),
			
			Field::make( 'separator', 'separator_campaign', __( 'Campaign Details', 'wp-action-network-events' ) ),
			Field::make( 'text', 'an_campaign_id', __( 'Campaign ID', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only ),

			Field::make( 'separator', 'separator_misc', __( 'Misc Details', 'wp-action-network-events' ) ),
			Field::make( 'text', 'an_id', __( 'ID', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only ),
			Field::make( 'text', 'modified_date', __( 'Modified Date', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only ),
			Field::make( 'text', 'status', __( 'Status', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only ),
			Field::make( 'text', 'visibility', __( 'Visibility', 'wp-action-network-events' ) )
				->set_visible_in_rest_api( $visible = true )
				->set_attribute( 'readOnly', $is_read_only ),
		];

		Container::make( 
			'post_meta',
			self::CONTAINER_ID,
			__( 'Event Details', 'wp-action-network-events' ) 
		)
			->where( 'post_type', '=', Event::POST_TYPE['id'] )
			->set_context( 'advanced' )
			->add_fields( $fields );
	}

	/**
	 * Register post meta with Rest API
	 * 
	 * @see https://developer.wordpress.org/reference/functions/register_post_meta/
	 *
	 * @return void
	 */
	public function registerPostMeta() {

		foreach( self::FIELDS as $field ) {
			\register_post_meta(
				Event::POST_TYPE['id'], 
				$field, [
					'show_in_rest' 	=> true,
					'single' 		=> true,
					'type' 			=> 'string',
				]
			);
		}
	}

	public static function getFields() {}

	/**
	 * Build list of timezones
	 *
	 * @return $array
	 */
	public function getTimezones() {
		$timezones = \DateTimeZone::listIdentifiers();
		$array = [];

		$count = count( $timezones );
		for( $i = 0; $i <= $count; $i++ ) {
			if( !empty( $timezones[$i] ) ) {
				$array[$timezones[$i]] = str_replace( '_', ' ', $timezones[$i] );
			}
		}
	
		return $array;
	}
}
