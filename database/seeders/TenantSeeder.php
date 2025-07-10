<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('tenants')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Tenant::create(['id' => 'estate1']);
        Tenant::create(['id' => 'estate2']);
    }
}
