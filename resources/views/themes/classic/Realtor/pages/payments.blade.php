@extends('themes.classic.realtor.realtor_master')
@section('title', 'Payments | Premium Refined Luxury Homes')
@section('content')
    <!-- Container-fluid start -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-left">
                        <h3>Payments
                            <small>Welcome to realtor panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-6">

                    <!-- Breadcrumb start -->

                    <!-- Breadcrumb end -->

                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->

    <!-- Container-fluid start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Payment lists</h5>
                    </div>
                    <div class="card-body payment-table">
                        <div id="batchDelete" class="transactions"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->
@endsection
