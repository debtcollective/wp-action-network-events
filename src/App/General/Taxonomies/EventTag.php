<?php
/**
 * WP Action Network Events
 *
 * @package   WP_Action_Network_Events
 */
namespace WpActionNetworkEvents\App\General\Taxonomies;

use WpActionNetworkEvents\Common\Abstracts\Taxonomy;

/**
 * Class Taxonomies
 *
 * @package WpActionNetworkEvents\App\General
 * @since 1.0.0
 */
class EventTag extends Taxonomy {

	/**
	 * Taxonomy data
	 */
	public const TAXONOMY = [
		'id'       		=> 'event_tag',
		'archive'  		=> 'tags',
		'title'    		=> 'Event Tags',
		'singular' 		=> 'Event Tag',
		'menu'			=> 'Tags',
		'icon'     		=> 'dashicons-tag',
		'post_types' 	=> [ 'an_event' ],
		'rest'			=> 'event-tags'
	];

}
