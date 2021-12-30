/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./resources/js/products_filtered.js ***!
  \*******************************************/
$(function () {
  request("POST", "v1", "auth/check").then(function (response) {
    /*  */
    request("GET", "v1", "products/group_color").then(function (response) {
      $(".renk").html(null).append("<option value=\"\">Se\xE7im Yap\u0131n\u0131z</option>");
      response.data.forEach(function (element, index, array) {
        $(".renk").append("<option>".concat(element.color, "</option>"));
      });
    })["catch"](function (error) {});
    /*  */
  })["catch"](function (error) {
    window.location.href = "/login";
  });
  $("#filtered").click(function () {
    request("GET", "v1", "products/filtered", {
      km: $(".km_if").val() + "," + $(".km").val(),
      price: $(".price_if").val() + "," + $(".price").val(),
      quantity: $(".quantity_if").val() + "," + $(".quantity").val()
    }).then(function (response) {})["catch"](function (error) {});
  });
});
/******/ })()
;