$(function () {
    request("POST", "v1", "auth/check",).then(response => {
    }).catch(error => {
        window.location.href = "/login";
    });
    $.urlParameters = function (params) {
        var results = new RegExp("[?&]" + params + "=([^&#]*)").exec(
            window.location.href
        );
        return results ? decodeURI(results[1]) : null;
    };
    let products_pagination = 1;
    if ($.urlParameters("page")) products_pagination = parseInt($.urlParameters("page"));
    request("GET", "v1", "products/with_user?page=" + products_pagination,).then(response => {

        response.data.products.data.forEach(function (element, index, array) {

            let islemler = "";
            if (response.data.user_type) {
                islemler += `<button type = "button"  class="btn btn-outline-danger btn-block btn-sm">DÜZENLE</button>`;
                islemler += `<button type = "button"  class="btn btn-outline-danger btn-block btn-sm">SİL</button>`;
                islemler += `<button type = "button"  class="btn btn-outline-danger btn-block btn-sm">EKLE</button>`;
            }

            if (element.get_user.length > 0) {
                islemler += `<button type = "button" data-sepet="1" class="btn btn-outline-secondary btn-block btn-sm set_sepet" > <i class="fas fa-shopping-cart"></i>&nbsp;Sepetten Çıkar</button>`;
            } else {
                islemler += `<button type = "button" data-sepet="0" class="btn btn-outline-danger btn-block btn-sm set_sepet" > <i class="fas fa-shopping-cart"></i>&nbsp;Sepete Ekle</button>`;
            }
            $(".tbl_products").append(`
                <tr>
                     <td>${(index + 1) + (((products_pagination - 1) * 10))}</td>
                     <td>${element["name"]}</td>
                     <td>${element["quantity"]} adet</td>
                     <td>${element["km"]} km</td>
                     <td>${element["price"]} $</td>
                     <td>${element["color"]}</td>
                     <td data-id="${element['id']}">${islemler}</td>
                </tr>`);
        });
        $(".products_pagination").html(null);
        for (let index = 1; index < response.data.pagination_count + 1; index++) {
            $(".products_pagination").append(`<li class="page-item"><a class="page-link" href="?page=${index}">${index}</a></li>`);
        }
        let page = 0;
        if (response.data.products.next_page_url) {
            page = products_pagination + 1;
            $(".products_pagination").append(`<li class="page-item"><a class="page-link" href="?page=${page}">»</a></li>`);
        }
        if (response.data.products.prev_page_url) {
            page = products_pagination - 1;
            $(".products_pagination").prepend(`<li class="page-item"><a class="page-link" href="?page=${page}">«</a></li>`);
        }
    }).catch(error => {
    });
    $(".tbl_products").on("click", ".set_sepet", function () {
        if ($(this).data("sepet") == 0) {
            request("POST", "v1", "inbaskets", { products_id: $(this).parents("td").data("id") }).then(response => {
                $(this).data("sepet", "1");
                $(this).html('<i class="fas fa-shopping-cart"></i>&nbsp;Sepetten Çıkar');
                $(this).attr("class", 'btn btn-outline-secondary btn-block btn-sm set_sepet');
            }).catch(error => {
            });
        } else {
            request("DELETE", "v1", "inbaskets/destroy_products/" + $(this).parents("td").data("id"),).then(response => {
                $(this).data("sepet", "0");
                $(this).html('<i class="fas fa-shopping-cart"></i>&nbsp;Sepete Ekle');
                $(this).attr("class", 'btn btn-outline-danger btn-block btn-sm set_sepet');
            }).catch(error => {
            });
        }
    });
});