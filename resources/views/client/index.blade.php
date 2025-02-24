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
                                        <form action="#" method="GET">
                                            <div class="mb-3">
                                                <input type="search" id="search" name="search" class="form-control"
                                                    placeholder="{{ __('Rechercher un client...') }}"
                                                    value="{{ request()->get('search') }}">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addClientModal">
                                        <svg viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                                        </svg>
                                        {{ __('Ajouter un client') }}
                                    </a>
                                </div>
                            </div>





                        </header>


                        @if ($clients->count() > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Nom Complet') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Réservations') }}</th>
                                            <th>{{ __('Dernièrs réservation') }}</th>
                                            <th>{{ __('Prestation(e) préférée(e)') }}</th>
                                            <th>{{ __('Dépenses') }}</th>
                                            <th>{{ __('Poinds') }}</th>
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
                                                            <li><button class="classBtnEditClient dropdown-item"
                                                                    data-id="{{ $client->id }}"
                                                                    data-first_name="{{ $client->first_name }}"
                                                                    data-last_name="{{ $client->last_name }}"
                                                                    data-email="{{ $client->email }}"
                                                                    data-phone="{{ $client->phone }}">
                                                                    Modifier
                                                                </button>
                                                            </li>
                                                            <li><button
                                                                    class="classBtnDeleteClient dropdown-item text-danger"
                                                                    data-id="{{ $client->id }}" data-bs-toggle="modal"
                                                                    data-name="{{ $client->fullname }}"
                                                                    data-bs-target="#deleteClientModal">
                                                                    Supprimer
                                                                </button>

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



    {{-- delete modals delete --}}

    <div class="modal fade" id="deleteClientModal" tabindex="-1" aria-labelledby="deleteClientModalLabel"
        aria-hidden="true">
        <form action="{{ route('client.destroy') }}" method="post">
            @csrf
            @method('DELETE')
            <input type="text" name="id" id="clientIdTodelete" hidden>

            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="deleteClientModalLabel">
                            Supprimer le client
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Souhaitez-vous vraiment supprimer <span class="fw-semibold" id="clientNameTodelete"></span> de
                        votre
                        système ?
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Annuler
                        </button>
                        <button type="submit" class="btn btn-danger">
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal add cleint -->
    <div class="modal fade  @if ($errors->any()) _modalHasErrors @endif " id="addClientModal" tabindex="-1"
        aria-labelledby="addClientModalLabel" aria-hidden="true">
        <form action="{{ route('client.store') }}" method="post" id="addClientForm">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="addClientModalLabel">
                            Ajouter un client
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('client._from')
                    </div>

                    <div class="modal-footer">
                        <div class="d-grid gap-2 w-100">

                            <button type="submit" class="btn btn-primary">
                                Ajouter
                            </button>
                        </div>
                        <!-- /.d-grid -->
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- End modal --}}


    {{-- Modal edit client --}}
    <div class="modal fade  @if ($errors->any()) modalHasErrors @endif " id="editClientModal" tabindex="-1"
        aria-labelledby="editClientModalLabel" aria-hidden="true">
        <form action="{{ route('client.update') }}" method="post" id="editClientForm">
            @csrf
            @method('PUT')
            {{-- clint id to edit --}}
            <input type="text" name="id" id="client_id" hidden>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="editClientModalLabel">
                            Modifier le client
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('client._from')
                    </div>

                    <div class="modal-footer">
                        <div class="d-grid gap-2 w-100">

                            <button type="submit" class="btn btn-primary">
                                Mettre à jours
                            </button>
                        </div>
                        <!-- /.d-grid -->
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- End modal --}}


@endsection
