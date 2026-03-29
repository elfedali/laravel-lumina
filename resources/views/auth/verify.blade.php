@extends('layouts.auth')

@section('content')
    <div class="mb-4">
        <h1 class="h3 fw-bold mb-1">Verify your email</h1>
        <p class="text-muted mb-0">One more step before you get started.</p>
    </div>

    @if (session('resent'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            A new verification link has been sent to your email address.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <p class="text-muted">
        Before continuing, please check your inbox for a verification link.
        If you didn't receive it,
    </p>

    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
            click here to request another
        </button>.
    </form>
@endsection
