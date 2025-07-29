@extends('layouts.app')
@section('title', 'School Certificate Request | Fit India')
@section('content')
<style>
    .fit-india-section {
        font-family: 'roboto';
    }

    .fit-india-section h2 {
        font-size: 26px;
        color: #000000;
        font-weight: bold;
    }

    .fit-india-section h3 {
        background-color: #FCF8FF;
        font-size: 15px;
        font-weight: 500;
        color: #000;
        display: block;
        padding-top: 8px;
        padding-bottom: 8px;
        padding-left: 8px;
    }

    .fit-india-section p,
    .fit-india-section li {
        font-size: 13px;
        font-weight: 400;
        color: #000;
    }

    .fit-india-section .custom-wid {
        width: 8%;
        margin-left: 8px;
    }

    .fit-india-section .submit-btn {
        background-color: #2196F3;
        border: 1px solid #2196F3;
        border-radius: 5px;
        color: #fff;
        text-transform: uppercase;
        padding-left: 22px;
        padding-right: 22px;
    }
    .fit-india-section .custom-wid {
    width: 18%;
    margin-left: 8px;
}
.mul-sel{
    min-height: 180px;
}
</style>
@php
$indoorsports = array('Badminton', 'Basketball', 'Boxing', 'Fencing', 'Gymnastics', 'Judo', 'Kabaddi', 'Karate', 'Lawn Tennis', 'Shooting', 'Swimming', 'Table Tennis', 'Taekwondo', 'Volleyball', 'Carom', 'Chess', 'Weightlifting', 'Wrestling',);

$outdoorsports = array( 'Archery', 'Athletics', 'Badminton', 'Basketball', 'Canoeing', 'Cricket', 'Cycling', 'Football', 'Handball','Hockey', 'Judo', 'Kabaddi', 'Karate', 'Kayaking', 'Kho Kho', 'Lawn Tennis', 'Rowing', 'Sepaktakraw', 'Softball', 'Swimming', 'Taekwondo', 'Volleyball', 'Wushu');
@endphp

