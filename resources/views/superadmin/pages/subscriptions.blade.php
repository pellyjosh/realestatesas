@extends('superadmin.layouts.super-admin_master')
@section('title', 'Subscriptions and Billing')
@section('content')
    <!-- Main Content -->
    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h2>Subscriptions and Billing
                        <small>Manage all client subscriptions, usage, invoices, and payment details</small>
                    </h2>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 text-md-right">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('superadmin.index') }}"><i class="zmdi zmdi-home"></i> SuperAdmin</a>
                        </li>
                        <li class="breadcrumb-item active">Subscriptions and Billing</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Subscription Overview Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Client</strong> Subscriptions</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Client Name</th>
                                            <th>Domain</th>
                                            <th>Current Plan</th>
                                            <th>Status</th>
                                            <th>Usage</th>
                                            <th>Renewal Date</th>
                                            <th>Amount</th>
                                            <th>Next Billing</th>
                                            <th>Payment Method</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Sunnytown Realty</td>
                                            <td>sunnytown.hublox.com</td>
                                            <td>Pro Plan</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td>35/50 Listings</td>
                                            <td>August 12, 2025</td>
                                            <td>$99.00</td>
                                            <td>August 13, 2025</td>
                                            <td>Visa ****1234</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary">Edit</button>
                                                <button class="btn btn-sm btn-danger">Cancel</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Billing History Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Billing</strong> History</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered js-basic-example dataTable table-hover">
                                    <thead>
                                        <tr>
                                            <th>Invoice ID</th>
                                            <th>Client</th>
                                            <th>Date</th>
                                            <th>Plan</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Receipt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>INV-1010</td>
                                            <td>Sunnytown Realty</td>
                                            <td>July 13, 2025</td>
                                            <td>Pro Plan</td>
                                            <td>$99.00</td>
                                            <td><span class="badge bg-success">Paid</span></td>
                                            <td><a href="#" class="btn btn-sm btn-info">Download</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Plan Management Section -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header d-flex justify-content-between align-items-center">
                            <h2><strong>Available</strong> Plans</h2>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addPlanModal">Add
                                Plan</button>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Plan Name</th>
                                            <th>Price</th>
                                            <th>Max Listings</th>
                                            <th>Team Members</th>
                                            <th>Custom Domain</th>
                                            <th>Analytics</th>
                                            <th>Support</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Starter</td>
                                            <td>$0</td>
                                            <td>5</td>
                                            <td>1</td>
                                            <td>No</td>
                                            <td>Basic</td>
                                            <td>Email</td>
                                            <td><span class="badge bg-info">Free</span></td>
                                            <td><button class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#editPlanModal">Edit</button></td>
                                        </tr>
                                        <tr>
                                            <td>Pro Plan</td>
                                            <td>$99</td>
                                            <td>50</td>
                                            <td>10</td>
                                            <td>Yes</td>
                                            <td>Advanced</td>
                                            <td>Priority</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td><button class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#editPlanModal">Edit</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Settings -->
            <div class="row clearfix">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Payment</strong> Information</h2>
                        </div>
                        <div class="body">
                            <p>This platform does not store or manage client payment methods directly.</p>
                            <p>All subscription payments are made by clients to Hublox via trusted gateways like Paystack,
                                Flutterwave, or direct bank transfer.</p>
                            <hr>
                            <h6>Need help with billing?</h6>
                            <p>Email: billing@hublox.com<br>Phone: +234 800 000 0000</p>
                        </div>
                    </div>
                </div>

                <!-- Notifications -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Billing</strong> Notifications</h2>
                        </div>
                        <div class="body">
                            <ul>
                                <li>Email reminder 7 days before renewal</li>
                                <li>Invoice sent to admin@example.com</li>
                                <li>Payment failure alerts enabled</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Add Plan Modal -->
    <div class="modal fade" id="addPlanModal" tabindex="-1" role="dialog" aria-labelledby="addPlanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPlanModalLabel">Add New Plan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group"><label>Plan Name</label><input type="text" class="form-control" required>
                        </div>
                        <div class="form-group"><label>Price</label><input type="number" class="form-control" required>
                        </div>
                        <div class="form-group"><label>Max Listings</label><input type="number" class="form-control"
                                required></div>
                        <div class="form-group"><label>Team Members</label><input type="number" class="form-control"
                                required></div>
                        <div class="form-group">
                            <label for="customDomain">Custom Domain</label>
                            <div class="dropdown">
                                <button class="form-control dropdown-toggle text-left" type="button" id="customDomainDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select Option
                                </button>
                                <div class="dropdown-menu" aria-labelledby="customDomainDropdown">
                                    <a class="dropdown-item" href="#" data-value="Yes">Yes</a>
                                    <a class="dropdown-item" href="#" data-value="No">No</a>
                                </div>
                                <input type="hidden" id="customDomain" name="custom_domain" required>
                            </div>
                        </div>
                        <div class="form-group"><label>Analytics</label><input type="text" class="form-control"></div>
                        <div class="form-group"><label>Support</label><input type="text" class="form-control"></div>
                        <div class="form-group">
                            <label for="planStatus">Status</label>
                            <div class="dropdown">
                                <button class="form-control dropdown-toggle text-left" type="button" id="planStatusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select Status
                                </button>
                                <div class="dropdown-menu" aria-labelledby="planStatusDropdown">
                                    <a class="dropdown-item" href="#" data-value="Active">Active</a>
                                    <a class="dropdown-item" href="#" data-value="Inactive">Inactive</a>
                                </div>
                                <input type="hidden" id="planStatus" name="status" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Plan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Plan Modal -->
    <div class="modal fade" id="editPlanModal" tabindex="-1" role="dialog" aria-labelledby="editPlanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPlanModalLabel">Edit Plan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group"><label>Plan Name</label><input type="text" class="form-control"
                                value="Pro Plan" required></div>
                        <div class="form-group"><label>Price</label><input type="number" class="form-control"
                                value="99" required></div>
                        <div class="form-group"><label>Max Listings</label><input type="number" class="form-control"
                                value="50" required></div>
                        <div class="form-group"><label>Team Members</label><input type="number" class="form-control"
                                value="10" required></div>
                        <div class="form-group">
                            <label for="customDomainEdit">Custom Domain</label>
                            <div class="dropdown">
                                <button class="form-control dropdown-toggle text-left" type="button" id="customDomainDropdownEdit" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select Option
                                </button>
                                <div class="dropdown-menu" aria-labelledby="customDomainDropdownEdit">
                                    <a class="dropdown-item" href="#" data-value="Yes">Yes</a>
                                    <a class="dropdown-item" href="#" data-value="No">No</a>
                                </div>
                                <input type="hidden" id="customDomainEdit" name="custom_domain" required>
                            </div>
                        </div>
                        <div class="form-group"><label>Analytics</label><input type="text" class="form-control"
                                value="Advanced"></div>
                        <div class="form-group"><label>Support</label><input type="text" class="form-control"
                                value="Priority"></div>
                        <div class="form-group">
                            <label for="planStatusEdit">Status</label>
                            <div class="dropdown">
                                <button class="form-control dropdown-toggle text-left" type="button" id="planStatusDropdownEdit" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select Status
                                </button>
                                <div class="dropdown-menu" aria-labelledby="planStatusDropdownEdit">
                                    <a class="dropdown-item" href="#" data-value="Active">Active</a>
                                    <a class="dropdown-item" href="#" data-value="Inactive">Inactive</a>
                                </div>
                                <input type="hidden" id="planStatusEdit" name="status" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Plan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
