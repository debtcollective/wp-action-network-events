/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/@wordpress/icons/build-module/library/map-marker.js":
/*!**************************************************************************!*\
  !*** ./node_modules/@wordpress/icons/build-module/library/map-marker.js ***!
  \**************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/primitives */ "@wordpress/primitives");
/* harmony import */ var _wordpress_primitives__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__);


/**
 * WordPress dependencies
 */

const mapMarker = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__.SVG, {
  xmlns: "https://www.w3.org/2000/svg",
  viewBox: "0 0 24 24"
}, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__.Path, {
  d: "M12 9c-.8 0-1.5.7-1.5 1.5S11.2 12 12 12s1.5-.7 1.5-1.5S12.8 9 12 9zm0-5c-3.6 0-6.5 2.8-6.5 6.2 0 .8.3 1.8.9 3.1.5 1.1 1.2 2.3 2 3.6.7 1 3 3.8 3.2 3.9l.4.5.4-.5c.2-.2 2.6-2.9 3.2-3.9.8-1.2 1.5-2.5 2-3.6.6-1.3.9-2.3.9-3.1C18.5 6.8 15.6 4 12 4zm4.3 8.7c-.5 1-1.1 2.2-1.9 3.4-.5.7-1.7 2.2-2.4 3-.7-.8-1.9-2.3-2.4-3-.8-1.2-1.4-2.3-1.9-3.3-.6-1.4-.7-2.2-.7-2.5 0-2.6 2.2-4.7 5-4.7s5 2.1 5 4.7c0 .2-.1 1-.7 2.4z"
}));
/* harmony default export */ __webpack_exports__["default"] = (mapMarker);
//# sourceMappingURL=map-marker.js.map

/***/ }),

/***/ "./node_modules/@wordpress/icons/build-module/library/post-date.js":
/*!*************************************************************************!*\
  !*** ./node_modules/@wordpress/icons/build-module/library/post-date.js ***!
  \*************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/primitives */ "@wordpress/primitives");
/* harmony import */ var _wordpress_primitives__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__);


/**
 * WordPress dependencies
 */

const postDate = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__.SVG, {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 24 24"
}, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__.Path, {
  d: "M11.696 13.972c.356-.546.599-.958.728-1.235a1.79 1.79 0 00.203-.783c0-.264-.077-.47-.23-.618-.148-.153-.354-.23-.618-.23-.295 0-.569.07-.82.212a3.413 3.413 0 00-.738.571l-.147-1.188c.289-.234.59-.41.903-.526.313-.117.66-.175 1.041-.175.375 0 .695.08.959.24.264.153.46.362.59.626.135.265.203.556.203.876 0 .362-.08.734-.24 1.115-.154.381-.427.87-.82 1.466l-.756 1.152H14v1.106h-4l1.696-2.609z"
}), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__.Path, {
  d: "M19.5 7h-15v12a.5.5 0 00.5.5h14a.5.5 0 00.5-.5V7zM3 7V5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"
}));
/* harmony default export */ __webpack_exports__["default"] = (postDate);
//# sourceMappingURL=post-date.js.map

/***/ }),

/***/ "./src/eventDate/edit.js":
/*!*******************************!*\
  !*** ./src/eventDate/edit.js ***!
  \*******************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/core-data */ "@wordpress/core-data");
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_date__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/date */ "@wordpress/date");
/* harmony import */ var _wordpress_date__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_date__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__);


/**
 * WordPress dependencies
 */








const Edit = _ref => {
  let {
    attributes: {
      format
    },
    context: {
      postId,
      postType,
      queryId
    },
    setAttributes
  } = _ref;
  const isDescendentOfQueryLoop = !!queryId;
  const [siteFormat] = (0,_wordpress_core_data__WEBPACK_IMPORTED_MODULE_1__.useEntityProp)('root', 'site', 'date_format');
  const [meta] = (0,_wordpress_core_data__WEBPACK_IMPORTED_MODULE_1__.useEntityProp)('postType', postType, 'meta', postId, true);
  const date = meta['_start_date']; // const [ isPickerOpen, setIsPickerOpen ] = useState( false );

  const settings = (0,_wordpress_date__WEBPACK_IMPORTED_MODULE_3__.__experimentalGetSettings)(); // To know if the current time format is a 12 hour time, look for "a".
  // Also make sure this "a" is not escaped by a "/".


  const is12Hour = /a(?!\\)/i.test(settings.formats.time.toLowerCase() // Test only for the lower case "a".
  .replace(/\\\\/g, '') // Replace "//" with empty strings.
  .split('').reverse().join('') // Reverse the string and test for "a" not followed by a slash.
  );
  const formatOptions = Object.values(settings.formats).map(formatOption => ({
    key: formatOption,
    name: (0,_wordpress_date__WEBPACK_IMPORTED_MODULE_3__.dateI18n)(formatOption, date)
  }));
  const resolvedFormat = format || siteFormat || settings.formats.date;
  let eventDate = date ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("time", {
    dateTime: (0,_wordpress_date__WEBPACK_IMPORTED_MODULE_3__.dateI18n)('c', date)
  }, (0,_wordpress_date__WEBPACK_IMPORTED_MODULE_3__.dateI18n)(resolvedFormat, date)) : (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__.__)('No Event Date', 'wp-action-network-events');
  const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_4__.useBlockProps)();
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_4__.InspectorControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelBody, {
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__.__)('Date Format Settings', 'wp-action-network-events')
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.CustomSelectControl, {
    hideLabelFromVision: true,
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__.__)('Date Format', 'wp-action-network-events'),
    options: formatOptions,
    onChange: _ref2 => {
      let {
        selectedItem
      } = _ref2;
      return setAttributes({
        format: selectedItem.key
      });
    },
    value: formatOptions.find(option => option.key === resolvedFormat)
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", blockProps, eventDate));
};

/* harmony default export */ __webpack_exports__["default"] = (Edit);

/***/ }),

/***/ "./src/eventDate/index.js":
/*!********************************!*\
  !*** ./src/eventDate/index.js ***!
  \********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "name": function() { return /* binding */ name; },
/* harmony export */   "category": function() { return /* binding */ category; },
/* harmony export */   "settings": function() { return /* binding */ settings; }
/* harmony export */ });
/* harmony import */ var _wordpress_icons__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/icons */ "./node_modules/@wordpress/icons/build-module/library/post-date.js");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./block.json */ "./src/eventDate/block.json");
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./edit */ "./src/eventDate/edit.js");
/**
 * WordPress dependencies
 */


/**
 * Internal dependencies
 */


 // registerBlockType( metadata.name, {
//     edit: Edit,
//     icon
// } );

const {
  name,
  category
} = _block_json__WEBPACK_IMPORTED_MODULE_1__;
const settings = {
  icon: _wordpress_icons__WEBPACK_IMPORTED_MODULE_3__["default"],
  edit: _edit__WEBPACK_IMPORTED_MODULE_2__["default"]
};


/***/ }),

/***/ "./src/eventLocation/edit.js":
/*!***********************************!*\
  !*** ./src/eventLocation/edit.js ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/core-data */ "@wordpress/core-data");
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__);


/**
 * WordPress dependencies
 */




const Edit = _ref => {
  let {
    context: {
      postId,
      postType,
      queryId
    },
    attributes
  } = _ref;
  const [meta] = (0,_wordpress_core_data__WEBPACK_IMPORTED_MODULE_1__.useEntityProp)('postType', postType, 'meta', postId, true);
  const location = meta['_location_venue'];
  let eventLocation = location ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "event-location"
  }, location) : (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "event-location no-location"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Virtual', 'wp-action-network-events'));
  const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.useBlockProps)();
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", blockProps, eventLocation));
};

/* harmony default export */ __webpack_exports__["default"] = (Edit);

/***/ }),

/***/ "./src/eventLocation/index.js":
/*!************************************!*\
  !*** ./src/eventLocation/index.js ***!
  \************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "name": function() { return /* binding */ name; },
/* harmony export */   "category": function() { return /* binding */ category; },
/* harmony export */   "settings": function() { return /* binding */ settings; }
/* harmony export */ });
/* harmony import */ var _wordpress_icons__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/icons */ "./node_modules/@wordpress/icons/build-module/library/map-marker.js");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./block.json */ "./src/eventLocation/block.json");
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./edit */ "./src/eventLocation/edit.js");
/**
 * WordPress dependencies
 */


/**
 * Internal dependencies
 */


 // registerBlockType( metadata.name, {
//     edit: Edit,
//     icon
// } );

const {
  name,
  category
} = _block_json__WEBPACK_IMPORTED_MODULE_1__;
const settings = {
  icon: _wordpress_icons__WEBPACK_IMPORTED_MODULE_3__["default"],
  edit: _edit__WEBPACK_IMPORTED_MODULE_2__["default"]
};


/***/ }),

/***/ "./src/eventQuery/edit.js":
/*!********************************!*\
  !*** ./src/eventQuery/edit.js ***!
  \********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/esm/extends.js");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var lodash_startcase__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! lodash.startcase */ "./node_modules/lodash.startcase/index.js");
