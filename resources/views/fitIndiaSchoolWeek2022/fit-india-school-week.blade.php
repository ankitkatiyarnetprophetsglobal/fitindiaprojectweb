@extends('layouts.app')
@section('title', 'Fit India School Week| Fit India')
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
  <img src="{{ asset('resources/imgs/fitindia_school_2022/banner.jpg') }}" alt="school-week" title="school-week" class="img-fluid expand_img" />
  <section id="{{ $active_section_id }}">
    <div class="container">
      <div class="row">
        <a class="freedombtn4" href="{{url('login')}}" style="background-color: #833ab4;">Already Registered School</a>
        <a class="freedombtn1" href="register/">New Registration</a>
        <!-- <a class="freedombtn2" href="{{ url('wp-content/uploads/2021/01/FAQ-Fit-India-School-Week.pdf') }} " target="_blank">FAQ-School Week 2020</a> -->
        <a class="freedombtn3" href="{{ url('resources/pdf/school-week-how-to-register.pdf') }}" target="_blank">How To Register</a>

       <!-- <a class="freedombtn4" href="javascript:void(0)" data-toggle="modal" data-target="#merchandisId">Download Event Creatives</a> -->
<a class="freedombtn4" href="{{ url('resources/pdf/download_creatives.pdf') }}">Download Event Creatives</a>
      </div><br>
      <div class="row">
        <div class="col-sm-12">
          <h1 class="headingh1">FIT INDIA SCHOOL WEEK 2022</h1>
          <br><br>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">

          <div class="accordion" id="accordionFISW">
            <div class="card">
              <div class="card-head" id="headingOne">
                <h2 class="mb-0" data-toggle="collapse" data-target="#collapseFISW1" aria-expanded="true" aria-controls="collapseOne">
                  Background
                </h2>
              </div>

              <div id="collapseFISW1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionFISW">
                <div class="card-body" style="padding-top:10px;">
                  <!--  <p><b>SCHOOLS FORM HABITS! </b>Fit India School Week was conceived in 2019 soon after the inception of Fit India Movement to meet the imperative need of creating awareness about fitness not only for school going children but also their parents, teachers and school staff. The concept is to celebrate 4 to 6 days of a week towards health and fitness by engaging into any kind of physical activities and/or events like Painting competition, Symposiums etc. themed on health and fitness. Now, the programme is being considered the flagship programme of Fit India Movement.</p>
                   <p>In the 1st edition in November-December 2019, it was celebrated in more than 15000 schools PAN India. In 2nd edition of Fit India School Week, a surge was witnessed in participation from amongst nationwide schools despite being in Covid-19 restrictions, various virtual/online activities like yoga. free hand exercises, painting, debates, symposiums, brain games like Chess, Rubik cube etc. were organized by schools following the guidelines of COVID-19. More than 4 lakh 30 thousand schools had reported the celebrations of Fit India School Week in 2nd edition from December 2020 to January 2021.</p>
                   <p>This is a part of yearly calendar of Fit India Mission activities and will be organized tentatively in the months of November-December every year. For details on this year’s edition, check this space in last week of October 2021.</p> -->

                  <p>Fit India School Week was conceived in 2019 with the imperative need of creating awareness about fitness not limited to children but also their parents, teachers, and school staff. In this campaign, school fraternities across the country are encouraged to celebrate 4 to 6 days in a week to promote a healthy and active lifestyle by indulging in various activities such as debates, quiz, essay writing, poster-making competitions, yoga and meditation, pledge of fitness, indigenous sports etc.</p>
                  <p>The 1st edition of Fit India School Week was celebrated in the 3rd week of November 2019 as Fitness Week in partnership with the Ministry of Education. More than 15,000 schools participated in the 1st edition of Fit India School week.</p>
                  <p>In the 2nd edition, Fit India school week was conducted from December 2020 to January 2021. More than 4.3 lakh schools celebrated the Fit India school week across the nation. Fitness activities such as yoga, free hand exercises, painting, debates, symposiums, etc., were part of this edition.</p>
