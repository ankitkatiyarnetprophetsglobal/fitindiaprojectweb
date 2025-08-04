<!DOCTYPE html>
<html lang="en">

<head>
  <title>{{ ucwords($userdata->name) }} Road to Tokyo 2020 Quiz </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('resources/ncss/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://cdn.iconmonstr.com/1.3.0/css/iconmonstr-iconic-font.min.css">
  <link rel="stylesheet" href="{{ asset('resources/ncss/global.css') }}">
  <link rel="stylesheet" href="{{ asset('resources/ncss/create.css') }}">
  <link rel="stylesheet" href="{{ asset('resources/ncss/style.css') }}">
  <link rel="stylesheet" href="{{ asset('resources/ncss/media_query_quiz.css') }}">
  
  
  <script>
        var mins = 2; var secs = mins * 60;
  
        function countdown() {
            setTimeout('Decrement()', 60);
        }
  
        
		function Decrement() {
			var sec = 0;
			var minvar = 0;
			var secvar = 0;
			
            if (document.getElementById) {
                minutes = document.getElementById("minutes");
                seconds = document.getElementById("seconds");
				secelem = document.getElementById("sec");
				if (seconds < 59) {
                    seconds.innerHTML = secs;
                }else {
					minvar = getminutes();
					secvar = getseconds();
                    minutes.innerHTML = minvar;
                    seconds.innerHTML = secvar;
					if(minvar == 1){
						sec = 60 + secvar;
					}else{
						sec = secvar;
					}
					
					secelem.value = sec;
                }
               
                if (mins < 1) {
                    //minutes.style.color = "red";
                    //seconds.style.color = "red";
                }


                if (mins < 0) {
					secelem.value = 0;
                    alert('time up');
					
					document.forms["quiztokyo"].submit();
                    minutes.innerHTML = 0;
                    seconds.innerHTML = 0;
                }else {
                    secs--;
                    setTimeout('Decrement()', 1000);
                }
            }
        }
  
        function getminutes() {
            mins = Math.floor(secs / 60);
            return mins;
        }
  
        function getseconds() {
           return secs - Math.round(mins * 60);
        }
    </script>
	
	<script>

function counterquiz(){
	var deadline = new Date( Date.now() + 2001 * 60 ).getTime();

	var x = setInterval(function() {
		var now = new Date().getTime();
		var t = deadline - now;
		var sec = 0;
		
		var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((t % (1000 * 60)) / 1000);
		
		document.getElementById("minutes").innerHTML = minutes;
		document.getElementById("seconds").innerHTML = seconds;
		
		if(minutes == 1){
			sec = 60 + seconds;
		}else if(seconds < 0){
			sec = 0;
		}else{ 
			sec = seconds;
		}
					
		document.getElementById("sec").value = sec;
		if (t < 0) {
			clearInterval(x);
			document.getElementById("sec").value = 0;
			document.getElementById("minutes").innerHTML ='0' ;
			document.getElementById("seconds").innerHTML = '0'; 
			document.forms["quiztokyo"].submit();
			//document.getElementById("demo").innerHTML = "TIME UP";
			
		}
	}, 1000);
	
}
</script>
	<script>
		function disableSelect(event) {
			event.preventDefault();
		}

		function startDrag(event) {
			window.addEventListener('mouseup', onDragEnd);
			window.addEventListener('selectstart', disableSelect);
			// ... my other code
		}

		function onDragEnd() {
			window.removeEventListener('mouseup', onDragEnd);
			window.removeEventListener('selectstart', disableSelect);
			// ... my other code
		}
	
	window.addEventListener('selectstart', function(e){ e.preventDefault(); });
	</script>
  
</head>

<body oncopy="return false" oncut="return false" onpaste="return false">

 <form action="{{ route('quizstore') }}" method="POST" onsubmit="return checkquiz()" name="quiztokyo" >
 @csrf
  <div class="container-fluid no-padding" id="fixed-c">
    <div class="fixed_c" >
      <div class="row ">
        <div class="col-sm-12 col-md-12 col-lg-12 no-padding">
          <div class="head_khelo">
          <div class="countermtr"> <span id="minutes"></span> :  <span id="seconds"></span> </div>
            <h1> 
			{{ ucwords($userdata->name) }} - {{__('sentence.quiz_signup_form_heading_1')}}   
            </h1>
			
			
          </div>
        </div>
      </div>

      <div class="row stickshadow ">
        <div id="UpdatePanel1">
          <div class="row r-m  base_o">          
            <div class="col-sm-12 col-md-12 col-lg-12 rm-p-m">
			
			<div id="error-div" class="alert alert-danger" role="alert"></div> 
			
			@if(session()->has('error'))
                    <div class="alert alert-error alert-danger" style="text-align:center; font-size: large; font-weight: 400;">
                        {{ session()->get('error') }}
                    </div>
                @endif
				
			<!--
				<h1 class="school_name">
					<span>{{ $userdata->name }}</span>
				</h1>
-->
				
			
              <div id="div_userdata" class="user_area_q">
                <div class="form-group user_child">
				<input type="hidden" name="sec" id="sec" />
                  <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{__('sentence.name')}}" value="{{ old('name') }}" >
				  @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
					
				  <input type="hidden" name="schoolid" value="{{ $userdata->id }}" />
				  <input type="hidden" name="encrypted" value="{{ $encrypted }}" />
                </div>

                <div class="form-group user_child">
                  <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{__('sentence.email')}}" value="{{ old('email') }}">
				  @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>

				<div class="form-group user_child">
					<input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="{{__('sentence.mobile')}}" value="{{ old('phone') }}">
					@error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>
				
				<div class="form-group user_child last-t">
				
					<select id="state" name="state" class="form-control @error('state') is-invalid @enderror" aria-required="true">
                            <option value="">{{__('sentence.select_state')}}</option>
                            @foreach($states as $st)
                                <option  @if(!empty(old('state')) && old('state') == $st->id) {{ 'selected' }} @endif >
								{{ $st->name }}
								</option>
                            @endforeach
					</select>
					
					@error('state')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
				</div>	
				
				
				<div class="form-group user_child last-t">
					
					<input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" placeholder="{{__('sentence.city')}}" value="{{ old('city') }}">
					@error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
				</div>
				
				
				<div class="form-group" style="margin: 10px 6px;">
					<span class="start-btn" onclick="checkuser()" id="start-btn">{{__('sentence.start_quiz_button_text')}}</span>
				</div>
				
               
              </div>
            </div>
          </div>                  
          <!--<input type="hidden" name="showpopup" id="showpopup"> -->
        </div>


      </div>
    </div>

    <div class="page-content-inner startquiz" id="startquizelem">
		<div class="row bg_c bg_c_r">
	  
	  
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="main-content">
           
            <div class="seq_que">
              <h3>{{__('sentence.quiz_signup_filling_instruction_heading_1')}} </h3>
            </div>

          </div>
        </div>
		
		</div>
      
    </div>
	
	
	
	
	
	
  </div>
