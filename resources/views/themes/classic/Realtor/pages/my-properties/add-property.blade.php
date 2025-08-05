@extends('themes.classic.realtor.realtor_master')
@section('title', 'Add Property | Premium Refined Luxury Homes')
@section('content')
    <!-- Container-fluid start -->
    {{-- <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-left">
                        <h3>Add property
                            <small>Welcome to realtor panel</small>
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
                        <li class="breadcrumb-item active">My properties</li>
                    </ol>
                    <!-- Breadcrumb end -->

                </div>
            </div>
        </div>
    </div> --}}
    <!-- Container-fluid end -->

    <!-- Container-fluid start -->
    {{-- <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Add property details</h5>
                    </div>
                    <div class="card-body admin-form">
                        <div x-data="{
                            property: {
                                name: '', property_type: '', listing_type: '', status: 'available',
                                description: '', slug: '', address: '', city: '', state: '',
                                postal_code: '', country: 'Nigeria', latitude: '', longitude: '',
                                bedrooms: '', bathrooms: '', parking_spaces: '', land_size: '',
                                built_area: '', year_built: '', price: '', price_per_sqm: '',
                                features: [], amenities: [], images: '', videos: '',
                                virtual_tour_url: '', floor_plan: '', meta_description: '',
                                meta_keywords: '', listed_at: '', expires_at: '',
                                image: '', price_per_plot: '',
                            },
                            submitForm() {
                                axios.post('{{ route("tenant.realtor.properties.store") }}', this.property)
                                    .then(response => {
                                        // handle success
                                        alert('Property created successfully!');
                                        console.log('Property created:', response.data);
                                        if (response.data.redirect) {
                                            window.location.href = response.data.redirect;
                                        }
                                    })
                                    .catch(error => {
                                        // handle error
                                        alert('Error creating property: ' + (error.response?.data?.message || error.message));
                                        console.error('Error creating property:', error);
                                    });
                            }
                        }">
                        
                        <!-- Property Fields -->
                        <form class="row gx-3" @submit.prevent="submitForm()">
                            <div class="form-group col-sm-4">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Enter name" x-model="property.name" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Property Type</label>
                                <input type="text" class="form-control" placeholder="office,villa,apartment" x-model="property.property_type" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Listing Type</label>
                                <input type="text" class="form-control" placeholder="sale,rent,lease" x-model="property.listing_type" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Status</label>
                                <input type="text" class="form-control" placeholder="available,sold,rented" x-model="property.status">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Price</label>
                                <input type="number" class="form-control" placeholder="Enter price" x-model="property.price">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Bedrooms</label>
                                <input type="number" class="form-control" placeholder="Enter number of bedrooms" x-model="property.bedrooms">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Bathrooms</label>
                                <input type="number" class="form-control" placeholder="Enter number of bathrooms" x-model="property.bathrooms">
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Description</label>
                                <textarea class="form-control" rows="4" x-model="property.description"></textarea>
                            </div>
                            
                            <!-- Location Fields -->
                            <div class="form-group col-sm-6">
                                <label>Address</label>
                                <input type="text" class="form-control" placeholder="Property address" x-model="property.address">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>City</label>
                                <input type="text" class="form-control" placeholder="City" x-model="property.city">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>State</label>
                                <input type="text" class="form-control" placeholder="State" x-model="property.state">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Postal Code</label>
                                <input type="text" class="form-control" placeholder="Postal code" x-model="property.postal_code">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Country</label>
                                <input type="text" class="form-control" placeholder="Country" x-model="property.country">
                            </div>
                            
                            <!-- Property Details -->
                            <div class="form-group col-sm-4">
                                <label>Parking Spaces</label>
                                <input type="number" class="form-control" placeholder="Number of parking spaces" x-model="property.parking_spaces">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Land Size (sqm)</label>
                                <input type="number" step="0.01" class="form-control" placeholder="Land size in square meters" x-model="property.land_size">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Built Area (sqm)</label>
                                <input type="number" step="0.01" class="form-control" placeholder="Built area in square meters" x-model="property.built_area">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Year Built</label>
                                <input type="number" class="form-control" placeholder="Year built" x-model="property.year_built">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Price per SQM</label>
                                <input type="number" step="0.01" class="form-control" placeholder="Price per square meter" x-model="property.price_per_sqm">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Price per Plot</label>
                                <input type="number" step="0.01" class="form-control" placeholder="Price per plot" x-model="property.price_per_plot">
                            </div>
                            
                            <!-- Coordinates -->
                            <div class="form-group col-sm-6">
                                <label>Latitude</label>
                                <input type="number" step="0.00000001" class="form-control" placeholder="Latitude" x-model="property.latitude">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Longitude</label>
                                <input type="number" step="0.00000001" class="form-control" placeholder="Longitude" x-model="property.longitude">
                            </div>
                            
                            <!-- Media and SEO -->
                            <div class="form-group col-sm-6">
                                <label>Virtual Tour URL</label>
                                <input type="url" class="form-control" placeholder="Virtual tour URL" x-model="property.virtual_tour_url">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Slug</label>
                                <input type="text" class="form-control" placeholder="Property slug (optional)" x-model="property.slug">
                            </div>
                            
                            <div class="form-group col-sm-12">
                                <label>Meta Description</label>
                                <textarea class="form-control" rows="2" placeholder="Meta description for SEO" x-model="property.meta_description"></textarea>
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Meta Keywords</label>
                                <input type="text" class="form-control" placeholder="Meta keywords, separated by commas" x-model="property.meta_keywords">
                            </div>
                            
                            <!-- Dates -->
                            <div class="form-group col-sm-6">
                                <label>Listed At</label>
                                <input type="datetime-local" class="form-control" x-model="property.listed_at">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Expires At</label>
                                <input type="datetime-local" class="form-control" x-model="property.expires_at">
                            </div>
                            
                            <div class="form-btn col-sm-12">
                                <button type="submit" class="btn btn-pill btn-gradient color-4">Submit Property</button>
                                <button type="button" class="btn btn-pill btn-dashed color-4">Cancel</button>
                            </div>
                        </form>
                        <!-- End of Form -->
                         <div class="dropzone-admin">
                            <label>Media</label>
                            <form class="dropzone" id="multiFileUpload" action="">
                                <div class="dz-message needsclick"><i class="fas fa-cloud-upload-alt"></i>
                                    <h6>Drop files here or click to upload.</h6>
                                </div>
                            </form>
                        </div>
                        <!-- More fields -->
                            <div class="form-group col-sm-4">
                                <label>Property Status</label>
                                <div class="dropdown">
                                    <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>For Sale</span>
                                        <i class="fas fa-angle-down"></i></span>
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
                                    <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>1</span> <i
                                            class="fas fa-angle-down"></i></span>
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
                                    <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>1</span> <i
                                            class="fas fa-angle-down"></i></span>
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
                                    <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>1</span> <i
                                            class="fas fa-angle-down"></i></span>
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
                                    <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>Premiere</span>
                                        <i class="fas fa-angle-down"></i></span>
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
                                    <span class="dropdown-toggle font-rubik"
                                        data-bs-toggle="dropdown"><span>Austria</span> <i
                                            class="fas fa-angle-down"></i></span>
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
                                    <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>Amreli</span>
                                        <i class="fas fa-angle-down"></i></span>
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
                                        <input class="checkbox_animated color-4" id="chk-ani" type="checkbox">
                                        Emergency Exit
                                    </label>
                                    <label for="chk-ani1">
                                        <input class="checkbox_animated color-4" id="chk-ani1" type="checkbox"> CCTV
                                    </label>
                                    <label for="chk-ani2">
                                        <input class="checkbox_animated color-4" id="chk-ani2" type="checkbox" checked>
                                        Free Wi-Fi
                                    </label>
                                    <label for="chk-ani3">
                                        <input class="checkbox_animated color-4" id="chk-ani3" type="checkbox"> Free
                                        Parking In The Area
                                    </label>
                                    <label for="chk-ani4">
                                        <input class="checkbox_animated color-4" id="chk-ani4" type="checkbox"> Air
                                        Conditioning
                                    </label>
                                    <label for="chk-ani5">
                                        <input class="checkbox_animated color-4" id="chk-ani5" type="checkbox"> Security
                                        Guard
                                    </label>
                                    <label for="chk-ani6">
                                        <input class="checkbox_animated color-4" id="chk-ani6" type="checkbox" checked>
                                        Terrace
                                    </label>
                                    <label for="chk-ani7">
                                        <input class="checkbox_animated color-4" id="chk-ani7" type="checkbox"> Laundry
                                        Service
                                    </label>
                                    <label for="chk-ani8">
                                        <input class="checkbox_animated color-4" id="chk-ani8" type="checkbox"> Elevator
                                        Lift
                                    </label>
                                    <label for="chk-ani9">
                                        <input class="checkbox_animated color-4" id="chk-ani9" type="checkbox" checked>
                                        Balcony
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
    </div> --}}
    <!-- Container-fluid end -->
@endsection
