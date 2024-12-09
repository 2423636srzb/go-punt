<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class InactivityTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $role = Auth::user()->is_admin == 1 ? 'admin' : 'user'; // Assuming `role` is a field in your users table

            // Define timeouts based on roles (in seconds)
            $timeout = $role === 'admin' ? 86400 : 3600;

            $lastActivity = session('last_activity_time');
            $currentTime = now()->timestamp;

            // If last activity time exists and user is inactive for longer than timeout
            if ($lastActivity && ($currentTime - $lastActivity > $timeout)) {
                Auth::logout();
                session()->flush(); // Clear session
                return redirect()->route('login.view')->with('message', 'You have been logged out due to inactivity.');
            }

            // Update last activity time
            session(['last_activity_time' => $currentTime]);
        }

        return $next($request);
    }
}

