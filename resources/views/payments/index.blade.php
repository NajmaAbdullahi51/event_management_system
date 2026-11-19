@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark">Payments Management</h3>
    <button class="btn btn-accent rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addModal">+ Record Payment</button>
</div>

<div class="card p-4 border-0 shadow-sm rounded-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Ticket Code</th>
                    <th>Participant</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $pay)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="fw-bold text-primary">{{ $pay->ticket->ticket_code ?? 'N/A' }}</td>
                    <td>{{ $pay->ticket->participant->full_name ?? 'N/A' }}</td>
                    <td class="text-success fw-bold">${{ $pay->amount }}</td>
                    <td><span class="badge bg-info text-dark">{{ $pay->payment_method }}</span></td>
                    <td><span class="badge bg-success">{{ $pay->status }}</span></td>
                    <td>
                        <div class="d-flex gap-2">
                            <!-- Edit Button -->
                            <button class="btn btn-sm btn-outline-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#editModal{{ $pay->id }}">
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <!-- Delete Form -->
                            <form action="{{ route('payments.destroy', $pay->id) }}" method="POST" onsubmit="return confirm('Ma hubtaa inaad tirtirto?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>

                <!-- Modal Edit Payment -->
                <div class="modal fade" id="editModal{{ $pay->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('payments.update', $pay->id) }}" method="POST" class="modal-content border-0 shadow rounded-4">
                            @csrf @method('PUT')
                            <div class="modal-header border-0"><h5 class="modal-title fw-bold">Edit Payment</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-start">
                                <div class="mb-3"><label class="form-label small fw-semibold text-muted">Ticket</label>
                                    <select name="ticket_id" class="form-select rounded-3" required>
                                        @foreach($tickets as $t)<option value="{{ $t->id }}" {{ $pay->ticket_id == $t->id ? 'selected' : '' }}>{{ $t->ticket_code }}</option>@endforeach
                                    </select>
                                </div>
                                <div class="mb-3"><label class="form-label small fw-semibold text-muted">Amount ($)</label><input type="number" step="0.01" name="amount" value="{{ $pay->amount }}" class="form-control rounded-3" required></div>
                                <div class="mb-3"><label class="form-label small fw-semibold text-muted">Method</label>
                                    <select name="payment_method" class="form-select rounded-3">
                                        <option value="Zaad" {{ $pay->payment_method == 'Zaad' ? 'selected' : '' }}>Zaad</option>
                                        <option value="E-Dahab" {{ $pay->payment_method == 'E-Dahab' ? 'selected' : '' }}>E-Dahab</option>
                                        <option value="Cash" {{ $pay->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                                    </select>
                                </div>
                                <div class="mb-3"><label class="form-label small fw-semibold text-muted">Status</label>
                                    <select name="status" class="form-select rounded-3">
                                        <option value="Paid" {{ $pay->status == 'Paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="Pending" {{ $pay->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer border-0"><button type="submit" class="btn btn-primary rounded-pill px-4">Update</button></div>
                        </form>
                    </div>
                </div>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Wax lacag bixin ah oo la helay ma jiraan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Add Payment -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('payments.store') }}" method="POST" class="modal-content border-0 shadow rounded-4">
            @csrf
            <div class="modal-header border-0"><h5 class="modal-title fw-bold">Record New Payment</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label small fw-semibold text-muted">Select Ticket</label>
                    <select name="ticket_id" class="form-select rounded-3" required>
                        <option value="">Dooro Tikidh</option>
                        @foreach($tickets as $t)<option value="{{ $t->id }}">{{ $t->ticket_code }} - ${{ $t->price }}</option>@endforeach
                    </select>
                </div>
                <div class="mb-3"><label class="form-label small fw-semibold text-muted">Amount ($)</label><input type="number" step="0.01" name="amount" class="form-control rounded-3" required placeholder="0.00"></div>
                <div class="mb-3"><label class="form-label small fw-semibold text-muted">Payment Method</label>
                    <select name="payment_method" class="form-select rounded-3">
                        <option value="Zaad">Zaad Service</option>
                        <option value="E-Dahab">E-Dahab</option>
                        <option value="Cash">Cash</option>
                    </select>
                </div>
                <div class="mb-3"><label class="form-label small fw-semibold text-muted">Status</label>
                    <select name="status" class="form-select rounded-3">
                        <option value="Paid">Paid</option>
                        <option value="Pending">Pending</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-0"><button type="submit" class="btn btn-primary rounded-pill px-4">Save Payment</button></div>
        </form>
    </div>
</div>
@endsection