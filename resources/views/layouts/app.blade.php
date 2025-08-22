<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="twitter:card" value="summary">

    <!-- CSRF Token  -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="msapplication-TileImage" content="{{ asset('resources/images/fit-fav.ico') }}" />
    <title>@yield('title')</title>
    <meta name="google-site-verification" content="2g4kCQ7eO2Ntl8CxtdYM6mLLsQz4CkmI1qU4GmnaaZA" />
    <link rel="icon" href="{{ asset('resources/images/fit-fav.ico') }}" sizes="32x32" />
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
    <script src="{{ asset('resources/js/bootstrap.min.js')}}"></script>

    <!-- Raj -->
    <style>
        .close {
            position: absolute;
            right: -30px;
            top: 0;
            z-index: 999;
            font-size: 2rem;
            font-weight: normal;
            color: #fff;
            opacity: 1;
        }
    </style><!-- Raj close -->


</head>

<body>
    <?php
    if (!empty($_GET['m'])) { ?>
        <style>
            #top-header,
            .header,
            .menu-bar,
            #footer_ab,
            #top-header_web,
            .cust_navbar_mob {
                display: none;
            }
        </style>
    <?php } ?>
    <div class="container-fluid" id="@yield('pageid')">
        <div class="cust_navbar_mob">
            <p>Accessibility Options</p>
        </div>
        <!-- Top Header Bar -->
        <div id="top-header">
        </div>
        <div id="top-header_web" class="mob_flex">
            <!-- <div class="top-header_Flex"> -->

            <!-- Raj -->
            <div class="top_head_item on-print">
                <!-- <a href="schooldashboard">Fit India Dashboard</a>   -->
                <!-- <a  class="btn btn-primary video-btn" id="" data-toggle="modal" data-target="#videoId" data-src="https://fitindia.gov.in/resources/videos/Anthem_29th_June.mp4" >
                     Official Theme Song - Tokyo 2020 Olympics
                </a> -->
                <!--  <a  class="btn btn-primary video-btn" href="{{ route('freedom-run-4.0') }}">{{ __('home_content.Freedomrun')}}
               <a  class="btn btn-primary video-btn" href="https://fitindia.gov.in/fit-india-freedom-rider-cycle-rally-2022">Fit India Freedom Rider-Cycle Rally 2022</a>
                </a> -->



                <!-- <button type="button" class="btn btn-primary video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/Jfrjeg26Cwk" data-target="#myModal"> -->
                <!-- <a class="getlink" data-link="https://drive.google.com/drive/folders/1jFcbOqYHtrFr7giyoULoru0UWBj4Mrl7" href="javascript:void(0);">Download : Fitness ki dose Aadha Ghanta Roz</a>              -->
            </div><!-- Raj close -->

            <!-- <div class="top_head_item on-print"> 
                <a style="background-color:#008000;" href="https://fitindia.gov.in/road-to-tokyo-2020/Ngwjw1F8RQ+K9gjvFTXYqg==" target="_blank">Road to Tokyo 2020 Quiz </a> 
            </div> -->


            @php
            $active_section = request()->segment(count(request()->segments()));
            $active_section_id = "id='$active_section'";
            @endphp
            <div class="forMob on-print">
                <ul>
                    @guest

                    <li class="nav-item l_area log">
                        @if (Route::has('login'))
                        <span><a class="nav-link" href="{{ route('login') }}">{{ __('home_content.Login')}} <?php //{{ __('Login') }} 
                                                                                                            ?> </a></span>
                        @endif
                    </li>
                    <li class="nav-item l_area reg">
                        @if (Route::has('register'))
                        <span><a class="nav-link" href="{{ route('register') }}">{{ __('home_content.Register')}} <?php //{{ __('Register') }} 
                                                                                                                    ?></a></span>
                        @endif
                    </li>

                    @else
                    <li class="nav-item dropdown">
                        <?php
                        $uname = Auth::user()->name;
                        $scname = htmlspecialchars_decode($uname);
                        ?>
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('dashboard') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $scname }}
                        </a>

                        <div class="dropdown-menu  top-bar-li cus_drop " aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('dashboard') }}">
                                {{ __('home_content.My_account')}} <?php //{{ __('My Account') }} 
                                                                    ?>
                            </a>
                            @if(Auth::user()->role == 'school')
                            <a class="dropdown-item" href="{{ url('school-profile') }}">
                                {{ __('home_content.Edit_Profile')}} <?php // {{ __('Edit Profile') }} 
                                                                        ?>
                            </a>
                            @else
                            <a class="dropdown-item" href="{{ url('edit-profile') }}">
                                {{ __('home_content.Edit_Profile')}} <?php // {{ __('Edit Profile') }} 
                                                                        ?>
                            </a>
                            @endif
                            <a class="dropdown-item last_child" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutDivId">
                                <!--
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" 
                                                     -->
                                {{ __('home_content.Logout')}}
                                <?php // {{ __('Logout') }} 
                                ?>
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

                        <!--  <li class="nav-item"> <a href=""  data-toggle="modal" data-target="#logoutDivId">modal</a></li> -->
                        <li class="nav-item"> <a href="#{{$active_section}}">{{ __('home_content.Skip_to_Main_Content')}} <!--Skip to Main Content--></a></li>
                        <li class="nav-item resizable"> <a href="Javascript:void(0);" id="increaseFont">A+</a></li>
                        <li class="nav-item resizable"> <a href="Javascript:void(0);" id="resetFont">A</a></li>
                        <li class="nav-item resizable"> <a href="Javascript:void(0);" id="decreaseFont">A-</a></li>
                        <li class="nav-item contra resizable"><i class="fa fa-adjust construle" aria-hidden="true"></i>
                            <!-- <STRONG ><sub>T</sub><sup>T</sup></STRONG>
                        <ul class="dropItm">
                            <li class="l_contrast">Contrast</li>
                            <li class="h_contrast">High Contrast</li>
                        </ul> -->
                        </li>
                        <li class="nav-item" id="printId"> <a href="Javascript:void(0);" onclick="printFile()">{{ __('home_content.Print')}}</a></li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('dashboard') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('home_content.Language')}} </a>
                            <div class="dropdown-menu  top-bar-li cus_drop cus_drop_EH " aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('lang/en')}}">{{ __('home_content.English')}}</a>
                                <a class="dropdown-item" href="{{ url('lang/hn')}}">{{ __('home_content.Hindi')}} </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- Top Header Bar end-->


    <div class="modal fade" id="logoutDivId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title logohead_value" id="exampleModalLabel"> Are you sure you want to logout?</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button> -->
                </div>
                <div class="modal-body">
                    <p class="logclass">Before you go...</p>
                    <p class="logcontent">Stay up to date with fresh fitness content<br> <strong>&</strong> <br>event related informations.</p>
                    <h1 class="followus">Follow Us</h1>
                    <p class="logclass"> On our social networks</p>
                    <div class="logoutarea">
                        <!-- <ul class="s_link logoutSocial">
                            <li>
                                <a class="font_f f_c" href="https://www.facebook.com/FitIndiaOff/" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a class="font_f t_c" href="https://twitter.com/FitIndiaOff" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a class="font_f y_c" href="https://www.youtube.com/channel/UCQtxCmXhApXDBfV59_JNagA" target="_blank" rel="noopener noreferrer"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a class="font_f i_c" href="https://www.instagram.com/fitindiaoff/ " target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </li>

                        </ul> -->
                        <ul class="s_link logoutSocial">
                            <li>
                                <a class="font_f f_c"
                                    href="{{ route('redirect', ['url' => 'https://www.facebook.com/FitIndiaOff/']) }}"
                                    target="_blank"
                                    rel="noopener noreferrer">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a class="font_f t_c"
                                    href="{{ route('redirect', ['url' => 'https://twitter.com/FitIndiaOff']) }}"
                                    target="_blank"
                                    rel="noopener noreferrer">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a class="font_f y_c"
                                    href="{{ route('redirect', ['url' => 'https://www.youtube.com/channel/UCQtxCmXhApXDBfV59_JNagA']) }}"
                                    target="_blank"
                                    rel="noopener noreferrer">
                                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a class="font_f i_c"
                                    href="{{ route('redirect', ['url' => 'https://www.instagram.com/fitindiaoff/']) }}"
                                    target="_blank"
                                    rel="noopener noreferrer">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary logoutid">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.logoutid').click(function() {
                //alert("rak")
                document.getElementById('logout-form').submit();
            })
        })


        function logoutfn() {
            // var z = confirm("Are you sure to logout?");
            // if (z == true) {

            // }
        }
        //logoutfn();
    </script>
    <script>
        $('a[href*="#"]').on('click', function(e) {
            e.preventDefault();

            $('html, body').animate({
                scrollTop: $($(this).attr('href')).offset().top
            }, 500, 'linear');
        });


        $(document).ready(function() {

            $(".cust_navbar_mob").click(function() {
                $("#top-header").slideToggle("fast", "swing")
                //alert("rak")
            })
        })


        function printFile() {
            window.print();
            return false;
        }

        $(document).ready(function() {
            var state = false;


            addCssfun = function() {
                    addCSS('./resources/css/contract.css')
                },
                removefun = function() {
                    $('#cont_id').remove();
                };

            $(".contra").click(function() {
                // state=!state;
                state = !state;
                //var Val = localStorage.getItem(state);
                //alert()
                if (!state) {
                    removefun();
                    $('.construle').css('color', '#fff')
                    //  alert("state if  "+state);
                } else {
                    addCssfun();
                    $('.construle').css('color', '#ff8b0c');
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
                var newFontSize = originalFontNumber - 1;
                $(resize).css('font-size', newFontSize);
                return false;
            });


        })
        // Include CSS file
        function addCSS(filename) {
            var head = document.getElementsByTagName('head')[0];
            var style = document.createElement('link');
            style.href = filename;
            style.type = 'text/css';
            style.id = 'cont_id'
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
    @include('layouts.footer1')
    <!-- Footer end-->

    </div>

    <!-- Raj -->
    <div class="modal fade" id="videoId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-xl modal-sm" role="document">
            <div class="modal-content">


                <div class="modal-body">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Raj close-->

    <script>
        $(document).ready(function() {
            var assessId = $('#top-header_web').find('.log_reg').html();
            $('#top-header').append(assessId);
        })
    </script>

    <script>
        $(document).ready(function() {





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
    <script>
        $(document).ready(function() {
            $('a').click(function() {
                var linkdata = "";
                linkdata = $(this).attr('data-link');
                var html = "";

                if ($(this).hasClass("getlink")) {
                    html = '<div id="dynamicModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">';
                    html += '<div class="modal-dialog">';

                    html += '<div class="modal-content">';
                    html += '<div class="modal-header">';

                    html += '<h4>External site alert</h4>'
                    html += '</div>';
                    html += '<div class="modal-body">';
                    html += 'This link shall take you to a webpage outside';
                    html += ' ';
                    html += '<strong id="textlink">' + linkdata + '</strong>';;
                    html += '. For any query regarding the contents of the linked page, please contact the webmaster of the concerned website.';
                    html += '</div>';
                    html += '<div class="modal-footer linkchange">';
                    html += '<a class="btn  btn_custno" data-dismiss="modal">No</span></a>';
                    html += '<a class="btn btn-primary btn_custyes"  href="' + linkdata + '"  target="_blank"  >Yes</a>';
                    html += '</div>'; // content
                    html += '</div>'; // dialog
                    html += '</div>'; // footer
                    html += '</div>'; // modalWindow

                    $("#textlink").text(linkdata);
                    $(".linkchange a").prop('href', linkdata);
                    $('body').append(html);
                    $("#dynamicModal").modal();
                    $("#dynamicModal").modal('show');
                    $(".btn_custyes").bind("click", function() {
                        $("#dynamicModal").modal('hide');
                    });
                }
            });
            $(".btn_custno").click(function() {
                $('body').remove(html);
            })
        })
    </script>

    <!-- Raj -->
    <script>
        $(document).ready(function() {

            // Gets the video src from the data-src on each button

            var $videoSrc;
            $('.video-btn').click(function() {
                $videoSrc = $(this).data("src");
            });




            // when the modal is opened autoplay it  
            $('#videoId').on('shown.bs.modal', function(e) {

                // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
                $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
            })



            // stop playing the youtube video when I close the modal
            $('#videoId').on('hide.bs.modal', function(e) {
                // a poor man's stop video
                $("#video").attr('src', "");
            })

        });
    </script>
    <!-- Raj -->

</body>

</html>