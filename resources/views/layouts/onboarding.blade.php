<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lumina') }} — Setup</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body.onboarding-shell {
            font-family: 'Manrope', sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .onboarding-topbar {
            background: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 0.875rem 1.5rem;
        }

        .onboarding-card {
            background: #fff;
            border: 1px solid #e9ecef;
            border-radius: 1rem;
            box-shadow: 0 4px 24px rgba(0,0,0,.06);
        }

        .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            background: var(--bs-primary);
            color: #fff;
            font-weight: 700;
            font-size: 0.875rem;
            flex-shrink: 0;
        }

        .section-divider {
            border-top: 1px solid #e9ecef;
            margin: 2rem 0 1.75rem;
        }
    </style>
</head>

<body class="onboarding-shell">

    {{-- Top bar --}}
    <header class="onboarding-topbar d-flex align-items-center justify-content-between">
        <span class="fw-bold fs-5">{{ config('app.name', 'Lumina') }}</span>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link btn-sm text-muted text-decoration-none p-0">Sign out</button>
        </form>
    </header>

    {{-- Main --}}
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">

                <div class="mb-4">
                    <h1 class="h3 fw-bold mb-1">Let's set up your business</h1>
                    <p class="text-muted mb-0">Just a few details and you'll be ready to go.</p>
                </div>

                @yield('content')

            </div>
        </div>
    </main>

</body>
</html>
