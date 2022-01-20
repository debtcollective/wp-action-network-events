<?php
/**
 * WP Action Network Events
 *
 * @package   WP_Action_Network_Events
 */
namespace WpActionNetworkEvents\App\General\PostTypes;

use WpActionNetworkEvents\Common\Abstracts\PostType;
use WpActionNetworkEvents\App\Admin\Options;

/**
 * Class Event
 *
 * @package WpActionNetworkEvents\App\General\PostTypes
 * @since 1.0.0
 */
class Event extends PostType {

	/**
	 * Status map to WP post_status
	 *
	 * @since 1.0.0
	 * @var      array    STATUSES
	 */
	const STATUSES = array(
		'confirmed' => 'publish',
		'tentative' => 'draft',
		'cancelled' => 'canceled', // API misspells
	);

	/**
	 * Post type data
	 */
	public const POST_TYPE = array(
		'id'              => 'an_event',
		'archive'         => 'event-archive',
		'menu'            => 'Action Network',
		'title'           => 'Events',
		'singular'        => 'Event',
		'icon'            => 'dashicons-calendar-alt',
		'taxonomies'      => array( 'event_type' ),
		'rest_base'       => 'events',
		'capability_type' => 'post',
		'map_meta_cap'    => true,
	);

	/**
	 * Status data
	 */
	public const STATUS = array(
		'id'    => 'canceled',
		'label' => 'Canceled',
	);

	/**
	 * Event fields
	 */
	public const FIELDS = array(
		'post_title'    => 'name',
		'post_content'  => 'description',
		'post_date'     => 'created_date',
		'post_modified' => 'modified_date',
		'post_status'   => '',
		'import_id'     => 'identifiers[0]',
	);

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $version, $plugin_name ) {
		parent::__construct( $version, $plugin_name );
		$this->init();

		\add_filter( 'WpActionNetworkEvents\App\General\PostTypes\Event\Args', array( $this, 'set_event_archive_slug' ) );
		\add_action( 'init', array( $this, 'registerPostStatus' ) );
		\add_filter( 'display_post_states', array( $this, 'displayPostStatus' ), 11, 2 );
		\add_action( 'admin_footer-edit.php', array( $this, 'addPostStatusToEdit' ) );
		\add_action( 'pre_get_posts', array( $array, 'hideCanceledEvents' ) );
	}

	/**
	 * Modify Event Archive Slug
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_post_type/
	 *
	 * @param array $args
	 * @return array
	 */
	function set_event_archive_slug( $args ) {
		$event_options = \get_option( Options::OPTIONS_NAME );
		if ( isset( $event_options['archive_slug'] ) && $slug = $event_options['archive_slug'] ) {
			$args['has_archive']     = esc_attr( $slug );
			$args['rewrite']['slug'] = esc_attr( $slug );
		}
		return $args;
	}

	/**
	 * Add custom capabilities for admin
	 *
	 * @return void
	 */
	public static function add_admin_capabilities() {
		if ( empty( self::$capabilities ) ) {
			return;
		}

		$role = \get_role( 'administrator' );

		foreach ( self::$capabilities as $post_cap => $capability ) {
			if ( ! $role->has_cap( $capability ) ) {
				$role->add_cap( $capability );
			}
		}
	}

	/**
	 * Remove custom capabilities for admin
	 *
	 * @link https://developer.wordpress.org/reference/classes/wp_role/remove_cap/
	 *
	 * @return void
	 */
	public static function remove_admin_capabilities() {
		if ( empty( self::$capabilities ) ) {
			return;
		}

		$role = \get_role( 'administrator' );

		foreach ( self::$capabilities as $post_cap => $capability ) {
			if ( $role->has_cap( $capability ) ) {
				$role->remove_cap( $capability );
			}
		}
	}

	/**
	 * Register custom query vars
	 *
	 * @link https://developer.wordpress.org/reference/hooks/query_vars/
	 *
	 * @param array $vars The array of available query variables
	 */
	public function registerQueryVars( $vars ) : array {
		$vars[] = 'scope';
		return $vars;
	}

	/**
	 * Register post status
	 *
	 * @return void
	 */
	public function registerPostStatus() {
		\register_post_status(
			self::STATUS['id'],
			array(
				'label'                     => _x( self::STATUS['label'], 'wp-action-network-events' ),
				'public'                    => false,
				'private'                   => true,
				'internal'                  => true,
				'exclude_from_search'       => true,
				'show_in_admin_all_list'    => true,
				'show_in_admin_status_list' => true,
				'label_count'               => _n_noop( 'Canceled <span class="count">(%s)</span>', 'Canceled <span class="count">(%s)</span>' ),
			)
		);
	}

	/**
	 * Add Custom Status to Quick Edit
	 *
	 * @return void
	 */
	public function addPostStatusToEdit() {
		global $post;
		if ( $post->post_type !== self::POST_TYPE['id'] ) {
			return false;
		}
		ob_start(); ?>

			<script>
			jQuery(document).ready( function() {
				jQuery( 'select[name="_status"]' ).append( '<option value="<?php echo self::STATUS['id']; ?>"><?php echo self::STATUS['label']; ?></option>' );

				<?php
				if ( self::STATUS['id'] === $post->post_status ) :
					?>
					jQuery( '#post-status-display' ).text( '<?php echo self::STATUS['label']; ?>' );
					jQuery( 'select[name="_status"]' ).val( '<?php echo self::STATUS['id']; ?>' );
					<?php
				endif;
				?>

			});
			</script>

		<?php
		$output = ob_get_clean();

		echo $output;
	}

	/**
	 * Display Custom Status on Post List
	 *
	 * @param string $statuses
	 * @return void
	 */
	public function displayPostStatus( $statuses, $post ) {
		if ( $post->post_type === self::POST_TYPE['id'] && \get_query_var( 'post_status' ) !== self::STATUS['id'] ) {
			if ( $post->post_status === self::STATUS['id'] ) {
				return array( self::STATUS['label'] );
			}
		}
		return $statuses;
	}

	/**
	 * Hide Canceled
	 *
	 * @link https://developer.wordpress.org/reference/hooks/pre_get_posts/
	 *
	 * @param object $query
	 * @return void
	 */
	function hideCanceledEvents( $query ) {
		$event_options = \get_option( Options::OPTIONS_NAME );
		if ( $event_options['hide_canceled_events'] && ! is_admin() && $query->is_main_query() && ( is_post_type_archive( self::POST_TYPE['id'] ) || $query->is_search ) ) {
			$query->set( 'post_status', 'publish' );
		}
	}
}
