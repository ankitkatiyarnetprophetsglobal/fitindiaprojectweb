@extends('admin.layouts.app')
@section('title', 'Fit India Admin - All Freedomrun Organizer')
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
            <h1>Organizer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Organizer</li>
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
			  <button class="btn btn-success btn-sm dwl" name="download" value="download" onclick="window.location.href='freedomrun_export?ename={{ request()->input('event_name')}}&type=organizer&search=search';">
			  <i class="fa fa-download"></i> Download</button>			
			  </div>
			  <div class="col-md-10">
			  <form class="form-inline my-2 my-lg-0 rtside " type="get" action="{{ url('admin/freedomrun-organizer') }}">
                <div class="form-group rtside">
				</div>
              </form>  
				
            </div>
			</div> 
			<div class="row mt-2">
			<div class="col-md-6">
           		
			 Total Organizer : <strong> {{ $count }}</strong>			 
			</div>		
			<div class="col-md-6 rtside">
			  <form class="form-inline my-2 my-lg-0 rtside " type="get" action="{{ url('admin/freedomrun-organizer') }}">
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
		  <table class="table table-striped projects">
              <thead>
                  <tr class="thead-dark">
                    <th scope="col">#</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>					
					<th scope="col">Mobile No.</th>									
                    <th scope="col">Organiser</th>                   
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                  </tr>
               </thead>
              <tbody>
			<?php $i=0; ?>
             @if(count($organizer)>0)
                  @foreach($organizer as $freedom)				  
                  <tr>
                      <th scope="row">{{++$i}}</th>
					  <td>@if(!empty($freedom->fname)) {{ ucwords(strtolower($freedom->fname)) }}  @endif</td>
                      <td>@if(!empty($freedom->uemail)) {{ $freedom->uemail }} @endif</td>
                      <td>@if(!empty($freedom->phone)) <br>{{ $freedom->phone }}  @endif</td>
                      <td>@if(!empty($freedom->organiser_name)) <br>{{ $freedom->organiser_name }}  @endif</td>	
                      <td>@if(!empty($freedom->role)) <br>{{ $freedom->role }}  @endif</td>
					  <td style="width:120px;display:inline-flex !important;">  
                        &nbsp;<a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.freedomrun-organizer.orgedit', $freedom->id) }}"> <i class="fas fa-pencil-alt"></i></a>
                        &nbsp;&nbsp;<form action="{{ route('admin.freedomrun-organizer.odestroy', $freedom->id) }}" method="POST">
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
           {{ $organizer->links() }}
         </div>
         </div>
      </div>
        </div>
      </div>
	  </div>
      <div class="d-flex justify-content-center"></div>	
    </section>    
  </div>
@endsection





    
  