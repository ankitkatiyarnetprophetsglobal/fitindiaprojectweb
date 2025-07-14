@extends('layouts.app')
@section('title', 'Prerak | Fit India')
@section('content')
 <style>
      fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
                box-shadow:  0px 0px 0px 0px #000;
    }

        legend.scheduler-border {
            font-size: 1.2em !important;
            font-weight: bold !important;
            text-align: left !important;
            width:auto;
            padding:0 10px;
            border-bottom:none;
    }
    .badge-info {
    color: #fff;
    background-color: #ff8000;
}
.badge {
    display: inline-block;
    padding: .25em .7em;
    font-size: 12px;font-weight:400;}
     .selectbox_radio input{
        padding-right: 15px;

    }
    .selectbox_radio span{padding-left: 7px;padding-right: 20px;}
    </style>

<?php
/*echo "<pre>";
print_r($user_info);
echo "</pre>"; */ ?>
<div class="banner_area">
    <img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
    @include('event.userheader')
        <div class="container ">
            <div class="et_pb_row">
                <div class="row ">
                    @include('event.sidebar')
                    <div class="col-sm-12 col-md-9 ">
                        
                            <div class="wrap event-form"> 
                                
                                <div class="container prerak_cont">
                                    @if(session('success'))
                                        <div class="alert alert-success"><center><i class="fa fa-check-circle" aria-hidden="true"></i> {{session('success')}}</center></div>
                                    @endif    
                                    @if(session('failed'))
                                    <div class="alert alert-danger"><center><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{session('failed')}}</center></div>
                                    @endif 
                                    <div class="row ambass_area">
                                       <h2>Submit your application to become Fit India Influencer</h2>
                                        <form name="prerakform" id="prerakform" method="post" action="add-prerak" enctype="multipart/form-data">
                                        @csrf
                                          &nbsp;

                                        
                                        <div class="selectbox_radio d-flex align-items-sm-start  mt-3 mb-3 ">  
                                             <div class="d-flex flex-row align-items-center align-content-start"> 
                                                <input type="radio" class="exp_action" name="action_name" checked value="Social_Media"> <span>
                                                    Social Media Specialist</span>
                                            </div>
                                             <div class="d-flex flex-row align-items-center align-content-start"> 
                                                <input type="radio" class="exp_action" name="action_name" value="Fitness_Event"> <span>
                                                  Fitness Event Specialist </span>  
                                              </div> 
                                       </div> 
                                       <div class="mob_veer"> 
                                     
                                   </div>
                                       <div class="selectbox_radio d-flex align-items-sm-start  mt-3 mb-3">   
                                         <div class="d-flex flex-row align-items-center align-content-start"> 
                                            <input type="radio" class="influencer_type" name="influencer_type" value="prerak"> <span>Prerak</span>
                                        </div>
                                         <div class="d-flex flex-row align-items-center align-content-start"> 
                                            <input type="radio" class="influencer_type" name="influencer_type" value="ambassador"> <span>Ambassador</span>
                                        </div>
                                         <div class="d-flex flex-row align-items-center align-content-start"> 
                                            <input type="radio" class="influencer_type" name="influencer_type" value="champion"><span> Champion</span>
                                        </div>
                                       </div>  



                                            <div class="row">  
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label>Fit India Mobile App Unique ID  * :<span style="color:gray;font-style: italic;"> ( Please login via fit india mobile app to generate fit india unique id )</span></label>
                                                        <input type="text" name="unique_app_id" class="form-control ft_app_id" value="<?=$user_info->id?>">
                                                        {!!$errors->first("unique_app_id","<span class='text-danger'>:message</span>")!!}
                                                        <span id="app_test_result" style="color:red"></span>
                                                        <span id="app_test_score_result" style="color:red"></span>
                                                        <br>
                                                    </div>
                                              </div>
                                              <div class="col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="refer_code">Referral Code : (If you have been referred by someone)</label>
                                                    <input type="text" name="refer_code" id="refer_code" class="form-control" value="{{ old('refer_code') }}">
                                                    {!!$errors->first("refer_code","<span class='text-danger'>:message</span>")!!}
                                                </div>
                                              </div>
                                            </div>
                                            
                                            <fieldset class="scheduler-border">
                                                <legend class="scheduler-border">Basic Details</legend>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                      <div class="form-group">
                                                          <label for="fname">Name : </label>
                                                      <input type="text" name="name" id="amb_name" class="form-control" value="{{ $user_info->name}}" readonly>
                                                      </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                      <div class="form-group">
                                                        <label for="Email">Email ID : </label>
                                                        <input type="email" name="email" id="email" class="form-control" value="{{ $user_info->email}}" readonly>
                                                       </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                      <div class="form-group">
                                                        <label for="contact">Contact Number : </label>
                                                        <input type="number" name="contact" class="form-control" id="contact" value="{{$user_info->phone}}" maxlength="10" readonly>
                                                      </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                      <div class="form-group">
                                                        <label for="designaton">Designation/Occupation : </label>
                                                        <input type="text" name="designation" class="form-control" id="designation" value="{{ old('designation') }}" >
                                                        {!!$errors->first("designation","<span class='text-danger'>:message</span>")!!}
                                                      </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                      <div class="form-group">
                                                        <label for="Select State">State : </label>
                                                        <select name="state_name" id="state" class="form-control" readonly>
                                                            <option value="{{$user_info->state}}">{{$user_info->state}}</option> 
                                                        </select>
                                                      </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                      <div class="form-group">
                                                        <label for="District">District : </label>
                                                        <select name="district_name" id="district" class="form-control" readonly>
                                                         <option value="{{ $user_info->district}}">{{ $user_info->district}} </option>
                                                       </select>
                                                      </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                      <div class="form-group">
                                                        <label for="Block">Block : </label>
                                                        <select name="block_name" id="block" class="form-control" readonly>
                                                          <option value="{{ $user_info->block}}">{{ $user_info->block }}</option>
                                                        </select>
                                                      </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12">
                                                      <div class="form-group">
                                                        <label for="file">Upload Your Photo * : <span style="color:gray; font-style: italic;"> (Kindly upload a formal photo, This photo will be displayed against your profile on Fit India Website if approved)</span></label>
                                                        <input type="file" name="image" id="image" class="form-control">
                                                        {!!$errors->first("image","<span class='text-danger'>:message</span>")!!}
                                                      </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="scheduler-border">
                                                <legend class="scheduler-border">Social Media Information</legend>
                                                <div class="row">
                                                    
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="facebook_profile">Facebook Profile (URL)</label>
                                                            <input type="text" name="facebook_profile" id="facebook_profile" value="{{ old('facebook_profile') }}" class="form-control send">
                                                            {!!$errors->first("facebook_profile","<span class='text-danger'>:message</span>")!!}
                                                        </div>
                                                        <p class="facebook_detail" style="display:block; color:gray">
                                                            # Profile should be unlocked.<br>
                                                            # Friends, likes and followers should be visible.<br>
                                                            # Posts/ Contents should be visible.
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="facebook_profile_followers">Facebook Profile Followers</label>
                                                            <input type="text" name="facebook_profile_followers" value="{{ old('facebook_profile_followers') }}" id="facebook_profile_followers"  class="form-control follwers">
                                                            {!!$errors->first("facebook_profile_followers","<span class='text-danger'>:message</span>")!!}
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="twitter_profile">Twitter Profile (URL)</label>
                                                            <input type="text" name="twitter_profile" id="twitter_profile" value="{{ old('twitter_profile') }}" class="form-control send">
                                                            {!!$errors->first("twitter_profile","<span class='text-danger'>:message</span>")!!}
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">  
                                                        <div class="form-group">
                                                            <label for="twitter_profile_followers">Twitter Profile Followers</label>
                                                            <input type="text" name="twitter_profile_followers" id="twitter_profile_followers" value="{{ old('twitter_profile_followers') }}" class="form-control follwers">
                                                            {!!$errors->first("twitter_profile_followers","<span class='text-danger'>:message</span>")!!}
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="instagram_profile">Instagram Profile (URL)</label>
                                                            <input type="text" name="instagram_profile" id="instagram_profile" value="{{ old('instagram_profile') }}" class="form-control send">
                                                            {!!$errors->first("instagram_profile","<span class='text-danger'>:message</span>")!!}
                                                        </div>
                                                        <p class="insta_detail" style="display:block; color:gray"># Profile should be public</p>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="instagram_profile">Instagram Profile Followers</label>
                                                            <input type="text" name="instagram_profile_followers" id="instagram_profile_followers" value="{{ old('instagram_profile_followers') }}" class="form-control follwers">
                                                            {!!$errors->first("instagram_profile_followers","<span class='text-danger'>:message</span>")!!}
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12">
                                                        <span style="color:red; font-size: 20px;" id="star_position"></span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="scheduler-border" id="event_details" style="display: none;">
                                                <legend class="scheduler-border">Event Details</legend>
                                                <div class="row">
                                                  <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                      <span>  The individual should have organised at least 3 fitness events in the last 3 years (from Jan 2018 till date of application)
                                                       </span>
                                                    </div>
                                                  </div> 

                                                  <?php 
                                                      for($i=0; $i<3; $i++){
                                                    ?>
                                                      <div class="col-sm-12"><strong><span> Event- <?php echo $i+1; ?> :</span></strong></div>
                                                      <div class="col-sm-12 col-md-6">
                                                        <div class="form-group"> 
                                                         Year of the event
                                                        <select class="form-control year_value" name="eventyear[<?=$i?>]">
                                                        <option value="">Select Year</option>
                                                        <?php 
                                                        $year = date('Y');
                                                        for($j=2018;$j<=$year;$j++)
                                                        { ?>
                                                        <option value="{{$j}}">{{$j}}</option>
                                                        <?php }
                                                        ?> 
                                                        </select>
                                                      </div>
                                                      </div>
                                                      <div class="col-sm-12 col-md-6">
                                                        <div class="form-group"> 
                                                         Name of the event
                                                         <input type="text" name="eventname[<?=$i?>]" class="form-control" value="@if(!empty(old('eventname')[$i])) {{ old('eventname')[$i] }} @endif" required />
                                                          @error("eventname.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
                                                        </div>
                                                      </div>
                                                      <div class="col-sm-12 col-md-6">
                                                        <div class="form-group"> 
                                                         Number of the partcipants
                                                          <input type="text" name="noofparticipant[<?=$i?>]" class="form-control" value="@if(!empty(old('noofparticipant')[$i])) {{ old('noofparticipant')[$i] }} @endif" />
                                                          @error("noofparticipant.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
                                                        </div>
                                                      </div>
                                                       <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                          Attach photo
                                                          <input type="file" name="eventphoto[<?=$i?>]" class="form-control">
                                                          @error("eventphoto.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
                                                        </div>
                                                      </div>
                                                      <?php } ?>
                                                  </div>
                                            </fieldset>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                  <div class="form-group">
                                                    <label for="Work Profession">Work Profession</label>
                                                    <textarea name="work_profession" id="work_profession" class="form-control" rows="4" cols="50">{{ old('work_profession') }}</textarea>
                                                    {!!$errors->first("work_profession","<span class='text-danger'>:message</span>")!!}
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-6">
                                                  <div class="form-group">
                                                  <label for="description">Why do you want to become a Fit India <span id="prerak_text">Prerak</span></label>
                                                  <textarea name="description" id="description" class="form-control" rows="4" cols="50">{{ old('description') }}</textarea>
                                                  {!!$errors->first("description","<span class='text-danger'>:message</span>")!!}
                                                  </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <strong>The Individual should be at least 18 years of age</strong> 
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12 age_field" style="display:block">
                                                    <div class="form-group">
                                                        <label for="file">Upload your age id proof</label>
                                                        <input type="file" name="id_proof" id="id_proof" class="form-control">
                                                        {!!$errors->first("id_proof","<span class='text-danger'>:message</span>")!!}
                                                    </div>
                                                </div>
                                            </div>
                                            <fieldset class="scheduler-border social_media_specialist" >
                                                <legend class="scheduler-border">Declaration </legend>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 form-check">
                                                        <div class="form-group ">
                                                        <label class="form-check-label chec_Flex">
                                                            <input type="checkbox"   name="fitness_event" value="1" id="fitness_event"> <span>Organizing or participating on-ground/virtual fitness events wherever possible.</span>
                                                           
                                                        </label>
                                                       
                                                            <span style="color:red;" class="fitness_event_error"></span>
                                                            {!!$errors->first("physical_activity","<span class='text-danger'>:message</span>")!!}
                                                        </div>
                                                   
                                                        <div class="form-group">
                                                        <label class="form-check-label chec_Flex">
                                                            <input type="checkbox" name="social_media_handle" id="social_media_handle" vlaue="1"> 
                                                            <span> Tagging Fit India's Official social media handles in fitness related content created by the individual.<span>
                                                        </label>
                                                           
                                                            <span style="color:red;" class="social_media_handle_error"></span>
                                                            {!!$errors->first("social_media_handle","<span class='text-danger'>:message</span>")!!}
                                                        </div>
                                                 
                                                        <div class="form-group ">
                                                        <label class="form-check-label chec_Flex">
                                                            <input type="checkbox" name="photo_of_event" value="1" id="photo_of_event">
                                                            <span>Uploading the photos of the events organised or participated by the individual by tagging @FitlndiaOff and other hashtags as decided by Fit India Mission.</span>
                                                        </label>
                                                           
                                                            <span style="color:red;" class="photo_of_evente_error"></span>
                                                            {!!$errors->first("photo_of_event","<span class='text-danger'>:message</span>")!!}
                                                        </div>
                                                   
                                                        <div class="form-group ">
                                                        <label class="form-check-label chec_Flex">
                                                           <input type="checkbox" name="retweet" value="1" id="retweet">
                                                           <span>Reposting/Retweeting the photos/videos of Fit India events and tag @FitlndiaOff and other hashtags as decided by Fit India Mission.</span>
                                                        </label>
                                                         
                                                            <span style="color:red;" class="retweet_error"></span>
                                                            {!!$errors->first("retweet","<span class='text-danger'>:message</span>")!!}
                                                        </div>
                                                    </div> 
                                                </div>
                                            </fieldset>

                                            <fieldset class="scheduler-border event_specialist" style="display:none;" >
                                                <legend class="scheduler-border">Declaration </legend>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 ">

                                                       <div class="form-group">
                                                           <label class="form-check-label">
                                                              <input type="checkbox"  class="input_size" name="fit_fitness_event" value="1" id="fit_fitness_event">
                                                              <span>Organizing on-ground/virtual fitness events every quarter with at least 50 participants.</span>
                                                            </label>
                                                           
                                                            <span style="color:red;" class="fit_fitness_event_error"></span>
                                                            {!!$errors->first("physical_activity","<span class='text-danger'>:message</span>")!!}
                                                        </div>
                                                      
                                                         <div class="form-group">
                                                        <label class="form-check-label">
                                                            <input type="checkbox"  class="input_size"  name="fit_media_handle" id="fit_media_handle" vlaue="1">
                                                            <span>Tagging Fit India's Official social media handles in fitness related content created by the individual.</span>
                                                            </label>
                                                           
                                                             <span style="color:red;" class="fit_media_handle_error"></span>
                                                            {!!$errors->first("social_media_handle","<span class='text-danger'>:message</span>")!!}
                                                        </div>
                                                       
                                                       <div class="form-group">
                                                            <label class="form-check-label">
                                                            <input type="checkbox"  class="input_size"  name="fit_photo_of_event" value="1" id="fitness_event">
                                                            <span>Uploading the photos of the events organized by the individual by tagging @FitIndiaOff and other hashtags as decided by Fit India Mission.</span>
                                                            </label>
                                                              <span style="color:red;" class="fit_photo_of_event_error"></span> 
                                                            {!!$errors->first("fitness_event","<span class='text-danger'>:message</span>")!!}
                                                        </div>
                                                       
                                                        <div class="form-group">
                                                            <label class="form-check-label">
                                                            <input type="checkbox"  class="input_size"  name="fit_retweet" value="1" id="fit_retweet">
                                                            <span> Reposting/Retweeting the photos/videos of Fit India events and tag @FitlndiaOff and other hashtags as decided by Fit India Mission.</span>
                                                            </label> 
                                                            <span style="color:red;" class="fit_retweet_error"></span> 
                                                            {!!$errors->first("fitness_event","<span class='text-danger'>:message</span>")!!}
                                                        </div>
                                                    </div> 
                                                </div>
                                            </fieldset>

                                            <div class="row">
                                                <div class="col-sm-12 col-md-12">                                                    
                                                    <div class="form-group">
                                                    <br><br>
                                                        <a style="color:black!important" class="champ_btn" href="{{ asset('wp-content/uploads/2021/01/Guidelines-for-Fit-India-Ambassador.pdf') }}" target="_blank">Guidelines of Fit India Influencer</a>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 form-check">
                                                  <br>
                                                    <div class="form-group">  
                                                        <label class="form-check-label chec_Flex">
                                                        <input type="checkbox" class="input_size" name="declaration" value="1" id="declaration" required>
                                                        <span>I hereby declare that the above mentioned information is authentic to the best of my knowledge.
                                                        Also, I will abide by all the guidelines and deliverables mentioned in the terms and conditions form. </span>
                                                        </label>

                                                        {!!$errors->first("declaration","<span class='text-danger'>:message</span>")!!}
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                    <br>
                                                        <div class="see_area ">
                                                            <input type="submit" name="ambassador-create" value="Submit" class=" shadow_O sys"  >
                                                        </div>
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
            <br><br><br><br>
        </div>


<script src='https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js'></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  $('#state').change(function(){
  state_id = $('#state').val();
    $.ajax({
        url: "{{ route('champdistrict') }}",
        type: "post",
        data: { "id":state_id,"_token": "{{ csrf_token() }}"} ,
        success: function (response) {
           console.log(response);
           $('#district').html(response);
        },
    });
  });

  $('#district').change(function(){
    dist_id = $('#district').val();
    $.ajax({
        url: "{{ route('champblock') }}",
        type: "post",
        data: { "id":dist_id,"_token": "{{ csrf_token() }}"} ,
        success: function (response) {
           console.log(response);
           $('#block').html(response);
        },
        
    });
  });
})
</script>


<script>
var unique_app_response='';
function testss(x){
    unique_app_response = x;
    return unique_app_response;
}
$(function() {
    jQuery.validator.addMethod("check_unique_appid", function(value) {
    var ft_app_ids = $("[name='unique_app_id']").val() ? $("[name='unique_app_id']").val() : 0;
    //console.log("------"+ft_app_ids);
   // var ft_app_ids = $("[name='unique_app_id']").val();
    //var ft_app_ids = "<?php echo $user_info->id; ?>";
   // var ft_app_ids = '1068';
  //  var datas = '[{"fitindiaid": '+ft_app_ids+'}]'; 
 var datas = "[{'fitindiaid': '"+ft_app_ids+"'}]";
    $.ajax({
        type: 'POST',  
        //url:"{{ route('prerak_ft_test') }}",
        url:"http://103.65.20.170/prerak_ft_test",
        async: false,
       
        data: {"apitoken":"A2P0R1","data":datas,"_token": "{{ csrf_token() }}"}, 
        success: function (data) {   
            var test_obj = JSON.parse(data);
            console.log("=>new="+test_obj.Result);
            if(test_obj.Result=='-1'){ console.log(" -1"+test_obj.Result);
                $('#app_test_result').remove();
                testss('Please take fitness assesment test on fitindia mobile app'); 
                return false;
            }
            else if(test_obj.Result=='1'){ console.log(" 1="+test_obj.Result); 
                $('#app_test_result').remove();
                testss('Please take fitness assesment test on fitindia mobile app 2');
                return false;
            }
            else{
                $('#app_test_result').remove();
                $('#unique_app_id-error').remove();
                $('#app_test_score_result').html("Score:- "+test_obj.Result);
                $('.ft_app_id ').rules( 'remove' );
                return true;
            }
        } 
    });
    //return unique_app_response;
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
    
    $("form[name='prerakform']").validate({
        rules: {
            influencer_type:{
                required:true
            },
            name:{
                required:true,
                lettersonly:true
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
            designation: "required",
            //social_media_url: { required:true, url: true },
            image: {
                required: true,
                extension: "gif|png|jpg|jpeg", // work with additional-mothods.js
                filesize: 1048576, 
            },
            facebook_profile: {
                require_from_group: [1, ".send"]
            },
            twitter_profile: {
                require_from_group: [1, ".send"]
            },
            instagram_profile: {
                require_from_group: [1, ".send"]
            },
            facebook_profile_followers: {
                digits: true,
                require_from_group: [1, ".follwers"]
            },
            twitter_profile_followers: {
                digits: true,
                require_from_group: [1, ".follwers"]
            },
            instagram_profile_followers: {
                digits: true,
                require_from_group: [1, ".follwers"]
            },
            work_profession: { required:true, lettersonly: true },
            "description": { required:true, lettersonly: true },
            id_proof: {
                required: true,
                extension: "gif|png|jpg|jpeg|docx|rtf|doc|pdf|pptx", // work with additional-mothods.js
                filesize: 1048576, 
            },
            //unique_app_id: { required:true, digits: true, check_unique_appid:true },
            declaration: { required: true, minlength: 1 },
        },
        messages: {
            amb_name:{
                required:"Please enter your name",
                lettersonly:"Please enter character only"
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
            designation: "Please enter your designation",
           // social_media_url: {required: "Please enter at least one social media url profile url", url:"Please enter valid url" },
          //"social_media_handle": "Please select the checkbox",
            image: {
                required:"This field is requried",
                extension:"File extension must be gif,png,jpg,jpeg",
                filesize:"File size must be less than 1 mb."
            },
            work_profession: { required:"Please enter your work profession", lettersonly: "Only Alphabetic character allow" }, 
            description: { required:"Please fill the description", lettersonly: "Only Alphabetic character allow" },
            id_proof: {
                required:"ID Proof field is required",
                filesize:"File size must be less than 1 mb."
            },
            "declaration": "Please select the checkbox",
        },
        submitHandler: function(form) { 
            var facebook_follwer = parseInt($('#facebook_profile_followers').val() ? $('#facebook_profile_followers').val() : 0 );
            var twitter_follwer = parseInt($('#twitter_profile_followers').val() ? $('#twitter_profile_followers').val() : 0);
            var insta_follwer = parseInt($('#instagram_profile_followers').val() ? $('#instagram_profile_followers').val() : 0);
            var sum_followers = facebook_follwer+twitter_follwer+insta_follwer;
            var refercode = $('#refer_code').val();
            var inftype = $('input[name="action_name"]:checked').val();
            if(refercode!=''){
                $.ajax({
                    url:"{{ route('check-refer-code') }}",
                    type:'POST',
                    data:{'inftype':inftype,'refer_code':refercode,'sum_followers':sum_followers,'_token': "{{ csrf_token() }}"},
                    success:function(data){ 
                        var obj = JSON.parse(data);
                        if(obj.status=='1'){ 
                            if($('input[name="action_name"]:checked').val()=='Fitness_Event'){
                                if(!$('input[name^=fit_fitness_event]:checked').length || !$('input[name^=fit_media_handle]:checked').length || !$('input[name^=fit_photo_of_event]:checked').length || !$('input[name^=fit_retweet]:checked').length){
                                    $('input[name^=fit_retweet]')[0].focus();
                                    $('.fit_retweet_error').text('These all fields of declaration are required');
                                    return false;  
                                }else{
                                     $('.fit_retweet_error').text('');
                                }
                                $('[name^="eventyear"]').each(function() {
                                $(this).rules('add', {
                                    required: true,
                                    messages: {
                                        required: "Enter Event Year"
                                    }
                                 })
                                })
                                
                                $('[name^="eventname"]').each(function() {
                                    $(this).rules('add', {
                                        required: true,
                                        messages: {
                                            required: "Enter Event name"
                                        }
                                    })
                                })

                                if($('.influencer_type').is(':checked')){   
                                    $('[name^="noofparticipant"]').each(function() {
                                        $(this).rules('add', {
                                            required: true,
                                            digits: true,
                                            range: changableRange, 
                                            messages: {
                                                required: "Enter Participate Number",
                                                digits: "Only Numbers allow"

                                            }
                                        })
                                    })
                                }
                                $('[name^="eventphoto"]').each(function() {
                                    $(this).rules('add', {
                                        required: true,
                                        messages: {
                                            required: "This field is required"
                                        }
                                    })
                                })
                                if($(form).valid()) {
                                    form.submit(); 
                                }
                            }else{ 
                                var checkValue1 = $('input[name=influencer_type]:checked').val();
                                console.log("test with refferes"+checkValue1);
                                if(!$('input[name^=fitness_event]:checked').length || !$('input[name^=social_media_handle]:checked').length || !$('input[name^=photo_of_event]:checked').length || !$('input[name^=retweet]:checked').length) {
                                    $('input[name^=retweet]')[0].focus();
                                    $('.retweet_error').text('These all fields of declaration are required');
                                    return false;
                                }else{
                                    $('.retweet_error').text('');
                                }
                                if(checkValue1=="prerak"){
                                    if(sum_followers > 999 && sum_followers < 10000){ 
                                        form.submit();
                                    }else{
                                        alert('For become a prerak your sum of followers should be between 1000 and 10,000');
                                    }
                                }else if(checkValue1=="ambassador"){
                                    if(sum_followers > 9999 && sum_followers < 100000){  
                                        form.submit();
                                    }else{
                                        alert('For become a ambassador your sum of followers should be between 10,000 and 1,00000');
                                    }
                                }else if(checkValue1=="champion"){ 
                                    if(sum_followers > 99999){  
                                        form.submit();
                                    }else{
                                        alert('For become a champion your sum of followers should be greater than 1,00000');
                                    }
                                }
                            }
                        }else{
                            alert("Refer code does not exists, You can leave it blank or fill correct refer code");
                        }
                    }
                });
            }else{ 
                if($('input[name="action_name"]:checked').val()=='Fitness_Event'){
                    if(!$('input[name^=fit_fitness_event]:checked').length || !$('input[name^=fit_media_handle]:checked').length || !$('input[name^=fit_photo_of_event]:checked').length || !$('input[name^=fit_retweet]:checked').length){
                        $('input[name^=fit_retweet]')[0].focus();
                        $('.fit_retweet_error').text('These all fields of declaration are required');
                        return false;  
                    }else{
                         $('.fit_retweet_error').text('');
                    }

                    $('[name^="eventyear"]').each(function() {
                    $(this).rules('add', {
                        required: true,
                        messages: {
                            required: "Enter Event Year"
                        }
                    })
                    })
                    $('[name^="eventname"]').each(function() {
                        $(this).rules('add', {
                            required: true,
                            messages: {
                                required: "Enter Event name"
                            }
                        })
                    })

                    if($('.influencer_type').is(':checked')){   
                            $('[name^="noofparticipant"]').each(function() {
                                $(this).rules('add', {
                                    required: true,
                                    digits: true,
                                    range: changableRange, 
                                    messages: {
                                        required: "Enter Participate Number",
                                        digits: "Only Numbers allow"

                                    }
                                })
                            })
                    }

                    
                    $('[name^="eventphoto"]').each(function() {
                        $(this).rules('add', {
                            required: true,
                            messages: {
                                required: "This field is required"
                            }
                        })
                    })
                    if($(form).valid()) {
                        form.submit(); 
                    }
                }else{ 
                    if(!$('input[name^=fitness_event]:checked').length || !$('input[name^=social_media_handle]:checked').length || !$('input[name^=photo_of_event]:checked').length || !$('input[name^=retweet]:checked').length) {
                        $('input[name^=retweet]')[0].focus();
                        $('.retweet_error').text('These all fields of declaration are required');
                        return false;
                    }else{
                        $('.retweet_error').text('');
                        var checkValue2 = $('input[name=influencer_type]:checked').val();
                        if(checkValue2=="prerak"){
                            if(sum_followers > 999 && sum_followers < 10000){  
                                form.submit();
                            }else{
                                alert('For become a prerak your sum of followers should be between 1000 and 10,000');
                            }
                        }else if(checkValue2=="ambassador"){
                            if(sum_followers > 9999 && sum_followers < 100000){  
                                form.submit();
                            }else{
                                alert('For become a ambassador your sum of followers should be between 10,000 and 1,00000');
                            }
                        }else if(checkValue2=="champion"){
                            if(sum_followers > 99999){  
                                form.submit();
                            }else{
                                alert('For become a champion your sum of followers should be greater than 1,00000');
                            }
                        }
                    }
                }
            }
        }
    });
    /*jQuery.extend(jQuery.validator.messages, {
                require_from_group: jQuery.validator.format("Please enter one of  social media information from three social media information")
    });*/
}); 
$(document).ready(function(){
  $('#fitness_test').change(function(){
    if($(this).is(":checked"))   
            $(".ft_app_id").show();
        else
            $(".ft_app_id").hide();
  });
  $('#age_box').change(function(){ 
       if($(this).is(":checked"))   
            $(".age_field").show();
        else
            $(".age_field").hide();
  });
});
</script>
<script>
  $(document).ready(function(){
    var ft_app_ids = $("[name='unique_app_id']").val() ? $("[name='unique_app_id']").val() : 0;
  //  console.log("------"+ft_app_ids);
    //var ft_app_ids = "<?php echo $user_info->id; ?>";
   // var ft_app_ids = '1068';
     //var datas = '[{\"fitindiaid\": \"'+ft_app_ids+'\"}]';
     var datas = "[{'fitindiaid': '"+ft_app_ids+"'}]";
      $.ajax({
        type: 'POST',  
        url:"{{ route('prerak_ft_test') }}",

        //url:"http://103.65.20.170/fitind/prerak_ft_test",
      // crossDomain: true,
        data: {"apitoken":"A2P0R1","data":datas,"_token": "{{ csrf_token() }}"}, 
        success: function (data, textStatus, xhr) {  
            var test_obj = JSON.parse(data);
            console.log(test_obj);
            if(test_obj.Result=='-1'){
                $('#submit_prerak').attr('disabled', 'disabled');
                $('#app_test_result').html('Please take fitness assesment test on fitindia mobile app');
            }
            else if(test_obj.Result=='1'){
                $('#submit_prerak').attr('disabled', 'disabled');
                $('#app_test_result').html('Please take fitness assesment test on fitindia mobile app');
            }
            else{
              $('#app_test_score_result').html("Score:- "+test_obj.Result);
              $('#submit_prerak').removeAttr("disabled");
             
                
            }
        },  
        error: function (xhr, textStatus, errorThrown) {  
            console.log('Error in Operation '+textStatus);  
        }  
      });
  });
</script>
<script>
$(document).ready(function(){
    $(".exp_action").on('change',function() { 
        var checkValue = $('input[name=action_name]:checked').val();
        if(checkValue=="Social_Media"){
            $('#event_details').hide();
            $('.social_media_specialist').show();
            $('.event_specialist').hide();
        }else{ 
            $('.social_media_specialist').hide();
            $('.event_specialist').show();
            $('#event_details').show();
        }
    }); 
    /*$('.follwers1111').keyup(function(){
        var facebook_follwer = parseInt($('#facebook_profile_followers').val() ? $('#facebook_profile_followers').val() : 0 );
        var twitter_follwer = parseInt($('#twitter_profile_followers').val() ? $('#twitter_profile_followers').val() : 0);
        var insta_follwer = parseInt($('#instagram_profile_followers').val() ? $('#instagram_profile_followers').val() : 0);
        var sum_followers = facebook_follwer+twitter_follwer+insta_follwer;
        console.log("fb=>"+facebook_follwer+", tw=>"+twitter_follwer+", insta=>"+insta_follwer+", sum=>"+sum_followers);
        if(sum_followers > 0 && sum_followers < 999 ){
            //$('#event_details').show();
            //$('.event_specialist').show();
            //$('.social_media_specialist').hide();
            $('#star_position').html("You are eligible to apply for Fit India Prerak (Fitness Event Specialist)");
            $('#prerak_text').text('Prerak');
        }else if(sum_followers > 999 && sum_followers < 9999){
            $('#star_position').html("You are eligible to apply for Fit India Prerak (Social Media Specialist) <br> The total number of followers and the social media urls will be verified");
            //$('#event_details').hide();  
            // $('.event_specialist').hide();
            // $('.social_media_specialist').show();
            $('#prerak_text').text('Prerak'); 
        }
        else if(sum_followers > 9999 && sum_followers < 99999){
            $('#star_position').html("You are eligible to apply for Fit India Ambassador <br> The total number of followers and the social media urls will be verified");
            // $('#event_details').hide();  
            // $('.event_specialist').hide();
            // $('.social_media_specialist').show(); 
            $('#prerak_text').text('Ambassador');
        }
        else{
            $('#star_position').html("You are eligible to apply for Fit India Champion <br> The total number of followers and the social media urls will be verified");
            //$('#event_details').hide();
            // $('.event_specialist').hide();
            // $('.social_media_specialist').show();
            $('#prerak_text').text('Champion');
        }
    });*/
       
    const $selects = $(".year_value");
    $selects.on('change', function(evt) {
        const selectedValue = [];
        $selects.find(':selected').filter(function(idx, el) {
            return $(el).attr('value');
        }).each(function(idx, el) {
            selectedValue.push($(el).attr('value'));
        });
        $selects.find('option').each(function(idx, option) { 
            if (selectedValue.indexOf($(option).attr('value')) > -1) {
                if ($(option).is(':checked')) {
                    return;
                } else {
                    $(this).attr('disabled', true);
                }
            } else {
                $(this).attr('disabled', false);
            }
        });
    });
});
function changableRange() {
    var checkValue3 = $('input[name=influencer_type]:checked').val();
    if(checkValue3=='prerak'){
        return  [50, 499];
    }else if(checkValue3=='ambassador'){
        return [500, 1499];
    }else{
        return [1500, 10000];
    }
}
</script>
<style>
  .error{color:red;}
</style>                  
@endsection