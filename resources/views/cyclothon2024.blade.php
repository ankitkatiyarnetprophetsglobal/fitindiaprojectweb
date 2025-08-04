@extends('layouts.app')
@section('title', 'Fit India Cycling Drive')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<div class="banner">
  <div class="row">
      <div class="col-12">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              {{-- <img src="{{ asset('resources/imgs/soc15042025.jpeg') }}" alt="sports-day" title="national-sports-day" class="img-fluid expand_img" /> --}}
              <div class="carousel-inner">
                  <div class="carousel-item mer_banner active">
                    <a href="coiregistration">
                      {{-- <img src="{{ asset('resources/imgs/soc15042025.jpeg') }}" class="d-block w-100" alt="Fit India Cycling Drive" title="Fit India Cycling Drive"> --}}
                      <img src="{{ $websitebanner ?? 'https://fitindia.gov.in/resources/imgs/soc-11052025.png' }}" class="d-block w-100" alt="Fit India Cycling Drive" title="Fit India Cycling Drive">
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
                    <a href="coiregistration">
                      <img src="{{ asset('resources/imgs/fit-india-cyclothon-two.png') }}" class="d-block w-100" alt="Fit India Cycling Drive" title="Fit India Cycling Drive">
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
{{-- <div>
  <a  href="register?role=Y3ljbG90aG9uLTIwMjQ=">
   <img src="{{ url('resources/imgs/fitindia-cyclothon.png') }}" alt="youthclub" class="img-fluid expand_img" />
  </a>
</div>       --}}
 <section id="{{ $active_section_id }}">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
        <h1 class="et_pb_text_0">Fit India Sundays on Cycle</h1>
        {{-- <a class="freedombtn3" href="{{ url('resources/pdf/how-to-register-for-namo-fit-india-cycling-club.pdf') }}" target="_blank">How To Register</a> --}}
    </div>
</div>

