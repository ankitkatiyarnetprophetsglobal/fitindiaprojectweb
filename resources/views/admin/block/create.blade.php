@extends('admin.layouts.app')
@section('title', 'Create Block - Fit India')
@section('content')

<div class="content-wrapper">
  <section class="content-header">
     <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <a class="btn btn-primary btn-sm" href="{{ route('admin.blocks.index') }}"> Back</a>
            <h1>Add Block</h1>
          </div>
        </div>
        <div class="row mb-2">  
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.blocks.index') }}">Block</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Block</h3>
              </div>
              <form method="POST" action="{{ route('admin.blocks.store') }}" >
			    @csrf
                <div class="card-body">
                 @if(session('status'))
					<div class="alert alert-success">
						{{ session('msg') }}
					</div>
                 @endif

                @if($errors->any())
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
                   <label for="exampleInputEmail1">District Name</label>
                   <select id="district" name="district" class="form-control" aria-required="true">
					<option value="">Select District</option>
					@foreach($districts as $st)
						<option value="{{ $st->id }}" @if(!empty($old_data->district) && $old_data->district == $st->id) {{ 'selected' }} @endif >
						{{ $st->name }}
						</option>
					@endforeach
					</select>									
                  </div>
                   
                  <div class="form-group">
                    <label for="exampleInputEmail1">Block Name</label>
                    <input type="text" class="form-control" id="block" name="name" value="<?=!empty($old_data->name) ? $old_data->name : '' ?>" placeholder="Enter Block Name">
                  </div>                 			  
				</div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection