@extends('kicadmin.layouts.app')
@section('title', 'SOC form - Fit India')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <a class="" href="{{ route('kicadmin.kicstoreform') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back</a>
            <h1>Update SOC Form</h1>
          </div>
          </div>
          {{-- {{ dd($data_edit) }} --}}
          {{-- {{ dd($data_edit->name_center) }} --}}
     <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('socadmin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('kicadmin.kicstoreform') }}">KIC form</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!--Main content-->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update SOC Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('kicadmin.kicupdateform') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('msg') }}
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
                                <input type="hidden" class="form-control" id="center_id" name="center_id" value="{{ encrypt($data_edit->id) }}">
                            </div>
                            <div class="form-group">
                                <label for="userEmail">Name of the center *</label>
                                <input type="text" class="form-control" id="name_center" name="name_center" value="{{ $data_edit->name_center ?? '' }}" placeholder="Name of the center">
                            </div>

                        <div class="form-group">
                          <label for="Date">Type of center:</label>
                          <input type="text" class="form-control" id="type_center" name="type_center" value="{{ $data_edit->type_center ?? '' }}" placeholder="Type of center">
                        </div>

                        <div class="form-group">
							              <label for="Date">Location:</label>
                            <input type="text" class="form-control" id="location" name="location" value="{{ $data_edit->location ?? '' }}" placeholder="Location" >
						            </div>

                        <div class="form-group">
							              <label for="Date">Date:</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ $data_edit->date ?? '' }}" placeholder="Date">
						            </div>

						            <div class="form-group">
                            <div class="form-row">
                                <div class="col col-md-6">
                                    <label for="title">Cycling route <span style="color: red">*</span></label>
                                    <input type="text" id="cycling_route_start_date" name="cycling_route_start_date" class="form-control"  placeholder="Cycling Route Start From" value="{{ $data_edit->cycling_route_start_from ?? '' }}">
                                </div>

                                <div class="col col-md-6">
                                    <label for="title">&nbsp;</label>
                                    <input type="text" id="cycling_route_end_date" name="cycling_route_end_date" class="form-control" id="link" placeholder="Cycling Route End" value="{{ $data_edit->cycling_route_end ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                          <label for="Date">Number of participants:</label>
                          <input type="text" class="form-control" id="number_participants" name="number_participants" value="{{ $data_edit->number_participants ?? '' }}" placeholder="Number Of Participants">
						            </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Upload photo:</label>
                                        <div class="multiple_image_section">
                                            <div class="um-field">
                                                <div class="um-field-label">
                                                    {{-- <label for="eventimage1">Add Event Picture (optional) <span style="opacity: 50%">(Maximum file size less than 2 MB, file must be .png,.jpg,.jpeg)</span></label> --}}
                                                    <div class="um-clear"></div>
                                                </div>
                                                {{-- {{ dd($media_data) }} --}}
                                                @foreach ($media_photo_data as $photo_row)
                                                  <div class="um-field-area">
                                                      {{-- <input type="hidden" class="form-control" id="photo_update_id" name="photo_update_id[]" value="{{ encrypt($photo_row->id) }}"> --}}
                                                      <input type="text" class="form-control" id="photo_update_id" name="photo_update_id[]" value="{{ $photo_row->id }}">
                                                      <input type="file" id="prt_image" name="prt_image[]" class="form-control">
                                                      {!!$errors->first("prt_image", "<span class='text-danger'>:message</span>")!!}
                                                  </div>
                                                  <br/>
                                                  <img src="{{ $photo_row->photo ?? asset('resources/imgs/fit-india_logo.png')}}" style="width: 120px;height: 66px;" alt="FIT INDIA" class="fluid-img child_div fitindialong">
                                                  <br/>
                                                  <br/>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="addmore">
                                            <a id="add_org_image" href="javascript:void(0)">+ Add More</a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete_org_image" href="javascript:void(0)">Delete</a>
                                        </div>
                        </div>
                        <div class="form-group">
                            <div class="multiple_video_section">
                                <div class="um-field">
                                    <div class="um-field-label">
                                        <label for="eventimage1">Add Event Video Link</label>
                                        <div class="um-clear"></div>
                                    </div>
                                    <div class="um-field-area">
                                        @foreach ($media_video_data as $video_row)
                                          <div class="um-field-area">
                                              <input type="url" id="video_link" name="video_link[]" value="{{ $video_row->video_link ?? '' }}" class="form-control" placeholder="Event Video Link">
                                              <span>For Example from Youtube , Facebook etc.</span>
                                              <br/>
                                              <br/>
                                          </div>

                                        @endforeach
                                        {{-- <input type="url" id="video_link" name="video_link[]" class="form-control" placeholder="Event Video Link">
                                        <span>For Example from Youtube , Facebook etc.</span> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="addmore">
                                <a id="add_org_video" href="javascript:void(0)">+ Add More</a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete_org_video" href="javascript:void(0)">Delete</a>
                            </div>
                        </div>
                        <div style="clear:both"></div>

						<div class="form-group">
							<label for="exampleInputEmail1">Status:</label>
							<input type="radio" name="status" value="1" checked>Active
                            <input type="radio" name="status" value="0"> In Active
						</div>
					</div>
					<!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Update</button>
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

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script>
    var from_date='';

		$(document).ready(function() {

			$("#delete_org_image").hide();
			$("#delete_org_video").hide();
			//when the Add Field button is clicked

            var i = 2;
			$("#add_org_image").click(function(e) {

				$("#delete_org_image").fadeIn("1500");
				//Append a new row of code to the "#items" div
				$(".multiple_image_section").append('<div class="um-field org_img_section"><div class="um-field-label"><label for="eventimage1">Add Event Picture (optional) <span style="opacity: 50%">(Maximum file size less than 2 MB, file must be .png,.jpg,.jpeg)</span></label><div class="um-clear"></div></div><div class="um-field-area"><input type="file" name="prt_image[]"  class="form-control"></div></div>');
			    i++;
			});

			$("body").on("click", "#delete_org_image", function(e) {
			    $(".org_img_section").last().remove();
			    if($(".org_img_section").length==0){
			    	$('#delete_org_image').hide();
			    }
			});

			var j = 2;
			$("#add_org_video").click(function(e) {
				$("#delete_org_video").fadeIn("1500");
				//Append a new row of code to the "#items" div
				$(".multiple_video_section").append('<div class="um-field org_video_section"><div class="um-field-label"><label>Add Event Video Link (optional)</label><div class="um-clear"></div></div><div class="um-field-area"><input type="url" name="video_link[]" class="form-control" placeholder="Event Video Link"><span>For Example from Youtube , Facebook etc.</span> </div></div>');
				j++;
			});


			$("body").on("click", "#delete_org_video", function(e) {
			    $(".org_video_section").last().remove();
			    if($(".org_video_section").length==0){
			    	$('#delete_org_video').hide();
			    }
			});


	});
  </script>
@endsection
