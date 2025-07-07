<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    public function index()
    {
        return view('admin.pages.events');
    }

    // public function create()
    // {
    //     return view('admin.pages.events.create');
    // }

    // public function edit($id)
    // {
    //     return view('admin.pages.events.edit', compact('id'));
    // }
}
