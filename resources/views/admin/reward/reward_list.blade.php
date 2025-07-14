@extends('admin.layouts.app')
@section('title', 'Fit India Admin - FoodCharts')

@section('content')
<style>
.mb-3{ margin-bottom: 0 !important; margin-right: 10px; }
.btn-sm{ padding: .375rem .75rem; }
.rtside{ float:right; }
</style>
<div class="content-wrapper">
        
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reward List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"aria-current="page">Reward list</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
     <div class="container-fluid">
        <div class="row">
		<div class="col-md-12">
      <div class="card">
        <div class="card-header">
        <div class="row">
        <div class="col-md-2">
		
         <a href="{{ route('admin.webreward.create') }}"> <input type="submit" value="Add New Reward" class="btn btn-sm btn-success float-right"> </a>
          <div class="card-tools float-sm-left">No of Rewards: <strong>{{ count($reward_data) }}</strong></div><br>
        </div>
		</div>
		</div>



    <!-- Main content -->
          <div class="card-body table-responsive p-0">			  
          <table class="table table-striped projects">
              <thead>
                  <tr class="thead-dark">
                      <th>
                          #
                      </th>
                      <th>
                          Award Group Type 
                      </th>
                      <th>
                         Award Type Name
                      </th>
                      <th>
                          Awardee Name
                      </th>
                      <th>
                         Image
                      </th>
                      <!-- <th>
                         Calories(Kcl)
                      </th> -->
                      
					<th class ="text-right">
                          Status
                    </th>
					  
   
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
              @if(!empty($reward_data))
                  @foreach($reward_data as $reward_row)

                  <tr >
                      <td>
                          {{++$i}}
                      </td>
                     <td>
                          {{ $reward_row->award_group_type_name }}
                      </td>
                      <td>
                          {{ $reward_row->award_type_name }}
                      </td>
                      <td>
                          {{ $reward_row->awardee_name }}
                      </td>
                      <td>
                          <img src="{{ $reward_row->awardee_image }}" width="100" height="100"/>
                      </td>
                      <td>
                        <?php if($reward_row->status=='0'){ ?>
                          <a class="update_reward" id="reward-{{$reward_row->id}}" ret="{{$reward_row->id}}" ref="1" href="javascript:void(0);">
                            <span style="color:red">Deactive</span> 
                          </a>
                          <?php }else{ ?>  
                          <a class="update_reward" id="reward-{{$reward_row->id}}" ret="{{$reward_row->id}}" ref="0" href="javascript:void(0);">
                            <span style="color:green">Activate</span>
                          </a>
                          <?php } ?> 
                      </td>
                  </tr>
                  @endforeach
                @endif
              </tbody>
          </table>
		   </div>
          <div class="d-flex justify-content-center">
		{{ $reward_data->links() }}
        </div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</section>
		</div>
        
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){ 
    $(document).on('click','.update_reward',function(){ 
        var award_id = $(this).attr('ret');
        var status = $(this).attr('ref');
        $.ajax({
            type:"POST",
            url:"{{route('update_reward_status')}}",
            data:{"award_id":award_id,"status":status,"_token": "{{ csrf_token() }}"},
            success:function(data){
              var response = JSON.parse(data);
              console.log(response);
              if(response.status=='1'){
                $('#reward-'+award_id).attr('ref','0');
                $('#reward-'+award_id).html('<span style="color:green">Activate</span>');
              }
              if(response.status=='0'){
                $('#reward-'+award_id).attr('ref','1');
                $('#reward-'+award_id).html('<span style="color:red">Deactive</span>');
              }
            }
        });
    });
  });
</script>>
@endsection