@extends('themes.classic.realtor.realtor_master')
@section('title', 'Dashboard | Premium Refined Luxury Homes')
@section('content')
    <style>
        /* This will remove the shadow from the "Withdraw" button */
        .all-properties .btn-solid::after {
            box-shadow: none !important;
        }
    </style>

    <!-- Container-fluid start -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-left">
                        <h3>Dashboard
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
    <!-- Container-fluid end -->

    <!-- Container-fluid start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 large-12">
                <div class="row">
                    <div class="large-6 col-lg-12 col-md-6">
                        <div class="card all-properties">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <img src="{{ asset('themes/classic/admin/assets/images/svg/icon/1.svg') }}"
                                        alt="">
                                    <div class="media-body">
                                        <h4 class="mb-0">45</h4>
                                        <h6 class="light-font mb-0">Referrals</h6>
                                    </div>
                                    <div class="d-flex flex-column align-items-end">
                                        <a href="{{ route('tenant.realtor.landing-page-list') }}" class="arrow-animated">
                                            See all referrals
                                            <i data-feather="chevron-right"></i>
                                        </a>
                                        <button class="btn btn-solid btn-sm mt-2">Withdraw</button>
                                    </div>
                                </div>
                                <ul class="light-box d-flex flex-column gap-3 p-0 m-0" style="list-style: none;">
                                    <li class="d-flex align-items-center gap-3 p-2 rounded shadow-sm"
                                        style="background: #f8f9fa;">
                                        <img src="{{ asset('themes/classic/admin/assets/images/svg/icon/sold.png') }}"
                                            class="img-fluid" alt="" style="width: 40px; height: 40px;">
                                        <div>
                                            <h5 class="mb-1">1500</h5>
                                            <span class="light-font">Total balance</span>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center gap-3 p-2 rounded shadow-sm"
                                        style="background: #f8f9fa;">
                                        <img src="{{ asset('themes/classic/admin/assets/images/svg/icon/rent.png') }}"
                                            class="img-fluid" alt="" style="width: 40px; height: 40px;">
                                        <div>
                                            <h5 class="mb-1">380</h5>
                                            <span class="light-font">Referral Commission</span>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center gap-3 p-2 rounded shadow-sm"
                                        style="background: #f8f9fa;">
                                        <img src="{{ asset('themes/classic/admin/assets/images/svg/icon/unlisted.png') }}"
                                            class="img-fluid" alt="" style="width: 40px; height: 40px;">
                                        <div>
                                            <h5 class="mb-1">240</h5>
                                            <span class="light-font">Sales Commission</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="large-6 col-lg-12 col-md-6">
                        <div class="card invoice-card">
                            <div class="card-header pb-0">
                                <div>
                                    <h5>Last Month</h5>
                                </div>
                            </div>
                            <div class="card-body calculations">
                                <ul>
                                    <li>
                                        <h5 class="font-success">$47,215</h5>
                                        <h6 class="light-font mb-0">Paid invoices</h6>
                                    </li>
                                    <li>
                                        <h5 class="font-danger">$5,780</h5>
                                        <h6 class="light-font mb-0">Open invoices</h6>
                                    </li>
                                </ul>
                                <div class="d-flex">
                                    <a href="agent-invoice.html" class="label label-light color-4">
                                        <i class="fas fa-hand-holding-usd me-1"></i>
                                        Payments Receive</a>
                                    <a href="agent-invoice.html" class="arrow-animated">
                                        View all
                                        <i data-feather="chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 large-12">
                <div class="card sales-details">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="sales-status">
                                    <h5 class="light-font">Sales summary</h5>
                                    <div class="status-price">
                                        <h3>
                                            $16,230/-
                                        </h3>
                                        <span>
                                            last week
                                            <span class="font-success">
                                                + 10%
                                                <i data-feather="trending-up"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="chart-legends">
                                    <ul>
                                        <li>
                                            <div class="bg-primary circle-label"></div>
                                            <span>Last week</span>
                                        </li>
                                        <li class="mt-1">
                                            <div class="bg-secondary circle-label"></div>
                                            <span>Running week</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="last-updated light-box">
                                    <span>Last updated</span>
                                    <h5>Dec 26, 2022</h5>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="monthly-sales">
                                    <div class="icon-box">
                                        <i class="fas fa-chevron-left light-font"></i>
                                    </div>
                                    <h6>Octobar, 2022</h6>
                                    <div class="icon-box">
                                        <i class="fas fa-chevron-right light-font"></i>
                                    </div>
                                </div>
                                <div class="bar-sales">
                                    <div id="sale-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 xl-6 col-md-6 project-widgets">

            </div>
            <div class="col-xl-3 xl-6 col-md-6 project-widgets">
            </div>
            <div class="col-xl-3 xl-6 col-md-6 project-widgets">
            </div>
            <div class="col-xl-3 xl-6 col-md-6 project-widgets">
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <h5>Project timeline</h5>
                            <a href="add-property.html">+ Add project</a>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="timeline-container">
                            <div id="timeline-chart">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Assignees</h5>
                    </div>
                    <div class="card-body assign-table pt-0">
                        <div class="table-responsive">
                            <table class="table table-bordernone">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <img src="{{ asset('themes/classic/admin/assets/images/avatar/1.jpg') }}"
                                                    class="img-fluid" alt="">
                                                <div class="media-body">
                                                    <a href="user-profile.html"><a href="user-profile.html">
                                                            <h6>Bob Frapples</h6>
                                                        </a></a>
                                                    <span>Pumbing</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="font-danger">10</h6>
                                            <span>Open</span>
                                        </td>
                                        <td>
                                            <h6 class="font-warning">3</h6>
                                            <span>Escaleted</span>
                                        </td>
                                        <td>
                                            <h6 class="font-success">126</h6>
                                            <span>Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <img src="{{ asset('themes/classic/admin/assets/images/avatar/3.jpg') }}"
                                                    class="img-fluid" alt="">
                                                <div class="media-body">
                                                    <a href="user-profile.html"><a href="user-profile.html">
                                                            <h6>Greta Life</h6>
                                                        </a></a>
                                                    <span>Pest control</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="font-danger">8</h6>
                                            <span>Open</span>
                                        </td>
                                        <td>
                                            <h6 class="font-warning">20</h6>
                                            <span>Escaleted</span>
                                        </td>
                                        <td>
                                            <h6 class="font-success">154</h6>
                                            <span>Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <img src="{{ asset('themes/classic/admin/assets/images/avatar/5.jpg') }}"
                                                    class="img-fluid" alt="">
                                                <div class="media-body">
                                                    <a href="user-profile.html">
                                                        <h6>Zack Lee</h6>
                                                    </a>
                                                    <span>others</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="font-danger">5</h6>
                                            <span>Open</span>
                                        </td>
                                        <td>
                                            <h6 class="font-warning">18</h6>
                                            <span>Escaleted</span>
                                        </td>
                                        <td>
                                            <h6 class="font-success">79</h6>
                                            <span>Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <img src="{{ asset('themes/classic/admin/assets/images/avatar/7.jpg') }}"
                                                    class="img-fluid" alt="">
                                                <div class="media-body">
                                                    <a href="user-profile.html">
                                                        <h6>Paige Turner</h6>
                                                    </a>
                                                    <span>Pest control</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="font-danger">15</h6>
                                            <span>Open</span>
                                        </td>
                                        <td>
                                            <h6 class="font-warning">7</h6>
                                            <span>Escaleted</span>
                                        </td>
                                        <td>
                                            <h6 class="font-success">145</h6>
                                            <span>Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <img src="{{ asset('themes/classic/admin/assets/images/avatar/4.jpg') }}"
                                                    class="img-fluid" alt="">
                                                <div class="media-body">
                                                    <a href="user-profile.html">
                                                        <h6>Mary Goround</h6>
                                                    </a>
                                                    <span>Pumbing</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="font-danger">10</h6>
                                            <span>Open</span>
                                        </td>
                                        <td>
                                            <h6 class="font-warning">3</h6>
                                            <span>Escaleted</span>
                                        </td>
                                        <td>
                                            <h6 class="font-success">126</h6>
                                            <span>Completed</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 xl-6 col-lg-12 col-md-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex">
                            <h5>My properties</h5>
                            <a href="{{ route('admin.add-property') }}">+ New</a>
                        </div>
                    </div>
                    <div class="card-body properties-list">
                        <div class="media">
                            <img src="{{ asset('themes/classic/client/assets/images/property/25.jpg') }}"
                                class="img-fluid" alt="">
                            <div class="media-body">
                                <a href="listing.html">
                                    <h6>Orchard House</h6>
                                </a>
                                <ul>
                                    <li><i class="fas fa-mountain"></i> Land : 3</li>
                                    <li><i class="fas fa-building"></i> Properties : 2</li>
                                    <li>
                                        <i class="fas fa-ruler-combined"></i> Sq Ft : 5000
                                    </li>
                                </ul>
                                <div>
                                    <span class="light-font">Status: </span>
                                    <span class="label label-light color-4">Rented</span>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <img src="{{ asset('themes/classic/client/assets/images/property/7.jpg') }}"
                                class="img-fluid" alt="">
                            <div class="media-body">
                                <a href="listing.html">
                                    <h6>Neverland</h6>
                                </a>
                                <ul>
                                    <li><i class="fas fa-mountain"></i> Land : 3</li>
                                    <li><i class="fas fa-building"></i> Properties : 2</li>
                                    <li>
                                        <i class="fas fa-ruler-combined"></i> Sq Ft : 5000
                                    </li>
                                </ul>
                                <div>
                                    <span class="light-font">Status: </span>
                                    <span class="label label-light color-4">Rented</span>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <img src="{{ asset('themes/classic/client/assets/images/property/8.jpg') }}"
                                class="img-fluid" alt="">
                            <div class="media-body">
                                <a href="listing.html">
                                    <h6>Sea Breezes</h6>
                                </a>
                                <ul>
                                    <li><i class="fas fa-mountain"></i> Land : 3</li>
                                    <li><i class="fas fa-building"></i> Properties : 2</li>
                                    <li>
                                        <i class="fas fa-ruler-combined"></i> Sq Ft : 5000
                                    </li>
                                </ul>
                                <div>
                                    <span class="light-font">Status: </span>
                                    <span class="label label-light color-3">Listed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 xl-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Management Reports</h5>
                    </div>
                    <div class="card-body management-table">
                        <div class="table-responsive">
                            <table class="table table-bordernone">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <img src="{{ asset('themes/classic/admin/assets/images/svg/icon/pdf.png') }}"
                                                    class="img-fluid" alt="">
                                                <div class="media-body">
                                                    <h6>Report 8/10/22 - 15/10/22</h6>
                                                    <span>Created 16/10/22</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="text_file.txt" download><i data-feather="download"
                                                    class="light-font"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <img src="{{ asset('themes/classic/admin/assets/images/svg/icon/microsoft.png') }}"
                                                    class="img-fluid" alt="">
                                                <div class="media-body">
                                                    <h6>Report 20/10/22 - 25/10/22</h6>
                                                    <span>Created 24/10/22</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="text_file.txt" download><i data-feather="download"
                                                    class="light-font"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/svg/icon/excel.png"
                                                    class="img-fluid" alt="">
                                                <div class="media-body">
                                                    <h6>Report 30/10/22 - 5/11/22</h6>
                                                    <span>Created 1/11/22</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="text_file.txt" download><i data-feather="download"
                                                    class="light-font"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <img src="{{ asset('themes/classic/admin/assets/images/svg/icon/pdf.png') }}"
                                                    class="img-fluid" alt="">
                                                <div class="media-body">
                                                    <h6>Report 10/11/22 - 15/11/22</h6>
                                                    <span>Created 17/11/22</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="text_file.txt" download><i data-feather="download"
                                                    class="light-font"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <img src="{{ asset('themes/classic/admin/assets/images/svg/icon/excel.png') }}"
                                                    class="img-fluid" alt="">
                                                <div class="media-body">
                                                    <h6>Report 20/11/22 - 25/11/22</h6>
                                                    <span>Created 28/11/22</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="text_file.txt" download><i data-feather="download"
                                                    class="light-font"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 xl-6">
                <div class="card expiring-card">
                    <div class="card-header">
                        <div class="d-flex">
                            <h5>Sold out</h5>
                            <a href="apartment.html" class="arrow-animated">
                                See Details
                                <i data-feather="chevron-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body pt-0 expiring-details">
                        <div class="expiring-chart">
                            <div id="Radial-chart"></div>
                        </div>
                        <div class="chart-detail">
                            <div class="d-flex">
                                <div class="media">
                                    <div class="with-reload">
                                        <img src="{{ asset('themes/classic/admin/assets/images/svg/icon/1.svg') }}"
                                            class="img-fluid" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h5>78</h5>
                                        <span class="light-font">Properties</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="legend-exiring">
                            <ul>
                                <li>
                                    <div class="d-flex">
                                        <span class="square-series bg-primary"></span>
                                        <h6>10</h6>
                                    </div>
                                    <span class="light-font">> 20 Days</span>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <span class="square-series bg-success"></span>
                                        <h6>50</h6>
                                    </div>
                                    <span class="light-font">21 - 40 Days</span>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <span class="square-series bg-warning"></span>
                                        <h6>75</h6>
                                    </div>
                                    <span class="light-font">41 - 80 Days</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->

    @include('themes.classic.realtor.pages.partials.apex-chart')
    @push('scripts')
        <script src="{{ asset('themes/classic/realtor/assets/js/admin-dashboard.js') }}"></script>
    @endpush
@endsection
