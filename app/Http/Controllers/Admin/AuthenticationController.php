<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.pages.authentication.login');
    }

    public function showSignupForm()
    {
        return view('admin.pages.authentication.signup');
    }

    public function login(Request $request)
    {
        // Handle login logic here
    }

    public function signup(Request $request)
    {
        // Handle signup logic here
    }

    public function notfound()
    {
        return view('admin.pages.authentication.404');
    }
}
