<?php
/**
 * Server-side rendering of the `wp-action-network-events/event-query` block.
 *
 * @package WordPress
 */
namespace WpActionNetworkEvents\App\Blocks\Event_Query;

/**
 * Renders the `wp-action-network-events/event-query` block on the server.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 * @return string Returns the filtered post date for the current post wrapped inside "time" tags.
 */
function render( $attributes, $content, $block ) {
	$default_timezone = \get_option( 'timezone_string' );
	$timezone = ( $tz = \get_post_meta( $post_id, '_timezone', true ) ) ? $tz : $default_timezone;

	$block_type_attributes = $block->block_type->attributes;
	$default_query = $block_type_attributes['query']['default'];
	$default_display = $block_type_attributes['display']['default'];

	$defaults = array_merge(
		[
			'post_type'			=> $block_type_attributes['postType']['default'],
			'taxonomy'			=> $block_type_attributes['taxonomy']['default'],
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

	var_dump( $attributes );

	$args = wp_parse_args( $args, $defaults );

	$taxonomy = $args['taxonomy'];
	$date_format = $args['dateFormat'];
	$time_format = $args['timeFormat'];

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
		
		ob_start();
		?>

		<?php
		while( $query->have_posts() ) : $query->the_post(); 
			$post_id = \get_the_ID();
			$raw_date = \get_post_meta( $post_id, '_start_date', true );
			$datetime = new \DateTime( $raw_date );
			$formatted_date = $datetime->format( $date_format );
			$formatted_time = $datetime->format( $time_format );

			/** Get timezone abbreviation */
			$generic_date = new \DateTime( $raw_date );
			$generic_date->setTimezone( new \DateTimeZone( $timezone ) );
			$timezone_abbr = $generic_date->format( 'T' );
			?>

			<<?php echo ( $args['tagName'] ); ?> class="event">

				<?php if( $args['showTags'] && \has_term( '', $taxonomy, get_the_ID() ) ) : 
					$tags = \wp_get_post_terms( $post_id, $taxonomy, [ 'fields' => 'names' ] );
					?>

					<div className="event__tag">
						<?php echo \esc_html( $tags[0] ); ?>
					</div>

				<?php endif; ?>

				<?php if( $args['showFeaturedImage'] && \has_post_thumbnail( $post ) ) : ?>

					<picture className="event__media">
						<?php \the_post_thumbnail( $post_id, 'medium', [] ); ?>
					</picture>

				<?php endif; ?>

				<?php if( $args['showTitle'] ) : ?>
					
					<?php the_title( '<h3 class="event__title"><a href="' . \esc_url( \get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
					
				<?php endif; ?>

				<?php if( $args['showDate'] ) : ?>
					
					<div className="event__date">
						<time dateTime=<?php echo \esc_attr( $raw_date ); ?>><?php echo $formatted_date; ?></time>
					</div>
					
				<?php endif; ?>

				<?php if( $args['showTime'] ) : ?>
					
					<div className="event__time">
						<time dateTime=<?php echo esc_attr( $raw_date ); ?>><?php printf( '%s <span class="timezone-abbr">%s</span>', $formatted_time, $timezone_abbr ); ?> </time>
					</div>
					
				<?php endif; ?>

				<?php if( $args['showLocation'] && ( $location = \get_post_meta( $post_id, '_location_venue', true ) ) ) : ?>
					
					<div className="event__location"><?php echo \esc_attr( $location ); ?></div>
					
				<?php endif; ?>

			</<?php echo ( $args['wrapperTagName'] ); ?>>

		<?php
		endwhile; ?>
		
		</<?php echo ( $args['wrapperTagName'] ); ?>>

	<?php
	$output = ob_get_clean();

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
