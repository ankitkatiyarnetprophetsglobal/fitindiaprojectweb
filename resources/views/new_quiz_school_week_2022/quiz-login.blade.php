<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>PKL – Fit India School Week 2022 Quiz Login</title>
    <style>
    body {
        font-family: 'Roboto', sans-serif;
        font-size: 0.8rem;
        line-height: 1.5em;
        background: linear-gradient(to left top, #30b3c1, #0094bb, #0073b0, #00509b, #332979);
        width: 100%;;
        overflow:hidden;


        
        /* background:url('./resources/imgs/quiz/bg2.jpg') no-repeat; */

       
    }

    h1,
    h2,
    h3 {
        font-weight: 600;
        margin-top: 30px;
        margin-bottom: 20px;
    }

    h1 {
        font-size: 20px;
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

    .card {
        box-shadow: 0 5px 15px rgb(0 0 0 / 15%);
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .form-control {
        font-size: 0.8rem;
    }

    .invalid-feedback {
        font-size: inherit;
    }

    #main-footer {
        text-align: center;
        color: #999;
    }

    #main-footer p {
        font-size: 12px;
        color:#fff;
    }
    .form-group {
    margin-bottom: .4rem;
}
.card{position: relative;}
.bg_bk{
    text-align: center;
    background: #1b51ef;
    padding: 5px;
    background-image: linear-gradient(to right bottom, #68acff, #4797ff, #2681ff, #0c6afc, #1b4ff4);
}
#site-landing {
      position: relative;
      width: 100%;
      /* height: 100%;
      width: 100%; */
      background-color: rgb(30, 30, 30);
    }
.card{
    border: 0px solid rgba(0,0,0,0);
    /* text-align: center;
    background: #1b51ef;
    padding: 5px;
    background-image: linear-gradient(to right bottom, #68acff, #4797ff, #2681ff, #0c6afc, #1b4ff4); */
}
.card-body{
    background: #f9f9f9;
}
.height100{
    height:100vh;
}
    </style>
</head>

<body>



    <div class="container ">
      <div id="site-landing"></div>
      <div class="row d-flex justify-content-center align-items-center height100">
            <div class="col-sm-8  col-md-4  ">
                <!--<p class="description"></p>-->
                <div class="card ">
                     <div class="bg_bk" style="display: inline-flex;  justify-content:center;">
                        <div style="height:85px; width:85px; display:flex; justify-content:center; align-items:center; border-radius:50%; background-color:white;">
                            <img src="resources/imgs/fit-india_logo.png" class="fluid-img" style="display:inline-flex; width:50px; justify-content:center; align-items:center;"/>
                        </div>
                     </div>
                     
                    <div class="card-body">
                        <!-- <p class="description text-lg-right"></p>-->
                        <form class="form-example" action="{{ route('quiz-login-form-post') }}" method="post">
                            @csrf
                            <h1 class="mt-0 text-center">PKL – Fit India School Week 2022 Quiz Login</h1>
                            <p class="description">
							@if(session()->has('success'))
								<div class="alert alert-success">
									{{ session()->get('success') }}
								</div>
							@endif
							@if(session()->has('error'))
								<div class="alert alert-danger">
                                    {{__('Error!')}}<br/>
									{{ session()->get('error') }}
								</div>
							@endif
							
							</p>


                            <p class="description"></p>

                            {{-- <input type="hidden" value="5" name="role" /> --}}

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control email @error('email') is-invalid @enderror"
                                    id="name" name="email" value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password"
                                    class="form-control password @error('password') is-invalid @enderror" id="password"
                                    name="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>



                            <button type="submit" class="btn btn-primary btn-block mt-3">Submit</button>
                            <p class="description text-center mt-2 mb-1 pt-2">Do not have Account? <a
                                    href="{{ route('register') }}"> Register </a></p>
                                    <p class="description text-center mt-2 mb-1 pt-2">Go to Home <a
                                        href="{{ route('home') }}"> Home </a></p>
                                    <p class="description text-center mt-2 mb-1 pt-2"><a
                                        href="{{ url('resources/pdf/school-week-how-to-register.pdf') }}" target="_blank">How To Register ?</a></p>

                        </form>

                    </div>
                </div>
                <div id="main-footer" class="mt-2 pt3">
                    <div class="footer_Flex">
                        <p>© 2021 Sports Authority of India. All rights reserved </p>
                    </div>
                </div>
            </div>

        </div>
      
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
     <!-- <script src="resources/js/polygonizr.js"></script>
    <script>
    let $sitelading = $('#site-landing');
    $sitelading.polygonizr();

    // Update size.
    $(window).resize(function () {
      $sitelading.polygonizr("stop");
      $sitelading.polygonizr({
        canvasHeight: $(this).height(),
        canvasWidth: $(this).width()
      });

      $sitelading.polygonizr("refresh");
    });
  </script> -->
</body>

</html>