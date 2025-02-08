<nav class="navbar navbar-expand-lg bg-black sticky-top p-0" data-bs-theme="dark" id="navigation">

    <a class="navbar-brand" href="{{ route('dashboard') }}">
        <span class="fw-semibold fs-2 ps-4 ">
            {{ auth()->user()->company->name ?? 'Pas de salon' }}
        </span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-column" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <span>Tableau de bord </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <span>Gestion des réservations</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <span>Gestion des prestations</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <span>Gestion des collaborateurs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <span>Gestion des clients</span>
                </a>
            </li>
        </ul>
    </div>

</nav>
