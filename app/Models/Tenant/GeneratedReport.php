<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GeneratedReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'start_date',
        'end_date',
        'file_path',
        'metadata',
        'status',
        'generated_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'metadata' => 'array',
        'generated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the report
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(TenantUser::class, 'user_id');
    }

    /**
     * Get the download URL for the report
     */
    public function getDownloadUrlAttribute(): string
    {
        return route('tenant.realtor.reports.download', $this->id);
    }

    /**
     * Check if the report is ready for download
     */
    public function isReady(): bool
    {
        return $this->status === 'completed' && !empty($this->file_path);
    }

    /**
     * Get the file size in human readable format
     */
    public function getFileSizeAttribute(): string
    {
        if (!$this->file_path || !file_exists(storage_path('app/' . $this->file_path))) {
            return 'N/A';
        }

        $bytes = filesize(storage_path('app/' . $this->file_path));
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}
