@extends('quizlayouts.app')
@section('title', 'Quiz Partner Upload Banners')
@section('pageid','quiz-dashboard')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<div class="inner-banner-bg">
<div class="inner-banner-band">
<h1 class="page__title title" id="page-title">Welcome {{ $currentusr->name }}, Road to Tokyo 2020</h1>
</div>
</div>
  <section>
  
    <div class="container" id="{{ $active_section_id }}">
        <div class="row">
          <div class="col-md-6 offset-md-3">
          <div class="card">
                 
                 <div class="card-body">
				
				<div class="info-quiz-bx" >
				<br>
				<h2>Upload Banners</h2>
					Please upload banners to create <strong>Road to Tokyo 2020 Quiz</strong> page: <a href="{{ route('quizpartnerupload') }}" class="custom-btn btn btn-primary ml-2"> Upload</a>
				</div>
				
				@if($quizimgs)
				<div class="info-quiz-bx" >
        <h2>Quiz Details</h2>
					Go to <strong>Road to Tokyo 2020 Quiz</strong> page: <a href="{{ route('roadtotokyo',$encrypted) }}" class="custom-btn btn btn-primary ml-2">Read to Quiz Details</a> 
				</div>
				@endif
				
				
				@if($partarrs)
				
				<div class="info-quiz-bx" >
					<h2>Quiz Participants</h2>
					<table class="table table-striped">
					<thead>
						<tr> <th>Date  </th> <th>No of Participants </th> </tr>
					</thead>
					<tbody>
						@foreach($partarrs as $partarr)
						<tr> <td>{{ $partarr->date }} </td><td> {{ $partarr->cnt }}  </td> </tr>
						@endforeach
					</tbody>
					</table>	
				</div>
				
				@endif
				
				
				
				
				
        </div>
        </div>
				
				
				
				
				
				
               
            </div>
        </div>
		
		<br>
		
		@if($winners)
		<div class="row">
          <div class="col-md-12 ">
          <div class="card">
                 
                 <div class="card-body">
				 
		
				<br>
				<div class="info-quiz-bx " >
					<h2>Quiz Winners</h2>
					<div class="table-responsive">
					<table class="table table-striped">
					<thead>
						<tr> <th>Name</th><th>Email  </th> <th>Mobile</th><th>State  </th>  <th>City</th><th>Date  </th> </tr>
					</thead>
					<tbody>
						@foreach($winners as $winner)
						<tr> 
							<td>{{ $winner->name }} </td>
							<td> {{ $winner->email }}  </td>
							<td>{{ $winner->mobile }} </td>
							<td> {{ $winner->state }}  </td>
							<td>{{ $winner->city }} </td>
							<td> {{ $winner->winnerdate }}  </td>
						</tr>
						@endforeach
					</tbody>
					</table>
					</div>					
				</div>
				
				
				
				</div>
				</div>
				</div>
				</div>
			@endif	
				
				
				
				
    </div>
  </section>

@endsection


                
      

