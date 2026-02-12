@php  $annouc = request()->route()->uri;  @endphp
<!-- Footer -->
<footer class="footer @if(in_array($annouc, array('/','home'))) {{ 'home-footer' }} @endif" id="footer_ab" >
        <div class="footer_flex-top">
           <div class="inner_footer">
             <ul class="f_link">

			  <li><a href="{{ url('about') }}" ><!--About Us-->{{ __('home_content.About_Us')}}</a></li>
			   {{-- <li><a href="{{ url('media') }}" >{{ __('home_content.Media')}} <!--Media--></a></li> --}}
               <li><a href="{{ url('site-map') }}" >{{ __('home_content.Site_Map')}} <!--Site Map--></a></li>
               <li><a href="{{ url('feedback') }}" >{{ __('home_content.Feedback')}} <!--Feedback--></a></li>
               <li><a href="{{ url('help') }}" >{{ __('home_content.Help')}} <!--Help--></a></li>
               <!--<li><a href="#a" >WIM</a></li>-->
               <li><a href="{{ url('contact-us') }}" > {{ __('home_content.Contact_Us')}} <!--Contact Us --></a></li>
               {{-- <li><a href="{{ asset('wp-content/uploads/2021/01/Revised-Policy.pdf') }}" target="_blank">{{ __('home_content.Privacy_Policy')}} <!--Privacy Policy--></a></li> --}}
               <li><a href="{{ url('privacy-policy') }}"
                >{{ __('home_content.Privacy_Policy') }}
                <!--Privacy Policy-->
            </a></li>
<li><a href="{{ url('terms-conditions') }}">{{ __('home_content.terms_conditions') }}
  {{-- Terms And Conditions --}}
    {{-- {{ __('home_content.terms_conditions') }} --}}
                <!--Contact Us-->
            </a></li>
              </ul>
			 <span class="national-portal"><a class="getlink" href="javascript:void(0);" data-link="https://www.india.gov.in/"><img src="{{ asset('resources/imgs/india-gov-in-logo.png')}}" alt="India.gov.in" title="National Portal of India"></a></span>

             <ul class="s_link s_linkFooter">
                 <li>
                      <a class="font_f c_c" href="{{ url('contact-us') }}" rel=" noreferrer"><i class="fa fa-phone" aria-hidden="true"></i>
                      <!-- <span>Contact Us</span> -->
                    </a>
                  </li>

                  <li>
                    {{-- class="font_f t_c" --}}
                    <a class="font_f" style="background: white;" href="https://twitter.com/FitIndiaOff" target="_blank" rel="noopener noreferrer">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>
                      {{-- <i class="fa fa-twitter" aria-hidden="true"></i> --}}
                    <!-- <span class="hidespan">@FitIndiaOff</span> -->
                  </a>
                  </li>
                  <li>
                    <a class="font_f y_c" href="https://www.youtube.com/channel/UCQtxCmXhApXDBfV59_JNagA" target="_blank" rel="noopener noreferrer"><i class="fa fa-youtube-play" aria-hidden="true"></i>
                    <!-- <span class="hidespan">Fit India Movement</span> -->
                  </a>
                  </li>
                  <li>
                    <a class="font_f i_c" href="https://www.instagram.com/fitindiaoff/ " target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram" aria-hidden="true"></i>
                    <!-- <span class="hidespan">@FitIndiaOff</span> -->
                  </a>
                  </li>
                  <li>
                    <a class="font_f f_c" href="https://www.facebook.com/FitIndiaOff/" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i>
                    <!-- <span class="hidespan">@FitIndiaOff</span> -->
                  </a>
                  </li>
              </ul>


           </div>
           <!-- <div class="footer_link">

          </div>-->
          <!-- <div class="footer_link">
              <ul>
                <li><div class="visitor">
                          <span class="social_area">
                            <span><a class="font_f f_c" href="https://www.facebook.com/FitIndiaOff/" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i></a> </span>
                            <span><a class="font_f t_c" href="https://twitter.com/FitIndiaOff" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i></a></span>
                            <span><a class="font_f y_c" href="https://www.youtube.com/channel/UCQtxCmXhApXDBfV59_JNagA" target="_blank" rel="noopener noreferrer"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></span>
                            <span><a class="font_f i_c" href="https://www.instagram.com/fitindiaoff/ " target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram" aria-hidden="true"></i></a></span>
                          </span>
                    </div>
                  </li>
            </ul>
          </div>-->
          </div>
          <div class="clear"></div>
		<?php
		 $glag = Lang::locale();
		?>
        <div id="main-footer">
            <!--<div class="footer_Flex">
                 <p>{{ __('home_content.Sports_authority')}} <!--© 2021 Sports Authority of India. All rights reserved --></p><!--| <span class="pvpol">
                  <a href="{{ asset('wp-content/uploads/2021/01/Revised-Policy.pdf') }}" target="_blank">Privacy Policy &nbsp;</a>
                </span>-->
                <!-- <p>{{ __('home_content.Last_updated_on')}}
				 @php
				  echo date('F jS,Y', strtotime(App\Http\Controllers\GeneralController::updatedon()));
				 @endphp | {{ __('home_content.No_of_Visitors')}} : <span>
				 @php  echo App\Http\Controllers\GeneralController::sitecounter();
				 @endphp
				</span></p>
              </div>-->
             <div class="footer_Flex">
                 <p>{{ __('home_content.Sports_authority')}}<!--© 2021 Sports Authority of India. All rights reserved--> </p>
                 <p>{{ __('home_content.Last_updated_on')}} <!--Last updated on-->
                    @if(!empty($glag)&& ($glag=='hn')) @php echo date('F jS,Y');@endphp  @elseif (!empty($glag)&& ($glag=='en'))
					@php echo date('F jS,Y'); /*echo date('F jS,Y', strtotime(App\Http\Controllers\GeneralController::updatedon())); */
				    @endphp
				    @endif   | {{ __('home_content.No_of_Visitors')}} <!--No of Visitors-->:
                    <span>
                      @php echo App\Http\Controllers\GeneralController::sitecounter();@endphp
				    </span>
                  </p>
              </div>
          </div>

