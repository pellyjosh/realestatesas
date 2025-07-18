<?php

namespace App\Http\Controllers\Tenant\Realtor;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Event;
use App\Models\Tenant\EventBooking;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        // Get all events with their booking counts
        $events = Event::withCount('eventBookings')
            ->with(['eventBookings' => function ($query) {
                $query->select('event_id', 'first_name', 'last_name', 'phone');
            }])
            ->orderBy('start_date_time', 'desc')
            ->get();

        // If no events exist, create some sample data for testing
        if ($events->isEmpty()) {
            $this->createSampleEvents();
            $events = Event::withCount('eventBookings')
                ->with(['eventBookings' => function ($query) {
                    $query->select('event_id', 'first_name', 'last_name', 'phone');
                }])
                ->orderBy('start_date_time', 'desc')
                ->get();
        }

        return tenant_view('realtor.pages.events', compact('events'));
    }

    public function getEventBookings($eventId)
    {
        $event = Event::findOrFail($eventId);
        $bookings = $event->eventBookings()
            ->select('id', 'first_name', 'last_name', 'phone', 'email', 'referral_code')
            ->get();

        return response()->json([
            'success' => true,
            'bookings' => $bookings,
            'event' => $event->only('id', 'name')
        ]);
    }

    public function getReferralStats($eventId)
    {
        $event = Event::findOrFail($eventId);
        $totalBookings = $event->eventBookings()->count();
        $directBookings = $event->eventBookings()->whereNull('referred_by_code')->count();
        $referredBookings = $event->eventBookings()->whereNotNull('referred_by_code')->count();

        // Get top referrers - simplified query
        $topReferrers = $event->eventBookings()
            ->whereNotNull('referred_by_code')
            ->selectRaw('first_name, last_name, COUNT(*) as referral_count')
            ->groupBy('first_name', 'last_name')
            ->orderByDesc('referral_count')
            ->limit(5)
            ->get();

        return response()->json([
            'success' => true,
            'stats' => [
                'total_bookings' => $totalBookings,
                'direct_bookings' => $directBookings,
                'referred_bookings' => $referredBookings,
                'top_referrers' => $topReferrers
            ]
        ]);
    }

    public function exportBookings($eventId)
    {
        $event = Event::findOrFail($eventId);
        $bookings = $event->eventBookings()->get();

        $filename = 'event_bookings_' . $event->id . '_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function () use ($bookings) {
            $file = fopen('php://output', 'w');

            // CSV headers
            fputcsv($file, [
                'First Name',
                'Last Name',
                'Email',
                'Phone',
                'How Heard',
                'Inviter Name',
                'Inviter Phone',
                'Referral Code',
                'Referred By Code',
                'Registration Date'
            ]);

            // CSV data
            foreach ($bookings as $booking) {
                fputcsv($file, [
                    $booking->first_name,
                    $booking->last_name,
                    $booking->email,
                    $booking->phone,
                    $booking->how_heard,
                    $booking->inviter_name,
                    $booking->inviter_phone,
                    $booking->referral_code,
                    $booking->referred_by_code,
                    $booking->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function createSampleEvents()
    {
        // Create sample events if none exist
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
                $referralCode = strtoupper(\Illuminate\Support\Str::random(8));

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
                    'referred_by_code' => $i > 0 ? strtoupper(\Illuminate\Support\Str::random(8)) : null,
                ]);
            }
        }
    }
}
