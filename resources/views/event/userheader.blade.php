<div class="banner_area_txt">
	<h4> Registered as : <?php echo ucwords(Auth::user()->rolelabel);?></h4>
	<h5> Welcome <?php echo ucwords(Auth::user()->name);?></h5>
	@if(\App\Models\Ambassador::where('email',Auth::user()->email)->where('status','1')->first())
	<h5> I am a Fit India Ambassador</h5>
	@endif 
	@if(\App\Models\Champion::where('email',Auth::user()->email)->where('status','1')->first())
	<h5> I am a Fit India Champion</h5>
	@endif 

	<?php 
	$email = Auth::user()->email;
	$prerak_data = \App\Models\FitnessEnthusias::where('email',$email)->where('status','1')->first(); 
	if(!empty($prerak_data)){
		$max_num = $prerak_data->max_partcipant ? $prerak_data->max_partcipant : 0; 

	  	$prerak_approved_count = DB::select(DB::raw("SELECT id, max_partcipant, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from fitness_enthusias order by parent_id, id) fitness_enthusias, (select @pv := $prerak_data->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='1'"));
	  	//$total_partcipant = 0;
	                   
	    $sum_of_value = 0;
	    foreach ($prerak_approved_count as $key => $pr_approve) {
	        $sum_of_value = $sum_of_value+$pr_approve->max_partcipant;
	    }
	    $total_sum_of_event = $sum_of_value+$max_num;
	    $new_level='';
	    $event_sum=0;
	    if($total_sum_of_event >=1500){
	        $new_level = "<h6>Fit India Champion</h6>";
	    }elseif($total_sum_of_event >=500 && $total_sum_of_event < 1500){
	        $new_level = "<h6>Fit India Ambassador</h6>";
	    }else{
	        $new_level = "<h6>Fit India Prerak</h6>";
	    }  
	    echo $new_level;
	}

	$social_media_prerak = \App\Models\Prerak::where('email',$email)->where('status','1')->first(); 
	if(!empty($social_media_prerak)){
		$sumfollower = $social_media_prerak->facebook_profile_followers + $social_media_prerak->twitter_profile_followers + $social_media_prerak->instagram_profile_followers;
		$multiple_social_media = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from preraks order by parent_id, id) preraks, (select @pv := $social_media_prerak->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='1'"));

		$sumfollower2=0;
        foreach($multiple_social_media as $multiple_social_data){
        	$sumfollower2 = $sumfollower2+$multiple_social_data->sum_of_followers; 
        }
       
        $total_follower = $sumfollower+$sumfollower2; 
       
        if($total_follower<=9999 && $total_follower>=1000){
        	echo "<h6>Fit India Prerak</h6>";
    	}
        elseif($total_follower>=10000 && $total_follower<=99999){
        	echo "<h6>Fit India Ambassador</h6>";
        }
        else{
        	echo "<h6>Fit India Champion</h6>";
        }
                     
	}
	?>


</div>