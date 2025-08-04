@extends('layouts.app')
@section('title', 'Register | Fit India')
@section('content')
<section class="log_sec">
  <div class="container">
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
                         <input type="radio" name="roletype" value="0" checked="" onclick="fi_rolechange(this.value)"> Other   <input type="radio" name="roletype" value="1" onclick="fi_rolechange(this.value)"> Ministry </div>
                          <select class="form-control @error('role') is-invalid @enderror" name="role" id="role" required autocomplete="off" autofocus>
							<option value="">{{'Select'}}</option>
							@foreach ($roles as $role)
							<?php if(in_array($role->slug, array( 'champion' , 'smambassador', 'sai_user', 'author', 'gmambassador') )){ continue; } ?>
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
					 <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus placeholder="Your Name/School Name/Organisation Name">
						@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror								
                    </div>
                    <div class="register-row-rt">
					  <div id="udise_row" style="display:none;">					  
					    <input id="fi_udise" type="text" class="form-control @error('udise') is-invalid @enderror" name="udise" value="{{ old('udise') }}" required autocomplete="off" placeholder="U-Dise Number">
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
                
                
                <div class="register-row"> 
                    <div class="register-row-lft"> 
                        
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
								
                    </div>
                    <div class="register-row-rt">
                        
						<input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="off" placeholder="Mobile">

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
								
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
								{{ strtolower(ucfirst($st->name)) }}
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
						name="password" value="{{ old('password') }}" required autocomplete="off" placeholder="Password">
								@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password r_child">


                                
								
                    </div>
                    <div class="register-row-rt r_parent">
                       
						<input id="password-confirm" type="password" class="form-control  @error('password') is-invalid @enderror" value="{{ old('password_confirmation') }}" name="password_confirmation" required autocomplete="off" placeholder="Confirm Password">
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
						<label for="captcha">Please Enter the Captcha Text</label><br>
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
