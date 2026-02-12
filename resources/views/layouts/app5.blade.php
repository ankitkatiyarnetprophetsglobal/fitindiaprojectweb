<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="twitter:card" value="summary">

    <!-- CSRF Token  -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="msapplication-TileImage" content="{{ asset('resources/images/fit-fav.ico') }}" />
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('resources/images/fit-fav.ico') }}" sizes="32x32"  />
    <link rel="icon" href="{{ asset('resources/images/fit-fav.ico') }}" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('resources/images/fit-fav.ico') }}" />

    <!-- <link rel="stylesheet" href="{{ asset('resources/fonts/bootstrap.min.css') }}" media="screen"> -->
    <link rel="stylesheet" href="{{ asset('resources/css/bootstrap.min.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('resources/css/font-awesome.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('resources/css/dashboard.min.css') }}" media="screen">
    <!-- <link href="{{ asset('resources/css/print.min.css') }}" rel="stylesheet" media="all">   -->
    <link href="{{ asset('resources/css/style.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('resources/css/responsive.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('resources/css/print.css') }}" rel="stylesheet" media="print">
    <link href="{{ asset('resources/css/aos.css') }}" rel="stylesheet">
    <script src="{{ asset('resources/js/jquery.min.js')}}"></script>
    <script src="{{ asset('resources/js/popper.min.js')}}"></script>
    <script src="{{ asset('resources/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('resources/js/jquery.easing.min.js')}}"></script>
<script src="{{ asset('resources/js/aos.js')}}"></script>
<!-- Raj -->
<style>
.close {
  position:absolute;
  right:-30px;
  top:0;
  z-index:999;
  font-size:2rem;
  font-weight: normal;
  color:#fff;
  opacity:1;
}
</style><!-- Raj close -->
</head>
<body >
     <?php
	if(!empty($_GET['m'])){ ?>

	<!-- <style>
	    #top-header,.header, .menu-bar, #footer_ab, #top-header_web, .cust_navbar_mob { display:none; }
	</style>	 -->
	<?php } ?>
<div class="container-fluid" id="@yield('pageid')">
    <!-- Top Header Bar -->
    <div id="top-header">
    </div>


    </div>
    <!-- Top Header Bar end-->




<script>

$(document).ready(function(){
    $('.logoutid').click(function(){
        document.getElementById('logout-form').submit();
    })
})


function logoutfn(){
	// var z = confirm("Are you sure to logout?");
	// if (z == true) {

	// }
}
//logoutfn();

</script>


<script>
/*
        $(document).ready(function(){

                $(".cust_navbar_mob").click(function(){
                    $("#top-header").slideToggle("fast","swing");

                })
        })
 */
</script>

<script>
    /* $(document).ready(function(){
        var state =false;
        addCssfun = function () { addCSS('./resources/css/contract.css')},
        removefun = function() { $('#cont_id').remove();};

            $(".contra").click(function(){
                    state = !state;
                    if(!state){
                        removefun();
                        $('.construle').css('color','#fff');

                    } else {
                        addCssfun();
                        $('.construle').css('color','#ff8b0c');

                    }
            });
    });

        function printFile(){
            window.print();return false;
        } */

</script>

<script type="text/javascript">

