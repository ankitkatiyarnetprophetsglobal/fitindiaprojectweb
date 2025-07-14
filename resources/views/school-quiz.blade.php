@extends('layouts.app')
@section('title', 'Student quiz | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<style>
.inner-banner-bg {
	background: url(resources/imgs/d-blue-ptrn-bg.png) repeat top center;
}
.inner-banner-band {
	text-align:center;
	padding:2.5% 0;
	color:rgb(11 2 131 / 100%);
	background: rgb(248 249 255 / 94%);
	text-transform:uppercase;
}
.std-card{ padding:5px 30px 30px 30px; background:#fff; border:1px solid rgb(167 165 185 / 30%); margin-top:15px; margin-bottom:30px; border-radius:8px; position:relative; box-shadow: 0 5px 15px rgb(167 165 185 / 34%);}
.std-card .row{padding-top: 10px;}
.clearfx{clear:both;}
.form-group {overflow: hidden;}
.note-info {clear:both; margin:10px 0; font-size:12px; width: 100%; text-align: center;}
.num-std { position: absolute; top: 10px; left: -30px; background: rgb(228 228 234); color: #333; border-radius: 8px 0 0 8px; padding: 5px 0; width: 30px; height: 30px;text-align: center; font-weight:600; }
.std-card .col {padding:0 5px;}
.std-gnd .form-check-inline:last-child { margin-right: 0;}
.gnd-grp { margin-top:15px;}
.std-card input {height:40px;}
.std-card input, .std-card textarea {font-size: 14px;}
.std-card .form-check-label {margin-bottom: 0; float: left; margin-left: 20px;}
.std-card .form-check-inline .form-check-input { position: absolute; float: left;}



</style>
<div class="inner-banner-bg">
<div class="inner-banner-band">
<h1 class="page__title title" id="page-title">Fit India Student Quiz</h1>
</div>
</div>
  <section id="{{ $active_section_id }}">
  
    <div class="container" >
        
        <div class="row">
            <div class="col-md-4 offset-md-4">
           
                 @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form action="{{ route('save-quiz')}}" method="POST" enctype="multipart/form-data">
                    @csrf
					<label for="exampleInputEmail1">Choose Number Of Students</label>
					<select id="selectStores" name="noofstud">
                        <option value="0">Select Number Of Student</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
					</select>
					
                    <div id="formfield">

                    </div>
					
					
			  
			  
					 <div class="left action-row">
                         <div class="captcha-colm">
						 
                         <div class="um-field" id="capcha-page-cont">
                           <label for="captcha"></label><br>
                           <div style="float:left; width:115px;  margin: 6px 0;" id="pagecaptcha-cont">
                                <div class="captchaimg">
                                    <span>{!! captcha_img() !!}</span>
                                </div>
                            </div>
                           <div style="float:left; margin: 6px 20px 6px 10px; cursor: pointer;">
                             <button type="button" class="btn btn-info" class="reload" id="reload"> ↻ </button>
                           </div>
                           
                           <div style="float:left; width:40%">
                               <input type="text" id="captcha" name="captcha" class="form-control @error('captcha') is-invalid @enderror" required  placeholder="Captcha">
                                @error('captcha')
                                    <span class="invalid-feedback" role="alert" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           </div>
                           <div style="clear:both;"></div>
                       </div>
                     </div>
                        <div class="action-colm">
						<button type="submit" class="btn btn-primary">SUBMIT</button>
						<a class="btn btn-secondary" href="">CANCEL</a>
                    </div>
					
					</div>

                       
					
                </form>
				</div>
        </div>
            
    </div>
  </section>
   <script>
  $(document).ready(function(){
		$("#selectStores").change(function(){
		$('.std-card').remove();
		var number=$("#selectStores option:selected").text();
		var htmlToInsert = "";
		for(var i=0; i < number; i++)
		{
			htmlToInsert += '<div class="std-card">'
			+'<span class="num-std"> '+(i + 1)+' </span>'
			+'<div class="row">'
			+'<div class="col">'
			+'<label for="userEmail">Student Name:*</label>'
			
			+'<br> <input type="text" class="form-control" name="studentname[]" value="" required> </div></div>'
			
			+'<div class="row">'
			+'<div class="col col-3">'
			+'<div class="std-class">'
			+'<label for="userEmail">Class:* </label>'
            +'<input type="text" class="form-control" name="class[]" value="" required></div></div>'
			
			+'<div class="col col-2">'
			+'<div class="std-age">'
            +'<label for="userEmail">Age:*</label>'
            +'<input type="text" class="form-control" name="age[]" value="" required> </div></div>'

			+'<div class="col col-7">'
			+'<div class="std-gnd">'
            +'<label for="userEmail">Gender:*</label>'
			+'<div class="clearfix"></div>'
			+'<div class="gnd-grp">'
			+'<div class="form-check form-check-inline">'
			+'<label for="male" class="form-check-label">Male</label>'
            +'<input type="radio" id="male" name="gender['+ i +'][]" value="male" class="form-check-input radio-inline" required></div>'
			
			+'<div class="form-check form-check-inline">'			
			+'<label for="female" class="form-check-label">Female</label>'
			+'<input type="radio" id="female" name="gender['+ i +'][]" value="female" class="form-check-input radio-inline" required></div>'
			
			+'<div class="form-check form-check-inline">'				
			+'<label for="other" class="form-check-label">Other</label>'
			+'<input type="radio" id="other" name="gender['+ i +'][]" value="other" class="form-check-input radio-inline" required></div></div></div></div></div>'
			
			+'<div class="row">'
			 +'<div class="col col-8">'
			 +'<div class="std-email">'
             +'<label for="userEmail">Email-id *</label>'
            +' <input type="email" class="form-control" name="email[]" value="" required></div></div>'
			
			 +'<div class="col col-4">'
			+'<div class="std-num">'
              +'<label for="userEmail">Contact No: *</label>'
             +'<input type="text" class="form-control" name="mobile[]" value="" maxlength="10" required></div></div><div class="note-info"><b style="color:blue;">(if Contact number not available than teacher mobile number)</b></div></div>'
			 
			+'<div class="row">'
			  +'<div class="col">'
             +'<label for="exampleInputEmail1">Upload (ID Card/Photo)</label>'
             +' <input type="file" name="image['+ i +']" class="form-control" placeholder="Image" multiple required> </div></div>'
			
			+'</div></div>'; 
			//$(htmlToInsert).insertAfter("#selectStores");
     }
		
		htmlToInsert += '<div class="row">  <div class="col" style="text-align: justify;"> Disclaimer : The students selected and nominated to represent the school for the Fit India Quiz have been chosen after a transparent and unbiased process to evaluate the knowledge and fitment for Fit India Quiz.Fit India Mission shall not be responsible or liable for any queries pertinent to the nominated students raised by any person or agency.  </div> </div>';
		
		
      $('#formfield').html(htmlToInsert);
     
});
});
</script>
<script>
    
jQuery('#reload').click(function () {
    jQuery.ajax({
    type: 'GET',
    url: "{{ route('reloadCaptcha')}}",
    success: function (data) {
		jQuery(".captchaimg span").html(data.captcha);
    }
    });
});
</script>
@endsection

