<?php

namespace App\Models\Tenant\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Property;

class HomeSection extends Model
{
    protected $table = 'home_section';
    
    protected $fillable = ['name', 'data', 'is_enabled'];

    protected $casts = [
        'data' => 'array',
        'is_enabled' => 'boolean',
    ];

    /**
     * Get properties for this section based on the selected property IDs in data
     */
    public function getPropertiesAttribute()
    {
        if (!isset($this->data['selected']) || !is_array($this->data['selected'])) {
            return collect();
        }

        $propertyIds = collect($this->data['selected'])->pluck('property_id')->filter();
        
        if ($propertyIds->isEmpty()) {
            return collect();
        }

        return Property::whereIn('id', $propertyIds)->get();
    }

    /**
     * Add a property to this section
     */
    public function addProperty($propertyId)
    {
        $data = $this->data ?? [];
        $selected = $data['selected'] ?? [];
        
        // Check if property is already in the section
        $exists = collect($selected)->contains(function ($item) use ($propertyId) {
            return isset($item['property_id']) && $item['property_id'] == $propertyId;
        });
        
        if (!$exists) {
            $selected[] = [
                'property_id' => (int) $propertyId,
                'added_at' => now()->toDateTimeString()
            ];
            
            $data['selected'] = $selected;
            $this->update(['data' => $data]);
        }
        
        return $this;
    }

    /**
     * Remove a property from this section
     */
    public function removeProperty($propertyId)
    {
        $data = $this->data ?? [];
        $selected = $data['selected'] ?? [];
        
        $selected = collect($selected)->reject(function ($item) use ($propertyId) {
            return isset($item['property_id']) && $item['property_id'] == $propertyId;
        })->values()->toArray();
        
        $data['selected'] = $selected;
        $this->update(['data' => $data]);
        
        return $this;
    }

    /**
     * Check if a property is in this section
     */
    public function hasProperty($propertyId)
    {
        $selected = $this->data['selected'] ?? [];
        
        return collect($selected)->contains(function ($item) use ($propertyId) {
            return isset($item['property_id']) && $item['property_id'] == $propertyId;
        });
    }

    /**
     * Get the limit for this section
     */
    public function getLimit()
    {
        return $this->data['limit'] ?? 6;
    }

    /**
     * Check if section has reached its limit
     */
    public function isAtLimit()
    {
        $selected = $this->data['selected'] ?? [];
        return count($selected) >= $this->getLimit();
    }
}
