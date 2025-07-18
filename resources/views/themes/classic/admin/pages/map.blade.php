@extends('themes.classic.admin.admin_master')
@section('title', 'Map | Premium Refined Luxury Homes')
@section('content')

 <!-- Container-fluid start -->
 <div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-header-left">
                    <h3>Map
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
                    <li class="breadcrumb-item active">Map</li>
                </ol>
                <!-- Breadcrumb end -->
                
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid end -->

<!-- Container-fluid start -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <div class="card"> 
                <div class="card-header pb-0">
                    <h5>Vector world map</h5>
                </div>
                <div class="card-body">
                    <div class="jvector-map-height" id="world-map"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card"> 
                <div class="card-header pb-0">
                    <h5>Vector USA map</h5>
                </div>
                <div class="card-body">
                    <div class="jvector-map-height" id="usa"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card"> 
                <div class="card-header pb-0">
                    <h5>Vector Asia map</h5>
                </div>
                <div class="card-body">
                    <div class="jvector-map-height" id="asia"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card"> 
                <div class="card-header pb-0">
                    <h5>Vector India map</h5>
                </div>
                <div class="card-body">
                    <div class="jvector-map-height" id="india"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid end -->
@endsection