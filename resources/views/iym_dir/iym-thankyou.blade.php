<!DOCTYPE html>
<html lang="en">
    <head>
        <title> PKL – Fit India School Week 2022 Quiz</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('resources/ncss/bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://cdn.iconmonstr.com/1.3.0/css/iconmonstr-iconic-font.min.css">
        <link rel="stylesheet" href="{{ asset('resources/ncss/global.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/ncss/create.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/ncss/style.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/ncss/media_query_quiz.css') }}">
        <style>
            .btn-success{font-size: 16px;
    padding: 8px 30px;
    margin-top: 15px;
    font-weight: 600;}
        </style>
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

    </head>
    <body oncopy="return false" oncut="return false" onpaste="return false">

   
       <div class="container" style="margin-top:80px;">
        <div class="row">
            <div class="col-12">
                <figure class="mb-0 text-center"><img src="{{ asset('resources/imgs/school_quiz/thankyou.svg') }}" class="main-poster img-fluid" alt="Tokyo Quiz" />
                </figure>
                <h1 class="text-center py-5 text-uppercase" style="font-weight:bold;">Thank You For participating</h1>                
            </div>
           <div class="col-12">
            <h2 class="text-center" style="font-weight:500;">{{$user_data->name}}</h2>
           </div>
           <div class="col-12 text-center">
            <a class="btn btn-success" href="{{ url('iym-contest-index?Fit_id='.$user_data->id.'&m=true') }}">Home</a>
           </div>
        </div>
       </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js">
        </script>
        <script src="{{ asset('resources/js/jquery.fullscreen.js') }}"></script>
       
    </body>
</html>