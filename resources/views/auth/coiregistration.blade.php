
@extends('layouts.app')
@section('title', 'Register | Fit India')
@section('content')
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
<link href="{{ asset('resources/css/select2/select2.min.css') }}" rel="stylesheet" media="all">
<style>
    .register-row-lft{
        width: 64% !important;
    }
    .loaderregister {
        position: relative;
        z-index: 100000000;
        font-family: arial;
        width: 100%;
        height: 100%;
        margin:auto;
        position:fixed;
        bottom:0;
        left:0;
        top:0;
        right: 0;
        text-align: center;
        color: #000;
        opacity: 0.6;
        /* background: #fff; */
        background: #000;
        border-radius: 0;
        /* position: absolute;
        z-index: 10;
        font-family: arial;
        width: 100%;
        height: 100%;
        margin:auto;
        position:fixed;
        bottom:0;
        left:0;
        top:50%;
        right: 0;
        text-align: center;
        color: #000;
        opacity: 0.4;
        background: #fff;
        border-radius: 10px;         */
    }
    .e-mob-fx{
        align-items: center;
    }
    @media screen and (max-width:576px){
        .e-mob-fx{
            align-items: flex-start;
        }
    }
    .mheight-modal{
        min-height: 402px;
    }
    .tooltipcycle{
        display: flex !important;
        align-items: center;
    }
    .my-tool-cycle{
        cursor: pointer;
    }
    .my-search-select-cls .select2-selection__rendered{
        margin-top: 4px;
        /* display: block; */
    width: 100%;
    /* height: calc(1.5em + .75rem + 2px); */
    padding: .375rem .75rem;
    /* font-size: 1rem; */
    font-weight: 400;
    /* line-height: 1.5; */
    /* color: #495057; */
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
    .my-search-select-cls .select2-selection--single{
        border: 0px !important;
    }
    .my-search-select-cls .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 40px;
    position: absolute;
    top: 4px;
    right: 1px;
    width: 20px;
}
</style>
<section class="log_sec">
{{-- {{ dd("cyclothonregister") }} --}}
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
                            <input type="hidden" class="mobile_verified_status" id="mobile_verified_status" value="0">
                            {{-- <input type="radio" name="roletype"  value="1" onclick="fi_rolechange(this.value)" checked=""> Ministries/Departments
                            <input type="radio" name="roletype" value="2" onclick="fi_rolechange(this.value)"> Armed forces/CPF
                            <input type="radio" name="roletype" value="0" onclick="fi_rolechange(this.value)"> Other --}}
                            {{-- <input type="radio" name="roletype" value="0" {{ (request()->is('role')) }}  onclick="fi_rolechange(this.value)"> Other    --}}
                        </div>
                        @if (isset($_GET['role']))

                            @if($_GET['role'] == 'bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi' || $_GET['role'] == 'bmFtby1maXQtaW5kaWEteW91dGgtY2x1Yg==')
                                <select class="form-control cyclothonrolew @error('cyclothonrole') is-invalid @enderror" name="cyclothonrole" id="cyclothonrole" required autocomplete="cyclothonrole" autofocus>
                                    <option value="club" selected>Club</option>
                                </select>
                            @endif
                            @error('cyclothonrole')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <span id="blankcyclothonrole" style="display:none; color:red; font-size:12px;">
                                Role is required
                            </span>
                            <div class="register-row-rt">
                            </div>
                        @else

                            <select class="form-control cyclothonrolew @error('cyclothonrole') is-invalid @enderror" name="cyclothonrole" id="cyclothonrole" required autocomplete="cyclothonrole" autofocus>
                                <option value="">Please select Individual/Organization/Club</option>
                                <option value="individual">Individual</option>
                                <option value="organization">Organization</option>
                                <option value="club">Club</option>
                            </select>
                            @error('cyclothonrole')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <span id="blankcyclothonrole" style="display:none; color:red; font-size:12px;">
                                Role is required
                            </span>
                            <div class="register-row-rt">
                            </div>
                        @endif

                         <input type="hidden" name="role_name" id="role_name" value="{{ $_GET['role'] ?? '' }}">
                          <select class="form-control @error('role') is-invalid @enderror" name="role" id="role" required autocomplete="role" autofocus>
                            @if (isset($_GET['role']))
                                @if ($_GET['role'] != 'bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi')
							        {{-- <option value="">{{'Select'}}</option> --}}
                                @endif
                            @endif
							@foreach ($roles as $role)
							<?php if(in_array($role->slug, array( 'champion' , 'smambassador', 'sai_user', 'author', 'gmambassador','gram_panchayat','caadmin') )){ continue; } ?>

                            <option <?php if(isset($_GET['role'])){ if(base64_decode($_GET['role']) ==  $role->slug){ echo "selected='selected'";}} ?> value="{{ $role->slug }}"  @if(old('role') == $role->slug) {{ 'selected' }} @endif >{{ Str::upper($role->name)}}</option>

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
                    @if (isset($role_name))
                        @if($role_name == 'cyclothon-2024')
                            <div class="register-row my-search-select-cls" id="user_join_club_id_show" style="display:block;">
                            {{-- <div id="user_join_club_id_show" style="display:none;"> --}}
                                <div class="register-row" >
                                            <div class="register-row-lft">
                                                {{-- {{ dd($club_name_with_id) }} --}}
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
                                                <br/>
                                                <br/>
                                                {{-- @error('cyclothonrole')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <span id="blankcyclothonrole" style="display:none; color:red; font-size:12px;">
                                                    Role is required
                                                </span> --}}

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
                            </div>
                            <div style="clear:both"></div>
                        @endif
                    @endif

                <div id="udisenumrow" class="register-row">
                    <div class="register-row-lft">
					 <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ $club_name ?? 'Name' }}">
						@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
                        <span id="blankname" style="display:none; color:red; font-size:12px;">
                            Name is required
                        </span>

                    </div>
                    <div class="register-row-rt">
                        @if (isset($_GET['role']))
                            @if($_GET['role'] == 'bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi' || $_GET['role'] == 'bmFtby1maXQtaW5kaWEteW91dGgtY2x1Yg==')
                                {{-- <input id="participant_number" type="number" class="form-control @error('participant_number') is-invalid @enderror" name="participant_number" value="{{ old('participant_number') }}" required autocomplete="Participant Number" placeholder="Participant Number" min="0"> --}}
                                <input id="participant_number" type="number" class="form-control @error('participant_number') is-invalid @enderror" name="participant_number" value="{{ old('participant_number') }}" required autocomplete="Participant Number" placeholder="{{ $participant ?? 'Participant Number' }}" min="0">
                                @error('participant_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span id="blankparticipant" style="display:none; color:red; font-size:12px;">
                                    Participant number is required
                                </span>
                            @endif
                        @else
                            <div id="participant_number_row" style="display:none;">
                                <input id="participant_number" type="number" class="form-control @error('participant_number') is-invalid @enderror" name="participant_number" value="{{ old('participant_number') }}" required autocomplete="Participant Number" placeholder="Participant Number" min="0">
                                @error('participant_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span id="blankparticipant" style="display:none; color:red; font-size:12px;">
                                    Participant number is required
                                </span>
                                <!--<input id="fi_udise" type="number" class="required" name="udise" min="1" placeholder="U-Dise Number" aria-required="true">-->
                            </div>
                            <input id="fi_orgname" type="text" class="required" name="orgname" style="display:none;" placeholder="Organisation Name" aria-required="true">
                        @endif
                    </div>
                </div>
                <div style="clear:both"></div>

                {{-- <div class="register-row" style="align-items: center">  --}}
                <div class="register-row e-mob-fx" >
                    <div class="register-row-lft">

						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span id="email_error" style="display:none; color:red; font-size:12px;">
                                    Please enter a valid email address
                                </span>
                                <span id="duplicate_email_error" style="display:none; color:red; font-size:12px;">
                                    Email already exists
                                </span>
                    </div>
                    <div class="register-row-rt">
                        {{-- <span id="verify_button_hide" display:block;>
                            <button type="button" class="btn btn-info" style="min-width: 120px;">
                                <a class="email_verify" style="color:#fff;"> Verify email </a>
                            </button>
                        </span> --}}
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
                <div class="register-row e-mob-fx" >
                    <div class="register-row-lft">
                        <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? "" }}" required autocomplete="phone" min="0" max="9999999999" placeholder="Mobile">
							@error('phone')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
                            <span id="phone_error" style="display:none; color:red; font-size:12px;">
                                Please enter a valid mobile number
                            </span>
                            <span id="duplicate_phone_error" style="display:none; color:red; font-size:12px;">
                                Phone already exists
                            </span>
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
                        {{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}

                    </div>
                </div>
                <div style="clear:both"></div>
                @if (isset($_GET['role']))
                    @if($_GET['role'] == 'bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi' || $_GET['role'] == 'bmFtby1maXQtaW5kaWEteW91dGgtY2x1Yg==')
                        <div id="udisenumrow" class="register-row">
                            <div class="register-row-lft">
                            <input id="address_line_one" type="text" class="form-control @error('address_line_one') is-invalid @enderror" name="address_line_one" value="{{ old('address_line_one') }}" required autocomplete="address_line_one" autofocus placeholder="Address Line 1">
                                @error('address_line_one')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span id="blankaddress_line_one" style="display:none; color:red; font-size:12px;">
                                    Address Line 1 is required
                                </span>

                            </div>
                            <div class="register-row-rt">
                                        <input id="address_line_two" type="text" class="form-control @error('address_line_two') is-invalid @enderror" name="address_line_two" value="{{ old('address_line_two') }}" required autocomplete="address_line_two" placeholder="Address Line 2">
                                        @error('address_line_two')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span id="blankaddress_line_two" style="display:none; color:red; font-size:12px;">
                                            Address Line 2 number is required
                                        </span>
                            </div>
                        </div>
                        <div style="clear:both"></div>
                    @endif
                @endif
                <div class="register-row e-mob-fx" >
                    <div class="register-row-lft">
                        <input id="pincode" type="number" class="form-control @error('pincode') is-invalid @enderror pincode_value" name="pincode" value="{{ old('phone') ?? "" }}" required autocomplete="pincode" min="0" max="999999" placeholder="Pin Code">
							@error('pincode')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
                            <span id="pincode_error" style="display:none; color:red; font-size:12px;">
                                Please enter a valid pin code number
                            </span>
                    </div>
                    {{-- <div class="register-row-rt"> --}}
                        <div class="register-row-rt" id="tshirtsizeshow" style="display: none">
                                <select id="tshirtsize" name="tshirtsize" class="form-control @error('tshirtsize') is-invalid @enderror" aria-required="true" >
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
                        {{-- <span id="verifyed_mobile_button_show" class="btn btn-info" style="background-color:#14ae5c; color:#fff; min-width: 120px; display:none;">
                            Mobile verified
                            <i class="fa fa-check" style="font-size:12px"></i>
                        </span> --}}
                        {{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}

                    {{-- </div> --}}
                </div>
                <div style="clear:both"></div>
             <div class="register-row my-search-select-cls">
                    <div class="register-row-lft">
                        <select id="state" name="state" class="form-control @error('state') is-invalid @enderror select2" aria-required="true">
                            <option value="">Select State</option>
                            @foreach($state->sortBy('name') as $st)
                                @if($st->name)
                                    <option value="{{ $st->id }}"  @if(!empty(old('state')) && old('state') == $st->id) {{ 'selected' }} @endif >
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
                        <span id="blankstate" style="display: none; color: red; margin-top:15px; font-size:12px;">
                            State is required
                        </span>
						<?php
						/* <select id="state" name="state" class="form-control @error('state') is-invalid @enderror" aria-required="true">
                            <option value="">Select State</option>
                            @foreach($state as $st)
                                <option value="{{ $st->id }}"  @if(!empty(old('state')) && old('state') == $st->id) {{ 'selected' }} @endif >
								{{ $st->name }}
								</option>
                            @endforeach
                        </select>
						@error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror */ ?>
                    </div>
                    <br/>
                    <div style="clear:both"></div>
                    <div class="register-row-rt">
                        <select id="district" name="district" class="form-control @error('district') is-invalid @enderror" aria-required="true">
							<option value="">Select district</option>
                            <?php
                            if(!empty($districts)){
                            ?>
                                @foreach($districts->sortBy('name') as $st)
							    @if($st->name)
                                <option value="{{ $st->id }}"  @if(!empty(old('district')) && old('district') == $st->id) {{ 'selected' }} @endif >
								{{ $st->name }}
								</option>
								@endif
                            @endforeach
                            <?php
                            }
                            ?>

                        </select>
						@error('district')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
                        @enderror
                        <span id="blankdistrict" style="display:none; color:red; font-size:12px;">
                            District is required
                        </span>
                    </div>
                </div>
                <div style="clear:both"></div>
                <div class="register-row">
                    <div class="register-row-lft">
                        <select id="block" name="block" class="form-control @error('block') is-invalid @enderror" aria-required="true">
							<option value="">Select block</option>
                            <?php
                                if(!empty($districts)){
                            ?>
                                @foreach($blocks->sortBy('name') as $st)
                                @if($st->name)
                                    <option value="{{ $st->id }}"  @if(!empty(old('block')) && old('block') == $st->id) {{ 'selected' }} @endif >
                                    {{ ucwords(strtolower($st->name)) }}
                                    </option>
                                @endif
                                @endforeach
                            <?php
                            }
                            ?>
                        </select>
						@error('block')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
                        @enderror
                        <span id="blankblock" style="display:none; color:red; font-size:12px;">
                            Block is required
                        </span>
                    </div>

                    <div class="register-row-rt">

                        <div id="city_show"></div>
                        <div id="city_show_hide" style="display:block;">
                            <input id="fi_city" type="text" class="form-control required  @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" placeholder="City/Town/Village" aria-required="true" onkeydown="return /[a-z, ]/i.test(event.key)"
                            onblur="if (this.value == '') {this.value = '';}"
                            onfocus="if (this.value == '') {this.value = '';}">
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span id="blankfi_city_value" style="display:none; color:red; font-size:12px;">
                                        City/Town/Village is required
                                    </span>
                        </div>
					</div>
                </div>
                <div style="clear:both"></div>

                <div class="register-row">
                    <div class="register-row-lft r_parent">
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
						name="password" value="{{ old('password') }}" required autocomplete="new-password" placeholder="Password">
								@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span id="passwordmismatch" style="display:none; color:red; font-size:12px;">
                                    Password does not match.
                                </span>
                                <span id="blankpassword" style="display:none; color:red; font-size:12px;">
                                    Password is required
                                </span>
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password r_child" onclick="password_show()"></span>




                    </div>
                    <div class="register-row-rt r_parent">

						<input id="password-confirm" type="password" class="form-control  @error('password') is-invalid @enderror" value="{{ old('password_confirmation') }}" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
								@error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span id="blankconfirmpassword" style="display:none; color:red; font-size:12px;">
                                    Confirm password is required
                                </span>
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password r_child" onclick="confirm_password_show()"></span>
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
						<div style="float:left; margin: 6px 20px 6px 10px; cursor: pointer;" >
						  <button type="button" class="btn btn-info" class="reload" id="reload">
							↻
							</button>
						</div>

						<div style="left" class="cap_width_login">
							<input type="text" id="captcha" name="captcha" class="form-control @error('captcha') is-invalid @enderror" required  placeholder="Captcha">
							@error('captcha')
								<span class="invalid-feedback" role="alert" >
									<strong>{{ $message }}</strong>
								</span>
							@enderror
                            <span id="blankcaptcha" style="display:none; color:red; font-size:12px;">
                                Captcha is required
                            </span>
						</div>

						<div style="clear:both;"></div>
					</div>
                    </div>
                </div>

                <div style="clear:both"></div>
                {{-- <div class="register-row-submit">
                    @if (isset($listofcenter))
                        {{ $listofcenter ?? "" }}
                        <br/>
                        <b>
                            <a href="{{ url('resources/pdf/list-event-location-world-bicycle-day.pdf') }}" target="_blank">
                                Click here for list of centres
                            </a>
                        </b>
                    @endif
                </div> --}}

                <div class="register-row-submit">
                    <input id="btnSubmit" class="submit_button" type="submit" value="Register here">
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
                            <span class="email_otp_error" style="display:none; color:red; font-size:12px;">
                                Please enter a valid OTP
                            </span>
                        </div>
                        <div  class="row justify-content-center mt-2">
                                Time left &nbsp; <span id="timer"> </span>
                        </div>
                        <div class="row justify-content-center mt-2">
                            <button type="button" class="btn btn-info mt-2"  style="background-color: #02349a;">
                                <a id="email_otp_verify">OTP verify</a>
                            </button>
                        </div>
                        <div class="row justify-content-center mt-2">
                            <p class="text-center mt-2">Didn't receive the verification OTP?
                                <br/>
                                <br/>
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
        <div class="modal fade" id="mobileModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true" >
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
                            <span class="mobile_otp_error" style="display:none; color:red; font-size:12px;">
                                Please enter a valid OTP
                            </span>
                        </div>
                        <div  class="row justify-content-center mt-2">
                                Time left &nbsp; <span id="mobile_timer"> </span>
                        </div>
                        <div class="row justify-content-center mt-2">
                            <button type="button" class="btn btn-info mt-2"  style="background-color: #02349a;">
                                <a id="mobile_otp_verify">OTP verify</a>
                            </button>
                        </div>
                        <div class="row justify-content-center mt-2">
                            <p class="text-center mt-2">Didn't receive the verification OTP?
                                <br/>
                                <br/>
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
      </div>
    </div>
  </div>
</section>
{{-- <link href="{{ asset('resources/css/style.css') }}" rel="stylesheet" media="all">
<script src="{{ asset('resources/js/ajaxjquery.min.js') }}"></script> --}}
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> --}}
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> --}}


