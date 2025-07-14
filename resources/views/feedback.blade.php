@extends('layouts.app')
@section('title', 'Feedback | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp

<div class="inner-banner-bg">
<div class="inner-banner-band">
<h1 class="page__title title" id="page-title">Feedback</h1>
</div>
</div>
  <section id="{{ $active_section_id }}">
    <div class="container" >
        <div class="row">
            <div class="col-md-6 offset-md-3">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form action="{{ route('save-feedback') }}" method="POST" >
                    @csrf
                    
                   
                       <div class="form-group">
                            <label for="userEmail">Department / Who you are*</label>
                            <input type="text" name="department" class="form-control" value="">
                            {!!$errors->first("department", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Your Name *</label>
                            <input type="text" class="form-control" name="name" value="">
                            {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        
                        <div class="form-group">
                            <label for="userEmail">Email Address *</label>
                            <input type="email" class="form-control" name="email" value="">
                            {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
                        </div>
                         <div class="form-group">
                            <label for="userEmail">Contact Number</label>
                            <input type="number" class="form-control" name="mobile" value="">
                            {!!$errors->first("mobile", "<span class='text-danger'>:message</span>")!!}
                        </div>
						<div class="form-group">
                            <label for="userEmail">Your Feedback</label>
                            <textarea class="form-control" name="feedback" value=""></textarea>
                            {!!$errors->first("feedback", "<span class='text-danger'>:message</span>")!!}
                        </div>
                   
                         <div class="login-row" > 
                         <div class="um-field" id="capcha-page-cont">
                           <label for="captcha"></label><br>
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
                    
                        <button type="submit" class="btn btn-primary feed_btn">SEND</button>
                        </div>
                  
                </form>
            </div>
        </div>
    </div>
    </section>

@endsection