/* harmony import */ var lodash_startcase__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(lodash_startcase__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @wordpress/compose */ "@wordpress/compose");
/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(_wordpress_compose__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @wordpress/core-data */ "@wordpress/core-data");
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _wordpress_date__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @wordpress/date */ "@wordpress/date");
/* harmony import */ var _wordpress_date__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(_wordpress_date__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(classnames__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var _editor_scss__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./editor.scss */ "./src/eventQuery/editor.scss");
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./style.scss */ "./src/eventQuery/style.scss");



/**
 * External dependencies
 */

/**
 * WordPress dependencies
 */









 //  Import CSS.



const MAX_ITEMS = 24;

const Edit = props => {
  const {
    attributes,
    className,
    setAttributes,
    isSelected
  } = props;
  const {
    queryId,
    taxonomy,
    postType,
    eventTags,
    perPage,
    orderby,
    query,
    dateFormat,
    timeFormat,
    wrapperTagName,
    tagName,
    display,
    scope
  } = attributes;
  const {
    showTags,
    showFeaturedImage,
    showTitle,
    showDate,
    showTime,
    showEndTime,
    showLocation,
    linkWrap
  } = display;
  const instanceId = (0,_wordpress_compose__WEBPACK_IMPORTED_MODULE_6__.useInstanceId)(Edit);
  const [siteDateFormat] = (0,_wordpress_core_data__WEBPACK_IMPORTED_MODULE_7__.useEntityProp)('root', 'site', 'date_format');
  const [siteTimeFormat] = (0,_wordpress_core_data__WEBPACK_IMPORTED_MODULE_7__.useEntityProp)('root', 'site', 'time_format');

  const settings = (0,_wordpress_date__WEBPACK_IMPORTED_MODULE_8__.__experimentalGetSettings)();

  const resolvedDateFormat = dateFormat || siteDateFormat || settings.formats.date;
  const resolvedTimeFormat = timeFormat || siteTimeFormat || settings.formats.time;

  const dateOptions = () => {
    const date = new Date();
    let formats = ['l F j, Y', 'l, F j, Y', 'D, M j, Y', 'F j, Y', 'M j, Y', 'm/j/Y', 'D, M j'];
    const options = formats.filter(format => format !== settings.formats.date).concat([settings.formats.date]).map(format => ({
      key: format,
      name: (0,_wordpress_date__WEBPACK_IMPORTED_MODULE_8__.dateI18n)(format, date)
    }));
    return options;
  };

  const timeOptions = () => {
    const date = new Date();
    let formats = ['g:i a', 'g:i A', 'g:ia', 'H:i'];
    const options = formats.filter(format => format !== settings.formats.time).concat([settings.formats.time]).map(format => ({
      key: format,
      name: (0,_wordpress_date__WEBPACK_IMPORTED_MODULE_8__.dateI18n)(format, date)
    }));
    return options;
  };

  const {
    __unstableMarkNextChangeAsNotPersistent
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_5__.useDispatch)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.store);
  const posts = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_5__.useSelect)(select => {
    return select('core').getEntityRecords('postType', postType, query);
  }, [query]);

  const setTerms = value => {
    setAttributes({
      eventTags: value
    });
  };

  const setPerPage = value => {
    setAttributes({
      perPage: value
    });
  };

  const setOrderBy = value => {
    setAttributes({
      orderby: value
    });
  };

  const setScope = value => {
    setAttributes({
      scope: value
    });
  };

  const TermSelector = () => {
    const terms = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_5__.useSelect)(select => {
      return select('core').getEntityRecords('taxonomy', taxonomy);
    }, []);

    if (!terms || !terms.length) {
      return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.Spinner, null);
    }

    const options = terms.map(_ref => {
      let {
        id,
        name
      } = _ref;
      return {
        value: id,
        label: name
      };
    });
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Tag', 'wp-action-network-events'),
      options: [{
        value: "",
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Select a Tag', 'wp-action-network-events')
      }, ...options],
      onChange: setTerms,
      value: eventTags
    }));
  };

  const PerPageSelector = () => {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.RangeControl, {
      key: "query-controls-range-control",
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Number of Posts', 'wp-action-network-events'),
      value: perPage,
      onChange: setPerPage,
      min: 1,
      max: MAX_ITEMS
    });
  };

  const OrderSelector = () => {
    const options = [{
      value: "start/desc",
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Soonest to Latest', 'wp-action-network-events')
    }, {
      value: "start/asc",
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Latest to Soonest', 'wp-action-network-events')
    }, {
      value: "title/asc",
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('A → Z', 'wp-action-network-events')
    }, {
      value: "title/desc",
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Z → A', 'wp-action-network-events')
    }];

    if (!options || !options.length) {
      return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.Spinner, null);
    }

    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Order By', 'wp-action-network-events'),
      options: options,
      onChange: setOrderBy,
      value: orderby
    }));
  };

  const ScopeSelector = () => {
    const scopes = ['future', 'past', 'all'];

    if (!scopes || !scopes.length) {
      return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.Spinner, null);
    }

    const options = scopes.map(scope => ({
      value: scope,
      label: lodash_startcase__WEBPACK_IMPORTED_MODULE_2___default()(scope)
    }));
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Scope', 'wp-action-network-events'),
      options: options,
      onChange: setScope,
      value: scope
    }));
  };

  const DateFormatSelector = () => {
    const options = dateOptions();
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.CustomSelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Date Format', 'wp-action-network-events'),
      options: options,
      onChange: _ref2 => {
        let {
          selectedItem
        } = _ref2;
        return setAttributes({
          dateFormat: selectedItem.key
        });
      },
      value: options.find(option => option.key === resolvedDateFormat)
    }));
  };

  const TimeFormatSelector = () => {
    const options = timeOptions();
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.CustomSelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Time Format', 'wp-action-network-events'),
      options: options,
      onChange: _ref3 => {
        let {
          selectedItem
        } = _ref3;
        return setAttributes({
          timeFormat: selectedItem.key
        });
      },
      value: options.find(option => option.key === resolvedTimeFormat)
    }));
  };

  const ShowSelectors = () => {
    const fields = Object.keys(display); // console.log( display, fields );

    if (!fields || !fields.length) {
      return null;
    }

    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, fields.map((field, index) => {
      const label = lodash_startcase__WEBPACK_IMPORTED_MODULE_2___default()(field.replace('show', ''));
      let checked = attributes.display[field];
      return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelRow, {
        key: index
      }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.ToggleControl, {
        label: label,
        help: checked ? (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Show', 'wp-action-network-events') : (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Hide', 'wp-action-network-events'),
        checked: checked,
        onChange: isChecked => {
          setAttributes({
            display: { ...display,
              [field]: isChecked
            }
          });
        }
      }));
    }));
  };

  const SettingsPanel = () => {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.InspectorControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelBody, {
      title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Query Options', 'wp-action-network-events'),
      initialOpen: true
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(TermSelector, null)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(OrderSelector, null)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(ScopeSelector, null)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(PerPageSelector, null))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelBody, {
      title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Display Options', 'wp-action-network-events'),
      initialOpen: true
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(DateFormatSelector, null)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(TimeFormatSelector, null))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelBody, {
      title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Content Options', 'wp-action-network-events'),
      initialOpen: true
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(ShowSelectors, null)));
  };

  const AdvancedControls = () => {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.InspectorControls, {
      __experimentalGroup: "advanced"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelBody, {
      title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('HTML Tag Options', 'wp-action-network-events'),
      initialOpen: true
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Wrapper HTML Element', 'wp-action-network-events'),
      options: [{
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Default (<div>)', 'wp-action-network-events'),
        value: 'div'
      }, {
        label: '<main>',
        value: 'main'
      }, {
        label: '<section>',
        value: 'section'
      }, {
        label: '<ul> (list)',
        value: 'ul'
      }],
      value: wrapperTagName,
      onChange: value => setAttributes({
        wrapperTagName: value
      })
    })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Item HTML Element', 'wp-action-network-events'),
      options: [{
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Default (<article>)', 'wp-action-network-events'),
        value: 'article'
      }, {
        label: '<div>',
        value: 'div'
      }, {
        label: '<li>',
        value: 'li'
      }],
      value: tagName,
      onChange: value => setAttributes({
        tagName: value
      })
    }))));
  };

  const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.useBlockProps)({
    className: classnames__WEBPACK_IMPORTED_MODULE_10___default()(className, 'events__list')
  });

  const Posts = () => {
    if (!posts) {
      return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.Spinner, null);
    }

    if (!posts.length) {
      return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(NoPosts, null);
    }

    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", blockProps, posts.map(post => {
      return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(Post, (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({}, post, {
        key: post.id
      }));
    }));
  };

  const Post = post => {
    var _tags$, _tags$2, _post$title, _post$title2, _post$meta, _post$meta2, _post$meta3, _post$meta4, _post$meta5, _post$meta6, _post$meta7, _post$meta8;

    const [featuredImage, setFeaturedImage] = (0,_wordpress_core_data__WEBPACK_IMPORTED_MODULE_7__.useEntityProp)('postType', postType, 'featured_media', post.id);
    const media = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_5__.useSelect)(select => {
      if (!showFeaturedImage || !featuredImage) {
        return false;
      }

      return select('core').getMedia(featuredImage, {
        context: 'view'
      });
    }, [featuredImage]);
    const tags = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_5__.useSelect)(select => {
      return select('core').getEntityRecords('taxonomy', taxonomy, {
        include: post["event-tags"],
        context: 'view'
      });
    }, []);

    const classes = () => {
      let postClassName = 'event';

      if (tags) {
        let tagClasses = tags.map(tag => {
          return `${taxonomy}-${tag.slug}`;
        });
        tagClasses = [postClassName, ...tagClasses];
        postClassName = tagClasses.join(' ');
      }

      return postClassName;
    };

    const postClasses = classes();
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("article", {
      className: postClasses
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("a", {
      link: post.link,
      rel: "bookmark"
    }, showTags && tags && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
      className: "event__tag"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("a", {
      href: (_tags$ = tags[0]) === null || _tags$ === void 0 ? void 0 : _tags$.link,
      rel: "tag",
      dangerouslySetInnerHTML: {
        __html: (_tags$2 = tags[0]) === null || _tags$2 === void 0 ? void 0 : _tags$2.name
      }
    })), showFeaturedImage && media && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("picture", {
      className: "event__media"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("img", {
      src: media.source_url,
      alt: media.alt_text || (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('Featured Image', 'wp-action-network-events')
    })), showTitle ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("h3", {
      className: "event__title",
      dangerouslySetInnerHTML: {
        __html: post === null || post === void 0 ? void 0 : (_post$title = post.title) === null || _post$title === void 0 ? void 0 : _post$title.rendered
      }
    }) : (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("h3", {
      className: "event__title sr-only screen-reader-text",
      dangerouslySetInnerHTML: {
        __html: post === null || post === void 0 ? void 0 : (_post$title2 = post.title) === null || _post$title2 === void 0 ? void 0 : _post$title2.rendered
      }
    }), showDate && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
      className: "event__date"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("time", {
      dateTime: (_post$meta = post.meta) === null || _post$meta === void 0 ? void 0 : _post$meta["start_date"]
    }, (0,_wordpress_date__WEBPACK_IMPORTED_MODULE_8__.dateI18n)(dateFormat, (_post$meta2 = post.meta) === null || _post$meta2 === void 0 ? void 0 : _post$meta2["start_date"]))), showTime && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
      className: "event__time"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("time", {
      dateTime: (_post$meta3 = post.meta) === null || _post$meta3 === void 0 ? void 0 : _post$meta3["start_date"]
    }, (0,_wordpress_date__WEBPACK_IMPORTED_MODULE_8__.dateI18n)(timeFormat, (_post$meta4 = post.meta) === null || _post$meta4 === void 0 ? void 0 : _post$meta4["start_date"])), ((_post$meta5 = post.meta) === null || _post$meta5 === void 0 ? void 0 : _post$meta5["end_date"]) && showEndTime && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", {
      className: "separator"
    }, " - "), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("time", {
      dateTime: (_post$meta6 = post.meta) === null || _post$meta6 === void 0 ? void 0 : _post$meta6["end_date"]
    }, (0,_wordpress_date__WEBPACK_IMPORTED_MODULE_8__.dateI18n)(timeFormat, (_post$meta7 = post.meta) === null || _post$meta7 === void 0 ? void 0 : _post$meta7["end_date"])))), showLocation && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
      className: "event__location",
      dangerouslySetInnerHTML: {
        __html: (_post$meta8 = post.meta) === null || _post$meta8 === void 0 ? void 0 : _post$meta8["location_venue"]
      }
    })));
  };

  const NoPosts = () => {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
      className: "no-posts"
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_9__.__)('No posts', 'wp-action-network-events'));
  };

  const updateQuery = () => {
    let _query = query;

    const _ordering = orderby.split('/');

    _query = { ..._query,
      per_page: parseInt(perPage),
      order: _ordering[1],
      orderby: _ordering[0],
      scope: scope,
      "event-tags": eventTags ? [parseInt(eventTags)] : []
    }; // console.log( _query );

    setAttributes({
      query: { ...query,
        ..._query
      }
    });
  };

  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    updateQuery();
  }, [eventTags, perPage, orderby, scope]);
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    if (!queryId) {
      __unstableMarkNextChangeAsNotPersistent();

      setAttributes({
        queryId: instanceId
      });
    }

    if (!dateFormat) {
      __unstableMarkNextChangeAsNotPersistent();

      setAttributes({
        dateFormat: resolvedDateFormat
      });
    }

    if (!timeFormat) {
      __unstableMarkNextChangeAsNotPersistent();

      setAttributes({
        timeFormat: resolvedTimeFormat
      });
    }
  }, [queryId, instanceId, dateFormat, siteTimeFormat]);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(SettingsPanel, null), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(AdvancedControls, null), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(Posts, null));
};

