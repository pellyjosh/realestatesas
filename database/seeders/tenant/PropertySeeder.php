<?php

namespace Database\Seeders\Tenant;

use App\Models\Property;
use App\Models\Tenant\TenantUser;
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

        $properties = [
            [
                'name' => 'Luxury 4-Bedroom House in Lekki',
                'slug' => 'luxury-4-bedroom-house-lekki',
                'property_type' => 'house',
                'listing_type' => 'sale',
                'status' => 'available',
                'description' => 'Beautiful modern house with contemporary finishes, spacious rooms, and excellent location in the heart of Lekki. Features include fitted kitchen, en-suite bathrooms, and private parking.',
                'address' => '15 Admiralty Way',
                'city' => 'Lekki',
                'state' => 'Lagos',
                'postal_code' => '101001',
                'country' => 'Nigeria',
                'latitude' => 6.4474,
                'longitude' => 3.4533,
                'bedrooms' => 4,
                'bathrooms' => 3,
                'parking_spaces' => 2,
                'land_size' => 650.00,
                'built_area' => 350.00,
                'year_built' => 2022,
                'price' => 85000000.00,
                'price_per_sqm' => 242857.14,
                'features' => json_encode([
                    'Air Conditioning',
                    'Fitted Kitchen',
                    'En-suite Bathrooms',
                    'Balcony',
                    'Study Room',
                    'Guest Toilet',
                    'Store Room'
                ]),
                'amenities' => json_encode([
                    '24/7 Security',
                    'Swimming Pool',
                    'Gym',
                    'Children Playground',
                    'Power Supply',
                    'Water Supply',
                    'Waste Management',
                    'Car Park'
                ]),
                'images' => json_encode([
                    '/themes/classic/client/assets/images/property/1.jpg',
                    '/themes/classic/client/assets/images/property/2.jpg',
                    '/themes/classic/client/assets/images/property/3.jpg',
                    '/themes/classic/client/assets/images/property/16.jpg'
                ]),
                'meta_description' => 'Luxury 4-bedroom house for sale in Lekki, Lagos. Modern finishes, great location.',
                'meta_keywords' => 'luxury house, Lekki property, 4 bedroom house, Lagos real estate',
                'listed_at' => now(),
                'expires_at' => now()->addMonths(6),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Prime Land Plot in Victoria Island',
                'slug' => 'prime-land-plot-victoria-island',
                'property_type' => 'land',
                'listing_type' => 'sale',
                'status' => 'available',
                'description' => 'Prime commercial land plot in the heart of Victoria Island. Perfect for development of residential or commercial buildings. Excellent investment opportunity with great appreciation potential.',
                'address' => '25 Kofo Abayomi Street',
                'city' => 'Victoria Island',
                'state' => 'Lagos',
                'postal_code' => '101001',
                'country' => 'Nigeria',
                'latitude' => 6.4280,
                'longitude' => 3.4219,
                'bedrooms' => null,
                'bathrooms' => null,
                'parking_spaces' => null,
                'land_size' => 1200.00,
                'built_area' => null,
                'year_built' => null,
                'price' => 120000000.00,
                'price_per_sqm' => 100000.00,
                'features' => json_encode([
                    'Corner Plot',
                    'C of O Available',
                    'Survey Plan Available',
                    'Gazette Available',
                    'Deed of Assignment Ready'
                ]),
                'amenities' => json_encode([
                    'Electricity Available',
                    'Good Road Network',
                    'Drainage System',
                    'Close to CBD',
                    'Public Transportation'
                ]),
                'images' => json_encode([
                    '/themes/classic/client/assets/images/property/7.jpg',
                    '/themes/classic/client/assets/images/property/8.jpg',
                    '/themes/classic/client/assets/images/property/24.jpg'
                ]),
                'meta_description' => 'Prime land plot for sale in Victoria Island, Lagos. Great investment opportunity.',
                'meta_keywords' => 'land for sale, Victoria Island, commercial land, investment property',
                'listed_at' => now(),
                'expires_at' => now()->addMonths(12),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($properties as $propertyData) {
            DB::table('properties')->insert($propertyData);
        }

        $this->command->info('Properties seeded successfully!');
    }
}
