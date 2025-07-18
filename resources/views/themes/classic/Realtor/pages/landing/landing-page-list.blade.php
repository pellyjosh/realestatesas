@extends('themes.classic.realtor.realtor_master')
@section('title', 'Landing Page List')

@push('styles')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .badge {
            font-size: 0.875rem;
            font-weight: 500;
        }

        .table td {
            vertical-align: middle;
        }

        .text-nowrap {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .badge.bg-success {
            background-color: #28a745 !important;
        }

        .badge.bg-info {
            background-color: #17a2b8 !important;
        }

        .badge.bg-warning {
            background-color: #ffc107 !important;
            color: #212529 !important;
        }

        .badge.bg-danger {
            background-color: #dc3545 !important;
        }

        .badge.bg-secondary {
            background-color: #6c757d !important;
        }

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            background-color: #91d20a;
            color: white;
            font-weight: 600;
            border: none;
            padding: 15px 12px;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.875rem;
        }

        .d-flex.gap-2 {
            gap: 0.5rem !important;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid" x-data="landingPageList({ landingPages: {{ @json_encode($landingPages) }} })" x-init="init">
        <!-- Page Header -->
        <div class="page-header mb-4">
            <div class="row">
                <div class="col-md-6">
                    <h3>Landing Pages <small class="text-muted d-block">Welcome to the Realtor Panel</small></h3>
                </div>
            </div>
        </div>

        <!-- Create Form -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">Generate New Landing Page</h5>
                <form x-on:submit.prevent="createLink" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="type" class="form-label">Type</label>
                        <select id="type" class="form-select" x-model="newLink.type" required>
                            <option value="" disabled>Select type</option>
                            <option value="promotion">Promotion Page</option>
                            <option value="inspection">Inspection Form</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="property" class="form-label">Property</label>
                        <select id="property" class="form-select" x-model="newLink.property" required>
                            <option value="" disabled>Select a property</option>
                            @foreach ($properties as $property)
                                <option value="{{ $property->id }}">{{ $property->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="expiration" class="form-label">Expiration Date</label>
                        <input type="text" id="expiration" x-model="newLink.expiration" class="form-control flatpickr"
                            placeholder="Select date & time" required>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fas fa-link me-1"></i> Generate
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Search -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h5 class="mb-0 fw-semibold">Landing Pages Management</h5>
            <div class="d-flex gap-2 align-items-center">
                <div class="input-group" style="width: 250px;">
                    <input type="text" class="form-control form-control-sm"
                        placeholder="Search by link, property, or type..." x-model="search" @input="currentPage = 1">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle w-100" style="border-color: #91d20a;">
                <thead>
                    <tr>
                        <th>Link</th>
                        <th>Property</th>
                        <th>Type</th>
                        <th>Expires At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr x-show="!filteredPages.length">
                        <td colspan="6" class="text-center text-muted">
                            <span x-show="!search">No landing pages found</span>
                            <span x-show="search">No landing pages match your search</span>
                        </td>
                    </tr>
                    <template x-for="page in paginatedPages" :key="page.id">
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <a :href="page.referral_link" x-text="page.referral_link" class="text-nowrap"
                                        target="_blank"></a>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"
                                        x-on:click="copyLink(page.referral_link)" title="Copy referral link">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                                <small class="text-muted d-block">
                                    Referral Code: <code x-text="page.user_referral_code"></code>
                                </small>
                            </td>
                            <td x-text="page.property.name || 'N/A'"></td>
                            <td>
                                <template x-if="page.type === 'promotion'">
                                    <span class="badge bg-success"><i class="fas fa-bullhorn me-1"></i>Promotion Page</span>
                                </template>
                                <template x-if="page.type === 'inspection'">
                                    <span class="badge bg-info"><i class="fas fa-clipboard-list me-1"></i>Inspection
                                        Form</span>
                                </template>
                                <template x-if="!['promotion', 'inspection'].includes(page.type)">
                                    <span x-text="page.type.charAt(0).toUpperCase() + page.type.slice(1)"
                                        class="badge bg-secondary"></span>
                                </template>
                            </td>
                            <td>
                                <span
                                    x-text="new Date(page.expires_at).toLocaleDateString() + ' ' + new Date(page.expires_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})"
                                    class="small text-muted"></span>
                            </td>
                            <td>
                                <template x-if="new Date(page.expires_at) < new Date()">
                                    <span class="badge bg-warning">Expired</span>
                                </template>
                                <template x-if="new Date(page.expires_at) >= new Date()">
                                    <span x-text="page.is_active ? 'Active' : 'Inactive'"
                                        :class="{
                                            'badge bg-success': page.is_active,
                                            'badge bg-danger': !page.is_active
                                        }"
                                        class="badge"></span>
                                </template>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <template x-if="page.is_active && new Date(page.expires_at) >= new Date()">
                                        <button class="btn btn-warning btn-sm" x-on:click="deactivateLink(page.id)"
                                            title="Deactivate">
                                            <i class="fas fa-stop"></i>
                                        </button>
                                    </template>
                                    <template x-if="!page.is_active">
                                        <button class="btn btn-success btn-sm" x-on:click="activateLink(page.id)"
                                            title="Activate">
                                            <i class="fas fa-play"></i>
                                        </button>
                                    </template>
                                    <button class="btn btn-danger btn-sm" x-on:click="deleteLink(page.id)"
                                        title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <a :href="`{{ url('/realtor/property') }}/${page.property.slug}?ref=${page.user_referral_code}`"
                                        target="_blank" class="btn btn-info btn-sm"
                                        title="View Landing Page with Referral">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    </template>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4" x-show="totalPages > 1">
                <div class="text-muted">
                    Showing <span x-text="startIndex + 1"></span> to <span x-text="endIndex"></span>
                    of <span x-text="filteredPages.length"></span> landing pages
                </div>

                <div class="alpine-pagination d-flex align-items-center gap-2">
                    <button class="page-btn" @click="goToPage(currentPage - 1)" :disabled="currentPage === 1">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <template x-for="page in visiblePages" :key="page">
                        <button class="page-btn" :class="{ 'active': page === currentPage }" @click="goToPage(page)"
                            x-text="page">
                        </button>
                    </template>

                    <button class="page-btn" @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted">Show:</span>
                    <select class="form-select form-select-sm" style="width: auto;" x-model="perPage"
                        @change="currentPage = 1">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: 3000,
        };

        document.addEventListener('alpine:init', () => {
            Alpine.data('landingPageList', (initialData) => ({
                landingPages: initialData.landingPages,
                search: '',
                currentPage: 1,
                perPage: 5,
                newLink: {
                    type: '',
                    property: '',
                    expiration: ''
                },
                deactivateLinkId: null,
                deleteLinkId: null,

                init() {
                    this.initDatePicker();
                },

                get filteredPages() {
                    if (!this.search) return this.landingPages;
                    return this.landingPages.filter(page => {
                        const searchTerm = this.search.toLowerCase();
                        const typeDisplayName = page.type === 'promotion' ?
                            'promotion page' :
                            page.type === 'inspection' ? 'inspection form' : page.type;

                        return page.link.toLowerCase().includes(searchTerm) ||
                            (page.property?.name || '').toLowerCase().includes(
                            searchTerm) ||
                            page.type.toLowerCase().includes(searchTerm) ||
                            typeDisplayName.toLowerCase().includes(searchTerm);
                    });
                },

                get startIndex() {
                    return (this.currentPage - 1) * this.perPage;
                },

                get endIndex() {
                    return Math.min(this.startIndex + this.perPage, this.filteredPages.length);
                },

                get paginatedPages() {
                    return this.filteredPages.slice(this.startIndex, this.endIndex);
                },

                get totalPages() {
                    return Math.ceil(this.filteredPages.length / this.perPage);
                },

                get visiblePages() {
                    const totalPages = this.totalPages;
                    const currentPage = this.currentPage;
                    const delta = 2;
                    const range = [];
                    const rangeWithDots = [];

                    for (let i = Math.max(2, currentPage - delta); i <= Math.min(totalPages - 1,
                            currentPage + delta); i++) {
                        range.push(i);
                    }

                    if (currentPage - delta > 2) {
                        rangeWithDots.push(1, '...');
                    } else {
                        rangeWithDots.push(1);
                    }

                    rangeWithDots.push(...range);

                    if (currentPage + delta < totalPages - 1) {
                        rangeWithDots.push('...', totalPages);
                    } else if (totalPages > 1) {
                        rangeWithDots.push(totalPages);
                    }

                    return rangeWithDots.filter(page => page !== 1 || totalPages > 1);
                },

                // Pagination methods
                goToPage(page) {
                    if (page >= 1 && page <= this.totalPages) {
                        this.currentPage = page;
                    }
                },

                notify(msg, type = 'success') {
                    toastr[type](msg);
                },

                initDatePicker() {
                    flatpickr('.flatpickr', {
                        enableTime: true,
                        dateFormat: 'Y-m-d H:i',
                        minDate: 'today'
                    });
                },

                async copyLink(link) {
                    if (!navigator.clipboard) {
                        this.notify('Clipboard API not available. Please copy the link manually.',
                            'error');
                        return;
                    }
                    try {
                        await navigator.clipboard.writeText(link);
                        this.notify('Link copied to clipboard!');
                    } catch (err) {
                        this.notify('Failed to copy link. Please try again or copy manually.',
                            'error');
                        console.error('Failed to copy: ', err); // Log the error for debugging
                    }
                },

                async createLink() {
                    if (this.landingPages.some(p => p.property_id == this.newLink.property)) {
                        this.notify('You already have a landing page for this property.', 'error');
                        return;
                    }

                    try {
                        const response = await fetch('{{ route('landing-pages.create') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify(this.newLink),
                        });

                        const data = await response.json();

                        if (response.ok) {
                            this.landingPages.push(data.landingPage);
                            this.newLink = {
                                type: '',
                                property: '',
                                expiration: ''
                            };
                            this.notify(data.message || 'Landing page created!');
                            this.$nextTick(() => this.initDatePicker());
                        } else {
                            this.notify(data.message || 'Validation failed.', 'error');
                        }
                    } catch {
                        this.notify('Error creating landing page.', 'error');
                    }
                },

                async deactivateLink(id) {
                    if (!confirm('Are you sure you want to deactivate this landing page?')) {
                        return;
                    }

                    this.deactivateLinkId = id;
                    try {
                        const response = await fetch(`/realtor/landing-pages/deactivate/${id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                        });
                        const data = await response.json();

                        if (response.ok) {
                            this.notify(data.message || 'Link deactivated');
                            this.landingPages = this.landingPages.map(page =>
                                page.id === this.deactivateLinkId ? {
                                    ...page,
                                    is_active: 0
                                } : page
                            );
                        } else {
                            this.notify(data.message || 'Failed to deactivate link', 'error');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        this.notify('Error deactivating link.', 'error');
                    }
                },

                async activateLink(id) {
                    if (!confirm('Are you sure you want to activate this landing page?')) {
                        return;
                    }

                    try {
                        const response = await fetch(`/realtor/landing-pages/activate/${id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                        });
                        const data = await response.json();

                        if (response.ok) {
                            this.notify(data.message || 'Link activated');
                            this.landingPages = this.landingPages.map(page =>
                                page.id === id ? {
                                    ...page,
                                    is_active: 1
                                } : page
                            );
                        } else {
                            this.notify(data.message || 'Failed to activate link', 'error');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        this.notify('Error activating link.', 'error');
                    }
                },

                async deleteLink(id) {
                    if (!confirm(
                            'Are you sure you want to delete this landing page? This action cannot be undone.'
                        )) {
                        return;
                    }

                    this.deleteLinkId = id;
                    try {
                        const response = await fetch(`/realtor/landing-pages/delete/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                        });
                        const data = await response.json();

                        if (response.ok) {
                            this.landingPages = this.landingPages.filter(page => page.id !== this
                                .deleteLinkId);
                            this.notify(data.message || 'Link deleted');
                        } else {
                            this.notify(data.message || 'Failed to delete link', 'error');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        this.notify('Error deleting link.', 'error');
                    }
                }
            }));
        });
    </script>
@endpush
