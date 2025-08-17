<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Admin\HomeSection;
use App\Models\Property;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    /**
     * Toggle a realtor's presence on the homepage (add/remove realtor ID in HomeSection 'homepage_realtors').
     */
    public function toggleHomepage(Request $request, $realtorId)
    {
        $section = HomeSection::firstOrCreate(['name' => 'homepage_realtors']);
        $data = $section->data ?? [];
        $selected = isset($data['selected']) && is_array($data['selected']) ? $data['selected'] : [];
        $realtorId = (int) $realtorId;
        if (in_array($realtorId, $selected)) {
            // Remove
            $selected = array_values(array_diff($selected, [$realtorId]));
            $message = 'Realtor removed from homepage.';
        } else {
            $selected[] = $realtorId;
            $message = 'Realtor added to homepage.';
        }
        $data['selected'] = $selected;
        $section->data = $data;
        $section->save();
        return response()->json(['success' => true, 'message' => $message, 'selected' => $selected]);
    }
    public function index()
    {
        // Get all sections
        $sections = HomeSection::all();

        // Get all properties for dropdowns 
        $properties = Property::select('id', 'name', 'city')->get();

        // Get unique city names from properties
        $uniqueCities = Property::whereNotNull('city')
            ->where('city', '!=', '')
            ->distinct()
            ->pluck('city')
            ->sort()
            ->values()
            ->toArray();

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

        // Only show realtors that are selected for the homepage (in home_section with name 'realtor')
        $realtorSection = $sections->firstWhere('name', 'realtor');
        $selectedRealtorIds = collect($realtorSection->data['selected'] ?? [])->map(function ($item) {
            if (is_array($item) && isset($item['realtor_id'])) return $item['realtor_id'];
            return is_numeric($item) ? (int)$item : null;
        })->filter()->unique()->values();

        $realtors = collect();
        if ($selectedRealtorIds->count()) {
            $realtors = \App\Models\Tenant\Realtor::whereIn('id', $selectedRealtorIds)->select('id', 'first_name', 'last_name')->get();
            // Add a 'name' attribute for dropdown display
            $realtors->map(function ($r) {
                $r->name = trim($r->first_name . ' ' . $r->last_name);
                return $r;
            });
        }

        return tenant_view('admin.pages.settings.section', [
            'sections' => $sections,
            'properties' => $properties,
            'featuredProperties' => $featuredProperties,
            'realtors' => $realtors,
            'uniqueCities' => $uniqueCities,
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
                $path = $request->file('hero_banner')->store('public/hero_banners');
                // store() returns a path like "public/hero_banners/xxx.jpg"; convert to public URL
                $newData['hero_banner'] = Storage::url($path);
            } elseif ($request->has('hero_banner') && is_string($request->input('hero_banner')) && str_starts_with($request->input('hero_banner'), 'data:image')) {
                // Accept base64 hero_banner when provided (decode and store)
                $image = str_replace(' ', '+', $request->input('hero_banner'));
                $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
                if ($imageData !== false) {
                    $imageName = 'hero_banners/' . uniqid() . '.png';
                    Storage::disk('public')->put($imageName, $imageData);
                    $newData['hero_banner'] = Storage::url($imageName);
                }
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
                        $path = $request->file("carousel_img_{$idx}")->store('public/carousel_images');
                        $carousel_items[$idx]['signature_img'] = Storage::url($path);
                    } elseif (isset($item['signature_img']) && is_string($item['signature_img'])) {
                        // If an existing storage path was provided, accept it
                        if (strpos($item['signature_img'], 'public/carousel_images/') === 0) {
                            $carousel_items[$idx]['signature_img'] = Storage::url($item['signature_img']);
                        } elseif (str_starts_with($item['signature_img'], 'data:image')) {
                            // Decode base64 data URI and store to public disk
                            $image = str_replace(' ', '+', $item['signature_img']);
                            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
                            $imageName = 'carousel_images/' . uniqid() . '.png';
                            Storage::disk('public')->put($imageName, $imageData);
                            $carousel_items[$idx]['signature_img'] = Storage::url($imageName);
                        } else {
                            // If it's already a URL or other path, keep as-is
                            $carousel_items[$idx]['signature_img'] = $item['signature_img'];
                        }
                    } else {
                        // No image provided
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
                        $path = $request->file("carousel_img_{$idx}")->store('public/carousel_images');
                        $item['signature_img'] = Storage::url($path);
                    } elseif ($request->has("carousel_img_path_{$idx}")) {
                        $val = $request->input("carousel_img_path_{$idx}");
                        if (is_string($val) && str_starts_with($val, 'data:image')) {
                            $image = str_replace(' ', '+', $val);
                            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
                            $imageName = 'carousel_images/' . uniqid() . '.png';
                            Storage::disk('public')->put($imageName, $imageData);
                            $item['signature_img'] = Storage::url($imageName);
                        } elseif (is_string($val) && strpos($val, 'public/carousel_images/') === 0) {
                            $item['signature_img'] = Storage::url($val);
                        } else {
                            $item['signature_img'] = $val;
                        }
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

        // (normalize + dedupe). This ensures removes persist. If `cities` is not provided, don't change it.
        if ($sectionName === 'cities') {
            $incoming = $request->input('data', []);
            if (array_key_exists('cities', $incoming)) {
                $incomingCities = is_array($incoming['cities']) ? $incoming['cities'] : [];
                // normalize strings and remove empties
                $incomingCities = array_values(array_filter(array_map(function ($c) {
                    return is_string($c) ? trim($c) : $c;
                }, $incomingCities)));
                // dedupe while preserving order
                $incoming['cities'] = array_values(array_unique($incomingCities));
                $request->merge(['data' => $incoming]);
            }
        }

        // If saving testimonials as part of a section payload, accept base64 images and store them
        if ($sectionName === 'testimonials') {
            $incoming = $request->input('data', []);
            $items = $incoming['items'] ?? [];
            if (is_array($items) && count($items)) {
                foreach ($items as $i => $it) {
                    if (isset($it['image']) && is_string($it['image']) && str_starts_with($it['image'], 'data:image')) {
                        // decode and store the base64 image to public disk and replace with URL
                        $image = str_replace(' ', '+', $it['image']);
                        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
                        $imageName = 'testimonials/' . uniqid() . '.png';
                        Storage::disk('public')->put($imageName, $imageData);
                        $items[$i]['image'] = Storage::url($imageName);
                    }
                }
                $incoming['items'] = $items;
                $request->merge(['data' => $incoming]);
            }
        }

        $request->validate([
            'is_enabled' => 'required|boolean',
            'data' => 'nullable|array',
            'data.limit' => 'nullable|integer|min:1|max:6',
            'data.selected_properties' => 'nullable|array|max:6',
            'data.selected_properties.*' => 'exists:properties,id',
            'data.featured_limit' => 'nullable|integer|min:1|max:6',
            'data.featured_selected_properties' => 'nullable|array|max:6',
            'data.featured_selected_properties.*' => 'exists:properties,id',
        ]);


        $section = HomeSection::firstOrNew(['name' => $sectionName]);
        $section->is_enabled = $request->input('is_enabled');
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
                'carousel_paths' => $carousel_paths,
                'section' => $section->toArray()
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Section updated successfully.', 'section' => $section->toArray()]);
    }
}
