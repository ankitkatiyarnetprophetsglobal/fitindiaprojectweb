<!DOCTYPE html>
<html lang="en">

<head>
    <title>vivo PKL Fit India School Week 2022 Quiz</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('resources/ncss/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.iconmonstr.com/1.3.0/css/iconmonstr-iconic-font.min.css">
    <link rel="stylesheet" href="{{ asset('resources/ncss/global.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/ncss/create.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/ncss/style.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/ncss/media_query_quiz.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/newcss/select2.min.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <script>
        var mins = 2;
        var secs = mins * 60;

        function countdown() {
            setTimeout('Decrement()', 60);
        }


        function Decrement() {
            var sec = 0;
            var minvar = 0;
            var secvar = 0;

            if (document.getElementById) {
                minutes = document.getElementById("minutes");
                seconds = document.getElementById("seconds");
                secelem = document.getElementById("sec");
                if (seconds < 59) {
                    seconds.innerHTML = secs;
                } else {
                    minvar = getminutes();
                    secvar = getseconds();
                    minutes.innerHTML = minvar;
                    seconds.innerHTML = secvar;
                    if (minvar == 1) {
                        sec = 60 + secvar;
                    } else {
                        sec = secvar;
                    }

                    secelem.value = sec;
                }

                if (mins < 1) {
                    //minutes.style.color = "red";
                    //seconds.style.color = "red";
                }


                if (mins < 0) {
                    secelem.value = 0;
                    alert('time up');

                    document.forms["quiztokyo"].submit();
                    minutes.innerHTML = 0;
                    seconds.innerHTML = 0;
                } else {
                    secs--;
                    setTimeout('Decrement()', 1000);
                }
            }
        }

        function getminutes() {
            mins = Math.floor(secs / 60);
            return mins;
        }

        function getseconds() {
            return secs - Math.round(mins * 60);
        }
    </script>

    <script>
        function counterquiz() {
            var deadline = new Date(Date.now() + 1001 * 60).getTime();

            var x = setInterval(function() {
                var now = new Date().getTime();
                var t = deadline - now;
                var sec = 0;

                var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((t % (1000 * 60)) / 1000);

                document.getElementById("minutes").innerHTML = minutes;
                document.getElementById("seconds").innerHTML = seconds;

                if (minutes == 1) {
                    sec = 60 + seconds;
                } else if (seconds < 0) {
                    sec = 0;
                } else {
                    sec = seconds;
                }

                document.getElementById("sec").value = sec;
                if (t < 0) {
                    clearInterval(x);
                    document.getElementById("sec").value = 0;
                    document.getElementById("minutes").innerHTML = '0';
                    document.getElementById("seconds").innerHTML = '0';
                    document.forms["quiztokyo"].submit();
                    //document.getElementById("demo").innerHTML = "TIME UP";

                }
            }, 1000);

        }
    </script>
    <script>
        function disableSelect(event) {
            event.preventDefault();
        }

        function startDrag(event) {
            window.addEventListener('mouseup', onDragEnd);
            window.addEventListener('selectstart', disableSelect);
            // ... my other code
        }

        function onDragEnd() {
            window.removeEventListener('mouseup', onDragEnd);
            window.removeEventListener('selectstart', disableSelect);
            // ... my other code
        }

        window.addEventListener('selectstart', function(e) {
            e.preventDefault();
        });
    </script>

    <style>
        /* .spl_spm{
        margin-right: 15px;
    }
   .spl_spm input{
    min-width: 180px;
   } */

   .select2-selection--single{
    height: 32px !important ;
    font-size: 13px !important;
    border-radius: 2px !important;
    border-color: #ced4da !important;
   }

   .start-btn{
    height: 32px !important;
   }
    </style>
</head>

<body oncopy="return false" oncut="return false" onpaste="return false">

    <form action="{{ route('schoolQuizStore') }}" method="POST" onsubmit="return checkquiz()" autocomplete="off" name="quiztokyo" class="studentDetailsForm">
        @csrf
        <div class="container-fluid no-padding" id="fixed-c">
            <div class="fixed_c">
                <div class="row ">
                    <div class="col-sm-12 col-md-12 col-lg-12 no-padding">
                        <div class="head_khelo">
                            <div class="countermtr"> <span id="minutes"></span> : <span id="seconds"></span> </div>
                            <h1>
                                {{-- {{ ucwords($userdata->name) }} - --}}
                                {{ __('vivo PKL Fit India School Week 2022 Quiz') }}
                            </h1>


                        </div>
                    </div>
                </div>

                <div class="row stickshadow ">
                    <div id="UpdatePanel1">
                        <div class="row r-m  base_o">
                            <div class="col-sm-12 col-md-12 col-lg-12 rm-p-m">

                                <div id="error-div" class="alert alert-danger d-none"></div>

                                @if (session()->has('error'))
                                    <div class="alert alert-error alert-danger larvel-validate"
                                        style="text-align:center; font-size: large; font-weight: 400;">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                                <div class="alert alert-error alert-danger js_error d-none"
                                    style="text-align:center; font-size: large; font-weight: 400;"></div>


                                   <div class="main-content  top_heading_quiz" style="text-align: center; display:block; margin:25px 0;">
                                    <h3  >Please fill the above details to start Quiz </h3>
                                   </div>

                                <div id="div_userdata" class="user_area_q" style="padding: 0 40px; display:flex; justify-content:center; align-items:center; flex-wrap:wrap; ">
                                    {{-- Student Name --}}
                                    <div class="form-group user_child " style="width: 210px !important">
                                        <label style="font-weight: 700; margin:0;  font-size:14px" >Student Full Name</label>
                                        <input type="hidden" name="sec" id="sec" />
                                        <input type="text" name="name" autocomplete="off" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('Student Full Name') }}" value="{{ old('name') }}" maxlength="150">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- Student Name --}}


                                    {{-- Student DOB --}}
                                    <div class="form-group user_child " style="width: 210px !important">
                                        <label style="font-weight: 700; margin:0;  font-size:14px" >Student DOB</label>
                                        <input type="text" name="dob" id="dob"
                                            class="form-control @error('dob') is-invalid @enderror"
                                            placeholder="{{ __('Student DOB') }}" value="{{ old('dob') }}" autocomplete="off" readonly>
                                        @error('dob')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- Student DOB --}}


                                    {{-- Student Parent Name --}}
                                    <div class="form-group user_child " style="width: 210px !important;">
                                        <label style="font-weight: 700; margin:0;  font-size:14px" >Full Name of Parent/Guardian</label>
                                        <input type="text" name="parent_name" id="parent_name"
                                            class="form-control @error('parent_name') is-invalid @enderror"
                                            placeholder="{{ __('Full Name of Parent/Guardian') }}"
                                            value="{{ old('parent_name') }}" autocomplete="off" maxlength="150">
                                        @error('parent_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- Student Parent Name --}}


                                    {{-- Student Mobile Number --}}
                                    <div class="form-group user_child" style="width: 210px !important; ">
                                        <label style="font-weight: 700; margin:0;  font-size:14px" >Student/Parent's Mobile No.</label>
                                        <input type="text" name="mobile" id="mobile"
                                            class="form-control allownumericwithoutdecimal @error('mobile') is-invalid @enderror"
                                            value="{{ old('mobile') }}" placeholder="Student/Parent's Mobile No."
                                            maxlength="10" autocomplete="off">
                                        @error('mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- Student Mobile Number --}}

                                    {{-- School Name --}}
                                    <div class="form-group user_child" style="width: 210px !important;">
                                        <label style="font-weight: 700; margin:0;  font-size:14px" >Full Name Of School</label>
                                        <input type="text" name="school_name" id="school_name"
                                            class="form-control @error('school_name') is-invalid @enderror"
                                            value="{{ old('school_name') }}"
                                            placeholder="{{ __('Full Name Of School') }}" autocomplete="off" maxlength="500">
                                        @error('school_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    {{-- School Name --}}


                                    {{-- School State --}}

                                    <div class="form-group user_child last-t" style="width: 210px !important; display:flex; flex-direction:column;">
                                        <label style="font-weight: 700; margin:0;  font-size:14px" >State/UT</label>
                                        <select id="state" name="state"
                                            class="form-control @error('state') is-invalid @enderror"
                                            aria-required="true"  >
                                            <option value="" disabled >{{ __('Select State/UT') }}</option>
                                            @foreach ($states as $st)
                                                <option value="{{ $st->id }}" @if(old('state') == $st->id) selected @endif>{{ $st->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- School State --}}

                                    {{-- School district --}}

                                    <div class="form-group user_child last-t"  style="width: 210px !important; display:flex; flex-direction:column;">
                                        <label style="font-weight: 700; margin:0;  font-size:14px" >District</label>
                                        <select id="district" name="district"
                                            class="form-control @error('district') is-invalid @enderror"
                                            aria-required="true">
                                            <option value="" disabled>{{ __('Select District') }}</option>

                                        </select>

                                        @error('district')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- School district --}}

                                    {{-- School city --}}

                                    <div class="form-group user_child " style="width: 210px !important;">
                                        <label style="font-weight: 700; margin:0;  font-size:14px" >City/Town</label>
                                        <input type="text" name="city" id="city"
                                            class="form-control @error('city') is-invalid @enderror"
                                            placeholder="{{ __('sentence.city') }}" value="{{ old('city') }}" autocomplete="off" maxlength="150">
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- School city --}}


                                    {{-- School pincode --}}

                                    <div class="form-group user_child "  style="width: 210px !important;">
                                        <label style="font-weight: 700; margin:0;  font-size:14px" >Pincode</label>
                                        <input type="text" name="pincode" id="pincode"
                                            class="form-control allownumericwithoutdecimal @error('pincode') is-invalid @enderror"
                                            placeholder="{{ __('Pincode') }}" value="{{ old('pincode') }}"
                                            maxlength="6" minlength="6">
                                        @error('pincode')
                                            <span class="invalid-feedback" role="alert" autocomplete="off">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- School pincode --}}




                                    <div class="form-group user_child last-t"  style="width: 210px !important; display:flex; flex-direction:column;">
                                        <label style="font-weight: 700; margin:0;  font-size:14px" >Class/Standard</label>
                                        <select id="class_name" name="class_name"
                                            class="form-control @error('district') is-invalid @enderror"
                                            aria-required="true">
                                            <option value="" disabled>{{ __('Select Class/Standard') }}</option>
                                            <option value="1" @if(old('class_name') == 1) selected @endif>I</option>
                                            <option value="2" @if(old('class_name') == 2) selected @endif>II</option>
                                            <option value="3" @if(old('class_name') == 3) selected @endif>III</option>
                                            <option value="4" @if(old('class_name') == 4) selected @endif>IV</option>
                                            <option value="5" @if(old('class_name') == 5) selected @endif>V</option>
                                            <option value="6" @if(old('class_name') == 6) selected @endif>VI</option>
                                            <option value="7" @if(old('class_name') == 7) selected @endif>VII</option>
                                            <option value="8" @if(old('class_name') == 8) selected @endif>VIII</option>
                                            <option value="9" @if(old('class_name') == 9) selected @endif>IX</option>
                                            <option value="10" @if(old('class_name') == 10) selected @endif>X</option>
                                            <option value="11" @if(old('class_name') == 11) selected @endif>XI</option>
                                            <option value="12" @if(old('class_name') == 12) selected @endif>XII</option>

                                        </select>

                                        @error('class_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    {{-- <div class="form-group user_child" style="width: 210px !important;">
                                        <label style="font-weight: 700; margin:0;  font-size:14px" >Class/Standard</label>
                                        <input type="text" name="class_name" id="class_name"
                                            class="form-control @error('class_name') is-invalid @enderror"
                                            placeholder="Class/Standard" value="{{ old('class_name') }}" autocomplete="off" maxlength="150">
                                        @error('class_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror


                                    </div> --}}
                                    <div class="form-group user_child last-t" style="width: 210px !important;">
                                        <label style="font-weight: 700; margin:0;  font-size:14px" >Section</label>
                                        <input type="text" name="section" id="section"
                                            class="form-control @error('section') is-invalid @enderror"
                                            placeholder="Section" value="{{ old('section') }}" autocomplete="off" maxlength="150">
                                        @error('section')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror


                                    </div>








                                    <div class="form-group" style="margin-top:30px ; padding:6px 0;">
                                        <span class="start-btn" onclick="checkuser()"
                                            id="start-btn">{{ __('sentence.start_quiz_button_text') }}</span>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!--<input type="hidden" name="showpopup" id="showpopup"> -->
                    </div>


                </div>
            </div>

            <div class="page-content-inner startquiz" id="startquizelem" style="padding: 8rem 0rem 3rem 0rem">
                <div class="row bg_c bg_c_r">


                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="main-content">

                            <div class="seq_que">
                                <h3>{{ __('sentence.quiz_signup_filling_instruction_heading_1') }} </h3>
                            </div>

                        </div>
                    </div>

                </div>

            </div>






        </div>
    </form>

    <script src="{{ asset('resources/js/newjs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('resources/js/newjs/popper.min.js')}}"></script>
    <script src="{{ asset('resources/js/newjs/bootstrap.min.js')}}"></script>
    <script src="{{ asset('resources/js/newjs/jquery-ui.js')}}"></script>
     <script src="{{ asset('resources/js/newjs/select2.min.js')}}"></script>

    <script src="{{ asset('resources/js/jquery.fullscreen.js') }}"></script>
    <script>
        $(document).ready(function() {
            //Disable full page
            $("body").on("contextmenu", function(e) {
                return false;
            });

            //Disable part of page
            $("#id").on("contextmenu", function(e) {
                return false;
            });
            $('#state').select2();
            $('#class_name').select2();


//             $("#state").select2({
//     minimumInputLength: 3,
//     tags: [],
//     ajax: {
//         url: "{{url('searchState')}}",
//         dataType: 'json',
//         type: "GET",
//         quietMillis: 50,
//         data: function (term) {
//             return {
//                 term: term
//             };
//         },
//         processResults : function (data) {
//             console.log('akshay')
//             return {
//                 results: $.map(data.state_list, function (item) {
//                     console.log(item);
//                     return {
//                         text: item.name,
//                         id: item.id
//                     }
//                 })
//             };
//         }
//     }
// });





            $('#district').select2();
            $("#dob").datepicker({
                dateFormat: 'dd-mm-yy',
                yearRange: '2002:2022',
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                maxDate: new Date(),
                });
            if($('#state').find(":selected").val() != ""){
                $('#state').trigger("change");
            }
        });

        $('#state').change(function() {
            state_id = $('#state').val();
            $("select[name=state]").prop("disabled", true);
            $.ajax({
                url: "{{ route('getdistrict') }}",
                type: "post",
                data: {
                    "id": state_id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    //console.log(response);
                    $('#district').html(response);
                    $('#district').select2();
                    $(`#district option[value='']`).attr("disabled","disabled");
                    $("select[name=state]").prop("disabled", false);
                },
            });
        });

        function checkuser() {
            document.getElementById("error-div").innerHTML = "";
            document.getElementById("error-div").style.display = 'none';
            $('.js_error').addClass('d-none');


            var name = document.getElementById("name").value;
            var dob = document.getElementById("dob").value;
            var parent_name = document.getElementById("parent_name").value;
            var parent_name = document.getElementById("parent_name").value;
            var sclass = document.getElementById("mobile").value;
            var school_name = document.getElementById("school_name").value;
            var state = document.getElementById("state").value;
            var district = document.getElementById("district").value;
            var city = document.getElementById("city").value;
            var pincode = document.getElementById("pincode").value;
            var class_name = document.getElementById("class_name").value;
            var section = document.getElementById("section").value;

            var msgflag = false;
            var msgflag1 = false;
            var msg = '';
            var msg1 = '';

            if (!name) {
                msgflag = true;
                msg += 'Student Full Name,';
            }

            if (name) {
                var reg = /^[a-zA-Z ]*$/;
                var checking = reg.test(name);

                if (!checking) {
                    msgflag1 = true;
                    msg1 += 'Please Enter a Valid Student Full Name,';
                } else if (name.length < 3) {
                    msgflag1 = true;
                    msg1 += 'Student Full Name has minimum 3 charecters,';
                }
            }

            if (!dob) {
                msgflag = true;
                msg += 'Student DOB,';
            }
            if (!parent_name) {
                msgflag = true;
                msg += 'Parent/Guardian Name,';
            }

            if (parent_name) {
                var reg = /^[a-zA-Z ]*$/;
                var checking = reg.test(parent_name);

                if (!checking) {
                    msgflag1 = true;
                    msg1 += 'Please Enter a Valid Parent/Guardian Name,';
                } else if (parent_name.length < 3) {
                    msgflag1 = true;
                    msg1 += 'Parent/Guardian Name has minimum 3 charecters,';
                }
            }


            if (!sclass) {
                msgflag = true;
                msg += `Student/Parent's Mobile No.,`;
            }
            if (!school_name) {
                msgflag = true;
                msg += `School Name,`;
            }
            if (school_name) {
                var reg = /(?:\d+[a-zA-Z]|[a-zA-Z]+\d?)[a-zA-Z\d]*/;
                var checking = reg.test(school_name);

                if (!checking) {
                    msgflag1 = true;
                    msg1 += 'Please Enter a Valid School Name,';
                } else if (school_name.length < 3) {
                    msgflag1 = true;
                    msg1 += 'School Name has minimum 3 charecters,';
                }
            }
            if (!state) {
                msgflag = true;
                msg += `State,`;
            }
            if (!district) {
                msgflag = true;
                msg += `District,`;
            }
            if (!city) {
                msgflag = true;
                msg += `City,`;
            }
            if (city) {
                var reg = /(?:\d+[a-zA-Z]|[a-zA-Z]+\d?)[a-zA-Z\d]*/;
                var checking = reg.test(city);

                if (!checking) {
                    msgflag1 = true;
                    msg1 += 'Please Enter a Valid City Name,';
                } else if (city.length < 3) {
                    msgflag1 = true;
                    msg1 += 'City Name has minimum 3 charecters,';
                }
            }
            if (!pincode) {
                msgflag = true;
                msg += `Pincode,`;
            }
            if (pincode) {
                if(pincode.length < 6) {
                    msgflag1 = true;
                    msg1 += 'Pincode Should be 6 digits,';
                }
            }
            if (!class_name) {
                msgflag = true;
                msg += 'Class/Standard,';
            }
            if (!section) {
                msgflag = true;
                msg += 'Section ';
            }

            if (msgflag) {
                msg += ` Fields Can't be Empty.`;
            }



            if (sclass) {
                var reg = /^[0-9]{1,10}$/;
                var checking = reg.test(sclass);

                if (!checking) {
                    msgflag1 = true;
                    msg1 += 'Mobile can be 10 digit only';
                } else if (sclass.length != 10) {
                    msgflag1 = true;
                    msg1 += 'Mobile can be 10 digit only';
                }
            }




            if (msgflag) {
                $('.larvel-validate').addClass('d-none');
                document.getElementById("error-div").innerHTML = msg;


                document.getElementById("error-div").style.display = 'block';
                $('#error-div').removeClass('d-none');
                document.getElementById("fixed-c").scrollIntoView();
                if(!msgflag1){
                    return false;
                }

            }
            if (msgflag1) {
                $('.larvel-validate').addClass('d-none');
                document.getElementById("error-div").innerHTML = msg1;


                document.getElementById("error-div").style.display = 'block';
                $('#error-div').removeClass('d-none');
                document.getElementById("fixed-c").scrollIntoView();
                return false;
            }



            //countdown();

            //getquizques('en');
            getquizques()

            //document.getElementById("startquizelem").classList.remove("startquiz");

        }


        function getquizques(lang) {
            var langs = "<?= Lang::locale() ?>";
            var mobile = $('#mobile').val();
            $.ajax({
                url: "{{ route('getschoolquizques') }}",
                data: $('.studentDetailsForm').serialize(),
                type: 'POST',
                success: function(response) {
                    if (response.status == 'error') {

                        $('.larvel-validate').addClass('d-none');

                        $('.js_error').html(response.message);
                        $('.js_error').removeClass('d-none');
                    } else {
                        $('.js_error').addClass('d-none');
                        $('.larvel-validate').addClass('d-none');
                        let msg = "";
                        var cnt = 0;
                        for (let i in response) {
                            console.log(response[i].id + " ");
                            cnt++;
                            msg +=
                                '<div class="row bg_c bg_c_r"> <div class="col-sm-12 col-md-12 col-lg-12"> <div class="main-content"> <div class="ques_d">Question:<span>' +
                                cnt + '</span></div> <div class="seq_que"> <h3>' + response[i].ques +
                                '</h3> </div> </div> </div>';

                            msg +=
                                '<div class="col-sm-12 col-md-12 col-lg-12 card_Flex_Area"> <div class="card card_flex"> <div class="card_flex_inner"> <div> <svg id="Layer_1" x="20" y="30" height="30" viewBox="0 0 506.1 506.1" width="30"><path d ="m489.609 0h-473.118c-9.108 0-16.491 7.383-16.491 16.491v473.118c0 9.107 7.383 16.491 16.491 16.491h473.119c9.107 0 16.49-7.383 16.49-16.491v-473.118c0-9.108-7.383-16.491-16.491-16.491z"></svg>';
                            msg += '</div><div class="r_txt">' + response[i].opt1 +
                                '</div> </div> <div> <label class="radiocontainer"> <input type="radio"  class="form-check-input" name="quesoption[' +
                                response[i].id + ']" value="' + response[i].opt1 +
                                '"> <span class="checkmark" disabled=""></span> <span class="wrong_div"><i class="im im-x-mark"></i></span> </label> </div> </div>';
                            msg +=
                                ' <div class="card card_flex"> <div class="card_flex_inner"> <div><svg id="layer_3" width="32" height="32" xmlns="http://www.w3.org/2000/svg"> <path d="M15 .001l15 15-15 15-15-15 15-15z"></path> </svg></div> <div class="r_txt">' +
                                response[i].opt2 + '</div> </div> <div> <label class="radiocontainer"> ';
                            msg += '<input type="radio" class="form-check-input" name="quesoption[' + response[
                                    i].id + ']" value="' + response[i].opt2 +
                                '"> <span class="checkmark" disabled=""></span> <span class="wrong_div"><i class="im im-x-mark"></i></span> </label> </div></div>';


                            msg +=
                                '<div class="card card_flex"> <div class="card_flex_inner"> <div><svg version="1.1" id="Layer_2" x="0px" y="0px" viewBox="0 0 512 512"  style="enable-background:new 0 0 512 512;" height="30" width="30" xml:="" space="preserve"> <path d="M256,0C115.39,0,0,115.39,0,256s115.39,256,256,256s256-115.39,256-256S396.61,0,256,0z"></path> </svg></div>  <div class="r_txt">' +
                                response[i].opt3 +
                                '</div> </div> <div> <label class="radiocontainer">  <input type="radio" class="form-check-input" name="quesoption[' +
                                response[i].id + ']" value="' + response[i].opt3 +
                                '"> <span class="checkmark" disabled=""></span> <span class="wrong_div"><i class="im im-x-mark"></i></span></label></div> </div> ';

                            msg +=
                                '<div class="card card_flex"> <div class="card_flex_inner">  <div><svg xmlns="http://www.w3.org/2000/svg" id="Layer_4" width="32" height="32" viewBox="0 0 24 24"> <path d="M12 3l12 18h-24z"></path> </svg></div>  <div class="r_txt">' +
                                response[i].opt4 +
                                '</div> </div> <div> <label class="radiocontainer"> <input type="radio" class="form-check-input" name="quesoption[' +
                                response[i].id + ']" value="' + response[i].opt4 +
                                '"> <span class="checkmark" disabled=""></span> <span class="wrong_div"><i class="im im-x-mark"></i></span> </label> </div> </div> ';




                            msg += ' </div> </div>';
                        }
                        msg +=
                            '<div class="button-box_c"> <input type="submit" id="btnSubmit" name="qizSubmit"  class="next mt-4  mb-4"</div>';


                        $('#name').prop("readonly", true);
                        $('#dob').prop("readonly", true);
                        $('#parent_name').prop("readonly", true);
                        $('#mobile').prop("readonly", true);
                        $('#school_name').prop("readonly", true);
                        $('#state').prop("readonly", true);
                        $('#district').prop("readonly", true);
                        $('#city').prop("readonly", true);
                        $('#pincode').prop("readonly", true);
                        $('#class_name').prop("readonly", true);
                        $('#section').prop("readonly", true);



                        jQuery('#startquizelem').html(msg);
                        jQuery('#start-btn').hide();
                        jQuery('#div_userdata').hide();
                        jQuery('.top_heading_quiz').hide();

                        counterquiz();
                    }
                }
            });

        }

        function checkquiz() {
            var principal_name = document.getElementById("principal_name").value;
            var principal_mobile = document.getElementById("principal_mobile").value;
            var name = document.getElementById("name").value;
            var class_name = document.getElementById("class_name").value;
            var section = document.getElementById("section").value;
            var sclass = document.getElementById("mobile").value;

            var msgflag = false;
            var msg = '';

            if (!name) {
                msgflag = true;
                msg += 'Student Full Name,';
            }
            if (!dob) {
                msgflag = true;
                msg += 'Student DOB,';
            }
            if (!parent_name) {
                msgflag = true;
                msg += 'Parent/Guardian Name,';
            }
            if (!sclass) {
                msgflag = true;
                msg += `Student's Mobile Number,`;
            }
            if (!school_name) {
                msgflag = true;
                msg += `School Name,`;
            }
            if (!state) {
                msgflag = true;
                msg += `State,`;
            }
            if (!district) {
                msgflag = true;
                msg += `District,`;
            }
            if (!city) {
                msgflag = true;
                msg += `City,`;
            }
            if (!pincode) {
                msgflag = true;
                msg += `Pincode,`;
            }
            if (!class_name) {
                msgflag = true;
                msg += 'Class/Standard,';
            }
            if (!section) {
                msgflag = true;
                msg += 'Section ';
            }


            if (msgflag) {
                msg += ' <?= __('sentence.can_not_empty_text') ?>';
                document.getElementById("error-div").innerHTML = msg;
                document.getElementById("error-div").style.display = 'block';
                document.getElementById("fixed-c").scrollIntoView();
                return false;
            }
            return true;
        }

        $(document).on("keypress keyup blur", '.allownumericwithoutdecimal', function(event) {
            $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
    </script>




    <style>
        #error-div {
            margin-bottom: 0;
            font-weight: 500;
            line-height: 1.2;
            font-size: 14px;
            width: 100%;
            text-align: center;
            display: none;
        }

        .school_name {
            text-align: center;
            position: relative;
            padding: 10px;
            background: #f2f2f2;
            color: #383850;
            font-size: 3rem;
        }

        img.brand-logo {
            position: relative;
            height: 50px;
            left: 0;
        }

        #mycounter {
            display: inline-block;
            float: right;
        }

        .countermtr {
            position: fixed;
            width: 98%;
            z-index: 1000;
            color: #ffffff;
            text-align: right;
            font-size: 18px;
        }


        .startquizs {
            -webkit-filter: blur(5px);
            -moz-filter: blur(5px);
            -o-filter: blur(5px);
            -ms-filter: blur(5px);
            filter: blur(5px);
        }

        .start-btn {
            background: #f2581c;
            padding: 4px 0;
            color: #fff;
            font-size: 1.2rem;
            width: 80px;
            text-align: center;
            border-radius: 6px;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            font-weight: 600;
            border-color: #f2581c5c;
            cursor: pointer;
            display: inline-block;
        }
    </style>


</body>

</html>
