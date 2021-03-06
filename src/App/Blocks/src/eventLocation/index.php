<?php
/**
 * Server-side rendering of the `wp-action-network-events/event-location` block.
 *
 * @package WordPress
 */
namespace WpActionNetworkEvents\App\Blocks\Event_Location;

/**
 * Renders the `wp-action-network-events/event-location` block on the server.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 * @return string Returns the filtered post date for the current post wrapped inside "time" tags.
 */
function render( $attributes, $content, $block ) {

	if ( ! isset( $block->context['postId'] ) ) {
		return '';
	}

	$post_ID            = $block->context['postId'];
	$wrapper_attributes = \get_block_wrapper_attributes( [ 'class' => 'event__location' ] );
	$location     		= \get_post_meta( $post_ID, '_location_venue', true ) ?? '' ;

	return sprintf( '<div %1$s>%2$s</div>', $wrapper_attributes, esc_attr( $location ) );
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
