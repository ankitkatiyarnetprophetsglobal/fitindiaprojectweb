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
          <h1 class="headingh1">How to Register for Fit India Week 2023</h1>          
		        <p>
              <b>Step-1 : </b>On your desktop/Laptop/Mobile please open the internet browser (chrome/explorer etc) and in the address bar please type <a href="https://fitindia.gov.in/">https://fitindia.gov.in/</a>
            </p>                       
		        <p>
              <b>Step-2 : </b>Please click on “Click Here” button on the Fit India Week banner seen on Fit India home page for registration of <b> Fit India Week 2023 </b>              
            </p>
            <img src="{{ asset('resources/imgs/fitindiaweek2023/webbanner1.png') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                       
            <br/>
		        <p>
              <b>Step-3: </b>Once you are redirected to Fit India Week 2023 page – click on <b>Already Registered</b> button if you are already a registered user with Fit India by logging in.              
            </p>
		        <p>
              <b>Step-4: </b>: If you are not registered with Fit India, then click on <b>New Registration</b> button which will redirect you to the registration page as shown below. Please register yourself as <b>school/college/university</b>              
            </p>
            <div class="banner_area1">
            <img src="{{ asset('resources/imgs/fitindiaweek2023/fitindia-gov-in-register.png') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">                       
            </div>
            <br/>
		        <p>
              <b>Step-5: </b>: Once you have logged in, please click on <b>Organize your event</b> button to create Fit India Week event.                          
              <ul>
                <li> Enter the mandatory details highlighted by * and create the event</li>
                <li> You can also upload background image for your event</li>
              </ul>
            </p>
		        <p>
              <b>Step-6: </b>: You will automatically be directed on the Event page (as shown below)                          
              <ul>
                <li> You can add event pictures / video links of the Fit India week event by clicking on <b>add event pictures and videos</b> button.</li>
                <li> Certificate can be downloaded for schools/colleges/universities (organizers) and also participants (schools/colleges/universities) by clicking on <b>download certificate</b> button and providing names of participants.</li>
              </ul>
            </p>

            <img src="{{ asset('resources/imgs/fitindiaweek2023/fitindia-gov-in-register-edit.png') }}"  alt="Fit-india-week-2023" class="img-fluid" title="Fit-india-week-2023">                       
            <br/>
            <ul>
              <li> Talented athletes identified at annual sports event conducted by schools during Fit India Week 2023 can be shared by clicking on <b>Suggest Outstanding Sport Talent</b> Button.</li>
              <li> Once clicked it will redirect you to page as shown below.</li>
              <li> Download the sample excel. Fill all details that needs to be provided</li>
              <li> Upload the filled excel sheet and click on submit. Click on view uploaded data to check the excel already uploaded</li>
            </ul>
            <img src="{{ asset('resources/imgs/fitindiaweek2023/fitindia-gov-in-upload-execl.png') }}"  alt="Fit-india-week-2023" class="img-fluid" title="Fit-india-week-2023">                       
            <br/>
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