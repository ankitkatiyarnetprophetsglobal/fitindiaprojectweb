@extends('Influencerlayout.app')
@section('title', 'Application Uncomplete | Fit India')
@section('content')
 
<div class="banner_area">
	<img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" style="height: 110px;" />
             <div class="container">
                <div class="et_pb_row">
                    <div class="row ">
						 <div class="col-sm-12 col-md-12 ">
                            <div class="description_box">
                                <h2>Your Application is not Complete</h2>
								
								
									
								<div class="all-events">
									
										<div class="no-events">
											Your submitted application is not completed, please contact us for resubmit <a href="{{ route('contact-us') }}">Click</a>
										</div>
									
									
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br>
        </div>
		
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
