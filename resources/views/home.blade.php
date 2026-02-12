@extends('layouts.app')
@section('title', 'Fit India - Be fit ')
@section('content')

@php
$active_section = request()->segment(count(request()->segments()));
$active_section_id = trim($active_section);
@endphp

<script src="{{ asset('resources/js/confetti.browser.min') }}"></script>
<link src="resources/css/flexslider.css" type="text/css" media="screen">


  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
<style>
    .card-footer{display:none;}
</style>
  <style>
    /* Transparent overlay */
    #confetti-canvas {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 10000;      /* popup se bhi upar */
  pointer-events: none;
}

    #celebration-overlay {
      position: fixed;
      inset: 0;
      background: #000000cc;
      z-index: 99999999999999999;
      pointer-events: none;
    }

    /* Center text */
    #celebration-text {
      position: absolute;
      top: 40%;
      width: 100%;
      text-align: center;
      color: #fff;
    }

    #celebration-text h1 {
      font-size: 46px;
      font-weight: bold;
    }

    #celebration-text p {
      font-size: 18px;
    }

    /* Balloon container */
    #balloon-container {
      position: fixed;
      bottom: -150px;
      left: 0;
      width: 100%;
      height: 100%;
    }

    .balloon {
      position: absolute;
      bottom: -150px;
      width: 60px;
      height: 80px;
      border-radius: 50%;
      animation: floatUp linear forwards;
    }

    .balloon:after {
      content: '';
      position: absolute;
      width: 2px;
      height: 40px;
      background: #666;
      top: 80px;
      left: 50%;
    }

    @keyframes floatUp {
      from { transform: translateY(0); opacity: 1; }
      to   { transform: translateY(-120vh); opacity: 0; }
    }

    /* Mobile */
    @media (max-width: 768px) {
      #celebration-text h1 { font-size: 30px; }
      #celebration-text p { font-size: 16px; }
    }
  </style>

<script>
    jQuery.fn.liScroll = function(settings) {
        settings = jQuery.extend({
            travelocity: 0.03
        }, settings);
        return this.each(function() {
            var $strip = jQuery(this);
            $strip.addClass("newsticker")
            var stripHeight =1;
            $strip.find("li").each(function(i) {
                stripHeight += jQuery(this, i).outerHeight(true); // thanks to Michael Haszprunar and Fabien Volpi
            });
            var $mask = $strip.wrap("<div class='mask'></div>");
            var $tickercontainer = $strip.parent().wrap("<div class='tickercontainer'></div>");
            var containerHeight = $strip.parent().parent().height(); //a.k.a. 'mask' width
            var startPosition = .5;
            // alert(stripHeight)
            //$strip.height(stripHeight);
            var totalTravel = stripHeight;
            var defTiming = (totalTravel / settings.travelocity)-1200; // thanks to Scott Waye
            function scrollnews(spazio, tempo) {
                $strip.animate({
                    top: '-=' + spazio
                }, tempo, "linear", function() {
                    $strip.css("top", startPosition);
                    scrollnews(totalTravel, defTiming);
                });
            }
            scrollnews(totalTravel, defTiming);
            $strip.hover(function() {
                    jQuery(this).stop();
                },
                function() {
                    var offset = jQuery(this).offset();
                    var residualSpace = offset.top;
                    var residualTime = (residualSpace / settings.travelocity)-1200;
                    // alert(residualSpace)
                    //   var residualTime = residualSpace/settings.travelocity;
                    scrollnews(residualSpace, residualTime);
                });
        });
    };

    $(function() {
        $("ul#ticker01").liScroll();
    });
</script>

<script type="text/javascript">
    $(window).on('load', function() {
        $('#popupmodal').modal('show');
    });
</script>
<style>
    .news-item{width: 100%;}
        .counter {
    animation-duration: 1s;
    animation-delay: 0s;
    /* font-size:32px; */
    }

    .counter_area>span{
        font-size:32px;
    }
    .border-right_1{
    border-right: 1px dashed black;
    }
    .count_div_h{
    border: 1px dotted #dfdfdf;
    padding: 15px;
    text-align:center;
    }
    .pad_div_counter{
    padding: 0 40px 0 10px;
    }
    .free_head{
    color: #292775;
    position: relative;
    margin-bottom: 30px;
    }
    .free_head::before{
        content: '';
    width: 100px;
    height: 2px;
    position: absolute;
    top: 35px;
    right: 38px;
    background: #ff6000;
    display: block;
    }

        .holder ul li a {
        color: #f60 !important;
    }

    @media (max-width: 320px) {
        .free_head {
            font-size: 20px;
        }
        .free_head::before {
        width: 68px;
        top: 26px;
        right: 11px;
    }
        .count_div_h {padding:15px 5px;}


    }

    @media (max-width: 411px) {
        .free_head::before {
        content: '';
        width: 88px;
        height: 2px;
        position: absolute;
        top: 33px;
        right: 14px;
        background: #ff6000;
        display: block;
    }

    }
    .my-new-flow .new_ticer img{
        width: 38px;
        margin-right: 8px;
    }
    .my-new-flow .holder ul li a{
    color: #000 !important;
    text-decoration: underline !important;
    }

