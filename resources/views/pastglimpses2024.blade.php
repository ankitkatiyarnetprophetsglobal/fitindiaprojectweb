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

<img src="{{ asset('resources/imgs/national-sports-day-2024.jpeg') }}" class="d-block w-100" alt="National Sports Day 2024" title="National Sports Day 2024">
<div class="banner_area1">
  {{-- <img src="{{ asset('resources/imgs/home/sportsday-banner.jpg') }}" alt="school-week" title="school-week" class="img-fluid expand_img" /> --}}
  {{-- <img src="{{ asset('resources/imgs/event2023/WebBannerEnglish1.jpg') }}" alt="sports-day" title="national-sports-day" class="img-fluid expand_img" /> --}}
  <section id="{{ $active_section_id }}">
    <div class="container">
      <div class="row">
        <a class="freedombtn1" href="register/">Register</a>
        <a class="freedombtn3" href="{{ url('resources/pdf/national-sports-day-2024-how-to-register.pdf') }}" target="_blank">How To Register</a>
        <a class="freedombtn3 freedombtn4" href="{{ url('national-sports-day-merchandise-creatives-2024') }}" data-target="#merchandisId" target="_blank">Merchandise/Creatives</a>        
        <a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="{{ url('resources/pdf/SOP-NSD-2024.pdf') }}" data-target="#merchandisId" target="_blank">SOP</a>                
        <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;" href="{{ url('fit-india-pledge-2024') }}">Fit India Pledge</a>
        <a class="freedombtn3 freedombtn4" style="background-color:#4267B2;" href="{{ url('past-glimpses-2024') }}" data-target="#merchandisId">Past Glimpses</a>   
        {{-- <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;" href="{{ url('resources/pdf/FIT-INDIA-PLEDGE-v1.pdf') }}" target="_blank">Fit India Pledge</a> --}}       
      </div>

      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        {{-- <img src="{{ asset('resources/imgs/event2023/sportsday-banner.jpg') }}" alt="sports-day" title="national-sports-day" class="img-fluid expand_img" /> --}}
        <div class="carousel-inner">
            {{-- <div class="carousel-item mer_banner active">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/3.jpg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/3.jpg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/4.jpg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/4.jpg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/5.jpg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/5.jpg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/6.jpg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/6.jpg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div><div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/7.jpg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/7.jpg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/8.jpg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/8.jpg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/9.jpg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/9.jpg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/10.jpg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/10.jpg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/11.jpg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/11.jpg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/12.jpg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/12.jpg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/13.jfif') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/13.jfif') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/14.jfif') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/14.jfif') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/15.jfif') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/15.jfif') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/16.jfif') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/16.jfif') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/17.jpeg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/17.jpeg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/18.jpg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/18.jpg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/19.jpeg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/19.jpeg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/20.jpeg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/20.jpeg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/21.jpeg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/21.jpeg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/22.jpeg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/22.jpeg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/23.jpeg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/23.jpeg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/24.jpeg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/24.jpeg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/25.jpeg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/25.jpeg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/26.jpeg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/26.jpeg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/27.jpeg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/27.jpeg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/28.jpeg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/28.jpeg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div>
            <div class="carousel-item mer_banner">
              <a href="{{ asset('resources/imgs/fitindiaweek2023/glimpes/29.jpeg') }}" target="_blank">
                <img src="{{ asset('resources/imgs/fitindiaweek2023/glimpes/29.jpeg') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                
              </a>
            </div> --}}
            <div class="carousel-item mer_banner active">
                <a href="{{ asset('resources/imgs/fitindiaweek2024/30.JPG') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fitindiaweek2024/30.JPG') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fitindiaweek2024/31.JPG') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fitindiaweek2024/31.JPG') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fitindiaweek2024/32.JPG') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fitindiaweek2024/32.JPG') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fitindiaweek2024/33.JPG') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fitindiaweek2024/33.JPG') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fitindiaweek2024/34.JPG') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fitindiaweek2024/34.JPG') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fitindiaweek2024/35.JPG') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fitindiaweek2024/35.JPG') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fitindiaweek2024/36.JPG') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fitindiaweek2024/36.JPG') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fitindiaweek2024/37.JPG') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fitindiaweek2024/37.JPG') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fitindiaweek2024/38.JPG') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fitindiaweek2024/38.JPG') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fitindiaweek2024/39.JPG') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fitindiaweek2024/39.JPG') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fitindiaweek2024/40.JPG') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fitindiaweek2024/40.JPG') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fitindiaweek2024/41.jpeg') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fitindiaweek2024/41.jpeg') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fitindiaweek2024/42.jpeg') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fitindiaweek2024/42.jpeg') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fitindiaweek2024/43.jpeg') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fitindiaweek2024/43.jpeg') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/fitindiaweek2024/44.jpeg') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/fitindiaweek2024/44.jpeg') }}" class="d-block w-100" alt="national sports day 2024" title="national sports day 2024">                
                </a>
            </div>
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