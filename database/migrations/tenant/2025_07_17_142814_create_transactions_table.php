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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Transaction details
            $table->string('type'); // commission, withdrawal, refund, bonus, penalty, etc.
            $table->enum('direction', ['credit', 'debit']); // credit = money in, debit = money out
            $table->decimal('amount', 15, 2);
            $table->string('currency', 3)->default('NGN');

            // Status and processing
            $table->enum('status', ['pending', 'processing', 'completed', 'failed', 'cancelled'])->default('pending');
            $table->text('description')->nullable();
            $table->json('metadata')->nullable(); // Store additional data like sale_id, earning_id, etc.

            // Reference tracking
            $table->string('reference')->unique(); // Unique transaction reference
            $table->string('external_reference')->nullable(); // Bank/Payment gateway reference
            $table->morphs('transactionable'); // For polymorphic relations (sale, earning, withdrawal, etc.)

            // Balance tracking
            $table->decimal('balance_before', 15, 2);
            $table->decimal('balance_after', 15, 2);

            // Processing details
            $table->timestamp('processed_at')->nullable();
            $table->string('processed_by')->nullable(); // System, admin user, etc.
            $table->text('failure_reason')->nullable();

            $table->timestamps();

            // Indexes for performance
            $table->index(['wallet_id', 'created_at']);
            $table->index(['user_id', 'type', 'status']);
            $table->index(['status', 'created_at']);
            $table->index(['reference']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
