<?php

/**
 * Processor.
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
use WpActionNetworkEvents\App\General\PostTypes\Event;

/**
 * Plugin Options
 *
 *
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/admin
 * @author     Debt Collective <pea@misfist.com>
 */
class Process extends Base {

	/**
	 * API Data
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      object    $data
	 */
	protected $data;

	/**
	 * Processed Data
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      object    $processed_data
	 */
	protected $processed_data;

	/**
	 * Date Format
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $date_format for storing date
	 */
	protected $date_format = 'Y-m-d H:i:s';

	/**
	 * Errors
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $errors
	 */
	protected $errors;

	/**
	 * Field Mapping
	 *
	 * @var array
	 */
	protected $field_map = [
		'post_title'			=> 'title',
		'post_content'			=> 'description',
		'post_date'				=> 'created_date',
		'post_modified'			=> 'modified_date',
		'post_status'			=> '',
		'browser_url'			=> 'browser_url',
		'_links_to'				=> 'browser_url',
		'_links_to_target'		=> 'blank',
		'an_id'					=> 'identifiers[0]',
		'instructions'			=> 'instructions',
		'start_date'			=> 'start_date' ?? '',
		'end_date'				=> 'end_date' ?? '',
		'featured_image'		=> 'featured_image_url' ?? '',
		'location_venue'		=> 'location.venue' ?? '',
		'location_latitude'		=> 'location.location.latitude',
		'location_longitude'	=> 'location.location.longitute',
		'status'				=> 'status',
		'visibility'			=> 'visibility',
		'an_campaign_id'		=> 'action_network:event_campaign_id',
	];

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $version, $plugin_name, array $data ) {
		parent::__construct( $version, $plugin_name );
		$this->data = $data;
		$this->init();
		$this->status['new'] = 0;
		$this->status['change'] = 0;
		$this->status['not_changed'] = 0;
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
	}

	/**
	 * Evaluate posts
	 *
	 * @return void
	 */
	public function evaluatePosts() {
		$count = 0;
		foreach( $this->data as $post ) {
			$post_id = $this->evaluatePost( $post );
			if( $post_id ) {
				$count++;
			}
		}
		return $this->status;
	}

	/**
	 * Evaluate Post
	 * 
	 * @todo implement changed/update processing
	 * @todo implement delete processing
	 *
	 * @param object $post
	 * @return mixed int $post_id || false
	 */
	function evaluatePost( $post ) {
		$post_id = false;
		if( !$this->doesExist( $post->an_id ) ) {
			$this->status['new']++;
			$post_id = $this->addPost( $post );
		}
		elseif( $this->hasChanged( $post ) ) {
			$this->status['changed']++;
			$existing = $this->getExistingPost( $post->an_id );
			// $differences =  $this->getDifferences( $existing, $post );
			// $post_id = $this->updatePost( $post, $differences );
		} 
		else {
			$this->status['not_changed']++;
		}
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
				'location_venue'		=> ( !empty( $post->location_venue ) ) ? \esc_attr( $post->location_venue ) : 'Virtual',
				'location_latitude'		=> floatval( $post->location_latitude ),
				'location_longitude'	=> floatval( $post->location_longitude ),
				'status'				=> \esc_attr( $post->status ),
				'visibility'			=> \esc_attr( $post->visibility ),
				'an_campaign_id'		=> \esc_attr( $post->{"action_network:event_campaign_id"} ),
			]
		];

		$post_id = \wp_insert_post( $post_array );

		/** Logging */
		if( $post_id ) {
			$this->status['added'][$post_id] = $post_array;
		}

		// if( $post_id && $post->featured_image ) {
		// 	$this->addFeaturedImage( $post, $post_id );
		// }

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
		$this->status['updated_posts'] = $count;
	}

	/**
	 * Update changed post
	 * 
	 * @see https://developer.wordpress.org/reference/functions/wp_update_post/
	 *
	 * @return mixed (int|WP_Error) The post ID on success. The value 0 or WP_Error on failure.
	 */
	function updatePost( $post ) {

		// $post_id = \wp_update_post( $post );
		// if( is_a( $post_id, '\WP_Error' ) ) {
		// 	$this->handleError( 'Failed at ' . __FUNCTION__ );
		// 	// throw new \Exception( \__( 'Error encountered in ' . __FUNCTION__, 'wp-action-network-events' ) );
		// }
		// if( $post_id ) {
		// 	$this->status['updated'][] = $post_id;
		// }
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

	public function getDifferences() {}

	public function getDifference() {}

	/**
	 * Compare modified date
	 *
	 * @param object $existing Post
	 * @param array $incoming
	 * @return boolean
	 */
	public function hasChanged( $existing, $incoming ) : boolean {
		return $existing->post_modified < $incoming['modified_date'];
	}

	// /**
	//  * Get differences in posts
	//  *
	//  * @param array $existing
	//  * @param array $new
	//  * @return array
	//  */
	// function getDifferences( $existing, $new ) : array {
	// 	$post_id = $existing->ID;
	// 	$existing_post = [
	// 		'post_title'			=> $existing->post_title,
	// 		'post_content'			=> $existing->post_content,
	// 		'post_modified'			=> $existing->modified_date,
	// 		'browser_url'			=> \get_post_meta( $post_id, 'browser_url', true ),
	// 		'instructions'			=> \get_post_meta( $post_id, 'instructions', true ),
	// 		'start_date'			=> \get_post_meta( $post_id, 'start_date', true ),
	// 		'end_date'				=> \get_post_meta( $post_id, 'end_date', true ),
	// 		'featured_image'		=> \get_post_meta( $post_id, 'featured_image', true ),
	// 		'location_venue'		=> \get_post_meta( $post_id, 'location_venue', true ),
	// 		'location_latitude'		=> \get_post_meta( $post_id, 'location_latitude', true ),
	// 		'location_longitude'	=> \get_post_meta( $post_id, 'location_longitude', true ),
	// 		'visibility'			=> \get_post_meta( $post_id, 'visibility', true ),
	// 		'status'				=> \get_post_meta( $post_id, 'status', true ),
	// 		'internal_name'			=> \get_post_meta( $post_id, 'internal_name', true ),
	// 	];

	// 	$new_post = [
	// 		'post_title'			=> $new->title,
	// 		'post_content'			=> $new->description,
	// 		'post_modified'			=> $new->modified_date,
	// 		'browser_url'			=> $new->browser_url,
	// 		'instructions'			=> $new->instructions,
	// 		'start_date'			=> $new->start_date,
	// 		'end_date'				=> $new->end_date,
	// 		'featured_image'		=> $new->featured_image_url,
	// 		'location_venue'		=> $new->location->venue ? $new->location->venue[0] : '',
	// 		'location_latitude'		=> $new->location->location->latitude,
	// 		'location_longitude'	=> $new->location->location->longitude,
	// 		'visibility'			=> $new->visibility,
	// 		'status'				=> $new->status,
	// 		'internal_name'			=> $new->name,
	// 	];

	// 	$differences = [];
	// 	$diff = [];

	// 	foreach( array_keys( $this->field_map ) as $field ) {
	// 		if( $this->compareField( $existing->{$field}, $new->{$field} ) ) {
	// 			// $this->setStatus( 'key', $key );
	// 			// $this->setStatus( 'value', $value );
	// 			// $differences[$key] = $new[$key];
	// 			$diff[$post_id][$field] = [
	// 				$existing->{$field}, $new->{$field}
	// 			];
	// 		}
	// 	}
		
	// 	$this->setStatus( "differences $post_id", $diff );
	// 	$this->setStatus( "new", $new );
	// 	$this->setStatus( "existing", $existing );


	// 	return $differences;

	// 	// $this->status[ 'differences'] = array_diff_assoc( $existing_post, $new_post );


	// 	// // $this->setStatus( 'existing', $existing_post  );
	// 	// // $this->setStatus( 'existing', $existing  );
	// 	// // $this->setStatus( 'new', $new_post );
	// 	// // $this->setStatus( 'new_mapped', $new_post );
	// 	// $this->setStatus( 'differences', $differences );

	// 	// return $differences;

	// 	// $differences = array_map( function( $field ) use $existing {
			
	// 	// }, $new );


	// 	// $this->status[ ' existing'] = $existing;
	// 	// $this->status[ ' new'] = $new;

	// 	// $this->status[ 'difference'][$post_id] = array_diff_assoc( $existing_post, $new_post );
	// 	// return $this->status[ 'difference'][$post_id];
		
	// 	// return array_diff_assoc( $existing_post, $new_post );
	// }

	// /**
	//  * Compare
	//  *
	//  * @param [type] $existing
	//  * @param [type] $new
	//  * @return void
	//  */
	// function compareField( $existing, $new ) {
	// 	return $existing !== $new;
	// }

	// /**
	//  * Get existing post matching
	//  * 
	//  * @see https://developer.wordpress.org/reference/classes/wp_query/
	//  *
	//  * @param object $post
	//  * @return array Return an array of post IDs
	//  */
	// function getExistingPost( $post ) {
	// 	return $this->queryPost( $post )->post;
	// }

	// 	/**
	//  * Get existing post matching
	//  * 
	//  * @see https://developer.wordpress.org/reference/classes/wp_query/
	//  *
	//  * @param object $post
	//  * @return array Return an array of post IDs
	//  */
	// function queryPost( $identifier ) {
	// 	$args = [
	// 		'post_type'			=> Event::POST_TYPE['id'],
	// 		'posts_per_page'	=> 1,
	// 		'meta_query'		=> [
	// 			[
	// 				'key' 			=> 'an_id',
	// 				'value' 		=> $identifier
	// 			]
	// 		]
	// 	];
	// 	return new \WP_Query( $args );
	// }

	// /**
	//  * The record has a post
	//  *
	//  * @param obj $post
	//  * @return boolean
	//  */
	// function doesExist( $post ) {
	// 	$query = $this->queryPost( $post );
	// 	return $query->have_posts();
	// }

	// /**
	//  * Compare existing to new data
	//  *
	//  * @param array $current
	//  * @param array $new
	//  * @return boolean
	//  */
	// function hasChanged( $post ) {
	// 	$current = $this->getExistingPost( $post );
	// 	return !empty( $this->getDifferences( $current, $post ) );
	// }

	// /**
	//  * Get duration in seconds
	//  *
	//  * @param string $started
	//  * @param string $completed
	//  * @return integer $seconds
	//  */
	// function getDuration( $started, $completed ) : integer {
	// 	$start = new \DateTime( $started );
	// 	$end = new \DateTime( $completed );
	// 	$diff = $start->diff( $end );
	// 	$daysInSecs = $diff->format( '%r%a' ) * 24 * 60 * 60;
	// 	$hoursInSecs = $diff->h * 60 * 60;
	// 	$minsInSecs = $diff->i * 60;

	// 	$seconds = $daysInSecs + $hoursInSecs + $minsInSecs + $diff->s;

	// 	return $seconds;
	// }

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
	function getTimezone( array $location ) {
		if( empty( $location['venue'] ) || 'Virtual' === $location['venue'] ) {
			return \get_option( 'timezone_string' );
		}
		$timezone = $this->getNearestTimezone( $location['latitude'], $location['longitude'] );
		return $timezone;
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
			  $tLat = $location['latitude'];
			  $tLng = $location['longitude'];
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
	 * Handle Errors
	 *
	 * @return void
	 */
	function handleError( $exception ) {
		$this->status = 'failed';
		$this->errors = $exception;
		$this->setStatus( 'errors', $this->errors );
		$this->completeSync();

		$this->errors = new \WP_Error( $exception );
		throw new \Exception( $exception );


		// if ( is_a( $results, '\WP_Error' ) ) {
		// 	$this->errors = new \WP_Error(); 
		// 	throw new \Exception();
		// }
	}


}
