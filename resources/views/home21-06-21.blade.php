@extends('layouts.app')
@section('title', 'Fit India - Be fit')
@section('content')

@php
$active_section = request()->segment(count(request()->segments()));
$active_section_id = trim($active_section);
@endphp

<link src="resources/css/flexslider.css" type="text/css" media="screen">

</link>

<div class="container-fluid">
    <div class="banner">
        <div class="row">
            <div class="col-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators on-print">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators1" data-slide-to="1"></li>
                        <!-- <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> -->
                        <li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators3" data-slide-to="3"></li>
                        <li data-target="#carouselExampleIndicators4" data-slide-to="4">
                        
                        <!-- <li data-target="#carouselExampleIndicators4" data-slide-to="5"></li> -->
                    </ol>

                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <a href=" https://fitindia.gov.in/road-to-tokyo-2020/Ngwjw1F8RQ+K9gjvFTXYqg==" target="_blank">
                                <img src="resources/imgs/home/Olympic-Banner.jpg" class="d-block w-100"
                                    alt="Olympic-Banner" title="Olympic-Banner"> </a>
                         </div>


                        <div class="carousel-item ">
                            <a href="champion-and-ambassador" target="_blank">
                                <img src="resources/imgs/home/Space-for-champions-and-ambassador.jpg"
                                    class="d-block w-100" alt="Champions and Ambassadors"
                                    title="Fit India Champions and Ambassadors">
                            </a>
                        </div>

                        <div class="carousel-item">
                            <a href="javascript:void(0);"><img src="resources/imgs/home/fitness-ki-dose-banner.jpg"
                                    class="d-block w-100" alt="Fitness Ka Doze" title="Fitness Ki Dose Aadha Ghanta Roz"></a>
                        </div>

                        <!-- ="http://103.65.20.170/fitind/resources/imgs/Banner_yoga-2.gif -->

                       <!--  <div class="carousel-item">
                            <a href="https://schoolfitness.kheloindia.gov.in/tot.aspx" target="_blank"><img
                                    src="resources/imgs/home/PE-Teacher-Banner-new.jpg" class="d-block w-100"
                                    alt="International women's day"></a>
                        </div> -->

                        <!-- <div class="carousel-item">
                            <a href="your-stories">
                                <img src="resources/imgs/home/share-your-story.jpg" class="d-block w-100"
                                    alt="your-strony" title="Share Your Fitness Story"> </a>
                        </div> -->

                         <!-- <div class="carousel-item">
                            <a href="https://www.facebook.com/FitIndiaOff " target="_blank">
                                <img src="resources/imgs/home/fitfromhome.jpg" class="d-block w-100"
                                    alt="your-strony" title="Fitness From Home"> </a>
                         </div> -->

                         <!-- <div class="carousel-item">
                            <a href="https://www.yuwaah.org/youngwarrior" target="_blank">
                                <img src="resources/imgs/home/your-action-matter.jpg" class="d-block w-100"
                                    alt="your-action-matter" title="your-action-matter"> </a>
                         </div> -->

                         <div class="carousel-item">
                            <a href="fit-india-quiz" target="_blank">
                                <img src="resources/imgs/home/Fit-india-quiz.jpg" class="d-block w-100"
                                    alt="Fit-india-quiz" title="Fit-india-quiz"> </a>
                         </div>

                         <div class="carousel-item">
                            <a href="fit-india-yoga-centres" target="_blank">
                                <img src="resources/imgs/home/yoga_centre.jpeg" class="d-block w-100"
                                    alt="Fit-india-yoga" title="Fit-india-yoga"> </a>
                         </div>


                         <div class="carousel-item">
                            <a href="fit-india-yoga-centres" target="_blank">
                                <img src="resources/imgs/Banner_yoga-2.gif" class="d-block w-100"
                                    alt="Fit-india-yoga" title="Fit-india-yoga"> </a>
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
        <div class="row">
        <div class="col-12">

        <a href="https://fitindia.gov.in/wp-content/uploads/doc/EOI_Olympics_Quiz_18.06.2021.pdf" style="width: 100%;
    background: #008000;
    padding: 5px;
    text-decoration: none;
    display: block;
    color: #fff;
    text-align: center;" target="_blank">	Expression of Interest (EOI) For Engagement of Partner For Olympics Quiz "ROAD TO TOKYO 2020"</a>
        </div>
        </div>
    </div>

    <!-- ------------------------About  section add--------------------------------- -->

    <section id="{{ $active_section_id }}">
        <div class="container">
            <div class="row r-m">
                <div class="col-sm-12 col-md-12  col-lg-12">
                    <h1 class="a_heading about_head headH1">About Fit India Movement</h1>
                </div>
            </div>
            <div class="row r-m">
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <p class="text-justify ab_para"> <span class="logo-fitindia"> <img
                                src="{{asset('resources/imgs/fit-india_logo.png') }}" alt="Fit India logo"
                                title="Fit India" class="img-fluid"></span> FIT INDIA Movement was launched on 29th August,
                        2019 by Hon'ble Prime Minister with a view to make fitness an integral part of our daily lives.
                        The mission of the Movement is to bring about behavioural changes and move towards a more
                        physically active lifestyle. Towards achieving this mission, Fit India proposes to undertake
                        various initiatives and conduct events to achieve the following objectives:</p>
                    <ul class="aboutLi">
                        <li>To promote fitness as easy, fun and free</li>
                        <li>To spread awareness on fitness and various physical activities that promote fitness through
                            focused campaigns</li>
                        <li>To encourage indigenous sports</li>
                        <li>To make fitness reach every school, college/university, panchayat/village, etc.</li>
                        <li>To create a platform for citizens of India to share information, drive awareness and
                            encourage sharing of personal fitness stories</li>
                    </ul>
                </div>
                
				<div class="col-sm-12 col-md-3 col-lg-3">
				<a href="{{ url('event-archives') }}" class="evnt-archv">Events Archive
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
        </div>
       
    </section>

    <!-- video section -->

    <section class="videobg">
        <div class="container">
            <div class="row ">
                <div class="col-sm-12 col-md-12 flex-column">
                    <div class="sec_heading">
                        <h2 class="heading headvideo">Fitness Mantra</h2>
                        <p>Fit India Mission encourages people to become part of Fit India Movement by inculcating at
                            least 30-60 minutes of physical activities in their day to day lives. The mission of the
                            Movement is to bring about behavioral changes and move towards a more physically active
                            lifestyle</p>
                    </div>
                </div>
            </div>
            <div class="row on-print">
                <div class="col-sm-12 col-md-6 flex-column">
                    <div class="videos_colm">
                        <div class="video_area">
						<div class="ytb-video" >
						<!--<iframe src="https://www.youtube-nocookie.com/embed/5R-5AgSsm3U?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						<span class="play-card">
						<span class="play-icon"><i class="fa fa-play" aria-hidden="true"></i></span>
						</span>
						 <img src="resources/videos/mints-video-cover.jpg" class="img-fluid img_radius" alt="Fitness Ki Dose" title="Fitness Ki Dose Aadha Ghanta Roz" /> -->
						 </div>
                            <video poster="resources/videos/mints-video-cover.jpg" controls="">
                                <source type="video/mp4" src="resources/videos/30mins.mp4">
                            </video>
							
                            <p class="video-title"><strong>Fitness Ki Dose Aadha Ghanta Roz</strong></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 ">
                    <div class="videos_colm">
                        <div class="video_area">
						<div class="ytb-video" >
						<!--<iframe src="https://www.youtube.com/embed/_RnvaJnW1i0?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						<span class="play-card">
						<span class="play-icon"><i class="fa fa-play" aria-hidden="true"></i></span>
						</span>
						<img src="resources/videos/fitness-inspiration-video-cover.jpg" class="img-fluid img_radius" alt="Inspiration" title="Fitness Inspiration" /> -->
						</div>
                           <video poster="resources/videos/fitness-inspiration-video-cover.jpg" controls="">
                                <source type="video/mp4" src="resources/videos/Fitness-Inspiration.mp4">
                            </video>
                            <p class="video-title"><strong>Fitness Inspiration</strong></p>
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
                        <h2 class="heading headvideo">Insights</h2>
                        <p>Fit India has started many campaigns to promote and spread awareness on fitness and the
                            activities that can be undertaken to ensure that fitness reaches every school,
                            college/university, panchayat/village, etc.</p>
                    </div>
                </div>
            </div>
            <div class="row home-bx-3">
                <div class="col-sm-12 col-md-4 col-lg-4 n_sec hover_a">
                    <div class="shar_div shadow  bx">
                        <a href="{{ url('fit-india-school') }}">
                            <img src="resources/images/home-thumbs/school-week-certificate.jpg" class="img-fluid img_radius_lr" alt="school-week-certificate" title="School Certification" />
                            <p>School Certification</p>
                        </a>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4  n_sec hover_a">
                    <div class="shar_div shadow  bx">
                        <a href="{{ url('fit-india-youth-club-certification') }}">
                            <img src="resources/images/home-thumbs/youth-club.jpg" class="img-fluid img_radius_lr"
                                alt="Youth Club" title="Youth Club Certification" />
                            <p>Youth Club Certification</p>
                        </a>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 n_sec hover_a">
                    <div class="shar_div shadow  bx">
                        <a href="{{ url('champion-and-ambassador') }}">
                            <img src="resources/images/home-thumbs/champion_ambassador.jpg"
                                class="img-fluid img_radius_lr" alt="Ambassadors / Champions"
                                title="Ambassadors & Champions" />
                            <p>Ambassadors & Champions</p>
                        </a>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 n_sec hover_a">
                    <div class="shar_div shadow  bx">
                        <a href="{{ url('fitnessprotocols') }}">
                            <img src="resources/images/home-thumbs/fitness_protocals.jpg"
                                class="img-fluid img_radius_lr" alt="Protocols" title="Fitness Protocols" />
                            <p>Fitness Protocols</p>
                        </a>
                    </div>
                </div>



                <div class="col-sm-12 col-md-4 col-lg-4 n_sec hover_a">
                    <div class="shar_div shadow  bx">
                        <a href="{{ url('indigenousgames') }}">
                            <img src="resources/images/home-thumbs/indegenous.jpg" class="img-fluid img_radius_lr"
                                alt="Indigenous" title="Indigenous Games" />
                            <p>Indigenous Games</p>
                        </a>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 n_sec hover_a">
                    <div class="shar_div shadow  bx">
                        <a href="{{ url('fit-india-dialogue') }}">
                            <img src="resources/images/home-thumbs/fit-india_dilogue.jpg"
                                class="img-fluid img_radius_lr" alt="Dialogue" title="Dialogue Sessions" />
                            <p>Dialogue Sessions</p>
                        </a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4  n_sec hover_a">
                    <div class="shar_div shadow  bx">
                        <a href="{{ url('schooldashboard') }}">
                            <img src="resources/images/home-thumbs/Dashboard.jpg" class="img-fluid img_radius_lr"
                                alt="Dashboard" title="Fit India Dashboard" />
                            <p>Fit India Dashboard </p>
                        </a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 n_sec hover_a">
                    <div class="shar_div shadow  bx">
                        <a href="{{ url('your-stories') }}">
                            <img src="resources/images/home-thumbs/share-your-story.jpg" class="img-fluid img_radius_lr"
                                alt="Share Story" title="Share Your Story" />
                            <p>Share Your Fitness Story</p>
                        </a>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 n_sec hover_a">
                    <div class="shar_div shadow  bx">
                        <a href="{{ url('fitness-from-home-series') }}">
                            <img src="resources/images/home-thumbs/InsightsFitnessfromHomeseries.jpg" class="img-fluid img_radius_lr"
                                alt="Fitness From Home Series" title="Fitness From Home Series" />
                            <p>Fitness From Home Series</p>
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
                    <h3 class="heading headvideo">Social Feeds</h3>
                </div>
            </div>

            <div id="container">
                <div class="parent_div">
                    <div class="child_div">
                        <blockquote class="twitter-tweet" tw-align-center data-lang="en" data-dnt="true">
                            <p lang="en" dir="ltr">Looking forward to the Fit India Dialogue, which begins at noon
                                today, 24th September. <br><br>It brings together fitness influencers and enthusiasts
                                for a fruitful discussion on how to remain fit and healthy. <br><br>Don’t miss this one!
                                <a href="https://twitter.com/hashtag/NewIndiaFitIndia?src=hash&amp;ref_src=twsrc%5Etfw">#NewIndiaFitIndia</a>
                                <a href="https://t.co/2cB2lpHNkU">pic.twitter.com/2cB2lpHNkU</a></p>&mdash; Narendra
                            Modi (@narendramodi) <a
                                href="https://twitter.com/narendramodi/status/1308993604568993795?ref_src=twsrc%5Etfw">September
                                24, 2020</a>
                        </blockquote>
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>

                    <div class="child_div">
                        <blockquote class="twitter-tweet" tw-align-center data-lang="en" data-dnt="true">
                            <p lang="en" dir="ltr">Join our Honourable PM and me at the Fit India Dialogue, tomorrow at
                                12 PM IST. See you there 🙌🏼 <a
                                    href="https://twitter.com/hashtag/NewIndiaFitIndia?src=hash&amp;ref_src=twsrc%5Etfw">#NewIndiaFitIndia</a>
                                <a href="https://t.co/Vf5LyTljyR">pic.twitter.com/Vf5LyTljyR</a></p>&mdash; Virat Kohli
                            (@imVkohli) <a
                                href="https://twitter.com/imVkohli/status/1308744470616104960?ref_src=twsrc%5Etfw">September
                                23, 2020</a>
                        </blockquote>
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>

                    <div class="child_div">
                        <blockquote class="twitter-tweet" tw-align-center data-lang="en" data-dnt="true">
                            <p lang="en" dir="ltr">Attended the Fit India Advisory Committee meeting chaired by <a
                                    href="https://twitter.com/KirenRijiju?ref_src=twsrc%5Etfw">@kirenrijiju</a> sir
                                today. Shared my vision for a Fit India. <a
                                    href="https://twitter.com/hashtag/NewIndiaFitIndia?src=hash&amp;ref_src=twsrc%5Etfw">#NewIndiaFitIndia</a>
                                <a href="https://t.co/oCg5hz9HQ7">pic.twitter.com/oCg5hz9HQ7</a></p>&mdash; Hima (mon
                            jai) (@HimaDas8) <a
                                href="https://twitter.com/HimaDas8/status/1361928905762906116?ref_src=twsrc%5Etfw">February
                                17, 2021</a>
                        </blockquote>
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                    
                    <div class="child_div">
                        <blockquote class="twitter-tweet" tw-align-center data-lang="en" data-dnt="true">
                            <p lang="en" dir="ltr">Let’s get fit together. <a
                                    href="https://twitter.com/hashtag/FitIndiaMovement?src=hash&amp;ref_src=twsrc%5Etfw">#FitIndiaMovement</a>
                                <a
                                    href="https://twitter.com/hashtag/NewIndiaFitIndia?src=hash&amp;ref_src=twsrc%5Etfw">#NewIndiaFitIndia</a>
                                <a href="https://t.co/SPPxM5uaFt">pic.twitter.com/SPPxM5uaFt</a></p>&mdash; Chetan
                            Bhagat (@chetan_bhagat) <a
                                href="https://twitter.com/chetan_bhagat/status/1341654059934048257?ref_src=twsrc%5Etfw">December
                                23, 2020</a>
                        </blockquote>
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>

                   <div class="child_div">
                        <blockquote class="twitter-tweet" tw-align-center data-lang="en" data-dnt="true"><p lang="en" dir="ltr">When there are two reasons for practising yoga early in the am. <a href="https://twitter.com/hashtag/FitIndiaMovement?src=hash&amp;ref_src=twsrc%5Etfw">#FitIndiaMovement</a> and <a href="https://twitter.com/hashtag/immensegratitude?src=hash&amp;ref_src=twsrc%5Etfw">#immensegratitude</a> ! I am standing on my own altar, the poses are my prayers 🙏🏻 <a href="https://t.co/HpBs0iaj0T">pic.twitter.com/HpBs0iaj0T</a></p>&mdash; Kajal Aggarwal (@MsKajalAggarwal) <a href="https://twitter.com/MsKajalAggarwal/status/1369488709112848391?ref_src=twsrc%5Etfw">March 10, 2021</a></blockquote> 
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                      
                    </div>

                    <div class="child_div">
                        <blockquote class="twitter-tweet" tw-align-center data-lang="en" data-dnt="true"><p lang="en" dir="ltr">Towards a fitter, healthier, happier India. <br><br>Keep running. Keep growing. <a href="https://twitter.com/hashtag/FitIndiaFreedomRun?src=hash&amp;ref_src=twsrc%5Etfw">#FitIndiaFreedomRun</a> <a href="https://twitter.com/hashtag/Run4India?src=hash&amp;ref_src=twsrc%5Etfw">#Run4India</a><br> <a href="https://twitter.com/hashtag/FitIndiaMovement?src=hash&amp;ref_src=twsrc%5Etfw">#FitIndiaMovement</a> <a href="https://twitter.com/KirenRijiju?ref_src=twsrc%5Etfw">@KirenRijiju</a> <a href="https://t.co/59NtrL2p23">pic.twitter.com/59NtrL2p23</a></p>&mdash; Dr. S. Jaishankar (@DrSJaishankar) <a href="https://twitter.com/DrSJaishankar/status/1295989469867368448?ref_src=twsrc%5Etfw">August 19, 2020</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </div>
            </div>

    </section>
    
    <section>
        <div class="sup_org on-print">
            <h3 class="heading headvideo">Supporting Organisations</h3>
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
        return (window.innerWidth < 600) ? 2 :
            (window.innerWidth < 900) ? 5 : 6;
    }

    
    $j(window).load(function() {
        $j('#f2').flexslider({
            animation: "slide",
            animationLoop: false,
            itemWidth: 140,
            itemMargin: 60,
            pausePlay: false,
            mousewheel: false,
            controlNav: true,
            asNavFor:'.flexslider',
            maxItems: 1,
            pauseText: '',
            playText: '',
            prevText: "", //String: Set the text for the "previous" directionNav item
            nextText: "",
            rtl: false,   
            autoplay:false,         
            minItems: getGridSize(), // use function to pull in initial value
            maxItems: getGridSize() // use function to pull in initial value
        });
    });




    


    // animation: "slide",
    // animationLoop: false,
    // itemWidth: 210,
    // itemMargin: 5,
    // pausePlay: true,
    // mousewheel: true,
    // rtl: true,
    // asNavFor:'.flexslider'

    // check grid size on resize event
    $j(window).resize(function() {
        var gridSize = getGridSize();

        flexslider.vars.minItems = gridSize;
        flexslider.vars.maxItems = gridSize;
    });
}());




// $(window).load(function() {

//     $('#f2').flexslider({
//         animation: "slide",
//         animationLoop: false,
//         itemWidth: 140,
//         itemMargin: 50,
//         pausePlay: true,
//         mousewheel: true,
//         controlNav: false,
//         pauseText: '',
//         playText: '',
//         prevText: "", 
//         nextText: ""

//     });    
// });
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
  setTimeout(carousel_div, 2000); // Change image every 2 seconds
}









  
</script>
<script type="text/javascript">
              $(document).ready(function () {
            $('.carousel').carousel({
                interval: 2000
            })
        });

    </script>
@endsection