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
        <img src="{{ asset('resources/imgs/school_quiz/new_pkl_dashboard.jpg') }}" alt="school-week" title="school-week"
            class="img-fluid expand_img" />
        <section id="{{ $active_section_id }}">
            <div class="container">
                
                {{-- <div class="row">
                    <a class="freedombtn4" href="{{ url('quiz-login') }}" style="background-color: #833ab4;">Already
                        Registered School</a>
                    <a class="freedombtn1" href="register/">New Registration</a>
                    
                    <a class="freedombtn3" href="{{ url('resources/pdf/school-week-how-to-register.pdf') }}"
                        target="_blank">How To Register</a>
                </div><br> --}}
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="headingh1">vivo PKL Fit India School Week 2022 Quiz</h1>
                        <br><br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="accordion" id="accordionFISW">
                            <div class="card">
                                <div class="card-head" id="headingOne">
                                    <h2 class="mb-0" data-toggle="collapse" data-target="#collapseFISW2"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        Background
                                    </h2>
                                </div>

                                <div id="collapseFISW2" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionFISW">
                                    <div class="card-body" style="padding-top:10px; padding-left:30px; text-align:justify;">
                                        <p>Fit India School Week is the flagship program of Fit India Movement. The objective of this program is to encourage school fraternity i.e., students, parents, school staff etc to inculcate fitness in their daily lives. The 4th edition of Fit India School Week commenced on 15th November 2022 and will culminate on 15th December 2022.</p>
                                        <p>vivo Pro Kabaddi League (PKL) is one of the premier sports leagues in India with an objective to promote one of country’s popular indigenous sports – Kabaddi among the Indian masses. The league has witnessed phenomenal growth and has amassed a huge fan following all over the country.</p>
                                        <p>Fit India in collaboration with vivo PKL is organising a nationwide online quiz from 5th December to 12th December 2022. Five lucky winners will get a chance to witness vivo PKL PLAYOFFS LIVE in December 2022.</p>
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
                            {{-- <div class="card">
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
            </div> --}}
                        </div>

                        <div class="accordion" id="accordionFISW">
                            <div class="card">
                                <div class="card-head" id="headingOne">
                                    <h2 class="mb-0" data-toggle="collapse" data-target="#collapseFISW1"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        Guidelines to participate in quiz
                                    </h2>
                                </div>

                                <div id="collapseFISW1" class="collapse " aria-labelledby="headingOne"
                                    data-parent="#accordionFISW">
                                    <div class="card-body" style="padding-top:10px; padding-left:30px; text-align:justify;">
                                      <ol class="pl-3">
                                        <li>All school students (Indian citizens) can participate in the quiz</li>
                                        <li>Participants are required to fill their Full Name, Date of Birth, Parent’s / Guardian’s Name, Contact Number of Student / Parent / Guardian (Mobile Number), Name of School, City/Town, Pin code and State / UT.</li>
                                        <li>A student can participate in the quiz only once.</li>
                                        <li>In case of tie in scores, the fastest completed score will be considered. In case of further tie, a draw of lots will be employed</li>
                                        <li>Five lucky winners will be announced at the end of contest.</li>
                                      </ol>
                                       
                                        {{-- <p>Fit India School Week is the flagship program of Fit India Movement which has witnessed over 8.5 lakhs participation from schools across the country in the last 3 editions. The objective of this program is to encourage school fraternity i.e., students, parents, school staff etc to inculcate fitness in their daily life. Schools are encouraged to celebrate a week of fitness during the month-long campaign in the form of various activities such as dance forms, sketching and drawing, debates and quizzes, demonstration of indigenous sports, sports competitions, music, and video making activities etc. The 4th edition of Fit India School Week is scheduled to take place from 15th November to 15th December 2022.</p>
                <p>Pro Kabaddi League (PKL) was launched in 2014 with an aim to promote one of India’s popular indigenous sports – Kabaddi among the Indian masses. It is 2nd most popular sport in India behind cricket. The league has witnessed phenomenal growth in eight editions conducted till date and has amassed a huge fan following all over the country. </p>
                <p>To popularise the ongoing school week campaign and Pro Kabaddi League amongst the schools of the country, a quiz contest is being organized by Fit India Mission in collaboration with PKL. The contest will run on Fit India Portal from 21st November to 5th December 2022. The quiz will be based on PKL wherein the questions will be asked with multiple options and the user must select correct option. 5 lucky winners (school students) along with their school principal or PE teacher will get a chance to witness PKL Play-off live in December 2022. </p> --}}
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
                            {{-- <div class="card">
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
            </div> --}}
                        </div>

                        <div class="accordion" id="accordionFISW">
                            <div class="card">
                                <div class="card-head" id="headingOne">
                                    <h2 class="mb-0" data-toggle="collapse" data-target="#collapseFISW3"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        Terms &amp; Conditions
                                    </h2>
                                </div>

                                <div id="collapseFISW3" class="collapse " aria-labelledby="headingOne"
                                    data-parent="#accordionFISW">
                                    <div class="card-body" style="padding-top:10px; padding-left:30px; text-align:justify;">
                                        
                                            
                                              <ul style="margin-left:15px; list-style:disc;">
                                                {{-- <li>{{__('The quiz is being organised by the Fit India, Ministry of Youth Affairs & Sports (MYAS), Government of India in collaboration with vivo Pro Kabaddi League (PKL) on Fit India platform. Access to the quiz will only be through the Fit India platform and no other channel. ')}}</li> --}}
                                              <li>The quiz is being organised by the Fit India, Ministry of Youth Affairs & Sports (MYAS), Government of India in collaboration with vivo Pro Kabaddi League (PKL) on Fit India platform. Access to the quiz will only be through the Fit India platform and no other channel.</li>
                                              <li>The following terms and conditions henceforth shall be governed by Indian laws and the judgements of the Indian judicial system.</li>
                                              <li>The quiz is applicable to all school students (Indian citizens) in India.</li>
                                              <li>Entry to quiz will be open from 5th December 2022 till 12th December 2022, 5:00 PM. Participants will be required to answer 5 questions within a span of 60 seconds.</li>
                                              <li>The quiz will start as soon as the participant clicks on the Start Quiz button.</li>
                                              <li>Entries once submitted cannot be withdrawn.</li>
                                              <li>Questions contained within the quiz will be based on publicly available information on vivo Pro Kabaddi League (PKL) and Kabaddi.</li>
                                              <li>Questions will be asked with multiple options and the user must select only one correct option.</li>
                                              <li>Participants are required to fill their Full name, Date of birth, Parent’s / Guardian’s Full Name, Contact Number of Student / Parent / Guardian (Mobile Number), Full Name of School, City/Town, Pin code and State / UT.</li>
                                              <li>By submitting their details and participating in the quiz, participants will give consent to the MYAS to use this information as required to facilitate the conduct of the quiz competition, which may include confirmation of participant details, announcement of winners, and disbursement of awards etc.</li>
                                              <li>Participants can only enter the quiz competition once. Multiple entries from the same participant will not be accepted and considered.</li>
                                              <li>5 lucky winners will be announced at the end of the contest who will stand a chance to watch vivo PKL PLAYOFFS LIVE.</li>
                                              <li>The lucky winner selection will be done in the following manner:
                                                <ul>
                                                  <li>a)  The fastest completed score will be considered</li>
                                                  <li>b)	Random selection by draw of lots, in case a lucky winner is still not determined</li>
                                                </ul>
                                              </li>
                                              <li>To be declared as a lucky winner, it is mandatory that the student should belong to a registered Fit India School as on 12th December 2022.</li>
                                              <li>In the event of unforeseen circumstances, organisers reserve the right to amend the terms and conditions of the competition at any time or cancel the competition as considered fit.</li>
                                              <li>The organisers reserve the rights to disqualify participants, refuse entry, or discard entries, if such instances or participation are detrimental to the competition, or additionally, any entry will be considered void if the information submitted is illegible, incomplete, false, or erroneous.</li>
                                              <li>Organisers will not accept any responsibility for entries that are lost, late, incomplete or have not been transmitted due to internet or computer errors or any other error beyond the organiser’s reasonable control. Please note proof of submission of the entry is not proof of receipt of the same.</li>
                                             <li>The participants shall abide by all the terms and conditions of the quiz competition, including any amendments or further updates.</li> 
                                           <li>Organiser’s decision on the quiz shall be final and binding and no correspondence will be entered regarding the same. By entering the Quiz, the participant accepts and agrees to be bound by the above-mentioned terms and conditions.</li>
                                          {{-- <li>Organiser’s decision on the quiz shall be final and binding and no correspondence will be entered regarding the same. By entering the Quiz, the participant accepts and agrees to be bound by the above-mentioned terms and conditions.</li>  --}}                                         
                                        </ul>
                                            

                                       
                                        {{-- <p>Fit India School Week is the flagship program of Fit India Movement which has witnessed over 8.5 lakhs participation from schools across the country in the last 3 editions. The objective of this program is to encourage school fraternity i.e., students, parents, school staff etc to inculcate fitness in their daily life. Schools are encouraged to celebrate a week of fitness during the month-long campaign in the form of various activities such as dance forms, sketching and drawing, debates and quizzes, demonstration of indigenous sports, sports competitions, music, and video making activities etc. The 4th edition of Fit India School Week is scheduled to take place from 15th November to 15th December 2022.</p>
                <p>Pro Kabaddi League (PKL) was launched in 2014 with an aim to promote one of India’s popular indigenous sports – Kabaddi among the Indian masses. It is 2nd most popular sport in India behind cricket. The league has witnessed phenomenal growth in eight editions conducted till date and has amassed a huge fan following all over the country. </p>
                <p>To popularise the ongoing school week campaign and Pro Kabaddi League amongst the schools of the country, a quiz contest is being organized by Fit India Mission in collaboration with PKL. The contest will run on Fit India Portal from 21st November to 5th December 2022. The quiz will be based on PKL wherein the questions will be asked with multiple options and the user must select correct option. 5 lucky winners (school students) along with their school principal or PE teacher will get a chance to witness PKL Play-off live in December 2022. </p> --}}
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
                            {{-- <div class="card">
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
            </div> --}}
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
                              <li>Schools should register themselves on <a href="{{ asset('fit-india-school-week') }}">https://fitindia.gov.in/fit-india-school-week</a> and upload photos and video link related to the event</li>
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
                <br>
                <div class="row align-items-center justify-content-center">
                 <div class="col-auto">
                  <a class="freedombtn4" href="{{url('school-week-quiz-dashboard')}}" style="background-color: #833ab4;">
                    Take Quiz
                  </a>
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
                <form action="school-week-merchandise" method="get">
                    <div class="modal-body">
                        <div class="form-group mb-1">
                            <input type="text" name="school_name" class="form-control " id="exampleFormControlInput1"
                                placeholder="Enter the name of your school">
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
