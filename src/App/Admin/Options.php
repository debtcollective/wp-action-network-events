<?php

/**
 * The plugin options.
 *
 * @link       https://debtcollective.org
 * @since      1.0.0
 *
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/admin
 */
namespace WpActionNetworkEvents\App\Admin;

use WpActionNetworkEvents\Common\Abstracts\Base;
use WpActionNetworkEvents\App\Admin\Notices;

/**
 * Plugin Options
 *
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/admin
 * @author     Debt Collective <pea@misfist.com>
 */
class Options extends Base {

	/**
	 * Name of options field
	 *
	 * @var string
	 */
	const OPTIONS_NAME = 'wp_action_network_events_options';

	/**
	 * Name of sync action
	 *
	 * @var string
	 */
	const SYNC_ACTION_NAME = 'wp_action_network_events_sync';

	/**
	 * ID of Options page
	 *
	 * @var string
	 */
	const OPTIONS_PAGE_NAME = 'options-wp-action-network-events';

	/**
	 * Plugin Options
	 *
	 * @var array
	 */
	protected $options;

	/**
	 * Available Event Types
	 *
	 * @var array
	 */
	protected $eventTypeOptions = array();

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $version, $plugin_name, $basename ) {
		parent::__construct( $version, $plugin_name, $basename );
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
		$this->setOptions();
		\add_action( 'admin_menu', array( $this, 'addAdminMenu' ) );
		\add_action( 'admin_init', array( $this, 'initSettings' ) );
		\add_filter( 'plugin_action_links_' . $this->basename, array( $this, 'addSettingsLink' ), 10, 5 );

		$this->eventTypeOptions = apply_filters(
			__NAMESPACE__ . '\Options\eventTypeOptions',
			array(
				'events' => \esc_attr__( 'Events', 'wp-action-network-events' ),
			)
		);

		$notices = new Notices( $this->version, $this->plugin_name );
	}

	/**
	 * Add Admin Menu
	 *
	 * @return void
	 */
	public function addAdminMenu() {

		\add_options_page(
			\esc_html__( 'Action Network Events Settings', 'wp-action-network-events' ),
			\esc_html__( 'Action Network Events', 'wp-action-network-events' ),
			'activate_plugins',
			self::OPTIONS_PAGE_NAME,
			array( $this, 'renderPage' )
		);

		add_submenu_page(
			'edit.php?post_type=event',
			\esc_html__( 'Action Network Events Settings', 'wp-action-network-events' ),
			\esc_html__( 'Settings', 'wp-action-network-events' ),
			'activate_plugins',
			self::OPTIONS_PAGE_NAME,
			array( $this, 'renderPage' )
		);

	}

	/**
	 * Add Settings Link to Plugins Page
	 *
	 * @see https://developer.wordpress.org/reference/hooks/plugin_action_links_plugin_file/
	 *
	 * @param array  $actions
	 * @param string $plugin_file
	 * @return array $actions
	 */
	function addSettingsLink( array $actions ) : array {
		$link = array(
			'settings' => sprintf(
				'<a href="%s">%s</a>',
				esc_url( 'options-general.php?page=' . self::OPTIONS_PAGE_NAME ),
				esc_attr__( 'Settings', 'wp-action-network-events' )
			),
		);

		return array_merge( $link, $actions );
	}

	/**
	 * Register Settings & Fields
	 *
	 * @return void
	 */
	public function initSettings() {

		\register_setting(
			self::OPTIONS_NAME,
			self::OPTIONS_NAME
		);
		\register_setting( 
			'reading', 
			self::OPTIONS_NAME
		);

		\add_settings_section(
			self::OPTIONS_NAME . '_sync_section',
			esc_attr__( 'Sync', 'wp-action-network-events' ),
			false,
			self::OPTIONS_NAME
		);
		\add_settings_section(
			self::OPTIONS_NAME . '_general_section',
			esc_attr__( 'General', 'wp-action-network-events' ),
			false,
			self::OPTIONS_NAME
		);
		\add_settings_section(
			self::OPTIONS_NAME . '_display_section',
			esc_attr__( 'Display', 'wp-action-network-events' ),
			false,
			self::OPTIONS_NAME
		);

		/**
		 * Add to Readings Settings
		 */
		\add_settings_section(
			'reading_display_section',
			esc_attr__( 'Events Display', 'wp-action-network-events' ),
			false,
			'reading',
		);

		\add_settings_field(
			'base_url',
			\__( 'Action Network Base URL', 'wp-action-network-events' ),
			array( $this, 'renderBaseUrlField' ),
			self::OPTIONS_NAME,
			self::OPTIONS_NAME . '_sync_section'
		);
		\add_settings_field(
			'api_key',
			\__( 'Action Network API Key', 'wp-action-network-events' ),
			array( $this, 'renderApiKeyField' ),
			self::OPTIONS_NAME,
			self::OPTIONS_NAME . '_sync_section'
		);
		// \add_settings_field(
		// 'event_types',
		// \__( 'Event Types', 'wp-action-network-events' ),
		// array( $this, 'renderEventTypesField' ),
		// self::OPTIONS_NAME,
		// self::OPTIONS_NAME . '_section'
		// );
		\add_settings_field(
			'sync_frequency',
			\__( 'Frequency', 'wp-action-network-events' ),
			array( $this, 'renderFrequencyField' ),
			self::OPTIONS_NAME,
			self::OPTIONS_NAME . '_sync_section'
		);
		\add_settings_field(
			'archive_slug',
			\__( 'Events Page Slug', 'wp-action-network-events' ),
			array( $this, 'renderEventArchiveSlugField' ),
			self::OPTIONS_NAME,
			self::OPTIONS_NAME . '_general_section'
		);
		\add_settings_field(
			'event_slug',
			\__( 'Single Event Path', 'wp-action-network-events' ),
			array( $this, 'renderEventSlugField' ),
			self::OPTIONS_NAME,
			self::OPTIONS_NAME . '_general_section'
		);
		add_settings_field(
			'hide_canceled',
			__( 'Hide Canceled Events', 'wp-action-network-events' ),
			array( $this, 'renderHideCanceledField' ),
			self::OPTIONS_NAME,
			self::OPTIONS_NAME . '_general_section'
		);
		\add_settings_field(
			'events_per_page',
			\__( 'Events show at most', 'wp-action-network-events' ),
			array( $this, 'renderEventsPerPage' ),
			self::OPTIONS_NAME,
			self::OPTIONS_NAME . '_display_section'
		);
		\add_settings_field(
			'events_per_page',
			\__( 'Events show at most', 'wp-action-network-events' ),
			array( $this, 'renderEventsPerPage' ),
			'reading',
			'reading_display_section'
		);
	}

	/**
	 * Render Notices on Options page
	 *
	 * @return void
	 */
	public function renderAdminNotices() {
		$screen = get_current_screen();
		// Only render this notice in the post editor.
		if ( ! $screen || 'settings_page_' . self::OPTIONS_PAGE_NAME !== $screen->base ) {
			return;
		}

		?>
		<div class="notice notice-info is-dismissible">
			<p><?php _e( 'Automatic sync coming soon!', 'wp-action-network-events' ); ?></p>
		</div>
		<?php
	}

	/**
	 * Render Settings Page
	 *
	 * @return void
	 */
	public function renderPage() {

		// Check required user capability
		if ( ! current_user_can( 'activate_plugins' ) ) {
			\wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'wp-action-network-events' ) );
		}

		echo '<div class="wrap">' . "\n";
		echo '	<h1>' . \get_admin_page_title() . '</h1>' . "\n";
		$this->renderNotice();
		$this->renderSyncButton();

		echo '	<form action="options.php" method="post">' . "\n";

		\settings_fields( self::OPTIONS_NAME );
		\do_settings_sections( self::OPTIONS_NAME );
		\submit_button();

		echo '	</form>' . "\n";
		echo '</div>' . "\n";

	}

	/**
	 * Render Manual Sync Button
	 *
	 * @return void
	 */
	public function renderSyncButton() {
		wp_nonce_field( self::SYNC_ACTION_NAME, self::SYNC_ACTION_NAME . '_nonce' );
		?>

		<input type="hidden" id="<?php echo esc_attr( $this->plugin_name ); ?>-sync-action" name="action" value="<?php echo esc_attr( self::SYNC_ACTION_NAME ); ?>" />
		<input type="submit" id="<?php echo esc_attr( $this->plugin_name ); ?>-sync-submit" class="button button-primary" value="<?php _e( 'Manual Sync', 'wp-action-network-events' ); ?>"/>
		<input type="submit" id="<?php echo esc_attr( $this->plugin_name ); ?>-sync-submit-clean" class="button button-secondary" value="<?php _e( 'Clean Import', 'wp-action-network-events' ); ?>"/>
		<?php
	}

	/**
	 * Render Sync Notice
	 *
	 * @return void
	 */
	public function renderNotice() {
		printf( '<div id="%s"></div>', \esc_attr( Notices::NOTICE_ID ) );
	}

	/**
	 * Render Field
	 *
	 * @return void
	 */
	public function renderBaseUrlField() {

		$value = isset( $this->options['base_url'] ) ? $this->options['base_url'] : esc_url( 'https://actionnetwork.org/api/v2/' );

		echo '<input type="url" name="wp_action_network_events_options[base_url]" class="regular-text base_url_field" placeholder="' . esc_attr__( '', 'wp-action-network-events' ) . '" value="' . esc_attr( $value ) . '">';

	}

	/**
	 * Render Field
	 *
	 * @return void
	 */
	public function renderApiKeyField() {
		$value = isset( $this->options['api_key'] ) ? $this->options['api_key'] : '';

		echo '<input type="text" name="wp_action_network_events_options[api_key]" class="regular-text api_key_field" placeholder="' . esc_attr__( '', 'wp-action-network-events' ) . '" value="' . esc_attr( $value ) . '">';

	}

	/**
	 * Render Field
	 *
	 * @return void
	 */
	public function renderEventTypesField() {
		$event_types = isset( $this->options['event_types'] ) ? $this->options['event_types'] : array();

		echo '<select name="wp_action_network_events_options[event_types][]" class="event_types_field" multiple=multiple>';
		echo '	<option value="">' . __( 'Select Event Types', 'wp-action-network-events' ) . '</option>';

		foreach ( $this->eventTypeOptions as $key => $value ) {
			printf(
				'<option value="%s" %s>%s</option>',
				esc_attr( $key ),
				selected( true, in_array( $key, $event_types ), false ),
				esc_attr( $value )
			);
		}

		echo '</select>';
		echo '<p class="description">' . __( 'Select the type of events to sync and display.', 'wp-action-network-events' ) . '</p>';
	}

	/**
	 * Render Field
	 *
	 * @return void
	 */
	public function renderFrequencyField() {
		$value = isset( $this->options['sync_frequency'] ) ? $this->options['sync_frequency'] : (int) 24;

		printf(
			'<input type="number" name="wp_action_network_events_options[sync_frequency]" class="small-text sync_frequency_field" placeholder="%s" value="%s"> %s',
			esc_attr__( '', 'wp-action-network-events' ),
			esc_attr( $value ),
			esc_attr__( 'hours', 'wp-action-network-events' ),
		);
		echo '<p class="description">' . __( 'Select the frequency with which to sync events.', 'wp-action-network-events' ) . '</p>';
	}

	/**
	 * Render Field
	 *
	 * @return void
	 */
	public function renderEventArchiveSlugField() {
		$value = isset( $this->options['archive_slug'] ) ? $this->options['archive_slug'] : 'events';

		printf(
			'<input type="text" name="wp_action_network_events_options[archive_slug]" class="regular-text archive_slug_field" placeholder="%s" value="%s">',
			esc_attr__( 'events', 'wp-action-network-events' ),
			esc_attr( $value )
		);
		echo '<p class="description">' . __( 'Select slug for the events archive page.', 'wp-action-network-events' ) . '</p>';

	}

	/**
	 * Render Field
	 *
	 * @return void
	 */
	public function renderEventSlugField() {
		$value = isset( $this->options['event_slug'] ) ? $this->options['event_slug'] : 'event';

		printf(
			'<input type="text" name="wp_action_network_events_options[event_slug]" class="regular-text event_slug_field" placeholder="%s" value="%s">',
			esc_attr__( 'event', 'wp-action-network-events' ),
			esc_attr( $value )
		);
		echo '<p class="description">' . __( 'Select slug for the events archive page.', 'wp-action-network-events' ) . '</p>';

	}

	/**
	 * Render Field
	 *
	 * @return void
	 */
	public function renderHideCanceledField() {
		$value = isset( $this->options['hide_canceled'] ) ? $this->options['hide_canceled'] : 'false';

		printf(
			'<input type="checkbox" name="wp_action_network_events_options[hide_canceled]" class="hide_canceled_field" value="checked" %s> %s',
			checked( $value, 'checked', false ),
			esc_attr__( 'Hide', 'wp-action-network-events' )
		);
		echo '<p class="description">' . __( 'Hide canceled events on site.', 'wp-action-network-events' ) . '</p>';
	}

	/**
	 * Render field
	 *
	 * @return void
	 */
	public function renderEventsPerPage() {
		$value = isset( $this->options['events_per_page'] ) ? $this->options['events_per_page'] : \get_option( 'posts_per_page' );

		printf(
			'<input type="number" name="wp_action_network_events_options[events_per_page]" class="small-text events_per_page_field" placeholder="%s" value="%s">',
			esc_attr__( '', 'wp-action-network-events' ),
			esc_attr( $value ),
		);
		echo '<p class="description">' . __( 'How many events to display per page.', 'wp-action-network-events' ) . '</p>';		
	}

	/**
	 * Set Event Types
	 * Event Type options that will be displayed on the options page
	 *
	 * @param array $types
	 * @return void
	 */
	public function setEventTypeOptions( array ...$types ) : array {
		// $this->types = $types;
		$this->eventTypeOptions = array_push( $types );
	}

	/**
	 * Get Event Types
	 *
	 * @return void
	 */
	public static function getEventTypeOptions() : array {
		return $this->eventTypeOptions;
	}

	/**
	 * Add Event Types
	 * Add Event Types to options
	 *
	 * @param array $types
	 * @return array $types
	 */
	public static function registerEventTypeOptions( array $types ) : array {
		$this->setEventTypeOptions( $types );
	}

	/**
	 * Get Options
	 *
	 * @see https://developer.wordpress.org/reference/functions/get_option/
	 *
	 * @return mixed array || false
	 */
	static function getOptions() {
		return \get_option( self::OPTIONS_NAME );
	}

	/**
	 * Set options
	 *
	 * @return void
	 */
	function setOptions() {
		$this->options = self::getOptions();
	}
}