</form>
<script src="https://code.jquery.com/jquery-3.1.1.min.js">
  <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="{{ asset('resources/js/jquery.fullscreen.js') }}"></script>
  <script>
  
	function checkuser(){
		document.getElementById("error-div").innerHTML = "";
		document.getElementById("error-div").style.display='none';
		var name= document.getElementById("name").value;
		var email= document.getElementById("email").value;
		var sclass = document.getElementById("phone").value;
		var state = document.getElementById("state").value;
		var city = document.getElementById("city").value;
		
		var msgflag = false;
		var msg = '';
		
		if(!name){ msgflag = true;
			msg += '<?= __('sentence.name')?>';
		}
		
		if(!email){ msgflag = true;
			msg += '<?= __('sentence.email')?>';
		}
		
		if(!sclass){ msgflag = true;
			msg += '<?= __('sentence.mobile')?>';
		}
		
		
		if(!state){ msgflag = true;
			msg += '<?= __('sentence.select_state')?>';
		}
		
		if(!city){ msgflag = true;
			msg += '<?= __('sentence.city')?>';
		}
		
		if(msgflag){
			msg += '<?= __('sentence.can_not_empty_text')?> ';
		}
		
		
		if(sclass){ 
			var reg = /^[0-9]{1,10}$/;
			var checking = reg.test(sclass); 
	 
			if(!checking){
				msgflag = true;
				msg += '<?= __('sentence.mobile_10_digit')?>';
			}else if(sclass.length != 10){
				msgflag = true;
				msg += '<?= __('sentence.mobile_10_digit')?>';
			}
		}
		
		
		
		
		
		if(msgflag){
			document.getElementById("error-div").innerHTML = msg;
			document.getElementById("error-div").style.display='block';
			document.getElementById("fixed-c").scrollIntoView();
			return false;
		}
		
		
		
		//countdown();  
		counterquiz();
		//getquizques('en');
		getquizques()
		
		//document.getElementById("startquizelem").classList.remove("startquiz");
  
	}
	
	
	function getquizques(lang){
		var langs = "<?=Lang::locale()?>";
		$.ajax({
					url: "{{ route('getques') }}", 
					data: { "lang" : langs, "_token": "{{ csrf_token() }}"} ,
					type: 'POST',
					success: function(response){
						//console.log(response);
						let msg ="";
						var cnt = 0;
						for (let i in response) {
						  console.log(response[i].id + " ");
							cnt++;
							msg +='<div class="row bg_c bg_c_r"> <div class="col-sm-12 col-md-12 col-lg-12"> <div class="main-content"> <div class="ques_d">Question:<span>'+cnt+'</span></div> <div class="seq_que"> <h3>'+response[i].ques+'</h3> </div> </div> </div>';
						  
							msg +='<div class="col-sm-12 col-md-12 col-lg-12 card_Flex_Area"> <div class="card card_flex"> <div class="card_flex_inner"> <div> <svg id="Layer_1" x="20" y="30" height="30" viewBox="0 0 506.1 506.1" width="30"><path d ="m489.609 0h-473.118c-9.108 0-16.491 7.383-16.491 16.491v473.118c0 9.107 7.383 16.491 16.491 16.491h473.119c9.107 0 16.49-7.383 16.49-16.491v-473.118c0-9.108-7.383-16.491-16.491-16.491z"></svg>';
							msg +='</div><div class="r_txt">'+response[i].opt1+'</div> </div> <div> <label class="radiocontainer"> <input type="radio"  class="form-check-input" name="quesoption['+response[i].id+']" value="'+response[i].opt1+'"> <span class="checkmark" disabled=""></span> <span class="wrong_div"><i class="im im-x-mark"></i></span> </label> </div> </div>';
							msg +=' <div class="card card_flex"> <div class="card_flex_inner"> <div><svg id="layer_3" width="32" height="32" xmlns="http://www.w3.org/2000/svg"> <path d="M15 .001l15 15-15 15-15-15 15-15z"></path> </svg></div> <div class="r_txt">'+response[i].opt2+'</div> </div> <div> <label class="radiocontainer"> ';
							msg +='<input type="radio" class="form-check-input" name="quesoption['+response[i].id+']" value="'+response[i].opt2+'"> <span class="checkmark" disabled=""></span> <span class="wrong_div"><i class="im im-x-mark"></i></span> </label> </div></div>';
							

							msg += '<div class="card card_flex"> <div class="card_flex_inner"> <div><svg version="1.1" id="Layer_2" x="0px" y="0px" viewBox="0 0 512 512"  style="enable-background:new 0 0 512 512;" height="30" width="30" xml:="" space="preserve"> <path d="M256,0C115.39,0,0,115.39,0,256s115.39,256,256,256s256-115.39,256-256S396.61,0,256,0z"></path> </svg></div>  <div class="r_txt">'+response[i].opt3+'</div> </div> <div> <label class="radiocontainer">  <input type="radio" class="form-check-input" name="quesoption['+response[i].id+']" value="'+response[i].opt3+'"> <span class="checkmark" disabled=""></span> <span class="wrong_div"><i class="im im-x-mark"></i></span></label></div> </div> ';
							  
							msg += '<div class="card card_flex"> <div class="card_flex_inner">  <div><svg xmlns="http://www.w3.org/2000/svg" id="Layer_4" width="32" height="32" viewBox="0 0 24 24"> <path d="M12 3l12 18h-24z"></path> </svg></div>  <div class="r_txt">'+response[i].opt4+'</div> </div> <div> <label class="radiocontainer"> <input type="radio" class="form-check-input" name="quesoption['+response[i].id+']" value="'+response[i].opt4+'"> <span class="checkmark" disabled=""></span> <span class="wrong_div"><i class="im im-x-mark"></i></span> </label> </div> </div> ';
						  
						  
							
						  
						  msg +=' </div> </div>';
						}
						msg += '<div class="button-box_c"> <input type="submit" id="btnSubmit" name="qizSubmit"  class="next mt-4  mb-4"</div>';
						
					  
					 jQuery('#startquizelem').html(msg);
					 jQuery('#start-btn').hide();
					 
					}
		});
    
	}
	
    function checkquiz(){
	var name= document.getElementById("name").value;
	var email= document.getElementById("email").value;
	var sclass = document.getElementById("phone").value;
	var msgflag = false;
	var msg = '';
	
	if(!name){ msgflag = true;
		msg += '<?= __('sentence.name')?>';
	}
	
	if(!email){ msgflag = true;
		msg += '<?= __('sentence.email')?>';
	}
	
	if(!sclass){ msgflag = true;
		msg += '<?= __('sentence.mobile')?> ';
	}
	
	
	if(msgflag){
		msg += ' <?= __('sentence.can_not_empty_text')?>';
		document.getElementById("error-div").innerHTML = msg;
		document.getElementById("error-div").style.display='block';
		document.getElementById("fixed-c").scrollIntoView();
		return false;
	}
	return true;
}
  </script>
  
	<script> 
		$(document).ready(function () {
			//Disable full page
			$("body").on("contextmenu",function(e){
				return false;
			});
			
			//Disable part of page
			$("#id").on("contextmenu",function(e){
				return false;
			});
		});
	</script>
	
	
  <style>
  #error-div{ margin-bottom: 0;
    font-weight: 500;
    line-height: 1.2;
    font-size: 14px;
    width: 100%;
    text-align: center;
    display: none;
	}
	
	.school_name {
    text-align: center;
    position: relative;
    padding: 10px;
    background: #f2f2f2;
    color: #383850;
    font-size: 3rem;
}

img.brand-logo {
    position: relative;
    height: 50px;
    left: 0;
}

#mycounter{ display:inline-block; float:right; }
.countermtr{ position: fixed;
    width: 98%;
    z-index: 1000; 
	color:#ffffff;
	text-align: right;
	font-size: 18px;
	}
	
	
	.startquizs{
	-webkit-filter: blur(5px);
		-moz-filter: blur(5px);
		-o-filter: blur(5px);
		-ms-filter: blur(5px);
		filter: blur(5px);
	}
	
	.start-btn{
		background: #f2581c;
		padding: 4px 0;
		color: #fff;
		font-size: 1.2rem;
		width: 80px;
		text-align: center;
		border-radius: 6px;
		-moz-border-radius: 6px;
		-webkit-border-radius: 6px;
		font-weight: 600;
		border-color: #f2581c5c;
		cursor: pointer;
		display:inline-block;
	}
  </style>
  

</body>

</html>