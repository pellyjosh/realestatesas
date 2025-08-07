<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenant\Admin\HomeSection;
use App\Models\Property;

class CleanHomeSectionSelected extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'homesection:clean-selected';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove non-existent property IDs from all HomeSection selected arrays';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $properties = Property::all();
        $propertyIds = $properties->pluck('id')->toArray();
        $sections = HomeSection::all();
        $count = 0;
        foreach ($sections as $section) {
            if (isset($section->data['selected']) && is_array($section->data['selected'])) {
                $filtered = collect($section->data['selected'])
                    ->filter(function ($item) use ($propertyIds) {
                        $id = is_array($item) ? ($item['property_id'] ?? null) : $item;
                        return $id && in_array($id, $propertyIds);
                    })
                    ->values()
                    ->all();
                if (count($filtered) !== count($section->data['selected'])) {
                    $section->data = array_merge($section->data, ['selected' => $filtered]);
                    $section->save();
                    $count++;
                    $this->info("Cleaned section: {$section->name}");
                }
            }
        }
        $this->info("Cleanup complete. {$count} section(s) updated.");
        return 0;
    }
}
