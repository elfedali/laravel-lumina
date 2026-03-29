@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0">
                <div class="card-body">
                    <header class="mb-4">
                        <h5 class="h5 mb-1">Edit business</h5>
                        <p class="text-muted fw-light mb-0">Update your business information.</p>
                    </header>

                    <form method="POST" action="{{ route('settings.company.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-lg mb-3">
                                <div class="form-floating">
                                    <input type="text" name="name" value="{{ old('name', $company->name) }}" id="company_name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="">
                                    <label for="company_name" class="form-label">Business name <span class="text-danger">*</span></label>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-lg mb-3">
                                <div class="form-floating">
                                    <input type="text" name="category" value="{{ old('category', $company->category) }}" id="company_category"
                                        class="form-control @error('category') is-invalid @enderror" placeholder="">
                                    <label for="company_category" class="form-label">Business category <span class="text-danger">*</span></label>
                                    @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            @if($company->logo)
                                <div class="mb-2">
                                    <img src="{{ $company->LogoURL }}" alt="" class="img-fluid rounded" style="width:100px; height:auto;">
                                </div>
                            @endif
                            <label for="company_logo" class="form-label">Business logo</label>
                            <input type="file" name="logo" id="company_logo" class="form-control @error('logo') is-invalid @enderror"
                                accept="image/png, image/jpeg, image/jpg">
                            @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