<div class="row">
    <div class="col-md-12 mpr">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Overview
                    </a>
                    </h4>
                </div>
                  <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                          <div class="table-responsive">
                            <p>India’s Movement Against Obesity and for a Fitter Tomorrow</p>
                            <p>Cycling is one of the most accessible and effective forms of exercise—enhancing stamina, reducing stress, improving cardiovascular health, and promoting mental well-being. It is also a clean, eco-friendly mode of transport that contributes to reducing pollution and building a greener nation.</p>
                            <p>In line with the Hon’ble Prime Minister’s call, “Fitness ki dose, aadha ghanta roz,” cycling has become a popular fitness activity that blends health with sustainability.</p>
                            <p>Building on the success of the Fit India Cycling Drive, which saw the participation of over 1.5 crore citizens across India, FIT India, under the leadership of Honourable MYAS Shri Mansukh Mandaviya, launched “Sundays on Cycle” on 17th December 2024 as a weekly national movement.</p>
                            {{-- <p>MYAS Shri Mansukh Mandaviya, launched “Sundays on Cycle” on 17th December 2024 as a weekly national movement.</p> --}}
                            <p>The inaugural event was flagged off from Major Dhyan Chand National Stadium to Kartavya Path in New Delhi, setting the tone for what has now become a community-led fitness revolution.</p>
                            <p>Since its launch, Sundays on Cycle has been celebrated every Sunday at thousands of locations across the country—bringing together citizens of all age groups to take a stand against obesity and commit to a healthier, more active lifestyle.</p>
                            <p>Local authorities, schools, colleges, RWAs, and fitness groups organise weekly cycling rallies that promote:</p>
                            <ul>
                                <li>Regular physical activity for all</li>
                                <li>Awareness about lifestyle diseases and preventive health</li>
                                <li>Eco-friendly mobility and reduced carbon footprint</li>
                                <li>People’s participation (Jan Bhagidari) in national fitness efforts</li>
                            </ul>
                            <p>Sundays on Cycle is more than just a campaign—it is a weekly reminder that fitness can be fun, inclusive, and community-driven.</p>
                            <p><b>Want to participate? Register now on the Fit India Mobile App to join <i> Sundays on Cycle </i> and enjoy a variety of fun-filled activities every Sunday, along with cycling at the designated venue. Don’t miss out—be a part of the movement by signing up through our app today!</b></p>
                            {{-- <ol>
                                <li class="mb-2">
                                  Cycling is one of the most accessible and effective ways to incorporate fitness into daily routines, offering benefits such as enhanced stamina, stress reduction, and improved cardiovascular health.
                                </li>
                                <li class="mb-2">
                                  In alignment with the Hon'ble Prime Minister's mantra, "Fitness ki dose, aadha ghanta roz," cycling also serves as an eco-friendly solution to mitigate pollution, contributing to a "Green, Fit India."
                                </li>
                                <li class="mb-2">
                                  Building on the success of initiatives like the Fit India Cycling Drive, which saw participation from over 1.5 crore citizens, the Ministry of Youth Affairs and Sports is pleased to launch of "Fit India Cycling Drive - Making Cycling Sunday's a Janbhagidari Movement" to further embed cycling into the nation's lifestyle.
                                </li>
                                <li class="mb-2">
                                  The inaugural event will be led by the Hon’ble MYAS on 17th December 2024, with a cycling rally starting from Major Dhyan Chand National Stadium along Raisina Road to Kartavya Path.
                                </li>
                                <li class="mb-2">
                                  The Fit India Cycling Drive - Cycling Sunday's reflects the core mission of the Fit India Movement—fostering health, fitness, and sustainability. By inspiring millions across the nation to pedal towards a fitter future, it successfully bridges individual wellness with collective environmental responsibility.
                                </li>
                            </ol> --}}
                          </div>
                      </div>
                  </div>
            </div>
            {{-- <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingsix">
                      <h4 class="panel-title">
                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="true" aria-controls="collapsesix">
                        Namo Fit India Cycling Club - Parameters
                      </a>
                      </h4>
                </div>
              <div id="collapsesix" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingfive">
                  <div class="panel-body">
                      <div class="table-responsive">
                        <b>The following parameters will apply for cycling clubs or groups:</b>
                        <ul>
                            <li>
                                Each member of the cycling club should be aware of the importance of
                                cycling and commit to participating in group cycling activities for at least 30-60 minutes daily, five days a week.
                            </li>
                            <li>
                                Each member of the cycling club should also commit to motivating one additional person every month to incorporate cycling into their daily routine.
                            </li>
                            <li>
                                The cycling club should organize or collaborate with local bodies and schools to host one community cycling event every quarter.
                            </li>
                            <li>
                                Actively promote the activities of Fit India in their localities.
                            </li>
                        </ul>
                      </div>
                  </div>
                </div>
              </div> --}}
    </div>
    <div class="row">
        <section>
            <div class="container">
                <div class="row et_pb_row_2">
                    {{-- <div class="col-sm-12">
                        <div class="et_pb_bg_layout_light"> --}}
                        {{-- <a class="" href="register?role=Y3ljbG90aG9uLTIwMjQ=">Register For Fit India Cycling Drive<span style="margin-left:10px"><svg aria-hidden="true" --}}
                        {{-- <a class="" href="cyclothonregistrationform">Register For Fit India Cycling Drive<span style="margin-left:10px"><svg aria-hidden="true" --}}
                        {{-- <a class="" href="coiregistration">Register For Fit India Cycling Drive<span style="margin-left:10px"><svg aria-hidden="true"
                                    focusable="false" data-prefix="fas" data-icon="chevron-right"
                                    class="svg-inline--fa fa-chevron-right fa-w-1" role="img"
                                    xmlns="http://www.w3.org/2000/svg" width="12px" height="15px"
                                    viewBox="0 0 320 512">
                                    <path fill="currentColor"
                                        d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z">
                                    </path>
                                </svg></span></a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
    </div>
    {{-- <div class="col-md-4">
      <div class="row">
        <div class="org-event org_mob cutbox">
        <input type="checkbox" id="agreed" name="agreed" value="yes" onclick="enablecls()">
        <span class="wpcf7-list-item-label">I have read and understood the concept of Fit India Youth Club Certification guidelines. I agree to follow the guidelines of Fit India Youth Club Certification</span>
        <input type="button" id="organise-event-btn" class="organise-event-btn disable" onclick="chkorganise()" value="Apply for Fit India Youth Club Certification">
      </div>
      <script type="text/javascript">
        function enablecls(){
          var agree = document.getElementById('agreed');
            if (agree.checked == false){
              jQuery('#organise-event-btn').addClass('disable');
                        return false;
                    }else{
             jQuery('#organise-event-btn').removeClass('disable');
            }
        }

        function chkorganise(){
          var agree = document.getElementById('agreed');
            if (agree.checked == false){
                       alert("Please Check Terms & Conditions");
              return false;
                    }else{
            window.location="{{ route('youthcert') }}";
            }
        }

        function form_organise() {
        var agree = document.getElementById('agreed');
        if (agree.checked == false){
                     alert("Please Check Terms & Conditions");
                     return false;
                }else{
             window.location.href = 'https://fitindia.gov.in/login?rurl=fit-india-youth-club-certification';
        }
        }
      </script>
    </div> --}}
    <!-- <div class="row">
      <div class="et_pb_button_btn_area">
      <a class="et_pb_button_btn" href="Fit-India-Movement-2019.pdf" target="_blank" data-icon="5">Fit India School Certification Circular</a>
    </div>
    </div> -->
    </div>
    </div>
    </div>
</section>
@endsection
