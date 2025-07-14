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
	<link rel="stylesheet" href="{{ asset('resources/ncss/result.css') }}">
    <title>Road to Tokyo Quiz Result</title>
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
        overflow: hidden;
    }
    .card-body{padding-top:0;}
    #main-footer {
        text-align: center;
        color: #999;
    }

    #main-footer p {
        font-size: 12px;
    }
    .txt_upper{text-transform: capitalize;}
    .bg_q1{color:#13418c;margin:-1px;}
    .bg_q2{color:#ff8000;margin:-1px;}
    .bg_q3{color:#129d12;margin:-1px;}
    .p_size{font-size:28px;}

    .result h1 {   
            font-size: 2.3rem;
            border-top-left-radius: 7px;
            border-top-right-radius:7px;
    }
	
    </style>

</head>

<body>
    <main class="qz-bx mt-2 pt-4 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                 
                        <div class="card-body pl-0 pr-0">
						

                           <div class="container-fluid no-padding ">
									<div class="fixed_c ">
									  <div class="row ">
										<div class="col-sm-12 col-md-12 col-lg-12 ">
										  <div class="result">
											<h1>{{__('sentence.quiz_result_heading')}}</h1>
										  </div>
										</div>
									  </div>
									</div>
   
								<?php
									$score = 0;
									foreach($results as $result){
										if($quesfilled[$result->id] == $result->ans){ 
										 $score += 1;
										}
									} 
								
									$per = ($score / 10) * 100; 
								 
								 ?>
											
										<div class="p_area">
											<h4>{{__('sentence.your_score_heading')}}</h4>
											<div class="progress md-progress my-0" style="height: 20px">
												  <div class="progress-bar" role="progressbar" style="width: <?php echo ceil($per);?>%; height: 20px" aria-valuenow="<?php echo ceil($per);?>" aria-valuemin="0" aria-valuemax="100"><?php echo ceil($per);?>%</div>
											</div>	
											
												<?php if(empty($per)){ ?>
													<div style="text-align:center">{{__('sentence.you_score_text')}} 0 </div>
												<?php }else{ ?>
													<div style="text-align:center"> {{ $score }} {{__('sentence.you_score_outof_text')}} 10</div>
												<?php } ?>
										</div>
										
										
										<div class="mt-4"> &nbsp;</div>
										<div class=" mt-2" style="text-align:center;font-size: 18px;">
											{{__('sentence.congragulation_text')}} <span class="txt_upper"><strong>{{ $name }}  </strong></span> {{__('sentence.congragulation_text_1')}}  {{__('sentence.congragulation_text_2')}} {{__('sentence.congragulation_text_3')}} .
											
											<p class="mt-0 mb-0 p-0" style="font-size: 18px;">{{__('sentence.i_cheer_for_team_india_text')}} </p>
                                            <p class="text-center p_size">
                                                <strong>
                                                    <span class="bg_q1">#{{__('sentence.cheer_text')}}</span>
                                                    <span class="bg_q2">4</span> 
                                                    <span class="bg_q3">{{__('sentence.india_text')}}</span>
                                                </strong>
                                            </p>

										</div>
										
										<div class="p_area mt-2"> &nbsp; </div>
										<div class="p_area mt-2 d-flex  justify-content-around">
											<?php $nm = array('name' => $name ); ?>
                                            <a class="btn btn-success mr-3 btn-back" href="{{ route('roadtotokyo',$encrypted) }}"> {{__('sentence.go_to_home_text')}} </a>
											<a class="btn btn-success mr-3 btn-back" href="{{ route('tokyoquizcert',$nm) }}">{{__('sentence.download_certificate_text')}}</a> 

										</div>
										<!-- <div class="p_area mt-2"> &nbsp; </div> -->
										
										<!-- <div class="p_area mt-2">
											
										</div> -->
				 
				  
				  
       
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


</body>

</html>