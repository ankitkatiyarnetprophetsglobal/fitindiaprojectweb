@php
$route = explode('@', Route::currentRouteAction());
//use \App\Models\Prerak;
//use \App\Models\FitnessEnthusias;
@endphp
<?php 
//$prerak_data = Prerak::where('email',Auth::user()->email)->first();
//$fitness_data = FitnessEnthusias::where('email',Auth::user()->email)->first();


$roleable_new = strtolower(Auth::user()->role);
	$authid = Auth::user()->id;	
$role =	strtolower(Auth::user()->role);
?>

<div class="col-sm-12 col-md-3">
    <div class="events-sidebar">
	
	<?php /*
    	@if($roleable_new == 'subscriber')
			<a href="{{ url('prerak') }}" class="my-events">
				<span class="dashicons dashicons-star-half"></span>Fit India 
				<?php
				if(!empty($prerak_data)){ 
					$sumof_follower = $prerak_data->facebook_profile_followers+$prerak_data->twitter_profile_followers+$prerak_data->instagram_profile_followers;
					if($sumof_follower < 10000){
						$up_level = "Prerak";
					}elseif($sumof_follower >= 10000 && $sumof_follower <= 100000){
						$up_level = "Ambassador";
					}else{
						$up_level = "Champion";	
					}
				}elseif(!empty($fitness_data)){ 
					$up_level = "Prerak";
				}else{ 
					$up_level = 'Influencer';
				}
				echo $up_level;
				?> 
					@if(\App\Models\Prerak::where('email',Auth::user()->email)->where('status','0')->first())
						<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-warning">Pending</span>
					@elseif(\App\Models\Prerak::where('email',Auth::user()->email)->where('status','1')->first())
						<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-success">Approved</span>
					@elseif(\App\Models\Prerak::where('email',Auth::user()->email)->where('status','2')->first())
						<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-danger">Rejected</span>
					@elseif(\App\Models\FitnessEnthusias::where('email',Auth::user()->email)->where('status','0')->first())
						<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-warning">Pending</span>
					@elseif(\App\Models\FitnessEnthusias::where('email',Auth::user()->email)->where('status','1')->first())
						<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-success">Approved</span>
					@elseif(\App\Models\FitnessEnthusias::where('email',Auth::user()->email)->where('status','2')->first())
						<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-danger">Rejected</span>
					@else
						<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400; background-color:#ff8000;" class="badge badge-info">Apply</span>
					@endif
			</a>
		@endif

	@if($roleable_new == 'gram_panchayat')
    	<a href="{{ route('gram-panchayat-ambassador') }}" class="my-events">
			<span style="margin-right: 10px;height: 23px; position: relative;float: left;" class="dashicons dashicons-star-half"></span>Fit India Gram Panchayat Ambassador 
			@if(\App\Models\GramPanchayat::where('email',Auth::user()->email)->where('status','0')->first())
				<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-warning">Pending</span>
			@elseif(\App\Models\GramPanchayat::where('email',Auth::user()->email)->where('status','1')->first())
					<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-success">Approved</span>
			@elseif(\App\Models\GramPanchayat::where('email',Auth::user()->email)->where('status','2')->first())
					<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-danger">Rejected</span>
			@else
				<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400; background-color:#ff8000;" class="badge badge-info">Apply</span>
			@endif
		</a>
	@endif

	@if($roleable_new == 'lbambassador')
    	<a href="{{ route('local-bodyambassador') }}" class="my-events">
			<span style="margin-right: 10px;height: 23px; position: relative;float: left;" class="dashicons dashicons-star-half"></span>Fit India Urban Local Body Ambassador 
			@if(\App\Models\LocalBody::where('email',Auth::user()->email)->where('status','0')->first())
				<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-warning">Pending</span>
			@elseif(\App\Models\LocalBody::where('email',Auth::user()->email)->where('status','1')->first())
					<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-success">Approved</span>
			@elseif(\App\Models\LocalBody::where('email',Auth::user()->email)->where('status','2')->first())
					<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-danger">Rejected</span>
			@else
				<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400; background-color:#ff8000;" class="badge badge-info">Apply</span>
			@endif
		</a>
	@endif
*/?>

<?php 
 
  //echo  $route = Route::current(); 
	//echo $routename = $route->getName();
 //echo "=====".strtolower(Auth::user()->rolelabel);
 //strtolower($roleable_new);
 ?>


	@if(strtolower($role) == 'youth club')
    	<a href="{{ route('youthcert') }}" class="my-events {{ request()->is('fit-india-youth-club-certificate') ? 'active' : '' }}">
			<span class="dashicons dashicons-star-half"></span>Fit India Youth Club Certification
		</a>
	@endif
	
		
	
		@if(strtolower($role) == 'school')
	    	<a href="{{ route('schoolcert') }}" class="my-events {{ ($route[1] == 'index') ? 'active' : '' }}">
				<span class="dashicons dashicons-star-half"></span>Fit India School Certification
			</a>
		@endif	
		<a href="{{ route('create-freedomrun-event') }}" class="create_events d-flex flex-row {{ ($route[1] == 'createFreedomrunEvent') || ($route[1] == 'showEventUpdateDetails') || ($route[1] == 'update') ? 'active' : '' }}" >
			<span class="dashicons dashicons-edit"></span><span>Organise an Event</span>
		</a>
	<!-- 	@if(strtolower($role) != 'individual') 
		
		@endif 
		@if(strtolower($role) == 'school' OR strtolower($roleable_new) == 'ghd')
    		<a href="{{ route('create-event') }}" class="create_events {{ ($route[1] == 'createevent') ? 'active' : '' }}" >
				<span class="dashicons dashicons-edit"></span>Organise an Event
			</a>
		@endif	
		
		<a href="{{ route('create-event') }}" class="create_events {{ ($route[1] == 'createevent') ? 'active' : '' }}" >
				<span class="dashicons dashicons-edit"></span>Organise an Event
			</a>
