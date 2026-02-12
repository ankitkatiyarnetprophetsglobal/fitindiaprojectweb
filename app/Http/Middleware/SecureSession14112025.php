<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SecureSession
{
    private function ipPrefix($ip)
    {
        $o = explode('.', $ip);
        return isset($o[2]) ? "{$o[0]}.{$o[1]}.{$o[2]}" : $ip;
    }

    private function fp(Request $request): string
    {
        $ua = $request->header('User-Agent', '');
        $ip = $request->ip() ?? '0.0.0.0';
        $secret = config('app.key');
        return hash_hmac('sha256', $ua . '|' . $this->ipPrefix($ip), $secret);
    }

    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('uid')) {
            return response('Unauthorized', 401);
        }

        if (!Session::has('fp') || !hash_equals(Session::get('fp'), $this->fp($request))) {
            Session::flush();
            return response('Session invalid', 401);
        }

        // Timeout after 30 min
        if (now()->timestamp - (Session::get('last_active', 0)) > 1800) {
            Session::flush();
            return response('Session expired', 401);
        }

        // Update last activity
        Session::put('last_active', now()->timestamp);

        return $next($request);
    }

    // Utility for login
    public static function onLogin($userId, Request $request)
    {
        Session::flush();
        Session::regenerate(true);
        Session::put('uid', $userId);
        Session::put('fp', (new static)->fp($request));
        Session::put('last_active', now()->timestamp);
    }
}
