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
  {{-- <img src="{{ asset('resources/imgs/home/sportsday-banner.jpg') }}" alt="school-week" title="school-week" class="img-fluid expand_img" /> --}}
  {{-- <img src="{{ asset('resources/imgs/event2023/WebBannerEnglish1.jpg') }}" alt="sports-day" title="national-sports-day" class="img-fluid expand_img" /> --}}
  <section id="{{ $active_section_id }}">
    <div class="container">      
      <div class="row">
        <div class="col-sm-12">
          <h1 class="headingh1">FIT INDIA PLEDGE</h1>          
		        <p>
              <b>I take the pledge: </b>
            </p>                  
              <ul>
                <li> <b>TO LEAD AN ACTIVE AND A HEALTHY LIFESTYLE</b></li>
                <li> <b>TO TAKEOUT 30 MINUTES EVERYDAY FOR MY FITNESS AND HEALTH</b></li>
                <li> <b>TO ENCOURAGE MY FAMILY MEMEBERS AND NEIGHBOURS TO STAY FIT AND HEALTHY</b></li>
                <li> <b>TO TAKE THE FITNESS ASSESSMENT TEST ON THE FIT INDIA MOBILE APPLICATION QUARTERLY</b></li>                
              </ul>
		        <p>
              <b>मैंप्रतिज्ञा करिा/ करती हूँ:: </b>
            </p>                  
              <ul>
                <li> <b>एक सतिय और स्वस्थ जीवन शैली जीऊूँ गा/जीऊूँ गी</b></li>
                <li> <b>अपनेतिटनेस और स्वास्थ्यके तलए हर तिन 30 तमनट का समय तनकाल ूंगा/तनकाल ूंगी</b></li>
                <li> <b>अपनेपररवार केसिस्य ूंऔर पडयतसयय ूंकय तिट और स्वस्थ रहनेके तलए प्रयत्सातहि करूं गा/ करूँ गी</b></li>
                <li> <b>तिट इूंतिया मयबाइल एप्लिके शन पर त्रैमातसक तिटनेस म ल्ाूंकन करूं गा/करूं गी</b></li>                
              </ul>
            
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