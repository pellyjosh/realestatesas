<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('realtors', function (Blueprint $table) {
            if (Schema::hasColumn('realtors', 'is_active')) {
                $table->string('status')->default('active');
                $table->dropColumn('is_active');
            }
        });
    }

    public function down()
    {
        Schema::table('realtors', function (Blueprint $table) {
            if (Schema::hasColumn('realtors', 'status')) {
                $table->boolean('is_active')->default(true);
                $table->dropColumn('status');
            }
        });
    }
};
