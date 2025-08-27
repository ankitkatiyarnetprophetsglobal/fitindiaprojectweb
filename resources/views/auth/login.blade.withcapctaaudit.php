@extends('layouts.app')
@section('title', 'Login | Fit India')
@section('content')
<style>
    #captcha-page-cont {
        margin-bottom: 15px;
    }

    .invalid-feedback {
        display: block !important;
        color: #dc3545;
        font-size: 0.875em;
        margin-top: 0.25rem;
    }

    .g-recaptcha {
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>
<section class="log_sec">
    <div class="container">
        <div class="row">

            <div class="col-12 signup_frm frm-details-login">
                <div class="frontlogin ">
                    <form action="{{ route('login') }}" method="POST" id="frontadmin" novalidate="novalidate">
                        @csrf
                        @if (Session::has('succ'))
                        <div class="alert alert-success">
                            <strong>Success !!</strong> {{ Str::limit(e(Session::get('succ')), 100) }}
                        </div>
                        @endif
                        <p>New to site?
                            <a id="fi_signup" href="{{ route('register') }}">Create an Account</a>
                        </p>

                        <div class="frm-details log_div">
                            <h1>{{ __('Login') }}</h1>

                            <div class="login-row" style="display:block;">
                                <label for="email">Email / Username</label>
                                <input id="email"
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="off"
                                    autofocus
                                    maxlength="255"
                                    pattern="[a-zA-Z0-9@._-]+"
                                    title="Only letters, numbers, @, ., _, and - are allowed">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ e($message) }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="login-row" style="display:block;">
                                <label for="password">Password</label>
                                <input id="password"
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    autocomplete="off"
                                    required
                                    maxlength="255"
                                    minlength="6">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ e($message) }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="login-row">
                                <div class="um-field" id="captcha-page-cont">
                                    <label for="g-recaptcha-response">Please verify you are human</label><br>
                                    {{-- Google reCAPTCHA --}}
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display(['data-theme' => 'light', 'data-size' => 'normal']) !!}

                                    {{-- Error Display --}}
                                    @error('g-recaptcha-response')
                                    <span class="invalid-feedback d-block" role="alert" style="font-size: 11px; margin-top: 5px;">
                                        <strong>{{ e($message) }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="register-row-submit">
                                <input class="submit_button" type="submit" value="LOGIN" id="login-submit">
                            </div>

                        </div>
                    </form>
                    <br>
                    @if (Route::has('password_change'))
                    <p class="forgot-pass"><a href="{{ route('password_change') }}">{{ __('Lost your password?') }}</a></p>
                    @endif
                </div>
            </div>
        </div>

    </div>

</section>

<script src="{{ asset('resources/js/crypto/crypto-js.js')}}"></script>
<script>
    // Secure CAPTCHA reload with CSRF protection and rate limiting
    // let captchaReloadCount = 0;
    // const maxCaptchaReloads = 10;

    // jQuery('#reload').click(function() {
    //     if (captchaReloadCount >= maxCaptchaReloads) {
    //         alert('Too many captcha reload attempts. Please refresh the page.');
    //         return;
    //     }

    //     captchaReloadCount++;

    //     jQuery.ajax({
    //         type: 'GET',
    //         url: '{{ route("reloadCaptcha") }}', // Use named route instead of hardcoded URL
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         timeout: 10000, // 10 second timeout
    //         success: function(data) {
    //             if (data && data.captcha) {
    //                 jQuery(".captchaimg span").html(data.captcha);
    //             }
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('Captcha reload failed:', error);
    //             alert('Failed to reload captcha. Please try again.');
    //         }
    //     });
    // });

    // Enhanced Crypto JS with input validation
    var CryptoJSAesJson = {
        stringify: function(cipherParams) {
            try {
                var j = {
                    ct: cipherParams.ciphertext.toString(CryptoJS.enc.Base64)
                };
                if (cipherParams.iv) j.iv = cipherParams.iv.toString();
                if (cipherParams.salt) j.s = cipherParams.salt.toString();
                return JSON.stringify(j);
            } catch (e) {
                console.error('Encryption stringify error:', e);
                throw new Error('Encryption failed');
            }
        },
        parse: function(jsonStr) {
            try {
                var j = JSON.parse(jsonStr);
                var cipherParams = CryptoJS.lib.CipherParams.create({
                    ciphertext: CryptoJS.enc.Base64.parse(j.ct)
                });
                if (j.iv) cipherParams.iv = CryptoJS.enc.Hex.parse(j.iv);
                if (j.s) cipherParams.salt = CryptoJS.enc.Hex.parse(j.s);
                return cipherParams;
            } catch (e) {
                console.error('Encryption parse error:', e);
                throw new Error('Decryption failed');
            }
        }
    };

    // Enhanced form validation and security
    $('#frontadmin').on('submit', function(e) {
        let email = $('#email').val();
        let password = $('#password').val();
        // let captcha = $('#captcha').val();

        // Client-side input validation
        if (!email || email.length > 255) {
            alert('Please enter a valid email address.');
            e.preventDefault();
            return false;
        }

        // Email format validation
        const emailRegex = /^[a-zA-Z0-9@._-]+$/;
        if (!emailRegex.test(email)) {
            alert('Email contains invalid characters.');
            e.preventDefault();
            return false;
        }

        if (!password || password.length < 6 || password.length > 255) {
            alert('Password must be between 6 and 255 characters.');
            e.preventDefault();
            return false;
        }

        // if (!captcha || captcha.length > 10) {
        //     alert('Please enter a valid captcha.');
        //     e.preventDefault();
        //     return false;
        // }

        // Captcha validation
        // const captchaRegex = /^[a-zA-Z0-9]+$/;
        // if (!captchaRegex.test(captcha)) {
        //     alert('Captcha contains invalid characters.');
        //     e.preventDefault();
        //     return false;
        // }

        try {
            // Encrypt password securely
            let encrypt_pass = CryptoJS.AES.encrypt(JSON.stringify(password), "64", {
                format: CryptoJSAesJson
            }).toString();

            // Validate encrypted length
            if (encrypt_pass.length > 2000) {
                alert('Password encryption failed. Please try again.');
                e.preventDefault();
                return false;
            }

            $('#password').val(encrypt_pass);

            // Disable submit button to prevent double submission
            $('#login-submit').prop('disabled', true).val('Logging in...');

            // Re-enable after timeout
            setTimeout(function() {
                $('#login-submit').prop('disabled', false).val('LOGIN');
            }, 10000);

        } catch (error) {
            console.error('Encryption error:', error);
            alert('Password encryption failed. Please try again.');
            e.preventDefault();
            return false;
        }
    });

    // Input sanitization for real-time validation
    $('#email').on('input', function() {
        let value = $(this).val();
        let sanitized = value.replace(/[^a-zA-Z0-9@._-]/g, '');
        if (value !== sanitized) {
            $(this).val(sanitized);
        }
        if (sanitized.length > 255) {
            $(this).val(sanitized.substr(0, 255));
        }
    });

    // $('#captcha').on('input', function() {
    //     let value = $(this).val();
    //     let sanitized = value.replace(/[^a-zA-Z0-9]/g, '');
    //     if (value !== sanitized) {
    //         $(this).val(sanitized);
    //     }
    //     if (sanitized.length > 10) {
    //         $(this).val(sanitized.substr(0, 10));
    //     }
    // });

    $('#password').on('input', function() {
        let value = $(this).val();
        if (value.length > 255) {
            $(this).val(value.substr(0, 255));
            alert('Password too long. Maximum 255 characters allowed.');
        }
    });

    $(document).ready(function() {
        // Security headers and settings
        $('form').attr('autocomplete', 'off');
        $('#password').attr('autocomplete', 'new-password');

        // Prevent right-click on sensitive fields
        $('#password, #captcha').on('contextmenu', function(e) {
            return false;
        });

        // Clear sensitive data on page unload
        $(window).on('beforeunload', function() {
            $('#password').val('');
            $('#captcha').val('');
        });

        // Add CSRF token to meta if not present
        if (!$('meta[name="csrf-token"]').length) {
            $('head').append('<meta name="csrf-token" content="{{ csrf_token() }}">');
        }

        // Session timeout warning
        let sessionTimeout = {{config('session.lifetime') * 60000 - 300000}}; // 5 minutes before expiry
        setTimeout(function() {
            alert('Your session will expire soon. Please save your work and login again if needed.');
        }, sessionTimeout);
    });

    // Content Security Policy helpers
    window.addEventListener('securitypolicyviolation', function(e) {
        console.error('CSP Violation:', e.violatedDirective, e.blockedURI);
    });
</script>

@endsection