<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Freedomrun extends Model
{
    use HasFactory;
    protected $table ='freedomruns';
    
    protected $fillable = [
        'user_id',
		'type',
        'category',
        'name',
        'email',
        'contact',
        'school_chain',
        'eventimage1',
        'eventimage2',
        'video_link',
        'eventstartdate',
        'eventenddate',
        'organiser_name',
        'participantnum',
        'kmrun',
        'participant_names'
        ];  
		
	public static function getAllFreedomrun(){
	  
	  $records = DB::table('freedomruns')
		->orderBy('name','desc')
		->get(['name','contact','email','organiser_name','role','eventstartdate','eventenddate'])
		->where('role', '=' ,'individual');
		
		return $records;
	}	
		
	public static function getAllSearch(){			
		 $data = array();
		 
		 if(request()->input('search')=='search'){ 			
		
			if(request()->input('type')=='organizer'){
				//DB::enableQueryLog();
				$result = DB::table('freedomruns')
						->leftJoin('users', 'users.id', '=', 'freedomruns.user_id')
						->leftJoin('usermetas', 'usermetas.user_id', '=', 'users.id')
						->where('freedomruns.role', '=' ,'organizer')
						->select(['users.name as uname','freedomruns.organiser_name as Organizer_Name','usermetas.state','usermetas.district','usermetas.block','freedomruns.school_chain','users.email as User_Email','users.phone as User_Phone','freedomruns.total_participant','freedomruns.total_kms','freedomruns.role','users.rolelabel','freedomruns.eventimg_meta','freedomruns.video_link','freedomruns.eventstartdate','freedomruns.eventenddate','freedomruns.created_at']);
				
								
			} else{

				$result = DB::table('freedomruns')
						->where('role', '=' ,'individual')
						->select(['name','contact','email','organiser_name','kmrun','role','eventstartdate','eventenddate']);
						
			}

		if(!empty(request()->input('ename'))){
			
		   $result = $result->where('freedomruns.email', 'LIKE', "%".request()->input('ename')."%")
							->orWhere('freedomruns.name', 'LIKE', "%".request()->input('ename')."%")
							->orWhere('freedomruns.contact', 'LIKE', "%".request()->input('ename')."%");
		}
		
		if(!empty(request()->input('type'))){
			
		   $result = $result->where('freedomruns.role', 'LIKE', "%".request()->input('type')."%");
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