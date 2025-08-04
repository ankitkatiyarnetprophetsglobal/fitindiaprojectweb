@extends('admin.layouts.app')
@section('title', 'Bulletin - Fit India')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <a class="" href="{{ route('admin.bulletin.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back</a>
            <h1>Add Bulletin</h1>
          </div>
          </div>
     <div class="row mb-2">  
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.bulletin.index') }}">Bulletin</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!--Main content-->    
    <section class="content">
      <div class="container-fluid">
        <div class="row">          
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Bulletin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.bulletin.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
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
                            <label for="userEmail">Title *</label>
                            <input type="text" class="form-control " name="title" value="{{ old('title') }}">
                           
                        </div>
						
						<div class="form-group">
							<label for="Date">Date:</label>
							<input type="date" name="bulletin_date" class="eventdate" id="bulletin_date" class="form-control " value="{{ old('bulletin_date')}}">
							
						</div>	
							
                        <div class="form-group"> 
                            <label for="url">Description:*</label>						
                            <textarea name="description" id="description" cols="9" rows="5" class="form-control ">{{ old('description') }}</textarea>
                            
                        </div>					
						
						<div class="form-group">
							<label for="url">Url:*</label>
							<input type="text" name="url" class="form-control" id="Url" value="{{ old('url')}}" placeholder="Enter Url">
							
						</div>

						<div class="form-group">
							<label for="exampleInputEmail1">Attachment:</label>
							<input type="file" name="doc" class="form-control" accept=".pdf,.doc,.jpeg,.gif,.png" placeholder="Attachment">
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1">Status:</label>
							<input type="radio" name="status" value="1" checked>Active <input type="radio" name="status" value="0"> In Active
						</div>						
					</div>
					<!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection