<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesRequestController extends Controller
{
    public function index()
    {
        return view('realtor.pages.sales-request');
    }
}