/* harmony default export */ __webpack_exports__["default"] = (Edit);

/***/ }),

/***/ "./src/eventQuery/icon.js":
/*!********************************!*\
  !*** ./src/eventQuery/icon.js ***!
  \********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/primitives */ "@wordpress/primitives");
/* harmony import */ var _wordpress_primitives__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__);


/**
 * WordPress dependencies
 */

const icon = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__.SVG, {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 24 24"
}, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__.Path, {
  d: "M19.313 4H4.688C3.756 4 3 4.756 3 5.688v12.375c0 .931.756 1.687 1.688 1.687h14.625c.931 0 1.687-.756 1.687-1.688V5.688C21 4.756 20.244 4 19.312 4zm-.211 14.063H4.898a.21.21 0 01-.21-.211V5.898a.21.21 0 01.21-.21h14.204a.21.21 0 01.21.21v11.954a.21.21 0 01-.21.21zm-1.477-3.235v.844a.422.422 0 01-.422.422h-7.031a.422.422 0 01-.422-.422v-.844c0-.233.189-.422.422-.422h7.031c.233 0 .422.19.422.422zm0-3.375v.844a.422.422 0 01-.422.422h-7.031a.422.422 0 01-.422-.422v-.844c0-.233.189-.422.422-.422h7.031c.233 0 .422.19.422.422zm0-3.375v.844a.422.422 0 01-.422.422h-7.031a.422.422 0 01-.422-.422v-.844c0-.233.189-.422.422-.422h7.031c.233 0 .422.19.422.422zm-8.86.422a1.266 1.266 0 11-2.53 0 1.266 1.266 0 012.53 0zm0 3.375a1.266 1.266 0 11-2.53 0 1.266 1.266 0 012.53 0zm0 3.375a1.266 1.266 0 11-2.53 0 1.266 1.266 0 012.53 0z"
}));
/* harmony default export */ __webpack_exports__["default"] = (icon);

/***/ }),

/***/ "./src/eventQuery/index.js":
/*!*********************************!*\
  !*** ./src/eventQuery/index.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "name": function() { return /* binding */ name; },
/* harmony export */   "category": function() { return /* binding */ category; },
/* harmony export */   "settings": function() { return /* binding */ settings; }
/* harmony export */ });
/* harmony import */ var _icon__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./icon */ "./src/eventQuery/icon.js");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./block.json */ "./src/eventQuery/block.json");
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./edit */ "./src/eventQuery/edit.js");
/**
 * WordPress dependencies
 */


/**
 * Internal dependencies
 */



const {
  name,
  category
} = _block_json__WEBPACK_IMPORTED_MODULE_2__;
const settings = {
  icon: _icon__WEBPACK_IMPORTED_MODULE_0__["default"],
  edit: _edit__WEBPACK_IMPORTED_MODULE_3__["default"]
};


/***/ }),

/***/ "./src/eventTime/edit.js":
/*!*******************************!*\
  !*** ./src/eventTime/edit.js ***!
  \*******************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/core-data */ "@wordpress/core-data");
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_date__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/date */ "@wordpress/date");
/* harmony import */ var _wordpress_date__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_date__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__);


/**
 * WordPress dependencies
 */








const Edit = _ref => {
  let {
    attributes: {
      format
    },
    context: {
      postId,
      postType,
      queryId
    },
    setAttributes
  } = _ref;
  const [siteFormat] = (0,_wordpress_core_data__WEBPACK_IMPORTED_MODULE_1__.useEntityProp)('root', 'site', 'date_format');
  const [meta] = (0,_wordpress_core_data__WEBPACK_IMPORTED_MODULE_1__.useEntityProp)('postType', postType, 'meta', postId, true);
  const date = meta['_start_date']; // const [ isPickerOpen, setIsPickerOpen ] = useState( false );

  const settings = (0,_wordpress_date__WEBPACK_IMPORTED_MODULE_3__.__experimentalGetSettings)(); // To know if the current time format is a 12 hour time, look for "a".
  // Also make sure this "a" is not escaped by a "/".


  const is12Hour = /a(?!\\)/i.test(settings.formats.time.toLowerCase() // Test only for the lower case "a".
  .replace(/\\\\/g, '') // Replace "//" with empty strings.
  .split('').reverse().join('') // Reverse the string and test for "a" not followed by a slash.
  );
  const formatOptions = Object.values(settings.formats).map(formatOption => ({
    key: formatOption,
    name: (0,_wordpress_date__WEBPACK_IMPORTED_MODULE_3__.dateI18n)(formatOption, date)
  }));
  const resolvedFormat = format || siteFormat || settings.formats.date;
  let eventTime = date ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("time", {
    dateTime: (0,_wordpress_date__WEBPACK_IMPORTED_MODULE_3__.dateI18n)('c', date)
  }, (0,_wordpress_date__WEBPACK_IMPORTED_MODULE_3__.dateI18n)(resolvedFormat, date)) : (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__.__)('No Event Time', 'wp-action-network-events');
  const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_4__.useBlockProps)();
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_4__.InspectorControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelBody, {
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__.__)('Time Format Settings', 'wp-action-network-events')
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.CustomSelectControl, {
    hideLabelFromVision: true,
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__.__)('Time Format', 'wp-action-network-events'),
    options: formatOptions,
    onChange: _ref2 => {
      let {
        selectedItem
      } = _ref2;
      return setAttributes({
        format: selectedItem.key
      });
    },
    value: formatOptions.find(option => option.key === resolvedFormat)
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", blockProps, eventTime));
};

