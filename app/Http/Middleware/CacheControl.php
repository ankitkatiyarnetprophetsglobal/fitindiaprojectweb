<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request, Response, Redirect;

use Closure;
use PhpMyAdmin\Scripts;


class CacheControl
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

        // $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Permitted-Cross-Domain-Policies', 'master-only');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate, post-check=0, pre-check=0');
        $response->headers->set('Pragma', 'no-cache');
        // $response->headers->set('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT');
        
        // Or whatever you want it to be:
        // $response->header('Cache-Control');
        
        // return '/login';

        return $response;
    }
}