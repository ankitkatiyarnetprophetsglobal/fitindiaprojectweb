<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\SendMailreset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RequestHelper;//updatePassword

class GeneralController extends Controller
{
    
	private $OPENSSL_CIPHER_NAME = "aes-128-cbc"; //Name of OpenSSL Cipher 
  private $CIPHER_KEY_LEN = 16; //128 bits
	
	// old this is working code
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
	
	// End old working code

	function convertmethod(Request $request){
		try{
			
			dd('convertmethod');
            $currentdatetime = time();            
            $iv = "fedcba9876543210"; #Same as in JAVA
            $key = "0a9b8c7d6e5f4g3h"; #Same as in JAVA
            $key = $currentdatetime.'fitind';

		}catch (Exception $e) {
			
			return response()->json(['error' => $e->getMessage()]);
			
		}
	}

	
}