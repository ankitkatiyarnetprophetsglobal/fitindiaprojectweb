<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Freedomrun;
use App\Models\Freedomrunpartners;
use Illuminate\Support\Facades\DB;
use App\Exports\FreedomrunExport;
use App\Exports\PartnerExport;
use Excel;

class FreedomrunbackendController extends Controller
{
    public function partner(Request $request) 
    {
       if($request->input('search')=='Search'){
    		
			$data = Freedomrunpartners::select(['id','org_name','event_name','email_id','contact','from_date','to_date','photo','website_link','status']);	
			
            if($request->event_name){  
				
				$data = $data->where('org_name', 'LIKE', "%".$request->event_name."%")
					    ->orWhere('email_id', 'LIKE', "%".$request->event_name."%")
					    ->orWhere('contact', 'LIKE', "%".$request->event_name."%");

            }		
					
			$partners = $data->paginate(40);
			$count = Freedomrunpartners::count();	
			
    	} else 	{
       		
			$partners = Freedomrunpartners::orderBy('org_name', 'ASC')->paginate(40);
			$count = Freedomrunpartners::count();	     
    	}
	
        return view('admin.freedomrun-partner.index',compact('partners','count'));	  
	}	
	
	public function partnerActive(Request $request)
    {        
		$id = $request->amb_id;       		
        $partner = Freedomrunpartners::findOrFail($id);
        $partner->status = $request->status;
        $partner->save();
		
		return redirect('admin/freedomrun-partner')->with(['status' => 'success' , 'msg' => 'Successfully Updated']);
    }
	
	public function partnerEstatus($id)
    {
       $partner = Freedomrunpartners::findOrFail($id);
       return view('admin.freedomrun-partner.edit',compact('partner'));		       
    }	
	
	public function partnerUpstatus(Request $request, $id)
    {
        $photo = '';      
        $year = date("Y/m"); 
		
		$request->validate([
            'org_name' => 'required',
            'event_name' => 'required',
            'email_id' => 'required|string|email|unique:freedom_run_partners',
            'contact' =>'required|digits:10',
			'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',			
        ],[
			'org_name.required' =>'Organization Name field is required.',
			'event_name.required' =>'Event Name field is required.',
			'email_id.required' =>'Email field is required.',
			'email_id.email' =>'Please enter correct Email format.',
			'email_id.unique' =>'Email already exist.',
			'contact.required' =>'Mobile field is required.',
			'contact.digits' =>'Mobile field must have 10 digit.',		
			'photo.required' =>'Please Upload Photo.',		
			'photo.mimes' =>'Please Upload jpg,png,jpeg,gif,svg.',		
			'photo.max' =>'Please Upload max 2MB File.',						
		 ]	
		);	
         
        if($request->file('photo'))
        {
            $photo = $request->file('photo')->store('photo',['disk'=> 'uploads']);
            $photo = url('wp-content/uploads/'.$photo);
        }	
		
        $partner = Freedomrunpartners::find($id);	        
		$partner->org_name = $request->org_name;
		$partner->event_name = $request->event_name;
		$partner->email_id = $request->email_id;
		$partner->contact = $request->contact;
		$partner->photo = $photo;
		$partner->from_date = $request->from_date; 
		$partner->to_date = $request->to_date;	         
        $partner->save(); 
    
        return redirect('admin/freedomrun-partner')->with(['status' => 'success' , 'msg' => 'Successfully Updated']);
    }
	
	public function organizerEstatus($id)
    {
        $organizer = DB::table('freedomruns')
		->select( 'freedomruns.id', 'freedomruns.user_id', 'users.name','users.email','users.phone','freedomruns.school_chain','freedomruns.eventstartdate','freedomruns.eventenddate','freedomruns.eventimg_meta','freedomruns.eventdate_meta','freedomruns.eventpnt_meta','freedomruns.eventkm_meta','freedomruns.total_participant','freedomruns.total_kms','freedomruns.video_link','freedomruns.organiser_name','freedomruns.created_at')
		->leftJoin('users','users.id','=','freedomruns.user_id')
		->where(['freedomruns.id' => $id, 'freedomruns.role' => 'organizer'])
		->first();
	
	    return view('admin.freedomrun-organizer.edit',compact('organizer'));		
    }
	
