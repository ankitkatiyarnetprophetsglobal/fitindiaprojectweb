@extends('layouts.app')
@section('title', 'Organise Event | Fit India')
@section('content')
<style>
.addmore{margin-top: 20px;margin-bottom: 15px;}
    .addmore a{
        /* background: #1da1f2; */
		padding: 6px;
    border-radius: 5px;
    color: #1da1f2;
    font-size: 13px;
    border: 1px solid #1da1f2;
}

#delete_org_video, #delete_org_image{	
    padding: 6px;
    border-radius: 5px;
    color: #ff0000;
    font-size: 13px;
    border: 1px solid #ff0000;
}
  
.event-row-lt {
    width: 100%;
}
.mb{margin-bottom: 10px;}

.btn_free{
	width: auto;
    padding: 12px 30px;
    border: 0;
    background-color: #02349a;
    color: #fff;
    font-size: 14px;
    height: auto;
    border-radius: 50px;
    text-transform: uppercase;
    letter-spacing: 2px;
    cursor: pointer;
}

.um-form input[type=email], .um-form input[list], .um-form input[type=text], .um-form select, .event-form input[type=email], .event-form input[list], .event-form input[type=text], .event-form input[type=file], .event-form input[type=date], .event-form select {
    width: 100%;
    display: block !important;
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 5px;
    outline: none !important;
    cursor: text !important;
    font-size: 15px !important;
    height: 40px !important;
    box-sizing: border-box !important;
    box-shadow: none !important;
    margin: 0 !important;
    position: static;
    outline: none !important;
    padding: 5px 10px !important;
}

.just_content{justify-content: space-between;margin-top: 15px;}
.area_div_p{
  border: 1px solid #e2e2e2;
    padding: 8px;
    border-radius: 3px;

}
</style>
<?php
$role_value = strtolower(Auth::user()->role);
/*$participant_value = 4;
$kilometers = 5;
$validation_role_arr = array('bsf','cisf','crpf','nsg','nss','itbp','nyks','railways','ssb');
if (in_array($role_value, $validation_role_arr)){*/
	$participant_value = 6;
	$kilometers = 7;
/*}*/


