@extends('layouts.app')
@section('title', 'Fit India Quiz | Fit India')
@section('content')

<div class="banner_area">
	<img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
            @include('event.userheader')
            <div class="container">
                <div class="et_pb_row">
                    <div class="row ">
						@include('event.sidebar') 
                        <div class="col-sm-12 col-md-9 ">
                            <div class="box_quiz">
                                <h2 class="quiz-head">Fit India Quiz</h2>
								
									@if (session('message'))
										<div class="alert alert-success">
											{{ session('message') }}
										</div>
									@endif
									
								<div class="all-events">
									<div class="nomination">Nomination of 2-10 students per school</div>
									
								<form action="{{ route('save-quiz')}}" method="POST" enctype="multipart/form-data" onSubmit="return checkform();">
									
									@csrf
									<label for="exampleInputEmail1">Choose number of students</label>
									<select id="selectStores" name="noofstud">
										<option value="0">Select number of student</option>
										
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
									
									
									<table id="quiz-tbl" class="table mt-3">
										<thead class="thead-light">
											<tr>
												<th scope="col" style="width:2%"></th>
												<th scope="col">Student Name</th>
												<th scope="col" style="width:10%">Class</th>
												<th scope="col" style="width:8%">Age</th>
												<th scope="col">Email id</th>
												<th scope="col" style="width:18%">Students Photo/Id Card</th>
												<th scope="col" style="width:18%">Mobile Number (Please share the contact number of Parent/Guardian)</th>
												<th scope="col" style="width:11%">Gender</th>
											</tr>
										</thead>
										
										<tbody id="formfield">
										
										</tbody>
									</table>
									
									
									<div class="left action-row">
										 <div class="captcha-colm">
										 
										 <div class="um-field" id="capcha-page-cont">
										   <label for="captcha"></label><br>
										    <div class="r_code_area">
												<div class="cap_img" id="pagecaptcha-cont">
														<div class="captchaimg">
															<span>{!! captcha_img() !!}</span>
														</div>
													</div>
												<div style="cursor: pointer;">
													<button type="button" class="btn btn-info" class="reload" id="reload"> ↻ </button>
												</div>
												
												<div class="cap_input">
													<input type="text" id="captcha" name="captcha" class="form-control @error('captcha') is-invalid @enderror" required  placeholder="Captcha">
														@error('captcha')
															<span class="invalid-feedback" role="alert" >
																<strong>{{ $message }}</strong>
															</span>
														@enderror
												</div>
											</div>
										  
									   </div>
									 </div>
									 
									
									 
									 <div class="fi-certnote" >
									 	<div class="diss_chk" ><input type="checkbox"></div>
										 <p><b>Disclaimer :</b> The students selected and nominated by school to participate in Fit India Quiz have been chosen after a transparent and unbiased process .Fit India Mission shall not be responsible or liable for any queries pertinent to the nominated students raised by any individual or Agency/institution.</p>
									 </div>
									 
									 <br>
									 
										<div class="action-colm">
											<button type="submit" class="btn btn-primary">SUBMIT</button>
											<a class="btn btn-secondary" href="">CANCEL</a>
										</div>
									
									</div>

									   
									
								</form>
									
									
									
									
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br>
        </div>
	
<script>
function checkform(){
	var cnt = $("#selectStores").val();
	if(cnt == 0){
		alert('Please select no of students');
		return false;
	}
	return true;
}
</script>
<script>
  $(document).ready(function(){
		$("#selectStores").change(function(){
		$('.std-card').remove();
		var number=$("#selectStores option:selected").text();
		var htmlToInsert = "";
		for(var i=0; i < number; i++)
		{
			htmlToInsert += '<tr>'
			+'<td>'+(i + 1)+' </td>'
			+'<td>'
			+'<input type="text" class="form-control " name="studentname[]" value="" required>'
			+'</td><td>'
            +'<input type="text" class="form-control" name="class[]" value="" required>'
			+'</td><td>'
			+'<input type="text" class="form-control" name="age[]" value="" required> </div></div>'
			+'</td><td>'
			+'<input type="email" class="form-control" name="email[]" value="" required>'
			+'</td><td>'
			+' <input type="file" name="image['+ i +']" class="form-control" placeholder="Image" multiple required>'
			+'</td><td>'
			+'<input type="text" class="form-control" name="mobile[]" value="" maxlength="10" required>'
			+'</td><td>'
			+'<input type="radio" id="male" name="gender['+ i +'][]" value="male" class="radio-inline" required>'
			+'Male'
			+'<br>'			
			+'<input type="radio" id="female" name="gender['+ i +'][]" value="female" class="radio-inline" required>'
			+'Female'
			
			+'</td>' 
			
			+'</tr>';
			
			//$(htmlToInsert).insertAfter("#selectStores");
     }

     $('#formfield').html(htmlToInsert);
	 
	 $('#quiz-tbl').show();
     
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


<style>
.table{ margin-top: 1rem; }

input[type=radio] { width: unset; margin-right: 5px;}

.quiz-head, .nomination{
    text-align:center;
}

.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;
}
.custom-file-input::before {
  content: 'Select some files';
  display: inline-block;
  background: linear-gradient(top, #f9f9f9, #e3e3e3);
  border: 1px solid #999;
  border-radius: 3px;
  padding: 5px 8px;
  outline: none;
  white-space: nowrap;
  -webkit-user-select: none;
  cursor: pointer;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  font-size: 10pt;
}
.custom-file-input:hover::before {
  border-color: black;
}
.custom-file-input:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
}

#quiz-tbl{ display:none; }
.nomination{ padding:5px 15px 30px 15px;}
		</style>
	
@endsection
