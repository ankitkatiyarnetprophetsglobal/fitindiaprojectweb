<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class RestrictHttpMethods
{
    /**
     * Handle an incoming request and block dangerous HTTP methods
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // ⭐ SECURITY FIX: Define allowed HTTP methods only
        $allowedMethods = ['GET', 'POST','PUT', 'HEAD','PATCH','DELETE'];

        // Get current request method
        $currentMethod = strtoupper($request->getMethod());

        // Block dangerous HTTP methods including OPTIONS
        $blockedMethods = ['OPTIONS', 'TRACE', 'CONNECT'];

        if (in_array($currentMethod, $blockedMethods)) {
            // Log security incident
            \Log::warning('Blocked HTTP method attempt', [
                'method' => $currentMethod,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'timestamp' => now()
            ]);

            // Return 405 Method Not Allowed
            return response()->json([
                'error' => 'Method Not Allowed',
                'message' => 'The requested HTTP method is not supported.',
                'allowed_methods' => $allowedMethods
            ], 405, [
                'Allow' => implode(', ', $allowedMethods),
                'X-Content-Type-Options' => 'nosniff',
                'X-Frame-Options' => 'DENY'
            ]);
        }

        // Check if method is in allowed list (additional security)
        if (!in_array($currentMethod, $allowedMethods)) {
            \Log::warning('Unrecognized HTTP method attempt', [
                'method' => $currentMethod,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            return response()->json([
                'error' => 'Method Not Allowed',
                'message' => 'Only GET, POST, and HEAD methods are allowed.',
                'allowed_methods' => $allowedMethods
            ], 405, [
                'Allow' => implode(', ', $allowedMethods)
            ]);
        }

        $response = $next($request);

        // Add security headers to response
        $response->headers->set('Allow', implode(', ', $allowedMethods));

        return $response;
    }
}
