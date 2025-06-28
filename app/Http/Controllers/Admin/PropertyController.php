<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function addPropertyIndex()
    {
        return view('admin.pages.my-properties.add-property');
    }

    public function editPropertyIndex()
    {
        return view('admin.pages.my-properties.edit-property');
    }

    public function listingIndex()
    {
        return view('admin.pages.my-properties.listing');
    }

    public function favouritesIndex()
    {
        return view('admin.pages.my-properties.favourites');
    }
}
