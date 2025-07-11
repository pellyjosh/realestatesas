<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.pages.dashboard');
    }

    public function addAdmin()
    {
        return view('admin.pages.manage-admins.add-admin');
    }

    public function editAdmin()
    {
        return view('admin.pages.manage-admins.edit-admin');
    }

    public function allAdmins()
    {
        return view('admin.pages.manage-admins.all-admin');
    }

    public function addAdminWizard()
    {
        return view('admin.pages.manage-admins.add-admin-wizard');
    }

    public function adminInvoice()
    {
        return view('admin.pages.manage-admins.admin-invoice');
    }
}
