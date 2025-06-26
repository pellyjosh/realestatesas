<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sheltos - Filter search with slider home page">
    <meta name="keywords" content="sheltos">
    <meta name="author" content="sheltos">
    <link rel="icon" href="https://themes.pixelstrap.com/sheltos/assets/images/favicon.png" type="image/x-icon" />
    <title>@yield('title', 'Master Page')</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- range slider css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('client/assets/css/jquery-ui.css') }}">

    <!-- animate css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('client/assets/css/animate.css') }}">

    <!-- Template css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('client/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('client/assets/css/color1.css') }}">

    <style>
        /* Sticky WhatsApp Button */
        .whatsapp-sticky-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background-color: #25D366;
            color: #FFF;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            box-shadow: 0 4px S12px rgba(0, 0, 0, 0.15);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease-in-out;
        }

        .whatsapp-sticky-button:hover {
            transform: scale(1.1) translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            color: #FFF;
        }

        /* Dark mode adjustments */
        html.dark .whatsapp-sticky-button {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
        }

        html.dark .whatsapp-sticky-button:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>

    <!-- Loader start -->
    <div class="loader-wrapper">
        <div class="row loader-text">
            <div class="col-12">
                <img src="{{ asset('client/assets/images/loader/loader.gif') }}" class="img-fluid" alt="">
            </div>
            <div class="col-12">
                <div>
                    <h3 class="mb-0">Please wait portal loading...</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Loader end -->

    <!-- header start -->
    <header class="header-1 header-6">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="menu">
                        <div class="brand-logo">
                            <a href="{{ route('client.home') }}">
                                <img src="{{ asset('client/assets/images/logo.png') }}" alt=""
                                    class="img-fluid">
                            </a>
                        </div>
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
                                            <a href="{{ route('client.home') }}" class="nav-link">Home</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('client.events') }}" class="nav-link">Events</a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="javascript:void(0)" class="nav-link menu-title">Contact</a>
                                            <ul class="nav-submenu menu-content">
                                                <li><a href="contact-1.html">Contact us 1</a></li>
                                                <li><a href="contact-2.html">Contact us 2</a></li>
                                                <li><a href="contact-3.html">Contact us 3</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <ul class="header-right">
                            <li class="right-menu color-6">
                                <ul class="nav-menu">

                                    <li class="dropdown">
                                        <a href="user-favourites.html">
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
                                                    <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/2.jpg"
                                                        class="img-fluid" alt="">
                                                    <div class="media-body">
                                                        <a href="single-property-8.html">
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
                                                    <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/3.jpg"
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

                                    <li class="dropdown">
                                        <a href="login.html">
                                            <i data-feather="user"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--  header end -->

    @yield('main')

    <!-- footer start -->
    <footer class="footer-brown">
        <div class="footer footer-custom-col">
            <div class="container">
                <div class="row">
                    <div class="col-xl-2 col-md-6 order-xl">
                        <div class="footer-links footer-details">
                            <h5 class="footer-title d-md-none">Contact us
                                <span class="according-menu"><i class="fas fa-chevron-down"></i></span>
                            </h5>
                            <div class="footer-content">
                                <a href="https://themes.pixelstrap.com/sheltos/index.html">
                                    <img src="{{ asset('client/assets/images/logo.png') }}" alt=""
                                        class="img-fluid">
                                </a>
                                <p>This home provides entertaining spaces with a kitchen opening...</p>
                                <div class="footer-contact">
                                    <ul>
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>A-32, Albany, Newyork.
                                        </li>
                                        <li>
                                            <i class="fas fa-phone-alt"></i>(+066) 518 - 457 - 5181
                                        </li>
                                        <li>
                                            <i class="fas fa-envelope"></i>Contact@gmail.com
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-3">
                        <div class="footer-links footer-left-space">
                            <h5 class="footer-title">About
                                <span class="according-menu"><i class="fas fa-chevron-down"></i></span>
                            </h5>
                            <ul class="footer-content">
                                <li>
                                    <a href="">About us</a>
                                </li>
                                <li>
                                    <a href="">Listing</a>
                                </li>
                                <li>
                                    <a href="">Property</a>
                                </li>
                                <li>
                                    <a href="">Page</a>
                                </li>
                                <li>
                                    <a href="">Module</a>
                                </li>
                                <li>
                                    <a href="">Blog</a>
                                </li>
                                <li><a href="">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 order-xl">
                        <div class="footer-links">
                            <h5 class="footer-title">Our Location
                                <span class="according-menu"><i class="fas fa-chevron-down"></i></span>
                            </h5>
                            <div class="footer-content">
                                <div class="footer-map">
                                    <iframe title="realestate location"
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.1583091352!2d-74.11976373946229!3d40.69766374859258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1563449626439!5m2!1sen!2sin"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-3 order-lg">
                        <div class="footer-links footer-left-space">
                            <h5 class="footer-title">Tag
                                <span class="according-menu"><i class="fas fa-chevron-down"></i></span>
                            </h5>
                            <ul class="footer-content">
                                <li>
                                    <a href="">Blog</a>
                                </li>
                                <li>
                                    <a href="">Blog list</a>
                                </li>
                                <li>
                                    <a href="">Creative blog</a>
                                </li>
                                <li>
                                    <a href="">Masonry</a>
                                </li>
                                <li>
                                    <a href="">Mix blog</a>
                                </li>
                                <li>
                                    <a href="">Details</a>
                                </li>
                                <li>
                                    <a href="">Video</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="footer-links">
                            <h5 class="footer-title">Our Latest Blog
                                <span class="according-menu"><i class="fas fa-chevron-down"></i></span>
                            </h5>
                            <div class="footer-content">
                                <div class="footer-blog">
                                    <div class="media">
                                        <a href="blog-detail-left-sidebar.html">
                                            <div class="img-overlay">
                                                <img src="{{ asset('client/assets/images/footer/1.jpg') }}"
                                                    alt="">
                                            </div>
                                        </a>
                                        <div class="media-body">
                                            <h6><a href="blog-detail-left-sidebar.html">Top News</a></h6>
                                            <p class="font-roboto mb-0"><a
                                                    href="blog-detail-right-sidebar.html">Apartment or Flat An
                                                    individual unit in a multi-unit building.</a></p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <a href="blog-detail-left-sidebar.html">
                                            <div class="img-overlay">
                                                <img src="{{ asset('client/assets/images/footer/2.jpg') }}"
                                                    alt="">
                                            </div>
                                        </a>
                                        <div class="media-body">
                                            <h6><a href="blog-detail-left-sidebar.html">Latest News</a></h6>
                                            <p class="font-roboto mb-0"><a
                                                    href="blog-detail-right-sidebar.html">Residences can be classified
                                                    and connected to residences..</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="footer-social sub-footer-link">
                            <ul>
                                <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href=""><i class="fab fa-instagram"></i></a></li>
                                <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                <li><a href=""><i class="fab fa-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 text-end">
                        <div class="copy-right">
                            <p class="mb-0">Copyright 2022 Sheltos By <i data-feather="heart"></i> Pixelstrap</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->

    <!-- Sticky WhatsApp Button -->
    {{-- Replace 1234567890 with your WhatsApp number --}}
    <a href="https://wa.me/1234567890?text=Hello!%20I'm%20interested%20in%20your%20services."
        class="whatsapp-sticky-button" target="_blank" title="Chat with us on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- tap to top start -->
    <div class="tap-top color-6">
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
                    <h6 class="color-6">Layout type</h6>
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
                    <h6 class="color-6">Layout Direction</h6>
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
                    <h6 class="color-6">Unlimited Color</h6>
                </div>
                <div class="option-setting unlimited-color-layout">
                    <input id="ColorPicker8" type="color" value="#2c2e97" name="Default">
                    <input id="ColorPicker9" type="color" value="#4b55c4" name="Default">
                </div>
            </div>
        </div>
    </div>
    <!-- customizer end -->

    <!-- latest jquery-->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/jquery-3.6.0.min.js"></script>

    <!-- popper js-->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/popper.min.js"></script>

    <!-- Bootstrap js-->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/bootstrap.bundle.min.js"></script>

    <!-- range slider js -->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/jquery-ui.js"></script>
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/range-slider.js"></script>

    <!-- feather icon js-->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/feather-icon/feather.min.js"></script>
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/feather-icon/feather-icon.js"></script>

    <!-- slick js -->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/slick.js"></script>
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/slick-animation.min.js"></script>
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/custom-slick.js"></script>

    <!-- notify js -->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/bootstrap-notify.min.js"></script>

    <!-- wow js-->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/wow.min.js"></script>

    <!-- Template js-->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/script.js"></script>

    <!-- Customizer js-->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/customizer.js"></script>

    <!-- Color-picker js-->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/color/layout3.js"></script>

</body>



</html>
