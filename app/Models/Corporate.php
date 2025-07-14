<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Corporate extends Model
{
    use HasFactory;
	protected $table = 'corporates';
    
	public static function getAllUser(){	  
	  
	  $records = DB::table('corporates')			
		         ->orderBy('id','desc')
		         ->get(['name','contact','email','doc','emp_name','spports_name','csr_name','csr_region','org_equipment_name','org_equipment_place','eventname','eventphoto','eventdate','noofparticipant','status']);
		
		        return $records;
	}	

   public static function getAllSearch(){			
	 
	 $data = array();
		 
	 if(request()->input('search')=='search'){ 		
			
		$result = DB::table('corporates')
					->orderBy('id','desc')
					->select(['name','contact','email','doc','emp_name','spports_name','csr_name','csr_region','org_equipment_name','org_equipment_place','eventname','eventphoto','eventdate','noofparticipant','status']);
	
		if(!empty(request()->input('s'))){
			
		   $result = $result->where('corporates.email', 'LIKE', "%".request()->input('s')."%")
							->orWhere('corporates.name', 'LIKE', "%".request()->input('s')."%")
							->orWhere('corporates.contact', 'LIKE', "%".request()->input('s')."%");
		}		
		
		$result=$result->get(); 		
	
		if(!empty($result)){
			foreach($result as $key=>$org_result){
			  //echo "<pre>";print_r($org_result);
				$data[$key] = array(
					'name' => $org_result->name,
					'contact' => $org_result->contact,
					'email' => $org_result->email,
					'doc' => $org_result->doc,
					'emp_name' =>  @implode(',',unserialize($org_result->emp_name)),
					'spports_name' =>  @implode(',',unserialize($org_result->spports_name)), 
					'csr_name' => $org_result->csr_name,
					'csr_region' => $org_result->csr_region,
					'org_equipment_name' => $org_result->org_equipment_name,
					'org_equipment_place' => $org_result->org_equipment_place,							
					'eventname' => @implode(',',unserialize($org_result->eventname)), 
					'eventphoto' => @implode(',',unserialize($org_result->eventphoto)),
					'eventdate' => @implode(',',unserialize($org_result->eventdate)),					
					'noofparticipant' => @implode(',',unserialize($org_result->noofparticipant)),					
					'status' => $org_result->status
				);
			}
				
			$result = collect($data);
		}		
	}
	
	return $result;   
  }	
		
	/* public static function getAllSearch(){
		
		if(request()->input('search')=='search'){ 
		
			$result = DB::table('corporates')
					->orderBy('id','desc')
					->select(['name','contact','email','doc','emp_name','spports_name','csr_name','csr_region','org_equipment_name','org_equipment_place','eventname','eventphoto','eventdate','noofparticipant','status']);
	
		if(!empty(request()->input('s'))){
			
		   $result = $result->where('corporates.email', 'LIKE', "%".request()->input('s')."%")
							->orWhere('corporates.name', 'LIKE', "%".request()->input('s')."%")
							->orWhere('corporates.contact', 'LIKE', "%".request()->input('s')."%");
		}				
			   
		$result=$result->get(); 
	}
	
	 return $result;   
  } */
}