	public function organizerUpstatus(Request $request, $id)
    { 
		$photo = '';      
        $year = date("Y/m"); 
		/*$request->validate([
            'name' => 'required',
            'organiser_name' => 'required',
            'email' => 'required|string',
            'contact' =>'required|digits:10',
        ],[
			'name.required' =>'Organization Name field is required.',
			'organiser_name.required' =>'Event Name field is required.',
			'email.required' =>'Email field is required.',
			'email.email' =>'Please enter correct Email format.',
			'email.unique' =>'Email already exist.',
			'contact.required' =>'Mobile field is required.',
			'contact.digits' =>'Mobile field must have 10 digit.',		
		]	
		);*/
		
		
		//dd($id);die();
		
		$uid=!empty($id) ? $id :  $request->freedom_id;         

        $total_participant = @array_sum($request->number_of_partcipant);
        $total_kms = @array_sum($request->km);
		
		//$total_participant=!empty($request->total_participants) ? $request->total_participants : $total_participant;
		
		//$total_kms=!empty($request->total_kms) ? $request->total_kms :  $total_kms;
		
		
		$freedom_update = Freedomrun::find($uid);
		
		$freedom_update->eventpnt_meta = serialize($request->number_of_partcipant);           
		$freedom_update->eventkm_meta = serialize($request->km);
		$freedom_update->total_participant = !empty($total_participant) ? $total_participant : $request->total_participants;
		$freedom_update->total_kms = !empty($total_kms) ? $total_kms : $request->total_kms;		       
        $freedom_update->save();
		
       
		/* $freedom_update = Freedomrun::where('id', '=', $uid)->update(['eventpnt_meta' => serialize($request->number_of_partcipant),
        	'eventkm_meta' => serialize($request->km),'total_participant'=>@$total_participant,'total_kms'=>@$total_kms]); */

       	if($freedom_update){
       		return redirect()->back()->with(['status'  => 'Successfully Updated']);   
       	}else{
       		return redirect()->back()->with(['failed' => 'Something Wrong']);   
       	}        
    }
	
	public function organizer(Request $request) 
    {		
		if($request->input('search')=='Search')
    	{
    		$data = DB::table('freedomruns')
			        ->leftJoin('users', 'users.id', '=', 'freedomruns.user_id')
					->select(['freedomruns.id','freedomruns.email as femail','freedomruns.name as fname','users.id as uid','users.phone','users.email as uemail','users.name','freedomruns.contact','freedomruns.organiser_name','freedomruns.participantnum','freedomruns.role'])
					->where('freedomruns.role', '=' ,'organizer');			

            if($request->event_name){ //uemail phone

                $data = $data->where('freedomruns.email', 'LIKE', "%".$request->event_name."%")
					    ->orWhere('users.email', 'LIKE', "%".$request->event_name."%")
					    ->orWhere('freedomruns.name', 'LIKE', "%".$request->event_name."%")
					    ->orWhere('users.name', 'LIKE', "%".$request->event_name."%")
					    ->orWhere('users.phone', 'LIKE', "%".$request->event_name."%")
					    ->orWhere('freedomruns.contact', 'LIKE', "%".$request->event_name."%");				
				
				/* $data = $data->where('users.email', 'LIKE', "%".$request->event_name."%")
					    ->orWhere('users.name', 'LIKE', "%".$request->event_name."%")
					    ->orWhere('freedomruns.contact', 'LIKE', "%".$request->event_name."%");*/
            }
			
			$count = DB::table('freedomruns')
			        ->leftJoin('users', 'users.id', '=', 'freedomruns.user_id')
					->select(['freedomruns.id','freedomruns.email as femail','freedomruns.name as fname','users.id as uid','users.phone','users.email as uemail','users.name','freedomruns.contact','freedomruns.organiser_name','freedomruns.participantnum','freedomruns.role'])
					->where('freedomruns.role', '=' ,'organizer')->count();		
			
			//$count = Freedomrun::count();			
			$organizer = $data->paginate(40);
			
    	} else 	{
       		
			$organizer = DB::table('freedomruns')
			        ->leftJoin('users', 'users.id', '=', 'freedomruns.user_id')
					->select(['freedomruns.id','freedomruns.email as femail','freedomruns.name as fname','users.id as uid','users.phone','users.email as uemail','users.name','freedomruns.contact','freedomruns.organiser_name','freedomruns.participantnum','freedomruns.role'])
					->where('freedomruns.role', '=' ,'organizer')->paginate(40);		

			
			$count = DB::table('freedomruns')
			        ->leftJoin('users', 'users.id', '=', 'freedomruns.user_id')
					->select(['freedomruns.id','freedomruns.email as femail','freedomruns.name as fname','users.id as uid','users.email as uemail','users.name','freedomruns.contact','freedomruns.organiser_name','freedomruns.participantnum','freedomruns.role'])
					->where('freedomruns.role', '=' ,'organizer')->count();	
    	}


        //dd($organizer);	uemail	
			
        return view('admin.freedomrun-organizer.index',compact('organizer','count'));
    }	
	
