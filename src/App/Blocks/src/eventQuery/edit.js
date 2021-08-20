/**
 * WordPress dependencies
 */
 import { 
	Panel, 
	PanelBody, 
	PanelRow,
	RangeControl,
	QueryControls,
	SelectControl,
	Spinner
} from '@wordpress/components';
import { 
	useEntityProp,
	store as coreStore
} from '@wordpress/core-data';
import { 
	useState, 
	useMemo
} from '@wordpress/element';
import { useSelect } from '@wordpress/data';
import { 
	__experimentalGetSettings,
	 dateI18n 
} from '@wordpress/date';
import { 
	InnerBlocks, 
	InspectorControls, 
	useBlockProps
} from '@wordpress/block-editor';
import { more } from '@wordpress/icons';
import { __, sprintf } from '@wordpress/i18n';

const MAX_ITEMS = 24;

const Edit = ( props ) => {

	const { 
		attributes, 
		className, 
		setAttributes, 
		isSelected 
	} = props;

	const{ 
		taxonomy, 
		eventTagId, 
		postType, 
		perPage,
		orderBy,
		metaKey,
		query
	} = attributes;

	const [ siteDateFormat ] = useEntityProp( 'root', 'site', 'date_format' );
	const [ siteTimeFormat ] = useEntityProp( 'root', 'site', 'time_format' );
	const settings = __experimentalGetSettings();

	console.log( siteDateFormat, siteTimeFormat, settings );

	// const getStartDate = ( postID ) => {
	// 	const [ meta ] = useEntityProp( 'postType', postType, 'meta', postId, true );
	// 	const date = meta[ '_start_date' ];
	// 	return date;
	// }

	// // To know if the current time format is a 12 hour time, look for "a".
	// // Also make sure this "a" is not escaped by a "/".
	// const is12Hour = /a(?!\\)/i.test(
	// 	settings.formats.time
	// 		.toLowerCase() // Test only for the lower case "a".
	// 		.replace( /\\\\/g, '' ) // Replace "//" with empty strings.
	// 		.split( '' )
	// 		.reverse()
	// 		.join( '' ) // Reverse the string and test for "a" not followed by a slash.
	// );
	// const formatOptions = Object.values( settings.formats ).map(
	// 	( formatOption ) => ( {
	// 		key: formatOption,
	// 		name: dateI18n( formatOption, date ),
	// 	} )
	// );
	// const resolvedFormat = format || siteDateFormat || settings.formats.date;

	const TermSelector = () => {
		const terms = useSelect( ( select ) => {
			return select( 'core' ).getEntityRecords( 'taxonomy', taxonomy );
		}, [] );

		const setTerm = ( term ) => {
			setAttributes( {
				eventTagId: term
			} );

			setQuery( 'eventTagId', term );
		}

		if( !terms || !terms.length ) {
			return <Spinner />;
		}

		const options = terms.map( ( { id, name } ) => ( { value: id, label: name } ) );

		return (
			<>
				<SelectControl
					label={ __( 'Tag', 'wp-action-network-events' ) }
					options={ [ { value: "", label: __( 'Select a Tag', 'wp-action-network-events' ) }, ...options ] || [ { value: "", label: __( 'Loading...', 'wp-action-network-events' ) } ] }
					onChange={ setTerm }
					value={ eventTagId }
				/>
			</>
		);
	};

	const PerPostSelector = () => {

		const setValue = ( value ) => {
			setAttributes( {
				perPage: value
			} );
			setQuery( 'perPage', value );
		}

		return (
			<RangeControl
				key="query-controls-range-control"
				label={ __( 'Number of Posts', 'wp-action-network-events' ) }
				value={ perPage }
				onChange={ setValue }
				min={ 1 }
				max={ MAX_ITEMS }
			/>
		);
	};

	const OrderSelector = () => {

		const options = [
			{
				value: "meta_value/desc",
				label: __( 'Soonest to Latest', 'wp-action-network-events' )
			},
			{
				value: "meta_value/asc",
				label: __( 'Latest to Soonest', 'wp-action-network-events' )
			},
			{
				value: "title/asc",
				label: __( 'A → Z', 'wp-action-network-events' )
			},
			{
				value: "title",
				label: __( 'Z → A', 'wp-action-network-events' )
			}
		];

		const setOrderBy = ( value ) => {
			setAttributes( {
				orderBy: value
			} );

			setQuery( 'orderBy', value );
		}

		if( !options || !options.length ) {
			return <Spinner />;
		}

		return (
			<>
				<SelectControl
					label={ __( 'Order By', 'wp-action-network-events' ) }
					options={ options }
					onChange={ setOrderBy }
					value={ orderBy }
				/>
			</>
		);
	};

	const SettingsPanel = () => (
		<PanelBody title={ __( 'Query Options', 'wp-action-network-events' ) } initialOpen={ true }>
			<PanelRow>
				<TermSelector />
			</PanelRow>
			<PanelRow>
				<OrderSelector />
			</PanelRow>
			<PanelRow>
				<PerPostSelector />
			</PanelRow>
		</PanelBody>
	);

	const setQuery = ( prop, value ) => {
		let _query = query;

		switch( prop ) {
			case 'perPage' :

				_query = { ...query, per_page: parseInt( value ) }

				break;
			case 'orderBy' :
				const _ordering = value.split( '/' );
				_query = { ..._query, orderby: _ordering[0], order: _ordering[1] }

				if( 'meta_value' === _query.orderby ) {
					_query = { ..._query, meta_key: metaKey }
				} else {
					_query = { ..._query, meta_key: null }
				}

				break;
			case 'eventTagId' :
				console.log( 'eventTagId', value );

				_query = { ..._query, "event-tags": [parseInt( value )] }

				break;
		}

		setAttributes( {
			query: _query
		} );
	}

	const Posts = () => {
		const posts = useSelect( ( select ) => {
			const eventsQuery = {};

			console.log( query );

			return select( 'core' ).getEntityRecords( 'postType', postType, eventsQuery );
		} );

		if( !posts || !posts.length ) {
			return <Spinner />
		}

		return (
			<>
				{ posts.map( post => {
					return (
						<Post { ...post } key={post.id} />
					);
				}) }
			</>
		)
	}

	const Post = ( post ) => {
		return (
			<article className={`${post.type}`}>
				<h2 className="event__title"><a link={ post.link } rel="bookmark" dangerouslySetInnerHTML={{ __html: post?.title?.rendered }} /></h2>
				<div className="event__date">
					<time dateTime={ post.meta?.["_start_date"] }>{ post.meta?.["_start_date"] }</time>
				</div>
				<div className="event__time">
					<time dateTime={ post.meta?.["_start_date"] }>{ post.meta?.["_start_date"] }</time>
				</div>
				<div className="event__location" dangerouslySetInnerHTML={{ __html: post.meta?.["_location_venue"] }}></div>
			</article>
		)
	}


	// if( posts ) {
	// 	console.log( posts );
	// }

	const blockProps = useBlockProps();

	return (
		<>
		<InspectorControls>
			<SettingsPanel />
		</InspectorControls>

		<div { ...blockProps }>
			Posts
			<Posts />
		</div>
		</>
	);
};

export default Edit;
