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

  <div class="banner">
    <div class="row">
        <div class="col-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                {{-- <img src="{{ asset('resources/imgs/event2023/sportsday-banner.jpg') }}" alt="sports-day" title="national-sports-day" class="img-fluid expand_img" /> --}}
                <div class="carousel-inner">
                    <div class="carousel-item mer_banner active">
                      <a href="{{ url('fit-india-week-2023') }}">
                        <img src="{{ asset('resources/imgs/fitindiaweek2023/webbanner1.png') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">
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
                      <a href="{{ url('fit-india-week-2023') }}">
                        <img src="{{ asset('resources/imgs/fitindiaweek2023/webbanner2.png') }}" class="d-block w-100" alt="Fit-india-week-2023" title="Fit-india-week-2023">
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
                    <div class="carousel-item mer_banner">
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
<div class="banner_area1">  
  <section id="{{ $active_section_id }}">
    <div class="container">
      <div class="row">
        <a class="freedombtn1" href="register/">Register</a>
        <a class="freedombtn3" href="{{ url('register-for-fit-india-2023') }}">How To Register</a>
        <a class="freedombtn3 freedombtn4" href="{{ url('fitindiaindiaweekmerchandise2023') }}" data-target="#merchandisId">Merchandise/Creatives</a>        
        <a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="{{ url('past-glimpses-2023') }}" data-target="#merchandisId">Past Glimpses</a>                
        <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;"  href="{{ url('fit-india-pledge-2023') }}">Fit India Pledge</a>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <h1 class="headingh1">Fit India Week</h1>          
		        <p>
              Fit India School Week was conceived in the year 2019 with the imperative need of creating awareness about fitness among children, 
              parents, teachers and school staff. <b>In this campaign, school fraternities across the country were encouraged to celebrate 4 to 6 days in a week to 
              promote a healthy and active lifestyle by indulging in various activities such as debates, quiz, essay writing, poster-making competitions, 
              yoga and meditation, pledge of fitness, indigenous sports, running/races, cycling races, popular sports & fun games, idea generation contests & 
              entrepreneurship building etc.</b> The 1st edition of Fit India School Week was celebrated in the 3rd week of November 2019 as Fitness Week in partnership 
              with the Ministry of Education. More than 15,000 schools participated in the 1st edition of Fit India School week.
            </p>
            <p>
              The 2nd edition of Fit India school week was conducted from December 2020 to January 2021. Due to the pandemic prevalent at that time, 
              it was suggested to organize the school week in both virtual and offline formats. A virtual event was coordinated by KVS no- 2. 
              Kochi to showcase Fit India School Week celebrations.
              More than 4.3 lakh schools celebrated the Fit India school week across the nation. 
            </p>
            <p>
              The 3rd edition of Fit India School week was organized from 14th November 2021 to 12th December 2021 and was extended till 31st January 2022. The Fit India School Week witnessed more than 4.5 lakh participants from all over India. Activities like Yoga, Dance. Debates, symposiums, Lectures etc. were part of the celebration in Fit India School Week.
            </p>
            <p>
              The 4th edition of Fit India School week was organized from 15th November 2022 to 31st January 2023 and witnessed more than 5.56 Lakhs schools participating from all over India. In order to propagate and popularize the Fit India School Week among the school fraternity and general population at large, the public representatives namely the Hon’ble Members of Parliament and Hon’ble Members of Legislative Assembly were requested to attend the Fit India School Week celebrations in a school in their respective constituency. Their presence played a pivotal role in showcasing the popularity of Fit India School Week which was further amplified by extensive media coverages.
            </p>
            <p>
              Continuing with the enthusiasm of the schools and in pursuit of spreading the message of fitness among various segments of the population,<b> this year, the Fit India Mission has decided to expand the outreach of the Fit India School Week to include colleges, universities and higher education institutions. Therefore, the 5th edition of Fit India School Week has been named as ‘Fit India Week’ for Schools and Universities, and will be observed from 15th November to 15st December 2023.</b> Schools, Colleges, Universities, and Higher Education Institutions can select any one week within this duration to celebrate the Fit India Week program.
            </p>            
        <br/>
		</div>
      </div>
      
      
      

      <div class="row">
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