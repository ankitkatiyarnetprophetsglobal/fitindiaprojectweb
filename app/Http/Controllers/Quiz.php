<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request,Response;
use App\Models\Quiztbl;
use App\Models\Quiztblhn;
use App\Models\Quiztblmalyalam;
use App\Models\Quiztbltelugu;
use App\Models\Quiztblkannada;
use App\Models\Quiztblbangla;
use App\Models\Quiztbltamil;
use App\Models\User;
use App\Models\Quizreport;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Quizupload;
use App\Models\State;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportQuizHn;
use App\Imports\ImportQuiz;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Quizwinners;
use Illuminate\Support\Facades\DB;
use PDF;
use Lang;

class Quiz extends Controller
{
    private $OPENSSL_CIPHER_NAME = "aes-128-cbc"; 
    private $CIPHER_KEY_LEN = 16;
	
	use AuthenticatesUsers;

    //protected $redirectTo = '/home';
	
	public function __construct()
    {
       $this->middleware('auth:quiz')->except('quizPartner','quizPartnerLoginForm','quizPartnerLogin','index','indexhn','roadtotokyohn', 'roadtotokyo','roadtotokyowinner', 'roadtotokyowinnerhn','uploadtokyoquiz','tokyoquiz','store', 'storehn', 'quizPartnerregister', 'winnersupdate', 'getquizques' ,'tokyoquizcert');
    }
   function encrypt($key, $iv, $data) {
        if (strlen($key) < $this->CIPHER_KEY_LEN) {
            $key = str_pad("$key", $this->CIPHER_KEY_LEN, "0"); 
        } else if (strlen($key) > $this->CIPHER_KEY_LEN) {
            $key = substr($str, 0, $this->CIPHER_KEY_LEN); 
        }
		
        $encodedEncryptedData = base64_encode(openssl_encrypt($data, $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv));
        
		return $encodedEncryptedData;
    }	
   
    function decrypt($key, $iv, $data) {
        if (strlen($key) < $this->CIPHER_KEY_LEN) {
            $key = str_pad("$key", $this->CIPHER_KEY_LEN, "0"); //0 pad to len 16
        } else if (strlen($key) > $this->CIPHER_KEY_LEN) {
            $key = substr($str, 0, $this->CIPHER_KEY_LEN); //truncate to 16 bytes
        }
       
        $decryptedData = openssl_decrypt( base64_decode($data), $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv);
        return $decryptedData;
    }	
	
	public function tokyoquizcert($name){       
		//return $name;
        //$pdf = PDF::loadView('tokyoquizcertificate',compact('name'))->setPaper('DEFAULT_PDF_PAPER_SIZE', 'landscape');
       // return $pdf->stream("Cert.pdf");
		$pdf = PDF::loadView('tokyoquizcertificate',['name' => $name ])->setPaper('a4', 'landscape');
		$pdf->getDomPDF()->setHttpContext(
			stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
		);
		
        return $pdf->download("certificate.pdf");
		//return view('tokyoquizcertificate',['name' => $name ]); 
    }
	
	public function tokyoquiz(Request $request){
		return view('uploadtokyoquiz'); 
	}
	public function uploadtokyoquiz(Request $request){
		if($request->lang == 'Hindi'){
			Excel::import(new ImportQuizHn(), $request->file('file'));
		}else{
			Excel::import(new ImportQuiz(), $request->file('file'));	
		}		
	}
	
	
	public function logout(Request $request)
    {  	$iv = "fedcba9876543210"; 
		$key = "0a9b8c7d6e5f4g3h"; 
		$currentusr = Auth::guard('quiz')->user();
		$usrid = $currentusr->id; 
		$encrypted = $this->encrypt($key, $iv, $usrid);
		Auth::guard('quiz')->logout(); 
       
		$request->session()->invalidate();
		
		return redirect()->route('roadtotokyo', [$encrypted]);
    }
	
	
	
	
	public function index($id, Request $request){
		echo "<center><h2>Thank you India for your overwhelming response on the road to Tokyo 2020 Quiz! The quiz is closed now. Let's enjoy the Olympic games and #Cheer4India.<h2></center>";
		die;
		$iv = "fedcba9876543210"; 
		$key = "0a9b8c7d6e5f4g3h"; 
		$currentURL = url()->current();
		$urlarr = explode('road-to-tokyo-2020-quiz/', $currentURL);
		$id = $urlarr[1];
		$encrypted = $id;
		
		$id = $this->decrypt($key, $iv, $id);
		$states = State::orderBy('name' , 'ASC')->get();
		$userdata = User::findOrFail($id);
		$quizques = Quiztbl::all()->random(10);
		return view('fi-quiz',compact('quizques', 'userdata', 'states', 'encrypted'));
	}
	
