@extends('layouts.app')
@section('title', 'About Us | Fit India')
@section('content')
@php
$active_section = request()->segment(count(request()->segments()));
$active_section_id = trim($active_section);
@endphp
<style>
    a {
        color: #000;
    }

    .active {
        color: #000 !important;
        font-weight: 400;
        opacity: 1;
    }

    .cont_area {
        padding: 0 0;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        height: 250px;
    }
    .freenote p {
        margin-bottom: 5px;
    }

    .freenote {
        background: #fcfac6;
        padding: 11px;
        border-radius: 5px;
        border: 1px dotted #b4aeae;
    }

    .freenote ol {
        margin-bottom: 0;
        padding: 0 10px 0 28px;
    }

</style>
<link rel="stylesheet" href="{{ asset('resources/css/vtabs.css') }}" media="screen">


<!-- <i class="fa fa-circle" aria-hidden="true"></i><span>2021</span> -->
<div>
    <img src="{{ asset('resources/images/event-banner.jpg') }}" alt="event" title="event" class="img-fluid expand_img" />
    <!-- <h1 style="font-size:1px; color:#fff;">Share Your Story</h1> -->
</div>
<section class="event_arc">

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-3">

                <div class="nav nav-tabs left-tabs">

                    <div class="scrolling-wrapper scrolling-wrapper_event">
                        <div class="y-group">

                            <div class="tabhead"><i class="fa fa-circle" aria-hidden="true"></i><span>Year - 2025</span></div>
                            <!-- <div class="cd_tabs_list"> -->
                            <div class="nav-item sideLflex">
                                <a class="nav-link active" href="#fit-india-women-week" data-toggle="tab">Fit India Women Week<span>Mar</span></a>
                            </div>
                            {{-- <div class="nav-item sideLflex">
                                <a class="nav-link" href="#fit-india-swacchta-freedom-run-5" data-toggle="tab">Fit India Swacchta Freedom Run 5.0<span>Oct</span></a>
                            </div>
                            <div class="nav-item sideLflex">
                                <a class="nav-link" href="#national-sports-day-2024" data-toggle="tab">National Sports Day 2024<span>Aug</span></a>
                            </div> --}}

                        </div> <!-- -------------------------close 2024 Group--------------------------- -->
                        <!-- -------------------------2024 Group--------------------------- -->
                        <div class="y-group">

                            <div class="tabhead"><i class="fa fa-circle" aria-hidden="true"></i><span>Year - 2024</span></div>
                            <!-- <div class="cd_tabs_list"> -->
                            <div class="nav-item sideLflex">
                                <a class="nav-link" href="#fit-india-week-2024" data-toggle="tab">Fit India Week 2024<span>Nov</span></a>
                            </div>
                            <div class="nav-item sideLflex">
                                <a class="nav-link" href="#fit-india-swacchta-freedom-run-5" data-toggle="tab">Fit India Swacchta Freedom Run 5.0<span>Oct</span></a>
                            </div>
                            <div class="nav-item sideLflex">
                                <a class="nav-link" href="#national-sports-day-2024" data-toggle="tab">National Sports Day 2024<span>Aug</span></a>
                            </div>

                        </div> <!-- -------------------------close 2024 Group--------------------------- -->

                        <!-- -------------------------2023 Group--------------------------- -->
                        <div class="y-group">

                            <div class="tabhead"><i class="fa fa-circle" aria-hidden="true"></i><span>Year - 2023</span></div>
                            <!-- <div class="cd_tabs_list"> -->
                            <div class="nav-item sideLflex">
                                <a class="nav-link" href="#Fit-India-week-id-2023" data-toggle="tab">Fit India week 2023<span>Nov</span></a>
                            </div>

                            <div class="nav-item sideLflex">
                                <a class="nav-link " href="#Fit-India-Swachhata" data-toggle="tab">Fit India Swachhata Freedom Run 4.0<span>Oct</span></a>
                            </div>
                            <div class="nav-item sideLflex">
                                <a class="nav-link " href="#national-sports-day-2023" data-toggle="tab">National Sports Day 2023<span>Aug</span></a>
                            </div>

                        </div> <!-- -------------------------close 2023 Group--------------------------- -->
                        <!-- -------------------------2022 Group--------------------------- -->
                        <div class="y-group">

                            <div class="tabhead"><i class="fa fa-circle" aria-hidden="true"></i><span>Year - 2022</span></div>
                            <!-- <div class="cd_tabs_list"> -->
                            {{-- <div class="nav-item sideLflex">
                                <a class="nav-link" href="#Fit-India-schoolweek-2021" data-toggle="tab">Fit India School Week<span>Nov</span></a>
                            </div>

                            <div class="nav-item sideLflex">
                                <a class="nav-link " href="#Fit-India-Quiz" data-toggle="tab">Fit India Quiz<span>Sep</span></a>
                            </div> --}}

                            <div class="nav-item sideLflex">
                                <a class="nav-link " href="#national-sports-day-2022" data-toggle="tab">National Sports Day<span>Aug</span></a>
                            </div>
                            <div class="nav-item sideLflex">
                                <a class="nav-link " href="#fit-india-freedom-rider-Cycle-rally-2022" data-toggle="tab">Fit India Freedom Rider-Cycle Rally<span>Jun</span></a>
                            </div>
                        </div> <!-- -------------------------close 2022 Group--------------------------- -->
                        <!-- -------------------------2021 Group--------------------------- -->
                        <div class="y-group">

                            <div class="tabhead"><i class="fa fa-circle" aria-hidden="true"></i><span>Year - 2021</span></div>
                            <!-- <div class="cd_tabs_list"> -->
                            <div class="nav-item sideLflex">
                                <a class="nav-link" href="#Fit-India-schoolweek-2021" data-toggle="tab">Fit India School Week<span>Nov</span></a>
                            </div>

                            <div class="nav-item sideLflex">
                                <a class="nav-link " href="#Fit-India-Quiz" data-toggle="tab">Fit India Quiz<span>Sep</span></a>
                            </div>

                            <div class="nav-item sideLflex">
                                <a class="nav-link " href="#Freedom-Run" data-toggle="tab">Freedom-Run-2.0<span>Aug</span></a>
                            </div>
                        </div> <!-- -------------------------close 2021 Group--------------------------- -->
                        <!-- ---------------------------2021 Group close------------------------------------- -->
                        <!-- -------------------------2020 Group--------------------------- -->
                        <div class="y-group">

                            <div class="tabhead"><i class="fa fa-circle" aria-hidden="true"></i><span>Year - 2020</span></div>
                            <!-- <div class="cd_tabs_list"> -->
                            <div class="nav-item sideLflex">
                                <a class="nav-link " href="#Fit-India-Prabhat-Pheri-2020" data-toggle="tab">Fit India Prabhat Pheri <span>Dec</span></a>
                            </div>

                            <div class="nav-item sideLflex">
                                <a class="nav-link " href="#Fit-India-Cyclothon" data-toggle="tab">Fit India Cyclothon <span>Dec</span></a>
                            </div>

                            <div class="nav-item sideLflex">
                                <a class="nav-link " href="#Fit-India-School-Week" data-toggle="tab">Fit India School Week <span>Dec</span></a>
                            </div>

                            <div class="nav-item sideLflex">
                                <a class="nav-link " href="#Fit-India-Walkathon-200" data-toggle="tab">Fit India Walkathon 200 KM<span>Oct</span></a>
                            </div>

                            <div class="nav-item sideLflex">
                                <a class="nav-link " href="#Fit-India-Freedom-Run" data-toggle="tab">Fit India Freedom Run<span>Aug</span></a>
                            </div>

                            <div class="nav-item sideLflex">
                                <a class="nav-link " href="#Fun-Family-Yoga" data-toggle="tab">Fun Family Yoga<span>Jun</span></a>
                            </div>

                            <div class="nav-item sideLflex">
                                <a class="nav-link " href="#Internation-yoga" data-toggle="tab">The International Day of Yoga<span>Jun</span></a>
                            </div>

                            <div class="nav-item sideLflex">
                                <a class="nav-link " href="#Fit-India-Talks" data-toggle="tab">Fit India Talks<span>Apr</span></a>
                            </div>

                            <div class="nav-item sideLflex">
                                <a class="nav-link " href="#Indigeneous-Games" data-toggle="tab">Indigeneous Games<span>Apr</span></a>
                            </div>

                            <div class="nav-item sideLflex">
                                <a class="nav-link " href="#March-For-Women" data-toggle="tab">March For Women<span>Mar</span></a>
                            </div>
                            <!-- </div> -->





                        </div> <!-- -------------------------close 2020 Group--------------------------- -->

                        <!-- -------------------------2019 Group--------------------------- -->

                        <div class="y-group">
                            <div class="tabhead"><i class="fa fa-circle" aria-hidden="true"></i><span>Year - 2019</span></div>

                            <!-- <div class="cd_tabs_list"> -->

                            <div class="nav-item sideLflex">
                                <a class="nav-link" href="#FIT-India-Monthly-Plog-event" data-toggle="tab">FIT India Monthly Plog event <span>Dec</span></a>
                            </div>

                            <div class="nav-item sideLflex">
                                <a class="nav-link" href="#Fitindia-Plogging-Ambassador" data-toggle="tab">Fitindia Plogging Ambassador <span>Dec </span></a>
                            </div>

                            <div class="nav-item sideLflex">
                                <a class="nav-link" href="#Launch-of-Fit-India-Movement " data-toggle="tab">Launch of Fit India Movement - <span>Aug </span></a>
                            </div>

                            <!-- </div>   -->



                        </div>
                        <!-- -------------------------close 2019 Group--------------------------- -->

                    </div>

                </div>
            </div>

            <div class="col-md-9">
                <div class="event-dtls">
                    <div class="tab-content">

                        <!-- -----------------------------Fit-India-week-2021--------------------------------------- -->

                        <article class="tab-pane active" id="fit-india-women-week">
                            <div class="banner_area1">
                                {{-- <img src="{{ asset('resources/imgs/home/schholweek-banner17-12-2021.png') }}" alt="school-week" title="school-week" class="img-fluid expand_img" /> --}}
                                <div class="banner">
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                                <img src="{{ asset('resources/imgs/internationalwomen/banner_image/fit-india-women-week.png') }}" class="d-block w-100" alt="Fit India Women Week's" title="Fit India Women Week's">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item mer_banner active">
                                                      <a href="{{ url('fit-india-women-week') }}">
                                                        {{-- <img src="{{ asset('resources/imgs/fid2024/fitindiaweek2024banner1.png') }}" class="d-block w-100" alt="Fit-india-week-2024" title="Fit-india-week-2024"> --}}
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
                                                    {{-- <div class="carousel-item mer_banner">
                                                      <a href="{{ url('fit-india-week-2024') }}">
                                                        <div class="some-absolute-div bannerPos1">
                                                            <div class="centered-in-absolute">
                                                                  @csrf
                                                                  <div class="text-center">
                                                                      <input type="hidden" name="banner_type" value="week_1">
                                                                  </div>
                                                            </div>
                                                        </div>
                                                      </a>
                                                    </div> --}}
                                                    {{-- <div class="carousel-item mer_banner">
                                                      <a href="{{ url('fit-india-week-2023') }}">
                                                        <img src="{{ asset('resources/imgs/fitindiaweek2023/webbanner3.png') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">
                                                        <div class="some-absolute-div bannerPos1">
                                                            <div class="centered-in-absolute">
                                                                    @csrf
                                                              <div class="text-center">
                                                                  <input type="hidden" name="banner_type" value="week_1">
                                                              </div>
                                                            </div>
                                                        </div>
                                                      </a>
                                                    </div> --}}
                                                </div>

                                                {{-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a> --}}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <section id="{{ $active_section_id }}">
                                    <div class="container">
                                        <div class="row">
                                            {{-- <a class="freedombtn1" href="register/">Register</a> --}}
                                            {{-- <a class="freedombtn3" href="{{ url("resources/pdf/how-to-register-for-fit-india-women's-week-2025.pdf") }}" target="_blank">How To Register</a> --}}
                                            {{-- <a class="freedombtn3 freedombtn4" style="background-color:#ee01ff;" href="https://forms.gle/UVWt9kncww2K6gqy7" data-target="#merchandisId" target="_blank">Capture your data</a> --}}
                                            <a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="{{ url('resources/pdf/SOP_IWD.pdf') }}" data-target="#merchandisId" target="_blank">SOP</a>
                                            <a class="freedombtn3 freedombtn4" href="{{ url('fit-india-women-week-merchandise') }}" data-target="#merchandisId" target="_blank">Merchandise/Creatives</a>
                                            <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;"  href="{{ url('fit-india-pledge-2024') }}" target="_blank">Fit India Pledge</a>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                              <h1 class="headingh1">FIT INDIA WOMEN'S WEEK</h1>
                                                <p>
                                                  International Women’s Day (IWD) is celebrated on March 8th every year to honor women's achievements and address the challenges they face.
                                                  The theme for 2025 is <b>"For ALL Women and Girls: Rights. Equality. Empowerment,</b>" focusing on breaking systemic barriers to unlock equal rights and opportunities.
                                                  The Fit India Mission will collaborate with government bodies, NGOs, and universities to encourage healthier lives,
                                                  leadership, and empowerment, aligning with the theme <b>“Stronger her, Healthier Future.”</b>
                                                </p>
                                                <p>
                                                  Central to the achieving the vision of IWD 2025 is empowering the next generation—youth,
                                                  particularly young women and adolescent girls—as catalysts for lasting change.
                                                  Therefore, the Fit India Mission plans to engage with the University Grants Commission
                                                  (UGC) as lead partner to reach out to various universities across the nation.
                                                </p>
                                                <p>
                                                  <b>The IWD Celebrations shall close with a Pink Sundays on Cycle event on
                                                  9th March 2025 (Sunday) to be conducted by the participating institutions focused and dedicated to women empowerment.
                                                  </b>
                                                </p>
                                                <p>
                                                  To promote women's health and fitness, ministries, departments, autonomous bodies,
                                                  and institutions at both central and state levels will be encouraged to organize various activities, including:
                                                </p>
                                                <p>
                                                  <ul>
                                                    <li><b>Women's Fitness Walkathons/Marathons</b> – Mass participation events for women of all ages to foster a fitness culture.</li>
                                                    <li><b> for Women</b> – Cycling events promoting both health and environmental awareness, ranging from leisure rides to competitive races.</li>
                                                    <li><b>Fit India Yoga Sessions</b> – Large-scale yoga sessions nationwide, focusing on physical and mental well-being.</li>
                                                  </ul>
                                                  SAI Regional Centres will work with local organizations to set up community-based activities such as Pink Cycling, fitness sessions, and yoga programs.
                                                </p>
                                                <p>
                                                  📢 Join the Movement | Participate in Fitness Activities | Inspire Change
                                                  <ul>
                                                    <li><b>Register Today</b>: Enrol your institution and students on the <b>FIT INDIA Portal</b></li>
                                                    <li><b>Engage & Promote</b>: Take part in planned activities and share your experiences online.</li>
                                                    <li><b>Empower Women</b>: Encourage fitness participation among peers and communities.</li>
                                                    <li><b>Be the Voice</b>: Use <b>#FitWomenFitIndia #IWD2025 #WomenInFitness #FitIndiaMovement</b> to amplify the message.</li>
                                                  </ul>
                                                  🌍 Act Now! Stay Fit, Stay Healthy!
                                                </p>
                                                <br/>
                                            </div>
                                          </div>




                                        {{-- <div class="row">
                                          <div class="col-md-12">

                                            <div class="accordion" id="accordionFISW">
                                              <div class="card">
                                                <div class="card-head" id="headingOne">
                                                  <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW3" aria-expanded="false" aria-controls="collapseone">
                                                    INDICATIVE LIST OF ACTIVITIES FOR FIT INDIA WEEK 2023 FOR SCHOOLS
                                                  </h2>

                                                </div>


                                                <div id="collapseFISW3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFISW">
                                                  <div class="card-body" style="padding-top:10px;">
                                                      <br>
                                                      <table class="table-grid table-bordered_cut table-bordered ">
                                                        <tr>
                                                          <th width="60px">Sl.No</th>
                                                          <th>List of activities for Fit India Week 2023 for Schools</th>
                                                        </tr>
                                                        <tr>
                                                          <td>1.</td>
                                                          <td>Annual Sports Day</td>
                                                        </tr>
                                                        <tr>
                                                          <td>2.</td>
                                                          <td>Importance of fitness- Debate, Quiz, Essay Writing, poster making competition</td>
                                                        </tr>
                                                        <tr>
                                                          <td>3.</td>
                                                          <td>Indigenous Games</td>
                                                        </tr>
                                                        <tr>
                                                          <td>4.</td>
                                                          <td>Fitness Assessment through Mobile App</td>
                                                        </tr>
                                                        <tr>
                                                          <td>5.</td>
                                                          <td>Yoga &amp; Meditation</td>
                                                        </tr>
                                                        <tr>
                                                          <td>6.</td>
                                                          <td>Fitness Pledge- by teachers, students and their parents &amp; Fit India Parents Teachers Meet</td>
                                                        </tr>
                                                      </table>

                                                    </p>
                                                <br>
                                                  </div>
                                                </div>
                                              </div>

                                              <div class="card">
                                                <div class="card-head" id="headingTwo">
                                                  <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW2" aria-expanded="false" aria-controls="collapseTwo">
                                                    INDICATIVE LIST OF ACTIVITIES FOR FIT INDIA WEEK 2023 FOR COLLEGES AND UNIVERSITIES
                                                  </h2>
                                                </div>
                                                <div id="collapseFISW2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFISW">
                                                  <div class="card-body">
                                                    <br/>
                                                    <table class="table-grid table-bordered_cut table-bordered ">
                                                      <tr>
                                                        <th width="60px">Day</th>
                                                        <th>Indicative List of activities for Fit India Week 2023 for Colleges and Universities</th>
                                                      </tr>
                                                      <tr>
                                                        <td>1.</td>
                                                        <td>Popular Sports &amp; Fun Games</td>
                                                      </tr>
                                                      <tr>
                                                        <td>2.</td>
                                                        <td>Importance of fitness- Debate, Quiz, Essay Writing, poster making competition</td>
                                                      </tr>
                                                      <tr>
                                                        <td>3.</td>
                                                        <td>Fitness Assessment through Mobile App</td>
                                                      </tr>
                                                      <tr>
                                                        <td>4.</td>
                                                        <td>Fitness Pledge- by student and faculty and Yoga &amp; Meditation</td>
                                                      </tr>
                                                      <tr>
                                                        <td>5.</td>
                                                        <td>Indigenous Games</td>
                                                      </tr>
                                                      <tr>
                                                        <td>6.</td>
                                                        <td>Idea generation contests &amp; Entrepreneurship Building</td>
                                                      </tr>
                                                    </table>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>


                                          </div>
                                        </div> --}}
                                      </div>
                            </div>
                        </article>

                        <article class="tab-pane" id="fit-india-week-2024">
                            <div class="banner_area1">
                                {{-- <img src="{{ asset('resources/imgs/home/schholweek-banner17-12-2021.png') }}" alt="school-week" title="school-week" class="img-fluid expand_img" /> --}}
                                <div class="banner">
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                                {{-- <img src="{{ asset('resources/imgs/event2023/sportsday-banner.jpg') }}" alt="sports-day" title="national-sports-day" class="img-fluid expand_img" /> --}}
                                                <div class="carousel-inner">
                                                    <div class="carousel-item mer_banner active">
                                                      <a href="{{ url('fit-india-week-2024') }}">
                                                        <img src="{{ asset('resources/imgs/fid2024/fitindiaweek2024banner1.png') }}" class="d-block w-100" alt="Fit-india-week-2024" title="Fit-india-week-2024">
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
                                                      <a href="{{ url('fit-india-week-2024') }}">
                                                        <img src="{{ asset('resources/imgs/fid2024/fitindiaweek2024banner2.png') }}" class="d-block w-100" alt="Fit-india-week-2024" title="Fit-india-week-2024">
                                                        <div class="some-absolute-div bannerPos1">
                                                            <div class="centered-in-absolute">
                                                                  @csrf
                                                                  <div class="text-center">
                                                                      <input type="hidden" name="banner_type" value="week_1">
                                                                  </div>
                                                            </div>
                                                        </div>
                                                      </a>
                                                    </div>
                                                    {{-- <div class="carousel-item mer_banner">
                                                      <a href="{{ url('fit-india-week-2023') }}">
                                                        <img src="{{ asset('resources/imgs/fitindiaweek2023/webbanner3.png') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">
                                                        <div class="some-absolute-div bannerPos1">
                                                            <div class="centered-in-absolute">
                                                                    @csrf
                                                              <div class="text-center">
                                                                  <input type="hidden" name="banner_type" value="week_1">
                                                              </div>
                                                            </div>
                                                        </div>
                                                      </a>
                                                    </div> --}}
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
                                <section id="{{ $active_section_id }}">
                                    <div class="container">
                                        <div class="row">
                                          {{-- <a class="freedombtn1" href="register/">Register</a> --}}
                                          {{-- <a class="freedombtn3" href="{{ url('register-for-fit-india-2023') }}">How To Register pending</a>  --}}
                                          {{-- <a class="freedombtn3" href="{{ url('resources/pdf/how-to-register-for-fit-india-week-2024.pdf') }}" target="_blank">How To Register</a> --}}
                                          <a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="{{ url('fiw-past-glimpses-2024') }}" data-target="#merchandisId" target="_blank">Past Glimpses</a>
                                          <a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="{{ url('resources/pdf/SOP-Fit-India-Week-6.0.pdf') }}" data-target="#merchandisId" target="_blank">SOP</a>
                                          <a class="freedombtn3 freedombtn4" href="{{ url('fitindiaindiaweekmerchandise2024') }}" data-target="#merchandisId" target="_blank">Merchandise/Creatives</a>
                                          <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;"  href="{{ url('fit-india-pledge-2024') }}" target="_blank">Fit India Pledge</a>
                                        </div>
                                        <div class="row">
                                          <div class="col-sm-12">
                                            <h1 class="headingh1">Fit India Week</h1>
                                                  <p>
                                                Fit India School Week was conceived in 2019 with the imperative need of creating awareness about
                                                fitness not limited to children but also their parents, teachers, and school staff. In this campaign,
                                                school fraternities across the country are encouraged to celebrate 4 to 6 days in a week to promote a
                                                healthy and active lifestyle by indulging in various activities such as debates, quiz, essay writing,
                                                poster-making competitions, yoga and meditation, pledge of fitness, indigenous sports etc.
                                              </p>
                                              <p>
                                                The 1st edition of Fit India School Week was celebrated in the 3rd week of November 2019 as Fitness
                                                Week in partnership with the Ministry of Education. In the 2nd edition, Fit India school week was
                                                conducted from December 2020 to January 2021. More than 4.3 lakh schools celebrated the Fit India
                                                school week across the nation. The 3rd edition of Fit India School week was organized from November
                                                2021 to January 2022. The Fit India School Week witnessed more than 4.5 lakh participants across
                                                from all over India. The 4th edition of Fit India School Week was organized from 15th November to 15th
                                                December 2023. Additionally, all schools were encouraged to celebrate their annual sports day during
                                                Fit India School Week.
                                              </p>
                                              <p>
                                                The 5th edition of Fit India School Week was rechristened as “Fit India Week 2023” to expand the
                                                outreach of the week to include colleges, universities and higher educational institutions (HEI) and
                                                organized from 15th November 2023 to 31st January 2024.
                                              </p>
                                              <p>
                                                The 4th edition of Fit India School week was organized from 15th November 2022 to 31st January 2023 and witnessed more than 5.56 Lakhs schools participating from all over India. In order to propagate and popularize the Fit India School Week among the school fraternity and general population at large, the public representatives namely the Hon’ble Members of Parliament and Hon’ble Members of Legislative Assembly were requested to attend the Fit India School Week celebrations in a school in their respective constituency. Their presence played a pivotal role in showcasing the popularity of Fit India School Week which was further amplified by extensive media coverages.
                                              </p>
                                              <p>
                                                Building on the enthusiasm of previous editions of Fit India Week, this year, it is to be observed from
                                                15th November 2024 to 31st December 2024. The Fit India Week 2024 will involve an elaborate media
                                                amplification to further popularize and improve the visibility of the campaign. #FIW2024 #FitIndia
                                              </p>
                                          <br/>
                                          </div>
                                        </div>




                                        {{-- <div class="row">
                                          <div class="col-md-12">

                                            <div class="accordion" id="accordionFISW">
                                              <div class="card">
                                                <div class="card-head" id="headingOne">
                                                  <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW3" aria-expanded="false" aria-controls="collapseone">
                                                    INDICATIVE LIST OF ACTIVITIES FOR FIT INDIA WEEK 2023 FOR SCHOOLS
                                                  </h2>

                                                </div>


                                                <div id="collapseFISW3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFISW">
                                                  <div class="card-body" style="padding-top:10px;">
                                                      <br>
                                                      <table class="table-grid table-bordered_cut table-bordered ">
                                                        <tr>
                                                          <th width="60px">Sl.No</th>
                                                          <th>List of activities for Fit India Week 2023 for Schools</th>
                                                        </tr>
                                                        <tr>
                                                          <td>1.</td>
                                                          <td>Annual Sports Day</td>
                                                        </tr>
                                                        <tr>
                                                          <td>2.</td>
                                                          <td>Importance of fitness- Debate, Quiz, Essay Writing, poster making competition</td>
                                                        </tr>
                                                        <tr>
                                                          <td>3.</td>
                                                          <td>Indigenous Games</td>
                                                        </tr>
                                                        <tr>
                                                          <td>4.</td>
                                                          <td>Fitness Assessment through Mobile App</td>
                                                        </tr>
                                                        <tr>
                                                          <td>5.</td>
                                                          <td>Yoga &amp; Meditation</td>
                                                        </tr>
                                                        <tr>
                                                          <td>6.</td>
                                                          <td>Fitness Pledge- by teachers, students and their parents &amp; Fit India Parents Teachers Meet</td>
                                                        </tr>
                                                      </table>

                                                    </p>
                                                <br>
                                                  </div>
                                                </div>
                                              </div>

                                              <div class="card">
                                                <div class="card-head" id="headingTwo">
                                                  <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW2" aria-expanded="false" aria-controls="collapseTwo">
                                                    INDICATIVE LIST OF ACTIVITIES FOR FIT INDIA WEEK 2023 FOR COLLEGES AND UNIVERSITIES
                                                  </h2>
                                                </div>
                                                <div id="collapseFISW2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFISW">
                                                  <div class="card-body">
                                                    <br/>
                                                    <table class="table-grid table-bordered_cut table-bordered ">
                                                      <tr>
                                                        <th width="60px">Day</th>
                                                        <th>Indicative List of activities for Fit India Week 2023 for Colleges and Universities</th>
                                                      </tr>
                                                      <tr>
                                                        <td>1.</td>
                                                        <td>Popular Sports &amp; Fun Games</td>
                                                      </tr>
                                                      <tr>
                                                        <td>2.</td>
                                                        <td>Importance of fitness- Debate, Quiz, Essay Writing, poster making competition</td>
                                                      </tr>
                                                      <tr>
                                                        <td>3.</td>
                                                        <td>Fitness Assessment through Mobile App</td>
                                                      </tr>
                                                      <tr>
                                                        <td>4.</td>
                                                        <td>Fitness Pledge- by student and faculty and Yoga &amp; Meditation</td>
                                                      </tr>
                                                      <tr>
                                                        <td>5.</td>
                                                        <td>Indigenous Games</td>
                                                      </tr>
                                                      <tr>
                                                        <td>6.</td>
                                                        <td>Idea generation contests &amp; Entrepreneurship Building</td>
                                                      </tr>
                                                    </table>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>


                                          </div>
                                        </div> --}}
                                        <h4>Activities for Schools/ Colleges and Universities</h4>
                                        <table class="table-grid table-bordered_cut table-bordered ">
                                          <tr>
                                            <th width="60px">Day</th>
                                            <th>Indicative List of activities for Fit India Week 2024 for Schools/ Colleges and Universities</th>
                                          </tr>
                                          <tr>
                                            <td>1.</td>
                                            <td>Annual Sports Day, Popular Sports & Fun Games</td>
                                          </tr>
                                          <tr>
                                            <td>2.</td>
                                            <td>Importance of fitness- Debate, Quiz, Essay Writing, poster making competition</td>
                                          </tr>
                                          <tr>
                                            <td>3.</td>
                                            <td>Indigenous Games</td>
                                          </tr>
                                          <tr>
                                            <td>4.</td>
                                            <td>Fitness Assessment through Mobile App</td>
                                          </tr>
                                          <tr>
                                            <td>5.</td>
                                            <td>Yoga & Meditation</td>
                                          </tr>
                                          <tr>
                                            <td>6.</td>
                                            <td>Fitness Pledge- by teachers, students and their parents & Fit India Parents Teachers Meet</td>
                                          </tr>
                                          <tr>
                                            <td>7.</td>
                                            <td>Idea generation contests & Entrepreneurship Building in HEI & Colleges</td>
                                          </tr>
                                          <tr >
                                            <th colspan="2">
                                              <center>
                                                Schools /Colleges/ HEI and Universities to encourage students to commute by bicycle during the
                                                week with adequate focus on road safety
                                              </center>
                                            </th>
                                          </tr>
                                        </table>
                                      </div>
                            </div>
                        </article>

                        <article class="tab-pane" id="fit-india-swacchta-freedom-run-5">
                            <div class="banner_area1">
                                {{-- <img src="{{ asset('resources/imgs/home/schholweek-banner17-12-2021.png') }}" alt="school-week" title="school-week" class="img-fluid expand_img" /> --}}
                                <div class="banner">
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                                {{-- <img src="{{ asset('resources/imgs/event2023/sportsday-banner.jpg') }}" alt="sports-day" title="national-sports-day" class="img-fluid expand_img" /> --}}
                                                <div class="carousel-inner">
                                                    <div class="carousel-item mer_banner active">
                                                      <a href="{{ url('fit-india-swacchta-freedom-run-5.0') }}">
                                                        <img src="{{ asset('resources/imgs/banner-image/fit-india-swacchta-freedom-Run-5.0.jpeg') }}" class="d-block w-100" alt="Fit India Swacchta Freedom-Run 5.0" title="Fit India Swacchta Freedom Run 5.0">
                                                      </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <section id="{{ $active_section_id }}">
                                    <div class="container">
                                        <div class="row">
                                          {{-- <a class="freedombtn1" href="register/">Register</a> --}}
                                          {{-- <a class="freedombtn3" href="{{ url('resources/pdf/how-to-register-for-fit-india-swacchta-freedom-run-5.0.pdf') }}" target="_blank">How To Register</a> --}}
                                          <a class="freedombtn3 freedombtn4" href="{{ url('freedom-run-5.0-merchandise') }}" data-target="#merchandisId" target="_blank">Merchandise/Creatives</a>
                                          <a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="{{ url('resources/pdf/SOP_SwachhtaFreedomRun5.0.pdf') }}" data-target="#merchandisId" target="_blank">SOP</a>
                                          <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;" href="{{ url('fit-india-pledge-freedom-run-5') }}" target="_blank">Fit India Pledge</a>
                                          <a class="freedombtn3 freedombtn4" style="background-color:#4267B2;" href="{{ url('past-glimpses-freedom-run-5') }}" data-target="#merchandisId" target="_blank">Past Glimpses</a>
                                          {{-- <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;" href="{{ url('resources/pdf/FIT-INDIA-PLEDGE-v1.pdf') }}" target="_blank">Fit India Pledge</a> --}}
                                        </div>
                                        <div class="row">
                                          <div class="col-sm-12">
                                            <h1 class="headingh1">Fit India Swacchta Freedom Run 5.0</h1>
                                                  <p>
                                                RUNNING: The human body’s rawest form of FREEDOM”
                                              </p>
                                              <p>
                                                Fit India Mission in its endeavour to promote fitness and creating awareness amongst countrymen keeps coming with
                                                innovating fitness campaigns to indulge people in fitness activities. Fit India Mission converges with Swachh
                                                Bharat Abhiyan with Fit India Freedom Run where fitness meets Swachhata in a form of engaging fun-loving exercise
                                                is now entailed in Fit India Freedom Run culminating where we discover a litter free clean surroundings while running.
                                              </p>
                                              <p>
                                                <b>Fit India Swachhata Freedom Run</b>
                                              </p>
                                              <p>
                                                Fit India Freedom Run was conceived in 2020 when the entire nation started following
                                                social distancing in a ‘new normal’ lifestyle, so as to keep the imperative need of fitness
                                                active even while following the social distancing norms. The campaign’s objective is to
                                                encourage fitness and help us all to get freedom from obesity, laziness, stress, anxiety,
                                                diseases etc. The Fit India Freedom Run is yet another endeavour to strengthen the Fit
                                                Indian Movement and involve citizens to embrace fitness as a way of life. Participants will
                                                be allowed to run at their own place and at their own pace at a time convenient to them
                                                during campaign period. The concept behind this run is that “It can be run at anytime and
                                                anywhere!
                                              </p>
                                              <p>
                                                Till yet four editions of the campaign have been held in 2020, 2021 2022 &amp; 2023
                                                respectively and the campaign has seen tremendous support from various stakeholders
                                                such as government, private organizations and individuals from all walks of life and
                                                demographics making it a truly people’s campaign. This year, Fit India Mission has decided
                                                to organize the 5th edition i.e. Fit India Swachhata Freedom Run 5.0 from 2nd October to
                                                31st October 2024. Citizens will be urged to inculcate 30 minutes of physical fitness in any
                                                form, celebrate achievements of active lifestyle and make a resolve to remain fit “Swachh
                                                Bharat Swasth Bharat”. The campaign will kick-off with a Swachhata Freedom Run on 2nd
                                                October 2024 followed by running events for the remainder of the campaign i.e., till 31st
                                                October 2024.
                                              </p>
                                              <p>
                                                Fit India Swachhata Freedom Run has always been in Fit India Mission charter as the first
                                                event organized under the aegis of Fit India Mission was Fit India Plog Run held on 2nd
                                                October 2019 i.e., 150th anniversary of Mahatma Gandhi.
                                              </p>
                                              <p>
                                                Let’s be a part of RUN that matters to us as well as to surroundings!
                                              </p>
                                              <p>
                                                Promote Fit India Swachhata Freedom Run 5.0 on your social media channels by #
                                                SwachhBharatSwasthBharat # Run4India
                                              </p>
                                              <p>
                                                <b>Points to remember:</b>
                                              </p>
                                              <ul>
                                                <li>Run a route of your choice, at a time that suits you.</li>
                                                <li>Break-up your runs.</li>
                                                <li>Run your own race at your pace.</li>
                                                <li>Track your kms or by using Fit India Mobile App.</li>
                                                <li>Create an event on Fit India Portal either as an individual or as an organiser as per
                                                    your eligibility for any number of day(s) starting from 1st October till 31st October
                                                </li>
                                                <li>Can run any number of KM's (take a selfie or a photo and upload it while creating an event)</li>
                                              </ul>
                                              <p>
                                                <b>Mode of participation:</b>
                                              </p>
                                              <ul>
                                                <li>The participation is through a dedicated portal for registering the events on this
                                                    occasion developed through the Fit India Mission, accessible from its website and
                                                    Fit India Mobile App.
                                                </li>
                                                <li>
                                                  Organizers to register their event on <b>Fit India portal (https://fitindia.gov.in) or
                                                  Fit India Mobile App </b> and upload details of participation, pictures &amp; videos of the
                                                  event and download the certificate.
                                                </li>
                                                <li>
                                                  Those who have undertaken their own run can Register as individual, submit their
                                                  data and download the certificate.
                                                </li>
                                                <li>
                                                  FIT India Fitness Pledge: In addition, all the organizations may organize a FIT India
                                                  Fitness pledge event where all key stakeholders including their employees may take
                                                  the FIT India Fitness pledge.
                                                </li>
                                              </ul>
                                              <p>
                                                Organisers will have to register their Event/marathons on Fit India portal. They will use
                                                the Fit India Logo for all promotional media and provide the data of participants with their
                                                cumulative kms covered to download certificate.
                                              </p>
                                              <p>
                                                <b>For any queries, please contact:</b>
                                                <br>
                                                Phone No: 1800-202-5155
                                                <br>
                                                Email ID: contact[at]fitindia[dot]gov[dot]in
                                                <br>
                                                Timing: Monday-Friday (9:00-5:30pm)
                                              </p>
                                              {{-- <p><strong><u>Standard format of the event to be:</strong></u></p> --}}
                                              {{-- <p>
                                                <ul>
                                                  <li>Each organization to be divided into two, four or six teams depending on the number of participations maintaining gender equality.</li>
                                                  <li>Medal tally for each team to be maintained. Highest points team will win Major Dhyan Chand Trophy.</li>
                                                  <li>Organizations are at liberty to choose games for competition from any popular sports of the locality and availability of Infrastructure.</li>
                                                  <li>Name of teams can be based on freedom fighters or prominent sportspersons of the country.</li>
                                                </ul>
                                              </p> --}}
                                              {{-- <p>The list of suggested competitive and fun games is-</p> --}}
                                              {{-- <table>
                                                <tr style="border: 1px; background-color:#4267B2; color:#ffffff !important;">
                                                  <th>S.No.</th>
                                                  <th>Outdoor Activities</th>
                                                  <th>Indoor Activities</th>
                                                  <th>Fun Activities</th>
                                                </tr>
                                                <tr>
                                                  <td>1</td>
                                                  <td>Walk/Race</td>
                                                  <td>Badminton</td>
                                                  <td>Lemon Race/ Sack Race</td>
                                                </tr>
                                                <tr>
                                                  <td>2</td>
                                                  <td>Volleyball</td>
                                                  <td>Chess</td>
                                                  <td>Rope Jumping</td>
                                                </tr>
                                                <tr>
                                                  <td>3</td>
                                                  <td>Hockey (Penalty Shootout)</td>
                                                  <td>Basketball (3v3)</td>
                                                  <td>Kho-Kho</td>
                                                </tr>
                                                <tr>
                                                  <td>4</td>
                                                  <td>Futsal/Mini Football (3 vs 3)</td>
                                                  <td>Table Tennis</td>
                                                  <td>Lagori &amp; Langadi</td>
                                                </tr>
                                                <tr>
                                                  <td>5</td>
                                                  <td>Tennis Ball Cricket</td>
                                                  <td>Tug of War</td>
                                                  <td>Plank Challenge</td>
                                                </tr>
                                              </table> --}}
                                              {{-- <p>
                                                <strong><i>*Office will be at liberty to choose games for competition from any popular sports of the locality and availability of Infrastructure.</i></strong>
                                              </p>
                                              <p><strong>FIT India Fitness Pledge: </strong>In addition, all the organizations may organize a FIT India Fitness pledge event where all key stakeholders including their employees may take the
                                                FIT India Fitness pledge.</p>
                                              <p><strong>A dedicated portal for registering the events on this occasion </strong>developed through the Fit India Mission, accessible from its website and Fit India Mobile App.</p>
                                              <p>Organizers to register their event on Fit India portal (<a href="https://fitindia.gov.in">https://fitindia.gov.in</a>) or Fit India Mobile App and upload details of participation, pictures &amp; videos of the event.</p>             --}}
                                            {{-- <br/>
                                            <p>For more details kindly visit the following link:
                                            <br/>
                                            <a href="https://drive.google.com/drive/folders/1thgTxydnX0VfIjaLrS2DmaEle2LHHh_e?usp=sharing" target="_blank">https://drive.google.com/drive/folders/1thgTxydnX0VfIjaLrS2DmaEle2LHHh_e?usp=sharing</a></p> --}}
                                              </div>
                                        </div>




                                        {{-- <div class="row">
                                          <div class="col-md-12">

                                            <div class="accordion" id="accordionFISW">
                                              <div class="card">
                                                <div class="card-head" id="headingOne">
                                                  <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW3" aria-expanded="false" aria-controls="collapseone">
                                                    INDICATIVE LIST OF ACTIVITIES FOR FIT INDIA WEEK 2023 FOR SCHOOLS
                                                  </h2>

                                                </div>


                                                <div id="collapseFISW3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFISW">
                                                  <div class="card-body" style="padding-top:10px;">
                                                      <br>
                                                      <table class="table-grid table-bordered_cut table-bordered ">
                                                        <tr>
                                                          <th width="60px">Sl.No</th>
                                                          <th>List of activities for Fit India Week 2023 for Schools</th>
                                                        </tr>
                                                        <tr>
                                                          <td>1.</td>
                                                          <td>Annual Sports Day</td>
                                                        </tr>
                                                        <tr>
                                                          <td>2.</td>
                                                          <td>Importance of fitness- Debate, Quiz, Essay Writing, poster making competition</td>
                                                        </tr>
                                                        <tr>
                                                          <td>3.</td>
                                                          <td>Indigenous Games</td>
                                                        </tr>
                                                        <tr>
                                                          <td>4.</td>
                                                          <td>Fitness Assessment through Mobile App</td>
                                                        </tr>
                                                        <tr>
                                                          <td>5.</td>
                                                          <td>Yoga &amp; Meditation</td>
                                                        </tr>
                                                        <tr>
                                                          <td>6.</td>
                                                          <td>Fitness Pledge- by teachers, students and their parents &amp; Fit India Parents Teachers Meet</td>
                                                        </tr>
                                                      </table>

                                                    </p>
                                                <br>
                                                  </div>
                                                </div>
                                              </div>

                                              <div class="card">
                                                <div class="card-head" id="headingTwo">
                                                  <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW2" aria-expanded="false" aria-controls="collapseTwo">
                                                    INDICATIVE LIST OF ACTIVITIES FOR FIT INDIA WEEK 2023 FOR COLLEGES AND UNIVERSITIES
                                                  </h2>
                                                </div>
                                                <div id="collapseFISW2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFISW">
                                                  <div class="card-body">
                                                    <br/>
                                                    <table class="table-grid table-bordered_cut table-bordered ">
                                                      <tr>
                                                        <th width="60px">Day</th>
                                                        <th>Indicative List of activities for Fit India Week 2023 for Colleges and Universities</th>
                                                      </tr>
                                                      <tr>
                                                        <td>1.</td>
                                                        <td>Popular Sports &amp; Fun Games</td>
                                                      </tr>
                                                      <tr>
                                                        <td>2.</td>
                                                        <td>Importance of fitness- Debate, Quiz, Essay Writing, poster making competition</td>
                                                      </tr>
                                                      <tr>
                                                        <td>3.</td>
                                                        <td>Fitness Assessment through Mobile App</td>
                                                      </tr>
                                                      <tr>
                                                        <td>4.</td>
                                                        <td>Fitness Pledge- by student and faculty and Yoga &amp; Meditation</td>
                                                      </tr>
                                                      <tr>
                                                        <td>5.</td>
                                                        <td>Indigenous Games</td>
                                                      </tr>
                                                      <tr>
                                                        <td>6.</td>
                                                        <td>Idea generation contests &amp; Entrepreneurship Building</td>
                                                      </tr>
                                                    </table>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>


                                          </div>
                                        </div> --}}
                                      </div>
                            </div>
                        </article>

                        <article class="tab-pane" id="Fit-India-week-id-2023">
                            <div class="banner_area1">
                                {{-- <img src="{{ asset('resources/imgs/home/schholweek-banner17-12-2021.png') }}" alt="school-week" title="school-week" class="img-fluid expand_img" /> --}}
                                <div class="banner">
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                                {{-- <img src="{{ asset('resources/imgs/event2023/sportsday-banner.jpg') }}" alt="sports-day" title="national-sports-day" class="img-fluid expand_img" /> --}}
                                                <div class="carousel-inner">
                                                    <div class="carousel-item mer_banner active">
                                                      <a href="{{ url('fit-india-week-2023') }}">
                                                        <img src="{{ asset('resources/imgs/fitindiaweek2023/webbanner1.png') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">
                                                        <div class="some-absolute-div bannerPos1">
                                                            <div class="centered-in-absolute">
                                                                {{-- <form action="{{route('download-school-banner')}}" method="POST"> --}}
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
                                                                        {{-- <button type="submit" name="banner_submit" value="Submit" class="mer_btn">Download</button> --}}
                                                                    </div>

                                                                {{-- </form> --}}
                                                            </div>
                                                        </div>
                                                      </a>
                                                    </div>
                                                    <div class="carousel-item mer_banner">
                                                      <a href="{{ url('fit-india-week-2023') }}">
                                                        <img src="{{ asset('resources/imgs/fitindiaweek2023/webbanner2.png') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">
                                                        <div class="some-absolute-div bannerPos1">
                                                            <div class="centered-in-absolute">
                                                                {{-- <form action="{{route('download-school-banner')}}" method="POST"> --}}
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
                                                                        {{-- <button type="submit" name="banner_submit" value="Submit" class="mer_btn">Download</button> --}}
                                                                    </div>

                                                                {{-- </form> --}}
                                                            </div>
                                                        </div>
                                                      </a>
                                                    </div>
                                                    <div class="carousel-item mer_banner">
                                                      <a href="{{ url('fit-india-week-2023') }}">
                                                        <img src="{{ asset('resources/imgs/fitindiaweek2023/webbanner3.png') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">
                                                        <div class="some-absolute-div bannerPos1">
                                                            <div class="centered-in-absolute">
                                                                {{-- <form action="{{route('download-school-banner')}}" method="POST"> --}}
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
                                                                        {{-- <button type="submit" name="banner_submit" value="Submit" class="mer_btn">Download</button> --}}
                                                                    </div>

                                                                {{-- </form> --}}
                                                            </div>
                                                        </div>
                                                      </a>
                                                    </div>



                                                    {{-- <div class="carousel-item mer_banner">

                                                        <img src="{{ asset('resources/imgs/event2023/WebBannerEnglish2.jpg') }}" class="d-block w-100" alt="Fit-india-quiz" title="Fit-india-quiz"> </a>
                                                        <div class="some-absolute-div bannerPos2">
                                                            <div class="centered-in-absolute"> --}}
                                                                {{-- <form action="{{route('download-school-banner')}}" method="POST"> --}}
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
                                                                        {{-- <button type="submit" name="banner_submit" value="Submit" class="mer_btn">Download</button> --}}
                                                                    </div>

                                                                {{-- </form> --}}
                                                            {{-- </div>
                                                        </div>
                                                    </div> --}}

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
                                <section id="{{ $active_section_id }}">
                                    <div class="container">
                                        <div class="row">
                                            {{-- <a class="freedombtn1" href="register/">Register</a> --}}
                                            {{-- <a class="freedombtn3" href="{{ url('register-for-fit-india-2023') }}">How To Register</a> --}}
                                            <a class="freedombtn3 freedombtn4" href="{{ url('fitindiaindiaweekmerchandise2023') }}" data-target="#merchandisId">Merchandise/Creatives</a>
                                            <a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="{{ url('past-glimpses-2023') }}" data-target="#merchandisId">Past Glimpses</a>
                                            <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;"  href="{{ url('fit-india-pledge-2023') }}">Fit India Pledge</a>
                                          </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                  <h1 class="headingh1">Fit India Week</h1>
                                                        <p>
                                                      Fit India School Week was conceived in the year 2019 with the imperative need of creating awareness about fitness among children,
                                                      parents, teachers and school staff. <b>In this campaign, school fraternities across the country were encouraged to celebrate 4 to 6 days in a week to
                                                      promote a healthy and active lifestyle by indulging in various activities such as debates, quiz, essay writing, poster-making competitions,
                                                      yoga and meditation, pledge of fitness, indigenous sports, running/races, cycling races, popular sports & fun games, idea generation contests &
                                                      entrepreneurship building etc.</b> The 1st edition of Fit India School Week was celebrated in the 3rd week of November 2019 as Fitness Week in partnership
                                                      with the Ministry of Education. More than 15,000 schools participated in the 1st edition of Fit India School week.
                                                    </p>
                                                    <p>
                                                      The 2nd edition of Fit India school week was conducted from December 2020 to January 2021. Due to the pandemic prevalent at that time,
                                                      it was suggested to organize the school week in both virtual and offline formats. A virtual event was coordinated by KVS no- 2.
                                                      Kochi to showcase Fit India School Week celebrations.
                                                      More than 4.3 lakh schools celebrated the Fit India school week across the nation.
                                                    </p>
                                                    <p>
                                                      The 3rd edition of Fit India School week was organized from 14th November 2021 to 12th December 2021 and was extended till 31st January 2022. The Fit India School Week witnessed more than 4.5 lakh participants from all over India. Activities like Yoga, Dance. Debates, symposiums, Lectures etc. were part of the celebration in Fit India School Week.
                                                    </p>
                                                    <p>
                                                      The 4th edition of Fit India School week was organized from 15th November 2022 to 31st January 2023 and witnessed more than 5.56 Lakhs schools participating from all over India. In order to propagate and popularize the Fit India School Week among the school fraternity and general population at large, the public representatives namely the Hon’ble Members of Parliament and Hon’ble Members of Legislative Assembly were requested to attend the Fit India School Week celebrations in a school in their respective constituency. Their presence played a pivotal role in showcasing the popularity of Fit India School Week which was further amplified by extensive media coverages.
                                                    </p>
                                                    <p>
                                                      Continuing with the enthusiasm of the schools and in pursuit of spreading the message of fitness among various segments of the population,<b> this year, the Fit India Mission has decided to expand the outreach of the Fit India School Week to include colleges, universities and higher education institutions. Therefore, the 5th edition of Fit India School Week has been named as ‘Fit India Week’ for Schools and Universities, and will be observed from 15th November to 15st December 2023.</b> Schools, Colleges, Universities, and Higher Education Institutions can select any one week within this duration to celebrate the Fit India Week program.
                                                    </p>
                                                <br/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="accordion" id="accordionFISW">
                                                    <div class="card">
                                                        <div class="card-head" id="headingOne">
                                                            <h2 class="mb-0" data-toggle="collapse" data-target="#collapseFISW1" aria-expanded="true" aria-controls="collapseOne">
                                                                INDICATIVE LIST OF ACTIVITIES FOR FIT INDIA WEEK 2023 FOR SCHOOLS
                                                            </h2>
                                                        </div>
                                                        <div id="collapseFISW1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionFISW">
                                                            <div class="card-body" style="padding-top:10px;">
                                                                <table class="table-grid table-bordered_cut table-bordered ">
                                                                    <tr>
                                                                      <th width="60px">Sl.No</th>
                                                                      <th>List of activities for Fit India Week 2023 for Schools</th>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>1.</td>
                                                                      <td>Annual Sports Day</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>2.</td>
                                                                      <td>Importance of fitness- Debate, Quiz, Essay Writing, poster making competition</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>3.</td>
                                                                      <td>Indigenous Games</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>4.</td>
                                                                      <td>Fitness Assessment through Mobile App</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>5.</td>
                                                                      <td>Yoga &amp; Meditation</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>6.</td>
                                                                      <td>Fitness Pledge- by teachers, students and their parents &amp; Fit India Parents Teachers Meet</td>
                                                                    </tr>
                                                                  </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-head" id="headingTwo">
                                                            <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW2" aria-expanded="false" aria-controls="collapseTwo">
                                                                INDICATIVE LIST OF ACTIVITIES FOR FIT INDIA WEEK 2023 FOR COLLEGES AND UNIVERSITIES
                                                            </h2>
                                                        </div>
                                                        <div id="collapseFISW2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFISW">
                                                            <div id="collapseFISW2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFISW">
                                                                <div class="card-body">
                                                                  <br/>
                                                                  <table class="table-grid table-bordered_cut table-bordered ">
                                                                    <tr>
                                                                      <th width="60px">Day</th>
                                                                      <th>Indicative List of activities for Fit India Week 2023 for Colleges and Universities</th>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>1.</td>
                                                                      <td>Popular Sports &amp; Fun Games</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>2.</td>
                                                                      <td>Importance of fitness- Debate, Quiz, Essay Writing, poster making competition</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>3.</td>
                                                                      <td>Fitness Assessment through Mobile App</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>4.</td>
                                                                      <td>Fitness Pledge- by student and faculty and Yoga &amp; Meditation</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>5.</td>
                                                                      <td>Indigenous Games</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>6.</td>
                                                                      <td>Idea generation contests &amp; Entrepreneurship Building</td>
                                                                    </tr>
                                                                  </table>
                                                                </div>
                                                              </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </article>
                        <!-- -----------------------------CLOSE Fit-India-Week-2021--------------------------------------- -->

                        <!-- -----------------------------Fit-India-2022 Event--------------------------------------- -->

                        <article class="tab-pane" id="national-sports-day-2022">
                            <div class="banner_area1">
                                <img src="{{ asset('resources/imgs/home/sportsday-banner.jpg') }}" alt="school-week" title="school-week" class="img-fluid expand_img" />
                                <section id="{{ $active_section_id }}">
                                    <div class="container">
                                        <div class="row">
                                            {{-- <a class="freedombtn1" href="register/">Register as an Organiser</a> --}}
                                            <!-- <a class="freedombtn2" href="{{ url('wp-content/uploads/2021/01/FAQ-Fit-India-School-Week.pdf') }} " target="_blank">FAQ-School Week 2020</a> -->
                                            {{-- <a class="freedombtn3" href="{{ url('resources/pdf/school-week-how-to-register.pdf') }}" target="_blank">How To Register</a> --}}

                                            {{-- <a class="freedombtn4" href="javascript:void(0)" data-toggle="modal" data-target="#merchandisId">Download Merchandise</a> --}}
                                        </div><br>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h1 class="headingh1">NATIONAL SPORTS DAY</h1>
                                                <p>India celebrates National Sports Day on 29th August to commemorate the birth anniversary of hockey legend, Major Dhyan Chand. The day is also dedicated to the nations’ sports heroes and champions, honoring their contribution and dedication towards bringing laurels to the country.  With the aim to raise awareness about the values of sports: discipline, perseverance, sportsman spirit, teamwork, and to encourage public in large to take up sports and make it an integral part of their lives while emphasizing on the importance of being fit and healthy. </p>
                                                <br/>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="accordion" id="accordionFISW">
                                                    <div class="card">
                                                        <div class="card-head" id="headingOne">
                                                            <h2 class="mb-0" data-toggle="collapse" data-target="#collapseFISW1" aria-expanded="true" aria-controls="collapseOne">
                                                                How to participate
                                                            </h2>
                                                        </div>

                                                        <div id="collapseFISW1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionFISW">
                                                            <div class="card-body" style="padding-top:10px;">
                                                                <p>
                                                                    <strong style=" font-size:16px;">
                                                                        What can we do to pay tribute to the biggest sporting icon of Indian History
                                                                    </strong>
                                                                    <br/><br/>
                                                                    This year the ‘Ministry of Youth Affairs & Sports’ (MYAS) and ‘Fit India Mission’ aim to take FIT India movement to Schools/Colleges/Ministries/Govt & Pvt Organisations by encouraging them to participate in a grand manner on the occasion of National Sports Day on any day between 21st August and 29th August 2023. On that day, Schools/Colleges/Ministries/Govt & Pvt Organisations should encourage their students/employees/staff to take part in sports/fitness activities for at least 1 hour.
                                                                  </p>
                                                                    <p>
                                                                        Suggested activities to engage the participants are as follows:
                                                                        <br>
                                                                        <table class="table-grid table-bordered_cut table-bordered ">
                                                                            <tr>
                                                                                <th width="60px">S. No</th>
                                                                                <th>Outdoor Activity</th>
                                                                                <th>Indoor Activity</th>
                                                                                <th>Fun Activity</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>1</td>
                                                                                <td>Football</td>
                                                                                <td>Badminton</td>
                                                                                <td>Sack Race</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>2</td>
                                                                                <td>Running</td>
                                                                                <td>Volleyball</td>
                                                                                <td>Lemon Race</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>3</td>
                                                                                <td>Kho-Kho</td>
                                                                                <td>Handball</td>
                                                                                <td>Rope Skipping</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>4</td>
                                                                                <td>Tennis</td>
                                                                                <td>Basketball</td>
                                                                                <td>Aerobics</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>5</td>
                                                                                <td>Hockey</td>
                                                                                <td>Table-Tennis</td>
                                                                                <td>Squat Challenge</td>
                                                                            </tr>

                                                                        </table>
                                                                    </p>
                                                                    <p><strong style=" font-size:16px;">Mode of participation</strong></p>
                                                                        <ul style="list-style-type: circle; margin-left: 15px;">
                                                                            <li>Schools/Colleges/Ministries/Govt & Private Organisations to register on Fit India website (Click on this link - on <a href="https://fitindia.gov.in/national-sports-day-2022">https://fitindia.gov.in/national-sports-day-2022</a> and provide all necessary details</li>
                                                                            <li>Schools/Colleges/Ministries/Govt & Pvt Organisations to submit their data and upload photos / video links from the events conducted by them to download e-certificate</li>
                                                                        </ul>
                                                                    <br/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card">
                                                        <div class="card-head" id="headingTwo">
                                                            <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW2" aria-expanded="false" aria-controls="collapseTwo">
                                                                Guidelines
                                                            </h2>
                                                        </div>
                                                        <div id="collapseFISW2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFISW">
                                                            <div class="card-body">
                                                                <ol>
                                                                  <li>Schools/Colleges/Ministries/Govt & Pvt Organisations to ensure that everyone actively participates in the National Sports Day 2022 celebration on 29th August 2022</li>
                                                                  <li>School children may wear their sports uniforms on this day.</li>
                                                                  <li>Schools/Colleges/Ministries/Govt & Pvt Organisations should register themselves on <a href="https://fitindia.gov.in/national-sports-day-2022">https://fitindia.gov.in/national-sports-day-2022</a> and upload photos and video link related to the event on the above-mentioned website.</li>
                                                                  <li>E-Certificate can be downloaded from the Fit India Portal after successful conduct of the National Sports Day and uploading the images and videos of the event/activities conducted.</li>
                                                                  <li>Schools are also encouraged to share/post activities conducted on their social media channels with <strong>#NationalSportsDay</strong> and tag <strong>@FitIndiaOff</strong></li>
                                                                </ol>
                                                              </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </article> <!-- -----------------------------CLOSE Fit-India-2022 Event--------------------------------------- -->

                        <!-- -----------------------------open fit-india-freedom-rider-Cycle-rally-2022--------------------------------------- -->

                        <article class="tab-pane" id="fit-india-freedom-rider-Cycle-rally-2022">
                            <div class="banner_area1">
                                <img src="{{ asset('resources/imgs/home/sportsday-banner.jpg') }}" alt="school-week" title="school-week" class="img-fluid expand_img" />
                                <section id="{{ $active_section_id }}">
                                    <div class="container">
                                        <div class="row">
                                            {{-- <a class="freedombtn1" href="register/">Register as an Organiser</a> --}}
                                            <!-- <a class="freedombtn2" href="{{ url('wp-content/uploads/2021/01/FAQ-Fit-India-School-Week.pdf') }} " target="_blank">FAQ-School Week 2020</a> -->
                                            {{-- <a class="freedombtn3" href="{{ url('resources/pdf/school-week-how-to-register.pdf') }}" target="_blank">How To Register</a> --}}

                                            {{-- <a class="freedombtn4" href="javascript:void(0)" data-toggle="modal" data-target="#merchandisId">Download Merchandise</a> --}}
                                        </div><br>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h2 class="mb-4 pt-2">Fit India Freedom Rider-Cycle Rally</h2>
                                                <p style="font-size: 18px;"><strong>3rd June - 10th June 2022</strong></p>
                                                <p>
                                                    <i><strong>“Azadi Ka Amrit Mahotsav Manaye, Chalo Cycle Chalaye”</strong>.</i> On this World Cycle Day 2022
                                                    i.e., 3rd June India’s largest youth organisations NYKS and NSS under the aegis of Ministry
                                                    of Youth Affairs and Sports, under the banner of Fit India Movement bring the opportunity
                                                    for Indians to celebrate Freedom through a week-long festival of cycling where monuments/
                                                    places related to India’s independence will be visited on cycle as a tribute to our freedom
                                                    fighters.</p>
                                                <p>On the launch on 3rd June in Delhi, 750 cyclists will cycle for 7.5 kms to embark this
                                                    week-long festival of cycling and will become a part of flag-off event. Thereafter, till
                                                    10th June, various cycling events are planned throughout the country with an aim to cover
                                                    locations related to India’s Independence. Anyone of any age-group (children in proper
                                                    guidance of their parents/guardians) can become a part of this celebration by organising
                                                    /participating in the cycle rallies under the banner <strong>“FIT INDIA FREEDOM RIDER CYCLE RALLY”</strong>
                                                    at their nearby locations and get an e-certificate of participation in this historic event
                                                    in commemoration of AKAM by following the below mentioned steps.</p>
                                                <br/>
                                                <h5>Call for action:</h5>

                                                <ol>
                                                    <li>Create your own group or do a solo trip.</li>
                                                    <li>Cover at least 7.5 kms or as convenient to you taking all the precautions. </li>
                                                    <li>Register your event, as an individual or as a group on <a href="https://fitindia.gov.in/" target="_blank">https://fitindia.gov.in/</a> or through <a href="https:fitindia.gov.in/app-store-redirect" target="_blank">Fit India Mobile App</a></li>
                                                    <li>Feed the data in terms of Kms covered and participants if registered as a group and get an e-certificate.</li>
                                                    <li>Each cyclist may carry a National Flag (3’ x 2’) adhering the protocols.</li>
                                                    <li>Try to cover the iconic locations in your city and invite people of nearby communities to join you.</li>
                                                    <li>Share your pictures and videos on social media with <strong><i>#FitIndiaFreedomRider</i></strong>, <strong><i>#AzadiKaAmritMahotsav</i></strong>, <strong><i>#FitIndiaMovement</i></strong></li>
                                                </ol>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 mt-3"><p style="font-size: 18px;"><strong>Happy Cycling Days!</strong></p></div>
                                        </div>

                                    </div>
                            </div>
                        </article> <!-- -----------------------------CLOSE fit-india-freedom-rider-Cycle-rally-2022--------------------------------------- -->
                        <!-- -----------------------------Fit-India-2021 Event--------------------------------------- -->

                        <article class="tab-pane" id="national-sports-day-2023">
                            <div class="banner_area1">
                                <img src="{{ asset('resources/imgs/event2023/WebBannerEnglish1.jpg') }}" alt="sports-day" title="national-sports-day" class="img-fluid expand_img" />
                                <section id="{{ $active_section_id }}">
                                    <div class="container">
                                        <div class="row">
                                            {{-- <a class="freedombtn1" href="register/">Register as an Organiser</a> --}}
                                            <!-- <a class="freedombtn2" href="{{ url('wp-content/uploads/2021/01/FAQ-Fit-India-School-Week.pdf') }} " target="_blank">FAQ-School Week 2020</a> -->
                                            {{-- <a class="freedombtn3" href="{{ url('resources/pdf/school-week-how-to-register.pdf') }}" target="_blank">How To Register</a> --}}

                                            {{-- <a class="freedombtn4" href="javascript:void(0)" data-toggle="modal" data-target="#merchandisId">Download Merchandise</a> --}}
                                        </div><br>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h1 class="headingh1">NATIONAL SPORTS DAY</h1>
                                                    <p>
                                                  India celebrates National Sports Day on 29th August to commemorate the birth anniversary of hockey legend, Major Dhyan Chand. The day is also dedicated to the nations’ sports heroes and champions, honoring their contribution and dedication towards bringing laurels to the country. With the aim to raise awareness about the values of sports: discipline, perseverance, sportsman spirit, teamwork, and to encourage public in large to take up sports and make it an integral part of their lives while emphasizing on the importance of being fit and healthy.
                                                </p>
                                                <br/>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="accordion" id="accordionFISW">
                                                    <div class="card">
                                                        <div class="card-head" id="headingOne">
                                                            <h2 class="mb-0" data-toggle="collapse" data-target="#collapseFISW1" aria-expanded="true" aria-controls="collapseOne">
                                                                How to participate
                                                            </h2>
                                                        </div>

                                                        <div id="collapseFISW1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionFISW">
                                                            <div class="card-body" style="padding-top:10px;">
                                                                <p>
                                                                    <strong style=" font-size:16px;">
                                                                      What can we do to pay tribute to the biggest sporting icon of India History
                                                                    </strong>
                                                                    </br></br>
                                                                    This year the ‘Ministry of Youth Affairs & Sports’ (MYAS) and ‘Fit India Mission’ aim to take FIT India movement to Schools/Colleges/Ministries/Govt & Pvt Organisations by encouraging them to participate in a grand manner on the occasion of National Sports Day on any day between 21st August and 29th August 2023. On that day, Schools/Colleges/Ministries/Govt & Pvt Organisations should encourage their students/employees/staff to take part in sports/fitness activities for at least 1 hour.
                                                                  </p>
                                                                    <p>
                                                                        Suggested activities to engage the participants are as follows:
                                                                        <br>
                                                                        <table class="table-grid table-bordered_cut table-bordered ">
                                                                        <tr>
                                                                            <th width="60px">S. No</th>
                                                                            <th>Outdoor Activity</th>
                                                                            <th>Indoor Activity</th>
                                                                            <th>Fun Activity</th>
                                                                        </tr>
                                                                            <tr>
                                                                                <td>1</td>
                                                                                <td>Football</td>
                                                                                <td>Badminton</td>
                                                                                <td>Sack Race</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>2</td>
                                                                                <td>Running</td>
                                                                                <td>Volleyball</td>
                                                                                <td>Lemon Race</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>3</td>
                                                                                <td>Kho-Kho</td>
                                                                                <td>Handball</td>
                                                                                <td>Rope Skipping</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>4</td>
                                                                                <td>Tennis</td>
                                                                                <td>Basketball</td>
                                                                                <td>Aerobics</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>5</td>
                                                                                <td>Hockey</td>
                                                                                <td>Table-Tennis</td>
                                                                                <td>Squat Challenge</td>
                                                                            </tr>
                                                                        </table>
                                                                    </p>
                                                                  <p><strong style=" font-size:16px;">Mode of participation</strong></p>
                                                                    <ul style="list-style-type: circle; margin-left: 15px;">
                                                                        <li>
                                                                            Schools/Colleges/Ministries/Govt & Private Organisations to register on Fit India website (Click on this link - on https://fitindia.gov.in/national-sports-day-2023 and provide all necessary details
                                                                        </li>
                                                                        <li>
                                                                            Schools/Colleges/Ministries/Govt & Pvt Organisations to submit their data and upload photos / video links from the events conducted by them to download e-certificate
                                                                        </li>
                                                                    </ul>
                                                                    <br/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card">
                                                        <div class="card-head" id="headingTwo">
                                                            <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW2" aria-expanded="false" aria-controls="collapseTwo">
                                                                Guidelines
                                                            </h2>
                                                        </div>
                                                        <div id="collapseFISW2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFISW">
                                                            <div class="card-body">
                                                                <br/>
                                                                <ol>
                                                                    <li>
                                                                    Schools/Colleges/Ministries/Govt & Pvt Organisations to ensure that everyone actively participates in the National Sports Day 2023 celebration on any day between 21st August and 29th August 2023.
                                                                    </li>
                                                                    <li>
                                                                    Participants may wear their sports attire on the day of sporting event.
                                                                    </li>
                                                                    <li>
                                                                    Schools/Colleges/Ministries/Govt & Pvt Organisations should register themselves on <a href="https://fitindia.gov.in/national-sports-day-2023">https://fitindia.gov.in/national-sports-day-2023</a> and upload photos and video link related to the event on the above-mentioned website.
                                                                    </li>
                                                                    <li>
                                                                    Participating stakeholders are also encouraged to share/post activities conducted on their social media channels with #NationalSportsDay and tag @FitIndiaOff
                                                                    </li>
                                                                    <li>
                                                                    E-Certificate can be downloaded from the Fit India Portal after successful conduct of the National Sports Day and uploading the images and videos of the event/activities conducted.
                                                                    </li>
                                                                </ol>
                                                                <br/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-head" id="headingThree">
                                                            <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW3" aria-expanded="false" aria-controls="collapseThree">
                                                                Guidelines for taking tests in the Fit India mobile app
                                                            </h2>
                                                        </div>
                                                        <div id="collapseFISW3" class="collapse" aria-labelledby="headingThree" data-parent="#accordionFISW">
                                                            <div class="card-body ">
                                                                <br/>
                                                                <a href="{{url('resources/imgs/event2023/takeatestguidelines.pdf')}}" style="color:#f60;" target="_blank">Take a test guidelines</a>
                                                                <br/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </article> <!-- -----------------------------CLOSE Fit-India-2021 Event--------------------------------------- -->
                        <!-- -----------------------------Fit-India-2021 Event--------------------------------------- -->

                        <article class="tab-pane" id="Fit-India-Swachhata">
                            <div class="banner_area1">
                                <img src="resources/imgs/freedomrunupdate4.jpg" alt="freedom-run-info" title="freedom-run-info" class="img-fluid expand_img" />
                                <section id="{{ $active_section_id }}">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h1 class="headingh1">Fit India Swachhata Freedom Run 4.0</h1>
                                            <br/>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                                {{-- <a href="register" class="og_btn" target="_blank">Register as an Organizer</a> --}}
                                                {{-- <a href="resources/pdf/SOP-Freedom-Run-4.0.pdf" class="og_btn" target="_blank" style="background-color:#45a164; padding-left: 42px;padding-right:42px;">Steps to Register
                                                </a> --}}
                                                {{-- <a href="resources/pdf/freedom-run-hoarding-2023.pdf" class="og_btn" target="_blank">Download Event Creatives</a> --}}
                                                {{-- <a href="resources/imgs/freedomrunupdate4.jpg" target="_blank" class="og_btn" target="_blank">Download Event Creatives</a> --}}
                                                <a href="{{ url('freedomrun-events-creatives') }}" target="_blank" class="og_btn" target="_blank">Download Event Creatives</a>
                                                <div class="m-40"></div>
                                        </div>
                                        <br/>
                                        <h5 class="mb-4 " style="color: #19acd8;"><b>“RUNNING:</b> The human body’s rawest form of FREEDOM”</h5>
                                        <br/>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="text-justify pr-3">
                                                    Fit India Mission in its endeavour to promote fitness and creating awareness amongst countrymen keeps coming with innovating fitness campaigns to indulge people in fitness activities. Fit India Mission converges with Swachh Bharat Abhiyan with Fit India Freedom Run (Plog Run) where fitness meets Swachhata in a form of engaging fun-loving exercise is now entailed in Fit India Freedom Run culminating where we discover a litter free clean surroundings while running.
                                                </p>
                                                 <div class="d-flex justify-content-around">
                                                     <div><img src="resources/imgs/plogsvg.svg" class="fluid-img"/></div>
                                                 </div>
                                                 <h5 class="text-center mt-3 mb-3">
                                                    1st October | 2 Kms | Fit India Plog Run
                                                </h5>
                                                    <p class="text-justify">
                                                        Fit India Freedom Run was conceived in 2020 when the entire nation started following social distancing in a ‘new normal’ lifestyle, so as to keep the imperative need of fitness active even while following the social distancing norms. The campaign’s objective is to encourage fitness and help us all to get freedom from obesity, laziness, stress, anxiety, diseases etc. The Fit India Freedom Run is yet another endeavour to strengthen the Fit Indian Movement and involve citizens to embrace fitness as a way of life. Participants will be allowed to run at their own place and at their own pace at a time convenient to them during campaign period. The concept behind this run is that “It can be run at anytime and anywhere!
                                                    </p>
                                                    <p class="text-justify">
                                                        Till date three editions of the campaign have been held in 2020, 2021 and 2023 respectively and the campaign has seen tremendous support from various stakeholders such as government, private organizations and individuals from all walks of life and demographics making it a truly people’s campaign. This year, Fit India Mission has decided to organize the 4th edition i.e. Fit India Swachhata Freedom Run 4.0 from 1st October to 31st October 2023. Citizens will be urged to inculcate 30 minutes of physical fitness in any form, celebrate achievements of active lifestyle and make a resolve to remain fit “Swachh Bharat Swasth Bharat”. The campaign will kick-off with a Swachhata Run (Plog Run) on 1st October 2023 followed by running events for the remainder of the campaign i.e., till 31st October 2023.
                                                    </p>


                                                <p class="text-justify">
                                                    Fit India Swachhata Freedom Run is always in Fit India Mission charter as 1st event organized under the aegis of Fit India Mission was Fit India Plog Run on 2nd October 2019 i.e., 150th anniversary of Mahatma Gandhi.
                                                </p>
                                                <p class="text-justify">Let’s be a part of RUN that matters to us as well as to surroundings!</p>
                                                <!-- <p><strong>Fit India Freedom Run 2.0 aims at "Jan Bhagidari se Jan Aandolan"</strong></p> -->
                                                <!-- <p>Fit India Freedom Run to culminate on Gandhi Jayanti, 1st October, with nationwide Fit India Plog Run.</p>  -->
                                                <p>
                                                    <b>Promote Fit India Swachhata Freedom Run 4.0 on your social media channels by
                                                        <span style="color: #fcac39;font-size:16px;">#</span>
                                                        <span style="color: #f8162c;font-size:16px;">SwachhBharatSwasthBharat</span>
                                                        {{-- <span style="color: #000;font-size:16px;">Ka</span> --}}
                                                        {{-- <span style="color: #1681f8;font-size:16px;">AmritMahotsav</span> &  --}}
                                                        <span style="color: #fcac39;font-size:16px;">#</span>
                                                        <span style="color: #f8162c;font-size:16px;">Run</span>
                                                        <span style="color: #000;font-size:16px;">4</span>
                                                        <span style="color: #1681f8;font-size:16px;">India</span>
                                                    </b>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div>

                                                    <h6><strong>Points to remember: </strong></h6>
                                                    <ul>
                                                        <li>Run a route of your choice, at a time that suits you.</li>
                                                        <li>Break-up your runs.</li>
                                                        <li>Run your own race at your pace.</li>
                                                        <li>Track your kms manually or by using any tracking app or GPS watch.</li>
                                                        <li>Create an event on Fit India Portal either as an individual or as an organiser as per your eligibility for any number of day(s) starting from 1st October till 31st October</li>
                                                        <li>Can run any number of KM's (take a selfie or an photo and upload it while creating an event)</li>
                                                    </ul>
                                                    <p><strong>Mode of participation:</strong></p>
                                                    <ul>
                                                        <li>Registration to be done through Fit India website.</li>
                                                        <li>Those who have undertaken their own run can Register as individual, submit their data and download the certificate.</li>
                                                    </ul>
                                                    <div class="freenote">
                                                        <p><b>Note:</b></p>
                                                        <p>Organisers will have to register their Event/marathons on Fit India portal. They will use the Fit India Logo for all promotional media and provide the data of participants with their cumulative kms covered to download certificate.</p>
                                                        <!--
                                                        <ol>
                                                            <li class="text-justify">
                                                            Organisers will have to register their Event/marathons on Fit India portal. They will use the Fit India Logo for all promotional media and provide the data of participants with their cumulative kms covered to download certificate.
                                                            </li>

                                                            <li class="text-justify">FIT INDIA mission advises organizers and individuals to organize their events following the social distancing norms and encourages the new normal of ‘virtual runs’ as is being practiced by runners / walkers across the world.
                                                            </li>
                                                        </ol>
                                                        -->
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="row">
                                            <div class="col-md-12">

                                                <div class="accordion" id="accordionFISW">
                                                    <div class="card">
                                                        <div class="card-head" id="headingOne">
                                                            <h2 class="mb-0" data-toggle="collapse" data-target="#collapseFISW1" aria-expanded="true" aria-controls="collapseOne">
                                                                How to participate
                                                            </h2>
                                                        </div>

                                                        <div id="collapseFISW1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionFISW">
                                                            <div class="card-body" style="padding-top:10px;">
                                                                <p>
                                                                    <strong style=" font-size:16px;">
                                                                      What can we do to pay tribute to the biggest sporting icon of India History
                                                                    </strong>
                                                                    </br></br>
                                                                    This year the ‘Ministry of Youth Affairs & Sports’ (MYAS) and ‘Fit India Mission’ aim to take FIT India movement to Schools/Colleges/Ministries/Govt & Pvt Organisations by encouraging them to participate in a grand manner on the occasion of National Sports Day on any day between 21st August and 29th August 2023. On that day, Schools/Colleges/Ministries/Govt & Pvt Organisations should encourage their students/employees/staff to take part in sports/fitness activities for at least 1 hour.
                                                                  </p>
                                                                    <p>
                                                                        Suggested activities to engage the participants are as follows:
                                                                        <br>
                                                                        <table class="table-grid table-bordered_cut table-bordered ">
                                                                        <tr>
                                                                            <th width="60px">S. No</th>
                                                                            <th>Outdoor Activity</th>
                                                                            <th>Indoor Activity</th>
                                                                            <th>Fun Activity</th>
                                                                        </tr>
                                                                            <tr>
                                                                                <td>1</td>
                                                                                <td>Football</td>
                                                                                <td>Badminton</td>
                                                                                <td>Sack Race</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>2</td>
                                                                                <td>Running</td>
                                                                                <td>Volleyball</td>
                                                                                <td>Lemon Race</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>3</td>
                                                                                <td>Kho-Kho</td>
                                                                                <td>Handball</td>
                                                                                <td>Rope Skipping</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>4</td>
                                                                                <td>Tennis</td>
                                                                                <td>Basketball</td>
                                                                                <td>Aerobics</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>5</td>
                                                                                <td>Hockey</td>
                                                                                <td>Table-Tennis</td>
                                                                                <td>Squat Challenge</td>
                                                                            </tr>
                                                                        </table>
                                                                    </p>
                                                                  <p><strong style=" font-size:16px;">Mode of participation</strong></p>
                                                                    <ul style="list-style-type: circle; margin-left: 15px;">
                                                                        <li>
                                                                            Schools/Colleges/Ministries/Govt & Private Organisations to register on Fit India website (Click on this link - on https://fitindia.gov.in/national-sports-day-2023 and provide all necessary details
                                                                        </li>
                                                                        <li>
                                                                            Schools/Colleges/Ministries/Govt & Pvt Organisations to submit their data and upload photos / video links from the events conducted by them to download e-certificate
                                                                        </li>
                                                                    </ul>
                                                                    <br/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card">
                                                        <div class="card-head" id="headingTwo">
                                                            <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW2" aria-expanded="false" aria-controls="collapseTwo">
                                                                Guidelines
                                                            </h2>
                                                        </div>
                                                        <div id="collapseFISW2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFISW">
                                                            <div class="card-body">
                                                                <br/>
                                                                <ol>
                                                                    <li>
                                                                    Schools/Colleges/Ministries/Govt & Pvt Organisations to ensure that everyone actively participates in the National Sports Day 2023 celebration on any day between 21st August and 29th August 2023.
                                                                    </li>
                                                                    <li>
                                                                    Participants may wear their sports attire on the day of sporting event.
                                                                    </li>
                                                                    <li>
                                                                    Schools/Colleges/Ministries/Govt & Pvt Organisations should register themselves on <a href="https://fitindia.gov.in/national-sports-day-2023">https://fitindia.gov.in/national-sports-day-2023</a> and upload photos and video link related to the event on the above-mentioned website.
                                                                    </li>
                                                                    <li>
                                                                    Participating stakeholders are also encouraged to share/post activities conducted on their social media channels with #NationalSportsDay and tag @FitIndiaOff
                                                                    </li>
                                                                    <li>
                                                                    E-Certificate can be downloaded from the Fit India Portal after successful conduct of the National Sports Day and uploading the images and videos of the event/activities conducted.
                                                                    </li>
                                                                </ol>
                                                                <br/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-head" id="headingThree">
                                                            <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW3" aria-expanded="false" aria-controls="collapseThree">
                                                                Guidelines for taking tests in the Fit India mobile app
                                                            </h2>
                                                        </div>
                                                        <div id="collapseFISW3" class="collapse" aria-labelledby="headingThree" data-parent="#accordionFISW">
                                                            <div class="card-body ">
                                                                <br/>
                                                                <a href="{{url('resources/imgs/event2023/takeatestguidelines.pdf')}}" style="color:#f60;" target="_blank">Take a test guidelines</a>
                                                                <br/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div> --}}
                                    </div>
                            </div>
                        </article> <!-- -----------------------------CLOSE Fit-India-2021 Event--------------------------------------- -->
                        <!-- -----------------------------open national sports day 2023--------------------------------------- -->

                        <article class="tab-pane" id="Fit-India-schoolweek-2021">
                            <div class="banner_area1">
                                <img src="{{ asset('resources/imgs/home/schholweek-banner17-12-2021.png') }}" alt="school-week" title="school-week" class="img-fluid expand_img" />
                                <section id="{{ $active_section_id }}">
                                    <div class="container">
                                        <div class="row">
                                            {{-- <a class="freedombtn1" href="register/">Register as an Organiser</a> --}}
                                            <!-- <a class="freedombtn2" href="{{ url('wp-content/uploads/2021/01/FAQ-Fit-India-School-Week.pdf') }} " target="_blank">FAQ-School Week 2020</a> -->
                                            {{-- <a class="freedombtn3" href="{{ url('resources/pdf/school-week-how-to-register.pdf') }}" target="_blank">How To Register</a> --}}

                                            <a class="freedombtn4" href="javascript:void(0)" data-toggle="modal" data-target="#merchandisId">Download Merchandise</a>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h1 class="headingh1">FIT INDIA SCHOOL WEEK 2021</h1>
                                                <br><br>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="accordion" id="accordionFISW">
                                                    <div class="card">
                                                        <div class="card-head" id="headingOne">
                                                            <h2 class="mb-0" data-toggle="collapse" data-target="#collapseFISW1" aria-expanded="true" aria-controls="collapseOne">
                                                                Background
                                                            </h2>
                                                        </div>

                                                        <div id="collapseFISW1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionFISW">
                                                            <div class="card-body" style="padding-top:10px;">
                                                                <p>Department of Sports, MYAS in collaboration with Department of School Education and Literacy, M/o
                                                                    Education started Fit India School Week soon after the inception of Fit India Movement in 2019 with an
                                                                    aim to integrate fitness as an essential part of school education where physical fitness is taught and
                                                                    practiced, apart from homes. Fit India School Week is being considered as a flagship program of Fit India
                                                                    Mission.</p>
                                                                <p>Schools have welcomed this concept of celebrating 4 to 6 days of a week dedicated to fitness
                                                                    with the objective to instill the importance of fitness not only in students but also amongst their
                                                                    families, teachers and entire school staff. In 2nd edition from December’2020 to January 2021, a surge
                                                                    was seen in the celebrations of Fit India School Week where more than 4.3 lakh schools have reported
                                                                    the celebrations which was 15,000 in the 1st edition.</p>
                                                                <p>As India is celebrating Azadi Ka Amrit Mahotsav (AKAM), 3
                                                                    rd edition of Fit India School Week
                                                                    is dedicated to commemoration of AKAM in schools highlighting importance of fitness in
                                                                    today’s time. It is planned to renaissance students in schools after pandemic by providing them
                                                                    pathway to inculcate the habit of fitness in a new and innovative ways. A chart with indicative
                                                                    activities is as follows:</p>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card">
                                                        <div class="card-head" id="headingTwo">
                                                            <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW2" aria-expanded="false" aria-controls="collapseTwo">
                                                                Guidelines
                                                            </h2>
                                                        </div>
                                                        <div id="collapseFISW2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFISW">
                                                            <div class="card-body">
                                                                <ol>
                                                                    <li>Schools to ensure that all Students, Parents, Staff and Management shall actively participate in the Fit India School Week 2021 programme</li>
                                                                    <li>Schools may create a new page on their website titled “Fit India School Week 2021” and a brief about the activities undertaken and related pictures/videos can be uploaded on it.</li>
                                                                    <li>Schools should register themselves on <a href="{{asset('fit-india-school-week') }}">https://fitindia.gov.in/fit-india-school-week</a> and upload photos and video link related to the event</li>
                                                                    <li>All registered schools may download a Digital Certificate. which can be downloaded from Fit India Portal after successful conduct of the Fit India School Week.</li>
                                                                    <li>Schools are also encouraged to share/post activities conducted on their social media channels with <strong>#NewIndiaFitIndia</strong> and tag <strong>@FitIndiaOff</strong></li>
                                                                </ol>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-head" id="headingThree">
                                                            <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW3" aria-expanded="false" aria-controls="collapseThree">
                                                                Activities
                                                            </h2>
                                                        </div>
                                                        <div id="collapseFISW3" class="collapse" aria-labelledby="headingThree" data-parent="#accordionFISW">
                                                            <div class="card-body ">
                                                                <table width="100%" class="table-grid table-bordered_cut table-bordered ">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>DAY</th>
                                                                            <th class="text-center">PROPOSED ACTIVITIES</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><strong>01</td>
                                                                            <td> Opening day- Indian Dances celebrating AKAM with integrated fitness</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>02</td>
                                                                            <td>
                                                                                <p class="mb-1">Importance of fitness- Debates, Symposium, Lectures etc.</p>
                                                                                <p class="mb-1">Quiz on fitness and sports highlighting Freedom, AKAM, Nutrition etc.</p>
                                                                                <p class="mb-1">Essay/Poem Writing Competition on theme <i> <b>“My fitness mantra on AKAM”.</b></i></p>
                                                                                <p class="mb-1">Poster making competition on themed on <i><b>Freedom from sedentary lifestyle.</b></i></p>

                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>03</td>
                                                                            <td>
                                                                                <p class="mb-1"> Events of Indigenous games of India- AKAM with traditional games of India. Session on importance of “Eat Right/ Santulit Aahar”.</p>

                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>04</td>
                                                                            <td>
                                                                                <p class="mb-1">Schools’ Social Responsibility (SSR)- Celebrating AKAM with nearby communities by inviting them for one fitness session.</p>

                                                                                <p class="mb-1">Fitness assessment by teachers and parents on Fit India Mobile App</p>
                                                                                <p class="mb-2">Link for download:</p>
                                                                                <p class="mb-1">a) Android-<a href="https://play.google.com/store/apps/details?id=com.sai.fitIndia">https://play.google.com/store/apps/details?id=com.sai.fitIndia</a></p>
                                                                                <p class="mb-1">b) iOS- <a href="https://apps.apple.com/us/app/fit-india-mobile-app/id1581063890">https://apps.apple.com/us/app/fit-india-mobile-app/id1581063890</a></p>


                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>05</td>
                                                                            <td>
                                                                                <p class="pr-5 mb-1">
                                                                                    Yoga and Meditation Day. </p>
                                                                                <p class="pr-5 mb-1">
                                                                                    Brain Games to improve concentration/problem solving capacity.</p>
                                                                                <p class="pr-5 mb-1">Graffiti events on topics like What is Azadi for you? How important is
                                                                                    fitness? etc.</p>
                                                                                <p class="pr-5 mb-1">Session on mental health awareness.</p>

                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>06</td>
                                                                            <td>
                                                                                <p class="pr-4"> Pledge of fitness on the occasion of AKAM to culminate School Week
                                                                                    with self- assertion for leading a new fit and healthy life ahead.</p>

                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </article> <!-- -----------------------------CLOSE national sports day 2023--------------------------------------- -->

                        <!-- -----------------------------Freedom-Run--------------------------------------- -->
                        <article class="tab-pane " id="Freedom-Run">
                            <div>
                                <img src="resources/imgs/freedom_info_new2.jpg" alt="freedom-run-info" title="freedom-run-info" class="img-fluid expand_img" />
                            </div>

                            <section style="padding-bottom:0;">
                                <div class="container mb-5">
                                    <div class="row row_reverse">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="webview">
                                                <h1 class="head_free_run mb-4">Fit India Freedom Run 2.0</h1>
                                                <div class="ahover">
                                                    {{-- <a href="register" class="og_btn" target="_blank">Register as an Organizer</a> --}}
                                                    {{-- <a href="resources/pdf/SOP-Freedom-Run-2.0.pdf" class="og_btn" target="_blank" style="background-color:#45a164; padding-left: 42px;padding-right:42px;">Steps to Register
                                                    </a> --}}
                                                    <div class="m-40"></div>
                                                </div>
                                            </div>
                                            <h5 class="mb-4 " style="color: #19acd8;"><b>“RUNNING:</b> The human body’s rawest form of FREEDOM”</h5>
                                            <p class="text-justify pr-3">Fit India Mission in its endeavour to promote fitness and creating awareness amongst countrymen keeps coming with innovating fitness campaigns to indulge people in fitness activities. Fit India Mission converges with Swachh Bharat Abhiyan with Fit India Plog Run where fitness meets Swatchhta in a form of engaging fun-loving exercise is now entailed in Fit India Freedom Run culmination where we discover a litter free clean surroundings while running. </p>
                                            <div class="d-flex justify-content-around">
                                                <div><img src="resources/imgs/plogsvg.svg" class="fluid-img" /></div>

                                            </div>
                                            <h5 class="text-center mt-3 mb-3"> 2nd October | 2 Kms | Fit India Plog Run</h5>
                                            <p class="text-justify">Fit India Plog Run is always in Fit India Mission charter as 1st event organized under the aegis of Fit India Mission was Fit India Plog Run on 2nd October 2019 i.e., 150th anniversary of Mahatma Gandhi.</p>
                                            <p class="text-justify">Let’s be a part of RUN that matters to us as well as to surroundings!</p>
                                            <p><b>Promote Fit India Freedom Run 2.0 on your social media channels by using <span style="color: #fcac39;font-size:16px;">#</span><span style="color: #f8162c;font-size:16px;">Azadi</span><span style="color: #000;font-size:16px;">Ka</span><span style="color: #1681f8;font-size:16px;">AmritMahotsav</span> & <span style="color: #fcac39;font-size:16px;">#</span><span style="color: #f8162c;font-size:16px;">Run</span><span style="color: #000;font-size:16px;">4</span><span style="color: #1681f8;font-size:16px;">India</span></b></p>
                                            <div>

                                                <h6><strong>Points to remember: </strong></h6>
                                                <ul>
                                                    <li>Run a route of your choice, at a time that suits you.</li>
                                                    <li>Break-up your runs.</li>
                                                    <li>Run your own race at your pace.</li>
                                                    <li>Track your kms manually or by using any tracking app or GPS watch.</li>
                                                    <li>Create an event on Fit India Portal either as an individual or as an organiser as per your eligibility for any number of day(s) starting from 13th August till 2nd October</li>
                                                    <li>Can run any number of KM's (take a selfie or an photo and upload it while creating an event)</li>
                                                </ul>
                                                <p><strong>Mode of participation:</strong></p>
                                                <ul>
                                                    <li>Registration to be done through Fit India website.</li>
                                                    <li>Those who have undertaken their own run can Register as individual, submit their data and download the certificate.</li>
                                                </ul>
                                                <div class="freenote">
                                                    <p><b>Note:</b></p>
                                                    <ol>
                                                        <li class="text-justify">Organisers will have to register their Event/marathons on Fit India portal. They will use the Fit India Logo for all promotional media and provide the data of participants with their cumulative kms covered to download certificate.
                                                        </li>
                                                        <li class="text-justify">FIT INDIA mission advises organizers and individuals to organize their events following the social distancing norms and encourages the new normal of ‘virtual runs’ as is being practiced by runners / walkers across the world.
                                                        </li>
                                                    </ol>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 mt-5">
                                            <div class="cont_area" style="background:#e6f2fb;position: relative; padding:20px;">
                                                <h5>For any queries please contact</h5>
                                                <div>
                                                    <ul>
                                                        <li><span><i class="fa fa-phone" aria-hidden="true"></i></span> Phone No: <span> 1800-202-5155</span></li>
                                                        <li><span><i class="fa fa-envelope-o" aria-hidden="true"></i></span> Email ID: <span> contact[dot]fitindia[at]gmail[dot]com</span></li>
                                                        <li><span><i class="fa fa-clock-o" aria-hidden="true"></i></span> Timing: <span> Monday-Friday(9:00 - 5:30pm)</span></li>
                                                    </ul>
                                                </div>
                                            </div>




                                        </div>
                                    </div>
                                </div>
                            </section>

                        </article> <!-- -----------------------------close Freedom-Run--------------------------------------- -->

                        <!-- -----------------------------Fit-India-Quiz--------------------------------------- -->
                        <article class="tab-pane " id="Fit-India-Quiz">
                            <div>
                                <a href="https://fitindia.nta.ac.in/" target="_blank">
                                    <img src="resources/imgs/home/quiz_img.png" alt="Fit-india-quiz" title="Fit-india-quiz" class="img-fluid expand_img" /></a>
                            </div>

                            <section>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <h1 class="mb-4">Fit India Quiz </h1>
                                            <p>The Fit India Quiz is primed to be the first-of-its-kind nation-wide quiz on fitness and sports for school children. The quiz will have representations from every State/UT in the country and will be a mix of online and broadcast rounds. The quiz format has been designed in an inclusive manner wherein school students from across the country will get an opportunity to test their fitness and sports knowledge against their peers. The quiz will be open for students from all age groups.
                                                <!-- , but the questions shall be framed in a way that can be easily answered by students of class 8 and above. -->
                                            </p>
                                            <p>Fit India Quiz, while providing a national platform to students to showcase their knowledge about fitness and sports, also endeavours to create awareness among students about India's rich sporting history, including centuries-old indigenous sports, our sporting heroes of the past and how traditional Indian lifestyle activities hold the key to a Fit Life for all.</p>

                                        </div>
                                        <div class="mt-3 mb-3 ml-2 quiz_btn_fit">
                                            <a class="btn btn-primary btn-sm d_button " href="resources/pdf/OC_Circular.pdf" target="_blank"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp; Download Circular</a>
                                            <a class="btn btn-primary btn-sm d_button b_color " href="resources/pdf/Annexure.pdf" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp; Download Annexure</a>
                                            <a class="btn btn-primary btn-sm d_button f_color" href="resources/pdf/FREQUENTLY_ASKED_QUESTIONS.pdf" target="_blank"><i class="fa fa-question-circle-o" aria-hidden="true"></i>&nbsp; FAQ</a>
                                        </div>
                                        <!-- <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                                            <h3 class="reg_op">Registration are open</h3>
                                        </div> -->
                                    </div>
                                </div>
                            </section>


                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                                        <div class="cont_area cont_area_cont">
                                            <h1>For Any Queries <span>Please Contact</span></h1>
                                            <div class="d-flex justify-content-around mail_img align-items-center ">
                                                <div>
                                                    <img src="resources/imgs/mail.png" class="fluid-img" />
                                                </div>

                                                <div>
                                                    <ul>
                                                        <!-- <li><span><i class="fa fa-phone" aria-hidden="true"></i></span> NTA Helpdesk :<span>011 4075 9000, 011 6922 7700</span></li> -->
                                                        <li><span><i class="fa fa-phone" aria-hidden="true"></i></span> NTA Helpdesk :<span> 011 6922 7700</span></li>

                                                        <li><span><i class="fa fa-envelope-o" aria-hidden="true" style="font-size:17px;"></i></span> Email ID: <span> fitindia[at]nta[dot]ac[dot]in</span></li>
                                                        <li><span><i class="fa fa-clock-o" aria-hidden="true"></i></span> Timing: <span> All Days (9:00 - 5:30pm)</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>




                        <!-- -----------------Close Fit-India-Prabhat-Pheri ------------------------ -->

                        <article class="tab-pane " id="Fit-India-Prabhat-Pheri-2020">
                            <div class="banner_area1">
                                <img src="{{ asset('resources/imgs/prabhatpheri.jpg') }}" alt="Fit-India-Prabhat-Pheri-2020" title="Fit-India-Prabhat-Pheri-2020" class="img-fluid expand_img" />
                            </div>
                            <section>
                                <h1 class="heading_eventh1">Fit India Prabhat Pheri 2020</h1>
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h2 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Introduction
                                                </a>
                                            </h2>

                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <p>Based on the call of our Honourable PM Mr. Modi, Fit
                                                    India will be launching Fit India Prabhat Pheri
                                                    advocating the message “फिटनेस का डोज़ – आधा घंटा रोज़”
                                                    campaign in December 2020.</p>
                                                <p>Fit India Prabhat Pheri can be organised by city
                                                    councils, villages, panchayats, societies, RWA’s, NGO’s
                                                    and special interest groups across India. You can also
                                                    start a Fit India Prabhat Pheri group by involving your
                                                    organisation, community, family and friends.</p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingTwo">
                                            <h2 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Why organise a Prabhat Pheri?
                                                </a>
                                            </h2>

                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="panel-body">
                                                <p>Prabhat Pheri is one of the ethnic Indian ways to promote
                                                    a fit and healthy India. People in Indian villages have
                                                    been taking part in early morning processions since
                                                    ancient times chanting songs and using musical
                                                    instruments. This activity can spread the benefits of
                                                    fitness which will bring in a positive change in the
                                                    local communities.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default ">
                                        <div class="panel-heading" role="tab" id="headingThree">
                                            <h3 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Who can organise Fit India Prabhat Pheri?
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                            <ul>
                                                <li>Village, Town or City Council/ Panchayat/ Anganwadi /
                                                    Block</li>
                                                <li>Society or RWA</li>
                                                <li>Interest Groups</li>
                                                <li>NGOs</li>
                                                <li>Communities</li>
                                                <li>Schools/ Colleges and Universities</li>

                                            </ul>
                                            <p>Organisers must ensure that all “Fit India Prabhat Pheri”
                                                events are listed on <span>www.fitindia.gov.in</span> portal
                                                and are non-commercial in nature.</p>

                                        </div>
                                    </div>
                                </div>


                            </section>
                        </article>

                        <!-- -----------------Fit India Cyclothon ------------------------- -->

                        <article class="tab-pane" id="Fit-India-Cyclothon">
                            <div class="banner_area1">
                                <img src="{{ asset('resources/imgs/cyclothon-pedal.jpg') }}" alt="school-week" title="cyclothon-2020" class="img-fluid expand_img" />
                            </div>
                            <section>

                                <h1 class="heading_eventh1">Fit India Cyclothon 2020</h1>

                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Introduction
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <p>Fit India Mission will be organising the <strong>Fit
                                                        India Cyclothon</strong> from
                                                    December 2020.</p>
                                                <P>Fit India Cyclothon can be organised by cycling groups,
                                                    schools, colleges, organisations,
                                                    councils, panchayats, corporations, societies, RWA’s,
                                                    NGO’s, special interest groups
                                                    across India. You can also start a Fit India Cyclothon
                                                    group by involving your
                                                    organisation, community, family and friends.</P>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- second -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingTwo">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Why organise/participate in a Cyclothon?
                                                </a>
                                            </h4>

                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="panel-body">
                                                <p>Cycling is one of the best ways to remain fit and
                                                    healthy. It is the new craze that
                                                    combines fitness with fun and allows us to maintain
                                                    social distancing.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Thrid -->
                                    <div class="panel panel-default ">
                                        <div class="panel-heading" role="tab" id="headingThree">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Who can organise/participate in the Fit India Cyclothon?
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="panel-body">
                                                <ul class="a">
                                                    <li>Village, Town or City Council/ Panchayat/
                                                        Anganwadi / Block</li>
                                                    <li> Your Workplace</li>
                                                    <li> Society or RWA</li>
                                                    <li> Interest Groups</li>
                                                    <li> Corporate and Industry bodies</li>
                                                    <li> Schools/ Colleges and Universities</li>
                                                    <li>NGOs</li>
                                                    <li>Communities</li>
                                                    <li>Individuals</li>
                                                </ul>
                                                <p>Organisers must ensure that all “Fit India Cyclothon”
                                                    events are listed on www.fitindia.gov.in
                                                    portal and
                                                    are non-commercial in nature. Further, Individual
                                                    Participants should also ensure that
                                                    they register themselves as well.</p>
                                            </div>


                                        </div>

                                    </div>

                                    <!-- forth -->
                                    <div class="panel panel-default ">
                                        <div class="panel-heading" role="tab" id="headingfour">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> Guidelines for Organisers</a>
                                            </h4>
                                        </div>
                                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                            <div class="panel-body">
                                                <ul class="a">
                                                    <li>Fit India Cyclothon can be organised by
                                                        any government or private organisation,
                                                        schools, colleges, universities,
                                                        individuals, groups, RWAs and
                                                        communities to create awareness on
                                                        fitness through cycling.</li>
                                                    <li>Guidelines in relation to COVID-19
                                                        issued by the Ministry of Home Affairs
                                                        and relevant state bodies to be duly
                                                        complied with.</li>
                                                    <li> To become an organiser, you must
                                                        register online on <u>gov.in</u></li>
                                                    <li> As an organiser, you will be
                                                        responsible for conceptualizing,
                                                        executing and ensuring a smooth and
                                                        successful Fit India Cyclothon event to
                                                        maximize public participation.</li>
                                                    <li>You can invite other organisations as
                                                        well for online participation
                                                        registration.</li>
                                                    <li>You can get sponsorship and have
                                                        partners to organise this event.</li>
                                                    <li>Fit India Mission office will provide
                                                        standard FIT INDIA design templates for
                                                        branding elements on the registration
                                                        portal for organisers to download and
                                                        use the same:</li>
                                                    <li>Organisers will get FIT INDIA Movement
                                                        partner – certificate from Fit India.
                                                    </li>
                                                    <li>Those interested in partnership can also
                                                        write to Fit India Mission office on:

                                                        partnership[dot]fitindia[at]gmail[dot]com
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- five -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingfour">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                    Other Guidelines for organisers</a>
                                            </h4>
                                        </div>
                                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                            <div class="panel-body">
                                                <ul class="a">
                                                    <li>Identify route, create map and share
                                                        with participants in advance.</li>
                                                    <li>Inform local bodies about the event.
                                                    </li>
                                                    </li>
                                                    <li>Prior approval should be taken from
                                                        relevant authorities wherever required.
                                                    </li>
                                                    <li>Inform communities around you about Fit
                                                        India Cyclothon.</li>
                                                    <li>Partner with local businesses who can
                                                        sponsor FIT INDIA tee shirts / caps for
                                                        children.</li>
                                                    <li>Any queries regarding Fit India
                                                        Cyclothon to be sent to Fit India
                                                        Mission office on: contact[dot]fitindia[at]gmail[dot]com
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- six -->
                                    <div class="panel panel-default ">
                                        <div class="panel-heading" role="tab" id="headingfour">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                    Guidelines for Individual Participants </a>
                                            </h4>
                                        </div>
                                        <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                            <div class="panel-body">
                                                <ul class="a">
                                                    <li>Any individual can participate in Fit
                                                        India Cyclothon to create awareness on
                                                        fitness through cycling.</li>
                                                    <li>Guidelines in relation to COVID-19
                                                        issued by the Ministry of Home Affairs,
                                                        India and relevant state bodies to be
                                                        duly complied with.</li>
                                                    <li>To participate, an individual should
                                                        register online on gov.in.</li>
                                                    <li>As an individual, you will be
                                                        responsible for conceptualizing,
                                                        executing and ensuring a smooth and
                                                        successful Fit India Cyclothon event.
                                                    </li>
                                                    <li>You can invite other individuals as well
                                                        for online participation registration.
                                                    </li>
                                                    <li>Any fitness enthusiast who is
                                                        participating should strive to motivate
                                                        at least one partner to participate.
                                                    </li>
                                                    <li>Registered Individuals will get
                                                        participation certificate after updating
                                                        their details on the Fit India portal.
                                                    </li>
                                                    <li>For any queries, contact on contact[dot]fitindia[at]gmail[dot]com</a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- seven -->
                                    <div class="panel panel-default ">
                                        <div class="panel-heading" role="tab" id="headingseven">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                                    Other guidelines for individuals</a>
                                            </h4>
                                        </div>
                                        <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                                            <div class="panel-body">
                                                <ul class="a">
                                                    <li>Identify route.</li>
                                                    <li>Inform communities around you about the
                                                        Fit India Cyclothon.</li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- eight -->
                                    <div class="panel panel-default lastpanel">
                                        <div class="panel-heading" role="tab" id="headingeight">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                                    How to use the Fit India Cyclothon templates Fit India Logo </a>
                                            </h4>
                                        </div>
                                        <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                                            <div class="panel-body">
                                                <ul class="a">
                                                    <li>Download the Fit India Logo after you
                                                        register as an organisation or an
                                                        individual</li>
                                                    <li>Do not edit the Fit India Logo (colour
                                                        or dimension)</li>
                                                    <li>To be used only for events in promotion
                                                        of Fit India Movement</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </section>
                        </article>


                        <!-- -----------------fit-india-school-week ------------------------- -->

                        <article class="tab-pane" id="Fit-India-School-Week">
                            <div class="banner_area1">
                                <img src="{{ asset('resources/imgs/school-week.jpg') }}" alt="school-week" title="school-week" class="img-fluid expand_img" />
                            </div>
                            <section>

                                <h1 class="heading_eventh1"> Fit India School Week 2020</h1>

                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h2 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Background </a>
                                            </h2>

                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <p>On 29 Aug 2019, the Hon’ble Prime Minister launched
                                                    nation-wide “Fit India Movement” aimed to encourage
                                                    people to inculcate physical activity and sports in
                                                    their everyday lives and daily routine.</p>
                                                <p>School is the first place where habits are formed. School
                                                    children should be encouraged to indulge in active field
                                                    time during school hours involving fitness and sports
                                                    activities. This will instil in students the
                                                    understanding for regular physical activity and higher
                                                    levels of fitness, thus enhancing self-esteem and
                                                    confidence in them. Keeping these objectives in mind,
                                                    Fit India School Week program was launched in 2019.</p>
                                                <p>This year “Fit India School Week” will be celebrated
                                                    virtually by schools in December.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingTwo">
                                            <h2 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Guidelines
                                                </a>
                                            </h2>
                                        </div>

                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="panel-body">
                                                <ol>
                                                    <li>Schools to ensure that all Students, Parents, Staff
                                                        and Management shall actively participate in the Fit
                                                        India School Week 2020 programme</li>
                                                    <li>Schools may create a new page on their website
                                                        titled “Fit India School Week 2020” and a brief
                                                        about the activities undertaken and related
                                                        pictures/videos can be uploaded on it.</li>
                                                    <li>Schools should register themselves on
                                                        https://fitindia.gov.in/fit-india-school-week
                                                        and upload photos and video link related to the
                                                        event</li>
                                                    <li>All registered schools may download a Digital
                                                        Certificate. which can be downloaded from Fit India
                                                        Portal after successful conduct of the Fit India
                                                        School Week.</li>
                                                    <li>Schools are also encouraged to share/post activities
                                                        conducted on their social media channels with
                                                        <strong>#NewIndiaFitIndia</strong> and tag
                                                        <strong>@FitIndiaOff</strong>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default lastpanel">
                                        <div class="panel-heading" role="tab" id="headingThree">
                                            <h3 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Activities
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                            <h4 style="margin-bottom:15px;">Virtual Activities for Fit India School Week Celebrations 2020</h4>
                                            <div class="panel-body">
                                                <table border="0" width="100%" class="table-grid">
                                                    <tbody>
                                                        <tr>
                                                            <th colspan="1">Day</th>
                                                            <th colspan="1">Activity</th>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>01</td>
                                                            <td>
                                                                <ul style="list-style-type: upper-roman;padding-left:15px;">
                                                                    <li> Virtual Assembly – Free hand exercises</li>
                                                                    <li>Fun and Fitness- Aerobics, Dance
                                                                        forms, Rope Skipping, Hopscotch, Zig
                                                                        Zag and Shuttle Running etc. Fit
                                                                        India Active Break capsules could be
                                                                        used for demonstration purposes.
                                                                    </li>
                                                                </ul>
                                                                <p style="margin:0;">Link below:</p>
                                                                <p>https://drive.google.com/drive/folders/1t14ZOGyh9biDsw8CxmxhogMwB0A8E2ll?usp=sharing</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>02</td>
                                                            <td>
                                                                <ul style="list-style-type: upper-roman;padding-left:15px;">
                                                                    <li>Virtual Assembly – Common Yoga Protocols https://yoga.ayush.gov.in/yoga/common-yoga-protocol
                                                                    </li>
                                                                    <li>Mental Fitness Activities (Ex.
                                                                        Debates, Symposium, Lectures by
                                                                        Sports Psychologists)</li>
                                                                    <li>Debates, Symposium, Lectures on
                                                                        “Re-strengthening of the mind post
                                                                        pandemic”– Mental Fitness Activities
                                                                        for Students, Staff and Parents</li>
                                                                    <li>Open letter to Youth of the Nation
                                                                        on “Power of Fitness”</li>
                                                                    <li>Open mic on topics such as “Exercise
                                                                        is a celebration of what your body
                                                                        can do, not a punishment for what
                                                                        you ate” etc.</li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>03</td>
                                                            <td>
                                                                <ul style="list-style-type: upper-roman;padding-left:15px;">
                                                                    <li>Brain Games to improve
                                                                        concentration/problem solving
                                                                        capacity – e.g Chess, Rubik’s cube
                                                                        etc.</li>
                                                                    <li>Poster making competition on theme
                                                                        “Hum Fit Toh India Fit” or “New
                                                                        India Fit India”</li>
                                                                    <li>Preparing advertisements on “Hum Fit
                                                                        Toh India Fit”, “Emotional and
                                                                        physical well-being are
                                                                        interconnected” etc.</li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>04</td>
                                                            <td>
                                                                <ul style="list-style-type: upper-roman;padding-left:15px;">
                                                                    <li>Debates, Symposium, Lectures etc
                                                                        about diet & nutrition during
                                                                        pandemic for Students / Staff &
                                                                        Parents</li>
                                                                    <li>Essay/Poem Writing Competition on
                                                                        theme “Fitness beats pandemic”</li>
                                                                    <li> Podcast/Movie making on suggested
                                                                        themes – “Get fit, don’t quit”;
                                                                        “Mental Health is not a destination
                                                                        but a journey” etc.</li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>05</td>
                                                            <td>
                                                                <ul style="list-style-type: upper-roman;padding-left:15px;">
                                                                    <li>Online Quiz related to
                                                                        fitness/sports</li>
                                                                    <li>Virtual challenges for students,
                                                                        staff/ teachers e.g.

                                                                        <ul class="" style="list-style-type: bullet; padding-left:15px;margin-top:15px;position: relative;">
                                                                            <li>Squats challenge</li>
                                                                            <li>Step-up challenge</li>

                                                                            <li>Spot jogging</li>
                                                                            <li>Rope skipping</li>
                                                                            <li>Ball dribbling etc</li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>Session(s) by motivational speakers
                                                                        for students, parents and school
                                                                        staff</li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>06</td>
                                                            <td>
                                                                <p>1 day dedicated to Family Fitness:</p>
                                                                <ul style="list-style-type: upper-roman;padding-left:15px;">
                                                                    <li>Activities for fitness sessions at
                                                                        home involving students and parents
                                                                        – Fit India Active Day capsules
                                                                        could be used for demonstration
                                                                        purposes<br>
                                                                        <a href="https://drive.google.com/drive/folders/18ophVtYf3qBOhpLQpX66y_ywCK_kgTsS?usp=sharing"><em>https://drive.google.com/drive/folders/18ophVtYf3qBOhpLQpX66y_ywCK_kgTsS?usp=sharing</em></a>
                                                                    </li>
                                                                    <li>Creatively using home-based
                                                                        equipment for sports & fitness. E.g.
                                                                        <ul style="padding-left:15px;margin-top:15px;">
                                                                            <li>Hacky sack at home (juggling
                                                                                with feet & hand – warm up
                                                                                activity)</li>
                                                                            <li>Aluminium foil inside a sock
                                                                                – ball and any wooden piece
                                                                                – bat to play cricket</li>

                                                                            <li>Mosquito bat and TT ball to
                                                                                play badminton/tennis</li>
                                                                            <li>Fitness circuit – Draw a
                                                                                ladder on the floor with a
                                                                                chalk piece or crayon</li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                    </div>




                                </div>

                            </section>

                        </article>

                        <!-- -----------------March-For-Women ------------------------- -->

                        <article class="tab-pane" id="March-For-Women">
                            <div>
                                <img src="{{ asset('resources/imgs/Strong-Women_inner.jpg') }}" alt="youthclub" title="March For Women" class="img-fluid expand_img" />
                            </div>
                            <section id="{{ $active_section_id }}">
                                <h1 class="heading_wm">March For Women</h1>

                                <div>
                                    <h2 class="womanH2">Organise Events from 8th March to 22nd March and be a FIT INDIA CHAMPION under the category:</h2>
                                    <div>
                                        <p>1. FIT INDIA MARCH FOR WOMEN</p>
                                    </div>
                                    <ul>
                                        <li>Tug Of War</li>
                                        <li>Plog Run</li>
                                        <li>Kho kho</li>
                                        <li>Kabbadi</li>
                                        <li>Fitness Workshop For Women (For more information (<a class="getlink" style="color:#ff6600;" data-link="https://fitindia.gov.in/fitness-workshop-for-women/" href="https://fitindia.gov.in/fitness-workshop-for-women/">click here</a>)</li>
                                        <li>Tug Of War</li>
                                        <li>Tug Of War</li>
                                    </ul>
                                </div>

                                <div>
                                    <h2 class="womanH2">Partcipate and be a FIT INDIA STAR under the following categories</h2>
                                    <ol type="1">
                                        <li>AFC WOMEN’S FOOTBALL DAY POWERED BY FIT INDIA</li>
                                        <li>FIT INDIA ACTIVE WOMEN SUNDAY WITH</li>
                                        <li>FITNESS FOR WOMEN WITH VLCC <a class="getlink" href="javascript:void(0);" data-link="https://goqii.com/fias" target="_blank" rel="noopener noreferrer">GOQII</a></li>

                                    </ol>
                                </div>
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Get Started </a>
                                            </h4>

                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse  in show" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <p>You can also start a Women’s Group by involving your organisation, community, family and friends. Celebrate Fit India Women’s Day on any date in March 2020.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingTwo">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Why organise March For Women?
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="panel-body">
                                                <p>Women are the strongest pillar that holds a family together. She acts as a catalyst in making her family healthy, wealthy, and fit. But with regular chores of life she seldom overlooks her own health. Regular activities in the form of exercise are vital for the overall well being of women’s mental and physical health. Physical activity for 30 minutes a day can not only improve her daily life but also make her more efficient and mindful in making the right decisions. </p>
                                                <!-- <ol style=" padding-left: 15px;">
                                                                <li>Youth Club should be affiliated with the concerned
                                                                    District Unit.</li><br>
                                                                <li>Each member of the Youth club should be aware about
                                                                    the importance of physical fitness and spend 30-60
                                                                    minutes daily for at least 5 days every week for
                                                                    group physical activities.</li><br>
                                                                <li>Each member of the Youth Club should commit to
                                                                    motivate one additional person every month for
                                                                    incorporating physical activity of 30-60 mins in
                                                                    his/her daily routine.</li><br>
                                                                <li>The Youth club should organise or persuade the local
                                                                    body and school for organising one community fitness
                                                                    event every quarter.</li>
                                                            </ol> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingThree">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Who can organise?
                                                </a>
                                            </h4>

                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                            <div class="panel-body">
                                                <ol style=" padding-left: 15px;">
                                                    <li>Village, Town or City/ Council/ Panchayat/ Anganwadi / Block</li>
                                                    <li>Your Workplace</li>
                                                    <li>Society or RWA</li>
                                                    <li>Interest Groups (Walking, Running, Cycling)</li>
                                                    <li>Corporates and Industry bodies</li>
                                                    <li>Schools/ Colleges and Universities</li>
                                                    <li>NGOs</li>
                                                    <li>Communities</li>
                                                    <li>Individuals</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingfour">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                    Other Guidelines
                                                </a>
                                            </h4>

                                        </div>
                                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseFour">
                                            <div class="panel-body">
                                                <ol style=" padding-left: 15px;">
                                                    <li>Identify location.</li>
                                                    <li>Wherever required, take police permissions for traffic management.</li>
                                                    <li>Inform local bodies to place large empty garbage collection containers in/around the location</li>
                                                    <li>Please avoid use of Plastic</li>
                                                    <li>Please do the Procurement of Gloves and Collection Bags which are environment friendly</li>
                                                    <li>Inform communities around you about the March For Women event</li>
                                                    Schools within the radius of 5 kms can organise joint event for all the children in the schools. <li>Communities</li>
                                                    <li>Partner with local businesses can sponsor FIT INDIA tee shirts / caps for children.</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingFive">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseTwo">
                                                    How to use the Fit India Templates
                                                </a>
                                            </h4>

                                        </div>
                                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="panel-body">
                                                <h1 class="listHeading">Fit India Logo</h1>
                                                <ol>
                                                    <li>Download the Fit India Logo</li>
                                                    <li>Do not edit the Fit India Logo (color or dimension)</li>
                                                    <li>To be used for one time for this event only</li>
                                                </ol>
                                                <h2 class="listHeading">Backdrop</h2>
                                                <ol>
                                                    <li>Download the Backdrop design</li>
                                                    <li>Open using Adobe Illustrator / Corel Draw to place the logos of Organiser and Sponsors</li>
                                                    <li>The ideal backdrop dimension is 10 ft x 10 ft (3:2 ratio). You can expand it in the same ratio to adjust to the width of the stage where you want to place it.</li>
                                                    <li>Place the logo of the ORGANISER in the placeholder provided.</li>
                                                    <li>Place the logos of Sponsor(s) at the bottom of the screen on the white space</li>
                                                    <li>Do not edit any of the Fit India Logo or brand elements or their placements </li>
                                                </ol>
                                                <h2 class="listHeading">‘I am Fit India Star’ Certificate</h2>
                                                <ol>
                                                    <li>Download the Certificate design</li>
                                                    <li>Open using Adobe Illustrator / Corel Draw to place the logos of Organiser and Sponsors</li>


                                                    <li>The ideal backdrop dimension is A4 size. You can expand it in the same ratio to adjust to the width of the stage where you want to place it.</li>
                                                    <li>Place the logo of the ORGANISER in the placeholder provided.</li>
                                                    <li>Place the logos of Sponsor(s) at the bottom of the screen on the white space</li>
                                                    <li>Do not edit any of the Fit India Logo or brand elements or their placements</li>
                                                    <li>Depending upon the no. of participants, print certificates and give to the participants who finished the plog</li>
                                                </ol>

                                                <h2 class="listHeading">Fit India Flag</h2>
                                                <ol>
                                                    <li>Download the Flag design</li>
                                                    <li>Do not edit the Fit India Logo or add any element to the Fit India Flag</li>
                                                    <li>The dimension of the Flag is 900 mm x 600 mm. Do not change the dimension</li>
                                                    <li>Print as many Fit India Flags as you put in the venue</li>

                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-8 offset-md-2 you_tb mt-5">
                                        <a href="https://www.youtube.com/watch?v=aQKWtBsNK0s" target="_blank">
                                            <img src="{{ asset('resources/imgs/eventyoutube/Internationalwomenday.jpg') }}" alt="Launch-of-Fit-India-Movement" title="From walking kilometres to leading all walks of life, women are acing it all! Today, we are celebrating that spirit.
Here is a glimpse of a walkathon organized by FIT India Movement & Netaji Yuva Kendra" class="img-fluid expand_img" />
                                            <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>



                            </section>

                        </article>

                        <!-- -----------------Indigeneous-Games ------------------------- -->

                        <article class="tab-pane" id="Indigeneous-Games">
                            <div>
                                <img src="{{ asset('resources/imgs/Indigeneous.jpg') }}" alt="Indigeneous" title="Indigeneousgames" class="img-fluid expand_img" />
                            </div>
                            <section id="{{ $active_section_id }}">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 ">
                                        <div class="indigen_game">
                                            <img src="{{ asset('resources/imgs/Gatka.jpeg') }} " class="fluid-img" />
                                            <div>
                                                <h1><u>Gatka:</u></h1>
                                                <p><strong>Gatka</strong> is an ancient fighting technique played with wooden sticks and also called Gatka art (stick-fighting). It is an Indian martial art associated with the Sikh history. This art is an integral part of vast arena of Sikh Shastar Vidiya comprising practise & usage of various weapons and physical exercises by the Sikh fighters also called Nihangs.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 ">
                                        <div class="indigen_game">
                                            <img src="{{ asset('resources/imgs/Roll-Ball.jpeg') }}" title="roll-ball" alt="Roll Ball" class="fluid-img">
                                            <div>
                                                <h1><u>Roll Ball:</u></h1>
                                                <p><strong>Roll Ball</strong> is a game played between two teams and is a unique combination of roller skates, basketball, handball, and throwball. The main feature of Roll Ball is that the ball is held in one or both hands, when passing to the other players, with the ball repeatedly bounced on the ground.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 ">
                                        <div class="indigen_game">
                                            <img src="{{ asset('resources/imgs/Tug-of-war.jpeg') }}" title="tugof war" alt="Tug of war" class="fluid-img">
                                            <div>
                                                <h1><u>Tug of war:</u></h1>
                                                <p><strong>Tug of war</strong> (also known as tug o’ war, tug war, rope war, rope pulling, or tugging war) is a sport that pits two teams against each other in a test of strength: teams pull on opposite ends of a rope, with the goal being to bring the rope a certain distance in one direction against the force of the opposing team’s pull.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 ">
                                        <div class="indigen_game">
                                            <img src="{{ asset('resources/imgs/Kalaripayattu.jpeg') }}" title="Kalaripayattu" alt="Kalaripayattu" class="fluid-img" />
                                            <div>
                                                <h1><u>Kalaripayattu: </u></h1>
                                                <p><strong>Kalaripayattu </strong> also known simply as Kalari, is an Indian martial art and fighting style that originated in modern-day Kerala. Kalaripayattu is held in high regard by martial artists due to its long-standing history within Indian martial arts. It is believed to be the oldest surviving martial art in India. It is also considered to be among the oldest martial arts still in existence, with its origin in the martial arts timeline dating back to at least the 3rd century BCE.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 ">
                                        <div class="indigen_game">
                                            <img src="{{ asset('resources/imgs/thang-ta.jpeg') }}" title="thang-ta" alt="Thang-Ta" class="fluid-img" />
                                            <div>
                                                <h1><u>Thang-Ta: </u></h1>
                                                <p><strong>Thang-Ta </strong> is the tradition martial arts of Manipur, India. In the ancient time Thang-Ta Game is performed by the Thang-Ta Gurus by using weapon. This type of game is performed since the ancient times by the forefather of the Meitei (Manipuri).</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 ">
                                        <div class="indigen_game">
                                            <img src="{{ asset('resources/imgs/kho-kho.jpeg') }}" title="kho-kho" alt="Kho Kho" class="fluid-img">
                                            <div>
                                                <h1><u>Kho Kho: </u></h1>
                                                <p><strong>Kho Kho </strong> is a popular tag game invented in Maharashtra, India. It is played by teams of 12 nominated players out of fifteen, of which nine enter the field who sit on their knees (chasing team), and 3 extra (defending team) who try to avoid being touched by members of the opposing team. It is one of the two most popular traditional tag games in the Indian subcontinent, the other being Kabaddi. The sport is widely played across South Asia and has a strong presence in South Africa and England.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 ">
                                        <div class="indigen_game">
                                            <img src="{{ asset('resources/imgs/Mallakhamb.jpeg') }}" title="mallakhamb" alt="Mallakhamb" class="fluid-img">
                                            <div>
                                                <h1><u>Mallakhamb: </u></h1>
                                                <p><strong>Mallakhamb </strong> is a traditional sport, originating from the Indian subcontinent, in which a gymnast performs aerial yoga postures and wrestling grips in concert with a vertical stationary or hanging wooden pole, cane, or rope. The word Mallakhamb also refers to the pole used in the sport.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 ">
                                        <div class="indigen_game">
                                            <img src="{{ asset('resources/imgs/sports-default.jpg') }}" title="sport-default" alt="sports-default" class="fluid-img">
                                            <div>
                                                <h1><u>Sqay: </u></h1>
                                                <p><strong>Sqay </strong> is an Indian martial arts form of sword-fighting originating in the Kashmir region of ancient India. It is governed by the Sqay Federation of India. Armed sqay makes use of a curved single-edge sword paired with a shield, or one sword in each hand. Unarmed techniques incorporate kicks, punches, locks and chops. Sqay have different techniques single sword double sword free hand techniques and lessons of both free hand and sword.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 ">
                                        <div class="indigen_game">
                                            <img src="{{ asset('resources/imgs/Shooting-Ball.jpeg') }}" title="shooting-ball" alt="Shooting-Ball" class="fluid-img">
                                            <div>
                                                <h1><u>Shooting Ball:</u></h1>
                                                <p>Another indigenous sport, shootingball is similar to volleyball. The sport’s first world cup was held in New Delhi in 1992, with teams from India, Pakistan, Canada and UK, which India won. Players must clasp their hands to hit the ball. The game is played by seven players on each side of the net.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-12 col-md-12 ">
                                        <div class="indigen_game">
                                            <img src="{{ asset('resources/imgs/kabaddi.jpeg') }}" title="Kabaddi" alt="kabaddi" class="fluid-img" />
                                            <div>
                                                <h1><u>Kabaddi:</u></h1>
                                                <p><strong>Kabaddi </strong>is a contact team and sport played between two teams of seven players each. … Players are taken out of the game if they are tagged or tackled, but are brought back in for each point scored by their team from a tag or tackle. It is popular in South Asia and other surrounding Asian countries.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </section>
                        </article>


                        <!-- -----------------The International Day of Yoga - ------------------------- -->

                        <article class="tab-pane" id="Internation-yoga">
                            <div>
                                <img src="{{ asset('resources/imgs/Banner_yoga-2.gif') }}" alt="International Day of Yoga" title="International Day of Yoga" class="img-fluid expand_img" />
                            </div>
                            <section id="{{ $active_section_id }}">

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 ">
                                        <p><strong>The International Day of Yoga </strong> has been celebrated annually on 21 June since 2015, following its inception in the United Nations General Assembly in 2014.Yoga is a physical, mental and spiritual practice which originated in India. The Indian Prime Minister, Narendra Modi, in his UN address suggested the date of 21 June, as it is the longest day of the year in the Northern Hemisphere and shares a special significance in many parts of the world.</p>
                                        <p>The first International Day of Yoga created a record for the largest yoga class, and another for the largest number of participating nationalities.</p>
                                        <p>Yoga is an invaluable gift of India’s ancient tradition. It embodies unity of mind and body; thought and action; restraint and fulfilment; harmony between man and nature; a holistic approach to health and well-being. It is not about exercise but to discover the sense of oneness with yourself, the world and the nature. By changing our lifestyle and creating consciousness, it can help in well-being. Let us work towards adopting an International Yoga Day.</p>
                                        </br>
                                        </br>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 d-flex">
                                        <div class="mr-2">
                                            <a class=" btn_round" href="register/">Yoga at Home</a>
                                        </div>
                                        <div>
                                            <a class=" btn_round" href="https://mylifemyyoga2020.com/home" target="_blank">mylifemyyoga Video Blogging Contest</a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </article>

                        <!-- -----------------Fun Family Yoga - - ------------------------- -->

                        <article class="tab-pane" id="Fun-Family-Yoga">
                            <div>
                                <img src="{{ asset('resources/imgs/Banner-Shilpa-shetthy.jpg') }}" title="Fun-Family-Yoga" alt="Fun-Family-Yoga" class="img-fluid expand_img" />
                            </div>
                            <section id="{{ $active_section_id }}">

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 ">
                                        <p>Fit India Mission is organizing a special live session at <strong>5 PM on June 21st to celebrate International Day of Yoga.</strong> Shilpa Shetty, renowned fitness icon and experienced Yoga practitioner will be conducting the live session on Fit India YouTube channel . MoS(I/C), MoYAS, Ms. Mary Kom and Ms. Anjum Moudgil will be joining the live session. The session will be specially designed by keeping in mind MoAYUSH guidelines about yoga@home and to engage children meaningfully through fun and education elements about yoga.</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8 col-md-8 offset-md-2 you_tb mt-5">
                                        <a href="https://www.youtube.com/watch?v=RyUB8CWxNds" target="_blank">
                                            <img src="{{ asset('resources/imgs/eventyoutube/InternationalYogaDayLive.jpg') }}" title="International Yoga Day-Live" alt="International Yoga Day-Live" class="img-fluid expand_img" />
                                        </a>
                                        <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                    </div>
                                </div>



                            </section>
                        </article>


                        <!-- -----------------Fit India Freedom Run- - ------------------------- -->

                        <article class="tab-pane" id="Fit-India-Freedom-Run">
                            <div>
                                <img src="{{ asset('resources/imgs/fitness-protocols.png') }}" alt="Fit India Freedom Run" title="Fit India Freedom Run" class="img-fluid expand_img" />
                            </div>
                            <section id="{{ $active_section_id }}">

                                <div class="row">
                                    <div class="col-sm-12 col-md-8 ">
                                        <h1 class="F_runh1">Fit India Freedom Run</h1>
                                        <p class="g_par">“RUNNING: The human body’s most raw form of FREEDOM”</p>
                                        <p><strong>Fit India Movement </strong>is conducting <strong>Fit India Freedom Run </strong>from 15th August – 2nd October 2020 to encourage fitness and help us all to get freedom from obesity, laziness, stress, anxiety, diseases etc. The concept behind this run is that “It can be run anywhere, anytime!”. You can-</p>
                                        <ul class="ul_are">
                                            <li>Run a route of your choice, at a time that suits you.</li>
                                            <li>Break-up your runs. </li>
                                            <li>Run your own race at your pace.</li>
                                            <li>Track your kms manually or by using any tracking app or GPS watch.</li>

                                        </ul>
                                        <h6 style="color:#000;">
                                            <u>Mode of participation:</u>
                                        </h6>
                                        <ul class="ul_are">
                                            <li>Participation can be done through Fit India Website either on</li>
                                            <li>Organiser’s platform or</li>
                                            <li>Those who have undertaken their own run can individually submit their data and download the certificate.</li>


                                        </ul>

                                        <div class="note_div">
                                            <strong>Note:</strong>
                                            <p>1. Organisers will have to register their runs/marathons on Fit India portal (www.fitindia.gov.in) They will use the Fit India Logo for all promotional media and provide the data of participants with their cumulative kms covered.</p>
                                            <p>2. FIT INDIA mission advises organizers and individuals to organize their events following the social distancing norms and encourages the new normal of ‘virtual runs’ as is being practiced by runners / walkers across the world.</p>
                                            <p></p>
                                        </div>




                                    </div>

                                    <div class="col-sm-12 col-md-4 ">
                                        <div>
                                            <video controls="" class="vido_are">
                                                <source type="video/mp4" src="{{ asset('resources/videos/Fit-India-Freedom-Run-Final-1.m4v')}} ">

                                            </video>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-6 you_tb mt-5">
                                        <a href="https://www.youtube.com/watch?v=nyUgaDwgXk4" target="_blank">
                                            <img src="{{ asset('resources/imgs/eventyoutube/FitIndiaFreedomSeries.jpg') }}" alt="Fit India Freedom Run " title="Fit India Freedom Run " class="img-fluid expand_img" />
                                            <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                        </a>
                                    </div>

                                    <div class="col-sm-12 col-md-6 you_tb mt-5">
                                        <a href="https://www.youtube.com/watch?v=_Wd77QICEqw" target="_blank">
                                            <img src="{{ asset('resources/imgs/eventyoutube/FitIndiaFreedomRun.jpg') }}" title="Launch-of-Fit-India-Movement" alt="Launch-of-Fit-India-Movement" class="img-fluid expand_img" />
                                            <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>

                            </section>
                        </article>


                        <!-- -----------------Fit India Walkathon 200 KM by ITBP ------------------------- -->

                        <article class="tab-pane" id="Fit-India-Walkathon-200">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 ">
                                    <h1 class="walka_h1">Fit India Walkathon 200 KM by ITBP</h1>
                                    <p><strong>Be</strong> a part of the biggest Walkathon of 2020, walk will be hosted by <strong>DG ITBP</strong> and Flag off will be done by <strong> Kiren Rijiju, Hon’ble Sports Minister of India.</strong></p>
                                    <p><strong>Fit India Mission</strong> always encourages people to remain healthy and fit by including physical activities and sports in their daily lives. Since, its inception various activities have been organised by the Fit India Mission which have seen mass engagement and participation from all parts of the country. Another such initiative is the <strong>Fit India Walkathon 200 KM </strong>which will be anchored by the Indo-Tibetan Border Police in Jaisalmer (Rajasthan).</p>

                                </div>

                                <div class="col-sm-12 col-md-12 ">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Event Info</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Event Name</td>
                                                <td>Fit India Walkathon 200 KM by ITBP</td>
                                            </tr>
                                            <tr>
                                                <td>Place</td>
                                                <td>Jaisalmer (Rajasthan)</td>
                                            </tr>

                                            <tr>
                                                <td>Date</td>
                                                <td>31st October – 2nd November (3 days Event)</td>
                                            </tr>

                                            <tr>
                                                <td>Starting Point</td>
                                                <td>Kishangarh</td>
                                            </tr>

                                            <tr>
                                                <td>Finishing point</td>
                                                <td>RD1366 (between Mohangarh and Nachna)</td>
                                            </tr>

                                            <tr>
                                                <td>Organized by </td>
                                                <td>ITBP</td>
                                            </tr>
                                        </tbody>

                                    </table>


                                    <div>
                                        <p><strong>Note:</strong> Travelling cost to be borne by the participant, boarding and lodging cost will be taken care by ITBP.</p>
                                        <p>For further Information, please write an email to contact[dot]fitindia[at]gmail[dot]com for the justification of your credentials to become a part of this Walkathon 200KM</p>
                                    </div>
                                </div>


                            </div>

                        </article>




                        <!-- -----------------Fit India Talks ------------------------- -->

                        <article class="tab-pane" id="Fit-India-Talks">
                            <div>
                                <img src="{{ asset('resources/imgs/FitIndia_Talks.png') }}" title="FIT INDIA TALK" alt="FIT INDIA TALK" class="img-fluid expand_img" />
                            </div>
                            <section id="{{ $active_section_id }}">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 ">

                                        <p>Since 15 April 2020, FIT India has been doing exclusive content sessions for school students with lead fitness experts. These are capsules exclusively curated for school students. As a follow up to these sessions, FIT INDIA proposes to launch a series of sessions with Top sports celebrities of our country for a candid yet inspiring session for school children.</p>
                                        <h1 class="fit_head"><u>FIT INDIA TALK WITH CHAMPIONS</u></h1>
                                        <p>Here we will have the leading sports celebrities being hosted for a candid talk with an anchor and the session will be done LIVE as a webinar on YouTube / FB and other digital platforms.</p>
                                        <p>These talks will be curated to make the whole conversation interesting and inspiring for the young children. It will focus on the champions sharing their experiences of childhood, their stories on how they got inspired, their failures, struggles and their success to give the audience (children) a very inspirational yet interesting account of their journeys – from common school students like them to world class champions.</p>
                                        <h2 class="fit_head"><u>Launch show – 3<sub>rd</sub> July 2020 at 5:00 PM with Hon’ble Ministers & Sports Icons – PV Sindhu & Sunil Chettri</u></h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <img src="{{ asset('resources/imgs/fitindia_talks-Manika_Batra.jpeg') }}" title="fitindia_talks-Manika_Batra" alt="fitindia_talks-Manika_Batra" class="img-fluid expand_img" />
                                    </div>
                                    <div class="col-sm-12 col-md-4  col-lg-4">
                                        <img src="{{ asset('resources/imgs/fitindia_talks-Rani.png') }}" title="fitindia_talks-Rani" alt="fitindia_talks-Manika_Batra" class="img-fluid expand_img" />
                                    </div>
                                    <div class="col-sm-12 col-md-4  col-lg-4">
                                        <img src="{{ asset('resources/imgs/fitindia_talks-Apurvi.jpeg') }}" title="fitindia_talks-Apurvi" alt="fitindia_talks-Manika_Batra" class="img-fluid expand_img" />
                                    </div>
                                    <div class="col-sm-12 col-md-4  col-lg-4 mt-5">
                                        <img src="{{ asset('resources/imgs/fitindia_talks-ashwini.jpg') }}" tilte="fitindia_talks-ashwini" alt="fitindia_talks-Manika_Batra" class="img-fluid expand_img" />
                                    </div>
                                    <div class="col-sm-12 col-md-4  col-lg-4 mt-5">
                                        <img src="{{ asset('resources/imgs/fitindia_talks-Deepa-malik.jpeg') }}" title="fitindia_talks-Deepa-malik" alt="fitindia_talks-Manika_Batra" class="img-fluid expand_img" />
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 mt-5">
                                        <img src="{{ asset('resources/imgs/fitindia_talks-Deepa-malik-p2.jpeg') }}" title="fitindia_talks-Deepa-malik-p2" alt="fitindia_talks-Manika_Batra" class="img-fluid expand_img" />
                                    </div>
                                </div>

                                <h2 style="color:#000;" class="mt-5 mb-5">You Videos</h2>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4 you_tb shadow_img1">
                                        <a href="https://www.youtube.com/watch?v=X7pg_jy89jI" target="_blank" class="">
                                            <img src="{{ asset('resources/imgs/eventyoutube/img_1.jpg') }}" title="Fit India Talks Inaugural session" alt="Fit India Talks Inaugural session" class="img-fluid expand_img" />
                                            <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                        </a>
                                    </div>

                                    <div class="col-sm-12 col-md-4  col-lg-4 you_tb">
                                        <a href="https://www.youtube.com/watch?v=iek17rsf7hM" target="_blank">
                                            <img src="{{ asset('resources/imgs/eventyoutube/img_2.jpg') }}" title="Fit India Talks with Manika Batra" alt="Fit India Talks with Manika Batra" class="img-fluid expand_img" />
                                            <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                        </a>
                                    </div>

                                    <div class="col-sm-12 col-md-4  col-lg-4 you_tb">
                                        <a href="https://www.youtube.com/watch?v=W8abI64Otwk" target="_blank">
                                            <img src="{{ asset('resources/imgs/eventyoutube/img_3.jpg') }}" title="Fit India Talks with Rani - Captain, Indian Women's Hockey team" alt="Fit India Talks with Rani - Captain, Indian Women's Hockey team" class="img-fluid expand_img" />
                                            <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                        </a>
                                    </div>

                                    <div class="col-sm-12 col-md-4  col-lg-4 mt-5 you_tb">
                                        <a href="https://www.youtube.com/watch?v=JIr2JHUAids" target="_blank">
                                            <img src="{{ asset('resources/imgs/eventyoutube/img_4.jpg') }}" title="Fit India Talks with Apurvi Chandela, Indian Shooter" alt="Fit India Talks with Apurvi Chandela, Indian Shooter" class="img-fluid expand_img" />
                                            <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                        </a>
                                    </div>

                                    <div class="col-sm-12 col-md-4  col-lg-4 mt-5 you_tb">
                                        <a href="https://www.youtube.com/watch?v=n2ijMQlMncw" target="_blank">
                                            <img src="{{ asset('resources/imgs/eventyoutube/img_5.jpg') }}" title="Fit India Talks with Ashwini Ponnappa - Arjuna Awardee Badminton player" alt="Fit India Talks with Ashwini Ponnappa - Arjuna Awardee Badminton player" class="img-fluid expand_img" />
                                            <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                        </a>
                                    </div>

                                    <div class="col-sm-12 col-md-4 col-lg-4 mt-5 you_tb">
                                        <a href="https://www.youtube.com/watch?v=uH1dU5vympI" target="_blank">
                                            <img src="{{ asset('resources/imgs/eventyoutube/img_6.jpg') }}" title="Fit India Talks with Deepa Malik Part-2" alt="Fit India Talks with Deepa Malik Part-2" class="img-fluid expand_img" />
                                            <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                        </a>
                                    </div>

                                    <div class="col-sm-12 col-md-4 col-lg-4 mt-5 you_tb">
                                        <a href="https://www.youtube.com/watch?v=9ASTjsHrEJ8" target="_blank">
                                            <img src="{{ asset('resources/imgs/eventyoutube/img_7.jpg') }}" title="Fit India Talks with Deepa Malik Part-1" alt="Fit India Talks with Deepa Malik Part-1" class="img-fluid expand_img" />
                                        </a>
                                        <i class="fa fa-youtube-play" aria-hidden="true"></i>

                                    </div>
                                </div>











                            </section>
                        </article>

                        <!-- -----------------Fitindia Plogging Ambassador  ------------------------- -->

                        <article class="tab-pane" id="Fitindia-Plogging-Ambassador">
                            <div class="head_fpa">
                                <h1>Felicitation of Sh. Ripudaman Belvi (Plog Man of India)on his 50th Plog Run in 2019</h1>
                                <p>on 5th Dec, 2019 at 8:00 am Jawaharlal Nehru Stadium, New Delhi</p>
                            </div>
                            <section id="{{ $active_section_id }}">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3 ">
                                        <img src="{{ asset('resources/imgs/Fitindia-Plogging-Ambassador2.png') }}" title="Fitindia-Plogging-Ambassador" alt="Fitindia-Plogging-Ambassador" class="img-fluid expand_img" />
                                        <p>Ripudaman flagged off the Fit India Plogging event with Minister</p>
                                    </div>

                                    <div class="col-sm-12 col-md-9 ">
                                        <p>Fit India Plogging encapsulates two Modi Govt. initiatives – Swachch Bharat Abhiyaan (Clean India Mission) and Fit India Movement. Plogging is a combination of jogging with picking up litter. As a workout, it provides variation in body movements by adding bending, squatting and stretching to the main action of running, hiking, or walking. </p>
                                        <p><strong>Prime Minister Narendra Modi in Mann ki Baat</strong> on 29th Sep had lauded <strong>India’s first plogger, Ripudaman Belvi for taking the unique initiative to make India a litter-free and garbage-free place.</strong> Addressing the citizen of the country during 57th episode of ‘Mann ki Baat’, Modi spoke to one of the special guests, Ripudaman who is making plogging popular across India and termed it as his ‘devotion. Plogging is jogging while picking up litter. “Ripudaman Bevli is taking a unique initiative. He is doing plogging. It was a new word for me when I first heard it. Plogging has been used in foreign countries but in India, Ripudaman ji has made it quite popular,” the Prime Minister said.</p>
                                        <p>Ripudaman said, <strong>“When we go running in the morning, traffic and crowd are very less so at that time, garbage, trash and plastic are more visible. So, instead of cribbing and complaining, I thought of doing something. I started it with my running group in Delhi and took it to the entire country.”</strong></p>
                                        <p>Ripudaman flagged off the Fit India Plogging event with Minister of Youth Affairs and Sports, Shri Kiren Rijiju on 2nd October 2019. Over 60000+ organisations and groups organised the Fit India Plogging events across India.</p>
                                        <p>As the Fit India Plogging Ambassador, he ran thousands of kilometers covering 50 cities and clean the areas. Ripudaman believes that if India will become garbage-free, it will surely become plastic-free as well. The 50th and Final Plog run of 2019 and felicitation of Ripudaman will be done on 5th Dec, 2019 at 8:00 am at Jawaharlal Nehru Stadium, New Delhi for his contribution towards popularising Plogging in India.</p>
                                    </div>

                                </div>

                                <!-- <div class="become-an-ambassador1 bg_2">
                                    <p>It is proposed to organise Monthly Plogging events across India by appointing Fit India Plogging Ambassadors in every district of India. If you are interested to become a Fit India Plogging Ambassador in your district, register yourself/your organisation.</p>
                                    <p><a href="#a" class="create_event">Become a Fit India Plogging Ambassador</a></p>
                                </div> -->

                            </section>
                        </article>


                        <!-- -----------------FIT-India-Monthly-Plog-eventt- - ------------------------- -->


                        <article class="tab-pane " id="FIT-India-Monthly-Plog-event">
                            <div class="banner_area1">
                                <img src="{{ asset('resources/imgs/Common_plog-event1.jpg') }}" title="Common_plog-event1" alt="Common_plog-event1" class="img-fluid expand_img" />
                            </div>
                            <section>
                                <h1 class="heading_eventh1">Organise a FIT India Monthly Plog event</h1>
                                <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h2 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Background
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <p>Our Nation celebrated 150th Birth Anniversary of Mahatma Gandhi on 2nd Oct, 2019 in a big way, with the special concept of FIT INDIA 2 km Plog event (02 Oct – at least 2 kms) as a special tribute, where over 60000+ schools, colleges, Organisations, Councils, Panchayats, Corporations, Societies, RWA, NGOs, special interest groups organised events across India.</p>
                                                <p>Going forward, Fit India Plog events will be organised by Fit India Plog Groups last Sunday of every month.</p>
                                                <p>You can also start a Plog Group by involving your organisation, community, family and friends.</p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingTwo">
                                            <h2 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Why organise a 2 km Plog event?
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="panel-body">
                                                <p>Jogging is good for your Health. Swachchata is good for the India’s health. Why not combine the two? Plog is the new running craze that is saving the world from plastic pollution, by combining Jogging with Picking up litter (Swedish: plocka upp). Won’t it be satisfying to take your gloves and a bag and start picking up garbage/litter along the way while you are jogging, instead of just passing by and silently cursing the individual who dumped it?</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default ">
                                        <div class="panel-heading" role="tab" id="headingThree">
                                            <h3 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Who can organise a Fit India Plog event?
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                            <ul>
                                                <li>Village, Town or City/ Council/ Panchayat/ Anganwadi / Block</li>
                                                <li>Your Workplace</li>
                                                <li>Society or RWA</li>
                                                <li>Interest Groups (Walking, Running, Cycling)</li>
                                                <li>Corporates and Industry bodies</li>
                                                <li>Schools/ Colleges and Universities</li>
                                                <li>NGOs </li>
                                                <li>Communities</li>
                                                <li>Individuals</li>

                                            </ul>
                                            <p>Organisers must ensure that All “Fit India Plog Runs” which are be listed on fitindia.gov.in portal are non-commercial in nature. </p>
                                            <p>The details on how to organise the FIT INDIA 2 km Plog event is in following section:</p>

                                        </div>


                                    </div>

                                    <div class="panel panel-default ">
                                        <div class="panel-heading" role="tab" id="headingFour">
                                            <h3 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                    How to Organise or Join The Fit India 2 km Plog
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                            <ul>
                                                <li>Run with a purpose. Pick up Litter while running and cleaning your sorrounding and environment</li>
                                                <li>Organise a Plog (Running and Pick Litter) event with your Family, Friends, and Colleagues. Inspire others.</li>
                                                <li>Anyone can Participate – Students, Work Professionals, Housewives, Youth, Senior Citizens, Divyang</li>
                                                <li>Conceptualise, Organise and Execute the Fit India 2 Km Plog event in around your Residence, Community Village, Panchayat, Office, School, College etc. Register today!</li>
                                                <li>Plog at least 2 kilometers and pick up Litter on the way in a Garbage collection bin/bag.</li>
                                                <li>Post your picture and videos on the fitindia.gov.in portal.</li>
                                                <li>Organisers get an E-Certificate as a Fit India Movement partner </li>
                                                <li>Participants get Certificate from Organisers (Design will be provided to Organisers for printing and distributing).</li>
                                                <li>Don’t wait. Choose your partners, motivate your friends and family members to participate in the Fit India 2 Km Plog event</li>

                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel panel-default ">
                                        <div class="panel-heading" role="tab" id="headingFive">
                                            <h3 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                    Guidelines for Organisers
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                            <ul>
                                                <li>The FIT India 2 km Plog will be executed by any Government or Private Organization, School, College, University, Individual, Group, RWAs and Communities to create awareness on fitness through plog.</li>
                                                <li>We invite everyone to organise or join a plog for a min of 2 kms in their Institution/ Village, Town or City/ Council/ Panchayat/ Anganwadi / Block / Workplace/ Society or RWA / Workplace or any place of your choice.</li>
                                                <li>To become an Organiser, you have to register Online on fitindia.gov.in and get important details about the event you plan to do</li>
                                                <li>Conceptualise, Organise and Execute the Fit India 2 Km Plog event in around your Residence, Community Village, Panchayat, Office, School, College etc. Register today!</li>
                                                <li>As an Organiser, you will be responsible for conceptualizing, executing and ensuring a smooth and successful plog event to maximize public participation. The distance of the plog should be at least 2 km.</li>
                                                <li>You can invite other organisations as well for online participation registration.</li>
                                                <li>You can get sponsorship and also have partners to organise this event. </li>
                                                <li>Any fitness enthusiast who is participating must strive to motivate at least one partner to take part in plog (eg. student to get parent, friend to get friend etc) so as to spread FIT India Campaign.</li>
                                                <li>MYAS will provide the following Standard FIT INDIA 2 km Plog design templates for branding elements on the registration portal / MYAS website for organizers to download and use the same:

                                                    <ol type="a">
                                                        <li>Backdrop</li>
                                                        <li>Selfie Points</li>
                                                        <li>Certificate Design for distributing to Participants</li>
                                                        <li>Information Booklet</li>

                                                    </ol>
                                                </li>
                                                <li>Organizers will get FIT INDIA Movement Partner – certificate from Ministry of Youth Affairs and Sports.</li>
                                                <li>PARTNERSHIPS OPPORTUNITIES: Those interested in partnership can also write to MYAS on:</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel panel-default ">
                                        <div class="panel-heading" role="tab" id="headingSix">
                                            <h3 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                    Other Guidelines
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                            <ul>
                                                <li>Identify track, create map.</li>
                                                <li>Wherever required, take police permissions for traffic management.</li>
                                                <li>Inform local bodies to place large empty garbage collection containers near plog finish line.</li>
                                                <li>Please avoid use of Plastic</li>
                                                <li>Please do the Procurement of Gloves and Collection Bags which are environment friendly</li>
                                                <li>Inform communities around you about the plog</li>
                                                <li>Encourage participation for 1 adult family member along with child.</li>
                                                <li>Schools within the radius of 5 kms can organise joint marathon for all the children in the schools.</li>
                                                <li>Partner with local businesses can sponsor FIT INDIA tee shirts / caps for children.</li>
                                                <li>Any queries regarding the plog to be sent to MYAS on contact[dot]fitindia[at]gmail[dot]com</li>

                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel panel-default ">
                                        <div class="panel-heading" role="tab" id="headingSeven">
                                            <h3 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                                    How to use the Fit India Plog Event Templates
                                                </a>
                                            </h3>
                                        </div>

                                        <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                                            <h5>Fit India Logo</h5>
                                            <ol type="1">
                                                <li>Download the Fit India Logo</li>
                                                <li>Do not edit the Fit India Logo (color or dimension)</li>
                                                <li>To be used for one time for this event only</li>
                                            </ol>
                                            <h5>Backdrop</h5>
                                            <ol type="1">
                                                <li>Download the Backdrop design</li>
                                                <li>Open using Adobe Illustrator / Corel Draw to place the logos of Organiser and Sponsors</li>
                                                <li>The ideal backdrop dimension is 12 ft x 8 ft (3:2 ratio). You can expand it in the same ratioto adjust to the width of the stage where you want to place it.</li>
                                                <li>Place the logo of the ORGANISER in the placeholder provided.</li>
                                                <li>Place the logos of Sponsor(s) at the bottom of the screen on the white space</li>
                                                <li>Do not edit any of the Fit India Logo or brand elements or their placements</li>
                                            </ol>
                                            <h5>‘I am Finisher’ Certificate</h5>
                                            <ol type="1">
                                                <li>Download the Certificate design</li>
                                                <li>Open using Adobe Illustrator / Corel Draw to place the logos of Organiser and Sponsors</li>
                                                <li>The ideal backdrop dimension is A4 size. You can expand it in the same ratio to adjust to the width of the stage where you want to place it.</li>
                                                <li>Place the logo of the ORGANISER in the placeholder provided.</li>
                                                <li>Place the logos of Sponsor(s) at the bottom of the screen on the white space</li>
                                                <li>Do not edit any of the Fit India Logo or brand elements or their placements</li>
                                                <li>Depending upon the no. of participants, print certificates and give to the participants who finished the plog</li>
                                            </ol>

                                            <h5>Fit India Flag</h5>
                                            <ol type="1">
                                                <li>Download the Flag design</li>
                                                <li>Do not edit the Fit India Logo or add any element to the Fit India Flag</li>
                                                <li>The dimension of the Flag is 900 mm x 600 mm. Do not change the dimension</li>
                                                <li>Print as many Fit India Flags as you put in the venue</li>
                                            </ol>
                                            <h5>Fit India Selfie Points</h5>
                                            <ol type="1">
                                                <li>Download the Selfie designs</li>
                                                <li>The cut out should be at the height not exceeding 4 ft to 4.5 ft so that anyone can place their head. This will vary for different postures. Adjust the height according</li>
                                                <li>Create as many Selfie Points as you want.</li>
                                            </ol>

                                        </div>
                                    </div>
                                </div>


                            </section>
                        </article>


                        <!-- -----------------Launch-of-Fit-India-Movement - --------------------------->


                        <article class="tab-pane " id="Launch-of-Fit-India-Movement">
                            <section>
                                <div class="row">
                                    <div class="col-sm-8 col-md-8 offset-md-2 ">
                                        <a href="https://www.youtube.com/watch?v=Fie_bmfXivo" target="_blank">
                                            <img src="{{ asset('resources/imgs/fitindiamovement.jpg') }}" tite="Launch-of-Fit-India-Movement" alt="Launch-of-Fit-India-Movement" class="img-fluid expand_img" />
                                        </a>
                                    </div>
                                </div>
                            </section>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
</div>
</div>
</div>
<script>
    $(function() {
        $('.nav-item> a').click(function() {
            var check = $(this).attr('href');
            //alert(check.replace('#', ''));
            var checkVal = check.replace('#', '');
            $('.nav-item>a').removeClass('active');
            $("#" + checkVal).addClass('active');
            $(this).addClass('active');
            $('.tab-content article').each(function(i, j) {
                $(this).hide();
                $("#" + checkVal).closest('article').show();

            });

        });
    });
</script>




@endsection
