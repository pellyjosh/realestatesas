<?php

namespace App\Http\Controllers\Tenant\Client;

use App\Http\Controllers\Controller;
use App\Models\PropertyInspection;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class PropertyInspectionController extends Controller
{
    /**
     * Store a new property inspection request.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'property_id' => 'nullable|exists:properties,id',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'preferred_date' => 'required|date|after:today',
                'preferred_time' => 'required|date_format:H:i',
                'message' => 'nullable|string|max:1000',
                'referral_code' => 'nullable|string|max:50',
            ]);

            // Find the realtor from referral code if provided
            $realtorId = null;
            if (!empty($validated['referral_code'])) {
                $referralUser = \App\Models\Tenant\TenantUser::where('referral_code', $validated['referral_code'])->first();
                if ($referralUser) {
                    $realtorId = $referralUser->id;
                    Log::info('Inspection booked through referral', [
                        'referral_code' => $validated['referral_code'],
                        'realtor_id' => $realtorId,
                        'property_id' => $validated['property_id'],
                    ]);
                } else {
                    Log::warning('Invalid referral code used in inspection booking', [
                        'referral_code' => $validated['referral_code'],
                    ]);
                }
            }

            // Create the inspection request
            $inspection = PropertyInspection::create([
                'property_id' => $validated['property_id'] ?? null,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'preferred_date' => $validated['preferred_date'],
                'preferred_time' => $validated['preferred_time'],
                'message' => $validated['message'] ?? null,
                'status' => PropertyInspection::STATUS_PENDING,
                'realtor_id' => $realtorId, // Set the realtor_id based on referral code
                'tenant_id' => tenant('id'),
            ]);

            // Send notification email to admin/realtor
            $this->sendInspectionNotification($inspection);

            // Send confirmation email to client
            $this->sendClientConfirmation($inspection);

            return response()->json([
                'success' => true,
                'message' => 'Your inspection request has been submitted successfully! We will contact you within 24 hours to confirm the details.',
                'inspection_id' => $inspection->id,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Please check your input and try again.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Property inspection submission failed', [
                'error' => $e->getMessage(),
                'request_data' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error processing your request. Please try again or contact us directly.',
            ], 500);
        }
    }

    /**
     * Get property details for a specific property.
     */
    public function getPropertyDetails(Request $request)
    {
        try {
            $propertyId = $request->get('property_id');

            if (!$propertyId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Property ID is required',
                ], 400);
            }

            $property = Property::find($propertyId);

            if (!$property) {
                return response()->json([
                    'success' => false,
                    'message' => 'Property not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'property' => [
                    'id' => $property->id,
                    'name' => $property->name,
                    'address' => $property->address ?? 'Address not available',
                    'price' => $property->price ?? null,
                    'bedrooms' => $property->bedrooms ?? null,
                    'bathrooms' => $property->bathrooms ?? null,
                    'size' => $property->size ?? null,
                    'coordinates' => [
                        'lat' => $property->latitude ?? 25.246701,
                        'lng' => $property->longitude ?? 55.29124,
                    ],
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch property details', [
                'error' => $e->getMessage(),
                'property_id' => $propertyId ?? null,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch property details',
            ], 500);
        }
    }

    /**
     * Get all inspection requests (for admin/realtor).
     */
    public function index(Request $request)
    {
        try {
            $query = PropertyInspection::with(['property'])
                ->orderBy('created_at', 'desc');

            // Filter by status if provided
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            // Filter by date range if provided
            if ($request->filled('date_from')) {
                $query->whereDate('preferred_date', '>=', $request->date_from);
            }

            if ($request->filled('date_to')) {
                $query->whereDate('preferred_date', '<=', $request->date_to);
            }

            $inspections = $query->paginate(15);

            return response()->json([
                'success' => true,
                'inspections' => $inspections,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch inspections', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch inspection requests',
            ], 500);
        }
    }

    /**
     * Update inspection status.
     */
    public function updateStatus(Request $request, PropertyInspection $inspection)
    {
        try {
            $validated = $request->validate([
                'status' => [
                    'required',
                    Rule::in([
                        PropertyInspection::STATUS_PENDING,
                        PropertyInspection::STATUS_CONFIRMED,
                        PropertyInspection::STATUS_COMPLETED,
                        PropertyInspection::STATUS_CANCELLED,
                    ]),
                ],
                'notes' => 'nullable|string|max:500',
            ]);

            $inspection->update([
                'status' => $validated['status'],
            ]);

            // Send status update notification to client
            $this->sendStatusUpdateNotification($inspection, $validated['status']);

            return response()->json([
                'success' => true,
                'message' => 'Inspection status updated successfully',
                'inspection' => $inspection->fresh(),
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to update inspection status', [
                'error' => $e->getMessage(),
                'inspection_id' => $inspection->id,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update inspection status',
            ], 500);
        }
    }

    /**
     * Send inspection notification to admin/realtor.
     */
    private function sendInspectionNotification(PropertyInspection $inspection)
    {
        try {
            // Here you would implement your email notification logic
            // For now, we'll just log it
            Log::info('New inspection request received', [
                'inspection_id' => $inspection->id,
                'client_name' => $inspection->name,
                'client_email' => $inspection->email,
                'preferred_date' => $inspection->preferred_date,
                'preferred_time' => $inspection->preferred_time,
            ]);

            // You can implement actual email sending here using Laravel Mail
            // Mail::to('admin@realestate.com')->send(new InspectionRequestMail($inspection));

        } catch (\Exception $e) {
            Log::error('Failed to send inspection notification', [
                'error' => $e->getMessage(),
                'inspection_id' => $inspection->id,
            ]);
        }
    }

    /**
     * Send confirmation email to client.
     */
    private function sendClientConfirmation(PropertyInspection $inspection)
    {
        try {
            // Log confirmation for now
            Log::info('Inspection confirmation sent to client', [
                'inspection_id' => $inspection->id,
                'client_email' => $inspection->email,
            ]);

            // You can implement actual email sending here
            // Mail::to($inspection->email)->send(new InspectionConfirmationMail($inspection));

        } catch (\Exception $e) {
            Log::error('Failed to send client confirmation', [
                'error' => $e->getMessage(),
                'inspection_id' => $inspection->id,
            ]);
        }
    }

    /**
     * Send status update notification to client.
     */
    private function sendStatusUpdateNotification(PropertyInspection $inspection, string $status)
    {
        try {
            Log::info('Inspection status update sent to client', [
                'inspection_id' => $inspection->id,
                'client_email' => $inspection->email,
                'new_status' => $status,
            ]);

            // You can implement actual email sending here
            // Mail::to($inspection->email)->send(new InspectionStatusUpdateMail($inspection, $status));

        } catch (\Exception $e) {
            Log::error('Failed to send status update notification', [
                'error' => $e->getMessage(),
                'inspection_id' => $inspection->id,
            ]);
        }
    }
}
