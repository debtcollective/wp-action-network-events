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
use WpActionNetworkEvents\App\Integration\Parse;
use WpActionNetworkEvents\App\Admin\Options;
use WpActionNetworkEvents\App\General\PostTypes\Event;

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
	 * @var      array    $processed
	 */
	protected $processed = [];

	/**
	 * Status
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $status
	 */
	protected $status;

	/**
	 * Errors
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $errors
	 */
	protected $errors;

	/**
	 * Date Format
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $date_format for storing date
	 */
	protected $date_format = 'Y-m-d H:i:s';

	/**
	 * Transient Name
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $transient_name
	 */
	protected $transient_name = 'wp_action_network_events_sync_last_';

	/**
	 * Sync Frequency
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $sync_frequency
	 */
	protected $sync_frequency;

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
		$options = Options::getOptions();
		$this->sync_frequency = intval( $options['sync_frequency'] ) * HOUR_IN_SECONDS;

		\add_action( 'admin_enqueue_scripts', 							[ $this, 'enqueueScripts' ] );

		\add_action( 'wp_ajax_' . Options::SYNC_ACTION_NAME, 			[ $this, 'ajaxAction' ] );
		\add_action( 'wp_ajax_nopriv_' . Options::SYNC_ACTION_NAME, 	[ $this, 'ajaxAction' ] );

		// \set_exception_handler( [ $this, 'handleError' ] );

		 /*
		identifiers[0] 									=> import_id, an_id
		title,											=> post_title
		description,									=> post_content
		featured_image_url,								=> featured_image
		created_date,									=> post_date, created_date
		name,											=> name
		browser_url,									=> browser_url
		instructions,									=> instructions
		start_date,										=> start_date
		end_date,										=> end_date
		modified_date,									=> modified_date
		location.venue,									=> location_venue
		location.location.latitude,						=> location_latitude
		location.location.longitute,					=> location_longitute
		status ["confirmed" "tentative" "cancelled"] 	=> status
			confirmed 		=> publish
			tentative 		=> draft
			cancelled 		=> trash
		visibility ["public" "private"]					=> visibility
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
		$this->startSync( 'manual' );
		\wp_send_json( $this->processed );

		\wp_die();
	}

	/**
	 * Kick off sync
	 *
	 * @param string $origin
	 * @return void
	 */
	public function startSync( string $origin = 'cron' ) {
		$start = new \DateTime();
		$this->setSyncStatus( 'origin', $origin );
		$this->status = 'processing';
		$this->setSyncStatus( 'started', $start->format( $this->date_format ) );
		$this->setSyncStatus( 'sync_frequency', $this->sync_frequency );
		\set_transient( $this->transient_name . 'started', $this->processed['started'], $this->sync_frequency );

		$this->setParsedRecords();
		$this->addPosts();
		$this->completeSync();
	}

	/**
	 * Complete sync
	 *
	 * @return void
	 */
	public function completeSync() {
		$completed = new \DateTime();
		$this->setSyncStatus( 'completed', $completed->format( $this->date_format ) );
		\set_transient( $this->transient_name . 'completed', $this->processed['completed'], $this->sync_frequency );
		$this->setSyncStatus( 'status', 'complete' );
		\set_transient( 'wp_action_network_events_sync_status_' . $this->processed['completed'], $this->processed, $this->sync_frequency );
	}

	/**
	 * Get data
	 * 
	 * @return object $events->getResponseBody()
	 */
	function getData( $page = 1 ) {
		$events = new GetEvents( $this->version, $this->plugin_name );
		if( is_a( $events, '\WP_Error' ) ) {
			$this->handleError( 'Failed at ' . __FUNCTION__ );
			// throw new \Exception( \__( 'Error encountered in ' . __FUNCTION__, 'wp-action-network-events' ) );
		}
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
		$this->setSyncStatus( 'parsed', $count );
		if( is_a( $records, '\WP_Error' ) ) {
			$this->handleError( 'Failed at ' . __FUNCTION__ );
			// throw new \Exception( \__( 'Error encountered in ' . __FUNCTION__, 'wp-action-network-events' ) );
		}
		return $records;
	}

	/**
	 * Convert to useable format
	 *
	 * @param object $record
	 * @return 
	 */
	function parseRecord( $record ) : object {
		$status = Event::STATUSES[$record->status];
		return (object) [
			'post_title'			=> $record->title,
			'post_content'			=> $record->description,
			'post_date'				=> $record->created_date,
			'post_modified'			=> $record->modified_date,
			'post_status'			=> $status,
			'browser_url'			=> $record->browser_url,
			'_links_to'				=> $record->browser_url,
			'_links_to_target'		=> 'blank',
			'an_id'					=> $record->identifiers[0],
			'instructions'			=> $record->instructions,
			'start_date'			=> $record->start_date ?? '',
			'end_date'				=> $record->end_date ?? '',
			'featured_image'		=> $record->featured_image_url ?? '',
			'location_venue'		=> $record->location->venue,
			'location_latitude'		=> $record->location->location->latitude,
			'location_longitude'	=> $record->location->location->longitude,
			'status'				=> $record->status,
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
			// $post_id = $this->maybeAddPost( $post );
			$this->evaluatePost( $post );
			// $post_id = $this->addPost( $post );
			if( $post_id ) {
				$count++;
			}
		}
		$this->setSyncStatus( 'added_posts', $count );
	}

	/**
	 * Undocumented function
	 *
	 * @param [type] $post
	 * @return void
	 */
	function evaluatePost( $post ) {
		$this->processed[ $post->ID . ' exists'] = $this->doesExist( $post->an_id );
		$this->processed[ $post->ID . ' has changed'] = $this->hasChanged( $post );
		// $post_id = false;
		// if( !$this->doesExist( $post->an_id ) ) {
		// 	$post_id = $this->addPost( $post );
		// } elseif( $this->hasChanged( $post ) ) {
		// 	$existing = $this->getExistingPost( $post );
		// 	$differences =  $this->getDifferences( $existing, $post );
		// 	$post_id = $this->updatePost( $post, $differences );
		// }
		// $this->processed['updated_posts'] = 0;
		// return $post_id;
	}

	/**
	 * Maybe add post
	 *
	 * @param object $post
	 * @return void
	 */
	function maybeAddPost( object $post ) {
		$post_id = false;
		if( !$this->doesExist( $post->an_id ) ) {
			$post_id = $this->addPost( $post );
		} elseif( $this->hasChanged( $post ) ) {
			$existing = $this->getExistingPost( $post );
			$differences =  $this->getDifferences( $existing, $post );
			$post_id = $this->updatePost( $post, $differences );
		}
		$this->processed['updated_posts'] = 0;
		return $post_id;
	}

	/**
	 * Add post
	 * 
	 * @see https://developer.wordpress.org/reference/functions/wp_insert_post/
	 * @see https://developer.wordpress.org/reference/functions/media_sideload_image/
	 *
	 * @param object $post
	 * @return void
	 */
	function addPost( $post ) {
		$timezone = $this->getTimezone( [
			'venue'		=> $post->location_venue,
			'latitude'	=> $post->location_latitude,
			'longitude'	=> $post->location_longitude
		] );

		$post_array = [
			'post_date' 		=> $post->post_date,
			'post_title' 		=> \esc_attr( $post->post_title ),
			'post_content'		=> \wp_kses_post( $post->post_content ),
			'post_status'		=> \esc_attr( $post->post_status ),
			'post_type'			=> Event::POST_TYPE['id'],
			'import_id'			=> \esc_attr( $post->an_id ),
			'meta_input'		=> [
				'browser_url'			=> \esc_url( $post->browser_url ),
				'_links_to'				=> \esc_url( $post->browser_url ),
				'_links_to_target'		=> \esc_attr( $post->_links_to_target ),
				'an_id'					=> \esc_attr( $post->an_id ),
				'instructions'			=> $post->instructions,
				'start_date'			=> $post->start_date,
				'end_date'				=> $post->end_date,
				'timezone'				=> $timezone,
				// 'featured_image'		=> $post->featured_image,
				'location_venue'		=> \esc_attr( $post->location_venue ?? 'Virtual' ),
				'location_latitude'		=> floatval( $post->location_latitude ),
				'location_longitude'	=> floatval( $post->location_longitude ),
				'status'				=> \esc_attr( $post->status ),
				'visibility'			=> \esc_attr( $post->visibility ),
			]
		];

		$post_id = \wp_insert_post( $post_array );

		if( $post_id && $post->featured_image ) {
			$this->addFeaturedImage( $post, $post_id );
		}

		if( is_a( $post_id, '\WP_Error' ) ) {
			$this->handleError( 'Failed at ' . __FUNCTION__ );
			// throw new \Exception( \__( 'Error encountered in ' . __FUNCTION__, 'wp-action-network-events' ) );
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
		$this->processed['updated_posts'] = $count;
	}

	/**
	 * Update changed post
	 * 
	 * @see https://developer.wordpress.org/reference/functions/wp_update_post/
	 *
	 * @return mixed (int|WP_Error) The post ID on success. The value 0 or WP_Error on failure.
	 */
	function updatePost( $post, array $fields ) {
		$post_id = \wp_update_post( $post );
		if( is_a( $post_id, '\WP_Error' ) ) {
			$this->handleError( 'Failed at ' . __FUNCTION__ );
			// throw new \Exception( \__( 'Error encountered in ' . __FUNCTION__, 'wp-action-network-events' ) );
		}
		return $post_id;
	}

	/**
	 * Add remote image
	 *
	 * @param array $post
	 * @param int $post_id
	 * @return void
	 */
	function addFeaturedImage( $post, $post_id ) {
		$desc  = \sanitize_title_with_dashes( $post->post_title );

		$image = \media_sideload_image( $post->featured_image, $post_id, $desc );
		if( is_a( $image, '\WP_Error' ) ) {
			$this->handleError( 'Failed at ' . __FUNCTION__  );
			// throw new \Exception( \__( 'Error encountered in ' . __FUNCTION__, 'wp-action-network-events' ) );
		}
		return $image;
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
			$deleted = $this->deletePost( $post_id );
			if( $deleted ) {
				$count++;
			}
		}
		$this->processed['deleted_posts'] = $count;
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
		$deleted = wp_delete_post( $post_id );
		if( is_a( $deleted, '\WP_Error' ) ) {
			$this->handleError( 'Failed at ' . __FUNCTION__ );
			// throw new \Exception( \__( 'Error encountered in ' . __FUNCTION__, 'wp-action-network-events' ) );
		}
		return $deleted;
	}

	function compareRecords() {}

	/**
	 * Handle Errors
	 *
	 * @return void
	 */
	function handleError( $exception ) {
		$this->status = 'failed';
		$this->errors = $exception;
		$this->setSyncStatus( 'errors', $this->errors );
		$this->completeSync();

		$this->errors = new \WP_Error( $exception );
		throw new \Exception( $exception );


		// if ( is_a( $results, '\WP_Error' ) ) {
		// 	$this->errors = new \WP_Error(); 
		// 	throw new \Exception();
		// }
	}

	/**
	 * Set processing status
	 *
	 * @param string $prop
	 * @param mixed $value
	 * @return void
	 */
	function setSyncStatus( $prop, $value ) {
		$this->processed[$prop] = $value;
	}

	/**
	 * Get duration in seconds
	 *
	 * @param string $started
	 * @param string $completed
	 * @return integer $seconds
	 */
	function getDuration( $started, $completed ) : integer {
		$start = new \DateTime( $started );
		$end = new \DateTime( $completed );
		$diff = $start->diff( $end );
		$daysInSecs = $diff->format( '%r%a' ) * 24 * 60 * 60;
		$hoursInSecs = $diff->h * 60 * 60;
		$minsInSecs = $diff->i * 60;

		$seconds = $daysInSecs + $hoursInSecs + $minsInSecs + $diff->s;

		return $seconds;
	}

	/**
	 * Get timezone abbreviation
	 *
	 * @param string $timezone
	 * @return string
	 */
	public static function getTimezoneAbbr( string $timezone ) : string {
		return $this->getTimezoneAbbreviation( $timezone );
	}

	/**
	 * Get timezone abbreviation
	 *
	 * @param string $timezone
	 * @return string
	 */
	public function getTimezoneAbbreviation( string $timezone ) : string {
		$dateTime = new \DateTime();
		$dateTime->setTimeZone( new \DateTimeZone( $timezone ) );
		return $dateTime->format('T'); 
	}

	/**
	 * Get Timezone
	 *
	 * @param array $location
	 * @return string timezone
	 */
	function getTimezone( array $location ) : string {
		if( empty( $location->venue ) ) {
			return \get_option( 'timezone_string' );
		}
		return $this->getNearestTimezone( $location->latitude, $location->longitude );
	}

	/**
	 * Calculate Timezone based on geolocation
	 *
	 * @param floatval $latitude
	 * @param floatval $longitude
	 * @param string $country_code
	 * @return string $timezone
	 */
	function getNearestTimezone( $latitude, $longitude ) : string {
		$diffs = array();
		$default_timezone = \get_option( 'timezone_string' );
		foreach( \DateTimeZone::listIdentifiers() as $timezoneId ) {
			  $timezone = new \DateTimeZone( $timezoneId );
			  $location = $timezone->getLocation();
			  $tLat = $location->latitude;
			  $tLng = $location->longitude;
			  $diffLat = abs( $latitude - $tLat );
			  $diffLng = abs( $longitude - $tLng );
			  $diff = $diffLat + $diffLng;
			  $diffs[$timezoneId] = $diff;
		}
	 
		$timezone = array_keys( $diffs, min( $diffs ) );
		if( $timezone && is_array( $timezone ) ) {
			return $timezone[0];
		}
		return $default_timezone;
	}

	/**
	 * Get existing post matching
	 * 
	 * @see https://developer.wordpress.org/reference/classes/wp_query/
	 *
	 * @param object $post
	 * @return array Return an array of post IDs
	 */
	function queryPost( $post ) {
		$args = [
			'post_type'			=> Event::POST_TYPE['id'],
			'posts_per_page'	=> 1,
			// 'field'				=> 'ids',
			'meta_query'		=> [
				'key' 			=> 'an_id',
				'value' 		=> $post->an_id
			]
		];
		return new \WP_Query( $args );
	}

		/**
	 * Get differences in posts
	 *
	 * @param array $existing
	 * @param array $new
	 * @return array
	 */
	function getDifferences( $existing, $new ) {
		$fields_to_check = [
			'post_title',
			'post_content',
			'post_modified',
			'post_status',
			'browser_url',
			'instructions',
			'start_date',
			'end_date',
			'featured_image',
			'location_venue',
			'location_latitude',
			'location_longitude',
			'visibility',
			'status',
		];

		$post_id = $existing->ID;
		$existing_post = [
			'post_title'			=> $existing->post_title,
			'post_content'			=> $existing->post_content,
			'post_modified'			=> $existing->modified_date,
			'browser_url'			=> get_post_meta( $post_id, 'browser_url' ),
			'instructions'			=> get_post_meta( $post_id, 'instructions' ),
			'start_date'			=> get_post_meta( $post_id, 'start_date' ),
			'end_date'				=> get_post_meta( $post_id, 'end_date' ),
			'featured_image'		=> get_post_meta( $post_id, 'featured_image' ),
			'location_venue'		=> get_post_meta( $post_id, 'location_venue' ),
			'location_latitude'		=> get_post_meta( $post_id, 'location_latitude' ),
			'location_longitude'	=> get_post_meta( $post_id, 'location_longitude' ),
			'visibility'			=> get_post_meta( $post_id, 'visibility' ),
			'status'				=> get_post_meta( $post_id, 'status' ),
		];

		$new_post = [
			'post_title'			=> $new->title,
			'post_content'			=> $new->description,
			'post_modified'			=> $new->modified_date,
			'browser_url'			=> $new->browser_url,
			'instructions'			=> $new->instructions,
			'start_date'			=> $new->start_date,
			'end_date'				=> $new->end_date,
			'featured_image'		=> $new->featured_image_url,
			'location_venue'		=> $new->location->venue ? $new->location->venue[0] : '',
			'location_latitude'		=> $new->location->location->latitude,
			'location_longitude'	=> $new->location->location->longitude,
			'visibility'			=> $new->visibility,
			'status'				=> $new->status,
		];

		// $differences = array_map( function( $field ) use $existing {
			
		// }, $new );


		$this->processed[ ' existing'] = $existing;
		$this->processed[ ' new'] = $new;

		$this->processed[ 'difference'] = array_diff_assoc( $existing_post, $new_post );
		
		return array_diff_assoc( $existing_post, $new_post );
	}

	/**
	 * Compare
	 *
	 * @param [type] $existing
	 * @param [type] $new
	 * @return void
	 */
	function compareField( $existing, $new ) {
		return $existing === $new;
	}

	/**
	 * Get existing post matching
	 * 
	 * @see https://developer.wordpress.org/reference/classes/wp_query/
	 *
	 * @param object $post
	 * @return array Return an array of post IDs
	 */
	function getExistingPost( $post ) {
		return $this->queryPost( $post )->post;
	}

	/**
	 * The record has a post
	 *
	 * @param obj $post
	 * @return boolean
	 */
	function doesExist( $post ) {
		$query = $this->queryPost( $post );
		return $query->have_posts();
	}

	/**
	 * Compare existing to new data
	 *
	 * @param array $current
	 * @param array $new
	 * @return boolean
	 */
	function hasChanged( $post ) {
		$current = $this->getExistingPost( $post );
		return !empty( $this->getDifferences( $current, $post ) );
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