	public function indexhn($id, Request $request){
		echo "<center><h2>Thank you India for your overwhelming response on the road to Tokyo 2020 Quiz! The quiz is closed now. Let's enjoy the Olympic games and #Cheer4India.<h2></center>";
		die;
		$iv = "fedcba9876543210"; 
		$key = "0a9b8c7d6e5f4g3h"; 
		$currentURL = url()->current();
		$urlarr = explode('road-to-tokyo-2020-quiz-hn/', $currentURL);
		$id = $urlarr[1];
		$encrypted = $id;
		
		$id = $this->decrypt($key, $iv, $id);
		$states = State::orderBy('name' , 'ASC')->get();
		$userdata = User::findOrFail($id);
		$quizques = Quiztblhn::all()->random(10);
		return view('fi-quizhn',compact('quizques', 'userdata', 'states', 'encrypted'));
	}
	
	
	public function roadtotokyo($id, Request $request){ 

		/*echo "<center><h2>Thank you India for your overwhelming response on the road to Tokyo 2020 Quiz! The quiz is closed now. Let's enjoy the Olympic games and #Cheer4India.<h2></center>";
		die;*/
		$iv = "fedcba9876543210"; 
		$key = "0a9b8c7d6e5f4g3h"; 
		
		$currentURL = url()->current();
		$urlarr = explode('road-to-tokyo-2020/', $currentURL);
		$id = $urlarr[1];
		
		$encrypted = $id;
		
		$id = $this->decrypt($key, $iv, $id);
		$userdata = User::findOrFail($id);
	
		$quizimgs = Quizupload::where('user_id', $id)->first();
		return view('roadtotokyo',compact('quizimgs', 'userdata', 'encrypted'));
	}
	
	
	public function roadtotokyohn($id, Request $request){
		
		echo "<center><h2>Thank you India for your overwhelming response on the road to Tokyo 2020 Quiz! The quiz is closed now. Let's enjoy the Olympic games and #Cheer4India.<h2></center>";
		die;
		
		$iv = "fedcba9876543210";  
		$key = "0a9b8c7d6e5f4g3h"; 
		
		$currentURL = url()->current();
		$urlarr = explode('road-to-tokyo-2020-hn/', $currentURL);
		$id = $urlarr[1];
		
		$encrypted = $id;
		
		$id = $this->decrypt($key, $iv, $id);
		$userdata = User::findOrFail($id);
	
		$quizimgs = Quizupload::where('user_id', $id)->first();
		return view('roadtotokyohn',compact('quizimgs', 'userdata', 'encrypted'));
	}
	
	
	
	public function roadtotokyowinner($id, Request $request){
		
		$iv = "fedcba9876543210"; 
		$key = "0a9b8c7d6e5f4g3h"; 
		
		$currentURL = url()->current();
		$urlarr = explode('road-to-tokyo-2020-winner/', $currentURL);
		$id = $urlarr[1];
		 
		$encrypted = $id;
		$id = $this->decrypt($key, $iv, $id);
		$userdata = User::findOrFail($id);
		
		$winners = Quizwinners::leftJoin('quiz_report', 'quiz_report.id', '=', 'quizwinners.winner_id')->where('quizwinners.org_id', $id)->orderBy('quizwinners.winnerdate','DESC')->orderBy('quizwinners.id','ASC')->get(['quiz_report.name', 'quiz_report.email', 'quiz_report.mobile', 'quiz_report.state', 'quiz_report.city', 'quizwinners.score', 'quizwinners.sec','quizwinners.winnerdate']);
		//return $winners; 

		$quizimgs = Quizupload::where('user_id', $id)->first();
		
		return view('roadtotokyowinner',compact('quizimgs', 'userdata' , 'encrypted', 'winners'));
	}
	
