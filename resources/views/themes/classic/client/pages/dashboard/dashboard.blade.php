@extends('themes.classic.client.pages.dashboard.user_master')
@section('title', 'Dashboard | Premium Refined Luxury Homes')
@section('content')

    <!-- page content -->
    <div class="col-lg-9">
        <div class="dashboard-content">
            <div id="dashboard">
                <div class="user-wrapper">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="common-card">
                                <div class="widgets">
                                    <div class="media">
                                        <div class="media-body">
                                            <p>total agents</p>
                                            <h5>2145</h5>
                                        </div>
                                        <div class="small-bar">
                                            <div class="small-chart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="common-card">
                                <div class="widgets widget-1">
                                    <div class="media">
                                        <div class="media-body">
                                            <p>total sales</p>
                                            <h5>$54871.12</h5>
                                        </div>
                                        <div class="small-bar">
                                            <div class="small-chart1"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="common-card">
                                <div class="widgets widget-2">
                                    <div class="media">
                                        <div class="media-body">
                                            <p>total properties</p>
                                            <h5>25</h5>
                                        </div>
                                        <div class="small-bar">
                                            <div class="small-chart2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-md-12">
                            <div class="common-card overview">
                                <div class="common-header">
                                    <h5>Sales overview</h5>
                                </div>
                                <ul class="overview-content">
                                    <li>
                                        <div class="d-flex">
                                            <div>
                                                <p>Earned today</p>
                                                <h4>$31415</h4>
                                            </div>
                                            <span><span class="label label-success">+30%</span></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div>
                                                <p>Earned weekly</p>
                                                <h4>$78812</h4>
                                            </div>
                                            <span><span class="label label-success">+20%</span></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div>
                                                <p>Earned monthly</p>
                                                <h4>$67810</h4>
                                            </div>
                                            <span><span class="label label-danger">-10%</span></span>
                                        </div>

                                    </li>
                                </ul>
                                <div id="overviewchart"></div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-md-6">
                            <div class="common-card sales-agent">
                                <div class="common-header">
                                    <h5>Sales by agent</h5>
                                </div>
                                <div id="agent-sales"></div>
                            </div>
                        </div>
                        <div class="col-xl-4 xl-40 col-md-6">
                            <div class="common-card available-property">
                                <div class="common-header">
                                    <h5>Available property</h5>
                                </div>
                                <div class="radial-property">
                                    <div id="radial"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 xl-60 col-md-12">
                            <div class="common-card property-overview">
                                <div class="common-header">
                                    <h5>Property overview</h5>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordernone">
                                        <thead>
                                            <tr>
                                                <th>Property</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/2.jpg"
                                                            class="img-fluid" alt="">
                                                        <h6>Orchard House</h6>
                                                    </div>
                                                </td>
                                                <td>Sold</td>
                                                <td>15/2/22</td>
                                                <td><span class="label label-light color-3">Paid</span></td>
                                                <td><i data-feather="more-horizontal"></i></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/3.jpg"
                                                            class="img-fluid" alt="">
                                                        <h6>Neverland</h6>
                                                    </div>
                                                </td>
                                                <td>Sold</td>
                                                <td>8/9/22</td>
                                                <td><span class="label label-light color-3">Paid</span></td>
                                                <td><i data-feather="more-horizontal"></i></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/4.jpg"
                                                            class="img-fluid" alt="">
                                                        <h6>Sea Breezes</h6>
                                                    </div>
                                                </td>
                                                <td>Sold</td>
                                                <td>26/10/22</td>
                                                <td><span class="label label-light color-3">Paid</span></td>
                                                <td><i data-feather="more-horizontal"></i></td>
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
    </div>
    <!-- emd of page content -->
@endsection
