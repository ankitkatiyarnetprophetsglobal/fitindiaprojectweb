@extends('layouts.app')
@section('title', 'National Sports Day Merchandise Creatives 2025 | Fit India')
@section('content')
@php
$active_section = request()->segment(count(request()->segments()));
$active_section_id = trim($active_section);
@endphp

<style>
    .shadow_m {
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
    }

    .base_mer {
        background: #fff;
        /* box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px; */
        padding: 10px 90px;

    }

    .cap_area {

        background: #ffffff;
        /* margin: 10px 10px 30px 10px; */
        box-shadow: rgb(0 0 0 / 10%) 0px 4px 12px;
        position: relative;
        border: 1px solid #cdd4d5;
        margin-bottom: -1px;
        border-top-right-radius: 50px;
        position: relative;
        top: 31px;
        left: 9px;

    }

    .icon_area {
        position: relative;
    }

    .base_mer_inner {
        border-radius: 5px;
    }

    /* .bm_inner {
        padding: 1.4rem;
        background: #fff;
    } */

    .bm_inner img {
        /* border: 1px solid #42b0f4; */
        border: 1px solid #c4cccd;

        padding: 22px;
        border-top-right-radius: 50px;
        border-bottom-left-radius: 50px;
    }

    .bm_inner {
        padding: 1.5rem;
    }

    .merform {
        width: 50%;
        margin: 0 auto;
    }

    .mer_btn {
        background-color: rgb(29 161 242);
        padding: 10px 60px;
        color: #fff;
        font-size: 14px;

        border-radius: 100px;
        border: 0;
        text-transform: uppercase;
        cursor: pointer;
        margin-top: 15px;
        box-shadow: 0 5px 10px rgb(53 53 53 / 30%);
    }

    .mer_logo {
        background-color: rgb(68 68 68);
        padding: 10px 10px;
        color: #fff;
        font-size: 14px;
        border-radius: 10px;
        border: 0;
        text-transform: uppercase;
        cursor: pointer;
        margin-top: 15px;
        box-shadow: 0 5px 10px rgb(53 53 53 / 30%);
    }

    .mer_logo p {
        margin-bottom: 0;
        letter-spacing: 0;

    }

    .mer_logo_form {
        background-color: #1da1f2;
        padding: 7px 25px;
        color: #fff;
        font-size: 14px;
        border-radius: 4px;
        border: 0;
        text-transform: uppercase;
        cursor: pointer;
        margin-top: 5px;

        box-shadow: 0 5px 10px rgb(53 53 53 / 30%);

    }

    .mer_banner {
        position: relative;
    }

    .mer_input {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        display: block;

    }

    .s_name {
        font-size: 45px;
        color: #000;
    }


    .some-absolute-div {

        position: absolute;
        bottom: 0px;
        right: 0;
        left: 0;

        padding: 10px;
        border-radius: 10px;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -moz-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        -moz-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        -moz-align-items: center;
        align-items: center;
    }

    .bannerPos1 {
        top: 63%;
    }

    .bannerPos2 {
        top: 10%;
    }

    .bannerPos3 {
        top: 35%;
    }

    .centered-in-absolute {

        padding: 10px;
        border-radius: 10px;

    }

    .azadi_area {
        /* margin-top: 15px; */
    }

    .azadi_area_inner {
        position: relative;
    }

    .azadi_area img {
        width: 120px;
        height: 90px;
        padding: 17px;
        margin: 0 10px;
        border-radius: 6px;
        border: 2px solid #1da1f24f;
    }

    .azadi_area1 {
        margin-bottom: 15px;
    }

    .azadi_area1 img {
        width: 200px;
        /* padding: 17px; */
        margin: 0 10px;
        border-radius: 6px;
        border: 2px solid #1da1f24f;
    }

    .azadi_area_inner_download1 {
        left: 75px !important;

    }



    .azadi_area_inner_download {
        text-align: center;
        padding: 3px 10px;
        position: absolute;
        bottom: -12px;
        left: 32px;
        background: #1da1f2;
        margin: 0;
        border-radius: 5px;
        color: #fff;


    }

    .azadi_area_inner_download a {
        margin-bottom: 0px;
        font-size: 13px;
        font-weight: 400;
        color: #fff;
    }



    @media (max-width: 767px) {
        .base_mer {
            padding: 10px 15px;
        }

        .s_name {
            font-size: 24px !important;
        }

        .cap_area {
            top: 0;
            margin-top: 10px;
        }

        .bm_inner {
            margin-bottom: 0 !important;
            padding: 1rem 1.5rem;
        }

        .cap_area {
            display: none;
        }

        .merform {
            width: auto;
            margin: 0 15px;
        }

        .mer_mobile {
            flex-direction: row;
        }

        .mer_btn {
            background-color: rgb(29 161 242);
            padding: 5px 36px;
            color: #fff;
            font-size: 12px;
            margin-top: 0 !important;
        }

    }

    @media (max-width: 500px) {
        .s_name {
            font-size: 24px;
        }

    }

    .image_holder {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        border: 1px solid #c4cccd;
        position: relative;
    }

    span.image_section {
        display: block;
        overflow: hidden;
        max-height: 430px;
    }

    span.image_section img {
        max-width: 100%;
        height: 100%;
        width: 100%;
        object-fit: contain;
        object-position: center center;
    }

    span.img_txt_section .btn {
        margin-top: -15px;
        background-color: #1da1f2;
        border-color: #1da1f2 !important;
        text-decoration: none !important;
        font-size: 13px;
    }

    span.img_txt_section .btn:hover,
    span.img_txt_section .btn:focus {
        background-color: #0056b3;
        color: #fff;
    }

    span.img_txt_section {
        font-size: 0;
        position: absolute;
        bottom: 0;
    }
