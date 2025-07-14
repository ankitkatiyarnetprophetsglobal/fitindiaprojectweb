@extends('layouts.app')
@section('title', 'Fit-india-quiz | Fit India')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    @php
        $active_section = request()->segment(count(request()->segments()));
        $active_section_id = trim($active_section);
    @endphp
    <style>
        .cont_area_cont {
            height: auto;
        }

        .cont_area_cont h1 {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            background: #afdcfe;
            padding: 15px 0;
        }

        .cont_area_cont .mail_img img {
            width: 300px;
            padding: 20px;
        }


        @media (max-width: 767px) {
            .cont_area_cont h1 {
                font-size: 22px;
            }

        }
        a.disabled {
  pointer-events: none;
  cursor: default;
}
    </style>

    <div>
        <img src="resources/imgs/fitindia_quiz_inner2_2022.jpeg" alt="Fit-india-quiz" title="Fit India Quiz 2022"
            class="img-fluid expand_img" />
    </div>

    <section id="{{ $active_section_id }}">

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h1 class="mb-4">Fit India Quiz </h1>
                    <p>Fit India Quiz was launched in 2021 as a part of commemorating ‘Azadi Ka Amrit Mohotsav’, it was
                        envisaged to propagate the message of Fit India among the school children and strengthen its
                        presence in schools, a Fit India Quiz has been envisioned to involve school children across the
                        country. Fit India Quiz is dedicated to the school students where students with interest in sports
                        and fitness can participate and compete at state and national level. In the first edition of Fit
                        India Quiz, 36,299 students from 13,502 school participated and showcased their knowledge in fitness
                        and sports. Fit India Quiz has become a popular mechanism to align the kids across the country to
                        join the mission of fitness and adopt the fit lifestyle. Fit India Quiz comprised of preliminary
                        rounds, state level rounds and national rounds, thus making it one of the most comprehensive and
                        flagship quiz programs on fitness and sports in the country.</p>



                </div>
                <div class="mt-3 mb-3 ml-2 quiz_btn_fit ">
                    <a class="btn btn-primary btn-sm d_button b_color " href="https://fitindia.nta.ac.in/"
                        target="_blank">Download Admit Cards</a> <!-- Register Now -->
                    <a class="btn btn-primary btn-sm d_button "
                        href="resources/pdf/Circular_Fi_India_Quiz_2022_Date_Extenstion.pdf" target="_blank"> <i
                            class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp; Download Circular</a>
                    <a class="btn btn-primary btn-sm d_button f_color"
                        href="resources/pdf/Fit_India_Quiz_2022_Schedule_of_activities.pdf" target="_blank"> <i
                            class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp; Schedule</a>
 			<a class="btn btn-primary btn-sm d_button border-0" style="background-color:#b3912d"
                        href="https://youtu.be/JSaNPKPnYN8" target="_blank"> <i
                            class="fa fa-youtube" aria-hidden="true"></i>&nbsp; Tutorial Video</a>

                {{-- excel download --}}
                   
                    <!--<a class="btn btn-primary btn-sm d_button f_color" href="resources/pdf/FREQUENTLY_ASKED_QUESTIONS.pdf" target="_blank"><i class="fa fa-question-circle-o" aria-hidden="true"></i>&nbsp; FAQ</a>-->
                    <!--<a class="btn btn-info btn-sm d_button " href="resources/pdf/State-District-wise-participation.xlsx" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp; District wise participation</a>-->
                </div>


              <div class="container">
              <div class="row">
                <div class="col-12">
                    <div class="w-100">
                        <h5>Download State wise sheet for Fit India Quiz 2022 Registered Students</h5>
                    </div>
                    <div class="d-flex align-items-center flex-row ">
                        
                        <div class="form-group user_child last-t " style="margin:0 !important; width: 210px !important; display:flex; flex-direction:column;">
                            {{-- <label style="font-weight: 700; margin:0;  font-size:14px" >State/UT</label> --}}
                            <select name="state"
                                class="form-control excel_state"
                                aria-required="true"  >
                                <option value="">{{ __('Select State/UT') }}</option>
                                
                                    <option value="ANDAMAN NICOBAR.xlsx">ANDAMAN NICOBAR</option>
                                    <option value="ANDHRA PRADESH.xlsx">ANDHRA PRADESH</option>
                                    <option value="ARUNACHAL PRADESH.xlsx">ARUNACHAL PRADESH</option>
                                    <option value="ASSAM.xlsx">ASSAM</option>
                                    <option value="BIHAR.xlsx">BIHAR</option>
                                    <option value="CHANDIGARH.xlsx">CHANDIGARH</option>
                                    <option value="CHHATTISGARH.xlsx">CHHATTISGARH</option>
                                    <option value="DskPZvMjWGctfqWhscPrRKTYXS6rfeCxaMQ">DADRA NAGAR HAVELI & DAMAN DIU</option>
                                    <option value="DELHI.xlsx">DELHI</option>
                                    <option value="GOA.xlsx">GOA</option>
                                    <option value="GUJARAT.xlsx">GUJARAT</option>
                                    <option value="HARYANA.xlsx">HARYANA</option>
                                    <option value="HIMACHAL PRADESH.xlsx">HIMACHAL PRADESH</option>
                                    <option value="JAMMU KASHMIR.xlsx">JAMMU KASHMIR</option>
                                    <option value="JHARKHAND.xlsx">JHARKHAND</option>
                                    <option value="KARNATAKA.xlsx">KARNATAKA</option>
                                    <option value="KERALA.xlsx">KERALA</option>
                                    <option value="LADAKH.xlsx">LADAKH</option>
                                    <option value="LAKSHADWEEP.xlsx">LAKSHADWEEP</option>
                                    <option value="MADHYA PRADESH.xlsx">MADHYA PRADESH</option>
                                    <option value="MAHARASHTRA.xlsx">MAHARASHTRA</option>
                                    <option value="MANIPUR.xlsx">MANIPUR</option>
                                    <option value="MEGHALAYA.xlsx">MEGHALAYA</option>
                                    <option value="MIZORAM.xlsx">MIZORAM</option>
                                    <option value="NAGALAND.xlsx">NAGALAND</option>
                                    <option value="ODISHA.xlsx">ODISHA</option>
                                    <option value="PUDUCHERRY.xlsx">PUDUCHERRY</option>
                                    <option value="PUNJAB.xlsx">PUNJAB</option>
                                    <option value="RAJASTHAN.xlsx">RAJASTHAN</option>
                                    <option value="SIKKIM.xlsx">SIKKIM</option>
                                    <option value="TAMIL NADU.xlsx">TAMIL NADU</option>
                                    <option value="TELANGANA.xlsx">TELANGANA</option>
                                    <option value="TRIPURA.xlsx">TRIPURA</option>
                                    <option value="UTTAR PRADESH.xlsx">UTTAR PRADESH</option>
                                    <option value="UTTARAKHAND.xlsx">UTTARAKHAND</option>
                                    <option value="WEST BENGAL.xlsx">WEST BENGAL</option>
                                    
                             </select>
                </div>
    
                <div class="state_excel_container" style="margin: 0 10px  !important;"></div>
                    </div>
                    <!-- <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                            <h3 class="reg_op">Registration are open</h3>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <ol>
                            <h1 class="mb-4">Terms and conditions for Fit India Quiz State Web Round: General: </h1>
                            <li> The Fit India Quiz State Web Round is conducted in an online mode where only two participants from the particular school will be joining the online meeting link provided to them .
                            </li>
                            <li> The students mentioned in the registration  form (both selected and nominated) will be participating in the Fit India Quiz State Web Rounds at the School premises. Under no circumstances, the School is allowed to replace the candidate.</li>
    
                            <li> All national, state and local laws and regulations apply. Fit India Mission  reserves the right to disqualify any Participant from the Contest if, in Fit India Mission's sole discretion, it reasonably believes that the Participant has attempted to undermine the legitimate operation of the Contest by cheating, deception, or other unfair playing practices or annoys, abuses, threatens or harasses any other Participants, Fit India Mission, or the Quiz Master.</li>
    
                            <li> By entering the competition, the participants & attendees permit themselves to be photographed/ recorded by electronic, online and print media for telecast, publications & contacted by their given email ids and other display usage of the Fit India Mission or its consultant. Fit India Mission or its consultant may also collect any information, photograph, video clip etc. from the participant for publication or sharing for the promotional requirement of Fit India Mission or its consultant.</li>
    
                            <li> Fit India Mission will not be responsible for any malfunction of the entire Contest Site or any late, lost, damaged, misdirected, incomplete, illegible, undeliverable, answers to system errors, failed, incomplete or garbled computer or other telecommunication transmission malfunctions, network connectivity problems, hardware or software failures of any kind.</li>
                            &nbsp;
                            <h1>Conduct of the Candidates and the School:</h1>
                            &nbsp;
                            <li> The candidates are required to participate in the quiz from their respective schools and appear in their school uniforms.</li>
                            
                            <li> If any of the candidate among the two, fails to participate in the quiz, the other candidate can represent their school alone and will be considered for the evaluation.</li>
                            
                            <li> The candidates will not be allowed to take breaks during the quiz and hence make themselves prepared for the same.</li>
                            
                            <li> The students are required to join the online meeting link at least 45-60 min before the quiz in order to do the adequate tech check.</li>
                            
                            <li> In case of any technical difficulty faced by the candidates in joining the online quiz, there will be a time grace of 10 min only at the beginning of the quiz. In case there is any technical issue occurring  during the quiz, a grace time of 2 minutes to resume the connectivity will be provided to the candidate and failure to join back within the grace time may result in elimination.</li>
                            
                            <li> The School will be responsible for providing to the students- Laptop/Desktop with working camera and mic, Mobile devices for using the buzzer only and a stable internet connection, Power Supply and Back up throughout the web round scheduled for the School.</li>
                            
                            <li> The School shall ensure that no unfair means are used during the State web round and only the two students mentioned above shall be participating in the Quiz as per the rules laid down for the State web rounds and shall ensure that proper internal invigilation is in place during the conduct of State web rounds.</li>
                            
                            <li> It is the collective responsibility of the school and candidates to ensure their presence in the quiz. Fit India Mission will not be responsible for the candidates’ absenteeism from the quiz during the scheduled time and date.</li>
                            </ol>
                        </div>-->
    
    
                </div>
                </div>
              </div>
              </div>
        </div>
    </section>


    {{-- Table --}}
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center mb-2 py-3" style="background-color: #afdcfe !important; color:black;">FIT India Quiz 2022 Preliminary Round Schedule of activities</h3>
               
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th scope="col">Activity</th>
                                <th scope="col">Date and Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>Display of Admit Cards</td>
                                <td>
                                    <div>
                                        Admit Cards will be displayed on 28.11.2022 at
                                       <a href="https://fitindia.nta.ac.in" target="_blank" class="ms-2" style=" color: blue !important;">https://fitindia.nta.ac.in</a>

                                    </div>
                                    <div class="mt-2">Method to download:</div>
                                    <ul>

                                        <li>Both students and schools can download admit card.</li>
                                        <li>For School to download: School to provide application ID and
                                            UDISE code to login </li>
                                    </ul>
                                    <div>For Student to download: </div>
                                    <ul>

                                        <li>Student to provide their mobile number and date of birth as
                                            login credentials as provided during the registration</li>

                                    </ul>
                                </td>

                            </tr>
                            <tr>

                                <td>Webinar-I</td>
                                <td>
                                    <div>28.11.2022 From 03:00 PM to 04:30 PM </div>
                                    <div>Link:
                                        <a href="https://teams.microsoft.com/l/meetupjoin/19%3ameeting_NmQxNzcxZGQtOWI4NS00YmYxLTkwYjQt
                                        MjA1ZTJjNzI4NzQ4%40thread.v2/0?context=%7B%22Tid%22%
                                        3A%223edc6466-c09c-4624-9d29-
                                        d93b6b8bedbc%22%2C%22Oid%22%3A%2276d03cf4-9cd0-
                                        46ec-ad04-
                                        25a468bcccf1%22%2C%22IsBroadcastMeeting%22%3Atrue%2
                                        C%22role%22%3A%22a%22%7D&btype=a&role=a" target="_blank" class="ms-2" style="color: blue !important; text-decoration:underline !important;" >Go to Link</a></div>
                                </td>

                            </tr>

                            <tr>

                                <td>Webinar-II</td>
                                <td>
                                    <div>01.12.2022 From 03:00 PM to 04:30 PM</div>
                                    <div>Link:
                                        <a href="https://teams.microsoft.com/l/meetupjoin/19%3ameeting_YjY1NTg1ZjgtM2Q4ZC00ZWI3LThmM2EtN
                                        mM4ZTM1YWQ4NWIz%40thread.v2/0?context=%7B%22Tid%2
                                        2%3A%223edc6466-c09c-4624-9d29-
                                        d93b6b8bedbc%22%2C%22Oid%22%3A%2276d03cf4-9cd0-
                                        46ec-ad04-
                                        25a468bcccf1%22%2C%22IsBroadcastMeeting%22%3Atrue%2
                                        C%22role%22%3A%22a%22%7D&btype=a&role=a" target="_blank" class="ms-2" style="color: blue !important; text-decoration:underline !important;">Go to Link</a>
