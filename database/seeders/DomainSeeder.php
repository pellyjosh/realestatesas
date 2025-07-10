<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\Tenant;
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
        $tenant = Tenant::find('estate1');

        if ($tenant) {
            Domain::create([
                'tenant_id' => $tenant->id,
                'domain' => 'estate1.premiumrefined.net',
            ]);
        }
    }
}
