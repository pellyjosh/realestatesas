<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Premium Refined Luxury Homes - Login page">
    <meta name="keywords" content="Premium Refined Luxury Homes">
    <meta name="author" content="Premium Refined Luxury Homes">
    <link rel="icon" href="{{ asset('themes/classic/client/assets/images/logo.png') }}" type="image/x-icon" />
    <title>@yield('title')</title>

    
    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">

    <!-- animate css -->
    <link rel="stylesheet" type="text/css" href="{{ asset("themes/classic/client/assets/css/animate.css") }}">

    <!-- Template css -->
    <link rel="stylesheet" type="text/css" href="{{ asset("themes/classic/admin/assets/css/admin.css") }}">


    <!-- Font Awesome 6 Free CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>

    <!-- Loader start -->
    <div class="loader-wrapper">
        <div class="row loader-text">
            <div class="col-12">
                <img src="{{ asset('themes/classic/client/assets/images/loader/gear.gif') }}" class="img-fluid" alt="">
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
        <div class="authentication-box">
            <div class="container-fluid">
                <div class="row log-in">
                    <div class="col-xxl-3 col-xl-4 col-lg-5 col-md-6 col-sm-8 form-login">
                        <div class="card">

                            @yield('content')

                        </div>
                    </div>
                    <div class="col-xxl-7 col-xl-7 offset-xxl-1 col-lg-6 auth-img">
                        <img src="{{ asset('themes/classic/admin/assets/images/auth/auth-img.png') }}" class="bg-img" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- latest jquery-->
    <script src="{{ asset('themes/classic/admin/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('themes/classic/admin/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- feather icon js-->
    <script src="{{ asset('themes/classic/client/assets/js/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('themes/classic/client/assets/js/feather-icon/feather-icon.js') }}"></script>

    <!--admin js -->
    <script src="{{ asset('themes/classic/admin/assets/js/admin-script.js') }}"></script>

    <!-- login js -->
    <script src="{{ asset('themes/classic/admin/assets/js/login.js') }}"></script>

</body>

</html>
