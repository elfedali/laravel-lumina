@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0">
                <div class="card-body">
                    <header class="mb-4">
                        <a href="{{ route('service.index') }}" class="text-muted small d-inline-flex align-items-center gap-1 mb-2">
                            ← Back to menu
                        </a>
                        <h5 class="h5 mb-1">New item</h5>
                        <p class="text-muted fw-light mb-0">Add an item to your menu.</p>
                    </header>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3 mb-3">
                            <div class="col-md-8">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Price (MAD) <span class="text-danger">*</span></label>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price') }}" min="0" step="0.01" required>
                                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                rows="2">{{ old('description') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Section</label>
                                <select name="section_id" class="form-select @error('section_id') is-invalid @enderror">
                                        <option value="">No section</option>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}" @selected(old('section_id') == $section->id)>
                                            {{ $section->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('section_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Preparation time (min)</label>
                                <input type="number" name="preparation_time" class="form-control @error('preparation_time') is-invalid @enderror"
                                    value="{{ old('preparation_time') }}" min="1" max="300">
                                @error('preparation_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                            @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Features</label>
                            <div class="d-flex flex-wrap gap-3 mt-1">
                                @foreach([
                                    'is_halal'      => 'Halal',
                                    'is_vegetarian' => 'Vegetarian',
                                    'is_vegan'      => 'Vegan',
                                    'is_spicy'      => 'Spicy 🌶',
                                    'is_featured'   => '⭐ Featured',
                                    'is_new'        => '🆕 New',
                                ] as $field => $label)
                                    <div class="form-check">
                                        <input type="checkbox" name="{{ $field }}" value="1"
                                            class="form-check-input" id="{{ $field }}"
                                            {{ old($field) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ $field }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Add</button>
                            <a href="{{ route('service.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
