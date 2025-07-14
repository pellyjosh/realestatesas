@extends('superadmin.layouts.super-admin_master')
@section('title', 'View Domain')
@section('content')
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-12">
                <h2>Domain Preview</h2>
                <small class="text-muted">You're viewing the live site associated with this onboarded domain.</small>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Domain Information -->
        <div class="card">
            <div class="body">
                <h5 class="mb-3"><strong>Domain Name:</strong> Sunnytown Realty</h5>
                <p><strong>Full Subdomain:</strong> <a href="http://sunnytown.hublox.com" target="_blank">http://sunnytown.hublox.com</a></p>
                <p><strong>Template in Use:</strong> Classic Modern</p>
                <p><strong>Theme Color:</strong> <span class="badge" style="background-color: #0057b7;">#0057b7</span></p>
                <p><strong>Status:</strong> <span class="badge badge-success">Active</span></p>
            </div>
        </div>

        <!-- Iframe Preview -->
        <div class="card">
            <div class="header">
                <h2><strong>Website Live Preview</strong></h2>
            </div>
            <div class="body">
                <iframe src="https://html.themeholy.com/realar/demo/home-1-op.html" title="Preview" style="width: 100%; height: 600px; border: 1px solid #ccc;"></iframe>
            </div>
        </div>
    </div>
</section>
@endsection