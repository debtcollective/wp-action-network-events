import {
	InnerBlocks,
	useBlockProps,
} from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

import classNames from 'classnames';

//  Import CSS.
import './editor.scss';
import './style.scss';

const TEMPLATE = [
	[
		'core/heading',
		{
			placeholder: __( 'Add Heading...', 'wp-action-network-events' ),
			level: 2,
			className: 'events__title',
		},
		[],
	],
	[
		'core/paragraph',
		{
			placeholder: __( 'Add Content...', 'wp-action-network-events' ),
			className: 'events__content',
		},
		[],
	],
	[
		'wp-action-network-events/event-query',
		{
			className: 'events__list',
		},
		[],
	],
];

const ALLOWED_BLOCKS = [ 'core/heading', 'core/paragraph', 'wp-action-network-events/event-query' ];

const Edit = ( props ) => {
	const {
		attributes,
		className,
		setAttributes,
	} = props;

	const blockProps = useBlockProps( {
		className: classNames( className, 'events' ),
	} );

	return (
		<div
			{ ...blockProps } >
			<InnerBlocks
				allowedBlocks={ ALLOWED_BLOCKS }
				template={ TEMPLATE }
				templateLock="all"
			/>
		</div>
	);
};

export default Edit;