@extends('layouts.app')
@section('title', 'Fit India Show Events | Fit India')
@section('content')
<section>
<div class="container">
<div class="col-sm-12 col-lg-8 col-md-8 portfolio-item">
  <div class="portfolio-img">
  <?php //print_r($events); exit();?>
  <h1>{{$events->catname}} By {{ $events->name }}</h1>
  
  <div class="event_detail">
    
      <img src="{{ $events->eventimage1 }}"  alt="Event">
	  </div>
  </div>
  
  <div class="event_text">
  <h3>About Us</h3>
  <p>{{$events->catname}} Conducted  By {{$events->name}}
  <br> From {{$events->eventstartdate}} to {{$events->eventenddate}}

 </p>
  </div>
</div>
</div>
</section>
@endsection