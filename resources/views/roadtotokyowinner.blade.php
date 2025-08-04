<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <title>Road to Tokyo Quiz winners</title>
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

    img.winner-img {
        width: 25px;
    }


    .info-box-content {
        margin-bottom: 15px;
        margin-top: 15px;

    }

    .winner-grid.card-body {
        padding-bottom: 0px;
        position: relative;
    }

    .winner-grid .card {
        margin-bottom: 40px;
    }

    .info-box-name,
    .info-box-number {
        text-align: center;
    }

    .info-box {
        padding: 1.25rem;
    }

    .info-box-date,
    .info-box-name,
    .info-box-number {
        display: block;
    }

    .info-box-name {
        font-weight: 600;
        margin-top: 20px;
    }

    .usr-dtls {}

    .info-box-icon {
        position: absolute;
        top: -20px;
        left: 15px;
        /*display: inline-block;*/
        border: 1px solid rgba(0, 0, 0, .125);
        padding: 10px;
        border-radius: 50px;
        background: #fff;
        box-shadow: 0 3px 8px rgb(0 0 0 / 15%);
    }

    .winner-grid .today-card.card {
        box-shadow: 0 5px 15px rgb(1 91 169 / 30%);
        border: 2px solid rgb(1 91 169 / 20%);
    }

    .today-card .info-box-icon {
        border: 1px solid rgb(1 91 169 / 20%);
        box-shadow: 0 3px 8px rgb(1 91 169 / 20%);
    }

    .today-card .info-box-name {
        font-size: 20px;
        margin-bottom: 10px;
        margin-top: 30px;
        color: #015aa8;
    }

    .today-card .info-box-number {
        font-size: 16px;
        margin-bottom: 0px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .today-card .info-box-date {
        font-weight: 600;
        text-transform: uppercase;
        /*border: 1px solid rgb(1 90 168 / 7%);*/
        border-radius: 100px;
        padding: 0px 10px;
        color: #015aa8;
        background: rgb(1 90 168 / 14%);

    }

    .today-card .info-box-date span {
        display: inline-block;
        margin-top: 2px;
    }

    .info-box-date {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 12px;
    }
    .backtohome { 
		position: absolute;
        top: -15px;
        z-index: 10;
	}
    .btn-back {
    background-color: #e2e6ea;
    border-color: #dae0e5;
    /*position: absolute;
    top: -15px;
    left: 20px;*/
    border-radius:50px;
    font-size: 12px;
    padding: 5px 15px;
 }
 .custom-btn, .custom-btn:hover {
     border-radius:50px;
     border: none;
     font-size: 14px;
     padding: 5px 15px;
 }
 figure {
    overflow:hidden;
    border-radius: 0.5rem 0.5rem 0 0;
}
    @media (max-width: 575.98px) { 
        h1 { 
            text-align:center; 
            font-size:18px;           
        }
        .backtohome {
            position: relative;
            top: auto;
            z-index: 10;
            text-align: center;
}
    }
	
	

    </style>

</head>

<body>

    <main class="qz-bx mt-2 pt-4 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <figure class="mb-0"><img src="{{ $quizimgs->luckywinnerimage }}" class="main-poster img-fluid"
                                alt="Tokyo Quiz" />
                        </figure>

                        <div class="card-body winner-grid">
                        <div class="backtohome"><a class="btn btn-light btn-back custom-btn" href="{{ route('roadtotokyo',$encrypted) }}"> < Go Back Home <a></div>
                            <h1 class="mt-lg-3 pb-lg-3"> {{ $userdata->name }} Road to Tokyo 2020 lucky winners
                            </h1>
							
							@if(!empty($winners[0]))

                            <div class="row">


                                <div class="info-box-content col-sm-12 col-md-6 offset-md-3">
                                    <div class="card today-card">
                                        <div class="card-body">
                                            <div class="info-box-icon">
                                                <img alt="winner-img" src="{{ asset('resources/images/prize.png') }}"
                                                    class="winner-img" />
                                            </div>
                                            <div class="usr-dtls">
                                                <div class="info-box-date"><span>Yesterday</span></div>
                                                <div class="info-box-name">{{ ucwords($winners[0]->name) }} </div>
                                                
												
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							@else
							<div class="row">
							 <div class="info-box-content col-sm-12 col-md-4 offset-md-4">
							 Results will be declared next day. Please come back tomorrow.
							</div>
                            </div>
							@endif
							
                            <div class="row scroll-dv">
                                <?php  $i=0; 
								foreach($winners as $winner){
								 if($i == 0){ 
								 
								 }else{ ?>
								 
								<div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="info-box-icon">
                                                <img alt="winner-img" src="{{ asset('resources/images/prize.png') }}"
                                                    class="winner-img" />
                                            </div>
                                            <div class="info-box-date"><?php echo date("jS F Y", strtotime( $winner->winnerdate ) ); ?> </div>
                                            <div class="info-box-name">{{ ucwords($winner->name) }} </div>
                                           
                                        </div>
                                    </div>
                                </div>
								<?php
								 }
								$i++;
								}
								?>

                                
								
									
                            </div>


							
						

                        </div>


                    </div>
                </div>

            </div>



            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div id="main-footer" class="mt-5 pt3">
                        <div class="footer_Flex">
                            <p>© 2021 Sports Authority of India. All rights reserved </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script> -->
</body>

</html>