<div class="banner_area">
    <img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
    @include('event.userheader')
    <div class="container">
        <div class="et_pb_row">
            <div class="row">
                @include('event.sidebar')
                <div class="col-sm-12 col-md-9 ">
                    @if(strtolower($role) == 'school')
                    <!-- first section -->
                    <div class="fit-india-section py-4">
                        <div class="container-fluid ">
                            <div class="border p-4 rounded">
                                <form name="flagrequest" method="post" action="{{ route('flagstore') }}" enctype="multipart/form-data">
                                    @csrf
                                    @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif

                                    @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                    @endif
                                    <div class="row mb-4">
                                        <div class="col">
                                            <h2 class="">Request for Fit India School</h2>
                                        </div>
                                        <h2 for="event_name"> </h2>
                                        <input type="hidden" name="questions" value="4" />
                                        <input type="hidden" name="ratingreqid" value="1621" />
                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}" />

                                        <div class="col-auto">
                                            @if(!empty($flagstatusdata->cur_status))
                                            @if(strtolower($flagstatusdata->cur_status) == 'awarded')
                                            <img class="me-2" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAAQCAYAAAD0xERiAAAABHNCSVQICAgIfAhkiAAAAPxJREFUOE/NlMsNwjAQRGchd+gAUQF0QDhy4FMCdEAHhE5CBSAQZ0IH0AElQAOYsUUsyzHhe8BRZMdav+zObCK4D7VBwuUsf351lj4kjxVCYlRwxhWjT2E5Q8MUrz352Rcww/hj2E8NcGAx17tXXTRxChcZoG7ddA+rNV0V1N4ALtga4zDs3V6L0JQeTkGYyXyDA6fW0+wUJiwxdeNs91rtltSgyiDBMAikTtyf+iAdW4B5hmg9tDEN3kdGp3zRyi2tNDM/G+eb7VLsrKz8YplruiMmk3zozGK2gS7dis29vQ8PwTIe6jw1AJgTlpQbsEWbfxDbiA+hEU6+djeLq19IEheHogAAAABJRU5ErkJggg==" alt="">
                                            @else
                                            <i class="fa fa-star-half-o me-2" aria-hidden="true"></i>
                                            @endif
                                            {{ ucwords($flagstatusdata->cur_status) }}
                                            @else
                                            <i class="fa fa-ban me-2" aria-hidden="true"></i> Not Applied
                                            @endif
                                        </div>

                                    </div>
                                    <!-- 1 -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>01. Designated PE Teacher</h3>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-1">Schools must have at least one designated teacher who is responsible for:</p>
                                            <p>Conducting physical activities and promoting an active and healthy lifestyle among student</p>
                                        </div>
                                        <div class="col-12 mt-2 d-flex align-items-center">
                                            <p class="mb-0 ">No. of teachers</p>
                                            <input type="number" name="num_teachers" value="{{ optional($flagdata)->peteacherno }}" class="form-control custom-wid @error('num_teachers') is-invalid @enderror" value="{{ old('num_teachers') }}">
                                            @error('num_teachers')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-12 mt-2">
                                            <p class="mb-2"><b>Documentation required – Teacher Certification: Name and details of the nominated teacher for PE. (attach max 20 MB relevant doc/pdf)</b></p>
                                            <input type="file" name="teacher_cert_doc" class="form-control @error('teacher_cert_doc') is-invalid @enderror">
                                            @error('teacher_cert_doc')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            @if (!empty($flagdata->teacher_cert_doc))
                                            <a href="{{ asset('wp-content/uploads/' . $flagdata->teacher_cert_doc) }}" target="_blank">
                                                View Uploaded Document
                                            </a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- 2 -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h3>02. Accessible Playground or Play Area</h3>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-1">Schools must have a safe, well-maintained playground or open space to conduct regular physical activities.</p>
                                            <p>This space should be actively used for student engagement and should meet safety and usability standards.</p>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <p class="mb-2"><b>Keep CTRL key press while selecting multiple sports</b></p>
                                            <p class="mb-2">Outdoor Sports ( minimum 2 )</p>
                                            <div class="w-100 my-2">
                                                @php
                                                $selecteddoorsports = !empty($flagdata) ? unserialize($flagdata->outdoorsports) : [];
                                                @endphp
                                                <select multiple class="form-control w-50 mul-sel" name="outdoor_sports[]">
                                                    @foreach ($outdoorsports as $sport)
                                                    <option value="{{ $sport }}"
                                                        @if (in_array($sport, $selecteddoorsports)) selected @endif>
                                                        {{ $sport }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('outdoor_sports')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                @error('outdoor_sports.*')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <p class="mb-2">Indoor Sports ( minimum 2 )</p>
                                            <div class="w-100 my-2">
                                                @php
                                                $selectedindoorsports = !empty($flagdata) ? unserialize($flagdata->indoorsports) : [];
                                                @endphp
                                                <select multiple class="form-control w-50 mul-sel" name="indoor_sports[]">
                                                    @foreach ($indoorsports as $sport)
                                                    <option value="{{ $sport }}"
                                                        @if (in_array($sport, $selectedindoorsports)) selected @endif>
                                                        {{ $sport }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('indoor_sports')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                @error('indoor_sports.*')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <p class="mb-2"><b>Documentation required – Must submit the approved town and country planning structured plan.(attach max 20 MB relevant doc/pdf)</b></p>
                                            <input type="file" name="town_planning_doc" class="form-control @error('town_planning_doc') is-invalid @enderror">
                                            @error('town_planning_doc')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            @if (!empty($flagdata->teacher_cert_doc))
                                            <a href="{{ asset('wp-content/uploads/' . $flagdata->town_planning_doc) }}" target="_blank">
                                                View Uploaded Document
                                            </a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- 3 -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h3>03. Active Participation in Daily Physical Activity</h3>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-1">Every student must engage in a minimum of 30 minutes of physical activity on each school day</p>
                                        </div>
                                        <div class="col-12 mt-2 d-flex align-items-center">
                                            <p class="mb-0 ">No. of Student</p>
                                            <input type="number" name="num_students" class="form-control custom-wid @error('num_students') is-invalid @enderror" value="{{ optional($flagdata)->noofstudents }}">
                                            @error('num_students')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-12 mt-2">
                                            <p class="mb-1">Activities can include:</p>
                                            <p class="mb-1">Sports (e.g., football, volleyball, basketball)</p>
                                            <p class="mb-1">Exercise routines (e.g., warm-ups, drills)</p>
                                            <p class="mb-1">Fun fitness activities (e.g., shuttle runs, obstacle courses, fitness games)</p>
                                            <p class="mb-1">The objective is to ensure that daily physical movement becomes an integral part of school culture.</p>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <p class="mb-2"><b>No. of students of spending at least 30 minutes/ day for physical activities in school</b></p>
                                            <input type="text" name="students_active_30min" class="form-control @error('students_active_30min') is-invalid @enderror" value="{{ optional($flagdata)->students_active_30min }}">
                                            @error('students_active_30min')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-12 mt-2">
                                            <p class="mb-2"><b>Documentation required – Timetable or any other proof inclusive of playing duration needs to be uploaded. (attach max 20 MB relevant doc/pdf)</b></p>
                                            <input type="file" name="activity_timetable_doc" class="form-control @error('activity_timetable_doc') is-invalid @enderror">
                                            @error('activity_timetable_doc')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            @if (!empty($flagdata->activity_timetable_doc))
                                            <a href="{{ asset('wp-content/uploads/' . $flagdata->activity_timetable_doc) }}" target="_blank">
                                                View Uploaded Document
                                            </a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- 4 -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h3>04. Sports Facilities</h3>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <p class="mb-1">The school must provide facilities for at least four sports, including:</p>
                                            <p class="mb-1">A minimum of two outdoor sports.</p>
                                            <p class="mb-1">These facilities should be functional and accessible for regular student use.</p>
                                        </div>
                                        <div class="col-12 mt-2">
                                            @php
                                            // Deserialize the stored image URLs (if any)
                                            $uploadedImages = !empty($flagdata->sports_facility_images) ? unserialize($flagdata->sports_facility_images) : [];
                                            @endphp
                                            <p class="mb-2"><b>Documentation required – 4-5 pictures must be uploaded with geo-tagging co-ordinates.. (attach max 20 MB relevant jpeg/jpg/png)</b></p>
                                            <input type="file" name="sports_facility_images[]" class="form-control @error('sports_facility_images.*') is-invalid @enderror" accept=".jpeg,.jpg,.png" multiple>
                                            @error('sports_facility_images')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            @error('sports_facility_images.*')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            {{-- Show already uploaded images --}}
                                            @if (!empty($uploadedImages))
                                            <div class="row mt-3">
                                                @foreach ($uploadedImages as $img)
                                                <div class="col-md-3 mb-2">
                                                    <img src="{{ $img }}" class="img-thumbnail" style="width: 100%; height: auto;" alt="Uploaded Image">
                                                </div>
                                                @endforeach
                                            </div>
                                            @endif

                                        </div>

                                    </div>


                                    <!-- 5 -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h3>05. Participation in Fit India Activities</h3>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <p class="mb-1">The school must provide facilities for at least four sports, including:</p>
                                            <p class="mb-3">Schools must be committed to participating in Fit India Movement initiatives, conducted under the guidance of:</p>
                                            <p class="mb-1">SAI (Sports Authority of India) and</p>
                                            <p class="mb-1">MYAS (Ministry of Youth Affairs and Sports)</p>
                                        </div>
                                        <div class="col-12 mt-2 d-flex">
                                            <div class="me-2"><input type="checkbox"
                                                    name="fit_india_participation"
                                                    value="1"
                                                    {{ optional($flagdata)->fit_india_participation == 1 ? 'checked' : '' }}>
                                            </div>
                                            <div class="ms-2">
                                                @error('fit_india_participation')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <p class="mb-2"><b>This participation should be regular and aimed at reinforcing fitness habits among students and staff alike.</b></p>
                                            </div>

                                        </div>
                                        @if($currentflag == 1621)
                                        <div class="col-auto mt-3">
                                            <button class="btn submit-btn">Submit</button>
                                        </div>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- first section End -->

                    <!-- Second Section -->
                    <div class="fit-india-section py-4">
                        <div class="container-fluid mt-4">

                            <div class="border p-4 rounded">
                                <form name="threestarrequest" method="post" action="{{ route('threestar') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-4">
                                        <div class="col">
                                            <h2 class="">Request for 3 Star</h2>
                                            <input type="hidden" name="questions" value="5" />
                                            <input type="hidden" name="ratingreqid" value="1622" />
                                            <input type="hidden" name="user_id" value="{{ Auth::id() }}" />
                                        </div>
                                        <div class="col-auto default-i @if(!empty($threestatusdata->cur_status)) {{ $threestatusdata->cur_status }} @endif">
                                            @if(!empty($threestatusdata->cur_status))
                                            @if($threestatusdata->cur_status == 'applied')
                                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                            @elseif($threestatusdata->cur_status == 'rejected')
                                            <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                                            @else
                                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                                            @endif
                                            {{ ucwords($threestatusdata->cur_status) }}
                                            @else
                                            <i class="fa fa-ban" aria-hidden="true"></i> Not Applied
                                            @endif
                                        </div>

                                    </div>
                                    <!-- 1 -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>01. Active Participation in Daily Physical Activity</h3>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-1">Schools must ensure that all students participate in daily physical activities as per the following durations:</p>
                                        </div>
                                        <div class="col-12 mt-2 d-flex align-items-center">
                                            <p class="mb-0 ">No. of students in school</p>
                                            <input type="number" name="no_of_schools"
                                                class="form-control custom-wid @error('no_of_schools') is-invalid @enderror"
                                                value="{{ old('no_of_schools',optional($threedata)->no_of_schools) }}">
                                            @error('no_of_schools')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mt-2">
                                            <li class="mb-2"><b>Grades 1–5: Minimum 30 minutes</b></li>
                                            <li class="mb-2"><b>Grades 6–12: Minimum 45 to 60 minutes</b></li>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <p class="mb-2">Activities should include sports, exercises, and fitness games conducted during school hours</p>
                                            <p class="mb-2">(a) No. of students of Grade 1-5 spending at least 30 minutes/ day for physical activities in school</p>
                                            <input
                                                type="text"
                                                name="grade1_5_students"
                                                class="form-control @error('grade1_5_students') is-invalid @enderror"
                                                value="{{ old('grade1_5_students',optional($threedata)->grade1_5_students) }}">

                                            @error('grade1_5_students')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <p class="mb-2">(b) No. of students of Grade 6-12 spending at least 45-60 minutes/ day for physical activities in school</p>
                                            <input
                                                type="text"
                                                name="grade6_12_students"
                                                class="form-control @error('grade6_12_students') is-invalid @enderror"
                                                value="{{ old('grade6_12_students',optional($threedata)->grade6_12_students) }}">

                                            @error('grade6_12_students')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mt-2">
                                            <p class="mb-2"><b>Documentation required – Timetable or any other proof inclusive of playing duration needs to be uploaded. (attach max 20 MB relevant doc/pdf)</b></p>
                                            <input
                                                type="file"
                                                name="timetable_doc"
                                                class="form-control @error('timetable_doc') is-invalid @enderror"
                                                accept=".pdf,.doc,.docx">
                                            @error('timetable_doc')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            @if (!empty($threedata->timetable_doc))
                                            <a href="{{ asset('wp-content/uploads/' . $threedata->timetable_doc) }}" target="_blank">
                                                View Uploaded Document
                                            </a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- 2 -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h3>02. Designated PE Teacher</h3>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-1">Schools must have at least one designated teacher who is responsible for:</p>
                                            <p class="mb-1">Conducting physical activities and promoting an active and healthy lifestyle among students</p>
                                        </div>
                                        <div class="col-12 mt-2 d-flex align-items-center">
                                            <p class="mb-0 ">No. of teachers</p>
                                            <input
                                                type="number"
                                                name="peteacherno"
                                                id="peteacherno"
                                                class="form-control custom-wid @error('peteacherno') is-invalid @enderror"
                                                value="{{ old('peteacherno',optional($threedata)->peteacherno) }}">

                                            @error('peteacherno')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mt-2">
                                            <p class="mb-2"><b>Documentation required – Teacher Certification: Name and details of the nominated teacher for PE. (attach max 20 MB relevant doc/pdf)</b></p>
                                            <input
                                                type="file"
                                                name="teacher_certification"
                                                class="form-control @error('teacher_certification') is-invalid @enderror"
                                                accept=".pdf,.doc,.docx">

                                            @error('teacher_certification')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            @if (!empty($threedata->teacher_certification))
                                            <a href="{{ asset('wp-content/uploads/' . $threedata->teacher_certification) }}" target="_blank">
                                                View Uploaded Document
                                            </a>
                                            @endif
                                        </div>
                                    </div>



                                    <!-- 4 -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h3>04. Accessible Playground or Play Area</h3>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-1">Schools must have a safe, well-maintained playground or open space to conduct regular physical activities.</p>
                                            <p>This space should be actively used for student engagement and should meet safety and usability standards.</p>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <p class="mb-2"><b>Keep CTRL key press while selecting multiple sports</b></p>
                                            <p class="mb-2">Outdoor Sports ( minimum 2 )</p>
                                            <div class="w-100 my-2">
                                                @php
                                                $selectedthreedoorsports = !empty($threedata) ? unserialize($threedata->outdoorsports) : [];
                                                @endphp
                                                <select multiple class="form-control w-50 mul-sel" name="outdoor_sports[]">
                                                    @foreach ($outdoorsports as $sport)
                                                    <option value="{{ $sport }}"
                                                        @if (in_array($sport, $selectedthreedoorsports)) selected @endif>
                                                        {{ $sport }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('outdoor_sports')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                @error('outdoor_sports.*')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <p class="mb-2">Indoor Sports ( minimum 2 )</p>
                                            <div class="w-100 my-2">
                                                @php
                                                $selectedthreeindoorsports = !empty($threedata) ? unserialize($threedata->indoorsports) : [];
                                                @endphp
                                                <select multiple class="form-control w-50 mul-sel" name="indoor_sports[]">
                                                    @foreach ($indoorsports as $sport)
                                                    <option value="{{ $sport }}"
                                                        @if (in_array($sport, $selectedthreeindoorsports)) selected @endif>
                                                        {{ $sport }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('indoor_sports')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                @error('indoor_sports.*')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <p class="mb-2"><b>Documentation required – Must submit the approved town and country planning structured plan. (attach max 20 MB relevant doc/pdf)</b></p>
                                            <input
                                                type="file"
                                                name="town_country_plan_doc"
                                                class="form-control @error('town_country_plan_doc') is-invalid @enderror"
                                                accept=".pdf,.doc,.docx">

                                            @error('town_country_plan_doc')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            @if (!empty($threedata->town_country_plan_doc))
                                            <a href="{{ asset('wp-content/uploads/' . $threedata->town_country_plan_doc) }}" target="_blank">
                                                View Uploaded Document
                                            </a>
                                            @endif
                                        </div>
                                    </div>


                                    <!-- 5 -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h3>05. Sports Facilities</h3>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <p class="mb-1">The school must provide facilities for at least four sports, including:</p>
                                            <p class="mb-3">A minimum of two outdoor sports.</p>
                                            <p class="mb-2">These facilities should be functional and accessible for regular student use.</p>
                                        </div>
                                        <div class="col-12 mt-2 ">
                                            <p class="mb-2"><b>Documentation required – 4-5 pictures must be uploaded with geo-tagging co-ordinates.. (attach max 20 MB relevant jpeg/jpg/png)</b></p>
                                            <input
                                                type="file"
                                                name="geo_tagged_images[]"
                                                class="form-control @error('geo_tagged_images') is-invalid @enderror @error('geo_tagged_images.*') is-invalid @enderror"
                                                accept=".jpeg,.jpg,.png"
                                                multiple>

                                            {{-- Show validation errors --}}
                                            @error('geo_tagged_images')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @error('geo_tagged_images.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @php
                                            // Deserialize the stored image URLs (if any)
                                            $uploadedImagesThree = !empty($threedata->geo_tagged_images) ? unserialize($threedata->geo_tagged_images) : [];
                                            @endphp
                                            @if (!empty($uploadedImagesThree))
                                            <div class="row mt-3">
                                                @foreach ($uploadedImagesThree as $img)
                                                <div class="col-md-3 mb-2">
                                                    <img src="{{ $img }}" class="img-thumbnail" style="width: 100%; height: auto;" alt="Uploaded Image">
                                                </div>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                         @if($currentflag == 1622)
                                        <div class="col-auto mt-3">
                                            <button class="btn submit-btn">Submit</button>
                                        </div>
                                        @endif

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Second Section End -->

                    <!-- third Section -->
                    <div class="fit-india-section py-4">
                        <div class="container-fluid mt-4 ">

                            <div class="border p-4 rounded">
                                <form name="threestarrequest" method="post" action="{{ route('fivestar') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-4">
                                        <div class="col">
                                            <h2 class="">Request for 5 Star</h2>
                                            <h2 for="event_name"> </h2>
                                            <input type="hidden" name="questions" value="6" />
                                            <input type="hidden" name="ratingreqid" value="1623" />
                                            <input type="hidden" name="user_id" value="{{ Auth::id() }}" />
                                        </div>
                                        <div class="col-auto default-i @if(!empty($fivestatusdata->cur_status)) {{ $fivestatusdata->cur_status }} @endif">
                                            @if(!empty($fivestatusdata->cur_status))
                                            @if($fivestatusdata->cur_status == 'applied')
                                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                            @elseif($fivestatusdata->cur_status == 'rejected')
                                            <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                                            @else
                                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                                            @endif
                                            {{ ucwords($fivestatusdata->cur_status) }}
                                            @else
                                            <i class="fa fa-ban" aria-hidden="true"></i> Not Applied
                                            @endif
                                        </div>
                                    </div>
                                    <!-- 1 -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>01. Active Participation in Daily Physical Activity</h3>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-1">Schools must ensure that all students participate in daily physical activities as per the following durations:</p>
                                        </div>
                                        <div class="col-12 mt-2 d-flex align-items-center">
                                            <p class="mb-0 ">No. of students in school</p>
                                            <input type="number" name="num_students_5start" class="form-control custom-wid @error('num_students') is-invalid @enderror" value="{{ old('noofstudents', optional($fivedata)->noofstudents) }}">
                                            @error('num_students_5start')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-12 mt-2">
                                            <li class="mb-2"><b>Grades 1–5: Minimum 30 minutes</b></li>
                                            <li class="mb-2"><b>Grades 6–12: Minimum 45 to 60 minutes</b></li>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <p class="mb-2">Schools must ensure that all students participate in daily physical activities as per the following durations:</p>
                                            <p class="mb-2">(a) No. of students of Grade 1-5 spending at least 30 minutes/ day for physical activities in school</p>
                                            <input
                                                type="text"
                                                name="grade1_5_students_5start"
                                                class="form-control @error('grade1_5_students_5start') is-invalid @enderror"
                                                value="{{ old('grade1_5_students_5start', optional($fivedata)->grade1_5_students) }}">

                                            @error('grade1_5_students_5start')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <p class="mb-2">(b) No. of students of Grade 6-12 spending at least 45-60 minutes/ day for physical activities in school</p>
                                            <input
                                                type="text"
                                                name="grade6_12_students_5start"
                                                class="form-control @error('grade6_12_students_5start') is-invalid @enderror"
                                                value="{{ old('grade6_12_students_5start', optional($fivedata)->grade6_12_students) }}">

                                            @error('grade6_12_students_5start')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mt-2">
                                            <p class="mb-2"><b>Documentation required – Timetable or any other proof inclusive of playing duration needs to be uploaded. (attach max 20 MB relevant doc/pdf)</b></p>
                                            <input
                                                type="file"
                                                name="timetable_doc_5start"
                                                class="form-control @error('timetable_doc_5start') is-invalid @enderror"
                                                accept=".pdf,.doc,.docx">
                                            @error('timetable_doc_5start')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            @if (!empty($fivedata->timetable_doc))
                                            <a href="{{ asset('wp-content/uploads/' . $fivedata->timetable_doc) }}" target="_blank">
                                                View Uploaded Document
                                            </a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- 2 -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h3>02. Sports Coaches & Student Strength</h3>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-1">(a) The school must have at least two sports coaches (can also be PE teachers)</p>
                                            <p class="mb-1">(b) The school must have a minimum of 1,000 enrolled students</p>
                                            <p class="my-2">Documentation required – Declaration of no. of students to be provided</p>
                                        </div>
                                        <div class="col-12 mt-2 d-flex align-items-center">
                                            <p class="mb-0 ">No. of schools</p>
                                            <input type="number" name="no_of_schools_5start"
                                                class="form-control custom-wid @error('no_of_schools') is-invalid @enderror"
                                                value="{{ old('no_of_schools_5start',optional($fivedata)->no_of_schools) }}">
                                            @error('no_of_schools_5start')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                    </div>

                                    <!-- 3 -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h3>03. Accessible Playground or Play Area</h3>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-1">Schools must have a safe, well-maintained playground or open space to conduct regular physical activities.</p>
                                            <p class="mb-1">This space should be actively used for student engagement and should meet safety and usability standards.</p>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <p class="mb-2"><b>Keep CTRL key press while selecting multiple sports</b></p>
                                            <p class="mb-2">Outdoor Sports ( minimum 2 )</p>
                                            <div class="w-100 my-2">
                                                @php
                                                $selectedfivedoorsports = !empty($fivedata) ? unserialize($fivedata->outdoorsports) : [];
                                                @endphp
                                                <select multiple class="form-control w-50 mul-sel" name="outdoor_sports_5start[]">
                                                    @foreach ($outdoorsports as $sport)
                                                    <option value="{{ $sport }}"
                                                        @if (in_array($sport, $selectedfivedoorsports)) selected @endif>
                                                        {{ $sport }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('outdoor_sports_5start')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                @error('outdoor_sports_5start.*')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <p class="mb-2">Indoor Sports ( minimum 2 )</p>
                                            <div class="w-100 my-2">
                                                @php
                                                $selectedfiveindoorsports = !empty($fivedata) ? unserialize($fivedata->indoorsports) : [];
                                                @endphp
                                                <select multiple class="form-control w-50 mul-sel" name="indoor_sports_5start[]">
                                                    @foreach ($indoorsports as $sport)
                                                    <option value="{{ $sport }}"
                                                        @if (in_array($sport, $selectedfiveindoorsports)) selected @endif>
                                                        {{ $sport }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('indoor_sports_5start')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                @error('indoor_sports_5start.*')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <p class="mb-2"><b>Documentation required – Must submit the approved town and country planning structured plan. (attach max 20 MB relevant doc/pdf)</b></p>
                                            <input
                                                type="file"
                                                name="town_country_plan_doc_5start"
                                                class="form-control @error('town_country_plan_doc_5start') is-invalid @enderror"
                                                accept=".pdf,.doc,.docx">

                                            @error('town_country_plan_doc_5start')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            @if (!empty($fivedata->town_country_plan_doc))
                                            <a href="{{ asset('wp-content/uploads/' . $fivedata->town_country_plan_doc) }}" target="_blank">
                                                View Uploaded Document
                                            </a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- 4 -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h3>04. PE Curriculum Aligned with NEP 2.0</h3>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-1">Schools must follow a structured physical education curriculum based on the guidelines in NEP 2.0</p>
                                            <p>If not already aligned, schools should plan and commit to implementing it.</p>
                                        </div>
                                        <div class="col-12 mt-2 d-flex">
                                            <div class="me-2"><input type="checkbox"
                                                    name="fit_india_participation_5start"
                                                    value="1"
                                                    {{ old('fit_india_participation_5start', optional($fivedata)->fit_india_participation) == 1 ? 'checked' : '' }}>

                                            </div>
                                            <div class="ms-2">
                                                @error('fit_india_participation_5start')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="ms-2">
                                                    <p class="mb-2"><b>Should be following curriculum mentioned in the NEP 2.0 or should start following</b></p>
                                                </div>
                                            </div>


                                        </div>


                                        <!-- 5 -->
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <h3>05. Fitness Assessment for All Students</h3>
                                            </div>

                                            <div class="col-12 mt-2">
                                                <p class="mb-3">The school must conduct annual fitness assessments of all students using:</p>
                                                <p class="mb-1">Fit India Movement App (FIMA)</p>
                                                <p class="mb-1">Or any other approved assessment method following FI Assessment parameters</p>
                                            </div>
                                            <div class="col-12 mt-2 ">
                                                <p class="mb-2"><b>Documentation required – Undertaking may be provided of when done in the form of photos/videos on prescribed platform – web portal/ Telegram, etc. (attach max 20 MB relevant jpeg/jpg/png)</b></p>
                                                <input
                                                    type="file"
                                                    name="geo_tagged_images_5start[]"
                                                    class="form-control @error('geo_tagged_images_5start') is-invalid @enderror @error('geo_tagged_images_5start.*') is-invalid @enderror"
                                                    accept=".jpeg,.jpg,.png"
                                                    multiple>
                                                {{-- Show validation errors --}}
                                                @error('geo_tagged_images_5start')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                                @error('geo_tagged_images_5start.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                @php
                                                // Deserialize the stored image URLs (if any)
                                                $uploadedImagesFive = !empty($fivedata->geo_tagged_images) ? unserialize($fivedata->geo_tagged_images) : [];
                                                @endphp
                                                @if (!empty($uploadedImagesFive))
                                                <div class="row mt-3">
                                                    @foreach ($uploadedImagesFive as $img)
                                                    <div class="col-md-3 mb-2">
                                                        <img src="{{ $img }}" class="img-thumbnail" style="width: 100%; height: auto;" alt="Uploaded Image">
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @endif
                                            </div>


                                        </div>


                                        <!-- 6 -->
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <h3>06. Healthy Eating Awareness</h3>
                                            </div>


                                            <div class="col-12 mt-2 d-flex">
                                                <div class="me-2">
                                                    <input type="checkbox"
                                                        name="school_initiative"
                                                        value="1"
                                                        {{ old('school_initiative', optional($fivedata)->school_initiative) == 1 ? 'checked' : '' }}>

                                                </div>
                                                <div class="ms-2">
                                                    @error('name="school_initiative"')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="ms-2">
                                                    <p class="mb-2"><b>Schools should actively encourage healthy eating habits among students by offering nutritious options in their canteens and promoting awareness of balanced diets.</b></p>
                                                </div>
                                            </div>
                                             @if($currentflag == 1623)
                                            <div class="col-auto mt-3">
                                                <button class="btn submit-btn">Submit</button>
                                            </div>
                                             @endif

                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- third Section End-->
                    @endif
                </div>

            </div>
        </div>
    </div>
    <br><br>
</div>
@endsection