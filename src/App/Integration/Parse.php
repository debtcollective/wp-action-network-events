<?php

/**
 * Parser.
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
use WpActionNetworkEvents\App\Integration\Sync;
use WpActionNetworkEvents\App\Admin\Options;
use WpActionNetworkEvents\App\General\PostTypes\Event;

/**
 * Parser
 *
 *
 * @package    Wp_Action_Network_Events
 * @subpackage Wp_Action_Network_Events/admin
 * @author     Debt Collective <pea@misfist.com>
 */
class Parse extends Base {

	/**
	 * API Data
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      object    $data
	 */
	protected $data;

	/**
	 * Parsed Data
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $parsed_data
	 */
	protected $parsed_data;

	/**
	 * Status
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $status
	 */
	public $status;

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
	 * Field Mapping
	 *
	 * @var array
	 */
	protected $field_map = [
		'post_title'			=> 'title',
		'post_content'			=> 'description',
		'post_date'				=> 'created_date',
		'post_modified'			=> 'identifiers[0]',
		'post_status'			=> '',
		'browser_url'			=> 'browser_url',
		'_links_to'				=> 'browser_url',
		'_links_to_target'		=> 'blank',
		'an_id'					=> 'identifiers[0]',
		'instructions'			=> 'instructions',
		'start_date'			=> 'start_date',
		'end_date'				=> 'end_date',
		'featured_image'		=> 'featured_image_url',
		'location_venue'		=> 'location->venue',
		'location_latitude'		=> 'location->location->latitude',
		'location_longitude'	=> 'location->location->longitute',
		'status'				=> 'status',
		'visibility'			=> 'visibility',
		'an_campaign_id'		=> 'action_network:event_campaign_id',
		'internal_name'			=> 'name'
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
		$this->parsed_data = $this->parseRecords( $this->data );
		$this->setStatus( 'Parsed Data', $this->parsed_data );
	}

	/**
	 * Parse Records
	 *
	 * @return array $parsed_records
	 */
	public function parseRecords() {
		$parsed_records = [];
		$count = 0;
		foreach( $this->data as $record ) {
			array_push( $parsed_records, $this->parseRecord( $record ) );
			$count++;
		}
		if( is_a( $parsed_records, '\WP_Error' ) ) {
			$this->handleError( 'Failed at ' . __FUNCTION__ );
		}
		return $parsed_records;
	}

	/**
	 * Parse Records
	 *
	 * @param object $record
	 * @return object $record
	 */
	public function parseRecord( object $record ) : object {
		$status = Event::STATUSES[$record->status];
		$post_data = [];

		foreach( $this->field_map as $key => $value ) {
			switch( $key ) {
				case 'post_status' :
					$post_data[$key] = $status;
					break;
				case 'an_id' :
					$post_data[$key] = $record->identifiers[0];
					break;
				case 'location_venue' :
					$post_data[$key] = $record->location->venue ?? 'Virtual';
					break;
				case 'location_latitude';
					$post_data[$key] = $record->location->location->latitude;
					break;
				case 'location_longitude';
					$post_data[$key] = $record->location->location->longitude;
					break;
				case '_links_to_target' :
					$post_data[$key] = 'blank';
					break;
				default :
					$post_data[$key] = $record->{$value} ?? '';
				break;

			}


			// if( 'post_status' === $key ) {
			// 	$post_data[$key] = $status;
			// }
			// elseif( '_links_to_target' === $key ) {
			// 	$post_data[$key] = 'blank';
			// }
			// elseif( 'an_id' === $key ) {
			// 	$post_data[$key] = $record->identifiers[0];
			// }
			// else {
			// 	$post_data[$key] = $record->{$value} ?? '';
			// }
		}
		return (object) $post_data;
	}

	/**
	 * Get parsed data
	 *
	 * @return array $this->parsed_data
	 */
	public function getParsed() {
		return $this->parsed_data;
	}

}
