<?php

namespace App\Http\Controllers\Tenant\Realtor;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Tenant\Sale;
use App\Models\Tenant\Transaction;
use App\Models\Tenant\TenantUser;
use App\Models\Tenant\GeneratedReport;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Display the reports dashboard
     */
    public function index()
    {
        return tenant_view('realtor.pages.reports');
    }

    /**
     * Get sales summary data for the authenticated realtor
     */
    public function getSalesSummary(Request $request): JsonResponse
    {
        $dateRange = $request->get('days', 30);
        $endDate = Carbon::now();
        $startDate = $endDate->copy()->subDays($dateRange);
        $userId = Auth::guard('tenant')->id();

        try {
            // Get current period sales for the authenticated realtor
            $currentSales = Sale::join('properties', 'sales.property_id', '=', 'properties.id')
                ->where('sales.user_id', $userId)
                ->whereBetween('sales.created_at', [$startDate, $endDate])
                ->sum('properties.price');

            // Get previous period for comparison
            $previousStartDate = $startDate->copy()->subDays($dateRange);
            $previousSales = Sale::join('properties', 'sales.property_id', '=', 'properties.id')
                ->where('sales.user_id', $userId)
                ->whereBetween('sales.created_at', [$previousStartDate, $startDate])
                ->sum('properties.price');

            // Calculate growth percentage
            $growth = $previousSales > 0 ? (($currentSales - $previousSales) / $previousSales * 100) : 0;

            // Get total sales count
            $totalSalesCount = Sale::where('user_id', $userId)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count();

            return response()->json([
                'success' => true,
                'data' => [
                    'totalSales' => $currentSales,
                    'period' => "last {$dateRange} days",
                    'growth' => round($growth, 1),
                    'previousAmount' => $previousSales,
                    'salesCount' => $totalSalesCount,
                    'lastUpdated' => Carbon::now()->format('M j, Y')
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch sales summary: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get chart data for sales by month/period
     */
    public function getChartData(Request $request): JsonResponse
    {
        $period = $request->get('period', 'month');
        $date = $request->get('date', Carbon::now()->format('Y-m'));
        $userId = Auth::guard('tenant')->id();

        try {
            $chartData = [];

            if ($period === 'month') {
                // Get daily data for the month
                $startDate = Carbon::parse($date . '-01');
                $endDate = $startDate->copy()->endOfMonth();

                $salesData = Sale::join('properties', 'sales.property_id', '=', 'properties.id')
                    ->selectRaw('DATE(sales.created_at) as date, SUM(properties.price) as total, COUNT(sales.id) as count')
                    ->where('sales.user_id', $userId)
                    ->whereBetween('sales.created_at', [$startDate, $endDate])
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get()
                    ->pluck('total', 'date')
                    ->toArray();

                // Fill in missing dates with 0
                $currentDate = $startDate->copy();
                while ($currentDate->lte($endDate)) {
                    $dateKey = $currentDate->format('Y-m-d');
                    $chartData[] = [
                        'x' => $currentDate->format('M j'),
                        'y' => $salesData[$dateKey] ?? 0
                    ];
                    $currentDate->addDay();
                }
            }

            return response()->json([
                'success' => true,
                'data' => $chartData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch chart data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get revenue data from transactions
     */
    public function getRevenueData(Request $request): JsonResponse
    {
        $filter = $request->get('filter', 'monthly');
        $userId = Auth::guard('tenant')->id();

        try {
            $query = Transaction::where('user_id', $userId)
                ->where('status', 'completed')
                ->where('direction', 'credit');

            switch ($filter) {
                case 'weekly':
                    $query->where('created_at', '>=', Carbon::now()->subWeeks(4));
                    break;
                case 'quarterly':
                    $query->where('created_at', '>=', Carbon::now()->subMonths(3));
                    break;
                default: // monthly
                    $query->where('created_at', '>=', Carbon::now()->subMonths(6));
            }

            $revenueData = $query->selectRaw('
                SUM(CASE WHEN type = "commission" THEN amount ELSE 0 END) as commissions,
                SUM(CASE WHEN type = "bonus" THEN amount ELSE 0 END) as bonuses,
                SUM(amount) as total
            ')->first();

            // Get breakdown for chart
            $breakdown = [];
            for ($i = 5; $i >= 0; $i--) {
                $monthStart = Carbon::now()->subMonths($i)->startOfMonth();
                $monthEnd = $monthStart->copy()->endOfMonth();

                $monthRevenue = Transaction::where('user_id', $userId)
                    ->where('status', 'completed')
                    ->where('direction', 'credit')
                    ->whereBetween('created_at', [$monthStart, $monthEnd])
                    ->sum('amount');

                $breakdown[] = [
                    'period' => $monthStart->format('M Y'),
                    'revenue' => $monthRevenue
                ];
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'commissions' => $revenueData->commissions ?? 0,
                    'bonuses' => $revenueData->bonuses ?? 0,
                    'total' => $revenueData->total ?? 0,
                    'breakdown' => $breakdown
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch revenue data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get property sales data with filtering
     */
    public function getPropertySales(Request $request): JsonResponse
    {
        $page = $request->get('page', 1);
        $perPage = $request->get('per_page', 10);
        $status = $request->get('status');
        $type = $request->get('type');
        $search = $request->get('search');
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');
        $userId = Auth::guard('tenant')->id();

        try {
            $query = Sale::join('properties', 'sales.property_id', '=', 'properties.id')
                ->select(
                    'sales.id',
                    'properties.name as property',
                    'properties.city as location',
                    'properties.property_type as type',
                    'properties.price as amount',
                    'sales.created_at as date',
                    'sales.payment_mode as status',
                    'properties.image as image',
                    'sales.commercial_plots',
                    'sales.residential_plots'
                )
                ->where('sales.user_id', $userId);

            // Apply filters
            if ($status && $status !== 'all') {
                $query->where('sales.payment_mode', $status);
            }

            if ($type && $type !== 'all') {
                if ($type === 'sold') {
                    $query->whereIn('sales.payment_mode', ['full_payment', 'installment']);
                } else if ($type === 'pending') {
                    $query->where('sales.payment_mode', 'pending');
                }
            }

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('properties.name', 'like', "%{$search}%")
                        ->orWhere('properties.city', 'like', "%{$search}%");
                });
            }

            // Apply sorting
            $validSortColumns = [
                'property' => 'properties.name',
                'type' => 'properties.property_type',
                'date' => 'sales.created_at',
                'amount' => 'properties.price'
            ];

            if (isset($validSortColumns[$sortBy])) {
                $query->orderBy($validSortColumns[$sortBy], $sortDirection);
            }

            $total = $query->count();
            $sales = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get()
                ->map(function ($sale) {
                    return [
                        'id' => $sale->id,
                        'name' => $sale->property,
                        'location' => $sale->location,
                        'type' => ucfirst($sale->type),
                        'date' => Carbon::parse($sale->date)->format('j/n/y'),
                        'status' => $this->mapPaymentModeToStatus($sale->status),
                        'image' => $sale->image ? asset("storage/{$sale->image}") : asset('themes/classic/client/assets/images/property/default.jpg')
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $sales,
                'pagination' => [
                    'current_page' => $page,
                    'per_page' => $perPage,
                    'total' => $total,
                    'last_page' => ceil($total / $perPage)
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch property sales: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get income analysis data
     */
    public function getIncomeAnalysis(Request $request): JsonResponse
    {
        $userId = Auth::guard('tenant')->id();

        try {
            // Get current month income
            $currentMonth = Carbon::now()->startOfMonth();
            $currentCommissions = Transaction::where('user_id', $userId)
                ->where('type', Transaction::TYPE_COMMISSION)
                ->where('status', 'completed')
                ->where('direction', 'credit')
                ->where('created_at', '>=', $currentMonth)
                ->sum('amount');

            $currentBonuses = Transaction::where('user_id', $userId)
                ->where('type', Transaction::TYPE_BONUS)
                ->where('status', 'completed')
                ->where('direction', 'credit')
                ->where('created_at', '>=', $currentMonth)
                ->sum('amount');

            // Get previous month for comparison
            $previousMonth = Carbon::now()->subMonth()->startOfMonth();
            $previousMonthEnd = $previousMonth->copy()->endOfMonth();

            $previousCommissions = Transaction::where('user_id', $userId)
                ->where('type', Transaction::TYPE_COMMISSION)
                ->where('status', 'completed')
                ->where('direction', 'credit')
                ->whereBetween('created_at', [$previousMonth, $previousMonthEnd])
                ->sum('amount');

            $previousBonuses = Transaction::where('user_id', $userId)
                ->where('type', Transaction::TYPE_BONUS)
                ->where('status', 'completed')
                ->where('direction', 'credit')
                ->whereBetween('created_at', [$previousMonth, $previousMonthEnd])
                ->sum('amount');

            // Calculate growth
            $commissionGrowth = $previousCommissions > 0 ?
                (($currentCommissions - $previousCommissions) / $previousCommissions * 100) : 0;

            $bonusGrowth = $previousBonuses > 0 ?
                (($currentBonuses - $previousBonuses) / $previousBonuses * 100) : 0;

            // Get breakdown for last 6 months
            $breakdown = [];
            for ($i = 5; $i >= 0; $i--) {
                $monthStart = Carbon::now()->subMonths($i)->startOfMonth();
                $monthEnd = $monthStart->copy()->endOfMonth();

                $monthCommissions = Transaction::where('user_id', $userId)
                    ->where('type', Transaction::TYPE_COMMISSION)
                    ->where('status', 'completed')
                    ->where('direction', 'credit')
                    ->whereBetween('created_at', [$monthStart, $monthEnd])
                    ->sum('amount');

                $monthBonuses = Transaction::where('user_id', $userId)
                    ->where('type', Transaction::TYPE_BONUS)
                    ->where('status', 'completed')
                    ->where('direction', 'credit')
                    ->whereBetween('created_at', [$monthStart, $monthEnd])
                    ->sum('amount');

                $breakdown[] = [
                    'period' => $monthStart->format('M Y'),
                    'commissions' => $monthCommissions,
                    'bonuses' => $monthBonuses,
                    'total' => $monthCommissions + $monthBonuses
                ];
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'rentIncome' => $currentCommissions, // Using commission as rent income
                    'rentGrowth' => round($commissionGrowth, 1),
                    'saleIncome' => $currentBonuses, // Using bonus as sale income
                    'saleGrowth' => round($bonusGrowth, 1),
                    'breakdown' => $breakdown
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch income analysis: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get recent transactions
     */
    public function getRecentTransactions(Request $request): JsonResponse
    {
        $limit = $request->get('limit', 10);
        $filter = $request->get('filter', 'all');
        $userId = Auth::guard('tenant')->id();

        try {
            $query = Transaction::with(['transactionable'])
                ->where('user_id', $userId)
                ->where('status', 'completed');

            // Apply filters
            if ($filter !== 'all') {
                switch ($filter) {
                    case 'sell':
                        $query->where('type', Transaction::TYPE_COMMISSION);
                        break;
                    case 'rent':
                        $query->where('type', Transaction::TYPE_BONUS);
                        break;
                    case 'paid':
                        $query->where('direction', 'credit');
                        break;
                    case 'pending':
                        $query->where('status', 'pending');
                        break;
                }
            }

            $transactions = $query->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get()
                ->map(function ($transaction) {
                    // Try to get property details if transaction is related to a sale
                    $property = null;
                    $location = 'N/A';
                    $image = asset('themes/classic/client/assets/images/property/default.jpg');

                    if ($transaction->transactionable_type === 'App\\Models\\Tenant\\Sale' && $transaction->transactionable) {
                        $sale = $transaction->transactionable;
                        if (isset($sale->property) && $sale->property) {
                            $property = $sale->property->name ?? $sale->property->title ?? 'Unknown Property';
                            $location = $sale->property->city ?? $sale->property->address ?? 'Unknown Location';
                            $image = $sale->property->image ?
                                asset("storage/{$sale->property->image}") :
                                asset('themes/classic/client/assets/images/property/default.jpg');
                        }
                    }

                    return [
                        'id' => $transaction->id,
                        'property' => $property ?? 'Commission Payment',
                        'location' => $location,
                        'type' => ucfirst($transaction->type),
                        'amount' => number_format($transaction->amount, 0),
                        'price' => $transaction->amount,
                        'date' => Carbon::parse($transaction->created_at)->format('M j, Y'),
                        'status' => $transaction->status === 'completed' ? 'Paid' : 'Pending',
                        'image' => $image
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $transactions
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch recent transactions: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate management report
     */
    public function generateReport(Request $request): JsonResponse
    {
        $request->validate([
            'type' => 'sometimes|in:daily,weekly,monthly,custom',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date'
        ]);

        $userId = Auth::guard('tenant')->id();
        $type = $request->get('type', 'weekly');

        try {
            // Calculate date range based on type
            $dateRange = $this->getDateRangeForType($type);

            if ($request->has('start_date') && $request->has('end_date')) {
                $dateRange = [
                    'start' => Carbon::parse($request->start_date),
                    'end' => Carbon::parse($request->end_date)
                ];
                $type = 'custom';
            }

            // Create report record
            $report = GeneratedReport::create([
                'user_id' => $userId,
                'title' => "Report {$dateRange['start']->format('j-n-y')} - {$dateRange['end']->format('j-n-y')}",
                'type' => $type,
                'start_date' => $dateRange['start'],
                'end_date' => $dateRange['end'],
                'status' => 'generating'
            ]);

            // Generate report data
            $reportData = $this->generateReportData($userId, $dateRange['start'], $dateRange['end']);

            // Generate PDF
            $fileName = "report_{$report->id}_{$userId}_" . time() . ".pdf";
            $filePath = "reports/{$fileName}";

            $pdf = Pdf::loadView('tenant.reports.pdf-template', [
                'report' => [
                    'id' => $report->id,
                    'title' => $report->title,
                    'agent_name' => $reportData['realtor']->name ?? 'Unknown Agent',
                    'period' => $reportData['period'],
                    'generated_at' => now()->format('M j, Y \a\t g:i A'),
                    'summary' => [
                        'total_sales' => $reportData['salesSummary']['totalSales'],
                        'sales_count' => $reportData['salesSummary']['salesCount'],
                        'total_commission' => $reportData['incomeAnalysis']['commissionIncome'],
                        'growth' => $reportData['salesSummary']['growth']
                    ],
                    'property_sales' => $reportData['propertySales'],
                    'transactions' => $reportData['transactions']
                ],
                'salesSummary' => $reportData['salesSummary'],
                'incomeAnalysis' => $reportData['incomeAnalysis'],
                'propertySales' => $reportData['propertySales'],
                'transactions' => $reportData['transactions']
            ]);
            Storage::put($filePath, $pdf->output());

            // Update report with file path and completion
            $report->update([
                'file_path' => $filePath,
                'status' => 'completed',
                'generated_at' => now(),
                'metadata' => [
                    'total_sales' => $reportData['salesSummary']['totalSales'],
                    'sales_count' => $reportData['salesSummary']['salesCount'],
                    'total_commission' => $reportData['incomeAnalysis']['commissionIncome'],
                    'file_size' => Storage::size($filePath)
                ]
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Report generated successfully',
                'data' => [
                    'id' => $report->id,
                    'title' => $report->title,
                    'created' => $report->created_at->format('j/n/y'),
                    'downloadUrl' => $report->downloadUrl
                ]
            ]);
        } catch (\Exception $e) {
            // Update report status to failed if it exists
            if (isset($report)) {
                $report->update(['status' => 'failed']);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to generate report: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Download generated report
     */
    public function downloadReport($reportId)
    {
        $userId = Auth::guard('tenant')->id();

        $report = GeneratedReport::where('id', $reportId)
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->first();

        if (!$report) {
            abort(404, 'Report not found or not ready for download');
        }

        $filePath = storage_path('app/' . $report->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'Report file not found');
        }

        // Generate a clean filename from the report title, removing invalid characters
        $fileName = preg_replace('/[\/\\\\:*?"<>|]/', '_', $report->title);
        $fileName = str_replace(' ', '_', $fileName) . '.pdf';

        return response()->download($filePath, $fileName, [
            'Content-Type' => 'application/pdf'
        ]);
    }

    /**
     * Get management reports list
     */
    public function getManagementReports(Request $request): JsonResponse
    {
        $userId = Auth::guard('tenant')->id();

        try {
            $reports = GeneratedReport::where('user_id', $userId)
                ->where('status', 'completed')
                ->orderBy('created_at', 'desc')
                ->limit(20)
                ->get()
                ->map(function ($report) {
                    return [
                        'id' => $report->id,
                        'title' => $report->title,
                        'created' => $report->created_at->format('j/n/y'),
                        'downloadUrl' => $report->downloadUrl
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $reports
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch management reports: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate report data for PDF
     */
    private function generateReportData($userId, $startDate, $endDate): array
    {
        // Get user info
        $realtor = TenantUser::findOrFail($userId);

        // Get sales summary
        $salesSummary = $this->getSalesSummaryData($userId, $startDate, $endDate);

        // Get income analysis
        $incomeAnalysis = $this->getIncomeAnalysisData($userId, $startDate, $endDate);

        // Get property sales
        $propertySales = $this->getPropertySalesData($userId, $startDate, $endDate);

        // Get transactions
        $transactions = $this->getTransactionsData($userId, $startDate, $endDate);

        return [
            'realtor' => $realtor,
            'period' => $startDate->format('F j, Y') . ' - ' . $endDate->format('F j, Y'),
            'salesSummary' => $salesSummary,
            'incomeAnalysis' => $incomeAnalysis,
            'propertySales' => $propertySales,
            'transactions' => $transactions
        ];
    }

    /**
     * Get sales summary for report
     */
    private function getSalesSummaryData($userId, $startDate, $endDate): array
    {
        $currentSales = Sale::join('properties', 'sales.property_id', '=', 'properties.id')
            ->where('sales.user_id', $userId)
            ->whereBetween('sales.created_at', [$startDate, $endDate])
            ->sum('properties.price');

        $salesCount = Sale::where('user_id', $userId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        // Calculate previous period for growth
        $periodDays = $startDate->diffInDays($endDate);
        $previousStartDate = $startDate->copy()->subDays($periodDays);
        $previousSales = Sale::join('properties', 'sales.property_id', '=', 'properties.id')
            ->where('sales.user_id', $userId)
            ->whereBetween('sales.created_at', [$previousStartDate, $startDate])
            ->sum('properties.price');

        $growth = $previousSales > 0 ? (($currentSales - $previousSales) / $previousSales * 100) : 0;

        return [
            'totalSales' => $currentSales,
            'salesCount' => $salesCount,
            'growth' => round($growth, 1)
        ];
    }

    /**
     * Get income analysis for report
     */
    private function getIncomeAnalysisData($userId, $startDate, $endDate): array
    {
        $commissions = Transaction::where('user_id', $userId)
            ->where('type', Transaction::TYPE_COMMISSION)
            ->where('status', 'completed')
            ->where('direction', 'credit')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');

        $bonuses = Transaction::where('user_id', $userId)
            ->where('type', Transaction::TYPE_BONUS)
            ->where('status', 'completed')
            ->where('direction', 'credit')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');

        // Calculate growth
        $periodDays = $startDate->diffInDays($endDate);
        $previousStartDate = $startDate->copy()->subDays($periodDays);

        $previousCommissions = Transaction::where('user_id', $userId)
            ->where('type', Transaction::TYPE_COMMISSION)
            ->where('status', 'completed')
            ->where('direction', 'credit')
            ->whereBetween('created_at', [$previousStartDate, $startDate])
            ->sum('amount');

        $previousBonuses = Transaction::where('user_id', $userId)
            ->where('type', Transaction::TYPE_BONUS)
            ->where('status', 'completed')
            ->where('direction', 'credit')
            ->whereBetween('created_at', [$previousStartDate, $startDate])
            ->sum('amount');

        $currentTotal = $commissions + $bonuses;
        $previousTotal = $previousCommissions + $previousBonuses;

        $growth = $previousTotal > 0 ? (($currentTotal - $previousTotal) / $previousTotal * 100) : 0;

        return [
            'commissionIncome' => $commissions,
            'totalIncome' => $currentTotal,
            'growth' => round($growth, 1),
            'breakdown' => [
                [
                    'period' => 'Week 1',
                    'commissions' => $commissions * 0.3,
                    'bonuses' => $bonuses * 0.2
                ],
                [
                    'period' => 'Week 2',
                    'commissions' => $commissions * 0.4,
                    'bonuses' => $bonuses * 0.3
                ],
                [
                    'period' => 'Week 3',
                    'commissions' => $commissions * 0.2,
                    'bonuses' => $bonuses * 0.3
                ],
                [
                    'period' => 'Week 4',
                    'commissions' => $commissions * 0.1,
                    'bonuses' => $bonuses * 0.2
                ]
            ]
        ];
    }

    /**
     * Get property sales for report
     */
    private function getPropertySalesData($userId, $startDate, $endDate): array
    {
        return Sale::join('properties', 'sales.property_id', '=', 'properties.id')
            ->select(
                'properties.name',
                'properties.city as location',
                'properties.property_type as type',
                'properties.price',
                'sales.created_at as date',
                'sales.payment_mode as status'
            )
            ->where('sales.user_id', $userId)
            ->whereBetween('sales.created_at', [$startDate, $endDate])
            ->orderBy('sales.created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($sale) {
                return [
                    'property_name' => $sale->name,
                    'name' => $sale->name, // Keep both for compatibility
                    'location' => $sale->location,
                    'type' => ucfirst($sale->type),
                    'price' => $sale->price ?? 0,
                    'date' => Carbon::parse($sale->date)->format('M j, Y'),
                    'status' => $this->mapPaymentModeToStatus($sale->status)
                ];
            })
            ->toArray();
    }

    /**
     * Get transactions for report
     */
    private function getTransactionsData($userId, $startDate, $endDate): array
    {
        return Transaction::where('user_id', $userId)
            ->where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($transaction) {
                return [
                    'property' => $transaction->description ?? 'Commission Payment',
                    'type' => ucfirst($transaction->type),
                    'amount' => $transaction->amount,
                    'commission' => $transaction->type === 'commission' ? $transaction->amount : 0,
                    'date' => Carbon::parse($transaction->created_at)->format('M j, Y'),
                    'status' => 'Paid'
                ];
            })
            ->toArray();
    }

    /**
     * Map payment mode to status
     */
    private function mapPaymentModeToStatus($paymentMode): string
    {
        $statusMap = [
            'cash' => 'Paid',
            'bank_transfer' => 'Paid',
            'cheque' => 'Pending',
            'installment' => 'Partial',
            'pending' => 'Pending'
        ];

        return $statusMap[$paymentMode] ?? 'Unknown';
    }

    /**
     * Get date range for report type
     */
    private function getDateRangeForType($type): array
    {
        $now = Carbon::now();

        switch ($type) {
            case 'daily':
                return [
                    'start' => $now->copy()->startOfDay(),
                    'end' => $now->copy()->endOfDay()
                ];
            case 'weekly':
                return [
                    'start' => $now->copy()->startOfWeek(),
                    'end' => $now->copy()->endOfWeek()
                ];
            case 'monthly':
                return [
                    'start' => $now->copy()->startOfMonth(),
                    'end' => $now->copy()->endOfMonth()
                ];
            default:
                return [
                    'start' => $now->copy()->startOfWeek(),
                    'end' => $now->copy()->endOfWeek()
                ];
        }
    }
}
