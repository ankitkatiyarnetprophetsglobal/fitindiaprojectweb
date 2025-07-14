@extends('layouts.app')
@section('title', 'Fit India Video Stream | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp

<section id="{{ $active_section_id }}">
  <div class="container">  
        <div class="row">
            <div class="col-sm-12  flex_parent ">
                <h2 class="heading_h2">Video Stream</h2>
                <div class="flex_child  all_event">
                   
                    <div class="form-group">
					<form method="GET" action="{{ route('event-video-search') }}">
                     <select class="custom-select custom-select " name="category" id="category" >
						<option value="">Event Category</option>
						@foreach($categories as $cat)
						<?php
						 // dd($cat);
			             if(!empty($_REQUEST['category'])&& $_REQUEST['category']==$cat->id){
			               $cstselect='selected';
			             }else{
			               $cstselect='';
			             }
			            ?> 
						<option  <?=$cstselect?>  value="{{ $cat->id }}">{{ $cat->name }}</option> 
					   @endforeach					  
					</select>      
                    </div>
                  
                    <div><button class="btn search-btn" type="submit" name="search" value="search">SEARCH</a></div>
					</form>					
                </div>
            </div>
        </div>   
       
        <div class="event_pt"> 
				@if(!empty($events))
                       @foreach($events as $event)
			@if(!empty($event->video))					   
            <div class="event_media">
			
			<a class="download_btn" href="{{$event->video}}" target="blank">
			
			<div class="event_photo-in videos">
			<img src="{{ asset('wp-content/uploads/doc/event-video-default.jpg') }}">
			<strong>{{$event->catname}}</strong></p>
			<div class="overlay">
			<span class="dashicons dashicons-video-alt3"></span><p class="category_name">
			</div>
			</div>
			</a>
			<h5 class="organiser"><strong>{{$event->name}}</strong></h5>
			<p class="video_det">{{$event->city}}, {{$event->state}}</p></div>@endif
			@endforeach
			@endif
        </div>
		
		<div class="d-flex justify-content-center">
          {{ $events->links() }} 
          </div> 

  </div>
</section>
@endsection