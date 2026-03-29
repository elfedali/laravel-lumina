@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-7">
            <div class="card border-0">
                <div class="card-body">
                    <header class="mb-4">
                        <h5 class="h5 mb-1">My account</h5>
                        <p class="text-muted fw-light mb-0">Update your personal information.</p>
                    </header>

                    <form action="{{ route('account.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                name="lastname" id="user_lastname" value="{{ old('lastname', auth()->user()->lastname) }}">
                            <label for="user_lastname">Last name <span class="text-danger">*</span></label>
                            @error('lastname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                name="firstname" id="user_firstname" value="{{ old('firstname', auth()->user()->firstname) }}">
                            <label for="user_firstname">First name <span class="text-danger">*</span></label>
                            @error('firstname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                name="phone" id="user_telephone" value="{{ old('phone', auth()->user()->phone) }}">
                            <label for="user_telephone">Phone <span class="text-danger">*</span></label>
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4 form-floating">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" id="user_email" value="{{ old('email', auth()->user()->email) }}">
                            <label for="user_email">Email address <span class="text-danger">*</span></label>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
