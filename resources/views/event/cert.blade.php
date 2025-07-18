@extends('layouts.app')
@section('title', 'School Certificate Request | Fit India')
@section('content')
<!--<link rel="stylesheet" id="dashicons-css" href="https://fontawesome.com/v4.7.0/icons/" type="text/css" media="all"> -->

<style>
    .wid-cus{
        width: 10%;
        margin-left: 8px;
    }
    .h-select{
        min-height: 180px;
    }
</style>
<div class="banner_area">
   <img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
   @include('event.userheader') 
    <div class="container">
        <div class="et_pb_row">
            <div class="row">
               @include('event.sidebar')                    
                <div class="col-sm-12 col-md-9  ">
                <div class="accordion py-3" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Request for Fit India School
                    </button>
                </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body py-4">

                <div>
                    
                <div class="py-1">
                    <h3>1. Designated PE Teacher</h3>

                <p class="mb-0">Schools must have at least one designated teacher who is responsible for:</p>
                <p>Conducting physical activities and promoting an active and healthy lifestyle among students</p>
                <div class="d-flex align-items-center flex-wrap mt-2">
                    <h6 class="mb-0 d-flex align-items-center ">No. of Teachers</h6>
                    <input type="number" class="form-control wid-cus">
                </div>
                <div class="mt-3">
                    <p>Documentation required – Teacher Certification: Name and details of the nominated teacher for PE. (attachmax 20 MB relevant doc/pdf)</p>
                    <input type="file" class="form-control">
                </div>
                </div>
                </div>
                
                <div class="py-1 mt-4">
                    <h3>2. Accessible Playground or Play Area</h3>

                <p class="mb-0">Schools must have a safe, well-maintained playground or open space to conduct regular physicalactivities.</p>
                <p>This space should be actively used for student engagement and should meet safety and usabilitystandards.</p>
               
                <div class="mt-3">
                    <b class="fw-bold d-block">Keep CTRL key press while selecting multiple sports</b>
                    <div>
                        <h5 class="mt-4 mb-1">Outdoor Sports ( minimum 2 )</h5>
                                                    <div class="sports-row">
                                                        <select name="outdoorfacility[]" multiple="" class="h-select" onclick="othersportspop(this,'outdoor-sprts')">
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
                       
                    <div>
                        <h5 class="mt-4 mb-1">Indoor Sports ( minimum 2 )</h5>
                                                    <div class="sports-row">
                                                        <select name="outdoorfacility[]" multiple="" class="h-select" onclick="othersportspop(this,'outdoor-sprts')">
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
                     <div class="mt-3">
                    <p>1.
                        Documentation required – Must submit the approved town and country planning structured plan.(attach max 20 MB relevant doc/pdf)</p>
                    <input type="file" class="form-control">
                </div>
                </div>
                </div>
               </div>

               <!--3  -->
                 <div class="py-1 mt-4">
                     <h3>4. Active Participation</h3>

                    <p>Every student must engage in a minimum of 30 minutes of physical activity on each school day</p>
                            <div class="d-flex aling-items-center flex-wrap mt-2">
                    <h6 class="mb-0 d-flex align-items-center ">No. of Teachers</h6>
                    <input type="number" class="form-control wid-cus">
                            </div>
                          <div class="mt-3">
                    <p>Activities can include:</p>
                    <p>Sports (e.g., football, volleyball, basketball)</p>
                    <p>Exercise routines (e.g., warm-ups, drills)</p>
                    <p>Fun fitness activities (e.g., shuttle runs, obstacle courses, fitness games)</p>
                    <p>The objective is to ensure that daily physical movement becomes an integral part of school culture.</p>
                         </div>
                         <div class="p-3">
                         <div class="mb-1">
                        <p class="mb-2">1. A. No. of students of spending at least 30 minutes/ day for physical activities in school</p>
                        <input type="text" class="form-control">
                        </div>

                        <div class="mb-2">
                        <p class="mb-1">2. Documentation required – Timetable or any other proof inclusive of playing duration needs to beuploaded. (attach max 20 MB relevant doc/pdf)</p>
                        <input type="file" class="form-control">
                        </div>
                        </div>    
                </div>
                <div class="py-1 mt-4">
                    <h3>5. Participation in Fit India Activities</h3>

                    <div class="mt-3">
                        <p>The school must provide facilities for at least four sports, including:</p>
                        <p>Schools must be committed to participating in Fit India Movement initiatives, conducted under theguidance of:</p>
                        <p>SAI (Sports Authority of India) and MYAS (Ministry of Youth Affairs and Sports)</p>
                        <p>This participation should be regular and aimed at reinforcing fi tness habits among students and staffalike.</p>
                    </div>
                    <div class="my-3 d-flex align-items-center justify-content-center">
                          <input type="checkbox" aria-label="Checkbox for following text input">
                    </div>
                    <div class="my-3 d-flex flex-wrap " >
                                <button class="btn btn-success rounded-pill" style="margin-right: 8px;">DOWNLOAD FIT INDIA SCHOOL FLAG</button>
                                <button class="btn btn-success rounded-pill">DOWNLOAD CERTIFICATE</button>
                    </div>
                    <div class="my-1">
                        <p class="text-success">Congratulations you have awarded Fit India School Flag</p>
                    </div>
                 </div>
                </div>
                </div>
            </div>
                </div>

    
                </div>
                </div>

 
            </div>
        </div>
    
          

    
    
  @endsection
