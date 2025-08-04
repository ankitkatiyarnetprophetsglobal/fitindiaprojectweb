    @extends('layouts.app')
@section('title', 'Fit India Cyclothon 2020| Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
 <div class="banner_area1">
   <img src="{{ asset('resources/imgs/rider-cycle-rally_innr_banner.jpg') }}" alt="Rider-Cycle Rally" title="Fit India Freedom Rider-Cycle Rally" class="img-fluid expand_img"/>         
 </div>
 <section id="{{ $active_section_id }}">
<div class="container">
  
    <div class="row">
        <div class="col-sm-12">
        <h1 class="headingh1">Celebrate World Bicycle Day 2022 with</h1> 
    </div>
    </div>
        <div class="row">              
            <div class="col-sm-12 col-md-12">
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
					<!--<div class="col-sm-12 col-md-12 col-lg-12 mt-3"><p><a href="register/" class="freedombtn1" >REGISTER NOW!</a></p></div> -->

            
            
            </div>
            </div>
    </section>    





@endsection

