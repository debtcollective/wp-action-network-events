import { 
    registerBlockVariation
} from '@wordpress/blocks';

import { __ } from '@wordpress/i18n';

registerBlockVariation(
    'core/group',
    {
        name: 'inline-bullet-list',
        title: __( 'Inline Bullet List', 'wp-action-network-events' ),
        icon: 'editor-ul',
        category: 'components',
        keywords: [ 
            __( 'list', 'wp-action-network-events' ),
            __( 'grid', 'wp-action-network-events' )
        ],
        attributes: {
            className: 'inline-bullet-list'
        },
        supports: {
            __experimentalSelector: 'ul'
        },
        example: {
            attributes: {
                className: 'inline-bullet-list',
                content: ''
            },
        }
    },
);
