@extends('layouts.app')
@section('title', 'Fit India School Registration| Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp

<section id="{{ $active_section_id }}">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
        <h1 class="et_pb_text_0">FIT INDIA SCHOOL CERTIFICATION</h1>
    </div>
    </div>
 <div class="row">
    <div class="col-sm-12 col-md-8">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                 <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Background
            </a>
          </h4>

            </div>
            <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                   <p>Hon’ble Prime Minister has launched the FIT INDIA Movement on 29th August 2019 With a view to make physical ﬁtness a way of life. <strong>FIT INDIA Movement </strong>aims at behavioural changes – from sedentary lifestyle to physically active way of day-to—day living. FIT INDIA would be a success only when it becomes a people’s movement. We have to play the role of a catalyst.</p>
                   <p>You would agree that ‘How to Live’ ought to be the ﬁrst pillar of formal education. This involves teaching and practicing the art of taking care of one’s body and health every day. Therefore, schools have to be the ﬁrst formal institution after home where physical ﬁtness is taught and practiced.</p>
                   <p>In the above background, the Fit India Mission has prepared a system of <strong>FIT INDIA SCHOOL Certification </strong>with simple and easy parameters as below:</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                 <h4 class="panel-title">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Fit India School
            </a>
          </h4>

            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    {{-- <p>The following parameters would apply: </p> --}}
                    <ol style="padding-left: 15px;padding-bottom: 5px;">
                        <li><p><b>PE Teacher</b></p></li>
                        <p>Schools must have at least one teacher who is responsible for:</p>
                        <p>Conducting and overseeing physical education activities and promoting a healthy lifestyle among students through regular engagement in fitness-related programs.</p>
                        <li><p><b>Accessible Playground / Play Area</b></p></li>
                        <p>Schools must have at least one designated teacher who is responsible for:</p>
                        <p>Conducting physical activities and promoting an active and healthy lifestyle among students</p>
                        <li><p><b>Celebration of Fit India School Week</b></p></li>
                        <p>Schools must have celebrated the Fit India School Week as part of their annual activities.</p>
                        <p>Activities during the week should encourage mass participation and create awareness of fitness culture in schools.</p>
                        <li><p><b>Accessible Playground or Play Area</b></p></li>
                        <p>Schools must have a safe, well-maintained playground or open space to conduct regular physical activities.</p>
                        <p>This space should be actively used for student engagement and should meet safety and usability standards.</p>
                        <li><p><b>Sports Facilities</b></p></li>
                        <p>The school must provide facilities for at least four sports, including:</p>
                        <p>A minimum of two outdoor sports.</p>
                        <p>These facilities should be functional and accessible for regular student use.</p>
                    </ol>

                    {{-- <ol  style=" padding-left: 15px;">
                        <li><b>Accessible Playground / Play Area</b></li>
                    </ol> --}}
                    {{-- <ol>
                        <li>Grades 1–5: Minimum 30 minutes</li>
                        <li>Grades 6–12: Minimum 45 to 60 minutes</li>
                    </ol> --}}
                </div>
            </div>
        </div>

         <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
              <h4 class="panel-title">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Fit India 3 Star School
            </a>
          </h4>

            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <ol style="padding-left: 15px;padding-bottom: 5px;">
                        <li><p><b>Active Participation in Daily Physical Activity</b></p></li>
                        <p>Schools must ensure that all students participate in daily physical activities as per the following durations:</p>
                        <p>Conducting and overseeing physical education activities and promoting a healthy lifestyle among students through regular engagement in fitness-related programs.</p>
                        <p>Grades 1–5: Minimum 30 minutes</p>
                        <p>Grades 6–12: Minimum 45 to 60 minutes</p>
                        <p>Activities should include sports, exercises, and fitness games conducted during school hours.</p>

                        <li><p><b> Designated PE Teacher</b></p></li>
                        <p>Schools must have at least one designated teacher who is responsible for:</p>
                        <p>Conducting physical activities and promoting an active and healthy lifestyle among students.</p>

                        <li><p><b> Celebration of Fit India School Week</b></p></li>
                        <p>Schools must have celebrated the Fit India School Week as part of their annual activities.</p>
                        <p>Activities during the week should encourage mass participation and create awareness of fitness culture in schools.</p>

                        <li><p><b>Accessible Playground or Play Area</b></p></li>
                        <p>Schools must have a safe, well-maintained playground or open space to conduct regular physical activities.</p>
                        <p>This space should be actively used for student engagement and should meet safety and usability standards.</p>

                        <li><p><b>Sports Facilities</b></p></li>
                        <p>The school must provide facilities for at least four sports, including: <br/> A minimum of two outdoor sports.</p>
                        <p>These facilities should be functional and accessible for regular student use.</p>
                    </ol>
                </div>
            </div>
        </div>


         <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                 <h4 class="panel-title">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
              Fit India 5 Star School
            </a>
          </h4>

            </div>
            <div id="collapsefive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
              <div class="panel-body">
                    <ol style="padding-left: 15px;padding-bottom: 5px;">

                        <li><p><b>Active Participation in Physical Activities</b></p></li>
                        <p>Schools must ensure:</p>
                        <p>Grades 1–5: Minimum 30 minutes of daily physical activity <br> Grades 6–12: Minimum 45–60 minutes of daily physical activity</p>
                        <p>Activities must include sports, exercises, and fitness games conducted within school hours.</p>
                        <li><p><b>Sports Coaches & Student Strength</b></p></li>
                        <p>The school must have at least two sports coaches (can also be PE teachers)</p>
                        <p>The school must have a minimum of 1,000 enrolled students</p>

                        <li><p><b>Accessible Playground</b></p></li>
                        <p>The school must maintain a safe and well-equipped playground or open play space suitable for regular physical activity and sports events.</p>

                        <li><p><b>PE Curriculum Aligned with NEP 2.0</b></p></li>
                        <p>Schools must follow a structured physical education curriculum based on the guidelines in NEP 2.0.</p>
                        <p>If not already aligned, schools should plan and commit to implementing it.</p>

                        <li><p><b>Fitness Assessment for All Students</b></p></li>
                        <p>The school must conduct annual fitness assessments of all students using:</p>
                        <p>Fit India Movement App (FIMA)</p>
                        <p>Or any other approved assessment method following FI Assessment parameters</p>

                        <li><p><b>Healthy Eating Awareness</b></p></li>
                        <p>Schools should actively encourage healthy eating habits among students by offering nutritious options in their canteens and promoting awareness of balanced diets.</p>

                    </ol>
                {{-- <p>The following additional parameters (over and above 3 Star certification) would apply for claiming the highest certification:</p> --}}
                 {{-- <ol style=" padding-left: 15px;">
                  <li>School conducts quarterly intra-school sports competitions, participates in inter-school sports competition and celebrates Annual Sports Day.</li>
                  <li>All teachers are trained in PE.</li>
                  <li>School has 2 or more sports coaches. These may be PE teachers.</li>
                  <li>School follows structured PE curriculum prescribed by NCERT/CBSE/SCERT.</li>
                  <li>School conducts annual fitness assessment of all children.</li>
                  <li>School opens its playground(s) before/after school hours for neighbouring communities/parents, and the same is actively used. Reasonable fee can be levied for maintenance and security.</li>
                 </ol> --}}
                </div>
            </div>
        </div>

       <div class="panel panel-default lastpanel">
        <div class="panel-heading" role="tab" id="headingThree">
             <h4 class="panel-title">
			 <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
			   Procedure for Schools to get Fit India Star Certification
			  </a>
            </h4>

        </div>
        <div id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
            <div class="panel-body">
                <ol style="padding-left: 15px;padding-bottom: 5px;">

                    <li><p><b>Already Registered? <br> Download Your Certificate in 5 Easy Steps: </b></p></li>
                    <ul>
                        <li>Visit <a href="https://fitindia.gov.in/">www.fitindia.gov.in</a>  and log in</li>
                        <li>Go to the <b>FIT India School Certification</b> section</li>
                        <li>Accept the updated Terms & Conditions</li>
                        <li>Fill in the required details</li>
                        <li>Submit and download your certificate instantly</li>
                    </ul>
                    <br/>
                    <li><p><b>New to FIT India? <br> Get Certified in 6 Simple Steps: </b></p></li>
                    <ul>
                        <li>Visit <a href="https://fitindia.gov.in/">www.fitindia.gov.in</a></li>
                        <li>Click on <b>'School Certification'</b> under the Certification tab</li>
                        <li>Sign up and log in</li>
                        <li>Go to <b>FIT India School Certification</b></li>
                        <li>Accept the Terms & Conditions</li>
                        <li>Fill in the required details, submit, and download your certificate</li>
                    </ul>
                    <br/>
                    <li><p><b>Important Note:</b></p></li>
                    <ul>
                        <li><b>Basic FIT India School Certification</b> is self-certified and granted online upon registration. Schools can download the certificate from the portal and use the <b>FIT India logo</b> upon receipt.</li>
                        <li><b>3-Star and 5-Star Certifications</b> are also self-certified but <b>subject to physical verification</b> by the FIT India team.</li>
                        <li>To uphold the authenticity and sustainability of the standards claimed, Fit India reserves the right to revoke the certification or introduce any legal provisions at its sole discretion.</li>

                    </ul>


                    {{-- <p>Schools must ensure:</p>
                    <p>Grades 1–5: Minimum 30 minutes of daily physical activity <br> Grades 6–12: Minimum 45–60 minutes of daily physical activity</p>
                    <p>Activities must include sports, exercises, and fitness games conducted within school hours.</p>
                    <li><p><b>Sports Coaches & Student Strength</b></p></li>
                    <p>The school must have at least two sports coaches (can also be PE teachers)</p>
                    <p>The school must have a minimum of 1,000 enrolled students</p>

                    <li><p><b>Accessible Playground</b></p></li>
                    <p>The school must maintain a safe and well-equipped playground or open play space suitable for regular physical activity and sports events.</p>

                    <li><p><b>PE Curriculum Aligned with NEP 2.0</b></p></li>
                    <p>Schools must follow a structured physical education curriculum based on the guidelines in NEP 2.0.</p>
                    <p>If not already aligned, schools should plan and commit to implementing it.</p>

                    <li><p><b>Fitness Assessment for All Students</b></p></li>
                    <p>The school must conduct annual fitness assessments of all students using:</p>
                    <p>Fit India Movement App (FIMA)</p>
                    <p>Or any other approved assessment method following FI Assessment parameters</p>

                    <li><p><b>Healthy Eating Awareness</b></p></li>
                    <p>Schools should actively encourage healthy eating habits among students by offering nutritious options in their canteens and promoting awareness of balanced diets.</p> --}}

                </ol>
               {{-- <ol style=" padding-left: 15px;">
                <li>Basic FIT INDIA SCHOOL would be self certiﬁed and registered online at www.ﬁtindia.gov.in by the School. Upon registration, a certiﬁcate would be issued online to the School, and on receipt of such certiﬁcate the School would be entitled to use Fit India Logo and Fit India Flag.</li>
                <li>For FIT INDIA 3 Star or 5 Star certification the school would have to ﬁle its claim online at www.ﬁtindia.gov.in. The Fit India Mission would get the claim veriﬁed and thereafter issue an online certiﬁcate and commendation letter. The same would be followed in print and dispatched through postal mail.</li>

              </ol>
              <p>FIT INDIA is going to be included in the Prime Minister’s Award. I request you to make FIT INDIA a successful people’s movement by providing your leadership for the following:</p>
              <ol style=" padding-left: 15px;">
                <li>Apprising all schools, public as well as private, in your State of the above and encouraging them to seek Fit India Ranking.</li>
                <li>To honour Fit India 3 Star and 5 Star Schools by organising appropriate function in the State Head-Quarters. Fit India 5 Star Schools could be felicitated at State level Republic Day and Independence Day functions</li>
                <li>Nominate a senior ofﬁcer as a State Nodal Ofﬁcer for Fit India in your department and intimate to us; and</li>
                <li>Organise Fit India events at schools from time to time. You may encourage schools to use their creativity in designing and organising Fit India events.</li>
              </ol>
              <p>For information, contact:</p>
              <table border="0" width="100%" class="table-grid">
                <tbody>
                <tr>
                <th colspan="2">Contact Person</th>
                </tr>
                <tr>
                <td><strong>Rohit Khanna</strong><br> CEO Fit India Mission</td>
                <td><strong>Ms. Amar Jyoti</strong><br> Mission Director Fit India</td>
                </tr>
                </tbody>
                </table> --}}
            </div>
            <br>
            <br>
            <div>Queries may be sent to <a href="mailto:contact.fitindia@gmail.com">contact[dot]fitindia[at]gmail[dot]com</a></div>
        </div>
    </div>

    </div>
    </div>
    <div class="col-sm-12 col-md-4">
      <div class="row">
        <div class="org-event org_mob">
        <input type="checkbox" id="agreed" name="agreed" value="yes" onclick="enablecls()">
        <span class="wpcf7-list-item-label">I have read and understood the concept of Fit India School Certification guidelines. I agree to follow the guidelines of Fit India School Certification</span>
        <input type="button" id="organise-event-btn" class="organise-event-btn disable" onclick="chkorganise()" value="Apply for Fit India School Certification">
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
				   window.location.href = "{{ url('/fit-india-school-certification') }}"

            }
        }

        function form_organise() {
          var agree = document.getElementById('agreed');
          if (agree.checked == false){
                       alert("Please Check Terms & Conditions");
                       return false;
                  }else{
               window.location.href = 'https://fitindia.gov.in/login?rurl=fit-india-school-certification';
          }
        }
      </script>
    </div>
    <div class="row">
      <div class="et_pb_button_btn_area">
      <a class="et_pb_button_btn" href="Fit-India-Movement-2019.pdf" target="_blank" data-icon="5">Fit India School Certification Circular</a>
    </div>
    </div>
    </div>
    </div>
    </div>
</section>
 @endsection
