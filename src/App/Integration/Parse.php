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
use WpActionNetworkEvents\App\General\PostTypes\Event;

/**
 * Plugin Options
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
	 * Field Mapping
	 *
	 * @var array
	 */
	protected $field_map = [
		'post_title'			=> 'name',
		'post_content'			=> 'description',
		'post_date'				=> 'created_date',
		'post_modified'			=> 'identifiers[0]',
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
		$this->parsed_data = parseRecords();
	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function parseRecords() {
		$data = $this->data->_embedded->{'osdi:events'};
		$records = [];
		$count = 0;
		foreach( $data as $record ) {
			array_push( $records, $this->parseRecord( $record ) );
			$count++;
		}
		if( is_a( $records, '\WP_Error' ) ) {
			$this->handleError( 'Failed at ' . __FUNCTION__ );
		}
		$this->status = "$count records parsed";
		return $records;
	}

	/**
	 * Parse Records
	 *
	 * @param object $record
	 * @return object $record
	 */
	public function parseRecord( object $record ) : object {
		$status = Event::STATUSES[$record->status];
		$record = [];
		foreach( $this->field_map as $key => $value ) {
			if( 'post_status' === $key ) {
				$record[$key] = $status;
			}
			elseif( '_links_to_target' === $key ) {
				$record[$key] = 'blank';
			}
			else {
				$record[$key] = $record->{$value};
			}
		}
		return $record;
	}


}
