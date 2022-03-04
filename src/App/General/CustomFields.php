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
		'is_an_event',
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
		\add_action( 'acf/input/admin_enqueue_scripts', array( $this, 'enqueueScripts' ), 10, 0 );
		\add_action( 'init', array( $this, 'registerPostMeta' ) );
		\add_action( 'acf/init', array( $this, 'registerACFFields' ) );

		\add_filter( 'acf/load_field/name=is_an_event', array( $this, 'modifyBoolean' ) );
		\add_filter( 'acf/load_field/name=timezone', array( $this, 'modifyTimezone' ) );
		\add_filter( 'acf/load_field/name=start_date', array( $this, 'displayDateTimePicker' ) );
		\add_filter( 'acf/load_field/name=end_date', array( $this, 'displayDateTimePicker' ) );
		\add_filter( 'acf/load_field/name=browser_url', array( $this, 'enableField' ) );
		\add_filter( 'acf/load_field/name=location_venue', array( $this, 'enableField' ) );

		/**
		* Don't hide custom fields meta box
		*
		* @see https://www.advancedcustomfields.com/resources/acf-settings/
		*/
		// \add_filter( 'acf/settings/remove_wp_meta_box', '__return_false' );
	}

	/**
	 * Display Fields with ACF
	 * If ACF is active, display as readonly fields using ACF UI
	 *
	 * @link https://www.advancedcustomfields.com/resources/register-fields-via-php/
	 *
	 * @return void
	 */
	public function registerACFFields() {
		$fields = array_map(
			function( $field ) {
				return array(
					'key'               => 'field_' . $field,
					'label'             => ucwords( str_replace( '_', ' ', $field ) ),
					'name'              => $field,
					'disabled'          => 1,
					'type'              => 'text',
					'required'          => 0,
					'conditional_logic' => 0,
				);
			},
			self::FIELDS
		);
		\acf_add_local_field_group(
			array(
				'key'                   => 'group_event_fields',
				'title'                 => __( 'Event Fields', 'wp-action-network-events' ),
				'fields'                => $fields,
				'location'              => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => Event::POST_TYPE['id'],
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => true,
				'description'           => '',
				'show_in_rest'          => 0,
			)
		);
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
			\register_post_meta(
				Event::POST_TYPE['id'],
				$field,
				array(
					'show_in_rest' => true,
					'single'       => true,
					'type'         => ( 'is_an_event' === $field ) ? 'boolean' : 'string',
				)
			);
		}
	}

	/**
	 * Modify boolean field
	 *
	 * @link https://www.advancedcustomfields.com/resources/acf-load_field/
	 *
	 * @param array $field
	 * @return array $field
	 */
	public function modifyBoolean( $field ) {
		$field['type']          = 'true_false';
		$field['label']         = __( 'Action Network Event', 'wp-action-network-events' );
		$field['ui']            = 1;
		$field['ui_on_text']    = '';
		$field['ui_off_text']   = '';
		$field['message']       = '';
		$field['default_value'] = 0;
		return $field;
	}

	/**
	 * Modify timezone field
	 *
	 * @link https://www.advancedcustomfields.com/resources/acf-load_field/
	 *
	 * @param array $field
	 * @return array $field
	 */
	public function modifyTimezone( $field ) {
		$field['disabled'] = 0;
		$field['required'] = 1;
		$field['default_value'] = \get_option( 'timezone_string' );
		return $field;
	}

	/**
	 * Enable fields
	 * Enable fields is an AN event
	 *
	 * @link https://www.advancedcustomfields.com/resources/acf-load_field/
	 *
	 * @param array $field
	 * @return array $field
	 */
	public function enableField( $field ) {
		$is_an_event = \get_post_meta( \get_the_ID(), 'is_an_event', true );
		if ( ! $is_an_event ) {
			$field['disabled'] = 0;
		}
		return $field;
	}

	/**
	 * Display as DateTime Picker
	 * 
	 *  @link https://www.advancedcustomfields.com/resources/acf-load_field/
	 *
	 * @param array $field
	 * @return array $field
	 */
	public function displayDateTimePicker( $field ) {
		$is_an_event = \get_post_meta( \get_the_ID(), 'is_an_event', true );
		if ( ! $is_an_event ) {
			$field['disabled'] = 0;
			$field['type'] = 'date_time_picker';
			$field['required'] = 1;
			$field['display_format'] = 'm/d/Y g:i a';
			$field['return_format'] = 'Y-m-d H:i:s';
			$field['first_day'] = 1;
		}
		return $field;
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

	/**
	 * Load ACF JS
	 *
	 * @return void
	 */
	public function enqueueScripts() {
		\wp_enqueue_script( $this->plugin_name . '-acf', \esc_url( WPANE_PLUGIN_URL . 'assets/public/js/acf.js' ), array(), $this->version, false );
	}
}
