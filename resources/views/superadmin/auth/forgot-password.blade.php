@extends('superadmin.auth.auth_master')
@section('title', 'Forgot Password')
@section('content')
    <form class="form" method="" action="#">
        <div class="header">
            <div class="logo-container">
                <img src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/logo.svg" alt="">
            </div>
            <h5>Forgot Password?</h5>
            <span>Enter your e-mail address below to reset your password.</span>
        </div>
        <div class="content">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter Email">
                <span class="input-group-addon">
                    <i class="zmdi zmdi-email"></i>
                </span>
            </div>
        </div>
        <div class="footer text-center">
            <a href="index.html" class="btn btn-primary btn-round btn-lg btn-block waves-effect waves-light">SUBMIT</a>
            <h5><a href="{{ route('superadmin.login') }}">Login</a></h5>
        </div>
    </div>
    </form>
@endsection
