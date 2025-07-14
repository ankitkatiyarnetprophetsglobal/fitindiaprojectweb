<!DOCTYPE html>
<html lang="en">

<head>
    <title> Fit India Healthy Mill-Eating Hindustan Quiz Contest</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('resources/ncss/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.iconmonstr.com/1.3.0/css/iconmonstr-iconic-font.min.css">
    <link rel="stylesheet" href="{{ asset('resources/ncss/global.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/ncss/create.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/ncss/style.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/ncss/media_query_quiz.css') }}">
    <!-- <script>
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

                    document.forms["iymform"].submit();
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
            var slot_end = '{{$slot_end}}';
            console.log(slot_end);
            var deadline = new Date(Date.now() + 1001 * 60).getTime();

            var x = setInterval(function () {
                var now = new Date().getTime();
                var t = slot_end - now;
                var sec = 0;
                console.log(now);
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
                    document.forms["iymform"].submit();
                    //document.getElementById("demo").innerHTML = "TIME UP";

                }
            }, 1000);

        }

      </script> -->
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

        window.addEventListener('selectstart', function (e) {
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
            .fixed_c{
                position: relative !important;
            }
            .row{
                margin: 0;
            }
            .quiz_form_container input{
    opacity: 1;
    cursor: pointer;
    height: auto;
    width: auto;
            }
            .quiz_form_container h3{
                margin-top: 30px;
                font-size: 22px;
                font-weight: 700;
            }
           
           
            .quiz_form_container .rowform  label{margin-bottom: 0;margin-left: 18px !important; font-size: 16px; font-weight: 500; word-wrap: break-word;}
            .quiz_form_container .rowform input[type=radio]{height: 18px !important; width: 18px !important; margin-right: 18px;}
    </style>
</head>

<body oncopy="return false" oncut="return false" onpaste="return false">
    <div class="container-fluid no-padding" id="fixed-c">
        <div class="fixed_c">
            <div class="row ">
                <div class="col-sm-12 col-md-12 col-lg-12 no-padding">
                    <div class="head_khelo">
                        <!-- <div style="display: none;" class="countermtr"> <span id="minutes"></span> : <span id="seconds"></span> </div> -->
                        <h1>
                            Fit India Healthy Mill-Eating Hindustan Quiz Contest
                        </h1>
                    </div>
                </div>
            </div>
            
           <div class="container quiz_form_container">
            <div class="row">
                <form action="{{ url('iym-quiz-submit') }}" method="POST" name="iymform">
                    @csrf
                    
                    <input type="hidden" name="sec" id="sec" value="">
                    <input type="hidden" name="question_id" value="{{$associate_details->question_id}}">
                    <input type="hidden" name="date" value="{{$associate_details->date}}">
                    <input type="hidden" name="slot_in" value="{{$associate_details->slot_in}}">
                    <input type="hidden" name="slot_over" value="{{$associate_details->slot_over}}">
                    <input type="hidden" name="master_id" value="{{$associate_details->master_id}}">
                    <input type="hidden" name="associate_id" value="{{$associate_details->id}}">
                    <input type="hidden" name="question_id" value="{{$associate_details->question_id}}">
                    <input type="hidden" name="user_id" value="{{$userid}}">
                    
                    <div class="row rowform">
                        <div class="col-12 mb-3">
                            <h3 >{{$encrypted->ques}}:</h3>
                        </div>
                        <div class="col-12">
                           <div class="row align-items-center" style="word-break: break-all; margin-bottom: 30px;padding-left: 15px;">
                           
                            <input type="radio" class="form-check-input radio-btn" id="html" name="user_ans" value="{{$encrypted->opt1}}">
                            <label for="html" class="mb-0 mx-2 form-label">{{$encrypted->opt1}}</label>
                           </div>
                        
                        </div>
                        <div class="col-12">
                           <div class="row align-items-center" style="word-break: break-all; margin-bottom: 30px;padding-left: 15px;">
                            
                                <input type="radio" class="form-check-input radio-btn" name="user_ans" value="{{$encrypted->opt2}}">
                            <label for="css" class="mb-0 mx-2 form-label">{{$encrypted->opt2}}</label>
                            </div>
                                                   </div>
                        <div class="col-12">
                           <div class="row align-items-center" style="word-break: break-all; margin-bottom: 30px;padding-left: 15px;">
                            
                                <input type="radio" class="form-check-input radio-btn" name="user_ans" value="{{$encrypted->opt3}}">
                            <label for="javascript" class="mb-0 mx-2 form-label">{{$encrypted->opt3}}</label>
                            </div>
                                                   </div>
                        <div class="col-12">
                           <div class="row align-items-center" style="word-break: break-all; margin-bottom: 30px;padding-left: 15px;">
                            
                                <input type="radio" class="form-check-input radio-btn" name="user_ans" value="{{$encrypted->opt4}}">
                            <label for="javascript" class="mb-0 mx-2 form-label ">{{$encrypted->opt4}}</label>
                            </div>
                                                   </div>
                    </div>
                    
                   <div class="col-12">
                    <div class="form-group" style="margin: 10px 6px;">
                        <button type="button"class="btn btn-primary d-block px-4 on_quiz_submit" style="font-size: 16px; border-radius: 5px;">Submit</button>
                    </div>
                   </div>
                  
                    <br>
                    <br>
                    <br>
                   
                    
            
        
        </form>
            </div>
           </div>
           
    </div>
    
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js">
    </script>
    <script src="{{ asset('resources/js/jquery.fullscreen.js') }}"></script>
    <script>
       $(document).ready(function() {
  var start = new Date();

$(document).on('click','.on_quiz_submit',function(){
    var end = new Date();
    let t = end - start;
    $('#sec').val(t);
    document.forms["iymform"].submit();
    console.log(t);

})



//   $(window).unload(function() {
//       var end = new Date();
//       $.ajax({ 
//         url: "log.php",
//         data: {'timeSpent': end - start},
//         async: false
//       })
//    });
});
    </script>
</body>

</html>