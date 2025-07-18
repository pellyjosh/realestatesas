<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtor Report - {{ $period }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
        }

        .company-logo {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }

        .report-title {
            font-size: 20px;
            margin: 10px 0;
        }

        .report-period {
            color: #666;
            font-size: 14px;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
        }

        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }

        .stat-label {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        .growth-positive {
            color: #28a745;
        }

        .growth-negative {
            color: #dc3545;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        .currency {
            font-weight: bold;
            color: #007bff;
        }

        .status-paid {
            color: #28a745;
            font-weight: bold;
        }

        .status-pending {
            color: #ffc107;
            font-weight: bold;
        }

        .status-cancelled {
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="company-logo">Premium Refined Luxury Homes</div>
        <div class="report-title">Realtor Performance Report</div>
        <div class="report-period">{{ $period }}</div>
        <div class="report-period">Generated for: {{ $realtor->name }}</div>
        <div class="report-period">Generated on: {{ now()->format('F d, Y \a\t H:i') }}</div>
    </div>

    <!-- Sales Summary -->
    <div class="section">
        <div class="section-title">Sales Summary</div>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value currency">₦{{ number_format($salesSummary['totalSales'], 0) }}</div>
                <div class="stat-label">Total Sales</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $salesSummary['salesCount'] }}</div>
                <div class="stat-label">Properties Sold</div>
            </div>
            <div class="stat-card">
                <div class="stat-value {{ $salesSummary['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                    {{ $salesSummary['growth'] >= 0 ? '+' : '' }}{{ $salesSummary['growth'] }}%
                </div>
                <div class="stat-label">Growth</div>
            </div>
        </div>
    </div>

    <!-- Income Analysis -->
    <div class="section">
        <div class="section-title">Income Analysis</div>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value currency">₦{{ number_format($incomeAnalysis['rentIncome'], 0) }}</div>
                <div class="stat-label">Commission Income</div>
                <div
                    class="stat-label {{ $incomeAnalysis['rentGrowth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                    {{ $incomeAnalysis['rentGrowth'] >= 0 ? '+' : '' }}{{ $incomeAnalysis['rentGrowth'] }}%
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-value currency">₦{{ number_format($incomeAnalysis['saleIncome'], 0) }}</div>
                <div class="stat-label">Bonus Income</div>
                <div
                    class="stat-label {{ $incomeAnalysis['saleGrowth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                    {{ $incomeAnalysis['saleGrowth'] >= 0 ? '+' : '' }}{{ $incomeAnalysis['saleGrowth'] }}%
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-value currency">
                    ₦{{ number_format($incomeAnalysis['rentIncome'] + $incomeAnalysis['saleIncome'], 0) }}</div>
                <div class="stat-label">Total Income</div>
            </div>
        </div>
    </div>

    <!-- Recent Sales -->
    @if (count($propertySales) > 0)
        <div class="section">
            <div class="section-title">Recent Property Sales</div>
            <table>
                <thead>
                    <tr>
                        <th>Property</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($propertySales as $sale)
                        <tr>
                            <td>{{ $sale['name'] }}</td>
                            <td>{{ $sale['location'] }}</td>
                            <td>{{ $sale['type'] }}</td>
                            <td>{{ $sale['date'] }}</td>
                            <td class="status-{{ strtolower($sale['status']) }}">{{ $sale['status'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Recent Transactions -->
    @if (count($transactions) > 0)
        <div class="section">
            <div class="section-title">Recent Transactions</div>
            <table>
                <thead>
                    <tr>
                        <th>Property</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction['property'] }}</td>
                            <td>{{ $transaction['type'] }}</td>
                            <td class="currency">₦{{ $transaction['amount'] }}</td>
                            <td>{{ $transaction['date'] }}</td>
                            <td class="status-{{ strtolower($transaction['status']) }}">{{ $transaction['status'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Performance Insights -->
    <div class="section">
        <div class="section-title">Performance Insights</div>
        <ul>
            @if ($salesSummary['growth'] > 0)
                <li>Your sales have grown by {{ $salesSummary['growth'] }}% compared to the previous period. Keep up
                    the excellent work!</li>
            @elseif($salesSummary['growth'] < 0)
                <li>Sales have decreased by {{ abs($salesSummary['growth']) }}% compared to the previous period.
                    Consider reviewing your sales strategy.</li>
            @else
                <li>Sales performance remained stable compared to the previous period.</li>
            @endif

            @if ($incomeAnalysis['rentIncome'] > $incomeAnalysis['saleIncome'])
                <li>Commission income (₦{{ number_format($incomeAnalysis['rentIncome'], 0) }}) is your primary income
                    source.</li>
            @else
                <li>Bonus income (₦{{ number_format($incomeAnalysis['saleIncome'], 0) }}) is your primary income
                    source.</li>
            @endif

            <li>Total properties handled: {{ $salesSummary['salesCount'] }}</li>
            <li>Average transaction value:
                ₦{{ $salesSummary['salesCount'] > 0 ? number_format($salesSummary['totalSales'] / $salesSummary['salesCount'], 0) : '0' }}
            </li>
        </ul>
    </div>

    <div class="footer">
        <p>This report was automatically generated by the Premium Refined Luxury Homes system.</p>
        <p>For questions or concerns, please contact your administrator.</p>
        <p>&copy; {{ date('Y') }} Premium Refined Luxury Homes. All rights reserved.</p>
    </div>
</body>

</html>
