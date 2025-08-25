@extends('layouts.app')
@section('title', 'Your Stories | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<link rel="stylesheet" href="resources/css/component.css">


<!-- <div class="container-fluid">
  <div class="inner-banner-bg">
      <div class="inner-banner-band">
      <h1 class="page__title title" id="page-title">Your Stories</h1>
      <p class="text-center">Stories have the power to inspire and empower. We’re collecting stories of your Fitness experiences.</p>
    </div>
  </div>
  </div> -->  
  <div>
        <img src="{{ asset('resources/images/share-your-story.jpg') }}" alt="share-your-story"
            title="Share your Fitness Story" class="img-fluid expand_img" />
            <h1 style="font-size:1px; color:#fff;">Share Your Story</h1>
    </div>
<section id="{{ $active_section_id }}">

 
  <div class="container">
  
    <div class="row">
        <div class="et_pb_button_module_wrapper ">       
            <a class="et_pb_button" href="{{route('your-story')}}">Share Your Story</a>
        </div>
    </div>
    
<div class="row shar_story_div">

@foreach ($shared as $share)

    <div class="col-sm-12 col-md-6 col-lg-3">       
      <div class="shar_div shar_card shadow" >
              <div class="ytb-video">
                  <div class="play-card" id="play-video" ref="{{$share->id}}">
                      <span class="play-icon"><i class="fa fa-play" aria-hidden="true"></i></span>  
                      <img src="@if(!empty($share->image)) {{ $share->image }} @endif" class="img-fluid" alt="Dr Seema Rao" title="Dr Seema Rao, Women Commando Trainer" />
                  </div>
                  <iframe id="video-{{$share->id}}" src="{{ $share->videourl }}" rel="0" enablejsapi="1" modestbranding="0"  controls="0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> 
              </div> 
          <div class="shar_inr_card">
                    <div class="my-nm"><strong>{{ $share->fullname }}</strong></div>
                <div class="sty-deg"><div class="sty-spn">{{ $share->designation }}</div>
                  <span class="sty-cty">{{ $share->state }}</span><span>&nbsp;|&nbsp;</span>
                  <span class="sty-date"> {{ date('M Y', strtotime($share->created_at)) }} </span>
              </div>
                <div class="my-story">
                        <div class="story-head"><strong>{{ $share->title }}</strong><span class="mid-line"></span></div>    
                  <div class="story-dtls"><p class="story-p">{{ $share->story }}</p><span class="more-story">More ></span></div>
                </div>
          </div> 
          </div>
    </div>
    
@endforeach

<!--
    <div class="col-sm-12 col-md-6 col-lg-3">       
          <div class="shar_div shar_card shadow" >
            
          <div class="ytb-video">
          <div class="play-card" id="play-video">
          <span class="play-icon"><i class="fa fa-play" aria-hidden="true"></i></span>  
          <img src="resources/imgs/dr-seema-rao.jpg" class="img-fluid" alt="Dr Seema Rao" title="Dr Seema Rao, Women Commando Trainer" />
          </div>
          <iframe id="video" src="https://www.youtube.com/embed/X2SOt0O3F4w?controls=0" rel="0" enablejsapi="1" modestbranding="0"  controls="0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> 
        
         </div> 
              <div class="shar_inr_card">
                
                <div class="my-nm"><strong>Dr Seema Rao</strong></div>
                <div class="sty-deg"><div class="sty-spn">Women Commando Trainer</div><div class="sty-cty">Maharashtra</div><div class="sty-date">Apr 2021</div></div>
                <div class="my-story">
                <div class="story-head"><strong>Story of India's First Woman Commando Trainer</strong><span class="mid-line"></span></div>                         
                <div class="story-dtls"><p class="story-p">A short documentary on India's first woman commando trainer "Dr. Seema Rao." A woman's quest for standing shoulder to shoulder with men of war.</p><span class="more-story">More ></span></div>
                </div>
              
         </div> 
    </div>
    </div>
    
    
    
    
    <div class="col-sm-12 col-md-6 col-lg-3">
          <div class="shar_div shar_card shadow" >
          
          <div class="ytb-video">
          <div class="play-card" id="play-video">
          <span class="play-icon"><i class="fa fa-play" aria-hidden="true"></i></span>
          <img src="resources/imgs/shreya-sharma.jpg" class="img-fluid" alt="Shreya Sharma" title="Shreya Sharma, Student" />
          </div>
          <iframe id="video1" src="https://www.youtube.com/embed/bPr8K2wq4XQ?controls=0" rel="0" enablejsapi="1" modestbranding="0"  controls="0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
              <div class="shar_inr_card">
                
                <div class="my-nm"><strong>Shreya Sharma</strong></div>             
                <div class="sty-deg"><div class="sty-spn">Student</div><div class="sty-cty">Punjab</div><div class="sty-date">Apr 2021</div></div>
                <div class="my-story">
                <div class="story-head"><strong>My health my responsibility</strong><span class="mid-line"></span></div>                           
                <div class="story-dtls"><p class="story-p">All the wealth before which we all are running is only illusionary, the real wealth is our health. If our health is good we can enjoy our life which is full of adventures, But for it we need to work out and meditate on a daily basis.</p><span class="more-story">More ></span></div>
                </div>
              
         </div> 
    </div>
    
    
    --> 
    
    
    
    <!--
    <div class="col-sm-12 col-md-6 col-lg-3">       
          <a href="javascript:void(0)">
              <div class="shar_div shadow ">
              <img src="resources/imgs/home/Sardar-Gurbachan-Singh_Hockey-Olympian-400x250.jpg" class="img-fluid" alt="Sardar Gurbachan Singh, Hockey Olympian (1964,1968) & had been Coach of 1976 Indian Olympics"/>
                <h3>Sardar Gurbachan Singh, Hockey Olympian (1964,1968) & had been Coach of 1976 Indian Olympics</h3>
              </a>
                <div class="shar_div_inner inner_span">            
                  <span>by </span><span><a href="https://fitindia.gov.in/beta/author/fitindia/">fitindia</a></span> | <span>Aug 27, 2019</span>
                </div>
            </div>
         
    </div>
    
     <div class="col-sm-12 col-md-6 col-lg-3">
          <a href="javascript:void(0)">
          <div  class="shar_div shadow"> 
            <img src="resources/imgs/home/Surya_Namaskar-400x250.jpg" class="img-fluid" alt="Daily Routine of Surya Namaskar and Cardio, 85+ years"/>
              <h3>Daily Routine of Surya Namaskar and Cardio, 85+ years</h3>
              </a>
              <div class="shar_div_inner inner_span">            
                <span>by </span><span><a href="https://fitindia.gov.in/beta/author/fitindia/" >fitindia</a></span> | <span>Aug 27, 2019</span>
              </div>           
          </div>
      </div>
        <div class="col-sm-12 col-md-6 col-lg-3">
          <a href="javascript:void(0)">
          <div  class="shar_div shadow"> 
            <img src="resources/imgs/home/T_A_ANGAPPAN-400x250.jpg" class="img-fluid" alt="T.A ANGAPPAN , AGE 88"/>
            <h3>T.A ANGAPPAN , AGE 88</h3>
            </a>
            <div class="shar_div_inner inner_span">            
              <span>by </span><span><a href="https://fitindia.gov.in/beta/author/fitindia/">fitindia</a></span> | <span>Aug 27, 2019</span>
            </div>
           </div>
      </div>
        <div class="col-sm-12 col-md-6 col-lg-3">
          <a href="javascript:void(0)">
          <div  class="shar_div shadow"> 
            <img src="resources/imgs/home/Cycling_Rajpath-400x250.jpg" class="img-fluid" alt="Fitness Enthusiasts – Cycling on Rajpath"/>
            <h3>Fitness Enthusiasts – Cycling on Rajpath</h3>
            </a>
            <div class="shar_div_inner inner_span">            
              <span>by </span><span><a href="https://fitindia.gov.in/beta/author/fitindia/">fitindia</a></span> | <span>Aug 27, 2019</span>
            </div>
          </div>
</div>
        <div class="col-sm-12 col-md-6 col-lg-3">
          <a href="javascript:void(0)">
          <div class="shar_div shadow">
            <img src="resources/imgs/home/Lawn_Tennis-400x250.jpg" class="img-fluid" alt="Mr Avinash Chandra Seth born in 1940 playing Lawn Tennis"/>
              <h3>Mr Avinash Chandra Seth born in 1940 playing Lawn Tennis</h3>
              </a>
              <div class="shar_div_inner inner_span">            
                <span>by </span><span><a href="https://fitindia.gov.in/beta/author/fitindia/">fitindia</a></span> | <span>Aug 27, 2019</span>
              </div>
          </div>
</div>
        <div class="col-sm-12 col-md-6 col-lg-3">
          <a href="javascript:void(0)">
          <div class="shar_div shadow">
            <img src="resources/imgs/home/Baljit-Singh_Architect-400x250.jpg" class="img-fluid" alt="Shri Balkrishnarao Bhoshe, 100th Year Running"/>
              <h3>Shri Balkrishnarao Bhoshe, 100th Year Running</h3>
              </a>
              <div class="shar_div_inner inner_span">            
                <span>by </span><span><a href="https://fitindia.gov.in/beta/author/fitindia/">fitindia</a></span> | <span>Aug 27, 2019</span>
              </div>
          </div>
</div>
        <div class="col-sm-12 col-md-6 col-lg-3">
          <a href="javascript:void(0)">
          <div class="shar_div shadow">
            <img src="resources/imgs/home/Krishna-Kumar_Bhattacharya-400x250.jpg" class="img-fluid" alt="Krishna Kumar Bhattacharya, 87"/>
              <h3>Krishna Kumar Bhattacharya, 87</h3>
              </a>
              <div class="shar_div_inner inner_span">            
                <span>by </span><span><a href="https://fitindia.gov.in/beta/author/fitindia/">fitindia</a></span> | <span>Aug 27, 2019</span>
              </div>


          </div>
</div>
        <div class="col-sm-12 col-md-6 col-lg-3">
          <a href="javascript:void(0)">
          <div class="shar_div shadow">
            <img src="resources/imgs/home/Siddhant-Raguram_Lawyer-400x250.jpg" class="img-fluid" alt="Siddhant Raguram, Lawyer"/>
              <h3>Siddhant Raguram, Lawyer</h3>
              </a>
              <div class="shar_div_inner inner_span">            
                <span>by </span><span><a href="https://fitindia.gov.in/beta/author/fitindia/">fitindia</a></span> | <span>Aug 27, 2019</span>
              </div>
          </div>
</div>
      
      -->
      
    </div>
 
</div>
</div>
</section>



<script>
  $(document).ready(function() {
  
  $('.play-card').click(function(ev){
      $(this).hide();
    var v_id = $(this).attr('ref');
    $("#video-"+v_id)[0].src += "&autoplay=1";
     ev.preventDefault(); 
      $("#video-"+v_id)[0].src += "&autoplay=1";
     ev.preventDefault();
  });
  
});

</script>

<script>
$(document).ready(function(){
  $(".more-story").click(function(){
       
    $(this).prev().toggleClass("story-ext");

    $(this).text($(this).text() == 'More >' ? 'Less >' : 'More >');
    // ($(".more-story").text() == "More >") ? $(".more-story").text("Less >") : $(".more-story").text("More >");
  });


});


// $(".content").hide();
//     $(".show_hide").on("click", function () {
//         var txt = $(".content").is(':visible') ? 'Read More' : 'Read Less';
//         $(".show_hide").text(txt);
//         $(this).next('.content').slideToggle(200);
//     });
</script>
<style>
.story-ext {
    -webkit-line-clamp: unset !important;
    overflow: visible !important;
    padding-bottom: 20px !important;
}
</style>
<!-- <script src="resources/js/modernizr.custom.js"></script>
<script src="resources/js/masonry.pkgd.min.js"></script>
<script src="resources/js/imagesloaded.js"></script>
<script src="resources/js/classic.js"></script>
<script src="resources/js/imagescroll.js"></script> -->
  
<!-- <script>
  new AnimOnScroll( document.getElementById( 'grid' ), {
    minDuration : 0.4,
    maxDuration : 0.7,
    viewportFactor : 0.2
  } );
  var $grid = $('.grid').masonry({
  
});
</script> -->
@endsection