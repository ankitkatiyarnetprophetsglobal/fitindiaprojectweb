<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, Response;
use App\Models\Trackingpic;
use Illuminate\Support\Facades\Validator;
use App\Models\Abhauserdetails;
use App\Models\Abhausermaping;
use Illuminate\Support\Facades\DB;
use PDO;

class Trackingv1Controller extends Controller
{
    
    public function trackingpicv1(Request $request){
        try{
            // dd("asdfasdfasdf");
            $image = '';
            $year = date("Y/m");		
            $user_id = $request['user_id'];
            $trip_id = $request['trip_id'];
            $event_id = $request['event_id'];
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
                // 'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],             
                // 'long' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                // 'trip_status' => 'required|integer',
                // 'timestamp' => 'required|nullable'
                
            ],[
                'user_id.required'=>'User Id Is Required.',
                'trip_id.required'=>'Trip Id Is Required.',
                // 'groupid.required'=>'Group Id Is Required.',
                'image.required'=>'Image Is Required.',            
                // 'lat.regex' => 'Latitude value appears to be incorrect format.',
                // 'long.regex' => 'Longitude value appears to be incorrect format.',
                // 'trip_status' => 'Trip Status Is Required.',
                // 'timestamp' => 'Timestamp Is Required.',
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

                
                if($event_id == null || $event_id == '' || $event_id === false){
                    $event_id = 0;
                }


                if(!empty($image)){

                    $Trackingpic = new Trackingpic();
                    $Trackingpic->user_id = $user_id;
                    $Trackingpic->trip_id = $trip_id;		
                    $Trackingpic->event_id = $event_id;		
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
	
	public function gettrackingpicv1(Request $request){
        // dd(1);
        try{

            $user_id = is_int($request->user_id);
            $trip_id = $request->trip_id;

            if($user_id == null || $user_id == '' || $user_id === false){

                $error_code = '801';
                $error_message = 'Required User Id';                
                
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

            $gettrackingpic = Trackingpic::where('status', 1)->where('user_id',$request->user_id)->where('trip_id',$request->trip_id)->get();  
			
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

    public function postabhaimageurl(Request $request){
        
        try{            
            $profile_image = '';
            // $abha_card = '';
            $year = date("Y/m");		
            $fid = $request['fid'];
            $abha_id = $request['abha_id'];
            $abha_address = $request['abha_address'];            
            $profile_image = $request['profile_image'];
            // $abha_card = $request['abha_card'];

            // dd($profile_image);

            $validator = Validator::make($request->all(), [                            
                'fid' => 'required|integer',           
                'abha_id' => 'required',                      
                'abha_address' => 'required',                                      
                // 'image' => 'required|image|mimes:jpg,png,gif,svg','pdf',
                'profile_image' => 'required',
                // 'abha_card' => 'required',
            ],[
                'fid.required'=>'FID Is Required.',
                'abha_id.required'=>'Abha ID Is Required.',
                'abha_address.required'=>'Abha Address Is Required.',
                'profile_image.required'=>'File Is Required.',
                // 'abha_card.required'=>'File Is Required.',
            ]);
        
            if ($validator->fails()) {
            
                $error_code = '801';
                $error_message = $validator->errors()->first();
                
                return Response::json(array(
                    
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message,

                ), 200);

            }
            
            // if(!empty($request->file('profile_image')) && !empty($request->file('abha_card'))){
            if(!empty($request->file('profile_image'))){
                
                $profile_image = $request->file('profile_image')->store('abhaimages/'.$year,['disk'=> 'uploads']);
                $profile_image = url('wp-content/uploads/'.$profile_image);

                $datacheck = Abhauserdetails::select('fid','abha_user_details.aum_id','abha_user_details.id','abha_id','abha_address','name','dob','gender','mobile','address','abha_card','state_name','town_name','district_name','profile_image','month','year')
                                                ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')
                                                ->where([
                                                        ['abha_user_maping.fid','=' , $fid],
                                                        ['abha_user_maping.abha_id','=' , $abha_id],
                                                        ['abha_user_maping.deactivate_abha','=' , 1],
                                                        ['abha_user_maping.status','=' , 1],
                                                        ['abha_user_details.abha_address','=' , $abha_address]
                                                        ])
                                                ->orderBy('abha_user_details.id', 'DESC')->first();                
                
                if(isset($datacheck)){                    
                    
                    $update_query = Abhauserdetails::where([
                                                            ['abha_user_details.aum_id','=' , $datacheck['aum_id']],
                                                            ['abha_user_details.status','=' , 1],
                                                            ['abha_user_details.abha_address','=' , $abha_address]
                                                    ])
                                                    ->update([
                                                        'profile_image' => $profile_image                                                        
                                                    ]);
                    
                    return Response::json(array(
                        'isSuccess' => 'true',
                        'code'      => 200,
                        'data'      => array('profile_image'=>$profile_image),
                        'message'   => null
                    ), 200);

                }else{

                    $error_code = '801';
                    $error_message = 'Data not found';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200); 
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

            

        }catch(Exception $e){                
                
                $error_code = '901';
                $error_message = $e->getMessage();
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
    
    public function post_abha_aabhar_image_url(Request $request){
        
        try{            
            
            // dd($request->all());
            $abha_card = '';
            $year = date("Y/m");		
            $fid = $request['fid'];
            $abha_id = $request['abha_id'];
            $abha_address = $request['abha_address'];                        
            $abha_card = $request['abha_card'];            

            $validator = Validator::make($request->all(), [                            
                'fid' => 'required|integer',           
                'abha_id' => 'required',                      
                'abha_address' => 'required',                                                      
                'abha_card' => 'required',
            ],[
                'fid.required'=>'FID Is Required.',
                'abha_id.required'=>'Abha ID Is Required.',
                'abha_address.required'=>'Abha Address Is Required.',                
                'abha_card.required'=>'File Is Required.',
            ]);
        
            if ($validator->fails()) {
            
                $error_code = '801';
                $error_message = $validator->errors()->first();
                
                return Response::json(array(
                    
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message,

                ), 200);

            }            

            if(!empty($request->file('abha_card'))){
                
                $abha_card = $request->file('abha_card')->store('abha_card/'.$year,['disk'=> 'uploads']);
                $abha_card = url('wp-content/uploads/'.$abha_card);
                    
                $datacheck = Abhauserdetails::select('fid','abha_user_details.aum_id','abha_user_details.id','abha_id','abha_address','name','dob','gender','mobile','address','abha_card','state_name','town_name','district_name','profile_image','month','year')
                                                ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')
                                                ->where([
                                                        ['abha_user_maping.fid','=' , $fid],
                                                        ['abha_user_maping.abha_id','=' , $abha_id],
                                                        ['abha_user_maping.deactivate_abha','=' , 1],
                                                        ['abha_user_maping.status','=' , 1],
                                                        ['abha_user_details.abha_address','=' , $abha_address]
                                                        ])
                                                ->orderBy('abha_user_details.id', 'DESC')->first();                
                
                if(isset($datacheck)){                    
                    
                    $update_query = Abhauserdetails::where([
                                                            ['abha_user_details.aum_id','=' , $datacheck['aum_id']],
                                                            ['abha_user_details.status','=' , 1],
                                                            ['abha_user_details.abha_address','=' , $abha_address]
                                                    ])
                                                    ->update([                                                        
                                                        'abha_card' => $abha_card
                                                    ]);
                    
                    return Response::json(array(
                        'isSuccess' => 'true',
                        'code'      => 200,
                        'data'      => array('abha_card'=>$abha_card),
                        'message'   => null
                    ), 200);

                }else{

                    $error_code = '801';
                    $error_message = 'Data not found';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200); 
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

        }catch(Exception $e){                
                
                $error_code = '901';
                $error_message = $e->getMessage();
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
