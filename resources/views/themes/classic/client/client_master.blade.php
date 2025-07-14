<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> {{-- Essential for responsive design and mobile SEO --}}
    <meta name="description"
        content="Discover exquisite luxury homes and premium refined properties for sale. Explore high-end real estate listings with advanced search, stunning visuals, and detailed information.">
    {{-- Optimized for search engines, max 160 characters --}}
    <meta name="keywords"
        content="luxury homes, premium properties, refined real estate, high-end homes, luxury real estate, homes for sale, property search, real estate listings">
    {{-- Relevant keywords, though less impactful for Google SEO now --}}
    <meta name="author" content="Hubolux Technologies"> {{-- Specify the author/company --}}

    {{-- Open Graph / Facebook / LinkedIn / WhatsApp --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}"> {{-- Canonical URL of the page --}}
    <meta property="og:title" content="@yield('title', 'Premium Refined Luxury Homes')"> {{-- Title for social sharing --}}
    <meta property="og:description"
        content="Discover exquisite luxury homes and premium refined properties for sale. Explore high-end real estate listings with advanced search, stunning visuals, and detailed information.">
    {{-- Description for social sharing --}}
    <meta property="og:image" content="{{ asset('themes/classic/client/assets/images/logo.png') }}">
    {{-- URL to an image for social sharing (e.g., your logo or a hero image) --}}
    <meta property="og:image:width" content="1200"> {{-- Recommended image width for Open Graph --}}
    <meta property="og:image:height" content="630"> {{-- Recommended image height for Open Graph --}}

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image"> {{-- Type of Twitter card --}}
    <meta name="twitter:url" content="{{ url()->current() }}"> {{-- Canonical URL of the page --}}
    <meta name="twitter:title" content="@yield('title', 'Premium Refined Luxury Homes')"> {{-- Title for Twitter sharing --}}
    <meta name="twitter:description"
        content="Discover exquisite luxury homes and premium refined properties for sale. Explore high-end real estate listings with advanced search, stunning visuals, and detailed information.">
    {{-- Description for Twitter sharing --}}
    <meta name="twitter:image" content="{{ asset('themes/classic/client/assets/images/logo.png') }}">
    {{-- URL to an image for Twitter sharing --}}
    <meta name="twitter:site" content="@YourTwitterHandle"> {{-- Your Twitter handle (e.g., @HuboluxTech) --}}

    {{-- Canonical Link --}}
    <link rel="canonical" href="{{ url()->current() }}"> {{-- Helps search engines understand t-awhe preferred version of a page --}}
    <link rel="icon" href="{{ asset('themes/classic/client/assets/images/logo.png') }}" type="image/x-icon" />
    <title>@yield('title', 'Master Page')</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&family=Rubik:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome 6 Free CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- range slider css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/classic/client/assets/css/jquery-ui.css') }}">

    <!-- animate css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/classic/client/assets/css/animate.css') }}">

    <!-- Template css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/classic/client/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/classic/client/assets/css/color1.css') }}">

    <style>
        /* Sticky WhatsApp Button */
        .whatsapp-sticky-button {
            position: fixed;
            bottom: 40px;
            left: 30px;
            width: 50px;
            height: 50px;
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

    @include('themes.classic.client.partials.headers')


    @yield('main')

    @include('themes.classic.client.partials.footers')

    <!-- latest jquery-->
    <script src="{{ asset('themes/classic/client/assets/js/jquery-3.6.0.min.js') }}" defer></script>

    <!-- popper js-->
    <script src="{{ asset('themes/classic/client/assets/js/popper.min.js') }}" defer></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('themes/classic/client/assets/js/bootstrap.bundle.min.js') }}" defer></script>
    <script>
        // Ensure Bootstrap dropdowns are initialized
        document.addEventListener('DOMContentLoaded', function() {
            var dropdowns = document.querySelectorAll('.dropdown-toggle');
            dropdowns.forEach(function(dropdown) {
                dropdown.addEventListener('click', function() {
                    var dropdownMenu = this.nextElementSibling;
                    if (dropdownMenu.classList.contains('dropdown-menu')) {
                        dropdownMenu.classList.toggle('show');
                    }
                });
            });
        });
    </script>

    <!-- range slider js -->
    <script src="{{ asset('themes/classic/client/assets/js/jquery-ui.js') }}" defer></script>
    <script src="{{ asset('themes/classic/client/assets/js/jquery.ui.touch-punch.min.js') }}" defer></script>
    <script src="{{ asset('themes/classic/client/assets/js/range-slider.js') }}" defer></script>

    <!-- feather icon js-->
    <script src="{{ asset('themes/classic/client/assets/js/feather-icon/feather.min.js') }}" defer></script>
    <script src="{{ asset('themes/classic/client/assets/js/feather-icon/feather-icon.js') }}" defer></script>

    <!-- slick js -->
    <script src="{{ asset('themes/classic/client/assets/js/slick.js') }}" defer></script>
    <script src="{{ asset('themes/classic/client/assets/js/slick-animation.min.js') }}" defer></script>
    <script src="{{ asset('themes/classic/client/assets/js/custom-slick.js') }}" defer></script>

    <!-- notify js -->
    <script src="{{ asset('themes/classic/client/assets/js/bootstrap-notify.min.js') }}" defer></script>

    <!-- wow js-->
    <script src="{{ asset('themes/classic/client/assets/js/wow.min.js') }}" defer></script>

    <!-- Template js-->
    <script src="{{ asset('themes/classic/client/assets/js/script.js') }}" defer></script>

    <!-- Customizer js-->
    <script src="{{ asset('themes/classic/client/assets/js/customizer.js') }}" defer></script>

    <!-- Color-picker js-->
    <script src="{{ asset('themes/classic/client/assets/js/color/layout3.js') }}" defer></script>

</body>

</html>