</style>
{{-- <div class="container">
     <div id="celebration-overlay">
          <canvas id="confetti-canvas"></canvas>
    <div id="celebration-text">
      <h1>🎂 Sundays on Cycle turns ONE! 🎉</h1>
      <p>On December 21, 2025, let’s celebrate the ride that brought India together.Your passion fuels the movement.</p>
      <p>🌍 Join the celebration. Ride from wherever you are!</p>
    </div>

    <div id="balloon-container"></div>
  </div>
</div> --}}
<div class="container-fluid">
    <div class="banner">
        <div class="row">
            <div class="col-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators on-print">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    </ol>

                    <div class="carousel-inner">
                        @if(count($websitebanner) > 0)
                            @foreach($websitebanner as $key => $banner)
                                <div class="{{ $banner['active_css'] }}">
                                    <a href="{{ $banner['landing_url'] }}">
                                        <img src="{{ $banner['banner_url'] }}" class="d-block w-100" alt="{{ $banner['name'] }}" title="{{ $banner['name'] }}">
                                    </a>
                                </div>
                            @endforeach
                        @endif

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

    <!-- ------------------------About  section add--------------------------------- -->

    <section id="{{ $active_section_id }}">
        <div class="container">
            <div class="row r-m">
                <div class="col-sm-12 col-md-12  col-lg-12">

                </div>
            </div>
            <div class="row r-m">
                <div class="col-sm-12 col-md-12 col-lg-12">
                <h1 class="a_heading about_head headH1">{{ __('home_content.About_Fit_India_Movement')}} <!--About Fit India Movement--></h1>
                    <p class="text-justify ab_para"> <span class="logo-fitindia"> <img
                                src="{{asset('resources/imgs/fit-india_logo.png') }}" alt="Fit India logo"
                                title="Fit India" class="img-fluid"></span> {{ __('home_content.Fit_India_Movement')}} </p>
                    <ul class="aboutLi">
                        <li>{{ __('home_content.Promote_Fitness')}} <!--To promote fitness as easy, fun and free --></li>
                        <li>{{ __('home_content.Tospread_Awareness')}} <!--To spread awareness on fitness and various physical activities that promote fitness through
                            focused campaigns--></li>
                        <li>{{ __('home_content.Toencourage')}} <!--To encourage indigenous sports--></li>
                        <li>{{ __('home_content.Tomake_Fitness')}} <!--To make fitness reach every school, college/university, panchayat/village, etc.--></li>
                        <li>{{ __('home_content.Tocreate_Platform')}} <!--To create a platform for citizens of India to share information, drive awareness and
                            encourage sharing of personal fitness stories--></li>
                    </ul>
                </div>

				<div class="col-sm-12 col-md-12 col-lg-12">


        <!----------------------- new ticker ----------------------------------->

            {{-- new row comment --}}
         <div class="row align-items-start mt-3">
                <div class="col-lg-4 col-md-6 col-12">
                   <a href="{{ url('event-archives') }}" class="evnt-archv"><h4>Events Archive</h4>
                <div id="m_slider">
                    <img class="m_Slides"  src="{{asset('resources/imgs/event_home/img_1.jpg') }}" width="100%"  alt="Pahari Dance">
                    <img class="m_Slides"  src="{{asset('resources/imgs/event_home/img_2.jpg') }}" width="100%" alt="Panjabi Dance">
                    <img  class="m_Slides" src="{{asset('resources/imgs/event_home/img_3.jpg') }}" width="100%" alt="Chlidren Exercise">
                    <img  class="m_Slides" src="{{asset('resources/imgs/event_home/img_4.jpg') }}" width="100%" alt="Children Game">
                    <img  class="m_Slides" src="{{asset('resources/imgs/event_home/img_5.jpg') }}" width="100%" alt="Sword Fight">
                    <img  class="m_Slides" src="{{asset('resources/imgs/event_home/img_6.jpg') }}" width="100%" alt="Yog Dance Event">
                    <img  class="m_Slides" src="{{asset('resources/imgs/event_home/img_7.jpg') }}" width="100%" alt="Clamping Children">
                    <img  class="m_Slides" src="{{asset('resources/imgs/event_home/img_8.jpg') }}" width="100%" alt="Army Flag March">
                    <img  class="m_Slides" src="{{asset('resources/imgs/event_home/img_9.jpg') }}" width="100%" alt="Morning Walk ">
                    <img  class="m_Slides" src="{{asset('resources/imgs/event_home/img_10.jpg') }}" width="100%" alt="Army Flag March in border">
                    <img  class="m_Slides" src="{{asset('resources/imgs/event_home/img_11.jpg') }}" width="100%" alt="Children Flag March">
                    <img  class="m_Slides" src="{{asset('resources/imgs/event_home/img_12.jpg') }}" width="100%" alt="Girls Flag March">
                </div>
                </a>
             </div>
             <div class="col-lg-4 col-md-6 col-12">
                    <div class="card panel-default new_ticer mt-0 shadow1" style="border: 0px solid rgba(0,0,0,.125);">
                <div class="card-header new_area_div">
                    <b class="font_b">{{ __('home_content.Bulletin')}}  <!--Bulletin-->
                        <i class="fa fa-angle-double-right new_i" aria-hidden="true" ></i>
                    </b>
                </div>
                     <div class="card-body ">
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12 rp ">
                                <div class="holder">
                                    <ul id="ticker01">
                                        <li>
                                           <div class="n_head">{{ __('home_content.fitness')}} <!--Fitness--></div>
                                           <div class="down_area">{{ __('home_content.Download_fitness')}} <!--Download : Fitness ki dose Aadha Ghanta Roz.--></div>
                                               <div class=" mob_view">
                                                    <div class="news_date_n">{{ __('home_content.September')}} <!--September--> 29, 2019
                                                       <a class="getlink" href="javascript:void(0);" data-link="https://play.google.com/store/apps/details?id=com.sai.fitIndia">{{ __('home_content.Read_more')}}  <!--Read more-->..</a>
                                                    </div>
                                                </div>
                                        </li>

                                        <li>
                                                <div class="n_head"> {{ __('home_content.iOS_App')}} <!--iOS App--></div>
                                                <div class="down_area"> {{ __('home_content.mobile_app_iOS')}} <!--Download :Fit India mobile app iOS.--></div>
                                                <div class=" mob_view">
                                                    <div class="news_date_n">{{ __('home_content.Augest')}} <!--Augest--> 29, 2021
                                                        <a class="getlink" href="javascript:void(0);" data-link="https://apps.apple.com/us/app/fit-india-mobile-app/id1581063890">{{ __('home_content.Read_more')}} <!--Read more-->..</a>
                                                    </div>
                                                </div>
                                        </li>

                                        <li>
                                            <div class="n_head">{{ __('home_content.Android_App')}} <!--Android App--></div>
                                            <div class="down_area">{{ __('home_content.mobile_app_android')}} <!--Download :Fit India mobile app android.--></div>
                                            <div class=" ">
                                                <div class="news_date_n">{{ __('home_content.Augest')}} <!--Augest--> 29, 2021
                                                    <a class="getlink" href="javascript:void(0);" data-link="https://play.google.com/store/apps/details?id=com.sai.fitIndia">{{ __('home_content.Read_more')}} <!--Read more-->..</a>
                                                </div>
                                            </div>
                                        </li>

                                          <li>
                                                <div class="n_head"> School Week 2021 </div>
                                                <div class="down_area">Fit India School week 2021 (14th Nov - 31st Jan)</div>
                                            </li>
                                        <li>
                                            <div class="n_head">{{ __('home_content.expression-of-interest-fit-india')}} <!--Android App--></div>
                                            <div class=" ">
                                                <div class="news_date_n">{{ __('home_content.Augest')}} <!--Augest--> 18, 2025
                                                    <a class="getlink" href="{{ url('resources/pdf/expression-of-Interest-fit-India.pdf') }}">{{ __('home_content.Read_more')}} <!--Read more-->..</a>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
                 <div class="col-lg-4 col-md-6 col-12 my-new-flow">
                    <div class="card panel-default new_ticer mt-0 shadow1" style="border: 0px solid rgba(0,0,0,.125);">
                <div class="card-header new_area_div">
                    <b class="font_b">{{ __('home_content.home-news-letter')}}  <!--Bulletin-->
                        <i class="fa fa-angle-double-right new_i" aria-hidden="true" ></i>
                    </b>
                </div>
                    {{-- {{ dd() }} --}}
                    @php
                        if(count($newsletter_data) > 3){
                            $scrollbaron = "ticker01";
                        }
                    @endphp
                    @if (count($newsletter_data) > 0)
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-lg-12 rp ">
                                    <div class="holder ">
                                        <ul id="{{ $scrollbaron ?? '' }}" style="list-style: none">
                                            @foreach($newsletter_data as $key => $value)
                                                <li>
                                                    <div class="" style="font-size:14px;">
                                                        <img src="resources/imgs/icon/newsletterbulletpoint.png" class="img-fluid mini_pic"/>
                                                        <a href="{{ url($value['anchor_link']) ?? '' }}" target="_blank">{{ $value['newsletter_title'] ?? '' }}</a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
             </div>
         </div>
    </div>



    </section>




    <!-- app store button banner -->
    <section  class="section_r_p" style="padding: 0px 0px">
        <div class="container-fluid">
    <!-- this section commented -->
           <div class="row mobile_app_base" >
               <div class="col-sm-12 col-md-12 d-flex justify-content-between align-items-end">
                    <div class="mini_area">
                        <img src="{{asset('resources/imgs/home/mobile_and_app.png') }}" class="fluid-img " />
                    </div>

                    <div class="mobile_area_div text-center" >
                        <img src="{{asset('resources/imgs/home/mobileapplogo.png') }}"  class="mobile_area_div_cust" alt="Apple" title="Apple Button"/>

                        <div>
                            <p style="font-size:16px;">{{ __('home_content.CheckFitnessLevel')}} <!--Check your Fitness Level Score, Track your Steps.Track your Sleep, Track your calorie intake,Be Part of Fit India Events, Get customized DietPlans Age-wise fitness level--></p>
                            <div class="app_btn" style="padding-bottom: 20px;">
                                <a href="https://apps.apple.com/us/app/fit-india-mobile-app/id1581063890"><img src="{{asset('resources/imgs/home/apple.png') }}" alt="Apple" title="Apple Button"/></a>
                                <a href="https://play.google.com/store/apps/details?id=com.sai.fitIndia"><img src="{{asset('resources/imgs/home/google.png') }}" alt="Google" title="Google Button"/></a>
                            </div>
                        <div>

                    </div>


                    </div>
                    </div>

                    <div class="mini_area mini_area_left" style="width:35%">
                    <img src="resources/imgs/home/mobile.png" class="fluid-img" />
                    </div>
                <div>
            </div>

                </div>
            </div>
             <!-- close this section commented-->
         </div>
    </section>
