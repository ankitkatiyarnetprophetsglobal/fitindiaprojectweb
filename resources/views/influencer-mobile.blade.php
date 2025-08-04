@extends('Influencerlayout.app') 

@section('title', 'Influencer | Fit-India ')
@section('content')

    <div>
        <img src="{{ asset('resources/imgs/inflencer.png') }}" alt="Inflencer"
            title="Inflencer" class="img-fluid expand_img" />			<!-- <h1 style="font-size:1px; color:#fff;">Share Your Story</h1> -->
    </div>
    <section>
    <div class="container">  
    <div class="row">
            <div class="col-sm-12 col-md-12 ">
                     
                    <a href="prerak_list" class="btn  n_btn btn_round o_bg btn_width btn_hover_eff prerak_btn" target="_blank">Prerak</a>
                    <a href="fit-india-ambassador" class="btn  n_btn btn_round b_bg btn_width ambas_btn " target="_blank">Ambassador</a> 
                    <a href="fit-india-champions" class="btn  n_btn btn_round g_bg btn_width cham_btn" target="_blank">Champion</a>                      
                    <a href="http://103.65.20.170/fitind/wp-content/uploads/doc/guildline_for_influencer.pdf" class="btn  n_btn btn_round p_bg btn_width guid_btn" target="_blank">Guidelines</a> 
                    
                 
                    <br> 
                    
                    <h2 class="i_h2" >Fit India Influencer (3 levels)</h2>
                    <h3 class="i_h3" style="color:#f06f11;">Fit India Prerak</h3>
                    <h3 class="i_h3" style="color:#119ff1;">Fit India Ambassador</h3>
                    <h3 class="i_h3" style="color:#0bb078;">Fit India Champion</h3>
                    <br>


              </div>
            
        </div>
        <div class="row">              
   
    
    
    <div class="col-md-12">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" >
                 <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Fit India Prerak
                    </a> 
               </h2>
    
            </div>
            <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <div class="row"> 
            <div class="col-sm-12 col-md-12 text-center">
                <br>
                <img src="{{asset('resources/imgs/2dia.jpg') }}" alt="social media specialist" class="fluid-img"/>
                <br></br>
            </div>
        </div>
 
        <div class="row"> 
            <div class="col-sm-12 col-md-6 col-lg-6 ">
                <ul class="ul_div">
                    <li>The individual should be the one who practices some form of physical activity such as running, cycling, yoga etc. for 30 to 60 minutes daily. </li>
                    <li>The individual should be present on at least one of the social media handles (Facebook, Instagram or Twitter) must be following Fit India Movement’s Social media handles (@FitIndiaOff) and other hashtags as decided by Fit India Mission.</li>
                    <li><strong>The individual must have cumulative followers in the range of  1K – 10K  on their social media platforms (Facebook, Twitter, & Instagram).</strong></li>
                    <li>The Individual should be at least 18 years of age.</li>
                    <li>The individual should have taken fitness assessment test on Fit India Mobile App. </li>
                    <li>The individual should promote Fit India movement by:
                        <ul class="ul_inner">
                            <li>Organising or participating on-ground/virtual fitness events wherever possible</li>
                            <li>Tagging Fit India's Official social media handles in fitness related content created by the individual.</li>
                            <li>Uploading the photos of the events organised or participated by the individual by tagging @FitlndiaOff and other hashtags as decided by Fit India Mission</li>
                            <li>Reposting/Retweeting the photos/videos of Fit India events and tag @FitlndiaOff and other hashtags as decided by Fit India Mission</li>
                            
                        </ul>
                    </li>  
                    </ul>
                    <div class="text-center">
                    <a href="register"><button type="button" class="btn  n_btn btn_round g_bg_btn g_bg_btn1 alin_btn">Apply</button> </a>              
                    </div>

            </div>
        
            <div class="col-sm-12 col-md-6 col-lg-6 b_line">
                    <ul class="ul_div">
                        <li>The individual should be the one who practices some form of physical activity such as running, cycling, yoga etc. for 30 to 60 minutes daily.</li>
                        <li>The individual should be present on at least one of the social media handles (Facebook, lnstagram or Twitter) and must be following Fit India Movement's Social media handles (@FitlndiaOff) and other hashtags as decided by Fit India Mission.</li>
                        <li><strong>The individual should have organized 3 events with minimum 50 participants each in last 3 years.</strong></li>
                        <li>The Individual should be at least 18 years of age.</li>
                        <li>The individual should have taken fitness assessment test on Fit India Mobile App.</li>
                        <li>The individual should promote Fit India movement by:

                            <ul class="ul_inner">
                                <li>Organizing on-ground/virtual fitness events every quarter with at least 50 participants.</li>
                                <li>Tagging Fit India's Official social media handles in fitness related content created by the individual.</li>
                                <li>Uploading the photos of the events organized by the individual by tagging @FitIndiaOff and other hashtags as decided by Fit India Mission.</li>
                                <li>Reposting/Retweeting the photos/videos of Fit India events and tag @FitlndiaOff and other hashtags as decided by Fit India Mission.</li>
                                
                            </ul>
                        </li>  
                    </ul>
                <div class="text-center">
                     <a href="register"><button type="button" class="btn  n_btn btn_round alin_btn alin_btn1">Apply</button> </a>
                           
                </div>      
                         
            </div>  
            <div class="col-sm-12">
                <br/><br/><br/>
                <p><strong><sub>*</sub></strong> Once individual becomes Fit India Prerak, a unique referral code wil be generated which can be share with other Individuals by the
                    <strong>Prerak</strong> to become Ambassador/ Champion.
                </p>
                <br> <br>
            </div>
        </div>          
        </div>
                </div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" >
                 <h2 class="panel-title">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Fit India Ambassador
            </a>
          </h2>
    
            </div>


            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">

                    <div class="row">
            <div class="col-sm-12">
                
                    
                    <div class="col-sm-12 col-md-12 text-center">
                <br>
                <img src="{{asset('resources/imgs/2ambass.jpg') }}" alt="social media specialist" class="fluid-img"/>
                <br></br>
            </div>
               
               <br> <br>
            <div class="row"> 
            <div class="col-sm-12 col-md-6 col-lg-6 ">
                <ul class="ul_div">
                    <li>The individual should be the one who practices some form of physical activity such as running, cycling, yoga etc. for 30 to 60 minutes daily. </li>
                    <li>The individual should be present on at least one of the social media handles (Facebook, Instagram or Twitter) must be following Fit India Movement’s Social media handles (@FitIndiaOff) and other hashtags as decided by Fit India Mission.</li>
                    <li> <strong>The individual must have cumulative followers in the range of 10K — 100K on their social media platforms (Facebook, Twitter, & Instagram) either by themselves or by adding the followers of Fit India Preraks who will joined by his/her referral code.</strong></li>
                    <li>The Individual should be at least 18 years of age.</li>
                    <li>The individual should have taken fitness assessment test on Fit India Mobile App. </li>
                    <li>The individual should promote Fit India movement by:
                        <ul class="ul_inner">
                            <li>Organising or participating on-ground/virtual fitness events wherever possible</li>
                            <li>Tagging Fit India's Official social media handles in fitness related content created by the individual.</li>
                            <li>Uploading the photos of the events organised or participated by the individual by tagging @FitlndiaOff and other hashtags as decided by Fit India Mission</li>
                            <li>Reposting/Retweeting the photos/videos of Fit India events and tag @FitlndiaOff and other hashtags as decided by Fit India Mission</li>
                            
                        </ul>
                    </li>  
                    </ul>
                    <div class="text-center">
                    <a href="register"><button type="button" class="btn  n_btn btn_round g_bg_btn g_bg_btn1 alin_btn">Apply</button> </a>              
                    </div>

            </div>
        
            <div class="col-sm-12 col-md-6 col-lg-6 b_line">
                    <ul class="ul_div">
                        <li>The individual should be the one who practices some form of physical activity such as running, cycling, yoga etc. for 30 to 60 minutes daily.</li>
                        <li>The individual should be present on at least one of the social media handles (Facebook, lnstagram or Twitter) and must be following Fit India Movement's Social media handles (@FitlndiaOff) and other hashtags as decided by Fit India Mission.</li>
                        <li><strong>The Individual must have organised 3 events with min 500 participants each in last 3 years either by themselves or by adding the participants of Fit India Preraks who have joined by his/her referral code.</strong></li>
                        <span><strong>(Highest Participant Count will be considered out of the 3 events).</span></strong>
                        <li>The Individual should be at least 18 years of age.</li>
                        <li>The individual should have taken fitness assessment test on Fit India Mobile App.</li>
                        <li>The individual should promote Fit India movement by:

                            <ul class="ul_inner">
                                <li>Organizing on-ground/virtual fitness events every quarter with at least 50 participants.</li>
                                <li>Tagging Fit India's Official social media handles in fitness related content created by the individual.</li>
                                <li>Uploading the photos of the events organized by the individual by tagging @FitIndiaOff and other hashtags as decided by Fit India Mission.</li>
                                <li>Reposting/Retweeting the photos/videos of Fit India events and tag @FitlndiaOff and other hashtags as decided by Fit India Mission.</li>
                                
                            </ul>
                        </li>  
                    </ul>
                <div class="text-center">
                     <a href="register"><button type="button" class="btn  n_btn btn_round alin_btn alin_btn1">Apply</button> </a>
                           
                </div>      
                         
            </div>  

            <div class="row">
            <div class="col-sm-12">
            <br>
                <h4 class="text_head_uline text-center"> <u>Illustration : Prerak to Ambassador</u> </h4>
                <br><br> <br><br>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                <!-- <h5 >Fit India Ambassador</h5>
               
                <p><strong>(social media specialist)</strong></p> -->
                <img src="{{asset('resources/imgs/3dia.jpg') }}" alt="social media specialist" class="fluid-img"/>
                <p>The individual must have cumulative followers in the range of 10K — 100K on their social media platforms (Facebook, Twitter, & Instagram) either by themselves or by adding the followers of Fit India Preraks who will joined by his/her referral code.</p>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-6 b_line text-center">
                <!-- <h5 class="text-center">Fit India Ambassador</h5>
                <p><strong>(fitness event specialist)</strong></p>
                <br> -->
                <img src="{{asset('resources/imgs/3sec_dia2.jpg') }}" alt="fitness event specialist" class="fluid-img"/>
                <p>The Individual must have organised 3 events with min 500 participants each in last 3 years either by themselves or by adding the participants of Fit India Preraks who have joined by his/her referral code.</p>
                <span>(Highest Participant Count will be considered out of the 3 events).</span>
            </div>
            <div class="col-sm-12">
                <br/>
                
                <br> 
            </div>
        </div>          
        </div>
                </div>
            </div>
        </div>
        </div>
                          
                </div>
            </div>
        </div>




        <div class="panel panel-default lastpanel">
            <div class="panel-heading" role="tab" >
                 <h3 class="panel-title">
                 <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Fit India Champion
                 </a>
          </h3>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
    
                <div class="panel-body">
                  <div class="row">
            <div class="col-sm-12">
            <div class="col-sm-12 col-md-12 text-center">
                <br>
                <img src="{{asset('resources/imgs/2champ.jpg') }}" alt="social media specialist" class="fluid-img"/>
                <br></br>
            </div>
            <br> </br>
            
               <div class="row"> 
            <div class="col-sm-12 col-md-6 col-lg-6 ">
                <ul class="ul_div">
                    <li>The individual should be the one who practices some form of physical activity such as running, cycling, yoga etc. for 30 to 60 minutes daily. </li>
                    <li>The individual should be present on at least one of the social media handles (Facebook, Instagram or Twitter) must be following Fit India Movement’s Social media handles (@FitIndiaOff) and other hashtags as decided by Fit India Mission.</li>
                    <li><strong> The individual must have cumulative followers in the range of 100K — 1M on their social media platforms (Facebook, Twitter, & Instagram) either by themselves or by adding the followers of Fit India Preraks/Ambassadors who will joined by his/her referral code.</strong></li>
                    <li>The Individual should be at least 18 years of age.</li>
                    <li>The individual should have taken fitness assessment test on Fit India Mobile App. </li>
                    <li>The individual should promote Fit India movement by:
                        <ul class="ul_inner">
                            <li>Organising or participating on-ground/virtual fitness events wherever possible</li>
                            <li>Tagging Fit India's Official social media handles in fitness related content created by the individual.</li>
                            <li>Uploading the photos of the events organised or participated by the individual by tagging @FitlndiaOff and other hashtags as decided by Fit India Mission</li>
                            <li>Reposting/Retweeting the photos/videos of Fit India events and tag @FitlndiaOff and other hashtags as decided by Fit India Mission</li>
                            
                        </ul>
                    </li>  
                    </ul>
                    <div class="text-center">
                    <a href="register"><button type="button" class="btn  n_btn btn_round g_bg_btn g_bg_btn1 alin_btn">Apply</button> </a>              
                    </div>

            </div>
        
            <div class="col-sm-12 col-md-6 col-lg-6 b_line">
                    <ul class="ul_div">
                        <li>The individual should be the one who practices some form of physical activity such as running, cycling, yoga etc. for 30 to 60 minutes daily.</li>
                        <li>The individual should be present on at least one of the social media handles (Facebook, lnstagram or Twitter) and must be following Fit India Movement's Social media handles (@FitlndiaOff) and other hashtags as decided by Fit India Mission.</li>
                        <li><strong>The Individual must have organised 3 events with min 1500 participants each in last 3 years either by themselves or by adding the participants of Fit India Preraks who have joined by his/her referral code.</strong></li>
                        <span><strong>(Highest Participant Count will be considered out of the 3 events).</span></strong>
                        <li>The Individual should be at least 18 years of age.</li>
                        <li>The individual should have taken fitness assessment test on Fit India Mobile App.</li>
                        <li>The individual should promote Fit India movement by:

                            <ul class="ul_inner">
                                <li>Organizing on-ground/virtual fitness events every quarter with at least 50 participants.</li>
                                <li>Tagging Fit India's Official social media handles in fitness related content created by the individual.</li>
                                <li>Uploading the photos of the events organized by the individual by tagging @FitIndiaOff and other hashtags as decided by Fit India Mission.</li>
                                <li>Reposting/Retweeting the photos/videos of Fit India events and tag @FitlndiaOff and other hashtags as decided by Fit India Mission.</li>
                                
                            </ul>
                        </li>  
                    </ul>
                <div class="text-center">
                     <a href="register"><button type="button" class="btn  n_btn btn_round alin_btn alin_btn1">Apply</button> </a>
                           
                </div>      
                         
            </div>  
            <div class="col-sm-12">
                <br/>
                
                <br>
            </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
            <br><br>
                <h4 class="text_head_uline text-center"> <u>Illustration : Prerak to Champion</u><br><br> </h4>
                <br>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                <!-- <h5>Fit India Champion</h5>
                <p><strong>(social media specialist)</strong></p> -->
                <img src="{{asset('resources/imgs/4dia.jpg') }}" alt="social media specialist" class="fluid-img"/>
                <br>
                <p>The individual must have cumulative followers in the range of 100K — 1M on their social media platforms (Facebook, Twitter, & Instagram) either by themselves or by adding the followers of Fit India Preraks/Ambassadors who will joined by his/her referral code.</p>
            </div>
            
            <div class="col-sm-6 col-md-6 col-lg-6 text-center b_line">
                <!-- <h5>Fit India Champion</h5>
                <p><strong>(fitness event specialist)</strong></p> -->
                <img src="{{asset('resources/imgs/4_sec2.jpg') }}" alt="fitness event specialist" class="fluid-img"/>
                <br>
                <p>The Individual must have organised 3 events with min 1500 participants each in last 3 years either by themselves or by adding the participants of Fit India Preraks who have joined by his/her referral code.</p> 
                <p><span>(Highest Participant Count will be considered out of the 3 events).</span></p>
            </div>
            <div class="col-sm-12">
                <br/>
                
            </div>
            </div>
                    </div>
                </div>
            </div>
            </div>

         
        
         <div style= "padding-top:10px;" class="panel-default">
            <div class="panel-heading" role="tab" >
                 <h2 class="panel-title">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                FAQ
            </a>
          </h2>
    
            </div>


            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseFour">
                <div class="panel-body">
                                <br>
                                <h4>How a Fit India Prerak can become Ambassador/Champion</h4>
                                <br><br>
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


    </section>

@endsection