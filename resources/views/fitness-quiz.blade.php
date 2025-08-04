<!DOCTYPE html>
<html lang="en">
<head>
  <title>FITNESS QUIZ</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('resources/ncss/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://cdn.iconmonstr.com/1.3.0/css/iconmonstr-iconic-font.min.css">
  <link rel="stylesheet" href="{{ asset('resources/ncss/global.css') }}">
  <link rel="stylesheet" href="{{ asset('resources/ncss/create.css') }}">
  <link rel="stylesheet" href="{{ asset('resources/ncss/style.css') }}">
  <link rel="stylesheet" href="{{ asset('resources/ncss/media_query_quiz.css') }}">
</head>
<body>
<?php
  //$top5data = DB::select("select a.organiser_name,b.email,b.id, sum(a.total_participant) as total_amount from freedomruns as a left join users as b on a.user_id=b.id  where a.role='organizer' group by a.organiser_name,b.email order by total_amount desc limit 0,7");
 //dd($fitness);die;onsubmit="return checkquiz()" {{ savefitnessquiz }}
?> 
<form id="question_quiz" name="question_quiz" action="" method="post">
 @csrf   
 @if ($errors->has('quesoption')) 
   <p style="color:red;">
    @foreach ($errors->get('quesoption') as $errormessage) 
      {{ $errormessage }}<br>
    @endforeach
   </p> 
@endif
   
  <div class="container-fluid no-padding" id="fixed-c">
   <input type="hidden" name="email" id="email" value="<?=!empty($_REQUEST['email']) ? $_REQUEST['email'] : ''?>" required >
    <div class="fixed_c"> 
      <div class="row stickshadow ">
        <div id="UpdatePanel1">
          <div class="row r-m  base_o">          
            <div class="col-sm-12 col-md-12 col-lg-12 rm-p-m"></div>
          </div>                  
          <input type="hidden" name="showpopup" id="showpopup">
        </div>
      </div>
    </div>
    <div class="page-content-inner">
	<div id="error-div" class="alert alert-danger" role="alert"></div>	
      <div class="row bg_c bg_c_r">	  
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="main-content">
            <div class="ques_d">Question:<span>1</span></div>
            <div class="seq_que">
              <h3><?php echo $fitness[0]['ques']; ?></h3>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 card_Flex_Area">
          <div class="card card_flex">
            <div class="card_flex_inner">
              <div>
                <svg id="Layer_1" x="20" y="30" height="30" viewBox="0 0 506.1 506.1" width="30">&lt; path d = 'm489.609
                  0h-473.118c-9.108 0-16.491 7.383-16.491 16.491v473.118c0 9.107 7.383 16.491 16.491
                  16.491h473.119c9.107 0 16.49-7.383 16.49-16.491v-473.118c0-9.108-7.383-16.491-16.491-16.491z'
                  /&gt;</svg>
              </div>
              <div class="r_txt"><?php echo $fitness[0]['opt1'];?></div>
            </div>
            <div>
              <label class="radiocontainer">
                <input type="radio"  class="form-check-input" name="quesoption[<?php echo $fitness[0]['id'];?>]" value="<?php echo $fitness[0]['opt1'];?>">
                <span class="checkmark" disabled=""></span>
                <span class="wrong_div"><i class="im im-x-mark"></i></span>
              </label>
            </div>
          </div>
          <div class="card card_flex">
            <div class="card_flex_inner">
              <div><svg id="layer_3" width="32" height="32" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15 .001l15 15-15 15-15-15 15-15z"></path>
                </svg></div>
              <div class="r_txt"><?php echo $fitness[0]['opt2'];?></div>
            </div>
            <div><label class="radiocontainer"> <input type="radio" id="choice2" class="form-check-input"
                  name="quesoption[<?php echo $fitness[0]['id'];?>]" value="<?php echo $fitness[0]['opt2'];?>"><span class="checkmark" disabled=""></span><span
                  class="wrong_div"><i class="im im-x-mark"></i></span></label></div>
          </div>

          <div class="card card_flex">
            <div class="card_flex_inner">
              <div><svg version="1.1" id="Layer_2" x="0px" y="0px" viewBox="0 0 512 512"
                  style="enable-background:new 0 0 512 512;" height="30" width="30" xml:="" space="preserve">
                  <path d="M256,0C115.39,0,0,115.39,0,256s115.39,256,256,256s256-115.39,256-256S396.61,0,256,0z"></path>
                </svg></div>
              <div class="r_txt"><?php echo $fitness[0]['opt3'];?></div>
            </div>
            <div><label class="radiocontainer"> <input type="radio" id="choice3" class="form-check-input"
                  name="quesoption[<?php echo $fitness[0]['id'];?>]" value="<?php echo $fitness[0]['opt3'];?>"><span class="checkmark" disabled=""></span><span
                  class="wrong_div"><i class="im im-x-mark"></i></span></label></div>
          </div>
          <div class="card card_flex">
            <div class="card_flex_inner">
              <div><svg xmlns="http://www.w3.org/2000/svg" id="Layer_4" width="32" height="32" viewBox="0 0 24 24">
                  <path d="M12 3l12 18h-24z"></path>
                </svg></div>
              <div class="r_txt"><?php echo $fitness[0]['opt4'];?></div>
            </div>
            <div><label class="radiocontainer"> <input type="radio" id="choice4" class="form-check-input"
                  name="quesoption[<?php echo $fitness[0]['id'];?>]" value="<?php echo $fitness[0]['opt4'];?>"><span class="checkmark" disabled=""></span><span
                  class="wrong_div"><i class="im im-x-mark"></i></span></label></div>
          </div>
        </div>
      </div>

      <div class="row bg_w bg_w_r">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="main-content">
            <div class="ques_d">Question:<span>2</span></div>
            <div class="seq_que">
              <h3><?php echo $fitness[1]['ques']; ?> </h3>
            </div>

          </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 card_Flex_Area">
          <div class="card card_flex">
            <div class="card_flex_inner">
              <div>
                <svg id="Layer_1" x="20" y="30" height="30" viewBox="0 0 506.1 506.1" width="30">&lt; path d = 'm489.609
                  0h-473.118c-9.108 0-16.491 7.383-16.491 16.491v473.118c0 9.107 7.383 16.491 16.491
                  16.491h473.119c9.107 0 16.49-7.383 16.49-16.491v-473.118c0-9.108-7.383-16.491-16.491-16.491z'
                  /&gt;</svg>
              </div>
              <div class="r_txt"><?php echo $fitness[1]['opt1'];?></div>
            </div>
            <div>
              <label class="radiocontainer">
                <input type="radio" id="choice1" class="form-check-input" name="quesoption[<?php echo $fitness[1]['id'];?>]" value="<?php echo $fitness[1]['opt1'];?>">
                <span class="checkmark" disabled=""></span>
                <span class="wrong_div"><i class="im im-x-mark"></i></span>
              </label>
            </div>
          </div>
          <div class="card card_flex">
            <div class="card_flex_inner">
              <div><svg id="layer_3" width="32" height="32" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15 .001l15 15-15 15-15-15 15-15z"></path>
                </svg></div>
              <div class="r_txt"><?php echo $fitness[1]['opt2'];?></div>
            </div>
            <div><label class="radiocontainer"> <input type="radio" id="choice2" class="form-check-input"
                  name="quesoption[<?php echo $fitness[1]['id'];?>]" value="<?php echo $fitness[1]['opt2'];?>"><span class="checkmark" disabled=""></span><span
                  class="wrong_div"><i class="im im-x-mark"></i></span></label></div>
          </div>

          <div class="card card_flex">
            <div class="card_flex_inner">
              <div><svg version="1.1" id="Layer_2" x="0px" y="0px" viewBox="0 0 512 512"
                  style="enable-background:new 0 0 512 512;" height="30" width="30" xml:="" space="preserve">
                  <path d="M256,0C115.39,0,0,115.39,0,256s115.39,256,256,256s256-115.39,256-256S396.61,0,256,0z"></path>
                </svg></div>
              <div class="r_txt"><?php echo $fitness[1]['opt3'];?></div>
            </div>
            <div><label class="radiocontainer"> <input type="radio" id="choice3" class="form-check-input"
                  name="quesoption[<?php echo $fitness[1]['id'];?>]" value="<?php echo $fitness[1]['opt3'];?>"><span class="checkmark" disabled=""></span><span
                  class="wrong_div"><i class="im im-x-mark"></i></span></label></div>
          </div>
          <div class="card card_flex">
            <div class="card_flex_inner">
              <div><svg xmlns="http://www.w3.org/2000/svg" id="Layer_4" width="32" height="32" viewBox="0 0 24 24">
                  <path d="M12 3l12 18h-24z"></path>
                </svg></div>
              <div class="r_txt"><?php echo $fitness[1]['opt4'];?></div>
            </div>
            <div><label class="radiocontainer"><input type="radio" id="choice4" class="form-check-input"
                name="quesoption[<?php echo $fitness[1]['id'];?>]" value="<?php echo $fitness[1]['opt4'];?>"><span class="checkmark" disabled=""></span><span
                class="wrong_div"><i class="im im-x-mark"></i></span></label></div>
          </div>
        </div>
      </div>
      <div class="row bg_c bg_c_r_2" style="margin-top:0;">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="main-content">
            <div class="ques_d">Question:<span>3</span></div>
            <div class="seq_que">
              <h3><?php echo $fitness[2]['ques'];?> </h3>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 card_Flex_Area">
          <div class="card card_flex">
            <div class="card_flex_inner">
              <div>
                <svg id="Layer_1" x="20" y="30" height="30" viewBox="0 0 506.1 506.1" width="30">&lt; path d = 'm489.609
                  0h-473.118c-9.108 0-16.491 7.383-16.491 16.491v473.118c0 9.107 7.383 16.491 16.491
                  16.491h473.119c9.107 0 16.49-7.383 16.49-16.491v-473.118c0-9.108-7.383-16.491-16.491-16.491z'
                  /&gt;</svg>
              </div>
              <div class="r_txt"><?php echo $fitness[2]['opt1'];?></div>
            </div>
            <div>
              <label class="radiocontainer">
                <input type="radio" id="choice1" class="form-check-input" name="quesoption[<?php echo $fitness[2]['id'];?>]" value="<?php echo $fitness[2]['opt1'];?>">
                <span class="checkmark" disabled=""></span>
                <span class="wrong_div"><i class="im im-x-mark"></i></span>
              </label>
            </div>
          </div>
          <div class="card card_flex">
            <div class="card_flex_inner">
              <div><svg id="layer_3" width="32" height="32" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15 .001l15 15-15 15-15-15 15-15z"></path>
                </svg></div>
              <div class="r_txt"><?php echo $fitness[2]['opt2'];?></div>
            </div>
            <div><label class="radiocontainer"> <input type="radio" id="choice2" class="form-check-input"
                  name="quesoption[<?php echo $fitness[2]['id'];?>]" value="<?php echo $fitness[2]['opt2'];?>"><span class="checkmark" disabled=""></span><span
                  class="wrong_div"><i class="im im-x-mark"></i></span></label></div>
          </div>
          <div class="card card_flex">
            <div class="card_flex_inner">
              <div><svg version="1.1" id="Layer_2" x="0px" y="0px" viewBox="0 0 512 512"
                  style="enable-background:new 0 0 512 512;" height="30" width="30" xml:="" space="preserve">
                  <path d="M256,0C115.39,0,0,115.39,0,256s115.39,256,256,256s256-115.39,256-256S396.61,0,256,0z"></path>
                </svg></div>
              <div class="r_txt"> <?php echo $fitness[2]['opt3'];?></div>
            </div>
            <div><label class="radiocontainer"> <input type="radio" id="choice3" class="form-check-input"
                  name="quesoption[<?php echo $fitness[2]['id'];?>]" value=" <?php echo $fitness[2]['opt3'];?>"><span class="checkmark" disabled=""></span><span
                  class="wrong_div"><i class="im im-x-mark"></i></span></label></div>
          </div>
		  
          <div class="card card_flex">
            <div class="card_flex_inner">
              <div><svg xmlns="http://www.w3.org/2000/svg" id="Layer_4" width="32" height="32" viewBox="0 0 24 24">
                  <path d="M12 3l12 18h-24z"></path>
                </svg></div>
              <div class="r_txt"><?php echo $fitness[2]['opt4'];?></div>
            </div>
            <div><label class="radiocontainer"> <input type="radio" id="choice4" class="form-check-input"
                  name="quesoption[<?php echo $fitness[2]['id'];?>]" value="<?php echo $fitness[2]['opt4'];?>"><span class="checkmark" disabled=""></span><span
                  class="wrong_div"><i class="im im-x-mark"></i></span></label></div>
          </div>
         </div>
        </div>		
		
		<div class="row bg_w bg_w_r">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="main-content">
            <div class="ques_d">Question:<span>4</span></div>
            <div class="seq_que">
              <h3><?php echo $fitness[3]['ques']; ?> </h3>
            </div>

          </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 card_Flex_Area">
          <div class="card card_flex">
            <div class="card_flex_inner">
              <div>
                <svg id="Layer_1" x="20" y="30" height="30" viewBox="0 0 506.1 506.1" width="30">&lt; path d = 'm489.609
                  0h-473.118c-9.108 0-16.491 7.383-16.491 16.491v473.118c0 9.107 7.383 16.491 16.491
                  16.491h473.119c9.107 0 16.49-7.383 16.49-16.491v-473.118c0-9.108-7.383-16.491-16.491-16.491z'
                  /&gt;</svg>
              </div>
              <div class="r_txt"><?php echo $fitness[3]['opt1'];?></div>
            </div>
            <div>
              <label class="radiocontainer">
                <input type="radio" id="choice1" class="form-check-input" name="quesoption[<?php echo $fitness[3]['id'];?>]" value="<?php echo $fitness[3]['opt1'];?>">
                <span class="checkmark" disabled=""></span>
                <span class="wrong_div"><i class="im im-x-mark"></i></span>
              </label>
            </div>
          </div>
          <div class="card card_flex">
            <div class="card_flex_inner">
              <div><svg id="layer_3" width="32" height="32" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15 .001l15 15-15 15-15-15 15-15z"></path>
                </svg></div>
              <div class="r_txt"><?php echo $fitness[3]['opt2'];?></div>
            </div>
            <div><label class="radiocontainer"> <input type="radio" id="choice2" class="form-check-input"
                  name="quesoption[<?php echo $fitness[3]['id'];?>]" value="<?php echo $fitness[3]['opt2'];?>"><span class="checkmark" disabled=""></span><span
                  class="wrong_div"><i class="im im-x-mark"></i></span></label></div>
          </div>

          <div class="card card_flex">
            <div class="card_flex_inner">
              <div><svg version="1.1" id="Layer_2" x="0px" y="0px" viewBox="0 0 512 512"
                  style="enable-background:new 0 0 512 512;" height="30" width="30" xml:="" space="preserve">
                  <path d="M256,0C115.39,0,0,115.39,0,256s115.39,256,256,256s256-115.39,256-256S396.61,0,256,0z"></path>
                </svg></div>
              <div class="r_txt"><?php echo $fitness[3]['opt3'];?></div>
            </div>
            <div><label class="radiocontainer"> <input type="radio" id="choice3" class="form-check-input"
                  name="quesoption[<?php echo $fitness[3]['id'];?>]" value="<?php echo $fitness[3]['opt3'];?>"><span class="checkmark" disabled=""></span><span
                  class="wrong_div"><i class="im im-x-mark"></i></span></label></div>
          </div>
          <div class="card card_flex">
            <div class="card_flex_inner">
              <div><svg xmlns="http://www.w3.org/2000/svg" id="Layer_4" width="32" height="32" viewBox="0 0 24 24">
                  <path d="M12 3l12 18h-24z"></path>
                </svg></div>
              <div class="r_txt"><?php echo $fitness[3]['opt4'];?></div>
            </div>
            <div><label class="radiocontainer"><input type="radio" id="choice4" class="form-check-input"
                name="quesoption[<?php echo $fitness[3]['id'];?>]" value="<?php echo $fitness[3]['opt4'];?>"><span class="checkmark" disabled=""></span><span
                class="wrong_div"><i class="im im-x-mark"></i></span></label></div>
          </div>
        </div>
      </div>
	  
	  <div class="row bg_c  bg_w_r">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="main-content">
            <div class="ques_d">Question:<span>5</span></div>
            <div class="seq_que">
              <h3><?php echo $fitness[4]['ques']; ?> </h3>
            </div>

          </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 card_Flex_Area">
          <div class="card card_flex">
            <div class="card_flex_inner">
              <div>
                <svg id="Layer_1" x="20" y="30" height="30" viewBox="0 0 506.1 506.1" width="30">&lt; path d = 'm489.609
                  0h-473.118c-9.108 0-16.491 7.383-16.491 16.491v473.118c0 9.107 7.383 16.491 16.491
                  16.491h473.119c9.107 0 16.49-7.383 16.49-16.491v-473.118c0-9.108-7.383-16.491-16.491-16.491z'
                  /&gt;</svg>
              </div>
              <div class="r_txt"><?php echo $fitness[4]['opt1'];?></div>
            </div>
            <div>
              <label class="radiocontainer">
                <input type="radio" id="choice1" class="form-check-input" name="quesoption[<?php echo $fitness[4]['id'];?>]" value="<?php echo $fitness[4]['opt1'];?>">
                <span class="checkmark" disabled=""></span>
                <span class="wrong_div"><i class="im im-x-mark"></i></span>
              </label>
            </div>
          </div>
          <div class="card card_flex">
            <div class="card_flex_inner">
              <div><svg id="layer_3" width="32" height="32" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15 .001l15 15-15 15-15-15 15-15z"></path>
                </svg></div>
              <div class="r_txt"><?php echo $fitness[4]['opt2'];?></div>
            </div>
            <div><label class="radiocontainer"> <input type="radio" id="choice2" class="form-check-input"
                  name="quesoption[<?php echo $fitness[4]['id'];?>]" value="<?php echo $fitness[4]['opt2'];?>"><span class="checkmark" disabled=""></span><span
                  class="wrong_div"><i class="im im-x-mark"></i></span></label></div>
          </div>

          <div class="card card_flex">
            <div class="card_flex_inner">
              <div><svg version="1.1" id="Layer_2" x="0px" y="0px" viewBox="0 0 512 512"
                  style="enable-background:new 0 0 512 512;" height="30" width="30" xml:="" space="preserve">
                  <path d="M256,0C115.39,0,0,115.39,0,256s115.39,256,256,256s256-115.39,256-256S396.61,0,256,0z"></path>
                </svg></div>
              <div class="r_txt"><?php echo $fitness[4]['opt3'];?></div>
            </div>
            <div><label class="radiocontainer"> <input type="radio" id="choice3" class="form-check-input"
                  name="quesoption[<?php echo $fitness[4]['id'];?>]" value="<?php echo $fitness[4]['opt3'];?>"><span class="checkmark" disabled=""></span><span
                  class="wrong_div"><i class="im im-x-mark"></i></span></label></div>
          </div>
          <div class="card card_flex">
            <div class="card_flex_inner">
              <div><svg xmlns="http://www.w3.org/2000/svg" id="Layer_4" width="32" height="32" viewBox="0 0 24 24">
                  <path d="M12 3l12 18h-24z"></path>
                </svg></div>
              <div class="r_txt"><?php echo $fitness[4]['opt4'];?></div>
            </div>
            <div><label class="radiocontainer"><input type="radio" id="choice4" class="form-check-input"
                name="quesoption[<?php echo $fitness[4]['id'];?>]" value="<?php echo $fitness[4]['opt4'];?>"><span class="checkmark" disabled=""></span><span
                class="wrong_div"><i class="im im-x-mark"></i></span></label></div>
          </div>
        </div>		
		 <div class="button-box_c">
          <input type="submit" id="btnSubmit" name="qizSubmit" type="submit" class="next mt-4  mb-4" >
        </div>		
      </div>  
    </div>
  </div>
</form>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="http://103.65.20.170/fitindia/wp-content/themes/Divi/js/jquery.fullscreen.js"></script>
  <script>  
  $("#btnSubmit").on('click', function(){	  
	var email= document.getElementById("email").value;	  
    // alert(email);  
	var msgflag = false;
	var msg = '';
	
	if(!email){ msgflag = true;
		msg += 'Please add your email in URL.';
	}	
	
	if(msgflag){
		document.getElementById("error-div").innerHTML = msg;
		document.getElementById("error-div").style.display='block';
		document.getElementById("fixed-c").scrollIntoView();
		
		setTimeout(function() {
			document.getElementById("error-div").style.display = 'none';
		}, 3000);
		
		return false;
		
	}	
	 return true;
   });
  </script>
  <style>
  #error-div{ margin-bottom: 20px;
    font-weight: 500;
    line-height: 1.2;
    font-size: 2rem;
    width: 100%;
    text-align: center; display:none;
	}
  </style>

</body>

</html>