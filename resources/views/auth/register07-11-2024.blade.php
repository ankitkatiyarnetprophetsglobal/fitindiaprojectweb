@extends('layouts.app')
@section('title', 'Register | Fit India')
@section('content')
<style>
    .register-row-lft{
        width: 64% !important;
    }
    .loaderregister {
        position: absolute;        
        z-index: 100000;
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
        background: #fff;
        border-radius: 10px;        
    }
</style>
<section class="log_sec">
    
  <div class="container">    
    <div id="divloader" class="loaderregister" style="display: none">
    {{-- <div id="divloader" class="loaderregister" style="display: block"> --}}
        <img style="height:150px;width:150px;margin-top: 20%;" src="{{ url('/wp-content/uploads/2021/01/loader.gif') }}" />
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
                            <input type="radio" name="roletype"  value="1" onclick="fi_rolechange(this.value)" checked=""> Ministries/Departments
                            <input type="radio" name="roletype" value="2" onclick="fi_rolechange(this.value)"> Armed forces/CPF 
                            <input type="radio" name="roletype" value="0"  onclick="fi_rolechange(this.value)"> Other   
                        </div>
                   <!-- <div class="role-row">
                         <input type="radio" name="roletype" value="0" checked="" onclick="fi_rolechange(this.value)"> Other   <input type="radio" name="roletype" value="1" onclick="fi_rolechange(this.value)"> Ministry Employees<input type="radio" name="roletype" value="2" onclick="fi_rolechange(this.value)"> Armed forces</div> -->
                          <select class="form-control @error('role') is-invalid @enderror" name="role" id="role" required autocomplete="role" autofocus>
							<option value="">{{'Select'}}</option>
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
                <div id="udisenumrow" class="register-row"> 
                    <div class="register-row-lft">
					 <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Your Name/School Name/Organisation Name">
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
                
                
                <div class="register-row" style="align-items: center"> 
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
                
                <div class="register-row" style="align-items: center"> 
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
                    <div class="register-row-rt">
                        <select id="district" name="district" class="form-control @error('district') is-invalid @enderror" aria-required="true">
							<option value="">Select District</option>
							@foreach($districts->sortBy('name') as $st)
							    @if($st->name)
                                <option value="{{ $st->id }}"  @if(!empty(old('district')) && old('district') == $st->id) {{ 'selected' }} @endif >
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
							<option value="">Select Block</option>
							@foreach($blocks->sortBy('name') as $st)
							  @if($st->name)
                                <option value="{{ $st->id }}"  @if(!empty(old('block')) && old('block') == $st->id) {{ 'selected' }} @endif >
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
						name="password" value="{{ old('password') }}" required autocomplete="new-password" placeholder="Password">
								@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password r_child">


                                
								
                    </div>
                    <div class="register-row-rt r_parent">
                       
						<input id="password-confirm" type="password" class="form-control  @error('password') is-invalid @enderror" value="{{ old('password_confirmation') }}" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
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
						</div>

						<div style="clear:both;"></div>
					</div>
                    </div>                    
                </div>
				
                <div style="clear:both"></div>
                
                <div class="register-row-submit">
                    <input class="submit_button" type="submit" value="SIGN UP">
                </div>
                </div>
            </form>
         </div>
        <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true" >
            <div class="modal-dialog" role="document" style="min-height: 800px;">
                <div class="modal-content">
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
                            <p class="w-100 text-center">We will send you an OTP via registered</p>
                            <h6 class="mt-1 w-100 text-center" style="font-weight: 700">Email</h6>
                        </div>
                        <div class="row justify-content-center mt-2">
                            <div class="col-6">                                                                
                                <input type="number" class="form-control" id="email_otp" name="email_otp" size="100" maxlength="6" min="1" >
                            </div>                            
                        </div>
                        <div class="row justify-content-center mt-2">
                            <span class="email_otp_error" style="display:none; color:red;">
                                Please enter a valid OTP                                    
                            </span>
                        </div>
                        <div  class="row justify-content-center mt-2">
                                Time left &nbsp;<span id="timer"> </span>
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
                                {{-- <span id="resend_otp" style="display:block;"> --}}
                                    <button type="button" class="btn btn-info">
                                    {{-- <button type="button" class="btn btn-info mt-2"  style="background-color: #02349a;"> --}}
                                        <a class="email_verify" style="color:#fff;">Resend OTP</a> 
                                    </button>                          
                                </span>                                
                            </p>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>                            
                        </div>
                        {{-- <div>
                            <input type="number" id="email_otp" name="email_otp" size="50" maxlength="6" min="1">
                            <span id="email_otp_error" style="display:none; color:red;">
                                Please Enter A Valid OTP                                    
                            </span>
                            <button type="button" class="btn btn-info">
                                <a id="email_otp_verify">OTP verify</a> 
                            </button>
                            <div>Time left  <span id="timer"></span></div>
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
                <div class="modal-content">
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
                            <p class="w-100 text-center">We will send you an OTP via registered</p>
                            <h6 class="mt-1 w-100 text-center" style="font-weight: 700">Mobile Number</h6>
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
                        <div  class="row justify-content-center mt-2">
                                Time left &nbsp;<span id="mobile_timer"> </span>
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
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>                            
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
<script type="text/javascript">
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

    $('.email_verify').click(function(){

        $("#divloader").css("display", "block");            
        $("#resend_otp").css("display", "none");            
        
        event.preventDefault();

        email_value = $('#email').val();
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        
        if((!regex.test(email_value)) || (email_value == "") ){
        
            $("#email_error").css("display", "block");
            $("#divloader").css("display", "none");            
            return false;
        
        }else{
        
            $("#email_error").css("display", "none");
        }
        
        $.ajax({

           url: "{{ route('duplicateemailcheck') }}",
           type: "post",
           data: { "email":email_value,"_token": "{{ csrf_token() }}"} ,

        
            success: function (response) {  

                $("#divloader").css("display", "none");

                if(response.success == false){
                    $("#duplicate_email_error").css("display", "block");                
                    return false;
                
                }else{
                    
                    // $('#emailModal').modal("show");                    
                    $('#emailModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    
                    $("#duplicate_email_error").css("display", "none"); 
                    
                    let timerOn = true;

                    function timer(remaining) {
                        var m = Math.floor(remaining / 60);
                        var s = remaining % 60;
                        
                        m = m < 10 ? '0' + m : m;
                        s = s < 10 ? '0' + s : s;
                        document.getElementById('timer').innerHTML = m + ':' + s;
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
                        //     alert('timer stopped');
                        // }                    
                        // Do timeout stuff here
                        $("#resend_otp").css("display", "block");
                        // alert('Timeout for otp');
                    }

                    timer(180);
                    // return false;

                }

            }
        });
    });	

    $('.mobile_verify').click(function(){
        
        event.preventDefault();

        $("#divloader").css("display", "block"); 
        $("#mobile_otp_resend").css("display", "none");       
        phone_value = $('#phone').val();
        
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
            data: { "phone_number":phone_value,"_token": "{{ csrf_token() }}"} ,


            success: function (response) {
                
                $("#divloader").css("display", "none"); 

                if(response.success == false){
                    $("#duplicate_phone_error").css("display", "block");                
                    return false;
                    
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

                if(response.success == false){

                    $(".mobile_otp_error").css("display", "block");                
                    return false;
                
                }else if(response.success == true){    

                    $("#verifyed_mobile_button_show").css("display", "block");                
                    $("#verify_button_mobile_hide").css("display", "none");
                    $("#duplicate_phone_error").css("display", "none");
                    $("#mobileModal").modal("hide");
                    return false;

                }else{
                    
                    return false;

                }

            }
        });

    });
	
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
