<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Response, Redirect;
use App\Models\GramPanchayat;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use PDF;

class GramPanchayatController extends Controller
{
	
   
    public function index()
    {
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
	        $panchayat_data = GramPanchayat::where('email',$email)->first();
	        if(!empty($panchayat_data)){
	            return view('grampanchayat.application_status',['prerak_data' => $panchayat_data, 'role' => $role]);
	        }else{
	       return view('grampanchayat/gram-panchayat', ['role' => @$role , 'get_state_id'=>@$get_state_id, 'states'=>@$states,'user_info'=>@$userInfo, 'get_district_id'=>@$get_district_id, 'district' => @$district, 'get_block_id'=>@$get_block_id, 'blocks'=>@$blocks ]);
	        }
        }else{
            abort(404);
        }
    }
    public function mobileGrampanchayat()
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
		        $email =$userInfo->email;
		        $states = State::all();
		       
		        $states = State::whereNotIn('name', [@$userInfo->state])->get();
		        $get_state_id = State::where('name', @$userInfo->state)->first();

		        $district = District::where('state_id',@$get_state_id->id)->whereNotIn('name', [@$userInfo->district])->get();
		        $get_district_id = District::where('name',@$userInfo->district)->first();

		        $blocks = Block::where('district_id',@$get_district_id->id)->whereNotIn('name', [@$userInfo->block])->get();
		        $get_block_id = Block::where('name',@$userInfo->block)->first();

		        $role = Role::where('slug', $role)->first()->name;
			    $panchayat_data = GramPanchayat::where('email',$email)->first();
			    if(!empty($panchayat_data)){
			        return view('grampanchayat.application_status',['prerak_data' => $panchayat_data, 'role' => $role]);
			    }else{
			    	return view('grampanchayat/gram-panchayat-mobile', ['role' => @$role , 'get_state_id'=>@$get_state_id, 'states'=>@$states,'user_info'=>@$userInfo, 'get_district_id'=>@$get_district_id, 'district' => @$district, 'get_block_id'=>@$get_block_id, 'blocks'=>@$blocks ]);
			    }
		    }else{
	    		abort(404);
	    	}
    	}else{
	    	abort(404);
	    }
    }
    
    public function create()
    {
        //
    }
    public function Store(Request $request){	        
	    $image = '';
	    $role_slug = 'gram_panchayat';
        $year = date("Y/m");
		$imgurl = array();
		$image1 = '';
		$agedocument = '';
	
		/*$request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'gender' => 'required',
            'state' => 'required',
            'district' =>'required',
            'block' => 'required',            
            'document' => 'required',
            'unique_app_id' => 'required',
			'yclubeventcommits' => 'required',
			'physical_fitness' => 'required',
			'contact' => 'required|digits:10',
			'image' => 'required',
        ]);*/
		if($request->file('image'))
        {
            $image1 = $request->file('image')->store($year,['disk'=>'uploads']);
            $image1 = url('wp-content/uploads/'.$image1);
        }

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
		
		
		$state = State::where('id', $request->state)->first();
		
        $district = District::where('id', $request->district)->first();
        $block = Block::where('id', $request->block)->first();
		
		$user = User::where('email', '=', $request->email)->first();
		$get_role = Role::where('slug', '=', $role_slug)->first();
		

		$gram_panchayat_obj = GramPanchayat::create([
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
            'designation'=>$request->designation,
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
				
		if($gram_panchayat_obj){
			return back()->with('success','Request to become a Fit India Gram Panchayat Ambassador has been submitted successfully. Please wait until your application is verified.');
		}else{
			return back()->with('failed','Something Wrong')->withInput();
		}
	}
			
    public function Store_old(Request $request){	        
	    $image = '';
	    $role_slug = 'gmambassador';
        $year = date("Y/m");
		$imgurl = array();
		$image1 = '';
		$agedocument = '';
		
				
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
		
		
			/*if($request->hasfile('eventphoto')) {
			//$year = date("Y/m");
			foreach($request->file('eventphoto') as $file)
				{
					$name = $file->getClientOriginalName();
					$name = $file->store($year,['disk'=> 'uploads']);
					$name = url('wp-content/uploads/'.$name);
					$imgurl[] = $name;
				}
			}*/
        		
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
			$user->password = Hash::make('GramPanchayat@123');
			
			if($user->save()){		
			   //for new user	
			    $usermeta = new Usermeta();
				$usermeta->user_id = $user->id;
				$usermeta->state = $state->name;
				$usermeta->district = $district->name;
				$usermeta->block = $block->name;				
				$usermeta->save();	
								
				$gram_panchayat_obj = GramPanchayat::create([
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
					'physical_fitness' => $request->physical_fitness,
					'yclubeventcommits' => $request->yclubeventcommits,
					'image' => $image1,
					'contact' => $request->contact,
					//'eventname' => serialize($request->eventname),
					//'noofparticipant' => serialize($request->noofparticipant),
					//'eventphoto' => serialize($imgurl),
				]);	
				
				if($gram_panchayat_obj){
					return back()->with('success','Request to become a Fit India Gram Panchayat has been submitted successfully. Please wait until your application is verified.');
				}else{
					return back()->with('failed','Something Wrong')->withInput();
				}
			}
			
		} else {			
			//dd('www');die();			
			$check_grampanchayat = GramPanchayat::where('email', '=', $request->email)->where('status', '=', '1')->first();
			
			if(!empty($check_grampanchayat)){
				
				return back()->with('failed','You are already approved user by this email address')->withInput();
			
			} else {
				
				$check_grampanchayat2 = GramPanchayat::where('email', '=', $request->email)->where('status', '=', '2')->first();
				
				if(!empty($check_grampanchayat2)){
					
					//dd('bb');die();
					
					$check_grampanchayat3 = GramPanchayat::where('email', '=', $request->email)->where('status', '=', '0')->first();
					
					if(!empty($check_grampanchayat3)){
						
						return back()->with('failed','You are already registered as a Gram Panchayat, Please wait until your application is verified')->withInput();
					
					}else{

					$gram_panchayat_obj = GramPanchayat::create([
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
							'physical_fitness' => $request->physical_fitness,
							'yclubeventcommits' => $request->yclubeventcommits,
							'image' => $image1,
							'contact' => $request->contact,
							//'eventname' => serialize($request->eventname),
							//'noofparticipant' => serialize($request->noofparticipant),
							//'eventphoto' => serialize($imgurl),							
						]);
						
						if($gram_panchayat_obj){
							
							return back()->with('success','Request to become a Fit India Gram Panchayat has been submitted successfully. Please wait until your application is verified.');
						
						 } else {
							
							return back()->with('failed','Something')->withInput();
						}
					}
					
				} else { 
				
				  //dd('cc');die();
					
					$check_grampanchayat4 = GramPanchayat::where('email', '=', $request->email)->where('status', '=', '0')->first();
					
								
					if(empty($check_grampanchayat4)){
						
						 $gram_panchayat_obj = GramPanchayat::create([
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
							'physical_fitness' => $request->physical_fitness,
							'yclubeventcommits' => $request->yclubeventcommits,
							'image' => $image1,
							'contact' => $request->contact,
							//'eventname' => serialize($request->eventname),
							//'noofparticipant' => serialize($request->noofparticipant),
							//'eventphoto' => serialize($imgurl),
												
						]);
						
						if($gram_panchayat_obj){
							return back()->with('success','Request to become a Fit India Gram Panchayat has been submitted successfully. Please wait until your application is verified.');
						}else{
							return back()->with('failed','Something')->withInput();
						}
					}else{
						return back()->with('failed','You are already registered as a Gram Panchayat, Please wait until your application is verified')->withInput();
					}
				}
			}
		}		
			
		return back()->withInput();
	}
    
    
   
   
        public function updateGpEvent(Request $request)
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
		
					$certreq = GramPanchayat::find($request->youthuptflag);
					
					
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
									$imgurl[$i] = $request->imgs[$i];
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
 	public function gpApplicationStatus(Request $request){
	 	$role = Auth::user()->role;
		$email = Auth::user()->email;
        if($role)
        {  
			$grampanchayt_info = GramPanchayat::where('email',$email)->where('status','1')->first();
            $role = Role::where('slug', $role)->first()->name;
            return view('event.gpa_status', ['role' => $role , 'grampanchayt_info' => $grampanchayt_info]);
        }
        return view('event.gpa_status');
    }
    public function gramPanchayatApplyAgain($id){
        if(!empty($id)){
            $del = GramPanchayat::destroy($id);
            if($del){
                return redirect('gram-panchayat-ambassador');
            }else{
            	return redirect('gram-panchayat-ambassador');
            }
        }
    }
    public function gmApplyAgainMobile(){
        $authid = @$_REQUEST['auth_id'];
    	$event_id = @$_REQUEST['event_id'];
    	if(!empty($event_id) and !empty($event_id)){
            $del = GramPanchayat::destroy($event_id);
            if($del){
                return redirect('grampanchayat-ambassador-mobile/?auth_id='.$authid.'&m=true');
            }else{
            	return redirect('grampanchayat-ambassador-mobile/?auth_id='.$authid.'&m=true');
            }
        }
    }
    public function myGramPanchayatCertificate(){
        $email = Auth::user()->email;
        $gm_result = GramPanchayat::where('email',$email)->where('status','1')->first();
        $cham_name = $gm_result->name;
        $cert_end_date = date('d/m/Y',strtotime('-1 day', strtotime('+1 Years',strtotime($gm_result->created_at))));
        $pdf = PDF::loadView('grampanchayat/grampanchayat-certificate',['name' => ucwords($cham_name), 'cert_end_date'=>$cert_end_date])->setPaper('DEFAULT_PDF_PAPER_SIZE', 'landscape');
        return $pdf->stream($cham_name.".pdf");
 
    }
     public function mobileGramPanchayatCertificate(){
     	$auth_id = $_REQUEST['auth_id'];
     	$userdata = user::find($auth_id)->first();
     	if(!empty($userdata)){
	     	$gm_data = GramPanchayat::where('user_id',$auth_id)->where('status','1')->first();
	      	if(!empty($gm_data)){
		      	$email = $userdata->email;
		        $cham_name = $gm_data->name;
		        $cert_end_date = date('d/m/Y',strtotime('-1 day', strtotime('+1 Years',strtotime($gm_data->created_at))));
		        $pdf = PDF::loadView('grampanchayat/grampanchayat-certificate',['name' => ucwords($cham_name), 'cert_end_date'=>$cert_end_date])->setPaper('DEFAULT_PDF_PAPER_SIZE', 'landscape');
		        $pdf->getDomPDF()->setHttpContext(stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]]));
		        return $pdf->stream($cham_name.".pdf");
	   	 	}else{
	   	 		abort(404);
	   	 	}
    	}else{
    		abort(404);
    	}
    }
	
    public function mobileCertYouthclub()
	{		
		$auth_id = @$_REQUEST['auth_id'];		
		
		if(!empty($auth_id)){			
			//$user = User::find($auth_id)->first();
			$user = User::where('id',$auth_id)->first();			
			//dd($user);die;			
			
			if(!empty($user)){
				
				$name = $user->name;
				
				$result = DB::table('wp_youth_club_details')->where('user_id',$auth_id)->first();		
				
				if(!empty($result)){
					$pdf = PDF::loadView('youthclub-certificate',['name' => $name, 'awarded_date' => $result->created ])->setPaper('a4', 'portrait');
					$pdf->getDomPDF()->setHttpContext(
						stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
					);
			        return $pdf->stream($name.".pdf");
		    	}else{
		    		abort(404);
		    	}
			}else{
				abort(404);
			}
		}else{
			abort(404);
		}
	}
	
    public function mobileSchoolCertificate(){        
		$auth_id = @$_REQUEST['auth_id'];		
		//dd($auth_id);die();		
        if(!empty($auth_id)){			
        	//$userdata = User::find($auth_id)->first();
			$userdata = User::where('id',$auth_id)->first();
			
        	if(!empty($userdata)){
		        $name = $userdata->name;
		        $city = DB::table('users')
		                ->join('usermetas','users.id','=','usermetas.user_id')
		                ->select(['usermetas.city'])
		                ->where('user_id', $userdata->id)
		                ->first();
		        $cities = current($city);
		        //return view('certificate',['name' => $name ,'cities' => $cities]);   		
				$sc_cert_result = DB::table('wp_star_rating_status')->where('user_id',$auth_id)->where('cat_id','1621')->where('status','awarded')->first();	
		        if($sc_cert_result){
					$pdf = PDF::loadView('certificate',['name' => $name ,'cities' => $cities]);
					$pdf->getDomPDF()->setHttpContext(
						stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
					);
		        	return $pdf->stream($name.".pdf");
	    		}else{
	    			abort(404);
	    		}
	    	}else{
	    		abort(404);
	    	}
        }else{
        	abort(404);
        }	
    }

    public function updateGramPanchayatNewEvent(Request $request){
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
    
        $prerak = GramPanchayat::where("id", $request->prk_id)->update([
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
    public function gramPanchayatAmbassadorList(){
    	$gmp_data = GramPanchayat::where('status', '1')->orderBy('id','DESC')->paginate(12);
    	return view('fit-india-panchayat',compact('gmp_data'));
    }
   
}
