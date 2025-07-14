@extends('admin.layouts.app')
@section('title', ' Fit India Admin-Show Posts Category')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<section class="content-header">
      <div class="container-fluid">
	      <div class="row mb-2">
          <div class="col-sm-6">
			      <a class="" href="{{ route('admin.pushnotification.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
            <h1>Show Push Notification</h1>
          </div>
        </div>
        {{-- <select class="custom-select custom-select mb-3" name="role"  style="width:130px" > --}}
            <?php
            //  $mobile='<option value="">Select Role</option>';
            ?>
             {{-- @foreach($roles as $role) --}}
               <?php
                //  if(!empty($_REQUEST['role'])&& $_REQUEST['role']==$role->slug){
                //    $stselect='selected';
                //  }else{
                //    $stselect='';
                //  }

                // $mobile.='<option data-name='.$role->id.' '.$stselect.' value='.$role->slug.'>'.ucwords(strtolower($role->name)).'</option>';
              ?>
             {{-- @endforeach --}}
              <?php              
              //  $mobile.='<option value="Mobile" '.((!empty($_REQUEST['role'])&& $_REQUEST['role']=='Mobile') ? 'selected="selected"' : '').'>Mobile</option>';
              //  echo $mobile;
              ?>
            {{-- </select> --}}
            {{-- @if($admins_role != '3') --}}
					{{-- <select class="custom-select custom-select mb-3" name="state" id="youth_state" style="width:130px" > --}}
						{{-- <option value="">Select State</option> --}}
					   {{-- @foreach($states as $state) --}}
                   <?php
                    //  if(!empty($_REQUEST['state'])&& $_REQUEST['state']==$state->name){
                    //    $stselect='selected';
                    //  }else{
                    //    $stselect='';
                    //  }
                    ?>
							{{-- <option data-name="{{ $state->id }}" 
                <?php 
                // echo $stselect 
                ?> 
                value="{{ $state->name }}">{{ $state->name }}</option> --}}
					   {{-- @endforeach --}}
					{{-- </select> --}}


					{{-- @endif --}}


					{{-- <select class="custom-select custom-select mb-3" name="district" id="youth_district" style="width:140px">
						<option value="">Select District</option> --}}
						{{-- @foreach($districts as $district) --}}
            <?php
                    //  if(!empty($_REQUEST['district'])&& $_REQUEST['district']==$district->name){
                    //    $dstselect='selected';
                    //  }else{
                    //    $dstselect='';
                    //  }
                    ?>
					{{-- <option data-disname="{{ $district->id }}" 
              <?php 
                // echo $dstselect
              ?>  value="{{ $district->name }}">{{ $district->name }}</option> --}}
					{{-- @endforeach --}}
					{{-- </select> --}}

					{{-- <select class="custom-select custom-select mb-3" name="block" id="youth_block" style="width:130px" >
					  <option value="">Select Block</option> --}}
						{{-- @foreach($blocks as $block) --}}
						<?php
						  //  if(!empty($_REQUEST['block'])&& $_REQUEST['block']==$block->name){
							//  $blkselect='selected';
						  //  }else{
							//  $blkselect='';
						  //  }

						  // $block_name=ucwords(strtolower($block->name));
						?>
							{{-- <option data-disname="{{ $block->id }}"  
                <?php 
                  // echo $blkselect
                ?> value="{{ $block->name }}">{{ ucwords(strtolower($block_name)) }}</option> --}}
					   {{-- @endforeach --}}
					{{-- </select> --}}


        <!--<div class="row mb-2">
          <div class="col-sm-12">
            <h1>Show Posts</h1>
          </div>
		    </div>-->

    		<div class="row mb-2">
    		  <div class="col-sm-6">
    		    <div class="pull-right">
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item "><a href="{{ route('admin.pushnotification.index') }}">Push Notification</a></li>
                  <li class="breadcrumb-item active">Show Push Notification</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <hr>
    <section class="content-header">
      <div class="container-fluid">
        <!-- <div class="row">
          <div class="col-md-12">

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">show posts</h3>
              </div>
            </div>
          </div>
		    </div> -->

<!--  <div class="e_img">
             <img src="{{asset('resources/imgs/Fit-India-Dialogue-banner.jpg') }}" />
        </div> -->
      <form action="{{ url('admin/sendingwebnotification') }}" method="POST" enctype="multipart/form-data">  
        @csrf
	      <div class="row ml-3">
      		<div class="col-md-12">
      		  <div class="card">
                  <div class="card-header card-primary bg_blue">
                  <h3 class="card-title">Show Push Notification</h3>
                </div>
                @if($post->message_file != '')
                  <div class="e_img" style="padding-left: 244px;">
                    <img src="{{ $post->message_file}}" class="card-img-top">
                    <input type="hidden" class="form-control" name="image_file" value="{{ $post->message_file }}">
                  </div>
                @endif
      			  <div class="card-body">
      				<h5 class="card-title">Title : <b>{{ $post->message_title }}</b></h5>
              <input type="hidden" class="form-control" name="title" value="{{ $post->message_title }}">								
      				  <p class="card-text"></p>
      			  </div>

      			  <ul class="list-group list-group-flush">
        				<li class="list-group-item">Message Description :<b>{{ $post->message_description }}</b></li>                
                <input type="hidden" class="form-control" name="body" value="{{ $post->message_description }}">
                <li class="list-group-item">Created at: {{ date('d-m-y', strtotime($post->created_at)) }}</li>
                <li class="list-group-item">Updated at: {{ date('d-m-y', strtotime($post->updated_at)) }}</li>
      			  </ul>
      			</div>
      		</div>
        </div>
        <button type="submit" class="btn btn-success btn-block">Send Notification</button>
      </form>
	  </div>
    </section>
  </div>
@endsection
