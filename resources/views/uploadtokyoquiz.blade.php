@extends('admin.layouts.app')
@section('title', 'Fit India Admin - All Ambassadors')
@section('content')

<div class="content-wrapper"> 
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Ambassador</h1>
            </div>
        </div>
          
      </div>
  </section>
    <!-- Main content -->
  
  
  <section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
         <form action="{{ route('admin.uploadtokyoquiz') }}" enctype="multipart/form-data" method="post">
		 @csrf
			 <select name="lang">
				<option>English </option>
				<option>Hindi </option>
			 </select>
			<input name="file" type="file" />
			<input type="submit" />
		 </form>
		
        </div>
        </div>  
        </div>
    </section>
  
  </div>

  
   <!-- Modal -->
  
  
@endsection