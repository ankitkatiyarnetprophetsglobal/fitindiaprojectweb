<?php
namespace App\Http\Controllers\admin\auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Response, Redirect;
use App\Models\Ambassador;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use Illuminate\Support\Facades\DB;
use App\Exports\AmbsExport;
use App\Exports\PanchExport;
use App\Exports\LocalbodyExport;
use Excel;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\Admin;
use App\Models\GramPanchayat;
use App\Models\LocalBody;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AmbsController extends Controller
{
    
    public function index(Request $request)
    {
        $admins = Admin::all();
        
        $admins_role = Auth::user()->role_id;
        if($request->input('search')=='search')
        {
            
            $search_txt = $request->input('s');
            $ambassadors = Ambassador::select('ambassadors.id','ambassadors.name','ambassadors.email','ambassadors.contact','ambassadors.designation','ambassadors.state_name','ambassadors.district_name','ambassadors.block_name','ambassadors.pincode','ambassadors.facebook_profile','ambassadors.twitter_profile','ambassadors.instagram_profile','ambassadors.work_profession','ambassadors.description','ambassadors.image','ambassadors.status','ambassadors.created_at','admins.email as uemail','ambassadors.reason')
                ->leftJoin('admins', 'admins.id', '=', 'ambassadors.updated_by')
                        ->where('ambassadors.email','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.name','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.contact','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.state_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.district_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.block_name','LIKE','%'.$search_txt.'%')
                        ->paginate(40);
             $total_amb = Ambassador::select('*')
                ->leftJoin('admins', 'admins.id', '=', 'ambassadors.updated_by')
                        ->where('ambassadors.email','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.name','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.contact','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.state_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.district_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.block_name','LIKE','%'.$search_txt.'%')
                        ->count();

             $pending_amb = Ambassador::select("*")
                        ->where('ambassadors.status', '0')
                        ->where(function($query) use ($search_txt){
                            $query->where('ambassadors.email','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.contact','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.state_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.district_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.block_name','LIKE','%'.$search_txt.'%');
                        })->count();
                        
            $approved_amb = Ambassador::select("*")
                        ->where('ambassadors.status', '1')
                        ->where(function($query) use ($search_txt){
                            $query->where('ambassadors.email','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.contact','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.state_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.district_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.block_name','LIKE','%'.$search_txt.'%');
                        })->count();

            $rejected_amb = Ambassador::select("*")
                        ->where('ambassadors.status', '2')
                        ->where(function($query) use ($search_txt){
                            $query->where('ambassadors.email','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.contact','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.state_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.district_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.block_name','LIKE','%'.$search_txt.'%');
                        })->count();
        }
        else
        {
           $ambassadors = Ambassador::select('ambassadors.id','ambassadors.name','ambassadors.email','ambassadors.contact','ambassadors.designation','ambassadors.state_name','ambassadors.district_name','ambassadors.block_name','ambassadors.pincode','ambassadors.facebook_profile','ambassadors.twitter_profile','ambassadors.instagram_profile','ambassadors.work_profession','ambassadors.description','ambassadors.image','ambassadors.status','ambassadors.created_at','admins.email as uemail','ambassadors.reason')
            ->leftJoin('admins', 'admins.id', '=', 'ambassadors.updated_by')
            ->orderBy('ambassadors.id', 'DESC')
            ->paginate(40);
            $total_amb = Ambassador::all()->count();
            $rejected_amb = Ambassador::where('status','2')->count();
            $approved_amb = Ambassador::where('status','1')->count();
            $pending_amb = Ambassador::where('status','0')->count();
        }
        
        return view('admin.ambassador.index',compact('ambassadors','total_amb','rejected_amb','approved_amb','pending_amb'));
    }   
   
    public function exportAmbassador()
    {
       if(request()->has('s'))
        {
           
        return Excel::download(new AmbsExport,'ambassadorlist.xlsx');
        }
      else
        {
        return Excel::download(new AmbsExport,'ambassadorlist.xlsx');
        }
    }	
	public function ambsActive(Request $request)
    {
        // dd(1234);
        $auth_user = Auth::user();
        $response = array();
        $reject_reson = $request->rejection_value; 
        $reasons = '';
        if($reject_reson=='2'){
            $reasons = 'Followers';
        }elseif($reject_reson=='3'){
            $reasons = 'At least one social media';
        }elseif($reject_reson=='4'){
            $reasons = 'Offensive Post';
        }elseif($reject_reson=='5'){
            $reasons = 'Criminal and Legal Offence';
        }else{
            $reasons = 'Generic';
        }
        $id = $request->amb_id;
        $status = $request->status;
        $ambassador = Ambassador::findOrFail($id);
        $ambassador->status = $status;
        $ambassador->updated_by = $auth_user->id;
        $ambassador->reason = $reasons;
        if($ambassador->save()){
            $amb_info = Ambassador::find($id);
            $email = $amb_info->email;
            $names = $amb_info->name;
            if($amb_info->status=='1'){
                if($amb_info->user_checker=='0'){
                    $pass = "Use your old password";
                }
                if($amb_info->user_checker=='1'){
                    $pass = "Ambassador@123";
                }
                $response = array('status'=>1,'msg'=>'Approved','pass'=>"fasdfasd");
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,"http://10.247.140.87/mail_amb_champ.php");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,"user_email=$email&message=success&name=$names&type=Ambassador&password=$pass&reason=no");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close ($ch);
            }
            elseif($amb_info->status=='2'){
                $response = array('status'=>2,'msg'=>'Rejected',"mail"=>$email,"name"=>$names);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,"http://10.247.140.87/mail_amb_champ.php");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,"user_email=$email&message=failed&name=$names&type=Ambassador&password=none&reason=$reject_reson");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close ($ch);
            }
            else{
                $response = array('status'=>0,'msg'=>'Pending');
            }
        }
        else{
            $response = array('status'=>0,'msg'=>'failed');
        }
        echo json_encode($response);
        die;
    }

    public function gramPanchayatambassadorlist(Request $request){          
        
        if($request->input('search')=='search'){
            
            $search_txt = $request->input('s');
                    
            $gramPanchayat = GramPanchayat::select('gram_panchayat_ambassador.id','gram_panchayat_ambassador.name',
            'gram_panchayat_ambassador.email','gram_panchayat_ambassador.contact','gram_panchayat_ambassador.state_name','gram_panchayat_ambassador.district_name',
            'gram_panchayat_ambassador.block_name','gram_panchayat_ambassador.document_file','gram_panchayat_ambassador.event_image',
            'gram_panchayat_ambassador.status','admins.email as uemail')
                ->leftJoin('admins', 'admins.id', '=', 'gram_panchayat_ambassador.updated_by')
                ->where('gram_panchayat_ambassador.email','LIKE','%'.$search_txt.'%')
                ->orWhere('gram_panchayat_ambassador.name','LIKE','%'.$search_txt.'%')                          
                ->orWhere('gram_panchayat_ambassador.state_name','LIKE','%'.$search_txt.'%')
                ->orWhere('gram_panchayat_ambassador.district_name','LIKE','%'.$search_txt.'%')
                ->orWhere('gram_panchayat_ambassador.block_name','LIKE','%'.$search_txt.'%')
                ->paginate(50);            
                        
               $total= GramPanchayat::select('*')
                        ->leftJoin('admins', 'admins.id', '=', 'gram_panchayat_ambassador.updated_by')
                        ->where('gram_panchayat_ambassador.email','LIKE','%'.$search_txt.'%')
                        ->orWhere('gram_panchayat_ambassador.name','LIKE','%'.$search_txt.'%')                       
                        ->orWhere('gram_panchayat_ambassador.state_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('gram_panchayat_ambassador.district_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('gram_panchayat_ambassador.block_name','LIKE','%'.$search_txt.'%')
                        ->count();

               $pending = GramPanchayat::select("*")
                        ->where('gram_panchayat_ambassador.status', '0')
                        ->where(function($query) use ($search_txt){
                            $query->where('gram_panchayat_ambassador.email','LIKE','%'.$search_txt.'%');
                            $query->orWhere('gram_panchayat_ambassador.name','LIKE','%'.$search_txt.'%');                            
                            $query->orWhere('gram_panchayat_ambassador.state_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('gram_panchayat_ambassador.district_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('gram_panchayat_ambassador.block_name','LIKE','%'.$search_txt.'%');
                        })->count();
                        
              $approved = GramPanchayat::select("*")
                        ->where('gram_panchayat_ambassador.status', '1')
                        ->where(function($query) use ($search_txt){
                            $query->where('gram_panchayat_ambassador.email','LIKE','%'.$search_txt.'%');
                            $query->orWhere('gram_panchayat_ambassador.name','LIKE','%'.$search_txt.'%');                           
                            $query->orWhere('gram_panchayat_ambassador.state_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('gram_panchayat_ambassador.district_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('gram_panchayat_ambassador.block_name','LIKE','%'.$search_txt.'%');
                        })->count();

                $rejected = GramPanchayat::select("*")
                        ->where('gram_panchayat_ambassador.status', '2')
                        ->where(function($query) use ($search_txt){
                            $query->where('gram_panchayat_ambassador.email','LIKE','%'.$search_txt.'%');
                            $query->orWhere('gram_panchayat_ambassador.name','LIKE','%'.$search_txt.'%');                           
                            $query->orWhere('gram_panchayat_ambassador.state_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('gram_panchayat_ambassador.district_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('gram_panchayat_ambassador.block_name','LIKE','%'.$search_txt.'%');
                        })->count();
        } else { 
    
           $gramPanchayat=GramPanchayat::select('gram_panchayat_ambassador.id','gram_panchayat_ambassador.name','gram_panchayat_ambassador.email','gram_panchayat_ambassador.contact',
           'gram_panchayat_ambassador.state_name','gram_panchayat_ambassador.district_name','gram_panchayat_ambassador.block_name',
           'gram_panchayat_ambassador.social_media_url','gram_panchayat_ambassador.document_file','gram_panchayat_ambassador.age_proof','gram_panchayat_ambassador.status',
           'admins.email as uemail')
            ->leftJoin('admins', 'admins.id', '=', 'gram_panchayat_ambassador.updated_by')
            ->orderBy('gram_panchayat_ambassador.id', 'DESC')
            ->paginate(50);

            $total = GramPanchayat::all()->count();
            $rejected = GramPanchayat::where('status','2')->count();
            $approved = GramPanchayat::where('status','1')->count();
            $pending = GramPanchayat::where('status','0')->count(); 
       }       
        
        return view('admin.ambassador.panchyat',compact('gramPanchayat','total','rejected','approved','pending'));  
    }

    public function gramPanchayatAmbDetail($pactid){
        $result = GramPanchayat::select(['gram_panchayat_ambassador.name','gram_panchayat_ambassador.age',
            'gram_panchayat_ambassador.gender','gram_panchayat_ambassador.email',
            'gram_panchayat_ambassador.physical_fitness','gram_panchayat_ambassador.yclubeventcommits','gram_panchayat_ambassador.eventname','gram_panchayat_ambassador.noofparticipant',
            'gram_panchayat_ambassador.eventphoto',
            'gram_panchayat_ambassador.social_media_url','gram_panchayat_ambassador.unique_app_id'
            ,'gram_panchayat_ambassador.fitness_event','gram_panchayat_ambassador.state_name','gram_panchayat_ambassador.document_file','gram_panchayat_ambassador.age_proof',
           'gram_panchayat_ambassador.district_name','gram_panchayat_ambassador.block_name','gram_panchayat_ambassador.contact','gram_panchayat_ambassador.image'])
           ->where('gram_panchayat_ambassador.id',$pactid)
           ->first();
           return view('admin.ambassador.gram_panchayat_detail',compact('result'));
    }

	public function exportPanchayat()
    {
        if(request()->has('s'))
        {
          return Excel::download(new PanchExport,'panchyatlist.xlsx');
		} else {
		  return Excel::download(new PanchExport,'panchyatlist.xlsx');
		}
    }
	public function gpanchActive(Request $request)
    {
        $auth_user = Auth::user();
        $response = array();
        $id = $request->amb_id;
        $status = $request->status;
        $gpanch = GramPanchayat::findOrFail($id);
        $gpanch->status = $status;
        $gpanch->updated_by = $auth_user->id;
        $gpanch->updated_at  = date('Y-m-d H:i:s');
        if($gpanch->save()){
            $gmp_info = GramPanchayat::find($id);
            if($gmp_info->status=='1'){
                if($gmp_info->user_checker=='0'){
                    $pass = "Use your old password";
                }else{
                    $pass = "GramPanchayat@123";
                }
				
                $response = array('status'=>1,'msg'=>'Approved','pass'=>$pass);
                  
            }
            elseif($gmp_info->status=='2'){
                $response = array('status'=>2,'msg'=>'Rejected');              
            }
            else{
                $response = array('status'=>0,'msg'=>'Pending');
            }
        }
        else{
            $response = array('status'=>0,'msg'=>'failed');
        }
        echo json_encode($response);
        die;
    }	
   
	public function localbodyAmbassadorList(Request $request)
	{
	    if($request->input('search')=='search'){
            $search_txt = $request->input('s');
			$localBody = LocalBody::select('local_body_ambassador.id','local_body_ambassador.name',
			'local_body_ambassador.email','local_body_ambassador.contact','local_body_ambassador.state_name','local_body_ambassador.district_name',
			'local_body_ambassador.block_name','local_body_ambassador.document_file','local_body_ambassador.event_image',
			'local_body_ambassador.status','admins.email as uemail')
				->leftJoin('admins', 'admins.id', '=', 'local_body_ambassador.updated_by')
				->where('local_body_ambassador.email','LIKE','%'.$search_txt.'%')
				->orWhere('local_body_ambassador.name','LIKE','%'.$search_txt.'%')							
				->orWhere('local_body_ambassador.state_name','LIKE','%'.$search_txt.'%')
				->orWhere('local_body_ambassador.district_name','LIKE','%'.$search_txt.'%')
				->orWhere('local_body_ambassador.block_name','LIKE','%'.$search_txt.'%')
				->paginate(50);  		   
	            $total= LocalBody::select('*')
                        ->leftJoin('admins', 'admins.id', '=', 'local_body_ambassador.updated_by')
                        ->where('local_body_ambassador.email','LIKE','%'.$search_txt.'%')
                        ->orWhere('local_body_ambassador.name','LIKE','%'.$search_txt.'%')                       
                        ->orWhere('local_body_ambassador.state_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('local_body_ambassador.district_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('local_body_ambassador.block_name','LIKE','%'.$search_txt.'%')
                        ->count();
                $pending = LocalBody::select("*")
                        ->where('local_body_ambassador.status', '0')
                        ->where(function($query) use ($search_txt){
                            $query->where('local_body_ambassador.email','LIKE','%'.$search_txt.'%');
                            $query->orWhere('local_body_ambassador.name','LIKE','%'.$search_txt.'%');                            
                            $query->orWhere('local_body_ambassador.state_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('local_body_ambassador.district_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('local_body_ambassador.block_name','LIKE','%'.$search_txt.'%');
                        })->count();
                $approved = LocalBody::select("*")
                        ->where('local_body_ambassador.status', '1')
                        ->where(function($query) use ($search_txt){
                            $query->where('local_body_ambassador.email','LIKE','%'.$search_txt.'%');
                            $query->orWhere('local_body_ambassador.name','LIKE','%'.$search_txt.'%');                           
                            $query->orWhere('local_body_ambassador.state_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('local_body_ambassador.district_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('local_body_ambassador.block_name','LIKE','%'.$search_txt.'%');
                        })->count();

                $rejected = LocalBody::select("*")
                        ->where('local_body_ambassador.status', '2')
                        ->where(function($query) use ($search_txt){
                            $query->where('local_body_ambassador.email','LIKE','%'.$search_txt.'%');
                            $query->orWhere('local_body_ambassador.name','LIKE','%'.$search_txt.'%');                           
                            $query->orWhere('local_body_ambassador.state_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('local_body_ambassador.district_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('local_body_ambassador.block_name','LIKE','%'.$search_txt.'%');
                        })->count();
        } else { 
	
	       $localBody = LocalBody::select('local_body_ambassador.id','local_body_ambassador.name',
		   'local_body_ambassador.email','local_body_ambassador.contact','local_body_ambassador.state_name','local_body_ambassador.district_name',
			'local_body_ambassador.block_name','local_body_ambassador.document_file','local_body_ambassador.event_image',
			'local_body_ambassador.status','admins.email as uemail')
			->leftJoin('admins', 'admins.id', '=', 'local_body_ambassador.updated_by')
			->orderBy('local_body_ambassador.id', 'DESC')
			->paginate(50);

            $total = LocalBody::all()->count();
            $rejected = LocalBody::where('status','2')->count();
            $approved = LocalBody::where('status','1')->count();
            $pending = LocalBody::where('status','0')->count(); 
       }	   
        
        return view('admin.ambassador.localbody',compact('localBody','total','rejected','approved','pending'));	
	}
	public function localbodyAmbDetail($lbid)
	{
        dd(123456);
		$result = LocalBody::select(['local_body_ambassador.name','local_body_ambassador.age','local_body_ambassador.gender','local_body_ambassador.email',
			'local_body_ambassador.social_media_url','local_body_ambassador.social_media_handle','local_body_ambassador.unique_app_id'
	       ,'local_body_ambassador.fitness_event','local_body_ambassador.state_name','local_body_ambassador.physical_fitness',
	       'local_body_ambassador.yclubeventcommits','local_body_ambassador.eventname','local_body_ambassador.noofparticipant','local_body_ambassador.eventphoto',
		   'local_body_ambassador.district_name','local_body_ambassador.block_name','local_body_ambassador.contact','local_body_ambassador.image'])
		   ->where('local_body_ambassador.id',$lbid)
		  ->first();
            return view('admin.ambassador.localbody_detail',compact('result'));
	}
	public function exportLocalBody()
    {
        if(request()->has('s'))
        {
          return Excel::download(new LocalbodyExport,'localbodylist.xlsx');
		}
		else {
		  return Excel::download(new LocalbodyExport,'localbodylist.xlsx');
		}
    }
	public function localbodyActive(Request $request)
	{
		$auth_user = Auth::user();
        $response = array();
        $id = $request->amb_id;
        $status = $request->status;
        $lbody = LocalBody::findOrFail($id);
        $lbody->status = $status;
        $lbody->updated_by = $auth_user->id;
        if($lbody->save()){
            $lbody_info = LocalBody::find($id);
            if($lbody_info->status=='1'){
                if($gmp_info->user_checker=='0'){
                    $pass = "Use your old password";
                }else{
                    $pass = "Localbody@123";
                }
				
                $response = array('status'=>1,'msg'=>'Approved','pass'=>$pass);
                  
            }
            elseif($lbody_info->status=='2'){
                $response = array('status'=>2,'msg'=>'Rejected');              
            }
            else{
                $response = array('status'=>0,'msg'=>'Pending');
            }
        }
        else{
            $response = array('status'=>0,'msg'=>'failed');
        }
        echo json_encode($response);
        die;
	}
}
