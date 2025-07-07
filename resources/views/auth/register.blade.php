@extends('auth.authentication_master')
@section('title', 'Register | Premium Refined Luxury Homes')
@section('content')
    <div class="card-body">
        <div class="title-3 text-start">
            <h2>Sign up</h2>
        </div>
        <form method="POST" action="{{ route('register') }}" autocomplete="off">
            @csrf
            <div class="form-group">
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
            <div class="form-group">
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
            <div class="form-group">
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
                <div class="important-note">
                    password should be a minimum of 8 characters and should contains letters and numbers
                </div>
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
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
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i data-feather="image"></i>
                        </div>
                    </div>
                    <input type="file" class="form-control" name="profile_image" accept="image/*" capture="user">
                </div>
                <div class="important-note">
                    Upload a profile picture or take a photo using your device's camera.
                </div>
                @error('profile_image')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="d-block mb-0" for="terms">
                    <input class="checkbox_animated color-2" id="terms" type="checkbox" name="terms" required> I
                    accept the Terms and Conditions
                </label>
                @error('terms')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-pill me-sm-3 me-2"
                    style="background-color: #78c705; color: #fff;">Create Account</button>
                <a href="{{ route('login') }}" class="btn btn-dashed btn-pill color-2">Log in</a>
            </div>
            <div class="divider">
                <h6>or</h6>
            </div>
            <div>
                <h6>Sign up with</h6>
                <div class="row social-connect">
                    <div class="col-6">
                        <a href="https://www.facebook.com/" class="btn btn-social btn-flat facebook p-0">
                            <i class="fab fa-facebook-f"></i>
                            <span>Facebook</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="https://twitter.com/" class="btn btn-social btn-flat twitter p-0">
                            <i class="fab fa-twitter"></i>
                            <span>Twitter</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="https://accounts.google.com/" class="btn btn-social btn-flat google p-0">
                            <i class="fab fa-google"></i>
                            <span>Google</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="https://www.linkedin.com/" class="btn btn-social btn-flat linkedin p-0">
                            <i class="fab fa-linkedin-in"></i>
                            <span>Linkedin</span>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
