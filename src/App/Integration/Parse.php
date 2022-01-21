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
use WpActionNetworkEvents\App\General\CustomFields;

/**
 * Parser
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
	 * @since 1.0.0
	 */
	public function init() {
		$this->parsed_data = $this->parseRecords( $this->data );
	}

	/**
	 * Parse Records
	 *
	 * @return array $parsed_records array of record objects
	 */
	public function parseRecords() : array {
		$parsed_records = array();
		if ( is_a( $this->data, '\WP_Error' ) ) {
			throw new \Exception( 'Failed at ' . __FUNCTION__ );
		}
		foreach ( $this->data as $record ) {
			$parsed_records[] = $this->parseRecord( $record );
		}

		// error_log( json_encode( $parsed_records ) );
		return (array) $parsed_records;
	}

	/**
	 * Parse Record
	 *
	 * @param object $record
	 * @return object $record
	 */
	public function parseRecord( object $record ) : object {
		$status    = Event::STATUSES[ $record->status ];
		$post_data = array();

		foreach ( CustomFields::FIELD_MAP as $key => $value ) {
			switch ( $key ) {
				case 'post_status':
					$post_data[ $key ] = $status;
					break;
				case 'an_id':
					$post_data[ $key ] = $record->identifiers[0];
					break;
				case 'location_venue':
					$post_data[ $key ] = $record->location->venue ?? 'Virtual';
					break;
				case 'location_latitude';
					$post_data[ $key ] = $record->location->location->latitude ?? '';
					break;
				case 'location_longitude';
					$post_data[ $key ] = $record->location->location->longitude ?? '';
					break;
				case '_links_to_target':
					$post_data[ $key ] = 'blank';
					break;

				default:
					$post_data[ $key ] = $record->{$value} ?? '';
					break;

			}
		}
		return (object) $post_data;
	}

	/**
	 * Get parsed data
	 *
	 * @return array $this->parsed_data
	 */
	public function getParsed() : array {
		return $this->parsed_data;
	}

}
