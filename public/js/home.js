/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/home.js ***!
  \******************************/
$(function () {
  request("POST", "v1", "auth/check").then(function (response) {})["catch"](function (error) {
    window.location.href = "/login";
  });
});
/******/ })()
;