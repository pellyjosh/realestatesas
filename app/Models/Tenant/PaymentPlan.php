<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'duration_months',
        'interest_rate',
        'installments_count',
        'down_payment_percentage',
        'is_active',
        'terms_conditions',
        'grace_period_days',
        'late_fee_percentage',
    ];

    protected $casts = [
        'terms_conditions' => 'array',
        'interest_rate' => 'decimal:2',
        'down_payment_percentage' => 'decimal:2',
        'late_fee_percentage' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Scope to get only active payment plans
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get sales using this payment plan
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Get payment installments for this plan
     */
    public function installments()
    {
        return $this->hasMany(PaymentInstallment::class);
    }

    /**
     * Check if this is an installment plan
     */
    public function isInstallmentPlan()
    {
        return $this->installments_count > 1;
    }

    /**
     * Check if this is an outright payment plan
     */
    public function isOutrightPlan()
    {
        return $this->installments_count === 1;
    }

    /**
     * Calculate total amount with interest
     */
    public function calculateTotalAmount($baseAmount)
    {
        $interestAmount = ($baseAmount * $this->interest_rate) / 100;
        return $baseAmount + $interestAmount;
    }

    /**
     * Calculate down payment amount
     */
    public function calculateDownPayment($totalAmount)
    {
        return ($totalAmount * $this->down_payment_percentage) / 100;
    }

    /**
     * Calculate installment amount
     */
    public function calculateInstallmentAmount($totalAmount)
    {
        if ($this->installments_count <= 1) {
            return $totalAmount;
        }

        $downPayment = $this->calculateDownPayment($totalAmount);
        $remainingAmount = $totalAmount - $downPayment;

        return $remainingAmount / $this->installments_count;
    }
}
