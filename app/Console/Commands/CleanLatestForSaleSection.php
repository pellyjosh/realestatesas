<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenant\Admin\HomeSection;
use App\Models\Property;

class CleanLatestForSaleSection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'homesection:clean-latest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove non-existent property IDs from the Latest For Sale HomeSection selected array';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $properties = Property::all();
        $propertyIds = $properties->pluck('id')->toArray();
        // Clean 'properties' (Latest For Sale) section
        $section = HomeSection::where('name', 'properties')->first();
        if ($section) {
            if (isset($section->data['selected']) && is_array($section->data['selected'])) {
                $filtered = collect($section->data['selected'])
                    ->filter(function ($item) use ($propertyIds) {
                        $id = is_array($item) ? ($item['property_id'] ?? null) : $item;
                        return $id && in_array($id, $propertyIds);
                    })
                    ->values()
                    ->all();
                $data = $section->data;
                unset($data['selected_properties']);
                $data['selected'] = $filtered;
                $section->data = $data;
                $section->save();
                $this->info("Cleaned Latest For Sale section and removed 'selected_properties'.");
            } else {
                $this->info('No selected properties to clean in Latest For Sale section.');
            }
        } else {
            $this->info('No Latest For Sale section found.');
        }

        // Clean 'featured' section
        $featuredSection = HomeSection::where('name', 'featured')->first();
        if ($featuredSection) {
            $data = $featuredSection->data;
            unset($data['selected_properties']);
            $featuredSection->data = $data;
            $featuredSection->save();
            $this->info("Removed 'selected_properties' from Featured section.");
        }
        return 0;
    }
}
