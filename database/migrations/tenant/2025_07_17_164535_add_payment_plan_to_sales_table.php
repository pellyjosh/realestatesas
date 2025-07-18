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
        Schema::table('sales', function (Blueprint $table) {
            $table->foreignId('payment_plan_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('base_amount', 15, 2)->nullable(); // Original amount before interest
            $table->decimal('interest_amount', 15, 2)->default(0); // Interest/extra charges
            $table->decimal('down_payment', 15, 2)->default(0); // Down payment made
            $table->date('payment_start_date')->nullable(); // When payments should start
            $table->enum('payment_status', ['not_started', 'in_progress', 'completed', 'overdue', 'defaulted'])->default('not_started');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign(['payment_plan_id']);
            $table->dropColumn([
                'payment_plan_id',
                'base_amount',
                'interest_amount',
                'down_payment',
                'payment_start_date',
                'payment_status'
            ]);
        });
    }
};