{{-- <link href="{{ asset('resources/pincode/jquery.min.js') }}" rel="stylesheet" media="all"> --}}
<script src="{{ asset('resources/pincode/select2.min.js') }}"></script>
<script src="{{ asset('resources/js/crypto/crypto-js.js')}}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script> --}}
{{-- <script src="{{ asset('resources/pincode/jquery.min.js') }}"></script> --}}
<script>
    $('.select2').select2();
</script>
<script>
    $(document).ready(function() {

        $("#user_join_club_id_show").css("display", "none");
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
            return false;
        };
        var role = getUrlParameter('role');
        // alert(role);
        if(role == 'bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi'){
            $("#tshirtsizeshow").css("display", "block");
        }
    });
</script>
<script type="text/javascript">

        function password_show() {
            // alert("asdfasdfasdf");
            var x = document.getElementById("password");

            if (x.type === "password") {

                x.type = "text";
            } else {

                x.type = "password";
            }
        }

        function confirm_password_show() {
            // alert("asdfasdfasdf");
            // return false;
            var x = document.getElementById("password-confirm");

            if (x.type === "password") {

                x.type = "text";
            } else {

                x.type = "password";
            }
        }

        $('.cyclothonrolew').change(function(){

            event.preventDefault();
            cyclothon_val = $('#cyclothonrole').val();

            if(cyclothon_val == 'individual'){

                $("#name").attr("placeholder", "Your Name");
                $("#user_join_club_id_show").css("display", "block");
                htmlroleindividual = ``;
                htmlroleindividual += `<option value="cyclothon-2024">FIT INDIA CYCLING DRIVE</option>`
                $('#role').html(htmlroleindividual)
                $("#participant_number_row").css("display", "none");
                $("#cycle_display").css("display", "block");
                $("#tshirtsizeshow").css("display", "none");
                $("#name").val("");

            }else if(cyclothon_val == 'organization'){

                $("#name").attr("placeholder", "Organisation Name");
                htmlroleorganization = ``;
                htmlroleorganization += `<option value="cyclothon-2024">FIT INDIA CYCLING DRIVE</option>`
                $('#role').html(htmlroleorganization)
                $("#participant_number_row").css("display", "block");
                $("#user_join_club_id_show").css("display", "none");
                $("#cycle_display").css("display", "block");
                $("#tshirtsizeshow").css("display", "none");
                $("#name").val("");

            }else if(cyclothon_val == 'club'){

                // window.location.href = "https://fitindia.gov.in/errorfitindia";

                $("#name").attr("placeholder", "Club Name");
                $("#participant_number_row").css("display", "block");
                $("#cycle_display").css("display", "none");
                $("#user_join_club_id_show").css("display", "none");
                $("#tshirtsizeshow").css("display", "block");
                htmlroleclub = ``;
                htmlroleclub += `<option value="namo-fit-india-cycling-club">Namo Fit India Club For Cycling</option>`
                $('#role').html(htmlroleclub)
                $("#name").val("");

            }else{

                $("#participant_number_row").css("display", "none");
                $("#name").attr("placeholder", "Your Name");
                $("#name").val("");

            }

            // alert(cyclothon_val)
            // return false;
        });

        $(function () {
            $("#btnSubmit").click(function () {

                $("#divloader").css("display", "block");
                var name = $("#name").val();
                var cyclothonrole = $("#cyclothonrole").val();
                var participant_number = $("#participant_number").val();
                var email_value = $('#email').val();
                var phone_value = $('#phone').val();
                var mobile_verified_status = $('#mobile_verified_status').val();
                var pincode_value = $('#pincode').val();
                var state = $('#state').val();
                var district_value = $('#district').val();
                var block_value = $('#block').val();
                var fi_city_value = $('#fi_city').val();
                var password = $("#password").val();
                var confirmPassword = $("#password-confirm").val();
                var captcha = $("#captcha").val();
                var cycle = $("#cycle").val();

                if(cyclothonrole == ""){

                    $("#cyclothonrole").focus();
                    $("#blankcyclothonrole").css("display", "block");
                    $("#divloader").css("display", "none");
                    return false;

                }else{

                    $("#blankcyclothonrole").css("display", "none");
                }

                if(name == ""){
                    $("#name").focus();
                    $("#blankname").css("display", "block");
                    $("#divloader").css("display", "none");
                    return false;
                }else{

                    $("#blankname").css("display", "none");
                }

                if(cyclothonrole == 'organization' || cyclothonrole == 'club'){

                    if(participant_number == ""){

                        $("#participant_number").focus();
                        $("#blankparticipant").css("display", "block");
                        $("#divloader").css("display", "none");
                        return false;

                    }else{

                        $("#blankparticipant").css("display", "none");

                    }
                }


                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                if((!regex.test(email_value)) || (email_value == "") ){
                    $("#email").focus();
                    $("#email_error").css("display", "block");
                    $("#divloader").css("display", "none");
                    return false;

                }else{

                    $("#email_error").css("display", "none");
                }

                if(($.isNumeric(phone_value) == false) || (phone_value.length > 10) || (phone_value.length < 10) ||  phone_value == 0000000000 || (phone_value.length == 0)){
                    $("#phone").focus();
                    $("#divloader").css("display", "none");
                    $("#phone_error").css("display", "block");
                    return false;
                }else{

                    $("#phone_error").css("display", "none");
                }

                if(mobile_verified_status == 0){

                    $("#phone").focus();
                    $("#divloader").css("display", "none");
                    $("#verified_phone_error").css("display", "block");
                    return false;
                }else{

                    $("#verified_phone_error").css("display", "none");

                }

                if(cyclothonrole == 'club'){

                    var address_line_one = $('#address_line_one').val();
                    var address_line_two = $('#address_line_two').val();

                    if(address_line_one == ""){

                        $("#address_line_one").focus();
                        $("#blankaddress_line_one").css("display", "block");
                        $("#divloader").css("display", "none");
                        return false;

                    }else{

                        $("#blankaddress_line_one").css("display", "none");

                    }

                    if(address_line_two == ""){

                        $("#address_line_two").focus();
                        $("#blankaddress_line_two").css("display", "block");
                        $("#divloader").css("display", "none");
                        return false;

                    }else{

                        $("#blankaddress_line_two").css("display", "none");

                    }
                }

                if(($.isNumeric(pincode_value) == false) || (pincode_value.length > 6) || (pincode_value.length < 5) ||  pincode_value == 000000 || (pincode_value.length == 0)){
                    $("#pincode").focus();
                    $("#divloader").css("display", "none");
                    $("#pincode_error").css("display", "block");
                    return false;
                }else{

                    $("#pincode_error").css("display", "none");
                }

                // if(state == ""){
                //     $('#state').select()
                //     $("#state").focus();
                //     $("#blankstate").css("display", "block");
                //     $("#divloader").css("display", "none");
                //     return false;
                // }else{

                //     $("#blankstate").css("display", "none");
                // }

                // if(district_value == ""){
                //     $('#district').select()
                //     $("#district").focus();
                //     $("#blankdistrict").css("display", "block");
                //     $("#divloader").css("display", "none");
                //     return false;
                // }else{

                //     $("#blankdistrict").css("display", "none");
                // }

                // if(block_value == ""){
                //     $('#block').select()
                //     $("#block").focus();
                //     $("#blankblock").css("display", "block");
                //     $("#divloader").css("display", "none");
                //     return false;
                // }else{

                //     $("#blankblock").css("display", "none");
                // }

                // if(fi_city_value == ""){
                //     $("#fi_city").focus();
                //     $("#blankfi_city_value").css("display", "block");
                //     $("#divloader").css("display", "none");
                //     return false;
                // }else{

                //     $("#blankfi_city_value").css("display", "none");
                // }

                if(password == ""){
                    $("#password").focus();
                    $("#blankpassword").css("display", "block");
                    $("#divloader").css("display", "none");
                    return false;
                }else{

                    if (password != confirmPassword) {

                        $("#passwordmismatch").css("display", "block");
                        $("#divloader").css("display", "none");
                        // alert("Passwords do not match.");
                        return false;

                    }else{

                        $("#passwordmismatch").css("display", "none");
                        $("#blankpassword").css("display", "none");

                    }
                }

                // if(cycle == ""){
                //     $("#cycle").focus();
                //     $("#blankcycle").css("display", "block");
                //     $("#divloader").css("display", "none");
                //     return false;
                // }else{
                //     $("#blankcycle").css("display", "none");
                //     // return true;
                // }

                if(captcha == ""){
                    $("#captcha").focus();
                    $("#blankcaptcha").css("display", "block");
                    $("#divloader").css("display", "none");
                    return false;
                }else{
                    $("#blankcaptcha").css("display", "none");
                    // return true;
                }
            });
        });

       $('#udise_row').hide();

	   var elem = $('#role').val();
		if(elem == 'school'){
			$('#udise_row').show();
			//$('#fi_udise').show();
		}else{
			$('#udise_row').hide();
			//$('#fi_udise').hide();
		}

	$('#role').change(function(){
		var elem = $('#role').val();
		if(elem == 'school'){
			$('#udise_row').show();
			//$('#fi_udise').show();
		}else{
			$('#udise_row').hide();
			//$('#fi_udise').hide();
		}
    });


    $('#state').change(function(){
        state_id = $('#state').val();
        $.ajax({
            url: "{{ route('getdistrict') }}",
            type: "post",
            data: { "id":state_id,"_token": "{{ csrf_token() }}"} ,
            success: function (response) {
               //console.log(response);
               $('#district').html(response);
            },
        });
    });


    $('#district').change(function(){
        dist_id = $('#district').val();
        $.ajax({
            url: "{{ route('getblock') }}",
            type: "post",
            data: { "id":dist_id,"_token": "{{ csrf_token() }}"} ,
            success: function (response) {
                //console.log(response);
                $('#block').html(response);
            },
        });
    });

    function fi_rolechange(val){
	   $.ajax({
           url: "{{ route('getroles') }}",
           type: "post",
           data: { "groupid" : val, "_token": "{{ csrf_token() }}"} ,
           success: function (response) {
               //console.log(response);
               var elem = '<option value="">Select</option>';
				for(var index in response) {
					elem += '<option value="'+response[index]['slug'] + '">' + response[index]['name'] + "</option>" ;
				}
				$('#role').html(elem);

            },
        });

    }



    // $('.email_verify').click(function(){

    //     $("#divloader").css("display", "block");
    //     $("#resend_otp").css("display", "none");

    //     event.preventDefault();

    //     email_value = $('#email').val();
    //     role_name = $('#role_name').val();

    //     var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    //     if((!regex.test(email_value)) || (email_value == "") ){

    //         $("#email_error").css("display", "block");
    //         $("#divloader").css("display", "none");
    //         return false;

    //     }else{

    //         $("#email_error").css("display", "none");
    //     }

    //     $.ajax({

    //        url: "{{ route('duplicateemailcheck') }}",
    //        type: "post",
    //        data: {
    //                 "email":email_value,
    //                 "role_name":role_name,
    //                 "_token": $('meta[name="csrf-token"]').attr('content')
    //             } ,


    //         success: function (response) {

    //             $("#divloader").css("display", "none");

    //             if(response.success == false){
    //                 $("#duplicate_email_error").css("display", "block");
    //                 return false;

    //             }else{

    //                 // $('#emailModal').modal("show");
    //                 $('#emailModal').modal({
    //                     backdrop: 'static',
    //                     keyboard: false
    //                 });

    //                 $("#duplicate_email_error").css("display", "none");

    //                 let timerOn = true;

    //                 function timer(remaining) {
    //                     var m = Math.floor(remaining / 60);
    //                     var s = remaining % 60;

    //                     m = m < 10 ? '0' + m : m;
    //                     s = s < 10 ? '0' + s : s;
    //                     document.getElementById('timer').innerHTML = m + ':' + s;
    //                     remaining -= 1;

    //                     if(remaining >= 0 && timerOn) {
    //                         setTimeout(function() {
    //                             timer(remaining);
    //                         }, 1000);
    //                         return;
    //                     }

    //                     if(!timerOn) {
    //                         // Do validate stuff here
    //                         return;
    //                     }
    //                     // else{
    //                     //     alert('timer stopped');
    //                     // }
    //                     // Do timeout stuff here
    //                     $("#resend_otp").css("display", "block");
    //                     // alert('Timeout for otp');
    //                 }

    //                 timer(180);
    //                 // return false;

    //             }

    //         }
    //     });
    // });

    $('.mobile_verify').click(function(){

        event.preventDefault();

        $("#divloader").css("display", "block");
        $("#mobile_otp_resend").css("display", "none");

        phone_value = $('#phone').val();
        email_value = $('#email').val();
        role_value = $('#role').val();
        role_name = $('#role_name').val();

        email_value = $('#email').val();

        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if((!regex.test(email_value)) || (email_value == "") ){

            $("#email_error").css("display", "block");
            $("#divloader").css("display", "none");
            return false;

        }else{

            $("#email_error").css("display", "none");
        }


        if(($.isNumeric(phone_value) == false) || (phone_value.length > 10) || (phone_value.length < 10) ||  phone_value == 0000000000 || (phone_value.length == 0)){

            $("#divloader").css("display", "none");
            $("#phone_error").css("display", "block");
            return false;

        }else{

            $("#phone_error").css("display", "none");
        }
        // return false;
        // dd($response->collect());

        $.ajax({

            url: "{{ route('duplicatemobilecheck') }}",
            type: "post",
            data: {
                    "phone_number":phone_value,
                    "email_value":email_value,
                    "role_name":role_name,
                    "role_value":role_value,
                    "_token": "{{ csrf_token() }}"
                } ,


            success: function (response) {

                $("#divloader").css("display", "none");

                if(response.success == false){

                    console.log("response.success",response.error);

                    if(response.error == "Duplicate Phone and email"){

                        $("#duplicate_email_error").css("display", "block");
                        $("#duplicate_phone_error").css("display", "block");
                        return false;

                    }
                    if(response.error == "Duplicate Phone"){
                        $("#duplicate_email_error").css("display", "none");
                        $("#duplicate_phone_error").css("display", "block");
                        return false;
                    }

                }else{

                    // $("#duplicate_phone_error").css("display", "none");
                    // $('#mobileModal').modal("show");
                    $('#mobileModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    let timerOn = true;

                    function timer(remaining) {
                        var m = Math.floor(remaining / 60);
                        var s = remaining % 60;

                        m = m < 10 ? '0' + m : m;
                        s = s < 10 ? '0' + s : s;
                        document.getElementById('mobile_timer').innerHTML =  m + ':' + s;
                        remaining -= 1;

                        if(remaining >= 0 && timerOn) {
                            setTimeout(function() {
                                timer(remaining);
                            }, 1000);
                            return;
                        }

                        if(!timerOn) {
                            // Do validate stuff here
                            return;
                        }
                        // else{
                            // alert('timer stopped');
                        // }
                        // Do timeout stuff here
                        $("#mobile_otp_resend").css("display", "block");
                        // alert('Timeout for otp');
                    }

                    timer(180);
                    // return false;
                    return false;

                }

            }
        });

    });

    $('#email_otp_verify').click(function(){

        event.preventDefault();

        $("#divloader").css("display", "block");
        email_value = $('#email').val();
        otp_value = $('#email_otp').val();

        if(($.isNumeric(otp_value) == false) || (otp_value.length > 6) || (otp_value.length < 5) ||  otp_value == 000000 || (otp_value.length == 0) || (otp_value.length == '')){

            $("#divloader").css("display", "none");
            $(".email_otp_error").css("display", "block");
            return false;

        }else{

            $(".email_otp_error").css("display", "none");
        }

        $.ajax({

            url: "{{ route('emailotpcheck') }}",
            type: "post",
            data: {
                    "otp_value":otp_value,
                    "email":email_value,
                    "_token": "{{ csrf_token() }}"
                },


            success: function (response) {

                $("#divloader").css("display", "none");

                if(response.success == false){
                    console.log("response.success",response.success);
                    // return false;
                    $(".email_otp_error").css("display", "block");
                    return false;

                }else if(response.success == true){

                    $("#verify_button_hide").css("display", "none");
                    $("#duplicate_phone_error").css("display", "none");
                    $("#verifyed_button_show").css("display", "block");
                    $("#emailModal").modal("hide");
                    // $('#mobileModal').modal("show");
                    // console.log("response.success",response);
                    return false;

                }else{

                    return false;
                }

            }
        });

    });

    // $('.pincode_value').click(function(){
    $('.pincode_value').keyup(function(){

        // alert("asdfsadf");
        event.preventDefault();
        pincode_value = $('#pincode').val();

        if(($.isNumeric(pincode_value) == false) || (pincode_value.length == 6)){

            $("#divloader").css("display", "block");
            console.log("pincode","https://api.postalpincode.in/pincode/",pincode_value);
            $.ajax({

                // url: "https://api.postalpincode.in/pincode/110075",
                url: "https://api.postalpincode.in/pincode/"+pincode_value,
                type: "get",
                data: {
                        "_token": "{{ csrf_token() }}"
                    },


                success: function (response) {

                    $("#divloader").css("display", "none");
                    // console.log("response",);
                    // return false;
                    if(response[0].Status == 'Error'){
                        $("#pincode").focus();
                        $("#divloader").css("display", "none");
                        $("#pincode_error").css("display", "block");
                    }else{
                        $("#pincode_error").css("display", "none");
                    }
                    if(response[0].Status == 'Success'){

                        // console.log("response",response[0].PostOffice);
                        html = `<option value="${response[0].PostOffice[0].State}">${response[0].PostOffice[0].State}</option>`
                        $('#state').html(html)

                        let html1 = ''

                        // console.log("response[0].PostOffice[0]",response[0].PostOffice);
                        // for(i = 0; i < response[0].PostOffice.length; i++) {

                            html1 += `<option value="${response[0].PostOffice[0].District}">${response[0].PostOffice[0].District}</option>`
                            // console.log("response[0].PostOffice[0]",jQuery.unique(response[0].PostOffice[i++].District));
                            $('#district').html(html1)

                        // }

                        let html2 = ''

                        console.log("response[0].PostOffice[0].block",response[0].PostOffice);
                        for(k = 0; k < response[0].PostOffice.length; k++) {

                            html2 += `<option value="${response[0].PostOffice[k].Block}">${response[0].PostOffice[k].Block}</option>`
                            // console.log("response[0].PostOffice[0]",jQuery.unique(response[0].PostOffice[i++].District));
                            $('#block').html(html2)

                        }

                        let html3 = ''
                        // $("#city_show_hide").css("display", "none");
                        // console.log("response[0].PostOffice[0].Name",response[0].PostOffice);

                        // html3 += `<select id="fi_city" name="city" class="form-control @error('fi_city') is-invalid @enderror" aria-required="true">`;
                        // // for(m = 0; m < response[0].PostOffice.length; m++) {

                        //     html3 += `<option value="${response[0].PostOffice[0].Division}">${response[0].PostOffice[0].Division}</option>`
                        //     // console.log("response[0].PostOffice[0]",jQuery.unique(response[0].PostOffice[i++].District));
                        // // }
                        // html3 += `</select>`;
                        // html3 = `<input id="fi_city" type="text" class="form-control required  @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" placeholder="City/Town/Village" aria-required="true" onkeydown="return /[a-z, ]/i.test(event.key)"`;
                        // $('#city_show').html(html3)
                        $("#fi_city").val(response[0].PostOffice[0].Division);
                        console.log("response[0].PostOffice[0]",response[0].PostOffice);
                        return false;

                    }




                    // $("#divloader").css("display", "none");

                    // if(response.success == false){
                    //     console.log("response.success",response.success);
                    //     // return false;
                    //     $(".email_otp_error").css("display", "block");
                    //     return false;

                    // }else if(response.success == true){

                    //     $("#verify_button_hide").css("display", "none");
                    //     $("#duplicate_phone_error").css("display", "none");
                    //     $("#verifyed_button_show").css("display", "block");
                    //     $("#emailModal").modal("hide");
                    //     // $('#mobileModal').modal("show");
                    //     // console.log("response.success",response);
                    //     return false;

                    // }else{

                    //     return false;
                    // }

                }
            });
            // $("#divloader").css("display", "none");
            // $(".email_otp_error").css("display", "block");
            return false;
        }
        // else{

        // $(".email_otp_error").css("display", "none");
        // }

        return false;
        // $.ajax({

        //     url: "{{ route('emailotpcheck') }}",
        //     type: "post",
        //     data: {
        //             "otp_value":otp_value,
        //             "email":email_value,
        //             "_token": "{{ csrf_token() }}"
        //         },


        //     success: function (response) {

        //         $("#divloader").css("display", "none");

        //         if(response.success == false){
        //             console.log("response.success",response.success);
        //             // return false;
        //             $(".email_otp_error").css("display", "block");
        //             return false;

        //         }else if(response.success == true){

        //             $("#verify_button_hide").css("display", "none");
        //             $("#duplicate_phone_error").css("display", "none");
        //             $("#verifyed_button_show").css("display", "block");
        //             $("#emailModal").modal("hide");
        //             // $('#mobileModal').modal("show");
        //             // console.log("response.success",response);
        //             return false;

        //         }else{

        //             return false;
        //         }

        //     }
        // });

    });

    $('#mobile_otp_verify').click(function(){

        event.preventDefault();

        $("#divloader").css("display", "block");
        phone_value = $('#phone').val();
        phone_otp_value = $('#phone_otp').val();

        if(($.isNumeric(phone_otp_value) == false) || (phone_otp_value.length > 6) || (phone_otp_value.length < 5) ||  phone_otp_value == 000000 || (phone_otp_value.length == 0) || (phone_otp_value.length == '')){

            $("#divloader").css("display", "none");
            $(".mobile_otp_error").css("display", "block");
            return false;

        }else{

            $(".mobile_otp_error").css("display", "none");
        }

        $.ajax({

            url: "{{ route('mobileotpcheck') }}",
            type: "post",
            data: {
                    "otp_value":phone_otp_value,
                    "mobile":phone_value,
                    "_token": "{{ csrf_token() }}"
                },


            success: function (response) {

                $("#divloader").css("display", "none");

                var decrypted = JSON.parse(CryptoJS.AES.decrypt(response.success, "passphrasepass", {format: CryptoJSAesJson}).toString(CryptoJS.enc.Utf8));
                let text = decrypted;
                const myArray = text.split(":");
                value_split = myArray[1];
                // console.log("value_split",value_split);
                // return false;
                // if(response.success == false){
                if(value_split == "falsefalrog"){

                    $(".mobile_otp_error").css("display", "block");
                    return false;

                // }else if(response.success == true){
                }else if(value_split == "truewrtsuss"){

                    $("#verifyed_mobile_button_show").css("display", "block");
                    $("#verify_button_mobile_hide").css("display", "none");
                    $("#duplicate_phone_error").css("display", "none");
                    $("#mobileModal").modal("hide");
                    $("#mobile_verified_status").val("1");
                    return false;

                }else{

                    $(".mobile_otp_error").css("display", "block");
                    return false;

                }

            }
        });

    });

</script>
<script>
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
</script>
<script>

    jQuery('#reload').click(function () {
        jQuery.ajax({
    type: 'GET',
    url: "{{ route('reloadCaptcha')}}",
    success: function (data) {
		jQuery(".captchaimg span").html(data.captcha);
    }
    });
});
</script>

<style>
    select,
    input::-webkit-input-placeholder {
    font-size: 14px !important;
    /* padding-left:8px!important; */

}
</style>
@endsection
