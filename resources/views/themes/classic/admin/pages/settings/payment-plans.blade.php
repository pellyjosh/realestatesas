@extends('themes.classic.admin.admin_master')
@section('title', 'Payment Plans | Premium Refined Luxury Homes')
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

  

    <!-- Single x-data container for the entire payment plans section -->
    <div class="custom-table-container" x-data="paymentPlansData()">

        <!-- Add/Edit Payment Plan Form - MOVED TO TOP -->
        <div x-show="showForm" x-transition class="mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0" x-text="editMode ? 'Edit Payment Plan' : 'Add New Payment Plan'"></h6>
                    <button @click="closeForm()" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submitForm()" class="row g-3" :class="{ 'loading': isLoading }">
                        <div class="col-md-6">
                            <label class="form-label">Plan Name *</label>
                            <input type="text" class="form-control" x-model="formData.name" required>
                            <div x-show="errors.name" class="text-danger mt-1" x-text="errors.name"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Price *</label>
                            <input type="text" class="form-control" x-model="formData.price" required>
                            <div x-show="errors.price" class="text-danger mt-1" x-text="errors.price"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Duration *</label>
                            <select class="form-control" x-model="formData.duration" required>
                                <option value="Monthly">Monthly</option>
                                <option value="Quarterly">Quarterly</option>
                                <option value="Annually">Annually</option>
                                <option value="Custom">Custom</option>
                            </select>
                            <div x-show="errors.duration" class="text-danger mt-1" x-text="errors.duration"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status *</label>
                            <select class="form-control" x-model="formData.status" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            <div x-show="errors.status" class="text-danger mt-1" x-text="errors.status"></div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Features (comma separated) *</label>
                            <textarea class="form-control" rows="3" x-model="formData.features" required></textarea>
                            <div x-show="errors.features" class="text-danger mt-1" x-text="errors.features"></div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success me-2" :disabled="isLoading">
                                <i class="fas fa-save" :class="{ 'fa-spinner fa-spin': isLoading }"></i>
                                <span
                                    x-text="isLoading ? 'Saving...' : (editMode ? 'Update Plan' : 'Create Plan')"></span>
                            </button>
                            <button type="button" @click="closeForm()" class="btn btn-secondary" :disabled="isLoading">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Payment Plans List Header and Controls -->
        <div class="d-flex justify-content-end mb-4">
            <button @click="showForm = !showForm" class="btn btn-rounded btn-success">
                <i class="fas fa-plus"></i>
                <span x-text="showForm ? 'Close Form' : 'Add New Plan'"></span>
            </button>
        </div>

        <p>Total plans: <span x-text="paymentPlans.length"></span></p>
        <table id="payment_plans_table" class="table table-bordered table-striped text-sm align-middle mb-0 w-100" style="border-color: #91d20a;">
            <thead>
                <tr>
                    <th class="text-uppercase small text-secondary fw-bold py-3">Plan Name</th>
                    <th class="text-uppercase small text-secondary fw-bold py-3">Price</th>
                    <th class="text-uppercase small text-secondary fw-bold py-3">Duration</th>
                    <th class="text-uppercase small text-secondary fw-bold py-3">Features</th>
                    <th class="text-uppercase small text-secondary fw-bold py-3">Status</th>
                    <th class="text-uppercase small text-secondary fw-bold py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(plan, index) in paymentPlans" :key="plan.id">
                    <tr>
                        <td x-text="plan.name"></td>
                        <td x-text="plan.price"></td>
                        <td x-text="plan.duration"></td>
                        <td x-text="plan.features"></td>
                        <td><span class="badge status-badge" :class="plan.status === 'Active' ? 'badge-success' : 'badge-warning'" x-text="plan.status"></span></td>
                        <td>
                            <div class="action-btns">
                                <button @click="editPlan(plan)" class="btn btn-info btn-sm">Edit</button>
                                <button @click="togglePlanStatus(plan)" class="btn btn-warning btn-sm" x-text="plan.status === 'Active' ? 'Deactivate' : 'Activate'"></button>
                                <button @click="deletePlan(plan.id)" class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <script>
        function paymentPlansData() {
            return {
                showForm: false,
                editMode: false,
                isLoading: false,
                errors: {},
                paymentPlans: [
                    // Dummy data for demonstration. In a real app, this would be fetched from the backend.
                    { id: 1, name: 'Basic Plan', price: '$99/month', duration: 'Monthly', features: '5 Listings, Basic Support', status: 'Active' },
                    { id: 2, name: 'Premium Plan', price: '$299/month', duration: 'Monthly', features: 'Unlimited Listings, Priority Support, CRM Access', status: 'Active' },
                    { id: 3, name: 'Enterprise Plan', price: 'Contact Us', duration: 'Custom', features: 'Custom Features, Dedicated Account Manager', status: 'Inactive' }
                ],
                formData: {
                    id: null,
                    name: '',
                    price: '',
                    duration: 'Monthly', // Default value
                    features: '',
                    status: 'Active' // Default value
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
                        price: '',
                        duration: 'Monthly',
                        features: '',
                        status: 'Active'
                    };
                },

                // Edit plan
                editPlan(plan) {
                    this.editMode = true;
                    this.errors = {};
                    this.formData = { ...plan }; // Copy plan data to form
                    this.showForm = true;
                },

                // Submit form to backend (placeholder for actual API call)
                async submitForm() {
                    this.isLoading = true;
                    this.errors = {};

                    // Basic validation
                    if (!this.formData.name) this.errors.name = 'Plan Name is required.';
                    if (!this.formData.price) this.errors.price = 'Price is required.';
                    if (!this.formData.duration) this.errors.duration = 'Duration is required.';
                    if (!this.formData.features) this.errors.features = 'Features are required.';
                    if (!this.formData.status) this.errors.status = 'Status is required.';

                    if (Object.keys(this.errors).length > 0) {
                        this.isLoading = false;
                        return;
                    }

                    try {
                        // Simulate API call
                        await new Promise(resolve => setTimeout(resolve, 500)); // Simulate network delay

                        if (this.editMode) {
                            // Update existing plan in the list
                            const index = this.paymentPlans.findIndex(p => p.id === this.formData.id);
                            if (index !== -1) {
                                this.paymentPlans[index] = { ...this.formData }; // Update with new data
                            }
                            alert('Payment Plan updated successfully!');
                        } else {
                            // Add new plan to the TOP of the list
                            const newId = this.paymentPlans.length > 0 ? Math.max(...this.paymentPlans.map(p => p.id)) + 1 : 1;
                            this.paymentPlans.unshift({ ...this.formData, id: newId });
                            alert('Payment Plan added successfully!');
                        }

                        this.closeForm();

                    } catch (error) {
                        console.error('Error saving plan:', error);
                        alert('Error saving plan. Please try again.');
                    } finally {
                        this.isLoading = false;
                    }
                },

                // Toggle plan status (Activate/Deactivate)
                async togglePlanStatus(plan) {
                    const newStatus = plan.status === 'Active' ? 'Inactive' : 'Active';
                    if (confirm(`Are you sure you want to ${newStatus.toLowerCase()} this plan?`)) {
                        try {
                            // Simulate API call to update status
                            await new Promise(resolve => setTimeout(resolve, 300));

                            const index = this.paymentPlans.findIndex(p => p.id === plan.id);
                            if (index !== -1) {
                                this.paymentPlans[index].status = newStatus;
                                alert(`Plan ${newStatus.toLowerCase()}d successfully!`);
                            }
                        } catch (error) {
                            console.error('Error toggling plan status:', error);
                            alert('Error toggling plan status. Please try again.');
                        }
                    }
                },

                // Delete plan
                async deletePlan(planId) {
                    if (confirm('Are you sure you want to delete this plan?')) {
                        try {
                            // Simulate API call to delete
                            await new Promise(resolve => setTimeout(resolve, 300));

                            this.paymentPlans = this.paymentPlans.filter(p => p.id !== planId);
                            alert('Payment Plan deleted successfully!');
                        } catch (error) {
                            console.error('Error deleting plan:', error);
                            alert('Error deleting plan. Please try again.');
                        }
                    }
                }
            }
        }
    </script>
@endsection
