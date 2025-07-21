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
        // Convert is_enabled to boolean before validation
        $request->merge([
            'is_enabled' => filter_var($request->input('is_enabled'), FILTER_VALIDATE_BOOLEAN)
        ]);

        // If saving hero section, allow partial updates (only update what's sent)
        if ($sectionName === 'hero') {
            $section = HomeSection::firstOrNew(['name' => $sectionName]);
            $existingData = $section->data ?? [];
            $newData = $existingData;

            // Update hero_banner if a new file is uploaded
            if ($request->hasFile('hero_banner')) {
                $newData['hero_banner'] = $request->file('hero_banner')->store('public/hero_banners');
            }

            // Accept carousel_items array directly from the request (API/JSON)
            if ($request->has('carousel_items')) {
                $carousel_items = $request->input('carousel_items', []);
                // Handle file uploads for any new/updated images
                foreach ($carousel_items as $idx => $item) {
                    if ($request->hasFile("carousel_img_{$idx}")) {
                        $carousel_items[$idx]['signature_img'] = $request->file("carousel_img_{$idx}")->store('public/carousel_images');
                    }
                }
                $newData['carousel_items'] = $carousel_items;
                $newData['carousel_count'] = count($carousel_items);
            } else {
                // If not present, reconstruct carousel_items from indexed FormData fields
                $carousel_count = (int) $request->input('carousel_count', 0);
                if ($carousel_count > 0) {
                    $carousel_items = $existingData['carousel_items'] ?? [];
                    for ($idx = 0; $idx < $carousel_count; $idx++) {
                        // Start with the existing item if present
                        $item = $carousel_items[$idx] ?? [];
                        // Only update fields if present in the request
                        if ($request->has("carousel_writeup_{$idx}")) {
                            $item['signature_writeup'] = $request->input("carousel_writeup_{$idx}");
                        }
                        if ($request->has("carousel_title_{$idx}")) {
                            $item['hero_title'] = $request->input("carousel_title_{$idx}");
                        }
                        if ($request->has("carousel_cta_{$idx}")) {
                            $item['cta_button'] = $request->input("carousel_cta_{$idx}");
                        }
                        if ($request->hasFile("carousel_img_{$idx}")) {
                            $item['signature_img'] = $request->file("carousel_img_{$idx}")->store('public/carousel_images');
                        } else if (!isset($item['signature_img'])) {
                            // If no image in request or existing, set to null
                            $item['signature_img'] = null;
                        }
                        $carousel_items[$idx] = $item;
                    }
                    $newData['carousel_items'] = $carousel_items;
                    $newData['carousel_count'] = count($carousel_items);
                }
            }

            $request->merge(['data' => $newData]);
        }

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
        // For hero, data is already merged above; for others, just use input
        $section->data = $request->input('data', []);
        $section->save();

        return response()->json(['success' => true, 'message' => 'Section updated successfully.']);
    }
}
