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
        $landingPages = LandingPage::with('property')->get();

        // Log::alert([$landingPages]);
        $properties = Property::select('id', 'name')->get();
        return tenant_view('realtor.pages.landing.landing-page-list', [
            'landingPages' => $landingPages,
            'properties' => $properties,
        ]);
    }

    public function show($userId, $propertyId)
    {
        $landingPage = LandingPage::with('property')
            ->where('user_id', $userId)
            ->where('property_id', $propertyId)
            ->firstOrFail();

        return tenant_view('realtor.pages.landing.landing-page', [
            'landingPage' => $landingPage,
        ]);
    }

    public function create(Request $request)
    {
        $userId = Auth::guard('tenant')->id();

        $validated = $request->validate([
            'type' => 'required|in:listing,promo,referral',
            'property' => [
                'required',
                'exists:properties,id',
                Rule::unique('landing_pages', 'property_id')->where(fn($q) => $q->where('user_id', $userId)),
            ],
            'expiration' => 'required|date|after:now',
        ]);

        $propertyId = $validated['property'];

        $page = LandingPage::create([
            'user_id' => $userId,
            'type' => $validated['type'],
            'property_id' => $propertyId,
            'expires_at' => $validated['expiration'],
            'link' => route('tenant.realtor.landing-page', [
                'userId' => $userId,
                'propertyId' => $propertyId,
            ]),
        ]);

        return response()->json([
            'message' => 'Landing page created successfully!',
            'landingPage' => $page->load('property'),
        ]);
    }

    public function deactivate($id)
    {
        $landingPage = LandingPage::where('user_id', Auth::id())->findOrFail($id);
        $landingPage->update(['is_active' => false]);

        return response()->json(['message' => 'Landing page deactivated!']);
    }

    public function delete($id)
    {
        $landingPage = LandingPage::where('user_id', Auth::id())->findOrFail($id);
        $landingPage->delete();

        return response()->json(['message' => 'Landing page deleted!']);
    }
}
