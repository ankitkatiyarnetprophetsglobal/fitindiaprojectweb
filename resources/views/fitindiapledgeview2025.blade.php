@extends('layouts.app')
@section('title', 'National Sports Day 2025 | Fit India')
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
    <section>
        <div class="container">
            <div class="row">
                <!-- Buttons for each language -->
                <button class="freedombtn1 langBtn" data-lang="assamese">Assamese</button>
                <button class="freedombtn1 langBtn" data-lang="bengali">Bengali</button>
                <button class="freedombtn1 langBtn" data-lang="bodo">Bodo</button>
                <button class="freedombtn1 langBtn" data-lang="dogri">Dogri</button>
                <button class="freedombtn1 langBtn active" data-lang="english">English</button>
                <button class="freedombtn1 langBtn" data-lang="gujarati">Gujarati</button>
                <button class="freedombtn1 langBtn" data-lang="hindi">Hindi</button>
                <button class="freedombtn1 langBtn" data-lang="kannada">Kannada</button>
                <button class="freedombtn1 langBtn" data-lang="kashmiri">Kashmiri</button>
                <button class="freedombtn1 langBtn" data-lang="konkani">Konkani</button>
                <button class="freedombtn1 langBtn" data-lang="manipuri">Manipuri</button>
                <button class="freedombtn1 langBtn" data-lang="marathi">Marathi</button>
                <button class="freedombtn1 langBtn" data-lang="maithili">Maithili</button>
                <button class="freedombtn1 langBtn" data-lang="malayalam">Malayalam</button>
                <button class="freedombtn1 langBtn" data-lang="nepali">Nepali</button>
                <button class="freedombtn1 langBtn" data-lang="odia">Odia</button>
                <button class="freedombtn1 langBtn" data-lang="punjabi">Punjabi</button>
                <button class="freedombtn1 langBtn" data-lang="sanskrit">Sanskrit</button>
                <button class="freedombtn1 langBtn" data-lang="tamil">Tamil</button>
                <button class="freedombtn1 langBtn" data-lang="telugu">Telugu</button>
                <button class="freedombtn1 langBtn" data-lang="santali">Santali</button>
                <button class="freedombtn1 langBtn" data-lang="urdu">Urdu</button>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="headingh1">FIT INDIA PLEDGE </h1>
                    {{-- <h2 id="langLabel" style="font-weight:bold; text-align:center; margin-top:10px;">English</h2> --}}

                    <!-- Div with Image -->
                    <div id="pledgeBox">
                        <p>
                            <img id="pledgeImage"
                                 src="{{ asset('resources/imgs/pledge/2025/Pledge-English.png') }}"
                                 class="d-block w-100"
                                 alt="Fit India Pledge English"
                                 title="Fit India Pledge English">
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .langBtn.active {
        background-color: #fd7e14 !important; /* Orange background */
        color: #fff !important;              /* White text */
        border: 2px solid #fd7e14;           /* Same orange border */
    }
</style>

<script>
$(document).ready(function () {
    // Image mapping by language (all keys lowercase)
    let langMap = {
        assamese: { name: "Assamese", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Assamese.png') }}" },
        bengali: { name: "Bengali", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Bengali.png') }}" },
        dogri: { name: "Dogri", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Dogri.png') }}" },
        gujarati: { name: "Gujarati", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Gujarati.png') }}" },
        kannada: { name: "Kannada", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Kannada.jpeg') }}" },
        kashmiri: { name: "Kashmiri", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Kashmiri.png') }}" },
        konkani: { name: "Konkani", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Konkani.png') }}" },
        manipuri: { name: "Manipuri", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Manipuri.jpeg') }}" },
        marathi: { name: "Marathi", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Marathi.png') }}" },
        nepali: { name: "Nepali", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Nepali.png') }}" },
        odia: { name: "Odia", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Odia.png') }}" },
        punjabi: { name: "Punjabi", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Punjabi.png') }}" },
        sanskrit: { name: "Sanskrit", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Sanskrit.png') }}" },
        tamil: { name: "Tamil", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Tamil.png') }}" },
        telugu: { name: "Telugu", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Telugu.png') }}" },
        bodo: { name: "Bodo", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Bodo.png') }}" },
        english: { name: "English", src: "{{ asset('resources/imgs/pledge/2025/Pledge-English.png') }}" },
        hindi: { name: "Hindi", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Hindi.png') }}" },
        maithili: { name: "Maithili", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Maithili.png') }}" },
        malayalam: { name: "Malayalam", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Malayalam.png') }}" },
        santali: { name: "Santali", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Santali.jpeg') }}" },
        urdu: { name: "Urdu", src: "{{ asset('resources/imgs/pledge/2025/Pledge-Urdu.png') }}" }
    };

    // On language button click
    $(".langBtn").on("click", function () {
        let lang = $(this).data("lang").toLowerCase();

        if (langMap[lang]) {
            // Update image + label
            $("#pledgeImage").attr("src", langMap[lang].src)
                             .attr("alt", "Fit India " + langMap[lang].name)
                             .attr("title", "Fit India " + langMap[lang].name);

            $("#langLabel").text(langMap[lang].name);
        } else {
            alert("Image not available for this language yet.");
        }

        // Highlight active button
        $(".langBtn").removeClass("active");
        $(this).addClass("active");
    });
});
</script>



@endsection
