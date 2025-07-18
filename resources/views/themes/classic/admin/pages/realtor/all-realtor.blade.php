@extends('themes.classic.admin.admin_master')
@section('title', 'Edit Agent | Premium Refined Luxury Homes')
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
                        <div class="col-xl-4 col-md-6 wow fadeInUp">
                            <div class="property-box">
                                <div class="agent-image">
                                    <div>
                                        <img src="{{ asset('themes/classic/admin/assets/images/avatar/5.jpg') }}" class="bg-img"
                                            alt="">
                                        <span class="label label-shadow">2 properties</span>
                                        <div class="agent-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://accounts.google.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-1.png') }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-2.png') }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-3.png') }}"
                                                            alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="agent-content">
                                    <h3><a href="agent-profile.html">Zack Lee</a></h3>
                                    <p class="font-roboto">Real estate Agent</p>
                                    <ul class="agent-contact">
                                        <li>
                                            <i class="fas fa-phone-alt"></i>
                                            <span class="phone-number">+91 426015400</span>
                                            <span class="character">+91 42601****</span>

                                        </li>
                                        <li><i class="fas fa-envelope"></i> zack@gmail.com</li>
                                        <li><i class="fas fa-fax"></i> 247 054 787</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"><i
                                                    class="fas fa-ban" style="color: white;"></i>
                                            </button>
                                            <a href="{{ route('tenant.admin.edit.realtor') }}" class="btn btn-primary btn-sm mx-1 p-1"
                                                style="font-size: 0.8em;"><i class="fas fa-edit"
                                                    style="color: white;"></i>
                                            </a>
                                            <form action="" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm p-1"
                                                    style="font-size: 0.8em;"><i class="fas fa-trash-alt"
                                                        style="color: white;"></i></button>
                                            </form>
                                        </div>
                                        <a href="{{ route('tenant.admin.realtor.profile') }}">View profile <i
                                                class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 wow fadeInUp">
                            <div class="property-box">
                                <div class="agent-image">
                                    <div>
                                        <img src="https://themes.pixelstrap.com/sheltos/assets/images/avatar/3.jpg"
                                            class="bg-img" alt="">
                                        <span class="label label-shadow">3 properties</span>
                                        <div class="agent-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://accounts.google.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-1.png') }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-2.png') }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-3.png') }}"
                                                            alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="agent-content">
                                    <h3><a href="agent-profile.html">Greta Life</a></h3>
                                    <p class="font-roboto">Real estate agent</p>
                                    <ul class="agent-contact">
                                        <li>
                                            <i class="fas fa-phone-alt"></i>
                                            <span class="phone-number">+91 5470087201</span>
                                            <span class="character">+91 547008****</span>

                                        </li>
                                        <li><i class="fas fa-envelope"></i> life@gmail.in</li>
                                        <li><i class="fas fa-fax"></i> 248 200 325</li>
                                    </ul>
                                      <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"><i
                                                    class="fas fa-ban" style="color: white;"></i>
                                            </button>
                                            <a href="{{ route('tenant.admin.edit.realtor') }}" class="btn btn-primary btn-sm mx-1 p-1"
                                                style="font-size: 0.8em;"><i class="fas fa-edit"
                                                    style="color: white;"></i>
                                            </a>
                                            <form action="" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm p-1"
                                                    style="font-size: 0.8em;"><i class="fas fa-trash-alt"
                                                        style="color: white;"></i></button>
                                            </form>
                                        </div>
                                        <a href="{{ route('tenant.admin.realtor.profile') }}">View profile <i
                                                class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 wow fadeInUp">
                            <div class="property-box">
                                <div class="agent-image">
                                    <div>
                                        <img src="https://themes.pixelstrap.com/sheltos/assets/images/avatar/2.jpg"
                                            class="bg-img" alt="">
                                        <span class="label label-shadow">6 properties</span>
                                        <div class="agent-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://accounts.google.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-1.png') }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-2.png') }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-3.png') }}"
                                                            alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="agent-content">
                                    <h3><a href="agent-profile.html">Bob Frapples</a></h3>
                                    <p class="font-roboto">Sales Executive</p>
                                    <ul class="agent-contact">
                                        <li>
                                            <i class="fas fa-phone-alt"></i>
                                            <span class="phone-number">+91 2714203587</span>
                                            <span class="character">+91 271420****</span>

                                        </li>
                                        <li><i class="fas fa-envelope"></i> bob@gmail.in</li>
                                        <li><i class="fas fa-fax"></i> 571 241 925</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"><i
                                                    class="fas fa-ban" style="color: white;"></i>
                                            </button>
                                            <a href="{{ route('tenant.admin.edit.realtor') }}" class="btn btn-primary btn-sm mx-1 p-1"
                                                style="font-size: 0.8em;"><i class="fas fa-edit"
                                                    style="color: white;"></i>
                                            </a>
                                            <form action="" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm p-1"
                                                    style="font-size: 0.8em;"><i class="fas fa-trash-alt"
                                                        style="color: white;"></i></button>
                                            </form>
                                        </div>
                                        <a href="{{ route('tenant.admin.realtor.profile') }}">View profile <i
                                                class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 wow fadeInUp">
                            <div class="property-box">
                                <div class="agent-image">
                                    <div>
                                        <img src="https://themes.pixelstrap.com/sheltos/assets/images/avatar/6.jpg"
                                            class="bg-img" alt="">
                                        <span class="label label-shadow">1 properties</span>
                                        <div class="agent-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://accounts.google.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-1.png') }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-2.png') }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-3.png') }}"
                                                            alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="agent-content">
                                    <h3><a href="agent-profile.html">Paige Turner</a></h3>
                                    <p class="font-roboto">Marketing</p>
                                    <ul class="agent-contact">
                                        <li>
                                            <i class="fas fa-phone-alt"></i>
                                            <span class="phone-number">+91 3178405278</span>
                                            <span class="character">+91 317840****</span>

                                        </li>
                                        <li><i class="fas fa-envelope"></i> turner@gmail.in</li>
                                        <li><i class="fas fa-fax"></i> 287 845 317</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"><i
                                                    class="fas fa-ban" style="color: white;"></i>
                                            </button>
                                            <a href="{{ route('tenant.admin.edit.realtor') }}" class="btn btn-primary btn-sm mx-1 p-1"
                                                style="font-size: 0.8em;"><i class="fas fa-edit"
                                                    style="color: white;"></i>
                                            </a>
                                            <form action="" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm p-1"
                                                    style="font-size: 0.8em;"><i class="fas fa-trash-alt"
                                                        style="color: white;"></i></button>
                                            </form>
                                        </div>
                                        <a href="{{ route('tenant.admin.realtor.profile') }}">View profile <i
                                                class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 wow fadeInUp">
                            <div class="property-box">
                                <div class="agent-image">
                                    <div>
                                        <img src="https://themes.pixelstrap.com/sheltos/assets/images/avatar/7.jpg"
                                            class="bg-img" alt="">
                                        <span class="label label-shadow">4 properties</span>
                                        <div class="agent-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://accounts.google.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-1.png') }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-2.png') }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-3.png') }}"
                                                            alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="agent-content">
                                    <h3><a href="agent-profile.html">Brock Lee</a></h3>
                                    <p class="font-roboto">Real estate agent</p>
                                    <ul class="agent-contact">
                                        <li>
                                            <i class="fas fa-phone-alt"></i>
                                            <span class="phone-number">+91 2197207878</span>
                                            <span class="character">+91 219720****</span>

                                        </li>
                                        <li><i class="fas fa-envelope"></i> brock@gmail.com</li>
                                        <li><i class="fas fa-fax"></i> 967 218 674</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"><i
                                                    class="fas fa-ban" style="color: white;"></i>
                                            </button>
                                            <a href="{{ route('tenant.admin.edit.realtor') }}" class="btn btn-primary btn-sm mx-1 p-1"
                                                style="font-size: 0.8em;"><i class="fas fa-edit"
                                                    style="color: white;"></i>
                                            </a>
                                            <form action="" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm p-1"
                                                    style="font-size: 0.8em;"><i class="fas fa-trash-alt"
                                                        style="color: white;"></i></button>
                                            </form>
                                        </div>
                                        <a href="{{ route('tenant.admin.realtor.profile') }}">View profile <i
                                                class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 wow fadeInUp">
                            <div class="property-box">
                                <div class="agent-image">
                                    <div>
                                        <img src="https://themes.pixelstrap.com/sheltos/assets/images/avatar/8.jpg"
                                            class="bg-img" alt="">
                                        <span class="label label-shadow">2 properties</span>
                                        <div class="agent-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://accounts.google.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-1.png') }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-2.png') }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-3.png') }}"
                                                            alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="agent-content">
                                    <h3><a href="agent-profile.html">Mary Goround</a></h3>
                                    <p class="font-roboto">Marketing</p>
                                    <ul class="agent-contact">
                                        <li>
                                            <i class="fas fa-phone-alt"></i>
                                            <span class="phone-number">+91 2197207878</span>
                                            <span class="character">+91 219720****</span>

                                        </li>
                                        <li><i class="fas fa-envelope"></i> marygor@gmail.com</li>
                                        <li><i class="fas fa-fax"></i> 967 218 674</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"><i
                                                    class="fas fa-ban" style="color: white;"></i>
                                            </button>
                                            <a href="{{ route('tenant.admin.edit.realtor') }}" class="btn btn-primary btn-sm mx-1 p-1"
                                                style="font-size: 0.8em;"><i class="fas fa-edit"
                                                    style="color: white;"></i>
                                            </a>
                                            <form action="" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm p-1"
                                                    style="font-size: 0.8em;"><i class="fas fa-trash-alt"
                                                        style="color: white;"></i></button>
                                            </form>
                                        </div>
                                        <a href="{{ route('tenant.admin.realtor.profile') }}">View profile <i
                                                class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 wow fadeInUp">
                            <div class="property-box">
                                <div class="agent-image">
                                    <div>
                                        <img src="https://themes.pixelstrap.com/sheltos/assets/images/avatar/5.jpg"
                                            class="bg-img" alt="">
                                        <span class="label label-shadow">2 properties</span>
                                        <div class="agent-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://accounts.google.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-1.png') }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-2.png') }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-3.png') }}"
                                                            alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="agent-content">
                                    <h3><a href="agent-profile.html">Zack Lee</a></h3>
                                    <p class="font-roboto">Real estate Agent</p>
                                    <ul class="agent-contact">
                                        <li>
                                            <i class="fas fa-phone-alt"></i>
                                            <span class="phone-number">+91 426015400</span>
                                            <span class="character">+91 42601****</span>

                                        </li>
                                        <li><i class="fas fa-envelope"></i> zack@gmail.com</li>
                                        <li><i class="fas fa-fax"></i> 247 054 787</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"><i
                                                    class="fas fa-ban" style="color: white;"></i>
                                            </button>
                                            <a href="{{ route('tenant.admin.edit.realtor') }}" class="btn btn-primary btn-sm mx-1 p-1"
                                                style="font-size: 0.8em;"><i class="fas fa-edit"
                                                    style="color: white;"></i>
                                            </a>
                                            <form action="" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm p-1"
                                                    style="font-size: 0.8em;"><i class="fas fa-trash-alt"
                                                        style="color: white;"></i></button>
                                            </form>
                                        </div>
                                        <a href="{{ route('tenant.admin.realtor.profile') }}">View profile <i
                                                class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 wow fadeInUp">
                            <div class="property-box">
                                <div class="agent-image">
                                    <div>
                                        <img src="https://themes.pixelstrap.com/sheltos/assets/images/avatar/3.jpg"
                                            class="bg-img" alt="">
                                        <span class="label label-shadow">3 properties</span>
                                        <div class="agent-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://accounts.google.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-1.png') }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-2.png') }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-3.png') }}"
                                                            alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="agent-content">
                                    <h3><a href="agent-profile.html">Greta Life</a></h3>
                                    <p class="font-roboto">Real estate agent</p>
                                    <ul class="agent-contact">
                                        <li>
                                            <i class="fas fa-phone-alt"></i>
                                            <span class="phone-number">+91 5470087201</span>
                                            <span class="character">+91 547008****</span>

                                        </li>
                                        <li><i class="fas fa-envelope"></i> life@gmail.in</li>
                                        <li><i class="fas fa-fax"></i> 248 200 325</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"><i
                                                    class="fas fa-ban" style="color: white;"></i>
                                            </button>
                                            <a href="{{ route('tenant.admin.edit.realtor') }}" class="btn btn-primary btn-sm mx-1 p-1"
                                                style="font-size: 0.8em;"><i class="fas fa-edit"
                                                    style="color: white;"></i>
                                            </a>
                                            <form action="" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm p-1"
                                                    style="font-size: 0.8em;"><i class="fas fa-trash-alt"
                                                        style="color: white;"></i></button>
                                            </form>
                                        </div>
                                        <a href="{{ route('tenant.admin.realtor.profile') }}">View profile <i
                                                class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 wow fadeInUp">
                            <div class="property-box">
                                <div class="agent-image">
                                    <div>
                                        <img src="https://themes.pixelstrap.com/sheltos/assets/images/avatar/2.jpg"
                                            class="bg-img" alt="">
                                        <span class="label label-shadow">6 properties</span>
                                        <div class="agent-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://accounts.google.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-1.png') }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-2.png') }}"
                                                            alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img
                                                            src="{{ asset('themes/classic/admin/assets/images/about/icon-3.png') }}"
                                                            alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="agent-content">
                                    <h3><a href="agent-profile.html">Bob Frapples</a></h3>
                                    <p class="font-roboto">Sales Executive</p>
                                    <ul class="agent-contact">
                                        <li>
                                            <i class="fas fa-phone-alt"></i>
                                            <span class="phone-number">+91 2714203587</span>
                                            <span class="character">+91 271420****</span>

                                        </li>
                                        <li><i class="fas fa-envelope"></i> bob@gmail.in</li>
                                        <li><i class="fas fa-fax"></i> 571 241 925</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"><i
                                                    class="fas fa-ban" style="color: white;"></i>
                                            </button>
                                            <a href="{{ route('tenant.admin.edit.realtor') }}" class="btn btn-primary btn-sm mx-1 p-1"
                                                style="font-size: 0.8em;"><i class="fas fa-edit"
                                                    style="color: white;"></i>
                                            </a>
                                            <form action="" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm p-1"
                                                    style="font-size: 0.8em;"><i class="fas fa-trash-alt"
                                                        style="color: white;"></i></button>
                                            </form>
                                        </div>
                                        <a href="{{ route('tenant.admin.realtor.profile') }}">View profile <i
                                                class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
