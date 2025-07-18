<?php

namespace App\Http\Controllers\Tenant\Realtor;

use App\Http\Controllers\Controller;
use App\Models\Tenant\TenantUser;
use App\Models\Tenant\Wallet;
use App\Models\Tenant\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{
    public function index()
    {
        $user = $this->getTenantUser();
        $wallet = $user->getOrCreateWallet();

        $transactions = $wallet->transactions()
            ->with(['transactionable'])
            ->latest()
            ->paginate(20);

        $recentTransactions = $wallet->transactions()
            ->latest()
            ->limit(5)
            ->get();

        $monthlyEarnings = $wallet->transactions()
            ->where('type', Transaction::TYPE_COMMISSION)
            ->where('status', Transaction::STATUS_COMPLETED)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        $totalEarnings = $wallet->transactions()
            ->where('type', Transaction::TYPE_COMMISSION)
            ->where('status', Transaction::STATUS_COMPLETED)
            ->sum('amount');

        return tenant_view('realtor.pages.wallet', [
            'wallet' => $wallet,
            'transactions' => $transactions,
            'recentTransactions' => $recentTransactions,
            'monthlyEarnings' => $monthlyEarnings,
            'totalEarnings' => $totalEarnings,
        ]);
    }

    public function withdraw(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:100|max:1000000',
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:20',
            'account_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = $this->getTenantUser();
            $wallet = $user->getOrCreateWallet();

            if (!$wallet->canDebit($request->amount)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient balance for this withdrawal.'
                ], 400);
            }

            DB::beginTransaction();

            // Create pending withdrawal transaction
            $transaction = $wallet->transactions()->create([
                'user_id' => $user->id,
                'type' => Transaction::TYPE_WITHDRAWAL,
                'direction' => Transaction::DIRECTION_DEBIT,
                'amount' => $request->amount,
                'currency' => $wallet->currency,
                'status' => Transaction::STATUS_PENDING,
                'description' => $request->description ?: "Withdrawal to {$request->bank_name}",
                'metadata' => [
                    'bank_name' => $request->bank_name,
                    'account_number' => $request->account_number,
                    'account_name' => $request->account_name,
                    'withdrawal_method' => 'bank_transfer',
                ],
                'reference' => $this->generateWithdrawalReference(),
                'balance_before' => $wallet->balance,
                'balance_after' => $wallet->balance, // Will be updated when processed
            ]);

            // Update available balance (but not actual balance until processed)
            $wallet->update([
                'available_balance' => $wallet->available_balance - $request->amount,
                'last_transaction_at' => now(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Withdrawal request submitted successfully. It will be processed within 24 hours.',
                'transaction' => $transaction
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your withdrawal request.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function transactions(Request $request)
    {
        $user = $this->getTenantUser();
        $wallet = $user->getOrCreateWallet();

        $query = $wallet->transactions()->with(['transactionable']);

        // Filter by type
        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->has('from_date') && $request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->has('to_date') && $request->to_date) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $transactions = $query->latest()->paginate(20);

        return response()->json([
            'success' => true,
            'transactions' => $transactions
        ]);
    }

    public function getWalletStats()
    {
        $user = $this->getTenantUser();
        $wallet = $user->getOrCreateWallet();

        $stats = [
            'balance' => $wallet->balance,
            'available_balance' => $wallet->available_balance,
            'pending_balance' => $wallet->pending_balance,
            'total_earnings' => $wallet->transactions()
                ->where('type', Transaction::TYPE_COMMISSION)
                ->where('status', Transaction::STATUS_COMPLETED)
                ->sum('amount'),
            'this_month_earnings' => $wallet->transactions()
                ->where('type', Transaction::TYPE_COMMISSION)
                ->where('status', Transaction::STATUS_COMPLETED)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('amount'),
            'pending_withdrawals' => $wallet->transactions()
                ->where('type', Transaction::TYPE_WITHDRAWAL)
                ->where('status', Transaction::STATUS_PENDING)
                ->sum('amount'),
            'total_withdrawals' => $wallet->transactions()
                ->where('type', Transaction::TYPE_WITHDRAWAL)
                ->where('status', Transaction::STATUS_COMPLETED)
                ->sum('amount'),
        ];

        return response()->json([
            'success' => true,
            'stats' => $stats
        ]);
    }

    protected function getTenantUser()
    {
        $userId = Auth::id();
        return TenantUser::findOrFail($userId);
    }

    protected function generateWithdrawalReference(): string
    {
        return 'WDR-' . strtoupper(uniqid()) . '-' . time();
    }
}
