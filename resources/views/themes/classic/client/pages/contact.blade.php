@extends('themes.classic.client.client_master')
@section('title', 'Contact | Premium Refined Luxury Homes')
@section('main')
    <!-- breadcrumb start -->
    <section class="breadcrumb-section-main breadcrumb-section-sm-padding"
        style="background-image: url('{{ asset('themes/classic/client/assets/images/inner-pages/coming-soon.jpg') }}'); background-color: rgba(0, 0, 0, 0.5);
        background-blend-mode: overlay;
        width: 100%;
        background-repeat: no-repeat;
        background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <div>
                            <h1>Contact us</h1>
                            <nav aria-label="breadcrumb" class="theme-breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('tenant.client.home') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Contact us</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- Get in touch section start -->
    <section class="small-section contact-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="log-in theme-card">
                        <div class="title-3 text-start">
                            <h3>Let's Get In Touch</h3>
                        </div>
                        <form class="row gx-3 get-in-touch">
                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Enter your name" required="">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i data-feather="phone"></i>
                                        </div>
                                    </div>
                                    <input placeholder="phone number" class="form-control" name="mobnumber" id="tbNumbers"
                                        oninput="maxLengthCheck(this)" type = "tel"
                                        onkeypress="javascript:return isNumber(event)" maxlength = "9" required="">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i data-feather="mail"></i>
                                        </div>
                                    </div>
                                    <input type="email" class="form-control" placeholder="email address" required="">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6">Write here something
                                </textarea>
                            </div>
                            <div class="col-md-12 submit-btn">
                                <button class="btn btn-gradient color-6 mt-3" type="submit">Send Your Message</button>
                            </div>
                        </form>
                    </div>
                    <div class="theme-card">
                        <div class="contact-bottom">
                            <div class="contact-map">
                                <iframe title="contact location"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.1583091352!2d-74.11976373946229!3d40.69766374859258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1563449626439!5m2!1sen!2sin"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 contact_section contact_right">
                    <div class="row">
                        <div class="col-lg-12 col-sm-6">
                            <div class="contact_wrap">
                                <i data-feather="map-pin"></i>
                                <h4>Where ?</h4>
                                <p class="font-roboto">Suite 201, Capital Center Complex <br>
                                    Summit Road,Asaba Delta State, Nigeria <br>
                                    00851030093 | 07037495700 | 08149491659
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6">
                            <div class="contact_wrap">
                                <i data-feather="phone"></i>
                                <h4>Phone Number?</h4>
                                <p>
                                    00851030093 <br>
                                    07037495700 <br>
                                    08149491659
                                    <br>
                                </p>
                            </div>
                        </div>
                        {{-- <div class="col-lg-12 col-sm-6">
                            <div class="contact_wrap">
                                <i data-feather="mail"></i>
                                <h4>Online service</h4>
                                <ul>
                                    <li>Inquiries: sheltos@.in</li>
                                    <li>Careers: hr@.in</li>
                                    <li>Support: help@.in</li>
                                    <li>+86 163 - 451 - 7894</li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Get in touch section end -->
@endsection
