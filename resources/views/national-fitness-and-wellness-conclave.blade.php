@extends('layouts.app')
@section('title', 'National Fitness and Wellness Conclave | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<style>
.inner-banner-bg {
	background: url(resources/imgs/d-blue-ptrn-bg.png) repeat top center;
}
.inner-banner-band {
	text-align:center;
	padding:2.5% 0;
	color:rgb(11 2 131 / 100%);
	background: rgb(248 249 255 / 94%);
	text-transform:uppercase;
}
</style>

    {{-- <div>
        <img src="{{ asset('resources/imgs/national-sports-day-2025.png') }}" alt="nsd-upload-image" title="NSD 2025 Upload Image" class="img-fluid expand_img" />
    </div> --}}
  <section id="{{ $active_section_id }}">

    <div class="container" >

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2><center>National Fitness and Wellness Conclave</center></h2>
                {{-- <h2><center> Conclave Registration Form</center></h2> --}}
                <br/>
                <br/>
            {{-- <div class="backBtn">
                <a class="btn btn-secondary " href="your-stories">Back</a>
            </div> --}}
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form action="{{ route('save-national-fitness-and-wellness-conclave') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    {{-- <div class="role-row">
                        <input type="radio" name="roletype"  value="1" onclick="fi_rolechange(this.value)" checked=""> Ministries/Departments
                        <input type="radio" name="roletype" value="2" onclick="fi_rolechange(this.value)"> Armed forces/CPF
                        <input type="radio" name="roletype" value="0" onclick="fi_rolechange(this.value)"> Other
                    </div>
                    @error('roletype')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br> --}}
                    {{-- <select class="form-control @error('role') is-invalid @enderror" name="role" id="role" autocomplete="role">
                        <option value="">Select</option>
                        @foreach ($roles as $role)
                            <?php if(in_array($role->slug, array( 'champion' , 'smambassador', 'sai_user', 'author', 'gmambassador','gram_panchayat','caadmin') )){ continue; } ?>
                            <option <?php if(isset($_GET['role'])){ if(base64_decode($_GET['role']) ==  $role->slug){ echo "selected='selected'";}} ?> value="{{ $role->slug }}"  @if(old('role') == $role->slug) {{ 'selected' }} @endif >{{ Str::upper($role->name)}}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br> --}}
                    <div class="">
                         <div class="form-group">
                            <label for="userEmail">Name *</label>
                            <input type="text" class="form-control" name="fullname" value="">
                            @error('fullname')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Company *</label>
                            <input type="text" class="form-control" name="company" value="">
                            @error('designation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Designation *</label>
                            <input type="text" class="form-control" name="designation" value="">
                            @error('designation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="userEmail">Email-id *</label>
                            <input type="email" class="form-control" name="email" value="">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
						<div class="form-group">
                            <label for="userEmail">Phone *</label>
                            <input type="number" class="form-control" name="mobile" value="" min=1 maxlength="10">
                            @error('mobile')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="left action-row">
                            <div class="captcha-colm">
                                <div class="um-field" id="capcha-page-cont">
                                    {{-- <label for="captcha">
                                        (Please ensure that you upload only one type of file at a time—either images or videos in a
                                        single upload. If you wish to upload the other type, please do so in a separate round).
                                    </label> --}}
                                    {{-- <label for="captcha">
                                        (If you want to upload multiple types of file in one go, you can create a new event. For more details, please refer to the “How to Register” guidelines.)
                                    </label> --}}
                                    {{-- <br>
                                    <br> --}}
                                    <div style="float:left; width:115px;  margin: 6px 0;" id="pagecaptcha-cont">
                                        <div class="captchaimg">
                                            <span>{!! captcha_img() !!}</span>
                                        </div>
                                    </div>
                                    <div style="float:left; margin: 6px 20px 6px 10px; cursor: pointer;">
                                        <button type="button" class="btn btn-info" class="reload" id="reload"> ↻ </button>
                                    </div>
                                    <div style="float:left; width:40%">
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
                            <div class="action-colm">
                                <button type="submit" class="btn btn-primary">SEND</button>
                            </div>

					    </div>
                </form>
            </div>
        </div>
    </div>
  </section>
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
@endsection
