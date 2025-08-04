<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LocalBody;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocalBody extends Model
{
    use HasFactory;
	protected $table ='local_body_ambassador';
	
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

	public static function getAlllbody(){
		
        $result = LocalBody::select('local_body_ambassador.name','local_body_ambassador.age','local_body_ambassador.gender','local_body_ambassador.email',
			'local_body_ambassador.social_media_url','local_body_ambassador.social_media_handle','local_body_ambassador.unique_app_id'
	,'local_body_ambassador.fitness_event','local_body_ambassador.state_name',
		'local_body_ambassador.district_name','local_body_ambassador.block_name','local_body_ambassador.contact',
		 DB::raw('(CASE WHEN local_body_ambassador.status = "1" THEN "Approved" WHEN local_body_ambassador.status = "2" THEN "Rejected" ELSE "Pending" END) AS application_status'),
		 'local_body_ambassador.created_at','admins.email as uemail')
			->leftJoin('admins', 'admins.id', '=', 'local_body_ambassador.updated_by')
			->orderBy('local_body_ambassador.id', 'DESC')
            ->get();
			
            return $result;
    }
	
    public static function getAllSearch(){
		
		$search_txt = request()->input('s');
		//'Name','Email','State_Name','District_Name','Block_Name','Status','Updated_By'
		 $result = LocalBody::select('local_body_ambassador.name','local_body_ambassador.age','local_body_ambassador.gender','local_body_ambassador.email',
			'local_body_ambassador.social_media_url','local_body_ambassador.social_media_handle','local_body_ambassador.unique_app_id'
	,'local_body_ambassador.fitness_event','local_body_ambassador.state_name',
		'local_body_ambassador.district_name','local_body_ambassador.block_name','local_body_ambassador.contact',
		 DB::raw('(CASE WHEN local_body_ambassador.status = "1" THEN "Approved" WHEN local_body_ambassador.status = "2" THEN "Rejected" ELSE "Pending" END) AS application_status'),
		 'local_body_ambassador.created_at','admins.email as uemail')
		
			->leftJoin('admins', 'admins.id', '=', 'local_body_ambassador.updated_by')
			->where('local_body_ambassador.email','LIKE','%'.$search_txt.'%')
			->orWhere('local_body_ambassador.name','LIKE','%'.$search_txt.'%')			
			->orWhere('local_body_ambassador.state_name','LIKE','%'.$search_txt.'%')
			->orWhere('local_body_ambassador.district_name','LIKE','%'.$search_txt.'%')
			->orWhere('local_body_ambassador.block_name','LIKE','%'.$search_txt.'%'
			)->get(50);
			
		return $result;        
    }	
}
