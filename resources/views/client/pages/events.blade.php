@extends('client.client_master')

@section('title', 'Upcoming Events')

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
            color: #2c2e97;
            /* Using a color from your theme */
            text-decoration: none;
            transition: color 0.3s;
        }

        .event-card-content .event-title a:hover {
            color: #4b55c4;
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
            border-left: 3px solid #4b55c4;
        }

        .event-card-content .event-meta span {
            display: flex;
            align-items: center;
            padding-left: 10px;
        }

        .event-card-content .event-meta i {
            margin-right: 12px;
            color: #4b55c4;
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
        style="background-image: url('{{ asset('client/assets/images/inner-pages/coming-soon.jpg') }}'); background-color: rgba(0, 0, 0, 0.5);
background-blend-mode: overlay;
width: 100%;
background-repeat: no-repeat;
background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
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
                <div class="col-lg-12">
                    <div class="title-1">
                        <h3>Our Events</h3>
                    </div>

                    {{-- Event 1: This would typically be in a @foreach loop --}}
                    <div class="event-card">
                        <div class="event-card-image"
                            style="background-image: url('{{ asset('client/assets/images/property/1.jpg') }}');">
                            <div class="event-card-date">
                                <span class="day">15</span>
                                <span class="month">Dec</span>
                            </div>
                        </div>
                        <div class="event-card-content">
                            <h4 class="event-title"><a href="#">Realtor's Digital Marketing Summit</a></h4>
                            <p class="event-description font-roboto">An exclusive event for realtors to learn about the
                                latest trends in digital marketing and lead generation.</p>
                            <div class="event-meta">
                                <span><i class="fas fa-clock"></i> 9:00 AM - 5:00 PM</span>
                                <span><i class="fas fa-map-marker-alt"></i> Grand Convention Center, New York</span>
                            </div>
                            <button class="btn btn-gradient color-6 mt-3" data-bs-toggle="modal"
                                data-bs-target="#bookingModal" data-event-id="1"
                                data-event-name="Realtor's Digital Marketing Summit">Book Your Seat</button>
                        </div>
                    </div>

                    {{-- Event 2 --}}
                    <div class="event-card">
                        <div class="event-card-image"
                            style="background-image: url('{{ asset('client/assets/images/property/2.jpg') }}');">
                            <div class="event-card-date">
                                <span class="day">20</span>
                                <span class="month">Jan</span>
                            </div>
                        </div>
                        <div class="event-card-content">
                            <h4 class="event-title"><a href="#">Real Estate Investment Workshop</a></h4>
                            <p class="event-description font-roboto">Learn the secrets of successful real estate
                                investment from industry experts. Free for all registered realtors.</p>
                            <div class="event-meta">
                                <span><i class="fas fa-clock"></i> 10:00 AM - 4:00 PM</span>
                                <span><i class="fas fa-map-marker-alt"></i> Online Webinar</span>
                            </div>
                            <button class="btn btn-gradient color-6 mt-3" data-bs-toggle="modal"
                                data-bs-target="#bookingModal" data-event-id="2"
                                data-event-name="Real Estate Investment Workshop">Book Your Seat</button>
                        </div>
                    </div>

                    {{-- Event 3 --}}
                    <div class="event-card">
                        <div class="event-card-image"
                            style="background-image: url('{{ asset('client/assets/images/property/3.jpg') }}');">
                            <div class="event-card-date">
                                <span class="day">10</span>
                                <span class="month">Feb</span>
                            </div>
                        </div>
                        <div class="event-card-content">
                            <h4 class="event-title"><a href="#">Networking Night for Realtors</a></h4>
                            <p class="event-description font-roboto">Connect with fellow real estate professionals in a
                                relaxed and friendly atmosphere. Drinks and appetizers on us!</p>
                            <div class="event-meta">
                                <span><i class="fas fa-clock"></i> 6:00 PM - 9:00 PM</span>
                                <span><i class="fas fa-map-marker-alt"></i> The Rooftop Lounge, Downtown</span>
                            </div>
                            <button class="btn btn-gradient color-6 mt-3" data-bs-toggle="modal"
                                data-bs-target="#bookingModal" data-event-id="3"
                                data-event-name="Networking Night for Realtors">Book Your Seat</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Event Listing Section End -->

    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Book Your Free Seat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- The form action will point to your booking route when ready --}}
                    <form class="form-style-1" method="POST" action="">
                        @csrf
                        <input type="hidden" id="modal_event_id" name="event_id">

                        <div class="form-group">
                            <label for="modal_event_name">Event</label>
                            <input type="text" class="form-control" id="modal_event_name" disabled>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" placeholder="Your Phone Number"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="realtor_license"
                                placeholder="Realtor License # (Optional)">
                        </div>
                        <button type="submit" class="btn btn-gradient color-6 btn-block">Reserve My Spot</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var bookingModal = document.getElementById('bookingModal');
            bookingModal.addEventListener('show.bs.modal', function(event) {
                // Button that triggered the modal
                var button = event.relatedTarget;

                // Extract info from data-* attributes
                var eventId = button.getAttribute('data-event-id');
                var eventName = button.getAttribute('data-event-name');

                // Update the modal's content.
                var modalEventIdInput = bookingModal.querySelector('#modal_event_id');
                var modalEventNameInput = bookingModal.querySelector('#modal_event_name');

                modalEventIdInput.value = eventId;
                modalEventNameInput.value = eventName;
            });
        });
    </script>
@endsection
