<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

class RenameAboutSectionToRealtors extends Command
{
    protected $signature = 'tenant:rename-about-to-realtors {tenant_id}';
    protected $description = 'Rename the about section to realtors in the home_section table for a specific tenant DB.';

    public function handle()
    {
        $tenantId = $this->argument('tenant_id');
        $tenant = \App\Models\Tenant::find($tenantId);
        if (!$tenant) {
            $this->error("Tenant not found: $tenantId");
            return 1;
        }
        $this->info("Switching to tenant DB for: $tenant->id");
        app(\Stancl\Tenancy\Tenancy::class)->initialize($tenant);
        $updated = DB::table('home_section')->where('name', 'about')->update(['name' => 'realtors']);
        if ($updated) {
            $this->info("Section 'about' renamed to 'realtors' for tenant $tenant->id");
        } else {
            $this->warn("No 'about' section found for tenant $tenant->id, or already renamed.");
        }
        return 0;
    }
}
