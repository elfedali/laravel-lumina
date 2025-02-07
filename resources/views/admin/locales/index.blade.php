<!-- filepath: /Users/eeelfedali/Code/laravel-Lumina/resources/views/admin/locales/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card border-0">
                    <div class="card-body">
                        <header class="d-flex justify-content-between align-items-start">
                            <div>
                                <h1 class="h5">
                                    Les locaux
                                </h1>
                                <p class="text-muted fw-light">
                                    Gérer tous les locaux ici.
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('locales.create') }}" class="btn btn-primary">
                                    <svg viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                                    </svg>
                                    Ajouter un local
                                </a>
                            </div>
                        </header>

                        <div>
                            <form action="{{ route('locales.index') }}" method="GET">
                                <div class="mb-3">
                                    <input type="search" id="search" name="search" class="form-control"
                                        placeholder="{{ __('Search for a locale...') }}"
                                        value="{{ request()->get('search') }}">
                                </div>
                            </form>
                        </div>

                        @if ($companies->count() > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ __('Nom du salon') }}</th>
                                            <th scope="col">{{ __('Locaux') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($companies as $company)
                                            <tr id="company-id-{{ $company->id }}"
                                                data-locales-account="{{ $company->locales->count() }}">
                                                <td>

                                                    <h4 class="mb-4 d-flex align-items-center">
                                                        <div class="bg-light rounded-circle d-inline-block me-3"
                                                            style="width: 50px; height: 50px;">
                                                            <img src="{{ $company->logoURL }}" alt=""
                                                                class="img-fluid rounded-circle">

                                                        </div>
                                                        {{ $company->name }}
                                                        <small class="text-muted"> &nbsp;|&nbsp;
                                                            {{ $company->category }}</small>
                                                    </h4>
                                                    <div>
                                                        <h5> {{ $company->owner->fullname }}</h5>
                                                        <span class="d-block">
                                                            {{ $company->owner->phone }}
                                                        </span>
                                                        <span class="text-muted">
                                                            {{ $company->owner->email }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td id="company-locales-{{ $company->id }}" width="60%">
                                                    <ul class="list-group list-group-flush">
                                                        @foreach ($company->locales as $locale)
                                                            <a href="{{ route('locales.edit', $locale->id) }}"
                                                                class="list-group-item list-group-item-action">
                                                                {!! $locale->displayName !!}
                                                            </a>
                                                        @endforeach
                                                    </ul>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">
                                {{-- {{ $companies->links() }} --}}
                            </div>
                        @else
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="text-center">
                                    <p class="text-muted">{{ __('No locales found.') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
