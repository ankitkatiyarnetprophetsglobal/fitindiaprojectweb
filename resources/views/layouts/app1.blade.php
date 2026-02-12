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
    <link href="{{ asset('resources/css/responsive.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('resources/css/print.css') }}" rel="stylesheet" media="print">


<script src="{{ asset('resources/js/jquery.min.js')}}"></script>
<script src="{{ asset('resources/js/popper.min.js')}}"></script>
</head>
<body>
     <?php
	if(!empty($_GET['m'])){ ?>
	<style>
	#top-header,.header, .menu-bar, #footer_ab, #top-header_web, .cust_navbar_mob { display:none; }
	</style>
	<?php } ?>
<div class="container-fluid" id="@yield('pageid')">
    <div class="cust_navbar_mob"><p>Assessiblity Options</p></div>
    <!-- Top Header Bar -->
    <div id="top-header">
    </div>
    <div id="top-header_web" class="mob_flex">
    <!-- <div class="top-header_Flex"> -->

            <div class="top_head_item on-print">
                <a href="schooldashboard">Fit India Dashboard</a>
            </div>


            @php
                $active_section = request()->segment(count(request()->segments()));
                $active_section_id = "id='$active_section'";
            @endphp
            <div class="forMob on-print">
              <ul>
                        @guest

                                <li class="nav-item l_area log">
                                @if (Route::has('login'))
                                    <span><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }} </a></span>
                                @endif
                                </li>
                                <li class="nav-item l_area reg">
                                @if (Route::has('register'))
                                    <span><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></span>
                                    @endif
                                </li>

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('dashboard') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu  top-bar-li cus_drop " aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('dashboard') }}" >
                                        {{ __('My Account') }}
                                    </a>
									@if(Auth::user()->role == 'school')
									<a class="dropdown-item" href="{{ url('school-profile') }}/{{ Auth::user()->id }}">
                                        {{ __('Edit Profile') }}
                                    </a>
									@else
                                    <a class="dropdown-item" href="{{ url('edit-profile') }}/{{ Auth::user()->id }}">
                                        {{ __('Edit Profile') }}
                                    </a>
									@endif
                                    <a class="dropdown-item last_child" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     logoutfn();" >
									<!--
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
													 -->

                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                </ul>
              </div>
          <div class="log_reg">
            <div class=" log_status">
                    <ul class="navbar-nav ml-auto cust_navbar on-print">

                      <!--<li class="nav-item"> <a href="{{ url('screen-reader-access') }}">Screen Reader Access</a></li>-->

                    <li class="nav-item"> <a href="#{{$active_section}}">Skip to Main Content</a></li>
                    <li class="nav-item resizable"> <a href="Javascript:void(0);" id="increaseFont" >A+</a></li>
                    <li class="nav-item resizable"> <a href="Javascript:void(0);" id="resetFont" >A</a></li>
                    <li class="nav-item resizable"> <a href="Javascript:void(0);" id="decreaseFont">A-</a></li>
                    <li class="nav-item contra resizable"><i class="fa fa-adjust construle" aria-hidden="true"></i>
                        <!-- <STRONG ><sub>T</sub><sup>T</sup></STRONG>
                        <ul class="dropItm">
                            <li class="l_contrast">Contrast</li>
                            <li class="h_contrast">High Contrast</li>
                        </ul> -->
                    </li>
                     <li class="nav-item" id="printId"> <a href="Javascript:void(0);" onclick="printFile()">Print</a></li>
              </ul>



            </div>
          </div>

        </div>
        <div class="clearfix"></div>
    </div>
    <!-- Top Header Bar end-->
<script>




function logoutfn(){
	var z = confirm("Are you sure to logout?");
	if (z == true) {
		document.getElementById('logout-form').submit();
	}
}


</script>
<script>
$('a[href*="#"]').on('click', function (e) {
    e.preventDefault();

    $('html, body').animate({
        scrollTop: $($(this).attr('href')).offset().top
    }, 500, 'linear');
});


$(document).ready(function(){

   $(".cust_navbar_mob").click(function(){
      $("#top-header").slideToggle("fast","swing")
      //alert("rak")
   })
})


