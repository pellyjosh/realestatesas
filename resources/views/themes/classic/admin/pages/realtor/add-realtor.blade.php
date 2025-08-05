@extends('themes.classic.admin.admin_master')
@section('title', 'Add Realtor | Premium Refined Luxury Homes')
@section('content')
{{-- Include Alpine.js --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

{{-- Toast Notification Styles --}}
<style>
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1055;
    }
    
    .toast {
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        margin-bottom: 10px;
        min-width: 300px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .toast.success {
        border-left: 4px solid #28a745;
    }
    
    .toast.error {
        border-left: 4px solid #dc3545;
    }
    
    .toast-header {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .toast-body {
        padding: 12px 16px;
    }
    
    .toast-close {
        margin-left: auto;
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
    }
</style>

<!-- Container-fluid start -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-header-left">
                    <h3>Add Realtor
                        <small>Welcome to admin panel</small>
                    </h3>
                </div>
            </div>
            <div class="col-sm-6">
                <!-- Breadcrumb start -->
                <ol class="breadcrumb pull-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('tenant.admin.dashboard') }}">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Add Realtor</li>
                </ol>
                <!-- Breadcrumb end -->
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid end -->

<!-- Toast Container -->
<div class="toast-container" x-data="{ toasts: [] }" x-init="window.showToast = (message, type = 'success') => {
    const id = Date.now();
    toasts.push({ id, message, type });
    setTimeout(() => {
        toasts = toasts.filter(toast => toast.id !== id);
    }, 5000);
}">
    <template x-for="toast in toasts" :key="toast.id">
        <div class="toast" :class="toast.type" x-show="true" x-transition>
            <div class="toast-header">
                <strong x-text="toast.type === 'success' ? 'Success' : 'Error'"></strong>
                <button type="button" class="toast-close" @click="toasts = toasts.filter(t => t.id !== toast.id)">&times;</button>
            </div>
            <div class="toast-body" x-text="toast.message"></div>
        </div>
    </template>
</div>

<!-- Container-fluid start -->
<div class="container-fluid" x-data="realtorForm()">
    <div class="row">
        <div class="col-lg-12">
            <div class="card"> 
                <div class="card-header pb-0">
                    <h5>Add Realtor Details</h5>
                </div>
                <div class="card-body admin-form">
                    <form @submit.prevent="submitForm" class="row gx-3" enctype="multipart/form-data">
                        <input type="hidden" name="_token" :value="csrfToken">
                        
                        <div class="form-group col-md-4 col-sm-6">
                            <label>First Name <span class="font-danger">*</span></label>
                            <input type="text" 
                                   class="form-control" 
                                   placeholder="Enter first name" 
                                   x-model="form.first_name"
                                   required>
                            <template x-if="errors.first_name">
                                <small class="text-danger" x-text="errors.first_name[0]"></small>
                            </template>
                        </div>
                        
                        <div class="form-group col-md-4 col-sm-6">
                            <label>Last Name <span class="font-danger">*</span></label>
                            <input type="text" 
                                   class="form-control" 
                                   placeholder="Enter last name" 
                                   x-model="form.last_name"
                                   required>
                            <template x-if="errors.last_name">
                                <small class="text-danger" x-text="errors.last_name[0]"></small>
                            </template>
                        </div>
                        
                        <div class="form-group col-md-4 col-sm-6">
                            <label>Gender <span class="font-danger">*</span></label>
                            <select class="form-control" x-model="form.gender" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <template x-if="errors.gender">
                                <small class="text-danger" x-text="errors.gender[0]"></small>
                            </template>
                        </div>
                        
                        <div class="form-group col-md-4 col-sm-6">
                            <label>Phone Number <span class="font-danger">*</span></label>
                            <input type="tel" 
                                   class="form-control" 
                                   placeholder="Enter phone number" 
                                   x-model="form.phone"
                                   required>
                            <template x-if="errors.phone">
                                <small class="text-danger" x-text="errors.phone[0]"></small>
                            </template>
                        </div>
                        
                        <div class="form-group col-md-4 col-sm-6">
                            <label>Date of Birth</label>
                            <input type="date" 
                                   class="form-control" 
                                   x-model="form.date_of_birth">
                            <template x-if="errors.date_of_birth">
                                <small class="text-danger" x-text="errors.date_of_birth[0]"></small>
                            </template>
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
                            <template x-if="errors.title">
                                <small class="text-danger" x-text="errors.title[0]"></small>
                            </template>
                        </div>
                        
                        <div class="form-group col-md-4 col-sm-6" x-show="form.title === 'Other'">
                            <label>Other Title</label>
                            <input type="text" 
                                   class="form-control" 
                                   placeholder="Specify other title" 
                                   x-model="form.title_other">
                            <template x-if="errors.title_other">
                                <small class="text-danger" x-text="errors.title_other[0]"></small>
                            </template>
                        </div>
                        
                        <div class="form-group col-md-4 col-sm-6">
                            <label>Marital Status</label>
                            <select class="form-control" x-model="form.marital_status">
                                <option value="">Select Marital Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Other">Other</option>
                            </select>
                            <template x-if="errors.marital_status">
                                <small class="text-danger" x-text="errors.marital_status[0]"></small>
                            </template>
                        </div>
                        
                        <div class="form-group col-md-4 col-sm-6" x-show="form.marital_status === 'Other'">
                            <label>Other Marital Status</label>
                            <input type="text" 
                                   class="form-control" 
                                   placeholder="Specify other marital status" 
                                   x-model="form.marital_status_other">
                            <template x-if="errors.marital_status_other">
                                <small class="text-danger" x-text="errors.marital_status_other[0]"></small>
                            </template>
                        </div>
                        
                        <div class="form-group col-md-4 col-sm-6">
                            <label>Nationality</label>
                            <input type="text" 
                                   class="form-control" 
                                   placeholder="Enter nationality" 
                                   x-model="form.nationality">
                            <template x-if="errors.nationality">
                                <small class="text-danger" x-text="errors.nationality[0]"></small>
                            </template>
                        </div>
                        
                        <div class="form-group col-md-4 col-sm-6">
                            <label>State of Origin</label>
                            <input type="text" 
                                   class="form-control" 
                                   placeholder="Enter state of origin" 
                                   x-model="form.state_of_origin">
                            <template x-if="errors.state_of_origin">
                                <small class="text-danger" x-text="errors.state_of_origin[0]"></small>
                            </template>
                        </div>
                        
                        <div class="form-group col-md-4 col-sm-6">
                            <label>LGA</label>
                            <input type="text" 
                                   class="form-control" 
                                   placeholder="Enter local government area" 
                                   x-model="form.lga">
                            <template x-if="errors.lga">
                                <small class="text-danger" x-text="errors.lga[0]"></small>
                            </template>
                        </div>
                        
                        <div class="form-group col-md-4 col-sm-6">
                            <label>Hometown</label>
                            <input type="text" 
                                   class="form-control" 
                                   placeholder="Enter hometown" 
                                   x-model="form.hometown">
                            <template x-if="errors.hometown">
                                <small class="text-danger" x-text="errors.hometown[0]"></small>
                            </template>
                        </div>
                        
                        <div class="form-group col-md-4 col-sm-6">
                            <label>Email Address <span class="font-danger">*</span></label>
                            <input type="email" 
                                   class="form-control" 
                                   placeholder="Enter email address" 
                                   x-model="form.email"
                                   required>
                            <template x-if="errors.email">
                                <small class="text-danger" x-text="errors.email[0]"></small>
                            </template>
                        </div>
                        
                        <div class="form-group col-sm-6">
                            <label>Password <span class="font-danger">*</span></label>
                            <input type="password" 
                                   class="form-control" 
                                   placeholder="Enter password" 
                                   x-model="form.password"
                                   required>
                            <template x-if="errors.password">
                                <small class="text-danger" x-text="errors.password[0]"></small>
                            </template>
                        </div>
                        
                        <div class="form-group col-sm-6">
                            <label>Confirm Password <span class="font-danger">*</span></label>
                            <input type="password" 
                                   class="form-control" 
                                   placeholder="Confirm password" 
                                   x-model="form.password_confirmation"
                                   required>
                            <template x-if="errors.password_confirmation">
                                <small class="text-danger" x-text="errors.password_confirmation[0]"></small>
                            </template>
                        </div>
                        
                        <div class="form-group col-sm-12">
                            <label>Description</label>
                            <textarea class="form-control" 
                                      rows="4" 
                                      placeholder="Enter description" 
                                      x-model="form.description"></textarea>
                            <template x-if="errors.description">
                                <small class="text-danger" x-text="errors.description[0]"></small>
                            </template>
                        </div>
                        
                        <div class="form-group col-sm-6">
                            <label>Address</label>
                            <input type="text" 
                                   class="form-control" 
                                   placeholder="Enter address" 
                                   x-model="form.address">
                            <template x-if="errors.address">
                                <small class="text-danger" x-text="errors.address[0]"></small>
                            </template>
                        </div>
                        
                        <div class="form-group col-sm-6">
                            <label>Zip Code</label>
                            <input type="text" 
                                   class="form-control" 
                                   placeholder="Enter zip code" 
                                   x-model="form.zip_code">
                            <template x-if="errors.zip_code">
                                <small class="text-danger" x-text="errors.zip_code[0]"></small>
                            </template>
                        </div>
                        
                        <!-- Image Upload -->
                        <div class="form-group col-sm-12">
                            <label>Profile Image</label>
                            <div class="custom-file-upload">
                                <input type="file" 
                                       id="imageUpload" 
                                       class="form-control" 
                                       accept="image/*" 
                                       @change="handleImageUpload($event)">
                                <template x-if="imagePreview">
                                    <div class="mt-3">
                                        <img :src="imagePreview" alt="Preview" style="max-width: 200px; height: auto; border-radius: 8px;">
                                    </div>
                                </template>
                                <template x-if="errors.image">
                                    <small class="text-danger" x-text="errors.image[0]"></small>
                                </template>
                            </div>
                        </div>
                        
                        <div class="form-btn col-12">
                            <button type="submit" 
                                    class="btn btn-pill btn-gradient color-4" 
                                    :disabled="isSubmitting">
                                <span x-show="isSubmitting">Creating...</span>
                                <span x-show="!isSubmitting">Create Realtor</span>
                            </button>
                            <button type="button" 
                                    class="btn btn-pill btn-dashed color-4" 
                                    @click="resetForm">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid end -->

<script>
// Initialize toastr
$(document).ready(function() {
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000"
    };
});

function realtorForm() {
    return {
        isSubmitting: false,
        imagePreview: null,
        imageFile: null,
        csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
        errors: {},
        form: {
            first_name: '',
            last_name: '',
            email: '',
            phone: '',
            password: '',
            password_confirmation: '',
            gender: '',
            date_of_birth: '',
            title: '',
            title_other: '',
            marital_status: '',
            marital_status_other: '',
            nationality: '',
            state_of_origin: '',
            lga: '',
            hometown: '',
            description: '',
            address: '',
            zip_code: ''
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
        
                        async submitForm() {
                            this.isSubmitting = true;
                            this.errors = {};
                            
                            try {
                                const formData = new FormData();
                                
                                // Add form fields
                                Object.keys(this.form).forEach(key => {
                                    if (this.form[key]) {
                                        formData.append(key, this.form[key]);
                                    }
                                });
                                
                                // Add image if selected
                                if (this.imageFile) {
                                    formData.append('image', this.imageFile);
                                }
                                
                                formData.append('_token', this.csrfToken);
                                
                                console.log('Submitting form data:', Object.fromEntries(formData));
                                
                                const response = await fetch('{{ route("tenant.admin.store.realtor") }}', {
                                    method: 'POST',
                                    headers: {
                                        'Accept': 'application/json',
                                        'X-Requested-With': 'XMLHttpRequest'
                                    },
                                    body: formData
                                });
                                
                                const result = await response.json();
                                console.log('Server response:', result);
                                
                                if (response.ok && result.success) {
                                    toastr.success('Realtor created successfully!');
                                    this.resetForm();
                                    // Optionally redirect
                                    if (result.redirect) {
                                        setTimeout(() => {
                                            window.location.href = result.redirect;
                                        }, 1000);
                                    }
                                } else {
                                    if (result.errors) {
                                        this.errors = result.errors;
                                        // Show specific validation errors
                                        Object.keys(result.errors).forEach(field => {
                                            toastr.error(result.errors[field][0]);
                                        });
                                    } else {
                                        toastr.error(result.message || 'An error occurred while creating the realtor.');
                                    }
                                }
                            } catch (error) {
                                console.error('Error:', error);
                                toastr.error('An unexpected error occurred. Please try again.');
                            } finally {
                                this.isSubmitting = false;
                            }
                        },
        
        resetForm() {
            this.form = {
                first_name: '',
                last_name: '',
                email: '',
                phone: '',
                password: '',
                password_confirmation: '',
                gender: '',
                date_of_birth: '',
                title: '',
                title_other: '',
                marital_status: '',
                marital_status_other: '',
                nationality: '',
                state_of_origin: '',
                lga: '',
                hometown: '',
                description: '',
                address: '',
                zip_code: ''
            };
            this.errors = {};
            this.imagePreview = null;
            this.imageFile = null;
            
            // Reset file input
            const fileInput = document.getElementById('imageUpload');
            if (fileInput) {
                fileInput.value = '';
            }
        }
    }
}
</script>
@endsection
