@extends('admin.admin_master')
@section('title', 'Edit Agent | Premium Refined Luxury Homes')
@section('content')

                <!-- Container-fluid start -->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="page-header-left">
                                    <h3>Edit agent
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
                                    <li class="breadcrumb-item active">Agents</li>
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
                        <div class="col-lg-12">
                            <div class="card"> 
                                <div class="card-header pb-0">
                                    <h5>Edit agent details</h5>
                                </div>
                                 <div class="card-body admin-form">
                                    <form class="row gx-3">
                                        <div class="form-group col-md-4 col-sm-6">
                                            <label>First name <span class="font-danger">*</span></label>
                                            <input type="text" class="form-control" value="Paige" required="">
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6">
                                            <label>Last name <span class="font-danger">*</span></label>
                                            <input type="text" class="form-control" value="Turner" required="">
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6">
                                            <label>Gender <span class="font-danger">*</span></label>
                                            <div class="dropdown">
                                                <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>Male</span> <i class="fas fa-angle-down"></i></span>
                                                <div class="dropdown-menu text-start">
                                                    <a class="dropdown-item" href="javascript:void(0)">Male</a>
                                                    <a class="dropdown-item" href="javascript:void(0)">Female</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6">
                                            <label>Phone number <span class="font-danger">*</span></label>
                                            <input type="number" class="form-control" value="7596140312" required="">
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6">
                                            <label>Date of birth <span class="font-danger">*</span></label>
                                            <input class="form-control" value="18 April " id="datepicker" />
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6">
                                            <label>Email Address <span class="font-danger">*</span></label>
                                            <input type="text" class="form-control" value="turner@gmail.in" required="">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label>Reset password <span class="font-danger">*</span></label>
                                            <input type="password" class="form-control" value="13535@12" required="">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label>Confirm Password <span class="font-danger">*</span></label>
                                            <input type="password" class="form-control" value="13535@12" required="">
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label>Description</label>
                                            <textarea class="form-control" rows="4"></textarea>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label>Address</label>
                                            <input type="text" class="form-control" value="Mina Road, Dubai, United Arab Emirates">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label>Zip code</label>
                                            <input type="number" class="form-control" value="39702">
                                        </div>
                                    </form>
                                    <div class="dropzone-admin mb-0">
                                        <label>Media</label>
                                        <form class="dropzone" id="multiFileUpload" action="https://themes.pixelstrap.com/upload.php">
                                            <div class="dz-message needsclick"><i class="fas fa-cloud-upload-alt"></i>
                                            <h6>Drop files here or click to upload.</h6>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="form-btn">
                                        <button type="button" class="btn btn-pill btn-gradient color-4">Save</button>
                                        <button type="button" class="btn btn-pill btn-dashed color-4">Cancel</button>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid end -->
@endsection