<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;

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
        $events = Event::where('user_id', auth()->user()->id)->count();


        if (isset(auth()->user()->role)) {

            if (isset(auth()->user()->rolewise)) {

                if (auth()->user()->rolewise == 'cyclothon-2024') {
                    return 'list-events';
                }
            }
            if (auth()->user()->role == 'namo-fit-india-cycling-club') {
                return 'list-events';
            }
            if (auth()->user()->role == 'school') {
                return 'create-event';
            }
            return 'create-event';
        } else {
            return '/login';
        }

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

    public function cryptoJsAesDecrypt($passphrase, $jsonString)
    {
        $jsondata = json_decode($jsonString, true);
        $salt = hex2bin($jsondata["s"]);
        $ct = base64_decode($jsondata["ct"]);
        $iv  = hex2bin($jsondata["iv"]);
        $concatedPassphrase = $passphrase . $salt;
        $md5 = array();
        $md5[0] = md5($concatedPassphrase, true);
        $result = $md5[0];
        for ($i = 1; $i < 3; $i++) {
            $md5[$i] = md5($md5[$i - 1] . $concatedPassphrase, true);
            $result .= $md5[$i];
        }
        $key = substr($result, 0, 32);
        $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
        return json_decode($data, true);
    }
   public function login(Request $request)
    {    
        // Enhanced rate limiting
        $key = 'login-attempts:' . $request->ip();
    
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'email' => ["Too many login attempts. Please try again in {$seconds} seconds."],
            ]);
        }
        
        $this->validateLogin($request);
        
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        
        try {
            // Decrypt password with proper error handling
            $password_encrypted = $this->cryptoJsAesDecrypt("64", $request->password);
            
            // Additional password validation
            if (empty($password_encrypted) || strlen($password_encrypted) > 255) {
                RateLimiter::hit($key, 900); // 15 minutes
                throw ValidationException::withMessages([
                    'password' => ['Invalid password format.'],
                ]);
            }
            
            $request->merge([
                'password' => $password_encrypted,
            ]);
            
        } catch (\InvalidArgumentException $e) {
            RateLimiter::hit($key, 900);
            
            // Log security incident
            Log::warning('Login attempt with invalid encryption', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'email' => $request->email
            ]);
            
            throw ValidationException::withMessages([
                'password' => ['Invalid login credentials.'],
            ]);
        }
        
        if ($this->attemptLogin($request)) {
            // Clear rate limit on successful login
            RateLimiter::clear($key);
            
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }
        // Increment rate limiter on failed attempt
        RateLimiter::hit($key, 900);
        $this->incrementLoginAttempts($request);      
        return $this->sendFailedLoginResponse($request);
    }


    protected function validateLogin(Request $request)
    {
        $request->validate(
            [
                $this->username() => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[a-zA-Z0-9@._-]+$/' // Prevent injection attacks
                ],
                'password' => [
                    'required',
                    'string',
                    'max:2000' // Limit encrypted password length
                ],
                'captcha' => [
                    'required',
                    'captcha',
                    'max:10' // Limit captcha length
                ],
            ],
            [
                'captcha.required' => 'Captcha field is required.',
                'captcha.captcha' => 'Please fill correct value.',
                'email.regex' => 'Invalid email format.',
                'email.max' => 'Email too long.',
                'password.max' => 'Password format invalid.'
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
            $this->credentials($request),
            $request->boolean('remember')
        );
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
}
