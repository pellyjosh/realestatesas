<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Premium Refined Luxury Homes- Realtor dashboard page">
    <meta name="keywords" content="Premium Refined Luxury Homes- Realtor dashboard page">
    <meta name="author" content="Premium Refined Luxury Homes- Realtor dashboard page">
    <link rel="icon" href="{{ asset('client/assets/images/logo.png') }}" type="image/x-icon" />
    <title>@yield('title', 'Premim Refined Admin page')</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">

    <!-- Font Awesome 6 Free CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- animate css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('client/assets/css/animate.css') }}">

    <!-- Template css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/classic/admin/assets/css/admin.css') }}">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        .active {
            background-color: rgba(145, 210, 10, 0.1) !important;
            color: #91d20a !important;
            border-left: 3px solid #91d20a !important;
            font-weight: 600 !important;
        }
    </style>
</head>

<body>

    <!-- Loader start -->
    <div class="loader-wrapper">
        <div class="row loader-text">
            <div class="col-12">
                <img src="{{ asset('client/assets/images/loader/gear.gif') }}" class="img-fluid" alt="">
            </div>
            <div class="col-12">
                <div>
                    <h3 class="mb-0">Please wait portal loading...</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Loader end -->

    <div class="page-wrapper">

        <!-- page header start -->
        <div class="page-main-header row">
            <div id="sidebar-toggle" class="toggle-sidebar col-auto">
                <i data-feather="chevrons-left"></i>
            </div>
            <div class="nav-right col p-0">
                <ul class="header-menu">
                    <li>
                        <div class="d-md-none mobile-search">
                            <i data-feather="search"></i>
                        </div>
                        <div class="form-group search-form">
                            <input type="text" class="form-control" placeholder="Search here...">
                        </div>
                    </li>
                    <li>
                        <a href="#!" onclick="javascript:toggleFullScreen()">
                            <i data-feather="maximize"></i>
                        </a>
                    </li>
                    <li class="onhover-dropdown">
                        <a href="javascript:void(0)">
                            <i data-feather="save"></i>
                        </a>
                        <div class="notification-dropdown onhover-show-div">
                            <div class="dropdown-title">
                                <h6>Recent Attachments</h6>
                                <a href="{{ route('tenant.realtor.reports') }}">Show all</a>
                            </div>
                            <ul>
                                <li>
                                    <div class="media">
                                        <div class="icon-notification bg-success-light">
                                            <i class="fas fa-file-word"></i>
                                        </div>
                                        <div class="media-body">
                                            <a href="{{ route('tenant.realtor.reports') }}">
                                                <h6>Doc_file.doc</h6>
                                            </a>
                                            <span>800MB</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <div class="icon-notification bg-primary-light">
                                            <i class="fas fa-file-image"></i>
                                        </div>
                                        <div class="media-body">
                                            <a href="{{ route('tenant.realtor.reports') }}">
                                                <h6>Apartment.jpg</h6>
                                            </a>
                                            <span>500kb</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <div class="icon-notification bg-warning-light">
                                            <i class="fas fa-file-pdf"></i>
                                        </div>
                                        <div class="media-body">
                                            <a href="{{ route('tenant.realtor.reports') }}">
                                                <h6>villa_report.pdf</h6>
                                            </a>
                                            <span>26MB</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="onhover-dropdown notification-box">
                        <a href="javascript:void(0)">
                            <i data-feather="bell"></i>
                            <span class="label label-shadow label-pill notification-badge">3</span>
                        </a>
                        <div class="notification-dropdown onhover-show-div">
                            <div class="dropdown-title">
                                <h6>Notifications</h6>
                                <a href="{{ route('tenant.realtor.favourites') }}">Show all</a>
                            </div>
                            <ul>
                                <li>
                                    <div class="media">
                                        <div class="icon-notification bg-primary-light">
                                            <i class="fab fa-xbox"></i>
                                        </div>
                                        <div class="media-body">
                                            <h6>Item damaged</h6>
                                            <span>8 hours ago, Tadawis 24</span>
                                            <p class="mb-0">"the table is broken:("</p>
                                            <ul class="user-group">
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <img src="{{ asset('themes/classic/admin/assets/images/about/4.jpg') }}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                </li>
                                                <li class="reply">
                                                    <a href="javascript:void(0)">
                                                        Reply
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <div class="icon-notification bg-success-light">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </div>
                                        <div class="media-body">
                                            <h6>Payment received</h6>
                                            <span>2 hours ago, Bracka 15</span>
                                            <ul class="user-group">
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <img src="{{ asset('themes/classic/admin/assets/images/about/1.jpg') }}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <img src="{{ asset('themes/classic/admin/assets/images/about/2.jpg') }}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <img src="{{ asset('themes/classic/admin/assets/images/about/3.jpg') }}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <div class="icon-notification bg-warning-light">
                                            <i class="fas fa-comment-dots"></i>
                                        </div>
                                        <div class="media-body">
                                            <h6>New inquiry</h6>
                                            <span>1 Days ago, Krowada 7</span>
                                            <p class="mb-0">"is the villa still available?"</p>
                                            <ul class="user-group">
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <img src="{{ asset('themes/classic/admin/assets/images/about/2.jpg') }}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <img src="{{ asset('themes/classic/admin/assets/images/about/3.jpg') }}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                </li>
                                                <li class="reply">
                                                    <a href="javascript:void(0)">
                                                        Reply
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="onhover-dropdown">
                        <a href="javascript:void(0)">
                            <i data-feather="mail"></i>
                        </a>
                        <div class="notification-dropdown chat-dropdown onhover-show-div">
                            <div class="dropdown-title">
                                <h6>Messages</h6>
                                <a href="">View all</a>
                            </div>
                            <ul>
                                <li>
                                    <div class="media">
                                        <div class="chat-user">
                                            <img src="{{ asset('themes/classic/admin/assets/images/avatar/1.jpg') }}"
                                                class="img-fluid" alt="">
                                        </div>
                                        <div class="media-body">
                                            <a href="">
                                                <h6>Bob Frapples</h6>
                                            </a>
                                            <span>Template Represents simply...</span>
                                        </div>
                                        <div class="status online">online</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="profile-avatar onhover-dropdown">
                        <div>
                            <img src="{{ asset('themes/classic/admin/assets/images/avatar/3.jpg') }}"
                                class="img-fluid" alt="">
                        </div>
                        <ul class="profile-dropdown onhover-show-div">
                            {{-- <li><a href="{{ route('tenats.tenant.user-profile') }}"><span>Account </span><i
                                        data-feather="user"></i></a></li> --}}
                            <li><a href="{{ route('tenant.login') }}"><span>Log in</span><i
                                        data-feather="log-in"></i></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- page header end -->

        <div class="page-body-wrapper">
            <!-- page sidebar start -->
            <div class="page-sidebar">
                <div class="logo-wrap">
                    <a href="{{ route('tenant.realtor.dashboard') }}">
                        <img src="{{ asset('client/assets/images/logo2.png') }}" class="img-fluid for-light"
                            alt="">
                        <img src="{{ asset('client/assets/images/logo2.png') }}" class="img-fluid for-dark"
                            alt="">
                    </a>
                    <div class="back-btn d-lg-none d-inline-block">
                        <i data-feather="chevrons-left"></i>
                    </div>
                </div>
                <div class="main-sidebar">
                    <div class="user-profile">
                        <div class="media">
                            <div class="change-pic">
                                <img src="{{ asset('themes/classic/admin/assets/images/avatar/3.jpg') }}"
                                    class="img-fluid" alt="">
                            </div>
                            <div class="media-body">
                                {{-- <a href="{{ route('tenant.user-profile') }}"> --}}
                                <h6>Zack Lee</h6>
                                {{-- </a> --}}
                                <span class="font-roboto">zackle@gmail.com</span>
                            </div>
                        </div>
                    </div>

                    {{-- Main sidebar start --}}
                    <div id="mainsidebar">
                        <ul class="sidebar-menu custom-scrollbar">
                            <li class="sidebar-item {{ request()->is('realtor/dashboard*') ? 'active' : '' }}">
                                <a href="{{ route('tenant.realtor.dashboard') }}" class="sidebar-link only-link">
                                    <i data-feather="airplay"></i>
                                    <span class="">Dashboard</span>
                                </a>
                            </li>
                            <li class="sidebar-item {{ request()->is('realtor/profile*') ? 'active' : '' }}">
                                <a href="{{ route('tenant.realtor.profile') }}" class="sidebar-link only-link">
                                    <i data-feather="user"></i>
                                    <span>Profile</span>
                                </a>
                            </li>
                            <li class="sidebar-item {{ request()->is('realtor/landing-page*') ? 'active' : '' }}">
                                <a href="{{ route('tenant.realtor.landing-page-list') }}"
                                    class="sidebar-link only-link">
                                    <i data-feather="user"></i>
                                    <span>Landing Page</span>
                                </a>
                            </li>

                            <li class="sidebar-item {{ request()->is('realtor/reports*') ? 'active' : '' }}">
                                <a href="{{ route('tenant.realtor.reports') }}" class="sidebar-link only-link">
                                    <i data-feather="bar-chart-2"></i>
                                    <span>Reports</span>
                                </a>
                            </li>
                            <li class="sidebar-item {{ request()->is('realtor/referrals*') ? 'active' : '' }}">
                                <a href="{{ route('tenant.realtor.referrals') }}" class="sidebar-link only-link">
                                    <i data-feather="users"></i>
                                    <span>Referals</span>
                                </a>
                            </li>
                            <li class="sidebar-item {{ request()->is('realtor/referrals*') ? 'active' : '' }}">
                                <a href="{{ route('tenant.realtor.events') }}" class="sidebar-link only-link">
                                    <i data-feather="calendar"></i>
                                    <span>Events</span>
                                </a>
                            </li>
                            <li class="sidebar-item {{ request()->is('realtor/earnings*') ? 'active' : '' }}">
                                <a href="{{ route('tenant.realtor.earnings') }}" class="sidebar-link only-link">
                                    <i data-feather="dollar-sign"></i>
                                    <span>Earnings</span>
                                </a>
                            </li>
                            <li class="sidebar-item {{ request()->is('realtor/payments*') ? 'active' : '' }}">
                                <a href="{{ route('tenant.realtor.payments') }}" class="sidebar-link only-link">
                                    <i data-feather="credit-card"></i>
                                    <span>Payments</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- page sidebar end -->


            <div class="page-body">

                @yield('content')


            </div>

            <!-- footer start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 footer-copyright">
                            <p class="mb-0">Copyright 2025 Premium Refined By 💚 Hubolux Technologies.</p>
                        </div>

                    </div>
                </div>
            </footer>
            <!-- footer end -->
        </div>
    </div>

    <!-- tap to top start -->
    <div class="tap-top">
        <div>
            <i class="fas fa-arrow-up"></i>
        </div>
    </div>
    <!-- tap to top end -->

    <!-- customizer start -->
    <div class="customizer-wrap">
        <div class="customizer-links">
            <i data-feather="settings"></i>
        </div>
        <div class="customizer-contain custom-scrollbar">
            <div class="setting-back">
                <i data-feather="x"></i>
            </div>
            <div class="layouts-settings">
                <div class="customizer-title">
                    <h6 class="color-4">Layout type</h6>
                </div>
                <div class="option-setting">
                    <span>Light</span>
                    <label class="switch">
                        <input type="checkbox" name="chk1" value="option" class="setting-check"><span
                            class="switch-state"></span>
                    </label>
                    <span>Dark</span>
                </div>
            </div>
            <div class="layouts-settings">
                <div class="customizer-title">
                    <h6 class="color-4">Layout Direction</h6>
                </div>
                <div class="option-setting">
                    <span>LTR</span>
                    <label class="switch">
                        <input type="checkbox" name="chk2" value="option" class="setting-check1"><span
                            class="switch-state"></span>
                    </label>
                    <span>RTL</span>
                </div>
            </div>
            <div class="layouts-settings">
                <div class="customizer-title">
                    <h6 class="color-4">Unlimited Color</h6>
                </div>
                <div class="option-setting unlimited-color-layout">
                    <div class="form-group">
                        <label for="ColorPicker6">color 6</label>
                        <input id="ColorPicker6" type="color" value="#f35d43" name="Default">
                    </div>
                    <div class="form-group">
                        <label for="ColorPicker7">color 7</label>
                        <input id="ColorPicker7" type="color" value="#f34451" name="Default">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- customizer end -->

    <!-- latest jquery-->
    <script src="{{ asset('themes/classic/admin/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Initialize the DataTable -->
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <!-- Bootstrap js-->
    <script src="{{ asset('themes/classic/admin/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- feather icon js-->
    <script src="{{ asset('client/assets/js/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/feather-icon/feather-icon.js') }}"></script>

    <!-- sidebar js -->
    <script src="{{ asset('themes/classic/admin/assets/js/sidebar.js') }}"></script>

    <script src="{{ asset('realtor/assets/js/chart/chartist.js') }}"></script>
    <script src="{{ asset('realtor/assets/js/chart/chartist-plugin-tooltip.js') }}"></script>

    <!-- apex chart js-->
    <script src="{{ asset('realtor/assets/js/chart/apex-chart.js') }}"></script>
    <script src="r{{ asset('realtor/assets/js/chart/stock-prices.js') }}"></script>
    <script src="{{ asset('realtor/assets/js/user-profile.js') }}"></script>
    <script src="{{ asset('realtor/assets/js/admin-dashboard.js') }}"></script>

    <!-- vector map js-->
    <script src="{{ asset('realtor/assets/js/vector-map/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('realtor/assets/js/vector-map/jquery-jvectormap-asia-mill.js') }}"></script>

    <!--admin js -->
    <script src="{{ asset('realtor/assets/js/report.js') }}"></script>
    <script src="{{ asset('themes/classic/admin/assets/js/admin-script.js') }}"></script>

    <!-- Customizer js-->
    <script src="{{ asset('themes/classic/admin/assets/js/customizer.js') }}"></script>

    <!-- Color-picker js-->
    <script src="{{ asset('themes/classic/admin/assets/js/color/custom-colorpicker.js') }}"></script>

    <script src="https://unpkg.com/feather-icons"></script>

    <script src="{{ asset('realtor/assets/js/checker.js') }}">
        < script >

            @stack('scripts')


            <
            /body>

            <
            /html>
