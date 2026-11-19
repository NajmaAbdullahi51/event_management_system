@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark">Tickets Management</h3>
    <button class="btn btn-accent rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addModal">+ Issue Ticket</button>
</div>

<div class="card p-4 border-0 shadow-sm rounded-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Ticket Code</th>
                    <th>Participant</th>
                    <th>Event</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $t)
                <tr>
                    <td class="fw-bold text-primary">{{ $t->ticket_code }}</td>
                    <td>{{ $t->participant->full_name ?? 'N/A' }}</td>
                    <td>{{ $t->event->title ?? 'N/A' }}</td>
                    <td><span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">{{ $t->ticket_type }}</span></td>
                    <td class="fw-semibold text-success">${{ $t->price }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <!-- Edit Button -->
                            <button class="btn btn-sm btn-outline-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#editModal{{ $t->id }}">
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <!-- Delete Form -->
                            <form action="{{ route('tickets.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Ma hubtaa inaad tirtirto tikidkan?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Wax tikidh ah oo la helay ma jiraan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modals for Editing Tickets -->
@foreach($tickets as $t)
<div class="modal fade" id="editModal{{ $t->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('tickets.update', $t->id) }}" method="POST" class="modal-content border-0 shadow rounded-4">
            @csrf @method('PUT')
            <div class="modal-header border-0"><h5 class="modal-title fw-bold">Edit Ticket</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body text-start">
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Event</label>
                    <select name="event_id" class="form-select rounded-3" required>
                        @foreach($events as $e)<option value="{{ $e->id }}" {{ $t->event_id == $e->id ? 'selected' : '' }}>{{ $e->title }}</option>@endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Participant</label>
                    <select name="participant_id" class="form-select rounded-3" required>
                        @foreach($participants as $p)<option value="{{ $p->id }}" {{ $t->participant_id == $p->id ? 'selected' : '' }}>{{ $p->full_name }}</option>@endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Ticket Type</label>
                    <select name="ticket_type" class="form-select rounded-3">
                        <option value="Regular" {{ $t->ticket_type == 'Regular' ? 'selected' : '' }}>Regular</option>
                        <option value="VIP" {{ $t->ticket_type == 'VIP' ? 'selected' : '' }}>VIP</option>
                        <option value="Student" {{ $t->ticket_type == 'Student' ? 'selected' : '' }}>Student</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Price ($)</label>
                    <input type="number" step="0.01" name="price" value="{{ $t->price }}" class="form-control rounded-3" required>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Update Ticket</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<!-- Modal Add Ticket -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('tickets.store') }}" method="POST" class="modal-content border-0 shadow rounded-4">
            @csrf
            <div class="modal-header border-0"><h5 class="modal-title fw-bold">Issue New Ticket</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body text-start">
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Event</label>
                    <select name="event_id" class="form-select rounded-3" required>
                        <option value="">Dooro Event</option>
                        @foreach($events as $e)<option value="{{ $e->id }}">{{ $e->title }}</option>@endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Participant</label>
                    <select name="participant_id" class="form-select rounded-3" required>
                        <option value="">Dooro Participant</option>
                        @foreach($participants as $p)<option value="{{ $p->id }}">{{ $p->full_name }}</option>@endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Ticket Type</label>
                    <select name="ticket_type" class="form-select rounded-3">
                        <option value="Regular">Regular</option>
                        <option value="VIP">VIP</option>
                        <option value="Student">Student</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Price ($)</label>
                    <input type="number" step="0.01" name="price" class="form-control rounded-3" required placeholder="0.00">
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Generate Ticket</button>
            </div>
        </form>
    </div>
</div>
@endsection