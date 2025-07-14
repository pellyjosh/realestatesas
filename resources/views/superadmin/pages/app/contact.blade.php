@extends('superadmin.layouts.super-admin_master')
@section('title', 'Dashboard')
@section('content')
    <!-- Main Content -->
    <section class="content contact">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Contact
                        <small>Manage Contacts</small>
                    </h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Hublox</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">App</a></li>
                        <li class="breadcrumb-item active">Contacts</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card action_bar">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-1 col-md-2 col-3">
                                    <div class="checkbox inlineblock delete_all">
                                        <input id="deleteall" type="checkbox">
                                        <label for="deleteall">All</label>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-6">
                                    <div class="input-group search">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <span class="input-group-addon"><i class="zmdi zmdi-search"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-5 col-3 text-right">
                                    <div class="btn-group hidden-sm-down" role="group">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-neutral dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="zmdi zmdi-label"></i>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pullDown">
                                                <li><a href="javascript:void(0);">Family</a></li>
                                                <li><a href="javascript:void(0);">Work</a></li>
                                                <li><a href="javascript:void(0);">Google</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a href="javascript:void(0);">Create a Label</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-neutral hidden-sm-down" data-toggle="modal" data-target="#addContactModal"><i
                                            class="zmdi zmdi-plus-circle"></i></button>
                                    <button type="button" class="btn btn-neutral hidden-sm-down"><i
                                            class="zmdi zmdi-archive"></i></button>
                                    <button type="button" class="btn btn-neutral"><i class="zmdi zmdi-delete"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body table-responsive">
                            <table class="table table-hover table-striped  mb-0 c_list">
                                <thead>
                                    <tr>
                                        <th style="width: 35px;">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th data-breakpoints="xs">Phone</th>
                                        <th data-breakpoints="xs sm md">Address</th>
                                        <th data-breakpoints="xs">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <input id="delete_2" type="checkbox">
                                                <label for="delete_2">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <img src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/xs/avatar1.jpg"
                                                class="rounded-circle avatar" alt="">
                                            <p class="c_name">John Smith <span
                                                    class="badge badge-default m-l-10 hidden-sm-down">Family</span></p>
                                        </td>
                                        <td>john@example.com</td>
                                        <td>
                                            <span class="phone">264-625-2583</span>
                                        </td>
                                        <td>
                                            <address>123 6th St. Melbourne, FL 32904</address>
                                        </td>
                                        <td>
                                            <button class="btn btn-icon btn-neutral btn-icon-mini"><i
                                                    class="zmdi zmdi-edit"></i></button>
                                            <button class="btn btn-icon btn-neutral btn-icon-mini"><i
                                                    class="zmdi zmdi-delete"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <input id="delete_3" type="checkbox">
                                                <label for="delete_3">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <img src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/xs/avatar3.jpg"
                                                class="rounded-circle avatar" alt="">
                                            <p class="c_name">Hossein Shams <span
                                                    class="badge badge-info m-l-10 hidden-sm-down">Google</span></p>
                                        </td>
                                        <td>hossein@example.com</td>
                                        <td>
                                            <span class="phone">264-625-5689</span>
                                        </td>
                                        <td>
                                            <address>44 Shirley Ave. West Chicago, IL 60185</address>
                                        </td>
                                        <td>
                                            <button class="btn btn-icon btn-neutral btn-icon-mini"><i
                                                    class="zmdi zmdi-edit"></i></button>
                                            <button class="btn btn-icon btn-neutral btn-icon-mini"><i
                                                    class="zmdi zmdi-delete"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <input id="delete_4" type="checkbox">
                                                <label for="delete_4">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <img src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/xs/avatar4.jpg"
                                                class="rounded-circle avatar" alt="">
                                            <p class="c_name">Maryam Amiri</p>
                                        </td>
                                        <td>maryam@example.com</td>
                                        <td>
                                            <span class="phone">264-625-9513</span>
                                        </td>
                                        <td>
                                            <address>123 6th St. Melbourne, FL 32904</address>
                                        </td>
                                        <td>
                                            <button class="btn btn-icon btn-neutral btn-icon-mini"><i
                                                    class="zmdi zmdi-edit"></i></button>
                                            <button class="btn btn-icon btn-neutral btn-icon-mini"><i
                                                    class="zmdi zmdi-delete"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <input id="delete_5" type="checkbox">
                                                <label for="delete_5">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <img src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/xs/avatar6.jpg"
                                                class="rounded-circle avatar" alt="">
                                            <p class="c_name">Tim Hank<span
                                                    class="badge badge-default m-l-10 hidden-sm-down">Family</span></p>
                                        </td>
                                        <td>tim@example.com</td>
                                        <td>
                                            <span class="phone">264-625-1212</span>
                                        </td>
                                        <td>
                                            <address>70 Bowman St. South Windsor, CT 06074</address>
                                        </td>
                                        <td>
                                            <button class="btn btn-icon btn-neutral btn-icon-mini"><i
                                                    class="zmdi zmdi-edit"></i></button>
                                            <button class="btn btn-icon btn-neutral btn-icon-mini"><i
                                                    class="zmdi zmdi-delete"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <input id="delete_6" type="checkbox">
                                                <label for="delete_6">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <img src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/xs/avatar7.jpg"
                                                class="rounded-circle avatar" alt="">
                                            <p class="c_name">Fidel Tonn<span
                                                    class="badge badge-default m-l-10 hidden-sm-down">Family</span></p>
                                        </td>
                                        <td>fidel@example.com</td>
                                        <td>
                                            <span class="phone">264-625-2323</span>
                                        </td>
                                        <td>
                                            <address>514 S. Magnolia St. Orlando, FL 32806</address>
                                        </td>
                                        <td>
                                            <button class="btn btn-icon btn-neutral btn-icon-mini"><i
                                                    class="zmdi zmdi-edit"></i></button>
                                            <button class="btn btn-icon btn-neutral btn-icon-mini"><i
                                                    class="zmdi zmdi-delete"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <input id="delete_7" type="checkbox">
                                                <label for="delete_7">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <img src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/xs/avatar8.jpg"
                                                class="rounded-circle avatar" alt="">
                                            <p class="c_name">Gary Camara<span
                                                    class="badge badge-success m-l-10 hidden-sm-down">Work</span></p>
                                        </td>
                                        <td>gary@example.com</td>
                                        <td>
                                            <span class="phone">264-625-1005</span>
                                        </td>
                                        <td>
                                            <address>44 Shirley Ave. West Chicago, IL 60185</address>
                                        </td>
                                        <td>
                                            <button class="btn btn-icon btn-neutral btn-icon-mini"><i
                                                    class="zmdi zmdi-edit"></i></button>
                                            <button class="btn btn-icon btn-neutral btn-icon-mini"><i
                                                    class="zmdi zmdi-delete"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <input id="delete_8" type="checkbox">
                                                <label for="delete_8">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <img src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/xs/avatar9.jpg"
                                                class="rounded-circle avatar" alt="">
                                            <p class="c_name">Frank Camly</p>
                                        </td>
                                        <td>frank@example.com</td>
                                        <td>
                                            <span class="phone">264-625-9999</span>
                                        </td>
                                        <td>
                                            <address>123 6th St. Melbourne, FL 32904</address>
                                        </td>
                                        <td>
                                            <button class="btn btn-icon btn-neutral btn-icon-mini"><i
                                                    class="zmdi zmdi-edit"></i></button>
                                            <button class="btn btn-icon btn-neutral btn-icon-mini"><i
                                                    class="zmdi zmdi-delete"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <input id="delete_9" type="checkbox">
                                                <label for="delete_9">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <img src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/xs/avatar10.jpg"
                                                class="rounded-circle avatar" alt="">
                                            <p class="c_name">Tim Hank<span
                                                    class="badge badge-default m-l-10 hidden-sm-down">Family</span></p>
                                        </td>
                                        <td>tim2@example.com</td>
                                        <td>
                                            <span class="phone">264-625-1212</span>
                                        </td>
                                        <td>
                                            <address>70 Bowman St. South Windsor, CT 06074</address>
                                        </td>
                                        <td>
                                            <button class="btn btn-icon btn-neutral btn-icon-mini"><i
                                                    class="zmdi zmdi-edit"></i></button>
                                            <button class="btn btn-icon btn-neutral btn-icon-mini"><i
                                                    class="zmdi zmdi-delete"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="body">
                            <ul class="pagination pagination-primary m-b-0">
                                <li class="page-item"><a class="page-link" href="javascript:void(0);"><i
                                            class="zmdi zmdi-arrow-left"></i></a></li>
                                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">4</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);"><i
                                            class="zmdi zmdi-arrow-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

<!-- Add Contact Modal -->
<div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addContactModalLabel">Add New Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="contactName">Full Name</label>
                        <input type="text" class="form-control" id="contactName" required>
                    </div>
                    <div class="form-group">
                        <label for="contactEmail">Email</label>
                        <input type="email" class="form-control" id="contactEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="contactPhone">Phone</label>
                        <input type="text" class="form-control" id="contactPhone" required>
                    </div>
                    <div class="form-group">
                        <label for="contactAddress">Address</label>
                        <input type="text" class="form-control" id="contactAddress">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Contact</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
