@extends('layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Stats Row --}}
    <div class="row mt-3 mb-4 g-3">
        <div class="col-md-4">
            <div class="card border-0 bg-warning bg-opacity-10">
                    <div class="card-body py-3">
                    <p class="mb-0 text-muted small">Pending</p>
                    <h4 class="mb-0 fw-bold">{{ $stats['pending'] }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 bg-success bg-opacity-10">
                    <div class="card-body py-3">
                    <p class="mb-0 text-muted small">Confirmed</p>
                    <h4 class="mb-0 fw-bold">{{ $stats['confirmed'] }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 bg-primary bg-opacity-10">
                    <div class="card-body py-3">
                    <p class="mb-0 text-muted small">Today</p>
                    <h4 class="mb-0 fw-bold">{{ $stats['today'] }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card border-0">
                <div class="card-body">
                    <header class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="h5 mb-1">Bookings</h5>
                            <p class="text-muted fw-light mb-0">Manage table bookings for your restaurant.</p>
                        </div>
                        <a href="{{ route('booking.create') }}" class="btn btn-primary">
                            <svg viewBox="0 0 24 24" width="1rem" height="1rem"><path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z"/></svg>
                            New booking
                        </a>
                    </header>

                    {{-- Filters --}}
                    <form method="GET" action="{{ route('booking.index') }}" class="row g-2 mb-4">
                        <div class="col-md-4">
                            <input type="search" name="search" class="form-control" placeholder="Name, phone…"
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">All statuses</option>
                                @foreach(\App\Models\Booking::statuses() as $value => $label)
                                    <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                            <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-secondary w-100">Filter</button>
                            @if(request()->hasAny(['search','date','status']))
                                <a href="{{ route('booking.index') }}" class="btn btn-outline-secondary">✕</a>
                            @endif
                        </div>
                    </form>

                    @if($bookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>Date &amp; heure</th>
                                        <th>Couverts</th>
                                        <th>Statut</th>
                                        <th>Notes</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                        <tr id="booking-{{ $booking->id }}">
                                            <td>
                                                <strong>{{ $booking->full_name }}</strong>
                                                @if($booking->phone)
                                                    <br><span class="text-muted small">{{ $booking->phone }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $booking->booking_date->format('d/m/Y') }}<br>
                                                <span class="text-muted small">{{ \Illuminate\Support\Str::substr($booking->booking_time, 0, 5) }}</span>
                                            </td>
                                            <td>{{ $booking->party_size }} pers.</td>
                                            <td>
                                                <select class="form-select form-select-sm booking-status-select"
                                                    data-id="{{ $booking->id }}"
                                                    style="min-width:130px;">
                                                    @foreach(\App\Models\Booking::statuses() as $value => $label)
                                                        <option value="{{ $value }}" @selected($booking->status === $value)>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="text-muted small">{{ \Illuminate\Support\Str::limit($booking->notes, 40) }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-light" type="button"
                                                        data-bs-toggle="dropdown">
                                                        <x-icon_dots />
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('booking.edit', $booking) }}">
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('booking.destroy', $booking) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Delete the booking for {{ addslashes($booking->full_name) }}?')">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">Delete</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {{ $bookings->links() }}
                        </div>
                    @else
                        <div class="text-center py-5 text-muted">
                            <svg viewBox="0 0 24 24" width="3rem" height="3rem" class="mb-3 opacity-50">
                                <path fill="currentColor" d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                            </svg>
                            <p>No bookings found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.querySelectorAll('.booking-status-select').forEach(function(select) {
    select.addEventListener('change', function() {
        const id    = this.dataset.id;
        const token = document.querySelector('meta[name="csrf-token"]').content;
        fetch('/booking/' + id + '/status', {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
            body: JSON.stringify({ status: this.value })
        });
    });
});
</script>
@endsection
