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

    <style>
        body.auth-shell {
            font-family: 'Manrope', sans-serif;
            background: #fff;
        }

        .auth-hero {
            background-image: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
        }

        .auth-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(160deg, rgba(10, 18, 38, 0.78) 0%, rgba(10, 18, 38, 0.45) 100%);
        }

        .auth-hero-content {
            position: relative;
            z-index: 1;
        }

        .auth-form-wrap {
            max-width: 460px;
            margin: 0 auto;
        }

        .auth-form-wrap .form-control {
            font-size: 0.9375rem;
        }

        .auth-form-wrap .btn-primary {
            padding-top: 0.6rem;
            padding-bottom: 0.6rem;
        }

        .pwd-toggle {
            position: absolute;
            right: 0.75rem;
            top: 1.75rem;
            transform: translateY(-50%);
            z-index: 5;
            background: transparent;
            border: 0;
            color: #9ca3af;
            padding: 0.2rem;
            line-height: 1;
            cursor: pointer;
        }
        .pwd-toggle:hover { color: #374151; }
    </style>
</head>

<body class="auth-shell">
    <div class="row g-0 min-vh-100">

        {{-- Left panel — image --}}
        <section class="col-lg-6 d-none d-lg-flex flex-column">
            <div class="auth-hero position-relative vh-100 overflow-hidden p-5 d-flex flex-column justify-content-between">
                <div class="auth-hero-content">
                    <a href="/" class="text-decoration-none">
                        <span class="h3 fw-bold text-white">{{ config('app.name', 'Lumina') }}</span>
                    </a>
                    <p class="text-white-50 mt-1 mb-0 small">Appointment &amp; service management</p>
                </div>
                <div class="auth-hero-content">
                    <blockquote class="blockquote text-white mb-0">
                        <p class="fs-5 fst-italic lh-base">"Effortless scheduling,<br>exceptional service."</p>
                    </blockquote>
                </div>
            </div>
        </section>

        {{-- Right panel — form --}}
        <section class="col-lg-6 d-flex align-items-center justify-content-center p-4 p-lg-5 bg-white">
            <main class="auth-form-wrap w-100 py-4">
                @yield('content')
            </main>
        </section>

    </div>

    <script>
        document.querySelectorAll('.pwd-toggle').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var input = document.getElementById(btn.getAttribute('data-target'));
                var isHidden = input.type === 'password';
                input.type = isHidden ? 'text' : 'password';
                btn.querySelector('.icon-eye').classList.toggle('d-none', isHidden);
                btn.querySelector('.icon-eye-slash').classList.toggle('d-none', !isHidden);
            });
        });
    </script>
</body>

</html>
