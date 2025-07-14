<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function onboarding()
    {
        $tenants = Tenant::all();
        Log::alert(['tenants' => $tenants]);
        return view('superadmin.dashboard', compact('tenants'));
    }

    public function storeTenant(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:tenants,domain',
        ]);

        // Validation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:tenants,domain',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'theme' => 'nullable|string|max:255',
            'primary_color' => 'nullable|string|max:7',
        ]);

        // Handle Logo Upload
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $domain = $request->domain;
            $logo = $request->file('logo');
            $logoName = $domain . '_' . time() . '.' . $logo->getClientOriginalExtension();
            $logoPath = $logo->storePubliclyAs('tenant-assets/logo/' . $domain, $logoName, 'public');
        }

        // Create Tenant
        $tenant = Tenant::create([
            'name' => $validatedData['name'],
            'domain' => $validatedData['domain'],
            'address' => $validatedData['address'] ?? null,
            'city' => $validatedData['city'] ?? null,
            'state' => $validatedData['state'] ?? null,
            'zip' => $validatedData['zip'] ?? null,
            'country' => $validatedData['country'] ?? null,
            'email' => $validatedData['email'] ?? null,
            'phone' => $validatedData['phone'] ?? null,
            'logo' => $logoPath,
            'theme' => $validatedData['theme'] ?? 'classic', // Default theme
            'primary_color' => $validatedData['primary_color'] ?? '#ff5733', // Default color
        ]);

        // Redirect
        return redirect()->route('superadmin.dashboard')->with('success', 'Tenant created successfully.');
    }

    public function LandingPage()
    {
        return view('superadmin.pages.landing-page');
    }

    public function index()
    {
        return view('superadmin.pages.index');
    }

    public function domains()
    {
        return view('superadmin.pages.domains');
    }

    public function templates()
    {
        return view('superadmin.pages.templates');
    }

    public function subscription()
    {
        return view('superadmin.pages.subscriptions');
    }

    public function admins()
    {
        return view('superadmin.pages.admins');
    }

    public function inbox()
    {
        return view('superadmin.pages.app.inbox');
    }

    public function mail()
    {
        return view('superadmin.pages.app.mail-single');
    }

    public function composeMail()
    {
        return view('superadmin.pages.app.compose-mail');
    }

    public function events()
    {
        return view('superadmin.pages.app.events');
    }

    public function contact()
    {
        return view('superadmin.pages.app.contact');
    }

    public function superAdminLogin()
    {
        return view('superadmin.auth.login');
    }

    public function superAdminRegister()
    {
        return view('superadmin.auth.register');
    }

    public function superAdminForgotPassword()
    {
        return view('superadmin.auth.forgot-password');
    }

    public function superAdminResetPassword()
    {
        return view('superadmin.auth.reset-password');
    }

    public function profile()
    {
        return view('superadmin.pages.profile');
    }

    public function domainView()
    {
        return view('superadmin.pages.domain-view');
    }
}
