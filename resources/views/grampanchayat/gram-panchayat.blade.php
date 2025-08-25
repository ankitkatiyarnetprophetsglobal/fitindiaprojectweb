@extends('layouts.app')
@section('title', 'Fit India Gram Panchayat Ambassador')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp

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
       input.larger {
        transform: scale(1.5);
        /*margin: 15px;*/
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
                        <div class="">
                            <div class="wrap event-form"> 
<!-- <section> -->
<?php //echo "<pre>"; print_r($blocks);    ?>
  <div class="container mob-p-r">
      @if(session('success'))
          <div class="alert alert-success"><center><i class="fa fa-check-circle" aria-hidden="true"></i> {{session('success')}}</center></div>
      @endif    
      @if(session('failed'))
          <div class="alert alert-danger">
            <center><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{session('failed')}}</center>
          </div>
      @endif 
        <div class="row ambass_area">
          <h2 class="page__title title" id="page-title">Submit your application to become Fit India Gram Panchayat Ambassador</h2>
            <form name="createeventform"  method="post" action="gram_panchayat_store" enctype="multipart/form-data">
              @csrf
               <input type="hidden" name="user_id" value="{{  $user_info->id }}">
                <div class="col-sm-12 col-md-12 mob-p-r">
                  <div class="form-group">
                  <br>
                      <b>The individual should have taken fitness assessment test on Fit India Mobile App.</b>
                      <br><br>
                      <label for="fname">Please share Fit India Mobile App Unique ID</label>
                      <input type="text" name="unique_app_id" class="form-control ft_app_id" value="{{  $user_info->id }}" readonly>
                      {!!$errors->first("unique_app_id","<span class='text-danger'>:message</span>")!!}
                      <span id="app_test_result" style="color:red"></span>
                      <span id="app_test_score_result" style="color:red"></span>              
                  </div>
              </div>

              <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Basic Details</legend>
                  <div class="row" >
                      <div class="col-sm-12 col-md-6">
                                              <div class="form-group">
                                                <label for="fname">Name :</label> 
                                                <input type="text" name="name" class="form-control " value="{{ $user_info->name}}" readonly>
                                  {!!$errors->first("name","<span class='text-danger'>:message</span>")!!}
                              </div>
                                    </div>
                                  <div class="col-sm-12 col-md-6">
                                              <div class="form-group">  
                                  <label for="fname"> Email ID : </label>
                                  <input type="email" name="email" id="email" class="form-control" value="{{ $user_info->email}}" readonly>
                                                    {!!$errors->first("email","<span class='text-danger'>:message</span>")!!}
                              </div>
                                      </div>
                      <div class="col-sm-12 col-md-6">
                                              <div class="form-group">  
                                  <label for="fname"> Contact Number : </label>
                                  <input type="mobile" name="contact" id="contact" class="form-control" value="{{$user_info->phone}}" maxlength="10" readonly>
                                                    {!!$errors->first("contact","<span class='text-danger'>:message</span>")!!}
                                                </div>
                                  </div>

                                  <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="designaton">Designation/Occupation : </label>
                                            <input type="text" name="designation" class="form-control" id="designation">
                                        </div>
                                    </div>
                                    
                                  <div class="col-sm-12 col-md-6">
                                              <div class="form-group">  
                                                    <label for="fname"> Gender :</label>
                                  <select name="gender" id="gender" class="form-control" >
                                    <?php if(!empty($user_info->gender)){ ?>
                                            <option value="<?php echo @$user_info->gender; ?>"><?php echo @$user_info->gender; ?></option>
                                    <?php }else{ ?>
                                       <option value="">Select Gender</option>
                                    <?php } ?>     
                                       
                                       <option value="male" @if (old('gender') == 'male') selected="selected" @endif >Male</option>
                                       <option value="female" @if (old('gender') == 'female') selected="selected" @endif >Female</option>
                                  </select>
                                  {!!$errors->first("gender","<span class='text-danger'>:message</span>")!!}
                                          </div>
                                      </div>
                                  <div class="col-sm-12 col-md-6">
                                              <div class="form-group">  
                                  <label for="fname"> State :</label>
                                    <select name="state" id="state" class="form-control">
                                        <?php if(!empty($get_state_id)){ ?>
                                            <option value="{{ $get_state_id->id}}">{{ $get_state_id->name }}</option>
                                        <?php }else{ ?>
                                             <option value="">Select State</option>
                                        <?php } ?>
                                        <?php if(!empty($states)){
                                        foreach($states as $states_row){ ?>
                                            <option value="{{$states_row->id}}">{{$states_row->name}}</option> 
                                        <?php }
                                        } ?>
                                  </select>
                                  {!!$errors->first("state","<span class='text-danger'>:message</span>")!!}
                                            </div>
                                  </div>
                                  <div class="col-sm-12 col-md-6">
                                              <div class="form-group">  
                                                <label for="fname"> District :</label>
                                  <select name="district" id="district" class="form-control">
                                      <?php if(!empty($get_district_id)){ ?>
                                        <option value="{{ $get_district_id->id}}">{{ $get_district_id->name }}</option>
                                    <?php }else{ ?>
                                      <option value="">Select District</option>
                                      <?php } ?>

                                         <?php if(!empty($district)){
                                        foreach($district as $district_row){ ?>
                                            <option value="{{$district_row->id}}">{{$district_row->name}}</option> 
                                        <?php }
                                       } ?>
                                     

                                  </select>
                                  {!!$errors->first("district","<span class='text-danger'>:message</span>")!!}                      
                              </div>
                                  </div>
                                  <div class="col-sm-12 col-md-6">
                                              <div class="form-group">  
                                              <label for="fname"> Block :</label>
                                              <select name="block" id="block" class="form-control">
                                    <?php if(!empty($get_block_id)){ ?>
                                        <option value="{{ $get_block_id->id}}">{{ $get_block_id->name }}</option>
                                    <?php }else{ ?>
                                      <option value="">Select Block</option>
                                      <?php } ?>
                                      <?php if(!empty($blocks)){
                                        foreach($blocks as $blocks_row){ ?>
                                            <option value="{{$blocks_row->id}}">{{$blocks_row->name}}</option> 
                                        <?php }
                                       } ?>

                                  </select>
                                  {!!$errors->first("block","<span class='text-danger'>:message</span>")!!}
                                            </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                              <div class="form-group">  
                                                <label for="fname">Upload Your Photo : <span style="color:#474298;font-size:11px;"> (Kindly upload a formal photo, This photo will be displayed against your profile on Fit India Website if approved)</span></label>
                                  <input type="file" name="image" id="image" class="form-control" required>
                                  {!!$errors->first("image","<span class='text-danger'>:message</span>")!!}
                                              </div>
                                      </div>
                           </div>
                        </fieldset>
              <hr>  
              <fieldset class="scheduler-border">
                          <legend class="scheduler-border">Letter / Document Details</legend>
                        <div class="row" >
                            <!-- <div class="col-sm-12 col-md-12">
                          <label class="cert-questions"> <b>He/she should be nominated by Sarpanch/Mukhiya/Pradhan of Gram Panchayat as Fit India coordinator 
                                      for organising community fitness events. He/ She should preferably be an elected representative.</b></label>
                        </div> -->
                      <div class="col-sm-12 col-md-12">
                                          <div class="form-group">  
                              <label for="fname"> Please share a letter/Document from Sarpanch/Mukhiya/Pradhan of Gram Panchayat where you have been nominated as fit india coordinator</label>
                              <input type="file" name="document" id="document" class="form-control">
                              {!!$errors->first("document","<span class='text-danger'>:message</span>")!!}
                          </div> 
                                  </div>    
                  </div>
              </fieldset>
                      <hr>
                     <!--  <fieldset class="scheduler-border">
                          <legend class="scheduler-border">Social Media Details</legend>
                    <div class="row">
                              <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                              <label class="cert-questions"><b> The individual should be present on at least one of the social media handles ( Facebook, Instagram or Twitter). </b><br><br>                    
                                              Share Your Social Media Url : (Facebook/Twitter/Instagram)</label>        
                                              <input type="text" name="social_media_url" id="social_media_url" value="{{ old('social_media_url') }}" class="form-control">
                              {!!$errors->first("social_media_url","<span class='text-danger'>:message</span>")!!}
                                        </div>
                                  </div>
                          </div>
                      </fieldset> -->
                                         <fieldset class="scheduler-border">
                                              <legend class="scheduler-border">Social Media Information</legend>
                                              <div class="row">
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label class="cert-questions"><b> The individual should be present on at least one of the social media handles ( Facebook, Instagram or Twitter). </b><br>          
                                                        Share Your Social Media Url : (Facebook/Twitter/Instagram)</label>    
                                                        <!-- <input type="text" name="social_media_url" id="social_media_url" value="{{ old('social_media_url') }}" class="form-control">
                                                        {!!$errors->first("social_media_url","<span class='text-danger'>:message</span>")!!}  -->
                                                    </div>
                                                </div>
                                            </div>
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
                <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                  <label class="cert-questions"> 
                                  <b>He/she should be preferably in the age group 18-50 years.</b></label>  
                                  <br><br>                      
                                  <label for="fname"> Please upload id proof for Age Verification</label>
                                      <input type="file" name="agedocument" class="form-control">
                                        {!!$errors->first("agedocument","<span class='text-danger'>:message</span>")!!}
                                  </div> 
              </div> 
             



                            <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Declaration </legend>
                  <div class="row">
                              <div class="col-sm-12 col-md-12 mob-p-r">
                        
                                          <div class="form-group">  
                                             <label class="form-check-label"> 
                              <input type="checkbox" name="social_media_handle" class="input_size" vlaue="1" required> 
                              <span>The Individual Must be following Fit India Movement’s Social media handles (@FitIndiaOff)  and other hashtags as decided by Fit India Mission. 
                              </span>
                            </label>
                                              {!!$errors->first("social_media_handle","<span class='text-danger'>:message</span>")!!}
                                          </div>
                                   
                          <div class="form-group">
                                    <label class="form-check-label">  
                                <input name="yclubeventcommits" type="checkbox" value="yes"  class="input_size" @error('yclubeventcommits') is-invalid @enderror" @if(!empty(old('yclubeventcommits'))) {{ 'checked' }} @endif onclick="eventcommit(this)" />  
                              
                              <span> The individual should organize Fit India’s on-ground/virtual
                                    events every quarter for at least 50 participants and upload the photos of the same by tagging @FitIndiaOff </span>
                              </label> 
                                                            @error('yclubeventcommits')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                  </div>
                             
                                          <div class="form-group">
                              <label class="form-check-label"> <input type="checkbox" name="physical_fitness" value="1" id="physical_fitness" class="input_size" required><span> Individual should be aware about the importance of physical fitness and 
                                       spend 30-60 minutes daily for at least 5 days every week for physical activities.
                                       Physical activities could be playing any sport, traditional game, walking, cycling, dancing, running, or any other physical activity</span> 
                                          </label>
                                              {!!$errors->first("physical_fitness","<span class='text-danger'>:message</span>")!!} 
                                          </div>
                      </div>            
                              </div>
                        </fieldset>                                             
                      <div class="col-sm-12 col-md-12 mob-p-r">
                  <div class="form-group ">
                      <a style="color:black!important" class="champ_btn" href="{{ asset('wp-content/uploads/doc/Guidlines-Gram Panchayat.pdf') }}" target="_blank">Guidelines of Fit India Gram Panchayat Ambassador</a>
                  </div>
              </div>
              <div class="col-sm-12 col-md-12 mob-p-r mt-4">
                  <div class="form-group">
                      <label class="form-check-label chec_Flex">
                        <input type="checkbox" name="declaration" value="1" id="declaration" class="input_size">
                        <span> I hereby declare that the above mentioned information is authentic to the best of my knowledge.
                        Also, I will abide by all the guidelines and deliverables mentioned in the terms and conditions form.</span> 
                      </label>
                      {!!$errors->first("declaration","<span class='text-danger'>:message</span>")!!}
                  </div>
              </div>
                      <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                      <div class="see_area ">
                      <input type="submit" name="ambassador-create" value="Submit" class="seemore shadow_O sys" href="javascript:void(0);" data-toggle="modal" data-target="#actforyou">
                      </div>
                  </div>
              </div>
          </form>    
      </div>
  </div>
