<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, Response;
use App\Models\Trackingpic;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use PDO;

class TrackingController extends Controller
{
    
    public function trackingpic(Request $request){
        try{
            $image = '';
            $year = date("Y/m");		
            $user_id = $request['user_id'];
            $trip_id = $request['trip_id'];
            $groupid = $request['groupid'];
            $image = $request['image'];
            $lat = $request['lat'];
            $long = $request['long'];
            $trip_status = $request['trip_status'];
            $timestamp = $request['timestamp'];		
            $device_image_path = $request['device_image_path'];		
            $distance = $request['distance'];		
            $timetaken = $request['timetaken'];		
            
            $validator = Validator::make($request->all(), [                            
                'user_id' => 'required|integer',           
                'trip_id' => 'required',                      
                // 'groupid' => 'required|integer',  
                'image' => 'required|image|mimes:jpg,png,gif,svg',			              
                'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],             
                'long' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                'trip_status' => 'required|integer',
                'timestamp' => 'required|nullable'
                
            ],[
                'user_id.required'=>'User Id Is Required.',
                'trip_id.required'=>'Trip Id Is Required.',
                // 'groupid.required'=>'Group Id Is Required.',
                'image.required'=>'Image Is Required.',            
                'lat.regex' => 'Latitude value appears to be incorrect format.',
                'long.regex' => 'Longitude value appears to be incorrect format.',
                'trip_status' => 'Trip Status Is Required.',
                'timestamp' => 'Timestamp Is Required.',
            ]);
        
            if ($validator->fails()) {

                //return response()->json(['status' => 'error','message'=>$validator->errors()->first()]);
                $error_code = '801';
                $error_message = $validator->errors()->first();
                
                return Response::json(array(
                    
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message,

                ), 200);

            }
            
            if(!empty($request->file('image'))){

                $image = $request->file('image')->store('trackingpic/'.$year,['disk'=> 'uploads']);
                $image = url('wp-content/uploads/'.$image);

                
                if(!empty($image)){

                    $Trackingpic = new Trackingpic();
                    $Trackingpic->user_id = $user_id;
                    $Trackingpic->trip_id = $trip_id;		
                    $Trackingpic->groupid = $groupid;		
                    $Trackingpic->image = $image;
                    $Trackingpic->latitude = $lat;
                    $Trackingpic->longitude = $long;
                    $Trackingpic->trip_status = $trip_status;
                    $Trackingpic->timestamp = $timestamp;		
                    $Trackingpic->device_image_path = $device_image_path;		
                    $Trackingpic->distance = $distance;		
                    $Trackingpic->timetaken = $timetaken;		
                    $Trackingpic->status = 1;
                    $Trackingpic->save();

                    return Response::json(array(
                        'isSuccess' => 'true',
                        'code'      => 200,
                        'data'      => null,
                        'message'   => 'Insert Success'
                    ), 200);
                    
                }else{

                    return Response::json(array(
                        'status'    => 'error',
                        'code'      =>  400,
                        'message'   =>  'Image not uploaded'
                    ), 400);

                }

            }else{

                $error_code = '801';
                $error_message = 'Image not upload';
                
                return Response::json(array(
                    
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message,

                ), 200);
            }

            return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  422,
                    'message'   =>  'Image not found'
                ), 422);

        }catch(Exception $e){

                // $function_name = 'trackingpic';   
                // $controller_name = 'TrackingController';
                $error_code = '901';
                $error_message = $e->getMessage();
                // $send_payload = null;
                // $response = null;            
                // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);
                
                if(empty($request->Location)){
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }
    
        }
	}
	
	public function gettrackingpic(Request $request){
        // dd(1);
        try{

            $user_id = is_int($request->user_id);
            $trip_id = $request->trip_id;

            if($user_id == null || $user_id == '' || $user_id === false){

                $error_code = '801';
                $error_message = 'Required Deleted Id';                
                
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);    
            }
            
            if($trip_id == null || $trip_id == ''){
                
                $error_code = '801';
                $error_message = 'Required Trip Id';                
                
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);    
            }            

            $gettrackingpic = Trackingpic::whereNotNull('latitude')->where('status', 1)->where('user_id',$request->user_id)->where('trip_id',$request->trip_id)->get();  
			// dd($gettrackingpic);
			if(count($gettrackingpic) > 0){        

                $error_code = 200;
                $error_message = null;

                return Response::json(array(
                    'isSuccess' => 'true',
                    'code'      => $error_code,
                    'data'      => $gettrackingpic,
                    'message'   => $error_message
                ), 200);

            }else{
                
                $error_code = '801';
                $error_message = "Data not found";                                
                
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);                    

            }
            
        }catch(Exception $e){

            // $function_name = 'gettrackingpic';   
            // $controller_name = 'TrackingController';
            $error_code = '901';
            $error_message = $e->getMessage();
            // $send_payload = null;
            // $response = null;            
            // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);
            
            if(empty($request->Location)){
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }

        }
    }
}
