<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siteoption;
use App\Models\Event;
use App\Models\EventCat;
use App\Models\Feedback;
use App\Models\State;
use App\Models\Shareyourstory;
use App\Models\Registrationemailotp;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Schoolquiz;
use PDF;
use DateTime;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use App\Models\Role;
use App\Models\District;
use App\Models\Block;
use App\Models\WebsiteBanner;
use App\Models\EventArchive;
use App\Models\Storeeventuserimage;

class GeneralController extends Controller
{

	private $OPENSSL_CIPHER_NAME = "aes-128-cbc"; //Name of OpenSSL Cipher
    private $CIPHER_KEY_LEN = 16; //128 bits

	// function encrypt($key, $iv, $data) {
	// 	$CIPHER_KEY_LEN = 16; // Define the constant for key length
	// 	// $CIPHER_NAME = 'AES/ECB/PKCS5Padding'; // Define the cipher name
	// 	$CIPHER_NAME = 'aes-128-cbc'; // Define the cipher name

	// 	try {
	// 		if (strlen($key) < $CIPHER_KEY_LEN) {
	// 			$numPad = $CIPHER_KEY_LEN - strlen($key);
	// 			for ($i = 0; $i < $numPad; $i++) {
	// 				$key .= "0"; // 0 pad to len 16 bytes
	// 			}
	// 		} else if (strlen($key) > $CIPHER_KEY_LEN) {
	// 			$key = substr($key, 0, $CIPHER_KEY_LEN); // truncate to 16 bytes
	// 		}

	// 		$initVector = $iv; // In PHP, we don't need to create an IvParameterSpec
	// 		$skeySpec = $key; // In PHP, we use the key directly

	// 		// Create the cipher
	// 		// $cipher = openssl_encrypt($data, 'AES-128-ECB', $skeySpec, OPENSSL_RAW_DATA);
	// 		$cipher = openssl_encrypt($data, 'aes-128-cbc', $skeySpec, OPENSSL_RAW_DATA);

	// 		$base64_EncryptedData = base64_encode($cipher);
	// 		$base64_IV = base64_encode($iv); // This line is not used in the return

	// 		return $base64_EncryptedData;

	// 	} catch (Exception $ex) {

	// 		error_log($ex->getMessage());
	// 	}
	// 	return null;
	// }


	// function encrypt($key, $iv, $data) {
    //     if (strlen($key) < $this->CIPHER_KEY_LEN) {
    //         $key = str_pad("$key", $this->CIPHER_KEY_LEN, "0"); //0 pad to len 16
    //     } else if (strlen($key) > $this->CIPHER_KEY_LEN) {
    //         $key = substr($str, 0, $this->CIPHER_KEY_LEN); //truncate to 16 bytes
    //     }

    //     $encodedEncryptedData = base64_encode(openssl_encrypt($data, $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv));
    //     $encodedIV = base64_encode($iv);
    //     $encryptedPayload = $encodedEncryptedData.":".$encodedIV;

    //     return $encryptedPayload;

    // }

    // function decrypt($key, $iv, $data) {
    //     if (strlen($key) < $this->CIPHER_KEY_LEN) {
    //         $key = str_pad("$key", $this->CIPHER_KEY_LEN, "0"); //0 pad to len 16
    //     } else if (strlen($key) > $this->CIPHER_KEY_LEN) {
    //         $key = substr($str, 0, $this->CIPHER_KEY_LEN); //truncate to 16 bytes
    //     }

    //     // $parts = explode(':', $data);
    //     //$decryptedData = openssl_decrypt(base64_decode($parts[0]), $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, base64_decode($parts[1]));

    //     $decryptedData = openssl_decrypt( base64_decode($data), $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv);
    //     return $decryptedData;
    // }
	// old this is working code
	function encrypt($key, $iv, $data) {

        if (strlen($key) < $this->CIPHER_KEY_LEN) {

            $key = str_pad("$key", $this->CIPHER_KEY_LEN, "0"); //0 pad to len 16

        } else if (strlen($key) > $this->CIPHER_KEY_LEN) {

            $key = substr($str, 0, $this->CIPHER_KEY_LEN); //truncate to 16 bytes

        }

        $encodedEncryptedData = base64_encode(openssl_encrypt($data, $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv));
        $encodedIV = base64_encode($iv);
        // $encryptedPayload = $encodedEncryptedData.":".$encodedIV;
        $encryptedPayload = $encodedEncryptedData;

        return $encryptedPayload;

    }

	function decrypt($key, $iv, $data) {

        if (strlen($key) < $this->CIPHER_KEY_LEN) {

            $key = str_pad("$key", $this->CIPHER_KEY_LEN, "0"); //0 pad to len 16

        } else if (strlen($key) > $this->CIPHER_KEY_LEN) {

            $key = substr($str, 0, $this->CIPHER_KEY_LEN); //truncate to 16 bytes

        }

        // $parts = explode(':', $data);
        //$decryptedData = openssl_decrypt(base64_decode($parts[0]), $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, base64_decode($parts[1]));

        $decryptedData = openssl_decrypt(base64_decode($data), $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv);
        return $decryptedData;
    }

	// End old working code







	public function fitindschoolweek2020(){

    	return view('fit-india-school-week');
    }

	static public function sitecounter(){
		// dd(123456);
		try {

			$vistor = Siteoption::where('key','visitors')->first();
			$vistor->increment('value');
			return $vistor->value;

		}catch (Exception $e) {

			return abort(404);
		}
	}

