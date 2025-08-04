<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GramPanchayat;

class GramPanchayat extends Model
{
    use HasFactory;
    protected $table ='gram_panchayat_ambassador';
	
    protected $fillable = [
    	'user_id',
        'name',
        'email',
        'age',
        'gender',
        'state_name',
        'state_id',
        'district_name',
        'district_id',
        'block_name',
        'block_id',
        'designation',
        'document_file',		
        'age_proof',
        'anysports',
        'anysportsmin',
        'traditionalgame',
        'traditionalgamemin',
        'walkingmin',		
        'cyclingmin',		
        'runningmin',
        'otherpa',
        'otherpamin',
        'social_media_url',
        'facebook_profile',
        'facebook_profile_followers',
        'twitter_profile',
        'twitter_profile_followers',
        'instagram_profile',
        'instagram_profile_followers',
        'social_media_handle',
        'unique_app_id',
        'fitness_event',		
        'status', 
		'physical_fitness',	
		'eventname',
		'yclubeventcommits',
		'noofparticipant',
		'eventphoto',
		'contact',
		'image',
    ];
 	
	//ambassadors
	
    public static function getAllpanchyat(){
		
        $result = GramPanchayat::select('gram_panchayat_ambassador.name','gram_panchayat_ambassador.age','gram_panchayat_ambassador.gender','gram_panchayat_ambassador.email',
			'gram_panchayat_ambassador.social_media_url','gram_panchayat_ambassador.social_media_handle','gram_panchayat_ambassador.unique_app_id'
	,'gram_panchayat_ambassador.fitness_event','gram_panchayat_ambassador.state_name',
		'gram_panchayat_ambassador.district_name','gram_panchayat_ambassador.block_name','gram_panchayat_ambassador.contact',
		 DB::raw('(CASE WHEN gram_panchayat_ambassador.status = "1" THEN "Approved" WHEN gram_panchayat_ambassador.status = "2" THEN "Rejected" ELSE "Pending" END) AS application_status'),
		 'gram_panchayat_ambassador.created_at','admins.email as uemail')
			->leftJoin('admins', 'admins.id', '=', 'gram_panchayat_ambassador.updated_by')
			->orderBy('gram_panchayat_ambassador.id', 'DESC')
            ->get();
			
            return $result;
    }
	
    public static function getAllSearch(){
		
		$search_txt = request()->input('s');
		//'Name','Email','State_Name','District_Name','Block_Name','Status','Updated_By'
		 $result = GramPanchayat::select('gram_panchayat_ambassador.name','gram_panchayat_ambassador.age','gram_panchayat_ambassador.gender','gram_panchayat_ambassador.email',
			
	'gram_panchayat_ambassador.social_media_url','gram_panchayat_ambassador.social_media_handle','gram_panchayat_ambassador.unique_app_id'
	,'gram_panchayat_ambassador.fitness_event','gram_panchayat_ambassador.state_name',
		'gram_panchayat_ambassador.district_name','gram_panchayat_ambassador.block_name','gram_panchayat_ambassador.contact',
		 DB::raw('(CASE WHEN gram_panchayat_ambassador.status = "1" THEN "Approved" WHEN gram_panchayat_ambassador.status = "2" THEN "Rejected" ELSE "Pending" END) AS application_status'),
		 'gram_panchayat_ambassador.created_at','admins.email as uemail')
		
			->leftJoin('admins', 'admins.id', '=', 'gram_panchayat_ambassador.updated_by')
			->where('gram_panchayat_ambassador.email','LIKE','%'.$search_txt.'%')
			->orWhere('gram_panchayat_ambassador.name','LIKE','%'.$search_txt.'%')			
			->orWhere('gram_panchayat_ambassador.state_name','LIKE','%'.$search_txt.'%')
			->orWhere('gram_panchayat_ambassador.district_name','LIKE','%'.$search_txt.'%')
			->orWhere('gram_panchayat_ambassador.block_name','LIKE','%'.$search_txt.'%'
			)->get(50);
			
		return $result;        
    }
}