<!-- end app store button banner -->


    <!-- video section -->

   <section class="videobg">
        <div class="container">
        <div class="row ">
                <div class="col-sm-12 col-md-12 flex-column">
                    <div class="sec_heading">
                        <h2 class="heading headvideo">{{ __('home_content.Fitness_Mantra')}} <!--Fitness Mantra--></h2>
                    </div>
                </div>
            </div>
             <div class="row on-print">
                <div class="col-sm-12 col-md-4 flex-column">
                    <div class="videos_colm">
                        <div class="video_area">
                        <div class="ytb-video" >
                         </div>
                            <video poster="resources/videos/Fit-India-Quiz-60-Sec.jpg" controls="">
                                <source type="video/mp4" src="resources/videos/Fit-India-Quiz-60-Sec.mp4">
                            </video>

                            <p class="video-title"><strong>{{ __('home_content.FitIndia_Quiz')}} <!--Fit India Quiz--></strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="videos_colm">
                        <div class="video_area">
                        <div class="ytb-video" >
                        </div>


                        <video poster="resources/videos/fitindiaapp.jpg" controls="">
                                <source type="video/mp4" src="resources/videos/fitindiaappvideo.mp4">
                            </video>
                            <p class="video-title"><strong> {{ __('home_content.FitIndia_MobileApp')}} <!--Fit India Mobile App--></strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="videos_colm">
                        <div class="video_area">
                        <div class="ytb-video" >

                        </div>


                        <video poster="resources/videos/mints-video-cover.jpg" controls="">
                                <source type="video/mp4" src="resources/videos/30mins.mp4">
                            </video>
                            <p class="video-title"><strong> {{ __('home_content.Fitness_KiDose')}} <!--Fitness Ki Dose Aadha Ghanta Roz--></strong></p>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- ------------------------New section add--------------------------------- -->

   <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="sec_heading">
                        <h2 class="heading headvideo">{{ __('home_content.Insights')}} <!--Insights--></h2>

                    </div>
                    <p class="text-center">{{ __('home_content.campaigns')}} </p>
                </div>
            </div>
            <div class="row home-bx-3">
                <div class="col-sm-12 col-md-4 col-lg-4 n_sec hover_a">
                    <div class="shar_div shadow  bx">
                        <a href="{{ url('fit-india-school') }}">
                            <img src="resources/images/home-thumbs/school-week-certificate.jpg" class="img-fluid img_radius_lr" alt="school-week-certificate" title="School Certification" />
                            <p>{{ __('home_content.School_Certification')}} <!--School Certification--></p>
                        </a>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4  n_sec hover_a">
                    <div class="shar_div shadow  bx">
                        <a href="{{ url('fit-india-youth-club-certification') }}">
                            <img src="resources/images/home-thumbs/youth-club.jpg" class="img-fluid img_radius_lr"
                                alt="Youth Club" title="Youth Club Certification" />
                            <p>{{ __('home_content.Youth_Club_Certification')}} <!--Youth Club Certification--></p>
                        </a>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 n_sec hover_a">
                    <div class="shar_div shadow  bx">
                        <a href="{{ url('champion-and-ambassador') }}">
                            <img src="resources/images/home-thumbs/champion_ambassador.jpg"
                                class="img-fluid img_radius_lr" alt="Ambassadors / Champions"
                                title="Ambassadors & Champions" />
                            <p>{{ __('home_content.Ambassadors_Champions')}}  <!--Ambassadors & Champions--></p>
                        </a>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 n_sec hover_a">
                    <div class="shar_div shadow  bx">
                        <a href="{{ url('fitnessprotocols') }}">
                            <img src="resources/images/home-thumbs/fitness_protocals.jpg"
                                class="img-fluid img_radius_lr" alt="Protocols" title="Fitness Protocols" />
                            <p>{{ __('home_content.Fitness_Protocols')}} <!--Fitness Protocols--></p>
                        </a>
                    </div>
                </div>



                <div class="col-sm-12 col-md-4 col-lg-4 n_sec hover_a">
                    <div class="shar_div shadow  bx">
                        <a href="{{ url('indigenousgames') }}">
                            <img src="resources/images/home-thumbs/indegenous.jpg" class="img-fluid img_radius_lr"
                                alt="Indigenous" title="Indigenous Games" />
                            <p>{{ __('home_content.Indigenous_Games')}} <!--Indigenous Games--></p>
                        </a>
                    </div>
                </div>

                  <div class="col-sm-12 col-md-4 col-lg-4 n_sec hover_a">
                    <div class="shar_div shadow  bx">
                        <a href="{{ url('fit-india-yoga-centres') }}">
                            <img src="resources/images/home-thumbs/yoga.jpg"
                                class="img-fluid img_radius_lr" alt="fit-india-yoga-centres" title="fit-india-yoga-centres" />
                            <p>{{ __('home_content.Fit_India_Yoga')}} <!--Fit India Yoga Centres--></p>
                        </a>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4  n_sec hover_a">
                    <div class="shar_div shadow  bx">
                        <a href="{{ url('schooldashboard') }}">
                            <img src="resources/images/home-thumbs/Dashboard.jpg" class="img-fluid img_radius_lr"
                                alt="Dashboard" title="Fit India Dashboard" />
                            <p>{{ __('home_content.Fit_India_Dashboard')}} <!--Fit India Dashboard--> </p>
                        </a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 n_sec hover_a">
                    <div class="shar_div shadow  bx">
                        <a href="{{ url('your-stories') }}">
                            <img src="resources/images/home-thumbs/share-your-story.jpg" class="img-fluid img_radius_lr"
                                alt="Share Story" title="Share Your Story" />
                            <p>{{ __('home_content.Share_Your_Story')}}  <!--Share Your Fitness Story--></p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section style="background: rgb(2 1 129 / 5%);">
    <!-- ---------------------Social Feeds-------------------------------------------- -->
    <div class="container on-print">
        <div class="row">
            <div class="col-12">
                <!--  <h3 class="heading headvideo">{{ __('home_content.Social_Feeds')}}</h3> -->
                <h3 class="heading headvideo">{{ __('home_content.Social_Feeds')}} <!--Social Feeds--></h3>
            </div>
        </div>
        <div id="container">

            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="parent_child_div style-4">
                        <div class=" child_div ">
                        <blockquote class="twitter-tweet"><p lang="hi" dir="ltr">Live - आजादी के अमृत महोत्सव पर 75 करोड़ सूर्यनमस्कार के लक्ष्य के साथ, आज 18वें दिन का सूर्यनमस्कार का अभ्यास<a href="https://twitter.com/hashtag/75%E0%A4%95%E0%A4%B0%E0%A5%8B%E0%A4%A1%E0%A4%BC_%E0%A4%B8%E0%A5%82%E0%A4%B0%E0%A5%8D%E0%A4%AF%E0%A4%A8%E0%A4%AE%E0%A4%B8%E0%A5%8D%E0%A4%95%E0%A4%BE%E0%A4%B0?src=hash&amp;ref_src=twsrc%5Etfw">#75करोड़_सूर्यनमस्कार</a> <a href="https://twitter.com/yogasanaindia?ref_src=twsrc%5Etfw">@yogasanaindia</a> <a href="https://twitter.com/WorldYogasana?ref_src=twsrc%5Etfw">@WorldYogasana</a> <a href="https://twitter.com/FitIndiaOff?ref_src=twsrc%5Etfw">@FitIndiaOff</a><br>Registration On <a href="https://t.co/6Fwz8XaXwF">https://t.co/6Fwz8XaXwF</a> <a href="https://t.co/24G5k2aGlL">https://t.co/24G5k2aGlL</a></p>&mdash; स्वामी रामदेव (@yogrishiramdev) <a href="https://twitter.com/yogrishiramdev/status/1487966855939559426?ref_src=twsrc%5Etfw">January 31, 2022</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="parent_child_div style-4">
                        <div class=" child_div ">
                        <blockquote class="twitter-tweet"><p lang="en" dir="ltr">Finished 53rd full <a href="https://twitter.com/hashtag/marathon?src=hash&amp;ref_src=twsrc%5Etfw">#marathon</a> today. Dedicating to all covid warriors esp <a href="https://twitter.com/hashtag/HealthcareHeroes?src=hash&amp;ref_src=twsrc%5Etfw">#HealthcareHeroes</a> and <a href="https://twitter.com/hashtag/bankers?src=hash&amp;ref_src=twsrc%5Etfw">#bankers</a>. Determination is the key to all achievements. <a href="https://twitter.com/FitIndiaOff?ref_src=twsrc%5Etfw">@FitIndiaOff</a> <a href="https://twitter.com/ianuragthakur?ref_src=twsrc%5Etfw">@ianuragthakur</a> <a href="https://twitter.com/KirenRijiju?ref_src=twsrc%5Etfw">@KirenRijiju</a> <a href="https://twitter.com/Abhinav_Bindra?ref_src=twsrc%5Etfw">@Abhinav_Bindra</a> <a href="https://twitter.com/kmmalleswari?ref_src=twsrc%5Etfw">@kmmalleswari</a> <a href="https://t.co/7aCHEHhiZ1">pic.twitter.com/7aCHEHhiZ1</a></p>&mdash; Nixon Joseph (@NixonJoseph1708) <a href="https://twitter.com/NixonJoseph1708/status/1487830971013423105?ref_src=twsrc%5Etfw">January 30, 2022</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="parent_child_div style-4">
                        <div class=" child_div ">
                        <blockquote class="twitter-tweet"><p lang="en" dir="ltr"><a href="https://twitter.com/hashtag/SuryaNamaskar?src=hash&amp;ref_src=twsrc%5Etfw">#SuryaNamaskar</a> practice with Special Operation Group SOG Police Jawans, Chandaka, Bhubaneswar,<a href="https://twitter.com/hashtag/Odisha?src=hash&amp;ref_src=twsrc%5Etfw">#Odisha</a><a href="https://twitter.com/75suryanamaskar?ref_src=twsrc%5Etfw">@75suryanamaskar</a><a href="https://twitter.com/WorldYogasana?ref_src=twsrc%5Etfw">@WorldYogasana</a> <a href="https://twitter.com/FitIndiaOff?ref_src=twsrc%5Etfw">@FitIndiaOff</a> <a href="https://twitter.com/yogasanaindia?ref_src=twsrc%5Etfw">@yogasanaindia</a> <a href="https://twitter.com/iccr_hq?ref_src=twsrc%5Etfw">@iccr_hq</a> <a href="https://twitter.com/PMOIndia?ref_src=twsrc%5Etfw">@PMOIndia</a> <a href="https://twitter.com/mannkibaat?ref_src=twsrc%5Etfw">@mannkibaat</a><br> <a href="https://t.co/xxqhQbRNiF">https://t.co/xxqhQbRNiF</a> <a href="https://twitter.com/hashtag/750million_Suryanamaskar?src=hash&amp;ref_src=twsrc%5Etfw">#750million_Suryanamaskar</a> <a href="https://twitter.com/sudhansu_bst?ref_src=twsrc%5Etfw">@sudhansu_bst</a> <a href="https://twitter.com/bst_official?ref_src=twsrc%5Etfw">@bst_official</a> <a href="https://t.co/x7NkZUOAtv">pic.twitter.com/x7NkZUOAtv</a></p>&mdash; Dr Jaideep Arya (@swabhimani1) <a href="https://twitter.com/swabhimani1/status/1487687122483961857?ref_src=twsrc%5Etfw">January 30, 2022</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="parent_child_div style-4">
                        <div class=" child_div ">
                                <blockquote class="twitter-tweet"><p lang="en" dir="ltr">As a part of commemoration of Azadi Ka <a href="https://twitter.com/hashtag/AmritMahotsav?src=hash&amp;ref_src=twsrc%5Etfw">#AmritMahotsav</a>, <a href="https://twitter.com/hashtag/FitIndia?src=hash&amp;ref_src=twsrc%5Etfw">#FitIndia</a> Mobile App has been launched. App is available in both Android and iOS platforms. <br><br>Links for download:-<a href="https://t.co/FQJYDCg717">https://t.co/FQJYDCg717</a><a href="https://t.co/tCqjR1b0dt">https://t.co/tCqjR1b0dt</a> <a href="https://t.co/GKQOuQNsI0">pic.twitter.com/GKQOuQNsI0</a></p>&mdash; India in Sao Paulo (@cgisaopaulo) <a href="https://twitter.com/cgisaopaulo/status/1487528733594501121?ref_src=twsrc%5Etfw">January 29, 2022</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                            </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="parent_child_div style-4">
                        <div class=" child_div ">
                        <blockquote class="twitter-tweet"><p lang="en" dir="ltr"><a href="https://twitter.com/hashtag/FitIndia?src=hash&amp;ref_src=twsrc%5Etfw">#FitIndia</a> Mobile App is one of its kind App wherein people can assess their fitness parameters through a series of simple tests and can improve their fitness on regular basis. <br><br>Download the App today !<br><br>Android: <a href="https://t.co/tQsUv1D7Hk">https://t.co/tQsUv1D7Hk</a><br><br>iOS: <a href="https://t.co/ab86cWiP3p">https://t.co/ab86cWiP3p</a> <a href="https://t.co/JNmNyxwq1s">pic.twitter.com/JNmNyxwq1s</a></p>&mdash; India in Uzbekistan (@amb_tashkent) <a href="https://twitter.com/amb_tashkent/status/1487447639419686914?ref_src=twsrc%5Etfw">January 29, 2022</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                    </div>
                </div>






                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="parent_child_div style-4">
                        <div class=" child_div ">
                            <blockquote class="twitter-tweet">
                                <p lang="en" dir="ltr">A privilege to see <a href="https://twitter.com/Neeraj_chopra1?ref_src=twsrc%5Etfw">@Neeraj_chopra1</a> share his experiences, life lessons, tips with children at <a href="https://twitter.com/sanskardham_In?ref_src=twsrc%5Etfw">@sanskardham_In</a> Sports Academy.<a href="https://twitter.com/hashtag/NeerajChopra?src=hash&amp;ref_src=twsrc%5Etfw">#NeerajChopra</a> <a href="https://twitter.com/hashtag/NeerajChopraatSSA?src=hash&amp;ref_src=twsrc%5Etfw">#NeerajChopraatSSA</a> <a href="https://twitter.com/narendramodi?ref_src=twsrc%5Etfw">@narendramodi</a> <a href="https://twitter.com/ianuragthakur?ref_src=twsrc%5Etfw">@ianuragthakur</a> <a href="https://twitter.com/Media_SAI?ref_src=twsrc%5Etfw">@Media_SAI</a> <a href="https://twitter.com/FitIndiaOff?ref_src=twsrc%5Etfw">@FitIndiaOff</a> <a href="https://t.co/6Sbrg67Kc2">https://t.co/6Sbrg67Kc2</a> <a href="https://t.co/CxcmaGdpz6">pic.twitter.com/CxcmaGdpz6</a></p>&mdash; Durgesh Agarwal (@durgesh_agarwal) <a href="https://twitter.com/durgesh_agarwal/status/1467377041200795651?ref_src=twsrc%5Etfw">December 5, 2021</a>
                            </blockquote>
                            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="parent_child_div style-4">
                        <div class=" child_div ">
                        <blockquote class="twitter-tweet"><p lang="en" dir="ltr">Day#1420 of running min 10 km/day Total-16770 km<br>(from 16/03/2018)<br>2022 YTD -374 km 😊<a href="https://twitter.com/hashtag/runners?src=hash&amp;ref_src=twsrc%5Etfw">#runners</a> <a href="https://twitter.com/hashtag/sports?src=hash&amp;ref_src=twsrc%5Etfw">#sports</a> <a href="https://twitter.com/hashtag/fitness?src=hash&amp;ref_src=twsrc%5Etfw">#fitness</a> <a href="https://twitter.com/hashtag/athletics?src=hash&amp;ref_src=twsrc%5Etfw">#athletics</a> <a href="https://twitter.com/hashtag/streakrunning?src=hash&amp;ref_src=twsrc%5Etfw">#streakrunning</a> <a href="https://twitter.com/hashtag/NewIndiaFitindia?src=hash&amp;ref_src=twsrc%5Etfw">#NewIndiaFitindia</a> <a href="https://twitter.com/hashtag/RunningStreak?src=hash&amp;ref_src=twsrc%5Etfw">#RunningStreak</a><a href="https://twitter.com/hashtag/running?src=hash&amp;ref_src=twsrc%5Etfw">#running</a> <a href="https://twitter.com/hashtag/marathoner?src=hash&amp;ref_src=twsrc%5Etfw">#marathoner</a> <a href="https://twitter.com/hashtag/runsteak?src=hash&amp;ref_src=twsrc%5Etfw">#runsteak</a> <a href="https://twitter.com/hashtag/ultramarathone?src=hash&amp;ref_src=twsrc%5Etfw">#ultramarathone</a> <a href="https://t.co/MjS04HmPGx">pic.twitter.com/MjS04HmPGx</a></p>&mdash; The_Streak_Runner (@RunnerStreak) <a href="https://twitter.com/RunnerStreak/status/1488732953979273216?ref_src=twsrc%5Etfw">February 2, 2022</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="parent_child_div style-4">
                        <div class=" child_div ">
                        <blockquote class="twitter-tweet"><p lang="en" dir="ltr">Don&#39;t try this without practice or without guidance ⛔‼️ <a href="https://twitter.com/SumitSigh3?ref_src=twsrc%5Etfw">@SumitSigh3</a> <a href="https://twitter.com/hashtag/itrainlikwvidyutjammwal?src=hash&amp;ref_src=twsrc%5Etfw">#itrainlikwvidyutjammwal</a><a href="https://twitter.com/VidyutJammwal?ref_src=twsrc%5Etfw">@VidyutJammwal</a> <a href="https://twitter.com/FitIndiaOff?ref_src=twsrc%5Etfw">@FitIndiaOff</a> <a href="https://twitter.com/hashtag/jammwalions?src=hash&amp;ref_src=twsrc%5Etfw">#jammwalions</a> <a href="https://twitter.com/hashtag/fitness?src=hash&amp;ref_src=twsrc%5Etfw">#fitness</a> <a href="https://twitter.com/hashtag/HappyNewYear?src=hash&amp;ref_src=twsrc%5Etfw">#HappyNewYear</a> <a href="https://twitter.com/hashtag/Trending?src=hash&amp;ref_src=twsrc%5Etfw">#Trending</a> <a href="https://t.co/dSEl2RqETf">pic.twitter.com/dSEl2RqETf</a></p>&mdash; Sumit Sigh (@SumitSigh3) <a href="https://twitter.com/SumitSigh3/status/1477448473616080897?ref_src=twsrc%5Etfw">January 2, 2022</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                    </div>
                </div>



                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="parent_child_div style-4">
                        <div class=" child_div ">
                            <blockquote class="twitter-tweet"><p lang="en" dir="ltr">&quot;&quot;EVERY Pushup🔼 will push u up🔼 to greater level&quot;&quot;<br><br>20 PUSHUP CHALLENGE<br> DO PUSHUP DAILY I<br>and tag me..👇<a href="https://twitter.com/hashtag/FitIndia?src=hash&amp;ref_src=twsrc%5Etfw">#FitIndia</a> <a href="https://twitter.com/FitIndiaOff?ref_src=twsrc%5Etfw">@FitIndiaOff</a> <a href="https://twitter.com/AyushmanNHA?ref_src=twsrc%5Etfw">@AyushmanNHA</a> <a href="https://twitter.com/Mausam234?ref_src=twsrc%5Etfw">@Mausam234</a> <a href="https://twitter.com/shinu_maan?ref_src=twsrc%5Etfw">@shinu_maan</a> <a href="https://twitter.com/Namzzy123?ref_src=twsrc%5Etfw">@Namzzy123</a> <a href="https://twitter.com/akashshuklaji?ref_src=twsrc%5Etfw">@akashshuklaji</a> <a href="https://twitter.com/VinayKrKatiyar?ref_src=twsrc%5Etfw">@VinayKrKatiyar</a> <a href="https://twitter.com/brandedkavita?ref_src=twsrc%5Etfw">@brandedkavita</a> <a href="https://twitter.com/shiv_shaktii?ref_src=twsrc%5Etfw">@shiv_shaktii</a> <a href="https://twitter.com/VandanaSV77?ref_src=twsrc%5Etfw">@VandanaSV77</a> <a href="https://twitter.com/varsha_bhat?ref_src=twsrc%5Etfw">@varsha_bhat</a> @KaranVi2710918 <a href="https://t.co/COoO7xwqIX">pic.twitter.com/COoO7xwqIX</a></p>&mdash; SURYA (@stockboom34) <a href="https://twitter.com/stockboom34/status/1490280035357708289?ref_src=twsrc%5Etfw">February 6, 2022</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="parent_child_div style-4 ">
                        <div class=" child_div ">
                            <blockquote class="twitter-tweet"><p lang="en" dir="ltr">This is like dreams comes true, two dreams are completed today 1. 💯 Km and 2. Full SP ring Road on <a href="https://twitter.com/mybyk_in?ref_src=twsrc%5Etfw">@mybyk_in</a> <a href="https://twitter.com/arjitsoni12?ref_src=twsrc%5Etfw">@arjitsoni12</a> <a href="https://twitter.com/ankitkamdar45?ref_src=twsrc%5Etfw">@ankitkamdar45</a> <a href="https://twitter.com/PedalPowerGroup?ref_src=twsrc%5Etfw">@PedalPowerGroup</a> <a href="https://twitter.com/cyclingmonksIN?ref_src=twsrc%5Etfw">@cyclingmonksIN</a> <a href="https://twitter.com/FitIndiaOff?ref_src=twsrc%5Etfw">@FitIndiaOff</a> <a href="https://twitter.com/FlankerFoxy?ref_src=twsrc%5Etfw">@FlankerFoxy</a> <a href="https://twitter.com/vipul2777?ref_src=twsrc%5Etfw">@vipul2777</a> <a href="https://twitter.com/KitanuKiller?ref_src=twsrc%5Etfw">@KitanuKiller</a> <a href="https://t.co/Ba7jiRQfNz">https://t.co/Ba7jiRQfNz</a> <a href="https://t.co/kU1PGms9yb">pic.twitter.com/kU1PGms9yb</a></p>&mdash; ઈ.કુશલ શેઠ | ई.कुशल शेठ | Er.Kushal Sheth | 🇮🇳 (@Kushal_Sheth_) <a href="https://twitter.com/Kushal_Sheth_/status/1490310047557373953?ref_src=twsrc%5Etfw">February 6, 2022</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="parent_child_div style-4 ">
                        <div class=" child_div ">
                            <blockquote class="twitter-tweet"><p lang="en" dir="ltr">Namaskaram... 🍵🚶‍♂️🏋‍♂️💪<br>Day 16 : 06th Feb ...<br>100 Days Challenge-2 ...<br>Wild Card Challenge 43 jumping jacks in 30sec... <a href="https://twitter.com/SandeepMall?ref_src=twsrc%5Etfw">@SandeepMall</a> <a href="https://twitter.com/FitIndiaOff?ref_src=twsrc%5Etfw">@FitIndiaOff</a> <a href="https://twitter.com/hashtag/letsgetfittertogether?src=hash&amp;ref_src=twsrc%5Etfw">#letsgetfittertogether</a> <a href="https://twitter.com/hashtag/AdmireYourself?src=hash&amp;ref_src=twsrc%5Etfw">#AdmireYourself</a> <a href="https://twitter.com/hashtag/justrun?src=hash&amp;ref_src=twsrc%5Etfw">#justrun</a> <a href="https://twitter.com/hashtag/justrunjj?src=hash&amp;ref_src=twsrc%5Etfw">#justrunjj</a> <a href="https://twitter.com/hashtag/fitindia?src=hash&amp;ref_src=twsrc%5Etfw">#fitindia</a> <a href="https://twitter.com/hashtag/28states9utjustrunjj?src=hash&amp;ref_src=twsrc%5Etfw">#28states9utjustrunjj</a> <a href="https://twitter.com/hashtag/100days?src=hash&amp;ref_src=twsrc%5Etfw">#100days</a> <a href="https://t.co/FPEWE7EXsg">pic.twitter.com/FPEWE7EXsg</a></p>&mdash; Jitendra Jagdale (@JaggySJ) <a href="https://twitter.com/JaggySJ/status/1490216525067735042?ref_src=twsrc%5Etfw">February 6, 2022</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="parent_child_div style-4">
                        <div class=" child_div ">
                            <blockquote class="twitter-tweet"><p lang="hi" dir="ltr">अपनी सुबह ऐसी ही होती है।<br>और आपकी ?<br>10k Morning Ritual Run.<br>आज का देश के प्रति योगदान। <br>Healthy Life.<a href="https://twitter.com/FitIndiaOff?ref_src=twsrc%5Etfw">@FitIndiaOff</a> <a href="https://twitter.com/hashtag/fitindiamovement?src=hash&amp;ref_src=twsrc%5Etfw">#fitindiamovement</a> <a href="https://twitter.com/hashtag/newindiafitindia?src=hash&amp;ref_src=twsrc%5Etfw">#newindiafitindia</a> <a href="https://twitter.com/hashtag/FitnessMotivation?src=hash&amp;ref_src=twsrc%5Etfw">#FitnessMotivation</a> <a href="https://twitter.com/anuragdixit2005?ref_src=twsrc%5Etfw">@anuragdixit2005</a> <a href="https://twitter.com/ianuragthakur?ref_src=twsrc%5Etfw">@ianuragthakur</a> <a href="https://twitter.com/narendramodi?ref_src=twsrc%5Etfw">@narendramodi</a> <a href="https://t.co/V5LUy05iCu">pic.twitter.com/V5LUy05iCu</a></p>&mdash; Praveen Kumar Teotia (@MarcosPraveen) <a href="https://twitter.com/MarcosPraveen/status/1490181308118888449?ref_src=twsrc%5Etfw">February 6, 2022</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                    </div>
                </div>
                <br>
            </div>

        </div>

    </section>

    <section>
        <div class="sup_org on-print">
            <h3 class="heading headvideo"><!-- {{ __('home_content.Supporting_Organisations')}} --> <!--Supporting Organisations--></h3>
            <div class="slider">
                <div class="flexslider  flexslider_first carousel" id="f2">
                    <ul class="slides">
                        <li>
                            <a class="getlink" href="javascript:void(0);" data-link="https://www.education.gov.in/en">
                                <img typeof="foaf:Image" src="{{asset('resources/images/gov-logos/ministryofeducation.png')}}"
                                 width="163" height="98" alt="moe" title="Ministry of Education" />
                            </a>
                        </li>
                        <li>
                            <a class="getlink" href="javascript:void(0);" data-link="https://nyks.nic.in/">
                                <img typeof="foaf:Image" src="{{asset('resources/images/gov-logos/nyks.png')}}"
                                 width="139" height="124" alt="NYKS" title="Nehru Yuva Kendra Sangathan" />
                            </a>
                        </li>

                        <li>
                            <a class="getlink" href="javascript:void(0);" data-link="https://nss.gov.in/">
                                <img typeof="foaf:Image" src="{{asset('resources/images/gov-logos/nss.png')}}"
                                width="196" height="138" alt="NSS" title="National Service Scheme" />
                            </a>
                        </li>

                        <li >
                            <a class="getlink" href="javascript:void(0);" data-link="https://www.itbpolice.nic.in/">
                                <img typeof="foaf:Image" src="{{asset('resources/images/gov-logos/itbp.png')}}"
                                width="111" height="104" alt="itbp" title="Indo-Tibetan Border Police" />
                            </a>
                        </li>


                        <li>
                            <a class="getlink" href="javascript:void(0);" data-link="https://wcd.nic.in/">
                                 <img typeof="foaf:Image" src="{{asset('resources/images/gov-logos/ministryofchildanddev.png')}}"
                                 width="143"  height="114" alt="ministry of women and child development"  title="Ministry Of Women & Child Development" />
                            </a>
                        </li>

                        <li>
                            <a class="getlink" href="javascript:void(0);" data-link="https://www.cbse.gov.in/">
                                <img typeof="foaf:Image" src="{{asset('resources/images/gov-logos/cbsc.png')}}"
                                width="143" height="114" alt="cbsc" title="Central Board of Secondary Education" />
                            </a>
                        </li>

                        <li>
                            <a class="getlink" href="javascript:void(0);" data-link="https://www.cisce.org/">
                                <img typeof="foaf:Image" src="{{asset('resources/images/gov-logos/icse.png')}}"
                                width="143" height="114" alt="icse" title="Council for the Indian School Certificate Examinations" />
                            </a>
                        </li>

                        <li>
                            <a class="getlink" href="javascript:void(0);" data-link="https://www.mygov.in/">
                                 <img typeof="foaf:Image" src="{{asset('resources/images/gov-logos/govofindia.png')}}"
                                  width="143" height="114" alt="GOI" title="Government of India" />
                            </a>
                        </li>
                        <li>
                            <a class="getlink" href="javascript:void(0);" data-link="https://sportsauthorityofindia.nic.in/">
                                    <img typeof="foaf:Image" src="{{asset('resources/images/gov-logos/sai.png')}}"
                                    width="143" height="114" alt="SAI" title="Sports Authority of India" />
                            </a>
                        </li>
                        <li>
                            <a class="getlink" href="javascript:void(0);" data-link="https://kheloindia.gov.in/">
                                <img typeof="foaf:Image" src="{{asset('resources/images/gov-logos/kheloindia.png')}}"
                                width="143" height="114" alt="KheloIndia" title="Khelo India" />
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    </div>



    <div class="modal fade" id="popupmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- <div class="modal-header">


                </div> -->
                <div class="modal-body">
                    <img src="resources/imgs/web_popup.jpg" class="img-fluid" />
                </div>

            </div>
        </div>
    </div>

