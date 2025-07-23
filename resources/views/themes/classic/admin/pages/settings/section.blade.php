@extends('themes.classic.admin.admin_master')
@section('title', 'Homepage Content Management | Premium Refined Luxury Homes')

<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')

    <div x-data='homepageManager(@json($sections ?? []), @json($properties ?? []))' x-init="init()"
        class="container-fluid">
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
                                <h6 class="mb-0">Carousel Items</h6>
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
                                    <h5 class="mb-0">Properties Section</h5>
                                    <small class="text-muted">Latest properties display</small>
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

                            <!-- Section Label -->
                            <div class="section-item mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Section Label</label>
                                        <div class="mt-2" x-show="!showForm.includes('properties_label')">
                                            <span class="badge badge-primary"
                                                x-text="propertiesSection.data.label || 'Not Set'"></span>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-xs" @click="toggleEditForm('properties_label')"
                                        type="button">
                                        <span x-show="!showForm.includes('properties_label')">Edit</span>
                                        <span x-show="showForm.includes('properties_label')">Cancel</span>
                                    </button>
                                </div>
                                <form x-show="showForm.includes('properties_label')"
                                    @submit.prevent="saveProperty('properties_label')" class="mt-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" x-model="formValues.properties_label"
                                            placeholder="Enter section label">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary me-2">Save</button>
                                        <button type="button" class="btn btn-light"
                                            @click="toggleEditForm('properties_label')">Cancel</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Properties Display Limit -->
                            <div class="section-item mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Number of Properties to Display (Max 6)</label>
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

                            <!-- Select Properties -->
                            <div class="section-item mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Select Properties</label>
                                        <div class="mt-2" x-show="!showForm.includes('properties_selected_properties')">
                                            <template
                                                x-if="propertiesSection.data.selected_properties && propertiesSection.data.selected_properties.length > 0">
                                                <ul class="list-group">
                                                    <template x-for="propId in propertiesSection.data.selected_properties"
                                                        :key="propId">
                                                        <li class="list-group-item" x-text="getPropertyName(propId)"></li>
                                                    </template>
                                                </ul>
                                            </template>
                                            <span x-else class="text-muted">No properties selected</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-xs"
                                        @click="toggleEditForm('properties_selected_properties')" type="button">
                                        <span x-show="!showForm.includes('properties_selected_properties')">Edit</span>
                                        <span x-show="showForm.includes('properties_selected_properties')">Cancel</span>
                                    </button>
                                </div>
                                <form x-show="showForm.includes('properties_selected_properties')"
                                    @submit.prevent="saveProperty('properties_selected_properties')" class="mt-3">
                                    <div class="form-group">
                                        <select class="form-control" x-model="formValues.properties_selected_properties"
                                            multiple size="6">
                                            <template x-for="property in allProperties" :key="property.id">
                                                <option :value="property.id" x-text="property.name"></option>
                                            </template>
                                        </select>
                                        <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple properties
                                            (Max
                                            6)</small>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary me-2">Save</button>
                                        <button type="button" class="btn btn-light"
                                            @click="toggleEditForm('properties_selected_properties')">Cancel</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Properties Description -->
                            <div class="section-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Section Description</label>
                                        <div class="mt-2" x-show="!showForm.includes('properties_description')">
                                            <p class="mb-0 text-muted"
                                                x-text="propertiesSection.data.description || 'Not Set'">
                                            </p>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-xs"
                                        @click="toggleEditForm('properties_description')" type="button">
                                        <span x-show="!showForm.includes('properties_description')">Edit</span>
                                        <span x-show="showForm.includes('properties_description')">Cancel</span>
                                    </button>
                                </div>
                                <form x-show="showForm.includes('properties_description')"
                                    @submit.prevent="saveProperty('properties_description')" class="mt-3">
                                    <div class="form-group">
                                        <textarea class="form-control" x-model="formValues.properties_description" placeholder="Enter section description"
                                            rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary me-2">Save</button>
                                        <button type="button" class="btn btn-light"
                                            @click="toggleEditForm('properties_description')">Cancel</button>
                                    </div>
                                </form>
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

                            <!-- Select Featured Properties -->
                            <div class="section-item mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Select Featured Properties (Max 6)</label>
                                        <div class="mt-2" x-show="!showForm.includes('featured_selected_properties')">
                                            <template
                                                x-if="featuredSection.data.selected_properties && featuredSection.data.selected_properties.length > 0">
                                                <ul class="list-group">
                                                    <template x-for="propId in featuredSection.data.selected_properties"
                                                        :key="propId">
                                                        <li class="list-group-item" x-text="getPropertyName(propId)"></li>
                                                    </template>
                                                </ul>
                                            </template>
                                            <span x-else class="text-muted">No featured properties selected</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-xs"
                                        @click="toggleEditForm('featured_selected_properties')" type="button">
                                        <span x-show="!showForm.includes('featured_selected_properties')">Edit</span>
                                        <span x-show="showForm.includes('featured_selected_properties')">Cancel</span>
                                    </button>
                                </div>
                                <form x-show="showForm.includes('featured_selected_properties')"
                                    @submit.prevent="saveProperty('featured_selected_properties')" class="mt-3">
                                    <div class="form-group">
                                        <select class="form-control" x-model="formValues.featured_selected_properties"
                                            multiple size="6">
                                            <template x-for="property in allProperties" :key="property.id">
                                                <option :value="property.id" x-text="property.name"></option>
                                            </template>
                                        </select>
                                        <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple properties
                                            (Max
                                            6)</small>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary me-2">Save</button>
                                        <button type="button" class="btn btn-light"
                                            @click="toggleEditForm('featured_selected_properties')">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonials Section -->
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
                        <div class="card-body" x-show="testimonialsSection.is_enabled">
                            <!-- Section Title -->
                            <div class="section-item mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Section Title</label>
                                        <div class="mt-2" x-show="!showForm.includes('testimonials_title')">
                                            <h6 class="mb-0" x-text="testimonialsSection.data.title || 'Not Set'">
                                            </h6>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-xs" @click="toggleEditForm('testimonials_title')"
                                        type="button">
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

                            <!-- Section Label -->
                            <div class="section-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Section Label</label>
                                        <div class="mt-2" x-show="!showForm.includes('testimonials_label')">
                                            <span class="badge badge-primary"
                                                x-text="testimonialsSection.data.label || 'Not Set'"></span>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-xs" @click="toggleEditForm('testimonials_label')"
                                        type="button">
                                        <span x-show="!showForm.includes('testimonials_label')">Edit</span>
                                        <span x-show="showForm.includes('testimonials_label')">Cancel</span>
                                    </button>
                                </div>
                                <form x-show="showForm.includes('testimonials_label')"
                                    @submit.prevent="saveProperty('testimonials_label')" class="mt-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control"
                                            x-model="formValues.testimonials_label" placeholder="Enter section label">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary me-2">Save</button>
                                        <button type="button" class="btn btn-light"
                                            @click="toggleEditForm('testimonials_label')">Cancel</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Testimonials Description -->
                            <div class="section-item mt-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Section Description</label>
                                        <div class="mt-2" x-show="!showForm.includes('testimonials_description')">
                                            <p class="mb-0 text-muted"
                                                x-text="testimonialsSection.data.description || 'Not Set'">
                                            </p>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-xs"
                                        @click="toggleEditForm('testimonials_description')" type="button">
                                        <span x-show="!showForm.includes('testimonials_description')">Edit</span>
                                        <span x-show="showForm.includes('testimonials_description')">Cancel</span>
                                    </button>
                                </div>
                                <form x-show="showForm.includes('testimonials_description')"
                                    @submit.prevent="saveProperty('testimonials_description')" class="mt-3">
                                    <div class="form-group">
                                        <textarea class="form-control" x-model="formValues.testimonials_description" placeholder="Enter section description"
                                            rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary me-2">Save</button>
                                        <button type="button" class="btn btn-light"
                                            @click="toggleEditForm('testimonials_description')">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- About & Cities Sections -->
            <div class="row">
                <!-- About Section -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i data-feather="users" class="me-2"></i>
                                <div>
                                    <h5 class="mb-0">About/Realtor Section</h5>
                                    <small class="text-muted">Company and team information</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" x-model="aboutSection.is_enabled"
                                    @change="toggleSection('about')">
                                <span class="switch-state"></span>
                            </label>
                        </div>
                        <div class="card-body" x-show="aboutSection.is_enabled">
                            <!-- Section Title -->
                            <div class="section-item mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Section Title</label>
                                        <div class="mt-2" x-show="!showForm.includes('about_title')">
                                            <h6 class="mb-0" x-text="aboutSection.data.title || 'Not Set'"></h6>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-xs" @click="toggleEditForm('about_title')"
                                        type="button">
                                        <span x-show="!showForm.includes('about_title')">Edit</span>
                                        <span x-show="showForm.includes('about_title')">Cancel</span>
                                    </button>
                                </div>
                                <form x-show="showForm.includes('about_title')"
                                    @submit.prevent="saveProperty('about_title')" class="mt-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" x-model="formValues.about_title"
                                            placeholder="Enter section title">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary me-2">Save</button>
                                        <button type="button" class="btn btn-light"
                                            @click="toggleEditForm('about_title')">Cancel</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Company Description -->
                            <div class="section-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Company Description</label>
                                        <div class="mt-2" x-show="!showForm.includes('about_description')">
                                            <p class="mb-0 text-muted"
                                                x-text="aboutSection.data.description || 'Not Set'">
                                            </p>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-xs" @click="toggleEditForm('about_description')"
                                        type="button">
                                        <span x-show="!showForm.includes('about_description')">Edit</span>
                                        <span x-show="showForm.includes('about_description')">Cancel</span>
                                    </button>
                                </div>
                                <form x-show="showForm.includes('about_description')"
                                    @submit.prevent="saveProperty('about_description')" class="mt-3">
                                    <div class="form-group">
                                        <textarea class="form-control" x-model="formValues.about_description" placeholder="Enter company description"
                                            rows="4"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary me-2">Save</button>
                                        <button type="button" class="btn btn-light"
                                            @click="toggleEditForm('about_description')">Cancel</button>
                                    </div>
                                </form>
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
                                <input type="checkbox" x-model="citiesSection.is_enabled"
                                    @change="toggleSection('cities')">
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
                                <form x-show="showForm.includes('cities_title')"
                                    @submit.prevent="saveProperty('cities_title')" class="mt-3">
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

                            <!-- Cities Description -->
                            <div class="section-item mt-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Section Description</label>
                                        <div class="mt-2" x-show="!showForm.includes('cities_description')">
                                            <p class="mb-0 text-muted"
                                                x-text="citiesSection.data.description || 'Not Set'">
                                            </p>
                                        </div>
                                    </div>
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
                    Alpine.data('homepageManager', (sections = [], properties = []) => ({
                        heroBannerFile: null,
                        showForm: [],
                        formValues: {},
                        showCarouselEdit: null, // index of carousel being edited or null
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
                            // Add a placeholder for the new item with a unique id
                            this.heroSection.data.carousel_items.push({
                                id: Date.now() + Math.floor(Math.random() * 10000),
                                signature_img: '',
                                signature_writeup: '',
                                hero_title: '',
                                cta_button: ''
                            });
                            // Always update carousel_count to match the array length
                            this.heroSection.data.carousel_count = this.heroSection.data.carousel_items.length;
                            // Open the edit modal for the new item (user must save to persist)
                            this.editCarouselItem(this.heroSection.data.carousel_items.length - 1);
                        },
                        editCarouselItem(idx) {
                            this.showCarouselEdit = idx;
                            // Deep copy to avoid live editing until save
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
                                // Only persist if the item has at least an image or a title (avoid empty items)
                                const item = this.carouselEditItem;
                                if ((item.signature_img && item.signature_img !== '') || (item.hero_title &&
                                        item.hero_title !== '')) {
                                    this.heroSection.data.carousel_items[this.showCarouselEdit] = JSON.parse(
                                        JSON.stringify(item));
                                    // Always update carousel_count to match the array length
                                    this.heroSection.data.carousel_count = this.heroSection.data.carousel_items
                                        .length;
                                    // Always send the full, up-to-date carousel_items array
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
                            is_enabled: false,
                            data: {}
                        },
                        aboutSection: sections.find(s => s.name === 'about') || {
                            is_enabled: false,
                            data: {}
                        },
                        citiesSection: sections.find(s => s.name === 'cities') || {
                            is_enabled: false,
                            data: {}
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
                            return property ? property.name : `Property ID: ${propertyId} (Not Found)`;
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
                                // The x-model on the checkbox already toggles the is_enabled property,
                                // so we just need to call the save function.
                                this.saveSectionData(sectionName, sectionData);
                            }
                        },

                        saveSectionData(sectionName, sectionData) {
                            console.log('Saving section:', sectionName, sectionData);
                            fetch(`/management/sections/${sectionName}`, {
                                    method: 'POST',
                                    headers: { // Correct headers object
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute(
                                            'content'),
                                        'Accept': 'application/json',
                                        'X-Requested-With': 'XMLHttpRequest' // Add this for Laravel AJAX detection
                                    },
                                    body: JSON.stringify({ // 'body' is a sibling of 'headers'
                                        name: sectionName,
                                        is_enabled: sectionData.is_enabled,
                                        data: sectionData.data
                                    })
                                })
                                .then(response => {
                                    // If response is not OK (e.g., 401, 403, 422), try to parse JSON anyway
                                    // Laravel often sends JSON error responses for AJAX requests
                                    if (!response.ok) {
                                        // Attempt to parse as JSON, but catch if it's not
                                        return response.json().catch(() => {
                                            // If it's not JSON (e.g., HTML from 302 redirect),
                                            // throw a more informative error
                                            throw new Error(
                                                `Server responded with status ${response.status}. Expected JSON response but got non-JSON.`
                                            );
                                        });
                                    }
                                    // If response is OK, parse as JSON
                                    return response.json();
                                })
                                .then(data => {
                                    if (data.success) {
                                        toastr.success('Section updated successfully!');
                                    } else {
                                        // Display specific error message from backend if available
                                        toastr.error(data.message || 'Failed to save section');
                                        throw new Error(data.message || 'Save failed');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    // Display a user-friendly error message, potentially from the caught error
                                    toastr.error('Failed to save section: ' + (error.message ||
                                        'An unknown error occurred.'));

                                    // Optional: If it's an authentication error (e.g., 401 caught by the fetch block),
                                    // you might want to redirect to login
                                    // if (error.message.includes('401')) {
                                    //     window.location.href = '/login'; // Or your login route
                                    // }
                                });
                        },

                        async saveCarouselDetails() {
                            // Only save the currently edited carousel item
                            if (this.showCarouselEdit === null) return;
                            const idx = this.showCarouselEdit;
                            const item = this.carouselEditItem;
                            // Allow saving if either a new file is selected, or an image path exists (not base64), or a base64 image exists
                            const hasExistingImage = item.signature_img && typeof item.signature_img ===
                                'string' && item.signature_img !== '' && !item.signature_img.startsWith(
                                    'data:');
                            const hasBase64Image = item.signature_img && typeof item.signature_img ===
                                'string' && item.signature_img.startsWith('data:');
                            if (!item._file && !hasExistingImage && !hasBase64Image) {
                                toastr.error('Please select an image for the carousel item.');
                                return;
                            }
                            // Update the item in the main array
                            this.heroSection.data.carousel_items[idx] = JSON.parse(JSON.stringify(item));
                            // Always update carousel_count to match the array length
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
