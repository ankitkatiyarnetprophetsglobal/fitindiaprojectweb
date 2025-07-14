<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\SendMailreset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PasswordResetRequestController extends Controller{    
	
    public function sendEmail(Request $request){
		
		$validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
		
		if ($validator->fails()) {
            return Response::json(array(
				'success' => false,
                'status'    => 'error',
                'code'      =>  422,
                'message'   =>  $validator->messages()->first()
            ), 422);
        }


        $otp = mt_rand(100000,999999);
		$otptoken = mt_rand(100000,999999);
		
		$userverf = User::where('email', $request->email)->first();
		
		if(!empty($userverf)){

			$passverf = DB::table('userpassverification')->where('email', $request->email)->first();
			
			if( empty($passverf) ){
				
				$passverfotp = DB::table('userpassverification')->insert( ['email'=> $request->email, 'otp'=> $otp, 'otptoken'=> $otptoken] );
				if($passverfotp){
				
					$this->send( $request->email, $otp );
					
					return response()->json([
						'success' => true,
						'status' => 'success',
						'otptoken'=> $otptoken,
						'code' =>  200,
						'message' => 'OTP successfully has been sent',         
		            ], 200);
					
					
					
				}else{
					
					return response()->json([
						'success' => false,
						'status' => 'error',
						'code' =>  422,
						'message' => 'OTP not sent',         
		            ], 422);
				}
				
			}else{
				
				$passverfotp = DB::table('userpassverification')->where('email', $request->email)->update(['otp'=> $otp, 'otptoken'=> $otptoken ]);
				if($passverfotp){ 
				
					$this->send( $request->email, $otp );
					
					return response()->json([
						'success' => true,
						'status' => 'success',
						'otptoken'=> $otptoken,
						'code' =>  200,
						'message' => 'OTP successfully has been sent',         
		            ], 200);
					
				}else{
					
					return response()->json([
						'success' => false,
						'status' => 'error',
						'code' =>  422,
						'message' => 'OTP not sent',         
		            ], 422);
					
					
				}
				
			}
			
			
					
		}else{
			return Response::json(array(
				'success' => false,
                'status'    => 'error',
                'code'      =>  404,
                'message'   =>  'Use does not exist with this email'
            ), 404);
		}
				
		
		
    }	
	
	
	public function verifypasswordotp(Request $request){
		
		
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
		
		
		
		$passverf = DB::table('userpassverification')->where('email', $request->email)->first();
		if($passverf){
			
			if($passverf->otp == $request->otp){
				
				return response()->json([
					'success' => true,
					'status' => 'success', 
					'code' => 200,
					'message' => 'User password reset OTP verified'       
				], 200);
				
			}else{
				return response()->json([
					'success' => false,
					'status' => 'error',
					'code' => 401,
					'message' => 'User password reset OTP do not match'       
				], 401);
				
			}
			
		}else{
			return response()->json([
				'success' => false,
				'status' => 'error',
				'code' => 400,
				'message' => 'User password reset request not found',         
			], 400);
		}
		
		
	}
	
	
	public function send( $email, $msg){
		
		
		$otp = $msg;
        		$msg = '<!DOCTYPE HTML><html>
						<head>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
							<title>FIT INDIA User Password Reset OTP</title>
						</head>

						<body>
							<p>Dear FitIndia user,</p>
							<br>
							<p>Welcome, We thank you for your registration at FitIndia mobile app.</p>
							<p>Your user id is '.$email.' </p>
							<p>Your password reset Verification OTP code is : '.$otp.'</p>
							
							<p>Regards, <br> Fit India Mission</p>
							
						</body>
						</html>';
			
		$curlparams = array(
						'user_email' =>$email,
						'message' => $msg,
						'subject' => 'FIT INDIA User Password Reset OTP',						
						);

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
					
		/*
        $token = $this->createToken($email);         
        $site_url=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $url_link=explode('api/', $site_url); 
		
		$linkurl=$url_link[0].'update-password?token='.$token;		
			
		$curl_to_post_parameters = array(
						'user_email'=>$email,
						'message'=>$linkurl,
						'subject'=>'Change Your Password'						
						);

					   $curl_options = array(
						CURLOPT_URL => "https://fitindia.gov.in/mail.php",
						CURLOPT_POST => true,
						CURLOPT_POSTFIELDS => http_build_query($curl_to_post_parameters),
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_HEADER => false
					);

					$curl = curl_init();
					curl_setopt_array($curl, $curl_options);					
					$result = curl_exec($curl);
					curl_close($curl);			  
		*/
		
    }	
	
	public function createToken($email){
		
      $isToken = DB::table('password_resets')->where('email', $email)->first();

      if($isToken) {
        return $isToken->token;
      }

      $token = Str::random(80);
      $this->saveToken($token, $email);
      return $token;
    }
	
	
	public function saveToken($token, $email){
		
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()            
        ]);
    }
	
	public function validEmail($email) {

       return !!User::where('email', $email)->first();
    }	
	
}
