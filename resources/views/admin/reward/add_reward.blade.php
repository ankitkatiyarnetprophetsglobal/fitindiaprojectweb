@extends('admin.layouts.app')
@section('title', 'Create Foods-Fit India')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
           <!--  <a class="" href="{{ route('admin.foodnames.index') }}"><i class="fas fa-long-arrow-alt-left"></i> Back</a> -->
            <h1>Add Reward</h1>
          </div>
          </div>
     <div class="row mb-2">  
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.foodnames.index') }}">Add Reward</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Reward</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form name="webreward" id="webreward" method="POST" action="{{ route('admin.webreward.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>                        
                    </div>
                @endif


                 
                        <div class="form-group">
                    <label for="exampleInputEmail1">Award Group Type</label>
                    <select name="a_group_type" class="form-control">
                    <option value="">Select Group Type</option>
                    @if(!empty($reward_cat))
                      @foreach($reward_cat as $reward_cat_val)
                      <option value="{{$reward_cat_val->id}}">{{$reward_cat_val->award_group_type_name}}</option>
                      @endforeach
                    @endif

                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">award type name</label>
                    <input type="text" name="award_type_name" class="form-control" id="award_type_name" placeholder="Enter award type name">
                </div>

                <div class="row">
                  <div class="form-group">
                    <input type="radio" name="awardee_select_type" value="user_select" checked> User Select
                  </div>
                  &nbsp;&nbsp;
                  <div class="form-group">
                   <input type="radio" name="awardee_select_type" value="state_select"> State Select
                  </div>
                </div>
                
                <div class="form-group" id="userlist">
                  <!--   <select class="form-control">
                    <option value="">Select User</option>
                    @if(!empty($user))
                      @foreach($user as $user_val)
                      <option value="{{$user_val->id}}">{{$user_val->name}}</option>
                      @endforeach
                    @endif
                    </select> -->
                    <input type="text" name="user_id" class="form-control" id="user_id" placeholder="Enter Fit India ID" pattern="^[0-9]*$" />
                    <!-- <input type="number" min="0" name="user_id" class="form-control" id="user_id" placeholder="Enter Fit India ID"> -->
                    <span style="color:green;" id="user-data"><span>
                </div>
                <div class="form-group" style="display:none;" id="statelist">
                    <select name="award_state" class="form-control">
                    <option value="">Select State</option>
                    @if(!empty($state))
                      @foreach($state as $state_val)
                      <option value="{{$state_val->id}}">{{$state_val->name}}</option>
                      @endforeach
                    @endif
                    </select>
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail1">Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                
                        </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
              </form>
            </div>
           
            

          </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- /.content -->
  </div>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<!--  <script src="https://jqwidgets.com/public/jqwidgets/jqx-all.js"></script>  -->

 <script>
 /* $(document).ready(function(){
    $('#webreward').on('submit', function() {
      //alert();
      //   return $('#webreward').jqxValidator('validate');
     

     });
  });*/
 /* $(function() { //alert();
    $("#webreward").validate({
    rules: {
        a_group_type:{
          required:true
        },
        awardee_select_type:{
          required:true
        },
        image: {
          required:true
        },
    },
    messages: {
        a_group_type:{
          required:"This field is requried",
        },
        awardee_select_type: {
          required: "This field is required",
        },
        image: {
          required: "This field is requried",
        },
    },
    submitHandler: function(form) { 
      form.submit();
    }
});
 });*/

$(document).ready(function(){ 
  $('input[type=radio][name=awardee_select_type]').change(function() {
      if (this.value == 'user_select') {
          $('#userlist').show();
          $('#statelist').hide();
      }
      else if (this.value == 'state_select') {
          $('#userlist').hide();
          $('#statelist').show();
      }
  });
  $('#user_id').keyup(function(){ 
      var userid = $(this).val();
      $.ajax({
          type:"POST",
          url:"{{route('get_reward_userdetail')}}",
          data:{"userid":userid,"_token": "{{ csrf_token() }}"},
          success:function(data){
            var response = JSON.parse(data);
            console.log(response);
            if(response.status=='1'){
              $('#user-data').html(response.name+ ', ' +response.email);
            }else{
              $('#user-data').html('');
            }
          }
      });
  });
})


</script>


@endsection
