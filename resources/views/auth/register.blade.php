@extends('layouts.app')
@section('title', 'Register | Fit India')
@section('content')

<link rel="stylesheet" href="{{ asset('resources/css/auth/style.css') }}">
<section class="log_sec">
    <div class="container">
        <div id="divloader" class="loaderregister" style="display: none">
            <img style="margin-top:15%; width: 15%; height: 25%;" src="{{ url('/wp-content/uploads/2021/01/loader.gif') }}" />
        </div>
        <div class="row">
            <div class="col-12 signup_frm">
                <form id="fi-register" class="register-form" action="{{ route('register') }}" method="post" novalidate>
                    @csrf
                    <p>Already have an account? <a id="fi_signin" href="login">Login</a></p>

                    <div class="frm-details res_mobile">
                        <h1>{{ __('Register') }}</h1>

                        {{-- Role Type --}}
                        <label for="role">{{ __('Register As') }}</label>
                        <div class="register-row">
                            <div class="register-row-lft">
                                <div class="role-row">
                                    @if (isset($_GET['role']))
                                        @if ($_GET['role'] == 'bmFtby1maXQtaW5kaWEteW91dGgtY2x1Yg==' || $_GET['role'] == 'bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi')
                                            <input type="radio" name="roletype" value="1" disabled> Ministries/Departments
                                            <input type="radio" name="roletype" value="2" disabled> Armed forces/CPF
                                            <input type="radio" name="roletype" value="0" checked> Other
                                        @elseif ($_GET['role'] == 'Y3ljbG90aG9uLTIwMjQ=')
                                            {{-- role disabled here --}}
                                        @else
                                            <input type="radio" name="roletype" value="1" onclick="fi_rolechange(this.value)" checked> Ministries/Departments
                                            <input type="radio" name="roletype" value="2" onclick="fi_rolechange(this.value)"> Armed forces/CPF
                                            <input type="radio" name="roletype" value="0" onclick="fi_rolechange(this.value)"> Other
                                        @endif
                                    @else
                                        <input type="radio" name="roletype" value="1" onclick="fi_rolechange(this.value)" checked> Ministries/Departments
                                        <input type="radio" name="roletype" value="2" onclick="fi_rolechange(this.value)"> Armed forces/CPF
                                        <input type="radio" name="roletype" value="0" onclick="fi_rolechange(this.value)"> Other
                                    @endif
                                </div>

                                <input type="hidden" name="role_name" id="role_name" value="{{ $_GET['role'] ?? '' }}">

                                <select class="form-control @error('role') is-invalid @enderror" name="role" id="role" required>
                                    @if (isset($_GET['role']) && $_GET['role'] != 'bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi')
                                        <option value="">Select</option>
                                    @endif
                                    @foreach ($roles as $role)
                                        @php
                                            if (in_array($role->slug, ['champion', 'smambassador', 'sai_user', 'author', 'gmambassador', 'gram_panchayat', 'caadmin'])) {
                                                continue;
                                            }
                                        @endphp
                                        <option value="{{ $role->slug }}"
                                            @if(isset($_GET['role']) && base64_decode($_GET['role']) == $role->slug) selected @endif
                                            @if(old('role')==$role->slug) selected @endif>
                                            {{ Str::upper($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="role-error" class="error-message text-danger small"></span>
                                @error('role')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Name --}}
                        <div class="register-row">
                            <div class="register-row-lft">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required placeholder="Your Name/School/Organisation/Club">
                                <span id="name-error" class="error-message text-danger small"></span>
                                @error('name')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- UDISE / Organisation --}}
                        <div class="register-row">
                            <div class="register-row-lft">
                                <div id="udise_row" style="display:none;">
                                    <input id="fi_udise" type="text" class="form-control @error('udise') is-invalid @enderror"
                                        name="udise" value="{{ old('udise') }}" placeholder="U-Dise Number">
                                    <span class="error-message text-danger small"></span>
                                    @error('udise')
                                        <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <input id="fi_orgname" type="text" class="form-control" name="orgname" style="display:none;" placeholder="Organisation Name">
                                <span class="error-message text-danger small"></span>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="register-row e-mob-fx">
                            <div class="register-row-lft">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required placeholder="Email">
                                <span id="email-error" class="error-message text-danger small"></span>
                                @error('email')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
        
                                <span id="duplicate_email_error" style="display:none; color:red;">Email already exists</span>
                            </div>
                            <div class="register-row-rt">
                                <span id="verify_button_hide">
                                    <button type="button" class="btn btn-info" style="min-width: 120px;">
                                        <a class="email_verify" style="color:#fff;"> Verify email </a>
                                    </button>
                                </span>
                                <span id="verifyed_button_show" class="btn btn-info" style="background-color:#14ae5c; color:#fff; min-width: 120px; display:none;">
                                    Email verified <i class="fa fa-check" style="font-size:12px"></i>
                                </span>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="register-row e-mob-fx">
                            <div class="register-row-lft">
                                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone') ?? '' }}" required placeholder="Mobile">
                                <span id="phone-error" class="error-message text-danger small"></span>
                                @error('phone')
                                    <span  class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror

                                <span id="duplicate_phone_error" style="display:none; color:red;">Phone already exists</span>
                            </div>
                            <div class="register-row-rt">
                                <span id="verify_button_mobile_hide">
                                    <button type="button" class="btn btn-info" style="min-width: 120px;">
                                        <a class="mobile_verify" style="color:#fff;">Verify mobile</a>
                                    </button>
                                </span>
                                <span id="verifyed_mobile_button_show" class="btn btn-info" style="background-color:#14ae5c; color:#fff; min-width: 120px; display:none;">
                                    Mobile verified <i class="fa fa-check" style="font-size:12px"></i>
                                </span>
                            </div>
                        </div>

                        {{-- State / District --}}
                        <div class="register-row">
                            <div class="register-row-lft">
                                <select id="state" name="state" class="form-control @error('state') is-invalid @enderror">
                                    <option value="">Select State</option>
                                    @foreach($state->sortBy('name') as $st)
                                        <option value="{{ $st->id }}" @if(old('state')==$st->id) selected @endif>{{ $st->name }}</option>
                                    @endforeach
                                </select>
                                <span id="state-error" class="error-message text-danger small"></span>
                                @error('state')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="register-row-rt">
                                <select id="district" name="district" class="form-control @error('district') is-invalid @enderror">
                                    <option value="">Select District</option>
                                    @foreach($districts->sortBy('name') as $st)
                                        <option value="{{ $st->id }}" @if(old('district')==$st->id) selected @endif>{{ $st->name }}</option>
                                    @endforeach
                                </select>
                                <span id="district-error" class="error-message text-danger small"></span>
                                @error('district')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Block / City --}}
                        <div class="register-row">
                            <div class="register-row-lft">
                                <select id="block" name="block" class="form-control @error('block') is-invalid @enderror">
                                    <option value="">Select Block</option>
                                    @foreach($blocks->sortBy('name') as $st)
                                        <option value="{{ $st->id }}" @if(old('block')==$st->id) selected @endif>{{ ucwords(strtolower($st->name)) }}</option>
                                    @endforeach
                                </select>
                                <span id="block-error" class="error-message text-danger small"></span>
                                @error('block')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="register-row-rt">
                                <input id="fi_city" type="text" class="form-control @error('city') is-invalid @enderror"
                                    name="city" value="{{ old('city') }}" placeholder="City/Town/Village">
                                <span id="fi_city-error" class="error-message text-danger small"></span>
                                @error('city')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="register-row">
                            <div class="register-row-lft r_parent">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required placeholder="Password" oninput="validatePassword(this)">
                                <span id="password-error" class="error-message text-danger small"></span>
                                @error('password')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="register-row-rt r_parent">
                                <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" required placeholder="Confirm Password" oninput="validateConfirmPassword(this)">
                                <span id="confirm-error" class="error-message text-danger small"></span>
                                @error('password_confirmation')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Captcha --}}
                        <div class="register-row">
                            <div class="register-row-lft">
                                <label for="captcha">Please enter the captcha text</label>
                                <div class="d-flex align-items-center">
                                    <div class="captchaimg">{!! captcha_img() !!}</div>
                                    <button type="button" class="btn btn-info ml-2" id="reload">↻</button>
                                </div>
                                <input type="text" id="captcha" name="captcha" class="form-control @error('captcha') is-invalid @enderror" placeholder="Captcha">
                                <span id="captcha-error" class="error-message text-danger small"></span>
                                @error('captcha')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="register-row-submit">
                            <input class="submit_button" type="submit" value="Sign up / Register here">
                        </div>
                    </div>
                </form>

                {{--  OTP modals remain same --}}
                @include('auth.partialsotpmodal.otp-modals')
            </div>
        </div>
    </div>
</section>

<script>
    const routes = {
        emailOtpCheck: "{{ route('emailotpcheck') }}",
        mobileOtpCheck: "{{ route('mobileotpcheck') }}",
        duplicateemailcheck: "{{ route('duplicateemailcheck') }}",
        duplicatemobilecheck: "{{ route('duplicatemobilecheck') }}",
        reloadCaptcha: "{{ route('reloadCaptcha')}}",
        getdistrict: "{{ route('getdistrict') }}",
        getblock: "{{ route('getblock') }}",
        coiregistration: "{{ route('coiregistration') }}",
        getroles: "{{ route('getroles') }}"
    };
    const csrfToken = "{{ csrf_token() }}";
</script>
<script src="{{ asset('resources/js/crypto/crypto-js.js')}}"></script>
<script src="{{ asset('resources/js/auth/role.js')}}"></script>
<script src="{{ asset('resources/js/auth/otp.js')}}"></script>
<script src="{{ asset('resources/js/auth/otpverify.js')}}"></script>
<script src="{{ asset('resources/js/auth/crypto.js')}}"></script>
<script src="{{ asset('resources/js/auth/submitform.js')}}"></script>
<script src="{{ asset('resources/js/auth/captcha.js')}}"></script>

@endsection