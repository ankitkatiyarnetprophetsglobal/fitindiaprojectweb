<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Response, Redirect;
use App\Models\LocalBody;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\Role;
use App\Models\CertRequest;
use App\Models\CertQues;
use App\Models\CertStatus;
use App\Models\Userkey;
use App\Models\YouthStatus;
use App\Models\YouthCertRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use PDF;
use Illuminate\Support\Facades\Auth;

class LocalbodyController extends Controller
{	
   /*public function index()
    {
       $states = State::all();
       return view('local-bodyambassador',compact('states'));
    }*/
  
    public function index(){
        if(Auth::user()->role){
    		$role = Auth::user()->role;
        	$email = Auth::user()->email;
        	$states = State::all();
        	$id = Auth::user()->id;

        	$userInfo = DB::table('users')
            ->join('usermetas', 'users.id', '=', 'usermetas.user_id')
            ->select('users.*', 'usermetas.gender', 'usermetas.address', 'usermetas.state', 'usermetas.district', 'usermetas.block', 'usermetas.city', 'usermetas.mobile', 'usermetas.orgname', 'usermetas.udise', 'usermetas.pincode')
            ->where('users.id',$id)
            ->first();

            $states = State::whereNotIn('name', [@$userInfo->state])->get();
        	$get_state_id = State::where('name', @$userInfo->state)->first();

	        $district = District::where('state_id',@$get_state_id->id)->whereNotIn('name', [@$userInfo->district])->get();
	        $get_district_id = District::where('name',@$userInfo->district)->first();

	        $blocks = Block::where('district_id',@$get_district_id->id)->whereNotIn('name', [@$userInfo->block])->get();
	        $get_block_id = Block::where('name',@$userInfo->block)->first();

			$role = Role::where('slug', $role)->first()->name;
	    	$LocalBody_data = LocalBody::where('email',$email)->first();
	    	if(!empty($LocalBody_data)){
	        	return view('localbody.application_status',['prerak_data' => $LocalBody_data, 'role' => $role ]);
	    	}else{
	       	 	return view('localbody/localbody-ambassador', ['role' => @$role , 'get_state_id'=>@$get_state_id, 'states'=>@$states,'user_info'=>@$userInfo, 'get_district_id'=>@$get_district_id, 'district' => @$district, 'get_block_id'=>@$get_block_id, 'blocks'=>@$blocks ]);
	    	}
        }else{
        	abort(404);
        }
    }
	
    public function mobileLocalBody()
    {
    	$id = @$_REQUEST['auth_id'];
    	$usersData = DB::table('users')->where('id',$id)->first();
		if(!empty($usersData)){
	    	if(!empty($id)){
	        	$userInfo = DB::table('users')
	            ->join('usermetas', 'users.id', '=', 'usermetas.user_id')
	            ->select('users.*', 'usermetas.gender', 'usermetas.address', 'usermetas.state', 'usermetas.district', 'usermetas.block', 'usermetas.city', 'usermetas.mobile', 'usermetas.orgname', 'usermetas.udise', 'usermetas.pincode')
	            ->where('users.id',$id)
	            ->first();

	            $role = $userInfo->role;
	        	$email = $userInfo->email;
	        	$states = State::all();
	        	$id = $userInfo->id;

	            $states = State::whereNotIn('name', [@$userInfo->state])->get();
	        	$get_state_id = State::where('name', @$userInfo->state)->first();

		        $district = District::where('state_id',@$get_state_id->id)->whereNotIn('name', [@$userInfo->district])->get();
		        $get_district_id = District::where('name',@$userInfo->district)->first();

		        $blocks = Block::where('district_id',@$get_district_id->id)->whereNotIn('name', [@$userInfo->block])->get();
		        $get_block_id = Block::where('name',@$userInfo->block)->first();

				$role = Role::where('slug', $role)->first()->name;
		    	$LocalBody_data = LocalBody::where('email',$email)->first();
		    	if(!empty($LocalBody_data)){
		        	return view('localbody.application_status',['prerak_data' => $LocalBody_data, 'role' => $role ]);
		    	}else{
		       	 	return view('localbody/localbody-ambassador-mobile', ['role' => @$role , 'get_state_id'=>@$get_state_id, 'states'=>@$states,'user_info'=>@$userInfo, 'get_district_id'=>@$get_district_id, 'district' => @$district, 'get_block_id'=>@$get_block_id, 'blocks'=>@$blocks ]);
		    	}
	    	}else{
	    		abort(404);
	    	}
	    }else{
	    	abort(404);
	    }
    }
	
	
  public function youthclubcertificate(Request $request){
    
	$id = @$_REQUEST['auth_id'];
	
	if(!empty($id)){
	   $udata = User::where('id',$id)->first(); 
	}	
	//dd($udata);die;
			
	if(!empty($udata)){		
      $userid = $udata->id;
	  $role = $udata->role;	   	 			  
	}else{
      return back()->with('error','Unauthorized');//exit();		       
	}
		
	   // $role = Auth::user()->role;flagdata
		$roleslug = $role;
        
		if(!empty($role))
		{
            $appliedfor = false; 
			$currentflag = false;
            $appliedfor = Userkey::where('user_id',$id)->where('key','youthclubreqid')->first();
            
			if($appliedfor){
                if($appliedfor->value){
                    $appliedfor = $appliedfor->value;
                }
            }

            $flags = CertQues::where('cert_cats_id',12977)->orderBy('priority', 'asc')->get();
                        
            $role = Role::where('slug', $role)->first()->name;
			$states = State::all();
			$districts = District::all();
			$blocks = Block::all();
			
			if($appliedfor){
			
				if($appliedfor == 12977) {
					
					$flagdata = YouthCertRequest::where('user_id', $id)->where('cat_id', 12977)->first();
					$flagstatusdata = YouthStatus::where('user_id', $id)->where('cat_id', 12977)->first();


					return view('event.youth_cert', ['userid'=> $userid,'user_id'=> $id,'role' => $role, 'roleslug'=> $roleslug, 'flags' => $flags, 'appliedfor'=> $appliedfor, 
					'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata , 'states' => $states, 'districts' => $districts, 'blocks' => $blocks 
					]);
				}
	
			}else{
				return view('event.youth_cert', ['userid'=> $userid,'user_id'=> $id , 'role'=> $role, 'roleslug'=> $roleslug,  'flags'=> $flags, 'appliedfor'=> $appliedfor, 'states' => $states, 'districts' => $districts, 'blocks' => $blocks ]);
			}
        }else{
			abort(404);
		}

       //return view('event.youth_cert');  	  
  }
	
