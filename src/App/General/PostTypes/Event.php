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
	 * Plugin options
	 *
	 * @var array
	 */
	protected $options;

	/**
	 * Status map to WP post_status
	 *
	 * @since 1.0.0
	 * @var      array    STATUSES
	 */
	const STATUSES = array(
		'confirmed' => 'publish',
		'tentative' => 'draft',
		'cancelled' => 'cancelled',
	);

	/**
	 * Post type data
	 */
	public const POST_TYPE = array(
		'id'              => 'an_event',
		'archive'         => 'events',
		'slug'            => 'event',
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
		'id'    => 'cancelled',
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

		$this->options = \get_option( Options::OPTIONS_NAME );
		$this->init();

		\add_filter( 'WpActionNetworkEvents\App\General\PostTypes\Event\Args', array( $this, 'set_event_archive_slug' ) );
		\add_action( 'init', array( $this, 'registerPostStatus' ) );
		\add_filter( 'display_post_states', array( $this, 'displayPostStatus' ), 11, 2 );
		\add_action( 'admin_footer-post.php', array( $this, 'addStatusToPostEdit' ) );
		\add_action( 'admin_footer-post-new.php', array( $this, 'addStatusToPostEdit' ) );
		\add_action( 'admin_footer-edit.php', array( $this, 'addStatusToQuickEdit' ) );
		\add_action( 'pre_get_posts', array( $this, 'preGetPosts' ) );
		\add_filter( 'post_class', array( $this, 'addPostClass' ), 10, 3 );
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
		if ( isset( $this->options['event_slug'] ) && $slug = $this->options['event_slug'] ) {
			$args['rewrite']['slug'] = esc_attr( $slug );
		}
		if ( isset( $this->options['archive_slug'] ) && $slug = $this->options['archive_slug'] ) {
			$args['has_archive'] = esc_attr( $slug );
		}
		return $args;
	}

	/**
	 * Add custom capabilities for admin
	 *
	 * @return void
	 */
	public static function add_admin_capabilities() {
		if ( empty( $this->capabilities ) ) {
			return;
		}

		$role = \get_role( 'administrator' );

		foreach ( $this->capabilities as $post_cap => $capability ) {
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
		if ( empty( $this->capabilities ) ) {
			return;
		}

		$role = \get_role( 'administrator' );

		foreach ( $this->capabilities as $post_cap => $capability ) {
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
	 * @link https://developer.wordpress.org/reference/functions/register_post_status/
	 *
	 * @return void
	 */
	public function registerPostStatus() {
		$args = array(
			'label'                     => \_x( self::STATUS['label'], 'Custom Post Status Label', 'wp-action-network-events' ),
			'public'                    => ( isset( $this->options['hide_canceled'] ) && 'checked' == $this->options['hide_canceled'] ) ? false : true,
			'protected'                 => ( isset( $this->options['hide_canceled'] ) && 'checked' == $this->options['hide_canceled'] ) ? true : false,
			'exclude_from_search'       => ( isset( $this->options['hide_canceled'] ) && 'checked' == $this->options['hide_canceled'] ) ? true : false,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => \_n_noop( 'Canceled <span class="count">(%s)</span>', 'Canceled <span class="count">(%s)</span>', 'wp-action-network-events' ),
		);

		\register_post_status(
			self::STATUS['id'],
			$args
		);
	}

	/**
	 * Add Status to Post Edit
	 *
	 * @return void
	 */
	public function addStatusToPostEdit() {
		global $post;
		if ( $post->post_type !== self::POST_TYPE['id'] ) {
			return false;
		}

		ob_start();
		?>
		<script>
			jQuery(document).ready(function () {
				jQuery( 'select#post_status' ).append( '<option value="<?php echo self::STATUS['id']; ?>"><?php echo self::STATUS['label']; ?></option>' );
			});
		</script>
		<?php
		echo ob_get_clean();
	}

	/**
	 * Add Custom Status to Quick Edit
	 *
	 * @return void
	 */
	public function addStatusToQuickEdit() {
		global $post;
		if ( $post->post_type !== self::POST_TYPE['id'] ) {
			return false;
		}
		ob_start();
		?>

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
			echo ob_get_clean();
	}

	/**
	 * Display Custom Status on Post List
	 * Add Canceled, Draft and/or Private status in post list
	 * Display only Hidden if hidden field is set to try
	 *
	 * @link https://developer.wordpress.org/reference/hooks/display_post_states/
	 *
	 * @param array $statuses
	 * @return array $statuses Maybe modified array
	 */
	public function displayPostStatus( $statuses, $post ) {
		if ( $post->post_type === self::POST_TYPE['id'] && \get_query_var( 'post_status' ) !== self::STATUS['id'] ) {
			if ( self::STATUS['id'] == $post->post_status ) {
				$statuses[] = \esc_attr__( self::STATUS['label'], 'wp-action-network-events' );
			} elseif ( 'draft' === $post->post_status ) {
				$statuses[] = \esc_attr__( 'Draft', 'wp-action-network-events' );
			}
			if ( 'private' === \get_post_meta( $post->ID, 'visibility', true ) ) {
				$statuses[] = \esc_attr__( 'Private', 'wp-action-network-events' );
			}
			if ( ! class_exists( '\CWS_PageLinksTo' ) && ( $url = \get_post_meta( $post->ID, 'browser_url', true ) ) ) {
				$output_parts         = array(
					'custom' => '<a title="' . \esc_attr__( 'External Link', 'wp-action-network-events' ) . '" href="' . \esc_url( $url ) . '" class="post-state-link"><span class="dashicons dashicons-admin-links"></span><span class="url"> ' . \esc_url( $url ) . '</span></a>',
				);
				$output               = '<span class="post-info">' . implode( $output_parts ) . '</span>';
				$statuses['external'] = $output;
			}
			if ( ( true == \get_post_meta( $post->ID, 'hidden', true ) ) || ( true == \get_post_meta( $post->ID, 'is_hidden', true ) ) ) {
				$statuses = array( \esc_attr__( 'Hidden', 'wp-action-network-events' ) );
			}
		}
		return $statuses;
	}

	/**
	 * Hide Event
	 * Hide if `hidden` field is true
	 * Hide `post_status` = `canceled` if plugin setting selected
	 *
	 * @link https://developer.wordpress.org/reference/hooks/pre_get_posts/
	 *
	 * @param object $query
	 * @return void
	 */
	public function preGetPosts( $query ) {
		if ( ! is_admin() && $query->is_main_query() && ( is_post_type_archive( self::POST_TYPE['id'] ) || $query->is_search ) ) {
			$meta_query = array(
				'relation' => 'AND',
				array(
					'key'     => 'is_hidden',
					'value'   => '1',
					'compare' => '!=',
				),
				array(
					'key'     => 'is_hidden',
					'value'   => true,
					'compare' => '!=',
				),
				array(
					'key'     => 'hidden',
					'value'   => '1',
					'compare' => '!=',
				),
				array(
					'key'     => 'hidden',
					'value'   => true,
					'compare' => '!=',
				),
				array(
					'key'     => 'visibility',
					'value'   => 'private',
					'compare' => '!=',
				),
			);
			$query->set( 'meta_query', $meta_query );

			if ( isset( $this->options['hide_canceled'] ) && 'checked' === $this->options['hide_canceled'] ) {
				$query->set( 'post_status', array( 'publish' ) );
			}
			if ( isset( $this->options['events_per_page'] ) ) {
				$query->set( 'posts_per_page', (int) $this->options['events_per_page'] );
			}
			$query->set( 'orderby', 'meta_value' );
			$query->set( 'order', 'DESC' );
			$query->set( 'meta_key', 'start_date' );
			$query->set( 'meta_type', 'DATETIME' );
		}
	}

	/**
	 * Add Post Class
	 * If `hidden` is true add `is-hidden` to post class
	 *
	 * @link https://developer.wordpress.org/reference/hooks/post_class/
	 *
	 * @param array   $classes
	 * @param string  $class
	 * @param integer $post_id
	 * @return array $classes
	 */
	public function addPostClass( $classes, $class, $post_id ) {
		if ( \is_admin() ) {
			return $classes;
		}
		if ( true == \get_post_meta( $post_id, 'hidden', true ) ) {
			$classes[] = 'is-hidden';
		}
		if ( 'private' === \get_post_meta( $post_id, 'visibility', true ) ) {
			$classes[] = 'is-private';
		}
		return $classes;
	}

}
