<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- favicon --}}
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <script src="https://unpkg.com/htmx.org@2.0.4"></script>

    <!-- Scripts -->

    @if (Auth::user()->role == 'admin')
        @vite(['resources/sass/app.scss', 'resources/js/admin.js'])
    @else
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @endif

</head>

<body x-data="{ modalOpen: false }">


    <div class="layout layout-nav-side">

        @if (Auth::user()->role == 'admin')
            @include('layouts.aside.aside_admin')
        @else
            @include('layouts.aside.aside_user')
        @endif

        <section class="main-container d-flex justify-content-between flex-column">
            <div>
                <header class="py-2 px-3 bg-white d-flex justify-content-end align-items-center">
                    <a class="btn btn-link dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="fs-14"> {{ Auth::user()->fullname }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-start" aria-labelledby="triggerId">

                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editAccountModal">Mon
                            compte</button>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            <span class="text-danger">

                                Déconnexion
                            </span>
                        </a>
                    </div>
                    {{-- LOGOUT => FORM --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </header>
                {{-- ALERTS --}}
                @include('layouts._alerts')
            </div>
            <main id="main-content" class="flex-fill py-4"> @yield('content')</main>
            <footer class="bg-white py-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="m-0">
                                &copy; {{ date('Y') }} <b>Lumina</b>. Tous droits réservés.
                            </p>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </footer>

        </section>

    </div>
    <!-- /.container-fluid -->

    @include('inc.modal-company')
    @include('inc.modal-locale')
    @include('inc.modal-delete-locale')
    @include('inc.modal-edit-locale')

    @include('inc.modal-edit-account')

    <script src="//unpkg.com/alpinejs" defer></script>
    @yield('scripts')

</body>

</html>
