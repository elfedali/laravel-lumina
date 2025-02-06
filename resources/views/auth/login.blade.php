@extends('layouts.auth')

@section('content')
    <section>
        <h1 class="h1">
            Connexion
        </h1>
        <p class="text-muted lead">
            Connectez-vous pour accéder à votre compte.
        </p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-floating mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required placeholder="email">
                <label for="email">
                    Adresse email
                </label>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password" placeholder="Password">
                <label for="password">
                    Mot de passe
                </label>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        Se souvenir de moi
                    </label>
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">
                    Se connecter
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>
        </form>

        <div class="mt-4">
            <p>
                Vous n'avez pas de compte ?
                <a href="{{ route('register') }}" class="btn btn-link">
                    S'inscrire
                </a>
            </p>
        </div>
    </section>
@endsection
