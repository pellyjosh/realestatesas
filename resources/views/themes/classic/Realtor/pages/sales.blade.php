@extends('themes.classic.realtor.realtor_master')
@section('title', 'Earnings | Premium Refined Luxury Homes')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .custom-table-container {
            border-radius: 10px;
            width: 100%;
            overflow-x: auto;
        }

        .card-body {
            padding: 10px;
        }

        .card .card-header {
            padding: 10px;
        }

        .filter-panel {
            padding: 0px;
        }

        .table thead th {
            background: #e5f5c7;
            color: #333;
            font-weight: 600;
            padding: 0.5rem;
        }

        .table td,
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

        .filter-panel .form-select,
        .filter-panel .form-control {
            background-color: #f6faeb;
            border-color: #91d20a;
            color: #333;
        }

        .filter-panel .form-select:focus,
        .filter-panel .form-control:focus {
            border-color: #91d20a;
            box-shadow: 0 0 0 0.2rem rgba(145, 210, 10, 0.25);
        }

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

        [x-cloak] {
            display: none;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid" x-data="salesData()">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div
                        class="page-header-left d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <div>
                            <h3 class="mb-2">Sales</h3>
                            <small class="text-muted">Welcome to realtor panel</small>
                        </div>
                        <button class="btn btn-success mt-3 mt-md-0" @click="showForm = !showForm"
                            x-text="showForm ? 'Hide Form' : 'Add Sale'">Add Sale</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Request Form -->
        <div class="custom-table-container">
            <div class="mb-6 p-4 bg-light rounded" x-show="showForm" x-transition>
                <h5 class="mb-3 fw-semibold">Register New Sale</h5>
                <form @submit.prevent="submitSale">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="propertyId" class="form-label">Select Property</label>
                            <select id="propertyId" x-model="form.property_id" class="form-select" required>
                                <option value="" disabled>Select a property</option>
                                <template x-for="property in properties" :key="property.id">
                                    <option :value="property.id" x-text="property.name"></option>
                                </template>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="clientName" class="form-label">Client Name</label>
                            <input type="text" id="clientName" x-model="form.client_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="clientEmail" class="form-label">Client Email</label>
                            <input type="email" id="clientEmail" x-model="form.client_email" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="clientPhone" class="form-label">Client Phone</label>
                            <input type="tel" id="clientPhone" x-model="form.client_phone" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success mt-3">Submit Sale</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Summary Statistics Cards -->
        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <h6>Total Earnings</h6>
                                <h4 class="mb-0" x-text="formatCurrency(totalEarnings)"></h4>
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
                                <h4 class="mb-0" x-text="formatCurrency(thisMonthEarnings)"></h4>
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
                                <h4 class="mb-0" x-text="formatCurrency(pendingPayments)"></h4>
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
                                <h4 class="mb-0" x-text="averageCommission + '%'"></h4>
                            </div>
                            <div class="icon-box bg-danger-light">
                                <i class="fas fa-percentage"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Commission Breakdown Table -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Earnings Breakdown</h5>
                    </div>
                    <div class="card-body">
                        <div class="custom-table-container">
                            <div class="filter-panel">
                                <div class="form-group">
                                    <label for="fromDate" class="small text-secondary fw-bold">From Date</label>
                                    <input type="date" id="fromDate" x-model="filters.fromDate"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="toDate" class="small text-secondary fw-bold">To Date</label>
                                    <input type="date" id="toDate" x-model="filters.toDate"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="form-group ms-auto">
                                    <button class="btn btn-sm" @click="exportData"
                                        style="background-color: #91d20a; color: #fff; border-color: #91d20a; margin-top: 1.5rem;">
                                        Export Data
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered text-sm align-middle"
                                    style="border-color: #91d20a;">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase small text-secondary fw-bold">Date</th>
                                            <th class="text-uppercase small text-secondary fw-bold">Property</th>
                                            <th class="text-uppercase small text-secondary fw-bold">Client</th>
                                            <th class="text-uppercase small text-secondary fw-bold">Client Email</th>
                                            <th class="text-uppercase small text-secondary fw-bold">Client Phone</th>
                                            <th class="text-uppercase small text-secondary fw-bold">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr x-show="!filteredSales.length">
                                            <td colspan="6" class="text-center text-muted">No sales found</td>
                                        </tr>
                                        <template x-for="sale in paginatedSales" :key="sale.id">
                                            <tr class="border-bottom">
                                                <td class="text-muted" x-text="formatDate(sale.date)"></td>
                                                <td class="text-muted" x-text="sale.property_name"></td>
                                                <td class="text-muted" x-text="sale.client_name"></td>
                                                <td class="text-muted" x-text="sale.client_email || '-'"></td>
                                                <td class="text-muted" x-text="sale.client_phone || '-'"></td>
                                                <td class="fw-semibold"
                                                    :class="sale.status === 'pending' ? 'text-warning' : 'text-success'"
                                                    x-text="sale.status"></td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-between align-items-center mt-3"
                                    x-show="filteredSales.length > perPage">
                                    <div>
                                        Showing <span x-text="startIndex + 1"></span> to <span x-text="endIndex"></span>
                                        of <span x-text="filteredSales.length"></span>
                                    </div>
                                    <div class="dataTables_paginate">
                                        <button class="paginate_button" :disabled="currentPage === 1"
                                            @click="currentPage--">
                                            Previous
                                        </button>
                                        <button class="paginate_button" :disabled="endIndex >= filteredSales.length"
                                            @click="currentPage++">
                                            Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Recent Transactions</h5>
                    </div>
                    <div class="card-body">
                        <div class="transaction-list">
                            <div x-show="!recentTransactions.length" class="text-center text-muted p-3">
                                No records found
                            </div>
                            <template x-for="sale in recentTransactions" :key="sale.id">
                                <div class="transaction-item" :class="{ pending: sale.status === 'pending' }">
                                    <div class="media">
                                        <div class="transaction-icon">
                                            <i class="fas"
                                                :class="sale.status === 'pending' ? 'fa-hourglass-half' : 'fa-arrow-down'"></i>
                                        </div>
                                        <div class="media-body transaction-details">
                                            <h6
                                                x-text="sale.status === 'pending' ? 'Pending Payment' : 'Payment Received'">
                                            </h6>
                                            <p x-text="sale.property_name + ' - ' + sale.client_name"></p>
                                            <p x-text="sale.client_email || 'No email provided'"></p>
                                            <p x-text="sale.client_phone || 'No phone provided'"></p>
                                        </div>
                                        <div class="transaction-amount">
                                            <p x-text="formatDate(sale.date)"></p>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: 3000,
        };

        document.addEventListener('alpine:init', () => {
            Alpine.data('salesData', () => ({
                properties: [{
                        id: 1,
                        name: 'Luxury Villa #123'
                    },
                    {
                        id: 2,
                        name: 'Beachfront Condo #456'
                    },
                    {
                        id: 3,
                        name: 'Suburban House #789'
                    },
                    {
                        id: 4,
                        name: 'City Apartment #101'
                    },
                    {
                        id: 5,
                        name: 'Penthouse Suite #202'
                    },
                ],
                sales: [],
                filters: {
                    fromDate: '',
                    toDate: '',
                },
                form: {
                    property_id: '',
                    client_name: '',
                    client_email: '',
                    client_phone: '',
                },
                showForm: false,
                currentPage: 1,
                perPage: 5,

                init() {
                    console.log('Sales data loaded:', this.sales);
                },

                get filteredSales() {
                    let filtered = this.sales;
                    if (this.filters.fromDate) {
                        filtered = filtered.filter(sale => new Date(sale.date) >= new Date(this
                            .filters.fromDate));
                    }
                    if (this.filters.toDate) {
                        filtered = filtered.filter(sale => new Date(sale.date) <= new Date(this
                            .filters.toDate));
                    }
                    return filtered;
                },

                get paginatedSales() {
                    const start = (this.currentPage - 1) * this.perPage;
                    const end = start + this.perPage;
                    return this.filteredSales.slice(start, end);
                },

                get recentTransactions() {
                    return this.filteredSales.slice(0, 4);
                },

                get startIndex() {
                    return (this.currentPage - 1) * this.perPage;
                },

                get endIndex() {
                    return Math.min(this.startIndex + this.perPage, this.filteredSales.length);
                },

                get totalEarnings() {
                    return 0;
                },

                get thisMonthEarnings() {
                    return 0;
                },

                get pendingPayments() {
                    return 0;
                },

                get averageCommission() {
                    return 0;
                },

                formatCurrency(value) {
                    return '₦' + Number(value).toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                },

                formatDate(date) {
                    return new Date(date).toISOString().split('T')[0];
                },

                submitSale() {
                    if (!this.form.property_id || !this.form.client_name) {
                        this.notify('Please fill in all required fields.', 'error');
                        return;
                    }
                    const selectedProperty = this.properties.find(p => p.id == this.form.property_id);
                    const newSale = {
                        id: this.sales.length + 1,
                        date: new Date().toISOString().split('T')[0],
                        property_name: selectedProperty ? selectedProperty.name :
                            'Unknown Property',
                        client_name: this.form.client_name,
                        client_email: this.form.client_email,
                        client_phone: this.form.client_phone,
                        status: 'pending',
                    };
                    this.sales.push(newSale);
                    this.form = {
                        property_id: '',
                        client_name: '',
                        client_email: '',
                        client_phone: '',
                    };
                    this.showForm = false;
                    this.notify('Client sale submitted successfully!');
                },

                exportData() {
                    this.notify('Export functionality not implemented yet.', 'info');
                },

                notify(msg, type = 'success') {
                    toastr[type](msg);
                },
            }));
        });
    </script>
@endpush
