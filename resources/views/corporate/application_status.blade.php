@extends('layouts.app')
@section('title', 'My Application Status | Fit India')
@section('content')
<style>
	.ques_area {
		padding: 10px;
		background: #4267b2;
		color: #fff;
		border-bottom-left-radius: 100px;
		border-top-left-radius: 100px;

	}
	.wtxt_o{top:-180px;}
	.ans_area {
		background: #fff;
		padding: 10px 15px;

		box-shadow: rgba(0, 0, 0, 0.10) 0px 2px 2px, rgba(0, 0, 0, 0.10) 0px 1px 2px;
		border-top-right-radius: 10px;
		border-bottom-right-radius: 10px;

	}

	.click_d {
		background: #1da1f2;
		padding: 4px 15px;
		border-radius: 100px;
		color: #fff;
		font-weight: 600;

	}
		.q_area{    border: 1px solid #e2e2e2;
    padding: 20px;
    margin: 10px 0;
    border-radius: 7px;
    background: #f7f7f7;
}
.emp_count{padding: 10px 10px 10px 14px;
    width: 35px;
    height: 40px;
    background: orange;
    margin-top: 0px;
    /* border-radius: 100%; */
    left: 6px;
    position: relative;}
    .w_100{width: 100%;}

	@media (max-width: 767px) {
		.ques_area {
			padding: 7px 50px;
			background: #4267b2;
			color: #fff;
			border-bottom-right-radius: 0;
			border-top-left-radius: 0;
			border-bottom-left-radius: 0;
			/* border-radius: 10px; */
			border-top-right-radius: 20px;
			border-top-left-radius: 20px;
		}

		.click_d {

			display: inline-block;
			margin-top: 10px;
		}
	}
