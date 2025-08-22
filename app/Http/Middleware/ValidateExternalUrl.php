<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateExternalUrl
{
    public function handle(Request $request, Closure $next)
    {
        $url = $request->query('url');

        // Allowed trusted domains
        $allowedDomains = [
            'facebook.com',
            'twitter.com',
            'youtube.com',
            'instagram.com',
        ];

        if ($url) {
            $parsed = parse_url($url);
            $host = $parsed['host'] ?? '';

            // Domain whitelist check
            foreach ($allowedDomains as $domain) {
                if (str_ends_with($host, $domain)) {
                    return $next($request); // allow redirect
                }
            }

            // If not trusted → show warning page
            return response()->view('redirect-warning', ['url' => $url]);
        }

        return $next($request);
    }
}
