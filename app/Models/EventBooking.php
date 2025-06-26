<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventBooking extends Model
{
    use HasFactory;

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
}
