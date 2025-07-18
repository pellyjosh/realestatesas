<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PaymentInstallment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'payment_plan_id',
        'installment_number',
        'amount_due',
        'amount_paid',
        'late_fee',
        'due_date',
        'paid_date',
        'status',
        'payment_reference',
        'payment_details',
        'notes',
    ];

    protected $casts = [
        'amount_due' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'late_fee' => 'decimal:2',
        'due_date' => 'date',
        'paid_date' => 'date',
        'payment_details' => 'array',
    ];

    /**
     * Get the sale this installment belongs to
     */
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    /**
     * Get the payment plan this installment belongs to
     */
    public function paymentPlan()
    {
        return $this->belongsTo(PaymentPlan::class);
    }

    /**
     * Scope to get pending installments
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get overdue installments
     */
    public function scopeOverdue($query)
    {
        return $query->where('status', 'overdue')
            ->orWhere(function ($q) {
                $q->where('status', 'pending')
                    ->where('due_date', '<', Carbon::today());
            });
    }

    /**
     * Scope to get paid installments
     */
    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    /**
     * Check if installment is overdue
     */
    public function isOverdue()
    {
        return $this->status === 'pending' && $this->due_date < Carbon::today();
    }

    /**
     * Check if installment is fully paid
     */
    public function isFullyPaid()
    {
        return $this->status === 'paid' && $this->amount_paid >= $this->amount_due;
    }

    /**
     * Check if installment is partially paid
     */
    public function isPartiallyPaid()
    {
        return $this->status === 'partially_paid' || ($this->amount_paid > 0 && $this->amount_paid < $this->amount_due);
    }

    /**
     * Get remaining amount to be paid
     */
    public function getRemainingAmount()
    {
        return $this->amount_due - $this->amount_paid;
    }

    /**
     * Calculate late fee if applicable
     */
    public function calculateLateFee()
    {
        if (!$this->isOverdue() || $this->isFullyPaid()) {
            return 0;
        }

        $paymentPlan = $this->paymentPlan;
        if (!$paymentPlan) {
            return 0;
        }

        $daysOverdue = Carbon::today()->diffInDays($this->due_date);
        if ($daysOverdue <= $paymentPlan->grace_period_days) {
            return 0;
        }

        return ($this->amount_due * $paymentPlan->late_fee_percentage) / 100;
    }

    /**
     * Mark installment as paid
     */
    public function markAsPaid($amount, $paymentReference = null, $paymentDetails = [])
    {
        $this->amount_paid = $amount;
        $this->paid_date = Carbon::now();
        $this->payment_reference = $paymentReference;
        $this->payment_details = $paymentDetails;

        if ($amount >= $this->amount_due) {
            $this->status = 'paid';
        } else {
            $this->status = 'partially_paid';
        }

        $this->save();

        return $this;
    }
}
