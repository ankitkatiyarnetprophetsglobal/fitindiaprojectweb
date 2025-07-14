@extends('kicadmin.layouts.app')
@section('title', 'Fit India Admin - All Users')
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
            <h1>Create Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('socadmin.dashboard') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Users</li>
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
		   <div class="card">
             <div class="card-header">
			  <div class="row">
			  <div class="col-md-2">
			  <button class="btn btn-success btn-sm dwl" name="download" value="download" onclick="window.location.href='user_export?uname={{ request()->input('user_name')}}&st={{ request()->input('state')}}&dst={{ request()->input('district')}}&blk={{ request()->input('block')}}&month={{ request()->input('month')}}&role={{ request()->input('role')}}&search=search';">
			  {{-- <a href="{{ route('admin.bulletin.create') }}"> <input type="submit" value="Create New Bulletin" class="btn btn-success btn-sm float-left"> </a> --}}
			  <a href="{{ route('kicadmin.kiccreateform') }}"> <input type="submit" value="Create KIC" class="btn btn-success btn-sm float-left"> </a>
			  </div>
			  <div class="col-md-10">
			  {{-- <form class="form-inline my-2 my-lg-0 rtside " type="get" action="{{ route('admin.users.index') }}">
                <div class="form-group rtside">
					<select class="custom-select custom-select mb-3" name="role"  style="width:130px" >
                        <option value="">Select State</option>
				    </select>
					<select class="custom-select custom-select mb-3" name="state" id="youth_state" style="width:130px" >
						<option value="">Select State</option>
					</select>
					<select class="custom-select custom-select mb-3" name="district" id="youth_district" style="width:140px" >
						<option value="">Select District</option>
					</select>
					<select class="custom-select custom-select mb-3" name="block" id="youth_block" style="width:130px" >
					  <option value="">Select Block</option>
					</select>
					<input type="month" id="month" name="month" class="form-control mb-3"  style="padding:2px;width:170px !important; margin-right:2px;">

					<button type="submit" name="searchdata" value="searchdata" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
                </div>
              </form> --}}
            </div>
			</div>
			<div class="row mt-2">
			<div class="col-md-6">
			  {{-- Total users <strong>{{ $curcount }}/{{ $count }}</strong> --}}
			</div>

			<div class="col-md-6 rtside">
			  <form class="form-inline my-2 my-lg-0 rtside " type="get" action="{{ route('admin.users.index') }}">
                <div class="form-group rtside">
                    @php
                        if(!empty($_REQUEST['user_name'])&& $_REQUEST['user_name']!=''){

                            $uname=$_REQUEST['user_name'];

                        }else{
                            $uname='';
                        }
                    @endphp
				<!--<input type="search" name="user_name" <?//=$uname?> class="form-control" placeholder="user email/name/mobile "  value="<?//=$uname?>" width="200px">-->
			    <input type="search" name="user_name" <?=$uname?> class="form-control" placeholder="Name/Email/Phone" value="<?=$uname?>" width="200px">
				<button type="submit" class="btn btn-primary btn-sm" name="search" value="search"><i class="fa fa-search" aria-hidden="true"></i></button>
			  </div>
             </form>
			</div>
			</div>

              </div>
              <!-- /.card-header -->
              {{-- {{ dd($data_master) }} --}}


                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-striped projects">
                        <thead>
                            <tr class="thead-dark">
                                <th scope="col">#</th>
                                <th scope="col">Name Center</th>
                                <th scope="col">Type Center</th>
                                <th scope="col">Location</th>
                                <th scope="col">Date</th>
                                <th scope="col">Cycling Start From</th>
                                <th scope="col">Cycling Route End</th>
                                <th scope="col">Number Participants</th>
                                    {{-- @if(!in_array($admins_role, array(2,3))) --}}
                                <th scope="col">Action</th>
                                {{-- @endif --}}
                            </tr>
                        </thead>
                            @if(count($data_master)>0)
                                @foreach($data_master as $row_data)
                                    <tr>
                                        <th scope="row">{{($data_master->currentPage() - 1) * $data_master->perPage() + $loop->iteration}}</th>
                                        <td>{{ $row_data->name_center ?? "" }}</td>
                                        <td>{{ $row_data->type_center ?? "" }}</td>
                                        <td>{{ $row_data->location ?? "" }}</td>
                                        <td>{{ $row_data->date ?? "" }}</td>
                                        <td>{{ $row_data->cycling_route_start_from ?? "" }}</td>
                                        <td>{{ $row_data->cycling_route_end ?? "" }}</td>
                                        <td>{{ $row_data->number_participants ?? "" }}</td>
                                        <td style="width:100px;display:contents !important;">&nbsp;&nbsp;
                                            @php
                                                $id = encrypt($row_data->id);
                                            @endphp
                                            <a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ url('socadmin/kicformedit', $id) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>&nbsp;
                                            <button  style="display: inline !important;"class="btn btn-danger btn-xs" type="submit" onclick="return confirm('Do you want to delete ?')">
                                                <a style="display: inline !important;" class="btn btn-danger btn-xs"  href="{{ url('admin/user-destroy',[ 'id' => $row_data->id ]) }}" >
                                                    <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;
                                                </a>
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- {{ dd($row_data)  }} --}}
                                    {{-- {{ dd($row_data->name_center)  }} --}}
                                    {{-- {{ dd($row_data->type_center)  }} --}}
                                    {{-- {{ dd($row_data->location)  }} --}}
                                    {{-- {{ dd($row_data->date)  }} --}}
                                    {{-- {{ dd($row_data->cycling_route_start_from)  }} --}}
                                    {{-- {{ dd($row_data->cycling_route_end)  }} --}}
                                    {{-- {{ dd($row_data->number_participants)  }} --}}
                                @endforeach
                            @endif
                        <tbody>
                        </tbody>
                </table>
            </div>
        </div>
      </div>
      </div>
	  </div>
        <div class="d-flex justify-content-center">
            {{ $data_master->appends(request()->input())->links() }}
        </div>

    </section>
    <!-- /.content -->
  </div>


@endsection














































