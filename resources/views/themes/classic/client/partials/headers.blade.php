    <!-- header start -->
    <header class="header-1 header-6">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="menu">
                        <div class="brand-logo">
                            <a href="{{ route('tenant.client.home') }}">
                                <img src="{{ asset(tenant()->logo_path) }}" alt="{{ tenant()->logo_path }}"
                                    class="img-fluid">
                            </a>
                        </div>
                        {{-- {{ dd($tenantLogo) }} --}}
                        <nav>
                            <div class="main-navbar">
                                <div id="mainnav">
                                    <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                    <ul class="nav-menu">
                                        <li class="back-btn">
                                            <div class="mobile-back text-end">
                                                <span>Back</span>
                                                <i aria-hidden="true" class="fa fa-angle-right ps-2"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="{{ route('tenant.client.home') }}" class="nav-link">Home</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('tenant.client.events') }}" class="nav-link">Events</a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="{{ route('tenant.client.contact') }}"
                                                class="nav-link menu-title">Contact</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <ul class="header-right d-flex align-items-center">
                            <li class="right-menu color-6">
                                <ul class="nav-menu d-flex align-items-center gap-2">
                                    <li class="dropdown">
                                        <a href="{{ route('tenant.user.favorites') }}">
                                            <i data-feather="heart"></i>
                                        </a>
                                    </li>
                                    <li class="dropdown cart">
                                        <a href="javascript:void(0)">
                                            <i data-feather="shopping-cart"></i>
                                        </a>
                                        <ul class="nav-submenu">
                                            <li>
                                                <div class="media">
                                                    <img src="{{ asset('themes/classic/client/assets/images/property/2.jpg') }}"
                                                        class="img-fluid" alt="">
                                                    <div class="media-body">
                                                        <a href="single-propertyx-8.html">
                                                            <h5>Magnolia Ranch</h5>
                                                        </a>
                                                        <span>$120.00*</span>
                                                    </div>
                                                </div>
                                                <div class="close-circle">
                                                    <a href="javascript:void(0)"><i class="fa fa-times"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <img src="{{ asset('themes/classic/client/assets/images/property/3.jpg') }}"x
                                                        class="img-fluid" alt="">
                                                    <div class="media-body">
                                                        <a href="single-property-8.html">
                                                            <h5>Magnolia Ranch</h5>
                                                        </a>
                                                        <span>$140.00*</span>
                                                    </div>
                                                </div>
                                                <div class="close-circle">
                                                    <a href="javascript:void(0)"><i class="fa fa-times"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="total">
                                                    <h5>Subtotal :- <span class="float-end">$260.00</span></h5>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>

                                    @auth
                                        <li class="dropdown profile">
                                            <a href="javascript:void(0)" class="nav-link dropdown-toggle"
                                                data-bs-toggle="dropdown">
                                                <i data-feather="user"
                                                    style="width: 20px; height: 20px; line-height: 30px; text-align: center; font-size: 16px;"></i>
                                            </a>
                                            <ul class="nav-submenu dropdown-menu">
                                                <li><a href="{{ route('tenant.dashboard') }}">Dashboard</a></li>
                                                <li><a href="{{ route('tenant.profile.edit') }}">Profile</a></li>
                                                <li>
                                                    <form method="POST" action="{{ route('tenant.logout') }}">
                                                        @csrf
                                                        <a href="{{ route('tenant.logout') }}"
                                                            onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                    @else
                                        <li class="dropdown profile">
                                            <a href="javascript:void(0)" class="nav-link dropdown-toggle"
                                                data-bs-toggle="dropdown">
                                                <i data-feather="user"></i>
                                            </a>
                                            <ul class="nav-submenu dropdown-menu">
                                                <li><a href="{{ route('tenant.login') }}">Login</a></li>
                                                <li><a href="{{ route('tenant.user.dashboard') }}">Dashboard</a></li>
                                            </ul>
                                        </li>
                                    @endauth
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--  header end -->
