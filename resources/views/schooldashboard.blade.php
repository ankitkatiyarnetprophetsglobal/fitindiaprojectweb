@extends('layouts.app')
@section('title', 'Fit India Dashboard | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
  {{-- <link rel="stylesheet" href="resources/css/dashboard.css">   --}}
  {{-- <link rel="stylesheet" href="resources/css/bootstrap.min.css">   --}}
  {{-- <link rel="stylesheet" href="resources/css/style.css">   --}}
  <link rel="stylesheet" href="resources/css/style3.css">
  {{-- <link rel="stylesheet" href="resources/css/aos.css">   --}}
  {{-- <link rel="stylesheet" href="resources/css/bootstrap-icons.css">   --}}
  {{-- <link rel="stylesheet" href="resources/css/fontawesome-all.min.css">   --}}
<style>
    .bs-example {
        margin: 20px;
    }
    .rotate {
        -webkit-transform: rotate(-180deg); /* Chrome, Safari, Opera */
        -moz-transform: rotate(-180deg); /* Firefox */
        -ms-transform: rotate(-180deg); /* IE 9 */
        transform: rotate(-180deg); /* Standard syntax */
    }
 .fit-india-dashboard .boxcolor .box-6{
  background-color: #7c4293 !important;
 }
 .fit-india-dashboard .boxwomencolor .box-6{
  background-color: #e58394 !important;
 }
</style>

  <body>
    {{-- <header id="header">
      <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
          <button  class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="fa fa-bars"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ms-auto">
              <li>
                <a href="overview.html"><i class="fas fa-eye"></i> Scheme Overview</a>
              </li>
              <li>
                <a href="#"><i class="fas fa-th-large"></i> Vertical Wise Dashboard</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <div></div> --}}

    <div class="state-level-detail-athlete state-wise-count py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-1 col-md-2 col-3">
            <button type="button" class="background-light border-0" style="background-color: transparent !important">
              <img src="images/svg/backward-arrow.svg" class="img-fluid backward-arrow d-block mx-auto" alt="" />
            </button>
          </div>
          <div class="col-lg-11 col-md-10 col-9">
            <h2 class="text-center mb-0">Events at a Glance</h2>
          </div>
        </div>


        <div class="fit-india-dashboard">
          {{-- <div class="row justify-content-center mb-5"> --}}
            {{-- <div class="col-md-6 col-12">
              <div class="top-tile mt-3">
                <h3>118972968</h4>
                <h6>SITE VISITORS</h6>
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="top-tile mt-3">
                <h3>1016541</h4>
                <h6>TOTAL SCHOOLS REGISTERED</h6>
              </div>
            </div> --}}
          {{-- </div> --}}
          <div class="row justify-content-center tile-detail-section">
            <div class="col-lg-4 col-md-6 col-12 boxcolor">
              <div class="tile-detail-box box-5 fit-india-dashboard box-6" >
                <div class="tile-detail-img">
                  <img style="width:66%" src="{{ asset('resources/images/dashbord/fit-india-img-6.svg') }}" class="img-fluid "/>
                </div>
                <h3>{{$tiles[0]->title??''}}</h3>
                <p>{{$tiles[0]->description??''}}</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
              <div class="tile-detail-box box-1">
                <div class="tile-detail-img">
                  <img src="{{ asset('resources/images/dashbord/fit-india-img-1.svg') }}" class="img-fluid "/>
                  {{-- <img src="" class="img-fluid" alt="" /> --}}
                </div>
               <h3>{{$tiles[1]->title??''}}</h3>
                <p>{{$tiles[1]->description??''}}</p>
              </div>
            </div>
                <div class="col-lg-4 col-md-6 col-12">
              <div class="tile-detail-box box-4">
                <div class="tile-detail-img">
                  <img src="{{ asset('resources/images/dashbord/fit-india-img-4.svg') }}" class="img-fluid "/>
                </div>
                <h3>{{$tiles[4]->title??''}}</h3>
                <p>{{$tiles[4]->description??''}}</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
              <div class="tile-detail-box box-2">
                <div class="tile-detail-img">
                  <img src="{{ asset('resources/images/dashbord/fit-india-img-2.svg') }}" class="img-fluid "/>
                </div>
                <h3>{{$tiles[2]->title??''}}</h3>
                <p>{{$tiles[2]->description??''}}</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
              <div class="tile-detail-box box-3">
                <div class="tile-detail-img">
                  <img src="{{ asset('resources/images/dashbord/fit-india-img-3.svg') }}" class="img-fluid "/>
                </div>
                 <h3>{{$tiles[3]->title??''}}</h3>
                <p>{{$tiles[3]->description??''}}</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
              <div class="tile-detail-box box-5">
                <div class="tile-detail-img">
                  <img src="{{ asset('resources/images/dashbord/fit-india-img-5.svg') }}" class="img-fluid "/>
                </div>
                 <h3>{{$tiles[5]->title??''}}</h3>
                <p>{{$tiles[5]->description??''}}</p>
              </div>
            </div>

              <div class="col-lg-4 col-md-6 col-12 boxwomencolor">
              <div class="tile-detail-box box-6">
                <div class="tile-detail-img">
                  <img src="{{ asset('resources/images/dashbord/women.svg') }}" class="img-fluid1 "/>
                </div>
                 <h3>{{$tiles[6]->title??''}}</h3>
                <p>{{$tiles[6]->description??''}}</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
              <div class="tile-detail-box box-7">
                <div class="tile-detail-img">
                  <img src="{{ asset('resources/images/dashbord/yoga.svg') }}" class="img-fluid1 "/>
                </div>
                 <h3>{{$tiles[7]->title??''}}</h3>
                <p>{{$tiles[7]->description??''}}</p>
              </div>
            </div>

          </div>

          <!-- Leading States For School Certificate Requests -->
          <div class="row mt-5">
          {{-- <div class="col-12">
            <h3 class="text-center mb-5">Leading States For School Certificate Requests</h3>
          </div> --}}
          <div class="col-12">
            <div class="leading-state">
                <div class="table-responsive">
                 <table class="table table-bordered">
                   <thead>
                     <tr>
                       <th >STATE</th>
                       <th >FLAG</th>
                       <th >3 STAR</th>
                       <th >5 STAR</th>
                       <th></th>
                     </tr>
                   </thead>
                   <tbody>
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
                                       <td>
                                           <div class="green">
                                               {{ $data['flag'] }}
                                           </div>
                                       </td>
                                       <td>
                                           <div class="blue">
                                               {{ $data['threestar'] }}
                                           </div>
                                       </td>
                                       <td>
                                           <div class="orange">
                                               {{ $data['fivestar'] }}
                                           </div>
                                       </td>
                                       <td>
                                           <div  class="progress" style="width:{{$mainwidth}}%">
                                               <div class="progress-bar green" role="progressbar" style="width: {{$flag_width}}%"></div>
                                               <div class="progress-bar blue" role="progressbar" style="width: {{$threestar_width}}%"> </div>
                                               <div class="progress-bar orange" role="progressbar" style="width: {{$fivestar_width}}%"> </div>
                                           </div>
                                       </td>
                               </tr>

                       @endforeach
                   </tbody>
                 </table>
                </div>
               </div>
          </div>
          </div>

          <!-- List of Events -->
          {{-- <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>EVENT NAME</th>
                    <th>EVENT DATE</th>
                    <th>NO OF EVENTS</th>
                    <th>INDIVIDUAL REGISTRATION</th>
                    <th>ORGANISATIONS REGISTRATION</th>
                    <th>TOTAL PARTICIPATION</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>FIT India Plogrun</td>
                <td>02nd Oct</td>
                <td>43,256</td>
                <td>-</td>
                <td>-</td>
                <td>43,256</td>
                </tr>
                <tr>
                  <td>FIT India Plogrun</td>
                <td>02nd Oct</td>
                <td>43,256</td>
                <td>-</td>
                <td>-</td>
                <td>43,256</td>
                </tr>
                <tr>
                  <td>FIT India Plogrun</td>
                <td>02nd Oct</td>
                <td>43,256</td>
                <td>-</td>
                <td>-</td>
                <td>43,256</td>
                </tr>
                <tr>
                  <td>FIT India Plogrun</td>
                <td>02nd Oct</td>
                <td>43,256</td>
                <td>-</td>
                <td>-</td>
                <td>43,256</td>
                </tr>
                <tr>
                  <td>FIT India Plogrun</td>
                <td>02nd Oct</td>
                <td>43,256</td>
                <td>-</td>
                <td>-</td>
                <td>43,256</td>
                </tr>
                <tr>
                  <td>FIT India Plogrun</td>
                <td>02nd Oct</td>
                <td>43,256</td>
                <td>-</td>
                <td>-</td>
                <td>43,256</td>
                </tr>

              </tbody>
            </table>
          </div> --}}
          <div class="row mt-5">
            <div class="col-12">
                <h3 class="text-center mb-5">List of Events</h3>
            </div>
           <div class="col-12">


                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              2024-25
                            </a>
                            </h4>
                        </div>
                          <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
                              <div class="panel-body">
                                  <div class="table-responsive">
                                    <table class="table table-bordered">
                                      <thead>
                                          <tr>
                                              <th>EVENT NAME</th>
                                              <th>EVENT DATE</th>
                                              <th>NO OF EVENTS</th>
                                              <th>SOCIAL MEDIA OUTREACH</th>
                                              <th>TOTAL PARTICIPATION</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                            <td>Fit India Sundays on Cycle</td>
                                            <td>Ongoing</td>
                                            <td><center>29,356</center></td>
                                            <td><center>3.04 Bn</center></td>
                                            <td><center>6.54 Lakhs</center></td>
                                          </tr>
                                          <tr>
                                            <td>National Sports Day 2024</td>
                                            <td>26th August to 31st August 2024</td>
                                            <td><center>8627</center></td>
                                            <td><center>---</center></td>
                                            <td><center>25 Lakhs</center></td>
                                          </tr>

                                          <tr>
                                          <td>Fit India Freedom Run 5.0</td>
                                          <td>2nd October to 31st october 2024</td>
                                          <td><center>10,433</center></td>
                                          <td> <center>--- </center></td>
                                          <td><center>4+ Crore</center></td>
                                          </tr>

                                          <tr>
                                            <td>Fit India Mobile Application</td>
                                            <td>Ongoing</td>
                                            <td> <center>---</center> </td>
                                            <td> <center>---</center> </td>
                                            <td><center>11.5+ Lakhs</center></td>
                                          </tr>
                                          {{-- <tr>
                                            <td>Fit India Week 2023</td>
                                            <td>15th November 2023 to 31st January 2024</td>
                                            <td>--</td>
                                            <td>--</td>
                                            <td>4.16 lakh plus schools & 1028 universities</td>
                                          </tr>                                           --}}
                                      </tbody>
                                    </table>
                                  </div>
                              </div>
                          </div>
                    </div>


                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingsix">
                            <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="true" aria-controls="collapsesix">
                              2023-24
                            </a>
                            </h4>
                        </div>
                    <div id="collapsesix" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingfive">
                        <div class="panel-body">
                            <div class="table-responsive">
                              <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>EVENT NAME</th>
                                        <th>EVENT DATE</th>
                                        <th>NO OF EVENTS</th>
                                        <th>SOCIAL MEDIA OUTREACH</th>
                                        <th>TOTAL PARTICIPATION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>National Sports Day 2023</td>
                                    <td>21st August to 29th August 2023 </td>
                                    <td><center>14294</center></td>
                                    <td><center>32000</center></td>
                                    <td><center>15.98 Lakhs</center></td>
                                  </tr>

                                  <tr>
                                  <td>Fit India Freedom Run</td>
                                  <td>1st to 31st October, 2023 </td>
                                  <td> <center>---</center> </td>
                                  <td> <center>---</center> </td>
                                  <td><center>4.5 Crore</center></td>
                                  </tr>

                                  <tr>
                                    <td>Fit India Quiz 2023</td>
                                    <td>Ongoing</td>
                                    <td> <center>---</center> </td>
                                    <td> <center>---</center> </td>
                                    <td><center>41,789  Schools</center></td>
                                  </tr>
                                  <tr>
                                    <td>Fit India Week 2023</td>
                                    <td>15th November 2023 to 31st January 2024</td>
                                    <td><center>---</center></td>
                                    <td><center>---</center></td>
                                    <td>4.16 lakh plus schools & 1028 universities</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingfive">
                            <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="true" aria-controls="collapsefive">
                                2022-23
                            </a>
                            </h4>
                        </div>
                    <div id="collapsefive" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingfive">
                        <div class="panel-body">
                            <div class="table-responsive">
                              <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>EVENT NAME</th>
                                        <th>EVENT DATE</th>
                                        <th>NO OF EVENTS</th>
                                        <th>SOCIAL MEDIA OUTREACH</th>
                                        <th>TOTAL PARTICIPATION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                      <td>Fit India Freedom Run</td>
                                      <td>02nd October to 31st October 2022</td>
                                      <td> --- </td>
                                      <td> --- </td>
                                      <td><center>7.08 crores</center></td>
                                    </tr>

                                    <tr>
                                    <td>Fit India Plog Run 2022</td>
                                    <td>02nd October</td>
                                    <td> <center>343</center> </td>
                                    <td> <center>4.3 crores</center> </td>
                                    <td><center>27,000</center></td>
                                    </tr>

                                    <tr>
                                      <td>Fit India Mobile Application</td>
                                      <td>Ongoing</td>
                                      <td> <center>---</center> </td>
                                      <td> <center>---</center> </td>
                                      <td><center>8 lakhs</center></td>
                                    </tr>
                                    <tr>
                                      <td>Fit India Quiz 2022</td>
                                      <td>3rd September 2022- 30th July 2023</td>
                                      <td><center>---</center></td>
                                      <td><center>---</center></td>
                                      <td><center>61981 Schools</center></td>
                                    </tr>
                                    <tr>
                                      <td>Fit India School Week 2022</td>
                                      <td>15th November to 31st January 2023</td>
                                      <td><center>---</center></td>
                                      <td><center>---</center></td>
                                      <td><center>5.7 lakhs Schools</center></td>
                                    </tr>
                                    {{-- <tr>
                                      <td>Fit India School Week 2022</td>
                                      <td>15th November to 31st January 2023</td>
                                      <td>--</td>
                                      <td>--</td>
                                      <td>5.58 lakhs</td>
                                    </tr> --}}
                                </tbody>
                              </table>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingFour">
                            <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="true" aria-controls="collapsefour">
                                2021-22
                            </a>
                            </h4>
                        </div>
                    <div id="collapsefour" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFour">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>EVENT NAME</th>
                                        <th>EVENT DATE</th>
                                        <th>NO OF EVENTS</th>
                                        <th>SOCIAL MEDIA OUTREACH</th>
                                        <th>TOTAL PARTICIPATION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                      <td>Road to Tokyo ‘Olympics Quiz’</td>
                                      <td>23 June – 23 July 22</td>
                                      <td> <center>---</center> </td>
                                      <td> <center>10,000</center> </td>
                                      <td><center>9 lakhs</center></td>
                                    </tr>

                                    <tr>
                                      <td>Fit India Quiz 2021</td>
                                      <td>21st November to February 2022</td>
                                      <td> <center>---</center> </td>
                                      <td> <center>---</center> </td>
                                      <td><center>36,000</center></td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          2020-21
                        </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <div class="table-responsive">

                              <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>EVENT NAME</th>
                                        <th>EVENT DATE</th>
                                        <th>NO OF EVENTS</th>
                                        <th>SOCIAL MEDIA OUTREACH</th>
                                        <th>TOTAL PARTICIPATION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                      <td>Fit India Active Day series</td>
                                      <td>April & May  2020</td>
                                      <td><center>---</center></td>
                                      <td><center>18 lakhs</center></td>
                                      <td><center>---</center></td>
                                    </tr>
                                    <tr>
                                    <td>Fit India Dance Week</td>
                                      <td>1st week of June 2020</td>
                                      <td><center>---</center></td>
                                      <td><center>51,000</center></td>
                                      <td><center>---</center></td>
                                    </tr>
                                    <tr>
                                      <td>Indigenous Sports of India</td>
                                      <td>8th to 19th  June 2020</td>
                                      <td><center>---</center></td>
                                      <td><center>10 lakhs</center></td>
                                      <td><center>---</center></td>
                                    </tr>
                                    <tr>
                                    <td>FIT India Yoga Day</td>
                                    <td>21st June 2020</td>
                                    <td><center>---</center></td>
                                    <td><center>15 lakhs</center></td>
                                    <td><center>---</center></td>
                                    </tr>
                                    <tr>
                                      <td>Fit India Talks</td>
                                      <td>Wednesday, July 01, 2020</td>
                                      <td><center>---</center></td>
                                      <td><center>3.5 lakhs</center></td>
                                      <td><center>---</center></td>
                                    </tr>
                                    <tr>
                                        <td>Fit India Freedom Run</td>
                                        <td>15th August to 2nd October 2020</td>
                                        <td><center>3.5 lakhs</center></td>
                                        <td><center>36 crore</center></td>
                                        <td><center>6.5 crore</center></td>
                                    </tr>

                                    <tr>
                                        <td>Fit India Youth Club Certification</td>
                                        <td>14th August 2020</td>
                                        <td><center>---</center></td>
                                        <td><center>---</center></td>
                                        <td><center>48,000</center></td>
                                    </tr>
                                    <tr>
                                        <td>Fit India Dialogue</td>
                                        <td>24th September 2019</td>
                                        <td><center>---</center></td>
                                        <td><center>---</center></td>
                                        <td><center>98</center></td>
                                    </tr>
                                    <tr>
                                        <td>Fit India Walkathon 200 km</td>
                                        <td>31st-2nd November</td>
                                        <td><center>---</center></td>
                                        <td><center>---</center></td>
                                        <td><center>98</center></td>
                                    </tr>
                                    <tr>
                                        <td>Fit India Dialgoue part 2</td>
                                        <td>Tuesday, December 01, 2020</td>
                                        <td><center>---</center></td>
                                        <td><center>9 lakhs</center></td>
                                        <td><center>---</center></td>
                                    </tr>
                                    <tr>
                                        <td>Fit India Prabhat Pheri</td>
                                        <td>1st week of December 2020</td>
                                        <td><center>---</center></td>
                                        <td><center>---</center></td>
                                        <td><center>14.12 lakhs</center></td>
                                    </tr>
                                    <tr>
                                        <td>Fit India Cycothon</td>
                                        <td>December 2020 – 31st January 2021</td>
                                        <td><center>---</center></td>
                                        <td><center>---</center></td>
                                        <td><center>1.2 crore</center></td>
                                    </tr>
                                    <tr>
                                        <td>Fit India School Week 2020</td>
                                        <td>15th November 2020 to 31st January 2021</td>
                                        <td><center>---</center></td>
                                        <td><center>---</center></td>
                                        <td><center>4.3 lakhs</center></td>
                                    </tr>
                                    <tr>
                                        <td>Indigenous Sports-4 Episodes</td>
                                        <td>28-31 December 2021</td>
                                        <td><center>---</center></td>
                                        <td><center>65,000</center></td>
                                        <td><center>---</center></td>
                                    </tr>
                                    <tr>
                                        <td>School Week Virtual Event</td>
                                        <td>Wednesday, January 27, 2021</td>
                                        <td><center>---</center></td>
                                        <td><center>65,000</center></td>
                                        <td><center>---</center></td>
                                    </tr>
                                    <tr>
                                        <td>Desh ki Mitti, Desh k Khel</td>
                                        <td>Friday, January 29, 2021</td>
                                        <td><center>---</center></td>
                                        <td><center>80,000</center></td>
                                        <td><center>---</center></td>
                                    </tr>
                                    <tr>
                                        <td>Walkathon</td>
                                        <td>Monday, March 08, 2021</td>
                                        <td><center>---</center></td>
                                        <td><center>---</center></td>
                                        <td><center>500</center></td>
                                    </tr>
                                    <tr>
                                        <td>Launch of PE & Community Coaching Programme</td>
                                        <td>Monday, March 08, 2021</td>
                                        <td><center>---</center></td>
                                        <td><center>10,000</center></td>
                                        <td><center>---</center></td>
                                    </tr>
                                    <tr>
                                        <td>Fit Women, Fit Families, Fit India</td>
                                        <td>Wednesday, March 10, 2021</td>
                                        <td><center>---</center></td>
                                        <td><center>10,000</center></td>
                                        <td><center>---</center></td>
                                    </tr>

                                </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          2019-20
                        </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                            <div class="table-responsive">

                              <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>EVENT NAME</th>
                                        <th>EVENT DATE</th>
                                        <th>NO OF EVENTS</th>
                                        <th>SOCIAL MEDIA OUTREACH</th>
                                        <th>TOTAL PARTICIPATION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td>Fit India Website</td>
                                    <td>29th August 2019</td>
                                    <td><center>---</center></td>
                                    <td><center>---</center></td>
                                    <td><center>11 crore</center></td>
                                  </tr>
                                  <tr>
                                    <td>Fit India Plog Run</td>
                                    <td>2nd October 2019</td>
                                    <td><center>55,000</center></td>
                                    <td><center>---</center></td>
                                    <td><center>30 lakhs</center></td>
                                    </tr>
                                    <tr>
                                    <td>Fit India School Week</td>
                                    <td>Friday, November 01, 2019</td>
                                    <td><center>---</center></td>
                                    <td><center>---</center></td>
                                    <td><center>15,000</center></td>
                                    </tr>
                                    <tr>
                                    <td>Fit India School Certification</td>
                                    <td>Sunday, December 01, 2019</td>
                                    <td><center>---</center></td>
                                    <td><center>---</center></td>
                                    <td><center>4.5 lakhs</center></td>
                                    </tr>
                                    <tr>
                                    <td>Fit India Cyclothon</td>
                                    <td>18th January 2020</td>
                                    <td><center>15,706</center></td>
                                    <td><center>0</center></td>
                                    <td><center>35 lakhs</center></td>
                                    </tr>
                                    <tr>
                                    <td>Fit India March for Women</td>
                                    <td>Sunday, March 01, 2020</td>
                                    <td><center>---</center></td>
                                    <td><center>---</center></td>
                                    <td><center>---</center></td>
                                    </tr>

                                </tbody>
                                </table>

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
        </div>
      </div>
    </div>

    {{-- <footer class="footer">
      <div class="container">
        <h3>Contact for Further Enquiries</h3>
        <p>
          For further information please visit the Ministry’s website,
          https://kheloindia.gov.in/ or contact Member Secretary
        </p>
        <h4>SHRI VIJAY KUMAR - DIRECTOR SPORTS</h4>
        <p class="email-phone">
          <i class="fa fa-envelope-o" aria-hidden="true"></i> Email Id:
          ponsdf@gmail.com
        </p>
        <p class="email-phone">
          <i class="fa fa-phone" aria-hidden="true"></i> Phone Number: 011 2338
          3336
        </p>
        <div class="social_icon">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-whatsapp"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
    </footer> --}}
    {{-- <script src="js/jquery.min.js"></script> --}}
    {{-- <script src="{{ asset('resources/js/jquery.min.js')}}"></script> --}}

    {{-- <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://rawgit.com/highcharts/rounded-corners/master/rounded-corners.js"></script> --}}
    {{-- <script src="js/bootstrap.bundle.min.js"></script> --}}

    {{-- <script src="{{ asset('resources/js/jquery.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('resources/js/highcharts.js')}}"></script> --}}
    {{-- <script src="{{ asset('resources/js/exporting.js')}}"></script> --}}
    {{-- <script src="{{ asset('resources/js/export-data.js')}}"></script> --}}
    {{-- <script src="{{ asset('resources/js/accessibility.js')}}"></script> --}}
    {{-- <script src="{{ asset('resources/js/rounded-corners.js')}}"></script> --}}
    {{-- <script src="{{ asset('resources/js/bootstrap.bundle.min.js')}}"></script>     --}}
    {{-- <script src="{{ asset('resources/js/custom.js')}}"></script>     --}}
    {{-- <script src="{{ asset('resources/js/owl.carousel.js')}}"></script>     --}}
    {{-- <script src="{{ asset('resources/js/aos.js')}}"></script>     --}}
    {{-- <script src="{{ asset('resources/js/jquery.fancybox.pack.js')}}"></script>     --}}

    {{-- <script src="http://127.0.0.1:8001/fit_india_web/resources/js/jquery.min.js"></script> --}}
    {{-- <script src="http://127.0.0.1:8001/fit_india_web/resources/js/highcharts.js"></script>
    <script src="http://127.0.0.1:8001/fit_india_web/resources/js/exporting.js"></script>
    <script src="http://127.0.0.1:8001/fit_india_web/resources/js/export-data.js"></script>
    <script src="http://127.0.0.1:8001/fit_india_web/resources/js/accessibility.js"></script>
    <script src="http://127.0.0.1:8001/fit_india_web/resources/js/rounded-corners.js"></script>
    <script src="http://127.0.0.1:8001/fit_india_web/resources/js/bootstrap.bundle.min.js"></script>
    <script src="http://127.0.0.1:8001/fit_india_web/resources/js/custom1.js"></script>
    <script src="http://127.0.0.1:8001/fit_india_web/resources/js/owl.carousel.js"></script>
    <script src="http://127.0.0.1:8001/fit_india_web/resources/js/aos.js"></script>
    <script src="http://127.0.0.1:8001/fit_india_web/resources/js/jquery.fancybox.pack.js"></script>     --}}
</body>
<script>
    $(document).ready(function() {
  // Add minus icon for collapse element which is open by default
        $(".collapse.in").each(function() {
            $(this)
            .siblings(".panel-heading")
            .find(".glyphicon")
            .addClass("rotate");
        });

        // Toggle plus minus icon on show hide of collapse element
        $(".collapse")
            .on("show.bs.collapse", function() {
            $(this)
                .parent()
                .find(".glyphicon")
                .addClass("rotate");
            })
            .on("hide.bs.collapse", function() {
            $(this)
                .parent()
                .find(".glyphicon")
                .removeClass("rotate");
            });
        });

</script>
@endsection
