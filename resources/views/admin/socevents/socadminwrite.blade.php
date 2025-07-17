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
            <h1>SOC Admin(Mobile) Permission</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"aria-current="page">SOC Admin(Mobile) Permission</li>
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
          <div class="col-md-2">
              @if(Auth::user()->role_id != 9)
                <a href="{{ route('admin.socadmin-create-write') }}">
                  <input type="submit" value="Create New Admin" class="btn btn-sm btn-success float-left">
                </a>
              @endif
              <div class="card-tools float-sm-left">No of Posts: <strong>{{ $distributionpermissions_count ?? '' }}</strong></div><br>
              {{-- <div class="card-tools float-sm-left">No of Posts: <strong>{{ $post_count }}</strong></div><br> --}}
            </div>
                <div class="col-md-10">
                    <form class="form-inline my-2 my-lg-0 rtside " method="GET" action="{{ route('admin.posts.index') }}">
                        <div class="form-group rtside">
                        {{-- <option data-name="{{ $post_cat->id }}" value="{{ $post_cat->id }}">{{ $post_cat->name }}</option>  --}}
                        {{-- <select class="custom-select custom-select mb-3" name="postcategory" id="category" style="width:180px" > --}}
                        {{-- <option value="">Select Category</option> --}}
                            {{-- @foreach($post_category as $post_cat) --}}
                            {{-- <option data-name="{{ $post_cat->id }}" value="{{ $post_cat->id }}" --}}
                            {{-- @if(!empty($_GET['postcategory']))
                                <?php //if($post_cat->id == $post//category){ echo 'selected'; } ?>
                            @endif --}}
                            {{-- > --}}
                            {{-- {{ $post_cat->name ?? ''}}</option> --}}
                            {{-- @endforeach --}}
                        {{-- </select> --}}
                        {{-- <button type="search" name="search" value="search" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button> --}}
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
                    <th scope="col" width="5%">#</th>
                    <th scope="col" width="15%">Fit india id</th>
                    <th scope="col" width="15%">Name</th>
                    <th scope="col" width="15%">Email</th>
                    <th scope="col" width="15%">Phone</th>
                    <th scope="col" width="25%">Action</th>
                    {{-- <th scope="col"></th> --}}
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>

                @foreach ($distributionpermissions as $post)
                {{-- {{ dd($post) }} --}}
                  <tr>
                    <th scope="row">{{++$i}}</th>
                    <td>{{ ucwords($post->fid) }}</td>
                    <td>{{ ucwords($post->name) }}</td>
                    <td>{{ ucwords($post->email) }}</td>
                    <td>{{ ucwords($post->phone) }}</td>
                     <td style="width:120px;display:inline-flex !important;">
                      {{-- <a class="btn btn-info btn-xs" href="{{ route('admin.posts.show',$post->id) }}" title="View">
                        <i class="fa fa-eye"  aria-hidden="true"></i>
                      </a> --}}
                      @if(Auth::user()->role_id == 10)
                        &nbsp;&nbsp;
                            {{-- <a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.posts.edit',$post->id) }}" title="Edit">
                              <i class="fas fa-pencil-alt"></i>
                            </a>
                            &nbsp;&nbsp;                         --}}
                          {{-- <form action="{{ route('admin.destroysocadminid',$post->id) }}" method="POST">
                            <button  style="display: inline !important;"class="btn btn-danger btn-xs" type="submit" title="Delete">
                              <i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Do you want to delete?')" ></i>&nbsp;
                            </button>
                          </form> --}}
                            <a style="display: inline !important;"class="btn btn-danger btn-xs" class="btn btn-info btn-xs" href="{{ route('admin.destroysocadminid',$post->main_id) }}" title="View" onclick="return confirm('Do you want to delete?')">
                                <i class="fa fa-trash"  aria-hidden="true"></i>
                            </a>
                      @endif
                     </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
          <div class="d-flex justify-content-center">
           {{ $distributionpermissions->links() }}
         </div>
         </div>
      </div>
        </div>
      </div>
      </div>
    </section>

  </div>
@endsection
