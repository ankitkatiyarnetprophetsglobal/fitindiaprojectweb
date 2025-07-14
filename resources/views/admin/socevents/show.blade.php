@extends('admin.layouts.app')
@section('title', ' Fit India Admin-Show Posts Category')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->	
	<section class="content-header">
      <div class="container-fluid">
	   <div class="row mb-2">
          <div class="col-sm-6">           
			<a class="" href="{{ route('admin.posts.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
            <h1>Show Post Category</h1>
          </div>
        </div>
	  
        <!--<div class="row mb-2">
          <div class="col-sm-12">
            <h1>Show Posts</h1>
          </div>
		    </div>-->  
		  
    		<div class="row mb-2">  
    		  <div class="col-sm-6">
    		    <div class="pull-right">
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item "><a href="{{ route('admin.posts.index') }}">Posts</a></li>
                  <li class="breadcrumb-item active">Show Posts</li>
                </ol>
              </div>  
            </div>
          </div>		  
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <hr>	
    <section class="content-header">
      <div class="container-fluid">
        <!-- <div class="row">
          <div class="col-md-12">
          
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">show posts</h3>
              </div>
            </div>
          </div>
		    </div> -->

<!--  <div class="e_img">
             <img src="{{asset('resources/imgs/Fit-India-Dialogue-banner.jpg') }}" />
        </div> -->
        
        {{-- @if ($message = Session::get('success'))
          <div class="alert alert-success">
              <p>{{ $message }}</p>
          </div>
        @endif --}}
	     <div class="row ml-3">		 
      		<div class="col-md-12"> 
            @if(Session::has('message'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
              {{ Session::get('message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>



              {{-- <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p> --}}
            @endif
      		  <div class="card">
                  <div class="card-header card-primary bg_blue">
                  <h3 class="card-title">Show Posts</h3>
                </div> 
              <div class="e_img" style="padding-left: 244px;">
                @if($post->image != "")
                  <li class="list-group-item">
                    <img src="{{ $post->image }}" height="200" width="200">
                  </li>
                @endif
                @if($post->video_post != "")
                  <li class="list-group-item">                                   
                    <iframe width="420" height="315" src="{{ $post->video_post }}"> </iframe>                    
                  </li>
                @endif  
            </div>
      			  <div class="card-body">
      				<h5 class="card-title">Title : <b>{{ $post->title }}</b></h5>
      				<p class="card-text"></p>
      			  </div>

      			  <ul class="list-group list-group-flush">
        				<li class="list-group-item">Category : 
                  @foreach ($post->post_category as $post_category)
                    <b>{{ Str::ucfirst($post_category['name']) }}</b>
                  @endforeach
                  {{-- <b>{{ $post->post_category }}<b> --}}
                </li>
        				<li class="list-group-item">{{ $post->description }}</li>
                
                <li class="list-group-item">Created at: {{ date('d-m-y', strtotime($post->created_at)) }}</li>
                <li class="list-group-item">Updated at: {{ date('d-m-y', strtotime($post->updated_at)) }}</li>
      			  </ul>
      			  {{-- <h3>Comment</h3> --}}
              {{-- <h1>Comment</h1> --}}
              {{-- {{ dd(Auth::user()->role_id) }} --}}
              @if(Auth::user()->role_id == 9)
                <div class="card-header card-primary bg_blue">
                  <h3 class="card-title">Comment</h3>
                </div>
                <ul class="list-group list-group-flush">                
                  @foreach($post->getPostwisecomment as $x => $val) 
                    <li class="list-group-item">{{ $val->comment }}</li>
                    <li class="list-group-item">{{ $val->created_at }}</li>
                    @if($val->comment_status == 1)
                        <a style="display: inline !important;"class="btn btn-danger btn-xs" href="{{ route('admin.PostCommentStatus',$val->id) }}/0/{{ $post->id }}">                     
                          InActive                      
                        </a>
                    @elseif($val->comment_status == 0)
                        {{-- <li class="list-group-item"></li> --}}
                        <a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.PostCommentStatus',$val->id) }}/1/{{ $post->id }}"> 
                          Active                      
                        </a>
                    @endif
                  @endforeach
              @endif
                  
        				{{-- <li class="list-group-item">Category : <b>{{ $post->post_category }}<b></li>
        				<li class="list-group-item">{{ $post->description }}</li>                
                <li class="list-group-item">Created at: {{ date('d-m-y', strtotime($post->created_at)) }}</li>
                <li class="list-group-item">Updated at: {{ date('d-m-y', strtotime($post->updated_at)) }}</li> --}}
      			  </ul>



      			</div>
      		</div>
      </div>
	  </div>
    </section>
  </div>
@endsection