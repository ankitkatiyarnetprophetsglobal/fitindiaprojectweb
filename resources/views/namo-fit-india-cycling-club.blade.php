@extends('layouts.app')
@section('title', 'Namo Fit India Club')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<div>
  {{-- <a href="{{ url('fit-india-namo-club') }}"> --}}
  <a  href="register?role=bmFtby1maXQtaW5kaWEteW91dGgtY2x1Yg==">
   <img src="{{ url('resources/imgs/09website-banner-namo-fit-india-cycling-club-Imagepng.png') }}" alt="youthclub" class="img-fluid expand_img" />
  </a>
</div>
 <section id="{{ $active_section_id }}">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
        <h1 class="et_pb_text_0">Namo Fit India Youth Club</h1>
        <a class="freedombtn3" href="{{ url('resources/pdf/how-to-register-for-namo-fit-india-cycling-youth-club.pdf') }}" target="_blank">How To Register</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mpr">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Background
                    </a>
                    </h4>
                </div>
                  <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                          <div class="table-responsive">
                            <ol>
                                <li>
                                    The FIT INDIA MOVEMENT was launched by the Hon'ble Prime Minister on 29th August 2019 with the goal of making physical fitness a way of life.
                                    His message of "Fitness ki dose, aadha ghanta roz," has motivated citizens to adapt a healthy and fit lifestyle for building a Fitter India.
                                    The movement aims to bring about a behavioural shift- from a sedentary to a physically active lifestyle.
                                    Fit India will succeed in building a Viksit Bharat and become a people's movement for which the citizens must become the catalysts and motivators
                                    in this transformation.
                                </li>
                                <li>
                                    The Fit India Mission seeks registration of Namo Fit India Youth Club to motivate individuals to become part of the FIT INDIA MOVEMENT by incorporating
                                    at least 45-60 minutes of physical activity into their daily routines.
                                    Both individuals and Youth Clubs can undertake various initiatives to promote their own health and well-being, as well as that of their fellow citizens.
                                </li>
                                <li>
                                    The Namo Fit India Youth club can be established in a region specific and activity specific manner. For instance, a Yoga Youth Club in Varanasi can be
                                    named Namo Fit India Yoga Club, Varanasi. These clubs shall play a pivotal role in promoting physical fitness across diverse communities.
                                </li>
                                <li>
                                    The administrator(s) of the Namo Fit India Youth Club shall make an endeavour to encourage and ensure a minimum participation of 50 members to build a vibrant,
                                    supportive community. This approach promotes fitness as a way of life, enhancing individual health and contributing to the broader FIT INDIA MOVEMENT.
                                </li>
                                <li>
                                    The Namo Fit India Youth Clubs are aimed to become the ambassadors of fitness, encouraging the spirit of voluntarism with an aim of building a
                                    Viksit Bharat and also representing the mission’s vision for a healthier, more active India.
                                </li>
                            </ol>
                          </div>
                      </div>
                  </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingsix">
                      <h4 class="panel-title">
                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="true" aria-controls="collapsesix">
                        Roles and Responsibilities
                      </a>
                      </h4>
                </div>
              <div id="collapsesix" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingfive">
                  <div class="panel-body">
                      <div class="table-responsive">
                        <b>The roles and responsibilities for Namo Fit India Youth Clubs are:</b>
                        <ul>
                            <li>
                                Each member of the Youth club should be aware about the importance of physical fitness and spend 30-60 minutes daily
                                for at least 5 days every week for group physical activities.
                            </li>
                            <li>
                                Each member of the Youth Club should commit to motivate one additional person every month for incorporating physical
                                activity of 30-60 mins in his/her daily routine.
                            </li>
                            <li>
                                The Youth club should organise or persuade the local body and school for organising one community fitness event every quarter.
                            </li>
                            <li>
                                The Youth Club and its members shall promote and participate in the activities of Fit India in their respective localities.
                            </li>
                        </ul>
                      </div>
                  </div>
                </div>
              </div>
    </div>
    <div class="row">
        <section>
            <div class="container">
                <div class="row et_pb_row_2">
                    <div class="col-sm-12">
                        <div class="et_pb_bg_layout_light">
                        <a class="" href="register?role=bmFtby1maXQtaW5kaWEteW91dGgtY2x1Yg==">Register For Namo Fit India Youth Club<span style="margin-left:10px"><svg aria-hidden="true"
                                    focusable="false" data-prefix="fas" data-icon="chevron-right"
                                    class="svg-inline--fa fa-chevron-right fa-w-1" role="img"
                                    xmlns="http://www.w3.org/2000/svg" width="12px" height="15px"
                                    viewBox="0 0 320 512">
                                    <path fill="currentColor"
                                        d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z">
                                    </path>
                                </svg></span></a>
                        </div>
                    </div>
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
