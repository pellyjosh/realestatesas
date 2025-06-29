<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RealtorAuthenticationController extends Controller
{
    public function showLoginForm()
    {
        return view('realtor.pages.authentication.login');
    }

    public function showSignupForm()
    {
        return view('realtor.pages.authentication.signup');
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
        return view('realtor.pages.authentication.404');
    }
}
