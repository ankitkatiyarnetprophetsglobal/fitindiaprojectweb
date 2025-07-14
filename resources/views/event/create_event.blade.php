@extends('layouts.app')
@section('title', 'Organise Event | Fit India')
@section('content')

<script>
	window.location = "{{ url('create-freedomrun-event') }}";
</script>

<div class="banner_area">
	<img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
			@include('event.userheader')
			
			
			
            <div class="container">
                <div class="et_pb_row">
                    <div class="row ">
                        
						@include('event.sidebar')
						
                        <div class="col-sm-12 col-md-9 ">
                            <div class="description_box">
							@php
							/*
							<p style="color: red; font-size: 22px;" >Stay Tuned for upcoming Fit India Events. </p>
							*/	
							@endphp	
							
							
                                <h2>Organise an Event</h2>
                                
								
								
								
								<div class="wrap event-form">	
									<!-- onsubmit="return create_event_validation()" -->

									@if (session('success'))
										<div class="alert alert-success">
											{{ session('success') }}
										</div>
									@endif
									
												
									<form name="createeventform" method="post" action="{{ route('store-event') }}" enctype="multipart/form-data" > 
											@csrf
											
											<input type="hidden" name="user_id" value="{{ Auth::id() }}"/>
											<div class="um-field">
													<div class="um-field-label">
														<label for="category">Event Category* </label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area"> 
														<select name="category" id="category" >
															<!-- <option value="">Select Category</option>
															@foreach($categories as $category)
																<option value="{{ $category->id }}" @if(!empty(old('category'))) @if(old('category') == $category->id) {{ 'selected' }}@endif @endif > {{ $category->name }} </option>
															@endforeach -->
															<?php /*
															if(Auth::user()->role == 'school'){ ?>
																<option value="13056"> Fit India School Week-2021</option>
															<?php }else{ ?>
															<option value="13057"> Fit India Fit Gujarat Cyclothon 2021 </option>
															<?php }
															<option value="13058">Fit India Freedom Rider-Cycle Rally</option>

															*/ ?>
															<option value="13059">National Sports Day 2022</option>
															{!!$errors->first("category", "<span class='text-danger'>:message</span>")!!}	
														</select>	
													</div>
											</div>
											{!!$errors->first("category", "<span class='text-danger'>:message</span>")!!}

								<div class="main_form" style="display: block;">	
											
											<div class="um-field"></div>
											<?php 
											if(Auth::user()->role == 'school'){ ?>
											<div class="um-field">
													<div class="um-field-label">
														<label for="eventname">Event Name*</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
													<input id="eventname" type="text" name="eventname" value="National Sports Day 2022" maxlength="120">
													{!!$errors->first("eventname", "<span class='text-danger'>:message</span>")!!}
														
													</div>
											</div>
										<?php }else{ ?>
											<input id="eventname" type="hidden" name="eventname" value="National Sports Day 2022" maxlength="120">
										<?php } ?>
								
								
											
											<div class="um-field">
													<div class="um-field-label">
														<label for="eventimage1">Event Image 1* (File size must be less tahn 2 MB)</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input type="file" id="eventimage1" name="eventimage1">
														{!!$errors->first("eventimage1", "<span class='text-danger'>:message</span>")!!}
													</div>
											</div>
											
											
											<div class="um-field">
													<div class="um-field-label">
														<label for="eventimage2">Event Image 2 (Optional) (File size must be less tahn 2 MB)</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input type="file" id="eventimage2" name="eventimage2">
														{!!$errors->first("eventimage2", "<span class='text-danger'>:message</span>")!!}
													</div>
											</div>											

											
											
											<div class="um-field"> </div>
											<div class="um-field eventclass "> 
												<div class="um-field-label">
														<label for="video_link">Video Link (Optional)</label>
														<div class="um-clear"></div>
												</div>
													<div class="um-field-area">
														<input id="video_link" type="text" name="video_link" value="{{ old('video_link') }}"  maxlength="120">
														{!!$errors->first("video_link", "<span class='text-danger'>:message</span>")!!}
													</div>
											</div>
											
											
											<div class="um-field">
												<div class="um-field-label">
													<label for="">Event Date*</label>
													<div class="um-clear"></div>
												</div>
												<?php //if(Auth::user()->role == 'school'){ ?>
													<div class="um-field-area">
														<div class="event-row-lt event-row-it-resp mt-2 ">
														<span id="eventstartdate">From Date</span>
														
														<input type="date" name="eventstartdate" class="eventdate" id="eventstartdate" value="2022-08-29" min="2022-08-29" max='2022-08-29'>
														{!!$errors->first("eventstartdate", "<span class='text-danger'>:message</span>")!!}
									
														</div>
														<!--
														<div class="event-row-lt event-row-it-resp mt-2" id="eventenddatediv">
															To Date
															<input type="date" name="eventenddate" class="eventdate" id="eventenddate" value="{{ old('eventenddate') }}" min='2022-08-29' max='2022-09-29'>
														{!!$errors->first("eventenddate", "<span class='text-danger'>:message</span>")!!}
														</div>
														-->
														<div class="clear clearfix"></div>
													</div>
												<?php /*}else{ ?>
													<div class="um-field-area">
														<div class="event-row-it-resp ">
															<!-- <span id="eventstartdate">Date</span> -->
															<input type="date" name="eventstartdate" class="eventdate" id="eventstartdate" value="2022-06-03" readonly>
															{!!$errors->first("eventstartdate", "<span class='text-danger'>:message</span>")!!}
														</div>
														<div class="clear clearfix"></div>
													</div>
												<?php } */?>
											</div>

											
											
												<div class="um-field eventclass schoolHide" style="display: block;">
													<div class="um-field-label">
														<label class="org_name_change" for="organiser_name">
														<?php if(Auth::user()->role == 'school'){ ?> School Name* <?php }else{ echo "Your Name/Organizer Name"; } ?> </label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input id="organiser_name" type="text" name="organiser_name" value="@if(!empty(old('organiser_name'))) {{ old('organiser_name') }} @else {{ Auth::user()->name }} @endif"  maxlength="120">
															{!!$errors->first("organiser_name", "<span class='text-danger'>:message</span>")!!}
													</div>
												</div>
											
											
											<?php  if(Auth::user()->role == 'subscriber'){ ?>
												<input id="participantnum" type="hidden" name="participantnum" value="1">
											<?php }else{ ?>
											<div class="um-field eventclass cyclonindHide">
													<div class="um-field-label">
														<label for="event_name">No of Participants</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input id="participantnum" type="text" name="participantnum" value="{{ old('participantnum') }}" maxlength="6">
														{!!$errors->first("participantnum", "<span class='text-danger'>:message</span>")!!}
													</div>
											</div>
											<?php } ?>							
											
											
											
											
											
											
											<!--
											<div class="um-field eventclass schoolHide prabhatHide">
													<div class="um-field-label">
														<label for="kmrun">Total KM(Kilometer) Covered</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input id="kmrun" type="text" name="kmrun" value="{{ old('kmrun') }}" maxlength="7">
														{!!$errors->first("kmrun", "<span class='text-danger'>:message</span>")!!}
													</div>
											</div>
											<div class="um-field">
													<div class="um-field-label">
														<label for="mobile">Contact Mobile No.*</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input id="mobile" type="text" name="mobile" value="{{ old('mobile') }}" maxlength="10">
														{!!$errors->first("mobile", "<span class='text-danger'>:message</span>")!!}
													</div>
											</div>
											
											 <div class="um-field undertaking" style="display: block;">
													<div class="um-field-label">
														<label for="undertaking">Undertaking*</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area undertakingtxt">
														<input type="checkbox" name="undertaking" @if(!empty(old('undertaking'))) {{ 'checked' }} @endif value="yes" required>
														I undertake to submit complete details of the number of participants and the cumulative KM Covered after the event, I also undertake to follow the guidelines of fit india logo if downloaded for the event.
													</div>
											</div> -->
											
										<?php if(Auth::user()->role != 'subscriber'){ ?>											
											<div class="form-group um-field">
												<label for="userEmail"><b>Participant Name(s)*</b> <i style="color: blue;">(Multiple names can be added in separate lines)</i>
												</label>
												<textarea name="participant_names" cols="20" rows="10" class="form-control"></textarea>
											</div>
										<?php } ?>	
											
											
										 <div class="register-row"> 
											<div class="register-row-lft" > 
											<div class="um-field" id="rcapcha-main-cont">
												<label for="captcha">Please Enter the Captcha Text</label><br>
												<div class="cap_code">
												<div style="" id="rcaptcha-cont">
													<div class="captchaimg">
														<span>{!! captcha_img() !!}</span>
													</div>
												</div>
												<div style=" cursor: pointer;" > 
												  <button type="button" class="btn btn-info" class="reload" id="reload">
													↻
													</button>
												</div>
												
												<div style="">
													<input type="text" id="captcha" name="captcha" required class="form-control @error('captcha') is-invalid @enderror"  placeholder="Captcha">
													@error('captcha')
														<span class="invalid-feedback" role="alert" >
															<strong>{{ $message }}</strong>
														</span>
													@enderror
												</div>

												</div>
											</div>
											</div>
											
										</div> 
										
										<div style="clear:both"></div>
										
										
											
											<div class="um-field">
													<div class="um-field-area">
														<input type="submit" name="create-event" value="Submit">
													</div>
											</div>
								</div>
								
								<!--
											<br>
											<div class="um-field">
												<div class="um-field-area">
												<a class="btn_site" style="font-size: inherit !important; border-radius: 100px; " href="https://fitindia.gov.in/wp-content/uploads/2019/09/Fit-India_logo.zip" data-icon="G">Download Logo</a>
												&nbsp;
												<a class="btn_site" style="font-size: inherit !important; border-radius: 100px; " href="https://fitindia.gov.in/wp-content/uploads/2019/10/FITIndia_Logo_Guidelines.pdf" target="_blank" data-icon="G"> Guidelines </a>
												
												</div>
												<br>	
											</div>
											-->
									
									</form>
								</div>
								
								
								
							
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br>
        </div>
		
		
		
		
<script>
    
jQuery('#reload').click(function () {
    jQuery.ajax({
    type: 'GET',
    url: "{{ route('reloadCaptcha')}}",
    success: function (data) {
		jQuery(".captchaimg span").html(data.captcha);
    }
    });
});
</script>



@endsection
