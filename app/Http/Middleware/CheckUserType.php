<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $type
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $type)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        if ($user->type !== $type) {
            // Redirect based on user type or show unauthorized page
            switch ($user->type) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'realtor':
                    return redirect()->route('realtor.dashboard');
                default:
                    return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
