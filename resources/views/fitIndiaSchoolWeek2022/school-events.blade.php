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
                <div class="et_pb_row" style="padding-top: 0px; padding-bottom:0px;">
                    <div class="row ">
						@include('event.sidebar')
                        <div class="col-sm-12 col-md-9  school_update" >
                            <div class="description_box">
                                <h2>My Events</h2>
								
									@if (session('success'))
										<div class="alert alert-success">
											{{ session('success') }}
										</div>
									@endif
									
								<div class="all-events">
									<select class="select_location select_location_width" >
										<option <?php if($year=='22'){ echo "selected='selected'"; }?> value="{{ url('school-events') }}">Fit India Week 2023</option>
										
									</select>
									@if(!empty($freedom_event))
                                    @foreach($freedom_event as $event)
									
									<?php
									$date =  $event->eventstartdate;
									$month = date('M', strtotime($date));
									$show_date = date('j', strtotime($date));
									
									$img_arr = unserialize($event->eventimg_meta);
									
									$image_index_count = count($img_arr);
									// $pnt_arr = unserialize($event->eventpnt_meta);
									// $kms_arr = unserialize($event->eventkm_meta);
									
									?>
									<article class="cards-list">
										<div class="card-img  parentDiv">
										  @if(isset($event->event_bg_image))
											<img src="{{ $event->event_bg_image }}" alt="FIT INDIA" class="fluid-img child_div">
												<div class="card-left">
												  <div class="__evt-date-col">
													  <p class="__evt-date"><?php echo $show_date; ?></p>
													  <p class="__evt-month"><?php echo $month; ?></p>
												  </div>
											    </div>
                                          @endif												
										</div>

										<div class="card-details" style="padding: 0px 15px 10px 15px;">
										
											<div class="card-right">
												
												<div class="card-title card-title-cus">
												 <h4>Fit India Week 2023</h4>
												 	
												</div>
												<div class="venue-details" style="display:flex; flex-direction:column; ">
												   <div class="participantnum"> Participants :  {{ $event->total_participant ?? 0}}</div> 
												   @if(!empty($event->kmrun)) <br><span class="kmrun"> Km(Ride) :  {{ $event->kmrun }}  </span> @endif
												   {{-- <div class="sm_vl" style="height: 20px;  border:1px solid #DCDCDC; width:1px;"></div> --}}
												   {{-- <br> --}}
												   <div class="organiser_name" style="word-wrap: break-word"> Organisation name : {{ $event->organiser_name }} </div>	
												</div>
												
											</div>
										</div>
										@php
											// $encryptedid = Crypt::encrypt($event->id);
											$encryptedid = encrypt($event->id);
											// $decryptedid = Crypt::decrypt($encryptedid);											
											// echo $decryptedid;
										@endphp		
										<div class="join-btn" style="position: inherit;">
											<div class="editdel" style="padding: 10px 15px 5px 15px; display:flex; align-items:center; justify-content:center;">
												<!--  <a class="edit-event" href="javascript:void(0);" style=" pointer-events: none;">Edit</a> -->
												<a class="edit-event" style="width: 50%; background-color:#FFAA00; text-transform:uppercase; color:#ffffff; font-size:12px;" href="{{ url('school-run-update', $encryptedid) }}">
													<img src="{{url('resources/imgs/school_event/edit-fill.svg')}}" alt="" style="margin-right:2px ">Edit</a>
																						
												<form action="{{ route('school-event-destroy',$encryptedid) }}" method="POST"  class="form_del">
												  @csrf
												  @method('DELETE')
												 <button class="delete-event" style="line-height: 1.8; background-color:#E4083B; text-transform:uppercase; display:flex; justify-content:center; align-items:center;  font-size:12px;" type="submit" onclick="return confirm('Are you sure, You want to delete this event ?')" ><img src="{{url('resources/imgs/school_event/delete-bin-6-fill.svg')}}" alt="" style="margin-right:2px; height:11px;">Delete</button>
												</form>
			 
											</div>
												
											<div class="add mb-1" >
												<a class="add-participants btn-magenta" href="{{ url('school-run-update', $encryptedid) }}" style="background-color:#7E00DE; border-color:#7E00DE; font-size:12px;">
													ADD EVENT PICTURES & VIDEOS
												</a>
											</div>
											<div class="add mb-1">
												<a class="add-participants btn-magenta" href="{{ url('event-uploadexcel', $encryptedid )}}" style="background-color:#7E00DE; border-color:#7E00DE; font-size:12px;">SUGGEST OUTSTANDING SPORT TALENT</a>
											</div>
											<div class="add">
												<?php 
												  /*  if( in_array( "" ,$pnt_arr ) || in_array( "" ,$kms_arr ))
													{ ?>
    													<a class="dwnl-btn add-participants" href="javascript:void(0);" onclick="return alert('Please fill all the participant details')" >Download Certificate</a>	
													<?php 
													}else{*/ ?>
														<a class="dwnl-btn add-participants" href="{{ url('school-certificate-process', $encryptedid) }}" style="background-color:#7E00DE; border-color:#7E00DE;  font-size:12px;">DOWNLOAD CERTIFICATE</a>

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
