@extends('layouts.app')
@section('title', 'PrerakList | Fit India')
@section('content')
<style>
.page_parent {margin-top: 15px;}
.page_parent nav{display: flex;}
    .page_parent nav .pagination{
        margin: 0 auto;

    }
   /* .contain_fluid_cust{
        padding: 0 5%;
    }*/

</style>
<div class="container-fluid"> 
    <div>
        <img src="{{asset('resources/imgs/prerak_social_media_enthusiast.jpg') }}" class="fluid-img">
    </div>
</div>
<div class="container"> 
<section >
    <div class="row ">
        <div class="col-sm-12 ahover">
           <!-- <a href ="{{asset('wp-content/uploads/doc/Guidelines-for-Fit-India-Ambassador.pdf') }}" class="og_btn" target="_blank">Guidelines of Fit India Prerak</a>-->
              <a href ="register?role=<?=base64_encode('subscriber')?>" class="gr_btn" target="_blank">Register for Fit India Prerak</a>
            <!-- <form method="POST" action="{{url('register')}}" >
                @csrf

            <input type="submit" name="submit" value="submit"> -->
           </form> 

           <div class="m-40"></div>
        </div>
         <div class="col-sm-12">
        <p>With the aim of making fitness a priority for all citizens, Fit India Mission office has decided to join hands with well-known names from all walks of life and encourage people to bring about a behavioural change in their lives.</p>
        <p>With this, we aim to connect with well-known faces from different parts of the country, who will not only make fitness as a priority in their lives but also motivate others to do so.</p>
        <p>To honour their dedication and commitment towards our mission, we recognize them as Fit India Ambassadors.</p>
        <br><br>
</div>
        <br>
    </div>

    <div class="row">
        @if(!empty($social_media_prerak))
            <div class="col-md-12 ">
                @foreach($social_media_prerak as $prerak_rows)
                    <div class="amb-dv">
                        <div class="amb-colm">
                            <div class="amb-rw">
                                <div class="amb-pic"> 
                                    <img src="{{ $prerak_rows['image'] }}" alt="{{ $prerak_rows['name'] }}" title="{{ $prerak_rows['name'] }}" class="fluid-img">
                                </div>
                                <div class="amb-details">
                                    <p class="amb-name">{{ $prerak_rows['name'] }} </p>
                                    <p class="amb-desig" data-toggle="tooltip" title="{{ $prerak_rows['designation'] }}" >{{ $prerak_rows['designation'] }} </p>
                                    <p class="amb-state">{{ $prerak_rows['state_name'] }}</p>
                                    <p class="amb-social-dv">
                                        <a class="fb-i" href="{{ $prerak_rows['facebook_profile'] }}" target="_blank" rel="facebook"></a>
                                        <a class="twt-i" href="{{ $prerak_rows['twitter_profile'] }}" target="_blank" rel="twitter"></a>
                                        <a class="insta-i" href="{{ $prerak_rows['instagram_profile'] }}" target="_blank" rel="instragram"></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-sm-12 col-md-12  col-lg-12 page_parent ">
                {{ $social_media_prerak->links() }}
            </div>
        @endif
    </div>
</section>
</div>


@endsection