@extends('admin.layouts.app')
@section('title', 'Fit India Admin - All Freedomrun')
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
            <h1>Partners</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Partners</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>	
	 @if($message = Session::get('msg'))
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
			  <button class="btn btn-success btn-sm dwl" name="download" value="download" onclick="window.location.href='freedomrun_partners?ename={{ request()->input('event_name')}}&search=search';">
			  <i class="fa fa-download"></i> Download</button>		
			  </div>
			  <div class="col-md-10">
			  <form class="form-inline my-2 my-lg-0 rtside " type="get" action="{{ url('admin/freedomrun-partner') }}">
                <div class="form-group rtside">
				</div>
              </form>  
				
            </div>
			</div> 
			<div class="row mt-2">
			<div class="col-md-6">           		
			 Total Partners : <strong> {{ $count }}</strong>			 
			</div>		
			<div class="col-md-6 rtside">
			  <form class="form-inline my-2 my-lg-0 rtside " type="get" action="{{ url('admin/freedomrun-partner') }}">
                <div class="form-group rtside">
                	 <?php
			             if(!empty($_REQUEST['event_name'])&& $_REQUEST['event_name']!=''){
			              
			               $tname=$_REQUEST['event_name'];

			             }else{

			               $tname='';
			             }
                       ?>      
					<input type="search" name="event_name" value="<?=$tname?>" id="event_name" class="form-control" placeholder="Name/Email/Mobile">
					<button type="submit" class="btn btn-primary btn-sm" name="search" value="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
				</div>
              </form> 
            </div>
			</div>
          </div>
         <!-- /.card-header -->
         <div class="card-body table-responsive p-0">
		 <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ url('partnerDeleteAll') }}">Delete All </button>
		  <table class="table table-striped projects">
              <thead>
                  <tr class="thead-dark">
                   <th scope="col" style="padding:2px;margin:2px;width:100px !important;"><label><input type="checkbox" id="master"> Select All</label></th>
                    <th scope="col">Organiser Name</th>
                    <th scope="col">Event Name</th>	
					<th scope="col">Email</th>
					<th scope="col">Mobile No.</th>
					<th scope="col">From Date</th>                    
                    <th scope="col">To Date</th>                    
                    <th scope="col">Action</th> 
                    <th scope="col"></th> 
                  </tr>
               </thead>
              <tbody>
			   <?php $i=0; ?>
                @if(count($partners)>0)
                 @foreach($partners as $freedom)
                  <tr>
                      <tr id="tr_{{$freedom->id}}">
					  <td><input type="checkbox" class="sub_chk" data-id="{{$freedom->id}}"></td>
					  <td>@if(!empty($freedom->org_name)) {{ ucwords(strtolower($freedom->org_name)) }}  @endif</td>
                      <td>@if(!empty($freedom->event_name)) {{ $freedom->event_name }} @endif</td>
                      <td>@if(!empty($freedom->email_id)) <br>{{ $freedom->email_id }}  @endif</td>                      
                      <td>@if(!empty($freedom->contact)) <br>{{ $freedom->contact }}  @endif</td>					  
					  <td>
					      @if(!empty($freedom->from_date)) <br>{{ $freedom->from_date }}  @endif					      
					  </td>	  
					  <td>@if(!empty($freedom->to_date)) <br>{{ $freedom->to_date }}  @endif</td> 
                      <td>
                        @if($freedom->status==1)
                         <p id="amb-{{ $freedom->id }}"><span class="badge badge-pill badge-success">Approved</span></p>
                         @elseif($freedom->status==2)
                         <p id="amb-{{ $freedom->id }}"><span class="badge badge-pill badge-danger">Rejected</span></p>
                         {{$freedom->reason}}
                         @else
                         <p id="amb-{{ $freedom->id }}"><span class="badge badge-pill badge-secondary">Pending</span></p>
                          <select class="status_change" id="{{$freedom->id}}">
                            <option value="">Please select</option>
                            <option value="1">Approved</option>
                            <option value="2">Rejected</option>
                          </select>​
                         @endif
						</td>  
						 <td>
						  <a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.freedomrun-partner.pedit', $freedom->id)}}"> <i class="fas fa-pencil-alt"></i></a>
						  &nbsp;&nbsp;
                          <form action="{{ route('admin.freedomrun-partner.pdestroy', $freedom->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                           <button  style="display: inline !important;" class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Do you want to delete ?')"></i>&nbsp;</button>
                         </form>     
						</td>	
                     </tr>
                   @endforeach
			     @endif                  
              </tbody> 
            </table>
			
			 <div class="d-flex justify-content-center">
           {{ $partners->links() }}
         </div>
         </div>
      </div>
        </div>
      </div>
	  </div>
      <div class="d-flex justify-content-center"></div>	
    </section>    
  </div>
  
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery('.status_change').change(function(){
      var status = jQuery(this).val();
      var amb_id = jQuery(this).attr('id');	  
       jQuery.ajax({
          type:"POST",
          url:"{{ url('/admin/partner-activation/') }}",
          data : {'amb_id' :amb_id,'status':status,'_token': '{{ csrf_token() }}'},
         
          success:function(res){     
			  
			  location.reload();
          }
       });   
    });
   });   
   
   $(document).ready(function(){
        $('#master').on('click', function(e){
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
         }  
        });
		
        $('.delete_all').on('click', function(e){
            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  


            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  
                var check = confirm("Are you sure you want to delete this row?");  
                if(check == true){  
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        //url: $(this).data('url'),
						url:"{{ url('/admin/partnerDeleteAll/') }}",
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data){
                            if (data['success']){
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
								window.location.reload(true);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });


                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }  
            }  
        });


        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });


        $(document).on('confirm', function (e) {
            var ele = e.target;
			
            e.preventDefault();
            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });


            return false;
        });
    });
   
   
  </script>  
@endsection





    
  