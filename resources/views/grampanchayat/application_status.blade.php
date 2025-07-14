@extends('layouts.app')
@section('title', 'My Application Status | Fit India')
@section('content')

<style>
	.description_box h2{margin-top:0;    margin-top: 0;
    text-align: center;
    padding-bottom: 7px;}
	.wtxt_o{top:-180px;}

	.hyphenate {
  /* Careful, this breaks the word wherever it is without a hyphen */
  overflow-wrap: break-word;
  word-wrap: break-word;

  /* Adds a hyphen where the word breaks */
  -webkit-hyphens: auto;
  -ms-hyphens: auto;
  -moz-hyphens: auto;
  hyphens: auto;
}
.w_break{word-break: break-all};

@media (max-width: 767px) { 
.mob_btn_cust{width:100%!important;}
}
	</style>
<?php error_reporting(0); ?>
<div class="banner_area">
	<img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
		<?php if($_REQUEST['auth_id']){
			}else{ ?>
					@include('event.userheader')
			<?php } ?>

            <div class="container">
                <div class="et_pb_row <?php if(!empty(@$_GET['m'])){ echo 'wtxt_o'; }?>">
                    <div class="row ">
                        
						 	<?php if($_REQUEST['auth_id']){
							}else{ ?>           
							@include('event.sidebar')
							<?php } ?>
						
                        <div class="col-sm-12 col-md-9 ">
                            <div class="description_box">
							@php
							/*
							<p style="color: red; font-size: 22px;" >Stay Tuned for upcoming Fit India Events. </p>
							*/	
							@endphp	
							
							
                                <h2>My Application Status</h2>
                                
								
								
								
								<div class="wrap event-form " style="    overflow-x: auto;">	
									<!-- onsubmit="return create_event_validation()" -->

									@if (session('success'))
										<div class="alert alert-success">
											{{ session('success') }}
										</div>
									@endif
									
									@if(!empty($prerak_data))
							 		<table class="table table-bordered" style="margin-bottom:0!important; over-fle">
										<tr>
										<th>Status</th>
										<td><strong><?php if($prerak_data->status=='1'){ echo '<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-success">Approved</span>'; }elseif($prerak_data->status=='2'){ echo '<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-danger">Rejected</span>'; }else{ echo '<span style="display: inline-block;padding: .25em .7em;font-size: 12px;font-weight: 400;" class="badge badge-warning">Pending</span>'; } ?></strong></td>
										</tr>
										<tr>
										<th>Applied for</th>
										<td>
										Fit India Gram Panchayat Ambassador
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
										<th>Name</th>
										<td><?=ucwords($prerak_data->name);?></td>
										</tr>
										<tr>
										<th>Email</th>
										<td class="hyphenate w_break"><?=$prerak_data->email?></td>
										</tr>
										<tr>
										<th>Contact</th>
										<td><?=$prerak_data->contact?></td>
										</tr>
										<tr>
										<tr>
										<th>Designation</th>
										<td><?=$prerak_data->designation?></td>
										</tr>
										<tr>
										<th>Gender</th>
										<td><?=ucfirst($prerak_data->gender)?></td>
										</tr>
										
										<tr>
										<th>State Name</th>
										<td><?=$prerak_data->state_name?></td>
										</tr>
										<tr>
										<th>District Name</th>
										<td><?=$prerak_data->district_name?></td>
										</tr>	
										<tr>
										<th>Block Name</th>
										<td><?=$prerak_data->block_name?></td>
										</tr>
										
										<tr>
										<th>Letter / Document</th>
										<td><a  class="hyphenate" href="<?=$prerak_data->document_file?>" download>Click to download Letter / Document</a></td>
										</tr>

										<!-- <tr>
										<th>Social Media Url</th>
										<td><?=$prerak_data->social_media_url?></td>
										</tr> -->
										@if($prerak_data->facebook_profile)
										<tr>
										<th>Facebook Profile</th>
										<td style="    word-break: break-all;"><?=$prerak_data->facebook_profile?>
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
										<th>Age Verification Proof</th>
										<td><a href="<?=$prerak_data->age_proof?>" download>Click to download Age Verification Proof</a></td>
										</tr>
										
										<tr>
										<th>Applied Date</th>
										<td><?php
										$sec = strtotime($prerak_data->created_at);  
    									$newdate = date ("d-m-Y", $sec);  
										echo $newdate;								
    									?>
    									</td>
										</tr>
										
									</table>

									<div style="border: 1px solid #dee2e6;padding:15px;border-top:0px solid  #dee2e6;margin-bottom:15px;">
											   <h2>Declaration</h2>
									             		
	                              								<p>The Individual Must be following Fit India Movement’s Social media handles (@FitIndiaOff)  and other hashtags as decided by Fit India Mission. 
									                            </p>
	                            						
								          			
						                                		<p> The individual should organize Fit India’s on-ground/virtual
						  				                    	events every quarter for at least 50 participants and upload the photos of the same by tagging @FitIndiaOff </p>
						                              	
							                              		<p> Individual should be aware about the importance of physical fitness and 
							                  					spend 30-60 minutes daily for at least 5 days every week for physical activities.
							                  					Physical activities could be playing any sport, traditional game, walking, cycling, dancing, running, or any other physical activity</p> 
													    
									</div>
									
                					@if($prerak_data->status=='1')
                						<!--Event form quarterly -->
										<div style="    bmargin-bottom:15px;">
											<fieldset class="scheduler-border" id="event_details" style="border: 1px solid #dee2e6;padding:15px;">
                                                <legend class="scheduler-border" style="width:auto;padding-left: 10px;padding-right:10px;">Event Details</legend>
                                                <form method="POST" action="update_grampanchayat_newevent" enctype="multipart/form-data">
                                                	@csrf
                                                	<input type="hidden" name="prk_id" value="{{$prerak_data->id}}">
                                                <div class="row">
                                                  <?php 
                                                  $up_eventname = unserialize($prerak_data->eventname);
                                                  $up_partcipant_num = unserialize($prerak_data->noofparticipant);
                                                  $up_eventfile = unserialize($prerak_data->eventphoto);
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
                                                          <?php if(!empty($up_eventfile[$i])){ ?>
                                                          <img src="<?=$up_eventfile[$i]?>" height="50" width="100">
                                                      	  <?php } ?>
                                                          <input type="hidden" name="eventphoto_old[<?=$i?>]" value="<?=$up_eventfile[$i]?>">
                                                          @error("eventphoto.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
                                                        </div>
                                                      </div>
                                                      <?php } ?>

                                                  </div>
                                                  <button type="submit" value="upevent_submit" name="upevent_submit" class="btn btn-primary mob_btn_cust">Submit</button>
                                              </form>
                                            </fieldset>
												  </div>
												  </br>


										<?php if($_REQUEST['auth_id']){
										}else{ ?>  
										<div class="um-field">
											<div class="um-field-area">
												<a target="_blank" class="btn btn-primary flag-dwn" href="download-grampanchayat-certificates">Download Fit India Gram Panchayat Ambassador Certificate</a>
											</div>
										</div>
									<?php } ?>
									@endif
									
									@if($prerak_data->status=='2')
										<?php if($_REQUEST['auth_id']){ ?>
						<a href="{{url('/gmapply-again-mobile')}}/?auth_id=<?=@$_REQUEST['auth_id']?>&event_id=<?=@$prerak_data->id?>" onclick="return confirm('Your old data registered as Fit India <?=$prerak_data->register_as?> will be removed');">Click here to apply again</a>
												<?php	}else{ ?> 
										<a href="{{url('/gram-panchayat-apply-again')}}/{{$prerak_data->id}}" onclick="return confirm('Your old data registered as Fit India <?=$prerak_data->register_as?> will be removed');">Click here to apply again</a>
											<?php } ?>
									@endif
								@endif
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
