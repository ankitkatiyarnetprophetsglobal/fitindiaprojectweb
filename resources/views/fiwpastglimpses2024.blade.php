@extends('layouts.app')
@section('title', 'Fit India Week 2024| Fit India')
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

<img src="{{ asset('resources/imgs/fid2024/fitindiaweek2024banner1.png') }}" class="d-block w-100" alt="National Sports Day 2024" title="National Sports Day 2024">
<div class="banner_area1">
  {{-- <img src="{{ asset('resources/imgs/home/sportsday-banner.jpg') }}" alt="school-week" title="school-week" class="img-fluid expand_img" /> --}}
  {{-- <img src="{{ asset('resources/imgs/event2023/WebBannerEnglish1.jpg') }}" alt="sports-day" title="national-sports-day" class="img-fluid expand_img" /> --}}
  <section id="{{ $active_section_id }}">
    <div class="container">
      <div class="row">
        <a class="freedombtn1" href="register/">Register</a>
        <a class="freedombtn3" href="{{ url('resources/pdf/how-to-register-for-fit-india-week-2024.pdf') }}" target="_blank">How To Register</a>  
        <a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="{{ url('fiw-past-glimpses-2024') }}" data-target="#merchandisId" target="_blank">Past Glimpses</a>
        <a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="{{ url('resources/pdf/SOP-Fit-India-Week-6.0.pdf') }}" data-target="#merchandisId" target="_blank">SOP</a>                                
        <a class="freedombtn3 freedombtn4" href="{{ url('fitindiaindiaweekmerchandise2024') }}" data-target="#merchandisId" target="_blank">Merchandise/Creatives</a>
        <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;"  href="{{ url('fit-india-pledge-2024') }}" target="_blank">Fit India Pledge</a>
      </div>

      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">        
        <div class="carousel-inner">            
            <div class="carousel-item mer_banner active">
                <a href="{{ asset('resources/imgs/fitindiaweek2024/30.JPG') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fitindiaweek2024/30.JPG') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fid2024/past-glimpses-fit-india-week/FIW1.jpeg') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fid2024/past-glimpses-fit-india-week/FIW1.jpeg') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fid2024/past-glimpses-fit-india-week/FIW2.jpeg') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fid2024/past-glimpses-fit-india-week/FIW2.jpeg') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fid2024/past-glimpses-fit-india-week/FIW3.jpeg') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fid2024/past-glimpses-fit-india-week/FIW3.jpeg') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fid2024/past-glimpses-fit -india-week/FIW4.jpeg') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fid2024/past-glimpses-fit-india-week/FIW4.jpeg') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fid2024/past-glimpses-fit-india-week/FIW5.jpeg') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fid2024/past-glimpses-fit-india-week/FIW5.jpeg') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fid2024/past-glimpses-fit-india-week/FIW6.jpeg') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fid2024/past-glimpses-fit-india-week/FIW6.jpeg') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fid2024/past-glimpses-fit-india-week/FIW7.jpeg') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fid2024/past-glimpses-fit-india-week/FIW7.jpeg') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fid2024/past-glimpses-fit-india-week/FIW8.jpeg') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fid2024/past-glimpses-fit-india-week/FIW8.jpeg') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fid2024/past-glimpses-fit-india-week/FIW9.jpeg') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fid2024/past-glimpses-fit-india-week/FIW9.jpeg') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            {{-- <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fitindiaweek2024/40.JPG') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fitindiaweek2024/40.JPG') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>             --}}
        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
      
    </div>
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