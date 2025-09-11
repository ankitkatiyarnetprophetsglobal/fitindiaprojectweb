// otp.js
function startTimer(elementId, remaining, showAfter) {
    let timerOn = true;
    function timer(sec) {
        const m = String(Math.floor(sec / 60)).padStart(2, '0');
        const s = String(sec % 60).padStart(2, '0');
        document.getElementById(elementId).innerHTML = `${m}:${s}`;
        if (sec > 0 && timerOn) {
            setTimeout(() => timer(sec - 1), 1000);
        } else {
            $(showAfter).show();
        }
    }
    timer(remaining);
}

// Email verify
$('.email_verify').click(function (event) {
    event.preventDefault();
    $("#divloader").show();
    $("#resend_otp").hide();

    const email_value = $('#email').val();
    const role_name = $('#role_name').val();
    const regex = /^[\w.+-]+@\w+\.\w+$/;

    if (!regex.test(email_value)) {
        $("#email_error").show();
        $("#divloader").hide();
        return;
    }
    $("#email_error").hide();

    $.post(routes.duplicateemailcheck, {
        email: email_value,
        role_name,
        _token: csrfToken
    }, function (response) {
        $("#divloader").hide();
        if (response.success === 'otplimitexceed') {
            $('#otpLimitexceed').modal('show');
        } else if (response.success === false) {
            $("#duplicate_email_error").show();
        } else {
            $('#emailModal').modal({ backdrop: 'static', keyboard: false });
            $("#duplicate_email_error").hide();
            startTimer('timer', 180, "#resend_otp");
        }
    });
});

// Mobile verify
$('.mobile_verify').click(function (event) {
    event.preventDefault();
    $("#divloader").show();
    $("#mobile_otp_resend").hide();

    const phone_value = $('#phone').val();
    const role_name = $('#role_name').val();

    if (!$.isNumeric(phone_value) || phone_value.length !== 10) {
        $("#divloader").hide();
        $("#phone_error").show();
        return;
    }
    $("#phone_error").hide();

    $.post(routes.duplicatemobilecheck, {
        phone_number: phone_value,
        role_name,
        _token: csrfToken
    }, function (response) {
        $("#divloader").hide();
        if (response.success === 'otplimitexceed') {
            $('#otpLimitexceed').modal('show');
        } else if (response.success === false) {
            $("#duplicate_phone_error").show();
        } else {
            $('#mobileModal').modal({ backdrop: 'static', keyboard: false });
            startTimer('mobile_timer', 180, "#mobile_otp_resend");
        }
    });
});
