@extends('layouts.app')
@section('title', 'Nsd Upload Image | Fit India')
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

<div>
        <img src="{{ asset('resources/imgs/national-sports-day-2025.png') }}" alt="nsd-upload-image"
            title="NSD 2025 Upload Image" class="img-fluid expand_img" />
    </div>
  <section id="{{ $active_section_id }}">

    <div class="container" >

        <div class="row">
            <div class="col-md-6 offset-md-3">
            {{-- <div class="backBtn">
                <a class="btn btn-secondary " href="your-stories">Back</a>
            </div> --}}
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form action="{{ route('save-upload-image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                         <div class="form-group">
                            <label for="userEmail">Your name *</label>
                            <input type="text" class="form-control" name="fullname" value="">
                            @error('fullname')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Designation/occupation *</label>
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
                            <label for="userEmail">Contact number *</label>
                            <input type="text" class="form-control" name="mobile" value="" maxlength="10">
                            @error('mobile')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

						 <div class="form-group">
						<label for="youare">State</label>
                         <select name="state">

						<option value="">Select State</option>
					   @foreach($states as $state)
						<?php
						if(!empty($_REQUEST['state'])&& $_REQUEST['state']==$state->name){
						$stselect='selected';
						}else{
						$stselect='';
						}
						?>
						<option data-name="{{ $state->id }}" <?=$stselect?> value="{{ $state->name }}">{{ $state->name }}</option>
					 @endforeach
					</select>
                        @error('state')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

					</div>
                        <div class="form-group">
                            <label for="userEmail">Upload Your Image *</label>
                            <input type="file" id="image" name="image">
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="left action-row">
                         <div class="captcha-colm">

                         <div class="um-field" id="capcha-page-cont">
                           <label for="captcha">(Even if you are sharing your story via video, please type 10-15 sentences about it in the box below.)</label><br>
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
						<a class="btn btn-secondary" href="{{ url('your-stories') }}">CANCEL</a>
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
</script>
@endsection
