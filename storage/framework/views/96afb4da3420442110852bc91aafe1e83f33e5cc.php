 <!-- pop area -->
<!--  <?php if( Request::path() === '/'): ?>
<div class="popup-window" id="popup-ad">
	<div class="popup-dv">
		<div class=" rslides_container card ">
			<span class="close-ad">&nbsp;</span>
			<h2>Important Notice</h2>
			<p>Fit India Quiz has been postponed. We will share the updated dates very soon...</p>
		</div>
	</div>
</div>
<?php endif; ?>
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
              
              <a href="<?php echo e(url('/home')); ?>" class="fit-logo">
                <img src="<?php echo e(asset('resources/imgs/fit-india_logo.png')); ?>" alt="Fit India">
              </a>
            </div>
            <div class="col-6">
              <span class="gov-logo">
			  <a class="getlink " data-link="https://yas.nic.in/" href="javascript:void(0);">
                <img src="<?php echo e(asset('resources/imgs/gov_logo.png')); ?>" alt="Government of India">
			  </a>
			  </span>
            </div>
            <div class="col-3 text-right">
			<a class="getlink sai-logo" data-link="https://sportsauthorityofindia.nic.in/" href="javascript:void(0);" class="sai-logo">
               <img src="<?php echo e(asset('resources/imgs/sai_trans_logo_new.jpg')); ?>" alt="SAI">
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
				<li class="nav-item <?php echo e((request()->is('home')) ? 'active' : 'active'); ?>">
				    <a class="nav-link  home-menu <?php echo e((request()->is('home')) ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>"><i class="fa fa-home home_nav" aria-hidden="true" ></i><span class="menu-txt"><?php echo e(__('home_content.home')); ?> <!--Home--></span></span></a>
				</li>
				
				
				<li class="nav-item <?php echo e((request()->is('fit-india-cycling-drive')) ? 'active' : 'active'); ?>">
				  <a class="nav-link  home-menu <?php echo e((request()->is('fit-india-cycling-drive')) ? 'active' : ''); ?>" href="<?php echo e(url('fit-india-cycling-drive')); ?>"><?php echo e(__('home_content.fit-india-cycling-drive')); ?></span></a>
				</li>
				
				
				
				
				
				
				
				    
				    
				    
					
				

				
				
				
				


				<!--
				<ul class="sub-menu">
				<li class="nav-item <?php echo e((request()->is('fit-india-school-week')) ? 'active' : 'active'); ?>">
	              	<a class="nav-link  <?php echo e((request()->is('fit-india-school-week')) ? 'active' : ''); ?>"
	                		href="https://fitindia.gov.in/fit-india-freedom-rider-cycle-rally-2022">Fit India Freedom Rider-Cycle Rally</a>
	            </li>
				</ul>
				<ul class="sub-menu">
	            <li class="nav-item <?php echo e((request()->is('fit-india-school-week')) ? 'active' : 'active'); ?>">
	              	<a class="nav-link  <?php echo e((request()->is('fit-india-school-week')) ? 'active' : ''); ?>"
	                		href="<?php echo e(url('fit-india-school-week')); ?>"><?php echo e(__('home_content.fit-india-school-week')); ?>  </a>
	            </li> -->
	           <!--  <li class="nav-item  <?php echo e((request()->is('fit-india-cyclothon-2020')) ? 'active' : 'active'); ?>"><a class="nav-link <?php echo e((request()->is('fit-india-cyclothon-2020')) ? 'active' : ''); ?>" href="<?php echo e(url('fit-india-cyclothon-2020')); ?>"><?php echo e(__('home_content.fit-india-cyclothon-2020')); ?> </a></li> -->
	      <!--   </ul>	 -->



				<!--  <ul class="sub-menu">
				 	 <li class="nav-item  <?php echo e((request()->is('freedom-run-4.0')) ? 'active' : 'active'); ?>"><a class="nav-link <?php echo e((request()->is('freedom-run-4.0')) ? 'active' : ''); ?>" href="<?php echo e(url('freedom-run-4.0')); ?>"> <?php echo e(__('home_content.Freedomrun')); ?></a></li>
				 </ul>	 -->
	                   <!-- <li class="nav-item <?php echo e((request()->is('fit-india-school-week-2020')) ? 'active' : 'active'); ?>">
	                   	<a class="nav-link  <?php echo e((request()->is('fit-india-school-week-2020')) ? 'active' : ''); ?>"
	                   		href="<?php echo e(url('fit-india-school-week')); ?>">Fit India School Week 2020</a>
	                   </li>

	                   <li class="nav-item  <?php echo e((request()->is('fit-india-cyclothon-2020')) ? 'active' : 'active'); ?>"><a class="nav-link <?php echo e((request()->is('fit-india-cyclothon-2020')) ? 'active' : ''); ?>" href="<?php echo e(url('fit-india-cyclothon-2020')); ?>">Fit India Cyclothon 2020</a></li> -->

					<!--<li class="nav-item <?php echo e((request()->is('event-archives')) ? 'active' : 'active'); ?>">
	                   	<a class="nav-link  <?php echo e((request()->is('event-archives')) ? 'active' : ''); ?>"
	                   		href="<?php echo e(url('event-archives')); ?>">Event Archives</a>
	                   </li> -->

				

					

				<li class="nav-item <?php echo e((request()->is('fit-india-school') || request()->is('fit-india-youth-club-certification')) ? 'active' : ''); ?>">
				 <a class="nav-link  <?php echo e((request()->is('fit-india-school') || request()->is('fit-india-youth-club-certification')) ? 'active' : ''); ?>" href="fit-india-school"><span class="menu-txt"><?php echo e(__('home_content.fit_india_certification')); ?> <!--Fit India Certification--></span><span class="m-arrow"><svg
					xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
					<path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" /></svg></span></a>
					  <ul class="sub-menu">
		               <li class="nav-item <?php echo e((request()->is('fit-india-school')) ? 'active' : 'active'); ?>">
					  	 <a class="nav-link <?php echo e((request()->is('fit-india-school')) ? 'active' : ''); ?>" href="<?php echo e(url('fit-india-school')); ?>"><?php echo e(__('home_content.fit_india_school')); ?> <!--Fit India School--></a></li>
		              <li class="nav-item <?php echo e((request()->is('fit-india-youth-club-certification')) ? 'active' : 'active'); ?>">
					  	<a class="nav-link <?php echo e((request()->is('fit-india-youth-club-certification')) ? 'active' : ''); ?>" href="<?php echo e(url('fit-india-youth-club-certification')); ?>"><?php echo e(__('home_content.fit-india-youth-club-certification')); ?> <!--Fit India Youth Club--></a></li>
		              </ul>
				</li>


				

				
				<li class="nav-item <?php echo e((request()->is('namo-cycling-club') || request()->is('namo-fit-india-youth-club')) ? 'active' : ''); ?>">
					<a class="nav-link  <?php echo e((request()->is('namo-cycling-club') || request()->is('namo-fit-india-youth-club')) ? 'active' : ''); ?>"
					 
						href="javascript:void(0);"><span class="menu-txt"><?php echo e(__('home_content.namo-fit-india-club')); ?></span><span class="m-arrow"><svg
						xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
						<path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" /></svg></span></a>
						<ul class="sub-menu">
						 <li class="nav-item ">
						  <a class="nav-link <?php echo e((request()->is('namo-cycling-club')  ? 'active' : '' )); ?>" href="<?php echo e(url('namo-cycling-club')); ?>"><?php echo e(__('home_content.namo-fitIndia-club')); ?> <!--Dialogue Session 1--></a>
						 </li>
						 <li class="nav-item <?php echo e((request()->is('namo-fit-india-youth-club')  ? 'active' : '' )); ?>"><a class="nav-link <?php echo e((request()->is('namo-fit-india-youth-club')  ? 'active' : '' )); ?>" href="<?php echo e(url('namo-fit-india-youth-club')); ?>"><?php echo e(__('home_content.namo-fit-india-cycling-club')); ?> <!--Dialogue Session 2--></a></li>
						</ul>
				</li>

				<li class="nav-item <?php echo e((request()->is('influencer') || request()->is('influencer')) ? 'active' : ''); ?>">
					<a class="nav-link  <?php echo e((request()->is('influencer') || request()->is('influencer')) ? 'active' : ''); ?>" href="javascript:void(0);" pth="influencer"><span class="menu-txt"> <?php echo e(__('home_content.Fit_India_Influencer')); ?><!--Fit India Influencer--></span><span class="m-arrow"><svg
						xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
						<path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" /></svg></span>
					</a>
					<ul class="sub-menu sub-menu_width">

				<li class="nav-item <?php echo e((request()->is('fit-india-icons')) ? 'active' : ''); ?>"><a class="nav-link <?php echo e((request()->is('fit-india-icons')) ? 'active' : ''); ?>" href="<?php echo e(url('fit-india-icons')); ?>"><?php echo e(__('home_content.Fit_India_Icons')); ?> <!--Fit India Icons--></a></li>
				<li class="nav-item <?php echo e((request()->is('fit-india-champions')) ? 'active' : ''); ?>"><a class="nav-link <?php echo e((request()->is('fit-india-champions')) ? 'active' : ''); ?>" href="<?php echo e(url('fit-india-champions')); ?>"><?php echo e(__('home_content.fit_india_champions')); ?> <!--Fit India Champions--></a></li>
					<li class="nav-item <?php echo e((request()->is('fit-india-ambassador')) ? 'active' : ''); ?>"><a class="nav-link <?php echo e((request()->is('fit-india-ambassador')) ? 'active' : ''); ?>" href="<?php echo e(url('fit-india-ambassador')); ?>"><?php echo e(__('home_content.fit_india_ambassadors')); ?> <!--Fit India Ambassadors--></a></li>
					</ul>
					<!-- </a> -->
				</li>
				<li class="nav-item <?php echo e((request()->is('schooldashboard')) ? 'active' : ''); ?>"><a class="nav-link <?php echo e((request()->is('schooldashboard')) ? 'active' : ''); ?>" href="<?php echo e(url('schooldashboard')); ?>"><?php echo e(__('home_content.Fit_India_Dashboard')); ?><!--Contact us--></a></li>


				<!--
				<li class="nav-item <?php echo e((request()->is('fitnessprotocols')) ? 'active' : ''); ?>"><a class="nav-link <?php echo e((request()->is('fitnessprotocols')) ? 'active' : ''); ?>" href="<?php echo e(url('fitnessprotocols')); ?>">Fitness Protocols</a></li>
				-->
				<!--  <li class="nav-item <?php echo e((request()->is('fit-india-yoga-centres')) ? 'active' : ''); ?>"><a class="nav-link <?php echo e((request()->is('fit-india-yoga-centres')) ? 'active' : ''); ?>" href="<?php echo e(url('fit-india-yoga-centres')); ?>">Fit India Yoga Centres</a></li> -->

				<!-- <li class="nav-item <?php echo e((request()->is('your-stories')) ? 'active' : ''); ?>"><a class="nav-link <?php echo e((request()->is('your-stories')) ? 'active' : ''); ?>" href="<?php echo e(url('your-stories')); ?>">Share Your Fitness Story</a></li> -->
				<li class="nav-item <?php echo e((request()->is('fit-india-yoga-centres')) ? 'active' : ''); ?>"><a class="nav-link <?php echo e((request()->is('contact-us')) ? 'active' : ''); ?>" href="<?php echo e(url('contact-us')); ?>"><?php echo e(__('home_content.Contact_Us')); ?> <!--Contact us--></a></li>
				<!--
				<li class="nav-item <?php echo e((request()->is('contact-us')) ? 'active' : ''); ?>"><a class="nav-link <?php echo e((request()->is('indigenoussports')) ? 'active' : ''); ?>" href="<?php echo e(url('indigenoussports')); ?>">Indigenous Games</a></li>
				-->
				<!-- <li class="nav-item <?php echo e((request()->is('media')) ? 'active' : ''); ?>"><a class="nav-link <?php echo e((request()->is('media')) ? 'active' : ''); ?>" href="<?php echo e(url('media')); ?>">Media</a></li>
				<li class="nav-item">
				<a class="nav-link" href="get-active">Get Active</a>
				</li> -->
				<!-- <li class="nav-item <?php echo e((request()->is('contact-us')) ? 'active' : ''); ?>"><a class="nav-link <?php echo e((request()->is('contact-us')) ? 'active' : ''); ?>" href="<?php echo e(url('contact-us')); ?>">Contact Us</a></li> -->
			  </ul>
			</div>
		  </nav>
		</div>
	  </div>
	</div>



<?php /**PATH C:\xampp\htdocs\fitindiaweb_gitnew\resources\views/layouts/header.blade.php ENDPATH**/ ?>