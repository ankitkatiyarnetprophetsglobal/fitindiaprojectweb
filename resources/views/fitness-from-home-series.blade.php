@extends('layouts.app')
@section('title', 'Fitness-From-Home-Sereis | Fit India')
@section('content')
@php
$active_section = request()->segment(count(request()->segments()));
$active_section_id = trim($active_section);
@endphp
<div>

        <img src="resources/imgs/home/fitfromhome.jpg" alt="fitness from home series"
            title="fitness from home series" class="img-fluid expand_img" />
    </div>
    <section id="{{ $active_section_id }}">
        <div class="container">
            <div class="row r-m thumbs-rw">

            <div class="col-sm-6 col-md-3 ">
                    <div class="img-thumb">
                        <a class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/265440021930818/" href="javascript:void(0)" >
                            <img typeof="foaf:Image" src="{{ asset('resources/images/tufail.jpg') }}" alt="Tufail" title="Tufail"
                                class="img-fluid expand_img" />
                        </a>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3 ">
                    <div class="img-thumb">
                        <a class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/777741466259863/" href="javascript:void(0)" >
                            <img typeof="foaf:Image" src="{{ asset('resources/images/heena_bhimani.jpg') }}" alt="Heena Bhimani" title="Heena Bhimani"
                                class="img-fluid expand_img" />
                        </a>
                    </div>
                </div>
                

                <div class="col-sm-6 col-md-3 ">
                    <div class="img-thumb">
                        <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/2582538572039437/">
                            <img typeof="foaf:Image" src="{{ asset('resources/images/Luke_cutinio.jpg') }}" alt="Luke Cutinio" title="Luke Cutinio"
                                class="img-fluid expand_img" />
                        </a>
                        
                    </div>
                </div>

                <div class="col-sm-6 col-md-3 ">
                    <div class="img-thumb">
                        <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/908040326646737/">
                            <img typeof="foaf:Image" src="{{ asset('resources/images/kejal_seth.png') }}" alt="Kajal Seth" title="Kajal Seth"
                                class="img-fluid expand_img" />
                        </a>
                        
                    </div>
                </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/522806158717649/">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/mAnika-batra.jpg') }}" alt="mAnika-batra" title="mAnika-batra"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/188879133083560/?__so__=channel_tab&__rv__=all_videos_card">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/akhada-kushti.jpg') }}" alt="akhada-kushti" title="akhada-kushti"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/889936741574438/">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/thangta.jpg') }}" alt="thangta" title="thangta"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/785734775713683">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/Pooja-Makhija.jpg') }}" alt="Pooja-Makhija" title="Pooja-Makhija"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/482207169758742">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/ronak-gajjar.jpg') }}" alt="ronak-gajjar" title="ronak-gajjar"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/1268715163543543">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/parwage-alam.jpg') }}" alt="parwage-alam" title="parwage-alam"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>


                            <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link=" https://www.facebook.com/FitIndiaOff/videos/176544974361429">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/wanita-ashok-1hjvhjhh.jpg') }}" alt="wanita-ashok-1hjvhjhh" title="wanita-ashok-1hjvhjhh"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>
                    

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link=" https://www.facebook.com/FitIndiaOff/videos/1104873966646058">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/aswini.jpg') }}" alt="aswini" title="aswini"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="  https://www.facebook.com/FitIndiaOff/videos/1521279044885672/">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/kalyaripattuuuuuu.jpg') }}" alt="aswkalyaripattuuuuuuini" title="kalyaripattuuuuuu"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/567544794213968/">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/alister-fernandes.jpg') }}" alt="alister-fernandes" title="alister-fernandes"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/3459084524193102">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/shweta-tewari.jpg') }}" alt="shweta-tewari" title="shweta-tewari"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/168934505056076">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/n.jpg') }}" alt="n" title="n"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/fitness-from-home-with-dr-bhooshan/474522443632845">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/bhooshan.jpg') }}" alt="bhooshan" title="bhooshan"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/fitness-talk-with-rani-rampal/875901729625826">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/rani.jpg') }}" alt="rani" title="rani"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/766454927350483">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/kho-kho.jpg') }}" alt="kho-kho" title="kho-kho"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/532668894412453">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/wanita-ashok.jpg') }}" alt="wanita-ashok" title="wanita-ashok"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/2651549701810094">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/aliya-imran.jpg') }}" alt="aliya-imran" title="aliya-imran"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link=" https://www.facebook.com/FitIndiaOff/videos/fitness-talks-with-apurvi-chandela/317004583208971/">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/apoorvi.jpg') }}" alt="apoorvi" title="apoorvi"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/kabaddi-indigenous-sport-of-india/930653074454838/">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/kabadi2.jpg') }}" alt="kabadi2" title="kabadi2"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/fitness-from-home-with-ronak-gajjar/398962864574104/">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/ronak-gajjar2.jpg') }}" alt="ronak-gajjar2" title="ronak-gajjar2"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/fitness-from-home-with-poonam-lunthi/388841229082901/">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/punam-lunthi.jpg') }}" alt="punam-lunthi" title="punam-lunthi"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/fitness-from-home-with-parwage-alam/347216653497933/">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/parwage-alam2.jpg') }}" alt="parwage-alam2" title="parwage-alam2"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/fitness-from-home-with-alistair-fernandes/1753945981466223">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/alister-fernandes_new.jpg') }}" alt="alister-fernandes`" title="alister-fernandes`"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 ">
                        <div class="img-thumb">
                            <a href="javascript:void(0)" class="getlink"  data-link="https://www.facebook.com/FitIndiaOff/videos/1565906003801107">
                                <img typeof="foaf:Image" src="{{ asset('resources/images/ashok.jpg') }}" alt="ashok" title="ashok"
                                    class="img-fluid expand_img" />
                            </a>
                            
                        </div>
                    </div>


                    
            </div>
        </div>
    </section>



@endsection