	public function storeyouthcert1(Request $request){	
	
		$rules = [
			'state' => 'required',
			'district' => 'required',
			'block' => 'required',
			'noofmembers' => 'required|numeric|min:1|max:1000',
			'nameofclub' => 'required|min:2|regex:/(^[A-Za-z ]+$)+/',
			'affiliationno' => 'required|min:3',
			'anysports' => 'required|min:2|regex:/(^[A-Za-z ]+$)+/',
			'anysportsmin' => 'required',
			'traditionalgame' => 'required|min:2|regex:/(^[A-Za-z ]+$)+/',
			'traditionalgamemin' => 'required',
			'walkingmin' => 'required|numeric|min:1',					
			'cyclingmin' => 'required|numeric|min:1',
			'runningmin' => 'required|numeric|min:1',
			'otherpa' => 'required|min:2|regex:/(^[A-Za-z ]+$)+/',
			'otherpamin' => 'required',
            'motivatecommits' => 'required',
			'youthclubcommits' => 'required',
			'mpname' => 'required|array',
			'mpcontact' => 'required|array',
			'mpphyactivity' => 'required|array',			
			'yclubeventcommits' => 'required',
			'eventname' => 'required|array',
			'noofparticipant' => 'required|array',
			
			/*'anysports' => 'required_with:anysportsmin',  
			  'anysportsmin' => 'required_with:anysports', walkingmin cyclingmin runningmin otherpa
			'traditionalgame' => 'required_with:traditionalgamemin',
			'traditionalgamemin' => 'required_with:traditionalgame', */
			//'walkingmin' => 'required|numeric|min:1',					
			//'cyclingmin' => 'required|numeric|min:1',
			//'runningmin' => 'required|numeric|min:1',
			/*'otherpa' => 'required_with:otherpamin', */
			//'otherpamin' => 'required_with:otherpa',			
			//'mpname.*'  => 'required|regex:/(^[A-Za-z ]+$)+/|min:2',
			//'mpcontact.*' => 'required|regex:/(^[0-9]+$)+/|min:10',
			//'mpphyactivity.*' => 'required|regex:/(^[A-Za-z ]+$)+/|min:2',			
			//'eventname.*'  => 'required|regex:/(^[A-Za-z0-9 ]+$)+/|min:2',
			//'noofparticipant.*' => 'required|numeric|min:1',
			/* 'eventphoto' => 'required|array', */
			//'eventphoto.*' => 'required|mimes:jpg,jpeg,png|max:2000',
        ];
		
       //YouthStatus

       $messages = [ 
			/*'anysports.required_with' => 'Any Sports is required',
             'anysportsmin.required_with' => 'Any Sports minutes is required',
			*/
			//yclubeventcommits
			
			'yclubeventcommits.required' => 'The youth club event commits field is required',			
			'youthclubcommits.required' => 'The youth club commits field is required',			
			'motivatecommits.required' => 'The motivate commits field is required',			
			'noofmembers.required' => 'The no.of members field is required',			
			'nameofclub.required' => 'The name of youth club field is required',			
			'affiliationno.required' => 'The affiliation certification number is required',			
			'anysports.required' => 'Any Sports is required',			
			'anysportsmin.required' => 'Any Sports minutes is required',			
			'otherpa.required' => 'Any other physical activity is required',
			'otherpamin.required' => 'Any other physical activity minutes is required',
			'mpname.required' => 'Name of motivated person is required',
			'mpcontact.required' => 'Contact number is required',
			'mpphyactivity.required' => 'Physical activity/sports is required',
			'mpname.*.required' => 'Name of motivated person is required',
			'mpname.*.regex' => 'Name of motivated person must contain letter only',
			'mpcontact.*.required' => 'Contact number is required',
			'mpcontact.*.regex' => 'Contact number must contain numbers only',
			'mpcontact.*.min' => 'Contact number must contain 10 numbers',
			'mpphyactivity.*.required' => 'Physical activity/sports is required',
			'mpphyactivity.*.regex' => 'Physical activity/sports must contain letter only',
			'eventname.*.required' => 'Name of the event is required',
			'eventname.*.regex' => 'Name of the event must contain letter or number only',
			'noofparticipant.*.required' => 'Number of participants is required',
			'noofparticipant.*.numeric' => 'Number of participants must contain numbers only',
			'noofparticipant.*.min' => 'Number of participants minimum 1',
			/*'eventphoto.required' => 'Please upload all Fit India event images',
			'eventphoto.*.required' => ' Please upload Fit India event image', 
			'eventphoto.*.mimes' => 'Only jpeg, png, jpg images are allowed',
			'eventphoto.*.max' => 'Maximum allowed size for an image is 2MB',*/
	   ];
	   
	   $request->validate($rules , $messages );
		 
		
		$chkerro = false;
		$validator = Validator::make([],[]);
		
		
		$minsum = 0;
		$minsum += $request->anysportsmin + $request->traditionalgamemin + $request->walkingmin + $request->cyclingmin + $request->runningmin + $request->otherpamin;
		if($minsum < 30){
			$chkerro = true;
			$validator->errors()->add("eachmembermin", 'Each member of the Youth club should spend atleast 30 minutes daily for at least 5 days every week for group physical activities');
		}
		
		$mpnameflag = true;
		foreach($request->mpname as $mpname){ if(!empty($mpname) ){ $mpnameflag = false; } }
		if($mpnameflag){ $chkerro = true; $validator->errors()->add("mpname", 'Name of motivated person is required'); }
		
		$mpcontactflag = true;
		$mpcontactflagnumeric = false;
		foreach($request->mpcontact as $mpcontact){ 
			if(!empty($mpcontact) ){ 
				$mpcontactflag = false;
				if(!is_numeric($mpcontact)) {
						$mpcontactflagnumeric = true;
				}
			} 
		}
		if($mpcontactflag){ $chkerro = true; $validator->errors()->add("mpcontact", 'Motivated person contact is required'); }
		if($mpcontactflagnumeric){ $chkerro = true; $validator->errors()->add("mpcontacttype", 'Motivated person contact must be number'); }
		
		$mpphyactivityflag = true;
		foreach($request->mpphyactivity as $mpphyactivity){ if(!empty($mpphyactivity) ){ $mpphyactivityflag = false; } }
		if($mpphyactivityflag){ $chkerro = true; $validator->errors()->add("mpphyactivity", 'Physical activity/sports is required'); }
		
		$eventnameflag = true;
		foreach($request->eventname as $eventname){ if(!empty($eventname) ){ $eventnameflag = false; } }
		if($eventnameflag){ $chkerro = true; $validator->errors()->add("eventname", 'Name of the event is required'); }
		
		$noofparticipantflag = true;
		$noofparticipantnumeric = false;
		foreach($request->noofparticipant as $noofparticipant){ 
			if(!empty($noofparticipant) ){ 
				$noofparticipantflag = false; 
				if(!is_numeric($noofparticipant)) {
					$noofparticipantnumeric = true;
				}
			}
		}
		if($noofparticipantflag){ $chkerro = true; $validator->errors()->add("noofparticipant", 'Number of participants is required'); }
		if($noofparticipantnumeric){ $chkerro = true; $validator->errors()->add("noofparticipanttype", 'Number of participants must be number'); }
		
		
		if($chkerro){ throw new ValidationException($validator);}
		
		$certstatus = new YouthStatus();
		
		try{
       
			$certstatus->user_id = $request->user_id; 
			$certstatus->cat_id  = $request->youthclubreqid;
			$certstatus->cur_status = 'awarded';
			$certstatus->status = 'awarded';
			$certstatus->created  = date('Y-m-d H:i:s');
			$certstatus->updated  = date('Y-m-d H:i:s');
			//$certreq = new CertRequest();

            if($certstatus->save()){
		
                try{
					
                    $certreq = new YouthCertRequest();
                    $certreq->user_id = $request->user_id; 
                    $certreq->cat_id  = $request->youthclubreqid;
                   
					$imgurl = array();
					if($request->hasfile('eventphoto')) {
						$year = date("Y/m");
						foreach($request->file('eventphoto') as $file)
						{
							$name = $file->getClientOriginalName();
							$name = $file->store($year,['disk'=> 'uploads']);
							$name = url('wp-content/uploads/'.$name);
							$imgurl[] = $name;
						}
					}
					
                    $certreq->created  = date('Y-m-d H:i:s');
					$certreq->state = State::find($request->state)->name;
					$certreq->district = District::find($request->district)->name;
					$certreq->block = Block::find($request->block)->name;
					$certreq->noofmembers = $request->noofmembers;
					$certreq->nameofclub = $request->nameofclub;
					$certreq->affiliationno = $request->affiliationno;
					$certreq->anysports = $request->anysports;
					$certreq->anysportsmin = $request->anysportsmin;
					$certreq->traditionalgame = $request->traditionalgame;
					$certreq->traditionalgamemin = $request->traditionalgamemin;
					$certreq->walkingmin = $request->walkingmin;
					$certreq->cyclingmin = $request->cyclingmin;
					$certreq->runningmin = $request->runningmin;
					$certreq->otherpa = $request->otherpa;
					$certreq->otherpamin = $request->otherpamin;
					$certreq->motivatecommits = $request->motivatecommits;	
					$certreq->youthclubcommits = $request->youthclubcommits;
					$certreq->mpname = serialize($request->mpname);
					$certreq->mpcontact = serialize($request->mpcontact);
					$certreq->mpphyactivity = serialize($request->mpphyactivity);
					$certreq->yclubeventcommits = $request->yclubeventcommits;
					$certreq->eventname = serialize($request->eventname);
					$certreq->noofparticipant = serialize($request->noofparticipant);
					$certreq->eventphoto = serialize($imgurl);

                    if( $certreq->save() ) {

                        $userkey = new Userkey();
                        $userkey->user_id = $request->user_id;
                        $userkey->key = 'youthclubreqid';
                        $userkey->value = $request->youthclubreqid;
                        $userkey->save();
			

                        return back()->with('success','Request added successsfully');
                    }else {
                        return back()->with('error','Request not added successsfully');
                    }

                    
                } catch (\Exception $e) {
                    return back()->with('error',$e->getMessage());
                }


            return back()->with('success','Your request has been submitted successfully.');
        } else {
            return back()->with('error','Your request not submitted successfully.');
        }
   
	   } catch (\Exception $e) {
			return back()->with('error',$e->getMessage());
	   }	
	}
	
