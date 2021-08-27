<?php
/**
 * WP Action Network Events
 *
 * @package   WP_Action_Network_Events
 */
namespace WpActionNetworkEvents\App\General\PostTypes;

use WpActionNetworkEvents\Common\Abstracts\PostType;

/**
 * Class Event
 *
 * @package WpActionNetworkEvents\App\General\PostTypes
 * @since 0.1.0
 */
class Event extends PostType {

	/**
	 * Post type data
	 */
	public const POST_TYPE = [
		'id'       		=> 'an_event',
		'archive'  		=> 'event-archive',
		'menu'    		=> 'Action Network',
		'title'    		=> 'Events',
		'singular' 		=> 'Event',
		'icon'     		=> 'dashicons-calendar-alt',
		'taxonomies'	=> [ 'event_type' ],
	];

}
