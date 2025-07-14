<!doctype html>
<html lang="en">

<head>
    @include('superadmin.components.meta')
</head>

<body class="theme-purple authentication sidebar-collapse">
    <div class="page-header">
        <div class="page-header-image" style="background-image:url('{{ asset('superadmin/assets/images/login.jpg') }}')">
        </div>
        <div class="container">
            <div class="col-md-12 content-center">
                <div class="card-plain">

                    {{-- content  --}}
                    @yield('content')
                    {{-- endcontent --}}


                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="copyright">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>,
                    <span>Designed by <a href="#" target="_blank">Hublox Technologies</a></span>
                </div>
            </div>
        </footer>
    </div>


    <!-- Jquery Core Js -->
    <script src="{{ asset('superadmin/assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('superadmin/assets/bundles/vendorscripts.bundle.js') }}"></script>
</body>

</html>
