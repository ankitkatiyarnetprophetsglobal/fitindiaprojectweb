@extends('layouts.app')
@section('title', 'Freedom Run | Fit-India ')
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
    </style>
  <section>
    <div class="container">
      @if(session('success'))
      <div class="alert alert-success"><center><i class="fa fa-check-circle" aria-hidden="true"></i> {{session('success')}}</center></div>
      @endif    
      @if(session('failed'))
      <div class="alert alert-danger"><center><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{session('failed')}}</center></div>
      @endif 
      <div class="row ambass_area">
          <h2>Fitindia Freedom Run (Individual)</h2>      
          <form name="freedum_run_form" method="post" action="{{route('freedom-update-value')}}" enctype="multipart/form-data" style="width: 100%;">
            @csrf
            <input type="hidden" name="id" value="{{$events->id}}">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Basic Details</legend>
                      <div class="row">
                          <div class="col-sm-12 col-md-6">
                              <div class="form-group">
                                  <label for="name">Organization / Institution / Group / School Name  *</label>
                                  <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{$events->name}}" readonly>
                                  {!!$errors->first("name","<span class='text-danger'>:message</span>")!!}
                              </div>
                          </div>
                          <div class="col-sm-12 col-md-6">
                              <div class="form-group">
                                  <label for="Email">Email ID *</label>
                                  <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{$events->email}}" readonly>
                                  {!!$errors->first("email","<span class='text-danger'>:message</span>")!!}
                              </div>
                          </div>
                          <div class="col-sm-12 col-md-6">
                              <div class="form-group">
                                  <label for="contact">Contact Number *</label>
                                  <input type="number" name="contact" class="form-control" id="contact" placeholder="Contact" value="{{$events->phone}}" maxlength="10" readonly>
                                  {!!$errors->first("contact","<span class='text-danger'>:message</span>")!!}
                              </div>
                          </div>
                      </div>
                  </fieldset>
                  <div class="row">
                     
                      
                      <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                            <label for="from_date">From Date*</label>
                            <input type="date" name="from_date" class="form-control" id="from_date" value="{{ $events->eventstartdate }}" maxlength="10">
                            {!!$errors->first("from_date","<span class='text-danger'>:message</span>")!!}
                          </div>
                      </div>

                      <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                            <label for="to_date">To Date*</label>
                            <input type="date" name="to_date" class="form-control" id="to_date" value="{{ $events->eventenddate }}" maxlength="10">
                            {!!$errors->first("to_date","<span class='text-danger'>:message</span>")!!}
                          </div>
                      </div>

                      <div class="col-sm-12 col-md-12">
                          <div class="form-group">
                            <label for="km">K.M. Covered*</label>
                             <input type="number" name="km" class="form-control" id="km" placeholder="Kilometer" value="{{ $events->kmrun }}" maxlength="10">
                            <!-- <select>
                            <?php 
                            /*for($i=1;$i<50000;$i++){
                              echo "<option>".$i."</option>";
                            }*/
                            ?>

                          </select> -->

                            {!!$errors->first("km","<span class='text-danger'>:message</span>")!!}
                          </div>
                      </div>

                  </div>
                   <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Event Image Details</legend>
                      <div class="row">
                          <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                              <label for="">Upload Event Photo  </label>
                              <input type="file" name="image1" id="image1" class="form-control">
                              {!!$errors->first("image","<span class='text-danger'>:message</span>")!!}
                            </div>
                            <input type="hidden" name="old_image1" value="{{ $events->eventimage1 }}">
                            <img height="100" width="100" src="{{ $events->eventimage1 }}"/>

                          </div>

                         
                      </div>
                    </fieldset>

                  <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                    <br>
                    <div class="see_area ">
                      <input type="submit" name="ambassador-create" value="Update Event" class="seemore shadow_O sys" href="javascript:void(0);" data-toggle="modal" data-target="#actforyou">
                    </div>
                    </div>
                  </div>
              </div>
            </div>
          </form>
      </div>
    </div>
  </section>
<script src="{{ asset('resources/js/newjs/jquery.validate.min.js')}}"></script>
<script src="{{ asset('resources/js/newjs/additional-methods.js')}}"></script>
<!--<script type="text/javascript">
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
</script>  -->
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
        number_of_partcipant:{
           required:true
        },
        from_date:{
           required:true
        },
        to_date:{
           required:true
        },
        km:{
           required:true
        },
       /* designation: "required",
        state_name: "required",
        district_name: "required",
        block_name: "required",
      pincode: { required:true, digits: true, minlength:6, maxlength:6 }, */
      /*image1: {
        required: true,
        extension: "gif|png|jpg|jpeg", // work with additional-mothods.js
                filesize: 1048576, 
      },
      image2: {
        required: true,
        extension: "gif|png|jpg|jpeg", // work with additional-mothods.js
                filesize: 1048576, 
      },*/
 /*     facebook_profile: { required:true, url: true },
            facebook_profile_followers: { required:true, digits: true, maxlength:7 },

            twitter_profile: { required:true, url: true },
            twitter_profile_followers: { required:true, digits: true, maxlength:7 },

            instagram_profile: { required:true, url: true },
            instagram_profile_followers: { required:true, digits: true, maxlength:7 },*/
            
      /*work_profession: { required:true, lettersonly: true },
            description: { required:true, lettersonly: true },
      "declaration": {
            required: true,
            minlength: 1
          }*/
        
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
        /*designation: "Please enter your designation",
        state: "Please select your state",
        district: "Please select your state",
        block: "Please select your block",
        pincode: { 
          required:"Please enter pincode",
                digits: "Only digits allow", 
          minlength:"Only 6 digit allowed", 
          maxlength:"Only 6 digit allowed" 
        },*/
        image: {
          filesize:"File size must be less than 1 mb."
        },

     /*   facebook_profile: {required: "Please enter your facebook profile url", url:"Please enter valid url" },
        facebook_profile_followers: {required: "Please enter your facebook followers count", digits:"Allow digit only", maxlength:"digit length should be less than 7 or equal to 7 digit" },
        twitter_profile: {required: "Please enter your twitter profile url", url:"Please enter valid url" },
        twitter_profile_followers: {required: "Please enter your twitter followers count", digits:"Allow digit only", maxlength:"digit length should be less than 7 or equal to 7 digit" },
        instagram_profile: {required: "Please enter your instagram profile url", url:"Please enter valid url" },
        instagram_profile_followers: {required: "Please enter your instagram followers count", digits:"Allow digit only", maxlength:"digit length should be less than 7 or equal to 7 digit" },
        work_profession: { required:"Please enter your work profession", lettersonly: "Only Alphabetic character allow" }, 
        description: { required:"Please fill the description", lettersonly: "Only Alphabetic character allow" },
        "declaration": "Please select at least one checkbox"*/
    },

    submitHandler: function(form) {
        /*var fb_follower = parseInt($('#facebook_profile_followers').val());
        var twit_follwer = parseInt($('#twitter_profile_followers').val());
        var insta_follwer = parseInt($('#instagram_profile_followers').val());
        var follwer_sum = fb_follower + twit_follwer + insta_follwer; 
        if(follwer_sum > 9999){*/
            form.submit();
        /*}else{
            alert("Your Social media follower's count should be greater than or equal to 10,000");
        }*/
    }
  });
}); 

</script>
<style>
  .error{color:red;}
</style>
@endsection