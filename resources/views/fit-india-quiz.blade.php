{{-- {{ dd(session()->all()); }} --}}
{{-- {{ dd(session('locale')); }} --}}
@extends('layouts.app')
@section('title', 'Fit-india-quiz | Fit India')
@section('content')

<link rel="stylesheet" href="{{ asset('resources/css/newcss/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('resources/css/newcss/jquery-ui.css') }}">
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
        {{-- <img src="resources/imgs/fitindia_quiz_inner2_2022.jpeg" alt="Fit-india-quiz" title="Fit India Quiz 2022" --}}
        <a href="https://fitindia.nta.ac.in/">
            <img src="resources/imgs/fit_india_quiz_01_11_2023.png" alt="Fit-india-quiz" title="Fit India Quiz 2023" class="img-fluid expand_img" />
        </a>
        {{-- <a href="https://fitindia.nta.ac.in/">
            <img src="resources/imgs/FiTwebbanner_20230903_100143_0000.png" alt="Fit-india-quiz" title="Fit India Quiz 2022" class="img-fluid expand_img" />
        </a>     --}}
    </div>

    <section id="{{ $active_section_id }}">
        {{-- @if(session('locale') == null) --}}
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h1 class="mb-4">{{ __('fitindiaquiz.quiztitle') }}  </h1>
                        {{-- <p class="text-justify">Fit India Quiz was launched in 2021 as a part of commemorating ‘Azadi Ka Amrit Mahotsav, it was
                            envisaged to propagate the message of Fit India among the school children and strengthen its
                            presence in schools, a Fit India Quiz has been envisioned to involve school children across the
                            country. Fit India Quiz is dedicated to the school students where students with interest in sports
                            and fitness can participate and compete at state and national level. In the first edition of Fit
                            India Quiz, 36,299 students from 13,502 school participated and showcased their knowledge in fitness
                            and sports. Fit India Quiz has become a popular mechanism to align the kids across the country to
                            join the mission of fitness and adopt the fit lifestyle. Fit India Quiz comprised of preliminary
                            rounds, state level rounds and national rounds, thus making it one of the most comprehensive and
                            flagship quiz programs on fitness and sports in the country.</p> --}}
                            <p style="text-align:justify;">
                                {{ __('fitindiaquiz.part1') }}
                            </p>
                            <p style="text-align:justify;">
                                {{ __('fitindiaquiz.part2') }}
                            </p>
                            <p style="text-align:justify;">
                                {{ __('fitindiaquiz.part3') }}
                            </p>
                            <p style="text-align:justify;">
                                <br/>
                                {{ __('fitindiaquiz.registrations') }}
                                <br/>
                                {{ __('fitindiaquiz.registervisit') }} <a href="https://fitindia.nta.ac.in/"> https://fitindia.nta.ac.in/</a>
                            </p>
                    </div>
                    <div class="mt-3 mb-3 ml-2 quiz_btn_fit" style="width:40%">
                        <a class="btn btn-primary btn-sm d_button b_color" href="https://fitindia.nta.ac.in/" target="_blank">{{ __('fitindiaquiz.register') }}</a>
                        <a class="btn btn-primary btn-sm d_button f_color" style="width:35%" href="resources/pdf/FIQSTEPBYSTEPREGISTRATIONGUIDE.pdf" target="_blank">
                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            &nbsp; {{ __('fitindiaquiz.htr') }}
                            {{-- How To Register  --}}
                        </a>
                        <a class="btn btn-primary btn-sm d_button " href="resources/pdf/{{__('fitindiaquiz.quizpdf')}}.pdf" target="_blank"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp; {{ __('fitindiaquiz.guidelines') }}</a>
                        {{-- @if(session('locale') == null)
                            <a class="btn btn-primary btn-sm d_button " href="resources/pdf/GuidelinesforFitIndiaQuiz2023_english.pdf" target="_blank"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp; {{ __('fitindiaquiz.guidelines') }}</a>
                        @elseif(session('locale') == 'en')
                            <a class="btn btn-primary btn-sm d_button " href="resources/pdf/GuidelinesforFitIndiaQuiz2023_english.pdf" target="_blank"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp; {{ __('fitindiaquiz.guidelines') }}</a>
                        @elseif(session('locale') == 'hn')
                            <a class="btn btn-primary btn-sm d_button " href="resources/pdf/GuidelinesforFitIndiaQuiz2023_Hindi.pdf" target="_blank"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp; {{ __('fitindiaquiz.guidelines') }}</a>
                        @endif     --}}
                        {{-- <a class="btn btn-primary btn-sm d_button f_color"
                            href="resources/pdf/Fit_India_Quiz_2022_Schedule_of_activities.pdf" target="_blank"> <i
                                class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp; Schedule</a>
                                <a class="btn btn-primary btn-sm d_button border-0" style="background-color:#b3912d"
                            href="https://youtu.be/JSaNPKPnYN8" target="_blank"> <i
                                class="fa fa-youtube" aria-hidden="true"></i>&nbsp; Tutorial Video</a> --}}
                                {{-- <a class="btn btn-primary btn-sm d_button btn f_color" style="width:auto" href="resources/imgs/fitindiaqiuzjan2023/FIQ22_Final List of selected Candidate and Schools.pdf" target="_blank">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                    &nbsp;
                                    Download Results
                                </a> --}}

                    {{-- excel download --}}

                        <!--<a class="btn btn-primary btn-sm d_button f_color" href="resources/pdf/FREQUENTLY_ASKED_QUESTIONS.pdf" target="_blank"><i class="fa fa-question-circle-o" aria-hidden="true"></i>&nbsp; FAQ</a>-->
                        <!--<a class="btn btn-info btn-sm d_button " href="resources/pdf/State-District-wise-participation.xlsx" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp; District wise participation</a>-->
                    </div>
            </div>
        {{-- @endif --}}
    </section>


    {{-- Table --}}
    {{-- <div class="quiz-result-grid">
        <div class="container">
            <div class="row text-center py-3 result-headings">
                <h2>FIT INDIA QUIZ 2022</h2>&nbsp;&nbsp;
                <h4>PRELIMINARY ROUND RESULTS</h4>
            </div>
                <div class="row grid-result py-4">
                    <div class="col-md-4 col-12 my-4">
                        <div class="figure-grid text-center py-4">
                            <h5 class="mb-4">NATIONAL TOPPER BOYS</h5>
                            <img src="{{ asset('resources/imgs/fitindiaqiuzjan2023/NATIONALTOPPERSBOYS.jpg') }}" class="img-fluid img-grid" alt="">
                        </div>
                    </div>
                    <div class="col-md-4 col-12 my-4">
                        <div class="figure-grid text-center py-4">
                            <h5 class="mb-4">NATIONAL TOPPER GIRLS</h5>
                            <img src="{{ asset('resources/imgs/fitindiaqiuzjan2023/NATIONALTOPPERSGIRLS.jpg') }}" class="img-fluid img-grid" alt="">
                        </div>
                    </div>
                    <div class="col-md-4 col-12 my-4">
                        <div class="figure-grid text-center py-4">
                            <h5 class="mb-4">YOUNG ACHIEVERS</h5>
                            <img src="{{ asset('resources/imgs/fitindiaqiuzjan2023/YOUNGACHIEVERS.jpg') }}" class="img-fluid img-grid" alt="">
                        </div>
                    </div>
                    <div class="col-md-4 col-12 my-4">
                        <div class="figure-grid text-center py-4">
                            <h5 class="mb-4">ZONAL TOPPER NORTH</h5>
                            <img src="{{ asset('resources/imgs/fitindiaqiuzjan2023/ZONALTOPPERSNORTH.jpg') }}" class="img-fluid img-grid" alt="">
                        </div>
                    </div>
                    <div class="col-md-4 col-12 my-4">
                        <div class="figure-grid text-center py-4">
                            <h5 class="mb-4">ZONAL TOPPER SOUTH</h5>
                            <img src="{{ asset('resources/imgs/fitindiaqiuzjan2023/ZONALTOPPERSSOUTH.jpg') }}" class="img-fluid img-grid" alt="">
                        </div>
                    </div>
                    <div class="col-md-4 col-12 my-4">
                        <div class="figure-grid text-center py-4">
                            <h5 class="mb-4">ZONAL TOPPER EAST</h5>
                            <img src="{{ asset('resources/imgs/fitindiaqiuzjan2023/ZONALTOPPERSEAST.jpg') }}" class="img-fluid img-grid" alt="">
                        </div>
                    </div>
                    <div class="col-md-4 col-12 my-4">
                        <div class="figure-grid text-center py-4">
                            <h5 class="mb-4">ZONAL TOPPER WEST</h5>
                            <img src="{{ asset('resources/imgs/fitindiaqiuzjan2023/ZONALTOPPERSWEST.jpg') }}" class="img-fluid img-grid" alt="">
                        </div>
                    </div>
                    <div class="col-md-4 col-12 my-4">
                        <div class="figure-grid text-center py-4">
                            <h5 class="mb-4">ZONAL TOPPER NORTHEAST</h5>
                            <img src="{{ asset('resources/imgs/fitindiaqiuzjan2023/ZONALTOPPERSNORTHEAST.jpg') }}" class="img-fluid img-grid" alt="">
                        </div>
                    </div>
                    <div class="col-md-4 col-12 my-4">
                        <div class="figure-grid text-center py-4">
                            <h5 class="mb-4">ZONAL TOPPER CENTRAL</h5>
                            <img src="{{ asset('resources/imgs/fitindiaqiuzjan2023/ZONALTOPPERSCENTRAL.jpg') }}" class="img-fluid img-grid" alt="">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div> --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                <div class="cont_area cont_area_cont">
                    <h1>{{ __('fitindiaquiz.queries') }}  <span>{{ __('fitindiaquiz.contact') }} </span></h1>
                    <div class="d-flex justify-content-around mail_img align-items-center ">
                        <div>
                            <img src="resources/imgs/mail.png" class="fluid-img" />
                        </div>

                        <div>
                            <ul>
                                <!-- <li><span><i class="fa fa-phone" aria-hidden="true"></i></span> NTA Helpdesk :<span>011 4075 9000, 011 6922 7700</span></li> -->
                                <li><span><i class="fa fa-phone" aria-hidden="true"></i></span> {{ __('fitindiaquiz.nta') }}
                                    <span>011-40759000, 011-6922 7700</span>
                                </li>
                                <li><span><i class="fa fa-phone" aria-hidden="true"></i></span> {{ __('fitindiaquiz.sia') }}
                                    <span>1800 202 5155</span>
                                </li>

                                <li><span><i class="fa fa-envelope-o" aria-hidden="true" style="font-size:17px;"></i></span>
                                    {{ __('fitindiaquiz.write') }} <span> fitindia[at]nta[dot]ac[dot]in</span></li>
                                <li><span><i class="fa fa-clock-o" aria-hidden="true"></i></span>{{ __('fitindiaquiz.timing') }} : <span>{{ __('fitindiaquiz.alldays') }}
                                        (9:00 - 5:30pm)</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('resources/js/newjs/select2.min.js')}}"></script>
    <script src="{{ asset('resources/js/newjs/jquery-ui.js')}}"></script>
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
