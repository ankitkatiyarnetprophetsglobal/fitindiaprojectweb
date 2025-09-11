// captcha.js
$('#reload').click(function () {
    $.get(routes.reloadCaptcha, function (data) {
        $(".captchaimg span").html(data.captcha);
    });
});
