@extends('layouts.app')
@section('title', 'National Sports Day 2025 | Fit India')
@section('content')
@php
$active_section = request()->segment(count(request()->segments()));
$active_section_id = trim($active_section);
@endphp
<head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<style>
  /* .table-bordered_cut td,
  .table-bordered_cut th {
    border: 1px solid #757575 !important;
  } */
  table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 15px;

}
</style>
<style>
   /* .nsd-btns{
   display: flex;
   align-items: center;
   justify-content: center;
   flex-wrap: wrap;
   } */
   *{
   margin: 0;
   padding: 0;
   box-sizing: border-box;
   }
   .btn{
   width: 100%;
   height: 162px;
   border-radius: 7px;
   display: flex;
   align-items: center;
   justify-content: center;
   flex-direction: column;
   /* margin: 10px; */
   cursor: pointer;
   }
   .nsd-btns{
   background:linear-gradient(to right , #FFFEEB , #FFF2EF );
   }
   .nsd-btns h1{
   font-family: 'poppins';
   font-size: 28px;
   letter-spacing: 0.25px;
   text-align: center;
   font-weight: 600;
   }
   .nsd-btns h4{
   font-family: 'poppins';
   font-size: 20px;
   letter-spacing: 0.2px;
   text-align: center;
   font-weight: 400;
   }
   .nsd-btns h5{
   width: 40px;
   height: 40px;
   text-align: center;
   background-color: #0B0283;
   color: #fff;
   font-family: 'poppins';
   font-size: 15px;
   letter-spacing: 0.15px;
   color: #fff;
   display: flex;
   align-items: center;
   justify-content: center;
   border-radius: 50%;
   margin-left: auto;
   margin-right: auto;
   margin-bottom: -18px;
   z-index: 55;
   position: relative;
   }
   .nsd-btns div:nth-child(1) .btn{
   border: 1px solid #AEBEFF;
   /* background-color: #E9F5FF; */
   background-color: #fff;
   }
   .nsd-btns div:nth-child(2) .btn{
   border: 1px solid #E1B764;
   /* background-color: #FFF6E4; */
   background-color: #fff;
   }
   .nsd-btns div:nth-child(3) .btn{
   border: 1px solid #F98C9F;
   background-color: #fff;
   /* background-color: #FFEEF1; */
   }
   .nsd-btns div:nth-child(4) .btn{
   border: 1px solid #FF9061;
   background-color: #fff;
   /* background-color: #FFEAE1; */
   }
   .nsd-btns .btn img{
   height: 55px;
   width: 100%;
   }
   .nsd-btns h6{
   margin-bottom: 0;
   margin-top: 8px;
   font-family: 'poppins';
   font-size: 15px;
   letter-spacing: 0.15px;
   line-height: 24px;
   font-weight: 600;
   }
   @media screen and (max-width:991px) {
   .nsd-btns .btn{
   width: 75%;
   }
   }
   @media screen and (max-width:576px) {
   .nsd-btns .btn{
   width: 75%;
   }
   }
   @media screen and (max-width:450px) {
   .nsd-btns .btn{
   width: 75%;
   }
   }
   .nsd h2{
   font-family: 'poppins';
   font-size: 28px;
   letter-spacing: 0.28px;
   font-weight: 600;
   color: #000;
   }
   .nsd h3{
   color: #000;
   font-family: 'poppins';
   font-size: 20px;
   letter-spacing: 0.2px;
   font-weight: 500;
   }
   .nsd p{
   color: #434343;
   font-family: 'poppins';
   font-size: 16px;
   letter-spacing: 0.16px;
   font-weight: 400;
   }
   .nsd h4{
   font-family: 'poppins';
   font-size: 18px;
   letter-spacing: 0.18px;
   color: #000;
   padding-left: 10px;
   border-left: 4px solid #5110A7;
   }
   .button-section h3{
   font-family: 'poppins';
   font-size: 20px;
   letter-spacing: 0.2px;
   color: #000000;
   text-align: center;
   }
   .button-section h2{
   font-family: 'poppins';
   font-size: 32px;
   letter-spacing: 0.32px;
   color: #000000;
   text-align: center;
   }
   .button-section .buttons{
   border: 1px solid #000000;
   border-radius: 7px;
   background-color: #fff;
   color: #000000;
   font-weight: 600;
   padding: 10px 20px;
   width: 250px;
   cursor: pointer;
   }
   .button-section .buttons:hover{
   background-color: #0B0283;
   color: #fff;
   }
   .ani-img{
   transform: translate(80px, -90px);
   }
   .over-hide{
   overflow: hidden;
   }
   .whats-new h1{
   font-family: 'poppins';
   font-size: 27px;
   letter-spacing: 0.27px;
   font-weight: 600;
   }
   .whats-new h5{
   font-size: 15px;
   font-weight: 500;
   letter-spacing: 0.15px;
   text-transform: uppercase;
   font-family: 'poppins';
   }
   .whats-new h6{
   font-family: 'poppins';
   font-size: 21px;
   font-weight: 500;
   letter-spacing: 0.21px;
   /* text-transform: uppercase; */
   }
   .whats-new ul li{
   font-size: 12px;
   font-weight: 500;
   letter-spacing: 0.12px;
   /* text-transform: uppercase; */
   font-family: 'poppins';
   }
   .whats-new .my-row:hover{
   background-color: #fff;
   cursor: pointer;
   }
   .whats-new{
   background:linear-gradient(to right , #F6EBFF , #F1EFFF );
   }
   .whats-new h3{
   font-family: 'poppins';
   font-size: 77px;
   letter-spacing: 0.77px;
   color: #3F1C6D;
   font-weight: 400;
   }
   .whats-new p{
   font-family: 'poppins';
   font-size: 18px;
   letter-spacing: 0.18px;
   color: #000;
   }
   .whats-new .bs{
   border-left: 1px solid #3F1C6D !important;
   }
   .p-format h1{
   font-family: 'poppins';
   font-size: 28px;
   letter-spacing: 0.28px;
   text-align: center;
   font-weight: 600;
   }
   .p-format h4{
   font-family: 'poppins';
   font-size: 17px;
   letter-spacing: 0.17px;
   text-align: center;
   font-weight: 400;
   }
   .p-format h6{
   text-wrap: wrap;
   }
   .p-format h5{
   margin-bottom: -20px;
   margin-left: unset;
   margin-left: 15%;
   border-radius: 15%;
   }
   .p-format  h5{
   width: 40px;
   height: 40px;
   text-align: center;
   background-color: #0B0283;
   color: #fff;
   font-family: 'poppins';
   font-size: 15px;
   letter-spacing: 0.15px;
   color: #fff;
   display: flex;
   align-items: center;
   justify-content: center;
   /* border-radius: 50%; */
   /* margin-left: auto; */
   margin-right: auto;
   /* margin-bottom: -18px; */
   z-index: 55;
   position: relative;
   }
   .p-format .one h5{
   background-color: #3F1C6D;
   }
   .p-format .two h5{
   background-color: #FF8C4A;
   }
   .p-format .three h5{
   background-color:#E66A83;
   }
   .p-format h6{
   font-family: 'poppins';
   font-size: 17px;
   letter-spacing: 0.17px;
   font-weight: 400;
   }
   .p-format .btn{
   border-color: #CCCCCC !important;
   border-radius: 18px;
   }
   .p-format{
   background-color: #fff !important;
   }
   .age-wise h1{
   font-family: 'poppins';
   font-size: 28px;
   letter-spacing: 0.28px;
   text-align: center;
   font-weight: 600;
   }
   .age-wise h4{
   font-family: 'poppins';
   font-size: 17px;
   letter-spacing: 0.17px;
   text-align: center;
   font-weight: 400;
   }
   .age-wise{
   background:linear-gradient(to right , #EBF9FF , #DEF4FF );
   }
   .age-wise nav .active{
   font-family: 'poppins';
   font-size: 16px;
   letter-spacing: 0.16px;
   font-weight: 600;
   color: #000 !important;
   opacity: 1 !important;
   }
   .age-wise .active a{
   color: #000 !important;
   }
   .age-wise nav a{
   font-family: 'poppins';
   font-size: 16px;
   letter-spacing: 0.16px;
   font-weight: 600;
   color: #000 !important;
   opacity: 0.5;
   /* border: none !important; */
   }
   .age-wise nav .nav-link{
   border: 0 !important;
   }
   .age-wise .table th{
   border-top: 0 !important;
   }
   .age-wise table tbody td{
   font-family: 'poppins';
   font-size: 17px;
   letter-spacing: 0.17px;
   color: #000;
   font-weight: 500;
   border-top: 0 !important;
   border-bottom: 1px dotted #00000055 !important;
   }
   .activities h2{
   font-family: 'poppins';
   font-size: 28px;
   letter-spacing: 0.28px;
   font-weight: 600;
   color: #000;
   }
   .activities h4{
   color: #000;
   font-family: 'poppins';
   font-size: 15px;
   letter-spacing: 0.15px;
   font-weight: 600;
   }
   .activities p{
   color: #727272;
   font-family: 'poppins';
   font-size: 12px;
   letter-spacing: 0.12px;
   font-weight: 500;
   }
   .activities .w-100{
   min-height: 150px;
   }
   @media screen and (max-width:576px) {
   .activities .w-100{
   height: auto;
   }
   }
   .activities{
   background:linear-gradient(to right , #F6EBFF , #F1EFFF );
   }
   .highlights h3{
   color: #000;
   font-family: 'poppins';
   font-size: 28px;
   letter-spacing: 0.28px;
   font-weight: 600;
   }
   .highlights h4{
   color: #000;
   font-family: 'poppins';
   font-size: 17px;
   letter-spacing: 0.17px;
   font-weight: 400;
   }
   .highlights{
   background:linear-gradient(to right , #FFFEEB , #FFF2EF );
   }
   .highlights nav .nav-link{
   font-size: 16px !important;
   background-color: transparent !important;
   font-family:'poppins';
   color: #000 !important;
   font-weight: 600;
   opacity: 34%;
   /* border-bottom: 3px solid #3F1C6D !important; */
   }
   .highlights nav .active{
   background-color: transparent !important;
   font-family:'poppins';
   color: #000 !important;
   font-size: 16px !important;
   font-weight: 600;
   border-bottom: 3px solid #3F1C6D !important;
   opacity: 100%;
   }
   .h-left {
   flex-wrap: wrap;
   overflow: hidden;
   }
   .h-left img{
   width: 48%;
   }
    .h-right img{
        width: 100%;
        height: 400px;
    }
   @media screen and (max-width:991px){
    .h-left img{
    width: 98%;
    display: block;
    margin-left: auto;
    margin-right: auto;
    }
    .h-right img{
    width: 100%;
    height: unset;
    }
   }
</style>
    <div class="banner">
        <div class="row">
            <div class="col-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item mer_banner active">

                            <a href="{{ url('national-sports-day-2025') }}">
                                <img src="{{ asset('resources/imgs/national-sports-day-2025.png') }}" class="d-block w-100" alt="National Sports Day 2025" title="National Sports Day 2025">
                            </a>
                        </div>
                    </div>
                        <a href="{{ url('national-sports-day-2025') }}">
                            <img src="{{ asset('resources/imgs/national-sports-day-2025.jpeg') }}" class="d-block w-100" alt="National Sports Day 2025" title="National Sports Day 2025">
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
                                    @csrf
                                    <div class="text-center">
                                        <input type="hidden" name="banner_type" value="week_1">
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid over-hide">
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
                {{-- <img src="images/Mask Group 210.svg" class="img-fluid " alt=""> --}}
                <img src="{{ asset('resources/imgs/national-sports-day-2025/Mask Group 210.svg') }}" class="img-fluid " alt="">
            </div>
        </div>
        <div class="container">
            <div class="row py-5 button-section align-items-center">
                <div class="col-lg-6 col-md-12 col-12 my-2">
                    <img src="{{ asset('resources/imgs/national-sports-day-2025/Objects.svg') }}" alt="" class="img-fluid d-block mx-auto">
                </div>
                <div class="col-lg-6 col-md-12 col-12 my-2">
                    <h3>Be the part of the biggest ever sporting revolution!!</h3>
                    <h2 class="mb-4">Har Gali Har Maidaan, Khele Saara Hindustan</h2>
                    {{-- <button class="buttons d-block mx-auto mb-2">Register & participate</button> --}}
                    <a class="buttons d-block mx-auto mb-2 text-center" href="register?role=bmF0aW9uYWwtc3BvcnRzLWRheS0yMDI1">
                        Register & participate
                    </a>
                    {{-- <button class="buttons d-block mx-auto mb-2">Take the pledge</button> --}}
                    <a class="buttons d-block mx-auto mb-2 text-center" href="{{ url('fit-india-pledge-2025') }}">
                        Take the pledge
                    </a>
                    {{-- <button class=" buttons d-block mx-auto mb-2">Upload Photos/Videos</button> --}}
                    <a class="buttons d-block mx-auto mb-2 text-center" href="{{ url('nsd-upload-image') }}">
                        Upload Photos/Videos
                    </a>
                </div>
            </div>

            <a class="freedombtn1" href="register?role=bmF0aW9uYWwtc3BvcnRzLWRheS0yMDI1">Register</a>
            <a class="freedombtn3" href="{{ url('resources/pdf/NSD-2025.pdf') }}" target="_blank">How To Register</a>
            <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;" href="{{ url('fit-india-pledge-2025') }}">Fit India Pledge</a>
            {{-- <a class="freedombtn3 freedombtn4" href="{{ url('national-sports-day-merchandise-creatives-2025') }}" data-target="#merchandisId" target="_blank">Merchandise/Creatives</a>
            <a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="{{ url('resources/pdf/SOP-NSD-2025.pdf') }}" data-target="#merchandisId" target="_blank">SOP</a>
            <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;" href="{{ url('fit-india-pledge-2025') }}">Fit India Pledge</a>
            <a class="freedombtn3 freedombtn4" style="background-color:#4267B2;" href="{{ url('past-glimpses-2025') }}" data-target="#merchandisId">Past Glimpses</a> --}}
        </div>
      <div class="row">
        <div class="col-sm-12">
          <h1 class="headingh1">National Sports Day 2025</h1>
          <h6><b><i>Har Gali Har Maidaan, Khele Saara Hindustan</i></b></h6>
            <p>
                <b>A People’s Movement Through Mass Celebrations | August 29–31, 2025</b>
            </p>
            <p>
                National Sports Day is celebrated annually on August 29 to commemorate the birth anniversary of Major Dhyan Chand, India’s greatest sporting legend. Known popularly as ‘The Wizard of Hockey,’ he is remembered for his many contributions to the Indian sport.
                Some of his key highlights of his career:
            </p>
            <ul>
                <li>Scored 570 goals in 185 international matches (as per his autobiography Goal)</li>
                <li>Known as “The Magician” of hockey for his unmatched ball control and goal-scoring ability</li>
                <li>Played a key role in India’s dominance in hockey, winning 7 out of 8 Olympic golds from 1928 to 1964</li>
            </ul>
            <p>
                This day was officially declared a national observance in 2012.
                In 2019, the Fit India Movement was launched on this day,
                marking it as a milestone in India's fitness and sports journey.
                This year the National Sports Day is planned as a pan-India movement to make India embrace sport by mobilising people across the country and
                across age-groups to actively participate in at least one sport.
                NSD 2025 makes a special tribute to the Olympic Spirit and integrate the three core values of Excellence,
                Friendship, and Respect in our sports eco-system.
            </p>
            <p>
                <b>
                    The tagline and theme for this year’s celebration - “Har Gali Har Maidaan, Khele Saara Hindustan”
                </b>
            </p>
            <p>
                <b>Highlights of Previous Celebrations:</b>
            </p>

            <ul>
                <li>
                    <b>NSD 2024:</b>
                    8,627 events organized | 2.5 million participants | Participation from ministries, armed forces, schools, RWAs, and youth organizations
                </li>
                <li>
                    <b>NSD 2023:</b>
                    14,294 events | 1.6 million participants | Emphasis on pan-India sports challenges
                </li>
                <li>
                    <b>NSD 2022:</b>
                    <i>Meet the Champion</i> school outreach | Athlete interactions | Fitness stories from Olympians and Paralympians
                </li>
            </ul>
            <p><b>Structure of NSD 2025 Celebration:</b></p>
            <p><b>August 29 | Tribute Day</b></p>
            <ul>
                <li>
                    <i>Major Dhyan Chand Tribute by HMYAS</i>
                </li>
                <li>
                    <i>Sports Assembly & NSD Pledge in schools, colleges, offices</i>
                </li>
                <li>
                    <i>One-Hour Sports Activity across all participating institutions</i>
                </li>
            </ul>
            <p><b>August 30 | Celebration Day</b></p>
            <ul>
                <li>
                    <i>NSD Conclave in New Delhi</i>
                </li>
                <li>
                    <i>Sports competitions, debates, fitness activities in institutions nationwide</i>
                </li>
                <li>
                    <i>One-Hour Sports Activity across all participating institutions</i>
                </li>
            </ul>
            <p><b>August 31 | Movement Day</b></p>
            <ul>
                <li>
                    <i>Sundays on Cycle – </i>community cycling across India
                </li>
                <li>
                    <i>Sansad Khel Mahakumbh – </i>local sports fests organized in each parliamentary constituency
                </li>
                <li>
                    <i>Launch of Carbon Credit Incentivisation </i>through the <b>Fit India App</b>
                </li>
            </ul>
            <p><b>Proposed Activities Across India</b></p>
            <table>
                <tr>
                    <th><center> Category</center></th>
                    <th><center>Sample Activities</center></th>
                </tr>
                <tr>
                    <td><b>Sporting Events</b></td>
                    <td>Competitive and fun games at workplaces, schools, colleges, and RWAs</td>
                </tr>
                <tr>
                    <td><b>Mohalla Outreach</b></td>
                    <td>Sports and fitness games in urban neighborhoods and rural communities</td>
                </tr>
                <tr>
                    <td><b>Stadium Events</b></td>
                    <td>Hosted by SAI, NSFs, and State Sports Departments</td>
                </tr>
                <tr>
                    <td><b>University & School Campaigns</b></td>
                    <td>Sports Assembly and other events coordinated via DoHE, DoSEL, UGC, CBSE, KVS, JNV, State Boards</td>
                </tr>
                <tr>
                    <td><b>Fit India Conclave</b></td>
                    <td>Sessions with sports icons and role models in New Delhi</td>
                </tr>
                <tr>
                    <td><b>Fitness & Sports Quiz</b></td>
                    <td>National-level quiz hosted on <b>MyGov</b> platform</td>
                </tr>
                <tr>
                    <td><b>Healthy Eating Campaign</b></td>
                    <td>Partnership with <b>Ministry of Health and Family Welfare</b></td>
                </tr>
                <tr>
                    <td><b>Cultural Engagement</b></td>
                    <td>Team names inspired by freedom fighters or sports legends; use of local/traditional games encouraged</b></td>
                </tr>
                <tr>
                    <td><b>NSD 2025 Pledge</b></td>
                    <td>A pledge to play sports, aligned with Olympic values</b></td>
                </tr>
            </table>

            <p><b>Participation Format</b></p>
            <ul>
                <li>Organizations may form <b>2, 4, or 6 teams,</b> ensuring <b>gender balance.</b></li>
                <li>Games can be selected based on <b>local popularity and available infrastructure.</b></li>
                <li><b>Team names </b>encouraged to reflect Indian sports legends or freedom fighters.</li>
            </ul>
            <p><b>Age-Wise Activities Suggestions</b></p>
            <table>
                <tr>
                    <th><center>Open Category</center></th>
                    <th><center>Senior Citizens</center></th>
                </tr>
                <tr>
                    <td>Tug of war, frisbee, spoon race, sack race</td>
                    <td>300m Speed Walk</td>
                </tr>
                <tr>
                    <td>Target-oriented games like archery, dart games, stone throw, coconut bowling (South India), and others</td>
                    <td>Tennis / badminton,/ TT and any other racquet games </td>
                </tr>
                <tr>
                    <td>Race – 50/100/200 m, hurdles, relay runs, marathons, throw events, & jumps</td>
                    <td>1 Km Walk</td>
                </tr>
                <tr>
                    <td>Yog</td>
                    <td>Yog</td>
                </tr>
                <tr>
                    <td>Cricket</td>
                    <td>Breathing Exercises</td>
                </tr>
                <tr>
                    <td>Cycling</td>
                    <td>Joint Movements</td>
                </tr>
                <tr>
                    <td>Indigenous sports like pitthu, lagodhi or other Indian games played regionally at the grassroots level</td>
                    <td>Chess</td>
                </tr>
                <tr>
                    <td>Kho Kho</td>
                    <td>Stretching challenge</td>
                </tr>
                <tr>
                    <td>Kabaddi</td>
                    <td>Cycling</td>
                </tr>
                <tr>
                    <td>Volleyball</td>
                    <td>Any other</td>
                </tr>
                <tr>
                    <td>Basketball</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Tennis / badminton,/ TT and any other racquet games </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Rope-skipping</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Olympic value education program</td>
                    <td></td>
                </tr>
            </table>
            <p>
                All organizers are request to register their event on this Fit India portal (<a href="https://fitindia.gov.in">https://fitindia.gov.in</a>) and upload details of participation, pictures & videos of the event.
            </p>
            {{-- <p>
              <ul>
                <li>Each organization to be divided into two, four or six teams depending on the number of participations maintaining gender equality.</li>
                <li>Medal tally for each team to be maintained. Highest points team will win Major Dhyan Chand Trophy.</li>
                <li>Organizations are at liberty to choose games for competition from any popular sports of the locality and availability of Infrastructure.</li>
                <li>Name of teams can be based on freedom fighters or prominent sportspersons of the country.</li>
              </ul>
            </p>
            <p>The list of suggested competitive and fun games is-</p>
            <table>
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
            </table>
            <p>
              <strong><i>*Office will be at liberty to choose games for competition from any popular sports of the locality and availability of Infrastructure.</i></strong>
            </p>
            <p><strong>FIT India Fitness Pledge: </strong>In addition, all the organizations may organize a FIT India Fitness pledge event where all key stakeholders including their employees may take the
              FIT India Fitness pledge.</p>
            <p><strong>A dedicated portal for registering the events on this occasion </strong>developed through the Fit India Mission, accessible from its website and Fit India Mobile App.</p>
            <p>Organizers to register their event on Fit India portal (<a href="https://fitindia.gov.in">https://fitindia.gov.in</a>) or Fit India Mobile App and upload details of participation, pictures &amp; videos of the event.</p> --}}
        {{-- <br/>
        <p>For more details kindly visit the following link:
        <br/>
        <a href="https://drive.google.com/drive/folders/1thgTxydnX0VfIjaLrS2DmaEle2LHHh_e?usp=sharing" target="_blank">https://drive.google.com/drive/folders/1thgTxydnX0VfIjaLrS2DmaEle2LHHh_e?usp=sharing</a></p> --}}
>>>>>>> b0087c0e714b44eec06745a61923daf6e0300b38
        </div>
    </div>
    <div class="nsd-btns">
        <div class="container">
            <div class="row justify-content-center py-5">
                <div class="col-12 mb-5">
                    <h1>Steps to register, participate, upload images/videos and get participation certificate</h1>
                    <h4>Step-by-Step Instructions to Participate and Receive Your Certificate</h4>
                </div>
                <div class="col-lg-3 col-md-4 col-10 my-3">
                    <h5>01</h5>
                    {{-- <div class="d-flex flex-column align-items-center"> --}}
                    <a class="d-flex flex-column align-items-center" style="color:#000000;" href="{{ url('resources/pdf/NSD 2025_How_To_Register-2.pdf') }}"  target="_blank">
                        <div class="btn">
                            {{-- <img src="images/Group 48005.svg" alt=""> --}}
                            <img src="{{ asset('resources/imgs/national-sports-day-2025/Group 48005.svg') }}" alt="">
                        </div>
                        <h6 class="text-center">How to register</h6>
                    </a>
                    {{-- </div> --}}
                </div>

                <div class="col-lg-3 col-md-4 col-10 my-3">
                    <h5>02</h5>
                    <a class="d-flex flex-column align-items-center" style="color:#000000;" href="{{ url('resources/pdf/SOP-NSD-2025.pdf') }}" target="_blank">
                        <div class="btn">
                            {{-- <img src="images/Group 48007.svg" alt=""> --}}
                            <img src="{{ asset('resources/imgs/national-sports-day-2025/Group 48007.svg') }}" alt="">
                        </div>
                        <h6  class="text-center">SOP for celebrating National Sports Day 2025</a></h6>

                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-10 my-3">
                    <h5>03</h5>
                    <a class="d-flex flex-column align-items-center" style="color:#000000;" href="{{ url('resources/pdf/SOP-NSD-2025.pdf') }}" target="_blank">
                        <div class="btn">
                            {{-- <img src="images/Group 48083.svg" alt=""> --}}
                            <img src="{{ asset('resources/imgs/national-sports-day-2025/Group 48083.svg') }}" alt="">
                        </div>
                        <h6  class="text-center">
                            Guidelines on Image/Video
                        </h6>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-10 my-3">
                    <h5>04</h5>
                    <a class="d-flex flex-column align-items-center" style="color:#000000;" href="{{ url('resources/pdf/SOP-NSD-2025.pdf') }}" target="_blank">
                        <div class="btn">
                            {{-- <img src="images/Group 48084.svg" alt=""> --}}
                            <img src="{{ asset('resources/imgs/national-sports-day-2025/Group 48084.svg') }}" alt="">
                        </div>
                        <h6  class="text-center">
                            Rules & Guidelines for participation Certificate
                        </h6>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid nsd">
        <div class="container">
            <div class="row py-5  align-items-center">
                <div class="col-lg-6 col-md-12 col-12 my-2">
                    {{-- <img src="images/18779079_Na__August_15.svg" alt="" class="img-fluid d-block mx-auto"> --}}
                    <img src="{{ asset('resources/imgs/national-sports-day-2025/18779079_Na__August_15.svg') }}" alt="" class="img-fluid d-block mx-auto">
                </div>
                <div class="col-lg-6 col-md-12 col-12 my-2">
                    <h2>National Sports Day 2025</h2>
                    <h3>Har Gali Har Maidaan, Khele Saara Hindustan</h3>
                    <p class="my-4">
                        National Sports Day is celebrated annually on August 29 to commemorate the birth anniversary of Major Dhyan Chand, India's greatest sporting legend – <i><b>The Wizard of Hockey</b></i>.
                    </p>
                    <h4 class="mb-4">Scored 570 goals in 185 international matches <i>(as per his autobiography “Goal”)</i></h4>
                    <h4 class="mb-4">Known for unmatched ball control and goal-scoring ability</h4>
                    <h4 class="mb-4">Instrumental in India’s hockey dominance – winning 7 of 8 Olympic golds from 1928–1964</h4>
                    <p class="my-4">
                        This day was declared a national observance in 2012. In 2019, the Fit India Movement was launched on this day, marking a milestone in India’s fitness and sports journey.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
                {{-- <img src="images/Mask Group 212.svg" class="img-fluid" alt=""> --}}
                <img src="{{ asset('resources/imgs/national-sports-day-2025/Mask Group 212.svg') }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
    <div class="whats-new pt-5">
        <div class="container pt-5">
            <div class="row justify-content-between">
                <div class="col-lg-7 col-md-12 col-12 border-end order-lg-0 order-md-1 order-1 ">
                    <h1 class="mb-3 pl-lg-0 pl-md-3 pl-3 mt-lg-0 mt-md-3 mt-3">Structure of NSD 2025 Celebration</h1>
                    <div class="row px-3 py-4 my-row rounded-5 mb-2 ">
                    <div class="col-lg-4 col-md-12 d-flex align-items-start justify-content-center flex-column ">
                        <h5>AUGUST 29</h5>
                        <h6>Tribute Day</h6>
                    </div>
                    <div class="col-lg-8 col-12 border-start d-flex align-items-start justify-content-center flex-column">
                        <ul class="mb-0">
                            <li>Morning tribute to Major Dhyan Chand in schools, colleges, offices</li>
                            <li>Fit India Pledge</li>
                            <li>60 minutes of team sports & recreational games</li>
                            <li>Launch of Sansad Khel Mahotsav by MPs in constituencies</li>
                        </ul>
                    </div>
                    </div>
                    <div class="row px-3 py-4 my-row rounded-5 mb-2 ">
                    <div class="col-lg-4 col-md-12 d-flex align-items-start justify-content-center flex-column ">
                        <h5>AUGUST 30 </h5>
                        <h6>Celebration Day</h6>
                    </div>
                    <div class="col-lg-8 col-md-12 border-start d-flex align-items-start justify-content-center flex-column">
                        <ul class="mb-0">
                            <li>School/college-level sports debates & fitness talks</li>
                            <li>Competitions in indigenous & indoor sports</li>
                            <li>State/regional conclaves, conferences, and debates</li>
                        </ul>
                    </div>
                    </div>
                    <div class="row px-3 py-4 my-row rounded-5 mb-2 ">
                    <div class="col-lg-4 col-md-12 d-flex align-items-start justify-content-center flex-column ">
                        <h5>AUGUST 31 </h5>
                        <h6>Movement Day</h6>
                    </div>
                    <div class="col-lg-8 col-md-12 border-start d-flex align-items-start justify-content-center flex-column">
                        <ul class="mb-0">
                            <li><i>Sundays on Cycle</i> – community cycling events across India</li>
                        </ul>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12 d-flex flex-column justify-content-center bs order-lg-1 order-md-0 order-0">
                    <h3 class="m-0 pl-3">What's </h3>
                    <h3 class="m-0 pl-3"><b>New</b></h3>
                    <p class="m-0 pl-3">Har Gali Har Maidaan,</p>
                    <p class="m-0 pl-3">Khele Saara Hindustan</p>
                    <br>
                    <p class="pl-3" style="text-align:justify;">In 2025, NSD will be a pan-India movement encouraging every citizen to play at least one sport, embracing Olympic & Paralympic values :
                        <br>
                        <br>
                         <b>• Excellence • Determination
                          <br>
                            • Respect • Friendship</b>
                         <br>
                         <b> • Inspiration • Equality</b>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="highlights ">
        <div class="container-fluid">
            <div class="row justify-content-end">
                {{-- <img src="images/Mask Group 210.svg" class="img-fluid" alt=""> --}}
                <img src="{{ asset('resources/imgs/national-sports-day-2025/Mask Group 210.svg') }}" class="img-fluid" alt="">
            </div>
        </div>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 my-2">
                    <h3>Highlights of Previous Celebrations</h3>
                    <h4>Har Gali Har Maidaan, Khele Saara Hindustan</h4>
                </div>
                <div class="col-lg-6 col-md-12 col-12 my-2">
                    <nav class="bg-transparent">
                    <div class="nav nav-tabs justify-content-end border-0" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active border-0" id="nav-home-tab-new" data-toggle="tab" href="#nav-home-new" role="tab" aria-controls="nav-home-new" aria-selected="true">2022</a>
                        <a class="nav-item nav-link" id="nav-profile-tab-new" data-toggle="tab" href="#nav-profile-new" role="tab" aria-controls="nav-profile-new" aria-selected="false">2023</a>
                        <a class="nav-item nav-link" id="nav-year-tab-new" data-toggle="tab" href="#nav-year-new" role="tab" aria-controls="nav-year-new" aria-selected="false">2024</a>
                    </div>
                    </nav>
                </div>
            </div>
            <div class="row mt-5 ">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane  fade show active" id="nav-home-new" role="tabpanel" aria-labelledby="nav-home-tab-new">
                    <div class="container-fluid">
                        <div class="row h-left">
                            <div class="col-lg-6 col-md-12 col-12 my-2 d-flex flex-wrap justify-content-between">
                                {{-- <img src="images/highlights/Mask Group 207.png" class=" mb-3" alt=""> --}}
                                <img src="{{ asset('resources/imgs/national-sports-day-2025/highlights/Mask Group 207.png') }}" class=" mb-3" alt="">
                                {{-- <img src="images/highlights/Mask Group 205.png" class=" mb-3" alt=""> --}}
                                <img src="{{ asset('resources/imgs/national-sports-day-2025/highlights/Mask Group 205.png') }}" class=" mb-3" alt="">
                                {{-- <img src="images/highlights/Mask Group 208.png" class=" mb-3" alt=""> --}}
                                <img src="{{ asset('resources/imgs/national-sports-day-2025/highlights/Mask Group 208.png') }}" class=" mb-3" alt="">
                                {{-- <img src="images/highlights/Mask Group 206.png" class="mb-3" alt=""> --}}
                                <img src="{{ asset('resources/imgs/national-sports-day-2025/highlights/Mask Group 206.png') }}" class=" mb-3" alt="">
                            </div>
                            <div class="col-lg-6 col-md-12 col-12 my-2 h-right ">
                                {{-- <img src="images/highlights/Mask Group 204.png" class="img-fluid" alt=""> --}}
                                <img src="{{ asset('resources/imgs/national-sports-day-2025/highlights/Mask Group 204.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile-new" role="tabpanel" aria-labelledby="nav-profile-tab-new">
                    <div class="container-fluid">
                        <div class="row h-left">
                            <div class="col-lg-6 col-md-12 col-12 my-2 d-flex flex-wrap justify-content-between">
                                {{-- <img src="images/highlights/Mask Group 207.png" class=" mb-3" alt=""> --}}
                                <img src="{{ asset('resources/imgs/national-sports-day-2025/highlights/Mask Group 207.png') }}" class=" mb-3" alt="">
                                {{-- <img src="images/highlights/Mask Group 205.png" class=" mb-3" alt=""> --}}
                                <img src="{{ asset('resources/imgs/national-sports-day-2025/highlights/Mask Group 205.png') }}" class=" mb-3" alt="">
                                {{-- <img src="images/highlights/Mask Group 208.png" class=" mb-3" alt=""> --}}
                                <img src="{{ asset('resources/imgs/national-sports-day-2025/highlights/Mask Group 208.png') }}" class=" mb-3" alt="">
                                {{-- <img src="images/highlights/Mask Group 206.png" class="mb-3" alt=""> --}}
                                <img src="{{ asset('resources/imgs/national-sports-day-2025/highlights/Mask Group 206.png') }}" class=" mb-3" alt="">
                            </div>
                            <div class="col-lg-6 col-md-12 col-12 my-2 h-right ">
                                {{-- <img src="images/highlights/Mask Group 204.png" class="img-fluid" alt=""> --}}
                                <img src="{{ asset('resources/imgs/national-sports-day-2025/highlights/Mask Group 204.png') }}" class=" mb-3" alt="">
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="nav-year-new" role="tabpanel" aria-labelledby="nav-year-tab-new">
                    <div class="container-fluid">
                        <div class="row h-left">
                            <div class="col-lg-6 col-md-12 col-12 my-2 d-flex flex-wrap justify-content-between">
                                {{-- <img src="images/highlights/Mask Group 207.png" class=" mb-3" alt=""> --}}
                                <img src="{{ asset('resources/imgs/national-sports-day-2025/highlights/Mask Group 207.png') }}" class=" mb-3" alt="">
                                {{-- <img src="images/highlights/Mask Group 205.png" class=" mb-3" alt=""> --}}
                                <img src="{{ asset('resources/imgs/national-sports-day-2025/highlights/Mask Group 205.png') }}" class=" mb-3" alt="">
                                {{-- <img src="images/highlights/Mask Group 208.png" class=" mb-3" alt=""> --}}
                                <img src="{{ asset('resources/imgs/national-sports-day-2025/highlights/Mask Group 208.png') }}" class=" mb-3" alt="">
                                {{-- <img src="images/highlights/Mask Group 206.png" class="mb-3" alt=""> --}}
                                <img src="{{ asset('resources/imgs/national-sports-day-2025/highlights/Mask Group 206.png') }}" class=" mb-3" alt="">
                            </div>
                            <div class="col-lg-6 col-md-12 col-12 my-2 h-right ">
                                {{-- <img src="images/highlights/Mask Group 204.png" class="img-fluid" alt=""> --}}
                                <img src="{{ asset('resources/imgs/national-sports-day-2025/highlights/Mask Group 204.png') }}" class=" mb-3" alt="">
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <img src="images/Mask Group 214.svg" class="img-fluid" alt="">
            </div>
        </div>
    </div>
    <div class=" p-format">
        <div class="container-fluid">
            <div class="container">
                <div class=" row  justify-content-center py-5">
                    <div class="col-12 mb-5">
                    <h1>Participation Format</h1>
                    <h4>Awareness Programs and Seminars on Sports</h4>
                    </div>
                    <div class="col-lg-4 col-md-10 col-10 my-3 one">
                    <h5></h5>
                    <div class="d-flex flex-column align-items-center ">
                        <div class="btn">
                            <h6 class="text-left px-3">Organizations may form <b>2, 4, or 6 teams, ensuring gender balance.</b></h6>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-4 col-md-10 col-10 my-3 two">
                    <h5></h5>
                    <div  class="d-flex flex-column align-items-center ">
                        <div class="btn">
                            <h6  class="text-left px-3">Games can be selected based on <b>local popularity and available infrastructure.</b></h6>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-4 col-md-10 col-10 my-3 three">
                    <h5></h5>
                    <div  class="d-flex flex-column align-items-center ">
                        <div class="btn">
                            <h6  class="text-left px-3"><b>Team names</b> encouraged to reflect Indian sports legends or freedom fighters.</h6>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    {{-- <img src="images/Mask Group 212.svg" class="img-fluid " alt=""> --}}
                    <img src="{{ asset('resources/imgs/national-sports-day-2025/Mask Group 212.svg') }}" class=" mb-3" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="  age-wise py-3">
        <div class="container-fluid">
            <div class="container">
                <div class=" row  justify-content-center pt-5">
                    <div class="col-12 mb-5">
                    <h1>Age-Wise Activities Suggestions</h1>
                    <h4>Awareness Programs and Seminars on Sports</h4>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <nav class="bg-white  rounded shadow px-3 py-1">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active border-0" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Open Category</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Senior Citizens    </a>
                    </div>
                    </nav>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="table-responsive w-100">
                                <table class="table w-100" >
                                <tbody>
                                    <tr>
                                        <td>Tug of war</td>
                                        <td>50m/100m/200m races</td>
                                        {{-- <td>Kho Kho</td> --}}
                                    </tr>
                                    <tr>
                                        <td>Relay run</td>
                                        <td>Marathons</td>
                                        {{-- <td>Kabaddi</td> --}}
                                    </tr>
                                    <tr>
                                        <td>Spoon race</td>
                                        <td>Sack race</td>
                                        {{-- <td>Volleyball</td> --}}
                                    </tr>
                                    <tr>
                                        <td>Cycling</td>
                                        <td>Cricket</td>
                                        {{-- <td>Basketball</td> --}}
                                    </tr>
                                    <tr>
                                        <td>Volleyball</td>
                                        <td>Rope skipping</td>
                                        {{-- <td>Tennis / badminton,/ TT and any other racquet games</td> --}}
                                    </tr>
                                    <tr>
                                        <td>Kho Kho</td>
                                        <td>Kabaddi</td>
                                        {{-- <td>Rope-skipping</td> --}}
                                    </tr>
                                    <tr>
                                        <td>Indigenous games (pitthu, lagodhi)</td>
                                        <td>Chess</td>
                                        {{-- <td>Olympic value education program</td> --}}
                                    </tr>
                                    <tr>
                                        <td>Table tennis</td>
                                        <td>Badminton</td>
                                        {{-- <td>Olympic value education program</td> --}}
                                    </tr>
                                    <tr>
                                        <td>Yog sessions</td>
                                        <td>Any other</td>
                                        {{-- <td>Olympic value education program</td> --}}
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                            <p><i style="color: #000000;">* The above list is only suggestive. The organizations may choose their own sport as feasible. Participating schools are encouraged to take the Fitness Assessment Tests of students on the Fit India Mobile App every quarter.</i></p>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="table-responsive w-100">
                                <table class="table w-100" >
                                    <tbody>
                                        <tr>
                                            <td>300m speed walk,</td>
                                            <td>1 km walk</td>
                                        </tr>
                                        <tr>
                                            <td>Breathing exercises</td>
                                            <td>Joint movements</td>
                                        </tr>
                                        <tr>
                                            <td>Light indigenous games</td>
                                            <td>Stretching challenges</td>
                                        </tr>
                                        <tr>
                                            <td>Yog</td>
                                            <td>Chess</td>
                                        </tr>
                                        <tr>
                                            <td>Cycling</td>
                                            <td>Any other</td>
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
    <div class="activities py-5">
        <div class="container">
            <h2 class="text-center mb-5">Proposed Activities Across India</h2>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12 mb-3">
                    <div class="w-100 px-4 py-4 bg-white rounded border">
                    <h4 class="m-0 mb-2">Sporting Events</h4>
                    <p class="m-0">Fun & competitive games in workplaces, schools, colleges, RWAs</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 mb-3">
                    <div class="w-100 px-4 py-4 bg-white rounded border">
                    <h4 class="m-0 mb-2">Mohalla Outreach</h4>
                    <p class="m-0">Sports & fitness games in neighbourhoods and rural areas</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 mb-3">
                    <div class="w-100 px-4 py-4 bg-white rounded border">
                    <h4 class="m-0 mb-2">Stadium Events</h4>
                    <p class="m-0">Hosted by SAI, NSFs, State Sports Depts</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 mb-3">
                    <div class="w-100 px-4 py-4 bg-white rounded border">
                    <h4 class="m-0 mb-2">University & School Campaigns</h4>
                    <p class="m-0">Sports Assembly, indigenous games, fitness activities</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 mb-3">
                    <div class="w-100 px-4 py-4 bg-white rounded border">
                    <h4 class="m-0 mb-2">Fit India Conclave</h4>
                    <p class="m-0">Sessions with sports icons & role models</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 mb-3">
                    <div class="w-100 px-4 py-4 bg-white rounded border">
                    <h4 class="m-0 mb-2">Fitness & Sports Quiz</h4>
                    <p class="m-0">National quiz on MyGov</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 mb-3">
                    <div class="w-100 px-4 py-4 bg-white rounded border">
                    <h4 class="m-0 mb-2">Cultural Engagement</h4>
                    <p class="m-0">Team names inspired by freedom fighters/sports legends</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 mb-3">
                    <div class="w-100 px-4 py-4 bg-white rounded border">
                    <h4 class="m-0 mb-2">Healthy Living</h4>
                    <p class="m-0">Awareness drives with MoHFW</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        //$(".collapse")

        if ($(".collapse").hasClass('show')) {

        } else if ($(".collapse").hasClass('')) {
        $(".card-head").removeClass("showActive");

        }
    })
    </script>

@endsection
