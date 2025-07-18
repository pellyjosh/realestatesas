@extends('superadmin.layouts.super-admin_master')
@section('title', 'Dashboard')
@section('content')

    <!-- Main Content -->
    <section class="content inbox">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Inbox
                        <small>View and manage messages</small>
                    </h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Hublox</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">App</a></li>
                        <li class="breadcrumb-item active">Inbox</li>
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
                                <div class="col-lg-1 col-md-1 col-3">
                                    <div class="checkbox inlineblock delete_all">
                                        <input id="deleteall" type="checkbox">
                                        <label for="deleteall">
                                            All
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-6">
                                    <div class="input-group search">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-search"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-3 text-right">
                                    <div class="btn-group hidden-sm-down">
                                        <button type="button" class="btn btn-neutral dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More<span
                                                class="caret"></span> </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);">Unread</a></li>
                                            <li><a href="javascript:void(0);">Unimportant</a></li>
                                            <li><a href="javascript:void(0);">Add star</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="javascript:void(0);">Mute</a></li>
                                        </ul>
                                    </div>
                                    <div class="btn-group hidden-md-down hidden-sm-down">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-neutral dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="zmdi zmdi-label"></i>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);">Family</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">Work</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">Google</a>
                                                </li>
                                                <li role="separator" class="divider"></li>
                                                <li>
                                                    <a href="javascript:void(0);">Create a Label</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="btn-group hidden-md-down hidden-sm-down">
                                        <button type="button" class="btn btn-neutral dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                                class="zmdi zmdi-folder"></i> <span class="caret"></span> </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);">Important</a></li>
                                            <li><a href="javascript:void(0);">Social</a></li>
                                            <li><a href="javascript:void(0);">Bank Statements</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="javascript:void(0);">Create a folder</a></li>
                                        </ul>
                                    </div>
                                    <button type="button" class="btn btn-neutral hidden-sm-down">
                                        <i class="zmdi zmdi-plus-circle"></i>
                                    </button>
                                    <button type="button" class="btn btn-neutral hidden-sm-down">
                                        <i class="zmdi zmdi-archive"></i>
                                    </button>
                                    <button type="button" class="btn btn-neutral btn-danger">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <ul class="mail_list list-group list-unstyled">
                        <li class="list-group-item">
                            <div class="media">
                                <div class="pull-left">
                                    <div class="controls">
                                        <div class="checkbox">
                                            <input type="checkbox" id="basic_checkbox_1">
                                            <label for="basic_checkbox_1"></label>
                                        </div>
                                        <a href="javascript:void(0);" class="favourite text-muted hidden-sm-down"
                                            data-toggle="active"><i class="zmdi zmdi-star-outline"></i></a>
                                    </div>
                                    <div class="thumb hidden-sm-down m-r-20"> <img
                                            src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/xs/avatar1.jpg"
                                            class="rounded-circle" alt=""> </div>
                                </div>
                                <div class="media-body" onclick="window.location.href='{{ route('superadmin.mail') }}';">
                                    <div class="media-heading">
                                        <a href="{{ route('superadmin.mail') }}" class="m-r-10">Velit a labore</a>
                                        <span class="badge bg-blue">Family</span>
                                        <small class="float-right text-muted"><time class="hidden-sm-down"
                                                datetime="2017">12:35 AM</time><i class="zmdi zmdi-attachment-alt"></i>
                                        </small>
                                    </div>
                                    <p class="msg">Lorem Ipsum is simply dumm dummy text of the printing and typesetting
                                        industry. </p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item unread">
                            <div class="media">
                                <div class="pull-left">
                                    <div class="controls">
                                        <div class="checkbox">
                                            <input type="checkbox" id="basic_checkbox_2">
                                            <label for="basic_checkbox_2"></label>
                                        </div>
                                        <a href="javascript:void(0);" class="favourite col-amber hidden-sm-down"
                                            data-toggle="active"><i class="zmdi zmdi-star"></i></a>
                                    </div>
                                    <div class="thumb hidden-sm-down m-r-20"> <img
                                            src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/xs/avatar2.jpg"
                                            class="rounded-circle" alt=""> </div>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href="{{ route('superadmin.mail') }}" class="m-r-10">Simply dummy text</a>
                                        <span class="badge bg-amber">Shop</span>
                                        <small class="float-right text-muted"><time class="hidden-sm-down"
                                                datetime="2017">12:35 AM</time><i class="zmdi zmdi-attachment-alt"></i>
                                        </small>
                                    </div>
                                    <p class="msg">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry.</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="media">
                                <div class="pull-left">
                                    <div class="controls">
                                        <div class="checkbox">
                                            <input type="checkbox" id="basic_checkbox_3">
                                            <label for="basic_checkbox_3"></label>
                                        </div>
                                        <a href="javascript:void(0);" class="favourite text-muted hidden-sm-down"
                                            data-toggle="active"><i class="zmdi zmdi-star-outline"></i></a>
                                    </div>
                                    <div class="thumb hidden-sm-down m-r-20"> <img
                                            src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/xs/avatar3.jpg"
                                            class="rounded-circle" alt=""> </div>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href="{{ route('superadmin.mail') }}" class="m-r-10">Velit a labore</a>
                                        <span class="badge bg-red">Google</span>
                                        <small class="float-right text-muted"><time class="hidden-sm-down"
                                                datetime="2017">12:35 AM</time><i class="zmdi zmdi-attachment-alt"></i>
                                        </small>
                                    </div>
                                    <p class="msg"> If you are going to use a passage of Lorem Ipsum, you need to be
                                        sure</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item unread">
                            <div class="media">
                                <div class="pull-left">
                                    <div class="controls">
                                        <div class="checkbox">
                                            <input type="checkbox" id="basic_checkbox_4">
                                            <label for="basic_checkbox_4"></label>
                                        </div>
                                        <a href="javascript:void(0);" class="favourite text-muted hidden-sm-down"
                                            data-toggle="active"><i class="zmdi zmdi-star-outline"></i></a>
                                    </div>
                                    <div class="thumb hidden-sm-down m-r-20"> <img
                                            src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/xs/avatar4.jpg"
                                            class="rounded-circle" alt=""> </div>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href="{{ route('superadmin.mail') }}" class="m-r-10">Variations of passages</a>
                                        <span class="badge bg-blush">Themeforest</span>
                                        <small class="float-right text-muted"><time class="hidden-sm-down"
                                                datetime="2017">12:35 AM</time><i class="zmdi zmdi-attachment-alt"></i>
                                        </small>
                                    </div>
                                    <p class="msg">There are many variations of passages of Lorem Ipsum available, but
                                        the majority </p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="media">
                                <div class="pull-left">
                                    <div class="controls">
                                        <div class="checkbox">
                                            <input type="checkbox" id="basic_checkbox_5">
                                            <label for="basic_checkbox_5"></label>
                                        </div>
                                        <a href="javascript:void(0);" class="favourite text-muted hidden-sm-down"
                                            data-toggle="active"><i class="zmdi zmdi-star-outline"></i></a>
                                    </div>
                                    <div class="thumb hidden-sm-down m-r-20"> <img
                                            src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/xs/avatar5.jpg"
                                            class="rounded-circle" alt=""> </div>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href="{{ route('superadmin.mail') }}" class="m-r-10">Generators on the
                                            Internet</a>
                                        <span class="badge bg-green">Work</span>
                                        <small class="float-right text-muted"><time class="hidden-sm-down"
                                                datetime="2017">12:35 AM</time><i class="zmdi zmdi-attachment-alt"></i>
                                        </small>
                                    </div>
                                    <p class="msg">LAll the Lorem Ipsum generators on the Internet tend to repeat
                                        predefined chunks as necessary</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="media">
                                <div class="pull-left">
                                    <div class="controls">
                                        <div class="checkbox">
                                            <input type="checkbox" id="basic_checkbox_6">
                                            <label for="basic_checkbox_6"></label>
                                        </div>
                                        <a href="javascript:void(0);" class="favourite col-amber hidden-sm-down"
                                            data-toggle="active"><i class="zmdi zmdi-star"></i></a>
                                    </div>
                                    <div class="thumb hidden-sm-down m-r-20"> <img
                                            src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/xs/avatar6.jpg"
                                            class="rounded-circle" alt=""> </div>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href="{{ route('superadmin.mail') }}" class="m-r-10">Contrary to popular</a>
                                        <span class="badge bg-blush">Themeforest</span>
                                        <small class="float-right text-muted"><time class="hidden-sm-down"
                                                datetime="2017">12:35 AM</time><i class="zmdi zmdi-attachment-alt"></i>
                                        </small>
                                    </div>
                                    <p class="msg">Contrary to popular belief, Lorem Ipsum is not simply random text. It
                                        has roots in a piece of classical</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="media">
                                <div class="pull-left">
                                    <div class="controls">
                                        <div class="checkbox">
                                            <input type="checkbox" id="basic_checkbox_7">
                                            <label for="basic_checkbox_7"></label>
                                        </div>
                                        <a href="javascript:void(0);" class="favourite col-amber hidden-sm-down"
                                            data-toggle="active"><i class="zmdi zmdi-star"></i></a>
                                    </div>
                                    <div class="thumb hidden-sm-down m-r-20"> <img
                                            src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/xs/avatar7.jpg"
                                            class="rounded-circle" alt=""> </div>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href="{{ route('superadmin.mail') }}" class="m-r-10">Velit a labore</a>
                                        <span class="badge bg-green">Work</span>
                                        <small class="float-right text-muted"><time class="hidden-sm-down"
                                                datetime="2017">12:35 AM</time><i class="zmdi zmdi-attachment-alt"></i>
                                        </small>
                                    </div>
                                    <p class="msg">Lorem Ipsum is simply dumm dummy text of the printing and typesetting
                                        industry. </p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="media">
                                <div class="pull-left">
                                    <div class="controls">
                                        <div class="checkbox">
                                            <input type="checkbox" id="basic_checkbox_8" checked>
                                            <label for="basic_checkbox_8"></label>
                                        </div>
                                        <a href="javascript:void(0);" class="favourite col-amber hidden-sm-down"
                                            data-toggle="active"><i class="zmdi zmdi-star"></i></a>
                                    </div>
                                    <div class="thumb hidden-sm-down m-r-20"> <img
                                            src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/xs/avatar8.jpg"
                                            class="rounded-circle" alt=""> </div>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href="{{ route('superadmin.mail') }}" class="m-r-10">Variations of passages</a>
                                        <span class="badge bg-blush">Themeforest</span>
                                        <small class="float-right text-muted"><time class="hidden-sm-down"
                                                datetime="2017">12:35 AM</time><i class="zmdi zmdi-attachment-alt"></i>
                                        </small>
                                    </div>
                                    <p class="msg">There are many variations of passages of Lorem Ipsum available, but
                                        the majority </p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="media">
                                <div class="pull-left">
                                    <div class="controls">
                                        <div class="checkbox">
                                            <input type="checkbox" id="basic_checkbox_9">
                                            <label for="basic_checkbox_9"></label>
                                        </div>
                                        <a href="javascript:void(0);" class="favourite text-muted hidden-sm-down"
                                            data-toggle="active"><i class="zmdi zmdi-star-outline"></i></a>
                                    </div>
                                    <div class="thumb hidden-sm-down m-r-20"> <img
                                            src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/xs/avatar9.jpg"
                                            class="rounded-circle" alt=""> </div>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href="{{ route('superadmin.mail') }}" class="m-r-10">Generators on the
                                            Internet</a>
                                        <span class="badge bg-green">Work</span>
                                        <small class="float-right text-muted"><time class="hidden-sm-down"
                                                datetime="2017">12:35 AM</time><i class="zmdi zmdi-attachment-alt"></i>
                                        </small>
                                    </div>
                                    <p class="msg">LAll the Lorem Ipsum generators on the Internet tend to repeat
                                        predefined chunks as necessary</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="media">
                                <div class="pull-left">
                                    <div class="controls">
                                        <div class="checkbox">
                                            <input type="checkbox" id="basic_checkbox_10">
                                            <label for="basic_checkbox_10"></label>
                                        </div>
                                        <a href="javascript:void(0);" class="favourite text-muted hidden-sm-down"
                                            data-toggle="active"><i class="zmdi zmdi-star-outline"></i></a>
                                    </div>
                                    <div class="thumb hidden-sm-down m-r-20"> <img
                                            src="https://wrraptheme.com/templates/oreo/realestate/html/assets/images/xs/avatar10.jpg"
                                            class="rounded-circle" alt=""> </div>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href="{{ route('superadmin.mail') }}" class="m-r-10">Velit a labore</a>
                                        <span class="badge bg-blue">Family</span>
                                        <small class="float-right text-muted"><time class="hidden-sm-down"
                                                datetime="2017">12:35 AM</time><i class="zmdi zmdi-attachment-alt"></i>
                                        </small>
                                    </div>
                                    <p class="msg">Lorem Ipsum is simply dumm dummy text of the printing and typesetting
                                        industry. </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="card m-t-5">
                        <div class="body">
                            <ul class="pagination pagination-primary m-b-0">
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                                <li class="page-item active"><a class="page-link" href="javascript:void(0);">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
