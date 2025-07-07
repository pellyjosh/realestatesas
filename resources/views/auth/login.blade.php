@extends('admin.pages.authentication.authentication_master')
@section('title', 'Login | Premium Refined Luxury Homes')
@section('content')
<div class="card-body">
    <div class="title-3 text-start">
        <h2>Log in</h2>
    </div>
    <form method="POST" action="{{ route('login') }}" autocomplete="off" >
        @csrf
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i data-feather="user"></i>
                    </div>
                </div>
                <input type="text" class="form-control" name="email" placeholder="Enter Email" autocomplete="off" value="{{ old('email') }}">
            </div>
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i data-feather="mail"></i>
                    </div>
                </div>
                <input type="password" id="pwd-input" name="password" class="form-control" placeholder="Password" autocomplete="off" maxlength="8">
                <div class="input-group-apend">
                    <div class="input-group-text">
                        <i id="pwd-icon" class="far fa-eye-slash"></i>
                    </div>
                </div>
            </div>
            <div class="important-note">
                password should be a minimum of 8 characters and should contains letters and numbers
            </div>
            @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-flex">
            <label class="d-block mb-0" for="chk-ani">
                <input class="checkbox_animated color-2" id="chk-ani" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
            </label>
            <a href="{{ route('password.request') }}" class="font-rubik text-color-2">Forgot password?</a>
        </div>
        <div>
            <button type="submit" class="btn btn-pill me-sm-3 me-2" style="background-color: #78c705; color: #fff;">Log in</button>
            <a href="{{ route('register') }}" class="btn btn-dashed btn-pill color-2">Create Account</a>
        </div>
        <div class="divider">
            <h6>or</h6>
        </div>
        <div>
            <h6>Log in with</h6>
            <div class="row social-connect">
                <div class="col-6">
                    <a href="https://www.facebook.com/" class="btn btn-social btn-flat facebook p-0">
                        <i class="fab fa-facebook-f"></i>
                        <span>Facebook</span>
                    </a>
                </div>
                <div class="col-6">
                    <a href="https://accounts.google.com/" class="btn btn-social btn-flat google p-0">
                        <i class="fab fa-google"></i>
                        <span>Google</span>
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
