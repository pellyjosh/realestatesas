@extends('themes.classic.realtor.realtor_master')
@section('title', 'User Profile | Premium Refined Luxury Homes')

@push('styles')
    <link rel="stylesheet" href="{{ asset('themes/classic/realtor/assets/css/profile.css') }}">
@endpush

@section('content')
    <div class="container-fluid" x-data="profileManager()">
        <!-- Loading overlay -->
        <div x-show="loading" x-transition class="loading-overlay">
            <div class="spinner"></div>
        </div>
        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-left">
                        <h3>User profile
                            <small>Welcome to realtor panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- Breadcrumb can be added here -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="row user-info">
                    <!-- Profile Information Card -->
                    <div class="col-xl-5 xl-6">
                        <div class="card profile-card">
                            <div class="card-body">
                                <div class="media contact-media">
                                    <div class="position-relative profile-image-container">
                                        <img :src="profileImage || '{{ asset('themes/classic/admin/assets/images/avatar/7.jpg') }}'"
                                            class="img-fluid img-80 rounded-circle" alt="Profile Picture">

                                        <template x-if="editMode">
                                            <div class="profile-image-overlay" @click="$refs.imageInput.click()">
                                                <i class="fas fa-camera"></i>
                                            </div>
                                        </template>

                                        <!-- Hidden file input -->
                                        <template x-if="editMode">
                                            <input type="file" x-ref="imageInput" @change="handleImageChange($event)"
                                                accept="image/*" class="d-none">
                                        </template>
                                    </div>

                                    <div class="media-body ms-3">
                                        <template x-if="!editMode">
                                            <div>
                                                <h4 x-text="userData.name || 'User Name'"></h4>
                                                <span class="light-font">
                                                    <span
                                                        x-text="userData.residential_address || 'Address not provided'"></span>
                                                </span>
                                                <ul class="agent-social mt-2">
                                                    <li><a href="https://www.facebook.com/" class="facebook"><i
                                                                class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="https://twitter.com/" class="twitter"><i
                                                                class="fab fa-twitter"></i></a></li>
                                                    <li><a href="https://account.google.com/" class="google"><i
                                                                class="fab fa-google"></i></a></li>
                                                    <li><a href="https://www.linkedin.com/" class="linkedin"><i
                                                                class="fab fa-linkedin-in"></i></a></li>
                                                </ul>
                                            </div>
                                        </template>

                                        <template x-if="editMode">
                                            <div>
                                                <input type="text" x-model="userData.name" class="form-control mb-2"
                                                    placeholder="Full Name">
                                                <textarea x-model="userData.residential_address" class="form-control" rows="2" placeholder="Residential Address"></textarea>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div class="contact-btn mt-3">
                                    <template x-if="!editMode">
                                        <button type="button" @click="editMode = true"
                                            class="btn btn-gradient color-4 btn-pill">
                                            <i class="fas fa-edit me-1"></i>Edit Profile
                                        </button>
                                    </template>

                                    <template x-if="editMode">
                                        <div>
                                            <button type="button" @click="saveProfile()"
                                                class="btn btn-success btn-pill me-2">
                                                <i class="fas fa-save me-1"></i>Save Changes
                                            </button>
                                            <button type="button" @click="cancelEdit()" class="btn btn-secondary btn-pill">
                                                <i class="fas fa-times me-1"></i>Cancel
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information Card -->
                    <div class="col-xl-7 xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="title-about">
                                    <h5>Personal Information</h5>
                                </div>

                                <template x-if="!editMode">
                                    <div class="table-responsive">
                                        <table class="table table-bordernone mb-0">
                                            <tbody>
                                                <tr>
                                                    <td class="pt-0">Email:</td>
                                                    <td class="light-font pt-0" x-text="userData.email || 'Not provided'">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Phone:</td>
                                                    <td class="light-font" x-text="userData.phone || 'Not provided'"></td>
                                                </tr>
                                                <tr>
                                                    <td>Gender:</td>
                                                    <td class="light-font" x-text="userData.gender || 'Not specified'"></td>
                                                </tr>
                                                <tr>
                                                    <td>Date of Birth:</td>
                                                    <td class="light-font"
                                                        x-text="userData.date_of_birth || 'Not provided'"></td>
                                                </tr>
                                                <tr>
                                                    <td>Occupation:</td>
                                                    <td class="light-font" x-text="userData.occupation || 'Not provided'">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pb-0">Nationality:</td>
                                                    <td class="light-font pb-0"
                                                        x-text="userData.nationality || 'Not provided'"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </template>

                                <template x-if="editMode">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" x-model="userData.email" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="text" x-model="userData.phone" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Gender</label>
                                            <select x-model="userData.gender" class="form-control">
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Date of Birth</label>
                                            <input type="date" x-model="userData.date_of_birth" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Occupation</label>
                                            <input type="text" x-model="userData.occupation" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nationality</label>
                                            <input type="text" x-model="userData.nationality" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">State of Origin</label>
                                            <input type="text" x-model="userData.state_of_origin"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">LGA</label>
                                            <input type="text" x-model="userData.lga" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Hometown</label>
                                            <input type="text" x-model="userData.hometown" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Marital Status</label>
                                            <select x-model="userData.marital_status" class="form-control">
                                                <option value="">Select Status</option>
                                                <option value="single">Single</option>
                                                <option value="married">Married</option>
                                                <option value="divorced">Divorced</option>
                                                <option value="widowed">Widowed</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Security Settings -->
                    <div class="col-xl-6 xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="title-about">
                                    <h5>Security Settings</h5>
                                </div>

                                <div x-show="showPasswordForm" x-transition>
                                    <form @submit.prevent="updatePassword()">
                                        <div class="mb-3">
                                            <label class="form-label">Current Password</label>
                                            <input type="password" x-model="passwordData.current_password"
                                                class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">New Password</label>
                                            <input type="password" x-model="passwordData.password" class="form-control"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Confirm New Password</label>
                                            <input type="password" x-model="passwordData.password_confirmation"
                                                class="form-control" required>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary btn-sm">Update Password</button>
                                            <button type="button" @click="showPasswordForm = false; resetPasswordForm()"
                                                class="btn btn-secondary btn-sm">Cancel</button>
                                        </div>
                                    </form>
                                </div>

                                <div x-show="!showPasswordForm">
                                    <p class="text-muted">Ensure your account is using a long, random password to stay
                                        secure.</p>
                                    <button type="button" @click="showPasswordForm = true"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-key me-1"></i>Change Password
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activities placeholder -->
                    <div class="col-xl-6 xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="title-about">
                                    <h5>Account Information</h5>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordernone mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="pt-0">Account Type:</td>
                                                <td class="light-font pt-0">Realtor</td>
                                            </tr>
                                            <tr>
                                                <td>Referral Code:</td>
                                                <td class="light-font" x-text="userData.referral_code || 'Not available'">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Member Since:</td>
                                                <td class="light-font" x-text="formatDate(userData.created_at)"></td>
                                            </tr>
                                            <tr class="border-bottom-0">
                                                <td class="pb-0">Last Updated:</td>
                                                <td class="light-font pb-0" x-text="formatDate(userData.updated_at)"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function profileManager() {
                return {
                    loading: false,
                    editMode: false,
                    showPasswordForm: false,
                    profileImage: '{{ $user->image_url ? asset('storage/' . $user->image_url) : '' }}',
                    userData: {
                        name: '{{ $user->name ?? '' }}',
                        email: '{{ $user->email ?? '' }}',
                        phone: '{{ $user->phone ?? '' }}',
                        gender: '{{ $user->gender ?? '' }}',
                        date_of_birth: '{{ $user->date_of_birth ?? '' }}',
                        occupation: '{{ $user->occupation ?? '' }}',
                        nationality: '{{ $user->nationality ?? '' }}',
                        state_of_origin: '{{ $user->state_of_origin ?? '' }}',
                        lga: '{{ $user->lga ?? '' }}',
                        hometown: '{{ $user->hometown ?? '' }}',
                        marital_status: '{{ $user->marital_status ?? '' }}',
                        residential_address: '{{ $user->residential_address ?? '' }}',
                        referral_code: '{{ $user->referral_code ?? '' }}',
                        created_at: '{{ $user->created_at ?? '' }}',
                        updated_at: '{{ $user->updated_at ?? '' }}'
                    },
                    originalData: {},
                    passwordData: {
                        current_password: '',
                        password: '',
                        password_confirmation: ''
                    },
                    selectedFile: null,

                    init() {
                        this.originalData = JSON.parse(JSON.stringify(this.userData));
                    },

                    handleImageChange(event) {
                        const file = event.target.files[0];
                        if (file) {
                            this.selectedFile = file;
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                this.profileImage = e.target.result;
                            };
                            reader.readAsDataURL(file);
                        }
                    },

                    cancelEdit() {
                        this.editMode = false;
                        this.userData = JSON.parse(JSON.stringify(this.originalData));
                        this.selectedFile = null;
                        this.profileImage = '{{ $user->image_url ? asset('storage/' . $user->image_url) : '' }}';
                    },

                    async saveProfile() {
                        this.loading = true;
                        try {
                            const formData = new FormData();

                            // Add all user data to form
                            Object.keys(this.userData).forEach(key => {
                                if (this.userData[key] !== null && this.userData[key] !== undefined) {
                                    formData.append(key, this.userData[key]);
                                }
                            });

                            // Add image if selected
                            if (this.selectedFile) {
                                formData.append('image', this.selectedFile);
                            }

                            // Add CSRF token and method override
                            formData.append('_token', '{{ csrf_token() }}');
                            formData.append('_method', 'PATCH');

                            const response = await fetch('{{ route('tenant.realtor.profile.update') }}', {
                                method: 'POST',
                                body: formData
                            });

                            if (response.ok) {
                                // Update the original data
                                this.originalData = JSON.parse(JSON.stringify(this.userData));
                                this.editMode = false;
                                this.selectedFile = null;

                                // Show success message
                                this.showNotification('Profile updated successfully!', 'success');
                            } else {
                                const errorData = await response.json();
                                this.showNotification('Error updating profile: ' + (errorData.message || 'Unknown error'),
                                    'error');
                            }
                        } catch (error) {
                            console.error('Error saving profile:', error);
                            this.showNotification('An error occurred while saving the profile.', 'error');
                        } finally {
                            this.loading = false;
                        }
                    },

                    async updatePassword() {
                        this.loading = true;
                        try {
                            const response = await fetch('{{ route('tenant.realtor.profile.password') }}', {
                                method: 'PATCH',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(this.passwordData)
                            });

                            if (response.ok) {
                                this.showPasswordForm = false;
                                this.resetPasswordForm();
                                this.showNotification('Password updated successfully!', 'success');
                            } else {
                                const errorData = await response.json();
                                this.showNotification('Error updating password: ' + (errorData.message || 'Unknown error'),
                                    'error');
                            }
                        } catch (error) {
                            console.error('Error updating password:', error);
                            this.showNotification('An error occurred while updating the password.', 'error');
                        } finally {
                            this.loading = false;
                        }
                    },

                    resetPasswordForm() {
                        this.passwordData = {
                            current_password: '',
                            password: '',
                            password_confirmation: ''
                        };
                    },

                    formatDate(dateString) {
                        if (!dateString) return 'Not available';
                        return new Date(dateString).toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                    },

                    showNotification(message, type = 'info') {
                        // Create a simple toast notification
                        const toast = document.createElement('div');
                        toast.className =
                            `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
                        toast.style.cssText = 'top: 20px; right: 20px; z-index: 10000; min-width: 300px;';
                        toast.innerHTML = `
                        ${message}
                        <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
                    `;
                        document.body.appendChild(toast);

                        // Auto remove after 5 seconds
                        setTimeout(() => {
                            if (toast.parentElement) {
                                toast.remove();
                            }
                        }, 5000);
                    }
                }
            }
        </script>
    @endpush
@endsection
