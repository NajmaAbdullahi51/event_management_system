
@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark">Events Management</h3>
    <button class="btn btn-accent rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addEventModal">+ Add Event</button>
</div>

<div class="card p-4 border-0 shadow-sm rounded-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Date & Time</th>
                    <th>Capacity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="fw-bold text-dark">{{ $event->title }}</td>
                    <td class="text-muted">{{ $event->location }}</td>
                    <td class="text-muted">{{ $event->event_date }}</td>
                    <td>{{ $event->capacity }}</td>
                    <td><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">{{ $event->status }}</span></td>
                    <td>
                        <div class="d-flex gap-2">
                            <!-- Edit Button -->
                            <button class="btn btn-sm btn-outline-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#editEventModal{{ $event->id }}">
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <!-- Delete Form -->
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Ma hubtaa inaad tirtirto event-kan?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">Wax event ah oo la helay ma jiraan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modals for Editing Events -->
@foreach($events as $event)
<div class="modal fade" id="editEventModal{{ $event->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('events.update', $event->id) }}" method="POST" class="modal-content border-0 shadow rounded-4">
            @csrf @method('PUT')
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Edit Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-start">
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Event Title</label>
                    <input type="text" name="title" value="{{ $event->title }}" class="form-control rounded-3" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Description</label>
                    <textarea name="description" class="form-control rounded-3">{{ $event->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Location</label>
                    <input type="text" name="location" value="{{ $event->location }}" class="form-control rounded-3" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Event Date</label>
                    <input type="datetime-local" name="event_date" value="{{ date('Y-m-d\TH:i', strtotime($event->event_date)) }}" class="form-control rounded-3" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Capacity</label>
                    <input type="number" name="capacity" value="{{ $event->capacity }}" class="form-control rounded-3" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Status</label>
                    <select name="status" class="form-select rounded-3">
                        <option value="Upcoming" {{ $event->status == 'Upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="Ongoing" {{ $event->status == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="Completed" {{ $event->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ $event->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Update Event</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<!-- Modal Add Event -->
<div class="modal fade" id="addEventModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('events.store') }}" method="POST" class="modal-content border-0 shadow rounded-4">
            @csrf
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Add New Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-start">
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Event Title</label>
                    <input type="text" name="title" class="form-control rounded-3" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Description</label>
                    <textarea name="description" class="form-control rounded-3"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Location</label>
                    <input type="text" name="location" class="form-control rounded-3" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Event Date</label>
                    <input type="datetime-local" name="event_date" class="form-control rounded-3" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Capacity</label>
                    <input type="number" name="capacity" class="form-control rounded-3" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Status</label>
                    <select name="status" class="form-select rounded-3">
                        <option value="Upcoming">Upcoming</option>
                        <option value="Ongoing">Ongoing</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Save Event</button>
            </div>
        </form>
    </div>
</div>
@endsection