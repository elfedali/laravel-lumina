@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card border-0">
                    <div class="card-body">
                        <header class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="h5">Liste des clients</h5>
                                <p class="text-muted fw-light">Tous les clients de votre salon se trouvent ici.</p>
                            </div>
                            <div class="d-flex gap-2">
                                <div class="me-2">
                                    <div>
                                        <form action="{{ route('client.index') }}" method="GET">
                                            <div class="mb-3">
                                                <input type="search" id="search" name="search" class="form-control"
                                                    placeholder="{{ __('Search clients...') }}"
                                                    value="{{ request()->get('search') }}">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('client.create') }}" class="btn btn-primary">
                                        <svg viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                                        </svg>
                                        {{ __('Add client') }}
                                    </a>
                                </div>
                            </div>





                        </header>


                        @if ($clients->count() > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                                    <th>{{ __('Full name') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                    <th>{{ __('Bookings') }}</th>
                                                    <th>{{ __('Last booking') }}</th>
                                                    <th>{{ __('Preferred service(s)') }}</th>
                                                    <th>{{ __('Spending') }}</th>
                                                    <th>{{ __('Visits') }}</th>
                                                    <th>{{ __('Actions') }}</th>
                                                </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $client)
                                            <tr id="client-id-{{ $client->id }}"
                                                data-locale-id={{ $client->locale->id }}>
                                                <td>{{ $client->fullname }}</td>

                                                <td>
                                                    vip
                                                </td>
                                                <td>8</td>
                                                <td>
                                                    12/12/2024
                                                </td>
                                                <td>
                                                    Hamam turki
                                                </td>
                                                <td>
                                                    600 MAD
                                                </td>
                                                <td>
                                                    24
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn  btn-sm btn-light _dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <x-icon_dots></x-icon_dots>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                        href="{{ route('client.edit', $client) }}">
                                                                        Edit
                                                                    </a>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('client.destroy', $client) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Delete this client?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="dropdown-item text-danger" type="submit">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-end">
                                {{ $clients->links() }}
                            </div>
                        @else
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="text-center">
                                    <i class="fa-solid fa-users-slash fs-3x text-muted"></i>
                                    <p class="text-muted">
                                        {{ __('No client found.') }}
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
