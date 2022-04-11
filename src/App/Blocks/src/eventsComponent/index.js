/**
 * WordPress dependencies
 */
 import { __ } from '@wordpress/i18n';

 /**
  * Internal dependencies
  */
 import metadata from './block.json';
 import Edit from './edit';
 import Save from './save';

 //  Import CSS.
// import './editor.scss';
// import './style.scss';
 
 const { name, category } = metadata;
 
 const variations = [
	 {
		 name: 'events-by-tag',
		 title: __( 'Events by Tag', 'wp-action-network-events' ),
		 icon: 'calendar-alt',
		 isDefault: true,
		 category: 'events',
		 description: __( 'Display events with section header and description..', 'wp-action-network-events' ),
		 keywords: [
			 __( 'event', 'wp-action-network-events' ),
			 __( 'grid', 'wp-action-network-events' ),
			 __( 'component', 'wp-action-network-events' )
		 ],
		 attributes: {
			 className: 'events-by-tag'
		 },
		 innerBlocks: [
			 [
				 'core/heading',
				 {
					 className: 'taxonomy-label',
					 level: 2,
					 placeholder: __( 'Add Title...', 'wp-action-network-events' ),
				 },
			 ],
			 [
				 'core/paragraph',
				 {
					 className: 'taxonomy-description',
					 placeholder: __( 'Add Description...', 'wp-action-network-events' ),
				 },
			 ],
			 [
				 'wp-action-network-events/event-query',
				 {
					 query: {
						 per_page: 3,
						 order: 'desc',
						 orderby: 'start'
					 },
					 dateFormat: 'l F j, Y',
					 display: {
						 showTags: false,
						 showFeaturedImage: false,
						 showTitle: true,
						 showDate: true,
						 showTime: true,
						 showEndTime: true,
						 showLocation: true
					 }
				 },
			 ],
		 ],
		 scope: [
			 'block',
			 'inserter',
			 'transform'
		 ],
	 },
	 {
		 name: 'events-by-tag-welcome-calls',
		 title: __( 'Welcome Calls', 'wp-action-network-events' ),
		 description: __( 'Display welcome call events with section header and description..', 'wp-action-network-events' ),
		 icon: 'calendar-alt',
		 keywords: [
			 __( 'event', 'wp-action-network-events' ),
			 __( 'grid', 'wp-action-network-events' ),
			 __( 'component', 'wp-action-network-events' )
		 ],
		 attributes: {
			 className: 'events-by-tag welcome-calls'
		 },
		 innerBlocks: [
			 [
				 'core/heading',
				 {
					 className: 'taxonomy-label',
					 level: 2,
					 placeholder: __( 'Add Title...', 'wp-action-network-events' ),
					 content: __( 'Welcome Calls', 'wp-action-network-events' )
				 },
			 ],
			 [
				 'core/paragraph',
				 {
					 className: 'taxonomy-description',
					 placeholder: __( 'Add Description...', 'wp-action-network-events' ),
					 content: __( 'Are you new to the Debt Collective or the Biden Jubilee 100 campaign and want to learn more about our union and what we\'re fighting for? Join us for our welcome calls!', 'wp-action-network-events' )
				 },
			 ],
			 [
				 'wp-action-network-events/event-query',
				 {
					 query: {
						 per_page: 3,
						 order: 'desc',
						 orderby: 'start',
						 'event-tags': [10]
					 },
					 eventTags: '10',
					 dateFormat: 'D, M j',
					 timeFormat: 'g:ia',
					 display: {
						 showTags: false,
						 showFeaturedImage: false,
						 showTitle: false,
						 showDate: true,
						 showTime: true,
						 showEndTime: false,
						 showLocation: true
					 }
				 },
			 ],
		 ],
		 scope: [
			 'transform',
			 'inserter'
		 ],
	 }
 ];
 
 const settings = {
	 edit: Edit,
	 save: Save,
	 variations
 };
 
 export { name, category, settings };
 