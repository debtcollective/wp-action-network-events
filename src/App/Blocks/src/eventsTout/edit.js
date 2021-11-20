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
			level: 3,
			className: 'events-tout__title',
		},
		[],
	],
	[
		'wp-action-network-events/event-query',
		{
			className: 'events-tout__list'
		},
		[],
	],
	[
		'core/button',
		{
			className: 'events-tout__button btn jade',
			content: __( 'See More Events', 'wp-action-network-events' ) 
		},
		[],
	],
];

const ALLOWED_BLOCKS = [ 
	'core/heading', 
	'wp-action-network-events/event-query', 
	'core/button'
];

const Edit = ( props ) => {
	const {
		attributes,
		className,
		setAttributes,
	} = props;

	const blockProps = useBlockProps( {
		className: classNames( className, 'events-tout' ),
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