	public function index(Request $request) 
    {		
		if($request->input('search')=='Search')
    	{
    		$data = DB::table('freedomruns')
					->select(['id','name','email','contact','eventimage1','eventimage2','organiser_name','participantnum','role'])
					->where('role', '=','individual');			

            if($request->event_name){  
				
				$data = $data->where('freedomruns.email', 'LIKE', "%".$request->event_name."%")
					    ->orWhere('freedomruns.name', 'LIKE', "%".$request->event_name."%")
					    ->orWhere('freedomruns.contact', 'LIKE', "%".$request->event_name."%");

            }
			
			//$count = Freedomrun::count();			
			$freedomrun = $data->paginate(40);
			$count = DB::table('freedomruns')
					->select(['id','name','email','contact','eventimage1','eventimage2','organiser_name','participantnum','role'])
					->where('role', '=','individual')->count();	
			
    	} else 	{
       		
			$freedomrun = Freedomrun::orderBy('name', 'ASC')->where('role','=','individual')->paginate(40);
			//$count = Freedomrun::count();
			$count = DB::table('freedomruns')
					->select(['id','name','email','contact','eventimage1','eventimage2','organiser_name','participantnum','role'])
					->where('role', '=','individual')->count();	
       
    	}

	
        return view('admin.freedomrun-individual.index',compact('freedomrun','count'));
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
   
    public function edit($id)//pedit
    {
        //dd($id);die;
        $freedomrun = Freedomrun::findOrFail($id);
        return view('admin.freedomrun-individual.edit',compact('freedomrun'));
    }
    
    public function update(Request $request, $id)
    { 
        $eventimage1 = '';
        $eventimage2 = '';
        $year = date("Y/m"); 
		
		$request->validate([
            'name' => 'required',
            'email' => 'required|string|email|unique:freedomruns',
            'contact' =>'required|digits:10',
			'eventimage1' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
			'eventimage2' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ],[
			'name.required' => 'The user name field is required.',
			'email.required' =>'Email field is required.',
			'email.email' =>'Please enter correct email format.',
			'email.unique' =>'Email already exist.',
			'contact.required' =>'Mobile field is required.',
			'contact.digits' =>'Mobile field must have 10 digit.',		
			'eventimage1.required' =>'Please Upload eventimage1.',		
			'eventimage1.mimes' =>'Please Upload jpg,png,jpeg,gif,svg.',		
			'eventimage1.max' =>'Please Upload max 2MB File.',		
			'eventimage2.required' =>'Please Upload eventimage2.',
            'eventimage2.mimes' =>'Please Upload jpg,png,jpeg,gif,svg.',		
			'eventimage2.max' =>'Please Upload max 2MB File.',				
		 ]	
		);	
         
        if($request->file('eventimage1'))
        {
            $eventimage1 = $request->file('eventimage1')->store('eventimage1',['disk'=> 'uploads']);
            $eventimage1 = url('wp-content/uploads/'.$eventimage1);
        }
		
		if($request->file('eventimage2'))
        {
            $eventimage2 = $request->file('eventimage2')->store('eventimage2',['disk'=> 'uploads']);
            $eventimage2 = url('wp-content/uploads/'.$eventimage2);
        }
		
		
        $freedomrun = Freedomrun::find($id);	        
		$freedomrun->name = $request->name;
		$freedomrun->email = $request->email;
		$freedomrun->contact = $request->contact;
		$freedomrun->organiser_name = $request->organiser_name; 
		$freedomrun->participantnum = $request->participantnum;
		$freedomrun->eventstartdate = $request->eventstartdate;
		$freedomrun->eventenddate = $request->eventenddate;
        $freedomrun->eventimage1 = $eventimage1;           
		$freedomrun->eventimage2 = $eventimage2;           
        $freedomrun->save();
    
        return redirect('admin/freedomrun-individual')->with(['status' => 'success' , 'msg' => 'Successfully Updated']);
    }
	
	public function partnerDelete($id)
    {
       $partner = Freedomrunpartners::findOrFail($id);	   
	   $partner->delete();
	   
	   return redirect()->back()->with(['status' => 'success', 'msg' => 'Successfully Deleted']);
       
	  // return redirect('admin/freedomrun-individual')->with(['status' => 'success', 'msg' => 'Successfully Deleted']);
    }
	
	public function partnerdeleteAll(Request $request)
    {       		
		$ids = $request->ids;
        DB::table("freedom_run_partners")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Partner Deleted successfully."]);
    }
	
	public function organizerDelete($id)
    {
       $org = Freedomrun::findOrFail($id);	   
	   $org->delete();	   
	   return redirect()->back()->with(['status' => 'success', 'msg' => 'Successfully Deleted']);     
	}	
	
    public function pexport(Request $request){
	   if(request()->has('ename')){           
           return Excel::download(new PartnerExport,'partnerlist.xlsx');
        } else {
          return Excel::download(new PartnerExport,'partnerlist.xlsx');
        }   
    }  
   
    public function export(Request $request){
       if(request()->has('ename'))
        {
           
        return Excel::download(new FreedomrunExport,'freedomrunlist.xlsx');
        }
      else
        {
        return Excel::download(new FreedomrunExport,'freedomrunlist.xlsx');
        }
    }		
}

