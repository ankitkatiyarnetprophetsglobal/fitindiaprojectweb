@extends('layouts.app')
@section('title', 'Fit India Schools | Fit India')
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
    .download-fit-india-btn{
        background-color: #1da1f2 !important;
        border: none !important;
    }
</style>


<div class="banner">
    <div class="row">
        <div class="col-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                <div class="carousel-inner">
                    <div class="carousel-item mer_banner active">
                        <img src="resources/imgs/Freedom_Run/Freedom-run-web-banner1.jpg" class="d-block w-100" alt="Fit-india-school-week-2021" title="Fit-india-school-week-2021">
                        <div class="some-absolute-div bannerPos1">
                            <div class="centered-in-absolute">
                                {{-- <form action="{{route('download-school-banner')}}" method="POST">
                                    @csrf
                                    <div class="form-group mb-1">
                                        <h1 class="s_name"><?php if (!empty($_REQUEST['school_name'])) {
                                                                echo strip_tags($_REQUEST['school_name']);
                                                            } ?> </h1>
                                    </div>
                                    <div class="text-center">
                                        <input type="hidden" name="banner_type" value="week_1">
                                        <input type="hidden" name="school_name" value="<?php if (!empty($_REQUEST['school_name'])) {
                                                                                            echo strip_tags($_REQUEST['school_name']);
                                                                                        } ?>">
                                        <button type="submit" name="banner_submit" value="Submit" class="mer_btn">Download</button>
                                    </div>

                                </form> --}}
                            </div>
                        </div>
                    </div>



                    <div class="carousel-item mer_banner">

                        <img src="resources/imgs/Freedom_Run/Freedom-run-web-banner2.jpg" class="d-block w-100" alt="Fit-india-quiz" title="Fit-india-quiz"> </a>
                        <div class="some-absolute-div bannerPos2">
                            <div class="centered-in-absolute">
                                {{-- <form action="{{route('download-school-banner')}}" method="POST">
                                    @csrf
                                    <div class="form-group mb-1">
                                        <h1 class="s_name"><?php if (!empty($_REQUEST['school_name'])) {
                                                                echo strip_tags($_REQUEST['school_name']);
                                                            } ?> </h1>
                                    </div>
                                    <div class="text-center">
                                        <input type="hidden" name="banner_type" value="week_2">
                                        <input type="hidden" name="school_name" value="<?php if (!empty($_REQUEST['school_name'])) {
                                                                                            echo strip_tags($_REQUEST['school_name']);
                                                                                        } ?>">
                                        <button type="submit" name="banner_submit" value="Submit" class="mer_btn">Download</button>
                                    </div>

                                </form> --}}
                            </div>
                        </div>
                    </div>


                    <div class="carousel-item mer_banner ">
                        <img src="resources/imgs/Freedom_Run/Freedom-run-web-banner2.jpg" class="d-block w-100" alt="mobile-app-banner" title="mobile-app-banner"> </a>
                        <div class="some-absolute-div bannerPos3">
                            <div class="centered-in-absolute">
                                {{-- <form action="{{route('download-school-banner')}}" method="POST">
                                    @csrf
                                    <div class="form-group mb-1">
                                        <h1 class="s_name"><?php if (!empty($_REQUEST['school_name'])) {
                                                                echo strip_tags($_REQUEST['school_name']);
                                                            } ?> </h1>
                                    </div>
                                    <div class="text-center">
                                        <input type="hidden" name="banner_type" value="week_3">
                                        <input type="hidden" name="school_name" value="<?php if (!empty($_REQUEST['school_name'])) {
                                                                                            echo strip_tags($_REQUEST['school_name']);
                                                                                        } ?>">
                                        <button type="submit" name="banner_submit" value="Submit" class="mer_btn">Download</button>
                                    </div>

                                </form> --}}
                            </div>
                        </div>
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



<!-- <div class="video_sec mer_banner">
    <img src="{{ url('resources/imgs/merchant/Artboard.jpg') }}" class="img-fluid" />
    <div class="some-absolute-div">
        <div class="centered-in-absolute">
            <form>
                <div class="form-group mb-1">
                    <h1>Vidhya Bharti Senior Secondary Public School </h1>
                </div>
                <div class="text-center">
                    <button type="button" name="create-event" value="Submit" class="mer_btn">Download</button>
                </div>

            </form>
        </div>
     
    </div>
</div> -->
<!-- <div class="merform mb-4 mt-4">
    <p style="margin-bottom:0;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
    <form>
        <div class="form-group mb-1">
            <input type="email" class="form-control " id="exampleFormControlInput1" placeholder="Enter Your School Name">
        </div>
        <div class="text-center">
            <input type="submit" name="create-event" value="Submit" class="mer_btn" />
        </div>
    </form>
