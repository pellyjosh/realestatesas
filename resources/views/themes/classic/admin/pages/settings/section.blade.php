@extends('themes.classic.admin.admin_master')
@section('title', 'Homepage Content Management | Premium Refined Luxury Homes')

<meta name="csrf-token" content="{{ csrf_token() }}">

@if (isset($realtors))
    <script>
        window.allRealtors = @json($realtors);
    </script>
@endif
@section('content')

    <script>
        window.uniqueCities = @json($uniqueCities);
    </script>
    <div x-data='homepageManager(@json($sections ?? []), @json($properties ?? []), @json($featuredProperties ?? []))'
        x-init="init()" class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title">
                    <h4>Homepage Content Management</h4>
                    <h6>Manage content for all sections on your homepage</h6>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                    <li class="breadcrumb-item active">Homepage Sections</li>
                </ul>
            </div>
            <div class="page-header-right">
                <button class="btn btn-success" onclick="window.open('/', '_blank')">
                    <i class="fa fa-external-link"></i> View Live Page
                </button>
            </div>
        </div>

        <!-- Content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Section Management</h5>
                        <span>Control visibility and content for each homepage section</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i data-feather="home" class="me-2"></i>
                            <div>
                                <h5 class="mb-0">Hero Section</h5>
                                <small class="text-muted">Main banner at the top of homepage</small>
                            </div>
                        </div>
                        <label class="switch">
                            <input type="checkbox" x-model="heroSection.is_enabled" @change="toggleSection('hero')">
                            <span class="switch-state"></span>
                        </label>
                    </div>
                    <div class="card-body" x-show="heroSection.is_enabled">
                        <div class="row">
                            <!-- Hero Banner Only -->
                            <div class="col-md-6 mb-4">
                                <div class="section-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <label class="form-label">
                                                <i data-feather="image" class="me-1"></i>Hero Banner Image
                                            </label>
                                            <div class="mt-2" x-show="!showForm.includes('hero_banner')">
                                                <div class="d-flex align-items-center">
                                                    @php $heroBannerBase = asset('storage/tenantclient1/hero_banners'); @endphp
                                                    <img :src="heroSection.data.hero_banner_preview ?
                                                        heroSection.data.hero_banner_preview :
                                                        (heroSection.data.hero_banner ?
                                                            '{{ $heroBannerBase }}/' + (heroSection.data.hero_banner
                                                                .split('/').pop()) :
                                                            '/themes/classic/admin/assets/images/dashboard/default.jpg')"
                                                        alt="Hero Banner" class="img-fluid rounded me-3"
                                                        style="max-width:100px; max-height:60px; object-fit: cover;">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-xs" @click="toggleEditForm('hero_banner')"
                                            type="button">
                                            <span x-show="!showForm.includes('hero_banner')">Edit</span>
                                            <span x-show="showForm.includes('hero_banner')">Cancel</span>
                                        </button>
                                    </div>
                                    <form x-show="showForm.includes('hero_banner')" @submit.prevent="saveHeroBanner()"
                                        class="mt-3">
                                        <div class="form-group d-flex align-items-center">
                                            <label class="form-label mb-0 me-2">Upload Image</label>
                                            <input type="file" name="hero_banner" class="form-control"
                                                @change="handleHeroBannerImageUpload($event)">
                                            <small class="text-info ms-2">Recommended: 1920x800px</small>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                                            <button type="button" class="btn btn-light"
                                                @click="toggleEditForm('hero_banner')">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Carousel Settings -->
                        <div class="section-item mt-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Carousel Items <small>(Max 4)</small></h6>
                                <button class="btn btn-success btn-xs" @click="addCarouselItem" type="button">
                                    <i class="fa fa-plus"></i> Add Carousel
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm align-middle">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Writeup</th>
                                            <th>Hero Title</th>
                                            <th>CTA Button</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="(item, idx) in heroSection.data.carousel_items"
                                            :key="idx">
                                            <tr>
                                                <td x-text="idx + 1"></td>
                                                <td>
                                                    @php $carouselBase = asset('storage/tenantclient1/carousel_images'); @endphp
                                                    <template
                                                        x-if="item.signature_img && (item.signature_img.startsWith('data:') || item.signature_img.endsWith('.jpg') || item.signature_img.endsWith('.jpeg') || item.signature_img.endsWith('.png') || item.signature_img.endsWith('.webp'))">
                                                        <img :src="item.signature_img.startsWith('data:') ? item.signature_img :
                                                            '{{ $carouselBase }}/' + (item.signature_img.split('/')
                                                                .pop())"
                                                            alt="Signature Image"
                                                            style="max-width: 80px; max-height: 50px; object-fit: cover;">
                                                    </template>
                                                    <template
                                                        x-if="!item.signature_img || (!item.signature_img.startsWith('data:') && !item.signature_img.endsWith('.jpg') && !item.signature_img.endsWith('.jpeg') && !item.signature_img.endsWith('.png') && !item.signature_img.endsWith('.webp'))">
                                                        <span class="text-muted">No image</span>
                                                    </template>
                                                </td>
                                                <td x-text="item.signature_writeup"></td>
                                                <td x-text="item.hero_title"></td>
                                                <td x-text="item.cta_button"></td>
                                                <td>
                                                    <button class="btn btn-primary btn-xs me-1"
                                                        @click="editCarouselItem(idx)"><i class="fa fa-edit"></i>
                                                        Edit</button>
                                                    <button class="btn btn-danger btn-xs"
                                                        @click="deleteCarouselItem(idx)"><i class="fa fa-trash"></i>
                                                        Delete</button>
                                                </td>
                                            </tr>
                                        </template>
                                        <template x-if="heroSection.data.carousel_items.length === 0">
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No carousel items</td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Edit Carousel Modal/Form -->
                            <template x-if="showCarouselEdit !== null">
                                <div class="modal fade show d-block" tabindex="-1" style="background:rgba(0,0,0,0.3);"
                                    @click.self="closeCarouselEdit">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Carousel Item</h5>
                                                <button type="button" class="btn-close"
                                                    @click="closeCarouselEdit"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form @submit.prevent="saveCarouselDetails()">
                                                    <div class="mb-2">
                                                        <label>Signature Image</label>
                                                        <input type="file" class="form-control"
                                                            :name="'carousel_img_' + showCarouselEdit"
                                                            @change="handleEditCarouselImage($event)">
                                                        <template x-if="carouselEditItem.signature_img">
                                                            <img :src="carouselEditItem.signature_img"
                                                                class="img-fluid rounded mt-2"
                                                                style="max-width:100px; max-height:60px; object-fit: cover;">
                                                        </template>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label>Signature Writeup</label>
                                                        <textarea class="form-control" x-model="carouselEditItem.signature_writeup"></textarea>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label>Hero Title</label>
                                                        <input type="text" class="form-control"
                                                            x-model="carouselEditItem.hero_title">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label>CTA Button</label>
                                                        <input type="text" class="form-control"
                                                            x-model="carouselEditItem.cta_button">
                                                    </div>
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                        <button type="button" class="btn btn-light ms-2"
                                                            @click="closeCarouselEdit">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Properties Section -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i data-feather="building" class="me-2"></i>
                                <div>
                                    <h5 class="mb-0"> LatestProperties Section</h5>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" x-model="propertiesSection.is_enabled"
                                    @change="toggleSection('properties')">
                                <span class="switch-state"></span>
                            </label>
                        </div>
                        <div class="card-body" x-show="propertiesSection.is_enabled">
                            <!-- Section Title -->
                            <div class="section-item mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Section Title</label>
                                        <div class="mt-2" x-show="!showForm.includes('properties_title')">
                                            <h6 class="mb-0" x-text="propertiesSection.data.title || 'Not Set'">
                                            </h6>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-xs" @click="toggleEditForm('properties_title')"
                                        type="button">
                                        <span x-show="!showForm.includes('properties_title')">Edit</span>
                                        <span x-show="showForm.includes('properties_title')">Cancel</span>
                                    </button>
                                </div>
                                <form x-show="showForm.includes('properties_title')"
                                    @submit.prevent="saveProperty('properties_title')" class="mt-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" x-model="formValues.properties_title"
                                            placeholder="Enter section title">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary me-2">Save</button>
                                        <button type="button" class="btn btn-light"
                                            @click="toggleEditForm('properties_title')">Cancel</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Properties Display Limit -->
                            <div class="section-item mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Number of Latest Properties to Display (Max 6)</label>
                                        <div class="mt-2" x-show="!showForm.includes('properties_limit')">
                                            <span class="text-primary fw-bold"
                                                x-text="(propertiesSection.data.limit || 'Not Set') + ' properties'"></span>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-xs" @click="toggleEditForm('properties_limit')"
                                        type="button">
                                        <span x-show="!showForm.includes('properties_limit')">Edit</span>
                                        <span x-show="showForm.includes('properties_limit')">Cancel</span>
                                    </button>
                                </div>
                                <form x-show="showForm.includes('properties_limit')"
                                    @submit.prevent="saveProperty('properties_limit')" class="mt-3">
                                    <div class="form-group">
                                        <input type="number" class="form-control" x-model="formValues.properties_limit"
                                            placeholder="Number of properties to show" min="1" max="6">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary me-2">Save</button>
                                        <button type="button" class="btn btn-light"
                                            @click="toggleEditForm('properties_limit')">Cancel</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Select Latest for sale Property (Dropdown like Featured) -->
                            <div class="section-item mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Select Latest for sale Property</label>
                                        <div class="mt-2">
                                            <select class="form-control" x-model="selectedLatestPropertyId"
                                                style="max-width: 250px; display: inline-block;">
                                                <option value="" disabled>Select a property</option>
                                                <template x-for="propId in propertiesSection.data.selected"
                                                    :key="typeof propId === 'object' ? propId.property_id : propId">
                                                    <option
                                                        :value="typeof propId === 'object' ? propId.property_id : propId"
                                                        x-text="getPropertyName(typeof propId === 'object' ? propId.property_id : propId)">
                                                    </option>
                                                </template>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-1">
                                        <button class="btn btn-primary btn-xs"
                                            @click="window.open('/management/property/' + selectedLatestPropertyId, '_blank')"
                                            type="button" :disabled="!selectedLatestPropertyId">
                                            <i class="fa fa-eye"></i> View Property
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Featured Properties Section -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i data-feather="star" class="me-2"></i>
                                <div>
                                    <h5 class="mb-0">Featured Properties Section</h5>
                                    <small class="text-muted">Showcase special properties</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" x-model="featuredSection.is_enabled"
                                    @change="toggleSection('featured')">
                                <span class="switch-state"></span>
                            </label>
                        </div>
                        <div class="card-body" x-show="featuredSection.is_enabled">
                            <!-- Section Title -->
                            <div class="section-item mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Section Title</label>
                                        <div class="mt-2" x-show="!showForm.includes('featured_title')">
                                            <h6 class="mb-0" x-text="featuredSection.data.title || 'Not Set'">
                                            </h6>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-xs" @click="toggleEditForm('featured_title')"
                                        type="button">
                                        <span x-show="!showForm.includes('featured_title')">Edit</span>
                                        <span x-show="showForm.includes('featured_title')">Cancel</span>
                                    </button>
                                </div>
                                <form x-show="showForm.includes('featured_title')"
                                    @submit.prevent="saveProperty('featured_title')" class="mt-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" x-model="formValues.featured_title"
                                            placeholder="Enter section title">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary me-2">Save</button>
                                        <button type="button" class="btn btn-light"
                                            @click="toggleEditForm('featured_title')">Cancel</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Number of Featured Properties -->
                            <div class="section-item mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Number of Featured Properties to Display (Max 6)</label>
                                        <div class="mt-2" x-show="!showForm.includes('featured_limit')">
                                            <span class="text-primary fw-bold"
                                                x-text="(featuredSection.data.limit || 'Not Set') + ' properties'"></span>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-xs" @click="toggleEditForm('featured_limit')"
                                        type="button">
                                        <span x-show="!showForm.includes('featured_limit')">Edit</span>
                                        <span x-show="showForm.includes('featured_limit')">Cancel</span>
                                    </button>
                                </div>
                                <form x-show="showForm.includes('featured_limit')"
                                    @submit.prevent="saveProperty('featured_limit')" class="mt-3">
                                    <div class="form-group">
                                        <input type="number" class="form-control" x-model="formValues.featured_limit"
                                            placeholder="Number of featured properties to show" min="1"
                                            max="6">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary me-2">Save</button>
                                        <button type="button" class="btn btn-light"
                                            @click="toggleEditForm('featured_limit')">Cancel</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Select Featured Property -->
                            <div class="section-item mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Select Featured Property</label>
                                        <div class="mt-2">
                                            <select class="form-control" x-model="selectedFeaturedPropertyId"
                                                style="max-width: 250px; display: inline-block;">
                                                <option value="" disabled>Select a property</option>
                                                @foreach ($featuredProperties as $property)
                                                    <option value="{{ $property->id }}">{{ $property->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-1">
                                        <button class="btn btn-primary btn-xs"
                                            @click="window.open('/management/property/' + selectedFeaturedPropertyId, '_blank')"
                                            type="button" :disabled="!selectedFeaturedPropertyId">
                                            <i class="fa fa-eye"></i> View Property
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Testimonials Section -->
                <template x-if="showTestimonialModal">
                    <div class="modal fade show d-block" tabindex="-1" style="background:rgba(0,0,0,0.3);"
                        @click.self="closeTestimonialModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"
                                        x-text="testimonialModalEditIndex !== null ? 'Edit Testimonial' : 'Add Testimonial'">
                                    </h5>
                                    <button type="button" class="btn-close" @click="closeTestimonialModal"></button>
                                </div>
                                <div class="modal-body">
                                    <form @submit.prevent="saveTestimonial">
                                        <div class="mb-2">
                                            <label>Name</label>
                                            <input type="text" class="form-control"
                                                x-model="testimonialModalData.name" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Image</label>
                                            <input type="file" class="form-control"
                                                @change="handleTestimonialImage($event)">
                                            <template x-if="testimonialModalData.image">
                                                <img :src="testimonialModalData._resolved_image || getImageUrl(testimonialModalData
                                                    .image)"
                                                    class="img-fluid rounded mt-2"
                                                    style="max-width:100px; max-height:60px; object-fit: cover;">
                                            </template>
                                        </div>
                                        <div class="mb-2">
                                            <label>Description</label>
                                            <textarea class="form-control" x-model="testimonialModalData.description" required></textarea>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn btn-light ms-2"
                                                @click="closeTestimonialModal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i data-feather="message-circle" class="me-2"></i>
                                <div>
                                    <h5 class="mb-0">Testimonials Section</h5>
                                    <small class="text-muted">Client reviews and feedback</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" x-model="testimonialsSection.is_enabled"
                                    @change="toggleSection('testimonials')">
                                <span class="switch-state"></span>
                            </label>
                        </div>
                        <div x-show="testimonialsSection.is_enabled">
                            <div class="card-body">
                                <!-- Section Title -->
                                <div class="section-item mb-3">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <label class="form-label">Section Title</label>
                                            <!-- Section title for testimonials can be handled separately if needed -->
                                        </div>
                                        <button class="btn btn-primary btn-xs"
                                            @click="toggleEditForm('testimonials_title')" type="button">
                                            <span x-show="!showForm.includes('testimonials_title')">Edit</span>
                                            <span x-show="showForm.includes('testimonials_title')">Cancel</span>
                                        </button>
                                    </div>
                                    <form x-show="showForm.includes('testimonials_title')"
                                        @submit.prevent="saveProperty('testimonials_title')" class="mt-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                x-model="formValues.testimonials_title" placeholder="Enter section title">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary me-2">Save</button>
                                            <button type="button" class="btn btn-light"
                                                @click="toggleEditForm('testimonials_title')">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Testimonials Limit Setter -->

                            <div class="section-item mb-4 p-3 bg-light rounded shadow-sm border">
                                <div class="d-flex flex-wrap justify-content-between align-items-center mb-2 gap-2">
                                    <div class="flex-grow-1">
                                        <label class="form-label mb-1">Number of Testimonials to Display <span
                                                class="text-muted">(Max 6)</span></label>
                                        <div class="mt-1" x-show="!showForm.includes('testimonials_limit')">
                                            <span class="text-primary fw-bold fs-6"
                                                x-text="(testimonialsLimit || 'Not Set') + ' testimonials'"></span>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-primary btn-sm px-3"
                                        @click="toggleEditForm('testimonials_limit')" type="button">
                                        <span x-show="!showForm.includes('testimonials_limit')">Edit</span>
                                        <span x-show="showForm.includes('testimonials_limit')">Cancel</span>
                                    </button>
                                </div>
                                <form x-show="showForm.includes('testimonials_limit')"
                                    @submit.prevent="saveProperty('testimonials_limit')"
                                    class="row g-2 align-items-center mt-2">
                                    <div class="col-auto">
                                        <input type="number" class="form-control form-control-sm" style="width: 180px;"
                                            x-model="formValues.testimonials_limit" placeholder="Number to show"
                                            min="1" max="6">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary btn-sm me-2">Save</button>
                                        <button type="button" class="btn btn-light btn-sm"
                                            @click="toggleEditForm('testimonials_limit')">Cancel</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Testimonials Table UI -->
                            <div class="section-item mt-3 p-3 bg-white rounded shadow-sm border">
                                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                                    <h6 class="mb-0 fw-bold">Testimonials</h6>
                                    <button class="btn btn-success btn-sm px-3 d-flex align-items-center gap-1"
                                        @click="openTestimonialModal()" type="button">
                                        <i class="fa fa-plus"></i> <span>Add Testimonial</span>
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-sm align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 18%">Name</th>
                                                <th style="width: 18%">Image</th>
                                                <th>Description</th>
                                                <th style="width: 20%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template
                                                x-for="(testimonial, idx) in (testimonials || []).slice(0, Number(testimonialsLimit) || (testimonials || []).length)"
                                                :key="testimonial.id || idx">
                                                <tr>
                                                    <td class="align-middle" x-text="testimonial.name"></td>
                                                    <td class="align-middle text-center">
                                                        <template x-if="testimonial.image">
                                                            <img :src="testimonial._resolved_image || getImageUrl(testimonial
                                                                .image)"
                                                                alt="Image" class="rounded border"
                                                                style="max-width: 60px; max-height: 40px; object-fit: cover; background: #f8f9fa;">
                                                        </template>
                                                        <template x-if="!testimonial.image">
                                                            <span class="text-muted small">No image</span>
                                                        </template>
                                                    </td>
                                                    <td class="align-middle"
                                                        style="max-width: 320px; white-space: pre-line; overflow-wrap: anywhere;">
                                                        <span x-text="testimonial.description"></span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <button class="btn btn-primary"
                                                                @click="openTestimonialModal(testimonial, idx)"><i
                                                                    class="fa fa-edit"></i></button>
                                                            <button class="btn btn-danger"
                                                                @click="deleteTestimonial(idx)"><i
                                                                    class="fa fa-trash"></i></button>
                                                            <button class="btn btn-info"
                                                                @click="viewTestimonial(testimonial)"><i
                                                                    class="fa fa-eye"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </template>
                                            <template
                                                x-if="!((testimonials || []).slice(0, Number(testimonialsLimit) || (testimonials || []).length).length)">
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted">No testimonials
                                                        added
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Realtor Section -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i data-feather="users" class="me-2"></i>
                                <div>
                                    <h5 class="mb-0">Realtor Section</h5>
                                    <small class="text-muted">Manage and display your realtors</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" x-model="realtorSection.is_enabled"
                                    @change="toggleSection('realtor')">
                                <span class="switch-state"></span>
                            </label>
                        </div>
                        <div class="card-body" x-show="realtorSection.is_enabled">
                            <!-- Section Title -->
                            <div class="section-item mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Section Title</label>
                                        <div class="mt-2" x-show="!showForm.includes('realtor_title')">
                                            <h6 class="mb-0" x-text="realtorSection.data.title || 'Not Set'"></h6>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-xs" @click="toggleEditForm('realtor_title')"
                                        type="button">
                                        <span x-show="!showForm.includes('realtor_title')">Edit</span>
                                        <span x-show="showForm.includes('realtor_title')">Cancel</span>
                                    </button>
                                </div>
                                <form x-show="showForm.includes('realtor_title')"
                                    @submit.prevent="saveProperty('realtor_title')" class="mt-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" x-model="formValues.realtor_title"
                                            placeholder="Enter section title">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary me-2">Save</button>
                                        <button type="button" class="btn btn-light"
                                            @click="toggleEditForm('realtor_title')">Cancel</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Number of Realtors Section -->
                            <div class="section-item mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Number of Realtors to Display (Max 6)</label>
                                        <div class="mt-2" x-show="!showForm.includes('realtor_limit')">
                                            <span class="text-primary fw-bold"
                                                x-text="(realtorSection.data.limit || 'Not Set') + ' realtors'"></span>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-xs" @click="toggleEditForm('realtor_limit')"
                                        type="button">
                                        <span x-show="!showForm.includes('realtor_limit')">Edit</span>
                                        <span x-show="showForm.includes('realtor_limit')">Cancel</span>
                                    </button>
                                </div>
                                <form x-show="showForm.includes('realtor_limit')"
                                    @submit.prevent="saveProperty('realtor_limit')" class="mt-3">
                                    <div class="form-group">
                                        <input type="number" class="form-control" x-model="formValues.realtor_limit"
                                            placeholder="Number of realtors to show" min="1" max="6">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary me-2">Save</button>
                                        <button type="button" class="btn btn-light"
                                            @click="toggleEditForm('realtor_limit')">Cancel</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Select Realtor -->
                            <div class="section-item mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Homepage Realtors</label>
                                        <div class="mt-2">
                                            <select class="form-control" x-model="selectedRealtorId"
                                                style="max-width: 250px; display: inline-block;">
                                                <option value="" disabled>Select a homepage realtor</option>
                                                <template x-for="item in (realtorSection.data.selected || [])"
                                                    :key="item.realtor_id">
                                                    <option :value="item.realtor_id"
                                                        x-text="getRealtorName(item.realtor_id)"></option>
                                                </template>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-1">
                                        <button class="btn btn-primary btn-xs"
                                            @click="window.open('/management/realtor/' + selectedRealtorId, '_blank')"
                                            type="button" :disabled="!selectedRealtorId">
                                            <i class="fa fa-eye"></i> View Realtor
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cities Section -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i data-feather="map-pin" class="me-2"></i>
                        <div>
                            <h5 class="mb-0">Cities Section</h5>
                            <small class="text-muted">Cities where properties are available</small>
                        </div>
                    </div>
                    <label class="switch">
                        <input type="checkbox" x-model="citiesSection.is_enabled" @change="toggleSection('cities')">
                        <span class="switch-state"></span>
                    </label>
                </div>
                <div class="card-body" x-show="citiesSection.is_enabled">
                    <!-- Section Title -->
                    <div class="section-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <label class="form-label">Section Title</label>
                                <div class="mt-2" x-show="!showForm.includes('cities_title')">
                                    <h6 class="mb-0" x-text="citiesSection.data.title || 'Not Set'"></h6>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-xs" @click="toggleEditForm('cities_title')"
                                type="button">
                                <span x-show="!showForm.includes('cities_title')">Edit</span>
                                <span x-show="showForm.includes('cities_title')">Cancel</span>
                            </button>
                        </div>
                        <form x-show="showForm.includes('cities_title')" @submit.prevent="saveProperty('cities_title')"
                            class="mt-3">
                            <div class="form-group">
                                <input type="text" class="form-control" x-model="formValues.cities_title"
                                    placeholder="Enter section title">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary me-2">Save</button>
                                <button type="button" class="btn btn-light"
                                    @click="toggleEditForm('cities_title')">Cancel</button>
                            </div>
                        </form>
                    </div>

                    <!-- Cities Limit and Add/Remove UI -->
                    <div class="section-item mt-3">
                        <label class="form-label">Add City (Max 20)</label>
                        <div class="d-flex align-items-center gap-2">
                            <select class="form-control" x-model="selectedCityToAdd" style="max-width: 250px;">
                                <option value="" disabled>Select a city</option>
                                <template x-for="city in uniqueCitiesFromProperties" :key="city">
                                    <option :value="city" x-text="city"></option>
                                </template>
                            </select>
                            <button class="btn btn-success btn-xs" type="button" @click="addCity()"
                                :disabled="!selectedCityToAdd || (citiesSection.data.cities && citiesSection.data.cities.length >=
                                    20)">
                                Add
                            </button>
                        </div>
                        <small class="text-muted">Select a city from properties and add to the list (max 20).</small>
                    </div>

                    <div class="section-item mt-2">
                        <label class="form-label">Cities Added</label>
                        <div class="mb-2">
                            <span
                                x-text="(citiesSection.data.cities && citiesSection.data.cities.length) ? citiesSection.data.cities.join(', ') : 'No cities added.'"></span>
                        </div>
                    </div>

                    <div class="section-item mt-2">
                        <label class="form-label">Remove City</label>
                        <div class="d-flex align-items-center gap-2">
                            <select class="form-control" x-model="selectedCityToRemove" style="max-width: 250px;">
                                <option value="" disabled>Select a city to remove</option>
                                <template x-for="city in (citiesSection.data.cities || [])" :key="city">
                                    <option :value="city" x-text="city"></option>
                                </template>
                            </select>
                            <button class="btn btn-danger btn-xs" type="button" @click="removeCity()"
                                :disabled="!selectedCityToRemove">
                                Remove
                            </button>
                        </div>
                    </div>

                    <!-- Cities Description -->
                    <div class="section-item mt-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <button class="btn btn-primary btn-xs" @click="toggleEditForm('cities_description')"
                                type="button">
                                <span x-show="!showForm.includes('cities_description')">Edit</span>
                                <span x-show="showForm.includes('cities_description')">Cancel</span>
                            </button>
                        </div>
                        <form x-show="showForm.includes('cities_description')"
                            @submit.prevent="saveProperty('cities_description')" class="mt-3">
                            <div class="form-group">
                                <textarea class="form-control" x-model="formValues.cities_description" placeholder="Enter section description"
                                    rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary me-2">Save</button>
                                <button type="button" class="btn btn-light"
                                    @click="toggleEditForm('cities_description')">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            // Configure toastr
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 3000,
            };

            // Wait for Alpine.js to be ready
            document.addEventListener('alpine:init', () => {
                Alpine.data('homepageManager', (sections = [], properties = [], featuredProperties = []) => ({
                    sections: sections || [],
                    properties: properties || [],
                    featuredProperties: featuredProperties || [],
                    showTestimonialModal: false,
                    testimonialModalData: {
                        name: '',
                        image: '',
                        description: ''
                    },
                    testimonialModalEditIndex: null,
                    testimonials: [],
                    testimonialsLimit: 6,
                    loadingTestimonials: false,
                    openTestimonialModal(testimonial = null, idx = null) {
                        if (testimonial) {
                            this.testimonialModalData = {
                                ...testimonial
                            };
                            this.testimonialModalEditIndex = idx;
                        } else {
                            this.testimonialModalData = {
                                name: '',
                                image: '',
                                description: ''
                            };
                            this.testimonialModalEditIndex = null;
                        }
                        this.showTestimonialModal = true;
                    },
                    closeTestimonialModal() {
                        this.showTestimonialModal = false;
                        this.testimonialModalData = {
                            name: '',
                            image: '',
                            description: ''
                        };
                        this.testimonialModalEditIndex = null;
                    },
                    handleTestimonialImage(event) {
                        if (event.target.files && event.target.files[0]) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                this.testimonialModalData.image = e.target.result;
                            };
                            reader.readAsDataURL(event.target.files[0]);
                        }
                    },
                    fetchTestimonials() {
                        this.loadingTestimonials = true;
                        fetch('/management/testimonials', {
                                headers: {
                                    'Accept': 'application/json'
                                }
                            })
                            .then(res => res.json())
                            .then(data => {
                                const payload = data.items || (data.data && data.data.items) ? data : (
                                    data.data || data);
                                const items = payload.items || (payload.data && payload.data.items) ||
                                [];
                                this.testimonials = items;
                                this.testimonialsLimit = payload.limit || (payload.data && payload.data
                                    .limit) || 6;
                                this.resolveTestimonialImages();
                                try {
                                    if (this.testimonials && this.testimonials.length > 0) {
                                        if (!this.testimonialsSection) this.testimonialsSection = {};
                                        this.testimonialsSection.is_enabled = true;
                                    }
                                } catch (err) {
                                    console.warn('Could not auto-enable testimonials section', err);
                                }
                            })
                            .catch((e) => {
                                toastr.error('Failed to load testimonials');
                                console.error(e);
                            })
                            .finally(() => {
                                this.loadingTestimonials = false;
                            });
                    },
                    saveTestimonial() {
                        const isEdit = this.testimonialModalEditIndex !== null && this.testimonialModalData
                            .id;
                        const url = isEdit ? `/management/testimonials/${this.testimonialModalData.id}` :
                            '/management/testimonials';
                        const method = isEdit ? 'PUT' : 'POST';
                        fetch(url, {
                                method,
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content')
                                },
                                body: JSON.stringify({
                                    name: this.testimonialModalData.name,
                                    image: this.testimonialModalData.image,
                                    description: this.testimonialModalData.description
                                })
                            })
                            .then(async res => {
                                const contentType = res.headers.get('content-type');
                                let data;
                                if (contentType && contentType.includes('application/json')) {
                                    data = await res.json();
                                } else {
                                    const text = await res.text();
                                    throw new Error('Server error: ' + text);
                                }
                                if (!res.ok) {
                                    if (data && data.errors) {
                                        toastr.error('Validation error: ' + Object.values(data
                                            .errors).join('\n'));
                                    } else {
                                        toastr.error('Error: ' + (data && data.message ? data
                                            .message : 'Unknown error'));
                                    }
                                    throw new Error('Save failed');
                                }
                                if (isEdit) {
                                    const idx = this.testimonials.findIndex(t => t.id === this
                                        .testimonialModalData.id);
                                    if (idx !== -1) this.testimonials[idx] = {
                                        ...this.testimonialModalData,
                                        ...data
                                    };
                                    toastr.success('Testimonial updated!');
                                    this.resolveTestimonialImages();
                                } else {
                                    this.testimonials.push(data);
                                    toastr.success('Testimonial added!');
                                    this.resolveTestimonialImages();
                                }
                                this.closeTestimonialModal();
                            })
                            .catch((e) => {
                                toastr.error('Failed to save testimonial');
                                console.error(e);
                            });
                    },
                    deleteTestimonial(idx) {
                        const testimonial = this.testimonials[idx];
                        if (!testimonial || !testimonial.id) return;
                        if (!confirm('Are you sure you want to delete this testimonial?')) return;
                        fetch(`/management/testimonials/${testimonial.id}`, {
                                method: 'DELETE',
                                headers: {
                                    'Accept': 'application/json'
                                }
                            })
                            .then(res => res.json())
                            .then(() => {
                                this.testimonials.splice(idx, 1);
                                toastr.success('Testimonial deleted!');
                            })
                            .catch(() => toastr.error('Failed to delete testimonial'));
                    },
                    viewTestimonial(testimonial) {
                        alert(`Name: ${testimonial.name}\nDescription: ${testimonial.description}`);
                    },
                    saveTestimonialsLimit() {
                        const newLimit = Number(this.formValues.testimonials_limit) || 6;
                        this.testimonialsLimit = newLimit;
                        if (!this.testimonialsSection) this.testimonialsSection = {
                            data: {}
                        };
                        if (!this.testimonialsSection.data) this.testimonialsSection.data = {};
                        this.testimonialsSection.data.limit = newLimit;

                        fetch('/management/testimonials/limit', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                },
                                body: JSON.stringify({
                                    limit: newLimit
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                this.testimonialsLimit = data.limit || newLimit;
                                if (this.testimonialsSection && this.testimonialsSection.data) {
                                    this.testimonialsSection.data.limit = this.testimonialsLimit;
                                }
                                toastr.success('Limit updated!');
                                this.fetchTestimonials();
                                try {
                                    const items = (this.testimonialsSection && this.testimonialsSection
                                        .data && (this.testimonialsSection.data.items || [])) || [];
                                    this.testimonials = items.slice(0, Number(this.testimonialsLimit) ||
                                        items.length);
                                } catch (e) {
                                    // ignore
                                }
                                this.toggleEditForm('testimonials_limit');
                            })
                            .catch(() => {
                                // Revert on failure
                                toastr.error('Failed to update limit');
                                // Optionally refetch testimonials to restore state
                                this.fetchTestimonials();
                            });
                    },
                    // All realtors for dropdown name resolution
                    allRealtors: (window.allRealtors || []),
                    // Dropdown selection models used in various sections
                    selectedLatestPropertyId: '',
                    selectedRealtorId: '',
                    // Helper to get realtor name by ID
                    getRealtorName(realtorId) {
                        const realtor = this.allRealtors.find(r => r.id == realtorId);
                        if (!realtor) return '';
                        if (realtor.full_name) return realtor.full_name;
                        if (realtor.first_name && realtor.last_name) return realtor.first_name + ' ' +
                            realtor.last_name;
                        if (realtor.user && realtor.user.name) return realtor.user.name;
                        return realtor.name || '';
                    },
                    realtorSection: sections.find(s => s.name === 'realtor') || {
                        is_enabled: false,
                        data: {}
                    },
                    // --- Featured Property Table Modal ---
                    showFeaturedTable: null, // property id
                    allFeaturedProperties: featuredProperties, // All featured properties from DB
                    featuredTableItem: {
                        id: '',
                        img: '',
                        type: '',
                        street: '',
                        city: '',
                        county: '',
                        price: '',
                        writeup: ''
                    },
                    selectedFeaturedPropertyId: '',
                    showAddFeaturedModal: false,
                    newFeaturedProperty: {
                        id: '',
                        img: '',
                        type: '',
                        street: '',
                        city: '',
                        county: '',
                        price: '',
                        writeup: ''
                    },
                    openAddFeaturedModal() {
                        this.newFeaturedProperty = {
                            // id will be generated on save
                            img: '',
                            type: '',
                            street: '',
                            city: '',
                            county: '',
                            price: '',
                            writeup: ''
                        };
                        this.showAddFeaturedModal = true;
                    },
                    closeAddFeaturedModal() {
                        this.showAddFeaturedModal = false;
                    },
                    openFeaturedTable(propId) {
                        if (!propId) return;

                        let prop = this.allFeaturedProperties.find(p => p.id == propId);

                        if (prop) {
                            this.featuredTableItem = {
                                id: prop.id,
                                img: prop.images && prop.images.length > 0 ?
                                    `/storage/properties/${prop.images[0]}` : (prop.image ?
                                        `/storage/properties/${prop.image}` :
                                        'https://via.placeholder.com/80x50?text=No+Img'),
                                type: prop.property_type || 'N/A',
                                street: prop.address || 'N/A',
                                city: prop.city || 'N/A',
                                county: prop.state || 'N/A',
                                price: prop.price ? `₦${Number(prop.price).toLocaleString()}` : 'N/A',
                                writeup: prop.description || 'No description available.'
                            };
                        } else {
                            this.featuredTableItem = {
                                id: propId,
                                img: 'https://via.placeholder.com/80x50?text=Error',
                                type: 'Unknown',
                                street: 'Unknown',
                                city: 'Unknown',
                                county: 'Unknown',
                                price: 'Unknown',
                                writeup: 'Property details not found.'
                            };
                        }
                        this.showFeaturedTable = propId;
                    },
                    closeFeaturedTable() {
                        this.showFeaturedTable = null;
                    },

                    viewPropertyDetails(propertyId) {
                        window.open(`/property/${propertyId}`, '_blank');
                    },
                    heroBannerFile: null,
                    showForm: [],
                    formValues: {},
                    showCarouselEdit: null,
                    carouselEditItem: {
                        signature_img: '',
                        signature_writeup: '',
                        hero_title: '',
                        cta_button: ''
                    },
                    addCarouselItem() {
                        if (!Array.isArray(this.heroSection.data.carousel_items)) {
                            this.heroSection.data.carousel_items = [];
                        }
                        if (this.heroSection.data.carousel_items.length >= 4) {
                            toastr.warning('Maximum of 4 carousel items allowed.');
                            return;
                        }
                        this.heroSection.data.carousel_items.push({
                            id: Date.now() + Math.floor(Math.random() * 10000),
                            signature_img: '',
                            signature_writeup: '',
                            hero_title: '',
                            cta_button: ''
                        });
                        this.heroSection.data.carousel_count = this.heroSection.data.carousel_items.length;
                        this.editCarouselItem(this.heroSection.data.carousel_items.length - 1);
                    },
                    editCarouselItem(idx) {
                        this.showCarouselEdit = idx;
                        this.carouselEditItem = JSON.parse(JSON.stringify(this.heroSection.data
                            .carousel_items[idx]));
                    },
                    closeCarouselEdit() {
                        this.showCarouselEdit = null;
                        this.carouselEditItem = {
                            signature_img: '',
                            signature_writeup: '',
                            hero_title: '',
                            cta_button: ''
                        };
                    },
                    saveCarouselEdit() {
                        if (this.showCarouselEdit !== null) {
                            const item = this.carouselEditItem;
                            if ((item.signature_img && item.signature_img !== '') || (item.hero_title &&
                                    item.hero_title !== '')) {
                                this.heroSection.data.carousel_items[this.showCarouselEdit] = JSON.parse(
                                    JSON.stringify(item));
                                this.heroSection.data.carousel_count = this.heroSection.data.carousel_items
                                    .length;
                                const formData = new FormData();
                                formData.append('name', 'hero');
                                formData.append('is_enabled', this.heroSection.is_enabled === true ?
                                    'true' : 'false');
                                this.heroSection.data.carousel_items.forEach((item, i) => {
                                    if (item._file && typeof item._file === 'object' && item
                                        ._file instanceof File) {
                                        formData.append(`carousel_img_${i}`, item._file);
                                    } else {
                                        formData.append(`carousel_img_path_${i}`, item
                                            .signature_img || '');
                                    }
                                    formData.append(`carousel_id_${i}`, item.id);
                                    formData.append(`carousel_writeup_${i}`, item
                                        .signature_writeup || '');
                                    formData.append(`carousel_title_${i}`, item.hero_title || '');
                                    formData.append(`carousel_cta_${i}`, item.cta_button || '');
                                });
                                formData.append('carousel_count', this.heroSection.data.carousel_count);
                                formData.append('_token', document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'));
                                fetch('/management/sections/hero', {
                                        method: 'POST',
                                        headers: {
                                            'Accept': 'application/json',
                                            'X-Requested-With': 'XMLHttpRequest'
                                        },
                                        body: formData
                                    })
                                    .then(response => response.json())
                                    .then(result => {
                                        if (result.success) {
                                            if (result.carousel_paths && Array.isArray(result
                                                    .carousel_paths)) {
                                                result.carousel_paths.forEach((path, i) => {
                                                    if (path) {
                                                        this.heroSection.data.carousel_items[i]
                                                            .signature_img = path;
                                                        // Remove _file after save
                                                        delete this.heroSection.data
                                                            .carousel_items[i]._file;
                                                    }
                                                });
                                            }
                                            toastr.success('Carousel item saved successfully!');
                                        } else {
                                            toastr.error(result.message ||
                                                'Failed to save carousel item.');
                                        }
                                        this.closeCarouselEdit();
                                    })
                                    .catch(() => {
                                        toastr.error('An error occurred while saving carousel item.');
                                        this.closeCarouselEdit();
                                    });
                            } else {
                                // If user closes without saving any data, remove the placeholder
                                this.heroSection.data.carousel_items.splice(this.showCarouselEdit, 1);
                                this.heroSection.data.carousel_count = this.heroSection.data.carousel_items
                                    .length;
                                this.closeCarouselEdit();
                            }
                        }
                    },

                    async resolveTestimonialImages() {
                        if (!this.testimonials || !this.testimonials.length) return;
                        const origin = window.location.origin;
                        await Promise.all(this.testimonials.map(async (t) => {
                            t._resolved_image = null;
                            const raw = t.image || '';
                            if (!raw) return;
                            if (/^data:/i.test(raw) || /^https?:\/\//i.test(raw)) {
                                t._resolved_image = raw;
                                return;
                            }
                            // Prepare filename if present
                            const filename = (raw.split('/').pop() || '').trim();
                            const candidates = [];

                            if (raw.startsWith('/storage') || raw.startsWith(
                                    'storage')) {
                                const path = raw.startsWith('/') ? raw : '/' + raw;
                                candidates.push(origin + path);
                                // tenant prefixed
                                candidates.push(origin + '/storage/tenantclient1' + path
                                    .replace(/^\/storage/, ''));
                            } else if (raw.includes('/storage/')) {
                                const idx = raw.indexOf('/storage/');
                                candidates.push(origin + raw.slice(idx));
                                candidates.push(origin + '/storage/tenantclient1' + raw
                                    .slice(idx + '/storage'.length));
                            } else {
                                // plain filename or relative path
                                if (filename) {
                                    candidates.push(origin + '/storage/testimonials/' +
                                        filename);
                                    candidates.push(origin +
                                        '/storage/tenantclient1/testimonials/' +
                                        filename);
                                    candidates.push(origin + '/storage/' + filename);
                                }
                                // also try raw as relative
                                candidates.push(origin + '/' + raw.replace(/^\//, ''));
                            }

                            for (const url of candidates) {
                                try {
                                    // Use HEAD to check quickly
                                    const res = await fetch(url, {
                                        method: 'HEAD'
                                    });
                                    if (res.ok) {
                                        t._resolved_image = url;
                                        break;
                                    }
                                } catch (err) {
                                    // ignore and try next
                                }
                            }
                        }));
                    },
                    deleteCarouselItem(idx) {
                        if (Array.isArray(this.heroSection.data.carousel_items)) {
                            // Find the item by id
                            const itemToDelete = this.heroSection.data.carousel_items[idx];
                            if (!itemToDelete || itemToDelete.id === undefined) return;
                            if (this.deletingCarouselIdx !== undefined && this.deletingCarouselIdx !== null)
                                return;
                            this.deletingCarouselIdx = idx;
                            // Remove the item by id
                            this.heroSection.data.carousel_items = this.heroSection.data.carousel_items
                                .filter(item => item.id !== itemToDelete.id);
                            this.heroSection.data.carousel_count = this.heroSection.data.carousel_items
                                .length;
                            // Always send the full, up-to-date carousel_items array
                            const formData = new FormData();
                            formData.append('name', 'hero');
                            formData.append('is_enabled', this.heroSection.is_enabled === true ? 'true' :
                                'false');
                            this.heroSection.data.carousel_items.forEach((item, i) => {
                                if (item._file && typeof item._file === 'object' && item
                                    ._file instanceof File) {
                                    formData.append(`carousel_img_${i}`, item._file);
                                } else {
                                    formData.append(`carousel_img_path_${i}`, item.signature_img ||
                                        '');
                                }
                                formData.append(`carousel_id_${i}`, item.id);
                                formData.append(`carousel_writeup_${i}`, item.signature_writeup ||
                                    '');
                                formData.append(`carousel_title_${i}`, item.hero_title || '');
                                formData.append(`carousel_cta_${i}`, item.cta_button || '');
                            });
                            formData.append('carousel_count', this.heroSection.data.carousel_count);
                            formData.append('_token', document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'));
                            fetch('/management/sections/hero', {
                                    method: 'POST',
                                    headers: {
                                        'Accept': 'application/json',
                                        'X-Requested-With': 'XMLHttpRequest'
                                    },
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(result => {
                                    this.deletingCarouselIdx = null;
                                    if (result.success) {
                                        toastr.success('Carousel item deleted.');
                                    } else {
                                        toastr.error(result.message ||
                                            'Failed to delete carousel item.');
                                    }
                                })
                                .catch(() => {
                                    this.deletingCarouselIdx = null;
                                    toastr.error('An error occurred while deleting carousel item.');
                                });
                        }
                    },
                    handleEditCarouselImage(event) {
                        if (event.target.files && event.target.files[0]) {
                            // Only assign a real File object
                            this.carouselEditItem._file = event.target.files[0];
                            // For preview, still show base64
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                this.carouselEditItem.signature_img = e.target.result;
                            };
                            reader.readAsDataURL(event.target.files[0]);
                        } else {
                            // If cleared, set to null
                            this.carouselEditItem._file = null;
                        }
                    },
                    handleHeroBannerImageUpload(event) {
                        if (event.target.files && event.target.files[0]) {
                            this.heroBannerFile = event.target.files[0];
                            // For preview
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                this.heroSection.data.hero_banner_preview = e.target.result;
                            };
                            reader.readAsDataURL(event.target.files[0]);
                        }
                        if (event.target.files && event.target.files[0]) {
                            // Store the file object for FormData upload
                            this.carouselEditItem._file = event.target.files[0];
                            // For preview, still show base64
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                this.carouselEditItem.signature_img = e.target.result;
                            };
                            reader.readAsDataURL(event.target.files[0]);
                        }
                    },

                    // Dynamically initialize section data from backend
                    heroSection: (() => {
                        const hero = sections.find(s => s.name === 'hero') || {
                            is_enabled: false,
                            data: {}
                        };
                        // Ensure carousel properties exist
                        if (!hero.data.carousel_count) hero.data.carousel_count = 1;
                        if (!Array.isArray(hero.data.carousel_items)) hero.data.carousel_items = [];
                        // Initialize carousel items if missing
                        if (hero.data.carousel_items.length < hero.data.carousel_count) {
                            for (let i = hero.data.carousel_items.length; i < hero.data
                                .carousel_count; i++) {
                                hero.data.carousel_items.push({
                                    signature_img: '',
                                    signature_writeup: '',
                                    hero_title: '',
                                    cta_button: ''
                                });
                            }
                        } else if (hero.data.carousel_items.length > hero.data.carousel_count) {
                            hero.data.carousel_items = hero.data.carousel_items.slice(0, hero.data
                                .carousel_count);
                        }
                        return hero;
                    })(),
                    propertiesSection: sections.find(s => s.name === 'properties') || {
                        is_enabled: false,
                        data: {
                            limit: 6,
                            selected_properties: []
                        }
                    },
                    featuredSection: sections.find(s => s.name === 'featured') || {
                        is_enabled: false,
                        data: {
                            limit: 6,
                            selected_properties: []
                        }
                    },
                    testimonialsSection: sections.find(s => s.name === 'testimonials') || {
                        // Will be initialized in init()
                    },
                    
                    getImageUrl(src) {
                        if (!src) return src;
                        
                        if (/^https?:\/\//i.test(src)) return src;

                        
                        if (src.startsWith('/storage') || src.startsWith('storage')) {
                            return window.location.origin + (src.startsWith('/') ? '' : '/') + src;
                        }

                        
                        if (src.indexOf('/storage/') !== -1) {
                            const idx = src.indexOf('/storage/');
                            return window.location.origin + src.slice(idx);
                        }

                        
                        if (!src.includes('/') && src.match(/\.(png|jpe?g|webp|gif)$/i)) {
                            return window.location.origin + '/storage/tenantclient1/testimonials/' + src;
                        }

                        
                        if (src.match(/testimonials\/.+\.(png|jpe?g|webp|gif)$/i)) {
                            // Ensure leading slash
                            return window.location.origin + '/' + src.replace(/^\//, '');
                        }

                        
                        return src;
                    },
                    aboutSection: sections.find(s => s.name === 'about') || {
                        is_enabled: false,
                        data: {}
                    },
                    citiesSection: sections.find(s => s.name === 'cities') || {
                        is_enabled: false,
                        data: {}
                    },

                    // --- Cities Section Logic ---
                    selectedCityToAdd: '',
                    selectedCityToRemove: '',
                    // Use backend-provided uniqueCities array for dropdown
                    get uniqueCitiesFromProperties() {
                        const added = (this.citiesSection.data.cities || []);
                        return (window.uniqueCities || []).filter(city => !added.includes(city));
                    },
                    addCity() {
                        if (!this.selectedCityToAdd) return;
                        if (!this.citiesSection.data.cities) this.citiesSection.data.cities = [];
                        if (this.citiesSection.data.cities.length >= 20) {
                            toastr.warning('Maximum of 20 cities allowed.');
                            return;
                        }
                        if (!this.citiesSection.data.cities.includes(this.selectedCityToAdd)) {
                            this.citiesSection.data.cities.push(this.selectedCityToAdd);
                            const addedCity = this.selectedCityToAdd;
                            this.saveSectionData('cities', this.citiesSection, () => {
                                toastr.success(`City added: ${addedCity}`);
                            });
                            this.selectedCityToAdd = '';
                        }
                    },
                    removeCity() {
                        if (!this.selectedCityToRemove) return;
                        if (!this.citiesSection.data.cities) return;
                        const removedCity = this.selectedCityToRemove;
                        this.citiesSection.data.cities = this.citiesSection.data.cities.filter(city =>
                            city !== this.selectedCityToRemove);
                        this.saveSectionData('cities', this.citiesSection, () => {
                            toastr.success(`City removed: ${removedCity}`);
                        });
                        this.selectedCityToRemove = '';
                    },

                    updateCarouselCount() {
                        const count = Number(this.heroSection.data.carousel_count) || 1;
                        if (!Array.isArray(this.heroSection.data.carousel_items)) this.heroSection.data
                            .carousel_items = [];
                        if (this.heroSection.data.carousel_items.length < count) {
                            for (let i = this.heroSection.data.carousel_items.length; i < count; i++) {
                                this.heroSection.data.carousel_items.push({
                                    signature_img: '',
                                    signature_writeup: '',
                                    hero_title: '',
                                    cta_button: ''
                                });
                            }
                        } else if (this.heroSection.data.carousel_items.length > count) {
                            this.heroSection.data.carousel_items = this.heroSection.data.carousel_items
                                .slice(0, count);
                        }
                    },

                    saveCarouselCount() {
                        let count = Number(this.formValues.carousel_count) || 0;
                        if (count > 4) {
                            toastr.warning('Maximum carousel items is 4.');
                            count = 4;
                        }
                        this.heroSection.data.carousel_count = count;
                        // Adjust carousel_items array
                        if (!Array.isArray(this.heroSection.data.carousel_items)) this.heroSection.data
                            .carousel_items = [];
                        if (this.heroSection.data.carousel_items.length < count) {
                            for (let i = this.heroSection.data.carousel_items.length; i < count; i++) {
                                this.heroSection.data.carousel_items.push({
                                    signature_img: '',
                                    signature_writeup: '',
                                    hero_title: '',
                                    cta_button: ''
                                });
                            }
                        } else if (this.heroSection.data.carousel_items.length > count) {
                            this.heroSection.data.carousel_items = this.heroSection.data.carousel_items
                                .slice(0, count);
                        }
                        toastr.success('Carousel number updated successfully!');
                    },

                    init() {
                        this.testimonialsSection = this.sections.find(s => s.name === 'testimonials') || {
                            is_enabled: false,
                            data: {
                                items: [],
                                limit: 6
                            }
                        };
                        if (!this.testimonialsSection.data.items) this.testimonialsSection.data.items = [];
                        // Fetch testimonials from backend on page load
                        this.fetchTestimonials();
                        // Initialize Feather icons after component loads
                        this.$nextTick(() => {
                            if (typeof feather !== 'undefined') {
                                feather.replace();
                            }
                        });
                    },

                    toggleEditForm(formKey) {
                        if (this.showForm.includes(formKey)) {
                            this.showForm = this.showForm.filter(item => item !== formKey);
                        } else {
                            this.showForm.push(formKey);
                            this.setFormValue(formKey);
                        }
                    },

                    allProperties: properties, // Store all properties for dropdowns

                    setFormValue(formKey) {
                        const [section, property] = formKey.split('_');
                        const sectionData = this[`${section}Section`];

                        if (sectionData && sectionData.data && sectionData.data[property]) {
                            this.formValues[formKey] = sectionData.data[property];
                        } else {
                            // Special handling for multi-select dropdowns
                            if (formKey.includes('selected_properties')) {
                                this.formValues[formKey] = [];
                            } else {
                                this.formValues[formKey] = '';
                            }
                        }
                    },

                    getPropertyName(propertyId) {
                        const property = this.allProperties.find(p => p.id === propertyId);
                        
                        return property ? property.name : '';
                    },

                    saveProperty(formKey) {
                        const [section, property] = formKey.split('_');
                        const sectionData = this[`${section}Section`];

                        if (sectionData) {
                            if (!sectionData.data) {
                                sectionData.data = {};
                            }
                            sectionData.data[property] = this.formValues[formKey];
                        }

                        this.saveSectionData(section, sectionData);
                        this.toggleEditForm(formKey);
                    },

                    toggleSection(sectionName) {
                        const sectionData = this[`${sectionName}Section`];
                        if (sectionData) {
                            
                            this.saveSectionData(sectionName, sectionData);
                        }
                    },

                    saveSectionData(sectionName, sectionData) {
                        // Accept an optional callback to run after a successful save
                        let callback = null;
                        if (arguments.length > 2 && typeof arguments[2] === 'function') {
                            callback = arguments[2];
                        }
                        // saving section
                        fetch(`/management/sections/${sectionName}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: JSON.stringify({
                                    name: sectionName,
                                    is_enabled: sectionData.is_enabled,
                                    data: sectionData.data
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    return response.json().catch(() => {
                                        throw new Error(
                                            `Server responded with status ${response.status}. Expected JSON response but got non-JSON.`
                                        );
                                    });
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    toastr.success('Section updated successfully!');
                                    // If backend returned the saved section object, apply it to local state
                                    if (data.section) {
                                        try {
                                            const s = data.section;
                                            const key = s.name + 'Section';
                                            // preserve is_enabled and data
                                            this[key] = this[key] || {};
                                            this[key].is_enabled = s.is_enabled;
                                            this[key].data = s.data || this[key].data || {};

                                            // If testimonials, sync limit and items immediately
                                            if (s.name === 'testimonials') {
                                                this.testimonialsLimit = Number(this[key].data.limit) ||
                                                    this.testimonialsLimit;
                                                const items = this[key].data.items || [];
                                                this.testimonials = items.slice(0, Number(this
                                                    .testimonialsLimit) || items.length);
                                                // Resolve images for newly synced items
                                                this.resolveTestimonialImages();
                                            }
                                        } catch (err) {
                                            console.warn('Failed to apply returned section to state',
                                                err);
                                        }
                                    }
                                    if (callback) callback();
                                } else {
                                    toastr.error(data.message || 'Failed to save section');
                                    throw new Error(data.message || 'Save failed');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                toastr.error('Failed to save section: ' + (error.message ||
                                    'An unknown error occurred.'));
                            });
                    },

                    async saveCarouselDetails() {
                        // Only save the currently edited carousel item
                        if (this.showCarouselEdit === null) return;
                        const idx = this.showCarouselEdit;
                        const item = this.carouselEditItem;
                        
                        const hasExistingImage = item.signature_img && typeof item.signature_img ===
                            'string' && item.signature_img !== '' && !item.signature_img.startsWith(
                                'data:');
                        const hasBase64Image = item.signature_img && typeof item.signature_img ===
                            'string' && item.signature_img.startsWith('data:');
                        if (!item._file && !hasExistingImage && !hasBase64Image) {
                            toastr.error('Please select an image for the carousel item.');
                            return;
                        }
                        
                        this.heroSection.data.carousel_items[idx] = JSON.parse(JSON.stringify(item));
                        
                        this.heroSection.data.carousel_count = this.heroSection.data.carousel_items
                            .length;
                        
                        const formData = new FormData();
                        formData.append('name', 'hero');
                        formData.append('is_enabled', this.heroSection.is_enabled === true ? 'true' :
                            'false');
                        this.heroSection.data.carousel_items.forEach((item, i) => {
                            if (item._file && typeof item._file === 'object' && item
                                ._file instanceof File) {
                                formData.append(`carousel_img_${i}`, item._file);
                            } else {
                                formData.append(`carousel_img_path_${i}`, item.signature_img ||
                                    '');
                            }
                            formData.append(`carousel_id_${i}`, item.id);
                            formData.append(`carousel_writeup_${i}`, item.signature_writeup ||
                                '');
                            formData.append(`carousel_title_${i}`, item.hero_title || '');
                            formData.append(`carousel_cta_${i}`, item.cta_button || '');
                        });
                        formData.append('carousel_count', this.heroSection.data.carousel_count);
                        formData.append('_token', document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'));
                        try {
                            const response = await fetch('/management/sections/hero', {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: formData
                            });
                            const result = await response.json();
                            if (result.success) {
                                toastr.success('Carousel item saved successfully!');
                                this.closeCarouselEdit();
                            } else {
                                toastr.error(result.message || 'Failed to save carousel item.');
                                this.closeCarouselEdit();
                            }
                        } catch (error) {
                            toastr.error('An error occurred while saving carousel item.');
                            this.closeCarouselEdit();
                        }
                    },
                    async saveHeroBanner() {
                        try {
                            const formData = new FormData();
                            formData.append('name', 'hero');
                            formData.append('is_enabled', this.heroSection.is_enabled === true ?
                                'true' : 'false');
                            // Hero banner image
                            if (this.heroBannerFile) {
                                formData.append('hero_banner', this.heroBannerFile);
                            }
                            // Always send the full, up-to-date carousel_items array
                            this.heroSection.data.carousel_items.forEach((item, idx) => {
                                if (item._file && typeof item._file === 'object' && item
                                    ._file instanceof File) {
                                    formData.append(`carousel_img_${idx}`, item._file);
                                } else {
                                    formData.append(`carousel_img_path_${idx}`, item
                                        .signature_img || '');
                                }
                                formData.append(`carousel_id_${idx}`, item.id);
                                formData.append(`carousel_writeup_${idx}`, item
                                    .signature_writeup || '');
                                formData.append(`carousel_title_${idx}`, item.hero_title || '');
                                formData.append(`carousel_cta_${idx}`, item.cta_button || '');
                            });
                            formData.append('carousel_count', this.heroSection.data.carousel_count);
                            formData.append('_token', document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'));
                            const response = await fetch('/management/sections/hero', {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: formData
                            });
                            const result = await response.json();
                            if (result.success) {
                                toastr.success('Hero banner and carousel details saved successfully!');
                                if (result.path) {
                                    this.heroSection.data.hero_banner = result.path;
                                }
                                this.toggleEditForm('hero_banner');
                                this.heroBannerFile = null;
                            } else {
                                toastr.error(result.message ||
                                    'Failed to update hero banner or carousel.');
                            }
                        } catch (error) {
                            toastr.error('An error occurred while saving hero banner or carousel.');
                        }
                    }
                }));
            });
        </script>
    @endpush

@endsection
