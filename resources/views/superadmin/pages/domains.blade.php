@extends('superadmin.layouts.super-admin_master')
@section('title', ' Domains')
@section('content')
    <!-- Main Content -->
    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h2>Domains
                        <small>Welcome to Hublox Real Estate Management System</small>
                    </h2>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 text-md-right">
                    <div class="inlineblock text-center m-r-15 m-l-15 hidden-md-down">
                        <div class="sparkline" data-type="bar" data-width="97%" data-height="25px" data-bar-Width="2"
                            data-bar-Spacing="5" data-bar-Color="#fff">3,2,6,5,9,8,7,9,5,1,3,5,7,4,6</div>
                        <small class="col-white">Visitors</small>
                    </div>
                    <div class="inlineblock text-center m-r-15 m-l-15 hidden-md-down">
                        <div class="sparkline" data-type="bar" data-width="97%" data-height="25px" data-bar-Width="2"
                            data-bar-Spacing="5" data-bar-Color="#fff">1,3,5,7,4,6,3,2,6,5,9,8,7,9,5</div>
                        <small class="col-white">Bounce Rate</small>
                    </div>
                    <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right ml-3" type="button">
                        <i class="zmdi zmdi-plus"></i>
                    </button>
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{ route('superadmin.index') }}"><i class="zmdi zmdi-home"></i> Hublox</a></li>
                        <li class="breadcrumb-item active">Domains</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table td_2 table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Domain</th>
                                            <th>Name</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th>Plan</th>
                                            <th>Created On</th>
                                            <th>Expires On</th>
                                            <th>Approved By</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>c-housing.test</td>
                                            <td>C-housing Estate</td>
                                            <td>Asaba</td>
                                            <td>Active</td>
                                            <td>Basic</td>
                                            <td>July 11, 2025</td>
                                            <td>July 10, 2026</td>
                                            <td>Admin 1</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-warning me-1" title="Suspend"><i
                                                        class="fas fa-circle-pause"></i></a>
                                                <a href="#" class="btn btn-sm btn-success me-1" title="Activate"><i
                                                        class="fas fa-circle-play"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger" title="View" onclick="confirm('Are you sure you want to delete this domain?')"><i
                                                        class="fas fa-trash" ></i></a>
                                                <a href="{{ route('superadmin.domain.view') }}" class="btn btn-sm btn-info" title="View" target="_blank"><i
                                                        class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>chuks-estate.central.test</td>
                                            <td>chuks Estate</td>
                                            <td>Lagos</td>
                                            <td>Active</td>
                                            <td>Pro</td>
                                            <td>July 11, 2025</td>
                                            <td>July 10, 2026</td>
                                            <td>Admin 2</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-warning me-1" title="Suspend"><i
                                                        class="fas fa-circle-pause"></i></a>
                                                <a href="#" class="btn btn-sm btn-success me-1" title="Activate"><i
                                                        class="fas fa-circle-play"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger" title="View" onclick="confirm('Are you sure you want to delete this domain?')"><i
                                                        class="fas fa-trash" ></i></a>
                                                <a href="{{ route('superadmin.domain.view') }}" class="btn btn-sm btn-info" title="View" target="_blank"><i
                                                        class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Pending Domain Approvals -->
        <div class="col-lg-12 mt-4">
            <div class="card">
                <div class="header">
                    <h2><strong>Pending</strong> Domain Approvals</h2>
                </div>
                <div class="body table-responsive">
                    <table class="table td_2 table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Domain</th>
                                <th>Client</th>
                                <th>Location</th>
                                <th>Date Registered</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>sunnytown.hublox.com</td>
                                <td>Sunnytown Realty</td>
                                <td>Port Harcourt</td>
                                <td>2025-07-12</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning me-1" title="Reject"><i class="fas fa-times"></i></a>
                                    <a href="#" class="btn btn-sm btn-success me-1" title="Approve"><i class="fas fa-check"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger" title="View" onclick="confirm('Are you sure you want to delete this domain request?')"><i
                                                        class="fas fa-trash" ></i></a>
                                    <a href="{{ route('superadmin.domain.view') }}" class="btn btn-sm btn-info" title="View"><i
                                            class="fas fa-eye" target="_blank"></i></a>
                                </td>
                            </tr>
                            <!-- Add more rows dynamically from your backend -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
