@extends('layouts.app')
@section('title', 'Fit India All Event | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<section id="{{ $active_section_id }}">
  <div class="container">
									 
        <div class="row">
            <div class="col-sm-12  flex_parent ">
                <h2 class="heading_h2">All Events</h2>
                <div class="flex_child  all_event">
                  <p><strong>Total Events:</strong><span>{{$count}}</span></p>                     
                    <div class="form-group">                          
                        <form method="GET" action="{{ route('event-search') }}">
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
                  
                    <div><button class="btn search-btn" type="submit" name="search" value="search" >SEARCH</a></div>
                    
					</form>	                       
                </div>
            </div>
        </div>   
        <div class="row">
					@if(!empty($events))
                       @foreach($events as $event)
									
						<?php
						$date =  $event->eventstartdate;
						$month = date('M', strtotime($date));
						$show_date = date('j', strtotime($date));
						?>
            <div class="col-sm-12  col-md-3 col-lg-3">
                <div class="card shadow all_evt_area">
                    <div>
					@if(!empty($event->eventimage1 || $event->eventimage2))
                        <img src="{{$event->eventimage1}}" class="img-fluid" />
						@endif

                        <div class="card-left">
                            <div class="__evt-date-col">
                                <p class="__evt-date"><?php echo $show_date; ?></p>
                                <p class="__evt-month"><?php echo $date; ?></p>
                            </div>
                        </div>
                        <div class="cat-col">{{$event->catname}}</div>
                    </div>
                        <div class="evt_detail">
                            <h2>{{$event->name}}</h2>
                            <p></p>
                        </div>
                        <div class="join-btn">
                            <a href="{{url('show-events-list') }}/{{$event->id}}">View Details</a>
                        </div>
                    </div>
					
					
            </div>
					@endforeach
					@endif
            
            </div>
			<div class="d-flex justify-content-center">
          {{ $events->appends(request()->input())->links() }} 
          </div> 
        </div> 
</section>
@endsection