	public function updateyouthcert1(Request $request)
	{		
		$chkerro = false;
		$validator = Validator::make([],[]);
		
		if($request->youthflagtype == 'motivate'){
			
			$mpnameflag = true;
			foreach($request->mpname as $mpname){ if(!empty($mpname) ){ $mpnameflag = false; } }
			if($mpnameflag){ $chkerro = true; $validator->errors()->add("mpname", 'Name of motivated person is required'); }
			
			$mpcontactflag = true;
			$mpcontactflagnumeric = false;
			foreach($request->mpcontact as $mpcontact){ 
				if(!empty($mpcontact) ){ 
					$mpcontactflag = false;
					if(!is_numeric($mpcontact)) {
							$mpcontactflagnumeric = true;
					}
				} 
			}
			if($mpcontactflag){ $chkerro = true; $validator->errors()->add("mpcontact", 'Motivated person contact is required'); }
			if($mpcontactflagnumeric){ $chkerro = true; $validator->errors()->add("mpcontacttype", 'Motivated person contact must be number'); }
			
			$mpphyactivityflag = true;
			foreach($request->mpphyactivity as $mpphyactivity){ if(!empty($mpphyactivity) ){ $mpphyactivityflag = false; } }
			if($mpphyactivityflag){ $chkerro = true; $validator->errors()->add("mpphyactivity", 'Physical activity/sports is required'); }
		}
		
		if($request->youthflagtype == 'event'){
			
			$eventnameflag = true;
			foreach($request->eventname as $eventname){ if(!empty($eventname) ){ $eventnameflag = false; } }
			if($eventnameflag){ $chkerro = true; $validator->errors()->add("eventname", 'Name of the event is required'); }
			
			$noofparticipantflag = true;
			$noofparticipantnumeric = false;
			foreach($request->noofparticipant as $noofparticipant){ 
				if(!empty($noofparticipant) ){ 
					$noofparticipantflag = false; 
					if(!is_numeric($noofparticipant)) {
						$noofparticipantnumeric = true;
					}
				}
			}
			if($noofparticipantflag){ $chkerro = true; $validator->errors()->add("noofparticipant", 'Number of participants is required'); }
			if($noofparticipantnumeric){ $chkerro = true; $validator->errors()->add("noofparticipanttype", 'Number of participants must be number'); }
			
			
			
		}
		
		if($chkerro){ throw new ValidationException($validator);   }
		
					$certreq = YouthCertRequest::find($request->youthuptflag);
					
					if($request->youthflagtype == 'motivate'){
						$certreq->mpname = serialize($request->mpname);
						$certreq->mpcontact = serialize($request->mpcontact);
						$certreq->mpphyactivity = serialize($request->mpphyactivity);
					}
					if($request->youthflagtype == 'event'){
						
						
					$imgurl = array();
					if($request->hasfile('eventphoto')) {
						$year = date("Y/m");
						foreach($request->file('eventphoto') as $file)
						{
							$name = $file->getClientOriginalName();
							$name = $file->store($year,['disk'=> 'uploads']);
							$name = url('wp-content/uploads/'.$name);
							$imgurl[] = $name;
						}
					}
				  
				
					$certreq->eventname = serialize($request->eventname);
					$certreq->noofparticipant = serialize($request->noofparticipant);
					$certreq->eventphoto = serialize($imgurl);
				}
				
				if($certreq->save()){
					return back()->with('success','Request added successsfully');
				}else {
					return back()->with('error','Request not added successsfully');
				}
		
	}
	
