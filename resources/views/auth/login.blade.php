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
                            <a id="fi_signup" href="{{ route('register') }}">Create an Account</a>
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
                                    oncontextmenu="return false">

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
{{-- OTP Verification Modal --}}
<div id="otpModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
    <div class="modal-content" style="background-color: #fefefe; margin: 10% auto; padding: 0; border-radius: 10px; width: 90%; max-width: 500px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <div class="modal-header" style="padding: 20px; border-bottom: 1px solid #ddd; position: relative;">
            <span class="close" style="position: absolute; right: 20px; top: 20px; color: #aaa; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
            <div style="text-align: center;">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; margin: 0 auto 15px; display: flex; align-items: center; justify-content: center;">
                    <svg width="30" height="30" fill="white" viewBox="0 0 24 24">
                        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z" />
                    </svg>
                </div>
                <h2 style="margin: 0; color: #333; font-size: 24px;">OTP Verification</h2>
            </div>
        </div>

        <div class="modal-body" style="padding: 20px;">
            <p style="text-align: center; color: #666; margin-bottom: 20px; line-height: 1.5;">
                Please type the OTP as shared on your mobile
                <span id="phone-display"></span> and Email
                <span id="email-display"></span>
            </p>

            <div id="otp-inputs" style="display: flex; justify-content: center; gap: 10px; margin: 20px 0;">
                <input type="text" class="otp-input" maxlength="1" style="width: 50px; height: 50px; text-align: center; font-size: 20px; border: 2px solid #ddd; border-radius: 8px; outline: none;">
                <input type="text" class="otp-input" maxlength="1" style="width: 50px; height: 50px; text-align: center; font-size: 20px; border: 2px solid #ddd; border-radius: 8px; outline: none;">
                <input type="text" class="otp-input" maxlength="1" style="width: 50px; height: 50px; text-align: center; font-size: 20px; border: 2px solid #ddd; border-radius: 8px; outline: none;">
                <input type="text" class="otp-input" maxlength="1" style="width: 50px; height: 50px; text-align: center; font-size: 20px; border: 2px solid #ddd; border-radius: 8px; outline: none;">
                <input type="text" class="otp-input" maxlength="1" style="width: 50px; height: 50px; text-align: center; font-size: 20px; border: 2px solid #ddd; border-radius: 8px; outline: none;">
                <input type="text" class="otp-input" maxlength="1" style="width: 50px; height: 50px; text-align: center; font-size: 20px; border: 2px solid #ddd; border-radius: 8px; outline: none;">
            </div>

            <div style="text-align: center; margin: 20px 0;">
                <span>OTP not received? </span>
                <a href="#" id="resend-otp" style="color: #667eea; text-decoration: none; font-weight: bold;">RESEND</a>
                <span id="resend-timer" style="color: #666;"></span>
            </div>

            <div id="otp-error" class="alert alert-danger" style="display: none; margin: 10px 0; padding: 10px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px;"></div>

            <button id="verify-otp" style="width: 100%; padding: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; margin-top: 10px;">
                SUBMIT
            </button>
        </div>
    </div>
</div>
<script>
    window.appConfig = {
        reloadCaptchaUrl: "{{ route('reloadCaptcha') }}",
        csrfToken: "{{ csrf_token() }}",
        sessionTimeout: {{config('session.lifetime') * 60000 - 300000}},
        lockoutSeconds: {{$lockoutSeconds ?? 0}},
        currentEmail: "{{ strtolower(old('email', request()->input('email'))) }}"
    };

        const routes = {
        verify_otp: "{{ route('verify-otp') }}",
        resend_otp: "{{ route('resend-otp') }}"
    };
    const csrfToken = "{{ csrf_token() }}";
     
</script>
<script src="{{ asset('resources/js/crypto/crypto-js.js')}}"></script>
<script src="{{ asset('resources/js/auth/crypto.js')}}"></script>
<script src="{{ asset('resources/js/auth/login.js')}}"></script>
@endsection