</style>
<div class="banner_area">
	<img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
	<?php if(@$_REQUEST['auth_id']){ 
	}else{ ?>
	@include('event.userheader')
	<?php } ?>

	<div class="container container-md container-lg">
		<div class="et_pb_row <?php if(!empty(@$_GET['m'])){ echo 'wtxt_o'; }?>">
			<div class="row ">
				<?php if(@$_REQUEST['auth_id']){ 
				}else{ ?>
					@include('event.sidebar')
				<?php } ?>

				<div class="col-sm-12 col-md-12  <?php if(!empty(@$_GET['m'])){ echo 'col-lg-12'; }else{ echo 'col-lg-9';} ?> ">
					<div class="description_box">
						@php
						/*
						<p style="color: red; font-size: 22px;">Stay Tuned for upcoming Fit India Events. </p>
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
							@if(!empty($application_data))
							<table class="table table-bordered" style="margin-bottom:0!important; ">
								<tr>
									<th>Status</th>
									<td><strong style="color:green">Applied</strong></td>
								</tr>
								<tr>
									<th>Applied for</th>
									<td>
										Fit India corporate
									</td>
								</tr>

								<tr>
									<th>Name</th>
									<td>{{ucwords($application_data->name)}}</td>
								</tr>
								<tr>
									<th>Email</th>
									<td>{{$application_data->email}}</td>
								</tr>
								<tr>
									<th>Contact</th>
									<td>{{$application_data->contact}}</td>
								</tr>
							</table>

							<hr>
							<div class="q_area">
								<div class="d-flex align-items-center mb-4">
									<span class="ques_area"><b>Q1&nbsp;</b></span>
									<span class="ans_area"> <b>Organisation has conducted awareness programmes on fitness such as seminars/ workshops/celebration of fitness week or month/ participation in Fit India events in a calendar year - participation of minimum 20-50 employees for each event</b></span>
								</div>


								<div style="margin-bottom:15px;">
									<fieldset class="scheduler-border" id="event_details" style="border: 1px solid #dee2e6;padding:15px;">
										<legend class="scheduler-border" style="width:auto;padding-left: 10px;padding-right:10px;">Event Details</legend>
										<div class="row">
											<?php
											$eventname = unserialize($application_data->eventname);
											$eventdate = unserialize($application_data->eventdate);
											$noofparticipant = unserialize($application_data->noofparticipant);
											for ($i = 0; $i < 4; $i++) {
											?>
												<div class="col-sm-12"><strong><span> Event- <?php echo $i + 1; ?> :</span></strong></div>
												<div class="col-sm-4 col-md-4">
													<div class="form-group">
														Name of the event
														<input type="text" name="eventname[<?= $i ?>]" class="form-control" value="<?= $eventname[$i] ?>" readonly />
													</div>
												</div>
												<div class="col-sm-4 col-md-4">
													<div class="form-group">
														Event Date
														<input type="text" name="eventdate[<?= $i ?>]" class="form-control" value="<?= $eventdate[$i] ?>" readonly>
													</div>
												</div>
												<div class="col-sm-4 col-md-4">
													<div class="form-group">
														Number of the partcipants
														<input type="text" name="noofparticipant[<?= $i ?>]" class="form-control" value="<?= $noofparticipant[$i] ?>" readonly />
													</div>
												</div>
											<?php } ?>

										</div>
									</fieldset>
								</div>
							</div>




							<div class="q_area">
								<div class="d-flex align-items-center mb-3 ">
									<span class="ques_area"><b>Q2&nbsp;</b></span>
									<span class="ans_area"><b>Organisation has carried out promotions (Facebook, Instagram, twitter etc.) on company’s social media platforms regarding announcement/participation in fitness initiatives by organisation </b>
									</span>
								</div>

								<table class="table table-bordered" style="margin-bottom:0!important; ">
									<th>Facebook Profile</th>
									<td>{{$application_data->facebook_profile}}</td>
									</tr>

									<tr>
										<th>Twitter Profile</th>
										<td>{{$application_data->twitter_profile}}</td>
									</tr>

									<tr>
										<th>Instagram Profile</th>
										<td>{{$application_data->instagram_profile}}</td>
									</tr>
								</table>
							</div>

							<div class="q_area">
								<div class="d-flex align-items-center mb-3 ">
									<span class="ques_area"><b>Q3&nbsp;</b></span>
									<span class="ans_area">
										<b>
											Organisation has carried out fitness assessment drives and at least 20% employees have taken fitness assessment test on Fit India Mobile App
										</b>

										<?php
										if(@$_REQUEST['auth_id']){}else{
										 if ($application_data->emp_app_ids) { ?>
											<a href="<?=$application_data->emp_app_ids?>" download><span class="click_d">Click to download </span></a>
										<?php } else {
											echo "<span style='color:red'>&nbsp;Not available</span>";
										} } ?>

									</span>
								</div>
							</div>


							<div class="q_area">
								<div class="d-flex align-items-center mb-3 ">
									<span class="ques_area"><b>Q4&nbsp;</b></span>
									<span class="ans_area">
										<b>
											Organisation has HR polices/ programs (E.g., Gyms/awards & recognition programs, Fitness breaks etc) that promote fitness and health of employees. </b> 

										<?php 
										if(@$_REQUEST['auth_id']){}else{
										if ($application_data->doc) { ?>
											<a style="color:blue" href="<?= $application_data->doc ?>" download><span class="click_d">Click to download </span></a>
										<?php } else {
											echo "Not available";
										} } ?>

									</span>
								</div>
							</div>



							<div class="q_area">
								<div class="d-flex align-items-center mb-3 ">
									<span class="ques_area"><b>Q5&nbsp;</b></span>
									<span class="ans_area">
										<b>Organisation has employees of Sports background of State/National/International repute</b>
									</span>
								</div>

								<div class="row">
									<?php $emp_name = unserialize(@$application_data->emp_name);
									$spports_name = unserialize(@$application_data->spports_name);
									$i = 1;
									if (!empty($emp_name) and !empty($spports_name)) {
										foreach ($emp_name as $emp_name_val) { ?>
											<div class="col-md-6">
												<div class="d-flex">
													<span class="emp_count"><?=$i?></span>
												<div class="form-group w_100">
													
													<input type="text" name="emp_name" class="form-control" value="<?= $emp_name_val ?>" readonly>
												</div>
											</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													
													<input type="text" name="sports_name" class="form-control" value="<?= $spports_name[$i]; ?>" readonly>
												</div>
											</div>
									<?php $i++;
										}
									} ?>
								</div>
							</div>

							@endif


							<div class="q_area">
								<div class="d-flex align-items-center mb-3 ">
									<span class="ques_area"><b>Q6&nbsp;</b></span>
									<span class="ans_area">
										<b>Organisation’s CSR expenditure on Sports and its impact assessment</b>
									</span>
								</div>
								<div class="row">
									<?php if ($application_data->csr_name) { ?>
										<div class="col-sm-12 col-md-4">
											<div class="form-group">
												<input type="text" name="csr_name" class="form-control" id="csr_name" value="<?php echo $application_data->csr_name; ?>" readonly>
											</div>
										</div>
									<?php }
									if ($application_data->csr_region) { ?>
										<div class="col-sm-12 col-md-4">
											<div class="form-group">
												<input type="text" name="csr_region" class="form-control" id="csr_region" placeholder="Region" readonly>
											</div>
										</div>
									<?php }
									if ($application_data->csr_detail) { ?>
										<div class="col-sm-12 col-md-4">
											<div class="form-group">
												<input type="text" name="csr_detail" class="form-control" id="csr_detail" placeholder="Details" readonly>
											</div>
										</div>
									<?php } ?>
								</div>
							</div>


							<div class="q_area">
							<div class="d-flex align-items-center mb-3 ">
								<span class="ques_area"><b>Q7&nbsp;</b></span>
								<span class="ans_area">
									<b>Organisation has sports facilities/ equipment or funded the same</b>
								</span>
							</div>
							<div class="row">
								<?php if ($application_data->org_equipment_name) { ?>
									<div class="col-sm-12 col-md-6">
										<div class="form-group">
											<input type="text" name="org_equipment_name" class="form-control" id="org_equipment_name" value="<?= $application_data->org_equipment_name ?>" readonly>
										</div>
									</div>
								<?php } ?>
								<?php if ($application_data->csr_name) { ?>
									<div class="col-sm-12 col-md-6">
										<div class="form-group">
											<input type="text" name="org_equipment_place" class="form-control" id="org_equipment_place" value="<?= $application_data->org_equipment_place ?>" readonly>
										</div>
									</div>
								<?php } ?>

							</div>
							</div>
						</div>
						<?php if(@$_REQUEST['auth_id']){ 
						}else{ ?>
							<a target="_blank" class="btn btn-secondary flag-dwn" href="resources/imgs/certificate/Blue-certificate.jpg" download>Download Certificate</a>
						<?php } ?>

					</div>

				</div>

			</div>
		</div>



		<br><br><br><br>
	</div>


	<script>
		$(document).ready(function() {
			$('.refer_add_field').click(function() {
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