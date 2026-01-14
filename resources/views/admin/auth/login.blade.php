<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .form-control:focus { box-shadow: none; border-color: #2563eb; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

    <div class="card border-0 shadow-sm p-4" style="width: 400px; border-radius: 12px;">
        <div class="text-center mb-4">
            <h4 class="fw-bold text-dark">Admin Panel</h4>
            <p class="text-muted">Login to your dashboard</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger p-2 text-center small mb-3">{{ $errors->first() }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success p-2 text-center small mb-3">{{ session('success') }}</div>
        @endif

        {{-- FIX: Updated route to admin.post_login --}}
        <form action="{{ route('admin.post_login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold small text-muted">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text border-0 bg-light"><i class="fa-regular fa-envelope text-muted"></i></span>
                    <input type="email" name="email" class="form-control border-0 bg-light py-2" placeholder="name@example.com" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold small text-muted">Password</label>
                <div class="input-group">
                    <span class="input-group-text border-0 bg-light"><i class="fa-solid fa-lock text-muted"></i></span>
                    <input type="password" name="password" class="form-control border-0 bg-light py-2" placeholder="Enter password" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Sign In</button>
        </form>

        <div class="text-center mt-4">
            {{-- FIX: Updated link to Admin Signup --}}
            <small class="text-muted">Don't have an account? <a href="{{ route('admin.auth.signup') }}" class="text-decoration-none fw-bold">Sign Up</a></small>
        </div>
    </div>

</body>
</html>