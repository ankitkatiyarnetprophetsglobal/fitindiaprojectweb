@extends('layouts.app')
@section('title', 'Fit-india-freedomrun | Fit India')
@section('content')
@php
$active_section = request()->segment(count(request()->segments()));
$active_section_id = trim($active_section);
@endphp
<style>
    .f_container {
        margin-top: 70px;
        padding-left: 9%;
        padding-right: 7%;
        padding-top: 3%;
        padding-bottom: 5%;
        background: #f6f6f6;
    }

    .rm-r {
        margin-right: 0;
    }

    .amb-dv p.amb-name {
        font-size: 11px !important;
    }

    .amb-dv .amb-details p {
        font-size: 11px !important;
    }

    /* .amb-details p {
    margin-bottom: 2px!important;
} */
    .amb-details p {
        margin-bottom: 0px !important;
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

    .d_bg_g {
        border-top: 3px solid green;
		
        width: 70px;
    }

    .d_bg_r {
        border-top: 3px solid red;
        width: 70px;
    }

    .d_f_div {
        margin-bottom: 0px !important;
        font-size: 1rem !important;
    }

    .m_f_div {
        font-size: 10px !important;
        margin-bottom: 0 !important;
    }

    .part_event {
        margin-bottom: 40px;
    }

    .part_event {

        margin-left: 0px;
    }

    .blue_btn {
        color: #fff !important;
        border-color: #fff;
        border-radius: 4px;
        font-size: 16px;
        font-weight: 500;
        padding: 12px 12px;
        text-decoration: none;
        background-color: #4267b2;
        margin-top: 40px
    }

    .event-form input[type=submit] {
        background-color: rgb(233, 30, 99);
        padding: 6px 30px;
    }

    .p_evt_list {
        margin-top: 68px;
    }

    .wrap {
        padding: 15px;
    }

    .clic_btn {
        width: 33%;
        margin: 0 auto;
        margin-top: 5px;
    }

    .d_button {
        width: auto;
        margin: 0 auto;

        padding: 5px 15px;
        border-radius: 100px;

    }

    .herfparent a {
        color: #000;
    }

    .mobileview {
        display: none;
    }

    .webview {
        display: block;

    }

    /* .amb-dv .amb-colm {
    width: 100%!important;
}
.amb-dv .amb-colm {
    height: 120px!important;
}
.amb-dv .amb-colm .amb-pic {
   
    height: 120px;
}
.amb-dv .amb-details {
    float: left;
    width: 70%!important;
    padding-top: 1%!important;
}
.amb-dv .amb-colm .amb-pic {
    float: left;
    width: 29%;
}
.amb-dv .amb-colm .amb-pic img {
    object-fit: cover;
    height: 100%;
    object-position: 0;
    width: 100%;
} */

    .amb-dv .amb-details {
        float: none;
        width: auto !important;
        padding-top: 0% !important;
    }

    .filed_name {
        font-size: 11px !important;
        margin-bottom: 0px !important;
        color: #777;
    }

    .amb-dv .amb-details {

        width: 60%;
    }

    .ac_btn_partner {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
    }

    .ac_btn_partner input {
        margin-top: 0 !important;
        display: inline-block;
        width: auto !important;
    }

    .under_line {
        width: 31%;
        height: 2px;
        background: #ff5f04;
        margin-bottom: 50px;
        /* margin: 0 auto; */
        margin-bottom: 50px;
        margin-top: -6px;
        margin-left: 15.5%;

    }

    .under_line_1 {
        width: 13%;
        height: 2px;
        background: #ff5f04;
        margin-bottom: 50px;
        /* margin: 0 auto; */
        margin-bottom: 50px;
        margin-top: -14px;
        margin-left: 11.2%;

    }

    .p_evt_list {
        margin-top: 50px;
    }

    .part_event {
        position: relative;
        margin-left: 0;
    }

    .part_event::after {
        content: '';
        position: absolute;
        width: 200px;
        height: 2px;
        background: #ff5f04;
        margin-bottom: 50px;
        /* margin: 0 auto; */
        /* margin-bottom: 50px; */
        /* margin-top: -14px; */
        left: 0%;
        display: block;

    }

    .cer_forma_div {
        margin-top: 10px !important;
    }

    /* .f_container {
    margin-top: 70px;
    padding-left: 3%;
    padding-right: 5%;
    padding-top: 3%;
    padding-bottom: 5%;
    background: #f6f6f6;
} */

    .head_free_run {
        color: #4267b2;
        display: relative;
        margin-bottom: 40px;

    }

    .head_free_run::after {
        content: '';
        width: 30%;
        height: 2px;
        background: #ff5f04;
        margin-bottom: 50px;
        position: absolute;
        /* margin: 0 auto; */
        margin-bottom: 50px;
        margin-top: 0px;
        margin-left: 15%;
        display: block;
    }

    .card_partner_inner h6 {
        font-size: 12px;
        line-height: 1.4;
        letter-spacing: .7px;
    }

    @media (max-width: 767px) {
        .lastdate {
            font-size: 24px !important;
            margin-bottom: 15px !important;
        }

        .p_evt_list {
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .og_btn {
            margin-top: 20px;
            display: inline-block;
        }

        .d-flex {
            flex-direction: row;
        }
    }

    @media (max-width: 480px) {
        .lastdate {
            font-size: 20px !important;
            margin-bottom: 10px !important;
        }

        .part_event {
            position: relative;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .f_container {

            padding-left: 5%;
            padding-right: 5%;
        }

        .og_btn {
            border-width: 2px;
            border-color: #ff8000;
            border-radius: 4px;
            letter-spacing: 0;
            font-size: 14px;
            width: 100%;
            text-align: center;

        }

        .head_free_run {

            margin-bottom: 0px;
        }

        .head_free_run::after {
            content: '';
            width: 42%;
            height: 2px;
            background: #ff5f04;
            margin-bottom: 50px;
            position: absolute;
            /* margin: 0 auto; */
            margin-bottom: 50px;
            margin-top: 0px;
            margin-left: 21%;
            display: block;
        }

        h1 {
            font-size: 23px;
        }

        .part_event::after {
            content: '';
            position: absolute;
            width: 34%;
            height: 2px;
            background: #ff5f04;
            margin-bottom: 50px;
            /* margin: 0 auto; */
            /* margin-bottom: 50px; */
            /* margin-top: -14px; */
            margin-left: 27.2%;
            display: block;
        }
    }

    .amb-dv .amb-colm {
        width: 100%;
        height: 110px;
        display: flex;
        align-items: center;
    }

    .amb-details {
        padding: 5px 10px 0px 10px !important;
    }

    .amb-dv .amb-colm .amb-pic {
        float: none;
        width: 120px;
        height: 120px;
        /* overflow: hidden; */
    }

    .amb-dv .amb-colm .amb-pic img {
        object-fit: cover;
        height: 100%;
        object-position: 10% 10% !important;
        width: 100%;
    }

    .amb-dv .amb-details {
        float: none;
        width: auto !important;
        padding-top: 1.5% !important;
    }

    .filed_name {
        margin-bottom: 0 !important;
    }

    @media (max-width: 340px) {
        .ac_btn_partner {
            flex-direction: column;
        }

        .ac_btn_partner input {
            margin-bottom: 15px;
        }
    }

    @media (max-width: 767px) {

        .mobileview {
            display: block;
        }

        .webview {
            display: none;

        }

        .row_reverse {
            display: flex;
            flex-flow: column-reverse;
        }

        .col-md-4 {
            width: 100%;
        }

        .cer_forma_div {
            margin-bottom: 22px !important;
        }

        .head_free_run::after {
            width: 48%;
            margin-top: 4px;
            margin-left: 24%;

        }

        .m-40 {
            margin-bottom: 20px;
        }

        .mb-5 {
            margin-bottom: 1rem !important;
        }

        .mt-5,
        .my-5 {
            margin-top: 1rem !important;
        }

        .f_container {
            margin-top: 40px;
        }

        .head_free_run {
            margin-bottom: 15px;
            margin-top: 25px;
        }

        .p_evt_list {
            margin-bottom: 0;
        }
    }

    .card_partner {
        position: relative;
        border: 1px solid #e2e2e2;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        margin-bottom: 30px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;


    }

    .card_partner_img {
        position: relative;
    }

    /* .card_partner_img{height: 174px;} */


    .card_partner_img img {
        /* max-height: 200px; */
        /* border-top-left-radius: 10px;
    border-top-right-radius: 10px; */

        /* padding: 10px; */
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
        width: 100%;
        object-fit: cover;
        height: 135px;
        object-fit: contain;
        background: #000;


    }

    .card_partner_event {
        border-radius: 100px;
        padding: 7px 10px;
        border: 1px solid #a1a1a1;
        position: absolute;
        /* top: 133px; */
        background: #f3f3f3;
        width: 94%;
        margin: 0 auto;
        left: 3%;
        bottom: -18px;
        text-align: center;
    }

    .card_partner_event h6 {
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 1px;
        margin-bottom: 0;
        text-transform: capitalize;
    }

    .card_partner_inner {
        /* height:150px; */
        padding: 28px 10px 5px 10px;
        background: #fff;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;

    }

    .card_partner_inner h6 span {
        color: #4267b2;
        /* font-weight: 600; */
        /* letter-spacing: .5px; */
    }

    .lastdate {
        color: #ff6100;
        font-size: 28px;
        padding: 10px;
        width: 100%;
        background: #f9f9f93b;
        box-shadow: 0 .1rem .5rem rgba(0, 0, 0, .15);
        margin-bottom: 50px;
    }
</style>

<script>
    $(document).ready(function() {
        var sess_val = "<?= session('success'); ?>";
        if (sess_val != "") {
            $('html, body').animate({
                scrollTop: $("#success_msg_div").offset().top
            }, 2000);
        }
    });
    /* function reloadFreedomInfo(){
         setTimeout(
       function() 
       {
        reload();
       }, 5000);

     }*/
</script>



<div>
   <!-- <img src="resources/imgs/freedomrun-3.jpeg" alt="freedom-run-info" title="freedom-run-info" class="img-fluid expand_img" /> -->
	<img src="resources/imgs/freedomrunupdate4.jpg" alt="freedom-run-info" title="freedom-run-info" class="img-fluid expand_img" />
</div>
<section id="{{ $active_section_id }}" style="padding-bottom:0;">
    <div class="container mb-5">
	<!--
        <div lass="row ">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h1 class="text-center lastdate"><b>Last date to submit data for Freedom Run : 8th October</h1>
            </div>
        </div>
		-->
        <div class="row row_reverse">

            <div class="col-sm-12 col-md-8 col-lg-8">

                <div class="webview">

                    <h1 class="head_free_run">Fit India Swachhata Freedom Run 4.0</h1>
                    <!-- <div class="under_line"></div> -->
                    <div class="ahover">
                        <a href="register" class="og_btn" target="_blank">Register as an Organizer</a>
                        <a href="resources/pdf/SOP-Freedom-Run-4.0.pdf" class="og_btn" target="_blank" style="background-color:#45a164; padding-left: 42px;padding-right:42px;">Steps to Register
                        </a>
						{{-- <a href="resources/pdf/freedom-run-hoarding-2023.pdf" class="og_btn" target="_blank">Download Event Creatives</a> --}}
						{{-- <a href="resources/imgs/freedomrunupdate4.jpg" target="_blank" class="og_btn" target="_blank">Download Event Creatives</a> --}}
						<a href="{{ url('freedomrun-events-creatives') }}" target="_blank" class="og_btn" target="_blank">Download Event Creatives</a>
                        <div class="m-40"></div>
                    </div>
                </div>
                <h5 class="mb-4 " style="color: #19acd8;"><b>“RUNNING:</b> The human body’s rawest form of FREEDOM”</h5>
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
                <!-- <div class="p_evt_list webview">
                    <a href="partner-organization" class="gr_btn blue_btn btn-sm " style="">Partner : Register for event listing</a>
                </div> -->
            </div>
            <!-- form start for individual -->
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="mobileview">
                    <h1 class="head_free_run">Fit India Swachhata Freedom Run 4.0</h1>
                    <!-- <div class="under_line"></div> -->
                    <div class="ahover">
                        <a href="register" class="og_btn" target="_blank">Register as an Organizer</a>
                        <a href="resources/pdf/SOP-Freedom-Run-4.0.pdf" class="og_btn" target="_blank" style="background-color:#45a164; padding-left: 42px;padding-right:42px;">Steps to Register
                        </a>
						<a href="resources/pdf/freedom-run-hoarding-2023.pdf" class="og_btn" target="_blank">freedom-run-hoarding-2023.pdf</a>

                        <div class="m-40"></div>
                    </div>
                </div>
                <div class="wrap event-form card shadow1" style="    background: #f3f3f38a;">
                    @if (session('failed'))
                    <div class="alert alert-danger">
                        {{ session('failed') }}
                    </div>
                    @endif
                    <h3 class="mb-3" style="color: #4267b2;">Individual Registration</h3>
                    <form name="freedum_run_form" method="post" action="freedomrun-add-individual" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <!--   <input type="hidden" name="user_id" value="{{ Auth::id() }}"/> -->
                        <div class="main_form">
                            <div class="um-field"></div>
                            <div class="um-field">
                                <div class="um-field-label">
                                    <label for="eventname">Event Name *</label>
                                    <div class="um-clear"></div>
                                </div>
                                <div class="um-field-area">
                                    <!-- <label for="name">Organization / Institution / Group / School Name  *</label> -->
                                    <input type="text" name="event_name" id="event_name" class="form-control" placeholder="Event Name" value="Fit India Swachhata Freedom Run 4.0" readonly>
                                </div>
                            </div>
                            <div class="um-field"></div>
							<div class="um-field">
                                <div class="um-field-label">
                                    <label for="eventname">Type *
                                    </label>
                                    <div class="um-clear"></div>
                                </div>
                                <div class="um-field-area">
                                    <!-- <label for="name">Organization / Institution / Group / School Name  *</label> -->
                                    <select name="type" id="type" class="form-control">
										<option value="1">Plog Run</option>
										<option value="0" selected>Running/Walking/Jogging</option>
									</select>
                                    {!!$errors->first("name","<span class='text-danger'>:message</span>")!!}
                                </div>
                            </div>
                            <div class="um-field">
                                <div class="um-field-label">
                                    <label for="eventname">Individual Name *
                                    </label>
                                    <div class="um-clear"></div>
                                </div>
                                <div class="um-field-area">
                                    <!-- <label for="name">Organization / Institution / Group / School Name  *</label> -->
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                                    {!!$errors->first("name","<span class='text-danger'>:message</span>")!!}
                                </div>
                            </div>
                            <div class="um-field">
                                <div class="um-field-label">
                                    <label for="eventname">Email ID *</label>
                                    <div class="um-clear"></div>
                                </div>
                                <div class="um-field-area">
                                    <!-- <label for="Email">Email ID *</label> -->
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                                    {!!$errors->first("email","<span class='text-danger'>:message</span>")!!}
                                </div>
                            </div>
                            <div class="um-field">
                                <div class="um-field-label">
                                    <label for="eventname">Contact Number *</label>
                                    <div class="um-clear"></div>
                                </div>
                                <div class="um-field-area">
                                    <!-- <label for="contact">Contact Number *</label> -->
                                    <input type="number" name="contact" class="form-control" id="contact" placeholder="Contact" min=1 maxlength="10" value="{{ old('contact') }}">
                                    {!!$errors->first("contact","<span class='text-danger'>:message</span>")!!}
                                </div>
                            </div>
                            <div class="um-field">
                                <div class="um-field-label">
                                    <label for="eventimage1">Event (Photo / Image) *</label>
                                    <div class="um-clear"></div>
                                </div>
                                <div class="um-field-area">
                                    <input type="file" name="image1" id="image1" class="form-control">
                                    {!!$errors->first("image1", "<span class='text-danger'>:message</span>")!!}
                                </div>
                            </div>

                            <div class="um-field"> </div>
                            <div class="um-field">
                                <div class="um-field-label">
                                    <label for="">Event Date *</label>
                                    <div class="um-clear"></div>
                                </div>
                                <div class="um-field-area">
                                    <div class="event-row-lt event-row-it-resp mt-2 ">
                                        <span id="eventstartdate">From Date</span>
                                        <input type="date" name="from_date" class="form-control" id="from_date" maxlength="10" value="{{ old('from_date') }}" min="2023-10-02" max='2023-10-31'>
                                        {!!$errors->first("from_date", "<span class='text-danger'>:message</span>")!!}
                                    </div>
                                    <div class="event-row-lt event-row-it-resp mt-2" id="eventenddatediv">
                                        To Date
                                        <input type="date" name="to_date" class="form-control" id="to_date" maxlength="10" value="{{ old('to_date') }}"  min="2023-10-02" max='2023-10-31'>
                                        {!!$errors->first("to_date", "<span class='text-danger'>:message</span>")!!}
                                    </div>
                                    <div class="clear clearfix"></div>
                                </div>
                            </div>

                            <div class="um-field eventclass schoolHide prabhatHide">
                                <div class="um-field-label">
                                    <label for="kmrun">Total KM(Kilometer) Covered *</label>
                                    <div class="um-clear"></div>
                                </div>
                                <div class="um-field-area">
                                    <input type="number" name="km" class="form-control limit" id="km" placeholder="Kilometer" value="{{ old('km') }}" min="1" maxlength="2">
                                    {!!$errors->first("kmrun", "<span class='text-danger'>:message</span>")!!}
                                </div>
                            </div>

                            <div class="um-field eventclass schoolHide prabhatHide">
                                <div class="um-field-label">
                                    <label for="kmrun">Video Link (Optional)</label>
                                    <div class="um-clear"></div>
                                </div>
                                <div class="um-field-area">
                                    <input type="text" name="video_link" class="form-control" id="video_link" placeholder="Video Link" value="{{ old('video_link') }}">
                                    {!!$errors->first("kmrun", "<span class='text-danger'>:message</span>")!!}
                                </div>
                            </div>
                            <div class="um-field eventclass schoolHide prabhatHide">
                                <label for="captcha">Please Enter the Captcha Text</label><br>
                                <div style="float:left; width:115px;  margin: 6px 0;" id="pagecaptcha-cont">
                                    <div class="captchaimg">
                                        <span>{!! captcha_img() !!}</span>
                                    </div>
                                </div>
                                <div style="float:left; margin: 6px 20px 6px 10px; cursor: pointer;">
                                    <button type="button" class="btn btn-info" class="reload" id="reload"> ↻ </button>
                                </div>

                                <div style="float:left; width:40%">
                                    <input type="text" id="captcha" name="captcha" class="form-control @error('captcha') is-invalid @enderror" required placeholder="Captcha">
                                    @error('captcha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div style="clear:both"></div>
                            <div class="um-field" id="success_msg_div">
                                <div class="um-field-area text-center  ac_btn_partner">
								<input type="submit" name="create-event" value="Submit">
                                    <!--  -->
                                    <!--   <a  class="btn btn-primary btn-sm" href="javascript:void(0);" style="background-color: #4267b2;
    border-color: #4267b2;">Download Certificate</a> -->
                                    <!--    <span style='margin-left:10px ;'> <b>For Individual registration will start from 13th August</b></span>

 -->


                                    <?php $sc_email = base64_encode(session('success_email')); ?>

                                    @if(session('success_email'))
                                    <a class="btn btn-primary btn-sm d_button" href="check-individual-existance-second/{{$sc_email}}">Download Certificate</a>
                                    @endif
                                </div>
                            </div>
                            <div>
                                @if (session('success'))
                                <hr>
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </form>


                    <!--             <form actioin="check-individual-existance" method="POST">
                                @csrf
                                <input type="hidden" name="certificate_email" value="brijk7434@gmail.com">
                                <button type="submit" name="certificate_email" class="btn btn-primary btn-sm" value="brijk7434@gmail.com" >download Certificate</button>
                            </form> -->



                </div>
                <div class="card mt-2 shadow1 p-3 cer_forma_div " style="    background: #f3f3f38a;">
                    <span class="text-center">To download your individual certificate again</span> <a id="invidual_download" class="btn btn-primary btn-sm clic_btn" href="javascript:void(0);" id="invidual_download">Click Here</a>
                    <form name="freedom_indidual_cert" action="check-individual-existance" id="ind-certificate" style="display:none;" method="POST">
                        @csrf
                        <div class="um-field">
                            <!-- <div class="um-field-label">
                                            <label for="eventname">Email</label>
                                            <div class="um-clear"></div>
                                        </div>  -->
                            <div class="um-field-area mt-3">
                                <label for="name">Email ID:- </label>
                                <input type="text" name="certificate_email" id="certificate_email" class="form-control" placeholder="Enter your email address">
                            </div>
                        </div>




                        <div class="um-field mt-3">
                            <div class="um-field-area text-center">
                                <input type="submit" name="download_individual_certificate" class="btn btn-primary btn-sm" value="Download">
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
        <!-- end form for individual -->
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

<!--
                <div class="p_evt_list mobileview">
                    <a href="partner-organization" class="gr_btn blue_btn btn-sm " style="">Partner : Register for event listing</a>
                </div>
				-->

            </div>
        </div>
    </div>
<?php /*
    <div class="fluid-container f_container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="part_event">Partner's Event Detail</h1>
                <!-- <div class="under_line_1"></div> -->
            </div>
        </div>

        <div class="row ">
            @if($freedom_partner_detail)
            @foreach($freedom_partner_detail as $freedom_partner_values)
            <div class="col-sm-12 col-md-3 col-lg-3 herfparent">
                <?php if (!empty($freedom_partner_values->website_link)) {
                    $web_link = $freedom_partner_values->website_link;
                    $pointer_false = '';
                } else {
                    $web_link = 'javascript:void(0);';
                    $pointer_false = 'pointer-events: none';
                } ?>

                <a class="getlink" href="javascript:void(0);" data-link="<?= $web_link ?>" style="<?= $pointer_false ?>">
                    <div class="card_partner shadow1">
                        <div class="card_partner_img">
                            <img src="{{$freedom_partner_values->photo}}" alt="{{$freedom_partner_values->org_name}}" title="{{$freedom_partner_values->org_name}}" class="fluid-img" />

                            <div class="card_partner_event">
                                <h6> {{$freedom_partner_values->org_name}} </h6>
                            </div>
                        </div>
                        <div class="card_partner_inner">
                            <h6><span>Event name</span> &nbsp;<br><b>{{$freedom_partner_values->event_name}}</b></h6>


                            <h6><span>Event Date</span>&nbsp;<br> <b>{{$freedom_partner_values->from_date}} to {{$freedom_partner_values->to_date}}</b></h6>
                            
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            @endif
        </div>

    </div>
	
	*/?>
    </div>

</section>



{{-- <script src='https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js'></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script> --}}
<script src="{{ asset('resources/js/newjs/jquery.validate.min.js')}}"></script>
<script src="{{ asset('resources/js/newjs/additional-methods.js')}}"></script>
<script>
    $(document).ready(function() {
        // $( "#from_date" ).datepicker({ minDate: -20, maxDate: "+1M +10D" });
        $('#invidual_download').click(function() {
            $('#ind-certificate').toggle();
        });
    });
</script>
<script>
    $(function() {
        jQuery.validator.addMethod("validate_email", function(value, element) {
            if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Please enter a valid Email.");

        jQuery.validator.addMethod("lettersonly", function(value, element) {
            //return this.optional(element) || /^[a-z," "]+$/i.test(value);
            return this.optional(element) || /^[a-zA-Z0-9_@./#&+,:\s/-]+$/i.test(value);
        }, "Letters and spaces only please");

        $.validator.addMethod('filesize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param)
        }, 'File size must be less than {0} bytes.');


        $("form[name='freedum_run_form']").validate({
            rules: {
                name: {
                    required: true,
                    lettersonly: true
                },
                email: {
                    required: true,
                    validate_email: true
                },
                contact: {
                    required: true,
                    minlength: 10,
                    maxlength: 10
                },
                image1: {
                    required: true,
                    extension: "gif|png|jpg|jpeg|gif", // work with additional-mothods.js
                    filesize: 1048576,
                },
                from_date: {
                    required: true
                },
                to_date: {
                    required: true
                },
                km: {
                    required: true,
                    digits: true,
                    maxlength: 3
                },
                video_link: {
                    url: true
                },
				captcha: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter your name",
                    lettersonly: "Please enter character only"
                },
                email: {
                    required: "Please enter your email",
                    validate_email: "Please enter valid email id"
                },
                contact: {
                    required: "Please enter contact number",
                    minlength: "Contact no. must of 10 digits",
                    maxlength: "Contact no. must of 10 digits"
                },
                image: {
                    filesize: "File size must be less than 1 mb."
                },
				km: {
                    required: "Please enter Total KM(Kilometer) Covered ",
                },
				from_date: {
                    required: "Please select start date "
                },
                to_date: {
                    required: "Please select end date "
                },
				image1: {
                    required: "Please upload event photo ",
				},
				captcha: {
                    required: "Please enter captcha"
                }
            },

            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>


<script>
    $(function() {
        $("form[name='freedom_indidual_cert']").validate({
            rules: {
                certificate_email: {
                    required: true,
                    validate_email: true
                }
            },
            messages: {
                email: {
                    required: "Please enter your email",
                    validate_email: "Please enter valid email id"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });


    var inputQuantity = [];
    $(function() {
        $(".limit").on("keyup", function(e) {
            var $field = $(this),
                val = this.value,
                $thisIndex = parseInt($field.data("idx"), 2);
            if (this.validity && this.validity.badInput || isNaN(val) || $field.is(":invalid")) {
                this.value = inputQuantity[$thisIndex];
                return;
            }
            if (val.length > Number($field.attr("maxlength"))) {
                val = val.slice(0, 2);
                $field.val(val);
            }
            inputQuantity[$thisIndex] = val;
        });
    });
</script>
<style>
    .error {
        color: red;
    }
</style>
@endsection