<script src="{{ asset('resources/js/ajaxjquery.min.js') }}"></script>
<script src="{{ asset('resources/js/jquery.flexslider.js') }}"></script>

<script type="text/javascript">
    var $j = jQuery.noConflict();
        $j(function() {

            // store the slider in a local variable
            var $jwindow = $j(window),
                flexslider = {
                    vars: {}
                };

            // tiny helper function to add breakpoints
            function getGridSize() {
                return (window.innerWidth < 600) ? 1 :
                    (window.innerWidth < 900) ? 1 : 6;
            }


            $j(window).load(function() {
                $j('#f2').flexslider({
                    animation: "slide",
                    animationLoop: true,
                    itemWidth: 140,
                    itemMargin: 1,
                    pausePlay: false,
                    mousewheel: false,
                    controlNav: true,
                    asNavFor:'.flexslider',
                    maxItems: 1,
                    pauseText: '',
                    move: 1,
                    playText: '',
                    prevText: "", //String: Set the text for the "previous" directionNav item
                    nextText: "",
                    rtl: false,
                    autoplay:true,
                    minItems: getGridSize(), // use function to pull in initial value
                    maxItems: getGridSize() // use function to pull in initial value
                });
            });

            $j(window).resize(function() {
                var gridSize = getGridSize();

                flexslider.vars.minItems = gridSize;
                flexslider.vars.maxItems = gridSize;
            });
        }());
