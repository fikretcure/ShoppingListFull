$(function () {
    request("POST", "v1", "auth/check",).then(response => {
    }).catch(error => {
        window.location.href = "/login";
    });
});