@extends('static.layouts.appnet')
@section('title', 'Benchmark | Fitness | KheloIndia')
@section('content')

    <style>
        #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
    <div class="inner-page-header">
        <div class="container back-btn-set">
            <button class="header-back-btn" runat="server" onclick="GoBack()">
                <img src="{{ url('resources/dotnetimages/back_btn_i.png') }}" /></button>
            <h4 id="lblHeading" runat="server">{{ __('resourcemaster.label14') }}</h4>
        </div>


        {{-- <div class="container header-bg-2"> --}}
        <div class="container">
            <div class="row">

                <div class="col-md-12">

                    <div class="table-responsive">

                        <div id="dvBenchMark" runat="server">
                            <table class="" id="customers" style="font-size:14px;">

                                <tbody>
                                </tbody>
                                <thead>
                                    <tr>

                                        <th>{{__('resourcemaster.label50')}}</th>
                                        <th>L1</th>
                                        <th>L2</th>
                                        <th>L3</th>
                                        <th>L4</th>
                                        <th>L5</th>
                                        <th>L6</th>
                                        <th>L7</th>
                                    </tr>
                                </thead>

                                @php
                                    //    $v = __('taketest.label8');
                                    //    echo $v;
                                    
                                    function changeparmeter($value, $unit)
                                    {
                                        if ($unit == 'mm') {
                                            if($value<1000 && $value>=0){
                                            $actualvalue = $value / 10;
                                            
                                            
                                            if(is_int($actualvalue)){
                                                return $actualvalue . '.' . '0';
                                            }else{
                                            return $actualvalue;
                                            }

                                            }
                                            elseif($value>-1000 && $value<0){
                                            $actualvalue = $value / 10;


                                            if(is_int($actualvalue)){
                                                return $actualvalue . '.' . '0';
                                            }else{
                                            return $actualvalue;
                                            }

                                        }
                                    }
                                    
                                        if ($value >= '100000' && ($unit == 'msec')) { 
                                            $actualvalue = $value / 60000;
                                            $decimalindex = strrpos($actualvalue, '.');
                                            $intvalue = substr($actualvalue, 0, $decimalindex);
                                            $decimalvalue = substr($actualvalue, $decimalindex + 1);
                                            $finaldecimalvalue = substr($decimalvalue, 0, 2);
                                            
                                            if (is_int($finaldecimalvalue < 10)) {
                                                return $intvalue . ' ' . __('taketest.label11') . ' ' . $finaldecimalvalue * 10 . ' ' . __('taketest.label66');
                                            } elseif(is_int($actualvalue)) {
                                                return $actualvalue . ' ' . __('taketest.label11') . ' '.'0.0'. ' ' . __('taketest.label66');
                                            }else{
                                                return $intvalue . ' ' . __('taketest.label11') . ' '.$finaldecimalvalue. ' ' . __('taketest.label66'); 
                                            }

                                         







                                        } elseif ($value <= '100000' && ($unit == 'msec')) {
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
                                            if(is_int($actualvalue)){
                    
                                                return $actualvalue .'.0'. ' ' . __('taketest.label66');
                                                     }elseif($actualvalue>1){
                                                       return $actualvalue.' '. __('taketest.label66'); 
                                                        }elseif($actualvalue<1){
                                                         return ($value/10).' '. __('taketest.label66'); 
                                                         }
                                        }
                                    }
                                    
                                @endphp



                                @for ($i = 0; $i < count($benchmark) ; $i++)
                                    <tbody>
                                        <tr>

                                            <td>{{ __('userdashboard' . '.' . $benchmark[$i]->Test_Name) }}</td>
                                            @if ($benchmark[$i]->Score_Unit == 'number')
                                                <td>{{ $benchmark[$i]->L1 }}{{ ' ' }}
                                                    {{ __('userdashboard.label38') }}</td>
                                                <td>{{ $benchmark[$i]->L2 }}{{ ' ' }}
                                                    {{ __('userdashboard.label38') }}</td>
                                                <td>{{ $benchmark[$i]->L3 }}{{ ' ' }}
                                                    {{ __('userdashboard.label38') }}</td>
                                                <td>{{ $benchmark[$i]->L4 }}{{ ' ' }}
                                                    {{ __('userdashboard.label38') }}</td>
                                                 <td>{{ $benchmark[$i]->L5 }}{{ ' ' }}
                                                     {{ __('userdashboard.label38') }}</td>
                                                <td>{{ $benchmark[$i]->L6 }}{{ ' ' }}
                                                    {{ __('userdashboard.label38') }}</td>
                                                <td>{{ $benchmark[$i]->L7 }}{{ ' ' }}
                                                    {{ __('userdashboard.label38') }}</td>
                                            @elseif($benchmark[$i]->Score_Unit == 'mm')

                                                <td>{{ changeparmeter($benchmark[$i]->L1, 'mm') }}{{ ' ' }}{{ __('taketest.label8') }}</td>
                                                <td>{{ changeparmeter($benchmark[$i]->L2, 'mm') }}{{ ' ' }}{{ __('taketest.label8') }}</td>
                                                <td>{{ changeparmeter($benchmark[$i]->L3, 'mm') }}{{ ' ' }}{{ __('taketest.label8') }}</td>
                                                <td>{{ changeparmeter($benchmark[$i]->L4, 'mm') }}{{ ' ' }}{{ __('taketest.label8') }}</td>
                                                <td>{{ changeparmeter($benchmark[$i]->L5, 'mm') }}{{ ' ' }}{{ __('taketest.label8') }}</td>
                                                <td>{{ changeparmeter($benchmark[$i]->L6, 'mm') }}{{ ' ' }}{{ __('taketest.label8') }}</td>
                                                <td>{{ changeparmeter($benchmark[$i]->L7, 'mm') }}{{ ' ' }}{{ __('taketest.label8') }}</td>
                                            @elseif($benchmark[$i]->Score_Unit == 'msec')
                                                <td>{{ changeparmeter($benchmark[$i]->L1, 'msec') }}</td>
                                                <td>{{ changeparmeter($benchmark[$i]->L2, 'msec') }}</td>
                                                <td>{{ changeparmeter($benchmark[$i]->L3, 'msec') }}</td>
                                                <td>{{ changeparmeter($benchmark[$i]->L4, 'msec') }}</td>
                                                <td>{{ changeparmeter($benchmark[$i]->L5, 'msec') }}</td>
                                                <td>{{ changeparmeter($benchmark[$i]->L6, 'msec') }}</td>
                                                <td>{{ changeparmeter($benchmark[$i]->L7, 'msec') }}</td>

                                              
                                           
                                                
                                            @endif

                                        </tr>
                                    </tbody> @endfor
                            </table>

                        </div>
                    </div>

                </div>

            </div>
        </div>

        <input type="button" title="Download" style="display:none" onclick="DownloadPdf()" />
        <script>
            $(document).ready(function() {
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

            

            // function DownloadPdf() {
            //     ExportToPDF($('#ContentPlaceHolder1_dvBenchMark'), [], '', PDFPageType.Portrait);
            // }
        </script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-127986665-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-127986665-1');
        </script>
        <script src="{{ asset('resources/js/Scripts/html2canvas.min.js') }}"></script>


    @endsection
