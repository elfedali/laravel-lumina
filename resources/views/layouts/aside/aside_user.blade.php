<nav class="navbar navbar-expand-lg bg-black sticky-top p-0" data-bs-theme="dark" id="navigation">

    <div class="d-flex align-items-center justify-content-between w-100 px-3 py-3">
        <a class="navbar-brand mb-lg-0" href="{{ route('dashboard') }}">
            <span class="fw-semibold" style="font-size: 20px;">
                {{ auth()->user()->company->name ?? 'Pas de salon' }}
            </span>
        </a>
        <span class="icon-edit-company" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#appModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.4em" height="1.4em" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M5 19h1.425L16.2 9.225L14.775 7.8L5 17.575zm-2 2v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM19 6.4L17.6 5zm-3.525 2.125l-.7-.725L16.2 9.225z" />
            </svg>
        </span>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    @include('inc/shopsdropdown')
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
