<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\Event;
use App\Models\Category;
use App\Exports\EventExport;
use Excel;
use App\Models\EventCat;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use App\Models\PushNotification;

class WebNotificationController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}
    
    public function pushnotefication(){
		$admins_role = Auth::user()->role_id;
		$categories = EventCat::orderBy("name")->get(); 
		$states = State::orderBy("name")->get(); 
		$districts = District::orderBy("name")->get();
		$blocks = Block::orderBy("name")->get();
		$curcount = 0;
		return view('admin.notefication.index',compact('admins_role','categories','states','districts','blocks','curcount'));
	}

	public function sendingWebNotification(Request $request){
		// dd($request->all());
        // dd(123456);
		// $this->validate($request, [
        //     'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        // ]);
         
        // $image = $request->file('image');
		// $fileName   = time() . '.' . $image->getClientOriginalExtension();
		// Storage::disk('local')->put('images'.'/'.$fileName, 'public');

        // $data = Image::create([
        //     'image' => $image_path,
        // ]);
		
        session()->flash('success', 'Image Upload successfully');
		// dd($request->all());
		$url = 'https://fcm.googleapis.com/fcm/send';
        // $FcmToken = User::whereNotNull('FCMToken')->pluck('FCMToken')->take(10)->all();
        // $FcmToken = User::whereNotNull('FCMToken')->pluck('FCMToken')->take(1000);
        // $FcmToken = User::whereNotNull('FCMToken')->where('phone','8299435521')->pluck('FCMToken');
        $FcmToken = User::whereNotNull('FCMToken')->where('id',1986495)->pluck('FCMToken');
        // dd($FcmToken);
        // $FcmToken = User::whereNotNull('FCMToken')->where('id',1876189)->pluck('FCMToken');
        
        // $FcmToken = User::whereNotNull('FCMToken')->pluck('FCMToken')->all();
        // $FcmToken = User::whereNotNull('device_key')->pluck('device_key')->all();
        // $FcmToken = $FcmToken[0];
        // echo $FcmToken;
        // dd($FcmToken);
        // exit;
		$serverKey = 'AAAAjyJFzh4:APA91bHKEXb2Et27Sfa86mkfgrJTmtN6B201T2U1R70HkzW45RWF9O4b_QmuNHYPZcmNNRakl1LYYAYYvPbglhexotsCCLw3AoTzFI0leMMImudKl02jqQcSEh5oRCY_vd2FoPDsaQjP';
		// dd($serverKey);
        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "image" => $request->image_file,
                "title" => $request->title,
                "body" => $request->body,  
            ]
        ];
        $encodedData = json_encode($data);
        // dd($encodedData);
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        
        // Close connection
        curl_close($ch);
        dd($result);
        // FCM response
        $resultdecode = json_decode($result);
        $success = $resultdecode->success;
        $failure = $resultdecode->failure;
        $pushnotification =PushNotification::select('id','message_file','message_title','message_description')->orderBy('id','desc')->get();
        $pushnotification_count = count($pushnotification);
        return view('admin.pushnotification.index',compact('pushnotification','pushnotification_count','success','failure'));
        // return view('admin.notefication.index',compact('success','failure'));   
        // return view('admin.pushnotification.index',compact('success','failure'));   
        
		// // dd($FcmToken);
		
	}

}
