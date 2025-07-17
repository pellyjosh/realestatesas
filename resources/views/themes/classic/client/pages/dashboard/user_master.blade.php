    @extends('themes.classic.client.client_master')
    @section('main')
        <!-- header start -->
        @include('themes.classic.client.partials.headers')
        <!--  header end -->

        @include('themes.classic.client.partials.breadcrumb')

        <!-- user dashboard section start -->
        <section class="user-dashboard small-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="sidebar-user sticky-cls">
                            <div class="user-profile">
                                <div class="media">
                                    <div class="change-pic">
                                        <img src="{{ asset('themes/classic/admin/assets/images/avatar/3.jpg') }}"
                                            class="img-fluid update_img" alt="">
                                        <div class="change-hover">
                                            <button type="button" class="btn"><i data-feather="camera"></i></button>
                                            <input class="updateimg" type="file" name="img"
                                                onchange="readURL(this,0)">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5>Zack Lee</h5>
                                        <h6 class="font-roboto">zackle@gmail.com</h6>
                                        <h6 class="font-roboto mb-0">+91 846 - 547 - 210</h6>
                                    </div>
                                </div>
                                <div class="connected-social">
                                    <h6>Connect with</h6>
                                    <ul class="agent-social">
                                        <li><a href="https://www.facebook.com/" class="facebook"><i
                                                    class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li>
                                            <a href="https://whatsapp.com/" class="twitter"
                                                style="background-color: #25d366">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="dashboard-list">
                                <ul class="nav nav-tabs right-line-tab">
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('tenant.user.dashboard') }}">Dashboard</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('tenant.user.properties') }}">My
                                            Properties</a></li>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('tenant.user.profile') }}">My
                                            profile</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('tenant.user.favorites') }}">favourites</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('tenant.user.payment') }}">Cards
                                            &
                                            payment</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('tenant.user.privacy') }}">Privacy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
        </section>
        <!-- user dashboard section end -->

        @push('scripts')
            <!-- chartist chart js-->
            <script src="{{ asset('themes/classic/admin/assets/js/chart/chartist/chartist.js') }}"></script>
            <script src="{{ asset('themes/classic/admin/assets/js/chart/chartist/chartist-plugin-tooltip.js') }}"></script>

            <!-- apexchart js-->
            <script src="{{ asset('themes/classic/admin/assets/js/chart/apex-chart/apex-chart.js') }}"></script>

            <!-- dashboard js-->
            <script src="{{ asset('themes/classic/client/assets/js/dashboard.js') }}"></script>

            <!-- wow js-->
            <script src="{{ asset('themes/classic/client/assets/js/wow.min.js') }}"></script>
        @endpush
    @endsection
