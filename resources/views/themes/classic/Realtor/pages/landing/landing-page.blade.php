<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sheltos - Modal details property details page">
    <meta name="keywords" content="Premium Refined Luxury Homes, Real Estate, Property Details, Modal Details">
    <meta name="author" content="Premium Refined Luxury Homes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('themes/classic/client/assets/images/logo.png') }}" type="image/x-icon" />
    <title>Premium Refined Luxury Homes - Modal details property details page</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">

    <!-- Font Awesome 6 Free CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- magnific css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/classic/realtor/assets/css/magnific-popup.css') }}">

    <!-- range slider css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/classic/client/assets/css/jquery-ui.css') }}">

    <!-- animate css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/classic/client/assets/css/animate.css') }}">

    <!-- Template css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/classic/client/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/classic/client/assets/css/color1.css') }}">

    <style>
        /* This will remove the line under "Book Inspection" in the sidebar form on larger screens. */
        .advance-card h6 {
            border-bottom: none !important;
        }

        .advance-card h6::after {
            display: none !important;
        }

        /* This will remove the line under the "Book Inspection" title in the pop-up on smaller screens. */
        #scheduleModal .modal-header {
            border-bottom: none;
        }

        /* Enhanced Inspection Form Styles */
        .inspection-form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(145, 210, 10, 0.2);
            transition: all 0.3s ease;
        }

        .inspection-form-container:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .inspection-form .form-control-sm {
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 13px;
            transition: all 0.2s ease;
        }

        .inspection-form .form-control-sm:focus {
            border-color: #91d20a;
            box-shadow: 0 0 0 0.2rem rgba(145, 210, 10, 0.15);
            transform: translateY(-1px);
        }

        .inspection-form .form-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 4px;
        }

        /* Location tab enhancements */
        .location-details {
            border-left: 4px solid #91d20a;
        }

        .distance-calculator {
            border: 2px dashed #007bff;
            transition: all 0.3s ease;
        }

        .distance-calculator:hover {
            border-style: solid;
            background-color: rgba(0, 123, 255, 0.05) !important;
        }

        .amenity-item {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .amenity-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-color: #91d20a !important;
        }

        .map-container {
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .map-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #91d20a, #7bc142);
            z-index: 1;
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .inspection-form-container {
                position: static !important;
                width: 100% !important;
                margin-bottom: 20px;
            }
        }

        /* Badge styles */
        .badge {
            font-size: 11px;
            padding: 4px 8px;
        }

        /* Button enhancements */
        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }

        /* Alert customizations */
        .alert-sm {
            padding: 8px 12px;
            font-size: 13px;
            border-radius: 6px;
        }

        /* Animation for form submission success */
        @keyframes successPulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .btn-success {
            animation: successPulse 0.6s ease-in-out;
        }

        /* Map controls styling */
        .map-controls .btn {
            border-radius: 20px;
            font-size: 12px;
        }

        /* Nearby amenities grid */
        .amenity-item i {
            transition: all 0.3s ease;
        }

        .amenity-item:hover i {
            transform: scale(1.2);
        }
    </style>

    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
</head>

