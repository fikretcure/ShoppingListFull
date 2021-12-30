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



        }).then(response => {
        }).catch(error => {
        });
    });
});