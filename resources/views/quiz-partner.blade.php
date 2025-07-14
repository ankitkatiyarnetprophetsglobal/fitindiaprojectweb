<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Quiz Partner</title>
    <style>
    body {
        font-family: 'Roboto', sans-serif;
        font-size: 0.8rem;
        line-height: 1.5em;
        background-image: linear-gradient(to left top, #30b3c1, #0094bb, #0073b0, #00509b, #332979);
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
      height: 100%;
      width: 100%;
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

    <div class="container">
    <div id="site-landing"></div>

        <div class="row d-flex justify-content-center align-items-center height100">
            <div class="col-sm-8  col-md-6 ">
                <!--<p class="description"></p>-->
                <div class="card mt-3   ">
                     <div class="bg_bk">
                         <img src="resources/imgs/quiz/quizlogo.png" class="img-fluid"/>
                     </div>
                    <div class="card-body">
                        <form class="form-example" action="{{ route('quiz-partner') }}" method="post">
                            @csrf
                            <h1 class="mt-0 text-center">Become a Quiz Partner</h1>
                            <!-- <p class="description"></p>
                            <p class="description"></p> -->

                            <input type="hidden" value="5" name="role" />
                            <div class="form-group">
                                <label for="name">Organisation Name</label>
                                <input type="text" class="form-control name @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
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
                                <label for="phone">Mobile Number</label>
                                <input type="text" class="form-control phone @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
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

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control password " id="password_confirmation"
                                    name="password_confirmation">

                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-3">Submit</button>
							<p class="description text-center mt-2 mb-1 pt-2">If already have an account? <a
                                    href="{{ route('quiz-partner-login-form') }}"> Login </a> </p>

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