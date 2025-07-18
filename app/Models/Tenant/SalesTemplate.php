<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesTemplate extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'template_data',
        'is_default'
    ];

    protected $casts = [
        'template_data' => 'array',
        'is_default' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(TenantUser::class);
    }

    /**
     * Scope to limit templates per user to 3
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($template) {
            $userTemplateCount = static::where('user_id', $template->user_id)->count();
            if ($userTemplateCount >= 3) {
                throw new \Exception('Maximum of 3 templates allowed per user');
            }
        });
    }

    /**
     * Get templates for a specific user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
