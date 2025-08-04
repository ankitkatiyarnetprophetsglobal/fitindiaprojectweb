    @extends('layouts.app')
@section('title', 'Fit India Cyclothon 2020| Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
 <div class="banner_area1">
   <img src="{{ asset('resources/imgs/cyclothon-pedal.jpg') }}" alt="cyclothon-pedal" title="Cyclothon" class="img-fluid expand_img"/>         
 <section id="{{ $active_section_id }}">
<div class="container">
   <div class="row">
   <a class="freedombtn1" href="register">Register as an Organiser</a>
    <a class="freedombtn2" href="register">Register As An Individual</a>
    <a class="freedombtn3" href="{{ url('wp-content/uploads/2021/01/How-to-Register-Cyclothon-Event.pdf') }}" target="_blank">How To Register</a>
   </div>
    <div class="row">
        <div class="col-sm-12">
          <br>
        <h1 style="font-size: 24px; font-weight: 700; color: #4f7af1; font-style: italic">Fit India Cyclothon 2020</h1><br> 
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
                        <p>Fit India Mission will be organising the <strong>Fit India Cyclothon</strong> from December 2020.</p>
                        <P>Fit India Cyclothon can be organised by cycling groups, schools, colleges, organisations,
                                councils, panchayats, corporations, societies, RWA’s, NGO’s, special interest groups
                                across India. You can also start a Fit India Cyclothon group by involving your
                                organisation, community, family and friends.</P>
                        </div>
                    </div>
                </div>
                <!-- -Second -->
                    <div class="card">
                        <div class="card-head" id="FIC2020_2">
                            <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#accordionFIC2020_2" aria-expanded="false" aria-controls="collapseTwo">
                            Why organise/participate in a Cyclothon?
                            </h2>
                        </div>
                        <div id="accordionFIC2020_2" class="collapse " aria-labelledby="FIC2020_2" data-parent="#accordionFIC2020">
                            <div class="card-body">
                            <p>Cycling is one of the best ways to remain fit and healthy. It is the new craze that
                                combines fitness with fun and allows us to maintain social distancing.</p>
                            </div>
                        </div>
                    </div>

                    <!-- -Third -->
                    <div class="card">
                        <div class="card-head" id="FIC2020_3">
                            <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#accordionFIC2020_3" aria-expanded="false" aria-controls="collapseThree">
                            Who can organise/participate in the Fit India Cyclothon?
                            </h2>
                        </div>

                        <div id="accordionFIC2020_3" class="collapse" aria-labelledby="headFIC2020_3ingThree" data-parent="#accordionFIC2020">
                            <div class="card-body">
                            <ul class="a">
                                <li>Village, Town or City Council/ Panchayat/ Anganwadi / Block</li>
                                <li> Your Workplace</li>
                                <li> Society or RWA</li>
                                <li> Interest Groups</li>
                                <li> Corporate and Industry bodies</li>
                                <li> Schools/ Colleges and Universities</li>
                                <li>NGOs</li>
                                <li>Communities</li>
                                <li>Individuals</li>

                            </ul>
                        
                            <!-- <a href="{{asset('home') }}">https://fitindia.gov.in/fit-india-school-week</a> -->
                            <p>Organisers must ensure that all “Fit India Cyclothon” events are listed on 
                            www.fitindia.gov.in portal and
                                are non-commercial in nature. Further, Individual Participants should also ensure that
                                they register themselves as well.</p>
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
                        <ul class="a">
                                <li>Fit India Cyclothon can be organised by any government or private organisation, schools, colleges, universities, individuals, groups, RWAs and communities to create awareness on fitness through cycling.</li>
                                <li>Guidelines in relation to COVID-19 issued by the Ministry of Home Affairs and relevant state bodies to be duly complied with.</li>
                                <li> To become an organiser, you must register online on <u>gov.in</u></li>
                                <li> As an organiser, you will be responsible for conceptualizing, executing and ensuring a smooth and successful Fit India Cyclothon event to maximize public participation.</li>
                                <li>You can invite other organisations as well for online participation registration.</li>
                                <li>You can get sponsorship and have partners to organise this event.</li>
                                <li>Fit India Mission office will provide standard FIT INDIA design templates for branding elements on the registration portal for organisers to download and use the same:</li>
                                <li>Organisers will get FIT INDIA Movement partner – certificate from Fit India.</li>
                                <li>Those interested in partnership can also write to Fit India Mission office on: partnership[dot]fitindia[at]gmail[dot]com</li>
                            </ul>
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
                            <ul class="a">
                                <li>Identify route, create map and share with participants in advance.</li>
                                <li>Inform local bodies about the event.</li>
                                
                                <li>Prior approval should be taken from relevant authorities wherever required.</li>
                                <li>Inform communities around you about Fit India Cyclothon.</li>
                                <li>Partner with local businesses who can sponsor FIT INDIA tee shirts / caps for children.</li>
                                <li>Any queries regarding Fit India Cyclothon to be sent to Fit India Mission office on: contact[dot]fitindia[at]gmail[dot]com</li>
                            </ul>  
                            
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
                                <ul class="a">
                                <li>Any individual can participate in Fit India Cyclothon to create awareness on fitness through cycling.</li>
                                <li>Guidelines in relation to COVID-19 issued by the Ministry of Home Affairs, India and relevant state bodies to be duly complied with.</li>
                                <li>To participate, an individual should register online on gov.in.</li>
                                <li>As an individual, you will be responsible for conceptualizing, executing and ensuring a smooth and successful Fit India Cyclothon event.</li>
                                <li>You can invite other individuals as well for online participation registration.</li>
                                <li>Any fitness enthusiast who is participating should strive to motivate at least one partner to participate.</li>
                                <li>Registered Individuals will get participation certificate after updating their details on the Fit India portal.</li>
                                <li>For any queries, contact on contact[dot]fitindia[at]gmail[dot]com</li>
                                
                            </ul>   
                                
                                </div>
                            </div>
                    </div>

                    <!-- -Seven -->
                    <div class="card">
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
                    </div>

                    <!-- -Eight -->
                        <div class="card">
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
                    </div>
            
            
            </div>
            </div>
        </div>
</div>
</section>



@endsection

