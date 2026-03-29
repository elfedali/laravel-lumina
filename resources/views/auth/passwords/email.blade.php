@extends('layouts.auth')

@section('content')
    <div class="mb-4">
        <h1 class="h3 fw-bold mb-1">Reset your password</h1>
        <p class="text-muted mb-0">Enter your email and we'll send you a reset link.</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-floating mb-4">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@example.com">
            <label for="email">Email address <span class="text-danger">*</span></label>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary btn-lg">Send reset link</button>
        </div>
    </form>

    <p class="text-center text-muted small mt-4 mb-0">
        <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Back to sign in</a>
        <span class="mx-2 text-muted">·</span>
        <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Register</a>
    </p>
@endsection