</div> -->
</div>




<div class="container pt-5 pb-5">
    <div class="row">
        {{-- <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active"  data-bs-interval="1000">
                <img src="resources/imgs/Freedom_Run/Freedom-run-web-banner1.jpg" class="d-block w-100 img-fluid " alt="...">
              </div>
              <div class="carousel-item">
                <img src="resources/imgs/Freedom_Run/Freedom-run-web-banner2.jpg" class="d-block w-100 img-fluid " alt="...">
              </div>
              <div class="carousel-item">
                <img src="resources/imgs/Freedom_Run/Freedom-run-web-banner2.jpg" class="d-block w-100 img-fluid " alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div> --}}
    <div class="row mt-2 g-5">
        <div class="col-md-6 col-12">
            <img src="resources/imgs/Freedom_Run/5Artboard1@0.5x-100-1.jpg" alt="0.5x-100-1.jpg" class="tiles-img img-fluid">
            <div class="py-2 my-2">
                <button type="button" class="btn btn-primary rounded rounded-pill d-block mx-auto text-white download-fit-india-btn">   
                    {{-- <a class="text-white"  href="https://localhost/fitindiaweb_gitnew/resources/imgs/Freedom_Run/5Artboard1@0.5x-100-1.jpg" download data-icon="A">Download</a> --}}
                    <a class="text-white"  href="resources/imgs/Freedom_Run/5Artboard1@0.5x-100-1.zip" data-icon="A">Download</a>
                </button> 
            </div>
        </div>
        <div class="col-md-6 col-12">
            <img src="resources/imgs/Freedom_Run/5Artboard1@0.5x-100c.jpg" alt="0.5x-100c.jpg" class="tiles-img img-fluid">
            <div class="py-2 my-2">
                <button type="button" class="btn btn-primary rounded rounded-pill d-block mx-auto text-white download-fit-india-btn">   
                    {{-- <a class="text-white"  href="{{ url('resources/imgs/Freedom_Run/5Artboard1@0.5x-100c.jpg') }}" download data-icon="b">Download</a> --}}
                    <a class="text-white"  href="resources/imgs/Freedom_Run/5Artboard1@0.5x-100c.zip" data-icon="b">Download</a>
                </button> 
            </div>
        </div>
        <div class="col-md-6 col-12">
            <img src="resources/imgs/Freedom_Run/5Artboard1@0.75x-100b.jpg" alt="0.75x-100b.jpg" class="tiles-img img-fluid">
            <div class="py-2 my-2">
                <button type="button" class="btn btn-primary rounded rounded-pill d-block mx-auto text-white download-fit-india-btn">   
                    {{-- <a class="text-white"  href="{{ url('resources/imgs/Freedom_Run/5Artboard1@0.75x-100b.jpg') }}" download data-icon="c">Download</a> --}}
                    <a class="text-white"  href="resources/imgs/Freedom_Run/5Artboard1@0.75x-100b.zip" data-icon="c">Download</a>
                </button> 
            </div>
        </div>
        <div class="col-md-6 col-12">
            <img src="resources/imgs/Freedom_Run/5Artboard2@0.5x-100-2.jpg" alt="0.5x-100-2.jpg" class="tiles-img img-fluid">
            <div class="py-2 my-2">
                <button type="button" class="btn btn-primary rounded rounded-pill d-block mx-auto text-white download-fit-india-btn">   
                    {{-- <a class="text-white"  href="{{ url('resources/imgs/Freedom_Run/5Artboard2@0.5x-100-2.jpg') }}" download data-icon="d">Download</a> --}}
                    <a class="text-white"  href="resources/imgs/Freedom_Run/5Artboard2@0.5x-100-2.zip" data-icon="d">Download</a>
                </button> 
            </div>
        </div>
        <div class=" col-8">
            <img src="resources/imgs/Freedom_Run/5Artboard1@0.5x-100a.jpg" alt="5Artboard1@0.5x-100a.jpg" class="tiles-img img-fluid">
            <div class="py-2 my-2">
                <button type="button" class="btn btn-primary rounded rounded-pill d-block mx-auto text-white download-fit-india-btn">   
                    {{-- <a class="text-white"  href="{{ url('resources/imgs/Freedom_Run/5Artboard1@0.5x-100a.jpg') }}" data-icon="e" download>Download</a> --}}
                    <a class="text-white"  href="resources/imgs/Freedom_Run/5Artboard1@0.5x-100a.zip" data-icon="e">Download</a>
                </button> 
            </div>
        </div>
        <div class=" col-4">
            <img src="resources/imgs/Freedom_Run/5Artboard1@0.5x-100.jpg" alt="5Artboard1@0.5x-100.jpg" class="tiles-img img-fluid">
            <div class="py-2 my-2">
                <button type="button" class="btn btn-primary rounded rounded-pill d-block mx-auto text-white download-fit-india-btn">   
                    {{-- <a class="text-white"  href="{{ url('resources/imgs/Freedom_Run/5Artboard1@0.5x-100.jpg')}}" download data-icon="f">Download</a> --}}
                    <a class="text-white"  href="resources/imgs/Freedom_Run/5Artboard1@0.5x-100.zip" data-icon="f">Download</a>
                </button> 
            </div>
        </div>
        <div class=" col-12">
            <img src="resources/imgs/Freedom_Run/5Artboard1@0.75xd.png" alt="5Artboard1@0.75xd" class="tiles-img img-fluid">
            <div class="py-2 my-2">
                <button type="button" class="btn btn-primary rounded rounded-pill d-block mx-auto text-white download-fit-india-btn">   
                    {{-- <a class="text-white"  href="{{ url('resources/imgs/Freedom_Run/5Artboard1@0.75xd.png')}}" download data-icon="G">Download</a> --}}
                    <a class="text-white"  href="resources/imgs/Freedom_Run/5Artboard1@0.75xd.zip" data-icon="G">Download</a>
                </button> 
            </div>
        </div>
        <div class="col-12">
            <img src="resources/imgs/Freedom_Run/Freedom-run-web-banner1.jpg" class="tiles-img  img-fluid " alt="banner1.jpg">
            <div class="py-2 my-2">
                <button type="button" class="btn btn-primary rounded rounded-pill d-block mx-auto text-white download-fit-india-btn">   
                    {{-- <a class="text-white"  href="{{ url('resources/imgs/Freedom_Run/Freedom-run-web-banner1.jpg')}}" download data-icon="h">Download</a> --}}
                    <a class="text-white"  href="resources/imgs/Freedom_Run/Freedom-run-web-banner1.zip" data-icon="h">Download</a>
                </button> 
            </div>
        </div>
        <div class="col-12">
            <img src="resources/imgs/Freedom_Run/Freedom-run-web-banner2.jpg" class="tiles-img  img-fluid " alt="banner2.jpg">
            <div class="py-2 my-2">
                <button type="button" class="btn btn-primary rounded rounded-pill d-block mx-auto text-white download-fit-india-btn">   
                    {{-- <a class="text-white"  href="{{ url('resources/imgs/Freedom_Run/Freedom-run-web-banner2.jpg')}}" download data-icon="i">Download</a> --}}
                    <a class="text-white"  href="resources/imgs/Freedom_Run/Freedom-run-web-banner2.zip" data-icon="i">Download</a>
                </button> 
            </div>
        </div>
    </div>
   
