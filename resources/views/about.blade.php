@extends('layouts.app')
@section('title', 'About Us | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<div >
<div>
   <img src="{{ asset('resources/imgs/about/about-fitindia.jpg') }}" alt="about-fitindia"  title="About-us"class="img-fluid expand_img"/>
</div>

<section id="{{ $active_section_id }}">
        <div class="container">
            <div class="row r-m">
                <div class="col-sm-12 col-md-12 r-m">
                    <h1 class="a_heading">What is Fit India Movement?​</h1>
                    <p>FIT INDIA Movement was launched on 29th August, 2019 by Hon'ble Prime Minister with a view to make fitness an integral part of our daily lives. The mission of the Movement is to bring about behavioural changes and move towards a more physically active lifestyle. Towards achieving this mission, Fit India proposes to undertake various initiatives and conduct events to achieve the following objectives:</p>
			<ul>
			<li>To promote fitness as easy, fun and free</li>
			<li>To spread awareness on fitness and various physical activities that promote fitness through focused campaigns</li>
			<li>To encourage indigenous sports</li>
			<li>To make fitness reach every school, college/university, panchayat/village, etc.</li>
			<li>To create a platform for citizens of India to share information, drive awareness and encourage sharing of personal fitness stories</li>
			</ul>
                </div>
                <div class="down_lo">
                    <a class="" href="{{asset('wp-content/uploads/2021/01/FITIndia_Logo_Guidelines.pdf') }}" target="_blank">Download Logo Guidelines</a>
                </div>
            </div>
</div>
</div>
<section>
    {{-- <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12 flex-column">
                    <div class="sec_heading sec_heading3 pl-1 pr-1">
                        <h2 class="heading headvideo ">Ministry of Youth Affairs and Sports</h2>
                    </div>
                </div>
            </div>


                <div class="row">
                    <div class="col-sm-12 col-md-6 " style="background: #ededed;padding: 20px;padding-left:3%; padding-right:3%;"> 
                        <div class="mini_area" >    
                            <div class="card shadow">       
                                    <img src="resources/imgs/about/anurag.jpg" class="img-fluid mini_pic" />
                            </div>
                            <div class="affair_area" style=""> 
                                <h5 class="misi" style="">Shri Anurag Singh Thakur</h5>
                                <p style="margin-bottom:0;">Hon'ble Youth Affairs and Sports Minister</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 " style="background: #f5f5f5;padding: 20px;padding-left:8%; padding-right:8%;">  
                    <div class="mini_area" >    
                    <div  class="card shadow">       
                                    <img src="resources/imgs/about/nitish.jpg" class="img-fluid mini_pic" />
                            </div>                     
                        <div class="affair_area"> 
                                <h5 class="misi" style="">Shri Nisith Pramanik</h5>
                                <p style="margin-bottom:0;">Hon'ble Minister of State</p>
                            </div>
                                    
                        </div>
                        </div>                 
                    </div>
                <div>
            </div>
        </div> --}}
</section>
            
      
  
    
    {{-- <div class="container mb-5">
    
    
        <div class="row r-m">
            <div class="col-sm-12 col-md-12 r-m">
                <h2 class=" m-60 m-bot-40">Launch of Fit India Movement by Shri Narendra Modi on 29th August, 2019</h2>
              
            </div>
            <div class="row">
                <div class="col-sm-6 ">
                    <div class="et_pb_video_box">
                    <video controls="">
                        <source type="video/mp4" src="https://fitindia.gov.in/wp-content/uploads/2019/09/WhatsApp-Video-2019-09-10-at-09.04.17-1.mp4">
                        
                    </video>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="et_pb_video_box">
                    <video controls="">
                        <source type="video/mp4" src="https://fitindia.gov.in/wp-content/uploads/2019/09/WhatsApp-Video-2019-09-10-at-09.04.17.mp4">
                        
                    </video>
                    </div>
                </div>
                </div>
    </div> --}}
    
</section>
</div>
@endsection