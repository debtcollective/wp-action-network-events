/**
 * WordPress dependencies
 */
 import { 
	InnerBlocks, 
	InspectorControls, 
	useBlockProps,
	store as blockEditorStore
} from '@wordpress/block-editor';
 import { 
	CustomSelectControl,
	FormToggle,
	Panel, 
	PanelBody, 
	PanelRow,
	RangeControl,
	QueryControls,
	SelectControl,
	Spinner
} from '@wordpress/components';
import { 
	useEffect,
	useState, 
	useMemo
} from '@wordpress/element';
import { 
	useDispatch,
	useSelect
} from '@wordpress/data';
import { useInstanceId } from '@wordpress/compose';
import { 
	useEntityProp,
	store as coreStore
} from '@wordpress/core-data';
import { 
	__experimentalGetSettings,
	 dateI18n 
} from '@wordpress/date';
import { __, sprintf } from '@wordpress/i18n';

const BLOCK_TEMPLATE = [
	[ 'core/post-featured-image', {}, [] ],
	[ 'core/post-title', {}, [] ],
	[ 'wp-action-network-events/event-date', {}, [] ],
	[ 'wp-action-network-events/event-time', {}, [] ],
	[ 'wp-action-network-events/event-location', {}, [] ],
];

const MAX_ITEMS = 24;

