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
        // Get all sections
        $sections = HomeSection::all();

        // Get all properties for dropdowns 
        $properties = Property::select('id', 'name')->get();

        // Get featured properties from the database
        $featuredSection = HomeSection::where('name', 'featured')->first();
        $featuredProperties = collect();

        if ($featuredSection && isset($featuredSection->data['selected'])) {
            $featuredPropertyIds = collect($featuredSection->data['selected'])
                ->pluck('property_id')
                ->filter()
                ->toArray();

            if (!empty($featuredPropertyIds)) {
                $featuredProperties = Property::whereIn('id', $featuredPropertyIds)
                    ->select('id', 'name', 'price', 'city', 'state', 'address', 'property_type', 'images', 'image', 'description')
                    ->get();
            }
        }

        // Get all realtors for the Realtor section
        $realtors = \App\Models\Tenant\Realtor::select('id', 'first_name', 'last_name')->get();
        // Add a 'name' attribute for dropdown display
        $realtors->map(function ($r) {
            $r->name = trim($r->first_name . ' ' . $r->last_name);
            return $r;
        });

        return tenant_view('admin.pages.settings.section', [
            'sections' => $sections,
            'properties' => $properties,
            'featuredProperties' => $featuredProperties,
            'realtors' => $realtors,
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
                // Use the id sent from the frontend and preserve all item data
                foreach ($carousel_items as $idx => $item) {
                    // If the id is sent, use it; otherwise, fallback to $idx+1
                    $carousel_items[$idx]['id'] = isset($item['id']) ? $item['id'] : ($idx + 1);
                    // Only accept real file uploads or existing file paths, never base64
                    if ($request->hasFile("carousel_img_{$idx}")) {
                        $carousel_items[$idx]['signature_img'] = $request->file("carousel_img_{$idx}")->store('public/carousel_images');
                    } elseif (isset($item['signature_img']) && is_string($item['signature_img']) && strpos($item['signature_img'], 'public/carousel_images/') === 0) {
                        // Accept existing file path
                        $carousel_items[$idx]['signature_img'] = $item['signature_img'];
                    } else {
                        // Ignore base64 or invalid data
                        $carousel_items[$idx]['signature_img'] = null;
                    }
                }
                $newData['carousel_items'] = $carousel_items;
                $newData['carousel_count'] = count($carousel_items);
            } else {
                // Reconstruct carousel_items ONLY from the request fields, using ids sent from frontend
                $carousel_count = (int) $request->input('carousel_count', 0);
                $carousel_items = [];
                for ($idx = 0; $idx < $carousel_count; $idx++) {
                    $item = [];
                    // Use the id sent from the frontend if present
                    $item['id'] = $request->input("carousel_id_{$idx}", $idx + 1);
                    $item['signature_writeup'] = $request->input("carousel_writeup_{$idx}", '');
                    $item['hero_title'] = $request->input("carousel_title_{$idx}", '');
                    $item['cta_button'] = $request->input("carousel_cta_{$idx}", '');
                    if ($request->hasFile("carousel_img_{$idx}")) {
                        $item['signature_img'] = $request->file("carousel_img_{$idx}")->store('public/carousel_images');
                    } elseif ($request->has("carousel_img_path_{$idx}")) {
                        $item['signature_img'] = $request->input("carousel_img_path_{$idx}");
                    } else {
                        $item['signature_img'] = null;
                    }
                    $carousel_items[] = $item;
                }
                $newData['carousel_items'] = $carousel_items;
                $newData['carousel_count'] = count($carousel_items);
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

        // If hero section, return carousel_paths for frontend to update signature_img
        if ($sectionName === 'hero') {
            $carousel_paths = [];
            if (isset($section->data['carousel_items']) && is_array($section->data['carousel_items'])) {
                foreach ($section->data['carousel_items'] as $item) {
                    $carousel_paths[] = $item['signature_img'] ?? null;
                }
            }
            return response()->json([
                'success' => true,
                'message' => 'Section updated successfully.',
                'carousel_paths' => $carousel_paths
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Section updated successfully.']);
    }
}
