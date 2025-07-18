<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventBooking extends Model
{
    protected $fillable = [
        'event_id',
        'event_name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'how_heard',
        'inviter_name',
        'inviter_phone',
        'referral_code',
        'referred_by_code',
    ];

    // Relationship with event
    public function event(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Tenant\Event::class);
    }

    // Get full name attribute
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Get referral link attribute
    public function getReferralLinkAttribute()
    {
        return url('/events?event_id=' . $this->event_id . '&referral_code=' . $this->referral_code);
    }
}
