@extends('layouts.app')
@section('title', 'Login | Fit India')
@section('content')

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
                            {{-- <a id="fi_signup" href="{{ route('register') }}">Create an Account</a> --}}
                            <a id="fi_signup" href="register?role=bmF0aW9uYWwtc3BvcnRzLWRheS0yMDI1">Create an Account</a>
                        </p>
                        <br>
                         {{-- Lockout countdown timer --}}
                         @if ($errors->has('emailTomanyattampt'))
                            @php
                                preg_match('/\d+/', $errors->first('emailTomanyattampt'), $matches);
                                $lockoutSeconds = isset($matches[0]) ? (int) $matches[0] : 0;
                            @endphp
                        @endif
                            <div id="lockout-message" class="alert alert-danger" style="display:none;">
                                Too many login attempts. Please try again in
                                <span id="countdown"></span>
                            </div>
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
                                    minlength="6"
                                    oncopy="return false"
                                    onpaste="return false"
                                    oncut="return false"
                                    ondrag="return false"
                                    ondrop="return false"
                                    oncontextmenu="return false"
                                    >

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ e($message) }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="login-row">
                                <div class="um-field" id="capcha-page-cont">
                                    <label for="captcha">Please Enter the Captcha Text</label><br>
                                    <div style="float:left; width:115px;  margin: 6px 0;" id="pagecaptcha-cont">
                                        <div class="captchaimg">
                                            <span>{!! captcha_img() !!}</span>
                                        </div>
                                    </div>
                                    <div style="float:left; margin: 6px 20px 6px 10px; cursor: pointer;">
                                        <button type="button" class="btn btn-info reload-captcha" id="reload"> ↻ </button>
                                    </div>

                                    <div style="float:left;" class="cap_width_login">
                                        <input type="text"
                                            id="captcha"
                                            name="captcha"
                                            class="form-control @error('captcha') is-invalid @enderror"
                                            required
                                            placeholder="Captcha"
                                            maxlength="10"
                                            pattern="[a-zA-Z0-9]+"
                                            title="Only letters and numbers are allowed">
                                        @error('captcha')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ e($message) }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div style="clear:both;"></div>
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
    let captchaReloadCount = 0;
    const maxCaptchaReloads = 10;

    jQuery('#reload').click(function() {
        if (captchaReloadCount >= maxCaptchaReloads) {
            alert('Too many captcha reload attempts. Please refresh the page.');
            return;
        }

        captchaReloadCount++;

        jQuery.ajax({
            type: 'GET',
            url: '{{ route("reloadCaptcha") }}', // Use named route instead of hardcoded URL
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            timeout: 10000, // 10 second timeout
            success: function(data) {
                if (data && data.captcha) {
                    jQuery(".captchaimg span").html(data.captcha);
                }
            },
            error: function(xhr, status, error) {
                console.error('Captcha reload failed:', error);
                alert('Failed to reload captcha. Please try again.');
            }
        });
    });

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
        let captcha = $('#captcha').val();

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

        if (!captcha || captcha.length > 10) {
            alert('Please enter a valid captcha.');
            e.preventDefault();
            return false;
        }

        // Captcha validation
        const captchaRegex = /^[a-zA-Z0-9]+$/;
        if (!captchaRegex.test(captcha)) {
            alert('Captcha contains invalid characters.');
            e.preventDefault();
            return false;
        }

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

    $('#captcha').on('input', function() {
        let value = $(this).val();
        let sanitized = value.replace(/[^a-zA-Z0-9]/g, '');
        if (value !== sanitized) {
            $(this).val(sanitized);
        }
        if (sanitized.length > 10) {
            $(this).val(sanitized.substr(0, 10));
        }
    });

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
        let sessionTimeout = {{  config('session.lifetime') * 60000 - 300000}}; // 5 minutes before expiry
        setTimeout(function() {
            alert('Your session will expire soon. Please save your work and login again if needed.');
        }, sessionTimeout);
    });

    // Content Security Policy helpers
    window.addEventListener('securitypolicyviolation', function(e) {
        console.error('CSP Violation:', e.violatedDirective, e.blockedURI);
    });
</script>

{{-- ===== Countdown Script ===== --}}
<script>
    // let lockoutExpiry = localStorage.getItem("lockoutExpiry");
    const currentEmail = "{{ strtolower(old('email', request()->input('email'))) }}";
const lockoutKey = currentEmail ? `lockoutExpiry:${currentEmail}` : null;
let lockoutExpiry = lockoutKey ? localStorage.getItem(lockoutKey) : null;

    // Backend se agar naya lockoutSeconds aaya to update karo
    // @if(isset($lockoutSeconds) && $lockoutSeconds > 0)
    //     lockoutExpiry = Date.now() + ({{ $lockoutSeconds }} * 1000);
    //     localStorage.setItem("lockoutExpiry", lockoutExpiry);
    // @endif

    @if(isset($lockoutSeconds) && $lockoutSeconds > 0)
    if (lockoutKey) {
        lockoutExpiry = Date.now() + ({{ $lockoutSeconds }} * 1000);
        localStorage.setItem(lockoutKey, lockoutExpiry);
        }
    @endif

    function formatTime(seconds) {
        const m = Math.floor(seconds / 60).toString().padStart(2, '0');
        const s = (seconds % 60).toString().padStart(2, '0');
        return `${m}:${s}`;
    }

    function startCountdown() {
        const msgBox = document.getElementById("lockout-message");
        const countdownElement = document.getElementById("countdown");
        const loginBtn = document.getElementById("login-submit");

        if (!lockoutExpiry || Date.now() > lockoutExpiry) {
            localStorage.removeItem("lockoutExpiry");
            if (msgBox) msgBox.style.display = "none";
            if (loginBtn) loginBtn.disabled = false;
            return;
        }

        if (msgBox) msgBox.style.display = "block";
        if (loginBtn) loginBtn.disabled = false;

        const interval = setInterval(() => {
            const remaining = Math.floor((lockoutExpiry - Date.now()) / 1000);

            if (remaining <= 0) {
                clearInterval(interval);
                localStorage.removeItem("lockoutExpiry");

                if (msgBox) msgBox.innerHTML = "You can now try logging in again.";
                if (loginBtn) loginBtn.disabled = false;
            } else {
                if (countdownElement) {
                    countdownElement.textContent = formatTime(remaining);
                }
            }
        }, 1000);
    }

    if (lockoutExpiry) startCountdown();
</script>
<script>
// Extra keyboard shortcut protection (Ctrl+V, Ctrl+C etc.)
document.getElementById("password").addEventListener("keydown", function(e) {
    if ((e.ctrlKey || e.metaKey) && (e.key === "v" || e.key === "c" || e.key === "x" || e.key === "a")) {
        e.preventDefault();
    }
});
</script>
@endsection
