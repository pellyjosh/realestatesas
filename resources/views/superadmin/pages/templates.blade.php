@extends('superadmin.layouts.super-admin_master')
@section('title', ' Templates')
@section('content')
    <!-- Main Content -->
    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h2>Templates List
                        <small>Manage all templates</small>
                    </h2>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 text-md-right">
                    <div class="inlineblock text-center m-r-15 m-l-15 hidden-md-down">
                        <div class="sparkline" data-type="bar" data-width="97%" data-height="25px" data-bar-Width="2"
                            data-bar-Spacing="5" data-bar-Color="#fff">3,2,6,5,9,8,7,9,5,1,3,5,7,4,6</div>
                        <small class="col-white">Visitors</small>
                    </div>
                    <div class="inlineblock text-center m-r-15 m-l-15 hidden-md-down">
                        <div class="sparkline" data-type="bar" data-width="97%" data-height="25px" data-bar-Width="2"
                            data-bar-Spacing="5" data-bar-Color="#fff">1,3,5,7,4,6,3,2,6,5,9,8,7,9,5</div>
                        <small class="col-white">Bounce Rate</small>
                    </div>
                    <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right ml-3" type="button">
                        <i class="zmdi zmdi-plus"></i>
                    </button>
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Oreo</a></li>
                        <li class="breadcrumb-item active">Templates</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table td_2 table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Template Name</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Assigned Clients</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Classic Estate</td>
                                            <td>Luxury</td>
                                            <td>Active</td>
                                            <td>May 11, 2025</td>
                                            <td>C-housing Estate</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-warning me-1" title="Suspend"><i
                                                        class="fas fa-circle-pause"></i></a>
                                                <a href="#" class="btn btn-sm btn-success me-1" title="Activate"><i
                                                        class="fas fa-circle-play"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger" title="View" onclick="confirm('Are you sure you want to delete this template?')"><i
                                                        class="fas fa-trash"></i></a>
                                                <a href="#" class="btn btn-sm btn-info" title="View"><i
                                                        class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Modern Loft</td>
                                            <td>Luxury</td>
                                            <td>Active</td>
                                            <td>June 10, 2025</td>
                                            <td>Chuks Estate</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-warning me-1" title="Suspend"><i
                                                        class="fas fa-circle-pause"></i></a>
                                                <a href="#" class="btn btn-sm btn-success me-1" title="Activate"><i
                                                        class="fas fa-circle-play"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger" title="View" onclick="confirm('Are you sure you want to delete this domain?')"><i
                                                        class="fas fa-trash"></i></a>
                                                <a href="#" class="btn btn-sm btn-info" title="View"><i
                                                        class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
