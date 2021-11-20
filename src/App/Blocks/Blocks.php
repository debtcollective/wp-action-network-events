<?php
/**
 * WP Action Network Events Blocks
 *
 * @package   WP_Action_Network_Events
 */
namespace WpActionNetworkEvents\App\Blocks;

use WpActionNetworkEvents\Common\Abstracts\Base;
use WpActionNetworkEvents\App\Blocks\Patterns;
use WpActionNetworkEvents\App\Blocks\Fields\Meta;
use WpActionNetworkEvents\Common\Util\TemplateLoader;

/**
 * Class Blocks
 *
 * @package WpActionNetworkEvents\App\General
 * @since 1.0.0
 */
class Blocks extends Base {

	public static $loader_params = [];

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
		 *
		 */
		/**
		 * add_filter( 'WpActionNetworkEvents\App\Blocks\Blocks\LoaderParams', $params );
		 */
		self::$loader_params = \apply_filters( \get_class() . '\LoaderParams', [
			'filter_prefix'             => 'wp_action_network_events',
			'plugin_directory'          => WPANE_PLUGIN_DIR_PATH,
			'plugin_template_directory' => 'src/App/Blocks/templates',
			'theme_template_directory'  => 'template-parts/components',
		] );

		if( class_exists( '\WP_Block_Editor_Context' ) ) {
			// \add_filter( 'block_categories_all', [ $this, 'registerBlockCategory' ], 10, 2 );
		}

		new Patterns( $this->version, $this->plugin_name );
		// new Meta( $this->version, $this->plugin_name );

		include_once( \plugin_dir_path( __FILE__ ) . 'src/eventDate/index.php' );
		include_once( \plugin_dir_path( __FILE__ ) . 'src/eventLocation/index.php' );
		include_once( \plugin_dir_path( __FILE__ ) . 'src/eventTime/index.php' );
		include_once( \plugin_dir_path( __FILE__ ) . 'src/eventQuery/index.php' );
		include_once( \plugin_dir_path( __FILE__ ) . 'src/eventsComponent/index.php' );
		include_once( \plugin_dir_path( __FILE__ ) . 'src/eventsTout/index.php' );

		if ( function_exists( '\wp_set_script_translations' ) ) {
			\add_action(  'init',		[ $this, 'setScriptTranslations' ] );
		}
	}

	/**
	 * Register script translation
	 *
	 * @return void
	 */
	public function setScriptTranslations() {
		/**
		 * May be extended to wp_set_script_translations( 'my-handle', 'my-domain',
		 * plugin_dir_path( MY_PLUGIN ) . 'languages' ) ). For details see
		 * https://make.wordpress.org/core/2018/11/09/new-javascript-i18n-support-in-wordpress/
		 */
		\wp_set_script_translations( 'wp-action-network-events', 'wp-action-network-events' );
	}

	/**
	 * Register custom block category
	 * 
	 * @see https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/#managing-block-categories
	 */
	public function registerBlockCategory( $block_categories, $editor_context ) {
		if ( !in_array( 'components', $block_categories ) ) {
			array_push(
				$block_categories,
				array(
					'slug'  => 'components',
					'title' => __( 'Components', 'site-functionality' ),
					'icon'  => 'block-default',
				)
			);
		}
		return $block_categories;
	}

	/**
	 * Register custom pattern category
	 * 
	 * @see https://developer.wordpress.org/reference/functions/register_block_pattern_category/
	 */
	public function registerBlockPatternCategory() {}

	/**
	 * Get loader params
	 *
	 * @return array
	 */
	public static function getLoaderParams() : array {
		return self::$loader_params;
	}
 
}
