@extends('layouts.app')
@section('title', 'NATIONAL SPORTS DAY 2022| Fit India')
@section('content')
@php
$active_section = request()->segment(count(request()->segments()));
$active_section_id = trim($active_section);
@endphp
<style>
  .table-bordered_cut td,
  .table-bordered_cut th {
    border: 1px solid #757575 !important;
  }
</style>
<div class="banner_area1">
  <img src="{{ asset('resources/imgs/home/sportsday-banner.jpg') }}" alt="school-week" title="school-week" class="img-fluid expand_img" />
  <section id="{{ $active_section_id }}">
    <div class="container">
      <div class="row">
        <a class="freedombtn1" href="register/">Register</a>
        <a class="freedombtn3" href="{{ url('resources/pdf/school-week-how-to-register.pdf') }}" target="_blank">How To Register</a>
        <a class="freedombtn4" href="javascript:void(0)" data-toggle="modal" data-target="#merchandisId">Download Merchandise</a> 
      </div>
      <div class="row">
        <div class="col-sm-12">
          <h1 class="headingh1">NATIONAL SPORTS DAY</h1>          
		  <p>India celebrates National Sports Day on 29th August to commemorate the birth anniversary of hockey legend, Major Dhyan Chand. The day is also dedicated to the nations’ sports heroes and champions, honoring their contribution and dedication towards bringing laurels to the country.  With the aim to raise awareness about the values of sports: discipline, perseverance, sportsman spirit, teamwork, and to encourage public in large to take up sports and make it an integral part of their lives while emphasizing on the importance of being fit and healthy. </p>
        <br/>
		</div>
      </div>

      <div class="row">
        <div class="col-md-12">

          <div class="accordion" id="accordionFISW">
            <div class="card">
              <div class="card-head" id="headingOne">
                <h2 class="mb-0" data-toggle="collapse" data-target="#collapseFISW1" aria-expanded="true" aria-controls="collapseOne">
                  How to participate
                </h2>
				
              </div>

              <div id="collapseFISW1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionFISW">
                <div class="card-body" style="padding-top:10px;">
                
                  
                  <p><strong style=" font-size:16px;">What can we do to pay tribute to the biggest sporting icon of Indian History</strong></br></br>
				  This year the ‘Ministry of Youth Affairs & Sports’ (MYAS) and ‘Fit India Mission’ aim to take FIT India movement to Schools/Colleges/Ministries/Govt & Pvt Organisations by encouraging them to participate in a grand manner on the occasion of National Sports Day on 29th August. On this day,  Schools/Colleges/Ministries/Govt & Pvt Organisations should encourage their students/employees/staff to take part in  sports/fitness activities for at least 1 hour.  </p>
                  <p>Suggested activities to engage the participants are as follows:<br>
				  <table class="table-grid table-bordered_cut table-bordered ">
				  <tr>
				  <th width="60px">S. No</th>
				  <th>Outdoor Activity</th>
				  <th>Indoor Activity</th>
				  <th>Fun Activity</th>
				  </tr>
				 <tr>
				  <td>1</td>
				  <td>Football</td>
				  <td>Badminton</td>
				  <td>Sack Race</td>
				  </tr>
				 <tr>
				  <td>2</td>
				  <td>Running</td>
				  <td>Volleyball</td>
				  <td>Lemon Race</td>
				  </tr>
				 <tr>
				  <td>3</td>
				  <td>Kho-Kho</td>
				  <td>Handball</td>
				  <td>Rope Skipping</td>
				  </tr>
				  				 <tr>
				  <td>4</td>
				  <td>Tennis</td>
				  <td>Basketball</td>
				  <td>Aerobics</td>
				  </tr>
				 <tr>
				  <td>5</td>
				  <td>Hockey</td>
				  <td>Table-Tennis</td>
				  <td>Squat Challenge</td>
				  </tr>

				  </table>
				 
				  </p>
				  <p><strong style=" font-size:16px;">Mode of participation</strong></p>
				  <ul style="list-style-type: circle; margin-left: 15px;">
				  <li>Schools/Colleges/Ministries/Govt & Private Organisations to register on Fit India website (Click on this link - on <a href="https://fitindia.gov.in/national-sports-day-2022">https://fitindia.gov.in/national-sports-day-2022</a> and provide all necessary details</li>
				  <li>Schools/Colleges/Ministries/Govt & Pvt Organisations to submit their data and upload photos / video links from the events conducted by them to download e-certificate</li>
				  </ul>
 <br>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-head" id="headingTwo">
                <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFISW2" aria-expanded="false" aria-controls="collapseTwo">
                  Guidelines
                </h2>
              </div>
              <div id="collapseFISW2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFISW">
                <div class="card-body">
                  <ol>
                    <li>Schools/Colleges/Ministries/Govt & Pvt Organisations to ensure that everyone actively participates in the National Sports Day 2022 celebration on 29th August 2022</li>
                    <li>School children may wear their sports uniforms on this day.</li>
                    <li>Schools/Colleges/Ministries/Govt & Pvt Organisations should register themselves on <a href="https://fitindia.gov.in/national-sports-day-2022">https://fitindia.gov.in/national-sports-day-2022</a> and upload photos and video link related to the event on the above-mentioned website.</li>
                    <li>E-Certificate can be downloaded from the Fit India Portal after successful conduct of the National Sports Day and uploading the images and videos of the event/activities conducted.</li>
                    <li>Schools are also encouraged to share/post activities conducted on their social media channels with <strong>#NationalSportsDay</strong> and tag <strong>@FitIndiaOff</strong></li>
                  </ol>
                </div>
              </div>
            </div>
            
          </div>

         
        </div>
      </div>
    </div>
</div>
</div>
</section>
<div class="modal fade" id="merchandisId" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Enter the Name of the School</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  action="school-week-merchandise" method="get">
        <div class="modal-body">
          <div class="form-group mb-1">
            <input type="text" name="school_name" class="form-control " id="exampleFormControlInput1" placeholder="Enter the name of your school">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <!-- <button type="button" class="btn btn-primary">Submit</button> -->
          <input type="submit" class="btn btn-primary" value="Submit" class="mer_btn" />
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    //$(".collapse")

    if ($(".collapse").hasClass('show')) {
      //alert("this  " + $(".collapse").html())
      // $(".card-head").addClass("showActive");
      // alert($(this).closest().html())
      //  alert($('.collapse' ).closest().html())

      //$(this).parent.parent.find('.card').addClass("showActive");
      // alert("rak")
      // $('.card-head').css({
      //     'Background','#ff8000'}
      // })
    } else if ($(".collapse").hasClass('')) {
      $(".card-head").removeClass("showActive");

    }
    // {
    //   $(".card-head").removeClass("showActive");
    // }
  })
</script>
@endsection