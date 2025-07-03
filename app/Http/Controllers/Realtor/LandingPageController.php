<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('realtor.pages.landing.landing-page-list');
    }

    public function show()
    {
        return view('realtor.pages.landing.landing-page');
    }
}