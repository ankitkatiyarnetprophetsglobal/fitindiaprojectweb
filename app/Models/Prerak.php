<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Prerak extends Model
{
    use HasFactory;
	protected $table ='preraks';
	
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
        'sum_follower',
        'id_proof',
        'app_id',
        'work_profession',
        'description',
        'status',
        'user_checker',
        'created_at',
        'register_as',
        'event_year',
        'event_name',
        'event_partcipant_number',
        'event_file'      
    ];	
    public static function getAllprerak()
    {
        $prerakData = array();
        $result = Prerak::select('preraks.id','preraks.name','preraks.email','preraks.contact','preraks.designation','preraks.state_name','preraks.district_name','preraks.block_name','preraks.pincode','preraks.facebook_profile','preraks.facebook_profile_followers','preraks.twitter_profile','preraks.twitter_profile_followers','preraks.instagram_profile',
            'preraks.instagram_profile_followers','preraks.work_profession','preraks.description','preraks.register_as', DB::raw('(CASE WHEN preraks.status = "1" THEN "Approved" WHEN preraks.status = "2" THEN "Rejected" ELSE "Pending" END) AS application_status'),'preraks.created_at','admins.email as uemail')
            ->leftJoin('admins', 'admins.id', '=', 'preraks.updated_by')
            ->where('parent_id','0')
            ->orderBy('preraks.id','DESC')
            ->get();

         

         
            foreach ($result as $prerak_rows) {
                $sumfollower = $prerak_rows->facebook_profile_followers + $prerak_rows->twitter_profile_followers + $prerak_rows->instagram_profile_followers;

                $sumfollower2=0;
                $prerak_result_count = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from preraks order by parent_id, id) preraks, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id))"));
                    foreach($prerak_result_count as $prerak_count_row){
                        $sumfollower2 = $sumfollower2+$prerak_count_row->sum_of_followers;  
                    }
                    $total_follower = $sumfollower + $sumfollower2; 
                    
                    $prerak_pending_count = DB::select(DB::raw("SELECT id from (select * from preraks order by parent_id, id) preraks, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='0'"));

                     $prerak_approved_count = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from preraks order by parent_id, id) preraks, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='1'"));

                     $prerak_rejected_count = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from preraks order by parent_id, id) preraks, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='2'"));

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
    public static function getAllSearch()
    {
        $search_txt = request()->input('s');
        $prerakData = array();
        $result = Prerak::select('preraks.id','preraks.name','preraks.email','preraks.contact','preraks.designation','preraks.state_name','preraks.district_name','preraks.block_name','preraks.pincode','preraks.facebook_profile','preraks.facebook_profile_followers','preraks.twitter_profile','preraks.twitter_profile_followers','preraks.instagram_profile',
            'preraks.instagram_profile_followers','preraks.work_profession','preraks.description','preraks.register_as', DB::raw('(CASE WHEN preraks.status = "1" THEN "Approved" WHEN preraks.status = "2" THEN "Rejected" ELSE "Pending" END) AS application_status'),'preraks.created_at','admins.email as uemail')
            ->leftJoin('admins', 'admins.id', '=', 'preraks.updated_by')
            ->where('preraks.email','LIKE','%'.$search_txt.'%')
            ->orWhere('preraks.name','LIKE','%'.$search_txt.'%')
            ->orWhere('preraks.contact','LIKE','%'.$search_txt.'%')
            ->orWhere('preraks.state_name','LIKE','%'.$search_txt.'%')
            ->orWhere('preraks.district_name','LIKE','%'.$search_txt.'%')
            ->orWhere('preraks.block_name','LIKE','%'.$search_txt.'%')
            ->orWhere('parent_id','0')
            /*->where('parent_id','0')*/
           /* ->orderBy('preraks.id','DESC')*/
            ->get();

            
            foreach ($result as $prerak_rows) {
                $sumfollower = $prerak_rows->facebook_profile_followers + $prerak_rows->twitter_profile_followers + $prerak_rows->instagram_profile_followers;

                $sumfollower2=0;
                $prerak_result_count = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from preraks order by parent_id, id) preraks, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id))"));
                    foreach($prerak_result_count as $prerak_count_row){
                        $sumfollower2 = $sumfollower2+$prerak_count_row->sum_of_followers;  
                    }
                    $total_follower = $sumfollower + $sumfollower2; 
                    
                    $prerak_pending_count = DB::select(DB::raw("SELECT id from (select * from preraks order by parent_id, id) preraks, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='0'"));

                     $prerak_approved_count = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from preraks order by parent_id, id) preraks, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='1'"));

                     $prerak_rejected_count = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at from (select * from preraks order by parent_id, id) preraks, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='2'"));

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
    /*public static function getAllSearch()
    {
            $search_txt = request()->input('s');
            $result =  Prerak::select('preraks.name','preraks.email','preraks.contact','preraks.designation','preraks.state_name','preraks.district_name','preraks.block_name','preraks.pincode','preraks.facebook_profile','preraks.facebook_profile_followers','preraks.twitter_profile','preraks.twitter_profile_followers','preraks.instagram_profile','preraks.instagram_profile_followers','preraks.work_profession','preraks.description',  DB::raw('(CASE WHEN preraks.status = "1" THEN "Approved" WHEN preraks.status = "2" THEN "Rejected" ELSE "Pending" END) AS application_status'),'preraks.created_at','admins.email as uemail')
                ->leftJoin('admins', 'admins.id', '=', 'preraks.updated_by')
                ->where('preraks.email','LIKE','%'.$search_txt.'%')
                ->orWhere('preraks.name','LIKE','%'.$search_txt.'%')
                ->orWhere('preraks.contact','LIKE','%'.$search_txt.'%')
                ->orWhere('preraks.state_name','LIKE','%'.$search_txt.'%')
                ->orWhere('preraks.district_name','LIKE','%'.$search_txt.'%')
                ->orWhere('preraks.block_name','LIKE','%'.$search_txt.'%')
                ->orWhere('parent_id','0')
                ->get(40);
            return $result;        
    }*/
}
