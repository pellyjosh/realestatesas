<?php

namespace App\Models\Tenant\Admin;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $table = 'home_section';
    
    protected $fillable = ['name', 'data', 'is_enabled'];

    protected $casts = [
        'data' => 'array',
        'is_enabled' => 'boolean',
    ];
}