	public function roadtotokyowinnerhn($id, Request $request){
		
		$iv = "fedcba9876543210"; 
		$key = "0a9b8c7d6e5f4g3h"; 
		
		$currentURL = url()->current();
		$urlarr = explode('road-to-tokyo-2020-winner-hn/', $currentURL);
		$id = $urlarr[1];
		 
		$encrypted = $id;
		$id = $this->decrypt($key, $iv, $id);
		$userdata = User::findOrFail($id);
		
		$winners = Quizwinners::leftJoin('quiz_report', 'quiz_report.id', '=', 'quizwinners.winner_id')->where('quizwinners.org_id', $id)->orderBy('quizwinners.winnerdate','DESC')->orderBy('quizwinners.id','ASC')->get(['quiz_report.name', 'quiz_report.email', 'quiz_report.mobile', 'quiz_report.state', 'quiz_report.city', 'quizwinners.score', 'quizwinners.sec','quizwinners.winnerdate']);
		//return $winners;

		$quizimgs = Quizupload::where('user_id', $id)->first();
		
		return view('roadtotokyowinnerhn',compact('quizimgs', 'userdata' , 'encrypted', 'winners'));
	}
	
	public function quizPartnerUpload(Request $request){
		$currentusr = Auth::guard('quiz')->user();
		$posterupload = array();
		$posterupload = Quizupload::where('user_id',$currentusr->id)->first();
		return view('quiz-partner-uploads' ,compact('posterupload'));
	}
	
	public function quizPartnerUploadstore(Request $request){
		
		$validatedData = $request->validate([
			  'mainimage' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048|dimensions:min_width=610,min_height=370,max_width=630,max_height=385',
			  'luckywinnerimage' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048|dimensions:min_width=610,min_height=370,max_width=630,max_height=385'
			 ],
			 [
			 'mainimage.required' => 'Main Page Banner required',
			 'mainimage.image' => 'Main Page Banner must be an image',
			 'mainimage.dimensions' => 'Main Page Banner has invalid image dimensions',
			 'luckywinnerimage.required' => 'Lucky Winner Page Banner required',
			 'luckywinnerimage.image' => 'Lucky Winner  Page Banner must be an image',
			 'luckywinnerimage.dimensions' => 'Lucky Winner Page Banner has invalid image dimensions',
			 ]
		  );
		  
		$iv = "fedcba9876543210"; 
		$key = "0a9b8c7d6e5f4g3h"; 
			
		$currentusr = Auth::guard('quiz')->user();
		$usrid = $currentusr->id; 
		$encrypted = $this->encrypt($key, $iv, $usrid);
		
		if($request->hasfile('mainimage')){
                $year = date("Y/m");
				$file = $request->file('mainimage');
                $name = $file->getClientOriginalName();
                $name = $file->store($year,['disk'=> 'uploads']);
                $mainimage = url('wp-content/uploads/'.$name);
		}
		
		if($request->hasfile('luckywinnerimage')){
                $year = date("Y/m");
				$file = $request->file('luckywinnerimage');
                $name = $file->getClientOriginalName();
                $name = $file->store($year,['disk'=> 'uploads']);
                $luckywinnerimage = url('wp-content/uploads/'.$name);
		}
		
		$currentusr = Auth::guard('quiz')->user();
		
		$posterupload = Quizupload::where('user_id',$currentusr->id)->first();
		if($posterupload){
			$res = Quizupload::where('user_id',$currentusr->id)->update([
				'mainimage' => $mainimage,
				'luckywinnerimage' => $luckywinnerimage
			]);
			
			
			if($res){
				return redirect()->route('roadtotokyo', [$encrypted]);
				return redirect()->back()->with('success', 'Uploaded successfully');
			}else{
				return redirect()->back()->with('error', 'Not uploaded');
			}
		}else{
			$posterupload = new Quizupload(); 
			$posterupload->mainimage = $mainimage;
			$posterupload->luckywinnerimage = $luckywinnerimage;
			$posterupload->user_id = $currentusr->id;
			$res = $posterupload->save();
			
			if($res){
				return redirect()->route('roadtotokyo', [$encrypted]);
				return redirect()->back()->with('success', 'Uploaded successfully');
			}else{
				return redirect()->back()->with('error', 'Not uploaded');
			}
		}
	}
	
	
	
	
	
