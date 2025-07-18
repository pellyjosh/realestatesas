@extends('themes.classic.client.pages.dashboard.user_master')

@section('title', 'Profile | Premium Refined Luxury Homes')
@section('content')
    <div class="col-lg-9">
        <div class="dashboard-content">
            <div class="my-profile" id="profile">
                <div class="profile-info">
                    <div class="common-card">
                        <div class="user-name media">
                            <div class="media-body">
                                <h5>Zack Lee <span class="label label-success">Real estate agent</span></h5>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <span data-bs-toggle="modal" data-bs-target="#edit-profile"
                                class="label label-light label-flat color-4">
                                <i class="fas fa-edit"></i>
                            </span>
                        </div>
                        <ul class="user-detail">
                            <li>
                                <i data-feather="map-pin"></i>
                                <span>Downers Grove, IL</span>
                            </li>
                            <li>
                                <i data-feather="mail"></i>
                                <span>zackle@gmail.com</span>
                            </li>
                            <li>
                                <i data-feather="check-square"></i>
                                <span>Licensed for 2 years</span>
                            </li>
                        </ul>
                        <p class="font-roboto">Residences can be classified by and how they are connected to neighbouring
                            residences and land.
                            Different types of housing tenure can be used for the same physical type.</p>
                    </div>
                    <div class="common-card">
                        <div class="row">
                            <div class="col-xxl-6 col-xl-7">
                                <div class="information-detail">
                                    <div class="common-header">
                                        <h5>About</h5>
                                    </div>
                                    <div class="information">
                                        <ul>
                                            <li>
                                                <span>Gender :</span>
                                                <p>Female</p>
                                            </li>
                                            <li>
                                                <span>Birthday :</span>
                                                <p>20/11/1995</p>
                                            </li>
                                            <li>
                                                <span>Phone number :</span>
                                                <a href="javascript:void(0)">
                                                    +91 846 - 547 - 210
                                                </a>
                                            </li>
                                            <li>
                                                <span>Address :</span>
                                                <p>549 Sulphur Springs Road, Downers, IL</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="information-detail">
                                    <div class="common-header">
                                        <h5>Login Details</h5>
                                    </div>
                                    <div class="information">
                                        <ul>
                                            <li>
                                                <span>Email :</span>
                                                <a href="javascript:void(0)">zackle@gmail.com</a>
                                                <span data-bs-toggle="modal" data-bs-target="#edit-profile"
                                                    class="label label-light label-flat color-4">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                            </li>
                                            <li>
                                                <span>Password :</span>
                                                <a href="javascript:void(0)">&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;</a>
                                                <span data-bs-toggle="modal" data-bs-target="#edit-password"
                                                    class="label label-light label-flat color-4">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-5 offset-xxl-1 col-xl-5 offset-xl-0">
                                <div class="about-img d-xl-block d-none">
                                    <img src="https://themes.pixelstrap.com/sheltos/assets/images/inner-pages/2.png"
                                        class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