?>
<div class="banner_area">
	<img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
			@include('event.userheader')			
            <div class="container">
                <div class="et_pb_row">
                    <div class="row ">                        
						@include('event.sidebar')						
                        <div class="col-sm-12 col-md-9 school_update">
                            <div class="description_box">
							@php
							/*
							<p style="color: red; font-size: 22px;" >Stay Tuned for upcoming Fit India Events. </p>
							*/	
							@endphp	
							
							
                                <h2>Create an Event </h2>                                	
								
								<div class="wrap event-form">	
									<!-- onsubmit="return create_event_validation()" -->

									@if (session('success'))
										<div class="alert alert-success">
											{{ session('success') }}
										</div>
									@endif
									@if (Session::has('error_message'))
                                   <div class="alert alert-danger">
                                     <strong>Error!</strong> {{ Session::get('error_message') }}
                                   </div>
                                 @endif
									
									<form name="freedum_run_form" method="post" action="{{route('create-event-post')}}" enctype="multipart/form-data" > 
											@csrf
											
											<input type="hidden" name="user_id" value="{{ Auth::id() }}"/>
											
								<div class="main_form" style="display: block;">	
											
											<div class="um-field"></div>
											<div class="um-field">
													<div class="um-field-label">
														<label for="eventname">Event Name *</label>
														<div class="um-clear"></div>
													</div> 
													<div class="um-field-area">
													  <!-- <label for="name">Organization / Institution / Group / School Name  *</label> -->
													  {{-- Fit India School Week 2022 --}}
					                                  <input type="text" name="event_name" id="event_name" class="form-control" placeholder="Event Name" value="National Sports Day 2023" readonly>
					                                  <input type="hidden" name="event_name_store" id="event_name_store" class="form-control" placeholder="Event Name" value="national_sports_day_2023" readonly>
					                               </div>
											</div>

											<div class="um-field"></div>
											<div class="um-field">
													<div class="um-field-label">
														<label for="eventname">
														Organization / Institution / Group / School Name *
					                                    </label>
														<div class="um-clear"></div>
													</div> 
													<div class="um-field-area">
													  <!-- <label for="name">Organization / Institution / Group / School Name  *</label> -->
													  <input type="hidden" name="name" id="name" class="form-control" placeholder="Name" value="{{$userdata->name}}" >
					                                  <input type="text" name="org_name" id="org_name" class="form-control" placeholder="Organization / Institution / Group / School Name" value="{{$userdata->name}}">
					                                  {!!$errors->first("org_name","<span class='text-danger'>:message</span>")!!}
														
													</div>
											</div>


											<div class="um-field">
													<div class="um-field-label">
														<label for="eventname">Email ID *</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
													 	<!-- <label for="Email">Email ID *</label> -->
                                  						<input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{$userdata->email}}" readonly>
                                  						{!!$errors->first("email","<span class='text-danger'>:message</span>")!!}
													</div>
											</div>

											<div class="um-field">
													<div class="um-field-label">
														<label for="eventname">Contact Number *</label>
														<div class="um-clear"></div>
													</div> 
													<div class="um-field-area">
													 	 <!-- <label for="contact">Contact Number *</label> -->
						                                  <input type="number" name="contact" class="form-control" id="contact" placeholder="Contact" value="{{$userdata->phone}}" maxlength="10">
						                                  {!!$errors->first("contact","<span class='text-danger'>:message</span>")!!}
													</div>
											</div>

											<div class="um-field">
												<div class="um-field-label">
													{{-- <label for="eventname">Participants *</label> --}}
													<label for="eventname">Participants</label>
													<div class="um-clear"></div>
												</div> 
												<div class="um-field-area">
													  <!-- <label for="contact">Contact Number *</label> -->
													  <input type="number" name="addparticipants" class="form-control" id="addparticipants" min="0" placeholder="Participants" value="">
													  {!!$errors->first("addparticipants","<span class='text-danger'>:message</span>")!!}
												</div>
											</div>
											

											<?php 
											if ($role_value=='school'){ 
											?>

											<div class="um-field">
												<div class="um-field-label">
													<label for="eventname">School Chain *</label>
													<div class="um-clear"></div>
												</div> 
												<div class="um-field-area">												
												 <select name="school_chain" id="school_chain" class="fit-pe-inputs" required>
												  <option value="">Select</option>
												  <option value="KVS">KVS</option>
												  <option value="CBSE">CBSE</option>
												  <option value="CISCE">CISCE</option>
												  <option value="NV">JNV(Jawahar Navodaya Vidyalaya)</option>
												  <option value="State Education Board">State Education Board</option>
												 </select>
												 {!!$errors->first("school_chain","<span class='text-danger'>:message</span>")!!}
												</div>
											</div>								
											
											<?php } else { ?>
											
											<?php 
											// if(strtolower($role_value) == 'mexta' 
											// 	|| strtolower($role_value) == 'mhrddsel' 
											// 	|| strtolower($role_value) == 'mhrdhei' 
											// 	|| strtolower($role_value) == 'mha' 
											// 	|| strtolower($role_value) == 'mpng' 
											// 	|| strtolower($role_value) == 'md' 
											// 	|| strtolower($role_value) == 'mfinance'){
											?>
											
											
											<div class="um-field">
												<div class="um-field-label">
													<label for="eventname">Organisation *</label>
													<div class="um-clear"></div>
												</div> 
												<div class="um-field-area">													
													{{-- <input type="text" name="school_chain" id="school_chain" class="form-control" placeholder="Email" value="<?php echo ucwords(Auth::user()->rolelabel);?>" readonly>										 --}}
													<select name="school_chain" id="school_chain" class="fit-pe-inputs" required>														
														<option value="dept_of_st_gov" <?=(!empty($role_value)&&($role_value=='dept_of_st_gov'))? 'selected=selected' : 'disabled="true"'?>>DEPARTMENT OF STATE GOVERNMENT</option>
														<option value="mafw" <?=(!empty($role_value)&&($role_value=='mafw'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF AGRICULTURE AND FARMERS WELFARE</option>
														<option value="mayush" <?=(!empty($role_value)&&($role_value=='mayush'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF AYUSH</option>                        														
														<option value="mcf" <?=(!empty($role_value)&&($role_value=='mcf'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF CHEMICALS AND FERTILIZERS</option>
														<option value="mcivila" <?=(!empty($role_value)&&($role_value=='mcivila'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF CIVIL AVIATION</option>
														<option value="mcoal" <?=(!empty($role_value)&&($role_value=='mcoal'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF COAL</option>            														
														<option value="mci" <?=(!empty($role_value)&&($role_value=='mci'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF COMMERCE AND INDUSTRY</option>		
														<option value="mcomm" <?=(!empty($role_value)&&($role_value=='mcomm'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF COMMUNICATIONS</option>
														<option value="mconsumera" <?=(!empty($role_value)&&($role_value=='mconsumera'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF CONSUMER AFFAIRS, FOOD AND PUBLIC DISTRIBUTION</option>										
														<option value="mcorpa" <?=(!empty($role_value)&&($role_value=='mcorpa'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF CORPORATE AFFAIRS</option>												
														<option value="mculture" <?=(!empty($role_value)&&($role_value=='mculture'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF CULTURE</option>                        														
														<option value="md" <?=(!empty($role_value)&&($role_value=='md'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF DEFENCE</option>          														
														<option value="mdner" <?=(!empty($role_value)&&($role_value=='mdner'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF DEVELOPMENT OF NORTH EASTERN REGION</option>						
														<option value="mearths" <?=(!empty($role_value)&&($role_value=='mearths'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF EARTH SCIENCES</option>     														
														<option value="mhrddsel" <?=(!empty($role_value)&&($role_value=='mhrddsel'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF EDUCATION (DSEL)</option>		
														<option value="mhrdhei" <?=(!empty($role_value)&&($role_value=='mhrdhei'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF EDUCATION (HEI)</option>
														<option value="meit" <?=(!empty($role_value)&&($role_value=='meit'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF ELECTRONICS AND INFORMATION TECHNOLOGY</option>							
														<option value="mefcc" <?=(!empty($role_value)&&($role_value=='mefcc'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF ENVIRONMENT, FOREST AND CLIMATE CHANGE</option>							
														<option value="mexta" <?=(!empty($role_value)&&($role_value=='mexta'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF EXTERNAL AFFAIRS</option>  														
														<option value="mfinance" <?=(!empty($role_value)&&($role_value=='mfinance'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF FINANCE</option>                  														
														<option value="mfahd" <?=(!empty($role_value)&&($role_value=='mfahd'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF FISHERIES, ANIMAL HUSBANDRY AND DAIRYING</option>							
														<option value="mfpi" <?=(!empty($role_value)&&($role_value=='mfpi'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF FOOD PROCESSING INDUSTRIES</option>         														
														<option value="mhfw" <?=(!empty($role_value)&&($role_value=='mhfw'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF HEALTH AND FAMILY WELFARE</option>
														<option value="mhipe" <?=(!empty($role_value)&&($role_value=='mhipe'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF HEAVY INDUSTRIES AND PUBLIC ENTERPRISES</option>							
														<option value="mha" <?=(!empty($role_value)&&($role_value=='mha'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF HOME AFFAIRS</option> 													
														<option value="mhua" <?=(!empty($role_value)&&($role_value=='mhua'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF HOUSING AND URBAN AFFAIRS</option>			
														<option value="mib" <?=(!empty($role_value)&&($role_value=='mib'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF INFORMATION AND BROADCASTING</option>				
														<option value="mjs" <?=(!empty($role_value)&&($role_value=='mjs'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF JAL SHAKTI</option>      														
														<option value="mle" <?=(!empty($role_value)&&($role_value=='mle'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF LABOUR AND EMPLOYMENT</option>		
														<option value="mlj" <?=(!empty($role_value)&&($role_value=='mlj'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF LAW AND JUSTICE</option>                  														
														<option value="mmsme" <?=(!empty($role_value)&&($role_value=='mmsme'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF MICRO, SMALL AND MEDIUM ENTERPRISES</option>						
														<option value="mmines" <?=(!empty($role_value)&&($role_value=='mmines'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF MINES</option>
														<option value="mminoritya" <?=(!empty($role_value)&&($role_value=='mminoritya'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF MINORITY AFFAIRS</option>			
														<option value="mmre" <?=(!empty($role_value)&&($role_value=='mmre'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF NEW AND RENEWABLE ENERGY</option>
														<option value="mpr" <?=(!empty($role_value)&&($role_value=='mpr'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF PANCHAYATI RAJ</option>                        														
														<option value="mpa" <?=(!empty($role_value)&&($role_value=='mpa'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF PARLIAMENTARY AFFAIRS</option>
														<option value="mppgp" <?=(!empty($role_value)&&($role_value=='mppgp'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF PERSONNEL, PUBLIC GRIEVANCES AND PENSIONS</option>
														<option value="mpng" <?=(!empty($role_value)&&($role_value=='mpng'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF PETROLEUM AND NATURAL GAS</option>
														<option value="mpower" <?=(!empty($role_value)&&($role_value=='mpower'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF POWER</option>                        														
														<option value="mrailways" <?=(!empty($role_value)&&($role_value=='mrailways'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF RAILWAYS</option>            														
														<option value="mtransh" <?=(!empty($role_value)&&($role_value=='mtransh'))? 'selected=selected' : ''?>>MINISTRY OF ROAD TRANSPORT AND HIGHWAYS</option>					
														<option value="mrd" <?=(!empty($role_value)&&($role_value=='mrd'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF RURAL DEVELOPMENT</option>          														
														<option value="msciencetech" <?=(!empty($role_value)&&($role_value=='msciencetech'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF SCIENCE AND TECHNOLOGY</option>					
														<option value="mshipping" <?=(!empty($role_value)&&($role_value=='mshipping'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF SHIPPING</option>       														
														<option value="mskillde" <?=(!empty($role_value)&&($role_value=='mskillde'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF SKILL DEVELOPMENT AND ENTREPRENEURSHIP</option>								
														<option value="msje" <?=(!empty($role_value)&&($role_value=='msje'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF SOCIAL JUSTICE AND EMPOWERMENT</option>
														<option value="msprog" <?=(!empty($role_value)&&($role_value=='msprog'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF STATISTICS AND PROGRAMME IMPLEMENTATION</option>							
														<option value="msteel" <?=(!empty($role_value)&&($role_value=='msteel'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF STEEL</option>
														<option value="mtextiles" <?=(!empty($role_value)&&($role_value=='mtextiles'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF TEXTILES</option>
														<option value="mtourism" <?=(!empty($role_value)&&($role_value=='mtourism'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF TOURISM</option>
														<option value="mta" <?=(!empty($role_value)&&($role_value=='mta'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF TRIBAL AFFAIRS</option>
														<option value="mwcd" <?=(!empty($role_value)&&($role_value=='mwcd'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF WOMEN AND CHILD DEVELOPMENT</option>				
														<option value="myouthas" <?=(!empty($role_value)&&($role_value=='myouthas'))? 'selected=selected' : 'disabled="true"'?>>MINISTRY OF YOUTH AFFAIRS AND SPORTS</option>
														<option value="air_force" <?=(!empty($role_value)&&($role_value=='air_force'))? 'selected=selected' : 'disabled="true"'?>>Air Force</option>
														<option value="army" <?=(!empty($role_value)&&($role_value=='army'))? 'selected=selected' : 'disabled="true"'?>>Army</option>
														<option value="bsf" <?=(!empty($role_value)&&($role_value=='bsf'))? 'selected=selected' : 'disabled="true"'?>>BSF</option>
														<option value="cisf" <?=(!empty($role_value)&&($role_value=='cisf'))? 'selected=selected' : 'disabled="true"'?>>CISF</option>
														<option value="crpf" <?=(!empty($role_value)&&($role_value=='crpf'))? 'selected=selected' : 'disabled="true"'?>>CRPF</option>
														<option value="itbp" <?=(!empty($role_value)&&($role_value=='itbp'))? 'selected=selected' : 'disabled="true"'?>>ITBP</option>
														<option value="navy" <?=(!empty($role_value)&&($role_value=='navy'))? 'selected=selected' : 'disabled="true"'?>>Navy</option>
														<option value="nsg" <?=(!empty($role_value)&&($role_value=='nsg'))? 'selected=selected' : 'disabled="true"'?>>NSG</option>
														<option value="ssb" <?=(!empty($role_value)&&($role_value=='ssb'))? 'selected=selected' : 'disabled="true"'?>>SSB</option>
														<option value="corporate" <?=(!empty($role_value)&&($role_value=='corporate'))? 'selected=selected' : 'disabled="true"'?>>CORPORATE</option>
														<option value="group" <?=(!empty($role_value)&&($role_value=='group'))? 'selected=selected' : 'disabled="true"'?>>GROUP</option>
														<option value="gym" <?=(!empty($role_value)&&($role_value=='gym'))? 'selected=selected' : 'disabled="true"'?>>GYM</option>
														<option value="subscriber" <?=(!empty($role_value)&&($role_value=='subscriber'))? 'selected=selected' : 'disabled="true"'?>>INDIVIDUAL</option>
														<option value="ncc" <?=(!empty($role_value)&&($role_value=='ncc'))? 'selected=selected' : 'disabled="true"'?>>NCC</option>
														<option value="ngo" <?=(!empty($role_value)&&($role_value=='ngo'))? 'selected=selected' : 'disabled="true"'?>>NGO</option>
														<option value="nss" <?=(!empty($role_value)&&($role_value=='nss'))? 'selected=selected' : 'disabled="true"'?>>NSS</option>
														<option value="Nyks" <?=(!empty($role_value)&&($role_value=='Nyks'))? 'selected=selected' : 'disabled="true"'?>>NYKS</option>
														<option value="others" <?=(!empty($role_value)&&($role_value=='others'))? 'selected=selected' : 'disabled="true"'?>>Others</option>
														<option value="railways" <?=(!empty($role_value)&&($role_value=='railways'))? 'selected=selected' : 'disabled="true"'?>>RAILWAYS</option>
														<option value="sai" <?=(!empty($role_value)&&($role_value=='sai'))? 'selected=selected' : 'disabled="true"'?>>SAI</option>
														<option value="universities" <?=(!empty($role_value)&&($role_value=='universities'))? 'selected=selected' : 'disabled="true"'?>>UNIVERSITIES / INSTITUTE / COLLEGE</option>
														<option value="youthclub" <?=(!empty($role_value)&&($role_value=='youthclub'))? 'selected=selected' : 'disabled="true"'?>>YOUTH CLUB</option>														
												 	</select>
												 	{!!$errors->first("school_chain","<span class='text-danger'>:message</span>")!!}
												</div>
											</div>								
											
											<?php } ?>

											<br>
											<div class="">
												<div class="um-field">
													<div class="um-field-label">
														<label for="eventimage1">Upload Background Image (optional) <span style="opacity: 50%">(Maximum file size less than 2 MB, file must be .png,.jpg,.jpeg)</span></label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input type="file" name="event_bg_image" class="form-control">
														{!!$errors->first("prt_image", "<span class='text-danger'>:message</span>")!!}
													</div>
												</div>
											</div>
											<br>
											<div class="multiple_image_section">
												<div class="um-field">
													<div class="um-field-label">
														<label for="eventimage1">Add Event Picture (optional) <span style="opacity: 50%">(Maximum file size less than 2 MB, file must be .png,.jpg,.jpeg)</span></label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input type="file" name="prt_image[]" class="form-control">
														{!!$errors->first("prt_image", "<span class='text-danger'>:message</span>")!!}
													</div>
												</div>
											</div>


										<div class="addmore">		
											<a id="add_org_image" href="javascript:void(0)">+ Add More</a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete_org_image" href="javascript:void(0)">Delete</a>
										</div>



										

                                        <div class="multiple_video_section">
											<div class="um-field">
												<div class="um-field-label">
													<label for="eventimage1">Add Event Video Link (optional)</label>
													<div class="um-clear"></div>
												</div>
												<div class="um-field-area">
													<input type="url" name="video_link[]" class="form-control" placeholder="Event Video Link"> 
													<span>For Example from Youtube , Facebook etc.</span>   
												</div>
											</div>
										</div>

										<div class="addmore">		
											<a id="add_org_video" href="javascript:void(0)">+ Add More</a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete_org_video" href="javascript:void(0)">Delete</a>
										</div>


											
											<div class="um-field">
												<div class="um-field-label">
													<label for="">Event Date *</label>
													<div class="um-clear"></div>
												</div>
											</div>
												<div class="row">
													<div class="col-sm-12 col-md-6">
															<div class="form-group ">
														<span id="eventstartdate">From Date</span>
														
														<input type="date" name="from_date" class="form-control" id="from_date" value="{{ old('from_date') }}" maxlength="10" min="2023-08-21" max='2023-08-29'>
														{!!$errors->first("from_date", "<span class='text-danger'>:message</span>")!!}
									
														</div>
													</div>
														<div class="col-sm-12 col-md-6">
																<div class="form-group ">
																	To Date
																  <input type="date" name="to_date" class="form-control" id="to_date" value="{{ old('to_date') }}" maxlength="10" min="2023-08-21" max='2023-08-29'>
																{!!$errors->first("to_date", "<span class='text-danger'>:message</span>")!!}
																</div>
															</div>
												</div>
												<div class="clear clearfix"></div>
												<div class="row mb-3" id="event_dec" style="display:none;">
													<div class="col-sm-12 col-md-12 " >
														<div class="shadow1" style="border: 1px dotted #dfdfdf;background: rgb(255 175 75 / 10%);padding: 10px;">
														<p class="m-1">E.g. The organization conducted following Fit India Freedom run 3.0 event:</p>
														<p class="m-1">Events on 28-08-2023 with <b>50</b> participants ran for <b>3</b> Kms </p>
														<p class="m-1">Hence no. of participants = <b>50</b>, km covered = <b>150</b></p>
														</div>
													</div>
												</div>
											</div>



											
											<div class="row" id="prt_km_details">
											</div>
											
											 <div class="row" id="total_pt_details" style="display:none;">
											  <div class="col-sm-12 col-md-4">
                                                  <div class="form-group area_div_p" style="font-size:18px;padding:5px 8px;">
                                                      <b>Total</b>
                                                  </div>
                                              </div>

                                              <div class="col-sm-12 col-md-4">
                                                  <div class="form-group area_div_p">
                                                      Total Participant : <span id="participant_count">0</span>
                                                  </div>
                                              </div>

                                               <div class="col-sm-12 col-md-4">
                                                  <div class="form-group area_div_p">
                                                    Total Kms : <span id="kms_count">0</span>
                                                  </div>
                                              </div>
                                          </div>

												 	
											
										
										<div style="clear:both"></div>
										<div class="d-flex just_content">
											
											<div class="um-field cr_event">
													<div class="um-field-area">
													  <input type="submit" name="create-event" value="Create Event" style="margin-top:0;"> 
													</div>
											</div>
											<div class="um-field cr_event">
													<div class="um-field-area d_btny">
														<a href="{{url('resources/pdf/fit-india-logo.zip')}}" >Download Fit India Logo</a>
													</div>
											</div>
										</div>					
											<br>
									</form>
								</div>
								
								<!-- <button id="getBetween">Get Between Dates</button> -->

								
							
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br>
        </div>
	<div class="results2"><span></span></div>	
		
<script src='https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js'></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
<script>
  $(function() {
    jQuery.validator.addMethod("validate_email", function(value, element) {
        if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
            return true;
        } else {
            return false;
        }
    }, "Please enter a valid Email.");

    jQuery.validator.addMethod("lettersonly", function(value, element) 
    {
      //return this.optional(element) || /^[a-z," "]+$/i.test(value);
      return this.optional(element) || /^[a-zA-Z0-9_@./#&+,:\s/-]+$/i.test(value);
    }, "Letters and spaces only please"); 

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0} bytes.');

    
    $("form[name='freedum_run_form']").validate({
      rules: {
        org_name:{
          required:true,
        },
        email: {
            required:true,
            validate_email: true
        },
        contact: {
            required:true,
            minlength:10,
            maxlength:10
        },
		'event_bg_image': {
		
		extension: "png|jpg|jpeg", // work with additional-mothods.js
        filesize: 2*1024*1024,  
		},
		'prt_image[]': {
		
		extension: "png|jpg|jpeg", // work with additional-mothods.js
        filesize: 2*1024*1024,  
		},
		// 'video_link[]':{
		// 	url:true
		// },
        
        from_date:{
           required:true
        },
        to_date:{
           required:true
        },
        
      },
      messages: {
        org_name:{
          required:"This field is required"
        },
        email: {
          required: "Please enter your email",
          validate_email: "Please enter valid email id"
        },
        contact: {
          required: "Please enter contact number",
          minlength: "Your phone must be 10 number long",
          maxlength: "Your phone must be 10 number long"
        },
		school_chain: {
          required: "Please select",          
        },
        
        'event_bg_image': {
		  extension: 'please Upload .png, .jpeg, .jpg',
          filesize:"File size must be less than 2 mb."
        },
        'prt_image[]': {
		  extension: 'please Upload .png, .jpeg, .jpg',
          filesize:"File size must be less than 2 mb."
        }
    },

    submitHandler: function(form) {
        form.submit();
    }
  });
}); 

</script>
<style>
  .error{color:red;}
</style>
		
<script>

$(document).ready(function(){    
	jQuery('#reload').click(function () {
	    jQuery.ajax({
	    type: 'GET',
	    url: "{{ route('reloadCaptcha')}}",
	    success: function (data) {
			jQuery(".captchaimg span").html(data.captcha);
	    }
	    });
	});

	$(document).on('keyup', '.number_of_partcipant', function (e) {
		var	sum_participant=0;
  		$('.number_of_partcipant').each(function(key, val){
  		var no_participant = $(this).val() ? $(this).val() : 0;
  		sum_participant = sum_participant+parseInt(no_participant);
	});
	$('#participant_count').text(sum_participant);
    });

    $(document).on('keyup', '.km_number', function (e) {
		var	sum_of_km=0;
  		$('.km_number').each(function(key, val){
  		var no_km = $(this).val() ? $(this).val() : 0;
  		sum_of_km = sum_of_km+parseInt(no_km);
	});
	$('#kms_count').text(sum_of_km);
    });

});
</script>
	<script>
		var from_date='';
		var to_date='';
		$(document).ready(function() {
			$("#delete_org_image").hide();
			$("#delete_org_video").hide();
			//when the Add Field button is clicked
			var i = 2;
			$("#add_org_image").click(function(e) {
				$("#delete_org_image").fadeIn("1500");
				//Append a new row of code to the "#items" div
				$(".multiple_image_section").append('<div class="um-field org_img_section"><div class="um-field-label"><label for="eventimage1">Add Event Picture (optional) <span style="opacity: 50%">(Maximum file size less than 2 MB, file must be .png,.jpg,.jpeg)</span></label><div class="um-clear"></div></div><div class="um-field-area"><input type="file" name="prt_image[]"  class="form-control"></div></div>');
			i++;
			});

			$("body").on("click", "#delete_org_image", function(e) {
			    $(".org_img_section").last().remove();
			    if($(".org_img_section").length==0){
			    	$('#delete_org_image').hide();
			    }
			});

			var j = 2;
			$("#add_org_video").click(function(e) {
				$("#delete_org_video").fadeIn("1500");
				//Append a new row of code to the "#items" div
				$(".multiple_video_section").append('<div class="um-field org_video_section"><div class="um-field-label"><label>Add Event Video Link (optional)</label><div class="um-clear"></div></div><div class="um-field-area"><input type="url" name="video_link[]" class="form-control" placeholder="Event Video Link"><span>For Example from Youtube , Facebook etc.</span> </div></div>');
				j++;
			});

			
			$("body").on("click", "#delete_org_video", function(e) {
			    $(".org_video_section").last().remove();
			    if($(".org_video_section").length==0){
			    	$('#delete_org_video').hide();
			    }
			});

			
	});

	      $(document).on('change','#from_date',function(){
			
				from_date = $(this).val();
				to_date = $('#to_date').val();
				if(to_date < from_date && to_date != ''){
					alert("'From Date' should be less than 'To Date'.");
					$('#from_date').val('');
				}
				
			})
			$(document).on('change','#to_date',function(){

				
				to_date = $(this).val();
				from_date = $('#from_date').val();
				if(to_date < from_date && from_date != ''){
					
					alert("'To Date' should be greater than 'From Date'.");
					$('#to_date').val('');
				}
			})


function partcipantDetails(from_date, to_date){
	var participant_value = "<?php echo $participant_value; ?>";
	var kilometers = "<?php echo $kilometers; ?>";
	if(from_date!='' && to_date!=''){
		$('#total_pt_details').show();
		$('#event_dec').show();
	}else{
		$('#total_pt_details').hide();
		$('#event_dec').hide();
	}

		var start = new Date(from_date),
        end = new Date(to_date),
        currentDate = new Date(start),
        between = [];
    	var prt_arr = [];
    	var i = 0;
    	while (currentDate <= end) {
        between.push(new Date(currentDate));
  		var month = '' + (currentDate.getMonth() + 1),
        day = '' + currentDate.getDate(),
        year = currentDate.getFullYear();
    	if (month.length < 2) month = '0' + month;
    	if (day.length < 2) day = '0' + day;
    	var full_date =  [year, month, day].join('-');
   	
   		var c_date = new Date();
   		var c_month = '' + (c_date.getMonth()+1),
		c_day = c_date.getDate(),
		c_year = c_date.getFullYear();
		if (c_month.toString().length < 2) c_month = '0' + c_month;
    	if (c_day.toString().length < 2) c_day = '0' + c_day;
		var c_full_date =  [c_year, c_month, c_day].join('-');
		var textbox_disabled=''; 
		if(full_date > c_full_date){
			console.log(full_date);
			textbox_disabled = 'readonly';
		}else{
			textbox_disabled = '';
		}


     	prt_arr.push('<div class="col-sm-12 col-md-4"><div class="form-group "><input type="text" name="prt_date['+i+']" class="form-control" value="'+full_date+'" readonly></div></div><div class="col-sm-12 col-md-4"><div class="form-group "><input type="number" name="number_of_partcipant['+i+']" class="form-control number_of_partcipant" placeholder="no. of participant (each day)"  maxlength="'+participant_value+'" '+textbox_disabled+'></div></div><div class="col-sm-12 col-md-4"><div class="form-group "><input type="number" name="km['+i+']" class="form-control km_number" placeholder="Kms (each day)" maxlength="'+kilometers+'" '+textbox_disabled+'></div></div>');
 		
 		currentDate.setDate(currentDate.getDate() + 1);
 		i++;
    }
	$('#prt_km_details').html(prt_arr);
  //  $('#results').html(between.join('<br> '));
}


</script>


@endsection
