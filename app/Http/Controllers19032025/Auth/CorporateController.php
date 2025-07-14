<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Corporate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Excel;
use stdClass;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use PDF;
class CorporateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()){

            $role = Auth::user()->role;
            $a_id = Auth::user()->id;
            //$categories = EventCat::all();
            $userdata = user::with('usermeta')->find($a_id);
            if(!empty($userdata)){  
                $cpt = DB::table('corporates')->where('user_id',$a_id)->first();  
                if(empty($cpt)){  
                    return view('corporate.add-corporate', ['role' => $role , 'userdata' => $userdata ]);
                }else{ 
                    return redirect('corporate-detail');
                }
            }else{
                return redirect('login');
            }
        }else{ 
             return redirect('login');
        }
        
    }
    public function mobileCreateCorporate()
    {

        $id = @$_REQUEST['auth_id'];

        $usersData = DB::table('users')->where('id',$id)->first();
        if(!empty($usersData)){  
            if(!empty($id)){
                $role = $usersData->role;
                $a_id = $usersData->id;
                $userdata = user::with('usermeta')->find($a_id);
                if(!empty($userdata)){  
                    $cpt = DB::table('corporates')->where('user_id',$a_id)->first();  
                    if(empty($cpt)){  
                        echo "<h1>Please fill the corporate form from the website</h1>";
                        //return view('corporate.add-corporate', ['role' => $role , 'userdata' => $userdata ]);
                    }else{ 
                        return redirect('mobile-corporate-detail?m=true&auth_id='.$id);
                    }
                }else{
                    abort(404);
                }
            }else{ 
                abort(404);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $document = '';
        $emp_app_ids = '';
        $year = date("Y/m"); 
        if($request->file('doc')){
            $document = $request->file('doc')->store($year,['disk'=> 'uploads']);
            $document = url('wp-content/uploads/'.$document);
        }
        if($request->file('files')){
            $emp_app_ids = $request->file('files')->storeAs('wp-content/uploads/'.$year, Str::random(40).".csv");
            $emp_app_ids = url('storage/app/'.$emp_app_ids);
        }



        $corporate = new Corporate();
        $corporate->user_id = $request->user_id;
        $corporate->mobile_app_id = $request->unique_app_id;
        $corporate->name = $request->name;
        $corporate->email = $request->email;
        $corporate->contact = $request->contact;
        $corporate->eventname = serialize($request->eventname);
        $corporate->eventdate = serialize($request->eventdate);
        $corporate->noofparticipant = serialize($request->noofparticipant);
        $corporate->facebook_profile = $request->facebook_url;
        $corporate->twitter_profile = $request->twitter_url;
        $corporate->instagram_profile = $request->insta_url;
        $corporate->app_emp_num = $request->total_app_emp;
        $corporate->doc = $document;
        $corporate->emp_app_ids = $emp_app_ids;
        if(!empty($request->sports_emp_num)){ $corporate->sports_emp_num = $request->sports_emp_num; }
        if(!empty($request->emp_name)){ $corporate->emp_name = serialize($request->emp_name); }
        if(!empty($request->sports_name)){ $corporate->spports_name = serialize($request->sports_name); }
        if(!empty($request->csr_name)){ $corporate->csr_name = $request->csr_name; }
        if(!empty($request->csr_region)){ $corporate->csr_region = $request->csr_region; }
        if(!empty($request->csr_detail)){ $corporate->csr_detail = $request->csr_detail; }
        if(!empty($request->org_equipment_name)){ $corporate->org_equipment_name = $request->org_equipment_name; }
        if(!empty($request->org_equipment_place)) { $corporate->org_equipment_place = $request->org_equipment_place; }
       
        if($corporate->save()){
            return redirect('corporate-detail')->with('success','Corporate Successsfully Added');
        }else{
             return back()->with('failed','Something Wrong');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id=null)
    {
        $userid = Auth::user()->id;
        if($userid){
            $corporate_data = Corporate::where('user_id',$userid)->first();
            if(!empty($corporate_data)){
                return view('corporate.application_status', ['application_data' => $corporate_data ]);
            }else{
                return redirect('create-corporate');
            }
        }else{
            return redirect('login');
        }
    }
    public function showByMobile($id=null)
    {
        $userid = $_REQUEST['auth_id'];
        if($userid){
            $corporate_data = Corporate::where('user_id',$userid)->first();
            if(!empty($corporate_data)){
                return view('corporate.application_status', ['application_data' => $corporate_data ]);
            }else{
                echo "<h1>Please fill the corporate form from the website</h1>";
            }
        }else{
            return redirect('login');
        }
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
    public function check_fitness_test(Request $request){
        $app_ids_ar = json_decode($request->app_ids);
        $fitindia_ids = array_column($app_ids_ar, 'id');
        $score_user_ids = array();

        $score_data = DB::table('fitness_score')
             ->whereIn('user_id', $fitindia_ids)
             ->get()
             ->toArray();
        if(!empty($score_data)){
            $score_user_ids = array_column($score_data,'id');
        }
        if(!empty(array_diff($fitindia_ids,$score_user_ids))){
            $result = array('status'=>0,'msg'=>'failed');
        }else{
            $result = array('status'=>1,'msg'=>'success');
        }
        echo json_encode($result);
    }

    public function check_fitness_test_new(Request $request){
        $score_user_ids = array();
        $ar = array();
        $fitapp_user_per = $_POST['fitapp_user_count'] * 20 / 100;
        $rows = array_map('str_getcsv', file($_FILES['files']['tmp_name']));
        $header1 =  array_shift($rows);
        $CsV = array() ;
        foreach($rows as $row) {
        $CsV[] = array_combine ($header1, $row);
        }
        if(count($CsV) >= $fitapp_user_per){
            $fitindia_ids = array_column($CsV, 'id');
            $score_data = DB::table('fitness_score')
                         ->whereIn('user_id', $fitindia_ids)
                         ->get()
                         ->toArray();
            if(!empty($score_data)){
                $score_user_ids = array_column($score_data,'user_id');
            }
            if(!empty(array_diff($fitindia_ids,$score_user_ids))){
                $result = array('status'=>0,'msg'=>'Should have 20% employees taken fitness assessment test on Fit India Mobile App' , 'tst'=>count($CsV).'='.$fitapp_user_per);
            }else{
                $result = array('status'=>1,'msg'=>'success' , 'tst'=>count($CsV).'='.$fitapp_user_per);
            }
        }else{
            $result = array('status'=>2,'msg'=>'At least 20% employees must be in the csv (excel) sheet' , 'tst'=>count($CsV).'='.$fitapp_user_per);
        }

        echo json_encode($result);
    }
    public function mobileCertCorporate(){
        $auth_id = @$_REQUEST['auth_id'];       
        if(!empty($auth_id)){           
            $user = User::where('id',$auth_id)->first();            
            if(!empty($user)){
                $name = $user->name;
                $result = DB::table('corporates')->where('user_id',$auth_id)->first();       
                if(!empty($result)){
                    $pdf = PDF::loadView('corporate.corporates-certificate',['name' => $name, 'awarded_date' => $result->created_at  ])->setPaper('a4', 'portrait');
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
}
