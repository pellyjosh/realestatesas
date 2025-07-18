<?php

namespace App\Models;

use App\Models\Tenant\Sale;
use App\Models\Tenant\TenantUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Property extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'property_type',
        'listing_type',
        'status',
        'image',
        'price_per_plot',
        'description',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'latitude',
        'longitude',
        'bedrooms',
        'bathrooms',
        'parking_spaces',
        'land_size',
        'built_area',
        'year_built',
        'price',
        'price_per_sqm',
        'features',
        'amenities',
        'images',
        'videos',
        'virtual_tour_url',
        'floor_plan',
        'slug',
        'meta_description',
        'meta_keywords',
        'listed_at',
        'expires_at'
    ];

    protected $casts = [
        'price_per_plot' => 'decimal:2',
        'price' => 'decimal:2',
        'price_per_sqm' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'land_size' => 'decimal:2',
        'built_area' => 'decimal:2',
        'features' => 'array',
        'amenities' => 'array',
        'images' => 'array',
        'videos' => 'array',
        'listed_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    protected $dates = [
        'listed_at',
        'expires_at',
        'deleted_at'
    ];

    // Boot method to generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            if (empty($property->slug)) {
                $property->slug = Str::slug($property->name);
            }
            if (empty($property->listed_at)) {
                $property->listed_at = now();
            }
        });
    }

    // Belongs to a user (property owner/creator)
    public function user(): BelongsTo
    {
        return $this->belongsTo(TenantUser::class, 'user_id');
    }

    // Has many sales
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    // Has many inspections
    public function inspections(): HasMany
    {
        return $this->hasMany(PropertyInspection::class);
    }

    // Scope for available properties
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    // Scope for properties by type
    public function scopeByType($query, $type)
    {
        return $query->where('property_type', $type);
    }

    // Scope for properties by listing type
    public function scopeByListingType($query, $listingType)
    {
        return $query->where('listing_type', $listingType);
    }

    // Get full address
    public function getFullAddressAttribute()
    {
        $parts = array_filter([$this->address, $this->city, $this->state, $this->country]);
        return implode(', ', $parts);
    }

    // Get primary image
    public function getPrimaryImageAttribute()
    {
        if ($this->images && is_array($this->images) && count($this->images) > 0) {
            return $this->images[0];
        }
        return $this->image ?? '/themes/classic/client/assets/images/property/default.jpg';
    }

    // Get formatted price
    public function getFormattedPriceAttribute()
    {
        if ($this->price) {
            return '₦' . number_format($this->price, 0);
        }
        if ($this->price_per_plot) {
            return '₦' . number_format($this->price_per_plot, 0) . '/plot';
        }
        return 'Price on request';
    }

    // Get property summary
    public function getPropertySummaryAttribute()
    {
        $parts = [];
        if ($this->bedrooms) $parts[] = $this->bedrooms . ' bed';
        if ($this->bathrooms) $parts[] = $this->bathrooms . ' bath';
        if ($this->land_size) $parts[] = number_format($this->land_size, 0) . ' sqm';

        return implode(' • ', $parts);
    }

    // Check if property is active
    public function getIsActiveAttribute()
    {
        return $this->status === 'available' &&
            (!$this->expires_at || $this->expires_at->isFuture());
    }
}