@if(in_array($annouc, array('/','home')))
    <div class="announcement-ticker">
		<div class="ticker-heading"><span>{{ __('home_content.Announcements')}} <!--Announcements--></span></div>
		<div class="ticker-txt ticker-wrap">
		  <marquee id="mymarquee" scrollamount="5">

			<span class="mid-line"></span>
     <!--  <u>
        <span><a href="https://fitindia.gov.in/wp-content/uploads/doc/EOI_Olympics_Quiz_18.06.2021.pdf" target="_blank">Expression of Interest (EOI) - Partner For Olympics Quiz</a> </span>
      </u> -->
    <!--   <span class="mid-line"></span> -->
			<!--  @if(!empty($announcement))
			  @foreach($announcement as $ann)
				<span><a href="{{ $ann->url }}" target="_blank">{{ $ann->title }}</a> </span>
				<span class="mid-line"></span>
			  @endforeach
			@endif-->



			<!-- <span><a href="covid-19-info">Covid-19 Info - Click Here</a> </span>  -->
			<span><a href="javascript:void(0)">{{ __('home_content.Fit_India_Mission')}}	<!--Fit India Mission doesn't charge any money in issuing the Fit India certificate, please be aware of the fraudulent scams--></a> </span>
		  </marquee>
		</div>
	</div>
@endif

<!-- <script src="{{ asset('resources/js/bootstrap.min.js')}}"></script> -->
<script>
Set-Cookie: XSRF-TOKEN="XXXXX"
/*
------------------------------------------------------------
Function to activate form button to open the slider.
------------------------------------------------------------
*/
function open_panel() {
slideIt();
var a = document.getElementById("sidebar");
a.setAttribute("id", "sidebar1");
a.setAttribute("onclick", "close_panel()");
}
/*
------------------------------------------------------------
Function to slide the sidebar form (open form)
------------------------------------------------------------
*/
function slideIt() {
var slidingDiv = document.getElementById("slider");
var stopPosition = 95;
if (parseInt(slidingDiv.style.right) < stopPosition) {
slidingDiv.style.right = parseInt(slidingDiv.style.right) + 2 + "%";
setTimeout(slideIt, 1);
}
}
/*
------------------------------------------------------------
Function to activate form button to close the slider.
------------------------------------------------------------
*/
function close_panel() {
slideIn();
a = document.getElementById("sidebar1");
a.setAttribute("id", "sidebar");
a.setAttribute("onclick", "open_panel()");
}
/*
------------------------------------------------------------
Function to slide the sidebar form (slide in form)
------------------------------------------------------------
*/
function slideIn() {
var slidingDiv = document.getElementById("slider");
var stopPosition = 97;
if (parseInt(slidingDiv.style.right) > stopPosition) {
slidingDiv.style.right = parseInt(slidingDiv.style.right) - 2 + "%";
setTimeout(slideIn, 1);
}
}

var linkdata=""
</script>



</footer>



