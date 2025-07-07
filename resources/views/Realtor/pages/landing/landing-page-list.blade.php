@extends('realtor.realtor_master')
@section('title', 'Landing Page List')
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
    .table td, .table th {
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
                    <h3>Landing Page
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
        <h5 class="fw-bold mb-2 mb-md-0">Landing Pages</h5>
        <div class="dropdown">
            <button class="btn text-white dropdown-toggle" type="button" id="createLinkDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #91d20a;">
                <i class="fas fa-plus-circle me-1"></i> Create Link
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="createLinkDropdown">
                <li><a class="dropdown-item" href="#">Property One</a></li>
                <li><a class="dropdown-item" href="#">Property Two</a></li>
                <li><a class="dropdown-item" href="#">Property Three</a></li>
            </ul>
        </div>
    </div>
   
    <table class="table table-striped table-bordered text-sm align-middle mb-0 w-100" id="myTable" style="border-color: #91d20a;">
        <thead>
            <tr>
                <th>Link</th>
                <th>Property</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <a href="#" class="text-nowrap"> Link 1</a>
                        <button type="button" class="btn btn-sm copy-btn flex-shrink-0" data-clipboard-text="Link 1" title="Copy to clipboard">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </td>
                <td>Property One Landing Page</td>
                <td>
                    <div class="action-btns">
                        <button type="button" class="btn btn-warning btn-sm px-2 py-1" onclick="return confirm('Are you sure you want to deactivate this link?');">
                            <i class="fas fa-stop"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm px-2 py-1" onclick="return confirm('Are you sure you want to delete this link?');">
                            <i class="fas fa-trash"></i>
                        </button>
                        <a target="blank" href="{{ route('realtor.landing-page') }}" class="btn btn-info btn-sm px-2 py-1">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </td>   
            </tr>
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <a href="#" class="text-nowrap"> Link 2</a>
                        <button type="button" class="btn btn-sm copy-btn flex-shrink-0" data-clipboard-text="Link 2" title="Copy to clipboard">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </td>
                <td>Property two Landing Page</td>
                <td>
                    <div class="action-btns">
                        <button type="button" class="btn btn-warning btn-sm px-2 py-1" onclick="return confirm('Are you sure you want to deactivate this link?');">
                            <i class="fas fa-stop"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm px-2 py-1" onclick="return confirm('Are you sure you want to delete this link?');">
                            <i class="fas fa-trash"></i>
                        </button>
                        <a target="blank" href="{{ route('realtor.landing-page') }}" class="btn btn-info btn-sm px-2 py-1">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <a href="#" class="text-nowrap"> Link 3</a>
                        <button type="button" class="btn btn-sm copy-btn flex-shrink-0" data-clipboard-text="Link 3" title="Copy to clipboard">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </td>
                <td>Property three Landing Page</td>
                <td>
                    <div class="action-btns">
                        <button type="button" class="btn btn-warning btn-sm px-2 py-1" onclick="return confirm('Are you sure you want to deactivate this link?');">
                            <i class="fas fa-stop"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm px-2 py-1" onclick="return confirm('Are you sure you want to delete this link?');">
                            <i class="fas fa-trash"></i>
                        </button>
                        <a target="blank" href="{{ route('realtor.landing-page') }}" class="btn btn-info btn-sm px-2 py-1">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>  
@endsection
@push('scripts')

@endpush