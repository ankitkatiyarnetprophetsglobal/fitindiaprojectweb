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
    <title>रोड टू टोक्यो 2020 प्रश्नोत्तरी परिणाम</title>
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
    .txt_upper{text-transform: capitalize;}
    .bg_q1{color:#13418c;margin:-1px;}
    .bg_q2{color:#ff8000;margin:-1px;}
    .bg_q3{color:#129d12;margin:-1px;}
    .p_size{font-size:26px;}
    .p_sizeP{
        font-size:18px;
    }

    .result h1 {
   
    font-size: 2.3rem;
    border-top-left-radius: 10px;
    border-top-right-radius:10px;
    }
    #main-footer {
        text-align: center;
        color: #999;
    }

    #main-footer p {
        font-size: 12px;
    }
    </style>

</head>

<body>
    <main class="qz-bx mt-2 pt-4 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                 
                        <div class="card-body  pl-0 pr-0">

                           <div class="container-fluid no-padding ">
									<div class="fixed_c ">
									  <div class="row ">
										<div class="col-sm-12 col-md-12 col-lg-12 ">
										  <div class="result">
											<h1>रोड टू टोक्यो 2020 प्रश्नोत्तरी परिणाम</h1>
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
											<h4>आपका स्कोर</h4>
											<div class="progress md-progress my-0" style="height: 20px">
												  <div class="progress-bar" role="progressbar" style="width: <?php echo ceil($per);?>%; height: 20px" aria-valuenow="<?php echo ceil($per);?>" aria-valuemin="0" aria-valuemax="100"><?php echo ceil($per);?>%</div>
											</div>	
											
												<?php if(empty($per)){ ?>
													<div style="text-align:center"  class="p-2">आपका स्कोर 10 में से 0 है </div>
												<?php }else{ ?>
													<div style="text-align:center" class="p-2"> आपका स्कोर 10 में से {{ $score }} है</div>
												<?php } ?>
										</div>
										
										
										<!-- <div class="mt-4"> &nbsp;</div> -->

										<div class=" mt-2" style="text-align:center;font-size: 20px;">
											<p class="p-0 text-center p_sizeP" ><strong>बधाई हो <span class="txt_upper"><strong>{{ $name }} &nbsp;!!</strong></span> "रोड टू टोक्यो 2020" प्रश्नोत्तरी में भाग लेने के लिए। </p>
											<p class="p_sizeP m">मैं टीम इंडिया के लिए प्रोत्साहन करता हूं </p>
                                            <p class="text-center p_size">
                                                <strong>
                                                    <span class="bg_q1">#cheer</span>
                                                    <span class="bg_q2">4</span> 
                                                    <span class="bg_q3">India</span>
                                                </strong>
                                            </p>
										</div>


										
										<div class="p_area mt-2"> &nbsp; </div>
										<div class="p_area mt-2 d-flex  justify-content-around">
											<?php $nm = array('name' => $name ); ?>
                                            <a class="btn btn-success mr-3 btn-back" href="{{ route('roadtotokyohn',$encrypted) }}">  होम पेज पर  जाएँ  </a>
											<a class="btn btn-success mr-3 btn-back" href="{{ route('tokyoquizcert',$nm) }}" target="_blank" > डाउनलोड सर्टिफिकेट</a> 
										</div>
										<!-- <div class="p_area mt-2"> &nbsp; </div>
										
										<div class="p_area mt-2">
											
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