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
	 * Status map to WP post_status
	 * 
	 * @since 1.0.0
	 * @var      array    STATUSES
	 */
	const STATUSES = [
		'confirmed' 		=> 'publish',
		'tentative' 		=> 'draft',
		'cancelled' 		=> 'trash',
	];

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
		'rest_base'		=> 'events',
	];

	/**
	 * Event fields
	 */
	public const FIELDS = [
		'post_title' 			=> 'name',
		'post_content' 			=> 'description',
		'post_date'				=> 'created_date',
		'post_modified'			=> 'modified_date',
		'post_status'			=> '',
		'import_id'				=> 'identifiers[0]',
	];

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

}
