@extends('admin.layouts.app')
@section('title', 'Fit India Admin-All Posts')
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
            <h1>Push Notification</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"aria-current="page">Push Notification</li>
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
        <div class="col-md-12">
          <div class="col-12">
            <a href="{{ route('admin.pushnotification.create') }}"> <input type="submit" value="Create New Push Notification" class="btn btn-sm btn-success "> </a>
      
          </div>
            <div class="card-tools col-12 mt-2 text-start p-0">No of Push Notification: <strong>{{ $pushnotification_count }}</strong></div>
          @if($success != '')
            <div class="card-tools ">No of Push Notification Success: <strong class="">{{ $success ?? ''}}</strong></div>
            <div class="card-tools float-sm-left">No of Push Notification Failure: <strong>{{ $failure ?? ''}}</strong></div>
          @endif
        </div>
        <div class="col-md-10">
        <form class="form-inline my-2 my-lg-0 rtside" method="GET" action="{{ route('admin.pushnotification.index') }}">
                <div class="form-group rtside">

                  <!--<select class="custom-select custom-select mb-3" name="postcategory" id="category" style="width:180px" >
            <option value="">Select Category</option>

          </select>-->
          



                  <button type="search" name="search" value="search" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
                </div>
            </form>
          </div>
          </div>
        </div>
              <!-- /.card-header -->
          <div class="card-body table-responsive p-0">

          <table class="table table-striped projects">
              <thead >
                  <tr class="thead-dark">
                    <th scope="col">#</th>
                    <th scope="col">Title</th>

                    <th scope="col">Description</th>
                    <th scope="col" width="40px">Image</th>
                    <th scope="col">Action</th>
                    <th scope="col"></th>
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                @foreach ($pushnotification as $post)
                  <tr>
                    <th scope="row">{{++$i}}</th>


                    <td>{{ $post->message_title }}</td>
                    <td>{{ $post->message_description }}</td>
                    <td>
                        <img src= "{{ $post->message_file }}" width="70px">
                    </td>
                     <td style="width:120px;display:inline-flex !important;">
                        <a class="btn btn-info btn-xs" href="{{ route('admin.pushnotification.show',$post->id) }}"> <i class="fa fa-eye" title="View" aria-hidden="true"></i></a>&nbsp;&nbsp;
                        <a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.pushnotification.edit',$post->id) }}"> <i class="fas fa-pencil-alt"></i></a>
                        &nbsp;&nbsp;
                        <form action="{{ route('admin.pushnotification.destroy',$post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                         <button  style="display: inline !important;"class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Do you want to delete ?')"></i>&nbsp;</button>
                       </form>
                     </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>

         </div>
      </div>
        </div>
      </div>
      </div>
    </section>

  </div>
@endsection
