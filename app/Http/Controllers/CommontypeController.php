<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, Response;
use App\Models\Trackingpic;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\MobileVersion;
use App\Models\Userleaderboardimages;
use App\Models\Eventorganizations;
use App\Models\Usermeta;
use PDO;

class CommontypeController extends Controller
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
        $encodedIV = base64_ode($iv);
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

        // dd(count($versions));

        if(count($versions) > 0){

            return Response::json(array(

                'isSuccess' => true,
                'code'      => 200,
                'data'      => $versions,
                'message'   => null

            ), 200);

        }else{

            $error_code = 200;
            $error_message = "Data not found";
            $data = null;

            return Response::json(array(

                'isSuccess' => false,
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

    function convertmethod(Request $request){
        // dd($request['value_convertmethod']);
        $currentdatetime = time();
        $iv = "fedcba9876543210"; #Same as in JAVA
        $key = "0a9b8c7d6e5f4g3h"; #Same as in JAVA
        $key = $currentdatetime.'fitind';
        $value_convertmethod_trim = $this->encrypt($key, $iv, $request['value_convertmethod']);
        echo $value_convertmethod_trim;
        $value_convertmethod_trim = $this->decrypt($key, $iv, $value_convertmethod_trim);
        echo '<br>';
        echo $value_convertmethod_trim;
    }

    function post_image_cycle_image(Request $request){

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'user_cycle_image' => 'required',
            'user_cycle_image' => 'required|image|mimes:jpg,png,gif,svg','pdf',
        ],[
            'user_id.required'=>'User id is required.',
            'user_cycle_image.required'=>'User cycle image Is required.',
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

        $user_id = $request->user_id;
        $year = date("Y/m");
        $abha_card = $request->file('user_cycle_image')->store('sunday_on_cycle/'.$year,['disk'=> 'uploads']);
        $user_cycle_image = url('wp-content/uploads/'.$abha_card);
        // dd($user_cycle_image);
        $data = Userleaderboardimages::
                                        where([['user_id', $user_id]])
                                        ->orderBy('id', 'DESC')->get();
        // dd($data[0]['id']);
        if($data->count() > 0){

            $update_query = Userleaderboardimages::where([
                                                            ['id', '=', $data[0]['id']],
                                                        ])
                                                        ->update([
                                                            'user_cycle_image' => $user_cycle_image
                                                        ]);
        }else{

            $userleaderboardimage = new Userleaderboardimages();
            $userleaderboardimage->user_id = $user_id;
            $userleaderboardimage->user_cycle_image = $user_cycle_image;
            $userleaderboardimage->status = 1;
            $userleaderboardimage->save();

        }

        $event_data = Userleaderboardimages::
                                    where([['user_id', $user_id]])
                                    ->orderBy('id', 'DESC')->get();

        if($event_data->count() > 0){

             return Response::json(array(
                'status'    => 'success',
                'code'      =>  200,
                'message'   =>  null,
                'data'      => $event_data,
            ), 200);

        }else{
            return Response::json(array(
                'status'    => 'error',
                'code'      =>  200,
                'message'   =>  'Data not found',
                'data'   => null,
            ), 401);
        }

    }

    function post_image_cycle_image_v2(Request $request){

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'user_cycle_image' => 'required',
            'user_cycle_image' => 'required|image|mimes:jpg,png,gif,svg','pdf',
        ],[
            'user_id.required'=>'User id is required.',
            'user_cycle_image.required'=>'User cycle image Is required.',
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

        $user_id = $request->user_id;
        $year = date("Y/m");
        $abha_card = $request->file('user_cycle_image')->store('sunday_on_cycle/'.$year,['disk'=> 'uploads']);
        $user_cycle_image = url('wp-content/uploads/'.$abha_card);
        // dd($user_cycle_image);
        $data = Userleaderboardimages::
                                        where([['user_id', $user_id]])
                                        ->orderBy('id', 'DESC')->get();
        // dd($data[0]['id']);
        if($data->count() > 0){

            $update_query = Userleaderboardimages::where([
                                                            ['id', '=', $data[0]['id']],
                                                        ])
                                                        ->update([
                                                            'user_cycle_image' => $user_cycle_image
                                                        ]);
        }else{

            $userleaderboardimage = new Userleaderboardimages();
            $userleaderboardimage->user_id = $user_id;
            $userleaderboardimage->user_cycle_image = $user_cycle_image;
            $userleaderboardimage->status = 1;
            $userleaderboardimage->save();

        }

        $event_data = Userleaderboardimages::
                                    where([['user_id', $user_id]])
                                    ->orderBy('id', 'DESC')->get();

        if($event_data->count() > 0){

             return Response::json(array(
                'status'    => 'success',
                'show_status'    => 'Image uploaded successfully,It will start reflecting after admin approved',
                'code'      =>  200,
                'message'   =>  null,
                'data'      => $event_data,
            ), 200);

        }else{
            return Response::json(array(
                'status'    => 'error',
                'code'      =>  200,
                'message'   =>  'Data not found',
                'data'   => null,
            ), 401);
        }

    }

}
