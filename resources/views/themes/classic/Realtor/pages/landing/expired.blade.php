<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Expired</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <i class="fas fa-clock fa-5x text-danger"></i>
                        </div>
                        <h2 class="card-title text-dark mb-3">Page Expired</h2>
                        <p class="card-text text-muted mb-4">
                            {{ $message ?? 'This landing page has expired.' }}
                        </p>
                        <div class="bg-light p-3 rounded mb-4">
                            <h5 class="text-primary mb-0">{{ $propertyName ?? 'Property' }}</h5>
                            <small class="text-muted">Property Landing Page</small>
                            @if (isset($expiredAt))
                                <div class="mt-2">
                                    <small class="text-danger">
                                        <i class="fas fa-calendar-times me-1"></i>
                                        Expired: {{ \Carbon\Carbon::parse($expiredAt)->format('M d, Y g:i A') }}
                                    </small>
                                </div>
                            @endif
                        </div>
                        <p class="small text-muted">
                            This page is no longer available. Please contact the property owner for an updated link.
                        </p>
                        <a href="javascript:history.back()" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>Go Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
