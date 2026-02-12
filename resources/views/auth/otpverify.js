// otp-verify.js

 var CryptoJSAesJson = {
        stringify: function (cipherParams) {
            var j = {ct: cipherParams.ciphertext.toString(CryptoJS.enc.Base64)};
            if (cipherParams.iv) j.iv = cipherParams.iv.toString();
            if (cipherParams.salt) j.s = cipherParams.salt.toString();
            return JSON.stringify(j);
        },
        parse: function (jsonStr) {
            var j = JSON.parse(jsonStr);
            var cipherParams = CryptoJS.lib.CipherParams.create({ciphertext: CryptoJS.enc.Base64.parse(j.ct)});
            if (j.iv) cipherParams.iv = CryptoJS.enc.Hex.parse(j.iv)
            if (j.s) cipherParams.salt = CryptoJS.enc.Hex.parse(j.s)
            return cipherParams;
        }
    }

$('#email_otp_verify').click(function (event) {
    alert(2);
    return false;
    event.preventDefault();
    $("#divloader").show();

    const email_value = $('#email').val();
    const otp_value = $('#email_otp').val();

    if (!$.isNumeric(otp_value) || otp_value.length < 5 || otp_value.length > 6) {
        $("#divloader").hide();
        $(".email_otp_error").show();
        return;
    }
    $(".email_otp_error").hide();

    $.post(routes.emailOtpCheck, {
        otp_value,
        email: email_value,
        _token: csrfToken
    }, function (response) {
        $("#divloader").hide();
        const decrypted = JSON.parse(CryptoJS.AES.decrypt(response.success, "passphrasepass", {
            format: CryptoJSAesJson
        }).toString(CryptoJS.enc.Utf8));

        const value_split = decrypted.split(":")[1];
        if (value_split === "truewrtsuss") {
            $("#verify_button_hide").hide();
            $("#verifyed_button_show").show();
            $("#emailModal").modal("hide");
        } else {
            $(".email_otp_error").show();
        }
    });
});

$('#mobile_otp_verify').click(function (event) {
    alert(3);
    return false;
    event.preventDefault();
    $("#divloader").show();

    const phone_value = $('#phone').val();
    const phone_otp_value = $('#phone_otp').val();
    const captcha = $('#captcha').val();
    alert(captcha);
    return false;
    if (!$.isNumeric(phone_otp_value) || phone_otp_value.length < 5 || phone_otp_value.length > 6) {
        $("#divloader").hide();
        $(".mobile_otp_error").show();
        return;
    }
    $(".mobile_otp_error").hide();

    $.post(routes.mobileOtpCheck, {
        otp_value: phone_otp_value,
        mobile: phone_value,
        _token: csrfToken
    }, function (response) {
        $("#divloader").hide();
        const decrypted = JSON.parse(CryptoJS.AES.decrypt(response.success, "passphrasepass", {
            format: CryptoJSAesJson
        }).toString(CryptoJS.enc.Utf8));

        // new code
        const value_split = decrypted.split(":")[1];
        const value_mobile_split = decrypted.split(":")[3];

        if (value_split === "truewrtsuss" && value_mobile_split == phone_value) {
            $("#verifyed_mobile_button_show").show();
            $("#verify_button_mobile_hide").hide();
            $("#mobileModal").modal("hide");
        } else {
            $(".mobile_otp_error").show();
        }
        // old code
        // const value_split = decrypted.split(":")[1];
        // if (value_split === "truewrtsuss") {
        //     $("#verifyed_mobile_button_show").show();
        //     $("#verify_button_mobile_hide").hide();
        //     $("#mobileModal").modal("hide");
        // } else {
        //     $(".mobile_otp_error").show();
        // }
    });
});
