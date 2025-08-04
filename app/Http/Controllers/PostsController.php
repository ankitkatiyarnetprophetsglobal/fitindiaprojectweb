<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, Response;
use App\Models\Trackingpic;
use App\Models\Post;
use App\Models\Posttracking;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use PDO;

class PostsController extends Controller
{

    private $OPENSSL_CIPHER_NAME = "aes-128-cbc"; //Name of OpenSSL Cipher 
    private $CIPHER_KEY_LEN = 16; //128 bits

    function encrypt($key, $iv, $data) {
        
        if (strlen($key) < $this->CIPHER_KEY_LEN) {

            $key = str_pad("$key", $this->CIPHER_KEY_LEN, "0"); //0 pad to len 16
        
        } else if (strlen($key) > $this->CIPHER_KEY_LEN) {
        
            $key = substr($str, 0, $this->CIPHER_KEY_LEN); //truncate to 16 bytes
        
        }
        
        $encodedEncryptedData = base64_encode(openssl_encrypt($data, $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv));
        $encodedIV = base64_encode($iv);
        // $encryptedPayload = $encodedEncryptedData.":".$encodedIV;
        $encryptedPayload = $encodedEncryptedData;
        
        return $encryptedPayload;
        
    } 

	function decrypt($key, $iv, $data) {
        
        if (strlen($key) < $this->CIPHER_KEY_LEN) {
        
            $key = str_pad("$key", $this->CIPHER_KEY_LEN, "0"); //0 pad to len 16
        
        } else if (strlen($key) > $this->CIPHER_KEY_LEN) {
        
            $key = substr($str, 0, $this->CIPHER_KEY_LEN); //truncate to 16 bytes
        
        }
        
        // $parts = explode(':', $data); 
        //$decryptedData = openssl_decrypt(base64_decode($parts[0]), $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, base64_decode($parts[1]));
			
        $decryptedData = openssl_decrypt(base64_decode($data), $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv);
        return $decryptedData;
    }

    public function getpostdetailsview($id,$user_id = null){
        try{
            // dd($id);
            $currentdatetime = time();			
            $iv = "fedcba9876543210"; #Same as in JAVA
            $key = "0a9b8c7d6e5f4g3h"; #Same as in JAVA
            // $key = $currentdatetime.'fitind';

            if(is_numeric($id) == false){

                $id = $this->decrypt($key, $iv, $id);        
                $user_id = $this->decrypt($key, $iv, $user_id);               
                
            }else{

                $user_id = $this->decrypt($key, $iv, $user_id);        
            }
            // $id = $this->encrypt($key, $iv, $id);
            $post_data = Post::where([['published', '=', 2],['id', '=', $id]])->first();
            // dd($post_data);
            $Posttracking_save = new Posttracking();            
            $Posttracking_save->user_id = $user_id;
            $Posttracking_save->post_id = $id;
            $Posttracking_save->sharing = 1;
            $Posttracking_save->status = 1;				
            $Posttracking_save->save();
            return view('api.get-post-details-view',[
                                                        'post_data' => $post_data,
                                                        'id' => $id 
                                                    ]);
            
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
	
    public function getpostdetailsrssview($id){
        try{

            $id = decrypt($id);
            $post_data = Post::where([['published', '=', 2],['id', '=', $id]])->first();
            // dd($post_data);
            $Posttracking_save = new Posttracking();                        
            $Posttracking_save->post_id = $id;
            $Posttracking_save->rss = 1;
            $Posttracking_save->status = 1;				
            $Posttracking_save->save();
            return view('api.get-post-details-view',[
                                                        'post_data' => $post_data,
                                                        'id' => $id 
                                                    ]);
            
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
}
