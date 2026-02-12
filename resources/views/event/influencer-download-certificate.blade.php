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
                {{-- <a href="">Download Certificate</a> --}}
                {{-- <a href="{{url('champion-download-certificate') }}/{{$event->id}}">View Details</a> --}}
                <a href="{{url('champion-download-certificate') }}">View Details</a>
            </div>
            <br><br><br><br>
        </div>
    <div class="results2"><span></span></div>

<script src="{{ asset('resources/js/newjs/jquery.validate.min.js')}}"></script>
<script src="{{ asset('resources/js/newjs/additional-methods.js')}}"></script>
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
        /*email: {
            required:true,
            validate_email: true
        },*/
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
        //  url:true
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
        /*email: {
          required: "Please enter your email",
          validate_email: "Please enter valid email id"
        },*/
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
                $(".multiple_image_section").append('<div class="um-field org_img_section"><div class="um-field-label"><label for="eventimage1">Add Event Picture (optional) <span style="opacity: 50%">(Maximum file size less than 2 MB, file must be .png,.jpg,.jpeg)</span></label><div class="um-clear"></div></div><div class="um-field-area"><input type="file" name="prt_image[]"  class="form-control"></div></div>');
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
                $(".multiple_video_section").append('<div class="um-field org_video_section"><div class="um-field-label"><label>Add Event Video Link (optional)</label><div class="um-clear"></div></div><div class="um-field-area"><input type="url" name="video_link[]" class="form-control" placeholder="Event Video Link"><span>For Example from Youtube , Facebook etc.</span> </div></div>');
                j++;
            });


            $("body").on("click", "#delete_org_video", function(e) {
                $(".org_video_section").last().remove();
                if($(".org_video_section").length==0){
                    $('#delete_org_video').hide();
                }
            });


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

}



$('.select_category').on('change', function(){

        let id = $(this).val();

        // baseurl = "https://localhost/fitindiawebgit/";
        baseurl = "<?php echo config('app.website_url'); ?>";

        $.ajax({

            method: "GET",
            url: baseurl + "eventdatesearch/"+id,
            contentType: false,
            processData: false,

            success: function (response) {

                let html = ''
                let html2 = ''

                if(response.success == true){

                    html +=`<div class="col-sm-12 col-md-6">
                                <div class="form-group ">
                                    <span id="eventstartdate">From Date</span>
                                    <input type="date" name="from_date" class="form-control" id="from_date" value="" maxlength="10"min="${response.from_date}" max="${response.to_date}">
                                    {!!$errors->first("from_date", "<span class='text-danger'>:message</span>")!!}
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group ">
                                    To Date
                                    <input type="date" name="to_date" class="form-control" id="to_date" value="" maxlength="10" min="${response.from_date}" max="${response.to_date}">
                                    {!!$errors->first("to_date", "<span class='text-danger'>:message</span>")!!}
                                </div>
                            </div>`;

                    $('#all-events').html(html);
                    // console.log("response.name",response.name);
                    // return false;
                    $('.change_event_name').val(response.name);
                }else{

                    html +=`<div class="col-sm-12 col-md-6">
                                <div class="form-group ">
                                        <span> Data Not Found</span>
                                </div>
                            </div>`;

                    $('#all-events').html(html);
                }

            }

        });
    });



    $('.change_category_name').on('change', function(){

        category_name = $('#category_name').val();

        if(category_name != "13080"){

            $("#event_activity_hide").css("display", "none");
            return false;

        }else{

            $("#event_activity_hide").css("display", "block");
            return false;

        }

        return false;
    });


    $(document).ready(function () {

        category_name = $('#category_name').val();
        if(category_name != "13080"){

            $("#event_activity_hide").css("display", "none");
            return false;

        }else{

            $("#event_activity_hide").css("display", "block");
            return false;

        }
        return false;

    });


</script>
@endsection
