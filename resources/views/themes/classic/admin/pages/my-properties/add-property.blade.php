@extends('themes.classic.admin.admin_master')
@section('title', 'Add Property | Premium Refined Luxury Homes')
@section('content')
        <!-- Container-fluid start -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-left">
                        <h3>Add property
                            <small>Welcome to admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-6">

                    <!-- Breadcrumb start -->
                   
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
                <div class="card"> 
                    <div class="card-header pb-0">
                        <h5>Add property details</h5>
                    </div>
                    <div class="card-body admin-form">
                        <form class="row gx-3">
                            <div class="form-group col-sm-4">
                                <label>Property Type</label>
                                <input type="text" class="form-control" placeholder="office,villa,apartment" required="">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Property Status</label>
                                <div class="dropdown">
                                    <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>For Sale</span> <i class="fas fa-angle-down"></i></span>
                                    <div class="dropdown-menu text-start">
                                        <a class="dropdown-item" href="javascript:void(0)">For Rent</a>
                                        <a class="dropdown-item" href="javascript:void(0)">For Sale</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Property Price</label>
                                <input type="text" class="form-control" placeholder="$2800" required="">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Max Rooms</label>
                                <div class="dropdown">
                                    <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>1</span> <i class="fas fa-angle-down"></i></span>
                                    <div class="dropdown-menu text-start">
                                        <a class="dropdown-item" href="javascript:void(0)">2</a>
                                        <a class="dropdown-item" href="javascript:void(0)">3</a>
                                        <a class="dropdown-item" href="javascript:void(0)">4</a>
                                        <a class="dropdown-item" href="javascript:void(0)">5</a>
                                        <a class="dropdown-item" href="javascript:void(0)">6</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Beds</label>
                                <div class="dropdown">
                                    <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>1</span> <i class="fas fa-angle-down"></i></span>
                                    <div class="dropdown-menu text-start">
                                        <a class="dropdown-item" href="javascript:void(0)">2</a>
                                        <a class="dropdown-item" href="javascript:void(0)">3</a>
                                        <a class="dropdown-item" href="javascript:void(0)">4</a>
                                        <a class="dropdown-item" href="javascript:void(0)">5</a>
                                        <a class="dropdown-item" href="javascript:void(0)">6</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Baths</label>
                                <div class="dropdown">
                                    <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>1</span> <i class="fas fa-angle-down"></i></span>
                                    <div class="dropdown-menu text-start">
                                        <a class="dropdown-item" href="javascript:void(0)">2</a>
                                        <a class="dropdown-item" href="javascript:void(0)">3</a>
                                        <a class="dropdown-item" href="javascript:void(0)">4</a>
                                        <a class="dropdown-item" href="javascript:void(0)">5</a>
                                        <a class="dropdown-item" href="javascript:void(0)">6</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Area</label>
                                <input type="text" class="form-control" placeholder="85 sq ft">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Price</label>
                                <input type="text" class="form-control" placeholder="$3000">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Agencies</label>
                                <div class="dropdown">
                                    <span class="dropdown-toggle font-rubik"
                                        data-bs-toggle="dropdown"><span>Premiere</span> <i
                                            class="fas fa-angle-down"></i></span>
                                    <div class="dropdown-menu text-start">
                                        <a class="dropdown-item" href="javascript:void(0)">Blue Sky</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Zephyr</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Premiere</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Description</label>
                                <textarea class="form-control" rows="4"></textarea>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Address</label>
                                <input type="text" class="form-control" placeholder="Address of your property">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Zip code</label>
                                <input type="text" class="form-control" placeholder="39702">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Any Country</label>
                                <div class="dropdown">
                                    <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>Austria</span> <i class="fas fa-angle-down"></i></span>
                                    <div class="dropdown-menu text-start">
                                        <a class="dropdown-item" href="javascript:void(0)">Austria</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Brazil</a>
                                        <a class="dropdown-item" href="javascript:void(0)">New york</a>
                                        <a class="dropdown-item" href="javascript:void(0)">USA</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Any City</label>
                                <div class="dropdown">
                                    <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>Amreli</span> <i class="fas fa-angle-down"></i></span>
                                    <div class="dropdown-menu text-start">
                                        <a class="dropdown-item" href="javascript:void(0)">Gandhinagar</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Bharuch</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Amreli</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Ahmadabad</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Landmark</label>
                                <input type="text" class="form-control" placeholder="landmark place name">
                            </div>
                        </form>
                        <div class="dropzone-admin">
                            <label>Media</label>
                            <form class="dropzone" id="multiFileUpload" action="">
                                <div class="dz-message needsclick"><i class="fas fa-cloud-upload-alt"></i>
                                <h6>Drop files here or click to upload.</h6>
                                </div>
                            </form>
                        </div>
                        <form class="row gx-3">
                            <div class="form-group col-sm-12">
                                <label>video (mp4)</label>
                                <input type="text" class="form-control" placeholder="mp4 video link">
                            </div>
                            <div class="form-group col-sm-12 mb-0">
                                <label>Additional features</label>
                                <div class="additional-checkbox">
                                    <label for="chk-ani">
                                        <input class="checkbox_animated color-4" id="chk-ani" type="checkbox"> Emergency Exit
                                    </label>
                                    <label for="chk-ani1">
                                        <input class="checkbox_animated color-4" id="chk-ani1" type="checkbox"> CCTV
                                    </label>
                                    <label for="chk-ani2">
                                        <input class="checkbox_animated color-4" id="chk-ani2" type="checkbox" checked> Free Wi-Fi
                                    </label>
                                    <label for="chk-ani3">
                                        <input class="checkbox_animated color-4" id="chk-ani3" type="checkbox">  Free Parking In The Area
                                    </label>
                                    <label for="chk-ani4">
                                        <input class="checkbox_animated color-4" id="chk-ani4" type="checkbox">  Air Conditioning
                                    </label>
                                    <label for="chk-ani5">
                                        <input class="checkbox_animated color-4" id="chk-ani5" type="checkbox">  Security Guard
                                    </label>
                                    <label for="chk-ani6">
                                        <input class="checkbox_animated color-4" id="chk-ani6" type="checkbox" checked>  Terrace
                                    </label>
                                    <label for="chk-ani7">
                                        <input class="checkbox_animated color-4" id="chk-ani7" type="checkbox">  Laundry Service
                                    </label>
                                    <label for="chk-ani8">
                                        <input class="checkbox_animated color-4" id="chk-ani8" type="checkbox">  Elevator Lift
                                    </label>
                                    <label for="chk-ani9">
                                        <input class="checkbox_animated color-4" id="chk-ani9" type="checkbox" checked>  Balcony
                                    </label>
                                </div>
                            </div>
                            <div class="form-btn col-sm-12">
                                <button type="button" class="btn btn-pill btn-gradient color-4">Submit</button>
                                <button type="button" class="btn btn-pill btn-dashed color-4">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->
@endsection
