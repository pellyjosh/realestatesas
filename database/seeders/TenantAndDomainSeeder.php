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
        $tenant1 = Tenant::create([
            'id' => 'client1',
            'name' => 'Client One',
            'email' => 'client1@example.com',
            'phone' => '123-456-7890',
            'address' => '123 Main St',
            'city' => 'Anytown',
            'state' => 'CA',
            'zip' => '91234',
            'country' => 'USA',
            'domain' => 'client1.central.test',
            'theme' => 'classic',
            'primary_color' => '#ff5733',
            'logo' => 'logos/tenant123.png',
        ]);
        $tenant2 = Tenant::create([
            'id' => 'client2',
            'name' => 'Client Two',
            'email' => 'client2@example.com',
            'phone' => '987-654-3210',
            'address' => '456 Oak Ave',
            'city' => 'Otherville',
            'state' => 'NY',
            'zip' => '10001',
            'country' => 'USA',
            'domain' => 'client2.central.test',
            'theme' => 'classic',
            'primary_color' => '#ff5733',
            'logo' => 'logos/tenant2.png',
        ]);
        $tenant3 = Tenant::create([
            'id' => 'client3',
            'name' => 'Client Three',
            'email' => 'client3@example.com',
            'phone' => '555-123-4567',
            'address' => '789 Pine Ln',
            'city' => 'Someplace',
            'state' => 'TX',
            'zip' => '75001',
            'country' => 'USA',
            'domain' => 'premiumrefined.test',
            'theme' => 'classic',
            'primary_color' => '#ff5733',
            'logo' => 'logos/tenant3.png',
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('domains')->truncate();
        Domain::create([
            'tenant_id' => $tenant1->id,
            'domain' => "{$tenant1->id}.central.test",
        ]);
        Domain::create([
            'tenant_id' => $tenant2->id,
            'domain' => "{$tenant2->id}.central.test",
        ]);
        Domain::create([
            'tenant_id' => $tenant3->id,
            'domain' => "premiumrefined.test",
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
