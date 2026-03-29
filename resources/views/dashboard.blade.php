@extends('layouts.app')
@section('content')
    <section>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h4 mb-1">Dashboard</h1>
                <p class="text-muted mb-0">Overview of bookings, clients, and revenue performance.</p>
            </div>
            <span class="badge text-bg-light border px-3 py-2">{{ now()->format('M d, Y') }}</span>
        </div>

        <div class="row g-3 g-lg-4 mb-2">
            <div class="col-sm-6 col-xl-3">
                <article class="card-dash h-100">
                    <p class="text-muted text-uppercase fw-semibold fs-12 mb-2">Revenue</p>
                    <h2 class="h4 mb-2">$0.00</h2>
                    <p class="text-muted mb-0 fs-14">Current period</p>
                </article>
            </div>
            <div class="col-sm-6 col-xl-3">
                <article class="card-dash h-100">
                    <p class="text-muted text-uppercase fw-semibold fs-12 mb-2">Appointments</p>
                    <h2 class="h4 mb-2">0</h2>
                    <p class="text-muted mb-0 fs-14">Scheduled today</p>
                </article>
            </div>
            <div class="col-sm-6 col-xl-3">
                <article class="card-dash h-100">
                    <p class="text-muted text-uppercase fw-semibold fs-12 mb-2">Top Clients</p>
                    <h2 class="h4 mb-2">0</h2>
                    <p class="text-muted mb-0 fs-14">Most active clients</p>
                </article>
            </div>
            <div class="col-sm-6 col-xl-3">
                <article class="card-dash h-100">
                    <p class="text-muted text-uppercase fw-semibold fs-12 mb-2">Popular Services</p>
                    <h2 class="h4 mb-2">0</h2>
                    <p class="text-muted mb-0 fs-14">Most booked services</p>
                </article>
            </div>
        </div>

        <div class="row g-3 g-lg-4">
            <div class="col-lg-7">
                <div class="card-dash h-100">
                    <h6 class="mb-3">Upcoming Appointments</h6>
                    <p class="text-muted mb-0">No appointments scheduled yet.</p>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card-dash h-100">
                    <h6 class="mb-3">Service Trends</h6>
                    <p class="text-muted mb-0">Service trend data will appear here.</p>
                </div>
            </div>
        </div>

    </section>
@endsection
