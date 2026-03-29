@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-7">
            <div class="card border-0">
                <div class="card-body">
                    <header class="mb-4">
                        <a href="{{ route('staff.index') }}" class="text-muted small d-inline-flex align-items-center gap-1 mb-2">
                            ← Back to staff
                        </a>
                        <h5 class="h5 mb-1">New staff member</h5>
                        <p class="text-muted fw-light mb-0">Add a member to your restaurant team.</p>
                    </header>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3 mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                        value="{{ old('first_name') }}" required placeholder="First name" autofocus>
                                    <label for="first_name">First name <span class="text-danger">*</span></label>
                                    @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                        value="{{ old('last_name') }}" required placeholder="Last name">
                                    <label for="last_name">Last name <span class="text-danger">*</span></label>
                                    @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                            <div class="form-floating mb-3">
                            <select id="function_id" name="function_id" class="form-select @error('function_id') is-invalid @enderror">
                                <option value="">No function</option>
                                @foreach($functions as $fn)
                                    <option value="{{ $fn->id }}" @selected(old('function_id') == $fn->id)>
                                        {{ $fn->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="function_id">Function</label>
                            @error('function_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone') }}" placeholder="Phone">
                                    <label for="phone">Phone</label>
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="Email">
                                    <label for="email">Email</label>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror" accept="image/*">
                            @error('avatar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-check mb-4">
                            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active"
                                {{ old('is_active', '1') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Save</button>
                            <a href="{{ route('staff.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
