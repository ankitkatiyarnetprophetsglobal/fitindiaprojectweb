@extends('quizlayouts.app')
@section('title', 'Quiz Partner Upload Banners')
@section('pageid','quiz-dashboard')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<style>
.upl-img{
	width:200px;
}
</style>


	<div class="inner-banner-bg">
		<div class="inner-banner-band">
		<h1 class="page__title title" id="page-title">Upload Banners</h1>
		</div>
	</div>

	<!-- <div class="container-fluid">
		<div class="row">
        <div class="col-md-6 offset-md-3">
         
            </div>
			
		</div>
    </div> -->
    
			  
  <section>
  
    <div class="container" id="{{ $active_section_id }}">
    <div class="row">
            <div class="col-md-6 offset-md-3">
          <div class="card card-bc-btn">
                 
                 <div class="card-body">
            <a class="btn btn-light btn-back" href="{{ route('quiz-partner-dashboard') }}" > < Back </a>
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
				@if(session()->has('error'))
                    <div class="alert alert-error">
                        {{ session()->get('error') }}
                    </div>
                @endif
				
                <form action="{{ route('quizpartnerupload.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                        
                        <div class="form-group">
                            <label for="userEmail"><strong>Upload Main Page Banner Dimension</strong> (width:620px, height:380px)</label>
                            <input type="file" class="form-control" name="mainimage" >
                            @error('mainimage')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
						
                        
						<div class="form-group">
                                <label for="exampleInputEmail1"><strong>Upload Lucky Winner Page Banner Dimension</strong> (width:620px, height:380px)</label>
                                <input type="file" name="luckywinnerimage" class="form-control">
                        </div>
                            @error('luckywinnerimage')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
							
                        
						<div class="form-group">
                            <button type="submit" class="btn btn-primary btn-customized">Submit</button>
                            
                        </div>
						
                    </div>
                    </div>
                    

                    
                </form>
            </div>
        </div>
    </div>
	
	@if($posterupload)
	<div class="row">
			<div class="col-md-3 offset-md-3">
			<h2> Uploaded Posters </h2>
			 </div>
    </div>	
	
	
	<div class="row">
				<div class="col-md-3 offset-md-3">
					@if($posterupload->mainimage) 
						<img src="{{ $posterupload->mainimage }}" class="upl-img" />
					@endif
				</div>
				
				<div class="col-md-3">
					@if($posterupload->luckywinnerimage) 
						<img src="{{ $posterupload->luckywinnerimage }}" class="upl-img" />
					@endif
				</div>
				
	
	</div>
	@endif
	
  </section>
@endsection

