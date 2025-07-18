<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "One-off Outright", "3 Months Outright", "6 Months (10% Extra)", "1 Year (20% Extra)"
            $table->string('code')->unique(); // e.g., "outright", "3_months", "6_months", "12_months"
            $table->text('description')->nullable();
            $table->integer('duration_months'); // Number of months for the payment plan
            $table->decimal('interest_rate', 5, 2)->default(0); // Interest/extra percentage (e.g., 10.00 for 10%)
            $table->integer('installments_count')->default(1); // Number of installments
            $table->decimal('down_payment_percentage', 5, 2)->default(0); // Down payment percentage
            $table->boolean('is_active')->default(true);
            $table->json('terms_conditions')->nullable(); // JSON array of terms and conditions
            $table->integer('grace_period_days')->default(0); // Grace period for late payments
            $table->decimal('late_fee_percentage', 5, 2)->default(5); // Late fee percentage
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_plans');
    }
};
