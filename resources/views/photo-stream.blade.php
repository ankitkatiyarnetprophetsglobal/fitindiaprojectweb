@extends('layouts.app')
@section('title', 'Fit India Photo Stream | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<section id="{{ $active_section_id }}">
  <div class="container">									 
        <div class="row">
            <div class="col-sm-12  flex_parent ">
                <h2 class="heading_h2">Photo Stream</h2>
                <div class="flex_child  all_event">
                                     
                    <div class="form-group">                          
                        <form method="GET" action="{{ route('photo-search') }}">
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
                  
                   <div> <button class= "btn search-btn" type="submit" name="search" value="search" style="background-color:red">SEARCH</a></div>
                    
					</form>	                       
                </div>
            </div>
        </div>   
        <div class="row">
					
									
						
            <div class="event_pt"> 
				@if(!empty($events))
                       @foreach($events as $event)		
            <div class="event_media">
			<div class="event_photo-in videos">
			@if(!empty($event->eventimage1 || $event->eventimage2))
			
			<img src="{{$event->eventimage1}}" class="img-fluid" />
			@endif
			<span class="dashicons dashicons-video-alt3"></span></a><p class="category_name">
			<strong>{{$event->catname}}</strong></p>
			<div class="overlay"></div>
			</div><p class="organiser"><strong>{{$event->name}}</strong></p>
			<p>{{$event->city}}, {{$event->state}}</p></div>
			@endforeach
			@endif
             
        </div>
        </div> 
		<div class="d-flex justify-content-center">
          {{ $events->links() }} 
          </div> 
		  </div>
</section>
@endsection