const Edit = ( props ) => {

	const { 
		attributes, 
		className, 
		setAttributes, 
		isSelected 
	} = props;

	const{ 
		queryId,
		taxonomy, 
		postType, 
		eventTags, 
		perPage,
		orderby,
		query,
		dateFormat,
		timeFormat,
		display: {
			tagName,
			showTags,
			showFeaturedImage,
			showTitle,
			showDate,
			showTime,
			showLocation
		}
	} = attributes;

	// const {
	// 	tagName,
	// 	showTags,
	// 	showFeaturedImage,
	// 	showTitle,
	// 	showDate,
	// 	showTime,
	// 	showLocation
	// } = display;

	const instanceId = useInstanceId( Edit );

	const [ siteDateFormat ] = useEntityProp( 'root', 'site', 'date_format' );
	const [ siteTimeFormat ] = useEntityProp( 'root', 'site', 'time_format' );
	const settings = __experimentalGetSettings();
	const resolvedDateFormat = dateFormat || siteDateFormat || settings.formats.date;
	const resolvedTimeFormat = timeFormat || siteTimeFormat  || settings.formats.date;

	const { __unstableMarkNextChangeAsNotPersistent } = useDispatch(
		blockEditorStore
	);

	const posts = useSelect(
		( select ) => {
			console.log( query );

			return select( 'core' ).getEntityRecords( 'postType', postType, query )
		},
		[ query ]
	);

	const setTerms = ( value ) => {
		setAttributes( {
			eventTags: value
		} );
	}

	const setPerPage = ( value ) => {
		setAttributes( {
			perPage: value
		} );
	}

	const setOrderBy = ( value ) => {
		setAttributes( {
			orderby: value
		} );
	}

	const TermSelector = () => {
		const terms = useSelect( ( select ) => {
			return select( 'core' ).getEntityRecords( 'taxonomy', taxonomy );
		}, [] );

		if( !terms || !terms.length ) {
			return <Spinner />;
		}

		const options = terms.map( ( { id, name } ) => ( { value: id, label: name } ) );

		return (
			<>
				<SelectControl
					label={ __( 'Tag', 'wp-action-network-events' ) }
					options={ [ { value: "", label: __( 'Select a Tag', 'wp-action-network-events' ) }, ...options ] }
					onChange={ setTerms }
					value={ eventTags }
				/>
			</>
		);
	};

	const PerPageSelector = () => {
		return (
			<RangeControl
				key="query-controls-range-control"
				label={ __( 'Number of Posts', 'wp-action-network-events' ) }
				value={ perPage }
				onChange={ setPerPage }
				min={ 1 }
				max={ MAX_ITEMS }
			/>
		);
	};

	const OrderSelector = () => {

		const options = [
			{
				value: "start/desc",
				label: __( 'Soonest to Latest', 'wp-action-network-events' )
			},
			{
				value: "start/asc",
				label: __( 'Latest to Soonest', 'wp-action-network-events' )
			},
			{
				value: "title/asc",
				label: __( 'A → Z', 'wp-action-network-events' )
			},
			{
				value: "title/desc",
				label: __( 'Z → A', 'wp-action-network-events' )
			}
		];

		if( !options || !options.length ) {
			return <Spinner />;
		}

		return (
			<>
				<SelectControl
					label={ __( 'Order By', 'wp-action-network-events' ) }
					options={ options }
					onChange={ setOrderBy }
					value={ orderby }
				/>
			</>
		);
	};

	const DateFormatSelector = () => {
		const date = new Date();
		const options = Object.values( settings.formats ).map(
			( formatOption ) => ( {
				key: formatOption,
				name: dateI18n( formatOption, date ),
			} )
		);
		
		return (
			<>
				<CustomSelectControl
					label={ __( 'Date Format', 'wp-action-network-events' ) }
					options={ options }
					onChange={ ( { selectedItem } ) =>
						setAttributes( {
							dateFormat: selectedItem.key,
						} )
					}
					value={ options.find(
						( option ) => option.key === resolvedDateFormat
					) }
				/>
			</>
		);
	};

	const TimeFormatSelector = () => {
		const date = new Date();
		const options = Object.values( settings.formats ).map(
			( formatOption ) => ( {
				key: formatOption,
				name: dateI18n( formatOption, date ),
			} )
		);

		return (
			<>
				<CustomSelectControl
					label={ __( 'Time Format', 'wp-action-network-events' ) }
					options={ options }
					onChange={ ( { selectedItem } ) =>
						setAttributes( {
							timeFormat: selectedItem.key,
						} )
					}
					value={ options.find(
						( option ) => option.key === resolvedTimeFormat
					) }
				/>
			</>
		);
	};

	const SettingsPanel = () => (
		<>
		<PanelBody title={ __( 'Query Options', 'wp-action-network-events' ) } initialOpen={ true }>
			<PanelRow>
				<TermSelector />
			</PanelRow>
			<PanelRow>
				<OrderSelector />
			</PanelRow>
			<PanelRow>
				<PerPageSelector />
			</PanelRow>
		</PanelBody>
		<PanelBody title={ __( 'Display Options', 'wp-action-network-events' ) } initialOpen={ true }>
			<PanelRow>
				<DateFormatSelector />
			</PanelRow>
			<PanelRow>
				<TimeFormatSelector />
			</PanelRow>
		</PanelBody>
		</>
	);

	const Posts = () => {

		if( !posts ) {
			return <Spinner />
		}

		if( !posts.length ) {
			return ':{'
		}

		return (
			<>
				{ console.log( query ) }
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
					<time dateTime={ post.meta?.["_start_date"] }>{ dateI18n( dateFormat, post.meta?.["_start_date"] ) }</time>
				</div>
				<div className="event__time">
					<time dateTime={ post.meta?.["_start_date"] }>{ dateI18n( timeFormat, post.meta?.["_start_date"] ) }</time>
				</div>
				<div className="event__location" dangerouslySetInnerHTML={{ __html: post.meta?.["_location_venue"] }}></div>
			</article>
		)
	}

	const NoPosts = () => {
		return (
			<div className="no-posts">
				No posts
			</div>
		)
	}

	const blockProps = useBlockProps();

	const updateQuery = () => {
		let _query = query;

		const _ordering = orderby.split( '/' );
		_query = { 
			..._query, 
			per_page: parseInt( perPage ),
			order: _ordering[1],
			orderby: _ordering[0],
			"event-tags": eventTags ? [ parseInt( eventTags ) ] : [],
		}

		setAttributes( { 
			query: { 
				...query, 
				..._query 
			} 
		} );
	}

	useEffect( () => {
        updateQuery();
    }, [ eventTags, perPage, orderby ] );

	useEffect( () => {
		if ( ! queryId ) {
			__unstableMarkNextChangeAsNotPersistent();
			setAttributes( { 
				queryId: instanceId 
			} );
		}
		if ( ! dateFormat ) {
			__unstableMarkNextChangeAsNotPersistent();
			setAttributes( { 
				dateFormat: resolvedDateFormat
			} );
		}
		if ( ! timeFormat ) {
			__unstableMarkNextChangeAsNotPersistent();
			setAttributes( { 
				timeFormat: resolvedTimeFormat
			} );
		}
	}, [ queryId, instanceId, dateFormat, timeFormat ] );

	return (
		<>
		<InspectorControls>
			<SettingsPanel />
		</InspectorControls>

		<div { ...blockProps }>
			<Posts />
		</div>
		</>
	);
};

export default Edit;
