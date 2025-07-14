<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LimitRequestsByIp
{
    public function handle(Request $request, Closure $next, $type)
    {
        $ip = $request->ip();
        $now = now();

        // Set limits based on $type: 'registration', 'otp', or 'rating'
        $limits = [
            // 'registration' => [3, 1440], // 3 requests/day
            'registration' => [100, 1], // 3 requests/day
            'otp' => [5, 10],            // 5 requests/10 min
            'rating' => [1, 1440],       // 1 request/day per item
        ];

        if (!isset($limits[$type])) {
            return $next($request); // Skip if type is invalid
        }

        [$maxAttempts, $minutes] = $limits[$type];

        // Build a cache key (or check DB logs if you prefer that method)
        $key = "ip:$ip:$type";

        $attempts = cache()->get($key, 0);

        if ($attempts >= $maxAttempts) {
            // return response()->json([
            //     'message' => "Too many $type requests from this IP. Please try again later."
            // ], 429);
            abort(429);
        }

        // Increment the count and set expiry
        cache()->put($key, $attempts + 1, now()->addMinutes($minutes));

        return $next($request);
    }
}
