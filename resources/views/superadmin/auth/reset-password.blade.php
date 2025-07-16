@extends('superadmin.auth.auth_master')
@section('title', 'Reset Password')
@section('content')
    <!-- content  -->
    <form class="form" method="POST" action="{{ route('password.store') }}">
        @csrf
        {{-- <input type="hidden" name="token" value="{{ $token }}"> --}}
        <div class="header">
            <div class="logo-container">
                <img src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/logo.svg" alt="">
            </div>
            <h5>Reset Password</h5>
        </div>
        <div class="content">
            <div class="input-group">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       placeholder="Enter Email" value="{{ old('email', $email ?? '') }}" required readonly>
                <span class="input-group-addon">
                    <i class="zmdi zmdi-email"></i>
                </span>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                       placeholder="Enter New Password" required minlength="8">
                <span class="input-group-addon">
                    <i class="zmdi zmdi-lock"></i>
                </span>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group">
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" 
                       placeholder="Confirm Password" required minlength="8">
                <span class="input-group-addon">
                    <i class="zmdi zmdi-lock-outline"></i>
                </span>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="footer text-center">
            <button type="submit" class="btn btn-primary btn-round btn-lg btn-block waves-effect waves-light">
                RESET PASSWORD
            </button>
            <h5><a href="{{ route('login') }}">Back to Login</a></h5>
        </div>    
    </form>
    <!-- end content -->
@endsection
