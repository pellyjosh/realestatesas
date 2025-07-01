<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sheltos - Modal details property details page">
    <meta name="keywords" content="Premium Refined Luxury Homes, Real Estate, Property Details, Modal Details">
    <meta name="author" content="Premium Refined Luxury Homes">
    <link rel="icon" href="{{ asset('client/assets/images/logo.png') }}" type="image/x-icon" />
    <title>Sheltos - Modal details property details page</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">

    <!-- Font Awesome 6 Free CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- magnific css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('realtor/assets/css/magnific-popup.css') }}">

    <!-- range slider css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('client/assets/css/jquery-ui.css') }}">

    <!-- animate css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('client/assets/css/animate.css') }}">

    <!-- Template css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('client/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('client/assets/css/color1.css') }}">

</head>

<body>

    <!-- Loader start -->
    <div class="loader-wrapper">
        <div class="row loader-img">
            <div class="col-12">
                <img src="https://themes.pixelstrap.com/sheltos/assets/images/loader/loader-2.gif" class="img-fluid"
                    alt="">
            </div>
        </div>
    </div>
    <!-- Loader end -->

    <!-- header start -->
    <header class="inner-page light-header shadow-cls">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="menu">
                        <div class="brand-logo">
                            <a href="{{ route('client.home') }}">
                                <img src="{{ asset('client/assets/images/logo2.png') }}" alt=""
                                    class="img-fluid">
                            </a>
                        </div>
                        <nav>
                            <div class="main-navbar">
                                <div id="mainnav">
                                    <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                    <ul class="nav-menu">
                                        <li class="dropdown">
                                            <a href="{{ route('client.home') }}" class="nav-link menu-title">Home</a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="{{ route('client.events') }}"
                                                class="nav-link menu-title">Events</a>
                                        <li class="dropdown">
                                            <a href="{{ route('client.contact') }}"
                                                class="nav-link menu-title">Contact</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--  header end -->

    <!-- single property header start -->
    <section class="without-top property-main small-section">
        <div class="single-property-section">
            <div class="container">
                <div class="single-title">
                    <div class="left-single">
                        <div class="d-flex">
                            <h2 class="mb-0">Orchard House </h2>
                            <span><span class="label label-shadow ms-2">For
                                    Sale</span></span>
                        </div>
                        <p class="mt-1">Mina Road, Bur Dubai, Dubai, United
                            Arab
                            Emirates</p>
                        <li><i class="fas fa-mountain"></i> Land : 3</li>
                        <li><i class="fas fa-building"></i> Properties : 2</li>
                        <li>
                            <i class="fas fa-ruler-combined"></i> Sq Ft : 5000
                        </li>
                        <div class="share-buttons">
                            <div class="d-inline-block">
                                <a href="javascript:void(0)" class="btn btn-gradient btn-pill color-2"><i
                                        class="far fa-share-square"></i>
                                    share
                                </a>
                                <div class="share-hover">
                                    <ul>
                                        <li>
                                            <a href="https://www.facebook.com/" class="icon-facebook"><i
                                                    data-feather="facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/" class="icon-twitter"><i
                                                    data-feather="twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="https://www.instagram.com/" class="icon-instagram"><i
                                                    data-feather="instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <a href="javascript:void(0)"
                                class="btn btn-dashed btn-pill color-2 ms-md-2 ms-1 save-btn"><i
                                    class="far fa-heart"></i>
                                Save</a>
                            <a href="javascript:void(0)" class="btn btn-dashed btn-pill color-2 ms-md-2 ms-1"
                                onclick="myFunction()"><i data-feather="printer"></i>
                                Print</a>
                        </div>
                    </div>
                    <div class="right-single">
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <h2 class="price">$20,45,472 <span>/ start From</span></h2>
                        <div class="feature-label">
                            <span class="btn btn-dashed color-2 btn-pill">Wi-fi</span>
                            <span class="btn btn-dashed color-2 ms-1 btn-pill">Swimming Pool</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- single property header end -->

    <!-- single property start -->
    <section class="single-property mt-0 pt-0">
        <div class="container">
            <div class="row ratio_55">
                <div class="col-xl-9 col-lg-8">
                    <div class="description-section tab-description">
                        <div class="description-details">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="single-gallery mb-4">
                                        <div class="blog-sidebar modal-form d-none d-lg-block">
                                            <div class="filter-cards">
                                                <div class="advance-card">
                                                    <h6>Book Inspection</h6>
                                                    <div class="category-property">
                                                        <form>
                                                            <div class="form-group mb-3">
                                                              <label>Full Name</label>
                                                              <input type="text" class="form-control" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                              <label>Email Address</label>
                                                              <input type="email" class="form-control" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                              <label>Phone Number</label>
                                                              <input type="tel" class="form-control" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                              <label>Preferred Date</label>
                                                              <input type="date" class="form-control" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                              <label>Preferred Time</label>
                                                              <input type="time" class="form-control" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                              <label>Message</label>
                                                              <textarea class="form-control" rows="3"></textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-gradient color-2 btn-block btn-pill">Submit</button>
                                                          </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gallery-for">
                                            <div>
                                                <div class="bg-size">
                                                    <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/4.jpg" class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/3.jpg" class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/14.jpg" class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/11.jpg" class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/12.jpg" class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/4.jpg" class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/3.jpg" class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/11.jpg" class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/12.jpg" class="bg-img" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gallery-nav">
                                            <div>
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/4.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div>
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/3.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div>
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/14.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div>
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/11.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div>
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/12.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div>
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/4.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div>
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/3.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div>
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/11.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div>
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/12.jpg" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-block d-lg-none mb-3">
                                <button class="btn btn-gradient color-2 btn-pill btn-block" data-bs-toggle="modal" data-bs-target="#scheduleModal">
                                    Book Inspection
                                </button>
                            </div>

                            <div class="desc-box">
                                <ul class="nav nav-tabs line-tab" id="top-tab" role="tablist">
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link active"
                                            href="#about">about</a></li>
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link"
                                            href="#feature">feature</a></li>
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#video">video</a>
                                    </li>
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#floor_plan">Floor
                                            plan</a></li>
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link"
                                            href="#location-map">location</a></li>
                                </ul>
                                <div class=" tab-content" id="top-tabContent">
                                    <div class="tab-pane fade show active about page-section" id="about">
                                        <h4 class="content-title">Property Details
                                            <a href="https://www.google.com/maps/place/New+York,+NY,+USA/@40.697488,-73.979681,8z/data=!4m5!3m4!1s0x89c24fa5d33f083b:0xc80b8f06e177fe62!8m2!3d40.7127753!4d-74.0059728?hl=en"
                                                target="_blank">
                                                <i class="fa fa-map-marker-alt"></i> view on map</a>
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-6 col-xl-4">
                                                <ul class="property-list-details">
                                                    <li><span>Property Type :</span> House</li>
                                                    <li><span>Property ID :</span> ZOEA245</li>
                                                    <li><span>Property status :</span> For sale</li>
                                                    <li><span>Operating Since :</span> 2008</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6 col-xl-4">
                                                <ul class="property-list-details">
                                                    <li><span>Price :</span> $ 1,50,000</li>
                                                    <li><span>Property Size :</span> 1730 sq / ft</li>
                                                    <li><span>Balcony :</span> 2</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6 col-xl-4">
                                                <ul class="property-list-details">
                                                    <li><span>City :</span> Newyork</li>
                                                    <li><span>Bedrooms :</span> 8</li>
                                                    <li><span>Bathrooms :</span> 4</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <h4 class="content-title mt-4">Attachments</h4>
                                        <a href="javascript:void(0)" class="attach-file"><i class="far fa-file-pdf"></i>Demo Property
                                            Document </a>
                                        <h4 class="mt-4">Property Brief</h4>
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
                                    <div class="tab-pane fade page-section" id="feature">
                                        <h4 class="content-title">features</h4>
                                        <div class="single-feature row">
                                            <div class="col-xl-3 col-6">
                                                <ul>
                                                    <li>
                                                        <i class="fas fa-wifi"></i> Free Wi-Fi
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-hands"></i> Elevator Lift
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-power-off"></i> Power Backup
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-monument"></i> Laundry Service
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-xl-3 col-6">
                                                <ul>
                                                    <li>
                                                        <i class="fas fa-user-shield"></i> Security Guard
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-video"></i> CCTV
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-door-open"></i> Emergency Exit
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-first-aid"></i> Doctor On Call
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-xl-3 col-6">
                                                <ul>
                                                    <li>
                                                        <i class="fas fa-shower"></i> Shower
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-car"></i> free Parking in the area
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-fan"></i> Air Conditioning
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade page-section ratio3_2" id="gallery">
                                        <h4 class="content-title">gallery</h4>
                                    </div>
                                    <div class="tab-pane fade page-section ratio_40" id="video">
                                        <h4 class="content-title">video</h4>
                                        <div class="play-bg-image">
                                            <div class="bg-size">
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/11.jpg" class="bg-img" alt="">
                                            </div>
                                            <div class="icon-video">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#videomodal">
                                                    <i class="fas fa-play"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade page-section" id="floor_plan">
                                        <h4 class="content-title">Floor plan</h4>
                                        <img src="https://themes.pixelstrap.com/sheltos/assets/images/single-property/floor-plan.png" alt=""
                                            class="img-fluid">
                                    </div>
                                    <div class="tab-pane fade page-section" id="location-map">
                                        <h4 class="content-title">location</h4>
                                        <iframe title="realestate location" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.1583091352!2d-74.11976373946229!3d40.69766374859258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1563449626439!5m2!1sen!2sin"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="left-sidebar sticky-cls single-sidebar">
                        <div class="filter-cards">
                            <div class="advance-card text-center p-4 bg-white shadow rounded">
                                <h4 class="fw-bold mb-3">Meet Your Realtor</h4>
                            
                                <div class="agent-info mb-3">
                                    <div class="media flex-column align-items-center">
                                        <img src="{{ asset('client/assets/images/testimonial/3.png') }}" class="img-50 rounded-circle mb-2" alt="Realtor Photo">
                                        <div class="media-body text-center">
                                            <h5 class="fw-semibold">Grace Astet</h5>
                                            <p class="text-secondary small mb-0">Senior Property Advisor, Hubolux</p>
                                        </div>
                                    </div>
                                </div>
                            
                                <p class="text-muted small">
                                    Grace is a highly experienced property advisor with a deep understanding of the Lagos luxury real estate market. She is dedicated to providing personalized service and ensuring her clients find properties that perfectly match their lifestyle and investment goals.
                                </p>
                            
                                <ul class="list-unstyled my-3 small">
                                    <li class="mb-2">
                                        <i data-feather="phone-call" class="me-2"></i> +2348123456789
                                    </li>
                                    <li class="mb-2">
                                        <i data-feather="mail" class="me-2"></i>graceastet@gmail.com
                                    </li>
                                </ul>
                            
                                <a href="https://wa.me/2348123456789" class="btn w-100 text-white" style="background-color: #78c705;">
                                    <i class="fab fa-whatsapp me-2"></i> Chat On WhatsApp
                                </a>
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- single property end -->

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

    <!-- video modal start -->
    <div class="modal fade video-modal" id="videomodal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <iframe title="realestate" src="https://www.youtube.com/embed/Sz_1tkcU0Co"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- video modal end -->

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
                        <input type="checkbox" name="chk1" value="option" class="setting-check"><span
                            class="switch-state"></span>
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
                        <input type="checkbox" name="chk2" value="option" class="setting-check1"><span
                            class="switch-state"></span>
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

    <!-- Modal for mobile booking -->
<div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content p-3">
        <div class="modal-header">
          <h5 class="modal-title" id="scheduleModalLabel">Book Inspection</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <!-- Your schedule tour form -->
          <form>
            <div class="form-group mb-3">
              <label>Full Name</label>
              <input type="text" class="form-control" required>
            </div>
            <div class="form-group mb-3">
              <label>Email Address</label>
              <input type="email" class="form-control" required>
            </div>
            <div class="form-group mb-3">
              <label>Phone Number</label>
              <input type="tel" class="form-control" required>
            </div>
            <div class="form-group mb-3">
              <label>Preferred Date</label>
              <input type="date" class="form-control" required>
            </div>
            <div class="form-group mb-3">
              <label>Preferred Time</label>
              <input type="time" class="form-control" required>
            </div>
            <div class="form-group mb-3">
              <label>Message</label>
              <textarea class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-gradient color-2 btn-block btn-pill">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

    <!-- latest jquery-->
    <script src="{{ asset('client/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- popper js-->
    <script src="{{ asset('client/assets/js/popper.min.js') }}"></script>

    <!-- magnific js -->
    <script src="{{ asset('realtor/assets/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('realtor/assets/js/zoom-gallery.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('client/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- feather icon js-->
    <script src="{{ asset('client/assets/js/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/feather-icon/feather-icon.js') }}"></script>

    <!-- range slider js -->
    <script src="{{ asset('client/assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('client/assets/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/range-slider.js') }}"></script>

    <!-- slick js -->
    <script src="{{ asset('client/assets/js/slick.js') }}"></script>
    <script src="{{ asset('client/assets/js/slick-animation.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/custom-slick.js') }}"></script>

    <!-- print js -->
    <script src="{{ asset('realtor/assets/js/print.js') }}"></script>

    <!-- Template js-->
    <script src="{{ asset('client/assets/js/script.js') }}"></script>

    <!-- Customizer js-->
    <script src="{{ asset('client/assets/js/customizer.js') }}"></script>

    <!-- Color-picker js-->
    <script src="{{ asset('realtor/assets/js/color/single-property.js') }}"></script>

</body>
</html>
