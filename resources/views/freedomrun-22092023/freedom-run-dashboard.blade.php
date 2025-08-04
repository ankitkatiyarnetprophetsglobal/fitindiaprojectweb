@extends('layouts.app')
@section('title', 'Fit-india-freedomrun-dashboard | Fit India')
@section('content')
@php
$active_section = request()->segment(count(request()->segments()));
$active_section_id = trim($active_section);
@endphp
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.0/jquery.waypoints.min.js"></script> -->

<script src="{{ asset('resources/js/jquery.counterup.min.js') }}"></script>

<script src="{{ asset('resources/js/jquery.waypoints.min.js') }}"></script>

<script>
        jQuery(document).ready(function ($) {
            $('.counter').counterUp({
                delay: 5,
                time: 500
            });
        });
    </script>
<style>
      .font_weight{
          font-weight:300;
      }
      
      .freeHead_o{background:#ff8000;border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    padding: 10px;
    font-size: 18px;
    color: #fff;
    text-align: center;}
      .freeHead_b{background:#02349a;border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    padding: 10px;
    font-size: 18px;
    color: #fff;
    text-align: center;}
      .freeHead_g{
        background:#008000;border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    padding: 10px;
    font-size: 18px;
    color: #fff;
    text-align: center;
      }
      .rp{padding-left:0;padding-right:0;}

      .freeparent .card{margin-left:10px;margin-right:10px;margin-bottom:10px; margin-top:10px;}
      .freeTable{
          margin-top:60px;
      }
      .freeId_ds{   
          
    padding-top: 40px;
    padding-left: 5%;
    padding-right: 5%;}
      
    .shadow1{
        box-shadow: 0 .3rem .5rem rgba(0,0,0,.15)!important;
    }

    .table td, .table th {
   
    background: #fff;
}
.list_img img{height:200px;object-fit:cover;margin:10px; }
.freeId_ds a{padding:5px;}
.freeparent .card{
    border: 0px solid rgba(0,0,0,.125);

}
.modal-header1{padding-top:5px!important;padding-bottom:5px!important;}
.freeparent h5{padding:15px 10px;}
.freeHead_r{background:#ff0000;border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    padding: 10px;
    font-size: 18px;
    color: #fff;
    text-align: center;}

    .freeHead_o {font-size: 24px;}
    .freeHead_b {font-size: 24px;}

    .table_area{width: 90%;margin:0 auto;}
    .table_area p{margin-bottom:0;}

      /* #ff8000
      #02349a
      #008000 */
   .card_height{
    height: 266px
   }
   .table-striped>tbody>tr:nth-child(odd) {
    background-color: #f9f9f9;
}
.table-hover tbody tr:hover {
    background-color: #f9f9f9;;
}
.bg_c{background:#f5f5f5;}
    </style>
<?php   
$organizerQuery = DB::table('freedomruns')->where('role','organizer')->select('id','user_id','name','total_participant','total_kms','eventimg_meta','video_link')->orderby('total_participant','DESC')->offset(0)->limit(10)->get();
$organizerCountQuery = DB::table('freedomruns')->where('role','organizer')->count();
$individualCountQuery = DB::table('freedomruns')->where('role','individual')->count();
$participantSumQuery = DB::table('freedomruns')->where('role','organizer')->sum('total_participant');
$organizerKmSumQuery = DB::table('freedomruns')->where('role','organizer')->sum('total_kms');
$individualKmSumQuery = DB::table('freedomruns')->where('role','individual')->sum('kmrun');
$sum_of_km_run = $organizerKmSumQuery+$individualKmSumQuery;

$participantSumQuery = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $participantSumQuery);
$organizerKmSumQuery = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $organizerKmSumQuery);
$individualKmSumQuery = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $individualKmSumQuery);

