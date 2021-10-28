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
			placeholder: __( 'Add Heading...', 'site-functionality' ),
			level: 2,
			className: 'events__title',
		},
		[],
	],
	[
		'core/paragraph',
		{
			placeholder: __( 'Add Content...', 'site-functionality' ),
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