/* harmony default export */ __webpack_exports__["default"] = (Edit);

/***/ }),

/***/ "./src/eventTime/icon.js":
/*!*******************************!*\
  !*** ./src/eventTime/icon.js ***!
  \*******************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/primitives */ "@wordpress/primitives");
/* harmony import */ var _wordpress_primitives__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__);


/**
 * WordPress dependencies
 */

const icon = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__.SVG, {
  viewBox: "0 0 24 24",
  xmlns: "http://www.w3.org/2000/svg"
}, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__.Path, {
  d: "M12 3c-4.972 0-9 4.028-9 9s4.028 9 9 9 9-4.028 9-9-4.028-9-9-9zm0 16.259A7.256 7.256 0 014.742 12 7.256 7.256 0 0112 4.742 7.256 7.256 0 0119.259 12 7.256 7.256 0 0112 19.259zm2.243-3.79l-3.08-2.239a.438.438 0 01-.18-.352V6.92c0-.24.197-.436.436-.436h1.161c.24 0 .436.196.436.436v5.142l2.425 1.764c.195.14.235.413.093.61l-.682.939a.438.438 0 01-.61.095z"
}));
/* harmony default export */ __webpack_exports__["default"] = (icon);

/***/ }),

/***/ "./src/eventTime/index.js":
/*!********************************!*\
  !*** ./src/eventTime/index.js ***!
  \********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "name": function() { return /* binding */ name; },
/* harmony export */   "category": function() { return /* binding */ category; },
/* harmony export */   "settings": function() { return /* binding */ settings; }
/* harmony export */ });
/* harmony import */ var _icon__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./icon */ "./src/eventTime/icon.js");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./style.scss */ "./src/eventTime/style.scss");
/* harmony import */ var _editor_scss__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./editor.scss */ "./src/eventTime/editor.scss");
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./block.json */ "./src/eventTime/block.json");
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./edit */ "./src/eventTime/edit.js");
/**
 * WordPress dependencies
 */
// import { postDate as icon } from '@wordpress/icons';


/**
 * Internal dependencies
 */




 // registerBlockType( metadata.name, {
//     edit: Edit,
//     icon
// } );

const {
  name,
  category
} = _block_json__WEBPACK_IMPORTED_MODULE_4__;
const settings = {
  icon: _icon__WEBPACK_IMPORTED_MODULE_0__["default"],
  edit: _edit__WEBPACK_IMPORTED_MODULE_5__["default"]
};


/***/ }),

/***/ "./src/eventsComponent/edit.js":
/*!*************************************!*\
  !*** ./src/eventsComponent/edit.js ***!
  \*************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(classnames__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _editor_scss__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./editor.scss */ "./src/eventsComponent/editor.scss");
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./style.scss */ "./src/eventsComponent/style.scss");



 //  Import CSS.



const TEMPLATE = [['core/heading', {
  placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Add Heading...', 'wp-action-network-events'),
  level: 2,
  className: 'events__title'
}, []], ['core/paragraph', {
  placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Add Content...', 'wp-action-network-events'),
  className: 'events__content'
}, []], ['wp-action-network-events/event-query', {
  className: 'events__list'
}, []]];
const ALLOWED_BLOCKS = ['core/heading', 'core/paragraph', 'wp-action-network-events/event-query'];

const Edit = props => {
  const {
    attributes,
    className,
    setAttributes
  } = props;
  const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.useBlockProps)({
    className: classnames__WEBPACK_IMPORTED_MODULE_3___default()(className, 'events')
  });
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", blockProps, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InnerBlocks, {
    allowedBlocks: ALLOWED_BLOCKS,
    template: TEMPLATE,
    templateLock: "all"
  }));
};

/* harmony default export */ __webpack_exports__["default"] = (Edit);

/***/ }),

/***/ "./src/eventsComponent/index.js":
/*!**************************************!*\
  !*** ./src/eventsComponent/index.js ***!
  \**************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "name": function() { return /* binding */ name; },
/* harmony export */   "category": function() { return /* binding */ category; },
/* harmony export */   "settings": function() { return /* binding */ settings; }
/* harmony export */ });
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./block.json */ "./src/eventsComponent/block.json");
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./edit */ "./src/eventsComponent/edit.js");
/* harmony import */ var _save__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./save */ "./src/eventsComponent/save.js");
/**
 * WordPress dependencies
 */

/**
 * Internal dependencies
 */




const {
  name,
  category
} = _block_json__WEBPACK_IMPORTED_MODULE_1__;
const variations = [{
  name: 'events-by-tag',
  title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('Events by Tag', 'wp-action-network-events'),
  icon: 'calendar-alt',
  isDefault: true,
  category: 'events',
  description: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('Display events with section header and description..', 'wp-action-network-events'),
  keywords: [(0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('event', 'wp-action-network-events'), (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('grid', 'wp-action-network-events'), (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('component', 'wp-action-network-events')],
  attributes: {
    className: 'events-by-tag'
  },
  innerBlocks: [['core/heading', {
    className: 'taxonomy-label',
    level: 2,
    placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('Add Title...', 'wp-action-network-events')
  }], ['core/paragraph', {
    className: 'taxonomy-description',
    placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('Add Description...', 'wp-action-network-events')
  }], ['wp-action-network-events/event-query', {
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
  }]],
  scope: ['block', 'inserter', 'transform']
}, {
  name: 'events-by-tag-welcome-calls',
  title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('Welcome Calls', 'wp-action-network-events'),
  description: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('Display welcome call events with section header and description..', 'wp-action-network-events'),
  icon: 'calendar-alt',
  keywords: [(0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('event', 'wp-action-network-events'), (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('grid', 'wp-action-network-events'), (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('component', 'wp-action-network-events')],
  attributes: {
    className: 'events-by-tag welcome-calls'
  },
  innerBlocks: [['core/heading', {
    className: 'taxonomy-label',
    level: 2,
    placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('Add Title...', 'wp-action-network-events'),
    content: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('Welcome Calls', 'wp-action-network-events')
  }], ['core/paragraph', {
    className: 'taxonomy-description',
    placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('Add Description...', 'wp-action-network-events'),
    content: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('Are you new to the Debt Collective or the Biden Jubilee 100 campaign and want to learn more about our union and what we\'re fighting for? Join us for our welcome calls!', 'wp-action-network-events')
  }], ['wp-action-network-events/event-query', {
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
  }]],
  scope: ['transform', 'inserter']
}];
const settings = {
  edit: _edit__WEBPACK_IMPORTED_MODULE_2__["default"],
  save: _save__WEBPACK_IMPORTED_MODULE_3__["default"],
  variations
};


/***/ }),

/***/ "./src/eventsComponent/save.js":
/*!*************************************!*\
  !*** ./src/eventsComponent/save.js ***!
  \*************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__);



const Save = () => {
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InnerBlocks.Content, null); // return null;
};

/* harmony default export */ __webpack_exports__["default"] = (Save);

/***/ }),

/***/ "./src/eventsTout/edit.js":
/*!********************************!*\
  !*** ./src/eventsTout/edit.js ***!
  \********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(classnames__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _editor_scss__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./editor.scss */ "./src/eventsTout/editor.scss");
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./style.scss */ "./src/eventsTout/style.scss");



 //  Import CSS.



const TEMPLATE = [['core/heading', {
  placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Add Heading...', 'wp-action-network-events'),
  level: 3,
  className: 'events-tout__title'
}, []], ['wp-action-network-events/event-query', {
  className: 'events-tout__list'
}, []], ['core/button', {
  className: 'events-tout__button btn jade',
  content: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('See More Events', 'wp-action-network-events')
}, []]];
const ALLOWED_BLOCKS = ['core/heading', 'wp-action-network-events/event-query', 'core/button'];

const Edit = props => {
  const {
    attributes,
    className,
    setAttributes
  } = props;
  const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.useBlockProps)({
    className: classnames__WEBPACK_IMPORTED_MODULE_3___default()(className, 'events-tout')
  });
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", blockProps, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InnerBlocks, {
    allowedBlocks: ALLOWED_BLOCKS,
    template: TEMPLATE,
    templateLock: "all"
  }));
};

/* harmony default export */ __webpack_exports__["default"] = (Edit);

/***/ }),

/***/ "./src/eventsTout/index.js":
/*!*********************************!*\
  !*** ./src/eventsTout/index.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "name": function() { return /* binding */ name; },
