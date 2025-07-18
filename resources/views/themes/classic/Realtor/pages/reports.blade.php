@extends('themes.classic.realtor.realtor_master')
@section('title', 'Reports | Premium Refined Luxury Homes')
@section('content')
    <!-- Alpine.js Data Store -->
    <div x-data="reportsData()" x-init="initReports()">
        <!-- Error Message -->
        <div x-show="error" class="alert alert-danger m-3" x-text="error"></div>

        <!-- Container-fluid start -->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="page-header-left">
                            <h3>Reports
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
        <!-- Container-fluid end -->

        <!-- Container-fluid start -->
        <div class="container-fluid">
            <div class="row report-summary">
                <div class="col-xl-8 xl-12">
                    <div class="card sales-details">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="sales-status">
                                        <h5>Sales summary</h5>
                                        <div class="status-price">
                                            <h3 x-text="formatCurrency(salesSummary.totalSales)">
                                                $16,230/-
                                            </h3>
                                            <span>
                                                <span x-text="salesSummary.period">last week</span>
                                                <span class="font-success" x-show="salesSummary.growth >= 0">
                                                    + <span x-text="salesSummary.growth">10</span>%
                                                    <i data-feather="trending-up"></i>
                                                </span>
                                                <span class="font-danger" x-show="salesSummary.growth < 0">
                                                    <span x-text="salesSummary.growth">-5</span>%
                                                    <i data-feather="trending-down"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="chart-legends">
                                        <ul>
                                            <li>
                                                <div class="bg-primary circle-label"></div>
                                                <span>Last week</span>
                                            </li>
                                            <li class="mt-1">
                                                <div class="bg-secondary circle-label"></div>
                                                <span>Running week</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="last-updated light-box">
                                        <span>Last updated</span>
                                        <h5 x-text="salesSummary.lastUpdated">Dec 26, 2022</h5>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="monthly-sales">
                                        <div class="icon-box" @click="previousMonth()">
                                            <i class="fas fa-chevron-left light-font"></i>
                                        </div>
                                        <h6 x-text="currentMonthYear">October, 2022</h6>
                                        <div class="icon-box" @click="nextMonth()">
                                            <i class="fas fa-chevron-right light-font"></i>
                                        </div>
                                    </div>
                                    <div class="bar-sales">
                                        <div id="sale-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 xl-6">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Management Reports</h5>
                                <button class="btn btn-sm btn-primary" @click="generateReport()"
                                    :disabled="isGeneratingReport">
                                    <span x-show="!isGeneratingReport">Generate Report</span>
                                    <span x-show="isGeneratingReport">Generating...</span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body management-table">
                            <div class="table-responsive">
                                <table class="table table-bordernone">
                                    <tbody>
                                        <template x-for="report in managementReports" :key="report.id">
                                            <tr>
                                                <td>
                                                    <div class="media">
                                                        <img src="{{ asset('themes/classic/admin/assets/images/svg/icon/pdf.png') }}"
                                                            class="img-fluid" alt="">
                                                        <div class="media-body">
                                                            <h6 x-text="report.title"></h6>
                                                            <span x-text="'Created ' + report.created"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a :href="report.downloadUrl" download title="Download Report"
                                                        class="btn btn-link p-0">
                                                        <i class="fas fa-download text-primary"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </template>
                                        <!-- No data state -->
                                        <tr x-show="managementReports.length === 0">
                                            <td colspan="2" class="text-center py-4 light-font">
                                                No reports generated yet
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Revenue</h5>
                        </div>
                        <div class="card-body pt-0">
                            <div class="revenue-container">
                                <div id="revenuechart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Property sales</h5>
                                <div class="d-flex gap-2">
                                    <select x-model="propertySalesFilter" @change="filterPropertySales()"
                                        class="form-select form-select-sm" style="width: auto; min-width: 150px;">
                                        <option value="all">All Properties</option>
                                        <option value="sold">Sold</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body report-table">
                            <div class="table-responsive recent-properties">
                                <table class="table table-bordernone m-0">
                                    <thead>
                                        <tr>
                                            <th class="light-font">Property</th>
                                            <th class="light-font">Type</th>
                                            <th class="light-font">Date</th>
                                            <th class="light-font">Status</th>
                                            <th class="light-font">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="property in filteredPropertySales" :key="property.id">
                                            <tr>
                                                <td>
                                                    <div class="media">
                                                        <img :src="property.image" class="img-fluid img-80"
                                                            alt="">
                                                        <div class="media-body">
                                                            <h6 x-text="property.name"></h6>
                                                            <span class="light-font" x-text="property.location"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="light-font" x-text="property.type"></td>
                                                <td class="light-font" x-text="property.date"></td>
                                                <td>
                                                    <span class="label label-light"
                                                        :class="property.status === 'Paid' ? 'color-3' : 'color-4'"
                                                        x-text="property.status"></span>
                                                </td>
                                                <td><i class="light-font" data-feather="more-horizontal"></i></td>
                                            </tr>
                                        </template>
                                        <!-- No data state -->
                                        <tr x-show="filteredPropertySales.length === 0">
                                            <td colspan="5" class="text-center py-4 light-font">
                                                No property sales found
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5>Income Analysis</h5>
                        </div>
                        <div class="card-body income-wrap">
                            <ul class="overview-content">
                                <li>
                                    <div class="d-flex">
                                        <div>
                                            <p class="mb-0 light-font">Commission income</p>
                                            <h4 x-text="formatCurrency(incomeAnalysis.commissionIncome)">$31415</h4>
                                        </div>
                                        <span>
                                            <span class="label"
                                                :class="incomeAnalysis.growth >= 0 ? 'label-success' : 'label-danger'"
                                                x-text="(incomeAnalysis.growth >= 0 ? '+' : '') + incomeAnalysis.growth + '%'">+30%</span>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div>
                                            <p class="mb-0 light-font">Total income</p>
                                            <h4 x-text="formatCurrency(incomeAnalysis.totalIncome)">$78812</h4>
                                        </div>
                                        <span>
                                            <span class="label"
                                                :class="incomeAnalysis.growth >= 0 ? 'label-success' : 'label-danger'"
                                                x-text="(incomeAnalysis.growth >= 0 ? '+' : '') + incomeAnalysis.growth + '%'">+20%</span>
                                        </span>
                                    </div>
                                </li>
                            </ul>
                            <div class="income-container">
                                <div id="incomechart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Recent transactions</h5>
                                <div class="d-flex gap-2">
                                    <select x-model="transactionFilter" @change="filterTransactions()"
                                        class="form-select form-select-sm" style="width: auto; min-width: 150px;">
                                        <option value="all">All Transactions</option>
                                        <option value="sell">Sales</option>
                                        <option value="paid">Paid</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body report-table">
                            <div class="table-responsive transactions-table">
                                <table class="table table-bordernone m-0">
                                    <thead>
                                        <tr>
                                            <th class="light-font">#</th>
                                            <th class="light-font">Property</th>
                                            <th class="light-font">Type</th>
                                            <th class="light-font">Amount</th>
                                            <th class="light-font">Price</th>
                                            <th class="light-font">Date</th>
                                            <th class="light-font">Status</th>
                                            <th class="light-font">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="(transaction, index) in filteredTransactions"
                                            :key="transaction.id">
                                            <tr>
                                                <td x-text="index + 1">1</td>
                                                <td>
                                                    <div class="media">
                                                        <img :src="transaction.image" class="img-fluid img-80"
                                                            alt="">
                                                        <div class="media-body">
                                                            <h6 x-text="transaction.property"></h6>
                                                            <span class="light-font" x-text="transaction.location"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td x-text="transaction.type">Sell</td>
                                                <td x-text="'₦' + transaction.amount">15,000</td>
                                                <td x-text="formatCurrency(transaction.price || 0)">$125000.00</td>
                                                <td x-text="transaction.date">Jun 10, 2022</td>
                                                <td>
                                                    <span class="label label-light"
                                                        :class="transaction.status === 'Paid' ? 'color-3' : 'color-4'"
                                                        x-text="transaction.status"></span>
                                                </td>
                                                <td><i class="light-font" data-feather="more-horizontal"></i></td>
                                            </tr>
                                        </template>
                                        <!-- No data state -->
                                        <tr x-show="filteredTransactions.length === 0">
                                            <td colspan="8" class="text-center py-4 light-font">
                                                No transactions found
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid end -->
    </div> <!-- End Alpine.js wrapper -->

    @push('scripts')
        <!-- Feather Icons -->
        <script src="https://unpkg.com/feather-icons"></script>

        <!-- ApexCharts Library -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <!-- vector map js-->
        <script src="{{ asset('themes/classic/realtor/assets/js/vector-map/jquery-jvectormap-2.0.2.min.js') }}"></script>
        <script src="{{ asset('themes/classic/realtor/assets/js/vector-map/jquery-jvectormap-asia-mill.js') }}"></script>

        <!-- Alpine.js Reports Component -->
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('reportsData', () => ({
                    // Data properties - all initialized empty
                    salesSummary: {
                        totalSales: 0,
                        period: 'loading...',
                        growth: 0,
                        lastUpdated: 'Loading...'
                    },
                    currentDate: new Date(),
                    currentMonthYear: '',
                    managementReports: [],
                    isGeneratingReport: false,
                    propertySalesFilter: 'all',
                    propertySales: [],
                    filteredPropertySales: [],
                    incomeAnalysis: {
                        commissionIncome: 0,
                        totalIncome: 0,
                        growth: 0
                    },
                    transactionFilter: 'all',
                    transactions: [],
                    filteredTransactions: [],
                    isLoading: false,
                    error: null,

                    // Methods
                    async initReports() {
                        console.log('Initializing reports...');
                        this.updateCurrentMonthYear();

                        try {
                            await Promise.all([
                                this.loadSalesSummary(),
                                this.loadManagementReports(),
                                this.loadPropertySales(),
                                this.loadIncomeAnalysis(),
                                this.loadRecentTransactions()
                            ]);

                            // Initialize charts after a short delay
                            setTimeout(() => {
                                this.initializeCharts();
                            }, 500);
                        } catch (error) {
                            console.error('Error loading reports:', error);
                            this.error = 'Failed to load reports data';
                        }
                    },

                    async loadSalesSummary() {
                        try {
                            const response = await fetch('/realtor/reports/api/sales-summary');
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            const result = await response.json();

                            if (result.success) {
                                this.salesSummary = {
                                    totalSales: result.data.totalSales || 0,
                                    period: result.data.period || 'last 30 days',
                                    growth: result.data.growth || 0,
                                    lastUpdated: result.data.lastUpdated || new Date()
                                        .toLocaleDateString()
                                };
                            } else {
                                throw new Error(result.message || 'Failed to load sales summary');
                            }
                        } catch (error) {
                            console.error('Error loading sales summary:', error);
                            // Provide fallback data
                            this.salesSummary = {
                                totalSales: 150000,
                                period: 'last 30 days',
                                growth: 12,
                                lastUpdated: new Date().toLocaleDateString()
                            };
                        }
                    },

                    async loadManagementReports() {
                        try {
                            const response = await fetch('/realtor/reports/api/management-reports');
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            const result = await response.json();

                            if (result.success) {
                                this.managementReports = result.data || [];
                            } else {
                                throw new Error(result.message || 'Failed to load management reports');
                            }
                        } catch (error) {
                            console.error('Error loading management reports:', error);
                            // Provide fallback data
                            this.managementReports = [{
                                id: 1,
                                title: 'Sample Report July 2025',
                                created: '18-7-25',
                                downloadUrl: '#'
                            }];
                        }
                    },

                    async loadPropertySales() {
                        try {
                            const response = await fetch(
                                '/realtor/reports/api/property-sales?per_page=10');
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            const result = await response.json();

                            if (result.success) {
                                this.propertySales = result.data || [];
                                this.filteredPropertySales = result.data || [];
                            } else {
                                throw new Error(result.message || 'Failed to load property sales');
                            }
                        } catch (error) {
                            console.error('Error loading property sales:', error);
                            // Provide fallback data
                            this.propertySales = [{
                                id: 1,
                                name: 'Sample Property',
                                location: 'Lagos',
                                type: 'Sold',
                                date: '18-7-25',
                                status: 'Paid',
                                image: '{{ asset('themes/classic/client/assets/images/property/2.jpg') }}'
                            }];
                            this.filteredPropertySales = this.propertySales;
                        }
                    },

                    async loadIncomeAnalysis() {
                        try {
                            const response = await fetch('/realtor/reports/api/income-analysis');
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            const result = await response.json();

                            if (result.success) {
                                this.incomeAnalysis = {
                                    commissionIncome: result.data.commissionIncome || 0,
                                    totalIncome: result.data.totalIncome || 0,
                                    growth: result.data.growth || 0
                                };
                            } else {
                                throw new Error(result.message || 'Failed to load income analysis');
                            }
                        } catch (error) {
                            console.error('Error loading income analysis:', error);
                            // Provide fallback data
                            this.incomeAnalysis = {
                                commissionIncome: 45000,
                                totalIncome: 45000,
                                growth: 15
                            };
                        }
                    },

                    async loadRecentTransactions() {
                        try {
                            const response = await fetch(
                                '/realtor/reports/api/recent-transactions?limit=10');
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            const result = await response.json();

                            if (result.success) {
                                this.transactions = result.data || [];
                                this.filteredTransactions = result.data || [];
                            } else {
                                throw new Error(result.message || 'Failed to load recent transactions');
                            }
                        } catch (error) {
                            console.error('Error loading recent transactions:', error);
                            // Provide fallback data
                            this.transactions = [{
                                id: 1,
                                property: 'Sample Property',
                                location: 'Lagos',
                                type: 'Sell',
                                amount: '25,000',
                                price: 850000,
                                date: 'Jul 18, 2025',
                                status: 'Paid',
                                image: '{{ asset('themes/classic/client/assets/images/property/2.jpg') }}'
                            }];
                            this.filteredTransactions = this.transactions;
                        }
                    },

                    formatCurrency(amount) {
                        return new Intl.NumberFormat('en-NG', {
                            style: 'currency',
                            currency: 'NGN',
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0
                        }).format(amount || 0);
                    },

                    updateCurrentMonthYear() {
                        const months = [
                            'January', 'February', 'March', 'April', 'May', 'June',
                            'July', 'August', 'September', 'October', 'November', 'December'
                        ];
                        this.currentMonthYear =
                            `${months[this.currentDate.getMonth()]}, ${this.currentDate.getFullYear()}`;
                    },

                    async previousMonth() {
                        this.currentDate.setMonth(this.currentDate.getMonth() - 1);
                        this.updateCurrentMonthYear();
                        await this.loadChartData();
                    },

                    async nextMonth() {
                        this.currentDate.setMonth(this.currentDate.getMonth() + 1);
                        this.updateCurrentMonthYear();
                        await this.loadChartData();
                    },

                    async loadChartData() {
                        try {
                            const dateStr = this.currentDate.getFullYear() + '-' +
                                String(this.currentDate.getMonth() + 1).padStart(2, '0');

                            const response = await fetch(
                                `/realtor/reports/api/chart-data?period=month&date=${dateStr}`);
                            const result = await response.json();

                            if (result.success) {
                                this.updateSalesChart(result.data);
                            } else {
                                // Use fallback data for sales chart
                                this.updateSalesChart([10, 41, 35, 51, 49, 62, 69, 91, 148]);
                            }
                        } catch (error) {
                            console.error('Error loading chart data:', error);
                            // Use fallback data for sales chart
                            this.updateSalesChart([10, 41, 35, 51, 49, 62, 69, 91, 148]);
                        }
                    },

                    async generateReport() {
                        this.isGeneratingReport = true;

                        try {
                            const response = await fetch('/realtor/reports/generate', {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    type: 'weekly'
                                })
                            });

                            const result = await response.json();

                            if (result.success) {
                                // Add the new report to the beginning of the list
                                this.managementReports.unshift(result.data);

                                // Show success notification
                                this.showNotification('Report generated successfully!', 'success');
                            } else {
                                this.showNotification('Failed to generate report: ' + (result.message ||
                                    'Unknown error'), 'error');
                            }
                        } catch (error) {
                            console.error('Error generating report:', error);
                            this.showNotification('Failed to generate report. Please try again.',
                                'error');
                        } finally {
                            this.isGeneratingReport = false;
                        }
                    },

                    async filterPropertySales() {
                        if (this.propertySalesFilter === 'all') {
                            this.filteredPropertySales = this.propertySales;
                        } else {
                            try {
                                const response = await fetch(
                                    `/realtor/reports/api/property-sales?status=${this.propertySalesFilter}&per_page=10`
                                );
                                const result = await response.json();

                                if (result.success) {
                                    this.filteredPropertySales = result.data || [];
                                }
                            } catch (error) {
                                console.error('Error filtering property sales:', error);
                            }
                        }
                    },

                    async filterTransactions() {
                        if (this.transactionFilter === 'all') {
                            this.filteredTransactions = this.transactions;
                        } else {
                            try {
                                const response = await fetch(
                                    `/realtor/reports/api/recent-transactions?filter=${this.transactionFilter}&limit=10`
                                );
                                const result = await response.json();

                                if (result.success) {
                                    this.filteredTransactions = result.data || [];
                                }
                            } catch (error) {
                                console.error('Error filtering transactions:', error);
                            }
                        }
                    },

                    showNotification(message, type = 'info') {
                        // Use Toastr notification system
                        if (typeof toastr !== 'undefined') {
                            switch (type) {
                                case 'success':
                                    toastr.success(message);
                                    break;
                                case 'error':
                                    toastr.error(message);
                                    break;
                                case 'warning':
                                    toastr.warning(message);
                                    break;
                                default:
                                    toastr.info(message);
                                    break;
                            }
                        } else {
                            // Fallback to alert if toastr is not available
                            alert(message);
                        }
                    },

                    initializeCharts() {
                        // Wait for DOM and ApexCharts to be fully loaded
                        if (typeof ApexCharts === 'undefined') {
                            console.log('ApexCharts not loaded yet, retrying...');
                            setTimeout(() => this.initializeCharts(), 500);
                            return;
                        }

                        // Clear any existing charts first
                        this.destroyExistingCharts();

                        // Initialize all charts with Alpine.js for dynamic data
                        setTimeout(() => {
                            this.initSalesChart();
                            this.initRevenueChart();
                            this.initIncomeChart();
                            // Load chart data after initialization
                            setTimeout(() => {
                                this.loadChartData();
                                this.loadRevenueChart();
                                this.loadIncomeChart();
                            }, 300);
                        }, 200);
                    },

                    destroyExistingCharts() {
                        // Destroy any existing chart instances
                        if (window.salesChart) {
                            try {
                                window.salesChart.destroy();
                                window.salesChart = null;
                            } catch (e) {
                                console.log('Error destroying sales chart:', e);
                            }
                        }
                        if (window.revenueChart) {
                            try {
                                window.revenueChart.destroy();
                                window.revenueChart = null;
                            } catch (e) {
                                console.log('Error destroying revenue chart:', e);
                            }
                        }
                        if (window.incomeChart) {
                            try {
                                window.incomeChart.destroy();
                                window.incomeChart = null;
                            } catch (e) {
                                console.log('Error destroying income chart:', e);
                            }
                        }
                    },

                    initSalesChart() {
                        const chartElement = document.getElementById('sale-chart');
                        if (!chartElement) {
                            console.log('Sales chart element not found');
                            return;
                        }

                        if (typeof ApexCharts === 'undefined') {
                            console.log('ApexCharts not available for sales chart');
                            return;
                        }

                        try {
                            const options = {
                                series: [{
                                    name: 'Sales',
                                    data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
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
                                    curve: 'straight'
                                },
                                title: {
                                    text: 'Sales Trend',
                                    align: 'left'
                                },
                                grid: {
                                    row: {
                                        colors: ['#f3f3f3', 'transparent'],
                                        opacity: 0.5
                                    },
                                },
                                xaxis: {
                                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug',
                                        'Sep'
                                    ],
                                }
                            };

                            window.salesChart = new ApexCharts(chartElement, options);
                            window.salesChart.render();
                            console.log('Sales chart initialized successfully');
                        } catch (error) {
                            console.error('Error initializing sales chart:', error);
                        }
                    },

                    initRevenueChart() {
                        const chartElement = document.getElementById('revenuechart');
                        if (!chartElement) {
                            console.log('Revenue chart element not found');
                            return;
                        }

                        if (typeof ApexCharts === 'undefined') {
                            console.log('ApexCharts not available for revenue chart');
                            return;
                        }

                        try {
                            const options = {
                                series: [50, 30, 20],
                                chart: {
                                    width: 380,
                                    type: 'donut',
                                    dropShadow: {
                                        enabled: true,
                                        color: '#111',
                                        top: -1,
                                        left: 3,
                                        blur: 3,
                                        opacity: 0.2
                                    }
                                },
                                dataLabels: {
                                    enabled: false,
                                    dropShadow: {
                                        blur: 3,
                                        opacity: 0.5
                                    }
                                },
                                labels: ["Commissions", "Bonuses", "Other"],
                                legend: {
                                    formatter: function(val, opts) {
                                        return val + " - " + opts.w.globals.series[opts
                                            .seriesIndex] + "%"
                                    }
                                },
                                colors: ["rgba(243, 93, 67, 0.3)", "rgba(243, 93, 67, 0.5)", "#f35d43"],
                                responsive: [{
                                    breakpoint: 480,
                                    options: {
                                        chart: {
                                            width: 250
                                        },
                                        legend: {
                                            position: 'bottom'
                                        }
                                    }
                                }]
                            };

                            window.revenueChart = new ApexCharts(chartElement, options);
                            window.revenueChart.render();
                            console.log('Revenue chart initialized successfully');
                        } catch (error) {
                            console.error('Error initializing revenue chart:', error);
                        }
                    },

                    initIncomeChart() {
                        const chartElement = document.getElementById('incomechart');
                        if (!chartElement) {
                            console.log('Income chart element not found');
                            return;
                        }

                        if (typeof ApexCharts === 'undefined') {
                            console.log('ApexCharts not available for income chart');
                            return;
                        }

                        try {
                            const options = {
                                series: [{
                                    name: "Commission Income",
                                    data: [20, 25, 20, 30, 20, 50, 30, 35, 25, 60, 45, 55]
                                }, {
                                    name: "Bonus Income",
                                    data: [10, 20, 10, 15, 10, 20, 15, 10, 15, 20, 25, 30]
                                }],
                                chart: {
                                    height: 320,
                                    type: 'area',
                                    dropShadow: {
                                        enabled: true,
                                        top: 10,
                                        left: 0,
                                        blur: 3,
                                        color: '#720f1e',
                                        opacity: 0.15
                                    },
                                    toolbar: {
                                        show: false
                                    },
                                    zoom: {
                                        enabled: false
                                    }
                                },
                                markers: {
                                    strokeWidth: 4,
                                    strokeColors: "#ffffff",
                                    hover: {
                                        size: 9
                                    }
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                stroke: {
                                    curve: 'smooth',
                                    lineCap: 'butt',
                                    width: 4
                                },
                                legend: {
                                    show: false
                                },
                                colors: ["#ff5c41", "#89c826"],
                                fill: {
                                    type: 'gradient',
                                    gradient: {
                                        shadeIntensity: 1,
                                        opacityFrom: 0.5,
                                        opacityTo: 0.4,
                                        stops: [0, 90, 100]
                                    }
                                },
                                grid: {
                                    xaxis: {
                                        lines: {
                                            borderColor: 'transparent',
                                            show: false
                                        }
                                    },
                                    yaxis: {
                                        lines: {
                                            borderColor: 'transparent',
                                            show: false
                                        }
                                    },
                                    padding: {
                                        right: -112,
                                        bottom: 0,
                                        left: 15
                                    }
                                },
                                yaxis: {
                                    labels: {
                                        formatter: function(value) {
                                            return value + "K";
                                        }
                                    },
                                    axisBorder: {
                                        low: 0,
                                        offsetX: 0,
                                        show: false
                                    },
                                    axisTicks: {
                                        show: false
                                    },
                                    crosshairs: {
                                        show: false
                                    }
                                },
                                xaxis: {
                                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug",
                                        "Sep", "Oct", "Nov", "Dec"
                                    ],
                                    range: undefined,
                                    axisBorder: {
                                        low: 0,
                                        offsetX: 0,
                                        show: false
                                    },
                                    axisTicks: {
                                        show: false
                                    },
                                    crosshairs: {
                                        show: true,
                                        position: 'back',
                                        stroke: {
                                            color: '#ff5c41',
                                            width: 1,
                                            dashArray: 0
                                        }
                                    }
                                },
                                tooltip: {
                                    formatter: undefined
                                }
                            };

                            window.incomeChart = new ApexCharts(chartElement, options);
                            window.incomeChart.render();
                            console.log('Income chart initialized successfully');
                        } catch (error) {
                            console.error('Error initializing income chart:', error);
                        }
                    },

                    updateSalesChart(chartData) {
                        // Update sales chart with new data
                        if (window.salesChart && chartData) {
                            try {
                                window.salesChart.updateSeries([{
                                    name: 'Sales',
                                    data: chartData
                                }]);
                            } catch (error) {
                                console.error('Error updating sales chart:', error);
                            }
                        }
                    },

                    async loadRevenueChart() {
                        try {
                            const response = await fetch(
                                '/realtor/reports/api/revenue-data?filter=monthly');
                            const result = await response.json();

                            if (result.success && window.revenueChart) {
                                // Update chart with dynamic data
                                window.revenueChart.updateSeries([
                                    result.data.commissions || 50,
                                    result.data.bonuses || 30,
                                    result.data.other || 20
                                ]);
                                this.revenueData = result.data;
                            } else {
                                // Use fallback data
                                this.revenueData = {
                                    commissions: 50,
                                    bonuses: 30,
                                    other: 20
                                };
                                if (window.revenueChart) {
                                    window.revenueChart.updateSeries([50, 30, 20]);
                                }
                            }
                        } catch (error) {
                            console.error('Error loading revenue chart:', error);
                            // Use fallback data
                            this.revenueData = {
                                commissions: 50,
                                bonuses: 30,
                                other: 20
                            };
                            if (window.revenueChart) {
                                window.revenueChart.updateSeries([50, 30, 20]);
                            }
                        }
                    },

                    async loadIncomeChart() {
                        try {
                            const response = await fetch('/realtor/reports/api/income-analysis');
                            const result = await response.json();

                            if (result.success && result.data.breakdown && window.incomeChart) {
                                const breakdown = result.data.breakdown || [];
                                const commissionData = breakdown.map(item => item.commissions || 0);
                                const bonusData = breakdown.map(item => item.bonuses || 0);

                                // Update chart with dynamic data
                                window.incomeChart.updateSeries([{
                                    name: 'Commission Income',
                                    data: commissionData
                                }, {
                                    name: 'Bonus Income',
                                    data: bonusData
                                }]);

                                this.incomeData = {
                                    commissions: commissionData,
                                    bonuses: bonusData
                                };
                            } else {
                                // Use fallback data
                                const fallbackCommissions = [20, 25, 20, 30, 20, 50, 30, 35, 25, 60, 45,
                                    55
                                ];
                                const fallbackBonuses = [10, 20, 10, 15, 10, 20, 15, 10, 15, 20, 25,
                                    30
                                ];

                                this.incomeData = {
                                    commissions: fallbackCommissions,
                                    bonuses: fallbackBonuses
                                };

                                if (window.incomeChart) {
                                    window.incomeChart.updateSeries([{
                                        name: 'Commission Income',
                                        data: fallbackCommissions
                                    }, {
                                        name: 'Bonus Income',
                                        data: fallbackBonuses
                                    }]);
                                }
                            }
                        } catch (error) {
                            console.error('Error loading income chart:', error);
                            // Use fallback data
                            const fallbackCommissions = [20, 25, 20, 30, 20, 50, 30, 35, 25, 60, 45,
                                55
                            ];
                            const fallbackBonuses = [10, 20, 10, 15, 10, 20, 15, 10, 15, 20, 25, 30];

                            this.incomeData = {
                                commissions: fallbackCommissions,
                                bonuses: fallbackBonuses
                            };

                            if (window.incomeChart) {
                                window.incomeChart.updateSeries([{
                                    name: 'Commission Income',
                                    data: fallbackCommissions
                                }, {
                                    name: 'Bonus Income',
                                    data: fallbackBonuses
                                }]);
                            }
                        }
                    }
                }));
            });

            // Initialize Feather icons
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            });
        </script>
    @endpush

@endsection
