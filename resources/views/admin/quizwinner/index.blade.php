@extends('admin.layouts.app')
@section('title', 'Fit India Admin - Quiz Winners')
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
            <h1>Quiz Winners</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Quiz Winners</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>    
    <section class="content">
	<div class="container-fluid">	
        <div class="row">
          <div class="col-md-12">
			@if (session('status'))
			  <div class="alert alert-success">
				  {{ session('msg') }}
			  </div>
			@endif		
			
		  <div class="card">		   
		   <div class="card-header">			  
		     <div class="row">
			  <div class="col-md-2">  
				<button class="btn btn-success btn-sm dwl" name="download" value="download" onclick="window.location.href='quiz_winner_export?uname={{ request()->input('user_name')}}&org={{ request()->input('quizwinners')}}&st={{ request()->input('state')}}&month={{ request()->input('month')}}&role={{ request()->input('role')}}&search=search';">
				 <i class="fa fa-download"></i> Download</button>				 
			  </div>
			  <div class="col-md-10">
			  <form class="form-inline my-2 my-lg-0 rtside" type="get" action="{{ route('admin.quizwinners.index') }}">
                <div class="form-group rtside">
					<select class="custom-select custom-select mb-3" name="state" id="quiz_state" style="width:130px" >
					  <option value="">Select State</option>       
					   @foreach($states as $state)
						<?php
						 if(!empty($_REQUEST['state'])&& $_REQUEST['state']==$state->name){
						   $stselect='selected';
						 }else{
						   $stselect='';
						 }
						?>     
						<option data-name="{{ $state->id }}" <?=$stselect?> value="{{ $state->name }}">{{ $state->name }}</option> 
					   @endforeach					  
					</select>					
					<select class="custom-select custom-select mb-3" name="quizwinners" id="quizwinners" style="width:175px" >
					  <option value="">Select Partner</option>       
					   <?php
					    if(!empty($partnerdata)){
					      foreach($partnerdata as $pdata){
                            if(!empty($_REQUEST['quizwinners'])&& $_REQUEST['quizwinners']==$pdata->uid){
							   $ptselect='selected';
							 }else{
							   $ptselect='';
							 }
						  ?>						 
						   <option <?=$ptselect?> value="{{ $pdata->uid }}">{{ ucwords(strtolower($pdata->uname)) }} </option> 						
						<?php } } ?> 
                     </select>
					<input type="month" id="month" name="month" class="form-control mb-3" style="width:175px !important;padding:2px; margin-right:1px;">
					<button type="submit" name="searchdata" value="searchdata" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
                </div>
				
              </form>				
            </div>
			</div> 
			<div class="row mt-2">  
			<div class="col-md-6">
			  <?php
			    $curcount=(!empty($count)&& empty($curcount)) ? $curcount=$count : $curcount;  
			  ?>
			  Total Quiz Winners : <strong>{{ $curcount }}/{{ $count }}</strong>			 
			</div>
        
			<div class="col-md-6 rtside">
			  <form class="form-inline my-2 my-lg-0 rtside " type="get" action="{{ route('admin.quizwinners.index') }}">
                <div class="form-group rtside">
                  <?php
             if(!empty($_REQUEST['user_name'])&& $_REQUEST['user_name']!=''){
              
               $uname=$_REQUEST['user_name'];

             }
             else{

               $uname='';
             }
            ?> 
				<input type="search" name="user_name" <?=$uname?> class="form-control" placeholder="Name/Email/Mobile"  value="<?=$uname?>" width="200px">
			
				<button type="submit" class="btn btn-primary btn-sm" name="search" value="search"><i class="fa fa-search" aria-hidden="true"></i></button>
				
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
					<th scope="col">Participant Name </th>
					<th scope="col">Quiz Organizer</th>
					<th scope="col">Email & Mobile</th>
					<th scope="col">State/City</th>	
                    <th scope="col">Score</th>
                    <th scope="col">Date </th>
                  </tr>
               </thead> 
              <tbody>              
			  @if(count($user)>0)
              @foreach($user as $users)			 
                  <tr>
					<th scope="row">{{($user->currentPage() - 1) * $user->perPage() + $loop->iteration}}</th>
					<td>{{ $users->name }}</td>
					<td>{{ $users->partner }}</td>
					<td>{{ $users->email }} <br> {{$users->mobile}}</td>					
					<td>@if(!empty($users->state)) {{ ucwords(strtolower($users->state)) }} @endif 
					    <br>{{ucwords(strtolower($users->city)) }}</td>                    
					<td>{{ $users->score }}</td>                    
					<td>{{ date('Y-m-d',strtotime($users->createdOn)) }}</td>                    
                  </tr>
                  @endforeach 
				  @endif
              </tbody>
          </table>
         </div>
       </div>
      </div>
      </div>
	  </div>
    <div class="d-flex justify-content-center">
       {{ $user->appends(request()->input())->links() }}
     </div>
    </section>   
  </div>

@endsection














































