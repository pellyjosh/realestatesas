@extends('themes.classic.admin.admin_master')
@section('title', 'My Properties | Premium Refined Luxury Homes')
@section('content')
    {{-- Ensure Alpine.js is included --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.8.1"></script>

    <script>
        function propertyModal() {
            return {
                showModal: false,
                isSubmitting: false,
                csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                properties: [],
                homeSections: {
                    featured: null,
                    'latest for sale': null
                },
                form: {
                    id: '',
                    name: '',
                    property_type: '',
                    listing_type: '',
                    status: '',
                    description: '',
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
                    meta_description: '',
                    meta_keywords: '',
                    listed_at: '',
                    expires_at: '',
                    virtual_tour_url: ''
                },
                init() {
                    const jsonElement = document.getElementById('properties-json');
                    if (!jsonElement) {
                        console.error('properties-json script tag not found!');
                        this.properties = [];
                        return;
                    }
                    const json = jsonElement.textContent;
                    try {
                        this.properties = JSON.parse(json);
                    } catch (e) {
                        console.error('Error parsing properties JSON:', e);
                        this.properties = [];
                    }
                    const homeSectionsJson = document.getElementById('home-sections-json').textContent;
                    try {
                        this.homeSections = JSON.parse(homeSectionsJson);
                    } catch (e) {
                        console.error('Error parsing home sections JSON:', e);
                        this.homeSections = {
                            featured: null,
                            latest: null
                        };
                    }
                },
                openEditModal(property) {
                    this.form = {
                        id: property.id || '',
                        name: property.name || '',
                        property_type: property.property_type || '',
                        listing_type: property.listing_type || '',
                        status: property.status || '',
                        description: property.description || '',
                        address: property.address || '',
                        city: property.city || '',
                        state: property.state || '',
                        postal_code: property.postal_code || '',
                        country: property.country || '',
                        latitude: property.latitude || '',
                        longitude: property.longitude || '',
                        bedrooms: property.bedrooms || '',
                        bathrooms: property.bathrooms || '',
                        parking_spaces: property.parking_spaces || '',
                        land_size: property.land_size || '',
                        built_area: property.built_area || '',
                        year_built: property.year_built || '',
                        price: property.price || '',
                        price_per_sqm: property.price_per_sqm || '',
                        price_per_plot: property.price_per_plot || '',
                        meta_description: property.meta_description || '',
                        meta_keywords: property.meta_keywords || '',
                        listed_at: property.listed_at ? property.listed_at.split(' ')[0] : '',
                        expires_at: property.expires_at ? property.expires_at.split(' ')[0] : '',
                        virtual_tour_url: property.virtual_tour_url || ''
                    };
                    this.showModal = true;
                },
                closeModal() {
                    this.showModal = false;
                    this.isSubmitting = false;
                },
                async toggleFeatured(propertyId) {
                    await this.toggleSection('featured', propertyId);
                },
                async toggleLatest(propertyId) {
                    await this.toggleSection('latest for sale', propertyId, 'latest-for-sale');
                },
                async toggleSection(sectionName, propertyId, urlSectionName = null) {
                    // Use urlSectionName for the route if provided, else use sectionName
                    const sectionForUrl = urlSectionName || sectionName;
                    const encodedSection = encodeURIComponent(sectionForUrl);
                    const url = `/management/my-properties/${propertyId}/toggle-${encodedSection}`;
                    this.isSubmitting = true;
                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-Token': this.csrfToken
                            },
                            body: JSON.stringify({})
                        });
                        let result = {};
                        let raw = '';
                        try {
                            result = await response.json();
                        } catch (e) {
                            raw = await response.text();
                            console.error('Non-JSON response:', raw, 'Status:', response.status);
                        }
                        if (response.ok && result.success) {
                            this.updateSectionData(sectionName, propertyId);
                            alert(result.message);
                        } else {
                            let msg = result.message || raw || 'An error occurred while toggling the property.';
                            alert(msg);
                        }
                    } catch (error) {
                        console.error('Error toggling property:', error);
                        alert('An unexpected error occurred. Please try again.');
                    } finally {
                        this.isSubmitting = false;
                    }
                },
                updateSectionData(sectionName, propertyId) {
                    const section = this.homeSections[sectionName];
                    if (!section) return;
                    const propertyIndex = section.data.selected.findIndex(item => item.property_id === propertyId);
                    if (propertyIndex !== -1) {
                        section.data.selected.splice(propertyIndex, 1);
                    } else {
                        section.data.selected.push({
                            property_id: propertyId
                        });
                    }
                },
                isPropertyInSection(propertyId, sectionName) {
                    const section = this.homeSections[sectionName];
                    return section ? section.data.selected.some(item => item.property_id === propertyId) : false;
                },
                async submitProperty() {
                    this.isSubmitting = true;
                    try {
                        const formData = new FormData();
                        Object.keys(this.form).forEach(key => {
                            if (key !== 'id' && this.form[key] !== null && this.form[key] !== undefined) {
                                formData.append(key, this.form[key]);
                            }
                        });
                        formData.append('_token', this.csrfToken);
                        formData.append('_method', 'PUT');
                        const response = await fetch(`/management/my-properties/${this.form.id}`, {
                            method: 'POST',
                            body: formData
                        });
                        let result;
                        let rawText = await response.text();
                        try {
                            result = JSON.parse(rawText);
                        } catch (jsonError) {
                            console.error('Raw response from server:', rawText);
                            throw new Error('Server did not return valid JSON.');
                        }
                        if (response.ok && result.success) {
                            alert(result.message || 'Property updated successfully!');
                            const updatedProperty = result.property;
                            const idx = this.properties.findIndex(p => p.id === updatedProperty.id);
                            if (idx !== -1) {
                                this.properties[idx] = updatedProperty;
                            }
                            this.closeModal();
                        } else {
                            let errorMessage = 'Failed to update property.';
                            if (result.errors) {
                                if (typeof result.errors === 'object') {
                                    errorMessage = Object.values(result.errors).flat().join('\n');
                                } else {
                                    errorMessage = result.errors;
                                }
                            } else if (result.message) {
                                errorMessage = result.message;
                            }
                            alert(errorMessage);
                        }
                    } catch (error) {
                        console.error('Error updating property:', error);
                        alert('An error occurred while updating the property.');
                    } finally {
                        this.isSubmitting = false;
                    }
                },
                getImageUrl(image) {
                    let imagePath = '';
                    if (typeof image === 'string') {
                        imagePath = image;
                    } else if (image && typeof image === 'object') {
                        imagePath = image.path || image.url || image.file_path || image.image_path || image.src || '';
                    }

                    if (!imagePath) {
                        return 'https://via.placeholder.com/400x300?text=No+Image+Path';
                    }

                    // Handle different image path formats
                    if (imagePath.startsWith('http://') || imagePath.startsWith('https://')) {
                        return imagePath;
                    } else {
                        // Get tenant ID dynamically (e.g., 'client1' from 'client1.central.test')
                        const tenantId = this.getCurrentTenantId();

                        // Build tenant-specific storage URL similar to asset('storage/tenantclient1/...')
                        // This will create URLs like: /storage/tenantclient1/properties/images/filename.jpg
                        return `/storage/tenant${tenantId}/${imagePath}`;
                    }
                },
                getCurrentTenantId() {
                    // Extract tenant ID from URL (e.g., client1.central.test -> client1)
                    const hostname = window.location.hostname;
                    const parts = hostname.split('.');
                    if (parts.length >= 3 && parts[1] === 'central') {
                        return parts[0]; // Return 'client1', 'client2', etc.
                    }
                    // Fallback: try to extract from subdomain or other patterns
                    if (parts.length >= 2) {
                        return parts[0];
                    }
                    return 'client1'; // Default fallback
                },
                handleImageError(event, image) {
                    console.error('Image failed to load:', image, event);
                },
                getPropertyImages(property) {
                    let images = [];
                    // Only use the images array - ignore the old 'image' field
                    if (property.images && Array.isArray(property.images) && property.images.length > 0) {
                        images = property.images;
                    }
                    // Don't fall back to the old 'image' field as it has incorrect paths
                    return images;
                }
            };
        }
    </script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('propertyModal', () => ({
                ...propertyModal(),
                selectedFilter: 'all',
                filteredProperties() {
                    if (this.selectedFilter === 'all') return this.properties;
                    if (this.selectedFilter === 'featured') {
                        return this.properties.filter(p => this.isPropertyInSection(p.id, 'featured'));
                    }
                    if (this.selectedFilter === 'latest') {
                        return this.properties.filter(p => this.isPropertyInSection(p.id,
                            'latest for sale'));
                    }
                    return this.properties;
                }
            }));
        });
    </script>

    {{-- Expose properties as JSON for Alpine.js --}}
    <script id="properties-json" type="application/json">
    {!! json_encode($properties ? $properties->values()->toArray() : []) !!}
