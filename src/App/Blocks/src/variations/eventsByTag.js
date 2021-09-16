import { 
    registerBlockVariation
} from '@wordpress/blocks';

import { __ } from '@wordpress/i18n';

registerBlockVariation(
    'core/group',
    {
        name: 'events-by-tag-welcome-calls',
        title: __( 'Welcome Calls', 'wp-action-network-events' ),
        attributes: {
            tagName: 'div',
            className: 'events-by-tag welcome-calls'
        },
        innerBlocks: [
			[ 'core/heading', {
                className: 'taxonomy-label',
                level: 2,
                placeholder: __( 'Add Title...', 'wp-action-network-events' ),
                content: __( 'Welcome Calls', 'wp-action-network-events' )
            } ],
			[ 'core/paragraph', {
                className: 'taxonomy-description',
                placeholder: __( 'Add Description...', 'wp-action-network-events' ),
                content: __( 'Are you new to the Debt Collective or the Biden Jubilee 100 campaign and want to learn more about our union and what we’re fighting for? Join us for our welcome calls!', 'wp-action-network-events' )
            } ],
			[ 'wp-action-network-events/event-query', {
                query:{
                    per_page:3,
                    order: 'desc',
                    orderby: 'start'
                },
                dateFormat: 'F j, Y',
                display:{
                    showTags: false,
                    showFeaturedImage: false,
                    showTitle: false,
                    showDate: true,
                    showTime: true,
                    showLocation: true
                }
            } ]
		]
    },
);