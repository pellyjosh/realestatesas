<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use App\Models\Tenant\Admin\HomeSection;

class HomeSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'name' => 'featured',
                'data' => [
                    'limit' => 6,
                    'title' => 'Featured Properties',
                    'selected' => []
                ],
                'is_enabled' => true
            ],
            [
                'name' => 'latest_for_sale',
                'data' => [
                    'limit' => 6,
                    'title' => 'Latest for Sale',
                    'selected' => []
                ],
                'is_enabled' => true
            ]
        ];

        foreach ($sections as $section) {
            HomeSection::updateOrCreate(
                ['name' => $section['name']],
                ['data' => $section['data'], 'is_enabled' => $section['is_enabled']]
            );
        }
    }
}
