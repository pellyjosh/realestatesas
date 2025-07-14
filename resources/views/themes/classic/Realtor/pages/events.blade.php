@extends('themes.classic.realtor.realtor_master')
@section('title', 'Events | Premium Refined Luxury Homes')
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
                        <h3>Events
                            <small>Welcome to realtor panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('tenant.realtor.dashboard') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Events</li>
                    </ol>
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
                    <th class="text-uppercase small text-secondary fw-bold py-3">Event </th>
                    <th class="text-uppercase small text-secondary fw-bold py-3"> Start Date</th>
                    <th class="text-uppercase small text-secondary fw-bold py-3"> End Date</th>
                    <th class="text-uppercase small text-secondary fw-bold py-3">Status</th>
                    <th class="text-uppercase small text-secondary fw-bold py-3">Referrals</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-bottom">
                    <td class="text-muted">Realtors Special Funding Program</td>
                    <td>
                        <div style="line-height: 1.2;">June 02 2025</div>
                    </td>
                    <td>
                        <div style="line-height: 1.2;">June 09 2025</div>
                    </td>
                    <td class="fw-semibold text-success">Complete</td>
                    <td class="fw-semibold text-success d-flex align-items-center justify-content-between">
                        <span>2</span>
                        <div class="dropdown">
                            <i class="fas fa-chevron-down dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                                style="cursor: pointer;"></i>
                            <ul class="dropdown-menu dropdown-menu-end"
                                style="min-width: 150px; padding: 5px 0; background-color: #fff; border: 1px solid #91d20a; border-radius: 4px;">
                                <li><a class="dropdown-item" href="#" style="padding: 8px 15px; color: #333;">Name
                                        1</a></li>
                                <li><a class="dropdown-item" href="#" style="padding: 8px 15px; color: #333;">Name
                                        2</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>

                <tr class="border-bottom">
                    <td class="text-muted">Invest in Landed Properties</td>
                    <td>
                        <div style="line-height: 1.2;">August 15 2025</div>
                    </td>
                    <td>
                        <div style="line-height: 1.2;">August 22 2025</div>
                    </td>
                    <td class="fw-semibold text-warning">Upcoming</td>
                    <td class="fw-semibold text-warning d-flex align-items-center justify-content-between">
                        <span>0</span>
                        <div class="dropdown">
                            <i class="fas fa-chevron-down dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                                style="cursor: pointer;"></i>
                            <ul class="dropdown-menu dropdown-menu-end"
                                style="min-width: 150px; padding: 5px 0; background-color: #fff; border: 1px solid #91d20a; border-radius: 4px;">
                                <li><a class="dropdown-item" href="#" style="padding: 8px 15px; color: #333;">No
                                        referrals</a></li>
                            </ul>
                        </div>
                    </td>

                </tr>

                <tr class="border-bottom">
                    <td class="text-muted">Realtor Training</td>
                    <td>
                        <div style="line-height: 1.2;">July 1 2025</div>
                    </td>
                    <td>
                        <div style="line-height: 1.2;">July 14 2025</div>
                    </td>
                    <td class="fw-semibold text-primary">Ongoing</td>
                    <td class="fw-semibold text-primary d-flex align-items-center justify-content-between">
                        <span>1</span>
                        <div class="dropdown">
                            <i class="fas fa-chevron-down dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                                style="cursor: pointer;"></i>
                            <ul class="dropdown-menu dropdown-menu-end"
                                style="min-width: 150px; padding: 5px 0; background-color: #fff; border: 1px solid #91d20a; border-radius: 4px;">
                                <li><a class="dropdown-item" href="#" style="padding: 8px 15px; color: #333;">Name
                                        1</a>
                                </li>
                            </ul>
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
@endsection
