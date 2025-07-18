<!-- Top Bar -->
<nav class="navbar p-l-5 p-r-5">
    <ul class="nav navbar-nav navbar-left">
        <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
            </div>
        <li>
        </li>
        <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a>
        </li>
        <li class="hidden-md-down"><a href="{{ route('superadmin.events') }}" title="Events"><i
                    class="zmdi zmdi-calendar"></i></a></li>
        <li class="hidden-md-down"><a href="{{ route('superadmin.inbox') }}" title="Inbox"><i
                    class="zmdi zmdi-email"></i></a></li>
        <li><a href="{{ route('superadmin.contact') }}" title="Contact List"><i
                    class="zmdi zmdi-account-box-phone"></i></a></li>
        <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                role="button"><i class="zmdi zmdi-notifications"></i>
                <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
            </a>
            <ul class="dropdown-menu pullDown">
                <li class="body">
                    <ul class="menu list-unstyled">
                        <li>
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object w60"
                                        src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/image-gallery/1.jpg"
                                        alt="">
                                    <div class="media-body">
                                        <span class="name">Sophia <span class="time">For Sale</span></span>
                                        <span class="message">Relaxing Apartment</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object w60"
                                        src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/image-gallery/2.jpg"
                                        alt="">
                                    <div class="media-body">
                                        <span class="name">Sophia <span class="time">For Rent</span></span>
                                        <span class="message">Co-op Apartment in Bay Terrace</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object w60"
                                        src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/image-gallery/3.jpg"
                                        alt="">
                                    <div class="media-body">
                                        <span class="name">Isabella <span class="time">For Rent</span></span>
                                        <span class="message">A must see Villa on Chicago Ave</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object w60"
                                        src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/image-gallery/4.jpg"
                                        alt="">
                                    <div class="media-body">
                                        <span class="name">Alexander <span class="time">For Sale</span></span>
                                        <span class="message">5 Room Apartment Special Deal</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object w60"
                                        src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/image-gallery/5.jpg"
                                        alt="">
                                    <div class="media-body">
                                        <span class="name">Grayson <span class="time">For Rent</span></span>
                                        <span class="message">Real House Luxury Villa</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="footer"> <a href="javascript:void(0);">View All</a> </li>
            </ul>
        </li>
        <li class="hidden-sm-down">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search...">
                <span class="input-group-addon"><i class="zmdi zmdi-search"></i></span>
            </div>
        </li>
        <li class="float-right">
            <a href="{{ route('superadmin.login') }}" class="mega-menu" data-close="true"><i
                    class="zmdi zmdi-power"></i></a>
            <a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i
                    class="zmdi zmdi-settings zmdi-hc-spin"></i></a>
        </li>
    </ul>
</nav>
