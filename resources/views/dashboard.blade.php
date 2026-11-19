@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Dashboard Overview</h2>
        <span class="badge bg-primary px-3 py-2 rounded-pill">Group 12 - Event Management</span>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 rounded-4 bg-white border-start border-4 border-primary">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 small fw-semibold">Total Events</p>
                        <h3 class="fw-bold text-dark mb-0">{{ $eventsCount }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary">
                        <i class="fa-solid fa-calendar-days fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 rounded-4 bg-white border-start border-4 border-info">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 small fw-semibold">Participants</p>
                        <h3 class="fw-bold text-dark mb-0">{{ $participantsCount }}</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded-circle text-info">
                        <i class="fa-solid fa-users fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 rounded-4 bg-white border-start border-4 border-warning">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 small fw-semibold">Tickets Issued</p>
                        <h3 class="fw-bold text-dark mb-0">{{ $ticketsCount }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle text-warning">
                        <i class="fa-solid fa-ticket fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 rounded-4 bg-white border-start border-4 border-success">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 small fw-semibold">Total Revenue</p>
                        <h3 class="fw-bold text-dark mb-0">${{ number_format($totalRevenue, 2) }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success">
                        <i class="fa-solid fa-dollar-sign fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Events Table -->
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
        <h5 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i>Recent Events</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentEvents as $event)
                    <tr>
                        <td class="fw-semibold text-dark">{{ $event->title }}</td>
                        <td class="text-muted">{{ $event->location }}</td>
                        <td class="text-muted">{{ $event->event_date }}</td>
                        <td><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">{{ $event->status }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Wax event ah oo la helay ma jiraan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection