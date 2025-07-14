@php
$route = explode('@', Route::currentRouteAction());
//use \App\Models\Prerak;
//use \App\Models\FitnessEnthusias;
@endphp
<?php 
$auth_id = $_REQUEST['auth_id'];
$user = DB::table('users')->where('id',$auth_id)->first();
$roleable_new = strtolower($user->role);
$authid = $user->id;	
?>

<div class="col-sm-12 col-md-3">
    <div class="events-sidebar">
	

    <a href="{{ route('mobile-create-event') }}?auth_id=<?=@$_REQUEST['auth_id']?>" class="create_events {{ ($route[1] == 'createevent') ? 'active' : '' }}" >
			<span class="dashicons dashicons-edit"></span>Organise an Event
		</a>
    <!--     <a href="{{ route('my-events') }}" class="my-events {{ ($route[1] == 'myevents') ? 'active' : '' }}">
			<span class="dashicons dashicons-list-view"></span>My Events
		</a> -->
		<?php //echo "===>>>".$route[1]; ?>
<a href="{{url('mobile-my-events/2021')}}?auth_id=<?=@$_REQUEST['auth_id']?>" class="my-events d-flex flex-row {{ ($route[1] == 'myevents') || ($route[1] == 'myEventsByYear') || ($route[1] == 'freedomrunEvents') ? 'active' : '' }}">
			<span class="dashicons dashicons-list-view"></span><span>My Events</span>
		</a>
		<!-- <a href="{{ route('freedomrun-events') }}" class="my-events d-flex flex-row {{ ($route[1] == 'freedomrunEvents') ? 'active' : '' }}">
			<span class="dashicons dashicons-list-view"></span><span>My Events</span>
		</a> -->
		<!-- <a href="{{ route('eventspic') }}" class="my-events {{ ($route[1] == 'eventspic') ? 'active' : '' }}">
			<span class="dashicons dashicons-format-gallery"></span>My Event Pics
		</a> -->

	<!-- 	<a href="{{ route('freedomrun-events-pics') }}" class="my-events d-flex flex-row {{ ($route[1] == 'freedomrunEventsPics') || ($route[1] == 'eventspic') ? 'active' : '' }}">
			<span class="dashicons dashicons-format-gallery"></span><span>My Event Pics</span>
		</a> -->
 
		<a href="{{ url('mobile-eventspic/2021') }}?auth_id=<?=@$_REQUEST['auth_id']?>" class="my-events d-flex flex-row {{ ($route[1] == 'eventspic') || ($route[1] == 'eventsPicByYear') || ($route[1] == 'freedomrunEventsPics') ? 'active' : '' }}">
			<span class="dashicons dashicons-format-gallery"></span><span>My Event Pics</span>
		</a> 

	
    </div>
</div>