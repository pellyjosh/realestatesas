<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Earning extends Model
{
    protected $fillable = [
        'user_id',
        'sale_id',
        'commission_rate',
        'sale_amount',
        'commission_amount',
        'status',
        'earned_date',
        'paid_date',
        'notes'
    ];

    protected $casts = [
        'commission_rate' => 'decimal:2',
        'sale_amount' => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'earned_date' => 'date',
        'paid_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(TenantUser::class);
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    /**
     * Get the transactions for this earning
     */
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }

    /**
     * Calculate commission amount based on sale amount and rate
     */
    public function calculateCommission($saleAmount, $commissionRate)
    {
        return ($saleAmount * $commissionRate) / 100;
    }

    /**
     * Create wallet transaction when earning is approved
     */
    public function createWalletTransaction()
    {
        if ($this->status === 'approved' && !$this->transactions()->exists()) {
            $user = TenantUser::find($this->user_id);
            if ($user) {
                $wallet = $user->getOrCreateWallet();

                $transaction = $wallet->credit(
                    $this->commission_amount,
                    Transaction::TYPE_COMMISSION,
                    "Commission from sale #{$this->sale_id}",
                    [
                        'sale_id' => $this->sale_id,
                        'earning_id' => $this->id,
                        'commission_rate' => $this->commission_rate,
                    ]
                );

                // Link transaction to this earning
                $transaction->update([
                    'transactionable_type' => self::class,
                    'transactionable_id' => $this->id,
                ]);

                return $transaction;
            }
        }

        return null;
    }
}