	public function certification(){
	
		$id = @$_REQUEST['auth_id'];
		
		if(!empty($id)){
			
		   $udata = User::where('id',$id)->first(); 
		}
				
		if(!empty($udata)){		
		
		  $userid = $udata->id;
		  $role = $udata->role;	
		  
		  if(!empty($role)){
			
			$appliedfor = false; $currentflag = false;
			$appliedfor = Userkey::where('user_id',$userid)->where('key','ratingreqid')->first();
			
			if($appliedfor){
				if($appliedfor->value){
					$appliedfor = $appliedfor->value;
					$currentflag = ($appliedfor + 1);
				}
			}else{
				$currentflag = 1621;
			}
			
			

			$flags = CertQues::where('cert_cats_id',1621)->orderBy('priority', 'asc')->get();
			$threestars = CertQues::where('cert_cats_id',1622)->orderBy('priority', 'asc')->get();
			$fivestars = CertQues::where('cert_cats_id',1623)->orderBy('priority', 'asc')->get();		

			$role = Role::where('slug', $role)->first()->name;

				if($appliedfor){
						
					switch ($appliedfor){
					  case 1621:
						$flagdata = CertRequest::where('user_id', $userid)->where('cat_id', 1621)->first();
						$flagstatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1621)->first();
						return view('event.scert', ['userid' => $userid,'role' => $role,'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata ]);
						break;
					  case 1622:
						$flagdata = CertRequest::where('user_id', $userid)->where('cat_id', 1621)->first();
						$flagstatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1621)->first();
						$threedata = CertRequest::where('user_id', $userid)->where('cat_id', 1622)->first();
						$threestatusdata = CertStatus::where('user_id',$userid)->where('cat_id', 1622)->first();
						return view('event.scert', ['userid' => $userid,'role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata,'threedata' => $threedata, 'threestatusdata' => $threestatusdata ]);
						break;
					  case 1623:
					  
						$flagdata = CertRequest::where('user_id', $userid)->where('cat_id', 1621)->first();
						$flagstatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1621)->first();
						$threedata = CertRequest::where('user_id',$userid)->where('cat_id', 1622)->first();
						$threestatusdata = CertStatus::where('user_id',$userid)->where('cat_id', 1622)->first();
						$fivedata = CertRequest::where('user_id', $userid)->where('cat_id', 1623)->first();
						$fivestatusdata = CertStatus::where('user_id',$userid)->where('cat_id', 1623)->first();
						
						return view('event.scert', ['userid' => $userid,'role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata,'threedata' => $threedata, 'threestatusdata' => $threestatusdata, 'fivedata' => $fivedata, 'fivestatusdata' => $fivestatusdata ]);
						break;
					  default:
						return view('event.scert', ['userid' => $userid,'role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag ]);
					}			
					
				}else{  
					return view('event.scert', ['userid' => $userid,'role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag ]);
				}
			}  
		}else{
		  abort(404);
		}    

       //return view('event.scert');
    }
	
	
	 public function flagstore1(Request $request){
       //:attribute playgound
       //dd($request);	pecertifieddoc  

       $rules = [
        'peteacherno' => 'required|numeric|min:1|max:50',
        'peteachernames'=>'required|array|min:1',
        'peteachernames.*'  => 'required|min:2|regex:/(^[A-Za-z ]+$)+/',
        'playgroundno' => 'required|numeric|min:1|max:20',
        'playgroundshape' => 'required|array',
        'playgroundarea' => 'required',
        'playgroundarea.*' => 'required|numeric',
        'playgroundlside' => 'required',
        'playgroundlside.*' => 'required|numeric|lt:playgroundarea.*',
        'schooldistance' => 'required',
        'schooldistance.*' => 'required',
        'outdoorsports' => 'required|array|min:2',
        'outdoorsports.*' => 'required',
        'playgroundimg' => 'required|array',
        'playgroundimg.*' => 'required|mimes:jpg,jpeg,png,bmp,pdf|max:2000',
        'studentspending60min' => 'required',
        'declation'=> 'required'        
       ];

       $messages = [
        'peteacherno.required' => 'No. of teachers trained in PE is required',
		'peteacherno.numeric' => 'No. of teachers trained in PE must be number',
		'peteacherno.min' => 'No. of teachers trained in PE must be at least 1',
        'peteachernames.required' => 'Name of teacher is required',
        'peteachernames.*.required' => 'Name of teacher is required',
		'peteachernames.*.regex' => 'Name of teacher must contain letters only',
        'playgroundno.required' => 'No. of playgrounds is required',
		'playgroundno.min' => 'No. of playgrounds must be at least 1',
        'playgroundshape.required' => 'All playground shape are required',
        'playgroundarea.required' => 'Playground area is required',
        'playgroundarea.*.required' => 'Playground area is required',
		'playgroundarea.*.numeric' => 'Playground area must be number',
        'playgroundlside.required' => 'Playground longest side is required',
        'playgroundlside.*.required' =>'Playground longest side is required',
		'playgroundlside.*.numeric' =>'Playground longest side must be number',
		'playgroundlside.*.lt' =>'Playground longest side :input (ft) must be less than playgound Area in sqft',
        'schooldistance.required' => 'Playground distance from school is required',
        'schooldistance.*.required' => 'Playground distance from School is required',
        'outdoorsports.required' => 'Outdoor sports is required',
        'outdoorsports.*.required' => 'Outdoor sports is required',
        'playgroundimg.required' => 'Please upload all playground images',
        'playgroundimg.*.required' => ' Please upload playground image',
        'playgroundimg.*.mimes' => 'Only jpeg, png, jpg and bmp images are allowed',
        'playgroundimg.*.max' => 'Sorry! Maximum allowed size for an image is 2MB',
        'studentspending60min.required' => 'Please check having one PE period each day for every section and physical activities',
        'declation.required' => 'Please select self declaration'
       ];   
		
		
		$totmin = 0;

        if(!empty($request->assemblyactivityno)){
            $totmin += $request->assemblyactivityno;
        }
        if(!empty($request->physeduperiodno)){
            $totmin += $request->physeduperiodno;
        }
        if(!empty($request->schoolclosreno)){
            $totmin += $request->schoolclosreno;
        }
        if(!empty($request->schoolclosreno)){
            $totmin += $request->otheractivityno;
        }
		

        $request->validate($rules , $messages );
		
		$chkerro = false;
		$validator = Validator::make([],[]);
		$i=0;
        while($i < $request->playgroundno){
			if(empty($request->playgroundshape[$i])){
				$chkerro = true;
				$validator->errors()->add("playgroundshape.".$i, 'Please select playground '.($i+1).' shape ');
			}
			
			if( empty($request->playgroundimg[$i]) ){
				$chkerro = true;
				$validator->errors()->add("playgroundimg.".$i, 'Please upload playground '.($i+1).' image ');
			}
			
			$i++;		
		}		
		
        if( $totmin < 60){
			$chkerro = true;
			$validator->errors()->add('assemblyactivityno', 'Sum of total minutes must be greater than 60 minutes for Daily Physical Activities by Students');
			
			/*
			 return redirect()->back()->withErrors('error','Total minutes must be greater than 60 minutes for Daily Physical Activities by Students')->withInput();
            return back()->withErrors('activity','Total minutes must be greater than 60 minutes for Daily Physical Activities by Students');
         */
        }
       
		if($chkerro){
			throw new ValidationException($validator);   
		}
		
		
		$flag=0;
		$cflag=0;
		
		$csts = CertStatus::where('user_id', $request->user_id)->first();		
				
		if(!empty($csts)){			
		  $flag=1;		
		}else {			
		  $flag=0;		
		}		
		
		if($flag==1){
			
			$crsts = CertRequest::where('user_id', $request->user_id)->first();
			
			if(!empty($crsts)){		
			  $cflag=1;		
			}else {			
			  $cflag=0;		
			}			
		}		
					
	if($flag==1 && $cflag==0){
		try {	
			CertStatus::where('user_id', $request->user_id)->delete();
			return back()->with('error','Please try again.');
		 } catch (\Exception $e){
		  return back()->with('error',$e->getMessage());
		}
		
	} else if(($flag==0 ) || ($flag==1 && $cflag==1)){		
       
      try {
					
        $certstatus = new CertStatus();
        $certstatus->user_id = $request->user_id; 
		$certstatus->cat_id  = $request->ratingreqid;
		$certstatus->cur_status = 'awarded';
		$certstatus->status = 'awarded';
        $certstatus->created  = date('Y-m-d H:i:s');
        $certstatus->updated  = date('Y-m-d H:i:s');
        //$certreq = new CertRequest();

        if($certstatus->save()){       

            $playgroundimgarr = array();
            if($request->hasfile('playgroundimg')){
                $year = date("Y/m");
                foreach($request->file('playgroundimg') as $file)
                {
                    $name = $file->getClientOriginalName();
                    $name = $file->store($year,['disk'=> 'uploads']);
                    $name = url('wp-content/uploads/'.$name);
                    $playgroundimgarr[] = $name;
                }
            }
            
             try{
                    $certreq = new CertRequest();
                    $certreq->user_id = $request->user_id; 
                    $certreq->cat_id  = $request->ratingreqid;
                    $certreq->peteacherno = $request->peteacherno;
                    $certreq->peteachernames = serialize($request->peteachernames);
                    $certreq->playgroundno = $request->playgroundno;
                    $certreq->playgroundshape = serialize($request->playgroundshape);
                    $certreq->playgroundarea =  serialize($request->playgroundarea);
                    $certreq->playgroundlside = serialize($request->playgroundlside);
                    $certreq->schooldistance =  serialize($request->schooldistance);
                    $certreq->playgroundimg = serialize($playgroundimgarr);
                    if(!empty($request->othersportsplayed)){
                        $certreq->othersportsplayed = $request->othersportsplayed;
                    }
                    
                    $certreq->outdoorsports = serialize($request->outdoorsports);
                    if(!empty($request->assemblyactivityno)){
                        $certreq->assemblyactivityno = $request->assemblyactivityno;
                    }
                    if(!empty($request->physeduperiodno)){
                        $certreq->physeduperiodno = $request->physeduperiodno;
                    }
                    if(!empty($request->schoolclosreno)){
                        $certreq->schoolclosreno = $request->schoolclosreno;
                    }
                    if(!empty($request->schoolclosreno)){
                        $certreq->otheractivityno = $request->otheractivityno;
                    }

                     
                    $certreq->studentspending60min = $request->studentspending60min;
                    $certreq->declation = $request->declation;
                    $certreq->created  = date('Y-m-d H:i:s');

                    if($certreq->save()){

                        $userkey = new Userkey();
                        $userkey->user_id = $request->user_id;
                        $userkey->key = 'ratingreqid';
                        $userkey->value = $request->ratingreqid;
                        $userkey->save();

                        return back()->with('success','Your request have submitted successfully.');
                    }else {
                        return back()->with('error','Your request not submitted successfully.');
                    }

                    
                } catch (\Exception $e) {
                    return back()->with('error',$e->getMessage());
                }


            return back()->with('success','Request added successsfully');
        } else {
            return back()->with('error','Request not added successsfully');
        }
   
    } catch (\Exception $e) {
        return back()->with('error',$e->getMessage());
    }
  } 
}

  public function threestar1(Request $request){		
       
		$rules = [
			'totnoteachers' => 'required|numeric|min:1',
			'noteachersplaying' => 'required|numeric|min:1|lt:totnoteachers',
			'encouragesdoc' => 'required|mimes:jpg,jpeg,png,bmp,pdf|max:20000',
			'motivatesdoc' => 'required|mimes:jpg,jpeg,png,bmp,pdf|max:20000',
			'trainedteacherno' => 'required|numeric|min:1',
			'trainedteachername' => 'required|array||min:2',
			'trainedteachername.*'  => 'required|min:2|regex:/(^[A-Za-z ]+$)+/',
			'sportsone' => 'required|array||min:2',
			'sporttwo' => 'required|array||min:2',
			'school_certificate' => 'required|mimes:jpg,jpeg,png,bmp,pdf|max:20000',
			'outdoorfacility'=> 'required|array||min:2',
			'indoorfacility' => 'required|array||min:2',
			'traditionalgames' => 'required',

		];

		$messages = [
			'totnoteachers.required' => 'No. of teachers in school is required',
			'totnoteachers.min' => 'No. of teachers in school must be atleat 1',
			'noteachersplaying.required' => 'No. of teachers in school spending at least 60 minutes/ day for physical activities is required',
			'noteachersplaying.min' => 'No. of teachers in school spending at least 60 minutes/ day for physical activities must be atleast 1',
			'noteachersplaying.lt' => 'No. of teachers in school spending at least 60 minutes/ day for physical activities must be less than No. of teachers in school',			
			'encouragesdoc.required' => 'School encourages teachers to participate in sports is required',
			'motivatesdoc.required' => 'School motivates all teachers to do 60 minutes of physical activity every day less than 20 MB doc is required',
			'trainedteacherno.required' => 'No. of teachers  well versed with any two sports',
			'trainedteachername.required' => 'Teacher/Coach Name is required',
			
			'trainedteachername.*.required' => 'Teacher/Coach Name is required',
			'trainedteachername.*.regex' => 'Teacher/Coach Name must contain letters only',
		
			'sportsone.required' => 'Sport 1 is required',
			'sporttwo.required' => 'Sports 2 is required',
			'school_certificate.required' => 'School has celebrated Fit India School week, please attach the certificate',
			'outdoorfacility.required' => '2 outdoor sports is required',
			'outdoorfacility.min' => 'Minimum 2 outdoor sports is required',
			'indoorfacility.required' => '2 indoor sports is required',
			'indoorfacility.min' => 'Minimum 2 indoor sports is required',
			'traditionalgames.required' => 'Check Every student learns and plays 2 sports - one of which could be a traditional/ indigenous/local game'
		];

        $request->validate($rules , $messages );
		
		$chkerro = false;
		$validator = Validator::make([],[]);
		$i=0;
        while($i < $request->trainedteacherno){
			
			if( empty($request->trainedteachername[$i]) ){
				$chkerro = true;
				$validator->errors()->add("trainedteachername.".$i, 'Teacher/Coach Name is required ');
			}
			if( empty($request->sportsone[$i]) ){
				$chkerro = true;
				$validator->errors()->add("sportsone.".$i, 'Sport 1 is required ');
			}
			if( empty($request->sporttwo[$i]) ){
				$chkerro = true;
				$validator->errors()->add("sporttwo.".$i, 'Sport 2 is required ');
			}
			
			$i++;		
		}
		
		if($chkerro){
			throw new ValidationException($validator);   
		}
		
	$flag=0;
	$cflag=0;
	
	$csts = CertStatus::where('user_id', $request->user_id)->first();		
			
	if(!empty($csts)){			
	  $flag=1;		
	}else {			
	  $flag=0;		
	}		
	
	if($flag==1){
		
		$crsts = CertRequest::where('user_id', $request->user_id)->first();
		
		if(!empty($crsts)){		
		  $cflag=1;		
		}else {			
		  $cflag=0;		
		}			
	}		
				
if($flag==1 && $cflag==0){
	try {	
		CertStatus::where('user_id', $request->user_id)->delete();
		return back()->with('error','Please try again.');
	 } catch (\Exception $e){
	  return back()->with('error',$e->getMessage());
	}
	
} else if(($flag==0 ) || ($flag==1 && $cflag==1)){			
       
    try{

        $certstatus = new CertStatus();
        $certstatus->user_id = $request->user_id; 
		$certstatus->cat_id  = $request->ratingreqid;
		$certstatus->cur_status = 'applied';
		$certstatus->status = 'applied';
        $certstatus->created  = date('Y-m-d H:i:s');
        $certstatus->updated  = date('Y-m-d H:i:s');       

        //$certreq = new CertRequest();

        if( $certstatus->save() ) {

            $year = date("Y/m");
			if($request->hasfile('encouragesdoc')) {
                $name = $request->file('encouragesdoc')->store($year,['disk'=> 'uploads']);
                $encouragesdoc = url('wp-content/uploads/'.$name);
            }
			if($request->hasfile('motivatesdoc')) {
                $name = $request->file('motivatesdoc')->store($year,['disk'=> 'uploads']);
                $motivatesdoc = url('wp-content/uploads/'.$name);
            }
			
            if($request->hasfile('school_certificate')) {
				$name = $request->file('school_certificate')->store($year,['disk'=> 'uploads']);
                $school_cert = url('wp-content/uploads/'.$name);
            }
            
                try{
                    $certreq = new CertRequest();
                    $certreq->user_id = $request->user_id; 
                    $certreq->cat_id  = $request->ratingreqid;
                    $certreq->totnoteachers = $request->totnoteachers;
                    $certreq->encouragesdoc = $encouragesdoc;
                    $certreq->schoolcertificate = $school_cert;
                    $certreq->motivatesdoc = $motivatesdoc;
                    $certreq->noteachersplaying = $request->noteachersplaying;
                    $certreq->trainedteacherno = $request->trainedteacherno;
					
                    $certreq->trainedteachername =  serialize($request->trainedteachername);
					$certreq->sportsone =  serialize($request->sportsone);
					$certreq->sporttwo =  serialize($request->sporttwo);
					
					
					$certreq->outdoorfacility = serialize($request->outdoorfacility);
					$certreq->indoorfacility = serialize($request->indoorfacility);
					if(!empty($request->outdoorextrafacility)){ 
						$certreq->outdoorextrafacility = $request->outdoorextrafacility;
					}
					if(!empty($request->indoorextrafacility)){
						$certreq->indoorextrafacility = $request->indoorextrafacility;
					}
                    $certreq->traditionalgames = $request->traditionalgames;
                    $certreq->created  = date('Y-m-d H:i:s');

                    if( $certreq->save() ) {

                        $userkey = Userkey::where('user_id', $request->user_id)->where('key', 'ratingreqid')->first();
						$userkey->update([ 'value' => $request->ratingreqid  ]);
			

                        return back()->with('success','Your request have submitted successfully.');
                    }else {
                        return back()->with('error','Your request not submitted successfully.');
                    }

                    
                } catch (\Exception $e) {
                    return back()->with('error',$e->getMessage());
                }


            return back()->with('success','Request added successsfully');
        } else {
            return back()->with('error','Request not added successsfully');
        }
   
    } catch (\Exception $e) {
        return back()->with('error',$e->getMessage());
    }  
   } 
 }

 public function fivestar1(Request $request){       
		
		$rules = [
			'intraschoolcomp' => 'required|array|min:3',
			'quarterintraschooldoc' => 'required|mimes:jpg,jpeg,png,bmp,pdf|max:2000',
			'participateintraschooldoc' => 'required|mimes:jpg,jpeg,png,bmp,pdf|max:2000',
			'celebrateannualsportdoc' => 'required|mimes:jpg,jpeg,png,bmp,pdf|max:2000',
			'alltrainedpe' => 'required',
			'pecertifieddoc' => 'required|mimes:jpg,jpeg,png,bmp,pdf|max:2000',
			'sportscoachno' => 'required|numeric|min:2',
			'sportscoachname' => 'required|array||min:2',
			'sportscoachname.*'  => 'required|min:2|regex:/(^[A-Za-z ]+$)+/',
			'coachsports' => 'required|array||min:2',
			'coachsports.*'  => 'required|min:2|regex:/(^[A-Za-z ]+$)+/',
			'peboard' => 'required',
			'curriculumboarddoc' => 'required|mimes:jpg,jpeg,png,bmp,pdf|max:2000',
			'schoolfitnessid' => 'required|numeric|min:100',
			'noofstudents' => 'required|numeric|min:10',
			'noofassessments' => 'required|numeric|min:1|lt:noofstudents',
			'facilities' => 'required|array|min:1',
			'opento' => 'required|array|min:1'		
		];

		$messages = [
			'intraschoolcomp.required' => 'School conducts quarterly intra-school sports competitions is required',
			'intraschoolcomp.min' => 'All 3 Conducts quarterly Intra-school Competitions , Participates in Inter-school Competition & Celebrate Annual Sports Day is required',
			'quarterintraschooldoc.required' => 'Conducts quarterly Intra-school Competitions attachment is required',
			'participateintraschooldoc.required' => 'Participates in Inter-school Competition attachment is required',
			'celebrateannualsportdoc.required' => 'Celebrate Annual Sports Day attachment is required',
			'alltrainedpe.required' => 'All teachers are trained in PE is required, please check',
			'pecertifieddoc.required' => 'All teachers are trained in PE attachment is required',
			'sportscoachno.required' => 'No of Sports Coaches is required',
			'sportscoachno.min' => 'No of Sports Coaches must be atleast 2',
			'sportscoachname.required' => 'Coach name is required',
			'sportscoachname.*.required' => 'Coach name is required',
			'sportscoachname.*.regex' => 'Only letter are allowed in coach name',
			'coachsports.required' => 'Coach sports is required',
			'coachsports.*.required' => 'Sport is required',
			'peboard.required' => 'School follows structured PE curriculum prescribed by Board is required',
			'curriculumboarddoc.required'=> 'School follows structured PE curriculum prescribed by Board attachment is required',
			'schoolfitnessid.required' => 'ID(School Affiliation Code)on schoolfitness.kheloindia.gov.in is required',
			'noofstudents.required' => 'No of students is required',
			'noofassessments.required' => 'No of students fitness assessment done is required',
			'noofassessments.lt' => 'No of students fitness assessment must be less than No of students',
			'facilities.required' => 'School opens its playground(s) before/after school hours Facilities is required',
			'opento.required' => 'School opens its playground(s) before/after school hours Open to is required',
			
			
		];

        $request->validate($rules , $messages );
		
		$chkerro = false;
		$validator = Validator::make([],[]);
		
		$facilityval = false;
		foreach($request->facilities as $val){ if(!empty($val)){ $facilityval = true; }  }
		if( empty($facilityval) ){ 
			$chkerro = true;
			$validator->errors()->add("facilities", 'Facilities required '); 
		}
		
		$opentoval = false;
		foreach($request->opento as $val){ if(!empty($val)){ $opentoval = true; }  }
		if( empty($opentoval) ){ 
			$chkerro = true;
			$validator->errors()->add("opento", 'Opento required '); 
		}
		
		if($chkerro){
			throw new ValidationException($validator);   
		}
		
		
		$flag=0;
		$cflag=0;
		
		$csts = CertStatus::where('user_id', $request->user_id)->first();		
				
		if(!empty($csts)){			
		  $flag=1;		
		}else {			
		  $flag=0;		
		}		
		
		if($flag==1){
			
			$crsts = CertRequest::where('user_id', $request->user_id)->first();
			
			if(!empty($crsts)){		
			  $cflag=1;		
			}else {			
			  $cflag=0;		
			}			
		}		
					
	if($flag==1 && $cflag==0){
		try {	
			CertStatus::where('user_id', $request->user_id)->delete();
			return back()->with('error','Please try again.');
		 } catch (\Exception $e){
		  return back()->with('error',$e->getMessage());
		}
		
 } else if(($flag==0 ) || ($flag==1 && $cflag==1)){			
       
    try{

        $certstatus = new CertStatus();
        $certstatus->user_id = $request->user_id; 
		$certstatus->cat_id  = $request->ratingreqid;
		$certstatus->cur_status = 'applied';
		$certstatus->status = 'applied';
        $certstatus->created  = date('Y-m-d H:i:s');
        $certstatus->updated  = date('Y-m-d H:i:s');
        

        //$certreq = new CertRequest();pecertifieddoc

        if( $certstatus->save() ) {

            $year = date("Y/m");
			if($request->hasfile('quarterintraschooldoc')) {
                $name = $request->file('quarterintraschooldoc')->store($year,['disk'=> 'uploads']);
                $quarterintraschooldoc = url('wp-content/uploads/'.$name);
            }
			
			if($request->hasfile('participateintraschooldoc')) {
                $name = $request->file('participateintraschooldoc')->store($year,['disk'=> 'uploads']);
                $participateintraschooldoc = url('wp-content/uploads/'.$name);
            }
			
            if($request->hasfile('celebrateannualsportdoc')) {
				$name = $request->file('celebrateannualsportdoc')->store($year,['disk'=> 'uploads']);
                $celebrateannualsportdoc = url('wp-content/uploads/'.$name);
            }
			
			if($request->hasfile('pecertifieddoc')) {
				$name = $request->file('pecertifieddoc')->store($year,['disk'=> 'uploads']);
                $pecertifieddoc = url('wp-content/uploads/'.$name);
            }
			
			if($request->hasfile('curriculumboarddoc')) {
				$name = $request->file('curriculumboarddoc')->store($year,['disk'=> 'uploads']);
                $curriculumboarddoc = url('wp-content/uploads/'.$name);
            }
			
			
                try{
                    $certreq = new CertRequest();
                    $certreq->user_id = $request->user_id; 
                    $certreq->cat_id  = $request->ratingreqid;
                    
					if(!empty($request->achievements)){ 
						$certreq->achievements = $request->achievements;
					}
					
					$certreq->intraschoolcomp = serialize($request->intraschoolcomp);
					$certreq->quarterintraschooldoc = $quarterintraschooldoc;
					$certreq->participateintraschooldoc = $participateintraschooldoc;
					$certreq->celebrateannualsportdoc = $celebrateannualsportdoc;
					$certreq->pecertifieddoc = $pecertifieddoc;
					$certreq->peboard =  $request->peboard;
					$certreq->curriculumboarddoc= $curriculumboarddoc;
					$certreq->alltrainedpe =  $request->alltrainedpe;
					$certreq->sportscoachno =  $request->sportscoachno;
					$certreq->sportscoachname =  serialize($request->sportscoachname);
					$certreq->coachsports =  serialize($request->coachsports);
					$certreq->schoolfitnessid =  $request->schoolfitnessid;
					$certreq->noofstudents =  $request->noofstudents;
					$certreq->noofassessments =  $request->noofassessments;
					$certreq->facilities =  serialize($request->facilities);
					$certreq->opento =  serialize($request->opento);
                    $certreq->created  = date('Y-m-d H:i:s');

                    if( $certreq->save() ) {

                        $userkey = Userkey::where('user_id', $request->user_id)->where('key', 'ratingreqid')->first();
						$userkey->update([ 'value' => $request->ratingreqid]);
			

                        return back()->with('success','Request added successsfully');
                    }else {
                        return back()->with('error','Request not added successsfully');
                    }

                    
                } catch (\Exception $e) {
                    return back()->with('error',$e->getMessage());
                }


            return back()->with('success','Your request have submitted successfully.');
        } else {
            return back()->with('error','Your request not submitted successfully.');
        }
   
    } catch (\Exception $e) {
        return back()->with('error',$e->getMessage());
    }
   }
 }
	
	
    public function create()
    {
        //
    }
   
    public function Store(Request $request){	        
	    $image = '';
	    $role_slug = 'lbambassador';
        $year = date("Y/m");
		$imgurl = array();
				
		/*$request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            //'age' => 'required',
            'gender' => 'required',
            'state' => 'required',
            'district' =>'required',
            'block' => 'required',            
            'document' => 'required',
            'social_media_url' => 'required',           
            'unique_app_id' => 'required',
			//'otherpa' => 'required',
			//'otherpamin' => 'required',
			'yclubeventcommits' => 'required',
			//'eventname' => 'required|array',
			//'noofparticipant' => 'required|array',
			//'eventphoto' => 'required|array',
			'physical_fitness' => 'required',
			'contact' => 'required|digits:10',
			'image' => 'required',
        ]);
		*/
		
		if($request->file('document'))
        {
            $document = $request->file('document')->store($year,['disk'=>'uploads']);
            $document = url('wp-content/uploads/'.$document);
        }
		
		if($request->file('agedocument'))
        {
            $agedocument = $request->file('agedocument')->store($year,['disk'=>'uploads']);
            $agedocument = url('wp-content/uploads/'.$agedocument);
        }
		
		if($request->file('image'))
        {
            $image1 = $request->file('image')->store($year,['disk'=>'uploads']);
            $image1 = url('wp-content/uploads/'.$image1);
        }
		
		if($request->hasfile('eventphoto')) {
			foreach($request->file('eventphoto') as $file)
			{
				$name = $file->getClientOriginalName();
				$name = $file->store($year,['disk'=> 'uploads']);
				$name = url('wp-content/uploads/'.$name);
				$imgurl[] = $name;
			}
		}
        		
       $state = State::where('id', $request->state)->first();
		
        $district = District::where('id', $request->district)->first();
        $block = Block::where('id', $request->block)->first();
		
		$user = User::where('email', '=', $request->email)->first();
		$get_role = Role::where('slug', '=', $role_slug)->first();
		
		$local_bodyambassador = LocalBody::create([
					'user_id' => $request->user_id,
					'name' => $request->name,
					'email' => $request->email,
					'gender' => $request->gender,
					'state_name' => @$state->name,
		            'state_id' => @$state->id,
		            'district_name' => @$district->name,
		            'district_id' => @$district->id,
		            'block_name' => @$block->name,
		            'block_id' => @$block->id,
		            'designation'=>@$request->designation,
					'image' => $image1,					
					'document_file' => @$document,
					'age_proof' => @$agedocument,					
					//'social_media_url' => @$request->social_media_url,
					'facebook_profile' => @$request->facebook_profile,
		            'facebook_profile_followers' => @$request->facebook_profile_followers,
		            'twitter_profile' => @$request->twitter_profile,
		            'twitter_profile_followers' => @$request->twitter_profile_followers,
		            'instagram_profile' => @$request->instagram_profile,
		            'instagram_profile_followers' => @$request->instagram_profile_followers,
					'social_media_handle' => @$request->social_media_handle,	
					'unique_app_id' => @$request->unique_app_id,	
					'fitness_event' => @$request->fitness_event, 
					'physical_fitness' => @$request->physical_fitness,
					'yclubeventcommits' => @$request->yclubeventcommits,
					'contact' => @$request->contact,
				]);	
			
				if($local_bodyambassador){
					return back()->with('success','Request to become a Fit India Urban Local Body Ambassador has been submitted successfully. Please wait until your application is verified.');
				}else{
					return back()->with('failed','Something Wrong')->withInput();
				}
		return back()->withInput();
	}

    public function Store_old(Request $request){	        
		//dd($request->all());die;		
	    $image = '';
	    $role_slug = 'lbambassador';
        $year = date("Y/m");
		$imgurl = array();
				
		$request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            //'age' => 'required',
            'gender' => 'required',
            'state' => 'required',
            'district' =>'required',
            'block' => 'required',            
            'document' => 'required',
            'social_media_url' => 'required',           
            'unique_app_id' => 'required',
			//'otherpa' => 'required',
			//'otherpamin' => 'required',
			'yclubeventcommits' => 'required',
			//'eventname' => 'required|array',
			//'noofparticipant' => 'required|array',
			//'eventphoto' => 'required|array',
			'physical_fitness' => 'required',
			'contact' => 'required|digits:10',
			'image' => 'required',
        ]);
		
		if($request->file('document'))
        {
            $image = $request->file('document')->store($year,['disk'=>'uploads']);
            $image = url('wp-content/uploads/'.$image);
        }
		
		
		if($request->file('agedocument'))
        {
            $agedocument = $request->file('agedocument')->store($year,['disk'=>'uploads']);
            $agedocument = url('wp-content/uploads/'.$agedocument);
        }
		
		if($request->file('image'))
        {
            $image1 = $request->file('document')->store($year,['disk'=>'uploads']);
            $image1 = url('wp-content/uploads/'.$image1);
        }
		
		if($request->hasfile('eventphoto')) {
			//$year = date("Y/m");
			foreach($request->file('eventphoto') as $file)
				{
					$name = $file->getClientOriginalName();
					$name = $file->store($year,['disk'=> 'uploads']);
					$name = url('wp-content/uploads/'.$name);
					$imgurl[] = $name;
				}
			}
        		
        $state = State::where('id', $request->state)->first();
        $district = District::where('id', $request->district)->first();
        $block = Block::where('id', $request->block)->first();
		
		$user = User::where('email', '=', $request->email)->first();
		$get_role = Role::where('slug', '=', $role_slug)->first();
		
		if(empty($user)){
			
			$user = new User();			
			$user->name = $request->name;
			$user->email = $request->email;
			$user->phone = $request->contact;
			$user->role =   $get_role->slug;
			$user->rolelabel = $get_role->name;
			$user->role_id = $get_role->id;
			$user->password = Hash::make('Localbody@123');
			
			if($user->save()){		
			   //for new user	
			    $usermeta = new Usermeta();
				$usermeta->user_id = $user->id;
				$usermeta->state = $state->name;
				$usermeta->district = $district->name;
				$usermeta->block = $block->name;				
				$usermeta->save();	
								
				$local_bodyambassador = LocalBody::create([
					'user_id' => $user->id,
					'name' => $request->name,
					'email' => $request->email,
					//'age' => $request->age,
					'gender' => $request->gender,
					'state_name' => @$state->name,
					'state_id' => $request->state,
					'district_name' => @$district->name,
					'district_id' => $request->district,
					'block_name' => @$block->name,
					'block_id' => $request->block,					
					'document_file' => $image,
					'event_image' => $agedocument,					
					//'anysports' => $request->anysports,
					//'anysportsmin' => $request->anysportsmin,
					//'traditionalgame' => $request->traditionalgame,
					//'traditionalgamemin' => $request->traditionalgamemin,
					//'walkingmin' => $request->walkingmin,
					//'cyclingmin' => $request->cyclingmin,
					//'runningmin' => $request->runningmin,
					//'otherpa' => $request->otherpa,					
					//'otherpamin' => $request->otherpamin,	
					'social_media_url' => $request->social_media_url,	
					'social_media_handle' => $request->social_media_handle,	
					'unique_app_id' => $request->unique_app_id,	
					'fitness_event' => $request->fitness_event,  
					'fitness_event' => $request->fitness_event, 
					'physical_fitness' => $request->physical_fitness,
					'yclubeventcommits' => $request->yclubeventcommits,
					'image' => $image1,
					'contact' => $request->contact,
					//'eventname' => serialize($request->eventname),
					//'noofparticipant' => serialize($request->noofparticipant),
					//'eventphoto' => serialize($imgurl),
				]);	
				
				if($local_bodyambassador){
					return back()->with('success','Request to become a Fit India LocalBody Ambassador has been submitted successfully. Please wait until your application is verified.');
				}else{
					return back()->with('failed','Something Wrong')->withInput();
				}
			}
			
		} else {			
			//dd('www');die();			
			$local_bodyambassador = LocalBody::where('email', '=', $request->email)->where('status', '=', '1')->first();
			
			if(!empty($local_bodyambassador)){
				
				return back()->with('failed','You are already approved user by this email address')->withInput();
			
			} else {
				
				$local_bodyambassador2 = LocalBody::where('email', '=', $request->email)->where('status', '=', '2')->first();
				
				if(!empty($local_bodyambassador2)){
					
					//dd('bb');die();
					
					$local_bodyambassador3 = LocalBody::where('email', '=', $request->email)->where('status', '=', '0')->first();
					
					if(!empty($local_bodyambassador3)){
						
						return back()->with('failed','You are already registered as a LocalBody Ambassador, Please wait until your application is verified')->withInput();
					
					}else{

					$local_bodyambassador = LocalBody::create([
							'user_id' => @$user->id,
							'name' => $request->name,
							'email' => $request->email,
							//'age' => $request->age,
							'gender' => $request->gender,
							'state_name' => @$state->name,
							'state_id' => $request->state,
							'district_name' => @$district->name,
							'district_id' => $request->district,
							'block_name' => @$block->name,
							'block_id' => $request->block,					
							'document_file' => $image,
							'event_image' => $agedocument,					
							/*'anysports' => $request->anysports,
							'anysportsmin' => $request->anysportsmin,
							'traditionalgame' => $request->traditionalgame,
							'traditionalgamemin' => $request->traditionalgamemin,
							'walkingmin' => $request->walkingmin,
							'cyclingmin' => $request->cyclingmin,
							'runningmin' => $request->runningmin,
							'otherpa' => $request->otherpa,					
							'otherpamin' => $request->otherpamin,*/	
							'social_media_url' => $request->social_media_url,	
							'social_media_handle' => $request->social_media_handle,	
							'unique_app_id' => $request->unique_app_id,	
							'fitness_event' => $request->fitness_event,
							'fitness_event' => $request->fitness_event, 
							'physical_fitness' => $request->physical_fitness,
							'yclubeventcommits' => $request->yclubeventcommits,
							'image' => $image1,
							'contact' => $request->contact,
							//'eventname' => serialize($request->eventname),
							//'noofparticipant' => serialize($request->noofparticipant),
							//'eventphoto' => serialize($imgurl),
						]);
						
						if($local_bodyambassador){
							
							return back()->with('success','Request to become a Fit India LocalBody Ambassador has been submitted successfully. Please wait until your application is verified.');
						
						 } else {
							
							return back()->with('failed','Something')->withInput();
						}
					}
					
				} else { 
				
				  //dd('cc');die();
					
					$local_bodyambassador4 = LocalBody::where('email', '=', $request->email)->where('status', '=', '0')->first();
					
								
					if(empty($local_bodyambassador4)){
						
						 $local_bodyambassador = LocalBody::create([
							'user_id' => @$user->id,							
							'name' => $request->name,
							'email' => $request->email,
							//'age' => $request->age,
							'gender' => $request->gender,
							'state_name' => @$state->name,
							'state_id' => $request->state,
							'district_name' => @$district->name,
							'district_id' => $request->district,
							'block_name' => @$block->name,
							'block_id' => $request->block,					
							'document_file' => $image,
							'event_image' => $agedocument,					
							/*'anysports' => $request->anysports,
							'anysportsmin' => $request->anysportsmin,
							'traditionalgame' => $request->traditionalgame,
							'traditionalgamemin' => $request->traditionalgamemin,
							'walkingmin' => $request->walkingmin,
							'cyclingmin' => $request->cyclingmin,
							'runningmin' => $request->runningmin,
							'otherpa' => $request->otherpa,					
							'otherpamin' => $request->otherpamin,*/ 	
							'social_media_url' => $request->social_media_url,	
							'social_media_handle' => $request->social_media_handle,	
							'unique_app_id' => $request->unique_app_id,	
							'fitness_event' => $request->fitness_event,
							'fitness_event' => $request->fitness_event,
							'physical_fitness' => $request->physical_fitness,
							'yclubeventcommits' => $request->yclubeventcommits,
							'image' => $image1,
							'contact' => $request->contact,
							//'eventname' => serialize($request->eventname),
							//'noofparticipant' => serialize($request->noofparticipant),
							//'eventphoto' => serialize($imgurl),
												
						]);
						
						if($local_bodyambassador){
							return back()->with('success','Request to become a Fit India LocalBody Ambassador has been submitted successfully. Please wait until your application is verified.');
						}else{
							return back()->with('failed','Something')->withInput();
						}
					}else{
						return back()->with('failed','You are already registered as a LocalBody Ambassador, Please wait until your application is verified')->withInput();
					}
				}
			}
		}		
			
		return back()->withInput();
	}	
	
	public function updateLbEvent(Request $request)
	{
		//dd($request->all());
		//die();	  
		
		$imgurl = array();
		$chkerro = false;
		$validator = Validator::make([],[]);		
		
		if($request->youthflagtype == 'event'){
			
			$eventnameflag = true;
			foreach($request->eventname as $eventname){ if(!empty($eventname) ){ $eventnameflag = false; } }
			if($eventnameflag){ $chkerro = true; $validator->errors()->add("eventname", 'Name of the event is required'); }
			
			$noofparticipantflag = true;
			$noofparticipantnumeric = false;
			foreach($request->noofparticipant as $noofparticipant){ 
				if(!empty($noofparticipant) ){ 
					$noofparticipantflag = false; 
					if(!is_numeric($noofparticipant)) {
						$noofparticipantnumeric = true;
					}
				}
			}
			if($noofparticipantflag){ $chkerro = true; $validator->errors()->add("noofparticipant", 'Number of participants is required'); }
			if($noofparticipantnumeric){ $chkerro = true; $validator->errors()->add("noofparticipanttype", 'Number of participants must be number'); }
			
			
			
		}
		
		if($chkerro){ throw new ValidationException($validator);   }
		
					$certreq = LocalBody::find($request->youthuptflag);
					
					
					if($request->youthflagtype == 'event'){
						
					
						
					if($request->hasfile('eventphoto')) {
						$imgurl = array();	
							$year = date("Y/m");
							
							
							for($i=0; $i<4; $i++)
							{
								if(!empty($request->file('eventphoto')[$i])){
								
									$name = $request->file('eventphoto')[$i]->getClientOriginalName();
									$name = $request->file('eventphoto')[$i]->store($year,['disk'=> 'uploads']);
									$name = url('wp-content/uploads/'.$name);
									$imgurl[$i] = $name;
									echo $name;
									echo "<br>";
								
								}else{
									$imgurl[$i] = $request->img[$i];
								}
								
							}
							
						//var_dump($imgurl);
						//die();
					  
					
						$certreq->eventname = serialize($request->eventname);
						$certreq->noofparticipant = serialize($request->noofparticipant);
						
						$certreq->eventphoto = serialize($imgurl);
						
					}
					
                    if( $certreq->save() ) {
						return back()->with('success','Request added successsfully');
                    }else {
                        return back()->with('error','Request not added successsfully');
                    }
		
					
					
		
	
	
    }
    
	
}


 public function lbApplicationStatus(Request $request){
	 
	 
	
			$role = Auth::user()->role;
			$email = Auth::user()->email;
       
        if($role)
        {  

            //$categories = Category::all();
           
			
			$localbody_info = LocalBody::where('email',$email)->where('status','1')->first();
			
            $role = Role::where('slug', $role)->first()->name;
            return view('event.lba_status', ['role' => $role , 'localbody_info' => $localbody_info]);

        }
        return view('event.lba_status');
    }
	
     public function updateLocalBodyNewEvent(Request $request){ 
        $imgurl = array();
        $year = date("Y/m");
        if($request->hasfile('eventphoto')) {
            foreach($request->file('eventphoto') as $key=>$file)
            {
                $name = $file->getClientOriginalName();
                $name = $file->store($year,['disk'=> 'uploads']);
                $name = url('wp-content/uploads/'.$name);
                $imgurl[$key] = $name;
            }
        }
       
        $img_arr = @$imgurl+@$request->input('eventphoto_old');
       
        $event_array = $img_arr;

        $prerak = LocalBody::where("id", $request->prk_id)->update([
            'eventname' => serialize($request->eventname),
            'noofparticipant' => serialize($request->noofparticipant),
            'eventphoto' => serialize($event_array)
        ]);
        if($prerak){
            return back()->with('success','Event Detail successfully updated.');
        }else{
            return back()->with('failed','Something Wrong')->withInput();
        }
    }
	
    function localbodyApplyAgain($id){
    	if(!empty($id)){
            $del = LocalBody::destroy($id);
            if($del){
                return redirect('local-bodyambassador');
            }else{
            	return redirect('local-bodyambassador');
            }
        }
    }

    function lbApplyAgainMobile(){
    	$authid = @$_REQUEST['auth_id'];
    	$event_id = @$_REQUEST['event_id'];
    	if(!empty($event_id) and !empty($event_id)){
            $del = LocalBody::destroy($event_id);
            if($del){
                return redirect('local-bodyambassador-mobile/?auth_id='.$authid.'&m=true');
            }else{
            	return redirect('local-bodyambassador-mobile/?auth_id='.$authid.'&m=true');
            }
        }
    }
	
	

    
    public function myLocalbodyCertificate(){
        $email = Auth::user()->email;
        $lb_result = LocalBody::where('email',$email)->where('status','1')->first();
        $cham_name = $lb_result->name;
        $cert_end_date = date('d/m/Y',strtotime('-1 day', strtotime('+1 Years',strtotime($lb_result->created_at))));
        $pdf = PDF::loadView('localbody/localbody-certificate',['name' => ucwords($cham_name), 'cert_end_date'=>$cert_end_date])->setPaper('DEFAULT_PDF_PAPER_SIZE', 'landscape');
        return $pdf->stream($cham_name.".pdf");
    }
    public function mobileLocalbodyCertificate(){
    	$auth_id = $_REQUEST['auth_id'];
     	$userdata = user::find($auth_id)->first();
     	if(!empty($userdata)){
	    	$lb_data = LocalBody::where('user_id',$auth_id)->where('status','1')->first();
	    	if(!empty($lb_data)){
			    $email = $userdata->email;
		        $cham_name = $lb_data->name;
		        $cert_end_date = date('d/m/Y',strtotime('-1 day', strtotime('+1 Years',strtotime($lb_data->created_at))));
		        $pdf = PDF::loadView('localbody/localbody-certificate',['name' => ucwords($cham_name), 'cert_end_date'=>$cert_end_date])->setPaper('DEFAULT_PDF_PAPER_SIZE', 'landscape');
		        $pdf->getDomPDF()->setHttpContext(
					stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
				);
		        return $pdf->stream($cham_name.".pdf");
	    	}else{
	    		abort(404);
	    	}
	    }else{
	    	abort(404);
	    }
    }

	
    public function localbodyAmbassadorList(){
    	$lbambassador_data = LocalBody::where('status', '1')->orderBy('id','DESC')->paginate(12);
    	return view('fit-india-localbody',compact('lbambassador_data'));
    }
}
