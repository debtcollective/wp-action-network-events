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
 * @since 1.0.0
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
	public const FIELDS = array(
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
		'internal_name',
		'hidden',
	);

	/**
	 * Field Mapping
	 *
	 * @var array
	 */
	public const FIELD_MAP = array(
		'post_title'         => 'title',
		'post_content'       => 'description',
		'post_date'          => 'created_date',
		'post_modified'      => 'modified_date',
		'post_status'        => '',
		'browser_url'        => 'browser_url',
		'_links_to'          => 'browser_url',
		'_links_to_target'   => 'blank',
		'an_id'              => 'identifiers[0]',
		'instructions'       => 'instructions',
		'start_date'         => 'start_date',
		'end_date'           => 'end_date',
		'featured_image'     => 'featured_image_url',
		'location_venue'     => 'location->venue',
		'location_latitude'  => 'location->location->latitude',
		'location_longitude' => 'location->location->longitute',
		'status'             => 'status',
		'visibility'         => 'visibility',
		'an_campaign_id'     => 'action_network:event_campaign_id',
		'internal_name'      => 'name',
		'hidden'             => 'action_network:hidden',
	);

	/**
	 * Field Mapping
	 *
	 * @var array
	 */
	public const FIELD_MAP = array(
		'post_title'         => 'title',
		'post_content'       => 'description',
		'post_date'          => 'created_date',
		'post_modified'      => 'modified_date',
		'post_status'        => '',
		'browser_url'        => 'browser_url',
		'_links_to'          => 'browser_url',
		'_links_to_target'   => 'blank',
		'an_id'              => 'identifiers[0]',
		'instructions'       => 'instructions',
		'start_date'         => 'start_date',
		'end_date'           => 'end_date',
		'featured_image'     => 'featured_image_url',
		'location_venue'     => 'location->venue',
		'location_latitude'  => 'location->location->latitude',
		'location_longitude' => 'location->location->longitute',
		'status'             => 'status',
		'visibility'         => 'visibility',
		'an_campaign_id'     => 'action_network:event_campaign_id',
		'internal_name'      => 'name',
	);

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
		\add_action( 'init', array( $this, 'registerPostMeta' ) );

		/**
		 * Don't hide custom fields meta box
		 *
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

		foreach ( self::FIELDS as $field ) {
			if ( 'hidden' === $field ) {
				\register_post_meta(
					Event::POST_TYPE['id'],
					$field,
					array(
						'show_in_rest' => true,
						'single'       => true,
						'type'         => 'boolean',
					)
				);
			} else {
				\register_post_meta(
					Event::POST_TYPE['id'],
					$field,
					array(
						'show_in_rest' => true,
						'single'       => true,
						'type'         => 'string',
					)
				);
			}
		}
	}

	/**
	 * Build list of timezones
	 *
	 * @return $array
	 */
	public function getTimezones() {
		$timezones = \DateTimeZone::listIdentifiers();
		$array     = array();

		$count = count( $timezones );
		for ( $i = 0; $i <= $count; $i++ ) {
			if ( ! empty( $timezones[ $i ] ) ) {
				$array[ $timezones[ $i ] ] = str_replace( '_', ' ', $timezones[ $i ] );
			}
		}

		return $array;
	}
}
