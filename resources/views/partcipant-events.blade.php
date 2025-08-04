@extends('layouts.app')
@section('title', 'Partcipant Events | Fit India')
@section('content')
@php
$active_section = request()->segment(count(request()->segments()));
$active_section_id = trim($active_section);
@endphp
    <!-- <div>

        <img src="resources/imgs/home/fitfromhome.jpg" alt="pari"
            title="fitness from home series" class="img-fluid expand_img" />
    </div> -->
    <section id="{{ $active_section_id }}">

        <div class="container">
            <div class="row r-m thumbs-rw">

                <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="fitnessprotocols" >
                                <img src="{{ asset('resources/images/protocol2.jpg') }}" alt="protocol2" title="protocol2"
                                    class="img-fluid expand_img" />
                            </a>
                        </div>
                </div>    

                <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                                <a href="fit-india-yoga-centres" >
                                    <img src="{{ asset('resources/images/yoganew.jpg') }}" alt="yoganew" title="yoganew"
                                        class="img-fluid expand_img" />
                                </a>
                            
                
                        </div> 
                </div>

                <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                                <a href="fitness-from-home-series" >
                                    <img src="{{ asset('resources/images/home2.jpg') }}" alt="fitness-from-home-series" title="fitness-from-home-series"
                                        class="img-fluid expand_img" />
                                </a>
                        </div>
                </div>

                <div class="col-sm-6 col-md-3 ">
                    <div class="img-thumb">
                                <a href="your-stories" >
                                    <img src="{{ asset('resources/images/story2.jpg') }}" alt="story2" title="story2"
                                        class="img-fluid expand_img" />
                                </a>
                        </div>
                    

                    </div>
                </div>
                
           </div> 

        </div>
        
    </section>



@endsection