/* harmony export */   "category": function() { return /* binding */ category; },
/* harmony export */   "settings": function() { return /* binding */ settings; }
/* harmony export */ });
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./block.json */ "./src/eventsTout/block.json");
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./edit */ "./src/eventsTout/edit.js");
/* harmony import */ var _save__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./save */ "./src/eventsTout/save.js");
/**
 * WordPress dependencies
 */

/**
 * Internal dependencies
 */




const {
  name,
  category
} = _block_json__WEBPACK_IMPORTED_MODULE_1__;
const settings = {
  edit: _edit__WEBPACK_IMPORTED_MODULE_2__["default"],
  save: _save__WEBPACK_IMPORTED_MODULE_3__["default"]
};


/***/ }),

/***/ "./src/eventsTout/save.js":
/*!********************************!*\
  !*** ./src/eventsTout/save.js ***!
  \********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__);



const Save = () => {
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InnerBlocks.Content, null); // return null;
};

/* harmony default export */ __webpack_exports__["default"] = (Save);

/***/ }),

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "registerBlocks": function() { return /* binding */ registerBlocks; }
/* harmony export */ });
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _variations__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./variations */ "./src/variations/index.js");
/* harmony import */ var _variations__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_variations__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _eventDate__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./eventDate */ "./src/eventDate/index.js");
/* harmony import */ var _eventsComponent__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./eventsComponent */ "./src/eventsComponent/index.js");
/* harmony import */ var _eventsTout__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./eventsTout */ "./src/eventsTout/index.js");
/* harmony import */ var _eventLocation__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./eventLocation */ "./src/eventLocation/index.js");
/* harmony import */ var _eventTime__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./eventTime */ "./src/eventTime/index.js");
/* harmony import */ var _eventQuery__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./eventQuery */ "./src/eventQuery/index.js");


/**
 * Register Custom Block Collection
 */

(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__.registerBlockCollection)('wp-action-network-events', {
  title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Action Network Events', 'wp-action-network-events'),
  icon: 'calendar-alt'
});
/**
 * Register Variations
 */








const blocks = [_eventDate__WEBPACK_IMPORTED_MODULE_3__, _eventsComponent__WEBPACK_IMPORTED_MODULE_4__, _eventsTout__WEBPACK_IMPORTED_MODULE_5__, _eventLocation__WEBPACK_IMPORTED_MODULE_6__, _eventTime__WEBPACK_IMPORTED_MODULE_7__, _eventQuery__WEBPACK_IMPORTED_MODULE_8__];
/**
 * Function to register an individual block.
 *
 * @param {Object} block The block to be registered.
 *
 */

const registerBlock = block => {
  if (!block) {
    return;
  }

  const {
    name,
    settings
  } = block;
  (0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__.registerBlockType)(name, { ...settings
  });
};
/**
 * Function to register blocks
 */


const registerBlocks = () => {
  blocks.forEach(registerBlock);
};
registerBlocks();

/***/ }),

/***/ "./src/variations/index.js":
/*!*********************************!*\
  !*** ./src/variations/index.js ***!
  \*********************************/
/***/ (function() {

// import './eventsByTag';

/***/ }),

/***/ "./node_modules/classnames/index.js":
/*!******************************************!*\
  !*** ./node_modules/classnames/index.js ***!
  \******************************************/
