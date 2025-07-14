@extends('superadmin.layouts.super-admin_master')
@section("title", 'Dashboard')
@section("content")
    <!-- Main Content -->
<section class="content page-calendar">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Calendar
                <small>View and Manage Events</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Hublox</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">App</a></li>
                    <li class="breadcrumb-item active">Events</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">            
            <div class="col-md-12 col-lg-8 col-xl-8">
                <div class="card">
                    <div class="body">
                        <button class="btn btn-primary btn-round waves-effect" id="change-view-today">today</button>
                        <button class="btn btn-default btn-simple btn-round waves-effect change-view-btn" id="change-view-day" >Day</button>
                        <button class="btn btn-default btn-simple btn-round waves-effect change-view-btn" id="change-view-week">Week</button>
                        <button class="btn btn-default btn-simple btn-round waves-effect change-view-btn fc-state-active" id="change-view-month">Month</button>
                        <div id="calendar" class="m-t-20"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4 col-xl-4">
                <div class="card">
                    <div class="body">
                        <button type="button" class="btn btn-round btn-info waves-effect" data-toggle="modal" data-target="#addevent">Add Events</button>
                        <hr>
                        <div class="event-name b-primary row">
                            <div class="col-3 text-center">
                                <h4>11<span>Dec</span><span>2017</span></h4>
                            </div>
                            <div class="col-9">
                                <h6>Conference</h6>
                                <p>It is a long established fact that a reader will be distracted</p>
                                <address><i class="zmdi zmdi-pin"></i> 123 6th St. Melbourne, FL 32904</address>
                            </div>
                        </div>                            
                        <div class="event-name b-primary row">
                            <div class="col-3 text-center">
                                <h4>13<span>Dec</span><span>2017</span></h4>
                            </div>
                            <div class="col-9">
                                <h6>Birthday</h6>
                                <p>It is a long established fact that a reader will be distracted</p>
                                <address><i class="zmdi zmdi-pin"></i> 123 6th St. Melbourne, FL 32904</address>
                            </div>
                        </div>
                        <hr>
                        <div class="event-name b-lightred row">
                            <div class="col-3 text-center">
                                <h4>09<span>Dec</span><span>2017</span></h4>
                            </div>
                            <div class="col-9">
                                <h6>Repeating Event</h6>
                                <p>It is a long established fact that a reader will be distracted</p>
                                <address><i class="zmdi zmdi-pin"></i> 123 6th St. Melbourne, FL 32904</address>
                            </div>
                        </div>
                        <hr>
                        <div class="event-name b-greensea row">
                            <div class="col-3 text-center">
                                <h4>16<span>Dec</span><span>2017</span></h4>
                            </div>
                            <div class="col-9">
                                <h6>Repeating Event</h6>
                                <p>It is a long established fact that a reader will be distracted</p>
                                <address><i class="zmdi zmdi-pin"></i> 123 6th St. Melbourne, FL 32904</address>
                            </div>
                        </div>
                        <div class="event-name b-greensea row">
                            <div class="col-3 text-center">
                                <h4>28<span>Dec</span><span>2017</span></h4>
                            </div>
                            <div class="col-9">
                                <h6>Google</h6>
                                <p>It is a long established fact that a reader will be distracted</p>
                                <address><i class="zmdi zmdi-pin"></i> 123 6th St. Melbourne, FL 32904</address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Default Size -->
<div class="modal fade" id="addevent" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Add Event</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-line">
                        <input type="number" class="form-control" placeholder="Event Date">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" class="form-control" placeholder="Event Title">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <textarea class="form-control no-resize" placeholder="Event Description..."></textarea>
                    </div>
                </div>       
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-round waves-effect">Add</button>
                <button type="button" class="btn btn-simple btn-round waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
@endsection