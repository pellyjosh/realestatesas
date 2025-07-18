<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Premium Refined Luxury Homes- Admin dashboard page">
    <meta name="keywords" content="Premium Refined Luxury Homes, Admin Dashboard, Real Estate, Property Management">
    <meta name="author" content="Premium Refined Luxury Homes">
    <link rel="icon" href="{{ asset('themes/classic/client/assets/images/logo.png') }}" type="image/x-icon" />
    <title>@yield('title', 'Premim Refined Admin page')</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">

    <!-- animate css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/classic/client/assets/css/animate.css') }}">

    <!-- Template css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/classic/admin/assets/css/admin.css') }}">

    <!-- magnific css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/classic/admin/assets/css/magnific-popup.css') }}">

    <!-- Font Awesome 6 Free CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- Property Slider CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/classic/admin/assets/css/property-slider.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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

    <div class="page-wrapper">

        @include('themes.classic.admin.partials.header')
        <div class="page-body-wrapper">


            @include('themes.classic.admin.partials.sidebar')

            <div class="page-body">

                @yield('content')


            </div>

            <!-- footer start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 footer-copyright">
                            <p class="mb-0">Copyright 2025 Premium Refined By 💚 Hubolux Technologies.</p>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- footer end -->
        </div>
    </div>

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
                    <h6 class="color-4">Layout type</h6>
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
                    <h6 class="color-4">Layout Direction</h6>
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
                    <h6 class="color-4">Unlimited Color</h6>
                </div>
                <div class="option-setting unlimited-color-layout">
                    <div class="form-group">
                        <label for="ColorPicker6">color 6</label>
                        <input id="ColorPicker6" type="color" value="#f35d43" name="Default">
                    </div>
                    <div class="form-group">
                        <label for="ColorPicker7">color 7</label>
                        <input id="ColorPicker7" type="color" value="#f34451" name="Default">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- customizer end -->

    <!-- latest jquery-->
    <script src="{{ asset('themes/classic/admin/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <script src="{{ asset('themes/classic/admin/assets/js/check.js') }}"></script>


    <!-- Bootstrap js-->
    <script src="{{ asset('themes/classic/admin/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- feather icon js-->
    <script src="{{ asset('themes/classic/client/assets/js/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('themes/classic/client/assets/js/feather-icon/feather-icon.js') }}"></script>

    <!-- magnific js -->
    <script src="{{ asset('themes/classic/admin/assets/js/zoom-gallery.js') }}"></script>
    <script src="{{ asset('themes/classic/admin/assets/js/jquery.magnific-popup.js') }}"></script>

    <!-- slick js -->
    <script src="{{ asset('themes/classic/admin/assets/js/slick.js') }}"></script>
    <script src="{{ asset('themes/classic/admin/assets/js/property-slider.js') }}"></script>
    <script>
        $(document).ready(function() {
            console.log('Initializing property slider from master');
            $('.property-slider').each(function() {
                $(this).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    prevArrow: $(this).find('.prev-arrow'),
                    nextArrow: $(this).find('.next-arrow'),
                    dots: false,
                    autoplay: false,
                    infinite: true
                });
            });
        });
    </script>

    <!-- sidebar js -->
    <script src="{{ asset('themes/classic/admin/assets/js/sidebar.js') }}"></script>

    <!-- apex chart js-->
    <script src="{{ asset('themes/classic/admin/assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('themes/classic/admin/assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('themes/classic/admin/assets/js/admin-dashboard.js') }}"></script>

    <!-- vector map js-->
    <script src="{{ asset('themes/classic/admin/assets/js/vector-map/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('themes/classic/admin/assets/js/vector-map/jquery-jvectormap-asia-mill.js') }}"></script>


    <!--admin js -->
    <script src="{{ asset('themes/classic/admin/assets/js/admin-script.js') }}"></script>
    <script src="{{ asset('themes/classic/admin/assets/js/report.js') }}"></script>

    <!-- Customizer js-->
    <script src="{{ asset('themes/classic/admin/assets/js/customizer.js') }}"></script>

    <!-- Color-picker js-->
    <script src="{{ asset('themes/classic/admin/assets/js/color/custom-colorpicker.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>
