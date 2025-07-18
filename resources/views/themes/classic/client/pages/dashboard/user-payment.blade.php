@extends('themes.classic.client.pages.dashboard.user_master')

@section('title', 'Payment | Premium Refined Luxury Homes')
@section('content')
    <!-- page content -->
    <div class="col-lg-9">
        <div class="dashboard-content">
            <div class="payment-user" id="payment">
                <div class="common-card">
                    <div class="common-header">
                        <h5>Cards & payment</h5>
                    </div>
                    <div class="row card-payment">
                        <div class="col-xl-4 col-sm-6">
                            <div class="payment-card master">
                                <div class="card-details">
                                    <div class="text-end">
                                        <h6>Credit</h6>
                                    </div>
                                    <div class="card-number">
                                        <div>
                                            <img src="https://themes.pixelstrap.com/sheltos/assets/images/icon/chip.png"
                                                class="img-fluid" alt="">
                                            <img src="https://themes.pixelstrap.com/sheltos/assets/images/icon/wifi.png"
                                                class="img-fluid" alt="">
                                        </div>
                                        <h3>XXXX-XXXX-XXXX-3401</h3>
                                    </div>
                                    <div class="valid-detail">
                                        <div class="title">
                                            <span>valid</span>
                                            <span>thru</span>
                                        </div>
                                        <div class="date">
                                            <h3>12/24</h3>
                                        </div>
                                    </div>
                                    <div class="name-detail">
                                        <div class="name">
                                            <h5>Zack Lee</h5>
                                        </div>
                                        <div class="card-img">
                                            <img src="https://themes.pixelstrap.com/sheltos/assets/images/icon/master.png"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="edit-card">
                                    <a data-bs-toggle="modal" data-bs-target="#edit-card" href="javascript:void(0)">edit</a>
                                    <a href="javascript:void(0)">delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6">
                            <div class="payment-card visa">
                                <div class="card-details">
                                    <div class="text-end">
                                        <h6>Credit</h6>
                                    </div>
                                    <div class="card-number">
                                        <div>
                                            <img src="https://themes.pixelstrap.com/sheltos/assets/images/icon/chip.png"
                                                class="img-fluid" alt="">
                                            <img src="https://themes.pixelstrap.com/sheltos/assets/images/icon/wifi.png"
                                                class="img-fluid" alt="">
                                        </div>
                                        <h3>XXXX-XXXX-XXXX-3401</h3>
                                    </div>
                                    <div class="valid-detail">
                                        <div class="title">
                                            <span>valid</span>
                                            <span>thru</span>
                                        </div>
                                        <div class="date">
                                            <h3>12/24</h3>
                                        </div>
                                    </div>
                                    <div class="name-detail">
                                        <div class="name">
                                            <h5>Zack Lee</h5>
                                        </div>
                                        <div class="card-img">
                                            <img src="https://themes.pixelstrap.com/sheltos/assets/images/icon/visa.png"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="edit-card">
                                    <a data-bs-toggle="modal" data-bs-target="#edit-card" href="javascript:void(0)">edit</a>
                                    <a href="javascript:void(0)">delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6">
                            <div class="payment-card american-express">
                                <div class="card-details">
                                    <div class="text-end">
                                        <h6>Credit</h6>
                                    </div>
                                    <div class="card-number">
                                        <div>
                                            <img src="https://themes.pixelstrap.com/sheltos/assets/images/icon/chip.png"
                                                class="img-fluid" alt="">
                                            <img src="https://themes.pixelstrap.com/sheltos/assets/images/icon/wifi.png"
                                                class="img-fluid" alt="">
                                        </div>
                                        <h3>XXXX-XXXX-XXXX-3401</h3>
                                    </div>
                                    <div class="valid-detail">
                                        <div class="title">
                                            <span>valid</span>
                                            <span>thru</span>
                                        </div>
                                        <div class="date">
                                            <h3>12/24</h3>
                                        </div>
                                    </div>
                                    <div class="name-detail">
                                        <div class="name">
                                            <h5>Zack Lee</h5>
                                        </div>
                                        <div class="card-img">
                                            <img src="https://themes.pixelstrap.com/sheltos/assets/images/icon/american.jpg"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="edit-card">
                                    <a data-bs-toggle="modal" data-bs-target="#edit-card" href="javascript:void(0)">edit</a>
                                    <a href="javascript:void(0)">delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6">
                            <div class="payment-card add-card">
                                <div data-bs-toggle="modal" data-bs-target="#add-card" class="card-details">
                                    <div>
                                        <i class="fas fa-plus-circle"></i>
                                        <h5>add new card</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- emd of page content -->
@endsection
