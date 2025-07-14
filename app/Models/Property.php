<?php

namespace App\Models;

use App\Models\Tenant\TenantUser;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $guarded = [];

    // Belongs to a property
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    // Belongs to a user
    public function user()
    {
        return $this->belongsTo(TenantUser::class);
    }
}
