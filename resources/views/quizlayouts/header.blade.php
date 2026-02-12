 <div class="container-fluid contr-bx">
    <div class="header on-print">
        <div class="head-rw">
          <div class="row">
            <div class="col-3">
              <a href="home" class="fit-logo">
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
				    <a class="nav-link  home-menu {{ (request()->is('home')) ? 'active' : '' }}" href="{{ route('home') }}"><i class="fa fa-home home_nav" aria-hidden="true" ></i><span class="menu-txt">{{ __('sentence.home')}} <!--Home--></span></span></a>
				</li>

				<li class="nav-item {{ (request()->is('fit-india-school-week-2020') || request()->is('fit-india-cyclothon-2020')) ? 'active' : 'active' }}">
				 <a class="nav-link  {{ (request()->is('fit-india-school-week-2020') || request()->is('fit-india-cyclothon-2020')) ? 'active' : '' }}" href="fit-india-school-week-2020"><span class="menu-txt">{{ __('sentence.events')}} <!--Events--></span><span class="m-arrow">
					 <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" /></svg></span>
				</a>

				 <ul class="sub-menu">
	                   <li class="nav-item {{ (request()->is('fit-india-school-week-2020')) ? 'active' : 'active' }}">
	                   	<a class="nav-link  {{ (request()->is('fit-india-school-week-2020')) ? 'active' : '' }}"
	                   		href="{{ url('fit-india-school-week') }}">{{ __('sentence.fit-india-school-week')}}  <!--Fit India School Week 2020--></a>
	                   </li>
	                   <li class="nav-item  {{ (request()->is('fit-india-cyclothon-2020')) ? 'active' : 'active' }}"><a class="nav-link {{ (request()->is('fit-india-cyclothon-2020')) ? 'active' : '' }}" href="{{ url('fit-india-cyclothon-2020') }}">{{ __('sentence.fit-india-cyclothon-2020')}} <!--Fit India Cyclothon 2020--></a></li>

					<!--<li class="nav-item {{ (request()->is('event-archives')) ? 'active' : 'active' }}">
	                   	<a class="nav-link  {{ (request()->is('event-archives')) ? 'active' : '' }}"
	                   		href="{{ url('event-archives') }}">Event Archives</a>
	                   </li> -->
					</ul>
				</li>

				<li class="nav-item {{ (request()->is('fit-india-school') || request()->is('fit-india-youth-club-certification')) ? 'active' : '' }}">
				 <a class="nav-link  {{ (request()->is('fit-india-school') || request()->is('fit-india-youth-club-certification')) ? 'active' : '' }}" href="fit-india-school"><span class="menu-txt">{{ __('sentence.fit_india_certification')}}</span><span class="m-arrow"><svg
					xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
					<path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" /></svg></span></a>
					  <ul class="sub-menu">
		               <li class="nav-item {{ (request()->is('fit-india-school')) ? 'active' : 'active' }}">
					  	 <a class="nav-link {{ (request()->is('fit-india-school')) ? 'active' : '' }}" href="{{ url('fit-india-school') }}">{{ __('sentence.fit_india_school')}}</a></li>
		              <li class="nav-item {{ (request()->is('fit-india-youth-club-certification')) ? 'active' : 'active' }}">
					  	<a class="nav-link {{ (request()->is('fit-india-youth-club-certification')) ? 'active' : '' }}" href="{{ url('fit-india-youth-club-certification') }}">{{ __('sentence.fit-india-youth-club-certification')}}</a></li>
		              </ul>
				</li>


				<li class="nav-item {{ (request()->is('fit-india-dialogue') || request()->is('dialogue-session-2')) ? 'active' : '' }}">
				<a class="nav-link  {{ (request()->is('fit-india-dialogue') || request()->is('dialogue-session-2')) ? 'active' : '' }}"
				 href="fit-india-dialogue"><span class="menu-txt">Dialogue Session</span><span class="m-arrow"><svg
					xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
					<path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" /></svg></span></a>
					<ul class="sub-menu">
		             <li class="nav-item {{ (request()->is('fit-india-school')) ? 'active' : 'active' }}">
					  <a class="nav-link {{ (request()->is('fit-india-dialogue')  ? 'active' : '' )}}" href="{{ route('fit-india-dialogue') }}">Dialogue Session 1</a>
					 </li>
		             <li class="nav-item {{ (request()->is('dialogue-session-2')  ? 'active' : '' )}}"><a class="nav-link {{ (request()->is('dialogue-session-2')  ? 'active' : '' )}}" href="{{ url('dialogue-session-2') }}">Dialogue Session 2</a></li>
		            </ul>
				</li>
				<!-- <li class="nav-item {{ (request()->is('influencer')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('influencer')) ? 'active' : '' }}" href="{{ url('influencer') }}">Fit India Influencer</a></li> -->

				<li class="nav-item {{ (request()->is('influencer') || request()->is('influencer')) ? 'active' : '' }}">
				<a class="nav-link  {{ (request()->is('influencer') || request()->is('influencer')) ? 'active' : '' }}"
				 href="influencer"><span class="menu-txt">Fit India Influencer</span><span class="m-arrow"><svg
					xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
					<path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" /></svg></span></a>
					<ul class="sub-menu sub-menu_width">
		             <li class="nav-item ">
					  <a class="nav-link {{ (request()->is('influencer')  ? 'active' : '' )}}" href="{{ url('influencer') }}">Prerak/ ambassador/ champion </a>
					 </li>
					 <li class="nav-item ">
					   <a class="nav-link {{ (request()->is('fit-india-localbody')  ? 'active' : '' )}}" href="{{ url('fit-india-localbody') }}">Urban local body ambassador</a>
					   </li>
		             <li class="nav-item ">
					   <a class="nav-link {{ (request()->is('fit-india-panchayat')  ? 'active' : '' )}}" href="{{ url('fit-india-panchayat') }}">Gram panchayat Ambassador  </a>
					   </li>

		            </ul>
				</li>






				<!-- <li class="nav-item {{ (request()->is('fit-india-ambassador')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('fit-india-ambassador')) ? 'active' : '' }}" href="{{ url('fit-india-ambassador') }}">Fit India Ambassadors</a></li>

				<li class="nav-item {{ (request()->is('fit-india-champions')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('fit-india-champions')) ? 'active' : '' }}" href="{{ url('fit-india-champions') }}">Fit India Champions</a></li> -->

				<li class="nav-item {{ (request()->is('fit-india-icons')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('fit-india-icons')) ? 'active' : '' }}" href="{{ url('fit-india-icons') }}">Fit India Icons</a></li>

				<li class="nav-item {{ (request()->is('fitnessprotocols')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('fitnessprotocols')) ? 'active' : '' }}" href="{{ url('fitnessprotocols') }}">Fitness Protocols</a></li>
				<li class="nav-item {{ (request()->is('your-stories')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('your-stories')) ? 'active' : '' }}" href="{{ url('your-stories') }}">Share Your Fitness Story</a></li>
				<li class="nav-item {{ (request()->is('fit-india-yoga-center')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('fit-india-yoga-center')) ? 'active' : '' }}" href="{{ url('fit-india-yoga-center') }}">Fit India Yoga Centers</a></li>
				<!-- <li class="nav-item {{ (request()->is('fitnessprotocols2')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('fitnessprotocols2')) ? 'active' : '' }}" href="{{ url('fitnessprotocols2') }}">Urban local Body Ambassador</a></li>
				<li class="nav-item {{ (request()->is('contact-us1')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('indigenoussports1')) ? 'active' : '' }}" href="{{ url('indigenoussports1') }}">Gram Panchayat Ambasaador</a></li> -->

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



