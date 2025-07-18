<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Admin\HomeSection;

class SectionController extends Controller
{
    public function index()
    {
        return tenant_view('admin.pages.section', [
            'sections' => HomeSection::all(),
        ]);
    }
}
