@extends('admin.layouts.app')
@section('title', 'Fit India Admin-Edit Freedomrun Organizer')
@section('content')
<?php //echo "<pre>"; print_r($organizer); die; ?>
<div class="content-wrapper">  
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
		    <a class="" href="{{ url('admin/freedomrun-organizer') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
            <h1>Update Organizer</h1>
          </div>
		</div> 		
		<div class="row mb-2">  
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ url('admin/freedomrun-organizer') }}"> Organizer</li></a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
	<section class="content">
      <div class="container-fluid">
        <div class="row">          
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">               
              </div>             
              <form method="POST" action="{{ route('admin.freedomrun-organizer.pupdate',@$organizer->id) }}" enctype="multipart/form-data"> 
					@csrf
					@method('PATCH')									
					<input type="hidden" name="freedom_id" value="{{ @$organizer->id }}">					
					 <div class="card-body">					    
						 @if(session('status'))
                          <div class="alert alert-success">
                              {{ session('status') }}
                          </div>
                      @endif 

                       @if(session('failed'))
                          <div class="alert alert-danger">
                              {{ session('failed') }}
                          </div>
                      @endif

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
									
											<div class="form-group">
												<label for="name"> User Name</label>
												 <input id="name" type="text" name="name" class="form-control" value="{{$organizer->name}}" readonly>
											    	
											</div>		
											
											
											<div class="form-group">
												<label for="videolink">Email</label>
												<input id="email" type="email" name="email" class="form-control" value="{{$organizer->email}}" readonly>
												
											</div>	
											
							        <div class="form-group">
												<label for="">Mobile No.</label>
												<input id="contact" type="text" name="contact" class="form-control" value="{{$organizer->phone}}" readonly>
											</div>
						
					
											<?php $event_img_arr =  unserialize($organizer->eventimg_meta); 
				            
				             		if(!empty($event_img_arr)){ $i=1; ?>	
				             				<div class="form-group"> 
				             							<label for="">Image </label><br>
				             					<?php
				             					foreach($event_img_arr as $key=>$event_img_value){ ?>
				             	   	
				                  		<img src="<?=$event_img_value?>" width="50" height="50"/>

				                			<?php $i++; } ?> 
				                		</div>
				 											<?php	} ?> 		


					             <div class="form-group">
					                <div class="multiple_video_section">
					                   <?php $video_link_arr =  unserialize($organizer->video_link); 
					                   if(!empty($video_link_arr)){ $i=1; foreach($video_link_arr as $key=>$video_link_value){ ?>
					                    <div class="um-field">
					                        <div class="um-field-label">
					                          <label for="eventimage1">Video Link <?=$i?></label>
					                            <div class="um-clear"></div>
					                        </div>
					                        <div class="um-field-area">
					                        		<input type="url" name="video_link[<?=$key?>]" class="form-control" placeholder="Video Link" value="<?=$video_link_value?>">     
					                     		</div>
					                    </div>
					                    <?php $i++;} } ?>
					                </div>				
					            </div>
					            <div class="form-group">
												<label class="org_name_change" for="organiser_name">Organisation's Name* / School Name*</label>
												<input id="organiser_name" type="text" name="organiser_name" class="form-control" value="{{ $organizer->name }}">
											</div> 	
											
				

											<div class="row" id="prt_km_details">
											  	<div class="col-sm-6 col-md-6">
							             		<div class="form-group">
																	<label for="fromdate">From Date</label>
																	<input type="text" name="eventstartdate" class="eventdate form-control" id="eventstartdate" class="form-control" value="{{ $organizer->eventstartdate }}" readonly>
															</div>	
					            		</div>
					            		<div class="col-sm-6 col-md-6">
					                		<div class="form-group">
											   					<label for="tdate">To Date</label>
																	<input type="text" name="eventenddate" class="eventdate form-control" id="eventenddate" class="form-control" value="{{ $organizer->eventenddate }}" readonly>
															</div>
					            		</div>
                                              <?php
                                              $total_participants = 0;
                                              $total_kms = 0;
                                              
                                              $text_disabled = '';
                                              $eventdate_meta =  unserialize($organizer->eventdate_meta); 
                                              $eventpnt_meta =  unserialize($organizer->eventpnt_meta); 
                                              $eventkm_meta =  unserialize($organizer->eventkm_meta); 
                                             	if(!empty($eventdate_meta)){
                                              for($k=0;$k<count($eventdate_meta);$k++){


                                              if($eventdate_meta[$k] > date('Y-m-d')){
                                                $text_disabled = 'readonly';
                                              }else{
                                                $text_disabled = '';
                                              }

                                              $total_participants = $total_participants+$eventpnt_meta[$k];
                                              $total_kms = $total_kms+$eventkm_meta[$k];
                                              ?>
                                              <div class="col-sm-12 col-md-4">
                                                  <div class="form-group ">
                                                      <input type="text" name="prt_date[<?=$k?>]" class="form-control km" value="<?=$eventdate_meta[$k];?>" readonly>
                                                  </div>
                                              </div>
                                              <div class="col-sm-12 col-md-4">
                                                  <div class="form-group ">
                                                      <input type="text" name="number_of_partcipant[<?=$k?>]" class="form-control prt number_of_partcipant" placeholder="no. of participant (each day)"  value="<?=$eventpnt_meta[$k];?>">
                                                  </div>
                                              </div>
                                              <div class="col-sm-12 col-md-4">
                                              <div class="form-group ">
                                              <input type="text" name="km[<?=$k?>]" class="form-control kms_field km_number" placeholder="Kms (each day)"  value="<?=$eventkm_meta[$k];?>">
                                              </div>
                                              </div>
                                              <?php } } ?>

                                              <div class="col-sm-12 col-md-4">
                                                  <div class="form-group area_div_p" style="font-size:18px;padding:5px 8px;">
                                                      <b>Total</b>
                                                  </div>
                                              </div>

                                              <div class="col-sm-12 col-md-4">
                                                  <div class="form-group area_div_p">
                                                    <input type="hidden" name="participant_count_2" id="participant_count_2">
                                                    <input type="text" value="<?=$total_participants?>" name="total_participants">
                                                      Total Participant : <span id="participant_count">0</span>
                                                  </div>
                                              </div>

                                               <div class="col-sm-12 col-md-4">
                                                  <div class="form-group area_div_p">
                                                    <input type="hidden" name="kms_count_2" id="kms_count_2">
                                                    <input type="text" value="<?=$total_kms?>" name="total_kms">
                                                      Total Kms : <span id="kms_count">0</span>
                                                  </div>
                                              </div>
                                           

                                          </div>

				           


															
													<div class="um-field">
															<div class="um-field-area">
															<input type="submit" name="create-event" class="btn btn-sm btn-primary" value="Submit">
													</div>
								   		</div>
									</form>
							</div>						
            
      </div><!-- /.container-fluid -->
    </section>	
    <!-- /.content -->
  </div>
@endsection