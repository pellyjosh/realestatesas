<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant as TenantModel;

class DumpHomeSectionsForTenant extends Command
{
    protected $signature = 'tenant:dump-homesections {tenant_id}';
    protected $description = 'Initialize tenancy for a tenant and dump the home_section rows from the tenant DB.';

    public function handle()
    {
        $tenantId = $this->argument('tenant_id');

        // Try to locate the tenant by id or by domain
        $tenant = TenantModel::where('id', $tenantId)->orWhere('domain', $tenantId)->first();
        if (!$tenant) {
            $this->error("Tenant not found: {$tenantId}");
            return 1;
        }

        $this->info("Initializing tenancy for: {$tenant->id}");
        app(\Stancl\Tenancy\Tenancy::class)->initialize($tenant);

        try {
            $rows = DB::table('home_section')->get();
            $this->line(json_encode($rows, JSON_PRETTY_PRINT));
        } catch (\Exception $e) {
            $this->error('Error querying tenant DB: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
