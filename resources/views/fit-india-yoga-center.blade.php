@extends('layouts.app')
@section('title', 'Yoga Center | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp


    
<div class="inner-banner-bg">
<div class="inner-banner-band">
<h1 class="page__title title" id="page-title">FIT INDIA YOGA CENTERS</h1>
        <p class="text-center"></p>
</div>
</div>


<div class="container">

<section id="{{ $active_section_id }}">


    <div class="row">
    
        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Shri Ambika Yoga Kutir</strong> </p><hr>
                            <p><strong>Email Id: </strong>shriambikayogakutir@gmail.com</p>
                            <p><strong>Website:  </strong>www.ambikayogkutir.org</p>
                            <p class="sty-spn"><strong>Address:  </strong>B. K. Mill Compund, Eenatai Thackrey Chowk, Thane (W), Maharashtra - 400601</p>
                            
                        </div>
            </div>
            
        </div>

         <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Paramanand University Trust</strong> </p><hr>
                            <p><strong>Email Id: </strong>babaom@gmail.com</p>
                            <p><strong>Website:  </strong>www.paramyoga.org</p>
                            <p class="sty-spn"><strong>Address:  </strong>Limbodi Newar new Digmbar Public School, Khandwa Road, Indore, 452020, MP</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Patanjali Yogpeeth (Trust)</strong> </p><hr>
                            <p><strong>Email Id: </strong>patanjaliyog@bharatswabhimantrust.org </p>
                            <p><strong>Website:  </strong>www.divyayoga.com</p>
                            <p class="sty-spn"><strong>Address:  </strong>Maharshi Dayand Marg, Near Bahadrabad, Haridwar – 249405 Uttarakhand </p>
                            
                        </div>
            </div>
            
        </div>

           <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Swami Vivekananda Yoga Anusandhana Samsthana </strong> </p><hr>
                            <p><strong>Email Id: </strong>registrat@svyasa.edu.in</p>
                            <p><strong>Website:  </strong> www.svyasa.edu.in</p>
                            <p class="sty-spn"><strong>Address:  </strong>Eknath Bhavan, #19, Gavipuram Circle, Kempegowda Nagar, Bangalore - 560019</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Kaivalyadhama Shriman Madhav Yoga Mandir Samiti</strong> </p><hr>
                            <p><strong>Email Id: </strong>ceooffice@kdham.com </p>
                            <p><strong>Website:  </strong>www.kdham.com</p>
                            <p class="sty-spn"><strong>Address:  </strong>Swami Kuvalayananda Marg, Lonavla - 410403, Maharashtra</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Krishnamacharya Yoga Mandiram</strong> </p><hr>
                            <p><strong>Email Id: </strong>mails@kym.org</p>
                            <p><strong>Website:  </strong>www.kym.org</p>
                            <p class="sty-spn"><strong>Address:  </strong>No. 31, Fourth Cross Street. RK Nagar, Mandaveli, Chennai, Tamilnadu - 600028</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Yoga Vidya Gurukul</strong> </p><hr>
                            <p><strong>Email Id: </strong>yogavidyagurukw@gmail.com</p>
                            <p><strong>Website:  </strong>www.yogavidyagurukul.org</p>
                            <p class="sty-spn"><strong>Address:  </strong>Yoga Bhawan, College Road, Nashik - 422005</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Morarji Desai National Institute of Yoga</strong> </p><hr>
                            <p><strong>Email Id: </strong>mdniy@yahoo.co.in </p>
                            <p><strong>Website:  </strong>www.yogamdniy.nic.in</p>
                            <p class="sty-spn"><strong>Address:  </strong>68, Ashok Road, Opp. Gole Dak Khana, New Delhi - 110001</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Lovely Professional University</strong> </p><hr>
                            <p><strong>Email Id: </strong>vc.office@ipu.co.in </p>
                            <!-- <p><strong>Website:  </strong>www.yogamdniy.nic.in</p> -->
                            <p class="sty-spn"><strong>Address:  </strong>Jalandhar - Delhi G. T. Road, Phagwara, Distt. Kapurthala - 144411, Punjab</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>New Age Yoga Institute</strong> </p><hr>
                            <p><strong>Email Id: </strong>nitinpatki8@gmail.com  </p>
                            <p><strong>Website:  </strong>www.newageyoga.in</p>
                            <p class="sty-spn"><strong>Address:  </strong>C-1, Shrikunj Premises Coop Scty, Hanuman Road, Vile Parle (East), Mumbai - 400057</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Sunderbai Phoolchand Ji Adarsh Shiksha Sansthan</strong> </p><hr>
                            <p><strong>Email Id: </strong>antimjain@gmail.com </p>
                            <p><strong>Website:  </strong>www.sbpass.org.in</p>
                            <p class="sty-spn"><strong>Address:  </strong>61 Bairath Colony No. 2,
Indore - 452014 </p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Sivananda Yoga Vedanta Dhanwantari Ashram Trust </strong> </p><hr>
                            <p><strong>Email Id: </strong>prahlada@sivananda.org </p>
                            <p><strong>Website:  </strong>http://sivananda.org.in</p>
                            <p class="sty-spn"><strong>Address:  </strong>Sivananda Yoga Vedanta Dhanwantari Ashram,
PO Neyyar Dam, Trivandrum,  Kerala - 695572
</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr"> <strong>Sivananda Yoga Vedanta Meenakshi Ashram</strong> </p><hr>
                            <p><strong>Email Id: </strong>annop@sivananda.org </p>
                            <!-- <p><strong>Website:  </strong>www.yogamdniy.nic.in</p> -->
                            <p class="sty-spn"><strong>Address:  </strong>Near Pavanna Vilakku Junction, New Natham Road,
Saramthangi village, Madurai 625503, Tamil Nadu
</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr"> <strong>Aaryaveer Yog Evm Prakartik Chikitsa Sansthan</strong> </p><hr>
                            <p><strong>Email Id: </strong>umendrasinghbly@gmail.com </p>
                            <p><strong>Website:  </strong>www.ayeper.com</p>
                            <p class="sty-spn"><strong>Address:  </strong>48, Gautam Kailash Colony, Badaun Road, Kargaina,
Bareilly, Uttar Pradesh - 243001
</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr"> <strong>The Banaras Educational & Social Trust</strong> </p><hr>
                            <p><strong>Email Id: </strong>banarastrust@gmail.com</p>
                            <p><strong>Website:  </strong>www.banarastrust.org</p>
                            <p class="sty-spn"><strong>Address:  </strong>Lane No. 3, House No. 49, Bhaktinagar, Pandeypur, Varanasi, UP - 221002</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>BSS Yoga Training Center</strong> </p><hr>
                            <p><strong>Email Id: </strong>bsswfsrewa@gmail.com </p>
                            <!-- <p><strong>Website:  </strong>www.yogamdniy.nic.in</p> -->
                            <p class="sty-spn"><strong>Address:  </strong>University Road, Behind of Agrawal Nurshing Home, Khuthe, Rewa, MP – 486001</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Datta Kriya Yoga International Centre</strong> </p><hr>
                            <p><strong>Email Id: </strong>dkycenter@gmail.com</p>
                            <p><strong>Website:  </strong>www.dattakriyayoga.org </p>
                            <p class="sty-spn"><strong>Address:  </strong>Sri Ganapathy Sachchidananda Ashram, Avadhoota Datta Peetham, Mysuru, Karnataka – 570025  </p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Jagriti Yog and Naturopathy Sansthan, Mahila Kalyan Evam Gramotthan Samiti</strong> </p><hr>
                            <p><strong>Email Id: </strong>mkagsngo@gmail.com </p>
                            <p><strong>Website:  </strong>www.yogajagriti.com</p>
                            <p class="sty-spn"><strong>Address:  </strong>Yaduvansh Nagar, Near Shiv Mandir, Agra Bypass Road, Shikohabad, Disstt. Firozabad, UP - 283135</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Maa Baliraji Yog Sansthan</strong> </p><hr>
                            <p><strong>Email Id: </strong>maabaliraji@gmail.com</p>
                            <p><strong>Website:  </strong>www.mbys.in</p>
                            <p class="sty-spn"><strong>Address:  </strong>Hargarh Bazar, Mirzapur, UP - 231313</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Shaurya Prakritik Chikitsa Evem Yoga Sansthan</strong> </p><hr>
                            <p><strong>Email Id: </strong> shaurya271201@gmail.com </p>
                            <p><strong>Website:  </strong>http://shauryapcyss.org/</p>
                            <p class="sty-spn"><strong>Address:  </strong>Sekhui Kala, bipass Dhusah Balrampur, 
Uttar Pradesh Pin-271201
</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Yogaathma Foundation </strong> </p><hr>
                            <p><strong>Email Id: </strong>yogigowd@gmail.com</p>
                            <p><strong>Website:  </strong>www.sohamashram.org</p>
                            <p class="sty-spn"><strong>Address:  </strong>Survey No. 7, Aladhakate Village, Kudur Hobli, Magadi Taluk, Ramanagar District, Karnatak State - 562127</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Yoga Wellness Center</strong> </p><hr>
                            <p><strong>Email Id: </strong>rajkamal.yoga@gmail.com </p>
                            <!-- <p><strong>Website:  </strong>www.yogamdniy.nic.in</p> -->
                            <p class="sty-spn"><strong>Address:  </strong>2C-112, 2nd Cross Road, East of NGEF Layout, Kasturi Nagar, Bangalore, Karnataka – 560043</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Bhaskara Institute of Yoga and Research Centre Society</strong> </p><hr>
                            <p><strong>Email Id: </strong>bhaskarainstitute@gmail.com </p>
                            <p><strong>Website:  </strong>www.bhaskarainstitute.org</p>
                            <p class="sty-spn"><strong>Address:  </strong>GTWRA 61, Life Vila, Changampuzha Samadhi Road, Edappally PO, Kochi, Kerala - 682024</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>The Satsang Foundation (Bharat Yoga Vidya Kendra)</strong> </p><hr>
                            <p><strong>Email Id: </strong>mdpoffice@satsang-fondation.org  </p>
                            <!-- <p><strong>Website:  </strong>www.yogamdniy.nic.in</p> -->
                            <p class="sty-spn"><strong>Address:  </strong>9, Webster Road, Cox Town, Bangalore, Karnataka – 560005</p>
                            
                        </div>
            </div>
            
        </div>

        <div class="col-sm-12 col-md-4">

            <div class="sdw">	  
                        <div>

                            <p class="clr";> <strong>Adiveda Research Institute of Yoga Science and Naturopathy</strong> </p><hr>
                            <p><strong>Email Id: </strong>manojsurendran111@gmail.com</p>
                            <!-- <p><strong>Website:  </strong>www.yogamdniy.nic.in</p> -->
                            <p class="sty-spn"><strong>Address:  </strong>SNDP Building, Mariyappally, Nattakom, Kottayam, Kerala – 686023</p>
                            
                        </div>
            </div>
            
        </div>


























    </div>
</div> 
</section>


@endsection

