<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FitnessEnthusias;
use App\Models\Prerakfirstlevel;
use App\Models\Ambassador;
use App\Models\Champion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\FitnessEnthusiastExport;
use Excel;

class FitEnthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Influencer (Fitness Event Specialist)"; 
        //$prerak = FitnessEnthusias::where('parent_id','0')->get();
        $prerak = FitnessEnthusias::leftJoin('admins', 'admins.id', '=', 'fitness_enthusias.updated_by')
            ->where('fitness_enthusias.parent_id','0')
            ->get(['admins.email as aemail', 'fitness_enthusias.*']);
        $total_amb='';
        $approved_amb = '';
        $rejected_amb ='';
        $pending_amb ='';
        return view('admin.fitness_enthusiast.index',compact('title','prerak','total_amb','approved_amb','rejected_amb','pending_amb'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = "Prerak Details";
        $prerak_result = DB::select(DB::raw("SELECT id, name, genrated_refer_code, refer_code, parent_id, transfer_status, facebook_profile_followers as fb_followers, twitter_profile_followers as tw_followers, instagram_profile_followers as insta_followers, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, event_partcipant_number, max_partcipant, status, created_at, register_as from (select * from fitness_enthusias order by parent_id, id) fitness_enthusias, (select @pv := $id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id))")); 
        $prerak_data = collect($prerak_result);
        $parent_data = FitnessEnthusias::find($id);
        return view('admin.fitness_enthusiast.all_details',compact('title','prerak_data','parent_data'));
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
    public function active(Request $request)
    {
        $auth_user = Auth::user();
        $response = array();
        $id = $request->prk_id;
        $status = $request->status;
       

        $preraks = FitnessEnthusias::findOrFail($id);
        $preraks->status = $status;
        $preraks->updated_by = $auth_user->id;
        if($preraks->save()){
            $prk_info = FitnessEnthusias::find($id);
            if($prk_info->status=='1'){
                DB::table('fitness_enthusias')->where('id', $id)->update(['genrated_refer_code' => '#FITNESS-0'.@$id]);
                if($prk_info->user_checker=='0'){
                    $pass = "Use your old password";
                }else{
                    $pass = "Prerak@123";
                }
                $response = array('status'=>1,'msg'=>'Approved','pass'=>$pass);
            }
            elseif($prk_info->status=='2'){
                $response = array('status'=>2,'msg'=>'Rejected');
            }
            else{
                $response = array('status'=>0,'msg'=>'Pending');
            }
        }
        else{
            $response = array('status'=>0,'msg'=>'failed');
        }
        echo json_encode($response);
        die;
    }
    public function exportEnthusiast()
    {
        if(request()->has('s'))
        {
        return Excel::download(new FitnessEnthusiastExport,'Preraklist-FitnessEnthusiast.xlsx');
        }
        else
        {
        return Excel::download(new FitnessEnthusiastExport,'Preraklist-FitnessEnthusiast.xlsx');
        }
    }
    public function fitnessEventUpgrade(){
        $response = array();
        $id = $_POST['prk_id'];  
        $prk_type = $_POST['prk_type'];   
        $preraks = FitnessEnthusias::where('id',$id)->first();
        if(!empty($preraks)){
            if($prk_type=='ambassador'){
                    $influencer_data = Ambassador::create([
                        'user_id' =>$preraks->user_id?$preraks->user_id:0,
                        'name' => $preraks->name,
                        'email' => $preraks->email,
                        'contact' => $preraks->contact,
                        'designation' => $preraks->designation,
                        'state_name' => $preraks->state_name,
                        'state_id' => $preraks->state_id,
                        'district_name' => $preraks->district_name,
                        'district_id' =>$preraks->district_id,
                        'block_name' => $preraks->block_name,
                        'block_id' =>$preraks->block_id,
                        'pincode' =>$preraks->pincode,
                        'image' =>$preraks->image,
                        'facebook_profile' => $preraks->facebook_profile,
                        'twitter_profile' => $preraks->twitter_profile,
                        'instagram_profile' => $preraks->instagram_profile,
                        'facebook_profile_followers' =>$preraks->facebook_profile_followers?$preraks->facebook_profile_followers:0,
                        'twitter_profile_followers' =>$preraks->twitter_profile_followers?$preraks->twitter_profile_followers:0,
                        'instagram_profile_followers' => $preraks->instagram_profile_followers?$preraks->instagram_profile_followers:0,
                        'work_profession' => $preraks->work_profession,
                        'description' => $preraks->description,
                        'status' => $preraks->status,
                        'user_checker' => 0,
                        'updated_by' => $preraks->updated_by,
                        //'created_at' => $preraks->created_at,
                        'updated_at' => $preraks->updated_at
                        ]);
            }else if($prk_type=='champion'){
                    $influencer_data = Champion::create([
                        'user_id' =>$preraks->user_id?$preraks->user_id:0,
                        'name' => $preraks->name,
                        'email' => $preraks->email,
                        'contact' => $preraks->contact,
                        'designation' => $preraks->designation,
                        'state_name' => $preraks->state_name,
                        'state_id' => $preraks->state_id,
                        'district_name' => $preraks->district_name,
                        'district_id' =>$preraks->district_id,
                        'block_name' => $preraks->block_name,
                        'block_id' =>$preraks->block_id,
                        'pincode' =>$preraks->pincode,
                        'image' =>$preraks->image,
                        'facebook_profile' => $preraks->facebook_profile,
                        'twitter_profile' => $preraks->twitter_profile,
                        'instagram_profile' => $preraks->instagram_profile,
                        'facebook_profile_followers' =>$preraks->facebook_profile_followers?$preraks->facebook_profile_followers:0,
                        'twitter_profile_followers' =>$preraks->twitter_profile_followers?$preraks->twitter_profile_followers:0,
                        'instagram_profile_followers' => $preraks->instagram_profile_followers?$preraks->instagram_profile_followers:0,
                        'work_profession' => $preraks->work_profession,
                        'description' => $preraks->description,
                        'status' => $preraks->status,
                        'user_checker' => 0,
                        'updated_by' => $preraks->updated_by,
                        //'created_at' => $preraks->created_at,
                        'updated_at' => $preraks->updated_at
                        ]);
            }else{
                    $influencer_data = Prerakfirstlevel::create([
                            'user_id' =>$preraks->user_id?$preraks->user_id:0,
                            'name' => $preraks->name,
                            'email' => $preraks->email,
                            'contact' => $preraks->contact,
                            'designation' => $preraks->designation,
                            'state_name' => $preraks->state_name,
                            'state_id' => $preraks->state_id,
                            'district_name' => $preraks->district_name,
                            'district_id' =>$preraks->district_id,
                            'block_name' => $preraks->block_name,
                            'block_id' =>$preraks->block_id,
                            'pincode' =>$preraks->pincode,
                            'image' =>$preraks->image,
                            'facebook_profile' => $preraks->facebook_profile,
                            'twitter_profile' => $preraks->twitter_profile,
                            'instagram_profile' => $preraks->instagram_profile,
                            'facebook_profile_followers' =>$preraks->facebook_profile_followers?$preraks->facebook_profile_followers:0,
                            'twitter_profile_followers' =>$preraks->twitter_profile_followers?$preraks->twitter_profile_followers:0,
                            'instagram_profile_followers' => $preraks->instagram_profile_followers?$preraks->instagram_profile_followers:0,
                            'work_profession' => $preraks->work_profession,
                            'description' => $preraks->description,
                            'status' => $preraks->status,
                            'user_checker' => 0,
                            'updated_by' => $preraks->updated_by,
                            //'created_at' => $preraks->created_at,
                            'updated_at' => $preraks->updated_at
                            ]);
            }


            if(isset($influencer_data)){
                if($prk_type=='prerak'){
                    $update_transfer_status = DB::table('fitness_enthusias')->where('id', $id)->update(['transfer_status' => '1']);
                }else if($prk_type=='ambassador'){
                    $update_transfer_status = DB::table('fitness_enthusias')->where('id', $id)->update(['transfer_status' => '2']);
                }else if($prk_type=='champion'){ 
                    $update_transfer_status = DB::table('fitness_enthusias')->where('id', $id)->update(['transfer_status' => '3']);
                }
                if(isset($update_transfer_status)){
                   $response = array('status'=>1,'msg'=>'success');
                }else{
                   $response = array('status'=>0,'msg'=>'Data Trasfer Success But Transfer status update failed');
                }
            }else{
                $response = array('status'=>0,'msg'=>'failed');
            }
        }else{
             $response = array('status'=>0,'msg'=>'Data Empty');
        }
        echo json_encode($response);
        die;

    }
}
