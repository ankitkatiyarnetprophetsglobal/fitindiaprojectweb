<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
	
	protected function redirectTo()
    {
		$events = Event::where( 'user_id', auth()->user()->id )->count();
		// dd(auth()->user()->rolewise);
        // if(auth()->user()->rolewise) == 'cyclothon-2024'){
            
            
            // dd("cyclothon-2024");
        
        if (isset(auth()->user()->role)){

                if (isset(auth()->user()->rolewise)){
                    
                    if(auth()->user()->rolewise == 'cyclothon-2024'){
                        // dd(auth()->user());
                        return 'list-events';

                    }
                }
                if(auth()->user()->role == 'namo-fit-india-cycling-club'){
                    // dd(auth()->user());
                    return 'list-events';

                }
                if (auth()->user()->role == 'school') {
                    /*if(!empty($events)){
                        //return '/my-events';
                        return '/create-event';
                    }else{
                        return '/fit-india-school-certification';
                    }*/
                    // return '/create-school-event'; // change 09082023
                    // return '/create-event';
                    return 'create-event';
                    // return '/create-freedomrun-event';
                }
                
                // if (
                //     auth()->user()->role == 'mexta' 
                //     || auth()->user()->role == 'mhrddsel' 
                //     || auth()->user()->role == 'mhrdhei' 
                //     || auth()->user()->role == 'mha' 
                //     || auth()->user()->role == 'mpng' 
                //     || auth()->user()->role == 'md' 
                //     || auth()->user()->role == 'mfinance'
                //     ) {
                // 	/*if(!empty($events)){
                // 		//return '/my-events';
                // return '/create-event';
                return 'create-event';
                // return 'create-school-event';
                //     }else{
                // 		return '/fit-india-school-certification';
                // 	}*/
                // return '/create-school-event'; // change 09082023
                //     return '/create-event';
                // }
                
                
                // if (auth()->user()->role == 'youthclub') {
                // 	if(!empty($events)){
                // 		//return '/my-events';
                //          return '/dashboard';
                // 	}else{
                // 		//return '/fit-india-youth-club-certificate';
                //         return '/dashboard';
                // 	}
                // }
        }else{
            return '/login';
        }
		
		
        // return '/create-event';
        // return '/dashboard';
        // return '/create-freedomrun-event';
        return '/create-event';
    }
	

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function cryptoJsAesDecrypt($passphrase, $jsonString){
	    $jsondata = json_decode($jsonString, true);
	    $salt = hex2bin($jsondata["s"]);
	    $ct = base64_decode($jsondata["ct"]);
	    $iv  = hex2bin($jsondata["iv"]);
	    $concatedPassphrase = $passphrase.$salt;
	    $md5 = array();
	    $md5[0] = md5($concatedPassphrase, true);
	    $result = $md5[0];
	    for ($i = 1; $i < 3; $i++) {
	        $md5[$i] = md5($md5[$i - 1].$concatedPassphrase, true);
	        $result .= $md5[$i];
	    }
	    $key = substr($result, 0, 32);
	    $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
	    return json_decode($data, true);
	}
    public function login(Request $request)
    {
        // dd($request->password);        
        // dd($request->all());
        $this->validateLogin($request);
        
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        // dd(123456);
        // if (!captcha_check($request->get('captcha'))){
        //     $error_meassage = "Invalid Captcha";
        //     // return response()->json(['success' => false, 'message' => $error_meassage, 'data' => null]);
        //     return $error_meassage;
        // }

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        
        $password_encrypted = $this->cryptoJsAesDecrypt("64", $request->password);
        // dd($password_encrypted);
        $request->merge([
            'password' => $password_encrypted,
        ]);
        if ($this->attemptLogin($request)) {
        
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        
        $this->incrementLoginAttempts($request);
        // dd(123456);
        // dd($request->all());        
        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'captcha' => ['required', 'captcha'],
        ],
        [        
            'captcha.required' => 'Captcha field is required.',
            'captcha.captcha' => 'Please fill correct value.'
        ]
        );
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->boolean('remember')
        );
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
    


}
