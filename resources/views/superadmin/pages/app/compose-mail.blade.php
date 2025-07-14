@extends('superadmin.layouts.super-admin_master')
@section('title', 'Dashboard')
@section('content')
    <!-- Main Content -->
    <section class="content inbox">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Compose Email
                        <small>Write a new message</small>
                    </h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{ route('superadmin.index') }}"><i class="zmdi zmdi-home"></i>
                                Hublox</a></li>
                        <li class="breadcrumb-item active">Compose</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group form-float">
                                        <input type="text" class="form-control" placeholder="To:">
                                    </div>
                                    <div class="form-group form-float">
                                        <input type="text" class="form-control" placeholder="Subject">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <strong>Content:</strong>
                                    <textarea id="ckeditor">
                                    <h2>WYSIWYG Editor</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ullamcorper sapien non nisl facilisis bibendum in quis tellus. Duis in urna bibendum turpis pretium fringilla. Aenean neque velit, porta eget mattis ac, imperdiet quis nisi. Donec non dui et tortor vulputate luctus. Praesent consequat rhoncus velit, ut molestie arcu venenatis sodales.</p>
                                    <h3>Lacinia</h3>
                                    <ul>
                                        <li>Suspendisse tincidunt urna ut velit ullamcorper fermentum.</li>
                                        <li>Nullam mattis sodales lacus, in gravida sem auctor at.</li>
                                        <li>Praesent non lacinia mi.</li>
                                        <li>Mauris a ante neque.</li>
                                        <li>Aenean ut magna lobortis nunc feugiat sagittis.</li>
                                    </ul>
                                    <h3>Pellentesque adipiscing</h3>
                                    <p>Maecenas quis ante ante. Nunc adipiscing rhoncus rutrum. Pellentesque adipiscing urna mi, ut tempus lacus ultrices ac. Pellentesque sodales, libero et mollis interdum, dui odio vestibulum dolor, eu pellentesque nisl nibh quis nunc. Sed porttitor leo adipiscing venenatis vehicula. Aenean quis viverra enim. Praesent porttitor ut ipsum id ornare.</p>
                                </textarea>
                                    <button type="button" class="btn btn-primary btn-round waves-effect m-t-20">Send
                                        Message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
