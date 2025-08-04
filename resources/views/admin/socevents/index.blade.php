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
            <h1>Upload Event Schedule</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"aria-current="page">Upload Event Schedule</li>
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
                        {{-- <div class="col-md-2"> --}}
                            @if(Auth::user()->role_id != 9)
                                {{-- <a href="{{ route('admin.posts.create') }}">
                                    <input type="submit" value="Upload new file" class="btn btn-sm btn-success float-left">
                                </a> --}}
                            @endif
                        {{-- <div class="card-tools float-sm-left">No of socevents: <strong>{{ $post_count ?? "" }}</strong></div><br> --}}
                        {{-- </div> --}}
                        {{-- @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif --}}


                        <ul style="list-style: none">
                            @foreach ($errors->all() as $error)
                                <li style="color:red;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('admin.socevents.store') }}" enctype="multipart/form-data">
                            @csrf
                            <a class="mb-2 text-right d-block" href="{{url('wp-content/uploads/excel/example.xlsx/')}}">Click here to download sample excel file</a>
                            <div class="form-group mb-4">
                                <div class="custom-file text-left">
                                    <input type="file" name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <button class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>

            </div>
              <!-- /.card-header -->
          <div class="card-body table-responsive p-0">

          <table class="table table-striped projects">
              <thead>

              </thead>
              <tbody>
              <?php $i=0; ?>
                @if(isset($main_array) && count($main_array) > 0)
                    <tr class="thead-dark">
                        <th colspan="5" style="text-align: center;">Blank error</th>
                    </tr>
                    <tr class="thead-dark">
                        {{-- <th scope="col" width="5%">#</th> --}}
                        <th scope="col" width="15%">Event Venue</th>
                        <th scope="col" width="15%">Cycle Count</th>
                        <th scope="col" width="20%">T Shirt Count</th>
                        <th scope="col" width="20%">Meal Count</th>
                        <th scope="col" width="20%">Event Date(YYYY-MM-DD)</th>
                        {{-- <th scope="col" width="15%">latitude</th>
                        <th scope="col" width="40px">longitude</th>
                        <th scope="col" width="15%">event_date</th> --}}
                        {{-- @if(Auth::user()->role_id == 9)
                            <th scope="col" width="25%">Comment Count</th>
                        @endif
                        <th scope="col" width="25%">Action</th> --}}
                        {{-- <th scope="col"></th> --}}
                    </tr>
                    <tr>
                        @foreach ($main_array as $cycle_array)
                            <td>
                                @foreach ($cycle_array as $cycle_array_values => $value_cycle)
                                    @foreach ($value_cycle as $error_cycle_value)
                                        <p style="color:red;">
                                            {{ $error_cycle_value ?? '' }}<br />
                                        </p>
                                    @endforeach
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endif

              <thead>
                  {{-- <tr class="thead-dark">
                    <th scope="col" width="15%">venue</th>
                    <th scope="col" width="15%">cycle</th>
                    <th scope="col" width="20%">t_shirt</th>
                    <th scope="col" width="20%">meal</th>
                    <th scope="col" width="20%">Date</th> --}}
                    {{-- <th scope="col" width="15%">latitude</th>
                    <th scope="col" width="40px">longitude</th>
                    <th scope="col" width="15%">event_date</th> --}}
                    {{-- @if(Auth::user()->role_id == 9)
                      <th scope="col" width="25%">Comment Count</th>
                    @endif
                    <th scope="col" width="25%">Action</th> --}}
                    {{-- <th scope="col"></th> --}}
                  {{-- </tr> --}}
              </thead>
              <?php $i=0; ?>
                @if(isset($main_array_error) && count($main_array_error) > 0)
                    <tr class="thead-dark">
                        <th colspan="5" style="text-align: center;">Error in text</th>
                    </tr>
                    <tr class="thead-dark">
                        {{-- <th scope="col" width="5%">#</th> --}}
                        <th scope="col" width="15%">Event Venue</th>
                        <th scope="col" width="15%">Cycle Count</th>
                        <th scope="col" width="20%">T Shirt Count</th>
                        <th scope="col" width="20%">Meal Count</th>
                        <th scope="col" width="20%">Event Date(YYYY-MM-DD)</th>
                        {{-- <th scope="col" width="15%">latitude</th>
                        <th scope="col" width="40px">longitude</th>
                        <th scope="col" width="15%">event_date</th> --}}
                        {{-- @if(Auth::user()->role_id == 9)
                            <th scope="col" width="25%">Comment Count</th>
                        @endif
                        <th scope="col" width="25%">Action</th> --}}
                        {{-- <th scope="col"></th> --}}
                    </tr>
                    <tr>
                        <td></td>
                        @foreach ($main_array_error as $error_array)

                            <td>
                                @foreach ($error_array as $error_array_values => $value_error)
                                    @foreach ($value_error as $all_error_cycle_value)
                                        <p style="color:red;">
                                            {{ $all_error_cycle_value ?? '' }}<br />
                                        </p>
                                    @endforeach
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endif

                {{-- @if(isset($main_array) && count($main_array) > 0)
                    <tr>
                        <td></td>
                        <td></td>
                        @foreach ($main_array as $cycle_array)
                            <td>
                                @foreach ($cycle_array as $cycle_array_valuse => $value_cycle)
                                        @foreach ($value_cycle as $error_cycle_value)
                                           <p style="color:red;">@php echo $error_cycle_value; echo '<br/>'; @endphp </p>
                                        @endforeach
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endif --}}

              </tbody>
          </table>
          <div class="d-flex justify-content-center">

         </div>
         </div>
      </div>
        </div>
      </div>
      </div>
    </section>

  </div>
@endsection