$top5data = DB::select("select a.organiser_name,b.email,b.id, sum(a.total_participant) as total_amount from freedomruns as a left join users as b on a.user_id=b.id  where a.role='organizer' group by a.organiser_name,b.email order by total_amount desc limit 0,7");
?>        
<div class="container-fluid freeId_ds" id="{{ $active_section_id }}" style="background: #f1f1f1f!important;" >
	<div class="row">
		<div class="col-sm-12 text-center mb-4 d-flex justify-content-between align-items-center">
			<h1> Dashboard : Fit india Freedom Run 2.0</h1>
			<p><span>As on Dated :  <span><?php echo date('d M Y'); ?></span></span></p>
		</div>
	</div>
	<div class="row freeparent">
		<div class="col-md-6 col-sm-12   rp text-center ">
				<div class="card shadow1 card_height">
					<h4 class="font_weight freeHead_o  mb-3" >Total Individual Registration</h4>
					<h5>Events Registered: <span class="counter">{{$individualCountQuery}}</span></h5>

					<table class="table table-bordered table_area mb-5 table-striped">
						<tbody>
							<tr>
								<td><p><span><b>Total Km Covered</span></b></p></td>
								<td style="text-align:center"><p><span ><b>{{$individualKmSumQuery}} </span></b></p></td>                                        
							</tr>                                  
						</tbody>
					</table>
				</div>                        
			 </div>
			<div class="col-md-6 col-sm-12   rp text-center ">
				<div class="card shadow1 card_height">
					<h4 class="font_weight freeHead_b mb-3" >Total Organisations Registration</h4>
					<h5>Events Registered: <span class="counter">{{$organizerCountQuery}}</span></h5>
					<table class="table table-bordered table_area mb-5 table-striped">
						<tbody>
							<tr>
								<td class="bg_c"><p><span><b>Total Participations </span></b></p></td>
								<td class="bg_c" style="text-align:center" class=""><p><span><b>{{$participantSumQuery}} </span></b></p></td>                                        
							</tr>
							<tr>
								<td><p><span><b>Total Km Covered </span></b></p></td>
								<td style="text-align:center"><p><span><b>{{$organizerKmSumQuery}} </span></b></p></td>                                        
							</tr>
						</tbody>
					</table>
					<!--<div class="d-flex justify-content-around pl-3 pr-3 mb-3" >
						<p><span><b>Total Participations:- </span>{{$participantSumQuery}}</b></p>
						<p><span><b>Total Km Covered:- </span>{{$sum_of_km_run}}</b></p>
					</div> -->
				</div>                        
			 </div>
                   <!--  <div class="col-md-3 col-sm-12  rp text-center">
                    <div class="card shadow1">
                        <h4 class="font_weight freeHead_g"> Total Participation</h4>
                        <h5>{{$participantSumQuery}}</h5>
                        </div>
                        
                    </div>
                    <div class="col-md-3 col-sm-12  rp text-center">
                    <div class="card shadow1">
                        <h4 class="font_weight freeHead_r"> Total kms Covered</h4>
                        <h5>{{$sum_of_km_run}}</h5>
                        </div>                        
                    </div> -->
                </div>

				<!--<div class="row freeparent">
				 <div class="col-md-6 col-sm-12   rp text-center ">
				  <div class="card shadow1">
					<h4 class="font_weight freeHead_b mb-3" >Top 7 Trending Fit India Freedom Run Organisations </h4>					
					 <table class="table table-bordered table_area mb-5 table-striped">
						<tbody>							
							<tr>
								<td><p><span><b>Organisation Name </span></b></p></td>
								<td><p><span><b>Total Participation</span></b></p></td>								                                        
							</tr>							
							@if(!empty($top5data))
						     @foreach($top5data as $toprecord)                               
								<tr>
								  <td>{{$toprecord->organiser_name}}</td>
								  <td>{{$toprecord->total_amount}}</td>								                                        
								</tr>							
							 @endforeach					 
							@endif
						</tbody>
					 </table>
					</div>                        
				  </div> 
                </div>-->
				
				<div class="row freeparent">
				 <div class="col-md-12 col-sm-12   rp text-center ">
				  <div class="card shadow1">
					<h4 class="font_weight freeHead_b mb-3"  style="background: #028102;">Top Trending Fit India Freedom Run Organisations </h4>					
					 <table class="table table-bordered table_area mb-5 table-striped">
						<tbody>							
							<tr>
								<th style="background: #06b3065e;color:#1e411e;font-weight:200;font-size:18px;"><p><span><b>Organisation Name </span></b></p></th>
								<th style="background: #06b3065e;color:#1e411e;font-weight:200;font-size:18px;"><p><span><b>Total Participation</span></b></p></th>								                                        
							</tr>							
							@if(!empty($top5data))
						     @foreach($top5data as $toprecord)
                               
								<tr>
								  <td>{{$toprecord->organiser_name}}</td>
								  <td>{{$toprecord->total_amount}}</td>								                                        
								</tr>							
							 @endforeach					 
							@endif
						</tbody>
					 </table>
					</div>                        
				  </div> 
                </div>	

				
				
                <div class="row">
                    <div class="col-sm-12 col-md-12 freeTable">
                       <!--  <h2 class="mb-3">Top 10 leading Organisations</h2>
                    <table class="table table-bordered shadow1 mb-5">
                        <thead>
                            <tr>
                            <th scope="col">Rank</th>
                            <th scope="col">Participants/Organisation</th>
                            <th scope="col">No of Participants</th>
                            <th scope="col">Total KMs Covered</th>
                            <th scope="col">Uploaded Photos </th>
                            <th scope="col">Uploaded Videos </th>
                            </tr>
                        </thead>
                        <tbody> -->
                        <?php
                        /*$pnt_total1 = 0;
                        $j=1;
                            if(!empty($organizerQuery)){
                                foreach ($organizerQuery as $key => $freedomrun_value) {
                            ?>
                            <tr>
                                <th scope="row">{{$j}}</th>
                                <td><?=$freedomrun_value->name?></td>
                                <td><?php echo $freedomrun_value->total_participant; ?></td>
                                <td><?php echo $freedomrun_value->total_kms; ?></td>
                                <td>
                                    <?php 
                                    if(!empty($freedomrun_value->eventimg_meta)){
                                        ?>
                                        <a href="javascript:void(0)"  data-toggle="modal" data-target="#exampleModal<?=$freedomrun_value->id?>"><?php echo count(unserialize($freedomrun_value->eventimg_meta)); ?></a>
                                           <div class="modal fade" id="exampleModal<?=$freedomrun_value->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog  modal-lg">
                                                <div class="modal-content">
                                                  <div class="modal-header modal-header1">
                                                    <h5 class="modal-title" id="exampleModalLabel">Photo</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                      <div class="d-flex justify-content-around flex-wrap list_img">
                                                        <?php 
                                                        foreach(unserialize($freedomrun_value->eventimg_meta) as $fr_image){
                                                        ?>
                                                        <img src="<?=$fr_image?>" class="img-fluid"/>
                                                        <?php } ?>    
                                                      </div>
                                                    </div>
                                                </div>
                                              </div>
                                           </div>
                                        <?php 
                                    }else{
                                        echo '0';
                                    }
                                 ?>
                                 </td> 
                                <td >
                                <div class="d-flex flex-column">
                                    <?php $video_arr = unserialize($freedomrun_value->video_link);
                                       if(!empty($video_arr)){
                                        foreach($video_arr as $video_values){ ?>
                                            <a href="<?=$video_values?>"><?=$video_values?></a>
                                        <?php }  } ?>
                                     </div>
                                    
                                    
                                </td>
                            </tr>
                           <?php 
                           $j++; } } */ ?>
                        <!-- </tbody>
                        </table> -->
                    </div>
                </div>
              
             <br><br><br><br><br><br><br><br>
       
            </div>
       
         

@endsection