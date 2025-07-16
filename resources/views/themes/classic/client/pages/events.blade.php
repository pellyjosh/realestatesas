@extends('themes.classic.client.client_master')

@section('title', 'Events | Premium Refined Luxury Homes')

@section('main')

    {{-- Custom CSS for the modern event cards --}}
    <style>
        .event-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.07);
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            display: flex;
            margin-bottom: 30px;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .event-card-image {
            position: relative;
            flex: 0 0 220px;
            background-size: cover;
            background-position: center;
        }

        .event-card-date {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: rgba(0, 0, 0, 0.6);
            color: #fff;
            padding: 10px 15px;
            border-radius: 8px;
            text-align: center;
            line-height: 1.2;
            backdrop-filter: blur(5px);
        }

        .event-card-date .day {
            font-size: 28px;
            font-weight: 700;
            display: block;
        }

        .event-card-date .month {
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .event-card-content {
            padding: 25px 30px;
            flex-grow: 1;
        }

        .event-card-content .event-title {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 22px;
            font-weight: 600;
        }

        .event-card-content .event-title a {
            color: #76c305;
            /* Using a color from your theme */
            text-decoration: none;
            transition: color 0.3s;
        }

        .event-card-content .event-title a:hover {
            color: #62a004;
            /* Darker shade for hover */
        }

        .event-card-content .event-description {
            font-size: 15px;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .event-card-content .event-meta {
            display: flex;
            flex-direction: column;
            gap: 10px;
            font-size: 14px;
            color: #555;
            padding-left: 5px;
            border-left: 3px solid #76c305;
        }

        .event-card-content .event-meta span {
            display: flex;
            align-items: center;
            padding-left: 10px;
        }

        .event-card-content .event-meta i {
            margin-right: 12px;
            color: #76c305;
            width: 18px;
            text-align: center;
        }

        .booking-form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.07);
            position: sticky;
            top: 20px;
        }

        /* Override Bootstrap primary and success colors for consistency */
        .text-primary {
            color: #76c305 !important;
        }

        .border-success {
            border-color: #76c305 !important;
        }

        @media (max-width: 991px) {
            .booking-form-container {
                margin-top: 40px;
                position: static;
            }
        }

        @media (max-width: 767px) {
            .event-card {
                flex-direction: column;
            }

            .event-card-image {
                flex-basis: 200px;
            }
        }
    </style>

    <!-- Breadcrumb Section -->
    <section class="breadcrumb-section-main breadcrumb-section-sm-padding"
        style="background-image: url('{{ asset('themes/classic/client/assets/images/inner-pages/coming-soon.jpg') }}'); background-color: rgba(0, 0, 0, 0.5);
        background-blend-mode: overlay;
        width: 100%;
        background-repeat: no-repeat;
        background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content mt-4">
                        <h2 style="color: rgba(255, 255, 255, 0.9);">Upcoming Events</h2>
                        <p style="color: rgba(255, 255, 255, 0.9);">Join our exclusive events. Book your seat for free!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section end -->

    <!-- Event Listing Section -->
    <section class="agent-section-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    {{-- <div class="title-1">
                        <h3>Our Events</h3>
                    </div> --}}

                    {{-- Dynamic Event Listing --}}
                    @forelse ($events as $event)
                        @php
                            // Parse start and end times, gracefully handling a missing end time.
                            $startDateTime = \Carbon\Carbon::parse($event->start_date_time);
                            $endDateTime = $event->end_date_time ? \Carbon\Carbon::parse($event->end_date_time) : null;

                            // Determine the display logic
                            $hasEndTime = (bool) $endDateTime;
                            $isSameDay = $hasEndTime && $startDateTime->isSameDay($endDateTime);
                        @endphp
                        <div class="event-card">
                            <div class="event-card-image"
                                style="background-image: url('{{ asset('client/assets/images/property/' . rand(1, 3) . '.jpg') }}');">
                                {{-- Using random image for now, ideally store image path in DB --}}
                                <div class="event-card-date">
                                    {{-- Display the day and month from the start date --}}
                                    <span class="day">{{ $startDateTime->format('d') }}</span>
                                    <span class="month">{{ $startDateTime->format('M') }}</span>
                                </div>
                            </div>
                            <div class="event-card-content">
                                <h4 class="event-title"><a href="#">{{ $event->name }}</a></h4>
                                <p class="event-description font-roboto">{{ $event->description }}</p>
                                <div class="event-meta">
                                    <span>
                                        <i class="fas fa-clock"></i>
                                        @if ($hasEndTime && !$isSameDay)
                                            {{-- Different days: Show date range --}}
                                            {{ $startDateTime->format('M d, Y') }} - {{ $endDateTime->format('M d, Y') }}
                                        @else
                                            {{-- Same day or no end time: Show single date --}}
                                            {{ $startDateTime->format('M d, Y') }}
                                        @endif
                                    </span>
                                    <span><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</span>
                                </div>
                                <button class="btn btn-gradient color-6 mt-3 select-event-btn"
                                    data-event-id="{{ $event->id }}" data-event-name="{{ $event->name }}">Book Your
                                    Seat</button>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info text-center p-4" role="alert">
                            <h4 class="alert-heading">No Events Yet!</h4>
                            <p>There are currently no upcoming events scheduled. Please check back soon for updates.</p>
                        </div>
                    @endforelse
                    {{-- End Dynamic Event Listing --}}
                </div>
                <div class="col-lg-4">
                    {{-- Booking Form --}}
                    <div class="booking-form-container">
                        <div id="formMessages" class="mb-3"></div>
                        <div class="title-1">
                            <h3>Book Your Free Seat</h3>
                        </div>
                        <form class="form-style-1" method="POST" action="" id="bookingForm">
                            @csrf
                            <input type="hidden" id="form_event_id" name="event_id">

                            <div class="mb-4">
                                <label for="form_event_name" class="form-label fw-bold text-primary">Selected Event</label>
                                <input type="text" class="form-control" id="form_event_name" name="event_name"
                                    placeholder="Select an event" disabled>
                            </div>

                            <h5 class="mb-3 text-primary">Your Information</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" name="first_name"
                                            placeholder="First Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                                            required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" name="email" placeholder="Email"
                                            required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="text" class="form-control" name="phone" placeholder="Phone Number"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="how_heard" class="form-label fw-bold text-primary">How did you hear about
                                    us?</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-bullhorn"></i></span>
                                    <select class="form-control" id="how_heard" name="how_heard" required>
                                        <option value="">Select an option</option>
                                        <option value="radio">Radio</option>
                                        <option value="social_media">Social Media</option>
                                        <option value="friend">From a friend</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <hr class="my-4">
                            <h5 class="mb-3 text-primary">Invited By (Optional)</h5>
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                                    <input type="text" class="form-control" name="inviter_referral_code"
                                        id="inviter_referral_code" placeholder="Enter Referral Code" disabled>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-gradient color-6 btn-block w-100 py-3">Reserve My
                                Spot</button>
                        </form>

                        <div class="text-center my-4">
                            <a href="#" id="showRetrieveFormBtn" class="text-muted"
                                style="text-decoration: underline; font-style: italic;">Already registered? Retrieve your
                                referral link.</a>
                        </div>

                        <div id="retrieveReferralFormContainer" style="display: none;">
                            <h5 class="mb-3 text-primary">Retrieve Your Link</h5>
                            <form id="retrieveReferralForm" class="form-style-1">
                                @csrf
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                    <select class="form-control" name="retrieval_event_id" required>
                                        <option value="">Select an Event</option>
                                        @foreach ($events as $event)
                                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" class="form-control" name="retrieval_phone"
                                        placeholder="Enter your phone number" required>
                                </div>

                                <button type="submit" class="btn btn-gradient color-6 btn-block w-100 py-2">Retrieve
                                    Link</button>
                            </form>
                        </div>

                        <div class="mt-4 p-4 bg-light rounded text-center border border-success border-2"
                            style="border-style: dashed !important;">
                            <p class="mb-2 fw-bold text-dark">Your Referral Link</p>
                            <p id="referralMessage" class="small text-muted">Your unique referral link will appear here
                                after you book your seat.</p>
                            <div id="referralLinkWrapper" style="display: none;">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="referralLinkInput" value=""
                                        readonly>
                                    <button class="btn btn-outline-secondary" type="button" id="copyReferralLinkBtn">
                                        <i class="fas fa-copy"></i> Copy
                                    </button>
                                </div>
                                <p class="mb-0 small text-muted">Invite 10 people and get a ₦5,000 cash reward.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Event Listing Section End -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ---ELEMENT SELECTORS---
            const bookingForm = document.getElementById('bookingForm');
            const retrieveForm = document.getElementById('retrieveReferralForm');
            const showRetrieveFormBtn = document.getElementById('showRetrieveFormBtn');
            const retrieveFormContainer = document.getElementById('retrieveReferralFormContainer');
            const retrievalPhoneInput = retrieveForm.querySelector('[name="retrieval_phone"]');
            const eventIdInput = document.getElementById('form_event_id');
            const eventNameInput = document.getElementById('form_event_name');
            const inviterReferralCodeInput = document.getElementById('inviter_referral_code');

            const referralMessage = document.getElementById('referralMessage');
            const referralLinkWrapper = document.getElementById('referralLinkWrapper');
            const referralLinkInput = document.getElementById('referralLinkInput');
            const copyReferralLinkBtn = document.getElementById('copyReferralLinkBtn');
            const formMessages = document.getElementById('formMessages');

            // ---FUNCTIONS---

            // Function to display messages to the user
            function showMessage(message, isError = false) {
                formMessages.innerHTML =
                    `<div class="alert alert-${isError ? 'danger' : 'success'}">${message}</div>`;
                formMessages.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }

            // Function to display the generated referral link
            function displayReferralLink(link) {
                referralMessage.style.display = 'none';
                referralLinkInput.value = link;
                referralLinkWrapper.style.display = 'block';
            }

            // Function to handle pre-population from a referral link URL (now uses referral_code)
            function populateFormFromQueryParams() {
                const urlParams = new URLSearchParams(window.location.search);
                const incomingEventId = urlParams.get('event_id'); // New: Get event_id from URL
                const incomingReferralCode = urlParams.get('referral_code');

                if (incomingReferralCode) {
                    // Populate the referral code input field
                    inviterReferralCodeInput.value = incomingReferralCode;
                    showMessage(`Referral code applied. Please complete your registration.`, false);

                    if (incomingEventId) {
                        // Pre-select the event if event_id is in the URL
                        const eventButton = document.querySelector(
                            `.select-event-btn[data-event-id="${incomingEventId}"]`);
                        if (eventButton) {
                            eventIdInput.value = incomingEventId;
                            eventNameInput.value = eventButton.getAttribute('data-event-name');
                        } else {
                            // Fallback if event ID from URL doesn't match a listed event
                            eventIdInput.value = incomingEventId; // Still set ID
                            eventNameInput.value = `Event ID: ${incomingEventId} (Details not found)`;
                        }
                    }

                    // Always scroll to the form if a referral code is present
                    document.querySelector('.booking-form-container').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                } else {
                    inviterReferralCodeInput.value = ''; // Ensure field is empty
                }
                // Clear event selection if no referral code is present in the URL
                if (!incomingReferralCode) {
                    eventIdInput.value = '';
                    eventNameInput.value = '';
                }
                referralMessage.style.display = 'block';
                referralLinkWrapper.style.display = 'none';
            }

            // ---EVENT LISTENERS---

            // Handle booking form submission
            bookingForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const submitButton = bookingForm.querySelector('button[type="submit"]');
                const originalButtonText = submitButton.innerHTML;
                submitButton.innerHTML = 'Processing...';
                submitButton.disabled = true;

                const formData = new FormData(bookingForm);
                // The disabled event name input is not included in FormData, so we add it manually
                formData.append('event_name', eventNameInput.value);

                fetch('/book-event', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showMessage(
                                'Booking successful! Your referral link is shown below.',
                                false);
                            displayReferralLink(data.referral_link);
                            bookingForm.reset(); // Optionally reset the form
                            eventNameInput.value = ''; // Clear event name after reset
                            eventIdInput.value = '';
                        } else {
                            // Handle validation errors or other failures
                            let errorMessage = data.message || 'An unknown error occurred.';
                            if (data.errors) {
                                errorMessage += '<ul class="mt-2">';
                                for (const key in data.errors) {
                                    errorMessage += `<li>${data.errors[key][0]}</li>`;
                                }
                                errorMessage += '</ul>';
                            }
                            showMessage(errorMessage, true);
                        }
                    })
                    .catch(error => {
                        showMessage('A network error occurred. Please try again.', true);
                        console.error('Error:', error);
                    })
                    .finally(() => {
                        submitButton.innerHTML = originalButtonText;
                        submitButton.disabled = false;
                    });
            });

            // Show the retrieval form
            showRetrieveFormBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (retrieveFormContainer.style.display === 'none') {
                    retrievalPhoneInput.value = ''; // Clear phone field when showing
                    retrieveFormContainer.style.display = 'block';
                    retrieveFormContainer.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                } else {
                    retrieveFormContainer.style.display = 'none';
                }
            });

            // Handle retrieval form submission
            retrieveForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const eventId = retrieveForm.querySelector('[name="retrieval_event_id"]').value;
                const phone = retrievalPhoneInput.value;
                const submitButton = retrieveForm.querySelector('button[type="submit"]');
                const originalButtonText = submitButton.innerHTML;
                submitButton.innerHTML = 'Retrieving...';
                submitButton.disabled = true;

                fetch('/retrieve-referral', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            event_id: eventId,
                            phone: phone
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showMessage('Referral link retrieved successfully!', false);
                            displayReferralLink(data.referral_link); // Display the retrieved link
                            retrievalPhoneInput.value = ''; // Clear phone field on success
                            retrieveFormContainer.style.display = 'none'; // Hide retrieval form
                        } else {
                            showMessage(data.message ||
                                'Could not find a registration with that phone number.', true
                            );
                        }
                    })
                    .catch(error => { // Catch network errors
                        showMessage(
                            'A network error occurred. Please check your connection and try again.',
                            true);
                        console.error('Error:', error);
                    })
                    .finally(() => { // Always re-enable button
                        submitButton.innerHTML = originalButtonText;
                        submitButton.disabled = false;
                    });

            });


            // Handle event selection from cards
            document.querySelectorAll('.select-event-btn').forEach(button => {
                button.addEventListener('click', function() {
                    eventIdInput.value = this.getAttribute('data-event-id');
                    eventNameInput.value = this.getAttribute('data-event-name');
                    document.querySelector('.booking-form-container').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                });
            });

            // Handle copy button click
            copyReferralLinkBtn.addEventListener('click', function() {
                referralLinkInput.select();
                referralLinkInput.setSelectionRange(0, 99999); // For mobile devices
                try {
                    document.execCommand('copy');
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check"></i> Copied!';
                    setTimeout(() => {
                        this.innerHTML = originalText;
                    }, 2000);
                } catch (err) {
                    console.error('Failed to copy text: ', err);
                    alert('Failed to copy link. Please copy it manually.');
                }
            });

            // ---INITIALIZATION---
            populateFormFromQueryParams();
        });
    </script>
@endsection
