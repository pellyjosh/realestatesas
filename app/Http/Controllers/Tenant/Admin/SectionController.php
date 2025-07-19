<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Admin\HomeSection;
use App\Models\Property; // Import the Property model

class SectionController extends Controller
{
    public function index()
    {
        return tenant_view('admin.pages.settings.section', [
            'sections' => HomeSection::all(),
            'properties' => Property::select('id', 'name')->get(), // Fetch all properties for dropdowns
        ]);
    }

    public function store(Request $request, $sectionName)
    {
        $request->validate([
            'is_enabled' => 'required|boolean',
            'data' => 'nullable|array',
            'data.limit' => 'nullable|integer|min:1|max:6', // Validate limit for properties
            'data.selected_properties' => 'nullable|array|max:6', // Validate selected properties
            'data.selected_properties.*' => 'exists:properties,id', // Ensure selected properties exist
            'data.featured_limit' => 'nullable|integer|min:1|max:6', // Validate limit for featured properties
            'data.featured_selected_properties' => 'nullable|array|max:6', // Validate selected featured properties
            'data.featured_selected_properties.*' => 'exists:properties,id', // Ensure selected featured properties exist
        ]);

        $section = HomeSection::firstOrNew(['name' => $sectionName]);
        $section->is_enabled = $request->input('is_enabled');
        $section->data = $request->input('data', []);
        $section->save();

        return response()->json(['success' => true, 'message' => 'Section updated successfully.']);
    }
}
