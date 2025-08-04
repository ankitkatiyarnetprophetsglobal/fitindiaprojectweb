@extends('layouts.app')
@section('title', 'Fit India Fitness Protocols | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<div class="inner-banner-bg">
<div class="inner-banner-band">
<h1 class="page__title title" id="page-title">Fit India Fitness Protocols</h1>
</div>
</div>
    <div class="container">
        <section id="{{ $active_section_id }}">
            
            <div class="row fitnesrow">
                <div class="col-sm-12 col-md-6 col-lg-6 d-flex ">
                    <div class="fitnesFlex fitnes_card">
                        <div class="poto_img">                
                           <a href="javascript:void(0)" target="_blank">
                                <img src="{{ asset('resources/imgs/protocol/5-18.png') }}" class="img-fluid"  alt="Fitness Protocols and Guidelines"/>
                            </a>
                        </div>
                        <div class="poto_txt">
                            <h2>Fitness Protocols and Guidelines (5-18 yrs)</h2>
                            <p><a class="" href="{{ asset('wp-content/uploads/doc/Fitness Protocols for Age 05-18 Years v1 (English).pdf') }}" target="_blank">Download</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 d-flex ">
                    <div class="fitnesFlex fitnes_card">
                        <div class="poto_img">
                            <a href="javascript:void(0)" target="_blank">
                            <img src="{{ asset('resources/imgs/protocol/5-18.png') }}" class="img-fluid"  alt="5 से 18 साल के लोगों के लिए फिटनेस प्रोटोकॉल"/>
                            </a>
                        </div>
                        <div class="poto_txt">
                            <h2>5 से 18 साल के लोगों के लिए फिटनेस प्रोटोकॉल</h2>
                            <p><a class="" href="{{ asset('wp-content/uploads/doc/Fitness Protocols for Age 05-18 Years  v1 (Hindi).pdf') }}" target="_blank">Download</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 d-flex ">

                <div class="fitnesFlex fitnes_card">
                    <div class="poto_img">
                       <a href="javascript:void(0)" target="_blank" >
                       <img src="{{ asset('resources/imgs/protocol/18-65.png') }}" class="img-fluid"  alt="5 से 18 साल के लोगों के लिए फिटनेस प्रोटोकॉल"/>
                        </a>
                    </div>
                    <div class="poto_txt">
                        <h2>Fitness Protocols and Guidelines (18-65 yrs)</h2>
                        <p><a class="XqQF9c" href="{{ asset('wp-content/uploads/doc/Fitness Protocols for Age 18-65 Years v1 (English).pdf') }}" target="_blank">Download</a></p>
                    </div>
                </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 d-flex ">
                <div class="fitnesFlex fitnes_card">
                    <div class="poto_img">
                        <a href="javascript:void(0)" target="_blank">
                        <img src="{{ asset('resources/imgs/protocol/18-65.png') }}" class="img-fluid"  alt="5 से 18 साल के लोगों के लिए फिटनेस प्रोटोकॉल"/>
                        </a>
                    </div>
                    <div class="poto_txt">
                        <h2>18 से 65 साल के लोगों के लिए फिटनेस प्रोटोकॉल</h2>
                        <p><a class="XqQF9c" href="{{ asset('wp-content/uploads/doc/Fitness Protocols for Age 18-65 Years v1 (Hindi).pdf') }}" target="_blank">Download</a></p>
                    </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 d-flex ">
                    <div class="fitnesFlex fitnes_card">
                        <div class="poto_img">
                            <a href="javascript:void(0)" target="_blank">
                            <img src="{{ asset('resources/imgs/protocol/65above.png') }}" class="img-fluid"  alt="Fitness Protocols and Guidelines (65+ yrs)"/>
                            </a>
                        </div>
                        <div class="poto_txt">
                            <h2>Fitness Protocols and Guidelines (65+ yrs)</h2>
                            <p><a class="XqQF9c" href="{{ asset('wp-content/uploads/doc/Fitness Protocols for Age 65 Years v1 (English).pdf') }}" target="_blank">Download</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 d-flex ">
                    <div class="fitnesFlex fitnes_card">

                    <div class="poto_img">
                        <a href="javascript:void(0)" target="_blank">
                        <img src="{{ asset('resources/imgs/protocol/65above.png') }}" class="img-fluid"  alt="65 साल से अधिक आयु के लोगों के लिए फिटनेस प्रोटोकॉल"/>
                        </a>
                    </div>
                    <div class="poto_txt">
                        <h2>65 साल से अधिक आयु के लोगों के लिए फिटनेस प्रोटोकॉल</h2>
                        <p><a class="XqQF9c" href="{{ asset('wp-content/uploads/doc/Fitness Protocols for Age 65 Years  v1 (Hindi).pdf') }}" target="_blank">Download</a></p>
                    </div>
                    </div>
                </div>
            </div>

        </section>
        </div>
 @endsection