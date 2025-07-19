@extends('themes.classic.admin.admin_master')
@section('title', 'Leads | Premium Refined Luxury Homes')
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

        /* Custom style for status badges */
        .status-badge {
            font-size: 0.95rem; /* Make font bigger */
            padding: 0.4em 0.8em; /* Increase padding */
            border-radius: 0.5rem; /* Slightly more rounded corners */
            font-weight: bold;
            color: #fff; /* Ensure white text for visibility on colored backgrounds */
        }
        .status-badge.badge-success {
            background-color: #28a745; /* Standard Bootstrap success green */
        }
        .status-badge.badge-warning {
            background-color: #ffc107; /* Standard Bootstrap warning yellow */
            color: #212529; /* Dark text for yellow background */
        }
        .status-badge.badge-danger {
            background-color: #dc3545; /* Standard Bootstrap danger red */
        }
        .status-badge.badge-info {
            background-color: #17a2b8; /* Standard Bootstrap info blue */
        }
        .status-badge.badge-secondary {
            background-color: #6c757d; /* Standard Bootstrap secondary grey */
        }
        .status-badge.badge-primary {
            background-color: #007bff;
        }
        .status-badge.badge-dark {
            background-color: #343a40;
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

    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Leads Management</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Marketing Tools</li>
                                <li class="breadcrumb-item active" aria-current="page">Leads</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Manage Leads</h4>
                        </div>
                        <div class="box-body">
                            <!-- Single x-data container for the entire leads section -->
                            <div class="custom-table-container" x-data="leadsData()">

                                <!-- Add/Edit Lead Form -->
                                <div x-show="showForm" x-transition class="mb-4">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0" x-text="editMode ? 'Edit Lead' : 'Add New Lead'"></h6>
                                            <button @click="closeForm()" class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <form @submit.prevent="submitForm()" class="row g-3" :class="{ 'loading': isLoading }">
                                                <div class="col-md-6">
                                                    <label class="form-label">Name *</label>
                                                    <input type="text" class="form-control" x-model="formData.name" required>
                                                    <div x-show="errors.name" class="text-danger mt-1" x-text="errors.name"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Email *</label>
                                                    <input type="email" class="form-control" x-model="formData.email" required>
                                                    <div x-show="errors.email" class="text-danger mt-1" x-text="errors.email"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Phone</label>
                                                    <input type="text" class="form-control" x-model="formData.phone">
                                                    <div x-show="errors.phone" class="text-danger mt-1" x-text="errors.phone"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Source</label>
                                                    <input type="text" class="form-control" x-model="formData.source" placeholder="e.g., Website, Referral, Ad">
                                                    <div x-show="errors.source" class="text-danger mt-1" x-text="errors.source"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Status *</label>
                                                    <select class="form-control" x-model="formData.status" required>
                                                        <option value="New">New</option>
                                                        <option value="Contacted">Contacted</option>
                                                        <option value="Qualified">Qualified</option>
                                                        <option value="Unqualified">Unqualified</option>
                                                        <option value="Converted">Converted</option>
                                                    </select>
                                                    <div x-show="errors.status" class="text-danger mt-1" x-text="errors.status"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Assigned To</label>
                                                    <input type="text" class="form-control" x-model="formData.assigned_to" placeholder="e.g., John Doe">
                                                    <div x-show="errors.assigned_to" class="text-danger mt-1" x-text="errors.assigned_to"></div>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Notes</label>
                                                    <textarea class="form-control" rows="3" x-model="formData.notes"></textarea>
                                                    <div x-show="errors.notes" class="text-danger mt-1" x-text="errors.notes"></div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-success me-2" :disabled="isLoading">
                                                        <i class="fas fa-save" :class="{ 'fa-spinner fa-spin': isLoading }"></i>
                                                        <span
                                                            x-text="isLoading ? 'Saving...' : (editMode ? 'Update Lead' : 'Create Lead')"></span>
                                                    </button>
                                                    <button type="button" @click="closeForm()" class="btn btn-secondary" :disabled="isLoading">
                                                        <i class="fas fa-times"></i> Cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Leads List Header and Controls -->
                                <div class="d-flex justify-content-end mb-4">
                                    <button @click="showForm = !showForm" class="btn btn-rounded btn-success">
                                        <i class="fas fa-plus"></i>
                                        <span x-text="showForm ? 'Close Form' : 'Add New Lead'"></span>
                                    </button>
                                </div>

                                <p>Total leads: <span x-text="leads.length"></span></p>
                                <div class="table-responsive">
                                    <table id="leads_table" class="table table-bordered table-striped text-sm align-middle mb-0 w-100" style="border-color: #91d20a;">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase small text-secondary fw-bold py-3">Name</th>
                                                <th class="text-uppercase small text-secondary fw-bold py-3">Email</th>
                                                <th class="text-uppercase small text-secondary fw-bold py-3">Phone</th>
                                                <th class="text-uppercase small text-secondary fw-bold py-3">Source</th>
                                                <th class="text-uppercase small text-secondary fw-bold py-3">Status</th>
                                                <th class="text-uppercase small text-secondary fw-bold py-3">Date</th>
                                                <th class="text-uppercase small text-secondary fw-bold py-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="(lead, index) in leads" :key="lead.id">
                                                <tr>
                                                    <td x-text="lead.name"></td>
                                                    <td x-text="lead.email"></td>
                                                    <td x-text="lead.phone"></td>
                                                    <td x-text="lead.source"></td>
                                                    <td><span class="badge status-badge" :class="getLeadStatusClass(lead.status)" x-text="lead.status"></span></td>
                                                    <td x-text="formatDate(lead.created_at)"></td>
                                                    <td>
                                                        <div class="action-btns">
                                                            <button @click="editLead(lead)" class="btn btn-info btn-sm">Edit</button>
                                                            <button @click="changeLeadStatus(lead)" class="btn btn-warning btn-sm">Change Status</button>
                                                            <button @click="deleteLead(lead.id)" class="btn btn-danger btn-sm">Delete</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function leadsData() {
            return {
                showForm: false,
                editMode: false,
                isLoading: false,
                errors: {},
                leads: [
                    // Dummy data for demonstration. In a real app, this would be fetched from the backend.
                    { id: 1, name: 'Alice Smith', email: 'alice.s@example.com', phone: '111-222-3333', source: 'Website', status: 'New', assigned_to: 'Agent A', notes: 'Interested in 3-bedroom houses.', created_at: '2025-07-15T10:00:00Z' },
                    { id: 2, name: 'Bob Johnson', email: 'bob.j@example.com', phone: '444-555-6666', source: 'Referral', status: 'Contacted', assigned_to: 'Agent B', notes: 'Looking for commercial property.', created_at: '2025-07-14T14:30:00Z' },
                    { id: 3, name: 'Charlie Brown', email: 'charlie.b@example.com', phone: '777-888-9999', source: 'Facebook Ad', status: 'Qualified', assigned_to: 'Agent A', notes: 'Pre-approved for mortgage.', created_at: '2025-07-12T09:15:00Z' },
                    { id: 4, name: 'Diana Prince', email: 'diana.p@example.com', phone: '000-111-2222', source: 'Website', status: 'Unqualified', assigned_to: 'Agent C', notes: 'Budget too low for current listings.', created_at: '2025-07-10T11:45:00Z' },
                    { id: 5, name: 'Eve Adams', email: 'eve.a@example.com', phone: '333-444-5555', source: 'Google Ad', status: 'Converted', assigned_to: 'Agent B', notes: 'Closed deal on 2-bedroom condo.', created_at: '2025-07-08T16:00:00Z' }
                ],
                formData: {
                    id: null,
                    name: '',
                    email: '',
                    phone: '',
                    source: '',
                    status: 'New', // Default value
                    assigned_to: '',
                    notes: '',
                    created_at: ''
                },

                // Format date to "July 12, 2025" format
                formatDate(dateString) {
                    if (!dateString) return '';
                    const date = new Date(dateString);
                    if (isNaN(date.getTime())) return dateString;
                    const options = { year: 'numeric', month: 'long', day: 'numeric' };
                    return date.toLocaleDateString('en-US', options);
                },

                // Get CSS class for lead status badge
                getLeadStatusClass(status) {
                    switch (status) {
                        case 'New': return 'badge-primary';
                        case 'Contacted': return 'badge-info';
                        case 'Qualified': return 'badge-success';
                        case 'Unqualified': return 'badge-danger';
                        case 'Converted': return 'badge-dark';
                        default: return 'badge-secondary';
                    }
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
                        email: '',
                        phone: '',
                        source: '',
                        status: 'New',
                        assigned_to: '',
                        notes: '',
                        created_at: ''
                    };
                },

                // Edit lead
                editLead(lead) {
                    this.editMode = true;
                    this.errors = {};
                    this.formData = { ...lead }; // Copy lead data to form
                    this.showForm = true;
                },

                // Submit form to backend (placeholder for actual API call)
                async submitForm() {
                    this.isLoading = true;
                    this.errors = {};

                    // Basic validation
                    if (!this.formData.name) this.errors.name = 'Name is required.';
                    if (!this.formData.email) this.errors.email = 'Email is required.';
                    if (!this.formData.status) this.errors.status = 'Status is required.';

                    if (Object.keys(this.errors).length > 0) {
                        this.isLoading = false;
                        return;
                    }

                    try {
                        // Simulate API call
                        await new Promise(resolve => setTimeout(resolve, 500)); // Simulate network delay

                        if (this.editMode) {
                            // Update existing lead in the list
                            const index = this.leads.findIndex(l => l.id === this.formData.id);
                            if (index !== -1) {
                                this.leads[index] = { ...this.formData }; // Update with new data
                            }
                            alert('Lead updated successfully!');
                        } else {
                            // Add new lead to the TOP of the list
                            const newId = this.leads.length > 0 ? Math.max(...this.leads.map(l => l.id)) + 1 : 1;
                            this.leads.unshift({ ...this.formData, id: newId, created_at: new Date().toISOString() });
                            alert('Lead added successfully!');
                        }

                        this.closeForm();

                    } catch (error) {
                        console.error('Error saving lead:', error);
                        alert('Error saving lead. Please try again.');
                    } finally {
                        this.isLoading = false;
                    }
                },

                // Change lead status (example of a specific action)
                async changeLeadStatus(lead) {
                    const newStatus = prompt(`Change status for ${lead.name} (Current: ${lead.status}). Enter new status (New, Contacted, Qualified, Unqualified, Converted):`);
                    if (newStatus && ['New', 'Contacted', 'Qualified', 'Unqualified', 'Converted'].includes(newStatus)) {
                        if (confirm(`Are you sure you want to change status to "${newStatus}" for ${lead.name}?`)) {
                            try {
                                // Simulate API call to update status
                                await new Promise(resolve => setTimeout(resolve, 300));

                                const index = this.leads.findIndex(l => l.id === lead.id);
                                if (index !== -1) {
                                    this.leads[index].status = newStatus;
                                    alert(`Lead status updated to "${newStatus}" successfully!`);
                                }
                            } catch (error) {
                                console.error('Error changing lead status:', error);
                                alert('Error changing lead status. Please try again.');
                            }
                        }
                    } else if (newStatus !== null) {
                        alert('Invalid status. Please choose from: New, Contacted, Qualified, Unqualified, Converted.');
                    }
                },

                // Delete lead
                async deleteLead(leadId) {
                    if (confirm('Are you sure you want to delete this lead?')) {
                        try {
                            // Simulate API call to delete
                            await new Promise(resolve => setTimeout(resolve, 300));

                            this.leads = this.leads.filter(l => l.id !== leadId);
                            alert('Lead deleted successfully!');
                        } catch (error) {
                            console.error('Error deleting lead:', error);
                            alert('Error deleting lead. Please try again.');
                        }
                    }
                }
            }
        }
    </script>
@endsection
