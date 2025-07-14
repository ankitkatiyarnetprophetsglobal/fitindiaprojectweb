<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordresetController extends Controller
{
	public function changePassword(Request $request)
	{

		return view('auth.email');
	}
	public function validatePasswordRequest(Request $request)
	{
		$user = DB::table('users')->where('email', '=', $request->email)->get();
		//print_r($user);
		//exit();
		$randomtoken = Str::random(60);
		//Check if the user exists
		if (count($user)< 1) {
			return back()->with(['message' => 'User does not exist']);
       }

	   $validcount = DB::table('password_resets')->where('email', '=', $request->email)
	   ->where('created_at', '>=', Carbon::now()->subMinutes(1))->orderBy('created_at', 'DESC')->get();

	   if(count($validcount)> 0){
		   $datefirst = Carbon::parse($validcount[0]->created_at);
		   //Check if  Expired dummy token still  applicable
		   if($datefirst->gte(Carbon::now())){
		     return back()->with(['message' => 'Too many attempts. Please try again after some time']);
		   }

	   }
	   if (count($validcount)>=3  ){
		   //Create Expired dummy token of 5 mmins ahead time to stop access for five mins
		   DB::table('password_resets')->insert([
				'email' => $request->email,
				'token' => $randomtoken,
				'created_at' => Carbon::now()->addMinutes(5),
				'IsExpired' => 1
				]);
		  return back()->with(['message' => 'Too many attempts. Please try again after some time.']);
	   }

	   //Create Password Reset Token
				DB::table('password_resets')->insert([
				'email' => $request->email,
				'token' => $randomtoken,
				'created_at' => Carbon::now()
		]);

		//$tokenData = DB::table('password_resets')
		//			->where('email', $request->email)->first();


		if($this->sendResetEmail($request->email, $randomtoken)) {
			return back()->with('message', 'Your password change link have been sent on your email successfully.');
		}
		else {
		return back()->with(['message' =>'A Network Error occurred. Please try again.']);
		}
	}
		private function sendResetEmail($email , $token)
		{

			// dd(123456);

			$user = DB::table('users')->where('email', $email)->select('name', 'email')->first();

			// dd($user);
			$user = encrypt($user->email);
			$link = url('password/reset/' . $token . '?email=' . $user)  ;
			// dd($link);
			$message = $link;


				try {
				//Here send the link with CURL with an external email API
					// old code here start
						// $ch = curl_init();
						// curl_setopt($ch, CURLOPT_URL,"http://10.247.140.87/mail.php");
						// curl_setopt($ch, CURLOPT_POST, 1);
						// curl_setopt($ch, CURLOPT_POSTFIELDS,"user_email=$email&message=$message&subject='Fit India Password Reset link'");
						// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						// $server_output = curl_exec($ch);
						// curl_close ($ch);
					// old code here end

					// new code here start
					$curl = curl_init();
						curl_setopt_array($curl, array(
							CURLOPT_URL => "https://fitindia.gov.in/test/mail/webmailmail.php?email=$email&message=$message",
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => '',
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 0,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => 'GET',
						));

						$response = curl_exec($curl);
						//dd($response);
						curl_close($curl);

						// dd("https://fitindia.gov.in/test/mail/webmailmail.php?email=$email&message=$message");
						if($response){
							return true;
						}else{
							return false;
						}

					// new code here end
					return back()->with('message','Your password change link have been sent on your email successfully ');


				}
				catch (Exception $e) {
					return $e->message();
				}
			}


		public function resetPassword(Request $request)
		{

			$email = decrypt($request->email);

			// dd($request->all());
			$request->validate([
				// 'email' => 'required|email|exists:users,email',
				'email' => 'required',
				'password' => 'required|confirmed',
				'token' => 'required', ]);


			// if (empty($request->email))
			if (empty($email))
			{
			return back()->with(['email' => 'Please complete the form']);
			}
			// dd($email);
			$password = Hash::make($request->password);

			// $tokenData = DB::table('password_resets')->where('token', $request->token)->where('IsExpired',0)->where('email', $request->email)->first();
			$tokenData = DB::table('password_resets')->where('token', $request->token)->where('IsExpired',0)->where('email', $email)->first();
		    //$tokenData = DB::table('password_resets')->where('token', $request->token)->where('IsExpired',0) ->first();
			//$tokenData = DB::table('password_resets')->where('token', $request->token)->first();

			if (!$tokenData)
			{
				return back()->with('message','Your password change link has expired.');
			//return view('auth.email')->with('message','please check your email or try again!!');
			}
			$user = User::where('email', $email)->first();

			if (!$user) return back()->with(['message' => 'Email not found']);
			$user->password = $password;
			$user->save();

			DB::table('password_resets')
              ->where('email', $email)
              ->update(['IsExpired' => 1]);

			return back()->with('message','Your password successfully changed ');




	}



}
