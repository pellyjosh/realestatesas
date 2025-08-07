<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Tenant\Admin\HomeSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    /**
     * Toggle featured status for a property.
     */
    public function toggleFeatured(Request $request, $propertyId)
    {
        $homeSection = HomeSection::firstOrCreate(['name' => 'featured'], [
            'data' => ['limit' => 6, 'title' => 'featured property', 'selected' => []],
            'is_enabled' => true,
        ]);

        // Clean up selected property IDs before checking limit
        $propertyIds = Property::pluck('id')->toArray();
        if (isset($homeSection->data['selected']) && is_array($homeSection->data['selected'])) {
            $filtered = collect($homeSection->data['selected'])
                ->filter(function ($item) use ($propertyIds) {
                    $id = is_array($item) ? ($item['property_id'] ?? null) : $item;
                    return $id && in_array($id, $propertyIds);
                })
                ->values()
                ->all();
            if (count($filtered) !== count($homeSection->data['selected'])) {
                $homeSection->data = array_merge($homeSection->data, ['selected' => $filtered]);
                $homeSection->save();
            }
        }

        if ($homeSection->hasProperty($propertyId)) {
            $homeSection->removeProperty($propertyId);
            $action = 'removed from';
        } else {
            if ($homeSection->isAtLimit()) {
                return response()->json(['success' => false, 'message' => 'Limit reached for featured properties'], 400);
            }
            $homeSection->addProperty($propertyId);
            $action = 'added to';
        }

        return response()->json([
            'success' => true,
            'message' => "Property $action featured successfully!",
            'homeSection' => $homeSection
        ]);
    }

    /**
     * Toggle latest for sale status for a property.
     */
    public function toggleLatest(Request $request, $propertyId)
    {
        $homeSection = HomeSection::firstOrCreate(['name' => 'properties'], [
            'data' => ['limit' => 6, 'title' => 'Latest For Sale', 'selected' => []],
            'is_enabled' => true,
        ]);

        // Clean up selected property IDs before checking limit
        $propertyIds = Property::pluck('id')->toArray();
        if (isset($homeSection->data['selected']) && is_array($homeSection->data['selected'])) {
            $filtered = collect($homeSection->data['selected'])
                ->filter(function ($item) use ($propertyIds) {
                    $id = is_array($item) ? ($item['property_id'] ?? null) : $item;
                    return $id && in_array($id, $propertyIds);
                })
                ->values()
                ->all();
            if (count($filtered) !== count($homeSection->data['selected'])) {
                $homeSection->data = array_merge($homeSection->data, ['selected' => $filtered]);
                $homeSection->save();
            }
        }

        if ($homeSection->hasProperty($propertyId)) {
            $homeSection->removeProperty($propertyId);
            $action = 'removed from';
        } else {
            if ($homeSection->isAtLimit()) {
                return response()->json(['success' => false, 'message' => 'Limit reached for latest properties'], 400);
            }
            $homeSection->addProperty($propertyId);
            $action = 'added to';
        }

        return response()->json([
            'success' => true,
            'message' => "Property $action latest for sale successfully!",
            'homeSection' => $homeSection
        ]);
    }

    /**
     * Display a listing of the resource.
     */

    /**
     * Settings page for homepage sections (guarantee HomeSection cleanup for dropdowns)
     */
    public function settings()
    {
        $sections = HomeSection::all();
        $properties = Property::all();
        $featuredProperties = Property::whereIn('id', HomeSection::where('name', 'featured')->first()?->data['selected'] ?? [])->get();

        $propertyIds = $properties->pluck('id')->toArray();
        // Clean up selected property IDs in all HomeSections
        foreach ($sections as $section) {
            if (isset($section->data['selected']) && is_array($section->data['selected'])) {
                $filtered = collect($section->data['selected'])
                    ->filter(function ($item) use ($propertyIds) {
                        $id = is_array($item) ? ($item['property_id'] ?? null) : $item;
                        return $id && in_array($id, $propertyIds);
                    })
                    ->values()
                    ->all();
                if (count($filtered) !== count($section->data['selected'])) {
                    $section->data = array_merge($section->data, ['selected' => $filtered]);
                    $section->save();
                }
            }
        }

        return view('themes.classic.admin.pages.settings.section', compact('sections', 'properties', 'featuredProperties'));
    }

    public function listing()
    {
        $properties = Property::all();
        $propertyIds = $properties->pluck('id')->toArray();

        // Get home sections to check which properties are featured/latest
        $featuredSection = HomeSection::where('name', 'featured')->first();
        $latestSection = HomeSection::where('name', 'properties')->first();

        // Clean up selected property IDs in featured section
        if ($featuredSection && isset($featuredSection->data['selected']) && is_array($featuredSection->data['selected'])) {
            $filtered = collect($featuredSection->data['selected'])
                ->filter(function ($item) use ($propertyIds) {
                    // Support both array and int for property_id
                    $id = is_array($item) ? ($item['property_id'] ?? null) : $item;
                    return $id && in_array($id, $propertyIds);
                })
                ->values()
                ->all();
            if (count($filtered) !== count($featuredSection->data['selected'])) {
                $featuredSection->data = array_merge($featuredSection->data, ['selected' => $filtered]);
                $featuredSection->save();
            }
        }

        // Clean up selected property IDs in latest section
        if ($latestSection && isset($latestSection->data['selected']) && is_array($latestSection->data['selected'])) {
            $filtered = collect($latestSection->data['selected'])
                ->filter(function ($item) use ($propertyIds) {
                    $id = is_array($item) ? ($item['property_id'] ?? null) : $item;
                    return $id && in_array($id, $propertyIds);
                })
                ->values()
                ->all();
            if (count($filtered) !== count($latestSection->data['selected'])) {
                $latestSection->data = array_merge($latestSection->data, ['selected' => $filtered]);
                $latestSection->save();
            }
        }

        return tenant_view('admin.pages.my-properties.listing', compact('properties', 'featuredSection', 'latestSection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return tenant_view('admin.pages.my-properties.add-property');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'property_type' => 'required|string',
                'listing_type' => 'required|string',
                'status' => 'nullable|string',
                'description' => 'nullable|string',
                'slug' => 'nullable|string|unique:properties,slug',
                'address' => 'nullable|string',
                'city' => 'nullable|string',
                'state' => 'nullable|string',
                'postal_code' => 'nullable|string',
                'country' => 'nullable|string',
                'latitude' => 'nullable',
                'longitude' => 'nullable',
                'bedrooms' => 'nullable|integer|min:0',
                'bathrooms' => 'nullable|integer|min:0',
                'parking_spaces' => 'nullable|integer|min:0',
                'land_size' => 'nullable|numeric|min:0',
                'built_area' => 'nullable|numeric|min:0',
                'year_built' => 'nullable|integer|min:1800|max:' . (date('Y') + 5),
                'price' => 'nullable|numeric|min:0',
                'price_per_sqm' => 'nullable|numeric|min:0',
                'price_per_plot' => 'nullable|numeric|min:0',
                'features' => 'nullable|array',
                'amenities' => 'nullable|array',
                'images' => 'nullable|array',
                'images.*' => 'file|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'videos' => 'nullable|array',
                'videos.*' => 'file|mimes:mp4,avi,mov,wmv',
                'virtual_tour_url' => 'nullable|url',
                'floor_plan' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
                'meta_description' => 'nullable|string|max:500',
                'meta_keywords' => 'nullable|string',
                'listed_at' => 'nullable|date',
                'expires_at' => 'nullable|date|after:listed_at',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Always return JSON for validation errors
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }

        // Set defaults
        $validatedData['status'] = $validatedData['status'] ?? 'available';
        $validatedData['country'] = $validatedData['country'] ?? 'Nigeria';
        $validatedData['listed_at'] = $validatedData['listed_at'] ?? now();

        // Generate slug if not provided
        if (empty($validatedData['slug'])) {
            $validatedData['slug'] = Str::slug($validatedData['name']);

            // Ensure unique slug
            $originalSlug = $validatedData['slug'];
            $counter = 1;
            while (Property::where('slug', $validatedData['slug'])->exists()) {
                $validatedData['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        // Handle file uploads
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties/images', 'public');
                $imagePaths[] = $path;
            }
            $validatedData['images'] = $imagePaths;
        }

        if ($request->hasFile('videos')) {
            $videoPaths = [];
            foreach ($request->file('videos') as $video) {
                $path = $video->store('properties/videos', 'public');
                $videoPaths[] = $path;
            }
            $validatedData['videos'] = $videoPaths;
        }

        if ($request->hasFile('floor_plan')) {
            $validatedData['floor_plan'] = $request->file('floor_plan')->store('properties/floor-plans', 'public');
        }

        // Handle single image field for backward compatibility
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('properties', 'public');
        }

        // Add user_id if authenticated
        if (Auth::guard('tenant')->check()) {
            $validatedData['user_id'] = Auth::guard('tenant')->id();
        }

        try {
            $property = Property::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Property created successfully!',
                'property' => $property->load('user'),
                'redirect' => route('tenant.admin.listing')
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create property: ' . $e->getMessage(),
                'errors' => [$e->getMessage()]
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return response()->json($property->load('user', 'sales', 'inspections'));
    }

    /** 
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return tenant_view('admin.pages.my-properties.edit-property', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'property_type' => 'required|string',
                'listing_type' => 'required|string',
                'status' => 'nullable|string',
                'description' => 'nullable|string',
                'slug' => 'nullable|string|unique:properties,slug,' . $property->id,
                'address' => 'nullable|string',
                'city' => 'nullable|string',
                'state' => 'nullable|string',
                'postal_code' => 'nullable|string',
                'country' => 'nullable|string',
                'latitude' => 'nullable',
                'longitude' => 'nullable',
                'bedrooms' => 'nullable|integer|min:0',
                'bathrooms' => 'nullable|integer|min:0',
                'parking_spaces' => 'nullable|integer|min:0',
                'land_size' => 'nullable|numeric|min:0',
                'built_area' => 'nullable|numeric|min:0',
                'year_built' => 'nullable|integer|min:1800|max:' . (date('Y') + 5),
                'price' => 'nullable|numeric|min:0',
                'price_per_sqm' => 'nullable|numeric|min:0',
                'price_per_plot' => 'nullable|numeric|min:0',
                'features' => 'nullable|array',
                'amenities' => 'nullable|array',
                'images' => 'nullable|array',
                'videos' => 'nullable|array',
                'virtual_tour_url' => 'nullable|url',
                'meta_description' => 'nullable|string|max:500',
                'meta_keywords' => 'nullable|string',
                'listed_at' => 'nullable|date',
                'expires_at' => 'nullable|date|after:listed_at',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }

        try {
            $property->update($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Property updated successfully!',
                'property' => $property->fresh()->load('user')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update property: ' . $e->getMessage(),
                'errors' => [$e->getMessage()]
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        try {
            // Delete associated files
            if ($property->images) {
                foreach ($property->images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }

            if ($property->videos) {
                foreach ($property->videos as $video) {
                    Storage::disk('public')->delete($video);
                }
            }

            if ($property->floor_plan) {
                Storage::disk('public')->delete($property->floor_plan);
            }

            if ($property->image) {
                Storage::disk('public')->delete($property->image);
            }

            $property->delete();

            return response()->json([
                'success' => true,
                'message' => 'Property deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete property: ' . $e->getMessage(),
                'errors' => [$e->getMessage()]
            ], 500);
        }
    }

    /**
     * Get property types for dropdown
     */
    public function getPropertyTypes()
    {
        return response()->json([
            'house' => 'House',
            'apartment' => 'Apartment',
            'condo' => 'Condominium',
            'townhouse' => 'Townhouse',
            'villa' => 'Villa',
            'land' => 'Land',
            'commercial' => 'Commercial',
            'office' => 'Office',
            'retail' => 'Retail',
            'warehouse' => 'Warehouse'
        ]);
    }

    /**
     * Get listing types for dropdown
     */
    public function getListingTypes()
    {
        return response()->json([
            'sale' => 'For Sale',
            'rent' => 'For Rent',
            'lease' => 'For Lease'
        ]);
    }

    /**
     * Get property statuses for dropdown
     */
    public function getPropertyStatuses()
    {
        return response()->json([
            'available' => 'Available',
            'sold' => 'Sold',
            'rented' => 'Rented',
            'pending' => 'Pending'
        ]);
    }
}
