<?php

namespace App\Http\Controllers\Tenant\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return tenant_view('client.pages.dashboard.dashboard');
    }
}
