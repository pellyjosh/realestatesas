<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Realtor extends Model
{
    protected $connection = 'tenant';
    
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'image_url',
        'title',
        'title_other',
        'gender',
        'date_of_birth',
        'marital_status',
        'marital_status_other',
        'nationality',
        'state_of_origin',
        'lga',
        'hometown',
        'residential_address',
        'zip_code',
        'description',
        'is_active'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user associated with the realtor
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(TenantUser::class, 'user_id');
    }

    /**
     * Get the full name attribute
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get the display title
     */
    public function getDisplayTitleAttribute(): string
    {
        if ($this->title === 'Other' && $this->title_other) {
            return $this->title_other;
        }
        return $this->title ?? '';
    }

    /**
     * Get the display marital status
     */
    public function getDisplayMaritalStatusAttribute(): string
    {
        if ($this->marital_status === 'Other' && $this->marital_status_other) {
            return $this->marital_status_other;
        }
        return $this->marital_status ?? '';
    }
}
