@extends('static.layouts.appnet')
@section('title', 'Fit India Test List | Fit India')
@section('content')


    <style>
        @media screen and (max-width:600px){
            .howto-margin{
                margin-top: 70px !important;
            }
        }
        .cards-dv {
            margin-bottom: 15px;
        }

        .scrolling-wrapper {
            overflow-x: scroll;
            overflow-y: hidden;
            white-space: nowrap;
        }

        .scrolling-wrapper .card,
        .nav-tabs.scrolling-wrapper .tab-list {
            display: inline-block;
        }


        .scrolling-wrapper-flexbox {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
        }

        .scrolling-wrapper-flexbox .card {
            flex: 0 0 auto;
            margin-right: 3px;
        }

        .card {
            width: 98%;
            height: auto;
            margin-right: 2px;
        }

        .scrolling-wrapper .card {
            width: 94%;
        }

        .scrolling-wrapper .tab-list {
            width: auto;
            height: auto;
            margin-right: 2px !important;
        }

        /*.scrolling-wrapper .tab-list:last-child {
            margin-right: 0px !important;
         }*/
        .scrolling-wrapper .tab-list a {
            padding: 3px 15px 5px 15px;
        }

        .scrolling-wrapper,
        .scrolling-wrapper-flexbox,
        .nav-tabs.scrolling-wrapper {
            height: auto;
            /*margin-bottom: 10px;*/
            width: 100%;
            -webkit-overflow-scrolling: touch;
        }

        .nav-tabs.scrolling-wrapper {
            margin-bottom: 5px;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        .know-more-banner {
            margin-bottom: 0;
        }

        .know-about-tab>li>a {
            font-size: 14px;
        }
@media(max-width:420px){
#accordion2 .panel-body{padding:10px}
}
    </style>
    <header id="headermasterpage" runat="server">
        <div class="fix-header-app" id="headermaster" runat="server">

            <div class="header-menu-tab" id="navbar1">
                <ul>
                    <li id="mychildren" style="font-size: 14px;" class="busy "><a href="homeaddusers">{{ __('testhome.label802') }}</a></li>
                    <li id="tests" style="font-size: 14px;" class="busy active"><a href="testlist">{{__('testhome.label78')}}</a></li>

                </ul>
                <div class="clearfix"></div>
            </div>


        </div>
        <div id="divloader" runat="server" class="divloader" style="display: none">
            <img src="resources/dotnetimages/ajax-loader.gif" />
        </div>
    </header>


    <div class="know-more-new-col howto-margin">
        <div class="container">


            <div class="mobile_ver">
                <ul class="nav nav-tabs know-about-tab scrolling-wrapper">
                    {{-- <li class="tab-list "><a data-toggle="tab" href="#home1m">5-8 years</a></li>
                    <li class="tab-list "><a data-toggle="tab" href="#menu1m">9-18 years</a></li>
                    <li class="tab-list active "><a data-toggle="tab" href="#menu2m">19-65 years</a></li>
                    <li class="tab-list "><a data-toggle="tab" href="#menu3m">65+ years</a></li> --}}
                    <li class="tab-list "><a data-toggle="tab" href="#home1m">5-8 {{ __('testhome.label32') }}</a></li>
                    <li class="tab-list "><a data-toggle="tab" href="#menu1m">9-18 {{ __('testhome.label32') }}</a></li>
                    <li class="tab-list active "><a data-toggle="tab" href="#menu2m">19-65 {{ __('testhome.label32') }}</a></li>
                    <li class="tab-list "><a data-toggle="tab" href="#menu3m">65+ {{ __('testhome.label32') }}</a></li>
                </ul>
                <div class="tab-content ">
                    <div id="home1m" class="tab-pane know-more-new-tab-section fade">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">

                                <div class="cards-dv">
                                    <div class="card">
                                        <div class="know-more-banner">
                                            <a href="#a" onclick="TestClick(6,1)">

                                                <div class="test-all-banner-col test2-bg">
                                                    <div class="banner-bg-col">

                                                        <div class="banner-text-col">
                                                            <div class="video-icon-col">
                                                                <img
                                                                    src=" {{ url('resources/dotnetimages/video_i.png') }}" />
                                                            </div>
                                                            <div class="test-name">
                                                                <h2>{{ __('testhome.label3') }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="banner-test-img-col">
                                                            <img src="{{ url('resources/dotnetimages/banner-png/bmi.png') }}"
                                                                alt="{{ __('testhome.label3') }}" class="img-responsive">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <p>{{ __('testhome.label1') }}&nbsp;</p>
                                                    </div>
                                                </div>

                                            </a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="cards-dv">
                                    <div class="card">
                                        <div class="know-more-banner">
                                            <a href="#a" onclick="TestClick(59,1)">
                                                <div class="test-all-banner-col test2-bg">
                                                    <div class="banner-bg-col">
                                                        <div class="banner-text-col">
                                                            <div class="video-icon-col">
                                                                <img
                                                                    src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                            </div>
                                                            <div class="test-name">
                                                                <h2>{{ __('testhome.label51') }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="banner-test-img-col">
                                                            <img src="{{ url('resources/dotnetimages/banner-png/tapping.png') }}"
                                                                alt="{{ __('testhome.label3') }}" class="img-responsive">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <p>{{ __('testhome.label52') }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="cards-dv">
                                    <div class="card">
                                        <div class="know-more-banner">
                                            <a href="#a" onclick="TestClick(60,1)">
                                                <div class="test-all-banner-col test2-bg">
                                                    <div class="banner-bg-col">
                                                        <div class="banner-text-col">
                                                            <div class="video-icon-col">
                                                                <img
                                                                    src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                            </div>
                                                            <div class="test-name">
                                                                <h2>{{ __('testhome.label53') }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="banner-test-img-col">
                                                            <img src=" {{ url('resources/dotnetimages/banner-png/FlamingoBalanceTest.png') }}"
                                                                alt="{{ __('testhome.label3') }}" class="img-responsive">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <p>{{ __('testhome.label54') }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="menu1m" class="tab-pane know-more-new-tab-section fade">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="cards-dv">
                                    <div class="card">
                                        <div class="know-more-banner">
                                            <a href="#a" onclick="TestClick(6,2)">
                                                <div class="test-all-banner-col test5-bg">
                                                    <div class="banner-bg-col">

                                                        <div class="banner-text-col">
                                                            <div class="video-icon-col">
                                                                <img
                                                                    src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                            </div>
                                                            <div class="test-name">
                                                                <h2>{{ __('testhome.label3') }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="banner-test-img-col">
                                                            <img src=" {{ url('resources/dotnetimages/banner-png/bmi.png') }}"
                                                                alt="{{ __('testhome.label3') }}" class="img-responsive">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <p>{{ __('testhome.label1') }}&nbsp;</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="cards-dv">
                                    <div class="card">
                                        <div class="know-more-banner">
                                            <a href="#a" onclick="TestClick(8,2)">
                                                <div class="test-all-banner-col test5-bg">
                                                    <div class="banner-bg-col">
                                                        <div class="banner-text-col">
                                                            <div class="video-icon-col">
                                                                <img
                                                                    src=" {{ url('resources/dotnetimages/video_i.png') }}" />
                                                            </div>
                                                            <div class="test-name">
                                                                <h2>{{ __('testhome.label56') }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="banner-test-img-col">
                                                            <img src=" {{ url('resources/dotnetimages/banner-png/sit_reach.png') }}"
                                                                alt="{{ __('testhome.label3') }}" class="img-responsive">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <p>{{ __('testhome.label55') }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="cards-dv">
                                    <div class="card">
                                        <div class="know-more-banner">
                                            <a href="#a" onclick="TestClick(19,2)">
                                                <div class="test-all-banner-col test5-bg">
                                                    <div class="banner-bg-col">
                                                        <div class="banner-text-col">
                                                            <div class="video-icon-col">
                                                                <img
                                                                    src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                            </div>
                                                            <div class="test-name">
                                                                <h2>{{ __('testhome.label57') }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="banner-test-img-col">
                                                            <img src="{{ url('resources/dotnetimages/banner-png/600_M_Run.png') }}"
                                                                alt="{{ __('testhome.label3') }}" class="img-responsive">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <p>{{ __('testhome.label58') }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="cards-dv">
                                    <div class="card">
                                        <div class="know-more-banner">
                                            <a href="#a" onclick="TestClick(54,2)">
                                                <div class="test-all-banner-col test5-bg">
                                                    <div class="banner-bg-col">
                                                        <div class="banner-text-col">
                                                            <div class="video-icon-col">
                                                                <img
                                                                    src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                            </div>
                                                            <div class="test-name">
                                                                <h2>{{ __('testhome.label59') }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="banner-test-img-col">
                                                            <img src="{{ url('resources/dotnetimages/banner-png/Sprint_Dash.png') }}"
                                                                alt="{{ __('testhome.label3') }}" class="img-responsive">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <p>{{ __('testhome.label60') }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="cards-dv">
                                    <div class="card">
                                        <div class="know-more-banner">
                                            <a href="#a" onclick="TestClick(55,2)">
                                                <div class="test-all-banner-col test5-bg">
                                                    <div class="banner-bg-col">
                                                        <div class="banner-text-col">
                                                            <div class="video-icon-col">
                                                                <img
                                                                    src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                            </div>
                                                            <div class="test-name">
                                                                <h2>{{ __('testhome.label61') }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="banner-test-img-col">
                                                            <img src="{{ url('resources/dotnetimages/banner-png/Partial-Curl.png') }}"
                                                                alt="{{ __('testhome.label3') }}" class="img-responsive">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <p>{{ __('testhome.label62') }} </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="cards-dv">
                                    <div class="card">
                                        <div class="know-more-banner">
                                            <a href="#a" onclick="TestClick(57,2)">
                                                <div class="test-all-banner-col test5-bg">
                                                    <div class="banner-bg-col">
                                                        <div class="banner-text-col">
                                                            <div class="video-icon-col">
                                                                <img
                                                                    src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                            </div>
                                                            <div class="test-name">
                                                                <h2>{{ __('testhome.label63') }}</h2>

                                                            </div>
                                                        </div>
                                                        <div class="banner-test-img-col">
                                                            <img src=" {{ url('resources/dotnetimages/banner-png/Muscular_Endurance.png') }}"
                                                                alt="{{ __('testhome.label3') }}" class="img-responsive">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <p>{{ __('testhome.label64') }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>

                    <div id="menu2m" class="tab-pane know-more-new-tab-section fade in active">
                        <div class="row">
                            <div class="col-xs-12 ">
                                <div class="cards-dv">
                                    <div class="card">
                                        <div class="know-more-banner">
                                            <a href="#a" onclick="TestClick(6,3)">
                                                <div class="test-all-banner-col" style="background: #3F96FF">
                                                    <div class="banner-bg-col">
                                                        <div class="banner-text-col">
                                                            <div class="video-icon-col">
                                                                <img
                                                                    src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                            </div>
                                                            <div class="test-name">
                                                                <h2>{{ __('testhome.label3') }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="banner-test-img-col">
                                                            <img src="{{ url('resources/dotnetimages/banner-png/bmi.png') }}"
                                                                alt="{{ __('testhome.label3') }}" class="img-responsive">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <p>{{ __('testhome.label1') }} </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xs-12 ">
                                <div class="cards-dv">
                                    <div class="scrolling-wrapper">
                                        <div class="card">
                                            <div class="know-more-banner">
                                                <a href="#a" onclick="TestClick(60,3)">

                                                    <div class="test-all-banner-col" style="background: #3F96FF">
                                                        <div class="banner-bg-col">

                                                            <div class="banner-text-col">
                                                                <div class="video-icon-col">
                                                                    <img
                                                                        src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                                </div>
                                                                <div class="test-name">
                                                                    <h2>{{ __('testhome.label53') }}</h2>

                                                                </div>
                                                            </div>
                                                            <div class="banner-test-img-col">
                                                                <img src="{{ url('resources/dotnetimages/banner-png/FlamingoBalanceTest.png') }}"
                                                                    alt="Static {{ __('testhome.label54') }}"
                                                                    class="img-responsive">
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <p>{{ __('testhome.label54') }}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="know-more-banner swiper-slide">
                                                <a href="#a" onclick="TestClick(1001,3)">
                                                    <div class="test-all-banner-col" style="background: #3F96FF">
                                                        <div class="banner-bg-col">

                                                            <div class="banner-text-col">
                                                                <div class="video-icon-col">
                                                                    <img
                                                                        src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                                </div>
                                                                <div class="test-name">
                                                                    <h2>{{ __('testhome.label65') }}</h2>

                                                                </div>
                                                            </div>
                                                            <div class="banner-test-img-col">
                                                                <img src="{{ url('resources/dotnetimages/banner-png/tree-pose.png') }}"
                                                                    alt="Static {{ __('testhome.label54') }}"
                                                                    class="img-responsive">
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <p>{{ __('testhome.label54') }}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 ">
                                <div class="cards-dv">
                                    <div class="scrolling-wrapper">
                                        <div class="card">
                                            <div class="know-more-banner">
                                                <a href="#a" onclick="TestClick(55,3)">
                                                    <div class="test-all-banner-col" style="background: #3F96FF">
                                                        <div class="banner-bg-col">

                                                            <div class="banner-text-col">
                                                                <div class="video-icon-col">
                                                                    <img
                                                                        src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                                </div>
                                                                <div class="test-name">
                                                                    <h2>{{ __('testhome.label66') }}</h2>

                                                                </div>
                                                            </div>
                                                            <div class="banner-test-img-col">
                                                                <img src="{{ url('resources/dotnetimages/banner-png/Partial-Curl.png') }}"
                                                                    alt="Partial Curl Up" class="img-responsive">
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <p>{{ __('testhome.label62') }}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="know-more-banner swiper-slide">
                                                <a href="#a" onclick="TestClick(1002,3)">
                                                    <div class="test-all-banner-col" style="background:#3F96FF">
                                                        <div class="banner-bg-col">

                                                            <div class="banner-text-col">
                                                                <div class="video-icon-col">
                                                                    <img
                                                                        src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                                </div>
                                                                <div class="test-name">
                                                                    <h2>{{ __('testhome.label67') }}</h2>
                                                                </div>
                                                            </div>
                                                            <div class="banner-test-img-col">
                                                                <img src="{{ url('resources/dotnetimages/banner-png/Boat-Pose.png') }}"
                                                                    alt="Naukasana" class="img-responsive">
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <p>{{ __('testhome.label62') }}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 ">
                                <div class="cards-dv">
                                    <div class="card">
                                        <div class="know-more-banner">
                                            <a href="#a" onclick="TestClick(57,3)">
                                                <div class="test-all-banner-col" style="background: #3F96FF">
                                                    <div class="banner-bg-col">

                                                        <div class="banner-text-col">
                                                            <div class="video-icon-col">
                                                                <img
                                                                    src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                            </div>
                                                            <div class="test-name">
                                                                <h2>{{ __('testhome.label63') }}</h2>

                                                            </div>
                                                        </div>
                                                        <div class="banner-test-img-col">
                                                            <img src="{{ url('resources/dotnetimages/banner-png/Muscular_Endurance.png') }}"
                                                                alt="Push ups" class="img-responsive">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <p>{{ __('testhome.label64') }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xs-12 ">
                                <div class="cards-dv">
                                    <div class="card">
                                        <div class="know-more-banner">
                                            <a href="#a" onclick="TestClick(1003,3)">
                                                <div class="test-all-banner-col" style="background: #3F96FF">
                                                    <div class="banner-bg-col">

                                                        <div class="banner-text-col">
                                                            <div class="video-icon-col">
                                                                <img
                                                                    src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                            </div>
                                                            <div class="test-name">
                                                                <h2>{{ __('testhome.label68') }}</h2>

                                                            </div>
                                                        </div>
                                                        <div class="banner-test-img-col">
                                                            <img src="{{ url('resources/dotnetimages/banner-png/walk.png') }}"
                                                                alt="Run/Walk" class="img-responsive">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <p>{{ __('testhome.label69') }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xs-12 ">
                                <div class="cards-dv">
                                    <div class="card">
                                        <div class="know-more-banner">
                                            <a href="#a" onclick="TestClick(1004,3)">
                                                <div class="test-all-banner-col" style="background: #3F96FF">
                                                    <div class="banner-bg-col">

                                                        <div class="banner-text-col">
                                                            <div class="video-icon-col">
                                                                <img
                                                                    src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                            </div>
                                                            <div class="test-name">
                                                                <h2>{{ __('testhome.label70') }}</h2>

                                                            </div>
                                                        </div>
                                                        <div class="banner-test-img-col">
                                                            <img src="{{ url('resources/dotnetimages/banner-png/sit_reach.png') }}"
                                                                alt="V-Sit Reach" class="img-responsive">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <p>{{ __('testhome.label55') }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div id="menu3m" class="tab-pane know-more-new-tab-section fade">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="cards-dv">
                                    <div class="card">
                                        <div class="know-more-banner">
                                            <a href="#a" onclick="TestClick(6,4)">
                                                <div class="test-all-banner-col" style="background: #00C198">
                                                    <div class="banner-bg-col">

                                                        <div class="banner-text-col">
                                                            <div class="video-icon-col">
                                                                <img
                                                                    src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                            </div>
                                                            <div class="test-name">
                                                                <h2>{{ __('testhome.label3') }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="banner-test-img-col">
                                                            <img src="{{ url('resources/dotnetimages/banner-png/bmi.png') }}"
                                                                alt="{{ __('testhome.label3') }}" class="img-responsive">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <p>{{ __('testhome.label1') }} </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="cards-dv">
                                    <div class="card">
                                        <div class="know-more-banner">
                                            <a href="#a" onclick="TestClick(1005,4)">
                                                <div class="test-all-banner-col" style="background: #00C198">
                                                    <div class="banner-bg-col">

                                                        <div class="banner-text-col">
                                                            <div class="video-icon-col">
                                                                <img
                                                                    src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                            </div>
                                                            <div class="test-name">
                                                                <h2>{{ __('testhome.label71') }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="banner-test-img-col">
                                                            <img src="{{ url('resources/dotnetimages/banner-png/Chair-Stand.png') }}"
                                                                alt="Chair Stand" class="img-responsive">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <p>{{ __('testhome.label64') }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xs-12">
                                <div class="cards-dv">
                                    <div class="scrolling-wrapper">
                                        <div class="card">
                                            <div class="know-more-banner swiper-slide">
                                                <a href="#a" onclick="TestClick(1006,4)">
                                                    <div class="test-all-banner-col" style="background: #00C198">
                                                        <div class="banner-bg-col">

                                                            <div class="banner-text-col">
                                                                <div class="video-icon-col">
                                                                    <img
                                                                        src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                                </div>
                                                                <div class="test-name">
                                                                    <h2>{{ __('testlist.label101') }}</h2>
                                                                </div>
                                                            </div>
                                                            <div class="banner-test-img-col">
                                                                <img src="{{ url('resources/dotnetimages/banner-png/Chair_Sit-Reach.png') }}"
                                                                    alt="{{ __('testhome.label55') }}"
                                                                    class="img-responsive">
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <p>{{ __('testhome.label55') }}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="know-more-banner swiper-slide">
                                                <a href="#a" onclick="TestClick(1009,4)">
                                                    <div class="test-all-banner-col" style="background: #00C198">
                                                        <div class="banner-bg-col">

                                                            <div class="banner-text-col">
                                                                <div class="video-icon-col">
                                                                    <img
                                                                        src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                                </div>
                                                                <div class="test-name">
                                                                    <h2>{{ __('testlist.label95') }}</h2>

                                                                </div>
                                                            </div>
                                                            <div class="banner-test-img-col">
                                                                <img src="{{ url('resources/dotnetimages/banner-png/back_stratch.png') }}"
                                                                    alt="{{ __('testlist.label95') }}"
                                                                    class="img-responsive">
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <p>{{ __('testhome.label55') }}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="cards-dv">
                                    <div class="card">
                                        <div class="know-more-banner">
                                            <a href="#a" onclick="TestClick(1007,4)">
                                                <div class="test-all-banner-col" style="background: #00C198">
                                                    <div class="banner-bg-col">

                                                        <div class="banner-text-col">
                                                            <div class="video-icon-col">
                                                                <img
                                                                    src="{{ url('resources/dotnetimages/video_i.png') }}" />
                                                            </div>
                                                            <div class="test-name">
                                                                <h2>{{ __('testlist.label113') }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="banner-test-img-col">
                                                            <img src="{{ url('resources/dotnetimages/banner-png/8_step_go_test.png') }}"
                                                                alt="{{ __('testhome.label72') }}"
                                                                class="img-responsive">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <p>{{ __('testhome.label72') }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="cards-dv">
                                    <div class="card">
                                        <div class="know-more-banner">
                                            <a href="#a" onclick="TestClick(1008,4)">
                                                <div class="test-all-banner-col" style="background: #00C198">
                                                    <div class="banner-bg-col">
                                                        <div class="banner-text-col">
                                                            <div class="video-icon-col">
                                                                <img
                                                                    src="  {{ url('resources/dotnetimages/video_i.png') }}" />
                                                            </div>
                                                            <div class="test-name">
                                                                <h2>{{ __('testlist.label119') }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="banner-test-img-col">
                                                            <img src="{{ url('resources/dotnetimages/banner-png/2min_step_test.png') }}"
                                                                alt="2minStepTest" class="img-responsive">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <p>{{ __('testhome.label73') }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>



        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header inner-page-header" style="margin-top: 0px;">
                        <h4 class="modal-title " id="testHeading"></h4>
                        <button type="button" class="close" onclick="closePopup();" aria-label="Close">
                            <!--   <span aria-hidden="true">&times;</span>-->
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="fitness-app-main-col take-test-popup" style="margin-top: 0px;">
                            <div class="">
                                <div class="banner bg-white take-test-margin-auto">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="app-banner-slider">
                                                <div id="carousel-example-generic" class="carousel slide"
                                                    data-ride="carousel">
                                                    <div class="carousel-inner" role="listbox">
                                                        <div class="item active" id="lblVideoSource">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel-group" id="accordion2">

                                            <div class="panel panel-default panel-main">
                                                <div class="panel-heading equipment-col">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion2"
                                                            href="#collapse1" class="collapsed">
                                                            <div class="inner-page-subheading">
                                                                <span>{{ __('testhome.label74') }}</span></div>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse1" class="panel-collapse collapse">
                                                    <div class="panel-body equipment-col"
                                                        id="lblScoringContent">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default panel-main">
                                                <div class="panel-heading scoring-col">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion2"
                                                            href="#collapse2" class="collapsed">
                                                            <div class="inner-page-subheading">
                                                                <span>{{ __('testhome.label75') }}</span></div>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse2" class="panel-collapse collapse">
                                                    <div class="panel-body scoring-col" id="lblEquipmentContent">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default panel-main">
                                                <div class="panel-heading infrastructure-col">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion2"
                                                            href="#collapse3" class="collapsed">
                                                            <div class="inner-page-subheading">
                                                             <span>   {{ __('testhome.label76') }}</span></div>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse3" class="panel-collapse collapse">
                                                    <div class="panel-body infrastructure-col" id="lblMeasureContent">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default panel-main">
                                                <div class="panel-heading perform-col">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion2"
                                                            href="#collapse4" class="collapsed">
                                                            <div class="inner-page-subheading">
                                                              <span>  {{ __('testhome.label77') }}</span></div>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse4" class="panel-collapse collapse">
                                                    <div class="panel-body perform-col" id="lblPerformContent">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="app-test-btn-col">
                                <div class="row">
                                    <div class="col-xs-5 col-sm-3 col-md-3 col-lg-2"></div>
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <div class="btn-action">
                                            <a href="#a" class="btn btnTI app-Next-btn no-thanks-btn teext-color"
                                                onclick="gotohometest()" style="margin-bottom: 0px">{{ __('testhome.label8') }}</a>
                                            {{-- <a href="#a" class="btn app-Next-btn btnTI no-thanks-btn"
                                                onclick="closePopup();" style="margin-bottom: 0px">{{ __('taketest.label127') }}</a> --}}
                                            <a href="testlist" class="btn app-Next-btn btnTI no-thanks-btn" style="margin-bottom: 0px">{{ __('taketest.label127') }}</a>
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
    <script type="text/javascript">
        var script = document.createElement('script');
        var h = "hello";
        var lang="{{ Session::get('lang') }}";
        
        if (lang=='hn') {
            script.src = "{{ asset('public/js_data/hi/label.js') }}"
        }
        if(lang=='en'){
            script.src = "{{ asset('public/js_data/en/label.js') }}" 
        }

        document.head.appendChild(script);
        var ParentUserName="{{$ParentUserName}}";
        var ParentUserId="{{$ParentUserId}}";
        var ParentUserAgeGroupId="{{$ParentUserAgeGroupId}}";
        var ParentUserGenderId="{{$ParentUserGenderId}}";
        var ParentUserAgeGroupName="{{$ParentUserAgeGroupName}}";
        var ParentUserAge="{{$ParentUserAge}}";
    

        function gotohometest() {
            //window.location.href = "Home.aspx";
           
       
            window.location.href = `taketest/?Name=${ParentUserName}&F365Id=${ParentUserId}&Age=${ParentUserAge}&AgeGroupId=${ParentUserAgeGroupId}&AgeGroupName=${ParentUserAgeGroupName}&GenderId=${ParentUserGenderId}`;
        }
    </script>

    <script>
       
        $(document).ready(function() {
            $('#navbar1').css('display', 'block');
            $('#landingdescription').css('display', 'block');
            $('#mychildren').removeClass("active");
            $('#tests').addClass("active");
            $('#tips').removeClass("active");
        });

        function goBack() {
            window.location.href="{{ url('homeaddusers') }}";
        }

        

        function TestClick(id, agid) {
            

            //  $.ajaxSetup({
            //     headers: {
            //              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //               }
            //      });
            $.ajax({
                type: "POST",
                url: "{{ url('TestListaspx/GetInstructiontPopup') }}",
                //data: '{"TestTypeId":"' + id + '","AgeGroupId":"' + agid + ' _token: $('meta[name="csrf-token"]').attr('content')"}',
                data: {
                    TestTypeId: id,
                    AgeGroupId: agid,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {
                //    console.log(response);

                    if (response.data != null && response.data.length > 0) {
                      
                        let text1 = label_data[response.data[0].VideoSource];

                        $('#lblVideoSource').html(label_data[response.data[0].VideoSource]);
                        // $('#lbl{{ __('testhome.label74') }}Content').html(label_data[response.data[0].{{ __('testhome.label74') }}Content]);
                        $('#lblScoringContent').html(label_data[response.data[0].ScoringContent]);
                        $('#lblEquipmentContent').html(label_data[response.data[0].EquipmentContent]);
                        $('#lblMeasureContent').html(label_data[response.data[0].MeasureContent]);

                        $('#lblPerformContent').html(label_data[response.data[0].PerformContent]);
                        if(response.data[0].AgeGroupId==1 && response.data[0].TestTypeId==60){
                        $('#lblHeading').html(label_data["label77"]);
                        $('#testHeading').html(label_data['label77']);
                        }else if(response.data[0].AgeGroupId==1 && response.data[0].TestTypeId==59){
                           
                            $('#lblHeading').html(label_data["label505"]);
                            $('#testHeading').html(label_data["label505"]);
                        } else if(response.data[0].AgeGroupId==2 && response.data[0].TestTypeId==8){
                            
                            $('#lblHeading').html(label_data["label506"]);
                            $('#testHeading').html(label_data["label506"]);
                        }
                        else if(response.data[0].AgeGroupId==2 && response.data[0].TestTypeId==19){
                            
                            $('#lblHeading').html(label_data["label507"]);
                            $('#testHeading').html(label_data["label507"]);
                        }
                        else if(response.data[0].AgeGroupId==2 && response.data[0].TestTypeId==54){
                            
                            $('#lblHeading').html(label_data["label508"]);
                            $('#testHeading').html(label_data["label508"]);
                        }
                        else if(response.data[0].AgeGroupId==2 && response.data[0].TestTypeId==55){
                            
                            $('#lblHeading').html(label_data["label509"]);
                            $('#testHeading').html(label_data["label509"]);
                        }
                        else if(response.data[0].AgeGroupId==2 && response.data[0].TestTypeId==57){
                            
                            $('#lblHeading').html(label_data["label510"]);
                            $('#testHeading').html(label_data["label510"]);
                        }


                        else{
                        $('#lblHeading').html(label_data[response.data[0].Heading]);
                        $('#testHeading').html(label_data[response.data[0].Heading]);
                        }

                        $('#myModal').modal('show');
                    } else {}
                },
                failure: function(data) {
                   
                }
            });
        }

        function closePopup() {
            $('#myModal').modal('hide');
            $('#lblVideoSource').html("");
        }


        $(".busy").click(function() {
            beginLoader();
        });


        function beginLoader() {
            $("#divloader").css('display', 'block');
        }
    </script>

@endsection
