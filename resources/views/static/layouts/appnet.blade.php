<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="twitter:card" value="summary">

    <!-- CSRF Token  -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="msapplication-TileImage" content="{{ asset('resources/images/fit-fav.ico') }}" />
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('resources/images/fit-fav.ico') }}" sizes="32x32"  />
    <link rel="icon" href="{{ asset('resources/images/fit-fav.ico') }}" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('resources/images/fit-fav.ico') }}" />

    <!-- <link rel="stylesheet" href="{{ asset('resources/fonts/bootstrap.min.css') }}" media="screen"> -->
    <link rel="stylesheet" href="{{ asset('resources/css/dotnet_css/bootstrap.min.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('resources/css/font-awesome.css') }}" media="screen">

    <link rel="stylesheet" href="{{ asset('resources/css/dashboard.min.css') }}" media="screen">
    <!-- <link href="{{ asset('resources/css/print.min.css') }}" rel="stylesheet" media="all">   -->
    <link href="{{ asset('resources/css/dotnet_css/style.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('resources/css/responsive.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('resources/css/print.css') }}" rel="stylesheet" media="print">
    <link href="{{ asset('resources/css/appdotnet.css') }}" rel="stylesheet" >
    <link href="{{ asset('resources/css/appdotnetnew.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/appdotnetheader.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/khelo-india.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <script src="{{ asset('resources/Scripts/bootstrap-toggle.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="{{ asset('resources/js/jquery.min.js')}}"></script>
    <script src="{{ asset('resources/js/dotnet_js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" />
       <script async src="https://www.googletagmanager.com/gtag/js?id=UA-127986665-1"></script>

    <script>
        var baseurl = "{{ url('/') }}";
    </script>
    <style>
        .navbar {
            min-height: 0;
            margin-bottom: 0px;
            border: 1px solid transparent;
        }
    </style>

</head>
@yield('content')
<footer id="footermaster" runat="server">
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        </script>
    <!--footer-->
    <div id="footer" runat="server">
        <span id="footercont">{{ __('resourcemaster.label5') }}. {{ __('resourcemaster.label51') }}</span> <a href="#a" id="privacyfooter">{{ __('resourcemaster.label6') }}</a>
    </div>
    
</footer>
</html>

