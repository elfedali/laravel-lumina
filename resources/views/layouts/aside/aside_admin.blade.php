<nav class="navbar navbar-expand-lg bg-dark sticky-top p-0" data-bs-theme="dark" id="navigation">

    <a class="navbar-brand" href="{{ route('dashboard') }}">
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
                    <span>
                        Tableau de bord
                    </span>
                </a>
            </li>
            <li>
                <a class="nav-link {{ Request::routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <span> 
                        Utilisateurs
                    </span>
                </a>
            </li>
            <li>
                <a class="nav-link {{ Request::routeIs('locales.index') ? 'active' : '' }}" href="{{ route('locales.index') }}"> 
                    <span> 
                        Locales
                    </span>
                </a>
            </li>

        </ul>
    </div>

</nav>
