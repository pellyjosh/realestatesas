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
        Schema::create('payment_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained()->onDelete('cascade'); // Reference to the sale
            $table->foreignId('payment_plan_id')->constrained()->onDelete('cascade'); // Reference to payment plan
            $table->integer('installment_number'); // 1st, 2nd, 3rd installment, etc.
            $table->decimal('amount_due', 15, 2); // Amount due for this installment
            $table->decimal('amount_paid', 15, 2)->default(0); // Amount actually paid
            $table->decimal('late_fee', 15, 2)->default(0); // Late fee if any
            $table->date('due_date'); // When this installment is due
            $table->date('paid_date')->nullable(); // When this installment was paid
            $table->enum('status', ['pending', 'paid', 'overdue', 'partially_paid'])->default('pending');
            $table->text('payment_reference')->nullable(); // Payment reference/transaction ID
            $table->json('payment_details')->nullable(); // Additional payment details (payment method, etc.)
            $table->text('notes')->nullable();
            $table->timestamps();

            // Indexes for better performance
            $table->index(['sale_id', 'status']);
            $table->index(['due_date', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_installments');
    }
};
