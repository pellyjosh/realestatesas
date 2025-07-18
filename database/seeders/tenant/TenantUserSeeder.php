<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\TenantUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TenantUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a default user with referral code if none exists
        if (TenantUser::count() === 0) {
            TenantUser::create([
                'name' => 'John Doe',
                'email' => 'agent@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'phone' => '+234 801 234 5678',
                'referral_code' => 'AGENT001',
                'occupation' => 'Senior Property Advisor',
                'gender' => 'male',
                'residential_address' => 'Lagos, Nigeria'
            ]);

            TenantUser::create([
                'name' => 'Jane Smith',
                'email' => 'agent2@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'phone' => '+234 801 234 5679',
                'referral_code' => 'AGENT002',
                'occupation' => 'Property Consultant',
                'gender' => 'female',
                'residential_address' => 'Abuja, Nigeria'
            ]);

            $this->command->info('Tenant users seeded successfully!');
        } else {
            $this->command->info('Tenant users already exist.');
        }
    }
}
