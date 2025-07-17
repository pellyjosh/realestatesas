@extends('superadmin.auth.auth_master')
@section('title', 'Register')
@section('content')
    <!-- content  -->
    <form class="form" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="header">
            <div class="logo-container">
                <img src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/logo.svg" alt="">
            </div>
            <h5>Sign Up</h5>
            <span>Register a new membership</span>
        </div>
        <div class="content">
            <div class="input-group">
                <input type="text" name="name"
                    class="form-control 
                @error('name') is-invalid @enderror" placeholder="Enter Name"
                    value="{{ old('name') }}" required>
                <span class="input-group-addon">
                    <i class="zmdi zmdi-account-circle"></i>
                </span>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
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
                    class="form-control @error('password') is-invalid @enderror"  />
                <span class="input-group-addon">
                    <i class="zmdi zmdi-lock"></i>
                </span>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group">
                <input type="password" name="password_confirmation" placeholder="Confirm Password"
                    class="form-control @error('password_confirmation') is-invalid @enderror"  />
                <span class="input-group-addon">
                    <i class="zmdi zmdi-lock"></i>
                </span>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="checkbox">
            <input id="terms" name="terms" type="checkbox" required>
            <label for="terms">
                I read and agree to the <a href="javascript:void(0);">terms of usage</a>
            </label>
            @error('terms')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="footer text-center">
            <button type="submit" class="btn btn-primary btn-round btn-lg btn-block waves-effect waves-light">
                SIGN UP
            </button>
            <h5> Already have an account? <a href="{{ route('login') }}">Login</a></h5>
        </div>
    </form>
    <!-- end content -->
@endsection
