@extends('admin.layouts.app')
@section('title', 'Create Post Notification - Fit India')
@section('content')
<style>
.mb-3{ margin-bottom: 0 !important; margin-right: 10px; }
.btn-sm{ padding: .375rem .75rem; }
.rtside{ float:right; }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <a class="" href="{{ route('admin.pushnotification.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
            <h1 scope="col">Add Push Notification</h1>
          </div>
		</div>

		<div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
                <div class="pull-right">

                </div>
            </ol>
          </div>

		  <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.pushnotification.index') }}">Push Notification</a></li>
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
                <h3 class="card-title">Add Push Notification</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.pushnotification.store') }}" enctype="multipart/form-data">
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
                                <label for="exampleInputEmail1" scope="col"> Message Title: *</label>
                                <input type="text" name="title" class="form-control" id="title" value="{{ old('title')}}" placeholder="Enter Title">
                            </div>
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1" scope="col">Post Category:*</label>
                                  @if(!empty($post_cat))
                                    @foreach($post_cat as $cat)
									<input type="checkbox" name="post_category[]" value="{{ $cat->name }}"  {{ (is_array(old('post_category')) && in_array($cat->name, old('post_category'))) ? ' checked' : '' }}> {{ $cat->name }}
									@endforeach
                                  @endif
                                </select>
                            </div> --}}

							<?php //{{ (in_array(old('post_category')) && in_array($cat->name,old('post_category'))) ? 'checked':'' }}?>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Message Description:*</label>
                                <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Post Notification Image:*</label>

                                <input type="file" id="readUrl" name="image" class="form-control" placeholder="Post notification  Image">
                                <label for="exampleInputEmail1" >**File size should not be more than 200kB</label>

                                <img id="uploadedImage" src="#" alt="uploadImage" width=100px height=100px  style="display:none;">
                                <label for="exampleInputEmail1" id="file_size" ></label>
                                <label for="exampleInputEmail1" class="btn btn-sm btn-danger" id="remove_file" style="display:none;">Remove Image</label>

                            </div>
                        </div>
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
  <script >

    document.getElementById('readUrl').addEventListener('change',function(){
        console.log(this.files[0]);


        if(this.files[0]){
            var file_name=this.files[0];
            var file_size=(this.files[0].size/1000);

            var picture=new FileReader();
            picture.readAsDataURL(this.files[0]);
            console.log(picture);
            picture.addEventListener('load',function(event){
                console.log(event.target);

                document.getElementById('uploadedImage').setAttribute('src',event.target.result);
                document.getElementById('uploadedImage').style.display='block';
                document.getElementById('remove_file').style.display='inline-block';

                if(file_size<200){
                document.getElementById('file_size').innerHTML=`File size acceptable,Your File Size is ${file_size}KB`;
                document.getElementById('file_size').style.color='green';
                document.getElementById('file_size').style.display="block";


                }else{
                    document.getElementById('file_size').innerHTML=`File size not acceptable,Your File Size is ${file_size}KB`;
                     document.getElementById('file_size').style.color='red';
                }
            });
            document.getElementById('remove_file').addEventListener("click",function remove_image(e){

                document.getElementById('readUrl').value="";
            document.getElementById('uploadedImage').style.display="none";
            document.getElementById('file_size').style.display="none";
            document.getElementById('remove_file').style.display='none';

           });
        }


    });


</script>
@endsection
