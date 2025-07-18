@extends('themes.classic.admin.admin_master')
@section('title', 'Homepage Content Management | Premium Refined Luxury Homes')
@section('content')

    <div x-data="homepageManager()" x-init="init()" class="container-fluid">
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
                            <!-- Hero Banner -->
                            <div class="col-md-6 mb-4">
                                <div class="section-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <label class="form-label">
                                                <i data-feather="image" class="me-1"></i>Hero Banner Image
                                            </label>
                                            <div class="mt-2" x-show="!showForm.includes('hero_banner')">
                                                <div class="d-flex align-items-center">
                                                    <img :src="heroSection.data.hero_banner ||
                                                        '/themes/classic/admin/assets/images/dashboard/default.jpg'"
                                                        alt="Hero Banner" class="img-fluid rounded me-3"
                                                        style="max-width:100px; max-height:60px; object-fit: cover;">
                                                    <div>
                                                        <span class="text-muted small d-block"
                                                            x-text="heroSection.data.hero_banner || 'No image set'"></span>
                                                        <small class="text-info">Recommended: 1920x800px</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-xs" @click="toggleEditForm('hero_banner')"
                                            type="button">
                                            <span x-show="!showForm.includes('hero_banner')">Edit</span>
                                            <span x-show="showForm.includes('hero_banner')">Cancel</span>
                                        </button>
                                    </div>
                                    <form x-show="showForm.includes('hero_banner')"
                                        @submit.prevent="saveProperty('hero_banner')" class="mt-3">
                                        <div class="form-group">
                                            <label class="form-label">Image URL</label>
                                            <input type="url" class="form-control" x-model="formValues.hero_banner"
                                                placeholder="Enter image URL">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                                            <button type="button" class="btn btn-light"
                                                @click="toggleEditForm('hero_banner')">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Hero Title -->
                            <div class="col-md-6 mb-4">
                                <div class="section-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <label class="form-label">
                                                <i data-feather="type" class="me-1"></i>Hero Title
                                            </label>
                                            <div class="mt-2" x-show="!showForm.includes('hero_title')">
                                                <h6 class="mb-0"
                                                    x-text="heroSection.data.hero_title || 'Premium Refined Luxury Homes'">
                                                </h6>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-xs" @click="toggleEditForm('hero_title')"
                                            type="button">
                                            <span x-show="!showForm.includes('hero_title')">Edit</span>
                                            <span x-show="showForm.includes('hero_title')">Cancel</span>
                                        </button>
                                    </div>
                                    <form x-show="showForm.includes('hero_title')"
                                        @submit.prevent="saveProperty('hero_title')" class="mt-3">
                                        <div class="form-group">
                                            <label class="form-label">Hero Title</label>
                                            <input type="text" class="form-control" x-model="formValues.hero_title"
                                                placeholder="Enter hero title">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                                            <button type="button" class="btn btn-light"
                                                @click="toggleEditForm('hero_title')">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Hero Subtitle -->
                            <div class="col-md-6 mb-4">
                                <div class="section-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <label class="form-label">
                                                <i data-feather="align-left" class="me-1"></i>Hero Subtitle
                                            </label>
                                            <div class="mt-2" x-show="!showForm.includes('hero_subtitle')">
                                                <p class="mb-0 text-muted"
                                                    x-text="heroSection.data.hero_subtitle || 'Find your perfect property today'">
                                                </p>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-xs" @click="toggleEditForm('hero_subtitle')"
                                            type="button">
                                            <span x-show="!showForm.includes('hero_subtitle')">Edit</span>
                                            <span x-show="showForm.includes('hero_subtitle')">Cancel</span>
                                        </button>
                                    </div>
                                    <form x-show="showForm.includes('hero_subtitle')"
                                        @submit.prevent="saveProperty('hero_subtitle')" class="mt-3">
                                        <div class="form-group">
                                            <label class="form-label">Hero Subtitle</label>
                                            <textarea class="form-control" x-model="formValues.hero_subtitle" placeholder="Enter hero subtitle" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                                            <button type="button" class="btn btn-light"
                                                @click="toggleEditForm('hero_subtitle')">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- CTA Button -->
                            <div class="col-md-6 mb-4">
                                <div class="section-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <label class="form-label">
                                                <i data-feather="mouse-pointer" class="me-1"></i>Call to Action Button
                                            </label>
                                            <div class="mt-2" x-show="!showForm.includes('cta_button')">
                                                <span class="btn btn-primary btn-xs"
                                                    x-text="heroSection.data.cta_button || 'Get Started'"></span>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-xs" @click="toggleEditForm('cta_button')"
                                            type="button">
                                            <span x-show="!showForm.includes('cta_button')">Edit</span>
                                            <span x-show="showForm.includes('cta_button')">Cancel</span>
                                        </button>
                                    </div>
                                    <form x-show="showForm.includes('cta_button')"
                                        @submit.prevent="saveProperty('cta_button')" class="mt-3">
                                        <div class="form-group">
                                            <label class="form-label">Button Text</label>
                                            <input type="text" class="form-control" x-model="formValues.cta_button"
                                                placeholder="Enter button text">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                                            <button type="button" class="btn btn-light"
                                                @click="toggleEditForm('cta_button')">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                                        <h6 class="mb-0" x-text="propertiesSection.data.title || 'Latest For Sale'">
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
                                            x-text="propertiesSection.data.label || 'Sale'"></span>
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
                                    <label class="form-label">Properties to Display</label>
                                    <div class="mt-2" x-show="!showForm.includes('properties_limit')">
                                        <span class="text-primary fw-bold"
                                            x-text="(propertiesSection.data.limit || '6') + ' properties'"></span>
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
                                        placeholder="Number of properties to show" min="1" max="20">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary me-2">Save</button>
                                    <button type="button" class="btn btn-light"
                                        @click="toggleEditForm('properties_limit')">Cancel</button>
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
                                            x-text="propertiesSection.data.description || 'Discover premium properties available for purchase'">
                                        </p>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-xs" @click="toggleEditForm('properties_description')"
                                    type="button">
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
                                        <h6 class="mb-0" x-text="testimonialsSection.data.title || 'Happy Clients'">
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
                                    <input type="text" class="form-control" x-model="formValues.testimonials_title"
                                        placeholder="Enter section title">
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
                                            x-text="testimonialsSection.data.label || 'Our'"></span>
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
                                    <input type="text" class="form-control" x-model="formValues.testimonials_label"
                                        placeholder="Enter section label">
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
                                            x-text="testimonialsSection.data.description || 'What our satisfied clients say about our services'">
                                        </p>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-xs" @click="toggleEditForm('testimonials_description')"
                                    type="button">
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
                            <input type="checkbox" x-model="aboutSection.is_enabled" @change="toggleSection('about')">
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
                                        <h6 class="mb-0" x-text="aboutSection.data.title || 'Meet our Realtor'"></h6>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-xs" @click="toggleEditForm('about_title')"
                                    type="button">
                                    <span x-show="!showForm.includes('about_title')">Edit</span>
                                    <span x-show="showForm.includes('about_title')">Cancel</span>
                                </button>
                            </div>
                            <form x-show="showForm.includes('about_title')" @submit.prevent="saveProperty('about_title')"
                                class="mt-3">
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
                                            x-text="aboutSection.data.description || 'We don\'t just sell land we curate legacy worthy properties...'">
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
                                        <h6 class="mb-0"
                                            x-text="citiesSection.data.title || 'Find Properties in These Cities'"></h6>
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
                                            x-text="citiesSection.data.description || 'Explore properties available in various cities'">
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
                Alpine.data('homepageManager', () => ({
                    showForm: [],
                    formValues: {},

                    // Section data with default values
                    heroSection: {
                        is_enabled: true,
                        data: {
                            hero_banner: '/assets/hero-bg.jpg',
                            hero_title: 'Find Your Dream Property',
                            hero_subtitle: 'Discover the perfect investment opportunity',
                            cta_button: 'Browse Properties'
                        }
                    },

                    propertiesSection: {
                        is_enabled: true,
                        data: {
                            title: 'Plots of Land',
                            label: 'Properties',
                            limit: 6,
                            description: 'Discover premium properties available for purchase'
                        }
                    },

                    testimonialsSection: {
                        is_enabled: true,
                        data: {
                            title: 'Happy Clients',
                            label: 'Our',
                            description: 'What our satisfied clients say about our services'
                        }
                    },

                    aboutSection: {
                        is_enabled: true,
                        data: {
                            title: 'Meet our Realtor',
                            description: 'We don\'t just sell land we curate legacy worthy properties...'
                        }
                    },

                    citiesSection: {
                        is_enabled: true,
                        data: {
                            title: 'Find Properties in These Cities',
                            description: 'Explore properties available in various cities'
                        }
                    },

                    init() {
                        // Initialize sections from Laravel data if available
                        @if (isset($sections))
                            @foreach ($sections as $section)
                                @if ($section->name === 'hero')
                                    this.heroSection = {
                                        is_enabled: {{ $section->is_enabled ? 'true' : 'false' }},
                                        data: {!! json_encode($section->data ?? []) !!}
                                    };
                                @endif
                                @if ($section->name === 'properties')
                                    this.propertiesSection = {
                                        is_enabled: {{ $section->is_enabled ? 'true' : 'false' }},
                                        data: {!! json_encode($section->data ?? []) !!}
                                    };
                                @endif
                                @if ($section->name === 'testimonials')
                                    this.testimonialsSection = {
                                        is_enabled: {{ $section->is_enabled ? 'true' : 'false' }},
                                        data: {!! json_encode($section->data ?? []) !!}
                                    };
                                @endif
                                @if ($section->name === 'about')
                                    this.aboutSection = {
                                        is_enabled: {{ $section->is_enabled ? 'true' : 'false' }},
                                        data: {!! json_encode($section->data ?? []) !!}
                                    };
                                @endif
                                @if ($section->name === 'cities')
                                    this.citiesSection = {
                                        is_enabled: {{ $section->is_enabled ? 'true' : 'false' }},
                                        data: {!! json_encode($section->data ?? []) !!}
                                    };
                                @endif
                            @endforeach
                        @endif

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

                    setFormValue(formKey) {
                        const [section, property] = formKey.split('_');
                        const sectionData = this[`${section}Section`];

                        if (sectionData && sectionData.data && sectionData.data[property]) {
                            this.formValues[formKey] = sectionData.data[property];
                        } else {
                            this.formValues[formKey] = '';
                        }
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
                            sectionData.is_enabled = !sectionData.is_enabled;
                            this.saveSectionData(sectionName, sectionData);
                        }
                    },

                    saveSectionData(sectionName, sectionData) {
                        console.log('Saving section:', sectionName, sectionData);

                        if (typeof toastr !== 'undefined') {
                            toastr.success('Section updated successfully!');
                        } else {
                            alert('Section updated successfully!');
                        }

                        // TODO: Implement backend save when ready
                        /*
                        fetch(`/admin/sections/${sectionName}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                name: sectionName,
                                is_enabled: sectionData.is_enabled,
                                data: sectionData.data
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                toastr.success('Section updated successfully!');
                            } else {
                                throw new Error('Save failed');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            toastr.error('Failed to save section');
                        });
                        */
                    }
                }));
            });
        </script>
    @endpush

@endsection
