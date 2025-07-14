<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FitnessEnthusias extends Model
{
    use HasFactory;
    protected $table ='fitness_enthusias';
	
	protected $fillable = [
        'parent_id',
        'refer_code',
        'user_id',
        'name',
        'email',
        'genrated_refer_code',
        'contact',
        'designation',
        'state_name',
        'state_id',
        'district_name',
        'district_id',
        'block_name',
        'block_id',
        'pincode',
        'image',
        'social_media_url',
        'facebook_profile',
        'facebook_profile_followers',
        'twitter_profile',
        'twitter_profile_followers',
        'instagram_profile',
        'instagram_profile_followers',
        'id_proof',
        'app_id',
        'work_profession',
        'description',
        'status',
        'user_checker',
        'register_as', 
        'fitness_event', 
        'event_year',
        'event_name',
        'event_url',
        'event_partcipant_number',
        'event_file',
        'max_partcipant',
        'created_at'
               
    ];
    public static function getAllEnthusiast()
    {
        $prerakData = array();
        $result = FitnessEnthusias::select('fitness_enthusias.id','fitness_enthusias.name','fitness_enthusias.email','fitness_enthusias.contact','fitness_enthusias.designation','fitness_enthusias.state_name','fitness_enthusias.district_name','fitness_enthusias.block_name','fitness_enthusias.social_media_url','fitness_enthusias.pincode','fitness_enthusias.work_profession','fitness_enthusias.description','fitness_enthusias.register_as', DB::raw('(CASE WHEN fitness_enthusias.status = "1" THEN "Approved" WHEN fitness_enthusias.status = "2" THEN "Rejected" ELSE "Pending" END) AS application_status'),'fitness_enthusias.created_at','admins.email as uemail')
            ->leftJoin('admins', 'admins.id', '=', 'fitness_enthusias.updated_by')
            ->where('parent_id','0')
            ->orderBy('fitness_enthusias.id','DESC')
            ->get();

            foreach ($result as $prerak_rows) {
                $prerak_result_count = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from fitness_enthusias order by parent_id, id) fitness_enthusias, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id))"));
                    $prerak_pending_count = DB::select(DB::raw("SELECT id from (select * from fitness_enthusias order by parent_id, id) fitness_enthusias, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='0'"));

                     $prerak_approved_count = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from fitness_enthusias order by parent_id, id) fitness_enthusias, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='1'"));

                     $prerak_rejected_count = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from fitness_enthusias order by parent_id, id) fitness_enthusias, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='2'"));

                    $level='';
                   
                    if(count($prerak_approved_count) < 5){
                        $level='Prerak';
                    }
                    elseif(count($prerak_approved_count) >=5 && count($prerak_approved_count) < 25){
                        $level='Ambassador';
                    }
                    elseif($count($prerak_approved_count)>=25){
                         $level='Champion';
                    }
                    
                    $prerakData[] = [
                    'name' => $prerak_rows->name,
                    'email' => $prerak_rows->email,
                    'contact' => $prerak_rows->contact,
                    'designation' => $prerak_rows->designation,
                    'state_name' => $prerak_rows->state_name,
                    'district_name' => $prerak_rows->district_name,
                    'block_name' => $prerak_rows->block_name,
                    'social_media_url' => $prerak_rows->social_media_url,
                    'work_profession' => $prerak_rows->work_profession,
                    'description' => $prerak_rows->description,
                    'application_status' => $prerak_rows->application_status,
                    'created_at' => $prerak_rows->created_at,
                    'updated_by' => $prerak_rows->updated_by,
                    'all_childrens' => count($prerak_result_count),
                    'approved_childrens' => count($prerak_approved_count),
                    'pending_childrens' => count($prerak_pending_count),
                    'rejected_childrens' => count($prerak_rejected_count),
                    'register_as' => $prerak_rows->register_as,
                    'level' => $level
                ];
            }
            return $prerakData;
    }
    public static function getAllSearch()
    {
        $search_txt = request()->input('s');
        $prerakData = array();
        $result = FitnessEnthusias::select('fitness_enthusias.id','fitness_enthusias.name','fitness_enthusias.email','fitness_enthusias.contact','fitness_enthusias.designation','fitness_enthusias.state_name','fitness_enthusias.district_name','fitness_enthusias.block_name','fitness_enthusias.pincode','fitness_enthusias.facebook_profile','fitness_enthusias.facebook_profile_followers','fitness_enthusias.twitter_profile','fitness_enthusias.twitter_profile_followers','fitness_enthusias.instagram_profile',
            'fitness_enthusias.instagram_profile_followers','fitness_enthusias.work_profession','fitness_enthusias.description','fitness_enthusias.register_as', DB::raw('(CASE WHEN fitness_enthusias.status = "1" THEN "Approved" WHEN fitness_enthusias.status = "2" THEN "Rejected" ELSE "Pending" END) AS application_status'),'fitness_enthusias.created_at','admins.email as uemail')
            ->leftJoin('admins', 'admins.id', '=', 'fitness_enthusias.updated_by')
            ->where('fitness_enthusias.email','LIKE','%'.$search_txt.'%')
            ->orWhere('fitness_enthusias.name','LIKE','%'.$search_txt.'%')
            ->orWhere('fitness_enthusias.contact','LIKE','%'.$search_txt.'%')
            ->orWhere('fitness_enthusias.state_name','LIKE','%'.$search_txt.'%')
            ->orWhere('fitness_enthusias.district_name','LIKE','%'.$search_txt.'%')
            ->orWhere('fitness_enthusias.block_name','LIKE','%'.$search_txt.'%')
            ->orWhere('parent_id','0')
            /*->where('parent_id','0')*/
           /* ->orderBy('fitness_enthusias.id','DESC')*/
            ->get();

            
            foreach ($result as $prerak_rows) {
                $sumfollower = $prerak_rows->facebook_profile_followers + $prerak_rows->twitter_profile_followers + $prerak_rows->instagram_profile_followers;

                $sumfollower2=0;
                $prerak_result_count = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from fitness_enthusias order by parent_id, id) fitness_enthusias, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id))"));
                    foreach($prerak_result_count as $prerak_count_row){
                        $sumfollower2 = $sumfollower2+$prerak_count_row->sum_of_followers;  
                    }
                    $total_follower = $sumfollower + $sumfollower2; 
                    
                    $prerak_pending_count = DB::select(DB::raw("SELECT id from (select * from fitness_enthusias order by parent_id, id) fitness_enthusias, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='0'"));

                     $prerak_approved_count = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from fitness_enthusias order by parent_id, id) fitness_enthusias, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='1'"));

                     $prerak_rejected_count = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from fitness_enthusias order by parent_id, id) fitness_enthusias, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='2'"));

                    $level='';
                    if($total_follower<=9999 && $total_follower>=1000){
                        $level='Prerak';
                    }
                    elseif($total_follower>=10000 && $total_follower<=99999){
                        $level='Ambassador';
                    }
                    elseif($total_follower>=100000){
                        $level='Champion';
                    }
                   

                    $prerakData[] = [
                    'name' => $prerak_rows->name,
                    'email' => $prerak_rows->email,
                    'contact' => $prerak_rows->contact,
                    'designation' => $prerak_rows->designation,
                    'state_name' => $prerak_rows->state_name,
                    'district_name' => $prerak_rows->district_name,
                    'block_name' => $prerak_rows->block_name,
                    'pincode' => $prerak_rows->pincode,
                    'facebook_profile' => $prerak_rows->facebook_profile,
                    'facebook_profile_followers' => $prerak_rows->facebook_profile_followers,
                    'twitter_profile' => $prerak_rows->twitter_profile,
                    'twitter_profile_followers' => $prerak_rows->twitter_profile_followers,
                    'instagram_profile' => $prerak_rows->instagram_profile,
                    'instagram_profile_followers' => $prerak_rows->instagram_profile_followers,
                    'work_profession' => $prerak_rows->work_profession,
                    'description' => $prerak_rows->description,
                    'application_status' => $prerak_rows->application_status,
                    'created_at' => $prerak_rows->created_at,
                    'updated_by' => $prerak_rows->updated_by,
                    'all_childrens' => count($prerak_result_count),
                    'approved_childrens' => count($prerak_approved_count),
                    'pending_childrens' => count($prerak_pending_count),
                    'rejected_childrens' => count($prerak_rejected_count),
                    'self_follower'=> $sumfollower,
                    'total_follower'=> $total_follower,
                    'registered_as' => $prerak_rows->register_as,
                    'level' => $level
                ];
            }
            return $prerakData;
    }
}