-->

    <!--     <a href="{{ route('my-events') }}" class="my-events {{ ($route[1] == 'myevents') ? 'active' : '' }}">
			<span class="dashicons dashicons-list-view"></span>My Events
		</a> 
		
		<a href="{{url('my-events/2022')}}" class="my-events d-flex flex-row {{ ($route[1] == 'myEventsByYear') ? 'active' : '' }}">
			<span class="dashicons dashicons-list-view"></span><span>My Events</span>
		</a>
		-->
		<a href="{{ route('freedomrun-events') }}" class="my-events d-flex flex-row {{ ($route[1] == 'freedomrunEvents') ? 'active' : '' }}">
			<span class="dashicons dashicons-list-view"></span><span>My Events</span>
		</a>
		<a href="{{ route('freedomrun-events-pics') }}" class="my-events d-flex flex-row {{ ($route[1] == 'freedomrunEventsPics') || ($route[1] == 'eventspic') ? 'active' : '' }}">
			<span class="dashicons dashicons-format-gallery"></span><span>My Event Pics</span>
		</a>
		<?php /*
		if($roleable_new=='school'){
		?>
    <a href="{{url('my-events/schoolweek-2021')}}" class="my-events d-flex flex-row {{ ($route[1] == 'myEventsByYear') ? 'active' : '' }}">
			<span class="dashicons dashicons-list-view"></span><span>My Events</span>
		</a>
		<?php }elseif($roleable_new=='ghd'){
 		//if($roleable_new=='subscriber' OR $roleable_new=='ghd'){
		?>
    <a href="{{url('my-events/cyclothon-2021')}}" class="my-events d-flex flex-row {{ ($route[1] == 'myEventsByYear') ? 'active' : '' }}">
			<span class="dashicons dashicons-list-view"></span><span>My Events</span>
		</a>
		<?php }else{ ?>
		<a href="{{url('my-events')}}" class="my-events d-flex flex-row {{ ($route[1] == 'myevents') || ($route[1] == 'myevents') || ($route[1] == 'freedomrunEvents') ? 'active' : '' }}">
				<span class="dashicons dashicons-list-view"></span><span>My Events</span>
		</a>
		<?php } */?>

		<!--  <a href="{{url('my-events/2021')}}" class="my-events d-flex flex-row {{ ($route[1] == 'myevents') || ($route[1] == 'myEventsByYear') || ($route[1] == 'freedomrunEvents') ? 'active' : '' }}">
			<span class="dashicons dashicons-list-view"></span><span>My Events</span>
		</a> -->
		
		<!-- <a href="{{ route('freedomrun-events') }}" class="my-events d-flex flex-row {{ ($route[1] == 'freedomrunEvents') ? 'active' : '' }}">
			<span class="dashicons dashicons-list-view"></span><span>My Events</span>
		</a> -->
		<!-- <a href="{{ route('eventspic') }}" class="my-events {{ ($route[1] == 'eventspic') ? 'active' : '' }}">
			<span class="dashicons dashicons-format-gallery"></span>My Event Pics
		</a> -->

	<!-- 	 -->
 

 <?php /*
		if($roleable_new=='school'){
		?>
	 		<a href="{{ url('eventspic/schoolweek-2021') }}" class="my-events d-flex flex-row {{ ($route[1] == 'eventsPicByYear') ? 'active' : '' }}">
				<span class="dashicons dashicons-format-gallery"></span><span>My Event Pics</span>
			</a> 
		<?php }elseif($roleable_new=='ghd'){ ?>
			<a href="{{ url('eventspic/cyclothon-2021') }}" class="my-events d-flex flex-row {{ ($route[1] == 'eventsPicByYear') ? 'active' : '' }}">
				<span class="dashicons dashicons-format-gallery"></span><span>My Event Pics</span>
			</a> 
		<?php }else{ ?>
				<a href="{{ url('eventspic') }}" class="my-events d-flex flex-row {{ ($route[1] == 'eventspic') ? 'active' : '' }}">
				<span class="dashicons dashicons-format-gallery"></span><span>My Event Pics</span>
			</a> 
		<?php } 
		*/
		?>
		



		@if(\App\Models\Ambassador::where('email',Auth::user()->email)->where('status','1')->first() OR \App\Models\Champion::where('email',Auth::user()->email)->where('status','1')->first())
		
		<a href="{{ route('my-status') }}" class="my-events {{ ($route[1] == 'myApplicationStatus') ? 'active' : '' }}">
			<span class="dashicons dashicons-format-gallery"></span>My Application Status
		</a>

		@endif
		
		<!--	
		@if(strtolower($role) == 'school')
			<a href="{{ route('school-quiz') }}" class="my-events">
				<span class="dashicons dashicons-awards"></span>Fit India Quiz
			</a>
		@endif
		-->
	
    </div>
</div>