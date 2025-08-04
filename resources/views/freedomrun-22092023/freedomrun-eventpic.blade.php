@extends('layouts.app')
@section('title', 'Events Photo| Fit India')
@section('content')

<div class="banner_area">
	<img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
            @include('event.userheader')
            <div class="container">
                <div class="et_pb_row">
                    <div class="row ">
						@include('event.sidebar')
                        <div class="col-sm-12 col-md-9 ">
                            <div class="description_box">
                                <h2>Events Photo</h2>
								
								@if (session('error'))
										<div class="alert alert-danger">
											{{ session('error') }}
										</div>
								@endif
								
								@if (session('success'))
										<div class="alert alert-success">
											{{ session('success') }}
										</div>
								@endif
									
								<div class="all-events">
									<select class="select_location select_location_width" >
										<option <?php if($year==0){ echo  "selected='selected'"; }?> value="{{route('freedomrun-events-pics')}}">Fit India Freedom Run 3.0</option>
										<option <?php if($year==2021){ echo  "selected='selected'"; }?> value="eventspic/2021">Fit India School Week 2021</a>
										<option <?php if($year==2020){ echo  "selected='selected'"; }?> value="{{route('eventspic')}}">Others</option>
									</select>



									@if(!empty($events))
                                    @foreach($events as $event)
                                    <?php $event_pic = unserialize($event->eventimg_meta); ?>
										@if(!empty($event_pic))
											@foreach($event_pic as $event_pic_value)
												<article class="cards-list">
													<div class="card-img">
													<img src="{{ $event_pic_value }}" />
													</div>
												</article>
											@endforeach
										@endif
										
									<!-- 	@if(!empty($event->eventimage2))
											<article class="cards-list">
												<div class="card-img">
												<img src="{{ $event->eventimage2 }}" />
												</div>
											</article>
										@endif -->
                                    @endforeach
									
									@else
										<div class="no-events">
                                        You do not have added any Event. Do you want to organise an Event? please <a href="{{ route('create-event') }}">Click</a>
										</div>
									@endif
									
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br>
        </div>
		

<script>
			$('.select_location').on('change', function(){
   				window.location = $(this).val();
			});
		</script>
		
<style>
.delete-event{
    color: #fff;
    font-size: 14px;
    font-weight: 500;
    padding: 8px 15px;
    border-radius: 4px;
    display: block;
    width: 100%;
    text-align: center;
    text-transform: capitalize;
    transition: 0.5s;
    margin-right: 10px;
	background: #e4083b;
}
		</style>
	
@endsection