</div>
                                </td>

                            </tr>
                            <tr>
                                <td>Mock Test </td>
                                <td>
                                    <p>From 3.12.2022 to 05.12.2022
                                    </p>
                                    <p>Timing 10:00 AM to 06:00 PM</p>
                                    <p>Candidates can take the mock test during the specified time on
                                        the dates mentioned above.</p>
                                        <p>It is mandatory to attend the mock test.</p>
                                        <p>They can take the mock test only once.</p>
                                        <p>Candidates are advised to download their Admit Card and
                                            understand how to take the mock test.</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Site from where the mobile app
                                    is to be downloaded</td>
                                    <td><a href="https://ntaseb-fit.azurewebsites.net/" style="color: blue !important">https://ntaseb-fit.azurewebsites.net/</a>
                                        <p>Candidates can start downloading the mobile app from
                                            30.11.2022 onwards.</p>
                                        </td>
                            </tr>
                            <tr>
                                <td>Exam Dates </td>
                                <td><p>Exam will be held on 08.12.2022 and 09.12.2022, in 4 sessions
                                    per day.</p>
                                <p>Candidates are required to download their Admit Card and
                                    check their respective exam date and session.</p></td>
                            </tr>

                            <tr>
                                <td>Others</td>
                                <td><p>Candidates are required to download their Admit Card and
                                    check their User ID and password.</p>
                                <p>User ID and password for mock test and Final Exam will be the
                                    same.</p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                <div class="cont_area cont_area_cont">
                    <h1>For Any Queries <span>Please Contact</span></h1>
                    <div class="d-flex justify-content-around mail_img align-items-center ">
                        <div>
                            <img src="resources/imgs/mail.png" class="fluid-img" />
                        </div>

                        <div>
                            <ul>
                                <!-- <li><span><i class="fa fa-phone" aria-hidden="true"></i></span> NTA Helpdesk :<span>011 4075 9000, 011 6922 7700</span></li> -->
                                <li><span><i class="fa fa-phone" aria-hidden="true"></i></span> NTA Helpline at
                                    <span>011-40759000, 011-6922 7700</span>
                                </li>
                                <li><span><i class="fa fa-phone" aria-hidden="true"></i></span> SAI Call Center Number
                                    <span>1800 202 5155</span>
                                </li>

                                <li><span><i class="fa fa-envelope-o" aria-hidden="true" style="font-size:17px;"></i></span>
                                    Write to NTA at <span> fitindia[at]nta[dot]ac[dot]in</span></li>
                                <li><span><i class="fa fa-clock-o" aria-hidden="true"></i></span> Timing: <span> All Days
                                        (9:00 - 5:30pm)</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.excel_state').select2();
        $(document).on('change','.excel_state',function(){
            $('.state_excel_download_btn').remove();
            if($(this).val() != ''){
             $('.state_excel_container').append(`<a class="btn btn-primary btn-sm d_button state_excel_download_btn"
                        href="resources/fi_quiz_state_wise_list/${$(this).val()}" target="_blank"> <i
                            class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp; Download</a>`);
            }
            var fewSeconds = 10;
$('.state_excel_download_btn').click(function(){
    var btn = $(this);
    btn.addClass('disabled');
    setTimeout(function(){
        btn.removeClass('disabled');
    }, fewSeconds*1000);
});
       
        });
    </script>
@endsection
