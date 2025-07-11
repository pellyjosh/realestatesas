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
}
