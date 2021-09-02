/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./assets/src/js/backend.js ***!
  \**********************************/
document.addEventListener("DOMContentLoaded", function () {
  var buttonEl = document.getElementById('wp-action-network-events-sync-submit');
  var nonce = document.getElementById('wp_action_network_events_sync_nonce');
  var data = wpANEData;

  var onClick = function onClick(event) {
    event.preventDefault();
    sendRequest(data);
  };

  var sendRequest = function sendRequest(props) {
    var params = {
      action: data.action
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
      return console.log(data);
    });
  };

  if (buttonEl && data && nonce) {
    buttonEl.addEventListener('click', onClick);
  }
});
/******/ })()
;