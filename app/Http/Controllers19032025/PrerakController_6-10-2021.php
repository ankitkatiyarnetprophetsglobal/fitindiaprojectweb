<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use App\Models\Prerak;
use App\Models\FitnessEnthusias;
use App\Models\Prerakfirstlevel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Models\Usermeta;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PrerakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        if(isset(Auth::user()->role)){
        $role = Auth::user()->role;
        $email = Auth::user()->email;
        $states = State::all();
        $id = Auth::user()->id;
       
        $userInfo = DB::table('users')
            ->join('usermetas', 'users.id', '=', 'usermetas.user_id')
            ->select('users.*', 'usermetas.*')
            ->where('users.id',$id)
            ->first();

            $role = Role::where('slug', $role)->first()->name;
            $prerak_data = Prerak::where('email',$email)->first();
            $fitevent_data = FitnessEnthusias::where('email',$email)->first();
            if(!empty($prerak_data) OR !empty($fitevent_data)){
                return view('star.application_status',['prerak_data' => $prerak_data,'fitevent_data'=>$fitevent_data, 'role' => $role ]);
            }else{
                return view('star.prerak', ['role' => $role , 'states'=>$states,'user_info'=>$userInfo]);
            }
        }else{
            return redirect('/home');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){ 
        $image = '';
        $id_proof_document = '';
        $role_slug = 'prerak';
        $year = date("Y/m");
        /*$request->validate([
            'name' => 'required|string|regex:/(^[a-zA-Z ]+$)+/',
            'email' => 'required|email|string|max:255',
            'contact' => 'required|numeric|digits:10',
            'designation' => 'required|string|regex:/(^[a-zA-Z ]+$)+/',
            'state_name' => 'required|string',
            'district_name' =>'required|string',
            'block_name' => 'required|string',            
            'image' => 'required|image|mimes:jpg,png,gif,svg|max:1024',
            'social_media_url' => 'required',
            'social_media_handle' => 'required',
            'facebook_profile' => 'required',
            'facebook_profile_followers' => 'required|numeric|digits_between:2,7',
            'twitter_profile' => 'required',
            'twitter_profile_followers' => 'required|numeric|digits_between:2,7',
            'instagram_profile' => 'required',
            'instagram_profile_followers' => 'required|numeric|digits_between:2,7',
            'id_proof' => 'required',
            'unique_app_id' => 'required',
            'work_profession' => 'required',
            'description' => 'required',
            'physical_activity' => 'required',
            'fitness_event' => 'required',
            'declaration' => 'required'
        ]);*/

        if($request->file('image'))
        {
            $image = $request->file('image')->store($year,['disk'=>'uploads']);
            $image = url('wp-content/uploads/'.$image);
        }
        if($request->file('id_proof'))
        {
            $id_proof_document = $request->file('id_proof')->store($year,['disk'=>'uploads']);
            $id_proof_document = url('wp-content/uploads/'.$id_proof_document);
        }
        $imgurl = array();
        if($request->hasfile('eventphoto')) {
            foreach($request->file('eventphoto') as $file)
                {
                    $name = $file->getClientOriginalName();
                    $name = $file->store($year,['disk'=> 'uploads']);
                    $name = url('wp-content/uploads/'.$name);
                    $imgurl[] = $name;
                }
            }

        $state = State::where('name', $request->state_name)->first();
        $district = District::where('name', $request->district_name)->first();
        $block = Block::where('name', $request->block_name)->first();

        $user = User::where('email', '=', $request->email)->first();
        $get_role = Role::where('slug', '=', $role_slug)->first();


        $follower_sum = $request->facebook_profile_followers+$request->twitter_profile_followers+$request->instagram_profile_followers;
        $parent_id = '0';
        $refer_code = $request->refer_code;
        if(!empty($request->refer_code)){
            if($request->action_name=='Fitness_Event'){
                $prerakresult = FitnessEnthusias::where('genrated_refer_code',$request->refer_code)->first(); 
            }else{
                $prerakresult = Prerak::where('genrated_refer_code',$request->refer_code)->first(); 
            }
            if(!empty($prerakresult)){
                $parent_id = $prerakresult->id;
                $refer_code = $prerakresult->genrated_refer_code;
            }else{
                return back()->with('failed','Refer code does not exists')->withInput();
            }
        }
        
                /*$sign_up_role='';
                $sign_up_roleid='';
                if($follower_sum < 1000){
                    $sign_up_role = 'prerak';
                    $sign_up_roleid = '4';
                }elseif($follower_sum >=1000 && $follower_sum < 10000){
                    $sign_up_role = 'prerak';
                    $sign_up_roleid = '3';
                }elseif($follower_sum >=10000 && $follower_sum < 100000){
                    $sign_up_role = 'ambassador';
                    $sign_up_roleid = '2';
                }else{
                    $sign_up_role = 'champion';
                    $sign_up_roleid = '1';
                }*/
                $max_partcipant = max($request->noofparticipant);
                if($request->action_name=='Fitness_Event'){ 
                    $prerak = FitnessEnthusias::create([
                        'parent_id' => @$parent_id,
                        'refer_code' => $refer_code,
                        'user_id' => @$user->id,
                        'name' => @$request->name,
                        'email' => @$request->email,
                        'contact' => @$request->contact,
                        'designation' => @$request->designation,
                        'state_name' => @$request->state_name,
                        'state_id' => @$state->id,
                        'district_name' => @$request->district_name,
                        'district_id' => @$district->id,
                        'block_name' => @$request->block_name,
                        'block_id' => @$block->id,
                        'image' => @$image,
                        /*'social_media_url' => @$request->social_media_url,*/
                        'facebook_profile' => @$request->facebook_profile,
                        'facebook_profile_followers' => $request->facebook_profile_followers?$request->facebook_profile_followers:0,
                        'twitter_profile' => @$request->twitter_profile,
                        'twitter_profile_followers' => $request->twitter_profile_followers?$request->twitter_profile_followers:0,
                        'instagram_profile' => @$request->instagram_profile,
                        'instagram_profile_followers' => $request->instagram_profile_followers?$request->instagram_profile_followers:0,
                        'sum_follower' => $follower_sum,
                        'work_profession' => @$request->work_profession,
                        'description' => @$request->description, 
                       /* 'user_checker' => '1',*/
                        'id_proof' => @$id_proof_document,
                        'app_id' => $request->unique_app_id,
                        //'register_as' => $sign_up_role,
                        'register_as' => @$request->influencer_type,
                        /*'register_as_id' => $sign_up_roleid,*/
                        'event_year' => serialize($request->eventyear),
                        'event_name' => serialize($request->eventname),
                        'event_partcipant_number' => serialize($request->noofparticipant),
                        'event_file' => serialize($imgurl),
                        'max_partcipant' => @$max_partcipant
                    ]);
                }else{ 
                    $prerak = Prerak::create([
                    'parent_id' => @$parent_id,
                    'refer_code' => $refer_code,
                    'user_id' => @$user->id,
                    'name' => @$request->name,
                    'email' => @$request->email,
                    'contact' => @$request->contact,
                    'designation' => @$request->designation,
                    'state_name' => @$request->state_name,
                    'state_id' => @$state->id,
                    'district_name' => @$request->district_name,
                    'district_id' => @$district->id,
                    'block_name' => @$request->block_name,
                    'block_id' => @$block->id,
                    'image' => @$image,
                    'social_media_url' => @$request->social_media_url,
                    'facebook_profile' => @$request->facebook_profile,
                    'facebook_profile_followers' => $request->facebook_profile_followers?$request->facebook_profile_followers:0,
                    'twitter_profile' => @$request->twitter_profile,
                    'twitter_profile_followers' => $request->twitter_profile_followers?$request->twitter_profile_followers:0,
                    'instagram_profile' => @$request->instagram_profile,
                    'instagram_profile_followers' => $request->instagram_profile_followers?$request->instagram_profile_followers:0,
                    'sum_follower' => $follower_sum,
                    'work_profession' => @$request->work_profession,
                    'description' => @$request->description, 
                   /* 'user_checker' => '1',*/
                    'id_proof' => @$id_proof_document,
                    'app_id' => $request->unique_app_id,
                    //'register_as' => $sign_up_role,
                    'register_as' => @$request->influencer_type,
                   // 'register_as_id' => $sign_up_roleid
                ]);
        }
        if($prerak){
            return back()->with('success','Request to become a Fit India '.ucwords($request->influencer_type).' has been submitted successfully. Please wait until your application is verified.');
        }else{
            return back()->with('failed','Something Wrong')->withInput();
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function checkFitnessTest(Request $request){

       
        $response = array();
       // $p_string = json_encode($request->all());
        //$p_string = "{'apitoken': 'A2P0R1', 'data': '[{fitindiaid: 2021065}]'}";
//$p_string = '{"apitoken":"A2P0R1","data":"[{fitindiaid:2021065}]"}';
  //$p_string = '{"login":"my_login","password":"my_password"}';
        //echo "==========".$p_string; die;
    /*    $p_string = '{"apitoken":"A2P0R1","data": "[{\"fitindiaid\": \"2021065\"}]"}';    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://int.fitindia.gov.in/fitindiaservice.svc/dashboard");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$p_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'
                //'Connection: Keep-Alive'
        ));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
    
        $server_output = curl_exec($ch);
        curl_close ($ch);
        echo $server_output;*/


//echo "================"; die;





/*$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://fitness.fitindia.gov.in/FitIndiaAuthentication.aspx?data=ZVpvb3NCTVRRNE1UZzBNUT09cWFENEpu&target=en',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: ASP.NET_SessionId=5450o0ogtvubndjjwy1lz4vy; AlteonP=AUCADHujSAokVcZeHtk2dg$$; lanculture=en'
  ),
));

$response = curl_exec($curl);
header('Content-Type: image/jpeg');
    header("Access-Control-Allow-Origin: *");

//close connection 
    curl_close($ch);
    flush();
//curl_close($curl);
echo $response;*/



 //  $json = "{'apitoken': 'A2P0R1', 'data': '[{fitindiaid: 2021065}]'}";
/*$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://service.fitindia.gov.in/api/mobile/apitest',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;*/

/*$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://fitness.fitindia.gov.in/FitIndiaAuthentication.aspx?data=ZVpvb3NCTVRRNE1UZzBNUT09cWFENEpu&target=en',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: ASP.NET_SessionId=afmew2d23pakgybn3xtldvv4; AlteonP=AMNgRXujSAq7K/9+pX1xSw$$; lanculture=en'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;*/

/*$curl = curl_init();

curl_setopt_array($curl, array(
  //CURLOPT_URL => 'https://int.fitindia.gov.in/fitindiaservice.svc/dashboard',
   CURLOPT_URL => 'http://103.65.20.140:83/fitindiaservice.svc/dashboard',
   URLOPT_SSL_VERIFYPEER => FALSE,
   CURLOPT_SSL_VERIFYHOST => FALSE,
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => '',
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => 'POST',
   CURLOPT_POSTFIELDS =>'{
    "apitoken": "A2P0R1",
    "data": "[{\"fitindiaid\": \"2021065\"}]"
  }',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Cookie: AlteonP=AESKRXujSArD9yQNZGEuKw$$'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;*/
/*echo "===ibkube"; die;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://int.fitindia.gov.in/fitindiaservice.svc/dashboard');
curl_setopt($ch, CURLOPT_FAILONERROR, true); // Required for HTTP error codes to be reported via our call to curl_error($ch)
curl_exec($ch);
echo "======================"; die;
if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
}
curl_close($ch);
if (isset($error_msg)) {
    echo $error_msg;
    // TODO - Handle cURL error accordingly
}*/
  $p_string = '{"apitoken":"A2P0R1","data": "[{\"fitindiaid\": \"2021065\"}]"}';    
/*  $curl_handle=curl_init();
  curl_setopt($curl_handle,CURLOPT_URL,'https://int.fitindia.gov.in/fitindiaservice.svc/dashboard');
  curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
  curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($curl_handle, CURLOPT_POSTFIELDS,$p_string);
  curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Connection: Keep-Alive'
  ));
  $buffer = curl_exec($curl_handle);
  curl_close($curl_handle);
  if (empty($buffer)){
      print "Nothing returned from url.<p>";
  }
  else{
      print $buffer;
  }*/

$url = 'http://103.65.20.140:83/fitindiaservice.svc/dashboard';
$proxy = '164.100.195.9';
/*$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_PROXY, $proxy); // $proxy is ip of proxy server
curl_setopt($ch, CURLOPT_POSTFIELDS,$p_string);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$httpCode = curl_getinfo($ch , CURLINFO_HTTP_CODE); // this results 0 every time
$response = curl_exec($ch);

if ($response === false) 
    $response = curl_error($ch);

echo stripslashes($response);

curl_close($ch);*/
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_PROXY, $proxy); // $proxy is ip of proxy server
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$httpCode = curl_getinfo($ch , CURLINFO_HTTP_CODE); // this results 0 every time
$response = curl_exec($ch);

if ($response === false) 
    $response = curl_error($ch);

echo stripslashes($response);

curl_close($ch);
        die;
    }
    public function check_refer_code(Request $request){
        $response = array();
        $refercode = $request->refer_code;
        $sum_flr = $request->sum_followers;
        $inf_type = $request->inftype;
        //if($sum_flr < 1000){
        if($inf_type=='Fitness_Event'){
            $refer_code_data = FitnessEnthusias::where('genrated_refer_code','=',$refercode)->first();
        }else{
            $refer_code_data = Prerak::where('genrated_refer_code','=',$refercode)->first();
        }
        if(!empty($refer_code_data)){
            $response = array('status'=>1,'msg'=>'Refrence Code Mantch');
        }else{
            $response = array('status'=>0,'msg'=>'Refrence Code unmatch');
        }
        echo json_encode($response);
        die;
    }
    public function myFiteventCertificate(Request $request){       
        $email = Auth::user()->email;
        $cham_name = FitnessEnthusias::where('email',$email)->where('status','1')->first()->name;
        $cert_end_date = date('d/m/Y', strtotime('-1 day',strtotime("+12 Months")));
        $pdf = PDF::loadView('star/fitevent-certificate',['name' => ucwords($cham_name), 'cert_end_date'=>$cert_end_date])->setPaper('DEFAULT_PDF_PAPER_SIZE', 'landscape');
        
		$pdf->getDomPDF()->setHttpContext(
			stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
		);
		
		return $pdf->stream($cham_name.".pdf");
    }
	
    public function myFitAmbassadorCertificate(Request $request){       
        $email = Auth::user()->email;
        $cham_name = FitnessEnthusias::where('email',$email)->where('status','1')->first()->name;
        $cert_end_date = date('d/m/Y', strtotime('-1 day',strtotime("+12 Months")));
        
		$pdf = PDF::loadView('star/ambassador-certificate',['name' => ucwords($cham_name), 'cert_end_date'=>$cert_end_date])->setPaper('DEFAULT_PDF_PAPER_SIZE', 'landscape');
        
		$pdf->getDomPDF()->setHttpContext(
			stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
		);
		
		return $pdf->stream($cham_name.".pdf");
    }
	
    public function myFitChampionCertificate(Request $request){       
        $email = Auth::user()->email;
        $cham_name = FitnessEnthusias::where('email',$email)->where('status','1')->first()->name;
        $cert_end_date = date('d/m/Y', strtotime('-1 day',strtotime("+12 Months")));
        $pdf = PDF::loadView('star/champion-certificate',['name' => ucwords($cham_name), 'cert_end_date'=>$cert_end_date])->setPaper('DEFAULT_PDF_PAPER_SIZE', 'landscape');
        $pdf->getDomPDF()->setHttpContext(
			stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
		);
		
		return $pdf->stream($cham_name.".pdf");
    }
    public function myPrerakCertificate(Request $request){       
        $email = Auth::user()->email;
        $cham_name = Prerak::where('email',$email)->where('status','1')->first()->name;
        $cert_end_date = date('d/m/Y', strtotime('-1 day',strtotime("+12 Months")));
        $pdf = PDF::loadView('star/prerak-certificate',['name' => ucwords($cham_name), 'cert_end_date'=>$cert_end_date])->setPaper('DEFAULT_PDF_PAPER_SIZE', 'landscape');
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
        );
        return $pdf->stream($cham_name.".pdf");
    }
    public function myAmbassadorCertificate(Request $request){       
        $email = Auth::user()->email;
        $cham_name = Prerak::where('email',$email)->where('status','1')->first()->name;
        $cert_end_date = date('d/m/Y', strtotime('-1 day',strtotime("+12 Months")));
        $pdf = PDF::loadView('star/ambassador-certificate',['name' => ucwords($cham_name), 'cert_end_date'=>$cert_end_date])->setPaper('DEFAULT_PDF_PAPER_SIZE', 'landscape');
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
        );
        return $pdf->stream($cham_name.".pdf");
    }
    public function myChampionCertificate(Request $request){       
        $email = Auth::user()->email;
        $cham_name = Prerak::where('email',$email)->where('status','1')->first()->name;
        $cert_end_date = date('d/m/Y', strtotime('-1 day',strtotime("+12 Months")));
        $pdf = PDF::loadView('star/champion-certificate',['name' => ucwords($cham_name), 'cert_end_date'=>$cert_end_date])->setPaper('DEFAULT_PDF_PAPER_SIZE', 'landscape');
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
        );
        return $pdf->stream($cham_name.".pdf");
    }	
	
    public function updatePrerakNewEvent(Request $request){		
		/* $rules = [
			'eventname'=>'required|array|min:1',
			'eventname.*'  => 'required|min:2|regex:/(^[A-Za-z ]+$)+/',        
			'noofparticipant' => 'required',
			'noofparticipant.*' => 'required|numeric',
			'eventphoto_old' => 'required|array',
			'eventphoto_old.*' => 'required|mimes:jpg,jpeg,png,bmp,pdf|max:2000'				  
        ];

       $messages = [
        'eventname.required' => 'Name of the event is required',
        'eventname.*.required' => 'Name of the event is required',
		'eventname.*.regex' => 'Name of the event letters only',		
        'noofparticipant.required' => 'No. of participant is required',
		'noofparticipant.min' => 'No. of participant must be at least 1',		
		'eventphoto_old.required' => 'Please upload all eventphoto images',
        'eventphoto_old.*.required' => ' Please upload eventphoto image',
        'eventphoto_old.*.mimes' => 'Only jpeg, png, jpg and bmp images are allowed',
        'eventphoto_old.*.max' => 'Sorry! Maximum allowed size for an image is 2MB',	
       ];  */	
		
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
    
       
        $prerak = FitnessEnthusias::where("id", $request->prk_id)->update([
            'up_eventname' => serialize($request->eventname),
            'up_partcipant_num' => serialize($request->noofparticipant),
            'up_eventfile' => serialize($event_array)
        ]);
        if($prerak){
            return back()->with('success','Event Detail successfully updated.');
        }else{
            return back()->with('failed','Something Wrong')->withInput();
        }
    }
	
    public function prerakApplyAgain($type,$id){
        if(!empty($id)){
            if($type=='social_media'){
                $del = Prerak::destroy($id);
            }else{
                $del = FitnessEnthusias::destroy($id);
            }
            if($del){
                return redirect('prerak');
            }
        }
    }
    public function prerakList_old(){
        $refine_prerak=array();
        $enthusiast_arr = array();
        $prerak_result = DB::select(DB::raw("SELECT id, name, image, designation, facebook_profile,twitter_profile, instagram_profile, state_name, genrated_refer_code, refer_code, parent_id, facebook_profile_followers as fb_followers, twitter_profile_followers as tw_followers, instagram_profile_followers as insta_followers, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, sum_follower, status, created_at from preraks where register_as='prerak' and status='1'")); 
        $i=1;
        foreach($prerak_result as $prerak_rows){
            $child_prerak = DB::select(DB::raw("SELECT id, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as child_sum_of_followers, status, created_at from (select * from preraks order by parent_id, id) preraks, (select @pv := $prerak_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='1'"));

                $child_sum = 0;
                foreach($child_prerak as $pr_data){ 
                    $child_sum = $child_sum+$pr_data->child_sum_of_followers;
                }
                $total_follower = $child_sum+$prerak_rows->sum_of_followers;
              
                if($total_follower < 10000){
                    $refine_prerak[$i] = array(
                            'id'   => $prerak_rows->id,
                            'name' => $prerak_rows->name,
                            'image' => $prerak_rows->image,
                            'designation'=>$prerak_rows->designation,
                            'facebook_profile'=>$prerak_rows->facebook_profile,
                            'twitter_profile'=>$prerak_rows->twitter_profile,
                            'instagram_profile'=>$prerak_rows->instagram_profile,
                            'state_name'=>$prerak_rows->state_name
                        );
                $i++;
                }
        }

        $enthusiast_result = DB::select(DB::raw("SELECT id, name, image, designation, facebook_profile,twitter_profile, instagram_profile, state_name, genrated_refer_code, refer_code, parent_id, facebook_profile_followers as fb_followers, twitter_profile_followers as tw_followers, instagram_profile_followers as insta_followers, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, max_partcipant, status, created_at from fitness_enthusias where register_as='prerak' and status='1'")); 
        $j=1;
        foreach($enthusiast_result as $enthusiast_rows){
            $child_enthusiast = DB::select(DB::raw("SELECT id, max_partcipant, status, created_at from (select * from fitness_enthusias order by parent_id, id) fitness_enthusias, (select @pv := $enthusiast_rows->id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id)) and status='1'"));

                $child_parcipant = 0;
                foreach($child_enthusiast as $en_data){ 
                    $child_parcipant = $child_parcipant+$en_data->max_partcipant;
                }
                $total_partcipant = $child_parcipant+$enthusiast_rows->max_partcipant;
              
                if($total_partcipant < 500){
                    $enthusiast_arr[$j] = array(
                            'id'   => $enthusiast_rows->id,
                            'name' => $enthusiast_rows->name,
                            'image' => $enthusiast_rows->image,
                            'designation'=>$enthusiast_rows->designation,
                            'facebook_profile'=>$enthusiast_rows->facebook_profile,
                            'twitter_profile'=>$enthusiast_rows->twitter_profile,
                            'instagram_profile'=>$enthusiast_rows->instagram_profile,
                            'state_name'=>$enthusiast_rows->state_name,
                            'max_parent_partcipant'=>$enthusiast_rows->max_partcipant,
                            'total_partcipant'=>$total_partcipant,
                        );
                $j++;
                }
        }
        $media_prerak = $refine_prerak;   
        $fitevent_specialist  = $enthusiast_arr;
        //$social_media_prerak = array_merge($media_prerak,$fitevent_specialist);  

        $social_media_prerak = $this->paginate(array_merge($media_prerak,$fitevent_specialist)); 
        return view('prerak_list',compact('social_media_prerak'));
    }
    public function paginate($items, $perPage = 12, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, ['path' => Paginator::resolveCurrentPath()]);
    }

     public function prerakList(){
        $social_media_prerak = Prerakfirstlevel::where('status', '1')->orderBy('created_at','DESC')->paginate(18);
        return view('prerak_list',compact('social_media_prerak'));
    }
}
