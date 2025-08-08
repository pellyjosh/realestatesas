<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant\TenantUser;
use App\Models\Tenant\Realtor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use App\Models\Tenant\Admin\HomeSection;

class RealtorController extends Controller
{
    /**
     * Suspend or unsuspend a realtor (AJAX).
     */
    public function suspend(Request $request, $id)
    {

        $realtor = Realtor::find($id);
        if (!$realtor) {
            return response()->json([
                'success' => false,
                'message' => 'Realtor not found.'
            ], 404);
        }

        $status = $request->input('status');
        if (Schema::hasColumn('realtors', 'status') && in_array($status, ['active', 'suspended'])) {
            $realtor->status = $status;
            $realtor->save();
            return response()->json([
                'success' => true,
                'message' => $status === 'suspended' ? 'Realtor suspended!' : 'Realtor unsuspended!'
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Invalid status.'
        ], 400);
    }
    /**
     * Display a listing of realtors.
     */
    public function index()
    {
        // Fetch directly from the Realtor table, eager load the related user
        $realtors = Realtor::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return tenant_view('admin.pages.realtor.all-realtor', compact('realtors'));
    }

    /**
     * Show the form for creating a new realtor.
     */
    public function create()
    {
        return tenant_view('admin.pages.realtor.add-realtor');
    }

    /**
     * Store a newly created realtor in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
            ],
            'phone' => ['required', 'string', 'max:20', Rule::unique('realtors', 'phone')],
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'nullable|date|before:today',
            'description' => 'nullable|string|max:1000',
            'address' => 'nullable|string|max:500',
            'zip_code' => 'nullable|string|max:20',
            'title' => 'nullable|string|max:50',
            'title_other' => 'nullable|string|max:50',
            'marital_status' => 'nullable|string|max:50',
            'marital_status_other' => 'nullable|string|max:50',
            'nationality' => 'nullable|string|max:50',
            'state_of_origin' => 'nullable|string|max:50',
            'lga' => 'nullable|string|max:50',
            'hometown' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            return DB::transaction(function () use ($request) {
                // Handle image upload first
                $imageUrl = null;
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = 'realtor_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    // Store in tenant-specific directory
                    $imagePath = $image->storeAs('realtors/images', $imageName, 'tenant_public');
                    $imageUrl = $imagePath;
                }

                // Create user record for login
                $userData = [
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'type' => 'realtor',
                    'image_url' => $imageUrl, // null if no image
                    'referral_code' => null,
                    'gender' => $request->gender,
                    'date_of_birth' => $request->date_of_birth,
                    'title' => $request->title,
                    'marital_status' => $request->marital_status,
                    'nationality' => $request->nationality,
                    'state_of_origin' => $request->state_of_origin,
                    'lga' => $request->lga,
                    'hometown' => $request->hometown,
                    'residential_address' => $request->address,
                ];

                // Generate referral code
                if (empty($userData['referral_code'])) {
                    $userData['referral_code'] = strtoupper(Str::random(10));
                }

                $user = TenantUser::create($userData);

                // Prepare realtor data
                $realtorData = [
                    'user_id' => $user->id,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'date_of_birth' => $request->date_of_birth,
                    'title' => $request->title,
                    'title_other' => $request->title_other,
                    'marital_status' => $request->marital_status,
                    'marital_status_other' => $request->marital_status_other,
                    'nationality' => $request->nationality,
                    'state_of_origin' => $request->state_of_origin,
                    'lga' => $request->lga,
                    'hometown' => $request->hometown,
                    'residential_address' => $request->address,
                    'zip_code' => $request->zip_code,
                    'description' => $request->description,
                    'image_url' => $imageUrl, // also set on realtor for consistency
                ];

                // Create realtor record
                $realtor = Realtor::create($realtorData);

                return response()->json([
                    'success' => true,
                    'message' => 'Realtor created successfully!',
                    'realtor' => $realtor->load('user'),
                    'redirect' => route('tenant.admin.all.realtors')
                ]);
            });
        } catch (\Exception $e) {
            Log::error('Realtor creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['password', 'password_confirmation'])
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the realtor: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified realtor.
     */
    public function show(TenantUser $realtor)
    {
        if ($realtor->type !== 'realtor') {
            abort(404);
        }

        return tenant_view('admin.pages.realtor.realtor-profile', compact('realtor'));
    }

    /**
     * Show the form for editing the specified realtor.
     */
    public function edit(TenantUser $realtor)
    {
        if ($realtor->type !== 'realtor') {
            abort(404);
        }

        return tenant_view('admin.pages.realtor.edit-realtor', compact('realtor'));
    }

    /**
     * Update the specified realtor in storage.
     */
    public function update(Request $request, TenantUser $realtor)
    {
        if ($realtor->type !== 'realtor') {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($realtor->id)
            ],
            'phone' => 'required|string|max:20',
            // Password fields removed from validation
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'nullable|date|before:today',
            'description' => 'nullable|string|max:1000',
            'address' => 'nullable|string|max:500',
            'zip_code' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Fix date_of_birth format
            $dateOfBirth = $request->date_of_birth;
            if ($dateOfBirth) {
                try {
                    $dateOfBirth = \Carbon\Carbon::parse($dateOfBirth)->format('Y-m-d');
                } catch (\Exception $e) {
                    $dateOfBirth = null;
                }
            }

            // Update TenantUser fields
            $userData = [
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'date_of_birth' => $dateOfBirth,
                'title' => $request->title,
                'marital_status' => $request->marital_status,
                'nationality' => $request->nationality,
                'state_of_origin' => $request->state_of_origin,
                'lga' => $request->lga,
                'hometown' => $request->hometown,
                'residential_address' => $request->address,
            ];

            // Handle image upload for user
            if ($request->hasFile('image')) {
                if ($realtor->image_url) {
                    Storage::disk('tenant_public')->delete($realtor->image_url);
                }
                $image = $request->file('image');
                $imageName = 'realtor_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('realtors/images', $imageName, 'tenant_public');
                $userData['image_url'] = $imagePath;
            }

            $realtor->update($userData);

            // Update related Realtor record
            $realtorProfile = $realtor->realtor;
            if ($realtorProfile) {
                $realtorProfileData = [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'date_of_birth' => $dateOfBirth,
                    'title' => $request->title,
                    'title_other' => $request->title_other,
                    'marital_status' => $request->marital_status,
                    'marital_status_other' => $request->marital_status_other,
                    'nationality' => $request->nationality,
                    'state_of_origin' => $request->state_of_origin,
                    'lga' => $request->lga,
                    'hometown' => $request->hometown,
                    'residential_address' => $request->address,
                    'zip_code' => $request->zip_code,
                    'description' => $request->description,
                ];
                if ($request->hasFile('image')) {
                    $realtorProfileData['image_url'] = $userData['image_url'] ?? null;
                }
                $realtorProfile->update($realtorProfileData);
            }

            return response()->json([
                'success' => true,
                'message' => 'Realtor updated successfully!',
                'realtor' => $realtor->load('realtor'),
                'redirect' => route('tenant.admin.all.realtors')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the realtor: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified realtor from storage.
     */
    public function destroy(TenantUser $realtor)
    {
        if ($realtor->type !== 'realtor') {
            abort(404);
        }

        try {
            // Delete image if exists
            if ($realtor->image_url) {
                Storage::disk('tenant_public')->delete($realtor->image_url);
            }

            $realtor->delete();

            return response()->json([
                'success' => true,
                'message' => 'Realtor deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the realtor: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle a realtor's homepage status (AJAX).
     */
    public function toggleHomepage(Request $request, $id)
    {
        // HomeSection model should have a 'homepage_realtors' section with a 'selected' array of realtor IDs
        $realtor = Realtor::find($id);
        if (!$realtor) {
            return response()->json([
                'success' => false,
                'message' => 'Realtor not found.'
            ], 404);
        }

        // Use the 'realtor' section for homepage realtors
        $section = HomeSection::firstOrCreate(
            ['name' => 'realtor'],
            ['data' => json_encode(['selected' => []]), 'is_enabled' => true]
        );
        $data = is_array($section->data) ? $section->data : (json_decode($section->data, true) ?: []);
        $selected = isset($data['selected']) && is_array($data['selected']) ? $data['selected'] : [];
        // Normalize to array of objects {realtor_id: X}
        $selected = array_map(function ($item) {
            if (is_array($item) && isset($item['realtor_id'])) return $item;
            if (is_numeric($item)) return ['realtor_id' => (int)$item];
            return $item;
        }, $selected);

        $exists = false;
        foreach ($selected as $key => $item) {
            if (is_array($item) && isset($item['realtor_id']) && $item['realtor_id'] == $realtor->id) {
                $exists = $key;
                break;
            }
        }
        if ($exists !== false) {
            // Remove
            array_splice($selected, $exists, 1);
            $message = 'Realtor removed from homepage.';
        } else {
            $selected[] = ['realtor_id' => $realtor->id];
            $message = 'Realtor added to homepage.';
        }
        $data['selected'] = $selected;
        $section->data = $data;
        $section->save();
        return response()->json([
            'success' => true,
            'message' => $message,
            'selected' => $selected
        ]);
    }

    /**
     * Get realtor image URL
     */
    public function getImageUrl(TenantUser $realtor)
    {
        if ($realtor->image_url) {
            return asset('storage/tenant' . tenant('id') . '/' . $realtor->image_url);
        }

        return asset('assets/images/avatar/default-avatar.png'); // Default avatar
    }
}
