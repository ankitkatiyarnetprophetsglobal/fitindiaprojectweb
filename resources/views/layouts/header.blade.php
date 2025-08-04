 <!-- pop area -->
<!--  @if( Request::path() === '/')
<div class="popup-window" id="popup-ad">
	<div class="popup-dv">
		<div class=" rslides_container card ">
			<span class="close-ad">&nbsp;</span>
			<h2>Important Notice</h2>
			<p>Fit India Quiz has been postponed. We will share the updated dates very soon...</p>
		</div>
	</div>
</div>
@endif
<script>
  $(document).ready(function(){
	  $('.close-ad').click(function(){
		  $('.popup-window').hide();
	  })
	})
</script>	 -->
<!--close pop area -->



 <div class="container-fluid contr-bx">
    <div class="header on-print">
        <div class="head-rw">
          <div class="row">
            <div class="col-3">
              {{-- <a href="home" class="fit-logo"> --}}
              <a href="{{ url('/home') }}" class="fit-logo">
                <img src="{{asset('resources/imgs/fit-india_logo.png') }}" alt="Fit India">
              </a>
            </div>
            <div class="col-6">
              <span class="gov-logo">
			  <a class="getlink " data-link="https://yas.nic.in/" href="javascript:void(0);">
                <img src="{{asset('resources/imgs/gov_logo.png') }}" alt="Government of India">
			  </a>
			  </span>
            </div>
            <div class="col-3 text-right">
			<a class="getlink sai-logo" data-link="https://sportsauthorityofindia.nic.in/" href="javascript:void(0);" class="sai-logo">
               <img src="{{asset('resources/imgs/sai_trans_logo_new.jpg') }}" alt="SAI">
             </a>
           </div>
		   <!-- <a href="javascript:onClick=doModal('https://sportsauthorityofindia.nic.in/')" class="sai-logo">  -->
          </div>
        </div>
    </div>
	<div class="menu-bar on-print">
	  <div class="row">
		<div class="col-12">
		  <nav class="navbar navbar-expand-lg navbar-dark">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
			</button>
			  <div class="collapse navbar-collapse navbar-toggleable-lg" id="collapsibleNavbar">
			  <ul class="navbar-nav">
				<li class="nav-item {{ (request()->is('home')) ? 'active' : 'active' }}">
				    <a class="nav-link  home-menu {{ (request()->is('home')) ? 'active' : '' }}" href="{{ route('home') }}"><i class="fa fa-home home_nav" aria-hidden="true" ></i><span class="menu-txt">{{ __('home_content.home')}} <!--Home--></span></span></a>
				</li>
				{{-- <li class="nav-item {{ (request()->is('fit-india-cycling-drive')) ? 'active' : 'active' }}">
					<a class="nav-link  home-menu {{ (request()->is('fit-india-cycling-drive')) ? 'active' : '' }}" href="{{url('fit-india-cycling-drive')}}">Fit India Cycling Drive</span></a>
				</li> --}}
				{{-- <li class="nav-item {{ (request()->is('home')) ? 'active' : 'active' }}">
					<a class="nav-link  home-menu {{ (request()->is('home')) ? 'active' : '' }}" href="{{ route('home') }}"><i class="fa fa-home home_nav" aria-hidden="true" ></i><span class="menu-txt">{{ __('home_content.home')}} <!--Home--></span></span></a>
				</li> --}}
                {{-- <li class="nav-item {{ (request()->is('national-sports-day-2025')) ? 'active' : 'active' }}">
				  <a class="nav-link  home-menu {{ (request()->is('national-sports-day-2025')) ? 'active' : '' }}" href="{{url('national-sports-day-2025')}}">{{ __('home_content.national-sports-day-2025')}}</span></a>
				</li> --}}
				<li class="nav-item {{ (request()->is('fit-india-cycling-drive')) ? 'active' : 'active' }}">
				  <a class="nav-link  home-menu {{ (request()->is('fit-india-cycling-drive')) ? 'active' : '' }}" href="{{url('fit-india-cycling-drive')}}">{{ __('home_content.fit-india-cycling-drive')}}</span></a>
				</li>

				{{-- <li class="nav-item {{ (request()->is('womens-week-bicycle-day')) ? 'active' : 'active' }}">
				  <a class="nav-link  home-menu {{ (request()->is('womens-week-bicycle-day')) ? 'active' : '' }}" href="{{url('womens-week-bicycle-day')}}">{{ __('home_content.womens-week-bicycle-day')}}</span></a>
				</li> --}}
				{{-- <li class="nav-item {{ (request()->is('fit-india-women-week')) ? 'active' : 'active' }}">
				  <a class="nav-link  home-menu {{ (request()->is('fit-india-women-week')) ? 'active' : '' }}" href="{{url('fit-india-women-week')}}">{{ __('home_content.international-women')}}</span></a>
				</li> --}}
				{{-- <li class="nav-item {{ (request()->is('cyclothon-2024')) ? 'active' : 'active' }}">
					<a class="nav-link  home-menu {{ (request()->is('cyclothon-2024')) ? 'active' : '' }}" href="{{url('cyclothon-2024')}}">Cyclothon</span></a>
				</li> --}}
				{{-- <li class="nav-item {{ (request()->is('fit-india-swacchta-freedom-run-5.0')) ? 'active' : 'active' }}">
					<a class="nav-link  home-menu {{ (request()->is('fit-india-swacchta-freedom-run-5.0')) ? 'active' : '' }}" href="{{url('fit-india-swacchta-freedom-run-5.0')}}">Freedom run</span></a>
				</li> --}}
				{{-- <li class="nav-item {{ (request()->is('national-sports-day-2024')) ? 'active' : 'active' }}">
					<a class="nav-link  home-menu {{ (request()->is('national-sports-day-2024')) ? 'active' : '' }}" href="{{url('national-sports-day-2024')}}">National Sports Day</span></a>
				</li> --}}
				{{-- <li class="nav-item {{ (request()->is('Fit-India-Swachhata-Freedom-Run-4.0')) ? 'active' : 'active' }}"> --}}
				{{-- <li class="nav-item {{ (request()->is('fit-india-week-2024')) ? 'active' : 'active' }}"> --}}
				    {{-- <a class="nav-link  home-menu {{ (request()->is('national-sports-day-2023')) ? 'active' : '' }}" href="{{url('national-sports-day-2023')}}">{{ __('home_content.event_title')}} </span></a> --}}
				    {{-- <a class="nav-link  home-menu {{ (request()->is('Fit-India-Swachhata-Freedom-Run-4.0')) ? 'active' : '' }}" href="{{url('Fit-India-Swachhata-Freedom-Run-4.0')}}">Fit India Swachhata Freedom Run 4.0</span></a> --}}
				    {{-- <a class="nav-link  home-menu {{ (request()->is('fit-india-week-2023')) ? 'active' : '' }}" href="{{url('fit-india-week-2023')}}">Fit India Week</span></a> --}}
					{{-- <a class="nav-link  home-menu {{ (request()->is('fit-india-week-2024')) ? 'active' : '' }}" href="{{url('fit-india-week-2024')}}">{{ __('home_content.fit-india-week')}}</span></a> --}}
				{{-- </li> --}}

				{{-- <li class="nav-item {{ (request()->is('national-sports-day-2023') || request()->is('national-sports-day-2023')) ? 'active' : 'active' }}">
				 <a class="nav-link  {{ (request()->is('national-sports-day-2023') || request()->is('national-sports-day-2023')) ? 'active' : '' }}" href="javascript:void(0);">
				 	<span class="menu-txt">{{ __('home_content.events')}}</span>
				 	<span class="m-arrow">
					 <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" /></svg></span>
				</a> --}}
				{{-- <ul class="sub-menu">
					<li class="nav-item {{ (request()->is('fit-india-school-week-2022')) ? 'active' : 'active' }}">
	              		<a class="nav-link  {{ (request()->is('fit-india-school-week-2022')) ? 'active' : '' }}"
	                		href="{{url('national-sports-day-2023')}}">National Sports Day 2023</a>
	            	</li> --}}
				{{-- <li class="nav-item {{ (request()->is('national-sports-day-2022')) ? 'active' : 'active' }}">
	              	<a class="nav-link  {{ (request()->is('national-sports-day-2022')) ? 'active' : '' }}"
	                		href="{{url('national-sports-day-2022')}}">National Sports Day 2022</a>
	            </li> --}}
				{{-- </ul> --}}


				<!--
				<ul class="sub-menu">
				<li class="nav-item {{ (request()->is('fit-india-school-week')) ? 'active' : 'active' }}">
	              	<a class="nav-link  {{ (request()->is('fit-india-school-week')) ? 'active' : '' }}"
	                		href="https://fitindia.gov.in/fit-india-freedom-rider-cycle-rally-2022">Fit India Freedom Rider-Cycle Rally</a>
	            </li>
				</ul>
				<ul class="sub-menu">
	            <li class="nav-item {{ (request()->is('fit-india-school-week')) ? 'active' : 'active' }}">
	              	<a class="nav-link  {{ (request()->is('fit-india-school-week')) ? 'active' : '' }}"
	                		href="{{ url('fit-india-school-week') }}">{{ __('home_content.fit-india-school-week')}}  </a>
	            </li> -->
	           <!--  <li class="nav-item  {{ (request()->is('fit-india-cyclothon-2020')) ? 'active' : 'active' }}"><a class="nav-link {{ (request()->is('fit-india-cyclothon-2020')) ? 'active' : '' }}" href="{{ url('fit-india-cyclothon-2020') }}">{{ __('home_content.fit-india-cyclothon-2020')}} </a></li> -->
	      <!--   </ul>	 -->



				<!--  <ul class="sub-menu">
				 	 <li class="nav-item  {{ (request()->is('freedom-run-4.0')) ? 'active' : 'active' }}"><a class="nav-link {{ (request()->is('freedom-run-4.0')) ? 'active' : '' }}" href="{{ url('freedom-run-4.0') }}"> {{ __('home_content.Freedomrun')}}</a></li>
				 </ul>	 -->
	                   <!-- <li class="nav-item {{ (request()->is('fit-india-school-week-2020')) ? 'active' : 'active' }}">
	                   	<a class="nav-link  {{ (request()->is('fit-india-school-week-2020')) ? 'active' : '' }}"
	                   		href="{{ url('fit-india-school-week') }}">Fit India School Week 2020</a>
	                   </li>

	                   <li class="nav-item  {{ (request()->is('fit-india-cyclothon-2020')) ? 'active' : 'active' }}"><a class="nav-link {{ (request()->is('fit-india-cyclothon-2020')) ? 'active' : '' }}" href="{{ url('fit-india-cyclothon-2020') }}">Fit India Cyclothon 2020</a></li> -->

					<!--<li class="nav-item {{ (request()->is('event-archives')) ? 'active' : 'active' }}">
	                   	<a class="nav-link  {{ (request()->is('event-archives')) ? 'active' : '' }}"
	                   		href="{{ url('event-archives') }}">Event Archives</a>
	                   </li> -->

				{{-- </li> --}}

					{{-- <li class="nav-item {{ (request()->is('fit-india-quiz')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('fit-india-quiz')) ? 'active' : '' }}" href="{{ url('fit-india-quiz') }}">{{ __('home_content.fit_india_Quiz')}} <!--Fit India Quiz--></a></li> --}}

				<li class="nav-item {{ (request()->is('fit-india-school') || request()->is('fit-india-youth-club-certification')) ? 'active' : '' }}">
				 {{-- <a class="nav-link  {{ (request()->is('fit-india-school') || request()->is('fit-india-youth-club-certification')) ? 'active' : '' }}" href="fit-india-school"><span class="menu-txt">{{ __('home_content.fit_india_certification')}} <!--Fit India Certification--></span><span class="m-arrow"><svg --}}
				 <a class="nav-link  {{ (request()->is('fit-india-school') || request()->is('fit-india-youth-club-certification')) ? 'active' : '' }}" href="fit-india-school"><span class="menu-txt">{{ __('home_content.fit_india_school')}} <!--Fit India Certification--></span><span class="m-arrow"><svg
					xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
					<path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" /></svg></span></a>
					  <ul class="sub-menu">
		               <li class="nav-item {{ (request()->is('fit-india-school')) ? 'active' : 'active' }}">
					  	 <a class="nav-link {{ (request()->is('fit-india-school')) ? 'active' : '' }}" href="{{ url('fit-india-school') }}">{{ __('home_content.register_school_certification')}} <!--Fit India School--></a></li>
		                {{-- <li class="nav-item {{ (request()->is('fit-india-youth-club-certification')) ? 'active' : 'active' }}"> --}}
                            {{-- <a class="nav-link {{ (request()->is('fit-india-youth-club-certification')) ? 'active' : '' }}" href="{{ url('fit-india-youth-club-certification') }}">{{ __('home_content.fit-india-youth-club-certification')}}  --}}
                                <!--Fit India Youth Club-->
                            {{-- </a> --}}
                        {{-- </li> --}}
		              </ul>
				</li>


				{{-- <li class="nav-item {{ (request()->is('fit-india-dialogue') || request()->is('dialogue-session-2')) ? 'active' : '' }}">
				<a class="nav-link  {{ (request()->is('fit-india-dialogue') || request()->is('dialogue-session-2')) ? 'active' : '' }}"
				 href="fit-india-dialogue"><span class="menu-txt">{{ __('home_content.Dialogue_Session')}} <!--	--></span><span class="m-arrow"><svg
					xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
					<path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" /></svg></span></a>
					<ul class="sub-menu">
		             <li class="nav-item ">
					  <a class="nav-link {{ (request()->is('fit-india-dialogue')  ? 'active' : '' )}}" href="{{ route('fit-india-dialogue') }}">{{ __('home_content.Dialogue_Session1')}} <!--Dialogue Session 1--></a>
					 </li>
		             <li class="nav-item {{ (request()->is('dialogue-session-2')  ? 'active' : '' )}}"><a class="nav-link {{ (request()->is('dialogue-session-2')  ? 'active' : '' )}}" href="{{ url('dialogue-session-2') }}">{{ __('home_content.Dialogue_Session2')}} <!--Dialogue Session 2--></a></li>
		            </ul>
				</li> --}}

				{{-- <li class="nav-item {{ (request()->is('namo-cycling-club')) ? 'active' : 'active' }}">
					<a class="nav-link  home-menu {{ (request()->is('namo-cycling-club')) ? 'active' : '' }}" href="{{url('namo-cycling-club')}}">{{ __('home_content.namo-fitIndia-club')}}</span></a>
				</li> --}}
				<li class="nav-item {{ (request()->is('namo-cycling-club') || request()->is('namo-fit-india-youth-club')) ? 'active' : '' }}">
					<a class="nav-link  {{ (request()->is('namo-cycling-club') || request()->is('namo-fit-india-youth-club')) ? 'active' : '' }}"
					 {{-- href="javascript:void(0);"><span class="menu-txt">Namo Fit India Club</span><span class="m-arrow"><svg --}}
						href="javascript:void(0);"><span class="menu-txt">{{ __('home_content.namo-fit-india-club')}}</span><span class="m-arrow"><svg
						xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
						<path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" /></svg></span></a>
						<ul class="sub-menu">
						 <li class="nav-item ">
						  <a class="nav-link {{ (request()->is('namo-cycling-club')  ? 'active' : '' )}}" href="{{url('namo-cycling-club')}}">{{ __('home_content.namo-fitIndia-club')}} <!--Dialogue Session 1--></a>
						 </li>
						 <li class="nav-item {{ (request()->is('namo-fit-india-youth-club')  ? 'active' : '' )}}"><a class="nav-link {{ (request()->is('namo-fit-india-youth-club')  ? 'active' : '' )}}" href="{{ url('namo-fit-india-youth-club') }}">{{ __('home_content.namo-fit-india-cycling-club')}} <!--Dialogue Session 2--></a></li>
						</ul>
				</li>

				<li class="nav-item {{ (request()->is('influencer') || request()->is('influencer')) ? 'active' : '' }}">
					<a class="nav-link  {{ (request()->is('influencer') || request()->is('influencer')) ? 'active' : '' }}" href="javascript:void(0);" pth="influencer"><span class="menu-txt"> {{ __('home_content.Fit_India_Influencer')}}<!--Fit India Influencer--></span><span class="m-arrow"><svg
						xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
						<path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" /></svg></span>
					</a>
					<ul class="sub-menu sub-menu_width">

				<li class="nav-item {{ (request()->is('fit-india-icons')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('fit-india-icons')) ? 'active' : '' }}" href="{{ url('fit-india-icons') }}">{{ __('home_content.Fit_India_Icons')}} <!--Fit India Icons--></a></li>
				<li class="nav-item {{ (request()->is('fit-india-champions')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('fit-india-champions')) ? 'active' : '' }}" href="{{ url('fit-india-champions') }}">{{ __('home_content.fit_india_champions')}} <!--Fit India Champions--></a></li>
					<li class="nav-item {{ (request()->is('fit-india-ambassador')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('fit-india-ambassador')) ? 'active' : '' }}" href="{{ url('fit-india-ambassador') }}">{{ __('home_content.fit_india_ambassadors')}} <!--Fit India Ambassadors--></a></li>
					</ul>
					<!-- </a> -->
				</li>
				<li class="nav-item {{ (request()->is('schooldashboard')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('schooldashboard')) ? 'active' : '' }}" href="{{ url('schooldashboard') }}">{{ __('home_content.Fit_India_Dashboard')}}<!--Contact us--></a></li>


				<!--
				<li class="nav-item {{ (request()->is('fitnessprotocols')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('fitnessprotocols')) ? 'active' : '' }}" href="{{ url('fitnessprotocols') }}">Fitness Protocols</a></li>
				-->
				<!--  <li class="nav-item {{ (request()->is('fit-india-yoga-centres')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('fit-india-yoga-centres')) ? 'active' : '' }}" href="{{ url('fit-india-yoga-centres') }}">Fit India Yoga Centres</a></li> -->

				<!-- <li class="nav-item {{ (request()->is('your-stories')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('your-stories')) ? 'active' : '' }}" href="{{ url('your-stories') }}">Share Your Fitness Story</a></li> -->
				<li class="nav-item {{ (request()->is('fit-india-yoga-centres')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('contact-us')) ? 'active' : '' }}" href="{{ url('contact-us') }}">{{ __('home_content.Contact_Us')}} <!--Contact us--></a></li>
				<!--
				<li class="nav-item {{ (request()->is('contact-us')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('indigenoussports')) ? 'active' : '' }}" href="{{ url('indigenoussports') }}">Indigenous Games</a></li>
				-->
				<!-- <li class="nav-item {{ (request()->is('media')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('media')) ? 'active' : '' }}" href="{{ url('media') }}">Media</a></li>
				<li class="nav-item">
				<a class="nav-link" href="get-active">Get Active</a>
				</li> -->
				<!-- <li class="nav-item {{ (request()->is('contact-us')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('contact-us')) ? 'active' : '' }}" href="{{ url('contact-us') }}">Contact Us</a></li> -->
			  </ul>
			</div>
		  </nav>
		</div>
	  </div>
	</div>



