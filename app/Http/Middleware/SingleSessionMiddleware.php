<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class SingleSessionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
        $user = Auth::user();
        $currentSessionId = Session::getId();
        
        // If session ID exists in DB but doesn't match, logout the user
        if (!empty($user->session_id) && $user->session_id !== $currentSessionId) {
            Log::info('Session mismatch detected for user ID: ' . $user->id, [
                'stored_session' => $user->session_id,
                'current_session' => $currentSessionId,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
            
            // Clear the session ID from database before logout
            $user->update(['session_id' => null]);
            
            Auth::logout();
            Session::invalidate();
            Session::regenerateToken();
            
            return redirect('/login')->withErrors([
                'email' => 'You have been logged out because your account was accessed from another device.',
            ]);
        }
        
        // Update session ID if it doesn't match (but don't logout)
        if ($user->session_id !== $currentSessionId) {
            $user->update(['session_id' => $currentSessionId]);
        }
    }

        return $next($request);
    }
}
