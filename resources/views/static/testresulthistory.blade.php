@extends('static.layouts.appnet')
@section('title', 'Fit India Take Test | Fit India')
@section('content')
 
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-127986665-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date()); 

        gtag('config', 'UA-127986665-1'); 
    </script>




    <link href="{{ asset('resources/css/Graph.css') }}" rel="stylesheet" />
    <link href="{{ asset('resources/css/new-app-style.css')}}"  rel="stylesheet" /> 

    <div class="inner-page-header">
        <div class="container back-btn-set">
            <button class="header-back-btn" runat="server" onclick="goBack()">
                <img src="{{ url('resources/dotnetimages/switch-user.png') }}" /></button>
            <h4 id="lblHeading" runat="server">{{__('testmaster.label18')}}</h4>
        </div>
    </div>




    <div class="header-bg-2">
        <div class="dashboard_area">
            <div class="container">
                <div class="row">


                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="header-content header-bottom-gap">
                            <h5 id="testcategoryli" runat="server">{{ __('userdashboard'.'.'.$testcategory) }}</h5>
                            <h2 id="testnameli" runat="server">{{ __('userdashboard'.'.'.$testname) }}</h2>
                        </div>
                    </div>

                </div>
                <!--end breadcrumbs-area-->
                <div class="row clearfix">
                    <div class="col-md-12">

                        <div class="wrapper-box">

                            {{-- <div class="header-content header-bottom-gap header-background">
                                <h2 class="text-02 p-01 header-bg">Whatever is your existing level of fitness, <span>give it a PLUS</span></h2>
                            </div> --}}

                            <div class="tab-navgation">

                                <ul class="nav nav-tabs test2">
                                    <li class="active"><a data-toggle="tab" href="#home1" aria-expanded="true">{{__('testresulthistory.label2')}}</a></li>
                                    {{-- <%-- <li class="" id="li_classwisedata" onclick="getclasswise()"  ><a data-toggle="tab" href="#menu1" aria-expanded="false">In MY Class</a></li>--%> --}}
                                    <li class="" id="li_agewisedata" onclick="getagewise()"><a data-toggle="tab" href="#menu2" aria-expanded="false">{{__('testresulthistory.label3')}}</a></li>
                                </ul>

                                <div class="tab-content" style="padding: 0px;">
                                    <div id="home1" class="tab-pane fade active in">
                                        <div class="score-board  " style="color: #000000;">

                                            <div class="score-details">
                                                <div class=" level-score">
                                                    <img src="{{ url('resources/dotnetimages/score-level.png')}}" />
                                                    <span id="scorelvl" runat="server">{{ $FitnessLebel }}</span>
                                                </div>
                                                <div class="score-card small-dev-center ltr">
                                                    <span>{{__('testresulthistory.label4')}}</span>
                                                    <p id="myscore_p" runat="server">{{ $myscore }}</p>
                                                </div>
                                            </div>



                                            <div class="score-details small-dev-left">
                                                <div class=" level-score">
                                                </div>
                                                <div class="score-card">
                                                    <span>{{__('testresulthistory.label5')}}</span>
                                                    <p id="p_nxtgl" runat="server">{{ $p_nxtgl }}</p>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="legend-level clearfix">

                                            <ul>
                                                <li>
                                                    <span>L1</span>
                                                    <div class="level-01">
                                                        <p>{{__('testresulthistory.label6')}}</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span>L2</span>
                                                    <div class="level-02">
                                                        <p>{{__('testresulthistory.label7')}}</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span>L3</span>
                                                    <div class="level-03">
                                                        <p>{{__('testresulthistory.label8')}}</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span>L4</span>
                                                    <div class="level-04">
                                                        <p>{{__('testresulthistory.label9')}}</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span>L5</span>
                                                    <div class="level-05">
                                                        <p>{{__('testresulthistory.label10')}}</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span>L6</span>
                                                    <div class="level-06">
                                                        <p>{{__('testresulthistory.label11')}}</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span>L7</span>
                                                    <div class="level-07">
                                                        <p>{{__('testresulthistory.label12')}}</p>
                                                    </div>
                                                </li>
                                            </ul>

                                        </div>
                                        <!--end tab navigation-->


                                        <div class="balance-chart-area clearfix">
                                            {{-- <%--<!-advice-->--%> --}}
                                            <div class="header-content text-h3-margin ">
                                                <h3>{{__('testresulthistory.label13')}}</h3>
                                                <p id="p_advce" runat="server">{{$Feedback}}</p>
                                            </div>
                                            <!--end advice-->

                                            <!--graph-->
                                            <div class="level-graph">
                                                <div id="testdetailsdiv" style="height: 400px; width: 100%;"></div>
                                            </div>
                                            <!--end graph level-->

                                            <!--about the test-->
                                            <div class="about-test boclearfix">
                                                <h3>{{__('testresulthistory.label14')}}</h3>
                                                {{-- {{ dd(Session::get('lang')); }} --}}
                                                {{-- <p id="testdesc" runat="server">{{ __('testresulthistory.'.$testdescvalue) }}</p> --}}
                                                @if(Session::get('lang') == 'en')
                                                    {{-- <p id="testdesc" runat="server">{{ __('testresulthistory.'.$testdescvalue) }}</p> --}}
                                                    <p id="testdesc" runat="server">{{ __('testresulthistory.labe20') }}</p>
                                                @elseif(Session::get('lang') == 'hn')
                                                    <p id="testdesc" runat="server">{{ __('testresulthistory.labe21') }}</p>
                                                {{-- <p id="testdesc" runat="server">{{ __('testresulthistory.'.$testdescvalue) }}</p> --}}
                                                @endif
                                            </div>

                                            <!--end about the test-->

                                        </div>
                                    </div>

                                    <div id="menu2" class="tab-pane fade ">
                                        <div class="score-board " style="color: #000000;">

                                            <div class="score-details">
                                                 {{-- <div class=" level-score">
                                                      <img src="images/score-level.png" />
                                                        <span id="Span2" runat="server"></span>
                                                    </div> --}}
                                                <div class="score-card ltr">
                                                    <span>{{__('testresulthistory.label15')}}</span>
                                                    <p id="P1_agewise" runat="server"></p>
                                                </div>
                                            </div>


                                            <div class="score-details">
                                                <div class=" level-score">
                                                </div>
                                                <div class="score-card">
                                                    <span>{{__('testresulthistory.label16')}}</span>
                                                    <p id="p2_agewise" runat="server"></p>
                                                </div>
                                            </div>


                                            <div class="score-details border-none">
                                                {{-- <%-- <div class=" level-score">
                                                    </div>--%> --}}
                                                <div class="score-card">
                                                    <span>{{__('testresulthistory.label4')}}</span>
                                                    <p runat="server" id="p3_agewise"></p>
                                                </div>
                                            </div>

                                            <div class="balance-chart-area clearfix">
                                                <!--graph level-->
                                                <div class="level-graph">

                                                    <div id="div_agewiseftnesyest" style="height: 400px; width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>




                                    </div>
                                </div>
                                <!--end tab navigation-->
                                {{-- <%--                                <div class="print-area text-center clearfix">
                                    <i class="fa fa-print"></i><span>If you want print this page <a href="#a">Click here.</a></span>
                                </div>--%> --}}
                                <div id="hidLang" runat="server">
                            </div>
                            </div>
                            <!--wrapper box end-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="clearfix"></div>
    <!--Popbox-->
    <script src="{{asset('resources/Scripts/canvas.js')}}" type="text/javascript"></script>
    <script src="{{asset('resources/Scripts/Colourcodefunction.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#navbar1').css('display', 'none');
            $('#landingdescription').css('display', 'none');
        });


        $(document).ready(function () {
            var UserTesttypeid = '{{$TestTypeId}}';
            var id ='{{$Userid}}';

            console.log('result'); 
            var dataPointstest = [];
            var camptotal = 0;
            $.ajax({
                type: "POST",
                url: "{{url('TestResultHistory/BindData')}}",
                data: {
                    Testtypeid:UserTesttypeid,
                    Userid:id,
                    _token: $('meta[name="csrf-token"]').attr('content')},
                 
                success: function (response) {
                    console.log(response);

                    for (var i = 0; i < response.length; i++) {
                        dataPointstest.push({ 'label': response[i].DisplayDate, 'y': Number(response[i].Percentile), color: gettestcolor(response[i].Percentile) })
                    }

                    
                    var chart1 = new CanvasJS.Chart("testdetailsdiv", {
                        theme: "theme2",
                        interactivityEnabled: true,
                        animationEnabled: true,
                        animationDuration: 1000,

                        title: {
                            //text: ""

                        },
                        animationEnabled: true,
                        data: [
                            {
                                type: 'column',
                                animationEnabled: true,

                                dataPoints: dataPointstest
                            }
                        ]
                    });
                    chart1.options.data[0].color = '#c8c8c8';

                    chart1.render();
                },
                error: function (data) {

                }
            }); 

        });

        function getagewise() {
            var flag = 2;
            var UserTesttypeid = '{{$TestTypeId}}';
            var id ='{{$Userid}}';
            var age='{{$Userage}}';



            $.ajax({


                type: "POST",
                url: "{{url('TestResultHistory/classwisetestdetails')}}",
             
                data: {
                    
                    flag:flag,
                    Testtypeid:UserTesttypeid,
                    Userid:id,
                    Userage:age,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function (response) {
                    console.log(response);

                    var scoremeasurement = '';
                    var status = '';

                     $("#P1_agewise").html(response.cal_bestscore);
                    $("#p2_agewise").html(response.clac_classavg_score);
                     $("#p3_agewise").html(response.calc_myscore);

                  
                        if (response.status == "More_is_better") {
                            status = "{{ __('testhome.label97') }}";
                        }
                        else if (response.status == "Less_is_better") {
                            status = "{{ __('testhome.label98') }}";
                        }

                        if (response.measurement == "Time") {
                            scoremeasurement = "{{ __('testhome.label99') }}";
                        }
                        else if (response.measurement == "Distance") {
                            scoremeasurement = "{{ __('testhome.label100') }}";
                        }
                   
                   
                    var chart = new CanvasJS.Chart('div_agewiseftnesyest', {
                        title: { text: status },
                        //  theme: "theme3",
                        interactivityEnabled: true,
                        animationEnabled: true,
                        animationDuration: 1000,
                        //dataPointWidth:75,

                        axisY: {
                            title: scoremeasurement
                        },
                        animationEnabled: true,
                        data: [
                            {
                                type: 'column',
                                animationEnabled: true,
                                showInLegend: false,
                                dataPoints: [
                                    //GetGlobalResourceObject("ResourceTestResultHistory", "label15")
                                    { label: "{{ __('testresulthistory.label15') }}", y: Number(response.bestscore) },
                                     { label: "{{ __('testresulthistory.label30') }}", y: Number(response.classavgscore) },
                                    { label: "{{ __('testresulthistory.label4') }}", y: Number(response.myscore) },]
                                
                            }

                        ]
                    });

                    //chart.options.data[0].color = '#D7DBDD';
                    chart.render();
                },

                error: function (response) {

                }
            });
        }


        function goBack(){
            window.location=href="{{ url('homeaddusers') }}";
        }


    </script>
@endsection
