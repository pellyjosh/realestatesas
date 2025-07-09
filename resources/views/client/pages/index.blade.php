@extends('client.client_master')
@section('title', 'Home | Premium Refined Luxury Homes')
@section('main')
    <!-- home section start -->
    <section class="home-section layout-1 layout-6">
        <div class="home-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="container">
                            <div class="home-left">
                                <div>
                                    <div class="home-slider-1 arrow-light slick-shadow">
                                        <div>
                                            <div class="home-content">
                                                <div>
                                                    <img src="{{ asset('client/assets/images/signature/2.png') }}"
                                                        class="img-fluid m-0" alt="">
                                                    <h6>Verified Lands & Properties</h6>
                                                    <h1>Your Gateway to Secure Real Estate</h1>
                                                    <a href="#latest-properties" class="btn btn-gradient color-6">Explore
                                                        Listings</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="home-content">
                                                <div>
                                                    <img src="{{ asset('client/assets/images/signature/2.png') }}"
                                                        class="img-fluid m-0" alt="">
                                                    <h6>Buy or Sell with Confidence</h6>
                                                    <h1>Find Your Perfect Plot or Elegant Home</h1>
                                                    <a href="{{ route('client.contact') }}"
                                                        class="btn btn-gradient color-6">Contact Us</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="looking-icons">
                                        <h5>What are you looking for?</h5>
                                        <ul>
                                            <li>
                                                <a href="#" class="looking-icon">
                                                    <svg class="property-svg">
                                                        <use
                                                            xlink:href="https://themes.pixelstrap.com/Premium Refined Luxury Homes/assets/svg/icons.svg#home-lock">
                                                        </use>
                                                    </svg>
                                                    <h6>House</h6>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="looking-icon">
                                                    <svg class="property-svg">
                                                        <use
                                                            xlink:href="https://themes.pixelstrap.com/Premium Refined Luxury Homes/assets/svg/icons.svg#home-heart">
                                                        </use>
                                                    </svg>
                                                    <h6>Booking</h6>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="looking-icon">
                                                    <svg class="property-svg">
                                                        <use
                                                            xlink:href="https://themes.pixelstrap.com/Premium Refined Luxury Homes/assets/svg/icons.svg#key">
                                                        </use>
                                                    </svg>
                                                    <h6>Garage</h6>
                                                </a>
                                            </li>
                                        </ul>
                                    </div> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="home-search-6">
                            <div class="vertical-search">
                                <div class="left-sidebar">
                                    <div class="row gx-3">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Property Status</label>
                                                <div class="dropdown">
                                                    <span class="dropdown-toggle font-rubik"
                                                        data-bs-toggle="dropdown"><span>Property Status</span> <i
                                                            class="fas fa-angle-down"></i></span>
                                                    <div class="dropdown-menu text-start">
                                                        <a class="dropdown-item" href="javascript:void(0)">Property
                                                            Status</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">For
                                                            Rent</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">For
                                                            Sale</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Property Type</label>
                                                <div class="dropdown">
                                                    <span class="dropdown-toggle font-rubik"
                                                        data-bs-toggle="dropdown"><span>Property Type</span> <i
                                                            class="fas fa-angle-down"></i></span>
                                                    <div class="dropdown-menu text-start">
                                                        <a class="dropdown-item" href="javascript:void(0)">Property
                                                            Type</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Apartment</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Family
                                                            House</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Cottage</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Condominium</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Rooms</label>
                                                <div class="dropdown">
                                                    <span class="dropdown-toggle font-rubik"
                                                        data-bs-toggle="dropdown"><span>Max
                                                            Rooms</span> <i class="fas fa-angle-down"></i></span>
                                                    <div class="dropdown-menu text-start">
                                                        <a class="dropdown-item" href="javascript:void(0)">Max
                                                            Rooms</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">1</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">2</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">3</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">4</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">5</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">6</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Bed</label>
                                                <div class="dropdown">
                                                    <span class="dropdown-toggle font-rubik"
                                                        data-bs-toggle="dropdown"><span>Bed</span> <i
                                                            class="fas fa-angle-down"></i></span>
                                                    <div class="dropdown-menu text-start">
                                                        <a class="dropdown-item" href="javascript:void(0)">Bed</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">1</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">2</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">3</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">4</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Bath</label>
                                                <div class="dropdown">
                                                    <span class="dropdown-toggle font-rubik"
                                                        data-bs-toggle="dropdown"><span>Bath</span> <i
                                                            class="fas fa-angle-down"></i></span>
                                                    <div class="dropdown-menu text-start">
                                                        <a class="dropdown-item" href="javascript:void(0)">Bath</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">1</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">2</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">3</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">4</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Agencies</label>
                                                <div class="dropdown">
                                                    <span class="dropdown-toggle font-rubik"
                                                        data-bs-toggle="dropdown"><span>Agencies</span> <i
                                                            class="fas fa-angle-down"></i></span>
                                                    <div class="dropdown-menu text-start">
                                                        <a class="dropdown-item" href="javascript:void(0)">Agencies</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Lincoln</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Blue
                                                            Sky</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Zephyr</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Premiere</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-6">
                                            <div class="form-group">
                                                <div class="price-range">
                                                    <label for="amount">Price : </label>
                                                    <input type="text" id="amount" readonly>
                                                    <div id="slider-range" class="theme-range-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-6">
                                            <div class="form-group">
                                                <div class="price-range">
                                                    <label for="amount">Area : </label>
                                                    <input type="text" id="amount1" readonly>
                                                    <div id="slider-range1" class="theme-range-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="button" onclick="document.location=''"
                                                class="btn btn-gradient color-6 mt-3">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- home section end -->

    <!-- property section start -->
    <section id="latest-properties" class="property-section slick-between slick-shadow property-color-6">
        <div class="container">
            <div class="row ratio_landscape">
                <div class="col">
                    <div class="title-1 color-6">
                        <span class="label label-gradient color-6">Sale</span>
                        <h2>Latest For Sale</h2>
                        <hr>
                    </div>
                    <div class="listing-hover-property row">
                        <div class="col-xl-4 col-md-6 wow fadeInUp">
                            <div class="property-box">
                                <div class="property-image">
                                    <a href="javascript:void(0)">
                                        <img src="{{ asset('client/assets/images/uploads/upload-2.png') }}" class="bg-img"
                                            alt="" loading="lazy">
                                        <div class="labels-left">
                                            <span class="label label-shadow">Sale</span>
                                        </div>
                                    </a>
                                    <div class="bottom-property">
                                        <div class="d-flex">
                                            <div>
                                                <h5>Neverland</h5>
                                                <h6>#13,000 <small>/ start from</small></h6>
                                            </div>
                                            <a href="{{ route('client.property-details') }}"
                                                class="btn btn-gradient color-6 mt-3">Details</a>
                                        </div>
                                        <div class="overlay-option">
                                            <ul>
                                                <li>
                                                    <span>Plot Size</span>
                                                    <h6>2</h6>
                                                </li>
                                                <li>
                                                    <span>Location</span>
                                                    <h6>Ibeju-Lekki</h6>
                                                </li>
                                                <li>
                                                    <span>Title</span>
                                                    <h6>Registered Survey</h6>
                                                </li>
                                                <li>
                                                    <span>Status</span>
                                                    <h6>Dry Land</h6>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                            <div class="property-box">
                                <div class="property-image">
                                    <a href="javascript:void(0)">
                                        <img src="{{ asset('client/assets/images/uploads/upload-9.png') }}" class="bg-img"
                                            alt="" loading="lazy">
                                        <div class="labels-left">
                                            <div>
                                                <span class="label label-dark">no fees</span>
                                            </div>
                                            <span class="label label-success">open house</span>
                                        </div>
                                    </a>
                                    <div class="bottom-property">
                                        <div class="d-flex">
                                            <div>
                                                <h5><a href="#">Orchard House</a></h5>
                                                <h6>#14,520 <small>/ start from</small></h6>
                                            </div>
                                            <a href="{{ route('client.property-details') }}"
                                                class="btn btn-gradient color-6 mt-3">Details</a>
                                        </div>
                                        <div class="overlay-option">
                                            <ul>
                                                <li>
                                                    <span>Plot Size</span>
                                                    <h6>2</h6>
                                                </li>
                                                <li>
                                                    <span>Location</span>
                                                    <h6>Ibeju-Lekki</h6>
                                                </li>
                                                <li>
                                                    <span>Title</span>
                                                    <h6>Registered Survey</h6>
                                                </li>
                                                <li>
                                                    <span>Status</span>
                                                    <h6>Dry Land</h6>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                            <div class="property-box">
                                <div class="property-image">
                                    <a href="javascript:void(0)">
                                        <img src="{{ asset('client/assets/images/uploads/upload-7.jpg') }}" class="bg-img"
                                            alt="" loading="lazy">
                                        <div class="labels-left">
                                            <span class="label label-shadow">Sold</span>
                                        </div>
                                    </a>
                                    <div class="bottom-property">
                                        <div class="d-flex">
                                            <div>
                                                <h5><a href="#">Sea Breezes</a></h5>
                                                <h6>#12,200 <small>/ start from</small></h6>
                                            </div>
                                            <a href="{{ route('client.property-details') }}"
                                                class="btn btn-gradient color-6 mt-3">Details</a>
                                        </div>
                                        <div class="overlay-option">
                                            <ul>
                                                <li>
                                                    <span>Plot Size</span>
                                                    <h6>2</h6>
                                                </li>
                                                <li>
                                                    <span>Location</span>
                                                    <h6>Ibeju-Lekki</h6>
                                                </li>
                                                <li>
                                                    <span>Title</span>
                                                    <h6>Registered Survey</h6>
                                                </li>
                                                <li>
                                                    <span>Status</span>
                                                    <h6>Dry Land</h6>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- property section end -->

    <!-- feature section start -->
    <section class="feature-section banner-4">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="title-1 text-white">
                        <span class="label label-gradient color-6">Our</span>
                        <h2>Featured Property</h2>
                        <hr>
                    </div>
                    <div class="feature-1 arrow-light">
                        <div>
                            <div class="feature-wrapper">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-3">
                                        <div class="feature-left">
                                            <div class="property-details">
                                                <span class="font-roboto">New York</span>
                                                <a href="#">
                                                    <h3 class="d-flex">Asaba-Ibusa Express Way <span><span
                                                                class="label label-dark label-pill">Open
                                                                house</span></span></h3>
                                                </a>
                                                <h6 class="color-6">#9554.00*</h6>
                                                <p class="font-roboto">Strategically located in a serene environment, this
                                                    land offers a peaceful setting just 10 minutes from the city center.
                                                    It’s fully fenced, gated, and comes with access to electricity and water
                                                    ideal for both residential and investment purposes.</p>
                                                <a href="#">
                                                    <span class="round-half color-6">
                                                        <i data-feather="heart"></i>
                                                    </span>
                                                </a>
                                                <div class="property-btn">
                                                    <a href="{{ route('client.property-details') }}"
                                                        class="btn btn-gradient color-6 mt-3">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-8 col-lg-9 order-md">
                                        <div class="feature-image">
                                            <img src="{{ asset('client/assets/images/uploads/upload-7.jpg') }}"
                                                alt="" class="bg-img" loading="lazy">
                                            <h4>Land Properties</h4>
                                            {{-- <span class="box-color"></span>
                                                            <span class="signature">
                                                                <img src="{{ asset('client/assets/images/signature/1.png') }}"
                                                                    alt="">
                                                            </span> --}}
                                            <span class="label label-white label-lg color-6">Featured</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="feature-wrapper">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-3">
                                        <div class="feature-left ">
                                            <div class="property-details">
                                                <span class="font-roboto">New York</span>
                                                <a href="#">
                                                    <h3 class="d-flex">Allen's Across Way <span><span
                                                                class="label label-dark label-pill">Open
                                                                house</span></span></h3>
                                                </a>
                                                <h6 class="color-6">#6844.00*</h6>
                                                <p class="font-roboto">Connected residences might be owned by a single
                                                    entity or owned separately with an agreement covering the
                                                    relationship between units and common areas and concerns. Different
                                                    types of housing can be use same physical type.</p>
                                                <ul>
                                                    <li><i class="fas fa-mountain"></i> Land : 3</li>
                                                    <li><i class="fas fa-building"></i> Properties : 2</li>
                                                    <li>
                                                        <i class="fas fa-ruler-combined"></i> Sq Ft : 5000
                                                    </li>
                                                </ul>
                                                <a href="#">
                                                    <span class="round-half color-6">
                                                        <i data-feather="heart"></i>
                                                    </span>
                                                </a>
                                                <div class="property-btn">
                                                    <a href="#" class="btn btn-dashed btn-pill color-6"
                                                        tabindex="0">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-8 col-lg-9 order-md">
                                        <div class="feature-image">
                                            <img src="{{ asset('client/assets/images/property/2.jpg') }}" alt=""
                                                class="bg-img" loading="lazy">
                                            <h4>FAMILY HOME</h4>
                                            <span class="box-color"></span>
                                            <span class="signature">
                                                <img src="{{ asset('client/assets/images/signature/1.png') }}"
                                                    alt="">
                                            </span>
                                            <span class="label label-white label-lg color-6">Featured</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- feature section end -->

    <!-- property section start -->
    <section class="property-section property-color-6">
        <div class="container">
            <div class="row ratio_55">
                <div class="col">
                    <div class="title-1 color-6">
                        <span class="label label-gradient color-6">Rent</span>
                        <h2>Latest For Rent</h2>
                        <hr>
                    </div>
                    <div class="property-2 row column-space color-6">
                        <div class="col-xl-4 col-md-6 wow fadeInUp">
                            <div class="property-box">
                                <div class="property-image">
                                    <div class="property-slider color-6">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-2.png') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-7.jpg') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-9.png') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-2.png') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                    </div>
                                    <div class="labels-left">
                                        <div>
                                            <span class="label label-shadow">sale</span>
                                        </div>
                                    </div>
                                    <div class="seen-data">
                                        <i data-feather="camera"></i>
                                        <span>10</span>
                                    </div>
                                    <div class="overlay-property-box">

                                        <a href="#" class="effect-round like" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="favourite">
                                            <i data-feather="heart"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="property-details">
                                    <span class="font-roboto">Abuja</span>
                                    <a href="#">
                                        <h3>Acorn Farm</h3>
                                    </a>
                                    <h6 class="color-6">#6558.00*</h6>
                                    <p class="font-roboto">Flat, dry land perfect for building ready for immediate
                                        development.</p>
                                    <ul>
                                        <li><i class="fas fa-mountain"></i> Land : 3</li>
                                        <li><i class="fas fa-building"></i> Properties : 2</li>
                                        <li>
                                            <i class="fas fa-ruler-combined"></i> Sq Ft : 5000
                                        </li>
                                    </ul>
                                    <div class="property-btn d-flex">
                                        <span>August 4, 2022</span>
                                        <button type="button" class="btn btn-dashed btn-pill color-6">Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 wow fadeInUp">
                            <div class="property-box">
                                <div class="property-image">
                                    <div class="property-slider color-6">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-9.png') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-7.jpg') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-2.png') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/property/22.jpg') }}" class="bg-img"
                                                alt="" loading="lazy">
                                        </a>
                                    </div>
                                    <div class="labels-left">
                                        <div>
                                            <span class="label label-shadow">sale</span>
                                        </div>
                                    </div>
                                    <div class="seen-data">
                                        <i data-feather="camera"></i>
                                        <span>42</span>
                                    </div>
                                    <div class="overlay-property-box">

                                        <a href="#" class="effect-round like" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="favourite">
                                            <i data-feather="heart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="property-details">
                                    <span class="font-roboto">Calabar</span>
                                    <a href="#">
                                        <h3>Home in Merrick Way</h3>
                                    </a>
                                    <h6 class="color-6">#4513.00*</h6>
                                    <p class="font-roboto">Located near a major highway, ensuring easy transportation
                                        access.</p>
                                    <ul>
                                        <li><i class="fas fa-mountain"></i> Land : 3</li>
                                        <li><i class="fas fa-building"></i> Properties : 2</li>
                                        <li>
                                            <i class="fas fa-ruler-combined"></i> Sq Ft : 5000
                                        </li>
                                    </ul>
                                    <div class="property-btn d-flex">
                                        <span>December 1, 2022</span>
                                        <button type="button" class="btn btn-dashed btn-pill color-6">Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 wow fadeInUp">
                            <div class="property-box">
                                <div class="property-image">
                                    <div class="property-slider color-6">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-2.png') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-7.jpg') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-9.png') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-2.png') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                    </div>
                                    <div class="labels-left">
                                        <div>
                                            <span class="label label-shadow">sale</span>
                                        </div>
                                    </div>
                                    <div class="seen-data">
                                        <i data-feather="camera"></i>
                                        <span>25</span>
                                    </div>
                                    <div class="overlay-property-box">

                                        <a href="#" class="effect-round like" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="favourite">
                                            <i data-feather="heart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="property-details">
                                    <span class="font-roboto">Sapele</span>
                                    <a href="#">
                                        <h3>Allen's Across Way</h3>
                                    </a>
                                    <h6 class="color-6">#6558.00*</h6>
                                    <p class="font-roboto">Close to residential estates, ideal for future home
                                        construction.</p>
                                    <ul>
                                        <li><i class="fas fa-mountain"></i> Land : 3</li>
                                        <li><i class="fas fa-building"></i> Properties : 2</li>
                                        <li>
                                            <i class="fas fa-ruler-combined"></i> Sq Ft : 5000
                                        </li>
                                    </ul>
                                    <div class="property-btn d-flex">
                                        <span>June 20, 2022</span>
                                        <button type="button" class="btn btn-dashed btn-pill color-6">Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 wow fadeInUp">
                            <div class="property-box">
                                <div class="property-image">
                                    <div class="property-slider color-6">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-2.png') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-7.jpg') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-9.png') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-2.png') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                    </div>
                                    <div class="labels-left">
                                        <div>
                                            <span class="label label-shadow">sale</span>
                                        </div>
                                    </div>
                                    <div class="seen-data">
                                        <i data-feather="camera"></i>
                                        <span>09</span>
                                    </div>
                                    <div class="overlay-property-box">

                                        <a href="#" class="effect-round like" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="favourite">
                                            <i data-feather="heart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="property-details">
                                    <span class="font-roboto">Agbor</span>
                                    <a href="#">
                                        <h3>Hidden Spring Hideway</h3>
                                    </a>
                                    <h6 class="color-6">#4513.00*</h6>
                                    <p class="font-roboto">Fertile soil suitable for farming or agro-business ventures.</p>
                                    <ul>
                                        <li><i class="fas fa-mountain"></i> Land : 3</li>
                                        <li><i class="fas fa-building"></i> Properties : 2</li>
                                        <li>
                                            <i class="fas fa-ruler-combined"></i> Sq Ft : 5000
                                        </li>
                                    </ul>
                                    <div class="property-btn d-flex">
                                        <span>January 6, 2022</span>
                                        <button type="button" class="btn btn-dashed btn-pill color-6">Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 wow fadeInUp">
                            <div class="property-box">
                                <div class="property-image">
                                    <div class="property-slider color-6">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-2.png') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-7.jpg') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-9.png') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-2.png') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                    </div>
                                    <div class="labels-left">
                                        <div>
                                            <span class="label label-shadow">sale</span>
                                        </div>
                                    </div>
                                    <div class="seen-data">
                                        <i data-feather="camera"></i>
                                        <span>25</span>
                                    </div>
                                    <div class="overlay-property-box">

                                        <a href="#" class="effect-round like" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="favourite">
                                            <i data-feather="heart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="property-details">
                                    <span class="font-roboto">Onistha</span>
                                    <a href="#">
                                        <h3>Merrick in Spring Way</h3>
                                    </a>
                                    <h6 class="color-6">#4513.00*</h6>
                                    <p class="font-roboto">Within a fast-developing area, promising high investment
                                        returns.</p>
                                    <ul>
                                        <li><i class="fas fa-mountain"></i> Land : 3</li>
                                        <li><i class="fas fa-building"></i> Properties : 2</li>
                                        <li>
                                            <i class="fas fa-ruler-combined"></i> Sq Ft : 5000
                                        </li>
                                    </ul>
                                    <div class="property-btn d-flex">
                                        <span>December 1, 2022</span>
                                        <button type="button" class="btn btn-dashed btn-pill color-6">Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 wow fadeInUp">
                            <div class="property-box">
                                <div class="property-image">
                                    <div class="property-slider color-6">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-2.png') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-7.jpg') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-9.png') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('client/assets/images/uploads/upload-2.png') }}"
                                                class="bg-img" alt="" loading="lazy">
                                        </a>
                                    </div>
                                    <div class="labels-left">
                                        <div>
                                            <span class="label label-dark">no fees</span>
                                        </div>
                                        <span class="label label-success">open house</span>
                                    </div>
                                    <div class="seen-data">
                                        <i data-feather="camera"></i>
                                        <span>42</span>
                                    </div>
                                    <div class="overlay-property-box">

                                        <a href="#" class="effect-round like" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="favourite">
                                            <i data-feather="heart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="property-details">
                                    <span class="font-roboto">Ughelli</span>
                                    <a href="#">
                                        <h3>Hidden Spring Hideway</h3>
                                    </a>
                                    <h6 class="color-6">#9554.00*</h6>
                                    <p class="font-roboto">Comes with a government-approved survey and clear title documents.
                                    </p>
                                    <ul>
                                        <li><i class="fas fa-mountain"></i> Land : 3</li>
                                        <li><i class="fas fa-building"></i> Properties : 2</li>
                                        <li>
                                            <i class="fas fa-ruler-combined"></i> Sq Ft : 5000
                                        </li>
                                    </ul>
                                    <div class="property-btn d-flex">
                                        <span>July 18, 2022</span>
                                        <button type="button" class="btn btn-dashed btn-pill color-6">Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- property section end -->

    <!--our new offer section start -->
    <section class="offer-section banner-section banner-4 slick-between ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="title-1 text-white">
                        <span class="label label-gradient color-6">New Offer</span>
                        <h2>Our New Offer</h2>
                        <hr>
                    </div>
                    <div class="offer-slider">
                        <div>
                            <div class="offer-wrapper">
                                <div class="media">
                                    <div class="offer-icon">
                                        <img src="{{ asset('client/assets/images/others/icon-1.png') }}" alt=""
                                            loading="lazy">
                                    </div>
                                    <div class="media-body">
                                        <h6>Premium Refined Luxury Homes</h6>
                                        <h3>Looking for a new property?</h3>
                                        <p>We help you find the perfect property land, residential, or commercial securely and stress free. Let’s make your next move simple and rewarding.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="offer-wrapper">
                                <div class="media">
                                    <div class="offer-icon">
                                        <img src="{{ asset('client/assets/images/others/icon-2.png') }}" alt=""
                                            loading="lazy">
                                    </div>
                                    <div class="media-body">
                                        <h6>Premium Refined Luxury Homes</h6>
                                        <h3>Are the properties genuine?</h3>
                                        <p>We verify all properties before listing. Each one comes with proper documentation such as survey plans, deeds, and government approvals. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="offer-wrapper">
                                <div class="media">
                                    <div class="offer-icon">
                                        <img src="{{ asset('client/assets/images/others/icon-1.png') }}" alt=""
                                            loading="lazy">
                                    </div>
                                    <div class="media-body">
                                        <h6>Premium Refined Luxury Homes</h6>
                                        <h3>Looking for the new Office?</h3>
                                        <p>10 new offers every day. 350 offers on site, trusted
                                            by a community of thousands of users.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--our new offer section end -->

    <!-- find properties section start -->
    <section class="my-gallery gallery-6">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="title-1 color-6">
                        <span class="label label-gradient color-6">city</span>
                        <h2>Find Properties in These Cities</h2>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6 wow fadeInUp">
                            <div class="find-cities bg-size">
                                <img src="{{ asset('client/assets/images/uploads/upload-2.png') }}" class="bg-img"
                                    alt="" loading="lazy">
                                <div class="citi-overlay">
                                    <div>
                                        <h4>12+ Property</h4>
                                        <h2>Asaba</h2>
                                        <h6 class="font-roboto">Many Property in this city</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6 wow fadeInUp">
                            <div class="find-cities bg-size">
                                <img src="{{ asset('client/assets/images/uploads/upload-9.png') }}" class="bg-img"
                                    alt="" loading="lazy">
                                <div class="citi-overlay">
                                    <div>
                                        <h4>5+ Property</h4>
                                        <h2>Benin</h2>
                                        <h6 class="font-roboto">Many Land in this city</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-8 col-md-7 wow fadeInUp">
                            <div class="find-cities bg-size">
                                <img src="{{ asset('client/assets/images/uploads/upload-7.jpg') }}" class="bg-img"
                                    alt="" loading="lazy">
                                <div class="citi-overlay">
                                    <div>
                                        <h4>6+ Property</h4>
                                        <h2>Lagos</h2>
                                        <h6 class="font-roboto">Many Spaces in this city</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-8 col-md-7 wow fadeInUp">
                            <div class="find-cities bg-size">
                                <img src="{{ asset('client/assets/images/uploads/upload-2.png') }}" class="bg-img"
                                    alt="" loading="lazy">
                                <div class="citi-overlay">
                                    <div>
                                        <h4>8+ Property</h4>
                                        <h2>Port Harcourt</h2>
                                        <h6 class="font-roboto">Many Flat in this city</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6 wow fadeInUp">
                            <div class="find-cities bg-size">
                                <img src="{{ asset('client/assets/images/uploads/upload-9.png') }}" class="bg-img"
                                    alt="" loading="lazy">
                                <div class="citi-overlay">
                                    <div>
                                        <h4>10+ Property</h4>
                                        <h2>Warri</h2>
                                        <h6 class="font-roboto">Many Land in this city</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6 wow fadeInUp">
                            <div class="find-cities bg-size">
                                <img src="{{ asset('client/assets/images/uploads/upload-7.jpg') }}" class="bg-img"
                                    alt="" loading="lazy">
                                <div class="citi-overlay">
                                    <div>
                                        <h4>12+ Property</h4>
                                        <h2>Abuja</h2>
                                        <h6 class="font-roboto">Many Spaces in this city</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- find properties section end -->

    <!-- banner section start -->
    <section class="banner-section banner-4 parallax-image">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="title-1 color-6">
                        <span class="label label-gradient color-6">Buy or sell</span>
                    </div>
                    <div class="light-bg banner-1">
                        <span class="big-gradient">*</span>
                        <span class="small-white">*</span>
                        <h6>Premium Refined Luxury Homes</h6>
                        <h2>We don’t just sell land we curate legacy worthy properties that stand the test of time for generations to come.</h2>
                        <div class="button-banner">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner section end -->

    <!-- about section start -->
    <section class="about-section slick-between about-color6">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="title-1 color-6">
                        <span class="label label-gradient color-6">Realtor</span>
                        <h2>Meet our Realtor</h2>
                        <hr>
                    </div>
                    <div class="about-1 about-wrap arrow-white color-6">

                        <div>
                            <div class="about-content row">
                                <div class="col-xl-6">
                                    <div class="about-image">
                                        <img src="{{ asset('client/assets/images/about/1.jpg') }}" class="img-fluid"
                                            alt="" loading="lazy" style="max-width: 100%;">
                                        <div class="about-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://accounts.google.com/"><img
                                                            src="https://themes.pixelstrap.com/sheltos/assets/images/about/icon-1.png"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img
                                                            src="https://themes.pixelstrap.com/sheltos/assets/images/about/icon-2.png"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img
                                                            src="https://themes.pixelstrap.com/sheltos/assets/images/about/icon-3.png"
                                                            alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="our-details">
                                        <h6 class="d-flex">Ty R. Leeva <span class="label-heart color-6 ms-2"><i
                                                    data-feather="heart"></i></span></h6>
                                        <h3>Communicating with..</h3>
                                        <span class="font-roboto"><i data-feather="mail"
                                                class="me-1"></i>Leeva@inspirythemes.com</span>
                                        <p class="font-roboto">A real estate agent or broker is a person who represents
                                            sellers or buyers advised to consult a licensed.</p>
                                        <a href="{{ route('client.realtor-profile') }}"
                                            class="btn btn-gradient btn-pill color-6 mt-2"><i data-feather="eye"></i>View
                                            Portfolio</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="about-content row">
                                <div class="col-xl-6">
                                    <div class="about-image">
                                        <img src="{{ asset('client/assets/images/about/2.jpg') }}" class="img-fluid"
                                            alt="" loading="lazy" style="max-width: 100%;">
                                        <div class="about-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://accounts.google.com/"><img
                                                            src="https://themes.pixelstrap.com/sheltos/assets/images/about/icon-1.png"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img
                                                            src="https://themes.pixelstrap.com/sheltos/assets/images/about/icon-2.png"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img
                                                            src="https://themes.pixelstrap.com/sheltos/assets/images/about/icon-3.png"
                                                            alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="our-details">
                                        <a href="">
                                            <h6 class="d-flex">Mark Andry <span class="label-heart color-6 ms-2"><i
                                                        data-feather="heart"></i></span></h6>
                                        </a>
                                        <h3>Sellers of property.</h3>
                                        <span class="font-roboto"><i data-feather="mail"
                                                class="me-1"></i>John@inspirythemes.com</span>
                                        <p class="font-roboto">Responsible for coordinating site visits, verifying land
                                            documentation, and maintaining up-to-date property records.</p>
                                        <a href="{{ route('client.realtor-profile') }}"
                                            class="btn btn-gradient btn-pill color-6 mt-2"><i data-feather="eye"></i>View
                                            Portfolio</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="about-content row">
                                <div class="col-xl-6">
                                    <div class="about-image">
                                        <img src="{{ asset('client/assets/images/about/2.jpg') }}" class="img-fluid"
                                            alt="" loading="lazy" style="max-width: 100%;">
                                        <div class="about-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://accounts.google.com/"><img
                                                            src="https://themes.pixelstrap.com/sheltos/assets/images/about/icon-1.png"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img
                                                            src="https://themes.pixelstrap.com/sheltos/assets/images/about/icon-2.png"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img
                                                            src="https://themes.pixelstrap.com/sheltos/assets/images/about/icon-3.png"
                                                            alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="our-details">
                                        <a href="">
                                            <h6 class="d-flex">John David <span class="label-heart color-6 ms-2"><i
                                                        data-feather="heart"></i></span></h6>
                                        </a>
                                        <h3>Advised to consult </h3>
                                        <span class="font-roboto"><i data-feather="mail"
                                                class="me-1"></i>John@inspirythemes.com</span>
                                        <p class="font-roboto"> They manage land inventories, provide expert advice to
                                            clients, and handle all aspects of the buying and selling process.</p>
                                        <a href="{{ route('client.realtor-profile') }}"
                                            class="btn btn-gradient btn-pill color-6 mt-2"><i data-feather="eye"></i>View
                                            Portfolio</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about section end -->

    <!-- testimonial section start -->
    <section class="testimonial-bg testimonial-layout6">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="title-1 text-white">
                        <span class="label label-gradient color-6">Our</span>
                        <h2>Happy clients</h2>
                        <hr>
                    </div>
                    <div class="testimonial-2 arrow-light">
                        <div>
                            <div class="client-slider light-bg">
                                <ul class="user-list">
                                    <li><img src="{{ asset('client/assets/images/testimonial/2.png') }}" alt=""
                                            loading="lazy">
                                    </li>
                                    <li>
                                        <img src="{{ asset('client/assets/images/testimonial/1.png') }}" alt=""
                                            loading="lazy">
                                        <div class="heart-bg">
                                        </div>
                                        <img src="{{ asset('client/assets/images/testimonial/heart.png') }}"
                                            alt="" class="heart-icon" loading="lazy">
                                    </li>
                                    <li><img src="{{ asset('client/assets/images/testimonial/3.png') }}" alt="">
                                    </li>
                                </ul>
                                <p>Professional, transparent, and truly invested in my goals. I felt confident every step of the way. I’ll definitely work with them again.</h6>
                                <ul class="client-rating">
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                                <span class="label label-white label-lg"><span class="gradient-1 color-6">James
                                    Okoh</span></span>
                            </div>
                        </div>
                        <div>
                            <div class="client-slider light-bg">
                                <ul class="user-list">
                                    <li><img src="{{ asset("client/assets/images/testimonial/1.png") }}"
                                            alt="" loading="lazy"></li>
                                    <li>
                                        <img src="{{ asset("client/assets/images/testimonial/2.png") }}"
                                            alt="" loading="lazy">
                                        <div class="heart-bg">
                                        </div>
                                        <img src="{{ asset("client/assets/images/testimonial/heart.png") }}"
                                            alt="" class="heart-icon" loading="lazy">
                                    </li>
                                    <li><img src="{{ asset("client/assets/images/testimonial/3.png") }}"
                                            alt="" loading="lazy"></li>
                                </ul>
                                <p>Working with this team was seamless from start to finish. They helped me find the perfect land with zero stress hihgly recommended!</p>
                                <h6>real estate</h6>
                                <ul class="client-rating">
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                                <span class="label label-white label-lg"><span class="gradient-1 color-6">Ray
                                        David</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial section end -->

    <!-- brand 2 start -->
    <section class="small-section" style="padding: 10px 0; ">
        <div class="container">
            
        </div>
    </section>
    <!-- brand 2 end -->
@endsection
