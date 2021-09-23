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
	$default_query = $block_type_attributes['query']['default'];
	$default_display = $block_type_attributes['display']['default'];

	$defaults = array_merge(
		[
			'post_type'			=> Event::POST_TYPE['id'],
			'taxonomy'			=> EventTag::TAXONOMY['id'],
			'dateFormat'		=> \get_option( 'date_format' ),
			'timeFormat'		=> \get_option( 'time_format' ),
			'wrapperTagName'	=> $block_type_attributes['wrapperTagName']['default'],
			'tagName'			=> $block_type_attributes['tagName']['default'],
		],
		$default_query,
		$default_display,
		[
			'posts_per_page'		=> $default_query['per_page']
		]
	);

	$args = array_merge(
		$attributes['query'],
		$attributes['display'],
		$attributes,
		[
			'posts_per_page'		=> $attributes['query']['per_page'],
		]
	);

	$args = wp_parse_args( $args, $defaults );

	$taxonomy = $args['taxonomy'];

	if( 'start' === $args['orderby'] ) {
		$args['orderby'] = 'meta_value';
		$args['meta_key'] = '_start_date';
	}

	if( !empty( $args['event-tags'] ) ) {
		$args['tax_query'] = [
			[
				'taxonomy' => $taxonomy,
				'field'    => 'id',
				'terms'    => $args['event-tags'],
			]
		];
	}

	$query = new \WP_Query( $args );
	$output = '';

	if( $query->have_posts() ) : 

		$wrapper_attributes = \get_block_wrapper_attributes( [ 'class' => 'events__list' ] );
		$loader_params = Blocks::getLoaderParams();
		$template_loader = new TemplateLoader( $loader_params );
		
		ob_start();
		?>

		<<?php echo ( $args['wrapperTagName'] ); ?> <?php echo $wrapper_attributes; ?>>

		<?php
		while( $query->have_posts() ) : $query->the_post(); 

			$template_loader
				->setTemplateData( [
					'id'	=> \get_the_ID(),
					'args'	=> $args
				] )
				->getTemplatePart( 'event' ); ?>

		<?php
		endwhile; ?>
		
		</<?php echo ( $args['wrapperTagName'] ); ?>>

	<?php
	$output = ob_get_clean();
	wp_reset_postdata();

	endif;

	return $output;
}

/**
 * Registers the `wp-action-network-events/event-time` block on the server.
 */
function register() {
	\register_block_type(
		__DIR__,
		[
			'render_callback' 	=> __NAMESPACE__ . '\render',
		]
	);
}
add_action( 'init', __NAMESPACE__ . '\register' );
