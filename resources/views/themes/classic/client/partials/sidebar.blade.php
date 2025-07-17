 <div class="sidebar-user sticky-cls">
                        <div class="user-profile">
                            <div class="media">
                                <div class="change-pic">
                                    <img src="{{ asset('themes/classic/admin/assets/images/avatar/3.jpg') }}"
                                        class="img-fluid update_img" alt="">
                                    <div class="change-hover">
                                        <button type="button" class="btn"><i data-feather="camera"></i></button>
                                        <input class="updateimg" type="file" name="img"
                                            onchange="readURL(this,0)">
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h5>Zack Lee</h5>
                                    <h6 class="font-roboto">zackle@gmail.com</h6>
                                    <h6 class="font-roboto mb-0">+91 846 - 547 - 210</h6>
                                </div>
                            </div>
                            <div class="connected-social">
                                <h6>Connect with</h6>
                                <ul class="agent-social">
                                    <li><a href="https://www.facebook.com/" class="facebook"><i
                                                class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://whatsapp.com/" class="twitter"
                                            style="background-color: #25d366">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="dashboard-list">
                            <ul class="nav nav-tabs right-line-tab">
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('tenant.user.dashboard') }}">Dashboard</a></li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('tenant.user.properties') }}">My
                                        Properties</a></li>
                                </li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('tenant.user.profile') }}">My
                                        profile</a>
                                </li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('tenant.user.favorites') }}">favourites</a>
                                </li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('tenant.user.payment') }}">Cards &
                                        payment</a>
                                </li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('tenant.user.privacy') }}">Privacy</a></li>
                                <li class="nav-item"><a href="javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#logout" class="nav-link">Log out</a></li>
                            </ul>
                        </div>
                    </div>