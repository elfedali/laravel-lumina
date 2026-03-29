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
                        <h5 class="h5 mb-1">Edit item</h5>
                        <p class="text-muted fw-light mb-0">{{ $menuItem->name }}</p>
                    </header>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('service.update', $menuItem) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3 mb-3">
                            <div class="col-md-8">
                                <div class="form-floating">
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $menuItem->name) }}" required placeholder="Name" autofocus>
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price', $menuItem->price) }}" min="0" step="0.01" required placeholder="0.00">
                                    <label for="price">Price (MAD) <span class="text-danger">*</span></label>
                                    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                                placeholder="Description" style="height: 80px">{{ old('description', $menuItem->description) }}</textarea>
                            <label for="description">Description</label>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select id="section_id" name="section_id" class="form-select @error('section_id') is-invalid @enderror">
                                        <option value="">No section</option>
                                        @foreach($sections as $section)
                                            <option value="{{ $section->id }}" @selected(old('section_id', $menuItem->section_id) == $section->id)>
                                                {{ $section->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="section_id">Section</label>
                                    @error('section_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" id="preparation_time" name="preparation_time" class="form-control @error('preparation_time') is-invalid @enderror"
                                        value="{{ old('preparation_time', $menuItem->preparation_time) }}" min="1" max="300" placeholder="15">
                                    <label for="preparation_time">Preparation time (min)</label>
                                    @error('preparation_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            @if($menuItem->photo)
                                <div class="mb-2">
                                    <img src="{{ $menuItem->photo_url }}" width="80" height="60"
                                        class="rounded object-fit-cover" alt="Photo actuelle">
                                    <span class="text-muted small ms-2">Photo actuelle</span>
                                </div>
                            @endif
                            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                            @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
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
                                            {{ old($field, $menuItem->$field) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ $field }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active"
                                {{ old('is_active', $menuItem->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active (visible on menu)</label>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Update</button>
                            <a href="{{ route('service.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
