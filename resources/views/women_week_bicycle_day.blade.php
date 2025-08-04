@extends('layouts.app')
@section('title', "world-bicycle-day | SOC | FIT India")
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
  <div class="banner">
    <div class="row">
        <div class="col-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                {{-- <img src="{{ asset('resources/imgs/event2023/sportsday-banner.jpg') }}" alt="sports-day" title="national-sports-day" class="img-fluid expand_img" /> --}}
                <div class="carousel-inner">
                    <div class="carousel-item mer_banner active">
                      <a href="{{ url('coiregistration') }}">
                        <img src="{{ asset('resources/imgs/women_week_bicycle_day.jpg') }}" class="d-block w-100" alt="World Bicycle Day" title="World Bicycle Day">
                        <div class="some-absolute-div bannerPos1">
                            <div class="centered-in-absolute">
                                {{-- <form action="{{route('download-school-banner')}}" method="POST"> --}}
                                    @csrf
                                    <div class="text-center">
                                        <input type="hidden" name="banner_type" value="week_1">
                                        {{-- <button type="submit" name="banner_submit" value="Submit" class="mer_btn">Download</button> --}}
                                    </div>

                                {{-- </form> --}}
                            </div>
                        </div>
                      </a>
                    </div>
                    {{-- <div class="carousel-item mer_banner">
                      <a href="{{ url('fit-india-week-2024') }}">
                        <img src="{{ asset('resources/imgs/fid2024/fitindiaweek2024banner2.png') }}" class="d-block w-100" alt="Fit-india-week-2024" title="Fit-india-week-2024">
                        <div class="some-absolute-div bannerPos1">
                            <div class="centered-in-absolute">
                                  @csrf
                                  <div class="text-center">
                                      <input type="hidden" name="banner_type" value="week_1">
                                  </div>
                            </div>
                        </div>
                      </a>
                    </div> --}}
                    {{-- <div class="carousel-item mer_banner">
                      <a href="{{ url('fit-india-week-2023') }}">
                        <img src="{{ asset('resources/imgs/fitindiaweek2023/webbanner3.png') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">
                        <div class="some-absolute-div bannerPos1">
                            <div class="centered-in-absolute">
                                    @csrf
                              <div class="text-center">
                                  <input type="hidden" name="banner_type" value="week_1">
                              </div>
                            </div>
                        </div>
                      </a>
                    </div> --}}
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
<div class="banner_area1">
  <section id="{{ $active_section_id }}">
    <div class="container">
      <div class="row">
        <a class="freedombtn1" href="{{ url('coiregistration') }}">Register</a>
        <a class="freedombtn3" href="{{ url("resources/pdf/world-bicyle-day.pdf") }}" target="_blank">How To Register</a>
        <a class="freedombtn3 freedombtn4" style="background-color:#ee01ff;" href="https://forms.gle/sc2mntGFNqMrknJw8" data-target="#merchandisId" target="_blank">Capture your data</a>
        <a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="{{ url('resources/pdf/women_week_bicycle_day_sop.pdf') }}" data-target="#merchandisId" target="_blank">SOP</a>
        <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;"  href="{{ url('fit-india-pledge-2024') }}" target="_blank">Fit India Pledge</a>
        <a class="freedombtn3 freedombtn4" href="{{ url('resources/pdf/FAQ-World-Bicycle-Day-2.pdf') }}" data-target="#merchandisId" target="_blank">FAQ</a>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <h1 class="headingh1">Celebrate World Bicycle Day with FIT India – Pedal Towards a Healthier Future!</h1>
            <p>
              Join the movement this <b>June 1</b> as the FIT India Movement proudly celebrates <b>World Bicycle Day</b> celebrations across the nation!
              Let’s come together to promote cycling as a <b>fun, healthy, and eco-friendly way of life</b>.
            </p>
            <p>
              Cycling is more than just a way to get around – it's a powerful tool for fitness, mental well-being, and environmental sustainability.
              On this special day, FIT India invites people of all ages to hop on their bicycles and be part of a nationwide celebration of health, movement, and community.
            </p>
            <p>
              Whether you're a student, a working professional, or a senior citizen, this is your chance to ride for a cause. By participating,
              you not only boost your own health but also contribute to a cleaner,
              greener India. <b>So grab your helmet, gear up, and join thousands of others across the country in celebrating World Bicycle Day with FIT India.</b>
            </p>
            <p>
              <b>🚴♀️ Ready to Ride? Let’s Make It Count! 🚴♂️</b>
            </p>
            <p>
              To ensure your World Bicycle Day ride is <b>smooth, safe, and well-organized,</b> we’ve prepared a <b>Standard Operating Procedure (SOP)</b> just for you.
              Whether you’re leading a group or riding solo, the SOP will help you plan every detail – from route selection to safety tips.
            </p>
            <p>
              📋 <b>Need the guide?</b> Click the <b>“Standard Operating Procedure”</b> button right here on this page to get started!
            </p>
            <p>
              And don’t forget – <b>your ride matters!</b> Make your effort count by sharing your ride details and photos with us.
              Just click the <b>“Capture Your Data”</b> button and fill out the quick Google Form.
              Every submission adds to the nationwide movement and inspires others to join in!
            </p>
            <p><center><b>Let’s pedal together for a Fit and Healthy India!</b></center></p>
            <p><center><b>#WorldBicycleDay #FITIndiaMovement #FightPollution</b></center></p>
            <p><center>
                    Kindly contact your nearest SAI Centre to be a part of FIT India’s World Bicycle Day Celebrations.

                    <b>
                        <a href="{{ url('resources/pdf/list-event-location-world-bicycle-day.pdf') }} " target="_blank">
                            Click here for list of centres
                        </a>
                    </b>
                </center>
            </p>
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
      <form  action="schoolweekmerchandise2023" method="get">
        <div class="modal-body">
          <div class="form-group mb-1">
            <input type="text" name="school_name" class="form-control" id="exampleFormControlInput1" placeholder="Enter the name of your school">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

    } else if ($(".collapse").hasClass('')) {
      $(".card-head").removeClass("showActive");

    }
  })
</script>
@endsection
