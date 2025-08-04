@extends('static.layouts.appnet')
@section('title', 'Fit India Take Test | Fit India')
@section('content')


<style>
        p{
            white-space: initial !important;
        }
        @media screen and (max-width:767px){
            .custom-fix-button{
           padding-right: 5px;
            padding-top:13px;
        }
        }
        .last-updated-test img {
            width: auto;
            margin-top: -2px;
            margin-right: 2px;
            background: #f2926d;
            padding: 1px;
            border-radius: 15px;
        }

        .modal-header .close {
            padding: 0px 0px;
            background: transparent;
            border: 0px;
            position: absolute;
            top: -9px;
            right: 16px;
            left: auto !important;
            float: left !important;
            width: 30px;
            color: #240C00;
        }

        .cross {
            font-size: 50px;
        }

        .swiper-container {
            width: 98%;
            height: 100%;
        }

        /* .swiper-slide a{width:98%;display:block;}*/
        .test-name h2 {
            text-align: left;
        }

        .test-name p {
            text-align: left;
        }

        .scrolling-wrapper {
            overflow-x: scroll;
            overflow-y: hidden;
            /*white-space: nowrap;*/
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
            width: 300px;
            height: auto;
            margin-right: 10px;
        }

        .scrolling-wrapper .card1 {
            display: inline-block;
            width: 90%;
        }

        .card1 {
            width: 100%;
            height: auto;
            margin-right: 10px;
            flex-shrink: 0;
        }

        .scrolling-wrapper-flexbox .card1 {
            flex: 0 0 auto;
            margin-right: 3px;
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
            margin-bottom: 0px;
            width: 100%;
            -webkit-overflow-scrolling: touch;
            display: flex;
        }

        .nav-tabs.scrolling-wrapper {
            margin-bottom: 0px;
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

        @media(max-width:575px) {
            .test-info-col img.test-img {
                width: auto;
                margin-top: 10px;
            }

            .test-info-col img.demo-test {
                top: -10px;
            }
        }
        .form-group{
            padding-right: 5px !important;
        }
        
    </style>

    <div class="all-text-dv">
        <div class="inner-page-header fixed-header">
            <div class="container back-btn-set">
                <button class="header-back-btn" onclick="goBack()">
                    <img src="{{ url('resources/dotnetimages/switch-user.png') }}" /></button>
                <h4 class="take-testheader">
                    <p class="header-child-name"><span id="testuser" runat="server">{{ $_GET['Name'] }}


                        </span></p>
                    {{-- <%-- <%= Resources.ResourceMaster.label16 ' --}}
                    <h4></h4>
                    <h4></h4>
                    <h4></h4>
                </h4>
            </div>
        </div>


        @php

            $arraytestid = [];
            foreach ($data as $value) {
                array_push($arraytestid, $value->TestTypeId);
            }

        @endphp

        <div class="know-more-new-col take-test-top-margin">
            <div class="container">
                <div class="row" id="testBind" runat="server" style="margin-top: 25px;" >

                    {{-- <%--New Tests for 5-8 yrs--' --}}
                    <div class="col-xs-12 col-sm-6 col-md-6 text-bdr-btm" id="dvBMI" runat="server"
                        style="display:block">
                        <div class="take-test-banner">
                            <div class="test-heading-col">
                                <div class="test-heading">
                                    <h4>{{ __('testhistory.label3') }}</h4>
                                    <p>{{ __('taketest.label131') }}</p>
                                </div>
                                <div class="test-info-col">

                                    <a href="javascript:void(0);" class="info-btn" onclick="TestClick(6)">
                                        <img src="{{ url('resources/dotnetimages/bmi.png') }}" style="width: 55%;" class="test-img" />
                                        <img src="{{ url('resources/dotnetimages/test_play.png') }}" class="demo-test" />
                                    </a>


                                </div>
                                <div class="clearfix"></div>
                                @php
                                    foreach ($data as $value) {
                                        if ($value->TestTypeId == '7') {
                                            $height = $value->Score / 10;
                                            break;
                                        }
                                    }

                                @endphp

                                @php $i=0;@endphp
                                @foreach ($data as $value)
                                    @php ++$i @endphp
                                    @if ($value->TestTypeId == '6')
                                        <div class="last-updated-test" id="upBMI" runat="server" style="display:block">
                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }}

                                            <span class="last-score" id="upScoreBMI"
                                                runat="server">{{ $height . ' ' . 'cm' . ' ' . ',' . $value->Score / 1000 . ' ' . 'Kg' }}</span>
                                            <span class="last-time" id="upTimeBMI"
                                                runat="server">{{ '[' . $value->TIME . ']' }}</span>
                                        </div>
                                    @elseif($i == 1 && in_array('6', $arraytestid) == false)
                                        <div class="last-updated-test" id="upBMI" runat="server" style="display:none">
                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }}

                                            <span class="last-score" id="upScoreBMI" runat="server"></span>
                                            <span class="last-time" id="upTimeBMI" runat="server"></span>
                                        </div>
                                    @endif
                                @endforeach
                                @if ($data == [])
                                    <div class="last-updated-test" id="upBMI" runat="server" style="display:none">
                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                        {{ __('taketest.label3') }}

                                        <span class="last-score" id="upScoreBMI" runat="server"></span>
                                        <span class="last-time" id="upTimeBMI" runat="server"></span>
                                    </div>
                                @endif

                            </div>

                            <div class="take-test-section">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p class="mob-space">&nbsp;</p>
                                    </div>
                                    <div
                                        class="col-xs-4 col-sm-4 padding-right take-test-input-col take-test-input-first-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label4') }}</label>
                                            <input type="number" id='HeightBMI' placeholder="000" maxlength="3"
                                                Class='form-control' />
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 padding-right take-test-input-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label5') }}</label>
                                            <input type="number" id='WeightBMI' runat='server' Placeholder="00.00"
                                                maxlength="5" Class='form-control' type="number" />
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 take-test-btn-col">
                                        <div class="form-group">
                                            <label for="usr">&nbsp;</label>
                                            <button id='Button2' runat='server'
                                                class='take-test-save-btn'>{{ __('taketest.label6') }}</button>
                                        </div>
                                    </div>
                                    <div id="BMIerr" runat="server" class="col-xs-12 col-sm-12" style="display: none">
                                        <div class="error-msg-col">
                                            <div class="error-icon">
                                            </div>
                                            <div class="error-msg" id="lblerrorBMI" runat="server"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-6 text-bdr-btm" id="dvPlateTap" runat="server"
                        style="display:none">

                        <div class="take-test-banner">
                            <div class="test-heading-col">
                                <div class="test-heading">
                                    <h4>{{ __('userdashboard.label54') }}</h4>
                                    <p>{{ __('userdashboard.label46') }}</p>

                                </div>
                                <div class="test-info-col">

                                    <a href="javascript:void(0);" class="info-btn" onclick="TestClick(59)">
                                        <img src="{{ url('resources/dotnetimages/tapping.png') }}" class="test-img" />
                                        <img src="{{ url('resources/dotnetimages/test_play.png') }}"
                                            class="demo-test" /></a>



                                </div>
                                <div class="clearfix"></div>
                                @php $i=0;@endphp
                                @foreach ($data as $value)
                                    @php ++$i @endphp
                                    @if ($value->TestTypeId == '59')
                                        <div class="last-updated-test" id="upPlate" runat="server"
                                            style="display:block">
                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }} <span class="last-score" id="upScorePlate"
                                                runat="server">{{ substr(($value->Score * 1.666667) / 100000, 0, 4) . ' ' . 'Min' }}</span><span class="last-time" id="upTimePlate"
                                                runat="server">>{{ '[' . $value->TIME . ']' }}</span>



                                        </div>
                                    @elseif($i == 1 && in_array('59', $arraytestid) == false)
                                        <div class="last-updated-test" id="upPlate" runat="server"
                                            style="display: none">
                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }} <span class="last-score" id="upScorePlate"
                                                runat="server"></span><span class="last-time" id="upTimePlate"
                                                runat="server"></span>
                                        </div>
                                    @endif
                                @endforeach
                                @if ($data == [])
                                    <div class="last-updated-test" id="upPlate" runat="server" style="display: none">
                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                        {{ __('taketest.label3') }} <span class="last-score" id="upScorePlate"
                                            runat="server"></span><span class="last-time" id="upTimePlate"
                                            runat="server"></span>
                                    </div>
                                @endif
                            </div>

                            <div class="take-test-section">

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>{{ __('taketest.label10') }}</p>
                                    </div>
                                    <div
                                        class="col-xs-3 col-sm-3 padding-right take-test-input-col take-test-input-first-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label11') }}</label>
                                            <input id='MinPlate' Placeholder="00" maxlength="2" runat='server'
                                                onchange="MinPlateCheck();" Class='form-control' type="number" />
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 padding-right take-test-input-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label12') }}</label>
                                            <input id='SecPlate' Placeholder="00" maxlength="2" runat='server'
                                                onchange="SecPlateCheck()" Class='form-control' type="number" />
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 padding-right take-test-input-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label13') }}</label>
                                            <input id='msPlate' Placeholder="000" runat='server' maxlength="4"
                                                onchange="msPlateCheck();" Class='form-control' type="number" />
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-sm-4 take-test-btn-col">
                                        <div class="form-group">
                                            <label for="usr">&nbsp;</label>
                                            <button id='btnPlate' runat='server'
                                                class='take-test-save-btn'>{{ __('taketest.label6') }}</button>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12" style="display: none" id="errPlate"
                                        runat="server">
                                        <div class="error-msg-col">
                                            <div class="error-icon">
                                            </div>
                                            <div class="error-msg" id="lblerrPlate" runat="server"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                </div>


                            </div>

                        </div>

                    </div>

                    <div class="col-xs-12">
                        <div id="grouptest1" runat="server">
                            {{-- class="group-test"-- --}}
                            <span id="onlyone2" runat="server" class="take-any-one-test"
                                style="display:none">{{ __('taketest.onlyone') }}</span>
                            <div id="divscroll2" runat="server" class="scrolling-wrapper">
                                <div class=" text-bdr-btm card1" id="dvFlamingo" runat="server" style="display:none">

                                    <div class="take-test-banner ">
                                        <div class="test-heading-col">
                                            <div class="test-heading">
                                                <h4>{{ __('userdashboard.label55') }}</h4>
                                                <p>{{ __('userdashboard.label47') }}</p>

                                            </div>
                                            <div class="test-info-col">

                                                <a href="javascript:void(0);" class="info-btn" onclick="TestClick(60)">
                                                    <img src="{{ url('resources/dotnetimages/FlamingoBalanceTest.png') }}"
                                                        class="test-img" />
                                                    <img src="{{ url('resources/dotnetimages/test_play.png') }}"
                                                        class="demo-test" /></a>


                                            </div>
                                            <div class="clearfix"></div>
                                            @php $i=0;@endphp
                                            @foreach ($data as $value)
                                                @php ++$i @endphp
                                                @if ($value->TestTypeId == '60')
                                                    <div class="last-updated-test" id="upFlamingo" runat="server"
                                                        style="display: block">
                                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                                        {{ __('taketest.label3') }} <span class="last-score"
                                                            id="upScoreFlamingo" runat="server">{{ $value->Score.' '.'Times' }}</span><span
                                                            class="last-time" id="upTimeFlamingo"
                                                            runat="server">>{{ '[' . $value->TIME . ']' }}</span>
                                                    </div>
                                                @elseif($i == 1 && in_array('60', $arraytestid) == false)
                                                    <div class="last-updated-test" id="upFlamingo" runat="server"
                                                        style="display: none">
                                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                                        {{ __('taketest.label3') }} <span class="last-score"
                                                            id="upScoreFlamingo" runat="server"></span><span
                                                            class="last-time" id="upTimeFlamingo" runat="server"></span>
                                                    </div>
                                                @endif
                                            @endforeach
                                            @if ($data == [])
                                                <div class="last-updated-test" id="upFlamingo" runat="server"
                                                    style="display: none">
                                                    <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                                    {{ __('taketest.label3') }} <span class="last-score"
                                                        id="upScoreFlamingo" runat="server"></span><span
                                                        class="last-time" id="upTimeFlamingo" runat="server"></span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="take-test-section">

                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12">
                                                    <p class="mob-space">&nbsp;</p>
                                                </div>
                                                <div
                                                    class="col-xs-8 col-sm-8 padding-right take-test-input-col take-test-input-first-col">
                                                    <div class="form-group">
                                                        <label for="usr">{{ __('taketest.label18') }}</label>
                                                        <input id='countFlamingo' maxlength="3" Placeholder="00"
                                                            runat='server' onchange="countFlamingoCheck();"
                                                            Class='form-control' type="number" />
                                                    </div>
                                                </div>

                                                <div class="col-xs-4 col-sm-4 take-test-btn-col">
                                                    <div class="form-group" style="padding-right: 5px;">
                                                        <label for="usr">&nbsp;</label>
                                                        <button id='btnFlamingo' runat='server' style="margin-top:0px;"
                                                            class='take-test-save-btn'>{{ __('taketest.label6') }}</button>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-12" style="display: none" id="errFlamingo"
                                                    runat="server">
                                                    <div class="error-msg-col">
                                                        <div class="error-icon">
                                                        </div>
                                                        <div class="error-msg" id="lblerrFlamingo" runat="server">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>

                                </div>
                                <div class=" text-bdr-btm swiper-slide card1" id="dvVrikshasana" runat="server"
                                    style="display:none">
                                    <div class="take-test-banner ">

                                        <div class="test-heading-col">
                                            <div class="test-heading">
                                                <h4>{{ __('userdashboard.label78') }}</h4>
                                                <p>{{ __('userdashboard.label47') }}</p>
                                            </div>

                                            <div class="test-info-col">

                                                <a href="javascript:void(0);" class="info-btn" onclick="TestClick(1001)">
                                                    <img src="{{ url('resources/dotnetimages/tree-pose.png') }}"
                                                        class="test-img" />
                                                    <img src="{{ url('resources/dotnetimages/test_play.png') }}"
                                                        class="demo-test" /></a>


                                            </div>

                                            <div class="clearfix"></div>
                                            @php $i=0;@endphp
                                            @foreach ($data as $value)
                                                @php ++$i @endphp
                                                @if ($value->TestTypeId == '1001')
                                                    <div class="last-updated-test" id="upVrikshasana" runat="server"
                                                        style="display: none">
                                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                                        {{ __('taketest.label3') }} <span class="last-score"
                                                            id="upScoreVrikshasana" runat="server">{{  $value->Score . 'Sec' }}</span><span
                                                            class="last-time" id="upTimeVrikshasana"
                                                            runat="server">>{{ '[' . $value->TIME . ']' }}</span>
                                                    </div>
                                                @elseif($i == 1 && in_array('1001', $arraytestid) == false)
                                                    <div class="last-updated-test" id="upVrikshasana" runat="server"
                                                        style="display: none">
                                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                                        {{ __('taketest.label3') }} <span class="last-score"
                                                            id="upScoreVrikshasana" runat="server"></span><span
                                                            class="last-time" id="upTimeVrikshasana"
                                                            runat="server"></span>
                                                    </div>
                                                @endif
                                            @endforeach
                                            @if ($data == [])
                                                <div class="last-updated-test" id="upVrikshasana" runat="server"
                                                    style="display: none">
                                                    <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                                    {{ __('taketest.label3') }} <span class="last-score"
                                                        id="upScoreVrikshasana" runat="server"></span><span
                                                        class="last-time" id="upTimeVrikshasana" runat="server"></span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="take-test-section">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12">
                                                    <p class="mob-space">&nbsp;</p>
                                                </div>

                                                <div
                                                    class="col-xs-4 col-sm-4 padding-right take-test-input-col take-test-input-first-col">
                                                    <div class="form-group">
                                                        <label for="usr">{{ __('taketest.label12') }}</label>
                                                        <input id='SecVrikshasana' Placeholder="00" runat='server'
                                                            maxlength="2" onchange="SecVrikshasanaCheck();"
                                                            Class='form-control' type="number" />
                                                    </div>
                                                </div>
                                                <div class="col-xs-4 col-sm-4 padding-right take-test-input-col">
                                                    <div class="form-group">
                                                        <label for="usr">{{ __('taketest.label13') }}</label>
                                                        <input id='msVrikshasana' Placeholder="000" runat='server'
                                                            maxlength="4" onchange="msVrikshasanaCheck();"
                                                            Class='form-control' type="number" />
                                                    </div>
                                                </div>

                                                <div class="col-xs-4 col-sm-4 take-test-btn-col">
                                                    <div class="form-group" style="padding-right: 5px;">
                                                        <label for="usr">&nbsp;</label>
                                                        <button id='btnVrikshasana' runat='server' style="margin-top: 14px;"
                                                            class='take-test-save-btn'>{{ __('taketest.label6') }}</button>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-12" style="display: none"
                                                    id="errVrikshasana" runat="server">
                                                    <div class="error-msg-col">
                                                        <div class="error-icon">
                                                        </div>
                                                        <div class="error-msg" id="lblerrorVrikshasana" runat="server">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <%--New Tests for 9-18 yrs--' --}}
                    <div class="col-xs-12 col-sm-6 col-md-6 text-bdr-btm" id="dvSitAndReach" runat="server"
                        style="display:none">
                        <div class="take-test-banner">
                            <div class="test-heading-col">
                                <div class="test-heading">
                                    <h4>{{ __('userdashboard.label58') }}</h4>
                                    <p>{{ __('userdashboard.label48') }}</p>

                                </div>
                                <div class="test-info-col">

                                    <a href="javascript:void(0);" class="info-btn" onclick="TestClick(8)">

                                        <img src="{{ url('resources/dotnetimages/Sit_Reach.png') }}" class="test-img" />
                                        <img src="{{ url('resources/dotnetimages/test_play.png') }}"
                                            class="demo-test" /></a>

                                </div>
                                <div class="clearfix"></div>
                                @php $i=0;@endphp
                                @foreach ($data as $value)
                                    @php ++$i @endphp
                                    @if ($value->TestTypeId == '8')
                                        <div class="last-updated-test" id="upSR" runat="server"
                                            style="display:block">
                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }}
                                            <span class="last-score" id="upScoreSR"
                                                runat="server">{{ $value->Score / 10 . ' ' . 'cm' }}</span>
                                            <span class="last-time" id="upTimeSR"
                                                runat="server">{{ '[' . $value->TIME . ']' }}</span>
                                        </div>
                                    @elseif($i == 1 && in_array('8', $arraytestid) == false)
                                        <div class="last-updated-test" id="upSR" runat="server"
                                            style="display: none">
                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }}
                                            <span class="last-score" id="upScoreSR" runat="server"></span>
                                            <span class="last-time" id="upTimeSR" runat="server"></span>
                                        </div>
                                    @endif
                                @endforeach
                                @if ($data == [])
                                    <div class="last-updated-test" id="upSR" runat="server" style="display: none">
                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                        {{ __('taketest.label3') }}
                                        <span class="last-score" id="upScoreSR" runat="server"></span>
                                        <span class="last-time" id="upTimeSR" runat="server"></span>
                                    </div>
                                @endif
                            </div>

                            <div class="take-test-section">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>{{ __('taketest.label7') }}</p>
                                    </div>
                                    <div
                                        class="col-xs-4 col-sm-4 padding-right take-test-input-col take-test-input-first-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label8') }}</label>
                                            <input id='cmSitandReach' Placeholder="00" maxlength="3" runat='server'
                                                Class='form-control' type="number" />
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 padding-right take-test-input-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label9') }}</label>
                                            <input id='mmSitandReach' Placeholder="00" maxlength="3" runat='server'
                                                Class='form-control' type="number" />
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 take-test-btn-col">
                                        <div class="form-group">
                                            <label for="usr">&nbsp;</label>
                                            <button id="btnSR" runat='server'
                                                class='take-test-save-btn'>{{ __('taketest.label6') }}</button>

                                        </div>
                                    </div>
                                    <div id="SRerr" runat="server" class="col-xs-12 col-sm-12"
                                        style="display: none">
                                        <div class="error-msg-col">
                                            <div class="error-icon">
                                            </div>
                                            <div class="error-msg" id="lblerrorSR" runat="server"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-6 text-bdr-btm" id="dv600mt" runat="server"
                        style="display:none">
                        <div class="take-test-banner">
                            <div class="test-heading-col">
                                <div class="test-heading">
                                    <h4>{{ __('userdashboard.label59') }}</h4>
                                    <p>{{ __('userdashboard.label49') }}</p>

                                </div>
                                <div class="test-info-col">


                                    <a href="javascript:void(0);" class="info-btn" onclick="TestClick(19)">
                                        <img src="{{ url('resources/dotnetimages/600mwalk.png') }}" class="test-img" />
                                        <img src="{{ url('resources/dotnetimages/test_play.png') }}"
                                            class="demo-test" /></a>



                                </div>
                                <div class="clearfix"></div>
                                @php $i=0;@endphp
                                @foreach ($data as $value)
                                    @php ++$i @endphp
                                    @if ($value->TestTypeId == '19')
                                        <div class="last-updated-test" id="up600" runat="server"
                                            style="display: block">
                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }} <span class="last-score" id="upScore600"
                                                runat="server">{{ substr(($value->Score * 1.666667) / 100000, 0, 4) . ' ' . 'Min' }}</span>

                                            <span class="last-time" id="upTime600"
                                                runat="server">{{ '[' . $value->TIME . ']' }}</span>
                                        </div>
                                    @elseif($i == 1 && in_array('19', $arraytestid) == false)
                                        <div class="last-updated-test" id="up600" runat="server"
                                            style="display: none">
                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }} <span class="last-score" id="upScore600"
                                                runat="server"></span><span class="last-time" id="upTime600"
                                                runat="server"></span>
                                        </div>
                                    @endif
                                @endforeach
                                @if ($data == [])
                                    <div class="last-updated-test" id="up600" runat="server" style="display: none">
                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                        {{ __('taketest.label3') }} <span class="last-score" id="upScore600"
                                            runat="server"></span><span class="last-time" id="upTime600"
                                            runat="server"></span>
                                    </div>
                                @endif
                            </div>

                            <div class="take-test-section">

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>{{ __('taketest.label10') }}</p>
                                    </div>
                                    <div
                                        class="col-xs-3 col-sm-3 padding-right take-test-input-col take-test-input-first-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label11') }}</label>
                                            <input id='Min600' Placeholder="00" runat='server' maxlength="2"
                                                onchange="Min600Check();" Class='form-control' type="number" />
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 padding-right take-test-input-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label12') }}</label>
                                            <input id='Sec600' Placeholder="00" runat='server' maxlength="2"
                                                onchange="Sec600Check();" Class='form-control' type="number" />
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 padding-right take-test-input-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label13') }}</label>
                                            <input id='ms600' Placeholder="000" runat='server' maxlength="4"
                                                onchange="ms600Check();" Class='form-control' type="number" />
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-sm-4 take-test-btn-col">
                                        <div class="form-group">
                                            <label for="usr">&nbsp;</label>
                                            <button id='btn600mt' runat='server'
                                                class='take-test-save-btn'>{{ __('taketest.label6') }}</button>
                                        </div>
                                    </div>
                                    <div id="err600" class="col-xs-12 col-sm-12" runat="server"
                                        style="display: none">
                                        <div class="error-msg-col">
                                            <div class="error-icon">
                                            </div>
                                            <div class="error-msg" id="lblerror600" runat="server"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-6 text-bdr-btm" id="dv50mt" runat="server"
                        style="display:none">

                        <div class="take-test-banner">
                            <div class="test-heading-col">
                                <div class="test-heading">
                                    <h4>{{ __('userdashboard.label60') }}</h4>
                                    <p>{{ __('userdashboard.label50') }}</p>

                                </div>
                                <div class="test-info-col">

                                    <a href="javascript:void(0);" class="info-btn" onclick="TestClick(54)">
                                        <img src="{{ url('resources/dotnetimages/50Mtr_Dash.png') }}" class="test-img" />
                                        <img src="{{ url('resources/dotnetimages/test_play.png') }}"
                                            class="demo-test" /></a>



                                </div>
                                <div class="clearfix"></div>
                                @php $i=0;@endphp


                                @foreach ($data as $value)
                                    @php ++$i @endphp

                                    @if ($value->TestTypeId == '54')
                                        <div class="last-updated-test" id="up50" runat="server"
                                            style="display: block">
                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }} <span class="last-score" id="upScore50"
                                                runat="server">{{ $value->Score / 1000 . ' ' . 'Sec' }}</span>

                                            <span class="last-time" id="upTime50"
                                                runat="server">{{ '[' . $value->TIME . ']' }}</span>
                                        </div>
                                    @elseif($i == 1 && in_array('54', $arraytestid) == false)
                                        <div class="last-updated-test" id="up50" runat="server"
                                            style="display:none">
                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }} <span class="last-score" id="upScore50"
                                                runat="server"></span><span class="last-time" id="upTime50"
                                                runat="server"></span>
                                        </div>
                                    @endif
                                @endforeach
                                @if ($data == [])
                                    <div class="last-updated-test" id="up50" runat="server" style="display:none">
                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                        {{ __('taketest.label3') }} <span class="last-score" id="upScore50"
                                            runat="server"></span><span class="last-time" id="upTime50"
                                            runat="server"></span>
                                    </div>
                                @endif
                            </div>

                            <div class="take-test-section">

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>{{ __('taketest.label10') }}</p>
                                    </div>

                                    <div
                                        class="col-xs-4 col-sm-4 padding-right take-test-input-col take-test-input-first-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label12') }}</label>
                                            <input id='Sec50' Placeholder="00" runat='server' maxlength="2"
                                                onchange="Sec50Check();" Class='form-control' type="number" />
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 padding-right take-test-input-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label13') }}</label>
                                            <input id='ms50' Placeholder="000" runat='server' maxlength="4"
                                                onchange="ms50Check();" Class='form-control' type="number" />
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 take-test-btn-col">
                                        <div class="form-group">
                                            <label for="usr">&nbsp;</label>
                                            <button id='btn50' runat='server'
                                                class='take-test-save-btn buy'>{{ __('taketest.label6') }}</button>
                                        </div>
                                    </div>
                                    <div id="err50" runat="server" class="col-xs-12 col-sm-12"
                                        style="display: none">
                                        <div class="error-msg-col">
                                            <div class="error-icon">
                                            </div>
                                            <div class="error-msg" id="lblerror50" runat="server"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xs-12">
                        <div id="grouptest" runat="server">
                            {{-- <%--class="group-test"--')}} --}}
                            <span id="onlyone1" runat="server" class="take-any-one-test"
                                style="display:none">{{ __('taketest.onlyone') }}</span>
                            <div id="divscroll1" runat="server" class="scrolling-wrapper">
                                <div class=" text-bdr-btm  card1" id="dvPartial" runat="server" style="display:none">

                                    <div class="take-test-banner">
                                        <div class="test-heading-col">
                                            <div class="test-heading">
                                                <h4>{{ __('userdashboard.label56') }}</h4>
                                                <p>{{ __('taketest.label104') }}</p>

                                            </div>
                                            <div class="test-info-col">

                                                <a href="javascript:void(0);" class="info-btn" onclick="TestClick(55)">
                                                    <img src="{{ url('resources/dotnetimages/Partial-Curl.png') }}"
                                                        class="test-img" />
                                                    <img src="{{ url('resources/dotnetimages/test_play.png') }}"
                                                        class="demo-test" /></a>


                                            </div>
                                            <div class="clearfix"></div>
                                            @php $i=0;@endphp
                                            @foreach ($data as $value)
                                                @php ++$i @endphp
                                                @if ($value->TestTypeId == '55')
                                                    <div class="last-updated-test" id="upPartial" runat="server"
                                                        style="display: block">
                                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                                        {{ __('taketest.label3') }} <span class="last-score"
                                                            id="upScorePartial" runat="server">
                                                            {{ $value->Score . ' ' . 'Times' }}</span><span
                                                            class="last-time" id="upTimePartial"
                                                            runat="server">{{ '[' . $value->TIME . ']' }}</span>
                                                    </div>
                                                @elseif($i == 1 && in_array('55', $arraytestid) == false)
                                                    <div class="last-updated-test" id="upPartial" runat="server"
                                                        style="display: none">
                                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                                        {{ __('taketest.label3') }} <span class="last-score"
                                                            id="upScorePartial" runat="server"></span><span
                                                            class="last-time" id="upTimePartial" runat="server"></span>
                                                    </div>
                                                @endif
                                            @endforeach
                                            @if ($data == [])
                                                <div class="last-updated-test" id="upPartial" runat="server"
                                                    style="display: none">
                                                    <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                                    {{ __('taketest.label3') }} <span class="last-score"
                                                        id="upScorePartial" runat="server"></span><span class="last-time"
                                                        id="upTimePartial" runat="server"></span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="take-test-section">

                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12">
                                                    <p class="mob-space">&nbsp;</p>
                                                </div>
                                                <div
                                                    class="col-xs-8 col-sm-8 padding-right take-test-input-col take-test-input-first-col">
                                                    <div class="form-group">
                                                        <label for="usr">{{ __('taketest.label15') }}</label>
                                                        <input id='countPartial' Placeholder="00" runat='server'
                                                            maxlength="3" onchange="countPartialCheck()"
                                                            Class='form-control' type="number" />
                                                    </div>
                                                </div>


                                                <div class="col-xs-4 col-sm-4 take-test-btn-col">
                                                    <div class="form-group" >
                                                        <label for="usr">&nbsp;</label>
                                                        <button id='btnPartial' runat='server' style="margin-top: 14px;"
                                                            class='take-test-save-btn'>{{ __('taketest.label6') }}</button>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12" style="display: none" id="errPartial"
                                                    runat="server">
                                                    <div class="error-msg-col">
                                                        <div class="error-icon">
                                                        </div>
                                                        <div class="error-msg" id="lblerrPartial" runat="server">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>

                                    </div>

                                </div>
                                <div class="text-bdr-btm swiper-slide card1" id="dvNaukasana" runat="server"
                                    style="display:none">
                                    <div class="take-test-banner">

                                        <div class="test-heading-col">
                                            <div class="test-heading">
                                                <h4>{{ __('userdashboard.label79') }}</h4>
                                                <p>{{ __('userdashboard.label6') }}</p>
                                            </div>

                                            <div class="test-info-col">

                                                <a href="javascript:void(0);" class="info-btn" onclick="TestClick(1002)">
                                                    <img src="{{ url('resources/dotnetimages/Boat-Pose.png') }}"
                                                        class="test-img" />
                                                    <img src="{{ url('resources/dotnetimages/test_play.png') }}"
                                                        class="demo-test" /></a>


                                            </div>

                                            <div class="clearfix"></div>
                                            @php $i=0;@endphp
                                            @foreach ($data as $value)
                                                @php ++$i @endphp
                                                @if ($value->TestTypeId == '1002')
                                                    <div class="last-updated-test" id="upNaukasana" runat="server"
                                                        style="display: block">
                                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                                        {{ __('taketest.label3') }} <span class="last-score"
                                                            id="upScoreNaukasana" runat="server">{{ $value->Score . ' ' . 'Sec' }}</span><span
                                                            class="last-time" id="upTimeNaukasana"
                                                            runat="server">{{ '[' . $value->TIME . ']' }}</span>
                                                    </div>
                                                @elseif($i == 1 && in_array('1002', $arraytestid) == false)
                                                    <div class="last-updated-test" id="upNaukasana" runat="server"
                                                        style="display: none">
                                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                                        {{ __('taketest.label3') }} <span class="last-score"
                                                            id="upScoreNaukasana" runat="server"></span><span
                                                            class="last-time" id="upTimeNaukasana" runat="server"></span>
                                                    </div>
                                                @endif
                                            @endforeach

                                            @if ($data == [])
                                                <div class="last-updated-test" id="upNaukasana" runat="server"
                                                    style="display: none">
                                                    <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                                    {{ __('taketest.label3') }} <span class="last-score"
                                                        id="upScoreNaukasana" runat="server"></span><span
                                                        class="last-time" id="upTimeNaukasana" runat="server"></span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="take-test-section">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12">
                                                    <p class="mob-space">&nbsp;</p>
                                                </div>

                                                <div
                                                    class="col-xs-4 col-sm-4 padding-right take-test-input-col take-test-input-first-col">
                                                    <div class="form-group">
                                                        <label for="usr">{{ __('taketest.label12') }}</label>
                                                        <input id='SecNaukasana' Placeholder="00" runat='server'
                                                            maxlength="2" onchange="SecNaukasanaCheck();"
                                                            Class='form-control' type="number" />
                                                    </div>
                                                </div>
                                                <div class="col-xs-4 col-sm-4 padding-right take-test-input-col">
                                                    <div class="form-group">
                                                        <label for="usr">{{ __('taketest.label13') }}</label>
                                                        <input id='msNaukasana' Placeholder="000" runat='server'
                                                            maxlength="4" onchange="msNaukasanaCheck();"
                                                            Class='form-control' type="number" />
                                                    </div>
                                                </div>

                                                <div class="col-xs-4 col-sm-4 take-test-btn-col">
                                                    <div class="form-group">
                                                        <label for="usr">&nbsp;</label>
                                                        <button id='btnNaukasana' runat='server' style="margin-top:14px;"
                                                            class='take-test-save-btn'>{{ __('taketest.label6') }}</button>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-12" style="display: none" id="errNaukasana"
                                                    runat="server">
                                                    <div class="error-msg-col">
                                                        <div class="error-icon">
                                                        </div>
                                                        <div class="error-msg" id="lblerrorNaukasana" runat="server">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>



                    {{--
                    <%--New Tests for 19-65 yrs--')}} --}}


                    <div class="col-xs-12 col-sm-6 col-md-6 text-bdr-btm" id="dvPushup" runat="server"
                        style="display:none">

                        <div class="take-test-banner">
                            <div class="test-heading-col">
                                <div class="test-heading">
                                    <h4>{{ __('taketest.label16') }}</h4>
                                    <p>{{ __('userdashboard.label52') }}</p>

                                </div>
                                <div class="test-info-col">

                                    <a href="javascript:void(0);" class="info-btn" onclick="TestClick(57)">
                                        <img src="{{ url('resources/dotnetimages/pushups.png') }}" class="test-img" />
                                        <img src="{{ url('resources/dotnetimages/test_play.png') }}"
                                            class="demo-test" /></a>



                                </div>
                                <div class="clearfix"></div>
                                @php $i=0;@endphp
                                @foreach ($data as $value)
                                    @php ++$i @endphp
                                    @if ($value->TestTypeId == '57')
                                        <div class="last-updated-test" id="upPush" runat="server"
                                            style="display:block">
                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }} <span class="last-score" id="upScorePush"
                                                runat="server"></span>{{ $value->Score . ' ' . 'Times' }}<span
                                                class="last-time" id="upTimePush"
                                                runat="server">{{ '[' . $value->TIME . ']' }}</span>
                                        </div>
                                    @elseif($i == 1 && in_array('57', $arraytestid) == false)
                                        <div class="last-updated-test" id="upPush" runat="server"
                                            style="display: none">
                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }} <span class="last-score" id="upScorePush"
                                                runat="server"></span><span class="last-time" id="upTimePush"
                                                runat="server"></span>
                                        </div>
                                    @endif
                                @endforeach
                                @if ($data == [])
                                    <div class="last-updated-test" id="upPush" runat="server" style="display: none">
                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                        {{ __('taketest.label3') }} <span class="last-score" id="upScorePush"
                                            runat="server"></span><span class="last-time" id="upTimePush"
                                            runat="server"></span>
                                    </div>
                                @endif
                            </div>

                            <div class="take-test-section">

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p class="mob-space">&nbsp;</p>
                                    </div>
                                    <div
                                        class="col-xs-8 col-sm-8 padding-right take-test-input-col take-test-input-first-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label17') }}</label>
                                            <input id='countPushup' Placeholder="00" runat='server' maxlength="3"
                                                onchange="countPushupCheck();" Class='form-control' type="number" />
                                        </div>
                                    </div>


                                    <div class="col-xs-4 col-sm-4 take-test-btn-col">
                                        <div class="form-group">
                                            <label for="usr">&nbsp;</label>
                                            <button id='btnPushup' runat='server'
                                                class='take-test-save-btn'>{{ __('taketest.label6') }}</button>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12" style="display: none" id="errPushup"
                                        runat="server">
                                        <div class="error-msg-col">
                                            <div class="error-icon">
                                            </div>
                                            <div class="error-msg" id="lblerrPushup" runat="server"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                </div>


                            </div>

                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-6 text-bdr-btm" id="dv2" runat="server"
                        style="display:none">
                        <div class="take-test-banner">
                            <div class="test-heading-col">
                                <div class="test-heading">
                                    <h4>{{ __('userdashboard.label80') }}</h4>
                                    <p>{{ __('userdashboard.label92') }}</p>
                                </div>

                                <div class="test-info-col">

                                    <a href="javascript:void(0);" class="info-btn" onclick="TestClick(1003)">
                                        <img src="{{ url('resources/dotnetimages/2kmrunning.png') }}"
                                            class="test-img" />
                                        <img src="{{ url('resources/dotnetimages/test_play.png') }}"
                                            class="demo-test" /></a>

                                </div>

                                <div class="clearfix"></div>
                                @php $i=0;@endphp
                                @foreach ($data as $value)
                                    @php ++$i @endphp
                                    @if ($value->TestTypeId == '1003')
                                        <div class="last-updated-test" id="up2" runat="server"
                                            style="display: block">
                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }}  <span class="last-score" id="upScore2"
                                            runat="server">{{ substr(($value->Score * 1.666667) / 100000, 0, 4) . ' ' . 'Min' }}</span><span class="last-time" id="upTime2"
                                            runat="server">>{{ '[' . $value->TIME . ']' }}</span>
                                        </div>
                                    @elseif($i == 1 && in_array('1003', $arraytestid) == false)
                                        <div class="last-updated-test" id="up2" runat="server"
                                            style="display: none">
                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }} <span class="last-score" id="upScore2"
                                                runat="server"></span><span class="last-time" id="upTime2"
                                                runat="server"></span>
                                        </div>
                                    @endif
                                @endforeach

                                @if ($data == [])
                                    <div class="last-updated-test" id="up2" runat="server" style="display: none">
                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                        {{ __('taketest.label3') }} <span class="last-score" id="upScore2"
                                            runat="server"></span><span class="last-time" id="upTime2"
                                            runat="server"></span>
                                    </div>
                                @endif

                            </div>

                            <div class="take-test-section">

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>{{ __('taketest.label10') }}</p>
                                    </div>
                                    <div
                                        class="col-xs-3 col-sm-3 padding-right take-test-input-col take-test-input-first-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label11') }}</label>
                                            <input id='Min2' Placeholder="00" runat='server' maxlength="2"
                                                 Class='form-control' type="number" />
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 padding-right take-test-input-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label12') }}</label>
                                            <input id='Sec2' Placeholder="00" runat='server' maxlength="2"
                                             Class='form-control' type="number" />
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 padding-right take-test-input-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label13') }}</label>
                                            <input id='ms2' Placeholder="000" runat='server' maxlength="4"
                                             Class='form-control' type="number" />
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-sm-4 take-test-btn-col">
                                        <div class="form-group">
                                            <label for="usr">&nbsp;</label>
                                            <button id='btn2mt' runat='server'
                                                class='take-test-save-btn'>{{ __('taketest.label6') }}</button>
                                        </div>
                                    </div>
                                    <div id="err2" class="col-xs-12 col-sm-12" runat="server"
                                        style="display: none">
                                        <div class="error-msg-col">
                                            <div class="error-icon">
                                            </div>
                                            <div class="error-msg" id="lblerror2" runat="server"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-6 text-bdr-btm" id="dvVSitAndReach" runat="server"
                        style="display:none">
                        <div class="take-test-banner">
                            <div class="test-heading-col">
                                <div class="test-heading">
                                    <h4>{{ __('userdashboard.label81') }}</h4>
                                    <p>{{ __('userdashboard.label48') }}</p>
                                </div>

                                <div class="test-info-col">

                                    <a href="javascript:void(0);" class="info-btn" onclick="TestClick(1004)">
                                        <img src="{{ url('resources/dotnetimages/V-sit-reach.png') }}"
                                            class="test-img" />
                                        <img src="{{ url('resources/dotnetimages/test_play.png') }}"
                                            class="demo-test" /></a>



                                </div>

                                <div class="clearfix"></div>
                                @php $i=0;@endphp
                                @foreach ($data as $value)
                                    @php ++$i @endphp
                                    @if ($value->TestTypeId == '1004')
                                        <div class="last-updated-test" id="upVSR" runat="server"
                                            style="display: none">
                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }}
                                            <span class="last-score" id="upScoreVSR" runat="server"></span>
                                            <span class="last-time" id="upTImeVSR"
                                                runat="server">{{ '[' . $value->TIME . ']' }}</span>
                                        </div>
                                    @elseif($i == 1 && in_array('1004', $arraytestid) == false)
                                        <div class="last-updated-test" id="upVSR" runat="server"
                                            style="display: none">
                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }}
                                            <span class="last-score" id="upScoreVSR" runat="server"></span>
                                            <span class="last-time" id="upTImeVSR" runat="server"></span>
                                        </div>
                                    @endif
                                @endforeach

                                @if ($data == [])
                                    <div class="last-updated-test" id="upVSR" runat="server"
                                        style="display: none">
                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                        {{ __('taketest.label3') }}
                                        <span class="last-score" id="upScoreVSR" runat="server"></span>
                                        <span class="last-time" id="upTImeVSR" runat="server"></span>
                                    </div>
                                @endif

                            </div>

                            <div class="take-test-section">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>{{ __('taketest.label7') }}</p>
                                    </div>
                                    <div
                                        class="col-xs-4 col-sm-4 padding-right take-test-input-col take-test-input-first-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label8') }}</label>
                                            <input id='cmVSitandReach' Placeholder="00" maxlength="3"
                                                onchange="cmVSitandReachCheck();" runat='server' Class='form-control'
                                                type="number" />
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 padding-right take-test-input-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label9') }}</label>
                                            <input id='mmVSitandReach' Placeholder="00" maxlength="3"
                                                onchange="mmVSitandReachCheck();" runat='server' Class='form-control'
                                                type="number" />
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 take-test-btn-col">
                                        <div class="form-group">
                                            <label for="usr">&nbsp;</label>
                                            <button id="btnVSR" runat='server'
                                                class='take-test-save-btn'>{{ __('taketest.label6') }}</button>

                                        </div>
                                    </div>
                                    <div id="VSRerr" runat="server" class="col-xs-12 col-sm-12"
                                        style="display: none">
                                        <div class="error-msg-col">
                                            <div class="error-icon">
                                            </div>
                                            <div class="error-msg" id="lblerrorVSR" runat="server"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{--
                    <%--New Tests for 65+ yrs--')}} --}}

                    <div class="col-xs-12 col-sm-6 col-md-6 text-bdr-btm" id="dvChairStand" runat="server"
                        style="display:none">
                        <div class="take-test-banner">
                            <div class="test-heading-col">
                                <div class="test-heading">
                                    <h4>{{ __('userdashboard.label82') }}</h4>
                                    <p>{{ __('userdashboard.label52') }}</p>
                                </div>

                                <div class="test-info-col">

                                    <a href="javascript:void(0);" class="info-btn" onclick="TestClick(1005)">
                                        <img src="{{ url('resources/dotnetimages/Chair-Stand.png') }}"
                                            class="test-img" />
                                        <img src="{{ url('resources/dotnetimages/test_play.png') }}"
                                            class="demo-test" /></a>



                                </div>

                                <div class="clearfix"></div>

                                @php $i=0;@endphp
                                @foreach ($data as $value)
                                    @php ++$i @endphp
                                    @if ($value->TestTypeId == '1005')
                                        <div class="last-updated-test" id="upChairStand" runat="server"
                                            style="display:block">

                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }}
                                            <span class="last-score" id="upScoreChairStand"
                                                runat="server">{{ $value->Score . ' ' . 'Times' }}</span>
                                            <span class="last-time" id="upTimeChairStand"
                                                runat="server">{{ '[' . $value->TIME . ']' }}</span>

                                        </div>
                                    @elseif($i == 1 && in_array('1005', $arraytestid) == false)
                                        <div class="last-updated-test" id="upChairStand" runat="server"
                                            style="display:none">

                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }}
                                            <span class="last-score" id="upScoreChairStand" runat="server"></span>
                                            <span class="last-time" id="upTimeChairStand" runat="server"></span>

                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="take-test-section">

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p class="mob-space">&nbsp;</p>
                                    </div>
                                    <div
                                        class="col-xs-8 col-sm-8 padding-right take-test-input-col take-test-input-first-col">
                                        <div class="form-group">
                                            <label for="usr">No. of Stands</label>
                                            <input id='countChairStand' Placeholder="00" runat='server'
                                                maxlength="3" Class='form-control' type="number" />
                                        </div>
                                    </div>


                                    <div class="col-xs-4 col-sm-4 take-test-btn-col">
                                        <div class="form-group">
                                            <label for="usr">&nbsp;</label>
                                            <button id='btnChairStand' runat='server'
                                                class='take-test-save-btn'>{{ __('taketest.label6') }}</button>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12" style="display: none" id="errChairStand"
                                        runat="server">
                                        <div class="error-msg-col">
                                            <div class="error-icon">
                                            </div>
                                            <div class="error-msg" id="lblerrChairStand" runat="server"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                </div>


                            </div>

                        </div>
                    </div>


                    <div class="col-xs-12">
                        <div id="grouptest3" runat="server">
                            <span id="onlyone3" runat="server" class="take-any-one-test"
                                style="display:none">{{ __('taketest.onlyone') }}</span>
                            <div id="divscroll3" style="margin-top: 50px !important;" runat="server" class="scrolling-wrapper">

                                <div class="card1 text-bdr-btm" id="dvChairSR" runat="server" style="display:none">
                                    <div class="take-test-banner">

                                        <div class="test-heading-col">
                                            <div class="test-heading">
                                                <h4>{{ __('userdashboard.label83') }}</h4>
                                                <p>{{ __('userdashboard.label48') }}</p>
                                            </div>

                                            <div class="test-info-col">

                                                <a href="javascript:void(0);" class="info-btn"
                                                    onclick="TestClick(1006)">
                                                    <img src="{{ url('resources/dotnetimages/Chair-sit-reach.png') }}"
                                                        class="test-img" />
                                                    <img src="{{ url('resources/dotnetimages/test_play.png') }}"
                                                        class="demo-test" /></a>

                                                {{-- <a href="javascript:void(0);" class="info-btn"
                                                    onclick="TestClick(1006)">
                                                    <img src="{{ url('resources/dotnetimages/Chair-sit-reach.png') }}"
                                                        class="test-img" />
                                                    <img src="{{ url('resources/dotnetimages/test_play.png') }}"
                                                        class="demo-test" /></a> --}}

                                            </div>

                                            <div class="clearfix"></div>
                                            @php $i=0;@endphp
                                            @foreach ($data as $value)
                                                @php ++$i @endphp
                                                @if ($value->TestTypeId == '1006')
                                                    <div class="last-updated-test" id="upChairSR" runat="server"
                                                        style="display: block">
                                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                                        {{ __('taketest.label3') }} <span class="last-score"
                                                            id="upScoreChairSR"
                                                            runat="server">{{ $value->Score / 10 . ' ' . 'mm' }}</span><span
                                                            class="last-time" id="upTimeChairSR"
                                                            runat="server">{{ '[' . $value->TIME . ']' }}</span>
                                                    </div>
                                                @elseif($i == 1 && in_array('1006', $arraytestid) == false)
                                                    <div class="last-updated-test" id="upChairSR" runat="server"
                                                        style="display: none">
                                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                                        {{ __('taketest.label3') }} <span class="last-score"
                                                            id="upScoreChairSR" runat="server"></span><span
                                                            class="last-time" id="upTimeChairSR"
                                                            runat="server"></span>
                                                    </div>
                                                @endif
                                            @endforeach

                                            @if ($data == [])
                                                <div class="last-updated-test" id="upChairSR" runat="server"
                                                    style="display: none">
                                                    <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                                    {{ __('taketest.label3') }} <span class="last-score"
                                                        id="upScoreChairSR" runat="server"></span><span
                                                        class="last-time" id="upTimeChairSR" runat="server"></span>
                                                </div>
                                            @endif


                                        </div>

                                        <div class="take-test-section">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12">
                                                    <p class="mob-space">&nbsp;</p>
                                                    <p>{{ __('taketest.label7') }}</p>
                                                </div>

                                                <div
                                                    class="col-xs-4 col-sm-4 padding-right take-test-input-col take-test-input-first-col">
                                                    <div class="form-group">
                                                        <label for="usr">{{ __('taketest.label8') }}</label>
                                                        <input id='cmChairSR' Placeholder="00" runat='server'
                                                            maxlength="2" onchange="cmChairSRCheck();"
                                                            Class='form-control' type="number" />
                                                    </div>
                                                </div>
                                                <div class="col-xs-4 col-sm-4 padding-right take-test-input-col">
                                                    <div class="form-group">
                                                        <label for="usr">{{ __('taketest.label9') }}</label>
                                                        <input id='mmChairSR' Placeholder="000" runat='server'
                                                            maxlength="4" onchange="mmChairSRCheck();"
                                                            Class='form-control' type="number" />
                                                    </div>
                                                </div>

                                                <div class="col-xs-4 col-sm-4 take-test-btn-col">
                                                    <div class="form-group">
                                                        <label for="usr">&nbsp;</label>
                                                        <button id='btnChairSR' runat='server'
                                                            class='take-test-save-btn'>{{ __('taketest.label6') }}</button>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-12" style="display: none" id="errChairSR"
                                                    runat="server">
                                                    <div class="error-msg-col">
                                                        <div class="error-icon">
                                                        </div>
                                                        <div class="error-msg" id="lblerrorChairSR" runat="server">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class=" text-bdr-btm swiper-slide card1" id="dvBackScratchTest" runat="server"
                                    style="display:none">
                                    <div class="take-test-banner">
                                        <div class="test-heading-col">
                                            <div class="test-heading">
                                                <h4>{{ __('userdashboard.label87') }}</h4>
                                                <p>{{ __('userdashboard.label48') }}</p>
                                            </div>

                                            <div class="test-info-col">

                                                <a href="javascript:void(0);" class="info-btn"
                                                    onclick="TestClick(1009)">
                                                    <img src="{{ url('resources/dotnetimages/back_stratch.png') }}"
                                                        class="test-img" />
                                                    <img src="{{ url('resources/dotnetimages/test_play.png') }}"
                                                        class="demo-test" /></a>

                                                {{-- <a href="javascript:void(0);" class="info-btn"
                                                    onclick="TestClick(1009)">
                                                    <img src="{{ url('resources/dotnetimages/back_stratch.png') }}"
                                                        class="test-img" />
                                                    <img src="{{ url('resources/dotnetimages/test_play.png') }}"
                                                        class="demo-test" /></a> --}}

                                            </div>

                                            <div class="clearfix"></div>
                                            @php $i=0;@endphp
                                            @foreach ($data as $value)
                                                @php ++$i @endphp
                                                @if ($value->TestTypeId == '1009')
                                                    <div class="last-updated-test" id="upBackScratch" runat="server"
                                                        style="display: block">
                                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                                        {{ __('taketest.label3') }}
                                                        <span class="last-score" id="upScoreBackScratch"
                                                            runat="server">{{ $value->Score / 10 . ' ' . 'mm' }}</span>
                                                        <span class="last-time" id="upTImeBackScratch"
                                                            runat="server">{{ '[' . $value->TIME . ']' }}</span>
                                                    </div>
                                                @elseif($i == 1 && in_array('1009', $arraytestid) == false)
                                                    <div class="last-updated-test" id="upBackScratch" runat="server"
                                                        style="display: none">
                                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                                        {{ __('taketest.label3') }}
                                                        <span class="last-score" id="upScoreBackScratch"
                                                            runat="server"></span>
                                                        <span class="last-time" id="upTImeBackScratch"
                                                            runat="server"></span>
                                                    </div>
                                                @endif
                                            @endforeach

                                            @if ($data == [])
                                                <div class="last-updated-test" id="upBackScratch" runat="server"
                                                    style="display: none">
                                                    <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                                    {{ __('taketest.label3') }}
                                                    <span class="last-score" id="upScoreBackScratch"
                                                        runat="server"></span>
                                                    <span class="last-time" id="upTImeBackScratch"
                                                        runat="server"></span>
                                                </div>
                                            @endif

                                        </div>

                                        <div class="take-test-section">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12">
                                                    <p>{{ __('taketest.label7') }}</p>
                                                </div>
                                                <div
                                                    class="col-xs-4 col-sm-4 padding-right take-test-input-col take-test-input-first-col">
                                                    <div class="form-group">
                                                        <label for="usr">{{ __('taketest.label8') }}</label>
                                                        <input id='cmBackScratch' Placeholder="00" maxlength="3"
                                                            onchange="cmBackScratchCheck();" runat='server'
                                                            Class='form-control' type="number" />
                                                    </div>
                                                </div>
                                                <div class="col-xs-4 col-sm-4 padding-right take-test-input-col">
                                                    <div class="form-group">
                                                        <label for="usr">{{ __('taketest.label9') }}</label>
                                                        <input id='mmBackScratch' Placeholder="00" maxlength="3"
                                                            onchange="mmBackScratchCheck();" runat='server'
                                                            Class='form-control' type="number" />
                                                    </div>
                                                </div>
                                                <div class="col-xs-4 col-sm-4 take-test-btn-col">
                                                    <div class="form-group">
                                                        <label for="usr">&nbsp;</label>
                                                        <button id="btnBackScratch" runat='server'
                                                            class='take-test-save-btn'>{{ __('taketest.label6') }}</button>

                                                    </div>
                                                </div>
                                                <div id="BackScratcherr" runat="server" class="col-xs-12 col-sm-12"
                                                    style="display: none">
                                                    <div class="error-msg-col">
                                                        <div class="error-icon">
                                                        </div>
                                                        <div class="error-msg" id="lblerrorBackScratch"
                                                            runat="server"></div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-6 text-bdr-btm" id="dv8FootUp" runat="server"
                        style="display:none">
                        <div class="take-test-banner">

                            <div class="test-heading-col">
                                <div class="test-heading">
                                    <h4>{{ __('userdashboard.label84') }}</h4>
                                    <p>{{ __('userdashboard.label86') }}</p>
                                </div>

                                <div class="test-info-col">



                                    <a href="javascript:void(0);" class="info-btn" onclick="TestClick(1007)">
                                        <img src="{{ url('resources/dotnetimages/8_step_go_test.png') }}"
                                            class="test-img" />
                                        <img src="{{ url('resources/dotnetimages/test_play.png') }}"
                                            class="demo-test" /></a>

                                </div>

                                <div class="clearfix"></div>
                                @php $i=0;@endphp
                                @foreach ($data as $value)
                                    @php ++$i @endphp
                                    @if ($value->TestTypeId == '1007')
                                        <div class="last-updated-test" id="up8FootUp" runat="server"
                                            style="display: block">
                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }} <span class="last-score" id="upScore8FootUp"
                                                runat="server">{{ $value->Score / 1000 . ' ' . 'Sec' }}</span><span
                                                class="last-time" id="upTime8FootUp"
                                                runat="server">{{ '[' . $value->TIME . ']' }}</span>
                                        </div>
                                    @elseif($i == 1 && in_array('1007', $arraytestid) == false)
                                        <div class="last-updated-test" id="up8FootUp" runat="server"
                                            style="display: none">
                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }} <span class="last-score" id="upScore8FootUp"
                                                runat="server"></span><span class="last-time" id="upTime8FootUp"
                                                runat="server"></span>
                                        </div>
                                    @endif
                                @endforeach

                                @if ($data == [])
                                    <div class="last-updated-test" id="up8FootUp" runat="server"
                                        style="display: none">
                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                        {{ __('taketest.label3') }} <span class="last-score" id="upScore8FootUp"
                                            runat="server"></span><span class="last-time" id="upTime8FootUp"
                                            runat="server"></span>
                                    </div>
                                @endif


                            </div>

                            <div class="take-test-section">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p class="mob-space">&nbsp;</p>
                                    </div>

                                    <div
                                        class="col-xs-4 col-sm-4 padding-right take-test-input-col take-test-input-first-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label12') }}</label>
                                            <input id='Sec8FootUp' Placeholder="00" runat='server' maxlength="2"
                                                onchange="Sec8FootUpCheck();" Class='form-control' type="number" />
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 padding-right take-test-input-col">
                                        <div class="form-group">
                                            <label for="usr">{{ __('taketest.label13') }}</label>
                                            <input id='ms8FootUp' Placeholder="000" runat='server' maxlength="4"
                                                onchange="ms8FootUpCheck();" Class='form-control' type="number" />
                                        </div>
                                    </div>

                                    <div class="col-xs-4 col-sm-4 take-test-btn-col">
                                        <div class="form-group">
                                            <label for="usr">&nbsp;</label>
                                            <button id='btn8FootUp' runat='server'
                                                class='take-test-save-btn'>{{ __('taketest.label6') }}</button>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12" style="display: none" id="err8FootUp"
                                        runat="server">
                                        <div class="error-msg-col">
                                            <div class="error-icon">
                                            </div>
                                            <div class="error-msg" id="lblerror8FootUp" runat="server"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-6 text-bdr-btm" id="dv2MinuteStep" runat="server"
                        style="display:none">
                        <div class="take-test-banner">
                            <div class="test-heading-col">
                                <div class="test-heading">
                                    <h4>{{ __('userdashboard.label85') }}</h4>
                                    <p>{{ __('userdashboard.label76') }}</p>
                                </div>

                                <div class="test-info-col">

                                    <a href="javascript:void(0);" class="info-btn" onclick="TestClick(1008)">
                                        <img src="{{ url('resources/dotnetimages/2min_step_test.png') }}"
                                            class="test-img" />
                                        <img src="{{ url('resources/dotnetimages/test_play.png') }}"
                                            class="demo-test" /></a>



                                </div>

                                <div class="clearfix"></div>

                                @php $i=0;@endphp
                                @foreach ($data as $value)
                                    @php ++$i @endphp
                                    @if ($value->TestTypeId == '1008')
                                        <div class="last-updated-test" id="up2MinuteStep" runat="server"
                                            style="display:block">

                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }}
                                            <span class="last-score" id="upScore2MinuteStep" runat="server">
                                                {{ $value->Score . ' ' . 'Times' }}</span>

                                            <span class="last-time" id="upTime2MinuteStep"
                                                runat="server">{{ '[' . $value->TIME . ']' }}</span>


                                        </div>
                                    @elseif($i == 1 && in_array('1008', $arraytestid) == false)
                                        <div class="last-updated-test" id="up2MinuteStep" runat="server"
                                            style="display:none">

                                            <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                            {{ __('taketest.label3') }}
                                            <span class="last-score" id="upScore2MinuteStep" runat="server"></span>
                                            <span class="last-time" id="upTime2MinuteStep" runat="server"></span>

                                        </div>
                                    @endif
                                @endforeach
                                @if ($data == [])
                                    <div class="last-updated-test" id="up2MinuteStep" runat="server"
                                        style="display:none">

                                        <img src="{{ url('resources/dotnetimages/clock.png') }}" />
                                        {{ __('taketest.label3') }}
                                        <span class="last-score" id="upScore2MinuteStep" runat="server"></span>
                                        <span class="last-time" id="upTime2MinuteStep" runat="server"></span>

                                    </div>
                                @endif

                            </div>

                            <div class="take-test-section">

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p class="mob-space">&nbsp;</p>
                                    </div>
                                    <div
                                        class="col-xs-8 col-sm-8 padding-right take-test-input-col take-test-input-first-col">
                                        <div class="form-group">
                                            <label for="usr">No. of Steps</label>
                                            <input id='count2MinuteStep' Placeholder="00" runat='server'
                                                maxlength="3" onchange="count2MinuteStepCheck();"
                                                Class='form-control' type="number" />
                                        </div>
                                    </div>


                                    <div class="col-xs-4 col-sm-4 take-test-btn-col">
                                        <div class="form-group">
                                            <label for="usr">&nbsp;</label>
                                            <button id='btn2MinuteStep' runat='server'
                                                class='take-test-save-btn'>{{ __('taketest.label6') }}</button>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12" style="display: none" id="err2MinuteStep"
                                        runat="server">
                                        <div class="error-msg-col">
                                            <div class="error-icon">
                                            </div>
                                            <div class="error-msg" id="lblerr2MinuteStep" runat="server"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                </div>


                            </div>

                        </div>
                    </div>



                    <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-4">
                        <a href="#a" class="tast-page-view-btn" runat="server"
                            onclick="ViewDashboard()">{{ __('taketest.label1') }}</a>
                    </div>

                </div>
            </div>


        </div>

    </div>

    <!-- Modal Test Instructions Start -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-fullscreen" style="width: 100vw;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header inner-page-header" style="margin-top: 0px;">
                    <h4 class="modal-title " id="testHeading"></h4>
                    <button type="button" class="close" onclick="closePopup();" aria-label="Close">
                        <span aria-hidden="true" class="cross"></span>
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
                                                        href="#collapse1">
                                                        <div class="inner-page-subheading">
                                                            <span>{{ __('taketest.label62') }} </span>
                                                        </div>
                                                    </a>
                                                    <h4></h4>
                                                    <h4></h4>
                                                    <h4></h4>
                                                </h4>
                                            </div>
                                            <div id="collapse1" class="panel-collapse collapse">
                                                <div class="panel-body equipment-col" id="lblScoringContent">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default panel-main">
                                            <div class="panel-heading scoring-col">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion2"
                                                        href="#collapse2">
                                                        <div class="inner-page-subheading">
                                                            <span>{{ __('taketest.label67') }} </span>
                                                        </div>
                                                    </a>
                                                    <h4></h4>
                                                    <h4></h4>
                                                    <h4></h4>
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
                                                        href="#collapse3">
                                                        <div class="inner-page-subheading">
                                                            <span>{{ __('taketest.label69') }} </span>
                                                        </div>
                                                    </a>
                                                    <h4></h4>
                                                    <h4></h4>
                                                    <h4></h4>
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
                                                        href="#collapse4">
                                                        <div class="inner-page-subheading">
                                                            <span>{{ __('taketest.label72') }}</span>
                                                        </div>
                                                    </a>
                                                    <h4></h4>
                                                    <h4></h4>
                                                    <h4></h4>
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
                                    <a href="#a" class="btn app-Next-btn btnTI no-thanks-btn"
                                        onclick="closePopup();"
                                        style="margin-bottom: 0px">{{ __('taketest.label127') }}</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Popup Message Start -->
    <div class="modal fade" id="myModal1" role="dialog" runat="server">
        <div class="modal-dialog fitness-app-model thankyou-popup">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <p id="P1" runat="server"></p>
                </div>
                <div class="modal-footer">
                    <a href="#" type="button" runat="server" onclick="BtnCloseModal()"
                        class="btn btn-default thankyou-btn">{{ __('taketest.label60') }}</a>
                </div>
            </div>
        </div>
    </div>




    <div id="divloader" runat="server" class="divloader" style="display: none">
        <img src="{{ url('resources/dotnetimages/ajax-loader.gif') }}" />
    </div>



    <script src="{{ 'public/slick/swiper-bundle.js' }}"></script>

    <script type="text/javascript">
        var script = document.createElement('script');
        var h = "hello";
        if (true) {
            script.src = "{{ asset('public/js_data/en/label.js') }}"
        }

        document.head.appendChild(script);
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
            window.history.back();
        }

        function gotohometest() {
            //window.location.href = "Home.aspx";
            window.location.href = "TakeTest.aspx";
        }


        function TestClick(id) {
            console.log(id);
            divloader.style.display="block";

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
                    AgeGroupId: ageGroupId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {


                    console.log(response);
                    divloader.style.display="none";

                    if (response.data != null && response.data.length > 0) {
                        console.log('data subm', response.data[0].VideoSource)
                        console.log(label_data[response.data[0].{{ __('testhome.label74') }}Content]);
                        let text1 = label_data[response.data[0].VideoSource]

                        $('#lblVideoSource').html(label_data[response.data[0].VideoSource]);
                        $('#lbl{{ __('testhome.label74') }}Content').html(label_data[response.data[0]
                            .{{ __('testhome.label74') }}Content]);
                        $('#lblEquipmentContent').html(label_data[response.data[0].EquipmentContent]);
                        $('#lblMeasureContent').html(label_data[response.data[0].MeasureContent]);
                        $('#lblPerformContent').html(label_data[response.data[0].PerformContent]);
                        $('#lblHeading').html(label_data[response.data[0].Heading]);
                        $('#testHeading').html(label_data[response.data[0].Heading]);
                        $('#myModal').modal('show');
                        divloader.style.display = "none";
                    } else {}
                },
                failure: function(data) {
                    console.log(data.error);
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



    <script type="text/javascript">
        var Bmierror = "{{ __('error.label1') }}";
        var BmiHeighterror = "{{ __('error.label2') }}";
        var WeightBMIerror = "{{ __('error.label3') }}";
        var HeightIntegerError = "{{ __('error.label6') }}";
        var HeightBlankerror = "{{ __('error.label4') }}";
        var WeightBlankerror = "{{ __('error.label5') }}";
        var divbuttoninnerHtml = "{{ __('taketest.label19') }}";
        var WeightFormatError = "{{ __('taketest.label28') }}";
        var SitAndReachError = "{{ __('error.label7') }}";
        var SitAndReachValueExistErrorCm = "{{ __('taketest.label32') }}";
        var SitAndReachValueExistErrorMm = "{{ __('taketest.label35') }}";
        var SEC50valueExistError = "{{ __('taketest.label40') }}";
        var MM50valueExistError = "{{ __('taketest.label41') }}";



        var divBmi = document.getElementById('dvBMI');
        var divSitAndReach = document.getElementById('dvSitAndReach');
        var div600mt = document.getElementById('dv600mt');
        var div50mt = document.getElementById('dv50mt');
        var divPartial = document.getElementById('dvPartial');
        var divPushup = document.getElementById('dvPushup');
        var divChairStand = document.getElementById('dvChairStand');
        var divChairSR = document.getElementById('dvChairSR');
        var div8FootUp = document.getElementById('dv8FootUp');
        var div2MinuteStep = document.getElementById('dv2MinuteStep');
        var divBackScratchTest = document.getElementById('dvBackScratchTest');
        var divFlamingo = document.getElementById('dvFlamingo');
        var divVrikshasana = document.getElementById('dvVrikshasana');
        var divNaukasana = document.getElementById('dvNaukasana');
        var div2 = document.getElementById('dv2');
        var grouptest = document.getElementById('grouptest');
        var grouptest1 = document.getElementById('grouptest1');
        var onlyone1 = document.getElementById('onlyone1');
        var onlyone2 = document.getElementById('onlyone2');
        var onlyone3 = document.getElementById('onlyone3');
        var divscroll2 = document.getElementById('divscroll2');
        var divscroll1 = document.getElementById('divscroll1');
        var divPlate= document.getElementById('dvPlateTap');



        var HeightBMI = document.getElementById('HeightBMI');
        var WeightBMI = document.getElementById('WeightBMI');
        var BMIErr = document.getElementById('BMIerr');
        var lblerrorBMI = document.getElementById('lblerrorBMI');
        var divloader = document.getElementById('divloader');
        var Sitrichcm = document.getElementById('cmSitandReach');
        var Sitrichmm = document.getElementById('mmSitandReach');
        var SitricError = document.getElementById('SRerr');
        var lblerrorSR = document.getElementById('lblerrorSR');
        var Sec50 = document.getElementById('Sec50');
        var Ms50 = document.getElementById('ms50');
        var lblerror50 = document.getElementById('lblerror50');
        var err50 = document.getElementById('err50');
        var countPartial = document.getElementById('countPartial');
        var errPartial = document.getElementById('errPartial');
        var lblerrPartial = document.getElementById('lblerrPartial');
        var countPushup = document.getElementById('countPushup');
        var errPushup = document.getElementById('errPushup');
        var lblerrPushup = document.getElementById('lblerrPushup');
        var Min600 = document.getElementById('Min600');
        var Sec600 = document.getElementById('Sec600');
        var Ms600 = document.getElementById('ms600');
        var lblerror600 = document.getElementById('lblerror600');
        var err600 = document.getElementById('err600');
        var countChairStand = document.getElementById('countChairStand');
        var errChairStand = document.getElementById('errChairStand');
        var lblerrChairStand = document.getElementById('lblerrChairStand');
        var btnChairSR = document.getElementById('btnChairSR');
        var errChairSR = document.getElementById('errChairSR');
        var lblerrorChairSR = document.getElementById('lblerrorChairSR');
        var cmChairSR = document.getElementById('cmChairSR');
        var mmChairSR = document.getElementById('mmChairSR');
        var mmBackScratch = document.getElementById('mmBackScratch');
        var cmBackScratch = document.getElementById('cmBackScratch');
        var BackScratcherr = document.getElementById('BackScratcherr');
        var lblerrorBackScratch = document.getElementById('lblerrorBackScratch');
        var Sec8FootUp = document.getElementById('Sec8FootUp');
        var ms8FootUp = document.getElementById('ms8FootUp');
        var err8FootUp = document.getElementById('err8FootUp');
        var lblerror8FootUp = document.getElementById('lblerror8FootUp');
        var err2MinuteStep = document.getElementById('err2MinuteStep');
        var lblerr2MinuteStep = document.getElementById('lblerr2MinuteStep');
        var count2MinuteStep = document.getElementById('count2MinuteStep');
        var myModal1 = document.getElementById('myModal1');
        var P1 = document.getElementById('P1');
        var countFlamingo= document.getElementById('countFlamingo');
        var errFlamingo=document.getElementById('errFlamingo');
        var lblerrFlamingo=document.getElementById('lblerrFlamingo');
        var SecNaukasana=document.getElementById('SecNaukasana');
        var msNaukasana=document.getElementById('msNaukasana');
        var errNaukasana=document.getElementById('errNaukasana');
        var lblerrorNaukasana=document.getElementById('lblerrorNaukasana');
        var SecVrikshasana=document.getElementById('SecVrikshasana');
        var msVrikshasana=document.getElementById('msVrikshasana');
        var errVrikshasana=document.getElementById('errVrikshasana');
        var lblerrorVrikshasana=document.getElementById('lblerrorVrikshasana');
        var MinPlate=document.getElementById('MinPlate');
        var SecPlate=document.getElementById('SecPlate');
        var MsPlate=document.getElementById('msPlate');
        var errPlate=document.getElementById('errPlate');
        var lblerrorPlate=document.getElementById('lblerrPlate');
        var Min2=document.getElementById('Min2');
        var Sec2=document.getElementById('Sec2');
        var Ms2=document.getElementById('ms2');
        var err2=document.getElementById('err2');
        var lblerror2=document.getElementById('lblerror2');



        var age = {{ $_GET['Age'] }};
         var gender = {{  $_GET['GenderId'] }};
         var F365Id = {{ $_GET['F365Id'] }};
         var parentId = "{{Session::get('ParentId')}}";
         if(parentId == 0){
            var parentId = 0;
        }else{
            var parentId = {{ Session::get('ParentId') }};
        }

        var ageGroupId = {{ $_GET['AgeGroupId'] }};
        var ageGroupName='{{ $_GET['AgeGroupName'] }}';

         if(ageGroupId == 1){
            divBmi.style.display = "block";
            divPlate.style.display = "block";
            divFlamingo.style.display = "block";
            divscroll2.removeAttribute("class");

         }


        if (ageGroupId == 2) {
            divBmi.style.display = "block";
            divSitAndReach.style.display = "block";
            div600mt.style.display = "block";
            div50mt.style.display = "block";
            divPartial.style.display = "block";
            divPushup.style.display = "block";
            divscroll1.removeAttribute("class");
        }

        if (ageGroupId == 3) {
            divBmi.style.display = "block";
            divVrikshasana.style.display = "block";
            divFlamingo.style.display = "block";
            divPartial.style.display = "block";
            divNaukasana.style.display = "block";
            divPushup.style.display = "block";
            div2.style.display = "block";
            divSitAndReach.style.display = "block";
            onlyone2.style.display = "block";
            onlyone1.style.display = "block";
            grouptest.setAttribute("class", "group-test");
            grouptest1.setAttribute("class", "group-test");


        }
        if(ageGroupId == 4){
            onlyone3.style.display="block";
            divBmi.style.display = "block";
            divChairStand.style.display = "block";
            divChairSR.style.display = "block";
            div8FootUp.style.display = "block";
            div2MinuteStep.style.display = "block";
            divBackScratchTest.style.display = "block";


        }



        document.getElementById('Button2').addEventListener("click", function savebmi1(e) {

            e.preventDefault();

            // console.log(button2innerHTMl);
            // console.log(divbuttoninnerHtml);
            console.log(e.target.id);
            divloader.style.display = "block";


            if (e.target.id == "Button2") {
                divloader.style.display = "none";
                button2innerHTMl = document.getElementById('Button2').innerHTML;

                if (((HeightBMI.value == "") && (WeightBMI.value === ""))) {

                    lblerrorBMI.innerText = Bmierror;
                    BMIErr.style.display = "block";
                    divloader.style.display = "none";
                    divloader.style.display = "none";
                    return false;

                }
                if (HeightBMI.value == "") {
                    divloader.style.display = "none";
                    lblerrorBMI.innerText = HeightBlankerror;
                    BMIErr.style.display = "block";
                    divloader.style.display = "none";
                    return false;

                }

                if (WeightBMI.value == "") {
                    divloader.style.display = "none";
                    lblerrorBMI.innerText = WeightBlankerror;
                    BMIErr.style.display = "block";
                    divloader.style.display = "none";
                    return false;

                }

                if (HeightBMI.value > 250 || HeightBMI.value < 15) {
                    divloader.style.display = "none";
                    lblerrorBMI.innerText = BmiHeighterror;
                    BMIErr.style.display = "block";
                    divloader.style.display = "none";
                    return false;
                }


                if (WeightBMI.value > 250 || WeightBMI.value < 15) {
                    divloader.style.display = "none";
                    lblerrorBMI.innerText = WeightBMIerror
                    BMIErr.style.display = "block";
                    divloader.style.display = "none";
                    return false;
                }


                if (Number.isInteger(Number(HeightBMI.value)) == false) {
                    divloader.style.display = "none";
                    lblerrorBMI.innerText = HeightIntegerError;
                    BMIErr.style.display = "block";
                    divloader.style.display = "none";
                    return false;

                }

                document.getElementById('Button2').innerHTML = "{{ __('taketest.label19') }}"
                HeightBMI.setAttribute('readonly', "readonly");
                WeightBMI.setAttribute('readonly', "readonly");
                BMIErr.style.display = "none"



                function isDecimal(num) {
                    return (num % 1);
                }



                if (isDecimal(Number(WeightBMI.value))) {
                    var result2 = WeightBMI.value.substring(WeightBMI.value.lastIndexOf(".") + 1);


                    if (result2.length <= 3) {
                        var actualHeight = Number(HeightBMI.value) * 10;
                        var actualWeight = 0;
                        if (WeightBMI.value.toLowerCase().includes('.')) {
                            console.log(WeightBMI.value.toLowerCase().includes('.'));
                            var result1 = WeightBMI.value.substring(0, WeightBMI.value.indexOf("."));
                            if (result2.length == 1) {
                                actualWeight = Number(result1) * 1000 + Number(result2) * 100;


                            } else if (result2.length == 2) {
                                actualWeight = Number(result1) * 1000 + Number(result2) * 10;
                            } else if (result2.length == 3) {
                                actualWeight = Number(result1) * 1000 + Number(result2);
                            }

                        } else {
                            actualWeight = Number(WeightBMI.value) * 1000;

                        }


                    } else {
                        divloader.style.display = "none";
                        lblerrorBMI.innerText = WeightFormatError;
                        BMIErr.style.display = "block";
                        divloader.style.display = "none";
                        return false;
                    }



                } else {

                    var actualHeight = Number(HeightBMI.value) * 10;
                    var actualWeight = Number(WeightBMI.value) * 1000;

                }

                var mm = "mm";
                var gram = "gram";
                divloader.style.display = "block";

                $.ajax({
                    type: "POST",
                    url: "{{ url('savetaketestdata') }}",

                    data: {
                        UserId: F365Id,
                        Height: actualHeight,
                        Weight: actualWeight,
                        AgeGroupId: ageGroupId,
                        ParameterOfWeight: gram,
                        ParameterOfHeight: mm,
                        Age: age,
                        Gender: gender,
                        ParentId:parentId ,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(response) {




                        for (let j = 0; j < response.length; j++) {

                            if (response[j]['TestTypeId'] == '6') {
                                var weightText = Number(response[j]['Score']) / 1000;
                            }
                            if (response[j]['TestTypeId'] == '7') {
                                var heightText = Number(response[j]['Score']) / 10;
                            }
                        }
                        var time = response[0]['TIME'];
                        console.log(heightText);
                        console.log(weightText);
                        document.getElementById('upBMI').style.display = 'block';
                        document.getElementById('upScoreBMI').innerHTML =
                            `${heightText}${' '} cm,${weightText}${' '} kg`;
                        document.getElementById('upTimeBMI').innerHTML = `[${time}]`;
                        // divloader.style.display = "none";
                        // lblerrorBMI.innerText = WeightFormatError;
                        BMIErr.style.display = "none";

                        divloader.style.display = "none";


                    }
                })

                if (button2innerHTMl == divbuttoninnerHtml) {

                    document.getElementById('HeightBMI').removeAttribute('readonly');
                    console.log(HeightBMI);
                    WeightBMI.removeAttribute('readonly');
                    document.getElementById('Button2').innerHTML = "{{ __('taketest.label6') }}";
                    HeightBMI.value = "";
                    WeightBMI.value = "";
                }




            }


        });







        document.getElementById('btnSR').addEventListener("click", function sitandrich(e) {
            e.preventDefault();
            console.log(e.target.id);
            var btnsrHTML = document.getElementById('btnSR').innerHTML;

            if (((Sitrichcm.value == "") && (Sitrichmm.value === ""))) {

                lblerrorSR.innerText = SitAndReachError;
                SitricError.style.display = "block";
                divloader.style.display = "none";
                divloader.style.display = "none";
                return false;

            }

            if (((Sitrichcm.value == "0") && (Sitrichmm.value == "0"))) {

                lblerrorSR.innerText = SitAndReachError;
                SitricError.style.display = "block";
                divloader.style.display = "none";
                divloader.style.display = "none";
                return false;

            }

            if (Sitrichcm.value > 99 || Sitrichcm.value < 0) {
                lblerrorSR.innerText = SitAndReachValueExistErrorCm;
                SitricError.style.display = "block";
                divloader.style.display = "none";
                divloader.style.display = "none";
                return false;

            }
            if (Sitrichmm.value > 99 || Sitrichmm.value < 0) {
                lblerrorSR.innerText = SitAndReachValueExistErrorMm;
                SitricError.style.display = "block";
                divloader.style.display = "none";
                divloader.style.display = "none";
                return false;

            }

            document.getElementById('btnSR').innerHTML = "{{ __('taketest.label19') }}";

            console.log(btnsrHTML);
            Sitrichcm.setAttribute('readonly', "readonly");
            console.log(Sitrichcm);

            Sitrichmm.setAttribute('readonly', "readonly");
            SitricError.style.display = "none";

            var SitrichScore = ((Number(Sitrichcm.value) * 10) + (Number(Sitrichmm.value)));
            var SitrichScoreunit = "mm";
            divloader.style.display = "block";

            $.ajax({
                type: "POST",
                url: "{{ url('savetaketestsitrich') }}",

                data: {
                    UserId: F365Id,
                    scoreunit: SitrichScoreunit,
                    score: SitrichScore,
                    AgeGroupId: ageGroupId,
                    Age: age,
                    Gender: gender,
                    ParentId: parentId,
                    TestTypeId: 8,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {

                    console.log(response);
                    for (let l = 0; l < response.length; l++) {
                        if (response[l]['TestTypeId'] == '8') {
                            var scoreText = Number(response[l]['Score']) / 10;
                            var scoreTime = response[l]['TIME'];
                        }
                    }
                    document.getElementById('upSR').style.display = "block";
                    document.getElementById('upScoreSR').innerHTML = `${scoreText}${' '}cm`;

                    document.getElementById('upTimeSR').innerHTML = `[${scoreTime}]`;
                    SitricError.style.display = "none";
                    divloader.style.display = "none";
                }


            });

            if (btnsrHTML == divbuttoninnerHtml) {
                Sitrichmm.removeAttribute('readonly');
                Sitrichcm.removeAttribute('readonly');
                document.getElementById('btnSR').innerHTML = "{{ __('taketest.label6') }}";
                Sitrichmm.value = "";
                Sitrichcm.value = "";
            }





        });



        document.getElementById('btn50').addEventListener('click', function mt50Dash(e) {
            e.preventDefault();
            var btn50HTML = document.getElementById('btn50').innerHTML;
            console.log(Sec50.value.length);
            console.log(Ms50.value.length);

            if (((Ms50.value == "") && (Sec50.value === ""))) {
                err50.style.display = "block";
                lblerror50.innerHTML = "{{ __('taketest.label52') }}";
                divloader.style.display = "none";
                return false;

            }



            if (((Ms50.value == "0") && (Sec50.value === "0"))) {
                err50.style.display = "block";
                lblerror50.innerHTML = "{{ __('taketest.label52') }}";
                divloader.style.display = "none";
                return false;

            } else if (Sec50.value.length > 2 || Number(Sec50.value) >= 60 || Number(Sec50.value) < 0) {
                if (Sec50.value.length > 2) {
                    err50.style.display = "block";
                    lblerror50.innerHTML = "{{ __('taketest.label46') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(Sec50.value) >= 60) {
                    err50.style.display = "block";
                    lblerror50.innerHTML = "{{ __('taketest.label47') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(Sec50.value) < 0) {
                    err50.style.display = "block";
                    lblerror50.innerHTML = "{{ __('taketest.label48') }}";
                    divloader.style.display = "none";
                    return false;
                }

            } else if (Ms50.value.length > 3 || Number(Ms50.value) < 0 || Number(Ms50.value) < 999) {
                if (Ms50.value.length > 3) {
                    err50.style.display = "block";
                    lblerror50.innerHTML = "{{ __('taketest.label49') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(Ms50.value) < 0) {
                    err50.style.display = "block";
                    lblerror50.innerHTML = "{{ __('taketest.label51') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(Ms50.value) > 999) {
                    err50.style.display = "block";
                    lblerror50.innerHTML = "{{ __('taketest.label50') }}";
                    divloader.style.display = "none";
                    return false;
                }
            }

            if (Number(Sec50.value) > 0 && Number(Ms50.value) > 0) {
                var score50 = Number(Sec50.value) * 1000 + Number(Ms50.value);
                var score50unit = "msec";
                Sec50.setAttribute('readonly', "readonly");
                Ms50.setAttribute('readonly', "readonly");
                document.getElementById('btn50').innerHTML = "{{ __('taketest.label19') }}";
                err50.style.display = "none";
                divloader.style.display = "block";

                $.ajax({
                    type: "POST",
                    url: "{{ url('save50mtdash') }}",

                    data: {
                        UserId: F365Id,
                        AgeGroupId: ageGroupId,
                        Score50unit: score50unit,
                        Score50: score50,
                        Age: age,
                        Gender: gender,
                        ParentId: parentId,
                        TestTypeId: 54,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(response) {
                        divloader.style.display = "none";
                        console.log(response);


                        for (let k = 0; k < response.length; k++) {
                            if (response[k]['TestTypeId'] == '54') {
                                var dash50ScoreHTML = Number(response[k]['Score']) / 1000;
                                var dash50TimeHTML = response[k]['TIME'];
                            }
                        }

                        document.getElementById('up50').style.display = "block";
                        document.getElementById('upScore50').innerHTML = `${dash50ScoreHTML}${' '} Sec`;
                        document.getElementById('upTime50').innerHTML = `[${dash50TimeHTML}]`;
                        err50.style.display = "none";
                        divloader.style.display = "none";



                    }

                })



                if (btn50HTML == divbuttoninnerHtml) {
                    Sec50.removeAttribute('readonly');
                    Ms50.removeAttribute('readonly');
                    document.getElementById('btn50').innerHTML = "{{ __('taketest.label6') }}";
                    Sec50.value = "";
                    Ms50.value = "";
                }


            }


        });


        document.getElementById('btnPartial').addEventListener('click', function partialsave(e) {


            var btnPartialHTML = document.getElementById('btnPartial').innerHTML;

            if (countPartial.value == "") {
                errPartial.style.display = "block";
                lblerrPartial.innerHTML = "{{ __('taketest.label53') }}";
                divloader.style.display = "none";
                return false;
            }
            if (countPartial.value.length > 2 || Number(countPartial.value) > 99 || Number(countPartial.value) <
                0) {
                if (countPartial.value.Length > 2) {
                    errPartial.style.display = "block";
                    lblerrPartial.innerHTML = "{{ __('taketest.label54') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(countPartial.value) > 99) {
                    errPartial.style.display = "block";
                    lblerrPartial.innerHTML = "{{ __('taketest.label55') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(countPartial.value) < 0) {
                    errPartial.style.display = "block";
                    lblerrPartial.innerHTML = "{{ __('taketest.label56') }}";
                    divloader.style.display = "none";
                    return false;

                }
            }

            countPartial.setAttribute('readonly', "readonly");
            errPartial.style.display = "none";
            var partialScore = Number(countPartial.value);
            var partialScoreUnit = "number";
            document.getElementById('btnPartial').innerHTML = "{{ __('taketest.label19') }}";
            divloader.style.display = "block";

            $.ajax({
                type: "POST",
                url: "{{ url('savepartialcurl') }}",

                data: {
                    UserId: F365Id,
                    AgeGroupId: ageGroupId,
                    ScorePartialunit: partialScoreUnit,
                    ScorePartial: partialScore,
                    TestTypeId: 55,
                    Age: age,
                    Gender: gender,
                    ParentId: parentId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {

                    for (let m = 0; m < response.length; m++) {
                        if (response[m]['TestTypeId'] == '55') {
                            var particalscoreresponsevalue = response[m]['Score'];
                            var particalTimeresponsevalue = response[m]['TIME'];

                        }
                    }


                    document.getElementById('upPartial').style.display = "block";
                    document.getElementById('upScorePartial').innerHTML =
                        `${particalscoreresponsevalue}${' '}Times`;
                    document.getElementById('upTimePartial').innerHTML =
                        `[${particalTimeresponsevalue}]`;
                    divloader.style.display = "none";

                }
            });


            if (btnPartialHTML == divbuttoninnerHtml) {
                countPartial.removeAttribute('readonly');

                document.getElementById('btnPartial').innerHTML = "{{ __('taketest.label6') }}";
                countPartial.value = "";

            }



        });


        document.getElementById('btnPushup').addEventListener('click', function savepushup(e) {
            e.preventDefault();
            var btnpushupHTML = document.getElementById('btnPushup').innerHTML;
            if (countPushup.value == "") {
                errPushup.style.display = "block";
                lblerrPushup.innerHTML = "{{ __('taketest.label53') }}";
                divloader.style.display = "none";
                return false;
            }
            if (countPushup.value.length > 2 || Number(countPushup.value) > 99 || Number(countPushup.value) < 0) {
                if (countPushup.value.Length > 2) {
                    errPushup.style.display = "block";
                    lblerrPushup.innerHTML = "{{ __('taketest.label54') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(countPushup.value) > 99) {
                    errPushup.style.display = "block";
                    lblerrPushup.innerHTML = "{{ __('taketest.label55') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(countPushup.value) < 0) {
                    errPushup.style.display = "block";
                    lblerrPushup.innerHTML = "{{ __('taketest.label56') }}";
                    divloader.style.display = "none";
                    return false;

                }
            }

            countPushup.setAttribute('readonly', "readonly");
            errPushup.style.display = "none";
            var pushupScore = Number(countPushup.value);
            var pushScoreUnit = "number";
            document.getElementById('btnPushup').innerHTML = "{{ __('taketest.label19') }}";
            divloader.style.display = "block";

            $.ajax({
                type: "POST",
                url: "{{ url('savepushup') }}",

                data: {
                    UserId: F365Id,
                    AgeGroupId: ageGroupId,
                    ScorePushupunit: pushScoreUnit,
                    ScorePushup: pushupScore,
                    Age: age,
                    Gender: gender,
                    ParentId: parentId,
                    TestTypeId:57,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {

                    for (let m = 0; m < response.length; m++) {
                        if (response[m]['TestTypeId'] == '57') {
                            var pushscoreresponsevalue = response[m]['Score'];
                            var pushTimeresponsevalue = response[m]['TIME'];

                        }
                    }


                    document.getElementById('upPush').style.display = "block";
                    document.getElementById('upScorePush').innerHTML =
                        `${pushscoreresponsevalue}${' '}Times`;
                    document.getElementById('upTimePush').innerHTML = `${pushTimeresponsevalue}`;
                    divloader.style.display = "none";

                }
            });


            if (btnpushupHTML == divbuttoninnerHtml) {
                countPushup.removeAttribute('readonly');

                document.getElementById('btnPartial').innerHTML = "{{ __('taketest.label6') }}";
                countPushup.value = "";

            }



        });





        document.getElementById('btnFlamingo').addEventListener('click', function savepushup(e) {
            e.preventDefault();
            var btnFlamingoHTML = document.getElementById('btnFlamingo').innerHTML;
            if (countFlamingo.value == "") {
                errFlamingo.style.display = "block";
                lblerrFlamingo.innerHTML = "{{ __('taketest.label53') }}";
                divloader.style.display = "none";
                return false;
            }
            if (countFlamingo.value.length > 2 || Number(countFlamingo.value) > 99 || Number(countFlamingo.value) < 0) {
                if (countFlamingo.value.Length > 2) {
                    errFlamingo.style.display = "block";
                    lblerrFlamingo.innerHTML = "{{ __('taketest.label54') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(countFlamingo.value) > 99) {
                    errFlamingo.style.display = "block";
                    lblerrFlamingo.innerHTML = "{{ __('taketest.label55') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(countFlamingo.value) < 0) {
                    errFlamingo.style.display = "block";
                    lblerrFlamingo.innerHTML = "{{ __('taketest.label56') }}";
                    divloader.style.display = "none";
                    return false;

                }
            }

            countFlamingo.setAttribute('readonly', "readonly");
            errFlamingo.style.display = "none";
            var countFlamingoScore = Number(countFlamingo.value);
            var countFlamingoScoreUnit = "number";
            document.getElementById('btnFlamingo').innerHTML = "{{ __('taketest.label19') }}";
            divloader.style.display = "block";

            $.ajax({
                type: "POST",
                url: "{{ url('savepartialcurl') }}",

                data: {
                    UserId: F365Id,
                    AgeGroupId: ageGroupId,
                    ScorePartialunit: countFlamingoScoreUnit,
                    ScorePartial: countFlamingoScore,
                    Age: age,
                    Gender: gender,
                    ParentId: parentId,
                    TestTypeId:60,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {

                    for (let m = 0; m < response.length; m++) {
                        if (response[m]['TestTypeId'] == '60') {
                            var Flamingoscoreresponsevalue = response[m]['Score'];
                            var FlamingoTimeresponsevalue = response[m]['TIME'];

                        }
                    }


                    document.getElementById('upFlamingo').style.display = "block";
                    document.getElementById('upScoreFlamingo').innerHTML =
                        `${Flamingoscoreresponsevalue}${' '}Times`;
                    document.getElementById('upTimeFlamingo').innerHTML = `[${FlamingoTimeresponsevalue}]`;
                    divloader.style.display = "none";

                }
            });


            if (btnFlamingoHTML == divbuttoninnerHtml) {
                countFlamingo.removeAttribute('readonly');

                document.getElementById('btnFlamingo').innerHTML = "{{ __('taketest.label6') }}";
                countFlamingo.value = "";

            }



        });



        document.getElementById('btn600mt').addEventListener('click', function savebtn600mt(e) {
            e.preventDefault();



            btn600HTML = document.getElementById('btn600mt').innerHTML;
            if (Number(Min600.value) == 0 && Number(Sec600.value) == 0 && Number(Ms600.value) == 0) {
                err600.style.display = "block";
                lblerror600.innerHTML = "{{ __('taketest.label42') }}";
                divloader.style.display = "none";
                return false;
            }
            if (Min600.value == "") {
                err600.style.display = "block";
                lblerror600.innerHTML = "{{ __('taketest.label39') }}";
                divloader.style.display = "none";
                return false;
            }


            if (Number(Min600.value) < 0) {
                err600.style.display = "block";
                lblerror600.innerHTML = "{{ __('taketest.label45') }}";
                divloader.style.display = "none";
                return false;
            }
            if (Number(Min600.value) >= 60) {
                err600.style.display = "block";
                lblerror600.innerHTML = "{{ __('taketest.label44') }}";
                divloader.style.display = "none";
                return false;
            }

            if (Min600.value.length > 2) {
                err600.style.display = "block";
                lblerror600.innerHTML = "{{ __('taketest.label43') }}";
                divloader.style.display = "none";
                return false;
            }



            if (Sec600.value == "") {
                err600.style.display = "block";
                lblerror600.innerHTML = "{{ __('taketest.label40') }}";
                divloader.style.display = "none";
                return false;
            }






            if (Sec600.value.length > 2) {
                err600.style.display = "block";
                lblerror600.innerHTML = "{{ __('taketest.label46') }}";
                divloader.style.display = "none";
                return false;
            }


            if (Number(Sec600.value) >= 60) {
                err600.style.display = "block";
                lblerror600.innerHTML = "{{ __('taketest.label47') }}";
                divloader.style.display = "none";
                return false;
            }

            if (Number(Sec600.value) < 0) {
                err600.style.display = "block";
                lblerror600.innerHTML = "{{ __('taketest.label48') }}";
                divloader.style.display = "none";
                return false;
            }




            if (Ms600.value == "") {
                err600.style.display = "block";
                lblerror600.innerHTML = "{{ __('taketest.label41') }}";
                divloader.style.display = "none";
                return false;
            }






            if (Ms600.value.length > 3) {
                err600.style.display = "block";
                lblerror600.innerHTML = "{{ __('taketest.label49') }}";
                divloader.style.display = "none";
                return false;
            }

            if (Number(Ms600.value) >= 999) {
                err600.style.display = "block";
                lblerror600.innerHTML = "{{ __('taketest.label50') }}";
                divloader.style.display = "none";
                return false;
            }

            if (Number(Ms600.value) < 0) {
                err600.style.display = "block";
                lblerror600.innerHTML = "{{ __('taketest.label51') }}";
                divloader.style.display = "none";
                return false;
            }

            var Score600 = Number(Min600.value) * 60000 + Number(Sec600.value) * 1000 + Number(Ms600.value);
            var Score600Unit = "msec";
            Min600.setAttribute("readonly", "readonly");
            Sec600.setAttribute("readonly", "readonly");
            Ms600.setAttribute("readonly", "readonly");
            document.getElementById('btn600mt').innerHTML = "{{ __('taketest.label19') }}";
            divloader.style.display = "block";

            $.ajax({
                type: "POST",
                url: "{{ url('save600runwalk') }}",

                data: {
                    UserId: F365Id,
                    AgeGroupId: ageGroupId,
                    Score600unit: Score600Unit,
                    Score600: Score600,
                    Age: age,
                    Gender: gender,
                    ParentId: parentId,
                    TestTypeId:19,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {
                    divloader.style.display = "none";
                    console.log(response);
                    for (let m = 0; m < response.length; m++) {
                        if (response[m]['TestTypeId'] == '19') {

                            var Mt600RunWalkscoreresponsevalue = (Number(response[m]['Score']) *
                                1.666667 / 100000).toString().substring(0, 4);

                            var Mt600RunWalksTimeresponsevalue = response[m]['TIME'];

                        }
                    }

                    document.getElementById('up600').style.display = "block";
                    document.getElementById('upScore600').innerHTML =
                        `[${Mt600RunWalkscoreresponsevalue}${' '}Min]`;
                    document.getElementById('upTime600').innerHTML =
                        `${Mt600RunWalksTimeresponsevalue}`;
                    divloader.style.display = "none";




                }
            });

            if (btn600HTML == divbuttoninnerHtml) {
                Min600.removeAttribute('readonly');
                Sec600.removeAttribute('readonly');
                Ms600.removeAttribute('readonly');

                document.getElementById('btn600mt').innerHTML = "{{ __('taketest.label6') }}";
                Min600.value = "";
                Sec600.value = "";
                Ms600.value = "";

            }




        });


        document.getElementById('btnPlate').addEventListener('click', function savebtn600mt(e) {
            e.preventDefault();



            btnPlateHTML = document.getElementById('btnPlate').innerHTML;
            if (Number(MinPlate.value) == 0 && Number(SecPlate.value) == 0 && Number(MsPlate.value) == 0) {
                errPlate.style.display = "block";
                lblerrorPlate.innerHTML = "{{ __('taketest.label42') }}";
                divloader.style.display = "none";
                return false;
            }
            if (MinPlate.value == "") {
                errPlate.style.display = "block";
                lblerrorPlate.innerHTML = "{{ __('taketest.label39') }}";
                divloader.style.display = "none";
                return false;
            }


            if (Number(MinPlate.value) < 0) {
                errPlate.style.display = "block";
                lblerrorPlate.innerHTML = "{{ __('taketest.label45') }}";
                divloader.style.display = "none";
                return false;
            }
            if (Number(MinPlate.value) >= 60) {
                errPlate.style.display = "block";
                lblerrorPlate.innerHTML = "{{ __('taketest.label44') }}";
                divloader.style.display = "none";
                return false;
            }

            if (MinPlate.value.length > 2) {
                errPlate.style.display = "block";
                lblerrorPlate.innerHTML = "{{ __('taketest.label43') }}";
                divloader.style.display = "none";
                return false;
            }



            if (SecPlate.value == "") {
                errPlate.style.display = "block";
                lblerrorPlate.innerHTML = "{{ __('taketest.label40') }}";
                divloader.style.display = "none";
                return false;
            }






            if (SecPlate.value.length > 2) {
                errPlate.style.display = "block";
                lblerrorPlate.innerHTML = "{{ __('taketest.label46') }}";
                divloader.style.display = "none";
                return false;
            }


            if (Number(SecPlate.value) >= 60) {
                errPlate.style.display = "block";
                lblerrorPlate.innerHTML = "{{ __('taketest.label47') }}";
                divloader.style.display = "none";
                return false;
            }

            if (Number(SecPlate.value) < 0) {
                errPlate.style.display = "block";
                lblerrorPlate.innerHTML = "{{ __('taketest.label48') }}";
                divloader.style.display = "none";
                return false;
            }




            if (MsPlate.value == "") {
                errPlate.style.display = "block";
                lblerrorPlate.innerHTML = "{{ __('taketest.label41') }}";
                divloader.style.display = "none";
                return false;
            }






            if (MsPlate.value.length > 3) {
                errPlate.style.display = "block";
                lblerrorPlate.innerHTML = "{{ __('taketest.label49') }}";
                divloader.style.display = "none";
                return false;
            }

            if (Number(MsPlate.value) >= 999) {
                errPlate.style.display = "block";
                lblerrorPlate.innerHTML = "{{ __('taketest.label50') }}";
                divloader.style.display = "none";
                return false;
            }

            if (Number(MsPlate.value) < 0) {
                errPlate.style.display = "block";
                lblerrorPlate.innerHTML = "{{ __('taketest.label51') }}";
                divloader.style.display = "none";
                return false;
            }

            var ScorePlate = Number(MinPlate.value) * 60000 + Number(SecPlate.value) * 1000 + Number(MsPlate.value);
            var ScorePlateUnit = "msec";
            MinPlate.setAttribute("readonly", "readonly");
            SecPlate.setAttribute("readonly", "readonly");
            MsPlate.setAttribute("readonly", "readonly");
            document.getElementById('btnPlate').innerHTML = "{{ __('taketest.label19') }}";
            divloader.style.display = "block";

            $.ajax({
                type: "POST",
                url: "{{ url('save600runwalk') }}",

                data: {
                    UserId: F365Id,
                    AgeGroupId: ageGroupId,
                    Score600unit: ScorePlateUnit,
                    Score600: ScorePlate,
                    Age: age,
                    Gender: gender,
                    ParentId: parentId,
                    TestTypeId:59,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {

                    console.log(response);
                    for (let m = 0; m < response.length; m++) {
                        if (response[m]['TestTypeId'] == '59') {

                            var MtPlatescoreresponsevalue = (Number(response[m]['Score']) *
                                1.666667 / 100000).toString().substring(0, 4);

                            var MtPlateTimeresponsevalue = response[m]['TIME'];

                        }
                    }

                    document.getElementById('upPlate').style.display = "block";
                    document.getElementById('upScorePlate').innerHTML =
                        `[${MtPlatescoreresponsevalue}${' '}Min]`;
                    document.getElementById('upTimePlate').innerHTML =
                        `${MtPlateTimeresponsevalue}`;
                    divloader.style.display = "none";




                }
            });

            if (btnPlateHTML == divbuttoninnerHtml) {
                MinPlate.removeAttribute('readonly');
                SecPlate.removeAttribute('readonly');
                MsPlate.removeAttribute('readonly');

                document.getElementById('btnPlate').innerHTML = "{{ __('taketest.label6') }}";
                MinPlate.value = "";
                SecPlate.value = "";
                MsPlate.value = "";

            }




        });


        document.getElementById('btn2mt').addEventListener('click', function savebtn600mt(e) {
            e.preventDefault();



            btn2mtHTML = document.getElementById('btn2mt').innerHTML;
            if (Number(Min2.value) == 0 && Number(Sec2.value) == 0 && Number(Ms2.value) == 0) {
                err2.style.display = "block";
                lblerror2.innerHTML = "{{ __('taketest.label42') }}";
                divloader.style.display = "none";
                return false;
            }
            if (Min2.value == "") {
                err2.style.display = "block";
                lblerror600.innerHTML = "{{ __('taketest.label39') }}";
                divloader.style.display = "none";
                return false;
            }


            if (Number(Min2.value) < 0) {
                err2.style.display = "block";
                lblerror2.innerHTML = "{{ __('taketest.label45') }}";
                divloader.style.display = "none";
                return false;
            }
            if (Number(Min2.value) >= 60) {
                err2.style.display = "block";
                lblerror2.innerHTML = "{{ __('taketest.label44') }}";
                divloader.style.display = "none";
                return false;
            }

            if (Min2.value.length > 2) {
                err2.style.display = "block";
                lblerror2.innerHTML = "{{ __('taketest.label43') }}";
                divloader.style.display = "none";
                return false;
            }



            if (Sec2.value == "") {
                err600.style.display = "block";
                lblerror600.innerHTML = "{{ __('taketest.label40') }}";
                divloader.style.display = "none";
                return false;
            }






            if (Sec2.value.length > 2) {
                err2.style.display = "block";
                lblerror2.innerHTML = "{{ __('taketest.label46') }}";
                divloader.style.display = "none";
                return false;
            }


            if (Number(Sec2.value) >= 60) {
                err2.style.display = "block";
                lblerror2.innerHTML = "{{ __('taketest.label47') }}";
                divloader.style.display = "none";
                return false;
            }

            if (Number(Sec2.value) < 0) {
                err2.style.display = "block";
                lblerror2.innerHTML = "{{ __('taketest.label48') }}";
                divloader.style.display = "none";
                return false;
            }




            if (Ms2.value == "") {
                err2.style.display = "block";
                lblerror2.innerHTML = "{{ __('taketest.label41') }}";
                divloader.style.display = "none";
                return false;
            }






            if (Ms2.value.length > 3) {
                err2.style.display = "block";
                lblerror2.innerHTML = "{{ __('taketest.label49') }}";
                divloader.style.display = "none";
                return false;
            }

            if (Number(Ms2.value) >= 999) {
                err2.style.display = "block";
                lblerror2.innerHTML = "{{ __('taketest.label50') }}";
                divloader.style.display = "none";
                return false;
            }

            if (Number(Ms2.value) < 0) {
                err2.style.display = "block";
                lblerror2.innerHTML = "{{ __('taketest.label51') }}";
                divloader.style.display = "none";
                return false;
            }

            var Score2walk = Number(Min2.value) * 60000 + Number(Sec2.value) * 1000 + Number(Ms2.value);
            var Score2walkUnit = "msec";
            Min2.setAttribute("readonly", "readonly");
            Sec2.setAttribute("readonly", "readonly");
            Ms2.setAttribute("readonly", "readonly");
            document.getElementById('btn2mt').innerHTML = "{{ __('taketest.label19') }}";
            divloader.style.display = "block";

            $.ajax({
                type: "POST",
                url: "{{ url('save600runwalk') }}",

                data: {
                    UserId: F365Id,
                    AgeGroupId: ageGroupId,
                    Score600unit: Score2walkUnit,
                    Score600: Score2walk,
                    Age: age,
                    Gender: gender,
                    ParentId: parentId,
                    TestTypeId:1003,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {

                    console.log(response);
                    for (let m = 0; m < response.length; m++) {
                        if (response[m]['TestTypeId'] == '1003') {

                            var Mt2Scoreresponsevalue = (Number(response[m]['Score']) *
                                1.666667 / 100000).toString().substring(0, 4);

                            var Mt2ScoreTimeresponsevalue = response[m]['TIME'];

                        }
                    }

                    document.getElementById('up2').style.display = "block";
                    document.getElementById('upScore2').innerHTML =
                        `[${Mt2Scoreresponsevalue}${' '}Min]`;
                    document.getElementById('upTime2').innerHTML =
                        `${Mt2ScoreTimeresponsevalue}`;
                    divloader.style.display = "none";




                }
            });

            if (btn2mtHTML == divbuttoninnerHtml) {
                Min2.removeAttribute('readonly');
                Sec2.removeAttribute('readonly');
                Ms2.removeAttribute('readonly');

                document.getElementById('btn2mt').innerHTML = "{{ __('taketest.label6') }}";
                Min2.value = "";
                Sec2.value = "";
                Ms2.value = "";

            }




        });


        document.getElementById('btnChairStand').addEventListener('click', function chaistandsave(e) {

            e.preventDefault();
            var btnchairstandHTML = document.getElementById('btnChairStand').innerHTML;
            if (countChairStand.value == "") {
                errChairStand.style.display = "block";
                lblerrChairStand.innerHTML = "{{ __('taketest.label53') }}";
                divloader.style.display = "none";
                return false;

            }
            if (countChairStand.value.length > 3) {
                errChairStand.style.display = "block";
                lblerrChairStand.innerHTML = "{{ __('taketest.label54') }}";
                divloader.style.display = "none";
                return false;

            }
            if (Number(countChairStand.value) < 0) {
                errChairStand.style.display = "block";
                lblerrChairStand.innerHTML = "{{ __('taketest.label56') }}";
                divloader.style.display = "none";
                return false;

            }
            countChairStand.setAttribute('readonly', "readonly");
            errChairStand.style.display = "none";;
            document.getElementById('btnChairStand').innerHTML = "{{ __('taketest.label19') }}";


            var chairstandscore = Number(countChairStand.value);
            var chairstandUnit = "Times";
            divloader.style.display = "block";

            $.ajax({
                type: "POST",
                url: "{{ url('savepartialcurl') }}",

                data: {
                    UserId: F365Id,
                    AgeGroupId: ageGroupId,
                    ScorePartialunit: chairstandUnit,
                    ScorePartial: chairstandscore,
                    TestTypeId: 1005,
                    Age: age,
                    Gender: gender,
                    ParentId: parentId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {
                    divloader.style.display = "none";
                    for (let m = 0; m < response.length; m++) {
                        if (response[m]['TestTypeId'] == '1005') {
                            var chairstandScoreresponsevalue = response[m]['Score'];
                            var chairstandTimeresponsevalue = response[m]['TIME'];

                        }
                    }


                    document.getElementById('upChairStand').style.display = "block";
                    document.getElementById('upScoreChairStand').innerHTML =
                        `${chairstandScoreresponsevalue}${' '}Times`;
                    document.getElementById('upTimeChairStand').innerHTML =
                        `[${chairstandTimeresponsevalue}]`;
                    errChairStand.style.display = "none";
                    divloader.style.display = "none";

                }
            });
            if (btnchairstandHTML == divbuttoninnerHtml) {
                countChairStand.removeAttribute('readonly');


                document.getElementById('btnChairStand').innerHTML = "{{ __('taketest.label6') }}";
                countChairStand.value = "";


            }

        });


        document.getElementById('btnChairSR').addEventListener('click', function chairseatreachsave(e) {
            e.preventDefault();

            var btnChairSRHTML = document.getElementById('btnChairSR').innerHTML;




            if (((cmChairSR.value == "") && (mmChairSR.value === "")) || (cmChairSR.value == "") || (mmChairSR
                    .value === "")) {

                lblerrorChairSR.innerText = SitAndReachError;
                errChairSR.style.display = "block";
                divloader.style.display = "none";
                divloader.style.display = "none";
                return false;

            }

            if (((cmChairSR.value == "0") && (mmChairSR.value == "0")) || (cmChairSR.value == "") || (mmChairSR
                    .value === "")) {

                lblerrorChairSR.innerText = SitAndReachError;
                errChairSR.style.display = "block";
                divloader.style.display = "none";
                divloader.style.display = "none";
                return false;

            }

            if (cmChairSR.value > 99 || cmChairSR.value < 0) {
                lblerrorChairSR.innerText = SitAndReachValueExistErrorCm;
                errChairSR.style.display = "block";
                divloader.style.display = "none";
                divloader.style.display = "none";
                return false;

            }
            if (mmChairSR.value > 99 || mmChairSR.value < 0) {
                lblerrorChairSR.innerText = SitAndReachValueExistErrorMm;
                errChairSR.style.display = "block";
                divloader.style.display = "none";
                divloader.style.display = "none";
                return false;

            }


            document.getElementById('btnChairSR').innerHTML = "{{ __('taketest.label19') }}";


            cmChairSR.setAttribute('readonly', "readonly");
            mmChairSR.setAttribute('readonly', "readonly");
            errChairSR.style.display = "none";

            var chairSitrichScore = ((Number(cmChairSR.value) * 10) + (Number(mmChairSR.value)));
            var chairSitrichScoreunit = "mm";
            divloader.style.display = "block";


            $.ajax({
                type: "POST",
                url: "{{ url('savetaketestsitrich') }}",

                data: {
                    UserId: F365Id,
                    scoreunit: chairSitrichScoreunit,
                    score: chairSitrichScore,
                    AgeGroupId: ageGroupId,
                    Age: age,
                    TestTypeId: 1006,
                    Gender: gender,
                    ParentId: parentId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {
                    divloader.style.display = "none";
                    console.log(response);
                    for (let l = 0; l < response.length; l++) {
                        if (response[l]['TestTypeId'] == '1006') {
                            var scoreText = Number(response[l]['Score']) / 10;
                            var scoreTime = response[l]['TIME'];
                        }
                    }
                    document.getElementById('upChairSR').style.display = "block";
                    document.getElementById('upScoreChairSR').innerHTML = `${scoreText}${' '} mm`;

                    document.getElementById('upTimeChairSR').innerHTML = scoreTime;
                    errChairSR.style.display = "none";
                    divloader.style.display = "none";
                }


            });

            if (btnChairSRHTML == divbuttoninnerHtml) {
                cmChairSR.removeAttribute('readonly');
                mmChairSR.removeAttribute('readonly');
                document.getElementById('btnChairSR').innerHTML = "{{ __('taketest.label6') }}";
                cmChairSR.value = "";
                mmChairSR.value = "";
            }


        });


        document.getElementById('btnBackScratch').addEventListener('click', function backscratch(e) {
            e.preventDefault();
            var btnBackScratchHTML = document.getElementById('btnBackScratch').innerHTML;

            if (((cmBackScratch.value == "") && (mmBackScratch.value === ""))) {

                lblerrorBackScratch.innerText = "{{ __('taketest.label71') }}";
                BackScratcherr.style.display = "block";
                divloader.style.display = "none";
                divloader.style.display = "none";
                return false;

            }

            if ((cmBackScratch.value == "")) {
                lblerrorBackScratch.innerText = "{{ __('taketest.label81') }}";
                BackScratcherr.style.display = "block";
                divloader.style.display = "none";
                divloader.style.display = "none";
                return false;

            }
            if ((mmBackScratch.value == "")) {
                lblerrorBackScratch.innerText = "{{ __('taketest.label82') }}";
                BackScratcherr.style.display = "block";
                divloader.style.display = "none";
                divloader.style.display = "none";
                return false;

            }

            if (((cmBackScratch.value == "0") && (mmBackScratch.value == "0")) || (cmBackScratch.value == "") || (
                    mmBackScratch
                    .value === "")) {

                lblerrorBackScratch.innerText = "{{ __('taketest.label30') }}";
                BackScratcherr.style.display = "block";
                divloader.style.display = "none";
                divloader.style.display = "none";
                return false;

            }

            if (cmBackScratch.value > 99 || cmBackScratch.value < 0) {
                lblerrorBackScratch.innerText = "{{ __('taketest.label32') }}";
                BackScratcherr.style.display = "block";
                divloader.style.display = "none";
                divloader.style.display = "none";
                return false;

            }
            if (mmBackScratch.value > 99 || mmBackScratch.value < 0) {
                lblerrorBackScratch.innerText = "{{ __('taketest.label33') }}";
                BackScratcherr.style.display = "block";
                divloader.style.display = "none";
                divloader.style.display = "none";
                return false;

            }

            document.getElementById('btnBackScratch').innerHTML = "{{ __('taketest.label19') }}"
            cmBackScratch.setAttribute('readonly', "readonly");
            mmBackScratch.setAttribute('readonly', "readonly");
            BackScratcherr.style.display = "none";

            var BackScratchScore = ((Number(cmBackScratch.value) * 10) + (Number(mmBackScratch.value)));
            var BackScratchScoreunit = "mm";
            divloader.style.display = "block";

            $.ajax({
                type: "POST",
                url: "{{ url('savetaketestsitrich') }}",

                data: {
                    UserId: F365Id,
                    scoreunit: BackScratchScoreunit,
                    score: BackScratchScore,
                    AgeGroupId: ageGroupId,
                    Age: age,
                    TestTypeId: 1009,
                    Gender: gender,
                    ParentId: parentId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {
                    divloader.style.display = "none";
                    console.log(response);
                    for (let l = 0; l < response.length; l++) {
                        if (response[l]['TestTypeId'] == '1009') {
                            var scoreText = Number(response[l]['Score']) / 10;
                            var scoreTime = response[l]['TIME'];
                        }
                    }

                    document.getElementById('upBackScratch').style.display = "block";
                    document.getElementById('upScoreBackScratch').innerHTML = `${scoreText}${' '} mm`;

                    document.getElementById('upTImeBackScratch').innerHTML = scoreTime;
                    BackScratcherr.style.display = "none";
                    divloader.style.display = "none";
                }


            });

            if (btnBackScratchHTML == divbuttoninnerHtml) {
                cmBackScratch.removeAttribute('readonly');
                mmBackScratch.removeAttribute('readonly');
                document.getElementById('btnBackScratch').innerHTML = "{{ __('taketest.label6') }}";
                cmBackScratch.value = "";
                mmBackScratch.value = "";
            }


        });

        var Sec8FootUp = document.getElementById('Sec8FootUp');
        var ms8FootUp = document.getElementById('ms8FootUp');
        var err8FootUp = document.getElementById('err8FootUp');
        var lblerror8FootUp = document.getElementById('lblerror8FootUp');


        document.getElementById('btn8FootUp').addEventListener('click', function backscratch(e) {
            e.preventDefault();
            var btn8FootUpHTML = document.getElementById('btn8FootUp').innerHTML;


            if (((ms8FootUp.value == "") && (Sec8FootUp.value == ""))) {
                err8FootUp.style.display = "block";
                lblerror8FootUp.innerHTML = "{{ __('taketest.label300') }}";
                divloader.style.display = "none";
                return false;

            }

            if ((Sec8FootUp.value == "") || (Sec8FootUp.value == 0)) {
                err8FootUp.style.display = "block";
                lblerror8FootUp.innerHTML = "{{ __('taketest.label301') }}";
                divloader.style.display = "none";
                return false;

            }


            if ((ms8FootUp.value == "") || (ms8FootUp.value == 0)) {
                err8FootUp.style.display = "block";
                lblerror8FootUp.innerHTML = "{{ __('taketest.label302') }}";
                divloader.style.display = "none";
                return false;

            }



            if (((ms8FootUp.value == "0") && (Sec8FootUp.value == "0"))) {
                err8FootUp.style.display = "block";
                lblerror8FootUp.innerHTML = "{{ __('taketest.label300') }}";
                divloader.style.display = "none";
                return false;

            } else if (Sec8FootUp.value.length > 2 || Number(Sec8FootUp.value) >= 60 || Number(Sec8FootUp.value) <
                0) {
                if (Sec8FootUp.value.length > 2) {
                    err8FootUp.style.display = "block";
                    lblerror8FootUp.innerHTML = "{{ __('taketest.label46') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(Sec8FootUp.value) >= 60) {
                    err8FootUp.style.display = "block";
                    lblerror8FootUp.innerHTML = "{{ __('taketest.label47') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(Sec8FootUp.value) < 0) {
                    err8FootUp.style.display = "block";
                    lblerror8FootUp.innerHTML = "{{ __('taketest.label48') }}";
                    divloader.style.display = "none";
                    return false;
                }

            } else if (ms8FootUp.value.length > 3 || Number(ms8FootUp.value) < 0 || Number(ms8FootUp.value) < 999) {
                if (ms8FootUp.value.length > 3) {
                    err8FootUp.style.display = "block";
                    lblerror8FootUp.innerHTML = "{{ __('taketest.label49') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(ms8FootUp.value) < 0) {
                    err8FootUp.style.display = "block";
                    lblerror8FootUp.innerHTML = "{{ __('taketest.label51') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(ms8FootUp.value) > 999) {
                    err8FootUp.style.display = "block";
                    lblerror8FootUp.innerHTML = "{{ __('taketest.label50') }}";
                    divloader.style.display = "none";
                    return false;
                }
            }

            if (Number(Sec8FootUp.value) > 0 && Number(ms8FootUp.value) > 0) {
                var score8up = Number(Sec8FootUp.value) * 1000 + Number(ms8FootUp.value);
                var score8upunit = "msec";
                Sec8FootUp.setAttribute('readonly', "readonly");
                ms8FootUp.setAttribute('readonly', "readonly");
                document.getElementById('btn8FootUp').innerHTML = "{{ __('taketest.label19') }}";
                err8FootUp.style.display = "none";
                divloader.style.display = "block";

                $.ajax({
                    type: "POST",
                    url: "{{ url('save50mtdash') }}",

                    data: {
                        UserId: F365Id,
                        AgeGroupId: ageGroupId,
                        Score50unit: score8upunit,
                        Score50: score8up,
                        Age: age,
                        Gender: gender,
                        ParentId: parentId,
                        TestTypeId: 1007,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(response) {
                        divloader.style.display = "none";
                        console.log(response);


                        for (let k = 0; k < response.length; k++) {
                            if (response[k]['TestTypeId'] == 1007) {
                                var dash50ScoreHTML = Number(response[k]['Score']) / 1000;
                                var dash50TimeHTML = response[k]['TIME'];
                            }
                        }

                        document.getElementById('up8FootUp').style.display = "block";
                        document.getElementById('upScore8FootUp').innerHTML =
                            `${dash50ScoreHTML}${' '} {{ __('taketest.label66') }}`;
                        document.getElementById('upTime8FootUp').innerHTML = `[${dash50TimeHTML}]`;
                        err8FootUp.style.display = "none";
                        divloader.style.display = "none";



                    }

                })



                if (btn8FootUpHTML == divbuttoninnerHtml) {
                    Sec8FootUp.removeAttribute('readonly');
                    ms8FootUp.removeAttribute('readonly');
                    document.getElementById('btn8FootUp').innerHTML = "{{ __('taketest.label6') }}";
                    Sec8FootUp.value = "";
                    ms8FootUp.value = "";
                }


            }




        });



        document.getElementById('btnNaukasana').addEventListener('click', function backscratch(e) {
            e.preventDefault();
            var btnNaukasanaHTML = document.getElementById('btnNaukasana').innerHTML;


            if (((msNaukasana.value == "") && (SecNaukasana.value == ""))) {
                errNaukasana.style.display = "block";
                lblerrorNaukasana.innerHTML = "{{ __('taketest.label303') }}";
                divloader.style.display = "none";
                return false;

            }
            if (((msNaukasana.value == "0") && (SecNaukasana.value == "0"))) {
                errNaukasana.style.display = "block";
                lblerrorNaukasana.innerHTML = "{{ __('taketest.label304') }}";
                divloader.style.display = "none";
                return false;

            }

            if ((SecNaukasana.value == "") || (SecNaukasana.value == 0)) {
                errNaukasana.style.display = "block";
                lblerrorNaukasana.innerHTML = "{{ __('taketest.label40') }}";
                divloader.style.display = "none";
                return false;

            }


            if ((msNaukasana.value == "") || (msNaukasana.value == 0)) {
                errNaukasana.style.display = "block";
                lblerrorNaukasana.innerHTML = "{{ __('taketest.label41') }}";
                divloader.style.display = "none";
                return false;

            }



             if (SecNaukasana.value.length > 2 || Number(SecNaukasana.value) >= 60 || Number(SecNaukasana.value) <
                0) {
                if (SecNaukasana.value.length > 2) {
                    errNaukasana.style.display = "block";
                    lblerrorNaukasana.innerHTML = "{{ __('taketest.label46') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(SecNaukasana.value) >= 60) {
                    errNaukasana.style.display = "block";
                    lblerrorNaukasana.innerHTML = "{{ __('taketest.label47') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(SecNaukasana.value) < 0) {
                    errNaukasana.style.display = "block";
                    lblerrorNaukasana.innerHTML = "{{ __('taketest.label48') }}";
                    divloader.style.display = "none";
                    return false;
                }

            } else if (msNaukasana.value.length > 3 || Number(msNaukasana.value) < 0 || Number(msNaukasana.value) < 999) {
                if (msNaukasana.value.length > 3) {
                    errNaukasana.style.display = "block";
                    lblerrorNaukasana.innerHTML = "{{ __('taketest.label49') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(msNaukasana.value) < 0) {
                    errNaukasana.style.display = "block";
                    lblerrorNaukasana.innerHTML = "{{ __('taketest.label51') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(msNaukasana.value) > 999) {
                    errNaukasana.style.display = "block";
                    lblerrorNaukasana.innerHTML = "{{ __('taketest.label50') }}";
                    divloader.style.display = "none";
                    return false;
                }
            }

            if (Number(SecNaukasana.value) > 0 && Number(msNaukasana.value) > 0) {
                var scoreNaukasana = Number(SecNaukasana.value) * 1000 + Number(msNaukasana.value);
                var scoreNaukasanaunit = "msec";
                SecNaukasana.setAttribute('readonly', "readonly");
                msNaukasana.setAttribute('readonly', "readonly");
                document.getElementById('btnNaukasana').innerHTML = "{{ __('taketest.label19') }}";
                errNaukasana.style.display = "none";
                divloader.style.display = "block";

                $.ajax({
                    type: "POST",
                    url: "{{ url('save50mtdash') }}",

                    data: {
                        UserId: F365Id,
                        AgeGroupId: ageGroupId,
                        Score50unit:scoreNaukasanaunit,
                        Score50: scoreNaukasana,
                        Age: age,
                        Gender: gender,
                        ParentId: parentId,
                        TestTypeId: 1002,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(response) {
                        console.log(response);


                        for (let k = 0; k < response.length; k++) {
                            if (response[k]['TestTypeId'] == 1002) {
                                var scoreNaukasanaHTML = Number(response[k]['Score']) / 1000;
                                var scoreNaukasanaunitTimeHTML = response[k]['TIME'];
                            }
                        }

                        document.getElementById('upNaukasana').style.display = "block";
                        document.getElementById('upScoreNaukasana').innerHTML =
                            `${scoreNaukasanaHTML}${' '} {{ __('taketest.label66') }}`;
                        document.getElementById('upTimeNaukasana').innerHTML = `[${scoreNaukasanaunitTimeHTML}]`;
                        errNaukasana.style.display = "none";
                        divloader.style.display = "none";




                    }

                })



                if (btnNaukasanaHTML == divbuttoninnerHtml) {
                    SecNaukasana.removeAttribute('readonly');
                    msNaukasana.removeAttribute('readonly');
                    document.getElementById('btnNaukasana').innerHTML = "{{ __('taketest.label6') }}";
                    SecNaukasana.value = "";
                    msNaukasana.value = "";
                }


            }




        });


        document.getElementById('btnVrikshasana').addEventListener('click', function backscratch(e) {
            e.preventDefault();
            var btnVrikshasanaHTML = document.getElementById('btnVrikshasana').innerHTML;


            if (((msVrikshasana.value == "") && (SecVrikshasana.value == ""))) {
                errVrikshasana.style.display = "block";
                lblerrorVrikshasana.innerHTML = "{{ __('taketest.label303') }}";
                divloader.style.display = "none";
                return false;

            }
            if (((msVrikshasana.value == "0") && (SecVrikshasana.value == "0"))) {
                errVrikshasana.style.display = "block";
                lblerrorVrikshasana.innerHTML = "{{ __('taketest.label304') }}";
                divloader.style.display = "none";
                return false;

            }

            if ((SecVrikshasana.value == "") || (SecVrikshasana.value == 0)) {
                errVrikshasana.style.display = "block";
                lblerrorVrikshasana.innerHTML = "{{ __('taketest.label40') }}";
                divloader.style.display = "none";
                return false;

            }


            if ((msVrikshasana.value == "") || (msVrikshasana.value == 0)) {
                errVrikshasana.style.display = "block";
                lblerrorVrikshasana.innerHTML = "{{ __('taketest.label41') }}";
                divloader.style.display = "none";
                return false;

            }



             if (SecVrikshasana.value.length > 2 || Number(SecVrikshasana.value) >= 60 || Number(SecVrikshasana.value) <
                0) {
                if (SecVrikshasana.value.length > 2) {
                    errVrikshasana.style.display = "block";
                    lblerrorVrikshasana.innerHTML = "{{ __('taketest.label46') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(SecVrikshasana.value) >= 60) {
                    errVrikshasana.style.display = "block";
                    lblerrorVrikshasana.innerHTML = "{{ __('taketest.label47') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(SecVrikshasana.value) < 0) {
                    errVrikshasana.style.display = "block";
                    lblerrorVrikshasana.innerHTML = "{{ __('taketest.label48') }}";
                    divloader.style.display = "none";
                    return false;
                }

            } else if (msVrikshasana.value.length > 3 || Number(msVrikshasana.value) < 0 || Number(msVrikshasana.value) < 999) {
                if (msVrikshasana.value.length > 3) {
                    errVrikshasana.style.display = "block";
                    lblerrorVrikshasana.innerHTML = "{{ __('taketest.label49') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(msVrikshasana.value) < 0) {
                    errVrikshasana.style.display = "block";
                    lblerrorVrikshasana.innerHTML = "{{ __('taketest.label51') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(msVrikshasana.value) > 999) {
                    errVrikshasana.style.display = "block";
                    lblerrorVrikshasana.innerHTML = "{{ __('taketest.label50') }}";
                    divloader.style.display = "none";
                    return false;
                }
            }

            if (Number(SecVrikshasana.value) > 0 && Number(msVrikshasana.value) > 0) {
                var scoreVrikshasana = Number(SecNaukasana.value) * 1000 + Number(msNaukasana.value);
                var scoreVrikshasanaunit = "msec";
                SecVrikshasana.setAttribute('readonly', "readonly");
                msVrikshasana.setAttribute('readonly', "readonly");
                document.getElementById('btnVrikshasana').innerHTML = "{{ __('taketest.label19') }}";
                errVrikshasana.style.display = "none";
                divloader.style.display = "block";

                $.ajax({
                    type: "POST",
                    url: "{{ url('save50mtdash') }}",

                    data: {
                        UserId: F365Id,
                        AgeGroupId: ageGroupId,
                        Score50unit:scoreVrikshasanaunit,
                        Score50: scoreVrikshasana ,
                        Age: age,
                        Gender: gender,
                        ParentId: parentId,
                        TestTypeId:1001,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(response) {
                        divloader.style.display = "none";
                        console.log(response);


                        for (let k = 0; k < response.length; k++) {
                            if (response[k]['TestTypeId'] == 1001) {
                                var scoreVrikshasanaHTML = Number(response[k]['Score']) / 1000;
                                var scoreVrikshasanaTimeHTML = response[k]['TIME'];
                            }
                        }

                        document.getElementById('upVrikshasana').style.display = "block";
                        document.getElementById('upScoreVrikshasana').innerHTML =
                            `${scoreVrikshasanaHTML}${' '} {{ __('taketest.label66') }}`;
                        document.getElementById('upTimeVrikshasana').innerHTML = `[${scoreVrikshasanaTimeHTML}]`;
                        errVrikshasana.style.display = "none";
                        divloader.style.display = "none";



                    }

                })



                if (btnVrikshasanaHTML == divbuttoninnerHtml) {
                    SecVrikshasana.removeAttribute('readonly');
                    msVrikshasana.removeAttribute('readonly');
                    document.getElementById('btnVrikshasana').innerHTML = "{{ __('taketest.label6') }}";
                    SecVrikshasana.value = "";
                    msVrikshasana.value = "";
                }


            }




        });




        var err2MinuteStep = document.getElementById('err2MinuteStep');
        var lblerr2MinuteStep = document.getElementById('lblerr2MinuteStep');


        document.getElementById('btn2MinuteStep').addEventListener('click', function partialsave(e) {
            e.preventDefault();
            var btn2MinuteStepHTML = document.getElementById('btn2MinuteStep').innerHTML;

            if (count2MinuteStep.value == "") {
                err2MinuteStep.style.display = "block";
                lblerr2MinuteStep.innerHTML = "{{ __('taketest.label53') }}";
                divloader.style.display = "none";
                return false;
            }
            if (count2MinuteStep.value.length > 2 || Number(count2MinuteStep.value) > 99 || Number(count2MinuteStep
                    .value) <
                0) {
                if (count2MinuteStep.value.Length > 2) {
                    err2MinuteStep.style.display = "block";
                    lblerr2MinuteStep.innerHTML = "{{ __('taketest.label54') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(count2MinuteStep.value) > 99) {
                    err2MinuteStep.style.display = "block";
                    lblerr2MinuteStep.innerHTML = "{{ __('taketest.label55') }}";
                    divloader.style.display = "none";
                    return false;
                } else if (Number(count2MinuteStep.value) < 0) {
                    err2MinuteStep.style.display = "block";
                    lblerr2MinuteStep.innerHTML = "{{ __('taketest.label56') }}";
                    divloader.style.display = "none";
                    return false;

                }
            }

            count2MinuteStep.setAttribute('readonly', "readonly");
            err2MinuteStep.style.display = "none";
            var count2MintestepScore = Number(count2MinuteStep.value);
            var count2MintestepScoreUnit = "Times";
            document.getElementById('btn2MinuteStep').innerHTML = "{{ __('taketest.label19') }}";
            divloader.style.display = "block";

            $.ajax({
                type: "POST",
                url: "{{ url('savepartialcurl') }}",

                data: {
                    UserId: F365Id,
                    AgeGroupId: ageGroupId,
                    ScorePartialunit: count2MintestepScoreUnit,
                    ScorePartial: count2MintestepScore,
                    TestTypeId: 1008,
                    Age: age,
                    Gender: gender,
                    ParentId: parentId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {
                    for (let m = 0; m < response.length; m++) {
                        if (response[m]['TestTypeId'] == '1008') {
                            var minute2stepscoreresponsevalue = response[m]['Score'];
                            var minute2stepTimeresponsevalue = response[m]['TIME'];

                        }
                    }


                    document.getElementById('up2MinuteStep').style.display = "block";
                    document.getElementById('upScore2MinuteStep').innerHTML =
                        `${minute2stepscoreresponsevalue}${' '}Times`;
                    document.getElementById('upTime2MinuteStep').innerHTML =
                        `[${minute2stepTimeresponsevalue}]`;
                    err2MinuteStep.style.display = "none";
                    divloader.style.display = "none";

                }



            });
            if (btn2MinuteStepHTML == divbuttoninnerHtml) {
                count2MinuteStep.removeAttribute('readonly');

                document.getElementById('btn2MinuteStep').innerHTML = "{{ __('taketest.label6') }}";
                count2MinuteStep.value = "";

            }



        });

        function ViewDashboard() {

            divloader.style.display = "block";
            $.ajax({
                type: "POST",
                url: "{{ url('usersdatadashboard') }}",

                data: {
                    UserId: F365Id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {
                    divloader.style.display = "none";

                    if (response[0].length == 0) {

                        myModal1.removeAttribute("modal fade");
                        myModal1.setAttribute("class", "modal fade in");
                        myModal1.style.display = "block";
                        myModal1.style.background = "rgba(0,0,0,0.5)";
                        P1.innerHTML = "{{ __('taketest.label59') }}";
                    }

                    if (response[0].length > 0) {

                        if (response[1].length > 0) {
                            console.log('goo');

                            var username = '{{ $_GET['Name'] }}';
                            var age = {{ $_GET['Age'] }};
                           var gender = {{  $_GET['GenderId'] }};
                           var F365Id = {{ $_GET['F365Id'] }};
                           var parentId = {{ Session::get('ParentId') }};
                            var ageGroupId = {{ $_GET['AgeGroupId'] }};
                            var ageGroupName='{{ $_GET['AgeGroupName'] }}';

                            window.location.href = `memberdashboard/${username}/${F365Id}/${age}/${ageGroupId}/${ageGroupName}/${gender}`;

                        } else {

                            myModal1.removeAttribute("modal fade");
                            myModal1.setAttribute("class", "modal fade in");
                            myModal1.style.display = "block";
                            myModal1.style.background = "rgba(0,0,0,0.5)";
                            P1.innerHTML = "{{ __('taketest.label58') }}";

                        }


                    } else {
                        myModal1.removeAttribute("modal fade");
                        myModal1.setAttribute("class", "modal fade in");
                        myModal1.style.display = "block";
                        myModal1.style.background = "rgba(0,0,0,0.5)";
                        P1.innerHTML = "{{ __('taketest.label59') }}";

                    }

                }


            });


        }


        function BtnCloseModal() {

            myModal1.removeAttribute("modal fade in");
            myModal1.setAttribute("class", "modal fade");
            myModal1.style.display = "none";
            myModal1.style.background = "";
            P1.innerHTML = "";

        }











        function goBack() {
            window.history.back();
        }

        // $(document).ready(function() {
        //     $('#navbar1').css('display', 'none');
        //     $('#landingdescription').css('display', 'none');
        // });

        // function TestClick(id) {
        //     $.ajax({
        //         type: "POST",
        //         url: "TestListaspx/GetInstructiontPopup",
        //         data: {
        //             AgeGroupId: ageGroupId,
        //             TestTypeId: id,
        //             _token: $('meta[name="csrf-token"]').attr('content'),
        //         },

        //         success: function(response) {
        //             console.log(response);

        //             if (response.data != null && response.data.length > 0) {
        //                 console.log('data subm',response.data[0].VideoSource)
        //                 console.log(label_data[response.data[0].{{ __('testhome.label74') }}Content]);
        //                 let text1 = label_data[response.data[0].VideoSource]

        //                 document.getElementById('lblVideoSource').innerHTML = label_data[response.data[0].VideoSource];
        //                  document.getElementById('lbl{{ __('testhome.label74') }}Content').innerHTML = label_data[response.data[0].{{ __('testhome.label74') }}Content];
        //                  document.getElementById('lblEquipmentContent').innerHTML = label_data[response.data[0].EquipmentContent];
        //                  document.getElementById('lblMeasureContent').innerHTML = label_data[response.data[0].MeasureContent];
        //                  document.getElementById('lblPerformContent').innerHTML = label_data[response.data[0].PerformContent];
        //                 //  document.getElementById('lblHeading').innerHTML = label_data[response.data[0].Heading];
        //                  document.getElementById('testHeading').innerHTML = label_data[response.data[0].Heading];
        //                 //  document.getElementById('myModal').style.display = "block";
        //             }
        //             else {
        //             }
        //         },

        //         error: function(data) {
        //             console.log(data.error);
        //         }
        //     });
        // }



        function goBack() {
            window.history.back();
        }
    </script>


@endsection
