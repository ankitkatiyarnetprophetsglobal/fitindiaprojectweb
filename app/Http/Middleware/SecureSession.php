<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SecureSession
{
    /**
     * Generate or return persistent browser ID
     */
    private function getBrowserId(Request $request): string
    {
        // If browser_id cookie already exists → use it
        if ($request->cookies->has('browser_id')) {
            return $request->cookies->get('browser_id');
        }

        // New browser ID (64 chars)
        $browserId = bin2hex(random_bytes(32));

        // Store cookie for 1 year
        cookie()->queue(cookie(
            'browser_id',
            $browserId,
            525600,    // minutes = 1 year
            '/',
            null,
            false,
            true,      // HttpOnly
            false,
            'Lax'
        ));

        return $browserId;
    }

    /**
     * Strong fingerprint with browser ID + user agent + IP
     */
    private function fingerprint(Request $request): string
    {
        $browserId = $this->getBrowserId($request);
        $ua = $request->header('User-Agent', '');
        $ip = $request->ip() ?? '0.0.0.0';
        $secret = config('app.key');

        return hash_hmac('sha256', "$browserId|$ua|$ip", $secret);
    }

    public function handle(Request $request, Closure $next): Response
    {
        // Not logged in
        if (!Session::has('uid')) {
            return response('Unauthorized', 401);
        }

        $currentFp = $this->fingerprint($request);

        // Fingerprint mismatch → possible hijack
        if (!Session::has('fp') || !hash_equals(Session::get('fp'), $currentFp)) {

            // Proper secure logout (no CSRF break)
            $request->session()->invalidate();     // Destroy session
            $request->session()->regenerateToken(); // New CSRF token

            return response('Session invalid', 401);
        }

        // Timeout (30 min)
        if (now()->timestamp - (Session::get('last_active', 0)) > 1800) {

            // Secure logout
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response('Session expired', 401);
        }

        // Update last activity
        Session::put('last_active', now()->timestamp);

        return $next($request);
    }

    /**
     * On login — regenerate session & set fingerprint (safe)
     */
    public static function onLogin($userId, Request $request)
    {
        // Destroy old session safely
        $request->session()->invalidate();

        // New session ID + new CSRF token
        $request->session()->regenerate();
        $request->session()->regenerateToken();

        // Store login-related data
        Session::put('uid', $userId);
        Session::put('fp', (new static)->fingerprint($request));
        Session::put('last_active', now()->timestamp);
    }
}
