<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\State;
use App\Models\Webreward;
class WebrewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reward_data = DB::table('organization_rewards')
        ->select('org_rewards_cat.award_group_type_name','organization_rewards.*')
        ->join('org_rewards_cat','org_rewards_cat.id','=','organization_rewards.award_group_type_id')
        ->paginate(40);
        return view('admin.reward.reward_list',compact('reward_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //$state = asort(State::all());
        $state = State::orderBy('name', 'ASC')->get();
        $reward_cat = DB::table('org_rewards_cat')->get();
        return view('admin.reward.add_reward',compact('reward_cat','state'),);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->awardee_select_type == 'user_select'){
            $request->validate([
                'a_group_type' => 'required',
                'awardee_select_type' => 'required',
                'user_id' => 'required',  
                'image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:1024'
            ],
            [
                'a_group_type.required' => 'Award Group type field is required',
                'awardee_select_type.required' => 'Awardee type field is required',
                'user_id.required' => 'Awardee Name(fitindia id) field is required',
                'image.required' => 'Image field is required',
                'image.max' => 'Image size should be less than 1 mb'
            ]); 
        }else{
            $request->validate([
                'a_group_type' => 'required',
                'awardee_select_type' => 'required',
                'award_state' => 'required',         
                'image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:1024'
            ],
            [
                'a_group_type.required' => 'Award Group type field is required',
                'awardee_select_type.required' => 'Awardee type field is required',
                'award_state.required' => 'Awardee Name(State) field is required',       
                'image.required' => 'Image field is required',
                'image.max' => 'Image size should be less than 1 mb'
            ]
            ); 
        }
        




        $obj_reward = new Webreward();
        $obj_reward->award_group_type_id = $request->a_group_type;
        if(!empty($request->award_type_name)) { $obj_reward->award_type_name = $request->award_type_name; } 
        
        $awardee_select_type = $request->awardee_select_type;
        if($awardee_select_type == 'user_select'){
            $obj_reward->awardee_id = $request->user_id ;
            $userdetail = User::where('id',$request->user_id)->first(['id','name']);
            $obj_reward->awardee_name = $userdetail->name; 
        }else{
            $obj_reward->awardee_id = $request->award_state; 
            $statedetail = State::where('id',$request->award_state)->first(['id','name']);
            $obj_reward->awardee_name = $statedetail->name;
        }
        $year = date("Y/m");
        $image = '';
        if($request->file('image'))
        {
            $image = $request->file('image')->store($year,['disk'=>'uploads']);
            $image = url('wp-content/uploads/'.$image);
        }

        $obj_reward->awardee_image = $image;

        $result = $obj_reward->save();

        if($result){
            return back()->with('success','Reward Successfully Added!');  
        }else{
            return back()->with('error','Something Wrong!'); 
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

    /** Fetch user data exist or not.
     * 
     * @param post id
     * @return user data
     */
    public function getuserdetail(Request $request){
        $response = array();
        $userid = $request->userid;
        $userdetail = User::where('id',$userid)->first(['id','name','email']);
        if(!empty($userdetail)){
            $response = array('msg'=>'success','status'=>'1','id'=>$userdetail->id,'name'=>$userdetail->name,'email'=>$userdetail->email);
        }else{
            $response = array('msg'=>'failed','status'=>'0');
        }
        echo json_encode($response);
    } 

    public function update_status(Request $request){
        $response = array();
        $award_id = $request->award_id;
        $status = $request->status;
       /* if($status==1){
            $status = '0';
        }else{
            $status = '1';
        }*/
        if($award_id){
            $update_result = Webreward::where('id', $award_id)->update(array('status' => $status));  
            if($update_result){
                $result = Webreward::where('id',$award_id)->first();
                if($result->status=='1'){
                     $response = array('msg'=>'success','status'=>'1');     
                }else{
                     $response = array('msg'=>'success','status'=>'0');
                }
            }else{
                $response = array('msg'=>'failed','status'=>'2');
            }
        }
        echo json_encode($response);
    }
      
}