</script>

    <script type="text/javascript">
        $(function() {
            var toggles = $('.toggle a'),
                codes = $('.code');

            toggles.on("click", function(event) {
                event.preventDefault();
                var $this = $(this);

                if (!$this.hasClass("active")) {
                    toggles.removeClass("active");
                    $this.addClass("active");
                    codes.hide().filter(this.hash).show();
                }
            });
            toggles.first().click();
        });
    </script>

    <script>
        var myIndex = 0;
        carousel_div();

        function carousel_div() {
        var i;
        var x = document.getElementsByClassName("m_Slides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}
        x[myIndex-1].style.display = "block";
        setTimeout(carousel_div, 4000);
        }

    </script>
    <script type="text/javascript">
                $(document).ready(function () {
                $('.carousel').carousel({
                    interval: 4000
                })
            });

</script>

<script>
$(document).ready(function () {

  /* ===============================
     BALLOONS
  =============================== */
  var balloonContainer = document.getElementById("balloon-container");
  if (!balloonContainer) return;

  var colors = ["#ff5252", "#ffeb3b", "#4caf50", "#03a9f4", "#e040fb"];
  var totalBalloons = window.innerWidth < 768 ? 8 : 15;

  for (var i = 0; i < totalBalloons; i++) {
    var balloon = document.createElement("div");
    balloon.className = "balloon";

    balloon.style.left = Math.random() * 100 + "vw";
    balloon.style.backgroundColor =
      colors[Math.floor(Math.random() * colors.length)];
    balloon.style.animationDuration = (4 + Math.random() * 3) + "s";

    balloonContainer.appendChild(balloon);
  }

  /* ===============================
     CONFETTI / POPPERS (FIXED)
  =============================== */
  var canvas = document.getElementById("confetti-canvas");

//   if (canvas && typeof confetti !== "undefined") {

//     var myConfetti = confetti.create(canvas, {
//       resize: true,
//       useWorker: true
//     });

//     var end = Date.now() + 5000;

//     (function frame() {

//       // Left side popper
//       myConfetti({
//         particleCount: 4,
//         angle: 60,
//         spread: 55,
//         origin: { x: 0.1, y: 0.75 }
//       });

//       // Right side popper
//       myConfetti({
//         particleCount: 4,
//         angle: 120,
//         spread: 55,
//         origin: { x: 0.9, y: 0.75 }
//       });

//       if (Date.now() < end) {
//         requestAnimationFrame(frame);
//       }
//     })();
//   }

  /* ===============================
     AUTO CLEANUP (5 sec)
  =============================== */
  setTimeout(function () {
    var overlay = document.getElementById("celebration-overlay");
    if (overlay) overlay.remove();
  }, 5000);

});
</script>


@endsection
