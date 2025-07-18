<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class TenantUser extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'image_url',
        'password',
        'referral_code',
        'referred_by_code',
        'type',
        // Personal Details
        'title',
        'title_other',
        'gender',
        'date_of_birth',
        'marital_status',
        'marital_status_other',
        // Occupational Details
        'occupation',
        'nationality',
        'state_of_origin',
        'lga',
        'hometown',
        // Contact Information
        'residential_address'
    ];

    protected static function booted(): void
    {
        static::creating(function (TenantUser $user) {
            if (empty($user->referral_code)) {
                do {
                    $code = strtoupper(Str::random(10));
                } while (self::where('referral_code', $code)->exists());

                $user->referral_code = $code;
            }
        });
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'user_id');
    }

    public function salesTemplates(): HasMany
    {
        return $this->hasMany(SalesTemplate::class, 'user_id');
    }

    public function earnings(): HasMany
    {
        return $this->hasMany(Earning::class, 'user_id');
    }

    /**
     * Get the user's wallet
     */
    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'user_id');
    }

    /**
     * Get the user's transactions
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

    /**
     * Get commission transactions
     */
    public function commissionTransactions()
    {
        return $this->transactions()
            ->where('type', Transaction::TYPE_COMMISSION)
            ->where('status', Transaction::STATUS_COMPLETED);
    }

    /**
     * Get completed transactions
     */
    public function completedTransactions()
    {
        return $this->transactions()->where('status', Transaction::STATUS_COMPLETED);
    }

    /**
     * Get pending transactions
     */
    public function pendingTransactions()
    {
        return $this->transactions()->where('status', Transaction::STATUS_PENDING);
    }

    /**
     * Get or create user wallet
     */
    public function getOrCreateWallet()
    {
        return $this->wallet ?: $this->wallet()->create([
            'currency' => 'NGN',
            'is_active' => true,
        ]);
    }
}
