<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function index()
    {
        return view('admin.pages.authentication.login');
    }

    public function showSignupForm()
    {
        return view('admin.pages.authentication.signup');
    }

    public function notfound()
    {
        return view('admin.pages.authentication.404');
    }
}
