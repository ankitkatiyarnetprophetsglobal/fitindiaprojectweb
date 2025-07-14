@extends('admin.layouts.app')
@section('title', 'User cycle image - Fit India')
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
            <h1>User cycle image</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">User cycle image</li>
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
                  <div class="row" style="margin-right: -85px;">
                    <div class="col-md-2">
						 <div class="card-tools float-sm-left">User cycle image: <strong>{{ $userimagedate_count ?? '' }}</strong></div><br>
                    </div>
                    <div class="col-md-9">
                        <form class="form-inline my-2 my-lg-0 rtside " method="GET" action="{{ route('admin.userimages.index') }}">
                            <div class="form-group rtside">
                                <div class="form-group" style='margin-right:8px;'>
                                    <input type="text" name="searchuserimage" class="form-control " id="searchuserimage" value="{{ $searchuserimage ?? '' }}" placeholder="Search by name or mobile">
                                </div>
                                <button type="search" name="search" value="search" class="btn btn-primary btn-sm "><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
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
                    {{-- <th scope="col">User Id</th> --}}
                    <th scope="col">User name</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Image URL</th>
                    <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                @foreach ($userimagedate as $annu)
                <tr>
                    {{-- {{ dd($annu) }} --}}
                    <th scope="row">{{++$i}}</th>
                    {{-- <td>{{$annu->user_leaderboard_images_id ?? ''}}</td> --}}
                    <td>{{$annu->usersname ?? ''}}</td>
                    <td>{{$annu->phone ?? '' }}</td>
                    <td><img src= "{{$annu->user_cycle_image ?? ''}}" width="120px"></td>
                    <td>
                        @if($annu->status==1)
                            {{-- <span class="label label-success">Active</span> --}}
                            {{-- <a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.ReadyToPublish',$annu->id) }}"> --}}
                            <a style="display: inline !important; background-color:red;" class="btn btn-info btn-danger" href="{{ route('admin.userimageactive',encrypt($annu->user_leaderboard_images_id)) }}">
                                Reject
                            </a>

                        @else

                            <a style="display: inline !important;" class="btn btn-info" href="{{ route('admin.userimagedeactive', encrypt($annu->user_leaderboard_images_id)) }}">
                                Approved
                            </a>

                            {{-- <span class="label label-danger">Dective</span> --}}
                        @endif
                    </td>
                </tr>
                @endforeach
              </tbody>
          </table>

         </div>

        </div>

        </div>

        <table class="table table-striped projects">
            <thead>
                <th>
                    <div class="d-flex justify-content-center">
                        {{ $userimagedate->links() }}
                    </div>
                </th>
            </thead>
        </table>

      </div>
      </div>
    </section>
    <!-- /.content -->
</div>
@endsection
