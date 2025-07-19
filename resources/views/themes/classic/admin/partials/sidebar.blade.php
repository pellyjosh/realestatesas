 <!-- page sidebar start -->
 <div class="page-sidebar">
     <div class="logo-wrap">
         <a href="{{ route('tenant.admin.dashboard') }}">
             <img src="{{ asset('themes/classic/client/assets/images/logo2.png') }}" class="img-fluid for-light"
                 alt="">
             <img src="{{ asset('themes/classic/client/assets/images/logo2.png') }}" class="img-fluid for-dark"
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
                     <img src="{{ asset('themes/classic/admin/assets/images/avatar/3.jpg') }}" class="img-fluid"
                         alt="">
                 </div>
                 <div class="media-body">
                     <a href="{{ route('tenant.user.profile') }}">
                         <h6>Zack Lee</h6>
                     </a>
                     <span class="font-roboto">zackle@gmail.com</span>
                 </div>
             </div>
         </div>
         <div id="mainsidebar">
             <ul class="sidebar-menu custom-scrollbar">
                 <li class="sidebar-item">
                     <a href="{{ route('tenant.admin.dashboard') }}" class="sidebar-link only-link">
                         <i data-feather="airplay"></i>
                         <span>Dashboard</span>
                     </a>
                 </li>
                 <li class="sidebar-item">
                     <a href="javascript:void(0)" class="sidebar-link">
                         <i data-feather="grid"></i>
                         <span>My properties</span>
                     </a>
                     <ul class="nav-submenu menu-content">
                         <li>
                             <a href="{{ route('tenant.admin.add.property') }}">
                                 <i data-feather="chevrons-right"></i>
                                 add property
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('tenant.admin.edit.property') }}">
                                 <i data-feather="chevrons-right"></i>
                                 edit property
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('tenant.admin.listing') }}">
                                 <i data-feather="chevrons-right"></i>
                                 property list
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('tenant.admin.favourites') }}">
                                 <i data-feather="chevrons-right"></i>
                                 Favourites
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="sidebar-item">
                     <a href="javascript:void(0)" class="sidebar-link">
                         <i data-feather="users"></i>
                         <span>Manage users</span>
                     </a>
                     <ul class="nav-submenu menu-content">
                         <li>
                             <a href="{{ route('tenant.admin.add.user') }}">
                                 <i data-feather="chevrons-right"></i>
                                 Add user
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('tenant.admin.add.user.wizard') }}">
                                 <i data-feather="chevrons-right"></i>
                                 Add user wizard <span class="label label-shadow ms-1">new</span>
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('tenant.edit.user') }}">
                                 <i data-feather="chevrons-right"></i>
                                 Edit user
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('tenant.all.users') }}">
                                 <i data-feather="chevrons-right"></i>
                                 All users
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="sidebar-item">
                     <a href="javascript:void(0)" class="sidebar-link">
                         <i data-feather="user-plus"></i>
                         <span>Manage Admins</span>
                     </a>
                     <ul class="nav-submenu menu-content">
                         <li>
                             <a href="{{ route('tenant.admin.add') }}">
                                 <i data-feather="chevrons-right"></i>
                                 Add Admin
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('tenant.admin.add.wizard') }}">
                                 <i data-feather="chevrons-right"></i>
                                 Add Admin wizard <span class="label label-shadow ms-1">new</span>
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('tenant.admin.edit') }}">
                                 <i data-feather="chevrons-right"></i>
                                 Edit Admin
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('tenant.admin.all') }}">
                                 <i data-feather="chevrons-right"></i>
                                 All Admins
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('tenant.admin.invoice') }}">
                                 <i data-feather="chevrons-right"></i>
                                 Invoice
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="sidebar-item">
                     <a href="javascript:void(0)" class="sidebar-link">
                         <i data-feather="user-plus"></i>
                         <span>Manage Realtors</span>
                     </a>
                     <ul class="nav-submenu menu-content">
                         <li>
                             <a href="{{ route('tenant.admin.add.realtor') }}">
                                 <i data-feather="chevrons-right"></i>
                                 Add Realtor
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('tenant.admin.add.realtor.wizard') }}">
                                 <i data-feather="chevrons-right"></i>
                                 Add Realtor wizard <span class="label label-shadow ms-1">new</span>
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('tenant.admin.edit.realtor') }}">
                                 <i data-feather="chevrons-right"></i>
                                 Edit Realtor
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('tenant.admin.all.realtors') }}">
                                 <i data-feather="chevrons-right"></i>
                                 All Realtors
                             </a>
                         </li>

                     </ul>
                 </li>
                 <li class="sidebar-item">
                     <a href="{{ route('tenant.admin.events') }}" class="sidebar-link only-link">
                         <i data-feather="calendar"></i>
                         <span>Events</span>
                     </a>
                 </li>
                 <li class="sidebar-item">
                     <a href="{{ route('tenant.admin.reports') }}" class="sidebar-link only-link">
                         <i data-feather="bar-chart-2"></i>
                         <span>Reports</span>
                     </a>
                 </li>
                 <li class="sidebar-item">
                     <a href="{{ route('tenant.admin.transactions') }}" class="sidebar-link only-link">
                         <i data-feather="dollar-sign"></i>
                         <span>Transactions</span>
                     </a>
                 </li>
                 <li class="sidebar-item">
                     <a href="{{ route('tenant.admin.withdrawal') }}" class="sidebar-link only-link">
                         <i data-feather="credit-card"></i>
                         <span>Withdrawal</span>
                     </a>
                 </li>
                 <li class="sidebar-item">
                     <a href="{{ route('tenant.admin.sales') }}" class="sidebar-link only-link">
                         <i data-feather="bar-chart-2"></i>
                         <span>Sales</span>
                     </a>
                 </li>
                 <li class="sidebar-item">
                     <a href="javascript:void(0)" class="sidebar-link">
                         <i data-feather="settings"></i>
                         <span>Settings</span>
                     </a>
                     <ul class="nav-submenu menu-content">
                         <li class="sidebar-item">
                             <a href="{{ route('tenant.admin.section') }}" class="sidebar-link only-link">
                                 <i data-feather="chevrons-right"></i>
                                 <span>Section</span>
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('tenant.admin.payment.plans') }}">
                                 <i data-feather="chevrons-right"></i>
                                 <span>Payment Plans</span>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="sidebar-item">
                     <a href="javascript:void(0)" class="sidebar-link">
                         <i data-feather="target"></i>
                         <span>Marketing Tools</span>
                     </a>
                     <ul class="nav-submenu menu-content">
                         <li class="sidebar-item">
                             <a href="{{ route('tenant.admin.leads') }}" class="sidebar-link only-link">
                                 <i data-feather="chevrons-right"></i>
                                 <span>Leads</span>
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('tenant.admin.ai.ad.generator') }}">
                                 <i data-feather="chevrons-right"></i>
                                 <span>AI Ad Generator</span>
                             </a>
                         </li>
                     </ul>
                 </li>
             </ul>
         </div>
     </div>
 </div>
 <!-- page sidebar end -->
