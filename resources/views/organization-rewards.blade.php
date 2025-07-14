@extends('layouts.app')
@section('title', 'Organization Rewards | Fit India')
@section('content')
@php
$active_section = request()->segment(count(request()->segments()));
$active_section_id = trim($active_section);
@endphp
<style>
    .freeparent .card {
        border: 0px solid rgba(0, 0, 0, .125);

    }

    .freeparent h5 {
        padding: 15px 10px;
    }

    /* .card_height {
        height: 266px
    } */

    .freeHead_o {
        background: #1c687f;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        padding: 5px 10px;
        font-size: 24px;
        color: #fff;
        text-align: center;
        border-bottom: 1px solid #3f3e3e45;
        /* background: rgb(166, 83, 5);
        background: linear-gradient(90deg, rgba(166, 83, 5, 1) 0%, rgba(255, 128, 0, 1) 51%, rgba(166, 83, 5, 1) 100%); */
    }

    .font_weight {
        font-weight: 300;
    }

    .table_area {
        width: 90%;
        margin: 0 auto;
    }

    .table_area p {
        margin-bottom: 0;
    }

    /* #ff8000
      #02349a
      #008000 */
    /* .card_height {
        height: 266px
    } */

    .table-striped>tbody>tr:nth-child(odd) {
        background-color: #fff;
    }

    .table-hover tbody tr:hover {
        background-color: #f9f9f9;
        ;
    }

    .bg_c {
        background: #f5f5f5;
    }

    .bgc_1 {
        background-color: #ff8d1a;
    }

    .bgc_2 {
        background-color: #ff9933;
    }

    .bgc_3 {
        background-color: #ffa64d;
    }

    .bgc_4 {
        background-color: #ffb366;
    }

    .bgc_5 {
        background-color: #ffc080;
    }

    .bgc_6 {
        background-color: #ffcc99;
    }

    .bgc_7 {
        background-color: #ffd9b3;
    }

    .bgc_8 {
        background-color: #ff8d1a;
    }

    .hd_span {
        position: relative;
        display: block;
        font-size: 14px;
    }

    .sec_heading_1 {
        padding-bottom: 0;
        margin-bottom: 30px;
    }

    .card_cus {
        position: relative;
    }

    /* .card_cus img {
        position: absolute;
    } */

    .card_cus h2 {
        text-align: center;
        font-size: 18px;
        font-family: inherit;
        color: inherit;
        font-weight: 300;
        padding: 10px;
        margin-top: 5px;
    }

    .card_cus .card {
        border-radius: 10px;


    }

    .card_cus img {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .p_size {
        font-size: 18px;
        font-weight: 600;

    }

    .card_cus h3 {
        font-size: 18px;
        font-weight: 600;
        ;

    }

    .section_n {
        padding-top: 25px;
        padding-bottom: 25px;
    }

    .s_img_height {
        /*width: 175px;*/
        height: 190px;
        text-align: center;
        margin: 0 auto;
    }

    .f-28 {
        font-size: 28px;
    }
</style>
<div class="banner_area1">
    <img src="{{ asset('resources/imgs/fit-india-awards.png') }}" alt="school-week" title="school-week" class="img-fluid expand_img" />

</div>
<?php
$rewards_cat = DB::table("org_rewards_cat")->get();

if(!empty($rewards_cat)){
    $i=1;
    foreach($rewards_cat as $rewards_cat_val){
        $rewards = DB::table('organization_rewards')->where('award_group_type_id',$rewards_cat_val->id)->where('status','1')->get();
    if($i%2==0){
        $style = '#f5f5f5';
    }else{
        $style = '#ffffff';
    }
?>
<section class="section_n mt-4" style="background:<?=$style?>">
    <div class="container">
        <div class="row ">
            <div class="col-sm-12 col-md-12 flex-column">
                <div class="sec_heading sec_heading_1">
                    <h2 class="heading headvideo text-uppercase"><?=$rewards_cat_val->award_group_type_name?> </h2>
                </div>
                <?php if(!empty($rewards_cat_val->award_grouptype_subname)){ ?>
                <p class="text-center mb-5 p_size"><?=$rewards_cat_val->award_grouptype_subname?> </p>
                <?php } ?>
            </div>
        </div>
        <div class="row freeparent justify-content-center">
            <?php 

            foreach($rewards as $rewards_val){
            ?>
            <div class="col-md-4 col-sm-12  mb-4  text-center card_cus">
                <?php //if($rewards_val->award_group_type_id == 1 OR $rewards_val->award_group_type_id == 3 OR $rewards_val->award_group_type_id == 6){ 
                if(!empty($rewards_val->award_type_name)){
                ?>
                <h3 class="heading headvideo text-uppercase"> <?=$rewards_val->award_type_name?> </h3>
                <?php } //} ?>
                <div class="card shadow1 card_height ">
                    <img src="<?=$rewards_val->awardee_image?>" class="img-fluid s_img_height" alt="school" class="img-fluid" />
                    <h2><?=$rewards_val->awardee_name?> </h2>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php $i++; }  } ?>







@endsection