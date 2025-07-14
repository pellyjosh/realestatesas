<aside id="leftsidebar" class="sidebar">
    <div class="tab-content">
        <div class="tab-pane stretchRight active" id="dashboard">
            <div class="menu">
                <ul class="list">
                    <li>
                        <div class="user-info">
                            <div class="image"><a href="{{ route('superadmin.profile') }}"><img
                                        src="{{ asset('superadmin/assets/images/profile_av.jpg') }}" alt="User"></a>
                            </div>
                            <div class="detail">
                                <h4>Michael</h4>
                                <small>Admin</small>
                            </div>
                            <a title="facebook" href="javascript:void(0);"><i class="zmdi zmdi-facebook"></i></a>
                            <a title="twitter" href="javascript:void(0);"><i class="zmdi zmdi-twitter"></i></a>
                            <a title="instagram" href="javascript:void(0);"><i class="zmdi zmdi-instagram"></i></a>
                        </div>
                    </li>
                    <li class="{{ request()->routeIs('superadmin.index') ? 'active open' : '' }}">
                        <a href="{{ route('superadmin.index') }}">
                            <i class="zmdi zmdi-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('superadmin.domains') ? 'active open' : '' }}">
                        <a href="{{ route('superadmin.domains') }}">
                            <i class="zmdi zmdi-city"></i>
                            <span>Domains</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('superadmin.templates') ? 'active open' : '' }}">
                        <a href="{{ route('superadmin.templates') }}">
                            <i class="zmdi zmdi-city"></i>
                            <span>Templates</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('superadmin.subscriptions') ? 'active open' : '' }}">
                        <a href="{{ route('superadmin.subscriptions') }}"><i
                                class="zmdi zmdi-accounts-outline"></i><span>Subscription & Billing</span></a>
                    </li>
                    <li><a href="{{ route('superadmin.admins') }}"><i
                                class="zmdi zmdi-case-check"></i><span>Admins</span></a>
                    </li>
                    <li
                        class="{{ request()->routeIs('superadmin.inbox', 'superadmin.compose.mail', 'superadmin.events', 'superadmin.contact') ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-apps"></i><span>App</span></a>
                        <ul class="ml-menu">
                            <li class="{{ request()->routeIs('superadmin.inbox') ? 'active' : '' }}"><a
                                    href="{{ route('superadmin.inbox') }}">Inbox</a></li>
                            <li class="{{ request()->routeIs('superadmin.compose.mail') ? 'active' : '' }}"><a
                                    href="{{ route('superadmin.compose.mail') }}">Compose Mail</a></li>
                            <li class="{{ request()->routeIs('superadmin.events') ? 'active' : '' }}"><a
                                    href="{{ route('superadmin.events') }}">Events</a></li>
                            <li class="{{ request()->routeIs('superadmin.contact') ? 'active' : '' }}"><a
                                    href="{{ route('superadmin.contact') }}">Contact list</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>
