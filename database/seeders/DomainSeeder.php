<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('domains')->truncate();
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            Domain::create([
                'tenant_id' => $tenant->id,
                'domain' => "{$tenant->id}.premiumrefined.net",
            ]);
        }
    }
}
