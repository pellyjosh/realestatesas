<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateTenantSymlink extends Command
{
    protected $signature = 'tenant:symlink {tenant_key}';
    protected $description = 'Create a symlink for a tenant storage folder using tenant key (e.g., client1)';

    public function handle()
    {
        $tenantKey = $this->argument('tenant_key');
        $target = storage_path("tenants/{$tenantKey}/app/public");
        $link = public_path("storage/{$tenantKey}");

        if (!file_exists($target)) {
            $this->error("Target directory does not exist: {$target}");
            return 1;
        }

        // Remove existing symlink if it's broken
        if (file_exists($link) && is_link($link)) {
            if (!file_exists(readlink($link))) {
                unlink($link);
            } else {
                $this->info("Symlink already exists: {$link}");
                return 0;
            }
        }

        // Remove if a file/folder exists at the link location
        if (file_exists($link) && !is_link($link)) {
            $this->error("A file or directory already exists at symlink location: {$link}");
            return 1;
        }

        if (symlink($target, $link)) {
            $this->info("Symlink created: {$link} -> {$target}");
            return 0;
        } else {
            $this->error("Failed to create symlink.");
            return 1;
        }
    }
}
