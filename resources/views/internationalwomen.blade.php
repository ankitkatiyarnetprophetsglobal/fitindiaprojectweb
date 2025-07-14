@extends('layouts.app')
@section('title', "Fit India Women Week's| Fit India")
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
                      <a href="{{ url('fit-india-women-week') }}">
                        <img src="{{ asset('resources/imgs/internationalwomen/banner_image/fit-india-women-week.png') }}" class="d-block w-100" alt="Fit India Women Week's" title="Fit India Women Week's">
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
        <a class="freedombtn1" href="register/">Register</a>
        <a class="freedombtn3" href="{{ url("resources/pdf/how-to-register-for-fit-india-women's-week-2025.pdf") }}" target="_blank">How To Register</a>
        <a class="freedombtn3 freedombtn4" style="background-color:#ee01ff;" href="https://forms.gle/UVWt9kncww2K6gqy7" data-target="#merchandisId" target="_blank">Capture your data</a>
        <a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="{{ url('resources/pdf/SOP_IWD.pdf') }}" data-target="#merchandisId" target="_blank">SOP</a>
        <a class="freedombtn3 freedombtn4" href="{{ url('fit-india-women-week-merchandise') }}" data-target="#merchandisId" target="_blank">Merchandise/Creatives</a>
        <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;"  href="{{ url('fit-india-pledge-2024') }}" target="_blank">Fit India Pledge</a>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <h1 class="headingh1">FIT INDIA WOMEN'S WEEK</h1>
            <p>
              International Women’s Day (IWD) is celebrated on March 8th every year to honor women's achievements and address the challenges they face.
              The theme for 2025 is <b>"For ALL Women and Girls: Rights. Equality. Empowerment,</b>" focusing on breaking systemic barriers to unlock equal rights and opportunities.
              The Fit India Mission will collaborate with government bodies, NGOs, and universities to encourage healthier lives,
              leadership, and empowerment, aligning with the theme <b>“Stronger her, Healthier Future.”</b>
            </p>
            <p>
              Central to the achieving the vision of IWD 2025 is empowering the next generation—youth,
              particularly young women and adolescent girls—as catalysts for lasting change.
              Therefore, the Fit India Mission plans to engage with the University Grants Commission
              (UGC) as lead partner to reach out to various universities across the nation.
            </p>
            <p>
              <b>The IWD Celebrations shall close with a Pink Sundays on Cycle event on
              9th March 2025 (Sunday) to be conducted by the participating institutions focused and dedicated to women empowerment.
              </b>
            </p>
            <p>
              To promote women's health and fitness, ministries, departments, autonomous bodies,
              and institutions at both central and state levels will be encouraged to organize various activities, including:
            </p>
            <p>
              <ul>
                <li><b>Women's Fitness Walkathons/Marathons</b> – Mass participation events for women of all ages to foster a fitness culture.</li>
                <li><b> for Women</b> – Cycling events promoting both health and environmental awareness, ranging from leisure rides to competitive races.</li>
                <li><b>Fit India Yoga Sessions</b> – Large-scale yoga sessions nationwide, focusing on physical and mental well-being.</li>
              </ul>
              SAI Regional Centres will work with local organizations to set up community-based activities such as Pink Cycling, fitness sessions, and yoga programs.
            </p>
            <p>
              📢 Join the Movement | Participate in Fitness Activities | Inspire Change
              <ul>
                <li><b>Register Today</b>: Enrol your institution and students on the <b>FIT INDIA Portal</b></li>
                <li><b>Engage & Promote</b>: Take part in planned activities and share your experiences online.</li>
                <li><b>Empower Women</b>: Encourage fitness participation among peers and communities.</li>
                <li><b>Be the Voice</b>: Use <b>#FitWomenFitIndia #IWD2025 #WomenInFitness #FitIndiaMovement</b> to amplify the message.</li>
              </ul>
              🌍 Act Now! Stay Fit, Stay Healthy!
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
