@extends('themes.classic.admin.admin_master')
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

        .loading {
            opacity: 0.6;
            pointer-events: none;
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
    </style>

    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-left">
                        <h3>Events
                            <small>Welcome to admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('tenant.admin.dashboard') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Events</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Single x-data container for the entire events section -->
    <div class="custom-table-container" x-data="eventsData()">

        <!-- Add/Edit Event Form - MOVED TO TOP -->
        <div x-show="showForm" x-transition class="mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0" x-text="editMode ? 'Edit Event' : 'Add New Event'"></h6>
                    <button @click="closeForm()" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submitForm()" class="row g-3" :class="{ 'loading': isLoading }">
                        <div class="col-md-6">
                            <label class="form-label">Event Name *</label>
                            <input type="text" class="form-control" x-model="formData.name" required>
                            <div x-show="errors.name" class="text-danger mt-1" x-text="errors.name"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" x-model="formData.location">
                            <div x-show="errors.location" class="text-danger mt-1" x-text="errors.location"></div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description *</label>
                            <textarea class="form-control" rows="3" x-model="formData.description" required></textarea>
                            <div x-show="errors.description" class="text-danger mt-1" x-text="errors.description">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Start Date *</label>
                            <input type="datetime-local" class="form-control" x-model="formData.start_date_time" required
                                :min="getCurrentDateTime()">
                            <div x-show="errors.start_date_time" class="text-danger mt-1" x-text="errors.start_date_time">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">End Date *</label>
                            <input type="datetime-local" class="form-control" x-model="formData.end_date_time" required
                                :min="formData.start_date_time || getCurrentDateTime()">
                            <div x-show="errors.end_date_time" class="text-danger mt-1" x-text="errors.end_date_time"></div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success me-2" :disabled="isLoading">
                                <i class="fas fa-save" :class="{ 'fa-spinner fa-spin': isLoading }"></i>
                                <span
                                    x-text="isLoading ? 'Saving...' : (editMode ? 'Update Event' : 'Create Event')"></span>
                            </button>
                            <button type="button" @click="closeForm()" class="btn btn-secondary" :disabled="isLoading">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Events List Header and Controls -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h5 class="mb-0 fw-semibold">Events List</h5>
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <div class="date-filter d-flex align-items-center gap-2">
                    <input type="date" class="form-control" placeholder="Start Date">
                    <span>to</span>
                    <input type="date" class="form-control" placeholder="End Date">
                </div>
                <button @click="showForm = !showForm" class="btn btn-sm" style="background-color: #91d20a; color: #fff;">
                    <i class="fas fa-plus"></i>
                    <span x-text="showForm ? 'Close Form' : 'Add Event'"></span>
                </button>
            </div>
        </div>

        <p>Total events: <span x-text="events.length"></span></p>
        <table class="table table-striped table-bordered text-sm align-middle mb-0 w-100" style="border-color: #91d20a;">
            <thead>
                <tr>
                    <th class="text-uppercase small text-secondary fw-bold py-3">#</th>
                    <th class="text-uppercase small text-secondary fw-bold py-3">Name</th>
                    <th class="text-uppercase small text-secondary fw-bold py-3">Description</th>
                    <th class="text-uppercase small text-secondary fw-bold py-3">Start Date</th>
                    <th class="text-uppercase small text-secondary fw-bold py-3">End Date</th>
                    <th class="text-uppercase small text-secondary fw-bold py-3">Location</th>
                    <th class="text-uppercase small text-secondary fw-bold py-3">Status</th>
                    <th class="text-uppercase small text-secondary fw-bold py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(event, index) in events" :key="event.id">
                    <tr class="border-bottom">
                        <td x-text="index + 1"></td>
                        <td x-text="event.name" class="text-muted"></td>
                        <td x-text="event.description" class="text-muted"></td>
                        <td>
                            <div style="line-height: 1.2;" x-text="formatDate(event.start_date_time)"></div>
                        </td>
                        <td>
                            <div style="line-height: 1.2;" x-text="formatDate(event.end_date_time)"></div>
                        </td>
                        <td>
                            <div style="line-height: 1.2;" x-text="event.location"></div>
                        </td>
                        <td>
                            <span class="badge" :class="getEventStatusClass(event)"
                                x-text="getEventStatus(event)"></span>
                        </td>
                        <td>
                            <div class="action-btns">
                                <button @click="editEvent(event)" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button @click="deleteEvent(event.id)" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <script>
        function eventsData() {
            return {
                showForm: false,
                editMode: false,
                isLoading: false,
                errors: {},
                events: @json($events ?? []),
                formData: {
                    id: null,
                    name: '',
                    description: '',
                    location: '',
                    start_date_time: '',
                    end_date_time: ''
                },

                // Format date to "July 12, 2025" format
                formatDate(dateString) {
                    if (!dateString) return '';

                    const date = new Date(dateString);

                    // Check if date is valid
                    if (isNaN(date.getTime())) return dateString;

                    const options = {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    };

                    return date.toLocaleDateString('en-US', options);
                },

                // Get event status based on current date vs start/end dates
                getEventStatus(event) {
                    if (!event.start_date_time || !event.end_date_time) return 'Unknown';

                    const now = new Date();
                    const startDate = new Date(event.start_date_time);
                    const endDate = new Date(event.end_date_time);

                    // Check if dates are valid
                    if (isNaN(startDate.getTime()) || isNaN(endDate.getTime())) return 'Unknown';

                    if (now < startDate) {
                        return 'Upcoming';
                    } else if (now >= startDate && now <= endDate) {
                        return 'Ongoing';
                    } else {
                        return 'Completed';
                    }
                },

                // Get CSS class for event status badge
                getEventStatusClass(event) {
                    const status = this.getEventStatus(event);
                    switch (status) {
                        case 'Upcoming':
                            return 'bg-primary';
                        case 'Ongoing':
                            return 'bg-success';
                        case 'Completed':
                            return 'bg-secondary';
                        default:
                            return 'bg-warning';
                    }
                },

                // Get current date and time in YYYY-MM-DDTHH:MM format for min attribute
                getCurrentDateTime() {
                    const now = new Date();
                    const year = now.getFullYear();
                    const month = String(now.getMonth() + 1).padStart(2, '0');
                    const day = String(now.getDate()).padStart(2, '0');
                    const hours = String(now.getHours()).padStart(2, '0');
                    const minutes = String(now.getMinutes()).padStart(2, '0');

                    return `${year}-${month}-${day}T${hours}:${minutes}`;
                },

                // Validate event dates
                validateEventDates() {
                    const errors = {};
                    const now = new Date();

                    if (this.formData.start_date_time) {
                        const startDate = new Date(this.formData.start_date_time);
                        if (startDate <= now) {
                            errors.start_date_time = 'Start date must be in the future';
                        }
                    }

                    if (this.formData.end_date_time) {
                        const endDate = new Date(this.formData.end_date_time);
                        if (endDate <= now) {
                            errors.end_date_time = 'End date must be in the future';
                        }

                        if (this.formData.start_date_time) {
                            const startDate = new Date(this.formData.start_date_time);
                            if (endDate <= startDate) {
                                errors.end_date_time = 'End date must be after start date';
                            }
                        }
                    }

                    return errors;
                },

                // Toggle form visibility
                toggleForm() {
                    this.showForm = !this.showForm;
                    if (!this.showForm) {
                        this.resetForm();
                    }
                },

                // Close form and reset
                closeForm() {
                    this.showForm = false;
                    this.resetForm();
                },

                // Reset form data
                resetForm() {
                    this.editMode = false;
                    this.errors = {};
                    this.formData = {
                        id: null,
                        name: '',
                        description: '',
                        location: '',
                        start_date_time: '',
                        end_date_time: ''
                    };
                },

                // Edit event
                editEvent(event) {
                    this.editMode = true;
                    this.errors = {};
                    this.formData = {
                        ...event,
                        start_date_time: this.formatDateTimeForInput(event.start_date_time),
                        end_date_time: this.formatDateTimeForInput(event.end_date_time)
                    };
                    this.showForm = true;
                },

                // Format datetime for input field (converts to YYYY-MM-DDTHH:MM format)
                formatDateTimeForInput(dateString) {
                    if (!dateString) return '';

                    const date = new Date(dateString);

                    // Check if date is valid
                    if (isNaN(date.getTime())) return '';

                    // Format to YYYY-MM-DDTHH:MM (required by datetime-local input)
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const day = String(date.getDate()).padStart(2, '0');
                    const hours = String(date.getHours()).padStart(2, '0');
                    const minutes = String(date.getMinutes()).padStart(2, '0');

                    return `${year}-${month}-${day}T${hours}:${minutes}`;
                },

                // Submit form to Laravel backend
                async submitForm() {
                    this.isLoading = true;
                    this.errors = {};

                    // Validate dates first
                    const dateErrors = this.validateEventDates();
                    if (Object.keys(dateErrors).length > 0) {
                        this.errors = dateErrors;
                        this.isLoading = false;
                        return;
                    }

                    try {
                        const url = this.editMode ?
                            `/management/events/${this.formData.id}` :
                            '/management/events';

                        const method = this.editMode ? 'PUT' : 'POST';

                        const response = await fetch(url, {
                            method: method,
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify(this.formData)
                        });

                        const result = await response.json();

                        if (response.ok) {
                            if (this.editMode) {
                                // Update existing event in the list
                                const index = this.events.findIndex(e => e.id === this.formData.id);
                                if (index !== -1) {
                                    this.events[index] = result.event;
                                }
                            } else {
                                // Add new event to the TOP of the list
                                this.events.unshift(result.event);
                            }

                            this.closeForm();

                            // Show success message (using browser alert for now)
                            alert(result.message || 'Event saved successfully!');
                        } else {
                            // Handle validation errors
                            if (result.errors) {
                                this.errors = result.errors;
                            } else {
                                alert(result.message || 'Error saving event. Please try again.');
                            }
                        }
                    } catch (error) {
                        console.error('Network error:', error);
                        alert('Network error. Please check your connection and try again.');
                    } finally {
                        this.isLoading = false;
                    }
                },

                // Delete event
                async deleteEvent(eventId) {
                    if (confirm('Are you sure you want to delete this event?')) {
                        try {
                            const response = await fetch(`/management/events/${eventId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),
                                    'Accept': 'application/json',
                                }
                            });

                            const result = await response.json();

                            if (response.ok) {
                                // Remove event from the list
                                this.events = this.events.filter(e => e.id !== eventId);
                                alert(result.message || 'Event deleted successfully!');
                            } else {
                                alert(result.message || 'Error deleting event. Please try again.');
                            }
                        } catch (error) {
                            console.error('Network error:', error);
                            alert('Network error. Please check your connection and try again.');
                        }
                    }
                }
            }
        }
    </script>
@endsection