</div>
</div>

{{-- <div class="row mt-2 g-5">
    <div class="col-md-6 col-12">
        <img src="resources/imgs/Freedom_Run/5Artboard 1@0.5x-100-1.jpg"  alt="" class="tiles-img img-fluid">
    </div>
    <div class="col-md-6 col-12">
        <img src="resources/imgs/Freedom_Run/5Artboard 1@0.5x-100c.jpg" alt="" class="tiles-img img-fluid">
    </div>
    <div class="col-md-6 col-12">
        <img src="resources/imgs/Freedom_Run/5Artboard 1@0.75x-100b.jpg" alt="" class="tiles-img img-fluid">
    </div>
    <div class="col-md-6 col-12">
        <img src="resources/imgs/Freedom_Run/5Artboard 2@0.5x-100-2.jpg" alt="" class="tiles-img img-fluid">
    </div>
    <div class=" col-8">
        <img src="resources/imgs/Freedom_Run/5Artboard 1@0.5x-100a.jpg" alt="" class="tiles-img img-fluid">
    </div>
    <div class=" col-4">
        <img src="resources/imgs/Freedom_Run/5Artboard 1@0.5x-100.jpg" alt="" class="tiles-img img-fluid">
    </div>
    <div class=" col-12">
        <img src="resources/imgs/Freedom_Run/5Artboard 1@0.75xd.png" alt="" class="tiles-img img-fluid">
    </div>
    <div class="col-12">
        <img src="resources/imgs/Freedom_Run/Freedom-run-web-banner1.jpg" class="tiles-img  img-fluid " alt="...">        
    </div>
    <div class="col-12">
        <img src="resources/imgs/Freedom_Run/Freedom-run-web-banner2.jpg" class="tiles-img  img-fluid " alt="...">        
    </div>
</div> --}}




<script type="text/javascript">
    $(document).ready(function() {
        $('.carousel').carousel({
            interval: 1000,
            cycle: true
        })
        $('.carousel').carousel('pause');
    });
</script>



@endsection