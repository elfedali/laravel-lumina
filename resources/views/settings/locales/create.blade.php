@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-9">
            <div class="card border-0">
                <div class="card-body">
                    <header class="mb-4">
                        <h5 class="h5 mb-1">Add location</h5>
                        <p class="text-muted fw-light mb-0">Add a new location for your business.</p>
                    </header>

                    <form method="POST" action="{{ route('settings.locales.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <div class="form-floating">
                                    <input type="text" name="address" id="locale_address" class="form-control @error('address') is-invalid @enderror"
                                        placeholder="" value="{{ old('address') }}">
                                    <label for="locale_address" class="form-label">Address <span class="text-danger">*</span></label>
                                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="col-lg mb-3">
                                <div class="form-floating">
                                    <input type="text" name="neighborhood" id="locale_neighborhood" class="form-control @error('neighborhood') is-invalid @enderror"
                                        placeholder="" value="{{ old('neighborhood') }}">
                                    <label for="locale_neighborhood" class="form-label">Neighborhood <span class="text-danger">*</span></label>
                                    @error('neighborhood')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-lg mb-3">
                                <div class="form-floating">
                                    <input type="text" name="city" id="locale_city" class="form-control @error('city') is-invalid @enderror"
                                        placeholder="" value="{{ old('city') }}">
                                    <label for="locale_city" class="form-label">City <span class="text-danger">*</span></label>
                                    @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="col-lg mb-3">
                                <div class="form-floating">
                                    <input type="tel" name="phone" id="locale_phone" class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="" value="{{ old('phone') }}">
                                    <label for="locale_phone" class="form-label">Phone 1 <span class="text-danger">*</span></label>
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-lg mb-3">
                                <div class="form-floating">
                                    <input type="tel" name="phone2" id="locale_phone2" class="form-control @error('phone2') is-invalid @enderror"
                                        placeholder="" value="{{ old('phone2') }}">
                                    <label for="locale_phone2" class="form-label">Phone 2</label>
                                    @error('phone2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <x-horaires :hours="old('hours', $locale?->hours)" />
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Add location</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
