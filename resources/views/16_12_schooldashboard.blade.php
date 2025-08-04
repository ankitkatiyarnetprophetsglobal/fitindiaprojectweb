@extends('layouts.app')
@section('title', 'Fit India Dashboard | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
  <link rel="stylesheet" href="resources/css/dashboard.css">  
<style>
    .year {
        text-align: center;
        /* background: #656565 !important; */
        background: #fff !important;
        font-size: 16px;
        font-weight: 600;
        color: #343a40;
    }

    .news-item1 table,
    th,
    td {
        border: 1px solid #e7eaec;

    }





    /* .year span {
        background: #ffc107;
      
        
    } */

    .tbhover:hover {
        background-color: #f5f5f5 !important;
    }

    tr:nth-child(even) {
        background-color: #fff !important;
    }

    tr:nth-child(odd) {
        background-color: #fff !important;
    }


    .td_first-child {
        text-align: left;
        padding-left: 25px !important;
    }

    .removeborder {
        background: #ffc107;
        border: 0px solid #e7eaec;
    }

    .removeborder_2 {
        border: 0px solid #e7eaec;
    }


    @media (max-width: 767px) {
        .news-item1 {
            overflow-x: scroll;
        }

        .td_first-child {
            text-align: left;
            padding-left: 10px !important;
        }

    }
</style>
<div class="container container-md container-sm">
    <section class="sec_area" id="{{ $active_section_id }}">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center heading">Fit India Dashboard</h1>				
				<?php //print_r($siteopts); ?>
            </div>
        </div>
        <div  class="d-flex flex-lg-row flex_col_cust"> 
            <div class="bg_dash_left ">
                <div>
                <img src="resources/imgs/fit_india_logo-w.png" class="fluid-img" alt="fit India" title="fit India"/>
                </div>
                <div>
                <p>Status as on </p>
                <p>@if(!empty($siteopts[5]['key']) and $siteopts[5]['key'] == 'flagupdateOn'){{ date('d F Y',strtotime($siteopts[5]['value'])) }} @endif </p>
                </div> 
            </div>
			
            <div class=" bg_dash_right"> 
            <div class="d-flex">
                <div class="dash_reco">
				@php 
				if(!empty($siteopts[0]['key']) && $siteopts[0]['key'] == 'visitors'){
					$visitorval = (int)$siteopts[0]['value'];
					$visitorval = $visitorval + 1;
				}
				@endphp
                    <h2>{{ (int)$visitorval }} </h2>
                    <p>Site Visitors</p>
                </div>
                <div class="dash_reco">
                    <h2>@if(!empty($siteopts[1]['key']) and $siteopts[1]['key'] == 'totalschools'){{ $siteopts[1]['value'] }} @endif</h2>
                    <p>Total Schools registered</p>
                </div>
            </div>
            <h3>Fit India School Certification</h3>
            <div class="d-flex flex-md-wrap">
            <div class="dash_col">
                <h4>@if(!empty($siteopts[2]['key']) and $siteopts[2]['key'] == 'flag_boards'){{ $siteopts[2]['value'] }}@endif</h4>
                <p>Boards</p>
            </div>
            <div class="dash_col  ">
                <h4>@if(!empty($siteopts[3]['key']) and $siteopts[3]['key'] == 'flag_states'){{ $siteopts[3]['value'] }}@endif</h4>
                <p>States/UTs</p>
            </div>
            <div class="dash_col">
                <h4>@if(!empty($siteopts[4]['key']) and $siteopts[4]['key'] == 'schools_flagreq'){{ $siteopts[4]['value'] }}@endif</h4>
                <p>Fit India School Flag</p>
            </div>
            <div class="dash_col">                          
                <p>School Certification by Request</p>
            <div>
                <ul>
                    <li>Fit India School Flag</li>
                    <li>
                        <div class="progress">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></span>
                    </div>
                    </li>
                    <li>@if(!empty($siteopts[6]['key']) and $siteopts[6]['key'] == 'flag'){{ $siteopts[6]['value'] }}@endif</li>
                </ul>
                <ul>
                <li>Fit India 3 Star</li>
                <li>
                    <div class="progress">
                         <div class="progress-bar bg-info" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></span>
                    </div>
               </li>
                <li>@if(!empty($siteopts[7]['key']) and $siteopts[7]['key'] == 'threestar'){{ $siteopts[7]['value'] }}@endif</li>
                </ul>
                <ul>
                <li>Fit India 5 Star</li>
                <li>
                    <div class="progress">
                <div class="progress-bar bg-info" role="progressbar" style="width: 15%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></span>
                </div>
                </li>
                <li>@if(!empty($siteopts[8]['key']) and $siteopts[8]['key'] == 'fivestar') {{ $siteopts[8]['value'] }}@endif</li>
                </ul>
            </div>
            </div>
            </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row">		 
            <div class="col-12">
                <h5 class="leadh5">Leading States For School Certificate Requests</h5>
                <table class="table table-striped bar_row">
                    <tbody>
                      <tr>                        
                        <td>State</td>
                        <td>Flag</td>
                        <td>3 Star</td>
                        <td>5 Star</td>
                        <td ></td>
                      </tr>
					  
						@php
							$flgcount = 0; $tscount = 0; $fscount = 0;  $i=0;
						@endphp
						
						@foreach($schooldata as $data)
							@php
								$tot = $data['flag'] + $data['threestar'] + $data['fivestar'];
								$flgcount += $data['flag']; $tscount += $data['threestar']; $fscount += $data['fivestar'];
								if(!$i){ $finflag = $tot; $i++; }
								
								
								$mainwidth = ($tot / $finflag) * 100;
								$flag_width = ($data['flag'] / $tot) * 100;
								$threestar_width = ($data['threestar'] / $tot) * 100;
								$fivestar_width = ($data['fivestar'] / $tot) * 100;
							@endphp
							<tr>                        
								<td>{{ $data['state'] }}</td>
								<td class="g_c">{{ $data['flag'] }}</td>
								<td class="b_c">{{ $data['threestar'] }}</td>
								<td class="p_c">{{ $data['fivestar'] }}</td>
								<td >
									<div class="progress progress_cust d-flex" style="width:{{$mainwidth}}%">
										<div class="progress-bar g_c" style="width: {{$flag_width}}%"></div>
										<div class="progress-bar b_c" style="width: {{$threestar_width}}%"> </div>
										<div class="progress-bar p_c" style="width: {{$fivestar_width}}%"> </div>
									</div>
								</td>
							</tr>
						
						@endforeach
			
			
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section style="margin-top: -70px;"> 
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h2 class="text-center table-primary p-4"><strong>List of Events</strong></h2>
                <div class=" news-item1">
                    <table class="table table-striped">

                        <thead class="thead-dark">
                            <tr>
                                <th>Event Name</th>
                                <th>Event Date</th>
                                <th>No of Events</th>
                                <th>Individual Registration</th>
                                <th>Organisations Registration</th>
                                <th>Total Participation</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="year">
                                <td></td>
                                <td class="removeborder"><span>Year 2019</span></td>
                                <td class="removeborder_2"></td>
                                <td class="removeborder_2"></td>
                                <td class="removeborder_2"></td>
                                <td class="removeborder_2"></td>
                            </tr>

                            <tr class="tbhover">
                                <td class="td_first-child">Fit India Plogrun</td>
                                <td>02<sub>nd</sub>&nbsp;Oct</td>
                                <td>43,256</td>
                                <td>----</td>
                                <td>----</td>
                                <td>30 lakh</td>

                            </tr>

                            <tr class="tbhover">
                                <td class="td_first-child">Fit India School Week</td>
                                <td>Nov to Dec </td>
                                <td>14,000</td>
                                <td>----</td>
                                <td>----</td>
                                <td>----</td>
                            </tr>
                            <tr class="year">
                                <td></td>
                                <td class="removeborder"><span>Year 2020</span></td>
                                <td class="removeborder_2"></td>
                                <td class="removeborder_2"></td>
                                <td class="removeborder_2"></td>
                                <td class="removeborder_2"></td>
                            </tr>

                            <tr class="tbhover">
                                <td class="td_first-child">Fit India Cyclothon</td>
                                <td>18<sub>th</sub>&nbsp;Jan</td>
                                <td>15,706</td>
                                <td>----</td>
                                <td>----</td>
                                <td>35 lakh</td>


                            </tr>

                            <tr class="tbhover">
                                <td class="td_first-child">Fit India Freedom Run</td>
                                <td>Aug to Oct</td>
                                <td>3.01 Lakh </td>
                                <td>1.96 Lakh</td>
                                <td> 1.04 Lakh</td>
                                <td>5 Cr</td>



                            </tr>

                            <tr class="tbhover">
                                <td class="td_first-child">Fit India Prabhatpheri</td>
                                <td>Dec</td>
                                <td>56,554</td>
                                <td>----</td>
                                <td>----</td>
                                <td>14 lakh</td>

                            </tr>
                            <tr class="tbhover">
                                <td class="td_first-child">Fit India Cyclothon</td>
                                <td>Dec - Jan </td>
                                <td>24,160</td>
                                <td>----</td>
                                <td>----</td>
                                <td>1.20 Cr</td>

                            </tr>

                            <tr class="tbhover">
                                <td class="td_first-child">Fit India School Week</td>
                                <td>Dec - Jan </td>
                                <td>4.3 lakh</td>
                                <td>----</td>
                                <td>----</td>
                                <td>----</td>
                            </tr>

                            <tr class="year">
                                <td></td>
                                <td class="removeborder"><span>Year 2021</span></td>
                                <td class="removeborder_2"></td>
                                <td class="removeborder_2"></td>
                                <td class="removeborder_2"></td>
                                <td class="removeborder_2"></td>
                            </tr>


                            <tr class="tbhover">
                                <td class="td_first-child">Fit India App Launch </td>
                                <td>29<sub>th</sub>&nbsp;Aug </td>
                                <td>----</td>
                                <td>----</td>
                                <td>----</td>
                                <td>----</td>
                            </tr>
                            <tr class="tbhover">
                                <td class="td_first-child">Fit India Freedom Run 2.0 </td>
                                <td>Aug to Oct </td>
                                <td>3.9 Lakh</td>
                                <td>2.9 Lakh</td>
                                <td>1 Lakh</td>
                                <td>9 Cr+</td>
                            </tr>

                            <tr class="tbhover">
                                <td class="td_first-child">Fit India Quiz Launch </td>
                                <td>2<sub>nd</sub>&nbsp;Sep </td>
                                <td>----</td>
                                <td>----</td>
                                <td>----</td>
                                <td>----</td>
                            </tr>

                            <tr class="tbhover">
                                <td class="td_first-child">Fit India Plog Run </td>
                                <td>31<sub>st</sub>&nbsp;Oct </td>
                                <td>----</td>
                                <td>----</td>
                                <td>----</td>
                                <td>----</td>
                            </tr>



                        </tbody>

                    </table>
                </div>
            </div>
        </div>        
    </section> 

</div>
@endsection