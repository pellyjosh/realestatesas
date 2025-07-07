@extends('admin.admin_master')
@section('title', 'Add Agent Wizard| Premium Refined Luxury Homes')
@section('content')
      <!-- Container-fluid start -->
      <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-left">
                        <h3>Add agent wizard
                            <small>Welcome to admin panel</small>
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
    <div class="container-fluid property-wizard horizontal-wizard">
        <div class="row wizard-box">
            <div class="col-lg-12">
                <div class="card"> 
                    <div class="card-body admin-wizard">
                        <div class="wizard-step-container">
                            <ul class="wizard-steps">
                                <li class="step-container step-1 active">
                                    <div class="media">
                                        <div class="step-icon">
                                            <i data-feather="check"></i>
                                            <span>1</span>
                                        </div>
                                        <div class="media-body">
                                            <h5>Get started</h5>
                                            <h6>Account information</h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="step-container step-2">
                                    <div class="media">
                                        <div class="step-icon">
                                            <i data-feather="check"></i>
                                            <span>2</span>
                                        </div>
                                        <div class="media-body">
                                            <h5>Login details</h5>
                                            <h6>Set your email</h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="step-container step-3">
                                    <div class="media">
                                        <div class="step-icon">
                                            <i data-feather="check"></i>
                                            <span>3</span>
                                        </div>
                                        <div class="media-body">
                                            <h5>Upload files</h5>
                                            <h6>Successfully submitted</h6>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="wizard-form-details log-in">
                                <div class="wizard-step-1 d-block">
                                    <form class="row" id="needs-validation" novalidate="">
                                        <div class="form-group col-md-4 col-sm-6">
                                            <label>First name <span class="font-danger">*</span></label>
                                            <input type="text" id="user_name" class="form-control" placeholder="enter your name" required="">
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6">
                                            <label>Last name <span class="font-danger">*</span></label>
                                            <input type="text" id="last_name" class="form-control" placeholder="enter your surname" required="">
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6">
                                            <label>Gender <span class="font-danger">*</span></label>
                                            <div class="dropdown">
                                                <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>Gender</span> <i class="fas fa-angle-down"></i></span>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0)">Male</a>
                                                    <a class="dropdown-item" href="javascript:void(0)">Female</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label>Phone number <span class="font-danger">*</span></label>
                                            <input 
                                                placeholder="Enter your mobile number"
                                                class="form-control" 
                                                name="mobnumber" 
                                                id="tbNumbers" 
                                                oninput="maxLengthCheck(this)"
                                                type = "tel"
                                                onkeypress="javascript:return isNumber(event)"
                                                maxlength = "9"
                                                required="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Date of birth <span class="font-danger">*</span></label>
                                            <input class="form-control" placeholder="18 april" id="datepicker" required=""/>
                                        </div>
                                        <div class="next-btn text-end col-sm-12">
                                            <button type="submit" class="btn btn-gradient color-4 next1 btn-pill">Next <i class="fas fa-arrow-right ms-2"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="wizard-step-2 d-none">
                                    <form class="row" id="needs-validation1" novalidate="">
                                        <div class="form-group col-md-4 col-sm-6">
                                            <label>Email Address <span class="font-danger">*</span></label>
                                            <input type="email" id="email_add" class="form-control" placeholder="enter your email" required="">
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6">
                                            <label>Password <span class="font-danger">*</span></label>
                                            <input type="password" id="pwdd" class="form-control" placeholder="Enter your password" required="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Confirm Password <span class="font-danger">*</span></label>
                                            <input type="password" id="pwdd1" class="form-control" placeholder="Enter your password" required="">
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label>Description</label>
                                            <textarea class="form-control" rows="4"></textarea>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label>Address</label>
                                            <input type="text" id="address" class="form-control" placeholder="Enter your Address" required="">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label>Zip code</label>
                                            <input type="number" id="zip_code" class="form-control" placeholder="Enter pin code" required="">
                                        </div>
                                        <div class="next-btn d-flex col-sm-12">
                                            <button type="button" class="btn btn-dashed color-4 prev1 btn-pill"><i class="fas fa-arrow-left me-2"></i> Previous</button>
                                            <button type="submit" class="btn btn-gradient color-4 next2 btn-pill">Next <i class="fas fa-arrow-right ms-2"></i></button>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="wizard-step-3 d-none">
                                    <div class="dropzone-main">
                                        <label>Media</label>
                                        <form class="dropzone" id="multiFileUpload" action="https://themes.pixelstrap.com/upload.php">
                                            <div class="dz-message needsclick"><i class="fas fa-cloud-upload-alt"></i>
                                            <h6>Drop files here or click to upload.</h6>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="next-btn d-flex">
                                        <button type="button" class="btn btn-dashed color-4 prev2 btn-pill"><i class="fas fa-arrow-left me-2"></i> Previous</button>
                                        <button type="button" class="btn btn-gradient color-4 next3 btn-pill">submit</button>
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