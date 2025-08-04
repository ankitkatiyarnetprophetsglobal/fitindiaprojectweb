@extends('layouts.app')
@section('title', 'Fit India Week 2023| Fit India')
@section('content')
@php
$active_section = request()->segment(count(request()->segments()));
$active_section_id = trim($active_section);
@endphp
<style>
  .table-bordered_cut td,
  .table-bordered_cut th {
    border: 1px solid #757575 !important;
  }
</style>

  
<div class="banner_area1"> 
  <section id="{{ $active_section_id }}">
      <div class="container">
        <h4>Fit India NSD Data for Rajasthan</h4>
        <br/>
        <div class="row">
          <a class="freedombtn1" href="{{ url('report-rajasthan-get-csv-participant-count') }}">Total Count</a>                  
          <a class="freedombtn3 freedombtn4" href="{{ url('report-rajasthan-date-wise-user-registration') }}" data-target="#merchandisId">Date wise user registration</a>        
          <a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="{{ url('report-rajasthan-get-csv-image/13064') }}" data-target="#merchandisId">All User Data Till date</a>                
          {{-- <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;"  href="{{ url('report-event-state-wise-user-registration') }}">Sate wise user registration</a> --}}
        </div>      
      </div>
    </div>
</div>
</div>
</section>
@endsection