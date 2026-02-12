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
    <script src="{{ asset('resources/js/jquery.min.js')}}"></script>
    <script src="{{ asset('resources/js/popper.min.js')}}"></script>
<script src="{{ asset('resources/js/bootstrap.min.js')}}"></script>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        font-size: 14px;
        line-height: 1.5em
    }

    .main-poster {
        width: 100%;
    }

    h1,
    h2,
    h3 {
        font-weight: 600;
        margin-top: 30px;
        margin-bottom: 20px;
    }

    h1 {
        font-size: 24px;
    }

    h2 {
        font-size: 18px;
    }

    h3 {
        font-size: 16px;
    }

    p {
        font-size: 14px;
        line-height: 1.5em;
    }

    figure {
        margin-bottom: 30px;
    }

    ul {
        list-style: lower-roman;
        line-height: 2em;
    }

    ul ul {
        list-style: square;
    }

    .card {
        box-shadow: 0 5px 15px rgb(0 0 0 / 15%);
        border-radius: 0.5rem;
        /*overflow: hidden;*/
    }

    #main-footer {
        text-align: center;
        color: #999;
    }

    #main-footer p {
        font-size: 12px;
    }
	.quiz-lang {
		position: absolute;
		top: 0;
	}
    .form-group:last-child {
        margin-bottom: 0rem;
    }


    </style>


</head>
<body >
     <?php
	if(!empty($_GET['m'])){ ?>
	<style>
	#top-header,.header, .menu-bar, #footer_ab, #top-header_web, .cust_navbar_mob { display:none; }
	</style>
	<?php } ?>
<div class="container-fluid" id="@yield('pageid')">


    <div id="top-header">
    </div>
    <div id="top-header_web" class="mob_flex">


            @php
                $active_section = request()->segment(count(request()->segments()));
                $active_section_id = "id='$active_section'";
            @endphp
            <div class="forMob on-print">
              <ul>
			  <?php //print_r(Auth::guard('quiz')->user()->id); ?>
                        @if(!Auth::guard('quiz')->user()->id)

                                <li class="nav-item l_area log">
                                @if (Route::has('login'))
                                    <span><a class="nav-link" href="{{ route('quiz-partner-login-form') }}">{{ __('Login') }} </a></span>
                                @endif
                                </li>
                                <li class="nav-item l_area reg">
                                @if (Route::has('register'))
                                    <span><a class="nav-link" href="{{ route('quiz-partner-form') }}">{{ __('Register') }}</a></span>
                                    @endif
                                </li>

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('dashboard') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                    {{ Auth::guard('quiz')->user()->name }}
                                </a>

                                <div class="dropdown-menu  top-bar-li cus_drop " aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item last_child"  href="{{ route('quiz.logout') }}"  data-toggle="modal" data-target="#logoutDivId">
									{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('quiz.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endif

                </ul>
              </div>




        </div>
       <div class="clearfix"></div>
    </div>
    <!-- Top Header Bar end-->
    <div class="modal fade" id="logoutDivId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title logohead_value" id="exampleModalLabel" > Are you sure you want to logout?</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button> -->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary logoutid">Yes</button>
            </div>
            </div>
        </div>
    </div>








    <!-- Content section -->
        @yield('content')


    <!-- Content section end-->



</div>

<script>

$(document).ready(function(){
    $('.logoutid').click(function(){
        document.getElementById('logout-form').submit();
    })
})


</script>

</body>
</html>
