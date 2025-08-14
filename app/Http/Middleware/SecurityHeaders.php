<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    /**
     * Handle an incoming request and add security headers
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Security Headers to fix "Path is set to Default" vulnerability
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        
        // Content Security Policy
        // $csp = "default-src 'self'; " .
        //        "script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com; " .
        //        "style-src 'self' 'unsafe-inline'; " .
        //        "img-src 'self' data: https:; " .
        //        "font-src 'self' https:; " .
        //        "connect-src 'self'; " .
        //        "media-src 'self'; " .
        //        "object-src 'none'; " .
        //        "child-src 'none'; " .
        //        "worker-src 'none'; " .
        //        "frame-ancestors 'none'; " .
        //        "form-action 'self'; " .
        //        "base-uri 'self'; " .
        //        "manifest-src 'self'";
        
        // $response->headers->set('Content-Security-Policy', $csp);
        
        // HTTP Strict Transport Security (HSTS)
        if ($request->secure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }
        
        // Permissions Policy (formerly Feature Policy)
        $response->headers->set('Permissions-Policy', 
            'camera=(), microphone=(), geolocation=(), payment=(), usb=(), magnetometer=(), accelerometer=(), gyroscope=()'
        );

        // Remove server signature
        $response->headers->remove('Server');
        $response->headers->remove('X-Powered-By');
        
        return $response;
    }
}