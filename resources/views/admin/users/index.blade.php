@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card border-0">
                    <div class="card-body">
                        <header class="d-flex justify-content-between align-items-start">
                            <div>
                                <h1 class="h5">{{ __('Clients') }}</h1>
                                <p class="text-muted fw-light">{{ __('Gérer tous vos clients ici.') }}</p>
                            </div>
                            <div>
                                <a href="{{ route('users.create') }}" class="btn btn-primary">
                                    <svg viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                                    </svg>
                                    {{ __('Ajouter un client') }}
                                </a>
                            </div>
                        </header>

                        <div>
                            <form action="#" method="GET">
                                <div class="mb-3">
                                    <input type="search" id="search" name="search" class="form-control"
                                        placeholder="{{ __('Rechercher un client...') }}"
                                        value="{{ request()->get('search') }}">
                                </div>
                            </form>
                        </div>
                        @if ($users->count() > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ __('Nom Complet') }}</th>
                                            <th scope="col">{{ __('Nom de salon') }}</th>
                                            <th scope="col">{{ __('Email') }}</th>
                                            <th scope="col">{{ __('Téléphone') }}</th>
                                            <th scope="col">{{ __('Date d\'ajout') }}</th>
                                            <th scope="col" class="text-end">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $client)
                                            <tr id="client-id-{{ $client->id }}">
                                                <td>{{ $client->fullname }}</td>

                                                <td id="company-id-{{ $client->company->id ?? 'N/A' }}">
                                                    {{ $client->company->name ?? 'N/A' }}
                                                    <small class="text-muted">|
                                                        {{ $client->company->category ?? 'N/A' }}
                                                    </small>
                                                </td>
                                                <td>{{ $client->email ?? 'N/A' }}</td>
                                                <td>{{ $client->telephone ?? 'N/A' }}</td>
                                                <td>{{ $client->created_at->diffForHumans() }}</td>
                                                <td class="text-end">
                                                    <div class="btn-group">
                                                        <a href="{{ route('users.edit', $client->id) }}"
                                                            class="btn btn-sm btn-light">
                                                            <i class="fa-solid fa-pen"></i> {{ __('Modifier') }}
                                                        </a>
                                                        <button class="btn btn-sm btn-danger"
                                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $client->id }}').submit();">
                                                            <i class="fa-solid fa-trash"></i> {{ __('Supprimer') }}
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('users.destroy', $client->id) }}" method="POST"
                                                        id="delete-form-{{ $client->id }}" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="text-center">
                                    <i class="fa-solid fa-users-slash fs-3x text-muted"></i>
                                    <p class="text-muted">
                                        {{ __('Aucun client trouvé.') }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
