@extends('admin.layouts.app')
@section('title', 'Fit India Admin-Edit Posts')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
     <div class="row mb-2">
      <div class="col-sm-12">       
		<a class="" href="{{ route('admin.posts.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
      <h1>Edit Posts</h1>
      </div>
     </div>    
        <div class="row mb-2">          
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">                
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}"><strong>posts</strong></a></li>
              
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
                <h3 class="card-title">Edit Posts</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data">
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
                            <input type="text" name="title"  value="{{ $post->title }}" class="form-control" id="title" placeholder="Enter Title">
                        </div>
                        {{-- {{ dd($post->post_category[1]['id']) }} --}}
                          <div class="form-group">
                                  <label for="exampleInputEmail1">Post Category:*</label>
                                  
                                    @if(!empty($post_cat))
                                      @foreach($post_cat as $k => $val)
                                        @php $is_checked = false; @endphp
                                          @foreach($post->post_category as $cat)
                                            @if($cat->id == $val->id)
                                              @php $is_checked = true; @endphp
                                            @endif
                                          @endforeach
                                            <input type="checkbox" @if($is_checked) checked @endif name="post_category[]"  value="{{ $val->id }}">{{ $val->name }}
                                      @endforeach
                                    @endif
                                  </select>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1" scope="col">language:*</label>
                              {{-- {{ dd($post->lang_slug) }} --}}
                                @if(!empty($language))
                                  <select name="language" id="language">
                                    @foreach($language as $lang)  
                                      <option value="{{$lang->lang_slug}}" <?php if($lang->lang_slug == $post->lang_slug){ echo 'selected'; } ?>>
                                        {{ $lang->name}}
                                      </option>
                                      {{-- <input type="checkbox" name="post_category[]" value="{{ $lang->id }}"  {{ (is_array(old('post_category')) && in_array($lang->name, old('post_category'))) ? ' checked' : '' }}> {{ $lang->name }} --}}
                                    @endforeach
                                  </select>
                                @endif
                              </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description:*</label>
                                <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $post->description }}</textarea>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Post Category:*</label>
                              <input type="radio" id="post_article" name="post_category_wise" value="post_article" 
                                    @if($post->image != "")
                                      checked="checked" 
                                    @endif  
                              onclick="hide_video()">
                              <label for="html" onclick="hide_video()">Post / Article</label>
                              <input type="radio" id="video" name="post_category_wise" value="video" 
                                @if($post->video_post != "")
                                  checked="checked" 
                                @endif 
                              onclick="hide_post_article()">
                              <label for="css" onclick="hide_post_article()">video</label>
                          </div>
                          
                          @if($post->image != "")
                              <div id="divimage" class="form-group">
                                <label for="exampleInputEmail1">Post Image:*</label>
                                <input type="file" id="image" name="image" class="form-control" placeholder="Post Image">
                                <br/>
                                <img src="{{ $post->image }}" height="200" width="200">
                              </div>       
                          @else
                            <div id="divimage" class="form-group" style="display: none;">
                              <label for="exampleInputEmail1">Post Image:*</label>
                              <input type="file" id="image" name="image" class="form-control" placeholder="Post Image">
                            </div>       
                          @endif  
                            {{-- {{ dd($post->video_post) }}                    --}}
                            @if($post->video_post != "")
                              <div id="videodiv" class="form-group" >
                                <label for="exampleInputEmail1">Video:*</label>
                                <input type="text" id="video_post" name="video_post" class="form-control" placeholder="Video Post" value="{{ $post->video_post ?? '' }}">
                              </div>                                 
                              @else  
                              <div id="videodiv" class="form-group" style="display: none;">
                                <label for="exampleInputEmail1">Video:*</label>
                                <input type="text" id="video_post" name="video_post" class="form-control" placeholder="Video Post">
                              </div>                                 
                            @endif
                          
                              {{-- <div class="form-group">
                                  <label for="exampleInputEmail1">Image:*</label>
                                  <input type="file" name="image"  class="form-control">
                                <img src="{{ $post->image }}" height="200" width="200">
                              </div>
                            </div> --}}

                <!-- /.card-body -->

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
      return false;      

    }
    function hide_post_article() {

      $("div#divimage").hide();
      $("div#videodiv").show();
      // $("div#videodiv").hide();
      return false;

    }
  </script>
@endsection