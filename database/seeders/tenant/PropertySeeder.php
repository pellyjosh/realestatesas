<?php

namespace Database\Seeders\Tenant;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear the properties table
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('properties')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Define sample properties
        $properties = [
            [
                'name' => 'Property One',
                'image' => '/storage/properties/property1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Property Two',
                'image' => '/storage/properties/property2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Property Three',
                'image' => '/storage/properties/property3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Property Four',
                'image' => '/storage/properties/property4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Property Five',
                'image' => '/storage/properties/property5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert properties
        foreach ($properties as $property) {
            Property::create($property);
        }
    }
}
