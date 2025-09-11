@extends('layouts.app')
@section('title', 'Register | Fit India')
@section('content')

<link rel="stylesheet" href="{{ asset('resources/css/auth/style.css') }}">
<section class="log_sec">

    <div class="container">
        <div id="divloader" class="loaderregister" style="display: none">
            {{-- <div id="divloader" class="loaderregister" style="display: block"> --}}
            <img style="margin-top:15%; width: 15%; height: 25%;" src="{{ url('/wp-content/uploads/2021/01/loader.gif') }}" />
        </div>
        <div class="row">
            <div class="col-12 signup_frm">

                <div class="">
                    <form id="fi-register" class="register-form" action="{{ route('register') }}" method="post" novalidate="novalidate">
                        @csrf
                        <p>Already have an account?
                            <a id="fi_signin" href="login">Login</a>
                        </p>
                        <div class="frm-details res_mobile">
                            <h1>{{ __('Register') }}</h1>
                            <label for="role">{{ __('Register As') }}</label>
                            <div class="register-row">
                                <div class="register-row-lft">
                                    <div class="role-row">
                                        @if (isset($_GET['role']))

                                        @if ($_GET['role'] == 'bmFtby1maXQtaW5kaWEteW91dGgtY2x1Yg==')

                                        <input type="radio" name="roletype" value="1" disabled> Ministries/Departments
                                        <input type="radio" name="roletype" value="2" disabled> Armed forces/CPF
                                        <input type="radio" name="roletype" value="0" checked=""> Other

                                        @elseif ($_GET['role'] == 'bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi')

                                        <input type="radio" name="roletype" value="1" disabled> Ministries/Departments
                                        <input type="radio" name="roletype" value="2" disabled> Armed forces/CPF
                                        <input type="radio" name="roletype" value="0" checked=""> Other

                                        @elseif ($_GET['role'] == 'Y3ljbG90aG9uLTIwMjQ=')

                                        {{-- <input type="radio" name="roletype"  value="1" disabled > Ministries/Departments
                                    <input type="radio" name="roletype" value="2"  disabled> Armed forces/CPF
                                    <input type="radio" name="roletype" value="0" checked=""> Other --}}

                                        @else

                                        <input type="radio" name="roletype" value="1" onclick="fi_rolechange(this.value)" checked=""> Ministries/Departments
                                        <input type="radio" name="roletype" value="2" onclick="fi_rolechange(this.value)"> Armed forces/CPF
                                        <input type="radio" name="roletype" value="0" onclick="fi_rolechange(this.value)"> Other

                                        @endif
                                        @else
                                        <input type="radio" name="roletype" value="1" onclick="fi_rolechange(this.value)" checked=""> Ministries/Departments
                                        <input type="radio" name="roletype" value="2" onclick="fi_rolechange(this.value)"> Armed forces/CPF
                                        <input type="radio" name="roletype" value="0" onclick="fi_rolechange(this.value)"> Other
                                        @endif


                                        {{-- <input type="radio" name="roletype" value="0" {{ (request()->is('role')) }} onclick="fi_rolechange(this.value)"> Other --}}
                                    </div>

                                    <input type="hidden" name="role_name" id="role_name" value="{{ $_GET['role'] ?? '' }}">
                                    <select class="form-control @error('role') is-invalid @enderror" name="role" id="role" required autocomplete="role" autofocus>
                                        @if (isset($_GET['role']))
                                        @if ($_GET['role'] != 'bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi')
                                        <option value="">{{'Select'}}</option>
                                        @endif
                                        @endif
                                        @foreach ($roles as $role)
                                        <?php if (in_array($role->slug, array('champion', 'smambassador', 'sai_user', 'author', 'gmambassador', 'gram_panchayat', 'caadmin'))) {
                                            continue;
                                        } ?>

                                        <option <?php if (isset($_GET['role'])) {
                                                    if (base64_decode($_GET['role']) ==  $role->slug) {
                                                        echo "selected='selected'";
                                                    }
                                                } ?> value="{{ $role->slug }}" @if(old('role')==$role->slug) {{ 'selected' }} @endif >{{ Str::upper($role->name)}}</option>

                                        @endforeach
                                    </select>
                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="register-row-rt">
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div id="udisenumrow" class="register-row">
                                <div class="register-row-lft">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Your Name/School Name/Organisation Name/Club Name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="register-row-rt">
                                    <div id="udise_row" style="display:none;">
                                        <input id="fi_udise" type="text" class="form-control @error('udise') is-invalid @enderror" name="udise" value="{{ old('udise') }}" required autocomplete="U-Dise Number" placeholder="U-Dise Number">
                                        @error('udise')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <!--<input id="fi_udise" type="number" class="required" name="udise" min="1" placeholder="U-Dise Number" aria-required="true">-->
                                    </div>
                                    <input id="fi_orgname" type="text" class="required" name="orgname" style="display:none;" placeholder="Organisation Name" aria-required="true">
                                </div>
                            </div>
                            <div style="clear:both"></div>


                            {{-- <div class="register-row" style="align-items: center">  --}}
                            <div class="register-row e-mob-fx">
                                <div class="register-row-lft">

                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <span id="email_error" style="display:none; color:red;">
                                        Please enter a valid email address
                                    </span>
                                    <span id="duplicate_email_error" style="display:none; color:red;">
                                        Email already exists
                                    </span>
                                </div>
                                <div class="register-row-rt">
                                    <span id="verify_button_hide" display:block;>
                                        <button type="button" class="btn btn-info" style="min-width: 120px;">
                                            <a class="email_verify" style="color:#fff;"> Verify email </a>
                                        </button>
                                    </span>
                                    <span id="verifyed_button_show" class="btn btn-info" style="background-color:#14ae5c; color:#fff; min-width: 120px; display:none;">
                                        Email verified
                                        <i class="fa fa-check" style="font-size:12px"></i>
                                    </span>
                                    {{-- cursor: pointer; --}}
                                    {{-- <div><a href="url">link text</a></div> --}}
                                    {{-- <button type="button">Click Me!</button> --}}
                                    {{-- <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="Mobile">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror --}}
                                </div>
                            </div>
                            <div style="clear:both"></div>

                            {{-- <div class="register-row" style="align-items: center">  --}}
                            <div class="register-row e-mob-fx">
                                <div class="register-row-lft">
                                    <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? "" }}" required autocomplete="phone" min="0" max="9999999999" placeholder="Mobile">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <span id="phone_error" style="display:none; color:red;">
                                        Please enter a valid mobile number
                                    </span>
                                    <span id="duplicate_phone_error" style="display:none; color:red;">
                                        Phone already exists
                                    </span>


                                </div>
                                <div class="register-row-rt">
                                    <span id="verify_button_mobile_hide" display:block;>
                                        <button type="button" class="btn btn-info" display:block; style="min-width: 120px;">
                                            <a class="mobile_verify" style="color:#fff;">Verify mobile</a>
                                        </button>
                                    </span>
                                    <span id="verifyed_mobile_button_show" class="btn btn-info" style="background-color:#14ae5c; color:#fff; min-width: 120px; display:none;">
                                        Mobile verified
                                        <i class="fa fa-check" style="font-size:12px"></i>
                                    </span>
                                    {{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror --}}

                                </div>
                            </div>
                            <div style="clear:both"></div>


                            <div class="register-row">
                                <div class="register-row-lft">
                                    <select id="state" name="state" class="form-control @error('state') is-invalid @enderror" aria-required="true">
                                        <option value="">Select State</option>
                                        @foreach($state->sortBy('name') as $st)
                                        @if($st->name)
                                        <option value="{{ $st->id }}" @if(!empty(old('state')) && old('state')==$st->id) {{ 'selected' }} @endif >
                                            {{ $st->name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror


                                </div>
                                <div class="register-row-rt">
                                    <select id="district" name="district" class="form-control @error('district') is-invalid @enderror" aria-required="true">
                                        <option value="">Select district</option>
                                        @foreach($districts->sortBy('name') as $st)
                                        @if($st->name)
                                        <option value="{{ $st->id }}" @if(!empty(old('district')) && old('district')==$st->id) {{ 'selected' }} @endif >
                                            {{ $st->name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="register-row">
                                <div class="register-row-lft">
                                    <select id="block" name="block" class="form-control @error('block') is-invalid @enderror" aria-required="true">
                                        <option value="">Select block</option>
                                        @foreach($blocks->sortBy('name') as $st)
                                        @if($st->name)
                                        <option value="{{ $st->id }}" @if(!empty(old('block')) && old('block')==$st->id) {{ 'selected' }} @endif >
                                            {{ ucwords(strtolower($st->name)) }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @error('block')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="register-row-rt">
                                    <input id="fi_city" type="text" class="form-control required  @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" placeholder="City/Town/Village" aria-required="true">
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="register-row">
                                <div class="register-row-lft r_parent">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" value="{{ old('password') }}" required autocomplete="new-password" placeholder="Password" oninput="validatePassword(this)">
                                    <span id="password-error" class="text-danger small"></span>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password r_child">
                                </div>
                                <div class="register-row-rt r_parent">
                                    <input id="password-confirm" type="password" class="form-control  @error('password') is-invalid @enderror" value="{{ old('password_confirmation') }}" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" oninput="validateConfirmPassword(this)">
                                    <span id="confirm-error" class="text-danger small"></span>
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password r_child">
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="register-row">
                                <div class="register-row-lft">
                                    <div class="um-field" id="rcapcha-main-cont">
                                        <label for="captcha">Please enter the captcha text</label><br>
                                        <div style="float:left; width:115px; margin: 6px 0;" id="rcaptcha-cont">
                                            <div class="captchaimg">
                                                <span>{!! captcha_img() !!}</span>
                                            </div>
                                        </div>
                                        <div style="float:left; margin: 6px 20px 6px 10px; cursor: pointer;">
                                            <button type="button" class="btn btn-info" class="reload" id="reload">
                                                ↻
                                            </button>
                                        </div>

                                        <div style="left" class="cap_width_login">
                                            <!-- <input type="text" id="captcha" name="captcha" class="form-control @error('captcha') is-invalid @enderror" required  placeholder="Captcha"> -->
                                            <input type="text" id="captcha" name="captcha" class="form-control @error('captcha') is-invalid @enderror" aria-required="true" placeholder="Captcha">
                                            @error('captcha')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div style="clear:both;"></div>
                                    </div>
                                </div>
                            </div>

                            <div style="clear:both"></div>

                            <div class="register-row-submit">
                                <!-- <input class="submit_button" type="submit" value="SIGN UP"> -->
                                <input class="submit_button" type="submit" value="Sign up / Register here">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content mheight-modal">
                            <div class="modal-header">
                                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> --}}
                            </div>
                            <div class="modal-body" id="mediumBody">
                                <div class="row justify-content-center">
                                    <h2 class="text-center">Verification code</h2>
                                </div>
                                <div class="row mt-2 justify-content-center">
                                    <p class="w-100 text-center">We will send you an password via registered</p>
                                    <h6 class="mt-1 w-100 text-center" style="font-weight: 700">Email</h6>
                                </div>
                                <div class="row justify-content-center mt-2">
                                    <div class="col-6">
                                        <input type="number" class="form-control" id="email_otp" name="email_otp" size="100" maxlength="6" min="1">
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-2">
                                    <span class="email_otp_error" style="display:none; color:red;">
                                        Please enter a valid OTP
                                    </span>
                                </div>
                                <div class="row justify-content-center mt-2">
                                    Time left &nbsp; <span id="timer"> </span>
                                </div>
                                <div class="row justify-content-center mt-2">
                                    <button type="button" class="btn btn-info mt-2" style="background-color: #02349a;">
                                        <a id="email_otp_verify">OTP verify</a>
                                    </button>
                                </div>
                                <div class="row justify-content-center mt-2">
                                    <p class="text-center mt-2">Didn't receive the verification OTP?
                                        <br />
                                        <br />
                                        <span id="resend_otp" style="display:none;">
                                            <button type="button" class="btn btn-info">
                                                {{-- <button type="button" class="btn btn-info mt-2"  style="background-color: #02349a;"> --}}
                                                <a class="email_verify" style="color:#fff;">Resend OTP</a>
                                            </button>
                                        </span>
                                    </p>
                                </div>
                                {{-- <div>
                            <input type="number" id="email_otp" name="email_otp" size="50" maxlength="6" min="1">
                            <span id="email_otp_error" style="display:none; color:red;">
                                Please Enter A Valid OTP
                            </span>
                            <button type="button" class="btn btn-info">
                                <a id="email_otp_verify">otp verify</a>
                            </button>
                            <div>Time left = <span id="timer"></span></div>
                            <span id="resend_otp" style="display:none;">
                                <button type="button" class="btn btn-info">
                                    <a id="resendotp">Resend OTP</a>
                                </button>
                            </span>
                        </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="mobileModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content mheight-modal">
                            <div class="modal-header">
                                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> --}}
                            </div>
                            <div class="modal-body" id="mediumBody">
                                <div class="row justify-content-center">
                                    <h2 class="text-center">Verification code</h2>
                                </div>
                                <div class="row mt-2 justify-content-center">
                                    <p class="w-100 text-center">We will send you an password via registered</p>
                                    <h6 class="mt-1 w-100 text-center" style="font-weight: 700">Mobile number</h6>
                                </div>
                                <div class="row justify-content-center mt-2">
                                    <div class="col-6">
                                        <input type="number" class="form-control" id="phone_otp" name="phone_otp" size="100" maxlength="6" min="1">
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-2">
                                    <span class="mobile_otp_error" style="display:none; color:red;">
                                        Please enter a valid OTP
                                    </span>
                                </div>
                                <div class="row justify-content-center mt-2">
                                    Time left &nbsp; <span id="mobile_timer"> </span>
                                </div>
                                <div class="row justify-content-center mt-2">
                                    <button type="button" class="btn btn-info mt-2" style="background-color: #02349a;">
                                        <a id="mobile_otp_verify">OTP verify</a>
                                    </button>
                                </div>
                                <div class="row justify-content-center mt-2">
                                    <p class="text-center mt-2">Didn't receive the verification OTP?
                                        <br />
                                        <br />
                                        <span id="mobile_otp_resend" style="display:none;">
                                            <button type="button" class="btn btn-info">
                                                <a class="mobile_verify" style="color:#fff;">Resend OTP</a>
                                            </button>
                                        </span>
                                    </p>
                                </div>
                                {{-- <div>
                            Mobile
                            <input type="number" id="phone_otp" name="phone_otp" size="100" maxlength="6" min="1">
                            <span id="mobile_otp_error" style="display:none; color:red;">
                                Please Enter A Valid OTP
                            </span>
                            <button type="button" class="btn btn-info">
                                <a id="mobile_otp_verify">otp verify</a>
                            </button>
                        </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- OTP Limit Exceed Modal -->
                <div class="modal fade" id="otpLimitexceed" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content otpheight-modal">
                            <div class="modal-headerotp bg-danger text-white">
                                <h5 class="modal-title" id="otpLimitLabel">OTP Limit Exceeded</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="mediumBody">
                                <div class="row mt-2 justify-content-center">
                                    <p class="w-100 text-center">You have reached your daily OTP request limit (10).</p>
                                    <p class="w-100 text-center">Please try again tomorrow.</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="otpfooter" class="btn btn-secondary" data-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                </div>



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
        coiregistration: "{{ route('coiregistration') }}"
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