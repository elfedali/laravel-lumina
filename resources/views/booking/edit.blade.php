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
                        <h5 class="h5 mb-1">Edit booking</h5>
                        <p class="text-muted fw-light mb-0">{{ $booking->full_name }} — {{ $booking->booking_date->format('d/m/Y') }}</p>
                    </header>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('booking.update', $booking) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-floating mb-3">
                            <input type="text" id="full_name" name="full_name" class="form-control @error('full_name') is-invalid @enderror"
                                value="{{ old('full_name', $booking->full_name) }}" required placeholder="Full name">
                            <label for="full_name">Full name <span class="text-danger">*</span></label>
                            @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', $booking->phone) }}" placeholder="Phone">
                                    <label for="phone">Phone</label>
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $booking->email) }}" placeholder="Email">
                                    <label for="email">Email</label>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="date" id="booking_date" name="booking_date" class="form-control @error('booking_date') is-invalid @enderror"
                                        value="{{ old('booking_date', $booking->booking_date->format('Y-m-d')) }}" required placeholder="Date">
                                    <label for="booking_date">Date <span class="text-danger">*</span></label>
                                    @error('booking_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="time" id="booking_time" name="booking_time" class="form-control @error('booking_time') is-invalid @enderror"
                                        value="{{ old('booking_time', \Illuminate\Support\Str::substr($booking->booking_time, 0, 5)) }}" required placeholder="Time">
                                    <label for="booking_time">Time <span class="text-danger">*</span></label>
                                    @error('booking_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="number" id="party_size" name="party_size" class="form-control @error('party_size') is-invalid @enderror"
                                        value="{{ old('party_size', $booking->party_size) }}" min="1" max="100" required placeholder="Covers">
                                    <label for="party_size">Covers <span class="text-danger">*</span></label>
                                    @error('party_size')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                                        @foreach(\App\Models\Booking::statuses() as $value => $label)
                                            <option value="{{ $value }}" @selected(old('status', $booking->status) === $value)>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="status">Status</label>
                                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-4">
                            <textarea id="notes" name="notes" class="form-control @error('notes') is-invalid @enderror"
                                placeholder="Notes" style="height:100px">{{ old('notes', $booking->notes) }}</textarea>
                            <label for="notes">Notes</label>
                            @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Update</button>
                            <a href="{{ route('booking.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
