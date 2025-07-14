@extends('layouts.app')
@section('title', 'Fit India Ambassador | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp

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
    <div class="banner_area1">
        <img src="{{asset('resources/imgs/Ambassador-banner.jpg') }}" class="fluid-img">
    </div>
</div>
<div class="container contain_fluid_cust"> 
<section id="{{ $active_section_id }}">
    <div class="row ">
        <div class="col-sm-12 ahover">
            <a href ="{{asset('wp-content/uploads/doc/Guidelines-for-Fit-India-Ambassador.pdf') }}" class="og_btn" target="_blank">Guidelines of Fit India Ambassador</a>
            <a href ="ambassador" class="gr_btn" target="_blank">Register for Fit India Ambassador</a>
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
       
            @if(!empty($all_ambassador))
             <div class="col-sm-12 col-md-12  col-lg-12">
                @foreach($all_ambassador as $amb_values)
                    <div class="amb-dv">
                        <div class="amb-colm">
                        <div class="amb-rw">
                                <div class="amb-pic"> 
                                    <img src="{{ $amb_values->image }}" alt="{{ $amb_values->name }}" title="{{ $amb_values->name }}" class="fluid-img">
                                </div>
                                <div class="amb-details">
                                    <p class="amb-name">{{ $amb_values->name }}</p>
                                    <p class="amb-desig" data-toggle="tooltip" title="{{ $amb_values->designation }}" >{{ $amb_values->designation }}

                                    </p>
                                    <p class="amb-state">{{ $amb_values->state_name }}</p>
                                    <p class="amb-social-dv">
                                        <a class="fb-i" href="{{ $amb_values->facebook_profile }}" target="_blank" rel="facebook"></a>
                                        <a href="{{ $amb_values->twitter_profile }}" target="_blank" rel="twitter">
                                            {{-- class="twt-i" --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">								
                                                <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a class="insta-i" href="{{ $amb_values->instagram_profile }}" target="_blank" rel="instragram"></a>
                                    </p>
                                </div>
                            </div>
                    </div>
                    </div>
                @endforeach
                

           
          
        </div>
           <div class="col-sm-12 col-md-12  col-lg-12 page_parent ">
         {{ $all_ambassador->links() }}
     </div>
            @endif
    </div>
</section>
</div>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endsection