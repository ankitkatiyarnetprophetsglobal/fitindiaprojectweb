
{{-- {{ dd($displayalldata) }} --}}
@extends('static.layouts.appnet')
@section('title', 'Fit India Test List | Fit India')
@section('content')
{{-- <asp:Content ID="Content1" ContentPlaceHolderID="head" runat="server"> --}}
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-127986665-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-127986665-1');
    </script>
{{-- </asp:Content> --}}
{{-- <asp:Content ID="Content2" ContentPlaceHolderID="ContentPlaceHolder1" runat="server"> --}}
    <style>
        body {
            background: #fff;
        }
        table th{font-size:15px}
        table td{font-size:15px}
    </style>

    <div class="inner-page-header">
        <div class="container back-btn-set">
            <button class="header-back-btn" onclick="GoBack()">
                {{-- <img src="Images/back_btn_i.png" /> --}}
                <img src="{{ url('resources/dotnetimages/Images/back_btn_i.png')}}" />
            </button>
            {{-- <h4 id="lblHeading" runat="server"><%= Resources.ResourceMaster.label17 %></h4> --}}
            <h4 id="lblHeading">{{ __('testmaster.label17') }}</h4>
        </div>
    </div>

    <div class="history-col">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-md-12">
                    <div class="user-history-info">
                        {{-- <span><%= Resources.ResourceTestHistory.label1 %></span> --}}
                        <span>{{ __('testhistory.label1') }}</span>
                        <span id="username">{{ $FitnessHistory[0]->Name ?? ""}}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="divHistory">
                    {{-- if (ds.Tables[0].Rows.Count > 0) --}}
                    @if(count($displayalldata) > 0)
                        {{-- {{ dd($displayalldata[0]['Name']) }} --}}
                        @php
                            // $username.InnerText = ds.Tables[0].Rows[0]["Name"].ToString();
                            $username = $displayalldata[0]['Name'];
                            $date = "";
                        @endphp

                        {{-- @for (int i = 0; i < ds.Tables[0].Rows.Count; i++) --}}
                        @for ($i = 0; $i < count($displayalldata); $i++)
                            {{-- {{ dd($FitnessHistory[$i]->DATE) }} --}}
                            {{-- if (date != ds.Tables[0].Rows[i]["DATE"].ToString()) --}}
                            @if($date != $displayalldata[$i]['DATE'])
                                @php
                                    // date = ds.Tables[0].Rows[i]["DATE"].ToString();
                                    $date = $displayalldata[$i]['DATE'];
                                @endphp
                            @endif

                            <div class='col-xs-12 col-sm-6 col-md-6'>
                                <div class='history-tbl'>
                                    <table class='table'>
                                        <thead>
                                            <tr>
                                                <th>
                                                    {{-- <img src='images/date-i.png' alt='date icon' /> --}}
                                                    <img src="{{ url('resources/dotnetimages/date-i.png')}}" />
                                                    {{-- <img src="{{ url('wp-content/uploads/staticimage/Images/images/date-i.png'}}" alt='date icon' /> --}}
                                                    {{-- <span>" + ds.Tables[0].Rows[i]["DisplayDate"].ToString() + "</span> --}}
                                                    <span>{{ $displayalldata[$i]['DisplayDate'] ?? ''}}</span>
                                                </th>
                                                <th>
                                                    <span class='age'>
                                                        {{-- " + GetGlobalResourceObject("ResourceTestHistory", "label2").ToString() + " --}}
                                                        {{ __('testhistory.label2') ?? '' }}
                                                    </span>
                                                        {{-- " + ds.Tables[0].Rows[i]["Age"].ToString() + " " + GetGlobalResourceObject("ResourceUserDashboard", "label3").ToString() + " --}}
                                                        {{ $displayalldata[$i]['Age'] ?? '' }} {{ __('userdashboard.label3') }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                {{-- <td>" + GetGlobalResourceObject("ResourceUserDashboard", "label7").ToString() + "</td> --}}
                                                <td>{{ __('userdashboard.label7') }}</td>
                                                {{-- <td>" + Math.Round(Convert.ToDouble(ds.Tables[0].Rows[i]["Height"]) * 100, 1) + " " + GetGlobalResourceObject("ResourceTakeTest", "label8").ToString() + "</td> --}}
                                                <td>{{ round($displayalldata[$i]['Height'] * 100 ) }} {{ __('taketest.label8') }}</td>
                                            </tr>
                                        <tr>
                                        {{-- <td>" + GetGlobalResourceObject("ResourceUserDashboard", "label8").ToString() + "</td> --}}
                                        <td>
                                            {{ __('userdashboard.label8') }}
                                        </td>
                                        <td>
                                            {{-- " + ds.Tables[0].Rows[i]["Weight"].ToString() + " " + GetGlobalResourceObject("ResourceTakeTest", "label128").ToString() + " --}}
                                            {{ $displayalldata[$i]['Weight'] ?? ''}} {{ __('taketest.label128') }}
                                        </td>
                                        </tr>
                                        <tr>
                                        <td>
                                            {{-- " + GetGlobalResourceObject("ResourceTestHistory", "label3").ToString() + " --}}
                                            {{ __('testhistory.label3') }}
                                        </td>
                                        <td>
                                            {{-- " + ds.Tables[0].Rows[i]["BMI"].ToString() + " --}}
                                            {{ $displayalldata[$i]['BMI'] ?? '' }}
                                        </td>
                                        </tr>
                                        <tr>
                                        <td>
                                            {{-- " + GetGlobalResourceObject("ResourceTestHistory", "label4").ToString() + " --}}
                                            {{ __('testhistory.label4') }}
                                        </td>
                                        <td>
                                            {{-- " + ds.Tables[0].Rows[i]["STATUS"].ToString() + " --}}
                                            {{ $displayalldata[$i]['STATUS'] ?? "" }}
                                        </td>
                                        </tr>
                                        {{-- {{ dd(($displayalldata[$i][$i])) }} --}}
                                        {{-- DataSet dr = new DataSet();
                                        using (SqlConnection con = new SqlConnection(kp))
                                        {
                                            SqlCommand sqlComm = new SqlCommand("spGetTestHistoryData", con);
                                            sqlComm.Parameters.AddWithValue("@f365id", F365Id);
                                            sqlComm.Parameters.AddWithValue("@date", Convert.ToDateTime(date));
                                            sqlComm.CommandType = CommandType.StoredProcedure;
                                            SqlDataAdapter da = new SqlDataAdapter();
                                            da.SelectCommand = sqlComm;
                                            da.Fill(dr);
                                        } --}}
                                        @php

                                            // $countinneri = $displayalldata[$i];
                                            // $countinnerii = $countinneri[$i];
                                             if(count($displayalldata[$i]) > 13){
                                               $count = count($displayalldata[$i])-13;
                                             }else{
                                                $count = 0;
                                             }

                                        @endphp
                                        {{-- for (int j = 0; j < dr.Tables[0].Rows.Count ; j++) --}}
                                        @if($count)
                                        @for ($j = 0; $j < $count; $j++)
                                        {{-- {{ dd($displayalldata[$i][$j]['DisplayDateV']) }} --}}
                                            {{-- string TestCategory = ""; --}}
                                            @php
                                                $TestCategory = "";
                                                $displayallTTNV = $displayalldata[$i][$j]['TTNV'];
                                            @endphp

                                             {{-- {{ dd( $displayalldata[$i][$j]['TCNV']) }}  --}}

                                            {{-- if (dr.Tables[0].Rows[j]["TCN"].ToString() == "label51" && dr.Tables[0].Rows[j]["TTN"].ToString() == "label56") --}}
                                            @if($displayalldata[$i][$j]['TCNV'] == "label51" && $displayalldata[$i][$j]['TTNV'] == "label56")
                                                @php
                                                    $TestCategory = "label65";
                                                @endphp
                                            {{-- @else if (dr.Tables[0].Rows[j]["TCN"].ToString() == "label51" && dr.Tables[0].Rows[j]["TTN"].ToString() == "label57") --}}
                                            @elseif ($displayalldata[$i][$j]['TCNV'] == "label51" && $displayalldata[$i][$j]['TTNV'] == "label57")
                                                @php
                                                    $TestCategory = "label52";
                                                @endphp
                                            @else
                                                @php
                                                    // $TestCategory = dr.Tables[0].Rows[j]["TCN"].ToString();
                                                    $TestCategory = $displayalldata[$i][$j]['TCNV'];
                                                @endphp
                                            @endif

                                            <tr>
                                                {{-- <td>" + GetGlobalResourceObject("ResourceUserDashboard", TestCategory).ToString() + " (" + GetGlobalResourceObject("ResourceUserDashboard", dr.Tables[0].Rows[j]["TTN"].ToString()).ToString() + ")</td> --}}
                                                <td>{{ __("userdashboard.$TestCategory") }} {{ __("userdashboard.$displayallTTNV") }}</td>
                                                {{-- <td>{{ __("userdashboard.$TestCategory") }} </td> --}}

                                                {{-- if (dr.Tables[0].Rows[j]["Score_Measurement"].ToString() == "Distance") --}}
                                                @if ($displayalldata[$i][$j]['Score_MeasurementV'] == "Distance")

                                                    {{-- <td>" + RatingScores.HeightConvertern(Convert.ToDouble(dr.Tables[0].Rows[j]["Score"].ToString())) + " " + GetGlobalResourceObject("ResourceTakeTest", "label8").ToString() + "</td> --}}
                                                    <td>
                                                        {{ $displayalldata[$i][$j]['ScoreV'] }} {{ __('taketest.label8') }}
                                                    </td>

                                                @elseif($displayalldata[$i][$j]['Score_MeasurementV'] == "Time")

                                                    {{-- <td>" + Showresult(dr.Tables[0].Rows[j]["Score"].ToString()) + "</td> --}}
                                                    <td>
                                                        @php
                                                            $value = $displayalldata[$i][$j]['ScoreV'];                                
                                                            $unit = 'msec';
                                                            echo changeparmeter($value, $unit);
                                                        @endphp
                                                    </td>

                                                @elseif($displayalldata[$i][$j]['Score_MeasurementV'] == "Count")

                                                    {{-- <td>" + dr.Tables[0].Rows[j]["Score"].ToString() + " " + GetGlobalResourceObject("ResourceTakeTest", "label129").ToString() + "</td> --}}
                                                    <td>
                                                        {{ $displayalldata[$i][$j]['ScoreV'] }}
                                                    </td>

                                                @endif
                                            </tr>
                                            <tr>
                                            {{-- <td>" + GetGlobalResourceObject("ResourceTestHistory", "label5").ToString() + "</td> --}}
                                            <td>{{ __('testhistory.label5') }}</td>

                                                {{-- if (Convert.ToDouble(dr.Tables[0].Rows[j]["Percentile"]) < 20) --}}
                                                @if($displayalldata[$i][$j]['PercentileV'] < 20)

                                                    {{-- if (dr.Tables[0].Rows[j]["Score_Criteria"].ToString() == "More_is_better") --}}
                                                    @if($displayalldata[$i][$j]['Score_CriteriaV'] == "More_is_better")

                                                        {{-- <td>" + GetGlobalResourceObject("ResourceUserDashboard", "label30").ToString() + "</td> --}}
                                                        <td>{{ __('userdashboard.label30') }}</td>

                                                    @else

                                                        {{-- <td>" + GetGlobalResourceObject("ResourceUserDashboard", "label36").ToString() + "</td> --}}
                                                        <td>{{ __('userdashboard.label36') }}</td>

                                                    @endif

                                                {{-- else if (Convert.ToDouble(dr.Tables[0].Rows[j]["Percentile"]) >= 20 && Convert.ToDouble(dr.Tables[0].Rows[j]["Percentile"]) < 40) --}}
                                                @elseif($displayalldata[$i][$j]['PercentileV'] >= 20 && $displayalldata[$i][$j]['PercentileV'] < 40)

                                                    {{-- if(dr.Tables[0].Rows[j]["Score_Criteria"].ToString() == "More_is_better") --}}
                                                    @if ($displayalldata[$i][$j]['Score_CriteriaV'] == "More_is_better")

                                                        {{-- <td>" + GetGlobalResourceObject("ResourceUserDashboard", "label31").ToString() + "</td> --}}
                                                        <td>{{ __('userdashboard.label31') }}</td>

                                                    @else

                                                        {{-- <td>" + GetGlobalResourceObject("ResourceUserDashboard", "label35").ToString() + "</td> --}}
                                                        <td>{{ __('userdashboard.label35') }}</td>

                                                    @endif

                                                {{-- else if (Convert.ToDouble(dr.Tables[0].Rows[j]["Percentile"]) >= 40 && Convert.ToDouble(dr.Tables[0].Rows[j]["Percentile"]) < 60) --}}
                                                @elseif($displayalldata[$i][$j]['PercentileV'] >= 40 && $displayalldata[$i][$j]['PercentileV'] < 60)

                                                    {{-- if (dr.Tables[0].Rows[j]["Score_Criteria"].ToString() == "More_is_better") --}}
                                                    @if($displayalldata[$i][$j]['Score_CriteriaV'] == "More_is_better")

                                                        {{-- <td>" + GetGlobalResourceObject("ResourceUserDashboard", "label32").ToString() + "</td> --}}
                                                        <td>{{ __('userdashboard.label32') }}</td>

                                                    @else

                                                        {{-- <td>" + GetGlobalResourceObject("ResourceUserDashboard", "label34").ToString() + "</td> --}}
                                                        <td>{{ __('userdashboard.label34') }}</td>
                                                    @endif

                                                {{-- else if (Convert.ToDouble(dr.Tables[0].Rows[j]["Percentile"]) >= 60 && Convert.ToDouble(dr.Tables[0].Rows[j]["Percentile"]) < 70) --}}
                                                @elseif($displayalldata[$i][$j]['PercentileV'] >= 60 && $displayalldata[$i][$j]['PercentileV'] < 70)

                                                    {{-- if (dr.Tables[0].Rows[j]["Score_Criteria"].ToString() == "More_is_better") --}}
                                                    @if ($displayalldata[$i][$j]['Score_CriteriaV'] == "More_is_better")

                                                        {{-- <td>" + GetGlobalResourceObject("ResourceUserDashboard", "label33").ToString() + "</td> --}}
                                                        <td>{{ __('userdashboard.label33') }}</td>

                                                    @else

                                                        {{-- <td>" + GetGlobalResourceObject("ResourceUserDashboard", "label33").ToString() + "</td> --}}
                                                        <td>{{ __('userdashboard.label33') }}</td>

                                                    @endif

                                                {{-- else if (Convert.ToDouble(dr.Tables[0].Rows[j]["Percentile"]) >= 70 && Convert.ToDouble(dr.Tables[0].Rows[j]["Percentile"]) < 80) --}}
                                                @elseif ($displayalldata[$i][$j]['PercentileV'] >= 70 && $displayalldata[$i][$j]['PercentileV'] < 80)

                                                    {{-- if (dr.Tables[0].Rows[j]["Score_Criteria"].ToString() == "More_is_better") --}}
                                                    @if ($displayalldata[$i][$j]['Score_CriteriaV'] == "More_is_better")

                                                        {{-- <td>" + GetGlobalResourceObject("ResourceUserDashboard", "label34").ToString() + "</td> --}}
                                                        <td>{{ __('userdashboard.label34') }}</td>

                                                    @else

                                                        {{-- <td>" + GetGlobalResourceObject("ResourceUserDashboard", "label32").ToString() + "</td> --}}
                                                        <td>{{ __('userdashboard.label32') }}</td>
                                                    @endif
                                                {{-- else if (Convert.ToDouble(dr.Tables[0].Rows[j]["Percentile"]) >= 80 && Convert.ToDouble(dr.Tables[0].Rows[j]["Percentile"]) < 90) --}}
                                                @elseif ($displayalldata[$i][$j]['PercentileV'] >= 80 && $displayalldata[$i][$j]['PercentileV'] < 90)

                                                    {{-- if (dr.Tables[0].Rows[j]["Score_Criteria"].ToString() == "More_is_better") --}}
                                                    @if($displayalldata[$i][$j]['Score_CriteriaV'] == "More_is_better")

                                                        {{-- <td>" + GetGlobalResourceObject("ResourceUserDashboard", "label35").ToString() + "</td> --}}
                                                        <td>{{ __('userdashboard.label35') }}</td>

                                                    @else

                                                        {{-- <td>" + GetGlobalResourceObject("ResourceUserDashboard", "label31").ToString() + "</td> --}}
                                                        <td>{{ __('userdashboard.label31') }}</td>

                                                    @endif

                                                @endif
                                                {{-- if (Convert.ToDouble(dr.Tables[0].Rows[j]["Percentile"]) >= 90) --}}
                                                @if ($displayalldata[$i][$j]['PercentileV'] >= 90)

                                                    {{-- if (dr.Tables[0].Rows[j]["Score_Criteria"].ToString() == "More_is_better") --}}
                                                    @if ($displayalldata[$i][$j]['Score_CriteriaV'] == "More_is_better")

                                                        {{-- <td>" + GetGlobalResourceObject("ResourceUserDashboard", "label36").ToString() + "</ td> --}}
                                                            <td>{{ __('userdashboard.label36') }}</td>

                                                    @else

                                                        {{-- <td>" + GetGlobalResourceObject("ResourceUserDashboard", "label30").ToString() + "</td> --}}
                                                        <td>{{ __('userdashboard.label30') }}</td>

                                                    @endif
                                                @endif

                                            </tr>
                                        @endfor
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endfor
                    @endif

                    {{-- divHistory.InnerHtml = html; --}}

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

{{-- </asp:Content> --}}
@endsection
