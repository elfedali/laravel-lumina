@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-7">
            <div class="card border-0">
                <div class="card-body">
                    <header class="mb-4">
                        <a href="{{ route('booking.index') }}" class="text-muted small d-inline-flex align-items-center gap-1 mb-2">
                            ← Back to bookings
                        </a>
                        <h5 class="h5 mb-1">New booking</h5>
                        <p class="text-muted fw-light mb-0">Add a manual booking.</p>
                    </header>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Full name <span class="text-danger">*</span></label>
                            <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror"
                                value="{{ old('full_name') }}" required>
                            @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone') }}">
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label class="form-label">Date <span class="text-danger">*</span></label>
                                <input type="date" name="booking_date" class="form-control @error('booking_date') is-invalid @enderror"
                                    value="{{ old('booking_date') }}" min="{{ today()->format('Y-m-d') }}" required>
                                @error('booking_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col">
                                <label class="form-label">Time <span class="text-danger">*</span></label>
                                <input type="time" name="booking_time" class="form-control @error('booking_time') is-invalid @enderror"
                                    value="{{ old('booking_time') }}" required>
                                @error('booking_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Covers <span class="text-danger">*</span></label>
                            <input type="number" name="party_size" class="form-control @error('party_size') is-invalid @enderror"
                                value="{{ old('party_size', 2) }}" min="1" max="100" required>
                            @error('party_size')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control @error('notes') is-invalid @enderror"
                                rows="3" placeholder="Allergies, special occasions…">{{ old('notes') }}</textarea>
                            @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Save</button>
                            <a href="{{ route('booking.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
