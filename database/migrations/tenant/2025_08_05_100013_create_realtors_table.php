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
        Schema::create('realtors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->unique();
            $table->string('image_url')->nullable();
            
            // Personal Details
            $table->string('title')->nullable();
            $table->string('title_other')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->date('date_of_birth')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('marital_status_other')->nullable();
            
            // Occupational Details
            $table->string('nationality')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->string('lga')->nullable();
            $table->string('hometown')->nullable();
            
            // Contact Information
            $table->text('residential_address')->nullable();
            $table->string('zip_code')->nullable();
            $table->text('description')->nullable();
            
            // Status
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realtors');
    }
};
