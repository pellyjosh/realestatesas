<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventBooking;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class EventBookingController extends Controller
{
    public function bookEvent(Request $request)
    {
        $validatedData = $request->validate([
            'event_id' => 'nullable|integer',
            'event_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('event_bookings')->where(function ($query) use ($request) {
                    return $query->where('event_id', $request->event_id);
                }),
            ],
            'how_heard' => 'nullable|string|max:255',
            'inviter_referral_code' => 'nullable|string|exists:event_bookings,referral_code', // The code from the form
        ]);

        $inviterData = [];
        // If an inviter's referral code was provided, find the inviter and get their details.
        if (!empty($validatedData['inviter_referral_code'])) {
            $inviter = EventBooking::where('referral_code', $validatedData['inviter_referral_code'])->first();
            if ($inviter) {
                $inviterData['inviter_name'] = $inviter->first_name . ' ' . $inviter->last_name;
                $inviterData['inviter_phone'] = $inviter->phone;
            }
        }

        // Generate a unique referral code
        do {
            $referralCode = Str::random(10);
        } while (EventBooking::where('referral_code', $referralCode)->exists());

        // Merge validated data, inviter data, and the new referral code for the new booking
        $booking = EventBooking::create(array_merge($validatedData, $inviterData, [
            'referral_code' => $referralCode,
            'referred_by_code' => $validatedData['inviter_referral_code'] ?? null, // Add this line back
        ]));

        // Construct the full referral link
        $referralLink = url('/events?event_id=' . $booking->event_id . '&referral_code=' . $referralCode);

        return response()->json([
            'success' => true,
            'message' => 'Booking successful!',
            'referral_link' => $referralLink,
            'booking_id' => $booking->id,
        ]);
    }

    /**
     * Retrieve referral link by phone number.
     */
    public function retrieveReferral(Request $request)
    {
        $validatedData = $request->validate([
            'event_id' => 'required|integer|exists:events,id',
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::exists('event_bookings')->where(function ($query) use ($request) {
                    return $query->where('event_id', $request->event_id)
                        ->where('phone', $request->phone);
                }),
            ],
        ], [
            'phone.exists' => 'No booking found for the selected event with this phone number.'
        ]);

        $booking = EventBooking::where('event_id', $validatedData['event_id'])
            ->where('phone', $validatedData['phone'])
            ->first();

        if ($booking) {
            $referralLink = url('/events?event_id=' . $booking->event_id . '&referral_code=' . $booking->referral_code);
            return response()->json([
                'success' => true,
                'message' => 'Referral link retrieved.',
                'referral_link' => $referralLink,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No booking found for this phone number and event.',
        ], 404);
    }
}
