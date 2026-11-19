@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark">Participants Management</h3>
    <button class="btn btn-accent rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addModal">+ Register Participant</button>
</div>

<div class="card p-4 border-0 shadow-sm rounded-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Event</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($participants as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="fw-bold text-dark">{{ $p->full_name }}</td>
                    <td class="text-muted">{{ $p->email }}</td>
                    <td class="text-muted">{{ $p->phone }}</td>
                    <td><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">{{ $p->event->title ?? 'N/A' }}</span></td>
                    <td>
                        <div class="d-flex gap-2">
                            <!-- Edit Button -->
                            <button class="btn btn-sm btn-outline-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#editModal{{ $p->id }}">
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <!-- Delete Form -->
                            <form action="{{ route('participants.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Ma hubtaa inaad tirtirto?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Wax ka-qaybgale ah oo la helay ma jiraan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modals for Editing (Waa inuu halkan banaanka ka ahaadaa si uusan u dhibin tabaxda) -->
@foreach($participants as $p)
<div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('participants.update', $p->id) }}" method="POST" class="modal-content border-0 shadow rounded-4">
            @csrf @method('PUT')
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Edit Participant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-start">
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Select Event</label>
                    <select name="event_id" class="form-select rounded-3" required>
                        @foreach($events as $e)
                            <option value="{{ $e->id }}" {{ $p->event_id == $e->id ? 'selected' : '' }}>{{ $e->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Full Name</label>
                    <input type="text" name="full_name" value="{{ $p->full_name }}" class="form-control rounded-3" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Email</label>
                    <input type="email" name="email" value="{{ $p->email }}" class="form-control rounded-3" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Phone</label>
                    <input type="text" name="phone" value="{{ $p->phone }}" class="form-control rounded-3" required>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Update</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<!-- Modal Add Participant -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('participants.store') }}" method="POST" class="modal-content border-0 shadow rounded-4">
            @csrf
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Register Participant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-start">
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Select Event</label>
                    <select name="event_id" class="form-select rounded-3" required>
                        <option value="">Dooro Event</option>
                        @foreach($events as $e)
                            <option value="{{ $e->id }}">{{ $e->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Full Name</label>
                    <input type="text" name="full_name" class="form-control rounded-3" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Email</label>
                    <input type="email" name="email" class="form-control rounded-3" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Phone</label>
                    <input type="text" name="phone" class="form-control rounded-3" required>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Save Participant</button>
            </div>
        </form>
    </div>
</div>
@endsection