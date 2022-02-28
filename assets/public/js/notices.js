/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./assets/src/js/notices.js ***!
  \**********************************/
document.addEventListener("DOMContentLoaded", function () {
  var data = wpANENoticesData;
  var syncButton = document.getElementById('wp-action-network-events-sync-submit');
  var noticeContainer = document.getElementById(data.ontainer_id);

  var onClick = function onClick(event) {
    event.preventDefault();
    sendRequest(data);
  };

  var sendRequest = function sendRequest(data) {
    var params = {
      action: data.action,
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
    });
  };

  if (syncButton && data) {
    syncButton.addEventListener('click', onClick);
  }
});
/******/ })()
;