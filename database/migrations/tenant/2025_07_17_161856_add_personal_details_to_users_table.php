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
        Schema::table('users', function (Blueprint $table) {
            // Personal Details
            $table->string('title')->nullable()->after('email');
            $table->string('title_other')->nullable()->after('title');
            $table->string('gender')->nullable()->after('title_other');
            $table->date('date_of_birth')->nullable()->after('gender');
            $table->string('marital_status')->nullable()->after('date_of_birth');
            $table->string('marital_status_other')->nullable()->after('marital_status');

            // Occupational Details
            $table->string('occupation')->nullable()->after('marital_status_other');
            $table->string('nationality')->nullable()->after('occupation');
            $table->string('state_of_origin')->nullable()->after('nationality');
            $table->string('lga')->nullable()->after('state_of_origin');
            $table->string('hometown')->nullable()->after('lga');

            // Contact Information
            $table->text('residential_address')->nullable()->after('hometown');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'title_other',
                'gender',
                'date_of_birth',
                'marital_status',
                'marital_status_other',
                'occupation',
                'nationality',
                'state_of_origin',
                'lga',
                'hometown',
                'residential_address'
            ]);
        });
    }
};
