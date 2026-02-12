<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\DB;

class OTPService
{
    private $encryptionService;
    // private $apiUrl = 'https://service.fitindia.gov.in/api/v2/';
    private $apiUrl = 'http://localhost/fitindiaapigit/api/v2/';

    // Encryption constants
    private $iv = "fedcba9876543210";
    private $baseKey = "0a9b8c7d6e5f4g3h";

    public function __construct(EncryptionService $encryptionService)
    {
        $this->encryptionService = $encryptionService;
    }

    /**
     * Generate and send OTP to user
     */
    public function generateAndSendOTP(User $user, Request $request): array
    {
        try {
            $currentDateTime = time();

            // Prepare encrypted data for API
            $apiData = $this->prepareOTPApiData($user, $currentDateTime);

            // Call external OTP API
            $response = Http::timeout(30)->post($this->apiUrl . 'generateotpvtwo', $apiData);

            if ($response->successful() || 1 == 1) {
                // Store only meta info in cache (not OTP value, since API sends directly to user)
                $otpData = [
                    'generated_at' => time(),
                    'attempts'     => 0,
                    'resend_count' => 0,
                ];
                Cache::put('otp_' . $user->id, $otpData, now()->addMinutes(5));

                // Store session info (needed for verify/resend)
                session([
                    'otp_user_id' => $user->id,
                    'otp_email'   => $user->email,
                    'otp_phone'   => $user->phone,
                    'otp_generated_at' => time(),
                ]);

                Log::info('OTP sent successfully for user: ' . $user->email);

                return ['success' => true, 'message' => 'OTP sent successfully'];
            } else {
                Log::error('OTP API Error: ' . $response->body());
                return ['success' => false, 'message' => 'Failed to send OTP'];
            }
        } catch (\Exception $e) {
            Log::error('OTP Generation Failed: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Something went wrong'];
        }
    }


    /**
     * Verify OTP entered by user
     */
    public function verifyOTP(Request $request): \Illuminate\Http\JsonResponse
    {
        // Validate request
        $request->validate([
            'otp' => 'required|string|size:6'
        ]);

        $userId = session('otp_user_id');
        $user = User::find($userId);
        // dd($user);

        if (!$user) {
            return $this->errorResponse('Invalid session. Please login again.');
        }

        // Get cached OTP data
        $otpData = Cache::get('otp_' . $userId);

        if (!$this->isOTPSessionValid($otpData, $userId)) {
            return $this->errorResponse('OTP session expired. Please login again.');
        }

        // Check attempts and expiration
        if ($this->hasExceededAttempts($otpData, $userId)) {
            return $this->errorResponse('Too many OTP attempts. Please login again.');
        }

        if ($this->isOTPExpired($otpData, $userId)) {
            return $this->errorResponse('OTP expired. Please login again.');
        }

        // Verify OTP with external API
        // dd($request->otp);
        if ($this->verifyOTPWithAPI($user, $request->otp)) {
            // dd(5);
            return $this->handleSuccessfulOTPVerification($user, $request, $userId);
        }
        // dd(4);
        // Handle failed verification
        return $this->handleFailedOTPVerification($otpData, $userId);
    }

