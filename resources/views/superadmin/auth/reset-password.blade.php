@extends('superadmin.auth.auth_master')
@section('title', 'Login')
@section('content')
    <!-- content  -->
    <form class="form" method="POST" action="#">
    <div class="header">
        <div class="logo-container">
            <img src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/logo.svg" alt="">
        </div>
        <h5>Reset Password</h5>
    </div>
    <div class="content">
        <div class="input-group">
            <input type="password" class="form-control" placeholder="Enter New Password" required>
            <span class="input-group-addon">
                <i class="zmdi zmdi-lock"></i>
            </span>
        </div>
        <div class="input-group">
            <input type="password" class="form-control" placeholder="Confirm Password" required>
            <span class="input-group-addon">
                <i class="zmdi zmdi-lock-outline"></i>
            </span>
        </div>
    </div>
    <div class="footer text-center">
        <button type="submit" class="btn btn-primary btn-round btn-lg btn-block">RESET PASSWORD</button>
    </div>    
</form>
    <!-- end content -->
@endsection
