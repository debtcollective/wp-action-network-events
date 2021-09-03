<?php

/**
 * The plugin options.
 *
 * @link       https://debtcollective.org
 * @since      1.0.0
 *
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/admin
 */
namespace WpActionNetworkEvents\App\Integration;

use WpActionNetworkEvents\Common\Abstracts\Base;
use WpActionNetworkEvents\App\Integration\GetEvents;
use WpActionNetworkEvents\App\Admin\Options;
use WpActionNetworkEvents\App\General\Event;

/**
 * Plugin Options
 *
 *
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/admin
 * @author     Debt Collective <pea@misfist.com>
 */
class Sync extends Base {

	/**
	 * API Data
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      object    $data
	 */
	protected $data;

	/**
	 * Raw data
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      object    $raw_data
	 */
	protected $raw_data;

	/**
	 * Parsed Data
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $parsed_data
	 */
	protected $parsed_data;

	/**
	 * Processed Data
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $process
	 */
	protected $processed;

	/**
	 * Status
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $status
	 */
	protected $status;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $version, $plugin_name ) {
		parent::__construct( $version, $plugin_name );
		$this->init();
	}

	/**
	 * Initialize the class.
	 *
	 * @since 0.1.0
	 */
	public function init() {
		/**
		 * This general class is always being instantiated as requested in the Bootstrap class
		 *
		 * @see Bootstrap::__construct
		 *
		 */
		$this->setData();
		$this->setParsedRecords();

		\add_action( 'admin_enqueue_scripts', 							[ $this, 'enqueueScripts' ] );

		\add_action( 'wp_ajax_' . Options::SYNC_ACTION_NAME, 			[ $this, 'ajaxAction' ] );
		\add_action( 'wp_ajax_nopriv_' . Options::SYNC_ACTION_NAME, 	[ $this, 'ajaxAction' ] );

		 /*
		identifiers[0],
		title,
		name,
		browser_url,
		featured_image_url,
		instructions,
		description,
		start_date,
		end_date,
		created_date,
		modified_date,
		location.venue,
		status ["confirmed" "tentative" "cancelled"] 
		visibility ["public" "private"]
		action_network:event_campaign_id 
		*/
	}

	/**
	 * Respond to Ajax sync request
	 *
	 * @return void
	 */
	public function ajaxAction() {
		// \wp_send_json( $this->data );
		$this->startSync();
		// \wp_send_json( $this->processed );
		\wp_send_json( $this->data );

		\wp_die();
	}

	/**
	 * Kick off sync
	 *
	 * @return void
	 */
	public function startSync() {
		$this->processed['started'] = date( 'c' );
		update_option( 'wp_action_network_events_sync_started' . $this->processed['started'] , $this->processed['started'] );

		$this->setParsedRecords();
		// $this->addPosts();
		$this->completeSync();
	}

	/**
	 * Complete synce
	 *
	 * @return void
	 */
	public function completeSync() {
		$this->processed['completed'] = date( 'c' );
		$this->processed['duration'] = date_diff( $this->processed['completed'], $this->processed['started'] );
		update_option( 'wp_action_network_events_sync_completed' . $this->processed['completed'], $this->processed );
		$this->processed = [];
	}

	/**
	 * Get data
	 * 
	 * @return object $events->getResponseBody()
	 */
	function getData( $page = 1 ) {
		$events = new GetEvents( $this->version, $this->plugin_name );
		return $events->getResponseBody();
	}

	/**
	 * Set data
	 * 
	 * @return void
	 */
	function setData() {
		$this->data = $this->getData();
	}

	/**
	 * Set parse data
	 *
	 * @return void
	 */
	function setParsedRecords() {
		$this->parsed_data = $this->parseRecords();
	}

	/**
	 * Parse API records
	 *
	 * @return 
	 */
	function parseRecords() {
		$data = $this->data->_embedded->{'osdi:events'};
		$records = [];
		$count = 0;
		foreach( $data as $record ) {
			array_push( $records, $this->parseRecord( $record ) );
			$count++;
		}
		$this->processed['parsed'] = $count;
		return $records;
	}

	/**
	 * Convert to useable format
	 *
	 * @param object $record
	 * @return 
	 */
	function parseRecord( $record ) {
		return [
			'post_title'			=> $record->title,
			'post_content'			=> $record->description,
			'post_date'				=> $record->created_date,
			'post_modified'			=> $record->modified_date,
			'post_status'			=> $record->status,
			'browser_url'			=> $record->browser_url,
			'an_id'					=> $record->identifiers[0],
			'instructions'			=> $record->instructions,
			'start_date'			=> $record->start_date,
			'end_date'				=> $record->end_date,
			'featured_image'		=> $record->featured_image_url,
			'location_venue'		=> $record->location->venue,
			'location_latitude'		=> $record->location->location->latitude,
			'location_longitude'	=> $record->location->location->longitude,
			'visibility'			=> $record->visibility,
			// 'an_campaign_id'		=> $record->action_network:event_campaign_id
		];
	}

	/**
	 * Add posts
	 *
	 * @return void
	 */
	function addPosts() {
		$count = 0;
		foreach( $this->parsed_data as $post ) {
			$post_id = $this->addPost( $post );
			if( $post_id ) {
				$count++;
			}
		}
		$this->processed['added'] = $count;
	}

	/**
	 * Add post
	 * 
	 * @see https://developer.wordpress.org/reference/functions/wp_insert_post/
	 * @see https://developer.wordpress.org/reference/functions/media_sideload_image/
	 *
	 * @param array $post
	 * @return void
	 */
	function addPost( $post ) {
		$post_array = [
			'post_date' 		=> $post['post_date'],
			'post_title' 		=> $post['post_title'],
			'post_content'		=> $post['post_content'],
			'post_status'		=> $post['post_status'],
			'post_type'			=> Event::POST_TYPE['id'],
			'import_id'			=> $post['an_id'],
			'meta_input'		=> [
				'browser_url'			=> $post['browser_url'],
				'an_id'					=> $post['an_id'],
				'instructions'			=> $post['instructions'],
				'start_date'			=> $post['start_date'],
				'end_date'				=> $post['end_date'],
				// 'featured_image'		=> $post['featured_image'],
				'location_venue'		=> $post['location_venue'],
				'location_latitude'		=> $post['location_latitude'],
				'location_longitude'	=> $post['location_longitude'],
				'visibility'			=> $post['visibility'],
			]
		];
		$post_id = \wp_insert_post( $post_array );

		if( $post_id && $post['featured_image'] ) {
			$this->addFeaturedImage( $post, $post_id );
		}

		return $post_id;
	}

	/**
	 * Update changed posts
	 *
	 * @param array $posts
	 * @return void
	 */
	function updatePosts( $posts ) {
		$count = 0;
		foreach( $posts as $post ) {
			$post_id = $this->updatePost( $post );
			if( $post_id ) {
				$count++;
			}
		}
		$this->processed['updated'] = $count;
	}

	/**
	 * Update changed post
	 * 
	 * @see https://developer.wordpress.org/reference/functions/wp_update_post/
	 *
	 * @return mixed (int|WP_Error) The post ID on success. The value 0 or WP_Error on failure.
	 */
	function updatePost( $post ) {
		return wp_update_post( $post );
	}

	/**
	 * Add remote image
	 *
	 * @param array $post
	 * @param int $post_id
	 * @return void
	 */
	function addFeaturedImage( $post, $post_id ) {
		$url     	= $post->featured_image;
		$post_id 	= $post_id;
		$desc    	= \sanitize_title( $post['post_title'] );
		
		$image = \media_sideload_image( $url, $post_id, $desc );
	}

	/**
	 * Delete Posts
	 *
	 * @param array $posts
	 * @return void
	 */
	function deletePosts( $posts ) {
		$count = 0;
		foreach( $posts as $post ) {
			$deleted = $this->eletePost( $post_id );
			if( $deleted ) {
				$count++;
			}
		}
	}

	/**
	 * Delete post
	 * 
	 * @see https://developer.wordpress.org/reference/functions/wp_delete_post/
	 *
	 * @param int $post_id
	 * @return mixed (WP_Post|false|null) Post data on success, false or null on failure.
	 */
	function deletePost( $post_id ) {
		return wp_delete_post( $post_id );
	}

	function compareRecords() {}

	function compareRecord() {}

	public function getSyncStatus() {}

	/**
	 * The record has a post
	 * 
	 * @see https://developer.wordpress.org/reference/classes/wp_query/
	 *
	 * @param string $identifier
	 * @return boolean
	 */
	function doesExist( $identifier ) : boolean {
		$args = [
			'post_type'		=> Event::POST_TYPE['id'],
			'field'			=> 'ids',
			'meta_query'	=> [
				'key' 		=> 'an_id',
				'value' 	=> $identifier
			]
		];
		$query = new \WP_Query( $args );
		return $query->have_posts();
	}

	/**
	 * Compare existing to new data
	 *
	 * @param array $current
	 * @param array $new
	 * @return boolean
	 */
	function hasChanged( $current, $new ) : boolean {
		$current_post = [
			'post_title'			=> $current->title,
			'post_content'			=> $current->description,
			'post_modified'			=> $current->modified_date,
			'post_status'			=> $current->status,
			'browser_url'			=> $current->browser_url,
			'instructions'			=> $current->instructions,
			'start_date'			=> $current->start_date,
			'end_date'				=> $current->end_date,
			'featured_image'		=> $current->featured_image_url,
			'location_venue'		=> $current->location->venue,
			'location_latitude'		=> $current->location->location->latitude,
			'location_longitude'	=> $current->location->location->longitude,
			'visibility'			=> $current->visibility,
		];

		$new_post = [
			'post_title'			=> $new['title'],
			'post_content'			=> $new['description'],
			'post_modified'			=> $new['modified_date'],
			'post_status'			=> $new['status'],
			'browser_url'			=> $new['browser_url'],
			'instructions'			=> $new['instructions'],
			'start_date'			=> $new['start_date'],
			'end_date'				=> $new['end_date'],
			'featured_image'		=> $new['featured_image_url'],
			'location_venue'		=> $new['location->venue'],
			'location_latitude'		=> $new['location->location->latitude'],
			'location_longitude'	=> $new['location->location->longitude'],
			'visibility'			=> $new['visibility'],
		];
		
		return array_diff_assoc( $current_post, $new_post );
	}

	/**
	 * Enqueue Scripts
	 * 
	 * @see https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
	 *
	 * @return void
	 */
	public function enqueueScripts() {
		\wp_register_script( $this->plugin_name, esc_url( WPANE_PLUGIN_URL . 'assets/public/js/backend.js' ), [ 'jquery' ], $this->version, false );

		$localized = [
			'action'		=> Options::SYNC_ACTION_NAME,
			// 'endpoint'		=> $this->endpoint,
			'endpoint'		=> 'events',
			'ajax_url' 		=> \admin_url( 'admin-ajax.php' )
		];

		\wp_localize_script( $this->plugin_name, 'wpANEData', $localized );

		\wp_enqueue_script( $this->plugin_name );
	}
}