	public function store(Request $request){
		
		echo "<center><h2>Thank you India for your overwhelming response on the road to Tokyo 2020 Quiz! The quiz is closed now. Let's enjoy the Olympic games and #Cheer4India.<h2></center>";
		die;
		
		
		$validatedData = $request->validate([
			  'name' => 'required|max:155',
			  'email' => 'required|max:155',
			  'phone' => 'required|digits:10',
			  'state' => 'required|max:255|regex:/^[\w\s?]+$/si',
			  'city' => 'required|max:155',
			  'sec' => 'required',
			  'encrypted' => 'required'
			  ],
			  [
				'state.regex' => 'State must be in English only',
			  ]
		  );
		
		
		$encrypted = $request->encrypted;
		
		$quesids = array(); 
		
		if(!empty($request->quesoption)){
			$quesids = array_keys($request->quesoption);
		}
		
		$quesfilled = $request->quesoption;


		$current_lang = Lang::locale();
		
		if($current_lang == 'en'){
			$results = Quiztbl::whereIn('id', $quesids)->get();
		}elseif($current_lang == 'hn'){
			$results = Quiztblhn::whereIn('id', $quesids)->get();
		}elseif($current_lang == 'ml'){
			$results = Quiztblmalyalam::whereIn('id', $quesids)->get();
		}elseif($current_lang == 'tl'){
			$results = Quiztbltelugu::whereIn('id', $quesids)->get();
		}elseif($current_lang == 'kn'){
			$results = Quiztblkannada::whereIn('id', $quesids)->get();
		}elseif($current_lang == 'bg'){ 
			$results = Quiztblbangla::whereIn('id', $quesids)->get();
		}elseif($current_lang == 'tm'){
			$results = Quiztbltamil::whereIn('id',$quesids)->get();
		}

			
		$score = 0;
		foreach($results as $result){
			if($quesfilled[$result->id] == $result->ans){ 
				$score += 1;
			}
		}
		 
		$schoolid = $request->schoolid;
        date_default_timezone_set("Asia/Kolkata");
		$curdate = date('Y-m-d H:i:s');
		
		$curdateonly = date('Y-m-d');
		
		$chkreq = Quizreport::where('mobile', $request->phone)->where('createdOnDate', $curdateonly)->first();
		$name = $request->name;
		if(!$chkreq){	
			$quizrepo = new Quizreport(); 
			
			$quizrepo->name = $request->name;
			$quizrepo->mobile = $request->phone;
			$quizrepo->email = $request->email;
			$quizrepo->mobile = $request->phone;
			$quizrepo->state = $request->state;
			$quizrepo->city = $request->city;
			$quizrepo->lang = $current_lang;
			$quizrepo->quesoption = serialize($request->quesoption);
			$quizrepo->score = $score;
			$quizrepo->sec = $request->sec;
			$quizrepo->school_id = $schoolid;
			$quizrepo->createdOn = $curdate;
			$quizrepo->createdOnDate = $curdateonly;
			
			$res = $quizrepo->save();
			return view( 'quiz-result',compact('results', 'quesfilled', 'encrypted', 'name') );
			
		}else{
			return redirect()->back()->with('error', 'You have been applied for the quiz for today');
			
		}
			
			
		
	}
	