	static public function updatedon(){
		try{
			$updatedon = Siteoption::where('key','siteupdateOn')->first();
			// dd($updatedon);
			return $updatedon->value;
		}catch (Exception $e) {
			return abort(404);
		}

	}

	public function getallEvents(Request $request)
	{
		try{
			$categories = EventCat::all();
			if($request->input('search') == 'search')
			{

				$events =  DB::table('events')
					->leftJoin('users', 'users.id', '=', 'events.user_id')
					->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')
					->leftJoin('event_cats', 'event_cats.id', '=', 'events.category')
					->orderBy('events.eventimage1','desc')
					->select(['events.id','event_cats.name  as catname','events.eventimage1','events.eventimage2','events.name as eventname','events.eventstartdate','users.name'])

					->where('events.category',$request->category)
					->whereNotNull('events.eventimage1');
					$count = $events->count();
					$events = $events->paginate(40);
			}
			else{
			$events =  DB::table('events')
					->Join('users', 'users.id', '=', 'events.user_id')

					->Join('event_cats', 'event_cats.id', '=', 'events.category')
					->orderBy('events.eventimage1','desc')
					->select(['events.id','event_cats.name  as catname','events.eventimage1','events.eventimage2','events.name as eventname','events.eventstartdate','users.name'])

					->whereNotNull('events.eventimage1');

			$count = $events->count();
			$events = $events->paginate(40);
			}
			return view('all-events',compact('events','categories','count'));
		}catch (Exception $e) {
			return abort(404);
		}
	}

	public function showEvent($id)
	{
		// dd($id);
		try{
			$events =  DB::table('events')
					->Join('users', 'users.id', '=', 'events.user_id')
					->Join('event_cats', 'event_cats.id', '=', 'events.category')
					->select(['event_cats.name  as catname','events.eventstartdate', 'events.eventenddate', 'events.eventimage1','events.name as eventname','users.name'])
					->where('events.id',$id)
					->first();
			// $events =  DB::table('events')->where('events.id',$id)->first();
			if($events != null){
				// dd($events);
				return view('show-events-list',compact('events'));
			}else{
				$data = "Event has been expired";
				return view('data-not-found',compact('data'));
			}

		}catch (Exception $e) {
			return abort(404);
		}
	}

	public function showVideo(Request $request)
	{
		try{
			$categories = EventCat::all();
			if($request->input('search') == 'search')
			{

				$events =  DB::table('events')
					->leftJoin('users', 'users.id', '=', 'events.user_id')
					->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')
					->leftJoin('event_cats', 'event_cats.id', '=', 'events.category')
					->orderBy('events.video','desc')
					->select(['events.id','event_cats.name  as catname','events.name as eventname','events.video','users.name','usermetas.city','usermetas.state'])

					->where('events.category', $request->category)
					->whereNotNull('events.video')->paginate(40);

			}
			else{

			$events =  DB::table('events')
					->leftJoin('users', 'users.id', '=', 'events.user_id')
					->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')
					->leftJoin('event_cats', 'event_cats.id', '=', 'events.category')
					->orderBy('events.video','desc')
					->select(['events.id','event_cats.name  as catname','events.name as eventname','events.video','users.name','usermetas.city','usermetas.state'])

					->whereNotNull('events.video')
					->paginate(40);


			}
			return view('video-stream',compact('events','categories'));
		}catch (Exception $e) {
			return abort(404);
		}
	}

	public function getallPhotos(Request $request)
	{
		try{

			$categories = EventCat::all();
			if($request->input('search') == 'search')
			{

				$events =  DB::table('events')
					->leftJoin('users', 'users.id', '=', 'events.user_id')
					->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')
					->leftJoin('event_cats', 'event_cats.id', '=', 'events.category')
					->select(['events.id','event_cats.name  as catname','events.name as eventname','users.name','usermetas.city','usermetas.state','events.eventimage1','events.eventimage2'])
					->orderBy('events.eventimage1','desc')
					->where('events.category',$request->category)
					->whereNotNull('events.eventimage1')->paginate(40);

			}
			else{

			$events =  DB::table('events')
					->leftJoin('users', 'users.id', '=', 'events.user_id')
					->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')
					->leftJoin('event_cats', 'event_cats.id', '=', 'events.category')
					->select(['events.id','event_cats.name  as catname','events.name as eventname','users.name','usermetas.city','usermetas.state','events.eventimage1','events.eventimage2'])
					->orderBy('events.eventimage1','desc')
					->whereNotNull('events.eventimage1')
					->paginate(40);


			}
			return view('photo-stream',compact('events','categories'));

		}catch (Exception $e) {
			return abort(404);
		}

	}

	public function feedback()
	{
		try{
			return view('feedback');
		}catch (Exception $e) {
			return abort(404);
		}
	}

