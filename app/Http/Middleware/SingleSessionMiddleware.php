<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class SingleSessionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $currentSessionId = Session::getId();

            // If user already has a session stored
            if (!empty($user->session_id) && $user->session_id !== $currentSessionId) {

                // Delete old session from sessions table
                DB::table('sessions')
                    ->where('id', $user->session_id)
                    ->delete();
            }

            // Update user with current session ID
            if ($user->session_id !== $currentSessionId) {
                $user->update(['session_id' => $currentSessionId]);
            }
        }

        return $next($request);
    }

}
