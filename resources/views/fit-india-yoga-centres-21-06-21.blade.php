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

<h1 style="margin-top:40px; color:#434343; font-size:34px; text-align:center;">FIT INDIA YOGA CENTRES</h1>

       

</div> 

<div class="container">

<section id="{{ $active_section_id }}">


    <div class="row">
    
        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_1"> <strong>Shri Ambika Yoga Kutir</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>shriambikayogakutir@gmail.com</p>
                   <p><strong>Website :  </strong>www.ambikayogkutir.org</p>
                   <p class="sty-spn">
                       <strong>Address :</strong>
                       <span>B. K. Mill Compund, Eenatai Thackrey Chowk, Thane (W), Maharashtra - 400601</span>
                    </p>                            
               </div>
            </div>            
        </div>
        

        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_2"> <strong>Paramanand University Trust</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>babaom@gmail.com</p>
                   <p><strong>Website :  </strong>www.paramyoga.org</p>
                   <p class="sty-spn">
                       <strong>Address :</strong>
                       <span>Limbodi Newar new Digmbar Public School, Khandwa Road, Indore, 452020, MP</span>
                    </p>                            
               </div>
            </div>            
        </div>
    

        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_3"> <strong>Patanjali Yogpeeth (Trust)</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>patanjaliyog@bharatswabhimantrust.org</p>
                   <p><strong>Website :  </strong>www.divyayoga.com</p>
                   <p class="sty-spn">
                       <strong>Address :</strong>
                       <span>Maharshi Dayand Marg, Near Bahadrabad, Haridwar – 249405 Uttarakhand </span>
                    </p>                            
               </div>
            </div>            
        </div>

        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_4 "> <strong>Swami Vivekananda Yoga Anusandhana Samsthana</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>registrat@svyasa.edu.in</p>
                   <p><strong>Website :  </strong>www.svyasa.edu.in</p>
                   <p class="sty-spn">
                       <strong>Address :</strong>
                       <span>Eknath Bhavan, #19, Gavipuram Circle, Kempegowda Nagar, Bangalore - 560019 </span>
                    </p>                            
               </div>
            </div>            
        </div>

   
        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_5 "> <strong>Kaivalyadhama Shriman Madhav Yoga Mandir Samiti</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>ceooffice@kdham.com</p>
                   <p><strong>Website :  </strong>www.kdham.com</p>
                   <p class="sty-spn">
                       <strong>Address :</strong>
                       <span>Swami Kuvalayananda Marg, Lonavla - 410403, Maharashtra </span>
                    </p>                            
               </div>
            </div>            
        </div>
        
    

        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_6 "> <strong>Krishnamacharya Yoga Mandiram</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>mails@kym.org</p>
                   <p><strong>Website :  </strong>www.kym.org</p>
                   <p class="sty-spn ">
                       <strong>Address :</strong>
                       <span>No. 31, Fourth Cross Street. RK Nagar, Mandaveli, Chennai, Tamilnadu - 600028 </span>
                    </p>                            
               </div>
            </div>            
        </div>

        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_7"> <strong>Yoga Vidya Gurukul</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>yogavidyagurukw@gmail.com</p>
                   <p><strong>Website :  </strong>www.yogavidyagurukul.org</p>
                   <p class="sty-spn ">
                       <strong>Address :</strong>
                       <span>Yoga Bhawan, College Road, Nashik - 422005 </span>
                    </p>                            
               </div>
            </div>            
        </div>

        
        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_8"> <strong>Morarji Desai National Institute of Yoga</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>mdniy@yahoo.co.in</p>
                   <p><strong>Website :  </strong>www.yogamdniy.nic.in</p>
                   <p class="sty-spn ">
                       <strong>Address :</strong>
                       <span>68, Ashok Road, Opp. Gole Dak Khana, New Delhi - 110001</span>
                    </p>                            
               </div>
            </div>            
        </div>

        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_9"> <strong>Lovely Professional University</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>vc.office@ipu.co.in</p>
                   <p><strong>Website :  </strong>www.yogamdniy.nic.in</p>
                   <p class="sty-spn ">
                       <strong>Address :</strong>
                       <span>Jalandhar - Delhi G. T. Road, Phagwara, Distt. Kapurthala - 144411, Punjab</span>
                    </p>                            
               </div>
            </div>            
        </div>

        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_10"> <strong>New Age Yoga Institute</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>nitinpatki8@gmail.com </p>
                   <p><strong>Website :  </strong>www.newageyoga.in</p>
                   <p class="sty-spn ">
                       <strong>Address :</strong>
                       <span>C-1, Shrikunj Premises Coop Scty, Hanuman Road, Vile Parle (East), Mumbai - 400057</span>
                    </p>                            
               </div>
            </div>            
        </div>

        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_11"> <strong>Sunderbai Phoolchand Ji Adarsh Shiksha Sansthan</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>antimjain@gmail.com </p>
                   <p><strong>Website :  </strong>www.sbpass.org.in</p>
                   <p class="sty-spn ">
                       <strong>Address :</strong>
                       <span>61 Bairath Colony No. 2,Indore - 452014</span>
                    </p>                            
               </div>
            </div>            
        </div>


        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_12"> <strong>Sivananda Yoga Vedanta Dhanwantari Ashram Trust</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>prahlada@sivananda.org </p>
                   <p><strong>Website :  </strong>http://sivananda.org.in</p>
                   <p class="sty-spn ">
                       <strong>Address :</strong>
                       <span>Sivananda Yoga Vedanta Dhanwantari Ashram, PO Neyyar Dam, Trivandrum,  Kerala - 695572</span>
                    </p>                            
               </div>
            </div>            
        </div> 
        
        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_1"> <strong>Sivananda Yoga Vedanta Meenakshi Ashram</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id :</strong>annop@sivananda.org </p>
                   <p><strong>Website :</strong>http://sivananda.org.in</p>
                   <p class="sty-spn ">
                       <strong>Address :</strong>
                       <span>Near Pavanna Vilakku Junction, New Natham Road, Saramthangi village, Madurai 625503, Tamil Nadu</span>
                    </p>                            
               </div>
            </div>            
        </div> 
        
        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_2"> <strong>Aaryaveer Yog Evm Prakartik Chikitsa Sansthan</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>umendrasinghbly@gmail.com </p>
                   <p><strong>Website :  </strong>www.ayeper.com</p>
                   <p class="sty-spn">
                       <strong>Address :</strong>
                       <span>48, Gautam Kailash Colony, Badaun Road, Kargaina, Bareilly, Uttar Pradesh - 243001</span>
                    </p>                            
               </div>
            </div>            
        </div> 

        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_3"> <strong>The Banaras Educational & Social Trust</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>banarastrust@gmail.com</p>
                   <p><strong>Website :  </strong>www.banarastrust.org</p>
                   <p class="sty-spn">
                       <strong>Address :</strong>
                       <span>Lane No. 3, House No. 49, Bhaktinagar, Pandeypur, Varanasi, UP - 221002</span>
                    </p>                            
               </div>
            </div>            
        </div> 


        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_4"> <strong>BSS Yoga Training Center</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>bsswfsrewa@gmail.com</p>
                   <p><strong>Website :  </strong>www.banarastrust.org</p>
                   <p class="sty-spn">
                       <strong>Address :</strong>
                       <span>University Road, Behind of Agrawal Nurshing Home, Khuthe, Rewa, MP – 486001</span>
                    </p>                            
               </div>
            </div>            
        </div> 


        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_5"> <strong>Datta Kriya Yoga International Centre</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>dkycenter@gmail.com</p>
                   <p><strong>Website :  </strong>www.dattakriyayoga.org</p>
                   <p class="sty-spn">
                       <strong>Address :</strong>
                       <span>Sri Ganapathy Sachchidananda Ashram, Avadhoota Datta Peetham, Mysuru, Karnataka – 570025 </span>
                    </p>                            
               </div>
            </div>            
        </div> 

        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_6"> <strong>Jagriti Yog and Naturopathy Sansthan, Mahila Kalyan Evam Gramotthan Samiti</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>mkagsngo@gmail.com</p>
                   <p><strong>Website :  </strong>www.yogajagriti.com</p>
                   <p class="sty-spn">
                       <strong>Address :</strong>
                       <span>Yaduvansh Nagar, Near Shiv Mandir, Agra Bypass Road, Shikohabad, Disstt. Firozabad, UP - 283135</span>
                    </p>                            
               </div>
            </div>            
        </div> 

        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_7"> <strong>Maa Baliraji Yog Sansthan</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>maabaliraji@gmail.com</p>
                   <p><strong>Website :  </strong>www.mbys.in</p>
                   <p class="sty-spn">
                       <strong>Address :</strong>
                       <span>Hargarh Bazar, Mirzapur, UP - 231313</span>
                    </p>                            
               </div>
            </div>            
        </div> 

        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_8"> <strong>Shaurya Prakritik Chikitsa Evem Yoga Sansthan</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>shaurya271201@gmail.com</p>
                   <p><strong>Website :  </strong>http://shauryapcyss.org/</p>
                   <p class="sty-spn">
                       <strong>Address :</strong>
                       <span>Sekhui Kala, bipass Dhusah Balrampur, Uttar Pradesh Pin-271201</span>
                    </p>                            
               </div>
            </div>            
        </div> 

        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_9"> <strong>Yogaathma Foundation</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>yogigowd@gmail.com</p>
                   <p><strong>Website :  </strong>www.sohamashram.org</p>
                   <p class="sty-spn">
                       <strong>Address :</strong>
                       <span>Survey No. 7, Aladhakate Village, Kudur Hobli, Magadi Taluk, Ramanagar District, Karnatak State - 562127</span>
                    </p>                            
               </div>
            </div>            
        </div> 



        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_10"> <strong>Yoga Wellness Center</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>rajkamal.yoga@gmail.com</p>
                   <!-- <p><strong>Website :  </strong>www.sohamashram.org</p> -->
                   <p class="sty-spn">
                       <strong>Address :</strong>
                       <span>2C-112, 2nd Cross Road, East of NGEF Layout, Kasturi Nagar, Bangalore, Karnataka – 560043</span>
                    </p>                            
               </div>
            </div>            
        </div> 


        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_11"> <strong>Bhaskara Institute of Yoga and Research Centre Society</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>bhaskarainstitute@gmail.com</p>
                   <p><strong>Website :  </strong>www.bhaskarainstitute.org</p>
                   <p class="sty-spn">
                       <strong>Address :</strong>
                       <span>GTWRA 61, Life Vila, Changampuzha Samadhi Road, Edappally PO, Kochi, Kerala - 682024</span>
                    </p>                            
               </div>
            </div>            
        </div> 

        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_12"> <strong>The Satsang Foundation (Bharat Yoga Vidya Kendra)</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>mdpoffice@satsang-fondation.org </p>
                   <!-- <p><strong>Website :  </strong>www.bhaskarainstitute.org</p> -->
                   <p class="sty-spn">
                       <strong>Address :</strong>
                       <span>GTWRA 61, Life Vila, Changampuzha Samadhi Road, Edappally PO, Kochi, Kerala - 682024</span>
                    </p>                            
               </div>
            </div>            
        </div> 

        <div class="col-sm-12 col-md-4">
            <div class="yoga_base effect2 ">	
                <h2 class="clr_y clr_y_13"> <strong>Adiveda Research Institute of Yoga Science and Naturopathy</strong> </h2>
                <div class="yoga_inner">
                   <p><strong>Email Id : </strong>manojsurendran111@gmail.com </p>
                   <!-- <p><strong>Website :  </strong>www.bhaskarainstitute.org</p> -->
                   <p class="sty-spn">
                       <strong>Address :</strong>
                       <span>SNDP Building, Mariyappally, Nattakom, Kottayam, Kerala – 686023</span>
                    </p>                            
               </div>
            </div>            
        </div> 


        


























    </div>
</div> 
</section>


@endsection

