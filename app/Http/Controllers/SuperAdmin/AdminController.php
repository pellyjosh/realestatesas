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
