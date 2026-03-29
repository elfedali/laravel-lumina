@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-5">
            <div class="card border-0">
                <div class="card-body">
                    <header class="mb-4">
                        <a href="{{ route('staff.function') }}" class="text-muted small d-inline-flex align-items-center gap-1 mb-2">
                            ← Back to roles
                        </a>
                        <h5 class="h5 mb-1">Edit role</h5>
                        <p class="text-muted fw-light mb-0">{{ $staffFunction->name }}</p>
                    </header>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('staff.function.update', $staffFunction) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-floating mb-3">
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $staffFunction->name) }}" required placeholder="Chef, Waiter, Bartender…" autofocus>
                            <label for="name">Name <span class="text-danger">*</span></label>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Color</label>
                            <input type="color" name="color" class="form-control form-control-color @error('color') is-invalid @enderror"
                                value="{{ old('color', $staffFunction->color) }}">
                            @error('color')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Update</button>
                            <a href="{{ route('staff.function') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
