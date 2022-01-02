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
  request("GET", "v1", "products/with_user?page=" + products_pagination).then(function (response) {
    response.data.products.data.forEach(function (element, index, array) {
      var islemler = "";

      if (response.data.user_type) {
        islemler += "<button type = \"button\"  class=\"btn btn-outline-danger btn-block btn-sm\">D\xDCZENLE</button>";
        islemler += "<button type = \"button\"  class=\"btn btn-outline-danger btn-block btn-sm\">S\u0130L</button>";
        islemler += "<button type = \"button\"  class=\"btn btn-outline-danger btn-block btn-sm\">EKLE</button>";
      }

      if (element.get_user.length > 0) {
        islemler += "<button type = \"button\" data-sepet=\"1\" class=\"btn btn-outline-secondary btn-block btn-sm set_sepet\" > <i class=\"fas fa-shopping-cart\"></i>&nbsp;Sepetten \xC7\u0131kar</button>";
      } else {
        islemler += "<button type = \"button\" data-sepet=\"0\" class=\"btn btn-outline-danger btn-block btn-sm set_sepet\" > <i class=\"fas fa-shopping-cart\"></i>&nbsp;Sepete Ekle</button>";
      }

      $(".tbl_products").append("\n                <tr>\n                     <td>".concat(index + 1 + (products_pagination - 1) * 10, "</td>\n                     <td>").concat(element["name"], "</td>\n                     <td>").concat(element["quantity"], " adet</td>\n                     <td>").concat(element["km"], " km</td>\n                     <td>").concat(element["price"], " $</td>\n                     <td>").concat(element["color"], "</td>\n                     <td data-id=\"").concat(element['id'], "\">").concat(islemler, "</td>\n                </tr>"));
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
  $(".tbl_products").on("click", ".set_sepet", function () {
    var _this = this;

    if ($(this).data("sepet") == 0) {
      request("POST", "v1", "inbaskets", {
        products_id: $(this).parents("td").data("id")
      }).then(function (response) {
        $(_this).data("sepet", "1");
        $(_this).html('<i class="fas fa-shopping-cart"></i>&nbsp;Sepetten Çıkar');
        $(_this).attr("class", 'btn btn-outline-secondary btn-block btn-sm set_sepet');
      })["catch"](function (error) {});
    } else {
      request("DELETE", "v1", "inbaskets/destroy_products/" + $(this).parents("td").data("id")).then(function (response) {
        $(_this).data("sepet", "0");
        $(_this).html('<i class="fas fa-shopping-cart"></i>&nbsp;Sepete Ekle');
        $(_this).attr("class", 'btn btn-outline-danger btn-block btn-sm set_sepet');
      })["catch"](function (error) {});
    }
  });
});
/******/ })()
;