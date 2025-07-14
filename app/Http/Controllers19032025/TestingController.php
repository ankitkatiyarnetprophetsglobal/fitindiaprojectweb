<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, Response;
use App\Models\Trackingpic;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use PDO;

class TestingController extends Controller
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
    public function encrypteddata(Request $request){
        
        try{

            // dd($request->all());
            // dd($request->user_id);
            $iv = "fedcba9876543210"; #Same as in JAVA
			$key = "0a9b8c7d6e5f4g3h"; #Same as in JAVA

            $data_payload = $request->all();
            foreach($data_payload as $key_value => $value){
            
                // echo $key_value .'++++++++++++++++++++++++' .$value;
                // echo '<br/>';
                $key_value = $this->decrypt($key, $iv, $key_value);
                $value = $this->decrypt($key, $iv, $value);
                // echo $key_value .'++++++++++++++++++++++++' .$value;
                // echo '<br/>';

            }
            
            // echo $key_value .'++++++++++++++++++++++++' .$value;
            // echo '<br/>';


            
            // $user_encrypted = $request->phone;   
            // // echo $user_encrypted;
            // echo '<br>';
            // $user_encrypted_ey = $this->encrypt($key, $iv, $user_encrypted);
            // echo $user_encrypted_ey;
            // echo '<br>';
            // $email_encrypted_dey = $this->decrypt($key, $iv, $user_encrypted_ey);
            // echo $email_encrypted_dey;
            // echo '<br>';
            // dd('end');
            
            
            

            // dd($value);
            // $data = User::join('usermetas', 'users.id', '=', 'usermetas.user_id')->take(100)->get(['users.id','users.role','users.name', 'users.email', 'users.phone', 'usermetas.*']);
            
            if($key_value == "email"){

                $data = User::where("email",$value)->take(10)->get();	

            }elseif($key_value == "phone"){

                $data = User::where("phone",$value)->take(10)->get();	

            }else{
                                
                dd("please send email and phone");
                
            }
            // dd($data);
            // $datajson = json_encode($data);    
            $error_code = 200;
            $error_message = "null";
            $iden = $this->encrypt($key, $iv, 'id');            
            $nameen = $this->encrypt($key, $iv, 'name');
            $emailen = $this->encrypt($key, $iv, 'email');
            $phoneen = $this->encrypt($key, $iv, 'phone');
            $email_verified_aten = $this->encrypt($key, $iv, 'email_verified_at');
            $roleen = $this->encrypt($key, $iv, 'role');
            $rolelabelen = $this->encrypt($key, $iv, 'rolelabel');
            $role_iden = $this->encrypt($key, $iv, 'role_id');
            $passworden = $this->encrypt($key, $iv, 'password');
            $verifieden = $this->encrypt($key, $iv, 'verified');
            $remember_tokenen = $this->encrypt($key, $iv, 'remember_token');
            $viaen = $this->encrypt($key, $iv, 'via');
            $deviceiden = $this->encrypt($key, $iv, 'deviceid');
            $FCMTokenen = $this->encrypt($key, $iv, 'FCMToken');
            $authiden = $this->encrypt($key, $iv, 'authid');
            $viamediumen = $this->encrypt($key, $iv, 'viamedium');

            $isSuccesse = $this->encrypt($key, $iv, 'isSuccess');
            $truee = $this->encrypt($key, $iv, 'true');
            $codee = $this->encrypt($key, $iv, 'code');
            $error_codee = $this->encrypt($key, $iv, $error_code);
            $datae = $this->encrypt($key, $iv, 'data');
            $messagee = $this->encrypt($key, $iv, 'message');
            // dd($error_message);
            $error_messagee = $this->encrypt($key, $iv, $error_message);
            
            
            // $isSuccesse = $this->decrypt($key, $iv, $isSuccesse);
            // $truee =  $this->decrypt($key, $iv, $truee);
            // $codee =  $this->decrypt($key, $iv, $codee);
            // $error_codee =  $this->decrypt($key, $iv, $error_codee);
            // $datae =  $this->decrypt($key, $iv, $datae);
            // $messagee =  $this->decrypt($key, $iv, $messagee);
            // $error_messagee =  $this->decrypt($key, $iv, $error_messagee);
            // $iden = $this->decrypt($key, $iv, $iden);
            // $nameen = $this->decrypt($key, $iv, $nameen);
            // $emailen = $this->decrypt($key, $iv, $emailen);
            // $phoneen = $this->decrypt($key, $iv, $phoneen);
            // $email_verified_aten = $this->decrypt($key, $iv, $email_verified_aten);
            // $roleen = $this->decrypt($key, $iv, $roleen);
            // $rolelabelen = $this->decrypt($key, $iv, $rolelabelen);
            // $role_iden = $this->decrypt($key, $iv, $role_iden);
            // $passworden = $this->decrypt($key, $iv, $passworden);
            // $verifieden = $this->decrypt($key, $iv, $verifieden);
            // $remember_tokenen = $this->decrypt($key, $iv, $remember_tokenen);
            // $viaen = $this->decrypt($key, $iv, $viaen);
            // $deviceiden = $this->decrypt($key, $iv, $deviceiden);
            // $FCMTokenen = $this->decrypt($key, $iv, $FCMTokenen);
            // $authiden = $this->decrypt($key, $iv, $authiden);
            // $viamediumen = $this->decrypt($key, $iv, $viamediumen);

            foreach($data as $key => $value){
                // dd($value['name']);
                $value_id = $this->encrypt($key, $iv, $value['id']);
                $name = $this->encrypt($key, $iv, $value['name']);
                $email = $this->encrypt($key, $iv, $value['email']);
                $phone = $this->encrypt($key, $iv, $value['phone']);
                $email_verified_at = $this->encrypt($key, $iv, $value['email_verified_at']);
                $role = $this->encrypt($key, $iv, $value['role']);
                $rolelabel = $this->encrypt($key, $iv, $value['rolelabel']);
                $role_id = $this->encrypt($key, $iv, $value['role_id']);
                $password = $this->encrypt($key, $iv, $value['password']);
                $verified = $this->encrypt($key, $iv, $value['verified']);
                $remember_token = $this->encrypt($key, $iv, $value['remember_token']);
                $via = $this->encrypt($key, $iv, $value['via']);
                $deviceid = $this->encrypt($key, $iv, $value['deviceid']);
                $FCMToken = $this->encrypt($key, $iv, $value['FCMToken']);
                $authid = $this->encrypt($key, $iv, $value['authid']);
                $viamedium = $this->encrypt($key, $iv, $value['viamedium']);

                // echo $key ."++++++++++++++++++++++". $value;
                // $value_id = $this->decrypt($key, $iv, $value_id);
                // $name = $this->decrypt($key, $iv, $name);
                // $email = $this->decrypt($key, $iv, $email);
                // $phone = $this->decrypt($key, $iv, $phone);
                // $email_verified_at = $this->decrypt($key, $iv, $email_verified_at);
                // $role = $this->decrypt($key, $iv, $role);
                // $rolelabel = $this->decrypt($key, $iv, $rolelabel);
                // $role_id = $this->decrypt($key, $iv, $role_id);
                // $password = $this->decrypt($key, $iv, $password);
                // $verified = $this->decrypt($key, $iv, $verified);
                // $remember_token = $this->decrypt($key, $iv, $remember_token);
                // $via = $this->decrypt($key, $iv, $via);
                // $deviceid = $this->decrypt($key, $iv, $deviceid);
                // $FCMToken = $this->decrypt($key, $iv, $FCMToken);
                // $authid = $this->decrypt($key, $iv, $authid);
                // $viamedium = $this->decrypt($key, $iv, $viamedium);

                $datavalue[$key][$iden] = $value_id;
                $datavalue[$key][$nameen] = $name;
                $datavalue[$key][$emailen] = $email;
                $datavalue[$key][$phoneen] = $phone;
                $datavalue[$key][$email_verified_aten] = $email_verified_at;
                $datavalue[$key][$roleen] = $role;
                $datavalue[$key][$rolelabelen] = $rolelabel;
                $datavalue[$key][$role_iden] = $role_id;
                $datavalue[$key][$passworden] = $password;
                $datavalue[$key][$verifieden] = $verified;
                $datavalue[$key][$remember_tokenen] = $remember_token;
                $datavalue[$key][$viaen] = $via;
                $datavalue[$key][$deviceiden] = $deviceid;
                $datavalue[$key][$FCMTokenen] = $FCMToken;
                $datavalue[$key][$authiden] = $authid;
                $datavalue[$key][$viamediumen] = $viamedium;
                // echo '<br/>';
                // echo '<hr/>';
            } 
            // dd($datavalue);
            // $reqtimevar = $this->decrypt($key, $iv, $datavalue[$id]);

            return Response::json(array(
                    $isSuccesse => $truee,
                    $codee      => $error_codee,
                    $datae      => $datavalue,
                    $messagee   => $error_messagee
            ), 200);
            // echo '<b>decrypt</b>';
            // echo '<hr>';
            
            // echo '<hr>';
            // echo $decrypttrip_id;
        }catch(Exception $e){

            dd($e->getMessage());            
    
        }
	}
	
	
}
