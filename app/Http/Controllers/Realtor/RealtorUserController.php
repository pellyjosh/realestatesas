<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RealtorUserController extends Controller
{
    public function index()
    {
        return view('realtor.pages.manage-users.user-profile');
    }

    public function addUserIndex()
    {
        return view('realtor.pages.manage-users.add-user');
    }

    public function addUserWizardIndex()
    {
        return view('realtor.pages.manage-users.add-user-wizard');
    }

    public function editUserIndex()
    {
        return view('realtor.pages.manage-users.edit-user');
    }

    public function allUsersIndex()
    {
        return view('realtor.pages.manage-users.all-users');
    }
}