</style>

<div class="banner">
    <div class="row">
        <div class="col-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                {{-- <img src="{{ asset('resources/imgs/event2023/sportsday-banner.jpg') }}" alt="sports-day" title="national-sports-day" class="img-fluid expand_img" /> --}}
                <div class="carousel-inner">
                    <div class="carousel-item mer_banner active">
                      <a href="{{ url('national-sports-day-2024') }}">
                        <img src="{{ asset('resources/imgs/national-sports-day-2024.jpeg') }}" class="d-block w-100" alt="National Sports Day 2024" title="National Sports Day 2024">
                        <div class="some-absolute-div bannerPos1">
                            <div class="centered-in-absolute">
                                {{-- <form action="{{route('download-school-banner')}}" method="POST"> --}}
                                    @csrf
                                    <div class="text-center">
                                        <input type="hidden" name="banner_type" value="week_1">
                                        {{-- <button type="submit" name="banner_submit" value="Submit" class="mer_btn">Download</button> --}}
                                    </div>

                                {{-- </form> --}}
                            </div>
                        </div>
                      </a>
                    </div>
                    <div class="carousel-item mer_banner">
                      <a href="{{ url('national-sports-day-2024') }}">
                        <img src="{{ asset('resources/imgs/national-sports-day-20242.jpeg') }}" class="d-block w-100" alt="National Sports Day 2024" title="National Sports Day 2024">
                        <div class="some-absolute-div bannerPos1">
                            <div class="centered-in-absolute">
                                {{-- <form action="{{route('download-school-banner')}}" method="POST"> --}}
                                    @csrf
                                    <div class="text-center">
                                        <input type="hidden" name="banner_type" value="week_1">
                                        {{-- <button type="submit" name="banner_submit" value="Submit" class="mer_btn">Download</button> --}}
                                    </div>

                                {{-- </form> --}}
                            </div>
                        </div>
                      </a>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
  </div>
</div>






