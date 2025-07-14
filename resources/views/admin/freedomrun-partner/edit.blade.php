@extends('admin.layouts.app')
@section('title', 'Fit India Admin-Edit Partners')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
		    <a class="" href="{{ url('admin/freedomrun-partner') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>          	
            <h1>Update Partners</h1>
          </div>
		</div> 		
		<div class="row mb-2">  
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ url('admin/freedomrun-partner') }}"> Partners</li></a>
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
              <div class="card-header">               
              </div>           
              <form method="POST" action="{{ route('admin.freedomrun-partner.pupdate', $partner->id)}}" enctype="multipart/form-data"> 
					@csrf
					@method('PATCH')									
					<input type="hidden" name="partner_id" value="{{ $partner->id }}">					
					 <div class="card-body">					    
						 @if (session('status'))
                          <div class="alert alert-success">
                              {{ session('status') }}
                          </div>
                      @endif

                        @if ($errors->any())
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
							<label for="name">Organization Name</label>
							 <input id="org_name" type="text" name="org_name" class="form-control" value="{{$partner->org_name}}">
						    	
						</div>							
						
						<div class="form-group">
							<label for="videolink">Event Name</label>
							<input id="event_name" type="text" name="event_name" class="form-control" value="{{$partner->event_name}}">							
						</div>	
						
						<div class="form-group">
							<label for="videolink">Email </label>
							<input id="email_id" type="email" name="email_id" class="form-control" value="{{$partner->email_id}}">							
						</div>						
						
		               <div class="um-field-label">
							<label for="">Mobile No.</label>
							<input id="contact" type="text" name="contact" class="form-control" value="{{$partner->contact}}">
					    </div>
						
						<div class="form-group">
							<label for="pic1">Pic 1</label>
							<input type="file" id="photo" name="photo" class="form-control" >
							<input type="hidden" id="cphoto" name="cphoto" value="{{$partner->photo}}">
							
							
							<?php if($partner->photo!=''){ ?>
							 <img src="{{ $partner->photo }}" width="100" height="100">
						    <?php } ?>
						</div>
						<div class="form-group">
							<label for="fromdate">From Date</label>
							<input type="date" name="from_date" class="eventdate" id="from_date" class="form-control" value="{{ $partner->from_date }}">
							<label for="tdate">To Date</label>
							<input type="date" name="to_date" class="eventdate" id="to_date" class="form-control" value="{{ $partner->to_date }}">
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