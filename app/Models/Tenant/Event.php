<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'start_date_time',
        'end_date_time',
        'location'
    ];

    protected $casts = [
        'start_date_time' => 'datetime',
        'end_date_time' => 'datetime',
    ];

    // Relationship with event bookings
    public function eventBookings(): HasMany
    {
        return $this->hasMany(\App\Models\Tenant\EventBooking::class);
    }

    // Get total referrals count for this event
    public function getTotalReferralsAttribute()
    {
        return $this->eventBookings()->count();
    }

    // Get event status based on dates
    public function getStatusAttribute()
    {
        $now = now();

        if ($now < $this->start_date_time) {
            return 'Upcoming';
        } elseif ($now >= $this->start_date_time && $now <= $this->end_date_time) {
            return 'Ongoing';
        } else {
            return 'Complete';
        }
    }

    // Get status color class
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'Upcoming' => 'text-warning',
            'Ongoing' => 'text-primary',
            'Complete' => 'text-success',
            default => 'text-secondary'
        };
    }
}
