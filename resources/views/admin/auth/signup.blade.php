<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin Account</title>
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
            <p class="text-muted">Create a new admin account</p>
        </div>

        {{-- FIX: Route changed to admin.post_registration --}}
        <form action="{{ route('admin.post_registration') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold small text-muted">Full Name</label>
                <div class="input-group">
                    <span class="input-group-text border-0 bg-light"><i class="fa-regular fa-user text-muted"></i></span>
                    <input type="text" name="name" class="form-control border-0 bg-light py-2" placeholder="John Doe" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold small text-muted">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text border-0 bg-light"><i class="fa-regular fa-envelope text-muted"></i></span>
                    <input type="email" name="email" class="form-control border-0 bg-light py-2" placeholder="name@example.com" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold small text-muted">Password</label>
                <div class="input-group">
                    <span class="input-group-text border-0 bg-light"><i class="fa-solid fa-lock text-muted"></i></span>
                    <input type="password" name="password" class="form-control border-0 bg-light py-2" placeholder="Min 6 characters" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold small text-muted">Confirm Password</label>
                <div class="input-group">
                    <span class="input-group-text border-0 bg-light"><i class="fa-solid fa-lock text-muted"></i></span>
                    <input type="password" name="password_confirmation" class="form-control border-0 bg-light py-2" placeholder="Confirm password" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Create Admin Account</button>
        </form>

        <div class="text-center mt-4">
            {{-- FIX: Link pointed to Admin Login route --}}
            <small class="text-muted">Already have an account? <a href="{{ route('admin.auth.login') }}" class="text-decoration-none fw-bold">Sign In</a></small>
        </div>
    </div>

</body>
</html>