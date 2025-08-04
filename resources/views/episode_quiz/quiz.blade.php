<!DOCTYPE html>
<html lang="en">

<head>
  <title> QUIZ</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <!--  <link rel="stylesheet" href="css/bootstrap.min.css"> -->
   <link rel="stylesheet" href="{{ asset('resources/ncss/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://cdn.iconmonstr.com/1.3.0/css/iconmonstr-iconic-font.min.css">
  <!-- <link rel="stylesheet" href="css/global.css"> -->
  <!-- <link rel="stylesheet" href="css/create.css"> -->
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <link rel="stylesheet" href="{{ asset('resources/ncss/style.css') }}">
 <!--  <link rel="stylesheet" href="css/media_query_quiz.css"> -->
   <link rel="stylesheet" href="{{ asset('resources/ncss/media_query_quiz.css') }}">

  <style>
    .quizDate{
      width:auto;
      margin:15px auto;
      /* height: 45px; */
      border:1px solid #e2e2e2;
      text-align: center;;
      padding: 10px 15px;
      color:#000;
      border-radius: 7px;
      /*box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);*/
      font-size:16px;
      background: #fff;
      /*-webkit-box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); 
      -moz-box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
      box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);*/
      
    }
	
	
    .error{
      color: red;
      font-size: 25px;
    }
	.ques_d {
		background: transparent;
		border: 1px solid #13418c;
		color:#13418c;
		padding: 0.5rem 1.8rem;
	}
	.user_area_q {
		width:auto;
		display: inline-block;
	}
	/*no-padding*/
  </style>
</head>

<body>
 
 
<div class="banner_area1">
  <img src="{{ asset('resources/imgs/episode_quiz.png') }}" alt="quiz" title="quiz" class="img-fluid expand_img" />