	public function storehn(Request $request){
		echo "<center><h2>Thank you India for your overwhelming response on the road to Tokyo 2020 Quiz! The quiz is closed now. Let's enjoy the Olympic games and #Cheer4India.<h2></center>";
		die;
		$validatedData = $request->validate([
			  'name' => 'required|max:155',
			  'email' => 'required|max:155',
			  'phone' => 'required|digits:10',
			  'state' => 'required|max:255|regex:/^[\w\s?]+$/si',
			  'city' => 'required|max:155',
			  'sec' => 'required',
			  ],
			  [
			  'name.required' => 'नाम की आवश्यकता है',
			  'email.required' => 'ईमेल की आवश्यकता है',
			  'phone.required' => 'मोबाइल की आवश्यकता है',
			  'phone.digits' => 'मोबाइल फोन 10 अंक होना चाहिए',
			  'state.required' => 'राज्य की आवश्यकता है',
			  'state.required' => 'शहर की आवश्यकता है',
			  'state.regex' => 'राज्य केवल अंग्रेजी में होना चाहिए'
			  
			  ]
		  );
		  
		
		$encrypted = $request->encrypted;
		
		$quesids = array(); 
		
		if(!empty($request->quesoption)){
			$quesids = array_keys($request->quesoption);
		}
		
		
		$quesfilled = $request->quesoption;
		$results = Quiztblhn::whereIn('id', $quesids)->get();
		 
		$score = 0;
		foreach($results as $result){
			if($quesfilled[$result->id] == $result->ans){ 
				$score += 1;
			}
		}
		 
		$schoolid = $request->schoolid;
        date_default_timezone_set("Asia/Kolkata");
		$curdate = date('Y-m-d H:i:s');
		
		$curdateonly = date('Y-m-d');
		
		$chkreq = Quizreport::where('mobile', $request->phone)->where('createdOnDate', $curdateonly)->first();
		$name = $request->name;
		if(!$chkreq){	
			$quizrepo = new Quizreport(); 
			
			$quizrepo->name = $request->name;
			$quizrepo->mobile = $request->phone;
			$quizrepo->email = $request->email;
			$quizrepo->mobile = $request->phone;
			$quizrepo->state = $request->state;
			$quizrepo->city = $request->city;
			$quizrepo->lang = 'hn';
			$quizrepo->quesoption = serialize($request->quesoption);
			$quizrepo->score = $score;
			$quizrepo->sec = $request->sec;
			$quizrepo->school_id = $schoolid;
			$quizrepo->createdOn = $curdate;
			$quizrepo->createdOnDate = $curdateonly;
			
			$res = $quizrepo->save();
			return view('quiz-resulthn',compact('results', 'quesfilled','encrypted', 'name' ));
		}else{
			return redirect()->back()->with('error', 'You have been applied for the quiz for today');
			
		}	
		
	}
	
	public function quizPartner(Request $request){
		return view('quiz-partner');
	}	

	public function quizPartnerregister(Request $request){	
	
		/*$validatedData = $request->validate([
          'name' => 'required',
          'email' => 'required|unique:users|max:255',
          'phone' => 'required|unique:users|digits:10',
		  'role' => 'required',
		  'password'=> 'required|confirmed|min:6'		 
        ]);*/
		
		$request->validate([
			'name' => 'required',  
			'email' => 'required|email|unique:users|max:255',
			'phone' => 'required|unique:users|digits:10',
			'role' => 'required',
			'password'=> 'required|confirmed|min:6',		    
	      ],[
			'name.required' => 'Organisation Name Field Is Required.',
			'email.required' => 'Email Field Is Required.',
			'email.unique' => 'Email Already Exist.',
			'phone.required' => 'Mobile Number Field is Required.',
			'phone.unique' => 'Mobile Number Already Exist.',            
			'phone.digits' => 'Mobile Number Must be 10 Digits.',
			'role.required' => 'Role Field Is Required.',            
			'password.required' => 'Password Field Is Required.',
			'password.confirmed' => 'Password Must Be Equal to Confirm Password.',
			'password.min' => 'Password Must Be Equal to 6 character.',				
	    ]);	
		
		$rolearr = Role::find($request->role);		
		$usr = new User(); 
        $usr->name = $request->name;
        $usr->email = $request->email;
        $usr->phone = $request->phone;
        $usr->role_id = $request->role;
		$usr->role = $rolearr->slug;
		$usr->rolelabel = $rolearr->name;
		$usr->password = Hash::make($request->password);		
		$userres = $usr->save();
		
		if($userres){			
			$credentials = array(  'email' => $request->email, 'password' => $request->password);
			if (Auth::guard('quiz')->attempt($credentials)) {
				$request->session()->regenerate();
				return redirect()->route('quiz-partner-dashboard');
			}
		}
		
        return redirect('quiz-partner-dashboard');
	}	
	
