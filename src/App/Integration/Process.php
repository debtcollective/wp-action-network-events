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
use WpActionNetworkEvents\App\General\CustomFields;

/**
 * Plugin Options
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
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $version, $plugin_name, array $data ) {
		parent::__construct( $version, $plugin_name );
		$this->data           = $data;
		$this->processed_data = array();
		$this->log            = array(
			'new'     => array(),
			'updated' => array(),
			'skipped' => array(),
			'error'   => array(),
		);
		$this->init();
	}

	/**
	 * Kick it off.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		$this->evaluatePosts();
	}

	/**
	 * Evaluate posts
	 *
	 * @return void
	 */
	public function evaluatePosts() {
		foreach ( $this->data as $post ) {
			$post_id = $this->evaluatePost( $post );
			if ( $post_id ) {
				$this->processed_data[] = $post_id;
			}
		}
		return $this->log;
	}

	/**
	 * Evaluate Post
	 *
	 * @param object $post
	 * @return mixed int $post_id || false
	 */
	function evaluatePost( $post ) {
		$result      = false;
		$search_post = $this->getPost( $post->an_id );

		if ( \is_wp_error( $search_post ) ) {
			$this->setLog( 'error', $post->an_id );
		} elseif ( empty( $search_post ) ) {
			$result = $this->addPost( $post );
		} elseif ( $this->hasChanged( $search_post[0], $post ) ) {
			$existing_post = $search_post[0];
			if ( $this->isAnEvent( $existing_post ) ) {
				$result = $this->updatePost( $existing_post, $post );
			} else {
				$this->setLog( 'skipped', $existing_post->ID );
			}
		} else {
			$this->setLog( 'skipped', $post->an_id );
		}
		if ( ! $result ) {
			$this->setStatus( 'process', 'error' );
		} else {
			$this->setStatus( 'process', 'success' );
		}
		return $result;
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
		$post_id = null;

		$timezone = $this->getTimezone(
			array(
				'venue'     => $post->location_venue,
				'latitude'  => $post->location_latitude,
				'longitude' => $post->location_longitude,
			)
		);

		$post_array = array(
			'post_date'    => $post->post_date,
			'post_title'   => \esc_attr( $post->post_title ),
			'post_content' => \wp_kses_post( $post->post_content ),
			'post_status'  => \esc_attr( $post->post_status ),
			'post_type'    => Event::POST_TYPE['id'],
			// 'import_id'    => \esc_attr( $post->an_id ),
			'meta_input'   => array(
				'is_an_event'        => 1,
				'browser_url'        => \esc_url( $post->browser_url ),
				'_links_to'          => \esc_url( $post->browser_url ),
				'_links_to_target'   => \esc_attr( $post->_links_to_target ),
				'an_id'              => \esc_attr( $post->an_id ),
				'instructions'       => $post->instructions,
				'start_date'         => $post->start_date,
				'end_date'           => $post->end_date,
				'timezone'           => $timezone,
				// 'featured_image'		=> $post->featured_image,
				'location_venue'     => ( ! empty( $post->location_venue ) ) ? \esc_attr( $post->location_venue ) : 'Virtual',
				'location_latitude'  => floatval( $post->location_latitude ),
				'location_longitude' => floatval( $post->location_longitude ),
				'status'             => \esc_attr( $post->status ),
				'visibility'         => \esc_attr( $post->visibility ),
				'an_campaign_id'     => ( ! empty( $post->{'action_network:event_campaign_id'} ) ) ? \esc_attr( $post->{'action_network:event_campaign_id'} ) : '',
				'hidden'             => $post->hidden,
				'import_date'        => date( $this->date_format ),
			),
		);

		$post_id = \wp_insert_post( $post_array );

		if ( is_a( $post_id, '\WP_Error' ) ) {
			error_log( 'Failed at ' . __FUNCTION__ );
			$this->setLog( 'error', $post_id );
			throw new \Exception( \__( 'Error encountered in ' . __FUNCTION__, 'wp-action-network-events' ) );
		} elseif ( $post_id ) {
			$this->setStatus( 'new', $post_id );
			$this->setLog( 'new', $post_id );
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
		foreach ( $posts as $post ) {
			$post_id = $this->updatePost( $post );
		}
	}

	/**
	 * Update changed post
	 *
	 * @see https://developer.wordpress.org/reference/functions/wp_update_post/
	 *
	 * @return mixed (int|WP_Error) The post ID on success. The value 0 or WP_Error on failure.
	 */
	function updatePost( object $existing, object $incoming ) {
		$post_id = false;

		if ( ! $existing->is_an_event || ! $existing->an_id ) {
			$this->setLog( 'skipped', $existing->ID );
			return $post_id;
		}

		if ( $differences = $this->getDifferences( (object) $existing, $incoming ) ) {
			$differences['ID'] = $existing->ID;
			$post_id           = \wp_update_post( $differences );

			if ( is_a( $post_id, '\WP_Error' ) ) {
				$this->setLog( 'error', $post_id );
				throw new \Exception( \__( 'Error encountered in ' . __FUNCTION__, 'wp-action-network-events' ) );
			} elseif ( $post_id ) {
				$this->setLog( 'updated:', $post_id );
			}
		}

		return $post_id;
	}

	/**
	 * Add remote image
	 *
	 * @param array $post
	 * @param int   $post_id
	 * @return void
	 */
	function addFeaturedImage( $post, $post_id ) {
		$desc = \sanitize_title_with_dashes( $post->post_title );

		$image = \media_sideload_image( $post->featured_image, $post_id, $desc );
		if ( is_a( $image, '\WP_Error' ) ) {
			$this->handleError( 'Failed at ' . __FUNCTION__ );
			// throw new \Exception( \__( 'Error encountered in ' . __FUNCTION__, 'wp-action-network-events' ) );
		}
		return $image;
	}

	/**
	 * Get Existing
	 *
	 * @param string $record_identifier
	 * @return array
	 */
	public function getPost( string $record_identifier ) : array {
		$args  = array(
			'posts_per_page' => 1,
			'post_type'      => Event::POST_TYPE['id'],
			'meta_query'     => array(
				array(
					'key'     => 'is_an_event',
					'value'   => array( '1', true ),
					'compare' => 'IN',
				),
				array(
					'key'   => 'an_id',
					'value' => $record_identifier,
				),
			),
		);
		$query = new \WP_Query( $args );
		return $query->get_posts();
	}

	/**
	 * Get Differences
	 *
	 * @param object $existing
	 * @param object $incoming
	 * @return array $differences
	 */
	public function getDifferences( object $existing, object $incoming ) : array {
		$differences = array();

		if ( ! $this->isAnEvent( $existing ) ) {
			return $differences;
		}

		$timezone = $this->getTimezone(
			array(
				'venue'     => $incoming->location_venue,
				'latitude'  => $incoming->location_latitude,
				'longitude' => $incoming->location_longitude,
			)
		);

		$post_fields = array(
			'post_title',
			'post_modified',
			'post_content',
			'post_status',
		);

		$post_meta = array(
			'browser_url',
			'_links_to',
			'_links_to_target',
			'an_id',
			'instructions',
			'start_date',
			'end_date',
			'timezone',
			'location_venue',
			'location_latitude',
			'location_longitude',
			'status',
			'visibility',
			'an_campaign_id',
			'hidden',
			'update_date',
		);

		foreach ( $post_fields as $field ) {
			if ( ! isset( $existing->{$field} ) || ( isset( $existing->{$field} ) && $this->isDifferent( $existing->{$field}, $incoming->{$field} ) ) ) {
				error_log( sprintf( 'Existing: %s | New %s | Test: ', $existing->{$field}, $incoming->{$field}, $this->isDifferent( $existing->{$field}, $incoming->{$field} ) ) );
				$differences[ $field ] = $incoming->{$field};
			}
		}

		foreach ( $post_meta as $field ) {
			$meta = \get_post_meta( $existing->ID, $field, true );
			if ( ! $meta || ( $meta && $this->isDifferent( $meta, $incoming->{$field} ) ) ) {
				error_log( sprintf( 'Existing: %s | New %s', $meta, $incoming->{$field} ) );

				switch ( $field ) {
					case 'update_date':
						$differences['meta_input']['update_date'] = date( $this->date_format );
						break;
					case 'timezone':
						$differences['meta_input']['timezone'] = $timezone;
						break;
					case 'location_venue':
						$differences['meta_input']['location_venue'] = ( ! empty( $incoming->location_venue ) ) ? \esc_attr( $incoming->location_venue ) : 'Virtual';
						break;
					default:
						$differences['meta_input'][ $field ] = $incoming->{$field};
						break;
				}
			}
		}

		return $differences;
	}

	/**
	 * Check if record exists
	 *
	 * @param string $record_identifier
	 * @return bool
	 */
	public function doesExist( string $record_identifier ) : bool {
		$args  = array(
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'post_type'      => Event::POST_TYPE['id'],
			'meta_query'     => array(
				array(
					'key'     => 'is_an_event',
					'value'   => array( '1', true ),
					'compare' => 'IN',
				),
				array(
					'key'   => 'an_id',
					'value' => $record_identifier,
				),
			),
		);
		$query = new \WP_Query( $args );
		return $query->have_posts();
	}

	/**
	 * Check if is AN event
	 *
	 * @since 1.0.1
	 *
	 * @param object $post
	 * @return boolean
	 */
	public function isAnEvent( $post ) : bool {
		return \get_post_meta( $post->ID, 'is_an_event', true );
	}

	/**
	 * Check if post has changed
	 *
	 * @param object $existing
	 * @param object $incoming
	 * @return bool
	 */
	public function hasChanged( $existing, $incoming ) : bool {
		return $existing->post_modified < $incoming->post_modified;
	}

	/**
	 * Check if values are different
	 *
	 * @param mixed $existing
	 * @param mixed $incoming
	 * @return bool
	 */
	public function isDifferent( $existing, $incoming ) : bool {
		return $existing != $incoming;
	}

	/**
	 * Get the data
	 *
	 * @return $this->processed_data
	 */
	public function getProcessed() {
		return $this->processed_data;
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
		return $dateTime->format( 'T' );
	}

	/**
	 * Get Timezone
	 *
	 * @param array $location
	 * @return string timezone
	 */
	function getTimezone( array $location ) {
		if ( empty( $location['venue'] ) || 'Virtual' === $location['venue'] ) {
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
	 * @param string   $country_code
	 * @return string $timezone
	 */
	function getNearestTimezone( $latitude, $longitude ) : string {
		$diffs            = array();
		$default_timezone = \get_option( 'timezone_string' );
		foreach ( \DateTimeZone::listIdentifiers() as $timezoneId ) {
			  $timezone             = new \DateTimeZone( $timezoneId );
			  $location             = $timezone->getLocation();
			  $tLat                 = $location['latitude'];
			  $tLng                 = $location['longitude'];
			  $diffLat              = abs( $latitude - $tLat );
			  $diffLng              = abs( $longitude - $tLng );
			  $diff                 = $diffLat + $diffLng;
			  $diffs[ $timezoneId ] = $diff;
		}

		$timezone = array_keys( $diffs, min( $diffs ) );

		if ( $timezone && is_array( $timezone ) ) {
			return $timezone[0];
		}
		return $default_timezone;
	}

	/**
	 * Set log
	 *
	 * @since 1.0.1
	 *
	 * @param string $prop
	 * @param mixed  $value
	 * @return void
	 */
	public function setLog( $prop, $value ) {
		$this->log[ $prop ][] = $value;
	}

}
