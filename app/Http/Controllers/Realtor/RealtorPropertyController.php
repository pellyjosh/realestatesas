<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RealtorPropertyController extends Controller
{
    public function addPropertyIndex()
    {
        return view('realtor.pages.my-properties.add-property');
    }

    public function editPropertyIndex()
    {
        return view('realtor.pages.my-properties.edit-property');
    }

    public function listingIndex()
    {
        return view('realtor.pages.my-properties.listing');
    }

    public function favouritesIndex()
    {
        return view('realtor.pages.my-properties.favourites');
    }
}