<!-- </section> -->
           </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
        </div>
<script src="{{ asset('resources/js/newjs/jquery.validate.min.js')}}"></script>
<script src="{{ asset('resources/js/newjs/additional-methods.js')}}"></script>

  <script type="text/javascript">
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
</script> 

<script>
     var unique_app_response='';
    function testss(x){
        unique_app_response = x;
        return unique_app_response;

    }
  $(function() {
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
                $('#app_test_score_result').html("Score:- "+test_obj.score);
                $('.ft_app_id ').rules( 'remove' );
                return true;
            }
        } 
    });
    },function() {return unique_app_response; });

    jQuery.validator.addMethod("validate_facebook", function(value, element){
        if(/^(https?:\/\/)?((w{3}\.)?)facebook.com\/.*/i.test(value)){
            return true;
        } else {
            return false;
        }
    }, "Please enter a valid facebook URL.");
    
    
    jQuery.validator.addMethod("validate_twitter", function(value, element){
        if(/^(https?:\/\/)?((w{3}\.)?)twitter\.com\/(#!\/)?[a-z0-9_]+$/i.test(value)){
            return true;
        } else {
            return false;
        }
    }, "Please enter a valid twitter URL.");
    
    jQuery.validator.addMethod("validate_instagram", function(value, element){
        if (/^(https?:\/\/)?((w{3}\.)?)instagram.com\/.*/i.test(url)){
            return true;
        } else {
            return false;
        }
    }, "Please enter a valid instagram URL.");
    
    
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

    
    $("form[name='createeventform']").validate({
            rules: {
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
                designation:{
                   required:true,
                   lettersonly:true 
                },
                gender: "required",
                state: "required",
                district: "required",
                image: {
                    required: true,
                    extension: "gif|png|jpg|jpeg", // work with additional-mothods.js
                    filesize: 1048576 
                },
                document: {
                    required: true,
                    extension: "gif|png|jpg|jpeg|docx|pdf|PPTX|ppt", // work with additional-mothods.js
                    filesize: 1048576, 
                },
                facebook_profile: {
                    url: true,
                    require_from_group: [1, ".send"]
                },
                twitter_profile: {
                    url: true,
                    require_from_group: [1, ".send"]
                },
                instagram_profile: {
                    url: true,
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
                agedocument :{
                    required:true,
                    extension: "gif|png|jpg|jpeg|docx|pdf|PPTX|ppt",
                    filesize: 1048576
                },
                unique_app_id: { required:true, digits: true, check_unique_appid:true },
                "social_media_handle":"required",
                "yclubeventcommits" : "required",
                "physical_fitness":"required",
                "declaration":"required"
            },
            messages: {
                name:{
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
                gender: "Please select your gender",
                state: "Please select your state",
                district: "Please select your district",
                image: {
                    required:"This field is required",
                    extension: "Image format allow only Gif|png|jpg|jpeg",
                    filesize: "File should be less then 1 mb or equal to the 1 mb"
                },
                document: {
                    required:"This field is required",
                    extension: "Format allow only Gif|png|jpg|jpeg|docx|pdf|PPTX",
                    filesize: "File should be less then 1 mb or equal to the 1 mb"
                },
                agedocument :{
                    required:"This field is required",
                    extension: "Format allow only Gif|png|jpg|jpeg|docx|pdf|PPTX",
                    filesize: "File should be less then 1 mb or equal to the 1 mb" 
                },
                                facebook_profile: {
                    required: "Please enter your facebook URL",
                    validate_facebook: "Please enter valid facebook id"                 
                },
                        twitter_profile: {
                    required: "Please enter your twitter URL",
                    validate_twitter: "Please enter valid twitter id"                   
                },  
                        instagram_profile: {
                    required: "Please enter your instagram URL",
                    validate_instagram: "Please enter valid instagram id"                   
                },                  
                "social_media_handle":"This field is required",
                "yclubeventcommits" : "This field is required",
                "physical_fitness":"This field is required",
                "declaration":"This field is required"
            },
            submitHandler: function(form){ 
                form.submit();
            }   
        });
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
    var user_id = $("[name='unique_app_id']").val() ? $("[name='unique_app_id']").val() : 0;
    var user_email = $("[name='email']").val() ? $("[name='email']").val() : '';
    $.ajax({
        type: 'POST',  
        url:"{{ route('prerak_ft_test') }}",
        data: {"user_id":user_id, "user_email":user_email, "_token": "{{ csrf_token() }}"}, 
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
              $('#app_test_score_result').html("Score:- "+test_obj.score);
              $('#submit_prerak').removeAttr("disabled");
            }
        },  
        error: function (xhr, textStatus, errorThrown) {  
            console.log('Error in Operation '+textStatus);  
        }  
      });
  });
</script>
<style>
  .error{color:red;}
</style>
@endsection