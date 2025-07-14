<?php
namespace App\Http\Controllers\Api;
use App\Models;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response,Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Validation\ValidationException;
use App\Models\Role;
use App\Models\CertQues;
use App\Models\User;
use App\Models\Userkey;
use App\Models\CertStatus;
use App\Models\CertRequest;
use App\Models\Ambassador;
use App\Models\Champion;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\LocalBody;

class SchoolCertificationController extends Controller 
{
   	public function __construct(){
        $this->middleware('auth:api' , ['except' => ['index','schoolcflag','fivestar','threestar','schoolthreestar','schoolfivestar','schoolcertification','schoolCertificate']]);
        //$this->middleware('auth:api' , ['except' => ['index']]);
    }	
	
	public function schoolauth(){ 		
		
		/*$user = auth('api')->user();		
		//dd($user);die;//913077 //914581		
		try {			
			if(!empty($user)){				
			  $userid = $user->id;
		      $role = $user->role;			  
			}			
		 } catch (\Exception $e){			 
		    return back()->with('error',$e->getMessage());
		}*/		
		
		$user = auth('api')->user();
		
		//dd($user);die;
		
		if(empty($user)){	
		
		  return back()->with('error','Unauthorized');//exit();		  
		  //return view('event.schoolflag', ['error' => 'Unauthorized']);			  
		}else{		
		  $userid = $user->id;
		  $role = $user->role;	         
		}
		
		$flag='';
		$fstatus='';
		
		//echo $userid.'/'.$role;die;
		
		if(!empty($userid) && $role=='school'){
			
			$ksts = Userkey::where('user_id', $userid)->first();		
			
			
			if(!empty($ksts)){
			
 			  $flag=1;
              $fstatus=$ksts->value;
			  
			}else {	
			
			  $flag=0;	
              $fstatus='';
              		  
			}
			
			
			//echo $flag;die;			
			
			if($flag==1){			
				
				$scsts=0;
				$thcsts=0;				
				$fivcsts=0;	
				$flag_cert_link='Link not available';
				$star3_cert_link='Link not available';			
				$star5_cert_link='Link not available';
                try {
                    if($fstatus=='1621'){						
					  				  
						$scsts = 1;
						$flag_cert_link = url('/mobile-flag-certificate');	
					}
					else if ($fstatus=='1622'){						
						 		
						$thcsts = 1;	
						//$star3_cert_link = url('/3-star');	
						$scsts = 1;
						$flag_cert_link = url('/mobile-flag-certificate');			  
					}
					else if($fstatus=='1623'){						
						 				  
						$fivcsts = 1;
						//$star5_cert_link = url('/5-flag');	
						$thcsts = 1;	
					   // $star3_cert_link = url('/3-star');	
				     	$scsts = 1;
						$flag_cert_link = url('/mobile-flag-certificate');		
					}

					
					
					if($fstatus!=''){                        
						
						return Response::json(array(
							'status'    => 'success',
							'code'      =>  200,
							'flag_status'   => $scsts,
							'flag_link'   => $flag_cert_link,

							'star3_status'   => $thcsts,
							'star3_link'   => $star3_cert_link,

							'star5_status'   => $fivcsts,
							'star5_link'   => $star5_cert_link,
							
						), 200);	
                       				
                    } else {
						
						return Response::json(array(
							'status'    => 'error',
							'code'      =>  404,
							'message'   => 'Not Apply.'
						), 404);                       
                    }											
						
					
				 } catch (\Exception $e){				 
						return Response::json(array(
							'status'    => 'error',
							'code'      =>  404,
							'error'   => $e->getmessage()), 404);
				}	
	        }else{
				
			   return Response::json(array(
						'status'    => 'error',
						'code'      =>  404,
						'message'   => 'Not Apply for Certification.'
					), 404);    	
			} 
			
		} else {
			return Response::json(array(
				'status'    => 'success',
				'code'      =>  200,
				'message'   => 'No record found',				
			), 200);
			
			/* return Response::json(array(
				'status'    => 'error',
				'code'      =>  401,
				'message'   =>  'Unauthorized User'
			), 401); */
		} 		
	}	
	
