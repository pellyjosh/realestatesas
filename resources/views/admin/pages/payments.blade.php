@extends('admin.admin_master')
@section('title', 'Payments | Premium Refined Luxury Homes')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-left">
                        <h3>Payments
                            <small>Welcome to admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Payments</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card"> 
                    <div class="card-header pb-0">
                        <h5>Payment Lists</h5>
                    </div>
                    <div class="card-body payment-table">
                        <div class="custom-table-container">
                            <style>
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
                                    margin-bottom: 1rem;
                                    display: flex;
                                    justify-content: space-between;
                                    align-items: center;
                                    gap: 0.75rem;
                                    flex-wrap: wrap;
                                }
                                .table thead th {
                                    background: #e5f5c7;
                                    color: #333;
                                    font-weight: 600;
                                    padding: 0.5rem;
                                }
                                .custom-table-container {
                                    border-radius: 10px;
                                    padding: 0.5rem;
                                    width: 100%;
                                    overflow-x: auto;
                                }
                                .table td {
                                    padding: 0.5rem 0.75rem;
                                    vertical-align: middle;
                                }
                                .table th {
                                    padding: 0.5rem 0.75rem;
                                    vertical-align: middle;
                                }
                                .action-btns {
                                    display: flex;
                                    gap: 0.25rem;
                                    flex-wrap: wrap;
                                }
                                .page-body {
                                    min-height: calc(100vh - 200px);
                                }
                                @media (max-width: 576px) {
                                    .table {
                                        font-size: 0.85rem;
                                    }
                                    .action-btns {
                                        flex-wrap: nowrap;
                                        gap: 0.15rem;
                                    }
                                    .filter-panel {
                                        flex-direction: column;
                                        align-items: center;
                                    }
                                    .button-group {
                                        margin-top: 1rem;
                                        width: 100%;
                                        display: flex;
                                        justify-content: center;
                                    }
                                    .button-group .btn {
                                        padding: 0.5rem 1.5rem;
                                        font-size: 1rem;
                                    }
                                }
                            </style>
                            <div class="filter-panel">
                                <h5 class="mb-0 fw-semibold">All Payments</h5>
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <div class="form-group">
                                        <label for="fromDate" class="small text-secondary fw-bold">From Date</label>
                                        <input type="date" id="fromDate" class="form-control form-control-sm" style="background-color: #f6faeb; border-color: #91d20a; color: #333;">
                                    </div>
                                    <div class="form-group">
                                        <label for="toDate" class="small text-secondary fw-bold">To Date</label>
                                        <input type="date" id="toDate" class="form-control form-control-sm" style="background-color: #f6faeb; border-color: #91d20a; color: #333;">
                                    </div>
                                </div>
                                <div class="d-flex align-items-end gap-2 button-group">
                                    <button class="btn btn-sm" type="button" style="background-color: #91d20a; color: #fff; border-color: #91d20a;">Filter</button>
                                </div>
                            </div>
                            <div class="table-responsive" style="overflow-x: auto; width: 100%;">
                                <table class="table table-striped table-bordered text-sm align-middle mb-0 w-100" id="myTable"
                                    style="border-color: #91d20a; min-width: 600px;">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase small text-secondary fw-bold py-3">Payment ID</th>
                                            <th class="text-uppercase small text-secondary fw-bold py-3">User</th>
                                            <th class="text-uppercase small text-secondary fw-bold py-3">Property/Service</th>
                                            <th class="text-uppercase small text-secondary fw-bold py-3">Realtor</th>
                                            <th class="text-uppercase small text-secondary fw-bold py-3">Amount</th>
                                            <th class="text-uppercase small text-secondary fw-bold py-3">Date</th>
                                            <th class="text-uppercase small text-secondary fw-bold py-3">Status</th>
                                            <th class="text-uppercase small text-secondary fw-bold py-3">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-bottom">
                                            <td class="text-muted">#PAY001</td>
                                            <td class="text-muted">John Doe</td>
                                            <td>Orchard House</td>
                                            <td class="text-muted">Realtor A</td>
                                            <td>
                                                <div style="line-height: 1.2;">$10,000.00</div>
                                            </td>
                                            <td>
                                                <div style="line-height: 1.2;">July 01, 2025</div>
                                            </td>
                                            <td class="fw-semibold text-success">Completed</td>
                                            <td>
                                                <div class="action-btns">
                                                    <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-bottom">
                                            <td class="text-muted">#PAY002</td>
                                            <td class="text-muted">Jane Smith</td>
                                            <td>Sea Breezes</td>
                                            <td class="text-muted">Realtor B</td>
                                            <td>
                                                <div style="line-height: 1.2;">$15,000.00</div>
                                            </td>
                                            <td>
                                                <div style="line-height: 1.2;">July 03, 2025</div>
                                            </td>
                                            <td class="fw-semibold text-warning">Pending</td>
                                            <td>
                                                <div class="action-btns">
                                                    <a href="#" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
                                                    <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-bottom">
                                            <td class="text-muted">#PAY003</td>
                                            <td class="text-muted">Michael Brown</td>
                                            <td>Neverland</td>
                                            <td class="text-muted">Realtor C</td>
                                            <td>
                                                <div style="line-height: 1.2;">$8,500.00</div>
                                            </td>
                                            <td>
                                                <div style="line-height: 1.2;">June 28, 2025</div>
                                            </td>
                                            <td class="fw-semibold text-success">Completed</td>
                                            <td>
                                                <div class="action-btns">
                                                    <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-bottom">
                                            <td class="text-muted">#PAY004</td>
                                            <td class="text-muted">Sarah Johnson</td>
                                            <td>Consultation Service</td>
                                            <td class="text-muted">Realtor D</td>
                                            <td>
                                                <div style="line-height: 1.2;">$500.00</div>
                                            </td>
                                            <td>
                                                <div style="line-height: 1.2;">June 25, 2025</div>
                                            </td>
                                            <td class="fw-semibold text-danger">Failed</td>
                                            <td>
                                                <div class="action-btns">
                                                    <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                </div>
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
    </div>

    <script>
        $(document).ready(function() {
            // Destroy any existing DataTable instance to prevent conflicts
            if ($.fn.DataTable.isDataTable('#myTable')) {
                $('#myTable').DataTable().destroy();
            }
            // Initialize DataTable with custom settings
            $('#myTable').DataTable({
                "paging": true,
                "searching": true,
                "info": true,
                "lengthChange": true,
                "pageLength": 5,
                "dom": 'lfrtip',
                "responsive": true
            });
        });
    </script>
@endsection
