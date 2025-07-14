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
        <div class="row">
          <a class="freedombtn1" href="{{ url('report-event-get-csv-participant-count') }}">Total Count</a>        
          <a class="freedombtn3" href="{{ url('report-event-role-wise-user-registration') }}">Role wise user registration</a>        
          <a class="freedombtn3 freedombtn4" href="{{ url('report-event-date-wise-user-registration') }}" data-target="#merchandisId">Date wise user registration</a>        
          <a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="{{ url('report-event-get-csv-image/13064') }}" data-target="#merchandisId">All report till date</a>                
          <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;"  href="{{ url('report-event-state-wise-user-registration') }}">State wise user registration</a>
          <a class="freedombtn4 freedombtn4" style="background-color:#6610f2;"  href="{{ url('state-summary') }}">State Wise Data</a>
          <a class="freedombtn2" href="{{ url('total-participation') }}">Total Participation</a>        
        </div>      
      </div>
      {{-- <div class="container">
        <h2>Fit India Fit Gujarat Cyclothon 2021</h2>
        <div class="row">
          <a class="freedombtn3" href="{{ url('report-event-role-wise-user-gujarat-cyclothon') }}">Role wise user registration</a> .
          <a class="freedombtn2" href="{{ url('total-participation-gujarat-cyclothon') }}">Total Participation</a> 
        </div>
      </div>   --}}
    </div>
</div>
</div>
</section>
<div class="modal fade" id="merchandisId" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Enter the Name of the School</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{-- <form  action="school-week-merchandise" method="get"> --}}
      <form  action="schoolweekmerchandise2023" method="get">
        <div class="modal-body">
          <div class="form-group mb-1">
            <input type="text" name="school_name" class="form-control" id="exampleFormControlInput1" placeholder="Enter the name of your school">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <!-- <button type="button" class="btn btn-primary">Submit</button> -->
          <input type="submit" class="btn btn-primary" value="Submit" class="mer_btn" />
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    //$(".collapse")

    if ($(".collapse").hasClass('show')) {
      //alert("this  " + $(".collapse").html())
      // $(".card-head").addClass("showActive");
      // alert($(this).closest().html())
      //  alert($('.collapse' ).closest().html())

      //$(this).parent.parent.find('.card').addClass("showActive");
      // alert("rak")
      // $('.card-head').css({
      //     'Background','#ff8000'}
      // })
    } else if ($(".collapse").hasClass('')) {
      $(".card-head").removeClass("showActive");

    }
    // {
    //   $(".card-head").removeClass("showActive");
    // }
  })
</script>
@endsection