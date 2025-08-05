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
                        <form class="row gx-3" x-data="propertyForm()" @submit.prevent="submitProperty">
                            <!-- id (auto-generated, hidden) -->
                            <input type="hidden" x-model="form.id">
                            <div class="form-group col-sm-4">
                                <label>Name</label>
                                <input type="text" class="form-control" x-model="form.name" placeholder="Property Name"
                                    required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Property Type</label>
                                <input type="text" class="form-control" x-model="form.property_type"
                                    placeholder="office,villa,apartment" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Listing Type</label>
                                <input type="text" class="form-control" x-model="form.listing_type"
                                    placeholder="sale,rent,lease" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Status</label>
                                <input type="text" class="form-control" x-model="form.status"
                                    placeholder="active,inactive" required>
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Description</label>
                                <textarea class="form-control" x-model="form.description" rows="4" required></textarea>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Slug</label>
                                <input type="text" class="form-control" x-model="form.slug" placeholder="property-slug"
                                    required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Address</label>
                                <input type="text" class="form-control" x-model="form.address"
                                    placeholder="Address of your property" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>City</label>
                                <input type="text" class="form-control" x-model="form.city" placeholder="City" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>State</label>
                                <input type="text" class="form-control" x-model="form.state" placeholder="State"
                                    required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Postal Code</label>
                                <input type="text" class="form-control" x-model="form.postal_code"
                                    placeholder="Postal Code" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Country</label>
                                <input type="text" class="form-control" x-model="form.country" placeholder="Country"
                                    required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Latitude</label>
                                <input type="text" class="form-control" x-model="form.latitude" placeholder="Latitude">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Longitude</label>
                                <input type="text" class="form-control" x-model="form.longitude" placeholder="Longitude">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Bedrooms</label>
                                <input type="number" class="form-control" x-model="form.bedrooms" min="0"
                                    placeholder="Bedrooms">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Bathrooms</label>
                                <input type="number" class="form-control" x-model="form.bathrooms" min="0"
                                    placeholder="Bathrooms">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Parking Spaces</label>
                                <input type="number" class="form-control" x-model="form.parking_spaces" min="0"
                                    placeholder="Parking Spaces">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Land Size (sqm)</label>
                                <input type="number" class="form-control" x-model="form.land_size" min="0"
                                    placeholder="Land Size">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Built Area (sqm)</label>
                                <input type="number" class="form-control" x-model="form.built_area" min="0"
                                    placeholder="Built Area">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Year Built</label>
                                <input type="number" class="form-control" x-model="form.year_built" min="1800"
                                    max="2100" placeholder="Year Built">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Price</label>
                                <input type="number" class="form-control" x-model="form.price" min="0"
                                    placeholder="Price">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Price per sqm</label>
                                <input type="number" class="form-control" x-model="form.price_per_sqm" min="0"
                                    placeholder="Price per sqm">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Price per plot</label>
                                <input type="number" class="form-control" x-model="form.price_per_plot" min="0"
                                    placeholder="Price per plot">
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Features (comma separated)</label>
                                <input type="text" class="form-control" x-model="form.features"
                                    placeholder="e.g. Pool,Gym,Security">
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Amenities (comma separated)</label>
                                <input type="text" class="form-control" x-model="form.amenities"
                                    placeholder="e.g. WiFi,Parking,Elevator">
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Meta Description</label>
                                <input type="text" class="form-control" x-model="form.meta_description"
                                    placeholder="Meta Description">
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Meta Keywords</label>
                                <input type="text" class="form-control" x-model="form.meta_keywords"
                                    placeholder="Meta Keywords">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Listed At</label>
                                <input type="date" class="form-control" x-model="form.listed_at">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Expires At</label>
                                <input type="date" class="form-control" x-model="form.expires_at">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Deleted At</label>
                                <input type="date" class="form-control" x-model="form.deleted_at">
                            </div>
                            <!-- Removed created_at and updated_at fields, handled by DB -->
                            <div class="form-group col-sm-12">
                                <label>Virtual Tour URL</label>
                                <input type="url" class="form-control" x-model="form.virtual_tour_url"
                                    placeholder="https://...">
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Landmark</label>
                                <input type="text" class="form-control" x-model="form.landmark"
                                    placeholder="Landmark place name">
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Images</label>
                                <input type="file" class="form-control" multiple @change="handleImages">
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Videos</label>
                                <input type="file" class="form-control" multiple accept="video/*"
                                    @change="handleVideos">
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Floor Plan</label>
                                <input type="file" class="form-control" accept="image/*,.pdf"
                                    @change="handleFloorPlan">
                            </div>
                            <div class="form-btn col-sm-12">
                                <button type="submit" class="btn btn-pill btn-gradient color-4">Submit</button>
                                <button type="button" class="btn btn-pill btn-dashed color-4"
                                    @click="resetForm">Cancel</button>
                            </div>
                        </form>
                        <!-- ...existing code... -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->