/***/ (function(module, exports) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
  Copyright (c) 2018 Jed Watson.
  Licensed under the MIT License (MIT), see
  http://jedwatson.github.io/classnames
*/
/* global define */

(function () {
	'use strict';

	var hasOwn = {}.hasOwnProperty;

	function classNames() {
		var classes = [];

		for (var i = 0; i < arguments.length; i++) {
			var arg = arguments[i];
			if (!arg) continue;

			var argType = typeof arg;

			if (argType === 'string' || argType === 'number') {
				classes.push(arg);
			} else if (Array.isArray(arg)) {
				if (arg.length) {
					var inner = classNames.apply(null, arg);
					if (inner) {
						classes.push(inner);
					}
				}
			} else if (argType === 'object') {
				if (arg.toString === Object.prototype.toString) {
					for (var key in arg) {
						if (hasOwn.call(arg, key) && arg[key]) {
							classes.push(key);
						}
					}
				} else {
					classes.push(arg.toString());
				}
			}
		}

		return classes.join(' ');
	}

	if ( true && module.exports) {
		classNames.default = classNames;
		module.exports = classNames;
	} else if (true) {
		// register as 'classnames', consistent with npm package name
		!(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = (function () {
			return classNames;
		}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	} else {}
}());


/***/ }),

/***/ "./node_modules/lodash.startcase/index.js":
/*!************************************************!*\
  !*** ./node_modules/lodash.startcase/index.js ***!
  \************************************************/
/***/ (function(module, __unused_webpack_exports, __webpack_require__) {

/**
 * lodash (Custom Build) <https://lodash.com/>
 * Build: `lodash modularize exports="npm" -o ./`
 * Copyright jQuery Foundation and other contributors <https://jquery.org/>
 * Released under MIT license <https://lodash.com/license>
 * Based on Underscore.js 1.8.3 <http://underscorejs.org/LICENSE>
 * Copyright Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
 */

/** Used as references for various `Number` constants. */
var INFINITY = 1 / 0;

/** `Object#toString` result references. */
var symbolTag = '[object Symbol]';

/** Used to match words composed of alphanumeric characters. */
var reAsciiWord = /[^\x00-\x2f\x3a-\x40\x5b-\x60\x7b-\x7f]+/g;

/** Used to match Latin Unicode letters (excluding mathematical operators). */
var reLatin = /[\xc0-\xd6\xd8-\xf6\xf8-\xff\u0100-\u017f]/g;

/** Used to compose unicode character classes. */
var rsAstralRange = '\\ud800-\\udfff',
    rsComboMarksRange = '\\u0300-\\u036f\\ufe20-\\ufe23',
    rsComboSymbolsRange = '\\u20d0-\\u20f0',
    rsDingbatRange = '\\u2700-\\u27bf',
    rsLowerRange = 'a-z\\xdf-\\xf6\\xf8-\\xff',
    rsMathOpRange = '\\xac\\xb1\\xd7\\xf7',
    rsNonCharRange = '\\x00-\\x2f\\x3a-\\x40\\x5b-\\x60\\x7b-\\xbf',
    rsPunctuationRange = '\\u2000-\\u206f',
    rsSpaceRange = ' \\t\\x0b\\f\\xa0\\ufeff\\n\\r\\u2028\\u2029\\u1680\\u180e\\u2000\\u2001\\u2002\\u2003\\u2004\\u2005\\u2006\\u2007\\u2008\\u2009\\u200a\\u202f\\u205f\\u3000',
    rsUpperRange = 'A-Z\\xc0-\\xd6\\xd8-\\xde',
    rsVarRange = '\\ufe0e\\ufe0f',
    rsBreakRange = rsMathOpRange + rsNonCharRange + rsPunctuationRange + rsSpaceRange;

/** Used to compose unicode capture groups. */
var rsApos = "['\u2019]",
    rsAstral = '[' + rsAstralRange + ']',
    rsBreak = '[' + rsBreakRange + ']',
    rsCombo = '[' + rsComboMarksRange + rsComboSymbolsRange + ']',
    rsDigits = '\\d+',
    rsDingbat = '[' + rsDingbatRange + ']',
    rsLower = '[' + rsLowerRange + ']',
    rsMisc = '[^' + rsAstralRange + rsBreakRange + rsDigits + rsDingbatRange + rsLowerRange + rsUpperRange + ']',
    rsFitz = '\\ud83c[\\udffb-\\udfff]',
    rsModifier = '(?:' + rsCombo + '|' + rsFitz + ')',
    rsNonAstral = '[^' + rsAstralRange + ']',
    rsRegional = '(?:\\ud83c[\\udde6-\\uddff]){2}',
    rsSurrPair = '[\\ud800-\\udbff][\\udc00-\\udfff]',
    rsUpper = '[' + rsUpperRange + ']',
    rsZWJ = '\\u200d';

/** Used to compose unicode regexes. */
var rsLowerMisc = '(?:' + rsLower + '|' + rsMisc + ')',
    rsUpperMisc = '(?:' + rsUpper + '|' + rsMisc + ')',
    rsOptLowerContr = '(?:' + rsApos + '(?:d|ll|m|re|s|t|ve))?',
    rsOptUpperContr = '(?:' + rsApos + '(?:D|LL|M|RE|S|T|VE))?',
    reOptMod = rsModifier + '?',
    rsOptVar = '[' + rsVarRange + ']?',
    rsOptJoin = '(?:' + rsZWJ + '(?:' + [rsNonAstral, rsRegional, rsSurrPair].join('|') + ')' + rsOptVar + reOptMod + ')*',
    rsSeq = rsOptVar + reOptMod + rsOptJoin,
    rsEmoji = '(?:' + [rsDingbat, rsRegional, rsSurrPair].join('|') + ')' + rsSeq,
    rsSymbol = '(?:' + [rsNonAstral + rsCombo + '?', rsCombo, rsRegional, rsSurrPair, rsAstral].join('|') + ')';

/** Used to match apostrophes. */
var reApos = RegExp(rsApos, 'g');

/**
 * Used to match [combining diacritical marks](https://en.wikipedia.org/wiki/Combining_Diacritical_Marks) and
 * [combining diacritical marks for symbols](https://en.wikipedia.org/wiki/Combining_Diacritical_Marks_for_Symbols).
 */
var reComboMark = RegExp(rsCombo, 'g');

/** Used to match [string symbols](https://mathiasbynens.be/notes/javascript-unicode). */
var reUnicode = RegExp(rsFitz + '(?=' + rsFitz + ')|' + rsSymbol + rsSeq, 'g');

/** Used to match complex or compound words. */
var reUnicodeWord = RegExp([
  rsUpper + '?' + rsLower + '+' + rsOptLowerContr + '(?=' + [rsBreak, rsUpper, '$'].join('|') + ')',
  rsUpperMisc + '+' + rsOptUpperContr + '(?=' + [rsBreak, rsUpper + rsLowerMisc, '$'].join('|') + ')',
  rsUpper + '?' + rsLowerMisc + '+' + rsOptLowerContr,
  rsUpper + '+' + rsOptUpperContr,
  rsDigits,
  rsEmoji
].join('|'), 'g');

/** Used to detect strings with [zero-width joiners or code points from the astral planes](http://eev.ee/blog/2015/09/12/dark-corners-of-unicode/). */
var reHasUnicode = RegExp('[' + rsZWJ + rsAstralRange  + rsComboMarksRange + rsComboSymbolsRange + rsVarRange + ']');

/** Used to detect strings that need a more robust regexp to match words. */
var reHasUnicodeWord = /[a-z][A-Z]|[A-Z]{2,}[a-z]|[0-9][a-zA-Z]|[a-zA-Z][0-9]|[^a-zA-Z0-9 ]/;

/** Used to map Latin Unicode letters to basic Latin letters. */
var deburredLetters = {
  // Latin-1 Supplement block.
  '\xc0': 'A',  '\xc1': 'A', '\xc2': 'A', '\xc3': 'A', '\xc4': 'A', '\xc5': 'A',
  '\xe0': 'a',  '\xe1': 'a', '\xe2': 'a', '\xe3': 'a', '\xe4': 'a', '\xe5': 'a',
  '\xc7': 'C',  '\xe7': 'c',
  '\xd0': 'D',  '\xf0': 'd',
  '\xc8': 'E',  '\xc9': 'E', '\xca': 'E', '\xcb': 'E',
  '\xe8': 'e',  '\xe9': 'e', '\xea': 'e', '\xeb': 'e',
  '\xcc': 'I',  '\xcd': 'I', '\xce': 'I', '\xcf': 'I',
  '\xec': 'i',  '\xed': 'i', '\xee': 'i', '\xef': 'i',
  '\xd1': 'N',  '\xf1': 'n',
  '\xd2': 'O',  '\xd3': 'O', '\xd4': 'O', '\xd5': 'O', '\xd6': 'O', '\xd8': 'O',
  '\xf2': 'o',  '\xf3': 'o', '\xf4': 'o', '\xf5': 'o', '\xf6': 'o', '\xf8': 'o',
  '\xd9': 'U',  '\xda': 'U', '\xdb': 'U', '\xdc': 'U',
  '\xf9': 'u',  '\xfa': 'u', '\xfb': 'u', '\xfc': 'u',
  '\xdd': 'Y',  '\xfd': 'y', '\xff': 'y',
  '\xc6': 'Ae', '\xe6': 'ae',
  '\xde': 'Th', '\xfe': 'th',
  '\xdf': 'ss',
  // Latin Extended-A block.
  '\u0100': 'A',  '\u0102': 'A', '\u0104': 'A',
  '\u0101': 'a',  '\u0103': 'a', '\u0105': 'a',
  '\u0106': 'C',  '\u0108': 'C', '\u010a': 'C', '\u010c': 'C',
  '\u0107': 'c',  '\u0109': 'c', '\u010b': 'c', '\u010d': 'c',
  '\u010e': 'D',  '\u0110': 'D', '\u010f': 'd', '\u0111': 'd',
  '\u0112': 'E',  '\u0114': 'E', '\u0116': 'E', '\u0118': 'E', '\u011a': 'E',
  '\u0113': 'e',  '\u0115': 'e', '\u0117': 'e', '\u0119': 'e', '\u011b': 'e',
  '\u011c': 'G',  '\u011e': 'G', '\u0120': 'G', '\u0122': 'G',
  '\u011d': 'g',  '\u011f': 'g', '\u0121': 'g', '\u0123': 'g',
  '\u0124': 'H',  '\u0126': 'H', '\u0125': 'h', '\u0127': 'h',
  '\u0128': 'I',  '\u012a': 'I', '\u012c': 'I', '\u012e': 'I', '\u0130': 'I',
  '\u0129': 'i',  '\u012b': 'i', '\u012d': 'i', '\u012f': 'i', '\u0131': 'i',
  '\u0134': 'J',  '\u0135': 'j',
  '\u0136': 'K',  '\u0137': 'k', '\u0138': 'k',
  '\u0139': 'L',  '\u013b': 'L', '\u013d': 'L', '\u013f': 'L', '\u0141': 'L',
  '\u013a': 'l',  '\u013c': 'l', '\u013e': 'l', '\u0140': 'l', '\u0142': 'l',
  '\u0143': 'N',  '\u0145': 'N', '\u0147': 'N', '\u014a': 'N',
  '\u0144': 'n',  '\u0146': 'n', '\u0148': 'n', '\u014b': 'n',
  '\u014c': 'O',  '\u014e': 'O', '\u0150': 'O',
  '\u014d': 'o',  '\u014f': 'o', '\u0151': 'o',
  '\u0154': 'R',  '\u0156': 'R', '\u0158': 'R',
  '\u0155': 'r',  '\u0157': 'r', '\u0159': 'r',
  '\u015a': 'S',  '\u015c': 'S', '\u015e': 'S', '\u0160': 'S',
  '\u015b': 's',  '\u015d': 's', '\u015f': 's', '\u0161': 's',
  '\u0162': 'T',  '\u0164': 'T', '\u0166': 'T',
  '\u0163': 't',  '\u0165': 't', '\u0167': 't',
  '\u0168': 'U',  '\u016a': 'U', '\u016c': 'U', '\u016e': 'U', '\u0170': 'U', '\u0172': 'U',
  '\u0169': 'u',  '\u016b': 'u', '\u016d': 'u', '\u016f': 'u', '\u0171': 'u', '\u0173': 'u',
  '\u0174': 'W',  '\u0175': 'w',
  '\u0176': 'Y',  '\u0177': 'y', '\u0178': 'Y',
  '\u0179': 'Z',  '\u017b': 'Z', '\u017d': 'Z',
  '\u017a': 'z',  '\u017c': 'z', '\u017e': 'z',
  '\u0132': 'IJ', '\u0133': 'ij',
  '\u0152': 'Oe', '\u0153': 'oe',
  '\u0149': "'n", '\u017f': 'ss'
};

/** Detect free variable `global` from Node.js. */
var freeGlobal = typeof __webpack_require__.g == 'object' && __webpack_require__.g && __webpack_require__.g.Object === Object && __webpack_require__.g;

/** Detect free variable `self`. */
var freeSelf = typeof self == 'object' && self && self.Object === Object && self;

/** Used as a reference to the global object. */
var root = freeGlobal || freeSelf || Function('return this')();

/**
 * A specialized version of `_.reduce` for arrays without support for
 * iteratee shorthands.
 *
 * @private
 * @param {Array} [array] The array to iterate over.
 * @param {Function} iteratee The function invoked per iteration.
 * @param {*} [accumulator] The initial value.
 * @param {boolean} [initAccum] Specify using the first element of `array` as
 *  the initial value.
 * @returns {*} Returns the accumulated value.
 */
function arrayReduce(array, iteratee, accumulator, initAccum) {
  var index = -1,
      length = array ? array.length : 0;

  if (initAccum && length) {
    accumulator = array[++index];
  }
  while (++index < length) {
    accumulator = iteratee(accumulator, array[index], index, array);
  }
  return accumulator;
}

/**
 * Converts an ASCII `string` to an array.
 *
 * @private
 * @param {string} string The string to convert.
 * @returns {Array} Returns the converted array.
 */
function asciiToArray(string) {
  return string.split('');
}

/**
 * Splits an ASCII `string` into an array of its words.
 *
 * @private
 * @param {string} The string to inspect.
 * @returns {Array} Returns the words of `string`.
 */
function asciiWords(string) {
  return string.match(reAsciiWord) || [];
}

/**
 * The base implementation of `_.propertyOf` without support for deep paths.
 *
 * @private
 * @param {Object} object The object to query.
 * @returns {Function} Returns the new accessor function.
 */
function basePropertyOf(object) {
  return function(key) {
    return object == null ? undefined : object[key];
  };
}

/**
 * Used by `_.deburr` to convert Latin-1 Supplement and Latin Extended-A
 * letters to basic Latin letters.
 *
 * @private
 * @param {string} letter The matched letter to deburr.
 * @returns {string} Returns the deburred letter.
 */
var deburrLetter = basePropertyOf(deburredLetters);

/**
 * Checks if `string` contains Unicode symbols.
 *
 * @private
 * @param {string} string The string to inspect.
 * @returns {boolean} Returns `true` if a symbol is found, else `false`.
 */
function hasUnicode(string) {
  return reHasUnicode.test(string);
}

/**
 * Checks if `string` contains a word composed of Unicode symbols.
 *
 * @private
 * @param {string} string The string to inspect.
 * @returns {boolean} Returns `true` if a word is found, else `false`.
 */
function hasUnicodeWord(string) {
  return reHasUnicodeWord.test(string);
}

/**
 * Converts `string` to an array.
 *
 * @private
 * @param {string} string The string to convert.
 * @returns {Array} Returns the converted array.
 */
function stringToArray(string) {
  return hasUnicode(string)
    ? unicodeToArray(string)
    : asciiToArray(string);
}

/**
 * Converts a Unicode `string` to an array.
 *
 * @private
 * @param {string} string The string to convert.
 * @returns {Array} Returns the converted array.
 */
function unicodeToArray(string) {
  return string.match(reUnicode) || [];
}

/**
 * Splits a Unicode `string` into an array of its words.
 *
 * @private
 * @param {string} The string to inspect.
 * @returns {Array} Returns the words of `string`.
 */
function unicodeWords(string) {
  return string.match(reUnicodeWord) || [];
}

/** Used for built-in method references. */
var objectProto = Object.prototype;

/**
 * Used to resolve the
 * [`toStringTag`](http://ecma-international.org/ecma-262/7.0/#sec-object.prototype.tostring)
 * of values.
 */
var objectToString = objectProto.toString;

/** Built-in value references. */
var Symbol = root.Symbol;

/** Used to convert symbols to primitives and strings. */
var symbolProto = Symbol ? Symbol.prototype : undefined,
    symbolToString = symbolProto ? symbolProto.toString : undefined;

/**
 * The base implementation of `_.slice` without an iteratee call guard.
 *
 * @private
 * @param {Array} array The array to slice.
 * @param {number} [start=0] The start position.
 * @param {number} [end=array.length] The end position.
 * @returns {Array} Returns the slice of `array`.
 */
function baseSlice(array, start, end) {
  var index = -1,
      length = array.length;

  if (start < 0) {
    start = -start > length ? 0 : (length + start);
  }
  end = end > length ? length : end;
  if (end < 0) {
    end += length;
  }
  length = start > end ? 0 : ((end - start) >>> 0);
  start >>>= 0;

  var result = Array(length);
  while (++index < length) {
    result[index] = array[index + start];
  }
  return result;
}

/**
 * The base implementation of `_.toString` which doesn't convert nullish
 * values to empty strings.
 *
 * @private
 * @param {*} value The value to process.
 * @returns {string} Returns the string.
 */
function baseToString(value) {
  // Exit early for strings to avoid a performance hit in some environments.
  if (typeof value == 'string') {
    return value;
  }
  if (isSymbol(value)) {
    return symbolToString ? symbolToString.call(value) : '';
  }
  var result = (value + '');
  return (result == '0' && (1 / value) == -INFINITY) ? '-0' : result;
}

/**
 * Casts `array` to a slice if it's needed.
 *
 * @private
 * @param {Array} array The array to inspect.
 * @param {number} start The start position.
 * @param {number} [end=array.length] The end position.
 * @returns {Array} Returns the cast slice.
 */
function castSlice(array, start, end) {
  var length = array.length;
  end = end === undefined ? length : end;
  return (!start && end >= length) ? array : baseSlice(array, start, end);
}

/**
 * Creates a function like `_.lowerFirst`.
 *
 * @private
 * @param {string} methodName The name of the `String` case method to use.
 * @returns {Function} Returns the new case function.
 */
function createCaseFirst(methodName) {
  return function(string) {
    string = toString(string);

    var strSymbols = hasUnicode(string)
      ? stringToArray(string)
      : undefined;

    var chr = strSymbols
      ? strSymbols[0]
      : string.charAt(0);

    var trailing = strSymbols
      ? castSlice(strSymbols, 1).join('')
      : string.slice(1);

    return chr[methodName]() + trailing;
  };
}

/**
 * Creates a function like `_.camelCase`.
 *
 * @private
 * @param {Function} callback The function to combine each word.
 * @returns {Function} Returns the new compounder function.
 */
function createCompounder(callback) {
  return function(string) {
    return arrayReduce(words(deburr(string).replace(reApos, '')), callback, '');
  };
}

/**
 * Checks if `value` is object-like. A value is object-like if it's not `null`
 * and has a `typeof` result of "object".
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is object-like, else `false`.
 * @example
 *
 * _.isObjectLike({});
 * // => true
 *
 * _.isObjectLike([1, 2, 3]);
 * // => true
 *
 * _.isObjectLike(_.noop);
 * // => false
 *
 * _.isObjectLike(null);
 * // => false
 */
function isObjectLike(value) {
  return !!value && typeof value == 'object';
}

/**
 * Checks if `value` is classified as a `Symbol` primitive or object.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a symbol, else `false`.
 * @example
 *
 * _.isSymbol(Symbol.iterator);
 * // => true
 *
 * _.isSymbol('abc');
 * // => false
 */
function isSymbol(value) {
  return typeof value == 'symbol' ||
    (isObjectLike(value) && objectToString.call(value) == symbolTag);
}

/**
 * Converts `value` to a string. An empty string is returned for `null`
 * and `undefined` values. The sign of `-0` is preserved.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to process.
 * @returns {string} Returns the string.
 * @example
 *
 * _.toString(null);
 * // => ''
 *
 * _.toString(-0);
 * // => '-0'
 *
 * _.toString([1, 2, 3]);
 * // => '1,2,3'
 */
function toString(value) {
  return value == null ? '' : baseToString(value);
}

/**
 * Deburrs `string` by converting
 * [Latin-1 Supplement](https://en.wikipedia.org/wiki/Latin-1_Supplement_(Unicode_block)#Character_table)
 * and [Latin Extended-A](https://en.wikipedia.org/wiki/Latin_Extended-A)
 * letters to basic Latin letters and removing
 * [combining diacritical marks](https://en.wikipedia.org/wiki/Combining_Diacritical_Marks).
 *
 * @static
 * @memberOf _
 * @since 3.0.0
 * @category String
 * @param {string} [string=''] The string to deburr.
 * @returns {string} Returns the deburred string.
 * @example
 *
 * _.deburr('déjà vu');
 * // => 'deja vu'
 */
function deburr(string) {
  string = toString(string);
  return string && string.replace(reLatin, deburrLetter).replace(reComboMark, '');
}

/**
 * Converts `string` to
 * [start case](https://en.wikipedia.org/wiki/Letter_case#Stylistic_or_specialised_usage).
 *
 * @static
 * @memberOf _
 * @since 3.1.0
 * @category String
 * @param {string} [string=''] The string to convert.
 * @returns {string} Returns the start cased string.
 * @example
 *
 * _.startCase('--foo-bar--');
 * // => 'Foo Bar'
 *
 * _.startCase('fooBar');
 * // => 'Foo Bar'
 *
 * _.startCase('__FOO_BAR__');
 * // => 'FOO BAR'
 */
var startCase = createCompounder(function(result, word, index) {
  return result + (index ? ' ' : '') + upperFirst(word);
});

/**
 * Converts the first character of `string` to upper case.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category String
 * @param {string} [string=''] The string to convert.
 * @returns {string} Returns the converted string.
 * @example
 *
 * _.upperFirst('fred');
 * // => 'Fred'
 *
 * _.upperFirst('FRED');
 * // => 'FRED'
 */
var upperFirst = createCaseFirst('toUpperCase');

/**
 * Splits `string` into an array of its words.
 *
 * @static
 * @memberOf _
 * @since 3.0.0
 * @category String
 * @param {string} [string=''] The string to inspect.
 * @param {RegExp|string} [pattern] The pattern to match words.
 * @param- {Object} [guard] Enables use as an iteratee for methods like `_.map`.
 * @returns {Array} Returns the words of `string`.
 * @example
 *
 * _.words('fred, barney, & pebbles');
 * // => ['fred', 'barney', 'pebbles']
 *
 * _.words('fred, barney, & pebbles', /[^, ]+/g);
 * // => ['fred', 'barney', '&', 'pebbles']
 */
function words(string, pattern, guard) {
  string = toString(string);
  pattern = guard ? undefined : pattern;

  if (pattern === undefined) {
    return hasUnicodeWord(string) ? unicodeWords(string) : asciiWords(string);
  }
  return string.match(pattern) || [];
}

module.exports = startCase;


/***/ }),

/***/ "./src/eventQuery/editor.scss":
/*!************************************!*\
  !*** ./src/eventQuery/editor.scss ***!
  \************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/eventQuery/style.scss":
/*!***********************************!*\
  !*** ./src/eventQuery/style.scss ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/eventTime/editor.scss":
/*!***********************************!*\
  !*** ./src/eventTime/editor.scss ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/eventTime/style.scss":
/*!**********************************!*\
  !*** ./src/eventTime/style.scss ***!
  \**********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/eventsComponent/editor.scss":
/*!*****************************************!*\
  !*** ./src/eventsComponent/editor.scss ***!
  \*****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/eventsComponent/style.scss":
/*!****************************************!*\
  !*** ./src/eventsComponent/style.scss ***!
  \****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/eventsTout/editor.scss":
/*!************************************!*\
  !*** ./src/eventsTout/editor.scss ***!
  \************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/eventsTout/style.scss":
/*!***********************************!*\
  !*** ./src/eventsTout/style.scss ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ (function(module) {

"use strict";
module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ (function(module) {

"use strict";
module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ (function(module) {

"use strict";
module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/compose":
/*!*********************************!*\
  !*** external ["wp","compose"] ***!
  \*********************************/
/***/ (function(module) {

"use strict";
module.exports = window["wp"]["compose"];

/***/ }),

/***/ "@wordpress/core-data":
/*!**********************************!*\
  !*** external ["wp","coreData"] ***!
  \**********************************/
/***/ (function(module) {

"use strict";
module.exports = window["wp"]["coreData"];

/***/ }),

/***/ "@wordpress/data":
/*!******************************!*\
  !*** external ["wp","data"] ***!
  \******************************/
/***/ (function(module) {

"use strict";
module.exports = window["wp"]["data"];

/***/ }),

/***/ "@wordpress/date":
/*!******************************!*\
  !*** external ["wp","date"] ***!
  \******************************/
/***/ (function(module) {

"use strict";
module.exports = window["wp"]["date"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ (function(module) {

"use strict";
module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ (function(module) {

"use strict";
module.exports = window["wp"]["i18n"];

/***/ }),

/***/ "@wordpress/primitives":
/*!************************************!*\
  !*** external ["wp","primitives"] ***!
  \************************************/
/***/ (function(module) {

"use strict";
module.exports = window["wp"]["primitives"];

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/extends.js":
/*!************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/extends.js ***!
  \************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ _extends; }
/* harmony export */ });
function _extends() {
  _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];

      for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }

    return target;
  };

  return _extends.apply(this, arguments);
}

/***/ }),

/***/ "./src/eventDate/block.json":
/*!**********************************!*\
  !*** ./src/eventDate/block.json ***!
  \**********************************/
/***/ (function(module) {

"use strict";
module.exports = JSON.parse('{"apiVersion":2,"name":"wp-action-network-events/event-date","title":"Event Date","category":"events","description":"Display event date in event query.","textdomain":"wp-action-network-events","attributes":{"format":{"type":"string"}},"usesContext":["postId","postType","queryId"],"parent":["core/post-template","wp-action-network-events/event-query"],"supports":{"html":false,"color":{"gradients":false,"link":false,"text":false,"background":false},"typography":{"fontSize":false,"lineHeight":false,"__experimentalFontWeight":false}},"style":"file:../../build/style-index.css","editorScript":"wp-action-network-events","editorStyle":"file:../../build/index.css"}');

/***/ }),

/***/ "./src/eventLocation/block.json":
/*!**************************************!*\
  !*** ./src/eventLocation/block.json ***!
  \**************************************/
/***/ (function(module) {

"use strict";
module.exports = JSON.parse('{"apiVersion":2,"name":"wp-action-network-events/event-location","title":"Event Location","category":"events","description":"Display event location in event query.","textdomain":"wp-action-network-events","icon":"location-alt","attributes":{},"usesContext":["postId","postType","queryId"],"parent":["core/post-template","wp-action-network-events/event-query"],"supports":{"html":false,"color":{"gradients":false,"link":false,"text":false,"background":false},"typography":{"fontSize":false,"lineHeight":false,"__experimentalFontWeight":false}},"style":"file:../../build/style-index.css","editorScript":"wp-action-network-events","editorStyle":"file:../../build/index.css"}');

/***/ }),

/***/ "./src/eventQuery/block.json":
/*!***********************************!*\
  !*** ./src/eventQuery/block.json ***!
  \***********************************/
/***/ (function(module) {

"use strict";
module.exports = JSON.parse('{"apiVersion":2,"name":"wp-action-network-events/event-query","title":"Event Query","category":"events","description":"Display a List of Events","textdomain":"wp-action-network-events","attributes":{"queryId":{"type":"number"},"query":{"type":"object","default":{"per_page":3,"event-tags":[],"order":"desc","orderby":"start","scope":"future"}},"taxonomy":{"type":"string","default":"event_tag"},"postType":{"type":"string","default":"an_event"},"metaKey":{"type":"string","default":"start_date"},"perPage":{"type":"number","default":3},"orderby":{"type":"string","default":"start/desc"},"eventTags":{"type":"string","default":""},"layout":{"type":"object","default":{"type":"grid"}},"scope":{"type":"string","default":"future","enum":["future","past","all"]},"dateFormat":{"type":"string","default":"l, F j, Y","enum":["l F j, Y","l, F j, Y","D, M j, Y","F j, Y","M j, Y","m/j/Y","D, M j"]},"timeFormat":{"type":"string","default":"g:ia","enum":["g:i a","g:i A","g:ia","H:i"]},"wrapperTagName":{"type":"string","default":"div"},"tagName":{"type":"string","default":"article"},"linkWrap":{"type":"boolean","default":true},"display":{"type":"object","default":{"showTags":false,"showFeaturedImage":false,"showTitle":true,"showDate":true,"showTime":true,"showEndTime":true,"showLocation":true}}},"providesContext":{"queryId":"queryId","query":"query","layout":"layout"},"supports":{"html":false,"color":{"gradients":false,"link":false,"text":false,"background":false},"typography":{"fontSize":false,"lineHeight":false,"__experimentalFontWeight":false}},"style":"file:../../build/style-index.css","editorScript":"wp-action-network-events","editorStyle":"file:../../build/index.css"}');

/***/ }),

/***/ "./src/eventTime/block.json":
/*!**********************************!*\
  !*** ./src/eventTime/block.json ***!
  \**********************************/
/***/ (function(module) {

"use strict";
module.exports = JSON.parse('{"apiVersion":2,"name":"wp-action-network-events/event-time","title":"Event Time","category":"events","description":"Display event time in event query.","textdomain":"wp-action-network-events","attributes":{"format":{"type":"string","default":"g:i a"}},"usesContext":["postId","postType","queryId"],"parent":["core/post-template"],"supports":{"html":false,"color":{"gradients":false,"link":false,"text":false,"background":false},"typography":{"fontSize":false,"lineHeight":false,"__experimentalFontWeight":false}},"style":"file:../../build/style-index.css","editorScript":"wp-action-network-events","editorStyle":"file:../../build/index.css"}');

/***/ }),

/***/ "./src/eventsComponent/block.json":
/*!****************************************!*\
  !*** ./src/eventsComponent/block.json ***!
  \****************************************/
/***/ (function(module) {

"use strict";
module.exports = JSON.parse('{"apiVersion":2,"version":"1.0.0","textdomain":"wp-action-network-events","name":"wp-action-network-events/events","title":"Events Component","category":"events","icon":"calendar-alt","className":"events","description":"Display events with section header and description.","keywords":["events","section"],"supports":{"align":false,"anchor":true,"color":{"background":false,"text":false,"gradients":false,"link":false},"customClassName":true,"defaultStylePicker":false,"__experimentalLayout":false},"attributes":{"tagName":{"type":"div"}},"variations":[],"styles":[],"example":{},"style":"file:../../build/style-index.css","editorScript":"wp-action-network-events","editorStyle":"file:../../build/index.css"}');

/***/ }),

/***/ "./src/eventsTout/block.json":
/*!***********************************!*\
  !*** ./src/eventsTout/block.json ***!
  \***********************************/
/***/ (function(module) {

"use strict";
module.exports = JSON.parse('{"apiVersion":2,"version":"1.0.0","textdomain":"wp-action-network-events","name":"wp-action-network-events/events-tout","title":"Events Tout","category":"events","icon":"calendar","className":"events-tout","description":"Display a tout displaying a group of events.","keywords":["events","section","tout"],"supports":{"align":false,"anchor":true,"color":{"background":false,"text":false,"gradients":false,"link":false},"customClassName":true,"defaultStylePicker":false,"__experimentalLayout":false},"attributes":{"tagName":{"type":"div"}},"variations":[],"styles":[],"example":{},"style":"file:../../build/style-index.css","editorScript":"wp-action-network-events","editorStyle":"file:../../build/index.css"}');

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	!function() {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = function(result, chunkIds, fn, priority) {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var chunkIds = deferred[i][0];
/******/ 				var fn = deferred[i][1];
/******/ 				var priority = deferred[i][2];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every(function(key) { return __webpack_require__.O[key](chunkIds[j]); })) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/global */
/******/ 	!function() {
/******/ 		__webpack_require__.g = (function() {
/******/ 			if (typeof globalThis === 'object') return globalThis;
/******/ 			try {
/******/ 				return this || new Function('return this')();
/******/ 			} catch (e) {
/******/ 				if (typeof window === 'object') return window;
/******/ 			}
/******/ 		})();
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	!function() {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"index": 0,
/******/ 			"style-index": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = function(chunkId) { return installedChunks[chunkId] === 0; };
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = function(parentChunkLoadingFunction, data) {
/******/ 			var chunkIds = data[0];
/******/ 			var moreModules = data[1];
/******/ 			var runtime = data[2];
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some(function(id) { return installedChunks[id] !== 0; })) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkIds[i]] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkexample_blocks"] = self["webpackChunkexample_blocks"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	}();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["style-index"], function() { return __webpack_require__("./src/index.js"); })
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=index.js.map