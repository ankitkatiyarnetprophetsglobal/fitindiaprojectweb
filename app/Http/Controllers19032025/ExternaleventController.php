<?php

namespace App\Http\Controllers;

use App\Models\Externalevent;
use App\Models\ExeventRegistration;
use App\Models\User;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ExternaleventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Fit_id = @$_REQUEST['Fit_id'];
        if(!empty($Fit_id)){
            $user = User::where('id',$Fit_id)->first();
            if(!empty($user)){
                $ex_reg_data = ExeventRegistration::where('user_id',$Fit_id)->first();
                if(empty($ex_reg_data)){
                    $state = State::all();
                    return view('external_event.external-event-registration',compact('state'));
                }else{
                    return redirect('external-event-activity?Fit_id='.$Fit_id); 
                }
            }else{
                return abort(404);
            }
        }else{
             return redirect('https://www.75suryanamaskar.com/home/fitindia_register'); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Fit_id = @$_REQUEST['Fit_id'];
        if(!empty($Fit_id)){
            $user = User::where('id',$Fit_id)->first();
            if(!empty($user)){
                $Ex_event = Externalevent::where('id',1)->first();
                $ex_reg_data = ExeventRegistration::where('user_id',$Fit_id)->first();
                if(!empty($ex_reg_data)){
                    $ex_activity = DB::table('external_event_activity')->where('extevent_reg_id',$ex_reg_data->id)->orderBy('event_activity_date','DESC')->get();
                    return view('external_event.external-event-activity',compact('ex_reg_data','Ex_event','ex_activity'));
                }else{
                    return redirect('external-event-registration?Fit_id='.$Fit_id);
                }
            }else{
                return abort(404);
            }
        }else{
            return redirect('https://www.75suryanamaskar.com/home/fitindia_register');
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
        $i = 0;
        $activity_data;
        $num_count = $request->nm_count;
      /*  echo "<pre>";
        print_r($num_count);
        die;*/
        $event_reg_id = $request->event_reg_id;

        $activity_data = [];
        $user_id = $request->user_id;
        foreach ($request->date as $dvalue ) {
            $nm_val = @$num_count[$i]?@$num_count[$i]:0;
            $activity_data = array('extevent_reg_id'=>$event_reg_id,'user_id'=>$user_id,'event_activity_date'=> $dvalue, 'nm_count' =>$nm_val);
       //DB::enableQueryLog(); // Enable query log

$fetch_result = DB::table('external_event_activity')->where('extevent_reg_id',$event_reg_id)->where('event_activity_date',date($dvalue))->get();

//dd(DB::getQueryLog()); // Show results of log
            
         
            if(!$fetch_result->isEmpty()){
                DB::table('external_event_activity')->where('extevent_reg_id',$event_reg_id)->where('event_activity_date',date($dvalue))->update(['nm_count' => $num_count[$i]]);
            }
            if($fetch_result->isEmpty()){ 
                $result = DB::table('external_event_activity')->insert($activity_data);
            }
            $i++;
        }


        

        return back()->with('success','Updated Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Externalevent  $externalevent
     * @return \Illuminate\Http\Response
     */
    public function show(Externalevent $externalevent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Externalevent  $externalevent
     * @return \Illuminate\Http\Response
     */
    public function edit(Externalevent $externalevent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Externalevent  $externalevent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Externalevent $externalevent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Externalevent  $externalevent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Externalevent $externalevent)
    {
        //
    }
    public function external_event_register(Request $request){
        /*echo "<pre>";
        print_r($request->all());
        die;*/
        $user = User::where('id',$request->user_id)->first();
        if(!empty($user)){
            $ex_reg_data = ExeventRegistration::where('user_id',$request->user_id)->first();
            if(empty($ex_reg_data)){
                $obj_exreg = new ExeventRegistration();
                $obj_exreg->external_evt_id = 1;
                $obj_exreg->registration_type = $request->reg_type;
                $obj_exreg->user_id = $request->user_id;

                if(!empty($request->org_name)){ $obj_exreg->org_name = $request->org_name; }
                if(!empty($request->num_of_participant)){ $obj_exreg->num_of_participant = $request->num_of_participant; }
                if(!empty($request->state)){ 
                    $obj_exreg->state_id = $request->state; 
                    $state_name = State::where('id',$request->state)->first()->name;
                    $obj_exreg->state_name = $state_name;
                }


                $result = $obj_exreg->save();
                if($result){
                    return redirect('external-event-activity?Fit_id='.$request->user_id);
                }else{
                    return back()->with('failed','Something Wrong')->withInput();
                }
            }else{
                return redirect('external-event-activity?Fit_id='.$request->user_id);
            }
        }else{
            return abort(404);
        }
    }

}
