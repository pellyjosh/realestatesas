<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TenantAndDomainSeeder extends Seeder
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
        Tenant::create(['id' => 'client1']);
        Tenant::create(['id' => 'client2']);
        Tenant::create(['id' => 'client3']);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('domains')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            Domain::create([
                'tenant_id' => $tenant->id,
                'domain' => "{$tenant->id}.localhost.test",
            ]);
        }
    }
}
