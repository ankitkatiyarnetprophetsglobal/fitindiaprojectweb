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
                          <div class="col-sm-12 col-md-9 ">
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
                                      <form name="freedum_run_form" method="post" action="{{route('freedom-update-value')}}" enctype="multipart/form-data" > 
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
                                                      <input type="text" name="event_name" id="event_name" class="form-control" placeholder="Event Name" value="Fit India Swachhata Freedom Run 4.0" readonly>
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
                                                      <input type="text" name="org_name" id="org_name" class="form-control" placeholder="Organization / Institution / Group / School Name" value="{{$events->organiser_name}}">
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
												 <select name="school_chain" id="school_chain" class="fit-pe-inputs" required>
												  <option value="">Select</option>
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
                                              &nbsp;
                                              <div class="multiple_image_section">
                                                  <div class="um-field">
                                                      <div class="um-field-label">
                                                          <label for="eventimage1">Image </label>
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

                                              <div class="addmore">   
                                                <a id="add_org_image" href="javascript:void(0)">+ Add More</a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete_org_image" href="javascript:void(0)">Delete</a>
                                              </div>

                                              <div class="multiple_video_section">
                                                  <?php $video_link_arr =  unserialize($events->video_link); 
                                                  if(!empty($video_link_arr)){ $i=1; foreach($video_link_arr as $key=>$video_link_value){ ?>
                                                  <div class="um-field">
                                                      <div class="um-field-label">
                                                          <label for="eventimage1">Video Link <?=$i?></label>
                                                          <div class="um-clear"></div>
                                                      </div>
                                                      <div class="um-field-area">
                                                          <input type="url" name="video_link[<?=$key?>]" class="form-control" placeholder="Video Link" value="<?=$video_link_value?>">     
                                                      </div>
                                                  </div>
                                                  <?php $i++;} } ?>
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
                                                          <input type="date" name="from_date" class="form-control" id="from_date" value="<?=$events->eventstartdate?>" maxlength="10" min="2023-09-02" max='2023-10-31' readonly>
                                                          {!!$errors->first("from_date", "<span class='text-danger'>:message</span>")!!}
                                                      </div>
                                                  </div>
                                                  <div class="col-sm-12 col-md-6">
                                                      <div class="form-group ">
                                                        To Date
                                                        <input type="date" name="to_date" class="form-control" id="to_date" value="<?=$events->eventenddate?>" maxlength="10" min="2023-09-02" max='2023-10-31' readonly>
                                                      {!!$errors->first("to_date", "<span class='text-danger'>:message</span>")!!}
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="row mb-3" id="event_dec" >
                                                <div class="col-sm-12 col-md-12 " >
                                                  <div class="shadow1" style="    border: 1px dotted #dfdfdf;background: rgb(255 175 75 / 10%);padding: 10px;">
                                                  <p class="m-1">E.g. The organization conducted following Fit India Freedom run 4.0 event:</p>
                                                  <p class="m-1">Events on 13-08-2023 with <b>50</b> participants ran for <b>3</b> Kms </p>
                                                  <p class="m-1">Hence no. of participants = <b>50</b>, km covered = <b>150</b></p>
                                                  </div>
                                                </div>
                                              </div>
                                          </div>

                                          <div class="row" id="prt_km_details">
                                              <?php
                                              $text_disabled = '';
                                              $eventdate_meta =  unserialize($events->eventdate_meta); 
                                              $eventpnt_meta =  unserialize($events->eventpnt_meta); 
                                              $eventkm_meta =  unserialize($events->eventkm_meta); 
                                              for($k=0;$k<count($eventdate_meta);$k++){
                                              if($eventdate_meta[$k] > date('Y-m-d')){
                                                $text_disabled = 'readonly';
                                              }else{
                                                $text_disabled = '';
                                              }
                                              ?>
                                              <div class="col-sm-12 col-md-4">
                                                  <div class="form-group ">
                                                      <input type="text" name="prt_date[<?=$k?>]" class="form-control km" value="<?=$eventdate_meta[$k];?>" readonly>
                                                  </div>
                                              </div>
                                              <div class="col-sm-12 col-md-4">
                                                  <div class="form-group ">
                                                      <input type="number" name="number_of_partcipant[<?=$k?>]" class="form-control prt number_of_partcipant" placeholder="no. of participant (each day)" maxlength="<?php echo $participant_value; ?>" value="<?=$eventpnt_meta[$k];?>" <?=$text_disabled?>>
                                                  </div>
                                              </div>
                                              <div class="col-sm-12 col-md-4">
                                              <div class="form-group ">
                                              <input type="number" name="km[<?=$k?>]" class="form-control kms_field km_number" placeholder="Kms (each day)" maxlength="<?php echo $kilometers; ?>" value="<?=$eventkm_meta[$k];?>" <?=$text_disabled?>>
                                              </div>
                                              </div>
                                              <?php }  ?>

                                              <div class="col-sm-12 col-md-4">
                                                  <div class="form-group area_div_p" style="font-size:18px;padding:5px 8px;">
                                                      <b>Total</b>
                                                  </div>
                                              </div>

                                              <div class="col-sm-12 col-md-4">
                                                  <div class="form-group area_div_p">
                                                    <input type="hidden" name="participant_count_2" id="participant_count_2">
                                                      Total Participant : <span id="participant_count">0</span>
                                                  </div>
                                              </div>

                                               <div class="col-sm-12 col-md-4">
                                                  <div class="form-group area_div_p">
                                                    <input type="hidden" name="kms_count_2" id="kms_count_2">
                                                      Total Kms : <span id="kms_count">0</span>
                                                  </div>
                                              </div>
                                           

                                          </div>
                                          
                                          <div style="clear:both"></div>
                                          <div class="um-field">
                                               <div class="um-field-area">
                                                  <input type="submit" name="create-event" value="Update Event">
                                              </div> 
                                          </div>
                                          <div class="mt-4 btn_spc">
                                             <!--  <a id="organizer_download_1" class="btn btn-primary clic_btn btn_free" style="display:none" href="javascript:void(0);" onclick="return alert('Please fill all the participant details')" >Download Certificate</a> 
                                              <a id="organizer_download_2" class="btn btn-primary clic_btn btn_free" style="display:none" href="{{url('freedom-certificate-process')}}/{{$events->id}}">Download Certificate</a>-->
                                              <a id="organizer_download_2_new" class="btn btn-primary clic_btn btn_free" href="{{url('freedom-certificate-process')}}/{{$events->id}}">Download Certificate</a>
                                              <a id="invidual_download" class="btn btn-primary clic_btn btn_free" href="{{url('freedom-run-partcipant')}}/{{$events->id}}">Add Participant Name</a>
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
    $("form[name='freedum_run_form']").validate({
      rules: {
        org_name:{
          required:true
        },
        contact: {
            required:true,
            minlength:10,
            maxlength:10
        },
        'number_of_partcipant[]':{
           required:true
        },
        'km[]': {
           required:true
        }
      },
      messages: {
        'km[]': {
           required:'this field is requried'
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
    var sum_participant=0;
      $('.number_of_partcipant').each(function(key, val){
      var no_participant = $(this).val() ? $(this).val() : 0;
      sum_participant = sum_participant+parseInt(no_participant);
  });
  $('#participant_count').text(sum_participant);
  });

  $(document).on('keyup', '.km_number', function (e) {
    var sum_of_km=0;
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
        $(".multiple_image_section").append('<div class="um-field org_img_section"><div class="um-field-label"><label for="eventimage1">Image </label><div class="um-clear"></div></div><div class="um-field-area"><input type="file" name="prt_image[]"  class="form-control"></div></div>');
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
      prt_arr.push('<div class="col-sm-12 col-md-4"><div class="form-group "><input type="text" name="prt_date["'+i+'"]" class="form-control" value="'+full_date+'"></div></div><div class="col-sm-12 col-md-4"><div class="form-group "><input type="number" name="number_of_partcipant["'+i+'"]" class="form-control number_of_partcipant" placeholder="No. of participants"  maxlength="'+participant_value+'"></div></div><div class="col-sm-12 col-md-4"><div class="form-group "><input type="number" name="km["'+i+'"]" class="form-control km_number" placeholder="Kilometer" maxlength="'+kilometers+'" required></div></div>');
    
    currentDate.setDate(currentDate.getDate() + 1);
    i++;
    }
  $('#prt_km_details').html(prt_arr);
  //  $('#results').html(between.join('<br> '));
}

  </script>

<script> 
 $(document).ready(function(){  
 var total_prt=0;
 var total_km_num=0;
 var prt = [];
 var kms = [];
 var l=0;
var m=0;
$('.prt').each(function(){
   var total_num_participant = $(this).val();
  
   if(total_num_participant==""){
    console.log("empty==");
    prt.push(l++);
   }else{
      console.log(total_num_participant); 
      total_prt=total_prt+parseInt(total_num_participant);
  }

    
});

$('.kms_field').each(function(){
   var total_kms = $(this).val();
  
   if(total_kms==""){
    console.log("empty==");
    kms.push(m++);
   }else{
      console.log(total_kms); 
      total_km_num=total_km_num+parseInt(total_kms);
  }
});

console.log("==l="+l+"==m="+m);
if(l=='0' && m=='0'){ 
    $('#organizer_download_2').show();
    $('#organizer_download_1').hide();
}
if(l!='0' || m!='0'){ 
    $('#organizer_download_1').show();
    $('#organizer_download_2').hide();
}

$('span#kms_count').text(total_km_num);
$('span#participant_count').text(total_prt);

$('#kms_count_2').val(total_km_num);
$('#participant_count_2').val(total_prt);
});
/*$('.kms_field').each(function(){
   var total_num_participant = $(this).val();
   if(total_num_participant==""){
    console.log("empty==");
    prt.push(l++);
   }else{
      console.log(total_num_participant); 
      total_prt=total_prt+total_num_participant;
  }
});
if(prt.length>0){
    console.log("=>>length"+prt.length);

     $('#organizer_download_1').show();
     $('#organizer_download_2').hide();
     

}else{
    console.log("===>>"+'0');
    //$('#organizer_download').attr('href','test');
    $('#organizer_download_1').hide();
    $('#organizer_download_2').show();
}*/






</script>
@endsection
