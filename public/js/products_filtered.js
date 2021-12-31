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
      quantity: $(".quantity_if").val() + "," + $(".quantity").val(),
      color: $(".renk").val()
    }).then(function (response) {
      $(".tbl_products").html(null);
      response.data.forEach(function (element, index, array) {
        $(".tbl_products").append("\n                <tr>\n                     <td>".concat(index + 1, "</td>\n                     <td>").concat(element["name"], "</td>\n                     <td>").concat(element["quantity"], " adet</td>\n                     <td>").concat(element["km"], " km</td>\n                     <td>").concat(element["price"], " $</td>\n                     <td>").concat(element["color"], "</td>\n                     <td>CRUD</td>\n                </tr>\n                "));
      });
    })["catch"](function (error) {});
  });
});
/******/ })()
;