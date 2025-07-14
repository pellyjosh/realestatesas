<?php

namespace App\Http\Controllers\Tenant\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        // $sales = Sale::all();
        return tenant_view('realtor.pages.sales', ['sales' => [], 'properties' => []]);
    }
}
