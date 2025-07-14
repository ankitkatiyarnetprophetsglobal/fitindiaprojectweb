@extends('admin.layouts.app')
@section('title', 'Fit India Admin-Edit Posts')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
     <div class="row mb-2">
      <div class="col-sm-12">
		<a class="" href="{{ route('admin.pushnotification.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
      <h1>Edit Posts</h1>
      </div>
     </div>
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.pushnotification.index') }}"><strong>posts</strong></a></li>

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
                <h3 class="card-title">Edit Posts</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.pushnotification.update', $post->id) }}" enctype="multipart/form-data">
                      @csrf
                       @method('PATCH')
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
                            <label for="exampleInputEmail1">Message Title:*</label>
                            <input type="text" name="title"  value="{{ $post->message_title }}" class="form-control" id="title" placeholder="Enter Title">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Message Description:*</label>
                            <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $post->message_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Post Notification Image:*</label>

                            <input type="file" id="readUrl1" name="image" class="form-control" placeholder="Post notification  Image">
                            <label for="exampleInputEmail1" >**File size should not be more than 200kB</label>
                             <div>
                            <img id="uploadedImage1" src="{{ $post->message_file }}" alt="uploadImage" width=100px height=100px>
                             </div>
                            <label for="exampleInputEmail1" id="file_size1" ></label>
                            <label for="exampleInputEmail1" class="btn btn-sm btn-danger" id="remove_file1" style="display:inline-block;margin-top:20px;">Remove Image</label>

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
  <script >

    document.getElementById('readUrl1').addEventListener('change',function(){
        console.log(this.files[0]);


        if(this.files[0]){
            var file_name=this.files[0];
            var file_size1=(this.files[0].size/1000);

            var picture=new FileReader();
            picture.readAsDataURL(this.files[0]);
            console.log(picture);
            picture.addEventListener('load',function(event){
                console.log(event.target);

                document.getElementById('uploadedImage1').setAttribute('src',event.target.result);
                document.getElementById('uploadedImage1').style.display='block';
                document.getElementById('remove_file1').style.display='inline-block';

                if(file_size1<200){
                document.getElementById('file_size1').innerHTML=`File size acceptable,Your File Size is ${file_size1}KB`;
                document.getElementById('file_size1').style.color='green';
                document.getElementById('file_size1').style.display="block";


                }else{
                    document.getElementById('file_size1').innerHTML=`File size not acceptable,Your File Size is ${file_size1}KB`;
                     document.getElementById('file_size1').style.color='red';
                }
            });

        }


    });
    document.getElementById('remove_file1').addEventListener("click",function remove_image(e){

  document.getElementById('readUrl1').value="";
  document.getElementById('uploadedImage1').style.display="none";
  document.getElementById('file_size1').style.display="none";
  document.getElementById('remove_file1').style.display='none';

});


</script>

@endsection
