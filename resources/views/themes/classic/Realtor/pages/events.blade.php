@extends('themes.classic.realtor.realtor_master')
@section('title', 'Events | Premium Refined Luxury Homes')
@section('content')

    <style>
        /* Table background and responsive font */
        .custom-table-container {
            border-radius: 10px;
            padding: 1.5rem;
        }

        .table thead th {
            background: #e5f5c7;
            color: #333;
            font-weight: 600;
            cursor: pointer;
            user-select: none;
            position: relative;
        }

        .table thead th:hover {
            background: #d4f0a5;
        }

        .table thead th.sortable::after {
            content: "↕";
            position: absolute;
            right: 8px;
            opacity: 0.5;
        }

        .table thead th.sort-asc::after {
            content: "↑";
            opacity: 1;
        }

        .table thead th.sort-desc::after {
            content: "↓";
            opacity: 1;
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

        .loading-spinner {
            border: 2px solid #f3f3f3;
            border-top: 2px solid #91d20a;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 2s linear infinite;
            display: inline-block;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .action-icon {
            cursor: pointer;
            transition: color 0.2s;
        }

        .action-icon:hover {
            color: #91d20a !important;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-left">
                        <h3>Events
                            <small>Welcome to realtor panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('tenant.realtor.dashboard') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Events</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="custom-table-container" x-data="eventManager()" x-init="init()" x-cloak>
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h5 class="mb-0 fw-semibold">Event Referrals Management</h5>
            <div class="d-flex gap-2 align-items-center">
                <div class="input-group" style="width: 250px;">
                    <input type="text" class="form-control form-control-sm" placeholder="Search events..."
                        x-model="searchTerm" @input="updateFilteredEvents()">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <button @click="refreshEvents()" class="btn btn-outline-success btn-sm">
                    <i class="fas fa-sync-alt" :class="{ 'fa-spin': isLoading }"></i> Refresh
                </button>
            </div>
        </div>
        <!-- Events Table with Alpine.js -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-sm align-middle mb-0 w-100" id="eventsTable"
                style="border-color: #91d20a;">
                <thead>
                    <tr>
                        <th class="text-uppercase small text-secondary fw-bold py-3 sortable" @click="sortBy('name')"
                            :class="getSortClass('name')">
                            Event
                        </th>
                        <th class="text-uppercase small text-secondary fw-bold py-3 sortable"
                            @click="sortBy('start_date_time')" :class="getSortClass('start_date_time')">
                            Start Date
                        </th>
                        <th class="text-uppercase small text-secondary fw-bold py-3 sortable"
                            @click="sortBy('end_date_time')" :class="getSortClass('end_date_time')">
                            End Date
                        </th>
                        <th class="text-uppercase small text-secondary fw-bold py-3 sortable" @click="sortBy('status')"
                            :class="getSortClass('status')">
                            Status
                        </th>
                        <th class="text-uppercase small text-secondary fw-bold py-3 sortable"
                            @click="sortBy('event_bookings_count')" :class="getSortClass('event_bookings_count')">
                            Referrals
                        </th>
                        <th class="text-uppercase small text-secondary fw-bold py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="event in paginatedEvents" :key="event.id">
                        <tr class="border-bottom"
                            x-show="!searchTerm || event.name.toLowerCase().includes(searchTerm.toLowerCase())">
                            <td class="text-muted" x-text="event.name"></td>
                            <td>
                                <div style="line-height: 1.2;" x-text="formatDate(event.start_date_time)"></div>
                            </td>
                            <td>
                                <div style="line-height: 1.2;" x-text="formatDate(event.end_date_time)"></div>
                            </td>
                            <td class="fw-semibold" :class="getStatusColor(event.status)" x-text="event.status">
                            </td>
                            <td class="fw-semibold d-flex align-items-center justify-content-between"
                                :class="getStatusColor(event.status)">
                                <span x-text="event.event_bookings_count"></span>
                                <div class="dropdown" x-show="event.event_bookings_count > 0">
                                    <i class="fas fa-chevron-down dropdown-toggle action-icon"
                                        @click="loadEventBookings(event.id)" data-bs-toggle="dropdown" aria-expanded="false"
                                        style="cursor: pointer;"></i>
                                    <ul class="dropdown-menu dropdown-menu-end"
                                        style="min-width: 200px; padding: 5px 0; background-color: #fff; border: 1px solid #91d20a; border-radius: 4px;">
                                        <template x-for="booking in selectedEventBookings" :key="booking.id">
                                            <li>
                                                <a class="dropdown-item" href="#"
                                                    style="padding: 8px 15px; color: #333;"
                                                    x-text="booking.first_name + ' ' + booking.last_name"></a>
                                            </li>
                                        </template>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-primary" href="#"
                                                @click="showReferralModal(event.id)" style="padding: 8px 15px;">
                                                <i class="fas fa-eye"></i> View All Details
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="dropdown" x-show="event.event_bookings_count === 0">
                                    <i class="fas fa-chevron-down dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false" style="cursor: pointer;"></i>
                                    <ul class="dropdown-menu dropdown-menu-end"
                                        style="min-width: 150px; padding: 5px 0; background-color: #fff; border: 1px solid #91d20a; border-radius: 4px;">
                                        <li><a class="dropdown-item" href="#"
                                                style="padding: 8px 15px; color: #333;">No referrals</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button @click="showStatsModal(event.id)" class="btn btn-outline-info btn-sm"
                                        title="View Stats">
                                        <i class="fas fa-chart-bar"></i>
                                    </button>
                                    <a :href="`/realtor/events/${event.id}/export`" class="btn btn-outline-success btn-sm"
                                        title="Export CSV" x-show="event.event_bookings_count > 0">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </template>

                    <!-- No Events Row -->
                    <tr x-show="filteredEvents.length === 0 && !isLoading">
                        <td colspan="6" class="text-center text-muted py-4">
                            <span x-show="!searchTerm">No events found</span>
                            <span x-show="searchTerm">No events match your search</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination Controls -->
        <div class="d-flex justify-content-between align-items-center mt-4" x-show="totalPages > 1">
            <div class="text-muted">
                Showing <span x-text="((currentPage - 1) * itemsPerPage) + 1"></span> to
                <span x-text="Math.min(currentPage * itemsPerPage, filteredEvents.length)"></span>
                of <span x-text="filteredEvents.length"></span> events
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
                <select class="form-select form-select-sm" style="width: auto;" x-model="itemsPerPage"
                    @change="currentPage = 1">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>

        <!-- Loading Overlay -->
        <div x-show="isLoading" class="text-center py-4">
            <div class="loading-spinner me-2"></div>
            <span>Loading...</span>
        </div>

        <!-- Referral Details Modal -->
        <!-- Referral Details Modal -->
        {{-- <div x-show="showReferralModalFlag" x-cloak
            class="modal-backdrop position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
            style="z-index: 1050;" @click.self="closeReferralModal()" @keydown.escape.window="closeReferralModal()">
            <div class="modal-dialog modal-lg" @click.stop>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Event Referrals</h5>
                        <button type="button" class="btn-close" @click="closeReferralModal()"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div x-show="modalLoading" class="text-center py-4">
                            <div class="loading-spinner me-2"></div>
                            <span>Loading referrals...</span>
                        </div>
                        <div x-show="!modalLoading && selectedEventBookings.length > 0">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Referral Code</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="booking in selectedEventBookings" :key="booking.id">
                                            <tr>
                                                <td x-text="booking.first_name + ' ' + booking.last_name"></td>
                                                <td x-text="booking.phone"></td>
                                                <td x-text="booking.email"></td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <code x-text="booking.referral_code"></code>
                                                        <button @click="copyReferralCode(booking.referral_code)"
                                                            class="btn btn-outline-secondary btn-sm p-1"
                                                            title="Copy to clipboard">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div x-show="!modalLoading && selectedEventBookings.length === 0">
                            <p class="text-muted text-center">No referrals found for this event.</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeReferralModal()">Close</button>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Stats Modal -->
        {{-- <div x-show="showStatsModalFlag" x-cloak
            class="modal-backdrop position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
            style="z-index: 1050;" @click.self="closeStatsModal()" @keydown.escape.window="closeStatsModal()">
            <div class="modal-dialog" @click.stop>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Event Statistics</h5>
                        <button type="button" class="btn-close" @click="closeStatsModal()" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div x-show="modalLoading" class="text-center py-4">
                            <div class="loading-spinner me-2"></div>
                            <span>Loading statistics...</span>
                        </div>
                        <div x-show="!modalLoading && eventStats">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h4 class="text-primary" x-text="eventStats.total_bookings"></h4>
                                            <p class="mb-0">Total Bookings</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h4 class="text-success" x-text="eventStats.referred_bookings"></h4>
                                            <p class="mb-0">Referred Bookings</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h4 class="text-info" x-text="eventStats.direct_bookings"></h4>
                                            <p class="mb-0">Direct Bookings</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h4 class="text-warning"
                                                x-text="eventStats.top_referrers ? eventStats.top_referrers.length : 0">
                                            </h4>
                                            <p class="mb-0">Active Referrers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div x-show="eventStats.top_referrers && eventStats.top_referrers.length > 0" class="mt-4">
                                <h6>Top Referrers</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Referrals</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="referrer in eventStats.top_referrers"
                                                :key="referrer.referral_code">
                                                <tr>
                                                    <td x-text="referrer.first_name + ' ' + referrer.last_name"></td>
                                                    <td>
                                                        <span class="badge bg-primary"
                                                            x-text="referrer.referral_count"></span>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeStatsModal()">Close</button>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <script>
        function eventManager() {
            return {
                // Loading states - Ensure these are explicitly false
                isLoading: false,
                modalLoading: false,
                showReferralModalFlag: false,
                showStatsModalFlag: false,

                // Data
                allEvents: @json($events ?? []),
                selectedEventBookings: [],
                eventStats: null,
                currentEventId: null,

                // Search and filter
                searchTerm: '',

                // Sorting
                sortField: 'start_date_time',
                sortDirection: 'desc',

                // Pagination
                currentPage: 1,
                itemsPerPage: 10,

                init() {
                    // Explicitly ensure modals are closed on init
                    this.showReferralModalFlag = false;
                    this.showStatsModalFlag = false;
                    this.modalLoading = false;

                    // Process events data on initialization
                    this.allEvents = this.allEvents.map(event => ({
                        ...event,
                        start_date_time: new Date(event.start_date_time),
                        end_date_time: new Date(event.end_date_time),
                        status: this.calculateEventStatus(event.start_date_time, event.end_date_time)
                    }));

                    // Add keyboard event listener for Escape key
                    document.addEventListener('keydown', (e) => {
                        if (e.key === 'Escape') {
                            this.closeAllModals();
                        }
                    });

                    // Ensure body scroll is reset on page load
                    document.body.style.overflow = '';
                },

                // Computed properties
                get filteredEvents() {
                    let filtered = this.allEvents;

                    // Apply search filter
                    if (this.searchTerm) {
                        filtered = filtered.filter(event =>
                            event.name.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                            event.location?.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                            event.status.toLowerCase().includes(this.searchTerm.toLowerCase())
                        );
                    }

                    // Apply sorting
                    filtered.sort((a, b) => {
                        let aVal = a[this.sortField];
                        let bVal = b[this.sortField];

                        // Handle different data types
                        if (aVal instanceof Date && bVal instanceof Date) {
                            aVal = aVal.getTime();
                            bVal = bVal.getTime();
                        } else if (typeof aVal === 'string' && typeof bVal === 'string') {
                            aVal = aVal.toLowerCase();
                            bVal = bVal.toLowerCase();
                        }

                        if (this.sortDirection === 'asc') {
                            return aVal < bVal ? -1 : aVal > bVal ? 1 : 0;
                        } else {
                            return aVal > bVal ? -1 : aVal < bVal ? 1 : 0;
                        }
                    });

                    return filtered;
                },

                get totalPages() {
                    return Math.ceil(this.filteredEvents.length / this.itemsPerPage);
                },

                get paginatedEvents() {
                    const start = (this.currentPage - 1) * this.itemsPerPage;
                    const end = start + this.itemsPerPage;
                    return this.filteredEvents.slice(start, end);
                },

                get visiblePages() {
                    const total = this.totalPages;
                    const current = this.currentPage;
                    const delta = 2;

                    let range = [];
                    let start = Math.max(1, current - delta);
                    let end = Math.min(total, current + delta);

                    for (let i = start; i <= end; i++) {
                        range.push(i);
                    }

                    return range;
                },

                // Helper methods
                calculateEventStatus(startDate, endDate) {
                    const now = new Date();
                    const start = new Date(startDate);
                    const end = new Date(endDate);

                    if (now < start) {
                        return 'Upcoming';
                    } else if (now >= start && now <= end) {
                        return 'Ongoing';
                    } else {
                        return 'Complete';
                    }
                },

                formatDate(dateString) {
                    const date = new Date(dateString);
                    return date.toLocaleDateString('en-US', {
                        month: 'short',
                        day: '2-digit',
                        year: 'numeric'
                    });
                },

                getStatusColor(status) {
                    switch (status) {
                        case 'Upcoming':
                            return 'text-warning';
                        case 'Ongoing':
                            return 'text-primary';
                        case 'Complete':
                            return 'text-success';
                        default:
                            return 'text-secondary';
                    }
                },

                // Sorting methods
                sortBy(field) {
                    if (this.sortField === field) {
                        this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
                    } else {
                        this.sortField = field;
                        this.sortDirection = 'asc';
                    }
                    this.currentPage = 1; // Reset to first page when sorting
                },

                getSortClass(field) {
                    if (this.sortField !== field) return 'sortable';
                    return this.sortDirection === 'asc' ? 'sortable sort-asc' : 'sortable sort-desc';
                },

                // Pagination methods
                goToPage(page) {
                    if (page >= 1 && page <= this.totalPages) {
                        this.currentPage = page;
                    }
                },

                // Search methods
                updateFilteredEvents() {
                    this.currentPage = 1; // Reset to first page when searching
                },

                // Modal and API methods
                async loadEventBookings(eventId) {
                    this.currentEventId = eventId;
                    try {
                        const response = await fetch(`/realtor/events/${eventId}/bookings`);
                        const data = await response.json();

                        if (data.success) {
                            this.selectedEventBookings = data.bookings;
                        } else {
                            this.showNotification('Failed to load bookings', 'error');
                        }
                    } catch (error) {
                        console.error('Error loading bookings:', error);
                        this.showNotification('Error loading bookings', 'error');
                    }
                },

                async showReferralModal(eventId) {
                    console.log('Opening referral modal for event:', eventId);

                    // Close any other modals first
                    this.closeStatsModal();

                    this.showReferralModalFlag = true;
                    this.modalLoading = true;
                    this.currentEventId = eventId;

                    // Prevent body scroll
                    document.body.style.overflow = 'hidden';

                    try {
                        const response = await fetch(`/realtor/events/${eventId}/bookings`);
                        const data = await response.json();

                        if (data.success) {
                            this.selectedEventBookings = data.bookings;
                        } else {
                            this.showNotification('Failed to load bookings', 'error');
                            this.closeReferralModal();
                        }
                    } catch (error) {
                        console.error('Error loading bookings:', error);
                        this.showNotification('Error loading bookings', 'error');
                        this.closeReferralModal();
                    } finally {
                        this.modalLoading = false;
                    }
                },

                async showStatsModal(eventId) {
                    console.log('Opening stats modal for event:', eventId);

                    // Close any other modals first
                    this.closeReferralModal();

                    this.showStatsModalFlag = true;
                    this.modalLoading = true;
                    this.currentEventId = eventId;

                    // Prevent body scroll
                    document.body.style.overflow = 'hidden';

                    try {
                        const response = await fetch(`/realtor/events/${eventId}/stats`);
                        const data = await response.json();

                        if (data.success) {
                            this.eventStats = data.stats;
                        } else {
                            this.showNotification('Failed to load statistics', 'error');
                            this.closeStatsModal();
                        }
                    } catch (error) {
                        console.error('Error loading stats:', error);
                        this.showNotification('Error loading statistics', 'error');
                        this.closeStatsModal();
                    } finally {
                        this.modalLoading = false;
                    }
                },

                closeReferralModal() {
                    this.showReferralModalFlag = false;
                    this.selectedEventBookings = [];
                    this.modalLoading = false;
                    this.currentEventId = null;

                    // Restore body scroll if no other modals are open
                    if (!this.showStatsModalFlag) {
                        document.body.style.overflow = '';
                    }

                    // Force DOM update to ensure modal is hidden
                    this.$nextTick(() => {
                        this.showReferralModalFlag = false;
                    });
                },

                closeStatsModal() {
                    this.showStatsModalFlag = false;
                    this.eventStats = null;
                    this.modalLoading = false;
                    this.currentEventId = null;

                    // Restore body scroll if no other modals are open
                    if (!this.showReferralModalFlag) {
                        document.body.style.overflow = '';
                    }

                    // Force DOM update to ensure modal is hidden
                    this.$nextTick(() => {
                        this.showStatsModalFlag = false;
                    });
                },

                closeAllModals() {
                    this.showReferralModalFlag = false;
                    this.showStatsModalFlag = false;
                    this.selectedEventBookings = [];
                    this.eventStats = null;
                    this.modalLoading = false;
                    this.currentEventId = null;

                    // Restore body scroll
                    document.body.style.overflow = '';

                    // Force DOM update to ensure all modals are hidden
                    this.$nextTick(() => {
                        this.showReferralModalFlag = false;
                        this.showStatsModalFlag = false;
                    });
                },

                async refreshEvents() {
                    this.isLoading = true;
                    try {
                        // Add a small delay to show the loading state
                        setTimeout(() => {
                            window.location.reload();
                        }, 500);
                    } catch (error) {
                        console.error('Error refreshing events:', error);
                        this.showNotification('Error refreshing events', 'error');
                    }
                },

                copyReferralCode(code) {
                    navigator.clipboard.writeText(code).then(() => {
                        this.showNotification('Referral code copied to clipboard!', 'success');
                    }).catch(() => {
                        this.showNotification('Failed to copy referral code', 'error');
                    });
                },

                showNotification(message, type = 'info') {
                    // Create a simple notification
                    const notification = document.createElement('div');
                    notification.className =
                        `alert alert-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'info'} position-fixed`;
                    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
                    notification.textContent = message;

                    document.body.appendChild(notification);

                    setTimeout(() => {
                        notification.remove();
                    }, 3000);
                }
            }
        }

        // Initialize on page load and add global modal safety check
        document.addEventListener('DOMContentLoaded', function() {
            // Ensure body scroll is reset
            document.body.style.overflow = '';

            // Global escape key handler as a backup
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    // Force close any visible modals
                    const modals = document.querySelectorAll('[x-show*="Modal"]');
                    modals.forEach(modal => {
                        if (modal.style.display !== 'none' && !modal.hasAttribute('x-cloak')) {
                            // Find and trigger the Alpine.js close method
                            const alpineData = modal.closest('[x-data]');
                            if (alpineData && alpineData._x_dataStack && alpineData._x_dataStack[
                                    0]) {
                                const data = alpineData._x_dataStack[0];
                                if (data.closeAllModals) {
                                    data.closeAllModals();
                                }
                            }
                        }
                    });
                }
            });
        });
    </script>

@endsection
