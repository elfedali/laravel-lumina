<nav class="navbar navbar-expand-lg bg-black sticky-top p-0" data-bs-theme="dark" id="navigation">

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
