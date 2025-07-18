<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyInspection extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'property_id',
        'name',
        'email',
        'phone',
        'preferred_date',
        'preferred_time',
        'message',
        'status',
        'realtor_id',
        'tenant_id'
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'preferred_time' => 'datetime',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * Get the property associated with the inspection.
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the realtor responsible for the inspection.
     */
    public function realtor()
    {
        return $this->belongsTo(\App\Models\Tenant\TenantUser::class, 'realtor_id');
    }

    /**
     * Get the tenant for the inspection.
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Scope to filter by status.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to filter by pending inspections.
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope to filter by confirmed inspections.
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', self::STATUS_CONFIRMED);
    }

    /**
     * Get the formatted preferred date.
     */
    public function getFormattedPreferredDateAttribute()
    {
        return $this->preferred_date ? $this->preferred_date->format('M d, Y') : null;
    }

    /**
     * Get the formatted preferred time.
     */
    public function getFormattedPreferredTimeAttribute()
    {
        return $this->preferred_time ? $this->preferred_time->format('h:i A') : null;
    }

    /**
     * Get status badge class.
     */
    public function getStatusBadgeClassAttribute()
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'badge-warning',
            self::STATUS_CONFIRMED => 'badge-success',
            self::STATUS_COMPLETED => 'badge-primary',
            self::STATUS_CANCELLED => 'badge-danger',
            default => 'badge-secondary',
        };
    }
}