    /**
     * Resend OTP to user
     */
    public function resendOTP(Request $request): \Illuminate\Http\JsonResponse
    {
        $userId = session('otp_user_id');

        if (!$userId) {
            return response()->json([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ], 400);
        }

        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ], 404);
        }

        // Get existing OTP session data (if available)
        $otpData = Cache::get('otp_' . $userId, [
            'generated_at' => time(),
            'attempts'     => 0,
            'resend_count' => 0,
        ]);

        // Limit resend to 3 times
        if ($otpData['resend_count'] >= 3) {
            return response()->json([
                'status' => 'error',
                'message' => 'Resend limit exceeded. Please login again.'
            ], 400);
        }

        // Call external API to resend OTP
        $result = $this->generateAndSendOTP($user, $request);

        if (!empty($result['success']) && $result['success'] === true) {
            // Update OTP session meta info
            $otpData['generated_at'] = time();
            $otpData['attempts'] = 0; // reset attempts
            $otpData['resend_count']++;

            Cache::put('otp_' . $userId, $otpData, now()->addMinutes(5));

            return response()->json([
                'status' => 'success',
                'message' => 'OTP resent successfully'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to resend OTP. Please try again.'
        ], 400);
    }


    // === PRIVATE HELPER METHODS ===

    private function prepareOTPApiData(User $user, int $currentDateTime): array
    {
        // Encrypt request time
        $reqTimeEncrypt = $this->encryptionService->encrypt($this->baseKey, $this->iv, $currentDateTime);

        // Dynamic key for user data encryption
        $dynamicKey = $currentDateTime . 'fitind';

        // Encrypt user data
        $emailEncrypt = $this->encryptionService->encrypt($dynamicKey, $this->iv, $user->email ?? '');
        $phoneEncrypt = $this->encryptionService->encrypt($dynamicKey, $this->iv, $user->phone ?? '');

        return [
            'reqtime' => trim($reqTimeEncrypt),
            'email' => trim($emailEncrypt),
            'mobile' => trim($phoneEncrypt),
        ];
    }




    private function verifyOTPWithAPI(User $user, string $otp): bool
    {
        try {



            $currentDateTime = time();

            // Prepare API data
            $reqTimeEncrypt = $this->encryptionService->encrypt($this->baseKey, $this->iv, $currentDateTime);
            $otpEncrypt = $this->encryptionService->encrypt($this->baseKey, $this->iv, $otp);

            $dynamicKey = $currentDateTime . 'fitind';
            $phoneEncrypt = $this->encryptionService->encrypt($dynamicKey, $this->iv, $user->phone ?? '');

            // Call verification API
            $response = Http::timeout(30)->post($this->apiUrl . 'verifyingemail', [
                'reqtime' => trim($reqTimeEncrypt),
                'email' => trim($phoneEncrypt),
                'otp' => trim($otpEncrypt),
            ]);

            $curenttime = time();
            // $records = DB::table('userverifications')
			// 				->where('phone', "9818886995")
			// 				->orderBy('id', 'desc')
			// 				->first();
            // $encrypted = $this->cryptoJsAesEncrypt("passphrasepass", "true:truewrtsuss:$curenttime:$user->phone");
            // dd($encrypted);

            // Call verification API


            if ($response->successful()) {
                $responseData = $response->json();
                // return isset($responseData['success']) && $responseData['success'] === true;
                return isset($responseData['success']) && $responseData['success'] === true;
            }

            return false;
        } catch (\Exception $e) {
            Log::error('OTP API Verification Failed: ' . $e->getMessage());
            return false;
        }
    }

    private function isOTPSessionValid($otpData, int $userId): bool
    {
        return $otpData && $userId;
    }

    private function hasExceededAttempts($otpData, int $userId): bool
    {
        if ($otpData['attempts'] >= 3) {
            Cache::forget('otp_' . $userId);
            session()->flush();
            return true;
        }
        return false;
    }

    private function isOTPExpired($otpData, int $userId): bool
    {
        if (time() - $otpData['generated_at'] > 300) { // 5 minutes
            Cache::forget('otp_' . $userId);
            session()->flush();
            return true;
        }
        return false;
    }

    private function handleSuccessfulOTPVerification(User $user, Request $request, int $userId): \Illuminate\Http\JsonResponse
    {
        $credentials = session('login_credentials');

        if ($user && Auth::attempt($credentials)) {
            // Clean up
            Cache::forget('otp_' . $userId);
            session()->forget(['otp_user_id', 'otp_email', 'otp_phone', 'otp_generated_at', 'login_credentials']);

            // Security measures
            $request->session()->regenerate();

            // Clear login attempts
            $key = 'login-attempts:' . strtolower($user->email) . '|' . $request->ip();
            RateLimiter::clear($key);

            // $records = DB::table('userverifications')
			// 				->where('phone', "9818886995")
			// 				->orderBy('id', 'desc')
			// 				->first();
            // dd($user->phone);
            $curenttime = time();
            $encrypted = $this->cryptoJsAesEncrypt("passphrasepass", "true:truewrtsuss:$curenttime:$user->phone");

            return response()->json([
                'status' => $encrypted,
                'message' => 'Login successful',
                'redirect' => route('create-event')
            ]);
        }

        return $this->errorResponse('Login failed. Please try again.');
    }

    private function handleFailedOTPVerification($otpData, int $userId): \Illuminate\Http\JsonResponse
    {
        // Increment attempts
        // dd('111111');
        $otpData['attempts']++;
        Cache::put('otp_' . $userId, $otpData, now()->addMinutes(5));

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid OTP. ' . max(0, 3 - $otpData['attempts']) . ' attempts remaining.'
        ], 400);
    }

    private function errorResponse(string $message, int $code = 400): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);
    }

    function cryptoJsAesEncrypt($passphrase, $value){
        $salt = openssl_random_pseudo_bytes(8);
        $salted = '';
        $dx = '';
        while (strlen($salted) < 48) {
            $dx = md5($dx.$passphrase.$salt, true);
            $salted .= $dx;
        }
        $key = substr($salted, 0, 32);
        $iv  = substr($salted, 32,16);
        $encrypted_data = openssl_encrypt(json_encode($value), 'aes-256-cbc', $key, true, $iv);
        $data = array("ct" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "s" => bin2hex($salt));
        return json_encode($data);
    }
}
