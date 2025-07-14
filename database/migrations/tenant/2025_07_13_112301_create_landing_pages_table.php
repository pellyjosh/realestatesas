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
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->string('link')->unique(); // URL for the landing page
            $table->string('type'); // e.g., Event, Promotion, Showcase
            $table->unsignedBigInteger('property_id'); // Links to properties table
            $table->dateTime('expires_at')->nullable(); // Duration start
            // $table->dateTime('end_datetime')->nullable(); // Duration end
            $table->boolean('is_active')->default(true); // For deactivation
            $table->unsignedBigInteger('user_id')->nullable(); // Links to user
            $table->timestamps();

            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->unique(['user_id', 'property_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_pages');
    }
};
