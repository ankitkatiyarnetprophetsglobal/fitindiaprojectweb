@extends('layouts.app')
@section('title', 'Fit India Week 2023| Fit India | Fit India Pledge View Freedom Run 5')
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

<img src="{{ asset('resources/imgs/banner-image/fit-india-swacchta-freedom-Run-5.0.jpeg') }}" class="d-block w-100" alt="Fit India Swacchta Freedom run 5.0" title="Fit India Swacchta Freedom run 5.0">
<div class="banner_area1">
  {{-- <img src="{{ asset('resources/imgs/home/sportsday-banner.jpg') }}" alt="school-week" title="school-week" class="img-fluid expand_img" /> --}}
  {{-- <img src="{{ asset('resources/imgs/event2023/WebBannerEnglish1.jpg') }}" alt="sports-day" title="national-sports-day" class="img-fluid expand_img" /> --}}
  <section id="{{ $active_section_id }}">
    <div class="container">
      <div class="row">
        <a class="freedombtn1" href="register/">Register</a>
        <a class="freedombtn3" href="{{ url('resources/pdf/how-to-register-for-fit-india-swacchta-freedom-run-5.0.pdf') }}" target="_blank">How To Register</a>
        <a class="freedombtn3 freedombtn4" href="{{ url('freedom-run-5.0-merchandise') }}" data-target="#merchandisId" target="_blank">Merchandise/Creatives</a>        
        <a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="{{ url('resources/pdf/SOP_SwachhtaFreedomRun5.0.pdf') }}" data-target="#merchandisId" target="_blank">SOP</a>                
        <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;" href="{{ url('fit-india-pledge-freedom-run-5') }}" target="_blank">Fit India Pledge</a>
        <a class="freedombtn3 freedombtn4" style="background-color:#4267B2;" href="{{ url('past-glimpses-freedom-run-5') }}" data-target="#merchandisId" target="_blank">Past Glimpses</a>    
        {{-- <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;" href="{{ url('resources/pdf/FIT-INDIA-PLEDGE-v1.pdf') }}" target="_blank">Fit India Pledge</a> --}}       
      </div>

      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        {{-- <img src="{{ asset('resources/imgs/event2023/sportsday-banner.jpg') }}" alt="sports-day" title="national-sports-day" class="img-fluid expand_img" /> --}}
        <div class="carousel-inner">            
            <div class="carousel-item mer_banner active">
                <a href="{{ asset('resources/imgs/swacchta-freedom-run-5/1.jpeg') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/swacchta-freedom-run-5/1.jpeg') }}" class="d-block w-100" alt="Fit India Swacchta Freedom run 5.0" title="Fit India Swacchta Freedom run 5.0">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/swacchta-freedom-run-5/2.jpeg') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/swacchta-freedom-run-5/2.jpeg') }}" class="d-block w-100" alt="Fit India Swacchta Freedom run 5.0" title="Fit India Swacchta Freedom run 5.0">                
                </a>
            </div>
            <div class="carousel-item mer_banner">
                <a href="{{ asset('resources/imgs/swacchta-freedom-run-5/3.jpeg') }}" target="_blank">
                  <img src="{{ asset('resources/imgs/swacchta-freedom-run-5/3.jpeg') }}" class="d-block w-100" alt="Fit India Swacchta Freedom run 5.0" title="Fit India Swacchta Freedom run 5.0">                
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
<div class="row align-items-center justify-content-center my-5">
  <div class="col-lg-4 col-md-4 col-sm-6 col-12">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/fW_RBVbdeD4?si=V19nZyDHktAc3eyv" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>      
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