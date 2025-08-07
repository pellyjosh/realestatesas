<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenant\Admin\HomeSection;
use Stancl\Tenancy\Contracts\Tenant;
use Stancl\Tenancy\Database\Concerns\HasDatabase;

class RenamePropertiesSectionForTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:rename-properties-section {tenant_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rename the HomeSection with name "properties" to "latest for sale" for a specific tenant.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tenantId = $this->argument('tenant_id');
        $tenant = \App\Models\Tenant::find($tenantId);
        if (!$tenant) {
            $this->error('Tenant not found.');
            return 1;
        }
        $tenant->run(function () {
            $section = HomeSection::where('name', 'latest for sale')->first();
            if ($section) {
                // Remove 'selected_properties' and 'description' from data if they exist
                $data = $section->data;
                unset($data['selected_properties']);
                unset($data['description']);
                $section->data = $data;
                $section->save();
                $this->info("'selected_properties' and 'description' removed from 'latest for sale' section for tenant.");
            } else {
                $this->info('No section named "latest for sale" found for this tenant.');
            }
        });
        return 0;
    }
}
