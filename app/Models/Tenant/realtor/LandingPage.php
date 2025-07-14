<?php

namespace App\Models\tenant\realtor;

use App\Models\Property;
use App\Models\Tenant\TenantUser;
use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    protected $guarded = [];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function user()
    {
        return $this->belongsTo(TenantUser::class);
    }
}
