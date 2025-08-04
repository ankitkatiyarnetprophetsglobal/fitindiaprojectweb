<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, Response;
use App\Models\Trackingpic;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\MobileVersion;
use App\Models\Usermeta;
use PDO;

class CommontypeController extends Controller
{
    private $OPENSSL_CIPHER_NAME = "aes-128-cbc"; //Name of OpenSSL Cipher 
    private $CIPHER_KEY_LEN = 16; //128 bits

    function deletedusersbyemail(Request $request) {
        
        $user = User::findOrFail($id);
		User::where('id', $id)->delete();	 
		//$usermetas = User::where('id', $user->id)->get();		
		DB::table('usermetas')->where('user_id', $id)->delete();
        // dd($request->all());
        // dd($request->phone);
        // $email = $request->email;
        // $data = User::where('phone', $email)->get();
        // foreach($data as $value){
        //     echo '<table border="1">';
        //         echo '<tr>';
        //         echo '<td>' .$value['id'] .'</td>' .'<td>' .$value['name'] .'</td>' .'<td>' .$value['email'].'</td>' .'<td>' .$value['phone'].'</td>' ; 
        //         echo '</tr>';
        //         echo '<br/>';
        //     echo '</table>';
        // }
        // $usermeta_data = Usermeta::where('user_id', 1)->get();
        // dd($usermeta_data);
        // dd($data);
    }  
    
    function get_version(Request $request) {
        $id = $request['id'];
        $versions = MobileVersion::where([['status', 1],['id','=',$id]])->orderBy('created_date', 'desc')->get();
        // dd($SchoolWeek);
        if(count($versions) > 0){
            return Response::json(array(
                'isSuccess' => 'true',
                'code'      => 200,
                'data'      => $versions,
                'message'   => null
            ), 200);
        }else{
            $error_code = 200;
            $error_message = "Data not found";
            $data = null;

            return Response::json(array(
                'isSuccess' => 'true',
                'code'      => $error_code,
                'data'      => $data,
                'message'   => $error_message
            ), 200);
        }
		
    }  
    
    function version_update(Request $request) {
        $id = $request['id'];
        $version_id = $request['version'];
        $versions = MobileVersion::where([['status', 1],['id','=',$id]])->orderBy('created_date', 'desc')->get();
        // dd($SchoolWeek);
        if(count($versions) > 0){
            $Mobile_data = MobileVersion::where('status', 1)->where('id', $id)->update(['version' => $version_id]); 


            $newversions = MobileVersion::where([['status', 1],['id','=',$id]])->orderBy('created_date', 'desc')->get();
            
            // dd($Mobile_data);
            if($Mobile_data > 0){
                return Response::json(array(
                    'isSuccess' => 'true',
                    'code'      => 200,
                    'data'      => $newversions,
                    'message'   => null
                ), 200);
            }else{

                $error_code = 200;
                $error_message = null;
                $data = "Something went wrong please check";

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => $data,
                    'message'   => $error_message
                ), 200);
            }
        }else{
            $error_code = 200;
                    $error_message = null;
                    $data = "Data not found";

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => $data,
                        'message'   => $error_message
                    ), 200);
        }
		
    }  
}
