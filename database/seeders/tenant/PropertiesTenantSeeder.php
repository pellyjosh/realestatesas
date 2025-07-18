<?php

namespace Database\Seeders\Tenant;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertiesTenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = [
            [
                'name' => 'Luxury Villa Estate',
                'price_per_plot' => 500000.00,
                'description' => 'Premium luxury villa plots with modern amenities'
            ],
            [
                'name' => 'Beachfront Paradise',
                'price_per_plot' => 750000.00,
                'description' => 'Exclusive beachfront property with ocean views'
            ],
            [
                'name' => 'Suburban Heights',
                'price_per_plot' => 300000.00,
                'description' => 'Family-friendly suburban development'
            ],
            [
                'name' => 'City Center Towers',
                'price_per_plot' => 1000000.00,
                'description' => 'High-rise commercial plots in city center'
            ],
            [
                'name' => 'Green Valley Estates',
                'price_per_plot' => 400000.00,
                'description' => 'Eco-friendly residential plots with green spaces'
            ],
        ];

        foreach ($properties as $property) {
            Property::create($property);
        }
    }
}
