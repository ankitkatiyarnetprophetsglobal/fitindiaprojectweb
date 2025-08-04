<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Eventorganizations extends Model
{
    use HasFactory;
    protected $table ='event_organizations';
    protected $appends  = ['encryptid'];
    protected $fillable = [
        'user_id',
		'type',
        'category',
		'event_name_store',
        'name',
        'email',
        'contact',
        'state',
        'school_chain',
        'eventimage1',
        'eventimage2',
        'video_link',
        'eventstartdate',
        'eventenddate',
        'organiser_name',
        'participantnum',
        'participant_names'
        ];  
		
	public static function getAllSchoolWeek(){
	  
	  $records = DB::table('school_weeks')
		->orderBy('name','desc')
		->get(['name','contact','email','organiser_name','role','eventstartdate','eventenddate'])
		->where('role', '=' ,'individual');
		
		return $records;
	}
	
	public function getEncryptidAttribute(){
		return encrypt($this->id);
	}
		
	public static function getAllSearch(){			
		 $data = array();
		 
		 if(request()->input('search')=='search'){ 			
		
			if(request()->input('type')=='organizer'){
				//DB::enableQueryLog();
				$result = DB::table('school_weeks')
						->leftJoin('users', 'users.id', '=', 'school_weeks.user_id')
						->leftJoin('usermetas', 'usermetas.user_id', '=', 'users.id')
						->where('school_weeks.role', '=' ,'organizer')
						->select(['users.name as uname','school_weeks.organiser_name as Organizer_Name','usermetas.state','usermetas.district','usermetas.block','school_weeks.school_chain','users.email as User_Email','users.phone as User_Phone','school_weeks.total_participant','school_weeks.total_kms','school_weeks.role','users.rolelabel','school_weeks.eventimg_meta','school_weeks.video_link','school_weeks.eventstartdate','school_weeks.eventenddate','school_weeks.created_at']);
				
								
			} else{

				$result = DB::table('school_weeks')
						->where('role', '=' ,'individual')
						->select(['name','contact','email','organiser_name','kmrun','role','eventstartdate','eventenddate']);
						
			}

		if(!empty(request()->input('ename'))){
			
		   $result = $result->where('school_weeks.email', 'LIKE', "%".request()->input('ename')."%")
							->orWhere('school_weeks.name', 'LIKE', "%".request()->input('ename')."%")
							->orWhere('school_weeks.contact', 'LIKE', "%".request()->input('ename')."%");
		}
		
		if(!empty(request()->input('type'))){
			
		   $result = $result->where('school_weeks.role', 'LIKE', "%".request()->input('type')."%");
		}

		
		//$result=$result->skip(0)->take(3000)->get(); 
		if(request()->input('type')=='organizer'){
			$result=$result->get(); 
				if(!empty($result)){
	 				foreach($result as $key=>$org_result){
					  //echo "<pre>";print_r($org_result);
						$data[$key] = array(
							'Organizer_Name' => $org_result->Organizer_Name?$org_result->Organizer_Name:$org_result->uname,
							'User_Email' => $org_result->User_Email,
							'User_Phone' => $org_result->User_Phone,
							'total_participant' => $org_result->total_participant,
							'total_kms' => $org_result->total_kms,
							'Role' => $org_result->role,
							'state' => $org_result->state,
							'district' => $org_result->district,
							'block' => $org_result->block,
							'school_chain' => $org_result->school_chain,							
							'Registered_As' => $org_result->rolelabel,
							'Image' => @implode(',',unserialize($org_result->eventimg_meta)),
							'Video_Link' => @implode(',',unserialize($org_result->video_link)),
							'Event_Startdate' => $org_result->eventstartdate,
							'Event_Enddate' => $org_result->eventenddate,
							'created_at' => $org_result->created_at
						);
				}
			$result = collect($data);
			}
		}else{
			$result=$result->get(); 
		}
	}
	return $result;   
  }		
}
