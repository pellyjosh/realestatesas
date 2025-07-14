@extends('themes.classic.realtor.realtor_master')
@section('title', 'Landing Page List')

@push('styles')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
                            <option value="listing">Listing</option>
                            <option value="promo">Promotional</option>
                            <option value="referral">Referral</option>
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
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <input type="text" x-model="search" class="form-control w-25" placeholder="Search by link or property...">
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle w-100" style="border-color: #91d20a;">
                <thead>
                    <tr>
                        <th>Link</th>
                        <th>Property</th>
                        <th>Action</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr x-show="!filteredPages.length">
                        <td colspan="3" class="text-center text-muted">No landing pages found</td>
                    </tr>
                    <template x-for="page in paginatedPages" :key="page.id">
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <a :href="page.link" x-text="page.link" class="text-nowrap" target="_blank"></a>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"
                                        x-on:click="copyLink(page.link)" title="Copy to clipboard">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </td>
                            <td x-text="page.property.name || 'N/A'"></td>
                            <td>
                                <span x-text="page.is_active ? 'Active' : 'Inactive'"
                                    :class="{
                                        'bg-green-100 text-green-800': page.is_active,
                                        'bg-red-100 text-red-800': !page
                                            .is_active
                                    }"
                                    class="px-2 py-1 rounded-full text-sm"></span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btn-sm" x-on:click="deactivateLink(page.id)">
                                        <i class="fas fa-stop"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" x-on:click="deleteLink(page.id)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <a :href="page.link" target="_blank" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    </template>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3" x-show="filteredPages.length > perPage">
                <div>
                    Showing <span x-text="startIndex + 1"></span> to <span x-text="endIndex"></span> of <span
                        x-text="filteredPages.length"></span>
                </div>
                <div>
                    <button class="btn btn-sm btn-outline-primary me-2" :disabled="currentPage === 1"
                        @click="currentPage--">Previous</button>
                    <button class="btn btn-sm btn-outline-primary" :disabled="endIndex >= filteredPages.length"
                        @click="currentPage++">Next</button>
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
                    return this.landingPages.filter(page =>
                        page.link.toLowerCase().includes(this.search.toLowerCase()) ||
                        (page.property?.name || '').toLowerCase().includes(this.search
                            .toLowerCase())
                    );
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
                    try {
                        const response = await fetch(
                            '{{ route('landing-pages.deactivate', ':id') }}'.replace(':id',
                                this.deactivateLinkId), {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                            });
                        const data = await response.json();
                        this.notify(data.message || 'Link deactivated');
                        this.landingPages = this.landingPages.map(page =>
                            page.id === this.deactivateLinkId ? {
                                ...page,
                                is_active: 0
                            } : page
                        );
                    } catch {
                        this.notify('Error deactivating link.', 'error');
                    }
                },

                async deleteLink(id) {
                    try {
                        const response = await fetch(
                            '{{ route('landing-pages.delete', ':id') }}'.replace(':id', this
                                .deleteLinkId), {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                            });
                        const data = await response.json();
                        this.landingPages = this.landingPages.filter(page => page.id !== this
                            .deleteLinkId);
                        this.notify(data.message || 'Link deleted');
                    } catch {
                        this.notify('Error deleting link.', 'error');
                    }
                }
            }));
        });
    </script>
@endpush
