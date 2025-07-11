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
        return view('superadmin.manage-tenant', compact('tenants'));
    }
}
