<?php

namespace App\Http\Controllers\Tenant\Realtor;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\tenant\realtor\LandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class LandingPageController extends Controller
{
    // In your Laravel controller (e.g., LandingPageController.php)
    public function index()
    {
        $currentUser = Auth::guard('tenant')->user();

        $landingPages = LandingPage::with(['property', 'user'])
            ->where('user_id', $currentUser->id)
            ->get()
            ->map(function ($landingPage) {
                // Generate referral link with property slug and user's referral code
                $referralCode = $landingPage->user->referral_code ?? 'USER' . $landingPage->user_id;
                $referralLink = route('tenant.realtor.landing-page', [
                    'propertySlug' => $landingPage->property->slug,
                ]) . '?ref=' . $referralCode;

                return [
                    'id' => $landingPage->id,
                    'user_id' => $landingPage->user_id,
                    'property_id' => $landingPage->property_id,
                    'type' => $landingPage->type,
                    'link' => $landingPage->link,
                    'referral_link' => $referralLink,
                    'user_referral_code' => $referralCode,
                    'expires_at' => $landingPage->expires_at,
                    'is_active' => $landingPage->is_active,
                    'property' => $landingPage->property,
                    'created_at' => $landingPage->created_at,
                    'updated_at' => $landingPage->updated_at,
                ];
            });

        $properties = Property::select('id', 'name')->get();
        return tenant_view('realtor.pages.landing.landing-page-list', [
            'landingPages' => $landingPages,
            'properties' => $properties,
        ]);
    }

    public function show($propertySlug, Request $request)
    {
        // Find property by slug
        $property = Property::where('slug', $propertySlug)->first();

        if (!$property) {
            abort(404, 'Property not found');
        }

        // Find active landing page for this property
        $landingPage = LandingPage::with('property')
            ->where('property_id', $property->id)
            ->where('is_active', true)
            ->first();

        if (!$landingPage) {
            abort(404, 'No active landing page found for this property');
        }

        // Check if the landing page has expired
        if ($landingPage->expires_at && $landingPage->expires_at < now()) {
            return tenant_view('realtor.pages.landing.expired', [
                'message' => 'This landing page has expired.',
                'propertyName' => $landingPage->property->name ?? 'Property',
                'expiredAt' => $landingPage->expires_at
            ]);
        }

        // Get referral user from the 'ref' parameter
        $referralUser = null;
        $referralCode = $request->get('ref');

        if ($referralCode) {
            $referralUser = \App\Models\Tenant\TenantUser::where('referral_code', $referralCode)->first();

            // If no referral user found, you might want to log this or handle it
            if (!$referralUser) {
                Log::warning("Invalid referral code used: {$referralCode}");
            }
        }

        // Route to different views based on landing page type
        $viewData = [
            'landingPage' => $landingPage,
            'referralUser' => $referralUser,
        ];

        if ($landingPage->type === 'inspection') {
            return tenant_view('realtor.pages.landing.inspection-form', $viewData);
        } else {
            // Default to the full landing page for promotion type
            return tenant_view('realtor.pages.landing.landing-page', $viewData);
        }
    }

    public function create(Request $request)
    {
        $userId = Auth::guard('tenant')->id();
        $currentUser = Auth::guard('tenant')->user();

        $validated = $request->validate([
            'type' => 'required|in:promotion,inspection',
            'property' => [
                'required',
                'exists:properties,id',
                Rule::unique('landing_pages', 'property_id')->where(fn($q) => $q->where('user_id', $userId)),
            ],
            'expiration' => 'required|date|after:now',
        ]);

        $propertyId = $validated['property'];
        $property = Property::findOrFail($propertyId);

        $page = LandingPage::create([
            'user_id' => $userId,
            'type' => $validated['type'],
            'property_id' => $propertyId,
            'expires_at' => $validated['expiration'],
            'link' => route('tenant.realtor.landing-page', [
                'propertySlug' => $property->slug,
            ]),
        ]);

        // Load the page with relationships and generate referral data
        $page->load(['property', 'user']);
        $referralCode = $currentUser->referral_code ?? 'USER' . $userId;
        $referralLink = route('tenant.realtor.landing-page', [
            'propertySlug' => $property->slug,
        ]) . '?ref=' . $referralCode;

        // Return the formatted response similar to index method
        $formattedPage = [
            'id' => $page->id,
            'user_id' => $page->user_id,
            'property_id' => $page->property_id,
            'type' => $page->type,
            'link' => $page->link,
            'referral_link' => $referralLink,
            'user_referral_code' => $referralCode,
            'expires_at' => $page->expires_at,
            'is_active' => $page->is_active,
            'property' => $page->property,
            'created_at' => $page->created_at,
            'updated_at' => $page->updated_at,
        ];

        return response()->json([
            'message' => 'Landing page created successfully!',
            'landingPage' => $formattedPage,
        ]);
    }

    public function activate($id)
    {
        $landingPage = LandingPage::where('user_id', Auth::guard('tenant')->id())->findOrFail($id);
        $landingPage->update(['is_active' => true]);

        return response()->json(['message' => 'Landing page activated!']);
    }

    public function deactivate($id)
    {
        $landingPage = LandingPage::where('user_id', Auth::guard('tenant')->id())->findOrFail($id);
        $landingPage->update(['is_active' => false]);

        return response()->json(['message' => 'Landing page deactivated!']);
    }

    public function delete($id)
    {
        $landingPage = LandingPage::where('user_id', Auth::guard('tenant')->id())->findOrFail($id);
        $landingPage->delete();

        return response()->json(['message' => 'Landing page deleted!']);
    }
}
