
{{-- <h1>Member View Report</h1> --}}
{{-- {{ dd($userF365Id) }} --}}
{{-- {{ dd($UserDisplayDate) }} --}}

{{-- {{ dd($userF365Id) }} --}}
{{-- {{ dd($UserDisplayDate) }} --}}
{{-- {{ dd($userprofile) }} --}}
{{-- {{ dd($alldate) }} --}}
{{-- {{ dd($resultSet5) }} --}}
{{-- {{ dd($OverallFitnessScore) }} --}}
{{-- {{ dd($resultSet7) }} --}}
{{-- {{ dd($resultSet8) }} --}}
@extends('static.layouts.appnet')
@section('title', 'Fit India Test List | Fit India')
@section('content')
<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-127986665-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'UA-127986665-1');
    </script>
    {{-- <script src="Scripts/html2canvas.min.js"></script> --}}
    <script src="{{ asset('resources/js/dotnet_js/html2canvas.min.js')}}"></script>
    {{-- <link href="Css/report-style.css" rel="stylesheet" /> --}}
    <link href="{{ asset('resources/css/dotnet_css/report-style.css')}}" rel="stylesheet" />
    {{-- <link href="{{ asset('resources/slick/swiper-bundle.css')}}"  rel="stylesheet" />  --}}
    <div class="inner-page-header">
        <div class="container back-btn-set">
            <button class="header-back-btn" runat="server" onclick="GoBack()">
                <img src="{{ url('resources/dotnetimages/back_btn_i.png')}}" /></button>
            {{-- <h4 id="lblHeading" runat="server"><%= Resources.ResourceMaster.label15 %></h4> --}}
            <h4 id="lblHeading" runat="server">{{ __('testfitnessreport.label2') }}</h4>
        </div>
    </div>
    @php
        // $DOB = ds.Tables[0].Rows[0]["DOB"].ToString();
        $DOB = $userprofile[0]["DOB"];

        $OverallGraphClr = "";
        $OverallFeedback = "";

        $BMIGraphClr = "";
        $BMIGraphWidth = "";
        $WeightInKgCurrent = 0;
        $HeightInMtrCurrent = 0;
        $BMI = 0;
        $CampStartDateCurrent = "";

        $PreviousBMIGraphClr = "";
        $PreviousBMIGraphWidth = "";
        $WeightInKgPrevious = 0;
        $HeightInMtrPrevious = 0;
        $BMIPrevious = 0;
        $CampStartDatePrevious = "";
    @endphp

    {{-- //-------------------------------------------------------------------------------------- Current Test Data --}}
    {{-- @if (ds.Tables[1].Rows.Count > 0) --}}
    {{-- {{ dd(1232323) }} --}}
    @if (count($alldate) > 0)
        @php
            $CampStartDateCurrent = $alldate[0]["DisplayDate"];
            // dd($CampStartDateCurrent);
        @endphp
    @endif

    {{-- //-------------------------------------------------------------------------------------- Previous Test Data --}}
    {{-- if (ds1.Tables.Count > 0) --}}
    {{-- {{ dd($alldate[1]) }} --}}
    @if(count($userprofilePrevious) > 0)

        @if(count($alldatePrevious[1]) > 1)

            @php
                // $CampStartDatePrevious = $alldate[1]["DisplayDate"].ToString();
                $CampStartDatePrevious = $alldatePrevious[1]["DisplayDate"];
                // dd($CampStartDatePrevious);
            @endphp

        @endif
    @endif

    {{-- //-------------------------------------------------------------------------------------- Current Height/Weight/BMI --}}
    {{-- if (ds.Tables[4].Rows.Count != 0) --}}
    @if(count($resultSet7) != 0)

        @if($resultSet7[1]["Score"] != null)
            @php
                // HeightInMtrCurrent = Math.Round(Convert.ToDouble(ds.Tables[4].Rows[1]["Score"]) / 10, 1);
                $HeightInMtrCurrent = ((round($resultSet7[1]["Score"])) / 10);
                // dd($HeightInMtrCurrent);
            @endphp
        @endif
        @if ($resultSet7[0]["Score"] != null)
            @php
                // WeightInKgCurrent = Math.Round(Convert.ToDouble(ds.Tables[4].Rows[0]["Score"]) / 1000, 2);
                $WeightInKgCurrent = (round($resultSet7[0]["Score"]) / 1000);
                // dd($WeightInKgCurrent);
            @endphp
        @endif
        {{-- {{ dd($WeightInKgCurrent) }} --}}
    @endif

    {{-- if (WeightInKgCurrent != 0 && HeightInMtrCurrent != 0) --}}
    @if($WeightInKgCurrent != 0 && $HeightInMtrCurrent != 0)
        @php
            // $BMI = Math.Round(WeightInKgCurrent / (Math.Round(Convert.ToDouble(ds.Tables[4].Rows[1]["Score"]) / 1000, 1) * Math.Round(Convert.ToDouble(ds.Tables[4].Rows[1]["Score"]) / 1000, 1)), 2);
            // $BMI = (round($WeightInKgCurrent) / (round(($resultSet7[1]["Score"]) / 1000),1) * round(($resultSet7[1]["Score"]) / 1000),1);
            $resultSet7 = round($resultSet7[1]["Score"] / 1000,1);
            // dd($resultSet7);
            $BMI = round(($WeightInKgCurrent) / ($resultSet7 * $resultSet7),2);
            // dd($BMI);
        @endphp
    @endif


    {{-- //-------------------------------------------------------------------------------------- Previous Height/Weight/BMI --}}
    {{-- if (ds1.Tables.Count > 0) --}}
    @if (count($userprofilePrevious) > 0)
    
    {{-- if (ds1.Tables[4].Rows.Count != 0) --}}
    
        @if(count($resultSet7Previous) != 0)

            @if ($resultSet7Previous[1]["Score"] != null)
            
                @php
                    // HeightInMtrPrevious = Math.Round(Convert.ToDouble(ds1.Tables[4].Rows[1]["Score"]) / 10, 1);
                    $HeightInMtrPrevious = (round($resultSet7Previous[1]["Score"]) / 10);
                    // dd($HeightInMtrPrevious);
                    // echo $HeightInMtrPrevious;
                    // echo '<hr/>';
                @endphp
            @endif
            {{-- if (ds1.Tables[4].Rows[0]["Score"] != null) --}}
            @if ($resultSet7Previous[0]["Score"] != null)
            @php
                    // WeightInKgPrevious = Math.Round(Convert.ToDouble(ds1.Tables[4].Rows[0]["Score"]) / 1000, 2);
                    $WeightInKgPrevious = (round($resultSet7Previous[0]["Score"]) / 1000);
                    // echo $WeightInKgPrevious;
                    // echo '<hr/>';
                @endphp
            @endif
        @endif
    @endif

    @if($WeightInKgPrevious != 0 && $HeightInMtrPrevious != 0)
        @php
            // BMIPrevious = Math.Round(WeightInKgPrevious / (Math.Round(Convert.ToDouble(ds1.Tables[4].Rows[1]["Score"]) / 1000, 1) * Math.Round(Convert.ToDouble(ds1.Tables[4].Rows[1]["Score"]) / 1000, 1)), 2);
            // echo round($WeightInKgPrevious);
            $WeightInKgPreviousr = round($WeightInKgPrevious);
            // echo "WeightInKgPreviousr";
            // echo $WeightInKgPreviousr;
            // echo '<hr/>';
            // echo "resultSet7Previous:-";
            // echo round($resultSet7Previous[1]["Score"] / 1000,1);
            // echo round($resultSet7Previous[1]["Score"] / 1000,1);
            // echo '<hr/>';
            // echo round($resultSet7Previous[1]["Score"] / 1000,1);
            $resultSet7Previous = round($resultSet7Previous[1]["Score"] / 1000,1);
            // echo '<hr/>';
            $resultSet7PreviousM = ($resultSet7Previous * $resultSet7Previous);
            // echo "resultSet7PreviousM";
            // echo $resultSet7PreviousM;
            // exit;
            // $BMIPrevious = (round($WeightInKgPrevious / (round($resultSet7Previous[1]["Score"]) / 1000) * round($resultSet7Previous[1]["Score"]) / 1000));
            $BMIPrevious = round(($WeightInKgPreviousr/$resultSet7PreviousM),2);
            // dd($BMIPrevious);
            // exit;
        @endphp
    @endif


{{-- //---------------------------------------------------------------------- Overall Percentage Color & Feedback --}}
{{-- if (ds.Tables[3].Rows.Count > 0) --}}
@if(count($OverallFitnessScore) > 0)

    @if ($OverallFitnessScore[0]["OverallPercentage"] < 20)
        @php
            $OverallGraphClr = "#ff043f";
            // $OverallFeedback = Resources.ResourceUserDashboard.label30;
            $OverallFeedback = __('userdashboard.label30');
        @endphp
    {{-- else if (Convert.ToDouble(ds.Tables[3].Rows[0]["OverallPercentage"]) >= 20 && Convert.ToDouble(ds.Tables[3].Rows[0]["OverallPercentage"]) < 40) --}}
    @elseif($OverallFitnessScore[0]["OverallPercentage"] >= 20 && $OverallFitnessScore[0]["OverallPercentage"] < 40)
        @php
            $OverallGraphClr = "#fc6ba9";
            // $OverallFeedback = Resources.ResourceUserDashboard.label31;
            $OverallFeedback = __('userdashboard.label31');
        @endphp
    {{-- else if (Convert.ToDouble(ds.Tables[3].Rows[0]["OverallPercentage"]) >= 40 && Convert.ToDouble(ds.Tables[3].Rows[0]["OverallPercentage"]) < 60) --}}
    @elseif($OverallFitnessScore[0]["OverallPercentage"] >= 40 && $OverallFitnessScore[0]["OverallPercentage"] < 60)
        @php
            $OverallGraphClr = "#ffaa62";
            // $OverallFeedback = Resources.ResourceUserDashboard.label32;
            $OverallFeedback = __('userdashboard.label32');
        @endphp
    {{-- else if (Convert.ToDouble(ds.Tables[3].Rows[0]["OverallPercentage"]) >= 60 && Convert.ToDouble(ds.Tables[3].Rows[0]["OverallPercentage"]) < 70) --}}
    @elseif ($OverallFitnessScore[0]["OverallPercentage"] >= 60 && $OverallFitnessScore[0]["OverallPercentage"] < 70)
        @php
            $OverallGraphClr = "#f7d54e";
            // $OverallFeedback = Resources.ResourceUserDashboard.label33;
            $OverallFeedback = __('userdashboard.label33');
        @endphp
    {{-- else if (Convert.ToDouble(ds.Tables[3].Rows[0]["OverallPercentage"]) >= 70 && Convert.ToDouble(ds.Tables[3].Rows[0]["OverallPercentage"]) < 80) --}}
    @elseif($OverallFitnessScore[0]["OverallPercentage"] >= 70 && $OverallFitnessScore[0]["OverallPercentage"] < 80)
        @php
            $OverallGraphClr = "#8bd470";
            // $OverallFeedback = Resources.ResourceUserDashboard.label34;
            $OverallFeedback = __('userdashboard.label34')
        @endphp
    {{-- else if (Convert.ToDouble(ds.Tables[3].Rows[0]["OverallPercentage"]) >= 80 && Convert.ToDouble(ds.Tables[3].Rows[0]["OverallPercentage"]) < 90) --}}
    @elseif ($OverallFitnessScore[0]["OverallPercentage"] >= 80 && $OverallFitnessScore[0]["OverallPercentage"] < 90)
        @php
            $OverallGraphClr = "#00b289";
            // $OverallFeedback = Resources.ResourceUserDashboard.label35;
            $OverallFeedback = __('userdashboard.label35')
        @endphp
    @endif
    {{-- if (Convert.ToDouble(ds.Tables[3].Rows[0]["OverallPercentage"]) >= 90) --}}
    @if($OverallFitnessScore[0]["OverallPercentage"] >= 90)
        @php
            $OverallGraphClr = "#009bdf";
            // $OverallFeedback = Resources.ResourceUserDashboard.label36;
            $OverallFeedback = __('userdashboard.label36');
        @endphp
    @endif
@endif



    {{-- //---------------------------------------------------------------------- BMI Graph Color --}}
    {{-- if(ds.Tables[5].Rows.Count > 0) --}}
    @if(count($resultSet8) > 0)

            {{-- if (ds.Tables[5].Rows[0]["STATUS"].ToString() == "UW") --}}
            @if ($resultSet8[0]["STATUS"] == "UW")
                @php
                    $BMIGraphClr = "#f7d54e";
                    $BMIGraphWidth = "7";
                @endphp
            @endif
            {{-- if(ds.Tables[5].Rows[0]["STATUS"].ToString() == "N") --}}
            @if($resultSet8[0]["STATUS"] == "N")
                @php
                    $BMIGraphClr = "#8bd470";
                    $BMIGraphWidth = "21";
                @endphp
            @endif
            {{-- @if (ds.Tables[5].Rows[0]["STATUS"].ToString() == "OW") --}}
            @if($resultSet8[0]["STATUS"] == "OW")
                @php
                    $BMIGraphClr = "#ffaa62";
                    $BMIGraphWidth = "43";
                @endphp
            @endif
            {{-- @if(ds.Tables[5].Rows[0]["STATUS"].ToString() == "OB") --}}
            @if($resultSet8[0]["STATUS"] == "OB")
                @php
                    $BMIGraphClr = "#ff043f";
                    $BMIGraphWidth = "60";
                @endphp
            @endif
    @endif
        {{-- if (ds1.Tables.Count > 0) --}}
        @if(count($userprofilePrevious) > 0)

            @if (count($resultSet8Previous) > 0)

                @if($resultSet8Previous[0]["STATUS"] == "UW")
                    @php
                        $PreviousBMIGraphClr = "#f7d54e";
                        $PreviousBMIGraphWidth = "7";
                    @endphp
                @endif
                @if($resultSet8Previous[0]["STATUS"] == "N")
                    @php
                        $PreviousBMIGraphClr = "#8bd470";
                        $PreviousBMIGraphWidth = "21";
                    @endphp
                @endif
                @if ($resultSet8Previous[0]["STATUS"] == "OW")
                    @php
                        $PreviousBMIGraphClr = "#ffaa62";
                        $PreviousBMIGraphWidth = "43";
                    @endphp
                @endif
                @if($resultSet8Previous[0]["STATUS"] == "OB")
                    @php
                        $PreviousBMIGraphClr = "#ff043f";
                        $PreviousBMIGraphWidth = "60";
                    @endphp
                @endif
            @endif
        @endif

    {{-- string html = ""; --}}

                {{-- string html = ""; --}}
    <div class="container header-bg-2">
        <div class="row">
           <div class="col-md-12">
                {{-- //******************************************************* Report Header ********************************************************* --}}
                {{-- #region ReportHeader --}}
                <div class='reportHeader card-bg-white' style="width:100%;">
                    <div class='container-fluid'>
                        <div class='row' style="margin: 0px;"> 
                            <div class='col-sm-12 col-md-6'>
                                <div class='report-user_info'>
                                    {{-- //-------------------------------------------------------------------------- USer Info --}}
                                        <div class='user-first-row'>
                                            <div class='list-group-item name'>
                                                {{-- <label>GetGlobalResourceObject("ResourceHome", "label12").ToString()</label> --}}
                                                <label>{{ __('testfitnessreport.label12') }}</label>
                                                {{-- <span>ds.Tables[0].Rows[0]["Name"].ToString()</span> --}}
                                                <span>{{ $userprofile[0]['Name'] ?? '' }}</span>
                                            </div>
                                        </div>
                                    <div class='clearfix'></div>

                                    <div class='user-sec-row'>
                                        <div class='list-group-item col-3'>
                                            {{-- <label class='report-label' style='text-align: left'>" + GetGlobalResourceObject("Resourcetestfitnessreport", "label10").ToString() + "</label> --}}
                                            <label class='report-label' style='text-align: left'> {{ __('testfitnessreport.label10') }} </label>
                                            {{-- <span>" + ds.Tables[0].Rows[0]["F365Id"].ToString() + "</span> --}}
                                            <span>
                                                {{ $userprofile[0]['F365Id'] ?? '' }}
                                            </span>
                                        </div>
                                        <div class='list-group-item col-3'>
                                            @php
                                                $UserGender = $userprofile[0]['Gender'];
                                                // dd($UserGender);
                                                $userdashboardGender = __("userdashboard.$UserGender");
                                            @endphp
                                        <label class='report-label' style='text-align: left'>
                                            {{-- " + GetGlobalResourceObject("ResourceHome", "label17").ToString() + " / " + GetGlobalResourceObject("ResourceHome", "label14").ToString() + " --}}
                                            {{ __('testfitnessreport.label14') }} 
                                        </label>
                                        <span>
                                            {{-- {{ dd($userprofile[0]['Gender']) }} --}}
                                            {{-- " + GetGlobalResourceObject("ResourceUserDashboard", "" + ds.Tables[0].Rows[0]["Gender"].ToString() + "").ToString() + " / " + DOB + " </span> --}}
                                            
                                            {{ $userdashboardGender ?? '' }} / {{ $DOB ?? ''}}
                                        </span>
                                        </div>
                                    </div>
                                    <div class='clearfix'></div>
                                </div>
                            </div>
                        {{-- //-------------------------------------------------------------------------- END USer Info  --}}
                        {{-- //-------------------------------------------------------------------------- BMI Chart --}}
                            <div class='col-sm-12 col-md-6'>
                                <div class='report-user_info'>
                                    <div class='report-summery'>
                                        <div class='summery-graph'>
                                            <div class='graph-area'>
                                                <span>
                                                    {{ $OverallFeedback }}
                                                </span> {{-- //-------------------------------------------------------------- Feedback --}}

                                                <div class='graph-bar'>

                                                    @if(count($OverallFitnessScore) > 0)
                                                        <span style='width:{{ $OverallFitnessScore[0]["OverallPercentage"]}}%;background:{{$OverallGraphClr}}'>&nbsp;</span>
                                                        {{-- <span style='width:"{{ $OverallFitnessScore[0]["OverallPercentage"]}}"%; background:{{ $OverallGraphClr}}"'>&nbsp;</span> --}}

                                                    @endif

                                                </div>

                                                <ul class='graph-label'>
                                                    <li class='twnty'><span>0</span></li>
                                                    <li class='twnty'><span>L1</span></li>
                                                    <li class='twnty'><span>L2</span></li>
                                                    <li class='ten'><span>L3</span></li>
                                                    <li class='ten'><span>L4</span></li>
                                                    <li class='ten'><span>L5</span></li>
                                                    <li class='ten'><span>L6</span></li>
                                                    <li><span>L7</span></li>
                                                </ul>


                                            </div>
                                        </div>

                                        {{-- <span id='hscore' >" + GetGlobalResourceObject("Resourcetestfitnessreport", "label3").ToString() + "</span> --}}
                                        <span id='hscore'>{{ __('userdashboard.label3') }}</span>
                                    </div>
                                </div>
                            </div>
                        {{-- //-------------------------------------------END ------------------------------------------------ --}}

                        </div>
                    </div>
                </div>
                {{-- #endregion --}}
                {{-- //******************************************************* Report Header End ***************************************************** --}}
                <div class="reportCard" id="report1">
                    {{-- //******************************************************* Report Body ********************************************************* --}}
                    {{-- #region ReportBody --}}
                        <div class='reportFooter card-bg-white'>
                            <div class='container-fluid'>
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <div class='mybmi-test'>
                                            {{-- <label class='report-label4'>" + GetGlobalResourceObject("Resourcetestfitnessreport", "label4").ToString() + "</label> --}}
                                            <label class='report-label4'>{{ __('testfitnessreport.label4') }}</label>
                                            <div class='all-test-data'>
                                                <div class='all-test-col-1'>
                                                    <header id='header2' >
                                                        <div class='label'></div>
                                                        <div class='label count'>
                                                            <span class='twnty'>UW</span>
                                                            <span class='twnty'>N</span>
                                                            <span class='twnty'>OW</span>
                                                            <span class='ten'>OB</span>
                                                        </div>
                                                    </header>
                                                    <section>
                                                        {{-- //-------------------------------------------------- Current BMI Graph --}}
                                                        <div class='rw'>
                                                            {{-- <div class='label'>" + GetGlobalResourceObject("Resourcetestfitnessreport", "label5").ToString() + "</div> --}}
                                                            <div class='label'>{{ __('testfitnessreport.label5') }}</div>
                                                                {{-- if (ds.Tables[5].Rows.Count > 0) --}}
                                                                @if(count($resultSet8) > 0)
                                                                    <div class='label'>
                                                                        <div class='graph-bar'>
                                                                            {{-- <span style='background: " + BMIGraphClr + "; width: " + BMIGraphWidth + "%;'>&nbsp;</span> --}}
                                                                            <span style='background:{{$BMIGraphClr??''}}; width:{{ $BMIGraphWidth??''}}%;'>&nbsp;</span>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                        </div>

                                                        {{-- //--------------------------------------------------- Previous BMI Graph --}}
                                                        <div class='rw'>
                                                            {{-- <div class='label'>" + GetGlobalResourceObject("Resourcetestfitnessreport", "label6").ToString() + "</div> --}}
                                                            <div class='label'>{{ __('testfitnessreport.label6') }}</div>

                                                            {{-- if (ds1.Tables.Count > 0) --}}
                                                            @if(count($userprofilePrevious) > 0)
                                                                {{-- if (ds1.Tables[5].Rows.Count > 0) --}}
                                                                @if(count($resultSet8Previous) > 0)

                                                                    <div class='label'>
                                                                        <div class='graph-bar'>
                                                                            {{-- <span style='background: " + PreviousBMIGraphClr + "; width: " + PreviousBMIGraphWidth + "%;'>&nbsp;</span> --}}
                                                                            <span style='background:{{$PreviousBMIGraphClr??''}}; width:{{ $PreviousBMIGraphWidth }}%;'>&nbsp;</span>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @else
                                                                <div class='label'>
                                                                    <div class='graph-bar'>
                                                                        <span></span>
                                                                    </div>
                                                                </div>

                                                            @endif
                                                        </div>
                                                    </section>
                                                </div>
                                            <div class='all-test-col-2'>
                                            <header id='header3' >
                                                <div class='label'></div>
                                                {{-- <div class='label'>" + GetGlobalResourceObject("Resourcetestfitnessreport", "label7").ToString() + "</div>
                                                <div class='label'>" + GetGlobalResourceObject("Resourcetestfitnessreport", "label8").ToString() + "</div>
                                                <div class='label'>" + GetGlobalResourceObject("Resourcetestfitnessreport", "label4").ToString() + "</div> --}}
                                                <div class='label'>{{ __('testfitnessreport.label7') }}</div>
                                                <div class='label'>{{ __('testfitnessreport.label8') }}</div>
                                                <div class='label'>{{ __('testfitnessreport.label4') }}</div>
                                            </header>
                                                <section>
                                                    {{-- //---------------------------------------------------------- Current BMI Score --}}
                                                    <div class= 'rw'>
                                                        {{-- <div class='label'>" + GetGlobalResourceObject("Resourcetestfitnessreport", "label5").ToString() + "</div> --}}
                                                        <div class='label'>
                                                            {{ __('testfitnessreport.label5') }}
                                                        </div>

                                                        {{-- if (WeightInKgCurrent != 0) --}}
                                                        @if($WeightInKgCurrent != 0)
                                                            <div class='label'>
                                                                {{-- $WeightInKgCurrent + " " + GetGlobalResourceObject("ResourceTakeTest", "label128").ToString() + "</div>                                                             --}}
                                                                {{  $WeightInKgCurrent ?? ''}}  {{ __('taketest.label128') }}
                                                            </div>
                                                        @else
                                                            <div class='label'>NA</div>
                                                        @endif
                                                            {{-- if (HeightInMtrCurrent != 0) --}}
                                                            @if($HeightInMtrCurrent != 0)
                                                                {{-- <div class='label'>" + HeightInMtrCurrent + " " + GetGlobalResourceObject("ResourceTakeTest", "label8").ToString() + "</div> --}}
                                                                <div class='label'>
                                                                    {{ $HeightInMtrCurrent ?? ''}} {{ __('taketest.label8') }}
                                                                </div>
                                                            @else

                                                                <div class='label'>NA</div>
                                                            @endif
                                                            {{-- @if(BMI != 0) --}}
                                                            @if($BMI != 0)
                                                                {{-- <div class='label'>" + BMI + "</div> --}}
                                                                <div class='label'>{{  $BMI }}</div>
                                                            @else
                                                                <div class='label'>NA</div>
                                                            @endif
                                                    </div>
                                                    {{-- //---------------------------------------------------------- Previous BMI Score --}}
                                                    <div class= 'rw'>
                                                        {{-- <div class='label'>" + GetGlobalResourceObject("Resourcetestfitnessreport", "label6").ToString() + "</div> --}}
                                                        <div class='label'>{{ __('testfitnessreport.label6') }}</div>
                                                            {{-- @if (WeightInKgPrevious != 0) --}}
                                                            @if ($WeightInKgPrevious != 0)
                                                                {{-- <div class='label'>" + WeightInKgPrevious + " " + GetGlobalResourceObject("ResourceTakeTest", "label128").ToString() + "</div> --}}
                                                                <div class='label'>{{  $WeightInKgPrevious ?? '' }} {{ __('taketest.label128') }}</div>
                                                            @else
                                                                <div class='label'>NA</div>
                                                            @endif
                                                            {{-- @if (HeightInMtrPrevious != 0) --}}
                                                            @if ($HeightInMtrPrevious != 0)
                                                                {{-- <div class='label'>" + HeightInMtrPrevious + " " + GetGlobalResourceObject("ResourceTakeTest", "label8").ToString() + "</div>                                                             --}}
                                                                <div class='label'>{{  $HeightInMtrPrevious ?? '' }} {{ __('taketest.label8') }}</div>
                                                            @else
                                                                <div class='label'>NA</div>
                                                            @endif
                                                            {{-- @if (BMIPrevious != 0) --}}
                                                            @if ($BMIPrevious != 0)
                                                                <div class='label'>{{  $BMIPrevious ?? ''}}</div>
                                                            @else
                                                                <div class='label'>NA</div>
                                                            @endif
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div>
                            {{-- <p><strong> UW: </strong> " + GetGlobalResourceObject("ResourceUserDashboard", "label19").ToString() + " <br> <strong> N: </strong> " + GetGlobalResourceObject("ResourceUserDashboard", "label20").ToString() + " <br> <strong> OW: </strong> " + GetGlobalResourceObject("ResourceUserDashboard", "label21").ToString() + " <br> <strong> OB: </strong> " + GetGlobalResourceObject("ResourceUserDashboard", "label22").ToString() + " </p> --}}
                            <p>
                                <strong> UW: </strong> {{ __('userdashboard.label19') }} <br/>
                                <strong> N: </strong> {{ __('userdashboard.label20') }} <br/>
                                <strong> OW: </strong> {{ __('userdashboard.label21') }} <br/>
                                <strong> OB: </strong> {{ __('userdashboard.label22') }}
                            </p>
                        </div>
                    </div>
                </div>
                    {{-- #endregion --}}
                    {{-- //******************************************************* Report Body End ********************************************************* --}}
                </div>
                {{-- #endregion --}}
                {{-- //******************************************************* Report Header ********************************************************* --}}
                    <div class='report-container' id="dvReport">
                        {{-- //******************************************************* Report Footer *********************************************************** --}}
                        {{-- #region ReportFooter --}}
                                <div class='reportbody card-bg-white'>
                                    <div class='container-fluid'>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <div class='full-test-list'>
                                                {{-- <label class='report-label'>" + GetGlobalResourceObject("Resourcetestfitnessreport", "label3").ToString() + "</label> --}}
                                                <label class='report-label'>
                                                    {{ __('testfitnessreport.label3') }}
                                                </label>
                                                {{-- //----------------------------------------------------------------------------- Bind Test --}}
                                            {{-- if (ds.Tables[2].Rows.Count > 0) --}}
                                            @if(count($resultSet5) > 0)
                                                    {{-- for (int i = 0; i < ds.Tables[2].Rows.Count; i++) --}}
                                                    @for ($i = 0; $i < count($resultSet5); $i++)
                                                    {{-- //------------------------------------------------------------------------------------ Color of the Graph --}}


                                                        {{-- {{ dd($resultSet5[$i]["TestType"]) }} --}}
                                                        {{-- if (ds.Tables[2].Rows[i]["Category"].ToString() == "label51" && ds.Tables[2].Rows[i]["TestType"].ToString() == "label56") --}}
                                                        @php
                                                            $TestCategory = "";
                                                            $IndividualFitnessClr = "";
                                                            $FCurrentScore = "";
                                                            $FCurrentScoreTimeConversion = "";
                                                            $FScoreUnit = "";
                                                            $Feedback = "";

                                                            $PreviousIndividualFitnessClr = "";
                                                            $FPreviousScore = "";
                                                            $FPreviousScoreTimeConversion = "";
                                                            $FPreviousScoreUnit = "";
                                                            $Category = $resultSet5[$i]["Category"];
                                                            $TestType = $resultSet5[$i]["TestType"];
                                                            $Percentile = $resultSet5[$i]["Percentile"];
                                                            $CategoryOrginal = $resultSet5[$i]["CategoryOrginal"];
                                                            $Score = $resultSet5[$i]["Score"];
                                                            $Score_Unit = $resultSet5[$i]["Score_Unit"];
                                                        @endphp
                                                        @if ($Category == "label51" && $TestType == "label56")
                                                            @php
                                                                $TestCategory = "label65";
                                                            @endphp
                                                        {{-- @elseif(ds.Tables[2].Rows[i]["Category"].ToString() == "label51" && ds.Tables[2].Rows[i]["TestType"].ToString() == "label57") --}}
                                                        @elseif($Category == "label51" && $TestType == "label57")
                                                            @php
                                                                $TestCategory = "label52";
                                                            @endphp
                                                        @else
                                                            @php
                                                                // $TestCategory = ds.Tables[2].Rows[i]["Category"].ToString();
                                                                $TestCategory = $Category;
                                                            @endphp
                                                        @endif

                                                        {{-- if(Convert.ToInt32(ds.Tables[2].Rows[i]["Percentile"]) > 0) --}}
                                                        @if($Percentile > 0)

                                                            {{-- if (Convert.ToDouble(ds.Tables[2].Rows[i]["Percentile"]) < 20) //--L1 --}}
                                                            @if($Percentile < 20) {{-- //--L1 --}}
                                                                @php
                                                                    $IndividualFitnessClr = "#ff043f";
                                                                @endphp
                                                            @endif
                                                            @if ($Percentile >= 20 && $Percentile < 40) {{-- //--L2 --}}
                                                                @php
                                                                    $IndividualFitnessClr = "#fc6ba9";
                                                                @endphp
                                                            @endif
                                                            @if ($Percentile >= 40 && $Percentile < 60) {{-- //--L3 --}}
                                                                @php
                                                                    $IndividualFitnessClr = "#ffaa62";
                                                                @endphp
                                                            @endif
                                                            @if ($Percentile >= 60 && $Percentile < 70) {{-- //--L4 --}}
                                                                @php
                                                                    $IndividualFitnessClr = "#f7d54e";
                                                                @endphp
                                                            @endif
                                                            @if ($Percentile >= 70 && $Percentile < 80) {{-- //--L5 --}}
                                                                @php
                                                                    $IndividualFitnessClr = "#8bd470";
                                                                    // $Feedback = Resources.ResourceUserDashboard.label37;
                                                                    $Feedback = __('testfitnessreport.label37');
                                                                @endphp
                                                            @endif
                                                            @if ($Percentile >= 80 && $Percentile < 90) {{-- //--L6 --}}
                                                                @php
                                                                    $IndividualFitnessClr = "#00b289";
                                                                    // $Feedback = Resources.ResourceUserDashboard.label38;
                                                                    $Feedback = __('testfitnessreport.label38');;
                                                                @endphp
                                                            @endif
                                                            @if ($Percentile >= 90) {{-- //--L7 --}}
                                                                @php
                                                                    $IndividualFitnessClr = "#009bdf";
                                                                    // $Feedback = Resources.ResourceUserDashboard.label39;
                                                                    $Feedback = __('testfitnessreport.label39');;
                                                                @endphp
                                                            @endif

                                                            @if($Feedback == "")

                                                                @if ($CategoryOrginal == "Balance")
                                                                    @php
                                                                        // $Feedback = Resources.ResourceUserDashboard.label40;
                                                                        $Feedback = __('testfitnessreport.label40');
                                                                    @endphp
                                                                @elseif ($CategoryOrginal == "Agility")
                                                                    @php
                                                                        // $Feedback = Resources.ResourceUserDashboard.label41;
                                                                        $Feedback = __('testfitnessreport.label41');
                                                                    @endphp
                                                                @elseif ($CategoryOrginal == "Coordination")
                                                                    @php
                                                                        // $Feedback = GetGlobalResourceObject("ResourceUserDashboard", "label73").ToString();
                                                                        $Feedback = __('testfitnessreport.label73');
                                                                    @endphp
                                                                @elseif ($CategoryOrginal == "Cardiovascular Endurance")
                                                                    @php
                                                                        // $Feedback = GetGlobalResourceObject("ResourceUserDashboard", "label74").ToString();
                                                                        $Feedback = __('testfitnessreport.label74');
                                                                    @endphp
                                                                @elseif ($CategoryOrginal == "Speed")
                                                                    @php
                                                                        // $Feedback = Resources.ResourceUserDashboard.label42;
                                                                        $Feedback = __('testfitnessreport.label42');
                                                                    @endphp
                                                                @elseif ($CategoryOrginal == "Flexibility")
                                                                    @php
                                                                        // $Feedback = Resources.ResourceUserDashboard.label43;
                                                                        $Feedback = __('testfitnessreport.label43');
                                                                    @endphp
                                                                @elseif ($CategoryOrginal == "Strength")
                                                                    @php
                                                                        // $Feedback = Resources.ResourceUserDashboard.label44;
                                                                        $Feedback = __('testfitnessreport.label44');
                                                                    @endphp
                                                                @elseif ($CategoryOrginal == "Power")
                                                                    @php
                                                                        // $Feedback = Resources.ResourceUserDashboard.label45;
                                                                        $Feedback = __('testfitnessreport.label45');
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $Feedback = "";
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endif


                                                        {{-- @if(ds1.Tables.Count > 0) --}}
                                                        @if(count($userprofilePrevious) > 0)

                                                            {{-- if (ds.Tables[2].Rows.Count == ds1.Tables[2].Rows.Count) --}}
                                                            @if(count($resultSet5) == count($resultSet5Previous))
                                                                {{-- if (ds1.Tables[2].Rows.Count > 0) --}}
                                                                @if (count($resultSet5Previous) > 0)
                                                                    {{-- if (Convert.ToInt32(ds1.Tables[2].Rows[i]["Percentile"]) > 0) --}}
                                                                    {{-- @if ($Percentile > 0) --}}
                                                                    @if($resultSet5Previous[$i]["Percentile"] > 0)

                                                                        @if($resultSet5Previous[$i]["Percentile"] < 20)
                                                                            @php
                                                                                $PreviousIndividualFitnessClr = "#ff043f";
                                                                            @endphp
                                                                        @endif
                                                                        @if ($resultSet5Previous[$i]["Percentile"] >= 20 && $resultSet5Previous[$i]["Percentile"] < 40)
                                                                            @php
                                                                                $PreviousIndividualFitnessClr = "#fc6ba9";
                                                                            @endphp
                                                                        @endif
                                                                        @if ($resultSet5Previous[$i]["Percentile"] >= 40 && $resultSet5Previous[$i]["Percentile"] < 60)
                                                                            @php
                                                                                $PreviousIndividualFitnessClr = "#ffaa62";
                                                                            @endphp
                                                                        @endif
                                                                        @if ($resultSet5Previous[$i]["Percentile"] >= 60 && $resultSet5Previous[$i]["Percentile"] < 70)
                                                                            @php
                                                                                $PreviousIndividualFitnessClr = "#f7d54e";
                                                                            @endphp
                                                                        @endif
                                                                        @if ($resultSet5Previous[$i]["Percentile"] >= 70 && $resultSet5Previous[$i]["Percentile"] < 80)
                                                                            @php
                                                                                $PreviousIndividualFitnessClr = "#8bd470";
                                                                            @endphp
                                                                        @endif
                                                                        @if ($resultSet5Previous[$i]["Percentile"] >= 80 && $resultSet5Previous[$i]["Percentile"] < 90)
                                                                            @php
                                                                                $PreviousIndividualFitnessClr = "#00b289";
                                                                            @endphp
                                                                        @endif
                                                                        @if ($resultSet5Previous[$i]["Percentile"] >= 90)
                                                                            @php
                                                                                $PreviousIndividualFitnessClr = "#009bdf";
                                                                            @endphp
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif

                                                        @endif

                                                        {{-- if (!string.IsNullOrEmpty(ds.Tables[2].Rows[i]["Score"].ToString())) --}}
                                                        @if ($Score)
                                                            @php
                                                                $CurrentScore = $Score;
                                                                // $CurrentScoreUnit = ds.Tables[2].Rows[i]["Score_Unit"].ToString();
                                                                $CurrentScoreUnit = $Score_Unit;
                                                            @endphp

                                                            @if($CurrentScoreUnit == "mm")
                                                                @php
                                                                    // $FCurrentScore = RatingScores.HeightConvertern(Convert.ToDouble(ds.Tables[2].Rows[i]["Score"].ToString())) +" " + GetGlobalResourceObject("ResourceTakeTest", "label8").ToString() + "";
                                                                    // $FScoreUnit = Resources.ResourceTakeTest.label8;
                                                                    $FCurrentScore = $Score . "".__('taketest.label8');
                                                                    // $FScoreUnit = Resources.ResourceTakeTest.label8;
                                                                    $FScoreUnit = __('taketest.label8');
                                                                @endphp
                                                            @endif
                                                            @if ($CurrentScoreUnit == "msec")
                                                                @php
                                                                    // $FCurrentScore = Showresult(ds.Tables[2].Rows[i]["Score"].ToString());
                                                                    $FCurrentScore = $Score;
                                                                    // $FScoreUnit = Resources.ResourceTakeTest.label11;
                                                                    $FScoreUnit = __('taketest.label11');                                                                    
                                                                    $value = $Score;
                                                                    $unit = $CurrentScoreUnit;
                                                                    $FCurrentScore = changeparmeter($value, $unit);
                                                                @endphp
                                                            @endif
                                                            @if ($CurrentScoreUnit == "number")
                                                                @php
                                                                    // $FCurrentScore = ds.Tables[2].Rows[i]["Score"].ToString() + " " + GetGlobalResourceObject("ResourceTakeTest", "label129").ToString() + "";
                                                                    // $FCurrentScore = $Score." ". __('taketest.label129');
                                                                    // $FScoreUnit = GetGlobalResourceObject("ResourceTakeTest", "label129").ToString();
                                                                    // $FScoreUnit = __('taketest.label129');
                                                                    $value = $Score;
                                                                    $unit = $CurrentScoreUnit;
                                                                    $FCurrentScore = changeparmeter($value, $unit);
                                                                    // dd($FCurrentScore);
                                                                @endphp
                                                            @endif
                                                        @endif
                                                        {{-- @if (ds1.Tables.Count > 0) --}}
                                                        @if (count($userprofilePrevious) > 0)
                                                            {{-- {{ dd($FPreviousScore) }} --}}
                                                            {{-- if (ds1.Tables[2].Rows.Count > 0) --}}
                                                            @if (count($resultSet5Previous) > 0)
                                                                {{-- {{ dd($resultSet5Previous) }} --}}
                                                                {{-- if(i < ds1.Tables[2].Rows.Count) --}}
                                                                {{-- {{ dd($i) }} --}}
                                                                @if($i < count($resultSet5Previous))
                                                                {{-- {{ dd($resultSet5Previous) }} --}}
                                                                    {{-- @if (!string.IsNullOrEmpty(ds1.Tables[2].Rows[i]["Score"].ToString())) --}}
                                                                    {{-- @if (!$Score) --}}
                                                                    {{-- @if ($Score) --}}
                                                                    @if ($resultSet5Previous[$i]["Score"])
                                                                        @php
                                                                            // int PreviousScore = Convert.ToInt32(ds1.Tables[2].Rows[i]["Score"]);
                                                                            // string PreviousScoreUnit = ds1.Tables[2].Rows[i]["Score_Unit"].ToString();
                                                                            $PreviousScore = $resultSet5Previous[$i]["Score"];
                                                                            $PreviousScoreUnit = $resultSet5Previous[$i]["Score_Unit"];
                                                                        @endphp

                                                                        @if($PreviousScoreUnit == "mm")
                                                                            @php
                                                                                // FPreviousScore = RatingScores.HeightConvertern(Convert.ToDouble(ds1.Tables[2].Rows[i]["Score"])) + " " + GetGlobalResourceObject("ResourceTakeTest", "label8").ToString() + ""; ;
                                                                                $FPreviousScore = $resultSet5Previous[$i]["Score"] ." " .__('taketest.label8');
                                                                                $FPreviousScoreUnit = "cm";
                                                                            @endphp
                                                                        @endif
                                                                        @if($PreviousScoreUnit == "msec")
                                                                            @php
                                                                                // FPreviousScore = Showresult(ds1.Tables[2].Rows[i]["Score"].ToString());
                                                                                $FPreviousScore = $resultSet5Previous[$i]["Score"];
                                                                                $FPreviousScoreUnit = "min";
                                                                                $value = $resultSet5Previous[$i]["Score"];
                                                                                $unit = $PreviousScoreUnit;
                                                                                $FPreviousScore = changeparmeter($value, $unit);
                                                                            @endphp
                                                                        @endif
                                                                        @if($PreviousScoreUnit == "number")
                                                                            @php
                                                                                // FPreviousScore = ds1.Tables[2].Rows[i]["Score"].ToString() + " " + GetGlobalResourceObject("ResourceTakeTest", "label129").ToString() + "";
                                                                                $FPreviousScore = $resultSet5Previous[$i]["Score"] ." " . __('taketest.label129');
                                                                                // $FPreviousScoreUnit = " Times";
                                                                                $FPreviousScoreUnit = __('taketest.label129');                                                                                
                                                                                $value = $resultSet5Previous[$i]["Score"];
                                                                                $unit = $PreviousScoreUnit;
                                                                                $FPreviousScore = changeparmeter($value, $unit);
                                                                            @endphp
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif

                                                        <div class='test-list'>
                                                            {{-- <label class='report-label2'>" + GetGlobalResourceObject("ResourceUserDashboard", "" + TestCategory + "").ToString() + "</label> --}}
                                                            <label class='report-label2'>{{ __("userdashboard.$TestCategory") }}</label>
                                                            {{-- <label class='report-label3'>" + GetGlobalResourceObject("ResourceUserDashboard", "" + ds.Tables[2].Rows[i]["TestType"].ToString() + "").ToString() + "</label> --}}
                                                            <label class='report-label3'>{{ __("userdashboard.$TestType") }}</label>
                                                            <div class='clearfix'></div>
                                                            <div class='all-test-data'>
                                                                <div class='all-test-col-1'>
                                                                    <header id='header4' >
                                                                        <div class='label'></div>
                                                                        <div class='label count'>
                                                                            <span class='twnty'>L1</span>
                                                                            <span class='twnty'>L2</span>
                                                                            <span class='twnty'>L3</span>
                                                                            <span class='ten'>L4</span>
                                                                            <span class='ten'>L5</span>
                                                                            <span class='ten'>L6</span>
                                                                            <span class='ten'>L7</span>
                                                                        </div>
                                                                    </header>
                                                                    <section>
                                                                        <div class='rw'>
                                                                            {{-- <div class='label'>" + GetGlobalResourceObject("Resourcetestfitnessreport", "label5").ToString() + "</div> --}}
                                                                            <div class='label'>{{ __('testfitnessreport.label5') }}</div>
                                                                            <div class='label'>
                                                                                <div class='graph-bar'>
                                                                                    {{-- //------------------------------------------------------ Current Term --}}
                                                                                    {{-- @if (Convert.ToInt32(ds.Tables[2].Rows[i]["Percentile"]) > 0) --}}
                                                                                    {{-- @if(round($resultSet5[$i]["Percentile"]) > 0) --}}                                                                                    
                                                                                    @if($resultSet5[$i]["Percentile"] > 0)
                                                                                        {{-- <span style='background: " + IndividualFitnessClr + "; width:" + ds.Tables[2].Rows[i]["Percentile"].ToString() + "%;'>&nbsp;</span> --}}
                                                                                        <span style='background:{{ $IndividualFitnessClr }}; width:{{ $resultSet5[$i]["Percentile"] }}%;'>&nbsp;</span>
                                                                                    @else
                                                                                        <span style='background: #fff'></span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        {{-- //------------------------------------------------------------- Previous --}}
                                                                        <div class='rw'>
                                                                            {{-- <div class ='label'>" + GetGlobalResourceObject("Resourcetestfitnessreport", "label6").ToString() + "</div> --}}
                                                                            <div class ='label'>
                                                                                {{ __('testfitnessreport.label6') }}
                                                                            </div>
                                                                            <div class='label'>
                                                                                <div class='graph-bar'>                                                                                    
                                                                                    @if(count($userprofilePrevious) > 0)
                                                                                        {{-- {{ dd($userprofilePrevious) }} --}}
                                                                                        {{-- if (ds.Tables[2].Rows.Count == ds1.Tables[2].Rows.Count) --}}
                                                                                        @if(count($resultSet5) == count($resultSet5Previous))
                                                                                            {{-- {{ dd($resultSet5Previous[$i]["Percentile"]) }} --}}
                                                                                            {{-- {{ dd($resultSet5Previous) }} --}}
                                                                                            {{-- {{ dd($resultSet5Previous) }} --}}
                                                                                            @if(count($resultSet5Previous) > 0)
                                                                                                @if($resultSet5Previous[$i]["Percentile"] > 0)
                                                                                                    {{-- {{ dd($resultSet5Previous[$i]["Percentile"]) }}                                                                                               --}}
                                                                                                    {{-- <span style='background:" + PreviousIndividualFitnessClr + "; width:" + Math.Round(Convert.ToDecimal(ds1.Tables[2].Rows[i]["Percentile"]) / 10, 0) + "%;'>&nbsp;</span> --}}
                                                                                                    {{-- <span style='background:{{ $PreviousIndividualFitnessClr }};width:{{ round($Percentile) }}"])/10)%;'>&nbsp;</span> --}}
                                                                                                    <span style='background:{{ $PreviousIndividualFitnessClr }};width:{{ round($resultSet5Previous[$i]["Percentile"]/10)}}%;'>&nbsp;</span>

                                                                                                @else
                                                                                                    <span style='background:#fff '></span>
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    @else
                                                                                    <span></span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </section>

                                                                </div>

                                                            <div class='all-test-col-2'>

                                                                <header id='header5'>
                                                                    <div class='label'></div>
                                                                    {{-- <div class='label'>" + GetGlobalResourceObject("Resourcetestfitnessreport", "label12").ToString() + "</div> --}}
                                                                    <div class='label'>{{ __('testfitnessreport.label15') }}</div>
                                                                    {{-- <div class='label'>" + GetGlobalResourceObject("Resourcetestfitnessreport", "label13").ToString() + "</div> --}}
                                                                    <div class='label'>{{ __('testfitnessreport.label13') }}</div>
                                                                </header>

                                                            <section>
                                                                    {{-- //--------------------------------------------------------------- Current --}}
                                                                    <div class='rw'>
                                                                        {{-- <div class='label'>" + GetGlobalResourceObject("Resourcetestfitnessreport", "label5").ToString() + "</div> --}}
                                                                        <div class='label'>
                                                                            {{ __('testfitnessreport.label5') }}
                                                                        </div>
                                                                        {{-- if (!string.IsNullOrEmpty(ds.Tables[2].Rows[i]["Score"].ToString())) --}}

                                                                        {{-- @if(!$Score)                                                                                                                                            --}}
                                                                        @if($Score)                                                                        
                                                                            <div class='label'>                                                                                
                                                                                {{ $FCurrentScore ?? ''}}                                                                                
                                                                            </div>
                                                                        @else
                                                                            <div class='label'>{{ __('fitnessreport.label9') }}</div>
                                                                        @endif

                                                                        {{-- @if (Convert.ToInt32(ds.Tables[2].Rows[i]["Percentile"]) > 0) --}}
                                                                        {{-- @if ($Percentile > 0)                                                                     --}}
                                                                        {{-- {{ dd($resultSet5[$i]["Percentile"]) }} --}}
                                                                        @if (round($resultSet5[$i]["Percentile"]) > 0)                                                                        
                                                                            <div class='label'>
                                                                                {{ round($resultSet5[$i]["Percentile"] / 10) }}
                                                                            </div>
                                                                        @else

                                                                            <div class='label'>NA</div>
                                                                        @endif
                                                                    </div>
                                                                {{-- //------------------------------------------------------------------- Previous --}}
                                                                <div class='rw'>
                                                                {{-- <div class='label'>" + GetGlobalResourceObject("Resourcetestfitnessreport", "label6").ToString() + "</div> --}}
                                                                    <div class='label'>
                                                                        {{ __('testfitnessreport.label6') }}
                                                                    </div>

                                                                    {{-- if (ds1.Tables.Count > 0) --}}
                                                                    @if(count($userprofilePrevious) > 0)

                                                                        {{-- if (ds.Tables[2].Rows.Count == ds1.Tables[2].Rows.Count) --}}
                                                                        @if(count($resultSet5) == count($resultSet5Previous))

                                                                            {{-- if (ds1.Tables[2].Rows.Count > 0) --}}
                                                                            @if (count($resultSet5Previous) > 0)

                                                                                {{-- if (!string.IsNullOrEmpty(ds1.Tables[2].Rows[i]["Score"].ToString())) --}}
                                                                                {{-- @if (!$Score) --}}
                                                                                {{-- @if ($Score) --}}
                                                                                {{-- <div class='label'>" + FPreviousScore + "</div> --}}
                                                                                @if($resultSet5Previous[$i]["Score"])
                                                                                    <div class='label'>
                                                                                        {{-- {{ $resultSet5Previous[$i]['Score'] }} --}}
                                                                                        {{ $FPreviousScore }}
                                                                                        {{-- {{ dd($resultSet5Previous[$i]['Score']) }} --}}
                                                                                    </div>
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @else

                                                                        {{-- <div class='label'>" + GetGlobalResourceObject("Resourcetestfitnessreport", "label9").ToString() + "</div> --}}
                                                                        <div class='label'>{{ __('testfitnessreport.label9') }}</div>
                                                                    @endif
                                                                    {{-- @if (ds1.Tables.Count > 0) --}}
                                                                    @if (count($userprofilePrevious) > 0)

                                                                        {{-- if (ds.Tables[2].Rows.Count == ds1.Tables[2].Rows.Count) --}}
                                                                        @if (count($resultSet5) == count($resultSet5Previous))

                                                                            {{-- if (ds1.Tables[2].Rows.Count > 0) --}}
                                                                            @if (count($resultSet5Previous) > 0)

                                                                                {{-- if (Convert.ToInt32(ds1.Tables[2].Rows[i]["Percentile"]) > 0) --}}
                                                                                {{-- @if ($Percentile > 0) --}}
                                                                                @if ($resultSet5Previous[$i]["Percentile"] > 0)
                                                                                    {{-- <div class='label'>" + Math.Round(Convert.ToDecimal(ds1.Tables[2].Rows[i]["Percentile"]) / 10, 0)  + "</div> --}}
                                                                                    <div class='label'>{{ (round($resultSet5Previous[$i]["Percentile"])/ 10) }}</div>
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        <div class='label'>NA</div>
                                                                    @endif
                                                                </div>
                                                            </section>

                                                            </div>
                                                            <div class='test-feedback' id='feed1' >
                                                            {{-- <span>" + GetGlobalResourceObject("Resourcetestfitnessreport", "label11").ToString() + "</span><span>" + Feedback + "</span> --}}
                                                            <span>{{ __('testfitnessreport.label11') }}:</span>
                                                            </div>
                                                            </div>
                                                        </div>
                                                @endfor
                                            @endif
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            </div>

                            {{-- #endregion --}}
                            {{-- //******************************************************* Report Footer End ****************************************************** --}}

                            {{-- dvReport.InnerHtml += html; --}}
                            {{-- Session["NameChild"] = ds.Tables[0].Rows[0]["Name"].ToString(); --}}


                    </div>
                    <div class="report-btn" style="display:none">
                        <button id="btnExport" value="Export" type="button" onserverclick="BtnCreatePdf_Click">
                            <span class="download-txt">
                                {{-- <%= Resources.Resourcetestfitnessreport.label1 %> --}}
                                {{ __('userdashboard.label1') }}
                            </span>
                            <span class="download-i">
                                <img src="Images/down-arrow.png" alt="download" />
                            </span>
                        </button>
                    </div>
                </div>
           </div>
        </div>
     </div>
@php
//    $v = __('taketest.label8');
//    echo $v;

function changeparmeter($value, $unit)
{

    
    if ($unit == 'mm') {
        if ($value < 1000 && $value >= 0) {
            $actualvalue = $value / 10;

            if (is_int($actualvalue)) {
                return $actualvalue . '.' . '0';
            } else {
                return $actualvalue;
            }
        } elseif ($value > -1000 && $value < 0) {
            $actualvalue = $value / 10;

            if (is_int($actualvalue)) {
                return $actualvalue . '.' . '0';
            } else {
                return $actualvalue;
            }
        }


    }

    if ($value >= '100000' && $unit == 'msec') {
        $actualvalue = $value / 60000;
        $decimalindex = strrpos($actualvalue, '.');
        $intvalue = substr($actualvalue, 0, $decimalindex);
        $decimalvalue = substr($actualvalue, $decimalindex + 1);
        $finaldecimalvalue = substr($decimalvalue, 0, 2);

        if (is_int($finaldecimalvalue < 10)) {
            return $intvalue . ' ' . __('taketest.label11') . ' ' . $finaldecimalvalue * 10 . ' ' . __('taketest.label66');
        } elseif (is_int($actualvalue)) {
            return $actualvalue . ' ' . __('taketest.label11') . ' ' . '0.0' . ' ' . __('taketest.label66');
        } else {
            return $intvalue . ' ' . __('taketest.label11') . ' ' . $finaldecimalvalue . ' ' . __('taketest.label66');
        }
    } elseif ($value <= '100000' && $unit == 'msec') {
        $actualvalue = $value / 1000;
        if ($actualvalue >= 60) {
            $actualvalue = $actualvalue / 60;
            if (is_int($actualvalue)) {
                return $actualvalue . ' ' . __('taketest.label11') . ' ' . '0.0' . ' ' . __('taketest.label66');
            } else {
                $decimalindex = strrpos($actualvalue, '.');
                $intvalue = substr($actualvalue, 0, $decimalindex);
                $decimalvalue = substr($actualvalue, $decimalindex + 1);
                $finaldecimalvalue = substr($decimalvalue, 0, 2);
                if ($finaldecimalvalue < 10) {
                    return $intvalue . ' ' . __('taketest.label11') . ' ' . $finaldecimalvalue * 10 . ' ' . __('taketest.label66');
                } else {
                    return $intvalue . ' ' . __('taketest.label11') . ' ' . $finaldecimalvalue . ' ' . __('taketest.label66');
                }
            }
        }
        if (is_int($actualvalue)) {
            return round($actualvalue,2) . '.0' . ' ' . __('taketest.label66');
        } else {
            return round($actualvalue,2) . ' ' . __('taketest.label66');
        }
    }
    if($unit=='number'){
    return $value ." ". __('userdashboard.label38');
    }
}

@endphp

    <script>
        $(document).ready(function () {
            $('#navbar1').css('display', 'none');
            $('#landingdescription').css('display', 'none');
        });

        $(document).ready(function () {
            var element = $("#<%=dvReport.ClientID%>"); // global variable
            var getCanvas; // global variable

            $("#btnExport").on('click', function () {

                html2canvas(element, {
                    onrendered: function (canvas) {
                        getCanvas = canvas;
                        var imgageData = getCanvas.toDataURL("image/png");
                        // Now browser starts downloading it instead of just showing it
                        var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
                        $("#btnExport").attr("download", "Benchmark.png").attr("href", newData);
                    }
                });
            });
        });



        var date="{{Session::get('date')}}";
         var Age ="{{Session::get('Age')}}";
        var AgeGroupId = "{{Session::get('AgeGroupId')}}";
        var AgeGroupName ="{{Session::get('AgeGroupName')}}";
            var F365Id="{{Session::get('F365Id')}}";
            var Name="{{Session::get('hidname')}}";
            var GenderId="{{Session::get('GenderId')}}";
            // '/memberdashboard/{Name?}/{F365Id?}/{Age?}/{AgeGroupId?}/{AgeGroupName?}/{GenderId?}',


            console.log(AgeGroupName);


            function GoBack() {
                if(date){
                window.location=href="{{ url('datewisedate') }}";
                }else{
                    window.location=href=`{{ url('memberdashboard/${Name}/${F365Id}/${Age}/${AgeGroupId}/${AgeGroupName}/${GenderId}')}}`;
                }
            }
    </script>

@endsection
