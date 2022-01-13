<?php
/**
 * Iterator
 *
 * @since   1.0.0
 * @package WP_Action_Network_Events
 */

namespace WpActionNetworkEvents\Common\Util;

use Elliotchance\Iterator\AbstractPagedIterator;

class EventsIterator extends AbstractPagedIterator {

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
	protected $totalSize = 0;

	/**
	 * Number of records per page
	 *
	 * @var integer $pageSize
	 */
	protected $pageSize;

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
	public function __construct( $base_url = 'events', $endpoint, $options = array() ) {
		$this->pageSize     = isset( $options['per_page'] ) ? (int) $options['per_page'] : 25;
		$this->searchFilter = isset( $options['modified_date'] ) ? \esc_attr( $options['modified_date'] ) : '';
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

		$query    = array(
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
		$url             = $this->getUrl( $pageNumber );
		$result          = json_decode( file_get_contents( $url ), true );
		$this->totalSize = $result['total_count'];
		return $result['items'];
	}
}
