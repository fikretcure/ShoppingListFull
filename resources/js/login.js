
$(function () {


    request("POST", "v1", "auth/check",).then(response => {
        window.location.href = "/";
    }).catch(error => {
    });


    $(".login").click(function () {
        $(".login-box-msg").html(null);
        request("POST", "v1", "auth/login", { email: $("#email").val(), password: $("#password").val() }).then(response => {
            $(".login-box-msg").html('<span class="mb-2 badge bg-success">Giriş başarılı yönlendiriliyorsunuz !</span>');
            localStorage.setItem('x-refresh-token', response.headers["x-refresh-token"]);

            setTimeout(function () {
                window.location.href = "/";
            }, 3000);
        }).catch(error => {

            console.log(error);
            // if (error.response.status == 405) {
            //     Object.entries(error.response.data).forEach(([key, value]) => {
            //         $(".login-box-msg").append('<span class="mb-2 badge bg-danger">' + value[0] + '</span>');
            //     });
            // } else {
            //     $(".login-box-msg").append('<span class="mb-2 badge bg-danger">' + error.response.data + '</span>');
            // }
            // setTimeout(function () {
            //     $(".login-box-msg").html('<span class="mb-2 badge bg-success">Tekrar Deneyiniz !</span>');
            // }, 2000);
        });
    });
});