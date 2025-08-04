@extends('layouts.app')
@section('title', 'indigenous Sports | Fit India')
@section('content')
@php
$active_section = request()->segment(count(request()->segments()));
$active_section_id = trim($active_section);
@endphp

    <div>
        <img src="{{ asset('resources/images/indegenous-banner-new.jpg') }}" alt="indegenous Sport"
            title="Indegenous Sports of India" class="img-fluid expand_img" />
    </div>

    <section id="{{ $active_section_id }}">
        <div class="container">

            <div class="row r-m thumbs-rw">

                <div class="col-sm-6 col-md-4">
                    <div class="img-thumb ind_parent">
                        <a href="https://www.youtube.com/watch?v=BBWhR-PmHBs&t=18s" target="_blank">
                            <img src="{{ asset('resources/images/Akhada-Kushti_thumb.jpg') }}" alt="Akhada Kushti" title="Akhada Kushti: Indegenous Sports of India"
                                class="img-fluid expand_img" />
                                 <i class="fa fa-youtube-play" aria-hidden="true"></i>
                        </a>
                       
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="img-thumb ind_parent">
                        <a href="https://www.youtube.com/watch?v=ih7TkQ23iV4" target="_blank">
                            <img src="{{ asset('resources/images/Thang-Ta_thumb.jpg') }}" alt="Thang Ta" title="Thang Ta: Indegenous Sports of India"
                                class="img-fluid expand_img" />
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                        </a>

                    </div>
                </div>
                <div class="col-sm-6 col-md-4 ">
                    <div class="img-thumb ind_parent">
                        <a href="https://www.youtube.com/watch?v=9G0SU6BjZhA" target="_blank">
                            <img src="{{ asset('resources/images/Kalaripyattu_thumb.jpg') }}" alt="Kalaripyattu" title="Kalaripyattu: Indegenous Sports of India"
                                class="img-fluid expand_img" />
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="img-thumb ind_parent">
                        <a href="https://www.youtube.com/watch?v=OHgMXUInh3s" target="_blank">
                            <img src="{{ asset('resources/images/Kho-Kho_thumb.jpg') }}" alt="Kho Kho" title="Kho Kho: Indegenous Sports of India"
                                class="img-fluid expand_img" />
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="img-thumb ind_parent">
                        <a href="https://www.youtube.com/watch?v=iZ4oMINDXek" target="_blank">
                            <img src="{{ asset('resources/images/Tug-of-War_thumb.jpg') }}" alt="Tug of War" title="Tug of War: Indegenous Sports of India"
                                class="img-fluid expand_img" />
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="img-thumb ind_parent">
                        <a href="https://www.youtube.com/watch?v=LGTVHHIACFo" target="_blank">
                            <img src="{{ asset('resources/images/malakhamba_sports.png') }}" alt="Mallakhamb" title="Mallakhamb: Indegenous Sports of India"
                                class="img-fluid expand_img" />
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="img-thumb ind_parent">
                        <a href="https://www.youtube.com/watch?v=R0owRj4WoR8" target="_blank">
                            <img src="{{ asset('resources/images/Hekko_thumb.jpg') }}" alt="Hekko" title="Hekko: Indegenous Sports of India"
                                class="img-fluid expand_img" />
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="img-thumb ind_parent">
                        <a href="https://www.youtube.com/watch?v=Gug_Gk8qvec" target="_blank">
                            <img src="{{ asset('resources/images/Sqay_thumb.jpg') }}" alt="Sqay" title="Sqay: Indegenous Sports of India"
                                class="img-fluid expand_img" />
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="img-thumb ind_parent ind_parent">
                        <a href="https://www.youtube.com/watch?v=tZQ94En-Nkc" target="_blank">
                            <img src="{{ asset('resources/images/Chhau_thumb.jpg') }}" alt="Chhau and Paika Akhada" title="Chhau and Paika Akhada: Indegenous Sports of India"
                                class="img-fluid expand_img" />
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="img-thumb ind_parent">
                        <a href="https://www.youtube.com/watch?v=bCGwcOU0Dok" target="_blank">
                            <img src="{{ asset('resources/images/Kabaddi_thumb.jpg') }}" alt="Kabaddi" title="Kabaddi: Indegenous Sports of India"
                                class="img-fluid expand_img" />
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="img-thumb ind_parent">
                        <a href="https://www.youtube.com/watch?v=hN7GuNCxr0A" target="_blank">
                            <img src="{{ asset('resources/images/Shooting-Ball_thumb.jpg') }}" alt="Shooting Ball" title="Shooting Ball: Indegenous Sports of India"
                                class="img-fluid expand_img" />
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="img-thumb ind_parent">
                        <a href="https://www.youtube.com/watch?v=snwC2_-SfH8" target="_blank">
                            <img src="{{ asset('resources/images/Lagori_thumb.jpg') }}" alt="Lagori and Lagadi" title="Lagori and Lagadi: Indegenous Sports of India"
                                class="img-fluid expand_img" />
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="img-thumb ind_parent">
                        <a href="https://www.youtube.com/watch?v=dOKKma9uRsk" target="_blank">
                            <img src="{{ asset('resources/images/Gatka_thumb.jpg') }}" alt="Gatka" title="Gatka: Indegenous Sports of India"
                                class="img-fluid expand_img" />
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="img-thumb ind_parent">
                        <a href="https://www.youtube.com/watch?v=QXzUGR-gD9g" target="_blank">
                            <img src="{{ asset('resources/images/Roll-ball_thumb.jpg') }}" alt="Roll Ball" title="Roll Ball: Indegenous Sports of India"
                                class="img-fluid expand_img" />
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="img-thumb ind_parent">
                        <a href="https://www.youtube.com/watch?v=x9zf4iOmuO4" target="_blank">
                            <img src="{{ asset('resources/images/Dhoop-khel_thumb.jpg') }}"
                                alt="Dhoop Khel and Cowrie khel"   title="Dhoop Khel and Cowrie khel: Indegenous Sports of India" class="img-fluid expand_img" />
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                            </a>
                    </div> 
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="img-thumb ind_parent">
                        <a href="https://www.youtube.com/watch?v=grMGQ3JA4TY" target="_blank">
                            <img src="{{ asset('resources/images/Silambam_thumb.jpg') }}" alt="Silambam"  title="Silambam: Indegenous Sports of India"
                                class="img-fluid expand_img" />
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="img-thumb ind_parent">
                        <a href="https://www.youtube.com/watch?v=wjbZzxShG_g" target="_blank">
                            <img src="{{ asset('resources/images/Sikkim-Archery_thumb.jpg') }}" alt="Sikkim Archery" title="Sikkim Archery: Indegenous Sports of India"
                                class="img-fluid expand_img" />
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                            </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="img-thumb ind_parent">
                        <a href="https://www.youtube.com/watch?v=3OFeG3bgNZo" target="_blank">
                            <img src="{{ asset('resources/images/Gilli-danda_thumb.jpg') }}" alt="Gilli Danda" title="Gilli Danda: Indegenous Sports of India"
                                class="img-fluid expand_img" />
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                            </a>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="img-thumb ind_parent">
                        <a href="https://www.youtube.com/watch?v=PV2JVT-bcAE" target="_blank">
                            <img src="{{ asset('resources/images/Sports-of-Mizoram_thumb.jpg') }}"
                                alt="Sports of Mizoram" class="img-fluid expand_img"  title="Sports of Mizoram: Indegenous Sports of India" />
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection