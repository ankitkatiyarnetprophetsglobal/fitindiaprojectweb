@extends('layouts_certificate.app')
@section('title', 'Fit India Yoga Center | Fit-India ')
@section('content')

<style>
    
    /* section{
        padding-top: 25%;
    padding-bottom: 25%;
  
    } */
    .area{width:100%;margin-bottom:5px;}

.area p{font-size:1rem;text-align:center;margin-bottom:10px;position: relative;}
strong::after{
    content: '';
    position: absolute;
    width: 10%;
    top: 26px;
    left: 45%;
    height: 1px;
    background-color: #008000;
    display: inline-block;

}



</style>

     <!-- <div>
        <img src="{{ asset('resources/imgs/inflencer.png') }}" alt="Inflencer"
            title="Inflencer" class="img-fluid expand_img" />	 -->		<!-- <h1 style="font-size:1px; color:#fff;">Share Your Story</h1> -->
    <!-- </div>  -->
    <section >
        <div class="container ">  
            <?php if(!empty($yoga_user_info)){ ?>
                <div class="card p-3 area">         
                    <p> <strong>Issued to:</strong></p>   
                    <p>{{$yoga_user_info->name}}</p>
                </div>

                <div class="card p-3 area">
                    <p> <strong>Under Category:</strong></p>   
                    <p>  {{$yoga_user_info->category}}</p>
                </div>
                <div class="card p-3 area">
                    <p> <strong>Issued Date:</strong></p>   
                    <p>  15 June 2021</p>
                </div>
                <div class="card p-3 area">
                        <!-- <p> <strong>Description:</strong></p>    -->
                    <!-- <p style="margin-bottom:0;color:#008000;">  {{$yoga_user_info->description}}</p> -->
                    <p style="margin-bottom:0;color:#008000;"> This is to certify that this certificate has been issued by Fit India Mission</p>
               </div>
           <?php }else{ ?> 
                <div class="card p-3 area">         
                    <p> <b style="color:red; ">You are unauthorized user</b></p>   
                </div>
            <?php } ?>
           
        </div>
    </section>
@endsection