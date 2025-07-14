@extends('admin.layouts.app')
@section('title', 'Create Event Archive - Fit India')
@section('content')
<style>
.form-row {
    margin-bottom: 10px;
    margin-top: 10px;
}

label {
    display: inline-block;
    margin-bottom: .5rem;	
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <a class="btn btn-primary btn-sm" href="{{ route('admin.eventarchive.index') }}"> Back</a>
            <h1>Add Event Archive</h1>
          </div>
          </div>
     <div class="row mb-2">  
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.eventarchive.index') }}">Event Archive</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">          
          <div class="col-md-12">          
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Event Archive</h3>
              </div>             
              <form method="POST" action="{{ route('admin.eventarchive.store') }}" enctype="multipart/form-data">
			    @csrf
                <div class="card-body">
                @if(session('status'))
				 <div class="alert alert-success">
					{{ session('msg') }}
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
				
				<div class="form-row">
					<div class="col col-md-6">
					  <label for="title"> Name <span style="color: red">*</span></label>
					  <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}" placeholder="Name">
					</div>
					<div class="col col-md-6">					 
					  <label for=""> Poster Image <span style="color: red">*</span></label>
					  <input type="file" name="image" class="form-control">
					</div>
				</div>
								
				<div class="form-row">
					<div class="col col-md-6">
					  <label for="title"> Start Date <span style="color: red">*</span></label>
					  <input type="date" name="start_date" value="{{old('start_date')}}" style="width:250px;" class="form-control" id="start_date" placeholder="Start Date">
					</div>
					
					<div class="col col-md-6">
					  <label for="title"> End Date <span style="color: red">*</span></label>
					  <input type="date" name="end_date" value="{{old('end_date')}}" style="width:250px;" class="form-control" id="link" placeholder="End Date">
					</div>
				</div>
				
				<div class="form-row">
					<div class="col col-md-6">
					   <label for="title"> Role <span style="color: red">*</span></label>				  
					    <select class="form-control" name="role[]" id="role" autocomplete="role" multiple autofocus>
						 <!--<option value="">{{'Select'}}</option>-->
						   @if(!empty($roles))
							@foreach($roles as $role)						
							 <option <?php if(isset($_GET['role'])){ if(base64_decode($_GET['role']) ==  $role->slug){ echo "selected='selected'";}} ?> value="{{ $role->id }}"  @if(old('role') == $role->slug) {{ 'selected' }} @endif >{{ ucwords(strtolower($role->name))}}</option>
							@endforeach
						   @endif
						</select>
					</div>
					<div class="col col-md-6">
					 <label for="title"> Link <span style="color: red">*</span></label>
					  <input type="text" name="link" class="form-control" value="{{old('link')}}" id="link" placeholder="URL">
					</div>				
				</div>				
				<div class="form-row">
					<div class="col col-md-6">
					  <label for="title"> Language <span style="color: red">*</span></label> 
					  <select class="form-control" name="language" id="language" >
					     <option value="">{{'Select'}}</option>
						 @if(!empty($language))
							@foreach($language as $lan)						
							 <option <?php if(isset($_GET['language'])){ if(base64_decode($_GET['language']) ==  $lan->name){ echo "selected='selected'";}} ?> value="{{ $lan->name }}"  @if(old('language') == $lan->name) {{ 'selected' }} @endif >{{ ucfirst(strtolower($lan->name)) }}</option>
							@endforeach
						 @endif	
					  </select>		
					</div>
					
					<div class="col col-md-6">
					  <label>Status</label><br>					  
					  <input type="radio" name="status" value="Active" checked=""> Active  <input type="radio" name="status" value="Inactive"> Inactive 
					</div>
				</div>
                </div>				
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
              </form>
            </div>
  		 </div>
        </div>     
      </div><!-- /.container-fluid -->
    </section>
  </div>
@endsection