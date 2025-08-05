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
        Schema::table('properties', function (Blueprint $table) {
            if (!Schema::hasColumn('properties', 'price_per_plot')) {
                $table->decimal('price_per_plot', 15, 2)->default(100000.00)->after('image');
            }
            if (!Schema::hasColumn('properties', 'description')) {
                $table->text('description')->nullable()->after('price_per_plot');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['price_per_plot', 'description']);
        });
    }
};
