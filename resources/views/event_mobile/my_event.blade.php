@extends('Influencerlayout.app')
@section('title', 'My Events | Fit India')
@section('content')

<style>
	.organiser_name {
		font-size: 13px;
	}
</style>

<div class="banner_area">

	<img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />

	<div class="container">
		<div class="et_pb_row mrs">
			<div class="row ">
				@include('event_mobile.sidebar')
				<div class="col-sm-12 col-md-9 ">
					<div class="description_box">
						<h2 class="ml-3">My Events</h2>

						@if (session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
						@endif

						<div class="all-events">

							<select class="select_location ml-3 mb-3" style="width:80%">
								<option <?php if ($year == 2021) {
											echo  "selected='selected'";
										} ?> value="{{ url('mobile-my-events/2021') }}/?auth_id=<?= $_REQUEST['auth_id'] ?>">Fit India School Week 2021</a>
								<option <?php if ($year == 2020) {
											echo  "selected='selected'";
										} ?> value="{{route('mobile-my-events')}}/?auth_id=<?= $_REQUEST['auth_id'] ?>">Others</option>
							</select>
							@if(!empty($events))
							@foreach($events as $event)

							<?php
							$date =  $event->eventstartdate;
							$month = date('M', strtotime($date));
							$show_date = date('j', strtotime($date));
							?>
							<article class="cards-list">
								<div class="card-img">
									<img src="{{ $event->eventimage1 }}" alt="FIT INDIA" class="fluid-img">
									<div class="card-left">
										<div class="__evt-date-col">
											<p class="__evt-date"><?php echo $show_date; ?></p>
											<p class="__evt-month"><?php echo $month; ?></p>
										</div>
									</div>
								</div>

								<div class="card-details">

									<div class="card-right">

										<div class="card-title card-title-cus">
											<h4>
												{{ $event->name }}
										</div>
										<div class="venue-details">
											<span class="participantnum"> Participants : {{ $event->participantnum }} </span>
											@if(!empty($event->kmrun)) <br><span class="kmrun"> Km(Ride) : {{ $event->kmrun }} </span> @endif
											<br><span class="organiser_name"> Organisation name : {{ $event->organiser_name }} </span>
										</div>

									</div>
								</div>
								<div class="join-btn" style="position: inherit;">

									<div class="add">
										<a class="add-participants" href="{{ route('mobile-add-participant', $event->id )}}?auth_id=<?= @$_REQUEST['auth_id'] ?>">Add Participants</a>
									</div>

									<div class="editdel">
										<a class="edit-event " href="{{ route('mobile-eventedit', $event->id) }}?auth_id=<?= @$_REQUEST['auth_id'] ?>">Edit</a>



										<form action="{{ route('mobile-eventdestroy',$event->id) }}?auth_id=<?= @$_REQUEST['auth_id'] ?>" method="POST" class="form_del">
											@csrf
											@method('DELETE')
											<button class="delete-event" type="submit" onclick="return confirm('Are you sure, You want to delete this event ?')">Delete</button>
										</form>

									</div>


									<!-- <div class="add">
												<a class="dwnl-btn add-participants" href="{{ route('mobile-event-e-cert', $event->id) }}?auth_id=<?= @$_REQUEST['auth_id'] ?>">Download Certificate</a>
												<br>
											</div> -->

								</div>
							</article>
							@endforeach
							@else
							<div class="no-events">
								You do not have added any Event. Do you want to organise an Event? please <a href="">Click</a>
							</div>
							@endif
							<div class="fi-certnote">NOTE : Certificate can only be downloaded by the End of the Event date Selected by You.</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br><br><br><br>
</div>

<script>
	$('.select_location').on('change', function() {
		window.location = $(this).val();
	});
</script>


@endsection