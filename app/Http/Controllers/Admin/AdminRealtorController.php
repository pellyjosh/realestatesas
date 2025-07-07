<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminRealtorController extends Controller
{
    public function realtorProfileIndex()
    {
        return view('admin.pages.realtor.realtor-profile');
    }

    public function addRealtorIndex()
    {
        return view('admin.pages.realtor.add-realtor');
    }
    
    public function addRealtorWizardIndex()
    {
        return view('admin.pages.realtor.add-realtor-wizard');
    }

    public function editRealtorIndex()
    {
        return view('admin.pages.realtor.edit-realtor');
    }

    public function allRealtorIndex()
    {
        return view('admin.pages.realtor.all-realtor');
    }

    public function RealtorInvoiceIndex()
    {
        return view('admin.pages.realtor.realtor-invoice');
    }
}
