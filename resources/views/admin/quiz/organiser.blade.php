@extends('admin.layouts.app')
@section('title', 'Fit India Admin - Quiz Organizers')
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
				<h1> Quiz Organizers</h1>
			  </div>
			  <div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
				  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page"> Quiz Organizers</li>
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
				<button class="btn btn-success btn-sm dwl" name="download" value="download" onclick="window.location.href='quiz-organizers-export?uname={{ request()->input('user_name')}}&search=search';">
				 <i class="fa fa-download"></i> Download</button>				 
			  </div>
			  <div class="col-md-10">
			 				
            </div>
			</div>
			
				<div class="row mt-2">  
				<div class="col-md-6">							 
				</div>
			
				<div class="col-md-6 rtside">
				  <form class="form-inline my-2 my-lg-0 rtside " type="get" action="{{ route('admin.quizorganizer') }}">
					<div class="form-group rtside">
						<?php
						 if(!empty($_REQUEST['user_name'])&& $_REQUEST['user_name']!=''){ $uname=$_REQUEST['user_name']; }
						 else{ $uname=''; }
						?> 
						<input type="search" name="user_name" <?=$uname?> class="form-control" placeholder=" Name/Email/Mobile" value="<?=$uname?>" width="200px">
						<button type="submit" class="btn btn-primary btn-sm" name="search" value="search"><i class="fa fa-search" aria-hidden="true"></i></button>
					</div>
				  </form>  					
				</div>
				</div>
						  
				  </div>
				  <!-- /.card-header -->				  
				 <?php			
					
					function quizencrypt($key, $iv, $data) {
						$OPENSSL_CIPHER_NAME = "aes-128-cbc"; 
						$CIPHER_KEY_LEN = 16;
						if (strlen($key) < $CIPHER_KEY_LEN) {
							$key = str_pad("$key", $CIPHER_KEY_LEN, "0"); 
						} else if (strlen($key) > $CIPHER_KEY_LEN) {
							$key = substr($str, 0, $CIPHER_KEY_LEN); 
						}
						
						$encodedEncryptedData = base64_encode(openssl_encrypt($data, $OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv));
						return $encodedEncryptedData;
					}
					
					$iv = "fedcba9876543210"; 
					$key = "0a9b8c7d6e5f4g3h"; 						
	
				 ?>
			  <div class="card-body table-responsive p-0">			  
				<table class="table table-striped projects">
				  <thead>
					  <tr class="thead-dark">
						<th scope="col">#</th>
						<th scope="col">Organiser's Name </th>
						<th scope="col">Email</th>
						<th scope="col">Mobile</th>
						<th scope="col">Quiz Link</th>
						<th scope="col">Registered On </th>
						<th scope="col">Action </th>
					  </tr>
				   </thead>
				  <tbody>               
				  @if(count($organisers)>0)
				  @foreach($organisers as $users)			 
					  <tr>
						<th scope="row">{{($organisers->currentPage() - 1) * $organisers->perPage() + $loop->iteration}}</th>
						<td>{{ $users->name }}</td>
						<td>{{ $users->email }}</td>
						<td>{{$users->mobile}}</td>	
						<td>
							<?php $encrypted = quizencrypt($key, $iv, $users->id);  ?>
							<a href="{{ url('/road-to-tokyo-2020/'.$encrypted ) }}" target="_blank" > View</a> </td>
						<td>{{ date('Y-m-d',strtotime($users->createdOn)) }}</td>
						<td>
						<button style="display: inline !important;" class="btn btn-danger btn-xs" type="submit" onclick="return confirm('Do you want to Disable ?')"> 
						<a style="display: inline !important;" class="btn btn-danger btn-xs" href="{{ route('admin.deletequizorg', $users->id)}}"> <i class="fa fa-ban" aria-hidden="true"></i>&nbsp;</a> 
						</button>
						
						
						</td>						
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
		   {{ $organisers->appends(request()->input())->links() }}
		</div>
    </section>   
  </div>

@endsection














































