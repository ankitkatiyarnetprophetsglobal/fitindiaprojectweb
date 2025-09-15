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
use App\Services\EncryptionService;
use App\Services\OTPService;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    
    private $encryptionService;
    private $otpService;

    public function __construct(EncryptionService $encryptionService, OTPService $otpService)
    {
        $this->middleware('guest')->except('logout');
        $this->encryptionService = $encryptionService;
        $this->otpService = $otpService;
    }

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

    public function login(Request $request)
    {

        
        // Rate limiting check
        if (!$this->checkRateLimit($request)) {
            return $this->handleRateLimitExceeded($request);
        }

        // Validate login request
        $this->validateLogin($request);

        // Check Laravel's built-in lockout
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // Decrypt and validate password
        $decryptedPassword = $this->handlePasswordDecryption($request);
        if (!$decryptedPassword) {
            return $this->handleDecryptionFailure($request);
        }

        $request->merge(['password' => $decryptedPassword]);

        // Validate credentials
        $credentials = $request->only('email', 'password');
        if (!Auth::validate($credentials)) {
            return $this->handleInvalidCredentials($request);
        }

        // Get user and send OTP
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return $this->handleOTPFlow($user, $request, $credentials);
        }

        return $this->handleLoginFailure($request);
    }

    public function verifyOTP(Request $request)
    {
       
        return $this->otpService->verifyOTP($request);
    }

    public function resendOTP(Request $request)
    {
        return $this->otpService->resendOTP($request);
    }

    // === PRIVATE HELPER METHODS ===

    private function checkRateLimit(Request $request): bool
    {
        $key = 'login-attempts:' . strtolower($request->input('email')) . '|' . $request->ip();
        return !RateLimiter::tooManyAttempts($key, 3);
    }

    private function handleRateLimitExceeded(Request $request)
    {
        $key = 'login-attempts:' . strtolower($request->input('email')) . '|' . $request->ip();
        $seconds = RateLimiter::availableIn($key);
        
        throw ValidationException::withMessages([
            'emailTomanyattampt' => ["Too many login attempts. Please try again in {$seconds} seconds."],
        ]);
    }

    private function handlePasswordDecryption(Request $request): ?string
    {
        try {
            $decryptedPassword = $this->encryptionService->decryptAesGcm("64", $request->password);
            
            if (empty($decryptedPassword) || strlen($decryptedPassword) > 255) {
                return null;
            }
            
            return $decryptedPassword;
        } catch (\Exception $e) {
            Log::error('Password decryption failed: ' . $e->getMessage());
            return null;
        }
    }

    private function handleDecryptionFailure(Request $request)
    {
        $key = 'login-attempts:' . strtolower($request->input('email')) . '|' . $request->ip();
        RateLimiter::hit($key, 900);
        
        throw ValidationException::withMessages([
            'password' => ['Invalid login credentials.'],
        ]);
    }

    private function handleInvalidCredentials(Request $request)
    {
        $key = 'login-attempts:' . strtolower($request->input('email')) . '|' . $request->ip();
        RateLimiter::hit($key, 900);
        $this->incrementLoginAttempts($request);
        
        return $this->sendFailedLoginResponse($request);
    }

    private function handleOTPFlow(User $user, Request $request, array $credentials)
    {
        $otpResult = $this->otpService->generateAndSendOTP($user, $request);
        
        if ($otpResult['success']) {
            // Store session data for OTP verification
            session([
                'otp_user_id' => $user->id,
                'otp_email' => $user->email,
                'otp_phone' => $user->phone,
                'otp_generated_at' => time(),
                'login_credentials' => $credentials
            ]);

            $responseData = [
                'status' => 'otp_required',
                'message' => 'OTP sent successfully',
                'phone_masked' => 'XXXXXXX' . substr($user->phone ?? '', -3),
                'email_masked' => $this->maskEmail($user->email)
            ];

            if ($request->expectsJson()) {
                return response()->json($responseData);
            }

            return redirect()->back()->with([
                'show_otp_modal' => true,
                'otp_phone_masked' => $responseData['phone_masked'],
                'otp_email_masked' => $responseData['email_masked']
            ]);
        }

        return $this->handleLoginFailure($request);
    }

    private function handleLoginFailure(Request $request)
    {
        $key = 'login-attempts:' . strtolower($request->input('email')) . '|' . $request->ip();
        RateLimiter::hit($key, 900);
        
        return $this->sendFailedLoginResponse($request);
    }

    private function maskEmail(string $email): string
    {
        $parts = explode('@', $email);
        return substr($parts[0], 0, 2) . '********@' . $parts[1];
    }

    // === VALIDATION METHODS ===

    protected function validateLogin(Request $request)
    {
        $request->validate(
            [
                $this->username() => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[a-zA-Z0-9@._-]+$/'
                ],
                'password' => [
                    'required',
                    'string',
                    'max:2000'
                ],
                'captcha' => [
                    'required',
                    'captcha',
                    'max:10'
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

    // === AUTHENTICATION METHODS ===

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

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