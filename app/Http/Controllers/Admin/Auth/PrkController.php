<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prerak;
use App\Models\Prerakfirstlevel;
use App\Models\Ambassador;
use App\Models\Champion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\PrerakExport;
use Excel;

class PrkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Prerak List"; 
        //$prerak = Prerak::where('parent_id','0')->get();

        $prerak = Prerak::leftJoin('admins', 'admins.id', '=', 'preraks.updated_by')
            ->where('preraks.parent_id','0')
            ->get(['admins.email as aemail', 'preraks.*']);

        $total_amb='';
        $approved_amb = '';
        $rejected_amb ='';
        $pending_amb ='';
        return view('admin.prerak.index',compact('title','prerak','total_amb','approved_amb','rejected_amb','pending_amb'));
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
        $prerak_result = DB::select(DB::raw("SELECT id, name, genrated_refer_code, refer_code, parent_id, transfer_status, facebook_profile_followers as fb_followers, twitter_profile_followers as tw_followers, instagram_profile_followers as insta_followers, facebook_profile_followers+twitter_profile_followers+instagram_profile_followers as sum_of_followers, status, created_at, register_as from (select * from preraks order by parent_id, id) preraks, (select @pv := $id) initialisation where find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id))")); 
        $query = "select * from users where cast(created_at as date) >= '2023-04-01' and cast(created_at as date)<='2023-04-30'";
        // $prerak_result = DB::select(DB::raw($query));
        // dd($prerak_result); 
        $prerak_data = collect($prerak_result);
        $parent_data = Prerak::find($id);
        return view('admin.prerak.all_details',compact('title','prerak_data','parent_data'));
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
       

        $preraks = Prerak::findOrFail($id);
        $preraks->status = $status;
        $preraks->updated_by = $auth_user->id;
        if($preraks->save()){
            $prk_info = Prerak::find($id);
            if($prk_info->status=='1'){
                DB::table('preraks')->where('id', $id)->update(['genrated_refer_code' => '#FITIND-0'.@$id]);
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
    public function exportPrerak()
    {
        if(request()->has('s'))
        {
        return Excel::download(new PrerakExport,'Preraklist.xlsx');
        }
        else
        {
        return Excel::download(new PrerakExport,'Preraklist.xlsx');
        }
    }
    public function influencerUpgrade(){
        $response = array();
        $id = $_POST['prk_id'];  
        $prk_type = $_POST['prk_type'];   
        $preraks = Prerak::where('id',$id)->first();
        if(!empty($preraks)){
            if($prk_type=='ambassador'){
               /* $inf_old_data1 = Ambassador::where('email',$preraks->email)->first();
                if(!empty($inf_old_data1)){*/
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
                        'user_checker' => $preraks->user_checker,
                        'updated_by' => $preraks->updated_by,
                        //'created_at' => $preraks->created_at,
                        'updated_at' => $preraks->updated_at,
                        'user_checker' => '0',              
                        ]);
                    /*}*/
            }else if($prk_type=='champion'){
               /* $inf_old_data2 = Champion::where('email',$preraks->email)->first();
                if(!empty($inf_old_data2)){*/
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
                        'user_checker' => $preraks->user_checker,
                        'updated_by' => $preraks->updated_by,
                        //'created_at' => $preraks->created_at,
                        'updated_at' => $preraks->updated_at,
                        'user_checker' => '0',              
                        ]);
                //}
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
                            'user_checker' => $preraks->user_checker,
                            'updated_by' => $preraks->updated_by,
                            //'created_at' => $preraks->created_at,
                            'updated_at' => $preraks->updated_at,
                            'user_checker' => '0',              
                            ]);
            }


            if(isset($influencer_data)){
                if($prk_type=='prerak'){
                    $update_transfer_status = DB::table('preraks')->where('id', $id)->update(['transfer_status' => '1']);
                }else if($prk_type=='ambassador'){
                    $update_transfer_status = DB::table('preraks')->where('id', $id)->update(['transfer_status' => '2']);
                }else if($prk_type=='champion'){ 
                    $update_transfer_status = DB::table('preraks')->where('id', $id)->update(['transfer_status' => '3']);
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
