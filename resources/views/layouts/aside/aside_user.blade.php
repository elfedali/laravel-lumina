<nav class="navbar navbar-expand-lg bg-black sticky-top p-lg-0" data-bs-theme="dark" id="navigation">

    @include('inc/logo')


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


    @include('inc/dropdown')


    @if (session()->has(\App\Models\Locale::ACTIVE_LOCALE))
        <div class="collapse navbar-collapse flex-column" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">
                        <svg width="1.3rem" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M13 11h6.95q-.375-2.75-2.287-4.663T13 4.05zm-2 8.95V4.05q-3.025.375-5.012 2.638T4 12t1.988 5.313T11 19.95m2 0q2.75-.35 4.675-2.275T19.95 13H13zM12 22q-2.075 0-3.9-.787t-3.175-2.138T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.888.788t3.174 2.15t2.15 3.175T22 12q0 2.05-.788 3.875t-2.137 3.188t-3.175 2.15T12 22" />
                        </svg>
                        <span>Tableau de bord </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('booking.*') ? 'active' : '' }}"
                        href="{{ route('booking.index') }}">
                        <x-icon_calendar />
                        <span>Gestion des réservations</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('service.*') ? 'active' : '' }}"
                        href="{{ route('service.index') }}">
                        <x-icon_service />
                        <span>Gestion des prestations</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('staff.*') ? 'active' : '' }}"
                        href="{{ route('staff.index') }}">
                        <x-icon_staff />
                        <span>Gestion des collaborateurs</span>
                    </a>


                    <ul>
                        <li>
                            <a class="nav-link {{ Request::routeIs('staff.index') ? 'active' : '' }}"
                                href="{{ route('staff.index') }}">
                                <span>Liste des collaborateurs</span>
                            </a>
                        </li>

                        <li>

                            <a class="nav-link {{ Request::routeIs('staff.function') ? 'active' : '' }}"
                                href="{{ route('staff.function') }}">
                                <span>
                                    Liste des fonctions
                                </span>
                            </a>
                        </li>
                    </ul>

                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('client.*') ? 'active' : '' }}"
                        href="{{ route('client.index') }}">
                        <svg width="1.3rem" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M12 6q-.2 0-.35-.15t-.15-.35t.15-.35T12 5t.35.15t.15.35t-.15.35T12 6m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T14 5t.35.15t.15.35t-.15.35T14 6m-4 0q-.2 0-.35-.15T9.5 5.5t.15-.35T10 5t.35.15t.15.35t-.15.35T10 6m7 1q-.2 0-.35-.15t-.15-.35t.15-.35T17 6t.35.15t.15.35t-.15.35T17 7M9 7q-.2 0-.35-.15T8.5 6.5t.15-.35T9 6t.35.15t.15.35t-.15.35T9 7M7 7q-.2 0-.35-.15T6.5 6.5t.15-.35T7 6t.35.15t.15.35t-.15.35T7 7m4 0q-.2 0-.35-.15t-.15-.35t.15-.35T11 6t.35.15t.15.35t-.15.35T11 7m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T13 6t.35.15t.15.35t-.15.35T13 7m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T15 6t.35.15t.15.35t-.15.35T15 7m-3 1q-.2 0-.35-.15t-.15-.35t.15-.35T12 7t.35.15t.15.35t-.15.35T12 8m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T14 7t.35.15t.15.35t-.15.35T14 8m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T16 7t.35.15t.15.35t-.15.35T16 8m-6 0q-.2 0-.35-.15T9.5 7.5t.15-.35T10 7t.35.15t.15.35t-.15.35T10 8M8 8q-.2 0-.35-.15T7.5 7.5t.15-.35T8 7t.35.15t.15.35t-.15.35T8 8m1 1q-.2 0-.35-.15T8.5 8.5t.15-.35T9 8t.35.15t.15.35t-.15.35T9 9M7 9q-.2 0-.35-.15T6.5 8.5t.15-.35T7 8t.35.15t.15.35t-.15.35T7 9m4 0q-.2 0-.35-.15t-.15-.35t.15-.35T11 8t.35.15t.15.35t-.15.35T11 9m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T13 8t.35.15t.15.35t-.15.35T13 9m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T15 8t.35.15t.15.35t-.15.35T15 9m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T17 8t.35.15t.15.35t-.15.35T17 9M5 9q-.2 0-.35-.15T4.5 8.5t.15-.35T5 8t.35.15t.15.35t-.15.35T5 9m1-1q-.2 0-.35-.15T5.5 7.5t.15-.35T6 7t.35.15t.15.35t-.15.35T6 8m2-2q-.2 0-.35-.15T7.5 5.5t.15-.35T8 5t.35.15t.15.35t-.15.35T8 6m1-1q-.2 0-.35-.15T8.5 4.5t.15-.35T9 4t.35.15t.15.35t-.15.35T9 5m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T11 4t.35.15t.15.35t-.15.35T11 5m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T13 4t.35.15t.15.35t-.15.35T13 5m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T15 4t.35.15t.15.35t-.15.35T15 5m1 1q-.2 0-.35-.15t-.15-.35t.15-.35T16 5t.35.15t.15.35t-.15.35T16 6m2 2q-.2 0-.35-.15t-.15-.35t.15-.35T18 7t.35.15t.15.35t-.15.35T18 8m1 1q-.2 0-.35-.15t-.15-.35t.15-.35T19 8t.35.15t.15.35t-.15.35T19 9M9 14.25q-.525 0-.888-.363T7.75 13t.363-.888T9 11.75t.888.363t.362.887t-.363.888T9 14.25m6 0q-.525 0-.888-.363T13.75 13t.363-.888t.887-.362t.888.363t.362.887t-.363.888t-.887.362M12 21q-1.858 0-3.497-.707T5.639 18.36t-1.931-2.864T3 12.01q0-1.873.71-3.515q.711-1.642 1.93-2.867t2.862-1.926T11.994 3q1.87 0 3.512.701t2.867 1.926t1.926 2.866T21 12q0 1.85-.701 3.496t-1.926 2.865t-2.866 1.929T12 21m0-1q3.35 0 5.675-2.337T20 12q0-3.35-2.325-5.675T12 4Q8.675 4 6.337 6.325T4 12q0 3.325 2.338 5.663T12 20" />
                        </svg>
                        <span>Gestion des clients</span>
                    </a>
                </li>
            </ul>
        </div>
    @endif

</nav>


<style>
    .icon-edit-company {
        color: white;
        opacity: 0.5;
        transition: opacity 0.3s;

    }

    .icon-edit-company:hover {
        opacity: 1;
    }
</style>
