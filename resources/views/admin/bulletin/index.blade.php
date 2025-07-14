@extends('admin.layouts.app')
@section('title', 'Announcement - Fit India')
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
            <h1>Bulletin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Bulletin</li>
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
                  <div class="row pull-left">
                    <div class="col-md-2">
                         <a href="{{ route('admin.bulletin.create') }}"> <input type="submit" value="Create New Bulletin" class="btn btn-success btn-sm float-left"> </a>
						 <div class="card-tools float-sm-left">Bulletins: <strong>{{ $bulletin_count }}</strong></div><br>
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
                    <th scope="col">URL</th>
                    <th scope="col">Description</th>
					<th scope="col">Date</th>
                    <th scope="col" width="40px">Attachment</th>
                    <th scope="col">Status</th>                   
                    <th scope="col">Action</th>
                    <th scope="col"></th>
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                @foreach ($bulletin as $kra)
                  <tr>
                    <th scope="row">{{++$i}}</th>
                      <td>{{ $kra->title }}</td>
                      <td>{{ $kra->url }}</td>
                      <td>{{ $kra->description }}</td>
                      <td>{{ $kra->bulletin_date }}</td>
                      <td><a href="{{ $kra->attachment }}" target="_blank">Document Url</a></td>
					  <td>
                          @if($kra->status==1)
                            <span class="label label-success">Active</span>
                          @else
                          <span class="label label-danger">Dective</span>
                          @endif
                      </td>
                      <td style="width:120px;display:inline-flex !important;">  
                        &nbsp;<a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.bulletin.edit', $kra->id) }}"> <i class="fas fa-pencil-alt"></i></a>
                        &nbsp;&nbsp;
                        <form action="{{ route('admin.bulletin.destroy', $kra->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                         <button  style="display: inline !important;" class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Do you want to delete ?')"></i>&nbsp;</button>
                       </form>              
                      @if($kra->status==1)                     
                      &nbsp;<a style="display: inline !important;" class="btn btn-info btn-xs" href=""><i class="fa fa-check-square" aria-hidden="true"></i></a>
                      @elseif($kra->status==0)
                      &nbsp;<a style="display: inline !important;" class="btn btn-danger btn-xs" href=""><i class="fa fa-ban" aria-hidden="true"></i></a>
                      @endif
                    </td>
                      <td></td>
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
    <!-- /.content -->
</div>
@endsection