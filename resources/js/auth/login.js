// === Form Validation & Secure Submission ===
$('#frontadmin').on('submit', async function (e) {
    e.preventDefault();

    const email = $('#email').val().trim();
    const password = $('#password').val();
    const captcha = $('#captcha').val().trim();

    // Clear previous errors
    $('.error-msg').remove();

    let hasError = false;

    // === Validation ===
    if (!email || email.length > 255 || !/^[a-zA-Z0-9@._-]+$/.test(email)) {
        $('#email').after('<span class="error-msg" style="color:red; font-size:0.85em;">Please enter a valid email address.</span>');
        hasError = true;
    }

    if (!password || password.length < 6 || password.length > 255) {
        $('#password').after('<span class="error-msg" style="color:red; font-size:0.85em;">Password must be between 6 and 255 characters.</span>');
        hasError = true;
    }

    if (!captcha || captcha.length > 10 || !/^[a-zA-Z0-9]+$/.test(captcha)) {
        $('#captcha').after('<span class="error-msg" style="color:red; font-size:0.85em;">Please enter a valid captcha.</span>');
        hasError = true;
    }

    if (hasError) return;

    try {
        const encrypt_pass = await encryptGCM(password, "64");
        if (encrypt_pass.length > 2000) {
            alert('Password encryption failed. Please try again.');
            return;
        }

        $('#password').val(encrypt_pass);
        $('#login-submit').prop('disabled', true).val('Logging in...');
        
        // === AJAX submission for OTP integration ===
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.status === 'otp_required') {
                    // Show OTP modal
                    $('#phone-display').text(response.phone_masked);
                    $('#email-display').text(response.email_masked);
                    $('#otpModal').show();
                    startResendTimer();
                    $('#login-submit').prop('disabled', false).val('LOGIN');
                } else if (response.redirect) {
                    window.location.href = response.redirect;
                } else {
                    // Handle other success cases
                    e.target.submit();
                }
            },
            error: function(xhr) {
                $('#login-submit').prop('disabled', false).val('LOGIN');
                
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    // Handle validation errors
                    $.each(xhr.responseJSON.errors, function(key, messages) {
                        if (key === 'emailTomanyattampt') {
                            // Handle lockout message
                            $('#lockout-message').show();
                            const seconds = messages[0].match(/\d+/);
                            if (seconds) {
                                startLockoutCountdown(parseInt(seconds[0]));
                            }
                        } else {
                            $(`#${key}`).after(`<span class="error-msg" style="color:red; font-size:0.85em;">${messages[0]}</span>`);
                        }
                    });
                } else {
                    // Fallback to form submission for server-side error handling
                    e.target.submit();
                }
            }
        });

        setTimeout(() => {
            if (!$('#otpModal').is(':visible')) {
                $('#login-submit').prop('disabled', false).val('LOGIN');
            }
        }, 10000);
    } catch (error) {
        console.error('Encryption error:', error);
        alert('Password encryption failed. Please try again.');
        $('#login-submit').prop('disabled', false).val('LOGIN');
    }
});

// === Clear error messages on typing ===
$('#email, #password, #captcha').on('input', function () {
    $(this).next('.error-msg').remove();
});

// === OTP Modal Functionality ===
$(document).ready(function() {
    let resendTimer = 0;
    
    // Check if OTP modal should be shown on page load
    const showOtpModal = window.showOtpModal || false;
    const otpPhoneMasked = window.otpPhoneMasked || '';
    const otpEmailMasked = window.otpEmailMasked || '';
    const lockoutSeconds = window.lockoutSeconds || 0;
    
    if (showOtpModal) {
        $('#phone-display').text(otpPhoneMasked);
        $('#email-display').text(otpEmailMasked);
        $('#otpModal').show();
        startResendTimer();
    }
    
    // Handle lockout countdown on page load
    if (lockoutSeconds > 0) {
        $('#lockout-message').show();
        startLockoutCountdown(lockoutSeconds);
    }
    
    // OTP input handling
    $('.otp-input').on('input', function() {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
        
        if ($(this).val() && $(this).next('.otp-input').length) {
            $(this).next('.otp-input').focus();
        }
    });
    
    $('.otp-input').on('keydown', function(e) {
        if (e.key === 'Backspace' && !$(this).val() && $(this).prev('.otp-input').length) {
            $(this).prev('.otp-input').focus();
        }
    });
    
    // Verify OTP
    $('#verify-otp').on('click', function() {
        let otp = '';
        $('.otp-input').each(function() {
            otp += $(this).val();
        });
       
        if (otp.length !== 6) {
            showOtpError('Please enter complete 6-digit OTP');
            return;
        }
        
        $(this).prop('disabled', true).text('Verifying...');
        
        // Get CSRF token
        $.ajax({
            url: routes.verify_otp,
            method: 'POST',
            data: {
                otp: otp,
                _token: csrfToken
            },
            success: function(response) {
                if (response.status === 'success') {
                    window.location.href = response.redirect;
                }
            },
            error: function(xhr) {
                $('#verify-otp').prop('disabled', false).text('SUBMIT');
                
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    showOtpError(xhr.responseJSON.message);
                } else {
                    showOtpError('Verification failed. Please try again.');
                }
            }
        });
    });
    
    // Resend OTP
    $('#resend-otp').on('click', function(e) {
        e.preventDefault();
        
        if (resendTimer > 0) return;
        
        // Get CSRF token
        $.ajax({
            url: routes.resend_otp,
            method: 'POST',
            data: {
                _token: csrfToken
            },
            success: function(response) {
                if (response.status === 'success') {
                    startResendTimer();
                    $('#otp-error').hide();
                    // Clear OTP inputs
                    $('.otp-input').val('');
                    $('.otp-input').first().focus();
                }
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    showOtpError(xhr.responseJSON.message);
                }
            }
        });
    });
    
    // Close modal
    $('.close').on('click', function() {
        $('#otpModal').hide();
        // Reset form state
        $('#login-submit').prop('disabled', false).val('LOGIN');
    });
});

// === Helper Functions ===
function startResendTimer() {
    let resendTimer = 41;
    $('#resend-otp').hide();
    
    const timer = setInterval(function() {
        resendTimer--;
        $('#resend-timer').text(resendTimer + 's');
        
        if (resendTimer <= 0) {
            clearInterval(timer);
            $('#resend-otp').show();
            $('#resend-timer').text('');
        }
    }, 1000);
}

function showOtpError(message) {
    $('#otp-error').text(message).show();
    setTimeout(function() {
        $('#otp-error').fadeOut();
    }, 5000);
}

function startLockoutCountdown(seconds) {
    let timeLeft = seconds;
    $('#countdown').text(timeLeft + ' seconds');
    
    const countdown = setInterval(function() {
        timeLeft--;
        $('#countdown').text(timeLeft + ' seconds');
        
        if (timeLeft <= 0) {
            clearInterval(countdown);
            $('#lockout-message').hide();
        }
    }, 1000);
}