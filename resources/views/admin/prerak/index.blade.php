@extends('admin.layouts.app')
@section('title', 'Fit India Admin - All Preraks')
@section('content')

<div class="content-wrapper"> 
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Prerak (Social Media Influencer)</h1>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.ambassadors.index') }}">Prerak List (Social Media Influencer)</a></li>
                </ol>
            </div>
          </div>   
      </div>
  </section>
    <!-- Main content -->
  <section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
               <div class="row mt-2">
                    <div class="col-md-8">
                        <button class="btn btn btn-success btn btn-sm" name="download" value="download" onclick="window.location.href='prerak_export?s={{ request()->input('s') }}&search=search';"><i class="fa fa-download"></i> Download</button>
                    </div>
                    <div class="col-md-4 pull-right">
                        <!-- <form class="form-inline my-2 my-lg-0" type="get" action="{{ url('admin/preraklist') }}">
                            <input type="search" name="s" class="form-control mr-sm-2" placeholder="search prerak" width="200px">&nbsp;<button type="submit" class="btn btn-primary btn-sm" name="search" value="search" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter </button>&nbsp;
                        </form>  -->
                    </div>
                </div>
              <!--   <div class="row"><div class="col-md-12"><span class="badge badge-pill badge-info">Total :-{{$total_amb}}</span> <span class="badge badge-pill badge-success"> Approved :-{{$approved_amb}}</span> <span class="badge badge-pill badge-danger">Rejected :-{{$rejected_amb}}</span> <span class="badge badge-pill badge-secondary">Pending :-{{$pending_amb}}</span></div></div> -->
          </div>
        
        <?php //echo "<pre>"; print_r($prerak); die; ?>
      <!-- Default box -->    
          <div class="card-body table-responsive p-0"> 
            <table class="table table-striped table-bordered projects">
              <thead>
                  <tr class="thead-dark">
                      <th>#</th>
                      <th>Member Name</th>
                      <th>Child Count</th>
                      <th>Approved</th>
                      <th>Pending</th>
                      <th>Rejected</th>
                      <th>Self Followers</th>
                      <th>Total Followers</th>
                      <th>Registered As</th>
                      <th>Level</th>
                      <th>Status</th>
                      <th>Created Date</th>
                      <th>Updated By</th>
                      <th>Display Type</th>
                    </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                  @foreach($prerak as $prerak_data)
                  <?php
                  $sumfollower = $prerak_data->facebook_profile_followers + $prerak_data->twitter_profile_followers + $prerak_data->instagram_profile_followers;
                  ?>
                  <?php $prerak_result_count = DB::select(DB::raw("SELECT id, name, genrated_refer_code, refer_code, parent_id, facebook_profile_followers as fb_followers, twitter_profile_followers as tw_followers, instagram_profile_followers as insta_followers, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from preraks order by parent_id, id) preraks, (select @pv := $prerak_data->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id))")); 

                    $prerak_pending_count = DB::select(DB::raw("SELECT id from (select * from preraks order by parent_id, id) preraks, (select @pv := $prerak_data->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='0'"));

                    $prerak_approved_count = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from preraks order by parent_id, id) preraks, (select @pv := $prerak_data->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='1'"));

                     $prerak_rejected_count = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from preraks order by parent_id, id) preraks, (select @pv := $prerak_data->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='2'"));
                  ?>
                  <tr>
                      <td>
                          {{++$i}}
                      </td>
                      <td style="white-space: nowrap;">
                       {{$prerak_data->name}}<br>{{$prerak_data->genrated_refer_code}}   
                      </td>
                      <td>
                        <a href="prerakdetails/{{$prerak_data->id}}">{{count($prerak_result_count)}}
                      </td>
                       <td>{{count($prerak_approved_count)}}</td>
                      <td>{{count($prerak_pending_count)}}</td>
                      <td>{{count($prerak_rejected_count)}}</td>
                    
                      <!-- <td>{{$prerak_data->facebook_profile_followers}}</td>
                      <td>{{$prerak_data->twitter_profile_followers}}</td>
                      <td>{{$prerak_data->instagram_profile_followers}}</td> -->
                      
                      <td>
                       {{$sumfollower}}
                      </td>
                      
                      <td>
                        <?php $sumfollower2=0;?>
                      @foreach($prerak_approved_count as $prerak_count_row)
                      <?php $sumfollower2 = $sumfollower2+$prerak_count_row->sum_of_followers; 
                      ?>
                        
                      @endforeach
                     <?php $total_follower = $sumfollower+$sumfollower2; 
                      echo $total_follower;
                     ?>
                      </td>
                        <td>{{$prerak_data->register_as}}</td>
                    
                      <td>
                         @if($total_follower<=9999 && $total_follower>=1000)
                         Prerak
                         @elseif($total_follower>=10000 && $total_follower<=99999)
                         Ambassador
                         @elseif($total_follower>=100000)
                         Champion
                         @endif
                      </td>
                      <td>  @if($prerak_data->status==1)
                         <p id="amb-{{ $prerak_data->id }}"><span class="badge badge-pill badge-success">Approved</span></p>
                         @elseif($prerak_data->status==2)
                         <p id="amb-{{ $prerak_data->id }}"><span class="badge badge-pill badge-danger">Rejected</span></p>
                         @else
                         <p id="amb-{{ $prerak_data->id }}"><span class="badge badge-pill badge-secondary">Pending</span></p>
                          <select class="status_change" id="{{$prerak_data->id}}">
                            <option value="">Please select</option>
                            <option value="1">Approved</option>
                            <option value="2">Rejected</option>
                        </select>
                         @endif</td> 
                      
                      <td>{{ $prerak_data->created_at}}</td>	
                      <td>{{ $prerak_data->aemail}}</td>
                      <td id="influencerrow-{{$prerak_data->id}}"> 
                        @if($prerak_data->status==1)
                            @if($total_follower<=9999 && $total_follower>=1000)
                                @if($prerak_data->transfer_status=='0')
                                    <a class="social_media_inf" ref="{{ $prerak_data->id }}" ref_type="prerak" href="javascript:void()">List As Prerak</a>
                                @elseif($prerak_data->transfer_status=='1')
                                    <span class="badge badge-pill badge-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Listed</span>
                                @endif
                            @elseif($total_follower>=10000 && $total_follower<=99999)
                                @if($prerak_data->transfer_status=='1' || $prerak_data->transfer_status=='0')
                                    <a class="social_media_inf" ref="{{ $prerak_data->id }}" ref_type="ambassador" href="javascript:void()">List As Ambassador</a>
                                @elseif($prerak_data->transfer_status=='2')
                                  <span class="badge badge-pill badge-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Listed</span>
                                @endif 
                            @elseif($total_follower>=100000)
                                @if($prerak_data->transfer_status=='2' || $prerak_data->transfer_status=='0')
                                   <a class="social_media_inf" ref="{{ $prerak_data->id }}" ref_type="champion" href="javascript:void()">List As Champion</a> 
                                @elseif($prerak_data->transfer_status=='3')
                                  <span class="badge badge-pill badge-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Listed</span>
                                @endif    
                            @endif
                        @endif

                      </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
           </div>
           <div class="d-flex justify-content-center">
        
          </div>      
        </div>
        </div>
        </div>  
        </div>
    </section>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery('.status_change').change(function(){ 
      var amb_id = jQuery(this).attr('id');
      var status = jQuery(this).val();
      jQuery.ajax({
        type:"POST",
        url:"{{ url('/admin/prerak-activation/') }}",
        data : {'prk_id' :amb_id,'status':status, '_token': '{{ csrf_token() }}'},
        beforeSend: function() {
              jQuery('#amb-'+amb_id).html('<img width="35" with="35" src="{{url("/wp-content/uploads/2021/01/loader.gif")}}">');
            },
        success:function(res){
          var response_obj = JSON.parse(res);
            if(response_obj.status=='1'){
              jQuery('#'+amb_id).remove();
              jQuery('#amb-'+amb_id).html('<span class="badge badge-pill badge-success">Approved</span>');
            }else if(response_obj.status=='2'){
              jQuery('#'+amb_id).remove();
              jQuery('#amb-'+amb_id).html('<span class="badge badge-pill badge-danger">Rejected</span>');
            }else{
              jQuery('#amb-'+amb_id).html('<span class="badge badge-pill badge-secondary">Pending</span>');
            }
        }
     });
  });

     jQuery('.social_media_inf').click(function(){
      var prk_id = jQuery(this).attr('ref');
      var prk_type = jQuery(this).attr('ref_type');
    
      jQuery.ajax({
        type:"POST",
        url:"{{ url('/admin/influencer-upgrade/') }}",
        data : {'prk_id' :prk_id,'prk_type':prk_type,'_token': '{{ csrf_token() }}'},
       /* beforeSend: function() {
              jQuery('#amb-'+amb_id).html('<img width="35" with="35" src="{{url("/wp-content/uploads/2021/01/loader.gif")}}">');
            },*/
        success:function(res){
          console.log(res);
          var response_obj = JSON.parse(res);
            if(response_obj.status=='1'){
             /* jQuery('#'+amb_id).remove();
              jQuery('#amb-'+amb_id).html('<span class="badge badge-pill badge-success">Approved</span>');
            */
                jQuery('#influencerrow-'+prk_id).html('<span class="badge badge-pill badge-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Listed</span>');
            }

            /*else if(response_obj.status=='2'){
              jQuery('#'+amb_id).remove();
              jQuery('#amb-'+amb_id).html('<span class="badge badge-pill badge-danger">Rejected</span>');
            }else{
              jQuery('#amb-'+amb_id).html('<span class="badge badge-pill badge-secondary">Pending</span>');
            }*/
        }
     });

     }) 
    });
  </script>
@endsection