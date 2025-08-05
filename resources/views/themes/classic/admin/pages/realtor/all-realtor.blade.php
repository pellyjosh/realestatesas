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

                    <!-- Breadcrumb start -->


                    <!-- Breadcrumb start -->

                    <!-- Breadcrumb end -->

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
                                <div class="property-box">
                                    <div class="agent-image">
                                        <div>
                                            <img src="{{ $realtor->image_url ? asset('storage/tenant/' . tenant('id') . '/' . $realtor->image_url) : asset('themes/classic/admin/assets/images/avatar/5.jpg') }}"
                                                class="bg-img" alt="{{ $realtor->name }}">
                                            <span class="label label-shadow">0 properties</span>
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
                                                href="{{ route('tenant.admin.realtor.profile', $realtor->id) }}">{{ $realtor->name }}</a>
                                        </h3>
                                        <p class="font-roboto">Real estate Agent</p>
                                        <ul class="agent-contact">
                                            <li><i class="fas fa-envelope"></i> {{ $realtor->email }}</li>
                                            <li><i class="fas fa-phone-alt"></i> {{ $realtor->phone }}</li>
                                        </ul>
                                        <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap"
                                            x-data="editRealtorModal({{ json_encode($realtor) }})">
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"><i
                                                        class="fas fa-ban" style="color: white;"></i></button>
                                                <button @click="openEditModal()" class="btn btn-primary btn-sm mx-1 p-1"
                                                    style="font-size: 0.8em;"><i class="fas fa-edit"
                                                        style="color: white;"></i></button>
                                                <form action="{{ route('tenant.admin.destroy.realtor', $realtor->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm p-1"
                                                        style="font-size: 0.8em;"
                                                        onclick="return confirm('Are you sure you want to delete this realtor?')"><i
                                                            class="fas fa-trash-alt" style="color: white;"></i></button>
                                                </form>
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
                                                                    <div class="form-group col-sm-6">
                                                                        <label>Password <span class="font-danger">*</span>
                                                                        </label>
                                                                        <input type="password" class="form-control"
                                                                            x-model="form.password">
                                                                    </div>
                                                                    <div class="form-group col-sm-6">
                                                                        <label>Confirm Password <span
                                                                                class="font-danger">*</span></label>
                                                                        <input type="password" class="form-control"
                                                                            x-model="form.password_confirmation">
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
    function editRealtorModal(realtor) {
        return {
            showEditModal: false,
            isSubmitting: false,
            imagePreview: realtor.image_url ? `/storage/tenant${realtor.tenant_id ?? ''}/${realtor.image_url}` : null,
            imageFile: null,
            csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            form: {
                first_name: realtor.first_name || '',
                last_name: realtor.last_name || '',
                email: realtor.email || '',
                phone: realtor.phone || '',
                gender: realtor.gender || '',
                date_of_birth: realtor.date_of_birth || '',
                title: realtor.title || '',
                title_other: realtor.title_other || '',
                marital_status: realtor.marital_status || '',
                marital_status_other: realtor.marital_status_other || '',
                nationality: realtor.nationality || '',
                state_of_origin: realtor.state_of_origin || '',
                lga: realtor.lga || '',
                hometown: realtor.hometown || '',
                description: realtor.description || '',
                address: realtor.address || '',
                zip_code: realtor.zip_code || '',
                password: '',
                password_confirmation: ''
            },
            openEditModal() {
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
                    const response = await fetch(`/tenant/admin/realtor/${realtor.id}/update`, {
                        method: 'POST',
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
            }
        }
    }
</script>
