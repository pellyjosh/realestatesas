@extends('superadmin.auth.authentication_master')
@section('title', 'Register | Premium Refined Luxury Homes')
@section('content')
    <div class="card-body" style="max-width: 700px; margin: 0 auto; padding: 20px;">
        <div class="title-3 text-center mb-4">
            <h1>Sign up</h1>
        </div>
        <form method="POST" action="{{ route('tenant.register') }}" autocomplete="off" style="width: 100%;">
            @csrf
            <div class="form-group text-center mb-4">
                <div class="profile-image-upload"
                    style="display: inline-block; position: relative; width: 100px; height: 100px; border-radius: 50%; border: 3px solid #78c705; overflow: hidden; margin-bottom: 10px;">
                    <input type="file" class="form-control" name="profile_image" accept="image/*" capture="user"
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                    <div class="image-placeholder"
                        style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #f8f8f8;">
                        <i data-feather="image" style="font-size: 35px; color: #78c705;"></i>
                    </div>
                </div>
                <div class="important-note" style="font-size: 0.85em; color: #666;">
                    Upload a profile picture or take a photo using your device's camera.
                </div>
                @error('profile_image')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i data-feather="user"></i>
                        </div>
                    </div>
                    <input type="text" class="form-control" name="name" placeholder="Enter your name"
                        value="{{ old('name') }}" required>
                </div>
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i data-feather="mail"></i>
                        </div>
                    </div>
                    <input type="email" class="form-control" name="email" placeholder="Enter email address"
                        value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i data-feather="lock"></i>
                        </div>
                    </div>
                    <input type="password" id="pwd-input" name="password" class="form-control" maxlength="8"
                        placeholder="Password" required>
                    <div class="input-group-apend">
                        <div class="input-group-text">
                            <i id="pwd-icon" class="far fa-eye-slash"></i>
                        </div>
                    </div>
                </div>
                <div class="important-note" style="font-size: 0.85em; color: #666;">
                    Password should be a minimum of 8 characters and should contain letters and numbers.
                </div>
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i data-feather="lock"></i>
                        </div>
                    </div>
                    <input type="password" id="confirm-pwd-input" name="password_confirmation" class="form-control"
                        maxlength="8" placeholder="Confirm Password" required>
                    <div class="input-group-apend">
                        <div class="input-group-text">
                            <i id="confirm-pwd-icon" class="far fa-eye-slash"></i>
                        </div>
                    </div>
                </div>
                @error('password_confirmation')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label class="d-block mb-0 text-center" for="terms" style="font-size: 0.9em;">
                    <input class="checkbox_animated color-2" id="terms" type="checkbox" name="terms" required> I
                    accept the Terms and Conditions
                </label>
                @error('terms')
                    <div class="text-danger mt-1 text-center">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center mt-3 mb-3">
                <button type="submit" class="btn btn-pill mb-3"
                    style="background-color: #78c705; color: #fff; width: 180px; font-size: 0.9em;">Create Account</button>
                <a href="{{ route('tenant.login') }}" class="btn btn-dashed btn-pill color-2"
                    style="width: 180px; font-size: 0.9em;">Log in</a>
            </div>
            <div class="divider text-center mt-3">
                <h6 style="font-size: 0.9em;">or</h6>
            </div>
            <div class="text-center mt-2">
                <h6 style="font-size: 0.9em;">Sign up with</h6>
                <div class="row social-connect justify-content-center">
                    <div class="col-6 col-md-5">
                        <a href="https://www.facebook.com/" class="btn btn-social btn-flat facebook p-0 mx-1"
                            style="font-size: 0.85em;">
                            <i class="fab fa-facebook-f"></i>
                            <span>Facebook</span>
                        </a>
                    </div>
                    <div class="col-6 col-md-5">
                        <a href="https://accounts.google.com/" class="btn btn-social btn-flat google p-0 mx-1"
                            style="font-size: 0.85em;">
                            <i class="fab fa-google"></i>
                            <span>Google</span>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
