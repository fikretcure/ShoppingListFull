/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/products.js ***!
  \**********************************/
$(function () {
  request("POST", "v1", "auth/check").then(function (response) {})["catch"](function (error) {
    window.location.href = "/login";
  });

  $.urlParameters = function (params) {
    var results = new RegExp("[?&]" + params + "=([^&#]*)").exec(window.location.href);
    return results ? decodeURI(results[1]) : null;
  };

  var products_pagination = 1;
  if ($.urlParameters("page")) products_pagination = parseInt($.urlParameters("page"));
  request("GET", "v1", "products?page=" + products_pagination).then(function (response) {
    response.data.products.data.forEach(function (element, index, array) {
      $(".tbl_products").append("\n                <tr>\n                     <td>".concat(index + 1 + (products_pagination - 1) * 10, "</td>\n                     <td>").concat(element["name"], "</td>\n                     <td>").concat(element["quantity"], " adet</td>\n                     <td>").concat(element["km"], " km</td>\n                     <td>").concat(element["price"], " $</td>\n                     <td>").concat(element["color"], "</td>\n                     <td>CRUD</td>\n                </tr>\n                "));
    });
    $(".products_pagination").html(null);

    for (var index = 1; index < response.data.pagination_count + 1; index++) {
      $(".products_pagination").append("<li class=\"page-item\"><a class=\"page-link\" href=\"?page=".concat(index, "\">").concat(index, "</a></li>"));
    }

    var page = 0;

    if (response.data.products.next_page_url) {
      page = products_pagination + 1;
      $(".products_pagination").append("<li class=\"page-item\"><a class=\"page-link\" href=\"?page=".concat(page, "\">\xBB</a></li>"));
    }

    if (response.data.products.prev_page_url) {
      page = products_pagination - 1;
      $(".products_pagination").prepend("<li class=\"page-item\"><a class=\"page-link\" href=\"?page=".concat(page, "\">\xAB</a></li>"));
    }
  })["catch"](function (error) {});
});
/******/ })()
;