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
    
	public function challange_otp(Request $request){
       
		try{ 
			$iv = "fedcba9876543210"; 
			$key = "0a9b8c7d6e5f4g3h";
				
				if(strpos($request->reqtime, '=') == false){
					return Response::json(array(
						'status'    => 'error',
						'code'      =>  422,
						'message'   =>  'Not valid request'
					), 422);
				}					
				
				 
			$reqtimevar = $this->decrypt($key, $iv, $request->reqtime);			
			
			$messsages = array(
					'email.required'=>'Please enter the email.',
					'email.email'=>'Please enter valid email.',
					'mobile.required'=>'Please enter the mobile number.',
					'mobile.numeric'=>'Please enter numeric value.',
					'mobile.digits'=>'Please enter min 10 digit number.',
			);

			
			$email = $request->email;// '9874125360';	   
		   	$mobile = $request->mobile;// '9874125360';	 
				
			$key = $reqtimevar . 'fitind';
			//$email = $this->decrypt($key, $iv, $request->email);//phone number sms send	
            
			if(!empty($mobile) && is_numeric($mobile) && $mobile=='0000000000'){
			   return Response::json(array(
					'status' => 'error', 'code'=> 500, 'data' =>'[]'
				), 500);
				
			} else if(!empty($mobile) && is_numeric($mobile) && $mobile!='0000000000'){
				
				$validator = Validator::make( array("phone" => $mobile),['phone' => 'required|digits:10'],$messsages);			
			
				
			} else if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				
				$validator = Validator::make( array("email" => $email),['email' => 'required|email'],$messsages);			
						
			} else {
				
				return Response::json(array(
					'status' => 'error', 'code'  =>  422, 'message'   =>  'Invalid Input'
				), 422);
			}			
			
			if($validator->fails()){
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  $validator->messages()->first()
				), 422);
			}
			
            /* if(is_numeric($email)){				
				$validator = Validator::make(
					array( "phone" => $email),['phone' => 'required|digits:10']
				);
				
			}else if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				
				$validator = Validator::make( array( "email" => $email ), ['email' => 'required|email']);
				
			}else{
				return Response::json(array(
					'status' => 'error', 'code'  =>  422, 'message'   =>  'Invalid Input'
				), 422);
			} */	           
							
				/*$validator = Validator::make(array("email" => $email), [
					'email' => 'required|email',
				]);*/
				
				/* if($validator->fails()){
					return Response::json(array(
						'status'    => 'error',
						'code'      =>  422,
						'message'   =>  $validator->messages()->first()
					), 422);
				}
 */
				$otp = mt_rand(100000,999999);	
				//$phone_otp = '123456';
				$phone_otp = $otp;
				$cflag='';
				
                $start = date( "Y-m-d 00:00:00");
				$end = date( "Y-m-d 23:59:59");
                
				if(is_numeric($mobile) && $mobile!='0000000000'){
				
					$userverification = Userverification::where('phone', $mobile)->first();
					$otpcnt = OtpTrack::where('phone', $mobile)->where('type','user')->whereBetween('created_at',[$start,$end])->count();
					$cflag='0';
					
				} else if(filter_var($email, FILTER_VALIDATE_EMAIL)){					
									
					$userverification = Userverification::where('email', $email)->first();				
					$otpcnt = OtpTrack::where('email', $email)->where('type','user')->whereBetween('created_at',[$start,$end])->count();
					$cflag='1';					
				}	 				
				
				/* if(is_numeric($email)){						
					//echo "aaaa";			
					$userverification = Userverification::where('phone', $email)->first();
					$otpcnt = OtpTrack::where('phone', $email)->where('type','user')->whereBetween('created_at',[$start,$end])->count();
					$cflag='0';
				} else if(filter_var($email, FILTER_VALIDATE_EMAIL)){					
					//echo "bbbb";					
					$userverification = Userverification::where('email', $email)->first();
                    $otpcnt = OtpTrack::where('email', $email)->where('type','user')->whereBetween('created_at',[$start,$end])->count();
                    $cflag='1';					
				}	 */						
				
				//$userverification = Userverification::where('email', $email)->first();
				
				/* $start = date( "Y-m-d 00:00:00");
				$end = date( "Y-m-d 23:59:59"); */
				
				//$otpcnt = OtpTrack::where('email', $email)->where('type','user')->whereBetween('created_at',[$start,$end])->count();
				//print_r($otpcnt); 
				
				
				//echo $cflag;die;
				
				/* if($otpcnt > 50){				
					return Response::json(array(
							'status'    => 'error',
							'code'      =>  401,
							'message'   =>  'Your request limit exceeds'
						), 401);
				} */
					
				  
					if(!empty($userverification)){
						
						if(empty($userverification->isverified)){
							
							if($cflag==1){								
								//echo "aaaa".$email; die;								
								Userverification::where('email', $email)->update(['otp' => $otp]);
								
								$this->send($email,$otp);
								
								$otptrc = new OtpTrack();
								$otptrc->email = $email;
								$otptrc->otp = $otp;
								$otptrc->type = 'user';
								$otptrc->save();
					
								return response()->json([
								'success' => true,
								'status'    => 'success',
								'code'      =>  200,
								'message' => 'OTP successfully has been sent', 
								'reqtime' => $request->reqtime,
								], 200);	
								
							} else if($cflag==0){
								
								Userverification::where('phone', $mobile)->update(['otp' => $phone_otp]);	 
							    
								$this->sendsms($mobile,$otp);
								
								$otptrc = new OtpTrack();
								$otptrc->phone = $mobile;
								$otptrc->otp = $phone_otp;
								$otptrc->type = 'user';
								$otptrc->save();
					
								return response()->json([
								'success' => true,
								'status'    => 'success',
								'code'      =>  200,
								'message' => 'Phone OTP successfully updated', 
								'reqtime' => $request->reqtime,
								], 200);								
							}
							
							/*Userverification::where('email', $email)->update(['otp' => $otp]); 
							$this->send($email,$otp);							
							$otptrc = new OtpTrack();
							$otptrc->email = $email;
							$otptrc->otp = $otp;
							$otptrc->type = 'user';
							$otptrc->save();
				
							return response()->json([
							'success' => true,
							'message' => 'OTP successfully has been sent', 
							'reqtime' => $request->reqtime,
							], 200); */

						} else {
							
							return response()->json([
							'status'    => 'success',
							'code'      =>  201,

							'success' => true,
							'message' => 'You are already Verified', 
							'reqtime' => $request->reqtime,
							], 201);
						}

					} else {

						 if($cflag==1){							 
							
                            $userv = new Userverification();
							$userv->email = $email;
							$userv->otp = $otp;						
							$userv->save();
							
							$this->send($email,$otp);
							
							$otptrc = new OtpTrack();
							$otptrc->email = $email;
							$otptrc->otp = $otp;
							$otptrc->type = 'user';
							$otptrc->save();
								
							return response()->json([
								'success' => true,
								'status'    => 'success',
								'code'      =>  200,
								'message' => 'OTP successfully has been sent', 
								'reqtime' => $request->reqtime,
								], 200);							
								 
						 } else if($cflag==0){						 
							
							$userv = new Userverification();
							$userv->phone = $mobile;
							$userv->otp = $phone_otp;						
							$userv->save();
							
													
							$otptrc = new OtpTrack();
							$otptrc->phone = $mobile;
							$otptrc->otp = $phone_otp;
							$otptrc->type = 'user';
							$otptrc->save();
							
							$this->sendsms($mobile,$otp);
							
							return response()->json([
							'status'    => 'success',
							'code'      =>  200,
								'success' => true,
								'message' => 'Phone OTP successfully updated', 
								'reqtime' => $request->reqtime,
								], 200);							 
						 }						

						/*$userv = new Userverification();
						$userv->email = $email;
						$userv->otp = $otp;						
						$userv->save();						
						$this->send($email,$otp);						
						$otptrc = new OtpTrack();
						$otptrc->email = $email;
						$otptrc->otp = $otp;
						$otptrc->type = 'user';
						$otptrc->save();
							
						return response()->json([
							'success' => true,
							'message' => 'OTP successfully has been sent', 
							'reqtime' => $request->reqtime,
							], 200); */						
					}					

		} catch(Exception $e) { 
		   
			return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   =>  'Unauthorized : '.$e->getmessage()
				), 404);
		}			
	} 
	
	
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
	//    dd(123456);
	    // $validator = Validator::make($request->all(), [
        //     'email' => 'required|email|max:156',
		// 	'otp' => 'required|regex:/\b\d{6}\b/'
        // ]);

        // if ($validator->fails()) {
        //     $error = $validator->errors()->first();
		// 	return response()->json([
		// 	'success' => false,
		// 	'status' => 'error',
        //     'code' => 400,
		// 	'message' => $error,         
		// 	], 400);
        // }	
	
	dd($request->email);	
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