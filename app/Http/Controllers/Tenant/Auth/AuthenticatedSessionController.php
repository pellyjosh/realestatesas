<?php

namespace App\Http\Controllers\Tenant\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return tenant_view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */

    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->safe()->only(['email', 'password']);

        // Attempt authentication via tenant guard
        if (!Auth::guard('tenant')->attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Invalid login credentials.',
            ]);
        }

        // Regenerate session on successful login
        $request->session()->regenerate();

        // Get the authenticated user
        $user = Auth::guard('tenant')->user();

        // Redirect based on user type
        $routeName = match ($user->type) {
            'admin' => 'tenant.admin.dashboard',
            'realtor' => 'tenant.realtor.dashboard',
            default => 'tenant.user.dashboard',
        };

        return redirect()->intended(route($routeName));
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('tenant')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
