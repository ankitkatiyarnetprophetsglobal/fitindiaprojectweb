@extends('layouts.app') 
@section('title', 'Influencer | Fit-India ')
@section('content')
<style>
.freeHead_o {
            background: #1c687f;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            padding: 5px 10px;
            font-size: 20px;
            color: #fff;
            text-align: center;
            border-bottom: 1px solid #3f3e3e45;
            /* background: rgb(166, 83, 5);
        background: linear-gradient(90deg, rgba(166, 83, 5, 1) 0%, rgba(255, 128, 0, 1) 51%, rgba(166, 83, 5, 1) 100%); */
        }

        .font_weight {
            font-weight: 300;
        }

        .card_height {
            margin-top: 10%;
        }

        .shadow1 {
            box-shadow: 0 .2rem .3rem rgba(0, 0, 0, .15) !important;
        }

</style>

    <div class="container" style="display:<?php if(isset($_GET['m'])){ echo 'block'; }else{ echo 'none'; }?>">
        <div class="row freeparent">
            <div class="col-md-12 col-sm-12  mb-4  text-center ">
                <div class="card shadow1 card_height">
                    <h4 class="font_weight freeHead_o  mb-3 p-2">Information</h4>
                    <p class="p-4">This page will be available soon</p>
                </div>
            </div>
        </div>
    </div>
    <div style="display:<?php if(isset($_GET['m'])){ echo 'none'; }else{ echo 'block'; }?>">
        <img src="{{ asset('resources/imgs/inflencer.png') }}" alt="Inflencer"
            title="Inflencer" class="img-fluid expand_img" />			<!-- <h1 style="font-size:1px; color:#fff;">Share Your Story</h1> -->
    </div>
    <section style="display:<?php if(isset($_GET['m'])){ echo 'none'; }else{ echo 'block'; }?>">
    <div class="container">  
    <div class="row">
            <div class="col-sm-12 col-md-12 ">

                    <a href="fit-india-champions" class="btn  n_btn btn_round g_bg btn_width cham_btn" target="_blank">Champion</a>
                    <a href="fit-india-ambassador" class="btn  n_btn btn_round b_bg btn_width ambas_btn " target="_blank">Ambassador</a> 
                    <a href="fit-india-prerak" class="btn  n_btn btn_round o_bg btn_width btn_hover_eff prerak_btn" target="_blank">Prerak</a>                      
                    <a href="http://103.65.20.170/fitind/wp-content/uploads/doc/guildline_for_influencer.pdf" class="btn  n_btn btn_round p_bg btn_width guid_btn" target="_blank">Guidelines</a> 
                    
                    <br> 

                    <div class="graph mt-3 mb-3 web_ver">
                        <img src="{{asset('resources/imgs/Group3279.svg') }}"  title="influencer graph" alt="influencer graph" class="fluid-img"/>
                    </div>

                    <div class="graph mt-3 mb-3 mob_ver">
                        <img src="{{asset('resources/imgs/Group3280.svg') }}"  title="influencer graph" alt="influencer graph" class="fluid-img"/>
                    </div>
                    
                    <h2 class="i_h2 mt-5 mb-2 text-center" >Fit India Influencer (3 levels)</h2>
                    <!-- <h3 class="i_h3" style="color:#0bb078;">Fit India Champion (Level 3)</h3>
                    <h3 class="i_h3" style="color:#119ff1;">Fit India Ambassador (Level 2)</h3>
                    <h3 class="i_h3" style="color:#f06f11;">Fit India Prerak (Level 1)</h3> -->
                    
                    <br>


              </div>
            
        </div>

        <div class="row">
    <div class="col-md-12">
        <div class="accordion" id="accordionFISW">
            <div class="card">
                <div class="card-head" id="headingOne">
                    <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW1" aria-expanded="false"
                        aria-controls="collapseOne" style="color:#0bb078;font-weight: 200; font-size: 22px;">
                        Fit India Champion (Level 3)
                    </h2>
                </div>

                <div id="collapseFISW1" class="collapse " aria-labelledby="headingOne" data-parent="#accordionFISW">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-12 col-md-12 text-center mb-4 medi_gap">                            
                                    <img src="{{asset('resources/imgs/2champ.jpg') }}" alt="social media specialist" class="fluid-img"/>                           
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 ">
                                <ul class="ul_div">                                 
                                    <li><strong> The individual must have cumulative followers in the range of 100K — 1M on their social media platforms (Facebook, Twitter, & Instagram) either by themselves or by adding the followers of Fit India Preraks/Ambassadors who will joined by his/her referral code.</strong></li>
                                   
                                </ul>
                                    <div class="text-center">
                                        <a href="register"><button type="button" class="btn  n_btn btn_round g_bg_btn g_bg_btn1 alin_btn ab_btn_r">Apply</button> </a>              
                                    </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 b_line">
                                <ul class="ul_div">
                                  
                                    <li><strong>The Individual must have organised 3 events with min 1500 participants each in last 3 years either by themselves or by adding the participants of Fit India Preraks who have joined by his/her referral code.</strong></li>
                                    <span><strong>(Highest Participant Count will be considered out of the 3 events).</span></strong>
                                    <!-- <li>The Individual should be at least 18 years of age.</li>
                                    <li>The individual should have taken fitness assessment test on Fit India Mobile App.</li>
                                    <li>The individual should promote Fit India movement by:
                                        <ul class="ul_inner">
                                            <li>Organizing on-ground/virtual fitness events every quarter with at least 50 participants.</li>
                                            <li>Tagging Fit India's Official social media handles in fitness related content created by the individual.</li>
                                            <li>Uploading the photos of the events organized by the individual by tagging @FitIndiaOff and other hashtags as decided by Fit India Mission.</li>
                                            <li>Reposting/Retweeting the photos/videos of Fit India events and tag @FitlndiaOff and other hashtags as decided by Fit India Mission.</li>
                                            
                                        </ul>
                                    </li>   -->
                                </ul>
                                <div class="text-center">
                                    <a href="register"><button type="button" class="btn  n_btn btn_round alin_btn alin_btn1 ab_btn ">Apply</button> </a>                           
                                </div>  
                            </div> 
                        </div> 
                        <div class="row">
                            <div class="col-sm-12 mt-3">
                                <br><br>
                                <h4 class="text_head_uline text-center"> <u>Illustration : Prerak to Champion</u><br><br> </h4>
                                <br>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 text-center medi_gap">           
                                <img src="{{asset('resources/imgs/4dia.jpg') }}" alt="social media specialist" class="fluid-img"/>
                                <br>
                                <p>The individual must have cumulative followers in the range of 100K — 1M on their social media platforms (Facebook, Twitter, & Instagram) either by themselves or by adding the followers of Fit India Preraks/Ambassadors who will joined by his/her referral code.</p>
                            </div>
                            
                            <div class="col-sm-6 col-md-6 col-lg-6 text-center b_line">               
                                <img src="{{asset('resources/imgs/4_sec2.jpg') }}" alt="fitness event specialist" class="fluid-img"/>
                                <br>
                                    <p>The Individual must have organised 3 events with min 1500 participants each in last 3 years either by themselves or by adding the participants of Fit India Preraks who have joined by his/her referral code.</p> 
                                    <p><span>(Highest Participant Count will be considered out of the 3 events).</span></p>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-head" id="headingTwo">
                    <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW2" aria-expanded="false"
                        aria-controls="collapseTwo" style="color:#119ff1;font-weight: 200;
    font-size: 22px;">   Fit India Ambassador (Level 2) 
                    </h2>
                </div>
                <div id="collapseFISW2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFISW">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-12 col-md-12 text-center medi_gap">                            
                                    <img src="{{asset('resources/imgs/2ambass.jpg') }}" alt="social media specialist" class="fluid-img"/>                                
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-sm-12 col-md-6 col-lg-6 ">
                                <ul class="ul_div">
                                    <!-- <li>The individual should be the one who practices some form of physical activity such as running, cycling, yoga etc. for 30 to 60 minutes daily. </li>
                                    <li>The individual should be present on at least one of the social media handles (Facebook, Instagram or Twitter) must be following Fit India Movement’s Social media handles (@FitIndiaOff) and other hashtags as decided by Fit India Mission.</li> -->
                                    <li> <strong>The individual must have cumulative followers in the range of 10K — 100K on their social media platforms (Facebook, Twitter, & Instagram) either by themselves or by adding the followers of Fit India Preraks who will joined by his/her referral code.</strong></li>
                                    <!-- <li>The Individual should be at least 18 years of age.</li>
                                    <li>The individual should have taken fitness assessment test on Fit India Mobile App. </li>
                                    <li>The individual should promote Fit India movement by:
                                        <ul class="ul_inner">
                                            <li>Organising or participating on-ground/virtual fitness events wherever possible</li>
                                            <li>Tagging Fit India's Official social media handles in fitness related content created by the individual.</li>
                                            <li>Uploading the photos of the events organised or participated by the individual by tagging @FitlndiaOff and other hashtags as decided by Fit India Mission</li>
                                            <li>Reposting/Retweeting the photos/videos of Fit India events and tag @FitlndiaOff and other hashtags as decided by Fit India Mission</li>
                                            
                                        </ul>
                                    </li>   -->
                                    </ul>
                                    <div class="text-center">
                                     <a href="register"><button type="button" class="btn  n_btn btn_round g_bg_btn g_bg_btn1 alin_btn ab_btn">Apply</button> </a>              
                                    </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 b_line">
                                        <ul class="ul_div">
                                            <!-- <li>The individual should be the one who practices some form of physical activity such as running, cycling, yoga etc. for 30 to 60 minutes daily.</li>
                                            <li>The individual should be present on at least one of the social media handles (Facebook, lnstagram or Twitter) and must be following Fit India Movement's Social media handles (@FitlndiaOff) and other hashtags as decided by Fit India Mission.</li> -->
                                            <li><strong>The Individual must have organised 3 events with min 500 participants each in last 3 years either by themselves or by adding the participants of Fit India Preraks who have joined by his/her referral code.</strong></li>
                                            <span><strong>(Highest Participant Count will be considered out of the 3 events).</span></strong>
                                            <!-- <li>The Individual should be at least 18 years of age.</li>
                                            <li>The individual should have taken fitness assessment test on Fit India Mobile App.</li>
                                            <li>The individual should promote Fit India movement by:

                                                <ul class="ul_inner">
                                                    <li>Organizing on-ground/virtual fitness events every quarter with at least 50 participants.</li>
                                                    <li>Tagging Fit India's Official social media handles in fitness related content created by the individual.</li>
                                                    <li>Uploading the photos of the events organized by the individual by tagging @FitIndiaOff and other hashtags as decided by Fit India Mission.</li>
                                                    <li>Reposting/Retweeting the photos/videos of Fit India events and tag @FitlndiaOff and other hashtags as decided by Fit India Mission.</li>
                                                    
                                                </ul>
                                            </li>   -->
                                        </ul>
                                    <div class="text-center">
                                        <a href="register"><button type="button" class="btn  n_btn btn_round alin_btn alin_btn1 ab_btn">Apply</button> </a>                           
                                    </div>  
                             </div> 
                        </div> 

                        <div class="row">
                            <div class="col-sm-12 mt-4">
                            <br>
                                <h4 class="text_head_uline text-center"> <u>Illustration : Prerak to Ambassador</u> </h4>
                                <br><br> 
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 text-center medi_gap">
                         
                                <img src="{{asset('resources/imgs/3dia.jpg') }}" alt="social media specialist" class="fluid-img"/>
                                <p>The individual must have cumulative followers in the range of 10K — 100K on their social media platforms (Facebook, Twitter, & Instagram) either by themselves or by adding the followers of Fit India Preraks who will joined by his/her referral code.</p>
                            </div>
                            
                
                            <div class="col-sm-6 col-md-6 col-lg-6 b_line text-center">
                              
                                <img src="{{asset('resources/imgs/3sec_dia2.jpg') }}" alt="fitness event specialist" class="fluid-img"/>
                                <p>The Individual must have organised 3 events with min 500 participants each in last 3 years either by themselves or by adding the participants of Fit India Preraks who have joined by his/her referral code.</p>
                                <span>(Highest Participant Count will be considered out of the 3 events).</span>
                            </div>                         
                        </div> 
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-head" id="headingThree">
                    <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW3" aria-expanded="false"
                        aria-controls="collapseThree" style="color:#f06f11;font-weight: 200;
    font-size: 22px;">Fit India Prerak (Level 1)
                    </h2>
                </div>
                <div id="collapseFISW3" class="collapse" aria-labelledby="headingThree" data-parent="#accordionFISW">
                    <div class="card-body ">
                        <div class="row"> 
                            <div class="col-sm-12 col-md-12 text-center medi_gap">              
                                <img src="{{asset('resources/imgs/2dia.jpg') }}" alt="social media specialist" class="fluid-img"/>   
                                         
                            </div>
                           
                        </div>

                        <div class="row"> 
                            <div class="col-sm-12 col-md-6 col-lg-6 ">
                            <div class=" ft_preduo">
                                    <h3>Fit India Prerak </h3>
                                    <div class="line_height"></div>
                                    <h4>Social Media Specialist</h4>
                                </div>   
                                <ul class="ul_div">
                                    <!-- <li>The individual should be the one who practices some form of physical activity such as running, cycling, yoga
                                        etc. for 30 to 60 minutes daily. </li>
                                    <li>The individual should be present on at least one of the social media handles (Facebook, Instagram or
                                        Twitter) must be following Fit India Movement’s Social media handles (@FitIndiaOff) and other hashtags as
                                        decided by Fit India Mission.</li> -->
                                    <li><strong>The individual must have cumulative followers in the range of 1K – 10K on their social media
                                            platforms (Facebook, Twitter, & Instagram).</strong></li>
                                    <!-- <li>The Individual should be at least 18 years of age.</li>
                                    <li>The individual should have taken fitness assessment test on Fit India Mobile App. </li>
                                    <li>The individual should promote Fit India movement by:
                                        <ul class="ul_inner">
                                            <li>Organising or participating on-ground/virtual fitness events wherever possible</li>
                                            <li>Tagging Fit India's Official social media handles in fitness related content created by the
                                                individual.</li>
                                            <li>Uploading the photos of the events organised or participated by the individual by tagging
                                                @FitlndiaOff and other hashtags as decided by Fit India Mission</li>
                                            <li>Reposting/Retweeting the photos/videos of Fit India events and tag @FitlndiaOff and other hashtags
                                                as decided by Fit India Mission</li>                            
                                        </ul>
                                    </li> -->
                                </ul>
                                <div class="text-center">
                                    <a href="register"><button type="button" class="btn  n_btn btn_round g_bg_btn g_bg_btn1 alin_btn ab_btn">Apply</button>
                                    </a>
                                </div>                            
                            </div>
                        
                            <div class="col-sm-12 col-md-6 col-lg-6 b_line bg_colum">
                            <div class="col-sm-12 col-md-12 ft_preduo">
                                    <h3>Fit India Prerak </h3>
                                    <div class="line_height"></div>
                                    <h4>Fitness Event Specialist</h4>
                                </div>   
                                    <ul class="ul_div">
                                        <!-- <li>The individual should be the one who practices some form of physical activity such as running, cycling, yoga etc. for 30 to 60 minutes daily.</li>
                                        <li>The individual should be present on at least one of the social media handles (Facebook, lnstagram or Twitter) and must be following Fit India Movement's Social media handles (@FitlndiaOff) and other hashtags as decided by Fit India Mission.</li> -->
                                        <li><strong>The individual should have organized 3 events with minimum 50 participants each in last 3 years.</strong></li>
                                        <!-- <li>The Individual should be at least 18 years of age.</li>
                                        <li>The individual should have taken fitness assessment test on Fit India Mobile App.</li>
                                        <li>The individual should promote Fit India movement by:
                
                                            <ul class="ul_inner">
                                                <li>Organizing on-ground/virtual fitness events every quarter with at least 50 participants.</li>
                                                <li>Tagging Fit India's Official social media handles in fitness related content created by the individual.</li>
                                                <li>Uploading the photos of the events organized by the individual by tagging @FitIndiaOff and other hashtags as decided by Fit India Mission.</li>
                                                <li>Reposting/Retweeting the photos/videos of Fit India events and tag @FitlndiaOff and other hashtags as decided by Fit India Mission.</li>
                                                
                                            </ul>
                                        </li>   -->
                                    </ul>
                                <div class="text-center">
                                     <a href="register"><button type="button" class="btn  n_btn btn_round alin_btn alin_btn1 ab_btn ab_btn_r2">Apply</button> </a>
                                           
                                </div>      
                                         
                            </div>  
                            <div class="col-sm-12 mt-4">                               
                                <p><strong><sub>*</sub></strong> Once individual becomes Fit India Prerak, a unique referral code wil be generated which can be share with other Individuals by the
                                    <strong>Prerak</strong> to become Ambassador/ Champion.
                                </p>                               
                            </div>
                        </div>     
                    </div>
                </div>
            </div>

           
            <div class="card">
                <div class="card-head" id="headingFour">
                    <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW4" aria-expanded="false"
                        aria-controls="collapseFour">FAQ
                    </h2>
                </div>
                <div id="collapseFISW4" class="collapse" aria-labelledby="headingFour" data-parent="#accordionFISW">
                    <div class="card-body ">
                        <div class="row"> 
                            <div class="col-sm-12 col-md-12 medi_gap">              
                                 <h5>How a Fit India Prerak can become Ambassador/Champion?</h5>
                            </div>
                        </div>

                        <div class="row"> 
                            <div class="col-sm-12 col-md-12 col-lg-12 ">
                               <h6 class="g_bg b-radius sk_btn g_bg_btn f_size r_shape">Fit India Prerak (Social media specialist)</h6><br><br>
                                <p>Fit India Prerak (Social Media Specialist) can become Fit India Ambassador/Champion by Sharing his/her referral code to his/her friends or network and once the people in Fit India Prerak's network apply using his/her referral code, there total followers will get added to original count of Fit India Prerak.</p>
                                
                                <div>
                                    <strong>For Eg.<br></strong> 
                                                                     
                                    <p>A Fit India Prerak has 3K followers. Once a person becomes Fit India Prerak, he/she receives a unique referral code which can be used by his network when they apply to become Fit India Prerak. Let's say 2 people join the program having 4K and 4K followers each through his referral code. When they join using his code, their followers count automatically gets added to Prerak's count which makes his total count as 11 K (3K + 4K +4K). By this way, this Fit India Prerak will become Fit India Ambassador.</p>
                                </div>
                                <br>
                                <h6 class="g_bg b-radius sk_btn g_bg_btn f_size r_shape">Fit India Prerak (Fitness event specialist)</h6>
                                <br><br>
                                    <p>Fit India Prerak (Fitness event specialist) can become Fit India Ambassador/Champion by Sharing his/her referral code to his/her friends or network and once the people in Fit India Prerak's network apply using his/her referral code, there total count will get added to original count of Fit India Prerak.</p>
                                
                                <div>
                                    <strong>For Eg.<br></strong>                                                       
                                    <p>A Fit India Prerak who is a Fitness event specialist can share his/her referral code which can be used by his/her network when they apply to become Fit India Prerak. Let's say 2 people join the program then  highest participant Count will be considered out of the 3 events and once the count crosses 500 participants the individual will become Fit India Ambassador.</p>
                                </div>                                                          
                            </div> 
                        </div>     
                    </div>
                </div>
            </div>
 
    
    </div>
    </div>


    </section>

@endsection