	public function feedbackStore(Request $request)
	{
		try{
			$request->validate([
			'department' => 'required',
			'name' => 'required',
			'email' =>'required',
			'mobile' => 'required|digits:10',
			'feedback' => 'required',
			]);
			$feedback = new Feedback();
			$feedback->department = $request->department;
			$feedback->name = $request->name;
			$feedback->email = $request->email;
			$feedback->mobile = $request->mobile;
			$feedback->feedback = $request->feedback;
			$feedback->save();

			try {
					$email = 'contact.fitindia@gmail.com';
					//$email = 'partnership.fitindia@gmail.com';
					$message = "Dear Fit India Team,";
					$message.= "<br><br>";

					$message .= "Below are request for Fit India FEEDBACK";
					$message.= "<br><br>";
					$message.= $request->department."<br>";
					$message.=  $request->name."<br>";
					$message.=  $request->email."<br>";
					$message.=  $request->mobile."<br>";
					$message.=  $request->feedback."<br>";


						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL,"http://10.247.140.87/mail.php");
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS,"user_email=$email&message=$message&subject='Fit India FEEDBACK Request'");
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$server_output = curl_exec($ch);
						curl_close ($ch);


				}
				catch (Exception $e) {
					return $e->message();
				}


			return back()->with('message','Thank you!!! for your response');

		}catch (Exception $e) {
			return abort(404);
		}

	}

	public function shareStory(Request $request)
	{
		try{
			$states = State::all();
            return view('your-story',compact('states'));
		}catch (Exception $e) {
			return abort(404);
		}
	}



    public function saveStory(Request $request)
	{
		try{

            $request->validate([
				//'youare' => 'required|string|min:3|max:255',
				'mobile' => 'required|digits:10',
				'designation' => 'required|string|min:3|max:255',
				'email' => 'required|string|email|max:255',
				'fullname' => 'required|string|min:3|max:255',
				'videourl' => 'required',
				'state' => 'required',
				'title' => 'required|string|min:3|max:255',
			//  'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
				'story' => 'required|string|min:3|max:255',
				'captcha' => ['required', 'captcha'],
			]);

			$yourstory = new Shareyourstory;
			//$yourstory->youare = $request->youare;
			$yourstory->mobile = $request->mobile;
			$yourstory->designation = $request->designation;
			$yourstory->email = $request->email;
			$yourstory->fullname = $request->fullname;
			$yourstory->videourl = $request->videourl;
			$yourstory->title = $request->title;
		    // $yourstory->image =  $image;
			$yourstory->story = $request->story;
			$yourstory->state = $request->state;
			$yourstory->save();

            $email = 'fitnessstories123@gmail.com';
            // $email = 'ankit.katiyar@netprophetsglobal.com';
            //$email = 'dasshaktiraj@gmail.com';
            $message = "Dear Fit India Team,";
            $message.= "<br><br>";

            $message .= "Below are request for Fit India SHARE YOUR STORY";
            $message.= "<br><br>";
            $message.=  "Name : ".$request->fullname."<br>";
            //$message.= $request->youare."<br>";
            $message.=  "Designation : ".$request->designation."<br>";
            $message.=  "Email id : ".$request->email."<br>";
            $message.=  "Contact No : ".$request->mobile."<br>";
            $message.= "State : ".$request->state."<br>";
            $message.=  "URL : ".$request->videourl."<br>";

            $message.= "Story title : ".$request->title."<br>";
            $message.= "Your Story : ".$request->story."<br>";


            $fullname = $request->fullname;
            $designation = $request->designation;
            // $email = $request->email;
            $mobile = $request->mobile;
            $state = $request->state;
            $videourl= $request->videourl;
            $title = $request->title;
            $story = $request->story;
            // dd("http://10.246.120.18/test/mail/useremailsend.php?email=$email&fullname=$fullname&designation=$designation&mobile=$mobile&state=$state&videourl=$videourl&title=$title&story=$story");
                // $curl = curl_init();
                // curl_setopt_array($curl, array(
                //     CURLOPT_URL => "http://10.246.120.18/test/mail/useremailsend.php?email=$email&fullname=$fullname&designation=$designation&mobile=$mobile&state=$state&videourl=$videourl&title=$title&story=$story",
                //     CURLOPT_RETURNTRANSFER => true,
                //     CURLOPT_ENCODING => '',
                //     CURLOPT_MAXREDIRS => 10,
                //     CURLOPT_TIMEOUT => 0,
                //     CURLOPT_FOLLOWLOCATION => true,
                //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                //     CURLOPT_CUSTOMREQUEST => 'GET',
                // ));

                // // dd("$curl");
                // $response = curl_exec($curl);
                // dd($response);
                // curl_close($curl);
                $ch = curl_init();
                // curl_setopt($ch, CURLOPT_URL,"http://10.247.140.87/mail.php");
                curl_setopt($ch, CURLOPT_URL,"https://fitindia.gov.in/mail.php");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,"user_email=$email&message=$message&subject='Fit India SHARE YOUR STORY Request'");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close ($ch);


				return back()->with('message',"Your story has been successfully submitted, Fit India Team will review it, if approved, the story will be displayed on the Fit India Portal/Social Media handles.");

		}catch (Exception $e) {
            return $e->message();
			return abort(404);
		}
	}
	public function saveStory_copy(Request $request)
	{
		try{
			$image = '';
			$year = date("Y/m");
			/*
			if($request->file('image'))
			{
				$image = $request->file('image')->store($year,['disk'=> 'uploads']);
				$image = url('wp-content/uploads/'.$image);
			}
			*/
			$request->validate([
				//'youare' => 'required|string|min:3|max:255',
				'mobile' => 'required|digits:10',
				'designation' => 'required|string|min:3|max:255',
				'email' => 'required|string|email|max:255',
				'fullname' => 'required|string|min:3|max:255',
				'videourl' => 'required',
				'state' => 'required',
				'title' => 'required|string|min:3|max:255',
			//  'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
				'story' => 'required|string|min:3|max:255',
				'captcha' => ['required', 'captcha'],
			]);

			$yourstory = new Shareyourstory;
			//$yourstory->youare = $request->youare;
			$yourstory->mobile = $request->mobile;
			$yourstory->designation = $request->designation;
			$yourstory->email = $request->email;
			$yourstory->fullname = $request->fullname;
			$yourstory->videourl = $request->videourl;
			$yourstory->title = $request->title;
		// $yourstory->image =  $image;
			$yourstory->story = $request->story;
			$yourstory->state = $request->state;
			$yourstory->save();

				try {
					// $email = 'fitnessstories123@gmail.com';
					$email = 'ankit.katiyar@netprophetsglobal.com';
					//$email = 'dasshaktiraj@gmail.com';
					$message = "Dear Fit India Team,";
					$message.= "<br><br>";

					$message .= "Below are request for Fit India SHARE YOUR STORY";
					$message.= "<br><br>";
					$message.=  "Name : ".$request->fullname."<br>";
					//$message.= $request->youare."<br>";
					$message.=  "Designation : ".$request->designation."<br>";
					$message.=  "Email id : ".$request->email."<br>";
					$message.=  "Contact No : ".$request->mobile."<br>";
					$message.= "State : ".$request->state."<br>";
					$message.=  "URL : ".$request->videourl."<br>";

					$message.= "Story title : ".$request->title."<br>";
					$message.= "Your Story : ".$request->story."<br>";


                    $fullname = $request->fullname;
					$designation = $request->designation;
					// $email = $request->email;
					$mobile = $request->mobile;
					$state = $request->state;
					$videourl= $request->videourl;
					$title = $request->title;
					$story = $request->story;
					// dd("http://10.246.120.18/test/mail/useremailsend.php?email=$email&fullname=$fullname&designation=$designation&mobile=$mobile&state=$state&videourl=$videourl&title=$title&story=$story");
						$curl = curl_init();
						curl_setopt_array($curl, array(
							CURLOPT_URL => "http://10.246.120.18/test/mail/useremailsend.php?email=$email&fullname=$fullname&designation=$designation&mobile=$mobile&state=$state&videourl=$videourl&title=$title&story=$story",
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => '',
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 0,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => 'GET',
						));

						// dd("$curl");
						$response = curl_exec($curl);
						// dd($response);
						curl_close($curl);
						// $ch = curl_init();
						// curl_setopt($ch, CURLOPT_URL,"http://10.247.140.87/mail.php");
						// curl_setopt($ch, CURLOPT_POST, 1);
						// curl_setopt($ch, CURLOPT_POSTFIELDS,"user_email=$email&message=$message&subject='Fit India SHARE YOUR STORY Request'");
						// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						// $server_output = curl_exec($ch);
						// curl_close ($ch);


				}
					catch (Exception $e) {
					return $e->message();
				}


			return back()->with('message',"Your story has been successfully submitted, Fit India Team will review it, if approved, the story will be displayed on the Fit India Portal/Social Media handles.");
		}catch (Exception $e) {
			return abort(404);
		}
	}


	public function schoolQuiz(Request $request)
	{
		try{
			return view('school-quiz');
		}catch (Exception $e) {
			return abort(404);
		}

	}


	public function saveQuiz(Request $request)
	{
		try{
			echo '<pre>';
			$cnt = $request->noofstud;


			for($i=0; $i<$cnt; $i++){

				$image = '';
				$year = date("Y/m");


				if(!empty($request->file('image')[$i]))
				{
					$image = $request->file('image')[$i]->store( $year,['disk'=> 'uploads']);
					$image = url('wp-content/uploads/'.$image);
				}



				$schoolquiz[] = [


				'studentname' => $request->studentname[$i],
				'mobile' => $request->mobile[$i],
				'class' => $request->class[$i],
				'age' => $request->age[$i],
				'email' => $request->email[$i],
				'image' => $image,
				'gender' => $request->gender[$i][0],


				];


			}
			Schoolquiz::insert($schoolquiz);
			return back()->with('message','Student details submitted Successfully');

		}catch (Exception $e) {
			return abort(404);
		}
	}

	public function downloadSchoolBanner(){
		try{
			$banner_type = $_REQUEST['banner_type'];
			if($banner_type=='week_1'){
				$school_name = $_REQUEST['school_name'];
				$pdf = PDF::loadView('school-week-banner',['school_name' => $school_name])->setPaper('a4', 'landscape');
			}elseif($banner_type=='week_2'){
				$school_name = $_REQUEST['school_name'];
				$pdf = PDF::loadView('school-week-banner_second',['school_name' => $school_name])->setPaper('a4', 'landscape');
			}else{
				$school_name = $_REQUEST['school_name'];
				$pdf = PDF::loadView('school-week-banner_third',['school_name' => $school_name])->setPaper('a4', 'landscape');
			}

			return $pdf->stream($school_name.".pdf");
		}catch (Exception $e) {
			return abort(404);
		}
	}

	public function fitindschoolweek2022(){
		try{
    		return view('fitIndiaSchoolWeek2022.fit-india-school-week');
		}catch (Exception $e) {
			return abort(404);
		}
    }

	// public function duplicate_email_check($emailid){
	public function duplicate_email_check(Request $request){

		try{


            $role_name = $request['role_name'];
			$currentdatetime = time();
			$iv = "fedcba9876543210"; #Same as in JAVA
			$key = "0a9b8c7d6e5f4g3h"; #Same as in JAVA

			$reqtimeencrypt = $this->encrypt($key, $iv, $currentdatetime);
			$reqtimeencrypt_trim = trim($reqtimeencrypt);

			$key = $currentdatetime.'fitind';
			$phone = "";
			$emailid = $request->email;
			// dd($emailid);
			$emailencrypt_trim = $this->encrypt($key, $iv, $emailid);
			$phoneencrypt_trim = $this->encrypt($key, $iv, $phone);

			$records = DB::table('users')
							->where('email', $emailid)
							->get();

			if(count($records) == 0 || $role_name == "bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi" || $role_name == "bmFtby1maXQtaW5kaWEteW91dGgtY2x1Yg==" || $role_name == "Y3ljbG90aG9uLTIwMjQ="){

				$success = 'No duplicate';


                // $response = Http::post('http://localhost/fit_india_api_git/api/v2/generateotpvtwo', [
				$response = Http::post('https://service.fitindia.gov.in/api/v2/generateotpvtwo', [

						'reqtime' => $reqtimeencrypt_trim,
						'email' => $emailencrypt_trim,
						'mobile' => $phoneencrypt_trim,

				]);
				// dd($response->collect());
				$Registrationemail = new Registrationemailotp;
				$Registrationemail->mode = "email";
				$Registrationemail->email = $emailid;
				$Registrationemail->verify_otp = 1;
				$Registrationemail->save();
				return response()->json(['success' => true]);

			}else if(count($records)> 0){

				$error = 'Duplicate Email';
				return response()->json(['success' => false, 'error' => $error]);

			}

		}catch (Exception $e) {
			return response()->json(['error' => $e->getMessage()]);
			// return abort(404);
		}
	}


	public function duplicate_mobile_check(Request $request){

		try{

			// dd($request->all());
			$currentdatetime = time();
			$iv = "fedcba9876543210"; #Same as in JAVA
			$key = "0a9b8c7d6e5f4g3h"; #Same as in JAVA

			$reqtimeencrypt = $this->encrypt($key, $iv, $currentdatetime);
			$reqtimeencrypt_trim = trim($reqtimeencrypt);

			$key = $currentdatetime.'fitind';
			$emailid = "";
			$phone = trim($request->phone_number);
			$emailencrypt_trim = $this->encrypt($key, $iv, $emailid);
			$phoneencrypt_trim = $this->encrypt($key, $iv, $phone);
			$email_value = $request->email_value;
            // dd($phoneencrypt_trim);
			// dd($phone);
            // $role_value = $request['role_value'];
            $role_value = $request['role_name'];
            // dd($role_value);
            // if(isset($phone)){
            // if(isset($role_value) && isset($email_value) && isset($phone)){
            if(isset($role_value) && isset($phone)){
                // dd("Done 12");
                // if($role_name =="bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi"){
                    $records = DB::table('users')
                            ->Join('usermetas', 'users.id', '=', 'usermetas.user_id')
                            ->where('users.role','=',$role_value)
                            ->where('phone','=',$phone)
                            // ->where('email','=',$email_value)
							->get();
                    
                // }

                if(count($records) == 0){
					// dd(12345647897);
                    $success = 'No duplicate';
                    $apiurl = config('app.api_url').'generateotpvtwo';
                    // $response = Http::post($apiurl, [
                    // $response = Http::post('http://localhost/fit_india_api_git/api/v2/generateotpvtwo', [
                    $response = Http::post('https://service.fitindia.gov.in/api/v2/generateotpvtwo', [

                            'reqtime' => $reqtimeencrypt_trim,
                            'email' => $emailencrypt_trim,
                            'mobile' => $phoneencrypt_trim,

                    ]);
                    // dd($response->collect());
                    $Registrationemail = new Registrationemailotp;
                    $Registrationemail->mode = "mobile";
                    $Registrationemail->mobile = $phone;
                    $Registrationemail->verify_otp = 1;
                    $Registrationemail->save();
                    return response()->json(['success' => true]);
                    // return response()->json(['success' => $response]);

                }
				dd("safdasdfsadf");
                if(count($records)> 0){

                    $error = 'Duplicate Phone and email';
                    return response()->json(['success' => false, 'error' => $error]);

                }
            }

			// dd("Done");

			// $records = DB::table('users')
			// 				->where('phone', $phone)
			// 				->get();
			// if(count($records) == 0){

			// 	$success = 'No duplicate';
			// 	$apiurl = config('app.api_url').'generateotpvtwo';
			// 	// $response = Http::post('http://localhost/fit_india_api_git/api/v2/generateotpvtwo', [
			// 	$response = Http::post('https://service.fitindia.gov.in/api/v2/generateotpvtwo', [

			// 			'reqtime' => $reqtimeencrypt_trim,
			// 			'email' => $emailencrypt_trim,
			// 			'mobile' => $phoneencrypt_trim,

			// 	]);
			// 	// dd($response->collect());
			// 	$Registrationemail = new Registrationemailotp;
			// 	$Registrationemail->mode = "mobile";
			// 	$Registrationemail->mobile = $phone;
			// 	$Registrationemail->verify_otp = 1;
			// 	$Registrationemail->save();
			// 	return response()->json(['success' => true]);

			// }else if(count($records)> 0){

			// 	$error = 'Duplicate Phone';
			// 	return response()->json(['success' => false, 'error' => $error]);

			// }

		}catch (Exception $e) {

			return response()->json(['error' => $e->getMessage()]);

		}
	}

	public function email_otp_check(Request $request){

		try{

			$currentdatetime = time();
			$iv = "fedcba9876543210"; #Same as in JAVA
			$key = "0a9b8c7d6e5f4g3h"; #Same as in JAVA

			$reqtimeencrypt = $this->encrypt($key, $iv, $currentdatetime);
			$reqtimeencrypt_trim = trim($reqtimeencrypt);
			$otp_v = trim($request->otp_value);
			$otp_valuecrypt_trim = $this->encrypt($key, $iv, $otp_v);

			$key = $currentdatetime.'fitind';
			$email_trim = trim($request->email);
			$emailencrypt_trim = $this->encrypt($key, $iv, $email_trim);

			$apiurl = config('app.api_url').'verifyingemail';
			// $response = Http::post($apiurl, [
			// $response = Http::post('http://localhost/fit_india_api_git/api/v2/verifyingemail', [
			$response = Http::post('https://service.fitindia.gov.in/api/v2/verifyingemail', [

						'reqtime' => $reqtimeencrypt_trim,
						'email' => $emailencrypt_trim,
						'otp' => $otp_valuecrypt_trim,
				]);

			// dd($response->collect());
			// dd($response['success']);
			if($response['success'] == true){

				$records = DB::table('registration_email_otp_trackings')
							->where('email', $email_trim)
							->orderBy('id', 'desc')
							->first();
				Registrationemailotp::query()->where(['id' => $records->id])
						->take(1)->update(['verified_otp' => 1]);

				$message = $response['message'];
                $curenttime = time();
                $encrypted = $this->cryptoJsAesEncrypt("passphrasepass", "true:truewrtsuss:$curenttime");
				return response()->json(['success' => $encrypted, 'message' => $message]);

			}else{
				    $curenttime = time();
                    $encrypted = $this->cryptoJsAesEncrypt("passphrasepass", "false:falsefalrog:$curenttime");
                    return response()->json(['success' => $encrypted]);

            }

		}catch (Exception $e) {

			return response()->json(['error' => $e->getMessage()]);

		}
	}

    /**
    * Decrypt data from a CryptoJS json encoding string
    */
    function cryptoJsAesDecrypt($passphrase, $jsonString){
        $jsondata = json_decode($jsonString, true);
        $salt = hex2bin($jsondata["s"]);
        $ct = base64_decode($jsondata["ct"]);
        $iv  = hex2bin($jsondata["iv"]);
        $concatedPassphrase = $passphrase.$salt;
        $md5 = array();
        $md5[0] = md5($concatedPassphrase, true);
        $result = $md5[0];
        for ($i = 1; $i < 3; $i++) {
            $md5[$i] = md5($md5[$i - 1].$concatedPassphrase, true);
            $result .= $md5[$i];
        }
        $key = substr($result, 0, 32);
        $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
        return json_decode($data, true);
    }
    /**
    * Encrypt value to a cryptojs compatiable json encoding string
    */
    function cryptoJsAesEncrypt($passphrase, $value){
        $salt = openssl_random_pseudo_bytes(8);
        $salted = '';
        $dx = '';
        while (strlen($salted) < 48) {
            $dx = md5($dx.$passphrase.$salt, true);
            $salted .= $dx;
        }
        $key = substr($salted, 0, 32);
        $iv  = substr($salted, 32,16);
        $encrypted_data = openssl_encrypt(json_encode($value), 'aes-256-cbc', $key, true, $iv);
        $data = array("ct" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "s" => bin2hex($salt));
        return json_encode($data);
    }

	public function mobile_otp_check(Request $request){

		try{
			// dd($request->all());
			$currentdatetime = time();
			$iv = "fedcba9876543210"; #Same as in JAVA
			$key = "0a9b8c7d6e5f4g3h"; #Same as in JAVA

			$reqtimeencrypt = $this->encrypt($key, $iv, $currentdatetime);
			$reqtimeencrypt_trim = trim($reqtimeencrypt);
			$otp_v = trim($request->otp_value);
			$otp_valuecrypt_trim = $this->encrypt($key, $iv, $otp_v);

			$key = $currentdatetime.'fitind';
			$email_trim = trim($request->mobile);
			$emailencrypt_trim = $this->encrypt($key, $iv, $email_trim);
			$apiurl = config('app.api_url').'verifyingemail';
			// $response = Http::post($apiurl, [
			// $response = Http::post('http://localhost/fit_india_api_git/api/v2/verifyingemail', [
			$response = Http::post('https://service.fitindia.gov.in/api/v2/verifyingemail', [

						'reqtime' => $reqtimeencrypt_trim,
						'email' => $emailencrypt_trim,
						'otp' => $otp_valuecrypt_trim,
				]);

			// dd($response->collect());

			if($response['success'] == true){

				$records = DB::table('registration_email_otp_trackings')
							->where('mobile', $email_trim)
							->orderBy('id', 'desc')
							->first();
				Registrationemailotp::query()->where(['id' => $records->id])
						->take(1)->update(['verified_otp' => 1]);
                $message = $response['message'];
                $curenttime = time();
                $encrypted = $this->cryptoJsAesEncrypt("passphrasepass", "true:truewrtsuss:$curenttime");
                return response()->json(['success' => $encrypted, 'message' => $message]);
				// $message = $response['message'];
				// return response()->json(['success' => true, 'message' => $message]);

			}else{
                // dd("123456");
                $curenttime = time();
                $encrypted = $this->cryptoJsAesEncrypt("passphrasepass", "false:falsefalrog:$curenttime");
                // dd($encrypted);
                return response()->json(['success' => $encrypted]);
                // return response()->json(['success' => false]);

            }

		}catch (Exception $e) {

			return response()->json(['error' => $e->getMessage()]);

		}
	}

	// registercopy
	public function registercopy(Request $request){
		try{
			// dd('registercopy');
			$roles = Role::where('groupof', 1)
					->whereNotIn('slug', ['champion', 'smambassador', 'sai_user', 'author', 'gmambassador', 'caadmin', 'gram_panchayat', 'lbambassador','ghd','stateadmin'])->orderBy('name', 'ASC')->get();
				$districts = District::whereStatus(true)->orderBy('name', 'ASC')->get();

				$blocks = Block::whereStatus(true)->orderBy('name', 'ASC')->get();
				// dd($blocks->toArray());
				$state = State::whereStatus(true)->orderBy('name', 'ASC')->get();

				return view('auth.registercopy', compact('roles', 'state', 'districts', 'blocks'));
		}catch (Exception $e) {

			return response()->json(['error' => $e->getMessage()]);

		}
	}

	public function useremailw(Request $request){
		try{
			// dd('useremailw');
			$email = 'ankit.katiyar@netprophetsglobal.com';
			$name = 'Ankit Katiyar';
			return $this->sendMail($email,$name);

		}catch (Exception $e) {

			return response()->json(['error' => $e->getMessage()]);

		}
	}

	public function sendMail($email,$otp){


        $curl = curl_init();
		curl_setopt_array($curl, array(
            CURLOPT_URL => "http://10.246.120.18/test/mail/useremailsend.php?email=$email&name=$otp",
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
		$new_response = json_decode($response, true);
		if($response){
            return true;
		}else{
            return false;
		}

	}

    public function fit_india_cycling_drive(){

        $websitebanner = WebsiteBanner::where("id","=","15")->where('status',1)->orderBy('order', 'ASC')->first();
        if(!empty($websitebanner)){

            $websitebanner = $websitebanner['banner_url'];

        }else{

            $websitebanner = "https://fitindia.gov.in/resources/imgs/soc-11052025.png";
        }
        return view('cyclothon2024',compact('websitebanner'));
        // dd($websitebanner);
    }

    public function fit_india_cycling_drive_update_banner(){

        // dd('fit_india_cycling_drive_update_banner');

        $websitebanner = WebsiteBanner::where("id","=","14")->where('status',1)->orderBy('order', 'ASC')->first();
        // dd($eventarchive);
        if(!empty($websitebanner)){
            WebsiteBanner::query()->where(['id' => 14])->take(1)->update(['banner_url' => "https://fitindia.gov.in/resources/imgs/soc-11052025.png"]);
        }else{
            $websitebanner = "https://fitindia.gov.in/resources/imgs/soc-11052025.png";
        }
        // return view('cyclothon2024',compact('websitebanner'));
        // dd($websitebanner);
    }

    public function fit_india_cycling_drive_app_update_banner(){

        $eventarchive = EventArchive::where("id","=",47)->where('status','=',"active")->first();

        if(!empty($eventarchive)){
            EventArchive::query()->where(['id' => 47])->where('status','=',"active")->update(['poster_image' => "https://fitindia.gov.in/resources/imgs/soc-11052025.png"]);
        }else{
            $websitebanner = "https://fitindia.gov.in/resources/imgs/soc-11052025.png";
        }
        // return view('cyclothon2024',compact('websitebanner'));
        // dd($websitebanner);
    }

	public function nsd_upload_image(Request $request)
	{
		try{
			$states = State::all();
            $roles = Role::where('groupof', 0)
			// ->where('slug','=','namo-fit-india-youth-club')
			->whereNotIn('slug', ['champion', 'smambassador', 'sai_user', 'author', 'gmambassador', 'caadmin', 'gram_panchayat', 'lbambassador','ghd','stateadmin'])->orderBy('name', 'ASC')->get();
            $districts = District::whereStatus(true)->orderBy('name', 'ASC')->get();
            // dd($roles);
            return view('nsd-upload-image',compact('states','roles','districts'));
		}catch (Exception $e) {
			return abort(404);
		}
	}

    public function save_upload_image(Request $request)
	{
		try{

            // $request->validate([
			// 	// 'youare' => 'required|string|min:3|max:255',
			// 	'roletype' => 'required|string|min:3|max:255',
			// 	'role' => 'required|string|min:3|max:255',
			// 	'fullname' => 'required|string|min:3|max:255',
			// 	'mobile' => 'required|digits:10',
			// 	'designation' => 'required|string|min:3|max:255',
			// 	'email' => 'required|string|email|max:255',
			// 	// 'videourl' => 'required',
			// 	'state' => 'required',
			// 	// 'title' => 'required|string|min:3|max:255',
			//     'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
			// 	// 'story' => 'required|string|min:3|max:255',
			// 	'captcha' => ['required', 'captcha'],
			// ]);

            $request->validate([
                    'roletype' => 'required',
                    'role' => 'required|string',
                    'fullname' => 'required|string|min:3|max:100|regex:/^[a-zA-Z\s\.\'-]+$/',
                    'mobile' => 'required|digits:10|regex:/^[6-9]\d{9}$/',
                    'designation' => 'required|string|min:3|max:150|regex:/^[a-zA-Z\s]+$/',
                    'email' => 'required|string|email|max:255',
                    'state' => 'required|string|min:2|max:50',
                    'district' => 'required|string|min:2|max:50',
                    'image' => [
                        'required',
                        'mimes:jpg,jpeg,png,mp4,avi,mov,mkv,wmv', // ✅ images & videos allowed
                        'max:51200' // 50MB limit
                    ],
                    'captcha' => ['required', 'captcha'],
                ], [
                    'roletype.required' => 'Role type can not be blank.',
                    'role.required' => 'Role can not be blank.',
                    'fullname.regex' => 'Name should contain only letters, spaces, or . - \' characters.',
                    'mobile.regex' => 'Please enter a valid Indian mobile number.',
                    'image.mimes' => 'Only JPG, PNG images or MP4, AVI, MOV, MKV, WMV videos are allowed.',
                    'file.max' => 'File size must not exceed 50MB.',
                    'email.unique' => 'This email is already registered.',
                    'captcha.captcha' => 'Invalid captcha, please try again.'
                ]);

            // dd($request->all());
            $year = date("Y/m");
            if($request->file('image'))
                {
                    $image = $request->file('image')->store('nsdusers2025',['disk'=> 'uploads']);
                    $image = url('wp-content/uploads/'.$image);
                }

			$yourstory = new Storeeventuserimage;
			//$yourstory->youare = $request->youare;
			$yourstory->role = $request->role;
			$yourstory->fullname = $request->fullname;
			$yourstory->mobile = $request->mobile;
			$yourstory->state = $request->state;
			$yourstory->district = $request->district;
			$yourstory->designation = $request->designation;
			$yourstory->email = $request->email;
			$yourstory->image = $image;
			$yourstory->status = 1;
			$yourstory->save();

            // $email = 'fitnessstories123@gmail.com';
            // // $email = 'ankit.katiyar@netprophetsglobal.com';
            // //$email = 'dasshaktiraj@gmail.com';
            // $message = "Dear Fit India Team,";
            // $message.= "<br><br>";

            // $message .= "Below are request for Fit India SHARE YOUR STORY";
            // $message.= "<br><br>";
            // $message.=  "Name : ".$request->fullname."<br>";
            // //$message.= $request->youare."<br>";
            // $message.=  "Designation : ".$request->designation."<br>";
            // $message.=  "Email id : ".$request->email."<br>";
            // $message.=  "Contact No : ".$request->mobile."<br>";
            // $message.= "State : ".$request->state."<br>";
            // $message.=  "URL : ".$request->videourl."<br>";

            // $message.= "Story title : ".$request->title."<br>";
            // $message.= "Your Story : ".$request->story."<br>";


            // $fullname = $request->fullname;
            // $designation = $request->designation;
            // // $email = $request->email;
            // $mobile = $request->mobile;
            // $state = $request->state;
            // $videourl= $request->videourl;
            // $title = $request->title;
            // $story = $request->story;
            // dd("http://10.246.120.18/test/mail/useremailsend.php?email=$email&fullname=$fullname&designation=$designation&mobile=$mobile&state=$state&videourl=$videourl&title=$title&story=$story");
                // $curl = curl_init();
                // curl_setopt_array($curl, array(
                //     CURLOPT_URL => "http://10.246.120.18/test/mail/useremailsend.php?email=$email&fullname=$fullname&designation=$designation&mobile=$mobile&state=$state&videourl=$videourl&title=$title&story=$story",
                //     CURLOPT_RETURNTRANSFER => true,
                //     CURLOPT_ENCODING => '',
                //     CURLOPT_MAXREDIRS => 10,
                //     CURLOPT_TIMEOUT => 0,
                //     CURLOPT_FOLLOWLOCATION => true,
                //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                //     CURLOPT_CUSTOMREQUEST => 'GET',
                // ));

                // // dd("$curl");
                // $response = curl_exec($curl);
                // dd($response);
                // curl_close($curl);
                // $ch = curl_init();
                // // curl_setopt($ch, CURLOPT_URL,"http://10.247.140.87/mail.php");
                // curl_setopt($ch, CURLOPT_URL,"https://fitindia.gov.in/mail.php");
                // curl_setopt($ch, CURLOPT_POST, 1);
                // curl_setopt($ch, CURLOPT_POSTFIELDS,"user_email=$email&message=$message&subject='Fit India SHARE YOUR STORY Request'");
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                // $server_output = curl_exec($ch);
                // curl_close ($ch);


				return back()->with('message',"Your photo has been successfully submitted, Fit India Team will review it, if approved, the photo will be displayed on the Fit India national sports day 2025.");

		}catch (Exception $e) {
            return $e->message();
			return abort(404);
		}
	}

	public function nsd_show_static_page(Request $request){
		try{

            $user_data_count = User::join('usermetas', 'users.id', '=', 'usermetas.user_id')
                    ->select(
                        'users.id',
                        'users.name',
                        'users.email',
                        'users.phone',
                        'users.rolelabel',
                        'users.rolewise',
                        'usermetas.state',
                        'usermetas.district',
                        'usermetas.block',
                        'usermetas.city'
                    )
                    ->where('users.rolewise', 'national-sports-day-2025')
                    ->count();
            return view('nationalsportsday2025',compact('user_data_count'));

		}catch (Exception $e) {

			return abort(404);

		}
	}



}
