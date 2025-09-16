@extends('themes.classic.admin.admin_master')
@section('title', 'All Realtors | Premium Refined Luxury Homes')
@section('content')

    <!-- Container-fluid start -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-left">
                        <h3>All realtor
                            <small>Welcome to admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->

    <!-- Container-fluid start -->
    <div class="container-fluid">
        <div class="row agent-section property-section agent-lists">
            <div class="col-lg-12">
                <div class="ratio2_3">
                    <div class="property-2 row column-sm property-label property-grid">
                        @forelse($realtors as $realtor)
                            <div class="col-xl-4 col-md-6 wow fadeInUp">
                                <div class="property-box" x-data="editRealtorModal({{ json_encode(array_merge($realtor->toArray(), ['user' => $realtor->user ? $realtor->user->toArray() : null])) }}, {{ $realtor->id }}, '{{ route('tenant.admin.destroy.realtor', $realtor->id) }}')">
                                    <div class="agent-image">
                                        <div style="position: relative;">
                                            @php
                                                $tenantId = tenant('id');
                                                $imagePath = null;
                                                if ($realtor->image_url) {
                                                    $imagePath = asset(
                                                        'storage/tenant/' . $tenantId . '/' . $realtor->image_url,
                                                    );
                                                } elseif ($realtor->user && $realtor->user->image_url) {
                                                    $imagePath = asset(
                                                        'storage/tenant/' . $tenantId . '/' . $realtor->user->image_url,
                                                    );
                                                } else {
                                                    $imagePath = asset(
                                                        'themes/classic/admin/assets/images/avatar/5.jpg',
                                                    );
                                                }
                                            @endphp
                                            <img src="{{ $imagePath }}" class="bg-img"
                                                alt="{{ $realtor->user ? $realtor->user->name : $realtor->first_name . ' ' . $realtor->last_name }}">
                                            <!-- 3-dot menu bottom right -->
                                            <div style="position: absolute; bottom: 10px; right: 10px; z-index: 2;">
                                                <button type="button" @click="openHomepageDropdown = !openHomepageDropdown"
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
                                                <div x-show="openHomepageDropdown"
                                                    @click.away="openHomepageDropdown = false"
                                                    style="position: absolute; bottom: 36px; right: 0; min-width: 180px; background: #fff; border-radius: 8px; box-shadow: 0 8px 24px rgba(0,0,0,0.18); padding: 0.5rem 0; z-index: 10; border: 1px solid #e5e7eb;">
                                                    <div
                                                        style="position: absolute; bottom: -8px; right: 18px; width: 0; height: 0; border-left: 8px solid transparent; border-right: 8px solid transparent; border-top: 8px solid #fff; filter: drop-shadow(0 2px 2px rgba(0,0,0,0.08));">
                                                    </div>
                                                    <button class="dropdown-item d-flex align-items-center"
                                                        style="background: transparent; border: none; width: 100%; font-size: 1em; padding: 0.5rem 1rem; cursor: pointer; color: #222; text-align: left;"
                                                        @click="toggleHomepageRealtor(); openHomepageDropdown = false;"
                                                        :disabled="isTogglingHomepage">
                                                        <i class="fas"
                                                            :class="isRealtorInHomepage ?
                                                                'fa-minus-circle text-danger' :
                                                                'fa-plus-circle text-success'"
                                                            style="margin-right: 8px;"></i>
                                                        <span style="color: #222; font-weight: 500;"
                                                            x-text="isRealtorInHomepage ? 'Remove from Homepage' : 'Add to Homepage'"></span>
                                                    </button>
                                                </div>
                                            </div>
                                            <span class="label label-shadow"
                                                x-text="form && form.status ? (form.status.charAt(0).toUpperCase() + form.status.slice(1)) : '{{ ucfirst($realtor->status ?? 'active') }}'">{{ ucfirst($realtor->status ?? 'active') }}</span>
                                            <div class="agent-overlay"></div>
                                            <div class="overlay-content">
                                                <ul>
                                                    <li><a href="https://accounts.google.com/"><img
                                                                src="{{ asset('themes/classic/admin/assets/images/about/icon-1.png') }}"
                                                                alt=""></a></li>
                                                    <li><a href="https://twitter.com/"><img
                                                                src="{{ asset('themes/classic/admin/assets/images/about/icon-2.png') }}"
                                                                alt=""></a></li>
                                                    <li><a href="https://www.facebook.com/"><img
                                                                src="{{ asset('themes/classic/admin/assets/images/about/icon-3.png') }}"
                                                                alt=""></a></li>
                                                </ul>
                                                <span>Connect</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="agent-content">
                                        <h3><a
                                                href="{{ route('tenant.admin.realtor.profile', $realtor->id) }}">{{ $realtor->user ? $realtor->user->name : $realtor->first_name . ' ' . $realtor->last_name }}</a>
                                        </h3>
                                        <p class="font-roboto">Real estate Agent</p>
                                        <ul class="agent-contact">
                                            <li><i class="fas fa-envelope"></i>
                                                {{ $realtor->user ? $realtor->user->email : '' }}</li>
                                            <li><i class="fas fa-phone-alt"></i> {{ $realtor->phone }}</li>
                                        </ul>
                                        <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"
                                                    @click="toggleSuspendRealtor" :disabled="isSuspending">
                                                    <span x-show="form.status === 'suspended'" aria-hidden="true"
                                                        style="display:inline-block;">
                                                        <!-- Inline play SVG (keeps existing styling) -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" role="img"
                                                            width="14" height="14" viewBox="0 0 24 24"
                                                            fill="currentColor"
                                                            style="display:inline-block;width:14px;height:14px;color:white;vertical-align:middle;">
                                                            <title>Play</title>
                                                            <path d="M8 5v14l11-7z" />
                                                        </svg>
                                                    </span>
                                                    <span x-show="form.status !== 'suspended'" aria-hidden="true"
                                                        style="display:inline-block;">
                                                        <!-- Inline ban (prohibit) SVG (keeps existing styling) -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" role="img"
                                                            width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            style="display:inline-block;width:14px;height:14px;color:white;vertical-align:middle;">
                                                            <title>Ban</title>
                                                            <circle cx="12" cy="12" r="9"></circle>
                                                            <line x1="5" y1="5" x2="19"
                                                                y2="19"></line>
                                                        </svg>
                                                    </span>
                                                </button>
                                                <button @click="openEditModal()" class="btn btn-primary btn-sm mx-1 p-1"
                                                    style="font-size: 0.8em;"><i class="fas fa-edit"
                                                        style="color: white;"></i></button>
                                                <button class="btn btn-danger btn-sm p-1" style="font-size: 0.8em;"
                                                    @click="deleteRealtor" :disabled="isDeleting">
                                                    <i class="fas fa-trash-alt" style="color: white;"></i>
                                                </button>
                                            </div>
                                            <a href="{{ route('tenant.admin.realtor.profile', $realtor->id) }}">View
                                                profile <i class="fas fa-arrow-right"></i></a>
                                            <!-- Alpine.js Edit Modal -->
                                            <template x-if="showEditModal">
                                                <div class="modal fade show d-block" tabindex="-1"
                                                    style="background: rgba(0,0,0,0.5);">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Realtor</h5>
                                                                <button type="button" class="close"
                                                                    @click="closeEditModal()">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form @submit.prevent="submitEditForm"
                                                                    enctype="multipart/form-data" class="row gx-3">
                                                                    <input type="hidden" name="_token"
                                                                        :value="csrfToken">
                                                                    <div class="form-group col-md-4 col-sm-6">
                                                                        <label>First Name <span
                                                                                class="font-danger">*</span></label>
                                                                        <input type="text" class="form-control"
                                                                            x-model="form.first_name" required>
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-6">
                                                                        <label>Last Name <span
                                                                                class="font-danger">*</span></label>
                                                                        <input type="text" class="form-control"
                                                                            x-model="form.last_name" required>
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-6">
                                                                        <label>Gender <span class="font-danger">*</span>
                                                                        </label>
                                                                        <select class="form-control" x-model="form.gender"
                                                                            required>
                                                                            <option value="">Select Gender</option>
                                                                            <option value="male">Male</option>
                                                                            <option value="female">Female</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-6">
                                                                        <label>Phone Number <span
                                                                                class="font-danger">*</span></label>
                                                                        <input type="tel" class="form-control"
                                                                            x-model="form.phone" required>
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-6">
                                                                        <label>Date of Birth</label>
                                                                        <input type="date" class="form-control"
                                                                            x-model="form.date_of_birth">
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-6">
                                                                        <label>Title</label>
                                                                        <select class="form-control" x-model="form.title">
                                                                            <option value="">Select Title</option>
                                                                            <option value="Mr">Mr</option>
                                                                            <option value="Mrs">Mrs</option>
                                                                            <option value="Miss">Miss</option>
                                                                            <option value="Dr">Dr</option>
                                                                            <option value="Prof">Prof</option>
                                                                            <option value="Other">Other</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-6"
                                                                        x-show="form.title === 'Other'">
                                                                        <label>Other Title</label>
                                                                        <input type="text" class="form-control"
                                                                            x-model="form.title_other">
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-6">
                                                                        <label>Marital Status</label>
                                                                        <select class="form-control"
                                                                            x-model="form.marital_status">
                                                                            <option value="">Select Marital Status
                                                                            </option>
                                                                            <option value="Single">Single</option>
                                                                            <option value="Married">Married</option>
                                                                            <option value="Divorced">Divorced</option>
                                                                            <option value="Widowed">Widowed</option>
                                                                            <option value="Other">Other</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-6"
                                                                        x-show="form.marital_status === 'Other'">
                                                                        <label>Other Marital Status</label>
                                                                        <input type="text" class="form-control"
                                                                            x-model="form.marital_status_other">
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-6">
                                                                        <label>Nationality</label>
                                                                        <input type="text" class="form-control"
                                                                            x-model="form.nationality">
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-6">
                                                                        <label>State of Origin</label>
                                                                        <input type="text" class="form-control"
                                                                            x-model="form.state_of_origin">
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-6">
                                                                        <label>LGA</label>
                                                                        <input type="text" class="form-control"
                                                                            x-model="form.lga">
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-6">
                                                                        <label>Hometown</label>
                                                                        <input type="text" class="form-control"
                                                                            x-model="form.hometown">
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-6">
                                                                        <label>Email Address <span
                                                                                class="font-danger">*</span></label>
                                                                        <input type="email" class="form-control"
                                                                            x-model="form.email" required>
                                                                    </div>
                                                                    <div class="form-group col-sm-12">
                                                                        <label>Description</label>
                                                                        <textarea class="form-control" rows="4" x-model="form.description"></textarea>
                                                                    </div>
                                                                    <div class="form-group col-sm-6">
                                                                        <label>Address</label>
                                                                        <input type="text" class="form-control"
                                                                            x-model="form.address">
                                                                    </div>
                                                                    <div class="form-group col-sm-6">
                                                                        <label>Zip Code</label>
                                                                        <input type="text" class="form-control"
                                                                            x-model="form.zip_code">
                                                                    </div>
                                                                    <!-- Image Upload -->
                                                                    <div class="form-group col-sm-12">
                                                                        <label>Profile Image</label>
                                                                        <div class="custom-file-upload">
                                                                            <input type="file" id="imageEditUpload"
                                                                                class="form-control" accept="image/*"
                                                                                @change="handleImageUpload($event)">
                                                                            <template x-if="imagePreview">
                                                                                <div class="mt-3">
                                                                                    <img :src="imagePreview"
                                                                                        alt="Preview"
                                                                                        style="max-width: 200px; height: auto; border-radius: 8px;">
                                                                                </div>
                                                                            </template>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-btn col-12">
                                                                        <button type="submit"
                                                                            class="btn btn-pill btn-gradient color-4"
                                                                            :disabled="isSubmitting">
                                                                            <span x-show="isSubmitting">Updating...</span>
                                                                            <span x-show="!isSubmitting">Update Realtor
                                                                            </span>
                                                                        </button>
                                                                        <button type="button"
                                                                            class="btn btn-pill btn-dashed color-4"
                                                                            @click="closeEditModal()">Cancel</button>
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
                        @empty
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <h4>No realtors found</h4>
                                    <p>You haven't created any realtors yet.</p>
                                    <a href="{{ route('tenant.admin.store.realtor') }}" class="btn btn-primary">Add New
                                        Realtor</a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($realtors->hasPages())
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        {{ $realtors->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<script>
    function editRealtorModal(realtor, realtorId, deleteUrl) {
        // You need to pass selectedHomepageRealtors as a prop to this Alpine component (from controller/blade)
        return {
            isSuspending: false,
            isTogglingHomepage: false,
            showEditModal: false,
            isSubmitting: false,
            isDeleting: false,
            imagePreview: realtor.image_url ? `/storage/tenant${realtor.tenant_id ?? ''}/${realtor.image_url}` : null,
            imageFile: null,
            csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            selectedHomepageRealtors: window.selectedHomepageRealtors || [], // set this globally in blade
            openHomepageDropdown: false,
            get isRealtorInHomepage() {
                return this.selectedHomepageRealtors.includes(realtorId);
            },
            async toggleHomepageRealtor() {
                this.isTogglingHomepage = true;
                try {
                    const response = await fetch(`/management/realtor/${realtorId}/toggle-homepage`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': this.csrfToken
                        },
                        body: JSON.stringify({})
                    });
                    const result = await response.json();
                    if (response.ok && result.success) {
                        if (this.isRealtorInHomepage) {
                            this.selectedHomepageRealtors = this.selectedHomepageRealtors.filter(id => id !==
                                realtorId);
                        } else {
                            this.selectedHomepageRealtors.push(realtorId);
                        }
                        toastr.success(result.message || 'Homepage realtors updated!');
                    } else {
                        toastr.error(result.message || 'An error occurred.');
                    }
                } catch (error) {
                    toastr.error('An unexpected error occurred.');
                } finally {
                    this.isTogglingHomepage = false;
                }
            },
            form: {
                first_name: realtor.first_name || (realtor.user?.name ? realtor.user.name.split(' ')[0] : ''),
                last_name: realtor.last_name || (realtor.user?.name ? realtor.user.name.split(' ').slice(1).join(' ') :
                    ''),
                email: realtor.user?.email || '',
                phone: realtor.phone || realtor.user?.phone || '',
                gender: realtor.gender || '',
                date_of_birth: (realtor.date_of_birth && realtor.date_of_birth.length >= 10) ? realtor.date_of_birth
                    .substring(0, 10) : (realtor.user?.date_of_birth && realtor.user.date_of_birth.length >= 10) ?
                    realtor.user.date_of_birth.substring(0, 10) : '',
                title: realtor.title || '',
                title_other: realtor.title_other || '',
                marital_status: realtor.marital_status || '',
                marital_status_other: realtor.marital_status_other || '',
                nationality: realtor.nationality || '',
                state_of_origin: realtor.state_of_origin || '',
                lga: realtor.lga || '',
                hometown: realtor.hometown || '',
                description: realtor.description || '',
                address: realtor.residential_address || realtor.address || realtor.user?.residential_address || '',
                zip_code: realtor.zip_code || '',
                status: realtor.status || 'active',
                password: '',
                password_confirmation: ''
            },
            openEditModal() {
                // Debug: log the realtor object to inspect available fields
                console.log('Realtor data for edit:', realtor);
                // Use first_name/last_name from realtor, else split user.name
                let firstName = realtor.first_name || (realtor.user?.name ? realtor.user.name.split(' ')[0] : '');
                let lastName = realtor.last_name || (realtor.user?.name ? realtor.user.name.split(' ').slice(1).join(
                    ' ') : '');

                this.form = {
                    first_name: firstName,
                    last_name: lastName,
                    email: realtor.user?.email || '',
                    phone: realtor.phone || realtor.user?.phone || '',
                    gender: realtor.gender || '',
                    date_of_birth: (realtor.date_of_birth && realtor.date_of_birth.length >= 10) ? realtor
                        .date_of_birth.substring(0, 10) : (realtor.user?.date_of_birth && realtor.user.date_of_birth
                            .length >= 10) ? realtor.user.date_of_birth.substring(0, 10) : '',
                    title: realtor.title || '',
                    title_other: realtor.title_other || '',
                    marital_status: realtor.marital_status || '',
                    marital_status_other: realtor.marital_status_other || '',
                    nationality: realtor.nationality || '',
                    state_of_origin: realtor.state_of_origin || '',
                    lga: realtor.lga || '',
                    hometown: realtor.hometown || '',
                    description: realtor.description || '',
                    address: realtor.residential_address || realtor.address || realtor.user?.residential_address ||
                        '',
                    zip_code: realtor.zip_code || '',
                    status: realtor.status || 'active',
                    password: '', // always empty for security
                    password_confirmation: '' // always empty for security
                };
                // Profile image
                if (realtor.image_url && realtor.tenant_id) {
                    this.imagePreview = `/storage/tenant/${realtor.tenant_id}/${realtor.image_url}`;
                } else if (realtor.user?.image_url && realtor.tenant_id) {
                    this.imagePreview = `/storage/tenant/${realtor.tenant_id}/${realtor.user.image_url}`;
                } else {
                    this.imagePreview = '/themes/classic/admin/assets/images/avatar/5.jpg';
                }
                this.imageFile = null;
                this.showEditModal = true;
            },
            closeEditModal() {
                this.showEditModal = false;
            },
            handleImageUpload(event) {
                const file = event.target.files[0];
                if (file) {
                    this.imageFile = file;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imagePreview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },
            async submitEditForm() {
                this.isSubmitting = true;
                try {
                    const formData = new FormData();
                    Object.keys(this.form).forEach(key => {
                        formData.append(key, this.form[key]);
                    });
                    if (this.imageFile) {
                        formData.append('image', this.imageFile);
                    }
                    formData.append('_token', this.csrfToken);
                    formData.append('_method', 'PUT'); // Laravel expects this for PUT via FormData
                    const response = await fetch(`/management/realtor/${realtor.user_id || realtor.user?.id}`, {
                        method: 'POST', // Use POST with _method override for PUT
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    });
                    const result = await response.json();
                    if (response.ok && result.success) {
                        toastr.success('Realtor updated successfully!');
                        this.closeEditModal();
                        window.location.reload();
                    } else {
                        toastr.error(result.message || 'An error occurred while updating the realtor.');
                    }
                } catch (error) {
                    toastr.error('An unexpected error occurred. Please try again.');
                } finally {
                    this.isSubmitting = false;
                }
            },
            async toggleSuspendRealtor() {
                const isCurrentlySuspended = this.form.status === 'suspended';
                if (!confirm(isCurrentlySuspended ? 'Unsuspend this realtor?' : 'Suspend this realtor?')) return;
                this.isSuspending = true;
                try {
                    const response = await fetch(
                        `/management/realtor/${realtorId}/suspend`, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': this.csrfToken
                            },
                            body: JSON.stringify({
                                status: isCurrentlySuspended ? 'active' : 'suspended'
                            })
                        });
                    const result = await response.json();
                    if (response.ok && result.success) {
                        toastr.success(result.message || (isCurrentlySuspended ? 'Realtor unsuspended!' :
                            'Realtor suspended!'));
                        // Update local state for instant feedback
                        this.form.status = isCurrentlySuspended ? 'active' : 'suspended';
                        // No reload: Alpine will update the button/icon automatically
                    } else {
                        toastr.error(result.message || 'An error occurred while suspending the realtor.');
                    }
                } catch (error) {
                    toastr.error('An unexpected error occurred. Please try again.');
                } finally {
                    this.isSuspending = false;
                }
            },
            async deleteRealtor() {
                if (!confirm('Are you sure you want to delete this realtor?')) return;
                this.isDeleting = true;
                try {
                    const response = await fetch(deleteUrl, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': this.csrfToken
                        }
                    });
                    const result = await response.json();
                    if (response.ok && result.success) {
                        toastr.success(result.message || 'Realtor deleted successfully!');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        toastr.error(result.message || 'An error occurred while deleting the realtor.');
                    }
                } catch (error) {
                    toastr.error('An unexpected error occurred. Please try again.');
                } finally {
                    this.isDeleting = false;
                }
            }
        }
    }
</script>
