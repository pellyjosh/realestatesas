@extends('themes.classic.realtor.realtor_master')
@section('title', 'Referral | Premium Refined Luxury Homes')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .custom-table-container {
            border-radius: 10px;
            padding: 1.5rem;
        }

        .table thead th {
            background: #e5f5c7;
            color: #333;
            font-weight: 600;
        }

        .table td,
        .table th {
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

        .dataTables_paginate .paginate_button:hover:not(.current Zimmerman) {
            background-color: #e5f5c7 !important;
            color: #333 !important;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid" x-data='referralList({ referrals: @json($referrals) })' x-init="init">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-left">
                        <h3>Referrals
                            <small>Welcome to realtor panel</small>
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="custom-table-container">
            <!-- Referral Link Section -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <div class="p-4 bg-light rounded flex-grow-1 me-3 mb-3 mb-md-0" x-data="{ referralLink: '{{ url('/register?ref=' . auth()->user()->referral_code) }}', copied: false }">
                    <div
                        class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-3">
                        <h5 class="mb-2 fw-semibold me-md-3">Your Referral Link</h5>
                        <button class="btn btn-success mt-3" @click="showForm = !showForm"
                            x-text="showForm ? 'Hide Form' : 'Add Referral'">Add Referral</button>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" :value="referralLink" readonly>
                        <button class="btn btn-outline-secondary"
                            @click="navigator.clipboard.writeText(referralLink); copied = true; setTimeout(() => copied = false, 2000)"
                            x-text="copied ? 'Copied!' : 'Copy Link'">
                            Copy Link
                        </button>
                    </div>
                    <p class="mt-2 text-muted small">Share this link with others to refer them.</p>
                </div>
            </div>

            <!-- Register Realtor Form Section -->
            <div class="mb-6 p-4 bg-light rounded" x-show="showForm" x-transition>
                <h5 class="mb-3 fw-semibold">Register New Realtor Referral</h5>
                <form @submit.prevent="createReferral">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="realtorImage" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="realtorImage"
                                @change="form.image = $event.target.files[0]">
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="realtorName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="realtorName" x-model="form.name"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="realtorPhone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="realtorPhone" x-model="form.phone"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="realtorEmail" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="realtorEmail" x-model="form.email"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="realtorPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="realtorPassword" x-model="form.password"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="realtorPasswordConfirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="realtorPasswordConfirmation"
                                        x-model="form.password_confirmation" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="referredByCode" class="form-label">Referral Code</label>
                                    <input type="text" class="form-control" id="referredByCode"
                                        x-model="form.referred_by_code" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Submit Referral</button>
                </form>
            </div>

            <!-- Search and Table -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <h5 class="mb-0 fw-semibold">My Referrals</h5>
                <input type="text" x-model="search" class="form-control w-25" placeholder="Search by name or phone...">
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-sm align-middle mb-0 w-100"
                    style="border-color: #91d20a;">
                    <thead>
                        <tr>
                            <th class="text-uppercase small text-secondary fw-bold py-3">Name</th>
                            <th class="text-uppercase small text-secondary fw-bold py-3">Email</th>
                            <th class="text-uppercase small text-secondary fw-bold py-3">Phone Number</th>
                            <th class="text-uppercase small text-secondary fw-bold py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr x-show="!filteredReferrals.length">
                            <td colspan="5" class="text-center text-muted">No referrals found</td>
                        </tr>
                        <template x-for="referral in paginatedReferrals" :key="referral.id">
                            <tr class="border-bottom">
                                <td class="text-muted" x-text="referral.name"></td>
                                <td class="text-muted" x-text="referral.email"></td>
                                <td class="fw-semibold text-success" x-text="referral.phone"></td>
                                <td
                                    x-text="new Date(referral.created_at).toLocaleDateString('en-US', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: '2-digit'
                                })">
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-3"
                    x-show="filteredReferrals.length > perPage">
                    <div>
                        Showing <span x-text="startIndex + 1"></span> to <span x-text="endIndex"></span> of <span
                            x-text="filteredReferrals.length"></span>
                    </div>
                    <div class="dataTables_paginate">
                        <button class="paginate_button" :disabled="currentPage === 1" @click="currentPage--">
                            Previous
                        </button>
                        <button class="paginate_button" :disabled="endIndex >= filteredReferrals.length"
                            @click="currentPage++">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: 3000,
        };

        document.addEventListener('alpine:init', () => {
            Alpine.data('referralList', (initialData) => ({
                referrals: initialData.referrals,
                search: '',
                currentPage: 1,
                perPage: 5,
                showForm: false,
                form: {
                    image: null,
                    name: '',
                    phone: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    referred_by_code: '{{ auth()->user()->referral_code }}', // Corrected to referral_code
                },

                init() {
                    console.log('Referrals loaded:', this.referrals);
                },

                get filteredReferrals() {
                    if (!this.search) return this.referrals;
                    return this.referrals.filter(referral =>
                        referral.name.toLowerCase().includes(this.search.toLowerCase()) ||
                        referral.phone.toLowerCase().includes(this.search.toLowerCase())
                    );
                },

                get startIndex() {
                    return (this.currentPage - 1) * this.perPage;
                },

                get endIndex() {
                    return Math.min(this.startIndex + this.perPage, this.filteredReferrals.length);
                },

                get paginatedReferrals() {
                    return this.filteredReferrals.slice(this.startIndex, this.endIndex);
                },

                notify(msg, type = 'success') {
                    toastr[type](msg);
                },

                async createReferral() {
                    try {
                        const formData = new FormData();
                        if (this.form.image) formData.append('image', this.form.image);
                        formData.append('name', this.form.name);
                        formData.append('phone', this.form.phone);
                        formData.append('email', this.form.email);
                        formData.append('password', this.form.password);
                        formData.append('password_confirmation', this.form.password_confirmation);
                        formData.append('referred_by_code', this.form.referred_by_code);

                        const response = await fetch(
                            '{{ route('tenant.realtor.referrals.create') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                },
                                body: formData,
                            });
                        const data = await response.json();

                        console.log(data);

                        if (response.ok) {
                            this.referrals.push({
                                id: data.referral.id,
                                name: this.form.name,
                                email: this.form.email,
                                phone: this.form.phone,
                                created_at: new Date().toISOString(),
                            });

                            this.form = {
                                image: null,
                                name: '',
                                phone: '',
                                email: '',
                                password: '',
                                password_confirmation: '',
                                referred_by_code: '{{ auth()->user()->referral_code }}', // Corrected to referral_code
                            };

                            this.showForm = false;

                            this.notify(data.message || 'Referral created!');
                        } else {
                            if (data.errors) {
                                Object.values(data.errors).forEach(error => {
                                    this.notify(error[0], 'error');
                                });
                            } else {
                                this.notify(data.message || 'Validation failed.', 'error');
                            }
                        }
                    } catch (error) {
                        this.notify('Error creating referral: ' + error.message, 'error');
                    }
                },
            }));
        });
    </script>
@endpush
