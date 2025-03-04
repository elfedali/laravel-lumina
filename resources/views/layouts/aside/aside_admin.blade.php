<nav class="navbar navbar-expand-lg bg-dark sticky-top p-lg-0" data-bs-theme="dark" id="navigation">

    <a class="navbar-brand mt-lg-3 mb-2" href="{{ route('dashboard') }}">
        <span class="fw-semibold fs-2 ps-4 ">
            Lumina
        </span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-column" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <svg width="1.3rem" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M13 11h6.95q-.375-2.75-2.287-4.663T13 4.05zm-2 8.95V4.05q-3.025.375-5.012 2.638T4 12t1.988 5.313T11 19.95m2 0q2.75-.35 4.675-2.275T19.95 13H13zM12 22q-2.075 0-3.9-.787t-3.175-2.138T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.888.788t3.174 2.15t2.15 3.175T22 12q0 2.05-.788 3.875t-2.137 3.188t-3.175 2.15T12 22" />
                    </svg>
                    <span>
                        Tableau de bord
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <svg width="1.3rem" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M12 6q-.2 0-.35-.15t-.15-.35t.15-.35T12 5t.35.15t.15.35t-.15.35T12 6m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T14 5t.35.15t.15.35t-.15.35T14 6m-4 0q-.2 0-.35-.15T9.5 5.5t.15-.35T10 5t.35.15t.15.35t-.15.35T10 6m7 1q-.2 0-.35-.15t-.15-.35t.15-.35T17 6t.35.15t.15.35t-.15.35T17 7M9 7q-.2 0-.35-.15T8.5 6.5t.15-.35T9 6t.35.15t.15.35t-.15.35T9 7M7 7q-.2 0-.35-.15T6.5 6.5t.15-.35T7 6t.35.15t.15.35t-.15.35T7 7m4 0q-.2 0-.35-.15t-.15-.35t.15-.35T11 6t.35.15t.15.35t-.15.35T11 7m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T13 6t.35.15t.15.35t-.15.35T13 7m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T15 6t.35.15t.15.35t-.15.35T15 7m-3 1q-.2 0-.35-.15t-.15-.35t.15-.35T12 7t.35.15t.15.35t-.15.35T12 8m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T14 7t.35.15t.15.35t-.15.35T14 8m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T16 7t.35.15t.15.35t-.15.35T16 8m-6 0q-.2 0-.35-.15T9.5 7.5t.15-.35T10 7t.35.15t.15.35t-.15.35T10 8M8 8q-.2 0-.35-.15T7.5 7.5t.15-.35T8 7t.35.15t.15.35t-.15.35T8 8m1 1q-.2 0-.35-.15T8.5 8.5t.15-.35T9 8t.35.15t.15.35t-.15.35T9 9M7 9q-.2 0-.35-.15T6.5 8.5t.15-.35T7 8t.35.15t.15.35t-.15.35T7 9m4 0q-.2 0-.35-.15t-.15-.35t.15-.35T11 8t.35.15t.15.35t-.15.35T11 9m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T13 8t.35.15t.15.35t-.15.35T13 9m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T15 8t.35.15t.15.35t-.15.35T15 9m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T17 8t.35.15t.15.35t-.15.35T17 9M5 9q-.2 0-.35-.15T4.5 8.5t.15-.35T5 8t.35.15t.15.35t-.15.35T5 9m1-1q-.2 0-.35-.15T5.5 7.5t.15-.35T6 7t.35.15t.15.35t-.15.35T6 8m2-2q-.2 0-.35-.15T7.5 5.5t.15-.35T8 5t.35.15t.15.35t-.15.35T8 6m1-1q-.2 0-.35-.15T8.5 4.5t.15-.35T9 4t.35.15t.15.35t-.15.35T9 5m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T11 4t.35.15t.15.35t-.15.35T11 5m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T13 4t.35.15t.15.35t-.15.35T13 5m2 0q-.2 0-.35-.15t-.15-.35t.15-.35T15 4t.35.15t.15.35t-.15.35T15 5m1 1q-.2 0-.35-.15t-.15-.35t.15-.35T16 5t.35.15t.15.35t-.15.35T16 6m2 2q-.2 0-.35-.15t-.15-.35t.15-.35T18 7t.35.15t.15.35t-.15.35T18 8m1 1q-.2 0-.35-.15t-.15-.35t.15-.35T19 8t.35.15t.15.35t-.15.35T19 9M9 14.25q-.525 0-.888-.363T7.75 13t.363-.888T9 11.75t.888.363t.362.887t-.363.888T9 14.25m6 0q-.525 0-.888-.363T13.75 13t.363-.888t.887-.362t.888.363t.362.887t-.363.888t-.887.362M12 21q-1.858 0-3.497-.707T5.639 18.36t-1.931-2.864T3 12.01q0-1.873.71-3.515q.711-1.642 1.93-2.867t2.862-1.926T11.994 3q1.87 0 3.512.701t2.867 1.926t1.926 2.866T21 12q0 1.85-.701 3.496t-1.926 2.865t-2.866 1.929T12 21m0-1q3.35 0 5.675-2.337T20 12q0-3.35-2.325-5.675T12 4Q8.675 4 6.337 6.325T4 12q0 3.325 2.338 5.663T12 20" />
                    </svg>
                    <span>
                        Clients
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('locales.*') ? 'active' : '' }}"
                    href="{{ route('locales.index') }}">
                    <svg width="1.2rem" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M5 22L1 11l5-3V2h4v6l5 3l-4 11zm12 0q-.425 0-.712-.288T16 21t.288-.712T17 20h3v-2h-3q-.425 0-.712-.288T16 17t.288-.712T17 16h3v-2h-3q-.425 0-.712-.288T16 13t.288-.712T17 12h3v-2h-3q-.425 0-.712-.288T16 9t.288-.712T17 8h3V6h-3q-.425 0-.712-.288T16 5t.288-.712T17 4h4q.825 0 1.413.588T23 6v14q0 .825-.587 1.413T21 22zM6.4 20h3.2l2.95-8.15L9.45 10h-2.9l-3.1 1.85zM8 15" />
                    </svg>
                    <span>
                        Locales
                    </span>
                </a>
            </li>

        </ul>
    </div>

</nav>
