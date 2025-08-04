
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
        <div style="margin-top:15%;margin-bottom:25%;">
            <h3>
                Registrations for the NAMO Fit India Cycling Club are temporarily closed and will reopen shortly. For any queries, please reach out to us at contact@fitindia.gov.in
            </h3>
        </div>
  </div>
</section>

@endsection
