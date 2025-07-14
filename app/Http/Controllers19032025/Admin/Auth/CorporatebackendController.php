<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Corporate;
use App\Exports\CorporateExport;
use Illuminate\Support\Facades\DB;
use Excel;

class CorporatebackendController extends Controller
{
    public function index(Request $request) 
    {		
      // dd('kkkkk');
		if($request->input('search')=='Search')
    	{
    					
			
			$data = DB::table('corporates')
					->select(['id','name','email','contact','facebook_profile','twitter_profile','instagram_profile','mobile_app_id','app_emp_num','doc','emp_name','spports_name','csr_name','csr_region','org_equipment_name','org_equipment_place','eventname','eventphoto','eventdate','noofparticipant','status']);
			
			if($request->corporate_name){  
				
				$data = $data->where('corporates.email', 'LIKE', "%".$request->corporate_name."%")
					    ->orWhere('corporates.name', 'LIKE', "%".$request->corporate_name."%")
					    ->orWhere('corporates.contact', 'LIKE', "%".$request->corporate_name."%");
            }			
					
			$corporate = $data->paginate(50);			
			$count = $data->count();
			
			/* $count = DB::table('corporates')
					->select(['id','name','email','contact','facebook_profile','twitter_profile','instagram_profile','mobile_app_id','app_emp_num','doc','emp_name','spports_name','csr_name','csr_region','org_equipment_name','org_equipment_place','eventname','eventphoto','eventdate','noofparticipant','status'])
					->count();	 */			
    	} else {
       		
			// $corporate = Corporate::orderBy('id', 'DESC')->paginate(50);
			$corporate = Corporate::orderBy('id', 'DESC')->get();
			$count = DB::table('corporates')
					->select(['id','name','email','contact','facebook_profile','twitter_profile','instagram_profile','mobile_app_id','app_emp_num','doc','emp_name','spports_name','csr_name','csr_region','org_equipment_name','org_equipment_place','eventname','eventphoto','eventdate','noofparticipant','status'])
					->count();	       
    	}
      dd($corporate);
        return view('admin.corporate.index',compact('corporate','count'));
    }
   
    public function create()
    {
        //return view('admin.freedomrun.create');
    }
   
    public function store(Request $request)
    {    
	        
    }
    
    public function show($id)
    {
        //
    }
	
	public function corporatedetail($cid){
		   
		   $application_data = Corporate::where('id', $cid)->first();
		   
           return view('admin.corporate.details',compact('application_data'));
    }
   
    public function edit($id)//pedit
    {
        
    }
    
    public function update(Request $request, $id)
    { 
    }		
   
   
    public function export(Request $request){       
	  if(request()->has('s')){           
        return Excel::download(new CorporateExport,'corporatelist.xlsx');
      } else {
        return Excel::download(new CorporateExport,'corporatelist.xlsx');
      }
    }		
}