	public function quizPartnerDashboard(Request $request){
		$iv = "fedcba9876543210"; 
		$key = "0a9b8c7d6e5f4g3h"; 
			
		$currentusr = Auth::guard('quiz')->user();
		$usrid = $currentusr->id; 
		$encrypted = $this->encrypt($key, $iv, $usrid);
		$quizimgs = Quizupload::where('user_id', $currentusr->id)->first();
		$partarrs = Quizreport::select(DB::raw('count(*) as cnt'), 'createdOnDate as date')->where('school_id', $usrid)->groupBy('createdOnDate')->get();
		$winners = Quizwinners::leftJoin('quiz_report', 'quiz_report.id', '=', 'quizwinners.winner_id')->where('quizwinners.org_id', $usrid)->orderBy('quizwinners.winnerdate','DESC')->orderBy('quizwinners.id','ASC')->get(['quiz_report.name', 'quiz_report.email', 'quiz_report.mobile', 'quiz_report.state', 'quiz_report.city', 'quizwinners.score', 'quizwinners.sec','quizwinners.winnerdate']);
		//return $winners;
		
		return view('quiz-partner-dashboard', compact('currentusr','encrypted','quizimgs', 'partarrs','winners' ));
	}
	
	public function quizPartnerLoginForm(Request $request){
		return view('quiz-partner-login');
	}
	
	public function quizPartnerLogin(Request $request){
		/* $validatedData = $request->validate([
          'email' => 'required|max:255',
          'password'=> 'required|min:6'
		]); */
		
		$request->validate([			
			'email' => 'required|max:255',
			'password'=> 'required|min:6',	    
	      ],[			
			'email.required' => 'Email Field Is Required.',				   
			'password.required' => 'Password Field Is Required.',			
			'password.min' => 'Password Must Be Equal to 6 character.',				
	    ]);	
		
		$credentials = array('email'=>$request->email,'password'=>$request->password);
		
		if(Auth::guard('quiz')->attempt($credentials)) {
			$request->session()->regenerate();
			return redirect()->route('quiz-partner-dashboard'); 
		}else{
			return redirect()->back()->with('error', 'Invalid Credentials');
		}			
	}	
	
