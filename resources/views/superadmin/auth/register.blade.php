@extends('superadmin.auth.auth_master')
@section('title', 'Login')
@section('content')
    <!-- content  -->
    <form class="form" method="" action="#">
        <div class="header">
            <div class="logo-container">
                <img src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/logo.svg" alt="">
            </div>
            <h5>Sign Up</h5>
            <span>Register a new membership</span>
        </div>
        <div class="content">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter User Name">
                <span class="input-group-addon">
                    <i class="zmdi zmdi-account-circle"></i>
                </span>
            </div>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter Email">
                <span class="input-group-addon">
                    <i class="zmdi zmdi-email"></i>
                </span>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" class="form-control" />
                <span class="input-group-addon">
                    <i class="zmdi zmdi-lock"></i>
                </span>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirm Password" class="form-control" />
                <span class="input-group-addon">
                    <i class="zmdi zmdi-lock"></i>
                </span>
            </div>
        </div>
        <div class="checkbox">
            <input id="terms" type="checkbox">
            <label for="terms">
                I read and agree to the <a href="javascript:void(0);">terms of usage</a>
            </label>
        </div>
        <div class="footer text-center">
            <a href="index.html" class="btn btn-primary btn-round btn-lg btn-block waves-effect waves-light">SIGN UP</a>
            <h5> Already have an account? <a href="{{ route('superadmin.login') }}">Login</a></h5>
        </div>
    </form>
    <!-- end content -->
@endsection
