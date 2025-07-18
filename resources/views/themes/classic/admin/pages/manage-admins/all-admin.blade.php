@extends('themes.classic.admin.admin_master')
@section('title, All Users | Premium Refined Luxury Homes')
@section('content')
     <!-- Container-fluid start -->
     <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-left">
                        <h3>All users
                            <small>Welcome to admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-6">

                    <!-- Breadcrumb start -->
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Manage users</li>
                    </ol>
                    <!-- Breadcrumb end -->
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->

    <!-- Container-fluid start -->
    <div class="container-fluid">
        <div class="row agent-section property-section user-lists">
            <div class="col-lg-12">
                <div class="property-grid-3 agent-grids ratio2_3">
                    <div class="property-2 row column-sm property-label property-grid list-view">
                        <div class="col-md-12 col-xl-6">
                            <div class="property-box">
                                <div class="agent-image">
                                    <div>
                                        <img src="{{ asset("themes/classic/admin/assets/images/avatar/5.jpg") }}" class="bg-img" alt="">
                                        <span class="label label-shadow">New user</span>
                                        <div class="agent-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://www.google.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-1.png") }}" alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-2.png") }}" alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-3.png") }}" alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="agent-content">
                                    <h5>Zack Lee</h5>
                                    <p class="font-roboto">Real estate User</p>
                                    <ul class="agent-contact">
                                        <li>
                                            <i class="fas fa-phone-alt"></i> 
                                            <span class="phone-number">+91 426015400</span>
                                            <span class="character">+91 42601****</span>
                                            <span class="label label-light label-flat color-4">
                                                show
                                                <span>hide</span>
                                            </span>
                                        </li>
                                        <li><i class="fas fa-envelope"></i> zack@gmail.com</li>
                                        <li><i class="fas fa-fax"></i> 247 054 787</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"><i class="fas fa-ban" style="color: white;"></i></button>
                                            <a href="{{ route('tenant.edit.user') }}" class="btn btn-primary btn-sm mx-1 p-1" style="font-size: 0.8em;"><i class="fas fa-edit" style="color: white;"></i></a>
                                            <form action="" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm p-1" style="font-size: 0.8em;"><i class="fas fa-trash-alt" style="color: white;"></i></button>
                                            </form>
                                        </div>
                                        <a href="{{ route("tenant.user.profile") }}">View profile <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xl-6">
                            <div class="property-box">
                                <div class="agent-image">
                                    <div>
                                        <img src="{{ asset("themes/classic/admin/assets/images/avatar/3.jpg") }}" class="bg-img" alt="">
                                        <div class="agent-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://www.google.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-1.png") }}" alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-2.png") }}" alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-3.png") }}" alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="agent-content">
                                    <h5>Greta Life</h5>
                                    <p class="font-roboto">Real estate User</p>
                                    <ul class="agent-contact">
                                        <li>
                                            <i class="fas fa-phone-alt"></i> 
                                            <span class="phone-number">+91 5470087201</span>
                                            <span class="character">+91 547008****</span>
                                            <span class="label label-light label-flat color-4">
                                                show
                                                <span>hide</span>
                                            </span>
                                        </li>
                                        <li><i class="fas fa-envelope"></i> life@gmail.in</li>
                                        <li><i class="fas fa-fax"></i> 248 200 325</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"><i class="fas fa-ban" style="color: white;"></i></button>
                                            <a href="{{ route('tenant.edit.user') }}" class="btn btn-primary btn-sm mx-1 p-1" style="font-size: 0.8em;"><i class="fas fa-edit" style="color: white;"></i></a>
                                            <form action="" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm p-1" style="font-size: 0.8em;"><i class="fas fa-trash-alt" style="color: white;"></i></button>
                                            </form>
                                        </div>
                                        <a href="{{ route("tenant.user.profile") }}">View profile <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xl-6">
                            <div class="property-box">
                                <div class="agent-image">
                                    <div>
                                        <img src="{{ asset("themes/classic/admin/assets/images/avatar/9.jpg") }}" class="bg-img" alt="">
                                        <div class="agent-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://www.google.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-1.png") }}" alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-2.png") }}" alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-3.png") }}" alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="agent-content">
                                    <h5>Bob Frapples</h5>
                                    <p class="font-roboto">Real estate User</p>
                                    <ul class="agent-contact">
                                        <li>
                                            <i class="fas fa-phone-alt"></i> 
                                            <span class="phone-number">+91 2714203587</span>
                                            <span class="character">+91 271420****</span>
                                            <span class="label label-light label-flat color-4">
                                                show
                                                <span>hide</span>
                                            </span>
                                        </li>
                                        <li><i class="fas fa-envelope"></i> bob@gmail.in</li>
                                        <li><i class="fas fa-fax"></i> 571 241 925</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"><i class="fas fa-ban" style="color: white;"></i></button>
                                            <a href="{{ route('tenant.edit.user') }}" class="btn btn-primary btn-sm mx-1 p-1" style="font-size: 0.8em;"><i class="fas fa-edit" style="color: white;"></i></a>
                                            <form action="" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm p-1" style="font-size: 0.8em;"><i class="fas fa-trash-alt" style="color: white;"></i></button>
                                            </form>
                                        </div>
                                        <a href="{{ route("tenant.user.profile") }}">View profile <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xl-6">
                            <div class="property-box">
                                <div class="agent-image">
                                    <div>
                                        <img src="{{ asset("themes/classic/admin/assets/images/avatar/6.jpg") }}" class="bg-img" alt="">
                                        <span class="label label-shadow">New user</span>
                                        <div class="agent-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://www.google.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-1.png") }}" alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-2.png") }}" alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-3.png") }}" alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="agent-content">
                                    <h5>Brock Lee</h5>
                                    <p class="font-roboto">Real estate User</p>
                                    <ul class="agent-contact">
                                        <li>
                                            <i class="fas fa-phone-alt"></i> 
                                            <span class="phone-number">+91 3178405278</span>
                                            <span class="character">+91 317840****</span>
                                            <span class="label label-light label-flat color-4">
                                                show
                                                <span>hide</span>
                                            </span>
                                        </li>
                                        <li><i class="fas fa-envelope"></i> turner@gmail.in</li>
                                        <li><i class="fas fa-fax"></i> 287 845 317</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"><i class="fas fa-ban" style="color: white;"></i></button>
                                            <a href="{{ route('tenant.edit.user') }}" class="btn btn-primary btn-sm mx-1 p-1" style="font-size: 0.8em;"><i class="fas fa-edit" style="color: white;"></i></a>
                                            <form action="" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm p-1" style="font-size: 0.8em;"><i class="fas fa-trash-alt" style="color: white;"></i></button>
                                            </form>
                                        </div>
                                        <a href="{{ route("tenant.user.profile") }}">View profile <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xl-6">
                            <div class="property-box">
                                <div class="agent-image">
                                    <div>
                                        <img src="{{ asset("themes/classic/admin/assets/images/avatar/5.jpg") }}" class="bg-img" alt="">
                                        <span class="label label-shadow">New user</span>
                                        <div class="agent-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://www.google.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-1.png") }}" alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-2.png") }}" alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-3.png") }}" alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="agent-content">
                                    <h5>Paige Turner</h5>
                                    <p class="font-roboto">Real estate User</p>
                                    <ul class="agent-contact">
                                        <li>
                                            <i class="fas fa-phone-alt"></i> 
                                            <span class="phone-number">+91 3178405278</span>
                                            <span class="character">+91 317840****</span>
                                            <span class="label label-light label-flat color-4">
                                                show
                                                <span>hide</span>
                                            </span>
                                        </li>
                                        <li><i class="fas fa-envelope"></i> turner@gmail.in</li>
                                        <li><i class="fas fa-fax"></i> 287 845 317</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"><i class="fas fa-ban" style="color: white;"></i></button>
                                            <a href="{{ route('tenant.edit.user') }}" class="btn btn-primary btn-sm mx-1 p-1" style="font-size: 0.8em;"><i class="fas fa-edit" style="color: white;"></i></a>
                                            <form action="" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm p-1" style="font-size: 0.8em;"><i class="fas fa-trash-alt" style="color: white;"></i></button>
                                            </form>
                                        </div>
                                        <a href="{{ route("tenant.user.profile") }}">View profile <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xl-6">
                            <div class="property-box">
                                <div class="agent-image">
                                    <div>
                                        <img src="{{ asset("themes/classic/admin/assets/images/avatar/4.jpg") }}" class="bg-img" alt="">
                                        <div class="agent-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://www.google.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-1.png") }}" alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-2.png") }}" alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-3.png") }}" alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="agent-content">
                                    <h5>Mary Goround</h5>
                                    <p class="font-roboto">Real estate User</p>
                                    <ul class="agent-contact">
                                        <li>
                                            <i class="fas fa-phone-alt"></i> 
                                            <span class="phone-number">+91 2197207878</span>
                                            <span class="character">+91 219720****</span>
                                            <span class="label label-light label-flat color-4">
                                                show
                                                <span>hide</span>
                                            </span>
                                        </li>
                                        <li><i class="fas fa-envelope"></i> marygor@gmail.com</li>
                                        <li><i class="fas fa-fax"></i> 967 218 674</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"><i class="fas fa-ban" style="color: white;"></i></button>
                                            <a href="{{ route('tenant.edit.user') }}" class="btn btn-primary btn-sm mx-1 p-1" style="font-size: 0.8em;"><i class="fas fa-edit" style="color: white;"></i></a>
                                            <form action="" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm p-1" style="font-size: 0.8em;"><i class="fas fa-trash-alt" style="color: white;"></i></button>
                                            </form>
                                        </div>
                                        <a href="{{ route("tenant.user.profile") }}">View profile <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-6">
                            <div class="property-box">
                                <div class="agent-image">
                                    <div>
                                        <img src="{{ asset("themes/classic/admin/assets/images/avatar/4.jpg") }}" class="bg-img" alt="">
                                        <div class="agent-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://www.google.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-1.png") }}" alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-2.png") }}" alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img src="{{ asset("themes/classic/client/assets/images/about/icon-3.png") }}" alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="agent-content">
                                    <h5>Mary Goround</h5>
                                    <p class="font-roboto">Real estate User</p>
                                    <ul class="agent-contact">
                                        <li>
                                            <i class="fas fa-phone-alt"></i> 
                                            <span class="phone-number">+91 2197207878</span>
                                            <span class="character">+91 219720****</span>
                                            <span class="label label-light label-flat color-4">
                                                show
                                                <span>hide</span>
                                            </span>
                                        </li>
                                        <li><i class="fas fa-envelope"></i> marygor@gmail.com</li>
                                        <li><i class="fas fa-fax"></i> 967 218 674</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"><i class="fas fa-ban" style="color: white;"></i></button>
                                            <a href="{{ route('tenant.edit.user') }}" class="btn btn-primary btn-sm mx-1 p-1" style="font-size: 0.8em;"><i class="fas fa-edit" style="color: white;"></i></a>
                                            <form action="" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm p-1" style="font-size: 0.8em;"><i class="fas fa-trash-alt" style="color: white;"></i></button>
                                            </form>
                                        </div>
                                        <a href="{{ route("tenant.user.profile") }}">View profile <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-6">
                            <div class="property-box">
                                <div class="agent-image">
                                    <div>
                                        <img src="{{ asset("themes/classic/admin/assets/images/avatar/3.jpg") }}" class="bg-img" alt="">
                                        <div class="agent-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="https://www.google.com/"><img src="https://themes.pixelstrap.com/sheltos/assets/images/about/icon-1.png" alt=""></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><img src="https://themes.pixelstrap.com/sheltos/assets/images/about/icon-2.png" alt=""></a>
                                                </li>
                                                <li><a href="https://www.facebook.com/"><img src="https://themes.pixelstrap.com/sheltos/assets/images/about/icon-3.png" alt=""></a>
                                                </li>
                                            </ul>
                                            <span>Connect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="agent-content">
                                    <h5>Greta Life</h5>
                                    <p class="font-roboto">Real estate User</p>
                                    <ul class="agent-contact">
                                        <li>
                                            <i class="fas fa-phone-alt"></i> 
                                            <span class="phone-number">+91 426015400</span>
                                            <span class="character">+91 42601****</span>
                                            <span class="label label-light label-flat color-4">
                                                show
                                                <span>hide</span>
                                            </span>
                                        </li>
                                        <li><i class="fas fa-envelope"></i> zack@gmail.com</li>
                                        <li><i class="fas fa-fax"></i> 247 054 787</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-warning btn-sm p-1" style="font-size: 0.8em;"><i class="fas fa-ban" style="color: white;"></i></button>
                                            <a href="{{ route('tenant.edit.user') }}" class="btn btn-primary btn-sm mx-1 p-1" style="font-size: 0.8em;"><i class="fas fa-edit" style="color: white;"></i></a>
                                            <form action="" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm p-1" style="font-size: 0.8em;"><i class="fas fa-trash-alt" style="color: white;"></i></button>
                                            </form>
                                        </div>
                                        <a href="{{ route("tenant.user.profile") }}">View profile <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->
@endsection
