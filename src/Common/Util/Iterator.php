<?php
/**
 * Iterator
 *
 * @since   1.0.0
 * @package WP_Action_Network_Events
 */

namespace WpActionNetworkEvents\Common\Util;

use Elliotchance\Iterator\AbstractPagedIterator;

class Iterator extends AbstractPagedIterator {

	/**
	 * API Key
	 *
	 * @var string
	 */
	private $api_key;


	/**
	 * Base URL
	 *
	 * @var string
	 */
	protected $base_url;

	/**
	 * Endpoint
	 *
	 * @var string $endpoint
	 */
	protected $endpoint;

	/**
	 * Total number of records
	 *
	 * @var integer $totalSize
	 */
	public $totalSize = 0;

	/**
	 * Number of records per page
	 *
	 * @var integer $pageSize
	 */
	public $pageSize;

	/**
	 * Search Filters
	 *
	 * @var string $searchFilter
	 */
	protected $searchFilter;

	/**
	 * Constructor
	 *
	 * @param array $options
	 */
	public function __construct( $base_url, $endpoint = 'events', $api_key, $options = array() ) {
		$this->pageSize     = isset( $options['per_page'] ) ? (int) $options['per_page'] : 25;
		$this->searchFilter = isset( $options['modified_date'] ) ? \esc_attr( $options['modified_date'] ) : '';
		$this->api_key      = $api_key;
		$this->base_url     = $base_url;
		$this->endpoint     = $endpoint;

		// this will make sure totalSize is set before we try and access the data
		$this->getPage( 0 );
	}

	/**
	 * Get var
	 *
	 * @return int $this->totalSize
	 */
	public function getTotalSize() {
		return $this->totalSize;
	}

	/**
	 * Get var
	 *
	 * @return int $this->pageSize
	 */
	public function getPageSize() {
		return $this->pageSize;
	}

	/**
	 * Build URL
	 *
	 * @param int    $pageNumber
	 * @param string $modified_date
	 * @return string$url
	 */
	public function getUrl( $pageNumber ) {
		$endpoint = \esc_url( $this->base_url . $this->endpoint );

		$query = array(
			'page' => $pageNumber + 1,
		);

		$query['per_page'] = (int) $this->pageSize;

		if ( $this->modified_date ) {
			$query['filter'] = "modified_date gt '{$this->modified_date}'";
		}

		$query_string = http_build_query( $query );

		$url = $query_string ? "$endpoint?$query_string" : $endpoint;

		return $url;
	}

	/**
	 * Get Records for Page
	 *
	 * @param int $pageNumber
	 * @return void
	 */
	public function getPage( $pageNumber ) {
		try {
			$response        = json_decode( \wp_remote_retrieve_body( $this->loadPage( $pageNumber ) ), true );
            error_log( $response );
			$this->totalSize = $response->total_records;
		} catch ( Exception $exception ) {
			$response = null;
			error_log( $exception->getMessage() );
		}
		return $response;
	}

	/**
	 * Load Records
	 *
	 * @param int $pageNumber
	 * @return object $request || Exception
	 */
	public function loadPage( $pageNumber ) {
		$url     = $this->getUrl( $pageNumber );
		$options = array(
			'headers'     => array(
				'Content-Type'   => 'application/json',
				'OSDI-API-Token' => $this->api_key,
			),
			'timeout'     => 100,
			'redirection' => 5,
		);

		$request = \wp_remote_get( $url, $options );

		if ( is_a( $request, 'WP_Error' ) ) {
			throw new \Exception();
		}

		return $request;
	}
}
