@extends('superadmin.auth.auth_master')
@section('title', 'Login')
@section('content')
    <!-- content  -->
    <form class="form" method="" action="#">
        <div class="header">
            <div class="logo-container">
                <img src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/logo.svg" alt="">
            </div>
            <h5>Log in</h5>
        </div>
        <div class="content">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter User Name">
                <span class="input-group-addon">
                    <i class="zmdi zmdi-account-circle"></i>
                </span>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" class="form-control" />
                <span class="input-group-addon">
                    <i class="zmdi zmdi-lock"></i>
                </span>
            </div>
        </div>
        <div class="footer text-center">
            <a href="index.html" class="btn btn-primary btn-round btn-lg btn-block ">SIGN IN</a>
            <h5><a href="forgot-password.html" class="link">Forgot Password?</a></h5>
        </div>
        <div class="footer text-center">
            <h5> Don’t have an account? <a href="{{ route('superadmin.register') }}">Sign Up</a></h5>
        </div>
    </form>
    <!-- end content -->
@endsection