<div class="container-fluid">


        <div class="row align-items-center justify-content-center my-5">
            <div class="col-lg-4 col-md-4 col-sm-6 col-12 my-3">
                <div class="image_holder">
                    <span class="image_section">
                        <img src="{{ url('resources/imgs/national-sports-day-2024/National-Sports-day.jpg') }}" />
                    </span>

                    <span class="img_txt_section">
                        <a href="resources/imgs/national-sports-day-2024/National-Sports-day.zip" class="btn btn-primary btn-sm" data-icon="G">Download Backdrop</a>
                    </span>
                </div>
            </div>

            {{-- <div class="col-lg-3 col-md-3 col-sm-6 col-12 my-3">
                <div class="image_holder">
                    <span class="image_section">
                        <img src="{{ url('resources/imgs/fitindiaweek2023/standee/standee.png') }}" style="max-width: 50%; display:block; margin:auto;" />
                    </span>

                    <span class="img_txt_section">
                        <a href="resources/imgs/fitindiaweek2023/standee/standee.zip" class="btn btn-primary btn-sm" data-icon="G">Download Standee</a>
                    </span>
                </div>
            </div> --}}
        </div>
        {{-- <div class="row align-items-center justify-content-center my-5">
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="image_holder">
                    <span class="image_section">
                        <img src="{{ url('resources/imgs/fitindiaweek2023/1.png') }}" />
                    </span>

                    <span class="img_txt_section">
                        <a href="resources/imgs/fitindiaweek2023/fitindiaweek2023.zip" class="btn btn-primary btn-sm" data-icon="G">Download</a>
                    </span>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="image_holder">
                    <span class="image_section">
                        <img src="{{ url('resources/imgs/fitindiaweek2023/2.png') }}" />
                    </span>

                    <span class="img_txt_section">
                        <a href="resources/imgs/fitindiaweek2023/fitindiaweek2023.zip" class="btn btn-primary btn-sm" data-icon="G">Download</a>
                    </span>
                </div>
            </div>
        </div> --}}

        {{-- <div class="row align-items-center justify-content-center my-5">
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="image_holder">
                    <span class="image_section">
                        <img src="{{ url('resources/imgs/fitindiaweek2023/3.png') }}" />
                    </span>

                    <span class="img_txt_section">
                        <a href="resources/imgs/fitindiaweek2023/fitindiaweek2023.zip" class="btn btn-primary btn-sm" data-icon="G">Download</a>
                    </span>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="image_holder">
                    <span class="image_section">
                        <img src="{{ url('resources/imgs/fitindiaweek2023/4.png') }}" />
                    </span>

                    <span class="img_txt_section">
                        <a href="resources/imgs/fitindiaweek2023/fitindiaweek2023.zip" class="btn btn-primary btn-sm" data-icon="G">Download</a>
                    </span>
                </div>
            </div>

        </div> --}}

        {{-- <div class="row align-items-center justify-content-center my-5">
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="image_holder">
                    <video width="320" height="240" controls>
                        <source src="{{ url('resources/imgs/fitindiaweek2023/fitindia.mp4') }}" type="video/mp4">
                      </video>
                </div>
            </div>
        </div> --}}

        @if (false)
        <div class="row ">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class=" d-flex azadi_area1 justify-content-center">
                    <div class="azadi_area_inner">
                        <img class="shadow1" style="display:inline; height:400px; width:70%;" src="{{ url('resources/imgs/event2023/nsdschoolbackdrop.jpg') }}" />
                        <div class="azadi_area_inner_download shadow1 azadi_area_inner_download1">
                            <a href="resources/imgs/event2023/nsdschoolbackdrop.ai" data-icon="G">Download</a>
                        </div>
                    </div>
                    <div class="azadi_area_inner">
                        <img class="shadow1" src="{{ url('resources/imgs/event2023/nsdschoolstandee.jpg') }}" />
                        <div class="azadi_area_inner_download shadow1 azadi_area_inner_download1">
                            <a href="resources/imgs/event2023/nsdschoolstandee.ai" data-icon="G">Download</a>
                        </div>
                    </div>
                </div>

                {{-- <div class="azadi_area1 shadow1">
                    <img class=" img-fluid" src="{{ url('resources/imgs/merchant_img/shirtlogo/png/Artboard 2.png') }}" />
                </div> --}}
            </div>
        </div>
        @endif



        {{-- <div class="base_mer"> --}}
        {{-- <div class="base_mer">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="pl-4 pr-4 text-center mt-3">Logo appearance on Caps</h4>
                </div>
                <div class="mt-4">
                    <div class=" mer_logo">
                        <p>Download Official Fit India Logos</p>
                        <div class="d-flex justify-content-between align-items-center mer_mobile">
                            <a class="mer_logo_form " href="{{ url('resources/imgs/downloadofficiallogos/fitindialogo/png/fitindiaLogos.zip') }}" data-icon="G">png</a>
                            <a class="mer_logo_form" href="javascript:void(0)" data-icon="G">jpg</a>
                            <a class="mer_logo_form" id="merchandisId" href="javascript:void(0)" data-icon="G">pdf</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-12 col-md-3 col-lg-3 mb-3 bm_inner">
                    <img src="{{ url('resources/imgs/merchant/WhiteCap5.png') }}" class="img-fluid shadow_m " title="FitIndia_Cap_images1" alt="FitIndia_Cap_images1" />
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 mb-3 bm_inner">
                    <img src="{{ url('resources/imgs/merchant/WhiteCap7.png') }}" class="img-fluid shadow_m " title="FitIndia_Cap_images2" alt="FitIndia_Cap_images2" />
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 mb-3 bm_inner">
                    <img src="{{ url('resources/imgs/merchant/BlueCap-1.png') }}" class="img-fluid shadow_m " title="FitIndia_Cap_images1" alt="FitIndia_Cap_images3" />
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 mb-3 bm_inner">
                    <img src="{{ url('resources/imgs/merchant/BlueCap-2.png') }}" class="img-fluid shadow_m " title="FitIndia_Cap_images1" alt="FitIndia_Cap_images4" />
                </div>
            </div>

        </div> --}}
    </div>


    <div class="base_mer ">
        <div class="base_mer_inner">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="pl-4 pr-4 text-center mt-3">Logo appearance on T-Shirt</h4>
                </div>
                <div class="azadi_area d-flex">
                </div>
                <div class="mt-3">
                    <div class=" mer_logo">
                        <p>Download Official Fit India Logos</p>
                        <div class="d-flex justify-content-between align-items-center mer_mobile">
                            <a class="mer_logo_form " href="{{ url('resources/imgs/national-sports-day-2024/design-blue-navy-t-shirt.zip') }}" data-icon="G">png</a>
                            <a class="mer_logo_form" href="javascript:void(0)" data-icon="G">jpg</a>
                            <a class="mer_logo_form" id="merchandisId" href="javascript:void(0)" data-icon="G">pdf</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-12 col-md-4 col-lg-4 mb-3 bm_inner">
                    <img src="{{ url('resources/imgs/national-sports-day-2024/design-blue-navy-t-shirt.png') }}" class="img-fluid shadow_m " title="AzadiKaAmritMahotsav_Hindi" alt="AzadiKaAmritMahotsav_Hindi" />
                </div>
                {{-- <div class="col-sm-12 col-md-4 col-lg-4 mb-3 bm_inner">
                    <img src="{{ url('resources/imgs/merchant/BlueT-shirt-4.png') }}" class="img-fluid shadow_m " title="AzadiKaAmritMahotsav_English" alt="AzadiKaAmritMahotsav_English" />
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 mb-3 bm_inner">
                    <img src="{{ url('resources/imgs/merchant/BlueT-shirt-5.png') }}" class="img-fluid shadow_m " title="AzadiKaAmritMahotsav_English" alt="Fitness ki dose aadha ghanta roz" />
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 mb-3 bm_inner">
                    <img src="{{ url('resources/imgs/merchant/BlueT-shirt-1.png') }}" class="img-fluid shadow_m " title="AzadiKaAmritMahotsav_English" alt="Fitness ki dose aadha ghanta roz" />
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 mb-3 bm_inner">
                    <img src="{{ url('resources/imgs/merchant/BlueT-shirt-2.png') }}" class="img-fluid shadow_m " title="AzadiKaAmritMahotsav_English" alt="Fitness ki dose aadha ghanta roz" />
                </div> --}}
            </div>
            {{-- <div class="row ">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class=" d-flex azadi_area1 justify-content-center">
                        <div class="azadi_area_inner">
                            <img class="shadow1" src="{{ url('resources/imgs/downloadofficiallogos/shirtlogo/png/Artboard2.png') }}" />
                            <div class="azadi_area_inner_download shadow1 azadi_area_inner_download1">
                                <a href="resources/imgs/downloadofficiallogos/shirtlogo/png/fitnessdose1.zip" data-icon="G">Download</a>
                            </div>
                        </div>
                        <div class="azadi_area_inner">
                            <img class="shadow1" src="{{ url('resources/imgs/downloadofficiallogos/shirtlogo/png/Artboard_img.png') }}" />
                            <div class="azadi_area_inner_download shadow1 azadi_area_inner_download1">
                                <a href="resources/imgs/downloadofficiallogos/shirtlogo/png/fitnessdose2.zip" data-icon="G">Download</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>  --}}
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="pl-4 pr-4 text-center mt-3">Logo appearance on T-Shirt</h4>
                </div>
                <div class="mt-3">
                    <div class=" mer_logo">
                        <p>Download Official Fit India Logos</p>
                        <div class="d-flex justify-content-between align-items-center mer_mobile">
                            <a class="mer_logo_form " href="{{ url('resources/imgs/national-sports-day-2024/t-shirt-design-front.zip') }}" data-icon="G">png</a>
                            <a class="mer_logo_form " href="javascript:void(0)" data-icon="G">jpg</a>
                            <a class="mer_logo_form " href="javascript:void(0)" data-icon="G">pdf</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-12 col-md-6 col-lg-6 mb-3 bm_inner">
                    <img src="{{ url('resources/imgs/national-sports-day-2024/t-shirt-design-front.png') }}" class="img-fluid shadow_m " title="Fitness ki dose aadha ghanta roz" alt="Fitness ki dose aadha ghanta roz" />
                </div>
                {{-- <div class="col-sm-12 col-md-6 col-lg-6 mb-3 bm_inner">
                    <img src="{{ url('resources/imgs/merchant/WhiteTshirt2.png') }}" class="img-fluid shadow_m " title="Fitness ki dose aadha ghanta roz" alt="Fitness ki dose aadha ghanta roz" />
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 mb-3 bm_inner">
                    <img src="{{ url('resources/imgs/merchant/WhiteTshirt.png') }}" class="img-fluid shadow_m " title="Fitness ki dose aadha ghanta roz" alt="Fitness ki dose aadha ghanta roz" />
                </div> --}}
            </div>


        </div>
    </div>
</div>




<script type="text/javascript">
    $(document).ready(function() {
        $('.carousel').carousel({
            interval: 100000000000,
            cycle: false
        })
        $('.carousel').carousel('pause');
    });
</script>



@endsection
