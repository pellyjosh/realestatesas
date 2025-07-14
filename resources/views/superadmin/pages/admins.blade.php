@extends('superadmin.layouts.super-admin_master')
@section('title', ' Admins')
@section('content')
    <!-- Main Content -->
    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Admin Management
                        <small>Manage Hublox system administrators, roles, and privileges</small>
                    </h2>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 text-md-right">
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>System</strong> Admins</h2>
                        </div>
                        <div class="body">
                            <div class="text-right mb-3">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#addAdminModal">Add
                                    Admin</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Date Added</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Jane Doe</td>
                                            <td>jane@hublox.com</td>
                                            <td>Super Admin</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td>2025-07-01</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-warning me-1" title="Suspend"><i
                                                        class="fas fa-circle-pause"></i></a>
                                                <a href="#" class="btn btn-sm btn-success me-1" title="Activate"><i
                                                        class="fas fa-circle-play"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger" title="View"
                                                    onclick="confirm('Are you sure you want to delete this admin?')"><i
                                                        class="fas fa-trash"></i></a>
                                                <a href="{{ route('superadmin.profile') }}" class="btn btn-sm btn-info" title="View"><i
                                                        class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>John Smith</td>
                                            <td>john@hublox.com</td>
                                            <td>Support</td>
                                            <td><span class="badge bg-warning">Pending</span></td>
                                            <td>2025-06-25</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-warning me-1" title="Suspend"><i
                                                        class="fas fa-circle-pause"></i></a>
                                                <a href="#" class="btn btn-sm btn-success me-1" title="Activate"><i
                                                        class="fas fa-circle-play"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger" title="View"
                                                    onclick="confirm('Are you sure you want to delete this admin?')"><i
                                                        class="fas fa-trash"></i></a>
                                                <a href="{{ route('superadmin.profile') }}" class="btn btn-sm btn-info" title="View"><i
                                                        class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        <!-- Add more admins as needed -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Roles and Privileges -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Roles</strong> & Privileges</h2>
                        </div>
                        <div class="body">
                            <div class="text-right mb-3">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#addRoleModal">Add
                                    Role</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped js-basic-example dataTable table-hover">
                                    <thead>
                                        <tr>
                                            <th>Role</th>
                                            <th>Privileges</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Super Admin</td>
                                            <td>All Access, Manage Admins, Full Billing Control</td>
                                            <td><button class="btn btn-sm btn-secondary">Edit</button></td>
                                        </tr>
                                        <tr>
                                            <td>Support</td>
                                            <td>View Clients, Respond to Tickets, Limited Settings Access</td>
                                            <td><button class="btn btn-sm btn-secondary">Edit</button></td>
                                        </tr>
                                        <tr>
                                            <td>Billing Manager</td>
                                            <td>View & Manage Invoices, Update Payment Records</td>
                                            <td><button class="btn btn-sm btn-secondary">Edit</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Add Admin Modal -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="addAdminModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="addAdminForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAdminModalLabel">Add New Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="adminName">Name</label>
                            <input type="text" class="form-control" id="adminName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="adminEmail">Email</label>
                            <input type="email" class="form-control" id="adminEmail" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="adminRole">Role</label>
                            <div class="dropdown">
                                <button class="form-control dropdown-toggle btn-block text-left" type="button"
                                    id="adminRoleDropdown" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Select Role
                                </button>
                                <div class="dropdown-menu" aria-labelledby="adminRoleDropdown">
                                    <a class="dropdown-item" href="#" data-value="superadmin">Super Admin</a>
                                    <a class="dropdown-item" href="#" data-value="support">Support</a>
                                    <a class="dropdown-item" href="#" data-value="billingmanager">Billing
                                        Manager</a>
                                    <!-- Add more roles as needed -->
                                </div>
                                <input type="hidden" id="adminRole" name="role" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="adminPassword">Password</label>
                            <input type="password" class="form-control" id="adminPassword" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Add Admin</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Add Role Modal -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" role="dialog" aria-labelledby="addRoleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRoleModalLabel">Add New Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="roleName">Role Name</label>
                            <input type="text" class="form-control" id="roleName" required>
                        </div>
                        <div class="form-group">
                            <label for="rolePrivileges">Privileges</label>
                            <textarea class="form-control" id="rolePrivileges" rows="3" placeholder="Separate privileges with commas"
                                required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Role</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
