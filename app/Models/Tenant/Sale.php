<?php

namespace App\Models\Tenant;

use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    protected $fillable = [
        'user_id',
        'referral_id',
        'client_type',
        'property_id',
        'title',
        'title_other',
        'full_name',
        'gender',
        'date_of_birth',
        'marital_status',
        'marital_status_other',
        'occupation',
        'nationality',
        'state_of_origin',
        'lga',
        'hometown',
        'residential_address',
        'phone_number',
        'email_address',
        'commercial_plots',
        'commercial_plots_other',
        'residential_plots',
        'residential_plots_other',
        'payment_mode',
        'next_of_kin_name',
        'next_of_kin_relationship',
        'next_of_kin_phone',
        'next_of_kin_email',
        'next_of_kin_address',
        'subscriber_type',
        'organization_name',
        'signatories',
        'terms_accepted',
        'client_signature',
        'signature_date',
        'witness_name',
        'witness_phone',
        'witness_email',
        'witness_address',
        'witness_signature',
        'witness_date',
        'status',
        'total_amount',
        'amount_paid',
        'notes'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'signature_date' => 'date',
        'witness_date' => 'date',
        'terms_accepted' => 'boolean',
        'signatories' => 'array',
        'total_amount' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'commercial_plots' => 'integer',
        'commercial_plots_other' => 'integer',
        'residential_plots' => 'integer',
        'residential_plots_other' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(TenantUser::class);
    }

    public function referral(): BelongsTo
    {
        return $this->belongsTo(TenantUser::class, 'referral_id');
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function earnings(): HasMany
    {
        return $this->hasMany(Earning::class);
    }

    public function getTotalPlotsAttribute(): int
    {
        $commercial = (int)($this->commercial_plots ?? 0);
        $residential = (int)($this->residential_plots ?? 0);

        return $commercial + $residential;
    }

    public function getCommercialPlotsCountAttribute(): int
    {
        return $this->commercial_plots === 'other' ?
            ($this->commercial_plots_other ?? 0) : ($this->commercial_plots ?? 0);
    }

    public function getResidentialPlotsCountAttribute(): int
    {
        return $this->residential_plots === 'other' ?
            ($this->residential_plots_other ?? 0) : ($this->residential_plots ?? 0);
    }
}
