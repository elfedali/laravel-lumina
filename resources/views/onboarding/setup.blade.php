@extends('layouts.onboarding')

@section('content')
    {{-- Error alert --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('onboarding.store') }}">
        @csrf

        {{-- ── Section 1 ── --}}
        <div class="onboarding-card p-4 mb-4">
            <div class="d-flex align-items-center gap-3 mb-4">
                <span class="step-badge">1</span>
                <div>
                    <p class="fw-semibold mb-0">Your business</p>
                    <p class="text-muted small mb-0">How should your restaurant or venue be called?</p>
                </div>
            </div>

            <div class="form-floating">
                <input id="business_name" type="text"
                    class="form-control @error('business_name') is-invalid @enderror"
                    name="business_name"
                    value="{{ old('business_name', auth()->user()->company->name !== 'My Company' ? auth()->user()->company->name : '') }}"
                    required autofocus placeholder="e.g. Le Jardin">
                <label for="business_name">Business name <span class="text-danger">*</span></label>
                @error('business_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        {{-- ── Section 2 ── --}}
        <div class="onboarding-card p-4 mb-4">
            <div class="d-flex align-items-center gap-3 mb-4">
                <span class="step-badge">2</span>
                <div>
                    <p class="fw-semibold mb-0">Your first location</p>
                    <p class="text-muted small mb-0">You can add more locations later in settings.</p>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input id="locale_name" type="text"
                    class="form-control @error('locale_name') is-invalid @enderror"
                    name="locale_name"
                    value="{{ old('locale_name') }}"
                    placeholder="e.g. Main Branch">
                <label for="locale_name">Location name <span class="text-muted small">(optional)</span></label>
                @error('locale_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row g-3 mb-3">
                <div class="col-sm-6">
                    <div class="form-floating">
                        <input id="city" type="text"
                            class="form-control @error('city') is-invalid @enderror"
                            name="city"
                            value="{{ old('city') }}"
                            required placeholder="City">
                        <label for="city">City <span class="text-danger">*</span></label>
                        @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-floating">
                        <input id="neighborhood" type="text"
                            class="form-control @error('neighborhood') is-invalid @enderror"
                            name="neighborhood"
                            value="{{ old('neighborhood') }}"
                            required placeholder="Neighborhood">
                        <label for="neighborhood">Neighborhood <span class="text-danger">*</span></label>
                        @error('neighborhood')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input id="address" type="text"
                    class="form-control @error('address') is-invalid @enderror"
                    name="address"
                    value="{{ old('address') }}"
                    required placeholder="Street address">
                <label for="address">Address <span class="text-danger">*</span></label>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-floating">
                <input id="phone" type="tel"
                    class="form-control @error('phone') is-invalid @enderror"
                    name="phone"
                    value="{{ old('phone') }}"
                    required placeholder="Phone number">
                <label for="phone">Phone number <span class="text-danger">*</span></label>
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg">
                Get started
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="ms-1" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
            </button>
        </div>

        <p class="text-center text-muted small mt-3 mb-0">
            You can always complete this information later in
            <strong>Settings</strong>.
        </p>

    </form>
@endsection
