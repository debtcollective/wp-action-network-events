<?php

/**
 * The admin notices.
 *
 * @link       https://debtcollective.org
 * @since      1.0.0
 *
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/admin
 */
namespace WpActionNetworkEvents\App\Admin;

use WpActionNetworkEvents\Common\Abstracts\Base;
use WpActionNetworkEvents\App\Admin\Options;

/**
 * Admin Notices
 *
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/admin
 * @author     Debt Collective <pea@misfist.com>
 */
class Notices extends Base {

	/**
	 * Notices data key
	 */
	const NOTICES_DATA_KEY = 'wpANENoticesData';

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
		\add_action( 'admin_enqueue_scripts', array( $this, 'enqueueScript' ) );
		\add_action( 'admin_notices', array( $this, 'renderError' ) );
		\add_action( 'admin_notices', array( $this, 'renderInfo' ) );
		\add_action( 'admin_notices', array( $this, 'renderWarning' ) );
		\add_action( 'admin_notices', array( $this, 'renderSuccess' ) );
	}

	/**
	 * Render Notices on Options page
	 *
	 * @return void
	 */
	public function renderAdminNotices() {
		$screen = \get_current_screen();
		if ( ! $screen || 'settings_page_' . Options::OPTIONS_PAGE_NAME !== $screen->base ) {
			return;
		}

		?>
		<div class="notice notice-info is-dismissible">
			<p><?php _e( 'Automatic sync coming soon!', 'wp-action-network-events' ); ?></p>
		</div>
		<?php
	}

	/**
	 * Render Error Notice
	 *
	 * @param string $message
	 * @return void
	 */
	public function renderError( $message = '' ) {
		$screen = \get_current_screen();
		if ( ! $screen ||'settings_page_' . Options::OPTIONS_PAGE_NAME !== $screen->base ) {
			return;
		}

		?>
		<div class="notice notice-error">
			<p><?php echo esc_attr( $message ); ?></p>
		</div>
		<?php
	}

	/**
	 * Render Info Notice
	 *
	 * @param string $message
	 * @return void
	 */
	public function renderInfo( $message = '' ) {
		$screen = \get_current_screen();
		if ( ! $screen ||'settings_page_' . Options::OPTIONS_PAGE_NAME !== $screen->base ) {
			return;
		}

		?>
		<div class="notice notice-info is-dismissible">
			<p><?php echo esc_attr( $message ); ?></p>
		</div>
		<?php
	}

	/**
	 * Render Alert Notices
	 *
	 * @param string $message
	 * @return void
	 */
	public function renderWarning( $message = '' ) {
		$screen = \get_current_screen();
		if ( ! $screen ||'settings_page_' . Options::OPTIONS_PAGE_NAME !== $screen->base ) {
			return;
		}

		?>
		<div class="notice notice-warning is-dismissible">
			<p><?php echo esc_attr( $message ); ?></p>
		</div>
		<?php
	}

	/**
	 * Render Success Notice
	 *
	 * @param string $message
	 * @return void
	 */
	public function renderSuccess( $message = '' ) {
		$screen = \get_current_screen();
		if ( ! $screen ||'settings_page_' . Options::OPTIONS_PAGE_NAME !== $screen->base ) {
			return;
		}

		?>
		<div class="notice notice-success is-dismissible">
			<p><?php echo esc_attr( $message ); ?></p>
		</div>
		<?php
	}

	/**
	 * Register Script
	 *
	 * @return void
	 */
	function enqueueScript() {
		\wp_register_script( $this->plugin_name . '-notices', esc_url( WPANE_PLUGIN_URL . 'assets/public/js/notices.js' ), array(), $this->version, false );

		\wp_localize_script(
			$this->plugin_name . '-notices',
			self::NOTICES_DATA_KEY,
			array(
				'ajaxurl' => \get_admin_url() . 'admin-ajax.php',
			)
		);

		\wp_enqueue_script( $this->plugin_name . '-notices' );
	}

}
