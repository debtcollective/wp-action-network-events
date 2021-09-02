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

	function getData() {}

	function parseRecords() {}

	function parseRecord() {}

	function compareRecords() {}

	function compareRecord() {}

	function updateRecords() {}

	function updateRecord() {}

	function addRecords() {}

	function addRecord() {}

	function deleteRecords() {}

	function deleteRecord() {}

	function exists() {}

	function hasChanged() {}
}
