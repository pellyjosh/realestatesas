@extends('realtor.realtor_master')
@section('title', 'Earnings | Premium Refined Luxury Homes')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-header-left">
                    <h3>Earnings
                        <small>Welcome to realtor panel</small>
                    </h3>
                </div>
            </div>
            <div class="col-sm-6">

                <!-- Breadcrumb start -->
             
                <!-- Breadcrumb end -->

            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Summary Statistics Cards -->
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        <h6>Total Earnings</h6>
                        <h4 class="mb-0">#125,350.00</h4>
                    </div>
                    <div class="icon-box bg-primary-light">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        <h6>This Month</h6>
                        <h4 class="mb-0">#18,400.00</h4>
                    </div>
                    <div class="icon-box bg-success-light">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        <h6>Pending Payments</h6>
                        <h4 class="mb-0">#5,200.00</h4>
                    </div>
                    <div class="icon-box bg-warning-light">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        <h6>Average Commission</h6>
                        <h4 class="mb-0">3.5%</h4>
                    </div>
                    <div class="icon-box bg-danger-light">
                        <i class="fas fa-percentage"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Commission Breakdown Table -->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Commission Breakdown</h5>
            </div>
            <div class="card-body">
                <style>
                    /* Table background and responsive font */
                    .custom-table-container {
                        border-radius: 10px;
                        padding: 0.5rem;
                        width: 100%;
                        overflow-x: auto;
                    }
                    .card-body {
                        padding: 10px;
                    }
                    .card .card-header{
                        padding: 10px;
                    }
                    .filter-panel{
                        padding: 0px;
                    }
                    .table thead th {
                        background: #e5f5c7;
                        color: #333;
                        font-weight: 600;
                        padding: 0.5rem;
                    }
                    .table td {
                        padding: 0.5rem 0.75rem;
                        vertical-align: middle;
                    }
                    .table th {
                        padding: 0.5rem 0.75rem;
                        vertical-align: middle;
                    }
                    .action-btns {
                        display: flex;
                        gap: 0.25rem;
                        flex-wrap: wrap;
                    }
                    @media (max-width: 576px) {
                        .table {
                            font-size: 0.85rem;
                        }
                        .action-btns {
                            flex-wrap: nowrap;
                            gap: 0.15rem;
                        }
                    }
                    .dataTables_paginate .paginate_button.current {
                        background-color: #91d20a !important;
                        color: #fff !important;
                        border: 1px solid #91d20a !important;
                    }
                    .dataTables_paginate .paginate_button {
                        background-color: #f6faeb !important;
                        color: #333 !important;
                        border-color: #f6faeb !important;
                        border-radius: 20px !important;
                        margin: 0 2px;
                    }
                    .dataTables_paginate .paginate_button:hover:not(.current) {
                        background-color: #e5f5c7 !important;
                        color: #333 !important;
                    }
                    .filter-panel {
                        margin-bottom: 0.5rem;
                        display: flex;
                        gap: 0.75rem;
                        flex-wrap: wrap;
                    }
                    .filter-panel .form-select {
                        background-color: #f6faeb;
                        border-color: #91d20a;
                        color: #333;
                    }
                    .filter-panel .form-select:focus {
                        border-color: #91d20a;
                        box-shadow: 0 0 0 0.2rem rgba(145, 210, 10, 0.25);
                    }
                </style>
                <div class="custom-table-container">
                    <div class="filter-panel">
                        <div class="form-group">
                            <label for="fromDate" class="small text-secondary fw-bold">From Date</label>
                            <input type="date" id="fromDate" class="form-control form-control-sm" style="background-color: #f6faeb; border-color: #91d20a; color: #333;">
                        </div>
                        <div class="form-group">
                            <label for="toDate" class="small text-secondary fw-bold">To Date</label>
                            <input type="date" id="toDate" class="form-control form-control-sm" style="background-color: #f6faeb; border-color: #91d20a; color: #333;">
                        </div>
                        <div class="form-group">
                            <label for="earningsType" class="small text-secondary fw-bold">Earnings Type</label>
                            <select id="earningsType" class="form-select form-select-sm">
                                <option selected>All</option>
                                <option>Commission</option>
                                <option>Sales</option>
                            </select>
                        </div>
                        <div class="form-group ms-auto">
                            <button class="btn btn-sm" type="button" style="background-color: #91d20a; color: #fff; border-color: #91d20a; margin-top: 1.5rem;">Export Data</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped table-bordered text-sm align-middle display" style="border-color: #91d20a;">
                            <thead>
                                <tr>
                                    <th class="text-uppercase small text-secondary fw-bold">Date</th>
                                    <th class="text-uppercase small text-secondary fw-bold">Property</th>
                                    <th class="text-uppercase small text-secondary fw-bold">Client</th>
                                    <th class="text-uppercase small text-secondary fw-bold">Sale Price</th>
                                    <th class="text-uppercase small text-secondary fw-bold">Commission Rate</th>
                                    <th class="text-uppercase small text-secondary fw-bold">Earnings Type</th>
                                    <th class="text-uppercase small text-secondary fw-bold">Earnings</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom">
                                    <td class="text-muted">2025-06-15</td>
                                    <td class="text-muted">Luxury Villa #123</td>
                                    <td class="text-muted">John Doe</td>
                                    <td class="text-muted">#1,250,000</td>
                                    <td class="text-muted">3%</td>
                                    <td class="text-muted">Commission</td>
                                    <td class="fw-semibold text-success">#37,500.00</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">2025-05-20</td>
                                    <td class="text-muted">Beachfront Condo #456</td>
                                    <td class="text-muted">Jane Smith</td>
                                    <td class="text-muted">#850,000</td>
                                    <td class="text-muted">3.5%</td>
                                    <td class="text-muted">Commission</td>
                                    <td class="fw-semibold text-success">#29,750.00</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">2025-04-10</td>
                                    <td class="text-muted">Suburban House #789</td>
                                    <td class="text-muted">Mike Johnson</td>
                                    <td class="text-muted">#650,000</td>
                                    <td class="text-muted">4%</td>
                                    <td class="text-muted">Sales</td>
                                    <td class="fw-semibold text-success">#26,000.00</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">2025-03-05</td>
                                    <td class="text-muted">City Apartment #101</td>
                                    <td class="text-muted">Sarah Williams</td>
                                    <td class="text-muted">#450,000</td>
                                    <td class="text-muted">3%</td>
                                    <td class="text-muted">Commission</td>
                                    <td class="fw-semibold text-success">#13,500.00</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">2025-02-18</td>
                                    <td class="text-muted">Penthouse Suite #202</td>
                                    <td class="text-muted">Robert Brown</td>
                                    <td class="text-muted">#2,000,000</td>
                                    <td class="text-muted">2.5%</td>
                                    <td class="text-muted">Sales</td>
                                    <td class="fw-semibold text-success">#50,000.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Transactions -->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5>Recent Transactions</h5>
            </div>
            <div class="card-body">
                <style>
                    .transaction-item {
                        background-color: #f9f9f9;
                        border-left: 4px solid #91d20a;
                        border-radius: 8px;
                        margin-bottom: 15px;
                        padding: 10px 15px;
                        transition: box-shadow 0.3s ease, transform 0.3s ease;
                    }
                    .transaction-item:hover {
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                        transform: translateY(-2px);
                    }
                    .transaction-icon {
                        background-color: #e5f5c7;
                        color: #91d20a;
                        width: 40px;
                        height: 40px;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin-right: 15px;
                    }
                    .transaction-details h6 {
                        margin-bottom: 5px;
                        color: #333;
                        font-weight: 600;
                        padding: 0 5px;
                    }
                    .transaction-details p {
                        margin: 0;
                        color: #666;
                        font-size: 0.9rem;
                        padding: 0 5px;
                    }
                    .transaction-amount {
                        text-align: right;
                    }
                    .transaction-amount h6 {
                        color: #91d20a;
                        font-weight: 600;
                        margin-bottom: 5px;
                        padding: 0 5px;
                    }
                    .transaction-amount p {
                        color: #999;
                        font-size: 0.85rem;
                        margin: 0;
                        padding: 0 5px;
                    }
                    .pending .transaction-icon {
                        background-color: #fff3cd;
                        color: #f0ad4e;
                    }
                    .pending .transaction-amount h6 {
                        color: #f0ad4e;
                    }
                </style>
                <div class="transaction-list">
                    <div class="transaction-item">
                        <div class="media">
                            <div class="transaction-icon">
                                <i class="fas fa-arrow-down"></i>
                            </div>
                            <div class="media-body transaction-details">
                                <h6>Payment Received</h6>
                                <p>Luxury Villa #123 - John Doe</p>
                            </div>
                            <div class="transaction-amount">
                                <h6>#37,500.00</h6>
                                <p>2025-06-15</p>
                            </div>
                        </div>
                    </div>
                    <div class="transaction-item">
                        <div class="media">
                            <div class="transaction-icon">
                                <i class="fas fa-arrow-down"></i>
                            </div>
                            <div class="media-body transaction-details">
                                <h6>Payment Received</h6>
                                <p>Beachfront Condo #456 - Jane Smith</p>
                            </div>
                            <div class="transaction-amount">
                                <h6>#29,750.00</h6>
                                <p>2025-05-20</p>
                            </div>
                        </div>
                    </div>
                    <div class="transaction-item pending">
                        <div class="media">
                            <div class="transaction-icon">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                            <div class="media-body transaction-details">
                                <h6>Pending Payment</h6>
                                <p>Suburban House #789 - Mike Johnson</p>
                            </div>
                            <div class="transaction-amount">
                                <h6>#26,000.00</h6>
                                <p>2025-04-10</p>
                            </div>
                        </div>
                    </div>
                    <div class="transaction-item">
                        <div class="media">
                            <div class="transaction-icon">
                                <i class="fas fa-arrow-down"></i>
                            </div>
                            <div class="media-body transaction-details">
                                <h6>Payment Received</h6>
                                <p>City Apartment #101 - Sarah Williams</p>
                            </div>
                            <div class="transaction-amount">
                                <h6>#13,500.00</h6>
                                <p>2025-03-05</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Earnings Line Chart
    var options = {
        series: [{
            name: 'Earnings',
            data: [5000, 7500, 3200, 8600, 4100, 9700, 6200, 3800, 7500, 2500, 8800, 18400]
        }],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        title: {
            text: 'Earnings Over the Past 12 Months',
            align: 'left'
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'],
                opacity: 0.5
            },
        },
        xaxis: {
            categories: ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        }
    };

    var chart = new ApexCharts(document.querySelector("#earnings-line-chart"), options);
    chart.render();

    // Earnings Pie Chart
    var pieOptions = {
        series: [44500, 53750, 26000, 13500],
        chart: {
            width: 380,
            type: 'pie',
        },
        labels: ['Residential Sales', 'Commercial Sales', 'Referrals', 'Other'],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var pieChart = new ApexCharts(document.querySelector("#earnings-pie-chart"), pieOptions);
    pieChart.render();
</script>
@endsection
