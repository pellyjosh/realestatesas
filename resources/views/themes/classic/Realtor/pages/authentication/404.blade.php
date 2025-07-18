<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/sheltos/back-end/404.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Jun 2025 13:57:33 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sheltos - 404 page">
    <meta name="keywords" content="sheltos">
    <meta name="author" content="sheltos">
    <link rel="icon" href="{{ asset('client/assets/images/logo.png') }}" type="image/x-icon" />
    <title>404| Premium Refined Luxury Homes</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">

    <!-- animate css -->
    <link rel="stylesheet" type="text/css" href="https://themes.pixelstrap.com/sheltos/assets/css/animate.css">

    <!-- Template css -->
    <link rel="stylesheet" type="text/css" href="https://themes.pixelstrap.com/sheltos/assets/css/admin.css">

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

    <!-- page wrapper start -->
    <div class="page-wrapper">
        <div class="page-not-found">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-10">
                        <div class="not-found-img">
                            <img src="{{ asset('admin/assets/images/auth/404.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-10">
                        <div class="not-found-content">
                            <h2>Sorry...This page does not exist.</h2>
                            <p class="font-roboto light-font">We are sorry but the page you are looking for doesn't
                                exist or has been removed. please check or search again.</p>
                            <div class="btns">
                                <a href="{{ route('tenant.admin.dashboard') }}" class="btn btn-pill"
                                    style="background-color: #78c705; color: #fff; border: none;">go to home page</a>
                                <a href="index.html" class="btn btn-pill btn-dashed color-4 ms-2">Report problem</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page wrapper start -->

    <!-- latest jquery-->
    <script src="{{ asset('admin/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--admin js -->
    <script src="{{ asset('admin/assets/js/admin-script.js') }}"></script>

</body>

</html>
