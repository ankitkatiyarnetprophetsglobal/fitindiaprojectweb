@extends('layouts.app')
@section('title', 'Organise Event | Fit India')
@section('content')

<style>
.addmore{margin-top: 10px;margin-bottom: 10px;}
    .addmore a{
      background: #f5f5f5;
    padding: 5px;
    border-radius: 3px;
    color: #777;
    border: 1px solid #777;
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
                                  <h2>Update Event </h2>   
                           
                                  <div class="wrap event-form"> 
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
                                      <form name="school_event_update" method="post" action="{{route('event-update-value')}}" enctype="multipart/form-data" > 
                                          @csrf
                                          <input type="hidden" name="id" value="{{$events->id}}"/>
                                          <input type="hidden" name="user_id" value="{{ Auth::id() }}"/>
                                          <div class="main_form" style="display: block;"> 
                                              <div class="um-field"></div>
                                              <div class="um-field">
                                                  <div class="um-field-label">
                                                      <label for="eventname">Event Name *</label>
                                                      <div class="um-clear"></div>
                                                  </div> 
                                                  <div class="um-field-area">
                                                      <input type="text" name="event_name" id="event_name" class="form-control" placeholder="Event Name" value="National Sports Day 2023" readonly>
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
                                                      <input type="text" name="org_name" id="org_name" class="form-control" placeholder="Organization / Institution / Group / School Name" value="{{$events->organiser_name}}" >
                                                          {!!$errors->first("name","<span class='text-danger'>:message</span>")!!}
                                            
                                                  </div>
                                              </div>
                                              <div class="um-field">
                                                  <div class="um-field-label">
                                                      <label for="eventname">Email ID *</label>
                                                      <div class="um-clear"></div>
                                                  </div>
                                                  <div class="um-field-area">
                                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{$events->useremail}}" readonly>
                                                       {!!$errors->first("email","<span class='text-danger'>:message</span>")!!}
                                                  </div>
                                              </div>
                                              <div class="um-field">
                                                  <div class="um-field-label">
                                                    <label for="eventname">Contact Number *</label>
                                                    <div class="um-clear"></div>
                                                  </div> 
                                                  <div class="um-field-area">
                                                      <input type="number" name="contact" class="form-control" id="contact" placeholder="Contact" value="{{$events->phone}}" maxlength="10">
                                                      {!!$errors->first("contact","<span class='text-danger'>:message</span>")!!}
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
												 <select name="school_chain"  id="school_chain" class="fit-pe-inputs" required>
												  {{-- <option selected disabled>Select</option> --}}
												  <option value="KVS" <?=(!empty($events->school_chain)&&($events->school_chain=='KVS'))? 'selected=selected' : ''?>>KVS</option>
												  <option value="CBSE"<?=(!empty($events->school_chain)&&($events->school_chain=='CBSE'))? 'selected=selected' : ''?>>CBSE</option>
												  <option value="CISCE"<?=(!empty($events->school_chain)&&($events->school_chain=='CISCE'))? 'selected=selected' : ''?>>CISCE</option>
												  <option value="NV"<?=(!empty($events->school_chain)&&($events->school_chain=='NV'))? 'selected=selected' : ''?>>JNV(Jawahar Navodaya Vidyalaya)</option>
												  <option value="State Education Board"<?=(!empty($events->school_chain)&&($events->school_chain=='State Education Board'))? 'selected=selected' : ''?>>State Education Board</option>
												 </select>
												 {!!$errors->first("school_chain","<span class='text-danger'>:message</span>")!!}
												</div>
											  </div>	
                        <?php } ?>	
  											
                        <?php 
                        // if ($role_value=='mexta'){ 
                          if(strtolower($role_value) == 'mexta' 
                            || strtolower($role_value) == 'mhrddsel' 
                            || strtolower($role_value) == 'mhrdhei' 
                            || strtolower($role_value) == 'mha' 
                            || strtolower($role_value) == 'mpng' 
                            || strtolower($role_value) == 'md' 
                            || strtolower($role_value) == 'mfinance'){
                        ?>
											  <div class="um-field">
												<div class="um-field-label">
													<label for="eventname">Organisation *</label>
													<div class="um-clear"></div>
												</div> 
												<div class="um-field-area">												
												 <select name="school_chain"  id="school_chain" class="fit-pe-inputs" required>
												  {{-- <option selected disabled>Select</option> --}}
												  <option value="mexta" <?=(!empty($events->school_chain)&&($events->school_chain=='mexta'))? 'selected=selected' : ''?>>MINISTRY OF EXTERNAL AFFAIRS</option>												  
												  <option value="mhrddsel" <?=(!empty($events->school_chain)&&($events->school_chain=='mhrddsel'))? 'selected=selected' : ''?>>MINISTRY OF EDUCATION (DSEL)</option>												  
												  <option value="mhrdhei" <?=(!empty($events->school_chain)&&($events->school_chain=='mhrdhei'))? 'selected=selected' : ''?>>MINISTRY OF EDUCATION (HEI)</option>												  
												  <option value="mha" <?=(!empty($events->school_chain)&&($events->school_chain=='mha'))? 'selected=selected' : ''?>>MINISTRY OF HOME AFFAIRS</option>												  
												  <option value="mpng" <?=(!empty($events->school_chain)&&($events->school_chain=='mpng'))? 'selected=selected' : ''?>>MINISTRY OF PETROLEUM AND NATURAL GAS</option>												  
												  <option value="md" <?=(!empty($events->school_chain)&&($events->school_chain=='md'))? 'selected=selected' : ''?>>MINISTRY OF DEFENCE</option>												  
												  <option value="mfinance" <?=(!empty($events->school_chain)&&($events->school_chain=='mexta'))? 'selected=selected' : ''?>>MINISTRY OF FINANCE</option>												  
												 </select>
												 {!!$errors->first("school_chain","<span class='text-danger'>:message</span>")!!}
												</div>
											  </div>	
                        <?php } ?>	
                                              &nbsp;
                                              <div class="">
                                                <div class="um-field">
                                                  <div class="um-field-label">
                                                    <label for="eventimage1">Upload Background Image (optional) <span style="opacity: 50%">(Maximum file size less than 2 MB, file must be .png,.jpg,.jpeg)</span></label>
                                                    <div class="um-clear"></div>
                                                  </div>
                                                  @if(isset($events->event_bg_image))
                                                  <img src="{{$events->event_bg_image}}" width="50" height="50"/>
                                                  @endif
                                                  <div class="um-field-area">
                                                    <input type="file" name="event_bg_image" class="form-control">
                                                    {!!$errors->first("prt_image", "<span class='text-danger'>:message</span>")!!}
                                                  </div>
                                                </div>
                                              </div>
                                              &nbsp;
                                              <div class="multiple_image_section">
                                                  <div class="um-field">
                                                      <div class="um-field-label">
                                                          <label for="eventimage1">Add Event Picture  (optional) <span style="opacity: 50%">(Maximum file size less than 2 MB, file must be .png,.jpg,.jpeg)</span> </label>
                                                          <div class="um-clear"></div>
                                                      </div>
                                                      <?php $event_img_arr =  unserialize($events->eventimg_meta); 
                                                      if(!empty($event_img_arr)){ $i=1; foreach($event_img_arr as $key=>$event_img_value){ ?>
                                                      <img src="<?=$event_img_value?>" width="50" height="50"/>
                                                      <?php $i++; } } ?> 
                                                      <br>
                                                      <div class="um-field-area">
                                                          <input type="file" name="prt_image[]" class="form-control" >
                                                      </div>
                                                  </div>
                                                  <textarea type="hidden" name="old_prt_image" style="display:none;"><?=$events->eventimg_meta?></textarea>
                                              </div>

                                              <div class="addmore" style="margin-top:20px; margin-bottom:15px; ">   
                                                <a id="add_org_image" href="javascript:void(0)" style="padding: 6px; border-radius: 5px; color: #1da1f2; font-size: 13px; border: 1px solid #1da1f2; background-color:#ffffff;">+ Add More</a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete_org_image" href="javascript:void(0)">Delete</a>
                                              </div>

                                              <div class="multiple_video_section">
                                                  <?php $video_link_arr =  unserialize($events->video_link); 
                                                  if(!empty($video_link_arr)){ $i=1; foreach($video_link_arr as $key=>$video_link_value){ ?>
                                                  <div class="um-field">
                                                      <div class="um-field-label">
                                                          <label for="eventimage1">Add Event Video Link (optional) <?=$i?></label>
                                                          <div class="um-clear"></div>
                                                      </div>
                                                      <div class="um-field-area">
                                                          <input type="url" name="video_link[<?=$key?>]" class="form-control" placeholder="Video Link" value="<?=$video_link_value?>">     
                                                          <span>For Example from Youtube , Facebook etc.</span>
                                                        </div>
                                                  </div>
                                                  <?php $i++;} } ?>
                                              </div>
                                              <div class="addmore" style="margin-top:20px; margin-bottom:15px; " >   
                                                  <a id="add_org_video" href="javascript:void(0)" style="padding: 6px; border-radius: 5px; color: #1da1f2; font-size: 13px; border: 1px solid #1da1f2; background-color:#ffffff;">+ Add More</a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete_org_video" href="javascript:void(0)">Delete</a>
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
                                                          <input type="date" name="from_date" class="form-control" id="from_date" value="<?=$events->eventstartdate?>" maxlength="10" min="2023-08-21" max='2023-08-29' >
                                                          {!!$errors->first("from_date", "<span class='text-danger'>:message</span>")!!}
                                                      </div>
                                                  </div>
                                                  <div class="col-sm-12 col-md-6">
                                                      <div class="form-group ">
                                                        To Date
                                                        <input type="date" name="to_date" class="form-control" id="to_date" value="<?=$events->eventenddate?>" maxlength="10" min="2023-08-21" max='2023-08-29'>
                                                      {!!$errors->first("to_date", "<span class='text-danger'>:message</span>")!!}
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="row mb-3" id="event_dec" >
                                                

                                              {{-- <div class="col-sm-12 col-md-4">
                                                  <div class="form-group area_div_p">
                                                    <input type="hidden" name="participant_count_2" id="participant_count_2">
                                                      Total Participant : <span id="participant_count">0</span>
                                                  </div>
                                              </div> --}}

                                               
                                           

                                          </div>
                                          
                                          <div style="clear:both"></div>
                                          <div class="um-field">
                                               <div class="um-field-area">
                                                  <input type="submit" name="create-event" value="Update Event">
                                              </div> 
                                          </div>
                                          <div class="mt-4 btn_spc">
                                              <a id="organizer_download_1" class="btn btn-primary clic_btn btn_free" style="display:none" href="javascript:void(0);" onclick="return alert('Please fill all the participant details')" >Download Certificate</a> 
                                              <a id="organizer_download_2" class="btn btn-primary clic_btn btn_free" style="display:none" href="{{url('freedom-certificate-process')}}/{{$events->id}}">Download Certificate</a>
                                              <a id="organizer_download_2_new" class="btn btn-primary clic_btn btn_free" href="{{ url('event-certificate-process', $events->id) }}">Download Certificate</a>
                                              <a id="invidual_download" class="btn btn-primary clic_btn btn_free" href="{{url('event-add-partcipant/'.$events->id)}}">Add Participant Name</a>
                                          
                                            </div> 
                                      </form>
                                  </div>
                                  <div id="results"></div>
                              </div>

                              
                          </div>
                      </div>
                  </div>
              </div>
