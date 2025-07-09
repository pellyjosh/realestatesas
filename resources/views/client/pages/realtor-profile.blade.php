<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Premium Refined Homes - Realtor profile page">
    <meta name="keywords" content="Premium Refined Homes - Realtor profile page">
    <meta name="author" content="Premium Refined Homes - Realtor profile page">
    <link rel="icon" href="{{ asset('client/assets/images/logo.png') }}" type="image/x-icon" />
    <title>Premium Refined Homes - Realtor profile page" - Realtor profile page</title>

   <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">

    <!-- magnific css -->
    <link rel="stylesheet" type="text/css" href="https://themes.pixelstrap.com/sheltos/assets/css/magnific-popup.css">

    <!-- range slider css -->
    <link rel="stylesheet" type="text/css" href="https://themes.pixelstrap.com/sheltos/assets/css/jquery-ui.css">

    <!-- animate css -->
    <link rel="stylesheet" type="text/css" href="https://themes.pixelstrap.com/sheltos/assets/css/animate.css">

    <!-- Template css -->
    <link rel="stylesheet" type="text/css" href="https://themes.pixelstrap.com/sheltos/assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://themes.pixelstrap.com/sheltos/assets/css/color1.css">

    <!-- Font Awesome 6 Free CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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

    <!-- header start -->
    <header class="header-1 header-6">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="menu">
                        <div class="brand-logo">
                            <a href="{{ route('client.home') }}">
                                <img src="{{ asset('client/assets/images/logo.png') }}" alt=""
                                    class="img-fluid" style="max-width: 40%;">
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
                                            <a href="{{ route('client.contact') }}"
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
                                                    <img src="{{ asset('client/assets/images/property/2.jpg') }}"
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
                                                    <img src="{{ asset('client/assets/images/property/3.jpg') }}"x
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
                                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                                <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                                                <li>
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <a href="{{ route('logout') }}"
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
                                                <li><a href="{{ route('login') }}">Login</a></li>
                                                <li><a href="{{ route('register') }}">Register</a></li>
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


    <!-- breadcrumb start -->
    <section class="breadcrumb-section p-0">
        <img src="https://themes.pixelstrap.com/sheltos/assets/images/inner-background.jpg" class="bg-img img-fluid" alt="">
        <div class="container">
            <div class="breadcrumb-content">
                <div>
                    <h2>Realtor Profile</h2>
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route("client.home") }}l">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Realtor Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- agent profile section start -->
    <section class="agent-section property-section agent-profile-wrap">
        <div class="container">
            <div class="row ratio_55">
                <div class="container">
                    <div class="our-agent theme-card">
                        <div class="row">
                            <div class="col-sm-6 ratio_landscape">
                                <div class="agent-image">
                                    <img src="https://themes.pixelstrap.com/sheltos/assets/images/avatar/5.jpg" class="img-fluid bg-img" alt="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="our-agent-details">
                                    <h3 class="f-w-600">Jonathan Scott</h3>
                                    <h6>Real estate Property Realtor</h6>
                                    <ul>
                                        <li>
                                            <div class="media">
                                                <div class="icons-square">
                                                    <i data-feather="map-pin"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6>A-32, Albany, Newyork.</h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="icons-square">
                                                    <i data-feather="phone-call"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6>(+066) 518 - 457 - 5181</h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="icons-square">
                                                    <i data-feather="mail"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6>Contact@gmail.com</h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="with-link">
                                        </li>
                                    </ul>
                                </div>
                                <ul class="agent-social">
                                    <li><a href="https://www.facebook.com/" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
                                    <li>
                                        <a href="https://whatsapp.com/" class="twitter" style="background-color: #25d366">
                                            <i class="fab fa-whatsapp"></i>
                                          </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="about-agent theme-card">
                        <h3>About the agent</h3>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="font-roboto">Residences can be classified by and how they are connected residences and land. Different types 
                                    of housing tenure can be used for the same physical type.</p>
                            </div>
                            <div class="col-sm-4">
                                <p class="font-roboto">Connected residences owned by a single entity leased out, or owned separately with an agreement covering the relationship between units and common areas.</p>
                            </div>
                            <div class="col-sm-4">
                                <p class="font-roboto">Residential real estate may contain either a single family or multifamily structure that is available for occupation or 
                                    for non-business purposes.</p>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
    <!-- agent profile section end -->

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
                                <a href="{{ route('client.home') }}">
                                    <img src="{{ asset('client/assets/images/logo.png') }}" alt=""
                                        class="img-fluid">
                                </a>
                                <p>This home provides entertaining spaces with a kitchen opening...</p>
                                <div class="footer-contact">
                                    <ul>
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>Suite 201, Capital Center Complex,
                                            Summit Road,Asaba Delta State, Nigeria
                                        </li>
                                        <li>
                                            <i class="fas fa-phone-alt"> 00851030093 | 07037495700 | 08149491659</i>
                                        </li>
                                        {{-- <li>
                                            <i class="fas fa-envelope"></i>Contact@gmail.com
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-md-3">
                        <div class="footer-links footer-left-space">
                            <h5 class="footer-title">Quick Link
                                <span class="according-menu"><i class="fas fa-chevron-down"></i></span>
                            </h5>
                            <ul class="footer-content">
                                <li>
                                    <a href="{{ route('client.home') }}">Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('client.events') }}">Events</a>
                                </li>
                                <li>
                                    <a href="{{ route('client.contact') }}">Contact</a>
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
                            <p class="mb-0">Copyright 2025 Premium Refined By 💚 Hubolux Technologies.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->

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
                    <h6 class="color-2">Layout type</h6>
                </div>
                <div class="option-setting">
                    <span>Light</span>
                    <label class="switch">
                        <input type="checkbox" name="chk1" value="option" class="setting-check"><span class="switch-state"></span>
                    </label>
                    <span>Dark</span>
                </div>
            </div>
            <div class="layouts-settings">
                <div class="customizer-title">
                    <h6 class="color-2">Layout Direction</h6>
                </div>
                <div class="option-setting">
                    <span>LTR</span>
                    <label class="switch">
                        <input type="checkbox" name="chk2" value="option" class="setting-check1"><span class="switch-state"></span>
                    </label>
                    <span>RTL</span>
                </div>
            </div>
            <div class="layouts-settings">
                <div class="customizer-title">
                    <h6 class="color-2">Unlimited Color</h6>
                </div>
                <div class="option-setting unlimited-color-layout">
                    <div class="form-group">
                        <label for="ColorPicker3">color 3</label>
                        <input id="ColorPicker3" type="color" value="#ff5c41" name="Default">
                    </div> 
                    <div class="form-group">
                        <label for="ColorPicker4">color 4</label>
                        <input id="ColorPicker4" type="color" value="#ff8c41" name="Default">
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <!-- customizer end -->

    <!-- latest jquery-->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/jquery-3.6.0.min.js"></script>

    <!-- popper js-->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/popper.min.js"></script>

    <!-- magnific js -->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/jquery.magnific-popup.js"></script>
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/zoom-gallery.js"></script>

    <!-- Bootstrap js-->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/bootstrap.bundle.min.js"></script>

    <!-- feather icon js-->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/feather-icon/feather.min.js"></script>
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/feather-icon/feather-icon.js"></script>

    <!-- range slider js -->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/jquery-ui.js"></script>
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/range-slider.js"></script>

    <!-- slick js -->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/slick.js"></script>
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/slick-animation.min.js"></script>
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/custom-slick.js"></script>

    <!--grid js -->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/grid-list.js"></script>

    <!-- Template js-->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/script.js"></script>

    <!-- Customizer js-->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/customizer.js"></script>

    <!-- Color-picker js-->
    <script src="https://themes.pixelstrap.com/sheltos/assets/js/color/single-property.js"></script>

</body>


<!-- Mirrored from themes.pixelstrap.com/sheltos/main/agent-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Jun 2025 13:52:25 GMT -->
</html>