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

.fitindialong{
    height: 155px !important;
    width: 180px;
    display: block;
    margin: auto;
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
									
									@if(count($freedom_event) > 0)
										<select  name="category_name" id="category_name" class="fit-pe-inputs select_location mb-3" required>
											<option value="">Select Event Category</option>	
												@foreach ($categories as $key => $value)	
													<option value="{{ $value->id }}" <?php if($value->id == $freedom_event[0]['category']){ echo 'selected=selected'; }?>>{{$value->name}}</option>
												@endforeach
										</select>
									@else
										<select  name="category_name" id="category_name" class="fit-pe-inputs select_location mb-3" required>
											<option value="">Select Event Category</option>	
												@foreach ($categories as $key => $value)	
													<option value="{{ $value->id }}">{{$value->name}}</option>
												@endforeach
										</select>
									@endif									
								<div class="all-events">
									@if(count($freedom_event) > 0)
										@if(!empty($freedom_event))
											
											@foreach($freedom_event as $event)
											
											<?php											
												$encryptedid = encrypt($event->id);											
												$date =  $event->eventstartdate;
												$month = date('M', strtotime($date));
												$show_date = date('j', strtotime($date));									
												$img_arr = unserialize($event->eventimg_meta);
												$image_index_count = count($img_arr);
											?>
												{{-- <br/> --}}
												<article class="cards-list">
													<div class="card-img  parentDiv">
													{{-- @if(isset($event->event_bg_image)) --}}
													{{-- {{ asset('resources/imgs/fit-india_logo.png') }} --}}
														{{-- <img src="{{ $event->event_bg_image ?? asset('resources/imgs/fit-india_logo.png')}}" alt="FIT INDIA" class="fluid-img child_div"> --}}
														<img src="{{ $event->event_bg_image ?? asset('resources/imgs/fit-india_logo.png')}}" alt="FIT INDIA" class="fluid-img child_div fitindialong">
															<div class="card-left">
															<div class="__evt-date-col">
																<p class="__evt-date"><?php echo $show_date; ?></p>
																<p class="__evt-month"><?php echo $month; ?></p>
															</div>
															</div>
													{{-- @endif												 --}}
													</div>

													<div class="card-details" style="padding: 0px 15px 10px 15px;">
													
														<div class="card-right">
															
															<div class="card-title card-title-cus">
															<h4>{{ ucwords($event['event_name_store']) ?? '' }}</h4>															
															</div>														
															<div class="venue-details" style="display:flex; flex-direction:column; ">
															<div class="participantnum"> Participants :  {{ $event['participantnum'] ?? 0}}</div> 
																@if(!empty($event->kmrun)) <br><span class="kmrun"> Km(Ride) :  {{ $event->kmrun }}  </span> @endif
																<div class="organiser_name" style="word-wrap: break-word"> Organisation name : {{ $event->organiser_name }} </div>	
															</div>														
														</div>
													</div>
													<div class="join-btn" style="position: inherit;">
														<div class="editdel" style="padding: 10px 15px 5px 15px; display:flex; align-items:center; justify-content:center;">
															<a class="edit-event" style="width: 50%; background-color:#FFAA00; text-transform:uppercase; color:#ffffff; font-size:12px; " href="{{ url('event-run-update', $encryptedid) }}"><img src="{{url('resources/imgs/school_event/edit-fill.svg')}}" alt="" style="margin-right:2px ">Edit</a>
															<form action="{{ route('event-event-destroy',$event->id) }}" method="POST"  class="form_del">
																@csrf
																@method('DELETE')
																<button class="delete-event" style="line-height: 1.8; background-color:#E4083B; text-transform:uppercase; display:flex; justify-content:center; align-items:center;  font-size:12px;" type="submit" onclick="return confirm('Are you sure, You want to delete this event ?')" ><img src="{{url('resources/imgs/school_event/delete-bin-6-fill.svg')}}" alt="" style="margin-right:2px; height:11px;">Delete</button>
															</form>					
														</div>														
														<div class="add mb-1" >														
															<a class="add-participants btn-magenta" href="{{ url('event-run-update', encrypt($event->id)) }}" style="background-color:#7E00DE; border-color:#7E00DE; font-size:12px;"  >ADD EVENT PICTURES & VIDEOS</a>
														</div>
														<div class="add mb-1">
															<!-- <a class="add-participants btn-magenta" href="{{ url('event-event-uploadexcel', encrypt($event->id))}}" style="background-color:#7E00DE; border-color:#7E00DE; font-size:12px;">SUGGEST OUTSTANDING SPORT TALENT</a> -->
														</div>
													</div>
												</article>
											@endforeach									
										@else
										
											<div class="no-events">
												You do not have added any Event. Do you want to organise an Event? please <a href="">Click</a>
											</div>
										@endif
									@else
										<article>
											<br/>																					
											<div class="no-events">
												You do not have added any Event. Do you want to organise an Event? please <a href="{{ route('create-event') }}">Click</a>
											</div>
										</article>
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

		<script src="{{ asset('resources/js/crypto/crypto-js.js')}}"></script>
        <script>

			$('.select_location').on('change', function(){

				let id = $(this).val();
				// baseurl = "https://localhost/fitindiaweb_gitnew/";
				baseurl = "<?php echo config('app.website_url'); ?>";
				
				$.ajax({
					method: "GET",
					url: baseurl + "myeventsearch/"+id,
					contentType: false,
					processData: false,

					success: function (response) {	

						let html = ''
						
						if( response.success == true){								
							
							for(let i = 0; i < response.freedom_events?.length;i++){
								console.log("response.freedom_events",response.freedom_events[i]);
								newValue = response.freedom_events[i].eventstartdate;
								date = newValue.split("-",[3]);
								date2 = new Date(response.freedom_events[i].eventstartdate)
								const month = date[1].toLocaleString('default', { newValue: 'long' });
								let idvalue = response.freedom_events[i].id;
								// let encrypt_data = CryptoJS.AES.encrypt(JSON.stringify(response.freedom_events[i].id), "64", {format: CryptoJSAesJson}).toString();
								// var obj = JSON.parse(encrypt_data);
								// const myJSON = JSON.stringify(encrypt_data);
								// console.log("obj",myJSON);
								
								// let obj = JSON.parse(encrypt_data);
								// console.log("obj.ct",obj.ct);
								// console.log("obj.iv",obj.iv);
								// console.log("obj.s",obj.s);

								// const myJSON = JSON.stringify(encrypt_data);
								// console.log("myJSON",myJSON);

								// const encrypt_id = `<?php echo encrypt('."${response.freedom_events[i].id}".') ?>`;
								// console.log("myJSON232", encrypt_data);


								html +=`<article class="cards-list">									
											<div class="card-img  parentDiv">										
												<img src="${response.freedom_events[i].event_bg_image}" alt="FIT INDIA" class="fluid-img child_div">
												<div class="card-left">
													<div class="__evt-date-col">
														<p class="__evt-date">${date[2]}</p>
														<p class="__evt-month">${date2.toLocaleString('default', { month: 'short' })}</p>
													</div>
												</div>													                                         												
											</div>
											<div class="card-details" style="padding: 0px 15px 10px 15px;">														
												<div class="card-right">														
													<div class="card-title card-title-cus">
														<h4>${response.freedom_events[i].event_name_store.toUpperCase()}</h4>																		
													</div>															
													<div class="venue-details" style="display:flex; flex-direction:column; ">
														<div class="participantnum"> Participants :  ${response.freedom_events[i].participantnum}</div> 																	
														<div class="organiser_name" style="word-wrap: break-word"> Organisation name : ${response.freedom_events[i].organiser_name}</div>	
													</div>															
												</div>
											</div>
											<div class="join-btn" style="position: inherit;">
														<div class="editdel" style="padding: 10px 15px 5px 15px; display:flex; align-items:center; justify-content:center;">
															<a class="edit-event" style="width: 50%; background-color:#FFAA00; text-transform:uppercase; color:#ffffff; font-size:12px;" href="${baseurl}event-run-update/${response.freedom_events[i].encryptid}"><img src="{{url('resources/imgs/school_event/edit-fill.svg')}}" alt="" style="margin-right:2px ">Edit</a>																
															<form action="${baseurl}.'event-event-destroy/'.${response.freedom_events[i].id}" method="POST"  class="form_del">
																@csrf
																@method('DELETE')
																<button class="delete-event" style="line-height: 1.8; background-color:#E4083B; text-transform:uppercase; display:flex; justify-content:center; align-items:center;  font-size:12px;" type="submit" onclick="return confirm('Are you sure, You want to delete this event ?')" ><img src="{{url('resources/imgs/school_event/delete-bin-6-fill.svg')}}" alt="" style="margin-right:2px; height:11px;">Delete</button>
															</form>							
														</div>																
														<div class="add mb-1" >																
															<a class="add-participants btn-magenta" href="${baseurl}event-run-update/${response.freedom_events[i].encryptid}" style="background-color:#7E00DE; border-color:#7E00DE; font-size:12px;"  >ADD EVENT PICTURES & VIDEOS</a>
														</div>
														<div class="add mb-1">
															<a class="add-participants btn-magenta" href="${baseurl}event-event-uploadexcel/${response.freedom_events[i].encryptid}" style="background-color:#7E00DE; border-color:#7E00DE; font-size:12px;">SUGGEST OUTSTANDING SPORT TALENT</a>
														</div>
													</div>
												</div>										
										</article>`;
								}
							$('.all-events').html(html);
						}else{
							html +=`<article>
											<br/>										
											<h3 class="row mx-md-n5">
												<div class="col px-md-5">
													<div class="p-3 border bg-light text-center">
														Data Not Found
													</div>
												</div>
											</h3>										
									</article>`;

							$('.all-events').html(html);
						}

					}

				});
			});

			var CryptoJSAesJson = {

				stringify: function (cipherParams) {
					var j = {ct: cipherParams.ciphertext.toString(CryptoJS.enc.Base64)};
					if (cipherParams.iv) j.iv = cipherParams.iv.toString();
					if (cipherParams.salt) j.s = cipherParams.salt.toString();
					return JSON.stringify(j);
				},

				parse: function (jsonStr) {
					var j = JSON.parse(jsonStr);
					var cipherParams = CryptoJS.lib.CipherParams.create({ciphertext: CryptoJS.enc.Base64.parse(j.ct)});
					if (j.iv) cipherParams.iv = CryptoJS.enc.Hex.parse(j.iv)
					if (j.s) cipherParams.salt = CryptoJS.enc.Hex.parse(j.s)
					return cipherParams;
				}
			}
		</script>	
@endsection
