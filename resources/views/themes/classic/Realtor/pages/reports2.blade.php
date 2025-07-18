@extends('themes.classic.realtor.realtor_master')
@section('title', 'Land Type | Premium Refined Luxury Homes')
@section('content')
    <!-- Container-fluid start -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-left">
                        <h3>Reports
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
        <div class="row report-summary">
            <div class="col-xl-8 xl-12">
                <div class="card sales-details">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="sales-status">
                                    <h5>Sales summary</h5>
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
                                                <img src="{{ asset('themes/classic/admin/assets/images/svg/icon/pdf.png') }}"
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
                                                <img src="{{ asset('themes/classic/admin/assets/images/svg/icon/pdf.png') }}"
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
                                                <img src="{{ asset('themes/classic/admin/assets/images/svg/icon/pdf.png') }}"
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
            <div class="col-xl-4 xl-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Revenue</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="revenue-container">
                            <div id="revenuechart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Property sales</h5>
                    </div>
                    <div class="card-body report-table">
                        <div class="table-responsive recent-properties">
                            <table class="table table-bordernone m-0">
                                <thead>
                                    <tr>
                                        <th class="light-font">Property</th>
                                        <th class="light-font">Type</th>
                                        <th class="light-font">Date</th>
                                        <th class="light-font">Status</th>
                                        <th class="light-font">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <img src="{{ asset('themes/classic/client/assets/images/property/2.jpg') }}"
                                                    class="img-fluid img-80" alt="">
                                                <div class="media-body">
                                                    <h6>Orchard House</h6>
                                                    <span class="light-font">Brazil</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="light-font">Sold</td>
                                        <td class="light-font">15/2/22</td>
                                        <td><span class="label label-light color-3">Paid</span></td>
                                        <td><i class="light-font" data-feather="more-horizontal"></i></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <img src="{{ asset('themes/classic/client/assets/images/property/3.jpg') }}"
                                                    class="img-fluid img-80" alt="">
                                                <div class="media-body">
                                                    <h6>Neverland</h6>
                                                    <span class="light-font">London</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="light-font">Sold</td>
                                        <td class="light-font">8/9/22</td>
                                        <td><span class="label label-light color-3">Paid</span></td>
                                        <td><i class="light-font" data-feather="more-horizontal"></i></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <img src="{{ asset('themes/classic/client/assets/images/property/6.jpg') }}"
                                                    class="img-fluid img-80" alt="">
                                                <div class="media-body">
                                                    <h6>Sea Breezes</h6>
                                                    <span class="light-font">France</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="light-font">Sold</td>
                                        <td class="light-font">26/10/22</td>
                                        <td><span class="label label-light color-3">Paid</span></td>
                                        <td><i class="light-font" data-feather="more-horizontal"></i></td>
                                    </tr>
                                    <tr>
                                        <td class="pb-0">
                                            <div class="media">
                                                <img src="{{ asset('themes/classic/client/assets/images/property/2.jpg') }}"
                                                    class="img-fluid img-80" alt="">
                                                <div class="media-body">
                                                    <h6>Orchard House</h6>
                                                    <span class="light-font">Brazil</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="light-font">Sold</td>
                                        <td class="light-font">15/2/22</td>
                                        <td><span class="label label-light color-3">Paid</span></td>
                                        <td><i class="light-font" data-feather="more-horizontal"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Income Analysis</h5>
                    </div>
                    <div class="card-body income-wrap">
                        <ul class="overview-content">
                            <li>
                                <div class="d-flex">
                                    <div>
                                        <p class="mb-0 light-font">Rent income</p>
                                        <h4>$31415</h4>
                                    </div>
                                    <span><span class="label label-success">+30%</span></span>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div>
                                        <p class="mb-0 light-font">Sale income</p>
                                        <h4>$78812</h4>
                                    </div>
                                    <span><span class="label label-success">+20%</span></span>
                                </div>
                            </li>
                        </ul>
                        <div class="income-container">
                            <div id="incomechart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Recent transactions</h5>
                    </div>
                    <div class="card-body report-table">
                        <div class="table-responsive transactions-table">
                            <table class="table table-bordernone m-0">
                                <thead>
                                    <tr>
                                        <th class="light-font">#</th>
                                        <th class="light-font">Property</th>
                                        <th class="light-font">Type</th>
                                        <th class="light-font">Amount</th>
                                        <th class="light-font">Price</th>
                                        <th class="light-font">Date</th>
                                        <th class="light-font">Status</th>
                                        <th class="light-font">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <div class="media">
                                                <img src="{{ asset('themes/classic/client/assets/images/property/2.jpg') }}"
                                                    class="img-fluid img-80" alt="">
                                                <div class="media-body">
                                                    <h6>Orchard House</h6>
                                                    <span class="light-font">Brazil</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Sell</td>
                                        <td>15,000</td>
                                        <td>$125000.00</td>
                                        <td>Jun 10, 2022</td>
                                        <td><span class="label label-light color-4">Pending</span></td>
                                        <td><i class="light-font" data-feather="more-horizontal"></i></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            <div class="media">
                                                <img src="{{ asset('themes/classic/client/assets/images/property/22.jpg') }}"
                                                    class="img-fluid img-80" alt="">
                                                <div class="media-body">
                                                    <h6>Sea Breezes</h6>
                                                    <span class="light-font">France</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Rent</td>
                                        <td>8,000</td>
                                        <td>$2580000.00</td>
                                        <td>Aug 15, 2022</td>
                                        <td><span class="label label-light color-3">Paid</span></td>
                                        <td><i class="light-font" data-feather="more-horizontal"></i></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td class="pb-0">
                                            <div class="media">
                                                <img src="{{ asset('themes/classic/client/assets/images/property/6.jpg') }}"
                                                    class="img-fluid img-80" alt="">
                                                <div class="media-body">
                                                    <h6>Neverland</h6>
                                                    <span class="light-font">London</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Rent</td>
                                        <td>8,000</td>
                                        <td>$1580000.00</td>
                                        <td>Nov 28, 2022</td>
                                        <td><span class="label label-light color-3">Paid</span></td>
                                        <td><i class="light-font" data-feather="more-horizontal"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->

    @include('themes.classic.realtor.pages.partials.apex-chart')
    @push('scripts')
        <!-- apex chart js-->
       

        <script src="{{ asset('themes/classic/realtor/assets/js/admin-dashboard.js') }}"></script>

        <script src="{{ asset('themes/classic/realtor/assets/js/report.js') }}"></script>

        <!-- vector map js-->
        <script src="{{ asset('themes/classic/realtor/assets/js/vector-map/jquery-jvectormap-2.0.2.min.js') }}"></script>
        <script src="{{ asset('themes/classic/realtor/assets/js/vector-map/jquery-jvectormap-asia-mill.js') }}"></script>
    @endpush

@endsection
