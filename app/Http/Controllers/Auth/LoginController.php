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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    private $OPENSSL_CIPHER_NAME = "aes-128-cbc"; //Name of OpenSSL Cipher
    private $CIPHER_KEY_LEN = 16; //128 bits
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

    public function decryptAesGcm($passphrase, $jsonString)
    {
        $json = json_decode($jsonString, true);

        if (!isset($json['ct'], $json['iv'], $json['s'])) {
            throw new \Exception("Invalid encrypted payload");
        }

        // Decode
        $cipherTag = base64_decode($json['ct']);
        $iv = base64_decode($json['iv']);
        $salt = base64_decode($json['s']);

        // AES-GCM tag = last 16 bytes, ciphertext = rest
        $tag = substr($cipherTag, -16);
        $ciphertext = substr($cipherTag, 0, -16);

        // Derive key using PBKDF2
        $key = hash_pbkdf2("sha256", $passphrase, $salt, 100000, 32, true);

        // Decrypt
        $plaintext = openssl_decrypt(
            $ciphertext,
            'aes-256-gcm',
            $key,
            OPENSSL_RAW_DATA,
            $iv,
            $tag
        );

        if ($plaintext === false) {
            throw new \Exception("Decryption failed or data tampered");
        }

        return $plaintext;
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
        $key = 'login-attempts:' . strtolower($request->input('email')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'emailTomanyattampt' => ["Too many login attempts. Please try again in {$seconds} seconds."],
            ]);
        }

        $this->validateLogin($request);

        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        try {
            // Decrypt password with proper error handling
            $password_decrypt = $this->decryptAesGcm("64", $request->password);

            // Additional password validation
            if (empty($password_decrypt) || strlen($password_decrypt) > 255) {
                RateLimiter::hit($key, 900); // 15 minutes
                throw ValidationException::withMessages([
                    'password' => ['Invalid password format.'],
                ]);
            }

            $request->merge([
                'password' => $password_decrypt,
            ]);
        } catch (\InvalidArgumentException $e) {
            RateLimiter::hit($key, 900);
            throw ValidationException::withMessages([
                'password' => ['Invalid login credentials.'],
            ]);
        }

        // Check if credentials are valid BEFORE sending OTP
        $credentials = $request->only('email', 'password');
        if (!Auth::validate($credentials)) {
            RateLimiter::hit($key, 900);
            $this->incrementLoginAttempts($request);
            return $this->sendFailedLoginResponse($request);
        }

        // Credentials are valid, now send OTP
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Generate and send OTP
            $otp = $this->generateAndSendOTP($user, $request);

            if ($otp) {
                // Store temporary session data for OTP verification
                session([
                    'otp_user_id' => $user->id,
                    'otp_email' => $user->email,
                    'otp_phone' => $user->phone,
                    'otp_generated_at' => time(),
                    'login_credentials' => $credentials
                ]);

                // Return JSON response for AJAX or redirect with OTP modal flag
                if ($request->expectsJson()) {
                    return response()->json([
                        'status' => 'otp_required',
                        'message' => 'OTP sent successfully',
                        'phone_masked' => 'XXXXXXX' . substr($user->phone, -3),
                        'email_masked' => substr($user->email, 0, 2) . '********@' . explode('@', $user->email)[1]
                    ]);
                }

                return redirect()->back()->with([
                    'show_otp_modal' => true,
                    'otp_phone_masked' => 'XXXXXXX' . substr($user->phone, -3),
                    'otp_email_masked' => substr($user->email, 0, 2) . '********@' . explode('@', $user->email)[1]
                ]);
            }
        }

        // If OTP sending failed
        RateLimiter::hit($key, 900);
        return $this->sendFailedLoginResponse($request);
    }

    private function generateAndSendOTP($user, $request)
    {
        
        try {
            $currentDateTime = time();
            $iv  = "fedcba9876543210"; // Same as in JAVA
            $key = "0a9b8c7d6e5f4g3h"; // Same as in JAVA

            // Encrypt request time
            $reqTimeEncrypt = $this->encrypt($key, $iv, $currentDateTime);
            $reqTimeEncryptTrim = trim($reqTimeEncrypt);

            // Dynamic key based on current time
            $dynamicKey = $currentDateTime . 'fitind';

            $email = $user->email ?? '';
            $phone = $user->phone ??'';

            // Encrypt sensitive data
            $emailEncryptTrim = $this->encrypt($dynamicKey, $iv, $email);
            $phoneEncryptTrim = $this->encrypt($dynamicKey, $iv, $phone);

            // API Call
            $response = Http::post('https://service.fitindia.gov.in/api/v2/generateotpvtwo', [
                'reqtime' => $reqTimeEncryptTrim,
                'email'   => $emailEncryptTrim,
                'mobile'  => $phoneEncryptTrim,
            ]);
            $otp = rand(100000, 999999);
            $otpData = [
                'otp' => $otp,
                'generated_at' => time(),
                'attempts' => 0,
            ];
           Cache::put('otp_' . $user->id, $otpData, now()->addMinutes(5));
            if ($response->successful()) {
                return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
            } else {
                \Log::error('OTP API Error: ' . $response->body());
                return response()->json(['success' => false, 'message' => 'Failed to send OTP'], 500);
            }
        } catch (\Exception $e) {
            \Log::error('OTP Generation Failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Something went wrong'], 500);
        }
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6'
        ]);

        $userId = session('otp_user_id');
      
        $otpData = Cache::get('otp_' . $userId);
        
       

        if (!$otpData || !$userId) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP session expired. Please login again.'
            ], 400);
        }

        // Check OTP attempts
        if ($otpData['attempts'] >= 3) {
            Cache::forget('otp_' . $userId);
            session()->flush();
            return response()->json([
                'status' => 'error',
                'message' => 'Too many OTP attempts. Please login again.'
            ], 400);
        }

        // Check OTP expiration (5 minutes)
        if (time() - $otpData['generated_at'] > 300) {
            Cache::forget('otp_' . $userId);
            session()->flush();
            return response()->json([
                'status' => 'error',
                'message' => 'OTP expired. Please login again.'
            ], 400);
        }

        // Verify OTP
        if ($request->otp === $otpData['otp']) {
            // OTP is correct, complete login
            $user = User::find($userId);
            $credentials = session('login_credentials');

            if ($user && Auth::attempt($credentials)) {
                // Clear OTP data
                Cache::forget('otp_' . $userId);
                session()->forget(['otp_user_id', 'otp_email', 'otp_phone', 'otp_generated_at', 'login_credentials']);

                // Prevent session fixation
                $request->session()->regenerate();

                // Clear login attempts
                $key = 'login-attempts:' . strtolower($user->email) . '|' . $request->ip();
                RateLimiter::clear($key);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Login successful',
                    'redirect' => route('dashboard') // or wherever you want to redirect
                ]);
            }
        }

        // Increment attempts
        $otpData['attempts']++;
        Cache::put('otp_' . $userId, $otpData, now()->addMinutes(5));

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid OTP. ' . (3 - $otpData['attempts']) . ' attempts remaining.'
        ], 400);
    }

    public function resendOTP(Request $request)
    {
        $userId = session('otp_user_id');
       
        if (!$userId) {
            return response()->json([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ], 400);
        }

        $user = User::find($userId);

        if ($user) {
            $otpSent = $this->generateAndSendOTP($user, $request);

            if ($otpSent) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'OTP resent successfully'
                ]);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to resend OTP. Please try again.'
        ], 400);
    }

    function encrypt($key, $iv, $data)
    {

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

    private function sendOTPNotification($user, $otp)
    {
        dd($user);
        // Implement your SMS/Email service here
        // Example for email:
        // try {
        //     \Mail::to($user->email)->send(new \App\Mail\OTPMail($otp));
        // } catch (\Exception $e) {
        //     \Log::error('OTP Email sending failed: ' . $e->getMessage());
        // }

        // Example for SMS (implement your SMS service):
        // $this->sendSMS($user->phone_number, "Your OTP is: $otp");
    }

    public function loginold(Request $request)
    {
        // Enhanced rate limiting
        $key = 'login-attempts:' . strtolower($request->input('email')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'emailTomanyattampt' => ["Too many login attempts. Please try again in {$seconds} seconds."],
            ]);
        }

        $this->validateLogin($request);

        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        try {
            // Decrypt password with proper error handling

            $password_decrypt = $this->decryptAesGcm("64", $request->password);

            // Additional password validation
            if (empty($password_decrypt) || strlen($password_decrypt) > 255) {
                RateLimiter::hit($key, 900); // 15 minutes
                throw ValidationException::withMessages([
                    'password' => ['Invalid password format.'],
                ]);
            }

            $request->merge([
                'password' => $password_decrypt,
            ]);
        } catch (\InvalidArgumentException $e) {
            RateLimiter::hit($key, 900);
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
            // 🔒 Prevent session fixation / replay attacks
            $request->session()->regenerate();
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

        // Update session ID after regeneration
        $user = Auth::user();
        $user->update(['session_id' => Session::getId()]);

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
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
