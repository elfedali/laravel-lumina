@extends('layouts.app')
@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-1">Dashboard</h4>
            <p class="text-muted mb-0 small">{{ now()->format('l, F j Y') }}</p>
        </div>
        @if($localeId)
            <a href="{{ route('booking.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> New booking
            </a>
        @endif
    </div>

    @if(!$localeId)

        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5">
                <i class="bi bi-geo-alt display-4 text-primary mb-3 d-block"></i>
                <h5 class="fw-semibold">No active location selected</h5>
                <p class="text-muted mb-4">Select or add a location to start managing bookings, staff, and your menu.</p>
                <a href="{{ route('locations.index') }}" class="btn btn-primary px-4">Manage locations</a>
            </div>
        </div>

    @else

        {{-- Stats --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-muted small text-uppercase fw-semibold">Today</span>
                            <span class="bg-primary bg-opacity-10 text-primary rounded-2 d-flex align-items-center justify-content-center" style="width:36px;height:36px">
                                <i class="bi bi-calendar-check"></i>
                            </span>
                        </div>
                        <h3 class="fw-bold mb-1">{{ $stats['today'] }}</h3>
                        <p class="text-muted small mb-0">Bookings today</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-muted small text-uppercase fw-semibold">This month</span>
                            <span class="bg-success bg-opacity-10 text-success rounded-2 d-flex align-items-center justify-content-center" style="width:36px;height:36px">
                                <i class="bi bi-graph-up"></i>
                            </span>
                        </div>
                        <h3 class="fw-bold mb-1">{{ $stats['month'] }}</h3>
                        <p class="text-muted small mb-0">Total bookings</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-muted small text-uppercase fw-semibold">Staff</span>
                            <span class="bg-warning bg-opacity-10 text-warning rounded-2 d-flex align-items-center justify-content-center" style="width:36px;height:36px">
                                <i class="bi bi-people"></i>
                            </span>
                        </div>
                        <h3 class="fw-bold mb-1">{{ $stats['staff'] }}</h3>
                        <p class="text-muted small mb-0">Active members</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-muted small text-uppercase fw-semibold">Menu</span>
                            <span class="bg-info bg-opacity-10 text-info rounded-2 d-flex align-items-center justify-content-center" style="width:36px;height:36px">
                                <i class="bi bi-journal-richtext"></i>
                            </span>
                        </div>
                        <h3 class="fw-bold mb-1">{{ $stats['menu_items'] }}</h3>
                        <p class="text-muted small mb-0">Active items</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content row --}}
        <div class="row g-3">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0 fw-semibold">Upcoming bookings</h6>
                        <a href="{{ route('booking.index') }}" class="btn btn-sm btn-outline-secondary">View all</a>
                    </div>

                    @if($upcomingBookings->isEmpty())
                        <div class="card-body text-center py-5">
                            <i class="bi bi-calendar-x display-5 text-muted mb-3 d-block"></i>
                            <p class="text-muted mb-3">No upcoming bookings</p>
                            <a href="{{ route('booking.create') }}" class="btn btn-sm btn-primary">Add booking</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light small">
                                    <tr>
                                        <th class="ps-4">Guest</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Party</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($upcomingBookings as $b)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-medium">{{ $b->full_name }}</div>
                                            <div class="text-muted small">{{ $b->phone }}</div>
                                        </td>
                                        <td class="small">{{ $b->booking_date->format('M d, Y') }}</td>
                                        <td class="small">{{ \Illuminate\Support\Str::substr($b->booking_time, 0, 5) }}</td>
                                        <td class="small">{{ $b->party_size }} pax</td>
                                        <td>
                                            @php $cls = match($b->status) {
                                                'confirmed' => 'success', 'pending' => 'warning',
                                                'cancelled' => 'danger',  default   => 'secondary'
                                            }; @endphp
                                            <span class="badge text-bg-{{ $cls }}">{{ $b->status_label }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('booking.edit', $b) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-semibold">Quick actions</h6>
                    </div>
                    <div class="card-body d-grid gap-2">
                        <a href="{{ route('booking.create') }}" class="btn btn-outline-primary text-start">
                            <i class="bi bi-calendar-plus me-2"></i>New booking
                        </a>
                        <a href="{{ route('service.create') }}" class="btn btn-outline-secondary text-start">
                            <i class="bi bi-journal-plus me-2"></i>Add menu item
                        </a>
                        <a href="{{ route('staff.create') }}" class="btn btn-outline-secondary text-start">
                            <i class="bi bi-person-plus me-2"></i>Add staff member
                        </a>
                        <a href="{{ route('client.create') }}" class="btn btn-outline-secondary text-start">
                            <i class="bi bi-person-badge me-2"></i>Add client
                        </a>
                        <hr class="my-1">
                        <a href="{{ route('locations.index') }}" class="btn btn-outline-secondary text-start">
                            <i class="bi bi-geo-alt me-2"></i>My locations
                        </a>
                    </div>
                </div>
            </div>
        </div>

    @endif

@endsection
