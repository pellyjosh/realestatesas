<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RealtorTypesController extends Controller
{
    public function houseIndex()
    {
        return view('realtor.pages.types.family-house');
    }
}
