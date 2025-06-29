@extends('realtor.pages.authentication.authentication_master')
@section('title', 'Signup | Premium Refined Luxury Homes')
@section('content')
<div class="card-body">
    <div class="title-3 text-start">
        <h2>Sign up</h2>
    </div>
    <form>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i data-feather="user"></i>
                    </div>
                </div>
                <input type="text" class="form-control" placeholder="Enter your name">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i data-feather="mail"></i>
                    </div>
                </div>
                <input type="text" class="form-control" placeholder="Enter email address">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i data-feather="lock"></i>
                    </div>
                </div>
                <input type="password" id="pwd-input" class="form-control"  maxlength="8" placeholder="Password">
                <div class="input-group-apend">
                    <div class="input-group-text">
                        <i id="pwd-icon" class="far fa-eye-slash"></i>
                    </div>
                </div>
            </div>
            <div class="important-note">
                password should be a minimum of 8 characters and should contains letters and numbers
            </div>
        </div>
        <div>
            <button type="button" class="btn btn-gradient btn-pill color-2 me-sm-3 me-2">Create Account</button>
            <a href="login.html" class="btn btn-dashed btn-pill color-2">Log in</a>
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