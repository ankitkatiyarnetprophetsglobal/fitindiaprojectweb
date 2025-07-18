@extends('layouts.app')
@section('title', 'School Certificate Request | Fit India')
@section('content')
<!--<link rel="stylesheet" id="dashicons-css" href="https://fontawesome.com/v4.7.0/icons/" type="text/css" media="all"> -->

<div class="banner_area">
    <img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
    @include('event.userheader')
    <div class="container">
        <div class="et_pb_row">
            <div class="row">
                @include('event.sidebar')
                <div class="col-sm-12 col-md-9 ">
                    <div class="description_box wrap event-form accordion py-4">
                        <h2 class="mb-0">Fit India School Certification</h2>
                        <!-- Flag Request Start -->
                        <div id="tab-1621" class="star-rating-content success mt-4 ">
                            <form name="flagrequest" method="post" action="https://fitindia.gov.in/flagstore" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="Wez77yEiAHFo3SK5K5UJjidUD6wNUNVF25HZka4T">
                                <div class="rating-heading">
                                    <h3>Request for Fit India School </h3> <span class="default-i  awarded "> <i class="fa fa-star-half-o" aria-hidden="true"> </i> Awarded </span>
                                </div>


                                <div class="inner">

                                    <div class="um-field">
                                        <h2 for="event_name"> </h2>
                                        <input type="hidden" name="questions" value="4">
                                        <input type="hidden" name="ratingreqid" value="1621">
                                        <input type="hidden" name="user_id" value="2197092">
                                    </div>




                                    <div class="um-field">
                                        <div class="um-field-label ques">
                                            <span class="star-ques-sr">1.</span>
                                            <label for="ques_name" class="star-questions ">Designated PE Teacher</label>

                                            <div class="sub_ques_row sub_ques-head">
                                                <div class="sub_ques_title sub_flex_first">Schools must have at least one designated teacher who is responsible for: </div>
                                                <div class="sub_ques_title sub_flex_first">Conducting physical activities and promoting an active and healthy lifestyle among students </div>
                                            </div>
                                            <!-- <div class="sub_ques_row sub_ques-head">
                                                <div class="sub_ques_title sub_flex_first">Conducting physical activities and promoting an active and healthy lifestyle among students </div>
                                            </div> -->
                                            <div class="sub_ques_row sub_ques-head flex-1 py-0">
                                                <div class="sub_ques_title sub_flex_first" style="width: 20%;"> No. of teachers </div>
                                                <div class="sub_ques_elem">
                                                    <input type="number" name="trainedteacherno" onkeyup="trainedteachernofn(this.value,this)" onclick="trainedteachernofn(this.value,this)" class="fit-pe-inputs" style="margin-top: 0 !important;" min="0" value="">
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="inner-align allwidth">
                                                <ol style="list-style: none; padding-left:0">
                                                    <li class="sub_ques_title list-btm-mrgn mb-2">
                                                        Documentation required – Teacher Certification: Name and details of the nominated teacher for PE.

                                                        (attach max 20 MB relevant doc/pdf)
                                                    </li>
                                                    <li>  <input type="file" name="motivatesdoc" class="mt-2"></li>
                                                </ol>
                                            </div>

                                            <div class="sub_ques_row sub_ques-head  playground-section" id="trainedteacherrow" style="display:none">







                                            </div>



                                        </div>

                                        <div style="clear:both"></div>

                                    </div>





                                    <div class="um-field">
                                        <div class="um-field-label ques">
                                            <span class="star-ques-sr">2.</span>
                                            <label for="ques_name" class="star-questions ">Accessible Playground or Play Area</label>
                                            <div class="sub_ques_row sub_ques-head">
                                                <div class="sub_ques_title sub_flex_first">Schools must have a safe, well-maintained playground or open space to conduct regular physical activities. </div>
                                            </div>
                                            <div class="sub_ques_row sub_ques-head">
                                                <div class="sub_ques_title sub_flex_first">This space should be actively used for student engagement and should meet safety and usability standards. </div>
                                            </div>

                                            <div class="sub_ques_row sub_ques-head">
                                                <div>Keep CTRL key press while selecting multiple sports </div><br>
                                                <div class="sub_ques_elem halfwidth">
                                                    <div>Outdoor Sports ( minimum 2 )</div>
                                                    <div class="sports-row">
                                                        <select name="outdoorfacility[]" multiple="" onclick="othersportspop(this,'outdoor-sprts')">
                                                            {
                                                            <option>Archery</option>
                                                            {
                                                            <option>Athletics</option>
                                                            {
                                                            <option>Badminton</option>
                                                            {
                                                            <option>Basketball</option>
                                                            {
                                                            <option>Canoeing</option>
                                                            {
                                                            <option>Cricket</option>
                                                            {
                                                            <option>Cycling</option>
                                                            {
                                                            <option>Football</option>
                                                            {
                                                            <option>Handball</option>
                                                            {
                                                            <option>Hockey</option>
                                                            {
                                                            <option>Judo</option>
                                                            {
                                                            <option>Kabaddi</option>
                                                            {
                                                            <option>Karate</option>
                                                            {
                                                            <option>Kayaking</option>
                                                            {
                                                            <option>Kho Kho</option>
                                                            {
                                                            <option>Lawn Tennis</option>
                                                            {
                                                            <option>Rowing</option>
                                                            {
                                                            <option>Sepaktakraw</option>
                                                            {
                                                            <option>Softball</option>
                                                            {
                                                            <option>Swimming</option>
                                                            {
                                                            <option>Taekwondo</option>
                                                            {
                                                            <option>Volleyball</option>
                                                            {
                                                            <option>Wushu</option>
                                                            <option>Any other sport including indigenous games</option>

                                                        </select>

                                                        <div id="outdoor-sprts" style="display:none">

                                                            <input type="text" name="outdoorextrafacility" placeholder="Any other outdoor sport" value="">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="sub_ques_elem halfwidth">
                                                    <br>
                                                    <div>Indoor Sports ( minimum 2 )</div><br>
                                                    <div class="sports-row">

                                                        <select name="indoorfacility[]" multiple="" onclick="othersportspop(this,'indoor-sprts')">
                                                            <option>Badminton</option>
                                                            <option>Basketball</option>
                                                            <option>Boxing</option>
                                                            <option>Fencing</option>
                                                            <option>Gymnastics</option>
                                                            <option>Judo</option>
                                                            <option>Kabaddi</option>
                                                            <option>Karate</option>
                                                            <option>Lawn Tennis</option>
                                                            <option>Shooting</option>
                                                            <option>Swimming</option>
                                                            <option>Table Tennis</option>
                                                            <option>Taekwondo</option>
                                                            <option>Volleyball</option>
                                                            <option>Carom</option>
                                                            <option>Chess</option>
                                                            <option>Weightlifting</option>
                                                            <option>Wrestling</option>
                                                            <option>Any other sport including indigenous games</option>
                                                        </select>

                                                        <div id="indoor-sprts" style="display:none">
                                                            <input type="text" name="indoorextrafacility" placeholder="Any other indoor sport" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clear"></div>
                                            </div>



                                        </div>

                                        <div style="clear:both"></div>

                                    </div>

                                    <div class="inner-align allwidth">
                                        <ol>
                                            <li class="sub_ques_title list-btm-mrgn">
                                                Documentation required – Must submit the approved town and country planning structured plan. (attach max 20 MB relevant doc/pdf)

                                                <input type="file" name="motivatesdoc">
                                            </li>
                                        </ol>
                                    </div>





                                    <div class="um-field">
                                        <div class="um-field-label ques check_div">
                                            <span class="star-ques-sr">3.</span>
                                            <div class="check_flex">
                                                <label for="ques_name" class="star-questions star-questions-cust">Active Participation</label>

                                            </div>
                                            <div class="sub_ques_row sub_ques-head">
                                                <div class="sub_ques_title sub_flex_first">Every student must engage in a minimum of 30 minutes of physical activity on each school day <br>
                                                    <div class="sub_ques_row sub_ques-head flex-1 ml-4">
                                                        <div class="sub_ques_title sub_flex_first"> No. of students </div>
                                                        <div class="sub_ques_elem">
                                                            <input type="number" name="trainedteacherno" onkeyup="trainedteachernofn(this.value,this)" onclick="trainedteachernofn(this.value,this)" class="fit-pe-inputs" min="0" value="">
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                    Activities can include:<br>
                                                    Sports (e.g., football, volleyball, basketball)<br>
                                                    Exercise routines (e.g., warm-ups, drills)<br>
                                                    Fun fitness activities (e.g., shuttle runs, obstacle courses, fitness games)<br>
                                                    The objective is to ensure that daily physical movement becomes an integral part of school culture.

                                                    <div class="inner-align allwidth">
                                                        <ol>
                                                            <li class="sub_ques_title list-btm-mrgn">
                                                                A. No. of students of spending at least 30 minutes/ day for physical activities in school
                                                                <br>
                                                                <input type="number" name="noteachersplaying" class="fit-pe-inputs field_w" min="0" value="">
                                                            </li>
                                                            <li class="sub_ques_title list-btm-mrgn">
                                                                Documentation required – Timetable or any other proof inclusive of playing duration needs to be
                                                                uploaded.

                                                                (attach max 20 MB relevant doc/pdf)
                                                                <input type="file" name="motivatesdoc">
                                                            </li>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>





                                        <div class="um-field">
                                            <div class="um-field-label ques">
                                                <span class="star-ques-sr">4.</span>
                                                <label for="ques_name" class="star-questions "> Sports Facilities</label>
                                            </div>
                                            <div class="sub_ques_row sub_ques-head">
                                                <div class="sub_ques_title sub_flex_first">The school must provide facilities for at least four sports, including:
                                                </div>
                                            </div>
                                            <div class="sub_ques_row sub_ques-head">
                                                <div class="sub_ques_title sub_flex_first">A minimum of two outdoor sports.
                                                </div>
                                            </div>
                                            <div class="sub_ques_row sub_ques-head">
                                                <div class="sub_ques_title sub_flex_first">These facilities should be functional and accessible for regular student use.
                                                </div>
                                            </div>

                                            <div class="inner-align allwidth">
                                                <ol>
                                                    <li class="sub_ques_title list-btm-mrgn">
                                                        Documentation required – 4-5 pictures must be uploaded with geo-tagging co-ordinates.. (attach max 20 MB relevant jpeg/jpg/png)

                                                        <input type="file" name="motivatesdoc">
                                                    </li>
                                                </ol>
                                            </div>

                                        </div>






                                        <div class="um-field">
                                            <div class="um-field-label ques">
                                                <span class="star-ques-sr">5.</span>
                                                <label for="ques_name" class="star-questions "> Participation in Fit India Activities</label>
                                            </div>
                                            <div class="sub_ques_row sub_ques-head">
                                                <div class="sub_ques_title sub_flex_first">The school must provide facilities for at least four sports, including:<br>
                                                    Schools must be committed to participating in Fit India Movement initiatives, conducted under the guidance of:<br>
                                                    SAI (Sports Authority of India) and <br>
                                                    MYAS (Ministry of Youth Affairs and Sports)<br>
                                                    This participation should be regular and aimed at reinforcing fitness habits among students and staff alike. <input type="checkbox">
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                            </form>




                            <div class="um-field">
                                <div class="um-field-area">
                                    <a href="https://fitindia.gov.in/wp-content/uploads/2019/11/FitIndia-Flag.zip" class="flag-dwn" download="">Download Fit India School Flag</a><a class="flag-dwn" href="download-certificate">Download Certificate</a>
                                    <div class="success-msg"> <i class="fa fa-star-o" aria-hidden="true"></i> Congratulations you have awarded Fit India School Flag </div>
                                </div>
                            </div>





                        </div>
                        <!-- Flag Request Close -->
                        <!-- Three Star Request Start -->
                        <div id="tab-1622" class="star-rating-content  current ">
                            <form name="threestarrequest" method="post" action="https://fitindia.gov.in/threestar" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="Wez77yEiAHFo3SK5K5UJjidUD6wNUNVF25HZka4T">
                                <div class="rating-heading">
                                    <h3>Request for 3 Star </h3> <span class="default-i "> <i class="fa fa-ban" aria-hidden="true"> </i> Not Applied </span>
                                </div>

                                <div class="inner">

                                    <div class="um-field">
                                        <h2 for="event_name"> </h2>
                                        <input type="hidden" name="questions" value="5">
                                        <input type="hidden" name="ratingreqid" value="1622">
                                        <input type="hidden" name="user_id" value="2197092">
                                    </div>



                                    <div class="um-field">
                                        <div class="um-field-label ques">
                                            <span class="star-ques-sr">1.</span>
                                            <label for="ques_name" class="star-questions ">Active Participation in Daily Physical Activity</label>
                                            <label for="ques_name" class="star-questions ">Schools must ensure that all students participate in daily physical activities as per the following durations:
                                            </label>


                                            <div class="sub_ques_row sub_ques-head sub_flex1 ml-3">
                                                <div class="sub_ques_title sub_flex_first2"> No. of students in school</div>
                                                <div class="sub_ques_elem">
                                                    <input type="number" name="totnoteachers" class="fit-pe-inputs" min="0" value="">
                                                </div>
                                                <div class="clear"></div>
                                            </div>

                                            <span class="star-ques-sr">.</span>
                                            <label for="ques_name" class="star-questions">Grades 1–5: Minimum 30 minutes</label>
                                            <span class="star-ques-sr">.</span>
                                            <label for="ques_name" class="star-questions ">Grades 6–12: Minimum 45 to 60 minutes</label>
                                            <div class="inner-align allwidth">
                                                <ol>
                                                    <li class="sub_ques_title list-btm-mrgn">
                                                        Activities should include sports, exercises, and fitness games conducted during school hours

                                                    </li>
                                            </div>
                                            <div class="inner-align allwidth">
                                                <ol>
                                                    <li class="sub_ques_title list-btm-mrgn">
                                                        A. No. of students of Grade 1-5 spending at least 30 minutes/ day for physical activities in school
                                                        <br>
                                                        <input type="number" name="noteachersplaying" class="fit-pe-inputs field_w" min="0" value="">
                                                    </li>
                                                    <li class="sub_ques_title list-btm-mrgn">
                                                        B. No. of students of Grade 6-12 spending at least 45-60 minutes/ day for physical activities in school
                                                        <input type="number" class="fit-pe-inputs field_w" min="0" name="encouragesdoc">

                                                    </li>
                                                    <li class="sub_ques_title list-btm-mrgn">
                                                        Documentation required – Timetable or any other proof inclusive of playing duration needs to be
                                                        uploaded.

                                                        (attach max 20 MB relevant doc/pdf)
                                                        <input type="file" name="motivatesdoc">
                                                    </li>
                                                </ol>
                                            </div>

                                            <div class="clear"></div>




                                        </div>
                                        <div style="clear:both"></div>
                                    </div>





                                    <div class="um-field">
                                        <div class="um-field-label ques">
                                            <span class="star-ques-sr">2.</span>
                                            <label for="ques_name" class="star-questions ">Designated PE Teacher</label>

                                            <div class="sub_ques_row sub_ques-head">
                                                <div class="sub_ques_title sub_flex_first">Schools must have at least one designated teacher who is responsible for: </div>
                                            </div>
                                            <div class="sub_ques_row sub_ques-head">
                                                <div class="sub_ques_title sub_flex_first">Conducting physical activities and promoting an active and healthy lifestyle among students </div>
                                            </div>
                                            <div class="sub_ques_row sub_ques-head flex-1 ml-4">
                                                <div class="sub_ques_title sub_flex_first"> No. of teachers </div>
                                                <div class="sub_ques_elem">
                                                    <input type="number" name="trainedteacherno" onkeyup="trainedteachernofn(this.value,this)" onclick="trainedteachernofn(this.value,this)" class="fit-pe-inputs" min="0" value="">
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="inner-align allwidth">
                                                <ol>
                                                    <li class="sub_ques_title list-btm-mrgn">
                                                        Documentation required – Teacher Certification: Name and details of the nominated teacher for PE.

                                                        (attach max 20 MB relevant doc/pdf)
                                                        <input type="file" name="motivatesdoc">
                                                    </li>
                                                </ol>
                                            </div>

                                            <div class="sub_ques_row sub_ques-head  playground-section" id="trainedteacherrow" style="display:none">







                                            </div>



                                        </div>

                                        <div style="clear:both"></div>

                                    </div>





                                    <div class="um-field">


                                        <div class="um-field">
                                            <div class="um-field-label ques">
                                                <span class="star-ques-sr">3.</span>
                                                <label for="ques_name" class="star-questions ">Celebration of Fit India School Week</label>

                                                <div class="sub_ques_row sub_ques-head">
                                                    <div class="sub_ques_title sub_flex_first">Schools must have celebrated the Fit India School Week as part of their annual activities. </div>
                                                </div>
                                                <div class="sub_ques_row sub_ques-head">
                                                    <div class="sub_ques_title sub_flex_first">Activities during the week should encourage mass participation and create awareness of fitness culture in schools. </div>
                                                </div>

                                                <div class="inner-align allwidth">
                                                    <ol>
                                                        <li class="sub_ques_title list-btm-mrgn">
                                                            Documentation required – Earlier records showcasing that the school has celebrated Fit India School
                                                            week.. (attach max 20 MB relevant doc/pdf)

                                                            <input type="file" name="motivatesdoc">
                                                        </li>
                                                    </ol>
                                                </div>

                                                <div class="sub_ques_row sub_ques-head  playground-section" id="trainedteacherrow" style="display:none">

                                                </div>

                                            </div>

                                            <div style="clear:both"></div>

                                        </div>

                                        <div style="clear:both"></div>

                                    </div>





                                    <div class="um-field">
                                        <div class="um-field-label ques">
                                            <span class="star-ques-sr">2
                                                .</span>
                                            <label for="ques_name" class="star-questions ">Accessible Playground or Play Area</label>
                                            <div class="sub_ques_row sub_ques-head">
                                                <div class="sub_ques_title sub_flex_first">Schools must have a safe, well-maintained playground or open space to conduct regular physical activities. </div>
                                            </div>
                                            <div class="sub_ques_row sub_ques-head">
                                                <div class="sub_ques_title sub_flex_first">This space should be actively used for student engagement and should meet safety and usability standards. </div>
                                            </div>

                                            <div class="sub_ques_row sub_ques-head">
                                                <div>Keep CTRL key press while selecting multiple sports </div><br>
                                                <div class="sub_ques_elem halfwidth">
                                                    <div>Outdoor Sports ( minimum 2 )</div>
                                                    <div class="sports-row">
                                                        <select name="outdoorfacility[]" multiple="" onclick="othersportspop(this,'outdoor-sprts')">
                                                            {
                                                            <option>Archery</option>
                                                            {
                                                            <option>Athletics</option>
                                                            {
                                                            <option>Badminton</option>
                                                            {
                                                            <option>Basketball</option>
                                                            {
                                                            <option>Canoeing</option>
                                                            {
                                                            <option>Cricket</option>
                                                            {
                                                            <option>Cycling</option>
                                                            {
                                                            <option>Football</option>
                                                            {
                                                            <option>Handball</option>
                                                            {
                                                            <option>Hockey</option>
                                                            {
                                                            <option>Judo</option>
                                                            {
                                                            <option>Kabaddi</option>
                                                            {
                                                            <option>Karate</option>
                                                            {
                                                            <option>Kayaking</option>
                                                            {
                                                            <option>Kho Kho</option>
                                                            {
                                                            <option>Lawn Tennis</option>
                                                            {
                                                            <option>Rowing</option>
                                                            {
                                                            <option>Sepaktakraw</option>
                                                            {
                                                            <option>Softball</option>
                                                            {
                                                            <option>Swimming</option>
                                                            {
                                                            <option>Taekwondo</option>
                                                            {
                                                            <option>Volleyball</option>
                                                            {
                                                            <option>Wushu</option>
                                                            <option>Any other sport including indigenous games</option>

                                                        </select>

                                                        <div id="outdoor-sprts" style="display:none">

                                                            <input type="text" name="outdoorextrafacility" placeholder="Any other outdoor sport" value="">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="sub_ques_elem halfwidth">
                                                    <br>
                                                    <div>Indoor Sports ( minimum 2 )</div><br>
                                                    <div class="sports-row">

                                                        <select name="indoorfacility[]" multiple="" onclick="othersportspop(this,'indoor-sprts')">
                                                            <option>Badminton</option>
                                                            <option>Basketball</option>
                                                            <option>Boxing</option>
                                                            <option>Fencing</option>
                                                            <option>Gymnastics</option>
                                                            <option>Judo</option>
                                                            <option>Kabaddi</option>
                                                            <option>Karate</option>
                                                            <option>Lawn Tennis</option>
                                                            <option>Shooting</option>
                                                            <option>Swimming</option>
                                                            <option>Table Tennis</option>
                                                            <option>Taekwondo</option>
                                                            <option>Volleyball</option>
                                                            <option>Carom</option>
                                                            <option>Chess</option>
                                                            <option>Weightlifting</option>
                                                            <option>Wrestling</option>
                                                            <option>Any other sport including indigenous games</option>
                                                        </select>

                                                        <div id="indoor-sprts" style="display:none">
                                                            <input type="text" name="indoorextrafacility" placeholder="Any other indoor sport" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clear"></div>
                                            </div>



                                        </div>

                                        <div style="clear:both"></div>

                                    </div>

                                    <div class="inner-align allwidth">
                                        <ol>
                                            <li class="sub_ques_title list-btm-mrgn">
                                                Documentation required – Must submit the approved town and country planning structured plan. (attach max 20 MB relevant doc/pdf)

                                                <input type="file" name="motivatesdoc">
                                            </li>
                                        </ol>
                                    </div>





                                    <div class="um-field">
                                        <div class="um-field-label ques">
                                            <span class="star-ques-sr">5.</span>
                                            <label for="ques_name" class="star-questions "> Sports Facilities</label>
                                        </div>
                                        <div class="sub_ques_row sub_ques-head">
                                            <div class="sub_ques_title sub_flex_first">The school must provide facilities for at least four sports, including:
                                            </div>
                                        </div>
                                        <div class="sub_ques_row sub_ques-head">
                                            <div class="sub_ques_title sub_flex_first">A minimum of two outdoor sports.
                                            </div>
                                        </div>
                                        <div class="sub_ques_row sub_ques-head">
                                            <div class="sub_ques_title sub_flex_first">These facilities should be functional and accessible for regular student use.
                                            </div>
                                        </div>

                                        <div class="inner-align allwidth">
                                            <ol>
                                                <li class="sub_ques_title list-btm-mrgn">
                                                    Documentation required – 4-5 pictures must be uploaded with geo-tagging co-ordinates.. (attach max 20 MB relevant jpeg/jpg/png)

                                                    <input type="file" name="motivatesdoc">
                                                </li>
                                            </ol>
                                        </div>

                                    </div>





                                    <div class="um-field">
                                        <div class="um-field-area">
                                            <input type="submit" name="star-rating" value="Submit">
                                        </div>
                                    </div>

                                </div>
                            </form>






                        </div>
                        <!-- Three Star Close -->
                        <!-- Five Star Request Start -->
                        <div id="tab-1623" class="star-rating-content     ">
                            <form name="threestarrequest" method="post" action="https://fitindia.gov.in/fivestar" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="Wez77yEiAHFo3SK5K5UJjidUD6wNUNVF25HZka4T">
                                <div class="rating-heading">
                                    <h3>Request for 5 Star </h3>
                                    <span class="default-i "> <i class="fa fa-ban" aria-hidden="true"> </i> Not Applied </span>
                                </div>

                                <div class="inner">

                                    <div class="um-field">
                                        <h2 for="event_name"> </h2>
                                        <input type="hidden" name="questions" value="6">
                                        <input type="hidden" name="ratingreqid" value="1623">
                                        <input type="hidden" name="user_id" value="2197092">
                                    </div>



                                    <div class="um-field">
                                        <div class="um-field-label ques">
                                            <span class="star-ques-sr">1.</span>
                                            <label for="ques_name" class="star-questions ">Active Participation in Physical Activities</label>
                                            <label for="ques_name" class="star-questions ">Schools must ensure that all students participate in daily physical activities as per the following durations:
                                            </label>


                                            <div class="sub_ques_row sub_ques-head sub_flex1 ml-3">
                                                <div class="sub_ques_title sub_flex_first2"> No. of students in school</div>
                                                <div class="sub_ques_elem">
                                                    <input type="number" name="totnoteachers" class="fit-pe-inputs" min="0" value="">
                                                </div>
                                                <div class="clear"></div>
                                            </div>

                                            <span class="star-ques-sr">.</span>
                                            <label for="ques_name" class="star-questions">Grades 1–5: Minimum 30 minutes</label>
                                            <span class="star-ques-sr">.</span>
                                            <label for="ques_name" class="star-questions ">Grades 6–12: Minimum 45 to 60 minutes</label>
                                            <div class="inner-align allwidth">
                                                <ol>
                                                    <li class="sub_ques_title list-btm-mrgn">
                                                        Activities should include sports, exercises, and fitness games conducted during school hours

                                                    </li>
                                            </div>
                                            <div class="inner-align allwidth">
                                                <ol>
                                                    <li class="sub_ques_title list-btm-mrgn">
                                                        A. No. of students of Grade 1-5 spending at least 30 minutes/ day for physical activities in school
                                                        <br>
                                                        <input type="number" name="noteachersplaying" class="fit-pe-inputs field_w" min="0" value="">
                                                    </li>
                                                    <li class="sub_ques_title list-btm-mrgn">
                                                        B. No. of students of Grade 6-12 spending at least 45-60 minutes/ day for physical activities in school
                                                        <input type="number" class="fit-pe-inputs field_w" min="0" name="encouragesdoc">

                                                    </li>
                                                    <li class="sub_ques_title list-btm-mrgn">
                                                        Documentation required – Timetable or any other proof inclusive of playing duration needs to be
                                                        uploaded.

                                                        (attach max 20 MB relevant doc/pdf)
                                                        <input type="file" name="motivatesdoc">
                                                    </li>
                                                </ol>
                                            </div>

                                            <div class="clear"></div>




                                        </div>
                                        <div style="clear:both"></div>

                                    </div>





                                    <div class="um-field">
                                        <div class="um-field-label ques">
                                            <span class="star-ques-sr">2.</span>
                                            <label for="ques_name" class="star-questions  ">Sports Coaches & Student Strength
                                            </label>


                                            <div class="fitIndia-radio-col fitIndia-checkbox-col fit-no-width pecheck-box">
                                                <label><input name="alltrainedpe" type="checkbox" value="yes">
                                                    <div class="back-end fitindia-r box fit-checkbox"><span></span></div>
                                                </label>
                                            </div>

                                            <div class="sub_ques_row sub_ques-head">
                                                <p class="mb-0" style="font-weight:400;">(a) The school must have at least two sports coaches (can also be PE teachers)
                                                </p>

                                                <p style="font-weight:400;">(b) The school must have a minimum of 1,000 enrolled students </p>
                                                <p style="font-weight:400;">Documentation required – Declaration of no. of students to be provided.</p>

                                                <div class="sub_ques_row sub_ques-head flex-1">
                                                    <div class="sub_ques_title"> No. of schools </div>
                                                    <div class="sub_ques_elem">
                                                        <input type="number" name="sportscoachno" onkeyup="sportscoachnos(this.value,this)" onclick="sportscoachnos(this.value,this)" class="fit-pe-inputs" min="0" value="">
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>




                                            </div>

                                            <div style="clear:both"></div>

                                        </div>




                                        <div class="um-field">
                                            <div class="um-field-label ques">
                                                <span class="star-ques-sr">3.</span>
                                                <label for="ques_name" class="star-questions ">Accessible Playground or Play Area</label>
                                                <div class="sub_ques_row sub_ques-head">
                                                    <div class="sub_ques_title sub_flex_first">Schools must have a safe, well-maintained playground or open space to conduct regular physical activities. </div>
                                                </div>
                                                <div class="sub_ques_row sub_ques-head">
                                                    <div class="sub_ques_title sub_flex_first">This space should be actively used for student engagement and should meet safety and usability standards. </div>
                                                </div>

                                                <div class="sub_ques_row sub_ques-head">
                                                    <div>Keep CTRL key press while selecting multiple sports </div><br>
                                                    <div class="sub_ques_elem halfwidth">
                                                        <div>Outdoor Sports ( minimum 2 )</div>
                                                        <div class="sports-row">
                                                            <select name="outdoorfacility[]" multiple="" onclick="othersportspop(this,'outdoor-sprts')">
                                                                {
                                                                <option>Archery</option>
                                                                {
                                                                <option>Athletics</option>
                                                                {
                                                                <option>Badminton</option>
                                                                {
                                                                <option>Basketball</option>
                                                                {
                                                                <option>Canoeing</option>
                                                                {
                                                                <option>Cricket</option>
                                                                {
                                                                <option>Cycling</option>
                                                                {
                                                                <option>Football</option>
                                                                {
                                                                <option>Handball</option>
                                                                {
                                                                <option>Hockey</option>
                                                                {
                                                                <option>Judo</option>
                                                                {
                                                                <option>Kabaddi</option>
                                                                {
                                                                <option>Karate</option>
                                                                {
                                                                <option>Kayaking</option>
                                                                {
                                                                <option>Kho Kho</option>
                                                                {
                                                                <option>Lawn Tennis</option>
                                                                {
                                                                <option>Rowing</option>
                                                                {
                                                                <option>Sepaktakraw</option>
                                                                {
                                                                <option>Softball</option>
                                                                {
                                                                <option>Swimming</option>
                                                                {
                                                                <option>Taekwondo</option>
                                                                {
                                                                <option>Volleyball</option>
                                                                {
                                                                <option>Wushu</option>
                                                                <option>Any other sport including indigenous games</option>

                                                            </select>

                                                            <div id="outdoor-sprts" style="display:none">

                                                                <input type="text" name="outdoorextrafacility" placeholder="Any other outdoor sport" value="">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="sub_ques_elem halfwidth">
                                                        <br>
                                                        <div>Indoor Sports ( minimum 2 )</div><br>
                                                        <div class="sports-row">

                                                            <select name="indoorfacility[]" multiple="" onclick="othersportspop(this,'indoor-sprts')">
                                                                <option>Badminton</option>
                                                                <option>Basketball</option>
                                                                <option>Boxing</option>
                                                                <option>Fencing</option>
                                                                <option>Gymnastics</option>
                                                                <option>Judo</option>
                                                                <option>Kabaddi</option>
                                                                <option>Karate</option>
                                                                <option>Lawn Tennis</option>
                                                                <option>Shooting</option>
                                                                <option>Swimming</option>
                                                                <option>Table Tennis</option>
                                                                <option>Taekwondo</option>
                                                                <option>Volleyball</option>
                                                                <option>Carom</option>
                                                                <option>Chess</option>
                                                                <option>Weightlifting</option>
                                                                <option>Wrestling</option>
                                                                <option>Any other sport including indigenous games</option>
                                                            </select>

                                                            <div id="indoor-sprts" style="display:none">
                                                                <input type="text" name="indoorextrafacility" placeholder="Any other indoor sport" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>



                                            </div>

                                            <div style="clear:both"></div>

                                        </div>





                                        <div class="um-field">
                                            <div class="um-field-label ques">
                                                <span class="star-ques-sr">4.</span>
                                                <label for="ques_name" class="star-questions  ">PE Curriculum Aligned with NEP 2.0</label>
                                            </div>

                                            <div class="sub_ques_row sub_ques-head">
                                                <div class="sub_ques_title sub_flex_first">Schools must follow a structured physical education curriculum based on the guidelines in NEP 2.0. </div>
                                            </div>
                                            <div class="sub_ques_row sub_ques-head">
                                                <div class="sub_ques_title sub_flex_first">If not already aligned, schools should plan and commit to implementing it. </div>
                                            </div>
                                            <div class="sub_ques_row sub_ques-head">
                                                <div class="sub_ques_title sub_flex_first">Should be following curriculum mentioned in the NEP 2.0 or should start
                                                    following <input type="checkbox">
                                                </div>
                                            </div>
                                        </div>



                                    </div>





                                    <div class="um-field">
                                        <div class="um-field-label ques">
                                            <span class="star-ques-sr">5.</span>
                                            <label for="ques_name" class="star-questions  ">Fitness Assessment for All Students</label>
                                        </div>
                                        <div class="sub_ques_row sub_ques-head">
                                            <div class="sub_ques_title sub_flex_first">The school must conduct annual fitness assessments of all students using:
                                            </div>
                                        </div>
                                        <div class="sub_ques_row sub_ques-head">
                                            <div class="sub_ques_title sub_flex_first">Fit India Movement App (FIMA)

                                            </div>
                                        </div>
                                        <div class="sub_ques_row sub_ques-head">
                                            <div class="sub_ques_title sub_flex_first">Or any other approved assessment method following FI Assessment parameters


                                            </div>
                                        </div>
                                        <div class="inner-align allwidth">
                                            <ol>
                                                <li class="sub_ques_title list-btm-mrgn">
                                                    Documentation required – Undertaking may be provided of when done in the form of photos/videos on
                                                    prescribed platform – web portal/ Telegram, etc.
                                                    <input type="file" name="motivatesdoc">
                                                </li>
                                            </ol>
                                        </div>

                                    </div>

                                    <div class="um-field">
                                        <div class="um-field-label ques">
                                            <span class="star-ques-sr">6.</span>
                                            <label for="ques_name" class="star-questions  ">Healthy Eating Awareness</label>


                                        </div>
                                        <div class="sub_ques_row sub_ques-head">
                                            <div class="sub_ques_title sub_flex_first">Schools should actively encourage healthy eating habits among students by offering nutritious options in their
                                                canteens and promoting awareness of balanced diets. <input type="checkbox">
                                            </div>
                                        </div>

                                    </div>







                                </div>
                            </form>









                        </div>

                    </div>
                </div>
            </div>
            <div>
            </div>
        
    </div>
        <style>
            .star-rating-content.current {
                border: 2px solid #ccc;
                background-color: rgb(255 255 255);
            }

            .star-rating-content {
                margin-top: 30px;
                border: 1px solid #ccc;
                padding: 20px 30px 30px 30px;
                border-radius: 10px;
                position: relative;
            }

            /* .check_flex{display:flex;} */


            .rating-heading span.default-i {
                right: -1px;
                top: -1px;
            }

            .rating-heading span.default-i,
            .star-rating-content.success .rating-heading span.sucess-i,
            .star-rating-content.current .rating-heading span.apply-i,
            .star-rating-content.current .rating-heading span.info-i,
            .star-rating-content.rejected .rating-heading span.reject-i {
                position: absolute;
                padding: 8px 10px 8px 10px;
                border-radius: 0 10px 0 10px;
                font-style: normal;
            }

            span.default-i {
                color: #bbb !important;
                border: 1px solid #ccc;
            }

            .rating-heading span.default-i,
            .star-rating-content.success .rating-heading span.sucess-i,
            .star-rating-content.current .rating-heading span.apply-i,
            .star-rating-content.current .rating-heading span.info-i,
            .star-rating-content.rejected .rating-heading span.reject-i {
                position: absolute;
                padding: 8px 10px 8px 10px;
                border-radius: 0 10px 0 10px;
                font-style: normal;
            }

            .star-rating-content .rating-heading span.default-i:before,
            .star-rating-content.success .rating-heading span.sucess-i:before,
            .star-rating-content .rating-heading span.apply-i:before,
            .star-rating-content .rating-heading span.info-i:before,
            .star-rating-content.rejected .rating-heading span.reject-i:before {
                font-size: 18px;
                margin-right: 4px;
                position: absolute;
                top: 10px;
                left: 12px;
            }

            .star-rating-content.current .rating-heading span.default-i,
            .star-rating-content.current .rating-heading span.apply-i,
            .star-rating-content.success .rating-heading span.sucess-i,
            .star-rating-content.current .rating-heading span.info-i,
            .star-rating-content.rejected .rating-heading span.reject-i {
                right: -2px;
                top: -2px;
            }

            .star-rating-content.current .rating-heading span.default-i,
            .star-rating-content.current .rating-heading span.apply-i,
            .star-rating-content.current .rating-heading span.info-i {
                border: 2px solid #a1d3fa;
                color: #2196f3 !important;
            }


            .star-rating-content.success .rating-heading span.sucess-i,
            .star-rating-content.current .rating-heading span.apply-i,
            .star-rating-content.current .rating-heading span.info-i,
            .star-rating-content.rejected .rating-heading span.reject-i {
                position: absolute;
                padding: 8px 10px 8px 10px;
                border-radius: 0 10px 0 10px;
                font-style: normal;
            }

            .rating-heading span.default-i,
            .star-rating-content.success .rating-heading span.sucess-i,
            .star-rating-content.current .rating-heading span.apply-i,
            .star-rating-content.current .rating-heading span.info-i,
            .star-rating-content.rejected .rating-heading span.reject-i {
                position: absolute;
                padding: 8px 10px 8px 10px;
                border-radius: 0 10px 0 10px;
                font-style: normal;
            }

            .pecheck-box {
                position: absolute;
                top: 8px;
                right: 0px;
            }

            .trainedpe {
                margin-top: 10px
            }

            .fivstarattachdoc {
                margin-left: 20px;
                margin-bottom: 20px;
            }

            .fivstarattachdoc input[type=file] {
                border: none;
            }

            .extrafld {
                margin: 10px;
                display: none;
            }

            .inr-ans {
                margin-left: 20px;
                font-weight: 600;
            }

            /* .inner-align{ margin-left: 20px; } */
            .list-btm-mrgn {
                margin-bottom: 25px;
            }

            .playground-img a img {
                width: 100px;
                height: 100px;
                text-align: left;
            }

            #othersportsdiv {
                display: none;
            }

            .allwidth {
                width: 100% !important;
                margin-top: 15px;
            }

            span.cur-status {
                float: right;
                color: #ff8b0c;
                background: #fff;
                display: inline-block;
                padding: 5px 10px;
                margin-top: -5px;
                font-weight: 700;
                font-style: italic;
                margin-right: -5px;
            }

            .cur-ans {
                float: right;
                display: inline-block;
                padding: 5px 10px;
                margin-top: -5px;
                margin-right: -5px;
            }

            .sub_ques_elem {
                width: 100%;
            }

            .peteachernames-col {
                width: 49%;
                float: left;
                margin-right: 2%;
                margin-bottom: 12px;
                position: relative;
            }

            .peteachernames-col:nth-child(2n+2) {
                margin-right: 0;
            }

            .peteachernames-col span {
                position: absolute;
                top: 9px;
                left: 7px;
                color: #888;
            }

            .peteachernames-col input.peteachernames {
                padding-left: 25px !important;
            }

            .fit-pe-inputs {
                width: 100%;
                -moz-border-radius: 2px;
                -webkit-border-radius: 2px;
                border-radius: 2px;
                outline: none !important;
                cursor: text !important;
                font-size: 15px !important;
                height: 35px !important;
                box-sizing: border-box !important;
                box-shadow: none !important;
                margin: 0 !important;
                position: static;
                outline: none !important;
                padding: 8px 10px !important;
            }

            .sub_ques_elem input[type="number"].fit-pe-inputs {
                width: 100px;
            }

            .event-form .star-rating-content .ques {
                position: relative;
                font-weight: 600;
            }

            .sub_ques_title {
                padding: 0px 0px 2px;
                font-weight: 500;
            }

            .playground-row {
                width: 100%
            }

            .playgroundno,
            .playgroundshape,
            .playgroundarea,
            .playgroundlside,
            .schooldistance,
            .teachername,
            .schoolfitnessid,
            .noofstudents,
            .noofassessments,
            .facility,
            .opento {
                display: inline-block;

            }

            .playgroundno {
                width: 20px;
            }

            /* .playgroundarea, .playgroundlside, .schooldistance{ width:88px; margin-left: 12px; margin-bottom: 0;padding:} */

            /* .sub_ques-head .sub_ques_title, .sub_ques-head .sub_ques_elem{
                float:left;
                width:auto;
            } */
            /* .sub_ques-head .sub_ques_title{ width:30%; margin-right:2%; } */
            /* .sub_ques-head .sub_ques_elem{ width:68%; } */


            /* .sub_ques_row.pe-ques-detail .sub_ques_title{width:30%; margin-right:2%; float:left; padding: 0px;} */
            /* .sub_ques_row.pe-ques-detail .sub_ques_elem { width:68%; float:left} */
            .fullwidth {
                width: 100% !important;
            }

            .sub_ques_row.pe-ques-detail .peteachernames-col {
                width: 100%;
                float: left;
                margin-right: 0px;
                margin-bottom: 12px;
                position: relative;
            }

            .sub_ques_row.pe-ques-detail {
                margin: 15px 15px 0px;
            }

            .sub_ques_row.sub_ques-head.sub_ques-head-padding {
                padding-top: 20px;
            }

            .event-form .star-rating-content .ques label {
                font-weight: bold;
                display: inline-table;
            }




            .fitIndia-radio-col input[type="radio"] {
                display: none;
            }

            .fitIndia-radio-col input[type="radio"]:checked+.box {
                background-color: #2196f3;
                border: 1px solid #2196f3;
            }

            .fitIndia-radio-col input[type="radio"]:checked+.box span {
                color: white;
                transform: translateY(-6px);
            }

            .fitIndia-radio-col input[type="radio"]:checked+.box span:before {
                transform: translateY(0px);
                opacity: 1;
            }

            .fitIndia-radio-col .fitindia-r.box {
                width: 35px;
                height: 25px;
                margin-right: 5px;
                border: 1px solid #a1d3fa;
                transition: all 250ms ease;
                will-change: transition;
                display: inline-block;
                text-align: center;
                cursor: pointer;
                position: relative;
                font-family: "Dax", sans-serif;
                font-weight: 900;
            }

            .fitIndia-radio-col .fitindia-r.box:active {
                transform: translateY(10px);
            }

            .fitIndia-radio-col .box span {
                position: absolute;
                transform: translate(0, 0px);
                left: 0;
                right: 0;
                transition: all 300ms ease;
                font-size: 20px;
                user-select: none;
                color: #007e90;
            }

            .fitIndia-radio-col .fitindia-r.box span:before {
                font-size: 1.2em;
                font-family: FontAwesome;
                display: block;
                transform: translateY(-10px);
                opacity: 0;
                transition: all 300ms ease-in-out;
                font-weight: normal;
                color: white;
            }



            .fitIndia-radio-col .front-end.box.fit-radio1 {
                height: 25px;
                width: 35px;
                margin-right: 8px;
            }

            .fitIndia-radio-col .back-end.box.fit-radio2 {
                border-radius: 50%;
                height: 25px;
                width: 40px;
            }

            .fitIndia-radio-col .back-end.box.fit-radio3 {
                margin-left: 15px;
                width: 35px;
                height: 24px;
                margin: 0 0;
                transform: perspective(2px) rotateX(0deg) rotateY(-1deg);
            }

            .fitIndia-radio-col label {
                width: auto !important;
                display: inline;
            }



            .fitIndia-radio-col input[type="checkbox"] {
                display: none;
            }

            .fitIndia-radio-col input[type="checkbox"]:checked+.box {
                background-color: #2196f3;
                border: 1px solid #2196f3;
            }

            .fitIndia-radio-col input[type="checkbox"]:checked+.box span {
                color: white;
                transform: translateY(-2px);
            }

            .fitIndia-radio-col input[type="checkbox"]:checked+.box span:before {
                transform: translateY(0px);
                opacity: 1;
            }



            .fitIndia-radio-col .fit-checkbox.box {
                width: 20px;
                height: 20px;
            }

            .fitIndia-radio-col .fit-checkbox.box span {
                font-size: 16px;
            }

            .fitIndia-radio-col.fitIndia-checkbox-col {
                display: inline-flex;
                flex-wrap: wrap;
                margin-right: 10px;
                width: 130px;
                font-weight: 500;
            }

            span.checkbox-span {
                margin-left: 5px;
                display: inline-block;
            }

            .event-form .um-field {
                padding-top: 20px;
            }

            .fitIndia-radio-col.fitIndia-checkbox-col label+span {
                position: relative !important;
            }


            .playground-row.playground-heading .playgroundshape {
                width: 140px;
            }

            .playground-row.playground-heading .teachername {
                width: 48%;
            }

            .playground-row.playground-heading span {
                font-weight: 400;
            }

            .playground-section.sub_ques-head .sub_ques_title {
                width: 20%;
            }

            .playground-section.sub_ques-head .sub_ques_elem {
                width: 78%;
            }

            .playground-section.sub_ques-head.play-col .sub_ques_title {
                width: 30%;
            }

            .playground-section.sub_ques-head.play-col .sub_ques_elem {
                width: 68%;
            }

            .playground-row.playground-heading .playgroundarea,
            .playground-row.playground-heading .playgroundlside,
            .playground-row.playground-heading .schooldistance {
                width: 90px !important;
                position: relative;
                left: 10px
            }

            .playground-row.playground-heading .schooldistance {
                width: 150px !important;
            }

            .playground-row.playground-heading span {
                font-size: 12px;
            }

            span.star-ques-sr {
                position: absolute;
                top: 10px;
                left: 15px;
            }

            .event-form .star-rating-content .ques label.star-questions {
                font-weight: bold;
                background: rgb(247 247 247);
                padding: 10px 15px 10px 30px;
                width: 100%;
                letter-spacing: .50px;
                /* border-bottom: 2px solid #a1d3fa; */
                border-radius: 5px;
            }

            .event-form .star-rating-content .ques label.star-questions-cust {
                padding: 10px 50px 10px 30px;
            }

            .phy-activity {
                display: flex;
                margin-bottom: 15px;
                align-items: left;
            }

            .phy-activity span {
                width: 400px;
                font-weight: normal;
                margin-right: 20px;

            }

            .phy-activity select {
                cursor: pointer;
            }

            .fitIndia-radio-col.fitIndia-checkbox-col.fit-no-width {
                width: auto !important;
            }

            .fitIndia-radio-col.fitIndia-checkbox-col.check-box-position {
                position: absolute;
                top: 10px;
                right: 0px;
            }

            .declare-col {
                display: flex;
            }

            .declare-col span {
                margin-top: -4px;
            }

            .check-box-position.fitIndia-radio-col .fitindia-r.box {
                border-color: #000;
                margin-top: 5px;
            }

            .declare-col .fitIndia-radio-col input[type="checkbox"]:checked+.box span {
                color: white;
                transform: translateY(2px);
            }

            .halfwidth {
                width: 50%;
            }

            .sports-row select {
                height: 150px !important;
            }

            .achievements textarea {
                height: 150px;
                width: 100%
            }

            .playground-row.playground-heading .schoolfitnessid {
                width: 35% !important;
                margin-right: 10px;
            }

            .playground-row.playground-heading .facility {
                width: 48% !important;
                margin: 0 10px;
            }

            .playground-row.playground-heading .opento {
                width: 48% !important;
                margin-right: 0 10px;
            }

            .playground-row.playground-heading .noofstudents {
                width: 25% !important;
                margin-right: 10px;
            }

            .playground-row.playground-heading .noofassessments {
                width: 25% !important;
            }

            label {
                display: inline;
                margin-bottom: 0rem;
            }

            .clear {
                clear: both;
            }

            .playground-row.playground-heading .teachername {
                width: 46%;
            }

            .school-ratings-sidebar .event-form .star-rating-content input[type=submit] {
                background-color: #2196f3;
                box-shadow: 0 5px 10px rgba(33, 150, 243, 0.3);
            }

            .star-rating-content .rating-heading span.default-i:before,
            .star-rating-content.success .rating-heading span.sucess-i:before,
            .star-rating-content .rating-heading span.apply-i:before,
            .star-rating-content .rating-heading span.info-i:before,
            .star-rating-content.rejected .rating-heading span.reject-i:before {
                font-size: 18px;
                margin-right: 4px;
                position: absolute;
                top: 10px;
                left: 12px;
            }

            .hidediv {
                display: none !important;
            }

            .alert-danger {
                color: #a94442;
                background-color: #f2dede;
                border-color: #ebccd1;
                font-weight: 200;
                padding: .35rem .55rem;
                font-size: .78rem;
            }

            .event-form input[type=submit] {
                background-color: #2196f3;
                box-shadow: 0 5px 10px rgb(33 150 243 / 30%);
            }

            .flag-dwn {
                background-color: #4caf50;
                box-shadow: 0 5px 10px rgb(76 175 80 / 30%);
                padding: 10px 20px;
                color: #fff;
                font-size: 14px;
                font-weight: 400;
                border-radius: 100px;
                border: 0px;
                text-transform: uppercase;
                cursor: pointer;
                margin-top: 10px;
                display: table;
                margin-bottom: 10px;
            }

            .success-msg {
                color: #4caf50;
            }

            .star-rating-content.success {
                border: 2px solid #ccc;
                background-color: rgba(76, 175, 80, 0.07);
            }

            .star-rating-content.success .rating-heading span.awarded {
                border-left: 2px solid #ccc;
                border-bottom: 2px solid #ccc;
                color: #4caf50 !important;
            }

            .fitIndia-radio-col input[type="checkbox"]:checked+.box span {
                color: white;
                transform: translateY(-2px);
                font-size: 12px;
            }

            .fitIndia-radio-col .back-end span:before {
                content: '\2714';
            }

            .star-rating-content.applied {
                border: 2px solid rgba(33, 150, 243, 0.4);
                background-color: rgba(33, 150, 243, 0.04);
            }

            span.applied {
                border: 2px solid #a1d3fa;
                color: #2196f3 !important;
            }

            .info-msg {
                color: #2196f3;
                margin-top: 10px;
            }

            .sub_flex {
                display: -webkit-box;
                /* OLD - iOS 6-, Safari 3.1-6 */
                display: -moz-box;
                /* OLD - Firefox 19- (buggy but mostly works) */
                display: -ms-flexbox;
                /* TWEENER - IE 10 */
                display: -webkit-flex;
                /* NEW - Chrome */
                display: flex;
                flex-wrap: wrap;
                justify-content: flex-start;

            }

            .flex-1 {
                display: -webkit-box;
                /* OLD - iOS 6-, Safari 3.1-6 */
                display: -moz-box;
                /* OLD - Firefox 19- (buggy but mostly works) */
                display: -ms-flexbox;
                /* TWEENER - IE 10 */
                display: -webkit-flex;
                /* NEW - Chrome */
                display: flex;
            }

            .flex-1 div:first-child {
                margin-right: 15px;
                width: 30%;
            }

            .sub_flex1 {
                display: -webkit-box;
                /* OLD - iOS 6-, Safari 3.1-6 */
                display: -moz-box;
                /* OLD - Firefox 19- (buggy but mostly works) */
                display: -ms-flexbox;
                /* TWEENER - IE 10 */
                display: -webkit-flex;
                /* NEW - Chrome */
                display: flex;

                justify-content: flex-start;
            }

            .sub_flex1 .sub_flex_first2 {
                width: 42%;
                padding-top: 4px;
            }

            .sub_flex1 .sub_flex_first {
                width: 15%;
            }

            .sub_flex div:first-child {
                width: 40%;
            }

            .sub_flex div:last-child {
                width: 60%;
            }

            .sub_ques_elem ul {
                list-style: none;
                padding: 0;
            }

            .sub_ques_elem ul li:first-child {
                margin: 0;
            }

            .sub_ques_elem ul li {
                display: inline-block;
                margin: 5px;
                padding: 5px 10px;
                font-weight: 300;
                background: #eee;
                border-radius: 100px;
            }

            .check_div.check-box-position {
                position: absolute;
                top: 30px;
                left: 0px;
                padding-left: 60px;
            }

            .um-field-area a:hover {
                color: #fff;
            }

            .um-field-area a {
                display: inline-block;
                margin-right: 15px;
            }

            .sub_ques-head {
                margin-left: 0;
                align-items: center;
            }

            .playground-heading {
                margin-top: 7px;
                margin-bottom: 7px;
            }

            /* .fitIndia-checkbox-col{margin:5px 0;} */
            .playgroundno {
                top: -8px;
                width: 20px;
                position: relative;
            }

            .top_head {
                background: #eee;
                background: #eee;
                padding: 5px 10px;
            }

            .facility {
                width: 100%;
                margin-bottom: 10px;
            }

            .opento {
                width: 100%;
                margin-bottom: 10px;
            }

            .border_btootm {
                margin-top: 15px;
                border-bottom: 1px solid #a29e9e;
            }

            .border_btootm img {
                margin-top: 15px;
            }

            /* .check_div>label{padding-left:50px!important;} */
            /* .check_div_inner{
    position: absolute;
    top: 9px!important;
    left: 25px;
} */
            .sports-row {
                margin-top: 15px;
            }

            .field_w {
                width: 150px;
            }

            @media (max-width: 991px) {

                .container,
                .container-lg,
                .container-md,
                .container-sm {
                    max-width: 960px;
                }
            }

            @media (max-width: 767px) {

                .star-rating-content {
                    padding: 10px 10px 10px 10px;
                }

                .event-form .um-field {
                    padding-top: 0;
                }

                .sub_flex div:last-child {
                    width: auto;
                    margin-right: 10px;

                }

                .sub_flex div:first-child {
                    width: auto;
                    margin-right: 15px;
                }

                .sub_flex {

                    align-items: center;
                }

                .sub_ques_elem ul {
                    margin-bottom: 0;
                }

                .playground-section.sub_ques-head.play-col .sub_ques_title {
                    width: auto;
                }

                .playground-section.sub_ques-head .sub_ques_title {
                    width: auto;
                }

                .playground-section.sub_ques-head.play-col .sub_ques_elem {
                    width: auto;
                }

                .halfwidth {
                    width: 100%;
                }

                .sports-row {
                    margin-top: 15px;
                }

                .mobile_flex_3 {
                    display: flex;
                }

                .sp_id {

                    padding: 0 0;
                    width: 100%;

                    margin-top: 10px;
                }

                .sp_id2 {
                    height: 20px;
                }

                .input_block {
                    display: block !important;
                }


                .fitIndia-radio-col.fitIndia-checkbox-col {
                    flex-wrap: nowrap;
                }

                .flag-dwn {

                    width: 100%;
                    text-align: center;
                }

                #playgroundrow {
                    flex-direction: column;
                }

                .phy-activity {
                    display: flex;
                    flex-direction: column;
                    align-items: left;
                    text-align: left;
                }



                .phy-activity span {
                    width: auto;
                    ;
                    text-align: left !important;
                }



            }

            @media (max-width: 500px) {
                .sub_flex1 {
                    display: block;
                }

                .sub_flex1 .sub_flex_first {
                    width: 100%;
                }

                .ml-4 {
                    margin-left: 0 !important;
                }

                .sub_ques_elem input[type="number"].fit-pe-inputs {
                    width: 100%;
                }

                dl,
                ol,
                ul {
                    padding: 10px;
                }

                .field_w {
                    width: 100%;
                }

                .um-field-area a {
                    text-align: center;
                    margin-right: 0;
                }

                .flag-dwn {
                    width: 100%;
                }

                .flex-1 {
                    display: block;
                }

                .flex-1 div:first-child {
                    width: 100%;
                }

            }

            .img_fit_obj {
                object-fit: cover;
            }

            .tb_cust_width {
                width: 175px;
            }

            .resTable table,
            th,
            td {
                border: 0px solid #000;
                vertical-align: top;
            }

            .resTable {
                width: 100%
            }

            .resTable table {
                border: 1px solid #ccc;
                border-collapse: collapse;
                margin: 0;
                padding: 0;
                table-layout: fixed;
                width: 100%;
            }

            .resTable table tr {
                background-color: #f8f8f800;
                border: 1px solid #ddd;
                padding: .35em;
            }

            .resTable table th,
            .resTable table td {
                padding: .625em;
                text-align: center;


            }

            @media screen and (max-width: 600px) {
                .sub_flex1 {
                    flex-direction: column;
                }

                .resTable table thead {
                    border: none;
                    clip: rect(0 0 0 0);
                    height: 1px;
                    margin: -1px;
                    overflow: hidden;
                    padding: 0;
                    position: absolute;
                    width: 1px;

                }

                #outdoorsportsrow {
                    display: flex;
                }

                .event-form .star-rating-content .ques label.star-questions {

                    padding: 10px 20px 10px 30px;
                }

                /* .resTable table tr {
      border-bottom: 3px solid #ddd;
      display: block;
    } */

                .event-form .star-rating-content .ques label.star-questions-cus {

                    padding: 10px 54px 10px 30px;
                }


                .resTable table tr {
                    border: 0px solid #ddd;
                    padding: .0em;
                    border-bottom: 10px solid #2196f3;
                    display: block;
                    margin-bottom: 10px;
                }

                .resTable table tr {
                    background-color: #f8f8f800;

                }

                .resTable table td {
                    border-bottom: 1px solid #ddd;
                    display: block;
                    text-align: right;
                }

                .resTable table td::before {
                    content: attr(data-label);
                    float: left;
                }

                .sub_ques_elem input[type="number"].fit-pe-inputs {
                    width: 100%;
                }

                .fitIndia-radio-col.fitIndia-checkbox-col {
                    display: inline-flex;
                    flex-wrap: nowrap;
                }
            }
        </style>
      
        @endsection