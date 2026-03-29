@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0">
                <div class="card-body">
                    <header class="mb-4">
                        <a href="{{ route('client.index') }}" class="text-muted small d-inline-flex align-items-center gap-1 mb-2">
                            ← Back to clients
                        </a>
                        <h5 class="h5 mb-1">Edit client</h5>
                        <p class="text-muted fw-light mb-0">{{ $person->fullname }}</p>
                    </header>

                    <form action="{{ route('client.update', $person) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3 form-floating">
                                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                        id="client_last_name" placeholder="" value="{{ old('last_name', $person->last_name) }}">
                                    <label for="client_last_name">Last name <span class="text-danger">*</span></label>
                                    @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3 form-floating">
                                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                        id="client_first_name" placeholder="" value="{{ old('first_name', $person->first_name) }}">
                                    <label for="client_first_name">First name <span class="text-danger">*</span></label>
                                    @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3 form-floating">
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                        id="client_phone" placeholder="" value="{{ old('phone', $person->phone) }}">
                                    <label for="client_phone">Phone <span class="text-danger">*</span></label>
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3 form-floating">
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                        id="client_email" placeholder="" value="{{ old('email', $person->email) }}">
                                    <label for="client_email">E-mail</label>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('client.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
