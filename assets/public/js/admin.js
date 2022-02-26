/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/scss/admin.scss":
/*!************************************!*\
  !*** ./assets/src/scss/admin.scss ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


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
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!********************************!*\
  !*** ./assets/src/js/admin.js ***!
  \********************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _scss_admin_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../scss/admin.scss */ "./assets/src/scss/admin.scss");

document.addEventListener("DOMContentLoaded", function () {
  var data = wpANEData;
  var syncButton = document.getElementById('wp-action-network-events-sync-submit');
  var importButton = document.getElementById('wp-action-network-events-sync-submit-clean');
  var nonce = document.getElementById('wp_action_network_events_sync_nonce');
  var noticeContainer = document.getElementById('sync-notice-container');
  var errorNotice = '<div class="notice notice-error"><p>%s</p></div>';
  var successNotice = '<div class="notice notice-success is-dismissible"><p>Successfully completed at %s</p></div>';
  var infoNotice = '<div class="notice notice-info is-dismissible"><p>%s</p></div>';
  var warningNotice = '<div class="notice notice-warning is-dismissible"><p>%s</p></div>';

  var onClick = function onClick(event) {
    event.preventDefault();
    var action = 'wp-action-network-events-sync-submit-clean' === event.target.id ? data.action + '_clean' : data.action;
    sendRequest(action);
  };

  var sendRequest = function sendRequest(action) {
    var params = {
      action: action,
      nonce: data.nonce
    };
    var query = new URLSearchParams(params).toString();
    fetch(data.ajax_url, {
      method: 'POST',
      credentials: 'same-origin',
      headers: new Headers({
        'Content-Type': 'application/x-www-form-urlencoded'
      }),
      body: query
    }).then(function (response) {
      return response.json();
    }).then(function (data) {
      console.log(data);
      var message = successNotice.replace('%s', data.finish);
      noticeContainer.insertAdjacentHTML('afterbegin', message);
    }).catch(function (error) {
      console.error('Error:', error);
      var message = successNotice.replace('%s', JSON.stringify(error));
      noticeContainer.insertAdjacentHTML('afterbegin', errorNotice);
    });
  };

  if (syncButton && data && nonce) {
    syncButton.addEventListener('click', onClick);
  }

  if (importButton && data && nonce) {
    importButton.addEventListener('click', onClick);
  }
});
})();

/******/ })()
;