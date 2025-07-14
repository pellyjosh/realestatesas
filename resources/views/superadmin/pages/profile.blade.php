@extends('superadmin.layouts.super-admin_master')
@section('title', 'Profile')
@section('content')
    <!-- Admin Profile Page -->
    <section class="content mt-4">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Admin Profile</h2>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="body text-center">
                            <img src="{{ asset('superadmin/assets/images/profile_av.jpg') }}" class="rounded-circle mb-3"
                                width="120" height="120" alt="Admin Avatar">
                            <h5 class="mb-0">Jane Doe</h5>
                            <small class="text-muted">Super Admin</small>
                            <p class="mt-3">jane.doe@hublox.com</p>
                            <a href="#" class="btn btn-primary btn-sm">Edit Profile</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Account</strong> Details</h2>
                        </div>
                        <div class="body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" value="Jane Doe" disabled>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Email Address</label>
                                        <input type="email" class="form-control" value="jane.doe@hublox.com" disabled>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" value="+234 800 000 0000" disabled>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Role</label>
                                        <input type="text" class="form-control" value="Super Admin" disabled>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-warning">Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
