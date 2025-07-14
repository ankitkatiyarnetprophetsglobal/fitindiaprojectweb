@extends('layouts.app')
@section('title', 'Fit India All Event | Fit India')
@section('content')

@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp


<div class="inner-banner-bg">
<div class="inner-banner-band">
<h1 class="page__title title" id="page-title">Site map</h1>
</div>
</div>
<section id="{{ $active_section_id }}">
<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-12 fitindia-sitemap">
		  <div id="primaryMenuId" class="prm-menu"> </div>
		  <div id="secondaryMenuId" class="sec-menu"></div>
		</div>
	</div>
</div>
</section>

<script >

 $(document).ready(function(){

    var primaryMenu = $("#collapsibleNavbar").html();
	var secondaryMenu = $("#footer_ab").html();
	//alert(secondaryMenu);
	//alert(primaryMenu);
	$("#primaryMenuId").append(primaryMenu);
	$("#primaryMenuId").removeClass();
	$("#primaryMenuId ul").removeClass();
	$("#primaryMenuId ul li a i").removeClass();
	$("#primaryMenuId ul li").removeClass();
	$("#primaryMenuId ul li a").removeClass();




	$("#secondaryMenuId").append(secondaryMenu);
	$("#secondaryMenuId div").removeClass();


	// $("#secondaryMenuId ul").removeClass();
	$("#secondaryMenuId ul.s_link").hide();
	$("#secondaryMenuId img").hide();;
	$("#secondaryMenuId #main-footer").hide();;
	$("#secondaryMenuId ul li").removeClass();
	$("#secondaryMenuId ul").removeClass('f_link')
	$("#secondaryMenuId ul li a").removeClass();
	$("#primaryMenuId ul li").css({"listStyle":"outside circle", "padding":"5px"});
	$("#secondaryMenuId ul li").css({"listStyle":"outside circle" , "padding":"5px"});

	//$("#secondaryMenuId ul li").css({"background-color": "yellow", "font-size": "200%"});
// 	.prm-menu ul li {
//     list-style: outside circle;
//     padding: 5px;
// }


	})
</script>

@endsection
