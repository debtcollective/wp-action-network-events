<?php
/**
 * Server-side rendering of the `wp-action-network-events/event-query` block.
 *
 * @package WordPress
 */
namespace WpActionNetworkEvents\App\Blocks\Event_Query;

use WpActionNetworkEvents\App\General\PostTypes\Event;
use WpActionNetworkEvents\App\General\Taxonomies\EventTag;
use WpActionNetworkEvents\Common\Util\TemplateLoader;
use WpActionNetworkEvents\App\Blocks\Blocks;
use WpActionNetworkEvents\App\Admin\Options;
use WpActionNetworkEvents\App\General\Queries;

/**
 * Renders the `wp-action-network-events/event-query` block on the server.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 * @return string Returns the filtered post date for the current post wrapped inside "time" tags.
 */
function render( $attributes, $content, $block ) {

	$block_type_attributes = $block->block_type->attributes;
	$default_query         = $block_type_attributes['query']['default'];
	$default_display       = $block_type_attributes['display']['default'];
	$event_options         = \get_option( Options::OPTIONS_NAME );


	$defaults = array_merge(
		array(
			'post_type'      => Event::POST_TYPE['id'],
			'taxonomy'       => EventTag::TAXONOMY['id'],
			'dateFormat'     => \get_option( 'date_format' ),
			'timeFormat'     => \get_option( 'time_format' ),
			'wrapperTagName' => $block_type_attributes['wrapperTagName']['default'],
			'tagName'        => $block_type_attributes['tagName']['default'],
			'scope'          => 'future',
		),
		$default_query,
		$default_display,
		array(
			'posts_per_page' => $default_query['per_page'],
			'post_status'    => array( 'publish', Event::STATUS['id'] ),
		)
	);

	$args = array_merge(
		$attributes['query'],
		$attributes['display'],
		$attributes,
		array(
			'posts_per_page' => $attributes['query']['per_page'],
		)
	);

	$args = \wp_parse_args( $args, $defaults );

	$events = Queries::getAnEventIds( $args['scope'] );

	$taxonomy = $args['taxonomy'];

	$query_args = array(
		'post_type'      => array( Event::POST_TYPE['id'] ),
		'posts_per_page' => $args['posts_per_page'],
		'orderby'        => 'meta_value',
		'order'          => $args['order'],
		'meta_key'       => 'start_date',
		'meta_type'      => 'DATETIME',
		'post__in'       => $events,
	);

	if ( ! empty( $args['event-tags'] ) ) {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => $taxonomy,
				'field'    => 'id',
				'terms'    => $args['event-tags'],
			),
		);
	}

	// echo '<pre>';
	// var_dump( $args['scope'], $query_args );
	// echo '</pre>';


	$query = new \WP_Query( $query_args );
	$output = '';

	if ( $query->have_posts() ) :

		$wrapper_attributes = \get_block_wrapper_attributes( array( 'class' => 'events__list' . ' scope-' . $args['scope'] ) );
		$loader_params      = Blocks::getLoaderParams();
		$template_loader    = new TemplateLoader( $loader_params );

		ob_start();
		?>

		<<?php echo ( $args['wrapperTagName'] ); ?> <?php echo $wrapper_attributes; ?>>

		<?php
		while ( $query->have_posts() ) :
			$query->the_post();

			$template_loader
				->setTemplateData(
					array(
						'id'   => \get_the_ID(),
						'args' => $args,
					)
				)
				->getTemplatePart( 'event' );
			?>

			<?php
		endwhile;
		?>
		
		</<?php echo ( $args['wrapperTagName'] ); ?>>

		<?php
		$output = ob_get_clean();
		wp_reset_postdata();

	endif;

	return $output;
}

/**
 * Registers the `wp-action-network-events/event-query` block on the server.
 */
function register() {
	\register_block_type(
		__DIR__,
		array(
			'render_callback' => __NAMESPACE__ . '\render',
		)
	);
}
add_action( 'init', __NAMESPACE__ . '\register' );
