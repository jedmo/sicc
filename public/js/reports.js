/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/reports.js ***!
  \*********************************/
function loadReports() {
  console.log('2');
  axios.get("/api/reports").then(function (response) {
    console.log(response.data);
  })["catch"](function (error) {
    console.log(error);
  });
}
/******/ })()
;