@endsection

@push('scripts')
    <script>
        function propertyForm() {
            return {
                form: {
                    id: Date.now(),
                    name: '',
                    property_type: '',
                    listing_type: '',
                    status: '',
                    description: '',
                    slug: '',
                    address: '',
                    city: '',
                    state: '',
                    postal_code: '',
                    country: '',
                    latitude: '',
                    longitude: '',
                    bedrooms: '',
                    bathrooms: '',
                    parking_spaces: '',
                    land_size: '',
                    built_area: '',
                    year_built: '',
                    price: '',
                    price_per_sqm: '',
                    price_per_plot: '',
                    features: '',
                    amenities: '',
                    images: [],
                    videos: [],
                    virtual_tour_url: '',
                    floor_plan: null,
                    meta_description: '',
                    meta_keywords: '',
                    listed_at: '',
                    expires_at: '',
                    deleted_at: '',
                    landmark: '',
                    // removed created_at and updated_at, handled by DB
                },
                handleImages(e) {
                    this.form.images = Array.from(e.target.files);
                },
                handleVideos(e) {
                    this.form.videos = Array.from(e.target.files);
                },
                handleFloorPlan(e) {
                    this.form.floor_plan = e.target.files[0];
                },
                resetForm() {
                    this.form = {
                        id: Date.now(),
                        name: '',
                        property_type: '',
                        listing_type: '',
                        status: '',
                        description: '',
                        slug: '',
                        address: '',
                        city: '',
                        state: '',
                        postal_code: '',
                        country: '',
                        latitude: '',
                        longitude: '',
                        bedrooms: '',
                        bathrooms: '',
                        parking_spaces: '',
                        land_size: '',
                        built_area: '',
                        year_built: '',
                        price: '',
                        price_per_sqm: '',
                        price_per_plot: '',
                        features: '',
                        amenities: '',
                        images: [],
                        videos: [],
                        virtual_tour_url: '',
                        floor_plan: null,
                        meta_description: '',
                        meta_keywords: '',
                        listed_at: '',
                        expires_at: '',
                        deleted_at: '',
                        landmark: '',
                    };
                },
                async submitProperty() {
                    // Debug: log floor_plan before submission
                    console.log('floor_plan:', this.form.floor_plan, 'type:', typeof this.form.floor_plan,
                        'instanceof File:', this.form.floor_plan instanceof File);
                    let fd = new FormData();
                    // Convert features and amenities to arrays
                    let featuresArr = (typeof this.form.features === 'string') ? this.form.features.split(',').map(f =>
                        f.trim()).filter(f => f) : [];
                    let amenitiesArr = (typeof this.form.amenities === 'string') ? this.form.amenities.split(',').map(
                        a => a.trim()).filter(a => a) : [];
                    // Prepare FormData
                    Object.keys(this.form).forEach(key => {
                        if (key === 'features') {
                            featuresArr.forEach((f, i) => fd.append('features[' + i + ']', f));
                        } else if (key === 'amenities') {
                            amenitiesArr.forEach((a, i) => fd.append('amenities[' + i + ']', a));
                        } else if (key === 'images' && Array.isArray(this.form.images)) {
                            this.form.images.forEach((img, i) => fd.append('images[' + i + ']', img));
                        } else if (key === 'videos' && Array.isArray(this.form.videos)) {
                            this.form.videos.forEach((vid, i) => fd.append('videos[' + i + ']', vid));
                        } else if (key === 'floor_plan' && this.form.floor_plan) {
                            fd.append('floor_plan', this.form.floor_plan);
                        } else {
                            fd.append(key, this.form[key]);
                        }
                    });

                    try {
                        let resp = await fetch('/management/my-properties/store', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: fd
                        });

                        const responseData = await resp.json();
                        console.log('Response:', responseData); // Debug log

                        if (resp.ok && responseData.success) {
                            toastr.success(responseData.message || 'Property added successfully!');
                            this.resetForm();

                            // Redirect if provided
                            if (responseData.redirect) {
                                window.location.href = responseData.redirect;
                            }
                        } else {
                            // Handle validation errors
                            if (responseData.errors) {
                                let errorMessage = 'Validation errors:\n';
                                if (Array.isArray(responseData.errors)) {
                                    errorMessage += responseData.errors.join('\n');
                                } else if (typeof responseData.errors === 'object') {
                                    Object.keys(responseData.errors).forEach(field => {
                                        errorMessage += `${field}: ${responseData.errors[field].join(', ')}\n`;
                                    });
                                }
                                toastr.error(errorMessage);
                            } else {
                                toastr.error(responseData.message || 'Failed to add property.');
                            }
                        }
                    } catch (err) {
                        console.error('Error submitting property:', err);
                        toastr.error('Error submitting property: ' + err.message);
                    }
                }
            }
        }
    </script>
@endpush
