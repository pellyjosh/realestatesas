<?php

namespace Database\Seeders\Tenant;

use App\Models\Property;
use App\Models\PropertyInspection;
use App\Models\Tenant\TenantUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyInspectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get sample properties and users
        $properties = Property::take(2)->get();
        $realtors = TenantUser::take(2)->get();

        if ($properties->count() > 0 && $realtors->count() > 0) {
            DB::table('property_inspections')->insert([
                [
                    'property_id' => $properties->first()->id,
                    'name' => 'Alice Johnson',
                    'email' => 'alice@example.com',
                    'phone' => '+234 801 111 2222',
                    'preferred_date' => now()->addDays(3)->format('Y-m-d'),
                    'preferred_time' => '10:00:00',
                    'message' => 'I am interested in viewing this property for purchase.',
                    'status' => 'pending',
                    'realtor_id' => $realtors->first()->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'property_id' => $properties->last()->id,
                    'name' => 'Bob Smith',
                    'email' => 'bob@example.com',
                    'phone' => '+234 802 333 4444',
                    'preferred_date' => now()->addDays(5)->format('Y-m-d'),
                    'preferred_time' => '14:00:00',
                    'message' => 'Would like to schedule a viewing for this apartment.',
                    'status' => 'confirmed',
                    'realtor_id' => $realtors->last()->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);

            $this->command->info('Property inspections seeded successfully!');
        } else {
            $this->command->warn('No properties or users found. Please seed properties and users first.');
        }
    }
}
