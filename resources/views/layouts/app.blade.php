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

    <!-- Scripts -->

    @if (Auth::user()->role == 'admin')
        @vite(['resources/sass/app.scss', 'resources/js/admin.js'])
    @else
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @endif

</head>

<body class="app-shell">

    <div id="sidebar-overlay" class="sidebar-overlay"></div>

    <div class="layout layout-nav-side">

        @if (Auth::user()->role == 'admin')
            @include('layouts.aside.aside_admin')
        @else
            @include('layouts.aside.aside_user')
        @endif

        <section class="main-container d-flex justify-content-between flex-column">
            <div>
                <header class="app-topbar px-3 px-lg-4 d-flex justify-content-between align-items-center">
                    <button class="btn d-lg-none p-1 sidebar-mobile-toggle" id="sidebar-toggle"
                            aria-label="Open navigation" aria-expanded="false" aria-controls="app-sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                        </svg>
                    </button>
                    <div class="d-flex align-items-center ms-auto gap-2">

                    {{-- Active location pill (non-admin only) --}}
                    @if(Auth::user()->role !== 'admin' && session(\App\Models\Locale::ACTIVE_LOCALE))
                        <a href="{{ route('locations.index') }}"
                           class="d-none d-md-inline-flex align-items-center gap-1 text-decoration-none badge text-bg-light border fw-normal py-2 px-3">
                            <i class="bi bi-geo-alt-fill text-primary"></i>
                            <span class="text-truncate" style="max-width:180px">{{ session(\App\Models\Locale::ACTIVE_LOCALE_NAME) }}</span>
                        </a>
                    @endif

                    <a class="btn app-user-toggle dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="app-user-avatar" aria-hidden="true">
                            {{ strtoupper(substr(Auth::user()->fullname ?? 'U', 0, 1)) }}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="triggerId">

                        <a class="dropdown-item" href="{{ route('account.edit') }}">
                            <i class="bi bi-person me-2 text-muted"></i>My account
                        </a>

                        @if(Auth::user()->role !== 'admin')
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('locations.index') }}">
                                <i class="bi bi-geo-alt me-2 text-muted"></i>My locations
                            </a>
                            <a class="dropdown-item" href="{{ route('settings.locales.create') }}">
                                <i class="bi bi-plus-circle me-2 text-muted"></i>Add location
                            </a>
                        @endif

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i>Sign out
                        </a>
                    </div>
                    {{-- LOGOUT => FORM --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    </div>
                </header>
                {{-- ALERTS --}}
                @include('layouts._alerts')
            </div>
            <main id="main-content" class="flex-fill py-4"> @yield('content')</main>
            <footer class="app-footer py-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="m-0">
                                &copy; {{ date('Y') }} <b>Lumina</b>. All rights reserved.
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

    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
    (function () {
        var toggle = document.getElementById('sidebar-toggle');
        var sidebar = document.getElementById('app-sidebar');
        var overlay = document.getElementById('sidebar-overlay');
        if (!toggle) return;
        function openSidebar() {
            sidebar.classList.add('sidebar-open');
            overlay.classList.add('show');
            toggle.setAttribute('aria-expanded', 'true');
        }
        function closeSidebar() {
            sidebar.classList.remove('sidebar-open');
            overlay.classList.remove('show');
            toggle.setAttribute('aria-expanded', 'false');
        }
        toggle.addEventListener('click', function () {
            sidebar.classList.contains('sidebar-open') ? closeSidebar() : openSidebar();
        });
        overlay.addEventListener('click', closeSidebar);
    }());
    </script>
    @yield('scripts')

</body>

</html>
