<?php

namespace App\Http\Controllers\Tenant\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tenant\TenantUser as User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Http\UploadedFile;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request)
    {
        $referralCode = $request->query('ref');

        return tenant_view('auth.register', [
            'referralCode' => $referralCode,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    // use Illuminate\Support\Facades\Storage;

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // 'image' => ['nullable', 'image', 'max:2048'],
            'referred_by_code' => [
                'nullable',
                'string',
                Rule::exists('users', 'referral_code')->whereNot('id', Auth::id())
            ],
        ]);

        // Generate unique referral code


        // Store image in a per-tenant folder
        $imagePath = null;
        if ($request->hasFile('image')) {
            $tenantId = tenant()->id ?? 'default'; // fallback if tenant()->id is not available
            $imagePath = $request->file('image')->store("tenant_{$tenantId}/users", 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'referred_by_code' => $request->referred_by_code,
            'image_url' => $imagePath,
        ]);

        event(new Registered($user));

        Auth::guard('tenant')->login($user);

        return redirect(route('tenant.user.dashboard', absolute: false));
    }
}
