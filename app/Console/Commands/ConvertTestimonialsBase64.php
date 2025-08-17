<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenant\Admin\HomeSection;
use App\Models\Tenant as TenantModel;
// no specific tenant exception import to keep compatibility in CLI context
use Illuminate\Support\Facades\Storage;

class ConvertTestimonialsBase64 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'homesection:convert-hero-base64';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert base64 images stored in hero section (hero_banner and carousel items) to files on the public disk and update DB (creates backups).';

    public function handle()
    {
        $tenants = TenantModel::all();
        if ($tenants->isEmpty()) {
            $this->info('No tenants found.');
            return 0;
        }

        $grandTotal = 0;
        foreach ($tenants as $tenant) {
            $this->info("Initializing tenancy for tenant id {$tenant->id}");
            try {
                tenancy()->initialize($tenant);
            } catch (\Exception $e) {
                $this->error("Failed to initialize tenancy for tenant id {$tenant->id}: " . $e->getMessage());
                continue;
            }

            $sections = HomeSection::where('name', 'hero')->get();
            if ($sections->isEmpty()) {
                $this->info("No hero sections for tenant {$tenant->id}");
                tenancy()->end();
                continue;
            }

            $tenantTotal = 0;
            foreach ($sections as $section) {
                $data = $section->data ?? [];
                $originalData = $data;
                $changed = false;

                // For hero section: convert hero_banner and carousel_items[*].signature_img
                if ($section->name === 'hero') {
                    // hero_banner
                    if (isset($data['hero_banner']) && is_string($data['hero_banner'])) {
                        $hb = $data['hero_banner'];
                        if (!empty($hb) && !str_starts_with($hb, '/storage/') && preg_match('#^data:image/(\w+);base64,#i', $hb, $m)) {
                            $ext = strtolower($m[1]);
                            if ($ext === 'jpeg') $ext = 'jpg';
                            $clean = preg_replace('#^data:image/\w+;base64,#i', '', $hb);
                            $imageData = base64_decode(str_replace(' ', '+', $clean));
                            if ($imageData !== false) {
                                $filename = uniqid('h_') . '.' . $ext;
                                $path = 'hero_banners/' . $filename;
                                Storage::disk('public')->put($path, $imageData);
                                $data['hero_banner'] = Storage::url($path);
                                $changed = true;
                                $tenantTotal++;
                                $this->info("Stored hero_banner for section id {$section->id} -> {$path}");
                            }
                        }
                    }

                    // carousel items
                    if (isset($data['carousel_items']) && is_array($data['carousel_items'])) {
                        foreach ($data['carousel_items'] as $ci => $cItem) {
                            if (!isset($cItem['signature_img']) || !is_string($cItem['signature_img'])) continue;
                            $img = $cItem['signature_img'];
                            if (empty($img) || str_starts_with($img, '/storage/') || preg_match('#^https?://#i', $img)) continue;
                            if (preg_match('#^data:image/(\w+);base64,#i', $img, $m)) {
                                $ext = strtolower($m[1]);
                                if ($ext === 'jpeg') $ext = 'jpg';
                                $clean = preg_replace('#^data:image/\w+;base64,#i', '', $img);
                                $imageData = base64_decode(str_replace(' ', '+', $clean));
                                if ($imageData === false) {
                                    $this->error("Failed to decode hero carousel base64 for index {$ci} in section id {$section->id}");
                                    continue;
                                }
                                $filename = uniqid('hc_') . '.' . $ext;
                                $path = 'carousel_images/' . $filename;
                                Storage::disk('public')->put($path, $imageData);
                                $data['carousel_items'][$ci]['signature_img'] = Storage::url($path);
                                $changed = true;
                                $tenantTotal++;
                                $this->info("Stored hero carousel image idx {$ci} -> {$path}");
                            }
                        }
                    }
                }

                if ($changed) {
                    // backup original items to storage/app/testimonials-backups
                    $backupDir = 'testimonials-backups';
                    $backupName = $backupDir . '/' . date('Ymd_His') . '_tenant_' . $tenant->id . '_section_' . $section->id . '.json';
                    Storage::disk('local')->put($backupName, json_encode(['tenant_id' => $tenant->id, 'section_id' => $section->id, 'before' => $originalData], JSON_PRETTY_PRINT));
                    $section->data = $data;
                    $section->save();
                    $this->info("Updated section id {$section->id} and wrote backup to storage/app/{$backupName}");
                } else {
                    $this->info("No base64 images found in section id {$section->id}");
                }
            }

            tenancy()->end();
            $this->info("Tenant {$tenant->id} conversion complete. {$tenantTotal} image(s) converted.");
            $grandTotal += $tenantTotal;
        }

        $this->info("Conversion complete across tenants. {$grandTotal} image(s) converted.");
        return 0;
    }
}
