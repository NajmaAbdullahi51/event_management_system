<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System - Group 12</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background-color: #f4f7fe; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #4f46e5 0%, #3b82f6 100%);
            color: white;
            box-shadow: 4px 0 10px rgba(0,0,0,0.05);
        }
        .sidebar a {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            border-radius: 10px;
            margin: 5px 12px;
            transition: 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: rgba(255,255,255,0.2);
            color: #fff;
            font-weight: 600;
        }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
        .btn-accent { background-color: #f97316; color: white; border: none; }
        .btn-accent:hover { background-color: #ea580c; color: white; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Admin Sidebar -->
        <div class="col-md-2 sidebar p-0 d-flex flex-column justify-content-between">
            <div>
                <div class="p-4 text-center border-bottom border-light border-opacity-25">
                    <h4 class="fw-bold mb-0"><i class="fa-solid fa-calendar-check me-2"></i>EventPro</h4>
                    <small class="text-white-50">Group 12 System</small>
                </div>
                <div class="mt-3">
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-gauge me-2"></i> Dashboard
                    </a>
                    <a href="{{ route('events.index') }}" class="{{ request()->routeIs('events.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-calendar-days me-2"></i> Events
                    </a>
                    <a href="{{ route('participants.index') }}" class="{{ request()->routeIs('participants.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-users me-2"></i> Participants
                    </a>
                    <a href="{{ route('tickets.index') }}" class="{{ request()->routeIs('tickets.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-ticket me-2"></i> Tickets
                    </a>
                    <a href="{{ route('payments.index') }}" class="{{ request()->routeIs('payments.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-credit-card me-2"></i> Payments
                    </a>
                </div>
            </div>
            
            <!-- Logout Section -->
            <div class="p-3 border-top border-light border-opacity-25">
                <div class="mb-2 px-2 small">
                    <i class="fa-solid fa-user-circle me-1"></i> {{ Auth::user()->name ?? 'Admin' }}
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100 rounded-pill btn-sm">
                        <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>