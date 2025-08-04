@extends('layouts.app')
@section('title', 'My Events | Fit India')
@section('content')
<style>
.organiser_name{font-size: 13px;}
.parentDiv{
height: 165px;
   
    width: 100%;

}

.child_div{
    object-fit: cover!important;
    width: 100%;
    height: 165px!important;
}
.card-title-cus h4{
	font-size:1.2rem!important;

}
.card-title-cus {
    margin-top: 25px;
}

.all-events>.cards-list>.card-img {
    padding: 10px;
}

</style>

<div class="banner_area">
	<img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
            @include('event.userheader')
            <div class="container">
                <div class="et_pb_row">
                    <div class="row ">
						@include('event.sidebar')
                        <div class="col-sm-12 col-md-9 ">
                            <div class="description_box">
                                <h2>My Events</h2>
								
									@if (session('success'))
										<div class="alert alert-success">
											{{ session('success') }}
										</div>
									@endif
									
								<div class="all-events">
									<select class="select_location select_location_width" >
										<option>Fit India Swachhata Freedom Run 4.0</option>
										{{-- <option <?php // if($year=='22'){ echo "selected='selected'"; }?> value="{{ url('freedomrun-events/22') }}">Fit India Freedom Run 3.0</option> --}}
										{{-- <option <?php // if($year=='cyclothon-2021'){ echo "selected='selected'"; }?> value="{{url('my-events/cyclothon-2021')}}">Fit India Fit Gujarat Cyclothon 2021 </option> --}}
										{{-- <option <?php // if($year=='schoolweek-2021'){ echo "selected='selected'"; }?> value="{{url('my-events/schoolweek-2021')}}">Fit India School Week 2021</a> --}}
										{{-- <option <?php // if($year=='2020'){ echo "selected='selected'"; }?> value="{{route('my-events')}}">Others</option> --}}
									</select>
									@if(!empty($events))
                                    @foreach($events as $event)
									
									<?php
									$date =  $event->eventstartdate;
									$month = date('M', strtotime($date));
									$show_date = date('j', strtotime($date));
									$img_arr = unserialize($event->eventimg_meta);
									$pnt_arr = unserialize($event->eventpnt_meta);
									$kms_arr = unserialize($event->eventkm_meta);
									
									?>
									<article class="cards-list">
										<div class="card-img  parentDiv">
										  @if(!empty($img_arr))
											<img src="{{ $img_arr[0] }}" alt="FIT INDIA" class="fluid-img child_div">
												<div class="card-left">
												  <div class="__evt-date-col">
													  <p class="__evt-date"><?php echo $show_date; ?></p>
													  <p class="__evt-month"><?php echo $month; ?></p>
												  </div>
											    </div>
                                          @endif												
										</div>

										<div class="card-details">
										
											<div class="card-right">
												
												<div class="card-title card-title-cus">
												 <h4>Fit India Swachhata Freedom Run 4.0</h4>
												 	
												</div>
												<div class="venue-details">
												   <span class="participantnum"> Participants :  @if( isset($pnt_arr) && is_array($pnt_arr)) {{array_sum($pnt_arr)}} @endif</span> 
												   @if(!empty($event->kmrun)) <br><span class="kmrun"> Km(Ride) :  {{ $event->kmrun }}  </span> @endif
												   <br><span class="organiser_name"> Organisation name : {{ $event->organiser_name }} </span>	
												</div>
												
											</div>
										</div>
										<div class="join-btn" style="position: inherit;">
										   
												<div class="add">
													<a class="add-participants" href="{{ url('freedom-run-partcipant', $event->id )}}">Add Participants</a>
												</div>
												
											<div class="editdel">
												<!--  <a class="edit-event" href="javascript:void(0);" style=" pointer-events: none;">Edit</a> -->
												<a class="edit-event" href="{{ url('freedom-run-update', $event->id) }}">Edit</a>
												
												
												<form action="{{ route('freedomrun-event-destroy',$event->id) }}" method="POST"  class="form_del">
												  @csrf
												  @method('DELETE')
												 <button class="delete-event" type="submit" onclick="return confirm('Are you sure, You want to delete this event ?')" >Delete</button>
												</form>
			 
											</div>
											
											
											<div class="add">
												<?php 
												  /*  if( in_array( "" ,$pnt_arr ) || in_array( "" ,$kms_arr ))
													{ ?>
    													<a class="dwnl-btn add-participants" href="javascript:void(0);" onclick="return alert('Please fill all the participant details')" >Download Certificate</a>	
													<?php 
													}else{*/ ?>
														<a class="dwnl-btn add-participants" href="{{ url('freedom-certificate-process', $event->id) }}">Download Certificate</a>

													<?php //} ?>
												<br>
											</div>
											
										</div>
									</article>
                                    @endforeach									
									@else
										<div class="no-events">
                                        You do not have added any Event. Do you want to organise an Event? please <a href="">Click</a>
										</div>
									@endif
									<div class="fi-certnote" >NOTE : Certificate can only be downloaded by the End of the Event date Selected by You.</div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br>
        </div>
		
<script>
			$('.select_location').on('change', function(){
				alert($(this).val());
   				window.location = $(this).val();
			});
		</script>
	
@endsection
