@extends('admin.layouts.app')
@section('title', 'Fit India Admin - All Ambassadors')
@section('content')


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php $child_sum = 0; ?>
@if(!empty($prerak_data))
    
    @foreach($prerak_data as $prerak_rows_first)
         <?php 
         if($prerak_rows_first->status=='1'){
            $child_sum=$child_sum+$prerak_rows_first->sum_of_followers;
         } 
         ?>  
    @endforeach
@endif
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{$parent_data->image}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ucwords($parent_data->name)}}</h3>

                <p class="text-muted text-center">{{ucwords($parent_data->designation)}}</p>
                 <p class="text-muted text-center">Parent Refer Code:-  {{$parent_data->genrated_refer_code}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Facebook Followers</b> <a class="float-right">{{$parent_data->facebook_profile_followers}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Twitter Following</b> <a class="float-right">{{$parent_data->twitter_profile_followers}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Instagram Friends</b> <a class="float-right">{{$parent_data->instagram_profile_followers}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Parent Sum of followers</b> <a class="float-right">{{$parent_data->facebook_profile_followers+$parent_data->twitter_profile_followers+$parent_data->instagram_profile_followers}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Child Sum of followers</b> <a class="float-right">{{$child_sum}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Total Sum of followers</b> <a class="float-right">{{$parent_data->facebook_profile_followers+$parent_data->twitter_profile_followers+$parent_data->instagram_profile_followers+$child_sum}}</a>
                  </li>
                </ul>

                <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <!-- <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>
                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>
                <hr>
                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                <p class="text-muted">Malibu, California</p>
                <hr>
                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>
                <hr>
                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
            </div> -->
            <!-- /.card -->
          </div>
          <?php //echo "===".count($prerak_data); echo "<pre>"; print_r($prerak_data); 
         /* echo "<pre>"; 
          print_r($parent_data);*/ //die;
         
           ?>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
                <div class="card-header "> 
                  <div class="row">
                   <div class="col-md-6 ">
                    <!-- <select class="form-control" onChange="doReload(this.value);">
                      <option value="">Select Parent</option>
                        @if(!empty($prerak_data))
                            @foreach($prerak_data as $prerak_rows)
                            <option value="{{$prerak_rows->id}}">{{$prerak_rows->name}} &nbsp;{{$prerak_rows->genrated_refer_code}} </option>
                            @endforeach
                        @endif
                    </select> -->
                    <!--  <button class="btn btn btn-success btn btn-sm" name="download" value="download" onclick="window.location.href='prerak_export?s={{ request()->input('s') }}&search=search&id={{$parent_data->id}}';"><i class="fa fa-download"></i> Download</button> -->
                  </div> 
                   <div class="col-md-6">
                      <!--   <form class="form-inline my-2 my-lg-0" type="get" action="{{ url('admin/preraklist') }}">
                            <input type="search" name="s" class="form-control mr-sm-2" placeholder="search prerak" width="200px">&nbsp;<button type="submit" class="btn btn-primary btn-sm" name="search" value="search" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter </button>&nbsp;
                        </form>  -->
                    </div>
                  </div>
              </div> 

              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="card-body table-responsive p-0"> 
                        <table class="table table-striped projects table-bordered">
                          <thead>
                              <tr class="thead-dark">
                                  <th >Member Name</th>
                                  <th >Referrer</th>
                                  <th>Child Count</th>
                                  <th>Approved</th>
                                  <th>Pending</th>
                                  <th>Rejected</th>
                                  <th>Facebook</th>
                                  <th>Twitter</th>
                                  <th>Insta </th>
                                  <th>Total Followers</th>
                                  <th>Registered As</th>
                                  <th>Level</th>
                                  <th>Sum of Followers</th>
                                  <th>Status</th> 
                                  <th>Created Date</th>
                                  <th>Display Type</th>
                                </tr>
                          </thead>
                          <tbody>
                            @if(!empty($prerak_data))
                            <?php $total=0; ?>
                                @foreach($prerak_data as $prerak_rows)
                                <?php
                               $prerak_result_count = DB::select(DB::raw("SELECT id from (select * from preraks order by parent_id, id) preraks, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id))")); 

                                $prerak_pending_count = DB::select(DB::raw("SELECT id from (select * from preraks order by parent_id, id) preraks, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='0'"));

                                $prerak_approved_count = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from preraks order by parent_id, id) preraks, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='1'")); 

                                 $prerak_rejected_count = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from preraks order by parent_id, id) preraks, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='2'"));
                                ?>

                                <tr>
                                <td style="white-space: nowrap;">{{ ucwords($prerak_rows->name) }} <br>
                                    @php if(!empty($prerak_rows->genrated_refer_code)){
                                        echo "(".$prerak_rows->genrated_refer_code.")"; 
                                    }
                                    @endphp 
                                </td>
                                <td style="white-space: nowrap;">{{ $prerak_rows->refer_code }}</td>
                                 <td>
                                    <a href="{{ url('admin/prerakdetails') }}/{{$prerak_rows->id }}">{{count($prerak_result_count)}}
                                </td>
                                <td>{{count($prerak_approved_count)}}</td>
                                <td>{{count($prerak_pending_count)}}</td>
                                <td>{{count($prerak_rejected_count)}}</td>
                                <td>{{ $prerak_rows->fb_followers }}</td>
                                <td>{{ $prerak_rows->tw_followers }}</td>
                                <td>{{ $prerak_rows->insta_followers }}</td>
                                <td>{{ $prerak_rows->sum_of_followers }}</td>
                                <td>{{ $prerak_rows->register_as }}</td>
                                <td>
                                    @if($prerak_rows->sum_of_followers<=9999 && $prerak_rows->sum_of_followers>=1000)
                                     Prerak
                                     @elseif($prerak_rows->sum_of_followers>=10000 && $prerak_rows->sum_of_followers<=99999)
                                     Ambassador
                                     @elseif($prerak_rows->sum_of_followers>=100000)
                                     Champion
                                     @endif
                                </td>
                                <td> <?php $sumfollower2=0;?>
                                  @foreach($prerak_approved_count as $prerak_count_row)
                                  <?php $sumfollower2 = $sumfollower2+$prerak_count_row->sum_of_followers; 
                                  ?>
                                    
                                  @endforeach
                                 <?php $total_follower = $prerak_rows->sum_of_followers+$sumfollower2; 
                                  echo $total_follower;
                                 ?></td>
                                <td>@if($prerak_rows->status==1)
                                     <p id="amb-{{ $prerak_rows->id }}"><span class="badge badge-pill badge-success">Approved</span></p>
                                     @elseif($prerak_rows->status==2)
                                     <p id="amb-{{ $prerak_rows->id }}"><span class="badge badge-pill badge-danger">Rejected</span></p>
                                     @else
                                     <p id="amb-{{ $prerak_rows->id }}"><span class="badge badge-pill badge-secondary">Pending</span></p>
                                      <select class="status_change" id="{{$prerak_rows->id}}">
                                        <option value="">Please select</option>
                                        <option value="1">Approved</option>
                                        <option value="2">Rejected</option>
                                    </select>​
                                     @endif</td>
                                <td>{{ $prerak_rows->created_at }}</td>
                                 <td id="influencerrow-{{$prerak_rows->id}}"> 
                                    @if($prerak_rows->status==1)
                                        @if($total_follower<=9999 && $total_follower>=1000)
                                            @if($prerak_rows->transfer_status=='0')
                                                <a class="social_media_inf" ref="{{ $prerak_rows->id }}" ref_type="prerak" href="javascript:void()">List As Prerak</a>
                                            @elseif($prerak_rows->transfer_status=='1')
                                                <span class="badge badge-pill badge-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Listed</span>
                                            @endif
                                        @elseif($total_follower>=10000 && $total_follower<=99999)
                                            @if($prerak_rows->transfer_status=='1' || $prerak_rows->transfer_status=='0')
                                                <a class="social_media_inf" ref="{{ $prerak_rows->id }}" ref_type="ambassador" href="javascript:void()">List As Ambassador</a>
                                            @elseif($prerak_rows->transfer_status=='2')
                                              <span class="badge badge-pill badge-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Listed</span>
                                            @endif 
                                        @elseif($total_follower>=100000)
                                            @if($prerak_rows->transfer_status=='2' || $prerak_rows->transfer_status=='0')
                                               <a class="social_media_inf" ref="{{ $prerak_rows->id }}" ref_type="champion" href="javascript:void()">List As Champion</a> 
                                            @elseif($prerak_rows->transfer_status=='3')
                                              <span class="badge badge-pill badge-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Listed</span>
                                            @endif    
                                        @endif
                                    @endif
                                </td>
                                </tr>
                                <?php $total=$total+$prerak_rows->sum_of_followers; ?>
                                @endforeach
                               <!--  <tr style="background-color: aliceblue"><td>Total</td><td></td><td></td><td></td><td>{{$total}}</td><td></td><td></td><td></td><td></td></tr> -->
                            @endif
                            </tbody>
                        </table>
                      </div>
                    </div>
                  
                  </div>
                 
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 <script language="javascript" type="text/javascript">
function doReload(prk_id){
  document.location = '{{url("admin/prerakdetails")}}/' + prk_id;
}
</script>
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