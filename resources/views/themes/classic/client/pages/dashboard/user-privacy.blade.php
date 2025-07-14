@extends('themes.classic.client.pages.dashboard.user_master')

@section('title', 'Dashboard | Premium Refined Luxury Homes')
@section('content')

    <!-- page content -->
    <div class="col-lg-9">
        <div class="dashboard-content">
            <div class="privacy-setting" id="privacy">
                <div class="common-card">
                    <div class="common-header">
                        <h5>Privacy</h5>
                        <p class="font-roboto">Define your privacy settings</p>
                    </div>
                    <div class="privacy-content">
                        <div class="media">
                            <div class="media-body">
                                <h6 class="font-roboto">Allows others to see my profile</h6>
                                <p class="font-roboto">all peoples will be able to see my profile</p>
                            </div>
                            <label class="switch">
                                <input type="radio" name="radio1" value="option1" checked=""><span
                                    class="switch-state"></span>
                            </label>
                        </div>
                        <div class="media">
                            <div class="media-body">
                                <h6 class="font-roboto">who has save this profile only that people see my profile</h6>
                                <p class="font-roboto">all peoples will not be able to see my profile</p>
                            </div>
                            <label class="switch">
                                <input type="radio" name="radio1" value="option1"><span class="switch-state"></span>
                            </label>
                        </div>
                        <button type="button" class="btn btn-gradient color-2 btn-pill">Save changes</button>
                    </div>
                    <div class="privacy-content">
                        <h5>Account settings</h5>
                        <div class="media">
                            <div class="media-body">
                                <h6 class="font-roboto">Deleting Your Account Will Permanently</h6>
                                <p class="font-roboto">Once your account is deleted, you will be logged out and will be
                                    unable to log in back.</p>
                            </div>
                            <label class="switch">
                                <input type="radio" name="radio2" value="option2" checked=""><span
                                    class="switch-state"></span>
                            </label>
                        </div>
                        <div class="media">
                            <div class="media-body">
                                <h6 class="font-roboto">Deleting Your Account Will Temporary</h6>
                                <p class="font-roboto">Once your account is deleted, you will be logged out and you will be
                                    create new account </p>
                            </div>
                            <label class="switch">
                                <input type="radio" name="radio2" value="option2"><span class="switch-state"></span>
                            </label>
                        </div>
                        <button type="button" class="btn btn-gradient color-2 btn-pill">Delete my account</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- emd of page content -->
@endsection