	/*public function index(){ 
       //echo "kkk";die();	
		//$user = auth('api')->user();
        //$userid = $user->id;
       // $role = $user->role;	
		//dd($user);die();
		
		$userid=913077;
		$role = 'school';
        		
        if($role)
		{
            $appliedfor = false;
			$currentflag = false;
			
            $appliedfor = Userkey::where('user_id',$userid)->where('key','ratingreqid')->first();
			
            if($appliedfor){
                if($appliedfor->value){
                    $appliedfor = $appliedfor->value;
                    $currentflag = ($appliedfor + 1);
                }
            } else {
				
                $currentflag = 1621;
            }

            $flags = CertQues::where('cert_cats_id',1621)->orderBy('priority', 'asc')->get();
            $threestars = CertQues::where('cert_cats_id',1622)->orderBy('priority', 'asc')->get();
            $fivestars = CertQues::where('cert_cats_id',1623)->orderBy('priority', 'asc')->get();
            

            $role = Role::where('slug', $role)->first()->name;

			if($appliedfor){
          			
				switch($appliedfor){
				  case 1621:
					$flagdata = CertRequest::where('user_id', $userid)->where('cat_id', 1621)->first();
					$flagstatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1621)->first();
					return view('event.schoolflag', ['role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata ]);
					break;				
				 
				    default:
					return view('event.schoolflag', ['role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag ]);
				}				
				
			} else {
				
				return view('event.schoolflag', ['role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag ]);
			}
        }

        return view('event.schoolflag');
    }  */
	
	
	public function schoolcertification(){        
		/*$user = auth('api')->user();
        $userid = $user->id;
        $role = $user->role;*/
		
		$user = auth('api')->user();
		
		//dd($user);die;//913077 //914581
		
		try {			
			if(!empty($user)){				
			  $userid = $user->id;
		      $role = $user->role;			  
			}
			
		 } catch (\Exception $e){
			 
		    return back()->with('error',$e->getMessage());
		}		
		
        //dd($user);		
		
       if(!empty($role))			
		{
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
          			
				switch ($appliedfor) {
				  case 1621:
					$flagdata = CertRequest::where('user_id', $userid)->where('cat_id', 1621)->first();
					$flagstatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1621)->first();
					return view('event.schoolcertification', ['role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata ]);
					break;
				  case 1622:
					$flagdata = CertRequest::where('user_id', $userid)->where('cat_id', 1621)->first();
					$flagstatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1621)->first();
					$threedata = CertRequest::where('user_id', $userid)->where('cat_id', 1622)->first();
					$threestatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1622)->first();
					return view('event.schoolcertification', ['role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata,'threedata' => $threedata, 'threestatusdata' => $threestatusdata ]);
					break;
				  case 1623:
				  
					$flagdata = CertRequest::where('user_id', $userid)->where('cat_id', 1621)->first();
					$flagstatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1621)->first();
					$threedata = CertRequest::where('user_id', $userid)->where('cat_id', 1622)->first();
					$threestatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1622)->first();
					$fivedata = CertRequest::where('user_id', $userid)->where('cat_id', 1623)->first();
					$fivestatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1623)->first();
					
					return view('event.schoolcertification', ['role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata,'threedata' => $threedata, 'threestatusdata' => $threestatusdata, 'fivedata' => $fivedata, 'fivestatusdata' => $fivestatusdata ]);
					break;
				  default:
					return view('event.schoolcertification', ['role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag ]);
				}				
				
			}else{  
				return view('event.schoolcertification', ['role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag ]);
			}
        }

        return view('event.schoolcertification');
    }	
	
	
	public function index(){
		
        //echo "kkk";die();	
		$/*user = auth('api')->user();
        //$userid = $user->id;
       $role = $user->role;	
	    */ 
	   
	   $user = auth('api')->user();
		
		//dd($user);die;//913077 //914581
		
		try {			
			if(!empty($user)){				
			  $userid = $user->id;
		      $role = $user->role;			  
			}
			
		 } catch (\Exception $e){
			 
		    return back()->with('error',$e->getMessage());
		}
	   
	   
	   
		//dd($user);die();
		
/* 		$userid=913077;
		$role = 'school'; */
        		
        if($role)
		{
            $appliedfor = false;
			$currentflag = false;
			
            $appliedfor = Userkey::where('user_id',$userid)->where('key','ratingreqid')->first();
			
            if($appliedfor){
                if($appliedfor->value){
                    $appliedfor = $appliedfor->value;
                    $currentflag = ($appliedfor + 1);
                }
            } else {
				
                $currentflag = 1621;
            }

            $flags = CertQues::where('cert_cats_id',1621)->orderBy('priority', 'asc')->get();
            $threestars = CertQues::where('cert_cats_id',1622)->orderBy('priority', 'asc')->get();
            $fivestars = CertQues::where('cert_cats_id',1623)->orderBy('priority', 'asc')->get();
            

            $role = Role::where('slug', $role)->first()->name;

			if($appliedfor){
          			
				switch($appliedfor){
				  case 1621:
					$flagdata = CertRequest::where('user_id', $userid)->where('cat_id', 1621)->first();
					$flagstatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1621)->first();
					return view('event.cert1', ['role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata ]);
					break;				
				 
				    default:
					return view('event.cert1', ['role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag ]);
				}				
				
			} else {
				
				return view('event.cert1', ['role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag ]);
			}
        }

        return view('event.cert1');
    }
	
	public function fivestar(Request $request){	
		//echo "fivestar";//die();       
		$user = auth('api')->user();
        $userid = $user->id;
        $role = $user->role;
		
		//dd($request);die();	
		//dd($user);die();			
		///$userid=913077;
		//$role = 'school';	
		//(Request $request){		
        		
        if($role)
		{
            $appliedfor = false;
			$currentflag = false;
			
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
				switch($appliedfor){				
					
				    case 1623:				  
					$flagdata = CertRequest::where('user_id', $userid)->where('cat_id', 1621)->first();
					$flagstatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1621)->first();
					$threedata = CertRequest::where('user_id', $userid)->where('cat_id', 1622)->first();
					$threestatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1622)->first();
					$fivedata = CertRequest::where('user_id', $userid)->where('cat_id', 1623)->first();
					$fivestatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1623)->first();
					
					return view('event.fivestars', ['role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata,'threedata' => $threedata, 'threestatusdata' => $threestatusdata, 'fivedata' => $fivedata, 'fivestatusdata' => $fivestatusdata ]);
					break;
					
				    default:
					return view('event.fivestars', ['role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag ]);
				}				
				
			} else {
				
				return view('event.fivestars', ['role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag ]);
			}
        }

        return view('event.fivestars');
    }
	
	public function threestar(){
		//echo "threestar";//die();       
		/* $user = auth('api')->user();threestars.blade.php
        $userid = $user->id;
        $role = $user->role; */		
		//dd($user);die();		
		
		$userid=913077;
		$role = 'school';
        		
        if($role)
		{
            $appliedfor = false;
			$currentflag = false;
			
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
          			
				switch ($appliedfor) {
				 
				  case 1622:
					$flagdata = CertRequest::where('user_id', $userid)->where('cat_id', 1621)->first();
					$flagstatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1621)->first();
					$threedata = CertRequest::where('user_id', $userid)->where('cat_id', 1622)->first();
					$threestatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1622)->first();
					return view('event.threestars', ['role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata,'threedata' => $threedata, 'threestatusdata' => $threestatusdata ]);
					break;
				  					
				    default:
					return view('event.threestars', ['role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag ]);
				}				
				
			} else {
				
				return view('event.threestars', ['role' => $role, 'flags' => $flags,'threestars' =>$threestars, 'fivestars'=>$fivestars, 'appliedfor'=> $appliedfor, 'currentflag'=>$currentflag ]);
			}
        }

        return view('event.threestars');
    }

    public function schoolcflag(Request $request){
	   //dd($request);	   
	   //echo "test name";user_id
	   //die();
	   
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
		
		//dd($messages);
		//die();

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
	
	/* public function schoolcflag(Request $request){
       //:attribute playgound
       //dd($request);die();	  

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
				
		$data  =  $request->all();
		$validator = Validator::make($data,$rules);		
		
		//if ($validator->fails()) {
         //   return redirect('api/school-certification')
          //              ->withErrors($validator)
         //               ->withInput();exit();
        //}	

		if($validator->fails()){
			$messages = $validator->messages();
			
			foreach($messages->all() as $message)
			{
				$message='<p style="color:red;">'.$message.'</p>';	
				print_r(str_replace('.','<br>',$message));				
			}
			
			echo "<p style='color:green;'><a href='".route('api.schoolcert')."'>Back</a><p>"; 
			exit();
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
 }*/
		
    /* public function schoolcflag(Request $request){  //json format error show	
	  //dd($request);      
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
		
		//The peteachernames
		
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
		
		$data = $request->all();
        //$request->validate($rules , $messages );		
		$data  =  $request->all();
		$validator = Validator::make($data,$rules);
        $err='';
		
		if($validator->fails()){
			
			return Response::json(array(
				'status'    => 'error',
				'code'      =>  400,
				'message'   =>  array('msg'=>$validator->messages()->first())
			), 400);
			
			$messages = $validator->messages();
			foreach($messages->all() as $message)
			{
				$message='<p style="color:red;">'.$message.'</p>';	
				print_r(str_replace('.','<br>',$message));				
			}			
			echo "<p style='color:green;'><a href='".route('api.schoolcert')."'>Back</a><p>";
			exit();
		}
		
		//peteachernames[]  playgroundarea   playgroundlside
		
		$chkerro = false;
		$validator = Validator:: make([],[]);
		$i=0;
		
        while($i < $request->playgroundno){
			if(empty($request->playgroundshape[$i])){
				$chkerro = true;
				$validator->errors()->add("playgroundshape ".$i, 'Please select playground '.($i+1).' shape ');
			}
			
			if(empty($request->playgroundimg[$i]) ){
				$chkerro = true;
				$validator->errors()->add("playgroundimg ".$i, 'Please upload playground '.($i+1).' image ');
			}
			
			$i++;		
		}      
		
        if($totmin < 60){
			$chkerro = true;
			$validator->errors()->add('assemblyactivityno', 'Sum of total minutes must be greater than 60 minutes for Daily Physical Activities by Students');
			
			//return redirect()->back()->withErrors('error','Total minutes must be greater than 60 minutes for Daily Physical Activities by Students')->withInput();
            //return back()->withErrors('activity','Total minutes must be greater than 60 minutes for Daily Physical Activities by Students');
         
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
			//return back()->with('error','Please try again.');
			//return response()->json(["error" => "Please try again"]);			
			return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'error'   => "Please try again"), 404);			
			
		 } catch (\Exception $e){
		  //return back()->with('error',$e->getMessage());
		        return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'error'   => $e->getmessage()), 404);
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
						
						return Response::json(array(
							'status'    => 'success',
							'code'      =>  200,
							'message'   =>  'Your request have submitted successfully.'
						), 200);

                        //return back()->with('success','Your request have submitted successfully.');
                    }else {
                        //return back()->with('error','Your request not submitted successfully.');
						return Response::json(array(
								'status'    => 'error',
								'code'      =>  422,
								'message'   =>  'Your request not submitted successfully.'
							), 422);
                    }                    
                 } catch (\Exception $e){
					  return Response::json(array(
						'status'    => 'error',
						'code'      =>  404,
						'message'   =>  $e->getmessage()
					  ), 404); 
					 
                    //return back()->with('error',$e->getMessage());
                }

               //return back()->with('success','Request added successsfully');
			   
		        return Response::json(array(
					'status'    => 'success',
					'code'      =>  200,
					'message'   => 'Request added successsfully'
				), 200);
			
        } else {
                //return back()->with('error','Request not added successsfully');
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   => 'Request not added successsfully'
				), 404); 
          }   
		} catch (\Exception $e){			
			return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   => $e->getMessage()
			), 404); 
			//return back()->with('error',$e->getMessage());
		 }
		 
	  } 
   }  */
   
   public function schoolfivestar(Request $request){	   
	  //dd($request);die(); 
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
		
		foreach($request->facilities as $val){ if(!empty($val)){ $facilityval = true; } }
		
		if(empty($facilityval)){ 
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
			return Response::json(array(
				'status'    => 'error',
				'code'      =>  404,
				'error'   => "Please try again"), 404);	
			//return back()->with('error','Please try again.');
		 } catch (\Exception $e){
		  //return back()->with('error',$e->getMessage());
		    return Response::json(array(
				'status'    => 'error',
				'code'      =>  404,
				'message'   =>  $e->getmessage()
			), 404); 
		}
		
 } else if(($flag==0 ) || ($flag==1 && $cflag==1)){	

   //dd($request);die();        
    try{
        $certstatus = new CertStatus();
        $certstatus->user_id = $request->user_id; 
		$certstatus->cat_id  = $request->ratingreqid;
		$certstatus->cur_status = 'applied';
		$certstatus->status = 'applied';
        $certstatus->created  = date('Y-m-d H:i:s');
        $certstatus->updated  = date('Y-m-d H:i:s');
        
        if($certstatus->save()) {

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
						
						return Response::json(array(
							'status'    => 'success',
							'code'      =>  200,
							'message'   => 'Request added successsfully'
						), 200);	
                       // return back()->with('success','Request added successsfully');						
                    }else {
						
						return Response::json(array(
							'status'    => 'error',
							'code'      =>  404,
							'message'   => 'Request not added successsfully'
						), 404); 
						
                        //return back()->with('error','Request not added successsfully');
                    }
                    
                } catch (\Exception $e) {
                    //return back()->with('error',$e->getMessage());
					return Response::json(array(
						'status'    => 'error',
						'code'      =>  404,
						'message'   =>  $e->getmessage()
					), 404); 					
                }
				
				return Response::json(array(
					'status'    => 'success',
					'code'      =>  200,
					'message'   => 'Request added successsfully'
				), 200);
				
            //return back()->with('success','Your request have submitted successfully.');
			
        } else {			
            //return back()->with('error','Your request not submitted successfully.');			
			return Response::json(array(
				'status'    => 'error',
				'code'      =>  404,
				'message'   => 'Request not added successsfully'
			), 404); 
        }
   
    } catch (\Exception $e){
        //return back()->with('error',$e->getMessage());
		return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   => $e->getMessage()
				), 404); 
        }
    } 
 }
   
   public function schoolthreestar(Request $request){	   
            
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
		
		//noteachersplaying must be less than
		
		$data  =  $request->all();
        $validator = Validator::make($data,$rules);
		
		if($validator->fails()){
			
			$messages = $validator->messages();
			
			foreach($messages->all() as $message)
			{
				$message='<p style="color:red;">'.$message.'</p>';	
				print_r(str_replace('.','<br>',$message));				
			}
			
			echo "<p style='color:green;'><a href='".route('api.schoolcert')."'>Back</a><p>";
			exit();
		}
		
		//kkkk

      /*echo "threestar name1"; noteachersplaying 
         dd( $validator);	   
		die('kkk');*/ 		
				
        //dd($csts);
        //$request->validate($rules , $messages );
		
		/* $chkerro = false;
		//$validator = Validator::make([],[]);
		$validator = Validator::make([],[]);
		$i=0; */
		
		//dd($request->trainedteacherno);die;
		 
        /* while($i < $request->trainedteacherno){
			
			if(empty($request->trainedteachername[$i]) ){
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
			
			$i++;		//user_id
		} 
		
		//dd($request->user_id);die();
		
		if($chkerro){
			throw new ValidationException($validator);   
		} */				
	
	
	$flag=0;
	$cflag=0;//trainedteachername  trainedteachername[1]	
	$csts = CertStatus::where('user_id', $request->user_id)->first();
	
	//dd($csts);die();
	
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

  //echo "kkkk".$cflag;die();	
				
  if($flag==1 && $cflag==0){
	try {	
		CertStatus::where('user_id', $request->user_id)->delete();
		//return back()->with('error','Please try again.');
		 return Response::json(array(
				'status'    => 'error',
				'code'      =>  404,
				'error'   => "Please try again"), 404);			
	 } catch (\Exception $e){		 
		return Response::json(array(
			'status'    => 'error',
			'code'      =>  404,
			'message'   =>  $e->getmessage()
		  ), 404);  
	  //return back()->with('error',$e->getMessage());
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
			
			if($request->hasfile('encouragesdoc')){
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
						
						return Response::json(array(
							'status'    => 'success',
							'code'      =>  200,
							'message'   =>  'Your request have submitted successfully.'
						), 200);
			

                        //return back()->with('success','Your request have submitted successfully.');
                    }else {
                        //return back()->with('error','Your request not submitted successfully.');
						
						return Response::json(array(
							'status'    => 'error',
							'code'      =>  404,
							'message'   =>  $e->getmessage()
						  ), 404); 		
                    }
                    
                } catch (\Exception $e) {
                    //return back()->with('error',$e->getMessage());
					return Response::json(array(
						'status'    => 'error',
						'code'      =>  404,
						'message'   =>  $e->getmessage()
					  ), 404); 		
                }

				return Response::json(array(
					'status'    => 'success',
					'code'      =>  200,
					'message'   =>  'Your request have submitted successfully.'
				), 200);
						
            //return back()->with('success','Request added successsfully');
        } else {
            //return back()->with('error','Request not added successsfully');
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   =>  $e->getmessage()
				  ), 404); 
        }
   
    } catch (\Exception $e){
        //return back()->with('error',$e->getMessage());
		return Response::json(array(
			'status'    => 'error',
			'code'      =>  404,
			'message'   =>  $e->getmessage()
		  ), 404); 
     }  
   } 
 }

 public function schoolCertificate(Request $request){ //schoolCertificate 
       	//$user = auth('api')->user();
        //$userid = $user->id;
        //$role = $user->role;		
		//dd($user);die();		
		//$userid=913077; 
		/*$sid = Auth::user()->id;
		$name = Auth::user()->name;*/
		

		$user = auth('api')->user();
        $sid = $user->id;
        $name = $user->name;
		
		
		
		//$sid = 913077;		
		//$ads = User::where('id', $sid)->first();		
		//$name = $ads->name;		
		//dd($name);die();	
		
        $city = DB::table('users')
                ->join('usermetas','users.id','=','usermetas.user_id')
                ->select(['usermetas.city'])
                ->where('user_id', $sid)
                ->first();			
				
        $cities = current($city);
		
        $qr_data='';		
		$qr_data.='https://fitindia.gov.in/'."\r\n";
		$qr_data.= 'School Name : '.$name. "\r\n".'City Name : '.$cities. "\r\n" .'User ID : '.$sid;
		
        $qrcode = QrCode::size(75)->generate($qr_data); 		
        $pdf = PDF::loadView('certificate',compact('qrcode','name','cities'));
        
        return $pdf->stream($name.".pdf");	
    }
	
    public function myChampionCertificate(Request $request){       
        $email = Auth::user()->email;
        $cham_name = Champion::where('email',$email)->where('status','1')->first()->name;
        $cert_end_date = date('d/m/Y', strtotime('-1 day',strtotime("+12 Months")));
        $pdf = PDF::loadView('champion-certificate',['name' => ucwords($cham_name), 'cert_end_date'=>$cert_end_date])->setPaper('DEFAULT_PDF_PAPER_SIZE', 'landscape');
        return $pdf->stream($cham_name.".pdf");
    }
	
    public function myAmbassadorCertificate(Request $request){       
        $email = Auth::user()->email;
        $amb_name = Ambassador::where('email',$email)->where('status','1')->first()->name;
        $cert_end_date = date('d/m/Y', strtotime('-1 day',strtotime("+12 Months")));
        $pdf = PDF::loadView('ambassador-certificate',['name' => ucwords($amb_name), 'cert_end_date'=>$cert_end_date])->setPaper('DEFAULT_PDF_PAPER_SIZE', 'landscape');
        return $pdf->stream($amb_name.".pdf");
    }	
}







