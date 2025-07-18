<?php

namespace App\Http\Controllers\Tenant\Realtor;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Tenant\Sale;
use App\Models\Tenant\SalesTemplate;
use App\Models\Tenant\Earning;
use App\Models\Tenant\PaymentPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    public function index()
    {
        $user = Auth::guard('tenant')->user();
        $tenantUser = \App\Models\Tenant\TenantUser::find($user->id);

        $sales = Sale::with(['property', 'user', 'earnings'])
            ->where('referral_id', $user->id)
            ->latest()
            ->get();

        $properties = Property::all();
        $templates = SalesTemplate::forUser($user->id)->get();
        $paymentPlans = PaymentPlan::active()->get();

        // Get user earnings transactions (commissions) directly from user relationship
        $userTransactions = [];
        if ($tenantUser) {
            $userTransactions = $tenantUser->commissionTransactions()
                ->with(['transactionable'])
                ->latest()
                ->get();
        }

        // Get earnings records (commission earnings from sales)
        $earnings = [];
        if ($tenantUser) {
            // Get all earnings where this user is the referral (realtor who made the sale)
            $earnings = Earning::where('user_id', $user->id)
                ->with(['sale', 'sale.property', 'sale.user'])
                ->latest()
                ->get();
        }

        return tenant_view('realtor.pages.sales', [
            'sales' => $sales,
            'properties' => $properties,
            'templates' => $templates,
            'paymentPlans' => $paymentPlans,
            'userTransactions' => $userTransactions,
            'earnings' => $earnings,
        ]);
    }

    public function store(Request $request)
    {
        // Remove existing_client_id if client_type is 'new' and existing_client_id is empty
        if ($request->client_type === 'new' && empty($request->existing_client_id)) {
            $request->request->remove('existing_client_id');
        }

        $validator = Validator::make($request->all(), [
            'client_type' => 'required|in:new,existing',
            'existing_client_id' => 'required_if:client_type,existing|exists:users,id',
            'title' => 'required_if:client_type,new|string',
            'full_name' => 'required_if:client_type,new|string|max:255',
            'gender' => 'required_if:client_type,new|string',
            'phone_number' => 'required_if:client_type,new|string|max:20',
            'email_address' => 'nullable|email|max:255',
            'estate_id' => 'required|exists:properties,id',
            'payment_mode' => 'required|string',
            'subscriber_type' => 'required|in:Individual,Organization',
            'terms_accepted' => 'required|boolean|accepted',
            'client_signature' => 'required|string',
            'signature_date' => 'required|date',
            'commercial_plots' => 'nullable|string', // Can be number or 'other'
            'residential_plots' => 'nullable|string', // Can be number or 'other'

            // Optional fields with nullable validation
            'title_other' => 'nullable|string|max:255',
            'marital_status_other' => 'nullable|string|max:255',
            'commercial_plots_other' => 'nullable|integer|min:0',
            'residential_plots_other' => 'nullable|integer|min:0',
            'organization_name' => 'nullable|string|max:255',
            'signatories' => 'nullable|array|min:3|max:3',
            'signatories.*.name' => 'nullable|string|max:255',
            'signatories.*.position' => 'nullable|string|max:255',
            'signatories.*.date' => 'nullable|date',
            'signatories.*.signature' => 'nullable|string|max:255',

            // Optional personal details (not required for existing clients)
            'date_of_birth' => 'nullable|date',
            'marital_status' => 'nullable|string',
            'occupation' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'state_of_origin' => 'nullable|string|max:255',
            'lga' => 'nullable|string|max:255',
            'hometown' => 'nullable|string|max:255',
            'residential_address' => 'nullable|string',
        ]);

        // Custom validation for conditional fields
        $validator->after(function ($validator) use ($request) {
            if ($request->title === 'Other' && empty($request->title_other)) {
                $validator->errors()->add('title_other', 'The title other field is required when title is Other.');
            }

            if ($request->marital_status === 'Others' && empty($request->marital_status_other)) {
                $validator->errors()->add('marital_status_other', 'The marital status other field is required when marital status is Others.');
            }

            if ($request->commercial_plots === 'other' && empty($request->commercial_plots_other)) {
                $validator->errors()->add('commercial_plots_other', 'The commercial plots other field is required when commercial plots is other.');
            }

            if ($request->residential_plots === 'other' && empty($request->residential_plots_other)) {
                $validator->errors()->add('residential_plots_other', 'The residential plots other field is required when residential plots is other.');
            }

            if ($request->subscriber_type === 'Organization') {
                if (empty($request->organization_name)) {
                    $validator->errors()->add('organization_name', 'The organization name field is required for organizations.');
                }

                if (empty($request->signatories) || count($request->signatories) < 3) {
                    $validator->errors()->add('signatories', 'Three signatories are required for organizations.');
                } else {
                    foreach ($request->signatories as $index => $signatory) {
                        if (empty($signatory['name'])) {
                            $validator->errors()->add("signatories.{$index}.name", "Signatory " . ($index + 1) . " name is required.");
                        }
                        if (empty($signatory['position'])) {
                            $validator->errors()->add("signatories.{$index}.position", "Signatory " . ($index + 1) . " position is required.");
                        }
                        if (empty($signatory['date'])) {
                            $validator->errors()->add("signatories.{$index}.date", "Signatory " . ($index + 1) . " date is required.");
                        }
                        if (empty($signatory['signature'])) {
                            $validator->errors()->add("signatories.{$index}.signature", "Signatory " . ($index + 1) . " signature is required.");
                        }
                    }
                }
            }
        });
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $clientUserId = null;
            $clientData = [];

            // Handle client creation or selection
            if ($request->client_type === 'new') {
                // Create new TenantUser for the client with all the personal details
                $newClient = \App\Models\Tenant\TenantUser::create([
                    'name' => $request->full_name,
                    'email' => $request->email_address,
                    'phone' => $request->phone_number,
                    'password' => Hash::make('password123'), // Default password, client can change later
                    // Personal Details
                    'title' => $request->title,
                    'title_other' => $request->title_other,
                    'gender' => $request->gender,
                    'date_of_birth' => $request->date_of_birth,
                    'marital_status' => $request->marital_status,
                    'marital_status_other' => $request->marital_status_other,
                    // Occupational Details
                    'occupation' => $request->occupation,
                    'nationality' => $request->nationality,
                    'state_of_origin' => $request->state_of_origin,
                    'lga' => $request->lga,
                    'hometown' => $request->hometown,
                    // Contact Information
                    'residential_address' => $request->residential_address
                ]);
                $clientUserId = $newClient->id;
                $clientData = [
                    'title' => $request->title,
                    'title_other' => $request->title_other,
                    'full_name' => $request->full_name,
                    'gender' => $request->gender,
                    'date_of_birth' => $request->date_of_birth,
                    'marital_status' => $request->marital_status,
                    'marital_status_other' => $request->marital_status_other,
                    'occupation' => $request->occupation,
                    'nationality' => $request->nationality,
                    'state_of_origin' => $request->state_of_origin,
                    'lga' => $request->lga,
                    'hometown' => $request->hometown,
                    'residential_address' => $request->residential_address,
                    'phone_number' => $request->phone_number,
                    'email_address' => $request->email_address,
                ];
            } else {
                // Use existing client and get their data
                $existingClient = \App\Models\Tenant\TenantUser::find($request->existing_client_id);
                $clientUserId = $existingClient->id;
                $clientData = [
                    'title' => $existingClient->title,
                    'title_other' => $existingClient->title_other,
                    'full_name' => $existingClient->name,
                    'gender' => $existingClient->gender,
                    'date_of_birth' => $existingClient->date_of_birth,
                    'marital_status' => $existingClient->marital_status,
                    'marital_status_other' => $existingClient->marital_status_other,
                    'occupation' => $existingClient->occupation,
                    'nationality' => $existingClient->nationality,
                    'state_of_origin' => $existingClient->state_of_origin,
                    'lga' => $existingClient->lga,
                    'hometown' => $existingClient->hometown,
                    'residential_address' => $existingClient->residential_address,
                    'phone_number' => $existingClient->phone,
                    'email_address' => $existingClient->email,
                ];
            }

            $sale = Sale::create([
                'user_id' => $clientUserId,
                'referral_id' => Auth::guard('tenant')->id(),
                'client_type' => $request->client_type,
                'property_id' => $request->estate_id,
                'title' => $clientData['title'] ?? '',
                'title_other' => $clientData['title_other'],
                'full_name' => $clientData['full_name'] ?? '',
                'gender' => $clientData['gender'] ?? '',
                'date_of_birth' => $clientData['date_of_birth'],
                'marital_status' => $clientData['marital_status'],
                'marital_status_other' => $clientData['marital_status_other'],
                'occupation' => $clientData['occupation'],
                'nationality' => $clientData['nationality'],
                'state_of_origin' => $clientData['state_of_origin'],
                'lga' => $clientData['lga'],
                'hometown' => $clientData['hometown'],
                'residential_address' => $clientData['residential_address'],
                'phone_number' => $clientData['phone_number'] ?? '',
                'email_address' => $clientData['email_address'],
                'commercial_plots' => $request->commercial_plots === 'other' ? ($request->commercial_plots_other ?: 0) : ($request->commercial_plots ?: 0),
                'commercial_plots_other' => $request->commercial_plots_other,
                'residential_plots' => $request->residential_plots === 'other' ? ($request->residential_plots_other ?: 0) : ($request->residential_plots ?: 0),
                'residential_plots_other' => $request->residential_plots_other,
                'payment_mode' => $request->payment_mode,
                'next_of_kin_name' => $request->next_of_kin_name,
                'next_of_kin_relationship' => $request->next_of_kin_relationship,
                'next_of_kin_phone' => $request->next_of_kin_phone,
                'next_of_kin_email' => $request->next_of_kin_email,
                'next_of_kin_address' => $request->next_of_kin_address,
                'subscriber_type' => $request->subscriber_type,
                'organization_name' => $request->organization_name,
                'signatories' => $request->signatories,
                'terms_accepted' => $request->terms_accepted,
                'client_signature' => $request->client_signature,
                'signature_date' => $request->signature_date,
                'witness_name' => $request->witness_name,
                'witness_phone' => $request->witness_phone,
                'witness_email' => $request->witness_email,
                'witness_address' => $request->witness_address,
                'witness_signature' => $request->witness_signature,
                'witness_date' => $request->witness_date,
                'status' => 'pending',
            ]);

            // Calculate total amount and commission (you can customize this logic)
            $property = Property::find($request->estate_id);
            $totalPlots = $sale->total_plots;
            $totalAmount = $totalPlots * ($property->price_per_plot ?? 100000); // Default price if not set

            // Get payment plan based on payment mode
            $paymentPlan = PaymentPlan::where('code', $request->payment_mode)
                ->orWhere('name', $request->payment_mode)
                ->first();

            // If payment plan exists, calculate payment details
            if ($paymentPlan) {
                // Calculate payment amounts based on payment plan
                $downPaymentAmount = ($totalAmount * $paymentPlan->down_payment_percentage) / 100;
                $balanceAfterDownPayment = $totalAmount - $downPaymentAmount;

                // Calculate interest if applicable
                $totalWithInterest = $balanceAfterDownPayment;
                if ($paymentPlan->interest_rate > 0) {
                    $totalWithInterest = $balanceAfterDownPayment * (1 + ($paymentPlan->interest_rate / 100));
                }

                $totalAmountToPay = $downPaymentAmount + $totalWithInterest;

                $sale->update([
                    'total_amount' => $totalAmount,
                    'down_payment_amount' => $downPaymentAmount,
                    'balance_amount' => $balanceAfterDownPayment,
                    'total_amount_with_interest' => $totalAmountToPay,
                    'payment_status' => 'pending'
                ]);

                // Create payment installments based on payment plan
                if ($paymentPlan->installments_count > 0) {
                    $installmentAmount = $totalWithInterest / $paymentPlan->installments_count;
                    $startDate = now();

                    for ($i = 1; $i <= $paymentPlan->installments_count; $i++) {
                        $dueDate = $startDate->copy()->addMonths($i);

                        \App\Models\Tenant\PaymentInstallment::create([
                            'sale_id' => $sale->id,
                            'payment_plan_id' => $paymentPlan->id,
                            'installment_number' => $i,
                            'amount_due' => round($installmentAmount, 2),
                            'amount_paid' => 0,
                            'due_date' => $dueDate,
                            'status' => 'pending'
                        ]);
                    }
                }
            } else {
                // Fallback for when no payment plan is found
                $sale->update([
                    'total_amount' => $totalAmount,
                    'payment_status' => 'pending'
                ]);
            }

            // Create earning record (5% commission example) - for the referral realtor
            Earning::create([
                'user_id' => Auth::guard('tenant')->id(), // The realtor who made the sale
                'sale_id' => $sale->id,
                'commission_rate' => 5.00, // 5% commission
                'sale_amount' => $totalAmount,
                'commission_amount' => ($totalAmount * 5) / 100,
                'status' => 'pending',
                'earned_date' => now(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Sale registered successfully!',
                'sale' => $sale->load(['property', 'user', 'earnings'])
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function saveTemplate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'template_data' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $userTemplateCount = SalesTemplate::where('user_id', Auth::guard('tenant')->id())->count();

            if ($userTemplateCount >= 3) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can only have maximum 3 templates. Please delete an existing template first.'
                ], 422);
            }

            $template = SalesTemplate::create([
                'user_id' => Auth::guard('tenant')->id(),
                'name' => $request->name,
                'description' => $request->description,
                'template_data' => $request->template_data,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Template saved successfully!',
                'template' => $template
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while saving the template.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteTemplate($id)
    {
        try {
            $template = SalesTemplate::where('user_id', Auth::guard('tenant')->id())->findOrFail($id);
            $template->delete();

            return response()->json([
                'success' => true,
                'message' => 'Template deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Template not found or you do not have permission to delete it.'
            ], 404);
        }
    }

    public function getTemplates()
    {
        $templates = SalesTemplate::forUser(Auth::guard('tenant')->id())->get();

        return response()->json([
            'success' => true,
            'templates' => $templates
        ]);
    }

    public function show($id)
    {
        try {
            $sale = Sale::with(['property', 'user', 'earnings'])
                ->where('referral_id', Auth::guard('tenant')->id())
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'sale' => $sale
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sale not found.'
            ], 404);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $sale = Sale::where('referral_id', Auth::guard('tenant')->id())->findOrFail($id);
            $sale->update([
                'status' => $request->status,
                'notes' => $request->notes,
            ]);

            // Update earnings status if sale is approved
            if ($request->status === 'approved') {
                $earnings = $sale->earnings()->update(['status' => 'approved']);

                // Create wallet transactions for approved earnings
                foreach ($sale->earnings as $earning) {
                    $earning->createWalletTransaction();
                }
            } elseif ($request->status === 'rejected') {
                $sale->earnings()->update(['status' => 'cancelled']);
            }

            return response()->json([
                'success' => true,
                'message' => 'Sale status updated successfully!',
                'sale' => $sale->load(['property', 'earnings'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sale not found.'
            ], 404);
        }
    }

    public function searchClients(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return response()->json(['clients' => []]);
        }

        $clients = \App\Models\Tenant\TenantUser::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('phone', 'like', "%{$query}%")
            ->select([
                'id',
                'name',
                'email',
                'phone',
                'title',
                'title_other',
                'gender',
                'date_of_birth',
                'marital_status',
                'marital_status_other',
                'occupation',
                'nationality',
                'state_of_origin',
                'lga',
                'hometown',
                'residential_address'
            ])
            ->limit(10)
            ->get();

        return response()->json(['clients' => $clients]);
    }
}
