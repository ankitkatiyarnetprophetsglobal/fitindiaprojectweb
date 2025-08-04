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

    <style>
      #footer_ab{position:absolute;bottom:0;width:100%;}
      .head-rw{box-shadow: 0 1px 10px -5px;}
      .bg_vaild{
        background: url("http://103.65.20.170/fitind/resources/imgs/pattern/img2.jpg") top center repeat;
   
    }
    .header {
     padding: 0 0 5px 0;
    }

      </style>
</head>
<body class="bg_vaild">
 <div class="container-fluid">
    <div class="header  on-print shadow">
        <div class="head-rw">
          <div class="row">
            <div class="col-3">
              <a href="home" class="fit-logo">
                <img src="{{asset('resources/imgs/fit-india_logo.png') }}" alt="Fit India"> 
              </a>
            </div>
            <div class="col-6">
              <span class="gov-logo">
              <a class="getlink " data-link="https://yas.nic.in/" href="javascript:void(0);">
                <img src="{{asset('resources/imgs/gov_logo.png') }}" alt="Government of India">
              </a>
              </span>
            </div>
            <div class="col-3 text-right">
            <a class="getlink sai-logo" data-link="https://sportsauthorityofindia.nic.in/" href="javascript:void(0);" class="sai-logo">              
               <img src="{{asset('resources/imgs/sai_trans_logo_new.jpg') }}" alt="SAI">
             </a>
           </div> 
           <!-- <a href="javascript:onClick=doModal('https://sportsauthorityofindia.nic.in/')" class="sai-logo">  -->
          </div>
        </div>
    </div>
  </div>



  <!-- Content Wrapper. Contains page content -->
    @yield('content')
  <!-- /.content-wrapper -->
<footer class="footer" id="footer_ab" > 
 <div id="main-footer">
            <div class="footer_Flex"> 
                 <p>© 2021 Sports Authority of India. All rights reserved </p>
                 <p>Last updated on 
                    @php echo date('F jS,Y', strtotime(App\Http\Controllers\GeneralController::updatedon())); @endphp   | No of Visitors: 
                    <span>
                      @php echo App\Http\Controllers\GeneralController::sitecounter(); @endphp    
                    </span>
                  </p>                
              </div>                        
        </div>
</footer>
</body>
</html>
