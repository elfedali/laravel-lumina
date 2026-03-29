<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="auth-shell">
        <div class="row g-0 min-vh-100">
            <section class="col-lg-6 d-none d-lg-block">
                <div class="auth-hero position-relative vh-100 overflow-hidden p-5">
                    <div class="auth-hero-content">
                        <p class="h1 fw-bold text-light mb-3">
                            {{ config('app.name', 'laravel') }}
                        </p>
                        <p class="text-light-emphasis mb-4 fs-5">Appointment and service management platform</p>
                        <div class="p-lg-5">
                            <img src="{{ asset('assets/images/auth.png') }}" class="img-fluid" alt="Authentication - Lumina">
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.col-lg-6 -->
            <section class="col-lg-6 d-flex align-items-center p-4 p-lg-5">
                <main class="auth-form-wrap p-lg-5 w-100">
                    @yield('content')
                </main>
            </section>
        </div>
        <!-- /.row -->
</body>

</html>