$(document).ready(function(){

   // $("h1, h2, h3,h4,h5,h6").addClass("resizable");
//    var originalSize_Li_A = $('li a').css('font-size');
//    var originalSize_H1 = $('h1').css('font-size');
//    var originalSize_H2 = $('h2').css('font-size');
  // alert("originalSize_H2  "+originalSize_H2)
  var  zoomh1Default = $('.zoomh1').css('font-size');
//   var fontSize = window.getComputedStyle(el).fontSize

  var  a_headingDefault = $('.about_head').css('font-size');
  var  videotitleDefault = $('.video-title').css('font-size');
  var  evntarchvDefault = $('.evnt-archv').css('font-size');
  var  bxpDefault = $('.bx p').css('font-size');
  var  freedombtn1Default = $('.freedombtn1').css('font-size');
  var  freedombtn2Default = $('.freedombtn2').css('font-size');
  var  freedombtn3Default = $('.freedombtn3').css('font-size');
  var  et_pb_bg_layout_lightDefault = $('.et_pb_bg_layout_light').css('font-size');
  var  headvideoDefault = $('.headvideo').css('font-size');
//   var  zoomh1Default = $('.zoomh1').css('font-size');

//alert("zoomh1Default  " + a_headingDefault) ;


  var resizefont = new Array('div,p,a,li', '.resizable');
      resizefont = resizefont.join(',');
      resetFont  = $(resizefont).css('font-size');
      $(document).on('click', '.resetFont', function(){

        $(resizefont).css('font-size', resetFont);
        $('.log_reg a').css('font-size', '12px');
        $('.top_head_item a').css('font-size', '12px');
        $('.panel-title a').css('font-size', '18px');
        $('p').css('font-size', '14px');
        $('body').css('font-size', '14px');
        $('.zoomh1').css('font-size', zoomh1Default);
        $('.a_heading').css('font-size', a_headingDefault);
        $('.video-title').css('font-size', videotitleDefault);
        $('.evnt-archv').css('font-size', evntarchvDefault);
        $('.bx p').css('font-size', bxpDefault);
        $('.freedombtn1').css('font-size', freedombtn1Default);
        $('.freedombtn2').css('font-size', freedombtn2Default);
        $('.freedombtn3').css('font-size', freedombtn3Default);
        $('.et_pb_bg_layout_light').css('font-size', et_pb_bg_layout_lightDefault);
        $('.headvideo').css('font-size', headvideoDefault);



        //var currentSize_H1 = $('.zoomh1').css('font-size');

    });


    // $("#decreaseFont").click(function() {
    //     var originalFontSize = $(resizefont).css('font-size');
    //     var originalFontNumber = parseFloat(originalFontSize, 10);
    //     var newFontSize = originalFontNumber -1;
    //     $(resizefont).css('font-size', newFontSize);
    //     return false;
    // });

    // $("#increaseFont").click(function() {
    //     var originalFontSize    = $(resizefont).css('font-size');
    //     var originalFontNumber  = parseFloat(originalFontSize, 10);
    //     var newFontSize = originalFontNumber + 1;
    //     $(resizefont).css('font-size', newFontSize);



    //     var currentSize_H1 = $('.headH1').css('font-size');
    //         currentSize_H1 = parseFloat(currentSize_H1)*1.2;





    //     return false;
    // });



/*
    $(document).on('click', '.increaseFont', function(){

        //alert("rejsjfasd")

        $('div, p,a,li, h1,h2,h3,h4,h5,h6').css("font-size", function() {
            return parseInt($(this).css('font-size')) + 1 + 'px';
        });

    });


    $(document).on('click', '.decreaseFont', function(){

        $('div, p,a,li, h1,h2,h3,h4,h5,h6').css("font-size", function() {
            return parseInt($(this).css('font-size')) - 1 + 'px';
        });
    });
 */


     /* function addCSS(filename){
        var head = document.getElementsByTagName('head')[0];
        var style = document.createElement('link');
        style.href = filename;
        style.type = 'text/css';
        style.id   ='cont_id'
        style.rel = 'stylesheet';
        head.append(style);

        }
    }); */
</script>
    <!-- Content section -->
        @yield('content')
</div>

<script>
/* $(document).ready(function(){
    var assessId = $('#top-header_web').find('.log_reg').html();
   // log_status
        $('#top-header').append(assessId);
}) */

</script>


<!-- Raj -->
<script >
 /*  $(document).ready(function() {

// Gets the video src from the data-src on each button

var $videoSrc;
$('.video-btn').click(function() {
    $videoSrc = $(this).data( "src" );
});

 */


// when the modal is opened autoplay it
/* $('#videoId').on('shown.bs.modal', function (e) {

// set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
$("#video").attr('src',$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" );
})



// stop playing the youtube video when I close the modal
$('#videoId').on('hide.bs.modal', function (e) {
    // a poor man's stop video
    $("#video").attr('src',"");
})

});
 */
</script>
<!-- Raj -->
</body>
</html>
