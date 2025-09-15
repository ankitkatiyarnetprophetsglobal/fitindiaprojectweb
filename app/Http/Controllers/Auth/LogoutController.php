<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class LogoutController
{
    public function logoutSession(Request $request)
    {
        $userId = session('otp_user_id');

        if ($userId) {
            // Clear OTP cache + session
            Cache::forget('otp_' . $userId);
            session()->forget([
                'otp_user_id',
                'otp_email',
                'otp_phone',
                'otp_generated_at',
                'login_credentials'
            ]);
        }

        if (Auth::check()) {
            $user = Auth::user();
           
            $user->update(['session_id' => null]); //
        }

        // Laravel logout flow
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
