 <!-- page sidebar start -->
            <div class="page-sidebar">
                <div class="logo-wrap">
                    <a href="{{ route('tenant.realtor.dashboard') }}">
                        <img src="{{ asset('themes/classic/client/assets/images/logo2.png') }}"
                            class="img-fluid for-light" alt="">
                        <img src="{{ asset('themes/classic/client/assets/images/logo2.png') }}"
                            class="img-fluid for-dark" alt="">
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
                                <h6>{{ Auth::guard('tenant')->user()->name }}</h6>
                                {{-- </a> --}}
                                <span class="font-roboto">{{ Auth::guard('tenant')->user()->email }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Main sidebar start --}}
                    <div id="mainsidebar">
                        <ul class="sidebar-menu custom-scrollbar">
                            <li class="sidebar-item active">
                                <a href="{{ route('tenant.realtor.dashboard') }}"
                                    class="sidebar-link only-link active">
                                    <i data-feather="airplay"></i>
                                    <span class="">Dashboard</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a href="{{ route('tenant.realtor.landing-page-list') }}"
                                    class="sidebar-link only-link {{ request()->is('realtor/landing-page*') ? 'active' : '' }}">
                                    <i data-feather="user"></i>
                                    <span>Landing Page</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a href="{{ route('tenant.realtor.referrals') }}"
                                    class="sidebar-link only-link {{ request()->is('realtor/referrals*') ? 'active' : '' }}">
                                    <i data-feather="users"></i>
                                    <span>Referrals</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('tenant.realtor.events') }}"
                                    class="sidebar-link only-link {{ request()->is('realtor/events*') ? 'active' : '' }}">
                                    <i data-feather="calendar"></i>
                                    <span>Events</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('tenant.realtor.sales') }}"
                                    class="sidebar-link only-link {{ request()->is('realtor/sales*') ? 'active' : '' }}">
                                    <i data-feather="dollar-sign"></i>
                                    <span>Sales</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('tenant.realtor.payments') }}"
                                    class="sidebar-link only-link {{ request()->is('realtor/payments*') ? 'active' : '' }}">
                                    <i data-feather="credit-card"></i>
                                    <span>Payments</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('tenant.realtor.reports') }}"
                                    class="sidebar-link only-link {{ request()->is('realtor/reports*') ? 'active' : '' }}">
                                    <i data-feather="bar-chart-2"></i>
                                    <span>Reports</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('tenant.realtor.profile') }}"
                                    class="sidebar-link only-link {{ request()->is('realtor/profile*') ? 'active' : '' }}">
                                    <i data-feather="user"></i>
                                    <span>Profile</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- page sidebar end -->