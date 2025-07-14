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


.ques_area {
		padding: 10px;
		background: #4267b2;
		color: #fff;
		border-bottom-left-radius: 100px;
		border-top-left-radius: 100px;

	}

	.ans_area {
		background: #f9f9f9;
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
<?php
$role_value = strtolower(Auth::user()->role);
?>
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
							
							    <h2>Fit India Corporate Certification </h2>                                	
							
								<div class="wrap event-form">	
									<!-- onsubmit="return create_event_validation()" -->

									@if (session('success'))
										<div class="alert alert-success">
											{{ session('success') }}
										</div>
									@endif
									@if (session('failed'))
										<div class="alert alert-danger">
											{{ session('failed') }}
										</div>
									@endif
									
										<form name="corporate_form" id="corporate_form" method="post" action="{{route('store-corporate')}}" enctype="multipart/form-data" > 
											 @csrf 
											<meta name="csrf-token" content="{{ csrf_token() }}">
											<input type="hidden" name="user_id" value="{{ Auth::id() }}"/>
											
											<!-- <div class="main_form" style="display: block;">	 -->
											<div class="um-field">
                                                <div class="form-group">
                                                    <label>Fit India Mobile App Unique ID  * :<span style="color:gray;font-style: italic;"> ( Please login via fit india mobile app to generate fit india unique id )</span></label>
                                                    <input type="text" name="unique_app_id" class="form-control ft_app_id" value="{{ Auth::id() }}" readonly >
                                                    {!!$errors->first("unique_app_id","<span class='text-danger'>:message</span>")!!}
                                                        <span id="app_test_result" style="color:red"></span>
                                                        <span id="app_test_score_result" style="color:red"></span>
                                                </div>
                                            </div>
                                         
											<div class="um-field">
												<div class="um-field-label">
													<label for="eventname">
														Corporate Name *
					                                </label>
													<div class="um-clear"></div>
												</div> 
												<div class="um-field-area">
												  <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{@$userdata->name}}" readonly>
					                              {!!$errors->first("name","<span class='text-danger'>:message</span>")!!}
												</div>
											</div>

											<div class="um-field">
												<div class="um-field-label">
													<label for="eventname">Email ID *</label>
													<div class="um-clear"></div>
												</div>
												<div class="um-field-area">
													<input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{@$userdata->email}}" readonly>
                                  					{!!$errors->first("email","<span class='text-danger'>:message</span>")!!}
												</div>
											</div>

											<div class="um-field">
												<div class="um-field-label">
													<label for="eventname">Contact Number *</label>
													<div class="um-clear"></div>
												</div> 
												<div class="um-field-area">
												    <input type="number" name="contact" class="form-control" id="contact" placeholder="Contact" value="{{@$userdata->phone}}" maxlength="10" readonly>
						                            {!!$errors->first("contact","<span class='text-danger'>:message</span>")!!}
												</div>
											</div>
											<div class="um-field q_area">
												<div class="um-field-label">
													<div class="d-flex align-items-center mb-4">
														<span class="ques_area"><b>Q1&nbsp;</b></span>
														<span class="ans_area"> <b>Organisation has conducted awareness programmes on fitness such as seminars/ workshops/celebration of fitness week or month/ participation in Fit India events in a calendar year - participation of minimum 20-50 employees for each event *</b></span>
													</div>
													<div class="um-clear"></div>
												</div> 
												<div class=" row">
													<?php
													$i=1;
													for($i=0; $i<4; $i++){
                                                    ?>
                                                      <div class="col-md-12"><strong><span> Event- <?php echo $i+1; ?> :</span></strong></div>
                                                      <div class="col-md-4">
                                                        <div class="form-group"> 
                                                         Name of the event
                                                         <input type="text" name="eventname[<?=$i?>]" class="form-control" />
                                                          @error("eventname.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
                                                        </div>
                                                      </div>
                                                      <div class="col-md-4">
                                                        <div class="form-group"> 
                                                         Date of the event
                                                         <input type="date" name="eventdate[<?=$i?>]" class="form-control" />
                                                          @error("eventdate.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
                                                        </div>
                                                      </div>

                                                     <!--  <div class="col-md-3">
                                                        <div class="form-group">
                                                          Attach photo
                                                          <input type="file" name="eventphoto[<?=$i?>]" class="form-control">
                                                          @error("eventphoto.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
                                                        </div>
                                                      </div> -->
                                                      <div class="col-md-4">
                                                        <div class="form-group"> 
                                                         Number of the partcipants
                                                          <input type="number" name="noofparticipant[<?=$i?>]" class="form-control" />
                                                          @error("noofparticipant.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
                                                        </div>
                                                      </div>

                                                      <?php } ?>
                                                </div>
                                            </div>

											<div class="um-field q_area">
												<div class="um-field-label">
													<div class="d-flex align-items-center mb-4">
														<span class="ques_area"><b>Q2&nbsp;</b></span>
														<span class="ans_area"> <b>
														 Organisation has carried out promotions (Facebook, Instagram, twitter etc.) on company’s social media platforms regarding announcement/participation in fitness initiatives by organisation *</b>
														</span>
													</div>
													<div class="um-clear"></div>
												</div> 
												<div class="row">
													<div class="col-sm-12 col-md-4">
														<div class="um-field-area form-group">
													        <input type="text" name="facebook_url" class="form-control" id="facebook_url" placeholder="Facebook Url"  >
								                            {!!$errors->first("facebook_url","<span class='text-danger'>:message</span>")!!}
														</div>
													</div>

													<div class="col-sm-12 col-md-4">	
														<div class="um-field-area form-group">
													        <input type="text" name="twitter_url" class="form-control" id="twitter_url" placeholder="Twitter Url" >
								                            {!!$errors->first("twitter_url","<span class='text-danger'>:message</span>")!!}
														</div>
													</div>

													<div class="col-sm-12 col-md-4">
														<div class="um-field-area form-group">
													        <input type="url" name="insta_url" class="form-control" id="insta_url" placeholder="Instagram Url"  >
								                            {!!$errors->first("insta_url","<span class='text-danger'>:message</span>")!!}
														</div>
													</div>
												</div>
											</div>
										
											<div class="um-field q_area">
												<div class="um-field-label">
													<div class="d-flex align-items-center mb-4">
														<span class="ques_area"><b>Q3&nbsp;</b></span>
														<span class="ans_area"> <b> Organisation has carried out fitness assessment drives and at least 20% employees have taken fitness assessment test on Fit India Mobile App *</b>
														</span>
													</div>
													<div class="um-clear"></div>
												</div>
												<div class="um-field-area">
													<input type="number" name="total_app_emp" id="total_app_emp" class="form-control" placeholder="Total  Employee Number of Fitindia app" >
                                  					{!!$errors->first("total_app_emp","<span class='text-danger'>:message</span>")!!}
												</div>
												<div class="um-field multiple_app_user " style="display:none;">
													<div class="um-field-area">
														<input id="upload_file" type="file"  name="files">
														{!!$errors->first("files", "<span class='text-danger'>:message</span>")!!}
														<div style="color:red" id="upload_file_error"></div>
													</div>
												</div>
											</div>
										
											<div class="multiple_image_section">
												<div class="um-field q_area">
													<div class="um-field-label">
														<div class="d-flex align-items-center mb-4">
															<span class="ques_area"><b>Q4&nbsp;</b></span>
															<span class="ans_area"> <b> Organisation has HR polices/ programs (E.g., Gyms/awards & recognition programs, Fitness breaks etc) that promote fitness and health of employees *</b>
															</span>
														</div>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input type="file" name="doc" id="doc" class="form-control">
														{!!$errors->first("doc", "<span class='text-danger'>:message</span>")!!}
													</div>
												</div>
											</div>

											<div class="um-field q_area">
												<div class="um-field-label">
													<div class="d-flex align-items-center mb-4">
														<span class="ques_area"><b>Q5&nbsp;</b></span>
														<span class="ans_area"> <b>Organisation has employees of Sports background of State/National/International repute (Optional)</b>
														</span>
													</div>
													<div class="um-clear"></div>
												</div> 
													
												<div class="um-field-area">
												    <input type="number" name="sports_emp_num" class="form-control" id="sports_emp_num" placeholder="Number of employee" >
								                    {!!$errors->first("sports_emp_num","<span class='text-danger'>:message</span>")!!}
												</div>
												<div class="row" id="sports_emp_details">
												</div>
											</div>

											<div class="um-field q_area">
												<div class="um-field-label">
													<div class="d-flex align-items-center mb-4">
														<span class="ques_area"><b>Q6&nbsp;</b></span>
														<span class="ans_area"> <b> Organisation’s CSR expenditure on Sports and its impact assessment (Optional)</b>
														</span>
													</div>
													<div class="um-clear"></div>
												</div>
												
												<div class="row">
													<div class="col-sm-12 col-md-4">
														<div class="um-field-area form-group">
   						                                    <input type="text" name="csr_name" class="form-control" id="csr_name" placeholder="Name"  >
								                            {!!$errors->first("csr_name","<span class='text-danger'>:message</span>")!!}
														</div>
													</div>

													<div class="col-sm-12 col-md-4">	
														<div class="um-field-area form-group">
 						                                   <input type="text" name="csr_region" class="form-control" id="csr_region" placeholder="Region" >
								                           {!!$errors->first("csr_region","<span class='text-danger'>:message</span>")!!}
														</div>
													</div>

													<div class="col-sm-12 col-md-4">
														<div class="um-field-area form-group">
													        <input type="text" name="csr_detail" class="form-control" id="csr_detail" placeholder="Details"  >
								                            {!!$errors->first("csr_detail","<span class='text-danger'>:message</span>")!!}
														</div>
													</div>
												</div>
											</div>

											<div class="um-field q_area">
												<div class="um-field-label">
													<div class="d-flex align-items-center mb-4">
														<span class="ques_area"><b>Q7&nbsp;</b></span>
														<span class="ans_area"> <b> Organisation has sports facilities/ equipment or funded the same (Optional)</b>
														</span>
													</div>
													<div class="um-clear"></div>
												</div>
												
												<div class="row">
													<div class="col-sm-12 col-md-6">
														<div class="um-field-area form-group">
 						                                  	<input type="text" name="org_equipment_name" class="form-control" id="org_equipment_name" placeholder="Name"  >
								                            {!!$errors->first("org_equipment_name","<span class='text-danger'>:message</span>")!!} 
														</div>
													</div>
													<div class="col-sm-12 col-md-6">	
														<div class="um-field-area form-group">
						                                  	<input type="text" name="org_equipment_place" class="form-control" id="org_equipment_place" placeholder="Place" >
								                            {!!$errors->first("org_equipment_place","<span class='text-danger'>:message</span>")!!}
														</div>
													</div>
												</div>
											</div>
											
											<!-- 	</div> -->
											<div class="row" id="prt_km_details"></div>
											
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
														<input type="submit" name="create-event" value="Submit" style="margin-top:0;">
													</div>
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
<!-- <div class="results2"><span></span></div>	 -->
		
<script src='https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js'></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
<script>
var unique_app_response='';
function testss(x){
    unique_app_response = x;
    return unique_app_response;
}
$(function() { 
  	let score_msg;
  	var errorMsg = '';
  	var valid = false;
	jQuery.validator.addMethod("check_unique_appid", function(value) {
    var user_id = $("[name='unique_app_id']").val() ? $("[name='unique_app_id']").val() : 0;
    var user_email = $("[name='email']").val() ? $("[name='email']").val() : '';
	    $.ajax({
	        type: 'POST',  
	        url:"{{ route('prerak_ft_test') }}",
	        data: {"user_id":user_id, "user_email":user_email, "_token": "{{ csrf_token() }}"}, 
	        success: function (data) {   
	            var test_obj = JSON.parse(data);
	            console.log("=>new="+test_obj.score);
	            if(test_obj.score=='-1'){
	                $('#app_test_result').remove();
	                testss('Please install Fit india Mobile App and take fitness assesment test'); 
	                return false;
	            }
	            else if(test_obj.score=='0'){ console.log(" 1="+test_obj.score); 
	                $('#app_test_result').remove();
	                testss('Please take fitness assesment test on fitindia mobile app');
	                return false;
	            }
	            else{
	                $('#app_test_result').remove();
	                $('#unique_app_id-error').remove();
	                $('#app_test_score_result').html("Fitness Score:- "+test_obj.score);
	                $('.ft_app_id ').rules( 'remove' );
	                return true;
	            }
	        } 
	    });
	},function() {return unique_app_response; });

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

    
    $("form[name='corporate_form']").validate({
      rules: {
      	unique_app_id: { 
      		required:true, 
      		digits: true, 
      		check_unique_appid:true 
      	},
        name:{
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
        facebook_url:{
           required:true
        },
        twitter_url:{
           required:true
        },
        insta_url:{
           required:true
        },
        total_app_emp:{
        	required:true
        },
        files:{
        	required:true,
        	extension: "csv|CSV",
        	filesize: 1000000 
        },
		doc: {
			required: true,
			extension: "gif|png|jpg|jpeg|pdf|PDF|docx|DOCX", // work with additional-mothods.js
	        filesize: 1000000 
		},
		/*sports_emp_num:{
			required:true
		},*/
		/*'emp_name[]':"required",
		'sports_name[]':"required",*/
		/*csr_name:{
			required:true
		},
		csr_region:{
			required:true
		},
		csr_detail:{
			required:true
		},
		org_equipment_name:{
			required:true
		},
		org_equipment_place:{
			required:true
		}*/
	  },
      messages: {
        org_name:{
          required:"This field is required"
        },
        email: {
          required: "Please enter your email",
          validate_email: "Please enter valid email id"
        },
        files: {
        	extension:'Only csv file allowed'
        }
        /*"emp_name[]" :  {
        required: function(params, element) {
            var index = $("input[name=emp_name[]]").index(element) + 1;
            return "Input #" + index + " required";
        }
    	},*/
      /*  'sports_name[]':"This field is required",*/
       /* facebook_url:{
           required: "This field is required"
        },
        twitter_url:{
           required: "This field is required"
        },
        insta_url:{
           required: "This field is required"
        },
        total_num_emp:{
        	 required: "This field is required"
        },
        contact: {
          required: "Please enter contact number",
          minlength: "Your phone must be 10 number long",
          maxlength: "Your phone must be 10 number long"
        },
	    
        'prt_image[]': {
          filesize:"File size must be less than 1 mb."
        }*/
    },

    submitHandler: function(form) {
    	$('[name^="sports_name"]').each(function() {
            $(this).rules('add', {
                required: true,
                messages: {
                	required: "This field is required"
                }
            })
        });
    	$('[name^="emp_name"]').each(function() {
            $(this).rules('add', {
                required: true,
                messages: {
        		    required: "Enter Event name"
                }
            })
        });
        $('[name^="eventname"]').each(function() {
            $(this).rules('add', {
                required: true,
                messages: {
                	required: "Event Name is required"
                }
            })
        });
    	$('[name^="eventdate"]').each(function() {
            $(this).rules('add', {
                required: true,
                messages: {
        		    required: "Event Date is required"
                }
            })
        });
       /* $('[name^="eventphoto"]').each(function() {
            $(this).rules('add', {
                required: true,
                messages: {
                	required: "Event photo is required"
                }
            })
        });*/
    	$('[name^="noofparticipant"]').each(function() {
            $(this).rules('add', {
                required: true,
                messages: {
        		    required: "Enter Event Participants"
                }
            })
        });


        if($(form).valid()) {
            var fitapp_user_count = $("[name='total_app_emp']").val() ? $("[name='total_app_emp']").val() : 0;
  		var score_response = '';
  		let formData = new FormData();           
		formData.append("files", upload_file.files[0]);
		formData.append("_token", '{{ csrf_token() }}');
		formData.append("fitapp_user_count",fitapp_user_count);
	   	console.log(formData);
	    $.ajax({
            url: "{{ route('check-multiple-fitscore-new') }}",  //server script to process data
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data, textStatus, xhr){
	        	var score_obj = JSON.parse(data);
	        	score_response = score_obj.status; console.log("====>"+score_response);
	        	if(score_response=='0' || score_response=='2'){
	        		$("#corporate_form #upload_file").focus();
	        		errorMsg = score_obj.msg;
	        		$('#upload_file_error').html(errorMsg);
	        	}else{ 
	        		errorMsg = '';
	        		$('#upload_file_error').html(errorMsg); 
	        		form.submit(); 
	        	}
	        },
	    });
      }
    }
  });
}); 

</script>
<style>
  .error{color:red;}
</style>
		
<script>
$(document).ready(function(){    
	$(document).on('keyup', '.number_of_partcipant', function (e) {
		var	sum_participant=0;
  		$('.number_of_partcipant').each(function(key, val){
  		var no_participant = $(this).val() ? $(this).val() : 0;
  		sum_participant = sum_participant+parseInt(no_participant);
	});
	$('#participant_count').text(sum_participant);
    });
});
</script>
<script>
$(document).ready(function(){
	$('#total_app_emp').keyup(function(){
		var ta_emp = $(this).val();
		if(ta_emp!=""){
			$('.multiple_app_user').show();
		}else{
			$('.multiple_app_user').hide();
		}	 
	});
	/*$('#total_app_emp').keyup(function(){
		var emp_app_field = []; 
		var app_emp_val = $(this).val() * 20;
		var app_emp_result = Math.round(app_emp_val/100);
		console.log("==>>"+app_emp_result);
		for(let i=1;i<=app_emp_result;i++){
			console.log(i);
			emp_app_field.push('<div class="app_user_value-'+i+'"><input type="number" name="app_user_id[]" class="app_user_id"><a class="fnd_app_value_remove" href="javascript:void(0);" ref="'+i+'">Remove</a></div>');
		}
		$('.app_user_id_result').html(emp_app_field); 
	});*/
	/*$("[type='number']").keypress(function (evt) {
    	evt.preventDefault();
	});*/

	$('#sports_emp_num').keyup(function(){
		var sports_app_field = []; 
		var sports_emp_val = $(this).val();
		
		for(let i=1;i<=sports_emp_val;i++){
			sports_app_field.push('<div class="col-sm-12 col-md-6 mt-2"><div class="d-flex"><span class="emp_count">'+i+'</span><div class="um-field-area w_100 "><div class="form-group"><input type="text" name="emp_name['+i+']" class="form-control" placeholder="Employee Name" ></div></div></div></div><div class="col-sm-12 col-md-6 mt-2"><div class="um-field-area"><div class="form-group"><input type="text" name="sports_name['+i+']" class="form-control" placeholder="Sports Name"  ></div>{!!$errors->first("sports_name","<span class='text-danger'>:message</span>")!!}</div></div>');
		}
		$('#sports_emp_details').html(sports_app_field); 
	});
});
</script>

<script>
  $(document).ready(function(){
    var user_id = $("[name='unique_app_id']").val() ? $("[name='unique_app_id']").val() : 0;
    var user_email = $("[name='email']").val() ? $("[name='email']").val() : '';
    var fitapp_user_count = $("[name='total_app_emp']").val() ? $("[name='total_app_emp']").val() : 0;
    $.ajax({
        type: 'POST',  
        url:"{{ route('prerak_ft_test') }}",
        data: {"fitapp_user_count":fitapp_user_count,"user_id":user_id, "user_email":user_email, "_token": "{{ csrf_token() }}"}, 
        success: function (data, textStatus, xhr) {  
            var test_obj = JSON.parse(data);
            console.log(test_obj);
            if(test_obj.score=='-1'){
                $('#submit_prerak').attr('disabled', 'disabled');
                $('#app_test_result').html('Please install Fit india Mobile App');
            }
            else if(test_obj.score=='0'){
                $('#submit_prerak').attr('disabled', 'disabled');
                $('#app_test_result').html('Please take fitness assesment test on fitindia mobile app');
            }
            else{
              $('#app_test_score_result').html("Fitness Score:- "+test_obj.score);
              $('#submit_prerak').removeAttr("disabled");
            }
        },  
        error: function (xhr, textStatus, errorThrown) {  
            console.log('Error in Operation '+textStatus);  
        }  
      });
  });
</script>
@endsection
