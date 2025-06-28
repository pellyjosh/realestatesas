@extends('admin.admin_master')
@section('title', 'Land Type | Premium Refined Luxury Homes')
@section('content')
 <!-- Container-fluid start -->
 <div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-header-left">
                    <h3>Family house
                        <small>Welcome to admin panel</small>
                    </h3>
                </div>
            </div>
            <div class="col-sm-6">

                <!-- Breadcrumb start -->
                <ol class="breadcrumb pull-right">
                    <li class="breadcrumb-item">
                        <a href="index.html">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Types</li>
                </ol>
                <!-- Breadcrumb end -->
                
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid end -->

<!-- Container-fluid start -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="property-admin">
                <div class="property-section section-sm">
                    <div class="row ratio_55 property-grid-2 property-map map-with-back">
                        <div class="col-xl-12">
                            <div class="property-2 row column-sm zoom-gallery property-label property-grid mt-0">
                                <div class="col-xl-4 col-md-6 xl-6">
                                    <div class="property-box">
                                        <div class="property-image">
                                            <div class="property-slider">
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset("client/assets/images/property/1.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset("client/assets/images/property/2.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset("client/assets/images/property/3.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset("client/assets/images/property/22.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                            </div>
                                            <div class="labels-left">
                                                <div>
                                                    <span class="label label-shadow">sale</span>
                                                </div>
                                            </div>
                                            <div class="seen-data">
                                                <i data-feather="camera"></i>
                                                <span>04</span>
                                            </div>                 
                                            <div class="overlay-property-box">
                                                <a href="{{ url("/compare")}}" class="effect-round" data-bs-toggle="tooltip" data-bs-placement="left" title="Compare"> 
                                                    <i data-feather="shuffle"></i>
                                                </a>
                                                <a href="favourites.html" class="effect-round like" data-bs-toggle="tooltip" data-bs-placement="left" title="wishlist">
                                                    <i data-feather="heart"></i>                                                                               
                                                </a>
                                            </div>
                                        </div>
        
                                        <div class="property-details">
                                            <span class="font-roboto">France</span>
                                            <a href=" ">
                                                <h3>Little Acorn Farm</h3>
                                            </a>
                                            <h6>$6558.00*</h6>
                                            <p class="font-roboto light-font">The most common and most absolute type of estate, the tenant enjoys the greatest discretion over the disposal of the property.</p>
                                            <ul>
                                                <li><i class="fas fa-mountain"></i> Land : 3</li>
                                                <li><i class="fas fa-building"></i> Properties : 2</li>
                                                <li><img src="{{ asset('client/assets/images/svg/icon/square-ruler-tool.svg') }}"
                                                        class="img-fluid ruler-tool" alt="">Sq Ft : 1000
                                                </li>
                                            <div class="property-btn d-flex">
                                                <span>August 4, 2022</span>
                                                <button type="button"    class="btn btn-dashed btn-pill color-2">Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 xl-6">
                                    <div class="property-box">
                                        <div class="property-image">
                                            <div class="property-slider">
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset("client/assets/images/property/3.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset("client/assets/images/property/1.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset("client/assets/images/property/22.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset("client/assets/images/property/2.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                            </div>
                                            <div class="labels-left">
                                                <div>
                                                    <span class="label label-dark">for rent</span>
                                                </div>
                                                <span class="label label-success">featured</span>
                                            </div>
                                            <div class="seen-data">
                                                <i data-feather="camera"></i>
                                                <span>02</span>
                                            </div>                 
                                            <div class="overlay-property-box">
                                                <a href="{{ url("/compare")}}" class="effect-round" data-bs-toggle="tooltip" data-bs-placement="left" title="Compare"> 
                                                    <i data-feather="shuffle"></i>
                                                </a>
                                                <a href="favourites.html" class="effect-round like" data-bs-toggle="tooltip" data-bs-placement="left" title="wishlist">
                                                    <i data-feather="heart"></i>                                                                               
                                                </a>
                                            </div>
                                        </div>
        
                                        <div class="property-details">
                                            <span class="font-roboto">France</span>
                                            <a href=" ">
                                                <h3>Merrick in Spring Way</h3>
                                            </a>
                                            <h6>$6558.00*</h6>
                                            <p class="font-roboto light-font">An interior designer is someone who plans,researches, management and manages such enhancement projects.</p>
                                            <ul>
                                                <li><i class="fas fa-mountain"></i> Land : 3</li>
                                                <li><i class="fas fa-building"></i> Properties : 2</li>
                                                <li><img src="{{ asset('client/assets/images/svg/icon/square-ruler-tool.svg') }}"
                                                        class="img-fluid ruler-tool" alt="">Sq Ft : 1000
                                                </li>
                                            </ul>
                                            <div class="property-btn d-flex">
                                                <span>December 1, 2022</span>
                                                <button type="button"    class="btn btn-dashed btn-pill color-2">Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 xl-6">
                                    <div class="property-box">
                                        <div class="property-image">
                                            <div class="property-slider">
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset("client/assets/images/property/2.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset("client/assets/images/property/22.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset("client/assets/images/property/3.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset("client/assets/images/property/1.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                            </div>
                                            <div class="labels-left">
                                                <div>
                                                    <span class="label label-shadow">sale</span>
                                                </div>
                                            </div>
                                            <div class="seen-data">
                                                <i data-feather="camera"></i>
                                                <span>06</span>
                                            </div>                 
                                            <div class="overlay-property-box">
                                                <a href="{{ url("/compare")}}" class="effect-round" data-bs-toggle="tooltip" data-bs-placement="left" title="Compare"> 
                                                    <i data-feather="shuffle"></i>
                                                </a>
                                                <a href="favourites.html" class="effect-round like" data-bs-toggle="tooltip" data-bs-placement="left" title="wishlist">
                                                    <i data-feather="heart"></i>                                                                               
                                                </a>
                                            </div>
                                        </div>
        
                                        <div class="property-details">
                                            <span class="font-roboto">France</span>
                                            <a href=" ">
                                                <h3>Allen's Across Way</h3>
                                            </a>
                                            <h6>$6558.00*</h6>
                                            <p class="font-roboto light-font">Real estate is divided into several categories, including residential property, commercial property and industrial property.</p>
                                            <ul>
                                                <li><i class="fas fa-mountain"></i> Land : 3</li>
                                                <li><i class="fas fa-building"></i> Properties : 2</li>
                                                <li><img src="{{ asset('client/assets/images/svg/icon/square-ruler-tool.svg') }}"
                                                        class="img-fluid ruler-tool" alt="">Sq Ft : 1000
                                                </li>
                                            </ul>
                                            <div class="property-btn d-flex">
                                                <span>May 4, 2022</span>
                                                <button type="button" class="btn btn-dashed btn-pill color-2">Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 xl-6">
                                    <div class="property-box">
                                        <div class="property-image">
                                            <div class="property-slider">
                                                <a href="javascript:void(0)">
                                                    <img src=" {{ asset("client/assets/images/property/7.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src=" {{ asset("client/assets/images/property/6.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset("client/assets/images/property/3.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset("client/assets/images/property/2.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                            </div>
                                            <div class="labels-left">
                                                <div>
                                                    <span class="label label-dark">for rent</span>
                                                </div>
                                                <span class="label label-success">featured</span>
                                            </div>
                                            <div class="seen-data">
                                                <i data-feather="camera"></i>
                                                <span>08</span>
                                            </div>                 
                                            <div class="overlay-property-box">
                                                <a href="{{ url("/compare")}}" class="effect-round" data-bs-toggle="tooltip" data-bs-placement="left" title="Compare"> 
                                                    <i data-feather="shuffle"></i>
                                                </a>
                                                <a href="favourites.html" class="effect-round like" data-bs-toggle="tooltip" data-bs-placement="left" title="wishlist">
                                                    <i data-feather="heart"></i>                                                                               
                                                </a>
                                            </div>
                                        </div>
        
                                        <div class="property-details">
                                            <span class="font-roboto">France</span>
                                            <a href=" ">
                                                <h3>Hidden Spring Hideway</h3>
                                            </a>
                                            <h6>$6558.00*</h6>
                                            <p class="font-roboto light-font">Real estate market in most countries are not as organize or efficient as markets for other, more liquid investment instruments.</p>
                                            <ul>
                                                <li><i class="fas fa-mountain"></i> Land : 3</li>
                                                <li><i class="fas fa-building"></i> Properties : 2</li>
                                                <li><img src="{{ asset('client/assets/images/svg/icon/square-ruler-tool.svg') }}"
                                                        class="img-fluid ruler-tool" alt="">Sq Ft : 1000
                                                </li>
                                            <div class="property-btn d-flex">
                                                <span>September 9, 2022</span>
                                                <button type="button"    class="btn btn-dashed btn-pill color-2">Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 xl-6">
                                    <div class="property-box">
                                        <div class="property-image">
                                            <div class="property-slider">
                                                <a href="javascript:void(0)">
                                                    <img src=" {{ asset("client/assets/images/property/6.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset("client/assets/images/property/2.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src=" {{ asset("client/assets/images/property/7.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset("client/assets/images/property/1.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                            </div>
                                            <div class="labels-left">
                                                <div>
                                                    <span class="label label-dark">for sale</span>
                                                </div>
                                                <span class="label label-shadow">featured</span>
                                            </div>
                                            <div class="seen-data">
                                                <i data-feather="camera"></i>
                                                <span>10</span>
                                            </div>                 
                                            <div class="overlay-property-box">
                                                <a href="{{ url("/compare")}}" class="effect-round" data-bs-toggle="tooltip" data-bs-placement="left" title="Compare"> 
                                                    <i data-feather="shuffle"></i>
                                                </a>
                                                <a href="favourites.html" class="effect-round like" data-bs-toggle="tooltip" data-bs-placement="left" title="wishlist">
                                                    <i data-feather="heart"></i>                                                                               
                                                </a>
                                            </div>
                                        </div>
        
                                        <div class="property-details">
                                            <span class="font-roboto">France</span>
                                            <a href=" ">
                                                <h3>Home in Merrick Way</h3>
                                            </a>
                                            <h6>$6558.00*</h6>
                                            <p class="font-roboto light-font">Elegant retreat in a quiet Coral Gables setting. This home provides wonderful entertaining spaces with a chef
                                                kitchen opening…</p>
                                            <ul>
                                                <li><i class="fas fa-mountain"></i> Land : 3</li>
                                                <li><i class="fas fa-building"></i> Properties : 2</li>
                                                <li><img src="{{ asset('client/assets/images/svg/icon/square-ruler-tool.svg') }}"
                                                        class="img-fluid ruler-tool" alt="">Sq Ft : 1000
                                                </li>
                                            <div class="property-btn d-flex">
                                                <span>June 15, 2022</span>
                                                <button type="button"    class="btn btn-dashed btn-pill color-2">Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 xl-6">
                                    <div class="property-box">
                                        <div class="property-image">
                                            <div class="property-slider">
                                                <a href="javascript:void(0)">
                                                    <img src=" {{ asset("client/assets/images/property/8.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src=" {{ asset("client/assets/images/property/6.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src=" {{ asset("client/assets/images/property/7.jpg") }}" class="bg-img" alt="">
                                                    
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset("client/assets/images/property/2.jpg") }}" class="bg-img" alt="">
                                                </a>
                                            </div>
                                            <div class="labels-left">
                                                <div>
                                                    <span class="label label-dark">for rent</span>
                                                </div>
                                                <span class="label label-success">featured</span>
                                            </div>
                                            <div class="seen-data">
                                                <i data-feather="camera"></i>
                                                <span>12</span>
                                            </div>                 
                                            <div class="overlay-property-box">
                                                <a href="{{ url("/compare")}}" class="effect-round" data-bs-toggle="tooltip" data-bs-placement="left" title="Compare"> 
                                                    <i data-feather="shuffle"></i>
                                                </a>
                                                <a href="favourites.html" class="effect-round like" data-bs-toggle="tooltip" data-bs-placement="left" title="wishlist">
                                                    <i data-feather="heart"></i>                                                                               
                                                </a>
                                            </div>
                                        </div>
        
                                        <div class="property-details">
                                            <span class="font-roboto">France</span>
                                            <a href=" ">
                                                <h3>Magnolia Ranch</h3>
                                            </a>
                                            <h6>$6558.00*</h6>
                                            <p class="font-roboto light-font">This home provides wonderful entertaining spaces with a chef
                                                kitchen opening… Elegant retreat in a quiet Coral Gables setting.</p>
                                                <ul>
                                                    <li><i class="fas fa-mountain"></i> Land : 3</li>
                                                    <li><i class="fas fa-building"></i> Properties : 2</li>
                                                    <li><img src="{{ asset('client/assets/images/svg/icon/square-ruler-tool.svg') }}"
                                                            class="img-fluid ruler-tool" alt="">Sq Ft : 1000
                                                    </li>
                                                </ul>
                                            <div class="property-btn d-flex">
                                                <span>July 23, 2022</span>
                                                <button type="button"    class="btn btn-dashed btn-pill color-2">Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <nav class="theme-pagination">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                                            <span aria-hidden="true">«</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="javascript:void(0)">1</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0)" aria-label="Next">
                                            <span aria-hidden="true">»</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid end -->
@endsection