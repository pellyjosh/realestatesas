@extends('themes.classic.admin.admin_master')
@section('title', 'Realtor Profile | Premium Refined Luxury Homes')
@section('content')

    <!-- Container-fluid start -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-left">
                        <h3>Realtor Profile
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

    <!-- agent profile section start -->
    <section class="agent-section property-section agent-profile-wrap">
        <div class="container">
            <div class="row ratio_55">
                <div class="container">
                    <div class="our-agent theme-card">
                        <div class="row">
                            <div class="col-sm-6 ratio_landscape">
                                <div class="agent-image">
                                    <img src="https://themes.pixelstrap.com/sheltos/assets/images/avatar/5.jpg"
                                        class="img-fluid bg-img" alt="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="our-agent-details">
                                    <h3 class="f-w-600">{{ $realtor->user ? $realtor->user->name : $realtor->first_name . ' ' . $realtor->last_name }}</h3>
                                    <h6>Real estate Property Realtor</h6>
                                    <ul>
                                        <li>
                                            <div class="media">
                                                <div class="icons-square">
                                                    <i data-feather="map-pin"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6>A-32, Albany, Newyork.</h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="icons-square">
                                                    <i data-feather="phone-call"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6>(+066) 518 - 457 - 5181</h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="icons-square">
                                                    <i data-feather="mail"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6>Contact@gmail.com</h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="with-link">
                                        </li>
                                    </ul>
                                </div>
                                <ul class="agent-social">
                                    <li><a href="https://www.facebook.com/" class="facebook"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                    <li>
                                        <a href="https://whatsapp.com/" class="twitter" style="background-color: #25d366">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="about-agent theme-card">
                        <h3>About the agent</h3>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="font-roboto">Residences can be classified by and how they are connected
                                    residences and land. Different types
                                    of housing tenure can be used for the same physical type.</p>
                            </div>
                            <div class="col-sm-4">
                                <p class="font-roboto">Connected residences owned by a single entity leased out, or
                                    owned separately with an agreement covering the relationship between units and
                                    common areas.</p>
                            </div>
                            <div class="col-sm-4">
                                <p class="font-roboto">Residential real estate may contain either a single family or
                                    multifamily structure that is available for occupation or
                                    for non-business purposes.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- agent profile section end -->

@endsection
</div>
<!-- tap to top end -->

<!-- customizer start -->
<div class="customizer-wrap">
    <div class="customizer-links">
        <i data-feather="settings"></i>
    </div>
    <div class="customizer-contain custom-scrollbar">
        <div class="setting-back">
            <i data-feather="x"></i>
        </div>
        <div class="layouts-settings">
            <div class="customizer-title">
                <h6 class="color-2">Layout type</h6>
            </div>
            <div class="option-setting">
                <span>Light</span>
                <label class="switch">
                    <input type="checkbox" name="chk1" value="option" class="setting-check"><span
                        class="switch-state"></span>
                </label>
                <span>Dark</span>
            </div>
        </div>
        <div class="layouts-settings">
            <div class="customizer-title">
                <h6 class="color-2">Layout Direction</h6>
            </div>
            <div class="option-setting">
                <span>LTR</span>
                <label class="switch">
                    <input type="checkbox" name="chk2" value="option" class="setting-check1"><span
                        class="switch-state"></span>
                </label>
                <span>RTL</span>
            </div>
        </div>
        <div class="layouts-settings">
            <div class="customizer-title">
                <h6 class="color-2">Unlimited Color</h6>
            </div>
            <div class="option-setting unlimited-color-layout">
                <div class="form-group">
                    <label for="ColorPicker3">color 3</label>
                    <input id="ColorPicker3" type="color" value="#ff5c41" name="Default">
                </div>
                <div class="form-group">
                    <label for="ColorPicker4">color 4</label>
                    <input id="ColorPicker4" type="color" value="#ff8c41" name="Default">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- customizer end -->

<!-- latest jquery-->
<script src="https://themes.pixelstrap.com/sheltos/assets/js/jquery-3.6.0.min.js"></script>

<!-- popper js-->
<script src="https://themes.pixelstrap.com/sheltos/assets/js/popper.min.js"></script>

<!-- magnific js -->
<script src="https://themes.pixelstrap.com/sheltos/assets/js/jquery.magnific-popup.js"></script>
<script src="https://themes.pixelstrap.com/sheltos/assets/js/zoom-gallery.js"></script>

<!-- Bootstrap js-->
<script src="https://themes.pixelstrap.com/sheltos/assets/js/bootstrap.bundle.min.js"></script>

<!-- feather icon js-->
<script src="https://themes.pixelstrap.com/sheltos/assets/js/feather-icon/feather.min.js"></script>
<script src="https://themes.pixelstrap.com/sheltos/assets/js/feather-icon/feather-icon.js"></script>

<!-- range slider js -->
<script src="https://themes.pixelstrap.com/sheltos/assets/js/jquery-ui.js"></script>
<script src="https://themes.pixelstrap.com/sheltos/assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="https://themes.pixelstrap.com/sheltos/assets/js/range-slider.js"></script>

<!-- slick js -->
<script src="https://themes.pixelstrap.com/sheltos/assets/js/slick.js"></script>
<script src="https://themes.pixelstrap.com/sheltos/assets/js/slick-animation.min.js"></script>
<script src="https://themes.pixelstrap.com/sheltos/assets/js/custom-slick.js"></script>

<!--grid js -->
<script src="https://themes.pixelstrap.com/sheltos/assets/js/grid-list.js"></script>

<!-- Template js-->
<script src="https://themes.pixelstrap.com/sheltos/assets/js/script.js"></script>

<!-- Customizer js-->
<script src="https://themes.pixelstrap.com/sheltos/assets/js/customizer.js"></script>

<!-- Color-picker js-->
<script src="https://themes.pixelstrap.com/sheltos/assets/js/color/single-property.js"></script>

</body>


<!-- Mirrored from themes.pixelstrap.com/sheltos/main/agent-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Jun 2025 13:52:25 GMT -->

</html>
