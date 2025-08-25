@extends('layouts.app')
@section('title', 'Fit-india-freedomrun | Fit India')
@section('content')
@php
$active_section = request()->segment(count(request()->segments()));
$active_section_id = trim($active_section);
@endphp
<style>
    /* .um-field{margin-bottom:15px;} */
    .partner-form input[type=submit] {
    background-color: rgb(233, 30, 99);
    padding: 10px 30px;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    border-radius: 100px;
    border: 0;
    text-transform: uppercase;
    cursor: pointer;
    margin-top: 15px;
    box-shadow: 0 5px 10px rgb(53 53 53 / 30%);
}
.event-row-lt {
    width: 49.8%;
    display: inline-block;
}
.um-field{margin-bottom:15px;}
.m_t{margin-top:5px;}
.m_b{margin-bottom:20px;}
.under_line{width: 12%;
    height: 2px;
    background: #ff5f04;
    margin-bottom: 50px;
    margin: 0 auto;
    margin-bottom: 50px;
    margin-top: -1px;}
    .freenote {
    background: #fcfac6;
    padding: 11px;
    border-radius: 5px;
    border: 1px dotted #b4aeae;
}
    </style>
<div class="shadow"> 
    <img src="resources/imgs/freedom_info_new2.jpg" alt="freedom-run-info" title="freedom-run-info" class="img-fluid expand_img" />
</div>

<section id="{{ $active_section_id }}">
<div class="container">
<h1 class="text-center mb-1" style="    color: #4267b2;">Partner's Event Detail</h1>
<div class="under_line"></div>
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
        <form  name="freedum_run_partners" action="freedomrun-add-partners" enctype="multipart/form-data"  class="partner-form " method="POST">  
            @csrf
            <div class="row">

                <div class="col-sm-12 col-md-6">
                    <div class="um-field">
                        <div class="um-field-label">
                            <label for="eventimage1">Organization / Company Name *</label>
                            <div class="um-clear"></div>
                        </div>
                        <div class="um-field-area">
                            <input type="text" name="org_name" id="org_name" class="form-control" placeholder="Organization / Company Name" value="{{ old('org_name') }}">
                            {!!$errors->first("org_name", "<span class='text-danger'>:message</span>")!!} 
                        </div>
                    </div>
                </div>

                 <div class="col-sm-12 col-md-6">
                    <div class="um-field">
                        <div class="um-field-label">
                            <label for="eventimage1">Event Name (eg. Fit India Freedom Run 2.0 ) *</label>
                            <div class="um-clear"></div>
                        </div>
                        <div class="um-field-area">
                            <input type="text" name="event_name" id="event_name" class="form-control" placeholder="Event Name" value="{{ old('event_name') }}">
                             {!!$errors->first("event_name", "<span class='text-danger'>:message</span>")!!} 
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="um-field">
                        <div class="um-field-label">
                            <label for="eventname">Email ID *</label>
                            <div class="um-clear"></div>
                        </div>
                        <div class="um-field-area">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                             {!!$errors->first("email","<span class='text-danger'>:message</span>")!!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="um-field">
                        <div class="um-field-label">
                            <label for="eventname">Contact Number *</label>
                            <div class="um-clear"></div>
                        </div> 
                        <div class="um-field-area">                 
                            <input type="number" name="contact" class="form-control" id="contact" placeholder="Contact" maxlength="10" value="{{ old('contact') }}">
                            {!!$errors->first("contact","<span class='text-danger'>:message</span>")!!}
                        </div>
                    </div>
                </div>
            
               

               
                                
                                
                <div class="col-sm-6 col-md-6">          
                    <div class="um-field-area um-field">
                        <div class="event-row-it-resp  ">
                            <span id="eventstartdate">From Date</span>
                            <input type="date" name="from_date" class="form-control" id="from_date" maxlength="10" value="{{ old('from_date') }}" min="2021-08-13" max="2021-10-02">
                             {!!$errors->first("from_date", "<span class='text-danger'>:message</span>")!!} 
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class=" event-row-it-resp um-field" id="eventenddatediv">
                        To Date
                        <input type="date" name="to_date" class="form-control" id="to_date" maxlength="10" value="{{ old('to_date') }}" min="2021-08-13" max="2021-10-02">
                        {!!$errors->first("to_date", "<span class='text-danger'>:message</span>")!!}
                    </div>                    
                </div>
                    
          
                 <div class="col-sm-12 col-md-6">
                    <div class="um-field">
                        <div class="um-field-label">
                            <label for="eventimage1">Event (Banner / Logo)  (The image will be used to display your event on Fit India website) *</label>
                            <div class="um-clear"></div>
                        </div>
                        <div class="um-field-area">
                            <input type="file" name="image" id="image" class="form-control">
                             {!!$errors->first("image", "<span class='text-danger'>:message</span>")!!}
                        </div>
                    </div>
                </div>      

                <div class="col-sm-12 col-md-6">
                    <div class="um-field ">
                        <div class="um-field-label ">
                            <label for="kmrun " class="m_b">Your website registration link if any (optional)</label>
                            <div class="um-clear"></div>
                        </div>
                        <div class="um-field-area">
                            <input type="text" name="website_link" class="form-control" id="website_link" placeholder="Website Link" value="{{ old('website_link') }}" >
                             {!!$errors->first("kmrun", "<span class='text-danger'>:message</span>")!!}
                        </div>
                    </div>
                </div>
                                    
                                    
                <div class="um-field">
                    <div class="um-field-area ml-3">
                        <input type="submit" name="create-event" value="Submit"> 
                    </div>
                </div>

                <div class="freenote mt-3 " style='margin-left:15px;;margin-right:15px;'>
                    <p style="padding-left:5px; margin-bottom:5px;  "><b>Note:</b></p>
                    <p style="padding-left:30px;">All partners are requested to register their event on fit India portal with all the the details of participants and kilometres covered so as to download the certificates for both organisation and participants</P>
                </div>
                
            </div>
                        

            </form>

</div>
</section>

<script src="{{ asset('resources/js/newjs/jquery.validate.min.js')}}"></script>
<script src="{{ asset('resources/js/newjs/additional-methods.js')}}"></script>
<script>
$(document).ready(function(){
   // $( "#from_date" ).datepicker({ minDate: -20, maxDate: "+1M +10D" });
    $('#invidual_download').click(function(){
        $('#ind-certificate').toggle();
    });
});
</script>
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

    
    $("form[name='freedum_run_partners']").validate({
      rules: {
        org_name:{
          required:true,
        },
        event_name:{
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
        image: {
            required: true,
            extension: "gif|png|jpg|jpeg|gif", // work with additional-mothods.js
            filesize: 1048576, 
        },
        from_date:{
           required:true
        },
        to_date:{
           required:true
        },
        website_link:{
            url: true
        }
      },
      messages: {
        event_name:{
          required:"Please enter your name",
          lettersonly:"Please enter character only"
        },
        email: {
          required: "Please enter your email",
          validate_email: "Please enter valid email id"
        },
        contact: {
          required: "Please enter contact number",
          minlength: "Contact no. must of 10 digits",
          maxlength: "Contact no. must of 10 digits"
        },
        image: {
          filesize:"File size must be less than 1 mb."
        }
    },

    submitHandler: function(form) {
        form.submit();
    }
  });
}); 

</script>


<script>
  $(function() {
    $("form[name='freedom_indidual_cert']").validate({
      rules: {
        certificate_email: {
            required:true,
            validate_email: true
        }
      },
      messages: {
        email: {
          required: "Please enter your email",
          validate_email: "Please enter valid email id"
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


@endsection