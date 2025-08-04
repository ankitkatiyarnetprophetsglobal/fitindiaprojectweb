@extends('layouts.app')
@section('title', 'Organise Event | Fit India')
@section('content')
<style>
	.cor_area {
		font-weight: bold;
		background: rgb(247 247 247);
		padding: 10px 15px 10px 10px;
		width: 100%;
		letter-spacing: .50px;
		border-radius: 5px;
	}

	.sp_id {
		height: 20px;

	}

	.star-rating-content.current {
		border: 2px solid #ccc;
		background-color: rgb(255 255 255);
		position: relative;
	}

	.star-rating-content.current .rating-heading span.default-i {
		right: -2px;
		top: -2px;
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
						@php
						/*
						<p style="color: red; font-size: 22px;">Stay Tuned for upcoming Fit India Events. </p>
						*/
						@endphp


						<h2>Fit India Corporate Certification </h2>

						<div class="wrap event-form">
							<!-- onsubmit="return create_event_validation()" -->

							@if (session('success'))
							<div class="alert alert-success">
								{{ session('success') }}
							</div>
							@endif

							<div id="tab-1623" class="star-rating-content  current    ">
								<form name="threestarrequest" method="post" action="https://fitindia.gov.in/fivestar" enctype="multipart/form-data">
									<input type="hidden" name="_token" value="dx7ukzbMl4SwXfUaDFLNz9w0bKOLBBJEjIktZ5wW">
									<div class="rating-heading">
										<!-- <h3>Request for 5 Star </h3> -->
										<span class="default-i "> <i class="fa fa-ban" aria-hidden="true"> </i> Not Applied </span>
									</div>

									<div class="d-flex cor_area"> <span class="star-ques-sr">1.&nbsp;</span>
										<label for="ques_name" class="star-questions">
											Number of employees who have taken fitness assessment test, Fit India Mobile App ids to be given by the corporate
										</label>
									</div>

									<div class=" row playground-row  mt-2 mobile_flex_3 mb-3">
										<div class="col-sm-12 col-md-4 col-lg-4  ">
											<span class="sp_id">Number of employees</span>
											<input type="tel" name="schoolfitnessid" value="" class="input_block" style="margin-top:0!important;">
										</div>

										<div class="col-sm-12 col-md-8 col-lg-8 ">
											<div class="">
												<span class="sp_id sp_id2">Mobile App ids</span>
												<input type="file" id="eventimage2" name="eventimage2">
											</div>
										</div>

									</div>

									<div class="d-flex cor_area"> <span class="star-ques-sr">2.&nbsp;</span>
										<label for="ques_name" class="star-questions">
											Organisation has employees of Sports background of State/National/International repute
										</label>
									</div>

									<div class=" row playground-row  mt-2 mobile_flex_3">
										<div class="col-sm-12 col-md-4 col-lg-4  ">
											<span class="sp_id">Number of employees</span>
											<input type="tel" name="schoolfitnessid" value="" class="input_block" style="margin-top:0!important;">
										</div>

										<div class="col-sm-12 col-md-4 col-lg-4 ">
											<div class="">
												<span class="sp_id sp_id2">Name of the persons </span>
												<input type="text" name="noofstudents" value="" class="input_block">
											</div>
										</div>
										<div class="col-sm-12 col-md-4 col-lg-4 ">
											<span class="sp_id sp_id2">Sports discipline</span>
											<div class="sub_ques_elem board">
												<select name="peboard">
													<option value="">Select Sport</option>
													<option>Basketball</option>
													<option>Badminton</option>
													<option>Baseball</option>
													<option>Bobsleigh</option>
													<option>Boxing</option>
												</select>
											</div>
										</div>
									</div>

									<div class="d-flex cor_area mt-3 mb-2"> <span class="star-ques-sr">3.&nbsp;</span>
										<label for="ques_name" class="star-questions">
											Organisation’s CSR expenditure on Sports and its impact assessment
										</label>
									</div>

									<div class="row playground-row  mt-2 mobile_flex_3">
										<div class="col-sm-12 col-md-12 col-lg-12 mt-2 mb-2  ">
											<span class="sp_id">Project Name</span>
											<input type="text" name="schoolfitnessid" value="" class="input_block">
										</div>

										<div class="col-sm-12 col-md-12 col-lg-12 mt-2 mb-2 ">
											<span class="sp_id sp_id2">Description </span>
											<textarea name="achievements" rows="5" style="width:100%;"> </textarea>
										</div>
									</div>

									<div class="d-flex cor_area mt-1 mb-2"> <span class="star-ques-sr">4.&nbsp;</span>
										<label for="ques_name" class="star-questions">Organisation has sports facilities/ equipment or funded the same
										</label>
									</div>

									<div class="row playground-row  mt-2 mobile_flex_3">
										<div class="col-sm-12 col-md-6 col-lg-6 mt-2 mb-2  ">
											<span class="sp_id">Name</span>
											<input type="text" name="schoolfitnessid" value="" class="input_block">
										</div>

										<div class="col-sm-12 col-md-6 col-lg-6 mt-2 mb-2 ">
											<span class="sp_id sp_id2">Place </span>

											<input type="text" name="schoolfitnessid" value="" class="input_block">
										</div>
									</div>



									<div class="um-field">
										<div class="um-field-area">
											<input type="submit" name="star-rating" value="Submit">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection