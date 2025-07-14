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
//$role_value = strtolower(Auth::user()->role);
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
                        <div class="col-sm-12 col-md-9 ">
                            <div class="description_box">
							
							
							
                                <!-- <h2>Create an Event </h2>                 -->                	
								
								<div class="wrap event-form">	
									<h3 style="color: red; font-size: 22px;" >Stay tuned for upcoming Fit India events</h3>
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
		'prt_image[]': {
		required: true,
		extension: "gif|png|jpg|jpeg", // work with additional-mothods.js
        filesize: 1000000,  
		},
		'video_link[]':{
			url:true
		},
        'number_of_partcipant[]':{
           required:true
        },
        from_date:{
           required:true
        },
        to_date:{
           required:true
        },
        'km[]':{
           required:true
        }
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
          required: "Please select school chain",          
        },
        
        'prt_image[]': {
          filesize:"File size must be less than 1 mb."
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
				$(".multiple_image_section").append('<div class="um-field org_img_section"><div class="um-field-label"><label for="eventimage1">Upload Image </label><div class="um-clear"></div></div><div class="um-field-area"><input type="file" name="prt_image[]"  class="form-control"></div></div>');
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
				$(".multiple_video_section").append('<div class="um-field org_video_section"><div class="um-field-label"><label>Upload Video Link (optional)</label><div class="um-clear"></div></div><div class="um-field-area"><input type="url" name="video_link[]" class="form-control" placeholder="Video Link"></div></div>');
				j++;
			});

			
			$("body").on("click", "#delete_org_video", function(e) {
			    $(".org_video_section").last().remove();
			    if($(".org_video_section").length==0){
			    	$('#delete_org_video').hide();
			    }
			});

			$('#from_date').change(function(){
				from_date = $(this).val();
				partcipantDetails(from_date,to_date);
			})
			$('#to_date').change(function(){
				to_date = $(this).val();
				partcipantDetails(from_date,to_date);
			})
	});

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
