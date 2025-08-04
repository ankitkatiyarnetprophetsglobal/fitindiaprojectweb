<?php
namespace App\Http\Controllers\Api;
use App\Models;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use App\Models\Userverification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;
use App\Models\User;

class UserVerify extends Controller
{
    //public function index(Request $request)    
    public function verify_user_email(Request $request){	

    	//dd($request);exit;
		//$rules = [ 'email' => 'required'];
		
		$validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
		
		if ($validator->fails()) {
            return Response::json(array(
                'status'    => 'error',
                'code'      =>  422,
                'message'   =>  $validator->messages()->first()
            ), 422);
        }


         $otp = mt_rand(100000,999999);		

		  $userverification = Userverification::where('email', $request->email)->first();
		  //dd($userv);exit;
			  if(!empty($userverification)){
				if(empty($userverification->isverified)){
					 Userverification::where('email', $request->email)->update(['otp' => $otp]);				    
					
					$this->send($request->email,$otp);
					
					return response()->json([
		            'success' => true,
		            'message' => 'OTP successfully has been sent',         
		            ], 200);

				} else {
					
					return response()->json([
		            'success' => true,
		            'message' => 'You are already Verified',         
		            ], 200);
				}

			 } else {			

				$userv = new Userverification();
				$userv->email = $request->email;
				$userv->otp = $otp;
				$userv->save();
				
				$this->send($request->email,$otp);
				return response()->json([
		            'success' => true,
		            'message' => 'OTP successfully has been sent',         
		            ], 200);
				
		    } 	     		  
	} 

	public function send($email,$msg){
				$otp = $msg;
        		$msg = '<!DOCTYPE HTML><html>
						<head>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
							<title>FIT INDIA Email verification OTP</title>
							<style>.yada{color:green;}</style>
						</head>

						<body>
							<p>Dear FitIndia user,</p>
							<br>
							<p>Welcome, We thank you for your registration at FitIndia mobile app.</p>
							<p>Your user id is <'.$email.'> </p>
							<p>Your email id Verification OTP code is : '.$otp.'</p>
							<p>You will use this user id given above for all activities on FitIndia mobile app. The user id cannot be changed and hence we recommend that you store this email for your future reference.</p>
							<p>Regards, <br> Fit India Mission</p>
							
						</body>
						</html>';
			
		$curlparams = array(
						'user_email' =>$email,
						'message' => $msg,
						'subject' => 'FIT INDIA Email verification OTP',						
						'html'=>' <!DOCTYPE HTML><html>
						<head>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
							<title>FIT INDIA Email verification OTP</title>
							<style>.yada{color:green;}</style>
						</head>

						<body>
							<p style="color:red">Please find '.$msg.'</p>
							
						</body>
						</html>');

				$curl_options = array(
					CURLOPT_URL => "http://10.247.140.87/mail.php", 
					CURLOPT_POST => true,
					CURLOPT_POSTFIELDS => http_build_query($curlparams),
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_HEADER => false
				);

					$curl = curl_init();
					curl_setopt_array($curl, $curl_options);					
					$result = curl_exec($curl);
					curl_close($curl);			  
		   
    }
 	

   public function verifyuser(Request $request){
	   
	    $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:156',
			'otp' => 'required|regex:/\b\d{6}\b/'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
			return response()->json([
			'success' => false,
			'status' => 'error',
            'code' => 400,
			'message' => $error,         
			], 400);
        }	
	
   	 
      $verifyUser = Userverification::where('email', $request->email)->first();	
	  
	  if(!empty($verifyUser)){
		  
		$email = $request->email; 
		
		if(empty($verifyUser->isverified)){	
		
			if($request->otp == $verifyUser->otp){				
				
				//Userverification::where('email', $request->email)->update(['isverified' => '1']);
				
				$userverf = User::where('email', $request->email)->first();
				
				if(!empty($userverf)){	
				
					User::where('email', $request->email)->update(['verified' => '1']);
					
					Userverification::where('email', $request->email)->update(['isverified' => '1']);
					
				}
				
					return response()->json([
					'success' => true,
					'status'    => 'sucess',
					'code'      =>  200,
					'message' => 'Your e-mail is verified',         
					], 200);
			  
			}else{
				return Response::json(array(
                'status'    => 'error',
				'success' => false,
                'code'      =>  422,
                'message'   =>  'OTP does not match'
				), 422);
			}
		  
		  
		} else {
		  
		  return response()->json([
			'success' => true,
			'status'    => 'sucess',
			'code'      =>  200,
			'message' => 'Your e-mail is already verified',         
			], 200);
		}

	  } else {

	  	 return Response::json(array(
                'status'    => 'error',
				'success' => false,
                'code'      =>  422,
                'message'   =>  'Sorry your email cannot be identified'
            ), 422);
	   }	  
	}


	 public function eventarchive(Request $request){

         
	    		 
		 try { 		   
	   
			$data = EventArchive::leftJoin('archive_role','archive_role.archive_id', '=', 'event_archive.id')			
					 ->select(['event_archive.*']);
					
			if($request->role_id){				
			   
			   $data = $data->where('archive_role.role_id', $request->role_id);
			}
			
			if(!empty($request->archid)){			
			 
			  $data = $data->where('event_archive.id', $request->archid);
			}	

            if($request->language){
				
			   $data = $data->where('event_archive.language', 'like', '%'.$request->language.'%');
			}			
				
			if($request->name){
				
			   $data = $data->where('event_archive.title', 'like', '%'.$request->name.'%');
			}			
									  
		    $archive=$data->where('event_archive.status','=','Active')->orderBy('title','ASC')->groupBy('event_archive.id')->get();						
			
			$event_archive=array();
		 
		    if(!empty($archive)){
				
			   foreach($archive as $cval){

                 $archrole  = DB::table('archive_role')
				                ->leftJoin('roles', 'roles.id', '=', 'archive_role.role_id')
								->where('archive_id', $cval->id)	
								->get();

                if(!empty($archrole)){
				
				  foreach($archrole as $rol){					  
					  //print_r($rol->name);					  
					 $roldata=array(
						"roleid" => $cval->id,
						"role" => $rol->name						
					);					
				  }
				}								
               
               	 $achdata=array(
						"id" => $cval->id,
						"name" => $cval->title,
						"poster_image" => $cval->poster_image,
						"link" => $cval->link,
						"language" => $cval->language,
						"role_name" => $roldata,
						"start_date" => $cval->start_date,
						"end_date" => $cval->end_date,												
						"status" => $cval->status
					);
					
				  array_push($event_archive,$achdata);	
			    }				
			}

			if(!empty($event_archive)){
			  return Response::json(array(
				'status'    => 'success',
				'code'      =>  200,
				'message'   => $event_archive, 
			  ), 200);
			  
			} else {
				
			  return Response::json(array(
				'status'    => 'error',
				'code'      =>  404,
				'message'   => 'Data not found jjj.', 
			  ), 404);					
			}			
			
		} catch(Exception $e){ 
		   
			return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   =>  'Unauthorized : '.$e->getmessage()
				), 404);
		}			
	}	
     
 }