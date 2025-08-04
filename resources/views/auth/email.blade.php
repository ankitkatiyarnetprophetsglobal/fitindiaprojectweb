@extends('layouts.app')
@section('title', '	Password change | Fit India')
@section('content')
<style>
    .footer_ab{position:absolute;bottom:0;width:100%;}
    </style>
<section class="resetPass_word">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-8 col-lg-6 ">
            <div class="card">
                <div class="card-header pl-4 pr-4">{{ __('Reset Password') }}</div>
                <div class="card-body">
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                    <form method="POST" action="{{ url('reset_password_without_token') }}">
                        @csrf

                        <div class="form-group row pl-4 pr-4 rest_area">
                            <label for="email" class=" col-form-label text-md-right pr-4">{{ __('E-Mail Address') }}</label>

                            <div class="f-width">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-sm-12 col-md-12   ">
                                <button type="submicol-lg-6t" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<script type="text/javascript">
    $(document).ready(function(){

        $("#footer_ab").addClass("footer_ab")
        //alert("balbl")
   //$('.footer').css('position','absolute')
     //$('.footer').css('bottom','38px')
       //// alert("raje")
       
    })
    </script>
@endsection
