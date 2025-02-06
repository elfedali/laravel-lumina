<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="_dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-white">
        <div class="row g-0">
            <section class="col-lg-6 d-none d-lg-block">
                <div class="position-relative vh-100 overflow-hidden bg-dark p-5">
                    <div>
                        <p class="h1 fw-bold text-light">
                            {{ config('app.name', 'laravel') }}
                        </p>
                      <div class="p-lg-5">
                        <img src="{{ asset('assets/images/auth.png') }}" class="img-fluid" alt="Authentication - Lumina">
                      </div>
                    </div>
                </div>
            </section>
            <!-- /.col-lg-6 -->
            <section class="col-lg-6 p-5">
                <main class="p-5">
                    @yield('content')
                </main>
            </section>
        </div>
        <!-- /.row -->
</body>

</html>
