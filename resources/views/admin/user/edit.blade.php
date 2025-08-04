@extends('admin.layouts.app')
@section('title', 'Fit India Admin-Edit Users')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">          	
			<a class="" href="{{ route('admin.users.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
            <h1>Update User</h1>
          </div>
		</div> 	
			
		<div class="row mb-2">  
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item "><a href="{{ route('admin.users.index') }}"> User</li></a>
              <li class="breadcrumb-item active">Edit User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->  
	<section class="content">
      <div class="container-fluid">
        <div class="row">          
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
			
			
			
			
			<div class="card-header d-flex p-0">
                <!--<h3 class="card-title p-3">Update User Information</h3> -->
                <ul class="nav nav-pills ml-auto p-2" style="margin-left: unset!important;">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Update User</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Change User Password</a></li>
                 </ul>
              </div>
			  
			  
             
			  
			  <div class="card-body">
               
			   <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    
					
					<div>
							
							
							
							 @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
									
									<?php $result = $result[0];   ?>
							<div style="clear:both"></div>
								<form method="POST" action="{{ route('admin.users.update',$result->id) }}" >
								  @csrf
									  @method('PATCH')
                
									<input type="hidden" value="{{$result->id}}" name="user_id">

							
									<div class="form-group">
                                        <label for="formGroupExampleInpu">Name</label>
                                        <input id="" name="name" type="text" placeholder="Name"
                                            value="{{$result->name}}" class="form-control" >
                                            {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
                                    </div>
									
                                    <div class="form-group">
                                        <label for="formGroupExampleInpu"> Mobile</label>
                                        <input id="" name="phone" type="tel" maxlength="10" placeholder=" Mobile" value="{{$result->phone}}" class="form-control">
                                        {!!$errors->first("phone", "<span class='text-danger'>:message</span>")!!}
                                    </div>
									
                                    <div class="form-group">
                                        <label for="formGroupExampleInpu"> Email</label>
                                        <input id="" name="email" type="text"  placeholder="email" value="{{$result->email}}" class="form-control" readonly>
                                        {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
                                    </div>
                                    
 
                                    <div class="form-group">
                                        <label for="formGroupExampleInpu">State</label>
                                        <select id="state" name="state" class="form-control" aria-required="true" class="form-control">
										<option value="">Select State </option>
                                    <?php
                                    foreach($state as $st){
                                //echo "<pre>";print_r($st->name);
                              if(strtolower(trim($st->name)) == strtolower(trim($result->state)))
                                 {
                                      $ksel= 'selected';
 
                                        } else {
                                        $ksel = '';
                                  
                                         } 
                                        ?>  
                                

                                    <option value="{{$st->id}}" <?=$ksel?>>{{ $st->name }}</option>                              
                                      <?php } ?>
                                      {!!$errors->first("state", "<span class='text-danger'>:message</span>")!!}
                                      </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="formGroupExampleInpu">District</label>
                                        <select id="district" name="district" class="form-control" aria-required="true">
										<option value="">Select District </option>
                        
                        <?php
                            foreach($district as $dst){
                                
                                
                              if(strtolower(trim($dst->name)) == strtolower(trim($result->district)))
                              {
                                 $sel= 'selected';
                                
                                 
                               } else {
                                  $sel = '';
                                  
                                } 
                                 ?>  
                                 
                                <option value="{{$dst->id}}" <?=$sel?>>{{ $dst->name }}</option>                              
                              <?php  } ?>
                              {!!$errors->first("district", "<span class='text-danger'>:message</span>")!!}
                              
                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInpu">Block</label>
                                       <select id="block" name="block" class="form-control" aria-required="true">
									   <option value="">Select Block </option>
                              <?php
                              foreach($block as $blk){
                              if(strtolower(trim($blk->name)) == strtolower(trim($result->block)))
                              {
                                 $sel= 'selected';
                                
                                 
                               } else {
                                  $sel = '';
                                  
                                } 
                                 ?>  
                                <option value="{{$blk->id}}" <?=$sel?>>{{ $blk->name }}</option>                              
                              <?php  } ?>
                              {!!$errors->first("block", "<span class='text-danger'>:message</span>")!!}
                                    </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="formGroupExampleInpu">City</label>
                                        <input id="ep_city" name="city" type="text" placeholder="City" maxlength="50"
                                            value="{{$result->city}}" class="form-control">
                                            {!!$errors->first("city", "<span class='text-danger'>:message</span>")!!}
                                    </div>

                                    <div class="form-group">
                                        <label>Pincode</label>
                                        <input id="ep_pincode" name="pincode" type="text" placeholder="Pincode"
                                            maxlength="6" value="{{$result->pincode}}" class="form-control">
                                           
                                    </div>
							
                                    

                                    
                                       
                                    <div class="form-group">
                                        <button type="submit" name="updateprofile" value="Submit" class="btn-primary">Update</button>
                                    </div>
                                </form>
								
								
								
								
								
						</div>
						
						
                  </div>
                 
                  <div class="tab-pane" id="tab_2">
				  
				  <form method="POST" action="{{ route('admin.users.update',$result->id) }}" >
								  @csrf
									  @method('PATCH')
									  <input type="hidden" value="{{$result->id}}" name="user_id">
                    <div class="form-group"> 
									
							<label for="password">New Password</label>
							<i style="color:blue">P.S-password must have minimum 8 letters & must have [alpha-numeric] character,
							must have one Capital letter and one Special character & Number</i>
							<input id="password" type="password" class="form-control " name="password"  autocomplete="new-password" placeholder="Password">
							{!!$errors->first("password", "<span class='text-danger'>:message</span>")!!}
										
										
						</div>
						
						<div class="form-group"> 
							<label for="password">Confirm Password</label>
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password" placeholder="Confirm Password">
							{!!$errors->first("password_confirmation", "<span class='text-danger'>:message</span>")!!}
										
										
						</div>
						 <div class="form-group">
                                        <button type="submit" name="changepass" value="changepass" class="btn-primary">Update</button>
                                    </div>
						</form>
                  </div>
                  
                  
                </div>
                
              </div>
             
                
              
														
								
								
								
								
                            </div>
                        </div>
                    </div>
                </div>
				</div>
            </div>
            
            </section>
	
    <!-- /.content -->
  </div>


            <script type="text/javascript">
                $('#state').change(function(){
                    state_id = $('#state').val();
                    $.ajax({
                        url: "{{ route('admin.user-profile-dis') }}",
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
                        url: "{{ route('admin.user-profile-blk') }}",
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
@endsection
             
             
                      

                                    


               


              