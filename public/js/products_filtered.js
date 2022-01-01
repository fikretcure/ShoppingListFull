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
      })["catch"](function (error) { });
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
          var islemler = "";
          if (element.get_user.length > 0) {
            islemler = "<button type = \"button\" data-sepet=\"1\" class=\"btn btn-outline-secondary btn-block btn-sm set_sepet\" > <i class=\"fas fa-shopping-cart\"></i>&nbsp;Sepetten \xC7\u0131kar</button>";
          } else {
            islemler = "<button type = \"button\" data-sepet=\"0\" class=\"btn btn-outline-danger btn-block btn-sm set_sepet\" > <i class=\"fas fa-shopping-cart\"></i>&nbsp;Sepete Ekle</button>";
          }
          $(".tbl_products").append("\n                <tr>\n                    <td>".concat(index + 1, "</td>\n                    <td>").concat(element["name"], "</td>\n                    <td>").concat(element["quantity"], " adet</td>\n                    <td>").concat(element["km"], " km</td>\n                    <td>").concat(element["price"], " $</td>\n                    <td>").concat(element["color"], "</td>\n                    <td data-id=\"").concat(element['id'], "\">").concat(islemler, "</td>\n                </tr>"));
        });
      })["catch"](function (error) { });
    });
    $(".tbl_products").on("click", ".set_sepet", function () {
      var _this = this;
      if ($(this).data("sepet") == 0) {
        request("POST", "v1", "inbaskets", {
          products_id: $(this).parents("td").data("id")
        }).then(function (response) {
          $(_this).data("sepet", "1");
          $(_this).html('<i class="fas fa-shopping-cart"></i>&nbsp;Sepetten Çıkar');
          $(_this).attr("class", 'btn btn-outline-secondary btn-block btn-sm set_sepet');
        })["catch"](function (error) { });
      } else {
        request("DELETE", "v1", "inbaskets/destroy_products/" + $(this).parents("td").data("id")).then(function (response) {
          $(_this).data("sepet", "0");
          $(_this).html('<i class="fas fa-shopping-cart"></i>&nbsp;Sepete Ekle');
          $(_this).attr("class", 'btn btn-outline-danger btn-block btn-sm set_sepet');
        })["catch"](function (error) { });
      }
    });
  });
  /******/
})()
  ;