@extends('superadmin.auth.auth_master')
@section('title', 'Forgot Password')
@section('content')
    <form class="form" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="header">
            <div class="logo-container">
                <img src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/logo.svg" alt="">
            </div>
            <h5>Forgot Password?</h5>
            <span>Enter your e-mail address below to reset your password.</span>
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
        </div>
        <div class="footer text-center">
            <button type="submit" class="btn btn-primary btn-round btn-lg btn-block waves-effect waves-light">
                SEND RESET LINK
            </button>
            <h5><a href="{{ route('login') }}">Back to Login</a></h5>
        </div>
    </form>
@endsection