</div>
    
    
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

    
    $("form[name='school_event_update']").validate({
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
        $(".multiple_image_section").append('<div class="um-field org_img_section"><div class="um-field-label"><label for="eventimage1">Add Event Picture  (optional) <span style="opacity: 50%">(Maximum file size less than 2 MB, file must be .png,.jpg,.jpeg)</span></label><div class="um-clear"></div></div><div class="um-field-area"><input type="file" name="prt_image[]"  class="form-control"></div></div>');
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
        $(".multiple_video_section").append('<div class="um-field org_video_section"><div class="um-field-label"><label>Add Event Video Link (optional)</label><div class="um-clear"></div></div><div class="um-field-area"><input type="url" name="video_link[]" class="form-control" placeholder="Event Video Link"> <span>For Example from Youtube , Facebook etc.</span></div></div>');
        j++;
      });

      
      $("body").on("click", "#delete_org_video", function(e) {
          $(".org_video_section").last().remove();
          if($(".org_video_section").length==0){
            $('#delete_org_video').hide();
          }
      });

      // $('#from_date').change(function(){
      //   from_date = $(this).val();
      //   partcipantDetails(from_date,to_date);
      // })
      // $('#to_date').change(function(){
      //   to_date = $(this).val();
      //   partcipantDetails(from_date,to_date);
      // })


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


  </script>


@endsection
