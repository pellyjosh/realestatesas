<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RealtorController extends Controller
{
    public function index()
    {
        return view('realtor.pages.dashboard');
    }

    public function profile()
    {
        return view('realtor.pages.profile');
    }
}
