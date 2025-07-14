@extends('admin.layouts.app')
@section('title', 'Create Posts - Fit India')
@section('content')
<style>
.mb-3{ margin-bottom: 0 !important; margin-right: 10px; }
.btn-sm{ padding: .375rem .75rem; }
.rtside{ float:right; }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <a class="" href="{{ route('admin.posts.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>			
            <h1 scope="col">Add Posts</h1>
          </div>
		</div>  
		  
		<div class="row mb-2">  
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
                <div class="pull-right">
                    
                </div>              
            </ol>
          </div>
		  
		  <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">               
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.posts.index') }}">Posts</a></li>
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
                <h3 class="card-title">Add Posts</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
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
                                <label for="exampleInputEmail1" scope="col">Title: *</label>
                                <input type="text" name="title" class="form-control" id="title" value="{{ old('title')}}" placeholder="Enter Title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" scope="col">Post Category:*</label>
                                  @if(!empty($post_cat))
                                    @foreach($post_cat as $cat)  
									                    <input type="checkbox" name="post_category[]" value="{{ $cat->id }}"  {{ (is_array(old('post_category')) && in_array($cat->name, old('post_category'))) ? ' checked' : '' }}> {{ $cat->name }}
									                  @endforeach
                                  @endif
                                </select>
                            </div>                            
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1" scope="col">language:*</label>
                                  @if(!empty($language))
                                    <select name="language" id="language">
                                      @foreach($language as $lang)  
                                        <option value="{{ $lang->lang_slug }}">{{ $lang->name}}</option>
                                        {{-- <input type="checkbox" name="post_category[]" value="{{ $lang->id }}"  {{ (is_array(old('post_category')) && in_array($lang->name, old('post_category'))) ? ' checked' : '' }}> {{ $lang->name }} --}}
                                      @endforeach
                                    </select>
                                  @endif
                                </select>
                            </div>
							
							<?php //{{ (in_array(old('post_category')) && in_array($cat->name,old('post_category'))) ? 'checked':'' }}?>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Description:*</label>
                                <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Post Category:*</label>
                                <input type="radio" id="post_article" name="post_category_wise" value="post_article" checked="checked" onclick="hide_video()">
                                <label for="html" onclick="hide_video()">Post / Article</label>
                                <input type="radio" id="video" name="post_category_wise" value="video" onclick="hide_post_article()">
                                <label for="css" onclick="hide_post_article()">video</label>
                            </div>
                            <div id="divimage" class="form-group">
                                <label for="exampleInputEmail1">Post Image:*</label>
                                <input type="file" id="image" name="image" class="form-control" placeholder="Post Image" >
                            </div>
                            <div id="videodiv" class="form-group" style="display: none;">
                                <label for="exampleInputEmail1">Youtube Video Link:*</label>
                                <input type="text" id="video_post" name="video_post" class="form-control" placeholder="Youtube Video Link" >
                            </div>
                        </div>                       
                        <div class="card-footer">
                          <button type="submit" class="btn btn-sm btn-primary">Submit</button>
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
  <script>
    function hide_video() {

      $("div#divimage").show();
      $("div#videodiv").hide();
      $("#video_post").val('');
      return( false );      

    }
    function hide_post_article() {

      $("div#divimage").hide();
      $("div#videodiv").show();
      $("#image").val('');
      // $("div#videodiv").hide();
      return( false );

    }
  </script>
@endsection