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

        /* Wizard Styles */
        .wizard-progress {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .wizard-progress .d-flex {
            position: relative;
        }

        .wizard-progress .d-flex::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e9ecef;
            z-index: 1;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            flex: 1;
            position: relative;
            z-index: 2;
        }

        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .step.active .step-number {
            background: #91d20a;
            color: white;
        }

        .step.completed .step-number {
            background: #28a745;
            color: white;
        }

        .step-label {
            font-size: 0.8rem;
            color: #6c757d;
            font-weight: 500;
        }

        .step.active .step-label {
            color: #91d20a;
            font-weight: 600;
        }

        .step.completed .step-label {
            color: #28a745;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .step-label {
                font-size: 0.7rem;
            }

            .step-number {
                width: 30px;
                height: 30px;
                font-size: 0.8rem;
            }
        }

        /* Form Section Styling */
        .form-section {
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .terms-box {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        /* Template Section Styling */
        .template-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 2px dashed #91d20a;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .template-section:hover {
            border-style: solid;
            box-shadow: 0 4px 15px rgba(145, 210, 10, 0.15);
        }

        .template-section h6 {
            margin-bottom: 0;
            font-weight: 600;
        }

        .template-section .fas {
            font-size: 1.1rem;
        }

        .template-section select {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 10px 15px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .template-section select:focus {
            border-color: #91d20a;
            box-shadow: 0 0 0 0.2rem rgba(145, 210, 10, 0.25);
            transform: translateY(-1px);
        }

        .template-section .btn {
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .template-section .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .template-section .text-muted {
            font-size: 0.875rem;
            font-style: italic;
        }

        /* Client Search Dropdown Styles */
        .client-search-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            border-radius: 0.375rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
        }

        .client-search-dropdown .list-group-item {
            border: none;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .client-search-dropdown .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .client-search-dropdown .list-group-item:last-child {
            border-bottom: none;
        }

        .position-relative {
            position: relative;
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

                <!-- Progress Steps -->
                <div class="wizard-progress mb-4">
                    <div class="d-flex justify-content-between">
                        <div class="step" :class="{ 'active': currentStep >= 1, 'completed': currentStep > 1 }">
                            <div class="step-number">1</div>
                            <span class="step-label">Personal Details</span>
                        </div>
                        <div class="step" :class="{ 'active': currentStep >= 2, 'completed': currentStep > 2 }">
                            <div class="step-number">2</div>
                            <span class="step-label">Occupation</span>
                        </div>
                        <div class="step" :class="{ 'active': currentStep >= 3, 'completed': currentStep > 3 }">
                            <div class="step-number">3</div>
                            <span class="step-label">Contact Info</span>
                        </div>
                        <div class="step" :class="{ 'active': currentStep >= 4, 'completed': currentStep > 4 }">
                            <div class="step-number">4</div>
                            <span class="step-label">Subscription</span>
                        </div>
                        <div class="step" :class="{ 'active': currentStep >= 5, 'completed': currentStep > 5 }">
                            <div class="step-number">5</div>
                            <span class="step-label">Payment</span>
                        </div>
                        <div class="step" :class="{ 'active': currentStep >= 6, 'completed': currentStep > 6 }">
                            <div class="step-number">6</div>
                            <span class="step-label">Next of Kin</span>
                        </div>
                        <div class="step" :class="{ 'active': currentStep >= 7, 'completed': currentStep > 7 }">
                            <div class="step-number">7</div>
                            <span class="step-label">Subscriber Type</span>
                        </div>
                        <div class="step" :class="{ 'active': currentStep >= 8, 'completed': currentStep > 8 }">
                            <div class="step-number">8</div>
                            <span class="step-label">Declaration</span>
                        </div>
                    </div>
                </div>

                <!-- Template Selection -->
                <div class="mb-4 p-3 template-section">
                    <h6 class="mb-3 fw-semibold" style="color: #91d20a;">
                        <i class="fas fa-file-alt me-2"></i>FORM TEMPLATES
                    </h6>
                    <div class="row g-3">
                        <div class="col-12 col-md-8">
                            <label for="formTemplate" class="form-label">Select a template to auto-fill the form</label>
                            <div class="input-group">
                                <select id="formTemplate" x-model="selectedTemplate" class="form-select"
                                    @change="applyTemplate(selectedTemplate)">
                                    <option value="">Select a template...</option>
                                    <template x-for="template in templates" :key="template.id">
                                        <option :value="template.id" x-text="template.name"></option>
                                    </template>
                                </select>
                                <button type="button" class="btn btn-outline-secondary" @click="clearTemplate()"
                                    :disabled="!selectedTemplate" title="Clear template selection">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Templates contain sample data to help you fill out the form quickly. You can modify any
                                field after applying a template.
                            </small>
                        </div>
                        <div class="col-12 col-md-4 d-flex flex-column gap-2">
                            <button type="button" class="btn btn-outline-warning btn-sm" @click="saveAsTemplate()"
                                :disabled="!isFormPartiallyFilled()">
                                <i class="fas fa-save me-1"></i>Save Current Form as Template
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm" @click="deleteTemplate()"
                                :disabled="!selectedTemplate" x-show="selectedTemplate">
                                <i class="fas fa-trash me-1"></i>Delete Selected Template
                            </button>
                        </div>
                    </div>
                </div>

                <form @submit.prevent="submitSale">
                    <!-- Step 1: Personal Details -->
                    <div x-show="currentStep === 1" x-transition>
                        <h6 class="mb-4 fw-semibold" style="color: #91d20a;">CLIENT SELECTION & PERSONAL DETAILS</h6>

                        <!-- Client Type Selection -->
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <div class="card border-primary">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0" style="color: #91d20a;">
                                            <i class="fas fa-user-check me-2"></i>Client Type
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="clientType" class="form-label">Are you registering for: <span
                                                        class="text-danger">*</span></label>
                                                <select id="clientType" x-model="form.client_type" class="form-select"
                                                    required
                                                    @change="validateField('client_type', form.client_type); handleClientTypeChange()"
                                                    :class="{
                                                        'is-invalid': errors.client_type,
                                                        'is-valid': !errors
                                                            .client_type && form.client_type
                                                    }">
                                                    <option value="">Select client type</option>
                                                    <option value="new">New Client</option>
                                                    <option value="existing">Existing Client</option>
                                                </select>
                                                <div class="invalid-feedback" x-show="errors.client_type"
                                                    x-text="errors.client_type"></div>
                                                <small class="text-muted">
                                                    <i class="fas fa-info-circle me-1"></i>
                                                    Choose "New Client" to create a new customer record, or "Existing
                                                    Client" to select from existing customers.
                                                </small>
                                            </div>

                                            <!-- Existing Client Selection -->
                                            <div x-show="form.client_type === 'existing'" class="col-12">
                                                <label for="existingClient" class="form-label">Select Existing Client
                                                    <span class="text-danger">*</span></label>
                                                <div class="position-relative">
                                                    <div class="input-group">
                                                        <input type="text" id="existingClientSearch"
                                                            x-model="existingClientSearch" class="form-control"
                                                            placeholder="Search client by name, email, or phone..."
                                                            @input="searchExistingClients()"
                                                            @focus="showClientDropdown = true"
                                                            :class="{ 'is-invalid': errors.existing_client_id }">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            @click="clearExistingClient()"
                                                            :disabled="!form.existing_client_id" title="Clear selection">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <div class="invalid-feedback" x-show="errors.existing_client_id"
                                                        x-text="errors.existing_client_id"></div>

                                                    <!-- Search Results Dropdown -->
                                                    <div x-show="showClientDropdown && existingClients.length > 0"
                                                        class="client-search-dropdown">
                                                        <div class="list-group">
                                                            <template x-for="client in existingClients"
                                                                :key="client.id">
                                                                <button type="button"
                                                                    class="list-group-item list-group-item-action"
                                                                    @click="selectExistingClient(client)">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div>
                                                                            <strong x-text="client.name"></strong>
                                                                            <br>
                                                                            <small class="text-muted">
                                                                                <span x-text="client.email"></span> | <span
                                                                                    x-text="client.phone"></span>
                                                                            </small>
                                                                        </div>
                                                                        <i class="fas fa-user"></i>
                                                                    </div>
                                                                </button>
                                                            </template>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Selected Client Info -->
                                                <div x-show="form.existing_client_id && selectedClient" class="mt-2">
                                                    <div class="alert alert-info">
                                                        <strong>Selected Client:</strong> <span
                                                            x-text="selectedClient.name"></span><br>
                                                        <small>Email: <span x-text="selectedClient.email"></span> | Phone:
                                                            <span x-text="selectedClient.phone"></span></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Details (show for new clients, read-only for existing clients) -->
                        <div
                            x-show="form.client_type === 'new' || (form.client_type === 'existing' && form.existing_client_id)">
                            <h6 class="mb-3 fw-semibold" style="color: #91d20a;">
                                <span x-show="form.client_type === 'new'">New Client Details</span>
                                <span x-show="form.client_type === 'existing' && form.existing_client_id">Client
                                    Information (Auto-filled)</span>
                            </h6>

                            <!-- Information note for existing clients -->
                            <div x-show="form.client_type === 'existing' && form.existing_client_id"
                                class="alert alert-info mb-3">
                                <i class="fas fa-info-circle me-2"></i>
                                The information below has been automatically filled from the selected client's profile.
                            </div>

                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label for="title" class="form-label">Title/Status <span
                                            class="text-danger">*</span></label>
                                    <select id="title" x-model="form.title" class="form-select"
                                        :required="form.client_type === 'new'"
                                        :disabled="form.client_type === 'existing' && form.existing_client_id"
                                        @change="validateField('title', form.title)"
                                        :class="{ 'is-invalid': errors.title, 'is-valid': !errors.title && form.title }">
                                        <option value="">Select Title</option>
                                        <option value="Mr">Mr.</option>
                                        <option value="Mrs">Mrs.</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Ms">Ms.</option>
                                        <option value="Dr">Dr.</option>
                                        <option value="Chief">Chief</option>
                                        <option value="Engr">Engr.</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <div class="invalid-feedback" x-show="errors.title" x-text="errors.title"></div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="maritalStatus" class="form-label">Marital Status</label>
                                    <select id="maritalStatus" x-model="form.marital_status" class="form-select"
                                        :disabled="form.client_type === 'existing' && form.existing_client_id"
                                        @change="validateField('marital_status', form.marital_status)"
                                        :class="{
                                            'is-invalid': errors.marital_status,
                                            'is-valid': !errors.marital_status && form
                                                .marital_status
                                        }">
                                        <option value="">Select Status</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <div class="invalid-feedback" x-show="errors.marital_status"
                                        x-text="errors.marital_status">
                                    </div>
                                </div>
                                <div class="col-12 col-md-8" x-show="form.title === 'Other'">
                                    <label for="titleOther" class="form-label">Specify Other Title</label>
                                    <input type="text" id="titleOther" x-model="form.title_other"
                                        class="form-control" placeholder="Enter custom title"
                                        :disabled="form.client_type === 'existing' && form.existing_client_id"
                                        @input="validateField('title_other', form.title_other)"
                                        :class="{
                                            'is-invalid': errors.title_other,
                                            'is-valid': !errors.title_other && form
                                                .title_other
                                        }">
                                    <div class="invalid-feedback" x-show="errors.title_other"
                                        x-text="errors.title_other">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="fullName" class="form-label">Full Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="fullName" x-model="form.full_name" class="form-control"
                                        :required="form.client_type === 'new'" placeholder="Enter your full name"
                                        :disabled="form.client_type === 'existing' && form.existing_client_id"
                                        @input="validateField('full_name', form.full_name)"
                                        :class="{
                                            'is-invalid': errors.full_name,
                                            'is-valid': !errors.full_name && form
                                                .full_name
                                        }">
                                    <div class="invalid-feedback" x-show="errors.full_name" x-text="errors.full_name">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="gender" class="form-label">Gender <span
                                            class="text-danger">*</span></label>
                                    <select id="gender" x-model="form.gender" class="form-select"
                                        :required="form.client_type === 'new'"
                                        :disabled="form.client_type === 'existing' && form.existing_client_id"
                                        @change="validateField('gender', form.gender)"
                                        :class="{ 'is-invalid': errors.gender, 'is-valid': !errors.gender && form.gender }">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <div class="invalid-feedback" x-show="errors.gender" x-text="errors.gender"></div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="dateOfBirth" class="form-label">Date of Birth</label>
                                    <input type="date" id="dateOfBirth" x-model="form.date_of_birth"
                                        class="form-control"
                                        :disabled="form.client_type === 'existing' && form.existing_client_id"
                                        @change="validateField('date_of_birth', form.date_of_birth)"
                                        :class="{
                                            'is-invalid': errors.date_of_birth,
                                            'is-valid': !errors.date_of_birth && form
                                                .date_of_birth
                                        }">
                                    <div class="invalid-feedback" x-show="errors.date_of_birth"
                                        x-text="errors.date_of_birth"></div>
                                </div>

                                <div class="col-12 col-md-6" x-show="form.marital_status === 'Others'">
                                    <label for="maritalStatusOther" class="form-label">Specify Other Status</label>
                                    <input type="text" id="maritalStatusOther" x-model="form.marital_status_other"
                                        class="form-control" placeholder="Enter custom marital status"
                                        :disabled="form.client_type === 'existing' && form.existing_client_id"
                                        @input="validateField('marital_status_other', form.marital_status_other)"
                                        :class="{
                                            'is-invalid': errors.marital_status_other,
                                            'is-valid': !errors
                                                .marital_status_other && form.marital_status_other
                                        }">
                                    <div class="invalid-feedback" x-show="errors.marital_status_other"
                                        x-text="errors.marital_status_other"></div>
                                </div>
                            </div>
                        </div> <!-- End conditional div for client details -->
                    </div>

                    <!-- Step 2: Occupational Details -->
                    <div x-show="currentStep === 2" x-transition>
                        <h6 class="mb-4 fw-semibold" style="color: #91d20a;">OCCUPATIONAL DETAILS</h6>

                        <!-- Information note for existing clients -->
                        <div x-show="form.client_type === 'existing' && form.existing_client_id"
                            class="alert alert-info mb-3">
                            <i class="fas fa-info-circle me-2"></i>
                            The occupational information below has been automatically filled from the client's profile.
                        </div>

                        <div class="row g-3">
                            <div class="col-12">
                                <label for="occupation" class="form-label">Occupation/Profession</label>
                                <input type="text" id="occupation" x-model="form.occupation" class="form-control"
                                    placeholder="Enter your occupation or profession"
                                    :disabled="form.client_type === 'existing' && form.existing_client_id"
                                    @input="validateField('occupation', form.occupation)"
                                    :class="{
                                        'is-invalid': errors.occupation,
                                        'is-valid': !errors.occupation && form
                                            .occupation
                                    }">
                                <div class="invalid-feedback" x-show="errors.occupation" x-text="errors.occupation">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="nationality" class="form-label">Nationality</label>
                                <input type="text" id="nationality" x-model="form.nationality" class="form-control"
                                    placeholder="Enter your nationality"
                                    :disabled="form.client_type === 'existing' && form.existing_client_id"
                                    @input="validateField('nationality', form.nationality)"
                                    :class="{
                                        'is-invalid': errors.nationality,
                                        'is-valid': !errors.nationality && form
                                            .nationality
                                    }">
                                <div class="invalid-feedback" x-show="errors.nationality" x-text="errors.nationality">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="stateOfOrigin" class="form-label">State of Origin</label>
                                <input type="text" id="stateOfOrigin" x-model="form.state_of_origin"
                                    class="form-control" placeholder="Enter your state of origin"
                                    :disabled="form.client_type === 'existing' && form.existing_client_id"
                                    @input="validateField('state_of_origin', form.state_of_origin)"
                                    :class="{
                                        'is-invalid': errors.state_of_origin,
                                        'is-valid': !errors.state_of_origin && form
                                            .state_of_origin
                                    }">
                                <div class="invalid-feedback" x-show="errors.state_of_origin"
                                    x-text="errors.state_of_origin"></div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="lga" class="form-label">Local Government Area (L.G.A)</label>
                                <input type="text" id="lga" x-model="form.lga" class="form-control"
                                    placeholder="Enter your L.G.A"
                                    :disabled="form.client_type === 'existing' && form.existing_client_id"
                                    @input="validateField('lga', form.lga)"
                                    :class="{ 'is-invalid': errors.lga, 'is-valid': !errors.lga && form.lga }">
                                <div class="invalid-feedback" x-show="errors.lga" x-text="errors.lga"></div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="hometown" class="form-label">Hometown</label>
                                <input type="text" id="hometown" x-model="form.hometown" class="form-control"
                                    placeholder="Enter your hometown"
                                    :disabled="form.client_type === 'existing' && form.existing_client_id"
                                    @input="validateField('hometown', form.hometown)"
                                    :class="{ 'is-invalid': errors.hometown, 'is-valid': !errors.hometown && form.hometown }">
                                <div class="invalid-feedback" x-show="errors.hometown" x-text="errors.hometown"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Contact Information -->
                    <div x-show="currentStep === 3" x-transition>
                        <h6 class="mb-4 fw-semibold" style="color: #91d20a;">CONTACT INFORMATION</h6>

                        <!-- Information note for existing clients -->
                        <div x-show="form.client_type === 'existing' && form.existing_client_id"
                            class="alert alert-info mb-3">
                            <i class="fas fa-info-circle me-2"></i>
                            The contact information below has been automatically filled from the client's profile.
                        </div>

                        <div class="row g-3">
                            <div class="col-12">
                                <label for="residentialAddress" class="form-label">Residential Address</label>
                                <textarea id="residentialAddress" x-model="form.residential_address" class="form-control" rows="3"
                                    placeholder="Enter your complete residential address"
                                    :disabled="form.client_type === 'existing' && form.existing_client_id"
                                    @input="validateField('residential_address', form.residential_address)"
                                    :class="{
                                        'is-invalid': errors.residential_address,
                                        'is-valid': !errors
                                            .residential_address && form.residential_address
                                    }"></textarea>
                                <div class="invalid-feedback" x-show="errors.residential_address"
                                    x-text="errors.residential_address"></div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="phoneNumber" class="form-label">Phone Number <span
                                        class="text-danger">*</span></label>
                                <input type="tel" id="phoneNumber" x-model="form.phone_number" class="form-control"
                                    required placeholder="Enter your phone number"
                                    :disabled="form.client_type === 'existing' && form.existing_client_id"
                                    @input="validateField('phone_number', form.phone_number)"
                                    :class="{
                                        'is-invalid': errors.phone_number,
                                        'is-valid': !errors.phone_number && form
                                            .phone_number
                                    }">
                                <div class="invalid-feedback" x-show="errors.phone_number" x-text="errors.phone_number">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="emailAddress" class="form-label">Email Address</label>
                                <input type="email" id="emailAddress" x-model="form.email_address"
                                    class="form-control" placeholder="Enter your email address"
                                    :disabled="form.client_type === 'existing' && form.existing_client_id"
                                    @input="validateField('email_address', form.email_address)"
                                    :class="{
                                        'is-invalid': errors.email_address,
                                        'is-valid': !errors.email_address && form
                                            .email_address
                                    }">
                                <div class="invalid-feedback" x-show="errors.email_address"
                                    x-text="errors.email_address"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Subscription Details -->
                    <div x-show="currentStep === 4" x-transition>
                        <h6 class="mb-4 fw-semibold" style="color: #91d20a;">SUBSCRIPTION DETAILS</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="estate" class="form-label">Which Estate are you subscribing to? <span
                                        class="text-danger">*</span></label>
                                <select id="estate" x-model="form.estate_id" class="form-select" required
                                    @change="validateField('estate_id', form.estate_id)"
                                    :class="{ 'is-invalid': errors.estate_id, 'is-valid': !errors.estate_id && form.estate_id }">
                                    <option value="">Select an estate</option>
                                    <template x-for="property in properties" :key="property.id">
                                        <option :value="property.id" x-text="property.name"></option>
                                    </template>
                                </select>
                                <div class="invalid-feedback" x-show="errors.estate_id" x-text="errors.estate_id"></div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="commercialPlots" class="form-label">Number of Commercial Plots</label>
                                <select id="commercialPlots" x-model="form.commercial_plots" class="form-select"
                                    @change="validateField('commercial_plots', form.commercial_plots)"
                                    :class="{
                                        'is-invalid': errors.commercial_plots,
                                        'is-valid': !errors.commercial_plots &&
                                            form.commercial_plots
                                    }">
                                    <option value="">Select number of plots</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="other">Other (specify)</option>
                                </select>
                                <div class="invalid-feedback" x-show="errors.commercial_plots"
                                    x-text="errors.commercial_plots"></div>
                                <div x-show="form.commercial_plots === 'other'" class="mt-2">
                                    <input type="number" x-model="form.commercial_plots_other" class="form-control"
                                        placeholder="Enter number of commercial plots" min="0"
                                        @input="validateField('commercial_plots_other', form.commercial_plots_other)"
                                        :class="{
                                            'is-invalid': errors.commercial_plots_other,
                                            'is-valid': !errors
                                                .commercial_plots_other && form.commercial_plots_other
                                        }">
                                    <div class="invalid-feedback" x-show="errors.commercial_plots_other"
                                        x-text="errors.commercial_plots_other"></div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="residentialPlots" class="form-label">Number of Residential Plots</label>
                                <select id="residentialPlots" x-model="form.residential_plots" class="form-select"
                                    @change="validateField('residential_plots', form.residential_plots)"
                                    :class="{
                                        'is-invalid': errors.residential_plots,
                                        'is-valid': !errors.residential_plots &&
                                            form.residential_plots
                                    }">
                                    <option value="">Select number of plots</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="other">Other (specify)</option>
                                </select>
                                <div class="invalid-feedback" x-show="errors.residential_plots"
                                    x-text="errors.residential_plots"></div>
                                <div x-show="form.residential_plots === 'other'" class="mt-2">
                                    <input type="number" x-model="form.residential_plots_other" class="form-control"
                                        placeholder="Enter number of residential plots" min="0"
                                        @input="validateField('residential_plots_other', form.residential_plots_other)"
                                        :class="{
                                            'is-invalid': errors.residential_plots_other,
                                            'is-valid': !errors
                                                .residential_plots_other && form.residential_plots_other
                                        }">
                                    <div class="invalid-feedback" x-show="errors.residential_plots_other"
                                        x-text="errors.residential_plots_other"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5: Payment Plan -->
                    <div x-show="currentStep === 5" x-transition>
                        <h6 class="mb-4 fw-semibold" style="color: #91d20a;">PAYMENT PLAN</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="paymentMode" class="form-label">Select Payment Mode <span
                                        class="text-danger">*</span></label>
                                <select id="paymentMode" x-model="form.payment_mode" class="form-select" required
                                    @change="onPaymentPlanChange(); validateField('payment_mode', form.payment_mode)"
                                    :class="{
                                        'is-invalid': errors.payment_mode,
                                        'is-valid': !errors.payment_mode && form.payment_mode
                                    }">
                                    <option value="">Select payment plan</option>
                                    <template x-for="plan in paymentPlans" :key="plan.id">
                                        <option :value="plan.code || plan.name" x-text="plan.name"></option>
                                    </template>
                                </select>
                                <div class="invalid-feedback" x-show="errors.payment_mode" x-text="errors.payment_mode">
                                </div>

                                <!-- Payment Plan Details -->
                                <div x-show="selectedPaymentPlan" class="mt-3 p-3 bg-light rounded">
                                    <h6 class="mb-2 text-success">Payment Plan Details</h6>
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <small class="text-muted d-block">Duration:</small>
                                            <span
                                                x-text="selectedPaymentPlan ? (selectedPaymentPlan.duration_months == 0 ? 'Immediate' : selectedPaymentPlan.duration_months + ' months') : ''"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="text-muted d-block">Interest Rate:</small>
                                            <span
                                                x-text="selectedPaymentPlan ? selectedPaymentPlan.interest_rate + '%' : ''"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="text-muted d-block">Installments:</small>
                                            <span
                                                x-text="selectedPaymentPlan ? selectedPaymentPlan.installments_count : ''"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="text-muted d-block">Down Payment:</small>
                                            <span
                                                x-text="selectedPaymentPlan ? selectedPaymentPlan.down_payment_percentage + '%' : ''"></span>
                                        </div>
                                        <div class="col-12"
                                            x-show="selectedPaymentPlan && selectedPaymentPlan.description">
                                            <small class="text-muted d-block">Description:</small>
                                            <span
                                                x-text="selectedPaymentPlan ? selectedPaymentPlan.description : ''"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <small class="text-muted">
                                        <strong>Note:</strong> Additional charges apply for installment plans.
                                        Please read the terms and conditions for detailed information.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 6: Next of Kin -->
                    <div x-show="currentStep === 6" x-transition>
                        <h6 class="mb-4 fw-semibold" style="color: #91d20a;">NEXT OF KIN DETAILS</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="nextOfKinName" class="form-label">Full Name</label>
                                <input type="text" id="nextOfKinName" x-model="form.next_of_kin_name"
                                    class="form-control" placeholder="Enter next of kin's full name"
                                    @input="validateField('next_of_kin_name', form.next_of_kin_name)"
                                    :class="{
                                        'is-invalid': errors.next_of_kin_name,
                                        'is-valid': !errors.next_of_kin_name &&
                                            form.next_of_kin_name
                                    }">
                                <div class="invalid-feedback" x-show="errors.next_of_kin_name"
                                    x-text="errors.next_of_kin_name"></div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="nextOfKinRelationship" class="form-label">Relationship</label>
                                <select id="nextOfKinRelationship" x-model="form.next_of_kin_relationship"
                                    class="form-select"
                                    @change="validateField('next_of_kin_relationship', form.next_of_kin_relationship)"
                                    :class="{
                                        'is-invalid': errors.next_of_kin_relationship,
                                        'is-valid': !errors
                                            .next_of_kin_relationship && form.next_of_kin_relationship
                                    }">
                                    <option value="">Select relationship</option>
                                    <option value="Spouse">Spouse</option>
                                    <option value="Father">Father</option>
                                    <option value="Mother">Mother</option>
                                    <option value="Son">Son</option>
                                    <option value="Daughter">Daughter</option>
                                    <option value="Brother">Brother</option>
                                    <option value="Sister">Sister</option>
                                    <option value="Friend">Friend</option>
                                    <option value="Other">Other</option>
                                </select>
                                <div class="invalid-feedback" x-show="errors.next_of_kin_relationship"
                                    x-text="errors.next_of_kin_relationship"></div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="nextOfKinPhone" class="form-label">Phone Number</label>
                                <input type="tel" id="nextOfKinPhone" x-model="form.next_of_kin_phone"
                                    class="form-control" placeholder="Enter next of kin's phone number"
                                    @input="validateField('next_of_kin_phone', form.next_of_kin_phone)"
                                    :class="{
                                        'is-invalid': errors.next_of_kin_phone,
                                        'is-valid': !errors.next_of_kin_phone &&
                                            form.next_of_kin_phone
                                    }">
                                <div class="invalid-feedback" x-show="errors.next_of_kin_phone"
                                    x-text="errors.next_of_kin_phone"></div>
                            </div>
                            <div class="col-12">
                                <label for="nextOfKinEmail" class="form-label">Email Address</label>
                                <input type="email" id="nextOfKinEmail" x-model="form.next_of_kin_email"
                                    class="form-control" placeholder="Enter next of kin's email address"
                                    @input="validateField('next_of_kin_email', form.next_of_kin_email)"
                                    :class="{
                                        'is-invalid': errors.next_of_kin_email,
                                        'is-valid': !errors.next_of_kin_email &&
                                            form.next_of_kin_email
                                    }">
                                <div class="invalid-feedback" x-show="errors.next_of_kin_email"
                                    x-text="errors.next_of_kin_email"></div>
                            </div>
                            <div class="col-12">
                                <label for="nextOfKinAddress" class="form-label">Contact Address</label>
                                <textarea id="nextOfKinAddress" x-model="form.next_of_kin_address" class="form-control" rows="3"
                                    placeholder="Enter next of kin's complete address"
                                    @input="validateField('next_of_kin_address', form.next_of_kin_address)"
                                    :class="{
                                        'is-invalid': errors.next_of_kin_address,
                                        'is-valid': !errors
                                            .next_of_kin_address && form.next_of_kin_address
                                    }"></textarea>
                                <div class="invalid-feedback" x-show="errors.next_of_kin_address"
                                    x-text="errors.next_of_kin_address"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 7: Subscriber Type -->
                    <div x-show="currentStep === 7" x-transition>
                        <h6 class="mb-4 fw-semibold" style="color: #91d20a;">SUBSCRIBER TYPE</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="subscriberType" class="form-label">Are you buying as: <span
                                        class="text-danger">*</span></label>
                                <select id="subscriberType" x-model="form.subscriber_type" class="form-select" required
                                    @change="validateField('subscriber_type', form.subscriber_type)"
                                    :class="{
                                        'is-invalid': errors.subscriber_type,
                                        'is-valid': !errors.subscriber_type && form
                                            .subscriber_type
                                    }">
                                    <option value="">Select subscriber type</option>
                                    <option value="Individual">Individual</option>
                                    <option value="Organization">Organization/Company</option>
                                </select>
                                <div class="invalid-feedback" x-show="errors.subscriber_type"
                                    x-text="errors.subscriber_type"></div>
                            </div>

                            <div x-show="form.subscriber_type === 'Organization'" class="col-12">
                                <div class="card border-success">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0" style="color: #91d20a;">Organization Details</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="organizationName" class="form-label">Name of Organization
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" id="organizationName"
                                                    x-model="form.organization_name" class="form-control"
                                                    placeholder="Enter organization name"
                                                    @input="validateField('organization_name', form.organization_name)"
                                                    :class="{
                                                        'is-invalid': errors.organization_name,
                                                        'is-valid': !errors
                                                            .organization_name && form.organization_name
                                                    }">
                                                <div class="invalid-feedback" x-show="errors.organization_name"
                                                    x-text="errors.organization_name"></div>
                                            </div>
                                            <div class="col-12">
                                                <h6 class="mb-3" style="color: #91d20a;">Authorized Signatories (3
                                                    Required)</h6>
                                                <template x-for="(signatory, index) in form.signatories"
                                                    :key="index">
                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <h6 class="card-title" x-text="'Signatory ' + (index + 1)">
                                                            </h6>
                                                            <div class="row g-2">
                                                                <div class="col-12 col-md-6">
                                                                    <label class="form-label">Full Name</label>
                                                                    <input type="text" x-model="signatory.name"
                                                                        class="form-control"
                                                                        placeholder="Enter signatory's full name"
                                                                        @input="validateSignatory(index, 'name', signatory.name)">
                                                                </div>
                                                                <div class="col-12 col-md-6">
                                                                    <label class="form-label">Position/Title</label>
                                                                    <input type="text" x-model="signatory.position"
                                                                        class="form-control"
                                                                        placeholder="Enter position or title"
                                                                        @input="validateSignatory(index, 'position', signatory.position)">
                                                                </div>
                                                                <div class="col-12 col-md-6">
                                                                    <label class="form-label">Date</label>
                                                                    <input type="date" x-model="signatory.date"
                                                                        class="form-control"
                                                                        @change="validateSignatory(index, 'date', signatory.date)">
                                                                </div>
                                                                <div class="col-12 col-md-6">
                                                                    <label class="form-label">Digital Signature</label>
                                                                    <input type="text" x-model="signatory.signature"
                                                                        class="form-control"
                                                                        placeholder="Type full name as signature"
                                                                        @input="validateSignatory(index, 'signature', signatory.signature)">
                                                                </div>
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
                    </div>

                    <!-- Step 8: Declaration & Terms -->
                    <div x-show="currentStep === 8" x-transition>
                        <h6 class="mb-4 fw-semibold" style="color: #91d20a;">TERMS & CONDITIONS</h6>
                        <div class="card border-warning mb-4">
                            <div class="card-header bg-warning-light">
                                <h6 class="mb-0 text-warning">Important Terms & Conditions</h6>
                            </div>
                            <div class="card-body">
                                <ul class="mb-0 list-unstyled">
                                    <li class="mb-2">✓ All estate prices are all-inclusive – no hidden charges or extra
                                        fees.</li>
                                    <li class="mb-2">✓ Outright payment plan is valid for a maximum of 3 months. Any
                                        default attracts a 5% penalty.</li>
                                    <li class="mb-2">✓ 6-month instalment attracts an additional 10% on the total price.
                                    </li>
                                    <li class="mb-2">✓ 12-month (1-year) instalment attracts an additional 20% on the
                                        total price.</li>
                                    <li class="mb-0">✓ Refund Policy: If a refund is requested, 40% of the total cost
                                        (covering commissions, taxes, admin & documentation) is non-refundable.</li>
                                </ul>
                            </div>
                        </div>

                        <h6 class="mb-4 fw-semibold" style="color: #91d20a;">DECLARATION</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-check p-3 border rounded">
                                    <input class="form-check-input" type="checkbox" x-model="form.terms_accepted"
                                        id="termsAccepted" required
                                        @change="validateField('terms_accepted', form.terms_accepted)"
                                        :class="{ 'is-invalid': errors.terms_accepted }">
                                    <label class="form-check-label fw-semibold" for="termsAccepted">
                                        I hereby confirm that all the information provided above is true and accurate. I
                                        also declare that I have read, understood, and agreed to all the terms and
                                        conditions stated in this form.
                                    </label>
                                    <div class="invalid-feedback" x-show="errors.terms_accepted"
                                        x-text="errors.terms_accepted"></div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="clientSignature" class="form-label">Digital Signature <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="clientSignature" x-model="form.client_signature"
                                    class="form-control" placeholder="Type your full name as signature" required
                                    @input="validateField('client_signature', form.client_signature)"
                                    :class="{
                                        'is-invalid': errors.client_signature,
                                        'is-valid': !errors.client_signature &&
                                            form.client_signature
                                    }">
                                <div class="invalid-feedback" x-show="errors.client_signature"
                                    x-text="errors.client_signature"></div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="signatureDate" class="form-label">Date <span
                                        class="text-danger">*</span></label>
                                <input type="date" id="signatureDate" x-model="form.signature_date"
                                    class="form-control" required
                                    @change="validateField('signature_date', form.signature_date)"
                                    :class="{
                                        'is-invalid': errors.signature_date,
                                        'is-valid': !errors.signature_date && form
                                            .signature_date
                                    }">
                                <div class="invalid-feedback" x-show="errors.signature_date"
                                    x-text="errors.signature_date"></div>
                            </div>
                        </div>

                        <h6 class="mb-4 mt-4 fw-semibold" style="color: #91d20a;">WITNESS INFORMATION</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="witnessName" class="form-label">Full Name of Witness</label>
                                <input type="text" id="witnessName" x-model="form.witness_name" class="form-control"
                                    placeholder="Enter witness full name"
                                    @input="validateField('witness_name', form.witness_name)"
                                    :class="{
                                        'is-invalid': errors.witness_name,
                                        'is-valid': !errors.witness_name && form
                                            .witness_name
                                    }">
                                <div class="invalid-feedback" x-show="errors.witness_name" x-text="errors.witness_name">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="witnessPhone" class="form-label">Phone Number</label>
                                <input type="tel" id="witnessPhone" x-model="form.witness_phone"
                                    class="form-control" placeholder="Enter witness phone number"
                                    @input="validateField('witness_phone', form.witness_phone)"
                                    :class="{
                                        'is-invalid': errors.witness_phone,
                                        'is-valid': !errors.witness_phone && form
                                            .witness_phone
                                    }">
                                <div class="invalid-feedback" x-show="errors.witness_phone"
                                    x-text="errors.witness_phone"></div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="witnessEmail" class="form-label">Email Address</label>
                                <input type="email" id="witnessEmail" x-model="form.witness_email"
                                    class="form-control" placeholder="Enter witness email address"
                                    @input="validateField('witness_email', form.witness_email)"
                                    :class="{
                                        'is-invalid': errors.witness_email,
                                        'is-valid': !errors.witness_email && form
                                            .witness_email
                                    }">
                                <div class="invalid-feedback" x-show="errors.witness_email"
                                    x-text="errors.witness_email"></div>
                            </div>
                            <div class="col-12">
                                <label for="witnessAddress" class="form-label">Address</label>
                                <textarea id="witnessAddress" x-model="form.witness_address" class="form-control" rows="3"
                                    placeholder="Enter witness complete address" @input="validateField('witness_address', form.witness_address)"
                                    :class="{
                                        'is-invalid': errors.witness_address,
                                        'is-valid': !errors.witness_address && form
                                            .witness_address
                                    }"></textarea>
                                <div class="invalid-feedback" x-show="errors.witness_address"
                                    x-text="errors.witness_address"></div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="witnessSignature" class="form-label">Witness Signature</label>
                                <input type="text" id="witnessSignature" x-model="form.witness_signature"
                                    class="form-control" placeholder="Type witness full name as signature"
                                    @input="validateField('witness_signature', form.witness_signature)"
                                    :class="{
                                        'is-invalid': errors.witness_signature,
                                        'is-valid': !errors.witness_signature &&
                                            form.witness_signature
                                    }">
                                <div class="invalid-feedback" x-show="errors.witness_signature"
                                    x-text="errors.witness_signature"></div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="witnessDate" class="form-label">Date</label>
                                <input type="date" id="witnessDate" x-model="form.witness_date" class="form-control"
                                    @change="validateField('witness_date', form.witness_date)"
                                    :class="{
                                        'is-invalid': errors.witness_date,
                                        'is-valid': !errors.witness_date && form
                                            .witness_date
                                    }">
                                <div class="invalid-feedback" x-show="errors.witness_date" x-text="errors.witness_date">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="d-flex flex-column flex-md-row justify-content-end gap-2 mt-4 pt-3 border-top">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary" @click="previousStep"
                                x-show="currentStep > 1">
                                <i class="fas fa-chevron-left me-1"></i> Previous
                            </button>
                            <button type="button" class="btn btn-outline-danger" @click="resetWizard">
                                <i class="fas fa-redo me-1"></i> Reset Form
                            </button>
                            <button type="button" class="btn" @click="nextStep" x-show="currentStep < 8"
                                style="background-color: #91d20a; color: white; border-color: #91d20a;"
                                :disabled="!isStepValid(currentStep)">
                                Next <i class="fas fa-chevron-right ms-1"></i>
                            </button>
                            <button type="submit" class="btn" x-show="currentStep === 8"
                                style="background-color: #28a745; color: white; border-color: #28a745;"
                                :disabled="isLoading">
                                <span x-show="!isLoading">
                                    <i class="fas fa-check me-1"></i> Submit Registration
                                </span>
                                <span x-show="isLoading">
                                    <i class="fas fa-spinner fa-spin me-1"></i> Processing...
                                </span>
                            </button>
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
                                <h6>This Month Earnings</h6>
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
                                <h6>Pending Sales</h6>
                                <h4 class="mb-0" x-text="formatCurrency(pendingSales)"></h4>
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
                                <h6>Completed Sales</h6>
                                <h4 class="mb-0" x-text="completedSales"></h4>
                            </div>
                            <div class="icon-box bg-danger-light">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Table -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Sales Records</h5>
                    </div>
                    <div class="card-body">
                        <div class="custom-table-container">
                            <div class="filter-panel">
                                <div class="form-group">
                                    <label for="salesSearch" class="small text-secondary fw-bold">Search</label>
                                    <input type="text" id="salesSearch" x-model="salesFilters.search"
                                        class="form-control form-control-sm"
                                        placeholder="Search by name, email, phone, property, or status...">
                                </div>
                                <div class="form-group">
                                    <label for="salesFromDate" class="small text-secondary fw-bold">From Date</label>
                                    <input type="date" id="salesFromDate" x-model="salesFilters.fromDate"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="salesToDate" class="small text-secondary fw-bold">To Date</label>
                                    <input type="date" id="salesToDate" x-model="salesFilters.toDate"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="form-group ms-auto">
                                    <button class="btn btn-sm" @click="exportSalesData"
                                        style="background-color: #91d20a; color: #fff; border-color: #91d20a; margin-top: 1.5rem;">
                                        Export Sales Data
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
                                            <th class="text-uppercase small text-secondary fw-bold">Amount</th>
                                            <th class="text-uppercase small text-secondary fw-bold">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr x-show="!filteredSales.length">
                                            <td colspan="7" class="text-center text-muted">No sales found</td>
                                        </tr>
                                        <template x-for="sale in paginatedSales" :key="sale.id">
                                            <tr class="border-bottom">
                                                <td class="text-muted" x-text="formatDate(sale.created_at)"></td>
                                                <td class="text-muted"
                                                    x-text="sale.property ? sale.property.name : 'N/A'"></td>
                                                <td class="text-muted" x-text="sale.full_name"></td>
                                                <td class="text-muted" x-text="sale.email_address || '-'"></td>
                                                <td class="text-muted" x-text="sale.phone_number || '-'"></td>
                                                <td class="text-muted fw-bold"
                                                    x-text="formatCurrency(sale.total_amount || 0)"></td>
                                                <td class="fw-semibold"
                                                    :class="{
                                                        'text-warning': sale.status === 'pending',
                                                        'text-success': sale.status === 'approved',
                                                        'text-danger': sale.status === 'rejected'
                                                    }"
                                                    x-text="sale.status.charAt(0).toUpperCase() + sale.status.slice(1)">
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-between align-items-center mt-3"
                                    x-show="salesTotalPages > 1">
                                    <div class="text-muted">
                                        Showing <span x-text="salesStartIndex + 1"></span> to <span
                                            x-text="salesEndIndex"></span>
                                        of <span x-text="filteredSales.length"></span> sales
                                    </div>

                                    <div class="alpine-pagination d-flex align-items-center gap-2">
                                        <button class="page-btn" @click="goToSalesPage(salesCurrentPage - 1)"
                                            :disabled="salesCurrentPage === 1">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>

                                        <template x-for="page in salesVisiblePages" :key="page">
                                            <button class="page-btn" :class="{ 'active': page === salesCurrentPage }"
                                                @click="goToSalesPage(page)" x-text="page">
                                            </button>
                                        </template>

                                        <button class="page-btn" @click="goToSalesPage(salesCurrentPage + 1)"
                                            :disabled="salesCurrentPage === salesTotalPages">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>

                                    <div class="d-flex align-items-center gap-2">
                                        <span class="text-muted">Show:</span>
                                        <select class="form-select form-select-sm" style="width: auto;"
                                            x-model="salesPerPage" @change="salesCurrentPage = 1">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                </div>
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
                                    <label for="earningsSearch" class="small text-secondary fw-bold">Search</label>
                                    <input type="text" id="earningsSearch" x-model="filters.search"
                                        class="form-control form-control-sm"
                                        placeholder="Search by client, property, amount, or status...">
                                </div>
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
                                            <th class="text-uppercase small text-secondary fw-bold">Sale Amount</th>
                                            <th class="text-uppercase small text-secondary fw-bold">Commission Rate</th>
                                            <th class="text-uppercase small text-secondary fw-bold">Commission Amount</th>
                                            <th class="text-uppercase small text-secondary fw-bold">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr x-show="!filteredEarnings.length">
                                            <td colspan="7" class="text-center text-muted">No earnings found</td>
                                        </tr>
                                        <template x-for="earning in paginatedEarnings" :key="earning.id">
                                            <tr class="border-bottom">
                                                <td class="text-muted" x-text="formatDate(earning.earned_date)"></td>
                                                <td class="text-muted"
                                                    x-text="earning.sale && earning.sale.property ? earning.sale.property.name : 'N/A'">
                                                </td>
                                                <td class="text-muted"
                                                    x-text="earning.sale ? earning.sale.full_name : 'N/A'"></td>
                                                <td class="text-muted fw-bold"
                                                    x-text="formatCurrency(earning.sale_amount || 0)"></td>
                                                <td class="text-muted" x-text="earning.commission_rate + '%'"></td>
                                                <td class="text-muted fw-bold text-success"
                                                    x-text="formatCurrency(earning.commission_amount || 0)"></td>
                                                <td class="fw-semibold"
                                                    :class="{
                                                        'text-warning': earning.status === 'pending',
                                                        'text-success': earning.status === 'paid',
                                                        'text-danger': earning.status === 'cancelled'
                                                    }"
                                                    x-text="earning.status.charAt(0).toUpperCase() + earning.status.slice(1)">
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-between align-items-center mt-3"
                                    x-show="totalPages > 1">
                                    <div class="text-muted">
                                        Showing <span x-text="startIndex + 1"></span> to <span x-text="endIndex"></span>
                                        of <span x-text="filteredEarnings.length"></span> earnings
                                    </div>

                                    <div class="alpine-pagination d-flex align-items-center gap-2">
                                        <button class="page-btn" @click="goToPage(currentPage - 1)"
                                            :disabled="currentPage === 1">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>

                                        <template x-for="page in visiblePages" :key="page">
                                            <button class="page-btn" :class="{ 'active': page === currentPage }"
                                                @click="goToPage(page)" x-text="page">
                                            </button>
                                        </template>

                                        <button class="page-btn" @click="goToPage(currentPage + 1)"
                                            :disabled="currentPage === totalPages">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>

                                    <div class="d-flex align-items-center gap-2">
                                        <span class="text-muted">Show:</span>
                                        <select class="form-select form-select-sm" style="width: auto;"
                                            x-model="perPage" @change="currentPage = 1">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                        </select>
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
                                                :class="{
                                                    'fa-hourglass-half': sale.status === 'pending',
                                                    'fa-check-circle': sale.status === 'approved',
                                                    'fa-times-circle': sale.status === 'rejected'
                                                }"></i>
                                        </div>
                                        <div class="media-body transaction-details">
                                            <h6
                                                x-text="sale.status === 'pending' ? 'Pending Sale' : 
                                                      sale.status === 'approved' ? 'Approved Sale' : 'Rejected Sale'">
                                            </h6>
                                            <p
                                                x-text="(sale.property ? sale.property.name : 'N/A') + ' - ' + sale.full_name">
                                            </p>
                                            <p x-text="sale.email_address || 'No email provided'"></p>
                                            <p x-text="sale.phone_number || 'No phone provided'"></p>
                                        </div>
                                        <div class="transaction-amount">
                                            <h6 x-text="formatCurrency(sale.total_amount || 0)"></h6>
                                            <p x-text="formatDate(sale.created_at)"></p>
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
                properties: @json($properties ?? []),
                templates: @json($templates ?? []),
                selectedTemplate: '',
                sales: @json($sales ?? []),
                paymentPlans: @json($paymentPlans ?? []),
                selectedPaymentPlan: null,
                userTransactions: @json($userTransactions ?? []),
                earnings: @json($earnings ?? []), // Use earnings from controller Will be loaded from user transactions
                isLoading: false,
                // Client selection variables
                existingClients: [],
                existingClientSearch: '',
                showClientDropdown: false,
                selectedClient: null,
                salesFilters: {
                    fromDate: '',
                    toDate: '',
                    search: '', // Add search for sales table
                },
                filters: {
                    fromDate: '',
                    toDate: '',
                    search: '', // Add search for earnings table
                },
                form: {
                    // Client Type Selection
                    client_type: '',
                    existing_client_id: '',

                    // Personal Details
                    title: '',
                    title_other: '',
                    full_name: '',
                    gender: '',
                    date_of_birth: '',
                    marital_status: '',
                    marital_status_other: '',

                    // Occupational Details
                    occupation: '',
                    nationality: '',
                    state_of_origin: '',
                    lga: '',
                    hometown: '',

                    // Contact Information
                    residential_address: '',
                    phone_number: '',
                    email_address: '',

                    // Subscription Details
                    estate_id: '',
                    commercial_plots: '',
                    commercial_plots_other: '',
                    residential_plots: '',
                    residential_plots_other: '',

                    // Payment Plan
                    payment_mode: '',

                    // Next of Kin
                    next_of_kin_name: '',
                    next_of_kin_relationship: '',
                    next_of_kin_phone: '',
                    next_of_kin_email: '',
                    next_of_kin_address: '',

                    // Subscriber Type
                    subscriber_type: '',
                    organization_name: '',
                    signatories: [{
                            name: '',
                            position: '',
                            date: '',
                            signature: ''
                        },
                        {
                            name: '',
                            position: '',
                            date: '',
                            signature: ''
                        },
                        {
                            name: '',
                            position: '',
                            date: '',
                            signature: ''
                        }
                    ],

                    // Declaration
                    terms_accepted: false,
                    client_signature: '',
                    signature_date: '',

                    // Witness
                    witness_name: '',
                    witness_phone: '',
                    witness_email: '',
                    witness_address: '',
                    witness_signature: '',
                    witness_date: '',
                },
                errors: {},
                showForm: false,
                currentStep: 1,
                currentPage: 1,
                perPage: 5,
                salesCurrentPage: 1,
                salesPerPage: 10,

                init() {
                    console.log('Sales data loaded:', this.sales);
                    console.log('Earnings data loaded:', this.earnings);
                    console.log('User transactions loaded:', this.userTransactions);
                    // Set default dates
                    this.form.signature_date = new Date().toISOString().split('T')[0];
                    this.form.witness_date = new Date().toISOString().split('T')[0];
                    // Initialize signatory dates
                    this.form.signatories.forEach(signatory => {
                        signatory.date = new Date().toISOString().split('T')[0];
                    });
                    // Load templates from backend
                    this.loadTemplates();
                },

                // Real-time validation
                validateField(fieldName, value) {
                    const errors = {};

                    switch (fieldName) {
                        case 'title':
                            if (!value || value === '') {
                                errors[fieldName] = 'Title is required.';
                            }
                            break;
                        case 'full_name':
                            if (!value || value.trim().length < 2) {
                                errors[fieldName] = 'Full name must be at least 2 characters.';
                            } else if (!/^[a-zA-Z\s]+$/.test(value)) {
                                errors[fieldName] = 'Full name should only contain letters and spaces.';
                            }
                            break;
                        case 'gender':
                            if (!value) {
                                errors[fieldName] = 'Gender is required.';
                            }
                            break;
                        case 'phone_number':
                            if (!value) {
                                errors[fieldName] = 'Phone number is required.';
                            } else if (!/^[\+]?[0-9\s\-\(\)]{10,15}$/.test(value)) {
                                errors[fieldName] = 'Please enter a valid phone number.';
                            }
                            break;
                        case 'email_address':
                        case 'next_of_kin_email':
                        case 'witness_email':
                            if (value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                                errors[fieldName] = 'Please enter a valid email address.';
                            }
                            break;
                        case 'estate_id':
                            if (!value) {
                                errors[fieldName] = 'Please select an estate.';
                            }
                            break;
                        case 'payment_mode':
                            if (!value) {
                                errors[fieldName] = 'Please select a payment mode.';
                            }
                            break;
                        case 'subscriber_type':
                            if (!value) {
                                errors[fieldName] = 'Please select subscriber type.';
                            }
                            break;
                        case 'organization_name':
                            if (this.form.subscriber_type === 'Organization' && !value) {
                                errors[fieldName] = 'Organization name is required.';
                            }
                            break;
                        case 'terms_accepted':
                            if (!value) {
                                errors[fieldName] = 'You must accept the terms and conditions.';
                            }
                            break;
                        case 'client_signature':
                            if (!value) {
                                errors[fieldName] = 'Digital signature is required.';
                            }
                            break;
                        case 'signature_date':
                            if (!value) {
                                errors[fieldName] = 'Signature date is required.';
                            }
                            break;
                        case 'date_of_birth':
                            if (value) {
                                const today = new Date();
                                const birthDate = new Date(value);
                                const age = today.getFullYear() - birthDate.getFullYear();
                                if (age < 18) {
                                    errors[fieldName] = 'You must be at least 18 years old.';
                                } else if (age > 120) {
                                    errors[fieldName] = 'Please enter a valid birth date.';
                                }
                            }
                            break;
                    }

                    // Update errors object
                    if (errors[fieldName]) {
                        this.errors[fieldName] = errors[fieldName];
                    } else {
                        delete this.errors[fieldName];
                    }
                },

                validateSignatory(index, field, value) {
                    const signatoryErrors = this.errors.signatories || {};
                    if (!signatoryErrors[index]) signatoryErrors[index] = {};

                    if (!value || value.trim() === '') {
                        signatoryErrors[index][field] =
                            `${field} is required for signatory ${index + 1}.`;
                    } else {
                        delete signatoryErrors[index][field];
                        if (Object.keys(signatoryErrors[index]).length === 0) {
                            delete signatoryErrors[index];
                        }
                    }

                    this.errors.signatories = signatoryErrors;
                },

                isStepValid(step) {
                    switch (step) {
                        case 1:
                            // First check if client type is selected
                            if (!this.form.client_type) {
                                return false;
                            }

                            // For existing clients, just need client selection
                            if (this.form.client_type === 'existing') {
                                return this.form.existing_client_id && !this.errors.existing_client_id;
                            }

                            // For new clients, need personal details
                            return this.form.title && this.form.full_name && this.form.gender &&
                                !this.errors.title && !this.errors.full_name && !this.errors.gender &&
                                !this.errors.client_type;
                        case 2:
                            return true; // Optional fields
                        case 3:
                            return this.form.phone_number && !this.errors.phone_number &&
                                !this.errors.email_address;
                        case 4:
                            return this.form.estate_id && !this.errors.estate_id;
                        case 5:
                            return this.form.payment_mode && !this.errors.payment_mode;
                        case 6:
                            return true; // Optional fields
                        case 7:
                            if (this.form.subscriber_type === 'Organization') {
                                return this.form.organization_name && !this.errors.organization_name;
                            }
                            return this.form.subscriber_type && !this.errors.subscriber_type;
                        case 8:
                            return this.form.terms_accepted && this.form.client_signature &&
                                this.form.signature_date && !this.errors.terms_accepted &&
                                !this.errors.client_signature && !this.errors.signature_date;
                    }
                    return false;
                },

                nextStep() {
                    if (this.validateCurrentStep()) {
                        if (this.currentStep < 8) {
                            this.currentStep++;
                        }
                    }
                },

                previousStep() {
                    if (this.currentStep > 1) {
                        this.currentStep--;
                    }
                },

                validateCurrentStep() {
                    switch (this.currentStep) {
                        case 1:
                            // First check if client type is selected
                            if (!this.form.client_type) {
                                this.notify('Please select a client type.', 'error');
                                return false;
                            }

                            // For existing clients, just need client selection
                            if (this.form.client_type === 'existing') {
                                if (!this.form.existing_client_id) {
                                    this.notify('Please select an existing client.', 'error');
                                    return false;
                                }
                                return true;
                            }

                            // For new clients, need personal details
                            if (!this.form.full_name || !this.form.title || !this.form.gender) {
                                this.notify('Please fill in all required fields in Personal Details.',
                                    'error');
                                return false;
                            }
                            break;
                        case 3:
                            if (!this.form.phone_number) {
                                this.notify('Phone number is required.', 'error');
                                return false;
                            }
                            break;
                        case 4:
                            if (!this.form.estate_id) {
                                this.notify('Please select an estate.', 'error');
                                return false;
                            }
                            break;
                        case 8:
                            if (!this.form.terms_accepted) {
                                this.notify('Please accept the terms and conditions.', 'error');
                                return false;
                            }
                            break;
                    }
                    return true;
                },

                get filteredSales() {
                    let filtered = this.sales;

                    // Date filtering
                    if (this.salesFilters.fromDate) {
                        filtered = filtered.filter(sale => new Date(sale.created_at) >= new Date(
                            this.salesFilters.fromDate));
                    }
                    if (this.salesFilters.toDate) {
                        filtered = filtered.filter(sale => new Date(sale.created_at) <= new Date(
                            this.salesFilters.toDate));
                    }

                    // Search filtering
                    if (this.salesFilters.search) {
                        const searchTerm = this.salesFilters.search.toLowerCase();
                        filtered = filtered.filter(sale =>
                            sale.full_name?.toLowerCase().includes(searchTerm) ||
                            sale.email_address?.toLowerCase().includes(searchTerm) ||
                            sale.phone_number?.toLowerCase().includes(searchTerm) ||
                            sale.property?.name?.toLowerCase().includes(searchTerm) ||
                            sale.status?.toLowerCase().includes(searchTerm)
                        );
                    }

                    return filtered;
                },

                get filteredEarnings() {
                    let filtered = this.earnings;

                    // Date filtering
                    if (this.filters.fromDate) {
                        filtered = filtered.filter(earning => new Date(earning.earned_date) >=
                            new Date(this.filters.fromDate));
                    }
                    if (this.filters.toDate) {
                        filtered = filtered.filter(earning => new Date(earning.earned_date) <=
                            new Date(this.filters.toDate));
                    }

                    // Search filtering
                    if (this.filters.search) {
                        const searchTerm = this.filters.search.toLowerCase();
                        filtered = filtered.filter(earning =>
                            earning.sale?.full_name?.toLowerCase().includes(searchTerm) ||
                            earning.sale?.property?.name?.toLowerCase().includes(searchTerm) ||
                            earning.status?.toLowerCase().includes(searchTerm) ||
                            earning.commission_amount?.toString().includes(searchTerm) ||
                            earning.sale_amount?.toString().includes(searchTerm)
                        );
                    }

                    return filtered;
                },

                get paginatedSales() {
                    const start = (this.salesCurrentPage - 1) * this.salesPerPage;
                    const end = start + this.salesPerPage;
                    return this.filteredSales.slice(start, end);
                },

                get paginatedEarnings() {
                    const start = (this.currentPage - 1) * this.perPage;
                    const end = start + this.perPage;
                    return this.filteredEarnings.slice(start, end);
                },

                get recentTransactions() {
                    return this.filteredSales.slice(0, 4);
                },

                get salesStartIndex() {
                    return (this.salesCurrentPage - 1) * this.salesPerPage;
                },

                get salesEndIndex() {
                    return Math.min(this.salesStartIndex + this.salesPerPage, this.filteredSales
                        .length);
                },

                get startIndex() {
                    return (this.currentPage - 1) * this.perPage;
                },

                get endIndex() {
                    return Math.min(this.startIndex + this.perPage, this.filteredEarnings.length);
                },

                get totalEarnings() {
                    return this.earnings.reduce((total, earning) => {
                        if (earning.status === 'approved' || earning.status === 'paid') {
                            return total + parseFloat(earning.commission_amount || 0);
                        }
                        return total;
                    }, 0);
                },

                get thisMonthEarnings() {
                    const currentMonth = new Date().getMonth();
                    const currentYear = new Date().getFullYear();

                    return this.earnings.reduce((total, earning) => {
                        if (earning.status === 'approved' || earning.status === 'paid') {
                            const earningDate = new Date(earning.earned_date);
                            if (earningDate.getMonth() === currentMonth &&
                                earningDate.getFullYear() === currentYear) {
                                return total + parseFloat(earning.commission_amount || 0);
                            }
                        }
                        return total;
                    }, 0);
                },

                get pendingSales() {
                    return this.sales.reduce((total, sale) => {
                        if (sale.status === 'pending') {
                            return total + parseFloat(sale.total_amount || 0);
                        }
                        return total;
                    }, 0);
                },

                get completedSales() {
                    return this.sales.filter(sale => sale.status === 'approved' || sale.status ===
                        'completed').length;
                },

                get totalPages() {
                    return Math.ceil(this.filteredEarnings.length / this.perPage);
                },

                get salesTotalPages() {
                    return Math.ceil(this.filteredSales.length / this.salesPerPage);
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

                get salesVisiblePages() {
                    const totalPages = this.salesTotalPages;
                    const currentPage = this.salesCurrentPage;
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

                formatCurrency(value) {
                    return '₦' + Number(value).toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                },

                formatDate(date) {
                    return new Date(date).toISOString().split('T')[0];
                },

                resetWizard() {
                    if (this.isFormPartiallyFilled()) {
                        if (!confirm(
                                'Are you sure you want to reset the form? All entered data will be lost.'
                            )) {
                            return;
                        }
                    }
                    this.resetForm();
                    this.showForm = false;
                    this.notify('Form has been reset', 'info');
                },

                resetForm() {
                    this.form = {
                        // Client Type Selection
                        client_type: '',
                        existing_client_id: '',

                        // Personal Details
                        title: '',
                        title_other: '',
                        full_name: '',
                        gender: '',
                        date_of_birth: '',
                        marital_status: '',
                        marital_status_other: '',

                        // Occupational Details
                        occupation: '',
                        nationality: '',
                        state_of_origin: '',
                        lga: '',
                        hometown: '',

                        // Contact Information
                        residential_address: '',
                        phone_number: '',
                        email_address: '',

                        // Subscription Details
                        estate_id: '',
                        commercial_plots: '',
                        commercial_plots_other: '',
                        residential_plots: '',
                        residential_plots_other: '',

                        // Payment Plan
                        payment_mode: '',

                        // Next of Kin
                        next_of_kin_name: '',
                        next_of_kin_relationship: '',
                        next_of_kin_phone: '',
                        next_of_kin_email: '',
                        next_of_kin_address: '',

                        // Subscriber Type
                        subscriber_type: '',
                        organization_name: '',
                        signatories: [{
                                name: '',
                                position: '',
                                date: '',
                                signature: ''
                            },
                            {
                                name: '',
                                position: '',
                                date: '',
                                signature: ''
                            },
                            {
                                name: '',
                                position: '',
                                date: '',
                                signature: ''
                            }
                        ],

                        // Declaration
                        terms_accepted: false,
                        client_signature: '',
                        signature_date: new Date().toISOString().split('T')[0],

                        // Witness
                        witness_name: '',
                        witness_phone: '',
                        witness_email: '',
                        witness_address: '',
                        witness_signature: '',
                        witness_date: new Date().toISOString().split('T')[0],
                    };
                    this.currentStep = 1;

                    // Reset client selection variables
                    this.clearExistingClient();
                    this.selectedClient = null;
                    this.existingClients = [];
                    this.existingClientSearch = '';
                    this.showClientDropdown = false;

                    // Reset payment plan selection
                    this.selectedPaymentPlan = null;
                },

                // Client selection methods
                handleClientTypeChange() {
                    if (this.form.client_type === 'new') {
                        this.clearExistingClient();
                    } else if (this.form.client_type === 'existing') {
                        this.clearNewClientData();
                    }
                },

                async searchExistingClients() {
                    if (this.existingClientSearch.length < 2) {
                        this.existingClients = [];
                        this.showClientDropdown = false;
                        return;
                    }

                    try {
                        const response = await fetch(
                            `{{ route('tenant.realtor.clients.search') }}?q=${encodeURIComponent(this.existingClientSearch)}`, {
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            });

                        if (response.ok) {
                            const data = await response.json();
                            this.existingClients = data.clients || [];
                            this.showClientDropdown = this.existingClients.length > 0;
                        }
                    } catch (error) {
                        console.error('Error searching clients:', error);
                        this.existingClients = [];
                        this.showClientDropdown = false;
                    }
                },

                selectExistingClient(client) {
                    this.selectedClient = client;
                    this.form.existing_client_id = client.id;
                    this.existingClientSearch = client.name;
                    this.showClientDropdown = false;
                    this.existingClients = [];

                    // Auto-populate all personal details from the existing client
                    this.form.title = client.title || '';
                    this.form.title_other = client.title_other || '';
                    this.form.full_name = client.name || '';
                    this.form.gender = client.gender || '';
                    this.form.date_of_birth = client.date_of_birth || '';
                    this.form.marital_status = client.marital_status || '';
                    this.form.marital_status_other = client.marital_status_other || '';
                    this.form.occupation = client.occupation || '';
                    this.form.nationality = client.nationality || '';
                    this.form.state_of_origin = client.state_of_origin || '';
                    this.form.lga = client.lga || '';
                    this.form.hometown = client.hometown || '';
                    this.form.residential_address = client.residential_address || '';
                    this.form.phone_number = client.phone || '';
                    this.form.email_address = client.email || '';

                    // Clear validation errors for personal detail fields
                    delete this.errors.existing_client_id;
                    delete this.errors.title;
                    delete this.errors.full_name;
                    delete this.errors.gender;
                    delete this.errors.phone_number;
                    delete this.errors.email_address;
                },

                clearExistingClient() {
                    this.selectedClient = null;
                    this.form.existing_client_id = '';
                    this.existingClientSearch = '';
                    this.showClientDropdown = false;
                    this.existingClients = [];

                    // Clear auto-populated personal details
                    this.form.title = '';
                    this.form.title_other = '';
                    this.form.full_name = '';
                    this.form.gender = '';
                    this.form.date_of_birth = '';
                    this.form.marital_status = '';
                    this.form.marital_status_other = '';
                    this.form.occupation = '';
                    this.form.nationality = '';
                    this.form.state_of_origin = '';
                    this.form.lga = '';
                    this.form.hometown = '';
                    this.form.residential_address = '';
                    this.form.phone_number = '';
                    this.form.email_address = '';
                },

                clearNewClientData() {
                    // Clear personal details for new clients
                    this.form.title = '';
                    this.form.title_other = '';
                    this.form.full_name = '';
                    this.form.gender = '';
                    this.form.date_of_birth = '';
                    this.form.marital_status = '';
                    this.form.marital_status_other = '';
                    this.form.occupation = '';
                    this.form.nationality = '';
                    this.form.state_of_origin = '';
                    this.form.lga = '';
                    this.form.hometown = '';
                    this.form.residential_address = '';
                    this.form.phone_number = '';
                    this.form.email_address = '';
                },

                async submitSale() {
                    if (!this.validateCurrentStep()) {
                        return;
                    }

                    this.isLoading = true;

                    try {
                        const response = await fetch('{{ route('tenant.realtor.sales.store') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify(this.form)
                        });

                        const result = await response.json();

                        if (result.success) {
                            // Add the new sale to the beginning of the sales array
                            this.sales.unshift(result.sale);

                            // If the sale has earnings, add them to the earnings array
                            if (result.sale.earnings && result.sale.earnings.length > 0) {
                                result.sale.earnings.forEach(earning => {
                                    this.earnings.unshift(earning);
                                });
                            }

                            this.resetForm();
                            this.showForm = false;
                            this.notify(result.message || 'Sale registered successfully!');
                        } else {
                            if (result.errors) {
                                this.errors = result.errors;
                                this.notify('Please fix the validation errors.', 'error');
                            } else {
                                this.notify(result.message ||
                                    'An error occurred while processing your request.', 'error');
                            }
                        }
                    } catch (error) {
                        console.error('Error submitting sale:', error);
                        this.notify(
                            'An error occurred while submitting the form. Please try again.',
                            'error');
                    } finally {
                        this.isLoading = false;
                    }
                },

                exportData() {
                    this.notify('Export earnings functionality not implemented yet.', 'info');
                },

                exportSalesData() {
                    this.notify('Export sales functionality not implemented yet.', 'info');
                },

                // Backend API methods
                async loadTemplates() {
                    try {
                        const response = await fetch(
                            '{{ route('tenant.realtor.sales.templates') }}', {
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            });

                        const result = await response.json();
                        if (result.success) {
                            this.templates = result.templates;
                        }
                    } catch (error) {
                        console.error('Error loading templates:', error);
                    }
                },

                async loadPaymentPlans() {
                    try {
                        const response = await fetch('/api/payment-plans', {
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });

                        const result = await response.json();
                        if (result.success) {
                            this.paymentPlans = result.payment_plans;
                        }
                    } catch (error) {
                        console.error('Error loading payment plans:', error);
                        // Fallback to hardcoded data if API fails
                        this.paymentPlans = [{
                                id: 1,
                                name: 'One-off Outright Payment',
                                code: 'outright',
                                description: 'Full payment made immediately with no additional charges.',
                                duration_months: 0,
                                interest_rate: 0,
                                installments_count: 1,
                                down_payment_percentage: 100
                            },
                            {
                                id: 2,
                                name: '3 Months Outright',
                                code: '3_months',
                                description: 'Payment to be completed within 3 months with no additional charges.',
                                duration_months: 3,
                                interest_rate: 0,
                                installments_count: 1,
                                down_payment_percentage: 0
                            },
                            {
                                id: 3,
                                name: '6 Months Installment (10% Extra)',
                                code: '6_months',
                                description: '6-month installment plan with 10% additional charge on total price.',
                                duration_months: 6,
                                interest_rate: 10,
                                installments_count: 6,
                                down_payment_percentage: 20
                            },
                            {
                                id: 4,
                                name: '1 Year Installment (20% Extra)',
                                code: '12_months',
                                description: '12-month installment plan with 20% additional charge on total price.',
                                duration_months: 12,
                                interest_rate: 20,
                                installments_count: 12,
                                down_payment_percentage: 15
                            }
                        ];
                    }
                },

                onPaymentPlanChange() {
                    this.selectedPaymentPlan = this.paymentPlans.find(plan =>
                        plan.code === this.form.payment_mode ||
                        plan.name === this.form.payment_mode ||
                        plan.id == this.form.payment_mode
                    );
                },

                async saveAsTemplate() {
                    // Get template name from user
                    const templateName = prompt('Enter a name for this template:');
                    if (!templateName) return;

                    // Check if user already has 3 templates
                    const userTemplates = this.templates.filter(t => t.user_id);
                    if (userTemplates.length >= 3) {
                        this.notify(
                            'You can only have maximum 3 templates. Please delete an existing template first.',
                            'error');
                        return;
                    }

                    this.isLoading = true;

                    try {
                        const templateData = {
                            ...this.form
                        };
                        // Remove sensitive/dynamic data
                        delete templateData.signature_date;
                        delete templateData.witness_date;
                        delete templateData.terms_accepted;
                        delete templateData.client_signature;
                        delete templateData.witness_signature;

                        // Clear signatory dates
                        if (templateData.signatories) {
                            templateData.signatories.forEach(signatory => {
                                signatory.date = '';
                                signatory.signature = '';
                            });
                        }

                        const response = await fetch(
                            '{{ route('tenant.realtor.sales.templates.store') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    name: templateName,
                                    description: `Template created on ${new Date().toLocaleDateString()}`,
                                    template_data: templateData
                                })
                            });

                        const result = await response.json();

                        if (result.success) {
                            this.templates.push(result.template);
                            this.notify(result.message ||
                                `Template "${templateName}" saved successfully!`, 'success');
                        } else {
                            this.notify(result.message || 'Failed to save template.', 'error');
                        }
                    } catch (error) {
                        console.error('Error saving template:', error);
                        this.notify('An error occurred while saving the template.', 'error');
                    } finally {
                        this.isLoading = false;
                    }
                },

                async deleteTemplate() {
                    if (!this.selectedTemplate) {
                        this.notify('Please select a template to delete', 'error');
                        return;
                    }

                    const template = this.templates.find(t => t.id == this.selectedTemplate);
                    if (!template) return;

                    if (!confirm(
                            `Are you sure you want to delete the template "${template.name}"?`)) {
                        return;
                    }

                    this.isLoading = true;

                    try {
                        const response = await fetch(`/realtor/sales/templates/${template.id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        });

                        const result = await response.json();

                        if (result.success) {
                            this.templates = this.templates.filter(t => t.id != template.id);
                            this.selectedTemplate = '';
                            this.notify(result.message ||
                                `Template "${template.name}" deleted successfully!`, 'success');
                        } else {
                            this.notify(result.message || 'Failed to delete template.', 'error');
                        }
                    } catch (error) {
                        console.error('Error deleting template:', error);
                        this.notify('An error occurred while deleting the template.', 'error');
                    } finally {
                        this.isLoading = false;
                    }
                },
                applyTemplate(templateId) {
                    if (!templateId) return;

                    const template = this.templates.find(t => t.id == templateId);
                    if (!template) return;

                    // Force client type to 'new' when applying template
                    this.form.client_type = 'new';

                    // Clear existing client selection
                    this.clearExistingClient();

                    // Apply template data to form
                    const templateData = template.template_data || template.data;
                    Object.keys(templateData).forEach(key => {
                        if (this.form.hasOwnProperty(key)) {
                            this.form[key] = templateData[key];
                        }
                    });

                    // Ensure client_type remains 'new' after applying template data
                    this.form.client_type = 'new';
                    this.form.existing_client_id = '';

                    // Set current dates for signature fields
                    const today = new Date().toISOString().split('T')[0];
                    this.form.signature_date = today;
                    this.form.witness_date = today;

                    // Update signatory dates if organization template
                    if (templateData.subscriber_type === 'Organization') {
                        this.form.signatories.forEach(signatory => {
                            signatory.date = today;
                        });
                    }

                    // Clear any existing errors
                    this.errors = {};

                    this.notify(
                        `Template "${template.name}" applied successfully! Client type set to new client.`,
                        'success');
                },

                clearTemplate() {
                    this.selectedTemplate = '';
                    this.notify('Template selection cleared', 'info');
                },

                isFormPartiallyFilled() {
                    return this.form.full_name || this.form.phone_number || this.form.email_address ||
                        this.form.estate_id;
                },

                notify(msg, type = 'success') {
                    toastr[type](msg);
                },

                // Pagination methods for earnings
                goToPage(page) {
                    this.currentPage = page;
                },

                previousPage() {
                    if (this.currentPage > 1) {
                        this.currentPage--;
                    }
                },

                nextPage() {
                    if (this.currentPage < this.totalPages) {
                        this.currentPage++;
                    }
                },

                // Sales pagination methods
                goToSalesPage(page) {
                    this.salesCurrentPage = page;
                },

                salesPreviousPage() {
                    if (this.salesCurrentPage > 1) {
                        this.salesCurrentPage--;
                    }
                },

                salesNextPage() {
                    if (this.salesCurrentPage < this.salesTotalPages) {
                        this.salesCurrentPage++;
                    }
                },
            }));
        });
    </script>
@endpush
