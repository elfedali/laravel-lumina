@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0">
                <div class="card-body">
                    <header class="mb-4">
                        <a href="{{ route('admin.categories.index') }}" class="text-muted small d-inline-flex align-items-center gap-1 mb-2">
                            ← Back to categories
                        </a>
                        <h5 class="h5 mb-1">New category</h5>
                        <p class="text-muted fw-light mb-0">Add a cuisine type to the platform.</p>
                    </header>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf

                        <div class="row g-3 mb-3">
                            <div class="col-md-8">
                                <div class="form-floating">
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" required placeholder="Ex: Moroccan, Italian…" autofocus>
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" id="icon" name="icon" class="form-control @error('icon') is-invalid @enderror"
                                        value="{{ old('icon') }}" placeholder="🍕" maxlength="4">
                                    <label for="icon">Icon (emoji)</label>
                                    @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Color</label>
                                <input type="color" name="color" class="form-control form-control-color @error('color') is-invalid @enderror"
                                    value="{{ old('color', '#6c757d') }}">
                                @error('color')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" id="sort_order" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror"
                                        value="{{ old('sort_order', 0) }}" min="0" placeholder="0">
                                    <label for="sort_order">Order</label>
                                    @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active"
                                        {{ old('is_active', '1') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-4">
                            <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                                placeholder="Description" style="height: 80px">{{ old('description') }}</textarea>
                            <label for="description">Description</label>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Create</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
