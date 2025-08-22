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
                    <p>The following parameters would apply: </p>
                    <ol style=" padding-left: 15px;">
                      <li>Having one teacher trained in PE, and such teacher is physically ﬁt and active.</li>
                      <li>Having a playground Where two or more outdoor games are played.</li>
                      <li>Having one PE period each day for every section and physical activities (sports, dance, games, yogasan, PT) take place in the PE period.</li>
                      <li>Having all students spending 60 minutes or more on physical activities daily.</li>
                    </ol>

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
                    <p>The following additional parameters would apply for claiming a 3 Star certification:</p> 
                   <ol style=" padding-left: 15px;">
                    <li>All teacher to be spending 60 minutes or more every day for physical activities.</li>
                    <li>School has at least two teachers (Including one PET), each trained or well versed with any two sports</li>
                    <li>School has celebrated Fit India School week.</li>
                    <li>Having Sports facilities for 4 sports including the 2 outdoor sports.</li>
                    <li>Every student learns and plays 2 sports – one of which could be a traditional/indigenous/local game.</li>
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
                <p>The following additional parameters (over and above 3 Star certification) would apply for claiming the highest certification:</p> 
                 <ol style=" padding-left: 15px;">
                  <li>School conducts quarterly intra-school sports competitions, participates in inter-school sports competition and celebrates Annual Sports Day.</li>
                  <li>All teachers are trained in PE.</li>
                  <li>School has 2 or more sports coaches. These may be PE teachers.</li>
                  <li>School follows structured PE curriculum prescribed by NCERT/CBSE/SCERT.</li>
                  <li>School conducts annual fitness assessment of all children.</li>
                  <li>School opens its playground(s) before/after school hours for neighbouring communities/parents, and the same is actively used. Reasonable fee can be levied for maintenance and security.</li>
                 </ol>
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
               <ol style=" padding-left: 15px;">
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
              {{-- <p>For information, contact:</p>
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
            <div>Queries may be sent to <a href="mailto:contact@fitindia.gov.in">contact[at]fitindia[dot]gov[dot]in</a></div>
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