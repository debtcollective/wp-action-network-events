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
		'an_campaign_id',
		'internal_name'
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
