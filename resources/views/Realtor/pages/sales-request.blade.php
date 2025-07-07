@extends('realtor.realtor_master')
@section('title', 'Sales Request | Premium Refined Luxury Homes')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-sm-6">
            <div class="page-header-left">
                <h3>Sales Request
                    <small>Welcome to realtor panel</small>
                </h3>
            </div>
        </div>
        <div class="col-sm-6">

            <!-- Breadcrumb start -->
            <ol class="breadcrumb pull-right">
                <li class="breadcrumb-item">
                    <a href="{{ route("realtor.dashboard") }}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item active">Sales Request</li>
            </ol>
            <!-- Breadcrumb end -->

        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Submit Offline Property Sale Request</h5>
            </div>
            <div class="card-body">
                <style>
                    .sales-request-form {
                        max-width: 900px;
                        margin: 0 auto;
                        border-radius: 12px;
                        border-radius: 12px;
                        padding: 25px;
                        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
                    }
                    .form-group label {
                        font-weight: 600;
                        color: #333;
                        margin-bottom: 8px;
                        display: flex;
                        align-items: center;
                    }
                    .form-group label span.required {
                        color: #ff4d4d;
                        margin-left: 5px;
                        font-size: 0.9em;
                    }
                    .form-control, .form-select {
                        background-color: #fff;
                        color: #333;
                        border-radius: 8px;
                        padding: 12px 15px;
                        font-size: 0.95rem;
                        transition: all 0.3s ease;
                    }
                    .form-control:focus, .form-select:focus {
                        border-color: #91d20a;
                        box-shadow: 0 0 0 0.2rem rgba(145, 210, 10, 0.25);
                        outline: none;
                    }
                    .form-select {
                        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2391d20a' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
                        background-repeat: no-repeat;
                        background-position: right 0.75rem center;
                        background-size: 18px 14px;
                        cursor: pointer;
                        /* Attempt to force dropdown to appear below */
                        direction: ltr;
                    }
                    .form-select-container {
                        position: relative;
                        display: inline-block;
                        background-color: #fff;
                        color: #333;
                        padding: 12px 15px;
                        font-size: 0.95rem;
                        border-bottom: 1px solid #ddd;
                        transition: all 0.2s ease;
                    }
                    .form-select option:hover {
                        background-color: #d9ead3;
                        color: #6a9a08;
                        padding-left: 25px;
                        box-shadow: inset 3px 0 0 #91d20a;
                    }
                    .form-select option[selected] {
                        background-color: #c9e0b1;
                        color: #517306;
                        font-weight: 700;
                        box-shadow: inset 3px 0 0 #91d20a;
                    }
                    .btn-submit {
                        background-color: #91d20a;
                        color: #fff;
                        border-color: #91d20a;
                        padding: 12px 25px;
                        font-size: 1rem;
                        font-weight: 600;
                        border-radius: 8px;
                        transition: all 0.3s ease;
                    }
                    .btn-submit:hover {
                        background-color: #7eb009;
                        border-color: #7eb009;
                        transform: translateY(-2px);
                    }
                    .card-body {
                        padding: 30px;
                    }
                    .form-row {
                        display: flex;
                        flex-wrap: wrap;
                        gap: 20px;
                    }
                    .form-row .form-group {
                        flex: 1;
                        min-width: 300px;
                    }
                    textarea.form-control {
                        min-height: 100px;
                    }
                </style>
                <form class="sales-request-form">
                    <div class="form-row">
                        <div class="mb-3 form-group">
                            <label for="clientName">Client Full Name <span class="required">*</span></label>
                            <input type="text" class="form-control" id="clientName" placeholder="Enter client's full name" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="clientEmail">Client Email <span class="required">*</span></label>
                            <input type="email" class="form-control" id="clientEmail" placeholder="Enter client's email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="mb-3 form-group">
                            <label for="clientPhone">Client Phone Number <span class="required">*</span></label>
                            <input type="tel" class="form-control" id="clientPhone" placeholder="Enter client's phone number" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="propertySold">Property Sold <span class="required">*</span></label>
                            <select class="form-select" id="propertySold" required>
                                <option value="" disabled selected>Select a property</option>
                                <option value="luxury-villa-101">Luxury Villa #101</option>
                                <option value="office-space-202">Office Space #202</option>
                                <option value="suburban-home-303">Suburban Home #303</option>
                                <option value="retail-unit-404">Retail Unit #404</option>
                                <option value="condo-505">Condo #505</option>
                                <option value="beachfront-condo-606">Beachfront Condo #606</option>
                                <option value="penthouse-suite-707">Penthouse Suite #707</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="mb-3 form-group">
                            <label for="salePrice">Sale Price <span class="required">*</span></label>
                            <input type="number" class="form-control" id="salePrice" placeholder="Enter sale price" step="0.01" min="0" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="commissionRate">Commission Rate (%) <span class="required">*</span></label>
                            <input type="number" class="form-control" id="commissionRate" placeholder="Enter commission rate" step="0.1" min="0" max="100" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="mb-3 form-group">
                            <label for="saleDate">Date of Sale <span class="required">*</span></label>
                            <input type="date" class="form-control" id="saleDate" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="commissionType">Commission Type <span class="required">*</span></label>
                            <select class="form-select" id="commissionType" required>
                                <option value="" disabled selected>Select commission type</option>
                                <option value="residential">Residential</option>
                                <option value="commercial">Commercial</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="additionalNotes">Additional Notes (Optional)</label>
                        <textarea class="form-control" id="additionalNotes" rows="3" placeholder="Enter any additional notes or comments"></textarea>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-submit">Submit Sales Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5>Recent Sales Requests</h5>
            </div>
            <div class="card-body">
                <style>
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
                </style>
                <div class="transaction-list">
                    <div class="transaction-item">
                        <div class="media">
                            <div class="transaction-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="media-body transaction-details">
                                <h6>Sales Request Submitted</h6>
                                <p>Luxury Villa #101 - Alice Johnson</p>
                            </div>
                            <div class="transaction-amount">
                                <h6>#45,000.00</h6>
                                <p>2025-06-10</p>
                            </div>
                        </div>
                    </div>
                    <div class="transaction-item pending">
                        <div class="media">
                            <div class="transaction-icon">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                            <div class="media-body transaction-details">
                                <h6>Pending Review</h6>
                                <p>Office Space #202 - Bob Smith</p>
                            </div>
                            <div class="transaction-amount">
                                <h6>#50,000.00</h6>
                                <p>2025-05-15</p>
                            </div>
                        </div>
                    </div>
                    <div class="transaction-item">
                        <div class="media">
                            <div class="transaction-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="media-body transaction-details">
                                <h6>Sales Request Submitted</h6>
                                <p>Suburban Home #303 - Carol White</p>
                            </div>
                            <div class="transaction-amount">
                                <h6>#26,250.00</h6>
                                <p>2025-04-20</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
