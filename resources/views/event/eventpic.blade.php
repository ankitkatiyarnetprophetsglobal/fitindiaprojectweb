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
								<br/>
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
									
								<select name="category_name" id="category_name" class="fit-pe-inputs select_category" required>	
									<option value="">Select Category</option>
									@foreach ($categories as $key => $value)
									<option value="{{ $value->id }}">{{$value->name}}</option>
									@endforeach
								</select>
								<br/>
								<div class="all-events">
									{{-- {{ dd($freedomrun_event) }} --}}
								{{-- <select class="select_location select_location_width" > --}}
									{{-- <option <?php if($year=='2022'){ echo "selected='selected'"; }?> value="{{url('eventspic/2022')}}">National Sports Day 2022</option>	 --}}
									{{-- <option <?php if($year=='freedom-rider-cycle-rally'){ echo "selected='selected'"; }?> value="{{url('eventspic/freedom-rider-cycle-rally')}}">Fit India Freedom Rider-Cycle Rally</option> --}}
									{{-- <option <?php if($year=='cyclothon-2021'){ echo "selected='selected'"; }?> value="{{url('eventspic/cyclothon-2021')}}">Fit India Fit Gujarat Cyclothon 2021 </option>									 --}}
									{{-- <?php if(Auth::user()->role == 'ghd'){ ?> --}}
									{{-- <option <?php if($year=='cyclothon-2021'){ echo "selected='selected'"; }?> value="{{url('eventspic/cyclothon-2021')}}">Fit India Fit Gujarat Cyclothon 2021 </option> --}}
									{{-- <?php } ?> --}}
									{{-- <option <?php if($year=='schoolweek-2021'){ echo  "selected='selected'"; }?> value="{{url('eventspic/schoolweek-2021')}}">Fit India School Week 2021</option> --}}
									{{-- <option <?php if($year=='0'){ echo  "selected='selected'"; }?> value="{{route('freedomrun-events-pics')}}">Fit India Freedom Run 2.0</option> --}}
									{{-- <option <?php if($year=='2020'){ echo  "selected='selected'"; }?> value="{{route('eventspic')}}">Others</option> --}}
								{{-- </select> --}}
									@if(!empty($events))										
										@foreach(unserialize($events['eventimg_meta']) as $event)
										{{-- {{ dd($event)  }}											 --}}
											@if(!empty($event))
												<article class="cards-list">
													<div class="card-img">
													<img src="{{ $event }}" />
													</div>
												</article>
											@endif
											
											{{-- @if(!empty($event))
												<article class="cards-list">
													<div class="card-img">
													<img src="{{ $event }}" />
													</div>
												</article>
											@endif --}}
										@endforeach
									
									@else
										<br/>
										<br/>										
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



<script>

	$('.select_category').on('change', function(){
		// alert(123456);
		let id = $(this).val();
		// alert(id)
		// return false;
		if(id != ""){
			// baseurl = "https://localhost/fitindiaweb_gitnew/";
			baseurl = "<?php echo config('app.website_url'); ?>";

			$.ajax({
				method: "GET",
				url: baseurl + "myeventsearchimages/"+id,
				contentType: false,
				processData: false,

				success: function (response) {	

					let html = ''
					
					if(response.success == true){		
							// for(let i = 0; i < response.event_value?.length;i++){
							
								console.log("response.events",response.event_value);
								// return false;						
								
								html +=`${response.event_value}`;
							// }
						$('.all-events').html(html);
					}else{
						html +=`<article>
										<br/>										
										<h3 class="row mx-md-n5">
											<div class="col px-md-5">
												<div class="p-3 border bg-light text-center">
													Data Not Found
												</div>
											</div>
										</h3>										
								</article>`;

						$('.all-events').html(html);
					}

				}

			});
		}
	});

</script>
	
@endsection
