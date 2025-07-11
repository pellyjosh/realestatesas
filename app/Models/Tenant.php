<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Illuminate\Support\Facades\Log;


class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;


    // public function getLogoAttribute()
    // {
    //     Log::info('Accessing tenant logo', [
    //         'tenant_id' => $this->id,
    //         'logo' => $this->logo ?? null,
    //     ]);

    //     return $this->data['logo'] ?? null;
    // }

    // public function getPrimaryColorAttribute()
    // {
    //     Log::info('Accessing tenant primary color', [
    //         'tenant_id' => $this->id,
    //         'primary_color' => $this->data['primary_color'] ?? null,
    //     ]);

    //     return $this->data['primary_color'] ?? null;
    // }

    // public function getNameAttribute()
    // {
    //     Log::info('Accessing tenant name', [
    //         'tenant_id' => $this->id,
    //         'name' => $this->data['name'] ?? null,
    //     ]);

    //     return $this->data['name'] ?? null;
    // }

    protected $casts = [
        'data' => 'array', // or 'json'
    ];
}
