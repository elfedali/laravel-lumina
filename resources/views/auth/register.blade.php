@extends('layouts.auth')

@section('content')
    <h1 class="h1 mb-3 ">
        S'inscrire
    </h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf


         <div class="form-floating mb-3">
            <input id="lastname" type="text" class="form-control @error('name') is-invalid @enderror" name="lastname"
                value="{{ old('lastname') }}" required autocomplete="lastname" autofocus placeholder="">
            <label for="lastname">
                Nom de famille
            </label>

            @error('lastname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="form-floating mb-3">
            <input id="firstname" type="text" class="form-control @error('name') is-invalid @enderror" name="firstname"
                value="{{ old('firstname') }}" required autocomplete="firstname" autofocus placeholder="">
            <label for="firstname">
                Prénom
            </label>

            @error('firstname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
       

        <div class="form-floating mb-3">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" placeholder="name@example.com">
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
                name="password" required autocomplete="new-password" placeholder="Password">
            <label for="password">
                Mot de passe
            </label>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password" placeholder="Confirm Password">
            <label for="password-confirm">
                Confirmer le mot de passe
            </label>
        </div>

        <div>
            <button type="submit" class="btn btn-primary">
                S'inscrire
            </button>
        </div>
    </form>

    <div class="mt-4">
        <p>
            Vous avez déjà un compte ?
            <a href="{{ route('login') }}">
                Se connecter
            </a>
        </p>
    </div>
@endsection
