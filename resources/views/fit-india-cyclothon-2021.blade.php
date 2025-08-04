    @extends('layouts.app')
@section('title', 'Fit India Cyclothon 2020| Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
 <div class="banner_area1">
   <img src="{{ asset('resources/imgs/cyclothon-2021.png') }}" alt="cyclothon-pedal" title="Cyclothon" class="img-fluid expand_img"/>         
 <section id="{{ $active_section_id }}">
<div class="container">
   <div class="row">
   <!-- <a class="freedombtn1" href="register">Register as an Organiser</a> -->
    <a class="freedombtn2" href="register?role=<?=base64_encode('ghd')?>">Register As Organizer</a>
 <!--    <a class="freedombtn3" href="{{ url('wp-content/uploads/2021/01/How-to-Register-Cyclothon-Event.pdf') }}" target="_blank">How To Register</a> -->
   </div>
    <div class="row">
        <div class="col-sm-12">
          
        <h1 class="headingh1">Fit India Cyclothon 2021</h1><br> 
    </div>
    </div>
        <div class="row">              
            <div class="col-sm-12 col-md-12">
            <div class="accordion" id="accordionFIC2020">
                <!-- -First -->
                <div class="card">
                    <div class="card-head" id="FIC2020_1">
                        <h2 class="mb-0" data-toggle="collapse"  data-target="#accordionFIC2020_1" aria-expanded="true" aria-controls="collapseOne">
                        Introduction
                        </h2>
                    </div>

                    <div id="accordionFIC2020_1" class="collapse show" aria-labelledby="FIC2020_1" data-parent="#accordionFIC2020">
                        <div class="card-body">
                        <p> One reason could be that physical activity causes the body to release so-called 
                            ‘happy hormones’ (like endorphins, dopamine and serotonin). This helps 
                            positively change our mood, making us feel less stressed and better able to 
                            manage anxiety and depression, and cycling can bring about a feeling of greater 
                            self-esteem, self-control and the ability to rise to a challenge – making one feel 
                            good about himself and the world around him. It’s the perfect way to enjoy the 
                            fresh air and discover the great outdoors. So Health Department of Government 
                            of Gujarat will be organising the <strong>Fit India Fit Gujarat Cyclothon</strong> to promote 
                            fitness activities at each and every Health and Wellness centres of Gujarat </p>
                        </div>
                    </div>
                </div>
                <!-- -Second -->
                    <div class="card">
                        <div class="card-head" id="FIC2020_2">
                            <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#accordionFIC2020_2" aria-expanded="false" aria-controls="collapseTwo">
                            Why to organise/participate in a Cyclothon?
                            </h2>
                        </div>
                        <div id="accordionFIC2020_2" class="collapse " aria-labelledby="FIC2020_2" data-parent="#accordionFIC2020">
                            <div class="card-body">
                                <p>Cycling is one of the best ways to remain fit and healthy. It is the new craze that 
                                    combines fitness with fun and allows us to maintain social distancing, and can 
                                    be incorporated in our daily wellness activities.</p> 
                            </div>
                        </div>
                    </div>

                    <!-- -Third -->
                    <div class="card">
                        <div class="card-head" id="FIC2020_3">
                            <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#accordionFIC2020_3" aria-expanded="false" aria-controls="collapseThree">
                            Who can organise/participate in the Fit India Fit Gujarat Cyclothon
                            </h2>
                        </div>

                        <div id="accordionFIC2020_3" class="collapse" aria-labelledby="headFIC2020_3ingThree" data-parent="#accordionFIC2020">
                            <div class="card-body">
                                <p>Each and every Health and Wellness centres (HWC-SC, CPHC, CUHC) should 
                                    organise this event in their areas. Community Health Officer, Medical Officer, 
                                    Superintendent, Taluka Health Officer, Chief District Health Officer and Chief 
                                    District Medical Officer and any administrative health office can be work as 
                                    Organiser. Participants will be villagers, family, friends, special interested 
                                    groups, government employees etc. Participants will be of any age group ( 
                                    Above Seven years of age), however Children & Adolescent & Women can be 
                                    encouraged for participation. 
                                </p>
                            </div>
                        </div>
                    </div>

                        <!-- forth -->

                <div class="card">
                    <div class="card-head" id="FIC2020_4">
                        <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#accordionFIC2020_4" aria-expanded="true" aria-controls="collapseOne">
                        Guidelines for Organisers
                        </h2>
                    </div>

                    <div id="accordionFIC2020_4" class="collapse " aria-labelledby="FIC2020_4" data-parent="#accordionFIC2020">
                        <div class="card-body">
                            <p>Fit India Fit Gujarat Cyclothon can be organised by any health and wellness 
                                centers as well as PHC, UHC, CHC, SDH, DH or MC or any administrative office of
                            Health Department to create awareness on fitness and wellness through cycling. 
                                Organiser has to comply Guidelines in relation to COVID-19 issued by state. 
                                Organizer has to register online on https://fitindia.gov.in/ . As an organiser, he 
                                will be responsible for conceptualizing, executing and ensuring a smooth and 
                                successful Fit India Fit Gujarat Cyclothon event to maximize public participation. 
                                He can invite other organisations as well for online participation registration. He 
                                can get sponsorship and have partners to organise this event. Fit India Fit 
                                Gujarat Cyclothon office will provide standard FIT INDIA FIT GUJARAT 
                                CYCLOTHON design templates for branding elements on the registration portal 
                                for organisers to download and use the same: </p>
                        </div>
                    </div>
                </div>

                <!-- -Five -->
                <div class="card">
                        <div class="card-head" id="FIC2020_5">
                            <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#accordionFIC2020_5" aria-expanded="false" aria-controls="collapseTwo">
                            Other Guidelines for organisers
                            </h2>
                        </div>
                        <div id="accordionFIC2020_5" class="collapse " aria-labelledby="FIC2020_5" data-parent="#accordionFIC2020">
                            <div class="card-body">
                                <p>Organiser has to identify participants, encourage local villagers / ward members 
                                    for participation. Cycling event will be of either 1 km, 3 km, 5 km, 10 km or 15 
                                    km distance. So based on distance organiser has to identify route, create map 
                                    and share with participants in advance. Organiser should inform local bodies 
                                    about the event details. If necessary than prior approval should be taken from 
                                    relevant authorities wherever required. Organiser should inform local 
                                    communities about Fit India Fit Gujarat Cyclothon. Local businesses who can 
                                    sponsor FIT FINDIA FIT GUJARAT tee shirts / caps for children, can be contacted. 
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- -Six -->
                    <div class="card">
                            <div class="card-head" id="FIC2020_6">
                                <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#accordionFIC2020_6" aria-expanded="false" aria-controls="collapseTwo">
                                Guidelines for Individual Participants
                                </h2>
                            </div>
                            <div id="accordionFIC2020_6" class="collapse " aria-labelledby="FIC2020_6" data-parent="#accordionFIC2020">
                                <div class="card-body">
                                    <p>Any individual can participate in Fit India Fit Gujarat Cyclothon to create 
                                        awareness on fitness through cycling. Participant has to comply Guidelines in 
                                        relation to COVID-19 issued by state. To participate, an individual should register 
                                        online on <a href="https://fitindia.gov.in/" target="_blank">https://fitindia.gov.in/.</a> As an individual, he will be responsible for 
                                        conceptualizing, executing and ensuring a smooth and successful Fit India 
                                        Cyclothon event. He can invite other individuals as well for online participation 
                                        registration. Any fitness enthusiast who is participating should strive to motivate 
                                        at least one partner to participate. Registered Individuals will get participation 
                                        certificate after updating their details on <a href="https://fitindia.gov.in/" target="_blank">https://fitindia.gov.in/.</a></p> 
                                </div>
                            </div>
                    </div>

                     <!-- -Seven -->
                    <div class="card">
                            <div class="card-head" id="FIC2020_7">
                                <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#accordionFIC2020_7" aria-expanded="false" aria-controls="collapseTwo">
                               Fit India Fit Gujarat Cyclothon – Event Date & Time & Venue. 
                                </h2>
                            </div>
                            <div id="accordionFIC2020_7" class="collapse " aria-labelledby="FIC2020_7" data-parent="#accordionFIC2020">
                                <div class="card-body">
                                    <p>Fit India Fit Gujarat Cyclothon will be organised on 26th December 2021, Sunday, 
                                        08-00 am onwards. Venue will be each and every HWC-SC, CPHC, CUHC and 
                                        accordingly route will be finalized.</p>    
                                </div>
                            </div>
                    </div>

                    <!-- -Seven -->
                   <!--  <div class="card">
                            <div class="card-head" id="FIC2020_7">
                                <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#accordionFIC2020_7" aria-expanded="false" aria-controls="collapseTwo">
                                Other guidelines for individuals
                                </h2>
                            </div>
                            <div id="accordionFIC2020_7" class="collapse " aria-labelledby="FIC2020_7" data-parent="#accordionFIC2020">
                                <div class="card-body">
                                <ul class="a">
                                <li>Identify route.</li>
                                <li>Inform communities around you about the Fit India Cyclothon.</li>
                            </ul>     
                                
                                </div>
                            </div>
                    </div> -->

                    <!-- -Eight -->
                    <!-- <div class="card">
                            <div class="card-head" id="FIC2020_8">
                                <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#accordionFIC2020_8" aria-expanded="false" aria-controls="collapseTwo">
                                How to use the Fit India Cyclothon templates Fit India Logo
                                </h2>
                            </div>
                            <div id="accordionFIC2020_8" class="collapse " aria-labelledby="FIC2020_8" data-parent="#accordionFIC2020">
                                <div class="card-body">
                                <ul class="a">
                                <li>Download the Fit India Logo after you register as an organisation or an individual</li>
                                <li>Do not edit the Fit India Logo (colour or dimension)</li>
                                <li>To be used only for events in promotion of Fit India Movement</li>
                            </ul>    
                                
                                </div>
                            </div>
                    </div> -->
            
            
            </div>
            </div>
        </div>
</div>
</section>



@endsection