<body>

    <!-- Loader start -->
    <div class="loader-wrapper">
        <div class="row loader-text">
            <div class="col-12">
                <img src="{{ asset('themes/classic/client/assets/images/loader/gear.gif') }}" class="img-fluid"
                    alt="">
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



    <header class="inner-page light-header shadow-cls">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="menu">
                        <div class="brand-logo">
                            <a href="{{ route('tenant.client.home') }}">
                                <img src="{{ asset('themes/classic/client/assets/images/logo2.png') }}" alt=""
                                    class="img-fluid">
                            </a>
                        </div>
                        <nav>
                            <div class="main-navbar">
                                <div id="mainnav">
                                    <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                    <ul class="nav-menu">
                                        <li class="dropdown">
                                            <a href="{{ route('tenant.client.home') }}"
                                                class="nav-link menu-title">Home</a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="{{ route('tenant.client.events') }}"
                                                class="nav-link menu-title">Events</a>
                                        <li class="dropdown">
                                            <a href="{{ route('tenant.client.contact') }}"
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
                            <h2 class="mb-0">{{ $landingPage->property->name ?? 'Property Name' }}</h2>
                            <span><span class="label label-shadow ms-2">For
                                    {{ ucfirst($landingPage->property->listing_type ?? 'Sale') }}</span></span>
                        </div>
                        <p class="mt-1">{{ $landingPage->property->full_address ?? 'Property Address' }}</p>
                        @if ($landingPage->property->land_size)
                            <li><i class="fas fa-mountain"></i> Land :
                                {{ number_format($landingPage->property->land_size, 0) }} sqm</li>
                        @endif
                        @if ($landingPage->property->bedrooms && $landingPage->property->bathrooms)
                            <li><i class="fas fa-building"></i> {{ $landingPage->property->bedrooms }} bed •
                                {{ $landingPage->property->bathrooms }} bath</li>
                        @endif
                        @if ($landingPage->property->built_area)
                            <li><i class="fas fa-ruler-combined"></i> Built Area :
                                {{ number_format($landingPage->property->built_area, 0) }} sqm</li>
                        @endif
                        <div class="share-buttons">
                            <div class="d-inline-block">
                                <a href="javascript:void(0)" class="btn btn-gradient btn-pill color-2"><i
                                        class="far fa-share-square"></i>
                                    share
                                </a>
                                <div class="share-hover">
                                    <ul>
                                        <li>
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                                class="icon-facebook" target="_blank"><i
                                                    data-feather="facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($landingPage->property->name) }}"
                                                class="icon-twitter" target="_blank"><i data-feather="twitter"></i></a>
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
                        <h2 class="price">{{ $landingPage->property->formatted_price ?? 'Price on request' }}
                            @if ($landingPage->property->listing_type === 'rent')
                                <span>/ annually</span>
                            @endif
                        </h2>
                        <div class="feature-label">
                            @if ($landingPage->property->features && is_array($landingPage->property->features))
                                @foreach (array_slice($landingPage->property->features, 0, 2) as $feature)
                                    <span
                                        class="btn btn-dashed color-2 @if (!$loop->first) ms-1 @endif btn-pill">{{ $feature }}</span>
                                @endforeach
                            @else
                                <span class="btn btn-dashed color-2 btn-pill">Wi-fi</span>
                                <span class="btn btn-dashed color-2 ms-1 btn-pill">Swimming Pool</span>
                            @endif
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
                                    <div class="single-gallery mb-4 position-relative">
                                        <!-- Fixed positioned inspection form for larger screens -->
                                        <div class="inspection-form-container d-none d-lg-block"
                                            style="position: absolute; top: 20px; right: 20px; width: 350px; z-index: 10;"
                                            x-data="inspectionForm()">
                                            <div class="bg-white p-4 rounded shadow-lg border">
                                                <h5 class="fs-6 fw-semibold pb-2 mb-3 text-center"
                                                    style="border-bottom: 2px solid #91d20a; display: inline-block;">
                                                    📋 Book Inspection
                                                </h5>
                                                <form @submit.prevent="submitForm" class="inspection-form">
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label small text-muted">Full Name
                                                                *</label>
                                                            <input type="text" x-model="formData.name"
                                                                class="form-control form-control-sm"
                                                                placeholder="Enter your full name" required>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label small text-muted">Email Address
                                                                *</label>
                                                            <input type="email" x-model="formData.email"
                                                                class="form-control form-control-sm"
                                                                placeholder="your.email@example.com" required>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label small text-muted">Phone Number
                                                                *</label>
                                                            <input type="tel" x-model="formData.phone"
                                                                class="form-control form-control-sm"
                                                                placeholder="+234 800 000 0000" required>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <label class="form-label small text-muted">Preferred Date
                                                                *</label>
                                                            <input type="date" x-model="formData.date"
                                                                class="form-control form-control-sm"
                                                                :min="minDate" required>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <label class="form-label small text-muted">Preferred Time
                                                                *</label>
                                                            <input type="time" x-model="formData.time"
                                                                class="form-control form-control-sm" required>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label small text-muted">Special
                                                                Requests</label>
                                                            <textarea x-model="formData.message" class="form-control form-control-sm" rows="2"
                                                                placeholder="Any special requirements or questions..."></textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="submit" class="btn btn-sm w-100 btn-pill"
                                                                :class="{
                                                                    'btn-success': submissionState === 'success',
                                                                    'btn-danger': submissionState === 'error',
                                                                    'btn-gradient color-2': submissionState === 'idle' ||
                                                                        submissionState === 'submitting'
                                                                }"
                                                                :disabled="isSubmitting">
                                                                <template x-if="isSubmitting">
                                                                    <span><i class="fas fa-spinner fa-spin me-1"></i>
                                                                        Submitting...</span>
                                                                </template>
                                                                <template x-if="submissionState === 'success'">
                                                                    <span><i class="fas fa-check me-1"></i> Request
                                                                        Sent!</span>
                                                                </template>
                                                                <template x-if="submissionState === 'error'">
                                                                    <span><i
                                                                            class="fas fa-exclamation-triangle me-1"></i>
                                                                        Try Again</span>
                                                                </template>
                                                                <template x-if="submissionState === 'idle'">
                                                                    <span><i class="fas fa-calendar-check me-1"></i>
                                                                        Schedule Inspection</span>
                                                                </template>
                                                            </button>
                                                        </div>

                                                        <!-- Error message -->
                                                        <div x-show="submissionState === 'error' && errorMessage"
                                                            x-transition:enter="transition ease-out duration-300"
                                                            x-transition:enter-start="opacity-0 transform scale-90"
                                                            x-transition:enter-end="opacity-100 transform scale-100"
                                                            class="col-12 mt-2">
                                                            <div class="alert alert-danger alert-sm">
                                                                <i class="fas fa-exclamation-triangle me-1"></i>
                                                                <strong>Error:</strong><br>
                                                                <small x-text="errorMessage"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                                <!-- Success message -->
                                                <div x-show="submissionState === 'success'"
                                                    x-transition:enter="transition ease-out duration-300"
                                                    x-transition:enter-start="opacity-0 transform scale-90"
                                                    x-transition:enter-end="opacity-100 transform scale-100"
                                                    class="alert alert-success alert-sm mt-2">
                                                    <i class="fas fa-check-circle me-1"></i>
                                                    <strong>Inspection scheduled!</strong><br>
                                                    <small>We'll contact you within 24 hours to confirm the
                                                        details.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <model-viewer
                                            src="{{ asset('themes/classic/realtor/assets/images/3d-images/house.glb') }}"
                                            alt="3D model" auto-rotate camera-controls ar
                                            style="width: 100%; height: 500px;">
                                        </model-viewer>
                                        {{-- <div class="gallery-for">
                                            <div>
                                                <div class="bg-size">
                                                    <img src="{{ asset('themes/classic/client/assets/images/property/2.jpg') }}"
                                                        class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="{{ asset('themes/classic/client/assets/images/property/3.jpg') }}"
                                                        class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="{{ asset('themes/classic/client/assets/images/property/16.jpg') }}"
                                                        class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="{{ asset('themes/classic/client/assets/images/property/7.jpg') }}"
                                                        class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="{{ asset('themes/classic/client/assets/images/property/8.jpg') }}"
                                                        class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="{{ asset('themes/classic/client/assets/images/property/24.jpg') }}"
                                                        class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="{{ asset('themes/classic/client/assets/images/property/3.jpg') }}"
                                                        class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="{{ asset('themes/classic/client/assets/images/property/25.jpg') }}"
                                                        class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="{{ asset('themes/classic/client/assets/images/property/1.jpg') }}"
                                                        class="bg-img" alt="">
                                                </div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="gallery-nav">
                                            <div>
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/4.jpg"
                                                    class="img-fluid" alt="">
                                            </div>
                                            <div>
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/3.jpg"
                                                    class="img-fluid" alt="">
                                            </div>
                                            <div>
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/14.jpg"
                                                    class="img-fluid" alt="">
                                            </div>
                                            <div>
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/11.jpg"
                                                    class="img-fluid" alt="">
                                            </div>
                                            <div>
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/12.jpg"
                                                    class="img-fluid" alt="">
                                            </div>
                                            <div>
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/4.jpg"
                                                    class="img-fluid" alt="">
                                            </div>
                                            <div>
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/3.jpg"
                                                    class="img-fluid" alt="">
                                            </div>
                                            <div>
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/11.jpg"
                                                    class="img-fluid" alt="">
                                            </div>
                                            <div>
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/12.jpg"
                                                    class="img-fluid" alt="">
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="d-block d-lg-none mb-3">
                                <button class="btn btn-gradient color-2 btn-pill btn-block" data-bs-toggle="modal"
                                    data-bs-target="#scheduleModal">
                                    Book Inspection
                                </button>
                            </div>

                            <div class="desc-box">
                                <ul class="nav nav-tabs line-tab" id="top-tab" role="tablist">
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link active"
                                            href="#about">about</a></li>
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link"
                                            href="#feature">feature</a></li>
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link"
                                            href="#video">video</a>
                                    </li>
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link"
                                            href="#floor_plan">Floor
                                            plan</a></li>
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link"
                                            href="#location-map">location</a></li>
                                </ul>
                                <div class=" tab-content" id="top-tabContent">
                                    <div class="tab-pane fade show active about page-section" id="about">
                                        <h4 class="content-title">Property Details
                                            @if ($landingPage->property->latitude && $landingPage->property->longitude)
                                                <a href="https://www.google.com/maps/place/{{ $landingPage->property->latitude }},{{ $landingPage->property->longitude }}"
                                                    target="_blank">
                                                    <i class="fa fa-map-marker-alt"></i> view on map</a>
                                            @endif
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-6 col-xl-4">
                                                <ul class="property-list-details">
                                                    <li><span>Property Type :</span>
                                                        {{ ucfirst($landingPage->property->property_type ?? 'House') }}
                                                    </li>
                                                    <li><span>Property ID :</span>
                                                        {{ $landingPage->property->id ?? 'N/A' }}</li>
                                                    <li><span>Property status :</span> For
                                                        {{ $landingPage->property->listing_type ?? 'sale' }}</li>
                                                    @if ($landingPage->property->year_built)
                                                        <li><span>Year Built :</span>
                                                            {{ $landingPage->property->year_built }}</li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="col-md-6 col-xl-4">
                                                <ul class="property-list-details">
                                                    <li><span>Price :</span>
                                                        {{ $landingPage->property->formatted_price ?? 'Price on request' }}
                                                    </li>
                                                    @if ($landingPage->property->built_area)
                                                        <li><span>Built Area :</span>
                                                            {{ number_format($landingPage->property->built_area, 0) }}
                                                            sqm</li>
                                                    @endif
                                                    @if ($landingPage->property->land_size)
                                                        <li><span>Land Size :</span>
                                                            {{ number_format($landingPage->property->land_size, 0) }}
                                                            sqm</li>
                                                    @endif
                                                    @if ($landingPage->property->parking_spaces)
                                                        <li><span>Parking :</span>
                                                            {{ $landingPage->property->parking_spaces }} spaces</li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="col-md-6 col-xl-4">
                                                <ul class="property-list-details">
                                                    <li><span>City :</span> {{ $landingPage->property->city ?? 'N/A' }}
                                                    </li>
                                                    @if ($landingPage->property->bedrooms)
                                                        <li><span>Bedrooms :</span>
                                                            {{ $landingPage->property->bedrooms }}</li>
                                                    @endif
                                                    @if ($landingPage->property->bathrooms)
                                                        <li><span>Bathrooms :</span>
                                                            {{ $landingPage->property->bathrooms }}</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <h4 class="content-title mt-4">Attachments</h4>
                                        <a href="javascript:void(0)" class="attach-file"><i
                                                class="far fa-file-pdf"></i>Property Document</a>
                                        <h4 class="mt-4">Property Brief</h4>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="font-roboto">
                                                    {{ $landingPage->property->description ?? 'Property description will be displayed here. This property offers excellent features and is located in a prime area with great amenities and accessibility.' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade page-section" id="feature">
                                        <h4 class="content-title">Features & Amenities</h4>
                                        <div class="single-feature row">
                                            @if ($landingPage->property->features && is_array($landingPage->property->features))
                                                @php
                                                    $features = $landingPage->property->features;
                                                    $chunks = array_chunk($features, ceil(count($features) / 3));
                                                @endphp
                                                @foreach ($chunks as $chunk)
                                                    <div class="col-xl-4 col-6">
                                                        <ul>
                                                            @foreach ($chunk as $feature)
                                                                <li>
                                                                    <i class="fas fa-check"></i> {{ $feature }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-xl-3 col-6">
                                                    <ul>
                                                        <li><i class="fas fa-wifi"></i> Free Wi-Fi</li>
                                                        <li><i class="fas fa-hands"></i> Elevator Lift</li>
                                                        <li><i class="fas fa-power-off"></i> Power Backup</li>
                                                        <li><i class="fas fa-monument"></i> Laundry Service</li>
                                                    </ul>
                                                </div>
                                                <div class="col-xl-3 col-6">
                                                    <ul>
                                                        <li><i class="fas fa-user-shield"></i> Security Guard</li>
                                                        <li><i class="fas fa-video"></i> CCTV</li>
                                                        <li><i class="fas fa-door-open"></i> Emergency Exit</li>
                                                        <li><i class="fas fa-first-aid"></i> Doctor On Call</li>
                                                    </ul>
                                                </div>
                                                <div class="col-xl-3 col-6">
                                                    <ul>
                                                        <li><i class="fas fa-shower"></i> Shower</li>
                                                        <li><i class="fas fa-car"></i> Free Parking</li>
                                                        <li><i class="fas fa-fan"></i> Air Conditioning</li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>

                                        @if ($landingPage->property->amenities && is_array($landingPage->property->amenities))
                                            <h4 class="content-title mt-4">Building Amenities</h4>
                                            <div class="single-feature row">
                                                @php
                                                    $amenities = $landingPage->property->amenities;
                                                    $amenityChunks = array_chunk(
                                                        $amenities,
                                                        ceil(count($amenities) / 3),
                                                    );
                                                @endphp
                                                @foreach ($amenityChunks as $chunk)
                                                    <div class="col-xl-4 col-6">
                                                        <ul>
                                                            @foreach ($chunk as $amenity)
                                                                <li>
                                                                    <i class="fas fa-star"></i> {{ $amenity }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade page-section ratio3_2" id="gallery">
                                        <h4 class="content-title">gallery</h4>
                                    </div>
                                    <div class="tab-pane fade page-section ratio_40" id="video">
                                        <h4 class="content-title">video</h4>
                                        <div class="play-bg-image">
                                            <div class="bg-size">
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/11.jpg"
                                                    class="bg-img" alt="">
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
                                        <img src="{{ asset('themes/classic/client/assets/images/property/floor-plan.png') }}"
                                            alt="" class="img-fluid">
                                    </div>
                                    <div class="tab-pane fade page-section" id="location-map"
                                        x-data="locationManager()">
                                        <h4 class="content-title">Property Location & Directions</h4>

                                        <!-- Property Address and Details -->
                                        <div class="row mb-4">
                                            <div class="col-md-8">
                                                <div class="location-details bg-light p-3 rounded">
                                                    <h6 class="fw-bold mb-2"><i
                                                            class="fas fa-map-marker-alt text-success me-2"></i>Property
                                                        Address</h6>
                                                    <p class="mb-1">
                                                        <strong>{{ $landingPage->property->name ?? 'Property Name' }}</strong>
                                                    </p>
                                                    <p class="text-muted mb-2">
                                                        {{ $landingPage->property->full_address ?? 'Property address will be displayed here' }}
                                                    </p>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        <span
                                                            class="badge bg-primary">{{ ucfirst($landingPage->property->property_type ?? 'House') }}</span>
                                                        <span class="badge bg-success">For
                                                            {{ ucfirst($landingPage->property->listing_type ?? 'Sale') }}</span>
                                                        <span
                                                            class="badge bg-info">{{ ucfirst($landingPage->property->status ?? 'Available') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="distance-calculator bg-primary bg-opacity-10 p-3 rounded">
                                                    <h6 class="fw-bold mb-2"><i
                                                            class="fas fa-route text-primary me-2"></i>Distance
                                                        Calculator</h6>
                                                    <button @click="calculateDistance()"
                                                        class="btn btn-primary btn-sm w-100 mb-2"
                                                        :disabled="distanceState.isCalculating">
                                                        <template x-if="distanceState.isCalculating">
                                                            <span><i
                                                                    class="fas fa-spinner fa-spin me-1"></i>Calculating...</span>
                                                        </template>
                                                        <template
                                                            x-if="!distanceState.isCalculating && !distanceState.hasResult">
                                                            <span><i class="fas fa-location-arrow me-1"></i>Get
                                                                Distance from My Location</span>
                                                        </template>
                                                        <template
                                                            x-if="!distanceState.isCalculating && distanceState.hasResult">
                                                            <span><i class="fas fa-redo me-1"></i>Recalculate</span>
                                                        </template>
                                                    </button>

                                                    <!-- Distance Result -->
                                                    <div x-show="distanceState.result"
                                                        x-transition:enter="transition ease-out duration-300"
                                                        x-transition:enter-start="opacity-0 transform translate-y-4"
                                                        x-transition:enter-end="opacity-100 transform translate-y-0"
                                                        class="small text-muted">
                                                        <div x-show="distanceState.success"
                                                            class="alert alert-success alert-sm p-2 mt-2">
                                                            <i class="fas fa-map-signs me-1"></i>
                                                            <strong x-text="distanceState.distance + ' km'"></strong>
                                                            from your location<br>
                                                            <small><i class="fas fa-car me-1"></i>Estimated driving
                                                                time: <span x-text="distanceState.drivingTime"></span>
                                                                minutes</small>
                                                        </div>
                                                        <div x-show="distanceState.error"
                                                            class="alert alert-warning alert-sm p-2 mt-2">
                                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                                            <span x-text="distanceState.errorMessage"></span><br>
                                                            <small>Please allow location access or enter your address
                                                                manually.</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Interactive Map -->
                                        <div class="map-container mb-3">
                                            <div style="height: 400px; border-radius: 8px; overflow: hidden;">
                                                @if ($landingPage->property->latitude && $landingPage->property->longitude)
                                                    <iframe
                                                        title="Property Location - {{ $landingPage->property->name }}"
                                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3000!2d{{ $landingPage->property->longitude }}!3d{{ $landingPage->property->latitude }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM40zNzc0LjgiTiAzwrAyMCcwMC4wIkU!5e0!3m2!1sen!2s!4v1609344300000!5m2!1sen!2s&q={{ urlencode($landingPage->property->full_address) }}"
                                                        width="100%" height="400" style="border:0;"
                                                        allowfullscreen="" loading="lazy">
                                                    </iframe>
                                                @else
                                                    <iframe title="Property Location"
                                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3000!2d3.4533!3d6.4474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMjYnNTAuNiJOIDPCsDI3JzExLjkiRQ!5e0!3m2!1sen!2s!4v1609344300000!5m2!1sen!2s"
                                                        width="100%" height="400" style="border:0;"
                                                        allowfullscreen="" loading="lazy">
                                                    </iframe>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Nearby Amenities -->
                                        <div class="nearby-amenities">
                                            <h6 class="fw-bold mb-3"><i class="fas fa-compass me-2"></i>Nearby
                                                Amenities</h6>
                                            <div class="row">
                                                <template x-for="amenity in nearbyAmenities" :key="amenity.name">
                                                    <div class="col-md-3 col-6 mb-3">
                                                        <div class="amenity-item text-center p-2 border rounded"
                                                            @mouseenter="animateAmenity($event)"
                                                            @mouseleave="resetAmenity($event)">
                                                            <i :class="amenity.icon + ' fs-4 mb-2'"
                                                                :style="'color: ' + amenity.color"></i>
                                                            <h6 class="small mb-1" x-text="amenity.name"></h6>
                                                            <small class="text-muted"
                                                                x-text="amenity.distance"></small>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>

                                        <!-- Map Controls -->
                                        <div class="map-controls mt-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button @click="toggleMapView('satellite')"
                                                        class="btn btn-outline-primary btn-sm me-2"
                                                        :class="{ 'active': currentView === 'satellite' }">
                                                        <i class="fas fa-satellite me-1"></i>Satellite View
                                                    </button>
                                                    <button @click="toggleMapView('street')"
                                                        class="btn btn-outline-primary btn-sm"
                                                        :class="{ 'active': currentView === 'street' }">
                                                        <i class="fas fa-road me-1"></i>Street View
                                                    </button>
                                                </div>
                                                <div class="col-md-6 text-md-end">
                                                    <a :href="googleMapsLink" target="_blank"
                                                        class="btn btn-success btn-sm">
                                                        <i class="fas fa-external-link-alt me-1"></i>Open in Google
                                                        Maps
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
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
                                        @if ($referralUser && $referralUser->image_url)
                                            <img src="{{ $referralUser->image_url }}"
                                                class="img-50 rounded-circle mb-2" alt="Realtor Photo">
                                        @else
                                            <img src="{{ asset('themes/classic/client/assets/images/testimonial/3.png') }}"
                                                class="img-50 rounded-circle mb-2" alt="Realtor Photo">
                                        @endif
                                        <div class="media-body text-center">
                                            <h5 class="fw-semibold">{{ $referralUser->name ?? 'Property Agent' }}</h5>
                                            <p class="text-secondary small mb-0">
                                                @if ($referralUser && $referralUser->occupation)
                                                    {{ $referralUser->occupation }},
                                                    {{ config('app.name', 'Hubolux') }}
                                                @else
                                                    Senior Property Advisor, {{ config('app.name', 'Hubolux') }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-muted small">
                                    @if ($referralUser)
                                        {{ $referralUser->name }} is a dedicated property consultant with extensive
                                        experience in the
                                        {{ $landingPage->property->city ?? 'local' }} real estate market.
                                        @if ($referralUser->occupation)
                                            As a {{ strtolower($referralUser->occupation) }},
                                        @endif
                                        {{ $referralUser->gender === 'male' ? 'He' : ($referralUser->gender === 'female' ? 'She' : 'They') }}
                                        {{ $referralUser->gender === 'male' ? 'is' : ($referralUser->gender === 'female' ? 'is' : 'are') }}
                                        committed to helping clients find their perfect property investment.
                                    @else
                                        Our property advisor is dedicated to providing personalized service and ensuring
                                        clients find properties that perfectly match their lifestyle and investment
                                        goals.
                                    @endif
                                </p>

                                <ul class="list-unstyled my-3 small">
                                    <li class="mb-2">
                                        <i data-feather="phone-call" class="me-2"></i>
                                        {{ $referralUser->phone ?? '+234 801 234 5678' }}
                                    </li>
                                    <li class="mb-2">
                                        <i data-feather="mail" class="me-2"></i>
                                        {{ $referralUser->email ?? 'agent@example.com' }}
                                    </li>
                                    @if ($referralUser && $referralUser->residential_address)
                                        <li class="mb-2">
                                            <i data-feather="map-pin" class="me-2"></i>
                                            {{ $referralUser->residential_address }}
                                        </li>
                                    @endif
                                </ul>

                                @php
                                    $whatsappNumber =
                                        $referralUser && $referralUser->phone
                                            ? str_replace(['+', ' ', '-', '(', ')'], '', $referralUser->phone)
                                            : '2348123456789';

                                    $whatsappMessage =
                                        'Hi ' .
                                        ($referralUser->name ?? 'there') .
                                        "! I'm interested in the property: " .
                                        ($landingPage->property->name ?? 'Property') .
                                        '. Can you provide more details?';
                                @endphp

                                <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($whatsappMessage) }}"
                                    class="btn w-100 text-white" style="background-color: #78c705;" target="_blank">
                                    <i class="fab fa-whatsapp me-2"></i> Chat On WhatsApp
                                </a>

                                @if ($referralUser)
                                    <small class="text-muted mt-2 d-block">
                                        <i class="fas fa-id-badge me-1"></i>
                                        Agent Code: {{ $referralUser->referral_code }}
                                    </small>
                                @endif
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
                                <a href="{{ route('tenant.client.home') }}">
                                    <img src="{{ asset('themes/classic/client/assets/images/logo.png') }}"
                                        alt="" class="img-fluid">
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
                                    <a href="{{ route('tenant.client.home') }}">Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('tenant.client.events') }}">Events</a>
                                </li>
                                <li>
                                    <a href="{{ route('tenant.client.contact') }}">Contact</a>
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
    <div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel"
        aria-hidden="true" x-data="inspectionForm()">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header border-0 pb-1">
                    <h5 class="modal-title fw-bold" id="scheduleModalLabel">
                        <i class="fas fa-calendar-check text-success me-2"></i>Book Property Inspection
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-2">
                    <div class="alert alert-info alert-sm mb-3">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Orchard House</strong> - Mina Road, Bur Dubai, Dubai
                    </div>

                    <form @submit.prevent="submitForm" class="inspection-form">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label small text-muted">Full Name *</label>
                                <input type="text" x-model="formData.name" class="form-control"
                                    placeholder="Enter your full name" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label small text-muted">Email Address *</label>
                                <input type="email" x-model="formData.email" class="form-control"
                                    placeholder="your.email@example.com" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label small text-muted">Phone Number *</label>
                                <input type="tel" x-model="formData.phone" class="form-control"
                                    placeholder="+971 50 000 0000" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label small text-muted">Preferred Date *</label>
                                <input type="date" x-model="formData.date" class="form-control"
                                    :min="minDate" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label small text-muted">Preferred Time *</label>
                                <input type="time" x-model="formData.time" class="form-control" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label small text-muted">Special Requests</label>
                                <textarea x-model="formData.message" class="form-control" rows="2"
                                    placeholder="Any special requirements or questions..."></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn w-100 btn-pill"
                                    :class="submissionState === 'success' ? 'btn-success' : 'btn-gradient color-2'"
                                    :disabled="isSubmitting">
                                    <template x-if="isSubmitting">
                                        <span><i class="fas fa-spinner fa-spin me-2"></i>Submitting...</span>
                                    </template>
                                    <template x-if="submissionState === 'success'">
                                        <span><i class="fas fa-check me-2"></i>Request Sent!</span>
                                    </template>
                                    <template x-if="submissionState === 'idle'">
                                        <span><i class="fas fa-calendar-check me-2"></i>Schedule Inspection</span>
                                    </template>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Success message -->
                    <div x-show="submissionState === 'success'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-90"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        class="alert alert-success alert-sm mt-3">
                        <i class="fas fa-check-circle me-1"></i>
                        <strong>Inspection scheduled!</strong><br>
                        <small>We'll contact you within 24 hours to confirm the details.</small>
                    </div>

                    <div class="mt-3 pt-3 border-top">
                        <div class="row text-center">
                            <div class="col-4">
                                <small class="text-muted d-block">Response Time</small>
                                <strong class="text-success">24 Hours</strong>
                            </div>
                            <div class="col-4">
                                <small class="text-muted d-block">Available Days</small>
                                <strong class="text-primary">Mon - Sat</strong>
                            </div>
                            <div class="col-4">
                                <small class="text-muted d-block">Inspection Time</small>
                                <strong class="text-warning">9AM - 6PM</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- latest jquery-->
    <script src="{{ asset('themes/classic/client/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- popper js-->
    <script src="{{ asset('themes/classic/client/assets/js/popper.min.js') }}"></script>

    <!-- magnific js -->
    <script src="{{ asset('themes/classic/realtor/assets/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('themes/classic/realtor/assets/js/zoom-gallery.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('themes/classic/client/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- feather icon js-->
    <script src="{{ asset('themes/classic/client/assets/js/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('themes/classic/client/assets/js/feather-icon/feather-icon.js') }}"></script>

    <!-- range slider js -->
    <script src="{{ asset('themes/classic/client/assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('themes/classic/client/assets/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('themes/classic/client/assets/js/range-slider.js') }}"></script>

    <!-- slick js -->
    <script src="{{ asset('themes/classic/client/assets/js/slick.js') }}"></script>
    <script src="{{ asset('themes/classic/client/assets/js/slick-animation.min.js') }}"></script>
    <script src="{{ asset('themes/classic/client/assets/js/custom-slick.js') }}"></script>

    <!-- print js -->
    <script src="{{ asset('themes/classic/realtor/assets/js/print.js') }}"></script>

    <!-- Template js-->
    <script src="{{ asset('themes/classic/client/assets/js/script.js') }}"></script>

    <!-- Customizer js-->
    <script src="{{ asset('themes/classic/client/assets/js/customizer.js') }}"></script>

    <!-- Color-picker js-->
    <script src="{{ asset('themes/classic/realtor/assets/js/color/single-property.js') }}"></script>

    <!-- Alpine.js Components and Functionality -->
    <script>
        // Alpine.js Inspection Form Component
        function inspectionForm() {
            return {
                formData: {
                    name: '',
                    email: '',
                    phone: '',
                    date: '',
                    time: '',
                    message: '',
                    property_id: null,
                    referral_code: null
                },
                submissionState: 'idle', // idle, submitting, success, error
                isSubmitting: false,
                errorMessage: '',

                get minDate() {
                    return new Date().toISOString().split('T')[0];
                },

                async submitForm() {
                    this.isSubmitting = true;
                    this.submissionState = 'submitting';
                    this.errorMessage = '';

                    try {
                        // Get CSRF token
                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                        // Map form data to API expected format
                        const apiData = {
                            property_id: this.formData.property_id,
                            name: this.formData.name,
                            email: this.formData.email,
                            phone: this.formData.phone,
                            preferred_date: this.formData.date,
                            preferred_time: this.formData.time,
                            message: this.formData.message,
                            referral_code: this.formData.referral_code
                        };

                        const response = await fetch('/property-inspections', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify(apiData)
                        });

                        const data = await response.json();

                        if (data.success) {
                            this.submissionState = 'success';

                            // Reset form after 5 seconds
                            setTimeout(() => {
                                this.resetForm();
                            }, 5000);
                        } else {
                            this.submissionState = 'error';
                            this.errorMessage = data.message || 'An error occurred while submitting your request.';

                            // Show validation errors if any
                            if (data.errors) {
                                const errorMessages = Object.values(data.errors).flat();
                                this.errorMessage = errorMessages.join(' ');
                            }

                            // Reset to idle after 5 seconds to allow retry
                            setTimeout(() => {
                                this.submissionState = 'idle';
                                this.errorMessage = '';
                            }, 5000);
                        }

                    } catch (error) {
                        console.error('Submission error:', error);
                        this.submissionState = 'error';
                        this.errorMessage = 'Network error. Please check your connection and try again.';

                        // Reset to idle after 5 seconds to allow retry
                        setTimeout(() => {
                            this.submissionState = 'idle';
                            this.errorMessage = '';
                        }, 5000);
                    } finally {
                        this.isSubmitting = false;
                    }
                },

                resetForm() {
                    this.formData = {
                        name: '',
                        email: '',
                        phone: '',
                        date: '',
                        time: '',
                        message: '',
                        property_id: null,
                        referral_code: null
                    };
                    this.submissionState = 'idle';
                    this.errorMessage = '';
                },

                async loadPropertyData() {
                    // Load property data from the landing page
                    this.formData.property_id = {{ $landingPage->property->id ?? 'null' }};

                    // Get referral code from URL parameters if available
                    const urlParams = new URLSearchParams(window.location.search);
                    const referralCode = urlParams.get('ref');
                    if (referralCode) {
                        this.formData.referral_code = referralCode;
                    }
                },

                init() {
                    // Initialize with property data
                    this.loadPropertyData();
                }
            }
        }

        // Alpine.js Location Manager Component
        function locationManager() {
            return {
                propertyDetails: {
                    name: '{{ $landingPage->property->name ?? 'Property Name' }}',
                    address: '{{ $landingPage->property->full_address ?? 'Property Address' }}',
                    lat: {{ $landingPage->property->latitude ?? '6.4474' }},
                    lng: {{ $landingPage->property->longitude ?? '3.4533' }},
                    badges: [{
                            text: '{{ ucfirst($landingPage->property->property_type ?? 'House') }}',
                            class: 'bg-info'
                        },
                        {
                            text: 'For {{ ucfirst($landingPage->property->listing_type ?? 'Sale') }}',
                            class: 'bg-success'
                        },
                        {
                            text: '{{ ucfirst($landingPage->property->status ?? 'Available') }}',
                            class: 'bg-warning'
                        }
                    ]
                },

                distanceState: {
                    isCalculating: false,
                    hasResult: false,
                    success: false,
                    error: false,
                    result: false,
                    distance: 0,
                    drivingTime: 0,
                    errorMessage: ''
                },

                currentView: 'street',

                nearbyAmenities: [{
                        name: 'Shopping Mall',
                        icon: 'fas fa-shopping-cart',
                        color: '#28a745',
                        distance: '0.5 km'
                    },
                    {
                        name: 'Schools',
                        icon: 'fas fa-graduation-cap',
                        color: '#007bff',
                        distance: '0.8 km'
                    },
                    {
                        name: 'Hospital',
                        icon: 'fas fa-hospital',
                        color: '#dc3545',
                        distance: '1.2 km'
                    },
                    {
                        name: 'Metro Station',
                        icon: 'fas fa-subway',
                        color: '#ffc107',
                        distance: '0.3 km'
                    }
                ],

                get currentMapSrc() {
                    const baseUrl =
                        'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3610.1696792635147!2d55.29124!3d25.246701!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f43496ad9c645%3A0xbde66e5084295162!2sBur%20Dubai%2C%20Dubai%20-%20United%20Arab%20Emirates';
                    const satelliteParam = this.currentView === 'satellite' ? '!5e1' : '!5e0';
                    return baseUrl + satelliteParam + '!3m2!1sen!2sae!4v1642678545123!5m2!1sen!2sae';
                },

                get googleMapsLink() {
                    return `https://www.google.com/maps/place/${this.propertyDetails.lat},${this.propertyDetails.lng}/@${this.propertyDetails.lat},${this.propertyDetails.lng},17z`;
                },

                async calculateDistance() {
                    this.distanceState.isCalculating = true;
                    this.distanceState.result = false;

                    if (!navigator.geolocation) {
                        this.handleLocationError('Geolocation not supported by this browser.');
                        return;
                    }

                    try {
                        const position = await this.getCurrentPosition();
                        const userLat = position.coords.latitude;
                        const userLng = position.coords.longitude;

                        const distance = this.getDistanceFromLatLonInKm(
                            userLat, userLng,
                            this.propertyDetails.lat, this.propertyDetails.lng
                        );

                        const drivingTime = Math.round((distance / 30) * 60);

                        this.distanceState = {
                            ...this.distanceState,
                            isCalculating: false,
                            hasResult: true,
                            success: true,
                            error: false,
                            result: true,
                            distance: parseFloat(distance.toFixed(1)),
                            drivingTime: drivingTime
                        };

                    } catch (error) {
                        this.handleLocationError(this.getLocationErrorMessage(error));
                    }
                },

                getCurrentPosition() {
                    return new Promise((resolve, reject) => {
                        navigator.geolocation.getCurrentPosition(resolve, reject);
                    });
                },

                getLocationErrorMessage(error) {
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            return 'Location access denied.';
                        case error.POSITION_UNAVAILABLE:
                            return 'Location information unavailable.';
                        case error.TIMEOUT:
                            return 'Location request timed out.';
                        default:
                            return 'An unknown error occurred.';
                    }
                },

                handleLocationError(message) {
                    this.distanceState = {
                        ...this.distanceState,
                        isCalculating: false,
                        hasResult: false,
                        success: false,
                        error: true,
                        result: true,
                        errorMessage: message
                    };
                },

                getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
                    const R = 6371; // Radius of the earth in km
                    const dLat = this.deg2rad(lat2 - lat1);
                    const dLon = this.deg2rad(lon2 - lon1);
                    const a =
                        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                        Math.cos(this.deg2rad(lat1)) * Math.cos(this.deg2rad(lat2)) *
                        Math.sin(dLon / 2) * Math.sin(dLon / 2);
                    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                    const d = R * c;
                    return d;
                },

                deg2rad(deg) {
                    return deg * (Math.PI / 180);
                },

                toggleMapView(viewType) {
                    this.currentView = viewType;
                },

                animateAmenity(event) {
                    event.currentTarget.style.transform = 'translateY(-3px)';
                    event.currentTarget.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.1)';
                    event.currentTarget.style.borderColor = '#91d20a';
                },

                resetAmenity(event) {
                    event.currentTarget.style.transform = '';
                    event.currentTarget.style.boxShadow = '';
                    event.currentTarget.style.borderColor = '';
                }
            }
        }

        // Global Alpine.js configuration
        document.addEventListener('alpine:init', () => {
            // Additional global Alpine.js setup can go here
        });
    </script>

</body>

</html>
