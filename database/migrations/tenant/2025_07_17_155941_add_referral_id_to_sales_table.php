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
            // Add referral_id column to track the realtor who made the sale
            $table->foreignId('referral_id')->nullable()->after('user_id')->constrained('users')->onDelete('set null');

            // Add client_type to distinguish between new and existing clients
            $table->enum('client_type', ['new', 'existing'])->default('new')->after('referral_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign(['referral_id']);
            $table->dropColumn(['referral_id', 'client_type']);
        });
    }
};