</div>
  <div class="container-fluid">

   <!--  <div class="fixed_c"> -->
      <div class="row stickshadow ">
        <div id="UpdatePanel1">
          <div class="row r-m  base_o">          
            <div class="col-sm-12 col-md-12 col-lg-12">
              
              <div id="div_userdata " class="user_area_q p-0">
                <div class="quizDate border-0 m-0 pl-0 pr-0" style="font-weight:600;"><span>Date:</span> <span> <?php echo date('d-m-Y');?></span></div>  
              </div>
			  <div id="div_userdata " class="user_area_q p-0" style="float: right;">
                <div class="quizDate border-0 m-0"><span><a href="term-and-condition">T & C Apply</a></span></div>  
              </div>
              
            </div>
          </div>                  
        
        </div>
      </div>

  <!--     <div class="row stickshadow ">
        <div id="UpdatePanel1">
          <div class="row r-m  base_o">    -->       
            
         <!--  </div>                  
        
        </div>
      </div> -->


   <!--  </div> -->
 <center>@if ($errors->has('choosed_option'))
      <div class="error">{{ $errors->first('choosed_option') }}</div>
   @endif
 </center>
    <div class="page-content-inner">
    <?php 
    $i = 1;
    $curr_date = date('d-m-Y');
    
    $result_desc = DB::table('episode_quiz_details')->where('date',$curr_date)->first();
    $result_count = DB::table('episode_quiz_result')->where('user_id',$auth_id)->where('episode_date',$curr_date)->count();
    if($result_count == count($quiz_episode)  && $result_count > 0){ ?>
          <div class="col-sm-12 col-md-12 col-lg-12 ">
              <div id="div_userdata " class="user_area_q" style="display:flex;">
                <div class="quizDate m-0" style="font-size:16px; color:#333; font-weight: 500;">Thanks for the participation. Winners along with the correct answers will be displayed on the fit india website by the end of the event.</div>  
              </div>



          </div>
    <?php }else{ 
            if(count($quiz_episode)>0){ ?>
              <div class="col-sm-12 col-md-12 col-lg-12 ">
                  <div id="div_userdata " class="user_area_q">
                    <div class="quizDate m-0 border-0" style="font-size:14px; background:#e7e7e7;">*Please note that answer can not be changed after submission.</div>  
                  </div>
              </div>
    <?php } } ?>
      @if(!empty($quiz_episode))
          @foreach($quiz_episode as $quiz_value)
          <?php $result = DB::table('episode_quiz_result')->where('user_id',$auth_id)->where('q_id',$quiz_value->id)->first(); 
          if(!empty($result)){
            $dis_class = 'btn btn-secondary btn-lg disabled';
            $disable = 'disabled';
            $button = 'button';
          }else{
            $dis_class = '';
            $disable = '';
            $button = 'submit';
          }

          ?>
          <section id="section<?=$i?>">
            <form action="{{route('episode-quiz-post')}}" method="POST">
               @csrf
               <input type="hidden" name="section_val" value="<?=$i?>">
               <input type="hidden" name="user_id" value="{{$auth_id}}">
               <input type="hidden" name="q_id" value="{{$quiz_value->id}}">
               <input type="hidden" name="episode" value="{{$quiz_value->episode}}">
               <input type="hidden" name="episode_date" value="{{$quiz_value->episode_date}}">
               <input type="hidden" name="ar_value" value="{{$quiz_value->ans}}">
               <input type="hidden" name="ch_option" id="ch_option-<?=$i?>" > 
                <div class="row bg_c bg_c_r">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="main-content">
                        <div class="ques_d">Question:<span><?=$i?></span></div>
                        <div class="seq_que">
                          <h3>{{$quiz_value->quest}} </h3>
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
                          <div class="r_txt">{{$quiz_value->opt1}}</div>
                        </div>
                        <div>
                          <label class="radiocontainer">
                            <input type="radio" id="choice1" opt="{{$quiz_value->opt1}}" auto_id="<?=$i?>" class="form-check-input" name="choosed_option" value="1" <?php if(@$result->choosed_option_index=='1'){ echo 'checked';} ?> required <?=$disable?>>
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
                          <div class="r_txt">{{$quiz_value->opt2}}</div>
                        </div>
                        <div><label class="radiocontainer"> 
                              <input type="radio" id="choice2" class="form-check-input" name="choosed_option" opt="{{$quiz_value->opt2}}" auto_id="<?=$i?>" value="2" <?php if(@$result->choosed_option_index=='2'){ echo 'checked';} ?> required <?=$disable?>>
                              <span class="checkmark" disabled=""></span>
                              <span class="wrong_div"><i class="im im-x-mark"></i></span>
                            </label>
                        </div>
                      </div>

                      <div class="card card_flex">
                        <div class="card_flex_inner">
                          <div><svg version="1.1" id="Layer_2" x="0px" y="0px" viewBox="0 0 512 512"
                              style="enable-background:new 0 0 512 512;" height="30" width="30" xml:="" space="preserve">
                              <path d="M256,0C115.39,0,0,115.39,0,256s115.39,256,256,256s256-115.39,256-256S396.61,0,256,0z"></path>
                            </svg></div>
                          <div class="r_txt">{{$quiz_value->opt3}}</div>
                        </div>
                        <div><label class="radiocontainer"> 
                            <input type="radio" id="choice3" class="form-check-input" name="choosed_option" opt="{{$quiz_value->opt3}}" auto_id="<?=$i?>" value="3" <?php if(@$result->choosed_option_index=='3'){ echo 'checked';} ?> required <?=$disable?>>
                              <span class="checkmark" disabled=""></span>
                              <span class="wrong_div"><i class="im im-x-mark"></i></span>
                            </label>
                        </div>
                      </div>
                      <div class="card card_flex">
                        <div class="card_flex_inner">
                          <div><svg xmlns="http://www.w3.org/2000/svg" id="Layer_4" width="32" height="32" viewBox="0 0 24 24">
                              <path d="M12 3l12 18h-24z"></path>
                            </svg></div>
                          <div class="r_txt">{{$quiz_value->opt4}}</div>
                        </div>
                        <div><label class="radiocontainer"> 
                            <input type="radio" id="choice4" class="form-check-input" name="choosed_option" value="4" opt="{{$quiz_value->opt4}}" auto_id="<?=$i?>" <?php if(@$result->choosed_option_index=='4'){ echo 'checked';} ?> required <?=$disable?>>
                              <span class="checkmark" disabled=""></span>
                              <span class="wrong_div"><i class="im im-x-mark"></i></span>
                            </label>
                        </div>
                      </div>
                    </div>
                    <div class="button-box_c">
                      <!-- <button id="btnSubmit" type="<?=$button?>" class="next mt-4  mb-4 <?=$dis_class?>"  
                        onclick="return confirm('Are you sure you want to submit, Once the answer is sumitted you will not be able to change it.')" <?=$disable?>>Submit</button>  -->
                         <button id="btnSubmit" type="<?=$button?>" class="next mt-4  mb-4 <?=$dis_class?>" <?=$disable?>>Submit</button> 
                    </div>
                </div>
            </form>
          </section>
          <?php $i++; ?>
          @endforeach
      @endif

      <?php 
      if(count($quiz_episode)==0){ ?>
        <!-- <center><div class="row"><div class="col"><div class="quizDate p-5 border-0" style="min-height: 200px; display: flex; align-items: center; flex: initial;"><h2>Fit India Quiz</h2><p style="font-size: 18px; font-weight:500; text-align: center; flex: auto; color: #333" class="m-0">The quiz will be open soon</p></div></div></div></center> -->
         <div class="quizDate p-0 border-0" style="overflow:hidden;">
            <a href="javascript:void:(0)" style="overflow:hidden;">
            <span style=" display:block;"> <img src="{{ asset('resources/imgs/open-sooon.png') }}" alt="quiz" title="quiz" class="img-fluid expand_img" / ></span>
            </a>
        </div>
        <?php if(!empty($result_desc)){ 
         if(!empty($result_desc->status=='1')){ ?>
        <div class="quizDate border-0" style="text-align:left">
            <p><center> <h2><u>Quiz Bulletin</u></h2> (<?=$result_desc->date?>) </center>
            <br>
            <ol>
              <?php 
                $desc = explode('$des$',$result_desc->Description); 
                  foreach($desc as $desc_val){
                    echo '<li>'.$desc_val."</li>";
                  }
                ?>
            </ol>  
            </p>
        </div>
      <?php } ?>

        <div class="quizDate p-0 border-0" style="overflow:hidden;">
            <a href="<?=@$result_desc->Quiz_link;?>" target="_blank" style="overflow:hidden;">
            <span style=" display:block;"> <img src="{{ asset('resources/imgs/quiz_previous_rounds.png') }}" alt="quiz" title="quiz" class="img-fluid expand_img" / ></span>
            </a>
        </div>
        
        <?php  } } ?>
      
    </div>
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

$('input[type=radio][name=choosed_option]').change(function() {
    var opt = $(this).attr('opt');
    var auto_id = $(this).attr('auto_id');
    $('#ch_option-'+auto_id).val(opt);
});
document.addEventListener('contextmenu', event => event.preventDefault());
});
document.onkeydown = function(e) {
        if (e.ctrlKey && 
            (e.keyCode === 67 || 
             e.keyCode === 86 || 
             e.keyCode === 85 || 
             e.keyCode === 117)) {
            return false;
        } else {
            return true;
        }
};
$(document).keypress("u",function(e) {
  if(e.ctrlKey)
  {
return false;
}
else
{
return true;
}
});
</script>
</body>

</html>