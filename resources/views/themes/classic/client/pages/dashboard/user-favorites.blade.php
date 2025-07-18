@extends('themes.classic.client.pages.dashboard.user_master')

@section('title', 'Favorites | Premium Refined Luxury Homes')
@section('content')
    <div class="col-lg-9">
        <div class="dashboard-content">
            <div class="tab-listing" id="favourites">
                <div class="property-section">
                    <div class="property-grid-2 ratio_63">
                        <div class="filter-panel">
                            <div class="top-panel">
                                <div>
                                    <h2>Favourites</h2>
                                    <span class="show-result">Showing <span>1-15 of 69</span> Listings</span>
                                </div>
                                <ul class="grid-list-filter">
                                    <li>
                                        <div class="dropdown">
                                            <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>Sort by
                                                    Newest</span> <i class="fas fa-angle-down ms-lg-3 ms-2"></i></span>
                                            <div class="dropdown-menu text-start">
                                                <a class="dropdown-item" href="javascript:void(0)">Sort by Newest</a>
                                                <a class="dropdown-item" href="javascript:void(0)">Sort by Oldest</a>
                                                <a class="dropdown-item" href="javascript:void(0)">Sory by featured</a>
                                                <a class="dropdown-item" href="javascript:void(0)">Sort by price(Low to
                                                    high)</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="filter-bottom-title">
                                            <h6 class="mb-0 font-roboto">Advance search <i data-feather="align-center"
                                                    class="float-end ms-2"></i></h6>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="left-sidebar filter-bottom-content">
                            <h6 class="d-lg-none d-block text-end"><a href="javascript:void(0)"
                                    class="close-filter-bottom">Close filter</a></h6>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="dropdown">
                                        <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>Property
                                                Status</span> <i class="fas fa-angle-down"></i></span>
                                        <div class="dropdown-menu text-start">
                                            <a class="dropdown-item" href="javascript:void(0)">Property Status</a>
                                            <a class="dropdown-item" href="javascript:void(0)">For Rent</a>
                                            <a class="dropdown-item" href="javascript:void(0)">For Sale</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="dropdown">
                                        <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>Property
                                                Type</span> <i class="fas fa-angle-down"></i></span>
                                        <div class="dropdown-menu text-start">
                                            <a class="dropdown-item" href="javascript:void(0)">Property Type</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Apartment</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Family House</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Cottage</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Condominium</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="dropdown">
                                        <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>Property
                                                Location</span> <i class="fas fa-angle-down"></i></span>
                                        <div class="dropdown-menu text-start">
                                            <a class="dropdown-item" href="javascript:void(0)">Property Location</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Austria</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Brazil</a>
                                            <a class="dropdown-item" href="javascript:void(0)">New york</a>
                                            <a class="dropdown-item" href="javascript:void(0)">USA</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="dropdown">
                                        <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>Max
                                                Rooms</span> <i class="fas fa-angle-down"></i></span>
                                        <div class="dropdown-menu text-start">
                                            <a class="dropdown-item" href="javascript:void(0)">Max Rooms</a>
                                            <a class="dropdown-item" href="javascript:void(0)">1</a>
                                            <a class="dropdown-item" href="javascript:void(0)">2</a>
                                            <a class="dropdown-item" href="javascript:void(0)">3</a>
                                            <a class="dropdown-item" href="javascript:void(0)">4</a>
                                            <a class="dropdown-item" href="javascript:void(0)">5</a>
                                            <a class="dropdown-item" href="javascript:void(0)">6</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="dropdown">
                                        <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>Bed</span>
                                            <i class="fas fa-angle-down"></i></span>
                                        <div class="dropdown-menu text-start">
                                            <a class="dropdown-item" href="javascript:void(0)">Bed</a>
                                            <a class="dropdown-item" href="javascript:void(0)">1</a>
                                            <a class="dropdown-item" href="javascript:void(0)">2</a>
                                            <a class="dropdown-item" href="javascript:void(0)">3</a>
                                            <a class="dropdown-item" href="javascript:void(0)">4</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="dropdown">
                                        <span class="dropdown-toggle font-rubik"
                                            data-bs-toggle="dropdown"><span>Bath</span> <i
                                                class="fas fa-angle-down"></i></span>
                                        <div class="dropdown-menu text-start">
                                            <a class="dropdown-item" href="javascript:void(0)">Bath</a>
                                            <a class="dropdown-item" href="javascript:void(0)">1</a>
                                            <a class="dropdown-item" href="javascript:void(0)">2</a>
                                            <a class="dropdown-item" href="javascript:void(0)">3</a>
                                            <a class="dropdown-item" href="javascript:void(0)">4</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <a href="javascript:void(0)" class="mt-3 btn btn-gradient color-2 btn-pill">Search
                                        Property</a>
                                </div>
                            </div>
                        </div>
                        <div class="property-2 row column-sm zoom-gallery property-label property-grid list-view">
                            <div class="col-md-12">
                                <div class="property-box liked-img">
                                    <div class="property-image">
                                        <div class="property-slider">
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/10.jpg"
                                                    class="bg-img" alt="">
                                            </a>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/5.jpg"
                                                    class="bg-img" alt="">

                                            </a>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/3.jpg"
                                                    class="bg-img" alt="">

                                            </a>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/4.jpg"
                                                    class="bg-img" alt="">

                                            </a>
                                        </div>
                                        <div class="labels-left">
                                            <div>
                                                <span class="label label-shadow">sale</span>
                                            </div>
                                        </div>
                                        <div class="seen-data">
                                            <i data-feather="camera"></i>
                                            <span>25</span>
                                        </div>
                                        <div class="overlay-property-box">
                                            <a href="compare.html" class="effect-round" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="Compare">
                                                <i data-feather="shuffle"></i>
                                            </a>
                                            <a href="user-favourites.html" class="effect-round like"
                                                data-bs-toggle="tooltip" data-bs-placement="left" title="wishlist">
                                                <i data-feather="heart"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="property-details">
                                        <span class="font-roboto">France</span>
                                        <div class="my-listing font-roboto">Added 20 min ago</div>
                                        <a href="single-property-8.html">
                                            <h3>Merrick in Spring Way</h3>
                                        </a>
                                        <h6>$6558.00*</h6>
                                        <p class="font-roboto">Real estate is divided into several categories, including
                                            residential property, commercial property and industrial property.</p>
                                        <ul>
                                            <li><img src="https://themes.pixelstrap.com/sheltos/assets/images/svg/icon/double-bed.svg"
                                                    class="img-fluid" alt="">Bed : 4</li>
                                            <li><img src="https://themes.pixelstrap.com/sheltos/assets/images/svg/icon/bathroom.svg"
                                                    class="img-fluid" alt="">Baths : 4</li>
                                            <li><img src="https://themes.pixelstrap.com/sheltos/assets/images/svg/icon/square-ruler-tool.svg"
                                                    class="img-fluid ruler-tool" alt="">Sq Ft : 5000</li>
                                        </ul>
                                        <div class="property-btn d-flex">
                                            <span>July 18, 2022</span>
                                            <button type="button" onclick="document.location='single-property-8.html'"
                                                class="btn btn-dashed btn-pill color-2">Details</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="property-box liked-img">
                                    <div class="property-image">
                                        <div class="property-slider">
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/11.jpg"
                                                    class="bg-img" alt="">

                                            </a>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/4.jpg"
                                                    class="bg-img" alt="">

                                            </a>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/6.jpg"
                                                    class="bg-img" alt="">

                                            </a>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/2.jpg"
                                                    class="bg-img" alt="">

                                            </a>
                                        </div>
                                        <div class="labels-left">
                                            <div>
                                                <span class="label label-shadow">sale</span>
                                            </div>
                                        </div>
                                        <div class="seen-data">
                                            <i data-feather="camera"></i>
                                            <span>10</span>
                                        </div>
                                        <div class="overlay-property-box">
                                            <a href="compare.html" class="effect-round" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="Compare">
                                                <i data-feather="shuffle"></i>
                                            </a>
                                            <a href="user-favourites.html" class="effect-round like"
                                                data-bs-toggle="tooltip" data-bs-placement="left" title="wishlist">
                                                <i data-feather="heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="property-details">
                                        <span class="font-roboto">brazil</span>
                                        <div class="my-listing font-roboto">Added 45 min ago</div>
                                        <a href="single-property-8.html">
                                            <h3>Home in Merrick Way</h3>
                                        </a>
                                        <h6>$9554.00*</h6>
                                        <p class="font-roboto">Elegant retreat in a quiet Coral Gables setting. This home
                                            provides wonderful entertaining spaces with a chef
                                            kitchen opening…</p>
                                        <ul>
                                            <li><img src="https://themes.pixelstrap.com/sheltos/assets/images/svg/icon/double-bed.svg"
                                                    class="img-fluid" alt="">Bed : 4</li>
                                            <li><img src="https://themes.pixelstrap.com/sheltos/assets/images/svg/icon/bathroom.svg"
                                                    class="img-fluid" alt="">Baths : 4</li>
                                            <li><img src="https://themes.pixelstrap.com/sheltos/assets/images/svg/icon/square-ruler-tool.svg"
                                                    class="img-fluid ruler-tool" alt="">Sq Ft : 5000</li>
                                        </ul>
                                        <div class="property-btn d-flex">
                                            <span>June 20, 2022</span>
                                            <button type="button" onclick="document.location='single-property-8.html'"
                                                class="btn btn-dashed btn-pill color-2">Details</button>
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
@endsection