</script>

    {{-- Expose home sections data --}}
    <script id="home-sections-json" type="application/json">
        {
            "featured": {!! json_encode($featuredSection ? $featuredSection->toArray() : null) !!},
            "latest for sale": {!! json_encode($latestSection ? $latestSection->toArray() : null) !!}
        }
    </script>

    {{-- Container-fluid start --}}
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-left">
                        <h3>Property list
                            <small>Welcome to admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-6">
                    {{-- Breadcrumb start --}}
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('tenant.admin.dashboard') }}">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">My properties</li>
                    </ol>
                    {{-- Breadcrumb end --}}
                </div>
            </div>
        </div>
    </div>
    {{-- Container-fluid end --}}

    {{-- Main Container with Alpine.js --}}
    <div class="container-fluid" x-data="propertyModal()" x-init="init()">
        <div class="col-lg-12" x-data="{ viewType: 'grid' }">
            <div class="property-admin">
                <div class="property-section section-sm">
                    <div class="row ratio_55 property-grid-2 property-map map-with-back">
                        <div class="col-12">
                            <div class="filter-panel">
                                <div class="listing-option">
                                    <h5 class="mb-0">Showing <span>1-15 of 69</span> Listings</h5>
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <button type="button" class="btn btn-sm"
                                                :class="viewType === 'grid' ? 'btn-primary' : 'btn-outline-primary'"
                                                @click="viewType = 'grid'" style="min-width: 90px;">Grid View</button>
                                            <button type="button" class="btn btn-sm"
                                                :class="viewType === 'list' ? 'btn-primary' : 'btn-outline-primary'"
                                                @click="viewType = 'list'" style="min-width: 90px;">List View</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <template x-if="viewType === 'grid'">
                                <div class="property-2 row column-sm property-label property-grid">
                                    <div class="mb-3 d-flex gap-2">
                                        <template x-for="filter in ['all', 'featured', 'latest']" :key="filter">
                                            <button type="button" class="btn btn-pill color-1"
                                                :class="selectedFilter === filter ? 'active-filter-btn' : 'btn-outline-primary'"
                                                x-text="filter === 'all' ? 'All' : (filter === 'featured' ? 'Featured' : 'Latest For Sale')"
                                                @click="selectedFilter = filter"
                                                style="transition: box-shadow 0.2s, background 0.2s; min-width: 120px;"></button>
                                        </template>
                                    </div>
                                    <template x-for="property in filteredProperties()" :key="property.id">
                                        <div class="col-xl-4 col-md-6 xl-6">
                                            <div class="property-box">
                                                <div class="property-image">
                                                    <div class="property-slider"
                                                        style="position: relative; height: 250px; overflow: hidden;">
                                                        {{-- Display property images from database --}}
                                                        <template x-if="property.images && property.images.length > 0">
                                                            <div
                                                                style="position: relative; width: 100%; height: 250px; background: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                                                                {{-- Display only the first image for now --}}
                                                                <img :src="'/storage/tenantclient1/' + property.images[0]"
                                                                    class="bg-img" alt="Property Image"
                                                                    onerror="console.error('Image failed to load:', this.src); this.style.display='none'; this.nextElementSibling.style.display='block';"
                                                                    onload="console.log('Image loaded successfully:', this.src);"
                                                                    style="width: 100%; height: 250px; object-fit: cover; display: block;">
                                                                {{-- Fallback text if image fails --}}
                                                                <div
                                                                    style="display: none; color: #6c757d; text-align: center; font-size: 14px;">
                                                                    Image failed to load<br>
                                                                    <small
                                                                        x-text="'/storage/tenantclient1/' + property.images[0]"></small>
                                                                </div>
                                                            </div>
                                                        </template>
                                                        {{-- Fallback if no images --}}
                                                        <template x-if="!property.images || property.images.length === 0">
                                                            <div
                                                                style="position: relative; width: 100%; height: 250px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 14px; text-align: center;">
                                                                <div>
                                                                    <div>No Images Available</div>
                                                                    <small>Property ID: <span
                                                                            x-text="property.id"></span></small>
                                                                </div>
                                                            </div>
                                                        </template>
                                                    </div>
                                                    <div class="labels-left">
                                                        <div><span class="label label-shadow">sale</span></div>
                                                    </div>
                                                    <div class="seen-data">
                                                        <i data-feather="camera"></i>
                                                        <span x-text="getPropertyImages(property).length"></span>
                                                    </div>
                                                    {{-- 3-dot menu for actions --}}
                                                    <div style="position:absolute;bottom:0;right:0;margin:8px;z-index:10;"
                                                        x-data="{ open: false }">
                                                        <button type="button" @@click="open = !open"
                                                            class="btn btn-light p-1 rounded-circle border"
                                                            style="width:32px;height:32px;display:flex;align-items:center;justify-content:center;">
                                                            <span
                                                                style="display:flex;flex-direction:column;align-items:center;justify-content:center;">
                                                                <span
                                                                    style="width:4px;height:4px;background:black;border-radius:50%;margin:1px;"></span>
                                                                <span
                                                                    style="width:4px;height:4px;background:black;border-radius:50%;margin:1px;"></span>
                                                                <span
                                                                    style="width:4px;height:4px;background:black;border-radius:50%;margin:1px;"></span>
                                                            </span>
                                                        </button>
                                                        <div x-show="open" @@click.outside="open = false"
                                                            x-transition class="shadow rounded py-2 px-3 bg-white"
                                                            style="position:absolute;right:0;bottom:36px;min-width:160px;z-index:100;">
                                                            <button type="button" class="dropdown-item w-100 text-start"
                                                                style="background:white;color:black;border:none;padding:8px 0;"
                                                                @@click="toggleFeatured(property.id)"
                                                                x-text="isPropertyInSection(property.id, 'featured') ? 'Remove from Featured' : 'Add to Featured'"></button>
                                                            <button type="button" class="dropdown-item w-100 text-start"
                                                                style="background:white;color:black;border:none;padding:8px 0;"
                                                                @@click="toggleLatest(property.id)"
                                                                x-text="isPropertyInSection(property.id, 'latest for sale') ? 'Remove from Latest' : 'Add to Latest for Sale'"></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="property-details">
                                                    <span class="font-roboto" x-text="property.city"></span>
                                                    <a
                                                        href="https://themes.pixelstrap.com/sheltos/main/single-property-8.html">
                                                        <h3 x-text="property.name"></h3>
                                                    </a>
                                                    <h6 x-text="'₦' + property.price"></h6>
                                                    <p class="font-roboto light-font" x-text="property.description"></p>
                                                    <ul>
                                                        <li><img src="https://themes.pixelstrap.com/sheltos/assets/images/svg/icon/double-bed.svg"
                                                                class="img-fluid" alt="">Bed : <span
                                                                x-text="property.bedrooms"></span></li>
                                                        <li><img src="https://themes.pixelstrap.com/sheltos/assets/images/svg/icon/bathroom.svg"
                                                                class="img-fluid" alt="">Baths : <span
                                                                x-text="property.bathrooms"></span></li>
                                                        <li><img src="https://themes.pixelstrap.com/sheltos/assets/images/svg/icon/square-ruler-tool.svg"
                                                                class="img-fluid ruler-tool" alt="">Sq Ft : <span
                                                                x-text="property.built_area"></span></li>
                                                    </ul>
                                                    <div class="property-btn d-flex">
                                                        <span
                                                            x-text="property.listed_at ? new Date(property.listed_at).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' }) : ''"></span>
                                                        <button type="button" class="btn btn-dashed btn-pill color-1"
                                                            @@click="openEditModal(property)">Edit</button>
                                                        <button type="button" class="btn btn-dashed btn-pill color-3"
                                                            onclick="alert('Are you sure you want to delete this property?')">Delete</button>
                                                        <button type="button"
                                                            onclick="document.location='https://themes.pixelstrap.com/sheltos/main/single-property-8.html'"
                                                            class="btn btn-dashed btn-pill color-2">Details</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </template>
                            <template x-if="viewType === 'list'">
                                <div class="property-list-view">
                                    <div class="mb-3 d-flex gap-2">
                                        <template x-for="filter in ['all', 'featured', 'latest']" :key="filter">
                                            <button type="button" class="btn btn-pill color-1"
                                                :class="selectedFilter === filter ? 'active-filter-btn' : 'btn-outline-primary'"
                                                x-text="filter === 'all' ? 'All' : (filter === 'featured' ? 'Featured' : 'Latest For Sale')"
                                                @click="selectedFilter = filter"
                                                style="transition: box-shadow 0.2s, background 0.2s; min-width: 120px;"></button>
                                        </template>
                                    </div>
                                    <template x-for="property in filteredProperties()" :key="property.id">
                                        <div class="property-list-item d-flex align-items-center justify-content-between mb-3 p-3 bg-white shadow-sm rounded"
                                            style="width: 100%;">
                                            <div class="d-flex flex-column flex-grow-1">
                                                <div class="d-flex align-items-center mb-2">
                                                    <h5 class="mb-0 me-3" x-text="property.name"></h5>
                                                    <span class="badge bg-success ms-2"
                                                        x-text="'₦' + property.price"></span>
                                                </div>
                                                <div class="mb-1 text-muted" style="font-size: 0.95rem;"
                                                    x-text="property.description"></div>
                                                <div class="mb-2 text-muted" style="font-size: 0.9rem;">
                                                    Listed: <span
                                                        x-text="property.listed_at ? new Date(property.listed_at).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' }) : ''"></span>
                                                </div>
                                                <div class="d-flex gap-2 mt-2">
                                                    <button type="button" class="btn btn-dashed btn-pill color-1"
                                                        @@click="openEditModal(property)">Edit</button>
                                                    <button type="button" class="btn btn-dashed btn-pill color-3"
                                                        onclick="alert('Are you sure you want to delete this property?')">Delete</button>
                                                    <button type="button" class="btn btn-dashed btn-pill color-2"
                                                        onclick="document.location='https://themes.pixelstrap.com/sheltos/main/single-property-8.html'">Details</button>
                                                </div>
                                            </div>
                                            <div class="ms-3" x-data="{ open: false }" style="position: relative;">
                                                <button type="button" @@click="open = !open"
                                                    class="btn btn-light p-1 rounded-circle border"
                                                    style="width:32px;height:32px;display:flex;align-items:center;justify-content:center;">
                                                    <span
                                                        style="display:flex;flex-direction:column;align-items:center;justify-content:center;">
                                                        <span
                                                            style="width:4px;height:4px;background:black;border-radius:50%;margin:1px;"></span>
                                                        <span
                                                            style="width:4px;height:4px;background:black;border-radius:50%;margin:1px;"></span>
                                                        <span
                                                            style="width:4px;height:4px;background:black;border-radius:50%;margin:1px;"></span>
                                                    </span>
                                                </button>
                                                <div x-show="open" @@click.outside="open = false"
                                                    x-transition class="shadow rounded py-2 px-3 bg-white"
                                                    style="position:absolute;right:0;top:36px;min-width:160px;z-index:100;">
                                                    <button type="button" class="dropdown-item w-100 text-start"
                                                        style="background:white;color:black;border:none;padding:8px 0;"
                                                        @@click="toggleFeatured(property.id)"
                                                        x-text="isPropertyInSection(property.id, 'featured') ? 'Remove from Featured' : 'Add to Featured'"></button>
                                                    <button type="button" class="dropdown-item w-100 text-start"
                                                        style="background:white;color:black;border:none;padding:8px 0;"
                                                        @@click="toggleLatest(property.id)"
                                                        x-text="isPropertyInSection(property.id, 'latest for sale') ? 'Remove from Latest' : 'Add to Latest for Sale'"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </template>
                            </template>
                            <template x-if="viewType === 'map'">
                                <div class="d-flex align-items-center justify-content-center"
                                    style="min-height: 400px; background: #f8f9fa; border-radius: 12px;">
                                    <span style="color: #6c757d; font-size: 1.2rem;">Map view coming soon...</span>
                                </div>
                            </template>
                            <nav class="theme-pagination">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="javascript:void(0)"
                                            aria-label="Previous"><span aria-hidden="true">«</span><span
                                                class="sr-only">Previous</span></a></li>
                                    <li class="page-item active"><a class="page-link" href="javascript:void(0)">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0)"
                                            aria-label="Next"><span aria-hidden="true">»</span><span
                                                class="sr-only">Next</span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Property Modal --}}
    <div x-show="showModal" x-cloak class="modal"
        style="background-color: rgba(0,0,0,0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 1050;"
        x-transition @@click.self="closeModal()">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Property</h5>
                    <button type="button" class="btn-close" @@click="closeModal()"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row gx-3" @@submit.prevent="submitProperty">
                        <input type="hidden" name="_token" :value="csrfToken">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group col-sm-4">
                            <label>Name</label>
                            <input type="text" class="form-control" x-model="form.name" placeholder="Property Name"
                                required>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Property Type</label>
                            <select class="form-control" x-model="form.property_type" required>
                                <option value="">Select Property Type</option>
                                <option value="house">House</option>
                                <option value="apartment">Apartment</option>
                                <option value="condo">Condominium</option>
                                <option value="townhouse">Townhouse</option>
                                <option value="villa">Villa</option>
                                <option value="land">Land</option>
                                <option value="commercial">Commercial</option>
                                <option value="office">Office</option>
                                <option value="retail">Retail</option>
                                <option value="warehouse">Warehouse</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Listing Type</label>
                            <select class="form-control" x-model="form.listing_type" required>
                                <option value="">Select Listing Type</option>
                                <option value="sale">For Sale</option>
                                <option value="rent">For Rent</option>
                                <option value="lease">For Lease</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Status</label>
                            <select class="form-control" x-model="form.status">
                                <option value="available">Available</option>
                                <option value="sold">Sold</option>
                                <option value="rented">Rented</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Description</label>
                            <textarea class="form-control" x-model="form.description" rows="4"></textarea>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Address</label>
                            <input type="text" class="form-control" x-model="form.address"
                                placeholder="Address of your property">
                        </div>
                        <div class="form-group col-sm-4">
                            <label>City</label>
                            <input type="text" class="form-control" x-model="form.city" placeholder="City">
                        </div>
                        <div class="form-group col-sm-4">
                            <label>State</label>
                            <input type="text" class="form-control" x-model="form.state" placeholder="State">
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Postal Code</label>
                            <input type="text" class="form-control" x-model="form.postal_code"
                                placeholder="Postal Code">
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Country</label>
                            <input type="text" class="form-control" x-model="form.country" placeholder="Country">
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
                                step="0.01" placeholder="Price">
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Price per sqm</label>
                            <input type="number" class="form-control" x-model="form.price_per_sqm" min="0"
                                step="0.01" placeholder="Price per sqm">
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Price per plot</label>
                            <input type="number" class="form-control" x-model="form.price_per_plot" min="0"
                                step="0.01" placeholder="Price per plot">
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Meta Description</label>
                            <textarea class="form-control" x-model="form.meta_description" placeholder="Meta Description" maxlength="500"></textarea>
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
                        <div class="form-group col-sm-12">
                            <label>Virtual Tour URL</label>
                            <input type="url" class="form-control" x-model="form.virtual_tour_url"
                                placeholder="https://...">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        @@click="closeModal()">Cancel</button>
                    <button type="button" class="btn btn-primary" @@click="submitProperty()"
                        :disabled="isSubmitting">
                        <span x-show="isSubmitting">Updating...</span>
                        <span x-show="!isSubmitting">Update Property</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- Container-fluid end --}}

    @push('scripts')
        <style>
            .active-filter-btn {
                background: #91d30a !important;
                /* matches color-1 */
                color: #fff !important;
                border: none !important;
                box-shadow: 0 2px 8px rgba(145, 211, 10, 0.15);
            }

            .btn.btn-pill.color-1 {
                border-radius: 50px;
                background: #fff;
                color: #91d30a;
                border: 1px solid #91d30a;
            }

            .btn.btn-pill.color-1.btn-outline-primary {
                background: #fff;
                color: #91d30a;
                border: 1px solid #91d30a;
            }

            .btn.btn-pill.color-1:hover,
            .btn.btn-pill.color-1:focus {
                background: #91d30a;
                color: #fff;
                border: 1px solid #91d30a;
            }
        </style>
        <style>
            [x-cloak] {
                display: none !important;
            }

            /* Property images styling */
            .property-box .property-image .property-slider img,
            .property-image .property-slider img,
            img.bg-img {
                display: block !important;
                visibility: visible !important;
                opacity: 1 !important;
                width: 100% !important;
                height: 250px !important;
                object-fit: cover !important;
                position: relative !important;
                z-index: 1 !important;
                margin: 0 !important;
                padding: 0 !important;
                border-radius: 8px;
            }

            /* Property slider container */
            .property-image .property-slider,
            .property-slider {
                background: #f8f9fa !important;
                min-height: 250px !important;
                height: 250px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                position: relative !important;
                overflow: hidden !important;
                border-radius: 8px;
            }

            /* Inner container for images */
            .property-slider>div {
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                width: 100% !important;
                height: 250px !important;
                position: relative !important;
                overflow: hidden !important;
                border-radius: 8px;
            }

            /* Property box layout */
            .property-box {
                overflow: hidden !important;
                border-radius: 12px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .property-box:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
            }

            .property-image {
                overflow: hidden !important;
                position: relative;
            }
        </style>
    @endpush
@endsection
