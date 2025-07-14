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
        $guard = 'tenant';

        if (!Auth::guard($guard)->check()) {
            return redirect()->route('tenant.login');
        }

        $user = Auth::guard($guard)->user();

        if ($user->type !== $type) {
            // Redirect based on user type
            return match ($user->type) {
                'admin' => redirect()->route('tenant.admin.dashboard'),
                'realtor' => redirect()->route('tenant.realtor.dashboard'),
                default => redirect()->route('tenant.client.home'),
            };
        }

        return $next($request);
    }
}
