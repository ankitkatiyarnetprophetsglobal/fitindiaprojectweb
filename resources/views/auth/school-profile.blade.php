@extends('layouts.app')
@section('title', ' Edit Profile | Fit India')
@section('content')

<div class="banner_area">
 <img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
  @include('event.userheader')
            <div class="container">
                <div class="et_pb_row et_area">
                    <div class="row ">
            @include('event.sidebar')
                        <div class="col-sm-12 col-md-9 ">
                        <div class=" ">
                            <div class="description_box">
                                <h2>Update Profile</h2>
								@if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                <form id="fi-register" class="register-form-R" action="{{ url('update-school') }}/{{$uid}}" method="post" novalidate="novalidate">
                              @csrf
                              @method('PUT')							  
                            <input type="hidden" value="{{$result->user_id}}" name="user_id"> 
                            @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>            
                                 </div>
                                @endif 								
                                <?php
								  $scname = htmlspecialchars_decode($result->name); //str_replace('&amp;', '&', $result->name)
								  //$scname=!empty($result->name) ? stripcslashes($result->name) : '';								
								?>	
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-row">                                        
                                            <label for="school_name">School Name <span style="color: red">*</span></label>
											<input id="name" type="text" class="form-control"  name="name" value="{{old('name', $scname)}}" placeholder="School Name">
											
											<!--{!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
											@error('name')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror--> 

										   <!--<input id="" name="name" type="text"  placeholder="School Name" value="{{$result->name}}">
                                             {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}-->                                      
                                        </div>
                                    </div>
									
									<div class="col-sm-12 col-md-6">
                                        <div class="form-row">                                        
                                            <label for="Email">Email <span style="color: red">*</span></label>
											<input id="email" type="email" class="form-control"  name="email" value="{{old('email', $result->email)}}" placeholder="Email" disabled readonly >											                             
                                        </div>
                                    </div>
									
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-row">                                        
                                            <label for="students">No. of Students <span style="color: red">*</span></label>											
											<input id="students" type="text" class="form-control" name="students" value="{{old('students', $result->students)}}"  placeholder="No. of Students">
											
											<!--@error('students')
											 <span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											 </span>
											@enderror-->
											
                                            <!--<input id="" name="students" type="text" placeholder="No. of Students"
                                                    value="{{$result->students}}">
                                                    {!!$errors->first("students", "<span class='text-danger'>:message</span>")!!}-->
                                        
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-row">										
										  <label for="principalname">Principal Name <span style="color: red">*</span></label>											
											<input id="principalname" type="text" class="form-control" name="principalname" value="{{old('principalname', $result->pname)}}"  placeholder="Principal Name">
											
											<!--@error('principalname')
											 <span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											 </span>
											@enderror							
										
                                            <!--<label>Principal Name</label>
                                            <input id="" name="principalname" type="text" placeholder="Principal Name"
                                                value="{{$result->pname}}">
                                                {!!$errors->first("principalname", "<span class='text-danger'>:message</span>")!!}-->
                                        </div>
                                    </div>

									<div class="col-sm-12 col-md-6">
                                        <div class="form-row">
										   <label for="principalmobile">Principal Mobile <span style="color: red">*</span></label>											
											<input id="principalmobile" type="tel" maxlength="10" class="form-control" name="principalmobile" value="{{old('principalmobile', $result->pmobile)}}"  placeholder="Principal Mobile">
											
											<!--@error('principalmobile')
											 <span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											 </span>
											@enderror
                                            <label>Principal Mobile</label>
                                            <input id="" name="principalmobile" type="tel" maxlength="10" placeholder="Principal Mobile" value="{{$result->pmobile}}">
                                            {!!$errors->first("principalmobile", "<span class='text-danger'>:message</span>")!!}-->
                                        </div>
                                    </div>
									
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-row">
										    <label for="affiliationnum">Board Affiliation Number <span style="color: red">*</span></label>											
											<input id="affiliationnum" type="text" class="form-control" name="affiliationnum" value="{{old('affiliationnum', $result->affiliationnum)}}"  placeholder="Affiliation Number">
											
											<!--@error('affiliationnum')
											 <span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											 </span>
											@enderror
										
                                            <label>Board Affiliation Number</label>
                                            <input id="" name="affiliationnum" type="tel" maxlength="10"
                                                placeholder="Affiliation Numbere" value="{{$result->affiliationnum}}">
                                                {!!$errors->first("affiliationnum", "<span class='text-danger'>:message</span>")!!}-->
                                        </div>
                                    </div>
                                    
									<div class="col-sm-12 col-md-6">
                                        <div class="form-row">										
										   <label for="udise">Udise Number <span style="color: red">*</span></label>											
											<input id="udise" type="text"  class="form-control" name="udise" value="{{old('udise', $result->udise)}}" placeholder="Udise Number">
											
											<!--@error('udise')
											 <span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											 </span>
											@enderror
                                            <label>Udise</label>
                                            <input id="" name="udise" type="tel" maxlength="10"
                                                placeholder="Udise Numbere" value="{{$result->udise}}">
                                                {!!$errors->first("udise", "<span class='text-danger'>:message</span>")!!}-->
                                        </div>
                                    </div>

									<div class="col-sm-12 col-md-6">
                                        <div class="form-row">
										    <label for="phone">Mobile Number <span style="color: red">*</span></label>											
											<input id="phone" name="phone" type="tel" maxlength="10" class="form-control"  value="{{old('phone', $result->phone)}}" placeholder="Mobile Number">
											<!--@error('phone')
											 <span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											 </span>
											@enderror
                                           <!--<label> Mobile</label>
                                            <input id="" name="phone" type="tel" maxlength="10" placeholder=" Mobile" value="{{$result->phone}}">
                                            {!!$errors->first("phone", "<span class='text-danger'>:message</span>")!!}-->
                                        </div>
                                    </div>
                                        
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-row">
										  <label for="phone">State <span style="color: red">*</span></label>	                                          
                                            <select id="state" name="state" class="required" aria-required="true">
                                               <?php
                                                foreach($states as $st){
                                                  //echo "<pre>";print_r($st->name);
                                                   if(strtolower(trim($st->name)) == strtolower(trim($result->state))){
                                                        $ksel= 'selected';                    
													} else {
													   $ksel = '';											
													} 
													?> 
                                                   <option value="{{$st->id}}" <?=$ksel?>>{{ $st->name }}</option>                              
                                                  <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">                        
                                        <div class="form-row">
                                             <label for="phone">District <span style="color: red">*</span></label>
                                            <select id="district" name="district" class="required" aria-required="true">
                                                <?php
                                                  foreach($districts as $dst){                                                        
                                                    if(strtolower(trim($dst->name)) == strtolower(trim($result->district)))
                                                    {
                                                        $sel= 'selected';
                                                    } else {
													   $sel = '';													
													} 
													?>                                                         
                                                   <option value="{{$dst->id}}" <?=$sel?>>{{ $dst->name }}</option>                              
                                                <?php } ?>                                                    
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">   
                                        <div class="form-row">
                                            <label for="phone">Block <span style="color: red">*</span></label>
                                            <select id="block" name="block" class="required" aria-required="true">
                                            <?php
												foreach($blocks as $blk){
												if(strtolower(trim($blk->name)) == strtolower(trim($result->block)))
												{
													$sel= 'selected';
													
													
												} else {
													$sel = '';
													
													} 
                                                ?>  
                                               <option value="{{$blk->id}}" <?=$sel?>>{{ $blk->name }}</option>                              
                                            <?php  } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">                      
                                        <div class="form-row">
										    <label for="city">City <span style="color: red">*</span></label>											
											<input id="ep_city" type="text" class="form-control" name="city" value="{{old('city', $result->city)}}"  placeholder="City">
											
											<!--@error('city')
											 <span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											 </span>
											@enderror
										
										
                                           <label>City</label>
                                            <input id="ep_city" name="city" type="text" placeholder="City" maxlength="50" value="{{$result->city}}">
                                                {!!$errors->first("city", "<span class='text-danger'>:message</span>")!!}-->
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6"> 
                                        <div class="form-row">
										    <label for="pincode">Pincode <span style="color: red">*</span></label>											
											<input id="ep_pincode" type="text" maxlength="6" class="form-control" name="pincode" value="{{old('pincode', $result->pincode)}}"  placeholder="Pincode">
											
											<!--@error('pincode')
											 <span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											 </span>
											@enderror
										
                                            <label>Pincode</label>
                                            <input id="ep_pincode" name="pincode" type="text" placeholder="Pincode"
                                                maxlength="6" value="{{$result->pincode}}">
                                                {!!$errors->first("pincode", "<span class='text-danger'>:message</span>")!!}-->
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6"> 									
                                        <div class="form-row">					
                                            <label>Board</label>
                                            <select id="board" name="board">
                                                <option value="0">Select Board</option>
                                                    <?php
                                                        foreach($boards as $board){                                       
                                                
                                                        if(strtolower(trim($board->boardname)) == strtolower(trim($result->board)))
                                                            {
                                                                $sel= 'selected'; 
                                                            } else {
                                                            $sel = '';                                                
                                                            } 
                                                            ?>  
                                                
                                                        <option value="{{$board->id}}" <?=$sel?>>{{ $board->boardname }}</option>                              
                                                    <?php  } ?>
                                            </select> 
                                            {!!$errors->first("board", "<span class='text-danger'>:message</span>")!!}                                                        
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6"> 
                                        <div class="form-row">							
                                            <label>Chain (optional)</label>
                                            <select id="chain" name="chain">
                                                <option value="0">Select Chain</option>
                                                <?php
                                                    foreach($chainopts as $chainopt){                                    
                                            
                                                    if(strtolower(trim($chainopt->chainname)) == strtolower(trim($result->chain)))
                                                        {
                                                            $sel= 'selected';                                    
                                            
                                                        } else {
                                                        $sel = '';                                    
                                                                } 
                                                        ?>  
                                            
                                                    <option value="{{$chainopt->id}}" <?=$sel?>>{{ $chainopt->chainname }}</option>                              
                                                <?php  } ?>
                                                </select>
                                        </div>
                                    </div>									
                                    
									<div class="col-sm-12 col-md-6">
                                        <div class="form-row">
                                            <label>Region</label>
                                            <input id="" name="region" type="text"
                                                placeholder="Region" maxlength="50" value="{{$result->region}}">
                                                
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-row">
                                            <label for="address">Address <span style="color: red">*</span></label>											
											<input id="address" type="text" maxlength="250" class="form-control" name="address" value="{{old('address', $result->address)}}"  placeholder="Address">
											
											<!--@error('address')
											 <span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											 </span>
											@enderror
											
											
											<!--<label>Address</label>
                                            <input id="" name="address" type="text"
                                                placeholder="Address" maxlength="150" value="{{$result->address}}">
                                                {!!$errors->first("address", "<span class='text-danger'>:message</span>")!!}-->
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-row">
                                             <label for="address">Landmark <span style="color: red">*</span></label>
                                            <input id="landmark" name="landmark" type="text"  placeholder="Landmark" maxlength="50" value="{{old('landmark', $result->landmark)}}">
                                        </div>
                                    </div>
                                </div>
                                  
                                    <div class="login-row"> 
                                         <div class="um-field" id="capcha-page-cont">
                                           <label for="captcha">Please Enter the Captcha Text</label><br>
                                           <div style="float:left; width:115px;  margin: 6px 0;" id="pagecaptcha-cont">
                                                <div class="captchaimg">
                                                    <span>{!! captcha_img() !!}</span>
                                                </div>
                                            </div>
                                           <div style="float:left; margin: 6px 20px 6px 10px; cursor: pointer;">
                                             <button type="button" class="btn btn-info" class="reload" id="reload"> ↻ </button>
                                           </div>
                                           
                                           <div style="float:left; width:40%">
                                               <input type="text" id="captcha" name="captcha" class="form-control" required  placeholder="Captcha">
                                                <!--@error('captcha')
                                                    <span class="invalid-feedback" role="alert" >
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror-->
                                           </div>
                                           <div style="clear:both;"></div>
                                       </div>
                                     </div>
                                    <div class="col-sm-12 col-md-3 p-0 mt-2">
                                        <div class="form-row ">
                                            <input type="submit" name="updateprofile" value="Submit" class="widthblock">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <script type="text/javascript">
                $('#state').change(function(){
                    state_id = $('#state').val();
                    $.ajax({
                        url: "{{ route('profile-dis') }}",
                        type: "post",
                        data: { "id":state_id,"_token": "{{ csrf_token() }}"} ,
                        success: function (response) {
                           console.log(response);
                           $('#district').html(response);
                        },
                        
                    });
                });

                $('#district').change(function(){
                    dist_id = $('#district').val();
                    $.ajax({
                        url: "{{ route('profile-blk') }}",
                        type: "post",
                        data: { "id":dist_id,"_token": "{{ csrf_token() }}"} ,
                        success: function (response) {
                           console.log(response);
                           $('#block').html(response);
                        },
                    });
                });
            </script>			
            </div>
        </div>
    </div>
</div>
</div>
 
</div>
@endsection