	public function winnersupdate(Request $request){
		
		$ydate = date("Y-m-d", strtotime( '-1 days' ) );
		
		//$ydate = date("Y-m-d");
		//$res = $this->send( 'consultsandeepsingh@gmail.com', 'Sandeep Singh'); var_dump($res); exit();
		echo "<pre>";
		
		$orgids = Quizreport::where('createdOnDate', $ydate)->distinct()->get(['school_id']);
		
		if($orgids){
			foreach($orgids as $orgid ){
				
				$partarrs = Quizreport::where('createdOnDate', $ydate)->where('school_id', $orgid->school_id);
				$cnt = $partarrs->count();
				
				echo "====Count : ".$cnt."<br>";
				
				switch ($cnt) {
					
					case ($cnt > 10000):
						$partarrs = $partarrs->limit(10)->orderBy('score','DESC')->orderBy('sec','DESC')->get();
						break;
						
					case ($cnt > 9000  && $cnt <= 10000):
						$partarrs = $partarrs->limit(9)->orderBy('score','DESC')->orderBy('sec','DESC')->get();
						break;
						
					case ($cnt > 8000  && $cnt <= 9000):
						$partarrs = $partarrs->limit(8)->orderBy('score','DESC')->orderBy('sec','DESC')->get();
						break;
						
					case ($cnt > 7000  && $cnt <= 8000):
						$partarrs = $partarrs->limit(7)->orderBy('score','DESC')->orderBy('sec','DESC')->get();
						break;
						
					case ($cnt > 6000  && $cnt <= 7000):
						$partarrs = $partarrs->limit(6)->orderBy('score','DESC')->orderBy('sec','DESC')->get();
						break;
					
					case ($cnt > 5000  && $cnt <= 6000):
						$partarrs = $partarrs->limit(5)->orderBy('score','DESC')->orderBy('sec','DESC')->get();
						break;
						
					case ($cnt > 4000 && $cnt <= 5000):
						$partarrs = $partarrs->limit(4)->orderBy('score','DESC')->orderBy('sec','DESC')->get();
						break;
						
					case ($cnt > 3000 && $cnt <= 4000):
						$partarrs = $partarrs->limit(3)->orderBy('score','DESC')->orderBy('sec','DESC')->get();
						break;
					
					case ($cnt > 2000 && $cnt <= 3000):
						$partarrs = $partarrs->limit(2)->orderBy('score','DESC')->orderBy('sec','DESC')->get();
						break;
				  
					default:
						echo "<br>Only one winner<br>";
						$partarrs = $partarrs->limit(1)->orderBy('score','DESC')->orderBy('sec','DESC')->get();
						
				}
				
				
				foreach($partarrs as $partarr){
					$secvar = 0;
					
					if($partarr->sec){
						$secvar = (120 - $partarr->sec);
					}else if(is_null($partarr->sec)){
						$secvar = NULL;
					}else if($partarr->sec === 0){
						$secvar = 120;
					}else{
						$secvar = NULL;
					}
					
					
					$winners = new Quizwinners();
					$winners->winner_id = $partarr->id;
					$winners->org_id = $orgid->school_id;
					$winners->score =  $partarr->score;
					$winners->sec = $secvar;
					$winners->winnerdate = $ydate; 
					$winners->save();
					
					echo $partarr->id." Name : ".$partarr->name;
					echo " Score : " . $partarr->score;
					echo " Seconds : " . $secvar;
					echo " Org ID : " . $orgid->school_id;
					echo " Score : " . $partarr->score;
					echo " Winner Date  : " . $partarr->winnerdate;
					echo $partarr->email.$partarr->name;
					
					echo " ---------------- <br>";
					
					
					$this->send( $partarr->email, $partarr->name);
				}					
				
				echo " <br><br><br><br>============== <br>";
				
			}
		}	
	}	
	
	public function getquizques( Request $request){
		
		if($request->lang == 'hn'){  
			$quizques = Quiztblhn::all()->random(10);
			return $quizques;
		}elseif($request->lang == 'en'){ 
			$quizques = Quiztbl::all()->random(10);
			return $quizques;
		}elseif($request->lang == 'ml'){  
			$quizques = Quiztblmalyalam::all()->random(10);
			return $quizques;
		}elseif($request->lang == 'tl'){ 
			$quizques = Quiztbltelugu::all()->random(10);
			return $quizques;
		}elseif($request->lang == 'kn'){ 
			$quizques = Quiztblkannada::all()->random(10);
			return $quizques;
		}elseif($request->lang == 'bg'){ 
			$quizques = Quiztblbangla::all()->random(10);
			return $quizques;
		}elseif($request->lang == 'tm'){
			$quizques = Quiztbltamil::all()->random(10);
			return $quizques;
		}else{
			
		}		
	}	
	
	public function send($email,$name){				
	  $msg = '<!DOCTYPE HTML><html> <head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> <title>Road to Tokyo 2020 Quiz Winner</title> 
		<style>.yada{color:green;}</style> </head> <body>
		<p>Dear Candidate,</p> <br>  <p>Congratulations '.$name.' for winning the Road to Tokyo 2020 Quiz.</p>
		<p>It gives us immense pleasure to declare you as lucky winner for yesterdays Quiz played by you.</p>
		<p>Soon you would be receiving an email for your postal address and Tshirt Size.</p>
		<p>Regards</p>
		<p>Team Olympics</p></body></html>';
			
		$curlparams = array(
							'user_email' =>$email,
							'message' => $msg,
							'subject' => 'Road to Tokyo 2020 Quiz Winner',						
							'html'=>$msg
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
		   
    }
	
}
