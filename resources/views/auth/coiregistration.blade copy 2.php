@extends('layouts.app')
@section('title', 'Register | Fit India')
@section('content')

<link href="{{ asset('resources/css/select2/select2.min.css') }}" rel="stylesheet" media="all">
<link rel="stylesheet" href="{{ asset('resources/css/auth/coistyle.css') }}">
<section class="log_sec">
    <div class="container">
        <div id="divloader" class="loaderregister" style="display: none">
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
                                        <input type="hidden" class="mobile_verified_status" id="mobile_verified_status" value="0">
                                        {{-- <input type="radio" name="roletype"  value="1" onclick="fi_rolechange(this.value)" checked=""> Ministries/Departments
                            <input type="radio" name="roletype" value="2" onclick="fi_rolechange(this.value)"> Armed forces/CPF
                            <input type="radio" name="roletype" value="0" onclick="fi_rolechange(this.value)"> Other --}}
                                        {{-- <input type="radio" name="roletype" value="0" {{ (request()->is('role')) }} onclick="fi_rolechange(this.value)"> Other --}}
                                    </div>
                                    @if (isset($_GET['role']))

                                    @if($_GET['role'] == 'bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi' || $_GET['role'] == 'bmFtby1maXQtaW5kaWEteW91dGgtY2x1Yg==')
                                    <select class="form-control cyclothonrolew @error('cyclothonrole') is-invalid @enderror" name="cyclothonrole" id="cyclothonrole" required autocomplete="cyclothonrole" autofocus>
                                        <option value="club" selected>Club</option>
                                    </select>
                                    @endif
                                    <span id="cyclothonrole-error" class="error-message text-danger small"></span>
                                    @error('cyclothonrole')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    @else

                                    <select class="form-control cyclothonrolew @error('cyclothonrole') is-invalid @enderror" name="cyclothonrole" id="cyclothonrole" required autocomplete="cyclothonrole" autofocus>
                                        <option value="">Please select Individual/Organization/Club</option>
                                        <option value="individual">Individual</option>
                                        <option value="organization">Organization</option>
                                        <option value="club">Club</option>
                                    </select>
                                    <span id="cyclothonrole-error" class="error-message text-danger small"></span>
                                    @error('cyclothonrole')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    @endif

                                    <input type="hidden" name="role_name" id="role_name" value="{{ $_GET['role'] ?? '' }}">
                                    <select class="form-control @error('role') is-invalid @enderror" name="role" id="role" required autocomplete="role" autofocus>
                                        @if (isset($_GET['role']))
                                        @if ($_GET['role'] != 'bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi')
                                        {{-- <option value="">{{'Select'}}</option> --}}
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
                                    <span id="role_name-error" class="error-message text-danger small"></span>
                                    @error('role')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="register-row-rt">
                                </div>

                            </div>
                            <div style="clear:both"></div>
                            @if (isset($role_name))
                            @if($role_name == 'cyclothon-2024')
                            <div class="register-row my-search-select-cls" id="user_join_club_id_show" style="display:block;">
                                <div class="register-row">
                                    <div class="register-row-lft">
                                        <select class="form-control @error('user_join_club_id') is-invalid @enderror  select2" name="user_join_club_id" id="user_join_club_id" required autocomplete="user_join_club_id" autofocus>
                                            <option value="">Do you belong to any of the NAMO cycling Clubs?</option>
                                            @if(isset($club_name_with_id))
                                            @if(count($club_name_with_id) > 0)
                                            @foreach ($club_name_with_id as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                            @endif
                                            @endif
                                        </select>
                                        <br />
                                        <br />


                                    </div>

                                    <div class="register-row-rt">
                                        <div id="udise_row" style="display:none;">
                                            <input id="fi_udise" type="text" class="form-control @error('udise') is-invalid @enderror" name="udise" value="{{ old('udise') }}" required autocomplete="U-Dise Number" placeholder="U-Dise Number">
                                            @error('udise')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <input id="fi_orgname" type="text" class="required" name="orgname" style="display:none;" placeholder="Organisation Name" aria-required="true">
                                    </div>
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            @endif
                            @endif

                            <div id="udisenumrow" class="register-row">
                                <div class="register-row-lft">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ $club_name ?? 'Name' }}">

                                    <span id="name-error" class="error-message text-danger small"></span>
                                    @error('name')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="register-row-rt">
                                    @if (isset($_GET['role']))
                                    @if($_GET['role'] == 'bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi' || $_GET['role'] == 'bmFtby1maXQtaW5kaWEteW91dGgtY2x1Yg==')

                                    <input id="participant_number" type="number" class="form-control @error('participant_number') is-invalid @enderror" name="participant_number" value="{{ old('participant_number') }}" required autocomplete="Participant Number" placeholder="{{ $participant ?? 'Participant Number' }}" min="0">

                                    <span id="participant_number-error" class="error-message text-danger small"></span>
                                    @error('participant_number')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    @endif
                                    @else
                                    <div id="participant_number_row" style="display:none;">
                                        <input id="participant_number" type="number" class="form-control @error('participant_number') is-invalid @enderror" name="participant_number" value="{{ old('participant_number') }}" required autocomplete="Participant Number" placeholder="Participant Number" min="0">

                                        <span id="participant_number-error" class="error-message text-danger small"></span>
                                        @error('participant_number')
                                        <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <input id="fi_orgname" type="text" class="required" name="orgname" style="display:none;" placeholder="Organisation Name" aria-required="true">
                                    @endif
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="register-row e-mob-fx">
                                <div class="register-row-lft">

                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Email">

                                    <span id="email-error" class="error-message text-danger small"></span>
                                    @error('email')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror

                                    <span id="duplicate_email_error" style="display:none; color:red;">Email already exists</span>
                                </div>
                                <div class="register-row-rt">
                                    <span id="verifyed_button_show" class="btn btn-info" style="background-color:#14ae5c; color:#fff; min-width: 120px; display:none;">
                                        Email verified
                                        <i class="fa fa-check" style="font-size:12px"></i>
                                    </span>
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="register-row e-mob-fx">
                                <div class="register-row-lft">
                                    <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? "" }}" required autocomplete="phone" min="0" max="9999999999" placeholder="Mobile">
                                    <span id="phone-error" class="error-message text-danger small"></span>
                                    @error('phone')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror

                                    <span id="duplicate_phone_error" style="display:none; color:red;">Phone already exists</span>
                                    <span id="verified_phone_error" style="display:none; color:red; font-size:12px;">
                                        Please verifiy your mobile number
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

                                </div>
                            </div>
                            <div style="clear:both"></div>
                            @if (isset($_GET['role']))
                            @if($_GET['role'] == 'bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi' || $_GET['role'] == 'bmFtby1maXQtaW5kaWEteW91dGgtY2x1Yg==')
                            <div id="udisenumrow" class="register-row">
                                <div class="register-row-lft">
                                    <input id="address_line_one" type="text" class="form-control @error('address_line_one') is-invalid @enderror" name="address_line_one" value="{{ old('address_line_one') }}" required autocomplete="address_line_one" autofocus placeholder="Address Line 1">

                                    <span id="address_line_one-error" class="error-message text-danger small"></span>
                                    @error('address_line_one')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="register-row-rt">
                                    <input id="address_line_two" type="text" class="form-control @error('address_line_two') is-invalid @enderror" name="address_line_two" value="{{ old('address_line_two') }}" required autocomplete="address_line_two" placeholder="Address Line 2">
                                    <span id="address_line_two-error" class="error-message text-danger small"></span>
                                    @error('address_line_two')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            @endif
                            @endif
                            <div class="register-row e-mob-fx">
                                <div class="register-row-lft">
                                    <input id="pincode" type="number" class="form-control @error('pincode') is-invalid @enderror pincode_value" name="pincode" value="{{ old('phone') ?? "" }}" required autocomplete="pincode" min="0" max="999999" placeholder="Pin Code">

                                    <span id="pincode-error" class="error-message text-danger small"></span>
                                    @error('pincode')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="register-row-rt" id="tshirtsizeshow" style="display: none">
                                    <select id="tshirtsize" name="tshirtsize" class="form-control @error('tshirtsize') is-invalid @enderror" aria-required="true">
                                        <option value="">T-Shirt size</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                    </select>
                                    @error('tshirtsize')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <span id="tshirtsizeerror" style="display:none; color:red; font-size:12px;">
                                        Shirt size is required
                                    </span>
                                </div>

                            </div>
                            <div style="clear:both"></div>
                            <div class="register-row my-search-select-cls">
                                <div class="register-row-lft">
                                    <select id="state" name="state" class="form-control @error('state') is-invalid @enderror select2" aria-required="true">
                                        <option value="">Select State</option>
                                        @foreach($state->sortBy('name') as $st)
                                        @if($st->name)
                                        <option value="{{ $st->id }}" @if(!empty(old('state')) && old('state')==$st->id) {{ 'selected' }} @endif >
                                            {{ $st->name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <span id="state-error" class="error-message text-danger small"></span>
                                    @error('state')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror

                                </div>
                                <br />
                                <div style="clear:both"></div>
                                <div class="register-row-rt">
                                    <select id="district" name="district" class="form-control @error('district') is-invalid @enderror" aria-required="true">
                                        <option value="">Select district</option>
                                        <?php
                                        if (!empty($districts)) {
                                        ?>
                                            @foreach($districts->sortBy('name') as $st)
                                            @if($st->name)
                                            <option value="{{ $st->id }}" @if(!empty(old('district')) && old('district')==$st->id) {{ 'selected' }} @endif >
                                                {{ $st->name }}
                                            </option>
                                            @endif
                                            @endforeach
                                        <?php
                                        }
                                        ?>

                                    </select>
                                    <span id="district-error" class="error-message text-danger small"></span>
                                    @error('district')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="register-row">
                                <div class="register-row-lft">
                                    <select id="block" name="block" class="form-control @error('block') is-invalid @enderror" aria-required="true">
                                        <option value="">Select block</option>
                                        <?php
                                        if (!empty($districts)) {
                                        ?>
                                            @foreach($blocks->sortBy('name') as $st)
                                            @if($st->name)
                                            <option value="{{ $st->id }}" @if(!empty(old('block')) && old('block')==$st->id) {{ 'selected' }} @endif >
                                                {{ ucwords(strtolower($st->name)) }}
                                            </option>
                                            @endif
                                            @endforeach
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span id="block-error" class="error-message text-danger small"></span>
                                    @error('block')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="register-row-rt">

                                    <div id="city_show"></div>
                                    <div id="city_show_hide" style="display:block;">
                                        <input id="fi_city" type="text" class="form-control required  @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" placeholder="City/Town/Village" aria-required="true" onkeydown="return /[a-z, ]/i.test(event.key)"
                                            onblur="if (this.value == '') {this.value = '';}"
                                            onfocus="if (this.value == '') {this.value = '';}">
                                        <span id="fi_city-error" class="error-message text-danger small"></span>
                                        @error('city')
                                        <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div style="clear:both"></div>

                            <div class="register-row">
                                <div class="register-row-lft r_parent">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" value="{{ old('password') }}" required autocomplete="new-password" placeholder="Password" oninput="validatePassword(this)">
                                    <span id="password-error" class="error-message text-danger small"></span>
                                    @error('password')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password r_child" onclick="password_show()"></span>
                                </div>
                                <div class="register-row-rt r_parent">

                                    <input id="password-confirm" type="password" class="form-control  @error('password') is-invalid @enderror" value="{{ old('password_confirmation') }}" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" oninput="validateConfirmPassword(this)">
                                    <span id="confirm-error" class="error-message text-danger small"></span>
                                    @error('password_confirmation')
                                    <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div id="cycle_display" style="display:block;">
                                <div class="register-row">
                                    <div class="register-row-lft r_parent">
                                        <select id="cycle" name="cycle" class="form-control @error('block') is-invalid @enderror" aria-required="true">
                                            {{-- <option value="">Need a cycle for your ride</option> --}}
                                            <option value="no" selected>Do you require a cycle? - No</option>
                                            <option value="yes">Do you require a cycle? - Yes</option>
                                        </select>
                                        @error('cycle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <span id="blankcycle" style="display:none; color:red; font-size:12px;">
                                            Please select cycle type
                                        </span>
                                        {{-- <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password r_child" onclick="password_show()"></span> --}}




                                    </div>
                                    <div class="register-row-rt r_parent tooltipcycle">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336l24 0 0-64-24 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l48 0c13.3 0 24 10.7 24 24l0 88 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-80 0c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg> --}}
                                        <i style="font-size:24px" class="fa fa-info-circle fa-circle-info my-tool-cycle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="- ⁠Cycles are available in limited numbers and on first come first served basis"></i>
                                        {{-- <span class="fa-solid fa-circle-info my-tool-cycle " data-toggle="tooltip" data-placement="top" title="Tooltip on top"></span> --}}
                                        {{-- <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                Tooltip on top
                              </button> --}}
                                    </div>
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
                                            <input type="text" id="captcha" name="captcha" class="form-control @error('captcha') is-invalid @enderror" required placeholder="Captcha">
                                            <span id="captcha-error" class="error-message text-danger small"></span>
                                            @error('captcha')
                                            <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        <div style="clear:both;"></div>
                                    </div>
                                </div>
                            </div>

                            <div style="clear:both"></div>

                            <div class="register-row-submit">
                                <input id="btnSubmit" class="submit_button" type="submit" value="Register here">
                            </div>
                        </div>
                    </form>
                </div>
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
       getroles: "{{ route('getroles') }}"
    };
    const csrfToken = "{{ csrf_token() }}";
</script>
<script src="{{ asset('resources/js/crypto/crypto-js.js')}}"></script>
<script src="{{ asset('resources/js/auth/otp.js')}}"></script>
<script src="{{ asset('resources/js/auth/otpverify.js')}}"></script>
<script src="{{ asset('resources/js/auth/role.js')}}"></script>
<script src="{{ asset('resources/js/auth/crypto.js')}}"></script>
<script src="{{ asset('resources/js/auth/coisubmitform.js')}}"></script>
<script src="{{ asset('resources/js/auth/captcha.js')}}"></script>

@endsection