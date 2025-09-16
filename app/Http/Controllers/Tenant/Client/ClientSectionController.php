<?php

namespace App\Http\Controllers\Tenant\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import the HomeSection model
use App\Models\Tenant\Admin\HomeSection;
use App\Models\Property;
use Illuminate\Support\Facades\Log;

class ClientSectionController extends Controller
{
    public function index()
    {
        // Fetch all sections for the client view
        $sections = HomeSection::all()->keyBy('name');
        $latestSection = $sections['latest_properties'] ?? ($sections['latest'] ?? ($sections['latest-properties'] ?? null));

        if (!$latestSection) {
            $possibleNames = [
                'latest_properties',
                'latest',
                'latest-properties',
                'latest for sale',
                'latest-for-sale',
                'latest_for_sale',
                'latest_sale',
                'latest sale'
            ];
            $latestSection = HomeSection::whereIn('name', $possibleNames)->first();
        }

        if (!$latestSection) {
            $latestSection = HomeSection::where('name', 'like', '%latest%')
                ->where(function ($q) {
                    $q->where('name', 'like', '%sale%')->orWhere('name', 'like', '%sell%');
                })->first();
        }

        if ($latestSection && !empty($latestSection->data['selected'])) {
            $selected = collect($latestSection->data['selected'])
                ->map(function ($item) {
                    if (is_array($item)) {
                        return isset($item['property_id']) ? (int) $item['property_id'] : null;
                    }
                    return is_numeric($item) ? (int) $item : null;
                })
                ->filter()
                ->unique()
                ->values();

            if ($selected->isNotEmpty()) {
                $ids = $selected->all();
                $properties = Property::whereIn('id', $ids)->get()->sortBy(function ($p) use ($ids) {
                    return array_search($p->id, $ids);
                })->values();
            } else {
                $properties = Property::latest()->take(9)->get();
            }
        } else {
            $properties = Property::latest()->take(9)->get();
        }
        $rentSection = $sections['latest_rent'] ?? ($sections['latest-rent'] ?? ($sections['rent'] ?? null));

        if (!$rentSection) {
            $possibleRentNames = ['latest_rent', 'latest-rent', 'latest for rent', 'latest for-rent', 'rent', 'for_rent', 'for-rent'];
            $rentSection = HomeSection::whereIn('name', $possibleRentNames)->first();
        }

        if (!$rentSection) {
            // fuzzy: name contains 'rent'
            $rentSection = HomeSection::where('name', 'like', '%rent%')->first();
        }

        $rentProperties = collect();
        $rentDebug = ['used_section' => false, 'section_name' => null, 'selected_ids' => []];
        if ($rentSection && !empty($rentSection->data['selected'])) {
            $selectedRent = collect($rentSection->data['selected'])
                ->map(function ($item) {
                    if (is_array($item)) return isset($item['property_id']) ? (int) $item['property_id'] : null;
                    return is_numeric($item) ? (int) $item : null;
                })->filter()->unique()->values();

            if ($selectedRent->isNotEmpty()) {
                $ids = $selectedRent->all();
                $rentProperties = Property::whereIn('id', $ids)->get()->sortBy(function ($p) use ($ids) {
                    return array_search($p->id, $ids);
                })->values();
                $rentDebug['used_section'] = true;
                $rentDebug['section_name'] = $rentSection->name ?? null;
                $rentDebug['selected_ids'] = $ids;
            }
        }
        if ($rentProperties->isEmpty()) {
            try {
                $fallbackRent = Property::where(function ($q) {
                    $q->whereRaw("LOWER(COALESCE(status, '')) LIKE ?", ['%rent%'])
                        ->orWhereRaw("LOWER(COALESCE(property_type, '')) LIKE ?", ['%rent%'])
                        ->orWhereRaw("LOWER(COALESCE(listing_type, '')) LIKE ?", ['%rent%']);
                })->latest()->take(9)->get();

                if ($fallbackRent->isNotEmpty()) {
                    $rentProperties = $fallbackRent;
                } else {
                    $rentProperties = isset($properties) ? $properties->take(9) : Property::latest()->take(9)->get();
                }
                $rentDebug['used_section'] = false;
            } catch (\Exception $e) {
                $rentProperties = isset($properties) ? $properties->take(9) : Property::latest()->take(9)->get();
                $rentDebug['used_section'] = false;
            }
        }


        $latestProperties = ($rentProperties && $rentProperties->isNotEmpty())
            ? $rentProperties
            : (isset($properties) ? $properties->take(6) : Property::latest()->take(6)->get());

        try {
            Log::info('ClientSectionController rent debug', [
                'tenant' => tenant() ? tenant()->id : null,
                'properties_count' => isset($properties) ? (is_countable($properties) ? count($properties) : $properties->count()) : 0,
                'rent_count' => is_countable($rentProperties) ? count($rentProperties) : $rentProperties->count(),
                'rent_debug' => $rentDebug,
            ]);
        } catch (\Throwable $e) {
        }

        return tenant_view('client.pages.index', compact('sections', 'properties', 'rentProperties', 'latestProperties'));
    }
}
