@extends('layouts.app')
@section('title', 'Yoga Center | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp

<div>

        <img src="resources/imgs/home/yoga.jpg" alt="yoga_center"
            title="yoga_center" class="img-fluid expand_img" />
    </div>

<div>

<h1 class="yogaHeading">FIT INDIA YOGA CENTRES</h1>

       

</div> 

<div class="container-fluid yoga_cont">

<section id="{{ $active_section_id }}">


    <div class="row">
    
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_1"> <strong>Shri Ambika Yoga Kutir</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>shriambikayogakutir@gmail.com</span></p>
                   <p><strong>Website   </strong><span>www.ambikayogkutir.org</span></p>
                   <p class="sty-spn">
                       <strong>Address  </strong>
                       <span>B. K. Mill Compund, Eenatai Thackrey Chowk, Thane (W), Maharashtra - 400601</span>
                    </p>                            
               </div>
            </div>            
        </div>
        

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_2"> <strong>Paramanand University Trust</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>babaom@gmail.com</span></p>
                   <p><strong>Website   </strong><span>www.paramyoga.org</span></p>
                    <p class="sty-spn">
                        <strong>Address  </strong>
                        <span>Limbodi Newar new Digmbar Public School, Khandwa Road, Indore, 452020, MP</span>
                        </p> 
               </div>
            </div>            
        </div>
    

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_3"> <strong>Patanjali Yogpeeth (Trust)</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>patanjaliyog@bharatswabhimantrust.org</span></p>
                   <p><strong>Website   </strong><span>www.divyayoga.com</span></p>
                   <p class="sty-spn">
                       <strong>Address  </strong>
                       <span>Maharshi Dayand Marg, Near Bahadrabad, Haridwar – 249405 Uttarakhand </span>
                    </p>                            
               </div>
            </div>            
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_4 "> <strong>Swami Vivekananda Yoga Anusandhana Samsthana</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>registrat@svyasa.edu.in</span></p>
                   <p><strong>Website   </strong><span>www.svyasa.edu.in</span></p>
                   <p class="sty-spn">
                       <strong>Address  </strong>
                       <span>Eknath Bhavan, #19, Gavipuram Circle, Kempegowda Nagar, Bangalore - 560019 </span>
                    </p>                            
               </div>
            </div>            
        </div>

   
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_5 "> <strong>Kaivalyadhama Shriman Madhav Yoga Mandir Samiti</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>ceooffice@kdham.com</span></p>
                   <p><strong>Website   </strong><span>www.kdham.com</span></p>
                   <p class="sty-spn">
                       <strong>Address  </strong>
                       <span>Swami Kuvalayananda Marg, Lonavla - 410403, Maharashtra </span>
                    </p>                            
               </div>
            </div>            
        </div>
        
    

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_6 "> <strong>Krishnamacharya Yoga Mandiram</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>mails@kym.org</span></p>
                   <p><strong>Website   </strong><span>www.kym.org</span></p>
                   <p class="sty-spn ">
                       <strong>Address  </strong>
                       <span>No. 31, Fourth Cross Street. RK Nagar, Mandaveli, Chennai, Tamilnadu - 600028 </span>
                    </p>                            
               </div>
            </div>            
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_7"> <strong>Yoga Vidya Gurukul</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>yogavidyagurukw@gmail.com</span></p>
                   <p><strong>Website   </strong><span>www.yogavidyagurukul.org</span></p>
                   <p class="sty-spn ">
                       <strong>Address  </strong>
                       <span>Yoga Bhawan, College Road, Nashik - 422005 </span>
                    </p>                            
               </div>
            </div>            
        </div>

        
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_8"> <strong>Morarji Desai National Institute of Yoga</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>mdniy@yahoo.co.in</span></p>
                   <p><strong>Website   </strong><span>www.yogamdniy.nic.in</span></p>
                   <p class="sty-spn ">
                       <strong>Address </strong>
                       <span>68, Ashok Road, Opp. Gole Dak Khana, New Delhi - 110001</span>
                    </p>                            
               </div>
            </div>            
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_9"> <strong>Lovely Professional University</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>vc.office@ipu.co.in</span></p>
                   <p><strong>Website   </strong><span>www.yogamdniy.nic.in</span></p>
                   <p class="sty-spn ">
                       <strong>Address </strong>
                       <span>Jalandhar - Delhi G. T. Road, Phagwara, Distt. Kapurthala - 144411, Punjab</span>
                    </p>                            
               </div>
            </div>            
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_10"> <strong>New Age Yoga Institute</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>nitinpatki8@gmail.com </span></p>
                   <p><strong>Website   </strong><span>www.newageyoga.in</span></p>
                   <p class="sty-spn ">
                       <strong>Address </strong>
                       <span>C-1, Shrikunj Premises Coop Scty, Hanuman Road, Vile Parle (East), Mumbai - 400057</span>
                    </p>                            
               </div>
            </div>            
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_11"> <strong>Sunderbai Phoolchand Ji Adarsh Shiksha Sansthan</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>antimjain@gmail.com </span></p>
                   <p><strong>Website   </strong><span>www.sbpass.org.</span></p>
                   <p class="sty-spn ">
                       <strong>Address </strong>
                       <span>61 Bairath Colony No. 2,Indore - 452014</span>
                    </p>                            
               </div>
            </div>            
        </div>


        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_12"> <strong>Sivananda Yoga Vedanta Dhanwantari Ashram Trust</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>prahlada@sivananda.org</span></p>
                   <p><strong>Website   </strong><span>http//sivananda.org.</span></p>
                   <p class="sty-spn ">
                       <strong>Address </strong>
                       <span>Sivananda Yoga Vedanta Dhanwantari Ashram, PO Neyyar Dam, Trivandrum,  Kerala - 695572</span>
                    </p>                            
               </div>
            </div>            
        </div> 
        
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_1"> <strong>Sivananda Yoga Vedanta Meenakshi Ashram</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id </strong><span>annop@sivananda.org </span></p>
                   <p><strong>Website </strong><span>http//sivananda.org.in</span></p>
                   <p class="sty-spn ">
                       <strong>Address </strong>
                       <span>Near Pavanna Vilakku Junction, New Natham Road, Saramthangi village, Madurai 625503, Tamil Nadu</span>
                    </p>                            
               </div>
            </div>            
        </div> 
        
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_2"> <strong>Aaryaveer Yog Evm Prakartik Chikitsa Sansthan</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>umendrasinghbly@gmail.com</span> </p>
                   <p><strong>Website   </strong><span>www.ayeper.com</span></p>
                   <p><strong>Mobile no.</strong><span>9720016861, 7017763828</span></p>
                   <p class="sty-spn">
                       <strong>Address </strong>
                       <span>48, Gautam Kailash Colony, Badaun Road, Kargaina, Bareilly, Uttar Pradesh - 243001</span>
                    </p>                            
               </div>
            </div>            
        </div> 

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_3"> <strong>The Banaras Educational & Social Trust</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>banarastrust@gmail.com</span></p>
                   <p><strong>Website   </strong><span>www.banarastrust.org</span></p>
                   <p class="sty-spn">
                       <strong>Address </strong>
                       <span>Lane No. 3, House No. 49, Bhaktinagar, Pandeypur, Varanasi, UP - 221002</span>
                    </p>                            
               </div>
            </div>            
        </div> 


        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_4"> <strong>BSS Yoga Training Center</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>bsswfsrewa@gmail.com</span></p>
                   <p><strong>Website   </strong><span>www.bssrewa.com</span></p>
                   <p><strong>Mobile no.</strong><span>7697975350, 9425962874</span></p>
                   <p class="sty-spn">
                       <strong>Address </strong>
                       <span>University Road, Behind of Agrawal Nurshing Home, Khuthe, Rewa, MP – 486001</span>
                    </p>                            
               </div>
            </div>            
        </div> 


        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_5"> <strong>Datta Kriya Yoga International Centre</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>dkycenter@gmail.com</span></p>
                   <p><strong>Website   </strong><span>www.dattakriyayoga.org</span></p>
                   <p class="sty-spn">
                       <strong>Address </strong>
                       <span>Sri Ganapathy Sachchidananda Ashram, Avadhoota Datta Peetham, Mysuru, Karnataka – 570025 </span>
                    </p>                            
               </div>
            </div>            
        </div> 

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_6"> <strong>Jagriti Yog and Naturopathy Sansthan, Mahila Kalyan Evam Gramotthan Samiti</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>mkagsngo@gmail.com</span></p>
                   <p><strong>Website   </strong><span>www.yogajagriti.com</span></p>
                   <p class="sty-spn">
                       <strong>Address </strong>
                       <span>Yaduvansh Nagar, Near Shiv Mandir, Agra Bypass Road, Shikohabad, Disstt. Firozabad, UP - 283135</span>
                    </p>                            
               </div>
            </div>            
        </div> 

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_7"> <strong>Maa Baliraji Yog Sansthan</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>maabaliraji@gmail.com</span></p>
                   <p><strong>Website   </strong><span>www.myyoga.co.in</span></p>
                   <p><strong>Mobile no.</strong><span>7234000491</span></p>
                   <p class="sty-spn">
                       <strong>Address </strong>
                       <span>Hargarh Bazar, Mirzapur, UP - 231313</span>
                    </p>                            
               </div>
            </div>            
        </div> 

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_8"> <strong>Shaurya Prakritik Chikitsa Evem Yoga Sansthan</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>shaurya271201@gmail.com</span></p>
                   <p><strong>Website   </strong><span>http//shauryapcyss.org/</span></p>
                   <p class="sty-spn">
                       <strong>Address </strong>
                       <span>Sekhui Kala, bipass Dhusah Balrampur, Uttar Pradesh Pin-271201</span>
                    </p>                            
               </div>
            </div>            
        </div> 

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_9"> <strong>Yogaathma Foundation</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>yogigowd@gmail.com</span></p>
                   <p><strong>Website   </strong><span>www.sohamashram.org</span></p>
                   <p class="sty-spn">
                       <strong>Address </strong>
                       <span>Survey No. 7, Aladhakate Village, Kudur Hobli, Magadi Taluk, Ramanagar District, Karnatak State - 562127</span>
                    </p>                            
               </div>
            </div>            
        </div> 



        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_10"> <strong>Yoga Wellness Center</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>rajkamal.yoga@gmail.com</span></p>
                   <!-- <p><strong>Website   </strong>www.sohamashram.org</p> -->
                   <p class="sty-spn">
                       <strong>Address </strong>
                       <span>2C-112, 2nd Cross Road, East of NGEF Layout, Kasturi Nagar, Bangalore, Karnataka – 560043</span>
                    </p>                            
               </div>
            </div>            
        </div> 


        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_11"> <strong>Bhaskara Institute of Yoga and Research Centre Society</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>bhaskarainstitute@gmail.com</span></p>
                   <p><strong>Website   </strong><span>www.bhaskarainstitute.org</span></p>
                   <p class="sty-spn">
                       <strong>Address </strong>
                       <span>GTWRA 61, Life Vila, Changampuzha Samadhi Road, Edappally PO, Kochi, Kerala - 682024</span>
                    </p>                            
               </div>
            </div>            
        </div> 

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_12"> <strong>The Satsang Foundation (Bharat Yoga Vidya Kendra)</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>mdpoffice@satsang-fondation.org </span> </p>
                   <!-- <p><strong>Website   </strong>www.bhaskarainstitute.org</p> -->
                   <p class="sty-spn">
                       <strong>Address </strong>
                       <span>GTWRA 61, Life Vila, Changampuzha Samadhi Road, Edappally PO, Kochi, Kerala - 682024</span>
                    </p>                            
               </div>
            </div>            
        </div> 

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_13"> <strong>Adiveda Research Institute of Yoga Science and Naturopathy</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id  </strong><span>manojsurendran111@gmail.com </span></p>
                   <!-- <p><strong>Website   </strong>www.bhaskarainstitute.org</p> -->
                   <p class="sty-spn">
                       <strong>Address </strong>
                       <span>SNDP Building, Mariyappally, Nattakom, Kottayam, Kerala – 686023</span>
                    </p>                            
               </div>
            </div>            
        </div> 


        


























    </div>
</div> 
</section>


@endsection

