@extends('layouts.app')
@section('title', 'My Application Status | Fit India')
@section('content')
<?php error_reporting(0); ?>
<div class="banner_area">
	<img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
			@include('event.userheader')

            <div class="container container-md container-lg">
                <div class="et_pb_row">
                    <div class="row ">
                        
						@include('event.sidebar')
						
                        <div class="col-sm-12 col-md-12  col-lg-9">
                            <div class="description_box">
							@php
							/*
							<p style="color: red; font-size: 22px;" >Stay Tuned for upcoming Fit India Events. </p>
							*/	
							@endphp	
							
							
                                <h2>My Application Status</h2>
								<div class="wrap event-form">	
									<!-- onsubmit="return create_event_validation()" -->

									@if (session('success'))
										<div class="alert alert-success">
											{{ session('success') }}
										</div>
									@endif									
									@if(!empty($prerak_data))
							 	<?php
							 	$prerak_approved_count = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from preraks order by parent_id, id) preraks, (select @pv := $prerak_data->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='1'")); 
							 	
							 	$sumfollower2=0;
                                foreach($prerak_approved_count as $prerak_count_row){
                               		$sumfollower2 = $sumfollower2+$prerak_count_row->sum_of_followers;
                                }
                  				$sumfollower = $prerak_data->facebook_profile_followers+$prerak_data->twitter_profile_followers+$prerak_data->instagram_profile_followers;
                                $total_follower = $sumfollower+$sumfollower2; 
	                                
							 	?>							


									<table class="table table-bordered" style="margin-bottom:0!important; ">
										<tr>
										<th>Status</th>
										<td><strong><?php if($prerak_data->status=='1'){ echo '<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-success">Approved</span>'; }elseif($prerak_data->status=='2'){ echo '<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-danger">Rejected</span>'; }else{ echo '<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-warning">Pending</span>'; } ?></strong></td>
										</tr>
										<tr>
										<th>Applied for</th>
										<td>
										Fit India <?=ucwords($prerak_data->register_as)?>
										</td>
										</tr>

										@if($prerak_data->status=='1' OR $prerak_data->status=='1')
											<tr>
											<th>
											@if($prerak_data->status=='1')
												Approved Date
											@elseif($prerak_data->status=='2')
												Rejected Date
											@endif
											</th>
											<td><?php
											$sec = strtotime($prerak_data->updated_at);  
	    									$newdate = date ("d-m-Y", $sec);  
											echo $newdate;								
	    									?>
	    									</td>
											</tr>
										@endif

										<tr>
										<th style="background-color: gray; color:white;">Referral code</th>
										<td style="background-color: gray; color:white;"><?=$prerak_data->genrated_refer_code?></td>
										</tr>
										<tr>
										<th>Name</th>
										<td><?=ucwords($prerak_data->name);?></td>
										</tr>
										<tr>
										<th>Email</th>
										<td><?=$prerak_data->email?></td>
										</tr>
										<tr>
										<th>Contact</th>
										<td><?=$prerak_data->contact?></td>
										</tr>
										<tr>
										<th>Designation</th>
										<td><?=$prerak_data->designation?></td>
										</tr>
										<tr>
										<th>State Name</th>
										<td><?=$prerak_data->state_name?></td>
										</tr>
										<tr>
										<th>District Name</th>
										<td><?=$prerak_data->district_name?></td>
										</tr>	
										<!-- <tr>
										<th>Block Name</th>
										<td><?=$prerak_data->block_name?></td>
										</tr> -->

										
										@if($prerak_data->facebook_profile)
										<tr>
										<th>Facebook Profile</th>
										<td><?=$prerak_data->facebook_profile?>
										<?php 
										if($prerak_data->facebook_profile_followers){
											echo "(".$prerak_data->facebook_profile_followers.")"; 
										} 
										?></td>
										</tr>
										@endif

										@if($prerak_data->twitter_profile)
										<tr>
										<th>Twitter Profile</th>
										<td><?=$prerak_data->twitter_profile?> 
										<?php 
										if($prerak_data->twitter_profile_followers){ 
										echo "(".$prerak_data->twitter_profile_followers.")";
										} 
										?>
										</td>
										</tr>
										@endif

										@if($prerak_data->instagram_profile)
										<tr>
										<th>Instagram Profile</th>
										<td><?=$prerak_data->instagram_profile?> 
										<?php 
										if($prerak_data->instagram_profile_followers)
										echo "(".$prerak_data->instagram_profile_followers.")";
										?>
										</td>
										</tr>
										@endif
										
										<tr>
										<th>Work Profession</th>
										<td><?=$prerak_data->work_profession?></td>
										</tr>
										<tr>
										<th>Description</th>
										<td><?=$prerak_data->description?></td>
										</tr>
										
										<tr>
										<th>Registration Date</th>
										<td><?php
										$sec = strtotime($prerak_data->created_at);  
    									$newdate = date ("d-m-Y", $sec);  
										echo $newdate;								
    									?>
    									</td>
    									</tr>
    									<tr>
   										<th>Social Media followers counter</th>
	   									<td><?=$total_follower?></td>
    									</tr>
    									
										<!-- @if($prerak_data->refer_code)
										<tr>
										<th>Referred By</th>
										<td>
										<?php
											//echo @$prerak_data->refer_code;  
    									?>
    									</td>
    									</tr>
    									@endif -->
									</table>
									<div style="border: 1px solid #dee2e6;padding:15px;border-top:0px solid #dee2e6;margin-bottom:15px;">
										<h2>Declaration</h2>
										<p>
											Organizing or participating on-ground/virtual fitness events wherever possible.
										</P>
										<p>
											Tagging Fit India's Official social media handles in fitness related content created by the individual.
										</p>
										<p>
											Uploading the photos of the events organised or participated by the individual by tagging @FitlndiaOff and other hashtags as decided by Fit India Mission.
										</p>
									</div>
                                       
									
									
	                       			
                					@if($prerak_data->status=='1')
										<div class="um-field">
											<div class="um-field-area">
													
													@if($sumfollower >= 1000 && $sumfollower < 10000)
															@if($total_follower>=1000)
																<a target="_blank" class="btn btn-secondary flag-dwn" href="download-prerak-certificate">Download Prerak Certificate </a>
																	      @if($total_follower >= 1000 && $total_follower < 10000)
																	        	<br>
																	        	Now you can refer your code to become Fit India Ambassador.
																	        	<!-- <a class="btn btn-default flag-dwn refer_add_field" href="javascript:void(0)">Click Here </a> -->
																	      @endif
										          @endif
															@if($total_follower>=10000)
																<a target="_blank" class="btn btn-info flag-dwn" href="download-ambassador-certificates">Download Ambassador Certificate </a>
																	      @if($total_follower >= 10000 && $total_follower < 100000)
																	        	<br>
																	        	Now you can refer your code to become Fit India Champion.
																	        	<!-- <a class="btn btn-default flag-dwn refer_add_field" href="javascript:void(0)">Click Here </a> -->
																	      @endif
										          @endif
															@if($total_follower>=100000)
																<a target="_blank" class="btn btn-primary flag-dwn" href="download-champion-certificates">Download Champion Certificate </a>
															@endif
													@endif


												@if($sumfollower >= 10000 && $sumfollower < 100000)
															@if($total_follower>=10000)
																<a target="_blank" class="btn btn-info flag-dwn" href="download-ambassador-certificates">Download Ambassador Certificate </a>
																	      @if($total_follower >= 10000 && $total_follower < 100000)
																	      		<br>
																	      		Now you can refer your code to become Fit India Champion.
																	        	<!-- <a class="btn btn-default flag-dwn refer_add_field" href="javascript:void(0)">Click Here </a> -->
																	      @endif
										          @endif
															@if($total_follower>=100000)
																<a target="_blank" class="btn btn-primary flag-dwn" href="download-champion-certificates">Download Champion Certificate </a>
															@endif
													@endif


												  @if($sumfollower >= 100000)
																<a target="_blank" class="btn btn-primary flag-dwn" href="download-champion-certificates">Download Champion Certificate </a>
													@endif


											</div>
										</div>
										@endif
									

										@if($prerak_data->status=='2')
										<a href="{{url('/prerak-apply-again/social_media')}}/{{$prerak_data->id}}" onclick="return confirm('Your old data registered as Fit India <?=$prerak_data->register_as?> will be removed');">Click here to apply again</a>
										@endif
										
									@endif


									<br>
									@if(!empty($fitevent_data))
							 		<?php 
							 		$prerak_approved_count = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at,max_partcipant from (select * from fitness_enthusias order by parent_id, id) fitness_enthusias, (select @pv := $fitevent_data->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='1'"));
							
					

                $child_parcipant = 0;
                foreach($prerak_approved_count as $en_data){ 
                    $child_parcipant = $child_parcipant+$en_data->max_partcipant;
                }
                $total_partcipant = $child_parcipant+$fitevent_data->max_partcipant;
              
            	 	?>
							 		
									<table class="table table-bordered" style="margin-bottom:0!important; ">
										<tr>
											<th>Status</th>
											<td><strong><?php if($fitevent_data->status=='1'){ echo '<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-success">Approved</span>'; }elseif($fitevent_data->status=='2'){ echo '<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-danger">Rejected</span>'; }else{ echo '<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-warning">Pending</span>'; } ?></strong></td>
										</tr>
										<tr>
										<th>Applied for</th>
										<td>
										Fit India <?=ucwords($fitevent_data->register_as)?>
										</td>
										</tr>
										@if($fitevent_data->status=='1' OR $fitevent_data->status=='1')
											<tr>
											<th>
											@if($fitevent_data->status=='1')
												Approved Date
											@elseif($fitevent_data->status=='2')
												Rejected Date
											@endif
											</th>
											<td><?php
											$sec = strtotime($fitevent_data->updated_at);  
	    									$newdate = date ("d-m-Y", $sec);  
											echo $newdate;								
	    									?>
	    									</td>
											</tr>
										@endif

										<tr>
										<th style="background-color: gray; color:white;">Referral code</th>
										<td style="background-color: gray; color:white;"><?=$fitevent_data->genrated_refer_code?></td>
										</tr>
										<tr>
										<th>Name</th>
										<td><?=ucwords($fitevent_data->name);?></td>
										</tr>
										<tr>
										<th>Email</th>
										<td><?=$fitevent_data->email?></td>
										</tr>
										<tr>
										<th>Contact</th>
										<td><?=$fitevent_data->contact?></td>
										</tr>
										<tr>
										<th>Designation</th>
										<td><?=$fitevent_data->designation?></td>
										</tr>
										<tr>
										<th>State Name</th>
										<td><?=$fitevent_data->state_name?></td>
										</tr>
										<tr>
										<th>District Name</th>
										<td><?=$fitevent_data->district_name?></td>
										</tr>	
										<!-- <tr>
										<th>Block Name</th>
										<td><?=$fitevent_data->block_name?></td>
										</tr> -->
										
										@if($fitevent_data->facebook_profile)
										<tr>
										<th>Facebook Profile</th>
										<td><?=$fitevent_data->facebook_profile?>@if($fitevent_data->facebook_profile_followers)
										(<?=$fitevent_data->facebook_profile_followers?>)
										@endif</td>
										</tr>
										@endif

										@if($fitevent_data->twitter_profile)
										<tr>
										<th>Twitter Profile</th>
										<td><?=$fitevent_data->twitter_profile?>@if($fitevent_data->twitter_profile_followers)
										(<?=$fitevent_data->twitter_profile_followers?>)
										@endif</td>
										</tr>
										@endif

										@if($fitevent_data->instagram_profile)
										<tr>
										<th>Instagram Profile</th>
										<td><?=$fitevent_data->instagram_profile?>@if($fitevent_data->instagram_profile_followers)
										(<?=$fitevent_data->instagram_profile_followers?>)
										@endif</td>
										</tr>
										@endif

										
										<tr>
										<th>Work Profession</th>
										<td><?=$fitevent_data->work_profession?></td>
										</tr>
										<tr>
										<th>Description</th>
										<td><?=$fitevent_data->description?></td>
										</tr>
										
										<tr>
										<th>Registration Date</th>
										<td><?php
										$sec = strtotime($fitevent_data->created_at);  
    									$newdate = date ("d-m-Y", $sec);  
										echo $newdate;								
    									?></td>
										</tr>

										<tr>
										<th>Your Highest Participant</th>
										<td><?=$total_partcipant?></td>
										</tr>

										<!-- @if($fitevent_data->refer_code)
										<tr>
										<th>Referred By</th>
										<td>
										<?php
											//echo @$fitevent_data->refer_code;  
    									?>
    									</td>
    									</tr>
    									@endif -->


									</table>
									
									<div style="    border: 1px solid #dee2e6;padding:15px;border-top:0px solid  #dee2e6;margin-bottom:15px;">
									   <h2>Declaration</h2>
									   <p>Organizing on-ground/virtual fitness events every quarter with at least 50 participants.</P>
									  <p>Tagging Fit India's Official social media handles in fitness related content created by the individual.</p>
									  <p>Uploading the photos of the events organized by the individual by tagging @FitIndiaOff and other hashtags as decided by Fit India Mission.</p>
									  <p>Reposting/Retweeting the photos/videos of Fit India events and tag @FitlndiaOff and other hashtags as decided by Fit India Mission.</p>
									</div>
									 
									
									@if($fitevent_data->status=='1')
									
										<!--Event form quarterly -->
										<div style="bmargin-bottom:15px;">
											<fieldset class="scheduler-border" id="event_details" style="border: 1px solid #dee2e6;padding:15px;">
                                                <legend class="scheduler-border" style="width:auto;padding-left: 10px;padding-right:10px;">Event Details</legend>
                                                <p>You have to Organize on-ground/virtual fitness events every quarter with at least 50 participants</p>
                                                <form method="POST" action="update_prerak_newevent" enctype="multipart/form-data">
                                                	@csrf
                                                	<input type="hidden" name="prk_id" value="{{$fitevent_data->id}}">
                                                <div class="row">
                                                  <?php 
                                                  $up_eventname = unserialize($fitevent_data->up_eventname);
                                                  $up_partcipant_num = unserialize($fitevent_data->up_partcipant_num);
                                                  $up_eventfile = unserialize($fitevent_data->up_eventfile);
                                                  for($i=0; $i<4; $i++){
                                                    ?>
                                                      <div class="col-sm-12"><strong><span> Event- <?php echo $i+1; ?> :</span></strong></div>
                                                      <div class="col-sm-4 col-md-4">
                                                        <div class="form-group"> 
                                                         Name of the event
                                                         <input type="text" name="eventname[<?=$i?>]" class="form-control" value="<?=$up_eventname[$i]?>" />
                                                          @error("eventname.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
                                                        </div>
                                                      </div>
                                                      <div class="col-sm-4 col-md-4">
                                                        <div class="form-group"> 
                                                         Number of the partcipants
                                                          <input type="text" name="noofparticipant[<?=$i?>]" class="form-control" value="<?=$up_partcipant_num[$i]?>" />
                                                          @error("noofparticipant.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
                                                        </div>
                                                      </div>
                                                       <div class="col-sm-4 col-md-4">
                                                        <div class="form-group">
                                                          Attach photo
                                                          <input type="file" name="eventphoto[<?=$i?>]" class="form-control">
                                                          @if(!empty($up_eventfile[$i]))
                                                          <img src="<?=$up_eventfile[$i]?>" class="fluid-img mt-2 reson_img" style="width:200px; height:100px">
                                                          @endif
                                                          <input type="hidden" name="eventphoto_old[<?=$i?>]" value="<?=$up_eventfile[$i]?>">
                                                          @error("eventphoto.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
                                                        </div>
                                                      </div>
                                                      <?php } ?>

                                                  </div>
                                                  <button type="submit" value="upevent_submit" name="upevent_submit" class="btn btn-primary">Submit</button>
                                              </form>
                                            </fieldset>
												  </div>
												  </br>
									
										<div class="um-field">
											<div class="um-field-area">
													
													@if($fitevent_data->register_as=='prerak') 
															@if($total_partcipant>=0)
																<a target="_blank" class="btn btn-secondary flag-dwn" href="download-fitevent-certificate">Download Prerak Certificate </a>
																	      @if($total_partcipant>=0 && $total_partcipant<500)
																	      		<br>
																	      		Now you can refer your code to become Fit India Ambassador.
																	        	<!-- <a class="btn btn-default flag-dwn refer_add_field" href="javascript:void(0)">Click Here </a> -->
																	      @endif
										          @endif
															@if($total_partcipant>=500)
																<a target="_blank" class="btn btn-info flag-dwn" href="download-fitambassador-certificate">Download Ambassador Certificate </a>
																	      @if($total_partcipant>=500 && $total_partcipant<1500)
																	        	<br>
																	      		Now you can refer your code to become Fit India Champion.
																	        	<!-- <a class="btn btn-default flag-dwn refer_add_field" href="javascript:void(0)">Click Here </a> -->
																	      @endif 
										          @endif
															@if($total_partcipant>=1500)
																<a target="_blank" class="btn btn-primary flag-dwn" href="download-fitchampion-certificate">Download Champion Certificate </a>
															@endif
													@endif


												@if($fitevent_data->register_as=='ambassador') 
															@if($total_partcipant>=500)
																<a target="_blank" class="btn btn-info flag-dwn" href="download-fitambassador-certificate">Download Ambassador Certificate </a>
																	      @if($total_partcipant>=500 && $total_partcipant<1500)
																	        	<br>
																	        	Now you can refer your code to become Fit India Champion.
																	        	<!-- <a class="btn btn-default flag-dwn refer_add_field" href="javascript:void(0)">Click Here </a> -->
																	      @endif  	
										          @endif
															@if($total_partcipant>=1500)
																<a target="_blank" class="btn btn-primary flag-dwn" href="download-fitchampion-certificate">Download Champion Certificate </a>
															@endif
													@endif


												  @if($fitevent_data->register_as=='champion') 
																<a target="_blank" class="btn btn-primary flag-dwn" href="download-fitchampion-certificate">Download Champion Certificate </a>
													@endif


											</div>
										</div>
								



									@endif
									@if($fitevent_data->status=='2')
									<a href="{{url('/prerak-apply-again/fitevent')}}/{{$fitevent_data->id}}" onclick="return confirm('Your old data registered as Fit India prerak will be removed');">Click here to apply again</a>
									@endif
								@endif
								
								

							<!-- Refferal Form -->
								<div class="refer_form" style="display:none;">
										<form method="post" action="prerak" class="form-horizontal refer_form">
											<fieldset>
											<legend>Add email id's of your friends to share your referral code and click on Submit button :</legend>
											<div id="items" class="form-group">
											  	<label class="col-md-4 control-label" for="textinput">Email</label>
												<div class="col-md-4 margin-bottom">
													<input id="textinput" name="textinput" type="text" placeholder="Enter email of referral" class="form-control input-md">
												</div>

											</div>

											</fieldset>
											<button type="button" name="referral_submit" value="referral_submit" class="btn btn-primary ">Submit</button>
										</form>
	  									<button id="add" class="btn add-more button-yellow uppercase" type="button">+ Add another referral</button> <button class="delete btn button-white uppercase">- Remove referral</button>
  									</div>
							<!-- Enter Refferal Form-->

							</div>
                        </div>
                    </div>
                </div>
            </div>



            <br><br><br><br>
        </div>
		
		
	<script>
		$(document).ready(function() {
			$('.refer_add_field').click(function(){ 
				$('.refer_form').show();
			});
			$(".delete").hide();
			//when the Add Field button is clicked
			$("#add").click(function(e) {
			$(".delete").fadeIn("1500");
			//Append a new row of code to the "#items" div
			$("#items").append('<div class="next-referral col-4"><input id="textinput" name="textinput" type="text" placeholder="Enter name of referral" class="form-control input-md"></div>');
			});
			$("body").on("click", ".delete", function(e) {
			    $(".next-referral").last().remove();
			});
		});
	</script>	
		



@endsection
