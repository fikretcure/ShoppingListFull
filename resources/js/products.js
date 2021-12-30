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
    request("GET", "v1", "products?page=" + products_pagination,).then(response => {
        response.data.products.data.forEach(function (element, index, array) {
            $(".tbl_products").append(`
                <tr>
                     <td>${(index + 1) + (((products_pagination - 1) * 10))}</td>
                     <td>${element["name"]}</td>
                     <td>${element["quantity"]} adet</td>
                     <td>${element["km"]} km</td>
                     <td>${element["price"]} $</td>
                     <td>${element["color"]}</td>
                     <td>CRUD</td>
                </tr>
                `);
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
});