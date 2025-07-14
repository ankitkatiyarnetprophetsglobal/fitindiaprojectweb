@extends('admin.layouts.app')
@section('title', 'Update Bulletin - Fit India')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <a class="" href="{{ route('admin.bulletin.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back</a>
            <h1>Update Bulletin</h1>
          </div>
    </div>
    
    <div class="row mb-2">  
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.bulletin.index') }}">Bulletin</li></a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- Main content -->
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Bulletin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <form method="POST" action="{{ route('admin.bulletin.update', $bulletin->id) }}" enctype="multipart/form-data">
                      @csrf
                       @method('PATCH')
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
                            <label for="exampleInputEmail1">Title:</label>
                            <input type="text" name="title"  value="{{ $bulletin->title }}" class="form-control" id="title" placeholder="Enter Title">
                        </div>
						
						<div class="form-group">
							<label for="Date">Date:</label>
							<input type="date" name="bulletin_date" class="eventdate" value="{{ $bulletin->bulletin_date }}" id="bulletin_date" class="form-control">
						</div>						
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description:</label>
                            <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $bulletin->description }}</textarea>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Url:</label>
                                <input type="text" name="url" value="{{ $bulletin->url }}" class="form-control" id="Url" placeholder="Enter Url">
                            </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Attachment:</label>
                            <input type="file" name="doc"  class="form-control">
                            <a href="{{ $bulletin->attachment }}" target="_blank">Document Url</a>
                        </div>
						<div class="form-group">
							<label for="exampleInputEmail1">Status:</label>
							<input type="radio" name="status" value="<?=($bulletin->status=='1') ? 'checked':'' ?>" checked>Active <input type="radio" name="status" value="<?=($bulletin->status=='0') ? 'checked':'' ?>"> In Active
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