@extends('superadmin.auth.auth_master')
@section('title', 'Login')
@section('content')
    <!-- content  -->
    <form class="form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="header">
            <div class="logo-container">
                <img src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/logo.svg" alt="">
            </div>
            <h5>Log in</h5>
        </div>
        <div class="content">
            <div class="input-group">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       placeholder="Enter Email" value="{{ old('email') }}" required>
                <span class="input-group-addon">
                    <i class="zmdi zmdi-email"></i>
                </span>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" 
                       class="form-control @error('password') is-invalid @enderror" required />
                <span class="input-group-addon">
                    <i class="zmdi zmdi-lock"></i>
                </span>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="checkbox">
                <input id="remember" name="remember" type="checkbox">
                <label for="remember">Remember Me</label>
            </div>
        </div>
        <div class="footer text-center">
            <button type="submit" class="btn btn-primary btn-round btn-lg btn-block waves-effect waves-light">
                SIGN IN
            </button>
            <h5><a href="{{ route('password.request') }}" class="link">Forgot Password?</a></h5>
        </div>
        <div class="footer text-center">
            <h5> Don’t have an account? <a href="{{ route('register') }}">Sign Up</a></h5>
        </div>
    </form>
    <!-- end content -->
@endsection
