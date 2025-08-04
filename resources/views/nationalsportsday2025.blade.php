@extends('layouts.app')
@section('title', 'National Sports Day 2025 | Fit India')
@section('content')
@php
$active_section = request()->segment(count(request()->segments()));
$active_section_id = trim($active_section);
@endphp
<style>
  /* .table-bordered_cut td,
  .table-bordered_cut th {
    border: 1px solid #757575 !important;
  } */
  table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 15px;

}
</style>
    <div class="banner">
        <div class="row">
            <div class="col-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    {{-- <img src="{{ asset('resources/imgs/event2023/sportsday-banner.jpg') }}" alt="sports-day" title="national-sports-day" class="img-fluid expand_img" /> --}}
                    <div class="carousel-inner">
                        <div class="carousel-item mer_banner active">
                        <a href="{{ url('national-sports-day-2024') }}">
                            <img src="{{ asset('resources/imgs/national-sports-day-2024.jpeg') }}" class="d-block w-100" alt="National Sports Day 2024" title="National Sports Day 2024">
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
                        <div class="carousel-item mer_banner">
                        <a href="{{ url('national-sports-day-2024') }}">
                            <img src="{{ asset('resources/imgs/national-sports-day-20242.jpeg') }}" class="d-block w-100" alt="National Sports Day 2024" title="National Sports Day 2024">
                            <div class="some-absolute-div bannerPos1">
                                <div class="centered-in-absolute">
                                    @csrf
                                    <div class="text-center">
                                        <input type="hidden" name="banner_type" value="week_1">
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
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
            <a class="freedombtn1" href="register?role=bmF0aW9uYWwtc3BvcnRzLWRheS0yMDI1">Register</a>
            <a class="freedombtn3" href="{{ url('resources/pdf/national-sports-day-2024-how-to-register.pdf') }}" target="_blank">How To Register</a>
            <a class="freedombtn3 freedombtn4" href="{{ url('national-sports-day-merchandise-creatives-2025') }}" data-target="#merchandisId" target="_blank">Merchandise/Creatives</a>
            <a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="{{ url('resources/pdf/SOP-NSD-2025.pdf') }}" data-target="#merchandisId" target="_blank">SOP</a>
            <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;" href="{{ url('fit-india-pledge-2025') }}">Fit India Pledge</a>
            <a class="freedombtn3 freedombtn4" style="background-color:#4267B2;" href="{{ url('past-glimpses-2025') }}" data-target="#merchandisId">Past Glimpses</a>
            {{-- <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;" href="{{ url('resources/pdf/FIT-INDIA-PLEDGE-v1.pdf') }}" target="_blank">Fit India Pledge</a> --}}
        </div>
      <div class="row">
        <div class="col-sm-12">
          <h1 class="headingh1">National Sports Day 2025</h1>
            <p>
                <b>National Sports Day 2025 – A Public Movement by Mass Celebrations</b>
            </p>
            <p>
                National Sports Day (NSD) is celebrated annually on 29th August to honor India's rich sports tradition and the legacy of Hockey legend Major Dhyan Chand.
                This day also celebrates the nation's sporting icons and their contributions to international sports.
                National Sports Day (NSD) is celebrated every year on 29 th August to commemorate India’s deep-rooted tradition of Sports. This is also a tribute to the
                Hockey legend Major Dhyan Chand. The day also celebrates the nation’s sporting icons, honouring their contribution and dedication toward s bringing laurels to the country at
                the international stage.
            </p>
            <p>
                <b>Highlights of Previous Celebrations:</b>
            </p>

            <ul>
                <li>
                    <b>NSD 2024:</b>
                    Engaged various stakeholders including government offices, armed forces, educational institutions, and more.
                    A total of 8,627 events were organized with 2.5 million participants.
                </li>
                <li>
                    <b>NSD 2023:</b>
                    Saw 14,294 events with 1.6 million participants.
                </li>
                <li>
                    <b>NSD 2022:</b>
                    Featured "Meet the Champion Events" in schools, where sporting icons shared their fitness journeys.
                </li>
            </ul>
            <p><b>Standard format of the event to be:</b></p>
            <ul>
                <li>
                    Each organization to be divided into two, four or six teams depending on the number of participations maintaining gender equality.
                </li>
                <li>
                    Organizations are at liberty to choose games for competition from any popular sports of the locality and availability of Infrastructure.
                </li>
                <li>
                    Name of teams can be based on freedom fighters or prominent sportspersons of the country.
                </li>
            </ul>
            <p><b>Proposed Activities:</b></p>
            <ol>
                <li>
                    <b>Sporting Events:</b> Competitive and fun games for employees of government departments and ministries.
                </li>
                <li>
                    <b>Mohalla Outreach:</b> Sports and fitness activities in villages and urban areas.
                </li>
                <li>
                    <b>Events at Stadiums: </b>
                    Organized by SAI, NSFs, and other sports organizations.
                </li>
                <li>
                    <b>University and School Events:</b>Coordinated by UGC and educational boards.
                </li>
                <li>
                    <b>Sports and Fitness Quiz: </b>Hosted on the MyGov platform.
                </li>
                <li>
                    <b>Fit India Talk Sessions: </b>With special guests at JLN Stadium.
                </li>
                <li>
                    <b>NSD Steps Challenge: </b>A 30-day digitally-driven challenge to walk 10K steps daily via the Fit India Mobile App.
                </li>
                <li>
                    <b>Collaborative Partners: </b>
                    Engagement with National Sports Promotion Organizations.
                </li>
                <li>
                    <b>Healthy Diet Campaign: </b>Collaboration with the Ministry of Health and Family Welfare.
                </li>
                <li>
                    <b>FIT India Fitness Pledge: </b>In addition, all the organizations may organize a FIT India Fitness pledge event where all key stakeholders including their employees may take the FIT India Fitness pledge.
                </li>
            </ol>
            <p>
                <b> A dedicated portal for registering the events on this occasion</b> developed through the Fit India Mission, accessible from its website and Fit India Mobile App.
                Organizers to register their event on Fit India portal (<a href="https://fitindia.gov.in">https://fitindia.gov.in</a>) or Fit India Mobile App and upload details of participation, pictures & videos of the event.

            </p>
            {{-- <p>
              <ul>
                <li>Each organization to be divided into two, four or six teams depending on the number of participations maintaining gender equality.</li>
                <li>Medal tally for each team to be maintained. Highest points team will win Major Dhyan Chand Trophy.</li>
                <li>Organizations are at liberty to choose games for competition from any popular sports of the locality and availability of Infrastructure.</li>
                <li>Name of teams can be based on freedom fighters or prominent sportspersons of the country.</li>
              </ul>
            </p>
            <p>The list of suggested competitive and fun games is-</p>
            <table>
              <tr style="border: 1px; background-color:#4267B2; color:#ffffff !important;">
                <th>S.No.</th>
                <th>Outdoor Activities</th>
                <th>Indoor Activities</th>
                <th>Fun Activities</th>
              </tr>
              <tr>
                <td>1</td>
                <td>Walk/Race</td>
                <td>Badminton</td>
                <td>Lemon Race/ Sack Race</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Volleyball</td>
                <td>Chess</td>
                <td>Rope Jumping</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Hockey (Penalty Shootout)</td>
                <td>Basketball (3v3)</td>
                <td>Kho-Kho</td>
              </tr>
              <tr>
                <td>4</td>
                <td>Futsal/Mini Football (3 vs 3)</td>
                <td>Table Tennis</td>
                <td>Lagori &amp; Langadi</td>
              </tr>
              <tr>
                <td>5</td>
                <td>Tennis Ball Cricket</td>
                <td>Tug of War</td>
                <td>Plank Challenge</td>
              </tr>
            </table>
            <p>
              <strong><i>*Office will be at liberty to choose games for competition from any popular sports of the locality and availability of Infrastructure.</i></strong>
            </p>
            <p><strong>FIT India Fitness Pledge: </strong>In addition, all the organizations may organize a FIT India Fitness pledge event where all key stakeholders including their employees may take the
              FIT India Fitness pledge.</p>
            <p><strong>A dedicated portal for registering the events on this occasion </strong>developed through the Fit India Mission, accessible from its website and Fit India Mobile App.</p>
            <p>Organizers to register their event on Fit India portal (<a href="https://fitindia.gov.in">https://fitindia.gov.in</a>) or Fit India Mobile App and upload details of participation, pictures &amp; videos of the event.</p> --}}
        {{-- <br/>
        <p>For more details kindly visit the following link:
        <br/>
        <a href="https://drive.google.com/drive/folders/1thgTxydnX0VfIjaLrS2DmaEle2LHHh_e?usp=sharing" target="_blank">https://drive.google.com/drive/folders/1thgTxydnX0VfIjaLrS2DmaEle2LHHh_e?usp=sharing</a></p> --}}
        </div>
      </div>




      {{-- <div class="row">
        <div class="col-md-12">

          <div class="accordion" id="accordionFISW">
            <div class="card">
              <div class="card-head" id="headingOne">
                <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW3" aria-expanded="false" aria-controls="collapseone">
                  INDICATIVE LIST OF ACTIVITIES FOR FIT INDIA WEEK 2023 FOR SCHOOLS
                </h2>

              </div>


              <div id="collapseFISW3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFISW">
                <div class="card-body" style="padding-top:10px;">
                    <br>
                    <table class="table-grid table-bordered_cut table-bordered ">
                      <tr>
                        <th width="60px">Sl.No</th>
                        <th>List of activities for Fit India Week 2023 for Schools</th>
                      </tr>
                      <tr>
                        <td>1.</td>
                        <td>Annual Sports Day</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Importance of fitness- Debate, Quiz, Essay Writing, poster making competition</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Indigenous Games</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fitness Assessment through Mobile App</td>
                      </tr>
                      <tr>
                        <td>5.</td>
                        <td>Yoga &amp; Meditation</td>
                      </tr>
                      <tr>
                        <td>6.</td>
                        <td>Fitness Pledge- by teachers, students and their parents &amp; Fit India Parents Teachers Meet</td>
                      </tr>
                    </table>

                  </p>
              <br>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-head" id="headingTwo">
                <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW2" aria-expanded="false" aria-controls="collapseTwo">
                  INDICATIVE LIST OF ACTIVITIES FOR FIT INDIA WEEK 2023 FOR COLLEGES AND UNIVERSITIES
                </h2>
              </div>
              <div id="collapseFISW2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFISW">
                <div class="card-body">
                  <br/>
                  <table class="table-grid table-bordered_cut table-bordered ">
                    <tr>
                      <th width="60px">Day</th>
                      <th>Indicative List of activities for Fit India Week 2023 for Colleges and Universities</th>
                    </tr>
                    <tr>
                      <td>1.</td>
                      <td>Popular Sports &amp; Fun Games</td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Importance of fitness- Debate, Quiz, Essay Writing, poster making competition</td>
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Fitness Assessment through Mobile App</td>
                    </tr>
                    <tr>
                      <td>4.</td>
                      <td>Fitness Pledge- by student and faculty and Yoga &amp; Meditation</td>
                    </tr>
                    <tr>
                      <td>5.</td>
                      <td>Indigenous Games</td>
                    </tr>
                    <tr>
                      <td>6.</td>
                      <td>Idea generation contests &amp; Entrepreneurship Building</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div> --}}
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
