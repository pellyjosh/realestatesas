<?php

namespace App\Http\Controllers\Tenant\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\TenantUser as User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ReferralsController extends Controller
{
    public function index()
    {
        $user = Auth::guard('tenant')->user();

        $referrals = User::where('referred_by_code', $user->referred_code)
            ->where('id', '!=', $user->id)
            ->select(['id', 'name', 'email', 'phone', 'created_at'])
            ->get();

        return tenant_view('realtor.pages.referrals', [
            'referrals' => $referrals,
        ]);
    }

    public function create(Request $request)
    {
        Log::alert([$request->all()]);
        $authUser = Auth::guard('tenant')->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed',  Rules\Password::defaults()],
            'image' => ['nullable', 'image', 'max:2048'],
            'referred_by_code' => [
                'nullable',
                'string',
                'exists:users,referral_code',
            ],
        ]);

        // Generate unique referral code
        do {
            $referralCode = Str::random(10);
        } while (User::where('referral_code', $referralCode)->exists());

        $imagePath = null;
        if ($request->hasFile('image')) {
            $tenantId = tenant()->id ?? 'default';
            $imagePath = $request->file('image')->store("tenant_{$tenantId}/users", 'public');
        }

        $referralUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'referral_code' => $referralCode,
            'referred_by_code' => $request->referred_by_code ?? $authUser->referral_code,
            'image_url' => $imagePath,
            'type' => 'realtor',
        ]);

        return response()->json([
            'message' => 'Referral added successfully!',
            'referral' => $referralUser,
        ], 201);
    }
}
