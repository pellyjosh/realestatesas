<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Book Inspection - {{ $landingPage->property->name ?? 'Property' }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --primary-color: #91d20a;
            --primary-dark: #7bb309;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .inspection-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }

        .property-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
        }

        .property-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .property-header * {
            position: relative;
            z-index: 1;
        }

        .property-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .property-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 20px;
        }

        .property-badges {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .property-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .inspection-form-section {
            padding: 50px;
        }

        .form-title {
            color: var(--dark-color);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-align: center;
        }

        .form-subtitle {
            color: var(--secondary-color);
            text-align: center;
            margin-bottom: 40px;
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            color: var(--dark-color);
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .form-control,
        .form-select {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(145, 210, 10, 0.25);
            background: white;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(145, 210, 10, 0.3);
            color: white;
        }

        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .success-message {
            background: linear-gradient(135deg, var(--success-color) 0%, #20c997 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            margin-top: 30px;
        }

        .error-message {
            background: linear-gradient(135deg, var(--danger-color) 0%, #e74c3c 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .agent-info {
            background: var(--light-color);
            border-radius: 15px;
            padding: 30px;
            margin-top: 30px;
            text-align: center;
        }

        .agent-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 20px;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: bold;
        }

        .whatsapp-btn {
            background: #25d366;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .whatsapp-btn:hover {
            background: #128c7e;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 211, 102, 0.3);
        }

        .property-details {
            background: var(--light-color);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            color: var(--dark-color);
        }

        .detail-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        @media (max-width: 768px) {
            .inspection-form-section {
                padding: 30px 20px;
            }

            .property-header {
                padding: 30px 20px;
            }

            .property-title {
                font-size: 2rem;
            }

            .form-title {
                font-size: 1.5rem;
            }
        }

        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            top: 10%;
            left: 10%;
            width: 80px;
            height: 80px;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            top: 20%;
            right: 20%;
            width: 120px;
            height: 120px;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            bottom: 30%;
            left: 15%;
            width: 60px;
            height: 60px;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }
    </style>
</head>

<body>
    <!-- Floating Background Elements -->
    <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div>

    <div class="inspection-container" x-data="inspectionFormOnly()">
        <!-- Property Header -->
        <div class="property-header">
            <h1 class="property-title">{{ $landingPage->property->name ?? 'Premium Property' }}</h1>
            <p class="property-subtitle">{{ $landingPage->property->full_address ?? 'Prime Location' }}</p>
            <div class="property-badges">
                <span class="property-badge">
                    <i class="fas fa-home me-2"></i>{{ ucfirst($landingPage->property->property_type ?? 'House') }}
                </span>
                <span class="property-badge">
                    <i class="fas fa-tag me-2"></i>For {{ ucfirst($landingPage->property->listing_type ?? 'Sale') }}
                </span>
                @if ($landingPage->property->formatted_price)
                    <span class="property-badge">
                        <i class="fas fa-dollar-sign me-2"></i>{{ $landingPage->property->formatted_price }}
                    </span>
                @endif
            </div>
        </div>

        <!-- Inspection Form Section -->
        <div class="inspection-form-section">
            <h2 class="form-title">
                <i class="fas fa-calendar-check text-primary me-3"></i>
                Book Your Inspection
            </h2>
            <p class="form-subtitle">
                Schedule a personalized viewing of this exceptional property. Our expert agent will guide you through
                every detail.
            </p>

            <!-- Property Quick Details -->
            <div class="property-details">
                <div class="row">
                    @if ($landingPage->property->bedrooms || $landingPage->property->bathrooms)
                        <div class="col-md-6">
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-bed"></i>
                                </div>
                                <span>
                                    @if ($landingPage->property->bedrooms)
                                        {{ $landingPage->property->bedrooms }} Bedrooms
                                    @endif
                                    @if ($landingPage->property->bedrooms && $landingPage->property->bathrooms)
                                        •
                                    @endif
                                    @if ($landingPage->property->bathrooms)
                                        {{ $landingPage->property->bathrooms }} Bathrooms
                                    @endif
                                </span>
                            </div>
                        </div>
                    @endif

                    @if ($landingPage->property->built_area)
                        <div class="col-md-6">
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-ruler-combined"></i>
                                </div>
                                <span>{{ number_format($landingPage->property->built_area, 0) }} sqm Built Area</span>
                            </div>
                        </div>
                    @endif

                    @if ($landingPage->property->land_size)
                        <div class="col-md-6">
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-mountain"></i>
                                </div>
                                <span>{{ number_format($landingPage->property->land_size, 0) }} sqm Land Size</span>
                            </div>
                        </div>
                    @endif

                    @if ($landingPage->property->parking_spaces)
                        <div class="col-md-6">
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-car"></i>
                                </div>
                                <span>{{ $landingPage->property->parking_spaces }} Parking Spaces</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Inspection Form -->
            <form @submit.prevent="submitForm" class="inspection-form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-user me-2 text-primary"></i>Full Name *
                            </label>
                            <input type="text" x-model="formData.name" class="form-control"
                                placeholder="Enter your full name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-envelope me-2 text-primary"></i>Email Address *
                            </label>
                            <input type="email" x-model="formData.email" class="form-control"
                                placeholder="your.email@example.com" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-phone me-2 text-primary"></i>Phone Number *
                            </label>
                            <input type="tel" x-model="formData.phone" class="form-control"
                                placeholder="+234 800 000 0000" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-calendar me-2 text-primary"></i>Preferred Date *
                            </label>
                            <input type="date" x-model="formData.date" class="form-control" :min="minDate"
                                required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-clock me-2 text-primary"></i>Preferred Time *
                            </label>
                            <input type="time" x-model="formData.time" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-users me-2 text-primary"></i>Number of Visitors
                            </label>
                            <select x-model="formData.visitors" class="form-select">
                                <option value="1">Just me</option>
                                <option value="2">2 people</option>
                                <option value="3">3 people</option>
                                <option value="4">4 people</option>
                                <option value="5+">5+ people</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-comment me-2 text-primary"></i>Special Requests or Questions
                    </label>
                    <textarea x-model="formData.message" class="form-control" rows="4"
                        placeholder="Any specific areas you'd like to focus on, questions about the property, or special requirements..."></textarea>
                </div>

                <button type="submit" class="btn-submit" :disabled="isSubmitting">
                    <template x-if="isSubmitting">
                        <span><i class="fas fa-spinner fa-spin me-2"></i>Submitting Request...</span>
                    </template>
                    <template x-if="submissionState === 'success'">
                        <span><i class="fas fa-check me-2"></i>Request Sent Successfully!</span>
                    </template>
                    <template x-if="submissionState === 'error'">
                        <span><i class="fas fa-exclamation-triangle me-2"></i>Try Again</span>
                    </template>
                    <template x-if="submissionState === 'idle'">
                        <span><i class="fas fa-calendar-check me-2"></i>Schedule My Inspection</span>
                    </template>
                </button>

                <!-- Success Message -->
                <div x-show="submissionState === 'success'" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100" class="success-message">
                    <i class="fas fa-check-circle me-2" style="font-size: 2rem;"></i>
                    <h4 class="mb-2">Inspection Scheduled Successfully!</h4>
                    <p class="mb-0">Thank you for your interest. Our agent will contact you within 24 hours to
                        confirm all the details and answer any questions you may have.</p>
                </div>

                <!-- Error Message -->
                <div x-show="submissionState === 'error' && errorMessage"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100" class="error-message">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Error:</strong><br>
                    <span x-text="errorMessage"></span>
                </div>
            </form>

            <!-- Agent Information -->
            @if ($referralUser)
                <div class="agent-info">
                    <div class="agent-avatar">
                        @if ($referralUser->image_url)
                            <img src="{{ $referralUser->image_url }}" alt="{{ $referralUser->name }}"
                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                        @else
                            {{ strtoupper(substr($referralUser->name, 0, 1)) }}
                        @endif
                    </div>
                    <h5 class="mb-2">{{ $referralUser->name }}</h5>
                    <p class="text-muted mb-3">Your Dedicated Property Consultant</p>
                    <p class="small">
                        {{ $referralUser->name }} is an experienced real estate professional committed to helping you
                        find the perfect property.
                        @if ($referralUser->occupation)
                            As a {{ strtolower($referralUser->occupation) }},
                        @endif
                        {{ $referralUser->gender === 'male' ? 'he' : ($referralUser->gender === 'female' ? 'she' : 'they') }}
                        brings extensive market knowledge and personalized service to every client.
                    </p>

                    @php
                        $whatsappNumber = $referralUser->phone_number
                            ? preg_replace('/[^0-9]/', '', $referralUser->phone_number)
                            : '2348000000000';
                        $whatsappMessage = "Hi {$referralUser->name}, I'm interested in {$landingPage->property->name}. Can you provide more details?";
                    @endphp

                    <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($whatsappMessage) }}"
                        class="whatsapp-btn" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        Chat with {{ $referralUser->name }}
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Alpine.js Inspection Form Component -->
    <script>
        function inspectionFormOnly() {
            return {
                formData: {
                    name: '',
                    email: '',
                    phone: '',
                    date: '',
                    time: '',
                    visitors: '1',
                    message: '',
                    property_id: {{ $landingPage->property->id ?? 'null' }},
                    referral_code: null
                },
                submissionState: 'idle', // idle, submitting, success, error
                isSubmitting: false,
                errorMessage: '',

                get minDate() {
                    return new Date().toISOString().split('T')[0];
                },

                async submitForm() {
                    this.isSubmitting = true;
                    this.submissionState = 'submitting';
                    this.errorMessage = '';

                    try {
                        // Get CSRF token
                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                        // Map form data to API expected format
                        const apiData = {
                            property_id: this.formData.property_id,
                            name: this.formData.name,
                            email: this.formData.email,
                            phone: this.formData.phone,
                            preferred_date: this.formData.date,
                            preferred_time: this.formData.time,
                            message: this.formData.message,
                            referral_code: this.formData.referral_code
                        };

                        const response = await fetch('/property-inspections', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify(apiData)
                        });

                        const data = await response.json();

                        if (data.success) {
                            this.submissionState = 'success';

                            // Reset form after 10 seconds
                            setTimeout(() => {
                                this.resetForm();
                            }, 10000);
                        } else {
                            this.submissionState = 'error';
                            this.errorMessage = data.message || 'An error occurred while submitting your request.';

                            // Show validation errors if any
                            if (data.errors) {
                                const errorMessages = Object.values(data.errors).flat();
                                this.errorMessage = errorMessages.join(' ');
                            }

                            // Reset to idle after 8 seconds to allow retry
                            setTimeout(() => {
                                this.submissionState = 'idle';
                                this.errorMessage = '';
                            }, 8000);
                        }

                    } catch (error) {
                        console.error('Submission error:', error);
                        this.submissionState = 'error';
                        this.errorMessage = 'Network error. Please check your connection and try again.';

                        // Reset to idle after 8 seconds to allow retry
                        setTimeout(() => {
                            this.submissionState = 'idle';
                            this.errorMessage = '';
                        }, 8000);
                    } finally {
                        this.isSubmitting = false;
                    }
                },

                resetForm() {
                    this.formData = {
                        name: '',
                        email: '',
                        phone: '',
                        date: '',
                        time: '',
                        visitors: '1',
                        message: '',
                        property_id: {{ $landingPage->property->id ?? 'null' }},
                        referral_code: null
                    };
                    this.submissionState = 'idle';
                    this.errorMessage = '';
                    this.loadPropertyData();
                },

                loadPropertyData() {
                    // Get referral code from URL parameters if available
                    const urlParams = new URLSearchParams(window.location.search);
                    const referralCode = urlParams.get('ref');
                    if (referralCode) {
                        this.formData.referral_code = referralCode;
                    }
                },

                init() {
                    // Initialize with property data
                    this.loadPropertyData();
                }
            }
        }
    </script>
</body>

</html>