<p>The 3rd edition of Fit India School week was organized from November 2021 to January 2022. The Fit India School Week witnessed more than 4.5 lakh participants across from all over India. Activities like Yoga, Dance, Debates, Symposiums, Lectures etc. were the part of the celebration in Fit India School Week. </p>
<p>The 4th edition of Fit India School Week is going to be organized from 15th November to 31st January 2023. Schools can select any week within this window for School Week Celebrations. Additionally, all schools are encouraged to celebrate their annual sports day during Fit India School Week from this edition. The details of talented athletes identified for different sporting disciplines can be shared with Sports Authority of India on the Fit India School Week page.</p>                
</div>
              </div>
            </div>

            {{-- <div class="card">
              <div class="card-head" id="headingTwo">
                <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW2" aria-expanded="false" aria-controls="collapseTwo">
                  Guidelines
                </h2>
              </div>
              <div id="collapseFISW2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFISW">
                <div class="card-body">
                  <ol>
                    <li>Schools to ensure that all Students, Parents, Staff and Management shall actively participate in the Fit India School Week 2021 programme</li>
                    <li>Schools may create a new page on their website titled “Fit India School Week 2021” and a brief about the activities undertaken and related pictures/videos can be uploaded on it.</li>
                    <li>Schools should register themselves on <a href="{{asset('fit-india-school-week') }}">https://fitindia.gov.in/fit-india-school-week</a> and upload photos and video link related to the event</li>
                    <li>All registered schools may download a Digital Certificate. which can be downloaded from Fit India Portal after successful conduct of the Fit India School Week.</li>
                    <li>Schools are also encouraged to share/post activities conducted on their social media channels with <strong>#NewIndiaFitIndia</strong> and tag <strong>@FitIndiaOff</strong></li>
                  </ol>
                </div>
              </div>
            </div> --}}
            <div class="card">
              <div class="card-head" id="headingThree">
                <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW3" aria-expanded="false" aria-controls="collapseThree">
                  Activities
                </h2>
              </div>
              <div id="collapseFISW3" class="collapse" aria-labelledby="headingThree" data-parent="#accordionFISW">
                <div class="card-body ">
                  <table width="100%" class="table-grid table-bordered_cut table-bordered ">
                    <thead>
                      <tr>
                        <th>DAY</th>
                        <th class="text-center">PROPOSED ACTIVITIES</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><strong>01</td>
                        <td> Annual Sports Day </td>
                      </tr>
                      <tr>
                        <td><strong>02</td>
                        <td>
                          Importance of Fitness – debates, quiz, essay writing, poster making competition
                        </td>
                      </tr>
                      <tr>
                        <td><strong>03</td>
                        <td>
                          Indigenous Games
                        </td>
                      </tr>
                      <tr>
                        <td><strong>04</td>
                        <td>
                          Khelo India Physical Fitness Assessment of students 
                        </td>
                      </tr>
                      <tr>
                        <td><strong>05</td>
                        <td>
                          Yoga and Meditation
                        </td>
                      </tr>
                      <tr>
                        <td><strong>06</td>
                        <td>
                          Fitness Assessment for nearby communities through Fit India Mobile App
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" >
                 <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Background
                    </a> 
               </h2>
    
            </div>
            <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                   <p>On 29 Aug 2019, the Hon’ble Prime Minister launched nation-wide “Fit India Movement” aimed to encourage people to inculcate physical activity and sports in their everyday lives and daily routine.</p>
                   <p>School is the first place where habits are formed. School children should be encouraged to indulge in active field time during school hours involving fitness and sports activities. This will instil in students the understanding for regular physical activity and higher levels of fitness, thus enhancing self-esteem and confidence in them. Keeping these objectives in mind, Fit India School Week program was launched in 2019.</p>
                   <p>This year “Fit India School Week” will be celebrated virtually by schools in December.</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" >
                 <h2 class="panel-title">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Guidelines
            </a>
          </h2>
    
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <ol>
                      <li>Schools to ensure that all Students, Parents, Staff and Management shall actively participate in the Fit India School Week 2020 programme</li>
                      <li>Schools may create a new page on their website titled “Fit India School Week 2020” and a brief about the activities undertaken and related pictures/videos can be uploaded on it.</li>
                      <li>Schools should register themselves on <a href="{{asset('fit-india-school-week') }}">https://fitindia.gov.in/fit-india-school-week</a> and upload photos and video link related to the event</li>
                      <li>All registered schools may download a Digital Certificate. which can be downloaded from Fit India Portal after successful conduct of the Fit India School Week.</li>
                      <li>Schools are also encouraged to share/post activities conducted on their social media channels with <strong>#NewIndiaFitIndia</strong> and tag <strong>@FitIndiaOff</strong></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="panel panel-default lastpanel">
            <div class="panel-heading" role="tab" >
                 <h3 class="panel-title">
                 <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Activities
                 </a>
          </h3>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
               <h4 style="margin-bottom:15px;">Virtual Activities for Fit India School Week Celebrations 2020</h4>
                <div class="panel-body">
                  <table border="0" width="100%" class="table-grid">
                    <tbody>
                    <tr>
                        <th colspan="1">Day</th>
                        <th colspan="1">Activity</th>
                    </tr>
                    <tr>
                        <td><strong>01</td>
                        <td>
                            <ul style="list-style-type: upper-roman;padding-left:15px;">
                                <li> Virtual Assembly – Free hand exercises</li>
                                <li>Fun and Fitness- Aerobics, Dance forms, Rope Skipping, Hopscotch, Zig Zag and Shuttle Running etc. Fit India Active Break capsules could be used for demonstration purposes.</li>
                            </ul>
                            <p style="margin:0;">Link below:</p>
                            <p><a href="https://drive.google.com/drive/folders/1t14ZOGyh9biDsw8CxmxhogMwB0A8E2ll?usp=sharing" target="_blank" rel="noopener noreferrer">https://drive.google.com/drive/folders/1t14ZOGyh9biDsw8CxmxhogMwB0A8E2ll?usp=sharing</a></p>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>02</td>
                        <td>
                            <ul style="list-style-type: upper-roman;padding-left:15px;">                          

                                <li>Virtual Assembly – Common Yoga Protocols <a class="getlink" href="javascript:void(0);" data-link="https://yoga.ayush.gov.in/yoga/common-yoga-protocol"  rel="noopener noreferrer">https://yoga.ayush.gov.in/yoga/common-yoga-protocol</a></li>
                                <li>Mental Fitness Activities (Ex. Debates, Symposium, Lectures by Sports Psychologists)</li>
                                <li>Debates, Symposium, Lectures on “Re-strengthening of the mind post pandemic”– Mental Fitness Activities for Students, Staff and Parents</li>
                                <li>Open letter to Youth of the Nation on “Power of Fitness”</li>
                                <li>Open mic on topics such as “Exercise is a celebration of what your body can do, not a punishment for what you ate” etc.</li>
                              </ul>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>03</td>
                        <td>
                            <ul style="list-style-type: upper-roman;padding-left:15px;">
                                <li>Brain Games to improve concentration/problem solving capacity – e.g Chess, Rubik’s cube etc.</li>
                                <li>Poster making competition on theme “Hum Fit Toh India Fit” or “New India Fit India”</li>
                                <li>Preparing advertisements on “Hum Fit Toh India Fit”, “Emotional and physical well-being are interconnected” etc.</li>
                             </ul>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>04</td>
                        <td>
                            <ul style="list-style-type: upper-roman;padding-left:15px;">
                                <li>Debates, Symposium, Lectures etc about diet & nutrition during pandemic for Students / Staff & Parents</li>
                                <li>Essay/Poem Writing Competition on theme “Fitness beats pandemic”</li>
                                <li> Podcast/Movie making on suggested themes – “Get fit, don’t quit”; “Mental Health is not a destination but a journey” etc.</li>
                              </ul>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>05</td>
                        <td>
                          <ul style="list-style-type: upper-roman;padding-left:15px;">
                            <li>Online Quiz related to fitness/sports</li>
                            <li>Virtual challenges for students, staff/ teachers e.g.

                              <ul class="" style="list-style-type: bullet; padding-left:15px;margin-top:15px;position: relative;">
                                <li>Squats challenge</li>
                                <li>Step-up challenge</li>
    
                                <li>Spot jogging</li>
                                <li>Rope skipping</li>
                                <li>Ball dribbling etc</li>
                              </ul>
                            </li>   
                            <li>Session(s) by motivational speakers for students, parents and school staff</li>                      
                          </ul>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>06</td>
                        <td>
                            <p>1 day dedicated to Family Fitness:</p>
                            <ul style="list-style-type: upper-roman;padding-left:15px;">
                              <li>Activities for fitness sessions at home involving students and parents – Fit India Active Day capsules could be used for demonstration purposes<br>
                                <a href="https://drive.google.com/drive/folders/18ophVtYf3qBOhpLQpX66y_ywCK_kgTsS?usp=sharing"><em>https://drive.google.com/drive/folders/18ophVtYf3qBOhpLQpX66y_ywCK_kgTsS?usp=sharing</em></a>
                              </li>
                              <li>Creatively using home-based equipment for sports & fitness. E.g.
                                <ul style="padding-left:15px;margin-top:15px;">
                                  <li>Hacky sack at home (juggling with feet & hand – warm up activity)</li>
                                  <li>Aluminium foil inside a sock – ball and any wooden piece – bat to play cricket</li>
      
                                  <li>Mosquito bat and TT ball to play badminton/tennis</li>
                                  <li>Fitness circuit – Draw a ladder on the floor with a chalk piece or crayon</li>
                                </ul>
                              </li>
                              </ul>
                        </td>
                    </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->
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
      <form  action="school-week-merchandise" method="get">
        <div class="modal-body">
          <div class="form-group mb-1">
            <input type="text" name="school_name" class="form-control " id="exampleFormControlInput1" placeholder="Enter the name of your school">
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