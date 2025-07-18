@extends('themes.classic.realtor.realtor_master')
@section('title', 'Wallet | Premium Refined Luxury Homes')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .wallet-card {
            background: linear-gradient(135deg, #91d20a 0%, #7ab900 100%);
            border-radius: 15px;
            color: white;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .wallet-balance {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .wallet-subtitle {
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .transaction-item {
            background-color: #f9f9f9;
            border-left: 4px solid #91d20a;
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 15px 20px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .transaction-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .transaction-icon {
            background-color: #e5f5c7;
            color: #91d20a;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .transaction-icon.debit {
            background-color: #ffebee;
            color: #f44336;
        }

        .transaction-icon.credit {
            background-color: #e8f5e8;
            color: #4caf50;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-failed {
            background-color: #f8d7da;
            color: #721c24;
        }

        .withdrawal-form {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .custom-table-container {
            border-radius: 10px;
            width: 100%;
            overflow-x: auto;
        }

        .table thead th {
            background: #e5f5c7;
            color: #333;
            font-weight: 600;
            padding: 0.75rem;
        }

        .filter-panel {
            margin-bottom: 1rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            align-items: end;
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
    </style>
@endpush

@section('content')
    <div class="container-fluid" x-data="walletData()">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="page-title">My Wallet</h3>
                </div>
            </div>
        </div>

        <!-- Wallet Balance Card -->
        <div class="row">
            <div class="col-xl-12">
                <div class="wallet-card">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="wallet-subtitle">Available Balance</h6>
                            <div class="wallet-balance" x-text="formatCurrency(wallet.available_balance)"></div>
                            <p class="wallet-subtitle mb-0">Total Balance: <span
                                    x-text="formatCurrency(wallet.balance)"></span></p>
                        </div>
                        <div class="col-md-4 text-end">
                            <button class="btn btn-light btn-lg" @click="showWithdrawModal = true">
                                <i class="fas fa-download me-2"></i>Withdraw
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <div class="stats-card">
                    <div class="media">
                        <div class="media-body">
                            <h6>Total Earnings</h6>
                            <h4 class="mb-0 text-success" x-text="formatCurrency(stats.total_earnings)"></h4>
                        </div>
                        <div class="icon-box bg-success-light">
                            <i class="fas fa-coins"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="stats-card">
                    <div class="media">
                        <div class="media-body">
                            <h6>This Month</h6>
                            <h4 class="mb-0 text-primary" x-text="formatCurrency(stats.this_month_earnings)"></h4>
                        </div>
                        <div class="icon-box bg-primary-light">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="stats-card">
                    <div class="media">
                        <div class="media-body">
                            <h6>Pending Withdrawals</h6>
                            <h4 class="mb-0 text-warning" x-text="formatCurrency(stats.pending_withdrawals)"></h4>
                        </div>
                        <div class="icon-box bg-warning-light">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="stats-card">
                    <div class="media">
                        <div class="media-body">
                            <h6>Total Withdrawals</h6>
                            <h4 class="mb-0 text-info" x-text="formatCurrency(stats.total_withdrawals)"></h4>
                        </div>
                        <div class="icon-box bg-info-light">
                            <i class="fas fa-arrow-down"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Transaction History</h5>
                    </div>
                    <div class="card-body">
                        <div class="custom-table-container">
                            <div class="filter-panel">
                                <div class="form-group">
                                    <label class="small text-secondary fw-bold">Type</label>
                                    <select x-model="filters.type" class="form-select">
                                        <option value="">All Types</option>
                                        <option value="commission">Commission</option>
                                        <option value="withdrawal">Withdrawal</option>
                                        <option value="bonus">Bonus</option>
                                        <option value="refund">Refund</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="small text-secondary fw-bold">Status</label>
                                    <select x-model="filters.status" class="form-select">
                                        <option value="">All Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="completed">Completed</option>
                                        <option value="failed">Failed</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="small text-secondary fw-bold">From Date</label>
                                    <input type="date" x-model="filters.from_date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="small text-secondary fw-bold">To Date</label>
                                    <input type="date" x-model="filters.to_date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" @click="loadTransactions">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Reference</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="transaction in transactions.data" :key="transaction.id">
                                            <tr>
                                                <td x-text="formatDate(transaction.created_at)"></td>
                                                <td>
                                                    <span class="badge bg-secondary" x-text="transaction.type"></span>
                                                </td>
                                                <td x-text="transaction.description || 'No description'"></td>
                                                <td>
                                                    <span
                                                        :class="{
                                                            'text-success': transaction.direction === 'credit',
                                                            'text-danger': transaction.direction === 'debit'
                                                        }"
                                                        x-text="transaction.formatted_amount || formatCurrency(transaction.amount)"></span>
                                                </td>
                                                <td>
                                                    <span class="status-badge"
                                                        :class="{
                                                            'status-pending': transaction.status === 'pending',
                                                            'status-completed': transaction.status === 'completed',
                                                            'status-failed': transaction.status === 'failed'
                                                        }"
                                                        x-text="transaction.status"></span>
                                                </td>
                                                <td>
                                                    <small x-text="transaction.reference"></small>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>

                                <div x-show="!transactions.data || transactions.data.length === 0"
                                    class="text-center text-muted p-3">
                                    No transactions found
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Withdrawal Modal -->
        <div class="modal fade" :class="{ 'show d-block': showWithdrawModal }" tabindex="-1"
            style="background: rgba(0,0,0,0.5)" x-show="showWithdrawModal" x-transition>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Withdraw Funds</h5>
                        <button type="button" class="btn-close" @click="showWithdrawModal = false"></button>
                    </div>
                    <form @submit.prevent="submitWithdrawal">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Amount to Withdraw *</label>
                                <input type="number" x-model="withdrawalForm.amount" class="form-control"
                                    placeholder="Enter amount" min="100" :max="wallet.available_balance" required>
                                <small class="text-muted">Available balance: <span
                                        x-text="formatCurrency(wallet.available_balance)"></span></small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Bank Name *</label>
                                <input type="text" x-model="withdrawalForm.bank_name" class="form-control"
                                    placeholder="Enter bank name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Account Number *</label>
                                <input type="text" x-model="withdrawalForm.account_number" class="form-control"
                                    placeholder="Enter account number" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Account Name *</label>
                                <input type="text" x-model="withdrawalForm.account_name" class="form-control"
                                    placeholder="Enter account name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description (Optional)</label>
                                <textarea x-model="withdrawalForm.description" class="form-control" rows="3"
                                    placeholder="Add a note for this withdrawal"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                @click="showWithdrawModal = false">Cancel</button>
                            <button type="submit" class="btn btn-primary" :disabled="isLoading">
                                <span x-show="!isLoading">Submit Withdrawal</span>
                                <span x-show="isLoading">Processing...</span>
                            </button>
                        </div>
                    </form>
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
            Alpine.data('walletData', () => ({
                wallet: @json($wallet ?? []),
                stats: @json([
                    'total_earnings' => $totalEarnings ?? 0,
                    'this_month_earnings' => $monthlyEarnings ?? 0,
                    'pending_withdrawals' => 0,
                    'total_withdrawals' => 0,
                ]),
                transactions: {
                    data: @json($transactions ?? [])
                },
                showWithdrawModal: false,
                isLoading: false,
                filters: {
                    type: '',
                    status: '',
                    from_date: '',
                    to_date: '',
                },
                withdrawalForm: {
                    amount: '',
                    bank_name: '',
                    account_number: '',
                    account_name: '',
                    description: '',
                },

                init() {
                    console.log('Wallet data loaded:', this.wallet);
                    this.loadWalletStats();
                    this.loadTransactions();
                },

                async loadWalletStats() {
                    try {
                        const response = await fetch('{{ route('tenant.realtor.wallet.stats') }}', {
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });

                        const result = await response.json();
                        if (result.success) {
                            this.stats = result.stats;
                        }
                    } catch (error) {
                        console.error('Error loading wallet stats:', error);
                    }
                },

                async loadTransactions() {
                    try {
                        const params = new URLSearchParams();
                        if (this.filters.type) params.append('type', this.filters.type);
                        if (this.filters.status) params.append('status', this.filters.status);
                        if (this.filters.from_date) params.append('from_date', this.filters
                            .from_date);
                        if (this.filters.to_date) params.append('to_date', this.filters.to_date);

                        const response = await fetch(
                            `{{ route('tenant.realtor.wallet.transactions') }}?${params.toString()}`, {
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            });

                        const result = await response.json();
                        if (result.success) {
                            this.transactions = result.transactions;
                        }
                    } catch (error) {
                        console.error('Error loading transactions:', error);
                    }
                },

                async submitWithdrawal() {
                    if (!this.validateWithdrawal()) return;

                    this.isLoading = true;

                    try {
                        const response = await fetch(
                            '{{ route('tenant.realtor.wallet.withdraw') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify(this.withdrawalForm)
                            });

                        const result = await response.json();

                        if (result.success) {
                            this.notify(result.message, 'success');
                            this.showWithdrawModal = false;
                            this.resetWithdrawalForm();
                            // Reload wallet data
                            window.location.reload();
                        } else {
                            this.notify(result.message || 'Failed to submit withdrawal request.',
                                'error');
                        }
                    } catch (error) {
                        console.error('Error submitting withdrawal:', error);
                        this.notify('An error occurred while submitting withdrawal request.',
                            'error');
                    } finally {
                        this.isLoading = false;
                    }
                },

                validateWithdrawal() {
                    if (!this.withdrawalForm.amount || this.withdrawalForm.amount < 100) {
                        this.notify('Minimum withdrawal amount is ₦100', 'error');
                        return false;
                    }

                    if (this.withdrawalForm.amount > this.wallet.available_balance) {
                        this.notify('Insufficient balance for this withdrawal', 'error');
                        return false;
                    }

                    if (!this.withdrawalForm.bank_name || !this.withdrawalForm.account_number || !this
                        .withdrawalForm.account_name) {
                        this.notify('Please fill in all required bank details', 'error');
                        return false;
                    }

                    return true;
                },

                resetWithdrawalForm() {
                    this.withdrawalForm = {
                        amount: '',
                        bank_name: '',
                        account_number: '',
                        account_name: '',
                        description: '',
                    };
                },

                formatCurrency(value) {
                    return '₦' + Number(value || 0).toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                },

                formatDate(date) {
                    return new Date(date).toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                },

                notify(msg, type = 'success') {
                    toastr[type](msg);
                },
            }));
        });
    </script>
@endpush
