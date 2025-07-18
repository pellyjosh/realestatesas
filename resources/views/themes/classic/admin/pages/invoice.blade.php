@extends('themes.classic.admin.admin_master')
@section('title', ' Agent Invoice | Premium Refined Luxury Homes')
@section('content')
    <!-- Container-fluid start -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-left">
                        <h3>Invoice
                            <small>Welcome to admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-6 text-end">
                    <button type="button" class="btn btn-pill btn-gradient color-4">Mail Invoice</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->

    <!-- Container-fluid start -->
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="invoice-logo">
                                        <img src="{{ asset('client/assets/images/logo2.png') }}" class="img-fluid for-light"
                                            alt="">
                                        <img src="{{ asset('client/assets/images/logo2.png') }}" class="img-fluid for-dark"
                                            alt="">
                                        <span class="d-block mt-1">support@premiumrefinedluxuryhomes.com</span>
                                        <span class="d-block">289-335-6503</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-md-end">
                                        <h3>Invoice #5170</h3>
                                        <p class="mb-0">Issued: May<span class="digits"> 18, 2022</span><br>
                                            Payment Due: July <span class="digits">20, 2022</span></p>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="address-invoice">
                                <div class="light-box row m-0">
                                    <div class="col-md-6">
                                        <div>
                                            <h6 class="light-font">Invoice for</h6>
                                            <h5>Bob Frapples</h5>
                                            <p class="mb-0 light-font">Mina Road, Dubai, United Arab Emirates</p>
                                            <p class="mb-0 light-font">Mobile no: +61 052145008</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <h6 class="light-font">Invoice from</h6>
                                            <h5>Zack Lee</h5>
                                            <p class="mb-0 light-font">Mina Road, Dubai, United Arab Emirates</p>
                                            <p class="mb-0 light-font">Mobile no: +61 84521410</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="table-responsive invoice-table">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Decription</th>
                                            <th>Deposit</th>
                                            <th>Rate</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Residences can be classified in residence.
                                            </td>
                                            <td>
                                                $400
                                            </td>
                                            <td>
                                                $580
                                            </td>
                                            <td>
                                                $800.00
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Residences can be classified in residence.
                                            </td>
                                            <td>
                                                $300
                                            </td>
                                            <td>
                                                $450
                                            </td>
                                            <td>
                                                $900.00
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <h6 class="mb-0">Total</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0">$1800.00</h6>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-end">
                                    <p>Paid: $0.00</p>
                                    <p class="text-danger">Balance: $0.00</p>
                                </div>
                            </div>
                            <div class="row invoice-note">
                                <div class="col-md-4">
                                    <div>
                                        <img src="https://themes.pixelstrap.com/sheltos/assets/images/signature/3.png"
                                            class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="col-md-8 text-md-end">
                                    <p class="legal"><strong>Thank you for your business!</strong>&nbsp; Payment is
                                        expected within 31 days; please process this invoice within that time. There will be
                                        a 5% interest charge per month on late invoices.</p>
                                </div>
                                <div class="col-sm-12 text-center mt-3">
                                    <button onclick="myFunction()" type="button"
                                        class="btn btn-pill btn-gradient color-4">Print</button>
                                    <button type="button" class="btn btn-pill btn-dashed color-4 ms-2">cancel</button>
                                </div>
                            </div>
                            <div class="paid-stamp" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1; opacity: 0.5; font-size: 80px; color: green; font-weight: bold; display: flex; align-items: center; justify-content: center; width: 200px; height: 200px; border-radius: 50%; border: 2px solid green; @media (max-width: 767px) { width: 150px; height: 150px; font-size: 60px; }">
                                PAID
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->
@endsection
