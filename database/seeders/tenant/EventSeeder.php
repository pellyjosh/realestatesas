<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use App\Models\Tenant\Event;
use App\Models\Tenant\EventBooking;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run()
    {
        // Create sample events
        $events = [
            [
                'name' => 'Realtors Special Funding Program',
                'description' => 'Special funding program for real estate professionals.',
                'start_date_time' => '2025-06-02 09:00:00',
                'end_date_time' => '2025-06-09 17:00:00',
                'location' => 'Lagos Convention Center',
            ],
            [
                'name' => 'Invest in Landed Properties',
                'description' => 'Learn about investing in landed properties.',
                'start_date_time' => '2025-08-15 10:00:00',
                'end_date_time' => '2025-08-22 16:00:00',
                'location' => 'Abuja Conference Center',
            ],
            [
                'name' => 'Realtor Training',
                'description' => 'Professional training for real estate agents.',
                'start_date_time' => '2025-07-01 08:00:00',
                'end_date_time' => '2025-07-14 18:00:00',
                'location' => 'Port Harcourt Training Center',
            ],
        ];

        foreach ($events as $eventData) {
            $event = Event::create($eventData);

            // Create sample bookings for each event
            $bookingCount = rand(0, 5);

            for ($i = 0; $i < $bookingCount; $i++) {
                $referralCode = strtoupper(Str::random(8));

                EventBooking::create([
                    'event_id' => $event->id,
                    'event_name' => $event->name,
                    'first_name' => fake()->firstName(),
                    'last_name' => fake()->lastName(),
                    'email' => fake()->unique()->safeEmail(),
                    'phone' => fake()->phoneNumber(),
                    'how_heard' => fake()->randomElement(['Social Media', 'Friend', 'Website', 'Advertisement']),
                    'inviter_name' => $i > 0 ? fake()->name() : null,
                    'inviter_phone' => $i > 0 ? fake()->phoneNumber() : null,
                    'referral_code' => $referralCode,
                    'referred_by_code' => $i > 0 ? strtoupper(Str::random(8)) : null,
                ]);
            }
        }
    }
}
