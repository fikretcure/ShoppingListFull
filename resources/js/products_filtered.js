$(function () {
    request("POST", "v1", "auth/check",).then(response => {
        /*  */
        request("GET", "v1", "products/group_color",).then(response => {
            $(".renk").html(null).append(`<option value="">Seçim Yapınız</option>`);
            response.data.forEach(function (element, index, array) {
                $(".renk").append(`<option>${element.color}</option>`);
            });
        }).catch(error => {
        });
        /*  */
    }).catch(error => {
        window.location.href = "/login";
    });
    $("#filtered").click(function () {
        request("GET", "v1", "products/filtered", {
            km: $(".km_if").val() + "," + $(".km").val(),
            price: $(".price_if").val() + "," + $(".price").val(),
            quantity: $(".quantity_if").val() + "," + $(".quantity").val(),
            color: $(".renk").val(),
        }).then(response => {
            $(".tbl_products").html(null);
            response.data.forEach(function (element, index, array) {
                let islemler = "";
                if (element.get_user.length > 0) {
                    islemler = `<button type = "button" data-sepet="1" class="btn btn-outline-secondary btn-block btn-sm set_sepet" > <i class="fas fa-shopping-cart"></i>&nbsp;Sepetten Çıkar</button>`;
                } else {
                    islemler = `<button type = "button" data-sepet="0" class="btn btn-outline-danger btn-block btn-sm set_sepet" > <i class="fas fa-shopping-cart"></i>&nbsp;Sepete Ekle</button>`;
                }
                $(".tbl_products").append(`
                <tr>
                    <td>${(index + 1)}</td>
                    <td>${element["name"]}</td>
                    <td>${element["quantity"]} adet</td>
                    <td>${element["km"]} km</td>
                    <td>${element["price"]} $</td>
                    <td>${element["color"]}</td>
                    <td data-id="${element['id']}">${islemler}</td>
                </tr>`);
            });
        }).catch(error => {
        });
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