function printFile(){
    window.print();return false;
}

    $(document).ready(function(){
        var state =false;


     addCssfun = function () { addCSS('./resources/css/contract.css')},
     removefun = function() { $('#cont_id').remove();};

 $(".contra").click(function(){
   // state=!state;
   state = !state;
   //var Val = localStorage.getItem(state);
   //alert()
     if(!state){
        removefun();
        $('.construle').css('color','#fff')
      //  alert("state if  "+state);
     } else {
        addCssfun();
        $('.construle').css('color','#ff8b0c');
      //  alert("state else  "+state)
     }

  });


    //     $('.h_contrast').click(function(){
    //        ;
    //     })

    // $('.l_contrast').click(function(){
    //     $('#cont_id').remove();
    // })

    // $('#increaseFont').click(function() {
    //     $('body').css("font-size", function() {
    //         return parseInt($(this).css('font-size')) + 18 + 'px';
    //     });
    // });
  $("#increaseFont").click(function() {
    var originalFontSize = $(resize).css('font-size');
    //alert("originalFontSize  "+originalFontSize)
    var originalFontNumber = parseFloat(originalFontSize, 10);
    var newFontSize = originalFontNumber + 1;
    $(resize).css('font-size', newFontSize);
    return false;
  });



    var resize = new Array('p,a', '.resizable');
  resize = resize.join(',');

  //resets the font size when "reset" is clicked
  var resetFont = $(resize).css('font-size');

  $("#resetFont").click(function() {
    $(resize).css('font-size', resetFont);
    $('.log_reg a').css('font-size', '12px');
    $('.top_head_item a').css('font-size', '12px');
    $('.panel-title a').css('font-size', '18px');
    $('p').css('font-size', '14px');
    $('body').css('font-size', '14px');


    return false;


  });


  $("#decreaseFont").click(function() {
    var originalFontSize = $(resize).css('font-size');
    var originalFontNumber = parseFloat(originalFontSize, 10);
    var newFontSize = originalFontNumber -1;
    $(resize).css('font-size', newFontSize);
    return false;
  });


})
// Include CSS file
        function addCSS(filename){
        var head = document.getElementsByTagName('head')[0];
        var style = document.createElement('link');
        style.href = filename;
        style.type = 'text/css';
        style.id   ='cont_id'
        style.rel = 'stylesheet';
        head.append(style);

        }

</script>


    <!-- Header -->
        @include('layouts.header')
    <!-- Header end -->

    <!-- Content section -->
        @yield('content')


    <!-- Content section end-->

    <!-- Footer -->
        @include('layouts.footer')
    <!-- Footer end-->

</div>

<script>
$(document).ready(function(){
    var assessId = $('#top-header_web').find('.log_reg').html();
        $('#top-header').append(assessId);
})

</script>

<script >

$(document).ready(function(){



// $('.slides li>a').click(function() {
//     var linkdata="";
//    linkdata = $(this).attr('data-link');





//   var html="";


//     html =  '<div id="dynamicModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">';
//     html += '<div class="modal-dialog">';

//     html += '<div class="modal-content">';
//     html += '<div class="modal-header">';

//     html += '<h4>External site alert</h4>'
//     html += '</div>';
//     html += '<div class="modal-body">';
//     html += 'This link shall take you to a webpage outside';
//     html += ' ';
//     html += '<strong id="textlink">'+ linkdata +'</strong>';;
//     html += '. For any query regarding the contents of the linked page, please contact the webmaster of the concerned website.';
//     html += '</div>';
//     html += '<div class="modal-footer">';
//     html += '<div class="modal-footer linkchange">';
//     html +='<a href="" class="btn btn-primary btn_custyes">Yes</a>';
//      html += '<a class="btn  btn_custno" data-dismiss="modal">No</span></a>';
//      html += '</div>';
//     html += '</div>';
//     html += '</div>';
//     html += '</div>';


//     $("#textlink").text(linkdata);
//      $(".linkchange a").attr('href',linkdata);
//     $('body').append(html);
//     $("#dynamicModal").modal();
//     $("#dynamicModal").modal('show');

// });

// $('.btn_custyes').click(function(){
//     alert("rak");
//     ("#dynamicModal").modal('hide');

// })
// function gosite(url){

//     $("#dynamicModal").modal('hide');

// }


//    $(".btn_custno").click(function(){
//     $('body').remove(html);
//    })


})



</script>

</body>
</html>
