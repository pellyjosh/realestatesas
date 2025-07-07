@extends('realtor.realtor_master')
@section('title', 'Referral | Premium Refined Luxury Homes')
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
                    <h3>Referrals
                        <small>Welcome to realtor panel</small>
                    </h3>
                </div>
            </div>
            <div class="col-sm-6">

                <!-- Breadcrumb start -->
            
                <!-- Breadcrumb end -->
                
            </div>
        </div>
    </div>
</div>

    <div class="custom-table-container">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h5 class="mb-0 fw-semibold">My Referrals</h5>
        </div>
        <table class="table table-striped table-bordered text-sm align-middle mb-0 w-100" id="myTable"
            style="border-color: #91d20a;">
            <thead>
                <tr>
                    <th class="text-uppercase small text-secondary fw-bold py-3">Name</th>
                    <th class="text-uppercase small text-secondary fw-bold py-3">Phone Number</th>
                    <th class="text-uppercase small text-secondary fw-bold py-3">Date</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-bottom">
                    <td class="text-muted">Mary Jane</td>
                    <td class="fw-semibold text-success">+1234567890</td>
                    <td>
                        June 02 2025
                    </td>
                </tr>
                <tr>
                    <td class="text-muted">John Doe</td>
                    <td class="fw-semibold text-success">+1234567890</td>
                    <td>
                        June 22 2025
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            // Safely initialize DataTable with custom settings, destroying any existing instance first.
            if ($.fn.DataTable.isDataTable('#myTable')) {
                $('#myTable').DataTable().destroy();
            }

            var table = $('#myTable').DataTable({
                "paging": true,
                "searching": true,
                "info": true,
                "lengthChange": true,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Search records...",
                    "paginate": {
                        "previous": "<i class='fas fa-chevron-left'></i>",
                        "next": "<i class='fas fa-chevron-right'></i>"
                    }
                },
            });
        });
    </script>
@endpush
