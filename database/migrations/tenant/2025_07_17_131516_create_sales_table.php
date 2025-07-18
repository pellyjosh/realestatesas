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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('property_id')->constrained()->onDelete('cascade');

            // Personal Details
            $table->string('title');
            $table->string('title_other')->nullable();
            $table->string('full_name');
            $table->string('gender');
            $table->date('date_of_birth')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('marital_status_other')->nullable();

            // Occupational Details
            $table->string('occupation')->nullable();
            $table->string('nationality')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->string('lga')->nullable();
            $table->string('hometown')->nullable();

            // Contact Information
            $table->text('residential_address')->nullable();
            $table->string('phone_number');
            $table->string('email_address')->nullable();

            // Subscription Details
            $table->integer('commercial_plots')->default(0);
            $table->integer('commercial_plots_other')->nullable();
            $table->integer('residential_plots')->default(0);
            $table->integer('residential_plots_other')->nullable();
            $table->string('payment_mode');

            // Next of Kin
            $table->string('next_of_kin_name')->nullable();
            $table->string('next_of_kin_relationship')->nullable();
            $table->string('next_of_kin_phone')->nullable();
            $table->string('next_of_kin_email')->nullable();
            $table->text('next_of_kin_address')->nullable();

            // Subscriber Type
            $table->enum('subscriber_type', ['Individual', 'Organization']);
            $table->string('organization_name')->nullable();
            $table->json('signatories')->nullable(); // For organization signatories

            // Declaration & Terms
            $table->boolean('terms_accepted')->default(false);
            $table->string('client_signature');
            $table->date('signature_date');

            // Witness Information
            $table->string('witness_name')->nullable();
            $table->string('witness_phone')->nullable();
            $table->string('witness_email')->nullable();
            $table->text('witness_address')->nullable();
            $table->string('witness_signature')->nullable();
            $table->date('witness_date')->nullable();

            // Status and tracking
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->decimal('total_amount', 15, 2)->nullable();
            $table->decimal('amount_paid', 15, 2)->default(0);
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
