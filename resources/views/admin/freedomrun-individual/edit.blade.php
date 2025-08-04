@extends('admin.layouts.app')
@section('title', 'Fit India Admin-Edit freedomrun')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
		    <a class="" href="{{ route('admin.freedomrun-individual.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
            <h1>Update Freedomrun</h1>
          </div>
		</div> 		
		<div class="row mb-2">  
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.freedomrun-individual.index') }}"> Freedomrun</li></a>
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
           
              <form method="POST" action="{{ route('admin.freedomrun-individual.update',$freedomrun->id) }}" enctype="multipart/form-data"> 
					@csrf
					@method('PATCH')									
					<input type="hidden" name="freedom_id" value="{{ $freedomrun->id }}">					
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
							<label for="name"> User Name</label>
							 <input id="name" type="text" name="name" class="form-control" value="{{$freedomrun->name}}">
						    	
						</div>		
						
						
						<div class="form-group">
							<label for="videolink">Email</label>
							<input id="email" type="email" name="email" class="form-control" value="{{$freedomrun->email}}">
							
						</div>	
						
		               <div class="um-field-label">
							<label for="">Mobile No.</label>
							<input id="contact" type="text" name="contact" class="form-control" value="{{$freedomrun->contact}}">
							
						</div>
						
						<div class="form-group">
							<label for="pic1">Pic 1</label>
							<input type="file" id="eventimage1" name="eventimage1" class="form-control" >
							
							<?php if($freedomrun->eventimage1!=''){ ?>
							 <img src="{{ $freedomrun->eventimage1 }}" width="100" height="100">
						    <?php } ?>
						</div>	
						
						<div class="form-group">
							<label for="pic2">Pic 2</label>
							<input type="file" id="eventimage2" name="eventimage2" class="form-control" >
							
							<?php if($freedomrun->eventimage2!=''){ ?>
							 <img src="{{ $freedomrun->eventimage2 }}" width="100" height="100">
						    <?php } ?>
						</div>	
						

                        <div class="form-group">
							<label class="org_name_change" for="organiser_name">Organisation's Name* / School Name*</label>
							<input id="organiser_name" type="text" name="organiser_name" class="form-control" value="{{ $freedomrun->organiser_name }}">
							
						</div>		
											
						<div class="form-group">
							<label for="event_name">No of Participants</label>
							<input id="participantnum" type="text" name="participantnum" class="form-control" value="{{ $freedomrun->participantnum }}">
							
						</div>					 						
						
						<div class="form-group">
							<label for="fromdate">From Date</label>
							<input type="date" name="eventstartdate" class="eventdate" id="eventstartdate" class="form-control" value="{{ $freedomrun->eventstartdate }}">
							
						
						   <label for="tdate">To Date</label>
							<input type="date" name="eventenddate" class="eventdate" id="eventenddate" class="form-control" value="{{ $freedomrun->eventenddate }}">
											
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