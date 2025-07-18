<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
        'available_balance',
        'pending_balance',
        'currency',
        'is_active',
        'last_transaction_at',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'available_balance' => 'decimal:2',
        'pending_balance' => 'decimal:2',
        'is_active' => 'boolean',
        'last_transaction_at' => 'datetime',
    ];

    protected $attributes = [
        'balance' => 0.00,
        'available_balance' => 0.00,
        'pending_balance' => 0.00,
        'currency' => 'NGN',
        'is_active' => true,
    ];

    /**
     * Get the user that owns the wallet
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(TenantUser::class, 'user_id');
    }

    /**
     * Get all transactions for this wallet
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get credit transactions
     */
    public function creditTransactions(): HasMany
    {
        return $this->transactions()->where('direction', 'credit');
    }

    /**
     * Get debit transactions
     */
    public function debitTransactions(): HasMany
    {
        return $this->transactions()->where('direction', 'debit');
    }

    /**
     * Get pending transactions
     */
    public function pendingTransactions(): HasMany
    {
        return $this->transactions()->where('status', 'pending');
    }

    /**
     * Credit the wallet
     */
    public function credit(float $amount, string $type, string $description = null, array $metadata = []): Transaction
    {
        return $this->createTransaction('credit', $amount, $type, $description, $metadata);
    }

    /**
     * Debit the wallet
     */
    public function debit(float $amount, string $type, string $description = null, array $metadata = []): Transaction
    {
        if ($this->available_balance < $amount) {
            throw new \Exception('Insufficient balance');
        }

        return $this->createTransaction('debit', $amount, $type, $description, $metadata);
    }

    /**
     * Create a transaction
     */
    protected function createTransaction(string $direction, float $amount, string $type, string $description = null, array $metadata = []): Transaction
    {
        $balanceBefore = $this->balance;
        $balanceAfter = $direction === 'credit'
            ? $balanceBefore + $amount
            : $balanceBefore - $amount;

        $transaction = $this->transactions()->create([
            'user_id' => $this->user_id,
            'type' => $type,
            'direction' => $direction,
            'amount' => $amount,
            'currency' => $this->currency,
            'description' => $description,
            'metadata' => $metadata,
            'reference' => $this->generateReference(),
            'balance_before' => $balanceBefore,
            'balance_after' => $balanceAfter,
            'status' => 'completed',
            'processed_at' => now(),
            'processed_by' => 'system',
        ]);

        // Update wallet balance
        $this->update([
            'balance' => $balanceAfter,
            'available_balance' => $balanceAfter,
            'last_transaction_at' => now(),
        ]);

        return $transaction;
    }

    /**
     * Generate unique transaction reference
     */
    protected function generateReference(): string
    {
        return 'TXN-' . strtoupper(uniqid()) . '-' . time();
    }

    /**
     * Check if wallet can be debited
     */
    public function canDebit(float $amount): bool
    {
        return $this->available_balance >= $amount;
    }

    /**
     * Get formatted balance
     */
    public function getFormattedBalanceAttribute(): string
    {
        return '₦' . number_format($this->balance, 2);
    }

    /**
     * Get formatted available balance
     */
    public function getFormattedAvailableBalanceAttribute(): string
    {
        return '₦' . number_format($this->available_balance, 2);
    }
}
