@extends('realtor.realtor_master')
@section('title', 'Landing Page List')
@section('content')

<div class="mb-4">
    <label for="propertySelect" class="form-label">Select Property</label>
    <select id="propertySelect" class="form-select">
        <option value="1">Property One</option>
        <option value="2">Property Two</option>
        <option value="3">Property Three</option>
    </select>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Landing Page</th>
                    <th>Action</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach($landingPages as $landingPage) --}}
                    <tr>
                        <td>Property One Landing Page</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm">Deactivate</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</button>
                        </td>
                        <td>
                            <a href="{{ route('realtor.landing-page') }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Property Two Landing Page</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm">Deactivate</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</button>
                        </td>
                        <td>
                            <a href="{{ route('realtor.landing-page') }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Property Three Landing Page</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm">Deactivate</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</button>
                        </td>
                        <td>
                            <a href="{{ route('realtor.landing-page') }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
</div>
@endsection