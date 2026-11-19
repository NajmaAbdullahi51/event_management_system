<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Event Management System (Group 12)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            /* Midab casri ah oo buluug/teal ah */
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 420px;
            padding: 40px;
            border: 1px solid rgba(226, 232, 240, 0.2);
        }
        .btn-custom {
            /* Lahjadda liinta ah ee quruxda badan */
            background: #f97316; 
            color: white;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            border: none;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background: #ea580c;
            color: white;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #334155;
        }
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.3); /* Iftiinka diirada ee liinta */
            border-color: #f97316;
            background-color: #fff;
        }
        .input-group-text {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        .form-check-input:checked {
            background-color: #f97316;
            border-color: #f97316;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="text-center mb-4">
        <div class="mb-3" style="color: #f97316;">
            <i class="fa-solid fa-calendar-check fa-3x"></i>
        </div>
        <h3 class="fw-bold text-dark">Welcome Back</h3>
        <p class="text-muted small">Event Management System - Group 12</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger py-2 small rounded-3 mb-3">
            <i class="fa-solid fa-triangle-exclamation me-1"></i> Email-ka ama Password-ka waa qalad!
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label text-muted small fw-semibold">Email Address</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-envelope text-muted"></i></span>
                <input type="email" name="email" class="form-control border-start-0" value="{{ old('email') }}" required autofocus placeholder="admin@example.com">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label text-muted small fw-semibold">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-lock text-muted"></i></span>
                <input type="password" name="password" class="form-control border-start-0" required placeholder="********">
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 small">
            <div class="form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label text-muted" for="remember">Remember me</label>
            </div>
        </div>

        <button type="submit" class="btn btn-custom mb-3">
            <i class="fa-solid fa-right-to-bracket me-2"></i> Log In
        </button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>