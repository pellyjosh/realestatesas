<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function houseIndex()
    {
        return view('admin.pages.types.family-house');
    }

    // public function addTypeIndex()
    // {
    //     return view('admin.types.add-type');
    // }

    // public function editTypeIndex()
    // {
    //     return view('admin.types.edit-type');
    // }

    // public function houseIndex()
    // {
    //     return view('admin.types.house');
    // }

    // public function apartmentIndex()
    // {
    //     return view('admin.types.apartment');
    // }
}
