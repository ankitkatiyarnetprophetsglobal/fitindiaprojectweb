@extends('admin.layouts.app')
@section('title', 'Update Announcement - Fit India')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <a class="" href="{{ route('admin.announcement.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back</a>
            <h1>Update Announcements</h1>
          </div>
    </div>
    
    <div class="row mb-2">  
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.announcement.index') }}">annoucements</li></a>
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
                <h3 class="card-title">Edit Announcement</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <form method="POST" action="{{ route('admin.announcement.update', $annunce->id) }}" enctype="multipart/form-data">
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
                            <label for="exampleInputEmail1">Title:*</label>
                            <input type="text" name="title"  value="{{ $annunce->title }}" class="form-control" id="title" placeholder="Enter Title">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description:*</label>
                            <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $annunce->description }}</textarea>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">URL:*</label>
                                <input type="text" name="url" value="{{ $annunce->url }}" class="form-control" id="Url" placeholder="Enter Url">
                            </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image:*</label>
                            <input type="file" name="image"  class="form-control">
                            <img src="{{ $annunce->image }}" height="200" width="200">
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