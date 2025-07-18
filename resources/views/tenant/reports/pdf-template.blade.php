<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $report['title'] }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 5px;
        }

        .report-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .report-info {
            font-size: 11px;
            color: #666;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            background-color: #f8f9fa;
            padding: 8px 12px;
            border-left: 4px solid #007bff;
            margin-bottom: 15px;
        }

        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .stats-row {
            display: table-row;
        }

        .stats-cell {
            display: table-cell;
            width: 25%;
            padding: 10px;
            border: 1px solid #dee2e6;
            text-align: center;
            vertical-align: middle;
        }

        .stats-value {
            font-size: 16px;
            font-weight: bold;
            color: #007bff;
        }

        .stats-label {
            font-size: 10px;
            color: #666;
            margin-top: 3px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
            font-size: 11px;
        }

        td {
            font-size: 10px;
        }

        .text-success {
            color: #28a745;
        }

        .text-danger {
            color: #dc3545;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            text-align: center;
            font-size: 10px;
            color: #666;
        }

        .currency {
            font-family: 'DejaVu Sans Mono', monospace;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="company-name">Premium Refined Luxury Homes</div>
        <div class="report-title">{{ $report['title'] }}</div>
        <div class="report-info">
            Generated on {{ $report['generated_at'] }} |
            Period: {{ $report['period'] }} |
            Agent: {{ $report['agent_name'] }}
        </div>
    </div>

    <!-- Summary Section -->
    <div class="section">
        <div class="section-title">Sales Summary</div>
        <div class="stats-grid">
            <div class="stats-row">
                <div class="stats-cell">
                    <div class="stats-value currency">₦{{ number_format($report['summary']['total_sales'], 0) }}</div>
                    <div class="stats-label">Total Sales</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-value">{{ $report['summary']['sales_count'] }}</div>
                    <div class="stats-label">Properties Sold</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-value currency">₦{{ number_format($report['summary']['total_commission'], 0) }}
                    </div>
                    <div class="stats-label">Total Commission</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-value {{ $report['summary']['growth'] >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ $report['summary']['growth'] }}%
                    </div>
                    <div class="stats-label">Growth</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Property Sales Section -->
    @if (count($report['property_sales']) > 0)
        <div class="section">
            <div class="section-title">Property Sales Details</div>
            <table>
                <thead>
                    <tr>
                        <th>Property</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Sale Price</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($report['property_sales'] as $sale)
                        <tr>
                            <td>{{ $sale['property_name'] }}</td>
                            <td>{{ $sale['location'] }}</td>
                            <td>{{ $sale['type'] }}</td>
                            <td class="currency">₦{{ number_format($sale['price'], 0) }}</td>
                            <td>{{ $sale['date'] }}</td>
                            <td>{{ $sale['status'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Transactions Section -->
    @if (count($report['transactions']) > 0)
        <div class="section">
            <div class="section-title">Recent Transactions</div>
            <table>
                <thead>
                    <tr>
                        <th>Property</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Commission</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($report['transactions'] as $transaction)
                        <tr>
                            <td>{{ $transaction['property'] }}</td>
                            <td>{{ $transaction['type'] }}</td>
                            <td class="currency">₦{{ number_format($transaction['amount'], 0) }}</td>
                            <td class="currency">₦{{ number_format($transaction['commission'], 0) }}</td>
                            <td>{{ $transaction['date'] }}</td>
                            <td>{{ $transaction['status'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Income Analysis Section -->
    <div class="section">
        <div class="section-title">Income Analysis</div>
        <div class="stats-grid">
            <div class="stats-row">
                <div class="stats-cell">
                    <div class="stats-value currency">₦{{ number_format($incomeAnalysis['commissionIncome'] ?? 0, 0) }}
                    </div>
                    <div class="stats-label">Commission Income</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-value currency">₦{{ number_format($incomeAnalysis['totalIncome'] ?? 0, 0) }}
                    </div>
                    <div class="stats-label">Total Income</div>
                </div>
                <div class="stats-cell">
                    <div
                        class="stats-value {{ ($incomeAnalysis['growth'] ?? 0) >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ $incomeAnalysis['growth'] ?? 0 }}%
                    </div>
                    <div class="stats-label">Income Growth</div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>This report was automatically generated by the Premium Refined Luxury Homes management system.</p>
        <p>Report ID: {{ $report['id'] }} | Generated at {{ $report['generated_at'] }}</p>
    </div>
</body>

</html>
