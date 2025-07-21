<?php

namespace App\Http\Controllers\Tenant\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import the HomeSection model
use App\Models\Tenant\Admin\HomeSection; 

class ClientSectionController extends Controller
{
    public function index()
    {
        // Fetch all sections for the client view
        $sections = HomeSection::all()->keyBy('name');
        return tenant_view('client.pages.index', compact('sections'));
    }
}
