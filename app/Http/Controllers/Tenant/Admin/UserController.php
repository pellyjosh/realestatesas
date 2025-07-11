<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.pages.manage-users.user-profile');
    }

    public function addUserIndex()
    {
        return view('admin.pages.manage-users.add-user');
    }

    public function addUserWizardIndex()
    {
        return view('admin.pages.manage-users.add-user-wizard');
    }

    public function editUserIndex()
    {
        return view('admin.pages.manage-users.edit-user');
    }
    
    public function allUsersIndex()
    {
        return view('admin.pages.manage-users.all-users');
    }
}
