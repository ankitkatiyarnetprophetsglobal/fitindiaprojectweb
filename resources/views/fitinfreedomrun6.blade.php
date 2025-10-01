@extends('layouts.app')
@section('title', 'Fit India Swacchta Freedom-Run 5.0 | Fit India')
@section('content')
@php
$active_section = request()->segment(count(request()->segments()));
$active_section_id = trim($active_section);
@endphp
<style>
  /* .table-bordered_cut td,
  .table-bordered_cut th {
    border: 1px solid #757575 !important;
  } */
  table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 15px;

}
</style>
  <div class="banner">
    <div class="row">
        <div class="col-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item mer_banner active">
                      <a href="{{ url('fit-india-freedom-run-6') }}">
                        <img src="{{ asset('resources/imgs/banner-image/fit-india-swacchta-freedom-Run-6.0.jpeg') }}" class="d-block w-100" alt="Fit India Swacchta Freedom-Run 5.0" title="Fit India Swacchta Freedom Run 5.0">
                      </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </div>
<div class="banner_area1">
  <section id="{{ $active_section_id }}">
    <div class="container">
      <div class="row">
        <a class="freedombtn1" href="register?role=Zml0LWluZGlhLWZyZWVkb20tcnVuNg==">Register</a>
        <a class="freedombtn3" href="{{ url('resources/pdf/how-to-register-for-fit-india-swacchta-freedom-run-5.0.pdf') }}" target="_blank">How To Register</a>
        {{-- <a class="freedombtn3 freedombtn4" href="{{ url('freedom-run-5.0-merchandise') }}" data-target="#merchandisId" target="_blank">Merchandise/Creatives</a> --}}
        <a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="{{ url('resources/pdf/SOP-freedom-run-6.pdf') }}" data-target="#merchandisId" target="_blank">SOP</a>
        {{-- <a class="freedombtn3 freedombtn4" style="background-color:#6610f2;" href="{{ url('fit-india-pledge-freedom-run-5') }}" target="_blank">Fit India Pledge</a> --}}
        {{-- <a class="freedombtn3 freedombtn4" style="background-color:#4267B2;" href="{{ url('past-glimpses-freedom-run-5') }}" data-target="#merchandisId" target="_blank">Past Glimpses</a> --}}
      </div>
      <div class="row">
        <div class="col-sm-12">
          <h1 class="headingh1">Fit India Freedom Run 6.0</h1>
            <p>
              <b>2nd October – 31st October 2025</b>
            </p>
            <p>
              The <b>Fit India Freedom Run</b> was first launched in 2020 to inspire citizens to embrace fitness and raise awareness about lifestyle disease prevention. The run encourages people to dedicate at least <b>30 minutes daily to physical activity</b>, while spreading the dual message of <b>Swachhata + Swasthata (Cleanliness + Health)</b>.
            </p>
            <p>
              Now in its <b>6th edition</b>, the <b>Freedom Run 6.0</b> will be held from <b>2nd October (Gandhi Jayanti) to 31st October (National Unity Day)</b>. It is envisioned as the <b>largest fitness and cleanliness Jan Andolan</b> in the country, uniting schools, PSUs, ministries, communities, athletes, and citizens.
            </p>
            <p>
              <b>Objectives</b>
            </p>
            <ul>
                <li>Inspire citizens to engage in <b>30 minutes of daily fitness activity</b>.</li>
                <li>Encourage <b>freedom from lifestyle diseases</b> through mass participation.</li>
                <li>Promote <b>community cleanliness</b> via plogging runs.</li>
                <li>Celebrate <b>National Unity Day (31st Oct)</b> with the Unity Run.</li>
                <li>Embed values of <b>responsibility, fitness, and collective well-being.</b></li>
            </ul>
            <p><b>Event Format</b></p>
            <ul>
                <li><b>Launch (2nd Oct)</b>: National & state-level launch with <i>plog runs, and fitness assemblies.</i></li>
                <li><b>Daily/Weekly Runs (3rd–30th Oct)</b>: Schools, RWAs, PSUs, ministries, and local bodies to host fitness runs, walks, yoga, cycling, and plogging.</li>
                <li><b>Sundays on Cycle (5th, 12th, 19th, 26th Oct)</b>: Special cycling and plogging drives.</li>
                <li><b>Culmination (31st Oct)</b>: The Unity Run across India on <b>National Unity Day</b>.</li>
            </ul>
            <p><b>Registration & Reporting</b></p>
            <ul>
                <li>Institutions must register on the <b>Fit India Portal</b>.</li>
                <li>Upload event details (participants, kms covered, cleanliness drives).</li>
                <li><b>E-certificates</b> auto-generated for participants.</li>
            </ul>
            <p><b>The Freedom Pledge</b></p>
            <p>
                <i>“I pledge to stay fit, encourage my family and community to adopt daily fitness, and keep my surroundings clean. Through fitness and cleanliness, I will contribute to building a healthier, stronger, and united India.”</i>
            </p>
            <p>
                <b>✨ Be a part of India’s largest fitness & cleanliness movement. Run for health. Run for unity. Run for India!</b>
            </p>
        </div>
      </div>





    </div>
</div>
</div>
</section>
@endsection
